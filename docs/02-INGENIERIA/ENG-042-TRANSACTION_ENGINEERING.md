---
id: ENG-042
titulo: Transaction Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Transaction Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-011
  - ENG-016
  - ENG-018
  - ENG-019
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
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-020
  - ENG-032
  - ENG-033
  - ENG-037
  - ENG-043
keywords:
  - transaction
  - transaction-boundary
  - unit-of-work
  - commit
  - rollback
  - isolation
  - savepoint
  - propagation
  - optimistic-concurrency
  - pessimistic-concurrency
  - deadlock
  - after-commit
  - outbox
  - distributed-transaction
  - compensation
  - mef
---

# ENG-042

# Transaction Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Transaction Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-042 establece las reglas para:

```text
Transaction
Transaction Boundary
Transaction Context
Unit of Work
Begin
Commit
Rollback
Isolation
Consistency
Atomicity
Savepoint
Nested Transaction
Transaction Propagation
Read-Only Transaction
Transaction Timeout
Transaction Retry
Optimistic Concurrency
Pessimistic Concurrency
Lock
Deadlock
After Commit
After Rollback
Transactional Event
Outbox Integration
Cross-Resource Consistency
Distributed Transaction
Compensation
Transaction Observability
Transaction Security
Transaction Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Toda operación que requiera Atomicidad deberá poseer una Transaction Boundary explícita, corta, observable y alineada con una unidad real de consistencia.**

La arquitectura conceptual será:

```text
Application Use Case
        │
        ▼
Transaction Boundary
        │
        ▼
    BEGIN
        │
        ▼
 Unit of Work
        │
   ┌────┼────┐
   │    │    │
   ▼    ▼    ▼
Read  Write  Outbox
   │    │    │
   └────┼────┘
        │
        ▼
     COMMIT
        │
        ├──► After Commit
        │
        └──► External Publication
```

Ante Failure:

```text
BEGIN
  │
  ▼
Work
  │
  ▼
Failure
  │
  ▼
ROLLBACK
```

---

# 3. Transaction

Una `Transaction` representa una unidad de trabajo cuyos cambios deberán obedecer garantías explícitas de Atomicidad y Consistencia.

---

# 4. Transaction Boundary

La `Transaction Boundary` define:

```text
where transaction starts
what resources participate
when commit occurs
when rollback occurs
```

---

# 5. Boundary Ownership

La Boundary deberá pertenecer normalmente a:

```text
Application Use Case
```

y no a una entidad individual.

---

# 6. Domain Transaction Awareness

ENG-035 Domain no deberá depender directamente de:

```text
database transaction
ORM transaction
connection
commit
rollback
savepoint
```

---

# 7. Infrastructure Transaction Awareness

Infrastructure podrá implementar Transaction Contracts.

---

# 8. Application Responsibility

Application deberá decidir cuándo una operación requiere una Boundary transaccional.

---

# 9. Transaction ≠ Request

No deberá asumirse:

```text
one HTTP request
=
one database transaction
```

---

# 10. Transaction ≠ Use Case Always

Tampoco todo Use Case requiere Transaction.

---

# 11. Atomicity

Atomicity significa que los cambios pertenecientes a una misma Transaction Boundary se confirman o revierten según las garantías del Resource.

---

# 12. Atomicity Scope

Deberá documentarse.

Ejemplo:

```text
Atomic inside PostgreSQL database
```

no implica:

```text
Atomic across PostgreSQL + Kafka + SMTP
```

---

# 13. Consistency

La Transaction deberá preservar Invariants dentro de su Boundary.

---

# 14. Consistency Ownership

Las reglas de negocio permanecen en Domain/Application.

La Transaction únicamente proporciona mecanismo de Atomicidad.

---

# 15. Isolation

Isolation define qué interacciones concurrentes son visibles entre Transactions.

---

# 16. Durability

Cuando el Resource la proporcione, Commit deberá representar estado durable según su Contract.

---

# 17. ACID

MEF podrá utilizar el modelo:

```text
Atomicity
Consistency
Isolation
Durability
```

sin asumir que todos los Resources proporcionan exactamente las mismas garantías.

---

# 18. Transaction Contract

Conceptualmente:

```text
Transaction
├── id
├── state
├── isolation
├── startedAt
├── deadline
└── context
```

---

# 19. Transaction State

Estados mínimos:

```text
NEW
ACTIVE
COMMITTED
ROLLED_BACK
FAILED
```

---

# 20. State Machine

```text
NEW
 │
 ▼
ACTIVE
 ├──────────────► COMMITTED
 │
 ├──────────────► ROLLED_BACK
 │
 └──────────────► FAILED
```

---

# 21. Terminal States

```text
COMMITTED
ROLLED_BACK
FAILED
```

deberán considerarse terminales salvo mecanismo explícito diferente.

---

# 22. Commit Once

Una Transaction no deberá poder confirmarse dos veces.

---

# 23. Rollback After Commit

Deberá rechazarse.

---

# 24. Commit After Rollback

También.

---

# 25. Begin

`begin()` crea una Transaction activa dentro de una Boundary.

---

# 26. Commit

`commit()` intenta hacer permanentes los cambios realizados.

---

# 27. Commit Failure

No deberá asumirse que un Commit fallido significa necesariamente:

```text
nothing committed
```

cuando el Resource pueda producir resultado ambiguo.

---

# 28. Ambiguous Commit

Caso:

```text
Client
  │
  ▼
COMMIT
  │
  ▼
Database commits
  │
  X
Connection lost
```

El Client puede no saber si Commit ocurrió.

---

# 29. Ambiguous Outcome

Deberá tratarse explícitamente.

---

# 30. Retry After Ambiguous Commit

No deberá repetirse ciegamente una operación no Idempotent.

---

# 31. Rollback

`rollback()` revierte cambios no confirmados dentro de las garantías del Resource.

---

# 32. Rollback Failure

Deberá registrarse y la conexión/Transaction podrá considerarse no reutilizable.

---

# 33. Automatic Rollback

Un Scope podrá hacer Rollback automáticamente si termina sin Commit.

---

# 34. Explicit Commit

Deberá favorecerse sobre Commit implícito en operaciones críticas.

---

# 35. Unit of Work

`Unit of Work` coordina cambios pertenecientes a una Transaction Boundary.

---

# 36. Unit of Work Responsibilities

Conceptualmente:

```text
track changes
coordinate repositories
flush changes
commit
rollback
```

---

# 37. Unit of Work ≠ Repository

Repository accede a Aggregates/Entities.

Unit of Work coordina persistencia de múltiples cambios.

---

# 38. Unit of Work Contract

Conceptualmente:

```text
UnitOfWork
├── begin()
├── commit()
├── rollback()
└── transactional(callback)
```

---

# 39. Transaction Manager

MEF podrá proporcionar:

```text
TransactionManager
```

como Contract principal.

---

# 40. Transaction Manager Contract

Conceptualmente:

```text
TransactionManager
    transactional(
        callback,
        options
    ) → result
