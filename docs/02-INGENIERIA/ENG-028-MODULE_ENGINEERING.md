---
id: ENG-028
titulo: Module Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Runtime Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-002
  - ENG-003
  - ENG-005
  - ENG-006
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-024
  - ENG-027
  - ARQ-004
  - ARQ-011
  - ARQ-014
relacionados:
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-013
  - ENG-022
  - ENG-023
  - ENG-025
  - ENG-026
  - ENG-029
keywords:
  - module
  - modularity
  - manifest
  - module-context
  - lifecycle
  - dependencies
  - contracts
  - capabilities
  - isolation
  - discovery
  - activation
  - runtime
  - mef
---

# ENG-028

# Module Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación de Ingeniería de un **Module** dentro de **MEF (Modular Enterprise Framework)**.

ENG-028 deberá establecer:

```text
qué es un Module
cómo se identifica
cómo se declara
cómo se descubre
qué puede requerir
qué puede proporcionar
qué Contracts publica
qué Capabilities solicita
cómo recibe Context
cómo participa en Lifecycle
cómo se valida
cómo se activa
cómo se desactiva
qué puede exponer
qué debe mantener privado
```

La arquitectura fundamental será:

```text
                    MODULE
                       │
         ┌─────────────┼─────────────┐
         ▼             ▼             ▼
      Identity      Manifest      Lifecycle
         │             │             │
         ▼             ▼             ▼
   Dependencies    Contracts     ModuleContext
         │             │             │
         └─────────────┼─────────────┘
                       ▼
                    Runtime
```

---

# 2. Declaración

La regla fundamental será:

> **Un Module es una unidad arquitectónica identificable, versionada y gobernada que encapsula una responsabilidad coherente, declara explícitamente sus dependencias y capacidades, publica únicamente Contracts autorizados y participa en Runtime mediante un Lifecycle definido.**

Por tanto:

```text
Module
=
Identity
+
Boundary
+
Contracts
+
Dependencies
+
Lifecycle
```

y no simplemente:

```text
folder
class
package
namespace
```

---

# 3. Module

Un Module representa una frontera arquitectónica.

Deberá agrupar elementos relacionados por una responsabilidad coherente.

Ejemplos conceptuales:

```text
MOD-IDENTITY
MOD-CUSTOMER
MOD-ORDERS
MOD-PAYMENTS
MOD-AUDIT
```

---

# 4. Module ≠ Package

Deberá conservarse:

```text
Module
≠
Package
```

---

# 5. Package

Un Package es principalmente una unidad de:

```text
distribution
installation
versioning
artifact management
```

---

# 6. Module

Un Module es principalmente una unidad de:

```text
architecture
responsibility
contracts
lifecycle
runtime composition
```

---

# 7. Package-to-Module Relationship

Podrán existir relaciones:

```text
Package
└── Module
```

o:

```text
Package
├── Module A
├── Module B
└── Resources
```

---

# 8. Module Does Not Require Dedicated Package

Un Module podrá existir dentro de un Package compartido cuando Architecture lo permita.

---

# 9. Module Identity

Todo Module deberá poseer identidad canónica estable.

El prefijo será:

```text
MOD
```

Ejemplos:

```text
MOD-IDENTITY
MOD-CUSTOMER
MOD-PAYMENTS
```

---

# 10. Module ID vs Version

Deberán mantenerse separados:

```text
id:
MOD-CUSTOMER

version:
2.3.0
```

---

# 11. Stable Identity

Una nueva versión compatible del mismo Module deberá conservar ID.

---

# 12. New Module Identity

Deberá asignarse nuevo ID cuando represente una responsabilidad arquitectónica diferente.

---

# 13. Module Name

El nombre descriptivo podrá cambiar sin modificar necesariamente su identidad.

---

# 14. Module Version

ENG-014 será autoridad sobre Versioning.

---

# 15. Module Compatibility

ENG-016 gobernará Compatibility entre:

```text
Module
Runtime
Contracts
Dependencies
Implementation Profile
```

---

# 16. Module Owner

Todo Module deberá tener Ownership arquitectónico identificable.

---

# 17. Ownership Responsibilities

El Owner deberá responder por:

```text
boundary
contracts
manifest
evolution
compatibility
deprecation
security assumptions
```

---

# 18. Module Boundary

Un Module deberá encapsular:

```text
implementation
internal services
private data
internal events
configuration internals
```

salvo elementos explícitamente publicados.

---

# 19. Public Surface

La superficie pública deberá limitarse a elementos gobernados.

Principalmente:

```text
Contracts
Public Events
Extension Points
Capabilities
Public Metadata
```

---

# 20. Internal Surface

No deberá consumirse externamente de forma arbitraria.

---

# 21. Module Internals

Podrán incluir:

```text
Domain
Application
Infrastructure
Adapters
Internal Services
Internal Events
Internal DTOs
```

según Implementation Profile.

---

# 22. No Cross-Module Internal Access

Un Module no deberá depender directamente de clases internas de otro Module.

---

# 23. Valid Cross-Module Interaction

Deberá ocurrir mediante:

```text
Contract
Event
Extension Point
Capability
```

cuando corresponda.

---

# 24. Example

Válido:

```text
MOD-CRM
   │
   ▼
CT-IDENTITY-001
   ▲
   │
MOD-IDENTITY
```

No válido:

```text
MOD-CRM
   ↓
IdentityInternalRepository
```

---

# 25. Module Responsibility

Cada Module debería poseer responsabilidad suficientemente cohesionada.

---

# 26. God Module

Deberá evitarse:

```text
MOD-CORE-BUSINESS
├── Customers
├── Orders
├── Payments
├── Inventory
├── Audit
└── Notifications
```

si las responsabilidades justifican fronteras independientes.

---

# 27. Micro-Module Explosion

Tampoco deberá dividirse cada clase en un Module.

---

# 28. Module Granularity

Deberá determinarse por:

```text
responsibility
ownership
change boundaries
contracts
deployment/distribution needs
lifecycle
security
```

---

# 29. Module Manifest

Todo Module deberá disponer de metadata suficiente para Runtime.

---

