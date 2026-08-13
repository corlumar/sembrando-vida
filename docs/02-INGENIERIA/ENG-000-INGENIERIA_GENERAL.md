---
id: ENG-000
titulo: Ingeniería General
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: General
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - FND-004
  - FND-011
  - FND-013
  - ARQ-000
  - ARQ-001
relacionados:
  - ENG-001
  - ENG-002
  - ENG-003
  - ENG-004
keywords:
  - engineering
  - implementation
  - standards
  - development
  - quality
  - mef
---

# ENG-000

# Ingeniería General

## Estado

Accepted.

---

# 1. Propósito

Definir el marco general de **Ingeniería de MEF (Modular Enterprise Framework)** y establecer los principios mediante los cuales la arquitectura del Framework se transforma en implementaciones concretas, verificables, mantenibles y reproducibles.

Este documento constituye la especificación raíz de la capa de Ingeniería.

La Ingeniería define **cómo se construye MEF**.

# Posición de ENG-000 dentro de la serie

ENG-000 — Ingeniería General constituye el documento rector y
metanormativo de la familia Engineering de MEF.

ENG-000 no forma parte de la secuencia ordinaria de especificaciones
ENG-001 → ENG-100 y no deberá contabilizarse como una especificación
Engineering adicional.

La serie normativa Engineering queda definida como:

ENG-001 → ENG-100

Total de especificaciones numeradas de la serie: 100.

ENG-000 establece convenciones, principios y reglas generales
aplicables transversalmente a dicha serie.

---

# 2. Declaración

La Ingeniería de MEF materializa las decisiones establecidas por la Fundación y la Arquitectura.

Su responsabilidad consiste en transformar especificaciones arquitectónicas en soluciones técnicas sin alterar los principios, límites e invariantes definidos por niveles superiores.

La relación fundamental será:

```text
Fundación
    │
    │ define principios
    ▼
Arquitectura
    │
    │ define estructuras y responsabilidades
    ▼
Ingeniería
    │
    │ define mecanismos de implementación
    ▼
Código
```

La implementación deberá ajustarse a la arquitectura.

La arquitectura no deberá modificarse para justificar accidentalmente una implementación.

---

# 3. Posición dentro de MEF

La documentación de MEF mantiene diferentes niveles de abstracción.

| Nivel | Área | Pregunta principal |
|-------|------|--------------------|
| L0 | Fundación | ¿Por qué existe y bajo qué principios? |
| L1 | Arquitectura | ¿Qué componentes y relaciones existen? |
| L2 | Ingeniería | ¿Cómo se implementan? |
| L3 | Implementación | ¿Cuál es el código concreto? |
| L4 | Operación | ¿Cómo se ejecuta y administra? |

Ingeniería corresponde al nivel **L2**.

---

# 4. Objetivos

La Ingeniería de MEF tiene como objetivos:

- materializar la arquitectura;
- establecer estándares técnicos;
- normalizar estructuras de código;
- definir convenciones de implementación;
- garantizar reproducibilidad;
- facilitar automatización;
- establecer mecanismos de validación;
- garantizar testabilidad;
- facilitar mantenimiento;
- preservar independencia tecnológica;
- controlar deuda técnica;
- asegurar trazabilidad entre especificación y código.

---

# 5. Principio de Conformidad Arquitectónica

Toda implementación deberá demostrar conformidad con la arquitectura vigente.

```text
Architecture Specification
          │
          ▼
Engineering Specification
          │
          ▼
Implementation
          │
          ▼
Verification
```

La Ingeniería no podrá introducir comportamientos que contradigan:

- Fundación;
- Arquitectura;
- Contracts;
- Invariantes Arquitectónicos;
- decisiones arquitectónicas vigentes.

---

# 6. Separación entre Arquitectura e Ingeniería

La Arquitectura determina:

- responsabilidades;
- límites;
- relaciones;
- componentes;
- contratos conceptuales;
- invariantes.

La Ingeniería determina:

- estructuras de directorios;
- interfaces técnicas;
- formatos;
- esquemas;
- convenciones;
- herramientas;
- algoritmos;
- comandos;
- validadores;
- estrategias de pruebas;
- procesos de construcción.

Ejemplo:

```text
ARQ-004
Modules
     │
     │ define qué es un Module
     ▼
ENG-002
Especificación de Modules
     │
     │ define cómo se implementa
     ▼
Código
```

---

# 7. Independencia del Framework

La Ingeniería deberá preservar la independencia tecnológica establecida por MEF.

Una implementación podrá utilizar tecnologías concretas.

La especificación de Ingeniería no deberá convertir dichas tecnologías en fundamentos conceptuales del Framework salvo decisión formal de gobernanza.

