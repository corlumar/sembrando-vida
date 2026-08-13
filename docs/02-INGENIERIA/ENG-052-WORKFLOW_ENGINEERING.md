---
id: ENG-052
titulo: Workflow Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Workflow Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-015
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
  - ENG-031
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-049
  - ENG-050
  - ENG-051
relacionados:
  - ENG-006
  - ENG-007
  - ENG-011
  - ENG-012
  - ENG-014
  - ENG-017
  - ENG-026
  - ENG-030
  - ENG-032
  - ENG-033
  - ENG-037
  - ENG-053
keywords:
  - workflow
  - workflow-engineering
  - workflow-definition
  - workflow-instance
  - workflow-state
  - workflow-step
  - workflow-transition
  - workflow-context
  - workflow-trigger
  - workflow-action
  - workflow-condition
  - workflow-guard
  - workflow-engine
  - workflow-orchestration
  - workflow-compensation
  - workflow-retry
  - workflow-timeout
  - workflow-suspension
  - workflow-resume
  - workflow-cancellation
  - workflow-version
  - workflow-migration
  - workflow-persistence
  - workflow-events
  - mef
---

# ENG-052

# Workflow Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Workflow Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-052 establece las reglas para:

```text
Workflow
Workflow Identifier
Workflow Definition
Workflow Instance
Workflow State
Workflow Step
Workflow Transition
Workflow Context
Workflow Input
Workflow Output
Workflow Variable
Workflow Trigger
Workflow Action
Workflow Condition
Workflow Guard
Workflow State Machine
Workflow Execution
Workflow Engine
Workflow Orchestration
Workflow Activity
Workflow Task
Workflow Decision
Workflow Branch
Workflow Join
Workflow Loop
Workflow Wait
Workflow Timer
Workflow Signal
Workflow Compensation
Workflow Retry
Workflow Timeout
Workflow Suspension
Workflow Resume
Workflow Cancellation
Workflow Failure
Workflow Version
Workflow Snapshot
Workflow Migration
Workflow Persistence
Workflow Recovery
Workflow Idempotency
Workflow Concurrency
Workflow Events
Workflow Audit
Workflow Observability
Workflow Security
Workflow Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo Workflow administrado por MEF deberá poseer Definition, Version, State Model y Lifecycle explícitos; toda transición deberá ser válida para el estado actual, toda ejecución durable deberá poder recuperarse sin repetir efectos no idempotentes y ningún fallo parcial deberá dejar el proceso en un estado ambiguo sin estrategia explícita de Retry, Compensation, Cancellation o intervención.**

Arquitectura conceptual:

```text
Workflow Definition
        │
        ▼
Workflow Registry
        │
        ▼
Workflow Engine
        │
        │ create
        ▼
Workflow Instance
        │
        ▼
Current State
        │
        ▼
Eligible Transition
        │
        ▼
Workflow Step
        │
        ▼
Action / Wait / Decision
        │
        ▼
Persist State
        │
        ▼
Next State
```

---

# 3. Workflow Engineering

`Workflow Engineering` gobierna procesos compuestos por múltiples pasos, decisiones, esperas y transiciones.

Deberá poder responder:

```text
Which workflow is running?
Which definition version created it?
What state is it in?
Which step is active?
Which transitions are valid?
What caused the transition?
Which actions already executed?
What is waiting?
What failed?
Can execution retry?
Can it compensate?
Can it resume?
Can it be cancelled?
```

---

# 4. Workflow

Un `Workflow` representa un proceso coordinado con estado y Lifecycle propios.

Ejemplos:

```text
customer.onboarding
order.fulfillment
invoice.approval
document.review
tenant.provisioning
incident.response
```

---

# 5. Workflow ≠ Domain Entity

Una Workflow Instance no deberá sustituir una Entity del Domain.

El Workflow coordina un proceso.

El Domain mantiene sus invariantes.

---

# 6. Workflow ≠ Transaction

Una Transaction normalmente protege una unidad atómica.

Un Workflow podrá abarcar:

```text
multiple transactions
multiple services
messages
human actions
long-running waits
external systems
```

---

# 7. Workflow ≠ Scheduler

Scheduling determina:

```text
when work should run
```

Workflow determina:

```text
what process should execute
and what comes next
```

---

# 8. Workflow ≠ Messaging

Messaging transporta información.

Workflow coordina el proceso que puede utilizar esos Messages.

---

# 9. Workflow ≠ Policy

Policy decide reglas.

Workflow coordina pasos y estados.

Ejemplo:

```text
Workflow
   │
   ▼
Approval Step
   │
   ▼
Policy
   │
   ▼
