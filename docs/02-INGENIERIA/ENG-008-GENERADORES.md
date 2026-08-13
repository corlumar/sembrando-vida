---
id: ENG-008
titulo: Generadores
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Generadores
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-003
  - ENG-004
  - ENG-005
  - ENG-006
  - ENG-007
  - ARQ-009
  - ARQ-010
relacionados:
  - ENG-009
  - ENG-011
  - ENG-012
  - ENG-013
keywords:
  - generators
  - scaffolding
  - templates
  - automation
  - artifacts
  - cli
  - validation
  - mef
---

# ENG-008

# Generadores

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica de los **Generadores** oficiales de **MEF (Modular Enterprise Framework)**.

Los Generadores transforman especificaciones, plantillas y parámetros válidos en artefactos conformes con las reglas de Ingeniería.

Su función es automatizar la creación repetitiva sin introducir convenciones paralelas.

---

# 2. Declaración

Un Generator no deberá decidir arbitrariamente:

- estructura;
- nomenclatura;
- Contracts;
- metadata;
- reglas arquitectónicas.

Deberá materializar las decisiones ya establecidas por:

```text
Architecture
    ↓
Engineering
    ↓
Templates
    ↓
Generator
    ↓
Artifact
```

---

# 3. Objetivos

Los Generadores deberán:

- reducir trabajo repetitivo;
- garantizar consistencia;
- producir artefactos válidos;
- aplicar nomenclatura oficial;
- aplicar estructura oficial;
- generar metadata;
- generar pruebas iniciales;
- facilitar adopción;
- permitir automatización.

---

# 4. Filosofía

Los Generadores constituyen **mecanismos de materialización**.

No constituyen diseñadores arquitectónicos.

La regla será:

> **Specification first, generation second.**

---

# 5. Relación con Builders

La separación conceptual será:

```text
Builder
   │
   │ construye una representación
   ▼
Artifact Model
   │
   ▼
Generator
   │
   │ materializa archivos y estructura
   ▼
Generated Artifact
```

El Builder puede representar construcción lógica.

El Generator materializa una salida física.

---

# 6. Relación con Template Engine

```text
Generator
    │
    ▼
Template Engine
    │
    ▼
Template
    │
    ▼
Rendered Artifact
```

El Generator coordina.

El Template Engine renderiza.

La Template define la representación base.

---

# 7. Relación con CLI

El CLI podrá invocar Generators.

Ejemplo:

```text
mef make module crm
```

La secuencia será:

```text
CLI
 ↓
Generator Service
 ↓
Validation
 ↓
Template Engine
 ↓
Filesystem Adapter
 ↓
Generated Artifacts
```

El comando no deberá contener directamente lógica de generación.

---

# 8. Tipos de Generadores

La versión inicial podrá reconocer:

| ID | Generator |
|---|---|
| GEN-001 | Module Generator |
| GEN-002 | Contract Generator |
| GEN-003 | Event Generator |
| GEN-004 | Command Generator |
| GEN-005 | Query Generator |
| GEN-006 | Provider Generator |
| GEN-007 | Adapter Generator |
| GEN-008 | Extension Generator |
| GEN-009 | Test Generator |
| GEN-010 | Manifest Generator |

---

# 9. Generator Contract

Todo Generator deberá cumplir un Contract común.

Conceptualmente:

```text
Generator
├── validateInput()
├── plan()
├── generate()
└── verify()
```

La representación exacta dependerá del lenguaje.

---

# 10. Input

Todo Generator deberá recibir parámetros explícitos.

Ejemplo:

```text
artifact type
name
target
options
template version
```

No deberá depender de estado oculto cuando sea evitable.

---

# 11. Validation Phase

Antes de escribir archivos deberá validar:

- nombre;
- identidad;
- ubicación;
- compatibilidad;
- colisiones;
- template;
- parámetros requeridos.

---

# 12. Planning Phase

Todo Generator mutable importante deberá poder construir un **Generation Plan**.

