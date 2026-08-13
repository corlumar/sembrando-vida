---
id: ENG-095
titulo: Data Synchronization Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Synchronization Engineering
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
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-046
  - ENG-048
  - ENG-051
  - ENG-053
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-070
  - ENG-073
  - ENG-074
  - ENG-079
  - ENG-080
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-085
  - ENG-087
  - ENG-089
  - ENG-092
  - ENG-094

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-027
  - ENG-034
  - ENG-035
  - ENG-037
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-054
  - ENG-055
  - ENG-058
  - ENG-059
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-071
  - ENG-072
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-084
  - ENG-086
  - ENG-088
  - ENG-090
  - ENG-091
  - ENG-093
  - ENG-096

keywords:
  - data-synchronization
  - sync
  - replication
  - change-data-capture
  - cdc
  - checkpoint
  - watermark
  - change-set
  - synchronization-contract
  - conflict-resolution
  - reconciliation
  - drift
  - resynchronization
  - tombstone
  - deletion-propagation
  - source-of-truth
  - multi-master
  - idempotency
  - replay
  - mef

---

# ENG-095 — Data Synchronization Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Synchronization Engineering**
de **MEF (Modular Enterprise Framework)**.

ENG-095 establece reglas para:

Data Synchronization

Synchronization Requirement
Synchronization Contract
Synchronization Policy

Synchronization Identity

Source
Target

Synchronization Participant

Replica
Projection
Materialized Copy

Authoritative Source
Source of Truth

Synchronization Direction

One-Way Synchronization
Two-Way Synchronization
Multi-Party Synchronization
Multi-Master Synchronization

Initial Synchronization
Full Synchronization
Partial Synchronization

Incremental Synchronization

Push Synchronization
Pull Synchronization

Polling
Event-Driven Synchronization

Change Detection
Change Data Capture

Change
Change Set

Change Identity

Checkpoint
Cursor
Watermark

Sequence
Ordering

Synchronization Window

Synchronization State

Synchronization Lag
Synchronization Freshness

Synchronization Consistency

Conflict Detection
Conflict Resolution

Conflict Policy

Authority Resolution

Last-Write-Wins
First-Write-Wins
Merge
Reject
Manual Resolution

Duplicate Detection
Idempotency

Replay

Gap Detection
Backfill

Loop Prevention
Echo Suppression

Deletion Propagation
Tombstone Propagation

Schema Synchronization
Schema Evolution

Identity Mapping
Reference Mapping

Resynchronization

Reconciliation

Synchronization Drift
Drift Detection
Drift Repair

Synchronization Failure

Synchronization Security
Synchronization Privacy
Synchronization Governance
Synchronization Compliance

Synchronization Observability
Synchronization Diagnostics
Synchronization Testing

---

# 2. Declaración

> **MEF deberá tratar Data Synchronization como mantenimiento continuo y verificable de correspondencia entre representaciones de Data que pueden cambiar independientemente. Sincronizar no deberá significar copiar ciegamente el último valor observado. Todo Synchronization material deberá declarar Authority, Direction, Identity, Change Semantics, Ordering, Conflict Policy, Deletion Semantics, Checkpoints y Reconciliation suficientes para determinar cómo convergen los participantes.**

Arquitectura conceptual:

