---
id: ENG-079
titulo: Data Integrity Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Integrity Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-012
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-030
  - ENG-031
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-038
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-048
  - ENG-053
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-076
  - ENG-077
  - ENG-078
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-011
  - ENG-013
  - ENG-014
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-032
  - ENG-033
  - ENG-037
  - ENG-039
  - ENG-040
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-049
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-054
  - ENG-055
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-070
  - ENG-071
  - ENG-072
  - ENG-073
  - ENG-074
  - ENG-075
  - ENG-080
keywords:
  - data-integrity
  - integrity
  - structural-integrity
  - semantic-integrity
  - referential-integrity
  - entity-integrity
  - domain-integrity
  - corruption
  - silent-corruption
  - checksum
  - reconciliation
  - invariant
  - provenance
  - lineage
  - drift
  - orphan-record
  - duplicate-record
  - data-repair
  - mef
---

# ENG-079

# Data Integrity Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Integrity Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-079 establece las reglas para:

```text
Data Integrity

Integrity Requirement
Integrity Objective
Integrity Policy

Integrity Boundary
Trust Boundary

Structural Integrity
Syntactic Integrity
Semantic Integrity
Domain Integrity

Entity Integrity
Referential Integrity
Relational Integrity

Completeness
Validity
Accuracy

Uniqueness
Cardinality

Invariant
Integrity Constraint

Primary Key
Unique Constraint
Foreign Key
Check Constraint

Business Rule

Data Corruption
Silent Corruption
Partial Corruption

Checksum
Digest
Hash
Signature

Integrity Validation
Integrity Verification

Cross-System Integrity

Reconciliation
Reconciliation Rule

Drift
Data Drift
Integrity Drift

Orphan Record
Dangling Reference
Duplicate Record
Conflicting Record

Missing Record
Unexpected Record

Data Repair
Integrity Repair
Repair Plan

Source of Truth
Authoritative Source

Provenance
Lineage

Integrity Snapshot
Integrity Baseline
Integrity Regression

Integrity Security
Integrity Audit
Integrity Observability
Integrity Testing
```

---

# 2. Declaración

> **Todo State gobernado por MEF deberá poseer Integrity Requirements suficientes para determinar si su estructura, relaciones, valores e invariantes de dominio siguen siendo válidos. Durability y Consistency no deberán utilizarse como prueba de Integrity: State corrupto puede ser durable y replicarse consistentemente. Ninguna reparación deberá ejecutarse sin identificar Authority, Scope, Invariants y Verification suficientes para evitar transformar una anomalía en corrupción permanente.**

Arquitectura conceptual:

```text
DATA
 │
 ▼
STRUCTURE
 │
 ▼
RELATIONSHIPS
 │
 ▼
DOMAIN RULES
 │
 ▼
SEMANTIC VALIDITY
 │
 ▼
INTEGRITY
```

Detección:

```text
STATE
  │
  ▼
VALIDATE
  │
  ├── valid ─────────► TRUSTED
  │
  └── invalid
          │
          ▼
      CLASSIFY
          │
          ▼
      RECONCILE
          │
          ▼
       REPAIR
          │
          ▼
       VERIFY
```

---

# 3. Data Integrity Engineering

Data Integrity Engineering responde:

```text
Is the data structurally valid?
Are required fields present?
Are identifiers valid and unique?
Do references point to valid entities?
Are domain invariants satisfied?
Has data been corrupted?
Is state complete?
Do systems disagree?
Which source is authoritative?
Can differences be reconciled?
Can damaged state be repaired safely?
Can provenance explain where data came from?
```

---

# 4. Data Integrity

`Data Integrity` representa la propiedad de que Data y State permanezcan válidos, completos y coherentes con sus Constraints, relaciones e Invariants requeridas.

---

# 5. Integrity ≠ Consistency

Consistency responde:

```text
which version may be observed?
```

Integrity responde:

```text
is that version itself valid?
```

---

# 6. Integrity ≠ Durability

Durability responde:

```text
does committed state survive?
```

Integrity responde:

```text
is surviving state correct
according to integrity rules?
```

---

# 7. Integrity ≠ Availability

Data puede poseer Integrity perfecta y estar temporalmente unavailable.

---

# 8. Integrity ≠ Validation

Validation es uno de los mecanismos usados para proteger Integrity.

---

# 9. Integrity ≠ Accuracy Automatically

Un valor puede ser:

```text
syntactically valid
structurally valid
referentially valid
```

y aun representar incorrectamente la realidad.

---

# 10. Integrity Requirement

Todo Requirement deberá declarar:

```text
scope
authority
constraints
invariants
validation
verification
failure behavior
repair policy
```

---

# 11. Integrity Requirement Example

```text
Scope:
customer account

Authority:
accounts database

Constraints:
customer_id unique
email syntactically valid
status in allowed set

Invariant:
active account must have
verified primary identity

Verification:
database constraints +
domain integrity checks

Repair:
manual for identity conflicts
```

---

# 12. Vague Integrity Requirement

No deberá utilizarse como Contract:

```text
clean data
correct data
valid data
high quality
consistent records
```

sin reglas verificables.

---

# 13. Integrity Scope

Podrá ser:

```text
field
record
aggregate
table
document
message
event
tenant
database
data set
cross-system workflow
```

---

# 14. Integrity Boundary

Define dónde se aplican y garantizan Integrity Rules.

---

# 15. Boundary Examples

```text
aggregate boundary
transaction boundary
database boundary
tenant boundary
service boundary
```

---

# 16. Trust Boundary

Define dónde Data deja o entra en un Scope de confianza.

---

# 17. External Input

Deberá considerarse no confiable hasta Validation suficiente.

---

# 18. Internal Data ≠ Trusted Automatically

State interno puede corromperse por:

```text
bug
migration
race
manual mutation
storage corruption
bad integration
```

---

# 19. Structural Integrity

Garantiza que Data conserva la forma requerida.

Ejemplos:

```text
required fields
types
shape
schema
encoding
```

---

# 20. Syntactic Integrity

Garantiza que valores satisfacen formato requerido.

Ejemplos:

```text
date format
identifier syntax
email syntax
enum format
```

---

# 21. Semantic Integrity

Garantiza que valores tienen significado válido dentro del dominio.

---

# 22. Example Semantic Integrity

```text
start_date <= end_date

quantity >= 0

status transition allowed
```

---

# 23. Domain Integrity

Garantiza reglas específicas del Domain.

Ejemplos:

```text
account balance rule
inventory reservation
order lifecycle
payment state
```

---

# 24. Entity Integrity

Garantiza identidad válida y no ambigua de Entities.

---

# 25. Entity Identifier

Deberá ser:

```text
valid
stable
unique within scope
```

según Contract.

---

# 26. Null Identity

No deberá permitirse cuando la Entity requiera identidad.

---

# 27. Identifier Reuse

No deberá ocurrir cuando pueda romper Provenance, Audit o Relationships.

---

# 28. Referential Integrity

Garantiza que References apunten a Targets válidos conforme al Contract.

---

# 29. Foreign Key

Puede aplicar Referential Integrity dentro de un Store relacional.

---

# 30. Referential Integrity ≠ Foreign Key Only

Cross-Service References pueden requerir mecanismos adicionales.

---

# 31. Dangling Reference

Reference cuyo Target no existe o dejó de ser válido.

---

# 32. Orphan Record

Record que perdió la relación requerida con su Owner/Parent.

---