```

---

# 41. Transaction Options

Podrán incluir:

```text
isolation
readOnly
timeout
propagation
retryPolicy
```

---

# 42. Callback Result

El resultado deberá devolverse únicamente después de Commit exitoso cuando represente estado confirmado.

---

# 43. Exception

Una Exception dentro de la Boundary deberá provocar Rollback salvo Policy explícita.

---

# 44. Rollback Rules

Deberán ser determinísticas.

---

# 45. Error Translation

ENG-023 gobernará traducción de errores del proveedor.

---

# 46. Transaction Context

Representa la Transaction activa disponible para Components participantes.

---

# 47. Context Propagation

Deberá ser explícita o gestionada mediante Scope controlado.

---

# 48. Global Transaction Variable

No deberá utilizarse.

---

# 49. Request-Global Connection

No deberá convertirse accidentalmente en Transaction Context.

---

# 50. Transaction Scope

Podrá integrarse con ENG-019 Service Container.

---

# 51. Transaction Scoped Services

Deberán utilizarse únicamente cuando su Lifecycle lo justifique.

---

# 52. Context Cleanup

Al finalizar deberá eliminarse Transaction Context.

---

# 53. Context Leak

Una Transaction no deberá contaminar otra Request, Job o Message.

---

# 54. Async Context

Si Runtime soporta Concurrency, el Context deberá propagarse únicamente a tareas pertenecientes a la misma Boundary.

---

# 55. Parallel Work Inside Transaction

No deberá permitirse automáticamente.

---

# 56. Concurrent Connection Use

Una misma DB Connection no deberá utilizarse concurrentemente salvo garantía explícita del Driver.

---

# 57. Transaction Duration

Deberá mantenerse corta.

---

# 58. Long Transaction

Deberá evitarse.

---

# 59. Long Transaction Risks

Incluyen:

```text
lock retention
MVCC growth
deadlock probability
connection exhaustion
contention
rollback cost
```

---

# 60. External Network Call

No deberá realizarse dentro de una Transaction larga salvo necesidad justificada.

---

# 61. HTTP Call Inside Transaction

Deberá evitarse especialmente cuando pueda tardar o reintentarse.

---

# 62. Email Inside Transaction

No deberá utilizarse como efecto atómico.

---

# 63. Broker Publish Inside DB Transaction

No garantiza Atomicidad salvo Transaction compartida real.

---

# 64. Transaction Timeout

Toda Transaction potencialmente bloqueante deberá poseer Timeout apropiado.

---

# 65. Timeout Meaning

Deberá distinguir:

```text
application deadline
transaction timeout
lock timeout
statement timeout
```

---

# 66. Transaction Deadline

Podrá derivarse de Deadline superior.

---

# 67. Timeout Exceeded

Deberá provocar Rollback cuando corresponda.

---

# 68. Read-Only Transaction

Podrá declararse para operaciones que no deben modificar estado.

---

# 69. Read-Only Guarantee

No deberá prometer más de lo que el Resource realmente garantiza.

---

# 70. Read Transaction

Podrá utilizar Snapshot consistente cuando sea necesario.

---

# 71. Isolation Levels

MEF podrá representar:

```text
READ_UNCOMMITTED
READ_COMMITTED
REPEATABLE_READ
SERIALIZABLE
```

---

# 72. Provider Mapping

Cada Adapter deberá mapear niveles soportados.

---

# 73. Unsupported Isolation

Deberá fallar explícitamente o utilizar Policy documentada.

---

# 74. Silent Isolation Downgrade

No deberá ocurrir.

---

# 75. Default Isolation

Deberá configurarse y documentarse.

---

# 76. Strongest Isolation

No deberá utilizarse automáticamente para todas las operaciones.

---

# 77. Isolation Selection

Deberá basarse en:

```text
business invariant
contention
performance
provider capability
```

---

# 78. Dirty Read

Puede ocurrir en Isolation débil.

---

# 79. Non-Repeatable Read

Deberá considerarse cuando una Transaction lee el mismo dato varias veces.

---

# 80. Phantom Read

Deberá considerarse cuando Invariant depende de conjuntos de filas.

---

# 81. Write Skew

Puede ocurrir incluso con Snapshot Isolation dependiendo del Provider.

---

# 82. Lost Update

Deberá prevenirse cuando viole Invariants.

---

# 83. Serializable

Podrá utilizarse para Invariants que requieran equivalencia serial.

---

# 84. Serializable Failure

Puede producir Serialization Failure y requerir Retry.

---

# 85. Isolation Documentation

Adapter deberá documentar semántica real del Provider.

---

# 86. Optimistic Concurrency

ENG-038 gobernará principios generales.

ENG-042 define su interacción transaccional.

---

# 87. Version

Una Entity/Aggregate podrá poseer:

```text
version
```

---

# 88. Conditional Update

Ejemplo:

```text
UPDATE ...
WHERE id = ?
AND version = ?
```

---

# 89. Optimistic Conflict

Si ninguna fila coincide deberá producir Failure explícito.

---

# 90. Retry Conflict

No deberá reintentarse automáticamente sin considerar Business Intent.

---

# 91. Re-read

Un Retry podrá requerir:

```text
reload
revalidate
reapply command
```

---

# 92. Pessimistic Concurrency

Podrá utilizar Locks cuando el Invariant lo justifique.

---

# 93. Lock

Un Lock deberá tener Scope y duración mínimos.

---

# 94. Lock Modes

Podrán incluir:

```text
shared
exclusive
update
```

según Provider.

---

# 95. Lock Ordering

Deberá mantenerse consistente para reducir Deadlocks.

---

# 96. Lock Timeout

Deberá ser acotado.

---

# 97. Lock Escalation

Deberá considerarse cuando el Provider la implemente.

---

# 98. Advisory Lock

Podrá utilizarse para coordinación específica.

---

# 99. Advisory Lock Warning

No deberá convertirse en sustituto universal de Transactional Correctness.

---

# 100. Deadlock

Un `Deadlock` ocurre cuando Transactions esperan recursos mutuamente incompatibles.

---

# 101. Deadlock Detection

Normalmente será responsabilidad del Provider.

---

# 102. Deadlock Victim

Una Transaction podrá ser abortada.

---

# 103. Deadlock Retry

Podrá ser Retryable cuando la operación sea segura.

---

# 104. Retry Entire Transaction

Tras Deadlock deberá repetirse la Transaction completa, no continuar parcialmente.

---

# 105. Deadlock Prevention

Deberá favorecer:

```text
consistent lock ordering
short transactions
small write sets
bounded concurrency
```

---

# 106. Retry

ENG-039 gobernará Retry semantics.

---

# 107. Transaction Retry

Deberá repetirse desde el inicio de la Boundary.

---

# 108. Partial Retry

No deberá continuar desde estado transaccional abortado.

---

# 109. Retryable Failures

Podrán incluir:

```text
deadlock
serialization failure
transient connection failure before commit
```

según Provider.

---

# 110. Non-Retryable Failures

Podrán incluir:

```text
validation failure
unique constraint business violation
authorization failure
unsupported operation
```

---

# 111. Retry Limit

Deberá ser acotado.

---

# 112. Retry Backoff

ENG-039 gobernará Backoff y Jitter.

---

# 113. Transaction Retry + Side Effects

No deberán ejecutarse Side Effects externos no Idempotent dentro de una callback que pueda repetirse.

---

# 114. Critical Rule

Si:

```text
transactional(callback)
```

puede reejecutar `callback`, entonces:

```text
callback
```

deberá ser segura ante Retry.

---

# 115. Savepoint

Un `Savepoint` marca un punto interno dentro de una Transaction.

---

# 116. Savepoint Contract

Conceptualmente:

```text
createSavepoint(name)
rollbackTo(name)
releaseSavepoint(name)
```

---

# 117. Savepoint Support

Será Capability del Adapter.

---

# 118. Unsupported Savepoint

Deberá detectarse.

---

# 119. Savepoint ≠ Independent Transaction

Rollback a Savepoint no confirma trabajo previo.

---

# 120. Nested Transaction

MEF deberá distinguir Transaction anidada lógica de Transaction física.

---

# 121. Physical Nested Transaction

No deberá asumirse que el Provider la soporta.

---

# 122. Logical Nested Transaction

Podrá implementarse mediante:

```text
propagation
savepoint
existing transaction participation
```

---

# 123. Nested Commit

Un Scope interno no deberá confirmar la Transaction externa accidentalmente.

---

# 124. Inner Rollback

Deberá definir si:

```text
rollback to savepoint
```

o:

```text
mark whole transaction rollback-only
```

---

# 125. Rollback-Only

Una Transaction podrá marcarse:

```text
rollbackOnly = true
```

---

# 126. Commit Rollback-Only

Deberá fallar y ejecutar Rollback.

---

# 127. Transaction Propagation

Define cómo un Scope se comporta cuando ya existe Transaction.

---

# 128. Propagation Modes

MEF podrá soportar:

```text
REQUIRED
REQUIRES_NEW
SUPPORTS
NOT_SUPPORTED
MANDATORY
NEVER
```

---

# 129. REQUIRED

```text
existing transaction
→ join

