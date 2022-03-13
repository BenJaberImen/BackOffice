@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Image Table</h3>

        <div class="card-tools">
            <a href="{{ route('images.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new <i class="fas fa-images    "></i></a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>name</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($images as $image)
                    <tr>

                        <td>{{ ++$i }}</td>
                        <td><img src="/image/{{ $image->image }}" width="100px"></td>
                        <td>{{ $image->name }}</td>

                        <td>
                            <form action="{{ route('images.destroy',$image->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('images.show',$image->id) }}">Show</a>
                            <a href="{{ route('images.edit', $image->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </td>

                    </tr>
                @empty
                    <tr>No Result Found</tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
  </div>


@endsection
