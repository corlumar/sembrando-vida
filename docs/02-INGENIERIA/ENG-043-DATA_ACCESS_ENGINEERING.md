---
id: ENG-043
titulo: Data Access Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Access Engineering
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
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-042
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-040
  - ENG-041
  - ENG-044
keywords:
  - data-access
  - repository
  - query
  - query-object
  - criteria
  - specification
  - data-mapper
  - identity-map
  - pagination
  - cursor
  - projection
  - read-model
  - eager-loading
  - lazy-loading
  - n-plus-one
  - sql
  - tenant-filter
  - query-budget
  - mef
---

# ENG-043

# Data Access Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Access Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-043 establece las reglas para:

```text
Repository
Repository Contract
Data Mapper
Identity Map
Query
Query Object
Criteria
Specification
Filtering
Sorting
Pagination
Cursor Pagination
Projection
Read Model
Aggregate Loading
Aggregate Persistence
Lazy Loading
Eager Loading
Batch Loading
N+1 Detection
Query Budget
Query Timeout
Database Round Trips
Raw Query
SQL Safety
Parameter Binding
Tenant Filtering
Soft Delete
Data Scope
Read/Write Separation
Query Observability
Query Performance
Data Access Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo acceso a datos deberá atravesar una Boundary explícita, segura, observable y alineada con el modelo que consume los datos, sin permitir que detalles del mecanismo de persistencia contaminen Domain o Application.**

La arquitectura conceptual será:

```text
Application
    │
    ├──────────────┐
    │              │
    ▼              ▼
Repository      Query Service
    │              │
    ▼              ▼
Domain Model     Read Model
    │              │
    └──────┬───────┘
           ▼
     Data Access
           │
           ▼
       Adapter
           │
           ▼
     Data Source
```

---

# 3. Data Access

`Data Access` representa el conjunto de mecanismos utilizados para consultar y modificar información persistida.

---

# 4. Data Access ≠ Persistence

La separación será:

```text
ENG-030 Persistence
→ cómo se almacena el estado

ENG-043 Data Access
→ cómo el software consulta y modifica ese estado
```

---

# 5. Data Access ≠ Transaction

```text
ENG-042 Transaction
→ consistency boundary

ENG-043 Data Access
→ operations performed against persisted state
```

---

# 6. Data Access ≠ Domain

Domain deberá expresar:

```text
business concepts
business invariants
aggregate behavior
```

y no:

```text
SQL
table names
ORM queries
joins
database connections
```

---

# 7. Data Access Boundary

Toda operación deberá atravesar una Boundary conocida.

Ejemplos:

```text
Repository
Query Service
Read Model Provider
Persistence Gateway
```

---

# 8. Boundary Ownership

Application deberá seleccionar la abstracción apropiada según el Use Case.

---

# 9. Repository

Un `Repository` representa una colección conceptual de Aggregates o Domain Objects.

---

# 10. Repository Purpose

Deberá permitir a Domain/Application trabajar con conceptos del modelo sin conocer Storage Mechanics.

---

# 11. Repository Contract

Ejemplo conceptual:

```text
OrderRepository
    findById(OrderId)
    save(Order)
    remove(Order)
```

---

# 12. Repository Language

Deberá utilizar lenguaje del Domain.

Preferir:

```text
findActiveCustomerById()
```

sobre:

```text
selectCustomerWhereStatusEquals1()
```

---

# 13. Repository Scope

Un Repository deberá normalmente corresponder a:

```text
Aggregate Root
```

y no necesariamente a cada tabla.

---

# 14. Repository per Table

No deberá ser Pattern Default.

---

# 15. Generic Repository

Un Repository genérico universal:

```text
Repository<T>
    find()
    insert()
    update()
    delete()
```

no deberá sustituir Contracts significativos del Domain.

---

# 16. Repository Contract Stability

No deberá exponer tipos específicos del ORM.

---

# 17. ORM Leakage

No deberá retornar:

```text
QueryBuilder
EntityManager
DatabaseConnection
ORMCollection
```

hacia Domain.

---

# 18. Persistence Entity

Si la implementación utiliza Persistence Models separados, éstos no deberán escapar de Infrastructure.

---

# 19. Aggregate Loading

Un Repository deberá reconstruir un Aggregate válido.

---

# 20. Partial Aggregate

No deberá devolverse un Aggregate incompleto que pueda violar Invariants.

---

# 21. Aggregate Persistence

`save(Aggregate)` deberá respetar la Transaction Boundary de ENG-042.

---

# 22. Save Semantics

Deberá definirse si `save()`:

```text
registers change
```

o:

```text
immediately writes
```

---

# 23. Flush

Cuando exista Unit of Work:

```text
save()
→ register

flush()
→ synchronize

commit()
→ durable
```

---

# 24. Flush ≠ Commit

No deberán confundirse.

---

# 25. Delete

La semántica deberá distinguir:

```text
physical delete
soft delete
business deactivation
```

---

# 26. Business Deactivation

No deberá implementarse automáticamente como Database Delete.

---

# 27. Data Mapper

Un `Data Mapper` transforma entre:

```text
Domain Representation
↕
Persistence Representation
```

---

# 28. Mapper Responsibility

Podrá manejar:

```text
field mapping
value objects
identifier mapping
persistence metadata
```

---

# 29. Mapper Non-Responsibility

No deberá contener Business Rules sustantivas.

---

# 30. Mapping Failure

Deberá producir Error explícito.

---

# 31. Mapping Invariant

Un registro persistido inválido no deberá convertirse silenciosamente en un Domain Object válido.

---

# 32. Identity Map

Un `Identity Map` garantiza, dentro de Scope apropiado:

```text
same identity
→ same in-memory object instance
```

cuando dicha semántica sea necesaria.

---

# 33. Identity Map Scope

Normalmente deberá estar acotado a:

```text
Unit of Work
Transaction
Request
```

según implementación.

---

# 34. Global Identity Map

No deberá existir.

---

# 35. Identity Map Memory

Deberá liberarse al finalizar Scope.

---

# 36. Query

Una `Query` representa una solicitud de lectura de datos.

---

# 37. Query Side Effects

Una Query no deberá modificar Business State observable.

---

# 38. CQRS Principle

MEF podrá separar:

```text
Command Model
Read Model
```

sin requerir CQRS completo.

---

# 39. Query Service

Un `Query Service` podrá acceder directamente a Read Models optimizados.

---

# 40. Query Service ≠ Repository

```text
Repository
→ Aggregate/Domain access

