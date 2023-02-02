@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Profile</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

@livewire('profile.show-profile')

@endsection
