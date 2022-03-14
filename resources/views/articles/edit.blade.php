@extends('layouts.master')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Users</h1>
        <a href="{{route('articles.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('articles.update', $article->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group row">

                    {{-- Name --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Libille</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('libille') is-invalid @enderror"
                            id="exampleLibille"
                            placeholder="libille"
                            name="libille"
                            value="{{ old('libille') ? old('libille') : $article->libille }}">

                        @error('libille')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>Description</label>
                        <input type="text"
                            class="form-control form-control-user @error('description') is-invalid @enderror"
                            id="exampleDescription"
                            placeholder="description"
                            name="description"
                            value="{{ old('description') ? old('description') : $article->description }}">

                        @error('description')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
    {{-- Email --}}
    <div class="col-sm-6 mb-3 mb-sm-0">
        <span style="color:red;">*</span>prix_intial</label>
        <input type="text"
            class="form-control form-control-user @error('prix_intial') is-invalid @enderror"
            id="examplePrix_intial"
            placeholder="prix_intial"
            name="prix_intial"
            value="{{ old('prix_intial') ? old('prix_intial') : $article->prix_intial }}">

        @error('prix_intial')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
                </div>
                <div class="from-group">

                    <label for="categorie_id"> categorie</label>
                    <select id="categorie_id" name="categorie_id" class="from-group">

                    <option value="">--Select--</option>
                    @foreach ($categories as $categorie )
                    <option value="{{ $categorie->id }}" {{ $categorie->id == $article->categorie_id ? 'selected':''}}>{{ $categorie->id ==$article->categorie_id ? 'selected':''}} {{ $categorie->libelle }}</option>

                    @endforeach


                    </select>


                                      </div>
                                    </div>
                                    <div class="from-group">

                                        <label for="image_id"> image</label>
                                        <select id="image_id" name="image_id" class="from-group">

                                        <option value="">--Select--</option>
                                        @foreach ($images as $image )
                                        <option value="{{ $image->id }}" {{ $image->id == $article->image_id ? 'selected':''}}>{{ $image->id ==$article->image_id ? 'selected':''}} {{ $image->name }}</option>

                                        @endforeach


                                        </select>


                                                          </div>
                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Update
                </button>

            </form>
        </div>
    </div>

</div>


@endsection