Query Service
→ use-case-oriented reading
```

---

# 41. Read Model

Un `Read Model` representa datos preparados para consumo.

---

# 42. Read Model Shape

Podrá coincidir directamente con necesidades de:

```text
API
UI
Report
Export
Dashboard
```

---

# 43. Read Model Domain Independence

No deberá forzarse la construcción de Aggregates completos para consultas que no requieren comportamiento de Domain.

---

# 44. Projection

Una `Projection` contiene únicamente campos requeridos.

---

# 45. Projection Example

```text
CustomerSummary
├── id
├── name
├── status
└── totalOrders
```

---

# 46. Projection Benefit

Reduce:

```text
data transfer
memory
mapping
database work
```

---

# 47. Query Object

Un `Query Object` encapsula una consulta compleja o reutilizable.

---

# 48. Query Object Contract

Conceptualmente:

```text
Query<TCriteria, TResult>
```

---

# 49. Query Object Purpose

Deberá evitar dispersar lógica compleja de consulta en Controllers o Services.

---

# 50. Criteria

`Criteria` representa restricciones estructuradas de una Query.

---

# 51. Criteria Example

```text
CustomerCriteria
├── status
├── region
├── createdAfter
└── createdBefore
```

---

# 52. Criteria Validation

ENG-036 deberá validar Criteria antes de construir Query física.

---

# 53. Criteria ≠ SQL Fragment

No deberá aceptar SQL arbitrario.

---

# 54. Specification

Una `Specification` representa una condición reusable y composable.

---

# 55. Specification Example

```text
ActiveCustomer
AND
LocatedInRegion
AND
CreatedAfterDate
```

---

# 56. Domain Specification

Podrá representar Business Predicate.

---

# 57. Query Specification

Podrá representar Predicate traducible a Data Source.

---

# 58. Specification Leakage

No deberá acoplar Domain Specification a sintaxis SQL.

---

# 59. Specification Composition

Podrá soportar:

```text
AND
OR
NOT
```

---

# 60. Specification Complexity

No deberá convertirse en un lenguaje de consultas universal innecesario.

---

# 61. Filtering

Filtering deberá utilizar campos permitidos explícitamente.

---

# 62. Arbitrary Field Filtering

No deberá exponerse automáticamente.

---

# 63. Filter Registry

Podrá existir:

```text
allowed filter
→ field/expression
```

---

# 64. Filter Type

Cada Filter deberá conocer:

```text
type
operator
validation
```

---

# 65. Operators

Podrán incluir:

```text
EQ
NE
GT
GTE
LT
LTE
IN
BETWEEN
CONTAINS
STARTS_WITH
```

cuando sean seguros y necesarios.

---

# 66. Arbitrary Operator

No deberá aceptarse directamente desde Input sin Allowlist.

---

# 67. Sorting

Sorting deberá utilizar campos permitidos.

---

# 68. Sort Direction

Normalmente:

```text
ASC
DESC
```

---

# 69. Stable Sorting

Toda Pagination deberá utilizar orden determinístico.

---

# 70. Tie Breaker

Deberá agregarse identificador estable cuando el campo principal no sea único.

Ejemplo:

```text
ORDER BY created_at DESC, id DESC
```

---

# 71. Pagination

Deberá evitar cargar colecciones ilimitadas.

---

# 72. Offset Pagination

Conceptualmente:

```text
LIMIT
OFFSET
```

---

# 73. Offset Pagination Use

Adecuada para:

```text
small/medium datasets
administrative tables
random page navigation
```

---

# 74. Offset Cost

Offsets altos pueden degradar Performance.

---

# 75. Offset Consistency

Inserciones/eliminaciones concurrentes pueden provocar:

```text
duplicates
missing rows
```

entre páginas.

---

# 76. Cursor Pagination

Deberá favorecerse para:

```text
large datasets
feeds
streams
high write rates
```

---

# 77. Cursor

Un Cursor deberá representar posición lógica estable.

---

# 78. Cursor Opaqueness

El cliente no deberá depender de su estructura interna.

---

# 79. Cursor Integrity

Deberá impedir manipulación cuando contenga State sensible.

---

# 80. Cursor Contents

Podrá contener:

```text
sort values
tie-breaker id
direction
version
```

---

# 81. Cursor Encoding

ENG-031 podrá gobernar Encoding.

---

# 82. Cursor Expiration

Podrá aplicarse cuando corresponda.

---

# 83. Page Size

Deberá tener:

```text
default
maximum
```

---

# 84. Unlimited Page Size

No deberá permitirse.

---

# 85. Total Count

No deberá calcularse automáticamente cuando sea costoso y no necesario.

---

# 86. Count Query

Deberá observarse como Query independiente.

---

# 87. Projection Pagination

Deberá ejecutarse sobre Projection cuando sea posible.

---

# 88. Lazy Loading

Carga datos cuando se accede a una relación.

---

# 89. Lazy Loading Risk

Puede ocultar Database Round Trips.

---

# 90. Default Policy

MEF deberá evitar Lazy Loading implícito en Boundaries críticas.

---

# 91. Lazy Loading Outside Transaction

Puede fallar o producir comportamiento impredecible.

---

# 92. Serialization + Lazy Loading

No deberá provocar Queries accidentales durante Serialization.

---

# 93. Eager Loading

Carga relaciones requeridas anticipadamente.

---

# 94. Eager Loading Risk

Cargar demasiadas relaciones puede producir:

```text
large joins
row multiplication
memory growth
```

---

# 95. Explicit Fetch Plan

Deberá favorecerse.

---

# 96. Fetch Plan

Conceptualmente:

```text
OrderFetchPlan
├── customer
├── lines
└── payments
```

---

# 97. Fetch Plan Scope

Deberá responder a un Use Case concreto.

---

# 98. Batch Loading

Permite cargar múltiples relaciones en pocas Queries.

---

# 99. Batch Loading Example

```text
100 orders
+
1 query customers
+
1 query lines
```

en lugar de:

```text
1 + 100 + 100 queries
```

---

# 100. N+1

El problema N+1 ocurre cuando:

```text
1 query parent
+
N queries children
```

---

# 101. N+1 Policy

Deberá detectarse y evitarse en caminos críticos.

---

# 102. N+1 Detection

Podrá utilizar:

```text
query counter
tracing
test assertions
development diagnostics
```

---

# 103. Query Budget

Un Use Case podrá declarar número máximo razonable de Queries.

---

# 104. Query Budget Example

```text
GET /orders
≤ 5 database round trips
```

---

# 105. Query Budget Purpose

Detectar regresiones antes de Production.

---

# 106. Query Budget ≠ Universal Constant

Deberá depender del Use Case.

---

# 107. Database Round Trip

Deberá tratarse como operación costosa.

---

# 108. Loop Query

No deberá ejecutarse una Query remota dentro de un Loop cuando pueda utilizarse Batch.

---

# 109. Query Timeout

Toda Query potencialmente costosa deberá poseer Timeout.

---

# 110. Query Timeout ≠ Transaction Timeout

Podrán ser diferentes.

---

# 111. Statement Timeout

Adapter podrá mapear Query Timeout a mecanismo del Provider.

---

# 112. Cancellation

Deberá propagarse cuando el Driver lo soporte.

---

# 113. Abandoned Query

Una Request cancelada no debería continuar consumiendo Database innecesariamente.

---

# 114. Query Deadline

Podrá derivarse del Deadline del Use Case.

---

# 115. Query Complexity

Deberá controlarse especialmente para Queries construidas desde Input.

---

# 116. Query Cost

Podrá estimarse o limitarse cuando la infraestructura lo permita.

---

# 117. Query Plan

Queries críticas deberán poder analizarse mediante Execution Plan.

---

# 118. Explain

Herramientas de diagnóstico podrán ejecutar:

```text
EXPLAIN
EXPLAIN ANALYZE
```

únicamente bajo controles apropiados.

---

# 119. Production Explain Analyze

Deberá utilizarse con precaución.

---

# 120. Index Awareness

Data Access deberá considerar índices requeridos por Queries críticas.

---

# 121. Index Ownership

El diseño físico pertenece principalmente a Persistence/Database Engineering, pero Data Access deberá documentar necesidades.

---

# 122. Missing Index

Podrá manifestarse mediante:

```text
slow query
high scanned rows
high CPU
lock duration
```

---

# 123. Over-Indexing

También puede perjudicar Writes.

---

# 124. Select Star

No deberá utilizarse indiscriminadamente en Read Models.

---

# 125. Column Projection

Deberá seleccionar únicamente datos necesarios cuando sea razonable.

---

# 126. Large Column

Campos grandes deberán cargarse únicamente cuando se necesiten.

---

# 127. BLOB

No deberá viajar en List Queries salvo necesidad explícita.

---

# 128. Raw Query

Podrá utilizarse cuando:

```text
ORM abstraction is insufficient
performance requires it
provider feature is needed
```

---

# 129. Raw Query Boundary

Deberá permanecer en Infrastructure/Data Access.

---

# 130. Raw SQL Review

Queries críticas deberán revisarse.

---

# 131. Parameter Binding

Todo valor no estructural deberá utilizar Binding.

---

# 132. SQL Concatenation

No deberá concatenarse Input directamente.

---

# 133. Dynamic Identifier

Table/Column/Order identifiers no pueden protegerse únicamente con Parameter Binding.

---

# 134. Identifier Allowlist

Deberán mapearse mediante Allowlist.

---

# 135. SQL Injection

ENG-024 gobernará controles de Security.

---

# 136. LIKE Input

Deberá manejar correctamente Wildcards y Escaping según semántica.

---

# 137. IN Clause

Listas deberán limitarse.

---

# 138. Large IN

Podrá reemplazarse por:

```text
temporary table
join
batch
provider-specific mechanism
```

cuando sea apropiado.

---

# 139. Empty IN

Deberá poseer semántica determinística.

---

# 140. Query Builder

Podrá utilizarse dentro de Adapter.

---

# 141. Query Builder Exposure

No deberá escapar hacia Domain.

---

# 142. ORM

MEF podrá integrarse con ORM.

---

# 143. ORM ≠ Architecture

El ORM será implementación, no arquitectura del Domain.

---

# 144. ORM Model

No deberá convertirse automáticamente en Domain Entity.

---

# 145. Active Record

Podrá utilizarse en aplicaciones simples cuando esté explícitamente aceptado.

---

# 146. Active Record Restriction

No deberá imponerse al Core arquitectónico.

---

# 147. Data Mapper Default

Para Domain complejo deberá favorecerse separación mediante Mapper/Repository.

---

# 148. Read/Write Separation

MEF podrá utilizar Data Sources distintos para:

```text
reads
writes
```

---

# 149. Primary

Writes deberán dirigirse al Source autorizado.

---

# 150. Replica

Reads podrán dirigirse a Replica cuando el Use Case tolere Replication Lag.

---

# 151. Read-After-Write

No deberá asumirse consistencia inmediata desde Replica.

---

# 152. Consistency Requirement

Cada Query crítica deberá poder declarar:

```text
STRONG
EVENTUAL
```

o semántica equivalente.

---

# 153. Strong Read

Podrá forzar Primary.

---

# 154. Eventual Read

Podrá utilizar Replica.

---

# 155. Replica Lag

Deberá ser observable.

---

# 156. Failover

No deberá cambiar silenciosamente Consistency Semantics.

---

# 157. Read Routing

Podrá depender de:

```text
consistency requirement
transaction context
tenant
region
```

---

# 158. Transaction Read Routing

Una Query dentro de Transaction deberá utilizar Resource compatible con dicha Transaction.

---

# 159. Replica Inside Write Transaction

No deberá utilizarse accidentalmente.

---

# 160. Sharding

Podrá existir cuando sea necesario.

---

# 161. Shard Key

Deberá ser explícita.

---

# 162. Cross-Shard Query

Deberá considerarse operación especial.

---

# 163. Scatter-Gather

No deberá utilizarse indiscriminadamente.

---

# 164. Shard Routing

Deberá ocurrir antes de ejecutar Query.

---

# 165. Tenant as Shard Key

Podrá utilizarse cuando el modelo lo permita.

---

# 166. Tenant Isolation

Toda Query Tenant-Scoped deberá aplicar Tenant Boundary.

---

# 167. Tenant Filter

Deberá ser estructural y difícil de omitir accidentalmente.

---

# 168. Tenant Filter Example

Conceptualmente:

```text
TenantScopedRepository
```

o:

```text
TenantAwareQueryExecutor
```

---

# 169. Tenant Input

No deberá confiarse directamente en Tenant ID recibido del cliente.

---

# 170. Tenant Context

ENG-024 deberá proporcionar Tenant Context autorizado.

---

# 171. Cross-Tenant Access

Deberá requerir Capability administrativa explícita.

---

# 172. Cross-Tenant Query

Deberá ser distinguible y auditable.

---

# 173. Global Scope

No deberá utilizarse accidentalmente para operaciones administrativas Cross-Tenant.

---

# 174. Soft Delete

Podrá utilizarse cuando exista necesidad.

---

# 175. Soft Delete Filter

Los registros eliminados deberán excluirse por Default cuando corresponda.

---

# 176. Include Deleted

Deberá ser operación explícita.

---

# 177. Soft Delete ≠ Security

No deberá utilizarse como mecanismo de Authorization.

---

# 178. Soft Delete Uniqueness

Deberá analizar restricciones únicas.

---

# 179. Restore

Deberá preservar Business Invariants.

---

# 180. Data Scope

Una Query podrá estar limitada por:

```text
tenant
organization
region
ownership
authorization
```

---

# 181. Data Scope ≠ Filter UI

Es un control de acceso, no una preferencia de visualización.

---

# 182. Authorization Filter

Deberá aplicarse antes de retornar resultados.

---

# 183. Post-Filter Authorization

No deberá utilizarse como estrategia principal para grandes conjuntos.

---

# 184. Row-Level Security

Podrá reforzar Data Scope.

---

# 185. Defense in Depth

Application Filtering + Database RLS podrán coexistir.

---

# 186. RLS Context

Deberá limpiarse al reutilizar Connection.

---

# 187. Sensitive Columns

No deberán seleccionarse si el Use Case no las necesita.

---

# 188. Field-Level Authorization

Podrá requerirse para ciertos Read Models.

---

# 189. Data Masking

Podrá aplicarse en:

```text
query
projection
serialization
```

según arquitectura.

---

# 190. Audit Query

Accesos sensibles podrán requerir Audit.

---

# 191. Query Observability

ENG-025 gobernará Telemetry.

---

# 192. Query Metrics

Podrán incluir:

```text
mef.data.queries.total
mef.data.query.duration
mef.data.query.failed.total
```

---

# 193. Round Trip Metrics

Podrán incluir:

```text
mef.data.roundtrips.total
```

---

# 194. Slow Query Metrics

Podrán incluir:

```text
mef.data.slow_queries.total
```

---

# 195. Timeout Metrics

Podrán incluir:

```text
mef.data.query_timeout.total
```

---

# 196. N+1 Metrics

Podrán existir en Development/Test.

---

# 197. Query Labels

Podrán incluir:

```text
queryName
repository
operation
result
```

si poseen Cardinality acotada.

---

# 198. Raw SQL Metric Label

No deberá utilizarse.

---

# 199. Parameter Metric Label

Tampoco.

---

# 200. Query Name

Toda Query importante deberá poseer nombre lógico estable.

Ejemplo:

```text
orders.list-by-customer
```

---

# 201. Trace Span

Cada Database Round Trip podrá producir Span.

---

# 202. Trace Attributes

Podrán incluir:

```text
db.system
operation
queryName
rowCount
```

según Security Policy.

---

# 203. SQL in Trace

Deberá obedecer Redaction Policy.

---

# 204. Bind Parameters

No deberán registrarse indiscriminadamente.

---

# 205. PII

No deberá aparecer en Telemetry sin necesidad.

---

# 206. Slow Query Log

Podrá registrar Query Template sanitizado.

---

# 207. Query Fingerprint

Podrá utilizarse para agrupar Queries equivalentes.

---

# 208. Cardinality

No deberá generarse una métrica distinta por cada SQL dinámico.

---

# 209. Performance

ENG-026 gobernará Performance.

---

# 210. Performance Baseline

Queries críticas deberán poseer Baseline.

---

# 211. Query Regression

Deberá detectarse mediante:

```text
duration
round trips
rows scanned
rows returned
query plan
```

cuando sea posible.

---

# 212. Query Result Size

Deberá limitarse.

---

# 213. Unbounded Collection

No deberá materializarse.

---

# 214. Streaming Result

Podrá utilizarse para grandes conjuntos.

---

# 215. Streaming Transaction

Deberá considerar duración de Connection/Transaction.

---

# 216. Streaming Backpressure

Deberá integrarse con ENG-039.

---

# 217. Export

Grandes Exportaciones deberán utilizar:

```text
cursor
streaming
batching
background job
```

según volumen.

---

# 218. Report Query

No deberá degradar Workload transaccional crítico.

---

# 219. Analytical Workload

Podrá utilizar Data Source separado.

---

# 220. Connection Pool

Data Access deberá utilizar Pool cuando corresponda.

---

# 221. Pool Ownership

ENG-030/ENG-027 gobernarán Lifecycle.

---

# 222. Pool Exhaustion

Deberá tratarse como Failure operacional explícito.

---

# 223. Connection Leak

Deberá detectarse.

---

# 224. Query Cancellation

Una Connection cancelada deberá volver a State reutilizable o descartarse.

---

# 225. Prepared Statement

Podrá utilizarse para:

```text
security
performance
plan reuse
```

---

# 226. Prepared Statement Cache

Deberá ser acotado.

---

# 227. Database Plan Cache

Queries altamente dinámicas deberán considerar impacto sobre Plan Cache.

---

# 228. Bulk Read

Deberá favorecerse sobre Reads individuales repetitivos.

---

# 229. Bulk Write

Podrá utilizarse cuando Business Invariants lo permitan.

---

# 230. Bulk Write Warning

No deberá saltarse Domain Rules accidentalmente.

---

# 231. Bulk Update

Deberá ser explícito.

---

# 232. Bulk Delete

También.

---

# 233. Bulk Operation Audit

Operaciones administrativas sensibles deberán ser auditables.

---

# 234. Query Cache

ENG-037 gobernará Caching.

---

# 235. Cache ≠ Data Access Source of Truth

Data Source autoritativo deberá permanecer definido.

---

# 236. Cached Read Model

Podrá utilizarse.

---

# 237. Cache Key

Deberá incluir Scope necesario:

```text
tenant
query
version
```

---

# 238. Cache Invalidation

Deberá alinearse con Transaction Commit.

---

# 239. Cache Stampede

ENG-037/ENG-039 gobernarán mitigación.

---

# 240. Error Handling

ENG-023 gobernará Error Translation.

---

# 241. Error Namespace

ENG-043 utilizará:

```text
MEF-DAT-xxx
```

---

# 242. Taxonomía ENG-043

```text
MEF-DAT-001 Data source unavailable
MEF-DAT-002 Query execution failed
MEF-DAT-003 Query timeout
MEF-DAT-004 Query cancelled
MEF-DAT-005 Mapping failed
MEF-DAT-006 Invalid criteria
MEF-DAT-007 Unsupported filter
MEF-DAT-008 Unsupported sort
MEF-DAT-009 Invalid pagination
MEF-DAT-010 Invalid cursor
MEF-DAT-011 Cursor expired
MEF-DAT-012 Result limit exceeded
MEF-DAT-013 Query budget exceeded
MEF-DAT-014 N+1 detected
MEF-DAT-015 Data scope violation
MEF-DAT-016 Tenant scope missing
MEF-DAT-017 Cross-tenant access denied
MEF-DAT-018 Unsafe raw query
MEF-DAT-019 Invalid parameter binding
MEF-DAT-020 Read consistency unavailable
MEF-DAT-021 Replica unavailable
MEF-DAT-022 Replica lag exceeded
MEF-DAT-023 Shard unavailable
MEF-DAT-024 Shard routing failed
MEF-DAT-025 Connection pool exhausted
MEF-DAT-026 Connection state invalid
MEF-DAT-027 Repository contract violation
MEF-DAT-028 Query contract violation
MEF-DAT-029 Data access security violation
MEF-DAT-030 Data access invariant violation
```

---

# 243. Query Timeout Example

```text
MEF-DAT-003

