---
id: ENG-038
titulo: Concurrency Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Concurrency Engineering
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
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-032
  - ENG-034
  - ENG-035
  - ENG-037
relacionados:
  - ENG-006
  - ENG-012
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-022
  - ENG-031
  - ENG-033
  - ENG-036
  - ENG-039
keywords:
  - concurrency
  - race-condition
  - atomicity
  - synchronization
  - critical-section
  - optimistic-concurrency
  - pessimistic-concurrency
  - compare-and-swap
  - lock
  - lease
  - fencing-token
  - deadlock
  - distributed-coordination
  - idempotency
  - mef
---

# ENG-038

# Concurrency Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Concurrency Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-038 establece las reglas para:

```text
Concurrency
Parallelism
Race Conditions
Atomicity
Critical Sections
Synchronization
Shared State
Immutable State
Optimistic Concurrency
Pessimistic Concurrency
Compare-and-Swap
Versioning
Locks
Mutexes
Semaphores
Read/Write Locks
Leases
Fencing Tokens
Lock Ordering
Deadlocks
Livelocks
Starvation
Contention
Distributed Coordination
Idempotency under Concurrency
Transaction Concurrency
Cache Concurrency
Event Concurrency
Concurrency Observability
Concurrency Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Toda operación concurrente que pueda afectar una Invariant deberá poseer una estrategia explícita de coordinación, detección de conflicto o diseño que elimine Shared Mutable State.**

La preferencia arquitectónica será:

```text
Avoid Shared Mutable State
          │
          ▼
Use Immutability / Isolation
          │
          ▼
Optimistic Concurrency
          │
          ▼
Atomic Primitive
          │
          ▼
Local Lock
          │
          ▼
Distributed Coordination
```

No significa que cada nivel sustituya siempre al anterior.

Significa:

> utilizar el mecanismo menos complejo capaz de preservar correctamente la Invariant requerida.

---

# 3. Concurrency

`Concurrency` describe múltiples operaciones cuyo progreso puede superponerse temporalmente.

---

# 4. Parallelism

`Parallelism` describe ejecución simultánea real.

```text
Concurrency
≠
Parallelism
```

Un sistema puede ser concurrente sin ejecutar operaciones físicamente al mismo tiempo.

---

# 5. Interleaving

El orden efectivo de operaciones concurrentes puede variar.

Ejemplo:

```text
A1
B1
A2
B2
```

o:

```text
B1
A1
B2
A2
```

La Correctness no deberá depender accidentalmente de un orden específico.

---

# 6. Shared State

El principal riesgo aparece cuando múltiples Actors acceden a:

```text
Shared Mutable State
```

---

# 7. Shared Mutable State

Puede existir en:

```text
memory
database
cache
filesystem
distributed store
external service
queue
registry
```

---

# 8. Prefer Isolation

Cuando sea posible deberá preferirse:

```text
request-local state
transaction-local state
immutable values
message ownership
partitioned state
```

sobre coordinación global.

---

# 9. Immutability

State inmutable reduce la necesidad de Synchronization.

---

# 10. Ownership

Un recurso con un único Writer lógico simplifica Concurrency.

---

# 11. Partitioning

State podrá dividirse por:

```text
aggregate
tenant
partition
resource
key
```

para reducir Contention.

---

# 12. Race Condition

Una `Race Condition` ocurre cuando el resultado depende de un Interleaving no controlado.

---

# 13. Race Example

```text
Balance = 100

Worker A reads 100
Worker B reads 100

Worker A writes 80
Worker B writes 70

Final = 70
```

Una actualización se perdió.

---

# 14. Lost Update

El ejemplo anterior constituye:

```text
Lost Update
```

---

# 15. Check-Then-Act Race

Patrón peligroso:

```text
if resource does not exist:
    create resource
```

Dos Workers pueden observar simultáneamente:

```text
does not exist
```

y crear duplicados.

---

# 16. Read-Modify-Write Race

También deberá tratarse explícitamente.

---

# 17. Time-of-Check to Time-of-Use

`TOCTOU` ocurre cuando una condición cambia entre:

```text
check
```

y:

```text
use
```

---

# 18. Validation ≠ Concurrency Guarantee

ENG-036 podrá comprobar:

```text
username currently available
```

pero ello no garantiza que continúe disponible al escribir.

---

# 19. Atomic Enforcement

Cuando una Invariant dependa de concurrencia deberá reforzarse mediante una operación capaz de preservarla atómicamente.

---

# 20. Atomicity

Una operación es atómica cuando otros Actors no observan un estado intermedio relevante.

---

# 21. Atomic Operation

Ejemplos conceptuales:

```text
compare-and-set
atomic increment
unique insert
conditional update
transactional write
```

---

# 22. Atomic ≠ Thread-Safe Everything

Que una operación individual sea atómica no hace automáticamente segura una secuencia compuesta.

---

# 23. Compound Operation

Ejemplo:

```text
read
increment
write
```

puede no ser atómico aunque `read` y `write` individuales lo sean.

---

# 24. Critical Section

Una `Critical Section` es una región que accede a Shared Mutable State y requiere coordinación.

---

# 25. Critical Section Size

Deberá mantenerse tan pequeña como sea razonable.

---

# 26. No Remote I/O Under Lock

Deberá evitarse mantener Locks durante:

```text
HTTP calls
external APIs
slow filesystem operations
unbounded computation
```

salvo justificación explícita.

---

# 27. Lock Duration

Deberá minimizarse.

---

# 28. Synchronization

`Synchronization` coordina acceso concurrente.

Podrá utilizar:

```text
mutex
semaphore
read/write lock
atomic primitive
channel
transaction
lease
distributed lock
```

---

# 29. Synchronization Ownership

Toda Primitive deberá tener Owner y Scope claros.

---

# 30. Lock

Un `Lock` proporciona exclusión o coordinación sobre un recurso.

---

# 31. Lock Scope

Deberá corresponder al recurso protegido.

Preferir:

```text
customer:123
```

sobre:

```text
all-customers
```

cuando la Invariant lo permita.

---

# 32. Coarse-Grained Lock

Reduce complejidad pero aumenta Contention.

---

# 33. Fine-Grained Lock

Reduce Contention pero aumenta complejidad.

---

# 34. Lock Identity

Deberá ser determinista.

---

# 35. Lock Namespace

Deberá evitar colisiones entre Modules y Resources.

---

# 36. Lock Key

Conceptualmente:

```text
namespace
:
resource
:
identifier
```

---

# 37. Lock Key Security

No deberá incluir Secrets innecesarios.

---

# 38. Lock Ownership

Solo el Owner deberá liberar el Lock.

---

# 39. Ownership Token

Podrá utilizarse:

```text
lockToken
```

para demostrar Ownership.

---

# 40. Lock Acquisition

Deberá tener:

```text
timeout
cancellation
failure semantics
```

---

# 41. Infinite Wait

No deberá utilizarse por defecto.

---

# 42. Lock Timeout

Deberá respetar el Deadline global.

---

# 43. Lock Release

Deberá realizarse incluso ante Failure.

---

# 44. Structured Locking

Deberá favorecerse:

```text
acquire
try
    critical section
