@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Data Transaksi</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>UUID</th>
                                <th>Username</th>
                                <th>Total</th>
                                <th>TIPE</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>KODE</th>
                                <th>Username</th>
                                <th>Total</th>
                                <th>TIPE</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if ($transactions->count())
                            @foreach ($transactions as $i => $transaction)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $transaction->code }}</td>
                                    <td>{{ $transaction->user->username }}</td>
                                    <td>Rp {{ number_format($transaction->total, 0, '.', '.') }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td class="{{ $transaction->status === 'paid' ? 'text-primary' : ($transaction->status === 'pending' ? 'text-warning' : 'text-danger') }}">{{ $transaction->status === 'paid' ? 'Lunas' : ($transaction->status === 'pending' ? 'Dalam Proses' : 'Batal') }}</td>
                                    <td>{{ $transaction->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $transaction->uuid }}">Detail</button>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="editModal-{{ $transaction->uuid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>UUID : {{ $transaction->uuid }}</div>
                                                        <div>KODE : {{ $transaction->code }}</div>
                                                        <div>USERNAME : {{ $transaction->user->username }}</div>
                                                        <div>EMAIl : {{ $transaction->user->email }}</div>
                                                        @if ($transaction->user->phone)
                                                            <div>NO.HP : {{ $transaction->user->phone }}</div>
                                                        @endif
                                                        @if ($transaction->product)
                                                            <div>NAMA PRODUK : {{ $transaction->product->name }}</div>
                                                        @endif
                                                        @if ($transaction->credit_card)
                                                            <div>NOMOR DANA : {{ $transaction->credit_card }}</div>
                                                        @endif
                                                        <div>TOTAL : Rp{{ number_format($transaction->total, 0, '.', '.') }}</div>
                                                        <div>BIAYA ADMIN : Rp{{ number_format($transaction->biaya_admin, 0, '.', '.') }}</div>
                                                        <div>SUBTOTAL : Rp{{ number_format($transaction->subtotal, 0, '.', '.') }}</div>
                                                        <div>TIPE : {{ $transaction->type }}</div>
                                                        <div>STATUS : {{ $transaction->status }}</div>
                                                        <div>Tanggal : {{ $transaction->created_at->format('d-m-Y H:i:s') }}</div>
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
                                    @if ($transaction->status === "pending")
                                        <button class="btn btn-success" onclick="question('Pembayaran akan dilunaskan!', '/transaction/{{ $transaction->uuid }}/paid')">Selesaikan</button>
                                        <button class="btn btn-danger" onclick="question('Pembayaran akan dibatalkan!', '/transaction/{{ $transaction->uuid }}/unpaid')">Batalkan</button>
                                    @else
                                        <button class="btn btn-danger" onclick="question('Data akan terhapus!', '/transaction/{{ $transaction->uuid }}/{{ $transaction->uuid }}/delete')">Hapus</button>
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