Data query exceeded configured timeout.

Query:
orders.list-by-customer

Timeout:
2s
```

---

# 244. N+1 Example

```text
MEF-DAT-014

Potential N+1 query pattern detected.

Operation:
orders.list

Queries:
101

Budget:
5
```

---

# 245. Tenant Scope Example

```text
MEF-DAT-016

Tenant-scoped query executed without
an authorized tenant context.

Query:
customers.list
```

---

# 246. Unsafe Query Example

```text
MEF-DAT-018

Unsafe raw query rejected.

Reason:
untrusted dynamic identifier
```

---

# 247. Replica Lag Example

```text
MEF-DAT-022

Replica lag exceeds query consistency policy.

Query:
order.read-after-create
```

---

# 248. Security

ENG-024 gobernará:

```text
SQL injection
tenant isolation
data authorization
sensitive fields
audit
credentials
```

---

# 249. Database Credentials

No deberán almacenarse en Query Objects.

---

# 250. Credential Scope

Deberá aplicarse Least Privilege.

---

# 251. Read Credentials

Podrán diferenciarse de Write Credentials.

---

# 252. Administrative Credentials

No deberán utilizarse para Runtime normal.

---

# 253. Parameterization

Será obligatoria para valores externos.

---

# 254. Dynamic Query Structure

Deberá construirse mediante Allowlist.

---

# 255. Tenant Enforcement

No deberá depender únicamente de que cada Developer recuerde agregar:

```text
WHERE tenant_id = ?
```

---

# 256. Data Exfiltration

Query APIs deberán limitar:

```text
fields
filters
sorting
page size
scope
```

---

# 257. Timing Leakage

Podrá considerarse para Queries sensibles.

---

# 258. Query Error Exposure

No deberá revelar:

```text
SQL
schema names
table names
credentials
internal topology
```

al cliente.

---

# 259. Testing

ENG-009 gobernará Testing.

---

# 260. Repository Contract Test

Cada Adapter deberá cumplir el mismo Repository Contract.

---

# 261. Mapper Test

Deberá comprobar:

```text
persistence → domain
domain → persistence
```

---

# 262. Invalid Persistence Test

Datos inválidos deberán producir Failure explícito.

---

# 263. Query Object Test

Deberá probar Criteria y resultados.

---

# 264. Filter Test

Deberá comprobar Allowlist.

---

# 265. Sort Test

También.

---

# 266. Pagination Test

Deberá comprobar:

```text
first page
middle page
last page
empty page
maximum size
```

---

# 267. Cursor Test

Deberá comprobar:

```text
forward
backward
invalid
tampered
expired
```

---

# 268. Stable Pagination Test

Inserciones concurrentes deberán analizarse.

---

# 269. N+1 Test

Deberá comprobar Query Budget.

---

# 270. Batch Loading Test

Deberá comprobar reducción de Round Trips.

---

# 271. Lazy Loading Test

No deberá ejecutar Queries inesperadas fuera de Scope.

---

# 272. Query Timeout Test

Deberá comprobar Cancellation.

---

# 273. SQL Injection Test

Deberá comprobar:

```text
filter values
sort fields
dynamic identifiers
raw query parameters
```

---

# 274. Tenant Isolation Test

Será obligatorio.

---

# 275. Cross-Tenant Test

Deberá intentar acceder a datos de otro Tenant.

---

# 276. Soft Delete Test

Deberá comprobar Default Scope y Restore.

---

# 277. Read Replica Test

Deberá comprobar Consistency Policy.

---

# 278. Read-After-Write Test

Deberá comprobar Routing al Source correcto.

---

# 279. Transaction Integration Test

Queries dentro de Transaction deberán utilizar Connection compatible.

---

# 280. Connection Cleanup Test

Deberá comprobar:

```text
transaction state
tenant context
session variables
```

---

# 281. Pool Exhaustion Test

Deberá comprobar Failure controlado.

---

# 282. Performance Test

Queries críticas deberán probar:

```text
latency
round trips
result size
memory
```

---

# 283. Load Test

Deberá medir:

```text
queries/sec
pool utilization
database saturation
p95
p99
```

---

# 284. Fault Injection

Podrá simular:

```text
database unavailable
connection reset
query timeout
replica lag
pool exhaustion
shard unavailable
```

---

# 285. Architecture Test

Podrá impedir:

```text
Domain → SQL
Domain → ORM Query Builder
Domain → Database Connection
Application Controller → Raw SQL
```

---

# 286. Build Integration

ENG-012 podrá validar:

```text
unsafe dynamic query
unbounded page size
missing tenant scope
unsupported sort
invalid query definition
```

cuando sea detectable estáticamente.

---

# 287. CLI

ENG-007 podrá proporcionar:

```text
mef data:queries
mef data:repositories
mef data:sources
mef data:status
mef data:slow
mef data:diagnose
mef data:explain <query>
```

---

# 288. CLI Explain

Deberá operar únicamente sobre Queries registradas/autorizadas.

---

# 289. CLI Raw SQL

No deberá formar parte del Core Default.

---

# 290. Configuration

ENG-011 podrá definir:

```text
data-access:
  default-source: primary

  query:
    timeout: 2s
    max-page-size: 100
    slow-threshold: 500ms

  pagination:
    default-size: 25
    cursor:
      enabled: true

  safety:
    raw-query: restricted
    tenant-scope: required

  diagnostics:
    query-budget: true
    n-plus-one: development