# 30. Manifest Authority

ENG-003 continuará siendo autoridad sobre el formato general de Manifest.

ENG-028 define la semántica específica de los campos de Module.

---

# 31. Recommended Module Manifest

Conceptualmente:

```yaml
id: MOD-CUSTOMER
type: module
version: 2.1.0

entrypoint:
  ...

requires:
  modules:
    ...
  contracts:
    ...

provides:
  contracts:
    ...

capabilities:
  required:
    ...
  provided:
    ...

security:
  ...

lifecycle:
  ...

metadata:
  ...
```

---

# 32. One Manifest Model

MEF deberá favorecer un Manifest Schema común extensible.

No deberá crear formatos completamente independientes por cada tipo de Artifact sin necesidad.

---

# 33. Module Manifest Type

Deberá declarar:

```text
type: module
```

o mecanismo equivalente.

---

# 34. Entrypoint

El Module deberá disponer de una forma gobernada de localizar su punto de integración Runtime.

---

# 35. Entrypoint ≠ Business Service

El Entrypoint no deberá convertirse en objeto que implemente toda la lógica del Module.

---

# 36. Entrypoint Responsibility

Deberá limitarse principalmente a integración con Runtime.

---

# 37. Conceptual Entrypoint

Ejemplo:

```text
CustomerModule
```

---

# 38. Module Contract

Podrá existir una interfaz conceptual:

```text
ModuleInterface
```

---

# 39. Minimal Module Contract

Conceptualmente podrá incluir:

```text
initialize(ModuleContext)
activate(ModuleContext)
deactivate(ModuleContext)
```

La forma exacta dependerá del Implementation Profile.

---

# 40. Lifecycle Authority

ENG-015 define estados/transiciones.

ENG-027 coordina Runtime.

ENG-028 define cómo participa el Module.

---

# 41. Module Lifecycle

La semántica conceptual será:

```text
Discovered
   ↓
Validated
   ↓
Initialized
   ↓
Active
   ↓
Stopping
   ↓
Stopped
```

sin redefinir la State Machine normativa de ENG-015.

---

# 42. Discovery

Discovery identifica que el Module existe.

---

# 43. Validation

Validation determina si el Module puede participar válidamente en Runtime.

---

# 44. Initialization

Initialization prepara el Module.

---

# 45. Activation

Activation habilita su capacidad operacional.

---

# 46. Deactivation

Deactivation detiene su capacidad operacional.

---

# 47. Discovery Does Not Execute Business Logic

Descubrir un Module no deberá iniciar procesos de negocio.

---

# 48. Manifest Before Execution

Cuando sea técnicamente posible, Runtime deberá validar Manifest antes de ejecutar código del Module.

---

# 49. Module Discovery Sources

Podrán incluir:

```text
installed packages
explicit runtime configuration
generated registry metadata
approved discovery roots
```

---

# 50. No Arbitrary Filesystem Scan

MEF no deberá requerir escaneo indiscriminado del filesystem.

---

# 51. Deterministic Discovery

El mismo conjunto de Modules deberá producir Discovery equivalente.

---

# 52. Duplicate Module ID

Dos Modules incompatibles con el mismo ID deberán rechazarse.

---

# 53. Module Dependencies

Un Module podrá depender de otros Modules únicamente cuando exista razón arquitectónica explícita.

---

# 54. Module Dependency Declaration

Conceptualmente:

```yaml
requires:
  modules:
    MOD-IDENTITY: "^2.0"
```

---

# 55. Prefer Contract Dependency

Cuando el Module solo necesita una capacidad publicada, deberá favorecer dependencia mediante Contract:

```text
requires CT-IDENTITY-001
```

en lugar de:

```text
requires MOD-IDENTITY
```

---

# 56. Direct Module Dependency

Será apropiada cuando se requiera semántica del Module completo, Lifecycle u otra relación explícita.

---

# 57. Module Coupling

Dependencias directas entre Modules deberán minimizarse.

---

# 58. Required Dependency

Una dependencia requerida ausente deberá impedir Activation.

---

# 59. Optional Dependency

Podrá declararse como opcional.

---

# 60. Optional Semantics

La ausencia deberá tener comportamiento explícito.

---

# 61. Dependency Version

Deberá utilizar reglas de ENG-014/ENG-016.

---

# 62. Dependency Cycles

Los ciclos no permitidos deberán rechazarse.

---

# 63. Module Graph

Las dependencias forman:

```text
Module Graph
```

---

# 64. Module Graph Authority

ENG-027 coordina construcción/orden de Activation.

ENG-028 define las relaciones declarables.

---

# 65. Contract Requirements

Un Module deberá declarar Contracts externos obligatorios cuando corresponda.

---

# 66. Required Contract

Ejemplo:

```yaml
requires:
  contracts:
    CT-IDENTITY-001: "^2.0"
```

---

# 67. Provided Contract

Ejemplo:

```yaml
provides:
  contracts:
    CT-CUSTOMER-001: "1.4.0"
```

---

# 68. Contract Ownership

ENG-021 continuará definiendo Ownership.

---

# 69. Contract Provider

Un Module puede proporcionar una Implementation sin ser Owner del Contract.

---

# 70. Contract Visibility

Deberá respetarse:

```text
private
module
public
framework
```

---

# 71. Contract Consistency

Manifest y Implementation no deberán divergir silenciosamente.

---

# 72. Required vs Provided

Deberá mantenerse explícito:

```text
requires
provides
```

---

# 73. Module Capabilities

Un Module podrá declarar Capabilities.

---

# 74. Capability Semantics

En ENG-028, `Capability` representará una **capacidad arquitectónica que el Module puede proporcionar o requerir**.

---

# 75. Security Capability

ENG-024 podrá utilizar Capabilities como autoridad concedida.

---

# 76. Avoid Capability Ambiguity

Deberá distinguirse cuando sea necesario:

```text
Architectural Capability
Security Grant
Runtime Feature
```

---

# 77. Architectural Capability

Ejemplo:

```text
CAP-EVENT-DURABLE
CAP-STORAGE
CAP-AUDIT
```

