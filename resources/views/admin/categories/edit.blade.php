@extends('admin.layout')

@section('title', 'Edit Category - Admin')
@section('page-title', 'Edit Category')

@section('admin-content')
<form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Category Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Category Name *</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Current Image</h5>
                </div>
                <div class="card-body">
                    @php $catUrl = $category->url; @endphp
                    @if($catUrl)
                    <img src="{{ $catUrl }}" alt="{{ $category->name }}" class="img-fluid rounded" style="height: 200px; width: 100%; object-fit: cover;">
                    @else
                    <p class="text-muted">No image uploaded</p>
                    @endif
                    
                    <div class="mt-3">
                        <label class="form-label">Upload Local Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <label class="form-label">Or Add Image URL</label>
                        <input type="url" name="image_url" class="form-control" placeholder="https://example.com/image.jpg" value="">
                        <small class="text-muted">Paste online image URL</small>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Status</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ old('status', $category->status) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Active</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-save me-2"></i>Update Category
            </button>
            
            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                Cancel
            </a>
        </div>
    </div>
</form>
@endsection