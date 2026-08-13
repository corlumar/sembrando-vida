---
id: ENG-012
titulo: Build System
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Build System
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-003
  - ENG-004
  - ENG-006
  - ENG-009
  - ENG-011
  - ARQ-017
relacionados:
  - ENG-007
  - ENG-008
  - ENG-010
  - ENG-013
  - ENG-014
  - ENG-017
keywords:
  - build
  - pipeline
  - artifacts
  - reproducibility
  - validation
  - packaging
  - ci
  - release
  - mef
---

# ENG-012

# Build System

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica del **Build System** de **MEF (Modular Enterprise Framework)**.

El Build System coordina el proceso mediante el cual una implementación válida se transforma en un artefacto:

- verificable;
- reproducible;
- versionado;
- empaquetable;
- trazable;
- apto para distribución.

---

# 2. Declaración

El Build System constituye un mecanismo de orquestación.

No deberá definir:

- Arquitectura;
- Contracts;
- convenciones;
- nomenclatura;
- reglas de Testing;
- políticas de seguridad.

Deberá ejecutar las especificaciones ya definidas.

La relación será:

```text
Engineering Specifications
        │
        ▼
Build Pipeline
        │
        ▼
Verified Artifact
```

---

# 3. Objetivos

El Build System deberá:

- automatizar construcción;
- ejecutar validaciones;
- ejecutar pruebas;
- detectar incompatibilidades;
- producir artefactos;
- garantizar reproducibilidad;
- mantener trazabilidad;
- integrar Packaging;
- facilitar CI/CD;
- fallar de forma explícita.

---

# 4. Modelo General

```text
Source
  │
  ▼
Dependency Resolution
  │
  ▼
Configuration Validation
  │
  ▼
Static Validation
  │
  ▼
Architecture Validation
  │
  ▼
Testing
  │
  ▼
Build
  │
  ▼
Package
  │
  ▼
Verification
  │
  ▼
Artifact
```

Cada fase deberá poseer responsabilidad clara.

---

# 5. Build Pipeline

El Build Pipeline constituye la secuencia oficial de etapas de construcción.

Conceptualmente:

```text
Initialize
   ↓
Resolve
   ↓
Validate
   ↓
Analyze
   ↓
Test
   ↓
Compile / Assemble
   ↓
Package
   ↓
Verify
   ↓
Publish Candidate
```

No todas las plataformas requerirán compilación física.

---

# 6. Build Request

Todo Build deberá partir de un contexto explícito.

Podrá incluir:

- source revision;
- versión;
- Implementation Profile;
- configuración;
- dependencias;
- target;
- build mode.

---

# 7. Build Context

El Build Context deberá poder identificar:

```text
Source Commit
Version
Profile
Environment
Dependency Lock
Configuration Schema
Build Tool Version
```

Esto facilitará reproducibilidad.

---

# 8. Build Modes

MEF podrá reconocer conceptualmente:

```text
development
test
release
```

Cada modo podrá ajustar:

- optimización;
- diagnóstico;
- artefactos;
- validaciones.

No deberá cambiar las reglas arquitectónicas obligatorias.

---

# 9. Development Build

Podrá priorizar:

- velocidad;
- debugging;
- incremental build.

No deberá omitir validaciones estructurales críticas sin una política explícita.

---

# 10. Test Build

Deberá preparar un entorno apropiado para ejecutar Testing.

Podrá incluir:

- instrumentation;
- test resources;
- fake adapters;
- isolated dependencies.

---

# 11. Release Build

Deberá favorecer:

- reproducibilidad;
- optimización;
- integridad;
- validación completa;
- metadata;
- Package verificable.

---

# 12. Dependency Resolution

Antes de construir deberán resolverse dependencias necesarias.

La resolución deberá considerar:

- versiones;
- compatibilidad;
- locks;
- Packages;
- Contracts.

El Build System no deberá inventar dependencias no declaradas.

---

# 13. Dependency Lock

Cuando el ecosistema lo permita deberá utilizarse un mecanismo de lock para reproducibilidad.

Ejemplo conceptual:

```text
Declared Dependencies
        ↓
Resolver
        ↓
Dependency Lock
```

