---
id: ENG-034
titulo: Application Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Application Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-033
relacionados:
  - ENG-006
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-020
  - ENG-022
  - ENG-025
  - ENG-026
  - ENG-029
  - ENG-031
  - ENG-032
  - ENG-035
keywords:
  - application
  - use-case
  - command
  - query
  - handler
  - application-service
  - orchestration
  - transaction
  - dto
  - result
  - cqrs
  - mef
---

# ENG-034

# Application Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Application Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-034 establecerá las reglas para:

```text
Application Layer
Use Cases
Commands
Queries
Handlers
Application Services
Input Models
Output Models
Application Results
Orchestration
Transaction Boundaries
Authorization Coordination
Domain Invocation
Repository Invocation
Remote Contract Invocation
Event Publication
Application Errors
Idempotency
Application Testing
```

La Application Layer deberá actuar como la capa de coordinación entre las interfaces externas y el Domain.

---

# 2. Declaración

La regla fundamental será:

> **La Application Layer deberá orquestar casos de uso mediante Contracts explícitos, manteniendo las reglas de negocio dentro del Domain y los detalles tecnológicos dentro de Infrastructure.**

Por tanto:

```text
API / CLI / Event
        │
        ▼
   Application
        │
        ▼
      Domain
        │
        ▼
Infrastructure Ports
```

y no:

```text
Controller
   ↓
Database
   ↓
Business Logic
   ↓
HTTP Client
```

---

# 3. Application Layer

La `Application Layer` representa la capa encargada de ejecutar los casos de uso de una Application.

Sus responsabilidades principales serán:

```text
orchestration
coordination
transaction boundaries
authorization coordination
domain invocation
repository invocation
remote contract invocation
event publication coordination
result construction
```

---

# 4. Application ≠ Domain

Deberán mantenerse separados:

```text
Application
→ coordinates a use case

Domain
→ defines business rules and invariants
```

---

# 5. Application ≠ API

También:

```text
API
→ external/public interaction

Application
→ internal use-case execution
```

---

# 6. Application ≠ Infrastructure

Application no deberá depender directamente de tecnologías concretas.

---

# 7. Application Architecture

La arquitectura fundamental será:

```text
                INBOUND ADAPTER
                     │
                     ▼
                 APPLICATION
                     │
          ┌──────────┼──────────┐
          ▼          ▼          ▼
       Command      Query     Use Case
          │          │          │
          └──────────┼──────────┘
                     ▼
                   Handler
                     │
         ┌───────────┼───────────┐
         ▼           ▼           ▼
      Domain      Repository   Contract
         │           │           │
         └───────────┼───────────┘
                     ▼
                   Result
```

---

# 8. Use Case

Un `Use Case` representa una capacidad de Application con objetivo funcional claro.

Ejemplos:

```text
CreateCustomer
ApproveOrder
CancelPayment
RegisterEmployee
GenerateReport
```

---

# 9. Use Case Identity

Todo Use Case significativo deberá ser identificable.

---

# 10. Use Case Ownership

Todo Use Case deberá pertenecer a un Module o Application Boundary identificable.

---

# 11. Use Case Granularity

Un Use Case deberá representar una intención coherente.

Evitar:

```text
CustomerManager.doEverything()
```

---

# 12. Use Case Input

Un Use Case podrá recibir un Input Model explícito.

---

# 13. Use Case Output

Podrá producir:

```text
Result
Value
DTO
Identifier
No Content
```

según Contract.

---

# 14. Command

Un `Command` representa una intención de modificar estado o provocar una acción.

Ejemplos:

```text
CreateCustomer
ChangeEmail
CancelOrder
ActivateModule
```

---

# 15. Command Naming

Deberá expresar una intención.

Preferir:

```text
ActivateCustomer
```

sobre:

```text
CustomerData
```

---

# 16. Command Immutability

Un Command debería ser inmutable una vez creado.

---

# 17. Command Identity

Podrá poseer `commandId` cuando sea necesario para:

```text
correlation
idempotency
auditing
```

---

# 18. Command ≠ Event

Deberán distinguirse:

```text
Command
→ asks for something to happen

Event
→ states that something happened
```

---

# 19. Command ≠ DTO

Un Command posee intención semántica.

Un DTO representa estructura de transferencia.

---

# 20. Query

Una `Query` representa una solicitud de información que no debería modificar Business State observable.

---

# 21. Query Principle

Conceptualmente:

```text
Query
→ reads

Command
→ changes
```

---

# 22. Query Side Effects

Una Query podrá producir efectos técnicos no funcionales como:

```text
logging
metrics
cache population
```

sin modificar semántica del negocio.

---

# 23. Query Model

Podrá utilizar un modelo de lectura especializado.

---

# 24. Query ≠ Repository

Una Query representa intención de Application.

Repository representa Persistence Contract.

---

# 25. CQRS

MEF podrá utilizar principios de:

```text
Command Query Responsibility Segregation
```

sin obligar a una arquitectura CQRS distribuida.

---

# 26. CQRS Minimal

La separación conceptual básica será:

```text
Command
Query
```

---

# 27. CQRS Advanced

No será obligatorio utilizar:

```text
separate databases
event sourcing
independent deployments
```

---

# 28. Handler

Un `Handler` ejecuta un Command o Query.

---

# 29. Handler Responsibility

Deberá:

```text
validate application preconditions
coordinate authorization
load required state
invoke domain
persist changes
publish resulting events
return result
```

según Use Case.

---

# 30. One Handler per Operation

La primera implementación debería favorecer una relación clara:

```text
Command → CommandHandler
Query → QueryHandler
```

---

# 31. Handler ≠ Controller

Controller adapta una Boundary externa.

Handler ejecuta el caso de uso.

---

# 32. Handler ≠ Domain Service

Handler coordina.

Domain Service contiene lógica de negocio que no pertenece naturalmente a Entity/Value Object.

---

# 33. Handler Size

Un Handler demasiado grande puede indicar:

```text
business logic leakage
missing domain abstraction
excessive orchestration
poor use-case boundaries
```

---

# 34. Application Service

Un `Application Service` representa una interfaz estable para ejecutar uno o varios Use Cases relacionados.

---

# 35. Application Service Purpose

Podrá utilizarse como fachada sobre Handlers.

---

# 36. Application Service ≠ God Service

No deberá convertirse en:

```text
CustomerService
with 150 unrelated methods
```

---

# 37. Application Port

Un Use Case podrá exponerse mediante un Contract de Application.

Ejemplo:

```text
CreateCustomerUseCase
```

---

# 38. Inbound Port

Representa una capacidad de Application invocable desde Adapters.

---

# 39. Outbound Port

Representa una dependencia requerida por Application.

Ejemplos:

```text
CustomerRepository
PaymentGateway
EmailSender
Clock
IdentityProvider
```

---

# 40. Ports and Adapters

La estructura recomendada será:

```text
Inbound Adapter
      │
      ▼
Inbound Port
      │
      ▼
Application
      │
      ▼
Outbound Port
      │
      ▼
Outbound Adapter
```

---

# 41. Dependency Rule

Application deberá depender de abstracciones hacia Infrastructure.

---

# 42. Infrastructure Dependency

No deberá depender directamente de:

```text
PDO
Redis client
HTTP client
Kafka client
Filesystem driver
```

cuando exista un Port apropiado.

---

# 43. DTO

Un `DTO` representa datos transferidos entre Boundaries.

---

# 44. Input DTO

Podrá representar Input ya validado estructuralmente por Adapter.

---

# 45. Output DTO

Podrá representar un resultado listo para mapear a API/CLI/Event.

---

# 46. DTO ≠ Entity

No deberán confundirse.

---

# 47. DTO ≠ Command

Un DTO puede ser estructura genérica.

Un Command representa intención.

---

# 48. Mapping

Podrá existir:

```text
API DTO
   ↓
Mapper
   ↓
Application Command
```

---

# 49. Application Input

La Application no debería depender de objetos específicos de Protocol.

---

# 50. No HTTP Request in Handler

Un Handler no deberá recibir directamente:

```text
HttpRequest
```

como Contract de negocio.

---

# 51. No Framework Request

Tampoco deberá depender de objetos propietarios de frameworks Web.

---

# 52. Application Result

Un `ApplicationResult` representa el resultado de un Use Case.

---

# 53. ApplicationResult

Conceptualmente:

```text
ApplicationResult<T>
├── success
├── value
├── error
├── metadata
└── correlationId
```

---

# 54. Result Pattern

No será obligatorio para todos los Use Cases.

ENG-023 seguirá gobernando Error Handling.

---

# 55. Expected Failure

Podrá representarse explícitamente en Result cuando forme parte normal del Use Case.

---

# 56. Unexpected Failure

Podrá propagarse mediante Error Mechanism correspondiente.

---

# 57. Application Error

Representa Failure propia de coordinación de Use Case.

Ejemplos:

```text
UseCaseNotAllowed
RequiredDependencyUnavailable
OperationConflict
ApplicationPreconditionFailed
```

---

# 58. Domain Error

No deberá convertirse automáticamente en Application Error.

---

# 59. Error Translation

Application podrá traducir Domain/Infrastructure Failures cuando cambie la abstracción.

---

# 60. Error Namespace

ENG-034 utilizará:

```text
MEF-APP-xxx
```

---

# 61. Taxonomía ENG-034

```text
MEF-APP-001 Application operation not found
MEF-APP-002 Application input invalid
MEF-APP-003 Application precondition failed
MEF-APP-004 Application authorization failed
MEF-APP-005 Required application dependency unavailable
MEF-APP-006 Command handler not found
MEF-APP-007 Query handler not found
MEF-APP-008 Multiple command handlers detected
MEF-APP-009 Multiple query handlers detected
MEF-APP-010 Application operation conflict
MEF-APP-011 Application transaction failed
MEF-APP-012 Application result mapping failed
MEF-APP-013 Application idempotency conflict
MEF-APP-014 Application timeout
MEF-APP-015 Application cancelled
MEF-APP-016 Application orchestration failed
MEF-APP-017 Application contract violation
MEF-APP-018 Unsupported application operation
MEF-APP-019 Application lifecycle violation
MEF-APP-020 Application invariant violated
```

---

# 62. Handler Not Found

```text
MEF-APP-006

Command handler not found.

Command:
CreateCustomer
```

---

# 63. Multiple Handlers

```text
MEF-APP-008

Multiple command handlers detected.

Command:
CreateCustomer

Handlers:
CustomerCreateHandler
LegacyCustomerCreateHandler
```

---

# 64. Precondition Failure

```text
MEF-APP-003

Application precondition failed.

Operation:
ApproveOrder

Reason:
Required approval context is unavailable.
```

---

# 65. Transaction Failure

```text
MEF-APP-011

Application transaction failed.

Operation:
CreateCustomer
```

---

# 66. Orchestration

Application deberá coordinar componentes sin absorber su lógica.

---