no transaction
→ create
```

---

# 130. REQUIRES_NEW

```text
existing transaction
→ suspend

create new transaction
```

---

# 131. REQUIRES_NEW Requirement

Solo deberá ofrecerse cuando Adapter/Runtime pueda implementarlo correctamente.

---

# 132. SUPPORTS

Participa si existe; de lo contrario ejecuta sin Transaction.

---

# 133. NOT_SUPPORTED

Suspende Transaction activa y ejecuta sin ella.

---

# 134. MANDATORY

Requiere Transaction existente.

---

# 135. NEVER

Falla si existe Transaction.

---

# 136. First Version Propagation

La primera versión deberá priorizar:

```text
REQUIRED
MANDATORY
NEVER
```

antes de introducir suspensión compleja.

---

# 137. Propagation Complexity

No deberá copiarse un modelo de Framework externo si el Runtime no puede sostener sus garantías.

---

# 138. Transaction Suspension

Requiere preservar correctamente:

```text
connection
context
scope
resource ownership
```

---

# 139. Cross-Thread Transaction

No deberá permitirse por Default.

---

# 140. Cross-Worker Transaction

No deberá existir.

---

# 141. HTTP Transaction Propagation

Una Transaction DB local no deberá propagarse a otro servicio mediante HTTP.

---

# 142. Message Transaction Propagation

Tampoco deberá propagarse mediante Message.

---

# 143. Transaction ID Propagation

Podrá propagarse únicamente como Correlation Metadata, no como Transaction física.

---

# 144. After Commit

Permite ejecutar lógica únicamente después de Commit exitoso.

---

# 145. After Commit Use Cases

Ejemplos:

```text
invalidate cache
schedule local follow-up
emit internal notification
```

cuando la semántica lo permita.

---

# 146. After Commit Failure

No podrá revertir una Transaction ya confirmada.

---

# 147. Critical External Effect

No deberá depender únicamente de un callback `afterCommit` en Memory si perderlo es inaceptable.

---

# 148. Durable After Commit

Deberá utilizar:

```text
Transactional Outbox
```

u otro mecanismo durable.

---

# 149. After Rollback

Podrá utilizarse para Cleanup local.

---

# 150. After Rollback Failure

Deberá observarse, pero no cambia el hecho de que la Transaction fue revertida.

---

# 151. Before Commit

Podrá utilizarse con cautela.

---

# 152. Before Commit Failure

Deberá impedir Commit.

---

# 153. Hook Ordering

Deberá ser determinístico.

---

# 154. Hook Recursion

Deberá impedirse o acotarse.

---

# 155. Transactional Event

Un Event generado durante una Transaction deberá distinguir:

```text
event occurred in memory
```

de:

```text
event durably committed
```

---

# 156. Domain Event Collection

Aggregates podrán acumular Domain Events durante el Use Case.

---

# 157. Publish Before Commit

No deberá publicarse externamente un Integration Event antes de confirmar el State que representa.

---

# 158. Publish After Commit

Puede perderse si el proceso muere entre Commit y Publish.

---

# 159. Transactional Outbox

Será Pattern preferido para Publication durable.

---

# 160. Outbox Record

Deberá escribirse dentro de la misma Transaction que Business State.

---

# 161. Outbox Architecture

```text
Transaction
   │
   ├── Business Changes
   │
   └── Outbox Message
   │
   ▼
 COMMIT
   │
   ▼
