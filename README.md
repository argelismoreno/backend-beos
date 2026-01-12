# API de Gestión de Productos

Esta es una API RESTful construida con Laravel 12 para la gestión de productos y precios en múltiples monedas.

## 📋 Requisitos Previos

Asegúrate de tener instalado:
*   [PHP 8.2+](https://www.php.net/)
*   [Composer](https://getcomposer.org/)
*   [MySQL](https://www.mysql.com/)
*   [Laragon](https://laragon.org/) (Recomendado para Windows)

## 🚀 Instalación y Configuración

1.  **Clonar el repositorio:**
    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd test-backend-beos
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    ```

3.  **Configurar entorno:**
    *   Copia el archivo `.env.example` a `.env`:
        ```bash
        copy .env.example .env
        ```
    *   Abre el archivo `.env` y configura tu base de datos:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=nombre_de_tu_base_de_datos
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4.  **Generar clave de aplicación:**
    ```bash
    php artisan key:generate
    ```

5.  **Migraciones y Datos de Prueba (Seeders):**
    Este comando creará las tablas y poblará la base de datos con un usuario administrador, monedas reales y productos de prueba con precios consistentes.
    ```bash
    php artisan migrate --seed
    ```

## 🛠️ Ejecución

```bash
php artisan serve
```
La API estará disponible en `http://127.0.0.1:8000`.

## 📚 Documentación de API (Swagger)

Puedes ver y probar todos los endpoints de la API de forma interactiva en la siguiente URL:

👉 **[http://127.0.0.1:8000/api/documentation](http://127.0.0.1:8000/api/documentation)**

(Ajusta el dominio según tu configuración local).

### Autenticación en Swagger
Las rutas de escritura (`POST`, `PUT`, `DELETE`) están protegidas.
1.  Usa el endpoint `POST /login` en Swagger con:
    *   **Email:** `admin@example.com`
    *   **Password:** `password`
2.  Copia el `token` de la respuesta JSON.
3.  Haz clic en el botón **Authorize** arriba a la derecha.
4.  Pega el token en el campo de texto.
5.  ¡Listo! Ahora puedes probar los endpoints protegidos.

## ✅ Pruebas (Tests)

El proyecto utiliza **Pest PHP** para pruebas automatizadas. Para ejecutarlas:

```bash
php artisan test
```

ten en cuenta tener habilitado la extenciones de php

```bash
extension=pdo_sqlite
extension=sqlite3
```

## 📂 Estructura Clave

*   `app/Models`: Modelos Eloquent (`Product`, `ProductPrice`, `Currency`).
*   `app/Http/Controllers/Api`: Controladores de la API.
*   `app/Http/Resources`: Transformadores JSON para respuestas limpias.
*   `database/seeders`: `ProductSeeder` (lógica avanzada de precios) y `CurrencySeeder`.
*   `public/openapi.yaml`: Archivo fuente de la documentación Swagger.

---
Desarrollado con ❤️ usando Laravel.
