@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Data Transaksi Withdraw</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Username</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Username</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($withdraws->count())
                            @foreach ($withdraws as $i => $withdraw)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $withdraw->code }}</td>
                                    <td>{{ $withdraw->user->username }}</td>
                                    <td>Rp {{ number_format($withdraw->total, 0, '.', '.') }}</td>
                                    <td class="{{ $withdraw->status === 'paid' ? 'text-primary' : ($withdraw->status === 'unpaid' ? 'text-warning' : 'text-danger') }}">{{ $withdraw->status === 'paid' ? 'Lunas' : ($withdraw->status === 'unpaid' ? 'Dalam Proses' : 'Batal') }}</td>
                                    <td>{{ $withdraw->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $withdraw->uuid }}">Detail</button>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="editModal-{{ $withdraw->uuid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>UUID : {{ $withdraw->uuid }}</div>
                                                        <div>KODE : {{ $withdraw->code }}</div>
                                                        <div>USERNAME : {{ $withdraw->user->username }}</div>
                                                        <div>EMAIl : {{ $withdraw->user->email }}</div>
                                                        @if ($withdraw->user->phone)
                                                            <div>NO.HP : {{ $withdraw->user->phone }}</div>
                                                        @endif
                                                        @if ($withdraw->product)
                                                            <div>NAMA PRODUK : {{ $withdraw->product->name }}</div>
                                                        @endif
                                                        @if ($withdraw->credit_card)
                                                            <div>NOMOR DANA : {{ $withdraw->credit_card }}</div>
                                                        @endif
                                                        <div>TOTAL : Rp{{ number_format($withdraw->total, 0, '.', '.') }}</div>
                                                        <div>BIAYA ADMIN : Rp{{ number_format($withdraw->biaya_admin, 0, '.', '.') }}</div>
                                                        <div>SUBTOTAL : Rp{{ number_format($withdraw->subtotal, 0, '.', '.') }}</div>
                                                        <div>TIPE : {{ $withdraw->type }}</div>
                                                        <div>STATUS : {{ $withdraw->status }}</div>
                                                        <div>Tanggal : {{ $withdraw->created_at->format('d-m-Y H:i:s') }}</div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Modal --}}
                                    </td>
                                    <td>
                                    @if ($withdraw->status === "pending")
                                        <button class="btn btn-success" onclick="question('Pembayaran akan dilunaskan!', '/transaction/{{ $withdraw->uuid }}/paid')">Selesaikan</button>
                                        <button class="btn btn-danger" onclick="question('Pembayaran akan dibatalkan!', '/transaction/{{ $withdraw->uuid }}/unpaid')">Batalkan</button>
                                    @else
                                        <button class="btn btn-danger" onclick="question('Data akan terhapus!', '/transaction/{{ $withdraw->uuid }}/delete')">Hapus</button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Data masih kosong.</td>
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