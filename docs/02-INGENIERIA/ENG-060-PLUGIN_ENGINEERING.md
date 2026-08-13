---
categoria: Ingeniería
dependencias:
- ENG-005
- ENG-009
- ENG-014
- ENG-016
- ENG-018
- ENG-019
- ENG-020
- ENG-021
- ENG-022
- ENG-023
- ENG-024
- ENG-025
- ENG-027
- ENG-028
- ENG-029
- ENG-034
- ENG-036
- ENG-037
- ENG-039
- ENG-049
- ENG-050
- ENG-051
- ENG-055
- ENG-057
- ENG-058
- ENG-059
estado: Accepted
id: ENG-060
keywords:
- extension
- plugin
- extension-point
- extension-contract
- plugin-contract
- plugin-manifest
- plugin-metadata
- plugin-discovery
- plugin-registration
- plugin-resolution
- plugin-lifecycle
- plugin-isolation
- plugin-sandbox
- plugin-permission
- plugin-trust
- plugin-signature
- plugin-hook
- plugin-api
- plugin-upgrade
- plugin-migration
- plugin-quarantine
- extensibility
- mef
nivel: L2
relacionados:
- ENG-006
- ENG-007
- ENG-008
- ENG-011
- ENG-012
- ENG-013
- ENG-015
- ENG-017
- ENG-026
- ENG-030
- ENG-031
- ENG-032
- ENG-033
- ENG-035
- ENG-038
- ENG-040
- ENG-041
- ENG-042
- ENG-043
- ENG-044
- ENG-045
- ENG-046
- ENG-047
- ENG-048
- ENG-052
- ENG-053
- ENG-054
- ENG-056
- ENG-061
responsable: MEF Engineering Team
subcategoria: Extension & Plugin Engineering
tipo: Engineering
titulo: Extension & Plugin Engineering
ultima_revision: 2026-08-13
version: 1.0.0
---

# ENG-060

# Extension & Plugin Engineering

## Estado

Accepted.

------------------------------------------------------------------------

# 1. Propósito

Definir el modelo de **Plugin Engineering** de **MEF (Modular Enterprise
Framework)**.

ENG-060 establece las reglas para:

``` text
Extension
Plugin
Extension Point
Extension Contract
Extension Semantic
Plugin Contract

Plugin Identity
Plugin Manifest
Plugin Metadata
Plugin Dependencies

Plugin Installation
Plugin Registration
Plugin Activation
Plugin Deactivation
Plugin Uninstallation

Plugin Permissions
Plugin Trust
Plugin Signature
Plugin Integrity

Plugin Isolation
Plugin Sandbox

Plugin Failure
Plugin Quarantine
Plugin Recovery

Plugin Upgrade
Plugin Migration
Plugin Deprecation
```

------------------------------------------------------------------------

# 2. Declaración

> **Toda extensión de MEF deberá incorporarse mediante Extension Points
> y Contracts explícitos, poseer identidad, versión, Metadata, Trust,
> Permissions y Lifecycle conocidos, y ser validada antes de su
> activación. Ningún Plugin deberá obtener acceso implícito a internals,
> Container, Registry, Secrets, Tenant Data o recursos privilegiados
> únicamente por estar instalado.**

Arquitectura conceptual:

``` text
                    MEF CORE
                       │
                       ▼
                EXTENSION POINT
                       │
                       ▼
               EXTENSION CONTRACT
                       │
                       ▼
                    PLUGIN
                       │
        ┌──────────────┼──────────────┐
        ▼              ▼              ▼
     MANIFEST       PERMISSIONS      TRUST
        │              │              │
        └──────────────┼──────────────┘
                       ▼
                   VALIDATION
                       │
                       ▼
                  REGISTRATION
                       │
                       ▼
                   ACTIVATION
                       │
                       ▼
                    RUNTIME
```

------------------------------------------------------------------------

# 3. Relación con Extension Engineering

ENG-029 define el modelo base de Extension Engineering.

ENG-060 consume dicho modelo para proporcionar Plugin Engineering.

``` text
EXTENSION POINT
ENG-029
      │
      ▼
EXTENSION CONTRACT
ENG-029
      │
      ▼
PLUGIN
ENG-060
      │
      ▼
INSTALL / VALIDATE / ACTIVATE
ENG-060
```

------------------------------------------------------------------------

# 4. Extension

Una `Extension` es una implementación que amplía comportamiento mediante
un Extension Point soportado.

------------------------------------------------------------------------

# 5. Plugin

Un `Plugin` es una unidad empaquetada de extensibilidad que puede
proporcionar una o más Extensions.

Conceptualmente:

``` text
Plugin
├── identity
├── manifest
├── version
├── extensions
├── dependencies
├── permissions
├── configuration
└── lifecycle
```

------------------------------------------------------------------------

# 6. Extension ≠ Plugin

``` text
Plugin
   │
   ├── Extension A
   ├── Extension B
   └── Extension C
```

Un Plugin puede contener múltiples Extensions.

------------------------------------------------------------------------

# 7. Plugin ≠ Module

Un Module pertenece a la composición arquitectónica de una Application.

Un Plugin representa extensibilidad controlada.

Un Plugin podrá contener o utilizar Modules cuando el Contract lo
permita.

------------------------------------------------------------------------

# 8. Plugin ≠ Package

Un Package es una unidad de distribución.

Un Plugin es una unidad semántica de extensión.

------------------------------------------------------------------------

# 9. Plugin ≠ Service

Un Plugin puede proporcionar Services.

No todo Service es Plugin.

------------------------------------------------------------------------

# 10. Plugin ≠ Arbitrary Code Injection

Instalar un Plugin no deberá equivaler a ejecutar código arbitrario sin
control.

------------------------------------------------------------------------

# 11. Extension Point

Un `Extension Point` define dónde MEF permite extensión.

Ejemplos:

``` text
serializer
validator
transport
command
event subscriber
authentication provider
storage adapter
workflow action
metadata provider
```

------------------------------------------------------------------------

# 12. Closed by Default

Todo punto no declarado explícitamente como Extension Point deberá
considerarse cerrado a extensiones.

------------------------------------------------------------------------

# 13. Extension Point Identifier

Deberá poseer identificador estable.

Ejemplo:

``` text
mef.extension.serializer
mef.extension.validator
mef.extension.transport
```

------------------------------------------------------------------------

# 14. Extension Point Contract

Deberá definir:

``` text
identifier
contract
supported versions
multiplicity
resolution strategy
lifecycle
permissions
failure policy
```

------------------------------------------------------------------------

# 15. Extension Contract

Define qué debe implementar una Extension.

------------------------------------------------------------------------

# 16. Contract Stability

Deberá seguir ENG-021 y ENG-016.

------------------------------------------------------------------------

# 17. Internal API

Una API interna no deberá convertirse automáticamente en Extension
Contract.

------------------------------------------------------------------------

# 18. Public Extension API

Solo APIs declaradas como extensibles deberán considerarse estables para
Plugins.

------------------------------------------------------------------------

# 19. Plugin Identifier

Todo Plugin deberá poseer ID globalmente estable dentro de su
ecosistema.

Ejemplo:

``` text
vendor.product.plugin
```

------------------------------------------------------------------------

# 20. Plugin Namespace

Deberá utilizar Namespace que evite colisiones.

Ejemplo:

``` text
org.example.analytics
com.vendor.transport.kafka
```

------------------------------------------------------------------------

# 21. Reserved Namespace

Namespaces reservados de MEF no deberán utilizarse por terceros.

------------------------------------------------------------------------

# 22. Plugin Manifest

