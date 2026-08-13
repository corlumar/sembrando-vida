---
id: ENG-029
titulo: Extension Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Runtime Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-003
  - ENG-005
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-024
  - ENG-027
  - ENG-028
  - ARQ-004
  - ARQ-011
  - ARQ-014
relacionados:
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-013
  - ENG-018
  - ENG-022
  - ENG-023
  - ENG-025
  - ENG-026
  - ENG-030
keywords:
  - extensions
  - extension-points
  - plugins
  - hooks
  - extensibility
  - contracts
  - modules
  - registry
  - runtime
  - compatibility
  - security
  - mef
---

# ENG-029

# Extension Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería para extender capacidades de **MEF (Modular Enterprise Framework)** y de sus Modules mediante mecanismos explícitos, versionados, compatibles y gobernados.

ENG-029 deberá establecer:

```text
qué es una Extension
qué es un Extension Point
quién publica Extension Points
quién puede implementar Extensions
cómo se registran
cómo se descubren
cómo se validan
cómo se ordenan
cómo participan en Lifecycle
cómo se autorizan
cómo se versionan
cómo se retiran
cómo se aíslan
```

La arquitectura fundamental será:

```text
                MODULE OWNER
                     │
                     ▼
              EXTENSION POINT
                     │
                     ▼
                  CONTRACT
                     │
          ┌──────────┼──────────┐
          ▼          ▼          ▼
      Extension A Extension B Extension C
          │          │          │
          └──────────┼──────────┘
                     ▼
                  Runtime
```

---

# 2. Declaración

La regla fundamental será:

> **Una Extension deberá ampliar comportamiento únicamente a través de Extension Points explícitamente publicados, sin depender de internals privados del componente extendido ni adquirir autoridad superior a la concedida por el Runtime.**

Por tanto:

```text
Module
   ↓
publishes
   ↓
Extension Point
   ↓
Contract
   ↓
Extension
```

y no:

```text
Extension
   ↓
reflect / patch / override internals
   ↓
Module
```

---

# 3. Extension

Una `Extension` es una implementación externa o separable que participa en un punto de extensión publicado.

Ejemplos conceptuales:

```text
PaymentProviderExtension
StorageAdapterExtension
ReportExporterExtension
AuthenticationProviderExtension
```

---

# 4. Extension Point

Un `Extension Point` es una frontera arquitectónica declarada por un Module o por MEF que permite incorporar comportamiento adicional.

---

# 5. Extension ≠ Module

Una Extension podrá estar contenida en un Module.

También podrá representar una capacidad especializada de un Package.

Pero conceptualmente:

```text
Extension
≠
Module
```

---

# 6. Extension ≠ Package

También:

```text
Extension
≠
Package
```

Un Package puede distribuir una o varias Extensions.

---

# 7. Extension Point Identity

Todo Extension Point público deberá poseer identidad estable.

Se recomienda un prefijo canónico:

```text
XP
```

si ENG-005 formaliza dicha nomenclatura.

Ejemplos conceptuales:

```text
XP-PAYMENT-PROVIDER-001
XP-REPORT-EXPORTER-001
XP-STORAGE-ADAPTER-001
```

---

# 8. Identity vs Version

Deberán mantenerse separados:

```text
id:
XP-REPORT-EXPORTER-001

version:
1.2.0
```

---

# 9. Extension Identity

Una Extension arquitectónicamente registrada deberá poseer identidad suficientemente estable.

Podrá utilizar un prefijo específico si ENG-005 lo formaliza.

Ejemplo conceptual:

```text
EXT-REPORT-PDF-001
```

---

# 10. Extension Point Owner

Todo Extension Point deberá poseer Owner.

Normalmente será:

```text
Module
```

o:

```text
Framework Core
```

---

# 11. Owner Responsibilities

El Owner será responsable de:

```text
Contract
Semantics
Version
Compatibility
Multiplicity
Ordering
Lifecycle
Security Policy
Deprecation
```

---

# 12. Extension Contract

Todo Extension Point deberá apoyarse en uno o más Contracts explícitos conforme ENG-021.

---

# 13. Contract Purpose

El Contract define qué puede esperar:

```text
Host
```

de:

```text
Extension
```

y viceversa cuando corresponda.

---

# 14. No Internal Contract

Una Extension pública no deberá depender de clases privadas del Module Host.

---

# 15. Host

El `Host` es el Module o Runtime que publica y consume el Extension Point.

---

# 16. Provider Extension

Una Extension podrá proporcionar una Implementation para un Contract.

Ejemplo:

```text
XP-PAYMENT-PROVIDER
        │
        ├── StripeExtension
        └── AdyenExtension
```

---

# 17. Behavioral Extension

También podrá aportar comportamiento adicional.

Ejemplo:

```text
XP-ORDER-VALIDATION
        │
        ├── FraudValidator
        └── RegionValidator
```

---

# 18. Data Extension

Podrá aportar metadata/schema gobernado.