# 33. Referential Delete

Deberá declarar comportamiento:

```text
RESTRICT
CASCADE
SET_NULL
SOFT_DELETE
DOMAIN_SPECIFIC
```

---

# 34. Cascading Delete

No deberá utilizarse sin comprender Blast Radius.

---

# 35. Entity Deletion

Deberá considerar referencias externas y Derived State.

---

# 36. Relational Integrity

Garantiza relaciones válidas entre múltiples registros o entidades.

---

# 37. Cardinality Integrity

Ejemplos:

```text
one-to-one
one-to-many
exactly-one owner
at-most-one active record
```

---

# 38. Completeness

Representa presencia de Data requerida.

---

# 39. Missing Required Data

Constituye Integrity Violation.

---

# 40. Completeness ≠ Accuracy

Un Data Set puede estar completo y contener valores incorrectos.

---

# 41. Validity

Indica que Data satisface reglas declaradas.

---

# 42. Accuracy

Indica correspondencia con realidad o Source fiable.

---

# 43. Accuracy Verification

Puede requerir:

```text
authoritative comparison
manual confirmation
external evidence
sensor/source validation
```

---

# 44. Unverifiable Accuracy

Deberá permanecer explícita cuando no exista Source independiente.

---

# 45. Uniqueness

Garantiza ausencia de duplicados donde el Domain lo requiere.

---

# 46. Unique Constraint

Deberá aplicarse en Boundary suficientemente autoritativa cuando sea posible.

---

# 47. Application-Only Uniqueness Check

Puede sufrir Race Conditions.

---

# 48. Duplicate Record

Dos Records representan la misma Entity cuando el Domain exige unicidad.

---

# 49. Duplicate ≠ Identical Bytes

Duplicados semánticos pueden diferir en formato o metadata.

---

# 50. Deduplication

Deberá utilizar una Identity/Matching Policy explícita.

---

# 51. False Merge

Fusionar Entities distintas constituye Integrity Failure.

---

# 52. False Duplicate

Marcar como duplicado un Record legítimamente distinto también constituye Failure.

---

# 53. Invariant

Regla que deberá mantenerse sobre State válido.

---

# 54. Invariant Example

```text
order.total >= 0

payment.captured <= payment.authorized

one active primary owner

inventory.available >= 0
```

---

# 55. Invariant Scope

Deberá declararse:

```text
entity
aggregate
transaction
tenant
system
```

---

# 56. Local Invariant

Puede verificarse dentro de una Boundary.

---

# 57. Global Invariant

Puede requerir Coordination conforme ENG-078.

---

# 58. Integrity Constraint

Mecanismo declarativo que protege una Invariant.

---

# 59. Database Constraint

Podrá incluir:

```text
PRIMARY KEY
UNIQUE
FOREIGN KEY
CHECK
NOT NULL
```

---

# 60. Application Constraint

Podrá proteger reglas no expresables en Storage.

---

# 61. Constraint Duplication

Cuando misma regla existe en varios Layers deberá existir Source semántica clara para evitar Drift.

---

# 62. Validation Layer

ENG-036 deberá validar Input y Contracts.

---

# 63. Persistence Constraint

ENG-030/043 deberán reforzar invariantes apropiadas en Store.

---

# 64. Defense in Depth

Podrá utilizar Validation + Domain + Persistence Constraint cuando el riesgo justifique redundancia.

---

# 65. Business Rule

Regla semántica del Domain.

---

# 66. Business Rule ≠ Database Constraint Automatically

No todas las reglas pertenecen al Storage Layer.

---

# 67. Domain Ownership

ENG-035 deberá ser Owner de Domain Invariants.

---

# 68. Invalid State Construction

Deberá evitarse cuando Value Objects/Aggregates puedan impedirlo.

---

# 69. Invalid Transition

No deberá persistirse.

---

# 70. Corruption

Alteración que vuelve State inválido respecto de Integrity Contract.

---

# 71. Physical Corruption

Puede afectar representación almacenada.

---

# 72. Logical Corruption

Data es legible pero semánticamente incorrecta.

---

# 73. Silent Corruption

Data está dañada sin producir Failure evidente.

---

# 74. Silent Corruption Risk

Puede propagarse a:

```text
replicas
caches
indexes
backups
analytics
```

---

# 75. Corruption Propagation

Deberá limitarse.

---

# 76. Corruption Timestamp

Podrá ser desconocido.

---

# 77. Detection Time ≠ Corruption Time

No deberán confundirse.

---

# 78. Corruption Window

Puede afectar selección de Recovery Point conforme ENG-076.

---

# 79. Partial Corruption

Solo una parte del Data Set está dañada.

---

# 80. Corruption Scope

Deberá determinarse antes de Repair amplio.

---

# 81. Checksum

Valor derivado utilizado para detectar cambios accidentales/corrupción.

---

# 82. Checksum ≠ Authenticity

Un atacante que puede modificar Data y Checksum puede evadirlo.

---

# 83. Cryptographic Digest

Puede proporcionar mayor resistencia frente a alteraciones accidentales y determinadas manipulaciones.

---

# 84. Hash

Deberá seleccionar algoritmo apropiado para el Purpose.

---

# 85. Hash ≠ Encryption

No deberán confundirse.

---

# 86. Digital Signature

Podrá proporcionar:

```text
integrity
origin authentication
```

cuando corresponda.

---

# 87. Integrity Metadata

Checksums, digests y signatures también deberán protegerse.

---

# 88. End-to-End Integrity

Deberá favorecer validación desde Producer hasta Consumer cuando riesgo lo requiera.

---

# 89. Transport Integrity

ENG-032/024 podrá proteger Data durante tránsito.

---

# 90. Storage Integrity

ENG-077 deberá proteger Data durable almacenada.

---

# 91. Application Integrity

ENG-079 deberá comprobar significado del State.

---

# 92. Integrity Validation

Determina si Data satisface Rules conocidas.

---

# 93. Validation Timing

Podrá ocurrir:

```text
input
construction
mutation
commit
read
reconciliation
migration
recovery
```

---

# 94. Validate on Write

Deberá favorecerse para evitar persistir State inválido.

---

# 95. Validate on Read

Puede detectar Legacy/Corrupt State, pero no sustituye Write Validation.

---

# 96. Integrity Verification

Proceso explícito de comprobar State existente.

---

# 97. Verification Scope

Podrá ser:

```text
single record
sample
partition
tenant
full data set
```

---

# 98. Full Scan

Puede ser costoso y deberá planificarse.

---

# 99. Sampling

Puede detectar tendencias, pero no garantiza ausencia de corrupción.

---

# 100. Continuous Verification

Podrá incorporarse cuando Criticality lo requiera.

---

# 101. Verification Confidence

Deberá declarar si el resultado proviene de:

```text
full verification
sampling
constraint checks
reconciliation
```

---

# 102. Source of Truth

State considerado autoritativo para un concepto concreto.

---

# 103. Source of Truth Requirement

Deberá ser explícito para Data crítica.

---

# 104. Multiple Sources of Truth

Deberá evitarse para el mismo concepto salvo Consistency/Reconciliation Contract explícito.

---

# 105. Authoritative Source

Source desde el cual pueden resolverse determinadas discrepancias.

---

# 106. Authority Scope

Una Source puede ser autoritativa para un atributo y no para otro.

---

# 107. Derived State

No deberá utilizarse como autoridad si puede reconstruirse desde Source principal.

