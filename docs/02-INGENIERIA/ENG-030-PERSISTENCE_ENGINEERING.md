---
id: ENG-030
titulo: Persistence Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Engineering
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
relacionados:
  - ENG-006
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
keywords:
  - persistence
  - database
  - repository
  - transaction
  - unit-of-work
  - migration
  - schema
  - data-ownership
  - storage
  - consistency
  - concurrency
  - mef
---

# ENG-030

# Persistence Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Persistence Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-030 deberá establecer las reglas para:

```text
Data Ownership
Persistence Boundaries
Repositories
Transactions
Unit of Work
Storage Adapters
Schema Ownership
Migrations
Concurrency
Consistency
Cross-Module Data Access
Connection Management
Failure Handling
Testing
Observability
Security
```

El objetivo fundamental será permitir que los Modules persistan información sin convertir una tecnología de almacenamiento específica en parte obligatoria del Domain.

---

# 2. Declaración

La regla fundamental será:

> **La persistencia en MEF deberá respetar Ownership, Boundaries y Contracts, manteniendo las decisiones específicas de almacenamiento detrás de abstracciones explícitas y evitando que compartir infraestructura física implique compartir autoridad sobre los datos.**

Por tanto:

```text
Domain / Application
        │
        ▼
Persistence Contract
        │
        ▼
Repository / Port
        │
        ▼
Storage Adapter
        │
        ▼
Persistence Technology
```

y no:

```text
Business Logic
      ↓
Global Database
      ↓
Any Table
```

---

# 3. Persistence

Persistence representa la capacidad de mantener estado más allá del Lifetime inmediato de una operación o proceso.

Podrá utilizar:

```text
Relational Database
Document Database
Key-Value Store
Object Storage
Filesystem
Embedded Database
External Persistence Service
```

---

# 4. Technology Neutrality

MEF Core no deberá requerir una única tecnología de persistencia para todos los Modules.

---

# 5. Persistence Boundary

Todo acceso persistente deberá ocurrir dentro de una Boundary identificable.

---

# 6. Data Ownership

Todo conjunto de datos persistentes deberá poseer un Owner arquitectónico cuando forme parte de un Module.

Conceptualmente:

```text
MOD-CUSTOMER
      │
      ▼
Customer Data
```

---

# 7. Physical Storage ≠ Ownership

Compartir Database física no significa compartir Ownership.

```text
Database
├── customer_*
├── order_*
└── payment_*
```

puede seguir representando:

```text
MOD-CUSTOMER
MOD-ORDERS
MOD-PAYMENTS
```

con Ownership independiente.

---

# 8. Ownership Authority

El Module Owner será responsable de:

```text
data model
persistence contract
schema evolution
migrations
retention assumptions
compatibility
```

dentro de sus límites.

---

# 9. Cross-Module Data Ownership

Un Module no deberá asumir Ownership sobre datos pertenecientes a otro Module.

---

# 10. Cross-Module Table Access

Deberá evitarse:

```text
MOD-ORDERS
    ↓
SELECT *
FROM customer_private_table
```

si la tabla pertenece a:

```text
MOD-CUSTOMER
```

---

# 11. Correct Cross-Module Access

Preferir:

```text
MOD-ORDERS
     │
     ▼
Customer Contract
     │
     ▼
MOD-CUSTOMER
```

o:

```text
Customer Event
      ↓
Local Projection
      ↓
MOD-ORDERS
```

cuando corresponda.

---

# 12. Database Is Not a Contract

La existencia de una tabla compartida no deberá interpretarse como API pública.

---

# 13. Schema Is Not Automatically Public

Un Schema físico puede permanecer Implementation Detail.

---

# 14. Persistence Contract

El Domain/Application deberá depender de Contracts de persistencia cuando necesite almacenamiento.

---

# 15. Repository

`Repository` representa una abstracción orientada a conceptos del Domain/Application.

Ejemplo conceptual:

```text
CustomerRepository
├── findById()
├── save()
└── remove()
```

---

# 16. Repository ≠ Database Wrapper

Un Repository no deberá ser simplemente:

```text
query(table, sql)
```

expuesto al Domain.

---

# 17. Repository Language

Deberá favorecer lenguaje del Domain.

---

# 18. Repository Contract

Podrá definirse mediante ENG-021.

---

# 19. Repository Implementation

Una Implementation podrá utilizar:

```text
SQL
ORM
ODM
HTTP Persistence API
Filesystem
Memory
```

sin alterar necesariamente al Consumer.

---

# 20. Repository Ownership

El Repository Contract debería pertenecer a la Boundary que necesita expresar la operación.

---

# 21. Generic Repository

MEF no deberá imponer un `GenericRepository<T>` universal.

---

# 22. Why

Porque operaciones como:

```text
findAll()
updateAnyField()
deleteWhere()
```

pueden romper:

```text
Domain semantics
Authorization
Aggregate boundaries
Performance expectations
```

---

# 23. Persistence Port

Además de Repository podrán existir Ports especializados.

Ejemplos:

```text
BlobStore
KeyValueStore
DocumentStore
SequenceGenerator
LockStore
```

---

# 24. Storage Adapter

La implementación concreta deberá actuar como Adapter.

```text
Persistence Contract
        │
        ▼
   Storage Adapter
        │
        ▼
 PostgreSQL / MySQL / etc.
```

---

# 25. Adapter Boundary

Cambiar Adapter no deberá exigir modificar Business Logic cuando el Contract permanezca compatible.

---

# 26. ORM

Un ORM podrá utilizarse.

No deberá convertirse automáticamente en modelo de Domain.

---

# 27. ORM Entity ≠ Domain Entity

Deberá permitirse separar:

```text
Domain Model
```

de:

```text
Persistence Model
```

