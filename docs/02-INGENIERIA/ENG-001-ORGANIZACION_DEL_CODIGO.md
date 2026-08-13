---
id: ENG-001
titulo: Organización del Código
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Organización del Código
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ARQ-002
  - ARQ-003
  - ARQ-004
  - ARQ-011
  - FND-013
relacionados:
  - ENG-002
  - ENG-004
  - ENG-005
  - ENG-006
keywords:
  - code organization
  - modules
  - boundaries
  - dependencies
  - namespaces
  - visibility
  - organization
  - mef
---

# ENG-001

# Organización del Código

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas oficiales para la **organización lógica del código de MEF (Modular Enterprise Framework)**.

Este documento establece cómo deberán organizarse las implementaciones para preservar:

- modularidad;
- separación de responsabilidades;
- límites arquitectónicos;
- encapsulamiento;
- trazabilidad;
- testabilidad;
- mantenibilidad;
- independencia tecnológica.

ENG-001 no define una estructura física definitiva de directorios.

Define el modelo lógico que dicha estructura deberá representar.

---

# 2. Declaración

El código de MEF deberá organizarse conforme a la arquitectura y no conforme a las necesidades accidentales de una tecnología, lenguaje o framework externo.

La organización del código deberá hacer visibles los límites definidos por la Arquitectura.

La regla fundamental será:

> **La estructura del código deberá reflejar las responsabilidades y límites arquitectónicos de MEF.**

---

# 3. Objetivos

La organización del código tiene los siguientes objetivos:

- materializar los límites arquitectónicos;
- evitar dependencias indebidas;
- favorecer cohesión;
- reducir acoplamiento;
- facilitar navegación;
- facilitar pruebas;
- permitir sustitución de implementaciones;
- preservar independencia tecnológica;
- facilitar análisis automatizado;
- permitir evolución modular.

---

# 4. Alcance

ENG-001 regula principalmente:

- organización lógica;
- límites entre componentes;
- dirección de dependencias;
- visibilidad;
- separación entre Contracts e implementaciones;
- APIs públicas e internas;
- aislamiento de infraestructura;
- organización de adaptadores;
- organización de código compartido;
- reglas de acceso entre unidades.

---

# 5. Fuera de Alcance

Este documento no define detalladamente:

- nombres concretos de archivos;
- convenciones completas de nomenclatura;
- estructura física definitiva de directorios;
- sintaxis de namespaces o packages de un lenguaje específico;
- formato del Manifest;
- implementación detallada de Modules;
- herramientas de compilación.

Estos aspectos corresponden principalmente a:

- ENG-002 — Especificación de Modules;
- ENG-003 — Manifest;
- ENG-004 — Convenciones;
- ENG-005 — Nomenclatura;
- ENG-006 — Estructura de Directorios.

---

# 6. Principio de Organización

MEF adopta una organización orientada a **responsabilidades y límites**.

Conceptualmente:

```text
MEF
│
├── Core
│
├── Platform
│
├── Modules
│
├── Contracts
│
├── Extensions
│
└── Adapters
```

Esta representación es lógica.

No implica que todas las implementaciones deban utilizar exactamente estos nombres como directorios físicos.

---

# 7. Unidad de Organización

La unidad primaria de organización será el **componente arquitectónico**.

Un componente deberá agrupar elementos que:

- compartan una responsabilidad;
- evolucionen de manera relacionada;
- pertenezcan al mismo límite;
- posean dependencias coherentes.

La proximidad técnica no constituye por sí sola una razón válida para agrupar código.

---

# 8. Cohesión

Los elementos relacionados deberán permanecer próximos dentro de la organización lógica.

Ejemplo conceptual:

```text
Module
│
├── Contracts
├── Application
├── Domain
├── Infrastructure
└── Tests
```

La estructura interna concreta dependerá de la naturaleza del Module y de las especificaciones correspondientes.

No todos los Modules estarán obligados a contener todas estas divisiones.

---

# 9. Acoplamiento

MEF buscará minimizar el acoplamiento entre componentes.

Un componente deberá conocer únicamente aquello que necesita para cumplir su responsabilidad.

Se evitarán:

- dependencias globales;
- acceso indiscriminado;
- referencias cruzadas innecesarias;
- conocimiento de detalles internos;
- dependencias circulares.

---

# 10. Dirección de Dependencias

Las dependencias deberán respetar los límites establecidos por Arquitectura.

Como principio general:

```text
Application / Modules
        │
        ▼
Public Contracts
        │
        ▼
Platform Capabilities
        │
        ▼
Core Contracts
```

Los detalles concretos de infraestructura deberán permanecer detrás de abstracciones apropiadas.

La existencia de una capa inferior no implica que cualquier componente superior pueda acceder libremente a sus elementos internos.

---

# 11. Regla de Dependencia

Una dependencia será válida cuando:

1. sea necesaria;
2. sea explícita;
3. respete un límite público;
4. no introduzca un ciclo;
5. no viole un Contract;
6. no exponga detalles internos innecesariamente.

Conceptualmente:

```text
Component A
     │
     ▼
Public Contract
     │
     ▼
Component B
```

Se evitará:

```text
Component A
     │
     ▼
Internal Implementation
     │
     ▼
Component B
```

---

# 12. Dependencias Circulares

Las dependencias circulares entre componentes estarán prohibidas.

Ejemplo inválido:

```text
Module A
   │
   ▼
Module B
   │
   ▼
Module C
   │
   └────────► Module A
```

Cuando aparezca un ciclo deberá revisarse:

- responsabilidad;
- Contract;
- abstracción;
- Event;
- coordinación;
- separación del componente.

No deberá resolverse el problema únicamente mediante mecanismos técnicos que oculten el ciclo.

---

# 13. Contracts

Los Contracts deberán mantenerse separados conceptualmente de sus implementaciones.

```text
Contract
   │
   ├── Implementation A
   ├── Implementation B
   └── Implementation C
```

Los consumidores deberán depender del Contract cuando así lo establezca la Arquitectura.

Las implementaciones no deberán convertirse accidentalmente en APIs públicas.

---

# 14. API Pública

Todo componente deberá distinguir entre:

```text
Public API
```

y

```text
Internal Implementation
```

La API pública constituye la superficie soportada para interacción externa.

Los elementos internos podrán evolucionar sin garantizar compatibilidad pública, salvo especificación contraria.

---

# 15. Superficie Pública Mínima

MEF adopta el principio de **mínima superficie pública**.

Un elemento será público únicamente cuando exista una razón explícita para que otros componentes dependan de él.

Por defecto:

```text
Internal
```

Solo mediante intención explícita:

```text
Public
```

Esto reduce:

- acoplamiento;
- obligaciones de compatibilidad;
- exposición accidental;
- complejidad de mantenimiento.

---

# 16. Código Interno

Los componentes podrán contener implementaciones internas no accesibles directamente desde otros límites.

Ejemplo conceptual:

```text
Module
│
├── Public
│   └── Contracts
│
└── Internal
    ├── Services
    ├── Handlers
    └── Infrastructure
```

La representación física será definida posteriormente.

---

# 17. Core

El código perteneciente al Core deberá mantenerse especialmente protegido.

El Core:

- no deberá depender de Modules de aplicación;
- no deberá incorporar lógica específica de negocio;
- no deberá depender innecesariamente de tecnologías externas;
- deberá mantener una superficie reducida y estable.

Las reglas conceptuales del Core están definidas en **ARQ-002**.

ENG-001 únicamente establece que su organización técnica deberá preservar esos límites.

---

# 18. Platform

Platform podrá proporcionar capacidades compartidas necesarias para implementar la arquitectura.

Su código deberá:

- permanecer desacoplado de dominios particulares;
- exponer capacidades mediante límites explícitos;
- evitar convertirse en un contenedor indiscriminado de utilidades;
- mantener separación respecto del Core.

```text
Core
   ▲
   │
Platform
   ▲
   │
Modules
```

La dirección concreta de cada dependencia deberá respetar los Contracts definidos por Arquitectura.

---

# 19. Modules

Los Modules constituirán unidades explícitas de organización y evolución.

Cada Module deberá mantener:

- identidad;
- límites;
- API pública;
- dependencias explícitas;
- implementación interna;
- pruebas correspondientes.

La especificación técnica completa será definida en:

**ENG-002 — Especificación de Modules**.

---

# 20. Extensiones

El código de extensiones deberá permanecer separado del código que extiende.

Una Extension no deberá modificar físicamente los elementos internos del componente objetivo.

Conceptualmente:

```text
Framework
     │
     ▼
Extension Point
     │
     ▼
Extension
```

La implementación detallada corresponderá a las especificaciones de extensibilidad.

---

# 21. Adaptadores

Las dependencias tecnológicas deberán aislarse mediante adaptadores cuando su aislamiento sea necesario para preservar la arquitectura.

Ejemplos:

```text
MEF Contract
     │
     ├── SQL Adapter
     ├── HTTP Adapter
     ├── Filesystem Adapter
     └── Queue Adapter
```

Un Adapter traduce entre MEF y una tecnología externa.

No redefine el Contract.

---

# 22. Infraestructura

El código dependiente de infraestructura deberá mantenerse fuera de las reglas esenciales del dominio o componente.

Ejemplos de infraestructura:

- bases de datos;
- sistemas de archivos;
- redes;
- colas;
- servicios externos;
- runtimes;
- proveedores específicos.

Conceptualmente:

```text
Business / Framework Logic
          │
          ▼
       Contract
          │
          ▼
Infrastructure Adapter
          │
          ▼
External Technology
```

---

# 23. Código Compartido

El código compartido deberá utilizarse con moderación.

No se permitirá crear áreas genéricas como:

```text
Common
Utils
Helpers
Shared
Misc
```

como destino automático para elementos difíciles de clasificar.

Todo elemento compartido deberá poseer:

- responsabilidad;
- propietario;
- alcance;
- consumidores identificables.

---

# 24. Shared Kernel

Cuando varias unidades necesiten compartir conceptos estables podrá establecerse explícitamente un **Shared Kernel**.

Su incorporación deberá justificarse.

Un Shared Kernel no deberá convertirse en una colección general de utilidades.

Deberá contener únicamente conceptos realmente compartidos y gobernados.

---

# 25. Utilidades

Una utilidad técnica podrá existir cuando:

- sea genérica;
- no contenga lógica de dominio;
- tenga responsabilidad clara;
- no introduzca dependencias indebidas.

Las utilidades deberán permanecer pequeñas y especializadas.

---

# 26. Organización por Capacidad

Cuando sea posible, MEF favorecerá organizar código por **capacidad** antes que por tipo técnico global.

Se favorecerá:

```text
Customers/
    Commands/
    Queries/
    Contracts/
    Services/
```

frente a estructuras globales como:

```text
Controllers/
Services/
Repositories/
Models/
```

cuando estas últimas destruyan los límites funcionales del sistema.

Esto no constituye una prohibición absoluta de las categorías técnicas.

La prioridad será preservar cohesión y límites.

---

# 27. Organización Vertical y Horizontal

MEF reconoce dos dimensiones válidas.

## Organización vertical

Agrupa por capacidad:

```text
Module A
Module B
Module C
```

## Organización horizontal

Agrupa responsabilidades internas:

```text
Contracts
Application
Infrastructure
```

La estructura podrá combinar ambas:

```text
Modules
│
├── ModuleA
│   ├── Contracts
│   ├── Application
│   └── Infrastructure
│
└── ModuleB
    ├── Contracts
    ├── Application
    └── Infrastructure
```

La dimensión vertical deberá preservar la autonomía modular.

---

# 28. Namespaces y Packages

Cuando el lenguaje utilizado soporte namespaces, packages o mecanismos equivalentes, estos deberán reflejar los límites lógicos definidos por MEF.

Conceptualmente:

```text
MEF.Core
MEF.Platform
MEF.Contracts
MEF.Modules.*
MEF.Extensions.*
```

Estos nombres son ilustrativos.

La nomenclatura definitiva será establecida por **ENG-005 — Nomenclatura** y por las especificaciones de cada implementación.

---

# 29. Visibilidad

La visibilidad deberá restringirse al mínimo necesario.

MEF reconocerá conceptualmente:

| Nivel | Uso |
|---|---|
| Public | API soportada externamente |
| Protected | Extensión controlada cuando el lenguaje lo permita |
| Internal | Uso dentro del componente |
| Private | Uso exclusivamente local |

