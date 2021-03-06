@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css"
        integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA=="
        crossorigin="anonymous" />
@endsection

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
    <h1 class="text-center">Edit My Profile</h1>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">

            <form method="POST" action="{{ route('perfiles.update', $perfil->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Name:</label>

                    <input type="text" id="nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                        placeholder="Your name" value="{{ $perfil->usuario->name }}">


                    @error('nombre'){{-- si hay error entonces ejecute el siguiente codigo
                        --}}
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="url">Webside:</label>

                    <input type="url" id="url" class="form-control @error('url') is-invalid @enderror " name="url"
                        placeholder="Your webside" value="{{ $perfil->usuario->url }}">

                    @error('url'){{-- si hay error entonces ejecute el siguiente codigo
                        --}}
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">Biography:</label>

                    <input type="hidden" id="biografia" name="biografia" value="{{ $perfil->biografia }}">
                    {{-- este editor esta ligado al input, todo el contenido que se agrege en
                    esta etiquetea se guardara en el input --}}
                    <trix-editor input="biografia" class="@error('biografia') is-invalid @enderror"></trix-editor>

                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group mt-3">
                    <label for="imagen" class="form-label">Image:</label>

                    <input type="file" id="imagen" class="form-control @error('imagen') is-invalid  @enderror" name="imagen"
                        accept="image/*">

                    @if ($perfil->imagen)
                        <div class="mt-4">
                            <p>Current image:</p>
                            <img src="/storage/{{ $perfil->imagen }}" class="rounded" alt="profile" style="width: 300px">
                        </div>
                    @endif

                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Update Profile</button>
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
