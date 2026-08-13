---
id: ENG-002
titulo: Especificación de Modules
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Modules
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-001
  - ARQ-004
  - ARQ-006
  - ARQ-011
  - ARQ-014
  - ARQ-015
relacionados:
  - ENG-003
  - ENG-004
  - ENG-005
  - ENG-006
  - ENG-009
keywords:
  - modules
  - module specification
  - manifest
  - contracts
  - lifecycle
  - dependencies
  - boundaries
  - mef
---

# ENG-002

# Especificación de Modules

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica mediante la cual se implementa un **Module** en **MEF (Modular Enterprise Framework)**.

Este documento materializa los principios establecidos en **ARQ-004 — Modules** y establece los requisitos mínimos que deberá cumplir cualquier Module para ser reconocido, validado, registrado, ejecutado y distribuido dentro del ecosistema MEF.

---

# 2. Declaración

Un Module no constituye únicamente una carpeta, namespace, package o conjunto de clases.

Un Module es una **unidad técnica autónoma que materializa una capacidad arquitectónica claramente delimitada**.

Toda implementación de Module deberá preservar:

- identidad;
- encapsulamiento;
- límites;
- contratos públicos;
- dependencias explícitas;
- ciclo de vida;
- versionado;
- trazabilidad;
- testabilidad.

---

# 3. Relación Arquitectura → Ingeniería

La relación entre `ARQ-004` y `ENG-002` será:

```text
ARQ-004
Modules
   │
   │ define qué es un Module
   ▼
ENG-002
Module Specification
   │
   │ define cómo se implementa
   ▼
Module Implementation
```

ENG-002 no podrá contradecir las reglas arquitectónicas establecidas en ARQ-004.

---

# 4. Requisitos Mínimos

Todo Module deberá poseer, como mínimo:

- identidad única;
- nombre;
- versión;
- tipo;
- Manifest;
- API pública;
- implementación interna;
- dependencias declaradas;
- punto de entrada técnico;
- ciclo de vida definido;
- configuración cuando corresponda;
- pruebas;
- documentación.

Un Module que no cumpla estos requisitos se considerará incompleto.

---

# 5. Identidad

Todo Module deberá poseer un identificador único y estable.

Ejemplo conceptual:

```text
MOD-CRM
MOD-INVENTORY
MOD-FINANCE
```

La identidad deberá permanecer independiente:

- del nombre físico del directorio;
- del namespace concreto;
- del Package Manager;
- de la aplicación donde se instale.

La identidad pertenece al Module.

---

# 6. Nombre

Todo Module deberá declarar un nombre legible.

Ejemplo:

```text
ID: MOD-CRM
Name: Customer Relationship Management
```

El nombre podrá evolucionar editorialmente.

El identificador no deberá cambiar salvo una migración formal de identidad.

---

# 7. Tipo

Todo Module deberá declarar su tipo conforme a la clasificación definida por Arquitectura.

Ejemplos:

```text
MT-001 Business Module
MT-002 Technical Module
MT-003 Integration Module
MT-004 Presentation Module
MT-005 AI Module
MT-006 Infrastructure Module
```

El tipo deberá formar parte de los metadatos oficiales del Module.

---

# 8. Versión

Todo Module deberá declarar versión independiente.

MEF utilizará Semantic Versioning cuando corresponda:

```text
MAJOR.MINOR.PATCH
```

Ejemplo:

```text
2.4.1
```

El versionado detallado será especificado en **ENG-014 — Versionado**.

---

# 9. Manifest

Todo Module deberá disponer de un **Manifest**.

El Manifest constituye su descriptor técnico principal.

Deberá permitir identificar al menos:

- ID;
- nombre;
- versión;
- tipo;
- compatibilidad;
- dependencias;
- Contracts expuestos;
- Provider principal;
- capacidades;
- estado.

La especificación completa será definida en:

**ENG-003 — Manifest**.

---

# 10. Punto de Entrada

Todo Module deberá disponer de un mecanismo explícito mediante el cual MEF pueda incorporarlo al Lifecycle.

Conceptualmente:

```text
Module
   │
   ▼
Module Entry Point
   │
   ▼
Framework Lifecycle
```

El punto de entrada deberá permitir al Framework:

