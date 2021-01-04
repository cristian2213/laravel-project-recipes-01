@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
        integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
        crossorigin="anonymous" />
@endsection

@section('buttons')
    <a href="{{ route('recetas.index') }}" class="btn btn-primary mr-2">Go to the recipes</a>
@endsection

@section('content')
    <h1 class="text-center mb-5">Create new Recipe:</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('recetas.store') }}" enctype="multipart/form-data" novalidate>
                @csrf

                {{-- el name es el que se va a leer en el backend
                --}}
                <div class="form-group">
                    <label for="title">Recipe Title</label>
                    <input id="title" class="form-control @error('title') is-invalid @enderror " type="text" name="title"
                        placeholder="Recipe title" value="{{ old('title') }}">

                    @error('title'){{-- si hay error entonces ejecute el siguiente codigo
                        --}}
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>

                    <select name="categoria" class="form-control @error('categoria') is-invalid @enderror" id="categoria">

                        <option value="">-- Seleccione --</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparacion">Preparación</label>

                    <input type="hidden" id="preparacion" name="preparacion" value="{{ old('preparacion') }}">
                    {{-- este editor esta ligado al input, todo el contenido que se agrege en
                    esta etiquetea se guardara en el input --}}
                    <trix-editor input="preparacion" class="@error('preparacion') is-invalid @enderror"></trix-editor>

                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">
                    <label for="ingredientes">Ingredientes</label>

                    <input type="hidden" id="ingredientes" name="ingredientes" value="{{ old('ingredientes') }}">
                    {{-- este editor esta ligado al input, todo el contenido que se agrege en
                    esta etiquetea se guardara en el input --}}
                    <trix-editor input="ingredientes" class="@error('ingredientes') is-invalid @enderror"></trix-editor>

                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen" class="form-label">Image</label>

                    <input type="file" id="imagen" class="form-control @error('imagen') is-invalid  @enderror" name="imagen"
                        accept="image/*">

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Add Recipe</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
        integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
        crossorigin="anonymous" defer></script>
@endsection
