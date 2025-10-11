<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Plataforma Sembrando Vida – Sistema de Gestión en Laravel

Este sistema permite la administración integral de técnicos, sembradores, Centros de Acopio Comunitario (CAC), territorios, cultivos, cosechas y otros elementos vinculados al programa *Sembrando Vida*.  
Está desarrollado en **Laravel**, siguiendo principios de escalabilidad, seguridad y gestión por roles.

---

## Características principales

- Inicio de sesión con control de acceso basado en roles.
- Paneles personalizados de acuerdo con el tipo de usuario.
- Registro y administración de territorios, CAC y personal técnico.
- Gestión de cultivos, cosechas y productos semiprocesados.
- Exportación de información en formatos Excel, PDF e impresión.
- Arquitectura modular para futuras ampliaciones.

---

## Instalación en entorno local (Windows / XAMPP)

```bash
# 1. Clonar el repositorio
git clone https://github.com/corlumar/sembrando-vida.git
cd sembrando-vida

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JavaScript
npm install

# 4. Configurar archivo de entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env
# 6. Ejecutar migraciones y datos iniciales
php artisan migrate --seed

# Ambiente de desarrollo
npm run dev

# Ambiente de producción
npm run build

| Rol                  | Descripción general de permisos            |
| -------------------- | ------------------------------------------ |
| Administrador        | Control total del sistema y configuración  |
| Técnico              | Gestión de sembradores y CAC asignados     |
| Coordinador          | Supervisión por territorio                 |
| Enlace / Funcionario | Acceso a reportes e información agregada   |
| Sembrador            | Registro de cultivos y cosechas personales |

app/
├── Http/
│   ├── Controllers/    # Controladores del sistema
│   ├── Middleware/     # Middleware de control de roles
│   └── Requests/       # Validaciones de formularios
├── Models/             # Modelos principales de datos
resources/views/
├── layouts/            # Plantillas base de interfaz
├── dashboards/         # Vistas específicas por rol
└── auth/               # Autenticación y registro
database/
├── migrations/         # Estructura de tablas
└── seeders/            # Carga inicial de datos

main      → Rama estable (producción)
develop   → Rama de integración
feature/* → Ramas para nuevas funcionalidades

git checkout -b feature/gestion-cultivos
git add .
git commit -m "Implementa módulo de cultivos"
git push


---

