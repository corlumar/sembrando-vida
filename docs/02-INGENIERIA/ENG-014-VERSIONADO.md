---
id: ENG-014
titulo: Versionado
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Versioning
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-003
  - ENG-011
  - ENG-012
  - ENG-013
  - ARQ-011
  - ARQ-014
  - ARQ-017
relacionados:
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-015
  - ENG-016
  - ENG-017
keywords:
  - versioning
  - semantic versioning
  - compatibility
  - breaking change
  - contracts
  - packages
  - modules
  - schema
  - deprecation
  - release
  - mef
---

# ENG-014

# Versionado

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de **Versionado** de **MEF (Modular Enterprise Framework)**.

ENG-014 establece cómo deberán identificarse, evolucionar y compararse las versiones de:

- Framework;
- Packages;
- Modules;
- Contracts;
- Manifest Schemas;
- Configuration Schemas;
- CLI;
- APIs;
- protocolos;
- formatos persistentes;
- herramientas públicas.

El objetivo es que una versión comunique información útil sobre compatibilidad y evolución.

---

# 2. Declaración

Una versión no representa únicamente una etiqueta de Release.

Representa un **Contract de compatibilidad**.

Conceptualmente:

```text
Version
   │
   ├── Identity
   ├── Compatibility
   ├── Evolution
   └── Release History
```

Una modificación que afecte interfaces públicas deberá reflejarse en Versioning.

---

# 3. Objetivos

El sistema de Versionado deberá:

- identificar Releases;
- expresar compatibilidad;
- detectar Breaking Changes;
- permitir Dependency Resolution;
- gobernar deprecaciones;
- soportar Pre-Releases;
- facilitar migraciones;
- permitir automatización;
- mantener trazabilidad;
- evitar ambigüedad.

---

# 4. Modelo Base

MEF adoptará conceptualmente:

```text
MAJOR.MINOR.PATCH
```

Ejemplo:

```text
2.4.1
```

Donde:

```text
2 = MAJOR
4 = MINOR
1 = PATCH
```

---

# 5. MAJOR

`MAJOR` deberá incrementarse cuando exista un cambio incompatible en una interfaz pública gobernada.

Ejemplo:

```text
1.8.4
   ↓
2.0.0
```

---

# 6. MINOR

`MINOR` deberá incrementarse cuando se añada funcionalidad compatible.

Ejemplo:

```text
1.8.4
   ↓
1.9.0
```

---

# 7. PATCH

`PATCH` deberá incrementarse cuando se realice una corrección compatible.

Ejemplo:

```text
1.8.4
   ↓
1.8.5
```

---

# 8. Reset de Componentes

Cuando aumenta `MAJOR`:

```text
1.8.4 → 2.0.0
```

Cuando aumenta `MINOR`:

```text
1.8.4 → 1.9.0
```

El componente inferior deberá reiniciarse según la convención semántica.

---

# 9. Semantic Versioning

MEF utilizará principios compatibles con Semantic Versioning para componentes que expongan interfaces públicas.

Sin embargo, MEF deberá definir explícitamente qué constituye una interfaz pública dentro de su propia arquitectura.

---

# 10. Public Surface

La `Public Surface` podrá incluir:

```text
Contracts
Public APIs
Manifest Schemas
Configuration Schemas
CLI Commands
CLI Arguments
Package Metadata
Events
Extension Points
Persistent Formats
Protocols
```

No se limita a métodos o clases públicas del lenguaje.

---

# 11. Breaking Change

Un `Breaking Change` es una modificación que puede provocar que un consumidor válido de la versión anterior deje de funcionar correctamente bajo las garantías públicas establecidas.

Conceptualmente:

```text
Previously Valid Consumer
          +
      New Version
          ↓
No Longer Valid
          ↓
Breaking Change
```

---

# 12. Breaking Change Scope

Un Breaking Change puede ocurrir en:

```text
Code
Contract
Schema
Configuration
CLI
Package
Protocol
Persistence
Behavior
Architecture
```

Por tanto:

```text
No source-code signature changed
```

no significa necesariamente:

```text
No Breaking Change
```

---

# 13. Contract Versioning

Los Contracts definidos por ARQ-011 deberán considerarse superficies versionables.

Cambios como:

```text
remove operation
rename operation
change required parameter
change return guarantee
change invariant
```

deberán evaluarse como Breaking Changes.

---

# 14. Compatible Contract Change

Normalmente podrá considerarse compatible:

```text
add optional capability
clarify documentation without changing semantics
fix implementation bug while preserving Contract
```

si no invalida consumidores existentes.

---

# 15. Contract Major Version

Un Contract incompatible deberá incrementar su versión MAJOR.

Ejemplo:

```text
CTR-PAYMENT 2.4.0
        ↓
breaking change
        ↓
CTR-PAYMENT 3.0.0
```

---

# 16. Contract Minor Version

Una extensión compatible podrá incrementar MINOR.

```text
2.4.0 → 2.5.0
```

---

# 17. Contract Patch Version

Una corrección que preserve semántica pública podrá incrementar PATCH.

```text
2.4.0 → 2.4.1
```

---

# 18. Module Versioning

Los Modules podrán poseer versión propia cuando sean unidades distribuibles o evolucionables independientemente.

Ejemplo:

```text
MOD-CRM
version: 3.2.1
```

---

# 19. Module Compatibility

Un cambio interno de Module que no modifique su Public Surface podrá ser compatible.

Un cambio en Contracts requeridos o proporcionados deberá evaluarse explícitamente.

---

# 20. Package Versioning

Todo Package distribuible deberá poseer versión.

```text
PKG-CRM@3.2.1
```

ENG-013 consumirá esta información durante Dependency Resolution.

---

# 21. Package Version vs Module Version

No deberá asumirse universalmente:

```text
Package Version = Module Version
```

Un Package podrá contener:

- un Module;
- múltiples Modules;
- Contracts;
- Adapters;
- tooling.

La política concreta deberá declararse.

---

# 22. Framework Version

MEF deberá poseer una versión de Framework.

Ejemplo:

```text
MEF 1.4.0
```

Esta versión representa la evolución del Framework como producto técnico.

---

# 23. Framework Compatibility

Los Packages podrán declarar compatibilidad con Framework.

Ejemplo conceptual:

```text
mef:
  compatible: "^2.0"
```

La sintaxis física dependerá del Manifest Schema.

---

# 24. Independent Versioning

Los componentes que evolucionen independientemente podrán mantener versiones independientes.

Ejemplo:

```text
MEF Core       3.0.0
PKG-CRM        5.2.1
CTR-IDENTITY   2.4.0
CLI            3.1.0
```

No deberán sincronizarse artificialmente si no existe una razón arquitectónica.

---

# 25. Lockstep Versioning

Un conjunto de componentes podrá utilizar Lockstep Versioning cuando se liberen y evolucionen necesariamente como una unidad.

Esto deberá ser una decisión explícita.

---

# 26. Independent vs Lockstep

La regla general será:

```text
Independent evolution
→ Independent Versioning

Atomic evolution
→ Lockstep Versioning
```

No deberá utilizarse Lockstep únicamente por comodidad administrativa.

---

# 27. Manifest Schema Versioning

El Manifest Schema deberá poder versionarse.

Ejemplo conceptual:

```text
schemaVersion: 2
```

La versión del Schema no deberá confundirse con la versión del Package.

---

# 28. Manifest Example

```yaml
id: PKG-CRM
version: 3.2.1
schemaVersion: 2
```

Aquí:

```text
3.2.1
→ Package Version

2
→ Manifest Schema Version
```

---

# 29. Manifest Breaking Changes

Ejemplos:

```text
remove required field
rename field without compatibility
change field meaning
change accepted type
```

podrán requerir nueva versión incompatible del Schema.

---

# 30. Manifest Compatible Changes

Añadir una propiedad opcional con semántica compatible podrá constituir una evolución compatible.

---

# 31. Configuration Schema Versioning

ENG-011 deberá poder asociar versión a Configuration Schema.

Ejemplo:

```text
configurationSchemaVersion: 3
```

---

# 32. Configuration Breaking Changes

Podrán considerarse incompatibles:

```text
remove public key
rename public key
change type
change meaning
make optional key required
remove accepted enum value
```

---

# 33. Configuration Default Changes

Cambiar un default deberá evaluarse semánticamente.

Ejemplo:

```text
allowUnsignedPackages:
false → true
```

podría ser incompatible o inseguro aunque el tipo no cambie.

---

# 34. Configuration Compatible Change

Añadir una propiedad opcional con default compatible normalmente podrá ser MINOR.

---

# 35. CLI Versioning

ENG-007 deberá tratar la CLI pública como interfaz versionable.

Ejemplo:

```text
mef package install
```

forma parte de la Public Surface.

---

# 36. CLI Breaking Changes

Ejemplos:

```text
remove command
rename command
remove argument
change exit-code semantics
change machine-readable output incompatibly
```

podrán constituir Breaking Changes.

---

# 37. CLI Compatible Changes

Ejemplos:

```text
add command
add optional argument
add output field when schema allows extension
```

podrán ser compatibles.

---

# 38. Machine Output

Los formatos destinados a automatización deberán tener estabilidad mayor que el output puramente humano.

Ejemplo:

```text
--format=json
```

deberá considerarse una API.

---

# 39. API Versioning

Las APIs públicas deberán declarar una estrategia de Versioning cuando evolucionen independientemente.

La estrategia podrá variar por Implementation Profile.

---

# 40. Protocol Versioning

Los protocolos entre componentes o sistemas deberán poder declarar versión cuando la compatibilidad lo requiera.

---

# 41. Persistent Format Versioning

Los formatos persistidos deberán versionarse cuando su evolución pueda requerir migración.

Ejemplos:

```text
database schema
serialized state
cache format
event payload
configuration
```

---

# 42. Data Schema Version

La versión de datos no deberá confundirse automáticamente con la versión de aplicación.

```text
Application Version
≠
Database Schema Version
```

---

# 43. Migration

Cuando una nueva versión requiera transformar estado persistente deberá existir una estrategia de Migration.

Conceptualmente:

```text
Schema v1
   ↓
Migration
   ↓
Schema v2
```

---

# 44. Migration Direction

Las migraciones deberán declarar cuando corresponda:

```text
up
down
```

No deberá asumirse que toda migración es reversible.

---

# 45. Migration Compatibility

Una Release que requiera migración irreversible deberá indicarlo en metadata o documentación operativa cuando sea relevante.

---

# 46. Pre-Release

MEF podrá utilizar identificadores Pre-Release.

Ejemplos:

```text
2.0.0-alpha.1
2.0.0-beta.1
2.0.0-rc.1
```

---

# 47. Alpha

`alpha` representa una versión temprana que puede experimentar cambios significativos.

---

# 48. Beta

`beta` representa una versión funcionalmente avanzada pero todavía no declarada estable.

---

# 49. Release Candidate

`rc` representa una versión candidata a convertirse en Release estable.

```text
2.0.0-rc.1
```

debería aproximarse funcionalmente a:

```text
2.0.0
```

salvo correcciones necesarias.

---

# 50. Pre-Release Ordering

Conceptualmente:

```text
2.0.0-alpha.1
<
2.0.0-beta.1
<
2.0.0-rc.1
<
2.0.0
```

La comparación exacta deberá respetar las reglas adoptadas por el Version Resolver.

---

# 51. Pre-Release Stability

Un consumidor no deberá recibir Pre-Releases automáticamente cuando solicite únicamente versiones estables.

---

# 52. Pre-Release Dependency

El uso de una Pre-Release deberá ser explícito cuando corresponda.

---

# 53. Build Metadata

Podrá utilizarse metadata adicional.

Ejemplo:

```text
2.4.1+build.587
```

Esta metadata no deberá cambiar la compatibilidad semántica de la versión base.

---

# 54. Build Number

Un Build Number permanece separado de la versión.

```text
Version:
2.4.1

Build:
587
```

ENG-012 mantiene esta separación.

---

# 55. Version Immutability

Una versión publicada deberá considerarse inmutable.

```text
PKG-CRM 2.4.1
```

no deberá ser sustituida posteriormente por contenido diferente.

---

# 56. Rebuild

Si una versión publicada necesita cambios, deberá producirse una nueva versión.

Ejemplo:

```text
2.4.1
   ↓
fix
   ↓
2.4.2
```

No:

```text
replace contents of 2.4.1
```

---

# 57. Version Uniqueness

La combinación:

```text
Component Identity
+
Version
```

deberá identificar una Release inmutable dentro de su namespace.

---

# 58. Dependency Constraint

Los consumidores podrán declarar restricciones.

Ejemplos conceptuales:

```text
=2.4.1
>=2.4.0
<3.0.0
^2.4
```

La sintaxis concreta dependerá del Resolver.

---

# 59. Exact Version

Una restricción exacta selecciona:

```text
2.4.1
```

y no otra versión.

---

# 60. Compatible Range

Un rango podrá expresar:

```text
compatible versions
```

según las reglas semánticas adoptadas.

---

# 61. Dependency Resolution

ENG-013 utilizará Version Constraints para calcular:

```text
Requested Constraints
       ↓
Version Resolver
       ↓
Compatible Version Set
       ↓
Resolution
```

---

# 62. Highest Compatible Version

Un Resolver podrá preferir la versión compatible más alta.

Sin embargo, el Dependency Lock deberá conservar la versión finalmente seleccionada.

---

# 63. Version Pinning

Determinados entornos podrán exigir versiones exactas.

Especialmente:

```text
CI
Production
Release Builds
```

---

# 64. Floating Versions

Las versiones completamente flotantes deberán evitarse en contextos donde se requiera reproducibilidad.

Ejemplo problemático:

```text
latest
```

---

# 65. `latest`

`latest` podrá existir como alias de Registry o tooling.

No deberá utilizarse como identidad persistente de dependencia.

---

# 66. Dependency Lock

ENG-013 deberá registrar versiones exactas.

Ejemplo:

```text
Manifest:
PKG-CRM ^3.0

Lock:
PKG-CRM 3.4.2
```

---

# 67. Compatibility Matrix

MEF podrá mantener matrices de compatibilidad.

Ejemplo:

| Package | Version | MEF |
|---|---:|---:|
| PKG-CRM | 2.x | MEF 1.x |
| PKG-CRM | 3.x | MEF 2.x |
| PKG-CRM | 4.x | MEF 3.x |

Estas matrices podrán generarse desde metadata cuando sea posible.

---

# 68. Runtime Compatibility

Un Package podrá declarar requisitos del Runtime.

Ejemplo conceptual:

```text
runtime:
  php: ">=8.4"
```

en un perfil PHP.

Esto pertenece al Implementation Profile, no al modelo universal.

---

# 69. Compatibility Dimensions

La compatibilidad podrá tener varias dimensiones:

```text
Framework
Runtime
Contract
Package
Schema
Platform
Protocol
```

Un Package compatible con Framework no necesariamente será compatible con todas las demás dimensiones.

---

# 70. Compatibility Check

Conceptualmente:

```text
Candidate Version
      ↓
Framework Compatibility
      ↓
Runtime Compatibility
      ↓
Contract Compatibility
      ↓
Dependency Compatibility
      ↓
Schema Compatibility
      ↓
Compatible / Incompatible
```

---

# 71. Compatibility Declaration

La compatibilidad deberá derivarse de metadata y reglas explícitas.

No deberá depender únicamente de intentar ejecutar el componente y observar si falla.

---

# 72. Backward Compatibility

Una nueva versión es `backward compatible` cuando consumidores válidos de la versión anterior continúan funcionando bajo las garantías definidas.

---

# 73. Forward Compatibility

Cuando sea relevante podrá definirse `forward compatibility`.

Ejemplo:

```text
older reader
can tolerate
new optional fields
```

Esto es especialmente importante para Schemas.

---

# 74. Schema Extensibility

Los Schemas podrán diseñarse para permitir extensiones compatibles.

Esto deberá ser explícito.

---

# 75. Behavioral Compatibility

La compatibilidad incluye comportamiento observable.

Ejemplo:

```text
function signature unchanged
```

pero:

```text
authorization no longer checked
```

representa un cambio semántico crítico.

---

# 76. Performance Compatibility

Los cambios de rendimiento normalmente no requerirán MAJOR.

Sin embargo, si existe un SLA o garantía pública contractual, una degradación podrá constituir incompatibilidad.

---

# 77. Security Compatibility

Una corrección de seguridad puede cambiar comportamiento.

No deberá retrasarse necesariamente hasta una versión MAJOR si preservar el comportamiento anterior implicaría mantener una vulnerabilidad.

La excepción deberá documentarse.

---

# 78. Security Exception

En casos críticos podrá introducirse un cambio incompatible en PATCH o MINOR por seguridad.

Esto deberá ser excepcional, explícito y documentado.

---

# 79. Bug Compatibility

Un bug no constituye automáticamente parte del Contract.

Corregir comportamiento claramente contrario a la especificación podrá considerarse compatible.

---

# 80. De Facto Behavior

Si consumidores dependen ampliamente de un comportamiento no documentado, el impacto deberá evaluarse antes de modificarlo.

No todo comportamiento accidental merece convertirse en Contract, pero tampoco deberá ignorarse el impacto operativo.

---

# 81. Deprecation

Antes de eliminar una Public Surface debería utilizarse Deprecation cuando sea razonablemente posible.

Conceptualmente:

```text
Active
  ↓
Deprecated
  ↓
Removal
```

---

# 82. Deprecated

Una interfaz Deprecated:

- continúa disponible temporalmente;
- no se recomienda para nuevo código;
- posee reemplazo cuando sea posible;
- podrá eliminarse en una versión futura.

---

# 83. Deprecation Metadata

Debería poder conocerse:

```text
deprecatedSince
replacement
plannedRemoval
```

cuando corresponda.

---

# 84. Deprecation Warning

Tooling podrá producir:

```text
MEF-DEP-001
```

o un código equivalente cuando se utilice una superficie Deprecated.

---

# 85. Deprecation Window

La duración de Deprecation deberá ser proporcional al impacto.

No deberá establecerse universalmente como un número fijo de días.

---

# 86. Major Removal

Normalmente una superficie pública Deprecated deberá eliminarse en una versión MAJOR.

---

# 87. Immediate Removal

Podrá existir eliminación inmediata cuando mantener la funcionalidad represente:

- vulnerabilidad crítica;
- corrupción;
- riesgo operativo severo;
- incumplimiento.

Deberá documentarse.

---

# 88. Deprecation Documentation

Toda Deprecation pública deberá indicar una ruta de migración cuando exista.

---

# 89. Compatibility Alias

Durante una transición podrán existir aliases.

Ejemplo:

```text
oldKey
   ↓
newKey
```

Deberán ser temporales y producir Warning cuando corresponda.

---

# 90. Compatibility Adapter

Para Contracts complejos podrá utilizarse:

```text
Old Contract
     ↓
Compatibility Adapter
     ↓
New Contract
```

Esto puede permitir evolución gradual.

---

# 91. Migration Guide

Una versión MAJOR debería incluir Migration Guide cuando existan cambios relevantes.

---

# 92. Change Classification

Todo cambio público debería clasificarse antes del Release.

Categorías mínimas:

```text
BREAKING
FEATURE
FIX
SECURITY
DEPRECATION
INTERNAL
DOCUMENTATION
```

---

# 93. Version Impact

Conceptualmente:

| Cambio | Impacto mínimo esperado |
|---|---|
| BREAKING | MAJOR |
| FEATURE compatible | MINOR |
| FIX compatible | PATCH |
| DEPRECATION compatible | MINOR o PATCH según impacto |
| INTERNAL | PATCH o ninguno |
| DOCUMENTATION | PATCH o ninguno |
| SECURITY | según compatibilidad y urgencia |

---

# 94. Minimum Version Impact

La tabla anterior representa impacto mínimo.

Un equipo podrá elegir una versión superior cuando exista una razón válida.

Ejemplo:

```text
compatible feature
```

podrá incluirse dentro de una nueva versión MAJOR ya planificada.

---

# 95. Breaking Change Detection

MEF debería automatizar progresivamente la detección de Breaking Changes.

Podrá comparar:

```text
Contracts
Schemas
CLI
Manifest
Configuration
Public APIs
```

entre versiones.

---

# 96. Contract Diff

Conceptualmente:

```text
CTR v2
   │
   ▼
Contract Diff
   ▲
CTR v3
```

Resultado:

```text
Compatible
Potentially Breaking
Breaking
```

---

# 97. Schema Diff

Podrá analizar:

```text
removed fields
new required fields
type changes
enum removals
default changes
```

---

# 98. CLI Diff

Podrá analizar:

```text
commands
arguments
flags
exit codes
machine schemas
```

---

# 99. Compatibility Report

El Build o Release Pipeline podrá generar:

```text
Compatibility Report
```

con evidencia del impacto de cambios.

---

# 100. Build Integration

ENG-012 podrá incorporar:

```text
Version Validation
Compatibility Validation
Schema Diff
Contract Diff
```

como Quality Gates.

---

# 101. Release Integration

ENG-017 deberá utilizar la clasificación de cambios para validar la versión propuesta.

Ejemplo:

```text
Breaking Change detected
+
Version changed 2.4.0 → 2.5.0
          ↓
FAIL
```

si la política exige incremento MAJOR.

---

# 102. Version Gate

Conceptualmente:

```text
Detected Changes
       ↓
Required Version Impact
       ↓
Declared Version
       ↓
Valid / Invalid
```

---

# 103. Automatic Version Suggestion

Tooling podrá sugerir:

```text
Current: 2.4.1
Required: MAJOR
Suggested: 3.0.0
```

No deberá publicar automáticamente sin pasar por Release Process.

---

# 104. Conventional Change Metadata

MEF podrá utilizar metadata estructurada en commits, Pull Requests o Changesets para ayudar a determinar Version Impact.

No deberá depender exclusivamente del texto libre de Git commits.

---

# 105. Changeset

Podrá existir un concepto:

```text
Changeset
```

que declare:

```text
component
changeType
description
breaking
migration
```

---

# 106. Changeset Example

```yaml
component: PKG-CRM
changeType: feature
breaking: false
description: Adds configurable customer scoring.
```

La sintaxis definitiva podrá definirse posteriormente.

---

# 107. Breaking Changeset

Ejemplo:

```yaml
component: CTR-IDENTITY
changeType: breaking
breaking: true
description: Removes legacy authenticate operation.
migration: MIG-IDENTITY-003
```

---

# 108. Version Source of Truth

Cada componente versionable deberá poseer una fuente autoritativa de versión.

No deberá existir divergencia entre:

```text
Manifest
Package metadata
Artifact
Registry
Release tag
```

---

# 109. Derived Version

Otros archivos podrán derivar la versión desde la Source of Truth.

Esto reduce inconsistencias.

---

# 110. Duplicate Version Declarations

Cuando una tecnología requiera duplicar versiones, el Build deberá verificar que coincidan.

---

# 111. Git Tags

Los Implementation Profiles podrán utilizar Git Tags.

Ejemplo:

```text
v2.4.1
```

Un Tag no sustituye la versión declarada en metadata gobernada.

---

# 112. Release Tag

El Release Process podrá crear Tags únicamente después de aprobar la versión correspondiente.

---

# 113. Branch Names

Los nombres de ramas no deberán utilizarse como versiones.

Ejemplo:

```text
develop
main
release/*
```

son referencias de desarrollo, no Component Versions.

---

# 114. Commit Hash

Un Commit Hash identifica Source Revision.

No sustituye:

```text
Semantic Version
```

Ambos podrán aparecer juntos en Build Metadata.

---

# 115. Snapshot Version

Development Builds podrán utilizar metadata que identifique que no son Releases estables.

Ejemplo conceptual:

```text
2.5.0-dev
```

La convención exacta dependerá del perfil.

---

# 116. Nightly Builds

Los Nightly Builds deberán distinguirse de Releases oficiales.

---

# 117. Release Candidate Promotion

Idealmente un RC validado deberá convertirse en Release estable sin cambios funcionales.

Si cambia el contenido:

```text
rc.1
   ↓
changes
   ↓
rc.2
```

antes de Stable.

---

# 118. Artifact Promotion

Cuando el ecosistema lo permita, se favorecerá promover el mismo Artifact verificado entre etapas.

```text
Build
 ↓
RC Artifact
 ↓
Validation
 ↓
Promote
 ↓
Release
```

en lugar de reconstruirlo innecesariamente.

---

# 119. Versioned Documentation

La documentación pública deberá poder asociarse con una versión.

Ejemplo:

```text
docs/2.x
docs/3.x
```

o mecanismo equivalente.

---

# 120. Documentation Compatibility

La documentación mostrada a un usuario deberá corresponder, cuando sea posible, a la versión que utiliza.

---

# 121. Versioned Examples

Los ejemplos de código y Configuration deberán indicar cuando pertenecen a una versión específica.

---

# 122. Versioned Templates

Templates distribuidos podrán poseer versión independiente o seguir una versión de Package.

La política deberá declararse.

---

# 123. Generator Versioning

ENG-008 deberá considerar que cambios en Generators pueden modificar Source generado.

Si el output público cambia incompatiblemente, deberá evaluarse Version Impact.

---

# 124. Build Tool Versioning

ENG-012 deberá registrar versiones relevantes de tooling para reproducibilidad.

Esto no implica que toda herramienta comparta versión con MEF.

---

# 125. Package Manager Versioning

ENG-013 podrá evolucionar independientemente cuando su CLI o comportamiento sea distribuido separadamente.

---

# 126. Architecture Version

Los documentos ARQ poseen sus propias versiones documentales.

Estas no deberán confundirse automáticamente con:

```text
MEF Framework Version
```

---

# 127. Engineering Specification Version

Los documentos ENG también poseen versión documental.

Ejemplo:

```text
ENG-014
version: 1.0.0
```

Esta representa la versión de la especificación documental.

---

# 128. Specification vs Implementation Version

```text
Specification Version
≠
Implementation Version
```

Una implementación deberá poder declarar qué versión de una Specification soporta cuando resulte necesario.

---

# 129. Architecture Compatibility

Un cambio arquitectónico podrá producir impacto en Versioning si modifica garantías públicas del Framework.

---

# 130. Internal Architecture Change

Una refactorización arquitectónica interna que preserve todas las garantías públicas no requiere automáticamente MAJOR.

---

# 131. Architectural Breaking Change

Ejemplo:

```text
Previously:
Modules may depend directly on Platform Adapter.

Now:
Such dependency is prohibited.
```

Si Packages públicos existentes válidos dejan de ser compatibles, deberá evaluarse como Breaking Change del Framework o de la Specification correspondiente.

---

# 132. AI/EI Evolution

Cambios en Architectural Invariants o Engineering Invariants deberán evaluarse por su impacto en implementaciones existentes.

Añadir un nuevo Invariant obligatorio puede constituir Breaking Change aunque ninguna API haya cambiado.

---

# 133. Conformance Version

En el futuro MEF podrá declarar:

```text
Conformance Level
```

o:

```text
Specification Set Version
```

para identificar el conjunto de reglas con el que una implementación es conforme.

---

# 134. Version Compatibility Policy

Cada componente público deberá documentar:

```text
versioning strategy
public surface
compatibility guarantees
deprecation policy
```

cuando difiera de la política general.

---

# 135. Long-Term Support

MEF podrá establecer Releases:

```text
LTS
```

si existe una política formal de mantenimiento.

`LTS` no deberá utilizarse únicamente como etiqueta comercial.

---

# 136. Support Window

Una Release soportada deberá poder indicar:

```text
supported
maintenance
security-only
end-of-life
```

cuando se implemente Lifecycle de soporte.

---

# 137. End of Life

Una versión EOL deja de recibir mantenimiento según política.

No deberá eliminarse automáticamente del Registry únicamente por alcanzar EOL.

---

# 138. Security Support

Una versión podrá recibir únicamente correcciones de seguridad durante una fase de mantenimiento.

---

# 139. Backport

Una corrección podrá aplicarse a una rama anterior compatible.

Ejemplo:

```text
3.4.2
```

y:

```text
2.9.8
```

pueden contener la misma corrección adaptada.

---

# 140. Backport Version

Cada rama deberá incrementar su propia versión apropiadamente.

---

# 141. Version Skipping

No existe obligación de publicar todas las versiones intermedias.

Ejemplo:

```text
2.4.1 → 2.6.0
```

puede ser válido.

Sin embargo, no deberá utilizarse para ocultar historial o incompatibilidades.

---

# 142. Version Downgrade

ENG-013 deberá tratar Downgrade como operación explícita.

La compatibilidad de datos deberá evaluarse independientemente.

---

# 143. Downgrade Safety

No deberá asumirse:

```text
older version
=
safe rollback
```

Una versión anterior puede no comprender estado producido por una versión posterior.

---

# 144. Version Comparison

El sistema deberá disponer de comparación determinista de versiones.

Ejemplo:

```text
1.9.0 < 1.10.0
```

No deberá utilizar comparación lexicográfica simple.

---

# 145. Invalid Versions

Versiones que no cumplan la estrategia adoptada deberán rechazarse en contextos gobernados.

Ejemplos:

```text
version-final
newest
release-two
```

si el componente requiere Semantic Versioning.

---

# 146. Leading Zeros

Se evitarán representaciones ambiguas como:

```text
01.02.003
```

Preferido:

```text
1.2.3
```

---

# 147. Version Prefix

El prefijo:

```text
v
```

podrá utilizarse en Tags:

```text
v2.4.1
```

pero no deberá formar parte necesariamente del valor semántico:

```text
2.4.1
```

---

# 148. Version Normalization

Tooling podrá normalizar representaciones cuando no altere semántica.

No deberá aceptar silenciosamente valores ambiguos.

---

# 149. Version Errors

Podrá existir una taxonomía:

```text
MEF-VER-001 Invalid version
MEF-VER-002 Invalid constraint
MEF-VER-003 Breaking change without MAJOR bump
MEF-VER-004 Incompatible dependency
MEF-VER-005 Schema version unsupported
MEF-VER-006 Deprecated version
MEF-VER-007 Version already published
MEF-VER-008 Version metadata mismatch
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 150. Diagnostics

Los errores deberán explicar:

```text
component
currentVersion
requestedVersion
requiredConstraint
detectedChange
requiredImpact
```

cuando sea relevante.

---

# 151. Version Inspection

La CLI podrá proporcionar:

```text
mef version
```

para mostrar la versión del Framework y tooling principal.

---

# 152. Component Version

Podrá existir:

```text
mef package info PKG-CRM
```

para consultar versión de Packages.

---

# 153. Compatibility Check CLI

Podrá existir:

```text
mef compatibility check
```

o una operación equivalente dentro de:

```text
mef project validate
```

La superficie definitiva dependerá de ENG-007.

---

# 154. Version Suggestion CLI

Tooling podrá ofrecer:

```text
mef version suggest
```

basándose en Changesets y Compatibility Diff.

No deberá publicar automáticamente.

---

# 155. Version Bump

Podrá existir:

```text
mef version bump patch
mef version bump minor
mef version bump major
```

cuando el perfil lo soporte.

La operación deberá actualizar únicamente fuentes de versión gobernadas.

---

# 156. Dry Run

Los cambios automáticos de versión deberían permitir:

```text
--dry-run
```

---

# 157. Version Validation

El Build deberá validar:

```text
syntax
consistency
compatibility
immutability
```

antes de Release.

---

# 158. Release Validation

ENG-017 deberá comprobar:

```text
Version not previously released
Version impact correct
Artifacts match version
Manifest matches version
Tags match version
Compatibility evidence available
```

---

# 159. Version Provenance

Una Release deberá poder relacionar:

```text
Version
Source Revision
Build ID
Artifact Hash
Release Record
```

---

# 160. Version History

El historial deberá poder reconstruirse mediante:

```text
Release Records
Registry Metadata
Source Tags
Changelog
```

según Implementation Profile.

---

# 161. Changelog

Los Releases públicos deberían disponer de Changelog.

El Changelog deberá describir cambios relevantes para consumidores.

---

# 162. Changelog Categories

Se recomienda:

```text
Added
Changed
Deprecated
Removed
Fixed
Security
```

cuando resulte apropiado.

---

# 163. Breaking Changes in Changelog

Los Breaking Changes deberán destacarse explícitamente.

---

# 164. Migration References

Cuando exista Breaking Change, el Changelog debería enlazar o identificar la Migration Guide correspondiente.

---

# 165. Machine-Readable Changes

Además del Changelog humano, MEF podrá mantener Changesets procesables.

```text
Changesets
   ↓
Version Calculation
   ↓
Changelog
   ↓
Release
```

---

# 166. Release Train

MEF podrá adoptar posteriormente un calendario de Releases.

La frecuencia de Release no deberá alterar las reglas de Version Impact.

---

# 167. Calendar Versioning

MEF no utilizará Calendar Versioning como estrategia universal mientras Semantic Versioning sea el modelo base.

Un Implementation Profile podrá utilizar otra estrategia únicamente si existe una justificación y Contract explícitos.

---

# 168. Zero Major Version

Durante una fase inicial podrá utilizarse:

```text
0.x.y
```

para componentes todavía no declarados estables.

---

# 169. `0.x` Semantics

Incluso durante `0.x`, MEF deberá documentar cambios incompatibles.

No deberá utilizar:

```text
0.x
```

como excusa para evolución arbitraria sin trazabilidad.

---

# 170. First Stable Release

La transición:

```text
0.x
   ↓
1.0.0
```

representará la declaración de una Public Surface suficientemente estable y gobernada.

---

# 171. Stability

Una versión estable deberá cumplir los Quality Gates aplicables.

La ausencia de sufijo Pre-Release implica una expectativa superior de estabilidad.

---

# 172. Version Governance

La asignación de versiones oficiales deberá formar parte del Release Process.

No deberá depender únicamente de decisiones locales de un desarrollador.

---

# 173. Version Ownership

Cada componente versionable deberá tener ownership definido.

---

# 174. Version Approval

Los Releases MAJOR podrán requerir un nivel de aprobación superior cuando la gobernanza así lo determine.

---

# 175. Breaking Change Review

Todo Breaking Change público debería recibir revisión explícita antes de Release.

---

# 176. Compatibility Budget

Los equipos deberán favorecer evolución compatible.

MAJOR no deberá utilizarse como sustituto de diseño cuidadoso.

---

# 177. No Permanent Compatibility

MEF no deberá intentar mantener compatibilidad indefinida con todas las versiones históricas.

La compatibilidad deberá estar gobernada mediante Support Policy.

---

# 178. No Silent Breakage

La regla fundamental será:

```text
Breaking Change
      ↓
Detect
      ↓
Declare
      ↓
Version
      ↓
Document
      ↓
Migrate
```

Nunca:

```text
Breaking Change
      ↓
Publish silently
```

---

# 179. Invariantes de Ingeniería

ENG-014 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-226 | Toda unidad pública distribuible deberá poseer una versión identificable cuando evolucione independientemente. |
| EI-227 | Las versiones estables deberán utilizar una estrategia semántica gobernada basada en MAJOR.MINOR.PATCH salvo excepción explícita. |
| EI-228 | Un Breaking Change en una Public Surface estable deberá reflejarse en Version Impact. |
| EI-229 | Las versiones publicadas deberán tratarse como inmutables. |
| EI-230 | Package Version, Module Version, Schema Version, Build ID y Source Revision deberán mantenerse como conceptos distintos. |
| EI-231 | Las restricciones de dependencias deberán resolverse mediante comparación determinista de versiones. |
| EI-232 | Los Dependency Locks deberán registrar versiones exactas resueltas. |
| EI-233 | Las Pre-Releases no deberán seleccionarse implícitamente cuando el consumidor solicite únicamente versiones estables. |
| EI-234 | Los Manifest Schemas y Configuration Schemas públicos deberán versionarse cuando su evolución pueda afectar compatibilidad. |
| EI-235 | La CLI destinada a automatización deberá tratarse como Public Surface versionable. |
| EI-236 | Las modificaciones de comportamiento observable deberán evaluarse por compatibilidad aunque no cambien firmas de código. |
| EI-237 | Las Public Surfaces deberán utilizar Deprecation antes de Removal cuando sea razonablemente posible. |
| EI-238 | Las excepciones de compatibilidad por seguridad deberán ser explícitas y documentadas. |
| EI-239 | Una versión anterior no deberá asumirse automáticamente como rollback seguro. |
| EI-240 | El Versioning deberá distinguir Specification Version de Implementation Version. |
| EI-241 | Los cambios en AI o EI obligatorios deberán evaluarse por impacto sobre implementaciones existentes. |
| EI-242 | El Build y Release Pipeline deberán poder validar coherencia entre versiones declaradas y Artifacts producidos. |
| EI-243 | Un Breaking Change no deberá publicarse silenciosamente bajo una versión que implique compatibilidad. |
| EI-244 | Las Releases deberán poder relacionar Version, Source Revision, Build ID y Artifact Integrity. |
| EI-245 | La asignación de versiones oficiales deberá permanecer gobernada por el Release Process. |

---

# 180. Criterios de Conformidad

Una implementación será conforme con ENG-014 cuando:

- utilice versiones deterministas;
- distinga MAJOR, MINOR y PATCH;
- identifique Public Surfaces;
- clasifique Breaking Changes;
- versione Packages;
- versione Schemas cuando corresponda;
- gestione Pre-Releases;
- soporte Dependency Constraints;
- mantenga Lock exacto;
- trate versiones publicadas como inmutables;
- gestione Deprecation;
- permita Migration;
- valide compatibilidad;
- mantenga trazabilidad;
- integre Versioning con Build;
- integre Versioning con Package Manager;
- integre Versioning con Release Process.

---

# 181. Riesgos

Deberán evitarse especialmente:

## Version as Decoration

Cambiar números sin relación con compatibilidad.

## Silent Breaking Change

Publicar incompatibilidades bajo MINOR o PATCH sin justificación.

## Everything Shares One Version

Forzar componentes independientes a evolucionar juntos.

## Schema Confusion

Confundir:

```text
Package Version
```

con:

```text
Manifest Schema Version
```

## Build Confusion

Confundir:

```text
Version
```

con:

```text
Build ID
```

## Mutable Release

Modificar el contenido de una versión ya publicada.

## `latest` Dependency

Utilizar aliases flotantes como estado reproducible.

## Infinite Compatibility

Intentar soportar indefinidamente toda interfaz histórica.

## No Migration Path

Eliminar Public Surface sin proporcionar transición cuando era posible.

## Semantic Blindness

Considerar compatible un cambio únicamente porque las firmas siguen iguales.

## `0.x` Chaos

Utilizar versiones iniciales como excusa para no documentar incompatibilidades.

---

# 182. Arquitectura Recomendada

El modelo general será:

```text
                    CHANGE
                       │
                       ▼
              Change Classification
                       │
        ┌──────────────┼──────────────┐
        ▼              ▼              ▼
     BREAKING        FEATURE          FIX
        │              │              │
        ▼              ▼              ▼
      MAJOR           MINOR          PATCH
        │              │              │
        └──────────────┼──────────────┘
                       ▼
               Version Candidate
                       │
                       ▼
              Compatibility Check
                       │
                       ▼
                  Build Gate
                       │
                       ▼
                 Release Gate
                       │
                       ▼
                Published Version
```

---

# 183. Compatibilidad Multidimensional

MEF deberá entender compatibilidad como:

```text
                  Compatibility
                       │
       ┌───────────────┼────────────────┐
       │               │                │
       ▼               ▼                ▼
    Contract         Schema          Runtime
       │               │                │
       ▼               ▼                ▼
     Package        Configuration     Platform
       │               │                │
       └───────────────┼────────────────┘
                       ▼
                  Compatible?
```

Esto evita reducir Versioning únicamente a firmas de código.

---

# 184. Primera Estrategia Recomendada

Para la primera implementación:

```text
Framework
→ Semantic Versioning

Packages
→ Semantic Versioning

Public Contracts
→ Semantic Versioning

CLI
→ follows Framework unless independently distributed

Manifest Schema
→ explicit Schema Version

Configuration Schema
→ explicit Schema Version

Build
→ Build ID independent of Version
```

---

# 185. Primer Quality Gate de Versionado

Antes de Release:

```text
1. Detect public changes
2. Classify changes
3. Detect Breaking Changes
4. Determine required Version Impact
5. Compare proposed Version
6. Validate Manifest versions
7. Validate Schema versions
8. Validate Package versions
9. Validate Dependency Constraints
10. Generate Compatibility Report
```

Resultado:

```text
PASS
```

o:

```text
FAIL
```

antes de publicar.

---

# 186. Ejemplo Completo

Estado actual:

```text
MEF Core      2.4.1
PKG-CRM       3.6.2
CTR-IDENTITY  2.1.0
```

Se añade una operación opcional compatible a CRM:

```text
PKG-CRM
3.6.2 → 3.7.0
```

Se corrige un bug interno:

```text
MEF Core
2.4.1 → 2.4.2
```

Se elimina una operación pública de Identity:

```text
CTR-IDENTITY
2.1.0 → 3.0.0
```

Si CRM depende de:

```text
CTR-IDENTITY ^2.0
```

el Resolver no deberá instalar automáticamente:

```text
CTR-IDENTITY 3.0.0
```

hasta que CRM declare compatibilidad.

---

# 187. Principio Rector

> **El Versionado de MEF deberá comunicar compatibilidad real: todo cambio público deberá clasificarse por su impacto y toda incompatibilidad deberá detectarse, declararse, versionarse, documentarse y acompañarse de una estrategia de migración cuando corresponda.**

---

# 188. Conclusión

**ENG-014 — Versionado** establece el lenguaje mediante el cual MEF comunica evolución y compatibilidad.

La cadena será:

```text
Change
  ↓
Classification
  ↓
Compatibility Analysis
  ↓
Version Impact
  ↓
Version Candidate
  ↓
Build Validation
  ↓
Release Validation
  ↓
Immutable Release
```

Con esto:

```text
MAJOR
```

deja de significar simplemente:

```text
"hicimos muchos cambios"
```

y significa:

```text
"existe una modificación incompatible
en una superficie pública gobernada"
```

Mientras:

```text
MINOR
```

significa:

```text
"extendimos capacidad
manteniendo compatibilidad"
```

y:

```text
PATCH
```

significa:

```text
"corregimos comportamiento
manteniendo las garantías públicas"
```

La consecuencia más importante es que MEF podrá razonar automáticamente sobre compatibilidad:

```text
Contracts ───────────┐
Manifest Schema ─────┤
Configuration ───────┤
Packages ────────────┼──→ Compatibility Engine
CLI ─────────────────┤            │
AI / EI ─────────────┤            ▼
Public APIs ─────────┘      Version Impact
                                  │
                    ┌─────────────┼─────────────┐
                    ▼             ▼             ▼
                  MAJOR         MINOR          PATCH
```

Así, Versioning deja de ser una convención administrativa y se convierte en una propiedad verificable de la arquitectura de MEF.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-011 — Contracts
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-003 — Manifest
- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-017 — Release Process