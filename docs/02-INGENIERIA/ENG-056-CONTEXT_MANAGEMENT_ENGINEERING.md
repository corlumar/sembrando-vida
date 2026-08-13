---
id: ENG-056
titulo: Context Management Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Context Management Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-028
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-034
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-049
  - ENG-052
  - ENG-053
  - ENG-055
relacionados:
  - ENG-006
  - ENG-007
  - ENG-011
  - ENG-012
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-017
  - ENG-022
  - ENG-026
  - ENG-030
  - ENG-036
  - ENG-037
  - ENG-042
  - ENG-043
  - ENG-050
  - ENG-051
  - ENG-054
  - ENG-057
keywords:
  - context
  - context-management
  - execution-context
  - request-context
  - operation-context
  - context-propagation
  - context-scope
  - context-lifetime
  - context-owner
  - correlation
  - causation
  - trace-context
  - security-context
  - principal-context
  - tenant-context
  - locale-context
  - deadline-context
  - cancellation-context
  - context-capture
  - context-restoration
  - context-fork
  - context-boundary
  - context-isolation
  - context-leakage
  - baggage
  - mef
---

# ENG-056

# Context Management Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Context Management Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-056 establece las reglas para:

```text
Context
Context Identifier
Context Owner
Context Authority
Context Scope
Context Lifetime

Execution Context
Request Context
Operation Context

Correlation Context
Causation Context
Trace Context

Security Context
Principal Context
Tenant Context
Locale Context

Deadline Context
Cancellation Context

Context Value
Context Key
Context Metadata

Context Propagation
Context Capture
Context Restoration
Context Fork
Context Merge
Context Enrichment

Context Boundary
Context Isolation
Context Leakage

Synchronous Propagation
Asynchronous Propagation
Messaging Propagation
Background Job Propagation
Workflow Propagation

Context Serialization
Context Deserialization
Context Validation
Context Trust
Context Sanitization

Context Security
Context Audit
Context Observability
Context Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo Context administrado por MEF deberá poseer Scope, Lifetime y Ownership conocidos; la propagación deberá ser explícita en fronteras asíncronas, remotas o persistentes; Security Context, Tenant Context y demás información de confianza no deberán aceptarse directamente desde entradas externas sin validación; y ningún Context deberá sobrevivir accidentalmente al Lifetime de la operación que representa.**

Arquitectura conceptual:

```text
                 EXECUTION
                     │
                     ▼
                  CONTEXT
                     │
      ┌──────────────┼──────────────┐
      ▼              ▼              ▼
    SCOPE         LIFETIME        OWNER
      │              │              │
      └──────────────┼──────────────┘
                     ▼
                 PROPAGATION
                     │
       ┌─────────────┼─────────────┐
       ▼             ▼             ▼
  SYNCHRONOUS   ASYNCHRONOUS     REMOTE
       │             │             │
       └─────────────┼─────────────┘
                     ▼
                  BOUNDARY
                     │
                     ▼
                 VALIDATION
```

---

# 3. Context Management Engineering

`Context Management Engineering` gobierna la información asociada a una ejecución determinada.

Deberá poder responder:

```text
What operation is executing?
What request caused it?
What operation caused this operation?
Who is the authenticated principal?
Which tenant owns this execution?
What trace does it belong to?
What deadline applies?
Has cancellation been requested?
What locale applies?
Which context values may cross this boundary?
Which values are trusted?
How long may this context live?
```

---

# 4. Context

Un `Context` representa información asociada a una ejecución, operación o Scope determinado.

Ejemplos:

```text
correlation identifier
trace identifier
principal
tenant
locale
deadline
cancellation
request metadata
operation metadata
```

---

# 5. Context ≠ State

Context acompaña una ejecución.

State representa información administrada que puede persistir independientemente de ella.

---

# 6. Context ≠ Configuration

Configuration define comportamiento del sistema.

Context describe circunstancias de una ejecución concreta.

Ejemplo:

```text
Configuration:
defaultLocale = es-MX

Context:
locale = es-MX
```

---

# 7. Context ≠ Resource

Un Context podrá contener referencia lógica a Resources, pero no deberá utilizarse como mecanismo general de Resource Ownership.

---

# 8. Context ≠ Dependency Injection

Context no deberá convertirse en un Service Locator implícito.

---

# 9. Context ≠ Arbitrary Bag

No deberá utilizarse como diccionario ilimitado para transportar cualquier información entre componentes.

---

# 10. Context Identifier

Toda ejecución relevante deberá poder poseer identificador.

Ejemplos:

```text
requestId
operationId
correlationId
traceId
```

---

# 11. Identifier Semantics

Cada identificador deberá poseer significado conocido.

No deberán utilizarse indistintamente.

---

# 12. Context Owner

Todo Context deberá poseer Owner lógico.

Ejemplos:

```text
Runtime
Request Pipeline
Job Runner
Message Consumer
Workflow Engine
```

---

# 13. Context Authority

Deberá conocerse quién puede crear o modificar valores sensibles.

Ejemplos:

```text
Authentication subsystem
Tenant resolver
Tracing subsystem
Runtime
Policy engine
```

---

# 14. Owner ≠ Authority

El Owner administra el Context.

La Authority determina valores específicos de confianza.

---

# 15. Context Scope

Podrá ser:

```text
REQUEST
OPERATION
TASK
MESSAGE
JOB
WORKFLOW_STEP
SESSION
TENANT_OPERATION
```

---

# 16. Context Lifetime

Todo Context deberá poseer Lifetime acotado.

---

# 17. Context Lifetime Rule

El Context no deberá sobrevivir accidentalmente a la ejecución que representa.

---

# 18. Scope ≠ Lifetime

Deberán permanecer diferenciados.

---

# 19. Execution Context

Representa el conjunto mínimo de información transversal necesaria para una ejecución.

Conceptualmente:

```text
ExecutionContext
├── contextId
├── correlation
├── causation
├── trace
├── security
├── tenant
├── deadline
├── cancellation
├── locale
└── metadata
```

---

# 20. Minimal Context

El Context deberá contener únicamente información transversal necesaria.

---

# 21. Request Context

Representa información asociada a una Request de entrada.

Podrá contener:

```text
requestId
transport
remote metadata
correlation
trace
principal
tenant
locale
deadline
```

---

# 22. Request Context Lifetime

Deberá finalizar con la Request salvo Fork explícito.

---

# 23. Operation Context

Representa una operación interna.

---

# 24. Operation Context Creation

Podrá derivarse de Parent Context.

```text
Request Context
      │
      ▼
