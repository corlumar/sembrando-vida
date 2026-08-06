---
id: ARQ-010
titulo: Template Engine
tipo: Architecture
nivel: L1
categoria: Servicios Fundamentales
subcategoria: Generation
estado: Accepted
version: 2.0.0
responsable: MEF Architecture Team
ultima_revision: 2026-08-06
dependencias:
  - ARQ-003
  - ARQ-009
relacionados:
  - ARQ-011
  - ARQ-013
keywords:
  - template
  - scaffolding
  - generation
  - artifacts
  - templates
---

# ARQ-010

# Template Engine

## Estado

Accepted.

---

# 1. Propósito

Definir el **Template Engine** como el servicio oficial de generación de artefactos de **MEF (Modular Enterprise Framework)**.

El Template Engine transforma plantillas parametrizadas en artefactos completos y consistentes, reduciendo tareas repetitivas y asegurando el cumplimiento de los estándares arquitectónicos del Framework.

No ejecuta lógica de negocio.

No construye objetos en tiempo de ejecución.

Su responsabilidad es generar artefactos a partir de especificaciones.

---

# 2. Declaración

El Template Engine constituye el mecanismo oficial para automatizar la creación de componentes del Framework.

Toda generación deberá preservar:

- consistencia;
- trazabilidad;
- convenciones;
- calidad arquitectónica.

---

# 3. Objetivos

El Template Engine tiene los siguientes objetivos:

- automatizar la generación de artefactos;
- reducir errores manuales;
- mantener uniformidad;
- acelerar el desarrollo;
- facilitar la adopción del Framework;
- garantizar el cumplimiento de estándares.

---

# 4. Filosofía

Las plantillas representan conocimiento reutilizable.

No representan código fijo.

Toda plantilla deberá poder evolucionar sin afectar los artefactos previamente generados.

---

# 5. Modelo de Generación

```text
Specification
      │
      ▼
Template
      │
      ▼
Template Engine
      │
      ▼
Generated Artifact
```

El resultado deberá ser un artefacto válido y conforme a la arquitectura de MEF.

---

# 6. Artefactos Generables

El Template Engine podrá generar:

- Modules;
- Controllers;
- Services;
- Contracts;
- Events;
- Commands;
- Queries;
- DTO;
- Providers;
- Builders;
- Pipelines;
- Configuration;
- Manifest;
- Documentation;
- Tests.

Cada plantilla estará especializada en un tipo de artefacto.

---

# 7. Componentes

El Template Engine estará compuesto por:

- Repository de Templates;
- Parser;
- Motor de Renderizado;
- Validadores;
- Generadores;
- Post-Procesadores.

Cada componente deberá cumplir una única responsabilidad.

---

# 8. Plantillas

Toda plantilla deberá declarar:

- identificador;
- nombre;
- versión;
- autor;
- variables requeridas;
- artefacto generado;
- compatibilidad.

Las plantillas forman parte del conocimiento del Framework.

---

# 9. Variables

Toda plantilla deberá definir explícitamente:

- variables obligatorias;
- variables opcionales;
- valores por defecto;
- reglas de validación.

No deberán existir variables implícitas.

---

# 10. Flujo de Generación

```text
Template
      │
      ▼
Validation
      │
      ▼
Rendering
      │
      ▼
Generation
      │
      ▼
Verification
```

Cada etapa deberá completarse antes de continuar con la siguiente.

---

# 11. Validación

Antes de generar un artefacto deberá verificarse:

- existencia de la plantilla;
- variables requeridas;
- compatibilidad;
- restricciones arquitectónicas;
- conflictos de nombres.

---

# 12. Invariantes Arquitectónicos

| ID | Invariante |
|----|------------|
| AI-055 | Toda plantilla posee identidad única. |
| AI-056 | Toda plantilla declara versión. |
| AI-057 | Todo artefacto generado cumple las convenciones oficiales. |
| AI-058 | La generación es determinista. |
| AI-059 | Las plantillas son reutilizables. |
| AI-060 | El Template Engine no contiene lógica de negocio. |

---

# 13. Riesgos Arquitectónicos

Se deberán evitar:

- plantillas duplicadas;
- generación inconsistente;
- dependencias ocultas;
- plantillas no versionadas;
- modificaciones manuales de plantillas oficiales sin gobernanza.

---

# 14. Observabilidad

El Template Engine deberá registrar:

- plantilla utilizada;
- variables recibidas;
- artefacto generado;
- duración del proceso;
- errores detectados;
- versión de la plantilla.

---

# 15. Relación con otros componentes

```text
Builders
      │
      ▼
Template Engine
      │
      ▼
Generated Artifacts
      │
      ▼
Projects
```

Los Builders definen el proceso de construcción.

El Template Engine materializa dicho proceso mediante plantillas.

---

# 16. Principio Rector

> **Todo artefacto repetible deberá generarse mediante plantillas versionadas, reutilizables y alineadas con la arquitectura oficial de MEF.**

---

# Conclusión

El Template Engine constituye el mecanismo oficial de generación de artefactos de MEF.

Su propósito es transformar conocimiento arquitectónico en componentes consistentes, reutilizables y trazables, acelerando el desarrollo sin comprometer la calidad del Framework.

---

# Referencias

- ARQ-003 — Platform
- ARQ-009 — Builders
- ARQ-011 — Contracts
- ARQ-013 — Configuration