El formato dependerá del Package Manager.

---

# 14. Locked Build

Los Release Builds deberían utilizar versiones resueltas de manera determinista.

No se debería resolver arbitrariamente la “última versión disponible” durante un Release Build.

---

# 15. Offline Build

Cuando todas las dependencias estén disponibles localmente, debería ser posible construir sin acceso de red.

Esto reduce variabilidad.

---

# 16. Configuration Validation

ENG-011 deberá ejecutarse antes de que el Build dependa de Configuration.

Se deberá verificar:

- Schema;
- tipos;
- required values;
- incompatibilidades;
- secrets handling.

---

# 17. Static Validation

El Build podrá ejecutar:

- linting;
- syntax checking;
- formatting validation;
- type analysis;
- dependency analysis.

Las herramientas concretas dependerán del Implementation Profile.

---

# 18. Formatting

El Build podrá verificar que los archivos cumplen reglas de formato.

No deberá modificar silenciosamente source durante un Build de Release.

Una operación separada podrá aplicar formatting.

---

# 19. Static Analysis

El análisis estático deberá detectar, cuando sea posible:

- errores;
- tipos inválidos;
- código inalcanzable;
- dependencias prohibidas;
- patrones inseguros.

---

# 20. Architecture Validation

Antes de producir un Artifact deberá ejecutarse la validación arquitectónica correspondiente.

Ejemplos:

```text
AI
EI
Dependency direction
Module boundaries
Circular dependencies
Manifest compliance
```

---

# 21. Architecture Gate

Una violación crítica deberá detener el Build.

```text
Architecture Validation
        │
        ├── PASS → continue
        └── FAIL → stop
```

---

# 22. Testing

El Build System deberá integrar ENG-009.

Podrá ejecutar:

```text
Unit
Contract
Architecture
Integration
Security
Compatibility
```

según el Build Mode.

---

# 23. Test Gate

Las suites obligatorias deberán completarse satisfactoriamente antes de producir un Release Artifact.

---

# 24. Partial Test Selection

En desarrollo podrá ejecutarse un subconjunto.

Sin embargo, el Release Build deberá cumplir el Quality Gate completo definido.

---

# 25. Compile

Algunas implementaciones requerirán compilación.

Ejemplos:

```text
Java
.NET
TypeScript
```

Otras podrán requerir únicamente validación y ensamblado.

MEF no deberá asumir universalmente la existencia de un compilador.

---

# 26. Assemble

El proceso de ensamblado deberá reunir:

- source necesario;
- generated artifacts;
- metadata;
- Manifest;
- configuration schemas;
- resources;
- documentation requerida.

---

# 27. Generated Artifacts

Los Generators definidos en ENG-008 deberán ejecutarse antes del Build cuando sean necesarios.

Un Build no deberá generar de forma oculta artefactos no declarados si esto afecta reproducibilidad.

---

# 28. Generation Phase

Cuando exista generación:

```text
Source
  ↓
Generate
  ↓
Validate Generated Output
  ↓
Continue Build
```

---

# 29. Build Output

El output deberá permanecer separado de source.

Ejemplo conceptual:

```text
build/
dist/
artifacts/
```

La ubicación dependerá del perfil.

---

# 30. Clean Build

Deberá existir la posibilidad de ejecutar un Build desde un estado limpio.

Ejemplo conceptual:

```text
mef build --clean
```

o mecanismo equivalente.

---

# 31. Incremental Build

Los Implementation Profiles podrán soportar Build incremental para desarrollo.

No deberá comprometer la corrección del Release Build.

---

# 32. Build Cache

Podrá utilizarse cache para:

- dependencias;
- compilación;
- análisis;
- generación.

La cache no deberá convertirse en fuente de verdad.

---

# 33. Cache Invalidation

La invalidación deberá depender de entradas relevantes.

Ejemplo:

```text
source changed
dependency changed
configuration schema changed
generator changed
```

---

# 34. Reproducible Build

Un Release Build deberá aspirar a que las mismas entradas produzcan artefactos equivalentes.

Las entradas incluyen:

- source;
- dependencies;
- toolchain;
- configuration;
- profile;
- generator versions.

