@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        @include('layouts.sidebar')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            @if(auth()->user()->role == 'user')
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-3 p-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <img class="w-100" src="{{ empty($product->iamge)? asset('assets/empty.jpg'): asset(Storage::url($product->image)) }}" alt="">
                                    <h5 class="font-weight-bold">{{ $product->name }}</h5>
                                    <strike class="text-danger">Rp{{ number_format($product->strikeout_price) }}</strike>
                                    <p><b>Rp{{ number_format($product->price) }}</b></p>
                                    <a href="{{ route('user.product.checkout', $product->slug) }}" class="btn btn-primary w-100">Beli</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
