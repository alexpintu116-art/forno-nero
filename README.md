# Forno Nero

Aplicación web de gestión para una pizzería, desarrollada con Laravel. Este proyecto personal forma parte de mi portfolio como desarrollador de aplicaciones web.

Forno Nero permite consultar una carta pública de pizzas y gestionar los productos desde un panel de administración protegido por autenticación.

## Funcionalidades

### Carta pública
- Página de inicio con diseño personalizado.
- Catálogo con nombres, descripciones, precios e imágenes opcionales.
- Solo se muestran las pizzas marcadas como disponibles.
- Página de inicio con una selección de hasta tres pizzas disponibles.

### Panel de administración
- Inicio y cierre de sesión.
- Listado de pizzas.
- Creación, edición y eliminación de productos.
- Activación y desactivación de la disponibilidad.
- Validación de los datos enviados en los formularios.
- Rutas administrativas protegidas mediante autenticación.
- Limitación de intentos de inicio de sesión.

### Pruebas
La suite automatizada incluye pruebas de acceso al panel, visibilidad de productos, validación y operaciones CRUD.

## Tecnologías

- PHP 8.3
- Laravel 13
- MySQL
- Blade
- HTML5 y CSS3
- Git y GitHub

## Requisitos

- PHP compatible con Laravel 13.
- Composer.
- MySQL o MariaDB compatible.
- Node.js y npm si necesitas compilar recursos frontend.

## Instalación local

### 1. Clonar el repositorio

```bash
git clone https://github.com/alexpintu116-art/forno-nero.git
cd forno-nero
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar el entorno

En Windows, copia el archivo de ejemplo:

```bat
copy .env.example .env
```

Edita `.env` y configura la conexión a tu base de datos local. No publiques este archivo ni compartas sus credenciales.

### 4. Generar la clave de aplicación

```bash
php artisan key:generate
```

### 5. Crear la base de datos

Crea una base de datos vacía llamada `pizzeriaos` en MySQL y configura las variables `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` en `.env` según tu entorno local.

### 6. Ejecutar las migraciones y los datos de demostración

```bash
php artisan migrate --seed
```

El seeder crea un usuario de prueba y cuatro pizzas de ejemplo. La contraseña predeterminada de la fábrica es solo para desarrollo local: no uses esas credenciales en un servidor público.

### 7. Iniciar la aplicación

```bash
php artisan serve
```

Abre http://127.0.0.1:8000 en el navegador.

## Ejecutar las pruebas

```bash
php artisan test
```

## Alcance actual

Este proyecto se centra en la carta pública y la gestión de pizzas. El carrito o la confirmación de pedido en el navegador, si están habilitados en la interfaz, no representan por sí solos un sistema de pedidos persistente ni un proceso de pago real.

## Mejoras futuras

- Añadir capturas de pantalla.
- Ampliar las pruebas automatizadas.
- Incorporar una gestión persistente de pedidos.
- Preparar y documentar un despliegue seguro en producción.

## Autor

Proyecto personal desarrollado para practicar Laravel, PHP, bases de datos, autenticación, validación de formularios y control de versiones con Git.
