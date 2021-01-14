@extends('layouts.app')


@section('hero')
    <div class="hero-categorias">
        <form method="GET" action="{{ route('buscar.show') }}" class="container h-100">
            @csrf

            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">{{ Str::title('Search a recipe for your next food') }}</p>

                    <input type="search" name="buscar" id="buscar" class="form-control" placeholder="Search A Recipe">

                    @error('buscar')
                        <span class="invalid-feedback d-block text-white" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </form>
    </div>
@endsection


@section('content')
    {{-- asset or url => hacen referencia a la carpeta publica
    --}}
    {{-- <img src="{{ asset('/images/P6s9zYWU3mDVeHVuwVQUr7roHTwDlU3fKjNjSUw9.jpg') }}"
        alt="fondo" class="mb-5 mt-0 d-block w-100 "> --}}

    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase">Lastest Recipes</h2>

        <div class="row">
            @foreach ($lastestRecipes as $lastestRecipe)
                <div class="col-md-4 my-3">
                    <div class="card">
                        <img src="/storage/{{ $lastestRecipe->imagen }}" alt="{{ $lastestRecipe->title }}"
                            class="card-img-top">


                        <div class="card-body">
                            <h3 class="card-title">{{ Str::title($lastestRecipe->title) }}</h3>

                            {{-- helper de laravel --}}
                            <p class="card-text">{{ Str::words(strip_tags($lastestRecipe->preparacion), 20) }}</p>

                            <a href="{{ route('recetas.show', $lastestRecipe->id) }}"
                                class="btn btn-primary d-block font-weight-bold text-uppercase">Watch Recipe</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container">
        <h2 class="titulo-categoria subtitle mt-5 mb-4 font-weight-light">
            {{ Str::title('Most voted recipes') }}
        </h2>

        <div class="row">

            @foreach ($votadas as $recipe)
                @include('ui.receta')
            @endforeach

        </div>
    </div>

    <h2 class="titulo-categoria text-center mt-5 col-md-12">{{ Str::upper('Recipe Categories') }}</h2>
    @foreach ($recipesByCategory as $key => $group)
        <div class="container">
            <h2 class="titulo-categoria subtitle mt-5 mb-4 font-weight-light">
                {{ Str::title(str_replace('-', ' ', $key)) }}
            </h2>

            <div class="row">
                @foreach ($group as $recipes)
                    @foreach ($recipes as $recipe)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
@endsection
