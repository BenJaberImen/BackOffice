@extends('layouts.master')

@section('title', 'Add Role')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Role</h1>
        <a href="{{route('configs.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Role</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('configs.store')}}">
                @csrf
                <div class="form-group row">

                 {{-- Name --}}
                 <div class="col-sm-6 mb-3 mb-sm-0">
                    <span style="color:red;">*</span>tag</label>
                    <input
                        type="text"
                        class="form-control form-control-user @error('tag') is-invalid @enderror"
                        id="exampleName"
                        placeholder="tag"
                        name="tag"
                       >

                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <span style="color:red;">*</span>valeur</label>
                    <input
                        type="text"
                        class="form-control form-control-user @error('valeur') is-invalid @enderror"
                        id="exampleName"
                        placeholder="valeur"
                        name="valeur">

                </div>


                <div class="col-sm-6 mb-3 mb-sm-0">
                    <span style="color:red;">*</span>description</label>
                    <input
                        type="text"
                        class="form-control form-control-user @error('description') is-invalid @enderror"
                        id="exampleDescription"
                        placeholder="description"
                        name="description"
                        >


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
