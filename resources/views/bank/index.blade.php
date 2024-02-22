@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">
                <a href="{{ route('admin.bank.create') }}" class="btn btn-success mb-3">Create</a>
                <div class="card">
                    <div class="card-header">Data Bank</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Owner</th>
                                <th scope="col">Rekening</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($banks as $index=>$bank)
                                <tr>
                                    <th scope="row">{{ $index+1 }}</th>
                                    <td><img src="{{ asset(Storage::url($bank->image)) }}" style="width: 30px" alt=""> {{ $bank->name }}</td>
                                    <td>{{ $bank->owner }}</td>
                                    <td>{{ $bank->rekening }}</td>
                                    <td>
                                        <a href="{{ route('admin.bank.edit', $bank->id) }}" class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger">Delete</button>
                                    </td>
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