---

# 19. UI Extension

Podrá existir en Profiles que soporten UI extensible.

Deberá tratarse como una categoría especializada y no asumirse en Core.

---

# 20. Extension Point Manifest

Un Module podrá declarar Extension Points mediante Manifest.

Conceptualmente:

```yaml
extensionPoints:
  - id: XP-REPORT-EXPORTER-001
    contract: CT-REPORT-EXPORTER-001
    version: 1.0.0
    multiplicity: many
    ordering: unordered
```

---

# 21. Extension Declaration

Una Extension podrá declarar:

```yaml
extensions:
  - id: EXT-REPORT-PDF-001
    extends: XP-REPORT-EXPORTER-001
    contract: CT-REPORT-EXPORTER-001
    version: 1.0.0
```

---

# 22. Manifest Authority

ENG-003 seguirá gobernando formato y validación general.

ENG-029 define la semántica de Extension Points y Extensions.

---

# 23. Discovery

Extensions deberán descubrirse mediante mecanismos gobernados.

---

# 24. Discovery Sources

Podrán incluir:

```text
Package Manifest
Module Manifest
Provider Registration
Generated Metadata
Approved Registry Entries
```

---

# 25. No Arbitrary Scanning

No deberá requerirse escaneo indiscriminado del filesystem o Reflection global.

---

# 26. Discovery Does Not Activate

Descubrir una Extension no deberá:

```text
instantiate
activate
execute
```

automáticamente.

---

# 27. Registry Integration

ENG-020 deberá poder registrar:

```text
Extension Points
Extensions
Owners
Contracts
Versions
Visibility
Provenance
```

---

# 28. Extension Point Entry

Conceptualmente:

```text
ExtensionPointEntry
├── id
├── version
├── owner
├── contract
├── visibility
├── multiplicity
├── ordering
├── lifecycle
└── policy
```

---

# 29. Extension Entry

Conceptualmente:

```text
ExtensionEntry
├── id
├── extends
├── provider
├── module
├── package
├── version
├── compatibility
└── provenance
```

---

# 30. Registry Does Not Execute

Registry conoce Extensions.

No las ejecuta.

---

# 31. Container Integration

ENG-019 podrá construir Extension Instances.

---

# 32. DI Integration

ENG-018 deberá proporcionar dependencias a Extensions.

---

# 33. Extension Does Not Receive Full Container

Una Extension no deberá recibir Container completo salvo infraestructura explícitamente autorizada.

---

# 34. Extension Context

Podrá existir:

```text
ExtensionContext
```

limitado.

---

# 35. Recommended ExtensionContext

Conceptualmente:

```text
ExtensionContext
├── extension identity
├── host identity
├── scoped configuration
├── allowed contracts
├── telemetry
└── granted capabilities
```

---

# 36. No Full Host Access

No deberá exponer todos los internals del Host.

---

# 37. Multiplicity

Todo Extension Point deberá declarar cuántas Extensions permite.

Taxonomía conceptual:

```text
zero-or-one
exactly-one
zero-or-many
one-or-many
```

---

# 38. Exactly One

El Runtime deberá rechazar:

```text
0
```

o:

```text
>1
```

candidates válidos.

---

# 39. Zero or One

Permite ausencia.

Si existen múltiples Candidates deberá aplicarse Policy explícita.

---

# 40. Many

Permite múltiples Extensions.

---

# 41. Multiplicity Validation

Deberá ejecutarse antes de Activation cuando sea estructural.

---

# 42. Ordering

Extension Point deberá declarar si existe Ordering significativo.

---

# 43. Unordered

Extensions no deberán asumir orden.

---

# 44. Ordered

Si se requiere Ordering deberá existir regla explícita.

---

# 45. Priority

Podrá utilizarse:

```text
priority
```

cuando resulte apropiado.

---

# 46. Stable Ordering

Empates deberán resolverse determinísticamente o declararse unordered.

---

# 47. Dependency Ordering

Una Extension podrá depender de otra únicamente si el Extension Point lo permite explícitamente.

---

# 48. Extension Dependency

No deberá utilizarse como mecanismo general para construir cadenas arbitrarias.

---

# 49. Before/After

Un perfil avanzado podrá permitir:

```text
before
after
```

con validación de ciclos.

---

# 50. Ordering Cycles

Ejemplo inválido:

```text
A before B
B before C
C before A
```

deberá rechazarse.

---

# 51. Selection

Cuando Extension Point acepte una sola Implementation entre varias, deberá existir Selection Policy.

---

# 52. Selection Sources

Podrá depender de:

```text
Configuration
Qualifier
Priority
Capability
Environment Profile
```

---

# 53. Deterministic Selection

La misma Composition deberá seleccionar la misma Extension.

---

# 54. No Last Registration Wins

No deberá utilizarse como mecanismo universal.

---

# 55. Default Extension

Un Host podrá declarar una Extension predeterminada.

---

# 56. Default Is Explicit

