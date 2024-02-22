@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Data Transaction</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Transaction Code</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $index=>$transaction)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td>{{ $transaction->transaction_code }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td><a href="{{ route(auth()->user()->role.'.transaction.show', $transaction->id) }}" class="btn btn-primary">Detail</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
