# 📚 Sistema de Gestión de Préstamos y Devoluciones

Este es un sistema básico para la gestión de préstamos y devoluciones de equipos, desarrollado con Laravel. Permite llevar un control de los equipos, las personas (estudiantes, docentes) que los solicitan y el estado de cada préstamo.

## ✨ Características

*   Registro y gestión de equipos.
*   Registro de personas (estudiantes, docentes) y encargados.
*   Control de préstamos y devoluciones.
*   Gestión de marcas y estados de equipos.
*   Roles de usuario para acceso diferenciado.

## 🛠️ Tecnologías

*   **Backend:** Laravel (PHP)
*   **Frontend:** Blade, Tailwind CSS, Vite
*   **Base de Datos:** MySQL

## 🚀 Instalación

Sigue estos pasos para poner en marcha el proyecto:

1.  Clona el repositorio:
    ```bash
    git clone https://github.com/tu-usuario/tu-repositorio.git
    cd proyecto-laravel-prestamos-devoluciones
    ```
2.  Instala las dependencias de Composer:
    ```bash
    composer install
    ```
3.  Instala las dependencias de NPM y compila los assets:
    ```bash
    npm install
    npm run dev
    ```
4.  Copia `.env.example` a `.env` y configura tu base de datos. Genera la clave de aplicación:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
5.  Ejecuta las migraciones y seeders para crear la base de datos y datos iniciales:
    ```bash
    php artisan migrate --seed
    ```
6.  Inicia el servidor de desarrollo:
    ```bash
    php artisan serve
    ```

## 💡 Uso

Accede al sistema a través de la URL que te proporcione `php artisan serve`. Podrás registrar equipos, personas y gestionar los préstamos y devoluciones.

## 🤝 Contribución

¡Las contribuciones son bienvenidas! Si deseas mejorar este proyecto, por favor, haz un fork del repositorio, crea una rama con tus cambios y abre un Pull Request.

## 📄 Licencia

Este proyecto está bajo la licencia MIT. Consulta el archivo `LICENSE` para más detalles.
