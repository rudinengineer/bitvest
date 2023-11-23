
@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Pengaturan Website</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="/admin/settings" enctype="multipart/form-data" method="post">
                    @method('post')
                    @csrf
                    <div>
                        <div class="form-group">
                            <label for="biaya_admin">Biaya Admin Setiap Transaksi</label>
                            @error('biaya_admin')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="biaya_admin" placeholder="Masukkan Hadiah Dari Referal" name="biaya_admin" autocomplete="off" value="{{ old('biaya_admin') ? old('biaya_admin') : $setting->biaya_admin }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="referal_reward">Hadiah Dari Referal</label>
                            @error('referal_reward')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="referal_reward" placeholder="Masukkan Hadiah Dari Referal" name="referal_reward" autocomplete="off" value="{{ old('referal_reward') ? old('referal_reward') : $setting->referal_reward }}" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="minimal_wd">Minimal Withdraw</label>
                            @error('minimal_wd')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <input type="text" class="form-control" id="minimal_wd" placeholder="Masukkan Minimal Withdraw" name="minimal_wd" autocomplete="off" value="{{ old('minimal_wd') ? old('minimal_wd') : $setting->minimal_wd }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
@endsection