- identificar el Module;
- registrarlo;
- inicializarlo;
- habilitarlo;
- detenerlo cuando corresponda.

---

# 11. Module Contract

La integración técnica del Module con MEF deberá expresarse mediante un Contract oficial.

Conceptualmente:

```text
Module
   │
   implements
   ▼
ModuleContract
```

El Contract deberá representar exclusivamente las operaciones necesarias para que el Framework administre el Module.

No deberá exponer lógica de negocio interna.

---

# 12. Capacidades

Todo Module deberá declarar las capacidades que proporciona.

Ejemplo conceptual:

```text
MOD-CRM

Capabilities:
- customer-management
- lead-management
- opportunity-management
```

Las capacidades deberán:

- poseer nombres estables;
- estar documentadas;
- ser consultables;
- evitar ambigüedad.

---

# 13. API Pública

Todo Module deberá definir explícitamente su superficie pública.

Podrá incluir:

- Contracts;
- Commands;
- Queries;
- DTO;
- Events;
- Services;
- Extension Points.

Por defecto, todo aquello que no haya sido declarado público será considerado interno.

---

# 14. Implementación Interna

La implementación interna deberá permanecer encapsulada.

Podrá contener:

- Domain;
- Application Services;
- Handlers;
- Repositories concretos;
- Infrastructure;
- Internal Events;
- Helpers especializados.

Otros Modules no deberán depender de estos elementos.

---

# 15. Frontera del Module

La frontera deberá ser explícita.

```text
                MODULE
┌─────────────────────────────────┐
│                                 │
│   Public API                    │
│   ──────────                    │
│   Contracts                     │
│   Commands                      │
│   Queries                       │
│   Events                        │
│                                 │
│   Internal Implementation       │
│   ───────────────────────       │
│   Domain                        │
│   Services                      │
│   Infrastructure                │
│                                 │
└─────────────────────────────────┘
```

Los consumidores únicamente podrán depender de la superficie pública.

---

# 16. Dependencias

Toda dependencia deberá declararse explícitamente.

Un Module podrá depender de:

- Contracts de Core;
- capacidades públicas de Platform;
- Contracts públicos de otros Modules;
- Extension Points oficiales;
- dependencias externas autorizadas.

No deberán existir dependencias ocultas.

---

# 17. Dependencias entre Modules

Cuando un Module dependa de otro deberá utilizar su superficie pública.

Permitido:

```text
Sales
  │
  ▼
InventoryContract
```

Prohibido:

```text
Sales
  │
  ▼
Inventory.Internal.Repository
```

Toda dependencia deberá registrarse en el Manifest cuando corresponda.

---

# 18. Dependencias Opcionales

Un Module podrá declarar dependencias opcionales.

Ejemplo:

```text
CRM
 ├── requires Identity
 └── optionally integrates with Notifications
```

Una dependencia opcional no deberá impedir la inicialización del Module cuando esté ausente, salvo que la capacidad asociada sea invocada.

---

# 19. Dependencias Circulares

Las dependencias circulares entre Modules estarán prohibidas.

Ejemplo inválido:

```text
A → B → C → A
```

Cuando aparezca un ciclo deberá resolverse mediante:

- Contract compartido;
- Event;
- extracción de responsabilidad;
- componente intermediario;
- rediseño del límite.

---

# 20. Module Provider

Todo Module podrá disponer de un **Provider** encargado de declarar sus integraciones técnicas con el Framework.

El Provider podrá:

- registrar Contracts;
- declarar implementaciones;
- registrar listeners;
- proporcionar configuración;
- registrar Builders;
- declarar Extension Points.

El Provider no deberá contener lógica de negocio.

---

# 21. Registro

El Module será incorporado al Registry durante la fase correspondiente del Lifecycle.

```text
Discovery
   │
   ▼
Validation
   │
   ▼
Registration
   │
   ▼
Registry
```

El Registry conservará los metadatos.

No conservará la lógica interna del Module.

---

# 22. Ciclo de Vida

Todo Module participará en el Framework Lifecycle.

Como mínimo deberá poder atravesar estados equivalentes a:

```text
Discovered
    │
    ▼
Validated
    │
    ▼
Registered
    │
    ▼
Initialized
    │
    ▼
Ready
    │
    ▼
Disabled
```