cuando resulte necesario.

---

# 28. Active Record

No será obligatorio.

---

# 29. Data Mapper

Podrá utilizarse.

---

# 30. Mapping Strategy

Será decisión del Module/Profile siempre que respete Contracts y Boundaries.

---

# 31. Persistence Model

Podrá representar:

```text
tables
documents
records
indexes
relations
storage metadata
```

---

# 32. Domain Model

No deberá contaminarse innecesariamente con detalles de almacenamiento.

---

# 33. Persistence Identity

Deberá distinguirse cuando sea necesario:

```text
Domain Identity
Database Primary Key
External Identity
```

---

# 34. Primary Key

No deberá convertirse automáticamente en identidad pública del Domain.

---

# 35. Identifier Stability

Los identificadores expuestos públicamente deberán seguir reglas de Compatibility.

---

# 36. Transaction

Una Transaction representa una unidad de trabajo atómica soportada por el Persistence Adapter.

---

# 37. Transaction Boundary

Deberá definirse explícitamente.

---

# 38. Transaction Manager

Podrá existir:

```text
TransactionManager
```

---

# 39. Transaction Contract

Conceptualmente:

```text
begin
commit
rollback
```

o una abstracción superior equivalente.

---

# 40. Prefer Scoped Transaction

Podrá favorecerse:

```text
transaction(function () {
    ...
});
```

sobre gestión manual cuando reduzca errores.

---

# 41. Transaction Ownership

La Application Layer será normalmente responsable de coordinar Transaction Boundary de un Use Case.

---

# 42. Domain Does Not Manage Connection

Domain Objects no deberán abrir/cerrar conexiones.

---

# 43. Repository Does Not Commit Arbitrarily

Un Repository no debería realizar Commit independiente cuando forma parte de una Transaction coordinada.

---

# 44. Atomicity

Operaciones que deban ser atómicas deberán compartir Transaction cuando el Storage lo permita.

---

# 45. Rollback

Failure antes de Commit deberá permitir Rollback cuando el Adapter lo soporte.

---

# 46. Rollback Failure

No deberá ocultar la Failure original.

---

# 47. Nested Transactions

No deberán asumirse como capacidad universal.

---

# 48. Savepoints

Podrán utilizarse cuando Adapter los soporte y Contract lo permita.

---

# 49. Transaction Capability

Adapters deberán declarar capacidades relevantes.

Ejemplo conceptual:

```text
CAP-PERSISTENCE-TRANSACTIONS
CAP-PERSISTENCE-SAVEPOINTS
```

si la nomenclatura se formaliza.

---

# 50. Unit of Work

MEF podrá soportar:

```text
UnitOfWork
```

cuando exista necesidad.

---

# 51. Unit of Work Purpose

Coordinar cambios relacionados antes de Commit.

---

# 52. Unit of Work ≠ Mandatory ORM

No deberá depender necesariamente de ORM.

---

# 53. UnitOfWork Contract

Conceptualmente:

```text
begin
register
commit
rollback
```

o mecanismo equivalente.

---

# 54. Repository + Unit of Work

Podrán colaborar:

```text
Application Service
       │
       ▼
   UnitOfWork
       │
   ┌───┴────┐
   ▼        ▼
Repo A    Repo B
   │        │
   └───┬────┘
       ▼
 Transaction
```

---

# 55. Transaction Scope

ENG-019 podrá proporcionar Scope asociado a Transaction.

---

# 56. Connection

Una conexión a Storage deberá administrarse como recurso infraestructural.

---

# 57. Connection Ownership

Business Logic no deberá administrar Connections directamente.

---

# 58. Connection Pool

Podrá utilizarse.

---

# 59. Pool Limits

Deberán configurarse explícitamente.

---

# 60. Unbounded Connections

No deberán permitirse como comportamiento por defecto.

---

# 61. Connection Lifetime

Deberá ser apropiado para el Runtime Profile.

---

# 62. Connection Leak

Deberá considerarse Failure operacional.

---

# 63. Connection Health

ENG-025 podrá observar Health del Pool/Adapter.

---

# 64. Persistence Configuration

ENG-011 será autoridad sobre Configuration.

---

# 65. Configuration Examples

Podrá incluir:

```text
driver
host
port
database
pool size
timeouts
retry policy
```

---

# 66. Credentials

No deberán almacenarse como Configuration pública ordinaria.

---

# 67. Secrets

ENG-024 gobernará:

```text
passwords
tokens
certificates
connection secrets
```

---

# 68. Secret Injection

Adapters deberán recibir Secrets mediante mecanismo seguro.

---

# 69. No Secret Logging

Credentials no deberán aparecer en Logs/Diagnostics.

---

# 70. Query Parameters

Datos externos deberán parametrizarse cuando la tecnología lo soporte.

---

# 71. SQL Injection

No deberá construirse SQL inseguro mediante concatenación de Input no confiable.

---

# 72. Storage Authorization

La autorización de negocio deberá aplicarse antes de operaciones sensibles cuando corresponda.

---

# 73. Database Credentials

Deberán aplicar Least Privilege.

---

# 74. Module Database Authority

Un Module debería poseer únicamente privilegios necesarios sobre sus estructuras.

---

# 75. Shared Credential

Deberá evitarse cuando elimine aislamiento útil entre Boundaries.

---

# 76. Encryption

ENG-024 gobernará requisitos de Encryption.

---

# 77. Data at Rest

Podrá requerirse Encryption según Classification/Policy.

---

# 78. Data in Transit

Las conexiones remotas deberán utilizar protección apropiada cuando Policy lo requiera.

---

# 79. Sensitive Data

Deberá manejarse según Security/Data Classification aplicable.

---

# 80. Logging Sensitive Data

Persistence Errors no deberán revelar valores sensibles innecesariamente.

