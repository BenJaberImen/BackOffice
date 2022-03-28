@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Categorie Table</h3>

        <div class="card-tools">
            <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new Categorie</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Libille</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $categorie)
                    <tr>

                        <td>{{ ++$i }}</td>
                        <td><img src="/image/{{ $categorie->image }}" width="100px"></td>
                        <td>{{ $categorie->libelle }}</td>
                        <td>{{ $categorie->description }}</td>
                        <td>
                            <form action="{{ route('categories.destroy',$categorie->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('categories.show',$categorie->id) }}">Show</a>
                            <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-sm btn-warning">Edit</a>
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
