<div class="container">
    <div class="row gutters-sm">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form SPP</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="makeDataSpp">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tahun</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="date" wire:model="tahun"
                                            class="form-control @error('tahun') is-invalid @enderror" placeholder="tahun Address"
                                            required>
                                        @error('tahun')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nominal</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="nominal"
                                            class="form-control @error('nominal') is-invalid @enderror"
                                            placeholder="Nominal" required>
                                        @error('nominal')
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

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form Kelas</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="makeDataKelas">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Kelas</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="nama_kelas"
                                            class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="Nama Kelas"
                                            required>
                                        @error('nama_kelas')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Kopetensi Keahlian</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select aria-label="Default select example" wire:model="kopetensi_keahlian"
                                            class="@error('kopetensi_keahlian') is-invalid @enderror form-select"
                                            value="{{ old('kopetensi_keahlian') }}" required>
                                            <option disabled="disabled" selected="selected">Kopetensi Keahlian</option>
                                            <option value="rpl">rpl</option>
                                            <option value="mm">mm</option>
                                            <option value="tkj">tkj</option>
                                        </select>
                                        @error('kopetensi_keahlian')
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