---

# 108. Cache

No deberá utilizarse como Source of Truth sin Contract explícito.

---

# 109. Search Index

Normalmente representa Derived State.

---

# 110. Projection

Podrá ser reconstruible.

---

# 111. Analytics Data

No deberá convertirse automáticamente en Operational Authority.

---

# 112. Cross-System Integrity

Evalúa relaciones entre State mantenido por múltiples sistemas.

---

# 113. Cross-System Example

```text
ORDER
  │
  ├── payment
  ├── shipment
  └── accounting
```

---

# 114. Cross-System Invariant

Ejemplo:

```text
captured payment
must correspond to
known order
```

---

# 115. Distributed Integrity

Puede no ser garantizable mediante una única Database Constraint.

---

# 116. Reconciliation

Compara Sources y detecta diferencias.

---

# 117. Reconciliation Requirement

Deberá declarar:

```text
sources
authority
matching key
comparison rules
tolerance
repair behavior
```

---

# 118. Reconciliation ≠ Synchronization

Reconciliation identifica y clasifica diferencias.

Puede o no repararlas.

---

# 119. Reconciliation Pair

Ejemplo:

```text
System A
vs
System B
```

---

# 120. Multi-Way Reconciliation

Puede involucrar múltiples sistemas.

---

# 121. Matching Key

Deberá ser estable y suficientemente único.

---

# 122. Fuzzy Matching

No deberá modificar State automáticamente sin Confidence/Policy suficiente.

---

# 123. Reconciliation Result

Podrá clasificar:

```text
MATCH
MISSING_LEFT
MISSING_RIGHT
DIFFERENT
CONFLICT
UNKNOWN
```

---

# 124. MATCH

State relevante coincide conforme Rules.

---

# 125. MISSING_LEFT / RIGHT

Record esperado falta en una Source.

---

# 126. DIFFERENT

Existe discrepancia resoluble potencialmente.

---

# 127. CONFLICT

No existe resolución automática segura.

---

# 128. UNKNOWN

No existe evidencia suficiente.

---

# 129. Reconciliation Tolerance

Podrá permitir diferencias aceptables.

Ejemplos:

```text
timestamp precision
rounding
eventual projection lag
```

---

# 130. Tolerance ≠ Ignore

Toda tolerancia deberá estar explícita.

---

# 131. Data Drift

Cambio gradual de Data respecto de referencia esperada.

---

# 132. Integrity Drift

Aumento de violaciones de Integrity a través del tiempo.

---

# 133. Schema Drift

ENG-062 deberá controlar cambios estructurales.

---

# 134. Semantic Drift

Mismo campo comienza a representar significado diferente.

---

# 135. Semantic Drift Risk

Puede ocurrir sin cambio de Schema.

---

# 136. Drift Detection

Podrá comparar:

```text
baseline
distribution
constraints
metadata
reference data
```

---

# 137. Reference Data

Data compartida que define valores permitidos o clasificaciones.

---

# 138. Reference Data Integrity

Deberá controlarse.

---

# 139. Master Data

Podrá requerir Authority explícita.

---

# 140. Master Data Conflict

No deberá resolverse arbitrariamente.

---

# 141. Missing Record

Entity requerida no existe.

---

# 142. Unexpected Record

Entity existe donde el Domain no la permite.

---

# 143. Conflicting Record

Dos Sources contienen State incompatible.

---

# 144. Integrity Incident

Podrá agrupar anomalías con Root Cause común.

---

# 145. Integrity Severity

Podrá clasificarse:

```text
INFO
LOW
MEDIUM
HIGH
CRITICAL
```

según impacto.

---

# 146. Integrity State

Podrá clasificarse:

```text
VALID
DEGRADED
VIOLATED
CORRUPTED
REPAIRING
UNKNOWN
```

---

# 147. VALID

Integrity Requirements se satisfacen.

---

# 148. DEGRADED

Existen anomalías tolerables o parciales que requieren atención.

---

# 149. VIOLATED

Una Invariant/Constraint contractual fue incumplida.

---

# 150. CORRUPTED

State ha sido alterado o dañado de manera incompatible con su Contract.

---

# 151. REPAIRING

Se ejecuta una reparación controlada.

---

# 152. UNKNOWN

No existe evidencia suficiente.

---

# 153. UNKNOWN ≠ VALID

Ausencia de Integrity Checks no prueba validez.

---

# 154. Data Repair

Modificación destinada a restaurar Integrity.

---

# 155. Repair Preconditions

Deberán incluir:

```text
scope known
authority known
backup/recovery available
repair rule known
verification defined
authorization granted
```

---

# 156. Repair Plan

Conceptualmente:

```text
Detect
  │
  ▼
Classify
  │
  ▼
Determine Authority
  │
  ▼
Create Repair Plan
  │
  ▼
Backup / Snapshot
  │
  ▼
Repair
  │
  ▼
Verify
  │
  ▼
Reconcile
  │
  ▼
Close
```

---

# 157. Blind Repair

Queda prohibida para State crítico.

---

# 158. Manual SQL Repair

Deberá considerarse operación privilegiada.

---

# 159. Ad-Hoc Repair

Deberá evitarse cuando pueda expresarse como procedure/script versionado.

---

# 160. Repair Idempotency

Deberá favorecerse.

---

# 161. Repair Dry Run

Deberá existir cuando el riesgo lo justifique.

---

# 162. Repair Preview

Podrá mostrar:

```text
records affected
changes
invariants repaired
risk
```

---

# 163. Repair Transaction

Deberá utilizar Transaction Boundary cuando sea apropiado.

---

# 164. Large Repair

Podrá requerir:

```text
batching
checkpointing
backpressure
capacity budget
```

---

# 165. Repair During Production

Deberá considerar Concurrency y nuevos Writes.

---

# 166. Freeze Window

Podrá requerirse.

---

# 167. Online Repair

Deberá utilizar Version/Conflict Protection cuando Writes continúen.

---

# 168. Repair Authority

No deberá confiar en Data corrupta como Source de reparación.

---

# 169. Repair Verification

Toda reparación deberá volver a comprobar Invariants.

---

# 170. Repair Rollback

Deberá existir cuando sea técnicamente viable.

---

# 171. Irreversible Repair

Deberá requerir controles reforzados.

---

# 172. Cross-System Repair

Deberá considerar Authority y Ordering.

---

# 173. Reconciliation After Repair

Deberá confirmar que Sources vuelvan al State esperado.

---

# 174. Recovery vs Repair

Recovery restaura State desde un Recovery Point.

Repair modifica State actual para corregir anomalías.

---

# 175. Recovery May Restore Corruption

Si Recovery Point ya contiene corrupción, Restore no repara Integrity.

---

# 176. Clean Recovery Point

ENG-076 deberá utilizar Integrity Evidence cuando el Scenario sea corrupción.

---

# 177. Provenance

Describe origen de Data.

---

# 178. Provenance Fields

Podrán incluir:

```text
source
createdBy
createdAt
ingestionId
version
transformation
```

---

# 179. Provenance ≠ Audit

Se relacionan, pero Provenance explica origen/evolución de Data.

Audit registra acciones relevantes.

---

# 180. Lineage

Describe flujo de Data a través de Sources, Transformations y Destinations.

---

# 181. Lineage Example

```text
SOURCE
  │
  ▼
INGEST
  │
  ▼
TRANSFORM
  │
  ▼
STORE
  │
  ▼
PROJECTION
  │
  ▼
REPORT
```