Requires second approval?
```

---

# 10. Workflow ≠ State Machine

Todo Workflow podrá utilizar una State Machine.

No toda State Machine constituye un Workflow.

---

# 11. Workflow Identifier

Toda Workflow Definition deberá poseer ID estable.

Ejemplo:

```text
invoice.approval
```

---

# 12. Workflow ID Stability

Un Workflow ID publicado deberá considerarse Contract operativo.

---

# 13. Workflow Definition

Conceptualmente:

```text
WorkflowDefinition
├── id
├── version
├── owner
├── initialState
├── states
├── steps
├── transitions
├── terminalStates
├── compensation
└── metadata
```

---

# 14. Definition Immutability

Una Definition publicada no deberá modificarse retroactivamente.

Un cambio deberá producir nueva Version.

---

# 15. Workflow Owner

Toda Definition deberá poseer Owner conocido.

---

# 16. Workflow Registry

MEF deberá mantener un Registry de Workflow Definitions.

---

# 17. Unknown Workflow

No deberá iniciarse.

---

# 18. Workflow Version

Toda Definition publicada deberá poseer Version.

Ejemplo:

```text
invoice.approval@3
```

---

# 19. Instance Version Binding

Toda Workflow Instance deberá quedar vinculada a la Definition Version con la que fue creada.

---

# 20. Latest Version

Una Instance existente no deberá cambiar automáticamente a:

```text
latest
```

---

# 21. Workflow Instance

Representa una ejecución concreta.

Conceptualmente:

```text
WorkflowInstance
├── instanceId
├── workflowId
├── definitionVersion
├── state
├── currentStep
├── context
├── status
├── createdAt
├── updatedAt
└── revision
```

---

# 22. Instance Identity

Toda Instance deberá poseer ID único.

---

# 23. Correlation

Podrá poseer:

```text
correlationId
businessKey
tenantId
```

cuando corresponda.

---

# 24. Business Key

Podrá relacionar una Instance con:

```text
orderId
invoiceId
caseId
customerId
```

sin convertir el Workflow en Owner del Aggregate.

---

# 25. Workflow State

Representa una situación durable de la Instance.

---

# 26. State Definition

Conceptualmente:

```text
WorkflowState
├── id
├── type
├── terminal
└── metadata
```

---

# 27. State Types

Podrán incluir:

```text
INITIAL
ACTIVE
WAITING
SUSPENDED
COMPLETED
FAILED
CANCELLED
COMPENSATING
COMPENSATED
```

---

# 28. Initial State

Toda Definition deberá poseer exactamente un Initial State lógico.

---

# 29. Terminal State

Una Instance en estado terminal no deberá ejecutar nuevas transiciones ordinarias.

---

# 30. Workflow Transition

Define un cambio válido entre States.

Conceptualmente:

```text
WorkflowTransition
├── id
├── from
├── to
├── trigger
├── guard
├── actions
└── metadata
```

---

# 31. Transition Validation

Una transición solo podrá ejecutarse si:

```text
current state matches
trigger is valid
guard allows
instance revision is valid
```

---

# 32. Invalid Transition

Deberá rechazarse explícitamente.

---

# 33. Transition Atomicity

El cambio durable de State y el registro de su resultado deberán preservarse de forma consistente.

---

# 34. Transition History

Toda transición durable relevante deberá poder reconstruirse.

---

# 35. Workflow Step

Representa una unidad lógica dentro del Workflow.

---

# 36. Step Types

Podrán incluir:

```text
ACTION
DECISION
WAIT
TIMER
HUMAN_TASK
SUB_WORKFLOW
PARALLEL
JOIN
COMPENSATION
```

---

# 37. Action Step

Ejecuta una acción.

---

# 38. Decision Step

Selecciona una rama según una decisión explícita.

---

# 39. Wait Step

Suspende avance hasta recibir una condición externa.

---

# 40. Timer Step

Espera hasta:

```text
deadline
duration
scheduled instant
```

---

# 41. Human Task

Representa trabajo que requiere intervención humana.

---

# 42. Sub-Workflow

Una Step podrá iniciar otro Workflow.

---

# 43. Parallel Step

Podrá iniciar múltiples ramas.

---

# 44. Join Step

Podrá sincronizar ramas.

---

# 45. Compensation Step

Ejecuta una acción compensatoria.

---

# 46. Workflow Context

Contiene datos necesarios para coordinar la Instance.

Conceptualmente:

```text
WorkflowContext
├── inputs
├── variables
├── outputs
├── tenant
├── principalReference
├── correlation
└── metadata
```

---

# 47. Context ≠ Domain Database

No deberá utilizarse como copia indiscriminada del estado del negocio.

---

# 48. Context Minimality

Solo deberá persistirse información necesaria para continuar la ejecución.

---

# 49. Workflow Input

Representa datos de entrada inmutables o controlados.

---

# 50. Input Validation

Deberá seguir ENG-036.

---

# 51. Workflow Variable

Representa datos internos modificables durante ejecución.

---

# 52. Variable Type

Deberá ser conocido cuando forme parte del Contract.

---

# 53. Variable Mutation

Deberá ocurrir mediante Workflow Engine, no mediante modificación arbitraria externa.

---

# 54. Workflow Output

Representa resultado formal del proceso.

---

# 55. Output Schema

Deberá estar definido cuando forme parte de un Contract público.

---

# 56. Workflow Trigger

Inicia o continúa una transición.

Podrá provenir de:

```text
command
event
message
timer
signal
human action
API
```

---

# 57. Trigger Identity

Deberá ser identificable.

---

# 58. Duplicate Trigger

Deberá manejarse idempotentemente cuando pueda repetirse.

---

# 59. Trigger Authorization

Triggers administrativos o humanos deberán seguir ENG-046.

---

# 60. Workflow Action

Una Action produce trabajo.

Ejemplos:

```text
create account
reserve inventory
send notification
request approval
charge payment
provision tenant
```

---

# 61. Action Contract

Conceptualmente:

```text
execute(
    WorkflowExecutionContext
) → WorkflowActionResult
```

---

# 62. Action Side Effects

Deberán declararse cuando existan.

---

# 63. Action Idempotency

Toda Action susceptible a Retry deberá poseer estrategia de Idempotency.

---

# 64. Action Result

Deberá distinguir:

```text
SUCCESS
RETRYABLE_FAILURE
PERMANENT_FAILURE
WAIT
```

---

# 65. Workflow Condition

Evalúa una condición para seleccionar comportamiento.

---

# 66. Condition Purity

Deberá favorecerse evaluación sin Side Effects.

---

# 67. Workflow Guard

Determina si una Transition está permitida.

---

# 68. Guard ≠ Authorization

Una Guard puede expresar:

```text
invoice.status == submitted
```

Authorization expresa:

```text
principal may approve invoice
```

Cuando ambas sean necesarias deberán evaluarse ambas.

---

# 69. Policy Guard

Una Guard podrá utilizar ENG-051.

---

# 70. Feature Guard

Una transición podrá depender de ENG-050 cuando corresponda.

---

# 71. Workflow State Machine

Deberá definir explícitamente:

```text
states
transitions
initial state
terminal states
guards
```

---

# 72. Determinism

Para un mismo:

```text
Definition Version
Instance State
Trigger
Context
```

la selección de Transition deberá ser determinística cuando el modelo no declare paralelismo.

---

# 73. Ambiguous Transition

Deberá rechazarse o resolverse mediante prioridad contractual explícita.

---

# 74. Workflow Engine

Coordina la ejecución de Workflow Instances.

Conceptualmente:

```text
start()
signal()
advance()
suspend()
resume()
cancel()
retry()
```

---

# 75. Workflow Engine Responsibilities

Deberá coordinar:

```text
definition lookup
instance creation
transition validation
step execution
persistence
retry
timeouts
signals
compensation
events
recovery
```

---

# 76. Engine ≠ Business Service

No deberá contener lógica específica de cada negocio.

---

# 77. Workflow Execution

Una ejecución deberá poseer Context identificable.

---

# 78. Execution ID

Cada intento relevante podrá poseer:

```text
executionId
attempt
startedAt
completedAt
```

---

# 79. Execution Boundary

Una Step deberá poseer límites claros de ejecución.

---

# 80. Durable Workflow

Un Workflow durable deberá sobrevivir:

```text
process restart
node restart
deployment
temporary dependency failure
```

cuando su semántica lo requiera.

---

# 81. In-Memory Workflow

Solo deberá utilizarse cuando la pérdida de estado sea aceptable explícitamente.

---

# 82. Workflow Orchestration

El Engine podrá coordinar múltiples componentes.

```text
Workflow
   │
   ├── Service A
   ├── Service B
   ├── Message
   └── Human Task