---

# 35. Determinismo

Los elementos que introduzcan variabilidad deberán controlarse.

Ejemplos:

- timestamps;
- random IDs;
- file ordering;
- dependency resolution;
- locale;
- timezone.

---

# 36. Build Timestamp

Un timestamp de Build podrá incluirse como metadata.

No deberá alterar innecesariamente contenido funcional si se busca reproducibilidad binaria.

---

# 37. Source Revision

Todo Artifact distribuible debería poder vincularse con una revisión de source.

Ejemplo:

```text
commit
revision
sourceHash
```

---

# 38. Build ID

Podrá generarse un identificador único de Build.

Ejemplo conceptual:

```text
BLD-20260810-001
```

La nomenclatura definitiva podrá establecerse posteriormente.

---

# 39. Artifact Identity

El Artifact deberá mantener identidad separada del Build.

Ejemplo:

```text
Build ID
BLD-...

Package ID
PKG-CRM

Module ID
MOD-CRM
```

No deberán confundirse.

---

# 40. Artifact Metadata

Un Artifact podrá incluir:

```text
packageId
version
buildId
sourceRevision
buildProfile
toolchainVersion
```

cuando corresponda.

---

# 41. Build Manifest

MEF podrá generar metadata específica de Build.

Ejemplo conceptual:

```text
build.manifest
```

Este documento no sustituirá `mef.manifest.json`.

La diferencia será:

```text
MEF Manifest
→ describe el componente

Build Manifest
→ describe cómo se construyó el artefacto
```

---

# 42. Artifact Integrity

Los artefactos deberán poder verificarse.

Podrán utilizar:

- checksums;
- hashes;
- signatures;
- provenance metadata.

La estrategia concreta se relacionará con Security y Packaging.

---

# 43. Checksum

Deberá calcularse sobre una representación determinista cuando se utilice para integridad.

---

# 44. Signature

Los Release Artifacts podrán firmarse.

La firma deberá ocurrir después de finalizar el contenido del Artifact.

---

# 45. Signing Keys

Las claves de firma no deberán almacenarse dentro del repositorio o Build Artifact.

---

# 46. Build Secrets

Los Secrets utilizados durante Build deberán:

- permanecer aislados;
- no escribirse en logs;
- no terminar dentro del Artifact;
- destruirse o liberarse cuando corresponda.

---

# 47. Build Environment

El entorno deberá ser identificable.

Idealmente deberá controlar:

```text
Runtime
Toolchain
OS dependencies
Locale
Timezone
```

cuando afecten el resultado.

---

# 48. Hermetic Build

Cuando sea razonable, MEF podrá aspirar a Builds herméticos.

Es decir:

> El Build depende únicamente de entradas declaradas.

No será requisito universal inicial.

---

# 49. Environment Leakage

El Build no deberá depender silenciosamente de:

- archivos personales;
- HOME;
- herramientas globales no declaradas;
- variables locales desconocidas.

---

# 50. Build Toolchain

Toda implementación deberá poder identificar las herramientas requeridas.

Ejemplo:

```text
compiler
package manager
generator
test runner
static analyzer
```

---

# 51. Toolchain Version

Las versiones relevantes deberían poder fijarse o documentarse.

Esto reduce diferencias entre:

```text
developer
CI
release
```

---

# 52. CI Integration

El Build System deberá poder ejecutarse de forma no interactiva.

Ejemplo conceptual:

```text
mef build --ci
```

o un comando del Implementation Profile.

---

# 53. CI Pipeline

Conceptualmente:

```text
Checkout
   ↓
Restore Dependencies
   ↓
Validate
   ↓
Analyze
   ↓
Test
   ↓
Build
   ↓
Package
   ↓
Verify
   ↓
Publish Candidate
```

---

# 54. Local vs CI

Local y CI deberán utilizar las mismas reglas fundamentales.

No deberá existir:

```text
"works only in CI"
```

como diseño normal.

---

# 55. Build Script

Los scripts de Build deberán versionarse junto con el proyecto cuando sea razonable.

El conocimiento del Build no deberá residir únicamente en servidores externos.

---

# 56. Build as Code

