@extends('layouts.app')

@section('buttons')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">
        <svg width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd" />
        </svg>
        Go to the recipes
    </a>

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4">
                @if ($perfil->imagen)
                    <img src="/storage/{{ $perfil->imagen }}" class="w-100 rounded-circle" alt="imagen chef">
                @endif
            </div>

            <div class="col-md-7 col-lg-8">
                <h2 class="text-center mb-2 text-primaryt mt-sm-4 mt-md-0">{{ $perfil->usuario->name }}</h2>

                <a href="{{ $perfil->usuario->url }}" target="_blank" rel="noopener noreferrer">Visit webside</a>

                <div class="biografia">
                    {{-- to print html tags --}}
                    {!! $perfil->biografia !!}

                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">
        Recipes created by: {{ $perfil->usuario->name }}
    </h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4">

            @if (count($recetas) > 0)
                @foreach ($recetas as $receta)
                    <div class="col-md-4 mb-4">

                        <div class="card">

                            <img src="/storage/{{ $receta->imagen }}" alt="{{ $receta->title }}" class="card-img-top">

                            <div class="card-body">
                                <h3>{{ $receta->title }}</h3>
                                <a href="{{ route('recetas.show', $receta->id) }}"
                                    class="btn btn-primary d-block mt-4 text-uppercase font-weight-bold">Look at
                                    recipe</a>
                            </div>

                        </div>

                    </div>
                @endforeach
            @else
                <p class="text-center w-100">No recipes yet</p>
            @endif
        </div>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>

    </div>

@endsection
