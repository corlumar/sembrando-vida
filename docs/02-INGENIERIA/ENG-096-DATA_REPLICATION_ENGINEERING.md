---
id: ENG-096
titulo: Data Replication Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Replication Engineering
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
  - ENG-032
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-046
  - ENG-048
  - ENG-051
  - ENG-053
  - ENG-054
  - ENG-061
  - ENG-062
  - ENG-070
  - ENG-071
  - ENG-072
  - ENG-073
  - ENG-074
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-079
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-085
  - ENG-092
  - ENG-093
  - ENG-095

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-027
  - ENG-031
  - ENG-033
  - ENG-034
  - ENG-035
  - ENG-037
  - ENG-040
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-058
  - ENG-059
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-080
  - ENG-084
  - ENG-086
  - ENG-087
  - ENG-088
  - ENG-089
  - ENG-090
  - ENG-091
  - ENG-094
  - ENG-097

keywords:
  - data-replication
  - replication
  - replica
  - replica-set
  - replication-factor
  - leader
  - follower
  - primary
  - secondary
  - synchronous-replication
  - asynchronous-replication
  - quorum
  - failover
  - promotion
  - split-brain
  - replication-lag
  - read-replica
  - log-shipping
  - replica-rebuild
  - mef

---

# ENG-096 — Data Replication Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Replication Engineering**
de **MEF (Modular Enterprise Framework)**.

ENG-096 establece reglas para:

Data Replication

Replication Requirement
Replication Contract
Replication Policy

Replication Identity

Replica
Replica Identity

Replica Set

Replication Factor

Primary
Secondary

Leader
Follower

Leaderless Replication

Single-Leader Replication
Multi-Leader Replication

Synchronous Replication
Asynchronous Replication
Semi-Synchronous Replication

Physical Replication
Logical Replication

Full Replica
Partial Replica

Read Replica

Local Replica
Remote Replica

Cross-Zone Replication
Cross-Region Replication

Replication Topology

Replication Log

Replication Position

Log Sequence Number

Offset

Replication Lag

Replica Freshness

Replica Consistency

Replica State

Read Routing
Write Routing

Replica Selection

Read-After-Write

Monotonic Reads

Quorum

Read Quorum
Write Quorum

Failover

Promotion
Demotion

Leader Election

Fencing

Split Brain

Replica Divergence

Replica Drift

Replica Catch-Up

Replica Rebuild

Snapshot Seeding

Log Shipping

Replication Gap

Replication Integrity

Replication Recovery

Deletion Replication

Tombstone Replication

Replication Security
Replication Privacy
Replication Governance
Replication Compliance

Replication Observability
Replication Diagnostics
Replication Testing

---

# 2. Declaración

> **MEF deberá tratar Data Replication como la creación y mantenimiento controlado de copias adicionales de Data o State para satisfacer Requirements explícitos de Availability, Durability, Locality, Scale o Recovery. La existencia de múltiples copias no deberá considerarse automáticamente alta disponibilidad, consistencia, durabilidad ni protección frente a pérdida lógica.**

Arquitectura conceptual:

```text
                 WRITE
                   │
                   ▼
               LEADER
              /   │   \
             /    │    \
            ▼     ▼     ▼
        REPLICA REPLICA REPLICA
           A       B       C
            \      │      /
             \     │     /
              ▼    ▼    ▼
             READ ROUTING

---

# 3. Frontera de Autoridad

ENG-096 es autoritativo para crear y mantener copias adicionales de Data/State cuando el objetivo primario sea Availability, Durability, Locality, Scale o Recovery.

Synchronization permanece en ENG-095; Consistency en ENG-078; Durability en ENG-077; Partitioning/Sharding en ENG-097; Distribution en ENG-098; Residency en ENG-099.

---

# 4. Replication ≠ Backup

Replication mantiene copias activas o recuperables cercanas al estado operacional. Backup preserva puntos de recuperación independientes. Replicar corrupción o borrado no constituye Backup.

---

# 5. Replication ≠ Synchronization

Replication puede usar mecanismos de sincronización, pero su contrato gira alrededor de copies, topology, acknowledgement, lag, failover y recovery.

---

# 6. Replication Requirement

Requirement deberá expresar objetivo: availability, durability, locality, scale, recovery, read capacity u otro. `replicationFactor=3` no expresa por sí solo la garantía.

---

# 7. Replication Identity

Replication configuration, replica set, replica y replication epoch deberán tener identidades distinguibles.

---

# 8. Replication Contract

Contract deberá declarar topology, roles, write authority, mode, acknowledgement, consistency/freshness expectation, failure domains, lag budget, failover, rebuild, integrity y lifecycle.

---

# 9. Replication Policy

Policy podrá definir replication factor, eligible locations, sync/async mode, promotion rules, lag limits, read routing, rebuild, quarantine y exceptions.

---

# 10. Replica y Replica Identity

Cada Replica deberá tener Identity estable independiente de host/volume actual. Rebuild no deberá crear ambigüedad sobre lineage o epoch.

---

# 11. Replica Set

Replica Set representa participantes que mantienen una representación replicada bajo un contrato común. Membership deberá versionarse.

---

# 12. Replication Factor

Replication Factor cuenta copias elegibles bajo una definición explícita. No deberá incluir witnesses o stale/unhealthy replicas salvo que el contrato lo declare.

---

# 13. Primary / Secondary

Primary/Secondary son roles de authority/topology. Secondary no deberá aceptar writes incompatibles con el contrato.

---

# 14. Leader / Follower

Leader/Follower deberá distinguirse de Primary/Secondary cuando semantics difieran. Leader election y write fencing deberán compartir epoch/term.

---

# 15. Single-Leader Replication

Single-Leader deberá garantizar una autoridad de escritura por epoch y una ruta explícita de promotion.

---

# 16. Multi-Leader Replication

Multi-Leader exige conflict semantics, causality y convergence; no deberá presentarse como extensión trivial de Single-Leader.

---

# 17. Leaderless Replication

Leaderless deberá definir quorum, version/causality, repair y conflict resolution suficientes. `No leader` no significa `no authority model`.

---

# 18. Synchronous Replication

Sync Replication sólo podrá acknowledge cuando se cumpla la regla de durability/visibility declarada en las replicas requeridas.

---

# 19. Asynchronous Replication

Async Replication deberá declarar data-loss window potencial y lag. Acknowledge local no deberá presentarse como remote durability.

---

# 20. Semi-Synchronous Replication

Semi-Sync deberá definir exactamente qué replicas/conditions intervienen antes de acknowledge; el nombre no constituye una garantía.

---

# 21. Physical y Logical Replication

Physical replica bytes/storage layout; Logical replica operations/rows/events. Compatibilidad, filtering y schema evolution deberán diferenciarse.

---

# 22. Full y Partial Replica

Partial Replica deberá declarar subset y consecuencias de routing/failover. No podrá satisfacer queries fuera de su scope.

---

# 23. Read Replica

Read Replica deberá publicar freshness/consistency capability. Un consumer no deberá asumir read-after-write si el contract no la garantiza.

---

# 24. Local / Remote / Cross-Zone / Cross-Region

Location describe placement, no autoridad. Failure domain y Residency deberán evaluarse independientemente.

---

# 25. Replica State

Estados como INITIALIZING, CATCHING_UP, HEALTHY, LAGGING, DEGRADED, QUARANTINED o REBUILDING deberán ser observables y gobernar eligibility.

---

# 26. Replication Log y Ordering

Log/stream deberá preservar identity y ordering suficiente. Gaps o corruption deberán bloquear promoción segura hasta resolver uncertainty.

---

# 27. Acknowledgement

Ack deberá referir durability/visibility concreta y epoch. Acknowledgement de miembros no elegibles no deberá contar para una garantía mayor.

---

# 28. Quorum

Read/Write Quorum deberá definirse sobre membership versionado. Quorum arithmetic no sustituye fencing ni consistency semantics.

---

# 29. Read Routing

Read Routing deberá considerar replica health, freshness, consistency requirement, locality y residency.

---

# 30. Write Routing

Writes deberán dirigirse a la autoridad válida del epoch. Stale routing deberá rechazarse o redirigirse de forma segura.

---

# 31. Read-After-Write y Monotonic Reads

Estas garantías deberán declararse como capabilities y no inferirse por la mera existencia de replicas.

---

# 32. Failover

Failover deberá diferenciar detection, decision, fencing, promotion, routing update y recovery. Cada etapa deberá ser observable.

---

# 33. Promotion y Demotion

Promotion exige eligibility y fencing. Demotion deberá invalidar write authority anterior y actualizar epoch.

---

# 34. Leader Election

Election deberá producir un único resultado válido por term/epoch conforme al modelo de consenso o coordinación utilizado.

---

# 35. Fencing

Fencing deberá impedir que una autoridad obsoleta continúe aceptando writes. Network isolation por sí sola no es fencing suficiente.

---

# 36. Split Brain

Split Brain deberá prevenirse o detectarse rápidamente; coexistencia de writes incompatibles deberá entrar en recovery/reconciliation explícito.

---

# 37. Replica Divergence y Drift

Divergence de contenido y lag temporal deberán distinguirse. Drift podrá requerir compare/checksum/merkle/sequence validation.

---

# 38. Replica Catch-Up

Catch-Up deberá verificar base, log position, continuity e integrity antes de marcar una replica current.

---

# 39. Replica Rebuild

Rebuild deberá preservar identity lineage, controls y eligibility state; no deberá servir tráfico antes de verificación.

---

# 40. Snapshot Seeding

Snapshot deberá estar asociado a version/position y verificarse antes de aplicar logs posteriores.

---

# 41. Log Shipping

Shipping deberá detectar gaps, duplicates, ordering violations y corruption; retry deberá ser idempotente.

---

# 42. Replication Gap

Gap deberá bloquear claims de completeness y activar backfill/reseed/recovery según policy.

---

# 43. Replication Integrity

Checksums, sequence continuity o validation equivalente deberán detectar corrupción y divergence.

---

# 44. Deletion y Tombstone Replication

Deletes deberán mantener semantics suficientes para impedir resurrection desde replicas retrasadas.

---

# 45. Recovery

Recovery deberá declarar RPO/RTO si se prometen, data-loss risk, source selection, promotion/rebuild path y post-recovery verification.

---

# 46. Security, Privacy, Governance y Compliance

Replicas heredan classification, authorization, encryption, retention, privacy y governance. Copias no deberán reducir controles.

---

# 47. Residency y Multi-Tenancy

Replica placement deberá respetar ENG-099 y tenant isolation. Failover no podrá violar Residency para recuperar Availability.

---

# 48. Observability

Role, term/epoch, membership, lag, ack/quorum, health, promotion, rebuild, gaps, divergence y data-loss risk deberán ser observables.

---

# 49. Diagnostics

Diagnostics deberá explicar eligibility, failure reason, stale reads, promotion blocks, fencing y rebuild state.

---

# 50. Testing

Testing cubrirá partitions, failover, stale authority, quorum changes, lag, rebuild, corrupt log, deletes, recovery, residency y tenant isolation.

---

# 51. Primera Implementación Obligatoria

La primera implementación deberá soportar topology explícita, replica identity, lag, membership, controlled promotion, fencing, integrity checks y rebuild verificable.

---

# 52. Invariantes de Ingeniería

ENG-096 define exactamente veinte invariantes propios en el rango `EI-1866 → EI-1885`.

| Invariante | Regla |
|---|---|
| EI-1866 | Toda Replica deberá pertenecer a un Replication Contract explícito. |
| EI-1867 | Cada Replica deberá tener identidad y role observables. |
| EI-1868 | Write Authority deberá ser inequívoca para cada epoch o término. |
| EI-1869 | Una réplica asíncrona no deberá anunciar durabilidad síncrona. |
| EI-1870 | Los acknowledgements deberán corresponder a miembros elegibles conocidos. |
| EI-1871 | Replica Lag deberá medirse contra una referencia explícita. |
| EI-1872 | Read Routing deberá respetar freshness y consistency requeridas. |
| EI-1873 | Promotion deberá requerir fencing de la autoridad anterior. |
| EI-1874 | Split-Brain deberá prevenirse o detectarse antes de aceptar writes incompatibles. |
| EI-1875 | Replica Catch-Up deberá validar continuidad antes de servir como current. |
| EI-1876 | Snapshot Seeding deberá verificar integrity y posición de log. |
| EI-1877 | Rebuild no deberá perder controles de Security, Privacy o Governance. |
| EI-1878 | Deletes y Tombstones deberán replicarse sin resurrection silenciosa. |
| EI-1879 | Una replica corrupta deberá poder aislarse sin declararla healthy. |
| EI-1880 | Membership changes deberán ser versionados y auditables. |
| EI-1881 | Replication no deberá confundirse con Backup ni Preservation. |
| EI-1882 | Replication no deberá violar Residency o tenant isolation. |
| EI-1883 | Observability deberá exponer lag, role, quorum y failover state. |
| EI-1884 | Recovery deberá declarar posible data loss antes de promotion degradada. |
| EI-1885 | La implementación deberá demostrar failover y rebuild sin autoridad ambigua. |

---

# 53. Continuidad de Invariantes

```text
ENG-095 → EI-1846 a EI-1865
ENG-096 → EI-1866 a EI-1885
ENG-097 → EI-1886 a EI-1905
```

---

# 54. Criterios de Conformidad

Conformidad requiere topology/roles explícitos, write authority inequívoca por epoch, acknowledgement verificable, lag observable, fencing, failover controlado, rebuild seguro, integrity y los invariantes EI-1866 → EI-1885.

---

# 55. Riesgos

Riesgos: split-brain, stale promotion, quorum mal contado, fake durability, unbounded lag, stale reads, resurrection de deletes, replica drift, corrupted seeding, failover que viola Residency y observability insuficiente.

---

# 56. Relación con ENG-095

ENG-095 gobierna Synchronization/convergence. ENG-096 puede reutilizar change propagation, pero el contrato de Replica, quorum, failover y durability pertenece a ENG-096.

---

# 57. Relación con ENG-097

ENG-097 gobierna Partitioning/Sharding. Cada shard puede replicarse; replication factor no define partition count ni ownership.

---

# 58. Relación con ENG-100

ENG-100 coordina Replication dentro del Lifecycle; ENG-096 mantiene autoridad sobre replicas, topology, failover, fencing y rebuild.

---

# 59. Principio Rector

> **Multiple copies ≠ replicated guarantee. Replication sólo será válida cuando topology, authority, acknowledgement, lag, failover, fencing, integrity y recovery sean explícitos y verificables.**

---

# 60. Conclusión

ENG-096 establece el modelo normativo de Data Replication de MEF y define EI-1866 → EI-1885 sin absorber Consistency, Durability, Synchronization, Partitioning, Distribution o Residency.

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
- ENG-097 — Data Partitioning & Sharding Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
