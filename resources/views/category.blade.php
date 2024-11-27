@extends('layout.app')
@section('title', 'Category')
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
            <div class="bg-primary text-white card-header ">
                <h5 class="mb-0">
                    Categories List
                    <a href="{{ route('category.create') }}" class="btn btn-warning float-end">Add Category</a>
                </h5>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($category))
                            @foreach ($category as $item)
                                <!-- Example Data -->
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td>{{ $item->category_description }}</td>
                                    <td>
                                        <a href="category/{{ $item->id }}/delete"
                                            class="btn btn-sm btn-danger">Delete</a>
                                        <a href="category/{{ $item->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr align="center">
                                <td colspan="4">
                                    No Records
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
