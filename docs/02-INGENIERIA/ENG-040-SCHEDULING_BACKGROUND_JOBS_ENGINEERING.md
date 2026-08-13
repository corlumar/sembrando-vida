---
id: ENG-040
titulo: Scheduling & Background Jobs Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Scheduling & Background Jobs
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-011
  - ENG-016
  - ENG-021
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-038
  - ENG-039
relacionados:
  - ENG-006
  - ENG-012
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-033
  - ENG-037
  - ENG-041
keywords:
  - scheduling
  - background-jobs
  - scheduler
  - job
  - worker
  - queue
  - delayed-job
  - recurring-job
  - cron
  - retry
  - lease
  - idempotency
  - deduplication
  - dead-letter
  - poison-job
  - priority
  - mef
---

# ENG-040

# Scheduling & Background Jobs Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Scheduling & Background Jobs Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-040 establece las reglas para:

```text
Job
Job Definition
Job Instance
Job Payload
Job Handler
Scheduler
Schedule
Delayed Job
Recurring Job
Cron
Queue
Worker
Worker Pool
Job State
Job Lifecycle
Job Execution
Job Timeout
Job Deadline
Job Retry
Retry Backoff
Job Lease
Visibility Timeout
Heartbeat
Job Idempotency
Job Deduplication
Job Priority
Job Cancellation
Job Recovery
Poison Job
Dead Letter
Misfire
Overlap
Backpressure
Job Observability
Job Security
Job Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo trabajo diferido, programado o ejecutado en Background deberá poseer identidad, Ownership, Lifecycle, Failure semantics e Idempotency explícitos.**

La arquitectura conceptual será:

```text
Producer
   │
   ▼
Job Definition
   │
   ▼
Scheduler / Queue
   │
   ▼
Job Instance
   │
   ▼
Claim / Lease
   │
   ▼
Worker
   │
   ▼
Job Handler
   │
   ├── Success
   │
   ├── Retry
   │
   ├── Dead Letter
   │
   └── Cancel
   ▼
Terminal State
```

---

# 3. Background Work

`Background Work` es trabajo cuya ejecución no necesita completarse dentro del Request original.

---

# 4. Background ≠ Fire-and-Forget

MEF no deberá interpretar:

```text
background
```

como:

```text
start task
forget ownership
ignore failure
```

---

# 5. Durable Background Work

Cuando perder el trabajo sea inaceptable deberá utilizarse almacenamiento Durable.

---

# 6. Ephemeral Background Work

Podrá utilizarse únicamente cuando perder la operación sea semánticamente aceptable.

---

# 7. Job

Un `Job` representa una unidad explícita de trabajo diferido.

---

# 8. Job Definition

Describe el tipo de trabajo.

Ejemplos:

```text
SendEmail
GenerateReport
ProcessImport
RebuildIndex
ExpireSession
SynchronizeCustomer
```

---

# 9. Job Instance

Representa una ejecución concreta de una Job Definition.

---

# 10. Job Identity

Toda Job Instance durable deberá poseer:

```text
jobId
```

único.

---

# 11. Job Type

Deberá existir un identificador estable:

```text
jobType
```

---

# 12. Job Type Stability

`jobType` forma parte del Contract persistido y deberá someterse a Compatibility cuando pueda sobrevivir a Deployments.

---

# 13. Job Payload

Contendrá únicamente los datos necesarios para ejecutar el Job.

---

# 14. Payload Principle

Deberá preferirse:

```text
identifier
reference
small immutable command data
```

sobre serializar grandes Object Graphs.

---

# 15. Payload Serialization

ENG-031 gobernará Serialization.

---

# 16. Payload Version

Jobs durables deberán considerar:

```text
payloadVersion
```

cuando puedan sobrevivir a cambios de Software.

---

# 17. Payload Compatibility

Un Worker nuevo deberá saber:

```text
process old payload
```

o:

```text
reject/migrate old payload explicitly
```

---

# 18. Sensitive Payload

No deberá persistir Secrets innecesarios.

---

# 19. Personal/Sensitive Data

Deberá minimizarse conforme a ENG-024.

---

# 20. Job Metadata

Podrá incluir:

```text
jobId
jobType
createdAt
scheduledAt
priority
attempt
maxAttempts
correlationId
causationId
tenantId
payloadVersion
```

---

# 21. Correlation

ENG-025 deberá permitir relacionar:

```text
Request
→ Job
→ Worker execution
```

---

# 22. Causation

Cuando sea relevante deberá conocerse qué operación originó el Job.

---

# 23. Job Handler

Un `Job Handler` ejecuta una Job Definition.

---

# 24. Handler Contract

Conceptualmente:

```text
JobHandler<TJob>
    handle(TJob, JobContext)
        → JobResult
```

---

# 25. Handler Ownership

Cada Job Type deberá poseer Handler inequívoco salvo Pattern explícitamente distinto.

---

# 26. Handler Discovery

Podrá realizarse mediante ENG-020 Registry.

---

# 27. Handler Resolution

ENG-019 Service Container podrá resolver Dependencies.

---

# 28. Handler Scope

Deberá existir Scope por Job Execution.

---

# 29. Request Scope ≠ Job Scope

Un Job no deberá depender implícitamente de un Request HTTP existente.

---

# 30. Job Context

Conceptualmente:

```text
JobContext
├── jobId
├── attempt
├── deadline
├── cancellation
├── correlation
├── tenant
└── metadata
```

---

# 31. Scheduler

Un `Scheduler` determina cuándo un Job debe convertirse en elegible para ejecución.

---

# 32. Scheduler ≠ Worker

```text
Scheduler
→ decides when

Worker
→ executes work
```

---

# 33. Scheduler ≠ Queue

```text
Scheduler
→ temporal policy