si ENG-005 formaliza esta nomenclatura.

---

# 78. Required Capability

Un Module podrá declarar:

```text
requires CAP-X
```

---

# 79. Provided Capability

Podrá declarar:

```text
provides CAP-X
```

---

# 80. Capability Is Not Permission

No deberá asumirse:

```text
provides CAP-X
=
is authorized to use everything related to X
```

---

# 81. Security Grant

La autorización efectiva seguirá ENG-024.

---

# 82. Module Permissions

Un Module podrá declarar Permissions necesarias.

---

# 83. Permission Declaration Is Not Grant

Declarar:

```text
requires permission X
```

no significa recibirla automáticamente.

---

# 84. Runtime Security Validation

ENG-027/ENG-024 deberán decidir si el Module puede activarse.

---

# 85. ModuleContext

Cada Module deberá recibir un Context limitado y gobernado.

---

# 86. ModuleContext Purpose

Proporcionar únicamente capacidades necesarias para participar en Runtime.

---

# 87. Recommended ModuleContext

Conceptualmente:

```text
ModuleContext
├── module identity
├── scoped configuration
├── contract access
├── event publisher
├── telemetry
├── security-scoped capabilities
└── lifecycle information
```

---

# 88. No Full Runtime Context

No deberá entregarse:

```text
Entire Runtime
```

como Context ordinario.

---

# 89. No Full Container

ModuleContext no deberá exponer Container completo a Business Logic.

---

# 90. Scoped Configuration

El Module debería recibir su Configuration relevante.

---

# 91. Configuration Namespace

Ejemplo:

```text
modules.customer.*
```

o mecanismo equivalente.

---

# 92. Configuration Isolation

Un Module no deberá leer Configuration privada de otro sin autorización.

---

# 93. Contract Access

El Module deberá recibir dependencias principalmente mediante DI.

---

# 94. Event Access

Un Module que solo publica Events debería recibir:

```text
EventPublisher
```

no Event Bus administrativo completo.

---

# 95. Telemetry Access

Podrá recibir:

```text
Tracer
MetricRecorder
Logger
```

con Context apropiado.

---

# 96. Security Context

No deberá recibir acceso a Secrets/Permissions no requeridos.

---

# 97. ModuleContext Immutability

La estructura base debería ser inmutable durante una operación de Lifecycle.

---

# 98. Lifecycle Context

Podrá incluir Phase actual.

---

# 99. Runtime ID

Podrá incluir Runtime ID para Diagnostics.

No deberá utilizarse como Credential.

---

# 100. Module Initialization

Initialization deberá:

```text
prepare internal state
validate local resources
register allowed runtime integrations
```

sin aceptar Workload externo todavía.

---

# 101. Initialization Side Effects

Deberán minimizarse y ser reversibles cuando sea posible.

---

# 102. Initialize Idempotency

Podrá favorecerse idempotencia, especialmente para Testing/Rollback.

---

# 103. Initialization Failure

Deberá impedir Activation.

---

# 104. Module Activation

Activation habilita funcionalidad operacional.

---

# 105. Activation Preconditions

Deberán estar satisfechos:

```text
validated manifest
required dependencies
required contracts
security requirements
configuration
initialization
```

---

# 106. Activation Hook

Podrá iniciar:

```text
workers
subscriptions
timers
external listeners
```

cuando corresponda.

---

# 107. No Premature Workload

Un Module no deberá procesar Workload antes de Active.

---

# 108. Activation Failure

Deberá integrarse con Rollback de ENG-027.

---

# 109. Activation Rollback

Todo recurso adquirido durante Initialization/Activation debería poder liberarse.

---

# 110. Deactivation

Deberá detener:

```text
new work
workers
subscriptions
timers
connections owned by module
```

según Ownership.

---

# 111. Deactivation Order

ENG-027 determinará orden según Module Graph.

---

# 112. Deactivation Idempotency

Deberá tolerar llamadas repetidas cuando sea razonable.

---

# 113. Cleanup Failure

No deberá ocultar Failure primaria de Shutdown.

---

# 114. Module Resources

Un Module deberá poseer claramente los recursos que crea.

---

# 115. Resource Ownership

El propietario deberá ser responsable de Cleanup.

---

# 116. Shared Resources

Deberán administrarse mediante infraestructura compartida/Scopes.

---

# 117. Module Scope

ENG-019 podrá proporcionar:

```text
Module Scope
```

---

# 118. Module Scope Lifetime

Deberá alinearse con Module Lifecycle.

---

# 119. Module Scope Disposal

Al detener Module deberán liberarse Services exclusivos de su Scope.

---

# 120. Internal Services

Services internos deberán permanecer privados.

---

# 121. Public Services

Deberán exponerse mediante Contracts.

---

# 122. Service Export

No deberá publicarse una clase concreta únicamente para permitir cross-module access.

---

# 123. Provider Registration

Un Module podrá poseer Provider responsable de Definitions.

---

# 124. Module Provider

Conceptualmente:

```text
CustomerModuleProvider
```

---

# 125. Provider Responsibility

Podrá registrar:

```text
services
contract implementations
event handlers
capabilities
```

permitidos.

---

# 126. Provider ≠ Module

No deberán confundirse.

```text
Module
→ architectural unit

Provider
→ registration mechanism
```

---

# 127. Multiple Providers

Un Module podrá poseer varios Providers cuando exista necesidad.

---

# 128. Provider Visibility

Providers internos no deberán convertirse automáticamente en API pública.

---

# 129. Registry Integration

ENG-020 deberá registrar Module metadata.

---

# 130. Module Registry Entry

Conceptualmente:

```text
ModuleEntry
├── id
├── version
├── owner
├── package
├── state
├── visibility
├── dependencies
├── contracts
├── capabilities
└── provenance
```

---

# 131. Registry State

Podrá reflejar estado conocido.

ENG-015 sigue siendo autoridad sobre State.

---

# 132. Registry Does Not Activate

Registrar un Module no deberá activarlo.

---

# 133. Container Integration

ENG-019 construirá Services del Module.

---

# 134. Container Visibility

Services deberán etiquetarse con Ownership/Visibility suficiente.