---

# 81. Query Logging

Deberá permitir Redaction.

---

# 82. Schema Ownership

Cada estructura persistente deberá tener Owner identificable cuando forme parte del modelo gestionado por MEF.

---

# 83. Schema

`Schema` representa la estructura esperada por una versión de Persistence Model.

---

# 84. Schema Version

Deberá poder evolucionar.

---

# 85. Migration

Una `Migration` representa una transformación controlada de Persistence State/Schema.

---

# 86. Migration Ownership

Toda Migration deberá pertenecer al Module/Package responsable de los datos afectados.

---

# 87. Cross-Module Migration

Una Migration no deberá modificar estructuras de otro Module arbitrariamente.

---

# 88. Migration Identity

Toda Migration deberá poseer identidad estable.

---

# 89. Migration Ordering

Deberá existir orden determinista.

---

# 90. Migration History

El sistema deberá poder conocer qué Migrations fueron aplicadas.

---

# 91. Migration Ledger

Conceptualmente:

```text
MigrationLedger
├── migrationId
├── moduleId
├── version
├── appliedAt
└── checksum
```

---

# 92. Migration Checksum

Podrá utilizarse para detectar modificaciones posteriores.

---

# 93. Applied Migration Immutability

Una Migration ya aplicada no debería modificarse silenciosamente.

---

# 94. New Migration

Cambios posteriores deberán introducir nueva Migration.

---

# 95. Forward Migration

Será el mecanismo principal.

---

# 96. Down Migration

No deberá asumirse siempre segura o posible.

---

# 97. Destructive Migration

Deberá identificarse explícitamente.

---

# 98. Destructive Examples

```text
DROP TABLE
DROP COLUMN
data truncation
irreversible transformation
```

---

# 99. Production Migration

Podrá requerir Approval/Backup/Compatibility Gate.

---

# 100. Migration Validation

Deberá ocurrir antes de Deployment cuando sea posible.

---

# 101. Migration Dry Run

Tooling podrá soportar validación sin aplicar cambios.

---

# 102. Migration Transaction

Podrá ejecutarse transaccionalmente si Storage lo soporta.

---

# 103. Non-Transactional Migration

Deberá declarar riesgos y estrategia de Recovery.

---

# 104. Migration Failure

No deberá marcarse como aplicada si no completó correctamente.

---

# 105. Partial Migration

Deberá detectarse y requerir Recovery explícito.

---

# 106. Migration Concurrency

Dos procesos no deberán aplicar la misma Migration simultáneamente.

---

# 107. Migration Lock

Podrá utilizarse un Lock distribuido/DB cuando corresponda.

---

# 108. Migration Compatibility

Deployment deberá considerar coexistencia temporal entre:

```text
old application
new schema
new application
```

---

# 109. Expand/Contract

Para Rolling Deployments podrá utilizarse:

```text
Expand
  ↓
Deploy compatible code
  ↓
Migrate data
  ↓
Contract
```

---

# 110. Schema Compatibility

Cambios de Schema deberán evaluarse conforme ENG-016 cuando afecten versiones coexistentes.

---

# 111. Migration vs Seed

Deberán distinguirse:

```text
Migration
→ structural/evolution transformation

Seed
→ controlled initial/reference data
```

---

# 112. Seed

No deberá utilizarse como sustituto de Migration.

---

# 113. Seed Idempotency

Seeds reutilizables deberían ser idempotentes.

---

# 114. Production Seed

Deberá estar gobernado.

---

# 115. Fixtures

Testing Fixtures no deberán confundirse con Production Seeds.

---

# 116. Concurrency

Persistence deberá considerar acceso concurrente.

---

# 117. Lost Update

Deberá prevenirse cuando afecte Correctness.

---

# 118. Optimistic Concurrency

Podrá utilizar:

```text
version
etag
revision
```

---

# 119. Pessimistic Locking

Podrá utilizarse cuando esté justificado.

---

# 120. Lock Scope

Deberá mantenerse lo más reducido posible.

---

# 121. Lock Timeout

No deberá esperarse indefinidamente.

---

# 122. Deadlock

Deberá clasificarse como Failure potencialmente transitoria cuando corresponda.

---

# 123. Deadlock Retry

Podrá reintentarse mediante Policy limitada.

---

# 124. Retry Safety

No deberá repetirse una operación no idempotente sin analizar sus efectos.

---

# 125. Isolation Level

No deberá asumirse un único nivel para todos los Adapters.

---

# 126. Required Isolation

Un Use Case podrá declarar requisitos específicos cuando sea necesario.

---

# 127. Consistency

MEF deberá distinguir:

```text
Strong Consistency
Eventual Consistency
```

---

# 128. Local Transaction

Puede proporcionar Atomicity dentro de un Storage Boundary.

---

# 129. Distributed Transaction

No será requisito del Core inicial.

---

# 130. Cross-Module Transaction

Deberá evitarse como mecanismo arquitectónico predeterminado.

---

# 131. Why

Porque acopla:

```text
availability
storage technology
transaction manager
module lifecycle
```

entre Boundaries.

---

# 132. Cross-Module Consistency

Preferir cuando sea apropiado:

```text
Local Transaction
      ↓
Event
      ↓
Other Module
```

---

# 133. Eventual Consistency

Deberá ser explícita.

---

# 134. Outbox Pattern

MEF podrá soportar `Transactional Outbox`.

---

# 135. Outbox Purpose

Resolver el problema:

```text
Database Commit
+
Event Publication
```

sin requerir Distributed Transaction.

---

# 136. Outbox Flow

```text
Transaction
├── Business Data
└── Outbox Record
        ↓
Commit
        ↓
Publisher
        ↓
Event Bus
```

---

# 137. Outbox Ownership

El Module que produce el Event deberá poseer su Outbox Record.

---

# 138. Outbox Delivery

Deberá asumir potencialmente:

```text
at-least-once
```

salvo garantías superiores demostradas.

---

# 139. Consumer Idempotency

Consumers deberán considerar duplicados cuando Delivery lo permita.

---

# 140. Inbox Pattern

Podrá utilizarse para deduplicación.

---

# 141. Exactly Once

No deberá prometerse globalmente sin mecanismos que realmente lo garanticen.

---

# 142. Persistence Event

Un cambio persistente no deberá convertirse automáticamente en Domain Event.

---

# 143. Domain Event

Debe representar un hecho significativo del Domain.

---

# 144. CDC

Change Data Capture podrá existir como integración especializada.

No sustituye automáticamente Domain Events.

---

# 145. Read Models

Un Module podrá mantener Projections/Read Models.

---

# 146. CQRS

Podrá utilizarse.

No será obligatorio.

---

# 147. Command Model

Podrá diferir del Read Model.

---

# 148. Projection Ownership

Toda Projection deberá tener Owner.

---

# 149. Projection Rebuild

Deberá poder reconstruirse si se declara derivada.

---

# 150. Source of Truth

Toda Projection deberá indicar su Source of Truth.

---

# 151. Cache

Cache no deberá confundirse automáticamente con Persistence primaria.

---

# 152. Cache Authority

Una Cache normalmente será derivada.

---

# 153. Cache Failure

No deberá causar pérdida de Source of Truth.

---

# 154. Cache Invalidation

Deberá poseer estrategia explícita.

---

# 155. Persistence Adapter Capability

Un Adapter deberá declarar capacidades relevantes.

Conceptualmente:

```text
transactions
savepoints
locking
batching
streaming
schema migrations
```

---

# 156. Capability Discovery

Runtime podrá validar que Adapter satisface requisitos del Module.

---

# 157. Adapter Compatibility

ENG-016 deberá evaluar Compatibility cuando corresponda.

---

# 158. Adapter Replacement

Cambiar Adapter podrá requerir Data Migration aunque Contract permanezca igual.

---

# 159. Data Portability

No deberá asumirse automática.

---

# 160. Serialization

La representación persistente deberá tener formato definido.

---

# 161. Persistence Serialization

No deberá confundirse necesariamente con Serialization utilizada en APIs/Event Bus.

---

# 162. Stored Representation

Puede evolucionar independientemente del Contract público.

---

# 163. Serialization Compatibility

Los datos existentes deberán seguir siendo legibles o migrarse.

---

# 164. Nullability

Deberá tratarse explícitamente.

---

# 165. Defaults

Cambiar Defaults puede afectar datos históricos y deberá analizarse.

---

# 166. Enum Evolution

Eliminar/renombrar valores persistidos puede constituir Breaking Data Change.

---

# 167. Time

Timestamps deberán utilizar semántica clara.

---

# 168. Timezone

Deberá definirse explícitamente cuando sea relevante.

---

# 169. Monetary Values

No deberán almacenarse con tipos de precisión inadecuada.

---

# 170. Precision

Deberá preservarse según Domain Requirements.

---

# 171. Data Validation

Los datos deberán validarse antes de persistirse según Layer Responsibility.

---

# 172. Database Constraints

Podrán reforzar invariantes estructurales.

---

# 173. Constraints ≠ Domain Rules

No todas las reglas del Domain deberán delegarse a Database.

---

# 174. Unique Constraint

Puede utilizarse para garantizar unicidad bajo concurrencia.

---

# 175. Foreign Key

Podrá utilizarse dentro de Ownership Boundary.

---

# 176. Cross-Module Foreign Key

Deberá evitarse cuando genere acoplamiento de Lifecycle/Ownership entre Modules.

---

# 177. Referential Integrity

Entre Modules podrá mantenerse mediante Contracts/Events y reconciliación según Architecture.

---

# 178. Delete Semantics

Deberán definirse explícitamente:

```text
hard delete
soft delete
archive
anonymize
```

---

# 179. Soft Delete

No deberá asumirse como comportamiento universal.

---

# 180. Retention

Data Retention deberá obedecer Policy aplicable.

---

# 181. Purge

La eliminación definitiva deberá estar gobernada.

---

# 182. Audit

Auditing no deberá confundirse con Business History.

---

# 183. Audit Trail

Podrá registrar:

```text
who
what
when
result
```

según Security/Compliance.

---

# 184. Sensitive Audit

No deberá almacenar Secrets.

---

# 185. Backup

Persistence Profiles de producción deberán definir estrategia de Backup cuando corresponda.

---

# 186. Restore

Backup sin Restore probado no deberá considerarse garantía suficiente de Recovery.

---

# 187. Recovery Testing

Debería probarse periódicamente en sistemas críticos.

---

# 188. RPO

Podrá definirse:

```text
Recovery Point Objective
```

---

# 189. RTO

Podrá definirse:

```text
Recovery Time Objective
```

---

# 190. Core Scope

MEF Core no impondrá valores universales de RPO/RTO.

---

# 191. Error Handling

ENG-023 gobernará errores de Persistence.

---

# 192. Persistence Error Translation

Errores específicos del Driver no deberán filtrarse arbitrariamente al Domain.

---

# 193. Error Categories

Conceptualmente:

```text
ConnectionFailure
Timeout
ConstraintViolation
ConcurrencyConflict
TransactionFailure
MigrationFailure
StorageUnavailable
```

---

# 194. Transient Error

Podrá ser elegible para Retry.

---

# 195. Permanent Error

No deberá reintentarse automáticamente.

---

# 196. Unknown Error

Deberá conservar Cause para Diagnostics sin revelar internals al Consumer.

