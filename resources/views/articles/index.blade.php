@extends('layouts.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Article</h1>
        <a href="{{route('articles.create')}}" class="btn btn-sm btn-primary" >
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Article</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Libille</th>
                            <th>description</th>
                            <th>prix initial</th>
                            <th>categorie</th>
                            <th>image</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($articles as $article)
                           <tr>
                               <td>{{$article->libille}}</td>
                               <td>{{$article->description}}</td>

                               <td> {{$article->prix_intial}} DT </td>

                               <td>{{ $article->categorie->libelle }}</td>
                               <td><img src="/image/{{ $article->image->image }}" width="100px"></td>
                                <td>
                                    <form action="{{ route('articles.destroy',$article->id) }}" method="POST">

                                    <a href="{{ route('articles.edit',['article' => $article->id])  }}" class="btn btn-sm btn-warning">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>

                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