```text
SOURCE A
   │
   │ changes
   ▼
CHANGE DETECTION
   │
   ▼
CHANGE SET
   │
   ▼
SYNC CONTRACT
   │
   ▼
VALIDATION
   │
   ▼
MAPPING
   │
   ▼
TARGET B
   │
   ▼
RECONCILIATION
   │
   ├── MATCHED
   ├── DRIFT
   └── CONFLICT

---

# 3. Frontera de Autoridad

ENG-095 es autoritativo para mantener correspondencia continua y verificable entre representaciones de Data que pueden cambiar de manera independiente.

```text
ENG-095 → Synchronization / convergence / change propagation
ENG-096 → Replication copies for availability/durability/locality
ENG-097 → Partitioning & Sharding
ENG-098 → Distribution / placement
ENG-099 → Localization & Residency
ENG-100 → Data Lifecycle Orchestration
```

Synchronization no deberá absorber autoridad de Replication, Distribution, Residency ni Lifecycle.

---

# 4. Synchronization ≠ Replication

Synchronization busca correspondencia y convergencia entre representaciones. Replication crea y mantiene copias bajo garantías de disponibilidad, durabilidad, localidad, escala o recovery. Una implementación puede usar ambos mecanismos, pero deberá conservar contratos y métricas independientes.

---

# 5. Synchronization Identity

Todo flujo material deberá poseer una identidad estable, separada de endpoints, jobs, schedulers o conexiones concretas. La identidad deberá permitir correlacionar runs, checkpoints, retries, conflicts y evidence.

---

# 6. Synchronization Scope

Scope deberá definir qué Data, entidades, campos, tenants, particiones, ventanas temporales o dominios participan. `Not in Scope` no deberá interpretarse como `Deleted`.

---

# 7. Synchronization Boundary

Boundary deberá declarar límites técnicos, contractuales, organizacionales y jurisdiccionales. El cruce de una Boundary deberá activar Validation, Authorization, Policy y Evidence aplicables.

---

# 8. Synchronization Contract

El Contract deberá declarar participantes, direction, authority, identity mapping, change semantics, ordering, checkpoint, conflict policy, deletion semantics, schema expectations, reconciliation y lifecycle.

---

# 9. Synchronization Policy

Policy podrá gobernar sources permitidos, directions, schedule, freshness objective, conflict policy, retry, backfill, deletion, privacy, residency, suspension y manual review.

---

# 10. Source y Target

Source y Target son roles de una operación o direction concreta. En Two-Way o Multi-Party Synchronization un mismo Participant podrá actuar en ambos roles en distintos changes.

---

# 11. Synchronization Participant

Participant deberá tener Identity, capabilities, schema/version, authority scope y health suficientes. Endpoint físico y Participant Identity no deberán confundirse.

---

# 12. Authoritative Source y Source of Truth

Cuando exista una fuente autoritativa deberá declararse su Scope. `Source of Truth` no deberá utilizarse como etiqueta global si la autoridad sólo aplica a determinadas entidades, campos o epochs.

---

# 13. Synchronization Direction

Direction deberá ser explícita: One-Way, Two-Way, Multi-Party o Multi-Master. Cambiar direction constituye un cambio contractual material.

---

# 14. One-Way Synchronization

En One-Way Sync el Target no deberá originar changes que pretendan modificar la autoridad del Source salvo que exista un canal contractual separado.

---

# 15. Two-Way Synchronization

Two-Way Sync deberá definir origin attribution, loop prevention, conflict detection y convergence. Dos directions no equivalen automáticamente a Multi-Master authority.

---

# 16. Multi-Party y Multi-Master

Multi-Party coordina más de dos Participants. Multi-Master permite múltiples autoridades de escritura y exige reglas explícitas de conflict resolution, ordering y causality suficientes.

---

# 17. Initial y Full Synchronization

Initial/Full Sync deberá producir un baseline identificable, consistent enough para el contrato y asociado a un checkpoint o epoch. No deberá ocultar partial completion.

---

# 18. Partial e Incremental Synchronization

Partial Sync deberá declarar criterio de subset. Incremental Sync deberá partir de un cursor/checkpoint verificable y detectar gaps.

---

# 19. Push, Pull, Polling y Event-Driven

Push/Pull describen direction operacional; Polling/Event-Driven describen mecanismos de detección/entrega. Ninguno de estos términos define por sí mismo authority o conflict semantics.

---

# 20. Change Detection y CDC

Change Detection/CDC deberá producir Change Identity, origin, sequence/version, timestamp cuando sea material y payload/reference suficiente. La detección no deberá alterar Data por sí sola.

---

# 21. Change Set

Change Set agrupa cambios bajo una frontera de aplicación, ordering o checkpoint. Atomicidad sólo podrá afirmarse cuando el Store y Contract la garanticen.

---

# 22. Cursor, Checkpoint y Watermark

Cursor identifica posición de lectura; Checkpoint representa progreso durable aplicado; Watermark representa frontera temporal o lógica de completitud. No deberán utilizarse como sinónimos universales.

---

# 23. Ordering y Causality

Cuando el resultado dependa del orden, el contrato deberá declarar total, partitioned, causal o best-effort ordering. Arrival order no deberá considerarse automáticamente source order.

---

# 24. Conflict Detection

Conflict deberá distinguir concurrent update, stale update, divergent delete, identity collision, schema mismatch y authority conflict cuando sean materiales.

---

# 25. Conflict Resolution

LWW, FWW, Merge, Reject o Manual Resolution deberán declarar precondiciones, determinismo, evidence y posible pérdida de información. Resolver no equivale a demostrar truth.

---

# 26. Duplicate Detection e Idempotency

Todo retry/replay material deberá ser seguro. Duplicate Detection deberá usar Change Identity o clave idempotente suficiente; igualdad de payload no es una identidad confiable por sí sola.

---

# 27. Replay

Replay deberá preservar ordering/authority semantics y no avanzar checkpoints de manera inconsistente. Reprocesar history no deberá crear efectos adicionales fuera del contrato.

---

# 28. Gap Detection y Backfill

La ausencia de secuencias, windows o watermarks deberá ser detectable. Backfill deberá ser scoped, idempotent/recoverable y reconciliarse con traffic concurrente.

---

# 29. Loop Prevention y Echo Suppression

Two-Way y Multi-Party Sync deberán prevenir recirculación de un mismo change mediante origin/correlation/version semantics. Echo Suppression no deberá descartar cambios genuinos.

---

# 30. Deletion Propagation y Tombstones

Delete deberá poseer semántica explícita. Tombstone deberá tener identity, scope, version y retention suficientes para impedir resurrection por participants retrasados.

---

# 31. Schema Synchronization y Evolution

Schema changes deberán versionarse. Compatibilidad, mapping, defaulting, unknown fields y breaking changes deberán definirse antes de aplicar Data incompatible.

---

# 32. Identity y Reference Mapping

Identity Mapping deberá ser versionable y reversible cuando el contrato lo requiera. Reference Mapping deberá preservar relationships o declarar pérdida/fallback explícitos.

---

# 33. Resynchronization

Resync deberá indicar cause, scope, baseline, expected effect, concurrency behavior y checkpoint reset/migration. No deberá destruir evidence del estado divergente previo.

---

# 34. Reconciliation

Reconciliation compara expected/authoritative state con observed state y produce matched, drift, conflict o unknown. Repair deberá ser una acción separada y autorizada.

---

# 35. Synchronization Drift

Drift deberá medirse respecto de una expectativa explícita. Freshness lag, value divergence y missing entities deberán distinguirse.

---

# 36. Synchronization Failure

Fallos parciales deberán conservar pending scope, last safe checkpoint, failed change, retry state y uncertainty. `Job completed` no deberá equivaler a `Data converged`.

---

# 37. Security y Authorization

ENG-024 y ENG-046 conservan autoridad general. Credentials, channels, operation authorization y administrative actions deberán protegerse por Boundary.

---

# 38. Privacy, Governance y Compliance

Personal/regulated Data deberá sincronizarse bajo Purpose, minimization, retention, classification, evidence y obligations aplicables. Staging y dead-letter artifacts también quedan gobernados.

---

# 39. Residency y Multi-Tenancy

ENG-099 gobierna Residency y ENG-048 Multi-Tenancy. Sync no deberá propagar Data a Participant, region o tenant no elegible.

---

# 40. Observability

Deberán observarse lag, freshness, backlog, checkpoint age, throughput, retries, conflicts, gaps, tombstones, drift y reconciliation outcomes.

---

# 41. Diagnostics

Diagnostics deberá permitir explicar por qué un change no fue aplicado, qué policy/contract/version intervino y cuál es el recovery path sin revelar payload sensible innecesario.

---

# 42. Testing

Testing deberá cubrir initial/full/incremental sync, retries, replay, gaps, conflict policies, deletes, schema evolution, resync, recovery, privacy, residency y tenant isolation.

---

# 43. Primera Implementación Obligatoria

La primera implementación deberá soportar One-Way Incremental Sync, durable checkpoint, idempotency, tombstones, gap detection, reconciliation, observability y recovery explícito. Multi-Master podrá diferirse.

---

# 44. Invariantes de Ingeniería

ENG-095 define exactamente veinte invariantes propios en el rango `EI-1846 → EI-1865`.

| Invariante | Regla |
|---|---|
| EI-1846 | Todo Synchronization material deberá tener un Synchronization Contract explícito. |
| EI-1847 | Todo Participant deberá poseer identidad estable dentro del contrato. |
| EI-1848 | Direction y Authority deberán declararse antes de propagar cambios. |
| EI-1849 | Un Change deberá tener identidad suficiente para duplicate detection e idempotency. |
| EI-1850 | Un Checkpoint no deberá avanzar antes de que el tramo correspondiente sea seguro. |
| EI-1851 | Replay no deberá producir efectos materiales duplicados. |
| EI-1852 | Ordering deberá declararse cuando el resultado dependa del orden. |
| EI-1853 | Los conflictos no deberán resolverse implícitamente por orden de llegada. |
| EI-1854 | Una política LWW/FWW/Merge deberá declarar sus precondiciones y pérdida aceptada. |
| EI-1855 | La eliminación deberá propagarse mediante semántica explícita, no por ausencia ambigua. |
| EI-1856 | Los gaps deberán ser detectables y reparables. |
| EI-1857 | Backfill y Resynchronization deberán ser idempotentes o compensables. |
| EI-1858 | Synchronization Drift deberá ser observable y reconciliable. |
| EI-1859 | Schema Evolution incompatible deberá bloquearse o transformarse explícitamente. |
| EI-1860 | Identity Mapping deberá preservar referencias o declarar su pérdida. |
| EI-1861 | Synchronization deberá respetar tenant isolation y autorización en cada frontera. |
| EI-1862 | Privacy, Retention y Residency deberán mantenerse durante sincronización y staging. |
| EI-1863 | Metrics y logs no deberán exponer Data sensible por defecto. |
| EI-1864 | Un fallo parcial no deberá producir convergencia falsa ni checkpoint engañoso. |
| EI-1865 | La implementación deberá demostrar convergencia verificable bajo retry, replay y recovery. |

---

# 45. Continuidad de Invariantes

```text
ENG-094 → EI-1826 a EI-1845
ENG-095 → EI-1846 a EI-1865
ENG-096 → EI-1866 a EI-1885
```

---

# 46. Criterios de Conformidad

Una implementación será conforme cuando modele Identity, Scope, Boundary, Contract, Direction y Authority; preserve Change Identity y checkpoints; detecte gaps/conflicts/drift; propague deletes de forma explícita; soporte replay/recovery seguro; y demuestre los invariantes EI-1846 → EI-1865 mediante pruebas y observabilidad.

---

# 47. Riesgos

Riesgos principales: autoridad implícita, LWW usado como verdad universal, loops, resurrection de deletes, checkpoint adelantado, gaps silenciosos, schema drift, identity mismatch, leakage cross-tenant, propagation a ubicaciones no elegibles y falsa convergencia.

---

# 48. Relación con ENG-094

ENG-094 gobierna Data Portability: export/package/transfer/import gobernado. Portability puede iniciar un movimiento puntual; Synchronization gobierna correspondencia continua posterior. `Transfer completed ≠ synchronized forever`.

---

# 49. Relación con ENG-096

ENG-096 gobierna Replication. Una Replica puede participar en Synchronization, pero el objetivo de Replication no deberá redefinirse como simple sincronización.

---

# 50. Relación con ENG-100

ENG-100 coordina Synchronization como parte del Data Lifecycle, pero ENG-095 permanece autoritativo para change propagation, checkpoints, conflicts, reconciliation y convergence.

---

# 51. Principio Rector

> **Synchronization deberá producir convergencia verificable bajo Authority, Direction, Identity, Ordering, Conflict y Deletion Semantics explícitas; copiar el último valor observado no constituye por sí solo sincronización correcta.**

---

# 52. Conclusión

ENG-095 establece el modelo normativo de Data Synchronization de MEF, con continuidad EI-1846 → EI-1865 y frontera explícita frente a Replication, Partitioning, Distribution, Residency y Lifecycle.

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
- ENG-096 — Data Replication Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