Deberá declararse explícitamente.

---

# 57. Override

Una Application podrá sustituir Default cuando Extension Point lo permita.

---

# 58. Protected Extension Point

Algunos Extension Points podrán restringir sustitución.

---

# 59. Core Security Extension

Ejemplos como:

```text
authentication
authorization
secret provider
```

podrán requerir Policy reforzada.

---

# 60. Security Authority

ENG-024 será autoridad sobre autorización y Trust.

---

# 61. Installed ≠ Authorized

Una Extension instalada no deberá considerarse automáticamente autorizada.

---

# 62. Trusted Publisher

Trust deberá derivarse de Package/Security Infrastructure.

---

# 63. Capability Request

Una Extension podrá solicitar Capabilities.

---

# 64. Capability Grant

Runtime/Security decidirá cuáles se conceden.

---

# 65. Least Privilege

ExtensionContext deberá contener únicamente Capabilities concedidas.

---

# 66. Permission Declaration

Una Extension podrá declarar Permissions requeridas.

---

# 67. Declaration Is Not Grant

Se mantiene la regla:

```text
request permission
≠
receive permission
```

---

# 68. Extension Isolation

La primera versión proporcionará aislamiento lógico.

---

# 69. Logical Isolation

Mediante:

```text
Contracts
Visibility
Module Boundaries
Capabilities
Security Policy
```

---

# 70. No False Sandbox

No deberá afirmarse aislamiento de proceso si no existe.

---

# 71. Extension Boundary

La Extension no deberá modificar:

```text
Host private state
Registry internals
Container internals
Runtime internals
```

fuera de APIs autorizadas.

---

# 72. Monkey Patching

No deberá formar parte del mecanismo oficial de extensibilidad.

---

# 73. Reflection Override

No deberá utilizarse como mecanismo arquitectónico para acceder a internals privados.

---

# 74. Class Replacement

Sustituir clases arbitrariamente deberá evitarse.

---

# 75. Decorator Extension

Podrá permitirse explícitamente mediante Contract.

---

# 76. Decorator Chain

Un Extension Point podrá declarar semántica de Decorators.

---

# 77. Decorator Ordering

Deberá gobernarse.

---

# 78. Middleware Extension

Podrá existir como Extension Point especializado.

---

# 79. Middleware Contract

Deberá definir:

```text
input
next
output
errors
ordering
```

---

# 80. Hook

Un Hook será un tipo simple de Extension Point.

---

# 81. Hook Semantics

Deberá especificar:

```text
when invoked
what context receives
whether result matters
failure policy
ordering
```

---

# 82. Hook ≠ Event

Deberá distinguirse:

```text
Hook
→ deliberate extension invocation point

Event
→ notification of a fact
```

---

# 83. Event vs Extension

Event Bus no deberá utilizarse para ocultar dependencia directa de extensibilidad cuando el Host necesita comportamiento obligatorio.

---

# 84. Extension vs Contract Provider

Una Extension puede proporcionar Contract.

Pero no toda Contract Implementation es necesariamente Extension.

---

# 85. Extension Point Visibility

Podrá utilizar:

```text
private
module
public
framework
```

---

# 86. Private Extension Point

Solo podrá ser utilizado dentro del Owner boundary.

---

# 87. Public Extension Point

Podrá ser implementado por otros Modules/Packages autorizados.

---

# 88. Framework Extension Point

Publicado por MEF Core.

---

# 89. Extension Visibility

Una Extension también podrá tener Visibility propia.

---

# 90. Compatibility

ENG-016 deberá validar:

```text
Extension
↔ Extension Point
↔ Contract
↔ Host Version
↔ Runtime Version
```

---

# 91. Extension Version

Toda Extension pública deberá poseer Version.

---

# 92. Extension Point Version

También.

---

# 93. Contract Version

Deberá permanecer separada.

---

# 94. Three Versions

No deberán confundirse:

```text
Extension Version
Extension Point Version
Contract Version
```

---

# 95. Compatibility Requirement

Ejemplo conceptual:

```yaml
extends:
  id: XP-REPORT-EXPORTER-001
  version: "^2.0"

implements:
  CT-REPORT-EXPORTER-001: "^3.0"
```

---

# 96. Host Compatibility

Una Extension podrá declarar:

```text
requires host MOD-REPORTS ^4.0
```

si depende de semántica adicional del Host.

---

# 97. Prefer Extension Point Contract

Deberá evitarse dependencia directa al Host cuando no sea necesaria.

---

# 98. Breaking Extension Point Change

Cambiar:

```text
required operations
ordering semantics
failure semantics
lifecycle
multiplicity
```

puede constituir Breaking Change.

---

# 99. Extension Point Evolution

Deberá pasar por:

```text
Impact Analysis
Compatibility Analysis
Version Decision
Migration
Release
```

---

# 100. Deprecation

Extension Points podrán marcarse Deprecated.

---

# 101. Deprecation Metadata

Deberá incluir cuando sea posible:

```text
deprecatedSince
replacement
plannedRemoval
migration
```

---

# 102. Extension Deprecation

Una Extension concreta también podrá ser Deprecated.

---

# 103. Retirement

Un Extension Point retirado no deberá aceptar nuevas Extensions en Composition soportada.

---

# 104. Known Consumers

Antes de Retirement deberá analizarse qué Extensions dependen de él.

---

# 105. Registry Impact Analysis

ENG-020 deberá ayudar a localizar:

```text
Extensions implementing XP-X
```

---

# 106. Runtime Lifecycle

ENG-027 coordinará Lifecycle de Extensions.

---

# 107. Extension Lifecycle

Conceptualmente:

```text
Discovered
   ↓
Validated
   ↓
Constructed
   ↓
Initialized
   ↓
Active
   ↓
Stopping
   ↓
Stopped
```

sin crear una State Machine normativa independiente de ENG-015.

---

# 108. Lifecycle Policy

Un Extension Point deberá declarar qué hooks de Lifecycle aplica.

---

# 109. Simple Extension

Podrá no requerir Activation específica.

---

# 110. Stateful Extension

Podrá requerir:

```text
initialize
activate
deactivate
```

---

# 111. Lifecycle Ordering

Host deberá estar suficientemente preparado antes de activar Extensions.

---

# 112. Extension Before Host

No deberá activarse antes de que exista infraestructura Host requerida.

---

# 113. Host Shutdown

Extensions deberán detenerse antes de destruir recursos Host que utilicen.

---

# 114. Recommended Shutdown

```text
Stop workload
   ↓
Deactivate Extensions
   ↓
Deactivate Host
   ↓
Dispose scopes
```

según Dependency Graph.

---

# 115. Extension Failure

Deberá clasificarse conforme ENG-023.

---

# 116. Required Extension Failure

Si Extension es obligatoria para Host, puede impedir Activation/Readiness.

---

# 117. Optional Extension Failure

Podrá producir Degradation u omisión.

---

# 118. Failure Policy

Extension Point deberá declarar cómo tratar Failure cuando sea relevante.

---

# 119. Fail Fast

Puede ser apropiado para Extensions obligatorias.

---

# 120. Continue

Puede ser apropiado para múltiples Extensions independientes.

---

# 121. Aggregate

Puede recopilar múltiples Failures.

---

# 122. Failure Must Be Explicit

No deberá depender accidentalmente del orden de ejecución.

---

# 123. Extension Rollback

Si Activation falla deberá liberar recursos adquiridos.

---

# 124. Host Rollback

Una Extension Failure crítica podrá formar parte del Runtime Rollback de ENG-027.

---

# 125. Extension Scope

ENG-019 podrá soportar Scope específico.

---

# 126. Extension Scope Lifetime

Deberá alinearse con Extension/Module Lifecycle.

---

# 127. Shared Extension Instance

No deberá asumirse Singleton universal.

---

# 128. Instance Scope

Extension Point podrá definir restricciones de Scope.

---

# 129. Extension Factory

Una Extension podrá construirse mediante Factory.

---

# 130. Factory Security

Factory no deberá recibir autoridad superior a la Extension.

---

# 131. Configuration

Extensions podrán poseer Configuration propia.

---

# 132. Configuration Namespace

Deberá estar aislado.

Ejemplo conceptual:

```text
extensions.reportPdf.*
```

---

# 133. Configuration Schema

Toda Configuration pública de Extension deberá validarse.

---

# 134. Host Configuration

Extension no deberá leer arbitrariamente Configuration privada del Host.

---

# 135. Secret Access

Deberá solicitarse mediante SecretProvider/Capabilities.

---

# 136. Extension Manifest

Podrá declarar Secret references requeridas, nunca valores.

---

# 137. Observability

ENG-025 deberá permitir distinguir Telemetry de Extension.

---

# 138. Standard Attributes

Ejemplos:

```text
mef.extension.id
mef.extension.point
mef.extension.host
```

---

# 139. Extension Trace

Podrá instrumentarse:

```text
extension.initialize
extension.invoke
extension.deactivate
```

---

# 140. Extension Metrics

Podrán incluir:

```text
mef.extensions.active
mef.extension.invocations.total
mef.extension.failures.total
mef.extension.duration
```

---

# 141. Host Attribution

Telemetry deberá poder diferenciar Host y Extension.

---

# 142. Performance

ENG-026 deberá medir Extension overhead cuando participe en Hot Path.

---

# 143. Extension Fan-Out

Extension Points `many` deberán evaluarse con múltiples Extensions.

---

# 144. Extension Chain Cost

Middleware/Decorator chains deberán controlarse.

---

# 145. No Unlimited Chain

Una Application podrá establecer límites cuando exista riesgo operacional.

---

# 146. Lazy Extensions

Podrán construirse al primer uso cuando Lifecycle lo permita.

---

# 147. Eager Validation