```

---

# 291. Configuration Validation

Deberá comprobar:

```text
timeout > 0
page size bounded
valid source
valid consistency policy
valid tenant policy
```

---

# 292. Registry Integration

ENG-020 podrá registrar:

```text
RepositoryDefinition
QueryDefinition
DataSourceDefinition
FilterDefinition
ProjectionDefinition
```

---

# 293. Repository Definition

Conceptualmente:

```text
RepositoryDefinition
├── contract
├── implementation
├── aggregate
├── source
└── metadata
```

---

# 294. Query Definition

Conceptualmente:

```text
QueryDefinition
├── name
├── criteria
├── result
├── source
├── consistency
├── timeout
└── budget
```

---

# 295. Data Source Definition

Conceptualmente:

```text
DataSourceDefinition
├── id
├── role
├── adapter
├── capabilities
└── metadata
```

---

# 296. Filter Definition

Conceptualmente:

```text
FilterDefinition
├── publicName
├── internalExpression
├── type
└── allowedOperators
```

---

# 297. Projection Definition

Conceptualmente:

```text
ProjectionDefinition
├── name
├── fields
├── source
└── mapper
```

---

# 298. Bootstrap

ENG-027 deberá construir Data Access Infrastructure.

---

# 299. Bootstrap Flow

```text
Load Configuration
       │
       ▼
