<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#11110f">
    <meta name="description" content="Descubre la carta de Forno Nero: pizzas artesanales, ingredientes seleccionados y recetas llenas de sabor.">
    <title>Nuestra carta | Forno Nero</title>
    <link rel="stylesheet" href="{{ asset('css/forno.css') }}">
</head>
<body>

    <header class="navbar">
        <a href="{{ url('/') }}" class="brand" aria-label="Forno Nero, página de inicio">
            FORNO<span>NERO.</span>
        </a>

        <nav aria-label="Navegación principal">
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ route('pizzas.index') }}" aria-current="page">Nuestra carta</a>
            <button
                type="button"
                class="cart-toggle"
                id="open-cart"
                aria-controls="cart-panel"
                aria-expanded="false"
            >
                Mi pedido <span id="cart-count" aria-live="polite">0</span>
            </button>
        </nav>
    </header>

    <main>
        <section class="menu-container" aria-labelledby="menu-title">
            <p class="eyebrow">INGREDIENTES SELECCIONADOS · MASA ARTESANAL</p>

            <h1 id="menu-title">Nuestra <span>carta.</span></h1>

            <p class="menu-intro">
                Recetas auténticas, ingredientes seleccionados y pasión por la pizza.
            </p>

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
                            <div class="pizza-image-placeholder" aria-label="Imagen no disponible">
                                <span>FORNO NERO</span>
                            </div>
                        @endif

                        <div class="pizza-card-content">
                            <h2>{{ $pizza->name }}</h2>

                            <p>{{ $pizza->description }}</p>

                            <p class="pizza-price">
                                {{ number_format((float) $pizza->price, 2, ',', '.') }} €
                            </p>

                            <button
                                type="button"
                                class="btn-menu add-to-cart"
                                data-id="{{ $pizza->id }}"
                                data-name="{{ $pizza->name }}"
                                data-price="{{ (float) $pizza->price }}"
                            >
                                AÑADIR AL PEDIDO +
                            </button>
                        </div>
                    </article>
                @empty
                    <p class="cart-empty">
                        Actualmente no tenemos pizzas disponibles. Vuelve pronto para descubrir nuestras especialidades.
                    </p>
                @endforelse
            </div>
        </section>
    </main>

    <footer>
        <a href="{{ url('/') }}" class="brand">FORNO<span>NERO.</span></a>
        <p>© {{ date('Y') }} Forno Nero. Proyecto de demostración.</p>
        <span>Hecho con pasión por la pizza.</span>
    </footer>

    <!-- Fondo del carrito -->
    <div class="cart-overlay" id="cart-overlay"></div>

    <!-- Panel lateral del carrito -->
    <aside
        class="cart-panel"
        id="cart-panel"
        aria-label="Tu pedido"
        aria-hidden="true"
        inert
    >
        <div class="cart-header">
            <div>
                <span class="eyebrow">FORNO NERO</span>
                <h2>Tu pedido<span>.</span></h2>
            </div>

            <button
                type="button"
                class="cart-close"
                id="close-cart"
                aria-label="Cerrar carrito"
            >
                &times;
            </button>
        </div>

        <div class="cart-items" id="cart-items" aria-live="polite">
            <p class="cart-empty">Todavía no has añadido ninguna pizza.</p>
        </div>

        <div class="cart-footer">
            <div class="cart-total">
                <span>Total del pedido</span>
                <strong id="cart-total">0,00 €</strong>
            </div>

            <button
                type="button"
                class="btn-menu checkout-button"
                id="checkout-button"
                disabled
            >
                CONFIRMAR PEDIDO
            </button>

            <p class="cart-note">
                Simulación de compra. No se realizará ningún pago.
            </p>
        </div>
    </aside>

    <!-- Confirmación visual del pedido -->
    <div
        id="order-success"
        class="order-success"
        aria-hidden="true"
        inert
    >
        <div
            class="order-success-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="success-title"
            aria-describedby="success-message"
        >
            <div class="success-icon" aria-hidden="true">✓</div>

            <p class="success-eyebrow">FORNO NERO · PEDIDO SIMULADO</p>

            <h2 id="success-title">¡Pedido confirmado!</h2>

            <p id="success-message">
                Tu pedido se ha registrado correctamente en esta demostración.
            </p>

            <div class="success-order-details">
                <div>
                    <span>Número de pedido</span>
                    <strong id="success-order-number">#000000</strong>
                </div>

                <div>
                    <span>Total del pedido</span>
                    <strong id="success-order-total">0,00 €</strong>
                </div>
            </div>

            <p class="success-disclaimer">
                Esta es una demostración de portfolio. No se ha enviado ningún
                pedido real ni se ha realizado ningún pago.
            </p>

            <button type="button" id="success-close" class="success-button">
                Volver a la carta
            </button>
        </div>
    </div>

    <script>
        (() => {
            'use strict';

            const CART_KEY = 'forno-nero-cart';

            const cartPanel = document.getElementById('cart-panel');
            const cartOverlay = document.getElementById('cart-overlay');
            const cartItems = document.getElementById('cart-items');
            const cartCount = document.getElementById('cart-count');
            const cartTotal = document.getElementById('cart-total');
            const checkoutButton = document.getElementById('checkout-button');
            const openCartButton = document.getElementById('open-cart');
            const closeCartButton = document.getElementById('close-cart');

            const orderSuccess = document.getElementById('order-success');
            const successOrderNumber = document.getElementById('success-order-number');
            const successOrderTotal = document.getElementById('success-order-total');
            const successClose = document.getElementById('success-close');

            let cart = {};
            let previousFocus = null;
            let confirmationOpen = false;

            // Recuperar el carrito guardado y validar sus datos.
            try {
                const savedCart = JSON.parse(localStorage.getItem(CART_KEY));

                if (
                    savedCart &&
                    typeof savedCart === 'object' &&
                    !Array.isArray(savedCart)
                ) {
                    Object.entries(savedCart).forEach(([id, item]) => {
                        const price = Number(item?.price);
                        const quantity = Number(item?.quantity);

                        if (
                            item &&
                            String(item.id) === id &&
                            typeof item.name === 'string' &&
                            Number.isFinite(price) &&
                            price >= 0 &&
                            Number.isSafeInteger(quantity) &&
                            quantity > 0 &&
                            quantity <= 99
                        ) {
                            cart[id] = {
                                id,
                                name: item.name,
                                price,
                                quantity
                            };
                        }
                    });
                }
            } catch (error) {
                cart = {};
            }

            function formatPrice(price) {
                return price.toLocaleString('es-ES', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + ' €';
            }

            function saveCart() {
                try {
                    localStorage.setItem(CART_KEY, JSON.stringify(cart));
                } catch (error) {
                    console.warn('No se ha podido guardar el carrito.', error);
                }
            }

            function openCart() {
                if (confirmationOpen) return;

                previousFocus = document.activeElement;

                cartPanel.inert = false;
                cartPanel.classList.add('is-open');
                cartOverlay.classList.add('is-visible');
                cartPanel.setAttribute('aria-hidden', 'false');
                openCartButton.setAttribute('aria-expanded', 'true');
                document.body.classList.add('cart-open');

                closeCartButton.focus();
            }

            function closeCart(restoreFocus = true) {
                cartPanel.classList.remove('is-open');
                cartOverlay.classList.remove('is-visible');
                cartPanel.setAttribute('aria-hidden', 'true');
                cartPanel.inert = true;
                openCartButton.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('cart-open');

                if (
                    restoreFocus &&
                    previousFocus &&
                    typeof previousFocus.focus === 'function'
                ) {
                    previousFocus.focus();
                }
            }

            function addToCart(id, name, price) {
                if (!id || !name || !Number.isFinite(price) || price < 0) {
                    return;
                }

                if (cart[id]) {
                    if (cart[id].quantity >= 99) return;
                    cart[id].quantity++;
                } else {
                    cart[id] = {
                        id,
                        name,
                        price,
                        quantity: 1
                    };
                }

                saveCart();
                renderCart();
            }

            function changeQuantity(id, change) {
                if (!cart[id]) return;

                const nextQuantity = cart[id].quantity + change;

                if (nextQuantity <= 0) {
                    delete cart[id];
                } else if (nextQuantity <= 99) {
                    cart[id].quantity = nextQuantity;
                }

                saveCart();
                renderCart();
            }

            function removeItem(id) {
                delete cart[id];

                saveCart();
                renderCart();
            }

            function renderCart() {
                cartItems.replaceChildren();

                const items = Object.values(cart);

                const totalUnits = items.reduce(
                    (sum, item) => sum + item.quantity,
                    0
                );

                const totalPrice = items.reduce(
                    (sum, item) => sum + item.price * item.quantity,
                    0
                );

                cartCount.textContent = totalUnits;
                cartTotal.textContent = formatPrice(totalPrice);
                checkoutButton.disabled = items.length === 0;

                if (items.length === 0) {
                    const emptyMessage = document.createElement('p');

                    emptyMessage.className = 'cart-empty';
                    emptyMessage.textContent =
                        'Todavía no has añadido ninguna pizza.';

                    cartItems.appendChild(emptyMessage);
                    return;
                }

                items.forEach(item => {
                    const row = document.createElement('article');
                    row.className = 'cart-item';

                    const details = document.createElement('div');
                    details.className = 'cart-item-details';

                    const name = document.createElement('h3');
                    name.textContent = item.name;

                    const price = document.createElement('p');
                    price.textContent = formatPrice(
                        item.price * item.quantity
                    );

                    details.append(name, price);

                    const controls = document.createElement('div');
                    controls.className = 'cart-quantity';

                    const minus = document.createElement('button');
                    minus.type = 'button';
                    minus.textContent = '−';
                    minus.setAttribute(
                        'aria-label',
                        'Restar una unidad de ' + item.name
                    );
                    minus.disabled = item.quantity <= 1;
                    minus.addEventListener('click', () => {
                        changeQuantity(item.id, -1);
                    });

                    const quantity = document.createElement('span');
                    quantity.textContent = item.quantity;

                    const plus = document.createElement('button');
                    plus.type = 'button';
                    plus.textContent = '+';
                    plus.setAttribute(
                        'aria-label',
                        'Añadir una unidad de ' + item.name
                    );
                    plus.disabled = item.quantity >= 99;
                    plus.addEventListener('click', () => {
                        changeQuantity(item.id, 1);
                    });

                    controls.append(minus, quantity, plus);

                    const remove = document.createElement('button');
                    remove.type = 'button';
                    remove.className = 'cart-remove';
                    remove.textContent = 'Eliminar';
                    remove.setAttribute(
                        'aria-label',
                        'Eliminar ' + item.name + ' del pedido'
                    );
                    remove.addEventListener('click', () => {
                        removeItem(item.id);
                    });

                    row.append(details, controls, remove);
                    cartItems.appendChild(row);
                });
            }

            function showOrderConfirmation(orderNumber, total) {
                confirmationOpen = true;

                successOrderNumber.textContent = '#' + orderNumber;
                successOrderTotal.textContent = total;

                orderSuccess.inert = false;
                orderSuccess.classList.add('is-visible');
                orderSuccess.setAttribute('aria-hidden', 'false');

                closeCart(false);
                successClose.focus();
            }

            function closeOrderConfirmation() {
                confirmationOpen = false;

                orderSuccess.classList.remove('is-visible');
                orderSuccess.setAttribute('aria-hidden', 'true');
                orderSuccess.inert = true;

                if (previousFocus && typeof previousFocus.focus === 'function') {
                    previousFocus.focus();
                }
            }

            // Añadir pizzas al pedido.
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', () => {
                    addToCart(
                        button.dataset.id,
                        button.dataset.name,
                        Number(button.dataset.price)
                    );

                    openCart();
                });
            });

            openCartButton.addEventListener('click', openCart);

            closeCartButton.addEventListener('click', () => {
                closeCart();
            });

            cartOverlay.addEventListener('click', () => {
                closeCart();
            });

            // Confirmar el pedido simulado.
            checkoutButton.addEventListener('click', () => {
                const items = Object.values(cart);

                if (items.length === 0) return;

                const orderNumber = Math.floor(
                    100000 + Math.random() * 900000
                );

                const total = cartTotal.textContent;

                cart = {};
                saveCart();
                renderCart();

                showOrderConfirmation(orderNumber, total);
            });

            successClose.addEventListener(
                'click',
                closeOrderConfirmation
            );

            document.addEventListener('keydown', event => {
                if (event.key !== 'Escape') return;

                if (confirmationOpen) {
                    closeOrderConfirmation();
                } else if (cartPanel.classList.contains('is-open')) {
                    closeCart();
                }
            });

            // Renderizar el carrito al cargar la página.
            renderCart();
        })();
    </script>

</body>
</html>