Todo Plugin deberá poseer Manifest explícito.

Conceptualmente:

``` text
PluginManifest
├── id
├── name
├── version
├── apiVersion
├── provider
├── extensions
├── dependencies
├── capabilities
├── permissions
├── configuration
└── integrity
```

------------------------------------------------------------------------

# 23. Manifest Validation

Deberá realizarse antes de Registration.

------------------------------------------------------------------------

# 24. Manifest Schema

Deberá versionarse.

------------------------------------------------------------------------

# 25. Manifest Immutability

Manifest correspondiente a un Artifact publicado no deberá mutar
silenciosamente.

------------------------------------------------------------------------

# 26. Plugin Metadata

Deberá seguir ENG-057.

------------------------------------------------------------------------

# 27. Plugin Version

Deberá seguir ENG-014.

------------------------------------------------------------------------

# 28. Plugin API Version

Deberá distinguirse de Plugin Version.

Ejemplo:

``` text
pluginVersion = 3.4.1
apiVersion = 2
```

------------------------------------------------------------------------

# 29. Plugin Compatibility

Deberá evaluarse antes de Activation.

Podrá incluir:

``` text
MEF version
Plugin API version
Extension Contract version
Runtime version
Platform
Dependencies
Schema versions
```

------------------------------------------------------------------------

# 30. Incompatible Plugin

No deberá activarse.

------------------------------------------------------------------------

# 31. Compatibility Override

Solo deberá permitirse mediante mecanismo administrativo explícito y
nunca deberá omitir controles críticos de seguridad.

------------------------------------------------------------------------

# 32. Plugin Capability

Representa funcionalidad declarada.

Ejemplos:

``` text
serializer.json
transport.kafka
storage.redis
authentication.oidc
```

------------------------------------------------------------------------

# 33. Capability Validation

Las Capabilities deberán corresponder a Extensions realmente
registradas.

------------------------------------------------------------------------

# 34. Plugin Discovery

Deberá utilizar ENG-058.

------------------------------------------------------------------------

# 35. Discovery Sources

Podrán incluir:

``` text
installed package registry
plugin directory
generated index
application manifest
trusted repository
```

------------------------------------------------------------------------

# 36. Discovery ≠ Activation

Descubrir un Plugin no deberá ejecutarlo.

------------------------------------------------------------------------

# 37. Plugin Candidate

Un Plugin descubierto deberá permanecer Candidate hasta completar
Validation.

------------------------------------------------------------------------

# 38. Plugin Validation

Deberá comprobar como mínimo:

``` text
manifest
identity
version
compatibility
dependencies
extension contracts
permissions
integrity
trust
configuration schema
```

------------------------------------------------------------------------

# 39. Validation Before Code Execution

Cuando la plataforma lo permita, la mayor cantidad posible de Validation
deberá ocurrir antes de cargar código ejecutable.

------------------------------------------------------------------------

# 40. Plugin Registration

Solo Plugins validados podrán registrarse.

------------------------------------------------------------------------

# 41. Registration ≠ Activation

Un Plugin registrado podrá permanecer inactivo.

------------------------------------------------------------------------

# 42. Plugin Resolution

ENG-059 determinará qué Extension aplicar cuando existan múltiples
Candidates.

------------------------------------------------------------------------

# 43. Resolution Determinism

No deberá depender de:

``` text
installation order
filesystem order
package manager order
reflection order
```

------------------------------------------------------------------------

# 44. Plugin Dependency

Un Plugin podrá declarar Dependencies explícitas.

Ejemplos:

``` text
plugin dependency
MEF capability
extension contract
module
runtime capability
```

------------------------------------------------------------------------

# 45. Hidden Dependency

Queda prohibida como diseño intencional.

------------------------------------------------------------------------

# 46. Dependency Version

Deberá declarar Constraint compatible.

------------------------------------------------------------------------

# 47. Optional Dependency

Deberá marcarse explícitamente.

------------------------------------------------------------------------

# 48. Dependency Graph

Deberá poder construirse antes de Activation.

------------------------------------------------------------------------

# 49. Dependency Cycle

Deberá detectarse.

------------------------------------------------------------------------

# 50. Missing Dependency

Deberá impedir Activation cuando sea requerida.

------------------------------------------------------------------------

# 51. Transitive Dependency

No deberá conceder Permissions automáticamente.

------------------------------------------------------------------------

# 52. Plugin Installation

Representa incorporación del Artifact al entorno.

------------------------------------------------------------------------

# 53. Installation Stages

Conceptualmente:

``` text
Acquire
  │
  ▼
Verify
  │
  ▼
Inspect Manifest
  │
  ▼
Validate
  │
  ▼
Install
  │
  ▼
Register
```

------------------------------------------------------------------------

# 54. Installation ≠ Activation

Deberán permanecer separadas.

------------------------------------------------------------------------

# 55. Plugin Activation

Habilita ejecución.

------------------------------------------------------------------------

# 56. Activation Preconditions

Podrán incluir:

``` text
installed
registered
validated
compatible
dependencies satisfied
permissions granted
configuration valid
runtime ready
```

------------------------------------------------------------------------

# 57. Activation Atomicity

No deberá dejar Plugin parcialmente activo.

------------------------------------------------------------------------

# 58. Plugin Deactivation

Detiene participación del Plugin.

------------------------------------------------------------------------

# 59. Deactivation Contract

Deberá permitir:

``` text
stop accepting work
drain active work
release resources
unregister hooks
flush state if required
```

------------------------------------------------------------------------

# 60. Plugin Uninstallation

Elimina Artifact y Registration persistente.

------------------------------------------------------------------------

# 61. Uninstallation Preconditions

Deberá comprobar:

``` text
inactive
no required dependents
migration state
resource cleanup
persistent data policy
```

------------------------------------------------------------------------

# 62. Persistent Data

La desinstalación no deberá destruir Data automáticamente salvo Contract
explícito.

------------------------------------------------------------------------

# 63. Plugin Lifecycle

Deberá integrarse con ENG-055.

Estados conceptuales:

``` text
DISCOVERED
    │
    ▼
VALIDATED
    │
    ▼
INSTALLED
    │
    ▼
REGISTERED
    │
    ▼
ACTIVATING
    │
    ▼
ACTIVE
    │
    ▼
DEACTIVATING
    │
    ▼
INACTIVE
    │
    ▼
UNINSTALLED
```

Estados adicionales:

``` text
FAILED
QUARANTINED
INCOMPATIBLE
DISABLED
```

------------------------------------------------------------------------

# 64. Illegal Transition

Deberá rechazarse.

------------------------------------------------------------------------

# 65. Plugin State

Estado operacional deberá seguir ENG-053.

------------------------------------------------------------------------

# 66. Plugin Configuration

Deberá seguir ENG-049.

------------------------------------------------------------------------

# 67. Configuration Schema

Todo Plugin configurable deberá declarar Schema.

------------------------------------------------------------------------

# 68. Configuration Namespace

Deberá estar aislado por Plugin ID.

Ejemplo:

``` text
plugins.org.example.analytics.*
```

------------------------------------------------------------------------

# 69. Configuration Secrets

Deberán utilizar mecanismo de Secrets correspondiente, no Metadata.

------------------------------------------------------------------------

# 70. Plugin Isolation

Deberá limitar impacto del Plugin sobre Core y otros Plugins.

------------------------------------------------------------------------

# 71. Isolation Levels

Podrán incluir:

``` text
CONTRACT
NAMESPACE
DEPENDENCY
PERMISSION
RESOURCE
PROCESS
CONTAINER
SANDBOX
```

------------------------------------------------------------------------