---

# 197. Error Namespace

ENG-030 utilizará:

```text
MEF-PST-xxx
```

---

# 198. Taxonomía ENG-030

```text
MEF-PST-001 Persistence configuration invalid
MEF-PST-002 Persistence adapter unavailable
MEF-PST-003 Persistence connection failed
MEF-PST-004 Persistence operation timed out
MEF-PST-005 Persistence contract violation
MEF-PST-006 Repository operation failed
MEF-PST-007 Transaction begin failed
MEF-PST-008 Transaction commit failed
MEF-PST-009 Transaction rollback failed
MEF-PST-010 Concurrency conflict
MEF-PST-011 Constraint violation
MEF-PST-012 Schema incompatible
MEF-PST-013 Migration invalid
MEF-PST-014 Migration failed
MEF-PST-015 Migration lock unavailable
MEF-PST-016 Migration checksum mismatch
MEF-PST-017 Cross-module data access violation
MEF-PST-018 Persistence permission denied
MEF-PST-019 Persistence resource exhausted
MEF-PST-020 Persistence invariant violated
```

---

# 199. Connection Failure

```text
MEF-PST-003

Persistence connection failed.

Adapter:
customer-primary

Module:
MOD-CUSTOMER
```

---

# 200. Concurrency Conflict

```text
MEF-PST-010

Concurrent modification detected.

Aggregate:
Customer

Expected version:
12

Actual version:
13
```

---

# 201. Migration Checksum

```text
MEF-PST-016

Applied migration checksum mismatch.

Module:
MOD-CUSTOMER

Migration:
20260810_001_add_customer_status
```

---

# 202. Cross-Module Access Violation

```text
MEF-PST-017

Cross-module persistence access denied.

Consumer:
MOD-ORDERS

Owner:
MOD-CUSTOMER

Resource:
customer_private
```

---

# 203. Resource Exhaustion

```text
MEF-PST-019

Persistence resource exhausted.

Resource:
connection-pool

Maximum:
50
```

---

# 204. Observability

ENG-025 deberá instrumentar Persistence sin exponer información sensible.

---

# 205. Persistence Metrics

Podrán incluir:

```text
mef.persistence.operations.total
mef.persistence.failures.total
mef.persistence.duration
mef.persistence.connections.active
mef.persistence.connections.waiting
mef.persistence.transactions.active
```

---

# 206. Query Metrics

Podrán agregarse por:

```text
adapter
operation
module
result
```

---

# 207. High Cardinality

No deberán utilizarse IDs de registros arbitrarios como Metric Labels.

---

# 208. Query Tracing

Podrá instrumentarse mediante Spans.

---

# 209. SQL in Trace

Deberá aplicar Redaction/Normalization.

---

# 210. Persistence Health

Podrá evaluar:

```text
connectivity
pool saturation
latency
migration status
```

---

# 211. Health Query

No deberá producir carga excesiva.

---

# 212. Performance

ENG-026 gobernará evaluación de Performance.

---

# 213. Persistence Hot Path

Deberá medirse con Workload representativo.

---

# 214. N+1 Queries

Deberán detectarse cuando degraden significativamente Performance.

---

# 215. Indexes

Deberán basarse en patrones reales de acceso.

---

# 216. Index Overuse

También puede degradar Writes y Storage.

---

# 217. Pagination

Listados potencialmente grandes deberán soportar estrategia limitada.

---

# 218. Unbounded Query

No deberá ser comportamiento predeterminado en APIs generales.

---

# 219. Batch Operations

Podrán utilizarse cuando mejoren Performance sin romper semántica.

---

# 220. Streaming

Podrá utilizarse para conjuntos grandes.

---

# 221. Memory Safety

No deberán cargarse datasets arbitrariamente grandes en Memory sin límites.

---

# 222. Query Timeout

Deberá existir donde la tecnología lo permita.

---

# 223. Retry

Deberá ser limitado y medido.

---

# 224. Retry Storm

Deberá evitarse.

---

# 225. Backoff

Podrá utilizarse para Failures transitorias.

---

# 226. Circuit Breaker

Podrá aplicarse a Persistence remoto cuando corresponda.

---

# 227. Testing

ENG-009 deberá soportar Persistence Tests.

---

# 228. Repository Unit Test

Business Logic debería poder probarse mediante Fake/In-Memory Contract cuando sea apropiado.

---

# 229. Fake Repository

Deberá respetar semántica relevante del Contract.

---

# 230. Fake Limitations

No deberá considerarse sustituto de Integration Tests.

---

# 231. Integration Test

Deberá probar Adapter real cuando sea relevante.

---

# 232. Migration Test

Deberá probar Migrations desde estados soportados.

---

# 233. Migration Upgrade Test

Conceptualmente:

```text
Schema N
   ↓
Migration
   ↓
Schema N+1
```

---

# 234. Data Compatibility Test

Deberá comprobar lectura de datos previos cuando Compatibility lo requiera.

---

# 235. Concurrency Test

Deberá probar conflictos relevantes.

---

# 236. Transaction Test

Deberá comprobar Commit/Rollback.

---

# 237. Isolation Test

Deberá comprobar que un Module no acceda directamente a Persistence privada de otro.

---

# 238. Security Test

Deberá verificar Credentials/Permissions.

---

# 239. Performance Test

Deberá utilizar datasets representativos.

---

# 240. Test Database

Podrá utilizar Database efímera.

---

# 241. Production Data in Tests

No deberá utilizarse sin controles apropiados.

---

# 242. Test Data

Deberá evitar datos sensibles reales cuando no sean necesarios.

---

# 243. Runtime Integration

ENG-027 deberá inicializar Persistence Infrastructure antes de Modules que la requieran.

---

# 244. Runtime Readiness