Por ejemplo:

```text
MEF Contract
     │
     ├── PHP Adapter
     ├── Java Adapter
     ├── .NET Adapter
     └── JavaScript Adapter
```

El Contract pertenece a MEF.

El Adapter pertenece a una implementación.

---

# 8. Principios de Ingeniería

## ENG-P01 — Conformidad

Toda implementación deberá respetar la arquitectura vigente.

## ENG-P02 — Simplicidad

Se preferirá la solución técnicamente más simple que satisfaga completamente la especificación.

## ENG-P03 — Modularidad

Las implementaciones deberán preservar límites explícitos entre componentes.

## ENG-P04 — Testabilidad

Todo componente relevante deberá poder verificarse mediante pruebas automatizadas.

## ENG-P05 — Reproducibilidad

Construcciones, pruebas y distribuciones deberán poder reproducirse.

## ENG-P06 — Automatización

Los procesos repetitivos deberán automatizarse cuando exista beneficio técnico verificable.

## ENG-P07 — Observabilidad

Los componentes operativos deberán proporcionar información suficiente para diagnóstico y seguimiento.

## ENG-P08 — Seguridad

La seguridad deberá incorporarse durante el diseño y la implementación.

## ENG-P09 — Portabilidad

Las decisiones técnicas evitarán dependencias innecesarias respecto de una plataforma concreta.

## ENG-P10 — Trazabilidad

Toda implementación significativa deberá poder relacionarse con la especificación que la origina.

---

# 9. Modelo de Implementación

MEF adopta el siguiente flujo general:

```text
Requirement
     │
     ▼
Architecture
     │
     ▼
Engineering Specification
     │
     ▼
Implementation
     │
     ▼
Static Validation
     │
     ▼
Automated Tests
     │
     ▼
Architectural Validation
     │
     ▼
Package
```

Cada etapa proporciona evidencia para la siguiente.

---

# 10. Unidad de Ingeniería

La unidad básica de trabajo técnico será el **Engineering Artifact**.

Un Engineering Artifact puede ser:

- código fuente;
- esquema;
- Manifest;
- configuración;
- plantilla;
- prueba;
- comando;
- generador;
- adaptador;
- script de construcción;
- especificación técnica.

Todo artefacto relevante deberá poseer un propósito identificable.

---

# 11. Trazabilidad

La Ingeniería deberá mantener trazabilidad entre:

```text
FND
 │
 ▼
ARQ
 │
 ▼
ENG
 │
 ▼
ADR / RFC
 │
 ▼
Implementation
 │
 ▼
Tests
```

No todas las implementaciones requerirán un ADR o RFC.

Sin embargo, las decisiones relevantes deberán quedar registradas mediante los mecanismos de gobernanza correspondientes.

---

# 12. Código como Implementación

El código fuente representa una implementación de la arquitectura.

No constituye por sí mismo la especificación arquitectónica.

Por tanto:

> El comportamiento observado en el código no sustituye una especificación formal cuando dicha especificación sea requerida por MEF.

Esta separación evita convertir decisiones accidentales de implementación en reglas permanentes del Framework.

---

# 13. Convenciones

Las convenciones oficiales deberán definirse explícitamente.

Podrán regular:

- nombres;
- namespaces;
- directorios;
- archivos;
- clases;
- Contracts;
- Events;
- Modules;
- Packages;
- Tests;
- documentación técnica.

Las convenciones detalladas serán establecidas en documentos ENG especializados.

---

# 14. Automatización

MEF favorecerá la automatización de procesos como:

```text
Create
  ↓
Generate
  ↓
Validate
  ↓
Build
  ↓
Test
  ↓
Package
  ↓
Verify
```

La automatización deberá reducir variabilidad sin ocultar decisiones importantes.

---

# 15. Validación

La Ingeniería deberá contemplar diferentes niveles de validación.

| Nivel | Propósito |
|-------|-----------|
| Sintáctica | Verificar estructura y formato. |
| Semántica | Verificar coherencia del artefacto. |
| Contractual | Verificar cumplimiento de Contracts. |
| Arquitectónica | Verificar cumplimiento de ARQ y AI. |
| Integración | Verificar interacción entre componentes. |
| Operativa | Verificar comportamiento en ejecución. |

---

# 16. Pruebas

Las pruebas constituyen evidencia de conformidad.

MEF podrá utilizar:

- Unit Tests;
- Integration Tests;
- Contract Tests;
- Architecture Tests;
- Compatibility Tests;
- Security Tests;
- End-to-End Tests.

La estrategia detallada se establecerá en **ENG-009 — Testing**.