finally
    release
```

o equivalente seguro del lenguaje.

---

# 45. Lock Leak

Un Lock no liberado puede bloquear progreso indefinidamente.

---

# 46. Mutex

Un `Mutex` protege exclusión mutua.

---

# 47. Semaphore

Un `Semaphore` limita el número de operaciones concurrentes.

---

# 48. Semaphore Use

Puede proteger:

```text
connection pools
expensive workers
external service concurrency
bounded processing
```

---

# 49. Semaphore ≠ Rate Limiter

Concurrency Limit y Rate Limit son conceptos diferentes.

---

# 50. Read/Write Lock

Podrá permitir:

```text
multiple readers
single writer
```

---

# 51. Read/Write Lock Risk

No deberá introducirse sin demostrar beneficio frente a un Mutex simple.

---

# 52. Reentrant Lock

Deberá utilizarse únicamente cuando el modelo lo requiera.

---

# 53. Reentrancy

Puede ocultar diseño recursivo o Ownership ambiguo.

---

# 54. Lock Ordering

Cuando una operación requiera múltiples Locks deberá existir un orden estable.

Ejemplo:

```text
Account A
before
Account B
```

según Key canónica.

---

# 55. Canonical Ordering

Podrá utilizar:

```text
sort(lockKeys)
```

antes de adquirir Locks.

---

# 56. Deadlock

Un `Deadlock` ocurre cuando Actors esperan circularmente recursos retenidos por otros.

---

# 57. Deadlock Example

```text
Worker A
holds Lock 1
waits Lock 2

Worker B
holds Lock 2
waits Lock 1
```

---

# 58. Deadlock Prevention

Deberá favorecer:

```text
consistent lock ordering
small critical sections
timeouts
fewer simultaneous locks
```

---

# 59. Deadlock Detection

Persistence/Runtime podrán detectar Deadlocks.

---

# 60. Deadlock Recovery

Normalmente podrá requerir:

```text
abort
rollback
retry
```

según ENG-023/ENG-030.

---

# 61. Retry Safety

No deberá reintentarse automáticamente una operación si puede duplicar Side Effects.

---

# 62. Livelock

Actors continúan ejecutándose pero ninguno progresa.

---

# 63. Starvation

Un Actor puede esperar indefinidamente mientras otros continúan progresando.

---

# 64. Fairness

Algunas Primitives podrán ofrecer Fairness.

No será requisito universal.

---

# 65. Contention

`Contention` ocurre cuando múltiples Actors compiten por el mismo recurso.

---

# 66. Contention Metrics

Podrán medirse:

```text
wait duration
lock attempts
lock timeout
conflicts
retry count
```

---

# 67. Hot Resource

Un recurso con alta Contention deberá analizarse arquitectónicamente antes de simplemente aumentar Locks.

---

# 68. Optimistic Concurrency

Asume que los conflictos son relativamente infrecuentes.

---

# 69. Optimistic Pattern

```text
Read version 7
      │
      ▼
Modify
      │
      ▼
UPDATE ... WHERE version = 7
      │
   ┌──┴──┐
   ▼     ▼
success conflict
```

---

# 70. Version Field

Podrá utilizar:

```text
version
revision
etag
sequence
```

---

# 71. Version Increment

Una actualización exitosa deberá producir una nueva Version.

---

# 72. Conflict

Si la Version esperada ya no coincide:

```text
Concurrency Conflict
```

---

# 73. Conflict ≠ Infrastructure Failure

Un conflicto optimista esperado no deberá clasificarse automáticamente como Failure de infraestructura.

---

# 74. Conflict Handling

Podrá ser:

```text
return conflict
reload
merge
retry
abort
```

según Use Case.

---

# 75. Automatic Retry

Solo deberá realizarse cuando la operación sea segura de repetir.

---

# 76. User Intent

En algunos Workflows no deberá reintentarse silenciosamente porque podría sobrescribir decisiones recientes de otro Actor.

---

# 77. Merge

Podrá existir cuando los cambios sean semánticamente compatibles.

---

# 78. Merge Ownership

La lógica de Merge deberá pertenecer a la Boundary con conocimiento suficiente.

---

# 79. Pessimistic Concurrency

Adquiere coordinación antes de modificar State.

---

# 80. Pessimistic Pattern

```text
Acquire Lock
     │
     ▼
Read State
     │
     ▼
Modify
     │
     ▼
Persist
     │
     ▼
