<?php

namespace App\Http\Controllers;

use App\Models\Referal;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function signin(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|min:3',
            'password' => 'required|min:3'
        ], [
            'required' => ':attribute harus di isi!',
            'min' => ':attribute minimal 3 character'
        ]);
        if ( Auth::attempt($credentials) ) {
            return redirect('/');
        } else {
            $credential = [
                'email' => $request->username,
                'password' => $request->password
            ];
            if ( Auth::attempt($credential) ) {
                return redirect('/');
            } else {
                return back()->with('error', 'Username atau password salah!');
            }
        }
    }

    public function signup(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|min:3|email|unique:users',
            'username' => 'required|min:3|unique:users',
            'password' => 'required'
        ], [
            'required' => ':attribute harus di isi!',
            'min' => 'Panjang :attribute minimal 3 character',
            'unique' => ':attribute sudah terpakai!',
            'email.email' => 'Format email tidak valid!',
        ]);
        $referal_code = "";
        for ($i=0; $i < 8; $i++) { 
            $referal_code .= random_int(0, 9);
        }
        $user = new User();
        $user->email = $request->email;
        $user->username = str_replace(" ", "", strtolower($request->username));
        $user->password = bcrypt($request->password);
        $user->referal_code = $referal_code;
        if ( $request->referal_code ) {
            $setting = Setting::first();
            $user->saldo = intval($setting->referal_reward);
        }
        $user->save();
        if ( $user ) {
            if ( $request->referal_code ) {
                $referal = new Referal();
                $referal->user_id = $user->id;
                $referal->code = $request->referal_code;
                $referal->total = $setting->referal_reward;
                $referal->save();
                if ( $referal ) {
                    $target = User::where('referal_code', $request->referal_code);
                    if ( $target->get()->count() ) {
                        $setting = Setting::first();
                        $target->update([
                            'saldo' => intval($target->first()->saldo) + intval($setting->referal_reward)
                        ]);
                    }
                }
            }
            return redirect('/signin')->with('success', 'Pendaftaran berhasil!');
        } else {
            return back()->with('error', 'Pendaftaran gagal!');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/signin');
    }
}