---

# 17. Architectural Tests

MEF reconocerá las pruebas arquitectónicas como una categoría independiente.

Estas pruebas podrán verificar automáticamente reglas como:

- dirección de dependencias;
- ausencia de ciclos;
- límites entre Modules;
- uso de Contracts;
- acceso a APIs públicas;
- cumplimiento de convenciones;
- invariantes arquitectónicos verificables.

```text
Architecture
      │
      ▼
Architectural Rules
      │
      ▼
Automated Verification
      │
      ▼
Compliance Report
```

---

# 18. Calidad

La calidad de Ingeniería deberá evaluarse considerando:

- correctitud;
- mantenibilidad;
- testabilidad;
- seguridad;
- rendimiento;
- portabilidad;
- legibilidad;
- compatibilidad;
- observabilidad.

Ningún atributo deberá optimizarse ignorando deliberadamente los demás.

---

# 19. Deuda Técnica

La deuda técnica deberá ser explícita.

Cuando una implementación no pueda cumplir completamente una especificación deberá documentarse:

- desviación;
- causa;
- impacto;
- riesgo;
- responsable;
- estrategia de resolución.

La deuda técnica conocida no deberá convertirse silenciosamente en arquitectura.

---

# 20. Seguridad de Ingeniería

La implementación deberá aplicar los principios establecidos en **ARQ-016 — Security**.

La Ingeniería podrá definir posteriormente mecanismos concretos para:

- autenticación;
- autorización;
- gestión de secretos;
- integridad;
- validación de entradas;
- protección de dependencias;
- seguridad de Packages;
- auditoría.

La selección de tecnologías deberá permanecer separada del principio arquitectónico que implementa.

---

# 21. Compatibilidad

Las implementaciones deberán declarar las restricciones de compatibilidad relevantes.

Podrán incluir:

- versión de MEF;
- versión de Contracts;
- versión de Modules;
- plataforma;
- Runtime;
- dependencias externas.

Las incompatibilidades deberán detectarse antes de la ejecución cuando sea técnicamente posible.

---

# 22. Reproducibilidad

Una misma versión del código, configuración y dependencias deberá producir resultados de construcción equivalentes.

MEF favorecerá:

- dependencias versionadas;
- entornos controlados;
- procesos automatizados;
- builds deterministas;
- artefactos verificables.

---

# 23. Portabilidad

La Ingeniería distinguirá entre:

```text
Specification
     │
     ▼
Portable Implementation
     │
     ▼
Platform Adapter
```

Los elementos dependientes de una tecnología deberán mantenerse detrás de límites explícitos.

---

# 24. Observabilidad

Los componentes técnicos deberán proporcionar, cuando corresponda:

- logs;
- métricas;
- traces;
- eventos;
- diagnósticos;
- información de estado.

La observabilidad deberá diseñarse como una capacidad técnica y no añadirse únicamente después de la implementación.

---

# 25. Documentación Técnica

Todo componente significativo deberá disponer de documentación suficiente para comprender:

- propósito;
- configuración;
- dependencias;
- contratos;
- uso;
- pruebas;
- restricciones;
- compatibilidad.

El código no sustituye la documentación necesaria.

---

# 26. Cambios de Ingeniería

Un cambio técnico deberá clasificarse según su impacto.

```text
Implementation Change
        │
        ├── Local
        ├── Engineering
        ├── Architectural
        └── Foundational
```

Un cambio local podrá resolverse dentro de Ingeniería.

Un cambio que afecte Arquitectura deberá escalarse al mecanismo de gobernanza correspondiente.

La Ingeniería no podrá modificar unilateralmente una decisión arquitectónica.

---

# 27. Relación con RFC y ADR

Los RFC permitirán proponer cambios relevantes.

Los ADR registrarán decisiones arquitectónicas significativas.

La Ingeniería implementará las decisiones aprobadas.

```text
RFC
 │
 ▼
Decision
 │
 ▼
ADR
 │
 ▼
ENG
 │
 ▼
Implementation
```

La aplicación exacta dependerá de la naturaleza del cambio.

---

# 28. Estructura de Ingeniería

La especificación inicial de Ingeniería estará organizada de la siguiente manera:

| Documento | Propósito |
|-----------|-----------|
| ENG-000 | Ingeniería General |
| ENG-001 | Organización del Código |
| ENG-002 | Especificación de Modules |
| ENG-003 | Manifest |
| ENG-004 | Convenciones |
| ENG-005 | Nomenclatura |
| ENG-006 | Estructura de Directorios |
| ENG-007 | CLI |
| ENG-008 | Generadores |
| ENG-009 | Testing |
| ENG-010 | Logging |
| ENG-011 | Configuration Files |
| ENG-012 | Build System |
| ENG-013 | Package Manager |
| ENG-014 | Versionado |
| ENG-015 | Architectural State Machine |
| ENG-016 | Extension SDK |
| ENG-017 | Release Process |

