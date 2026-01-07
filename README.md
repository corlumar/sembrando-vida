<p align="center">
  <img src="public/img/logosv.png" width="120" alt="Sembrando Vida Logo">
</p>

# 🌱 Plataforma Sembrando Vida

Sistema web para la operación y seguimiento del programa **Sembrando Vida**, desarrollado en **Laravel 12** con **AdminLTE**, enfocado en facilitar la gestión operativa entre diferentes perfiles de usuario.

---

## ✅ Roles y Funcionalidades Principales

| Rol                    | Funcionalidad Principal                                 |
|------------------------|----------------------------------------------------------|
| Administrativo          | Administración general, usuarios, reportes y métricas   |
| Coordinador Territorial | Supervisión de CACs, Técnicos y Sembradores por región |
| Enlace Comercial        | Gestión de Tianguis y comercialización de productos     |
| Técnico                 | Registro de cultivos, cosechas y avances de campo      |
| Sembrador              | Acceso personal a su información y actividades          |

---

## 🚀 Instalación Rápida

Clonar el repositorio:

```bash
git clone https://github.com/corlumar/sembrando-vida.git
cd sembrando-vida
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

📌 Tecnologías Utilizadas

Laravel 12

PHP 8.4

MySQL

AdminLTE / Bootstrap 4

Chart.js (Gráficas en panel administrativo)

LeafletJS (Mapa de CACs - próximamente)

🔧 Próximos Módulos

📍 Mapa interactivo con CACs y técnicos

📊 Reportes PDF / Excel exportables

📱 Versión móvil progresiva (PWA)

🗂️ Importación masiva CSV / Excel de usuarios y sembradores

📷 Capturas (por agregar)

En desarrollo — se agregarán imágenes de los dashboards cuando avance la interfaz final.

🧾 Licencia

Proyecto interno para gestión del programa Sembrando Vida — Uso institucional.


---

## Nota sobre migraciones duplicadas

Se detectaron migraciones con timestamps duplicados/solapados en `database/migrations`.
Para evitar que Artisan intente crear tablas que ya existen, en el repositorio se movieron temporalmente los archivos duplicados a `database/migrations/duplicates/`.

Si trabajas localmente y encuentras errores tipo "Table 'xyz' already exists":

- Verifica la conexión activa en `.env` (`DB_CONNECTION`) y limpia la caché de configuración:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

- Revisa el estado de las migraciones:

```bash
php artisan migrate:status
```

- Si las tablas ya existen y no quieres volver a crearlas, marca las migraciones como ejecutadas (opción segura para entornos con datos):

```bash
php artisan tinker --execute="DB::table('migrations')->insert(['migration'=>'FILENAME','batch'=>X]);"
```

- Si estás en desarrollo y puedes perder datos, recrea la BD:

```bash
php artisan migrate:fresh --seed
```

Si tienes dudas, pregunta antes de borrar o renombrar migraciones; puedo ayudarte a revisar los archivos afectados.