Operation Context
```

---

# 25. Parent Context

Un Context derivado deberá poder conocer Parent lógico cuando sea necesario para Correlation o Tracing.

---

# 26. Correlation Context

Permite relacionar operaciones pertenecientes a una misma interacción lógica.

---

# 27. Correlation ID

Deberá permanecer estable a través de operaciones relacionadas cuando el Contract lo requiera.

---

# 28. Correlation ≠ Trace

Correlation puede representar una relación de negocio u operación más amplia.

Trace representa causalidad técnica observada.

---

# 29. Causation Context

Identifica la operación o evento que originó otra operación.

Ejemplo:

```text
Command A
   │
   ▼
Event B
   │
   ▼
Job C
```

Podrá modelarse:

```text
B.causationId = A.id
C.causationId = B.id
```

---

# 30. Causation ≠ Correlation

```text
correlationId
→ groups related work

causationId
→ identifies immediate cause
```

---

# 31. Trace Context

Deberá integrarse con ENG-025.

Podrá contener:

```text
traceId
spanId
traceFlags
traceState
```

---

# 32. Trace Context Authority

Los identificadores recibidos externamente deberán validarse antes de incorporarse.

---

# 33. Trace Fork

Una operación Child deberá conservar Trace cuando corresponda y crear identidad de Span propia.

---

# 34. Security Context

Representa información de seguridad asociada a la ejecución.

Podrá contener:

```text
principal
authentication method
assurance level
permissions snapshot reference
security attributes
```

---

# 35. Security Context Trust

No deberá construirse directamente desde Headers, Message Metadata o Input no confiable sin Authentication y Validation.

---

# 36. Principal Context

Representa la Identity efectiva que ejecuta una operación.

---

# 37. Principal Source

Deberá provenir de ENG-045 / ENG-047.

---

# 38. Principal Immutability

La Identity efectiva no deberá modificarse arbitrariamente durante la operación.

---

# 39. Impersonation

Cuando exista deberá ser explícita, autorizada y auditable.

---

# 40. Tenant Context

Representa Tenant efectivo de la operación.

---

# 41. Tenant Source

Deberá seguir ENG-048.

---

# 42. Tenant Trust

Un `tenantId` enviado por Client no deberá convertirse automáticamente en Tenant Context confiable.

---

# 43. Tenant Immutability

El Tenant efectivo deberá permanecer estable durante una operación salvo Transition explícitamente autorizada.

---

# 44. Cross-Tenant Context

No deberá propagarse accidentalmente.

---

# 45. Locale Context

Podrá contener:

```text
locale
timezone
currency
formatting preferences
```

cuando sean relevantes.

---

# 46. Locale Trust

Locale podrá ser User-Controlled, pero deberá validarse contra valores soportados.

---

# 47. Deadline Context

Representa el instante máximo para completar una operación.

Conceptualmente:

```text
DeadlineContext
├── deadline
├── remaining
└── source
```

---

# 48. Deadline Propagation

Child Operations no deberán recibir Deadline posterior al Parent cuando formen parte de la misma operación limitada.

---

# 49. Remaining Time

Deberá calcularse respecto al Deadline, no acumulando Timeouts independientes.

---

# 50. Deadline Expiration

Una operación deberá detectar cuando:

```text
remaining <= 0
```

antes de iniciar trabajo costoso cuando sea posible.

---

# 51. Cancellation Context

Representa solicitud cooperativa de cancelación.

---

# 52. Cancellation ≠ Timeout

Timeout puede causar Cancellation, pero son conceptos distintos.

---

# 53. Cancellation Propagation

Child Operations deberán recibir Cancellation cuando pertenezcan al mismo árbol de ejecución.

---

# 54. Cancellation Authority

No cualquier componente deberá cancelar cualquier operación.

---

# 55. Cancellation Reason

Podrá registrar causa acotada:

```text
client disconnected
deadline exceeded
shutdown
parent cancelled
operator request
```

---

# 56. Cancellation Safety

Cancelar no deberá implicar que Side Effects externos fueron revertidos.

---

# 57. Context Key

Toda entrada extensible deberá poseer Key estable.

Ejemplo:

```text
mef.context.locale
mef.context.correlation
```

---

# 58. Context Key Namespace

Deberá seguir ENG-005.

---

# 59. Reserved Keys

MEF deberá reservar Namespace propio.

---

# 60. Context Value

Todo Value deberá poseer Type o Contract conocido.

---

# 61. Untyped Context Values

Deberán minimizarse.

---

# 62. Context Metadata

Solo deberá contener Metadata transversal y acotada.

---

# 63. Metadata Size

Deberá poseer límites.

---

# 64. Context Baggage

Baggage representa Metadata propagable entre Boundaries.

---

# 65. Baggage Rule

No deberá utilizarse para:

```text
large payloads
secrets
credentials
full user objects
domain aggregates
database entities
binary data
```

---

# 66. Baggage Limits

Deberán existir límites de:

```text
entry count
key length
value length
total size
```

---

# 67. Context Propagation

Transporta Context entre operaciones relacionadas.

---

# 68. Propagation Policy

Deberá definir:

```text
what propagates
where
how
trust level
serialization
size limits
```

---

# 69. Implicit Propagation

Podrá utilizarse dentro de una frontera de ejecución controlada.

---

# 70. Explicit Propagation

Deberá preferirse en:

```text
async boundary
thread boundary
process boundary
network boundary
message boundary
persistence boundary
```

---

# 71. Synchronous Propagation

Un Child Call podrá heredar Context de Parent.

---

# 72. Context Inheritance

No todos los Values deberán heredarse.

---

# 73. Inheritance Policy

Cada Context Value propagable deberá declarar:

```text
INHERIT
COPY
FORK
DROP
REVALIDATE
```

cuando sea necesario.

---

# 74. Asynchronous Propagation

El Context deberá capturarse explícitamente cuando Execution cambie de Thread, Worker o Task.

---

# 75. Context Capture

Produce Snapshot acotado del Context propagable.

Conceptualmente:

```text
capture(context)
→ ContextSnapshot
```

---

# 76. Context Snapshot

No deberá contener referencias mutables arbitrarias.

---

# 77. Context Restoration

Instala Context capturado dentro del nuevo Scope de ejecución.

---

# 78. Restoration Scope

Deberá poseer Cleanup determinístico.

```text
restore(snapshot)
try
    execute