Aunque sean Lazy, Compatibility y Metadata deberían validarse durante Bootstrap.

---

# 148. Testing

ENG-009 deberá soportar Extension Tests.

---

# 149. Extension Unit Test

La Extension debería probarse contra el Contract sin Runtime completo cuando sea posible.

---

# 150. Extension Contract Test

Deberá ejecutar Contract Tests publicados por Extension Point/Contract Owner cuando existan.

---

# 151. Host Integration Test

Deberá verificar Host + Extension.

---

# 152. Multiple Extension Test

Deberá verificar Multiplicity y Ordering.

---

# 153. Failure Policy Test

Deberá probar Fallos de Extensions.

---

# 154. Compatibility Test

Deberá comprobar Extension Point/Contract Version.

---

# 155. Security Test

Deberá probar que Extension no obtiene Capabilities no concedidas.

---

# 156. Isolation Test

Deberá probar que no accede a internals del Host.

---

# 157. Lifecycle Test

Deberá comprobar Initialization/Activation/Deactivation.

---

# 158. Rollback Test

Deberá comprobar Cleanup después de Failure.

---

# 159. Test Extension

Testing podrá definir Extensions temporales.

---

# 160. Test Override

Podrá sustituirse Extension mediante mecanismo explícito de Test.

---

# 161. No Production Leakage

Test Extensions no deberán llegar a Release productiva por accidente.

---

# 162. Build Integration

ENG-012 deberá validar Extensions durante Build.

---

# 163. Extension Build Gate

Podrá detectar:

```text
unknown extension point
invalid contract
incompatible version
duplicate identity
invalid multiplicity
ordering cycle
security violation
```

---

# 164. Release Integration

ENG-017 deberá considerar Extension Points públicos dentro de Compatibility.

---

# 165. Release Notes

Deberán documentarse cuando corresponda:

```text
new extension points
deprecated extension points
removed extension points
breaking changes
```

---

# 166. Package Integration

ENG-013 deberá poder saber qué Extensions distribuye un Package.

---

# 167. Package Install ≠ Extension Activation

Instalar Package no deberá activar automáticamente la Extension.

---

# 168. Extension Discovery

Ocurre durante Runtime Discovery/Composition.

---

# 169. Module Integration

ENG-028 podrá declarar Extension Points y Extensions.

---

# 170. Host Module

Un Module puede publicar múltiples Extension Points.

---

# 171. Extension Module

Un Module puede proporcionar múltiples Extensions.

---

# 172. Same Module

Un Module también podrá extenderse internamente si el Extension Point lo permite.

---

# 173. Cross-Module Extension

Deberá usar Contracts públicos.

---

# 174. Extension Provenance

Registry deberá poder responder:

```text
which Package provided this Extension?
which Module owns it?
who published the Extension Point?
```

---

# 175. Extension Catalog

Tooling podrá generar catálogo.

Ejemplo:

```text
XP-REPORT-EXPORTER-001
├── EXT-REPORT-PDF-001
├── EXT-REPORT-CSV-001
└── EXT-REPORT-XLSX-001
```

---

# 176. CLI Integration

ENG-007 podrá incorporar:

```text
mef extension list
mef extension inspect
mef extension validate
mef extension graph
mef extension points
mef extension implementations
```

---

# 177. `extension list`

Podrá mostrar Extensions conocidas.

---

# 178. `extension points`

Podrá mostrar:

```text
ID
Owner
Contract
Multiplicity
Ordering
```

---

# 179. `extension inspect`

Podrá mostrar:

```text
identity
provider
host
contract
version
permissions
capabilities
state
```

---

# 180. `extension validate`

Deberá validar la Composition.

---

# 181. `extension graph`

Podrá mostrar relaciones Host–Point–Extension.

---

# 182. Machine Output

Los comandos deberán soportar salida estructurada.

---

# 183. Error Namespace

ENG-029 utilizará:

```text
MEF-EXT-xxx
```

---

# 184. Taxonomía ENG-029

```text
MEF-EXT-001 Extension Point not found
MEF-EXT-002 Extension Point invalid
MEF-EXT-003 Extension invalid
MEF-EXT-004 Duplicate Extension identity
MEF-EXT-005 Extension Contract mismatch
MEF-EXT-006 Extension incompatible
MEF-EXT-007 Extension multiplicity violation
MEF-EXT-008 Extension selection ambiguous
MEF-EXT-009 Extension ordering conflict
MEF-EXT-010 Extension ordering cycle
MEF-EXT-011 Extension permission denied
MEF-EXT-012 Extension capability denied
MEF-EXT-013 Extension initialization failed
MEF-EXT-014 Extension activation failed
MEF-EXT-015 Extension execution failed
MEF-EXT-016 Extension deactivation failed
MEF-EXT-017 Extension visibility violation
MEF-EXT-018 Extension internal access denied
MEF-EXT-019 Extension configuration invalid
MEF-EXT-020 Extension invariant violated
```

---