---

# 182. Lineage Importance

Facilita determinar Blast Radius de:

```text
corruption
bad source
bad transform
bad migration
```

---

# 183. Lineage Granularity

Deberá ser proporcional al riesgo.

---

# 184. Row-Level Lineage

Puede ser costoso y no deberá imponerse universalmente.

---

# 185. Dataset-Level Lineage

Puede ser suficiente en ciertos Scopes.

---

# 186. Transformation Integrity

ENG-063 deberá preservar:

```text
mapping
precision
semantics
completeness
```

---

# 187. Lossy Transformation

Deberá ser explícita.

---

# 188. Precision Loss

No deberá ocurrir silenciosamente cuando afecte Contract.

---

# 189. Encoding Integrity

ENG-031 deberá evitar truncation/encoding corruption.

---

# 190. Serialization Roundtrip

Podrá verificarse para State crítico.

---

# 191. Message Integrity

ENG-041 deberá preservar Payload y Identity conforme Contract.

---

# 192. Message Corruption

Deberá detectarse.

---

# 193. Event Integrity

Events no deberán mutarse cuando su Contract los defina immutable.

---

# 194. Event Correction

Podrá realizarse mediante nuevo Event compensatorio/correctivo.

---

# 195. Transaction Integrity

ENG-042 deberá preservar Atomicity e Invariants correspondientes.

---

# 196. Partial Commit

Puede producir Integrity Violation.

---

# 197. Data Access Integrity

ENG-043 deberá evitar:

```text
incorrect mapping
silent truncation
wrong tenant filter
partial hydration
```

---

# 198. ORM Mapping Integrity

Deberá verificarse para campos críticos.

---

# 199. Type Conversion

No deberá perder precisión silenciosamente.

---

# 200. Null Semantics

Deberán ser explícitas.

---

# 201. Empty ≠ Null Automatically

No deberán normalizarse indistintamente sin Domain Rule.

---

# 202. Default Value

No deberá ocultar ausencia real de Data requerida.

---

# 203. Multi-Tenancy Integrity

ENG-048 deberá preservar aislamiento de State.

---

# 204. Cross-Tenant Data

Constituye Integrity + Security Violation.

---

# 205. Tenant Identifier Integrity

Deberá mantenerse en todos los Boundaries relevantes.

---

# 206. Tenant Reassignment

Deberá ser operación altamente controlada.

---

# 207. Schema Integrity

ENG-062 deberá asegurar estructura compatible.

---

# 208. Migration Integrity

ENG-065 deberá verificar State antes, durante y después de Migration.

---

# 209. Backfill Integrity

Deberá comprobar:

```text
coverage
idempotency
mapping
reconciliation
```

---

# 210. Cutover Integrity

Source y Target deberán reconciliarse conforme Strategy.

---

# 211. Upgrade Integrity

Mixed Versions no deberán interpretar un mismo State de forma incompatible.

---

# 212. Cache Integrity

Cache Keys deberán preservar Scope/Tenant/Version suficientes.

---

# 213. Cache Key Collision

Puede producir Integrity/Security Failure.

---

# 214. Cache Poisoning

Deberá considerarse.

---

# 215. Derived Data Integrity

Derived State deberá poder relacionarse con Source.

---

# 216. Projection Integrity

Deberá detectar:

```text
missing event
duplicate event
incorrect ordering
bad transformation
```

---

# 217. Aggregation Integrity

Deberá considerar:

```text
double count
missing count
rounding
precision
window boundaries
```

---

# 218. Financial Integrity

Cuando existan cálculos financieros deberá evitarse pérdida de precisión y reconciliar totales según Domain Requirements.

---

# 219. Time Integrity

Timestamps deberán declarar:

```text
timezone
precision
source
clock semantics
```

cuando sean relevantes.

---

# 220. Clock Skew

Puede afectar Ordering/Provenance, pero no deberá corregirse destruyendo eventos válidos.

---

# 221. Identifier Integrity

Identifiers externos deberán validarse antes de persistencia.

---

# 222. Reference Integrity Across APIs

Remote Identifier existence podrá verificarse:

```text
synchronously
asynchronously
via reconciliation
```

según Availability/Consistency Contract.

---

# 223. Soft Referential Integrity

Puede ser necesaria entre Services.

---

# 224. Soft Integrity Monitoring

Deberá detectar violaciones posteriormente.

---

# 225. Integrity Baseline

Representa estado conocido de:

```text
constraint violations
orphans
duplicates
missing records
reconciliation differences
corruption events
```

---

# 226. Integrity Regression

Ocurre cuando nueva Version/Process aumenta anomalías.

Ejemplos:

```text
new duplicates
new orphan records
more reconciliation drift
invalid values
new missing relationships
```

---

# 227. Integrity Regression ≠ Consistency Regression

State puede converger perfectamente hacia Data inválida.

---

# 228. Integrity Gate

Podrá utilizarse para:

```text
migration
deployment
data import
backfill
cutover
schema change
critical release
```

---

# 229. Gate Inputs

Podrán incluir:

```text
constraint violations
reconciliation status
orphan count
duplicate count
corruption status
invariant checks
```

---

# 230. Gate Override

Deberá requerir Authority y Audit.

---

# 231. Integrity Quarantine

State sospechoso podrá aislarse antes de propagación.

---

# 232. Quarantine Use

Especialmente útil para:

```text
imports
events
external feeds
corrupt payloads
```

---

# 233. Quarantine ≠ Delete

Evidence deberá conservarse según Policy.

---

# 234. Dead-Letter Data

Podrá contener Records que requieren investigación.

---

# 235. Replay After Repair

Deberá evitar duplicados.

---

# 236. Data Quality Relationship

Data Quality es concepto más amplio que puede incluir:

```text
timeliness
relevance
accuracy
completeness
consistency
```

ENG-079 se concentra en garantías de Integrity contractual.

---

# 237. Integrity Security

ENG-024 gobernará Security general.

---

# 238. Unauthorized Mutation

Es Integrity Threat.

---

# 239. Integrity Protection

Podrá utilizar:

```text
authorization
constraints
signatures
hashes
immutable logs
audit
least privilege
```

---

# 240. Privileged Data Repair

Deberá requerir autorización explícita.

---

# 241. Integrity Repair Interface

No deberá exponerse públicamente sin controles reforzados.

---

# 242. Input Tampering

Deberá detectarse mediante Validation/Auth según Scope.

---

# 243. Integrity Attack

Podrá intentar:

```text
duplicate creation
reference tampering
cross-tenant mutation
checksum bypass
reconciliation poisoning
repair abuse
```

---

# 244. Integrity Metadata Exposure

Provenance puede contener información sensible.

---

# 245. Integrity Audit

Cambios críticos deberán ser auditables.

---

# 246. Audit Events

Podrán incluir:

```text
integrity violation detected
corruption detected
reconciliation mismatch
repair initiated
repair completed
repair failed
manual correction
integrity gate overridden
authority changed
```

---

# 247. Integrity Observability

ENG-025 gobernará Telemetry.

---

# 248. Metrics

Podrán incluir:

```text
mef.integrity.violation.total
mef.integrity.corruption.total

mef.integrity.orphan.total
mef.integrity.duplicate.total
mef.integrity.missing.total

mef.integrity.reconciliation.mismatch.total
mef.integrity.repair.total
mef.integrity.repair.failure.total

mef.integrity.verification.duration
```

