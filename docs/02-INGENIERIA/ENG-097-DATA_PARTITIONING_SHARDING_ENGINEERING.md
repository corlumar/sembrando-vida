---
id: ENG-097
titulo: Data Partitioning & Sharding Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Partitioning & Sharding Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-13

dependencias:
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-030
  - ENG-036
  - ENG-038
  - ENG-042
  - ENG-043
  - ENG-046
  - ENG-048
  - ENG-051
  - ENG-053
  - ENG-054
  - ENG-056
  - ENG-057
  - ENG-059
  - ENG-062
  - ENG-070
  - ENG-071
  - ENG-072
  - ENG-073
  - ENG-074
  - ENG-075
  - ENG-076
  - ENG-079
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-085
  - ENG-095
  - ENG-096

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-027
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-034
  - ENG-035
  - ENG-037
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-055
  - ENG-058
  - ENG-061
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-077
  - ENG-078
  - ENG-080
  - ENG-084
  - ENG-086
  - ENG-087
  - ENG-088
  - ENG-089
  - ENG-090
  - ENG-091
  - ENG-092
  - ENG-093
  - ENG-094
  - ENG-098

keywords:
  - data-partitioning
  - partition
  - sharding
  - shard
  - partition-key
  - shard-key
  - partition-map
  - shard-map
  - horizontal-partitioning
  - vertical-partitioning
  - range-partitioning
  - hash-partitioning
  - consistent-hashing
  - repartitioning
  - resharding
  - rebalancing
  - hot-shard
  - skew
  - cross-shard
  - routing
  - mef

---

# ENG-097 — Data Partitioning & Sharding Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Partitioning & Sharding Engineering**
de **MEF (Modular Enterprise Framework)**.

ENG-097 establece reglas para:

Data Partitioning

Partitioning Requirement
Partitioning Contract
Partitioning Policy

Partition
Partition Identity

Partition Key
Partition Function

Partition Scheme
Partition Map

Horizontal Partitioning
Vertical Partitioning

Range Partitioning
Hash Partitioning
List Partitioning
Composite Partitioning

Temporal Partitioning
Tenant Partitioning
Geographic Partitioning

Shard
Shard Identity

Shard Key
Shard Map

Shard Placement
Shard Ownership

Shard Routing
Partition Routing

Partition Pruning

Virtual Shard
Physical Shard

Shard Count
Partition Count

Hot Partition
Hot Shard

Skew
Distribution Balance

Capacity Distribution

Repartitioning
Resharding

Shard Split
Shard Merge

Partition Split
Partition Merge

Shard Movement
Partition Movement

Rebalancing

Consistent Hashing
Hash Ring
Virtual Nodes

Cross-Partition Query
Cross-Shard Query

Cross-Partition Join
Cross-Shard Join

Cross-Partition Transaction
Cross-Shard Transaction

Global Index
Local Index

Global Identifier

Shard Affinity
Data Locality

Tenant Sharding
Geo Sharding

Shard Failure
Shard Recovery

Shard Replication

Partition Integrity

Partition Security
Partition Privacy
Partition Governance
Partition Compliance

Partition Observability
Partition Diagnostics
Partition Testing

---

# 2. Declaración

> **MEF deberá tratar Partitioning como la división contractual de un conjunto lógico de Data en subconjuntos identificables, y Sharding como la distribución de esos subconjuntos entre unidades independientes de almacenamiento o procesamiento. Toda estrategia material deberá declarar Key, Partition Function, Ownership, Routing, Placement, Balance y Repartitioning Semantics suficientes para localizar Data sin depender de conocimiento implícito o estático de la infraestructura.**

Arquitectura conceptual:

```text
                    LOGICAL DATASET
                          │
                          ▼
                   PARTITION FUNCTION
                          │
          ┌───────────────┼───────────────┐
          ▼               ▼               ▼
     PARTITION A     PARTITION B     PARTITION C
          │               │               │
          ▼               ▼               ▼
       SHARD A          SHARD B          SHARD C
          │               │               │
          ▼               ▼               ▼
        NODE 1          NODE 2          NODE 3

---

# 3. Frontera de Autoridad

ENG-097 es autoritativo para dividir un Data Domain en partitions/shards, asignar keys/functions, mantener maps, routing, ownership y movement de esas unidades.

Replication de cada shard corresponde a ENG-096; Distribution/placement global a ENG-098; Residency a ENG-099.

---

# 4. Partitioning ≠ Sharding

Partitioning divide lógicamente Data; Sharding asigna partitions a unidades independientes de almacenamiento/procesamiento. Una partición puede existir sin shard físico dedicado.

---

# 5. Partitioning Requirement

Requirement deberá expresar scale, isolation, locality, retention, parallelism, tenant, geographic u otro objetivo. Particionar sin requirement crea complejidad sin garantía.

---

# 6. Partitioning Contract

Contract deberá declarar key, function, scheme, map, ownership, routing, capacity, split/merge, rebalance, movement, recovery y compatibility.

---

# 7. Partitioning Policy

Policy podrá definir thresholds, eligible strategies, tenant/geographic constraints, split/merge, rebalancing y cross-shard limits.

---

# 8. Partition Identity

Partition deberá tener Identity estable independiente de node/location. Split/Merge deberán preservar ancestry o mapping.

---

# 9. Partition Key

Key deberá ser estable o migrable explícitamente. Sensitivity y hotspot risk deberán evaluarse.

---

# 10. Partition Function

Function deberá ser determinista por epoch y versionable. Cambiarla constituye repartitioning.

---

# 11. Partition Scheme

Scheme describe estrategia y parámetros. Version deberá asociarse al Partition Map.

---

# 12. Partition Map

Map resuelve key/range → partition/shard/owner. Deberá ser versionado, auditable y distribuido de forma consistente.

---

# 13. Horizontal Partitioning

Divide records/rows por key/range. Schema puede mantenerse común.

---

# 14. Vertical Partitioning

Divide fields/column groups. Identity y recomposition semantics deberán preservarse.

---

# 15. Range Partitioning

Ranges deberán ser explícitos, no superpuestos salvo transición controlada y cubrir el scope esperado o declarar gaps.

---

# 16. Hash Partitioning

Hash/function/version deberán declararse. Hash distribution no garantiza ausencia de hotspots semánticos.

---

# 17. List y Composite Partitioning

List usa conjuntos explícitos; Composite combina estrategias. Routing deberá permanecer determinista.

---

# 18. Temporal Partitioning

Time windows deberán definir timezone/clock/boundaries/late data y retention interaction.

---

# 19. Tenant Partitioning

Tenant partitioning no sustituye authorization. Cross-tenant leakage deberá impedirse independientemente del key.

---

# 20. Geographic Partitioning

Geographic partitioning deberá obedecer Residency y no inferir jurisdiction sólo desde location labels.

---

# 21. Shard y Shard Identity

Shard representa unidad independiente que contiene una o más partitions. Shard Identity deberá sobrevivir movement/restart cuando sea material.

---

# 22. Shard Key

Shard Key puede coincidir o no con Partition Key; cualquier transformación deberá ser explícita.

---

# 23. Shard Map

Shard Map relaciona logical partitions con shard ownership/location. Epoch mismatch deberá producir redirect/retry/reject seguro.

---

# 24. Routing

Read/Write Routing deberá usar map version conocida. Stale routing no deberá escribir en ownership inválido.

---

# 25. Ownership

Ownership deberá ser inequívoco por epoch. Transferencia de ownership exige handoff/fencing.

---

# 26. Capacity Distribution

Capacity deberá considerar size, throughput, IOPS, CPU, memory, skew y headroom, no sólo record count.

---

# 27. Hot Shard y Skew

Hotspot/skew deberán ser observables. Mitigation podrá incluir split, key redesign, virtual nodes o workload isolation.

---

# 28. Repartitioning y Resharding

Cambiar scheme/map deberá ser una operación versionada, reanudable y recuperable. No deberá depender de una big-bang silenciosa.

---

# 29. Partition/Shard Split

Split deberá definir cutover, copy/move, dual-read/write si existe, ownership epoch y cleanup.

---

# 30. Partition/Shard Merge

Merge deberá validar compatibility, capacity y references antes de consolidar.

---

# 31. Movement

Movement deberá preservar integrity y coordinate replication/distribution. Durante transición deberá existir una autoridad clara.

---

# 32. Rebalancing

Rebalancing deberá ser throttled, observable y cancelable/recoverable; no deberá degradar SLOs sin señalización.

---

# 33. Consistent Hashing

Hash ring, virtual nodes y token ownership deberán versionarse. Consistent hashing reduce movement esperado, no elimina rebalancing.

---

# 34. Cross-Partition Query

Query fan-out deberá declarar limits, timeout, partial results y consistency.

---

# 35. Cross-Shard Join

Join distribuido deberá declarar movement/cost/semantics; no deberá ocultarse detrás de una API con expectativa local.

---

# 36. Cross-Shard Transaction

Atomicity/consistency deberán depender de un Transaction/Consistency model explícito; ENG-097 no crea atomicidad por sí solo.

---

# 37. Global y Local Index

Global index requiere consistency/update semantics cross-shard; Local index sólo cubre shard/partition local.

---

# 38. Global Identifier

Identifiers deberán evitar colisiones y permanecer resolubles durante movement/split/merge.

---

# 39. Shard Affinity y Data Locality

Affinity podrá optimizar co-location, pero no deberá sobrepasar Residency, capacity o failure-domain constraints.

---

# 40. Shard Replication

Cada shard puede usar ENG-096. Replica membership y shard ownership deberán mantenerse diferenciados.

---

# 41. Shard Failure y Recovery

Failure deberá identificar affected partitions, ownership state, replicas y recovery plan.

---

# 42. Partition Integrity

Movement/split/merge deberán verificar counts/checksums/constraints o mecanismos equivalentes.

---

# 43. Security, Privacy, Governance y Compliance

Keys/maps no deberán filtrar sensitive metadata; movement respetará policies, retention y audit.

---

# 44. Residency y Multi-Tenancy

Geo/Tenant sharding deberá obedecer ENG-099 y ENG-048; partition key no constituye por sí sola una security boundary.

---

# 45. Observability

Map epoch, ownership, routing errors, hotspots, skew, movement, rebalance, capacity y cross-shard costs deberán ser observables.

---

# 46. Diagnostics

Diagnostics deberá explicar key→partition→shard→owner resolution y por qué un request fue redirected/rejected.

---

# 47. Testing

Testing cubrirá stale maps, concurrent split/merge, rebalance, movement interruption, skew, cross-shard operations, recovery, residency y tenancy.

---

# 48. Primera Implementación Obligatoria

Debe soportar stable identities, versioned map, deterministic routing, ownership epochs, controlled split/rebalance y integrity verification.

---

# 49. Invariantes de Ingeniería

ENG-097 define exactamente veinte invariantes propios en el rango `EI-1886 → EI-1905`.

| Invariante | Regla |
|---|---|
| EI-1886 | Todo Partitioning material deberá tener un Partitioning Contract explícito. |
| EI-1887 | Partition Key y Partition Function deberán ser deterministas para un epoch. |
| EI-1888 | Cada Shard deberá poseer identidad estable independiente de su ubicación física. |
| EI-1889 | Shard Map deberá ser versionado y auditable. |
| EI-1890 | Routing deberá usar una versión conocida del Shard Map. |
| EI-1891 | Un cambio de ownership no deberá producir doble autoridad silenciosa. |
| EI-1892 | Rebalancing deberá preservar Data Integrity. |
| EI-1893 | Shard Split deberá preservar identidad y referencias o mapearlas explícitamente. |
| EI-1894 | Shard Merge deberá validar compatibilidad antes de consolidar. |
| EI-1895 | Resharding deberá ser reanudable o tener recovery explícito. |
| EI-1896 | Hotspots y skew deberán ser observables. |
| EI-1897 | Cross-Shard operations deberán declarar sus garantías de consistencia. |
| EI-1898 | Replication Factor no deberá confundirse con número de partitions. |
| EI-1899 | Partition movement deberá respetar Residency y Privacy. |
| EI-1900 | Tenant isolation no deberá depender sólo de la Partition Key. |
| EI-1901 | Stale routing deberá detectarse y redirigirse o rechazarse de forma segura. |
| EI-1902 | Orphan shards deberán ser detectables y reconciliables. |
| EI-1903 | Capacity thresholds deberán ser explícitos y medibles. |
| EI-1904 | Metadata de partitioning no deberá convertirse en fuente no gobernada de verdad. |
| EI-1905 | La implementación deberá demostrar rebalance sin pérdida, duplicación material ni ownership ambiguo. |

---

# 50. Continuidad de Invariantes

```text
ENG-096 → EI-1866 a EI-1885
ENG-097 → EI-1886 a EI-1905
ENG-098 → EI-1906 a EI-1925
```

---

# 51. Criterios de Conformidad

Conformidad requiere Contract, Key/Function/Scheme/Map versionados, ownership inequívoco, routing seguro, movement/rebalance recuperable, integrity, tenancy/residency y EI-1886 → EI-1905.

---

# 52. Riesgos

Riesgos: stale maps, double ownership, orphan shards, hotspot, skew, hidden cross-shard cost, data loss during movement, global index drift, tenant leakage y geo-sharding incompatible con Residency.

---

# 53. Relación con ENG-096

ENG-096 replica shards/partitions pero no define su logical ownership. ENG-097 consume replication como capability subordinada.

---

# 54. Relación con ENG-098

ENG-098 coloca/mueve unidades distribuidas. ENG-097 define qué unidades lógicas existen y quién las posee; ENG-098 decide dónde pueden colocarse.

---

# 55. Relación con ENG-100

ENG-100 coordina repartitioning/movement dentro del Data Lifecycle, pero ENG-097 sigue siendo autoridad sobre partition/shard semantics.

---

# 56. Principio Rector

> **Partitioning deberá hacer explícita la función que divide Data y Sharding la autoridad que localiza esas partes; routing, ownership y movement no deberán depender de conocimiento implícito de infraestructura.**

---

# 57. Conclusión

ENG-097 establece Data Partitioning & Sharding Engineering de MEF y EI-1886 → EI-1905 con fronteras claras frente a Replication, Distribution, Residency y Lifecycle.

---

# Referencias

## Ingeniería

- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-033 — Interface Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-044 — API Engineering
- ENG-046 — Authorization Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-049 — Configuration Management Engineering
- ENG-051 — Policy Engineering
- ENG-052 — Workflow Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Data Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-066 — Upgrade Engineering
- ENG-067 — Deployment Engineering
- ENG-068 — Environment Engineering
- ENG-069 — Health & Readiness Engineering
- ENG-070 — Performance Engineering
- ENG-071 — Capacity Engineering
- ENG-072 — Scalability Engineering
- ENG-073 — Availability Engineering
- ENG-074 — Reliability Engineering
- ENG-075 — Maintainability Engineering
- ENG-076 — Recoverability Engineering
- ENG-077 — Durability Engineering
- ENG-078 — Consistency Engineering
- ENG-079 — Data Integrity Engineering
- ENG-080 — Data Quality Engineering
- ENG-081 — Data Governance Engineering
- ENG-082 — Data Privacy Engineering
- ENG-083 — Data Compliance Engineering
- ENG-084 — Data Ethics Engineering
- ENG-085 — Data Trust Engineering
- ENG-086 — Data Product Engineering
- ENG-087 — Data Exchange & Sharing Engineering
- ENG-088 — Data Federation Engineering
- ENG-089 — Data Lineage & Provenance Engineering
- ENG-090 — Data Catalog Engineering
- ENG-091 — Data Discovery & Classification Engineering
- ENG-092 — Data Retention & Disposal Engineering
- ENG-093 — Data Archival & Preservation Engineering
- ENG-094 — Data Portability Engineering
- ENG-095 — Data Synchronization Engineering
- ENG-096 — Data Replication Engineering
- ENG-098 — Data Distribution Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
