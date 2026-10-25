
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="noindex, nofollow">
    <title>Editar pizza | Forno Nero</title>

    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">

    <style>
        .form-container {
            width: min(680px, 92%);
            margin: 48px auto 80px;
        }

        .form-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
            color: var(--muted);
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .form-back:hover {
            color: var(--accent);
        }

        .form-heading {
            margin-bottom: 30px;
        }

        .form-eyebrow {
            display: block;
            margin-bottom: 10px;
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .form-heading h1 {
            margin: 0 0 12px;
            font-size: clamp(30px, 5vw, 42px);
            line-height: 1.15;
        }

        .form-heading p {
            margin: 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .pizza-form {
            display: grid;
            gap: 24px;
            padding: clamp(20px, 5vw, 34px);
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
        }

        .form-group {
            display: grid;
            gap: 9px;
        }

        .form-group label {
            color: var(--text);
            font-size: 13px;
            font-weight: 700;
        }

        .field-hint {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .form-group input,
        .form-group textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: #11110f;
            color: var(--text);
            font: inherit;
            font-size: 14px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group input {
            min-height: 47px;
        }

        .form-group textarea {
            min-height: 125px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #77736c;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(237, 113, 69, 0.12);
        }

        .form-group input[aria-invalid="true"],
        .form-group textarea[aria-invalid="true"] {
            border-color: #ff8d8d;
        }

        .form-error {
            color: #ffaaaa;
            font-size: 13px;
            line-height: 1.5;
        }

        .errors {
            margin-bottom: 24px;
            padding: 16px 18px;
            border: 1px solid rgba(230, 100, 100, 0.3);
            border-radius: 8px;
            background: rgba(192, 65, 65, 0.12);
            color: #ffb7b7;
        }

        .errors strong {
            display: block;
            margin-bottom: 8px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .errors li + li {
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            padding-top: 6px;
        }

        .form-submit {
            min-height: 46px;
            padding: 12px 20px;
            border: 1px solid var(--accent);
            border-radius: 5px;
            background: var(--accent);
            color: #11110f;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .form-submit:hover {
            background: var(--accent-hover, #f1835c);
        }

        .form-submit:active {
            transform: translateY(1px);
        }

        .form-cancel {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 5px;
            color: var(--muted);
            font-size: 14px;
            text-decoration: none;
            transition: border-color 0.2s ease, color 0.2s ease;
        }

        .form-cancel:hover {
            border-color: var(--accent);
            color: var(--text);
        }

        .form-submit:focus-visible,
        .form-cancel:focus-visible,
        .form-back:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 4px;
        }

        @media (max-width: 480px) {
            .form-container {
                width: 94%;
                margin: 30px auto 50px;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .form-submit,
            .form-cancel {
                width: 100%;
                box-sizing: border-box;
                text-align: center;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .form-back,
            .form-group input,
            .form-group textarea,
            .form-submit,
            .form-cancel {
                transition: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar" aria-label="Navegación de administración">
            <a class="brand" href="{{ url('/') }}">FORNO NERO</a>

            <a href="{{ route('admin.pizzas.index') }}">
                Administración
            </a>
        </nav>
    </header>

    <main class="form-container">
        <a
            class="form-back"
            href="{{ route('admin.pizzas.index') }}"
        >
            <span aria-hidden="true">←</span>
            Volver a las pizzas
        </a>

        <div class="form-heading">
            <span class="form-eyebrow">Gestión del catálogo</span>

            <h1>Editar pizza</h1>

            <p>
                Modifica los datos de
                <strong>{{ $pizza->name }}</strong>
                y guarda los cambios de tu carta.
            </p>
        </div>

        @if ($errors->any())
            <div class="errors" role="alert" aria-labelledby="error-title">
                <strong id="error-title">
                    No se han podido guardar los cambios.
                </strong>

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
            action="{{ route('admin.pizzas.update', $pizza) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre de la pizza *</label>

                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $pizza->name) }}"
                    maxlength="255"
                    autocomplete="off"
                    required
                    @if ($errors->has('name')) aria-invalid="true" aria-describedby="name-error" @endif
                >

                @if ($errors->has('name'))
                    <span id="name-error" class="form-error">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="description">Descripción *</label>

                <textarea
                    id="description"
                    name="description"
                    required
                    @if ($errors->has('description')) aria-invalid="true" aria-describedby="description-error" @endif
                >{{ old('description', $pizza->description) }}</textarea>

                <span class="field-hint">
                    Describe los ingredientes principales de la receta.
                </span>

                @if ($errors->has('description'))
                    <span id="description-error" class="form-error">
                        {{ $errors->first('description') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="price">Precio (€) *</label>

                <input
                    id="price"
                    name="price"
                    type="number"
                    min="0.01"
                    max="999999.99"
                    step="0.01"
                    value="{{ old('price', $pizza->price) }}"
                    inputmode="decimal"
                    required
                    @if ($errors->has('price')) aria-invalid="true" aria-describedby="price-error" @endif
                >

                <span class="field-hint">
                    Introduce el precio en euros. Ejemplo: 12.50.
                </span>

                @if ($errors->has('price'))
                    <span id="price-error" class="form-error">
                        {{ $errors->first('price') }}
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="image_url">URL de la imagen</label>

                <input
                    id="image_url"
                    name="image_url"
                    type="url"
                    value="{{ old('image_url', $pizza->image_url) }}"
                    maxlength="255"
                    placeholder="https://ejemplo.com/pizza.jpg"
                    @if ($errors->has('image_url')) aria-invalid="true" aria-describedby="image-url-error" @endif
                >

                <span class="field-hint">
                    Campo opcional. Debe ser una dirección web válida.
                </span>

                @if ($errors->has('image_url'))
                    <span id="image-url-error" class="form-error">
                        {{ $errors->first('image_url') }}
                    </span>
                @endif
            </div>

            <div class="form-actions">
                <button type="submit" class="form-submit">
                    Guardar cambios
                </button>

                <a
                    class="form-cancel"
                    href="{{ route('admin.pizzas.index') }}"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </main>
</body>
</html>