finally
    clear
```

---

# 79. Context Leakage

Ocurre cuando Context de una operación queda visible en otra no relacionada.

---

# 80. Thread Pool Leakage

Deberá prevenirse especialmente.

Ejemplo prohibido:

```text
Request A → Thread 4 → Tenant A
Request completes

Request B → Thread 4
Context still says Tenant A
```

---

# 81. Worker Reuse

Todo Worker reutilizable deberá limpiar Context anterior antes de ejecutar nuevo trabajo.

---

# 82. Context Fork

Crea Child Context relacionado pero independiente.

Conceptualmente:

```text
child = parent.fork()
```

---

# 83. Fork Rules

Podrá:

```text
preserve correlation
preserve trace
create new span
inherit tenant
inherit principal
shorten deadline
inherit cancellation
copy selected metadata
```

---

# 84. Detached Fork

Una operación deliberadamente independiente deberá declarar qué Context deja de heredar.

---

# 85. Fire-and-Forget

No deberá heredar ciegamente Request Context cuya Lifetime termina antes que la tarea.

---

# 86. Background Task Context

Deberá crear Context propio.

---

# 87. Context Merge

Deberá utilizarse con extrema cautela.

---

# 88. Security Context Merge

No deberá combinar automáticamente identidades o permisos de dos Contexts.

---

# 89. Tenant Context Merge

No deberá permitirse entre Tenants distintos.

---

# 90. Deadline Merge

Cuando varias dependencias limiten una operación deberá utilizarse el Deadline más restrictivo.

---

# 91. Cancellation Merge

Podrá cancelarse cuando cualquiera de los Parents relevantes sea cancelado, según Contract.

---

# 92. Context Enrichment

Componentes autorizados podrán añadir información.

Ejemplos:

```text
authentication result
tenant resolution
trace span
locale resolution
```

---

# 93. Enrichment Authority

Cada campo sensible deberá tener Authority conocida.

---

# 94. Context Boundary

Representa punto donde Context cambia de Trust Domain, proceso, Thread, Task o Transport.

---

# 95. Boundary Types

```text
FUNCTION
THREAD
TASK
PROCESS
NETWORK
MESSAGE
JOB
WORKFLOW
PERSISTENCE
TENANT
TRUST
```

---

# 96. Boundary Policy

Toda frontera relevante deberá definir:

```text
extract
validate
sanitize
transform
propagate
drop
```

---

# 97. Context Isolation

Contexts no relacionados no deberán compartir State mutable.

---

# 98. Tenant Isolation

Tenant Context deberá respetar ENG-048.

---

# 99. Security Isolation

Security Context no deberá filtrarse a operaciones no autorizadas.

---

# 100. Request Isolation

Dos Requests concurrentes no deberán compartir Context mutable.

---

# 101. Context Serialization

Solo Values explícitamente serializables deberán cruzar Process o Persistence Boundaries.

---

# 102. Serialization Contract

Deberá definir:

```text
schema
version
allowed fields
size limit
encoding
```

---

# 103. Context Deserialization

Toda entrada deberá tratarse inicialmente como no confiable.

---

# 104. Context Validation

Deberá ocurrir antes de utilizar Values externos.

---

# 105. Unknown Context Field

Deberá seguir Compatibility Policy.

---

# 106. Context Version

Context serializado deberá poder evolucionar.

---

# 107. Context Compatibility

Deberá seguir ENG-016.

---

# 108. Context Sanitization

Deberá eliminar o transformar Values no permitidos antes de Propagation.

---

# 109. Trust Boundary

Al cruzarlo deberá reevaluarse Trust.

---

# 110. Trusted Context

No significa que todos sus Values sean transferibles a cualquier Boundary.

---

# 111. Remote Context

Deberá contener únicamente información necesaria para el receptor.

---

# 112. HTTP Context Propagation

ENG-044 podrá transportar:

```text
correlation
trace
locale
deadline hint
```

según Contract.

---

# 113. HTTP Security Context

Credentials deberán procesarse mediante Authentication, no copiarse como Security Context arbitrario.

---

# 114. Messaging Context Propagation

ENG-041 podrá transportar:

```text
messageId
correlationId
causationId
trace context
tenant reference
selected metadata
```

---

# 115. Message Context Trust

Headers de Message deberán validarse igual que cualquier entrada externa.

---

# 116. Message Retry

Retry deberá conservar Correlation cuando corresponda.

---

# 117. Message Causation

Una nueva operación causada por Message deberá registrar Causation apropiada.

---

# 118. Background Job Context

ENG-040 deberá crear Context independiente para cada ejecución.

---

# 119. Job Context

Podrá contener:

```text
jobId
executionId
correlation
trace
tenant
deadline
cancellation
```

---

# 120. Scheduled Job Principal

No deberá inventarse User Principal.

---

# 121. System Principal

Cuando sea necesario deberá existir Identity de sistema explícita.

---

# 122. Workflow Context

ENG-052 podrá propagar Context mínimo entre Steps.

---

# 123. Workflow Persistence

No deberá persistir Execution Context completo por Default.

---

# 124. Workflow Context Snapshot

Deberá contener solo información necesaria para reanudar correctamente.

---

# 125. Workflow Principal

Una Workflow Instance de larga duración no deberá asumir que Authentication Session original sigue siendo válida.

---

# 126. Workflow Authorization

Deberá reevaluarse cuando el Contract lo requiera.

---

# 127. Transaction Context

ENG-042 podrá asociar Context lógico a Transaction.

---

# 128. Transaction Context Lifetime

No deberá escapar al Lifetime de Transaction.

---

# 129. Data Access Context

ENG-043 podrá utilizar:

```text
tenant
deadline
cancellation
trace
```

sin convertir Context en repositorio de Queries o Entities.

---

# 130. Module Context

ENG-028 podrá añadir Metadata namespaced.

---

# 131. Module Context Isolation

Un Module no deberá sobrescribir Keys reservadas de otro.

---

# 132. Application Context

ENG-034 podrá definir Extensions acotadas.

---

# 133. Runtime Context

ENG-027 deberá proporcionar primitivas base de Context Management.

---

# 134. Lifecycle Context

ENG-055 podrá utilizar Context especializado para:

```text
deadline
cancellation
actor
reason
scope
```

---

# 135. Resource Context

ENG-054 podrá recibir Deadline, Tenant y Cancellation durante Acquisition.

---

# 136. Context Storage

El mecanismo físico dependerá del Runtime.

Podrá utilizar:

```text
explicit parameter
async-local storage
thread-local storage
fiber-local storage
task-local storage
```

---

# 137. Storage Abstraction

Código de dominio no deberá depender directamente de Thread-Local específico del Runtime.

---

# 138. Thread Local

No deberá asumirse seguro en Async Runtime.

---

# 139. Async Local

No elimina la necesidad de Boundary Policy.

---

# 140. Global Context

Deberá evitarse.

---

# 141. Mutable Global Context

Queda prohibido para Request, Principal o Tenant Context.

---

# 142. Context Immutability

Context deberá favorecer Value Objects inmutables.

---

# 143. Mutable Context

Cuando sea necesario deberá estar encapsulado y Scoped.

---

# 144. Copy-on-Write

Podrá utilizarse para Context Enrichment.

---

# 145. Context Builder

Podrá utilizarse durante construcción.

---

# 146. Context Mutation

Después de publicar Context deberá favorecerse creación de nueva versión.

---

# 147. Context Disposal

Deberá limpiar referencias y Storage local cuando finalice Scope.

---

# 148. Context Cleanup

Deberá ejecutarse incluso ante Exceptions.

---

# 149. Context Stack

Runtime podrá mantener Stack para Contexts anidados.

---

# 150. Stack Discipline

Deberá respetar:

```text
push A
  push B
  pop B
