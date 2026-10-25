
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="noindex, nofollow">
    <title>Administración de pizzas | Forno Nero</title>

    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">

    <style>
        .admin-container {
            width: min(1180px, 92%);
            margin: 55px auto 80px;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
            margin-bottom: 32px;
        }

        .admin-eyebrow {
            display: block;
            margin-bottom: 10px;
            color: var(--accent);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .admin-header h1 {
            margin: 0 0 10px;
            font-size: clamp(28px, 4vw, 40px);
        }

        .admin-header p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .admin-header .btn-menu {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 12px 18px;
            text-decoration: none;
            white-space: nowrap;
        }

        .admin-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            color: var(--muted);
            font-size: 13px;
        }

        .admin-summary strong {
            color: var(--text);
        }

        .admin-table-wrapper {
            overflow-x: auto;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: var(--surface);
        }

        .admin-table {
            width: 100%;
            min-width: 680px;
            border-collapse: collapse;
            text-align: left;
        }

        .admin-table th,
        .admin-table td {
            padding: 19px 20px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .admin-table th {
            background: rgba(255, 255, 255, 0.025);
            color: var(--muted);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-table td {
            font-size: 14px;
        }

        .admin-table tbody tr {
            transition: background 0.2s ease;
        }

        .admin-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.025);
        }

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        .pizza-name {
            color: var(--text);
            font-weight: 600;
        }

        .pizza-price {
            color: var(--text);
            font-weight: 600;
            white-space: nowrap;
            font-variant-numeric: tabular-nums;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status::before {
            content: "";
            width: 6px;
            height: 6px;
            flex: 0 0 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-available {
            color: #9be0b0;
            background: rgba(53, 142, 78, 0.14);
            border-color: rgba(91, 190, 119, 0.2);
        }

        .status-unavailable {
            color: #ffaaaa;
            background: rgba(192, 65, 65, 0.13);
            border-color: rgba(230, 100, 100, 0.2);
        }

        .admin-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .admin-actions a,
        .admin-actions button {
            padding: 4px 0;
            border: 0;
            background: transparent;
            font: inherit;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }

        .edit-action,
        .availability-button {
            color: var(--accent);
        }

        .delete-button {
            color: #ff8d8d;
        }

        .admin-actions a:hover,
        .admin-actions button:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .admin-actions a:focus-visible,
        .admin-actions button:focus-visible,
        .logout-button:focus-visible,
        .btn-menu:focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 4px;
            border-radius: 3px;
        }

        .admin-actions form,
        .logout-form {
            display: inline;
            margin: 0;
        }

        .success-message {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px 16px;
            margin: 24px 0;
            color: #a8e6b5;
            background: rgba(53, 142, 78, 0.13);
            border: 1px solid rgba(91, 190, 119, 0.3);
            border-radius: 8px;
            line-height: 1.5;
        }

        .empty-state {
            padding: 48px 20px !important;
            color: var(--muted);
            text-align: center;
            line-height: 1.7;
        }

        .empty-state strong {
            display: block;
            margin-bottom: 6px;
            color: var(--text);
            font-size: 16px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 22px;
        }

        .navbar-links > a {
            color: var(--text);
            text-decoration: none;
        }

        .navbar-links > a:hover {
            color: var(--accent);
        }

        .logout-button {
            padding: 0;
            border: 0;
            background: transparent;
            color: var(--muted);
            font: inherit;
            cursor: pointer;
        }

        .logout-button:hover {
            color: var(--accent);
        }

        @media (max-width: 800px) {
            .admin-container {
                margin-top: 35px;
            }

            .admin-table th,
            .admin-table td {
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .admin-container {
                width: 94%;
                margin: 28px auto 50px;
            }

            .admin-header {
                align-items: stretch;
            }

            .admin-header .btn-menu {
                width: 100%;
                box-sizing: border-box;
            }

            .navbar-links {
                gap: 12px;
                font-size: 13px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .admin-table tbody tr {
                transition: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar" aria-label="Navegación de administración">
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
                <span class="admin-eyebrow">Panel de administración</span>
                <h1>Gestionar pizzas</h1>
                <p>Controla los productos y la disponibilidad de tu carta.</p>
            </div>

            <a
                href="{{ route('admin.pizzas.create') }}"
                class="btn-menu"
            >
                <span aria-hidden="true">+</span>
                Nueva pizza
            </a>
        </div>

        @if (session('success'))
            <div class="success-message" role="status">
                <span aria-hidden="true">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="admin-summary">
            <span>Catálogo de productos</span>
            <span>
                Total: <strong>{{ $pizzas->count() }}</strong>
                {{ $pizzas->count() === 1 ? 'pizza' : 'pizzas' }}
            </span>
        </div>

        <div class="admin-table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pizzas as $pizza)
                        <tr>
                            <td>
                                <span class="pizza-name">
                                    {{ $pizza->name }}
                                </span>
                            </td>

                            <td class="pizza-price">
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
                                    <a
                                        class="edit-action"
                                        href="{{ route('admin.pizzas.edit', $pizza) }}"
                                    >
                                        Editar
                                    </a>

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
                            <td colspan="4" class="empty-state">
                                <strong>No hay pizzas registradas</strong>
                                Añade tu primera pizza para empezar a completar la carta.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
