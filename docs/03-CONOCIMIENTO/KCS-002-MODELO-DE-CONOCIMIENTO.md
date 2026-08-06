---
id: KCS-002
titulo: Modelo de Conocimiento
tipo: Conocimiento
categoria: Arquitectura del Conocimiento
nivel: K0
estado: Aceptado
version: 1.0.0
autor: Equipo MEF
fecha_creacion: 2026-08-06
ultima_actualizacion: 2026-08-06
dependencias:
  - KCS-001
relacionados:
  - 00-FUNDACION
  - 01-ARQUITECTURA
  - 02-DICCIONARIO
---

# KCS-002
# Modelo de Conocimiento

## Estado

Aceptado.

---

# 1. Propósito

Definir el modelo mediante el cual el conocimiento de MEF es creado, organizado, relacionado, implementado y mantenido durante todo el ciclo de vida del Framework.

Este documento establece la arquitectura del conocimiento de MEF.

No describe software.

Describe cómo evoluciona el conocimiento que da origen al software.

---

# 2. Principio Fundamental

En MEF el conocimiento precede al código.

Toda implementación deberá originarse en un conocimiento previamente documentado.

El código representa una consecuencia del conocimiento.

Nunca su punto de partida.

---

# 3. Modelo General

El conocimiento fluye mediante una secuencia ordenada.

```text
Idea
    │
    ▼
RFC
    │
    ▼
ADR
    │
    ▼
Arquitectura
    │
    ▼
Ingeniería
    │
    ▼
Código
    │
    ▼
Testing
    │
    ▼
Release
    │
    ▼
Guías
    │
    ▼
Aplicaciones
```

Cada etapa agrega valor y reduce incertidumbre.

---

# 4. Capas del Conocimiento

El conocimiento se organiza en seis capas.

## Capa 0 — Fundación

Responde:

¿Por qué existe MEF?

Incluye:

- Visión
- Misión
- Valores
- Principios
- Doctrina

---

## Capa 1 — Arquitectura

Responde:

¿Cómo está construido?

Incluye:

- Core
- Platform
- Modules
- Kernel
- Registry

---

## Capa 2 — Ingeniería

Responde:

¿Cómo se implementa?

Incluye:

- Contracts
- Builders
- Events
- DI
- Value Objects

---

## Capa 3 — Infraestructura

Responde:

¿Cómo opera?

Incluye:

- SDK
- CLI
- Logging
- Cache
- Storage

---

## Capa 4 — Dominio

Responde:

¿Qué capacidades ofrece?

Incluye:

- CRM
- Inventarios
- Organización
- Finanzas

---

## Capa 5 — Aplicaciones

Responde:

¿Qué sistemas se construyen?

Incluye:

- Sembrando Vida
- ERP
- Hospital