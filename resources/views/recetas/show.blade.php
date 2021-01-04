@extends('layouts.app')

@section('buttons')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2 px-5">
        <svg width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                clip-rule="evenodd" />
        </svg>
        Go back
    </a>
@endsection

@section('content')

    <article class="contenido-receta col-md-10 mx-auto">
        <h1 class="text-center mb-4">{{ $receta->title }}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" class="w-100">
        </div>

        <div>
            <p>
                <span class="font-weight-bold text-primary mt-2">written in:</span>
                {{ $receta->categoria->nombre }}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Author:</span>
                {{-- TODO: show the user that created this recipe
                --}}
                <a href="{{ route('perfiles.show', $receta->autor->id) }}"> {{ $receta->autor->name }}</a>

            </p>
            <p>
                <span class="font-weight-bold text-primary">Created at:</span>
                {{-- using blade directive to past data by pross to a vue component
                --}}
                @php
                $fecha = $receta->created_at;
                @endphp
                {{-- vue component --}}
                <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
            </p>


            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredients:</h2>

                {{-- print html code --}}
                {!! $receta->ingredientes !!}
            </div>
            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparation:</h2>

                {{-- print html code --}}
                {!! $receta->preparacion !!}
            </div>

            {{-- Vue component --}}
            <like-button></like-button>

        </div>
    </article>
@endsection
