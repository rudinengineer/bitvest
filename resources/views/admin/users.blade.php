@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Data Pengguna</h1>
        <div class="mb-2 d-flex justify-content-end">
            <button class="btn btn-success" data-toggle="modal" data-target="#insertModal"><i class="fas fa-plus"></i> Tambah Data</button>
            {{-- Modal --}}
            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="/user" enctype="multipart/form-data" method="post" class="modal-content">
                        @method('post')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" autocomplete="off" value="{{ old('username') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" autocomplete="off" value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" autocomplete="off" value="{{ old('password') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            {{-- End Modal --}}
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Gambar</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Gambar</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($users->count())
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td class="d-flex justify-content-center">
                                        <img src="{{ auth()->user()->image ? asset('/storage/images/users/' . auth()->user()->image) : asset('/assets/img/undraw_profile.svg') }}" width="50" height="50" alt="{{ $user->username }}">
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $user->id }}">Detail</button>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Pengguna</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>Username : {{ $user->username }}</div>
                                                        <div>Email : {{ $user->email }}</div>
                                                        <div>Nama Depan : {{ $user->first_name }}</div>
                                                        <div>Nama Belakang : {{ $user->last_name }}</div>
                                                        <div>No. Telp : {{ $user->phone }}</div>
                                                        <div>Jenis Kelamin : {{ $user->gender }}</div>
                                                        <div>Tanggal Lahir : {{ $user->birthday }}</div>
                                                        <div>Bio : {{ $user->bio }}</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Modal --}}
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Data masih kosong.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
@endsection