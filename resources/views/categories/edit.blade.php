
@extends('layouts.master')

@section('title', 'Edit Categorie')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Categorie</h1>
        <a href="{{route('categories.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Categorie</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update',$categorie->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Libelle</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('libelle') is-invalid @enderror"
                            id="exampleLibelle"
                            placeholder="libelle"
                            name="libelle"
                            value="{{ old('libelle') ? old('libelle') : $categorie->libelle }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Description  --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Description</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('description') is-invalid @enderror"
                            id="exampleDescription"
                            placeholder="description"
                            name="description"
                            value="{{ old('description') ? old('description') : $categorie->description }}">

                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Post Image:</strong>
                             <input type="file" name="image" class="form-control" placeholder="Post Title">
                            @error('image')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="form-group">
                          <img src="{{ Storage::url($categorie->image) }}" height="200" width="200" alt="" />
                        </div>
                    </div>

                          <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </form>
        </div>
    </div>

</div>


@endsection
