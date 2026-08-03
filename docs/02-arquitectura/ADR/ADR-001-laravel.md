# ADR-001

# Adopción de Laravel como Framework Principal

**Estado:** Aprobado

**Fecha:** 2026

---

# Contexto

El ERP Core requiere un framework moderno que permita desarrollar una plataforma empresarial modular, segura y mantenible.

La solución debe soportar:

- aplicaciones web;
- APIs REST;
- autenticación;
- autorización;
- colas;
- eventos;
- pruebas automatizadas;
- escalabilidad.

---

# Alternativas consideradas

## Laravel

Ventajas

- Arquitectura madura.
- Amplio ecosistema.
- Excelente documentación.
- Comunidad muy grande.
- Productividad elevada.
- Integración sencilla con Tailwind, Livewire y Vue.
- Buen soporte para pruebas.
- Excelente manejo de migraciones.

---

## Symfony

Ventajas

- Muy robusto.
- Altamente configurable.

Desventajas

- Mayor curva de aprendizaje.
- Mayor tiempo de desarrollo.

---

## ASP.NET Core

Ventajas

- Excelente rendimiento.
- Muy robusto.

Desventajas

- Mayor complejidad para algunos perfiles del equipo.
- Requiere ecosistema .NET.

---

## Spring Boot

Ventajas

- Muy escalable.
- Amplio uso empresarial.

Desventajas

- Mayor complejidad.
- Desarrollo más lento para el tipo de proyectos objetivo.

---

# Decisión

Se adopta Laravel como framework principal del ERP Core.

---

# Justificación

Laravel ofrece el mejor equilibrio entre:

- productividad;
- mantenibilidad;
- seguridad;
- escalabilidad;
- ecosistema;
- facilidad de incorporación de nuevos desarrolladores.

---

# Consecuencias

## Positivas

- Desarrollo más rápido.
- Ecosistema consolidado.
- Gran disponibilidad de talento.
- Excelente documentación.

## Negativas

- Dependencia del ecosistema PHP.
- Algunas características requieren componentes adicionales.

---

# Revisión

La decisión podrá revisarse únicamente si aparecen razones técnicas de alto impacto que justifiquen un cambio de plataforma.