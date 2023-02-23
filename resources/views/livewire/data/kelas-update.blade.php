<div class="col-md-6 mb-3">
    <div class="card">
        <div class="card-header">
            <h3>Form Kelas - Update</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent.lazy="updateDataKelas">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Nama Kelas</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" wire:model.lazy="nama_kelas"
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
                                <select aria-label="Default select example" wire:model.lazy="kopetensi_keahlian"
                                    class="@error('kopetensi_keahlian') is-invalid @enderror form-select"
                                    value="{{ old('kopetensi_keahlian') }}" required>
                                    <option disabled="disabled" selected="selected">Kopetensi Keahlian</option>
                                    <option value="RPL - 1">RPL - 1</option>
                                    <option value="RPL - 2">RPL - 2</option>
                                    <option value="MM">MM</option>
                                    <option value="TKJ">TKJ</option>
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
                            <button type="submit" wire:click="submit" class="btn btn-info">
                                <div wire:loading wire:target="submit">
                                    <div class="la-ball-fall">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                                Save and Change
                            </button>
                            <button wire:click="addKelas()" class="btn btn-secondary"><i class="bi bi-plus-square"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