```

---

# 83. Orchestration ≠ Tight Coupling

Las Activities deberán depender de Contracts.

---

# 84. Choreography

Podrá coexistir con Orchestration.

---

# 85. Orchestration vs Choreography

La elección deberá ser explícita según:

```text
visibility
control
coupling
failure handling
process complexity
audit requirements
```

---

# 86. Workflow Branch

Una Decision podrá producir ramas.

---

# 87. Branch Exclusivity

Cuando solo una rama sea válida deberá garantizarse.

---

# 88. Parallel Branch

Podrán ejecutarse múltiples ramas simultáneamente.

---

# 89. Join Semantics

Deberán definirse explícitamente.

Ejemplos:

```text
ALL
ANY
N_OF_M
```

---

# 90. Parallel Failure

Deberá existir Policy para ramas fallidas.

---

# 91. Workflow Loop

Podrá existir cuando sea necesario.

---

# 92. Loop Bound

Deberá existir límite o condición de terminación verificable.

---

# 93. Infinite Loop

Deberá prevenirse cuando sea posible.

---

# 94. Workflow Wait

Una Instance podrá permanecer Waiting durante periodos largos.

---

# 95. Wait Persistence

No deberá requerir mantener Thread o Process bloqueado.

---

# 96. Workflow Timer

Deberá integrarse con ENG-040.

---

# 97. Durable Timer

Deberá sobrevivir Restart cuando el Workflow sea durable.

---

# 98. Timer Delivery

Podrá ocurrir al menos una vez.

El Handler deberá tolerar duplicados.

---

# 99. Workflow Signal

Permite reactivar una Instance.

Ejemplos:

```text
payment.received
approval.granted
document.signed
external.callback
```

---

# 100. Signal Correlation

Deberá localizar inequívocamente la Instance correspondiente.

---

# 101. Unknown Signal

No deberá modificar State.

---

# 102. Duplicate Signal

Deberá manejarse de forma idempotente.

---

# 103. Early Signal

Si puede llegar antes del Wait State deberá existir Policy explícita:

```text
buffer
reject
persist
ignore
```

---

# 104. Late Signal

Una señal posterior a Terminal State no deberá reabrir la Instance accidentalmente.

---

# 105. Workflow Retry

Deberá distinguir errores Retryable de Permanent.

---

# 106. Retry Policy

Podrá definir:

```text
maxAttempts
initialDelay
backoff
jitter
retryableErrors
```

---

# 107. Retry Integration

Deberá seguir ENG-039.

---

# 108. Retry ≠ Restart Workflow

Normalmente deberá reintentarse la unidad fallida, no reiniciar todo el proceso.

---

# 109. Retry Safety

No deberá duplicar Side Effects.

---

# 110. Retry Exhaustion

Deberá conducir a:

```text
FAILED
COMPENSATING
SUSPENDED
MANUAL_INTERVENTION
```

según Definition.

---

# 111. Workflow Timeout

Podrá aplicarse a:

```text
step
activity
wait
workflow
```

---

# 112. Timeout ≠ Cancellation

Un Timeout podrá disparar una transición específica.

---

# 113. Timeout Action

Podrá producir:

```text
retry
cancel
compensate
escalate
fail
```

---

# 114. Deadline

Deberá conservarse como instante absoluto cuando corresponda.

---

# 115. Workflow Compensation

Permite semánticamente deshacer o mitigar efectos previos.

---

# 116. Compensation ≠ Database Rollback

Una Compensation puede ejecutar una nueva acción de negocio.

Ejemplo:

```text
reserve inventory
        │
        ▼
charge fails
        │
        ▼