Queue
→ delivery/storage mechanism
```

---

# 34. Immediate Job

Puede ser elegible inmediatamente.

---

# 35. Delayed Job

Tiene:

```text
scheduledAt > now
```

---

# 36. Recurring Job

Genera ejecuciones según una Schedule repetitiva.

---

# 37. Recurring Definition ≠ Job Instance

Deberán distinguirse:

```text
RecurringJobDefinition
```

y:

```text
JobInstance
```

---

# 38. Schedule

Una `Schedule` define cuándo ejecutar.

---

# 39. Schedule Types

MEF podrá soportar:

```text
one-time
fixed-delay
fixed-rate
cron
calendar-based
```

---

# 40. First Version Schedule Types

La primera versión deberá priorizar:

```text
one-time
delayed
cron
```

---

# 41. Cron

Podrá utilizar expresión Cron mediante Contract.

---

# 42. Cron Dialect

El dialecto deberá estar documentado.

---

# 43. Cron Portability

No deberá asumirse que todos los proveedores interpretan Cron exactamente igual.

---

# 44. Cron Validation

ENG-036 deberá validar expresiones.

---

# 45. Time Zone

Toda Schedule calendar-based deberá poseer Time Zone explícita.

---

# 46. Default Time Zone

Deberá definirse globalmente cuando se permita omitirla.

---

# 47. UTC

Deberá favorecerse para almacenamiento interno de Instants.

---

# 48. Local Time

Podrá utilizarse para reglas de negocio calendar-based.

---

# 49. DST

Schedules deberán definir comportamiento ante:

```text
missing local time
duplicated local time
```

causado por Daylight Saving Time.

---

# 50. DST Gap

Una hora local puede no existir.

---

# 51. DST Overlap

Una hora local puede ocurrir dos veces.

---

# 52. DST Policy

Deberá existir Policy explícita.

---

# 53. Clock

ENG-038 gobernará diferencias entre:

```text
wall clock
monotonic clock
logical sequence
```

---

# 54. Scheduling Clock

Calendar Scheduling requiere Wall Clock.

---

# 55. Timeout Clock

Timeouts deberán favorecer Clock monotónico.

---

# 56. Clock Skew

Schedulers distribuidos deberán considerar diferencias entre Nodes.

---

# 57. Next Run

Una Recurring Definition deberá poder calcular:

```text
nextRunAt
```

determinísticamente.

---

# 58. Schedule Version

Cambios de Schedule deberán ser observables.

---

# 59. Schedule Update

Deberá definir qué ocurre con ejecuciones ya materializadas.

---

# 60. Schedule Disable

Deberá impedir nuevas ejecuciones sin eliminar necesariamente History.

---

# 61. Schedule Delete

No deberá borrar automáticamente Job History salvo Policy explícita.

---

# 62. Misfire

Un `Misfire` ocurre cuando una ejecución programada no pudo iniciarse aproximadamente cuando correspondía.

Ejemplo:

```text
Scheduled: 02:00
Scheduler unavailable until 03:00
```

---

# 63. Misfire Policy

Deberá ser explícita.

Podrá ser:

```text
SKIP
RUN_ONCE
CATCH_UP
RESCHEDULE_NEXT
```

---

# 64. SKIP

Omite la ejecución perdida.

---

# 65. RUN_ONCE

Ejecuta una vez al recuperarse.

---

# 66. CATCH_UP

Ejecuta ocurrencias perdidas.

---

# 67. Catch-Up Limit

Deberá poseer límite.

---

# 68. Unbounded Catch-Up

No deberá permitirse.

---

# 69. RESCHEDULE_NEXT

Continúa con la siguiente ocurrencia futura.

---

# 70. Misfire Correctness

La Policy deberá elegirse según semántica del Job.

---

# 71. Overlap

Una ejecución puede seguir activa cuando llega la siguiente Schedule.

---

# 72. Overlap Policy

Deberá definirse.

Podrá ser:

```text
ALLOW
SKIP
QUEUE
REPLACE
SINGLETON
```

---

# 73. ALLOW

Permite ejecuciones concurrentes.

---

# 74. SKIP

Omite la nueva ejecución.

---

# 75. QUEUE

Mantiene la nueva ejecución pendiente.

---

# 76. REPLACE

Solicita cancelar/reemplazar ejecución anterior cuando sea seguro.

---

# 77. SINGLETON

Solo una ejecución lógica puede estar activa.

---

# 78. Overlap + Idempotency

Permitir Overlap requiere analizar efectos concurrentes.

---

# 79. Queue

Una `Queue` representa un mecanismo de entrega y almacenamiento de Jobs elegibles.

---

# 80. Queue Contract

Conceptualmente:

```text
JobQueue
├── enqueue()
├── claim()
├── acknowledge()
├── release()
└── reject()
```

---

# 81. Queue Durability

Deberá declararse:

```text
durable
ephemeral
```

---

# 82. Durable Queue

Deberá sobrevivir Restart según Contract.

---

# 83. Queue Ordering

No deberá asumirse FIFO estricto salvo garantía explícita.

---

# 84. FIFO

Incluso con FIFO, Retries y múltiples Workers pueden alterar Completion Order.

---

# 85. Ordering Requirement

Si el orden es crítico deberá modelarse explícitamente.

---

# 86. Partitioning

Podrá utilizar:

```text
tenant
aggregate
resource
jobType
```

---

# 87. Partition Key

Podrá ayudar a preservar Ordering local.

---

# 88. Queue Capacity

Queues internas deberán ser acotadas.

---

# 89. Durable External Queue

La capacidad seguirá siendo finita aunque el proveedor abstraiga Storage.

---

# 90. Queue Saturation

Deberá ser observable.

---

# 91. Backpressure

ENG-039 gobernará Backpressure.

---

# 92. Queue Depth

No deberá considerarse únicamente una métrica operativa; puede indicar incapacidad de procesamiento.

---

# 93. Worker

Un `Worker` consume Jobs elegibles y ejecuta Handlers.

---

# 94. Worker Lifecycle

Conceptualmente:

```text
STARTING
READY
RUNNING
DRAINING
STOPPED
FAILED
```

---

# 95. Worker Pool

Podrá ejecutar múltiples Jobs concurrentemente.

---

# 96. Worker Concurrency

Deberá ser acotada.

---

# 97. Worker Concurrency Configuration

ENG-011 gobernará:

```text
workerCount
maxConcurrency
pollInterval
claimBatchSize
```

---

# 98. Polling

Un Worker podrá consultar periódicamente la Queue.

---

# 99. Poll Interval

Deberá evitar:

```text
busy polling
```

y latencia excesiva.

---

# 100. Empty Queue Backoff

Podrá utilizarse.

---

# 101. Push Delivery

También podrá soportarse mediante Adapter.

---

# 102. Worker Identity

Cada Worker podrá poseer:

```text
workerId
```

para Diagnostics y Ownership.

---

# 103. Claim

Antes de ejecutar un Job durable, un Worker deberá obtener Ownership verificable.

---

# 104. Atomic Claim

Dos Workers no deberán reclamar correctamente el mismo Job como ejecución exclusiva simultánea.

---

# 105. Claim State

Conceptualmente:

```text
READY
  │
  ▼
CLAIMED
```

---

# 106. Lease

Cuando Ownership pueda perderse por tiempo deberá utilizarse Lease.

---

# 107. Job Lease

Conceptualmente:

```text
JobLease
├── jobId
├── workerId
├── leaseToken
├── acquiredAt
└── expiresAt
```

---

# 108. Lease Expiration

Un Worker deberá asumir pérdida de Ownership después de Expiration.

---

# 109. Lease Renewal

Jobs largos podrán renovar Lease.

---

# 110. Heartbeat

Un Worker podrá emitir Heartbeat para renovar Ownership o demostrar progreso.

---

# 111. Heartbeat Interval

Deberá ser significativamente menor que Lease Duration.

---

# 112. Heartbeat Failure

Deberá manejarse como posible pérdida de Ownership.

---

# 113. Visibility Timeout

En algunos Queue Providers el Lease se representa como Visibility Timeout.

---

# 114. Visibility Timeout Expiration

Puede provocar Redelivery.

---

# 115. Redelivery

Deberá asumirse posible.

---

# 116. Exactly Once

MEF no deberá prometer `exactly-once execution` de forma general.

---

# 117. Delivery Semantics

Deberán declararse.

Podrán ser:

```text
at-most-once
at-least-once
```

---

# 118. Preferred Durable Semantics

Para trabajo durable importante normalmente deberá favorecerse:

```text
at-least-once delivery
+
idempotent effect
```

---

# 119. Execution ≠ Effect

Un Job puede ejecutarse más de una vez pero producir un único efecto lógico mediante Idempotency.

---

# 120. At-Most-Once

Puede perder trabajo ante Failure.

---

# 121. At-Least-Once

Puede duplicar ejecución.

---

# 122. Exactly-Once Effect

Podrá aproximarse dentro de una Boundary mediante:

```text
idempotency
transaction
deduplication
unique constraint
```

pero deberá documentarse su Scope.

---

# 123. Job State

MEF deberá modelar Lifecycle explícito.

---

# 124. Base Job States

```text
SCHEDULED
READY
RUNNING
SUCCEEDED
FAILED
RETRY_WAIT
CANCELLED
DEAD_LETTERED
```

---

# 125. Optional States

Podrán existir:

```text
PAUSED
BLOCKED
EXPIRED
```

---

# 126. State Machine

Conceptualmente:

```text
                 ┌──────────────┐
                 │  SCHEDULED   │
                 └──────┬───────┘
                        │ due
                        ▼
                 ┌──────────────┐
                 │    READY     │
                 └──────┬───────┘
                        │ claim
                        ▼
                 ┌──────────────┐
                 │   RUNNING    │
                 └───┬────┬─────┘
                     │    │
              success│    │failure
                     │    │
                     ▼    ▼
              SUCCEEDED  FAILED
                            │
                    ┌───────┴───────┐
                    │               │
                 retryable       terminal
                    │               │
                    ▼               ▼
               RETRY_WAIT     DEAD_LETTERED
                    │
                    │ due
                    ▼
                  READY