Discover Data Sources
       │
       ▼
Discover Repositories
       │
       ▼
Discover Queries
       │
       ▼
Validate Filters
       │
       ▼
Validate Security Scope
       │
       ▼
Build Data Access Registry
       │
       ▼
Build Adapters
       │
       ▼
Readiness
```

---

# 300. Bootstrap Validation

Deberá detectar:

```text
duplicate query name
missing repository implementation
unknown data source
invalid filter
invalid projection
invalid consistency policy
invalid tenant policy
```

---

# 301. Module Integration

ENG-028 permitirá registrar:

```text
Repositories
Queries
Read Models
Projections
Filters
```

---

# 302. Module Boundary

Un Module no deberá consultar tablas privadas de otro Module directamente salvo Contract arquitectónico explícito.

---

# 303. Cross-Module Read

Deberá utilizar preferentemente:

```text
public query contract
read model
integration contract
```

---

# 304. Shared Database

Compartir Database no elimina Module Boundaries.

---

# 305. Foreign Table Access

Deberá considerarse dependencia arquitectónica.

---

# 306. Cross-Module Join

No deberá realizarse indiscriminadamente.

---

# 307. Reporting Exception

Read Models de Reporting podrán integrar múltiples Modules bajo Boundary explícita.

---

# 308. Reporting Model

No deberá convertirse en camino de escritura Cross-Module.

---

# 309. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Repository
RepositoryDefinition

Query
QueryName
QueryDefinition
QueryExecutor
QueryContext

Criteria
Filter
FilterOperator
Sort
SortDirection

Page
PageRequest
PageSize

Cursor
CursorPage
CursorCodec

Projection
ReadModel

DataMapper

DataSource
DataSourceDefinition
ReadConsistency

QueryTimeout
QueryBudget

DataAccessError
```