Release Lock
```

---

# 81. Pessimistic Use

Puede ser apropiado cuando:

```text
conflicts are frequent
operation is expensive to repeat
invariant requires exclusive access
```

---

# 82. Pessimistic Cost

Introduce:

```text
blocking
contention
deadlock risk
reduced throughput
```

---

# 83. Optimistic vs Pessimistic

La decisión deberá basarse en:

```text
conflict frequency
criticality
latency
retry cost
contention
storage capabilities
```

---

# 84. Compare-and-Swap

`CAS` actualiza un Value únicamente si conserva el valor/version esperado.

---

# 85. CAS Pattern

```text
CAS(expected, new)
```

---

# 86. CAS Failure

Significa que otro Actor modificó State.

---

# 87. CAS Loop

Podrá utilizar:

```text
read
compute
CAS
retry if safe
```

con límites.

---

# 88. Unbounded CAS Retry

No deberá permitirse.

---

# 89. ABA Problem

Un Value puede cambiar:

```text
A → B → A
```

haciendo que una comparación simple no detecte modificación intermedia.

---

# 90. ABA Mitigation

Podrá utilizar Version/Sequence además del Value.

---

# 91. Versioned State

Preferir:

```text
(value, version)
```

cuando sea relevante.

---

# 92. Database Concurrency

ENG-030 continuará gobernando Persistence.

---

# 93. Transaction Isolation

Podrá utilizar:

```text
Read Committed
Repeatable Read
Serializable
```

según tecnología.

---

# 94. Isolation Level

No deberá elegirse por nombre únicamente.

Deberán conocerse las garantías reales del Store.

---

# 95. Dirty Read

No deberá permitirse cuando viole Contract.

---

# 96. Non-Repeatable Read

Deberá considerarse.

---

# 97. Phantom Read

También.

---

# 98. Write Skew

También.

---

# 99. Serializable

Puede simplificar Correctness pero aumentar:

```text
conflicts
aborts
latency
```

---

# 100. Database Constraint

Podrá reforzar Invariants concurrentes.

---

# 101. Unique Constraint

Es una defensa apropiada contra creación concurrente duplicada.

---

# 102. Check Then Insert

No deberá reemplazar una Unique Constraint cuando la unicidad requiera garantía atómica.

---

# 103. Conditional Update

Deberá favorecerse para Optimistic Concurrency.

---

# 104. Transaction Boundary

Deberá ser explícita.

---

# 105. Transaction Scope

No deberá extenderse innecesariamente sobre Calls externas.

---

# 106. External Side Effect in Transaction

Deberá evitarse:

```text
BEGIN
write DB
call external API
COMMIT
```

cuando pueda generar inconsistencia difícil de recuperar.

---

# 107. Outbox

ENG-030/ENG-022 podrán utilizar Transactional Outbox.

---

# 108. Outbox Concurrency

Workers concurrentes deberán evitar procesar el mismo Record incorrectamente.

---

# 109. Claim Pattern

Podrá utilizar:

```text
claim
process
complete
```

con semántica explícita.

---

# 110. Duplicate Delivery

Deberá asumirse posible en sistemas distribuidos.

---

# 111. Idempotency

`Idempotency` permite repetir una operación sin multiplicar su efecto observable.

---

# 112. Idempotency ≠ Concurrency Control

Son conceptos relacionados pero distintos.

---

# 113. Concurrent Duplicate Requests

Dos Requests con la misma Idempotency Key pueden llegar simultáneamente.

---

# 114. Atomic Idempotency Claim

El Store deberá permitir decidir atómicamente qué Actor procesa la operación.

---

# 115. Idempotency State

Conceptualmente:

```text
NEW
PROCESSING
COMPLETED
FAILED
```

---

# 116. Idempotency Result

Una Request duplicada podrá:

```text
wait
return stored result
return conflict
```

según Contract.

---

# 117. Idempotency Store

No deberá tratarse como Cache ordinario si perderlo rompe la garantía.

---

# 118. Idempotency Key Scope

Deberá incluir Scope suficiente:

```text
tenant
operation
principal when required
key
```

---

# 119. Idempotency Expiration

Solo deberá eliminarse cuando el Contract permita perder la deduplicación histórica.

---

# 120. Event Concurrency

ENG-022 deberá considerar Handlers concurrentes.

---

# 121. Event Ordering

No deberá asumirse Global Ordering salvo garantía explícita.

---

# 122. Partition Ordering

Podrá garantizarse por:

```text
aggregateId
streamId
partitionKey
```

---

# 123. Same Aggregate Events

Cuando el orden importe deberán procesarse respetando Sequence.

---

# 124. Event Sequence

Podrá incluir:

```text
aggregateVersion
sequenceNumber
```

---

# 125. Duplicate Event

Handler deberá ser Idempotent cuando Delivery pueda duplicarse.

---

# 126. Out-of-Order Event

Deberá existir Policy:

```text
buffer
reject
retry
rebuild
ignore if obsolete
```

---

# 127. Parallel Event Handling

Podrá aumentar Throughput cuando Events sean independientes.

---

# 128. Handler Shared State

No deberá compartirse State mutable inseguro.

---

# 129. Message Claim

Queue Consumer podrá requerir Atomic Claim/Visibility Timeout.

---

# 130. Visibility Timeout

Deberá exceder razonablemente Processing Time o renovarse.

---

# 131. Lease

Un `Lease` concede Ownership temporal.

---

# 132. Lease Difference

A diferencia de un Lock local, un Lease puede expirar.

---

# 133. Lease Fields

Conceptualmente:

```text
resource
owner
token
acquiredAt
expiresAt
```

---

# 134. Lease Expiration

Un Worker no deberá asumir que conserva Ownership después de Expiration.

---

# 135. Lease Renewal

Podrá renovarse antes de Expiration.

---

# 136. Renewal Failure

Deberá considerarse pérdida de Ownership cuando no pueda demostrarse lo contrario.

---

# 137. Long Operation

Deberá verificar que el Lease siga siendo válido antes de Side Effects críticos.

---

# 138. Distributed Lock

Un Lock distribuido deberá modelarse preferentemente como Lease.

---

# 139. Network Partition

Puede impedir saber si el Lock continúa siendo válido.

---

# 140. Process Pause

GC pause, VM suspension o scheduling pueden provocar que un Worker continúe después de expirar su Lease.

---

# 141. Stale Owner

Un antiguo Owner puede despertar y seguir ejecutando.

---

# 142. Fencing Token

Un `Fencing Token` es un número monotónico asignado a cada nuevo Ownership.

Ejemplo:

```text
Worker A → token 41
Worker B → token 42
```

---

# 143. Fencing Rule

El recurso protegido deberá rechazar operaciones con Token inferior al último aceptado.

---

# 144. Fencing Example

```text
Worker A token 41
lease expires

Worker B token 42
writes successfully

Worker A resumes
tries token 41