Persistence crítica no disponible podrá impedir Readiness.

---

# 245. Optional Persistence

Un Module opcional podrá quedar degradado si su Storage no está disponible y Policy lo permite.

---

# 246. Runtime Shutdown

Deberá permitir:

```text
stop new work
finish/abort transactions
flush pending operations
close connections
dispose pools
```

---

# 247. Shutdown Transaction

No deberá iniciarse trabajo persistente nuevo durante Shutdown salvo Cleanup explícito.

---

# 248. Connection Drain

Podrá permitirse periodo limitado.

---

# 249. Module Integration

ENG-028 gobernará Ownership de Persistence por Module.

---

# 250. Module Manifest

Podrá declarar Requirements conceptuales:

```yaml
persistence:
  required: true
  capabilities:
    - transactions
```

---

# 251. Adapter Selection

Podrá resolverse mediante ENG-029 Extension Points.

---

# 252. Persistence Extension Point

Conceptualmente:

```text
XP-PERSISTENCE-ADAPTER-001
```

podrá permitir diferentes Drivers.

---

# 253. Extension Security

Un Persistence Adapter externo deberá pasar Trust/Security Validation.

---

# 254. Registry Integration

ENG-020 podrá registrar:

```text
Persistence Adapters
Schemas
Migration Sets
Capabilities
Ownership
```

---

# 255. Container Integration

ENG-019 podrá construir:

```text
Repositories
Transaction Managers
UnitOfWork
Connections
Adapters
```

con Scopes adecuados.

---

# 256. DI Integration

Business/Application Services deberán recibir Persistence Contracts mediante DI.

---

# 257. Event Bus Integration

ENG-022 podrá utilizar Outbox/Inbox cuando el Profile lo soporte.

---

# 258. Event Publication

No deberá publicarse un Event que depende de una Transaction antes de garantizar la semántica requerida.

---

# 259. Transaction + Event

El problema deberá resolverse explícitamente mediante:

```text
Outbox
Transaction Coordinator
Equivalent proven mechanism
```

cuando se requiera Atomicity.

---

# 260. CLI Integration

ENG-007 podrá incorporar:

```text
mef persistence status
mef persistence validate
mef persistence adapters
mef migration status
mef migration plan
mef migration apply
mef migration verify
```

---

# 261. `persistence status`

Podrá mostrar:

```text
Adapter
Health
Pool
Latency
Migration Status
```

sin Credentials.

---

# 262. `persistence validate`

Podrá comprobar Configuration/Connectivity/Capabilities.

---

# 263. `migration status`

Podrá mostrar:

```text
Applied
Pending
Failed
Checksum mismatch
```

---

# 264. `migration plan`

Deberá permitir inspeccionar cambios antes de aplicarlos.

---

# 265. `migration apply`

Deberá aplicar Migrations pendientes autorizadas.

---

# 266. Production Confirmation

ENG-007/ENG-024 podrán requerir controles adicionales para Production.

---

# 267. Machine Output

Los comandos deberán soportar formato estructurado.

---

# 268. Build Integration

ENG-012 podrá validar:

```text
Migration syntax
Migration ordering
Schema compatibility
Duplicate migration IDs
```

---

# 269. Release Integration

ENG-017 deberá considerar Migrations en Release.

---

# 270. Release Artifact

Deberá incluir las Migrations necesarias para esa versión.

---

# 271. Release Notes

Cambios destructivos deberán documentarse.

---

# 272. Deployment Order

Cuando exista Schema Change deberá definirse orden compatible.

---

# 273. Migration Gate

Una Release podrá bloquearse por Migration incompatible.

---

# 274. Backup Gate

Migrations destructivas podrán requerir Backup verificado según Policy.

---

# 275. First Implementation

La primera implementación deberá incluir conceptualmente:

```text
PersistenceAdapter
PersistenceCapability

Repository Contract Support

TransactionManager
Transaction

Migration
MigrationId
MigrationSet
MigrationLedger
MigrationRunner
MigrationValidator

ConnectionProvider
PersistenceHealth
```

---

# 276. Optional Initial Components

Podrán incorporarse:

```text
UnitOfWork
Outbox
Inbox
OptimisticLock
```

cuando exista necesidad inmediata.

---

# 277. Conceptual Directory Structure

```text
src/
└── Persistence/
    ├── Contract/
    │   ├── Repository
    │   └── PersistenceAdapter
    │
    ├── Transaction/
    │   ├── Transaction
    │   └── TransactionManager
    │
    ├── Connection/
    │   └── ConnectionProvider
    │
    ├── Migration/
    │   ├── Migration
    │   ├── MigrationId
    │   ├── MigrationSet
    │   ├── MigrationLedger
    │   ├── MigrationRunner
    │   └── MigrationValidator
    │
    ├── Concurrency/
    │   └── OptimisticLock
    │
    ├── Messaging/
    │   ├── Outbox
    │   └── Inbox
    │
    └── Health/
        └── PersistenceHealth
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 278. Persistence Architecture

```text
                DOMAIN
                   │
                   ▼
            APPLICATION
                   │
                   ▼
        PERSISTENCE CONTRACT
                   │
                   ▼
              REPOSITORY
                   │
                   ▼
          STORAGE ADAPTER
                   │
          ┌────────┼────────┐
          ▼        ▼        ▼
         SQL    Document   Object
        Store     Store     Store
```

---

# 279. Transaction Architecture

```text
Application Use Case
        │
        ▼
 Transaction Manager
        │
        ▼
    Transaction
     ┌──┴───┐
     ▼      ▼
   Repo A  Repo B
     │      │
     └──┬───┘
        ▼
      Commit
```

---

# 280. Module Data Architecture

```text
MOD-CUSTOMER
     │
     ▼
