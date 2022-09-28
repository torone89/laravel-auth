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
                <th scope="col">Categoria</th>
                <th scope="col">Slug</th>
                <th scope="col">Creato il </th>
                <th scope="col">Modificato il </th>
                <th scope="col" class="text-center">Azioni</th>


                </th>

            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>
                        @if ($post->category)
                            <span class="badge badge-pill badge-{{ $post->category->color ?? 'light' }}">
                                {{ $post->category->label }}</span>
                        @else
                            Nessuna
                        @endif
                    </td>
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
                                <i class="fa-solid fa-trash"></i> Elimina
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <h3 class="text-center">Nessun Post</h3>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <nav class="mt-3">
        @if ($posts->hasPages())
            {{ $posts->links() }}
        @endif
    </nav>

    <section class="my-5" id="category-posts">
        <h2 class="mb-2">Post by Categories</h2>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3">


                    <h3 class="my-3">{{ $category->label }} ({{ count($category->posts) }})</h3>
                    @forelse($category->posts as $post)
                        <p><a href="{{ route('admin.posts.show', $post) }}">{{ $post->title }}</a></p>

                    @empty
                        Nessun Post
                    @endforelse
                </div>
            @endforeach
        </div>
    </section>
@endsection