---

# 310. Optional Initial Components

Podrán incorporarse:

```text
Specification
IdentityMap
FetchPlan
BatchLoader
QueryCounter
NPlusOneDetector
```

---

# 311. Later Components

Solo cuando exista necesidad demostrada:

```text
Sharding
Cross-Shard Query
Advanced Query Planner
Federated Query
Distributed Read Model
Advanced RLS Integration
```

---

# 312. Conceptual Directory Structure

```text
src/
└── DataAccess/
    ├── Contract/
    │   ├── Repository
    │   ├── Query
    │   ├── QueryExecutor
    │   └── DataMapper
    │
    ├── Query/
    │   ├── QueryName
    │   ├── QueryDefinition
    │   ├── QueryContext
    │   ├── Criteria
    │   ├── Filter
    │   ├── FilterOperator
    │   ├── Sort
    │   └── SortDirection
    │
    ├── Pagination/
    │   ├── Page
    │   ├── PageRequest
    │   ├── PageSize
    │   ├── Cursor
    │   ├── CursorPage
    │   └── CursorCodec
    │
    ├── Projection/
    │   ├── Projection
    │   └── ReadModel
    │
    ├── Mapping/
    │   └── DataMapper
    │
    ├── Repository/
    │   └── RepositoryDefinition
    │
    ├── Source/
    │   ├── DataSource
    │   ├── DataSourceDefinition
    │   └── ReadConsistency
    │
    ├── Performance/
    │   ├── QueryTimeout
    │   ├── QueryBudget
    │   ├── QueryCounter
    │   └── NPlusOneDetector
    │
    └── Error/
        └── DataAccessError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 313. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Repository Contracts
Aggregate-Oriented Repositories
Use-Case Query Services
Explicit Projections
Criteria
Allowlisted Filtering
Allowlisted Sorting
Bounded Pagination
Cursor Pagination
Stable Ordering
Explicit Fetch Plans
Batch Loading
N+1 Detection
Query Timeouts
Query Budgets
Parameter Binding
Tenant Enforcement
Read Consistency
Observability
Security
```

---

# 314. First Version Non-Goals

No deberá requerir:

```text
Universal Generic Repository
Universal Specification Language
Automatic Lazy Loading
Unlimited Query API
Automatic Cross-Module Joins
Distributed Query Engine
Federated Database Layer
Custom ORM
Custom SQL Engine
Automatic Sharding
```

---

# 315. Second Phase

Podrá incorporar:

```text
Identity Map
Advanced Specification
Advanced Fetch Plans
Read Replica Routing
Query Plan Diagnostics
Advanced Bulk Operations
```

---

# 316. Third Phase

Solo cuando exista necesidad demostrada:

