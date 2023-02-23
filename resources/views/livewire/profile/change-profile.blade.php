@push('css')
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 50px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 50px;
            /* Full width */
            height: 50px;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 50%;
            max-width: 500px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 500px) {
            .modal-content {
                width: 50%;
            }
        }
    </style>
@endpush


<div class="container">
    <div class="main-body">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">

                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                                <div>
                                    <span class="close">&times;</span>
                                </div>

                                <img class="modal-content" id="img01">
                                <div id="caption"></div>
                            </div>


                            @if (Auth::user()->photo == null)
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="img" class="rounded-circle"
                                        height="150px" width="150" id="myImg">
                                @else
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="img" class="rounded-circle" height="150px"
                                        width="150" id="myImg">
                                @endif

                            @endif
                            @if (Auth::user()->photo != null)
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" alt="img" class="rounded-circle"
                                        height="150px" width="150" id="myImg">
                                @else
                                    <img src="{{ asset('storage/profile/' . Auth::user()->photo) }}" alt="img"
                                        class="rounded-circle" height="150px" width="150" id="myImg">
                                @endif

                            @endif

                            <form wire:submit.prevent="updateImage" class="form-group mt-3">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="file" wire:model="photo" class="form-control"
                                            accept=".png, .jpg, .jpeg">
                                    </div>
                                    <div class="col">
                                        <button type="submit" wire:click="changeImg" class="btn btn-secondary">
                                            <div wire:loading wire:target="changeImg">
                                                <div class="la-line-scale">
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                    <div></div>
                                                </div>
                                            </div>
                                            change
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <form wire:submit.prevent="deleteImage" class="form-group mt-3">
                                <div class="row">
                                    <div class="col">
                                        <div wire:loading wire:target="deleteImg">
                                            <div class="la-line-scale la-dark">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" wire:click="deleteImg" class="btn btn-danger">
                                            delete
                                        </button>
                                    </div>
                                </div>
                            </form>


                            <script>
                                // Get the modal
                                var modal = document.getElementById("myModal");

                                // Get the image and insert it inside the modal - use its "alt" text as a caption
                                var img = document.getElementById("myImg");
                                var modalImg = document.getElementById("img01");
                                img.onclick = function() {
                                    modal.style.display = "block";
                                    modalImg.src = this.src;
                                }

                                // Get the <span> element that closes the modal
                                var span = document.getElementsByClassName("close")[0];

                                // When the user clicks on <span> (x), close the modal
                                span.onclick = function() {
                                    modal.style.display = "none";
                                }
                            </script>

                            <div class="mt-3">
                                <h4>{{ $name }}</h4>
                                <p class="text-secondary mb-1">{{ $email }}
                                    <p class="text-muted font-size-sm">{{ $level }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-globe mr-2 icon-inline">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                    </path>
                                </svg>Website</h6>
                            <span class="text-secondary"><a
                                    href="#">https://www.SPP-smkn1katapang-bdg.id</a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-github mr-2 icon-inline">
                                    <path
                                        d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                    </path>
                                </svg>Github</h6>
                            <span class="text-secondary"><a
                                    href="#">https://github.com/AbdulMalikMuzakir404</a></span>
                        </li>
                    </ul>
                </div>
            </div>



            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <form action="" wire:submit.prevent="changeProfile" class="form-group">

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" wire:model="name"
                                        class="form-control @error('name') is-invalid @enderror" placeholder=""
                                        disabled required>
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="email" wire:model="email"
                                        class="form-control @error('email') is-invalid @enderror" placeholder="" required>
                                    @error('email')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" wire:model="username"
                                        class="form-control @error('username') is-invalid @enderror" placeholder="" disabled required>
                                    @error('username')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Level</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" wire:model="level"
                                        class="form-control @error('level') is-invalid @enderror" placeholder="" disabled required>
                                    @error('level')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" wire:click="submitCPro" class="btn btn-info">
                                        <div wire:loading wire:target="submitCPro">
                                            <div class="la-ball-fall">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                        Save and Change
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <form wire:submit.prevent="updatePassword" class="form-group">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password Lama</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" wire:model="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            placeholder="Password Lama" required>
                                        @error('old_password')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password Baru</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" wire:model="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password Baru" required>
                                        @error('password')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <hr>
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirm Password Baru</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" wire:model="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Confirm Password Baru" required>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" wire:click="submitCPass" class="btn btn-info">
                                        <div wire:loading wire:target="submitCPass">
                                            <div class="la-ball-fall">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                        Save and Change
                                    </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