pop A
```

---

# 151. Stack Corruption

Deberá detectarse cuando sea posible.

---

# 152. Context Reentrancy

Deberá soportarse cuando el Runtime lo requiera.

---

# 153. Context Security

ENG-024 gobernará controles generales.

---

# 154. Context Injection Attack

Input externo no deberá poder establecer arbitrariamente:

```text
principal
roles
permissions
tenant
internal trust flags
system identity
```

---

# 155. Correlation ID Injection

IDs externos deberán:

```text
validate format
limit length
sanitize logs
regenerate when invalid
```

---

# 156. Trace Context Abuse

Deberán aplicarse límites y validación.

---

# 157. Baggage Injection

No deberá permitir crecimiento ilimitado o Secrets.

---

# 158. Deadline Manipulation

Client no deberá poder ampliar Deadlines internos más allá de Policy.

---

# 159. Cancellation Abuse

Cancellation externa deberá afectar únicamente operaciones autorizadas.

---

# 160. Tenant Spoofing

Deberá prevenirse mediante Tenant Resolution confiable.

---

# 161. Principal Spoofing

Deberá prevenirse mediante Authentication.

---

# 162. Context Privilege Escalation

Enrichment no autorizado deberá rechazarse.

---

# 163. Context Audit

Cambios sensibles podrán auditarse.

---

# 164. Audit Events

Podrán incluir:

```text
principal established
tenant resolved
impersonation started
impersonation ended
trust boundary crossed
context rejected
context sanitized
```

---

# 165. Audit Data

No deberá incluir:

```text
credentials
tokens
secrets
full baggage
sensitive personal data
```

salvo requisito explícito y protección adecuada.

---

# 166. Observability

ENG-025 gobernará Telemetry.

---

# 167. Logging Context

Podrá enriquecer Logs con:

```text
correlationId
traceId
operation
component
```

cuando sea seguro.

---

# 168. Sensitive Context Logging

No deberán registrarse automáticamente:

```text
authorization tokens
session tokens
credentials
security attributes
full principal
full baggage
```

---

# 169. Metrics Context

No deberá convertir identificadores de alta cardinalidad en Labels.

---

# 170. Trace Context

Deberá utilizarse para Tracing, no como Metric Label general.

---

# 171. Context Diagnostics

Deberá poder determinar:

```text
scope
owner
lifetime
correlation
causation
trace presence
principal presence
tenant presence
deadline
cancellation
propagation policy
```

sin revelar información sensible.

---

# 172. Context Leak Diagnostics

Deberá permitir detectar Context que sobreviva a su Scope.

---

# 173. Testing

ENG-009 gobernará Testing.

---

# 174. Context Creation Test

Deberá comprobar valores iniciales.

---

# 175. Scope Test

Deberá comprobar que Context termina con su Scope.

---

# 176. Propagation Test

Deberá cubrir:

```text
sync call
async task
thread pool
message
job
workflow step
remote request
```

---

# 177. Isolation Test

Deberá ejecutar múltiples Contexts concurrentes.

---

# 178. Leakage Test

Deberá comprobar Worker Reuse.

---

# 179. Fork Test

Deberá verificar:

```text
correlation inheritance
new operation identity
trace child
tenant inheritance
deadline restriction
cancellation propagation
```

---

# 180. Detached Fork Test

Deberá comprobar que Request-only Values no sobrevivan.

---

# 181. Serialization Test

Deberá verificar Schema y Size Limits.

---

# 182. Trust Test

Deberá intentar introducir Security Context falso.

---

# 183. Tenant Test

Deberá intentar Tenant Spoofing.

---

# 184. Principal Test

Deberá intentar Principal Spoofing.

---

# 185. Deadline Test

Deberá comprobar que Child Deadline no exceda Parent.

---

# 186. Cancellation Test

Deberá comprobar propagación y Cleanup.

---

# 187. Baggage Test

Deberá comprobar:

```text
entry limit
key limit
value limit
total size
forbidden data
```

---

# 188. Stack Test

Deberá comprobar Context nesting.

---

# 189. Concurrency Test

Deberá comprobar ausencia de Context Cross-Talk.

---

# 190. Security Test

Deberá intentar:

```text
context injection
tenant spoofing
principal spoofing
baggage overflow
deadline extension
unauthorized enrichment
cross-request leakage
```

---

# 191. Architecture Test

Podrá impedir:

```text
mutable global request context
domain dependency on thread-local
unbounded baggage
security context from raw input
context persistence without schema
fire-and-forget inheriting request context
```

---

# 192. Build Integration

ENG-012 podrá validar:

```text
context key collision
reserved namespace violation
context field without propagation policy
serialized context without version
baggage without size limit
sensitive field marked propagable
```

---

# 193. CLI

ENG-007 podrá proporcionar:

```text
mef context:list
mef context:show
mef context:keys
mef context:policy
mef context:validate
mef context:diagnose
```

---

# 194. `context:list`

Podrá mostrar Context Types registrados.

---

# 195. `context:show`

Podrá mostrar:

```text
scope
owner
lifetime
fields
propagation
trust
```

---

# 196. `context:keys`

Podrá mostrar Keys registradas y Namespace.

---

# 197. `context:policy`

Podrá mostrar Propagation Policy.

---

# 198. `context:validate`

Podrá validar Snapshot o Serialized Context sin revelar Secrets.

---

# 199. `context:diagnose`

Podrá mostrar:

```text
current context type
scope
deadline
cancellation state
trace presence
principal presence
tenant presence
```

---

# 200. Registry Integration

ENG-020 podrá registrar:

```text
ContextType
ContextKey
ContextPropagationPolicy
ContextSerializer
ContextExtractor
ContextInjector
```

---

# 201. Context Type

Conceptualmente:

```text
ContextType
├── id
├── owner
├── scope
├── lifetime
├── fields
└── propagationPolicy
```

---

# 202. Context Key Definition

Conceptualmente:

```text
ContextKeyDefinition
├── key
├── type
├── owner
├── propagation
├── trust
├── sensitive
└── sizeLimit
```

---

# 203. Context Manager

Conceptualmente:

```text
ContextManager
├── current
├── create
├── capture
├── restore
├── fork
├── enrich
├── clear
└── diagnose
```

---

# 204. Context Propagator

Conceptualmente:

```text
ContextPropagator
├── extract
├── validate
├── sanitize
├── inject
└── clear
```

---

# 205. Context Snapshot

Conceptualmente:

```text
ContextSnapshot
├── version
├── type
├── values
├── createdAt
└── metadata
```

---

# 206. Context Serializer

Deberá serializar únicamente Fields permitidos.

---

# 207. Context Extractor

Extrae información de Boundary externo.

---

# 208. Context Injector

Inserta Context permitido en Transport de salida.

---

# 209. Bootstrap

ENG-027 deberá construir Context Management antes de aceptar trabajo externo.

---

# 210. Bootstrap Flow

```text
Configuration
      │
      ▼