Outbox Relay
   │
   ▼
Messaging
```

---

# 162. Outbox Atomicity

La garantía será:

```text
Business State + Publication Intent
```

atómicos dentro de una misma Database Transaction.

---

# 163. Outbox ≠ Exactly Once

Relay podrá publicar duplicados.

---

# 164. Consumer Idempotency

ENG-041 continuará siendo necesaria.

---

# 165. Outbox Relay Transaction

Deberá evitar mantener Transaction abierta durante Publish remoto cuando sea posible.

---

# 166. Outbox Claim

Múltiples Relays deberán coordinar Claims de forma segura.

---

# 167. Outbox State

Podrá incluir:

```text
PENDING
PROCESSING
PUBLISHED
FAILED
```

---

# 168. Outbox Retry

Deberá ser acotado y observable.

---

# 169. Outbox Poison Record

Deberá aislarse cuando no pueda publicarse permanentemente.

---

# 170. Outbox Retention

Deberá configurarse.

---

# 171. Inbox

ENG-041 podrá utilizar Inbox para Consumer Idempotency.

---

# 172. Inbox Transaction

Idealmente:

```text
Inbox Record
+
Business Effect
```

deberán compartir Transaction.

---

# 173. Duplicate Inbox Record

Deberá impedir procesamiento duplicado según Idempotency Scope.

---

# 174. Inbox Retention

Deberá alinearse con ventana de Redelivery.

---

# 175. Cross-Resource Transaction

Una operación puede involucrar:

```text
Database A
Database B
Broker
Object Storage
External API
```

---

# 176. Local Atomicity

Una Transaction local no puede garantizar Atomicidad sobre Resources externos independientes.

---

# 177. Dual Write

Deberá reconocerse explícitamente.

---

# 178. Dual Write Example

```text
Database Commit
      │
      ▼
External API Call
      │
      X
    Failure
```

No existe Rollback automático del Database Commit.

---

# 179. Distributed Transaction

Una Transaction distribuida coordina múltiples Resource Managers.

---

# 180. 2PC

Two-Phase Commit podrá existir cuando la infraestructura lo soporte.

---

# 181. 2PC Default

No será la estrategia Default de MEF.

---

# 182. 2PC Costs

Incluyen:

```text
coordination
availability coupling
operational complexity
blocking
provider dependence
```

---

# 183. XA

No deberá convertirse en requisito del Core.

---

# 184. Cross-Service ACID

No deberá prometerse como Default.

---

# 185. Service Boundary

Cada Service deberá favorecer Transaction local propia.

---

# 186. Eventual Consistency

Podrá utilizarse entre Boundaries.

---

# 187. Eventual Consistency ≠ No Consistency

Deberá existir State Model y Recovery Strategy.

---

# 188. Compensation

Una `Compensation` representa una nueva acción que intenta semánticamente contrarrestar un efecto previamente confirmado.

---

# 189. Compensation ≠ Rollback

```text
Rollback
→ undo uncommitted work

Compensation
→ new committed business action
```

---

# 190. Compensation Example

```text
Payment captured
       │
       ▼
Later workflow fails
       │
       ▼
Refund payment
```

`Refund` no es Rollback técnico del Capture.

---

# 191. Compensation Failure

También puede fallar.

---

# 192. Compensation Retry

Deberá poseer Policy explícita.

---

# 193. Compensation Idempotency

Será obligatoria cuando pueda repetirse.

---

# 194. Compensation Audit

Deberá conservar:

```text
original operation
compensating operation
reason
status
correlation
```

---

# 195. Saga

Una Saga coordina Transactions locales y Compensations.

---

# 196. Saga Scope

No será responsabilidad primaria de ENG-042.

---

# 197. Saga Requirement

Podrá formalizarse en documento posterior.

---

# 198. Consistency Model

Toda operación distribuida relevante deberá declarar:

```text
strong local consistency
eventual cross-boundary consistency
compensation semantics
```

---

# 199. Cache Transaction

ENG-037 Cache normalmente no participará en la misma Transaction ACID que Database.

---

# 200. Cache Invalidation

Deberá realizarse:

```text
after commit
```

o mediante mecanismo durable cuando Correctness lo requiera.

---

# 201. Cache Before Commit

No deberá exponer State no confirmado.

---

# 202. Cache Failure After Commit

No deberá revertir Business Commit.

---

# 203. Jobs Transaction

ENG-040 deberá evitar mantener Transaction abierta durante Job completo.

---

# 204. Job Attempt Transaction

Cada Attempt podrá utilizar una o varias Transactions locales cortas.

---

# 205. Enqueue Job Atomically

Cuando Business State y Job Creation deban ser atómicos deberá utilizarse:

```text
Outbox
Transactional Job Store
```

o mecanismo equivalente.

---

# 206. Messaging Transaction

ENG-041 utilizará Outbox/Inbox para coordinar Database y Broker.

---

# 207. Event Bus Transaction

ENG-022 deberá diferenciar Event Dispatch inmediato de Event confirmado.

---

# 208. Transactional Domain Events

Podrán recolectarse durante Transaction y materializarse tras Commit.

---

# 209. Error Handling

ENG-023 deberá clasificar:

```text
transaction conflict
deadlock
timeout
constraint violation
commit failure
rollback failure
```

---

# 210. Error Namespace

ENG-042 utilizará:

```text
MEF-TXN-xxx
```

---

# 211. Taxonomía ENG-042

```text
MEF-TXN-001 Transaction begin failed
MEF-TXN-002 Transaction commit failed
MEF-TXN-003 Transaction rollback failed
MEF-TXN-004 Invalid transaction state
MEF-TXN-005 Transaction timeout
MEF-TXN-006 Transaction deadline exceeded
MEF-TXN-007 Unsupported isolation level
MEF-TXN-008 Optimistic concurrency conflict
MEF-TXN-009 Lock acquisition failed
MEF-TXN-010 Lock timeout
MEF-TXN-011 Deadlock detected
MEF-TXN-012 Serialization failure
MEF-TXN-013 Savepoint unsupported
MEF-TXN-014 Savepoint operation failed
MEF-TXN-015 Invalid transaction propagation
MEF-TXN-016 Transaction required
MEF-TXN-017 Transaction forbidden
MEF-TXN-018 Transaction marked rollback-only
MEF-TXN-019 Ambiguous commit outcome
MEF-TXN-020 Transaction retry exhausted
MEF-TXN-021 Transaction context unavailable
MEF-TXN-022 Transaction context leak
MEF-TXN-023 Cross-resource atomicity unsupported
MEF-TXN-024 After-commit callback failed
MEF-TXN-025 After-rollback callback failed
MEF-TXN-026 Outbox write failed
MEF-TXN-027 Outbox publication failed
MEF-TXN-028 Compensation failed
MEF-TXN-029 Transaction contract violation
MEF-TXN-030 Transaction invariant violation
```

---

# 212. Commit Failure Example

```text
MEF-TXN-002

