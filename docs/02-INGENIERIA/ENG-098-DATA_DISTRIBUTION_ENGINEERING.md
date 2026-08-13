---
id: ENG-098
titulo: Data Distribution Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Distribution Engineering
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
  - ENG-058
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
  - ENG-087
  - ENG-088
  - ENG-089
  - ENG-095
  - ENG-096
  - ENG-097

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-026
  - ENG-033
  - ENG-034
  - ENG-037
  - ENG-040
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-055
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
  - ENG-090
  - ENG-091
  - ENG-092
  - ENG-093
  - ENG-094
  - ENG-099

keywords:
  - data-distribution
  - distributed-data
  - topology
  - placement
  - locality
  - geo-distribution
  - regional-data
  - global-data
  - edge-data
  - data-mobility
  - distribution-routing
  - residency-aware-routing
  - latency-aware-routing
  - failure-domain
  - disconnected-operation
  - mef

---

# ENG-098 — Data Distribution Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Distribution Engineering**
de **MEF (Modular Enterprise Framework)**.

ENG-098 establece reglas para:

Data Distribution

Distribution Requirement
Distribution Contract
Distribution Policy

Distribution Scope
Distribution Strategy

Distribution Topology

Distribution Node
Distribution Site
Distribution Zone
Distribution Region

Failure Domain

Data Placement
Placement Policy
Placement Constraint

Data Location
Data Locality

Location Awareness
Location Transparency

Regional Data
Global Data
Edge Data

Geo Distribution
Edge Distribution

Centralized Distribution
Distributed Distribution
Hierarchical Distribution
Hub-and-Spoke Distribution
Mesh Distribution

Distribution Path

Data Propagation
Data Mobility
Data Movement

Placement Resolution

Read Locality
Write Locality

Read Routing
Write Routing

Nearest Eligible Location

Latency-Aware Routing
Residency-Aware Routing
Failure-Domain-Aware Routing

Distribution Replication
Distribution Partitioning

Distribution Consistency
Distribution Freshness

Distribution Availability
Distribution Reliability

Distribution Degradation

Disconnected Operation

Distribution Recovery
Distribution Reconciliation

Distribution Capacity
Distribution Performance

Distribution Security
Distribution Privacy
Distribution Governance
Distribution Compliance

Distribution Observability
Distribution Diagnostics
Distribution Testing

---

# 2. Declaración

> **MEF deberá tratar Data Distribution como una capacidad explícita para determinar cómo Data autorizado se coloca, localiza, mueve, propaga y accede a través de una Topology distribuida. Ninguna decisión de Placement o Routing deberá derivarse exclusivamente de proximidad física cuando existan restricciones superiores de Ownership, Security, Privacy, Residency, Compliance, Availability o Consistency.**

Arquitectura conceptual:

```text
                     LOGICAL DATA
                          │
                          ▼
                DISTRIBUTION POLICY
                          │
             ┌────────────┼────────────┐
             ▼            ▼            ▼
          REGION A      REGION B     REGION C
             │            │            │
        ┌────┴────┐   ┌───┴────┐   ┌───┴────┐
        ▼         ▼   ▼        ▼   ▼        ▼
      ZONE A1   A2   B1       B2   C1       C2
        │              │             │
        ▼              ▼             ▼
      NODE           NODE          NODE

---

# 3. Frontera de Autoridad

ENG-098 es autoritativo para placement, location, movement, propagation y serving de Data a través de una topology distribuida.

ENG-097 define partitions/shards; ENG-096 replicas; ENG-099 impone Residency/Localization constraints. Distribution deberá consumir esas autoridades sin redefinirlas.

---

# 4. Distribution ≠ Replication

Distribution decide placement/routing/movement; Replication decide copias y sus garantías. Multiple locations no prueban replication correctness.

---

# 5. Distribution ≠ Partitioning

Partitioning define unidades lógicas; Distribution coloca esas unidades y sus replicas en infraestructura elegible.

---

# 6. Distribution Requirement

Requirement deberá expresar availability, locality, latency, resilience, cost, sovereignty, disconnected operation u otro objetivo.

---

# 7. Distribution Contract

Contract deberá declarar units, topology, eligible locations, placement constraints, routing, movement, failure domains, degraded modes y lifecycle.

---

# 8. Distribution Policy

Policy podrá definir placement priorities, affinity/anti-affinity, capacity, cost, locality, failure-domain spread, residency y exceptions.

---

# 9. Distribution Scope

Scope deberá identificar Data units, tenants, products, regions, environments o classifications afectadas.

---

# 10. Distribution Strategy

Strategy deberá separar mandatory constraints de optimization objectives.

---

# 11. Distribution Topology

Topology podrá ser centralized, hierarchical, hub-and-spoke, mesh u otra. Deberá ser versionable cuando afecte routing/availability.

---

# 12. Distribution Node

Node es unidad operacional de serving/storage/processing; Node Identity no deberá confundirse con physical hostname.

---

# 13. Site, Zone y Region

Site/Zone/Region deberán tener identities canónicas y failure-domain semantics explícitas.

---

# 14. Failure Domain

Failure Domain modela fallos correlacionados. Distribuir copias dentro del mismo dominio no deberá anunciar resilience cross-domain.

---

# 15. Data Placement

Placement deberá ser resultado verificable de constraints/objectives y producir placement state.

---

# 16. Placement Policy

Policy deberá distinguir MUST/SHOULD preferencias y precedence entre security, residency, resilience, locality, capacity y cost.

---

# 17. Placement Constraint

Constraint deberá ser evaluable: allowed/prohibited locations, min spread, co-location, anti-affinity, capacity, hardware/security class, etc.

---

# 18. Data Location

Location debe ser canónica y trazable; address/hostname no constituye necesariamente location governance identity.

---

# 19. Data Locality

Locality representa proximidad a consumer/compute/dependency. Locality no deberá sobrepasar Residency o Consistency.

---

# 20. Location Awareness y Transparency

Awareness expone/usa location; Transparency oculta detalles al consumer. Ocultamiento no elimina requirements ni evidence.

---

# 21. Regional, Global y Edge Data

Estas etiquetas deberán declarar scope/semantics. `Global` no significa que pueda existir en cualquier jurisdiction.

---

# 22. Geo Distribution

Geo Distribution deberá modelar latency, failure domains, network partitions, consistency y Residency.

---

# 23. Edge Distribution

Edge nodes pueden operar con connectivity limitada; staging, cache, sync y disposal deberán gobernarse.

---

# 24. Centralized Distribution

Centralized placement puede ser válido cuando constraints/objectives lo favorezcan; no se asumirá inferior por definición.

---

# 25. Distributed / Hierarchical / Hub-and-Spoke / Mesh

Cada topology deberá declarar control plane, routing, propagation y failure behavior; no se elegirán sólo por naming.

---

# 26. Distribution Path

Path deberá representar hops/boundaries relevantes para security, privacy, latency y evidence.

---

# 27. Data Propagation

Propagation deberá respetar replication/synchronization contract aplicable y no crear copies implícitas sin governance.

---

# 28. Data Mobility y Movement

Movement deberá ser planificado, observable, resumable y verificado. Mobility capability no autoriza cualquier destino.

---

# 29. Placement Resolution

Resolver placement deberá producir eligible candidates, selected locations y reason/evidence. ENG-059 puede aportar principios generales de Resolution.

---

# 30. Read Locality

Read routing podrá preferir local/nearby location sólo si satisface freshness, consistency, authorization y residency.

---

# 31. Write Locality

Write routing deberá respetar write authority; proximity no podrá crear un nuevo leader/owner.

---

# 32. Read y Write Routing

Routing deberá operar sobre placement/ownership state versionado y detectar stale decisions.

---

# 33. Nearest Eligible Location

`Nearest` sólo se evalúa después de `Eligible`. Eligibility incorpora hard constraints.

---

# 34. Latency-Aware Routing

Latency optimization deberá usar measurements suficientemente frescos y no violar guarantees.

---

# 35. Residency-Aware Routing

ENG-099 define Residency. Routing deberá excluir ubicaciones prohibidas antes de optimizar.

---

# 36. Failure-Domain-Aware Routing

Routing/failover deberá evitar concentration y reconocer degraded availability.

---

# 37. Distribution Replication

Placement de replicas consume ENG-096; ENG-098 no redefine quorum/failover.

---

# 38. Distribution Partitioning

Placement de partitions/shards consume ENG-097; ENG-098 no redefine keys/maps.

---

# 39. Distribution Consistency y Freshness

ENG-078 conserva Consistency. Distribution deberá exponer/propagar capabilities de freshness/consistency al routing.

---

# 40. Distribution Availability y Reliability

ENG-073/074/075/076 según corresponda conservan modelos generales. Distribution implementa placement que contribuye a esos objetivos.

---

# 41. Distribution Degradation

Cuando constraints no puedan cumplirse, el sistema deberá declarar degraded placement y cuál requirement fue relajado o bloqueado.

---

# 42. Disconnected Operation

Edge/remote operation deberá definir local authority, write buffering, sync/reconciliation, expiry y recovery.

---

# 43. Distribution Recovery

Recovery deberá restaurar placement state, routing y movement tasks antes de declarar healthy.

---

# 44. Distribution Reconciliation

Expected placement vs observed placement deberá compararse; drift/violations deberán producir repair plan.

---

# 45. Distribution Capacity

Capacity deberá considerar current load, headroom, movement cost y failure scenarios.

---

# 46. Distribution Performance

ENG-070 gobierna Performance general. ENG-098 define placement/routing requirements específicos y evidencia de impacto.

---

# 47. Security, Privacy, Governance y Compliance

Movement/serving deberán preservar controls y audit. Metadata de topology/location también puede ser sensible.

---

# 48. Multi-Tenancy

Placement/routing deberán conservar Tenant Context y evitar side-channel/leakage cross-tenant.

---

# 49. Observability

Effective placement, routing path, movement, imbalance, constraint violations, degraded state, locality y capacity deberán ser observables.

---

# 50. Diagnostics

Diagnostics deberá explicar por qué una location fue eligible/ineligible, qué constraint ganó y cuál es el movement/recovery state.

---

# 51. Testing

Testing cubrirá zone/region loss, stale routing, capacity pressure, rebalance, degraded placement, edge disconnect, residency y recovery.

---

# 52. Primera Implementación Obligatoria

Debe soportar canonical locations, failure domains, explicit placement policy, versioned placement state, eligible-location resolution y controlled movement.

---

# 53. Invariantes de Ingeniería

ENG-098 define exactamente veinte invariantes propios en el rango `EI-1906 → EI-1925`.

| Invariante | Regla |
|---|---|
| EI-1906 | Todo Distribution material deberá tener un Distribution Contract explícito. |
| EI-1907 | Toda Distribution Unit deberá poseer identidad independiente de su ubicación. |
| EI-1908 | Placement deberá derivarse de constraints y objectives explícitos. |
| EI-1909 | Failure Domains deberán modelarse antes de afirmar resilience por distribución. |
| EI-1910 | Distribution no deberá asumir que múltiples locations implican Replication correcta. |
| EI-1911 | Placement State deberá ser versionado. |
| EI-1912 | Routing deberá resolver contra placement state conocido. |
| EI-1913 | Movement deberá ser reanudable o recuperable. |
| EI-1914 | Rebalancing no deberá violar Data Integrity. |
| EI-1915 | Capacity y headroom deberán ser medibles. |
| EI-1916 | Degraded Placement deberá declararse explícitamente. |
| EI-1917 | Residency constraints deberán prevalecer sobre optimizaciones de locality o cost. |
| EI-1918 | Tenant isolation deberá preservarse durante movement y serving. |
| EI-1919 | Security y Privacy controls deberán viajar con la Data o aplicarse antes de exposición. |
| EI-1920 | Distribution deberá respetar las garantías de Consistency de la Data distribuida. |
| EI-1921 | Stale placement no deberá producir escritura en ownership inválido. |
| EI-1922 | Constraint conflicts deberán producir decisión auditable. |
| EI-1923 | Observability deberá mostrar ubicación efectiva y movement state sin filtrar secretos. |
| EI-1924 | Recovery de una location deberá reconciliar placement antes de servir tráfico. |
| EI-1925 | La implementación deberá demostrar distribución y rebalance bajo fallos sin violar constraints obligatorios. |

---

# 54. Continuidad de Invariantes

```text
ENG-097 → EI-1886 a EI-1905
ENG-098 → EI-1906 a EI-1925
ENG-099 → EI-1926 a EI-1945
```

---

# 55. Criterios de Conformidad

Conformidad requiere topology/locations/failure domains explícitos, placement gobernado por constraints, routing versionado, movement seguro, degraded state visible, Residency enforcement y EI-1906 → EI-1925.

---

# 56. Riesgos

Riesgos: placement ad hoc, nearest-location antes de eligibility, hidden copies, stale routing, correlated failures, capacity collapse, mobility fuera de policy, failover que viola Residency y drift de placement.

---

# 57. Relación con ENG-097

ENG-097 define partition/shard units y ownership; ENG-098 decide placement de esas unidades sin cambiar sus keys/maps.

---

# 58. Relación con ENG-099

ENG-099 impone constraints de Localization/Residency. Para cualquier optimización de Distribution, Residency funciona como constraint superior obligatorio.

---

# 59. Relación con ENG-100

ENG-100 coordina movement/distribution en Lifecycle, pero ENG-098 mantiene autoridad sobre topology, placement, location y routing.

---

# 60. Principio Rector

> **Eligible before nearest: Distribution deberá determinar primero dónde Data puede estar y sólo después optimizar dónde conviene estar.**

---

# 61. Conclusión

ENG-098 establece Data Distribution Engineering de MEF y EI-1906 → EI-1925, subordinando placement/routing a authority, failure domains, security, privacy y Residency.

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
- ENG-026 — Runtime Performance Engineering
- ENG-030 — Persistence Engineering
- ENG-033 — Interface Engineering
- ENG-034 — Application Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
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
- ENG-097 — Data Partitioning & Sharding Engineering
- ENG-099 — Data Localization & Residency Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