# 67. Orchestration Example

```text
CreateOrderHandler
      │
      ├── authorize
      ├── load customer
      ├── invoke Order domain
      ├── save order
      └── publish OrderCreated
```

---

# 68. Orchestration ≠ Business Rule

Ejemplo incorrecto:

```text
if total > 10000 and customer age > 65...
```

si esa regla pertenece al Domain.

---

# 69. Domain Invocation

Application deberá invocar comportamiento del Domain en lugar de modificar State interno directamente.

---

# 70. Tell, Don't Mutate

Preferir:

```text
order.cancel(reason)
```

sobre:

```text
order.status = "cancelled"
```

cuando exista comportamiento de Domain.

---

# 71. Transaction Boundary

Application Layer será normalmente la Boundary responsable de coordinar Transactions de Use Case.

---

# 72. Transaction Begin

Podrá iniciar antes de modificar Persistence State.

---

# 73. Transaction Commit

Deberá ocurrir después de que el Use Case alcance estado consistente.

---

# 74. Transaction Rollback

Deberá ejecutarse ante Failure conforme ENG-030.

---

# 75. External Calls in Transaction

Deberán evitarse Transactions largas que incluyan llamadas remotas cuando sea posible.

---

# 76. Why

Porque incrementan:

```text
lock duration
latency
failure coupling
deadlock risk
resource usage
```

---

# 77. Transaction Scope

Deberá ser lo más pequeño posible preservando Atomicity requerida.

---

# 78. Cross-Module Transaction

No deberá utilizarse como Default.

---

# 79. Outbox

Cuando Application modifique Persistence y publique Event podrá utilizar Outbox conforme ENG-030.

---

# 80. Application Event Publication

El Handler podrá registrar Events producidos por el Domain.

---

# 81. Domain Event Collection

Podrá utilizarse:

```text
Aggregate
  ↓
Domain Events
  ↓
Application
  ↓
Event Publisher
```

---

# 82. Publish After Commit

La semántica deberá definirse explícitamente.

---

# 83. Transactional Outbox

Será preferible cuando se requiera Atomicity entre State y Event Publication.

---

# 84. Event Publication Failure

No deberá dejar State inconsistente sin estrategia explícita.

---

# 85. Authorization

ENG-024 será autoridad.

---

# 86. Application Authorization

Application podrá coordinar Authorization de Use Case.

---

# 87. Authorization Before Business Mutation

Deberá ocurrir antes de ejecutar acciones sensibles.

---

# 88. Authorization Context

Podrá considerar:

```text
principal
resource
tenant
operation
```

---

# 89. Policy Invocation

Application deberá utilizar Authorization Contract.

---

# 90. No Role Hardcoding

Business Logic no debería contener:

```text
if role == "ADMIN"
```

como mecanismo universal.

---

# 91. Domain Authorization

Algunas reglas de negocio relacionadas con autoridad podrán pertenecer al Domain.

La frontera deberá evaluarse semánticamente.

---

# 92. Application Precondition

Una `Application Precondition` representa una condición necesaria para ejecutar un Use Case que no es una regla interna del Domain.

Ejemplo:

```text
required dependency available
request has identity
feature is enabled
```

---

# 93. Domain Invariant

Pertenece al Domain.

---

# 94. Infrastructure Availability

Pertenece a Application/Infrastructure coordination.

---

# 95. Feature Flags

Application podrá consultar Feature Flags.

---

# 96. Feature Flag ≠ Authorization

No deberán confundirse.

---

# 97. Clock

La Application deberá depender de un Clock Contract cuando Time afecte comportamiento testeable.

---

# 98. Direct System Time

No debería usarse indiscriminadamente en Use Cases.

---

# 99. Identifier Generator

Podrá utilizar un Contract explícito.

---

# 100. Randomness

También deberá abstraerse cuando afecte determinismo o Testing.

---

# 101. Remote Contract Invocation

Application podrá invocar capacidades remotas mediante Typed Contracts.

---

# 102. No Raw HTTP

No deberá construir URLs/Headers directamente salvo Adapter.

---

# 103. Remote Failure

Deberá interpretarse según Contract y ENG-032.

---

# 104. Timeout

Un Use Case podrá poseer Deadline propio.

---

# 105. Deadline Propagation

Deberá propagarse a Calls downstream cuando corresponda.

---

# 106. Cancellation

Application podrá respetar Cancellation.

---

# 107. Cancellation Safety

No deberá dejar Business State inconsistente.

---

# 108. Idempotency

Commands susceptibles a duplicación podrán requerir Idempotency.

---

# 109. Idempotency Ownership

Application será normalmente responsable de la semántica del Use Case.

Transport podrá aportar Key/Mechanism.

---

# 110. Idempotency Key

Deberá incluirse explícitamente cuando el Contract lo requiera.

---

# 111. Same Key Same Operation

Una repetición válida deberá producir resultado coherente.

---

# 112. Same Key Different Command

Deberá producir Conflict.

---

# 113. Idempotency Store

Podrá utilizar Persistence.

---

# 114. Idempotency Retention

Deberá definirse según Use Case.

---

# 115. Idempotency ≠ Deduplication Only

Debe conservar semántica del resultado.

---

# 116. Command Bus

MEF podrá proporcionar:

```text
CommandBus
```

---

# 117. CommandBus Responsibility

Resolver:

```text
Command
→ Handler
```

---

# 118. CommandBus ≠ Event Bus

Deberán mantenerse separados.

---

# 119. Command Bus Cardinality

Normalmente:

```text
1 Command
→ 1 Handler
```

---

# 120. Event Bus Cardinality

Normalmente:

```text
1 Event
→ 0..N Handlers
```

---

# 121. Command Handler Registry

ENG-020 podrá registrar Handlers.

---

# 122. Duplicate Command Handler

Deberá rechazarse salvo Contract explícito.

---

# 123. Query Bus

Podrá existir:

```text
QueryBus
```

---

# 124. QueryBus Responsibility

Resolver:

```text
Query
→ QueryHandler
```

---

# 125. Query Handler Cardinality

Normalmente:

```text
1 Query
→ 1 Handler
```

---

# 126. Bus Is Optional

La Application Layer no deberá requerir CommandBus/QueryBus para ser válida.

---

# 127. Direct Invocation

También podrá utilizar:

```text
UseCaseInterface
→ Handler
```

---

# 128. Bus Trade-Off

Un Bus aporta:

```text
uniform dispatch
middleware
instrumentation
handler registry
```

pero añade indirección.

---

# 129. Middleware

Command/Query Dispatch podrá soportar Middleware explícito.

---

# 130. Application Middleware

Podrá implementar:

```text
authorization
transactions
logging
metrics
idempotency
validation
```

cuando la semántica sea apropiada.

---

# 131. Middleware Order

Deberá ser explícito.

---

# 132. Hidden Middleware

No deberá cambiar semántica del Use Case de forma impredecible.

---

# 133. Middleware Chain

Conceptualmente:

```text
Command
  ↓
Authorization
  ↓
Idempotency
  ↓
Transaction
  ↓
Handler
```

La secuencia definitiva dependerá del Use Case.

---

# 134. Middleware Failure

Deberá integrarse con ENG-023.

---

# 135. Transaction Middleware

Podrá envolver Commands que requieran Transaction.

---

# 136. Query Transaction

Queries podrán requerir Transaction de lectura en ciertos Storage Profiles.

No será obligatorio.

---

# 137. Validation Middleware

Solo deberá cubrir Validation apropiada a Application Boundary.

---

# 138. Application Pipeline

Podrá existir:

```text
ApplicationPipeline
```

---

# 139. Pipeline Explicitness

La composición deberá ser inspeccionable.

---

# 140. Application Context

Podrá existir:

```text
ApplicationContext
```

---

# 141. Recommended ApplicationContext

Conceptualmente:

```text
ApplicationContext
├── correlationId
├── principal
├── tenant
├── deadline
├── locale
└── metadata
```

---

# 142. Context ≠ Global State

No deberá utilizarse como bolsa de dependencias arbitrarias.

---

# 143. No Service Locator Context

No deberá contener Container completo.

---

# 144. Principal

ENG-024 gobernará identidad.

---

# 145. Tenant

Deberá propagarse cuando Application sea Multi-Tenant.

---

# 146. Locale

Podrá ser útil para Presentation-related behavior.

No deberá alterar Contracts machine-oriented arbitrariamente.

---

# 147. Correlation

ENG-025 gobernará Trace/Correlation.

---

# 148. Application Logging

Deberá incluir Operation ID cuando sea posible.

---

# 149. Operation ID

Podrá coincidir con Use Case identity.

---

# 150. Observability

ENG-025 gobernará Telemetry.

---

# 151. Application Metrics

Podrán incluir:

```text
mef.application.operations.total
mef.application.failures.total
mef.application.duration
mef.application.inflight
```

---

# 152. Dimensions

Podrán utilizar:

```text
module
operation
result
```

con Cardinality controlada.

---

# 153. Application Span

Podrá utilizar:

```text
application.command
application.query
application.usecase
```

---

# 154. Span Attributes

Podrán incluir:

```text
mef.application.operation
mef.module.id
error.code
```

---

# 155. Business Data in Metrics

No deberá utilizarse innecesariamente.

---

# 156. Sensitive Input Logging

No deberá hacerse por Default.

---

# 157. Performance

ENG-026 gobernará Performance.

---

# 158. Handler Latency

Deberá poder medirse.

---

# 159. Dependency Breakdown

Tracing podrá identificar cuánto tiempo consume:

```text
Domain
Persistence
Remote Calls
Event Publication
```

---

# 160. Application Budget

Podrá existir por Use Case.

---

# 161. N+1 Orchestration

Handlers no deberán producir múltiples Calls/Queries innecesarias sin análisis.

---

# 162. Batch Use Case

Podrá ser apropiado para reducir round trips.

---

# 163. Batch Semantics

Deberá definir:

```text
atomicity
partial success
limits
```

---

# 164. Long-Running Use Case

No deberá mantener Resources/Transactions indefinidamente.

---

# 165. Workflow

Procesos de larga duración deberán delegarse a Workflow Engineering futuro.

---

# 166. Application State

La Application Layer no deberá mantener estado mutable global.

---

# 167. Request-Scoped State

Podrá existir mediante Scope.

---

# 168. Stateless Handler

Debería favorecerse cuando sea posible.

---

# 169. Handler Reentrancy

No deberá asumirse si conserva State mutable.

---

# 170. Concurrency

Use Cases deberán considerar operaciones concurrentes.

---

# 171. Persistence Conflict

Deberá manejarse conforme ENG-030.

---

# 172. Application Conflict

Podrá traducirse a:

```text
MEF-APP-010
```

cuando cambie la abstracción.

---

# 173. Retry

Application no deberá reintentar ciegamente todo Use Case.

---

# 174. Retry Ownership

Deberá establecerse según Failure y Boundary.

---

