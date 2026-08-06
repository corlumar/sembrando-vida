---
id: ARQ-012
titulo: Dependency Injection
tipo: Architecture
nivel: L1
categoria: Servicios Fundamentales
subcategoria: Dependency Injection
estado: Accepted
version: 2.0.0
responsable: MEF Architecture Team
ultima_revision: 2026-08-06
dependencias:
  - ARQ-007
  - ARQ-011
relacionados:
  - ARQ-009
  - ARQ-013
  - ARQ-014
keywords:
  - dependency injection
  - inversion of control
  - composition
  - contracts
  - services
---

# ARQ-012

# Dependency Injection

## Estado

Accepted.

---

# 1. Propósito

Definir la **Dependency Injection (DI)** como el mecanismo oficial mediante el cual **MEF (Modular Enterprise Framework)** entrega capacidades a los componentes utilizando Contracts y el Service Container.

La Dependency Injection permite construir componentes desacoplados, sustituibles y fácilmente verificables, evitando que los consumidores conozcan implementaciones concretas.

---

# 2. Declaración

La Dependency Injection constituye el mecanismo de materialización de los Contracts durante la ejecución.

Los consumidores no crearán sus propias dependencias.

Las dependencias serán suministradas por el Service Container conforme a la configuración del Framework.

---

# 3. Objetivos

La Dependency Injection tiene los siguientes objetivos:

- desacoplar consumidores de implementaciones;
- facilitar pruebas;
- permitir sustitución de componentes;
- centralizar la resolución de dependencias;
- favorecer la reutilización;
- preservar la independencia arquitectónica.

---

# 4. Filosofía

La Dependency Injection entrega capacidades.

No crea dependencias arbitrarias.

Los consumidores expresan **qué necesitan**.

El Framework decide **cómo resolverlo**.

---

# 5. Modelo Arquitectónico

```text
Consumer
      │
      ▼
Contract
      │
      ▼
Service Container
      │
      ▼
Implementation
```

La implementación permanece oculta para el consumidor.

---

# 6. Responsabilidades

La Dependency Injection es responsable de:

- suministrar implementaciones;
- respetar Contracts;
- preservar el desacoplamiento;
- facilitar pruebas y sustituciones;
- trabajar conjuntamente con el Service Container.

---

# 7. No responsabilidades

La Dependency Injection nunca deberá:

- descubrir componentes;
- registrar servicios;
- ejecutar lógica de negocio;
- administrar metadatos;
- reemplazar al Service Container.

---

# 8. Estrategias

MEF podrá soportar las siguientes estrategias.

| ID | Estrategia | Estado |
|----|------------|--------|
| DI-001 | Constructor Injection | Recomendada |
| DI-002 | Method Injection | Permitida |
| DI-003 | Property Injection | Restringida |
| DI-004 | Factory Injection | Permitida |

La estrategia preferida será siempre **Constructor Injection**.

---

# 9. Resolución

Toda dependencia será resuelta mediante un Contract.

```text
CustomerService
        │
        ▼
CustomerRepository Contract
        │
        ▼
MySqlCustomerRepository
```

El consumidor nunca dependerá directamente de la implementación.

---

# 10. Sustitución

Las implementaciones podrán sustituirse sin modificar el consumidor.

Ejemplo:

```text
CustomerRepository
        │
   ┌────┴──────────────┐
   ▼                   ▼
MySqlRepository   ApiRepository
```

La sustitución será transparente para los consumidores.

---

# 11. Ciclo de Vida

La Dependency Injection respetará el ciclo de vida declarado por el Service Container.

Ejemplos:

- Singleton;
- Scoped;
- Transient.

La gestión del ciclo de vida corresponde al Container.

---

# 12. Invariantes Arquitectónicos

| ID | Invariante |
|----|------------|
| AI-067 | Toda dependencia pública se expresa mediante un Contract. |
| AI-068 | Los consumidores no crean implementaciones. |
| AI-069 | La resolución corresponde al Service Container. |
| AI-070 | La sustitución de implementaciones será transparente. |
| AI-071 | La DI preserva el desacoplamiento arquitectónico. |
| AI-072 | Constructor Injection constituye la estrategia preferida. |

---

# 13. Riesgos Arquitectónicos

Se deberán evitar:

- creación manual de dependencias;
- uso excesivo de Property Injection;
- dependencias ocultas;
- Service Locator disfrazado;
- consumidores acoplados a implementaciones.

---

# 14. Observabilidad

El mecanismo de Dependency Injection deberá permitir:

- trazabilidad de resoluciones;
- diagnóstico de errores;
- auditoría de dependencias;
- visualización del grafo de composición;
- métricas de resolución.

---

# 15. Relación con otros componentes

```text
Contracts
      │
      ▼
Service Container
      │
      ▼
Dependency Injection
      │
      ▼
Consumers
```

Los Contracts definen los acuerdos.

El Container resuelve.

La Dependency Injection entrega las capacidades.

---

# 16. Principio Rector

> **Los componentes de MEF reciben capacidades mediante Dependency Injection basada en Contracts, preservando el desacoplamiento y permitiendo la evolución independiente de las implementaciones.**

---

# Conclusión

La Dependency Injection constituye el mecanismo oficial mediante el cual MEF materializa los Contracts durante la ejecución.

Su propósito es proporcionar capacidades de forma desacoplada, reutilizable y verificable, fortaleciendo la modularidad y la sostenibilidad del Framework.

---

# Referencias

- ARQ-007 — Service Container
- ARQ-009 — Builders
- ARQ-011 — Contracts
- ARQ-013 — Configuration
- ARQ-014 — Lifecycle