Context Registry
      │
      ▼
Context Keys
      │
      ▼
Propagation Policies
      │
      ▼
Serializers
      │
      ▼
Extractors / Injectors
      │
      ▼
Security Validation
      │
      ▼
Runtime Ready
```

---

# 211. Bootstrap Failure

Podrá impedir Readiness ante:

```text
duplicate reserved key
invalid propagation policy
invalid serializer
security context authority missing
tenant context authority missing
```

---

# 212. Shutdown

Context Manager deberá dejar de crear Contexts de trabajo después de Quiesce cuando corresponda.

---

# 213. Shutdown Cleanup

Deberá limpiar Context Storage restante.

---

# 214. Lifecycle Integration

ENG-055 deberá crear Lifecycle Context independiente para operaciones administrativas.

---

# 215. Request Entry

Conceptualmente:

```text
Incoming Request
       │
       ▼
Extract External Context
       │
       ▼
Validate
       │
       ▼
Authenticate
       │
       ▼
Resolve Tenant
       │
       ▼
Build Trusted Context
       │
       ▼
Execute
       │
       ▼
Clear Context
```

---

# 216. Message Entry

Conceptualmente:

```text
Incoming Message
       │
       ▼
Extract Metadata
       │
       ▼
Validate
       │
       ▼
Build Message Context
       │
       ▼
Resolve Security/Tenant
       │
       ▼
Execute Handler
       │
       ▼
Clear Context
```

---

# 217. Background Execution

Conceptualmente:

```text
Job Trigger
    │
    ▼
Create Job Context
    │
    ▼
Resolve System Identity
    │
    ▼
Resolve Tenant if required
    │
    ▼
Set Deadline
    │
    ▼
Execute
    │
    ▼
Clear
```

---

# 218. Context Propagation Matrix

La implementación deberá poder expresar una matriz equivalente a:

| Context Value | Sync | Async | HTTP | Message | Job | Workflow |
|---|---:|---:|---:|---:|---:|---:|
| Correlation | Yes | Yes | Yes | Yes | Yes | Yes |
| Causation | Derive | Derive | Optional | Yes | Yes | Yes |
| Trace | Yes | Yes | Yes | Yes | Yes | Yes |
| Principal | Yes | Policy | Re-auth | Policy | System | Re-evaluate |
| Tenant | Yes | Yes | Resolve | Resolve | Explicit | Explicit |
| Locale | Yes | Yes | Optional | Optional | Config | Persist selected |
| Deadline | Yes | Shorten | Policy | Policy | Job Policy | Step Policy |
| Cancellation | Yes | Yes | Transport | Handler | Job | Step |
| Baggage | Policy | Policy | Limited | Limited | Limited | Minimal |

---

# 219. Security Context Rule

La matriz anterior no deberá interpretarse como permiso para confiar en Context recibido externamente.

---

# 220. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
ContextId
ContextScope

ExecutionContext
RequestContext
OperationContext

CorrelationContext
CausationContext
TraceContext

SecurityContext
PrincipalContext
TenantContext

DeadlineContext
CancellationContext

ContextKey
ContextSnapshot

ContextManager
ContextPropagator

ContextError
```

---

# 221. Optional Initial Components

Podrán incorporarse:

```text
LocaleContext
ContextSerializer
ContextExtractor
ContextInjector
ContextPolicy
ContextDiagnostics
```

---

# 222. Later Components

Solo cuando exista necesidad demostrada:

```text
Distributed Context Registry
Cross-Region Context Propagation
Context Federation
Dynamic Context Schemas
Adaptive Context Sampling
```

---

# 223. Estructura Conceptual de Directorios