# 175. Domain Command Retry

Puede duplicar efectos.

Deberá considerarse Idempotency.

---

# 176. Transaction Retry

Podrá realizarse ante conflictos transitorios cuando sea seguro.

---

# 177. Remote Retry

ENG-032 gobernará detalles.

---

# 178. Application Retry Budget

Deberá respetar Deadline global.

---

# 179. Query Caching

Queries podrán utilizar Cache.

---

# 180. Cache Responsibility

Deberá estar detrás de un Contract apropiado.

---

# 181. Cached Query

No deberá violar Authorization/Tenant Isolation.

---

# 182. Cache Invalidation

Será responsabilidad de la estrategia correspondiente.

---

# 183. Query Projection

Application podrá utilizar Read Models.

---

# 184. Read Model

Podrá ser diferente del Domain Aggregate.

---

# 185. Query Optimization

No deberá obligar a cargar Aggregate completo para simples lecturas si existe Read Model adecuado.

---

# 186. Domain Loading

Commands que modifican Aggregate deberían normalmente cargar el Aggregate correspondiente.

---

# 187. Aggregate Boundary

La Application deberá respetar Aggregate boundaries definidos por Domain Engineering.

---

# 188. Multiple Aggregates

Una operación que modifica múltiples Aggregates deberá evaluar Consistency explícitamente.

---

# 189. Application Saga

Procesos multi-step distribuidos deberán delegarse a Workflow/Saga infrastructure futura.

---

# 190. Compensation

No deberá implementarse arbitrariamente dentro de un Controller.

---

# 191. Module Boundary

ENG-028 continuará gobernando Modules.

---

# 192. Application per Module

Cada Module podrá poseer su propia Application Layer.

---

# 193. Cross-Module Use Case

Deberá utilizar Contracts de otros Modules.

---

# 194. No Direct Internal Handler Invocation

Un Module no deberá invocar internals de otro como mecanismo de integración.

---

# 195. Public Application Contract

Podrá exponer un Use Case a otro Module mediante ENG-021.

---

# 196. Events

También podrán utilizarse cuando la colaboración sea eventual/desacoplada.

---

# 197. API Integration

ENG-033 deberá mapear API Operations hacia Application Use Cases.

---

# 198. Mapping Example

```text
POST /customers
      │
      ▼
CreateCustomerRequest
      │
      ▼
CreateCustomerCommand
      │
      ▼
CreateCustomerHandler
```

---

# 199. CLI Integration

ENG-007 podrá invocar los mismos Application Use Cases.

---

# 200. CLI Reuse

No deberá duplicarse lógica del Use Case dentro del Command de CLI.

---

# 201. Event Integration

Un Event Handler podrá invocar Application Use Case.

---

# 202. Event Handler Boundary

Deberá mapear Event Payload a Command/Use Case.

---

# 203. Scheduler Integration

Jobs futuros también deberían invocar Application Use Cases.

---

# 204. Unified Use Case

La misma lógica podrá reutilizarse desde:

```text
API
CLI
Event
Job
Test
```

---

# 205. Application Contract Registry

ENG-020 podrá registrar:

```text
Commands
Queries
Handlers
Use Cases
```

---

# 206. Handler Registry Entry

Conceptualmente:

```text
ApplicationHandlerEntry
├── operation
├── type
├── handler
├── module
├── transactionPolicy
├── authorizationPolicy
└── metadata
```

---

# 207. Handler Resolution

Deberá ser determinista.

---

# 208. Handler Discovery

Podrá ocurrir mediante Metadata/Manifest/Generated Registry.

---

# 209. No Runtime Reflection Requirement

No deberá obligarse a Reflection global durante cada Dispatch.

---

# 210. Build-Time Generation

Podrá utilizarse para optimizar Registry.

---

# 211. Application Manifest

ENG-003/ENG-028 podrán declarar Use Cases públicos cuando sea necesario.

---

# 212. Public Operation Metadata

Podrá incluir:

```text
operationId
command/query
handler
authorization
transaction
```

---

# 213. Testing

ENG-009 gobernará Testing.

---

# 214. Handler Unit Test

Deberá probar Use Case aislando Ports externos.

---

# 215. Domain Real Objects

Los Tests de Handler deberían utilizar Domain real cuando sea posible.

---

# 216. Fake Repository

Podrá utilizarse respetando Contract.

---

# 217. Stub Remote Contract

Podrá utilizarse.

---

# 218. Authorization Test

Deberá cubrir:

```text
allowed
denied
resource scope
tenant
```

---

# 219. Transaction Test

Deberá comprobar Commit/Rollback.

---

# 220. Event Publication Test

Deberá comprobar Events esperados.

---

# 221. Idempotency Test

Deberá comprobar repetición de Command.

---

# 222. Cancellation Test

Deberá comprobar Cleanup.

---

# 223. Timeout Test

También.

---

# 224. Integration Test

Deberá probar Application + Persistence Adapter cuando corresponda.

---

# 225. API/Application Contract Test

Deberá comprobar Mapping entre Request y Use Case.

---

# 226. CLI/Application Test

También cuando sea relevante.

---

# 227. Application Test Harness

Podrá existir:

```text
ApplicationTestHarness
```

---

# 228. In-Memory Ports

Podrán utilizarse para Tests.

---

# 229. Test Isolation

No deberá compartir estado mutable entre Tests.

---

# 230. Build Integration

ENG-012 deberá validar Application registrations.

---

# 231. Build Gate

Podrá detectar:

```text
missing handler
duplicate handler
invalid operation ID
invalid transaction policy
invalid authorization metadata
forbidden infrastructure dependency
```

---

# 232. Static Architecture Test

Podrá detectar que Application importe Infrastructure concreta.

---

# 233. Dependency Rule Gate

Ejemplo:

```text
Application
must not import
Infrastructure\Database\PostgresCustomerRepository
```

---

# 234. Command Handler Gate

Todo Command registrado deberá tener exactamente un Handler salvo Policy explícita.

---

# 235. Query Handler Gate

Igualmente.

---

# 236. Public Use Case Documentation

Deberá poder generarse Metadata.

---

# 237. Release Integration

ENG-017 deberá considerar cambios de Application Contracts públicos.

---

# 238. Application Compatibility

ENG-016 gobernará Compatibility.

---

# 239. Internal Use Case Refactor

Podrá cambiar libremente si no altera Contracts públicos.

---

# 240. Public Application Contract

Deberá versionarse cuando corresponda.

---

# 241. Deprecation

Use Cases públicos podrán marcarse Deprecated.

---

# 242. Replacement

Deberá indicarse alternativa cuando sea posible.

---

# 243. Performance Testing

ENG-026 podrá medir Handlers.

---

# 244. Application Benchmark

Podrá existir:

```text
BM-APPLICATION-DISPATCH
```

---

# 245. Dispatch Overhead

Deberá distinguirse del tiempo del Use Case.

---

# 246. Middleware Overhead

También.

---

# 247. Command Bus Performance

No deberá degradar significativamente Hot Paths sin evidencia.

---

# 248. Query Bus Performance

Igualmente.

---

# 249. Security

ENG-024 gobernará:

```text
principal
authorization
tenant
permissions
capabilities
```

---

# 250. Sensitive Use Cases

Podrán requerir Step-Up Authentication.

---

# 251. Audit

Use Cases críticos podrán generar Audit Records.

---

# 252. Audit ≠ Event

No deberán confundirse.

---

# 253. Audit Intent

Application podrá solicitar Audit mediante Contract.

---

# 254. Audit Failure Policy

Deberá seguir ENG-024.

---

# 255. Application Lifecycle

La mayoría de Handlers deberían ser Runtime Stateless.

---

# 256. Stateful Application Component

Deberá justificar Lifecycle explícito.

---

# 257. Runtime Integration

ENG-027 coordinará Registration/Construction.

---

# 258. Application Bootstrap

Conceptualmente:

```text
Discover Operations
       ↓
Discover Handlers
       ↓
Validate Registrations
       ↓
Build Handler Registry
       ↓
Build Middleware Pipelines
       ↓
Security Validation
       ↓
Ready
```

---

# 259. Runtime Readiness

Missing Handler requerido deberá impedir Readiness.

---

# 260. Runtime Shutdown

Application no deberá aceptar nuevo Workload después de Stop Admission.

---

# 261. In-Flight Use Cases

Deberán finalizar o cancelarse dentro de Shutdown Deadline.

---

# 262. Application Architecture

```text
                  INBOUND
       API / CLI / EVENT / JOB
                    │
                    ▼
              APPLICATION PORT
                    │
                    ▼
              COMMAND / QUERY
                    │
                    ▼
                  HANDLER
                    │
       ┌────────────┼────────────┐
       ▼            ▼            ▼
     DOMAIN     REPOSITORY    CONTRACT
       │            │            │
       └────────────┼────────────┘
                    ▼
                  RESULT
```

---

# 263. Clean Dependency Direction

```text
Adapter
   ↓
Application
   ↓
Domain
```

y:

```text
Infrastructure
   ▲
   │ implements
Application/Domain Port
```

---

# 264. Transaction Architecture

```text
Command
   │
   ▼
Authorization
   │
   ▼
Transaction Begin
   │
   ▼
Handler
   │
   ├── Domain
   ├── Repository
   └── Events
   │
   ▼
Commit
   │
   ▼
Result
```

La publicación externa de Events deberá respetar Outbox/Consistency Policy cuando corresponda.

---

# 265. Query Architecture

```text
Query
  │
  ▼
Authorization
  │
  ▼
Query Handler
  │
  ├── Read Model
  ├── Repository
  └── Remote Contract
  │
  ▼
Result DTO
```

---

# 266. Command Bus Architecture

```text
Command
   │
   ▼
Command Bus
   │
   ▼
Middleware
   │
   ▼
Handler Registry
   │
   ▼
Command Handler
```

---

# 267. Error Architecture

```text
Domain / Infrastructure Failure
           │
           ▼
     Application Boundary
           │
           ▼
     Application Error
           │
           ▼
        API / CLI
```

solo cuando exista cambio real de abstracción.

---

# 268. Idempotency Architecture

```text
Command
   │
   ▼
Idempotency Key
   │
   ▼
Idempotency Check
   │
 ┌─┴────────────┐
 ▼              ▼
New          Existing
 │              │
 ▼              ▼
Handler      Prior Result
 │
 ▼
Persist Result
```

---

# 269. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
UseCase
ApplicationOperation
OperationId

Command
CommandHandler

Query
QueryHandler

ApplicationService

ApplicationResult
ApplicationError

ApplicationContext

CommandBus
QueryBus

HandlerRegistry