Ejemplo:

```text
Create:
modules/Crm/
modules/Crm/Contracts/
modules/Crm/Application/
modules/Crm/Tests/
modules/Crm/README.md
modules/Crm/mef.manifest.json
```

El plan deberá conocerse antes de modificar el sistema.

---

# 13. Dry Run

Todo Generator que cree múltiples artefactos debería soportar:

```text
--dry-run
```

Ejemplo:

```text
mef make module crm --dry-run
```

Deberá mostrar:

- archivos;
- directorios;
- metadata;
- conflictos;
- acciones previstas.

---

# 14. Atomicidad

Cuando sea razonablemente posible, la generación deberá ser atómica.

Si una operación falla en mitad del proceso, deberá:

- revertir cambios;
- limpiar artefactos parciales;
- informar el estado.

Se evitarán estructuras incompletas silenciosas.

---

# 15. File Collision

Cuando un archivo ya exista, el Generator no deberá sobrescribirlo silenciosamente.

Deberá:

- abortar;
- solicitar confirmación;
- utilizar una estrategia explícita.

---

# 16. Force

Podrá existir:

```text
--force
```

pero no deberá permitir destruir información crítica sin advertencia.

`--force` no podrá invalidar invariantes arquitectónicos.

---

# 17. Template Identity

Toda Template oficial deberá poseer:

- ID;
- versión;
- artefacto generado;
- compatibilidad.

Ejemplo conceptual:

```text
TPL-MODULE-001
version: 1.2.0
```

---

# 18. Template Version

El Generator deberá poder conocer qué versión de Template utilizó.

Esto permitirá:

- reproducibilidad;
- diagnóstico;
- migración;
- auditoría.

---

# 19. Generated Metadata

Los artefactos generados podrán registrar metadata como:

```text
generator
template
generatorVersion
generatedAt
```

cuando resulte útil.

No deberá introducirse metadata redundante o innecesaria.

---

# 20. Generated Code Marker

Cuando un archivo no deba modificarse manualmente deberá marcarse claramente.

Ejemplo conceptual:

```text
GENERATED FILE
DO NOT EDIT DIRECTLY
```

---

# 21. Editable Generated Code

No todo código generado será necesariamente inmutable.

Un Generator deberá declarar si el artefacto es:

```text
generated-managed
```

o:

```text
generated-once
```

## generated-managed

Puede regenerarse y no debería editarse manualmente.

## generated-once

Se genera inicialmente y luego pasa a mantenimiento humano.

---

# 22. Idempotencia

Cuando sea posible, los Generadores deberán ser idempotentes o detectar estado existente correctamente.

Ejemplo:

```text
mef make module crm
```

ejecutado dos veces no deberá producir dos Modules distintos accidentalmente.

---

# 23. Determinismo

Dadas las mismas:

- entradas;
- versión de Template;
- versión de Generator;
- configuración relevante;

el resultado debería ser equivalente.

---

# 24. Module Generator

El Module Generator podrá generar:

```text
Module/
├── Contracts/
├── Application/
├── Tests/
├── README.md
└── mef.manifest.json
```

La estructura concreta deberá respetar ENG-006.

---

# 25. Manifest Generator

Deberá producir Manifests conformes con ENG-003.

No deberá generar campos arbitrarios.

Ejemplo:

```text
mef make manifest
```

podrá solicitar:

- Module ID;
- nombre;
- tipo;
- versión;
- compatibilidad.

---

# 26. Contract Generator

Ejemplo:

```text
mef make contract CustomerRepository
```

Deberá:

- validar nomenclatura;
- generar la representación técnica apropiada;
- ubicarla en el límite correcto;
- permitir documentación mínima.

---

# 27. Event Generator

Ejemplo:

```text
mef make event CustomerCreated
```

Deberá validar:

- nombre en pasado;
- identidad cuando corresponda;
- ubicación;
- metadata;
- versión inicial.

No deberá permitir silenciosamente un nombre como:

```text
CreateCustomer
```