Esta clasificación podrá evolucionar mediante los mecanismos oficiales de gobernanza.

---

# 29. Relación con Arquitectura

```text
ARQ-004 Modules
        │
        └── ENG-002 Module Specification

ARQ-010 Template Engine
        │
        └── ENG-008 Generators

ARQ-013 Configuration
        │
        └── ENG-011 Configuration Files

ARQ-014 Framework Lifecycle
        │
        └── ENG-015 Architectural State Machine

ARQ-015 Extension Model
        │
        └── ENG-016 Extension SDK

ARQ-017 Packaging
        │
        ├── ENG-013 Package Manager
        └── ENG-017 Release Process
```

La relación no implica correspondencia uno a uno obligatoria.

Un documento ENG podrá implementar requisitos provenientes de varios documentos ARQ.

---

# 30. Invariantes de Ingeniería

MEF establece inicialmente los siguientes invariantes:

| ID | Invariante |
|----|------------|
| EI-001 | Toda implementación deberá respetar la arquitectura vigente. |
| EI-002 | La Ingeniería no podrá modificar unilateralmente la Fundación o Arquitectura. |
| EI-003 | Las dependencias tecnológicas deberán mantenerse detrás de límites explícitos cuando afecten la portabilidad. |
| EI-004 | Todo componente crítico deberá disponer de pruebas apropiadas. |
| EI-005 | Los procesos de construcción deberán ser reproducibles. |
| EI-006 | Las desviaciones arquitectónicas conocidas deberán documentarse. |
| EI-007 | Los componentes públicos deberán respetar los Contracts definidos. |
| EI-008 | Las dependencias deberán declararse explícitamente. |
| EI-009 | Los artefactos distribuibles deberán ser verificables. |
| EI-010 | Las decisiones técnicas significativas deberán ser trazables. |

---

# 31. Criterios de Conformidad

Una implementación se considerará conforme cuando:

- respete la Fundación;
- respete la Arquitectura;
- cumpla los Contracts aplicables;
- satisfaga los ENG correspondientes;
- supere las validaciones requeridas;
- supere las pruebas aplicables;
- no viole invariantes vigentes;
- documente desviaciones conocidas.

---

# 32. Riesgos de Ingeniería

Deberán evitarse especialmente:

## Sobreingeniería

Introducir complejidad sin beneficio demostrable.

## Acoplamiento tecnológico

Convertir una herramienta específica en una dependencia conceptual innecesaria.

## Implementación como arquitectura

Asumir que una decisión del código constituye automáticamente una regla arquitectónica.

## Automatización opaca

Crear procesos que dificulten comprender cómo se produce un resultado.

## Convenciones implícitas

Depender de conocimiento no documentado.

## Divergencia documental

Permitir que especificación e implementación evolucionen independientemente sin control.

---

# 33. Evolución

La Ingeniería evolucionará conforme madure MEF.

Las especificaciones podrán incorporar:

- nuevos runtimes;
- nuevas herramientas;
- nuevos mecanismos de validación;
- nuevas estrategias de construcción;
- nuevos adaptadores;
- nuevas automatizaciones.

Toda evolución deberá preservar los principios establecidos por los niveles superiores.

---

# 34. Principio Rector

> **La Ingeniería de MEF transforma arquitectura en implementación mediante especificaciones técnicas explícitas, verificables, reproducibles y trazables, sin convertir decisiones tecnológicas accidentales en fundamentos permanentes del Framework.**

---

# 35. Conclusión

**ENG-000 — Ingeniería General** establece el marco mediante el cual MEF transforma sus principios y arquitectura en implementaciones concretas.

La Ingeniería constituye el puente entre especificación y código.

Su misión no consiste únicamente en hacer que MEF funcione.

Consiste en garantizar que MEF pueda ser **construido, probado, reproducido, comprendido, mantenido y evolucionado** sin perder su identidad arquitectónica.

---

# Referencias

- FND-004 — Principios de Arquitectura
- FND-011 — Doctrina de Arquitectura
- FND-013 — Independencia del Framework
- ARQ-000 — Arquitectura General
- ARQ-001 — Visión Arquitectónica
- ARQ-004 — Modules
- ARQ-010 — Template Engine
- ARQ-014 — Framework Lifecycle
- ARQ-015 — Extension Model
- ARQ-016 — Security
- ARQ-017 — Packaging