```

---

# 127. Cancellation Transition

Desde estados elegibles:

```text
SCHEDULED
READY
RETRY_WAIT
```

podrá transitar directamente a:

```text
CANCELLED
```

---

# 128. Running Cancellation

`RUNNING → CANCELLED` requerirá Cooperative Cancellation o mecanismo equivalente.

---

# 129. State Transition

Deberá ser atómica.

---

# 130. Invalid Transition

Deberá rechazarse.

Ejemplo:

```text
SUCCEEDED
→
RUNNING
```

sin operación explícita de Replay.

---

# 131. Terminal States

Inicialmente:

```text
SUCCEEDED
CANCELLED
DEAD_LETTERED
```

---

# 132. FAILED

Podrá ser intermedio o terminal según Policy.

---

# 133. Job Attempt

Cada ejecución deberá poseer número de Attempt.

---

# 134. Initial Attempt

Deberá definirse consistentemente como:

```text
1
```

---

# 135. Attempt History

Jobs críticos podrán conservar:

```text
startedAt
finishedAt
workerId
failure
duration
```

por Attempt.

---

# 136. Job Timeout

Cada Attempt deberá poder tener Timeout.

---

# 137. Job Deadline

El Job completo podrá poseer Deadline distinto del Timeout de cada Attempt.

---

# 138. Timeout vs Deadline

```text
Attempt Timeout
→ max duration of one execution

Job Deadline
→ latest acceptable completion time
```

---

# 139. Expired Job

Un Job que ya no posee valor después del Deadline no deberá ejecutarse.

---

# 140. Expiration Policy

Podrá:

```text
cancel
dead-letter
mark expired
```

---

# 141. Retry

ENG-039 gobernará Retry semantics generales.

---

# 142. Job Retry Policy

Podrá incluir:

```text
maxAttempts
backoff
jitter
retryableFailures
deadline
```

---

# 143. Retry Persistence

El estado del Retry deberá persistirse para Jobs durables.

---

# 144. In-Memory Sleep Retry

No deberá utilizarse para esperas largas en Workers durables.

---

# 145. Retry Scheduling

Preferir:

```text
RETRY_WAIT
nextAttemptAt
```

---

# 146. Worker Release

Mientras espera Backoff, el Job no deberá consumir innecesariamente un Worker.

---

# 147. Retry Classification

No todos los Failures deberán reintentarse.

---

# 148. Validation Failure

Normalmente deberá terminar sin Retry.

---

# 149. Authorization Failure

Normalmente tampoco.

---

# 150. Dependency Failure

Podrá ser Retryable según ENG-039.

---

# 151. Concurrency Conflict

Podrá ser Retryable según ENG-038 y semántica del Job.

---

# 152. Retry Exhaustion

Cuando `maxAttempts` se agote deberá aplicarse Failure Policy.

---

# 153. Failure Policy

Podrá ser:

```text
DEAD_LETTER
FAIL
DISCARD
ESCALATE
```

---

# 154. DISCARD

Solo deberá permitirse para trabajo explícitamente prescindible.

---

# 155. Silent Discard

No deberá ser Default.

---

# 156. Idempotency

Todo Job que pueda ser Redelivered deberá analizar Idempotency.

---

# 157. Idempotency Key

Podrá derivarse de:

```text
jobId
business operation id
external command id
deduplication key
```

---

# 158. Handler Idempotency

Deberá garantizar que repetir ejecución no multiplique efectos no deseados.

---

# 159. Idempotency Scope

Deberá documentarse.

---

# 160. Idempotency Store

Deberá ser Durable cuando perderlo pueda duplicar un efecto crítico.

---

# 161. Idempotency Claim

Deberá ser atómico.

---

# 162. Ambiguous Completion

Caso:

```text
Worker
  │
  ▼
external side effect succeeds
  │
  ▼
Worker crashes before ACK
```

El Job será Redelivered.

---

# 163. Redelivery Protection

Deberá utilizar Idempotency o reconciliación.

---

# 164. ACK After Effect

Es común en At-Least-Once.

---

# 165. ACK Before Effect

Puede perder trabajo.

---

# 166. ACK Timing

Deberá documentarse.

---

# 167. Deduplication

`Deduplication` evita crear/procesar múltiples Jobs equivalentes según una Key.

---

# 168. Deduplication ≠ Idempotency

```text
Deduplication
→ avoid duplicate work

