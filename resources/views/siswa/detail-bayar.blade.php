@extends('layouts.app')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
@endpush

@section('content')
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Detail Bayar</h2>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Detail Bayar</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

    <div class="container text-center">

        <div class="row gutters-sm">

            @foreach ($data as $dataSpp)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <p>{{ "Rp." . $dataSpp->nominal }}</p>
                            <p>{{ $dataSpp->tahun }}</p>
                            <p>{{ $dataSpp->created_at }}</p>
                            <form action="{{ route('dataBayarDetail', $dataSpp->id) }}">
                                <button type="submit" id="pay-button" class="btn btn-primary btn-sm">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        </div>
    @endsection
@push('js')
<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

        <script type="text/javascript">
            // For example trigger on button clicked, or any time you need
            var payButton = document.getElementById('pay-button');
            payButton.addEventListener('click', function () {
              // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
              window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                  /* You may add your own implementation here */
                  alert("payment success!"); console.log(result);
                },
                onPending: function(result){
                  /* You may add your own implementation here */
                  alert("wating your payment!"); console.log(result);
                },
                onError: function(result){
                  /* You may add your own implementation here */
                  alert("payment failed!"); console.log(result);
                },
                onClose: function(){
                  /* You may add your own implementation here */
                  alert('you closed the popup without finishing the payment');
                }
              })
            });
    </script>
@endpush