Customer Repository
     │
     ▼
Customer Storage
     │
     X  direct access prohibited
     │
MOD-ORDERS
```

La colaboración correcta será:

```text
MOD-ORDERS
     │
     ▼
Customer Contract
     │
     ▼
MOD-CUSTOMER
```

---

# 281. Migration Architecture

```text
Module Release
      │
      ▼
Migration Set
      │
      ▼
Validation
      │
      ▼
Migration Lock
      │
      ▼
Migration Runner
      │
      ▼
Storage
      │
      ▼
Migration Ledger
```

---

# 282. Outbox Architecture

```text
Application
     │
     ▼
 Transaction
 ┌───┴──────────┐
 ▼              ▼
Business Data   Outbox
 └──────┬───────┘
        ▼
      Commit
        │
        ▼
 Outbox Publisher
        │
        ▼
    Event Bus
```

---

# 283. Persistence Security Architecture

```text
Module
  │
  ▼
Persistence Contract
  │
  ▼
Authorized Adapter
  │
  ▼
Scoped Credential
  │
  ▼
Owned Data
```

---

# 284. Persistence Failure Architecture

```text
Driver Failure
      │
      ▼
Adapter Translation
      │
      ▼
MEF Persistence Error
      │
 ┌────┴─────┐
 ▼          ▼
Transient  Permanent
 │          │
 ▼          ▼
Retry      Fail
bounded
```

---

# 285. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Data Ownership
Repository Contracts
Storage Adapters
Local Transactions
Deterministic Migrations
Migration Ledger
Parameterized Queries
Bounded Connections
Logical Module Isolation
Static Persistence Configuration
```

---

# 286. First Version Non-Goals

No deberá requerir:

```text
Distributed Transactions
Multi-Master Replication
Automatic Sharding
Global Event Sourcing
Automatic CQRS
Live Schema Reconciliation
Dynamic Database Switching
Universal ORM
```

---

# 287. Second Phase

Podrá incorporar:

```text
Outbox/Inbox
Advanced Concurrency
Read Replicas
Projection Infrastructure
Migration Impact Analysis
Advanced Query Diagnostics
```

---

# 288. Third Phase

Solo cuando exista necesidad:

```text
Sharding
Multi-Tenancy Infrastructure
Distributed Transactions
Event Store
CDC Infrastructure
Data Federation
Cross-Region Persistence
```

---

# 289. Invariantes de Ingeniería

ENG-030 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-546 | Todo conjunto de datos persistentes gestionado por un Module deberá poseer Ownership arquitectónico identificable. |
| EI-547 | Compartir infraestructura física de almacenamiento no deberá interpretarse como compartir Ownership o autoridad sobre los datos. |
| EI-548 | Un Module no deberá acceder directamente a estructuras persistentes privadas de otro Module como mecanismo ordinario de integración. |
| EI-549 | La Database o Schema físico no deberá utilizarse implícitamente como Contract público entre Modules. |
| EI-550 | Business Logic deberá depender de Persistence Contracts y no de Drivers, Connections o tecnologías concretas cuando exista Boundary de abstracción. |
| EI-551 | Repositories deberán expresar semántica de su Boundary y no convertirse obligatoriamente en Wrappers CRUD genéricos. |
| EI-552 | Transaction Boundaries deberán ser explícitas y no depender accidentalmente de Commits internos arbitrarios. |
| EI-553 | Domain Objects no deberán administrar Connections o Transaction Infrastructure directamente. |
| EI-554 | Una Failure de Rollback no deberá ocultar la Failure primaria que originó la Transaction Failure. |
| EI-555 | Connections, Pools, Queries y Retries deberán poseer límites operacionales apropiados y no crecer o esperar indefinidamente por defecto. |
| EI-556 | Credentials y Secrets de Persistence deberán gobernarse mediante ENG-024 y no exponerse en Logs o Diagnostics. |
| EI-557 | Toda Migration deberá poseer identidad, Ownership y orden determinista. |
| EI-558 | Una Migration aplicada no deberá modificarse silenciosamente de forma que invalide su historial verificable. |
| EI-559 | Migrations no deberán modificar estructuras persistentes pertenecientes a otro Module sin un mecanismo explícitamente gobernado. |
| EI-560 | Cambios destructivos de Schema deberán identificarse y someterse a controles superiores a una Migration ordinaria cuando la Policy lo requiera. |
| EI-561 | Las estrategias de concurrencia deberán preservar los invariantes de negocio relevantes y no asumir ausencia de operaciones concurrentes. |
| EI-562 | Cross-Module Consistency no deberá depender por defecto de Distributed Transactions; deberán favorecerse Boundaries locales y mecanismos explícitos de integración cuando sean adecuados. |
| EI-563 | Una garantía de `exactly-once` no deberá declararse salvo que los mecanismos implementados realmente la proporcionen dentro del alcance definido. |
| EI-564 | Persistence Telemetry no deberá revelar Credentials, Secrets o datos sensibles innecesarios. |
| EI-565 | La primera implementación deberá favorecer Persistence explícita, local, limitada y verificable antes de introducir infraestructura distribuida avanzada. |

---

# 290. Continuidad de Invariantes

```text
ENG-026 → EI-466 a EI-485
ENG-027 → EI-486 a EI-505
ENG-028 → EI-506 a EI-525
ENG-029 → EI-526 a EI-545
ENG-030 → EI-546 a EI-565
```

---

# 291. Criterios de Conformidad

Una implementación será conforme con ENG-030 cuando:

- defina Data Ownership;
- preserve Module Boundaries;
- no utilice Database como Contract implícito;
- permita Repository Contracts;
- permita Storage Adapters;
- desacople Domain de Driver;
- defina Transaction Boundaries;
- gestione Connections como recursos;
- limite Pools/Timeouts;
- proteja Credentials;
- parametrice Input cuando corresponda;
- defina Schema Ownership;
- implemente Migration identity;
- implemente Migration ordering;
- mantenga Migration history;
- detecte modificaciones indebidas de Migrations aplicadas;
- gestione Migration concurrency;
- contemple Concurrency de datos;
- traduzca Driver Errors;
- instrumente Persistence;
- soporte Testing;
- integre Runtime;
- integre Security;
- permita Shutdown limpio;
- no requiera Distributed Transactions.

---

# 292. Riesgos

Deberán evitarse especialmente:

## Database as API

Los Modules se integran leyendo tablas de otros.

## Global Repository

Un Repository permite acceder a cualquier Entity.

## Generic CRUD Everywhere

La persistencia sustituye la semántica del Domain.

## ORM as Domain

Business Logic queda acoplada al ORM.

## Hidden Commit

Repository realiza Commit inesperadamente.

## Long Transaction

Una Transaction permanece abierta durante operaciones externas lentas.

## Unbounded Pool

Connections crecen sin límite.

## Infinite Retry

Storage Failure produce Retry Storm.

## Credentials in Config

Passwords aparecen en archivos o Logs.

## Shared Superuser

Todos los Modules utilizan credenciales con acceso total.

## Migration Mutation

Se modifica una Migration ya aplicada.

## Cross-Module Migration

Un Module cambia tablas de otro.

## Destructive Migration Without Gate

Se destruyen datos sin control.

## Fake Equals Real Database

Tests pasan con Fake pero fallan por semántica real del Storage.

## Distributed Transaction by Default

Modules quedan fuertemente acoplados.

## Exactly-Once Claim

Se promete una garantía que el sistema no puede demostrar.

## Query Telemetry Leak

Logs contienen datos personales o Secrets.

## Shared Schema Means Shared Ownership

La topología física destruye Boundaries lógicas.

---

# 293. Relación con ENG-018

Dependency Injection suministra Repositories, Transaction Managers y Persistence Ports.

---

# 294. Relación con ENG-019

Service Container administra:

```text
Adapters
Repositories
Transactions
Connections
Scopes
```

sin convertirse en Persistence Engine.

---

# 295. Relación con ENG-020

Registry podrá conocer:

```text
Adapters
Capabilities
Schemas
Migration Sets
Ownership
```

---

# 296. Relación con ENG-021

Persistence Contracts deberán obedecer Contract Engineering.

---

# 297. Relación con ENG-022

Event Bus se integra especialmente mediante:

```text
Outbox
Inbox
Eventual Consistency
```

---

# 298. Relación con ENG-023

Persistence deberá traducir Driver Failures a Error Contracts estables.

---

# 299. Relación con ENG-024

Security gobierna:

```text
Credentials
Secrets
Permissions
Encryption
Sensitive Data
Audit
```

---

# 300. Relación con ENG-025

Observability gobierna:

```text
Persistence Metrics
Tracing
Health
Diagnostics
Redaction
```

---

# 301. Relación con ENG-026

Performance Engineering mide:

```text
Queries
Transactions
Pool Saturation
Latency
Throughput
Migration Performance
```

---

# 302. Relación con ENG-027

Runtime coordina:

```text
Persistence initialization
Validation
Readiness
Health
Shutdown
```

---

# 303. Relación con ENG-028

Module Engineering define Ownership y Boundary.

Persistence Engineering aplica esos principios a los datos.

---

# 304. Relación con ENG-029

Extension Engineering podrá permitir diferentes Persistence Adapters sin modificar Consumers.

---

# 305. Principio Rector

> **La persistencia en MEF deberá preservar la autonomía de los Modules y la integridad de sus datos mediante Ownership explícito, Contracts de almacenamiento, Transactions controladas, Migrations verificables y Adapters sustituibles, sin convertir una Database compartida en una API arquitectónica global.**

---

# 306. Conclusión

**ENG-030 — Persistence Engineering** formaliza la primera gran infraestructura de datos de MEF.

La arquitectura queda:

```text
                   MODULE
                      │
                      ▼
               APPLICATION
                      │
                      ▼
            PERSISTENCE CONTRACT
                      │
             ┌────────┴────────┐
             ▼                 ▼
         Repository      Transaction
             │                 │
             └────────┬────────┘
                      ▼
               Storage Adapter
                      │
                      ▼
                 Persistence
```

A nivel de Ownership:

```text
MOD-CUSTOMER ─────► Customer Data
MOD-ORDERS   ─────► Order Data
MOD-PAYMENTS ─────► Payment Data
```

aunque físicamente puedan residir en:

```text
          SAME DATABASE
               │
     ┌─────────┼─────────┐
     ▼         ▼         ▼
 Customer    Orders    Payments
```

La Database compartida no destruye los Boundaries.

La evolución de datos queda:

```text
Schema
  ↓
Migration
  ↓
Validation
  ↓
Lock
  ↓
Apply
  ↓
Ledger
  ↓
Verification
```

Y para integración entre Modules:

```text
Module A
   │
   ├── Local Transaction
   │
   └── Outbox
          │
          ▼
       Event Bus
          │
          ▼
       Module B
```

en lugar de utilizar por defecto:

```text
Global Distributed Transaction
```

La primera implementación deberá concentrarse en:

```text
Data Ownership
Repository Contracts
Storage Adapters
Local Transactions
Migration System
Connection Management
Concurrency Control
Security
Observability
Testing
```

antes de introducir:

```text
Sharding
CDC
Event Sourcing
Distributed Transactions
Multi-Region Storage
Data Federation
```

Con ENG-030 la serie global alcanza:

```text
EI-565
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
- ENG-029 — Extension Engineering