<div class="col-md-6 mb-3">
    <div class="card">
        <div class="card-header">
            <h3>Form SPP - Update</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent.lazy="updateDataSpp">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mt-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Tahun</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="date" wire:model.lazy="tahun"
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
                                <input type="text" wire:model.lazy="nominal"
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
                            <button wire:click="addSpp()" class="btn btn-secondary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
