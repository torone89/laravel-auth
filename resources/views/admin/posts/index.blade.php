@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center">
        <h1>Lista Post</h1>
        <div>
            <a class='btn btn-success'href="{{ route('admin.posts.create') }}">
                <i class='fa-solid fa-plus mr-2'></i> Nuovo
                Post</a>
        </div>

    </header>


    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il </th>
                <th scope="col">Modificato il </th>
                <th></th>


                </th>

            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>

                    <td>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="delete-form">
                            <a class='btn btn-sm btn-primary mr-2' href="{{ route('admin.posts.show', $post) }}"><i
                                    class='fa-solid fa-eye mr-2'></i>Vedi</a>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.posts.edit', $post) }}"><i
                                    class="fa-solid fa-pencil"></i> Modifica</a>

                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger ml-2" type="submit">
                                <i class="fa-solid fa-trash"></i>Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <h3 class="text-center">Nessun Post</h3>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
@endsection
