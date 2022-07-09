@extends('layout.base')

@section('content')
    <form action="{{ route('counter') }}" method="post" id="form-counter">
        @csrf
        <h3>Person 1</h3>
        <div class="mb-3 row">
            <label for="" class="col-sm-4 col-form-label">Age of death</label>
            <div class="col-sm-8">
                <input type="number" name="p1_aod" class="form-control" id="p1_aod" value="{{ @old('p1_aod') }}">
                @error('p1_aod')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label for="" class="col-sm-4 col-form-label">Year of death</label>
            <div class="col-sm-8">
                <input type="number" name="p1_yod" class="form-control" id="p1_yod" value="{{ @old('p1_aod') }}">
                @error('p1_yod')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <h3>Person 2</h3>
        <div class="mb-3 row">
            <label for="" class="col-sm-4 col-form-label">Age of death</label>
            <div class="col-sm-8">
                <input type="number" name="p2_aod" class="form-control" id="p2_aod" value="{{ @old('p2_aod') }}">
                @error('p2_aod')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="mb-4 row">
            <label for="" class="col-sm-4 col-form-label">Year of death</label>
            <div class="col-sm-8">
                <input type="number" name="p2_yod" class="form-control" id="p2_yod" value="{{ @old('p2_aod') }}">
                @error('p2_yod')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        @if (session('result'))
        <div id="result" class="mb-4">
            <div class="alert alert-info" id="result-text">{{ session('result') }}</div>
        </div>
        @endif

        <div class="d-block text-end">
            <button type="submit" class="btn btn-primary btn-submit">Get Average</button>
            <button type="reset" class="btn btn-warning btn-reset">Reset</button>
        </div>
    </form>
@endsection