release inventory
```

---

# 117. Compensatable Action

Deberá declarar su Compensation cuando corresponda.

---

# 118. Compensation Order

Normalmente deberá ejecutarse en orden inverso de efectos confirmados cuando la Definition así lo requiera.

---

# 119. Compensation Idempotency

También deberá ser idempotente.

---

# 120. Compensation Failure

Deberá quedar explícitamente registrada.

---

# 121. Partial Compensation

No deberá presentarse como éxito completo.

---

# 122. Saga

Un Workflow distribuido podrá implementar patrón Saga.

---

# 123. Saga Coordination

Podrá utilizar:

```text
orchestration
choreography
hybrid
```

---

# 124. Saga Consistency

No deberá prometer Atomicity global inexistente.

---

# 125. Workflow Suspension

Una Instance podrá suspenderse.

---

# 126. Suspended State

No deberá ejecutar trabajo ordinario hasta Resume.

---

# 127. Suspension Reason

Deberá registrarse.

---

# 128. Workflow Resume

Deberá continuar desde State durable conocido.

---

# 129. Resume Validation

Deberá validar:

```text
instance status
definition availability
version compatibility
pending timers
pending signals
```

---

# 130. Workflow Cancellation

Deberá poseer semántica explícita.

---

# 131. Cancellation Modes

Podrán existir:

```text
IMMEDIATE
GRACEFUL
COMPENSATING
```

---

# 132. Cancellation Authorization

Deberá seguir ENG-046.

---

# 133. Cancellation ≠ Delete

Una Instance cancelada no deberá eliminarse automáticamente.

---

# 134. Cancellation Audit

Deberá registrar Actor y Reason cuando corresponda.

---

# 135. Workflow Failure

Deberá distinguir:

```text
technical failure
business failure
timeout
cancellation
compensation failure
invariant violation
```

---

# 136. Technical Failure

Podrá ser Retryable.

---

# 137. Business Failure

Normalmente deberá modelarse explícitamente como resultado o transición.

---

# 138. Failure ≠ Exception Only

No todo fallo deberá representarse únicamente mediante Exception.

---

# 139. Workflow Persistence

Toda Instance durable deberá persistir estado suficiente para Recovery.

---

# 140. Persisted State

Podrá incluir:

```text
instanceId
workflowId
definitionVersion
currentState
currentStep
context
revision
pendingTimers
pendingSignals
executionHistory
```

---

# 141. Persistence Atomicity

State Transition y datos críticos asociados deberán persistirse consistentemente.

---

# 142. Optimistic Concurrency

Deberá favorecerse mediante:

```text
revision
expectedVersion
compare-and-swap
```

---

# 143. Lost Update

Deberá impedirse.

---

# 144. Workflow Recovery

Tras Restart, el Engine deberá poder reconstruir Instances durables.

---

# 145. Recovery Input

Deberá provenir de estado persistido, no de suposiciones en memoria.

---

# 146. Recovery Safety

No deberá repetir ciegamente una Action cuyo resultado pueda haber sido confirmado externamente.

---

# 147. Unknown Execution Outcome

Deberá poseer estrategia de reconciliación.

---

# 148. Reconciliation

Podrá consultar estado externo antes de Retry.

---

# 149. Workflow Idempotency

Deberá existir en:

```text
start
signal
transition
action
compensation
event publication
```

cuando puedan existir duplicados.

---

# 150. Start Idempotency

Podrá utilizar:

```text
workflowId + businessKey
```

cuando solo deba existir una Instance lógica.

---

# 151. Idempotency Key

Deberá tener Scope conocido.

---

# 152. Workflow Concurrency

Múltiples Workers podrán intentar avanzar una Instance.

---

# 153. Single Logical Transition

Solo una transición incompatible deberá ganar.

---

# 154. Concurrent Signals

Deberán serializarse o resolverse mediante Concurrency Control explícito.

---

# 155. Parallel Activities

Podrán ejecutarse concurrentemente si la Definition lo permite.

---

# 156. Workflow Lock

No deberá mantenerse durante llamadas externas largas cuando pueda evitarse.

---

# 157. Workflow Transaction

Una transición local podrá utilizar ENG-042.

---

# 158. External Side Effect

No deberá incluirse falsamente dentro de una Transaction local como si compartiera Atomicity.

---

# 159. Transactional Outbox

Podrá utilizarse para coordinar:

```text
state persistence
+
event/message publication
```

---

# 160. Workflow Events

Podrán existir:

```text
workflow.started
workflow.transitioned
workflow.step.started
workflow.step.completed
workflow.step.failed
workflow.waiting
workflow.resumed
workflow.suspended
workflow.cancelled
workflow.completed
workflow.failed
workflow.compensation.started
workflow.compensated
workflow.timeout
```

---

# 161. Event Identity

Todo Event durable deberá poseer ID.

---

# 162. Event Version

Deberá poseer Schema Version cuando sea Contract público.

---

# 163. Event Ordering

No deberá asumirse orden global.

---

# 164. Event Duplication

Consumers deberán tolerar duplicados cuando el transporte sea At-Least-Once.

---

# 165. Workflow History

Deberá permitir reconstruir:

```text
states
transitions
steps
attempts
signals
timeouts
compensations
administrative actions
```

---

# 166. History ≠ Event Sourcing

No será obligatorio utilizar Event Sourcing.

---

# 167. Workflow Snapshot

Podrá representar el estado actual optimizado de una Instance.

---

# 168. History Retention

Deberá seguir Policies de Retention aplicables.

---

# 169. Workflow Migration

Una Instance existente no deberá migrarse automáticamente a nueva Definition Version.

---

# 170. Migration Requirement

Deberá existir estrategia explícita cuando sea necesaria.

---

# 171. Migration Plan

Podrá definir:

```text
sourceVersion
targetVersion
stateMapping
variableMapping
pendingStepMapping
validation
rollback
```

---

# 172. Unsafe Migration

Deberá rechazarse.

---

# 173. Migration Audit

Deberá registrarse.

---

# 174. Definition Retirement

Una Version no deberá retirarse mientras existan Instances que dependan de ella salvo estrategia de migración compatible.

---

# 175. Backward Compatibility

Deberá seguir ENG-016.

---

# 176. Workflow Security

ENG-024 gobernará controles generales.

---

# 177. Workflow Start Authorization

No todo Principal podrá iniciar cualquier Workflow.

---

# 178. Transition Authorization

Human/Admin transitions deberán autorizarse.

---

# 179. Signal Authentication

Signals externos deberán autenticarse cuando el Threat Model lo requiera.

---

# 180. Signal Authorization

Un Actor autenticado no implica que pueda señalizar cualquier Instance.

---

# 181. Tenant Isolation

ENG-048 deberá aplicarse a:

```text
definitions when tenant-specific
instances
signals
tasks
history
timers
cache
audit
```

---

# 182. Cross-Tenant Workflow

Deberá prohibirse por Default.

---

# 183. Sensitive Context

No deberá almacenarse indiscriminadamente.

---

# 184. Secret Storage

Secrets no deberán persistirse directamente en Workflow Context salvo diseño explícito y protección adecuada.

---

# 185. Context Injection

Inputs externos deberán validarse.

---

# 186. Workflow Definition Injection

Definitions no deberán aceptar código arbitrario no confiable.

---

# 187. Human Task Assignment

Deberá seguir IAM y Authorization.

---

# 188. Administrative Override

Deberá ser:

```text
authenticated
authorized
validated
audited
```

---

# 189. Force Transition

No deberá existir como bypass silencioso de State Machine.

---

# 190. Force Transition Policy

Si existe deberá ser excepcional, explícita y auditable.

---

# 191. Workflow Audit

Deberá registrar acciones administrativas y de negocio relevantes.

---

# 192. Audit Record

Podrá contener:

```text
workflowId
instanceId
definitionVersion
actor
action
previousState
newState
reason
timestamp
result
```

---

# 193. Sensitive Audit

No deberá copiar Workflow Context completo.

---

# 194. Observability

ENG-025 gobernará Telemetry.

---

# 195. Metrics

Podrán incluir:

```text
mef.workflow.started.total
mef.workflow.completed.total
mef.workflow.failed.total
mef.workflow.cancelled.total
mef.workflow.suspended.total
mef.workflow.step.duration
mef.workflow.retry.total
mef.workflow.timeout.total
mef.workflow.compensation.total
mef.workflow.active
mef.workflow.waiting
```

---

# 196. Metric Labels

No deberán utilizar:

```text
instanceId
customerId
orderId
tenantId indiscriminately
```

como Labels de alta cardinalidad.

---

# 197. Logs

Podrán incluir:

```text
workflowId
instanceId
definitionVersion
state
step
transition
attempt
correlationId
result
```

cuando sea seguro.

---

# 198. Tracing

Una Workflow Instance podrá conservar correlación entre múltiples Traces sin requerir un único Span de larga duración.

---

# 199. Long-Running Trace

No deberá mantenerse un Span abierto durante días únicamente para representar el Workflow.

---

# 200. Workflow Diagnostics

Deberá poder determinar:

```text
definition version
instance state
current step
revision
pending timers
pending signals
retry state
compensation state
last failure
```

---

# 201. Health

Workflow Backlog no deberá confundirse automáticamente con Liveness.

---

# 202. Readiness

Podrá fallar ante:

```text
workflow registry invalid
mandatory persistence unavailable
critical definition invalid
recovery impossible
```

según Runtime Role.

---

# 203. Testing

ENG-009 gobernará Testing.

---

# 204. Definition Test

Deberá cubrir:

```text
duplicate workflow ID/version
missing initial state
missing terminal state
invalid transition
unreachable state
ambiguous transition
```

---

# 205. State Machine Test

Deberá probar todas las transiciones válidas e inválidas relevantes.

---

# 206. Action Test

Deberá cubrir:

```text
success
retryable failure
permanent failure
unknown outcome
```

---

# 207. Retry Test

Deberá verificar que no se dupliquen Side Effects.

---

# 208. Idempotency Test

Deberá repetir:

```text
start
signal
timer
message
action
compensation
```

---

# 209. Timeout Test

Deberá cubrir Timeout antes, durante y después de ejecución cuando aplique.

---

# 210. Compensation Test

Deberá cubrir:

```text
full compensation
partial compensation
compensation failure
duplicate compensation
```

---

# 211. Suspension Test

Deberá comprobar que no exista progreso ordinario mientras esté suspendido.

---

# 212. Resume Test

Deberá continuar desde estado durable.

---

# 213. Cancellation Test

Deberá probar todos los Cancellation Modes soportados.

---

# 214. Concurrency Test

Deberá intentar avanzar la misma Instance simultáneamente.

---

# 215. Signal Test

Deberá cubrir:

```text
valid
duplicate
unknown
early
late
unauthorized
```

---

# 216. Recovery Test

Deberá simular Crash en puntos críticos.

---

# 217. Crash Points

Deberán incluir:

```text
before action
after external side effect
before persistence
after persistence
before event publication
```

---

# 218. Migration Test

Deberá comprobar Mapping entre Definition Versions.

---

# 219. Tenant Isolation Test

Deberá intentar acceso cruzado entre Tenants.

---

# 220. Security Test

Deberá intentar:

```text
unauthorized start
unauthorized transition
signal spoofing
context injection
force transition
tenant escape
```

---

# 221. Architecture Test

Podrá impedir:

```text
workflow engine in Domain entity
unversioned definitions
mutable published definitions
non-idempotent retryable action
thread-blocking durable wait
tenantless instance lookup
latest-version rebinding
```

---

# 222. Build Integration

ENG-012 podrá validar:

```text
duplicate workflow ID/version
missing owner
invalid initial state
invalid terminal state
invalid transition
unreachable state
ambiguous transition
dependency cycle
unbounded loop
missing compensation metadata
```

---

# 223. CLI

ENG-007 podrá proporcionar:

```text
mef workflow:list
mef workflow:show
mef workflow:validate
mef workflow:start
mef workflow:status
mef workflow:history
mef workflow:signal
mef workflow:suspend
mef workflow:resume
mef workflow:cancel
mef workflow:retry
mef workflow:migrate
mef workflow:diagnose
```

---

# 224. `workflow:list`

Podrá mostrar:

```text
workflowId
versions
owner
activeVersion
```

---

# 225. `workflow:show`

Deberá mostrar Definition y State Model.

---

# 226. `workflow:validate`

Deberá validar Definition sin activarla.

---

# 227. `workflow:start`

Deberá validar Input y Authorization.

---

# 228. `workflow:status`

Podrá mostrar:

```text
instanceId
workflowId
version
state
step
revision
createdAt
updatedAt
```

---

# 229. `workflow:history`

Deberá mostrar Timeline sin exponer datos sensibles.

---

# 230. `workflow:signal`

Deberá validar Correlation y Authorization.

---

# 231. `workflow:suspend`

Deberá registrar Reason.

---

# 232. `workflow:resume`

Deberá validar estado.

---

# 233. `workflow:cancel`

Deberá requerir Mode explícito cuando exista más de uno.

---

# 234. `workflow:retry`

No deberá reintentar Permanent Failures arbitrariamente.

---

# 235. `workflow:migrate`

Deberá requerir Migration Plan.

---

# 236. `workflow:diagnose`

Podrá comprobar:

```text
registry
definition
instance
persistence
timers
signals
retry
locks
history
```

---

# 237. Registry Integration

ENG-020 podrá registrar:

```text
WorkflowDefinition
WorkflowActionDefinition
WorkflowGuardDefinition
WorkflowMigrationDefinition
```

---

# 238. Workflow Definition Contract

Conceptualmente:

```text
WorkflowDefinition
├── id
├── version
├── owner
├── states
├── steps
├── transitions
├── initialState
├── terminalStates
└── metadata
```

---

# 239. Workflow Engine Contract

Conceptualmente:

```text
start(
    WorkflowId,
    WorkflowInput
) → WorkflowInstance