Resource rejects token 41
```

---

# 145. Distributed Lock Without Fencing

No deberá asumirse suficiente para proteger Side Effects externos cuando un Owner antiguo pueda continuar operando.

---

# 146. Fencing Capability

Requiere cooperación del recurso protegido.

---

# 147. Monotonic Token

El Token deberá aumentar monotónicamente.

---

# 148. Clock ≠ Fencing Token

Timestamp de reloj de pared no deberá utilizarse automáticamente como Fencing Token.

---

# 149. Clock

Concurrency temporal deberá distinguir:

```text
wall clock
monotonic clock
logical sequence
```

---

# 150. Wall Clock

Puede cambiar por:

```text
NTP
manual adjustment
virtualization
clock skew
```

---

# 151. Monotonic Clock

Deberá favorecerse para medir:

```text
timeouts
durations
deadlines
```

---

# 152. Distributed Clock

No deberá asumirse sincronización perfecta entre Nodes.

---

# 153. Timestamp Ordering

No garantiza causalidad universal.

---

# 154. Logical Clock

Podrá utilizarse cuando sea necesario modelar Ordering/Causality.

---

# 155. Sequence

Una Sequence autoritativa puede ser preferible para ordenar cambios de un recurso.

---

# 156. Distributed Coordination

Deberá evitarse cuando Partitioning, Ownership o Optimistic Concurrency puedan resolver el problema.

---

# 157. Coordination Cost

Introduce:

```text
network latency
availability dependency
partial failure
split-brain risk
operational complexity
```

---

# 158. Coordination Service

Podrá utilizarse únicamente mediante Contract.

---

# 159. Vendor Isolation

Domain/Application no deberán depender directamente de APIs específicas del proveedor de coordinación.

---

# 160. Consensus

MEF no implementará un Consensus Algorithm propio como parte de la primera versión.

---

# 161. Leader Election

Tampoco será una Primitive inicial obligatoria.

---

# 162. Single Leader

Podrá simplificar determinados Workflows, pero introduce Failure/Failover concerns.

---

# 163. Split Brain

Dos Actors pueden creer simultáneamente que poseen Leadership.

---

# 164. Leader Fencing

Operations críticas deberán protegerse contra antiguos Leaders.

---

# 165. Distributed Semaphore

Podrá utilizarse cuando sea necesario limitar concurrencia global.

---

# 166. Distributed Barrier

No será parte obligatoria de la primera versión.

---

# 167. Cache Concurrency

ENG-037 seguirá gobernando Cache semantics.

---

# 168. Cache Stampede

ENG-038 proporciona Primitives para:

```text
single-flight
locks
leases
atomic operations
```

---

# 169. Cache Lock

No deberá convertir Cache en Source of Truth.

---

# 170. Cache Write Race

Deberá evitar que Value antiguo sobrescriba Value nuevo cuando Versioning lo permita.

---

# 171. Single-Flight

Dentro de un Runtime podrá coordinar computaciones iguales.

---

# 172. Single-Flight Scope

Deberá ser explícito:

```text
process
node
cluster
```

---

# 173. Single-Flight Failure

Todos los Waiters deberán recibir resultado/failure coherente.

---

# 174. Single-Flight Cleanup

La Entry de coordinación deberá eliminarse tras finalizar.

---

# 175. Application Concurrency

ENG-034 deberá definir Concurrency Policy del Use Case cuando sea relevante.

---

# 176. Command Concurrency

Commands que modifican el mismo Aggregate podrán requerir Version.

---

# 177. Query Concurrency

Queries deberán declarar cuando requieren Snapshot consistente.

---

# 178. Domain Concurrency

ENG-035 conserva autoridad sobre Invariants.

---

# 179. Aggregate Boundary

Deberá utilizarse como unidad natural de consistencia cuando el modelo lo permita.

---

# 180. Aggregate Version

Podrá servir para Optimistic Concurrency.

---

# 181. Domain ≠ Lock Manager

Domain no deberá importar:

```text
RedisLock
DatabaseMutex
DistributedLeaseClient
```

---

# 182. Domain Conflict

Podrá recibir una abstracción semántica de conflicto sin conocer mecanismo físico.

---

# 183. Registry Concurrency

ENG-020 deberá definir si Registry es:

```text
immutable after bootstrap
copy-on-write
synchronized mutable
```

---

# 184. Prefer Immutable Registry

Después de Bootstrap deberá favorecerse Registry inmutable.

---

# 185. Container Concurrency

ENG-019 deberá definir Thread Safety de:

```text
singleton creation
scoped instances
lazy services
```

---

# 186. Singleton Construction

Deberá evitar creación duplicada concurrente cuando la semántica requiera instancia única.

---

# 187. Double-Checked Locking

No deberá implementarse manualmente sin garantías correctas del Memory Model del lenguaje.

---

# 188. Lazy Initialization

Deberá utilizar Primitives seguras del Runtime.

---

# 189. Runtime Concurrency

ENG-027 gobernará Worker Lifecycle.

---

# 190. Shutdown Concurrency

Durante Shutdown deberá impedirse iniciar trabajo incompatible con Drain.

---

# 191. Drain

Runtime deberá poder esperar operaciones In-Flight hasta Deadline.

---

# 192. Forced Shutdown

Después del Deadline podrá abortar según Policy.

---

# 193. Cancellation

Operaciones bloqueadas deberán observar Cancellation cuando la Primitive lo permita.

---

# 194. Cancellation ≠ Rollback

Cancelar ejecución no revierte automáticamente Side Effects ya realizados.

---

# 195. Structured Concurrency

Cuando Runtime/Lenguaje lo soporte deberá favorecerse asociación explícita entre Tasks y su Lifecycle.

---

# 196. Detached Task

No deberá crearse arbitrariamente sin Owner.

---

# 197. Task Ownership

Toda Task concurrente deberá poseer:

```text
owner
lifecycle
cancellation
error handling
```

---

# 198. Background Task

Deberá integrarse con Runtime Lifecycle.

---

# 199. Orphan Task

Deberá evitarse.

---

# 200. Bounded Concurrency

Toda ejecución paralela sobre Inputs potencialmente grandes deberá tener límite.

---

# 201. Unbounded Fan-Out

No deberá permitirse:

```text
for each item:
    start task
