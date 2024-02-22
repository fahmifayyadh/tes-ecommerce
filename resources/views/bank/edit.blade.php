@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                @include('layouts.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data Bank</div>

                    <div class="card-body">
                        <form action="{{ route('admin.bank.update', $bank->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required
                                       value="{{ old('name') ?: $bank->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image" class="form-control"
                                       accept="image/png, image/gif, image/jpg" required>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="owner">Owner</label>
                                <input type="text" name="owner" id="owner" class="form-control" required
                                       value="{{ old('owner')?: $bank->owner }}">
                                @error('owner')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="rekening">Rekening</label>
                                <input type="text" name="rekening" id="rekening" class="form-control"
                                       value="{{ old('rekening')?: $bank->rekening }}" required>
                                @error('rekening')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
