@extends('layouts.app')


@section('styles')

@endsection


@section('content')
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