Transaction commit failed.

Transaction:
01J...

Resource:
primary-database
```

---

# 213. Deadlock Example

```text
MEF-TXN-011

Deadlock detected.

Transaction:
01J...

Resource:
primary-database
```

---

# 214. Ambiguous Commit Example

```text
MEF-TXN-019

Transaction commit outcome is unknown.

Transaction:
01J...

Operation:
order.create
```

---

# 215. Cross-Resource Example

```text
MEF-TXN-023

Atomic transaction across requested resources
is not supported.

Resources:
database
message-broker
```

---

# 216. Compensation Example

```text
MEF-TXN-028

Compensating action failed.

Operation:
payment.refund

Correlation:
01J...
```

---

# 217. Security

ENG-024 gobernará Transaction Security.

---

# 218. Authorization

Authorization deberá ocurrir antes de cambios sensibles.

---

# 219. Authorization Inside Transaction

Podrá revalidarse dentro de Boundary cuando dependa de State protegido por la propia Transaction.

---

# 220. TOCTOU

Deberá considerarse:

```text
check authorization
        │
        ▼
state changes concurrently
        │
        ▼
perform operation
```

---

# 221. Sensitive Transaction Logs

No deberán incluir datos sensibles innecesarios.

---

# 222. Transaction Identifier

Podrá registrarse, pero no deberá utilizarse como Credential.

---

# 223. Tenant Isolation

Transaction Context deberá preservar Tenant.

---

# 224. Cross-Tenant Transaction

No deberá permitirse accidentalmente.

---

# 225. Tenant Change Mid-Transaction

Deberá rechazarse salvo mecanismo administrativo explícito.

---

# 226. Row-Level Security

Podrá reforzar Tenant Isolation cuando el Provider lo soporte.

---

# 227. Connection State

Al devolver Connection al Pool deberá limpiarse State sensible:

```text
transaction
isolation override
tenant/session variable
temporary settings
```

---

# 228. Observability

ENG-025 gobernará Telemetry.

---

# 229. Transaction Metrics

Podrán incluir:

```text
mef.transactions.started.total
mef.transactions.committed.total
mef.transactions.rolled_back.total
mef.transactions.failed.total
```

---

# 230. Duration Metric

```text
mef.transactions.duration
```

---

# 231. Conflict Metrics

Podrán incluir:

```text
mef.transactions.optimistic_conflicts.total
mef.transactions.deadlocks.total
mef.transactions.serialization_failures.total
```

---

# 232. Retry Metrics

Podrán incluir:

```text
mef.transactions.retries.total
mef.transactions.retry_exhausted.total
```

---

# 233. Outbox Metrics

Podrán incluir:

```text
mef.transactions.outbox.pending
mef.transactions.outbox.publish_failures.total
mef.transactions.outbox.oldest.age
```

---

# 234. Lock Metrics

Podrán incluir:

```text
lock wait duration
lock timeout count
```

cuando el Provider los exponga.

---

# 235. High Cardinality

`transactionId` no deberá utilizarse como Metric Label.

---

# 236. Tracing

Una Transaction podrá producir Span interno.

---

# 237. Trace Attributes

Podrán incluir:

```text
resource
isolation
result
retryCount
```

sin datos sensibles.

---

# 238. Transaction Logs

Deberán registrar especialmente:

```text
commit failure
rollback failure
deadlock
retry exhaustion
ambiguous outcome
long transaction
```

---

# 239. Slow Transaction

Deberá existir Threshold configurable.

---

# 240. Long Transaction Alert

Podrá indicar:

```text
lock contention
slow dependency
large write set
application bug
```

---

# 241. Testing

ENG-009 gobernará Testing.

---

# 242. Commit Test

Deberá comprobar persistencia completa.

---

# 243. Rollback Test

Deberá comprobar ausencia de cambios parciales.

---

# 244. Exception Rollback Test

Una Exception deberá revertir la Boundary según Policy.

---

# 245. Commit Failure Test

Deberá comprobar Error Translation.

---

# 246. Ambiguous Commit Test

Deberá comprobar que no exista Retry ciego.

---

# 247. Isolation Test

Deberá comprobar semántica real del Adapter/Provider.

---

# 248. Optimistic Conflict Test

Dos Writers concurrentes deberán producir resultado conforme al Contract.

---

# 249. Pessimistic Lock Test

Deberá comprobar Lock Timeout.

---

# 250. Deadlock Test

Deberá comprobar Classification y Retry.

---

# 251. Retry Test

Deberá comprobar que se repita la Transaction completa.

---

# 252. Retry Side-Effect Test

Deberá comprobar que Side Effects externos no se dupliquen.

---

# 253. Savepoint Test

Deberá comprobar Rollback parcial.

---

# 254. Nested Transaction Test

Deberá comprobar que Scope interno no confirme accidentalmente Scope externo.

---

# 255. Propagation Test

Deberá probar cada Mode soportado.

---

# 256. Rollback-Only Test

Deberá impedir Commit.

---

# 257. Context Leak Test

Una Request/Job/Message posterior no deberá heredar Transaction previa.

---

# 258. Timeout Test

Deberá comprobar Rollback.

---

# 259. After Commit Test

No deberá ejecutarse antes del Commit.

---

# 260. After Commit Failure Test

Deberá comprobar que Business State permanece confirmado.

---

# 261. Outbox Atomicity Test

Deberá comprobar:

```text
Business State
+
Outbox Record
```

dentro de la misma Transaction.

---

# 262. Outbox Relay Crash Test

Deberá comprobar publicación duplicada segura.

---

# 263. Inbox Atomicity Test

Deberá comprobar:

```text
Inbox
+
Business Effect
```

atómicamente.

---

# 264. Cache Invalidation Test

No deberá publicar State no confirmado.

---

# 265. Tenant Test

Deberá impedir contaminación Cross-Tenant.

---

# 266. Connection Pool Test

Deberá comprobar limpieza de State al reutilizar Connection.

---

# 267. Load Test

Deberá medir:

```text
transaction throughput
transaction duration
lock wait
deadlock rate
connection pool saturation
```

---

# 268. Fault Injection

Podrá simular:

```text
connection loss
commit response loss
deadlock
serialization failure
database restart
timeout
outbox relay crash
```

---

# 269. Architecture Tests

Podrán impedir:

```text
Domain → ORM transaction API
Domain → Connection
Domain → Commit/Rollback
```

---

# 270. Build Integration

ENG-012 podrá validar:

```text
unsupported propagation
unsupported isolation
missing transaction adapter
invalid timeout
unbounded retry
```

---

# 271. CLI

ENG-007 podrá proporcionar:

```text
mef transactions:status
mef transactions:config
mef transactions:outbox
mef transactions:outbox:retry
mef transactions:diagnose
```

---

# 272. CLI Limit

No deberá permitir manipular una Transaction activa remota arbitrariamente.

---

# 273. Outbox CLI

Operaciones de Replay deberán ser auditables.

---

# 274. Configuration

ENG-011 podrá definir:

```text
transactions:
  default:
    isolation: READ_COMMITTED
    timeout: 10s
    propagation: REQUIRED

  retry:
    max-attempts: 3

  outbox:
    enabled: true
    batch-size: 100
