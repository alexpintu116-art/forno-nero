
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestra carta | Forno Nero</title>
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">FORNO NERO</a>
            <a href="{{ route('pizzas.index') }}">Nuestra carta</a>
        </nav>
    </header>

    <main>
        <section>
            <h1>Nuestra carta</h1>
            <p>Recetas auténticas, ingredientes seleccionados y pasión por la pizza.</p>

            <div class="pizza-grid">
                @forelse ($pizzas as $pizza)
                    
<article class="pizza-card">
    @if ($pizza->image_url)
        <img
            class="pizza-image"
            src="{{ $pizza->image_url }}"
            alt="Pizza {{ $pizza->name }}"
            loading="lazy"
        >
    @else
        <div class="pizza-image-placeholder">
            <span>FORNO NERO</span>
        </div>
    @endif

    <div class="pizza-card-content">
        <h2>{{ $pizza->name }}</h2>

        <p>{{ $pizza->description }}</p>

        <p class="pizza-price">
            {{ number_format((float) $pizza->price, 2, ',', '.') }} €
        </p>
    </div>
</article>

                @empty
                    <p>Actualmente no tenemos pizzas disponibles.</p>
                @endforelse
            </div>
        </section>
    </main>
</body>
</html>