La definición del pipeline debería mantenerse como código o configuración versionada cuando sea posible.

Esto favorece:

- revisión;
- historial;
- reproducibilidad.

---

# 57. Build Configuration

La configuración del Build deberá permanecer separada de Configuration funcional del Runtime cuando sus responsabilidades sean distintas.

Ejemplo:

```text
Build Configuration
```

vs:

```text
Runtime Configuration
```

---

# 58. Build Profiles

Podrán existir perfiles:

```text
debug
release
minimal
full
```

La semántica deberá estar documentada.

---

# 59. Feature Inclusion

La inclusión o exclusión de capacidades durante Build deberá respetar Architecture y Package rules.

No se deberá modificar arbitrariamente la identidad del Module.

---

# 60. Package Phase

Una vez construido el Artifact técnico podrá comenzar Packaging.

```text
Build Output
    ↓
Package Assembly
    ↓
Manifest Validation
    ↓
Integrity
    ↓
Package
```

---

# 61. Packaging Boundary

Build y Package son conceptos distintos.

```text
Build
→ produce artefactos técnicos

Packaging
→ produce unidad distribuible
```

Pueden ejecutarse dentro del mismo pipeline, pero mantienen responsabilidades diferentes.

---

# 62. Package Manager Integration

ENG-013 podrá consumir Build Artifacts.

El Build System no deberá implementar por sí solo resolución e instalación de Packages.

---

# 63. Package Validation

Antes de publicar deberá verificarse:

- Manifest;
- identity;
- version;
- dependencies;
- integrity;
- required files;
- compatibility.

---

# 64. Artifact Verification

Después del Build deberá poder ejecutarse una fase independiente de verificación.

```text
Artifact
  ↓
Verifier
  ↓
PASS / FAIL
```

---

# 65. Verification from Artifact

Idealmente determinadas verificaciones deberán ejecutarse sobre el Artifact final, no únicamente sobre source.

Esto detecta errores introducidos durante Packaging.

---

# 66. Smoke Test Artifact

El Artifact final podrá ejecutar Smoke Tests.

Ejemplo:

```text
Artifact boots
Manifest accessible
Required resources available
```

---

# 67. Supply Chain

El Build System deberá considerar riesgos de Software Supply Chain.

Entre ellos:

- dependency tampering;
- compromised tools;
- unauthorized artifacts;
- malicious Packages;
- secret leakage.

---

# 68. Dependency Integrity

Las dependencias deberían verificarse mediante mecanismos de integridad cuando el ecosistema lo soporte.

---

# 69. Provenance

Los Release Artifacts deberían poder relacionarse con información sobre:

```text
who/what built
source revision
toolchain
dependencies
build process
```

cuando la madurez del proyecto lo permita.

---

# 70. SBOM

MEF podrá generar una **Software Bill of Materials** para Releases.

Conceptualmente:

```text
Artifact
  │
  └── SBOM
        ├── Dependencies
        ├── Versions
        └── Licenses
```

No será requisito universal inicial, pero la arquitectura deberá permitirlo.

---

# 71. License Validation

El Build o Release Pipeline podrá comprobar licencias de dependencias cuando corresponda.

---

# 72. Vulnerability Scanning

Podrá incorporarse scanning de dependencias y Artifact.

Los resultados críticos deberán participar en Quality Gates según la política de Security.

---

# 73. Security Gate

Conceptualmente:

```text
Build
 ↓
Security Validation
 ↓
PASS / FAIL
```

La severidad que bloquea un Release deberá gobernarse.

---

# 74. Build Logs

El Build deberá producir información diagnóstica útil.

ENG-010 aplica también al tooling.

No deberá registrar secretos.

---

# 75. Structured Build Output

CI debería poder consumir resultados estructurados.

Ejemplo conceptual:

```json
{
  "status": "success",
  "buildId": "BLD-...",
  "artifact": "PKG-CRM",
  "version": "1.2.0"
}
```

---

# 76. Build Report

El proceso podrá generar:

```text
Build Report
```

con:

- stages;
- duration;
- tests;
- warnings;
- errors;
- artifact metadata.

---

# 77. Warning Policy

Warnings deberán poder clasificarse.

Un Release Build podrá utilizar política más estricta.

---

# 78. Fail Fast

El pipeline debería detenerse tan pronto como una condición crítica haga imposible un Build válido.

Ejemplo:

```text
Manifest invalid
→ stop before compile/package
```

---

# 79. Failure Handling

Ante fallo:

```text
Failure
  ↓
Stop
  ↓
Cleanup
  ↓
Report
  ↓
Non-zero Exit
```

---

# 80. Partial Artifacts

Un Build fallido no deberá publicar artefactos parciales como si fueran válidos.

---

# 81. Staging Area

Podrá utilizarse un área temporal:

```text
staging/
```

para ensamblar antes de confirmar el Artifact final.

---

# 82. Atomic Artifact Creation

Cuando sea viable:

```text
Stage
 ↓
Verify
 ↓
Commit Artifact
```

Esto evita artefactos incompletos.

---

# 83. Cleanup

Los temporales deberán eliminarse después del Build cuando corresponda.

---

# 84. Build Retry

Un Build fallido no deberá reintentarse indiscriminadamente.

Los retries podrán ser válidos para fallos transitorios como:

```text
network retrieval
remote registry
```

No para:

```text
test failure
syntax error
architecture violation
```

---

# 85. Parallel Build

Los perfiles podrán paralelizar etapas independientes.

Ejemplo:

```text
Unit Tests ─┐
Static Analysis ─┼─→ Gate
Architecture Tests ─┘
```

La paralelización no deberá introducir no determinismo.

---

# 86. Build Graph

El Build podrá modelarse como un grafo de tareas.

```text
Validate
 ├── Manifest
 ├── Config
 └── Naming

Test
 ├── Unit
 ├── Contract
 └── Architecture

Package
 └── Verify
```

Esto facilita ejecución incremental.

---

# 87. Task Contract

Cada tarea de Build debería declarar:

- inputs;
- outputs;
- dependencies;
- side effects;
- cacheability.

---

# 88. Build Plugins

El Build System podrá extenderse mediante mecanismos oficiales.

Los plugins deberán:

- declarar identidad;
- versión;
- compatibilidad;
- hooks;
- permisos.

No podrán alterar silenciosamente Quality Gates obligatorios.

---

# 89. Build Hooks

Podrán existir hooks como:

```text
preValidate
postValidate
preBuild
postBuild
prePackage
postPackage
```

Solo deberán utilizarse si forman parte del modelo oficial.

---

# 90. Hook Determinism

Los Hooks deberán evitar side effects no declarados.

---

# 91. External Tools

Los External Tools deberán ejecutarse detrás de adapters o wrappers cuando la portabilidad y trazabilidad lo requieran.

---

# 92. Build Independence

MEF no deberá quedar conceptualmente atado a:

```text
Composer
Maven
Gradle
MSBuild
npm
```

Estos podrán formar parte de Implementation Profiles.

---

# 93. PHP Profile

Un perfil PHP podrá utilizar:

```text
Composer
PHPUnit
PHPStan/Psalm
```

si así se decide.

Esto no convierte esas herramientas en requisitos universales.

---

# 94. Java Profile

Podrá utilizar:

```text
Maven
Gradle
JUnit
```

sin alterar el Build Model universal.

---

# 95. .NET Profile

Podrá utilizar:

```text
dotnet build
dotnet test
NuGet
```

como mecanismos concretos.

---

# 96. TypeScript Profile

Podrá utilizar:

```text
npm/pnpm
tsc
test runner
bundler
```

según perfil.

---

# 97. Build CLI

ENG-007 podrá exponer:

```text
mef build
```

con opciones como:

```text
--profile
--clean
--ci
--format=json
```

La interfaz exacta deberá mantenerse consistente.

---

# 98. Build Validate

Podrá existir:

```text
mef build validate
```

si se decide separar validación de construcción.

Alternativamente:

```text
mef project validate
```

podrá ejecutar esas reglas.

La CLI deberá evitar duplicar semántica.

---

# 99. Build Test

La ejecución de Testing podrá mantenerse como:

```text
mef test
```

aunque forme parte del Build Pipeline.

No será necesario ocultar Testing detrás de `build`.

---

# 100. Build Package

Podrá existir:

```text
mef package build
```

para Packaging explícito.

La separación de comandos deberá reflejar responsabilidades.

---

# 101. Release Candidate

Un Build aprobado podrá producir un **Release Candidate Artifact**.

Este todavía podrá necesitar:

- firma;
- aprobación;
- publicación.

ENG-017 definirá el Release Process.

---

# 102. Release Build Immutability

Una vez aprobado un Release Artifact no deberá modificarse.

Si cambia cualquier contenido deberá construirse un nuevo Artifact.

---

# 103. Version Assignment

La versión deberá determinarse antes de firmar/publicar el Artifact.

ENG-014 definirá la estrategia.

---

# 104. Build Number

Un Build Number no deberá sustituir la versión semántica.

Ejemplo:

```text
version: 1.4.0
build: 587
```

Son dimensiones distintas.

---

# 105. Snapshot Builds

Los perfiles podrán producir artefactos no finales:

```text
snapshot
nightly
development
```

Deberán distinguirse claramente de Releases oficiales.

---

# 106. Pre-Release

Podrán utilizarse versiones como:

```text
1.4.0-alpha.1
1.4.0-beta.1
1.4.0-rc.1
```

cuando ENG-014 lo permita.

---

# 107. Build Retention

La retención de Artifacts dependerá de operación y Release Policy.

No todos los Builds necesitan conservarse indefinidamente.

---

# 108. Rebuild Verification

Para Releases críticos, MEF podrá reconstruir independientemente un Artifact y comparar resultados o hashes cuando la plataforma lo permita.

---

# 109. Reproducibility Report

Podrá informarse:

```text
reproducible: true/false
```

junto con diferencias encontradas.

---

# 110. Quality Gates

La primera versión debería contemplar al menos:

```text
Manifest Gate
Configuration Gate
Static Analysis Gate
Architecture Gate
Test Gate
Package Gate
```

---

# 111. Gate Severity

Cada Gate podrá producir:

```text
PASS
WARNING
FAIL
```

Los `FAIL` obligatorios impedirán Release.

---

# 112. Gate Bypass

No deberá existir un bypass silencioso.

Una excepción deberá:

- ser explícita;
- documentarse;
- estar gobernada;
- aparecer en el Build Report.

---

# 113. Release Quality Gate

El Release deberá utilizar la política más estricta aplicable.

---

# 114. Build Policy as Code

Los Quality Gates objetivos deberían definirse de forma procesable cuando sea razonable.

Esto permite:

```text
Specification
   ↓
Build Rule
   ↓
CI Gate
```

---

# 115. Build and Knowledge System

En el futuro, el Build Report podrá vincular:

```text
AI
EI
Tests
Packages
Build
Release
```

con el Knowledge System.

---

# 116. Compliance Evidence

Un Release podrá conservar evidencia como:

```text
AI checks
EI checks
Test results
Security scan
Artifact hash
Build provenance
```

---

# 117. Invariantes de Ingeniería

ENG-012 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-186 | El Build System deberá orquestar especificaciones existentes y no introducir reglas arquitectónicas paralelas. |
| EI-187 | Los Release Builds deberán utilizar dependencias resueltas de forma determinista cuando el ecosistema lo permita. |
| EI-188 | La Configuration requerida deberá validarse antes de construir un Artifact final. |
| EI-189 | Las violaciones arquitectónicas críticas deberán detener el Build. |
| EI-190 | Las suites obligatorias de Testing deberán completarse antes de generar un Release Artifact válido. |
| EI-191 | Los Build outputs deberán permanecer separados de Source cuando la plataforma lo permita. |
| EI-192 | Un Build fallido no deberá publicar artefactos parciales como válidos. |
| EI-193 | Los Release Artifacts deberán poder relacionarse con la revisión de Source que los originó. |
| EI-194 | Los Secrets utilizados durante Build no deberán incorporarse a Logs o Artifacts. |
| EI-195 | Los Release Builds deberán aspirar a reproducibilidad controlando entradas relevantes. |
| EI-196 | Los Quality Gates obligatorios no deberán omitirse silenciosamente. |
| EI-197 | Build y Packaging deberán permanecer conceptualmente separados aunque compartan pipeline. |
| EI-198 | El Build System no deberá depender universalmente de una herramienta o Package Manager específico. |
| EI-199 | Las herramientas y versiones relevantes del Build deberán ser identificables. |
| EI-200 | Los Artifacts finales deberán someterse a verificación antes de publicación. |
| EI-201 | Un Artifact aprobado para Release no deberá modificarse posteriormente. |
| EI-202 | La versión del Artifact y el Build ID deberán mantenerse como conceptos distintos. |
| EI-203 | Los Build caches no deberán convertirse en fuente de verdad. |
| EI-204 | Los Plugins o Hooks de Build no deberán desactivar invariantes fundamentales. |
| EI-205 | Las excepciones a Quality Gates deberán ser explícitas, trazables y gobernadas. |

---

# 118. Criterios de Conformidad

Un Build System será conforme con ENG-012 cuando:

- disponga de pipeline explícito;
- valide dependencias;
- valide Configuration;
- ejecute análisis;
- ejecute Architecture Tests;
- ejecute Testing obligatorio;
- separe Source y output;
- produzca Artifacts verificables;
- controle Secrets;
- mantenga metadata de Build;
- facilite reproducibilidad;
- funcione en CI;
- gestione fallos explícitamente;
- respete Packaging y Versioning;
- mantenga Quality Gates.

---

# 119. Riesgos

Deberán evitarse especialmente:

## Works on My Machine

El Build depende del entorno personal no declarado.

## Non-Reproducible Build

Las mismas entradas generan resultados incompatibles sin explicación.

## Hidden Toolchain

No se conocen herramientas o versiones requeridas.

## Silent Gate Bypass

Una validación crítica se omite sin evidencia.

## Build as Architecture

Los scripts definen reglas que no existen en las especificaciones.

## Secret Leakage

Credenciales terminan dentro del Artifact o Logs.

## Artifact Mutation

Modificar manualmente un Artifact después del Build.

## Dependency Drift

Resolver versiones diferentes para el mismo Release.

## Partial Artifact Publication

Distribuir resultados de un Build incompleto.

## Vendor Lock-in

Confundir el modelo de Build con una herramienta concreta.

---

# 120. Primera Implementación Recomendada

El primer Build Pipeline de MEF debería contemplar:

```text
1. Resolve dependencies
2. Validate Manifest
3. Validate Configuration
4. Validate naming and structure
5. Run static analysis
6. Run Architecture Tests
7. Run Unit Tests
8. Run Contract Tests
9. Run Integration Tests
10. Assemble
11. Package
12. Verify Package
13. Generate Build Report
```

Para Release añadir:

```text
14. Security checks
15. Compatibility checks
16. Generate integrity metadata
17. Produce Release Candidate
```

---

# 121. Principio Rector

> **El Build System de MEF deberá transformar Source validado en Artifacts reproducibles, verificables y trazables mediante un pipeline explícito de resolución, validación, testing, construcción, empaquetado y verificación, sin sustituir las especificaciones que gobiernan cada etapa.**

---

# 122. Conclusión

**ENG-012 — Build System** establece el proceso técnico mediante el cual MEF transforma una implementación en un Artifact confiable.

La cadena completa será:

```text
Source
  ↓
Resolve
  ↓
Validate
  ↓
Analyze
  ↓
Architecture Check
  ↓
Test
  ↓
Build
  ↓
Package
  ↓
Verify
  ↓
Artifact
```

Con ello, un Release deja de significar:

> “Este código compila.”

y pasa a significar:

> **“Este Artifact fue construido a partir de entradas identificables, cumple las reglas arquitectónicas e ingenieriles aplicables, superó sus Quality Gates y puede verificarse independientemente antes de distribución.”**

Ese cambio es importante para la filosofía de MEF: el Build no es únicamente transformación de código; es también un proceso de **producción de evidencia técnica**.

---

# Referencias

## Arquitectura

- ARQ-009 — Builders
- ARQ-010 — Template Engine
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-017 — Release Process