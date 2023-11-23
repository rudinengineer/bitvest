@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Data Admin</h1>
        <div class="mb-2 d-flex justify-content-end">
            <button class="btn btn-success" data-toggle="modal" data-target="#insertModal"><i class="fas fa-plus"></i> Tambah Data</button>
            {{-- Modal --}}
            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="/admin" enctype="multipart/form-data" method="post" class="modal-content">
                        @method('post')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Admin</h5>
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
                                    <label for="role">Role</label>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <select name="role" id="role" class="form-control">
                                        <option selected disabled>Pilih role</option>
                                        <option value="superadmin">Superadmin</option>
                                        <option value="admin">Admin</option>
                                    </select>
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
                                <th>Password</th>
                                <th>Role</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Role</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($users->count())
                            @foreach ($users as $i => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>***</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $user->id }}">Edit</button>
                                        <button class="btn btn-danger" onclick="question('Data akan terhapus!', '/admin/{{ $user->id }}/delete')">Hapus</button>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="editModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="/admin/{{ $user->id }}/edit" enctype="multipart/form-data" method="post" class="modal-content">
                                                    @method('post')
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Admin</h5>
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
                                                                <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" autocomplete="off" value="{{ old('username') ? old('username') : $user->username }}" required autofocus>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                @error('email')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <input type="text" class="form-control" id="email" placeholder="Masukkan Email" name="email" autocomplete="off" value="{{ old('email') ? old('email') : $user->email }}" required autofocus required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password">Password</label>
                                                                <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password" autocomplete="off" value="{{ old('password') }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Role</label>
                                                                @error('role')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <select name="role" id="role" class="form-control">
                                                                    <option selected disabled>Pilih role</option>
                                                                    <option value="superadmin" {{ old('role') && old('role') === 'superadmin' ? 'selected' : ($user->role === 'superadmin' ? 'selected' : '') }}>Superadmin</option>
                                                                    <option value="admin" {{ old('role') && old('role') === 'admin' ? 'selected' : ($user->role === 'admin' ? 'selected' : '') }}>Admin</option>
                                                                </select>
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
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Data masih kosong.</td>
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