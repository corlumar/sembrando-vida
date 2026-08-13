---
id: ENG-099
titulo: Data Localization & Residency Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Localization & Residency Engineering
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
  - ENG-043
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-051
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-058
  - ENG-059
  - ENG-061
  - ENG-062
  - ENG-070
  - ENG-073
  - ENG-074
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-079
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-085
  - ENG-087
  - ENG-088
  - ENG-089
  - ENG-090
  - ENG-092
  - ENG-093
  - ENG-094
  - ENG-095
  - ENG-096
  - ENG-097
  - ENG-098

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-027
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-037
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-071
  - ENG-072
  - ENG-078
  - ENG-080
  - ENG-084
  - ENG-086
  - ENG-091
  - ENG-100

keywords:
  - data-localization
  - data-residency
  - data-sovereignty
  - jurisdiction
  - residency-policy
  - residency-contract
  - processing-residency
  - storage-residency
  - access-residency
  - backup-residency
  - replica-residency
  - key-residency
  - cross-border-transfer
  - jurisdiction-boundary
  - sovereignty
  - localization
  - mef

---

# ENG-099 — Data Localization & Residency Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Localization & Residency Engineering**
de **MEF (Modular Enterprise Framework)**.

ENG-099 establece reglas para:

Data Localization

Data Residency

Data Sovereignty

Jurisdiction

Jurisdiction Boundary

Residency Requirement

Residency Contract

Residency Policy

Residency Scope

Residency Classification

Allowed Jurisdiction

Preferred Jurisdiction

Required Jurisdiction

Prohibited Jurisdiction

Storage Residency

Processing Residency

Access Residency

Execution Residency

Transfer Residency

Backup Residency

Replica Residency

Archive Residency

Cache Residency

Log Residency

Metadata Residency

Key Residency

Identity Residency

Telemetry Residency

Analytics Residency

Derived Data Residency

Temporary Data Residency

Residency Zone

Residency Region

Residency Domain

Residency Resolution

Residency Enforcement

Residency-Aware Routing

Residency-Aware Distribution

Residency-Aware Replication

Residency-Aware Partitioning

Residency-Aware Synchronization

Residency-Aware Backup

Residency-Aware Recovery

Residency-Aware Failover

Residency-Aware Archive

Residency-Aware Portability

Cross-Border Transfer

Cross-Jurisdiction Processing

Cross-Jurisdiction Access

Jurisdiction Mapping

Jurisdiction Inference

Jurisdiction Evidence

Residency Evidence

Residency Attestation

Residency Verification

Residency Violation

Residency Drift

Residency Exception

Residency Override

Residency Migration

Sovereignty Constraint

Multi-Tenant Residency

Shared Infrastructure Residency

Residency Security

Residency Privacy

Residency Governance

Residency Compliance

Residency Observability

Residency Diagnostics

Residency Testing

---

# 2. Declaración

> **MEF deberá tratar Data Localization, Data Residency y Data Sovereignty como constraints explícitos sobre dónde Data puede almacenarse, procesarse, replicarse, respaldarse, archivarse, transferirse y accederse. Ninguna ubicación física, región de Cloud, dirección IP, nacionalidad del usuario o proximidad operacional deberá convertirse automáticamente en autoridad de Jurisdiction sin Policy y Evidence explícitas.**

Arquitectura conceptual:

```text
                        DATA
                          │
                          ▼
                CLASSIFICATION / PURPOSE
                          │
                          ▼
                  RESIDENCY CONTRACT
                          │
        ┌─────────────────┼─────────────────┐
        ▼                 ▼                 ▼
     STORAGE          PROCESSING          ACCESS
    RESIDENCY         RESIDENCY         RESIDENCY
        │                 │                 │
        └─────────────────┼─────────────────┘
                          ▼
                 JURISDICTION RULES
                          │
             ┌────────────┼────────────┐
             ▼            ▼            ▼
          ALLOWED      REQUIRED     PROHIBITED
             │            │            │
             └────────────┼────────────┘
                          ▼
                  ELIGIBLE LOCATIONS
                          │
                          ▼
                       ENG-098
                     DISTRIBUTION

---

# 3. Frontera de Autoridad

ENG-099 es autoritativo para constraints técnicos sobre dónde Data, metadata, replicas, backups, archives, caches, logs y processing pueden residir, ejecutarse, transferirse o ser accedidos.

ENG-083 gobierna Compliance general; ENG-082 Privacy; ENG-098 Distribution. ENG-099 traduce requirements de localización/residencia en constraints verificables.

---

# 4. Localization ≠ Residency ≠ Sovereignty

Localization puede imponer almacenamiento/procesamiento local; Residency define ubicaciones permitidas/requeridas; Sovereignty incorpora autoridad/jurisdiction/control. No deberán usarse como sinónimos automáticos.

---

# 5. Jurisdiction

Jurisdiction deberá representarse mediante identidad canónica y evidencia suficiente. Country code o Cloud region no establecen por sí solos autoridad jurídica.

---

# 6. Jurisdiction Boundary

Boundary deberá declarar entrada/salida de Data, processing, support access, control plane y key material cuando sean relevantes.

---

# 7. Residency Requirement

Requirement deberá provenir de policy/governance/compliance/contract y expresar scope, locations, operations, duration y evidence.

---

# 8. Residency Contract

Contract deberá declarar Data Scope, location taxonomy, allowed/preferred/required/prohibited locations, processing/access/transfer rules, evidence y exceptions.

---

# 9. Residency Policy

Policy deberá ser versionada, evaluable y tener precedence con security/privacy/compliance.

---

# 10. Residency Scope

Scope puede abarcar dataset, field, record, tenant, classification, data product, metadata, derived data, logs, backups o keys.

---

# 11. Residency Classification

Classification podrá determinar restricciones, pero ENG-099 no redefine clasificación autoritativa de ENG-091.

---

# 12. Allowed Jurisdiction

Allowed significa elegible, no necesariamente preferred/selected.

---

# 13. Preferred Jurisdiction

Preferred es soft objective y nunca deberá sobrepasar required/prohibited constraints.

---

# 14. Required Jurisdiction

Required deberá producir enforcement y evidence; si no puede cumplirse, la operación deberá bloquearse o entrar en exception explícita.

---

# 15. Prohibited Jurisdiction

Prohibited deberá excluir placement, processing, transfer y restore/failover paths relevantes.

---

# 16. Storage Residency

Primary stores, temp storage y materializations deberán evaluarse según scope.

---

# 17. Processing Residency

Compute location, transformation, analytics y model execution pueden estar sujetos a residency independientemente del storage.

---

# 18. Access Residency

Support/admin/user access desde determinadas locations podrá estar restringido. Identity nationality no deberá confundirse con access location.

---

# 19. Execution Residency

Jobs/functions/containers que procesan Data deberán ejecutarse sólo en locations elegibles cuando aplique.

---

# 20. Transfer Residency

Cross-location/cross-border transfer deberá validar source, destination, path/boundaries y transfer basis.

---

# 21. Backup Residency

Backups deberán mantener residency metadata y restore constraints; offline media también cuenta cuando almacena Data.

---

# 22. Replica Residency

ENG-096 deberá restringir replica placement a eligible locations.

---

# 23. Archive Residency

ENG-093 Preservation no exime Archive de Residency.

---

# 24. Cache Residency

Caches con payload sensible deberán gobernarse; TTL no reemplaza location constraints.

---

# 25. Log y Telemetry Residency

Logs/traces/metrics pueden contener Data/identifiers; deberán evaluarse y minimizarse.

---

# 26. Key Residency

Key material/HSM/KMS location puede ser un requirement separado del Data location.

---

# 27. Control Plane Residency

Metadata/control-plane actions podrán tener restricciones cuando puedan revelar o controlar Data regulated.

---

# 28. Jurisdiction Mapping

Mapping provider-region → canonical jurisdiction deberá versionarse y tener source/evidence.

---

# 29. Jurisdiction Inference

Inference deberá marcarse como inferred. No deberá transformarse silenciosamente en authoritative jurisdiction.

---

# 30. Jurisdiction Evidence

Evidence deberá registrar provider attestations, contracts, configuration, discovery o authoritative metadata según el caso.

---

# 31. Residency Evidence

Evidence deberá permitir demostrar effective location, movement, processing y exceptions materiales.

---

# 32. Residency Attestation

Attestation puede apoyar evidence, pero no sustituye independent verification cuando el requirement lo exige.

---

# 33. Residency Verification

Verification deberá comparar expected constraints con observed locations/paths y declarar unknowns.

---

# 34. Residency Violation

Violation deberá identificar Data Scope, constraint, observed location, start time, exposure y remediation.

---

# 35. Residency Drift

Drift es divergencia entre expected y observed placement/processing/access. Deberá ser observable y reconciliable.

---

# 36. Residency Exception

Exception deberá ser explícita, scoped, authorized, time-bound cuando aplique y producir evidence.

---

# 37. Residency Override

Override deberá registrar authority, reason, duration, impacted scope y compensating controls.

---

# 38. Residency Migration

Policy changes o violations podrán exigir migration; movement deberá evitar crear nuevas copies no conformes.

---

# 39. Sovereignty Constraint

Sovereignty podrá incluir operator/control/key/support/legal-access constraints además de physical location.

---

# 40. Cross-Border Transfer

Transfer deberá distinguir transmission, remote access, replication, backup copy, sync y portability.

---

# 41. Multi-Tenant Residency

Cada tenant podrá tener policies distintas; shared resources deberán demostrar enforcement por tenant.

---

# 42. Shared Infrastructure Residency

Shared infrastructure no deberá ocultar actual provider/location/control boundaries.

---

# 43. Failover y Recovery

Failover/restore no podrán relajar Residency silenciosamente. Emergency exceptions deberán seguir policy explícita.

---

# 44. Distribution Integration

ENG-098 consume Residency como hard constraints de eligible placement/routing.

---

# 45. Synchronization Integration

ENG-095 deberá impedir sync hacia Participants no elegibles.

---

# 46. Portability Integration

ENG-094 deberá validar destination y transfer constraints antes de export/import.

---

# 47. Retention y Disposal

ENG-092 puede exigir disposal de copies no conformes; Residency metadata/evidence tendrá su propia retention.

---

# 48. Security y Privacy

Residency complementa encryption/authorization/minimization; estar en país correcto no implica seguridad o privacy suficiente.

---

# 49. Governance y Compliance

ENG-081/083 gobiernan ownership/obligations; ENG-099 implementa enforceable technical location constraints y evidence.

---

# 50. Observability

Violations, drift, effective locations, transfers, exceptions, unknown mappings y remediation deberán ser observables.

---

# 51. Diagnostics

Diagnostics deberá explicar por qué location fue allowed/required/prohibited, qué rule/version/evidence intervino y qué remediation aplica.

---

# 52. Testing

Testing cubrirá prohibited placement, restore/failover, replication, sync, export, edge/cache/logs, exceptions, policy changes y unknown location.

---

# 53. Primera Implementación Obligatoria

Debe soportar canonical locations, allow/deny/required constraints, enforcement en placement/transfer, evidence y drift detection.

---

# 54. Invariantes de Ingeniería

ENG-099 define exactamente veinte invariantes propios en el rango `EI-1926 → EI-1945`.

| Invariante | Regla |
|---|---|
| EI-1926 | Todo Residency material deberá tener un Residency Contract explícito. |
| EI-1927 | Las ubicaciones deberán representarse mediante identidades canónicas y verificables. |
| EI-1928 | Una ubicación desconocida no deberá considerarse automáticamente permitida. |
| EI-1929 | Residency deberá aplicarse al Data Scope completo definido por la política. |
| EI-1930 | Replicas no deberán crearse fuera de ubicaciones elegibles. |
| EI-1931 | Backups y Archives no deberán quedar fuera del control de Residency. |
| EI-1932 | Caches, indexes, logs y staging deberán evaluarse cuando contengan Data regulada. |
| EI-1933 | Processing Residency deberá verificarse separadamente de Storage Residency cuando aplique. |
| EI-1934 | Distribution deberá tratar Residency como constraint obligatorio. |
| EI-1935 | Synchronization deberá rechazar Participants no elegibles. |
| EI-1936 | Portability deberá validar destino antes de transferir Data restringida. |
| EI-1937 | Un failover no deberá violar Residency para restaurar Availability. |
| EI-1938 | Una excepción deberá ser explícita, autorizada y auditable. |
| EI-1939 | Los cambios de Policy deberán detectar Data ya ubicada en estado no conforme. |
| EI-1940 | Residency Drift deberá ser observable y reconciliable. |
| EI-1941 | Evidence deberá permitir demostrar ubicación y movimientos materiales. |
| EI-1942 | Tenant y Data Subject constraints deberán preservarse cuando sean aplicables. |
| EI-1943 | Residency no deberá sustituir Privacy, Security ni Compliance. |
| EI-1944 | Remediation deberá evitar nuevas copias no conformes durante migration. |
| EI-1945 | La implementación deberá demostrar enforcement continuo incluso durante failure, recovery y rebalancing. |

---

# 55. Continuidad de Invariantes

```text
ENG-098 → EI-1906 a EI-1925
ENG-099 → EI-1926 a EI-1945
ENG-100 → EI-1946 a EI-1965
```

---

# 56. Criterios de Conformidad

Conformidad requiere canonical locations, Residency Contract/Policy versionados, scope completo, enforcement sobre storage/processing/replication/backup/transfer, evidence, exceptions y EI-1926 → EI-1945.

---

# 57. Riesgos

Riesgos: inferir jurisdiction desde IP/region, hidden replicas/backups/logs, emergency failover no conforme, stale provider mapping, unknown location treated as allowed, cross-tenant policy leakage y evidence insuficiente.

---

# 58. Relación con ENG-098

ENG-098 optimiza Distribution sólo entre locations elegibles. ENG-099 define los hard constraints de localization/residency que limitan placement y routing.

---

# 59. Relación con ENG-100

ENG-100 coordina Lifecycle y remediation de Residency, pero no redefine las reglas de ubicación de ENG-099.

---

# 60. Relación con ENG-100

ENG-100 puede orquestar migration/disposal/recovery disparados por Residency, mientras ENG-099 conserva autoridad sobre constraints y evidence de ubicación.

---

# 61. Principio Rector

> **Unknown location ≠ allowed location. Toda Residency material deberá convertirse en constraints técnicos verificables que permanezcan vigentes durante normal operation, failure, recovery, migration y disposal.**

---

# 62. Conclusión

ENG-099 establece Data Localization & Residency Engineering de MEF y EI-1926 → EI-1945, cerrando el bloque especializado previo a ENG-100.

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
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-044 — API Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
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
- ENG-098 — Data Distribution Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