# 72. Minimum Isolation

La primera implementación deberá garantizar al menos:

``` text
contract isolation
namespace isolation
dependency isolation
permission isolation
```

------------------------------------------------------------------------

# 73. Plugin Sandbox

Podrá utilizarse cuando la plataforma soporte aislamiento efectivo.

------------------------------------------------------------------------

# 74. Sandbox ≠ Permission Model

Sandbox y Permissions son controles complementarios.

------------------------------------------------------------------------

# 75. Plugin Permission

Todo acceso privilegiado deberá requerir Permission explícita.

Ejemplos:

``` text
network.outbound
filesystem.read
filesystem.write
database.read
database.write
events.publish
commands.register
secrets.read
tenant.access
```

------------------------------------------------------------------------

# 76. Least Privilege

Plugins deberán recibir únicamente Permissions necesarias.

------------------------------------------------------------------------

# 77. Permission Declaration

Deberá formar parte del Manifest.

------------------------------------------------------------------------

# 78. Permission Grant

Declarar Permission no implica obtenerla.

------------------------------------------------------------------------

# 79. Permission Authority

La concesión deberá depender de Authority confiable.

------------------------------------------------------------------------

# 80. Permission Escalation

Un Plugin no deberá ampliar sus propias Permissions.

------------------------------------------------------------------------

# 81. Transitive Permission

No deberá heredarse automáticamente entre Plugins.

------------------------------------------------------------------------

# 82. Runtime Permission Check

Operaciones sensibles deberán comprobar Permission cuando corresponda.

------------------------------------------------------------------------

# 83. Plugin Trust

Trust deberá distinguirse de Permissions.

------------------------------------------------------------------------

# 84. Trust Levels

Podrán ser:

``` text
CORE
TRUSTED
SIGNED
VERIFIED
LOCAL
UNTRUSTED
```

------------------------------------------------------------------------

# 85. Trust ≠ Capability

Un Plugin confiable no obtiene automáticamente todas las Capabilities.

------------------------------------------------------------------------

# 86. Plugin Signature

Artifacts podrán requerir firma criptográfica.

------------------------------------------------------------------------

# 87. Signature Verification

Deberá realizarse antes de Activation cuando sea obligatoria.

------------------------------------------------------------------------

# 88. Plugin Integrity

Podrá verificarse mediante:

``` text
hash
signature
artifact digest
manifest digest
```

------------------------------------------------------------------------

# 89. Integrity Failure

Deberá impedir Activation.

------------------------------------------------------------------------

# 90. Plugin Origin

Deberá poder registrarse procedencia.

Ejemplos:

``` text
core distribution
official repository
private repository
local installation
external package
```

------------------------------------------------------------------------

# 91. Origin ≠ Trust

Procedencia deberá contribuir al Trust Model, no sustituirlo.

------------------------------------------------------------------------

# 92. Extension Registration

Cada Extension deberá registrarse contra un Extension Point conocido.

------------------------------------------------------------------------

# 93. Unknown Extension Point

Deberá rechazarse o mantenerse incompatible.

------------------------------------------------------------------------

# 94. Extension Contract Validation

Deberá comprobar que Implementation satisface Contract.

------------------------------------------------------------------------

# 95. Multiplicity

Extension Point deberá declarar:

``` text
SINGLE
OPTIONAL_SINGLE
MULTIPLE
CHAIN
```

------------------------------------------------------------------------

# 96. Multiple Extensions

Deberán resolverse mediante ENG-059.

------------------------------------------------------------------------

# 97. Extension Priority

Deberá ser explícita cuando exista.

------------------------------------------------------------------------

# 98. Extension Ordering

No deberá depender de Installation Order.

------------------------------------------------------------------------

# 99. Plugin Hook

Un Hook representa punto controlado de invocación.

------------------------------------------------------------------------

# 100. Hook Contract

Deberá definir:

``` text
input
output
ordering
timeout
failure policy
side effects
```

------------------------------------------------------------------------

# 101. Hook Execution

No deberá otorgar acceso adicional fuera del Contract.

------------------------------------------------------------------------

# 102. Hook Failure

Deberá seguir Failure Policy explícita.

Podrá ser:

``` text
FAIL
IGNORE
ISOLATE
RETRY
QUARANTINE
```

------------------------------------------------------------------------

# 103. Hook Timeout

Deberá existir cuando un Plugin pueda bloquear flujo crítico.

------------------------------------------------------------------------

# 104. Plugin Event

Podrá consumir o publicar Events mediante ENG-022.

------------------------------------------------------------------------

# 105. Event Permission

Publicación y suscripción podrán requerir Permissions.

------------------------------------------------------------------------

# 106. Plugin Command

Podrá registrar Commands cuando Extension Point lo permita.

------------------------------------------------------------------------

# 107. Command Namespace

Deberá evitar colisiones.

Ejemplo:

``` text
plugin:<plugin-id>:<command>
```

------------------------------------------------------------------------

# 108. Plugin API

Core deberá exponer API mínima y explícita a Plugins.

------------------------------------------------------------------------

# 109. Internal Core Access

No deberá considerarse API soportada.

------------------------------------------------------------------------

# 110. API Capability Model

Podrá proporcionar Handles limitados:

``` text
Logger
EventPublisher
ConfigurationReader
StorageHandle
HttpClient
Metrics
Clock
```

en lugar de acceso directo al Container completo.

------------------------------------------------------------------------

# 111. Container Exposure

El Service Container completo no deberá entregarse a Plugins por
defecto.

------------------------------------------------------------------------

# 112. Registry Exposure

Registry mutable completo no deberá entregarse a Plugins por defecto.

------------------------------------------------------------------------

# 113. Secret Access

Deberá utilizar Handle o Capability específica.

------------------------------------------------------------------------

# 114. Filesystem Access

Deberá limitar Roots y Operations.

------------------------------------------------------------------------

# 115. Network Access

Podrá limitar:

``` text
protocols
hosts
ports
destinations
```

cuando la plataforma lo permita.

------------------------------------------------------------------------

# 116. Database Access

Deberá favorecer interfaces acotadas sobre acceso irrestricto.

------------------------------------------------------------------------

# 117. Tenant Access

Deberá respetar ENG-048.

------------------------------------------------------------------------

# 118. Cross-Tenant Plugin

Deberá requerir Contract y Permission explícitos.

------------------------------------------------------------------------

# 119. Resource Usage

ENG-054 deberá gobernar recursos consumidos.

------------------------------------------------------------------------

# 120. Plugin Resource Limits

Podrán incluir:

``` text
memory
cpu
threads
connections
queue depth
storage
execution time
```

según plataforma.

------------------------------------------------------------------------

# 121. Resource Exhaustion

Un Plugin no deberá poder agotar recursos compartidos sin límites cuando
éstos sean controlables.

------------------------------------------------------------------------

# 122. Plugin Concurrency

Deberá declarar Thread/Concurrency Safety cuando corresponda.

------------------------------------------------------------------------

# 123. Plugin Background Work

Deberá utilizar ENG-040.

------------------------------------------------------------------------

# 124. Detached Work

Un Plugin no deberá crear Background Work fuera del Scheduler
administrado cuando exista mecanismo oficial.

------------------------------------------------------------------------

# 125. Plugin Messaging

Deberá utilizar ENG-041.

------------------------------------------------------------------------

# 126. Plugin Transactions

Deberá respetar ENG-042.

------------------------------------------------------------------------

# 127. Plugin Data Access

Deberá seguir ENG-043.

------------------------------------------------------------------------

# 128. Plugin API Extensions

Deberán seguir ENG-044.

