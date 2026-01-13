# Notas sobre migraciones y claves foráneas

Fecha: 2026-01-13

Resumen:

- Se detectó un error al ejecutar `php artisan migrate:fresh` debido a claves foráneas que referenciaban la tabla `users` antes de que ésta existiera en el orden de migraciones.
- Para permitir recrear la base de datos en local sin fallos, se aplicaron cambios temporales en las migraciones originales y se añadió una migración nueva para crear las FKs faltantes.

Archivos modificados/añadidos:

- Modificado: `database/migrations/2025_09_25_194915_create_cacs_table.php`
  - `representante_id` cambiado a `unsignedBigInteger(...)->nullable()` (FK añadida posteriormente).

- Modificado: `database/migrations/2025_09_25_195122_create_sembradores_table.php`
  - `user_id` cambiado a `unsignedBigInteger(...)->nullable()` (FK añadida posteriormente).

- Añadido: `database/migrations/2026_01_13_204500_add_missing_foreign_keys.php`
  - Esta migración añade las siguientes constraints:
    - `users.role_id` -> `roles.id` (ON DELETE set null, ON UPDATE cascade)
    - `cacs.representante_id` -> `users.id` (ON DELETE set null, ON UPDATE cascade)
    - `sembradores.user_id` -> `users.id` (ON DELETE set null, ON UPDATE cascade)

Recomendaciones:

1. En entornos de producción/PR compartidos, es preferible mantener las migraciones originales claras y añadir migraciones posteriores que creen constraints (como se hizo aquí) en lugar de editar migraciones ya publicadas.
2. Si quieres restaurar el estilo original (usar `foreignId(...)->constrained()` en los archivos originales), considera revertir los cambios locales y dejar la migración `2026_01_13_204500_add_missing_foreign_keys.php` como responsable de las FKs. Cambiar timestamps de migraciones ya compartidas puede causar conflictos.
3. Hacer un backup previo (`mysqldump`) antes de ejecutar comandos destructivos en bases reales. En esta máquina no se detectó `mysqldump` en PATH al intentar crear dump.

Acción realizada:

- Ejecutado: `php artisan migrate:fresh --seed --force` luego de ajustar migraciones.
- Ejecutado: `php artisan migrate` para aplicar la migración que añade las FKs faltantes.

Si deseas, puedo:

- Revertir las ediciones a las migraciones originales y documentar el motivo en un CHANGELOG adicional.
- Crear migraciones adicionales si deseas reglas `ON DELETE` distintas.