```text
src/
└── Context/
    ├── Definition/
    │   ├── ContextId
    │   ├── ContextScope
    │   ├── ContextKey
    │   └── ContextType
    │
    ├── Execution/
    │   ├── ExecutionContext
    │   ├── RequestContext
    │   └── OperationContext
    │
    ├── Correlation/
    │   ├── CorrelationContext
    │   └── CausationContext
    │
    ├── Trace/
    │   └── TraceContext
    │
    ├── Security/
    │   ├── SecurityContext
    │   ├── PrincipalContext
    │   └── TenantContext
    │
    ├── Deadline/
    │   └── DeadlineContext
    │
    ├── Cancellation/
    │   └── CancellationContext
    │
    ├── Snapshot/
    │   └── ContextSnapshot
    │
    ├── Propagation/
    │   ├── ContextPropagator
    │   ├── ContextExtractor
    │   └── ContextInjector
    │
    ├── Serialization/
    │   └── ContextSerializer
    │
    ├── Runtime/
    │   └── ContextManager
    │
    ├── Diagnostics/
    │   └── ContextDiagnostics
    │
    └── Error/
        └── ContextError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 224. Error Handling

ENG-023 gobernará Error Translation.

---

# 225. Error Namespace

ENG-056 utilizará:

```text
MEF-CONTEXT-xxx
```

---

# 226. Taxonomía ENG-056

```text
MEF-CONTEXT-001 Context not found
MEF-CONTEXT-002 Context type invalid
MEF-CONTEXT-003 Context owner missing
MEF-CONTEXT-004 Context scope invalid
MEF-CONTEXT-005 Context lifetime invalid
MEF-CONTEXT-006 Context key invalid
MEF-CONTEXT-007 Context key collision
MEF-CONTEXT-008 Reserved context key violation
MEF-CONTEXT-009 Context value invalid
MEF-CONTEXT-010 Context propagation rejected
MEF-CONTEXT-011 Context extraction failed
MEF-CONTEXT-012 Context injection failed
MEF-CONTEXT-013 Context serialization failed
MEF-CONTEXT-014 Context deserialization failed
MEF-CONTEXT-015 Context validation failed
MEF-CONTEXT-016 Context version unsupported
MEF-CONTEXT-017 Context size exceeded
MEF-CONTEXT-018 Context baggage exceeded
MEF-CONTEXT-019 Context trust violation
MEF-CONTEXT-020 Context principal invalid
MEF-CONTEXT-021 Context tenant invalid
MEF-CONTEXT-022 Context deadline exceeded
MEF-CONTEXT-023 Context cancellation requested
MEF-CONTEXT-024 Context leakage detected
MEF-CONTEXT-025 Context stack corrupted
MEF-CONTEXT-026 Context cross-scope violation
MEF-CONTEXT-027 Context authorization denied
MEF-CONTEXT-028 Context security violation
MEF-CONTEXT-029 Context cleanup failed
MEF-CONTEXT-030 Context invariant violation
```

---

# 227. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Context Scope
Explicit Lifetime
Immutable Context
Typed Context Values
Explicit Async Propagation
Explicit Remote Propagation
Correlation
Causation
Trace Propagation
Trusted Principal Resolution
Trusted Tenant Resolution
Deadline Propagation
Cancellation Propagation
Bounded Baggage
Boundary Validation
Context Cleanup
Context Isolation
Observability
Testing
```

---

# 228. First Version Non-Goals

No deberá requerir:

```text
Distributed Context Registry
Context Federation
Cross-Region Context Consensus
Dynamic Context Schemas
Adaptive Context Propagation
```

---

# 229. Second Phase

Podrá incorporar:

```text
Advanced Context Policies
Context Version Negotiation
Context Snapshots
Advanced Baggage Controls
Cross-Process Context Diagnostics
```

---

# 230. Third Phase

Solo cuando exista necesidad demostrada:

```text
Context Federation
Cross-Region Context Propagation
Distributed Context Governance
Dynamic Context Schemas
Adaptive Context Sampling
```

---

# 231. Invariantes de Ingeniería

