<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">
        {{-- Flash Messages --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        ✅ {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        ❌ {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
        
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Categories</h2>
           <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
    + Add Category
</a>
        </div>

        <!-- Categories Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->title }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>
                                    @if ($category->parent)
                                        {{ $category->parent->title }}
                                    @else
                                        <span class="text-muted">— Root —</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($category->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                   <a href="{{ route('admin.categories.show', $category->id) }}" 
   class="btn btn-sm btn-info">View</a>

<a href="{{ route('admin.categories.edit', $category->id) }}" 
   class="btn btn-sm btn-warning">Edit</a>

<form action="{{ route('admin.categories.destroy', $category->id) }}" 
      method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" 
            class="btn btn-sm btn-danger"
            onclick="return confirm('Are you sure you want to delete this category?')">
        Delete
    </button>
</form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No categories found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total -->
        <div class="mt-3 text-muted">
            Total: <strong>{{ $categories->count() }}</strong> categories
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>