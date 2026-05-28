@extends('layouts.admin')

@section('title') Edit Product @endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Title <span class="text-danger">*</span></label>
                    <input type="text" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $product->title) }}">
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Slug <span class="text-danger">*</span></label>
                    <input type="text" name="slug"
                           class="form-control @error('slug') is-invalid @enderror"
                           value="{{ old('slug', $product->slug) }}">
                    @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price"
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $product->price) }}">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock"
                                   class="form-control @error('stock') is-invalid @enderror"
                                   value="{{ old('stock', $product->stock) }}">
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Discount %</label>
                            <input type="number" name="discount"
                                   class="form-control"
                                   value="{{ old('discount', $product->discount) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="image" class="form-control-file" accept="image/*">
                    {{-- Show current image if exists --}}
                    @if ($product->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 width="100" class="rounded border">
                            <small class="text-muted d-block">Current image</small>
                        </div>
                    @endif
                    <small class="text-muted">Leave empty to keep current image.</small>
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save mr-1"></i> Update Product
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

@endsection