ENG-056 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-1066 | Todo Context administrado por MEF deberá poseer Scope, Lifetime y Owner conocidos y ningún Context de Request, Operation, Principal o Tenant deberá sobrevivir accidentalmente a la ejecución que representa. |
| EI-1067 | Context deberá representar únicamente información transversal de ejecución y no deberá convertirse en Service Locator, Configuration Store, Domain State, Resource Owner o Arbitrary Mutable Bag. |
| EI-1068 | Context Values deberán poseer Type, Namespace y Propagation Policy conocidos cuando sean extensibles, y Baggage deberá permanecer acotado en cantidad, tamaño y sensibilidad. |
| EI-1069 | Correlation, Causation y Trace deberán permanecer semánticamente diferenciados: Correlation agrupa trabajo relacionado, Causation identifica causa inmediata y Trace representa causalidad técnica observable. |
| EI-1070 | Security Context, Principal Context y Tenant Context deberán construirse exclusivamente a partir de Authorities confiables y ningún Header, Message Metadata o Input externo deberá establecer directamente Identity, Permissions, Tenant o Trust Flags internos. |
| EI-1071 | Context Propagation deberá ser explícita en Async, Thread, Process, Network, Message, Job, Workflow y Persistence Boundaries, y cada Boundary deberá definir qué Values se heredan, copian, derivan, descartan o revalidan. |
| EI-1072 | Context Capture deberá producir Snapshots acotados sin referencias mutables arbitrarias y toda Restoration deberá poseer Cleanup determinístico para impedir Leakage entre Requests, Tasks o Workers reutilizados. |
| EI-1073 | Child Contexts deberán preservar únicamente información permitida, crear identidad operacional propia cuando corresponda y nunca ampliar Deadline, Authority, Permissions o Tenant Scope del Parent. |
| EI-1074 | Fire-and-Forget, Background Jobs y operaciones Detached no deberán heredar ciegamente Request Context cuya Lifetime termine antes que la ejecución derivada y deberán crear Context propio. |
| EI-1075 | Serialized Context deberá poseer Schema, Version, Allowed Fields y Size Limits explícitos y todo Context recibido desde Boundary externo deberá considerarse no confiable hasta completar Validation y Sanitization. |
| EI-1076 | Tenant Context deberá permanecer aislado entre Tenants y no deberá fusionarse, sobrescribirse o propagarse Cross-Tenant sin operación explícitamente autorizada y validada conforme ENG-048. |
| EI-1077 | Deadline deberá propagarse de Parent a Child sin ampliarse, Cancellation deberá propagarse cooperativamente según Contract y ninguna de ambas deberá interpretarse como garantía de reversión de Side Effects externos. |
| EI-1078 | Context Storage físico deberá abstraerse del código de dominio y ningún componente de dominio deberá depender directamente de Thread-Local, Async-Local, Fiber-Local o mecanismo específico del Runtime. |
| EI-1079 | Request, Principal y Tenant Context no deberán almacenarse en Mutable Global State y todo Worker, Thread o Task reutilizable deberá limpiar Context anterior antes de procesar nueva ejecución. |
| EI-1080 | Context Security deberá prevenir Context Injection, Principal Spoofing, Tenant Spoofing, Baggage Overflow, Deadline Manipulation, Unauthorized Enrichment y Cross-Request Leakage. |
| EI-1081 | Context Observability deberá permitir Correlation, Tracing y Diagnostics sin registrar Credentials, Tokens, Secrets, Security Attributes sensibles, Baggage completo ni identificadores de alta cardinalidad como Metric Labels. |
| EI-1082 | Context Testing deberá cubrir Creation, Scope, Sync/Async Propagation, Thread Reuse, Messaging, Jobs, Workflow, Fork, Detached Execution, Serialization, Trust, Tenant Isolation, Deadline, Cancellation, Baggage y Concurrency. |
| EI-1083 | Build y Architecture Tests deberán detectar Mutable Global Context, Domain Dependencies sobre Thread-Local, Baggage no acotado, Security Context derivado de Raw Input, Serialized Context sin Version y Fire-and-Forget heredando Request Context. |
| EI-1084 | Runtime, Lifecycle, Messaging, Scheduling, Workflow, API, Authentication, Authorization, IAM y Multi-Tenancy deberán utilizar un modelo de Context coherente y no implementar mecanismos paralelos incompatibles de Correlation, Identity, Tenant o Cancellation. |
| EI-1085 | La primera implementación deberá favorecer Contexts tipados e inmutables, Propagation explícita, Correlation, Causation, Trace, Trusted Principal/Tenant Resolution, Deadline, Cancellation, Bounded Baggage, Boundary Validation, Cleanup e Isolation antes de introducir Federation o Context Management distribuido. |

---

# 232. Continuidad de Invariantes

```text
ENG-052 → EI-986 a EI-1005
ENG-053 → EI-1006 a EI-1025
ENG-054 → EI-1026 a EI-1045
ENG-055 → EI-1046 a EI-1065
ENG-056 → EI-1066 a EI-1085
```

---

# 233. Criterios de Conformidad

Una implementación será conforme con ENG-056 cuando:

- defina Context Scope;
- defina Context Lifetime;
- defina Context Owner;
- diferencie Correlation, Causation y Trace;
- implemente Execution Context;
- implemente Request Context;
- implemente Operation Context;
- construya Principal desde fuente confiable;
- construya Tenant desde fuente confiable;
- propague Deadlines;
- propague Cancellation;
- limite Baggage;
- tipifique Context Values;
- controle Namespaces;
- defina Propagation Policy;
- capture Context explícitamente en Async Boundaries;
- restaure Context con Cleanup;
- evite Context Leakage;
- cree Context propio para Background Jobs;
- controle Fire-and-Forget;
- serialice únicamente Values permitidos;
- versione Context serializado;
- valide Context externo;
- sanitice Context;
- respete Trust Boundaries;
- preserve Tenant Isolation;
- evite Mutable Global Context;
- abstraiga Runtime Storage;
- proteja información sensible;
- permita Diagnostics;
- pruebe Concurrency e Isolation.

---

# 234. Riesgos

Deberán evitarse especialmente:

## Mutable Global Context

```text
CurrentTenant = tenantA
```

compartido entre Requests.

## Thread-Local Leakage

Un Worker reutilizado conserva Context anterior.

## Async Context Loss

```text
Request
  │
  ▼
Async Task
  │
  ▼
correlation = null
tenant = null
```

## Context Injection

Un Client envía:

```text
X-Internal-Role: admin
```

y el sistema lo acepta como Authority.

## Tenant Spoofing

```text
X-Tenant-ID: victim
```

se acepta sin resolución autorizada.

## Principal Spoofing

Identity se deriva de Metadata no autenticada.

## Context as Service Locator

```text
context.get(Database::class)
context.get(PaymentService::class)
```

## Arbitrary Baggage

Se transportan objetos completos entre servicios.

## Baggage Explosion

Cada componente añade Metadata sin límites.

## Deadline Expansion

Child Operation obtiene más tiempo que Parent.

## Cancellation Assumption

Código asume que Cancellation revirtió una operación externa.

## Fire-and-Forget Request Capture

Una tarea de horas conserva Context de Request terminada.

## Context Persistence

Execution Context completo se guarda en Database.

## Workflow Authentication Freeze

Un Workflow de meses reutiliza Permissions antiguas.

## Cross-Tenant Context Merge

Dos Contexts de Tenants diferentes se combinan.

## Context Log Leakage

Tokens o Credentials terminan en Logs.

## Context Cardinality Explosion

`requestId` o `tenantId` se utilizan como Metric Labels.

---

# 235. Relación con ENG-025

Observability utiliza Context para:

```text
Correlation
Tracing
Log Enrichment
```

pero ENG-025 no deberá convertirse en Owner de Principal o Tenant Context.

---

# 236. Relación con ENG-027

Runtime proporciona primitivas para:

```text
current context
context scope
capture
restore
clear
```

---

# 237. Relación con ENG-038

Concurrency deberá preservar Isolation entre Contexts concurrentes.

---

# 238. Relación con ENG-040

Cada Job Execution deberá crear Context propio.

---

# 239. Relación con ENG-041

Messaging deberá propagar:

```text
correlation
causation
trace
selected tenant metadata
```

según Policy.

---

# 240. Relación con ENG-045

Authentication establece Principal confiable.