La máquina de estados definitiva será especificada por los documentos de Lifecycle e Ingeniería correspondientes.

---

# 23. Inicialización

Durante la inicialización el Module podrá:

- validar configuración propia;
- registrar servicios autorizados;
- preparar recursos;
- validar dependencias;
- registrar listeners.

No deberá ejecutar procesos funcionales prematuramente.

---

# 24. Activación

Un Module deberá diferenciar entre:

```text
Installed
```

y

```text
Enabled
```

Un Module instalado puede existir en el ecosistema sin encontrarse activo.

La activación deberá ser explícita y trazable.

---

# 25. Desactivación

Cuando la arquitectura lo permita, un Module deberá poder deshabilitarse de manera controlada.

La desactivación deberá:

- impedir nuevas operaciones;
- preservar integridad;
- liberar recursos propios;
- mantener trazabilidad.

---

# 26. Instalación

La instalación deberá:

1. verificar Package;
2. verificar Manifest;
3. validar compatibilidad;
4. validar dependencias;
5. registrar el Module;
6. ejecutar procesos técnicos permitidos;
7. actualizar el estado.

La instalación no implica necesariamente activación inmediata.

---

# 27. Actualización

La actualización de un Module deberá considerar:

- versión instalada;
- versión objetivo;
- compatibilidad;
- migraciones;
- Contracts afectados;
- dependencias;
- rollback cuando sea posible.

Los cambios incompatibles deberán seguir la gobernanza establecida.

---

# 28. Desinstalación

Un Module deberá poder declarar cómo realizar una desinstalación segura.

La desinstalación deberá considerar:

- dependencias inversas;
- datos;
- recursos;
- configuración;
- Contracts;
- Packages dependientes.

No deberá eliminar información irreversiblemente sin una política explícita.

---

# 29. Datos

Un Module deberá mantener propiedad clara sobre sus datos.

Principio general:

> **Un Module no modifica directamente los datos internos de otro Module.**

Cuando necesite colaborar deberá utilizar:

- Contracts;
- Commands;
- Queries;
- Events;
- APIs públicas.

---

# 30. Persistencia

El mecanismo de persistencia deberá permanecer separado de la API pública del Module cuando corresponda.

Conceptualmente:

```text
Module Logic
    │
    ▼
Repository Contract
    │
    ▼
Persistence Adapter
```

El dominio no deberá quedar condicionado innecesariamente por la tecnología de persistencia.

---

# 31. Events

Un Module podrá publicar Events oficiales.

Todo Event público deberá:

- poseer identidad;
- poseer versión;
- ser inmutable;
- estar documentado;
- declarar su significado.

Los consumidores no deberán depender del origen interno del Event.

---

# 32. Commands

Los Commands representarán solicitudes explícitas de ejecución.

Deberán expresar intención.

Ejemplo:

```text
CreateCustomer
ApproveInvoice
RegisterPayment
```

Un Command no deberá utilizarse como sustituto ambiguo de un Event.

---

# 33. Queries

Las Queries representarán solicitudes de información.

Deberán evitar efectos secundarios funcionales.

Ejemplo:

```text
GetCustomer
ListInvoices
FindAvailableStock
```

---

# 34. Configuration

Un Module podrá exponer configuración propia.

Toda configuración deberá:

- poseer esquema;
- definir valores por defecto cuando corresponda;
- ser validable;
- estar documentada;
- respetar ARQ-013.

El Module no deberá depender de parámetros ocultos.

---

# 35. Extension Points

Un Module podrá declarar Extension Points públicos.

Cada Extension Point deberá:

- poseer identidad;
- definir Contract;
- documentar comportamiento;
- establecer restricciones;
- preservar compatibilidad.

---

# 36. Seguridad

Todo Module deberá declarar los elementos relevantes para seguridad.

Cuando corresponda:

- permisos;
- capacidades protegidas;
- políticas;
- operaciones sensibles;
- Events auditables;
- requisitos de confianza.

La implementación deberá respetar **ARQ-016 — Security**.

---

# 37. Observabilidad

Todo Module operativo deberá proporcionar observabilidad proporcional a su responsabilidad.

Podrá incluir:

- logs;
- metrics;
- traces;
- health information;
- lifecycle events;
- diagnostic information.

