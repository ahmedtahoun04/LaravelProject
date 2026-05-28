@extends('layouts.admin')

@section('title') Add Product @endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label>Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control">
                        <option value="">— Select Category —</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Title <span class="text-danger">*</span></label>
                    <input type="text" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug') }}">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price') }}">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock"
                                   class="form-control @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', 0) }}">
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Discount %</label>
                            <input type="number" name="discount"
                                   class="form-control"
                                   value="{{ old('discount', 0) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control-file" accept="image/*">
                    <small class="text-muted">Max size: 2MB</small>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Save Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

@endsection