```

---

# 275. Configuration Validation

Deberá comprobar:

```text
timeout > 0
retry bounded
supported isolation
supported propagation
valid outbox batch size
```

---

# 276. Adapter Capability

Cada Transaction Adapter deberá declarar:

```text
supportedIsolationLevels
supportsSavepoints
supportsReadOnly
supportsSuspension
supportsNestedTransactions
```

---

# 277. Capability Detection

No deberá basarse únicamente en Provider Name.

---

# 278. Unsupported Capability

Deberá fallar explícitamente.

---

# 279. Persistence Integration

ENG-030 proporcionará:

```text
repositories
connections
persistence adapters
```

mientras ENG-042 gobernará Transaction semantics.

---

# 280. Service Container Integration

ENG-019 podrá proporcionar Transaction Scope.

---

# 281. DI Integration

ENG-018 permitirá intercambiar Transaction Manager Adapter.

---

# 282. Registry Integration

ENG-020 podrá registrar Transaction Adapters y Capabilities.

---

# 283. Contract Integration

ENG-021 definirá Contracts neutrales al proveedor.

---

# 284. Runtime Integration

ENG-027 gobernará Lifecycle y Cleanup.

---

# 285. Module Integration

ENG-028 permitirá Modules utilizar Transaction Contracts sin conocer implementación concreta.

---

# 286. Application Integration

ENG-034 será Owner principal de Transaction Boundaries.

---

# 287. Domain Integration

ENG-035 mantendrá Business Invariants independientes del mecanismo transaccional.

---

# 288. Validation Integration

ENG-036 deberá ejecutarse antes de Writes cuando sea posible.

---

# 289. Concurrency Integration

ENG-038 gobernará:

```text
optimistic concurrency
locks
fencing
race conditions
```

---

# 290. Resilience Integration

ENG-039 gobernará:

```text
retry
backoff
jitter
timeout
```

---

# 291. Jobs Integration

ENG-040 utilizará Transactions locales cortas por Job Attempt.

---

# 292. Messaging Integration

ENG-041 utilizará:

```text
Outbox
Inbox
Idempotency
```

para consistencia entre Database y Broker.

---

# 293. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Transaction
TransactionId
TransactionState

TransactionManager
TransactionContext
TransactionOptions

UnitOfWork

IsolationLevel
Propagation

TransactionTimeout
TransactionResult

TransactionHook
AfterCommit
AfterRollback

TransactionCapability

TransactionError
```

---

# 294. Persistence-Oriented Components

Deberán existir cuando ENG-030 Adapter lo requiera:

```text
ConnectionTransaction
DatabaseTransactionManager
DatabaseUnitOfWork
```

sin exponerlos al Domain.

---

# 295. Reliability Components

Podrán incluir:

```text
TransactionRetryPolicy
DeadlockClassifier
SerializationFailureClassifier
AmbiguousCommitDetector
```

---

# 296. Outbox Components

La primera implementación integrada con ENG-041 podrá incluir:

```text
OutboxRecord
OutboxStore
OutboxWriter
OutboxRelay
```

---

# 297. Optional Initial Components

Podrán incorporarse:

```text
Savepoint
RollbackOnly
TransactionHookRegistry
InboxTransactionCoordinator
```

---

# 298. Later Components

Solo cuando exista necesidad:

```text
REQUIRES_NEW
Transaction Suspension
Advanced Nested Transactions
Distributed Transaction Coordinator
2PC Adapter
Saga Coordinator
Compensation Engine
```

---

# 299. Conceptual Directory Structure

```text
src/
└── Transaction/
    ├── Contract/
    │   ├── Transaction
    │   ├── TransactionManager
    │   └── UnitOfWork
    │
    ├── Context/
    │   └── TransactionContext
    │
    ├── Model/
    │   ├── TransactionId
    │   ├── TransactionState
    │   ├── TransactionOptions
    │   ├── IsolationLevel
    │   └── Propagation
    │
    ├── Hook/
    │   ├── TransactionHook
    │   ├── AfterCommit
    │   └── AfterRollback
    │
    ├── Retry/
    │   ├── TransactionRetryPolicy
    │   ├── DeadlockClassifier
    │   └── SerializationFailureClassifier
    │
    ├── Capability/
    │   └── TransactionCapability
    │
    ├── Outbox/
    │   ├── OutboxRecord
    │   ├── OutboxStore
    │   ├── OutboxWriter
    │   └── OutboxRelay
    │
    └── Error/
        └── TransactionError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 300. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Transaction Boundaries
Application-Owned Boundaries
Short Transactions
Explicit Commit/Rollback
Unit of Work
Transaction Context
READ_COMMITTED Default
Explicit Isolation Override
Optimistic Concurrency
Deadlock Classification
Bounded Transaction Retry
Rollback-Only
After Commit
Transactional Outbox
Atomic Inbox Integration
Observability
Security
Provider Capability Detection
```