signal(
    WorkflowInstanceId,
    WorkflowSignal
) → WorkflowExecutionResult
```

---

# 240. Workflow Repository

Conceptualmente:

```text
load(instanceId)
save(instance, expectedRevision)
findByBusinessKey(...)
```

---

# 241. Workflow Action Registry

Mantendrá Actions conocidas.

---

# 242. Workflow Timer Service

Deberá integrarse con ENG-040.

---

# 243. Workflow Signal Router

Deberá correlacionar Signals con Instances.

---

# 244. Workflow Recovery Manager

Podrá recuperar trabajo pendiente después de Restart.

---

# 245. Workflow Migration Manager

Podrá ejecutar Migration Plans explícitos.

---

# 246. Bootstrap

ENG-027 deberá construir Workflow Runtime después de:

```text
Configuration
Persistence
Messaging
Scheduling
Policy
Security
```

cuando dichas capacidades sean requeridas.

---

# 247. Bootstrap Flow

```text
Runtime Core
    │
    ▼
Discover Workflow Definitions
    │
    ▼
Discover Actions / Guards
    │
    ▼
Build Workflow Registry
    │
    ▼
Validate Definitions
    │
    ▼
Build Workflow Engine
    │
    ▼
Connect Persistence
    │
    ▼
Connect Timer Service
    │
    ▼
Connect Signal Router
    │
    ▼
Recover Durable Instances
    │
    ▼
Readiness
```

---

# 248. Bootstrap Failure

Deberá impedir Readiness cuando corresponda ante:

```text
invalid critical definition
duplicate definition version
missing mandatory action
persistence unavailable
recovery corruption
invalid state model
```

---

# 249. Runtime Integration

ENG-027 deberá exponer Workflow Engine mediante Contracts.

---

# 250. Module Integration

ENG-028 podrá registrar Workflow Definitions y Actions.

---

# 251. Module Ownership

Un Module no deberá modificar silenciosamente Definition de otro Module.

---

# 252. Application Integration

ENG-034 será el punto natural para iniciar y señalizar Workflows desde Use Cases.

---

# 253. Domain Integration

ENG-035 deberá conservar Business Invariants.

Workflow podrá coordinar múltiples Domain Operations.

---

# 254. Validation Integration

ENG-036 validará:

```text
workflow input
signal payload
variables
outputs
migration mappings
```

---

# 255. Serialization Integration

ENG-031 deberá serializar estado durable mediante Contracts versionados.

---

# 256. Persistence Integration

ENG-030 y ENG-043 podrán persistir Instances e History.

---

# 257. Concurrency Integration

ENG-038 deberá proteger Revision y ejecución concurrente.

---

# 258. Resilience Integration

ENG-039 gobernará Retry, Backoff, Circuit Breakers y dependencias externas.

---

# 259. Scheduling Integration

ENG-040 gobernará Timers y Deadlines.

---

# 260. Messaging Integration

ENG-041 podrá transportar:

```text
signals
commands
workflow events
activity requests
```

---

# 261. Transaction Integration

ENG-042 deberá proteger State Changes locales y podrá utilizar Outbox.

---

# 262. Data Access Integration

ENG-043 podrá implementar WorkflowRepository.

---

# 263. API Integration

ENG-044 podrá exponer:

```text
start
status
signal
cancel
human tasks
```

bajo Contracts explícitos.

---

# 264. Authentication Integration

ENG-045 identificará Actor cuando sea necesario.

---

# 265. Authorization Integration

ENG-046 gobernará:

```text
start
human transition
signal
cancel
suspend
resume
administrative retry
migration
```

---

# 266. IAM Integration

ENG-047 podrá resolver Human Task Assignment.

---

# 267. Multi-Tenancy Integration

ENG-048 deberá aislar Instances, History, Tasks, Timers y Signals.

---

# 268. Configuration Integration

ENG-049 podrá configurar:

```text
retry defaults
timeouts
worker limits
retention
recovery intervals
```

---

# 269. Feature Integration

ENG-050 podrá habilitar nuevas Workflow Versions o Steps durante rollout controlado.

Una Instance existente no deberá cambiar de Definition Version por el cambio de Feature.

---

# 270. Policy Integration

ENG-051 podrá gobernar:

```text
guards
approvals
escalations
retention
cancellation
```

sin sustituir la State Machine.

---

# 271. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
WorkflowId
WorkflowDefinition
WorkflowInstance

WorkflowState
WorkflowStep
WorkflowTransition

WorkflowInput
WorkflowOutput
WorkflowContext
WorkflowVariable

WorkflowTrigger
WorkflowSignal
WorkflowAction
WorkflowActionResult
WorkflowGuard

WorkflowEngine
WorkflowRegistry
WorkflowRepository

WorkflowRetryPolicy
WorkflowTimeout

WorkflowError
```

