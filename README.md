# Forno Nero 🍕

**Aplicación web de gestión para una pizzería desarrollada con Laravel.**

Forno Nero es un proyecto personal de portfolio que permite mostrar una carta de pizzas y administrar los productos mediante un panel privado.

## Funcionalidades

### Carta pública
- Página principal con diseño personalizado.
- Catálogo de pizzas con imágenes, descripciones y precios.
- Visualización únicamente de pizzas disponibles.

### Panel de administración
- Inicio y cierre de sesión.
- Listado de productos.
- Creación, edición y eliminación de pizzas.
- Activación y desactivación de la disponibilidad.
- Validación de los formularios.
- Protección de las rutas administrativas mediante autenticación.

### Seguridad y pruebas
- Contraseñas almacenadas mediante hash.
- Protección CSRF en formularios.
- Limitación de intentos de inicio de sesión.
- Pruebas automatizadas de acceso, validación y operaciones CRUD.

## Tecnologías utilizadas

- PHP 8.3
- Laravel 13
- MySQL
- Blade
- HTML5 y CSS3
- Git

## Requisitos

- PHP compatible con Laravel.
- Composer.
- MySQL.
- Node.js y npm si necesitas compilar recursos frontend.

## Instalación local

1. Clona el repositorio:

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   ```

2. Entra en la carpeta:

   ```bash
   cd pizzeriaos
   ```

3. Instala las dependencias:

   ```bash
   composer install
   ```

4. Copia el archivo de configuración:

   ```bash
   copy .env.example .env
   ```

   En macOS o Linux puedes usar `cp .env.example .env`.

5. Genera la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

6. Crea una base de datos MySQL llamada `pizzeriaos` y configura la conexión en `.env`.

7. Ejecuta las migraciones:

   ```bash
   php artisan migrate --seed
   ```

8. Inicia el servidor:

   ```bash
   php artisan serve
   ```

9. Abre `http://127.0.0.1:8000`.

**Nota:** configura un usuario administrador de forma segura. No publiques credenciales ni el archivo `.env`.

## Pruebas automatizadas

Para ejecutar la suite de pruebas:

```bash
php artisan test
```

Las pruebas verifican el acceso al panel, la visibilidad de las pizzas, las operaciones CRUD y las restricciones para visitantes sin autenticar.

## Mejoras futuras

- Añadir capturas de pantalla.
- Ampliar las pruebas automatizadas.
- Mejorar el diseño adaptable a móviles.
- Incorporar gestión de pedidos.
- Preparar el despliegue en producción.

## Autor

Proyecto personal desarrollado como parte de mi aprendizaje y portfolio como desarrollador de aplicaciones web.