------------------------------------------------------------------------

# 129. Authentication Plugin

Deberá seguir ENG-045.

------------------------------------------------------------------------

# 130. Authorization Plugin

Deberá seguir ENG-046.

------------------------------------------------------------------------

# 131. IAM Plugin

Deberá seguir ENG-047.

------------------------------------------------------------------------

# 132. Plugin Failure

Deberá aislarse cuando sea posible.

------------------------------------------------------------------------

# 133. Failure Categories

Podrán incluir:

``` text
VALIDATION
COMPATIBILITY
ACTIVATION
RUNTIME
DEPENDENCY
PERMISSION
RESOURCE
SECURITY
MIGRATION
```

------------------------------------------------------------------------

# 134. Plugin Failure ≠ Core Failure

Un Plugin no crítico no deberá provocar caída completa del Framework
cuando pueda aislarse.

------------------------------------------------------------------------

# 135. Critical Plugin

Podrá declararse cuando Application no pueda operar sin él.

------------------------------------------------------------------------

# 136. Criticality

Deberá ser explícita.

------------------------------------------------------------------------

# 137. Plugin Quarantine

Permite impedir ejecución de Plugin inseguro o repetidamente defectuoso.

------------------------------------------------------------------------

# 138. Quarantine Triggers

Podrán incluir:

``` text
integrity failure
signature failure
security violation
repeated crashes
invalid migration
permission violation
```

------------------------------------------------------------------------

# 139. Quarantine State

Un Plugin en Quarantine no deberá activarse automáticamente.

------------------------------------------------------------------------

# 140. Quarantine Recovery

Deberá requerir Validation y acción autorizada.

------------------------------------------------------------------------

# 141. Automatic Recovery

Solo deberá utilizarse para fallas transitorias conocidas.

------------------------------------------------------------------------

# 142. Plugin Recovery

Podrá incluir:

``` text
restart
reload
rollback
disable
quarantine
```

------------------------------------------------------------------------

# 143. Plugin Upgrade

Deberá seguir Versioning y Compatibility.

------------------------------------------------------------------------

# 144. Upgrade Stages

Conceptualmente:

``` text
Acquire New Version
       │
       ▼
Verify
       │
       ▼
Compatibility Check
       │
       ▼
Migration Plan
       │
       ▼
Deactivate Old
       │
       ▼
Migrate
       │
       ▼
Activate New
       │
       ▼
Validate
```

------------------------------------------------------------------------

# 145. Upgrade Atomicity

Deberá evitar estado parcialmente actualizado.

------------------------------------------------------------------------

# 146. Plugin Rollback

Deberá definirse cuando Upgrade pueda fallar.

------------------------------------------------------------------------

# 147. Rollback Compatibility

No deberá asumirse que Data Migration sea reversible.

------------------------------------------------------------------------

# 148. Plugin Migration

Deberá existir cuando cambie State o Data persistente.

------------------------------------------------------------------------

# 149. Migration Ownership

Cada Plugin deberá ser responsable de sus propias Migrations dentro de
Boundaries autorizados.

------------------------------------------------------------------------

# 150. Cross-Plugin Migration

Deberá evitarse.

------------------------------------------------------------------------

# 151. Migration Ordering

Deberá derivarse de Dependencies explícitas.

------------------------------------------------------------------------

# 152. Migration Failure

Deberá impedir Activation de versión inconsistente.

------------------------------------------------------------------------

# 153. Plugin Deprecation

Podrá marcar:

``` text
deprecated
since
replacement
removalVersion
reason
```

------------------------------------------------------------------------

# 154. Extension Point Deprecation

Deberá seguir Compatibility Policy.

------------------------------------------------------------------------

# 155. Removal

No deberá ocurrir sin respetar ventana de Deprecation definida.

------------------------------------------------------------------------

# 156. Plugin Security

ENG-024 gobernará Security general.

------------------------------------------------------------------------

# 157. Security Boundary

Plugins de terceros deberán considerarse Boundary de Trust.

------------------------------------------------------------------------

# 158. Plugin Input

Deberá validarse.

------------------------------------------------------------------------

# 159. Plugin Output

No deberá asumirse confiable automáticamente.

------------------------------------------------------------------------

# 160. Plugin Privilege

Deberá limitarse por Capability y Permission.

------------------------------------------------------------------------

# 161. Plugin Code Execution

Deberá ocurrir únicamente después de Validation requerida.

------------------------------------------------------------------------

# 162. Supply Chain Security

Deberá considerar:

``` text
artifact origin
dependency integrity
manifest integrity
signature
version pinning
repository trust
```

------------------------------------------------------------------------

# 163. Dependency Confusion

Namespaces y Sources deberán evitar resolución accidental desde
repositorios no autorizados.

------------------------------------------------------------------------

# 164. Plugin Update Source

Deberá permanecer vinculado a Source confiable.

------------------------------------------------------------------------

# 165. Plugin Audit

Operaciones sensibles deberán poder auditarse.

Ejemplos:

``` text
plugin installed
plugin activated
plugin deactivated
plugin upgraded
plugin removed
permission granted
permission revoked
plugin quarantined
plugin recovered
```

------------------------------------------------------------------------

# 166. Audit Record

Podrá contener:

``` text
pluginId
version
operation
actor
result
reason
timestamp
```

------------------------------------------------------------------------

# 167. Audit Secrets

No deberán registrarse.

------------------------------------------------------------------------

# 168. Plugin Observability

ENG-025 gobernará Telemetry.

------------------------------------------------------------------------

# 169. Metrics

Podrán incluir:

``` text
mef.plugin.installed
mef.plugin.active
mef.plugin.activation.total
mef.plugin.activation.failure.total
mef.plugin.failure.total
mef.plugin.quarantine.total
mef.plugin.hook.duration
mef.plugin.permission.denied.total
```

------------------------------------------------------------------------

# 170. Metric Labels

Podrán incluir Labels acotados:

``` text
extensionPoint
operation
result
failureType
```

------------------------------------------------------------------------

# 171. Plugin ID as Metric Label

Deberá evitarse cuando pueda generar Cardinality no controlada.

------------------------------------------------------------------------

# 172. Plugin Logs

Deberán identificar Source del log sin permitir spoofing del Core
Logger.

------------------------------------------------------------------------

# 173. Plugin Trace

Podrá participar en Trace mediante Context controlado.

------------------------------------------------------------------------

# 174. Trace Mutation

No deberá permitir sobrescribir identidad o Security Context
arbitrariamente.

------------------------------------------------------------------------

# 175. Plugin Diagnostics

Deberá poder responder:

``` text
is plugin installed?
is plugin compatible?
is plugin active?
which extensions does it provide?
which permissions were requested?
which permissions were granted?
why did activation fail?
is it quarantined?
which dependencies are missing?
```

------------------------------------------------------------------------

# 176. Testing

ENG-009 gobernará Testing.

------------------------------------------------------------------------

# 177. Manifest Test

Deberá validar Manifests correctos e incorrectos.

------------------------------------------------------------------------

# 178. Identity Test

Deberá detectar Plugin ID duplicado.

------------------------------------------------------------------------

# 179. Compatibility Test

Deberá probar:

``` text
MEF version
API version
contract version
dependency version
```

------------------------------------------------------------------------

# 180. Dependency Test

Deberá probar:

``` text
required
optional
missing
incompatible
cycle
```

------------------------------------------------------------------------

# 181. Permission Test

Deberá comprobar Least Privilege.

------------------------------------------------------------------------

# 182. Permission Escalation Test

Plugin no deberá auto-concederse Permission.

------------------------------------------------------------------------

