@extends('layouts.master')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Article</h1>
        
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Article</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @csrf
        				 <input type="text" name="libille" class="form-control m-2" placeholder="libille">
        				 <input type="text" name="description" class="form-control m-2" placeholder="description">
                         <input name="prix_intial" cols="20" rows="4" class="form-control m-2" placeholder="prix_intial">
                         <label class="m-2">Cover Image</label>
                         <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="cover">

                         <label class="m-2">Images</label>
                         <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]" multiple>


  {{-- categorie--}}
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