Los mecanismos concretos serán especificados en documentos posteriores.

---

# 38. Health

Un Module podrá declarar su estado operativo.

Conceptualmente:

```text
Healthy
Degraded
Unavailable
Disabled
```

El estado funcional no deberá confundirse con el estado del Lifecycle.

---

# 39. Testing

Todo Module deberá contar con pruebas adecuadas.

Podrán incluir:

- Unit Tests;
- Integration Tests;
- Contract Tests;
- Architecture Tests;
- Compatibility Tests;
- Lifecycle Tests.

La estrategia general será definida en **ENG-009 — Testing**.

---

# 40. Contract Tests

Los Contracts públicos deberán poder verificarse mediante Contract Tests.

Estos deberán permitir comprobar que distintas implementaciones mantienen el mismo acuerdo observable.

```text
Contract
   │
   ├── Implementation A → Contract Tests
   └── Implementation B → Contract Tests
```

---

# 41. Architecture Tests

Los Modules deberán permitir verificar automáticamente reglas como:

```text
Module must not access Internal API of another Module
Module must declare Manifest
Module must not create circular dependencies
Module must expose public capabilities through Contracts
```

Estas reglas deberán vincularse con `AI` y `EI` cuando corresponda.

---

# 42. Documentación

Todo Module deberá documentar al menos:

- propósito;
- capacidades;
- instalación;
- configuración;
- dependencias;
- API pública;
- Events;
- Contracts;
- Extension Points;
- compatibilidad;
- versionado.

Un Module sin documentación mínima no deberá considerarse completo.

---

# 43. Changelog

Todo Module versionado deberá mantener un historial de cambios cuando corresponda.

El Changelog deberá diferenciar:

- Features;
- Fixes;
- Breaking Changes;
- Deprecations;
- Security Changes.

---

# 44. Package

Todo Module distribuible deberá poder materializarse como un Package compatible con `ARQ-017`.

Conceptualmente:

```text
Module
   │
   ▼
Validation
   │
   ▼
Build
   │
   ▼
Package
```

El Package deberá conservar identidad y versión del Module.

---

# 45. Implementación de Referencia

Una implementación concreta podrá representar un Module mediante clases, namespaces, packages o mecanismos equivalentes.

Ejemplo puramente ilustrativo:

```text
CRM
├── Contracts
├── Application
├── Domain
├── Infrastructure
├── Providers
├── Events
├── Configuration
├── Tests
└── module.manifest
```

Esta estructura **no es todavía la estructura física normativa**.

La estructura física será definida en **ENG-006 — Estructura de Directorios**.

---

# 46. Certificación de Module

Antes de considerarse conforme, un Module deberá superar una validación mínima.

| Requisito | Obligatorio |
|-----------|:-----------:|
| Identidad | Sí |
| Versión | Sí |
| Tipo | Sí |
| Manifest | Sí |
| API pública explícita | Sí |
| Dependencias declaradas | Sí |
| Lifecycle compatible | Sí |
| Pruebas | Sí |
| Documentación | Sí |
| Validación arquitectónica | Sí |

Los requisitos adicionales dependerán del tipo y criticidad del Module.

---

# 47. Invariantes de Ingeniería

ENG-002 continúa la numeración global de `EI`.

| ID | Invariante |
|----|------------|
| EI-021 | Todo Module deberá poseer identidad única. |
| EI-022 | Todo Module deberá declarar versión. |
| EI-023 | Todo Module deberá disponer de Manifest válido. |
| EI-024 | Todo Module deberá definir explícitamente su API pública. |
| EI-025 | Todo elemento no declarado público será considerado interno. |
| EI-026 | Toda dependencia entre Modules deberá ser explícita. |
| EI-027 | Las dependencias circulares entre Modules estarán prohibidas. |
| EI-028 | Un Module no deberá modificar directamente los datos internos de otro Module. |
| EI-029 | Todo Module deberá participar en el Lifecycle oficial. |
| EI-030 | Todo Module distribuible deberá poder validarse antes de empaquetarse. |
| EI-031 | Todo Module deberá poseer pruebas apropiadas a sus responsabilidades. |
| EI-032 | Todo Module deberá documentar sus Contracts y capacidades públicas. |
| EI-033 | Los Providers no deberán contener lógica de negocio. |
| EI-034 | La configuración de un Module deberá ser explícita y validable. |
| EI-035 | Todo Extension Point público deberá estar documentado y respaldado por un Contract. |

---

# 48. Validación

La validación técnica de un Module deberá comprobar como mínimo:

```text
Identity
   │
   ▼
Manifest
   │
   ▼
Compatibility
   │
   ▼
Dependencies
   │
   ▼
Contracts
   │
   ▼
Lifecycle
   │
   ▼
Architecture Rules
   │
   ▼
Tests
```

Un fallo crítico deberá impedir su incorporación al Runtime.

---

# 49. Criterios de Conformidad

Un Module será conforme con ENG-002 cuando:

- posea identidad;
- posea versión;
- tenga Manifest válido;
- declare tipo;
- declare dependencias;
- exponga una API pública explícita;
- proteja su implementación interna;
- no participe en ciclos;
- respete Contracts;
- respete el Lifecycle;
- posea pruebas;
- posea documentación;
- satisfaga los `AI` y `EI` aplicables.

---

# 50. Riesgos

Deberán evitarse especialmente:

## God Module

Un Module con demasiadas responsabilidades.

## Module Anémico

Un Module utilizado únicamente como agrupación física sin límites funcionales reales.

## API Accidental

Exponer detalles internos.

## Dependencia Oculta

Consumir recursos no declarados.

## Acoplamiento de Datos

Modificar directamente estructuras pertenecientes a otro Module.

## Provider Monolítico

Utilizar el Provider como lugar general para lógica de inicialización y negocio.

## Circularidad

Diseñar Modules que no puedan evolucionar independientemente debido a ciclos.

---

# 51. Evolución

Un Module deberá poder evolucionar sin requerir modificaciones directas al Core.

Las principales formas de evolución serán:

- nuevas capacidades;
- nuevos Contracts;
- nuevos Events;
- nuevas implementaciones;
- Extension Points;
- nuevas versiones.

Los cambios incompatibles deberán gestionarse mediante los procesos oficiales de gobernanza y versionado.

---

# 52. Relación con ENG-003

ENG-002 define que todo Module posee un Manifest.

**ENG-003 — Manifest** definirá exactamente:

- estructura;
- campos;
- tipos;
- validación;
- versionado;
- compatibilidad;
- schema.

La separación será:

```text
ENG-002
¿Qué necesita un Module?
        │
        ▼
Manifest
        │
        ▼
ENG-003
¿Cómo se representa técnicamente?
```

---

# 53. Relación con ENG-006

ENG-002 define la **estructura lógica** del Module.

ENG-006 definirá su **estructura física**.

```text
ENG-002
Logical Module Structure
        │
        ▼
ENG-006
Physical Directory Structure
```

La estructura física deberá materializar los límites definidos en ENG-002.

---

# 54. Relación con Arquitectura

```text
ARQ-004
Modules
   │
   ▼
ENG-002
Module Specification
   │
   ├── ENG-003 Manifest
   ├── ENG-006 Directories
   ├── ENG-009 Testing
   └── ENG-014 Versioning
```

---

# 55. Principio Rector

> **Todo Module de MEF deberá materializar una capacidad claramente delimitada mediante identidad, límites, Contracts, dependencias explícitas, Lifecycle, pruebas y documentación verificables, preservando su autonomía sin comprometer el Core ni otros Modules.**

---

# 56. Conclusión

**ENG-002 — Especificación de Modules** define los requisitos técnicos fundamentales para implementar unidades modulares conformes con MEF.

Un Module no deberá considerarse una simple agrupación de código.

Es una unidad de ingeniería:

- identificable;
- versionable;
- encapsulada;
- verificable;
- instalable;
- extensible;
- testeable;
- documentada;
- trazable.

Esta especificación transforma el modelo arquitectónico definido en `ARQ-004` en requisitos técnicos verificables que posteriormente podrán ser automatizados mediante herramientas de Ingeniería.

---

# Referencias

## Fundación

- FND-004 — Principios de Arquitectura
- FND-013 — Independencia del Framework

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-015 — Extension Model
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-001 — Organización del Código
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing
- ENG-014 — Versionado