ApplicationMiddleware
ApplicationPipeline
```

---

# 270. Optional Initial Components

Podrán incorporarse cuando exista necesidad:

```text
IdempotencyMiddleware
TransactionMiddleware
AuthorizationMiddleware
ValidationMiddleware
ApplicationTestHarness
```

---

# 271. Conceptual Directory Structure

```text
src/
└── Application/
    ├── Contract/
    │   ├── UseCase
    │   └── ApplicationOperation
    │
    ├── Command/
    │   ├── Command
    │   ├── CommandHandler
    │   └── CommandBus
    │
    ├── Query/
    │   ├── Query
    │   ├── QueryHandler
    │   └── QueryBus
    │
    ├── Service/
    │   └── ApplicationService
    │
    ├── Result/
    │   ├── ApplicationResult
    │   └── ApplicationError
    │
    ├── Context/
    │   └── ApplicationContext
    │
    ├── Registry/
    │   └── HandlerRegistry
    │
    ├── Middleware/
    │   ├── ApplicationMiddleware
    │   └── ApplicationPipeline
    │
    └── Testing/
        └── ApplicationTestHarness
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 272. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Use Cases
Commands
Queries
One Handler per Command
One Handler per Query
Thin Inbound Adapters
Explicit Outbound Ports
Application Transaction Boundaries
Application Authorization Coordination
Application Results
Deterministic Handler Resolution
Stateless Handlers
```

---

# 273. First Version Non-Goals

No deberá requerir:

```text
Distributed CQRS
Event Sourcing
Saga Engine
Workflow Engine
Distributed Transactions
Universal Command Bus
Remote Command Bus
Dynamic Handler Mutation
Automatic Business Logic Generation
```

---

# 274. Second Phase

Podrá incorporar:

```text
Advanced Middleware
Idempotency Infrastructure
Application Pipeline Generation
Read Model Infrastructure
Advanced Batch Use Cases
Consumer Contract Analysis
```

---

# 275. Third Phase

Solo cuando exista necesidad:

```text
Distributed Command Processing
Workflow/Saga Orchestration
Long-Running Process Manager
Remote Application Bus
Advanced CQRS Infrastructure
```

---

# 276. Invariantes de Ingeniería

ENG-034 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-626 | La Application Layer deberá coordinar Use Cases sin absorber las reglas de negocio que pertenecen al Domain. |
| EI-627 | Application, Domain, API e Infrastructure deberán conservar responsabilidades arquitectónicas diferenciadas. |
| EI-628 | Todo Use Case público o arquitectónicamente significativo deberá poseer identidad y Ownership determinables. |
| EI-629 | Commands deberán representar intenciones de cambio y Queries solicitudes de información con semánticas distinguibles. |
| EI-630 | Command y Event deberán permanecer conceptualmente separados: uno solicita una acción y el otro representa un hecho ocurrido. |
| EI-631 | Handlers deberán orquestar Dependencies y Domain Behavior sin convertirse en sustitutos del Domain Model. |
| EI-632 | Application Components deberán depender de Ports/Contracts y no directamente de Drivers o Infrastructure concreta cuando exista una Boundary de abstracción. |
| EI-633 | DTOs, Commands, Queries y Domain Entities deberán mantenerse como conceptos distintos aunque puedan compartir datos. |
| EI-634 | Application Transaction Boundaries deberán ser explícitas y preservar Atomicity sin mantener Transactions innecesariamente largas. |
| EI-635 | Los Calls remotos no deberán incorporarse a Transactions locales prolongadas sin una razón arquitectónica explícita. |
| EI-636 | Authorization deberá evaluarse antes de las mutaciones sensibles y no deberá sustituirse por Feature Flags o simples nombres de Roles hardcodeados. |
| EI-637 | ApplicationContext no deberá convertirse en Global Service Locator ni otorgar acceso irrestricto al Runtime o Container. |
| EI-638 | Todo Command o Query registrado deberá resolverse de forma determinista hacia el número de Handlers permitido por su Contract. |
| EI-639 | Middleware de Application deberá poseer Ordering explícito cuando el orden afecte la semántica del Use Case. |
| EI-640 | Idempotency deberá definirse a nivel de semántica del Use Case y no limitarse únicamente a eliminar Requests duplicadas. |
| EI-641 | Use Cases que combinan Persistence y Event Publication deberán utilizar una estrategia explícita de Consistency cuando una Failure intermedia pueda producir divergencia. |
| EI-642 | La misma lógica de Use Case deberá poder reutilizarse desde diferentes Inbound Adapters sin duplicar Business Logic. |
| EI-643 | Application Telemetry deberá identificar Operations mediante nombres estables y evitar exponer datos sensibles o Cardinality no controlada. |
| EI-644 | Missing Handlers, duplicate Handlers o Registration inconsistente deberán detectarse antes de Runtime Readiness cuando formen parte de la composición obligatoria. |
| EI-645 | La primera implementación deberá favorecer Application orchestration explícita y local antes de introducir CQRS distribuido, Sagas o Workflow Engines avanzados. |

---

# 277. Continuidad de Invariantes

```text
ENG-030 → EI-546 a EI-565
ENG-031 → EI-566 a EI-585
ENG-032 → EI-586 a EI-605
ENG-033 → EI-606 a EI-625
ENG-034 → EI-626 a EI-645
```

---

# 278. Criterios de Conformidad

Una implementación será conforme con ENG-034 cuando:

- defina Application Layer explícita;
- defina Use Cases;
- permita Commands;
- permita Queries;
- utilice Handlers;
- separe Handler y Controller;
- separe Application y Domain;
- utilice Ports para Infrastructure;
- permita DTOs sin confundirlos con Entities;
- defina Transaction Boundaries;
- coordine Authorization;
- permita Remote Contracts;
- integre Persistence;
- integre Events;
- permita Idempotency;
- permita Cancellation;
- permita Deadlines;
- registre Handlers de forma determinista;
- permita Middleware;
- integre Observability;
- soporte Testing;
- reutilice Use Cases desde distintos Adapters;
- no requiera CQRS distribuido.

---

# 279. Riesgos

Deberán evitarse especialmente:

## Fat Controller

La API ejecuta Business Logic.

## Fat Handler

El Handler reemplaza al Domain Model.

## Transaction Script Everywhere

Toda regla de negocio se convierte en lógica procedural de Application.

## Infrastructure Leakage

Handlers dependen de SQL, Redis o HTTP directamente.

## DTO Equals Entity

Los modelos de Boundary se convierten en Domain Objects.

## Command Equals Event

No se distingue intención de hecho.

## Query With Business Mutation

Una lectura cambia estado funcional.

## Global Application Service

Una clase concentra todos los Use Cases.

## Service Locator Context

ApplicationContext contiene Container completo.

## Hidden Transaction

Repositorios realizan Commits inesperados.

## Long Transaction

Una Transaction permanece abierta durante Calls remotos.

## Blind Retry

El Use Case completo se repite sin Idempotency.

## Middleware Magic

La semántica depende de Middleware no inspeccionable.

## Duplicate Handler

Dos Handlers compiten por el mismo Command.

## Controller-Specific Use Case

La lógica solo puede ejecutarse desde HTTP.

## Direct Cross-Module Handler Call

Un Module consume internals de otro.

## Distributed CQRS Too Early

Se introduce complejidad antes de demostrar necesidad.

---

# 280. Relación con ENG-018

Dependency Injection deberá suministrar Outbound Ports y Handler Dependencies.

---

# 281. Relación con ENG-019

Service Container construirá Handlers, Application Services y Middleware.

---

# 282. Relación con ENG-020

Registry podrá mantener Operations y Handlers.

---

# 283. Relación con ENG-021

Contracts gobiernan Inbound y Outbound Ports cuando sean públicos o cross-module.

---

# 284. Relación con ENG-022

Event Bus permitirá publicar Events resultantes de Use Cases y recibir Events mediante Adapters.

---

# 285. Relación con ENG-023

Error Handling gobierna traducción y propagación de Application Failures.

---

# 286. Relación con ENG-024

Security gobierna Principal, Authorization, Tenant y Audit.

---

# 287. Relación con ENG-025

Observability gobierna Tracing, Metrics, Logging y Correlation de Use Cases.

---

# 288. Relación con ENG-026

Performance Engineering medirá Dispatch y Use Case execution.

---

# 289. Relación con ENG-027

Runtime registrará y validará Application Infrastructure antes de Readiness.

---

# 290. Relación con ENG-028

Cada Module podrá poseer Application Layer propia y publicar Application Contracts.

---

# 291. Relación con ENG-030

Persistence proporciona Repositories, Transactions y Unit of Work.

---

# 292. Relación con ENG-032

Transport proporciona acceso a Dependencies remotas detrás de Typed Contracts.

---

# 293. Relación con ENG-033

API adapta Requests externos hacia Commands, Queries o Use Cases.

La cadena fundamental queda:

```text
API
 ↓
Application
 ↓
Domain
```

---

# 294. Relación con ENG-035

ENG-035 deberá definir formalmente el **Domain Model** que ENG-034 orquesta.

La separación será:

```text
ENG-034
Application Engineering
→ use-case orchestration

ENG-035
Domain Engineering
→ business model and rules
```

---

# 295. Principio Rector

> **La Application Layer de MEF deberá convertir una intención externa en un caso de uso coordinado, invocando Domain, Persistence y Contracts mediante Boundaries explícitas, sin absorber reglas del negocio ni detalles tecnológicos.**

---

# 296. Conclusión

**ENG-034 — Application Engineering** formaliza la capa de ejecución de casos de uso de MEF.

La arquitectura queda:

```text
              API / CLI / EVENT / JOB
                       │
                       ▼
                   APPLICATION
                       │
           ┌───────────┼───────────┐
           ▼           ▼           ▼
        Command       Query      Use Case
           │           │           │
           └───────────┼───────────┘
                       ▼
                     Handler
                       │
        ┌──────────────┼──────────────┐
        ▼              ▼              ▼
      Domain       Persistence     Contracts
        │              │              │
        └──────────────┼──────────────┘
                       ▼
                     Result
```

La separación de responsabilidades queda:

```text
API
→ exposes

Application
→ orchestrates

Domain
→ decides

Persistence
→ stores

Transport
→ communicates

Event Bus
→ distributes facts
```

Esto evita que MEF termine con una arquitectura como:

```text
Controller
   ↓
ORM
   ↓
if/else business rules
   ↓
HTTP calls
   ↓
send response
```

y establece:

```text
Inbound Adapter
      ↓
Application Use Case
      ↓
Domain
      ↓
Ports
      ↓
Infrastructure Adapters
```

La primera implementación deberá concentrarse en:

```text
Use Cases
Commands
Queries
Handlers
Application Services
Transaction Boundaries
Authorization Coordination
Ports
Results
Handler Registry
Testing
```

antes de introducir:

```text
Distributed CQRS
Saga Engines
Workflow Engines
Remote Command Buses
Advanced Process Managers
```

Con **ENG-034** la serie global alcanza:

```text
EI-645
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

- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
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
- ENG-030 — Persistence Engineering
- ENG-032 — Transport Engineering
- ENG-033 — API Engineering