# 185. Extension Point Missing

```text
MEF-EXT-001

Extension Point not found.

Extension:
EXT-REPORT-PDF-001

Requested:
XP-REPORT-EXPORTER-001
```

---

# 186. Contract Mismatch

```text
MEF-EXT-005

Extension does not satisfy required Contract.

Extension:
EXT-STORAGE-S3-001

Extension Point:
XP-STORAGE-ADAPTER-001

Required Contract:
CT-STORAGE-001
```

---

# 187. Multiplicity Violation

```text
MEF-EXT-007

Extension Point multiplicity violated.

Extension Point:
XP-AUTH-PROVIDER-001

Multiplicity:
exactly-one

Compatible extensions:
2
```

---

# 188. Selection Ambiguous

```text
MEF-EXT-008

Multiple Extensions are equally eligible.

Extension Point:
XP-PAYMENT-PROVIDER-001

Candidates:
EXT-STRIPE-001
EXT-ADYEN-001

Explicit selection required.
```

---

# 189. Ordering Cycle

```text
MEF-EXT-010

Extension ordering cycle detected.

EXT-A
→ before EXT-B
→ before EXT-C
→ before EXT-A
```

---

# 190. Capability Denied

```text
MEF-EXT-012

Required capability denied.

Extension:
EXT-REPORT-PDF-001

Capability:
filesystem.write
```

---

# 191. Activation Failure

```text
MEF-EXT-014

Extension activation failed.

Extension:
EXT-PAYMENT-STRIPE-001

Host:
MOD-PAYMENTS
```

---

# 192. Internal Access Denied

```text
MEF-EXT-018

Extension attempted to access Host internal API.

Extension:
EXT-CUSTOMER-ANALYTICS-001

Host:
MOD-CUSTOMER

Internal service:
CustomerInternalRepository
```

---

# 193. Extension Invariant Violation

```text
MEF-EXT-020

Extension invariant violated.

Reason:
Extension executed before activation completed.
```

---

# 194. Extension Point Types

La primera versión deberá evitar una taxonomía excesiva.

Podrá reconocer conceptualmente:

```text
provider
hook
decorator
pipeline
```

solo si existe necesidad.

---

# 195. Provider Extension Point

Selecciona Implementation.

---

# 196. Hook Extension Point

Invoca cero o más Extensions.

---

# 197. Decorator Extension Point

Construye una cadena alrededor de una Implementation.

---

# 198. Pipeline Extension Point

Procesa una secuencia ordenada.

---

# 199. Type Is Semantic

El tipo deberá definir reglas concretas y no ser simple etiqueta.

---

# 200. Initial Scope

La primera versión debería implementar primero:

```text
provider
hook
```

antes de Decorators/Pipelines complejos.

---

# 201. Provider Flow

```text
Host
  ↓
Extension Point
  ↓
Registry Candidates
  ↓
Compatibility
  ↓
Security
  ↓
Selection
  ↓
Container
  ↓
Extension Instance
```

---

# 202. Hook Flow

```text
Host Operation
     ↓
Extension Point
     ↓
Registered Extensions
     ↓
Ordering
     ↓
Handler A
     ↓
Handler B
     ↓
Handler C
```

---

# 203. Hook Failure Semantics

Deberán definirse por Extension Point.

---

# 204. Hook vs Event Bus

Si Host requiere:

```text
specific extensibility contract
+
controlled execution semantics
```

debe utilizar Extension Point.

Si solo notifica un hecho:

```text
Event
```

será generalmente más apropiado.

---

# 205. Extension Architecture

```text
                HOST MODULE
                    │
                    ▼
              EXTENSION POINT
                    │
                    ▼
                 CONTRACT
                    │
          ┌─────────┼─────────┐
          ▼         ▼         ▼
        EXT-A     EXT-B     EXT-C
          │         │         │
          └─────────┼─────────┘
                    ▼
                  Registry
                    │
                    ▼
              Compatibility
                    │
                    ▼
                 Security
                    │
                    ▼
                 Container
                    │
                    ▼
                 Runtime
```

---

# 206. Security Architecture

```text
Extension
   │
   ▼
Requested Permissions
   │
   ▼
Security Policy
   │
 ┌─┴──────┐
 ▼        ▼
Deny     Grant
          │
          ▼
   ExtensionContext
```

---

# 207. Lifecycle Architecture

```text
Discovered
   ↓
Validated
   ↓
Constructed
   ↓
Initialized
   ↓
Active
   ↓
Deactivated
   ↓
Disposed
```

Los estados deberán mapearse a ENG-015/ENG-027 y no crear una State Machine paralela.

---

# 208. Host/Extension Boundary

```text
┌──────────────── HOST ────────────────┐
│                                      │
│ private internals                    │
│        ▲                             │
│        │ inaccessible                │
│        │                             │
│ Extension Point ───── Contract ──────┼──► Extension
│                                      │
└──────────────────────────────────────┘
```

---

# 209. First Implementation