si se declara como Event.

---

# 28. Command Generator

Ejemplo:

```text
mef make command CreateCustomer
```

Podrá generar:

```text
Command
Handler
Test
```

según el perfil técnico.

---

# 29. Query Generator

Ejemplo:

```text
mef make query GetCustomer
```

Deberá respetar las reglas de ENG-004 y ENG-005.

---

# 30. Provider Generator

Ejemplo:

```text
mef make provider CrmProvider
```

Deberá crear únicamente estructura técnica de composición.

No lógica de negocio.

---

# 31. Adapter Generator

Ejemplo:

```text
mef make adapter StripePayment
```

Podrá generar una implementación vinculada a un Contract existente.

El Generator deberá exigir que la relación contractual sea explícita cuando corresponda.

---

# 32. Extension Generator

Podrá generar:

- Manifest;
- Extension implementation;
- Tests;
- README;
- Extension Point reference.

Toda Extension deberá utilizar puntos oficiales.

---

# 33. Test Generator

El Generator de Tests deberá respetar ENG-009.

Podrá generar:

```text
Unit
Integration
Contract
Architecture
```

según el artefacto.

---

# 34. Architecture Test Generator

MEF podrá proporcionar comandos como:

```text
mef make architecture-test
```

para generar pruebas vinculadas a `AI` o `EI`.

Ejemplo conceptual:

```text
EI-084
Modules must maintain recognizable physical boundaries.
```

---

# 35. Generation Context

Los Generators deberán conocer un contexto explícito.

Ejemplo:

```text
Project Root
Module Root
Target Namespace
Implementation Profile
Configuration
```

No deberán inferir más información de la necesaria.

---

# 36. Profile Awareness

El mismo Generator conceptual podrá producir representaciones diferentes según perfil.

```text
ModuleGenerator
    │
    ├── PHP Profile
    ├── Java Profile
    ├── .NET Profile
    └── TypeScript Profile
```

La semántica deberá permanecer equivalente.

---

# 37. Universal vs Profile Templates

Se distinguirán:

```text
Universal Template Metadata
```

y:

```text
Implementation Template
```

La primera describe el artefacto.

La segunda materializa su sintaxis.

---

# 38. Path Resolution

Las rutas deberán resolverse mediante un servicio específico.

Los Generators no deberán concatenar arbitrariamente rutas específicas del sistema operativo.

---

# 39. Filesystem Abstraction

Cuando sea razonable, la escritura deberá ocurrir mediante una abstracción de Filesystem.

Esto facilita:

- pruebas;
- dry-run;
- rollback;
- portabilidad.

---

# 40. Transactional Generation

Para operaciones complejas podrá utilizarse una transacción lógica:

```text
Plan
 ↓
Stage
 ↓
Validate
 ↓
Commit
```

Si falla antes de `Commit`, el estado anterior deberá preservarse cuando sea viable.

---

# 41. Post-Generation Validation

Después de generar, deberá ejecutarse validación.

Ejemplo:

```text
Generate
   ↓
Manifest Validation
   ↓
Naming Validation
   ↓
Structure Validation
   ↓
Architecture Validation
```

Un artefacto generado no deberá asumirse válido únicamente porque el Generator terminó.

---

# 42. Self-Validation

Los Generators oficiales deberán poder demostrar que su output cumple las mismas reglas exigidas a artefactos manuales.

No habrá un estándar más débil para código generado.

---

# 43. Documentation Generation

Los Generators podrán producir documentación inicial.

Ejemplo:

```text
README.md
```

con:

- propósito;
- configuración;
- dependencias;
- placeholder de Contracts.

Se deberá evitar generar documentación ficticia presentada como completa.

---

# 44. Placeholder Policy

Los placeholders deberán ser identificables.

Ejemplo:

```text
TODO: Describe module capabilities.
```

No deberán generar afirmaciones no verificadas.

---

# 45. Test Generation

Los tests generados deberán:

- compilar cuando corresponda;
- contener estructura válida;
- no afirmar comportamiento inexistente.

Un test vacío no deberá presentarse como cobertura real.

---

# 46. Naming Validation

Antes de generación se aplicarán las reglas de ENG-005.

Ejemplo:

```text
CustomerCreated
```

es válido para Event.

```text
CustomerEvent1
```

podrá ser rechazado o advertido según la regla.

---

# 47. Structure Validation

La salida deberá respetar ENG-006.

Los Generators no deberán crear:

```text
helpers/
misc/
common/
```

de forma predeterminada si no existe una responsabilidad explícita.

---

# 48. Manifest Validation

Todo Manifest generado deberá superar ENG-003 antes de considerar exitosa la operación.

---

# 49. Dependency Validation

Si el artefacto declara dependencias, estas deberán validarse antes o inmediatamente después de generación.

---

# 50. Contract Awareness

Los Generators que produzcan implementaciones deberán poder referenciar Contracts oficiales.

Ejemplo:

```text
mef make adapter StripePayment --contract CT-PAYMENT-001
```

---

# 51. Registry Awareness

Cuando sea seguro y necesario, los Generators podrán consultar Registry para:

- detectar IDs duplicados;
- localizar Contracts;
- validar Extension Points;
- verificar nombres.

No deberán modificar Registry simplemente por generar archivos, salvo proceso oficial.

---

# 52. Offline Generation

Los Generators básicos deberían funcionar sin red cuando todos sus Templates y dependencias estén disponibles localmente.

---

# 53. Remote Templates

Si en el futuro existen Templates remotos deberán:

- verificar origen;
- verificar integridad;
- comprobar compatibilidad;
- evitar ejecución arbitraria.

---

# 54. Trusted Templates

Los Templates descargados deberán tratarse como contenido no confiable hasta su verificación.

---

# 55. Template Sandbox

Cuando el Template Engine soporte lógica, esta deberá limitarse para evitar ejecución arbitraria innecesaria.

Preferentemente, las Templates deberán permanecer declarativas.

---

# 56. Security

Los Generators no deberán:

- insertar secretos;
- copiar credenciales;
- generar defaults inseguros;
- modificar permisos críticos silenciosamente.

---

# 57. Secure Defaults

Los artefactos generados deberán utilizar configuraciones seguras por defecto cuando corresponda.

---

# 58. Observabilidad

Una generación deberá poder registrar:

- Generator;
- versión;
- Template;
- objetivo;
- duración;
- archivos creados;
- errores.

No deberá registrar secretos.

---

# 59. Auditability

Las operaciones importantes podrán generar metadata de auditoría cuando corresponda.

---

# 60. Error Handling

Los errores deberán diferenciar:

- input inválido;
- template inexistente;
- colisión;
- error de Filesystem;
- incompatibilidad;
- fallo de validación.

---

# 61. Exit Codes

Cuando se invoquen mediante CLI, deberán mapearse a exit codes definidos por ENG-007.

---

# 62. Interactive Generation

Los Generators podrán solicitar información de forma interactiva.

Ejemplo:

```text
Module name:
Module type:
MEF compatibility:
```

---

# 63. Non-Interactive Generation

Toda generación usada en CI deberá admitir parámetros explícitos.

Ejemplo:

```text
mef make module crm --type=MT-001 --no-interaction
```

---

# 64. Presets

Podrán existir Presets gobernados.

Ejemplo:

```text
minimal
standard
enterprise
```

Un Preset deberá ser únicamente una configuración de generación.

No deberá crear arquitecturas incompatibles.

---

# 65. Minimal Preset

Podrá generar:

```text
Module/
├── README.md
└── mef.manifest.json
```

más la implementación mínima requerida.

---

# 66. Standard Preset

Podrá generar una estructura como:

```text
Contracts/
Application/
Infrastructure/
Tests/
README.md
mef.manifest.json
```

---

# 67. Custom Presets

Los perfiles podrán definir Presets adicionales.

Deberán declarar:

- ID;
- versión;
- Template dependencies;
- compatibilidad.

---

# 68. Generator Plugins

En el futuro podrán existir Generators externos.

Deberán:

- utilizar Extension Points oficiales;
- poseer identidad;
- declarar versión;
- respetar nomenclatura;
- superar validación.

---

# 69. Generator Registry

MEF podrá mantener un catálogo:

```text
GEN-001 Module Generator
GEN-002 Contract Generator
...
```

Esto facilitará inspección y tooling.

---

# 70. Generator Discovery

El descubrimiento de Generators externos no deberá ejecutar código arbitrario antes de validación cuando pueda evitarse.

---

# 71. Compatibility

Un Generator deberá declarar compatibilidad con:

- MEF;
- Template Schema;
- Implementation Profile.

---

# 72. Deprecation

Un Generator deprecated deberá:

- mostrar advertencia;
- señalar alternativa;
- conservar compatibilidad cuando sea viable;
- documentar retiro.

---

# 73. Reproducibility

Cuando se requiera reproducir exactamente una generación deberán conocerse:

```text
Generator Version
Template Version
Profile Version
Inputs
Relevant Configuration
```

---

# 74. Generation Lock

En escenarios donde la reproducibilidad sea crítica, MEF podrá registrar versiones exactas de Generators/Templates utilizadas.

---

# 75. Drift Detection

En el futuro podrá compararse:

```text
Generated Artifact
```

contra:

```text
Current Template
```

para detectar divergencia.

Esto no implica que el artefacto deba regenerarse automáticamente.

---

# 76. Regeneration

Los artefactos `generated-managed` podrán regenerarse de manera segura.

Los `generated-once` no deberán sobrescribirse automáticamente.

---

# 77. Upgrade Generators

Podrán existir Generators especializados para migración:

```text
mef upgrade module
```

pero deberán diferenciarse de los Generators de creación inicial.

---

# 78. Source of Truth

La fuente de verdad para generación deberá ser:

```text
Specification
+ Template
+ Input
```

No el output generado.

El output es una materialización.

---

# 79. Generator Pipeline

La secuencia oficial será:

```text
Request
   ↓
Input Validation
   ↓
Context Resolution
   ↓
Generation Plan
   ↓
Template Resolution
   ↓
Rendering
   ↓
Staging
   ↓
Verification
   ↓
Commit
   ↓
Post-Generation Validation
```

---

# 80. Failure Pipeline

Ante error:

```text
Failure
   ↓
Stop
   ↓
Rollback when possible
   ↓
Report
   ↓
Non-zero Exit Code
```

No deberá ocultarse un fallo parcial.

---

# 81. Invariantes de Ingeniería

ENG-008 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-111 | Los Generators no deberán definir reglas arquitectónicas nuevas. |
| EI-112 | Todo Generator oficial deberá respetar ENG-004, ENG-005 y ENG-006. |
| EI-113 | Todo Manifest generado deberá cumplir ENG-003. |
| EI-114 | Las operaciones de generación no deberán sobrescribir archivos existentes silenciosamente. |
| EI-115 | Los Generators complejos deberán poder construir un Generation Plan antes de mutar el proyecto. |
| EI-116 | El resultado generado deberá validarse después de su creación. |
| EI-117 | Los Generators deberán distinguir artefactos generated-managed de generated-once cuando aplique. |
| EI-118 | La generación deberá ser determinista cuando sus entradas y versiones sean equivalentes. |
| EI-119 | Las Templates deberán poseer identidad y versión cuando formen parte del tooling oficial. |
| EI-120 | Los Generators no deberán insertar secretos en artefactos generados. |
| EI-121 | Los defaults generados deberán ser seguros cuando corresponda. |
| EI-122 | Las operaciones de generación utilizadas por automatización deberán soportar modo no interactivo. |
| EI-123 | Los Generators externos deberán incorporarse mediante mecanismos oficiales de extensión. |
| EI-124 | La generación deberá evitar dejar estados parciales cuando sea técnicamente razonable revertirlos. |
| EI-125 | El output generado no sustituye las especificaciones que lo originan. |

