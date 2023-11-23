@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Data Proyek</h1>
        <div class="mb-2 d-flex justify-content-end">
            <button class="btn btn-success" data-toggle="modal" data-target="#insertModal"><i class="fas fa-plus"></i> Tambah Data</button>
            {{-- Modal --}}
            <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="/product" enctype="multipart/form-data" method="post" class="modal-content">
                        @method('post')
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Proyek</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" class="form-control" id="title" placeholder="Masukkan Judul Proyek" name="title" autocomplete="off" value="{{ old('title') }}" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_proyek">Jumlah Proyek</label>
                                    @error('jumlah_proyek')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="number" class="form-control" id="jumlah_proyek" placeholder="Masukkan Jumlah Proyek" name="jumlah_proyek" autocomplete="off" value="{{ old('jumlah_proyek') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="keuntungan_harian">Keuntungan Harian</label>
                                    @error('keuntungan_harian')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="keuntungan_harian" placeholder="Masukkan Keuntungan Harian" name="keuntungan_harian" autocomplete="off" value="{{ old('keuntungan_harian') }}" required>
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_pemasukan">Jumlah Pemasukan</label>
                                    @error('jumlah_pemasukan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="jumlah_pemasukan" placeholder="Masukkan Jumlah Pemasukan" name="jumlah_pemasukan" autocomplete="off" value="{{ old('jumlah_pemasukan') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="siklus">Siklus</label>
                                    @error('siklus')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="siklus" placeholder="Masukkan Siklus" name="siklus" autocomplete="off" value="{{ old('siklus') }}" required>
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Hari</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="price">Harga Paket</label>
                                    @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <div class="input-group-text">Rp</div>
                                        </div>
                                        <input type="number" class="form-control" id="price" placeholder="Masukkan Harga Paket" name="price" autocomplete="off" value="{{ old('price') }}" required>
                                    </div>
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
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Jumlah Proyek</th>
                                <th>Keuntungan Harian</th>
                                <th>Jumlah Pemasukan</th>
                                <th>Siklus</th>
                                <th>Harga Paket</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Jumlah Proyek</th>
                                <th>Keuntungan Harian</th>
                                <th>Jumlah Pemasukan</th>
                                <th>Siklus</th>
                                <th>Harga Paket</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($products->count())
                            @foreach ($products as $i => $product)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td class="d-flex justify-content-center">
                                        @if($product->image)
                                            <img src="{{ asset('/storage/images/products/' . $product->image) }}" width="70" height="70" alt="{{ $product->title }}">
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-primary">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                        </svg>                          
                                        @endif
                                    </td>
                                    <td>{{ number_format($product->jumlah_proyek, 0) }}</td>
                                    <td>{{ $product->keuntungan_harian }}%</td>
                                    <td>{{ number_format($product->jumlah_pemasukan, 0) }}</td>
                                    <td>{{ $product->siklus }} Hari</td>
                                    <td>{{ number_format($product->price, 0, '.', '.') }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $product->uuid }}">Edit</button>
                                        <button class="btn btn-danger" onclick="question('Data akan terhapus!', '/product/{{ $product->uuid }}/delete')">Hapus</button>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="editModal-{{ $product->uuid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="/product/{{ $product->uuid }}/edit" enctype="multipart/form-data" method="post" class="modal-content">
                                                    @method('post')
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Proyek</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>
                                                            <div class="form-group">
                                                                <label for="title">Judul</label>
                                                                @error('title')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <input type="text" class="form-control" id="title" placeholder="Masukkan Judul Proyek" name="title" autocomplete="off" value="{{ old('title') ? old('title') : $product->title }}" required autofocus>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jumlah_proyek">Jumlah Proyek</label>
                                                                @error('jumlah_proyek')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <input type="number" class="form-control" id="jumlah_proyek" placeholder="Masukkan Jumlah Proyek" name="jumlah_proyek" autocomplete="off" value="{{ old('jumlah_proyek') ? old('jumlah_proyek') : $product->jumlah_proyek }}" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="keuntungan_harian">Keuntungan Harian</label>
                                                                @error('keuntungan_harian')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" id="keuntungan_harian" placeholder="Masukkan Keuntungan Harian" name="keuntungan_harian" autocomplete="off" value="{{ old('keuntungan_harian') ? old('keuntungan_harian') : $product->keuntungan_harian }}" required>
                                                                    <div class="input-group-prepend">
                                                                    <div class="input-group-text">%</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="jumlah_pemasukan">Jumlah Pemasukan</label>
                                                                @error('jumlah_pemasukan')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp</div>
                                                                    </div>
                                                                    <input type="number" class="form-control" id="jumlah_pemasukan" placeholder="Masukkan Jumlah Pemasukan" name="jumlah_pemasukan" autocomplete="off" value="{{ old('jumlah_pemasukan') ? old('jumlah_pemasukan') : $product->jumlah_pemasukan }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="siklus">Siklus</label>
                                                                @error('siklus')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" id="siklus" placeholder="Masukkan Siklus" name="siklus" autocomplete="off" value="{{ old('siklus') ? old('siklus') : $product->siklus }}" required>
                                                                    <div class="input-group-prepend">
                                                                    <div class="input-group-text">Hari</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price">Harga Paket</label>
                                                                @error('price')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp</div>
                                                                    </div>
                                                                    <input type="number" class="form-control" id="price" placeholder="Masukkan Harga Paket" name="price" autocomplete="off" value="{{ old('price') ? old('price') : $product->price }}" required>
                                                                </div>
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
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="text-center">Data masih kosong.</td>
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