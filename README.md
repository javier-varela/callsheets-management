# Proyecto Laravel

Este es un proyecto desarrollado con el framework Laravel. Este sistema está diseñado para gestionar proyectos audiovisuales, proporcionando herramientas para crear y administrar **callsheets** (hojas de llamado) y eventos relacionados. A continuación, encontrarás las instrucciones para configurar y ejecutar el proyecto en tu entorno local.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

-   [PHP](https://www.php.net/downloads) >= 8.0
-   [Composer](https://getcomposer.org/)
-   [MySQL](https://www.mysql.com/) o cualquier base de datos compatible con Laravel
-   [Node.js](https://nodejs.org/) y npm
-   Un servidor web como Apache o Nginx

## Instalación

1. **Clona el repositorio**:

    ```bash
    git clone https://github.com/tu-usuario/tu-repositorio.git
    cd tu-repositorio
    ```

2. **Instala las dependencias de PHP**:

    ```bash
    composer install
    ```

3. **Instala las dependencias de JavaScript**:

    ```bash
    npm install
    ```

4. **Crea el archivo de configuración**:

    Copia el archivo `.env.example` y renómbralo como `.env`. Luego, actualiza las variables según tu entorno.

    ```bash
    cp .env.example .env
    ```

5. **Genera la clave de aplicación**:

    ```bash
    php artisan key:generate
    ```

6. **Configura la base de datos**:

    Actualiza las variables `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` en el archivo `.env`.

7. **Ejecuta las migraciones**:

    ```bash
    php artisan migrate
    ```

8. **Ejecuta los seeders (opcional)**:

    Si el proyecto incluye datos iniciales, ejecútalos con:

    ```bash
    php artisan db:seed
    ```

## Ejecución

1. **Levanta el servidor local**:

    ```bash
    php artisan serve
    ```

    Esto iniciará el servidor en `http://127.0.0.1:8000`.

2. **Compila los recursos frontend** (en modo desarrollo):

    ```bash
    npm run dev
    ```

    Para compilar en modo producción:

    ```bash
    npm run build
    ```

## Credenciales para Login

-   **User**: user1@user.com, user2@user.com, ..., user10@user.com
-   **Password**: password

## Características

-   **Framework**: Laravel 10+
-   **Base de datos**: MySQL
-   **Frontend**: Laravel Mix con soporte para Vue.js o React (según el proyecto)
-   **Autenticación**: Sistema de autenticación integrado de Laravel
-   **Gestión de proyectos audiovisuales**: Herramientas para administrar **callsheets** y eventos.

## Contribuciones

Si deseas contribuir a este proyecto, realiza un fork del repositorio y crea un pull request con tus cambios. Asegúrate de seguir los lineamientos de codificación.

## Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).
