@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Data Transaction</div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td>Buyer</td>
                                <td>: {{ $transaction->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Product</td>
                                <td>: {{ $transaction->product->name }}</td>
                            </tr>
                            <tr>
                                <td>Quantity</td>
                                <td>: {{ $transaction->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>: Rp{{ number_format($transaction->price) }}</td>
                            </tr>
                            <tr>
                                <td>Bank Payment</td>
                                <td>: {{ $transaction->bank->name }} | {{ $transaction->bank->rekening.' a/n '.$transaction->bank->owner }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: {{ $transaction->status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <img src="{{ asset(Storage::url($transaction->proof_of_payment)) }}" alt="there is no proof of payment yet" style="width: 50%">
                        @if(auth()->user()->role == 'user' && ($transaction->status == 'menunggu pembayaran' ||$transaction->status == 'menunggu konfirmasi'))
                            <form action="{{ route('user.transaction.proof', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="proof">Upload Proof of Payment</label>
                                    <input type="file" name="proof" id="proof" class="form-control" accept="image/png, image/gif, image/jpeg" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Upload Proof of Payment</button>
                            </form>
                        @else
                            <div class="row mt-3">
                                <div class="col-6">
                                    <form action="{{ route('admin.transaction.approve', $transaction->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-success w-100">Approve</button>
                                    </form>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('admin.transaction.decline', $transaction->id) }}" method="post">
                                        @csrf
                                        <button class="btn btn-danger w-100">Decline</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