Idempotency
→ duplicate execution has same logical effect
```

---

# 169. Deduplication Key

Podrá ser:

```text
tenant + jobType + resourceId
```

---

# 170. Deduplication Window

Deberá definirse.

---

# 171. Permanent Deduplication

No deberá utilizarse accidentalmente cuando una operación válida pueda repetirse en el futuro.

---

# 172. Atomic Deduplication

La creación concurrente deberá protegerse atómicamente.

---

# 173. Priority

Jobs podrán poseer Priority.

---

# 174. Priority Levels

Deberán ser pocos y estables.

Ejemplo:

```text
LOW
NORMAL
HIGH
CRITICAL
```

---

# 175. Arbitrary Integer Priority

Podrá existir internamente, pero no deberá convertirse automáticamente en Contract público.

---

# 176. Priority Scheduling

Deberá evitar Starvation.

---

# 177. Aging

Podrá incrementar prioridad efectiva de Jobs antiguos.

---

# 178. Critical Priority

No deberá utilizarse para compensar Capacity insuficiente.

---

# 179. Multiple Queues

Podrán utilizarse para aislar Workloads.

Ejemplo:

```text
critical
default
bulk
```

---

# 180. Queue Isolation

Deberá alinearse con ENG-039 Bulkheads.

---

# 181. Poison Job

Un `Poison Job` falla repetidamente de forma no transitoria.

---

# 182. Poison Detection

Podrá basarse en:

```text
attempt count
failure classification
repeated deterministic failure
```

---

# 183. Poison Job Handling

No deberá bloquear indefinidamente la Queue.

---

# 184. Dead Letter

Una `Dead Letter` conserva Jobs que no pudieron procesarse normalmente.

---

# 185. Dead Letter Queue

Podrá existir:

```text
DLQ
```

---

# 186. Dead Letter Record

Deberá conservar información suficiente para Diagnosis.

---

# 187. DLQ Metadata

Podrá incluir:

```text
jobId
jobType
attempts
failureCode
failedAt
originalQueue
payloadVersion
```

---

# 188. DLQ Sensitive Data

No deberá duplicar Payload sensible innecesariamente.

---

# 189. DLQ Retention

Deberá configurarse.

---

# 190. DLQ Monitoring

No deberá convertirse en cementerio silencioso.

---

# 191. Dead Letter Replay

Podrá permitirse.

---

# 192. Replay

Deberá crear Audit/History.

---

# 193. Replay Idempotency

Deberá conservar o redefinir explícitamente la Idempotency Key.

---

# 194. Replay After Fix

Podrá utilizarse tras corregir causa del Failure.

---

# 195. Bulk Replay

Deberá estar limitado.

---

# 196. Replay Storm

Deberá evitarse.

---

# 197. Job Cancellation

Jobs pendientes deberán poder cancelarse cuando el Contract lo permita.

---

# 198. Cancellation Request

Deberá diferenciarse de Cancellation completada.

---

# 199. Cooperative Cancellation

Handlers largos deberán observar Cancellation cuando sea seguro.

---

# 200. Cancellation Token

Podrá proporcionarse mediante JobContext.

---

# 201. Cancellation + Side Effects

No deberá asumirse Rollback.

---

# 202. Cancelled Job Retry

No deberá reintentarse automáticamente.

---

# 203. Cancellation Race

Puede ocurrir:

```text
cancel request
vs
job completion
```

---

# 204. Cancellation State Transition

Deberá resolverse atómicamente.

---

# 205. Job Recovery

Workers pueden morir mientras ejecutan.

---

# 206. Orphan Job

Un Job `RUNNING` cuyo Worker ya no existe deberá poder recuperarse.

---

# 207. Lease-Based Recovery

Tras expirar Lease podrá volver a:

```text
READY
```

o estado equivalente.

---

# 208. Recovery Attempt

Deberá incrementar Attempt cuando corresponda.

---

# 209. Recovery Idempotency

Deberá asumirse que el Worker anterior pudo haber producido Side Effects.

---

# 210. Worker Crash

No deberá implicar automáticamente Job Failure definitivo.

---

# 211. Scheduler Recovery

Un Scheduler reiniciado deberá reconstruir próximas ejecuciones desde State durable.

---

# 212. Duplicate Scheduler

Múltiples Scheduler Instances no deberán materializar duplicados incorrectos.

---

# 213. Scheduler Leadership

No deberá requerirse necesariamente un único Leader.

---

# 214. Distributed Scheduling

Deberá favorecer:

```text
atomic claim
unique occurrence key
database constraint
partition ownership
```

antes de introducir Leader Election.

---

# 215. Occurrence Identity

Una ejecución recurrente podrá identificarse mediante:

```text
scheduleId + occurrenceTime
```

---

# 216. Unique Occurrence

Deberá impedir materialización duplicada cuando el Contract requiera una sola ocurrencia lógica.

---

# 217. Scheduler Tick

Deberá ser Idempotent.

---

# 218. Scheduler Lookahead

Podrá materializar Jobs dentro de una ventana futura.

---

# 219. Lookahead Window

Deberá ser acotada.

---

# 220. Clock Jump

Cambios de Wall Clock deberán considerarse.

---

# 221. Scheduler Drift

Deberá medirse diferencia entre:

```text
scheduledAt
startedAt
```

---

# 222. Job Lag

Conceptualmente:

```text
jobLag =
startedAt - scheduledAt
```

---

# 223. Queue Wait

Conceptualmente:

```text
queueWait =
startedAt - readyAt
```

---

# 224. Execution Duration

```text
executionDuration =
finishedAt - startedAt
```

---

# 225. End-to-End Latency

```text
completionLatency =
finishedAt - createdAt
```

---

# 226. Observability

ENG-025 gobernará Telemetry.

---

# 227. Job Metrics

Podrán incluir:

```text
mef.jobs.created.total
mef.jobs.ready
mef.jobs.running
mef.jobs.succeeded.total
mef.jobs.failed.total
mef.jobs.retried.total
mef.jobs.cancelled.total
mef.jobs.dead_lettered.total
```

---

# 228. Timing Metrics

Podrán incluir:

```text
mef.jobs.queue_wait.duration
mef.jobs.execution.duration
mef.jobs.completion.duration
mef.jobs.schedule_drift.duration
```

---

# 229. Queue Metrics

Podrán incluir:

```text
mef.jobs.queue.depth
mef.jobs.queue.oldest.age
mef.jobs.queue.claim.failures
```

---

# 230. Worker Metrics

Podrán incluir:

```text
mef.jobs.workers.active
mef.jobs.workers.busy
mef.jobs.workers.capacity
mef.jobs.worker.heartbeat.failures
```

---

# 231. Retry Metrics

Podrán incluir:

```text
attempt
retry count
retry exhausted
```

---

# 232. DLQ Metrics

Deberán permitir Alerting.

---

# 233. High Cardinality

`jobId` no deberá utilizarse como Metric Label.

---

# 234. Trace

Cada Job Execution podrá crear un Span.

---

# 235. Trace Linking

Cuando el Job se ejecute mucho después del Producer podrá utilizarse Trace Link en lugar de Parent Span directo.

---

# 236. Logs

Deberán incluir Context controlado:

```text
jobType
jobId
attempt
workerId
state
failureCode
```

---

# 237. Payload Logging

No deberá registrarse por Default.

---

# 238. Alerts

Podrán existir para:

```text
queue depth
oldest job age
DLQ growth
retry rate
failure rate
worker saturation
scheduler drift
```

---

# 239. SLO

Jobs críticos podrán definir:

```text
completion SLO
maximum queue age
success rate
```

---

# 240. Security

ENG-024 gobernará Security.

---

# 241. Producer Authorization

Crear un Job deberá respetar Authorization del Use Case.

---

# 242. Execution Authorization

No deberá asumirse que el contexto original sigue siendo válido indefinidamente.

---

# 243. Principal Snapshot

Persistir Roles/Permissions completos del usuario puede quedar obsoleto.

---

# 244. Reauthorization

Jobs sensibles podrán requerir Authorization actual al ejecutarse.

---

# 245. System Job

Podrá ejecutarse con Service Identity explícita.

---

# 246. Impersonation

Deberá evitarse salvo Contract y Audit explícitos.

---

# 247. Tenant Isolation

Todo Job multi-tenant deberá preservar Tenant Context.

---

# 248. Cross-Tenant Execution

No deberá ser posible por contaminación de Worker Context.

---

# 249. Worker Context Reset

Después de cada Job deberán limpiarse:

```text
tenant
principal
transaction
trace-local state
temporary resources
```

---

# 250. Job Payload Trust

Payload persistido no deberá considerarse confiable únicamente por provenir de una Queue interna.

---

# 251. Payload Validation

ENG-036 deberá validar en Boundary apropiada.

---

# 252. Payload Tampering

Cuando el Threat Model lo requiera deberá existir Integrity Protection.

---

# 253. Queue Credentials

Deberán administrarse como Secrets.

---

# 254. Job History Access

Deberá respetar Authorization.

---

# 255. DLQ Access

También.

---

# 256. Sensitive Failure

Exceptions persistidas deberán sanitizarse.

---

# 257. Persistence

ENG-030 gobernará Durable Job State.

---

# 258. Transactional Enqueue

Caso:

```text
save order
enqueue email
```

puede quedar inconsistente si son operaciones separadas.

---

# 259. Transactional Outbox

ENG-022/ENG-030 podrá utilizarse para publicar Jobs/Events después de Commit confiable.

---

# 260. Outbox Relay

Deberá ser Idempotent.

---

# 261. Inbox

Podrá utilizarse para deduplicar Delivery entrante.

---

# 262. Job Store

Podrá abstraerse mediante:

```text
JobStore
```

---

# 263. Job Store Responsibilities

Conceptualmente:

```text
save
schedule
claim
transition
renewLease
complete
fail
cancel
```

---

# 264. Atomic State Transition

JobStore deberá soportar transiciones condicionales.

---

# 265. Optimistic Version

Podrá utilizarse.

---

# 266. Job Version

Conceptualmente:

```text
jobVersion
```

---

# 267. Worker Stale Write

Un Worker antiguo no deberá poder sobrescribir State posterior.

---

# 268. Fencing

ENG-038 podrá utilizar Fencing Token para Workers/Leases críticos.

---

# 269. Handler Transaction

Deberá ser explícita.

---

# 270. Long Job Transaction

No deberá mantener una DB Transaction abierta durante todo un Job largo.

---

# 271. Checkpoint

Jobs largos podrán guardar progreso.

---

# 272. Checkpoint State

Deberá ser Durable cuando Recovery lo requiera.

---

# 273. Resume

Podrá continuar desde Checkpoint.

---

# 274. Checkpoint Compatibility

Deberá versionarse cuando sobreviva Deployments.

---

# 275. Progress

Podrá representarse como:

```text
processedItems
totalItems
percentage
stage
```

---

# 276. Progress Accuracy

No deberá prometer precisión que el Job no pueda calcular.

---

# 277. Chunking

Trabajos masivos deberán dividirse cuando sea razonable.

---

# 278. Chunk Size

Deberá balancear:

```text
throughput
memory
transaction duration
retry cost
```

---

# 279. Fan-Out

Un Job podrá crear Child Jobs.

---

# 280. Fan-Out Bound

Deberá ser acotado.

---

# 281. Fan-In

Podrá esperar múltiples Child Jobs.

---

# 282. Workflow

Orquestación compleja de múltiples Jobs no deberá introducirse implícitamente dentro del Scheduler básico.

---

# 283. Workflow Engine

No será requisito de la primera versión.

---

# 284. Parent Job

Podrá almacenar referencias a Child Jobs.

---

# 285. Child Failure

La Policy deberá definir efecto sobre Parent.

---

# 286. Job Dependency

Podrá modelarse explícitamente en una fase posterior.

---

# 287. DAG Scheduling

No será parte obligatoria inicial.

---

# 288. Rate Limiting

Jobs que llaman Dependencies externas deberán respetar Rate Limits.

---

# 289. Rate Limit ≠ Worker Limit

```text
worker concurrency
≠
requests per second
```

---

# 290. Dependency Quota

Podrá limitar ejecución independientemente de Queue Capacity.

---

# 291. Rate Limit Response

Podrá reprogramar Job respetando:

```text
Retry-After
```

cuando sea confiable.

---

# 292. Resilience

ENG-039 continuará gobernando:

```text
timeout
retry
circuit breaker
bulkhead
fallback
load shedding
```

---

# 293. Circuit Open Job

No deberá ocupar Worker haciendo Busy Retry.

---

# 294. Reschedule

Podrá volver a:

```text
RETRY_WAIT
```

---

# 295. Load Shedding

Jobs prescindibles podrán rechazarse bajo Overload según Policy.

---

# 296. Critical Durable Job

No deberá descartarse silenciosamente.

---

# 297. Shutdown

ENG-027 gobernará Runtime Shutdown.

---

# 298. Worker Drain

Durante Shutdown:

```text
stop claiming new jobs
      │
      ▼