```

sin límite sobre colecciones grandes.

---

# 202. Worker Pool

Podrá utilizarse.

---

# 203. Pool Size

Deberá configurarse/medirse.

---

# 204. Backpressure

Cuando Producers superen Consumers deberá aplicarse Backpressure o límites.

---

# 205. Queue Bound

Queues internas deberán ser acotadas cuando sea posible.

---

# 206. Memory Exhaustion

Concurrency no controlada puede convertirse en Resource Exhaustion.

---

# 207. Concurrency Budget

ENG-026 podrá definir Budgets.

---

# 208. External Dependency Concurrency

Deberá limitarse según capacidad del Dependency.

---

# 209. Connection Pool

No deberá confundirse con Worker Concurrency.

---

# 210. Pool Saturation

Deberá ser observable.

---

# 211. Thread Safety

Todo componente compartido deberá declarar su modelo.

Podrá ser:

```text
immutable
thread-safe
not-thread-safe
request-scoped
externally synchronized
```

---

# 212. Thread Safety Documentation

Deberá formar parte del Contract cuando sea relevante.

---

# 213. Async Safety

En Runtimes async deberán considerarse también:

```text
task interleaving
shared state
cancellation
context propagation
```

---

# 214. Thread-Local

No deberá asumirse equivalente a Request Context en Runtime async.

---

# 215. Context Propagation

ENG-025/ENG-027 deberán preservar Context apropiado entre Tasks.

---

# 216. Security Context

No deberá filtrarse entre Requests concurrentes.

---

# 217. Tenant Context

Tampoco.

---

# 218. Request Context

Deberá poseer Scope correcto.

---

# 219. Shared Singleton State

No deberá almacenar Context específico de Request.

---

# 220. Concurrency Error Namespace

ENG-038 utilizará:

```text
MEF-CON-xxx
```

---

# 221. Taxonomía ENG-038

```text
MEF-CON-001 Concurrency conflict
MEF-CON-002 Lock acquisition failed
MEF-CON-003 Lock acquisition timeout
MEF-CON-004 Invalid lock ownership
MEF-CON-005 Lock release failed
MEF-CON-006 Deadlock detected
MEF-CON-007 Concurrency retry exhausted
MEF-CON-008 Version conflict
MEF-CON-009 Compare-and-swap failed
MEF-CON-010 Lease acquisition failed
MEF-CON-011 Lease expired
MEF-CON-012 Lease renewal failed
MEF-CON-013 Fencing token rejected
MEF-CON-014 Invalid concurrency configuration
MEF-CON-015 Concurrency limit exceeded
MEF-CON-016 Coordination service unavailable
MEF-CON-017 Idempotency conflict
MEF-CON-018 Task cancelled
MEF-CON-019 Concurrency contract violation
MEF-CON-020 Concurrency invariant violation
```

---

# 222. Version Conflict

```text
MEF-CON-008

Concurrency version conflict.

Resource:
Order:123

Expected:
17

Actual:
18
```

---

# 223. Lock Timeout

```text
MEF-CON-003

Lock acquisition timeout.

Resource:
customer:123
```

---

# 224. Lease Expired

```text
MEF-CON-011

Lease expired.

Resource:
job:456
```

---

# 225. Fencing Rejection

```text
MEF-CON-013

Fencing token rejected.

Presented:
41

