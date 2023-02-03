<div class="container">
    <div class="row gutters-sm">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Form Petugas</h3>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="makeDataPetugas">
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
                            </div>
                            <div class="col-md-6">
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            placeholder="username Lengkap" required>
                                        @error('username')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" wire:model="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="password" required>
                                        @error('password')
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