---

# 135. DI Integration

ENG-018 suministrará dependencias.

---

# 136. Module Does Not Resolve Arbitrarily

Business Logic no deberá hacer:

```text
container.resolve(anything)
```

---

# 137. Contracts Integration

ENG-021 gobierna Contracts publicados/requeridos.

---

# 138. Event Integration

ENG-022 gobierna Events del Module.

---

# 139. Internal Events

Podrán permanecer dentro del Module.

---

# 140. Public Events

Deberán gobernarse como Contract.

---

# 141. Event Ownership

El Module Owner será normalmente responsable de sus Events publicados.

---

# 142. Handler Ownership

Todo Handler deberá pertenecer a una frontera conocida.

---

# 143. Security Integration

ENG-024 deberá validar:

```text
module identity
capabilities
permissions
package trust
service visibility
event permissions
secret access
```

---

# 144. Module Trust

Un Module instalado no deberá considerarse automáticamente confiable.

---

# 145. Trust Provenance

Podrá derivarse de:

```text
package source
signature
publisher
runtime policy
```

---

# 146. Module Isolation

La primera implementación proporcionará principalmente aislamiento arquitectónico/lógico.

---

# 147. Logical Isolation

Significa:

```text
boundaries
visibility
contracts
permissions
```

---

# 148. Process Isolation

No deberá afirmarse salvo que exista mecanismo real.

---

# 149. Sandbox

No forma parte del requisito inicial.

---

# 150. Module Data Ownership

Un Module debería ser autoridad sobre su propio estado persistente.

---

# 151. Cross-Module Data Access

No deberá ocurrir mediante acceso arbitrario a tablas/almacenamiento interno de otro Module.

---

# 152. Data Contract

La interacción deberá ocurrir mediante Contract/Event apropiado.

---

# 153. Shared Database

Incluso cuando Modules compartan Database física deberán mantener Ownership lógico.

---

# 154. Schema Ownership

Un Schema/Table debería tener Owner claro cuando sea relevante.

---

# 155. Migration Ownership

Las Migrations deberán pertenecer al Module/Package responsable.

La formalización detallada podrá pertenecer a documento posterior.

---

# 156. Module Persistence

ENG-028 no define aún Persistence Engine.

Solo exige respetar Boundary y Ownership.

---

# 157. Module Configuration

Toda Configuration pública deberá estar documentada.

---

# 158. Required Configuration

Deberá validarse antes de Activation.

---

# 159. Optional Configuration

Deberá poseer Default explícito cuando corresponda.

---

# 160. Secret Configuration

No deberá mezclarse con Config pública.

---

# 161. Configuration Evolution

Cambios relevantes deberán someterse a Versioning/Compatibility.

---

# 162. Module Feature Flags

Podrán existir.

---

# 163. Feature Flag Scope

Deberán pertenecer al Module correspondiente.

---

# 164. Feature Flag Is Not Permission

No deberá utilizarse como sustituto de Authorization.

---

# 165. Extension Points

Un Module podrá publicar Extension Points.

---

# 166. Extension Point Identity

Deberá ser estable si es público.

---

# 167. Extension Point Contract

Deberá definir:

```text
accepted extension
contract
multiplicity
ordering
lifecycle
```

---

# 168. Extension Registration

Deberá ocurrir mediante mecanismos gobernados.

---

# 169. Extension Does Not Break Boundary

Una Extension no deberá recibir acceso irrestricto a internals del Module.

---

# 170. Extension Security

ENG-024 deberá evaluar su Authority.

---

# 171. Module Compatibility

Un Module deberá declarar Runtime/Contract Requirements.

---

# 172. Runtime Requirement

Ejemplo conceptual:

```yaml
requires:
  mef: "^1.5"
```

---

# 173. Contract Requirements

Deberán declarar rangos compatibles.

---

# 174. Dependency Requirements

También.

---

# 175. Capability Requirements

Podrán formar parte de Compatibility.

---

# 176. Compatibility Matrix

ENG-016 deberá poder evaluar:

```text
Module
↔ Runtime
↔ Contracts
↔ Dependencies
↔ Capabilities
```

---

# 177. Module Upgrade

Un Module deberá poder evolucionar de versión.

---

# 178. Upgrade Compatibility

Deberá evaluar:

```text
contracts
configuration
data
dependencies
runtime
```

---

# 179. Module Replacement

Un Module no deberá reemplazarse en Runtime activo en la primera implementación.

---

# 180. Static Runtime Topology

Conforme ENG-027, la primera versión favorecerá topology estática durante ACTIVE.

---

# 181. Upgrade by Restart

Inicialmente:

```text
install/update
   ↓
restart Runtime
   ↓
bootstrap
   ↓
validate
   ↓
activate
```

---

# 182. Hot Reload

No es requisito inicial.

---

# 183. Dynamic Module Loading

No es requisito inicial.

---

# 184. Module Deprecation

Un Module podrá marcarse Deprecated.

---

# 185. Module Retirement

Un Module retirado no deberá participar en nueva Runtime Composition soportada.

---

# 186. Replacement Module

Podrá indicarse alternativa.

---

# 187. Migration Guidance

Debería proporcionarse cuando Module público se retire.

---

# 188. Module Documentation

Todo Module público deberá documentar al menos:

```text
purpose
owner
version
dependencies
contracts
capabilities
configuration
lifecycle
security requirements
```

---

# 189. Generated Documentation

Tooling podrá generar parte desde Manifest/Registry.

---

# 190. Source of Truth

La metadata normativa deberá tener Source of Truth identificable.

---

# 191. Manifest vs Documentation

La documentación no deberá contradecir Manifest.

---

# 192. Manifest vs Code

Tampoco deberá divergir silenciosamente.

---

# 193. Module Validation

Deberá realizarse antes de Activation.

---

# 194. Validation Layers

Podrán incluir:

```text
manifest
identity
dependencies
contracts
capabilities
configuration
security
entrypoint
lifecycle
```

---

# 195. Structural Validation

Comprueba que Module esté correctamente descrito.

---

# 196. Dependency Validation

