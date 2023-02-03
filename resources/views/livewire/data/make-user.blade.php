<div class="container">
    <div class="row gutters-sm">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form Siswa</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="makeDataSiswa">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" wire:model="email"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email Address"
                                            required>
                                        @error('email')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">NISN</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="nisn"
                                            class="form-control @error('nisn') is-invalid @enderror" placeholder="NISN"
                                            required>
                                        @error('nisn')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">NIS</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="nis"
                                            class="form-control @error('nis') is-invalid @enderror" placeholder="NIS"
                                            required>
                                        @error('nis')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Spp Id</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select aria-label="Default select example" wire:model="spp_id"
                                            class="@error('spp_id') is-invalid @enderror form-select"
                                            value="{{ old('spp_id') }}" required>
                                            <option selected="selected">SPP ID</option>
                                            @foreach ($spp as $data)
                                            <option value="{{ $data->id }}">{{ $data->id . " - " . $data->tahun . " - Rp." . $data->nominal }}</option>
                                            @endforeach
                                        </select>
                                        @error('kopetensi_keahlian')
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
                                        <h6 class="mb-0">Kelas Id</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select aria-label="Default select example" wire:model="ruang_id"
                                            class="@error('ruang_id') is-invalid @enderror form-select"
                                            value="{{ old('ruang_id') }}" required>
                                            <option selected="selected">KELAS ID</option>
                                            @foreach ($ruang as $data)
                                            <option value="{{ $data->id }}">{{ $data->id . " - " . $data->nama_kelas . " - " . $data->kopetensi_keahlian }}</option>
                                            @endforeach
                                        </select>
                                        @error('kopetensi_keahlian')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Lengkap</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="nama"
                                            class="form-control @error('nama') is-invalid @enderror"
                                            placeholder="Nama Lengkap" required>
                                        @error('nama')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="no_telp"
                                            class="form-control @error('no_telp') is-invalid @enderror"
                                            placeholder="+62 xxx xxxx xxxx" required>
                                        @error('no_telp')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea wire:model="alamat" class="form-control @error('email') is-invalid @enderror" cols="30" rows="3"
                                            required placeholder="Alamat"></textarea>
                                        @error('alamat')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info">Save and Change</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
