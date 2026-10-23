
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración | Forno Nero</title>
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">

    <style>
        .admin-container {
            width: min(1100px, 92%);
            margin: 60px auto;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .admin-header p {
            color: var(--muted);
        }

        .admin-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--surface);
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th,
        .admin-table td {
            padding: 18px;
            border-bottom: 1px solid var(--border);
        }

        .admin-table th {
            color: var(--muted);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .admin-table td {
            font-size: 14px;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            white-space: nowrap;
        }

        .status-available {
            background: #203d2b;
            color: #9be0b0;
        }

        .status-unavailable {
            background: #482626;
            color: #ffaaaa;
        }

        .admin-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
        }

        .admin-actions a {
            color: var(--accent);
            text-decoration: none;
        }

        .admin-actions a:hover {
            text-decoration: underline;
        }

        .admin-actions form {
            display: inline;
            margin: 0;
        }

        .availability-button,
        .delete-button {
            padding: 0;
            border: none;
            background: transparent;
            font: inherit;
            cursor: pointer;
        }

        .availability-button {
            color: var(--accent);
        }

        .delete-button {
            color: #e05252;
        }

        .availability-button:hover,
        .delete-button:hover {
            text-decoration: underline;
        }

        .success-message {
            padding: 14px 18px;
            margin: 20px 0;
            background: #e8f7e9;
            color: #216b2b;
            border-radius: 8px;
            border: 1px solid #b7e2bc;
        }

        .logout-form {
            margin: 0;
        }

        .logout-button {
            padding: 0;
            border: none;
            background: transparent;
            color: inherit;
            font: inherit;
            cursor: pointer;
        }

        .logout-button:hover {
            color: var(--accent);
        }

        .navbar-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        @media (max-width: 600px) {
            .admin-container {
                margin: 35px auto;
            }

            .admin-table th,
            .admin-table td {
                padding: 12px;
            }

            .admin-header {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <a class="brand" href="{{ url('/') }}">FORNO NERO</a>

            <div class="navbar-links">
                <a href="{{ route('pizzas.index') }}">Ver carta pública</a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="logout-form"
                >
                    @csrf

                    <button type="submit" class="logout-button">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </nav>
    </header>

    <main class="admin-container">
        <div class="admin-header">
            <div>
                <h1>Gestionar pizzas</h1>
                <p>Administra los productos de tu carta.</p>

                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif
            </div>

            <a
                href="{{ route('admin.pizzas.create') }}"
                class="btn-menu"
            >
                + Nueva pizza
            </a>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Disponibilidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pizzas as $pizza)
                        <tr>
                            <td>{{ $pizza->name }}</td>

                            <td>
                                {{ number_format((float) $pizza->price, 2, ',', '.') }} €
                            </td>

                            <td>
                                @if ($pizza->is_available)
                                    <span class="status status-available">
                                        Disponible
                                    </span>
                                @else
                                    <span class="status status-unavailable">
                                        No disponible
                                    </span>
                                @endif
                            </td>

                            <td>
                                <div class="admin-actions">
                                    <a href="{{ route('admin.pizzas.edit', $pizza) }}">
                                        Editar
                                    </a>

                                    {{-- Activar o desactivar la pizza --}}
                                    <form
                                        action="{{ route('admin.pizzas.toggle-availability', $pizza) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="availability-button"
                                        >
                                            {{ $pizza->is_available ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>

                                    {{-- Eliminar la pizza --}}
                                    <form
                                        action="{{ route('admin.pizzas.destroy', $pizza) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Seguro que quieres eliminar esta pizza? Esta acción no se puede deshacer.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-button"
                                        >
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                Todavía no hay pizzas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