La traducción exacta dependerá del lenguaje.

---

# 30. Acceso entre Modules

Un Module no deberá acceder directamente a elementos internos de otro Module.

Permitido:

```text
Module A
   │
   ▼
Public Contract
   │
   ▼
Module B
```

No permitido:

```text
Module A
   │
   ▼
Module B / Internal
```

La comunicación también podrá producirse mediante Events u otros mecanismos arquitectónicos autorizados.

---

# 31. Eventos como Desacoplamiento

Cuando un componente necesite comunicar un hecho sin requerir una respuesta directa podrá utilizarse el Event Bus definido por Arquitectura.

```text
Module A
   │
   ▼
Event
   │
   ▼
Event Bus
   │
   ├── Module B
   └── Module C
```

Los Events no deberán utilizarse para ocultar dependencias que deberían ser explícitas.

---

# 32. Organización de Tests

Las pruebas deberán conservar trazabilidad respecto del código verificado.

Podrán organizarse:

- junto al componente;
- en una estructura paralela;
- mediante una combinación de ambas.

La elección dependerá de la implementación.

Sin embargo, deberá ser posible identificar claramente:

```text
Component
   │
   └── Tests
```

La estrategia definitiva será especificada en **ENG-009 — Testing**.

---

# 33. Código Generado

El código generado deberá poder distinguirse del código mantenido manualmente.

Se deberá conocer:

- qué herramienta lo generó;
- qué plantilla utilizó;
- si puede modificarse manualmente;
- cómo regenerarlo.

El código generado no deberá introducir dependencias arquitectónicas ocultas.

---

# 34. Código de Terceros

Las dependencias externas deberán permanecer identificables.

No deberán copiarse dentro del código principal de MEF de forma que pierdan:

- identidad;
- licencia;
- versión;
- origen.

Cuando una dependencia externa sea encapsulada, su límite deberá permanecer explícito.

---

# 35. Dependencias Externas

Toda dependencia externa deberá evaluarse considerando:

- necesidad;
- mantenimiento;
- licencia;
- seguridad;
- estabilidad;
- portabilidad;
- impacto arquitectónico.

La disponibilidad de una biblioteca no constituye por sí misma justificación suficiente para introducirla.

---

# 36. Dependencias Permitidas y Prohibidas

El modelo deberá permitir expresar reglas como:

```text
Core       ─X─► Modules
Core       ─X─► Application Domain

Modules    ─X─► Internal de otro Module

Extension  ─X─► Core Internal

Consumer   ───► Public Contract
Adapter    ───► External Technology
```

`─X─►` representa una dependencia prohibida.

Estas reglas podrán ser verificadas automáticamente.

---

# 37. Grafo de Dependencias

La organización del código deberá permitir construir un grafo de dependencias.

```text
Component A
    │
    ▼
Contract X
    │
    ▼
Component B
```

El grafo permitirá detectar:

- ciclos;
- dependencias prohibidas;
- acoplamiento excesivo;
- violaciones de límites;
- componentes críticos.

---

# 38. Architectural Fitness Functions

Las reglas de organización que puedan automatizarse deberán evolucionar hacia **Architectural Fitness Functions**.

Ejemplos:

```text
Core must not depend on Modules
Modules must not access another Module's Internal API
Contracts must not depend on Infrastructure
Circular dependencies must not exist
```

Estas reglas podrán ejecutarse como parte de la validación del proyecto.

---

# 39. Trazabilidad Arquitectónica

Los componentes significativos deberán poder relacionarse con la arquitectura que implementan.

Ejemplo conceptual:

```text
ARQ-008
Event Bus
   │
   ▼
ENG Specification
   │
   ▼
EventBus Contract
   │
   ▼
DefaultEventBus
   │
   ▼
Tests
```

La forma técnica de mantener esta trazabilidad podrá evolucionar posteriormente.

---

# 40. Refactorización

Una refactorización será válida cuando modifique la organización interna sin alterar contratos o comportamiento externo que deban permanecer compatibles.

Cuando una refactorización modifique:

- Contracts;
- límites;
- responsabilidades;
- dependencias arquitectónicas;

dejará de ser únicamente una refactorización técnica y deberá evaluarse su impacto arquitectónico.

---

# 41. Deuda Estructural

Las violaciones conocidas de organización deberán registrarse como deuda técnica o arquitectónica según corresponda.

Ejemplos:

- dependencia circular temporal;
- acceso interno excepcional;
- componente excesivamente acoplado;
- separación pendiente de infraestructura.

No deberán normalizarse silenciosamente.

---

# 42. Validación

La organización del código deberá poder validarse mediante mecanismos como:

- análisis estático;
- dependency graph;
- architecture tests;
- linting estructural;
- validación de manifests;
- reglas de visibilidad.

Las herramientas concretas dependerán de cada implementación.

---

# 43. Invariantes de Ingeniería

| ID | Invariante |
|----|------------|
| EI-011 | La organización del código deberá reflejar los límites arquitectónicos de MEF. |
| EI-012 | Las dependencias entre componentes deberán ser explícitas. |
| EI-013 | Las dependencias circulares entre componentes están prohibidas. |
| EI-014 | Ningún Module podrá acceder directamente a elementos internos de otro Module. |
| EI-015 | Los detalles de infraestructura deberán permanecer detrás de límites explícitos cuando afecten la independencia del componente. |
| EI-016 | La superficie pública deberá mantenerse al mínimo necesario. |
| EI-017 | Los Contracts deberán permanecer conceptualmente separados de sus implementaciones. |
| EI-018 | El Core no dependerá de Modules de aplicación. |
| EI-019 | El código compartido deberá poseer responsabilidad y alcance explícitos. |
| EI-020 | Las dependencias externas deberán permanecer identificables y gobernadas. |

---

# 44. Criterios de Conformidad

Una organización de código será conforme con ENG-001 cuando:

- refleje límites arquitectónicos;
- mantenga dependencias explícitas;
- no contenga ciclos prohibidos;
- preserve encapsulamiento;
- diferencie APIs públicas e internas;
- aisle infraestructura cuando corresponda;
- respete Contracts;
- preserve autonomía modular;
- permita pruebas;
- permita análisis estructural.

---

# 45. Riesgos

Deberán evitarse especialmente:

## Organización por comodidad

Agrupar elementos únicamente porque utilizan la misma tecnología.

## Shared indiscriminado

Convertir áreas compartidas en depósitos de código sin propietario.

## API accidental

Exponer implementaciones internas simplemente porque el lenguaje permite acceder a ellas.

## Acoplamiento entre Modules

Permitir acceso directo a detalles internos.

## Dependencia tecnológica estructural

Organizar MEF alrededor de una tecnología externa.

## Ciclos

Aceptar dependencias circulares como solución permanente.

---

# 46. Relación con otros Documentos

```text
ENG-000
Ingeniería General
      │
      ▼
ENG-001
Organización del Código
      │
      ├────────► ENG-002 Modules
      ├────────► ENG-004 Convenciones
      ├────────► ENG-005 Nomenclatura
      └────────► ENG-006 Directorios
```

ENG-001 establece el modelo lógico.

Los documentos posteriores materializan progresivamente ese modelo.

---

# 47. Principio Rector

> **El código de MEF se organiza alrededor de responsabilidades, capacidades y límites arquitectónicos explícitos; nunca alrededor de dependencias accidentales de una tecnología o implementación particular.**

---

# 48. Conclusión

**ENG-001 — Organización del Código** establece cómo deberá estructurarse lógicamente una implementación de MEF.

Su propósito no es imponer una estructura física universal, sino garantizar que cualquier implementación preserve:

- los límites de la Arquitectura;
- la autonomía de los Modules;
- la estabilidad del Core;
- la separación entre Contracts e implementaciones;
- el aislamiento de infraestructura;
- la dirección controlada de dependencias.

La organización física concreta será una consecuencia de estas reglas y será especificada posteriormente en **ENG-006 — Estructura de Directorios**.

---

# Referencias

## Fundación

- FND-013 — Independencia del Framework

## Arquitectura

- ARQ-002 — Core
- ARQ-003 — Platform
- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-015 — Extension Model

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-002 — Especificación de Modules
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing