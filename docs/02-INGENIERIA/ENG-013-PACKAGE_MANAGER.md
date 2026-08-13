---
id: ENG-013
titulo: Package Manager
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Package Management
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-003
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ARQ-006
  - ARQ-016
  - ARQ-017
relacionados:
  - ENG-007
  - ENG-008
  - ENG-014
  - ENG-015
  - ENG-017
keywords:
  - package
  - package manager
  - dependency resolution
  - registry
  - lockfile
  - install
  - update
  - rollback
  - integrity
  - supply chain
  - mef
---

# ENG-013

# Package Manager

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica del **Package Manager** de **MEF (Modular Enterprise Framework)**.

El Package Manager será responsable de administrar el ciclo técnico de los Packages utilizados por una implementación MEF.

Sus responsabilidades principales incluyen:

- discovery;
- dependency resolution;
- compatibility validation;
- integrity verification;
- installation;
- update;
- removal;
- rollback;
- locking;
- Registry interaction.

---

# 2. Declaración

El Package Manager administra unidades distribuibles.

No deberá confundirse con:

- Module Registry;
- Service Container;
- Build System;
- Generator;
- Runtime Lifecycle;
- Release Process.

La relación conceptual será:

```text
Source
  ↓
Build System
  ↓
Artifact
  ↓
Packaging
  ↓
Package
  ↓
Package Registry
  ↓
Package Manager
  ↓
Installed Package
  ↓
Runtime Registration
```

---

# 3. Objetivos

El Package Manager deberá:

- localizar Packages;
- verificar identidad;
- resolver dependencias;
- comprobar compatibilidad;
- verificar integridad;
- instalar de forma controlada;
- actualizar de forma segura;
- permitir eliminación;
- mantener estado reproducible;
- soportar rollback cuando corresponda;
- producir diagnóstico;
- proteger Software Supply Chain.

---

# 4. Conceptos Fundamentales

MEF distingue:

```text
Module
Artifact
Package
Package Registry
Package Manager
Installed Package
Dependency Lock
```

Estos conceptos no deberán utilizarse como sinónimos.

---

# 5. Module

Un `Module` constituye una unidad arquitectónica y funcional de MEF.

Ejemplo:

```text
MOD-CRM
```

Un Module podrá distribuirse dentro de un Package.

Sin embargo:

```text
Module ≠ Package
```

---

# 6. Artifact

Un `Artifact` constituye el resultado de un proceso de Build.

Ejemplo conceptual:

```text
compiled output
assembled source
generated resources
binary
bundle
```

Un Artifact podrá convertirse en Package.

```text
Artifact ≠ Package
```

---

# 7. Package

Un `Package` constituye una unidad distribuible y verificable.

Podrá contener:

```text
Manifest
Artifact
Modules
Contracts
Resources
Configuration Schemas
Migration Assets
Integrity Metadata
```

según el tipo de Package.

---

# 8. Package Manager

El `Package Manager` administra Packages.

Conceptualmente:

```text
Package Manager
   │
   ├── Discover
   ├── Resolve
   ├── Verify
   ├── Install
   ├── Update
   ├── Remove
   └── Lock
```

---

# 9. Package Registry

Un `Package Registry` constituye una fuente desde la cual pueden localizarse Packages y metadata.

Ejemplos conceptuales:

```text
Official Registry
Private Registry
Local Registry
Filesystem Registry
Mirror
```

No deberá confundirse con `ARQ-006 — Registry`.

---

# 10. Package Registry vs Runtime Registry

La diferencia será:

```text
Package Registry
     ↓
descubre unidades distribuibles

Runtime Registry
     ↓
registra componentes disponibles
durante ejecución
```

Ambos podrán utilizar el término Registry, pero pertenecen a responsabilidades distintas.

---

# 11. Package Identity

Todo Package deberá poseer una identidad estable.

Ejemplo conceptual:

```text
PKG-CRM
```

La identidad deberá permanecer separada de:

```text
MOD-CRM
BLD-...
CTR-...
```

---

# 12. Package Version

Todo Package distribuible deberá declarar una versión.

Ejemplo:

```text
PKG-CRM
version: 1.4.0
```

ENG-014 definirá las reglas de versionado.

---

# 13. Package Manifest

Todo Package deberá disponer de metadata suficiente para:

- identificarlo;
- conocer su versión;
- conocer dependencias;
- conocer compatibilidad;
- verificar contenido;
- determinar capacidades.

ENG-003 establecerá las reglas generales de Manifest.

---

# 14. Package Coordinates

Para localizar un Package podrá utilizarse una combinación conceptual:

```text
Package ID
+
Version
+
Registry
```

Ejemplo:

```text
PKG-CRM@1.4.0
```

La sintaxis física dependerá del Implementation Profile.

---

# 15. Package Types

MEF podrá reconocer diferentes clases de Package.

Ejemplos conceptuales:

```text
Framework Package
Module Package
Contract Package
Adapter Package
Tooling Package
Template Package
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 16. Package Contents

El contenido deberá estar gobernado.

Un Package no deberá incluir arbitrariamente:

- secretos;
- credenciales;
- archivos temporales;
- caches;
- archivos personales;
- outputs no requeridos.

---

# 17. Package Discovery

El Package Manager deberá poder descubrir Packages desde fuentes configuradas.

```text
Package Request
      ↓
Configured Registries
      ↓
Discovery
      ↓
Candidates
```

---

# 18. Registry Configuration

Los Registries deberán configurarse mediante ENG-011.

Podrán definirse:

- URL;
- prioridad;
- autenticación;
- trust policy;
- mirror;
- timeout.

Los Secrets deberán resolverse mediante mecanismos seguros.

---

# 19. Multiple Registries

Podrán existir múltiples Registries.

Ejemplo:

```text
Official
Private Organization
Local
```

La precedencia deberá ser explícita.

---

# 20. Registry Priority

No deberá depender del orden accidental de respuesta de la red.

La prioridad deberá estar configurada.

---

# 21. Registry Trust

No todos los Registries deberán considerarse igualmente confiables.

Podrán existir políticas como:

```text
trusted
restricted
untrusted
```

según Security.

---

# 22. Package Search

El Package Manager podrá proporcionar búsqueda.

Ejemplo conceptual:

```text
mef package search crm
```

La búsqueda no deberá instalar automáticamente resultados.

---

# 23. Package Info

Podrá existir:

```text
mef package info PKG-CRM
```

para consultar:

- versión;
- descripción;
- dependencias;
- compatibility;
- publisher;
- integrity metadata.

---

# 24. Dependency Declaration

Los Packages deberán declarar explícitamente sus dependencias.

Ejemplo conceptual:

```yaml
dependencies:
  PKG-IDENTITY: "^2.0"
  PKG-EVENTS: "^1.4"
```

La sintaxis exacta dependerá del Manifest Schema.

---

# 25. Dependency Graph

Las dependencias forman un grafo:

```text
PKG-CRM
   ├── PKG-IDENTITY
   │      └── PKG-CONTRACTS
   └── PKG-EVENTS
```

El Resolver deberá analizar el grafo completo.

---

# 26. Transitive Dependencies

Las dependencias transitivas deberán resolverse de forma explícita.

```text
A → B
B → C

A indirectly depends on C
```

El Package Manager deberá considerar esta relación durante resolución.

---

# 27. Direct vs Transitive

El estado instalado debería permitir distinguir:

```text
Direct Dependency
Transitive Dependency
```

Esto facilita mantenimiento y eliminación.

---

# 28. Dependency Resolver

El Resolver deberá determinar un conjunto compatible de versiones.

Entradas:

```text
Requested Packages
Declared Constraints
Available Versions
Compatibility Rules
Existing Lock
Platform Constraints
```

Salida:

```text
Resolution Plan
```

---

# 29. Resolution Plan

Antes de modificar el sistema, el Package Manager debería poder construir un plan.

Ejemplo:

```text
Install PKG-CRM 2.0.0
Install PKG-IDENTITY 3.1.0
Update PKG-CONTRACTS 1.4 → 2.0
Remove PKG-LEGACY 1.0
```

---

# 30. Plan Before Mutation

Las operaciones complejas deberán resolverse antes de comenzar a modificar el estado.

Preferible:

```text
Resolve
  ↓
Validate
  ↓
Plan
  ↓
Apply
```

frente a:

```text
Install
  ↓
discover conflict halfway
```

---

# 31. Version Constraints

El Resolver deberá comprender las restricciones definidas por ENG-014.

Ejemplos conceptuales:

```text
1.4.0
>=1.4
^2.0
compatible-with 3
```

La sintaxis concreta dependerá del Implementation Profile.

---

# 32. Conflict Detection

El Resolver deberá detectar conflictos.

Ejemplo:

```text
PKG-A requires PKG-C ^1

PKG-B requires PKG-C ^2
```

Si no existe una versión compatible:

```text
Resolution FAIL
```

No deberá elegirse arbitrariamente una versión.

---

# 33. Circular Dependencies

Los ciclos deberán detectarse.

Ejemplo:

```text
A → B
B → C
C → A
```

La política deberá respetar las reglas arquitectónicas de MEF.

---

# 34. Missing Dependency

Si una dependencia requerida no puede resolverse:

```text
Installation FAIL
```

No deberá instalarse parcialmente el Package como válido.

---

# 35. Optional Dependencies

MEF podrá permitir dependencias opcionales.

Estas deberán declararse explícitamente.

Su ausencia no deberá impedir instalación cuando el Contract así lo permita.

---

# 36. Peer Dependencies

Los Implementation Profiles podrán modelar relaciones equivalentes a Peer Dependencies cuando sean necesarias.

No deberán introducirse en el modelo universal sin necesidad.

---

# 37. Platform Constraints

Un Package podrá declarar requisitos sobre:

- MEF version;
- Runtime;
- Implementation Profile;
- capabilities;
- operating environment.

---

# 38. Compatibility Validation

Antes de instalar deberá verificarse:

```text
Package
   ↓
MEF Compatibility
   ↓
Runtime Compatibility
   ↓
Dependency Compatibility
   ↓
Contract Compatibility
```

---

# 39. Compatibility Failure

Una incompatibilidad obligatoria deberá detener la operación.

No deberá convertirse automáticamente en Warning.

---

# 40. Dependency Lock

El Package Manager deberá poder mantener una representación de las versiones efectivamente resueltas.

Conceptualmente:

```text
Dependency Lock
```

---

# 41. Manifest vs Lock

La diferencia será:

```text
Manifest
   ↓
declara restricciones

Lock
   ↓
registra resolución exacta
```

Ejemplo:

```text
Manifest:
PKG-IDENTITY ^2.0

Lock:
PKG-IDENTITY 2.4.3
```

---

# 42. Lockfile

Un Implementation Profile podrá materializar Dependency Lock mediante:

```text
mef.lock
```

u otro formato.

El nombre definitivo podrá formalizarse posteriormente.

---

# 43. Lock Reproducibility

El Lock deberá permitir reproducir el mismo conjunto de dependencias cuando las mismas versiones permanezcan disponibles.

---

# 44. Lock Integrity

El Lock podrá incluir:

```text
packageId
version
source
checksum
integrity
```

para fortalecer reproducibilidad.

---

# 45. Lock Update

El Lock solo deberá modificarse como resultado explícito de una operación que cambie resolución.

---

# 46. Install from Lock

Cuando exista Lock válido, una instalación reproducible deberá favorecer las versiones registradas en él.

---

# 47. Frozen Install

Podrá existir un modo:

```text
--frozen
```

o equivalente.

En este modo:

```text
Manifest and Lock mismatch
→ FAIL
```

Esto será especialmente útil en CI.

---

# 48. Package Download

El Package Manager podrá obtener Packages desde Registries remotos.

La descarga deberá considerar:

- timeout;
- integrity;
- authentication;
- redirects;
- trust.

---

# 49. Temporary Download

Los Packages descargados deberán almacenarse inicialmente en una ubicación temporal o cache controlada.

No deberán considerarse instalados hasta completar Verification.

---

# 50. Package Cache

Podrá existir una cache local.

La cache deberá:

- verificar integridad;
- identificar versión;
- poder invalidarse;
- no convertirse en Registry autoritativo.

---

# 51. Integrity Verification

Antes de instalar deberá verificarse la integridad cuando exista metadata suficiente.

Ejemplo:

```text
Downloaded Package
       ↓
Hash
       ↓
Expected Hash
       ↓
Match?
   ├── YES → continue
   └── NO  → reject
```

---

# 52. Signature Verification

Cuando un Package esté firmado, el Package Manager deberá poder verificar:

- firma;
- identidad del firmante;
- trust policy;
- vigencia cuando corresponda.

---

# 53. Invalid Signature

Una firma inválida deberá producir rechazo.

```text
Invalid signature
→ Installation denied
```

No deberá continuar mediante Warning silencioso.

---

# 54. Unsigned Packages

La política para Packages sin firma deberá ser explícita.

Por defecto, los contextos que requieran firma no deberán permitir:

```text
unsigned package
```

sin autorización gobernada.

---

# 55. Publisher Identity

El ecosistema podrá incorporar identidad de Publisher.

Ejemplo conceptual:

```text
Publisher
  ↓
Signing Identity
  ↓
Package
```

Esto facilitará Supply Chain Security.

---

# 56. Package Verification Pipeline

Conceptualmente:

```text
Package
  ↓
Identity
  ↓
Manifest
  ↓
Integrity
  ↓
Signature
  ↓
Compatibility
  ↓
Dependencies
  ↓
Policy
  ↓
Verified Package
```

---

# 57. Verification Before Execution

Código obtenido desde un Package no deberá ejecutarse antes de completar las verificaciones requeridas.

Esta regla es especialmente importante para:

- install scripts;
- hooks;
- migrations;
- plugins.

---

# 58. Install

La instalación deberá ser una operación controlada.

```text
Resolve
  ↓
Download
  ↓
Verify
  ↓
Stage
  ↓
Install
  ↓
Register
  ↓
Validate
  ↓
Commit
```

---

# 59. Installation Plan

Antes de aplicar cambios deberá existir un plan consistente.

Podrá mostrarse al usuario:

```text
2 packages will be installed
1 package will be updated
0 packages removed
```

---

# 60. Dry Run

Las operaciones de modificación deberían soportar:

```text
--dry-run
```

cuando sea técnicamente razonable.

---

# 61. Confirmation

Operaciones destructivas o de alto impacto podrán requerir confirmación interactiva.

En CI deberá existir un mecanismo explícito no interactivo.

---

# 62. Staging

El Package deberá prepararse en un área controlada antes de incorporarse al estado activo.

```text
Package
  ↓
Staging
  ↓
Validation
  ↓
Commit
```

---

# 63. Atomic Installation

Cuando sea razonablemente posible, la instalación deberá comportarse de forma atómica.

```text
Before
  ↓
Install Transaction
  ↓
Success → New State

Failure → Previous State
```

---

# 64. Partial Installation

Una instalación fallida no deberá dejar el sistema presentado como correctamente instalado.

---

# 65. Installation State

Podrán reconocerse estados conceptuales:

```text
Discovered
Resolved
Downloaded
Verified
Staged
Installed
Registered
Enabled
Failed
Removed
```

ENG-015 podrá formalizar las transiciones.

---

# 66. Installed Package Registry

El sistema deberá conocer qué Packages están instalados.

Podrá mantener metadata como:

```text
packageId
version
source
integrity
installTime
state
```

No deberá confundirse con el Package Registry remoto.

---

# 67. Registration

Después de instalación, los componentes contenidos podrán registrarse en los mecanismos correspondientes.

Ejemplo:

```text
Package Installed
      ↓
Manifest Discovery
      ↓
Module Registration
      ↓
Contract Registration
```

La instalación física y el Runtime Registration son fases distintas.

---

# 68. Install Scripts

Los install scripts deberán evitarse cuando una alternativa declarativa sea suficiente.

Cuando existan deberán:

- declararse;
- ejecutarse con permisos limitados;
- ser auditables;
- ejecutarse después de Verification.

---

# 69. Arbitrary Code Execution

La instalación de un Package no deberá implicar automáticamente ejecución arbitraria con permisos ilimitados.

---

# 70. Permissions

Los Packages que requieran capacidades sensibles deberían declararlas.

Ejemplos:

```text
filesystem.write
network.access
database.migration
process.execute
```

La taxonomía podrá definirse en una especificación posterior.

---

# 71. Permission Review

Las capacidades sensibles podrán requerir aprobación antes de instalación.

---

# 72. Update

Actualizar un Package será conceptualmente:

```text
Current Package
      ↓
Resolve Candidate
      ↓
Compatibility Check
      ↓
Verify
      ↓
Migration Plan
      ↓
Stage
      ↓
Apply
      ↓
Validate
      ↓
Commit
```

---

# 73. Update Scope

El usuario o sistema deberá poder determinar el alcance.

Ejemplos:

```text
update one package
update direct dependencies
update all compatible packages
```

---

# 74. Controlled Update

Un Update no deberá cambiar versiones fuera del alcance necesario sin mostrarlo en el Resolution Plan.

---

# 75. Update and Lock

Una actualización exitosa deberá actualizar el Dependency Lock de forma consistente.

---

# 76. Downgrade

Un Downgrade deberá considerarse una operación explícita.

No deberá asumirse que toda versión anterior es automáticamente compatible con datos o estado producido por una versión posterior.

---

# 77. Migration

Los Packages podrán requerir migraciones.

Estas deberán:

- estar declaradas;
- tener orden;
- poseer versión;
- ser verificables;
- considerar rollback.

---

# 78. Data Migration

Las migraciones de datos deberán recibir tratamiento especial porque el rollback del Package no implica necesariamente rollback de datos.

---

# 79. Migration Backup

Para operaciones destructivas podrá requerirse backup o snapshot previo.

La política dependerá de criticidad.

---

# 80. Rollback

El Package Manager debería soportar rollback cuando la operación y el Package lo permitan.

Conceptualmente:

```text
Version 1
   ↓
Update to Version 2
   ↓
Validation FAIL
   ↓
Rollback
   ↓
Version 1
```

---

# 81. Rollback Limitations

Rollback no deberá prometerse cuando no pueda garantizarse.

Ejemplos:

- irreversible data migration;
- external side effects;
- removed external resource.

Estas limitaciones deberán declararse.

---

# 82. Rollback Plan

Antes de una operación crítica debería conocerse la estrategia de recuperación.

---

# 83. Automatic Rollback

Podrá utilizarse cuando:

- el estado anterior sea conocido;
- la operación sea reversible;
- la validación falle;
- la política lo permita.

---

# 84. Manual Recovery

Cuando rollback automático no sea posible, el Package Manager deberá proporcionar diagnóstico y estado suficiente para recuperación manual.

---

# 85. Remove

Eliminar un Package requiere analizar dependencias inversas.

Ejemplo:

```text
PKG-A
  ↓ depends on
PKG-B
```

Intentar eliminar `PKG-B` deberá detectar que `PKG-A` lo necesita.

---

# 86. Reverse Dependencies

El Package Manager deberá poder determinar:

```text
Who depends on this Package?
```

antes de Removal.

---

# 87. Safe Removal

Un Package requerido por otro Package activo no deberá eliminarse silenciosamente.

---

# 88. Forced Removal

Podrá existir una operación forzada para escenarios administrativos.

Deberá:

- ser explícita;
- advertir consecuencias;
- quedar registrada;
- no presentarse como operación segura.

---

# 89. Orphan Dependencies

Después de Removal podrán quedar dependencias transitivas que ya no sean necesarias.

El Package Manager podrá detectarlas.

---

# 90. Automatic Orphan Removal

La eliminación automática de orphans deberá ser conservadora.

No deberá eliminar un Package que sea dependencia directa o esté marcado para conservarse.

---

# 91. Package State Database

El estado instalado deberá persistirse de manera confiable.

Podrá contener:

```text
Package ID
Version
Source
Integrity
Dependencies
Installation State
```

La representación concreta dependerá del perfil.

---

# 92. State vs Lock

El `Installed State` y el `Dependency Lock` no son necesariamente lo mismo.

```text
Lock
→ estado deseado reproducible

Installed State
→ estado realmente presente
```

Idealmente deberán coincidir después de una operación exitosa.

---

# 93. Drift Detection

El Package Manager debería detectar diferencias entre:

```text
Manifest
Lock
Installed State
```

Ejemplo:

```text
Manifest says A
Lock says B
Installed says C
```

Esto deberá producir diagnóstico.

---

# 94. Repair

Podrá existir:

```text
mef package repair
```

para restaurar el estado esperado a partir del Lock y Packages verificables.

---

# 95. Verify Installed Packages

Podrá existir:

```text
mef package verify
```

para comprobar:

- archivos;
- hashes;
- versiones;
- Manifest;
- state;
- compatibility.

---

# 96. Package List

Podrá existir:

```text
mef package list
```

con información sobre Packages instalados.

---

# 97. Package Outdated

Podrá existir:

```text
mef package outdated
```

para informar versiones nuevas compatibles.

No deberá actualizar automáticamente.

---

# 98. Package Install

Interfaz conceptual:

```text
mef package install PKG-CRM
```

Podrá aceptar una restricción:

```text
mef package install PKG-CRM@^2
```

La sintaxis definitiva dependerá de ENG-007.

---

# 99. Package Update

Conceptualmente:

```text
mef package update PKG-CRM
```

---

# 100. Package Remove

Conceptualmente:

```text
mef package remove PKG-CRM
```

---

# 101. Package Lock

Podrá existir:

```text
mef package lock
```

o generarse automáticamente durante resolución.

La CLI definitiva deberá evitar comandos redundantes.

---

# 102. Package Why

Una capacidad especialmente útil será:

```text
mef package why PKG-CONTRACTS
```

que explique:

```text
PKG-CONTRACTS installed because:
PKG-CRM → PKG-IDENTITY → PKG-CONTRACTS
```

---

# 103. Package Why Not

También podrá existir conceptualmente:

```text
mef package why-not PKG-IDENTITY@3
```

para explicar conflictos de resolución.

---

# 104. Diagnostic Resolution

Los errores del Resolver deberán explicar:

- Package solicitado;
- constraint;
- dependencia causante;
- versiones disponibles;
- conflicto.

Evitar:

```text
Could not resolve dependencies.
```

sin contexto adicional.

---

# 105. Error Codes

Podrá existir una taxonomía:

```text
MEF-PKG-001 Package not found
MEF-PKG-002 Dependency conflict
MEF-PKG-003 Integrity failure
MEF-PKG-004 Signature failure
MEF-PKG-005 Compatibility failure
MEF-PKG-006 Installation failure
MEF-PKG-007 Rollback failure
MEF-PKG-008 Lock mismatch
MEF-PKG-009 Registry unavailable
MEF-PKG-010 Permission denied
```

La numeración definitiva podrá formalizarse posteriormente.

---

# 106. Logging

ENG-010 podrá registrar eventos técnicos como:

```text
package.resolution.started
package.download.completed
package.verification.failed
package.installation.completed
package.rollback.completed
```

Los Logs no deberán contener credenciales de Registry.

---

# 107. Audit

Operaciones administrativas relevantes podrán producir Audit Records.

Ejemplos:

```text
Package installed
Package removed
Trust policy changed
Unsigned package override
```

Audit permanece separado de Logging.

---

# 108. Testing

ENG-009 deberá verificar al menos:

- dependency resolution;
- conflicts;
- circular dependencies;
- lock reproducibility;
- integrity failure;
- invalid signature;
- installation rollback;
- reverse dependencies;
- removal;
- drift detection.

---

# 109. Contract Tests

Los diferentes Registry Adapters podrán compartir una Contract Test Suite.

Ejemplo:

```text
Registry Contract
   ├── HTTP Registry
   ├── Filesystem Registry
   └── Private Registry
```

---

# 110. Resolver Tests

El Dependency Resolver deberá disponer de una suite extensa.

Casos mínimos:

```text
single dependency
transitive dependency
compatible ranges
incompatible ranges
missing dependency
cycle
locked dependency
platform conflict
```

---

# 111. Security Tests

Deberán probarse al menos:

```text
tampered package rejected
invalid signature rejected
unauthorized registry rejected
secret not logged
unverified install script not executed
```

---

# 112. Failure Injection

Podrán simularse fallos en:

```text
download
verification
filesystem
migration
registration
rollback
```

para verificar consistencia.

---

# 113. Package Manager Architecture

La arquitectura conceptual recomendada será:

```text
Package Manager
      │
      ├── Registry Client
      ├── Dependency Resolver
      ├── Compatibility Validator
      ├── Integrity Verifier
      ├── Package Installer
      ├── Migration Runner
      ├── State Manager
      ├── Lock Manager
      └── Rollback Manager
```

---

# 114. Registry Adapter

Los diferentes tipos de Registry deberán implementarse detrás de un Contract.

```text
PackageRegistry
      │
      ├── RemoteRegistryAdapter
      ├── LocalRegistryAdapter
      └── FilesystemRegistryAdapter
```

---

# 115. Resolver Separation

El Dependency Resolver no deberá descargar o instalar Packages.

Su responsabilidad será producir una resolución.

```text
Resolver
→ decides

Installer
→ applies
```

---

# 116. Installer Separation

El Installer no deberá decidir arbitrariamente qué versión utilizar.

Deberá recibir un Resolution Plan previamente validado.

---

# 117. Verifier Separation

El Verifier deberá poder comprobar Packages independientemente de Installation.

Esto permitirá:

```text
mef package verify file
```

sin instalarlo.

---

# 118. State Manager

El State Manager deberá mantener conocimiento del estado instalado.

No deberá depender únicamente de inspeccionar directorios.

---

# 119. Lock Manager

El Lock Manager será responsable de:

- leer;
- validar;
- comparar;
- actualizar;

Dependency Lock.

---

# 120. Transaction Coordinator

Para operaciones complejas podrá existir un coordinador transaccional.

```text
Plan
 ↓
Stage
 ↓
Apply
 ↓
Validate
 ↓
Commit
```

Si falla:

```text
Rollback
```

cuando sea posible.

---

# 121. Concurrency

Dos procesos no deberían modificar simultáneamente el estado de Packages sin coordinación.

---

# 122. Package Manager Lock

Podrá utilizarse un lock operacional temporal:

```text
package-manager.lock
```

o mecanismo equivalente.

Este concepto no deberá confundirse con Dependency Lock.

---

# 123. Concurrent Read

Las operaciones de lectura podrán permitirse durante otras lecturas.

Las operaciones mutables deberán coordinarse.

---

# 124. Crash Recovery

Si el proceso termina durante Installation deberá poder detectarse estado incompleto.

Ejemplo:

```text
Staging exists
Transaction incomplete
```

El siguiente inicio podrá:

```text
resume
rollback
repair
```

según política.

---

# 125. Transaction Journal

Las implementaciones avanzadas podrán mantener un journal temporal para recuperación.

---

# 126. Idempotency

Las operaciones deberían ser idempotentes cuando sea razonable.

Ejemplo:

```text
install already installed exact package
```

no debería corromper el estado.

---

# 127. Reinstall

Una reinstalación deberá ser explícita.

Ejemplo:

```text
--reinstall
```

cuando exista esa capacidad.

---

# 128. Package Files Ownership

El sistema debería conocer qué archivos pertenecen a cada Package cuando la plataforma lo permita.

Esto facilita:

- verification;
- removal;
- repair.

---

# 129. Shared Files

Los Packages no deberían modificar arbitrariamente archivos pertenecientes a otros Packages.

---

# 130. Package Isolation

Cuando sea posible, cada Package debería poseer un espacio identificable.

Ejemplo conceptual:

```text
packages/
└── PKG-CRM/
```

La estructura concreta dependerá del Implementation Profile.

---

# 131. Global Packages

La instalación global deberá evitarse como requisito universal.

Los proyectos deberían poder mantener dependencias aisladas.

---

# 132. Project Scope

La primera implementación debería favorecer:

```text
Project-scoped Packages
```

frente a dependencias globales implícitas.

---

# 133. Registry Authentication

Registries privados podrán requerir autenticación.

Las credenciales deberán utilizar Secret Providers o mecanismos equivalentes.

---

# 134. Registry Credentials

No deberán escribirse en:

```text
Manifest
Lockfile
Build Report
Logs
```

en texto claro.

---

# 135. Registry TLS

Las comunicaciones remotas deberán utilizar transporte seguro cuando corresponda.

---

# 136. Registry Metadata Trust

Metadata obtenida del Registry no deberá asumirse válida únicamente porque el servidor respondió correctamente.

Deberán aplicarse validaciones.

---

# 137. Package Name Confusion

El sistema deberá protegerse, cuando sea razonable, contra:

- dependency confusion;
- namespace confusion;
- typosquatting.

---

# 138. Namespace Ownership

Los namespaces de Packages podrán asociarse a Publishers u Organizations.

Ejemplo conceptual:

```text
org.example.crm
```

si posteriormente se adopta una nomenclatura jerárquica.

---

# 139. Private Package Precedence

Un Package privado no deberá ser sustituido silenciosamente por uno público con nombre equivalente debido a prioridad incorrecta.

---

# 140. Trust Policy

La política podrá considerar:

```text
Registry
Publisher
Signature
Package Type
Environment
```

antes de permitir instalación.

---

# 141. Production Policy

Producción podrá exigir reglas más estrictas:

```text
Lock required
Signatures required
Trusted registry only
No arbitrary install scripts
Frozen dependencies
```

---

# 142. Development Policy

Development podrá ser más flexible.

Sin embargo, deberá seguir protegiendo:

- Secrets;
- integridad;
- límites arquitectónicos.

---

# 143. CI Policy

CI debería favorecer:

```text
frozen lock
non-interactive
verified dependencies
deterministic resolution
```

---

# 144. Offline Installation

El Package Manager podrá instalar desde Packages locales previamente verificados.

Esto será útil para:

- entornos aislados;
- reproducibilidad;
- disaster recovery.

---

# 145. Mirror

Podrán configurarse mirrors.

La política deberá preservar:

- identidad;
- integrity;
- trust.

---

# 146. Registry Failure

Si un Registry falla, el sistema deberá aplicar una política explícita.

Ejemplos:

```text
fail
try mirror
use verified cache
```

No deberá instalar contenido no verificado para continuar.

---

# 147. Package Availability

El Lock no garantiza por sí solo que el Package continúe disponible.

Para Releases críticos podrán conservarse:

- artifact repository;
- mirror;
- immutable package store.

---

# 148. Immutable Package Versions

Una versión publicada debería ser inmutable.

```text
PKG-CRM 1.4.0
```

no debería cambiar de contenido posteriormente.

Si cambia el contenido deberá publicarse una nueva versión.

---

# 149. Integrity and Immutability

El hash permite detectar que:

```text
same version
≠
same content
```

si un Registry fue alterado.

---

# 150. Package Deprecation

Un Package o versión podrá marcarse como deprecated.

La instalación podrá producir Warning.

No deberá eliminarse automáticamente.

---

# 151. Package Withdrawal

Una versión podrá retirarse por razones críticas.

La política deberá distinguir:

```text
deprecated
withdrawn
blocked
```

---

# 152. Blocked Package

Security podrá impedir instalación de una versión conocida como insegura.

Esto deberá producir un error explicable.

---

# 153. Vulnerability Metadata

El ecosistema podrá asociar vulnerabilidades conocidas con Package Versions.

---

# 154. Package Audit Command

Podrá existir:

```text
mef package audit
```

para analizar dependencias instaladas contra políticas o metadata de seguridad.

---

# 155. SBOM Integration

ENG-012 podrá generar SBOM utilizando el grafo resuelto por Package Manager.

```text
Dependency Graph
       ↓
SBOM
```

---

# 156. License Metadata

Los Packages podrán declarar metadata de licencia.

Tooling podrá utilizarla durante Build o Release.

---

# 157. Package Documentation

Los Packages deberían proporcionar metadata suficiente para que tooling pueda mostrar:

- descripción;
- versión;
- publisher;
- license;
- dependencies;
- compatibility;
- documentation reference.

---

# 158. Package Lifecycle

El ciclo conceptual será:

```text
Published
   ↓
Discovered
   ↓
Resolved
   ↓
Downloaded
   ↓
Verified
   ↓
Staged
   ↓
Installed
   ↓
Registered
   ↓
Enabled
   ↓
Updated / Disabled
   ↓
Removed
```

No todos los estados pertenecen exclusivamente al Package Manager.

---

# 159. Package vs Module Lifecycle

Debe mantenerse la separación:

```text
Package Lifecycle
→ distribución e instalación

Module Lifecycle
→ participación arquitectónica y Runtime
```

Instalar un Package no significa necesariamente activar inmediatamente todos sus Modules.

---

# 160. Package Activation

La activación deberá delegarse al mecanismo correspondiente de Runtime.

El Package Manager podrá solicitarla, pero no deberá redefinir el Module Lifecycle.

---

# 161. Package Removal and Runtime

Antes de Removal podrá ser necesario:

```text
Disable Module
Unregister Components
Stop Runtime Resources
```

según ARQ-014 y ENG-015.

---

# 162. Hot Installation

MEF podrá permitir instalación durante Runtime en perfiles que lo soporten.

No será un requisito universal.

---

# 163. Restart Required

Un Package podrá declarar o determinar:

```text
restartRequired: true
```

después de Installation o Update.

---

# 164. Hot Update

La actualización en caliente deberá considerarse una capacidad avanzada.

No deberá asumirse segura universalmente.

---

# 165. Package Manager Events

El Package Manager podrá publicar Events técnicos o de Lifecycle.

Ejemplos conceptuales:

```text
PackageInstalling
PackageInstalled
PackageUpdating
PackageUpdated
PackageRemoving
PackageRemoved
```

La taxonomía formal deberá definirse en el sistema de Events correspondiente.

---

# 166. Event Failure

Los listeners no deberán poder dejar silenciosamente el Package Manager en estado inconsistente.

Las fases transaccionales deberán definir qué Events ocurren antes o después de Commit.

---

# 167. Pre-Operation Hooks

Los hooks previos podrán:

- validar;
- rechazar;
- preparar.

No deberán ejecutar modificaciones arbitrarias fuera del modelo gobernado.

---

# 168. Post-Operation Hooks

Los hooks posteriores deberán asumir que la operación ya fue confirmada cuando se ejecuten después de Commit.

---

# 169. Package Manager Configuration

ENG-011 podrá definir:

```text
registries
cache
timeouts
trustPolicy
signaturePolicy
installPath
```

según Implementation Profile.

---

# 170. Package Manager Logging

ENG-010 deberá permitir correlacionar una operación completa mediante:

```text
operationId
```

Ejemplo:

```text
packageOperationId
```

---

# 171. Operation ID

Todas las fases de una operación compleja deberían compartir el mismo identificador.

```text
Resolve
Download
Verify
Install
Register
```

---

# 172. Diagnostics

Ante fallo, el sistema deberá proporcionar:

```text
operation
package
version
stage
errorCode
cause
recovery guidance
```

sin exponer Secrets.

---

# 173. Exit Codes

La CLI deberá producir códigos adecuados para automatización.

---

# 174. Machine Output

Los comandos deberían soportar salida estructurada cuando ENG-007 así lo permita.

Ejemplo:

```text
--format=json
```

---

# 175. Non-Interactive Mode

CI deberá poder ejecutar Package Manager sin prompts interactivos.

Las decisiones sensibles deberán resolverse mediante políticas explícitas.

---

# 176. No Hidden Consent

La ausencia de interacción no deberá interpretarse automáticamente como autorización para acciones destructivas.

---

# 177. Dry Run Output

Un `--dry-run` deberá mostrar el Resolution Plan sin modificar:

```text
Installed State
Lock
Filesystem
Runtime
```

---

# 178. Lock Consistency

Después de una operación exitosa:

```text
Manifest
Lock
Installed State
```

deberán permanecer coherentes.

---

# 179. Failure Consistency

Después de una operación fallida, el sistema deberá quedar:

```text
previous valid state
```

o:

```text
explicit recoverable failed state
```

Nunca en un estado ambiguo presentado como válido.

---

# 180. Package Manager as Infrastructure

El Package Manager pertenece a la infraestructura técnica de MEF.

La lógica de negocio no deberá depender directamente de operaciones de instalación.

---

# 181. No Runtime Dependency Resolution in Domain

El Domain no deberá ejecutar:

```text
install package
resolve dependency
update package
```

como parte de lógica funcional ordinaria.

---

# 182. Administrative Boundary

Las operaciones del Package Manager pertenecen a una superficie administrativa o de tooling.

---

# 183. Extensibility

El Package Manager podrá extenderse mediante:

- Registry Adapters;
- Verifiers;
- Package Types;
- Policies.

Las extensiones deberán respetar Contracts.

---

# 184. Custom Resolver

Sustituir el algoritmo de resolución podrá permitirse únicamente mediante un Contract formal.

No deberá permitirse que un Package cambie arbitrariamente las reglas globales de resolución.

---

# 185. Custom Registry

Un nuevo Registry deberá implementar el Package Registry Contract.

---

# 186. Custom Verification

Podrán añadirse verificadores.

Ejemplos:

```text
SignatureVerifier
LicenseVerifier
PolicyVerifier
MalwareScanner
```

según capacidades futuras.

---

# 187. Policy Engine

Una implementación avanzada podrá incorporar:

```text
Package Policy Engine
```

para decidir si un Package puede instalarse.

Entradas:

```text
identity
publisher
registry
signature
permissions
vulnerabilities
environment
```

---

# 188. Policy Decision

Conceptualmente:

```text
ALLOW
DENY
REQUIRE_APPROVAL
```

La gobernanza específica podrá definirse posteriormente.

---

# 189. Compliance

El Package Manager deberá generar evidencia suficiente para verificar operaciones relevantes.

Podrá relacionar:

```text
Package
Version
Source
Integrity
Resolution
Policy
Operation
Result
```

---

# 190. Build Integration

ENG-012 podrá utilizar Package Manager para restaurar dependencias antes del Build.

```text
Lock
 ↓
Package Manager
 ↓
Verified Dependencies
 ↓
Build
```

---

# 191. Release Integration

ENG-017 utilizará Packages ya construidos y verificados.

El Package Manager no deberá decidir por sí mismo si una versión puede convertirse en Release oficial.

---

# 192. Versioning Integration

ENG-014 define:

- versión;
- compatibility;
- constraints;
- pre-release semantics.

Package Manager consume esas reglas.

---

# 193. Architectural State Machine Integration

ENG-015 podrá formalizar estados como:

```text
Package.Discovered
Package.Resolved
Package.Verified
Package.Installed
Package.Failed
```

y sus transiciones válidas.

---

# 194. Invariantes de Ingeniería

ENG-013 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-206 | Package, Module, Artifact y Package Manager deberán mantenerse como conceptos distintos. |
| EI-207 | Las dependencias requeridas deberán declararse explícitamente. |
| EI-208 | La resolución de dependencias deberá completarse antes de modificar el estado instalado cuando sea razonablemente posible. |
| EI-209 | Los conflictos de dependencias no deberán resolverse mediante selección arbitraria de versiones incompatibles. |
| EI-210 | El Dependency Lock deberá representar versiones efectivamente resueltas y reproducibles. |
| EI-211 | Un Package deberá verificarse antes de ejecutar código contenido en él. |
| EI-212 | Los fallos de integridad o firma obligatoria deberán impedir Installation. |
| EI-213 | Una instalación fallida no deberá presentarse como Installation exitosa. |
| EI-214 | Los Packages requeridos por dependencias activas no deberán eliminarse silenciosamente. |
| EI-215 | Los Secrets de Registry no deberán persistirse en Manifest, Lock, Logs o reportes en texto claro. |
| EI-216 | Las operaciones críticas deberán mantener un estado consistente o explícitamente recuperable ante fallo. |
| EI-217 | El Package Manager deberá distinguir entre estado deseado, Dependency Lock y estado realmente instalado. |
| EI-218 | Las versiones publicadas de Packages deberán tratarse como inmutables. |
| EI-219 | El Package Manager no deberá depender universalmente de Composer, npm, Maven, NuGet u otro gestor específico. |
| EI-220 | Los Registry Adapters deberán respetar un Contract común cuando existan múltiples implementaciones. |
| EI-221 | Los Updates deberán mostrar o producir un Resolution Plan antes de modificar dependencias fuera del Package solicitado. |
| EI-222 | El Rollback no deberá declararse garantizado cuando existan operaciones irreversibles. |
| EI-223 | El Package Manager deberá detectar drift relevante entre Manifest, Lock e Installed State. |
| EI-224 | Los Quality y Security Policies no deberán omitirse silenciosamente durante Installation o Update. |
| EI-225 | Las operaciones del Package Manager deberán permanecer fuera de la lógica de negocio ordinaria. |

---

# 195. Criterios de Conformidad

Una implementación será conforme con ENG-013 cuando:

- distinga Package, Module y Artifact;
- disponga de Package Registry abstraction;
- resuelva dependencias;
- detecte conflictos;
- mantenga Dependency Lock;
- verifique integridad;
- valide firmas cuando sean requeridas;
- instale de forma controlada;
- gestione Updates;
- proteja Removal;
- mantenga Installed State;
- detecte drift;
- proteja Secrets;
- soporte diagnóstico;
- permita automatización;
- respete Versioning;
- se integre con Build y Runtime sin sustituirlos.

---

# 196. Riesgos

Deberán evitarse especialmente:

## Dependency Hell

Resolver Packages sin modelo formal de constraints.

## Dependency Confusion

Instalar un Package público en lugar del Package privado esperado.

## Mutable Package

Permitir que una versión publicada cambie de contenido.

## Install Before Verify

Ejecutar código antes de verificar Package.

## Partial Installation

Dejar el sistema en estado ambiguo después de fallo.

## Lock Drift

Permitir divergencia silenciosa entre Manifest, Lock e Installed State.

## Unsafe Scripts

Ejecutar install scripts con privilegios ilimitados.

## Secret Leakage

Exponer credenciales de Registry.

## Blind Update

Actualizar múltiples Packages sin explicar el Resolution Plan.

## Fake Rollback

Prometer reversión cuando existen cambios irreversibles.

## Package Manager as Runtime

Mezclar instalación de software con lógica funcional ordinaria.

## Vendor Lock-in

Convertir Composer, npm, Maven o NuGet en arquitectura universal de MEF.

---

# 197. Arquitectura Recomendada

La primera implementación debería aproximarse a:

```text
                    Package Manager
                           │
          ┌────────────────┼────────────────┐
          │                │                │
          ▼                ▼                ▼
   Registry Client   Dependency Resolver   Policy
          │                │                │
          └────────────┬───┴────────────────┘
                       ▼
                Resolution Plan
                       │
                       ▼
                  Downloader
                       │
                       ▼
                    Verifier
                       │
                       ▼
                    Staging
                       │
                       ▼
                   Installer
                       │
             ┌─────────┼─────────┐
             ▼         ▼         ▼
          State      Lock     Migration
          Manager   Manager    Runner
             │
             └─────────┬─────────┘
                       ▼
                    Commit
                       │
                       ▼
                Installed Package
```

---

# 198. Primera Superficie CLI Recomendada

La primera implementación debería contemplar:

```text
mef package search
mef package info
mef package install
mef package update
mef package remove
mef package list
mef package verify
mef package outdated
mef package why
```

Posteriormente:

```text
mef package why-not
mef package audit
mef package repair
```

---

# 199. Primera Estrategia de Seguridad

La primera versión debería exigir como mínimo:

```text
Manifest validation
Dependency validation
Integrity verification
Registry trust configuration
Secret protection
No execution before verification
Controlled installation
```

La firma criptográfica podrá incorporarse gradualmente, pero la arquitectura deberá estar preparada desde el inicio.

---

# 200. Principio Rector

> **El Package Manager de MEF deberá administrar Packages mediante resolución determinista, verificación previa, instalación controlada y estado reproducible, preservando integridad, compatibilidad y trazabilidad sin confundirse con Build, Runtime o lógica de negocio.**

---

# 201. Conclusión

**ENG-013 — Package Manager** establece el mecanismo mediante el cual MEF transforma Packages disponibles en dependencias instaladas y verificadas.

La cadena completa será:

```text
Package Request
      ↓
Discovery
      ↓
Resolution
      ↓
Compatibility
      ↓
Resolution Plan
      ↓
Download
      ↓
Verification
      ↓
Staging
      ↓
Installation
      ↓
Registration
      ↓
Validation
      ↓
Commit
      ↓
Installed State
```

Y ante modificación:

```text
Current State
      ↓
Update Plan
      ↓
Verify
      ↓
Apply
      ↓
Validate
   ┌──┴──┐
 PASS   FAIL
  ↓       ↓
Commit  Rollback
```

Con ello MEF evita que la instalación de dependencias sea una operación opaca.

Cada Package podrá responder:

```text
qué es,
qué versión tiene,
de dónde provino,
qué necesita,
por qué fue instalado,
qué integridad posee,
qué otros Packages dependen de él,
y qué estado tiene actualmente.
```

Esto convierte Package Management en una parte gobernada de la arquitectura y de la Software Supply Chain de MEF.

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
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-017 — Release Process