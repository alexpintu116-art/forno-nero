
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Forno Nero: pizza artesanal, ingredientes seleccionados y pasión por el horno.">
    <title>Forno Nero — Pizza hecha con pasión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">
</head>
<body>
    <header class="navbar">
        <a href="/" class="brand">FORNO<span>NERO.</span></a>

        <nav>
            <a href="#filosofia">Nuestra filosofía</a>
            <a href="#especialidades">Especialidades</a>
            <a href="{{ route('pizzas.index') }}">Nuestra carta</a>

        </nav>

        <a href="#especialidades" class="nav-button">Descubrir la carta ↗</a>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">  
                <span class="eyebrow"><span class="dot"></span> PIZZA ARTESANAL · DESDE EL HORNO</span>

                <h1>No hacemos<br>pizza. Hacemos<br><span>momentos.</span></h1>

                <p>
                    Ingredientes honestos, masa de larga fermentación
                    y fuego. La diferencia está en cada detalle.
                </p>

                <div class="hero-actions">
                    <a class="button button-primary" href="#especialidades">Explorar especialidades ↗</a>
                    <a class="button button-secondary" href="#filosofia">Nuestra historia</a>
                    <a href="{{ route('pizzas.index') }}" class="btn-menu">Descubrir nuestra carta</a>
                </div>

                <div class="hero-note">
                    <span class="note-line"></span>
                    <span>MASA MADRE · INGREDIENTES SELECCIONADOS · MUCHO FUEGO</span>
                </div>
            </div>

            <div class="hero-image" role="img" aria-label="Pizza artesanal recién salida del horno">
                <div class="image-label">
                    <span>01 / NUESTRA ESENCIA</span>
                    <strong>Simplemente auténtica.</strong>
                </div>
                <div class="round-stamp">FATTO<br>CON<br>PASSIONE</div>
            </div>
        </section>

        <section class="values" id="filosofia">
            <div>
                <span class="value-number">01</span>
                <h2>Tiempo, no atajos.</h2>
                <p>Nuestra masa reposa lentamente para conseguir una textura ligera y llena de sabor.</p>
            </div>
            <div>
                <span class="value-number">02</span>
                <h2>Menos, pero mejor.</h2>
                <p>Seleccionamos cada ingrediente para que cada sabor tenga algo que decir.</p>
            </div>
            <div>
                <span class="value-number">03</span>
                <h2>El fuego lo cambia todo.</h2>
                <p>Calor intenso, bordes dorados y ese aroma que solo da una pizza bien hecha.</p>
            </div>
        </section>

        <section class="specialties" id="especialidades">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">HECHAS PARA RECORDAR</span>
                    <h2>Nuestras favoritas<span>.</span></h2>
                </div>
                <p>Una carta corta, ingredientes de calidad y ninguna necesidad de complicarlo.</p>
            </div>

            <div class="coming-soon">
                <span>LA CARTA ESTÁ EN EL HORNO</span>
                <p>Muy pronto podrás descubrir nuestras especialidades.</p>
            </div>
        </section>
    </main>

    <footer>
        <a href="/" class="brand">FORNO<span>NERO.</span></a>
        <p>Hecho con pasión. Servido recién hecho.</p>
        <span>PROYECTO DEMO · PIZZERIAOS</span>
    </footer>
</body>
</html>
