@extends('layouts.app')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0">Create Data Petugas</h2>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Create Data Petugas</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

@livewire('data.make-petugas')

@endsection
