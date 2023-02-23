@extends('layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

@endpush

@section('content')
<div class="container">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h3>Table Data Transaksi</h3>
                @php
                    $datas = [];
                @endphp
                @foreach ($transaksi as $data)
                @php
                    array_push($datas, $data->nisn, $data->tahun);
                @endphp
                @endforeach
                <form action="/home/home/transaksi-to-pdf/{{ $datas[0] }}/{{ $datas[1]}}" method="get">
                    <div class="row mt-3">
                        <div class="col-auto">
                            <button stype="submit" class="btn btn-info"><i class="fas fa-download"></i> Export PDF</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Nama Pengelola</th>
                            <th scope="col">Nama Siswa</th>
                            <th scope="col">Tanggal Bayar</th>
                            <th scope="col">Bulan Bayar</th>
                            <th scope="col">Tahun Bayar</th>
                            <th scope="col">Jumah Bayar</th>
                            <th scope="col">Data SPP</th>
                            <th scope="col">Tunggakan Perbulan</th>
                            <th scope="col">Tunggakan Pertahun</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                            <th scope="col">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 0;
                        @endphp
                        @foreach ($transaksi as $key => $dataTransaksi)
                            <tr>
                                <th scope="row">{{ $key += $transaksi->firstItem() }}</th>
                                <td>{{ $dataTransaksi->nisn }}</td>
                                <td>{{ $dataTransaksi->nama_pengelola }}</td>
                                <td>{{ $dataTransaksi->nama_siswa }}</td>
                                <td>{{ $dataTransaksi->tgl_dibayar }}</td>
                                <td>{{ $dataTransaksi->bln_dibayar }}</td>
                                <td>{{ $dataTransaksi->thn_dibayar }}</td>
                                <td>{{ $dataTransaksi->jumlah_bayar }}</td>
                                <td>{{ $dataTransaksi->tahun . " - Rp." . $dataTransaksi->nominal }}</td>
                                <td>{{ "Rp." . $dataTransaksi->nominal - $dataTransaksi->jumlah_bayar }}</td>
                                <td>{{ "Rp." . $dataTransaksi->total_bayar }}</td>
                                <td>{{ $dataTransaksi->created_at }}</td>
                                <td>{{ $dataTransaksi->updated_at }}</td>
                                @if ($dataTransaksi->status_pembayaran == 1)
                                    <td>
                                        <button disabled class="btn-sm btn-primary"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Lunas</button>
                                    </td>
                                @elseif ($dataTransaksi->status_pembayaran == 0)
                                    <td>
                                        <button disabled class="btn-sm btn-warning"
                                            style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Belum Lunas</button>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                </table>
                <div class="mt-2">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

<script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif

    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}")
    @endif

    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}")
    @endif
</script>
@endpush
