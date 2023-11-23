<?php

namespace App\Http\Controllers;

use App\Models\Investasi;
use App\Models\Referal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function savesetting(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email|min:3',
            'old_password' => 'required|min:3'
        ], [
            'required' => ':attribute harus di isi!',
            'min' => 'Panjang :attribute minimal 3 character',
            'email' => 'Format email tidak valid!'
        ]);
        if ( password_verify($request->old_password, auth()->user()->password) ) {
            if ( $request->new_password ) {
                $credentials['password'] = bcrypt($request->new_password);
            }
            unset($credentials['old_password']);
            if ( User::where('id', auth()->user()->id)->update($credentials) ) {
                return redirect('/profile/setting')->with('success', 'Data berhasil di simpan!');
            } else {
                return back()->with('error', 'Data gagal di simpan!');
            }
        } else {
            return back()->with('error', 'Password lama salah!');
        }
    }

    public function setting() {
        return view('users.setting', [
            'title' => env('APP_NAME') . ' - Setting'
        ]);
    }

    public function image(Request $request) {
        $request->validate([
            'image' => 'required|image'
        ]);
        if ( $request->file('image') ) {
            $filename = $request->file('image')->hashName();
            $image = $request->file('image')->storeAs('public/images/users', $filename);
            $old_image = auth()->user()->image;
            if ( $image && User::where('id', auth()->user()->id)->update(['image' => $filename]) ) {
                Storage::delete('public/images/users/' . $old_image);
                return redirect('/profile/edit');
            } else {
                return back()->with('error', 'Gagal mengubah profile!');
            }
        }
    }

    public function profile() {
        return view('users.profile', [
            'title' => env('APP_NAME') . ' - ' . auth()->user()->username,
            'investasi' => Investasi::where('user_id', auth()->user()->id)->get(),
            'referal' => Referal::where('code', auth()->user()->referal_code)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ( auth()->user()->role === 'superadmin' ) {
            $credentials = $request->validate([
                'username' => 'required|min:3|unique:users',
                'email' => 'required|min:3|unique:users',
                'password' => 'required|min:3'
            ], [
                'required' => ':attribute harus di isi!',
                'min' => ':attribute harus berisi minimal 3 karakter',
                'unique' => ':attribute sudah digunakan!',
            ]);
            if ( $request->file('image') ) {
                $filename = $request->file('image')->hashName();
                $image = $request->file('image')->storeAs('public/images/users', $filename);
                if ( $image ) {
                    $credentials['image'] = $filename;
                }
            }
            $referal_code = "";
            for ($i=0; $i < 8; $i++) { 
                $referal_code .= random_int(0, 9);
            }
            $credentials['referal_code'] = $referal_code;
            $credentials['password'] = bcrypt($request->password);
            if ( User::create($credentials) ) {
                return redirect('/admin/users')->with('success', 'Data berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Data gagal ditambahkan!');
            }
        } else {
            return redirect('/admin');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('users.edit', [
            'title' => auth()->user()->username . ' - Edit'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ( auth()->user()->role === 'superadmin' ) {
            $credentials = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'birthday' => $request->birthday,
                'bio' => $request->bio
            ];
            if ( $request->file('image') ) {
                $filename = $request->file('image')->hashName();
                $image = $request->file('image')->storeAs('public/images/users', $filename);
                if ( $image ) {
                    Storage::delete('public/images/users/' . auth()->user()->image);
                    $credentials['image'] = $filename;
                }
            }
            if ( $request->password ) {
                $credentials['password'] = bcrypt($request->password);
            }
            if ( User::where('id', auth()->user()->id)->update($credentials) ) {
                return redirect('/profile/edit')->with('success', 'Profile berhasil diubah!');
            } else {
                return redirect('/profile/edit')->with('error', 'Profile gagal diubah!');
            }
        } else {
            return redirect('/admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ( auth()->user()->role === 'superadmin' ) {
            if ( User::destroy($user->id) ) {
                return redirect('/admin/users')->with('success', 'Data berhasil dihapus!');
            } else {
                return back()->with('error', 'Data gagal dihapus!');
            }
        } else {
            return redirect('/admin');
        }
    }
}