Latest:
42
```

---

# 226. Error Handling

ENG-023 gobernará traducción y propagación.

---

# 227. Expected Conflict

Un Optimistic Conflict esperado podrá representarse como resultado de negocio/aplicación apropiado en lugar de Infrastructure Error.

---

# 228. Deadlock Failure

Podrá ser Retryable cuando la operación sea segura.

---

# 229. Lock Timeout Failure

No deberá traducirse automáticamente a Retry infinito.

---

# 230. Cancellation Failure

Deberá conservar semántica diferenciada.

---

# 231. Retry

Todo Retry concurrente deberá tener:

```text
maximum attempts
deadline
backoff
jitter
idempotency analysis
```

---

# 232. Immediate Retry

Puede empeorar Contention.

---

# 233. Backoff

Deberá favorecerse ante conflictos repetidos.

---

# 234. Jitter

Puede reducir sincronización entre Workers.

---

# 235. Retry Storm

Deberá evitarse.

---

# 236. Retry Budget

Podrá definirse.

---

# 237. Retry Scope

Deberá conocerse qué parte de la operación se repite.

---

# 238. Side Effect Boundary

No deberá reejecutarse un Side Effect no idempotente accidentalmente.

---

# 239. Observability

ENG-025 gobernará Telemetry.

---

# 240. Concurrency Metrics

Podrán incluir:

```text
mef.concurrency.conflicts.total
mef.concurrency.lock.wait.duration
mef.concurrency.lock.timeouts.total
mef.concurrency.deadlocks.total
mef.concurrency.retries.total
mef.concurrency.active
mef.concurrency.queue.depth
```

---

# 241. Lock Metrics

Podrán incluir:

```text
acquire attempts
acquire success
wait duration
hold duration
timeout
```

---

# 242. Cardinality

Resource IDs no deberán convertirse indiscriminadamente en Metric Labels.

---

# 243. Trace

Una espera significativa podrá generar Span/Event.

---

# 244. Lock Owner Logging

No deberá exponer información sensible.

---

# 245. Contention Alert

Podrá definirse sobre:

```text
wait duration
conflict rate
timeout rate
```

---

# 246. Deadlock Alert

Deadlocks frecuentes deberán tratarse como señal arquitectónica.

---

# 247. Performance

ENG-026 gobernará Performance.

---

# 248. Concurrency ≠ Throughput Automatically

Más Workers pueden reducir Throughput por Contention.

---

# 249. Concurrency Curve

Deberá medirse:

```text
workers
vs
throughput
vs
latency
vs
errors
```

---

# 250. Saturation Point

Deberá identificarse cuando sea relevante.

---

# 251. Benchmark

Podrán existir:

```text
BM-CON-LOCK
BM-CON-OPTIMISTIC
BM-CON-SINGLEFLIGHT
BM-CON-WORKER-POOL
```

---

# 252. Lock Hold Time

Deberá medirse en Hot Paths.

---

# 253. Conflict Rate

Ayudará a elegir Optimistic vs Pessimistic.

---

# 254. Testing

ENG-009 gobernará Testing.

---

# 255. Concurrency Test

Deberá intentar reproducir Interleavings relevantes.

---

# 256. Lost Update Test

Será obligatorio cuando se utilice Optimistic Concurrency.

---

# 257. Version Conflict Test

También.

---

# 258. Lock Ownership Test

Deberá comprobar que un Actor no libera Lock ajeno.

---

# 259. Lock Timeout Test

Deberá utilizar Clock/Deadline controlable cuando sea posible.

---

# 260. Deadlock Test

Podrá verificar prevención o Recovery.

---

# 261. Idempotency Concurrency Test

Dos Requests simultáneas con la misma Key deberán producir un solo efecto permitido.

---

# 262. Lease Expiration Test

Deberá comprobar Stale Owner.

---

# 263. Fencing Test

Deberá comprobar rechazo de Tokens antiguos.

---

# 264. Cache Stampede Test

ENG-037/038 deberán probar múltiples Misses simultáneos.

---

# 265. Event Ordering Test

Deberá comprobar Events fuera de orden cuando el sistema pueda recibirlos.

---

# 266. Duplicate Event Test

Deberá comprobar Idempotency.

---

# 267. Stress Test

Podrá ejecutar alta concurrencia.

---

# 268. Soak Test

Podrá detectar:

```text
lock leaks
resource leaks
starvation
queue growth
```

---

# 269. Randomized Scheduling

Podrá utilizarse para aumentar probabilidad de encontrar Races.

---

# 270. Deterministic Scheduler

Cuando el Runtime lo permita podrá utilizarse para Tests reproducibles.

---

# 271. Sleep-Based Concurrency Test

No deberá depender exclusivamente de:

```text
sleep(100)
```

para sincronización.

---

# 272. Barrier Test Primitive

Podrá coordinar Workers de Test.

---

# 273. Failure Injection

Podrá simular:

```text
lock service unavailable
lease expiration
network delay
transaction conflict
process pause
```

---

# 274. Property-Based Concurrency Testing

Podrá comprobar Invariants bajo secuencias aleatorias.

---

# 275. Model-Based Testing

Podrá utilizarse para componentes concurrentes críticos.

---

# 276. Race Detector

Cuando el lenguaje/runtime proporcione herramientas deberá favorecerse su uso.

---

# 277. Thread Sanitizer

Podrá integrarse cuando sea aplicable.

---

# 278. Build Integration

ENG-012 podrá ejecutar Concurrency Tests críticos.

---

# 279. Architecture Tests

Podrán verificar:

```text
Domain does not depend on lock vendor
Singletons do not contain request state
Concurrency primitives are bounded
```

---

# 280. Static Analysis

Deberá aprovecharse cuando detecte:

```text
unsafe shared state
missing synchronization
incorrect async usage
```

---

# 281. Concurrency Configuration

ENG-011 podrá definir:

```text
worker limits
lock timeout
lease duration
retry limit
queue capacity
```

---

# 282. Configuration Validation

ENG-036 deberá impedir valores peligrosos.

Ejemplos:

```text
negative timeout
zero lease
unbounded queue without explicit approval
```

---

# 283. Runtime Configuration

Cambios dinámicos deberán considerar operaciones In-Flight.

---

# 284. Concurrency Registry

ENG-020 podrá registrar:

```text
LockProvider
LeaseProvider
ConcurrencyLimiter
IdempotencyProvider
```

---

# 285. Registry Mutability

Deberá favorecerse inmutabilidad después de Bootstrap.

---

# 286. Dependency Injection

ENG-018 deberá inyectar Contracts.

---

# 287. Service Container

ENG-019 deberá respetar Thread Safety/Lifecycle.

---

# 288. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
ConcurrencyConflict
Version
ExpectedVersion
ConcurrencyLimiter
Lock
LockHandle
LockProvider
LockKey
RetryPolicy
ConcurrencyPolicy
```

---

# 289. Optional Initial Components

Podrán incorporarse:

```text
Semaphore
SingleFlight
Lease
LeaseProvider
IdempotencyGuard
```

---

# 290. Later Components

Solo cuando exista necesidad:

```text
FencingToken
DistributedSemaphore
LeaderElection
CoordinationService
```

---

# 291. Lock Contract

Conceptualmente:

```text
LockProvider
    acquire(LockKey, timeout)
        → LockHandle
```

---

# 292. Lock Handle

Conceptualmente:

```text
LockHandle
├── key
├── ownerToken
├── acquiredAt
└── release()
```

---

# 293. Version Contract

Conceptualmente:

```text
ExpectedVersion
CurrentVersion
```

---

# 294. Concurrency Policy

Conceptualmente:

```text
ConcurrencyPolicy
├── strategy
├── timeout
├── retry
├── backoff
├── maxConcurrency
└── metadata
```

---

# 295. Strategy

Podrá ser:

```text
NONE
OPTIMISTIC
PESSIMISTIC
ATOMIC
SERIALIZED
```

---

# 296. NONE

Solo deberá utilizarse cuando:

```text
state is immutable
operation is isolated
race is harmless
underlying primitive already guarantees correctness
```

---

# 297. Conceptual Directory Structure