---

# 272. Optional Initial Components

Podrán incorporarse:

```text
WorkflowTimerService
WorkflowSignalRouter
WorkflowHistory
WorkflowSnapshot
WorkflowRecoveryManager
WorkflowCompensation
WorkflowMigrationPlan
```

---

# 273. Later Components

Solo cuando exista necesidad demostrada:

```text
Distributed Workflow Engine
Advanced Human Task Management
Visual Workflow Designer
Cross-Region Workflow Execution
Dynamic Workflow Definition
Process Mining
AI Workflow Optimization
```

---

# 274. Conceptual Directory Structure

```text
src/
└── Workflow/
    ├── Definition/
    │   ├── WorkflowId
    │   ├── WorkflowDefinition
    │   ├── WorkflowState
    │   ├── WorkflowStep
    │   └── WorkflowTransition
    │
    ├── Context/
    │   ├── WorkflowInput
    │   ├── WorkflowOutput
    │   ├── WorkflowContext
    │   └── WorkflowVariable
    │
    ├── Trigger/
    │   ├── WorkflowTrigger
    │   └── WorkflowSignal
    │
    ├── Action/
    │   ├── WorkflowAction
    │   └── WorkflowActionResult
    │
    ├── Guard/
    │   └── WorkflowGuard
    │
    ├── Instance/
    │   └── WorkflowInstance
    │
    ├── Execution/
    │   ├── WorkflowEngine
    │   ├── WorkflowRetryPolicy
    │   └── WorkflowTimeout
    │
    ├── Persistence/
    │   ├── WorkflowRepository
    │   ├── WorkflowHistory
    │   └── WorkflowSnapshot
    │
    ├── Timer/
    │   └── WorkflowTimerService
    │
    ├── Signal/
    │   └── WorkflowSignalRouter
    │
    ├── Compensation/
    │   └── WorkflowCompensation
    │
    ├── Recovery/
    │   └── WorkflowRecoveryManager
    │
    ├── Migration/
    │   └── WorkflowMigrationPlan
    │
    ├── Registry/
    │   └── WorkflowRegistry
    │
    └── Error/
        └── WorkflowError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 275. Error Handling

ENG-023 gobernará Error Translation.

---

# 276. Error Namespace

ENG-052 utilizará:

```text
MEF-WORKFLOW-xxx
```

---

# 277. Taxonomía ENG-052

```text
MEF-WORKFLOW-001 Workflow not found
MEF-WORKFLOW-002 Workflow definition invalid
MEF-WORKFLOW-003 Workflow definition duplicate
MEF-WORKFLOW-004 Workflow version unavailable
MEF-WORKFLOW-005 Workflow instance not found
MEF-WORKFLOW-006 Workflow state invalid
MEF-WORKFLOW-007 Workflow transition invalid
MEF-WORKFLOW-008 Workflow transition ambiguous
MEF-WORKFLOW-009 Workflow trigger invalid
MEF-WORKFLOW-010 Workflow signal invalid
MEF-WORKFLOW-011 Workflow signal duplicate
MEF-WORKFLOW-012 Workflow action failed
MEF-WORKFLOW-013 Workflow action retry exhausted
MEF-WORKFLOW-014 Workflow timeout
MEF-WORKFLOW-015 Workflow guard rejected
MEF-WORKFLOW-016 Workflow revision conflict
MEF-WORKFLOW-017 Workflow persistence failed
MEF-WORKFLOW-018 Workflow recovery failed
MEF-WORKFLOW-019 Workflow compensation failed
MEF-WORKFLOW-020 Workflow cancellation rejected
MEF-WORKFLOW-021 Workflow suspended
MEF-WORKFLOW-022 Workflow migration invalid
MEF-WORKFLOW-023 Workflow migration failed
MEF-WORKFLOW-024 Workflow tenant mismatch
MEF-WORKFLOW-025 Workflow authorization denied
MEF-WORKFLOW-026 Workflow security violation
MEF-WORKFLOW-027 Workflow idempotency conflict
MEF-WORKFLOW-028 Workflow invariant violation
MEF-WORKFLOW-029 Workflow bootstrap failed
MEF-WORKFLOW-030 Workflow execution failed
```

---

# 278. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Versioned Definitions
Explicit State Machines
Durable Instances
Typed Inputs
Typed Signals
Validated Transitions
Deterministic Guards
Action Contracts
Idempotency
Optimistic Concurrency
Retry Classification
Timeouts
Persistence
Recovery
Tenant Isolation
Authorization
History
Observability
Testing
```

---

# 279. First Version Non-Goals

No deberá requerir:

```text
Visual Workflow Designer
BPMN Engine
Distributed Workflow Cluster
Cross-Region Execution
Advanced Human Task Inbox
Process Mining
Dynamic Runtime Workflow Editing
AI Workflow Generation
```

---

# 280. Second Phase

Podrá incorporar:

```text
Durable Timers
Human Tasks
Parallel Branches
Join Semantics
Compensation
Saga Orchestration
Workflow Migration
Advanced Recovery
```

---

# 281. Third Phase

Solo cuando exista necesidad demostrada:

```text
Distributed Workflow Execution
Cross-Region Recovery
Visual Designer
Process Analytics
Process Mining
Advanced Human Task Management
Dynamic Definitions
```

---

# 282. Invariantes de Ingeniería

