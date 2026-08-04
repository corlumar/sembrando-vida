# ARQ-001 — Visión General de la Arquitectura

## Estado

Aceptado.

## Contexto

MEF debe proporcionar una base reutilizable para construir múltiples aplicaciones empresariales sin acoplar el Framework a una solución concreta.

La arquitectura debe permitir:

- incorporar módulos independientes;
- compartir servicios comunes;
- mantener el Core libre de lógica de negocio;
- evolucionar sin reescrituras constantes;
- soportar diferentes aplicaciones sobre la misma base.

---

## Decisión

MEF adopta una arquitectura en cuatro capas:

```text
Applications
Modules
Platform
Core