Comprueba Graph.

---

# 197. Contract Validation

Comprueba required/provided Contracts.

---

# 198. Security Validation

Comprueba Permissions/Capabilities/Trust.

---

# 199. Entrypoint Validation

Comprueba que Runtime pueda integrar el Module.

---

# 200. Lifecycle Validation

Comprueba Hooks requeridos.

---

# 201. Activation Validation

Comprueba que todo requisito operativo previo esté satisfecho.

---

# 202. Validation Before Construction

Metadata debería validarse antes de construir Services costosos cuando sea posible.

---

# 203. Module Validation Result

Conceptualmente:

```text
ModuleValidationResult
├── moduleId
├── valid
├── errors
├── warnings
└── diagnostics
```

---

# 204. Invalid Module

No deberá alcanzar ACTIVE.

---

# 205. Optional Invalid Module

Podrá omitirse y degradar Runtime si Policy lo permite.

---

# 206. Required Invalid Module

Deberá impedir Readiness.

---

# 207. Error Namespace

ENG-028 utilizará:

```text
MEF-MOD-xxx
```

---

# 208. Taxonomía ENG-028

```text
MEF-MOD-001 Module manifest invalid
MEF-MOD-002 Module identity invalid
MEF-MOD-003 Duplicate module identity
MEF-MOD-004 Module version invalid
MEF-MOD-005 Module entrypoint invalid
MEF-MOD-006 Required module dependency missing
MEF-MOD-007 Module dependency cycle detected
MEF-MOD-008 Required contract missing
MEF-MOD-009 Provided contract invalid
MEF-MOD-010 Capability requirement unsatisfied
MEF-MOD-011 Permission requirement denied
MEF-MOD-012 Module configuration invalid
MEF-MOD-013 Module initialization failed
MEF-MOD-014 Module activation failed
MEF-MOD-015 Module deactivation failed
MEF-MOD-016 Module visibility violation
MEF-MOD-017 Module internal API access denied
MEF-MOD-018 Module compatibility failure
MEF-MOD-019 Module lifecycle violation
MEF-MOD-020 Module invariant violated
```

---

# 209. Invalid Manifest

```text
MEF-MOD-001

Module manifest invalid.

Module:
MOD-CUSTOMER

Reason:
Required field "version" is missing.
```

---

# 210. Duplicate Module

```text
MEF-MOD-003

Duplicate module identity detected.

Module:
MOD-CUSTOMER

Candidate packages:
PKG-CUSTOMER-A
PKG-CUSTOMER-B
```

---

# 211. Missing Dependency

```text
MEF-MOD-006

Required module dependency missing.

Module:
MOD-ORDERS

Requires:
MOD-IDENTITY ^2.0
```

---

# 212. Required Contract Missing

```text
MEF-MOD-008

Required Contract unavailable.

Module:
MOD-ORDERS

Contract:
CT-PAYMENT-001

Required version:
^3.0
```

---

# 213. Capability Unsatisfied

```text
MEF-MOD-010

Required capability unavailable.

Module:
MOD-AUDIT

Capability:
CAP-EVENT-DURABLE
```

---

# 214. Activation Failure

```text
MEF-MOD-014

Module activation failed.

Module:
MOD-NOTIFICATION

Cause:
Mail transport unavailable.
```

---

# 215. Internal API Access

```text
MEF-MOD-017

Cross-module internal API access denied.

Consumer:
MOD-CRM

Owner:
MOD-IDENTITY

Internal service:
IdentityRepositoryInternal

Use a public Contract.
```

---

# 216. Module Invariant Violation

```text
MEF-MOD-020

Module invariant violated.

Module:
MOD-CUSTOMER

Reason:
Module accepted workload before activation completed.
```

---

# 217. Observability

ENG-025 deberá permitir Telemetry por Module.

---

# 218. Standard Module Attributes

Ejemplos:

```text
mef.module.id
mef.module.version
mef.module.state
```

---

# 219. Module Metrics

Podrán existir:

```text
mef.module.activation.duration
mef.module.failures.total
mef.modules.active
mef.modules.failed
```

---

# 220. Module Trace

Lifecycle podrá instrumentarse:

```text
module.initialize
module.activate
module.deactivate
```

---

# 221. Module Logs

Deberán incluir Module ID estructurado cuando corresponda.

---

# 222. Module Health

Un Module podrá proporcionar Health Check.

---

# 223. Module Health ≠ Module State

Ejemplo válido:

```text
state:
ACTIVE

health:
DEGRADED
```

---

# 224. Required Module Health

Podrá afectar Runtime Readiness.

---

# 225. Optional Module Health

Podrá afectar únicamente Degraded State.

---

# 226. Performance

ENG-026 deberá medir Module Lifecycle cuando sea significativo.

---

# 227. Activation Benchmark

Podrá existir:

```text
BM-MODULE-ACTIVATE
```

---

# 228. Module Memory

Podrá medirse overhead aproximado por Module.

---

# 229. Module Count Scaling

Runtime deberá evaluarse con diferentes cantidades de Modules.

---

# 230. Performance Is Not Boundary Bypass

No deberán eliminarse Contracts/Visibility para mejorar Performance sin análisis arquitectónico.

---

# 231. Testing

ENG-009 deberá permitir Tests de Module.

---

# 232. Module Unit Tests

Business internals deberán probarse sin Runtime completo cuando sea posible.

---

# 233. Module Integration Test

Podrá construir:

```text
ModuleContext
Container
Contracts
Events
```

necesarios.

---

# 234. Module Contract Test

Deberá validar Contracts proporcionados.

---

# 235. Manifest Test

Deberá comprobar coherencia entre Manifest e Implementation.

---

# 236. Lifecycle Test

Deberá verificar:

```text
initialize
activate
deactivate
```

---

# 237. Activation Failure Test

Deberá verificar Cleanup.

---

# 238. Security Test

Deberá comprobar Permissions y Visibility.

---

# 239. Isolation Test

Deberá intentar acceso a internals de otro Module y confirmar rechazo.

---

# 240. Dependency Test

Deberá validar Requirements.

---

# 241. Compatibility Test

