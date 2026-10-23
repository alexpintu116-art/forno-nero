
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva pizza | Forno Nero</title>
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">

    <style>
        .form-container {
            width: min(650px, 92%);
            margin: 60px auto;
        }

        .pizza-form {
            display: grid;
            gap: 22px;
            margin-top: 30px;
            padding: 30px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
        }

        .form-group {
            display: grid;
            gap: 8px;
        }

        .form-group label {
            font-size: 13px;
            font-weight: 700;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid var(--border);
            border-radius: 4px;
            background: #11110f;
            color: var(--text);
            font: inherit;
        }

        .form-group textarea {
            min-height: 110px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: 1px solid var(--accent);
            border-color: var(--accent);
        }

        .form-error {
            color: #ffaaaa;
            font-size: 13px;
        }

        .form-back {
            color: var(--muted);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <a class="brand" href="{{ url('/') }}">FORNO NERO</a>
            <a href="{{ route('admin.pizzas.index') }}">Administración</a>
        </nav>
    </header>

    <main class="form-container">
        <a class="form-back" href="{{ route('admin.pizzas.index') }}">
            ← Volver a las pizzas
        </a>

        <h1 style="margin-top: 28px;">Nueva pizza</h1>
        <p style="color: var(--muted);">
            Añade una nueva receta a la carta de Forno Nero.
        </p>

        @if ($errors->any())
            <div class="form-error">
                <p>Revisa los siguientes campos:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            class="pizza-form"
            action="{{ route('admin.pizzas.store') }}"
            method="POST"
        >
            @csrf

            <div class="form-group">
                <label for="name">Nombre de la pizza</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    maxlength="255"
                    placeholder="Ej. Diavola"
                >
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea
                    id="description"
                    name="description"
                    required
                    placeholder="Describe los ingredientes..."
                >{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Precio (€)</label>
                <input
                    id="price"
                    name="price"
                    type="number"
                    min="0.01"
                    max="999999.99"
                    step="0.01"
                    value="{{ old('price') }}"
                    required
                    placeholder="12.50"
                >
            </div>

            <div class="form-group">
                <label for="image_url">URL de la imagen (opcional)</label>
                <input
                    id="image_url"
                    name="image_url"
                    type="url"
                    value="{{ old('image_url') }}"
                    maxlength="255"
                    placeholder="https://ejemplo.com/pizza.jpg"
                >
            </div>

            <button class="btn-menu" type="submit">
                Guardar pizza
            </button>
        </form>
    </main>
</body>
</html>