```text
Raw Credentials
      │
      ▼
Authentication
      │
      ▼
Trusted Principal
      │
      ▼
Principal Context
```

---

# 241. Relación con ENG-046

Authorization consume Principal/Tenant Context confiable, pero no deberá confiar en Context arbitrario proporcionado por Client.

---

# 242. Relación con ENG-047

IAM gobierna Identity.

Context transporta únicamente la representación operacional necesaria.

---

# 243. Relación con ENG-048

Multi-Tenancy determina Tenant Resolution e Isolation.

Context transporta Tenant efectivo dentro de la ejecución.

---

# 244. Relación con ENG-052

Workflow deberá persistir solo Context mínimo necesario.

```text
Execution Context
       │
       ▼
Select Persistent Fields
       │
       ▼
Workflow Context Snapshot
       │
       ▼
Persist
```

---

# 245. Relación con ENG-053

Context podrá referenciar State, pero no deberá convertirse en State Store.

---

# 246. Relación con ENG-054

Resource Acquisition podrá consumir:

```text
Tenant
Deadline
Cancellation
```

desde Context.

---

# 247. Relación con ENG-055

Lifecycle Operations podrán recibir Context administrativo con:

```text
actor
reason
deadline
cancellation
```

---

# 248. Relación con ENG-057

ENG-057 deberá formalizar **Metadata Engineering**.

La separación propuesta será:

```text
ENG-053 State Management
→ information that evolves

ENG-054 Resource Management
→ finite capabilities

ENG-055 Lifecycle Management
→ component operational existence

ENG-056 Context Management
→ execution-scoped information

ENG-057 Metadata Engineering
→ descriptive information about
  artifacts, components and models
```

ENG-057 deberá cubrir:

```text
Metadata
Metadata Identifier
Metadata Key
Metadata Value
Metadata Type
Metadata Schema
Metadata Namespace

Metadata Owner
Metadata Authority
Metadata Scope
Metadata Lifetime

Static Metadata
Runtime Metadata
Derived Metadata

Metadata Registry
Metadata Descriptor
Metadata Provider

Metadata Annotation
Metadata Attribute
Metadata Tag
Metadata Label

Metadata Discovery
Metadata Resolution
Metadata Inheritance
Metadata Override
Metadata Merge

Metadata Validation
Metadata Normalization
Metadata Versioning
Metadata Compatibility

Metadata Serialization
Metadata Indexing
Metadata Query

Metadata Security
Metadata Sensitivity
Metadata Audit
Metadata Observability
Metadata Testing
```

---

# 249. Principio Rector

> **MEF deberá tratar Context como información operacional acotada que acompaña una ejecución, no como almacenamiento global ni contenedor arbitrario. Todo Context deberá poseer Scope y Lifetime conocidos, toda propagación deberá respetar Boundaries y Trust, y Principal, Tenant, Deadline, Cancellation, Correlation y Trace deberán conservar semánticas explícitas durante todo el árbol de ejecución.**

---

# 250. Conclusión

**ENG-056 — Context Management Engineering** formaliza la información que acompaña cada ejecución de MEF.

La arquitectura fundamental queda:

```text
                  EXECUTION
                      │
                      ▼
                   CONTEXT
                      │
        ┌─────────────┼─────────────┐
        ▼             ▼             ▼
     IDENTITY       TENANT        TRACE
        │             │             │
        └─────────────┼─────────────┘
                      ▼
               CORRELATION
                      │
          ┌───────────┴───────────┐
          ▼                       ▼
       DEADLINE               CANCELLATION
```

La propagación queda:

```text
Parent Context
      │
      ▼
Propagation Policy
      │
 ┌────┼─────┬────────┐
 ▼    ▼     ▼        ▼
COPY FORK  DROP  REVALIDATE
      │
      ▼
Child Context
```

La frontera de confianza queda:

```text
External Context
       │
       ▼
     Extract
       │
       ▼
    Validate
       │
       ▼
    Sanitize
       │
       ▼
Authenticate / Resolve
       │
       ▼
Trusted Internal Context
```

La separación de identidad queda:

```text
Raw Input
   │
   ├── credentials
   ├── tenant hint
   └── trace metadata
   │
   ▼
Validation
   │
   ├── Authentication
   ├── Tenant Resolution
   └── Trace Validation
   │
   ▼
Execution Context
```

La ejecución asíncrona queda:

```text
Parent Task
    │
    ▼
Capture Context
    │
    ▼
Context Snapshot
    │
    ▼
Async Boundary
    │
    ▼
Restore
    │
    ▼
Child Task
    │
    ▼
Clear Context
```

La prevención de Leakage queda:

```text
Worker
  │
  ▼
Restore Context A
  │
  ▼
Execute A
  │
  ▼
CLEAR
  │
  ▼
Restore Context B
  │
  ▼
Execute B
  │
  ▼
CLEAR
```

La relación entre los cuatro documentos anteriores queda:

```text
STATE
ENG-053
What information evolves?
        │
        ▼
RESOURCE
ENG-054
What finite capacity is consumed?
        │
        ▼
LIFECYCLE
ENG-055
When may components operate?
        │
        ▼
CONTEXT
ENG-056
What information accompanies execution?
```

La primera implementación deberá concentrarse en:

```text
ContextId
ContextScope

ExecutionContext
RequestContext
OperationContext

CorrelationContext
CausationContext
TraceContext

SecurityContext
PrincipalContext
TenantContext

DeadlineContext
CancellationContext

ContextKey
ContextSnapshot

ContextManager
ContextPropagator

ContextError
```

con:

```text
Explicit Scope
Explicit Lifetime
Immutable Context
Typed Values
Explicit Propagation
Trusted Identity
Trusted Tenant
Correlation
Causation
Tracing
Deadline Propagation
Cancellation Propagation
Bounded Baggage
Boundary Validation
Context Isolation
Deterministic Cleanup
Observability
Testing
```

antes de introducir:

```text
Distributed Context Registry
Context Federation
Cross-Region Context Propagation
Dynamic Context Schemas
Adaptive Context Management
```

Con **ENG-056** la serie global alcanza:

```text
EI-1085
```

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

- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-033 — Communication Engineering
- ENG-034 — Application Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-044 — API Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-049 — Configuration Management Engineering
- ENG-052 — Workflow Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-057 — Metadata Engineering
```