<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{ $recipe->imagen }}" alt="{{ $recipe->title }}" class="card-img-top">

        <div class="card-body">
            <h3 class="card-title">{{ $recipe->title }}</h3>

            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary fecha font-weight-bold">
                    @php
                    $fecha = $recipe->created_at;
                    @endphp
                    {{-- vue component
                    --}}
                    <fecha-receta fecha="{{ $fecha }}"></fecha-receta>
                </p>

                <p>{{ count($recipe->likes) }} Les gusto</p>
            </div>
            <a href="{{ route('recetas.show', $recipe->id) }}" class="btn btn-primary d-block btn-receta">Go to the
                Recipes</a>
        </div>
    </div>
</div>