---

# 249. Integrity Ratio

Podrá calcularse únicamente con denominador claro.

---

# 250. Integrity Metric Labels

Podrán incluir:

```text
constraintType
scopeType
severity
result
```

con Cardinality controlada.

---

# 251. Record Identifier as Label

No deberá utilizarse indiscriminadamente.

---

# 252. Integrity Logs

Deberán registrar:

```text
violation category
scope
safe identifiers
authority
repair state
```

---

# 253. Integrity Diagnostics

Deberá poder responder:

```text
what integrity rules apply?
which rules are violated?
which records are affected?
when was corruption detected?
which source is authoritative?
which downstream systems received it?
is reconciliation clean?
can the state be repaired?
was repair verified?
```

---

# 254. Integrity Snapshot

Conceptualmente:

```text
IntegritySnapshot
├── state
├── verifiedAt
├── constraints
├── violations
├── corruption
├── reconciliation
├── drift
└── repairState
```

---

# 255. Verification History

Podrá mantener resultados agregados de Integrity Checks.

---

# 256. Testing

ENG-009 gobernará Testing.

---

# 257. Structural Integrity Test

Deberá comprobar Schema/Shape.

---

# 258. Required Field Test

Deberá comprobar presencia.

---

# 259. Domain Integrity Test

Deberá comprobar Invariants.

---

# 260. Entity Integrity Test

Deberá comprobar Identifier semantics.

---

# 261. Referential Integrity Test

Deberá comprobar References.

---

# 262. Unique Constraint Test

Deberá intentar concurrencia que produzca duplicados.

---

# 263. Business Rule Test

Deberá verificar Domain Rules.

---

# 264. Corruption Detection Test

Deberá introducir corrupción controlada.

---

# 265. Silent Corruption Test

Deberá comprobar Integrity mechanisms sin Failure explícito.

---

# 266. Checksum Test

Deberá detectar alteración.

---

# 267. Reconciliation Test

Deberá introducir diferencias controladas.

---

# 268. Missing Record Test

Deberá comprobar detección.

---

# 269. Orphan Test

Deberá comprobar detección.

---

# 270. Duplicate Test

Deberá comprobar detección y evitar False Merge.

---

# 271. Conflicting Record Test

Deberá comprobar Resolution Policy.

---

# 272. Repair Dry-Run Test

Deberá mostrar cambios sin mutación.

---

# 273. Repair Test

Deberá comprobar:

```text
authority
mutation
invariant restoration
verification
```

---

# 274. Concurrent Repair Test

Deberá comprobar comportamiento frente a nuevos Writes.

---

# 275. Cross-System Integrity Test

Deberá comprobar invariantes distribuidas.

---

# 276. Migration Integrity Test

Deberá comprobar:

```text
before
during
after
```

---

# 277. Backfill Integrity Test

Deberá comprobar Coverage y Idempotency.

---

# 278. Transformation Integrity Test

Deberá comprobar precisión y mapping.

---

# 279. Serialization Integrity Test

Deberá comprobar Roundtrip.

---

# 280. Multi-Tenant Integrity Test

Deberá comprobar aislamiento.

---

# 281. Recovery Integrity Test

Deberá comprobar que Restore produce State válido.

---

# 282. Security Test

Deberá intentar:

```text
constraint bypass
unauthorized mutation
cross-tenant reference
repair abuse
checksum tampering
provenance tampering
reconciliation poisoning
```

---

# 283. Architecture Test

Podrá impedir:

```text
source of truth unspecified
domain invariant only documented
uniqueness enforced only by unsafe pre-check
cache treated as authority
cross-system reference without reconciliation strategy
repair without verification
manual production mutation without audit
```

---

# 284. Build Integration

ENG-012 podrá validar:

```text
integrity requirement declarations
schema constraints
domain invariant metadata
source-of-truth declarations
reconciliation definitions
repair policy
```

---

# 285. Integrity Tests in CI

Pruebas pequeñas deberán ejecutarse regularmente.

Full Data Verification/Reconciliation podrá ejecutarse mediante:

```text
scheduled pipeline
data quality pipeline
preproduction
migration pipeline
controlled production verification
```

---

# 286. CLI

ENG-007 podrá proporcionar:

```text
mef integrity
mef integrity:requirements
mef integrity:verify
mef integrity:constraints
mef integrity:orphans
mef integrity:duplicates
mef integrity:reconcile
mef integrity:repair
mef integrity:lineage
mef integrity:diagnose
```

---

# 287. `mef integrity`

Podrá mostrar Integrity Snapshot.

---

# 288. `integrity:requirements`

Podrá mostrar:

```text
scope
authority
constraints
invariants
verification
repair policy
```

---

# 289. `integrity:verify`

Podrá ejecutar Verification.

---

# 290. `integrity:constraints`

Podrá mostrar reglas activas.

---

# 291. `integrity:orphans`

Podrá mostrar candidatos.

---

# 292. `integrity:duplicates`

Podrá mostrar posibles duplicados con Confidence.

---

# 293. `integrity:reconcile`

Podrá comparar Sources.

---

# 294. `integrity:repair`

Deberá ser:

```text
dry-run by default
```

cuando sea técnicamente posible.

---

# 295. `integrity:lineage`

Podrá mostrar Provenance/Lineage disponible.

---

# 296. `integrity:diagnose`

Podrá mostrar:

```text
state
requirements
authority
constraints
violations
orphans
duplicates
corruption
reconciliation
drift
repair history
```

---

# 297. Registry Integration

ENG-020 podrá registrar:

```text
IntegrityRequirement
IntegrityPolicy
IntegrityConstraint
IntegrityVerifier
ReconciliationPolicy
RepairPolicy
IntegrityGate
```

---

# 298. Integrity Requirement Contract

Conceptualmente:

```text
IntegrityRequirement
├── id
├── scope
├── authority
├── constraints
├── invariants
├── validation
├── verification
└── repairPolicy
```

---

# 299. Integrity Constraint Contract

Conceptualmente:

```text
IntegrityConstraint
├── id
├── scope
├── type
├── expression
├── severity
└── metadata
```

---

# 300. Integrity Violation

Conceptualmente:

```text
IntegrityViolation
├── id
├── constraint
├── scope
├── severity
├── detectedAt
├── evidence
└── status
```

---

# 301. Reconciliation Policy

Conceptualmente:

```text
ReconciliationPolicy
├── leftSource
├── rightSource
├── authority
├── matching
├── comparison
├── tolerance
└── resolution
```

---

# 302. Reconciliation Result

Conceptualmente:

```text
ReconciliationResult
├── status
├── matched
├── missingLeft
├── missingRight
├── different
├── conflicts
└── observedAt
```

---

# 303. Repair Plan

Conceptualmente:

```text
RepairPlan
├── scope
├── authority
├── violations
├── operations
├── preconditions
├── rollback
├── verification
└── metadata
```

---

# 304. Repair Result

Conceptualmente:

```text
RepairResult
├── status
├── affected
├── repaired
├── failed
├── verification
└── diagnostics
```

---

# 305. Provenance Record

Conceptualmente:

```text
ProvenanceRecord
├── source
├── operation
├── actor
├── createdAt
├── version
├── transformation
└── metadata
```

---

# 306. Lineage Edge

Conceptualmente:

```text
LineageEdge
├── source
├── destination
├── transformation
├── version
└── metadata
```

---

# 307. Integrity Policy