# 183. Isolation Test

Deberá comprobar que Plugin no accede a internals no autorizados.

------------------------------------------------------------------------

# 184. Lifecycle Test

Deberá cubrir:

``` text
install
register
activate
deactivate
uninstall
fail
quarantine
recover
```

------------------------------------------------------------------------

# 185. Activation Atomicity Test

Failure no deberá dejar Registration parcial.

------------------------------------------------------------------------

# 186. Hook Test

Deberá comprobar:

``` text
ordering
timeout
failure policy
short circuit
```

------------------------------------------------------------------------

# 187. Resolution Test

Múltiples Extensions deberán resolverse determinísticamente.

------------------------------------------------------------------------

# 188. Integrity Test

Deberá rechazar Artifact alterado.

------------------------------------------------------------------------

# 189. Signature Test

Cuando aplique deberá cubrir firma válida, inválida y ausente.

------------------------------------------------------------------------

# 190. Upgrade Test

Deberá cubrir:

``` text
compatible upgrade
incompatible upgrade
migration success
migration failure
rollback
```

------------------------------------------------------------------------

# 191. Quarantine Test

Deberá impedir reactivación automática.

------------------------------------------------------------------------

# 192. Resource Test

Deberá comprobar Limits cuando sean implementables.

------------------------------------------------------------------------

# 193. Tenant Isolation Test

Deberá comprobar que Plugin no cruza Tenant Boundary.

------------------------------------------------------------------------

# 194. Security Test

Deberá intentar:

``` text
manifest spoofing
plugin id collision
permission escalation
container escape
registry mutation
secret access
filesystem escape
network abuse
dependency confusion
unsigned artifact
cross-tenant access
```

------------------------------------------------------------------------

# 195. Architecture Test

Podrá impedir:

``` text
plugin direct core internals access
plugin full container access
plugin full mutable registry access
plugin execution before validation
implicit extension points
hidden plugin dependencies
installation-order resolution
```

------------------------------------------------------------------------

# 196. Build Integration

ENG-012 podrá validar:

``` text
manifest schema
plugin identifiers
duplicate extensions
unknown extension points
contract compatibility
dependency graph
dependency cycles
permission declarations
API compatibility
deprecated extension usage
```

------------------------------------------------------------------------

# 197. CLI

ENG-007 podrá proporcionar:

``` text
mef plugin:list
mef plugin:show
mef plugin:validate
mef plugin:install
mef plugin:activate
mef plugin:deactivate
mef plugin:remove
mef plugin:upgrade
mef plugin:permissions
mef plugin:dependencies
mef plugin:quarantine
mef plugin:diagnose
```

------------------------------------------------------------------------

# 198. `plugin:list`

Podrá mostrar:

``` text
id
version
status
trust
compatibility
```

------------------------------------------------------------------------

# 199. `plugin:show`

Podrá mostrar Manifest y Extensions.

------------------------------------------------------------------------

# 200. `plugin:validate`

Deberá validar sin activar.

------------------------------------------------------------------------

# 201. `plugin:install`

Deberá ejecutar Verification y Validation antes de Registration.

------------------------------------------------------------------------

# 202. `plugin:activate`

Deberá comprobar Preconditions.

------------------------------------------------------------------------

# 203. `plugin:deactivate`

Deberá respetar Lifecycle.

------------------------------------------------------------------------

# 204. `plugin:remove`

Deberá comprobar Dependents.

------------------------------------------------------------------------

# 205. `plugin:upgrade`

Deberá validar Compatibility y Migration Plan.

------------------------------------------------------------------------

# 206. `plugin:permissions`

Podrá mostrar:

``` text
requested
granted
denied
```

------------------------------------------------------------------------

# 207. `plugin:dependencies`

Podrá mostrar Dependency Graph.

------------------------------------------------------------------------

# 208. `plugin:quarantine`

Deberá requerir Authority adecuada.

------------------------------------------------------------------------

# 209. `plugin:diagnose`

Podrá mostrar:

``` text
identity
version
status
compatibility
extensions
dependencies
permissions
trust
integrity
failure
quarantine
```

------------------------------------------------------------------------

# 210. Registry Integration

ENG-020 podrá registrar:

``` text
ExtensionPoint
ExtensionDescriptor
PluginDescriptor
PluginProvider
PluginLifecycleHandler
```

------------------------------------------------------------------------

# 211. Extension Point Definition

Conceptualmente:

``` text
ExtensionPoint
├── id
├── contract
├── versions
├── multiplicity
├── resolutionStrategy
├── permissions
└── failurePolicy
```

------------------------------------------------------------------------

# 212. Plugin Descriptor

Conceptualmente:

``` text
PluginDescriptor
├── id
├── version
├── apiVersion
├── manifest
├── extensions
├── dependencies
├── permissions
├── trust
└── integrity
```

------------------------------------------------------------------------

# 213. Extension Descriptor

Conceptualmente:

``` text
ExtensionDescriptor
├── id
├── pluginId
├── extensionPoint
├── implementation
├── version
├── priority
└── metadata
```

------------------------------------------------------------------------

# 214. Plugin Permission Set

Conceptualmente:

``` text
PluginPermissionSet
├── requested
├── granted
├── denied
└── effective
```

------------------------------------------------------------------------

# 215. Plugin Runtime

Conceptualmente:

``` text
PluginRuntime
├── install
├── register
├── activate
├── deactivate
├── quarantine
├── recover
└── uninstall
```

------------------------------------------------------------------------

# 216. Plugin Context

Podrá proporcionar únicamente Handles autorizados.

Conceptualmente:

``` text
PluginContext
├── configuration
├── logger
├── events
├── metrics
├── resources
└── permittedCapabilities
```

------------------------------------------------------------------------

# 217. Plugin Context ≠ Container

No deberá proporcionar acceso irrestricto al Service Container.

------------------------------------------------------------------------

# 218. Bootstrap

ENG-027 deberá cargar Plugins después de establecer infraestructura
crítica.

------------------------------------------------------------------------

# 219. Bootstrap Flow

``` text
Core Configuration
       │
       ▼
Security
       │
       ▼
Metadata
       │
       ▼
Discovery
       │
       ▼
Extension Points
       │
       ▼
Plugin Discovery
       │
       ▼
Manifest Validation
       │
       ▼
Compatibility
       │
       ▼
Dependency Graph
       │
       ▼
Permission Evaluation
       │
       ▼
Registration
       │
       ▼
Activation
       │
       ▼
Runtime Ready
```

------------------------------------------------------------------------

# 220. Bootstrap Failure

Podrá impedir Readiness ante:

``` text
missing critical plugin
invalid critical plugin
incompatible critical plugin
critical dependency cycle
critical permission denial
critical activation failure
```

------------------------------------------------------------------------

# 221. Non-Critical Plugin Failure

No deberá impedir Readiness cuando pueda aislarse de forma segura.

------------------------------------------------------------------------

# 222. Plugin Activation Ordering

Deberá derivarse de Dependency Graph y Lifecycle Contracts.

------------------------------------------------------------------------

# 223. Installation Order

No deberá definir Activation Order.

------------------------------------------------------------------------

# 224. Shutdown

Plugins activos deberán desactivarse antes de destruir infraestructura
de la que dependen.

------------------------------------------------------------------------

# 225. Shutdown Ordering

Deberá respetar Dependencies en orden inverso cuando corresponda.

------------------------------------------------------------------------

# 226. Extension Point Ownership

Todo Extension Point deberá poseer Owner.

------------------------------------------------------------------------

# 227. Extension Point Stability

Deberá declarar:

``` text
EXPERIMENTAL
STABLE
DEPRECATED
INTERNAL
```

------------------------------------------------------------------------

# 228. Experimental Extension Point

Podrá cambiar con Compatibility Guarantees reducidas, documentadas
explícitamente.

------------------------------------------------------------------------

# 229. Internal Extension Point

No deberá exponerse a Plugins externos.

------------------------------------------------------------------------

# 230. Extension Contract Version

Deberá evolucionar independientemente cuando corresponda.

------------------------------------------------------------------------

# 231. Extension Contract Negotiation

Podrá resolver versión compatible antes de Activation.

------------------------------------------------------------------------

# 232. Multiple Contract Versions

Podrán coexistir temporalmente cuando sea necesario para Compatibility.

------------------------------------------------------------------------

# 233. Plugin Repository

Un repositorio de Plugins podrá existir en fases posteriores.

------------------------------------------------------------------------

# 234. Repository Trust

No deberá asumirse por disponibilidad.

------------------------------------------------------------------------

# 235. Plugin Distribution

Deberá conservar:

``` text
identity
version
manifest
integrity
origin
```

------------------------------------------------------------------------

# 236. Reproducible Installation

Cuando sea posible, una misma Lock Definition deberá producir mismo
conjunto de Plugins.

------------------------------------------------------------------------

# 237. Plugin Lock

Podrá registrar:

``` text
plugin id
version
artifact digest
source
dependencies
```

------------------------------------------------------------------------

# 238. Plugin Supply Chain

Deberá integrarse con Package Manager y Build System.

------------------------------------------------------------------------

# 239. Plugin Testing Kit

MEF podrá proporcionar un Kit para autores de Plugins.

Podrá incluir:

``` text
contract tests
manifest validator
compatibility validator
permission simulator
lifecycle harness
security checks
```

------------------------------------------------------------------------

# 240. Certification

Podrá existir un proceso posterior de Plugin Certification.

------------------------------------------------------------------------

# 241. Certification ≠ Trust Absolute

Un Plugin certificado seguirá sujeto a Permissions, Validation y Runtime
Controls.

------------------------------------------------------------------------

# 242. First Implementation Components

La primera implementación deberá incluir:

``` text
ExtensionPoint
ExtensionContract
ExtensionDescriptor

PluginId
PluginManifest
PluginDescriptor
PluginVersion

PluginDependency
PluginPermission
PluginPermissionSet

PluginValidator
PluginRegistry
PluginRuntime

PluginError
```

------------------------------------------------------------------------

# 243. Optional Initial Components

Podrán incorporarse:

``` text
PluginInstaller
PluginIntegrityVerifier
PluginSignatureVerifier
PluginQuarantine
PluginDiagnostics
PluginContext
```

------------------------------------------------------------------------

# 244. Later Components

Solo cuando exista necesidad demostrada:

``` text
PluginMarketplace
RemotePluginRepository
PluginCertification
ProcessSandbox
ContainerSandbox
DynamicHotReload
DistributedPluginRegistry
```

------------------------------------------------------------------------

# 245. Estructura Conceptual de Directorios

``` text
src/
└── Extension/
    ├── Contract/
    │   ├── ExtensionPoint
    │   └── ExtensionContract
    │
    ├── Descriptor/
    │   └── ExtensionDescriptor
    │
    ├── Plugin/
    │   ├── PluginId
    │   ├── PluginManifest
    │   ├── PluginDescriptor
    │   └── PluginVersion
    │
    ├── Dependency/
    │   └── PluginDependency
    │
    ├── Permission/
    │   ├── PluginPermission
    │   └── PluginPermissionSet
    │
    ├── Validation/
    │   └── PluginValidator
    │
    ├── Registry/
    │   └── PluginRegistry
    │
    ├── Runtime/
    │   ├── PluginRuntime
    │   └── PluginContext
    │
    ├── Security/
    │   ├── PluginIntegrityVerifier
    │   └── PluginSignatureVerifier
    │
    ├── Lifecycle/
    │   └── PluginQuarantine
    │
    ├── Diagnostics/
    │   └── PluginDiagnostics
    │
    └── Error/
        └── PluginError
```

La estructura física definitiva deberá obedecer ENG-006.

------------------------------------------------------------------------

# 246. Error Namespace

ENG-060 utilizará:

``` text
MEF-PLUGIN-xxx
```

------------------------------------------------------------------------

# 247. Taxonomía ENG-060

``` text
MEF-PLUGIN-001 Plugin identifier invalid
MEF-PLUGIN-002 Plugin identifier duplicate
MEF-PLUGIN-003 Plugin manifest invalid
MEF-PLUGIN-004 Plugin manifest version unsupported
MEF-PLUGIN-005 Plugin incompatible
MEF-PLUGIN-006 Plugin dependency missing
MEF-PLUGIN-007 Plugin dependency incompatible
MEF-PLUGIN-008 Plugin dependency cycle
MEF-PLUGIN-009 Extension point unknown
MEF-PLUGIN-010 Extension contract incompatible
MEF-PLUGIN-011 Extension duplicate
MEF-PLUGIN-012 Plugin permission invalid
MEF-PLUGIN-013 Plugin permission denied
MEF-PLUGIN-014 Plugin permission escalation
MEF-PLUGIN-015 Plugin trust violation
MEF-PLUGIN-016 Plugin signature invalid
MEF-PLUGIN-017 Plugin integrity violation
MEF-PLUGIN-018 Plugin installation failed
MEF-PLUGIN-019 Plugin activation failed
MEF-PLUGIN-020 Plugin deactivation failed
MEF-PLUGIN-021 Plugin uninstall failed
MEF-PLUGIN-022 Plugin upgrade failed
MEF-PLUGIN-023 Plugin migration failed
MEF-PLUGIN-024 Plugin quarantined
MEF-PLUGIN-025 Plugin resource limit exceeded
MEF-PLUGIN-026 Plugin lifecycle violation
MEF-PLUGIN-027 Plugin tenant violation
MEF-PLUGIN-028 Plugin security violation
MEF-PLUGIN-029 Plugin runtime failure
MEF-PLUGIN-030 Plugin invariant violation
```

------------------------------------------------------------------------

# 248. First Implementation Constraints

La primera implementación deberá favorecer:

``` text
Explicit Extension Points
Stable Extension Contracts
Plugin Identity
Plugin Manifest
Versioning
Compatibility

Discovery Without Execution
Validation Before Activation
Dependency Graph
Deterministic Resolution

Explicit Permissions
Least Privilege
Trust Separation
Integrity Verification

Lifecycle
Atomic Activation
Controlled Deactivation
Failure Isolation
Quarantine

Configuration Isolation
Namespace Isolation
Tenant Isolation
Diagnostics
Testing
```

------------------------------------------------------------------------

# 249. First Version Non-Goals

No deberá requerir:

``` text
Plugin Marketplace
Remote Plugin Repository
Plugin Certification Authority
Process Sandbox
Container Sandbox
Dynamic Hot Reload
Distributed Plugin Registry
```

------------------------------------------------------------------------

# 250. Second Phase

Podrá incorporar:

``` text
Signature Enforcement
Advanced Permission Model
Plugin Upgrade Automation
Plugin Migration Framework
Plugin Testing Kit
Repository Integration
```

------------------------------------------------------------------------

# 251. Third Phase

Solo cuando exista necesidad demostrada:

``` text
Plugin Marketplace
Certification
Remote Repository
Process Isolation
Container Isolation
Dynamic Hot Reload
Distributed Plugin Infrastructure
```

------------------------------------------------------------------------

# 252. Invariantes de Ingeniería