---

# 301. First Version Non-Goals

No deberá requerir:

```text
Distributed ACID
2PC
XA
Cross-Service Transaction Propagation
Transaction Across HTTP
Transaction Across Message Broker
Advanced Nested Transactions
Automatic Saga Runtime
Automatic Compensation Engine
```

---

# 302. Second Phase

Podrá incorporar:

```text
Savepoints
Advanced Isolation Mapping
REQUIRES_NEW
Transaction Suspension
Advanced Transaction Hooks
Transaction Diagnostics
```

---

# 303. Third Phase

Solo cuando exista necesidad demostrada:

```text
Distributed Transaction Adapter
2PC
Saga Coordinator
Compensation Engine
Cross-Resource Coordination
```

---

# 304. Invariantes de Ingeniería

ENG-042 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-786 | Toda operación que requiera Atomicidad deberá poseer Transaction Boundary explícita y alineada con una unidad real de consistencia. |
| EI-787 | Transaction Boundaries deberán pertenecer normalmente a Application Use Cases y no deberán contaminar Domain con APIs de Persistence. |
| EI-788 | Una Transaction deberá mantener duración y Resource Scope mínimos compatibles con el Invariant que protege. |
| EI-789 | MEF deberá declarar el Scope real de Atomicidad y no deberá extender implícitamente garantías ACID a Resources independientes. |
| EI-790 | Commit, Rollback y Transaction State deberán obedecer una State Machine explícita que impida transiciones inválidas. |
| EI-791 | Un resultado ambiguo de Commit no deberá provocar Retry ciego de operaciones no Idempotent. |
| EI-792 | Isolation deberá seleccionarse según Invariants y Capabilities del Provider, y nunca degradarse silenciosamente. |
| EI-793 | Optimistic y Pessimistic Concurrency deberán utilizarse explícitamente cuando sean necesarias para preservar Correctness. |
| EI-794 | Deadlocks y Serialization Failures Retryable deberán repetir la Transaction completa desde una nueva Boundary válida. |
| EI-795 | Todo Transaction Retry deberá ser acotado y su callback deberá ser seguro ante reejecución. |
| EI-796 | Side Effects externos no Idempotent no deberán ejecutarse dentro de una Transaction callback susceptible de Retry. |
| EI-797 | Savepoints y Nested Transactions no deberán confundirse con Transactions físicas independientes. |
| EI-798 | Transaction Propagation deberá corresponder a Capabilities reales del Runtime y Adapter, sin simular garantías inexistentes. |
| EI-799 | Una Transaction local no deberá propagarse físicamente a través de HTTP, Messaging, Jobs o Worker Boundaries. |
| EI-800 | After-Commit en Memory no deberá utilizarse como único mecanismo para Side Effects cuya pérdida sea inaceptable. |
| EI-801 | Business State y Publication Intent deberán persistirse atómicamente mediante Transactional Outbox cuando su divergencia sea inaceptable. |
| EI-802 | Inbox/Idempotency State y Business Effect deberán compartir Transaction cuando Correctness requiera procesamiento único dentro de la misma Resource Boundary. |
| EI-803 | Compensation deberá tratarse como nueva operación de negocio y no como Rollback técnico de una Transaction ya confirmada. |
| EI-804 | Transaction Context deberá aislarse entre Requests, Jobs, Messages, Tenants y Concurrent Executions, eliminándose completamente al finalizar la Boundary. |
| EI-805 | La primera implementación deberá favorecer Transactions locales cortas, explicit Boundaries, Outbox/Inbox y Bounded Retry antes de introducir Distributed Transactions, 2PC o Saga Runtime. |

---

# 305. Continuidad de Invariantes

```text
ENG-038 → EI-706 a EI-725
ENG-039 → EI-726 a EI-745
ENG-040 → EI-746 a EI-765
ENG-041 → EI-766 a EI-785
ENG-042 → EI-786 a EI-805
```

---

# 306. Criterios de Conformidad

Una implementación será conforme con ENG-042 cuando:

- modele Transaction Boundary explícita;
- Application controle normalmente dicha Boundary;
- Domain permanezca independiente de APIs transaccionales;
- implemente Begin/Commit/Rollback;
- modele Transaction State;
- soporte Unit of Work;
- preserve Transaction Context;
- limpie Context al finalizar;
- limite duración de Transactions;
- evite llamadas externas largas dentro de Transaction;
- soporte Isolation explícita;
- detecte Isolation no soportada;
- no degrade Isolation silenciosamente;
- soporte Optimistic Concurrency;
- gestione Lock/Deadlock cuando corresponda;
- limite Transaction Retry;
- repita Transaction completa;
- evite Side Effects inseguros dentro de Retry;
- modele Savepoint cuando exista soporte;
- diferencie Nested Transaction física y lógica;
- modele Propagation explícita;
- soporte Rollback-Only;
- implemente After Commit;
- utilice Outbox para Publication durable;
- integre Inbox cuando corresponda;
- no prometa Atomicidad Cross-Resource inexistente;
- modele Compensation como nueva operación;
- preserve Tenant Isolation;
- integre Observability;
- pruebe Faults y Concurrency.

---

# 307. Riesgos

Deberán evitarse especialmente:

## Transaction per HTTP Request

Se mantiene una Transaction abierta durante toda la Request.

## Domain Transaction API

Entities llaman directamente a `commit()` o `rollback()`.

## Long Transaction

Locks y Connections permanecen retenidos innecesariamente.

## Network Call Inside Transaction

Una dependencia remota controla indirectamente duración de Locks.

## Strongest Isolation Everywhere

Se degrada Throughput sin necesidad.

## Silent Isolation Downgrade

El sistema cree tener garantías que realmente no existen.

## Blind Deadlock Retry

Se repiten Side Effects externos.

## Retry Partial Transaction

Se continúa utilizando Transaction abortada.

## Nested Commit

Un Component interno confirma trabajo perteneciente al Use Case externo.