finish/cancel in-flight
      │
      ▼
release/recover ownership
      │
      ▼
stop
```

---

# 299. Shutdown Deadline

Deberá respetarse.

---

# 300. Forced Termination

Jobs incompletos deberán ser recuperables cuando la Delivery semantics lo requiera.

---

# 301. Deployment

Jobs pueden sobrevivir a Deployments.

---

# 302. Rolling Deployment

Workers de distintas Versions pueden coexistir.

---

# 303. Compatibility

ENG-016 deberá gobernar:

```text
jobType
payload
schedule
checkpoint
result
```

---

# 304. Handler Removal

No deberá eliminarse un Handler mientras existan Jobs persistidos de ese Type sin Migration/Drain Strategy.

---

# 305. Job Rename

Cambiar Class Name no deberá cambiar automáticamente `jobType`.

---

# 306. Versioned Handler

Podrá soportarse:

```text
invoice.generate.v1
invoice.generate.v2
```

cuando sea necesario.

---

# 307. Deployment Drain

Podrá detener Claims antes de apagar una Version incompatible.

---

# 308. Migration

Jobs pendientes podrán migrarse explícitamente.

---

# 309. Scheduler Compatibility

Cambiar Schedule no deberá reinterpretar History.

---

# 310. Testing

ENG-009 gobernará Testing.

---

# 311. Handler Unit Test

Deberá probar lógica independientemente del Queue Provider.

---

# 312. Scheduler Test

Deberá utilizar Clock controlable.

---

# 313. Delayed Job Test

Deberá comprobar que no sea elegible antes de `scheduledAt`.

---

# 314. Recurring Job Test

Deberá comprobar `nextRunAt`.

---

# 315. DST Test

Será obligatorio cuando se soporten Time Zones locales.

---

# 316. Misfire Test

Deberá comprobar cada Policy soportada.

---

# 317. Overlap Test

Deberá comprobar ejecución concurrente según Policy.

---

# 318. Claim Race Test

Dos Workers deberán competir por el mismo Job y solo uno obtener Claim exclusivo.

---

# 319. Lease Expiration Test

Deberá comprobar Recovery.

---

# 320. Heartbeat Test

Deberá comprobar Renewal.

---

# 321. Worker Crash Test

Deberá comprobar Redelivery/Recovery.

---

# 322. Idempotency Test

Dos ejecuciones deberán producir un único efecto lógico cuando el Contract lo requiera.

---

# 323. Deduplication Test

Creación concurrente deberá respetar Deduplication Key.

---

# 324. Retry Test

Deberá comprobar:

```text
attempt
backoff
jitter
maxAttempts
```

---

# 325. Poison Job Test

Deberá comprobar que no bloquee la Queue.

---

# 326. DLQ Test

Deberá comprobar transferencia y Metadata.

---

# 327. Replay Test

Deberá comprobar Audit e Idempotency.

---

# 328. Cancellation Race Test

Deberá comprobar:

```text
completion vs cancellation
```

---

# 329. Shutdown Test

Deberá comprobar Drain y Recovery.

---

# 330. Compatibility Test

Deberá probar Payloads persistidos de Versions anteriores.

---

# 331. Load Test

Deberá medir:

```text
enqueue rate
processing rate
queue depth
lag
worker saturation
```

---

# 332. Soak Test

Podrá detectar:

```text
memory leaks
stuck jobs
lease leaks
queue growth
worker degradation
```

---

# 333. Fault Injection

Podrá simular:

```text
worker crash
scheduler crash
database outage
queue outage
clock jump
lease loss
network timeout
```

---

# 334. Deterministic Test Clock

Deberá favorecerse.

---

# 335. Sleep-Based Tests

No deberán ser la estrategia principal.

---

# 336. Architecture Tests

Podrán verificar:

```text
Domain does not depend on scheduler vendor
Handlers implement known contract
Job types are unique
Queues are bounded where local
```

---

# 337. Build Integration

ENG-012 podrá validar:

```text
duplicate jobType
missing handler
invalid cron
missing payload version
invalid retry policy
unbounded worker concurrency
```

---

# 338. CLI

ENG-007 podrá proporcionar comandos como:

```text
mef jobs:list
mef jobs:inspect <jobId>
mef jobs:retry <jobId>
mef jobs:cancel <jobId>
mef jobs:dead-letter
mef jobs:replay <jobId>
mef schedules:list
mef schedules:run <scheduleId>
mef workers:status
```

---

# 339. CLI Security

Operaciones destructivas deberán respetar ENG-024.

---

# 340. CLI Replay

Deberá solicitar intención explícita cuando pueda repetir Side Effects.

---

# 341. Configuration

ENG-011 podrá definir:

```text
jobs:
  default-queue: default

  workers:
    concurrency: 8
    poll-interval: 1s

  lease:
    duration: 60s
    heartbeat: 20s

  retry:
    max-attempts: 5

  scheduler:
    timezone: UTC
    lookahead: 60s
