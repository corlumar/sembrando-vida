# Saneamiento del repositorio

## Propósito

Este directorio documenta el saneamiento controlado del repositorio
Laravel y las decisiones arquitectónicas derivadas del proceso.

El objetivo es reducir deuda técnica, separar artefactos históricos y
temporales, retirar componentes heredados que ya no forman parte de la
arquitectura objetivo y dejar una base verificable antes de continuar el
desarrollo.

## Estado actual

**Fase:** S1 --- Saneamiento del repositorio\
**Estado documentado:** hasta S1.3.2 ejecutado\
**S1.3.3:** definido, pendiente de confirmación de ejecución

## Puntos de recuperación

-   Rama de respaldo: `backup/pre-saneamiento-2026-08-21`
-   Commit de respaldo:
    `0bd4d28 chore: backup pre-saneamiento repositorio`
-   Tag: `pre-saneamiento-codigo-2026-08-21`
-   Rama de trabajo: `refactor/saneamiento-repositorio`
-   Tag publicado en `origin`.
-   Rama de respaldo publicada en `origin`.

## Archivo externo de artefactos

Los artefactos temporales y auxiliares no versionados fueron movidos
fuera del repositorio a:

`C:\xampp\htdocs\sembrando-vida-archivo-pre-saneamiento-2026-08-21`

El movimiento se realizó antes del saneamiento estructural y dejó
`git status --short` limpio.

## Documentos

-   `S1_SANEAMIENTO_REPOSITORIO.md`: bitácora técnica de la fase S1.
-   `DECISIONES_AQRQUITECTONICAS.md`: decisiones estructurales adoptadas
    durante el saneamiento.

## Principios de trabajo

1.  No eliminar sin contar con un punto de recuperación.
2.  Separar archivos temporales del historial Git.
3.  No reparar componentes heredados cuando resulte más seguro
    reconstruirlos.
4.  Mantener `Core`, `Platform` y `Modules` separados del dominio
    heredado.
5.  Realizar cortes pequeños y verificables.
6.  Registrar únicamente como ejecutadas las acciones ya confirmadas.
7.  Validar el repositorio antes de cada commit relevante.

## Próximo punto

Completar S1.3.3: reconstrucción de identidad y acceso (`users`,
`roles`, decisión sobre `subroles`) y validar las migraciones antes del
siguiente commit de saneamiento.