Deberá verificar Runtime/Contract Versions.

---

# 242. Runtime Test

ENG-027 deberá comprobar integración de varios Modules.

---

# 243. Test Module

Podrán existir Modules exclusivamente para Testing.

---

# 244. Test Module Identity

Deberán evitar colisionar con Modules productivos.

---

# 245. Fixture Module

Podrá declarar configuración mínima.

---

# 246. No Production Leakage

Test Modules no deberán terminar en Release productiva por accidente.

---

# 247. CLI Integration

ENG-007 podrá incorporar:

```text
mef module list
mef module inspect
mef module validate
mef module graph
mef module contracts
mef module capabilities
```

---

# 248. `module list`

Podrá mostrar:

```text
ID
Version
State
Health
Package
```

---

# 249. `module inspect`

Podrá mostrar:

```text
identity
version
owner
dependencies
contracts
capabilities
configuration schema
lifecycle
```

---

# 250. `module validate`

Deberá validar Module sin necesariamente activar Runtime completo.

---

# 251. `module graph`

Podrá mostrar Dependency Graph.

---

# 252. `module contracts`

Podrá mostrar:

```text
required
provided
```

---

# 253. `module capabilities`

Podrá mostrar:

```text
required
provided
granted
denied
```

según autorización del Caller.

---

# 254. Machine Output

Los comandos deberán soportar salida estructurada.

---

# 255. Build Integration

ENG-012 deberá validar Modules durante Build.

---

# 256. Module Build Gate

Podrá fallar por:

```text
invalid manifest
duplicate ID
missing entrypoint
invalid Contract
invalid Dependency
security violation
compatibility violation
```

---

# 257. Release Integration

ENG-017 deberá incluir Module metadata relevante.

---

# 258. Release Notes

Podrán incluir:

```text
new modules
removed modules
deprecated modules
new contracts
changed dependencies
```

---

# 259. Package Integration

ENG-013 deberá saber qué Modules contiene un Package.

---

# 260. Package Manifest Relationship

El Package Manifest podrá declarar sus Modules.

---

# 261. Module-to-Package Traceability

Deberá poder responderse:

```text
which package provides MOD-CUSTOMER?
```

---

# 262. Package Removal Impact

No deberá retirarse Package si elimina Required Modules sin validación.

---

# 263. Module Install ≠ Activation

Instalar Package no deberá activar automáticamente Module salvo Policy explícita.

---

# 264. Installed

Significa disponible físicamente.

---

# 265. Discovered

Significa reconocido por Runtime.

---

# 266. Registered

Significa incorporado estructuralmente.

---

# 267. Active

Significa operacional.

---

# 268. Distinct Concepts

Deberán mantenerse separados:

```text
Installed
Discovered
Registered
Initialized
Active
```

---

# 269. Module State Machine

ENG-028 no deberá inventar nueva State Machine.

Deberá mapear estos conceptos a ENG-015.

---

# 270. Build-Time Module

Un Module podrá ser relevante solo en Build/Tooling.

---

# 271. Runtime Module

Participa en Application Runtime.

---

# 272. Module Type

MEF podrá permitir tipos como:

```text
runtime
tooling
build
integration
```

si Architecture los formaliza.

---

# 273. Type Extension

No deberá introducirse taxonomía excesiva sin necesidad.

---

# 274. Module Metadata

Podrá incluir metadata extensible namespaced.

---

# 275. Core Metadata

Los campos críticos deberán permanecer tipados.

---

# 276. Unknown Metadata

Deberá seguir reglas de ENG-003.

---

# 277. Module Fingerprint

Tooling podrá generar fingerprint de Manifest/Metadata.

---

# 278. Fingerprint Purpose

Puede ayudar a:

```text
cache
integrity
diagnostics
change detection
```

---

# 279. Fingerprint ≠ Signature

No deberá confundirse con identidad/trust criptográfico.

---

# 280. Module Provenance

Registry deberá conservar:

```text
package
publisher
manifest source
version
```

cuando corresponda.

---

# 281. Trust Metadata

Deberá provenir de ENG-024, no de auto-declaración.

---

# 282. Module Documentation Generation

Tooling podrá producir:

```text
module catalog
dependency graph
contract map
capability map
```

---

# 283. Architecture Catalog

Esto permitirá construir una vista:

```text
MOD-CUSTOMER
├── requires CT-IDENTITY-001
├── provides CT-CUSTOMER-001
├── publishes EV-CUSTOMER-CREATED-001
└── package PKG-CUSTOMER
```

---

# 284. Impact Analysis

Antes de modificar/eliminar Module deberá poder analizarse:

```text
consumers
contracts
events
dependencies
capabilities
packages
```

---

# 285. Removal Impact

ENG-020 podrá utilizar Registry Graph.

---

# 286. Module Split

Dividir un Module deberá analizar:

```text
ownership
contracts
data
dependencies
events
```

---

# 287. Module Merge

Fusionar Modules puede introducir Breaking Changes.

---

# 288. Rename

Cambiar ID equivale conceptualmente a introducir otra identidad y deberá tratarse como migración.

---

# 289. Refactor Internals

No deberá afectar Consumers mientras la superficie contractual permanezca compatible.

---

# 290. Module Boundary Tests

Tooling podrá verificar imports/references prohibidos cuando el lenguaje lo permita.

---

# 291. Architecture Rules

Ejemplos:

```text
MOD-A cannot import MOD-B/internal
Domain cannot access Container
Private services cannot be resolved cross-module
```

---

# 292. Static Analysis

Podrá contribuir a enforcement.

---

# 293. Runtime Enforcement

Donde Static Analysis no sea suficiente podrán existir controles Runtime.

---

# 294. Defense in Depth

Ambos mecanismos podrán coexistir.

---

# 295. First Implementation

La primera implementación deberá incluir:

```text
ModuleDescriptor
ModuleManifest
ModuleInterface
ModuleContext
ModuleProvider

ModuleDiscovery
ModuleValidator

ModuleDependency
ModuleGraph

RequiredContract
ProvidedContract

RequiredCapability
ProvidedCapability

ModuleLifecycleAdapter
```