## Fake REQUIRES_NEW

Se simula una nueva Transaction sin suspensión real.

## Global Transaction Context

Requests concurrentes comparten State.

## Commit Then Publish

El proceso muere antes de publicar.

## Publish Then Commit

Consumers observan un hecho que finalmente se revierte.

## Cache Before Commit

Se expone State no confirmado.

## Distributed ACID Assumption

Se asume que Database, Broker y API remota forman una sola Transaction.

## Compensation as Rollback

Se ignora que la acción original ya fue confirmada.

## Transaction Leak

Connection vuelve al Pool con Transaction activa.

---

# 308. Relación con ENG-030

La separación será:

```text
ENG-030 Persistence
→ how state is stored

ENG-042 Transaction
→ how multiple state changes become one consistency unit
```

---

# 309. Relación con ENG-038

La separación será:

```text
ENG-038 Concurrency
→ simultaneous execution correctness

ENG-042 Transaction
→ atomic consistency boundaries
```

Ambos se intersectan en:

```text
optimistic concurrency
locks
deadlocks
serialization failures
```

---

# 310. Relación con ENG-039

Resilience gobierna Retry/Timeout generales.

Transaction Engineering decide cuándo es seguro repetir una Transaction completa.

---

# 311. Relación con ENG-040

Jobs deberán utilizar Transactions locales cortas.

```text
Job Attempt
   │
   ├── Transaction A
   ├── External Work
   └── Transaction B
```

cuando sea más seguro que mantener una sola Transaction larga.

---

# 312. Relación con ENG-041

Messaging utilizará:

```text
Transactional Outbox
Transactional Inbox
Idempotent Consumer
```

para mantener consistencia sin requerir Distributed ACID.

---

# 313. Relación con ENG-022

Domain Events generados durante una Transaction deberán distinguirse de Integration Events durables.

---

# 314. Relación con ENG-024

Security gobernará:

```text
tenant isolation
authorization
connection state
transaction diagnostics
sensitive logging
```

---

# 315. Relación con ENG-025

Observability gobernará:

```text
duration
commit/rollback
deadlocks
conflicts
retries
outbox lag
```

---

# 316. Relación con ENG-027

Runtime deberá garantizar:

```text
transaction scope
context cleanup
connection cleanup
graceful shutdown
```

---

# 317. Relación con ENG-034

Application será Owner principal de Transaction Boundary.

---

# 318. Relación con ENG-035

Domain definirá Invariants, pero no conocerá mecanismo de Commit/Rollback.

---

# 319. Relación con ENG-043

ENG-043 deberá formalizar **Data Access Engineering**.

La separación será:

```text
Persistence
→ storage architecture

Transaction
→ consistency boundary

Data Access
→ controlled querying and mutation of persisted data
```

ENG-043 deberá cubrir:

```text
Repository
Query
Command
Data Mapper
Identity Map
Specification
Query Object
Criteria
Pagination
Cursor
Filtering
Sorting
Projection
Read Model
N+1
Batch Loading
Lazy Loading
Eager Loading
Query Timeout
Query Budget
Database Round Trips
Query Observability
Raw Query
SQL Safety
Tenant Filtering
Data Access Testing
```

---

# 320. Principio Rector

> **MEF deberá utilizar Transactions como Boundaries explícitas de consistencia local, no como mecanismo mágico de consistencia distribuida; deberá mantenerlas cortas, aisladas y observables, y resolver efectos Cross-Boundary mediante Outbox, Idempotency, Eventual Consistency y Compensation cuando corresponda.**

---

# 321. Conclusión

**ENG-042 — Transaction Engineering** formaliza las Boundaries de consistencia de MEF.

La arquitectura principal queda:

```text
                  APPLICATION USE CASE
                          │
                          ▼
                TRANSACTION MANAGER
                          │
                          ▼
                       BEGIN
                          │
                          ▼
                    UNIT OF WORK
                          │
              ┌───────────┼───────────┐
              │           │           │
              ▼           ▼           ▼
         Repository   Repository    Outbox
              │           │           │
              └───────────┼───────────┘
                          │
                          ▼
                       COMMIT
                          │
              ┌───────────┴───────────┐
              │                       │
              ▼                       ▼
        AFTER COMMIT              OUTBOX RELAY
                                      │
                                      ▼
                                   BROKER
```

Ante Failure:

```text
BEGIN
  │
  ▼
Unit of Work
  │
  ▼
Failure
  │
  ▼
ROLLBACK
```

Ante Failure transitorio:

```text
Transaction Attempt 1
        │
        ▼
     Deadlock
        │
        ▼
    Rollback
        │
        ▼
 Backoff + Jitter
        │
        ▼
Transaction Attempt 2
```

La separación conceptual queda:

```text
Transaction
→ atomic unit of local work

Transaction Boundary
→ scope of atomicity

Unit of Work
→ coordinates persistence changes

Isolation
→ visibility between concurrent transactions

Optimistic Concurrency
→ detect conflicting writes

Pessimistic Concurrency
→ prevent conflicting access using locks

Savepoint
→ rollback point inside a transaction

Propagation
→ transaction participation policy

After Commit
→ non-durable post-commit callback

Outbox
→ durable publication intent

Inbox
→ durable consumer idempotency

Distributed Transaction
→ coordinated multi-resource transaction

Compensation
→ new business action that counteracts a committed action
```

La primera implementación deberá concentrarse en:

```text
Transaction
TransactionId
TransactionState

TransactionManager
TransactionContext
TransactionOptions

UnitOfWork

IsolationLevel
Propagation

TransactionTimeout

TransactionHook
AfterCommit
AfterRollback

TransactionCapability

TransactionRetryPolicy

TransactionError

OutboxRecord
OutboxStore
OutboxWriter
OutboxRelay
```

con:

```text
Explicit Boundaries
Application Ownership
Short Transactions
Commit/Rollback
READ_COMMITTED Default
Optimistic Concurrency
Deadlock Detection
Bounded Retry
Rollback-Only
After Commit
Transactional Outbox
Inbox Integration
Tenant Isolation
Context Cleanup
Observability
```

antes de introducir:

```text
Advanced Nested Transactions
REQUIRES_NEW
Transaction Suspension
Distributed ACID
2PC
XA
Saga Runtime
Compensation Engine
```

Con **ENG-042** la serie global alcanza:

```text
EI-805
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
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
```