La primera implementación deberá incluir:

```text
ExtensionPointDescriptor
ExtensionDescriptor
ExtensionContext

ExtensionRegistry
ExtensionDiscovery
ExtensionValidator

ExtensionResolver
ExtensionSelector

ExtensionActivator
ExtensionDeactivator
```

---

# 210. Conceptual Directory Structure

```text
src/
└── Extension/
    ├── ExtensionPointDescriptor
    ├── ExtensionDescriptor
    ├── ExtensionContext
    │
    ├── Discovery/
    │   └── ExtensionDiscovery
    │
    ├── Registry/
    │   └── ExtensionRegistry
    │
    ├── Validation/
    │   └── ExtensionValidator
    │
    ├── Resolution/
    │   ├── ExtensionResolver
    │   └── ExtensionSelector
    │
    └── Lifecycle/
        ├── ExtensionActivator
        └── ExtensionDeactivator
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 211. Initial Extension Point Contract

Conceptualmente:

```text
ExtensionPointDescriptor
├── id
├── version
├── owner
├── contract
├── multiplicity
├── ordering
├── visibility
├── lifecycle
└── securityPolicy
```

---

# 212. Initial Extension Descriptor

```text
ExtensionDescriptor
├── id
├── version
├── extensionPoint
├── implementation
├── module
├── package
├── capabilities
├── permissions
└── metadata
```

---

# 213. First Runtime Flow

```text
Package Installed
      ↓
Manifest Loaded
      ↓
Extension Discovered
      ↓
Registry Entry
      ↓
Extension Point Lookup
      ↓
Contract Validation
      ↓
Compatibility
      ↓
Security
      ↓
Multiplicity / Ordering
      ↓
Container Composition
      ↓
Extension Instance
      ↓
Activation
```

---

# 214. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Extension Points
Explicit Extensions
Static Discovery
Static Runtime Composition
Provider Extensions
Hook Extensions
Deterministic Selection
Deterministic Ordering
Logical Isolation
No Monkey Patching
No Hot Reload
No Runtime Extension Mutation
```

---

# 215. Second Phase

Podrá incorporar:

```text
Decorators
Pipelines
Advanced Ordering
Extension Templates
Generated Metadata
Extension Catalog
Impact Analysis
```

---

# 216. Third Phase

Solo cuando exista necesidad:

```text
Dynamic Extension Loading
Hot Swap
Extension Sandboxing
Process-Isolated Extensions
Remote Extensions
Extension Marketplace
Live Composition Reconciliation
```

---

# 217. Invariantes de Ingeniería

ENG-029 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-526 | Toda Extension pública deberá dirigirse a un Extension Point explícitamente identificado y gobernado. |
| EI-527 | Todo Extension Point público deberá poseer Owner, Contract y versión identificables. |
| EI-528 | Una Extension no deberá depender de internals privados del Host para implementar su comportamiento público. |
| EI-529 | Discovery de una Extension no deberá implicar automáticamente construcción, ejecución o Activation. |
| EI-530 | Registry deberá conocer Extensions y Extension Points sin asumir su ejecución. |
| EI-531 | Service Container deberá conservar la responsabilidad de construir Extension Instances cuando corresponda. |
| EI-532 | Una Extension no deberá recibir acceso irrestricto al Runtime, Host o Service Container como mecanismo ordinario. |
| EI-533 | La Multiplicity de un Extension Point deberá declararse y validarse explícitamente. |
| EI-534 | El Ordering de múltiples Extensions no deberá depender accidentalmente del orden de Discovery o Registration. |
| EI-535 | Los conflictos de Selection no deberán resolverse mediante `last registration wins` silencioso. |
| EI-536 | La declaración de Permissions o Capabilities por una Extension no deberá interpretarse automáticamente como autorización. |
| EI-537 | Una Extension instalada no deberá considerarse automáticamente confiable ni autorizada para Activation. |
| EI-538 | Compatibility deberá validarse entre Extension, Extension Point, Contract y Host cuando aplique. |
| EI-539 | Los Breaking Changes de Extension Points públicos deberán someterse a Versioning, Compatibility y Migration Policy. |
| EI-540 | Las Extensions obligatorias deberán satisfacer sus Preconditions antes de que el Host alcance Readiness cuando dependan de ellas. |
| EI-541 | Una Extension que adquiera recursos deberá poder liberarlos durante Deactivation o Rollback. |
| EI-542 | Hook, Event y Contract Provider deberán mantenerse como conceptos distintos aunque puedan interactuar. |
| EI-543 | La primera implementación deberá favorecer composición estática y no requerir Hot Reload o Runtime Extension Mutation. |
| EI-544 | Las garantías de aislamiento de Extension deberán corresponder a mecanismos realmente implementados. |
| EI-545 | La extensibilidad de MEF no deberá permitir que una Extension evada Contracts, Visibility, Security o Lifecycle del Host. |

---

# 218. Continuidad de Invariantes

```text
ENG-025 → EI-446 a EI-465
ENG-026 → EI-466 a EI-485
ENG-027 → EI-486 a EI-505
ENG-028 → EI-506 a EI-525
ENG-029 → EI-526 a EI-545
```

---

# 219. Criterios de Conformidad

Una implementación será conforme con ENG-029 cuando:

- defina Extension Points explícitos;
- defina Extension identity;
- defina Ownership;
- utilice Contracts;
- permita Discovery sin Activation;
- integre Registry;
- integre Container;
- aplique DI;
- defina Multiplicity;
- defina Ordering;
- resuelva Selection de forma determinista;
- aplique Compatibility;
- aplique Security;
- limite ExtensionContext;
- preserve Host internals;
- participe correctamente en Lifecycle;
- permita Rollback;
- permita Testing;
- permita Build Validation;
- soporte Deprecation;
- no dependa de Hot Reload;
- no utilice Monkey Patching como mecanismo oficial.

---

# 220. Riesgos

Deberán evitarse especialmente:

## Extension by Internal Access

Una Extension consume clases privadas del Host.

## Monkey Patching

La extensibilidad se basa en alterar comportamiento interno en Runtime.

## Reflection Backdoor

Reflection se utiliza para saltar Visibility.

## Global Container

Extensions pueden resolver cualquier Service.

## Installed Equals Trusted

Todo Plugin instalado obtiene autoridad.

## Last Registration Wins

El orden accidental selecciona Implementation.

## Hidden Ordering

Extensions dependen del orden sin Contract.

## Hook Equals Event

Se utilizan ambos mecanismos sin distinguir semántica.

## Extension Equals Module

Se mezclan responsabilidades arquitectónicas.

## Capability Equals Permission

Declarar Capability concede autoridad automáticamente.

## Unbounded Extension Chain

Cada operación ejecuta un número ilimitado de Plugins.

## Extension Point Drift

Host cambia semántica sin Versioning.

## Host Internal DTO Exposure

Los Extensions quedan acoplados al modelo interno.

## Runtime Mutation Prematurely

Se intenta instalar/desinstalar Extensions mientras Runtime está ACTIVE.

## False Isolation

Se afirma Sandbox cuando Extensions comparten proceso.

---

# 221. Relación con ENG-019

Service Container construye Extension Instances.

No define qué constituye una Extension válida.

---

# 222. Relación con ENG-020

Registry mantiene catálogo de Extension Points y Extensions.

No ejecuta ninguna.

---

# 223. Relación con ENG-021

Contracts definen la semántica entre Host y Extension.

---

# 224. Relación con ENG-022

Event Bus notifica hechos.

Extension Point define puntos deliberados de ampliación.

```text
Event:
something happened

Extension Point:
participate here
```

---

# 225. Relación con ENG-024

Security decide:

```text
trust
permissions
capabilities
visibility
secret access
```

de Extensions.

---

# 226. Relación con ENG-027

Runtime coordina cuándo las Extensions se validan, activan y desactivan.

---

# 227. Relación con ENG-028

Module Engineering define el Host y la unidad que puede publicar o proporcionar Extensions.

La relación fundamental será:

```text
ENG-028
Module
   │
   ├── publishes Extension Point
   │
   └── provides Extension
            │
            ▼
ENG-029
Extension Engineering
```

---

# 228. Principio Rector

> **La extensibilidad de MEF deberá basarse en puntos explícitos, contractuales, versionados y autorizados, permitiendo ampliar comportamiento sin transformar los internals de los Modules ni el Runtime en APIs públicas accidentales.**

---

# 229. Conclusión

**ENG-029 — Extension Engineering** formaliza la extensibilidad controlada de MEF.

La cadena queda:

```text
Host Module
    ↓
Extension Point
    ↓
Contract
    ↓
Registry
    ↓
Extension Candidates
    ↓
Compatibility
    ↓
Security
    ↓
Selection / Ordering
    ↓
Container
    ↓
Extension Instance
    ↓
Runtime Lifecycle
```

MEF podrá ser extensible sin caer en un modelo donde cualquier Plugin pueda:

```text
access internals
modify private state
replace arbitrary services
read every secret
change Runtime structure
```

La separación final queda:

```text
Module
→ owns architecture

Extension Point
→ permits controlled extensibility

Contract
→ defines required behavior

Registry
→ discovers available Extensions

Container
→ constructs them

Security
→ authorizes them

Runtime
→ orchestrates Lifecycle
```

La primera versión deberá concentrarse en:

```text
Provider Extension Points
+
Hook Extension Points
+
Static Composition
+
Explicit Contracts
+
Deterministic Selection
+
Deterministic Ordering
+
Security Enforcement
```

antes de introducir:

```text
Hot Reload
Dynamic Plugins
Remote Extensions
Plugin Marketplace
Sandboxing
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-003 — Manifest
- ENG-005 — Nomenclatura
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
- ENG-028 — Module Engineering