```text
src/
└── Concurrency/
    ├── Contract/
    │   ├── LockProvider
    │   ├── ConcurrencyLimiter
    │   └── LeaseProvider
    │
    ├── Lock/
    │   ├── LockKey
    │   └── LockHandle
    │
    ├── Version/
    │   ├── Version
    │   └── ExpectedVersion
    │
    ├── Policy/
    │   ├── ConcurrencyPolicy
    │   └── RetryPolicy
    │
    ├── Optimistic/
    │   └── ConcurrencyConflict
    │
    ├── Coordination/
    │   ├── SingleFlight
    │   └── Semaphore
    │
    ├── Lease/
    │   └── Lease
    │
    ├── Idempotency/
    │   └── IdempotencyGuard
    │
    └── Error/
        └── ConcurrencyError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 298. First Implementation Constraints

La primera versión deberá favorecer:

```text
Immutable State
Explicit Ownership
Optimistic Concurrency
Version Fields
Atomic Database Constraints
Bounded Concurrency
Local Locks
Lock Timeouts
Safe Release
Retry Limits
Backoff
Idempotency Analysis
Concurrency Metrics
Concurrency Tests
```

---

# 299. First Version Non-Goals

No deberá requerir:

```text
Custom Consensus Algorithm
Global Distributed Lock Manager
Leader Election Framework
Distributed Barrier
Cross-Region Coordination
Custom Transaction Manager
Lock-Free Data Structure Library
Universal Actor Runtime
```

---

# 300. Second Phase

Podrá incorporar:

```text
SingleFlight
Leases
Distributed Lock Adapter
Fencing Tokens
Advanced Idempotency
Concurrency Testing Utilities
```

---

# 301. Third Phase

Solo cuando exista necesidad demostrada:

```text
Leader Election
Distributed Semaphore
Cross-Region Coordination
Advanced Logical Clocks
Specialized Lock-Free Structures
```

---

# 302. Invariantes de Ingeniería

ENG-038 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-706 | Toda operación concurrente capaz de afectar una Invariant deberá poseer una estrategia explícita de aislamiento, coordinación, atomicidad o detección de conflicto. |
| EI-707 | MEF deberá favorecer eliminación, aislamiento o inmutabilidad de Shared Mutable State antes de introducir Synchronization compleja. |
| EI-708 | Validation previa de State mutable no deberá considerarse garantía suficiente contra Race Conditions o TOCTOU. |
| EI-709 | Toda Critical Section deberá minimizar Scope y Duration y evitar I/O remoto no acotado mientras mantenga Locks. |
| EI-710 | Todo Lock deberá poseer identidad, Scope, Ownership, Timeout y Release semantics explícitos. |
| EI-711 | Solo el Owner válido deberá liberar un Lock o Lease. |
| EI-712 | La adquisición de múltiples Locks deberá seguir Ordering determinista cuando exista riesgo de Deadlock. |
| EI-713 | Optimistic Concurrency deberá detectar conflictos mediante Version, Sequence o mecanismo equivalente capaz de impedir Lost Updates. |
| EI-714 | Un Concurrency Conflict esperado no deberá clasificarse automáticamente como Infrastructure Failure. |
| EI-715 | Retries de operaciones concurrentes deberán ser acotados y analizar Idempotency y Side Effects antes de repetirse. |
| EI-716 | Concurrency Limits, Worker Pools y Queues deberán ser acotados cuando procesen carga potencialmente no limitada. |
| EI-717 | Transactions no deberán mantenerse abiertas durante Calls externas lentas salvo justificación arquitectónica explícita. |
| EI-718 | Idempotency bajo Requests concurrentes deberá utilizar Claim/Storage atómico cuando un efecto duplicado sea inaceptable. |
| EI-719 | Event Ordering no deberá asumirse globalmente; toda dependencia de orden deberá poseer Scope y Sequence explícitos. |
| EI-720 | Un Lease expirado deberá considerarse Ownership perdido y un antiguo Owner no deberá continuar Side Effects críticos sin nueva autorización. |
| EI-721 | Distributed Coordination deberá considerar Network Partitions, Process Pauses, Stale Owners y Failure Recovery. |
| EI-722 | Locks distribuidos utilizados para proteger Side Effects críticos deberán incorporar Fencing o garantía equivalente cuando el recurso protegido pueda aceptar operaciones de un Owner obsoleto. |
| EI-723 | Todo componente compartido deberá declarar Thread/Async Safety y no almacenar Request, Tenant o Principal Context en Singletons globales. |
| EI-724 | Concurrency deberá ser observable mediante Conflicts, Wait Time, Lock Duration, Retry, Queue Depth y Saturation cuando sean operacionalmente relevantes. |
| EI-725 | La primera implementación deberá favorecer Primitives simples, Versioning, Atomic Constraints y Bounded Concurrency antes de introducir coordinación distribuida avanzada. |

---

# 303. Continuidad de Invariantes

```text
ENG-034 → EI-626 a EI-645
ENG-035 → EI-646 a EI-665
ENG-036 → EI-666 a EI-685
ENG-037 → EI-686 a EI-705
ENG-038 → EI-706 a EI-725
```

---

# 304. Criterios de Conformidad

Una implementación será conforme con ENG-038 cuando:

- diferencie Concurrency y Parallelism;
- identifique Shared Mutable State;
- favorezca Isolation e Immutability;
- identifique Race Conditions;
- preserve Atomicity cuando corresponda;
- modele Critical Sections;
- limite duración de Locks;
- utilice Timeout;
- preserve Lock Ownership;
- evite Unlock de Locks ajenos;
- establezca Lock Ordering;
- gestione Deadlocks;
- soporte Optimistic Concurrency;
- modele Version Conflicts;
- soporte Atomic Constraints;
- limite Retries;
- analice Idempotency;
- preserve Transaction Boundaries;
- soporte Bounded Concurrency;
- limite Worker Pools y Queues;
- considere Event Ordering;
- considere Duplicate Delivery;
- modele Leases cuando corresponda;
- utilice Fencing para Stale Owners cuando sea necesario;
- integre Observability;
- disponga de Concurrency Tests;
- no acople Domain a tecnologías concretas de Locking.

---

# 305. Riesgos

Deberán evitarse especialmente:

## Lock Everything

Toda operación se serializa innecesariamente.

## No Lock Anywhere

Se asume que las Races no ocurrirán.

## Check Then Act

Se valida State y después se modifica sin garantía atómica.

## Lost Update

Dos Writers sobrescriben cambios.

## Infinite Lock Wait

Un Request queda bloqueado indefinidamente.

## Lock Leak

El Lock nunca se libera.

## Wrong Owner Unlock

Un Worker libera Lock perteneciente a otro.

## Global Lock

Un recurso pequeño bloquea todo el sistema.

## Remote Call Under Lock

Una dependencia lenta mantiene la Critical Section.

## Deadlock

Locks se adquieren en distinto orden.

## Retry Forever

Conflictos generan Loop infinito.

## Retry Non-Idempotent Side Effect

Se duplica una operación externa.

## Unbounded Fan-Out

Una colección grande crea Tasks ilimitadas.

## Unbounded Queue

La memoria se convierte en mecanismo de Backpressure.

## Stale Lease Owner

Un Worker continúa después de perder Ownership.

## Distributed Lock Without Fencing

Un antiguo Owner puede sobrescribir al nuevo.

## Timestamp as Global Truth

Clock Skew produce Ordering incorrecto.

## Singleton Request State

Context de un Request aparece en otro.

## Cache Lock as Business Guarantee

Cache Infrastructure se convierte accidentalmente en mecanismo autoritativo.

## Technology Equals Semantics

Redis se considera automáticamente suficiente para Cache, Lock, Queue, Session e Idempotency.

---

# 306. Relación con ENG-016

Cambios de Concurrency Contract observable deberán someterse a Compatibility Analysis.

---

# 307. Relación con ENG-021

Contracts deberán declarar Thread Safety, Idempotency o Version semantics cuando formen parte de la interfaz.

---

# 308. Relación con ENG-022

Event Bus deberá considerar:

```text
duplicate delivery
ordering
parallel handlers
handler idempotency
```

---

# 309. Relación con ENG-023

Error Handling gobernará:

```text
conflict translation
deadlock failure
lock timeout
retry classification
cancellation
```

---

# 310. Relación con ENG-024

Security Context y Tenant Context deberán permanecer aislados entre ejecuciones concurrentes.

---

# 311. Relación con ENG-025

Observability deberá medir Contention sin generar Cardinality no acotada.

---

# 312. Relación con ENG-026

Performance Engineering deberá determinar límites óptimos de Workers, Pools y Critical Sections.

---

# 313. Relación con ENG-027

Runtime gobernará:

```text
task lifecycle
worker lifecycle
shutdown
drain
cancellation
```

---

# 314. Relación con ENG-028

Modules serán responsables de declarar Concurrency semantics específicas de sus recursos.

---

# 315. Relación con ENG-030

Persistence proporcionará mecanismos como:

```text
transactions
unique constraints
conditional updates
isolation
version fields
```

---

# 316. Relación con ENG-032

Transport deberá propagar:

```text
deadline
cancellation
idempotency metadata
```

cuando el Contract lo requiera.

---

# 317. Relación con ENG-034

Application deberá coordinar Concurrency del Use Case sin introducir Infrastructure en Domain.

---

# 318. Relación con ENG-035

Domain conserva autoridad sobre las Invariants que Concurrency debe proteger.

La relación será:

```text
Domain
  │
  ▼