---

# 296. Conceptual Directory Structure

```text
src/
└── Module/
    ├── ModuleDescriptor
    ├── ModuleManifest
    ├── ModuleInterface
    ├── ModuleContext
    ├── ModuleProvider
    │
    ├── Discovery/
    │   └── ModuleDiscovery
    │
    ├── Validation/
    │   └── ModuleValidator
    │
    ├── Dependency/
    │   ├── ModuleDependency
    │   └── ModuleGraph
    │
    ├── Contract/
    │   ├── RequiredContract
    │   └── ProvidedContract
    │
    ├── Capability/
    │   ├── RequiredCapability
    │   └── ProvidedCapability
    │
    └── Lifecycle/
        └── ModuleLifecycleAdapter
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 297. Minimal Module Descriptor

Conceptualmente:

```text
ModuleDescriptor
├── id
├── version
├── owner
├── entrypoint
├── dependencies
├── requiredContracts
├── providedContracts
├── requiredCapabilities
├── providedCapabilities
└── metadata
```

---

# 298. ModuleDescriptor vs Module Instance

Deberán mantenerse separados:

```text
ModuleDescriptor
→ metadata

Module Instance
→ runtime object
```

---

# 299. Module Instance Construction

Service Container podrá construir Entrypoint/Provider cuando corresponda.

---

# 300. Descriptor Does Not Instantiate

Leer ModuleDescriptor no deberá ejecutar Module.

---

# 301. First Runtime Flow

```text
Package Installed
      ↓
Manifest Found
      ↓
ModuleDescriptor
      ↓
Module Validation
      ↓
Registry Entry
      ↓
Module Graph
      ↓
Contract Validation
      ↓
Security Validation
      ↓
Container Composition
      ↓
Module Instance
      ↓
Initialize
      ↓
Activate
```

---

# 302. Module Shutdown Flow

```text
Active Module
     ↓
Stop Admission
     ↓
Deactivate
     ↓
Dispose Module Scope
     ↓
Release Resources
     ↓
Stopped
```

---

# 303. Module Relationship Model

```text
                   MODULE
                     │
        ┌────────────┼────────────┐
        ▼            ▼            ▼
    requires      provides      publishes
        │            │            │
        ▼            ▼            ▼
    Contract      Contract       Event
        │
        └────────────┼────────────┘
                     ▼
                  Registry
                     │
                     ▼
                   Runtime
```

---

# 304. Security Model

```text
Module Manifest
      │
      ▼
Requested Capabilities
      │
      ▼
Security Policy
      │
  ┌───┴────┐
  ▼        ▼
Deny      Grant
           │
           ▼
     ModuleContext
```

---

# 305. Isolation Model

```text
MOD-A
 │
 ├── internal
 │    └── inaccessible externally
 │
 └── public Contract
       ▲
       │
     MOD-B
```

---

# 306. Module Quality Gate

Antes de Release deberá verificarse:

```text
Identity
Manifest
Dependencies
Contracts
Capabilities
Security
Compatibility
Lifecycle
Tests
```

---

# 307. First Implementation Constraints

La primera versión deberá favorecer:

```text
Static Module Discovery
Static Runtime Topology
Explicit Manifest
Explicit Dependencies
Explicit Contracts
Explicit Capabilities
Deterministic Activation
No Hot Reload
No Dynamic Module Mutation
Logical Isolation
```

---

# 308. Second Phase

Podrá incorporar:

```text
Generated Manifests
Advanced Extension Points
Module Templates
Module Scaffolding
Module Catalog
Impact Analysis
Module-Specific Health
Module Performance Reports
```

---

# 309. Third Phase

Solo cuando exista necesidad:

```text
Dynamic Module Loading
Hot Reload
Module Sandboxing
Process Isolation
Remote Modules
Federated Module Catalog
Live Contract Rebinding
```

---

# 310. Invariantes de Ingeniería

ENG-028 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-506 | Todo Module deberá poseer identidad canónica estable y versión independiente de dicha identidad. |
| EI-507 | Module y Package deberán mantenerse como conceptos distintos aunque puedan estar relacionados. |
| EI-508 | Todo Module deberá encapsular sus internals y publicar únicamente superficies autorizadas. |
| EI-509 | Un Module no deberá consumir directamente APIs internas de otro Module fuera de mecanismos arquitectónicamente permitidos. |
| EI-510 | Los Module Dependencies obligatorios deberán declararse explícitamente y validarse antes de Activation. |
| EI-511 | Cuando una necesidad pueda expresarse mediante Contract estable, deberá favorecerse Contract Dependency sobre dependencia directa al Module concreto. |
| EI-512 | Required Contracts y Provided Contracts deberán declararse de forma diferenciada. |
| EI-513 | La declaración de una Capability o Permission no deberá interpretarse automáticamente como concesión de autoridad. |
| EI-514 | ModuleContext deberá proporcionar capacidades limitadas y no acceso irrestricto al Runtime o Service Container. |
| EI-515 | Discovery de un Module no deberá ejecutar Business Logic ni implicar Activation. |
| EI-516 | Un Module inválido no deberá alcanzar estado operacional. |
| EI-517 | Module Activation deberá ocurrir únicamente después de satisfacer Dependencies, Contracts, Configuration y Security Requirements obligatorios. |
| EI-518 | Los recursos propiedad del Module deberán poder liberarse durante Deactivation o Rollback. |
| EI-519 | Un Service interno de Module no deberá convertirse en dependencia cross-module únicamente por estar registrado en Container. |
| EI-520 | Manifest, Registry metadata e Implementation no deberán divergir silenciosamente sobre identidad, Contracts o Dependencies del Module. |
| EI-521 | Module State y Module Health deberán mantenerse como conceptos separados. |
| EI-522 | Un Module instalado no deberá considerarse automáticamente confiable ni autorizado. |
| EI-523 | La primera implementación deberá favorecer Runtime Topology estática y no requerir Dynamic Module Loading o Hot Reload. |
| EI-524 | Las garantías de aislamiento de Module deberán corresponder a mecanismos realmente implementados. |
| EI-525 | La evolución de un Module deberá preservar Contracts y Compatibility o declarar explícitamente los Breaking Changes correspondientes. |

---

# 311. Continuidad de Invariantes

```text
ENG-024 → EI-426 a EI-445
ENG-025 → EI-446 a EI-465
ENG-026 → EI-466 a EI-485
ENG-027 → EI-486 a EI-505
ENG-028 → EI-506 a EI-525
```

---

# 312. Criterios de Conformidad

Una implementación será conforme con ENG-028 cuando:

- represente Module mediante identidad estable;
- separe Module de Package;
- disponga de Manifest;
- defina Entrypoint;
- preserve Boundary;
- preserve internals;
- declare Module Dependencies;
- declare Required Contracts;
- declare Provided Contracts;
- declare Capabilities;
- diferencie Capability de Permission;
- utilice ModuleContext limitado;
- permita Discovery sin Activation;
- permita Validation previa;
- integre Registry;
- integre Container;
- integre DI;
- integre Contracts;
- integre Event Bus;
- integre Security;
- participe correctamente en Runtime Lifecycle;
- permita Cleanup;
- soporte Testing;
- mantenga Compatibility;
- no dependa de Dynamic Module Loading.

---

# 313. Riesgos

Deberán evitarse especialmente:

## Package Equals Module

Confunde distribución con arquitectura.

## Module as Folder

Se considera Module únicamente porque existe un directorio.

## God Module

Una frontera concentra responsabilidades no relacionadas.

## Module Explosion

Cada clase se convierte en Module.

## Cross-Module Internals

Modules consumen clases privadas de otros Modules.

## Full Runtime Context

Cada Module recibe todo Runtime.

## Full Container Access

Los Modules utilizan Container como Service Locator.

## Installed Means Trusted

Todo Package instalado obtiene privilegios.

## Capability Equals Permission

Una capacidad declarada se convierte automáticamente en autorización.

## Discovery Executes Code

Escanear Modules produce Side Effects.

## Manifest Drift

Manifest y Implementation divergen.

## Module Without Owner

No existe responsabilidad sobre Contracts/evolución.

## Static Dependency on Implementation

Un Module depende de Adapter concreto cuando existe Contract.

## Shared Database Coupling

Modules consumen tablas internas de otros.

## Lifecycle Side Effects

Initialization comienza a procesar Workload antes de Activation.

## No Rollback

Activation falla y deja recursos abiertos.

## False Isolation

Se afirma Sandbox cuando solo existe separación lógica.

## Dynamic Runtime Prematurely

Se agrega Hot Reload antes de estabilizar Static Runtime.

---

# 314. Relación con ENG-002

ENG-002 continúa siendo la especificación general de Modules existente.

ENG-028 deberá interpretarse como la **formalización de Ingeniería Runtime y operacional** de esa arquitectura.

Si ENG-002 ya define alguna regla normativa de Module, ENG-028 deberá respetarla y no duplicarla con significado distinto.

---

# 315. Relación con ENG-003

ENG-003 define Manifest.

ENG-028 define qué información específica de Module debe representarse en él.

---

# 316. Relación con ENG-013

ENG-013 administra Packages.

ENG-028 administra Modules.

```text
Package Manager
→ installs/distributes

Module Engineering
→ defines architectural unit
```

---

# 317. Relación con ENG-015

ENG-015 gobierna estados y transiciones.

ENG-028 define comportamiento del Module dentro de esas transiciones.

---

# 318. Relación con ENG-018

DI entrega dependencias a Services/Entrypoint del Module.

---

# 319. Relación con ENG-019

Container construye componentes del Module y administra Module Scope cuando exista.

---

# 320. Relación con ENG-020

Registry conserva Metadata del Module.

---

# 321. Relación con ENG-021

Contracts constituyen la principal superficie de colaboración estable entre Modules.

---

# 322. Relación con ENG-022

Events permiten colaboración desacoplada entre Modules.

---

# 323. Relación con ENG-024

Security gobierna:

```text
Trust
Permissions
Capabilities
Secrets
Visibility
```

del Module.

---

# 324. Relación con ENG-025

Observability permite observar:

```text
Module State
Module Health
Lifecycle
Failures
Performance
```

---

# 325. Relación con ENG-026

Performance mide:

```text
Activation
Memory
Scaling by module count
Runtime overhead
```

---

# 326. Relación con ENG-027

La separación fundamental será:

```text
ENG-028
Module Engineering
→ define qué es un Module y cómo participa

ENG-027
Runtime Engineering
→ coordina el conjunto de Modules
```

---

# 327. Principio Rector

> **Un Module en MEF deberá ser una unidad arquitectónica explícita, identificable, versionada y aislada por Contracts, capaz de declarar sus dependencias, capacidades y requisitos sin acceder irrestrictamente al Runtime ni a los internals de otros Modules.**

---

# 328. Conclusión

**ENG-028 — Module Engineering** formaliza la unidad central sobre la que opera MEF.

La cadena queda:

```text
Package
   ↓
Manifest
   ↓
Module Descriptor
   ↓
Validation
   ↓
Registry
   ↓
Dependency Graph
   ↓
Contracts / Capabilities
   ↓
Security
   ↓
Container Composition
   ↓
Module Instance
   ↓
Initialization
   ↓
Activation
   ↓
Runtime
```

El Module deja de significar simplemente:

```text
folder
namespace
package
class
```

y pasa a significar:

```text
Identity
+
Boundary
+
Manifest
+
Dependencies
+
Contracts
+
Capabilities
+
Lifecycle
+
Runtime Participation
```

La distinción arquitectónica queda:

```text
Package
→ distributes

Manifest
→ declares

Module
→ encapsulates

Registry
→ knows

Contract
→ exposes

Container
→ constructs

DI
→ supplies

Security
→ authorizes

Runtime
→ orchestrates
```

Con esto se resuelve el principal hueco detectado durante el Inventario II: **ENG-027 ya no necesita definir implícitamente qué es un Module**, porque esa autoridad pasa formalmente a ENG-028.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-026 — Performance Engineering
- ENG-027 — Runtime Engineering