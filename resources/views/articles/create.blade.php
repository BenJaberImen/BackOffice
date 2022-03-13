@extends('layouts.master')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Article</h1>
        <a href="{{route('articles.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Article</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('articles.store')}}">
                @csrf
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
                            value="{{ old('libille') }}">

                        @error('libille')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <span style="color:red;">*</span>description</label>
                        <input type="text"
                            class="form-control form-control-user @error('description') is-invalid @enderror"
                            id="exampleDescription"
                            placeholder="description"
                            name="description"
                            value="{{ old('description') }}">

                        @error('description')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <span style="color:red;">*</span>prix_intial</label>
                    <input type="text"
                        class="form-control form-control-user @error('prix_intial') is-invalid @enderror"
                        id="examplePrix_intial"
                        placeholder="prix_intial"
                        name="prix_intial"
                        value="{{ old('prix_intial') }}">

                    @error('prix_intial')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

            </div>

  {{-- Role --}}
                  <div class="from-group">

<label for="categorie_id"> categorie</label>
<select id="categorie_id" name="categorie_id" class="from-group">

<option value="">--Select--</option>
@foreach ($categories as $categorie )
<option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>

@endforeach


</select>


                  </div>

                {{-- Save Button --}}
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Save
                </button>

            </form>
        </div>
    </div>

</div>


@endsection
