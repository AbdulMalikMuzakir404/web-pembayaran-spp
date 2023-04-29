<div class="container">
    <div class="row gutters-sm">

        @canany('pengelola')
        @if ($status_transaksi)
            @livewire('transaksi.update-transaksi')
        @else
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3>Form Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent.lazy="makeDataTransaksi">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">NISN</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="nisn"
                                                class="@error('nisn') is-invalid @enderror form-select"
                                                value="{{ old('nisn') }}" required>
                                                <option selected="selected">NISN</option>
                                                @foreach ($datas as $data)
                                                    <option value="{{ $data->nisn }}">
                                                        {{ $data->nisn . ' - ' . $data->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('nisn')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Siswa</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="name"
                                                class="@error('name') is-invalid @enderror form-select"
                                                value="{{ old('name') }}" required>
                                                <option selected="selected">Nama Siswa</option>
                                                @foreach ($datas as $data)
                                                    <option value="{{ $data->name }}">
                                                        {{ $data->name . ' - ' . $data->nisn }}</option>
                                                @endforeach
                                            </select>
                                            @error('name')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">SPP ID</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="spp_id"
                                                class="@error('spp_id') is-invalid @enderror form-select"
                                                value="{{ old('spp_id') }}" required>
                                                <option selected="selected">SPP ID</option>
                                                @foreach ($dataSpp as $spp)
                                                    <option value="{{ $spp->id }}">
                                                        {{ $spp->tahun . ' - Rp.' . $spp->nominal }}</option>
                                                @endforeach
                                            </select>
                                            @error('spp_id')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tanggal Bayar</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="tgl_dibayar"
                                                class="@error('tgl_dibayar') is-invalid @enderror form-select"
                                                value="{{ old('tgl_dibayar') }}" required>
                                                <option selected="selected">Tanggal</option>
                                                @for ($tanggal = 1; $tanggal <= 31; $tanggal++)
                                                    <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                                                @endfor
                                            </select>
                                            @error('tgl_dibayar')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Bulan Bayar</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="bln_dibayar"
                                                class="@error('bln_dibayar') is-invalid @enderror form-select"
                                                value="{{ old('bln_dibayar') }}" required>
                                                <option selected="selected">Bulan</option>
                                                @php
                                                    $data = ['January', 'February', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                @endphp
                                                @foreach ($data as $bln)
                                                    <option value="{{ $bln }}">{{ $bln }}</option>
                                                @endforeach
                                            </select>
                                            @error('bln_dibayar')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Tahun Bayar</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <select aria-label="Default select example" wire:model.lazy="thn_dibayar"
                                                class="@error('thn_dibayar') is-invalid @enderror form-select"
                                                value="{{ old('thn_dibayar') }}" required>
                                                <option selected="selected">Tahun</option>
                                                @for ($tahun = date('Y'); $tahun >= 2000; $tahun--)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endfor
                                            </select>
                                            @error('thn_dibayar')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Jumlah Bayar</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" wire:model.lazy="jumlah_bayar"
                                                class="form-control @error('jumlah_bayar') is-invalid @enderror"
                                                placeholder="Jumlah Bayar" required>
                                            @error('jumlah_bayar')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <button type="submit" wire:click="submit" class="btn btn-info">
                                            <div wire:loading wire:target="submit">
                                                <div class="la-ball-fall">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        @endcanany

        @can('pengelola')
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Table Data Transaksi</h3>
                    <div class="row mt-3">
                        <div class="col">
                            <select wire:model="paginate" class="form-control-sm w-auto">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                            </select>
                        </div>
                        <div class="col">
                            <select wire:model="status_pembayaran" class="form-control-sm w-auto">
                                <option value="1">lunas</option>
                                <option value="0">belum lunas</option>
                            </select>
                        </div>
                        <div class="col">
                            <input wire:model="search" type="text" class="form-control w-auto" placeholder="Seacrh">
                        </div>
                    </div>
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($transaksi as $dataTransaksi)
                                @php
                                    $no++;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $no }}</th>
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
                                    <td>
                                        {{-- <button wire:click="updateStatus({{ '\'' . $dataTransaksi->nisn . "-" . $dataTransaksi->tgl_dibayar . "-" . $dataTransaksi->bln_dibayar . "-" . $dataTransaksi->thn_dibayar . '\'' }})"
                                            class="btn btn-secondary btn-sm"><i
                                                class="bi bi-calendar2-check"></i></button> --}}
                                        <button wire:click="getIdTransaksi({{ '\'' . $dataTransaksi->nisn . "-" . $dataTransaksi->tgl_dibayar . "-" . $dataTransaksi->bln_dibayar . "-" . $dataTransaksi->thn_dibayar . '\'' }})"
                                            class="btn btn-primary btn-sm"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button wire:click="deleteTransaksi({{ '\'' . $dataTransaksi->tgl_dibayar . "-" . $dataTransaksi->bln_dibayar . "-" . $dataTransaksi->thn_dibayar . '\'' }})"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </td>
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
        @endcan
    </div>
</div>