```text
Sharding
Federated Query
Distributed Read Models
Cross-Region Reads
Advanced Query Planner
```

---

# 317. Invariantes de Ingeniería

ENG-043 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-806 | Todo acceso persistente deberá atravesar una Data Access Boundary explícita, segura y observable. |
| EI-807 | Domain no deberá depender de SQL, ORM Query Builders, Database Connections ni detalles físicos de Storage. |
| EI-808 | Repositories deberán representar conceptos del Domain/Aggregate y no utilizarse por Default como wrappers genéricos de tablas. |
| EI-809 | Query Services y Read Models podrán evitar reconstruir Aggregates completos cuando el Use Case sea exclusivamente de lectura. |
| EI-810 | Data Mappers no deberán introducir Business Rules ni ocultar datos persistidos incompatibles con Domain Invariants. |
| EI-811 | Filtering y Sorting expuestos a Input deberán utilizar Allowlist, tipos y Operators explícitos. |
| EI-812 | Toda Pagination deberá poseer Page Size acotado y Ordering determinístico. |
| EI-813 | Cursor Pagination deberá utilizar posición estable, Cursor opaco y protección contra manipulación cuando corresponda. |
| EI-814 | Lazy Loading implícito no deberá ocultar Database Round Trips ni ejecutarse accidentalmente durante Serialization. |
| EI-815 | Queries en caminos críticos deberán utilizar Fetch Plans, Batch Loading o estrategia equivalente para evitar N+1. |
| EI-816 | Use Cases críticos podrán imponer Query Budgets y toda Query potencialmente costosa deberá poseer Timeout/Deadline apropiado. |
| EI-817 | Raw Queries deberán permanecer dentro de Data Access/Infrastructure y todo Input no estructural deberá utilizar Parameter Binding. |
| EI-818 | Identifiers y estructura dinámica de Query deberán seleccionarse mediante Allowlist y nunca concatenarse directamente desde Input no confiable. |
| EI-819 | Toda Query Tenant-Scoped deberá aplicar Tenant/Data Scope estructural basado en Context autorizado y no únicamente en Input del cliente. |
| EI-820 | Read Routing deberá preservar Consistency Requirements y no deberá enviar accidentalmente Read-After-Write a Replica con Lag incompatible. |
| EI-821 | Data Access deberá limitar Result Size, Round Trips, Memory y Connection Usage, evitando colecciones y Buffers ilimitados. |
| EI-822 | Query Telemetry deberá ser útil sin exponer SQL sensible, Bind Parameters, PII ni Cardinality no controlada. |
| EI-823 | Compartir una Database no deberá permitir acceso arbitrario a tablas privadas de otros Modules ni eliminar Module Boundaries. |
| EI-824 | Data Access Tests deberán cubrir Security, Tenant Isolation, Pagination, N+1, Timeout, Transaction Integration y Failure Modes. |
| EI-825 | La primera implementación deberá favorecer Repositories explícitos, Query Services, Projections, bounded Pagination, Parameter Binding, Tenant Enforcement y Query Observability antes de introducir Sharding, Federated Queries o abstracciones universales. |

---

# 318. Continuidad de Invariantes

```text
ENG-039 → EI-726 a EI-745
ENG-040 → EI-746 a EI-765
ENG-041 → EI-766 a EI-785
ENG-042 → EI-786 a EI-805
ENG-043 → EI-806 a EI-825
```

---

# 319. Criterios de Conformidad

Una implementación será conforme con ENG-043 cuando:

- utilice Data Access Boundaries explícitas;
- Domain permanezca independiente de SQL/ORM;
- utilice Repositories orientados a Aggregates;
- diferencie Repository de Query Service;
- permita Read Models y Projections;
- implemente Criteria;
- limite Filters y Operators;
- limite Sorting;
- implemente Pagination acotada;
- utilice Ordering estable;
- soporte Cursor Pagination cuando corresponda;
- evite Lazy Loading implícito crítico;
- permita Fetch Plans;
- utilice Batch Loading;
- detecte N+1;
- soporte Query Budget;
- soporte Query Timeout;
- limite Result Size;
- utilice Parameter Binding;
- controle Raw Queries;
- aplique Tenant Scope estructural;
- preserve Read Consistency;
- integre Transaction Context;
- observe Query Performance;
- proteja datos sensibles;
- respete Module Boundaries;
- pruebe Security y Failure Modes.

---

# 320. Riesgos

Deberán evitarse especialmente:

## Repository per Table

La arquitectura se convierte en reflejo del Schema físico.

## Universal Generic Repository

Se pierde lenguaje del Domain.

## ORM Leakage

Domain/Application quedan acoplados al proveedor.

## Partial Aggregate

Se reconstruye un Aggregate incapaz de proteger sus Invariants.

## Query Logic in Controller

Filtering, Sorting y Joins quedan dispersos.

## Arbitrary Filter API

El cliente controla indirectamente estructura de Query.

## Arbitrary Sort

Puede utilizar columnas no indexadas o sensibles.

## Unlimited Pagination

Una Request puede materializar millones de registros.

## Unstable Pagination

Los resultados cambian o se duplican entre páginas.

## Hidden Lazy Loading

Serialization dispara cientos de Queries.

## N+1

Una colección pequeña genera decenas o cientos de Round Trips.

## Query in Loop

Escala linealmente en Round Trips.

## Select Star

Se recuperan datos innecesarios o sensibles.

## Raw SQL Concatenation

Se introduce SQL Injection.

## Tenant Filter by Convention

Un Developer puede olvidar el filtro y provocar Data Leakage.

## Replica Read-After-Write

El usuario no observa su propia modificación.

## Cross-Module SQL

Un Module depende del Schema privado de otro.

## ORM as Domain Model

Cambios de Persistence alteran Business Model.

## Database as API

Cualquier Module consulta cualquier tabla.

## Query Without Timeout

Una consulta defectuosa consume recursos indefinidamente.

## Sensitive Query Logging

PII o Secrets aparecen en Telemetry.

---

# 321. Relación con ENG-030

La separación será:

```text
ENG-030 Persistence
→ storage and persistence architecture

ENG-043 Data Access
→ controlled access patterns over persisted state
```

---

# 322. Relación con ENG-042

```text
ENG-042 Transaction
→ consistency boundary

ENG-043 Data Access
→ reads/writes participating in that boundary
```

Una Query dentro de Transaction deberá utilizar el Resource asociado a dicha Transaction.

