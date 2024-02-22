@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checkout</div>
                    <div class="card-body">
                        <div class="card">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ empty($product->iamge)? asset('assets/empty.jpg'): asset(Storage::url($product->image)) }}" class="w-100" alt="">
                                </div>
                                <div class="col-9">
                                    <h4 class="mt-3">{{ $product->name }}</h4>
                                    <p class="text-danger"><strike>Rp{{ number_format($product->strikeout_price) }}</strike></p>
                                    <h5>Rp{{ number_format($product->price) }}</h5>
                                    <h4><b>Total yang harus dibayar : <span>Rp 23.234</span></b></h4>
                                </div>
                            </div>
                            <div class="container">
                                <form action="{{ route('user.product.checkout.buy', $product->slug) }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="quantity">Quantity Product</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="bank">Bank Payment</label>
                                        <select name="bank" id="bank" class="form-control" required>
                                            <option value="">--</option>
                                            @foreach($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="w-100 btn btn-primary mt-3 mb-3">Buy Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