ENG-060 continúa la serie global `EI`.

  -----------------------------------------------------------------------
  ID                                  Invariante
  ----------------------------------- -----------------------------------
  EI-1146                             Toda extensión de MEF deberá
                                      incorporarse mediante Extension
                                      Point y Contract explícitos; todo
                                      punto no declarado extensible
                                      deberá permanecer cerrado por
                                      defecto.

  EI-1147                             Todo Plugin deberá poseer Identity,
                                      Namespace, Version, API Version,
                                      Manifest, Metadata, Dependencies,
                                      Capabilities, Permissions, Trust y
                                      Lifecycle conocidos antes de
                                      Activation.

  EI-1148                             Discovery, Installation,
                                      Registration y Activation deberán
                                      permanecer como fases distintas y
                                      descubrir o instalar un Plugin no
                                      deberá ejecutar automáticamente su
                                      código.

  EI-1149                             Todo Plugin deberá superar
                                      Manifest, Identity, Compatibility,
                                      Dependency, Contract, Permission,
                                      Integrity y Trust Validation
                                      requeridas antes de Activation.

  EI-1150                             Plugin Resolution deberá utilizar
                                      ENG-059 y no depender de
                                      Installation Order, Filesystem
                                      Order, Package Manager Order,
                                      Reflection Order o Registration
                                      Order accidental.

  EI-1151                             Toda Dependency de Plugin deberá
                                      declararse explícitamente,
                                      versionarse cuando corresponda y
                                      formar parte de un Dependency Graph
                                      validable; Hidden Dependencies y
                                      Cycles no controlados quedan
                                      prohibidos.

  EI-1152                             Todo acceso privilegiado de Plugin
                                      deberá requerir Permission
                                      explícita y concedida; Permissions
                                      no deberán heredarse
                                      transitivamente ni ampliarse por el
                                      propio Plugin.

  EI-1153                             Trust, Permissions, Capabilities,
                                      Priority y Compatibility deberán
                                      permanecer como conceptos separados
                                      y ningún nivel alto en uno de ellos
                                      deberá conceder automáticamente los
                                      demás.

  EI-1154                             Plugins no deberán recibir acceso
                                      irrestricto al Service Container,
                                      Registry mutable, Secrets,
                                      Filesystem, Network, Database o
                                      Tenant Data por defecto; deberán
                                      utilizar APIs o Handles acotados.

  EI-1155                             Plugin Lifecycle deberá seguir
                                      transiciones explícitas y
                                      Activation/Deactivation deberán
                                      evitar estados parciales, respetar
                                      Dependencies y liberar Resources de
                                      forma controlada.

  EI-1156                             Plugin Failure deberá aislarse
                                      cuando sea posible y un Plugin no
                                      crítico no deberá provocar
                                      indisponibilidad completa de MEF;
                                      violaciones graves podrán conducir
                                      a Quarantine.

  EI-1157                             Un Plugin en Quarantine no deberá
                                      reactivarse automáticamente y su
                                      Recovery deberá requerir Validation
                                      y Authority adecuadas.

  EI-1158                             Plugin Upgrade y Migration deberán
                                      validar Compatibility, Ordering y
                                      State antes de activar nueva
                                      versión y no deberán asumir que
                                      Data Migration es automáticamente
                                      reversible.

  EI-1159                             Plugins de terceros deberán
                                      considerarse Trust Boundaries; su
                                      Input, Output, Artifact Origin,
                                      Dependencies, Integrity y Signature
                                      deberán validarse conforme al
                                      riesgo.

  EI-1160                             Plugin Resource Usage, Background
                                      Work, Concurrency, Messaging,
                                      Transactions y Data Access deberán
                                      utilizar los subsistemas oficiales
                                      de MEF y no crear infraestructuras
                                      paralelas no gobernadas.

  EI-1161                             Tenant-Scoped Plugins deberán
                                      preservar aislamiento y ningún
                                      Plugin deberá acceder a otro Tenant
                                      sin Contract, Permission y
                                      Authorization explícitos.

  EI-1162                             Plugin Observability y Audit
                                      deberán permitir identificar
                                      Lifecycle, Failure, Permission
                                      Denials, Quarantine y Upgrade sin
                                      exponer Secrets ni introducir
                                      Cardinality no controlada.

  EI-1163                             Plugin Testing deberá cubrir
                                      Manifest, Identity, Compatibility,
                                      Dependencies, Permissions,
                                      Isolation, Lifecycle, Hooks,
                                      Resolution, Integrity, Upgrade,
                                      Quarantine, Resources, Tenant
                                      Isolation y Security.

  EI-1164                             Build y Architecture Tests deberán
                                      detectar Unknown Extension Points,
                                      Contract Incompatibility,
                                      Dependency Cycles, Hidden
                                      Dependencies, Full Container
                                      Access, Mutable Registry Exposure,
                                      Execution Before Validation y
                                      Installation-Order Resolution.

  EI-1165                             La primera implementación deberá
                                      priorizar Extension Points
                                      explícitos, Contracts estables,
                                      Manifest, Compatibility, Dependency
                                      Graph, Permissions, Trust,
                                      Validation, Deterministic
                                      Resolution, Lifecycle, Isolation y
                                      Failure Containment antes de
                                      introducir Marketplace, Remote
                                      Repository, Certification, Hot
                                      Reload o Distributed Plugin
                                      Infrastructure.
  -----------------------------------------------------------------------

------------------------------------------------------------------------

# 253. Continuidad de Invariantes

``` text
ENG-056 → EI-1066 a EI-1085
ENG-057 → EI-1086 a EI-1105
ENG-058 → EI-1106 a EI-1125
ENG-059 → EI-1126 a EI-1145
ENG-060 → EI-1146 a EI-1165
```

------------------------------------------------------------------------

# 254. Criterios de Conformidad

Una implementación será conforme con ENG-060 cuando:

-   defina Extension Points explícitos;
-   cierre por defecto los puntos no extensibles;
-   defina Extension Contracts;
-   identifique Plugins mediante Namespace estable;
-   requiera Manifest;
-   versione Manifest;
-   diferencie Plugin Version de API Version;
-   valide Compatibility;
-   descubra Plugins sin ejecutarlos;
-   diferencie Installation de Activation;
-   construya Dependency Graph;
-   detecte Dependency Cycles;
-   resuelva Extensions determinísticamente;
-   declare Permissions;
-   conceda Permissions explícitamente;
-   aplique Least Privilege;
-   diferencie Trust de Permissions;
-   valide Integrity;
-   controle Signature cuando aplique;
-   implemente Lifecycle;
-   active Plugins atómicamente;
-   permita Deactivation controlada;
-   aísle Failures;
-   implemente Quarantine;
-   proteja Core internals;
-   no exponga Container completo;
-   no exponga Registry mutable completo;
-   proteja Secrets;
-   preserve Tenant Isolation;
-   controle Resources;
-   gestione Upgrade y Migration;
-   permita Diagnostics;
-   audite operaciones sensibles;
-   pruebe Security.

------------------------------------------------------------------------

# 255. Riesgos

Deberán evitarse especialmente:

``` text
Arbitrary Code Injection
Implicit Extension Points
Internal API Coupling
Plugin ID Collision
Manifest Spoofing
Execution Before Validation
Installation Equals Activation
Hidden Dependencies
Dependency Cycles
Installation-Order Resolution
Permission Escalation
Transitive Permissions
Full Container Exposure
Mutable Registry Exposure
Secret Leakage
Filesystem Escape
Network Abuse
Dependency Confusion
Unsigned Critical Plugins
Cross-Tenant Access
Partial Activation
Uncontrolled Background Work
Resource Exhaustion
Unsafe Plugin Upgrade
Irreversible Migration Assumption
Automatic Quarantine Recovery
```