defines invariant

Application/Persistence
  │
  ▼
select coordination mechanism

Concurrency
  │
  ▼
provides primitives
```

---

# 319. Relación con ENG-036

Validation puede detectar State inválido.

Concurrency deberá impedir que State válido durante Validation se vuelva incorrectamente aceptado debido a una Race.

---

# 320. Relación con ENG-037

Caching utilizará Primitives de ENG-038 para:

```text
single-flight
stampede protection
atomic cache update
lease
version protection
```

sin convertir Cache en mecanismo de consistencia autoritativo.

---

# 321. Relación con ENG-039

ENG-039 deberá definir **Resilience Engineering**.

La separación será:

```text
Concurrency
→ multiple operations interacting simultaneously

Resilience
→ system behavior when dependencies or components fail
```

Conceptos como:

```text
Timeout
Retry
Backoff
Circuit Breaker
Bulkhead
Fallback
Load Shedding
Health
Recovery
```

deberán formalizarse allí.

ENG-038 únicamente establece aquellas reglas de Retry/Timeout necesarias para preservar Correctness bajo concurrencia.

---

# 322. Principio Rector

> **MEF deberá proteger las Invariants concurrentes utilizando el mecanismo menos complejo capaz de garantizar Correctness, favoreciendo Isolation, Immutability, Versioning y Atomic Operations antes de introducir Locks o coordinación distribuida.**

---

# 323. Conclusión

**ENG-038 — Concurrency Engineering** formaliza el modelo de concurrencia de MEF.

La jerarquía preferida queda:

```text
                SHARED STATE?
                     │
             ┌───────┴───────┐
             │               │
            NO              YES
             │               │
             ▼               ▼
       No coordination    Can isolate?
                             │
                     ┌───────┴───────┐
                     │               │
                    YES              NO
                     │               │
                     ▼               ▼
                Isolation       Can version?
                                    │
                            ┌───────┴───────┐
                            │               │
                           YES              NO
                            │               │
                            ▼               ▼
                       Optimistic       Atomic/Lock
                       Concurrency           │
                                            ▼
                                  Distributed only
                                   when necessary
```

La separación conceptual queda:

```text
Race Condition
→ incorrect result caused by uncontrolled interleaving

Atomicity
→ indivisible state transition

Optimistic Concurrency
→ detect conflicting modification

Pessimistic Concurrency
→ coordinate before modification

Lock
→ exclusive coordination

Lease
→ temporary ownership

Fencing Token
→ reject stale owners

Idempotency
→ prevent repeated effect

Bounded Concurrency
→ control simultaneous work

Backpressure
→ prevent uncontrolled accumulation

Deadlock
→ circular waiting without progress
```

La primera implementación deberá concentrarse en:

```text
ConcurrencyConflict
Version
ExpectedVersion
ConcurrencyPolicy
ConcurrencyLimiter
Lock
LockHandle
LockProvider
LockKey
RetryPolicy

+
Optimistic Concurrency
Atomic Constraints
Bounded Concurrency
Lock Timeout
Ownership-safe Release
Retry Limits
Concurrency Metrics
Concurrency Tests
```

antes de introducir:

```text
Distributed Lock Manager
Leader Election
Consensus
Cross-Region Coordination
Distributed Barrier
Advanced Logical Clocks
Custom Lock-Free Structures
```

Con **ENG-038** la serie global alcanza:

```text
EI-725
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
- ENG-039 — Resilience Engineering