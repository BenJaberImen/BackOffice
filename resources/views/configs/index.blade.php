@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Config Table</h3>

        <div class="card-tools">
            <a href="{{ route('configs.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new Config</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tag</th>
                    <th>valeur</th>
                    <th>description</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($configs as $config)
                    <tr>
                        <td>{{ $config->id }}</td>
                        <td>{{ $config->tag }}</td>
                        <td>{{ $config->valeur }}</td>
                        <td>{{ $config->description }}</td>
                        <td>{{ $config->created_at }}</td>
                        <td>
                            <a href="{{ route('configs.edit', $config->id) }}" class="btn btn-sm btn-warning">Edit Config</a>
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