Conceptualmente:

```text
IntegrityPolicy
├── requirements
├── verification
├── reconciliation
├── repair
├── quarantine
└── security
```

---

# 308. Integrity Verification Result

Conceptualmente:

```text
IntegrityVerificationResult
├── valid
├── scope
├── checked
├── violations
├── corruption
├── confidence
└── diagnostics
```

---

# 309. Integrity Runtime

Conceptualmente:

```text
IntegrityRuntime
├── validate
├── verify
├── reconcile
├── quarantine
├── repair
├── lineage
└── diagnose
```

---

# 310. Integrity Gate

Podrá utilizarse para:

```text
migration
backfill
import
deployment
cutover
schema change
recovery
```

---

# 311. Gate Inputs

Podrán incluir:

```text
critical violations
corruption
reconciliation mismatches
orphans
duplicates
missing records
verification coverage
```

---

# 312. Gate Override

Deberá requerir Authority y Audit.

---

# 313. Integrity Baseline

Podrá registrar:

```text
violations
orphan rate
duplicate rate
missing rate
reconciliation mismatches
corruption events
verification coverage
```

---

# 314. Integrity Regression

Podrá detectarse cuando Candidate:

```text
creates invalid state
increases duplicate rate
increases orphan rate
introduces new reconciliation drift
reduces verification coverage
```

---

# 315. Integrity Ownership

Todo Requirement crítico deberá poseer Owner.

---

# 316. Owner Responsibility

Incluye:

```text
authority
constraints
invariants
reconciliation
repair
verification
```

---

# 317. Integrity Review

Deberá realizarse ante:

```text
schema change
migration
new integration
new data source
new transformation
new replication topology
bulk repair
data incident
```

---

# 318. First Implementation Components

La primera implementación deberá incluir:

```text
IntegrityState

IntegrityRequirement
IntegrityConstraint
IntegrityViolation
IntegrityPolicy

IntegrityVerifier
IntegrityVerificationResult

ReconciliationPolicy
ReconciliationResult

RepairPlan
RepairResult

ProvenanceRecord

IntegrityRuntime
IntegrityRegistry
IntegrityError
```

---

# 319. Optional Initial Components

Podrán incorporarse:

```text
IntegritySnapshot
IntegrityGate

OrphanDetector
DuplicateDetector
DriftDetector

LineageGraph

IntegrityDiagnostics
```

---

# 320. Later Components

Solo cuando exista necesidad demostrada:

```text
Continuous Integrity Verification
Automatic Data Repair
Semantic Duplicate Resolution
Automated Lineage Discovery
Predictive Integrity Drift
Cross-System Integrity Graph
AI-Assisted Integrity Engineering
```

---

# 321. Estructura Conceptual de Directorios

```text
src/
└── Integrity/
    ├── State/
    │   └── IntegrityState
    │
    ├── Requirement/
    │   └── IntegrityRequirement
    │
    ├── Constraint/
    │   ├── IntegrityConstraint
    │   └── IntegrityViolation
    │
    ├── Policy/
    │   └── IntegrityPolicy
    │
    ├── Verification/
    │   ├── IntegrityVerifier
    │   └── IntegrityVerificationResult
    │
    ├── Reconciliation/
    │   ├── ReconciliationPolicy
    │   └── ReconciliationResult
    │
    ├── Repair/
    │   ├── RepairPlan
    │   └── RepairResult
    │
    ├── Detection/
    │   ├── OrphanDetector
    │   ├── DuplicateDetector
    │   └── DriftDetector
    │
    ├── Provenance/
    │   ├── ProvenanceRecord
    │   └── LineageGraph
    │
    ├── Gate/
    │   └── IntegrityGate
    │
    ├── Snapshot/
    │   └── IntegritySnapshot
    │
    ├── Runtime/
    │   └── IntegrityRuntime
    │
    ├── Registry/
    │   └── IntegrityRegistry
    │
    ├── Diagnostics/
    │   └── IntegrityDiagnostics
    │
    └── Error/
        └── IntegrityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 322. Error Namespace

ENG-079 utilizará:

```text
MEF-INTEGRITY-xxx
```

---

# 323. Taxonomía ENG-079

```text
MEF-INTEGRITY-001 Integrity requirement invalid
MEF-INTEGRITY-002 Integrity authority unspecified
MEF-INTEGRITY-003 Integrity constraint invalid
MEF-INTEGRITY-004 Integrity invariant violated
MEF-INTEGRITY-005 Structural integrity violation
MEF-INTEGRITY-006 Semantic integrity violation
MEF-INTEGRITY-007 Entity integrity violation
MEF-INTEGRITY-008 Referential integrity violation
MEF-INTEGRITY-009 Domain integrity violation
MEF-INTEGRITY-010 Required data missing
MEF-INTEGRITY-011 Duplicate record detected
MEF-INTEGRITY-012 Orphan record detected
MEF-INTEGRITY-013 Dangling reference detected
MEF-INTEGRITY-014 Conflicting record detected
MEF-INTEGRITY-015 Data corruption detected
MEF-INTEGRITY-016 Silent corruption detected
MEF-INTEGRITY-017 Checksum mismatch
MEF-INTEGRITY-018 Reconciliation mismatch
MEF-INTEGRITY-019 Reconciliation conflict
MEF-INTEGRITY-020 Integrity drift detected
MEF-INTEGRITY-021 Repair plan invalid
MEF-INTEGRITY-022 Integrity repair failed
MEF-INTEGRITY-023 Repair verification failed
MEF-INTEGRITY-024 Cross-system integrity violation
MEF-INTEGRITY-025 Integrity gate failed
MEF-INTEGRITY-026 Integrity gate override denied
MEF-INTEGRITY-027 Integrity authorization denied
MEF-INTEGRITY-028 Integrity security violation
MEF-INTEGRITY-029 Integrity state unknown
MEF-INTEGRITY-030 Integrity invariant framework violation
```

---

# 324. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Integrity Requirements
Explicit Authority

Structural Integrity
Semantic Integrity
Entity Integrity
Referential Integrity
Domain Integrity

Constraints
Invariants

Completeness
Uniqueness

Corruption Detection
Checksum Awareness

Integrity Verification

Source of Truth

Reconciliation
Orphan Detection
Duplicate Detection

Repair Planning
Repair Verification

Provenance Awareness

Security
Audit
Observability
Testing
```

---

# 325. First Version Non-Goals

No deberá requerir:

```text
Automatic Data Repair
Automatic Semantic Deduplication
Automated Lineage Discovery
Continuous Full-Data Verification
Predictive Integrity Drift
AI-Assisted Integrity Engineering
```

---

# 326. Second Phase

Podrá incorporar:

```text
Integrity Gates
Integrity Snapshots

Orphan Detector
Duplicate Detector
Drift Detector

Advanced Reconciliation
Lineage Graph

Scheduled Integrity Verification
```

---

# 327. Third Phase

Solo cuando exista necesidad demostrada:

```text
Continuous Integrity Verification
Automatic Data Repair
Semantic Duplicate Resolution
Automated Lineage Discovery
Predictive Integrity Drift
Cross-System Integrity Graph
AI-Assisted Integrity Engineering
```

---

# 328. Invariantes de Ingeniería

