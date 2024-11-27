@extends('layout.app')
@section('title', 'Add Category')
@section('main')
    <div class="mt-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Add New Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <!-- Category Name -->
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" value="{{ old('category_name') }}" id="categoryName"
                            placeholder="Enter category name" name="category_name">
                        @error('category_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category Description -->
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Category Description</label>
                        <textarea class="form-control" id="categoryDescription" name="category_description" rows="4"
                            placeholder="Enter category description">{{ old('category_description') }}</textarea>
                        @error('category_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Save Category</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