---

# 323. Relación con ENG-034

Application decidirá:

```text
which repository
which query
which projection
which consistency requirement
```

---

# 324. Relación con ENG-035

Domain podrá declarar Repository Contracts necesarios para Aggregates, pero no conocerá implementación física.

---

# 325. Relación con ENG-036

Validation gobernará:

```text
criteria
filters
sorting
pagination
cursor input
```

---

# 326. Relación con ENG-037

Caching podrá acelerar Read Models sin sustituir Source of Truth.

---

# 327. Relación con ENG-038

Concurrency gobernará conflictos producidos por Reads/Writes concurrentes.

---

# 328. Relación con ENG-039

Resilience gobernará:

```text
timeout
retry
backpressure
load shedding
```

sin convertir automáticamente toda Query fallida en Retryable.

---

# 329. Relación con ENG-040

Jobs de procesamiento masivo deberán utilizar:

```text
cursor
batching
bounded memory
short transactions
```

---

# 330. Relación con ENG-041

Consumers podrán utilizar Repositories y Queries dentro de su Message Processing Boundary.

---

# 331. Relación con ENG-024

Security gobernará:

```text
tenant
authorization
SQL safety
data classification
audit
```

---

# 332. Relación con ENG-025

Observability gobernará:

```text
query duration
round trips
query errors
timeouts
N+1
pool saturation
```

---

# 333. Relación con ENG-026

Performance gobernará:

```text
latency
throughput
memory
batching
query regression
```

---

# 334. Relación con ENG-028

Modules deberán exponer Contracts en lugar de permitir acceso directo indiscriminado a su Schema privado.

---

# 335. Relación con ENG-044

ENG-044 deberá formalizar **API Engineering**.

La separación será:

```text
Data Access
→ internal access to persisted data

Application
→ use-case orchestration

API
→ external interface exposed to consumers
```

ENG-044 deberá cubrir:

```text
API Contract
Endpoint
Resource
Request
Response
HTTP Semantics
Status Codes
Headers
Content Negotiation
API Versioning
Pagination Contract
Filtering Contract
Sorting Contract
Error Contract
Idempotency
Rate Limiting
Authentication Integration
Authorization Integration
Validation Integration
CORS
Caching Headers
ETag
Conditional Requests
API Observability
OpenAPI
API Testing
Backward Compatibility
Deprecation
```

---

# 336. Principio Rector

> **MEF deberá tratar Data Access como una Boundary arquitectónica controlada y no como acceso libre al Storage: Repositories protegerán el modelo de escritura, Query Services optimizarán el modelo de lectura y toda consulta deberá respetar Scope, Security, Performance, Consistency y Observability.**

---

# 337. Conclusión

**ENG-043 — Data Access Engineering** formaliza cómo MEF accede al estado persistido sin convertir la Database, el ORM o SQL en la arquitectura de la aplicación.

La arquitectura principal queda:

```text
                         APPLICATION
                             │
                ┌────────────┴────────────┐
                │                         │
                ▼                         ▼
           WRITE MODEL                READ MODEL
                │                         │
                ▼                         ▼
           REPOSITORY                QUERY SERVICE
                │                         │
                ▼                         ▼
           AGGREGATE                  PROJECTION
                │                         │
                └────────────┬────────────┘
                             │
                             ▼
                       DATA ACCESS
                             │
                             ▼
                          ADAPTER
                             │
                             ▼
                        DATA SOURCE
```

La relación con Transactions queda:

```text
APPLICATION USE CASE
        │
        ▼
TRANSACTION BOUNDARY
        │
        ├── Repository Read
        ├── Repository Write
        ├── Unit of Work
        └── Outbox
        │
        ▼
      COMMIT
```

La estrategia de lectura queda:

```text
Client Need
    │
    ▼
Query Service
    │
    ▼
Criteria
    │
    ├── Filters
    ├── Sorting
    ├── Pagination
    └── Consistency
    │
    ▼
Projection
    │
    ▼
Read Model
```

La estrategia de seguridad queda:

```text
Authorized Context
        │
        ├── Tenant Scope
        ├── Data Scope
        ├── Allowed Filters
        ├── Allowed Sorts
        └── Field Authorization
        │
        ▼
      QUERY
```

La estrategia de Performance queda:

```text
Query
 │
 ├── Projection
 ├── Stable Pagination
 ├── Fetch Plan
 ├── Batch Loading
 ├── Query Timeout
 ├── Query Budget
 └── Observability
```

La separación conceptual queda:

```text
Repository
→ Aggregate-oriented data access

Query Service
→ use-case-oriented read access

Data Mapper
→ persistence/domain translation

Identity Map
→ object identity inside bounded scope

Criteria
→ structured query restrictions

Specification
→ reusable predicate

Projection
→ selected result shape

Read Model
→ data optimized for consumption

Offset Pagination
→ page-number-oriented navigation

Cursor Pagination
→ stable large-dataset navigation

Fetch Plan
→ explicit relationship loading

Batch Loading
→ bounded multi-entity loading

Query Budget
→ maximum expected round trips

Tenant Scope
→ mandatory authorized data boundary

Read Consistency
→ required freshness semantics
```

La primera implementación deberá concentrarse en:

```text
Repository
RepositoryDefinition

Query
QueryName
QueryDefinition
QueryExecutor
QueryContext

Criteria
Filter
FilterOperator
Sort
SortDirection

Page
PageRequest
PageSize

Cursor
CursorPage
CursorCodec

Projection
ReadModel

DataMapper

DataSource
DataSourceDefinition
ReadConsistency

QueryTimeout
QueryBudget

DataAccessError
```

con:

```text
Explicit Repository Contracts
Aggregate-Oriented Repositories
Query Services
Projections
Allowlisted Filters
Allowlisted Sorting
Bounded Pagination
Stable Ordering
Cursor Pagination
Explicit Fetch Plans
Batch Loading
N+1 Detection
Query Timeouts
Query Budgets
Parameter Binding
Tenant Enforcement
Read Consistency
Module Boundaries
Security
Observability
```

antes de introducir:

```text
Universal Generic Repository
Automatic Lazy Loading
Universal Specification Language
Automatic Sharding
Federated Query
Distributed Query Engine
Custom ORM
Custom SQL Engine
```

Con **ENG-043** la serie global alcanza:

```text
EI-825
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
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-026 — Performance Engineering
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-044 — API Engineering
```
