@extends('layouts.app')

@section('title', 'Edit Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Advanced Forms</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Forms</a></div>
                    <div class="breadcrumb-item">Products</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Products</h2>



                <div class="card">
                    <form action="{{ route('product.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Input Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('name')
                                is-invalid
                            @enderror"
                                    name="name" value="{{ $product->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Price</label>
                                <input type="number"
                                    class="form-control @error('price')
                                is-invalid
                            @enderror"
                                    name="price" value="{{ $product->price }}">
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-control selectric">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @if ($item->id == $product->category_id)
                                            selected
                                        @endif  >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Is Available</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_available" value="true" class="selectgroup-input"
                                        @if ($product->is_available == 1)
                                            checked=""
                                        @endif>
                                        <span class="selectgroup-button">YES</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="is_available" value="false" class="selectgroup-input"
                                        @if ($product->is_available == 0)
                                            checked=""
                                        @endif>
                                        <span class="selectgroup-button">NO</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>
@endpush
