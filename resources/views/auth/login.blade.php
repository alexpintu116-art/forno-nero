
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Forno Nero</title>
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">

    <style>
        .login-container {
            width: min(420px, 90%);
            margin: 80px auto;
        }

        .login-card {
            padding: 32px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .login-card h1 {
            margin-bottom: 10px;
        }

        .login-description {
            color: var(--muted);
            margin-bottom: 28px;
        }

        .login-form {
            display: grid;
            gap: 18px;
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
        }

        .login-form input {
            box-sizing: border-box;
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background: var(--background);
            color: inherit;
            font: inherit;
        }

        .login-form button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font: inherit;
        }

        .login-error {
            color: #ffaaaa;
            font-size: 14px;
            margin-top: 6px;
        }

        .login-footer {
            margin-top: 24px;
            text-align: center;
        }

        .login-footer a {
            color: var(--accent);
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <a class="brand" href="{{ url('/') }}">FORNO NERO</a>
            <a href="{{ route('pizzas.index') }}">Ver carta</a>
        </nav>
    </header>

    <main class="login-container">
        <section class="login-card">
            <h1>Bienvenido</h1>
            <p class="login-description">
                Inicia sesión para administrar Forno Nero.
            </p>

            <form
                action="{{ route('login.store') }}"
                method="POST"
                class="login-form"
            >
                @csrf

                <div>
                    <label for="email">Correo electrónico</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                    >

                    @error('email')
                        <p class="login-error">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                        required
                    >

                    @error('password')
                        <p class="login-error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-menu">
                    Iniciar sesión
                </button>
            </form>

            <div class="login-footer">
                <a href="{{ url('/') }}">Volver al inicio</a>
            </div>
        </section>
    </main>
</body>
</html>