```

---

# 342. Configuration Validation

Deberá comprobar relaciones como:

```text
heartbeat < lease duration
```

---

# 343. Dangerous Configuration

Deberá rechazar:

```text
maxAttempts = unlimited
workerConcurrency = unlimited
leaseDuration <= 0
```

---

# 344. Runtime Integration

ENG-027 deberá administrar:

```text
Scheduler Runtime
Worker Runtime
Job Scope
Drain
Shutdown
```

---

# 345. Module Integration

ENG-028 deberá permitir que Modules registren:

```text
Job Definitions
Handlers
Schedules
```

---

# 346. Module Disable

Deberá considerar Jobs pendientes pertenecientes al Module.

---

# 347. Module Uninstall

No deberá eliminar Handler requerido por Jobs pendientes sin Migration/Drain.

---

# 348. Registry

ENG-020 podrá registrar:

```text
JobDefinition
JobHandlerDefinition
ScheduleDefinition
QueueDefinition
```

---

# 349. Registry Validation

Deberá detectar:

```text
duplicate jobType
missing handler
duplicate scheduleId
unknown queue
```

---

# 350. Service Container

ENG-019 resolverá Handler Dependencies por Job Scope.

---

# 351. Dependency Injection

ENG-018 permitirá Adapters para Queue/Scheduler/Store.

---

# 352. Contracts

ENG-021 deberá definir Contracts independientes del proveedor.

---

# 353. Event Bus

ENG-022 deberá mantener separación:

```text
Domain/Event message
≠
Background Job
```

---

# 354. Event

Representa algo que ocurrió.

---

# 355. Job

Representa trabajo que debe ejecutarse.

---

# 356. Event-to-Job

Un Event Handler podrá producir un Job.

---

# 357. Job-to-Event

Un Job podrá publicar Events después de completar cambios relevantes.

---

# 358. Event Replay ≠ Job Replay

No deberán confundirse.

---

# 359. Transport

ENG-032 podrá proporcionar Adapters para Queue Protocols externos.

---

# 360. Application

ENG-034 podrá encolar Jobs como parte de Use Cases.

---

# 361. Domain

ENG-035 no deberá depender de:

```text
Cron
Queue
Worker
Scheduler
```

---

# 362. Domain Intent

Domain podrá producir una intención/evento que Application transforme en trabajo diferido.

---

# 363. Validation

ENG-036 validará:

```text
payload
schedule
configuration
state transitions
```

---

# 364. Caching

ENG-037 no deberá utilizarse como único Job Store durable.

---

# 365. Concurrency

ENG-038 gobernará:

```text
claim
lease
fencing
deduplication races
worker concurrency
```

---

# 366. Resilience

ENG-039 gobernará:

```text
timeouts
retry
backoff
jitter
circuit breaker
bulkhead
load shedding
```

---

# 367. Error Namespace

ENG-040 utilizará:

```text
MEF-JOB-xxx
```

---

# 368. Taxonomía ENG-040

```text
MEF-JOB-001 Unknown job type
MEF-JOB-002 Missing job handler
MEF-JOB-003 Duplicate job type
MEF-JOB-004 Invalid job payload
MEF-JOB-005 Unsupported payload version
MEF-JOB-006 Invalid job state transition
MEF-JOB-007 Job claim failed
MEF-JOB-008 Job lease expired
MEF-JOB-009 Job lease renewal failed
MEF-JOB-010 Job timeout
MEF-JOB-011 Job deadline exceeded
MEF-JOB-012 Job retry exhausted
MEF-JOB-013 Job cancelled
MEF-JOB-014 Job deduplicated
MEF-JOB-015 Job dead-lettered
MEF-JOB-016 Poison job detected
MEF-JOB-017 Queue unavailable
MEF-JOB-018 Queue saturated
MEF-JOB-019 Scheduler unavailable
MEF-JOB-020 Invalid schedule
MEF-JOB-021 Schedule misfire
MEF-JOB-022 Schedule overlap rejected
MEF-JOB-023 Worker unavailable
MEF-JOB-024 Worker ownership lost
MEF-JOB-025 Job replay rejected
MEF-JOB-026 Job recovery failed
MEF-JOB-027 Job compatibility failure
MEF-JOB-028 Job security violation
MEF-JOB-029 Job contract violation
MEF-JOB-030 Job invariant violation
```

---

# 369. Unknown Job

```text
MEF-JOB-001

Unknown job type.

Job Type:
invoice.generate.v1
```

---

# 370. Unsupported Payload

```text
MEF-JOB-005

Unsupported job payload version.

Job Type:
customer.sync

Payload Version:
1
```

---

# 371. Lease Expired

```text
MEF-JOB-008

Job lease expired.

Job:
01J...
```

---

# 372. Retry Exhausted

```text
MEF-JOB-012

Job retry attempts exhausted.

Job:
01J...

Attempts:
5
```

---

# 373. Dead Letter

```text
MEF-JOB-015

Job moved to dead letter.

Job:
01J...

Failure:
MEF-RES-001
```

---

# 374. Misfire

```text
MEF-JOB-021

Scheduled execution missed.

Schedule:
daily-report

Scheduled At:
2026-08-10T02:00:00Z
```

---

# 375. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Job
JobId
JobType
JobDefinition
JobContext
JobHandler
JobResult

JobStore
JobQueue

JobState
JobAttempt
JobFailure

Scheduler
Schedule
ScheduleId
CronExpression
MisfirePolicy
OverlapPolicy

Worker
WorkerId

JobLease
JobRetryPolicy
JobCancellation

DeadLetter
DeadLetterStore

JobError
```

---

# 376. Optional Initial Components

Podrán incorporarse:

```text
JobDeduplicator
JobHeartbeat
JobProgress
JobCheckpoint
JobPriority
```

---

# 377. Later Components

Solo cuando exista necesidad:

```text
Workflow Engine
DAG Scheduler
Distributed Rate Limiter
Leader Election
Advanced Calendar Scheduler
Cross-Region Scheduler
```

---

# 378. Job Contract

Conceptualmente:

```text
Job
├── id
├── type
├── payload
├── payloadVersion
├── state
├── createdAt
├── scheduledAt
├── attempt
└── metadata
```

---

# 379. Job Result

Conceptualmente:

```text
JobResult
├── status
├── outputReference
└── metadata
```