ENG-052 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-986 | Toda Workflow Definition deberá poseer WorkflowId estable, Version, Owner, Initial State, States, Transitions y Terminal States explícitos antes de poder crear Instances. |
| EI-987 | Toda Workflow Instance deberá quedar vinculada de forma estable a la Definition Version con la que fue creada y nunca deberá migrar implícitamente a `latest` durante su ejecución. |
| EI-988 | Toda Transition deberá validar Current State, Trigger, Guard, Authorization cuando corresponda y Revision antes de modificar de forma durable una Workflow Instance. |
| EI-989 | Workflow Context deberá contener únicamente datos necesarios para coordinación y recuperación; no deberá convertirse en una copia indiscriminada del Domain State ni almacenar Secrets sin protección explícita. |
| EI-990 | Toda Action susceptible de Retry deberá poseer estrategia de Idempotency y un Retry nunca deberá duplicar silenciosamente Side Effects externos. |
| EI-991 | Workflow Retry deberá distinguir Retryable Failure de Permanent Failure y el agotamiento de intentos deberá producir State o estrategia explícita de Failure, Suspension, Compensation o intervención. |
| EI-992 | Durable Waits, Timers y Signals deberán persistirse sin mantener Threads o Processes bloqueados y deberán tolerar Duplicate, Early y Late Delivery conforme a Policy explícita. |
| EI-993 | Workflow Compensation deberá modelarse como nueva acción de negocio, no como falsa Transaction global, y deberá ser idempotente, observable y capaz de representar Partial Compensation o Compensation Failure. |
| EI-994 | Toda Workflow Instance durable deberá persistir State, Definition Version y Revision suficientes para Recovery, y un Restart no deberá provocar rebinding de versión ni repetición ciega de efectos de resultado desconocido. |
| EI-995 | Concurrency Control deberá impedir Lost Updates y transiciones incompatibles simultáneas sobre una misma Instance mediante Revision, Compare-And-Swap o mecanismo equivalente. |
| EI-996 | Workflow State Persistence y publicación de Messages/Events relacionados deberán preservar consistencia mediante Transactional Outbox u otro mecanismo explícito cuando no compartan Atomicity nativa. |
| EI-997 | Workflow Suspension, Resume y Cancellation deberán poseer semántica explícita; Cancellation nunca deberá equivaler a Delete y Force Transition no deberá constituir un bypass silencioso de la State Machine. |
| EI-998 | Workflow Definitions publicadas deberán ser inmutables y cualquier cambio estructural deberá producir nueva Version; Instances existentes solo podrán migrarse mediante Migration Plan explícito y validado. |
| EI-999 | Tenant Workflow Instances, Signals, Human Tasks, Timers, History, Cache y Audit deberán preservar aislamiento conforme ENG-048 y Cross-Tenant Workflow deberá estar prohibido por Default. |
| EI-1000 | Workflow Start, Human Transitions, Signals administrativos, Cancellation, Suspension, Resume, Retry y Migration deberán estar autenticados y autorizados cuando su Threat Model lo requiera. |
| EI-1001 | Workflow History y Audit deberán permitir reconstruir States, Transitions, Attempts, Signals, Timeouts, Compensations y acciones administrativas relevantes sin persistir indiscriminadamente Context sensible. |
| EI-1002 | Workflow Observability deberá permitir determinar Definition Version, State, Step, Retry, Timeout, Compensation y Failure sin utilizar identificadores de Instance, negocio o Tenant como Metrics Labels de cardinalidad incontrolada. |
| EI-1003 | Workflow Testing deberá cubrir State Machine, Actions, Retry, Idempotency, Timeouts, Compensation, Suspension, Resume, Cancellation, Concurrency, Signals, Recovery, Migration, Tenant Isolation y Security. |
| EI-1004 | Build y Architecture Tests deberán detectar Definitions duplicadas, States inválidos o inalcanzables, Transitions ambiguas, Loops no acotados, Definitions mutables, Retryable Actions sin Idempotency y dependencias indebidas del Domain hacia Workflow Infrastructure. |
| EI-1005 | La primera implementación deberá favorecer Definitions versionadas, State Machines explícitas, Durable Instances, Typed Inputs/Signals, Validated Transitions, Idempotency, Optimistic Concurrency, Retry Classification, Persistence y Recovery antes de introducir BPMN, Visual Designers o ejecución distribuida avanzada. |

---

# 283. Continuidad de Invariantes

```text
ENG-048 → EI-906 a EI-925
ENG-049 → EI-926 a EI-945
ENG-050 → EI-946 a EI-965
ENG-051 → EI-966 a EI-985
ENG-052 → EI-986 a EI-1005
```

ENG-052 introduce además un hito:

```text
EI-1000
```

La serie global de invariantes supera por primera vez las mil reglas arquitectónicas.

---

# 284. Criterios de Conformidad

Una implementación será conforme con ENG-052 cuando:

- registre Workflow Definitions versionadas;
- utilice Workflow IDs estables;
- asigne Owner;
- modele Initial State;
- modele Terminal States;
- valide Transitions;
- rechace Transitions ambiguas;
- vincule cada Instance a Definition Version;
- utilice Inputs tipados;
- valide Signals;
- mantenga Workflow Context mínimo;
- utilice Action Contracts;
- clasifique Action Results;
- implemente Idempotency;
- diferencie Retryable de Permanent Failure;
- modele Retry Policy;
- soporte Timeouts;
- persista Durable Waits;
- correlacione Signals;
- tolere Duplicate Signals;
- implemente Optimistic Concurrency;
- evite Lost Updates;
- persista State durable;
- soporte Recovery;
- trate Unknown Outcomes explícitamente;
- modele Compensation cuando corresponda;
- separe Compensation de Rollback;
- modele Suspension;
- modele Resume;
- modele Cancellation;
- preserve History;
- versione Events públicos;
- preserve Tenant Isolation;
- autorice operaciones sensibles;
- permita diagnóstico;
- pruebe Crash Recovery;
- pruebe Concurrency;
- pruebe Idempotency.

---

# 285. Riesgos

Deberán evitarse especialmente:

## Latest-Version Rebinding

Una Instance iniciada con V1 continúa repentinamente bajo V2.

## Mutable Workflow Definition

Se modifica una Definition publicada mientras existen Instances activas.

## Workflow as Domain

Toda la lógica del negocio termina dentro del Engine.

## Workflow Context as Database

Se copian Aggregates completos al Context.

## Non-Idempotent Retry

```text
chargeCard()
```

se ejecuta dos veces.

## Blind Recovery

Tras Crash se repite una Action sin comprobar si el sistema externo ya la procesó.

## Global Transaction Illusion

Se supone Atomicity entre Database, Payment Provider y Message Broker.

## Thread-Blocking Wait

Una Instance espera tres días manteniendo recursos de ejecución.

## Duplicate Signal Transition

Dos callbacks idénticos avanzan dos veces la Instance.

## Late Signal Reopen

Una señal tardía reactiva un Workflow ya completado.

## Unbounded Loop

Un Workflow puede iterar indefinidamente.

## Compensation = Rollback

Se pretende deshacer un efecto externo mediante Rollback de Database.

## Partial Compensation Hidden

El sistema marca éxito aunque parte de la Compensation falló.

## Lost Update

Dos Workers avanzan simultáneamente desde el mismo State.

## Force Transition

Un administrador salta cualquier State sin Validation.

## Cancellation = Delete

Se pierde History y evidencia.

## Tenantless Lookup

Una Instance se obtiene solo por InstanceId sin Tenant Boundary.

## Workflow Definition Injection

Una Definition externa ejecuta código arbitrario.

## Long-Lived Trace Span

Un Trace permanece abierto durante días.

## Event History Confusion

Se exige Event Sourcing únicamente porque existe Workflow History.

---

# 286. Relación con ENG-015

ENG-015 define la **Architectural State Machine** general.

ENG-052 aplica State Machine Engineering a procesos ejecutables y durables.

```text
ENG-015
Architectural State Machine
        │
        ▼
ENG-052
Workflow State Machine
        │
        ▼
Workflow Instance
```

---

# 287. Relación con ENG-039

Resilience gobierna:

```text
Retry
Backoff
Jitter
Circuit Breaker
Timeout
Bulkhead
```

Workflow decide qué significa el resultado para el proceso.

---

# 288. Relación con ENG-040

Scheduling gobierna cuándo se activa un Timer.

Workflow gobierna qué Transition produce.

```text
Workflow Timer
      │
      ▼
Scheduler
      │
      ▼
Timer Trigger
      │
      ▼
Workflow Engine
      │
      ▼
Transition
```

---

# 289. Relación con ENG-041

Messaging transporta Signals y Commands.

Workflow conserva la semántica del proceso.

---

# 290. Relación con ENG-042

Transaction protege cambios locales.

Workflow coordina procesos que pueden atravesar múltiples Transactions.

---

# 291. Relación con ENG-048

TenantContext deberá formar parte del Scope de toda Instance Tenant-Aware.

---

# 292. Relación con ENG-051

Policy podrá decidir:

```text
approval required?
escalation required?
cancellation allowed?
additional verification required?
```

Workflow convierte esas decisiones en Transitions y Steps.

---

# 293. Relación con ENG-053

ENG-053 deberá formalizar **State Management Engineering**.

La separación propuesta será:

```text
ENG-015 Architectural State Machine
→ defines architectural state-machine principles

ENG-052 Workflow Engineering
→ coordinates long-running processes

ENG-053 State Management Engineering
→ governs creation, ownership, mutation,
  synchronization and lifecycle of runtime state
```

ENG-053 deberá cubrir:

```text
State
State Owner
State Scope
State Store
State Model
State Snapshot
State Version
State Mutation
State Transition
State Consistency
State Synchronization
State Hydration
State Dehydration
State Restoration
State Recovery
Ephemeral State
Durable State
Local State
Shared State
Distributed State
Derived State
Cached State
Session State
Request State
Application State
Module State
Tenant State
State Conflict
State Merge
State Invalidity
State Observability
State Security
State Testing
```

---

# 294. Principio Rector

> **MEF deberá tratar Workflow como una coordinación durable, versionada y recuperable de procesos, no como una secuencia informal de callbacks. Todo progreso deberá ocurrir mediante transiciones válidas, todo efecto reintentable deberá ser idempotente y todo proceso de larga duración deberá poder explicar exactamente dónde se encuentra y cómo puede continuar, fallar, compensarse o terminar.**

---

# 295. Conclusión

**ENG-052 — Workflow Engineering** formaliza la arquitectura de procesos coordinados de MEF.

La arquitectura principal queda:

```text
               WORKFLOW DEFINITION
                       │
                       ▼
                WORKFLOW REGISTRY
                       │
                       ▼
                 WORKFLOW ENGINE
                       │
                       ▼
                WORKFLOW INSTANCE
                       │
                       ▼
                  CURRENT STATE
                       │
                       ▼
                    TRIGGER
                       │
                       ▼
                     GUARD
                       │
                  ┌────┴────┐
                  │         │
                DENY       ALLOW
                            │
                            ▼
                         ACTION
                            │
                            ▼
                       PERSIST STATE
                            │
                            ▼
                        NEXT STATE
```

La relación entre State, Step y Transition queda:

```text
State A
   │
   │ Trigger
   ▼
Guard
   │
   ▼
Step
   │
   ├── Action
   ├── Decision
   ├── Wait
   ├── Timer
   └── Human Task
   │
   ▼
Transition
   │
   ▼
State B
```

La durabilidad queda:

```text
Execute Step
     │
     ▼
Persist State
     │
     ▼
Process / Node Crash
     │
     ▼
Restart
     │
     ▼
Load Instance
     │
     ▼
Reconcile Unknown Work
     │
     ▼
Resume Safely
```

El Retry queda:

```text
Action
  │
  ▼
Failure
  │
  ├── Retryable
  │      │
  │      ▼
  │   Backoff
  │      │
  │      ▼
  │    Retry
  │
  └── Permanent
         │
         ▼
      Failure Strategy
```

La Compensation queda:

```text
Action A ──► success
    │
Action B ──► success
    │
Action C ──► failure
    │
    ▼
Compensate B
    │
    ▼
Compensate A
    │
    ▼
COMPENSATED
```

La integración distribuida queda:

```text
Workflow Engine
      │
      ├── Local Transaction
      │
      ├── Message Broker
      │
      ├── External API
      │
      ├── Timer
      │
      └── Human Task
      │
      ▼
Persistent Workflow State
```

La separación de responsabilidades queda:

```text
Configuration
     │
     ▼
Policy
     │
     ▼
Feature / Authorization
     │
     ▼
Workflow
     │
     │ coordinates
     ▼
Application
     │
     │ invokes
     ▼
Domain
     │
     │ preserves
     ▼
Business Invariants
```

La primera implementación deberá concentrarse en:

```text
WorkflowId
WorkflowDefinition
WorkflowInstance

WorkflowState
WorkflowStep
WorkflowTransition

WorkflowInput
WorkflowOutput
WorkflowContext
WorkflowVariable

WorkflowTrigger
WorkflowSignal
WorkflowAction
WorkflowActionResult
WorkflowGuard

WorkflowEngine
WorkflowRegistry
WorkflowRepository

WorkflowRetryPolicy
WorkflowTimeout

WorkflowError
```

con:

```text
Versioned Definitions
Explicit State Machines
Durable Instances
Version Binding
Typed Inputs
Typed Signals
Validated Transitions
Deterministic Guards
Action Contracts
Idempotency
Retry Classification
Optimistic Concurrency
Timeouts
Persistence
Recovery
Tenant Isolation
Authorization
History
Observability
Testing
```

antes de introducir:

```text
Visual Workflow Designer
BPMN Engine
Distributed Workflow Cluster
Cross-Region Execution
Advanced Human Task Platform
Process Mining
Dynamic Runtime Workflow Editing
AI Workflow Generation
```

Con **ENG-052** la serie global alcanza:

```text
EI-1005
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
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
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
- ENG-050 — Feature Management Engineering
- ENG-051 — Policy Engineering
- ENG-053 — State Management Engineering
```