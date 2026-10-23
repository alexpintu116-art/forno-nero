
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar pizza | Forno Nero</title>
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">

    <style>
        .edit-container {
            max-width: 650px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .edit-container h1 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font: inherit;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 25px;
        }

        .btn-save,
        .btn-cancel {
            display: inline-block;
            padding: 11px 18px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }

        .btn-save {
            background: #a83225;
            color: white;
        }

        .btn-cancel {
            background: #eee;
            color: #222;
        }

        .errors {
            padding: 12px 16px;
            margin-bottom: 20px;
            background: #fff0f0;
            color: #a00000;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <main class="edit-container">
        <h1>Editar pizza</h1>

        @if ($errors->any())
            <div class="errors">
                <strong>Revisa estos errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pizzas.update', $pizza) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nombre</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $pizza->name) }}"
                    maxlength="255"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea
                    id="description"
                    name="description"
                    required
                >{{ old('description', $pizza->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Precio (€)</label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    value="{{ old('price', $pizza->price) }}"
                    min="0.01"
                    max="999999.99"
                    step="0.01"
                    required
                >
            </div>

            <div class="form-group">
                <label for="image_url">URL de la imagen</label>
                <input
                    type="url"
                    id="image_url"
                    name="image_url"
                    value="{{ old('image_url', $pizza->image_url) }}"
                    maxlength="255"
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    Guardar cambios
                </button>

                <a href="{{ route('admin.pizzas.index') }}"
                   class="btn-cancel">
                    Cancelar
                </a>
            </div>
        </form>
    </main>

</body>
</html>