------------------------------------------------------------------------

# 256. Relación con ENG-058

``` text
PLUGIN ARTIFACTS
      │
      ▼
DISCOVERY
ENG-058
      │
      ▼
PLUGIN CANDIDATES
```

Discovery encuentra Plugins.

No los activa.

------------------------------------------------------------------------

# 257. Relación con ENG-059

``` text
PLUGIN CANDIDATES
       │
       ▼
EXTENSION CANDIDATES
       │
       ▼
RESOLUTION
ENG-059
       │
       ▼
EFFECTIVE EXTENSION
```

------------------------------------------------------------------------

# 258. Relación con ENG-055

Lifecycle gobierna:

``` text
installation
activation
deactivation
failure
quarantine
removal
```

------------------------------------------------------------------------

# 259. Relación con ENG-024

Security gobierna:

``` text
trust
permissions
integrity
isolation
supply chain
tenant boundary
```

------------------------------------------------------------------------

# 260. Relación con ENG-061

ENG-061 deberá formalizar **Interoperability Engineering**.

La separación será:

``` text
Extension & Plugin Engineering
→ How can MEF itself be extended?

Interoperability Engineering
→ How can MEF interact predictably
  with external systems, runtimes,
  protocols, formats and ecosystems?
```

ENG-061 deberá cubrir:

``` text
Interoperability
Interoperability Boundary
Interoperability Contract

External System
External Runtime
External Protocol
External Format

Adapter
Bridge
Gateway
Facade
Translator

Protocol Compatibility
Format Compatibility
Semantic Compatibility

Canonical Model
External Model
Model Mapping
Transformation

Version Negotiation
Capability Negotiation

Interoperability Profile
Interoperability Level

Boundary Validation
Boundary Normalization

Encoding
Character Set
Locale
Timezone
Units

External Error Mapping
External Identity Mapping

Interoperability Security
Interoperability Resilience
Interoperability Observability
Interoperability Testing
```

------------------------------------------------------------------------

# 260A. Frontera normativa Extension vs Plugin

ENG-029 --- Extension Engineering es autoritativo para el modelo general
de:

-   Extension;
-   Extension Point;
-   Extension Contract;
-   eligibility y ordering del contrato de extensión;
-   lifecycle contractual de Extension Points.

ENG-060 --- Extension & Plugin Engineering es autoritativo para la
unidad operativa empaquetada Plugin, incluyendo:

-   Plugin Artifact y Manifest;
-   installation y validation;
-   activation / deactivation;
-   isolation;
-   permissions y trust;
-   quarantine;
-   upgrade, migration y uninstall.

Cuando un concepto sea general de Extension, ENG-029 será autoritativo.
Cuando corresponda al artifact y lifecycle operativo de Plugin, ENG-060
será autoritativo.

------------------------------------------------------------------------

# 261. Principio Rector

> **MEF deberá ser extensible por diseño, pero no abierto por accidente.
> Toda extensión deberá atravesar Contracts, Validation, Compatibility,
> Permissions, Trust y Lifecycle explícitos antes de participar en
> Runtime, y ningún Plugin deberá obtener autoridad sobre Core, otros
> Plugins, Resources o Tenant Data más allá de las capacidades que le
> hayan sido expresamente concedidas.**

------------------------------------------------------------------------

# 262. Conclusión

**ENG-060 --- Extension & Plugin Engineering** formaliza la frontera de
extensibilidad de MEF.

La cadena completa queda:

``` text
PLUGIN ARTIFACT
      │
      ▼
  DISCOVERY
      │
      ▼
   MANIFEST
      │
      ▼
  VALIDATION
      │
      ├── Identity
      ├── Version
      ├── Compatibility
      ├── Dependencies
      ├── Permissions
      ├── Integrity
      └── Trust
      │
      ▼
 REGISTRATION
      │
      ▼
  RESOLUTION
      │
      ▼
  ACTIVATION
      │
      ▼
    RUNTIME
```

La seguridad queda:

``` text
PLUGIN
   │
   ▼
PLUGIN CONTEXT
   │
   ├── permitted configuration
   ├── permitted events
   ├── permitted resources
   ├── permitted services
   └── permitted capabilities
   │
   ▼
MEF CORE
```

y no:

``` text
PLUGIN
   │
   ▼
FULL SERVICE CONTAINER
   │
   ▼
EVERYTHING
```

La relación arquitectónica queda:

``` text
METADATA
ENG-057
   │
   ▼
DISCOVERY
ENG-058
   │
   ▼
RESOLUTION
ENG-059
   │
   ▼
EXTENSION / PLUGIN
ENG-060
```

La primera implementación deberá concentrarse en:

``` text
ExtensionPoint
ExtensionContract
ExtensionDescriptor

PluginId
PluginManifest
PluginDescriptor
PluginVersion

PluginDependency
PluginPermission
PluginPermissionSet

PluginValidator
PluginRegistry
PluginRuntime
PluginError
```

antes de incorporar:

``` text
Plugin Marketplace
Remote Plugin Repository
Plugin Certification
Process Sandbox
Container Sandbox
Dynamic Hot Reload
Distributed Plugin Registry
```

Con **ENG-060**, la serie global alcanza:

``` text
EI-1165
```

------------------------------------------------------------------------

# Referencias

## Arquitectura

-   ARQ-004 --- Modules
-   ARQ-006 --- Registry
-   ARQ-007 --- Service Container
-   ARQ-011 --- Contracts
-   ARQ-014 --- Framework Lifecycle
-   ARQ-016 --- Security

## Ingeniería

-   ENG-005 --- Nomenclatura
-   ENG-006 --- Estructura de Directorios
-   ENG-007 --- CLI
-   ENG-008 --- Generadores
-   ENG-009 --- Testing
-   ENG-012 --- Build System
-   ENG-014 --- Versionado
-   ENG-016 --- Compatibility
-   ENG-018 --- Dependency Injection
-   ENG-019 --- Service Container
-   ENG-020 --- Registry Engineering
-   ENG-021 --- Contracts Engineering
-   ENG-022 --- Event Bus Engineering
-   ENG-023 --- Error Handling
-   ENG-024 --- Security Engineering
-   ENG-025 --- Observability Engineering
-   ENG-027 --- Runtime Engineering
-   ENG-028 --- Module Engineering
-   ENG-034 --- Application Engineering
-   ENG-036 --- Validation Engineering
-   ENG-037 --- Caching Engineering
-   ENG-039 --- Resilience Engineering
-   ENG-040 --- Scheduling & Background Jobs Engineering
-   ENG-041 --- Messaging Engineering
-   ENG-042 --- Transaction Engineering
-   ENG-043 --- Data Access Engineering
-   ENG-044 --- API Engineering
-   ENG-045 --- Authentication Engineering
-   ENG-046 --- Authorization Engineering
-   ENG-047 --- Identity & Access Management Engineering
-   ENG-048 --- Multi-Tenancy Engineering
-   ENG-049 --- Configuration Management Engineering
-   ENG-050 --- Feature Management Engineering
-   ENG-051 --- Policy Engineering
-   ENG-053 --- State Management Engineering
-   ENG-054 --- Resource Management Engineering
-   ENG-055 --- Lifecycle Management Engineering
-   ENG-057 --- Metadata Engineering
-   ENG-058 --- Discovery Engineering
-   ENG-059 --- Resolution Engineering
-   ENG-061 --- Interoperability Engineering \`\`\`