ENG-079 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1526 | Todo Integrity Requirement contractual deberá declarar Scope, Authority, Constraints, Domain Invariants, Validation, Verification, Failure Behavior y Repair Policy suficientes para ser comprobable. |
| EI-1527 | Data Integrity deberá permanecer diferenciada de Consistency, Durability, Availability, Accuracy, Validation y Data Quality y ninguna de dichas propiedades deberá utilizarse como prueba automática de Integrity. |
| EI-1528 | Structural, Syntactic, Semantic, Domain, Entity, Referential y Relational Integrity deberán conservar Semantics diferenciadas y los mecanismos de cada Layer deberán aplicarse donde exista Authority suficiente. |
| EI-1529 | Internal State no deberá considerarse confiable únicamente por haber pasado Validation inicial; Bugs, Concurrency, Migration, Manual Mutation, Integration y Storage Failure podrán introducir Integrity Violations posteriormente. |
| EI-1530 | Identifiers, Uniqueness, Required Fields, Cardinality y References deberán protegerse mediante Constraints suficientemente autoritativas y Application Pre-Checks susceptibles a Race no deberán utilizarse como única protección de Invariants críticas. |
| EI-1531 | Domain Invariants deberán pertenecer a Ownership explícito y las reglas de negocio críticas no deberán existir únicamente como documentación sin Enforcement o Verification apropiados. |
| EI-1532 | Data Corruption deberá incluir Physical, Logical, Partial y Silent Corruption y el hecho de que State sea legible, replicated o durable no deberá considerarse evidencia de Integrity semántica. |
| EI-1533 | Checksums, Digests y Signatures deberán utilizarse conforme a su propósito y Checksum no deberá presentarse como autenticidad, Hash como Encryption ni Integrity Metadata desprotegida como evidencia suficiente. |
| EI-1534 | Integrity Verification deberá declarar Scope y Confidence y Sampling no deberá presentarse como prueba de ausencia total de corrupción sobre Data no inspeccionada. |
| EI-1535 | Todo State crítico deberá poseer Source of Truth o Authority suficientemente definida y Caches, Search Indexes, Projections, Analytics u otros Derived Stores no deberán convertirse silenciosamente en Authority operacional. |
| EI-1536 | Cross-System Integrity deberá utilizar Reconciliation cuando una única Constraint transaccional no pueda abarcar todos los Systems y cada Reconciliation deberá declarar Sources, Matching, Authority, Tolerance y Resolution Policy. |
| EI-1537 | Reconciliation deberá diferenciar MATCH, Missing, Different, Conflict y Unknown y ninguna discrepancia sin resolución segura deberá corregirse automáticamente destruyendo evidencia. |
| EI-1538 | Data/Integrity Drift deberá ser detectable cuando pueda degradar Domain Correctness y Semantic Drift deberá considerarse incluso cuando Schema permanezca técnicamente compatible. |
| EI-1539 | Data Repair deberá declarar Scope, Authority, Preconditions, Operations, Verification y Rollback/Recovery cuando sea viable y Blind Repair o Ad-Hoc Production Mutation de State crítico deberá prohibirse. |
| EI-1540 | Online Repair deberá protegerse frente a Writes concurrentes mediante Versioning, Transactions, Fencing o mecanismo equivalente y una reparación no deberá sobrescribir State legítimamente modificado después de su diagnóstico. |
| EI-1541 | Provenance y Lineage deberán preservarse cuando sean necesarias para identificar origen, Transformations y Blast Radius de corrupción, sin imponer granularidad excesiva ni exponer información sensible innecesariamente. |
| EI-1542 | Migration, Backfill, Transformation, Serialization, Messaging, Cache, Projection y Recovery deberán preservar Integrity y ejecutar Verification/Reconciliation suficiente antes de declarar éxito cuando modifiquen o reconstruyan State crítico. |
| EI-1543 | Multi-Tenant Integrity deberá preservar Tenant Scope en Identity, References, Cache Keys, Queries, Repairs y Reconciliation y Cross-Tenant State constituye simultáneamente Integrity y Security Violation. |
| EI-1544 | Integrity Security, Audit y Observability deberán proteger Authority, Repair, Provenance, Reconciliation e Integrity Metadata y permitir detectar Violations, Corruption, Orphans, Duplicates, Missing Records, Drift y Repair Failures con Cardinality controlada. |
| EI-1545 | La primera implementación deberá priorizar Integrity Requirements, Authority, Constraints, Structural/Semantic/Entity/Referential/Domain Integrity, Invariants, Corruption Detection, Verification, Reconciliation, Orphan/Duplicate Detection, Repair Planning y Provenance antes de introducir Automatic Repair, Semantic Deduplication, Predictive Drift o AI-Assisted Integrity Engineering. |

---

# 329. Continuidad de Invariantes

```text
ENG-075 → EI-1446 a EI-1465
ENG-076 → EI-1466 a EI-1485
ENG-077 → EI-1486 a EI-1505
ENG-078 → EI-1506 a EI-1525
ENG-079 → EI-1526 a EI-1545
```

---

# 330. Criterios de Conformidad

Una implementación será conforme con ENG-079 cuando:

- defina Integrity Requirements explícitos;
- identifique Authority/Source of Truth;
- defina Integrity Boundaries;
- diferencie Structural Integrity;
- diferencie Syntactic Integrity;
- diferencie Semantic Integrity;
- diferencie Domain Integrity;
- implemente Entity Integrity;
- implemente Referential Integrity;
- defina Uniqueness;
- controle Required Fields;
- modele Domain Invariants;
- utilice Constraints apropiadas;
- valide Inputs;
- verifique State persistido;
- detecte Physical/Logical/Silent Corruption;
- implemente Integrity Checks cuando corresponda;
- detecte Orphans;
- detecte Duplicates;
- detecte Missing Records;
- detecte Conflicts;
- implemente Cross-System Reconciliation cuando corresponda;
- declare Reconciliation Tolerances;
- detecte Drift;
- defina Repair Plans;
- permita Dry Run cuando corresponda;
- verifique Repairs;
- preserve Provenance;
- preserve Lineage cuando corresponda;
- preserve Multi-Tenant Integrity;
- aplique Security;
- implemente Audit;
- implemente Observability;
- implemente Integrity Testing.

---

# 331. Riesgos

Deberán evitarse especialmente:

```text
Durable Equals Valid
Consistent Equals Valid
Replicated Equals Correct

Internal Data Automatically Trusted

Schema Valid Equals Domain Valid
Syntactic Valid Equals Semantic Valid

Application Pre-Check as Only Uniqueness Guarantee

No Source of Truth
Multiple Hidden Authorities

Cache as Authority
Search Index as Authority
Analytics as Operational Authority

Physical Corruption Only
Silent Corruption Ignored

Checksum Equals Authentication
Hash Equals Encryption

Sampling Equals Full Verification

Reconciliation Equals Synchronization
Tolerance Without Definition

LWW Used to Repair Semantic Conflict

Blind Repair
Repair Without Snapshot
Repair Without Verification

Manual Production SQL Without Audit
Concurrent Repair Overwrites Valid Write

Migration Without Integrity Verification
Backfill Without Reconciliation

Cross-Tenant Repair
Cross-Tenant Reference

Provenance Without Protection
Lineage Everywhere Without Need
```

---

# 332. Relación con ENG-036

Validation evita que Inputs inválidos entren al sistema.

ENG-079 comprueba que State continúe siendo íntegro después de:

```text
persistence
concurrency
migration
replication
recovery
transformation
```

---

# 333. Relación con ENG-035

Domain Engineering es Owner de:

