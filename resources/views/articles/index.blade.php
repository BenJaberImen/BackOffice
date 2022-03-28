@extends('layouts.master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Article</h1>
        <div class="card-tools">
            <a href="{{ route('articles.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create new Article</a>
        </div>
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
                <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>libille</th>
                        <th>prix_intial</th>
                        <th>Description</th>
                        <th>Categorie</th>
                        <th>Cover</th>
                        <th>Update</th>
                         <th>View Image</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>


                        @foreach ($articles as $article)
                     <tr>
                           <th scope="row">{{ $article->id }}</th>
                           <td>{{ $article->libille }}</td>
                           <td>{{ $article->prix_intial }}</td>
                           <td>{{ $article->description }}</td>
                           <td>{{ $article->categorie->libelle }}</td>
                           <td><img src="cover/{{ $article->cover }}" class="img-responsive" style="max-height:100px; max-width:100px" alt="" srcset=""></td>

                           <td><a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-primary">Update</a></td>
                            <td>
                            <a href={{route('articles.show',$article->id)}} class="btn btn-outline-dark">View</a>
                        </td>
                           <td>
                            <form action="{{ route('articles.destroy',$article->id) }}" method="POST">
                                <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                @csrf
                                @method('delete')
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
