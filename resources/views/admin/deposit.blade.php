@extends('layouts.admin')
@section('container')
<div id="content">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Data Transaksi Deposit</h1>

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
                            @if ($deposits->count())
                            @foreach ($deposits as $i => $deposit)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $deposit->code }}</td>
                                    <td>{{ $deposit->user->username }}</td>
                                    <td>Rp {{ number_format($deposit->total, 0, '.', '.') }}</td>
                                    <td class="{{ $deposit->status === 'paid' ? 'text-primary' : ($deposit->status === 'unpaid' ? 'text-warning' : 'text-danger') }}">{{ $deposit->status === 'paid' ? 'Lunas' : ($deposit->status === 'unpaid' ? 'Dalam Proses' : 'Batal') }}</td>
                                    <td>{{ $deposit->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $deposit->uuid }}">Detail</button>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="editModal-{{ $deposit->uuid }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div>UUID : {{ $deposit->uuid }}</div>
                                                        <div>KODE : {{ $deposit->code }}</div>
                                                        <div>USERNAME : {{ $deposit->user->username }}</div>
                                                        <div>EMAIl : {{ $deposit->user->email }}</div>
                                                        @if ($deposit->user->phone)
                                                            <div>NO.HP : {{ $deposit->user->phone }}</div>
                                                        @endif
                                                        @if ($deposit->product)
                                                            <div>NAMA PRODUK : {{ $deposit->product->name }}</div>
                                                        @endif
                                                        @if ($deposit->credit_card)
                                                            <div>NOMOR DANA : {{ $deposit->credit_card }}</div>
                                                        @endif
                                                        <div>TOTAL : Rp{{ number_format($deposit->total, 0, '.', '.') }}</div>
                                                        <div>BIAYA ADMIN : Rp{{ number_format($deposit->biaya_admin, 0, '.', '.') }}</div>
                                                        <div>SUBTOTAL : Rp{{ number_format($deposit->subtotal, 0, '.', '.') }}</div>
                                                        <div>TIPE : {{ $deposit->type }}</div>
                                                        <div>STATUS : {{ $deposit->status }}</div>
                                                        <div>Tanggal : {{ $deposit->created_at->format('d-m-Y H:i:s') }}</div>
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
                                    @if ($deposit->status === "pending")
                                        <button class="btn btn-success" onclick="question('Pembayaran akan dilunaskan!', '/transaction/{{ $deposit->uuid }}/paid')">Selesaikan</button>
                                        <button class="btn btn-danger" onclick="question('Pembayaran akan dibatalkan!', '/transaction/{{ $deposit->uuid }}/unpaid')">Batalkan</button>
                                    @else
                                        <button class="btn btn-danger" onclick="question('Data akan terhapus!', '/transaction/{{ $deposit->uuid }}/delete')">Hapus</button>
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