No deberá persistir arbitrariamente grandes Results dentro del Job Record.

---

# 380. Scheduler Contract

Conceptualmente:

```text
Scheduler
├── schedule(job, instant)
├── recurring(definition)
├── cancel(scheduleId)
└── nextRun(scheduleId)
```

---

# 381. Worker Contract

Conceptualmente:

```text
Worker
├── start()
├── drain()
└── stop()
```

---

# 382. Job Store Contract

Conceptualmente:

```text
JobStore
├── create()
├── find()
├── claim()
├── transition()
├── renewLease()
├── complete()
├── fail()
└── cancel()
```

---

# 383. Dead Letter Contract

Conceptualmente:

```text
DeadLetterStore
├── add()
├── find()
├── list()
├── replay()
└── discard()
```

---

# 384. Conceptual Directory Structure

```text
src/
└── Jobs/
    ├── Contract/
    │   ├── JobHandler
    │   ├── JobStore
    │   ├── JobQueue
    │   ├── Scheduler
    │   └── DeadLetterStore
    │
    ├── Job/
    │   ├── Job
    │   ├── JobId
    │   ├── JobType
    │   ├── JobContext
    │   ├── JobResult
    │   └── JobState
    │
    ├── Schedule/
    │   ├── Schedule
    │   ├── ScheduleId
    │   ├── CronExpression
    │   ├── MisfirePolicy
    │   └── OverlapPolicy
    │
    ├── Worker/
    │   ├── Worker
    │   ├── WorkerId
    │   └── JobLease
    │
    ├── Retry/
    │   └── JobRetryPolicy
    │
    ├── Cancellation/
    │   └── JobCancellation
    │
    ├── DeadLetter/
    │   └── DeadLetter
    │
    ├── Recovery/
    │   └── JobRecovery
    │
    └── Error/
        └── JobError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 385. First Implementation Constraints

La primera versión deberá favorecer:

```text
Durable Jobs
Stable Job Types
Small Versioned Payloads
Explicit Job State Machine
Atomic Claims
Bounded Workers
Job Timeout
Job Deadline
Bounded Retry
Backoff + Jitter
Lease-Based Recovery
At-Least-Once Delivery
Idempotent Effects
Dead Letter
Cron Scheduling
Misfire Policy
Overlap Policy
Graceful Worker Drain
Observability
Compatibility Tests
```

---

# 386. First Version Non-Goals

No deberá requerir:

```text
Workflow Engine
DAG Orchestration
Exactly-Once Distributed Execution
Custom Distributed Consensus
Leader Election Framework
Cross-Region Scheduler
Predictive Scheduling
Machine-Learned Prioritization
Unlimited Fan-Out
```

---

# 387. Second Phase

Podrá incorporar:

```text
Deduplication
Priorities
Checkpointing
Progress Tracking
Advanced Replay
Rate Limiting
Multiple Queue Classes
```

---

# 388. Third Phase

Solo cuando exista necesidad demostrada:

```text
Workflow Engine
DAG Scheduling
Job Dependencies
Distributed Rate Limiting
Cross-Region Scheduling
Advanced Calendar Rules
```

---

# 389. Invariantes de Ingeniería

ENG-040 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-746 | Todo trabajo Background durable deberá poseer Job Identity, Job Type, Lifecycle y Failure semantics explícitos. |
| EI-747 | Background Work no deberá implementarse como Fire-and-Forget cuando perder la operación sea semánticamente inaceptable. |
| EI-748 | Job Types y Payloads persistidos deberán permanecer compatibles durante el periodo en que Jobs antiguos puedan sobrevivir a Deployments. |
| EI-749 | Toda Schedule calendar-based deberá definir Time Zone y comportamiento ante Ambiguities temporales relevantes. |
| EI-750 | Recurring Jobs deberán poseer Misfire y Overlap Policy explícitas cuando puedan ocurrir ejecuciones perdidas o superpuestas. |
| EI-751 | Todo Job durable deberá ser reclamado mediante transición atómica o mecanismo equivalente que impida Ownership simultáneo incorrecto. |
| EI-752 | Workers deberán poseer Concurrency acotada y no deberán generar Fan-Out o Queues locales ilimitadas. |
| EI-753 | Jobs ejecutados mediante Lease deberán considerar Ownership perdido después de Expiration y no deberán aceptar Writes de Workers obsoletos cuando ello viole Correctness. |
| EI-754 | MEF no deberá prometer Exactly-Once Execution de forma general; Delivery y Effect semantics deberán declararse explícitamente. |
| EI-755 | Jobs con At-Least-Once Delivery deberán analizar Idempotency para evitar multiplicación de Side Effects. |
| EI-756 | Todo Job deberá transitar únicamente mediante State Transitions válidas y atómicas. |
| EI-757 | Retry de Jobs deberá ser acotado, persistible para Jobs durables y no deberá ocupar Workers durante esperas largas de Backoff. |
| EI-758 | Deduplication no deberá utilizarse como sustituto de Idempotency cuando Redelivery siga siendo posible. |
| EI-759 | Poison Jobs no deberán bloquear indefinidamente el procesamiento de otros Jobs. |
| EI-760 | Dead Letters deberán ser observables, diagnosticables y poseer Retention y Replay semantics explícitos. |
| EI-761 | Cancellation de Jobs deberá ser atómica respecto de Completion y no deberá asumirse como Rollback de Side Effects previos. |
| EI-762 | Workers o Schedulers que fallen deberán permitir Recovery de Jobs durables sin asumir que el Attempt anterior no produjo efectos. |
| EI-763 | Job Payload, Job History y DLQ deberán respetar Security, Tenant Isolation y Data Minimization. |
| EI-764 | Job Processing deberá ser observable mediante Queue Depth, Job Age, Schedule Drift, Execution Duration, Attempts, Failures, DLQ y Worker Saturation. |
| EI-765 | La primera implementación deberá favorecer Durable State, Atomic Claims, Leases, Idempotency y Bounded Workers antes de introducir Workflow Engines o coordinación distribuida avanzada. |

---

# 390. Continuidad de Invariantes

```text
ENG-036 → EI-666 a EI-685
ENG-037 → EI-686 a EI-705
ENG-038 → EI-706 a EI-725
ENG-039 → EI-726 a EI-745
ENG-040 → EI-746 a EI-765
```

---

# 391. Criterios de Conformidad

Una implementación será conforme con ENG-040 cuando:

- diferencie Job Definition de Job Instance;
- utilice Job Type estable;
- versione Payload cuando corresponda;
- modele Job Context;
- diferencie Scheduler, Queue y Worker;
- soporte Delayed Jobs;
- soporte Recurring Jobs;
- documente Cron dialect;
- gestione Time Zone;
- modele Misfires;
- modele Overlaps;
- utilice Atomic Claim;
- soporte Job Lease cuando corresponda;
- limite Worker Concurrency;
- declare Delivery semantics;
- no prometa Exactly-Once general;
- modele State Machine;
- soporte Timeout y Deadline;
- limite Retry;
- utilice Backoff sin bloquear Worker;
- analice Idempotency;
- diferencie Deduplication;
- gestione Poison Jobs;
- soporte Dead Letter;
- gestione Cancellation;
- permita Recovery;
- preserve Tenant Isolation;
- integre Observability;
- soporte Graceful Drain;
- mantenga Compatibility entre Deployments;
- no acople Domain a Queue/Scheduler Vendors.

---

# 392. Riesgos

Deberán evitarse especialmente:

## Fire-and-Forget

Trabajo importante desaparece al morir el proceso.

## Exactly-Once Myth

Se promete ejecución única distribuida sin garantías suficientes.

## Job as Serialized Object Graph

Payload queda acoplado a clases internas.

## Unversioned Payload

Deployment nuevo no puede procesar Jobs antiguos.

## Unbounded Worker Pool

La Queue vacía recursos dentro del Runtime.

## Long Transaction Job

Una Transaction permanece abierta durante minutos u horas.

## ACK Before Effect

Se pierde trabajo.

## ACK After Effect Without Idempotency

Se duplican efectos.

## Infinite Retry

Poison Job consume recursos indefinidamente.

## Sleep Retry

Worker queda ocupado esperando Backoff.

## Silent DLQ

Jobs fallidos se acumulan sin Alerting.

## Blind Replay

Se repiten Side Effects críticos.

## No Misfire Policy

Scheduler recuperado no sabe qué hacer con ejecuciones perdidas.

## No Overlap Policy

Recurring Jobs se superponen accidentalmente.

## Scheduler Leader by Accident

Se asume una sola Instance sin garantía.

## Local Time Without Zone

Schedule cambia según Deployment Environment.

## Singleton Worker Context

Tenant/Principal de un Job contamina otro.

## Cache as Job Store

Trabajo durable depende de Cache evictable.

## Queue as Database

Se intenta almacenar todo Business State dentro del Broker.

## Job as Event

Se confunde intención futura con hecho ocurrido.

---

# 393. Relación con ENG-016

Compatibility gobernará Jobs persistidos entre Versions.

---

# 394. Relación con ENG-021

Contracts deberán separar abstracciones MEF de APIs específicas de Queue/Scheduler Providers.

---

# 395. Relación con ENG-022

La distinción será:

```text
Event
→ something happened

