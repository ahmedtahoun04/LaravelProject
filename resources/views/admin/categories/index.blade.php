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
        
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Categories</h2>
            <a href="#" class="btn btn-primary">+ Add Category</a>
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
                                    <a href="#" class="btn btn-sm btn-info">View</a>
                                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
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

</body>
</html>