```text
business rules
aggregate rules
domain invariants
```

ENG-079 proporciona mecanismos de protección, verificación y reparación.

---

# 334. Relación con ENG-042

Transaction Engineering permite preservar conjuntos de Integrity Rules atómicamente.

---

# 335. Relación con ENG-043

Data Access deberá evitar mapping o conversiones que introduzcan corrupción semántica.

---

# 336. Relación con ENG-062

Schema Engineering protege forma estructural.

ENG-079 extiende Integrity hacia:

```text
relationships
meaning
domain invariants
cross-system state
```

---

# 337. Relación con ENG-063

Transformation Engineering deberá preservar significado, precisión y completitud según Contract.

---

# 338. Relación con ENG-065

Migration Engineering deberá verificar:

```text
source
transformed state
target
cutover
```

y reconciliar diferencias antes de completar Migration.

---

# 339. Relación con ENG-076

Recovery puede restaurar State, pero ENG-079 deberá verificar que el State restaurado sea íntegro.

---

# 340. Relación con ENG-077

Durability garantiza supervivencia del State.

Integrity garantiza validez del contenido superviviente.

---

# 341. Relación con ENG-078

Consistency determina qué versión puede observarse.

Integrity determina si dicha versión satisface las reglas válidas del Domain.

---

# 342. Relación con ENG-080

**ENG-080 deberá formalizar Data Quality Engineering.**

La frontera será:

```text
DATA INTEGRITY
ENG-079
→ Is the state valid according to
  structural, referential and domain rules?

DATA QUALITY
ENG-080
→ Is the data sufficiently complete,
  accurate, timely, relevant and fit
  for its intended use?
```

ENG-080 deberá cubrir:

```text
Data Quality
Quality Requirement
Quality Objective

Fitness for Purpose

Completeness
Accuracy
Validity
Consistency
Timeliness
Freshness
Uniqueness

Relevance

Data Quality Dimension
Data Quality Rule

Data Quality Score
Quality Threshold

Data Profile
Data Profiling

Distribution
Null Rate
Duplicate Rate

Outlier
Anomaly

Reference Data Quality
Master Data Quality

Data Quality Issue
Quality Incident

Quality Drift
Distribution Drift

Data Quality Validation
Quality Monitoring

Data Quality Gate

Data Stewardship
Quality Ownership

Quality Remediation

Data Quality Security
Data Quality Audit
Data Quality Observability
Data Quality Testing
```

---

# 343. Principio Rector

> **MEF deberá tratar Data Integrity como la preservación verificable del significado y las invariantes del State. Almacenar, replicar o recuperar correctamente bytes no será suficiente si esos bytes representan relaciones imposibles, entidades duplicadas, referencias rotas o un estado que viola el dominio. Toda corrección deberá partir de Authority conocida y terminar con Verification explícita.**

---

# 344. Conclusión

**ENG-079 — Data Integrity Engineering** formaliza cuándo el State de MEF puede considerarse válido y confiable.

Las capas fundamentales quedan:

```text
DATA
 │
 ▼
STRUCTURAL INTEGRITY
 │
 ▼
ENTITY INTEGRITY
 │
 ▼
REFERENTIAL INTEGRITY
 │
 ▼
DOMAIN INTEGRITY
 │
 ▼
SEMANTICALLY VALID STATE
```

La diferencia con las disciplinas anteriores queda:

```text
DURABILITY
ENG-077
│
└── ¿sobrevive el State?

CONSISTENCY
ENG-078
│
└── ¿qué versión del State
    observamos?

INTEGRITY
ENG-079
│
└── ¿esa versión es válida?
```

Ejemplo:

```text
ACCOUNT
balance = -500

Replica A → -500
Replica B → -500
Replica C → -500
```

Podría existir:

```text
DURABILITY     ✓
CONSISTENCY    ✓
INTEGRITY      ✗
```

si el Domain declara:

```text
balance >= 0
```

La cadena de Integrity queda:

```text
INPUT
  │
  ▼
VALIDATE
  │
  ▼
DOMAIN
  │
  ▼
PERSIST
  │
  ▼
VERIFY
  │
  ▼
RECONCILE
```

No basta con validar únicamente la entrada, porque Integrity puede romperse posteriormente mediante:

```text
Concurrency
Migration
Manual Mutation
Bad Integration
Storage Corruption
Transformation
Recovery
```

La relación Authority/Reconciliation queda:

```text
SYSTEM A
    │
    │
    ├─────► RECONCILIATION ◄─────┐
    │                            │
SYSTEM B                         │
    │                            │
    └────────────────────────────┘
                 │
                 ▼
        DETERMINE DIFFERENCE
                 │
       ┌─────────┼─────────┐
       ▼         ▼         ▼
     MATCH    MISSING   CONFLICT
```

La reparación correcta queda:

```text
VIOLATION
   │
   ▼
DETERMINE SCOPE
   │
   ▼
DETERMINE AUTHORITY
   │
   ▼
CREATE BACKUP/SNAPSHOT
   │
   ▼
DRY RUN
   │
   ▼
REPAIR
   │
   ▼
VERIFY INVARIANTS
   │
   ▼
RECONCILE
```

y no:

```text
bad data
   │
   ▼
manual SQL guess
   │
   ▼
hope
```

La Provenance y Lineage quedan:

```text
SOURCE
  │
  ▼
INGEST
  │
  ▼
TRANSFORM
  │
  ▼
STORE
  │
  ▼
PROJECTION
  │
  ▼
CONSUMER
```

permitiendo responder:

```text
Where did this value come from?
What transformed it?
Which systems received it?
What is the corruption blast radius?
```

La cadena reciente queda:

```text
MAINTAINABILITY
ENG-075
   │
   ▼
RECOVERABILITY
ENG-076
   │
   ▼
DURABILITY
ENG-077
   │
   ▼
CONSISTENCY
ENG-078
   │
   ▼
DATA INTEGRITY
ENG-079
   │
   ▼
DATA QUALITY
ENG-080
```

La primera implementación deberá concentrarse en:

```text
IntegrityState

IntegrityRequirement
IntegrityConstraint
IntegrityViolation
IntegrityPolicy

IntegrityVerifier
IntegrityVerificationResult

ReconciliationPolicy
ReconciliationResult

RepairPlan
RepairResult

ProvenanceRecord

IntegrityRuntime
IntegrityRegistry
IntegrityError
```

con:

```text
Explicit Authority
Structural Integrity
Semantic Integrity
Entity Integrity
Referential Integrity
Domain Integrity

Constraints
Invariants
Completeness
Uniqueness

Corruption Detection
Verification

Source of Truth
Cross-System Reconciliation

Orphans
Duplicates
Missing Records
Conflicts

Repair Planning
Dry Run
Repair Verification

Provenance
Lineage Awareness

Multi-Tenant Integrity

Security
Audit
Observability
Testing
```

antes de introducir:

```text
Continuous Full Integrity Verification
Automatic Data Repair
Semantic Duplicate Resolution
Automated Lineage Discovery
Predictive Integrity Drift
Cross-System Integrity Graph
AI-Assisted Integrity Engineering
```

Con **ENG-079**, la serie global alcanza:

```text
EI-1545
```

---

# Referencias

## Arquitectura

- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-038 — Concurrency Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-053 — State Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-076 — Recoverability Engineering
- ENG-077 — Durability Engineering
- ENG-078 — Consistency Engineering
- ENG-080 — Data Quality Engineering
```