Job
→ something must be done
```

---

# 396. Relación con ENG-023

Error Handling gobernará Classification y Translation de Job Failures.

---

# 397. Relación con ENG-024

Security gobernará:

```text
producer authorization
worker identity
tenant isolation
payload protection
DLQ access
```

---

# 398. Relación con ENG-025

Observability gobernará:

```text
metrics
traces
logs
correlation
alerts
```

---

# 399. Relación con ENG-026

Performance gobernará:

```text
worker concurrency
batch size
poll interval
queue throughput
job latency
```

---

# 400. Relación con ENG-027

Runtime gobernará:

```text
worker lifecycle
scheduler lifecycle
job scope
shutdown
drain
```

---

# 401. Relación con ENG-028

Modules podrán registrar Job Definitions, Handlers y Schedules.

---

# 402. Relación con ENG-030

Persistence gobernará Durable Job State, Transactions y Atomic State Transitions.

---

# 403. Relación con ENG-031

Serialization gobernará Payload Compatibility.

---

# 404. Relación con ENG-032

Transport gobernará Adapters para Queue/Broker Protocols.

---

# 405. Relación con ENG-034

Application decidirá qué Use Cases se ejecutan de forma diferida.

---

# 406. Relación con ENG-035

Domain no conocerá Scheduler, Queue ni Worker.

---

# 407. Relación con ENG-036

Validation gobernará Payload, Schedule, Configuration y Transition validation.

---

# 408. Relación con ENG-037

Cache no deberá utilizarse como única fuente durable para Jobs críticos.

---

# 409. Relación con ENG-038

Concurrency gobernará:

```text
atomic claim
lease
fencing
deduplication race
worker concurrency
```

---

# 410. Relación con ENG-039

Resilience gobernará:

```text
timeout
retry
backoff
jitter
circuit breaker
bulkhead
load shedding
```

---

# 411. Relación con ENG-041

ENG-041 deberá formalizar **Messaging Engineering**.

La separación será:

```text
Scheduling & Jobs
→ execute deferred/background work

Messaging
→ exchange messages between components/processes
```

ENG-041 deberá cubrir:

```text
Message
Envelope
Producer
Consumer
Broker
Topic
Queue Semantics
Routing
Partitioning
Ordering
Delivery Semantics
Acknowledgement
Redelivery
Deduplication
Idempotency
Dead Letter
Schema Evolution
Correlation
Causation
Message Security
Message Observability
Message Testing
```

---

# 412. Principio Rector

> **MEF deberá tratar todo Background Job como una unidad durable y observable de trabajo con identidad, Lifecycle, Ownership y Failure semantics explícitos, asumiendo Redelivery y diseñando sus efectos para ser seguros ante Retry, Crash y Recovery.**

---

# 413. Conclusión

**ENG-040 — Scheduling & Background Jobs Engineering** formaliza el subsistema de ejecución diferida de MEF.

La arquitectura queda:

```text
                       PRODUCER
                          │
                          ▼
                    JOB DEFINITION
                          │
                          ▼
                 ┌─────────────────┐
                 │    SCHEDULER    │
                 └────────┬────────┘
                          │ due
                          ▼
                 ┌─────────────────┐
                 │      QUEUE      │
                 └────────┬────────┘
                          │
                          ▼
                    ATOMIC CLAIM
                          │
                          ▼
                       LEASE
                          │
                          ▼
                       WORKER
                          │
                          ▼
                      HANDLER
                          │
             ┌────────────┼────────────┐
             │            │            │
             ▼            ▼            ▼
          SUCCESS       FAILURE      CANCEL
             │            │
             │       ┌────┴────┐
             │       │         │
             │     RETRY      DLQ
             │       │
             │       ▼
             │   RETRY_WAIT
             │       │
             │       └──────► READY
             │
             ▼
         SUCCEEDED
```

La separación conceptual queda:

```text
Job
→ unit of deferred work

Scheduler
→ decides when work becomes eligible

Queue
→ stores/delivers eligible work

Worker
→ executes work

Handler
→ implements job behavior

Claim
→ obtains execution ownership

Lease
→ temporary ownership

Heartbeat
→ renews/demonstrates ownership

Retry
→ reattempts eligible failure

Idempotency
→ prevents duplicated logical effect

Deduplication
→ avoids duplicate logical work creation

Misfire
→ scheduled execution was missed

Overlap
→ executions of same recurring schedule intersect

Poison Job
→ repeatedly failing job

Dead Letter
→ isolated failed work for diagnosis/recovery

Replay
→ intentional reprocessing

Drain
→ controlled worker shutdown
```

La primera implementación deberá concentrarse en:

```text
Job
JobId
JobType
JobDefinition
JobContext
JobHandler
JobResult

JobStore
JobQueue

JobState
JobAttempt

Scheduler
Schedule
CronExpression
MisfirePolicy
OverlapPolicy

Worker
WorkerId
JobLease

JobRetryPolicy
JobCancellation

DeadLetter
DeadLetterStore

JobError
```

con:

```text
Durable State
Atomic Claim
At-Least-Once Delivery
Idempotent Effect
Bounded Workers
Lease Recovery
Bounded Retry
Backoff + Jitter
Dead Letter
Cron Scheduling
Misfire Handling
Overlap Handling
Graceful Drain
Observability
Compatibility
```

antes de introducir:

```text
Workflow Engine
DAG Scheduler
Leader Election
Exactly-Once Distributed Execution
Cross-Region Scheduler
Predictive Scheduling
Advanced Orchestration
```

Con **ENG-040** la serie global alcanza:

```text
EI-765
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
- ENG-011 — Configuration Files
- ENG-012 — Build System
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
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering