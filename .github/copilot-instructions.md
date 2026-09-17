# Guía para Copilot y asistentes de IA

Este archivo describe el baseline técnico actual y las convenciones activas del repositorio.

No se debe inferir la arquitectura actual a partir de documentación histórica, código eliminado o scaffolding anterior.

## Baseline técnico actual

- Framework: Laravel 13.20.0.
- Runtime PHP: PHP 8.4.5.
- Restricción PHP en Composer: PHP ^8.3.
- Base de datos de desarrollo: MySQL.
- Base de datos de pruebas: SQLite en memoria cuando así lo configure el entorno de testing.
- Frontend: Vite + Tailwind CSS + Alpine.js.
- Cliente HTTP frontend: Axios.
- Entorno local: Windows + XAMPP.
- Zona horaria: America/Mexico_City.
- Idioma principal de la aplicación: español.

## Estado actual de la aplicación

El repositorio se encuentra en una etapa de reconstrucción limpia y controlada.

No se debe asumir que módulos funcionales históricos continúan activos.

Los modelos persistentes del baseline son:

- App\Models\User
- App\Models\Role

Los roles base se definen mediante App\Enums\RoleName.

Casos actualmente disponibles:

- ADMINISTRATOR => Administrador
- USER => Usuario

Los roles no deben comprobarse mediante IDs numéricos ni mediante cadenas de texto duplicadas.

Debe utilizarse el enum RoleName y la API centralizada de autorización.

## Baseline de base de datos

El esquema base se mantiene deliberadamente pequeño.

Las migraciones actuales proporcionan infraestructura para:

- roles
- users
- password reset tokens
- cache
- cache locks
- jobs
- job batches
- failed jobs

No se deben crear tablas de dominio funcional antes de diseñar el módulo correspondiente.

Las migraciones, modelos, factories, seeders y pruebas deben mantenerse consistentes entre sí.

El flujo base de roles es:

RoleName -> RolesSeeder -> tabla roles -> User.role_id

## Baseline frontend

Puntos de entrada actuales:

- resources\css\app.css
- resources\js\app.js
- resources\js\bootstrap.js

Tecnologías frontend activas:

- Vite
- Tailwind CSS
- Alpine.js
- Axios
- PostCSS
- Autoprefixer

Comandos principales:

npm install
npm run dev
npm run build

Los archivos generados por Vite dentro de public\build no son código fuente y no deben incluirse en Git.

La vista predeterminada welcome.blade.php fue retirada porque la ruta raíz redirige al flujo del dashboard autenticado.

## Rutas

Archivos principales:

- routes\web.php
- routes\auth.php
- routes\console.php

La ruta raíz redirige al dashboard.

El dashboard requiere autenticación.

No crear dashboards separados por rol salvo que exista un requerimiento funcional que lo justifique.

Para autorización de rutas debe preferirse el middleware centralizado.

## Providers y bootstrap

El provider principal de la aplicación es:

- app\Providers\AppServiceProvider.php

Los alias de middleware se configuran en:

- bootstrap\app.php

La configuración debe respetar la estructura actual de Laravel 13.

No recrear patrones de registro de middleware correspondientes a versiones anteriores de Laravel.

## Dependencias

Dependencias PHP principales:

- laravel/framework
- laravel/tinker

Dependencias de desarrollo principales:

- fakerphp/faker
- laravel/pail
- laravel/pint
- mockery/mockery
- nunomaduro/collision
- phpunit/phpunit

Laravel Breeze y Laravel Sail no forman parte del baseline actual.

No deben reintroducirse únicamente porque documentación histórica o ejemplos antiguos los mencionen.

Evitar actualizaciones generales de dependencias durante trabajos de arquitectura o saneamiento.

No ejecutar comandos automáticos de corrección de dependencias sin revisar previamente su impacto.

## Pruebas

La suite completa se ejecuta mediante:

php artisan test

Cuando se modifique autenticación o autorización, deben agregarse o actualizarse pruebas específicas.

El baseline actual contempla pruebas para:

- autenticación correcta;
- credenciales incorrectas;
- rechazo de usuarios inactivos;
- recuperación y cambio de contraseña;
- actualización de perfil;
- autorización mediante middleware de roles.

No utilizar la base MySQL de desarrollo para pruebas destructivas.

Las reconstrucciones de base de datos para validación deben realizarse en un entorno de testing aislado.

Para validar migraciones desde cero puede utilizarse SQLite en memoria mediante variables de entorno temporales.

## Convenciones de código

Preferir:

- declare(strict_types=1) en las clases PHP donde corresponda al baseline actual;
- tipos de retorno explícitos;
- relaciones Eloquent para relaciones ordinarias entre modelos;
- enums para valores controlados de roles;
- middleware para autorización a nivel de rutas;
- cambios pequeños, explícitos y acompañados de pruebas.

Evitar:

- IDs de rol escritos directamente en el código;
- nombres de roles duplicados como cadenas literales;
- código de scaffolding obsoleto;
- dependencias sin uso;
- abstracciones arquitectónicas prematuras;
- código funcional antes de aprobar el diseño del módulo;
- eliminación física silenciosa de identidades controladas.

## Política de saneamiento del repositorio

El repositorio ha pasado por un proceso de saneamiento y reconstrucción controlada.

Cuando se encuentre documentación o código histórico:

1. No asumir que representa la arquitectura activa.
2. Verificar primero la implementación actual.
3. Conservar documentación histórica cuando constituya evidencia de auditoría.
4. Eliminar residuos de código activo únicamente después de verificar sus referencias.
5. Mantener los cambios de saneamiento pequeños, verificables e independientes.

## Flujo seguro para realizar cambios

Antes de modificar la arquitectura:

1. Inspeccionar la implementación actual.
2. Verificar referencias y dependencias.
3. Realizar un cambio controlado.
4. Ejecutar pruebas específicas cuando corresponda.
5. Ejecutar la suite completa.
6. Ejecutar git diff --check.
7. Revisar git status.
8. Hacer commit únicamente de los archivos previstos.

No combinar saneamiento, actualizaciones de dependencias, rediseño de base de datos y desarrollo funcional en un mismo commit.

## Principio de reconstrucción

El baseline activo debe permanecer pequeño, explícito, comprobable y libre de supuestos provenientes de implementaciones históricas.

Los nuevos módulos funcionales deben diseñarse e incorporarse deliberadamente sobre este baseline, en lugar de reconstruirse copiando código obsoleto.
