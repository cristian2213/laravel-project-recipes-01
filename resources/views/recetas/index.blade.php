@extends('layouts.app')

@section('buttons')
    @include('ui.navegacion')
@endsection

@section('content')
    <h1 class="text-center mb-5">Manage your recipes:</h1>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Title</th>
                    <th scole="col">Category</th>
                    <th scole="col">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($recetas as $receta)
                    <tr>
                        <td>{{ $receta->title }}</td>
                        {{-- accediendo por medio de la relacion en el modelo al metodo de
                        categoria --}}
                        <td>{{ $receta->categoria->nombre }}</td>
                        <td>

                            <div class="d-flex">
                                {{-- vue component --}}
                                <eliminar-receta receta-id={{ $receta->id }}></eliminar-receta>

                                <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning mx-2">Editar</a>

                                <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-dark">Ver</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>

    </div>
@endsection
