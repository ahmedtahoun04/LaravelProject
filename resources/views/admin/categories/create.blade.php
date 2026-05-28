@extends('layouts.admin')

@section('title') Add Category @endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
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
                    <label>Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">— No Parent (Root) —</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
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

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Save Category
                </button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>

@endsection