---

# 82. Criterios de Conformidad

Un Generator será conforme con ENG-008 cuando:

- utilice especificaciones vigentes;
- respete nomenclatura;
- respete estructura;
- valide entrada;
- detecte colisiones;
- permita inspeccionar cambios cuando corresponda;
- produzca output validable;
- soporte automatización;
- utilice Templates versionadas;
- preserve seguridad;
- gestione fallos explícitamente.

---

# 83. Riesgos

Deberán evitarse especialmente:

## Generator-Driven Architecture

Permitir que el scaffold se convierta en fuente de reglas.

## Template Drift

Templates diferentes produciendo estructuras incompatibles.

## Silent Overwrite

Destruir cambios existentes.

## Generated Garbage

Crear gran cantidad de archivos sin responsabilidad real.

## Fake Completeness

Generar tests o documentación vacíos y presentarlos como terminados.

## Technology Lock-in

Convertir un Generator específico en definición universal del artefacto.

## Hidden Side Effects

Modificar configuración o dependencias sin declararlo.

---

# 84. Primera Superficie Recomendada

La primera implementación podría incluir:

```text
mef make module
mef make manifest
mef make contract
mef make event
mef make command
mef make query
mef make provider
mef make adapter
mef make test
```

Posteriormente:

```text
mef make extension
mef make package
mef make architecture-test
```

---

# 85. Ejemplo de Module Generation

```text
mef make module crm --type=MT-001
```

Pipeline:

```text
Validate "crm"
      ↓
Resolve CrmModule naming
      ↓
Allocate MOD-CRM or validate supplied ID
      ↓
Build Generation Plan
      ↓
Render Templates
      ↓
Generate mef.manifest.json
      ↓
Generate initial structure
      ↓
Generate initial tests
      ↓
Validate structure
      ↓
Validate Manifest
      ↓
Complete
```

---

# 86. Ejemplo de Event Generation

```text
mef make event CustomerCreated
```

El Generator deberá comprobar:

```text
Event naming        ✓
Location            ✓
Template            ✓
Public/internal     ✓
ID when required    ✓
```

y posteriormente validar el resultado.

---

# 87. Relación con ENG-009

ENG-008 podrá generar pruebas iniciales.

ENG-009 determinará:

- qué pruebas son obligatorias;
- cómo se organizan;
- qué estrategia debe aplicarse.

Los Generators no deberán inventar una política de Testing propia.

---

# 88. Relación con ENG-012

El Build System utilizará artefactos generados exactamente como artefactos manuales.

No deberá existir un camino de compilación privilegiado para código generado.

---

# 89. Relación con ENG-013

Los Generators podrán preparar estructuras empaquetables.

El Package Manager será responsable de:

- resolución;
- instalación;
- distribución;
- administración de Packages.

---

# 90. Principio Rector

> **Los Generadores de MEF materializan especificaciones mediante procesos deterministas, versionados y verificables; nunca sustituyen la arquitectura ni inventan convenciones paralelas al Framework.**

---

# 91. Conclusión

**ENG-008 — Generadores** establece cómo MEF automatiza la creación de artefactos sin perder control arquitectónico.

La cadena queda:

```text
Architecture
     ↓
Engineering Specifications
     ↓
Templates
     ↓
Generators
     ↓
Generated Artifacts
     ↓
Validation
```

De esta forma, la automatización no reduce la disciplina.

La incorpora.

El objetivo final es que un artefacto creado mediante:

```text
mef make ...
```

nazca ya conforme con:

- nomenclatura;
- estructura;
- Manifest;
- Contracts;
- seguridad;
- validación;
- testing.

---

# Referencias

## Arquitectura

- ARQ-009 — Builders
- ARQ-010 — Template Engine
- ARQ-011 — Contracts
- ARQ-015 — Extension Model

## Ingeniería

- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager