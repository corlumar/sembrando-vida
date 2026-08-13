---
id: ENG-089
titulo: Data Lineage & Provenance Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Lineage & Provenance Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11

dependencias:
  - ENG-000
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-024
  - ENG-025
  - ENG-033
  - ENG-036
  - ENG-043
  - ENG-046
  - ENG-048
  - ENG-051
  - ENG-055
  - ENG-057
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-079
  - ENG-080
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-084
  - ENG-085
  - ENG-086
  - ENG-087
  - ENG-088

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-058
  - ENG-059
  - ENG-090
  - ENG-091
  - ENG-092
  - ENG-093
  - ENG-094
  - ENG-095
  - ENG-096
  - ENG-097
  - ENG-098
  - ENG-099
  - ENG-100

keywords:
  - data-lineage
  - data-provenance
  - lineage
  - provenance
  - source
  - origin
  - derivation
  - transformation
  - lineage-graph
  - provenance-evidence
  - impact-analysis
  - root-cause
  - traceability
  - auditability
  - mef
---

# ENG-089 — Data Lineage & Provenance Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Lineage & Provenance Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-089 establece reglas para:

```text
Data Lineage
Data Provenance
Lineage Identity
Lineage Scope
Lineage Boundary
Lineage Contract
Lineage Policy
Lineage Entity
Lineage Activity
Lineage Agent
Source
Origin
Destination
Derivation
Transformation
Generation
Usage
Lineage Edge
Lineage Graph
Lineage Path
Dataset Lineage
Field Lineage
Record Lineage
Product Lineage
Pipeline Lineage
Exchange Lineage
Federation Lineage
Provenance Statement
Provenance Assertion
Provenance Evidence
Provenance Attestation
Lineage Capture
Lineage Propagation
Lineage Correlation
Upstream Analysis
Downstream Analysis
Impact Analysis
Root Cause Analysis
Lineage Versioning
Lineage Retention
Lineage Security
Lineage Privacy
Lineage Governance
Lineage Compliance
Lineage Integrity
Lineage Trust
Lineage Quality
Lineage Observability
Lineage Diagnostics
Lineage Testing
```

---

# 2. Declaración

> **MEF deberá preservar Lineage y Provenance suficientes para explicar de dónde proviene Data material, qué entidades, actividades y transformaciones participaron en su historia, qué dependencias existen, qué evidencia respalda esa historia y qué Consumers o Products pueden verse afectados por un cambio, sin confundir trazabilidad histórica con prueba automática de Correctness, Quality o Trust.**

```text
SOURCE / ORIGIN
      │
      ▼
LINEAGE ENTITY
      │
      ▼
ACTIVITY / TRANSFORMATION
      │
      ├── Agent
      ├── Contract
      ├── Version
      └── Evidence
      │
      ▼
DERIVED ENTITY
      │
      ▼
PRODUCT / EXCHANGE / FEDERATION
      │
      ▼
CONSUMER
      │
      ▼
LINEAGE GRAPH
      ├── Upstream
      ├── Downstream
      ├── Impact
      └── Root Cause Support
```

---

# 3. Data Lineage y Data Provenance

`Data Lineage` representa relaciones trazables que describen cómo Data se origina, mueve, transforma, combina, publica o consume.

`Data Provenance` representa información y Evidence sobre el origen e historia verificable del Data.

```text
Lineage ≠ Provenance
```

Lineage enfatiza relaciones y flujo.

Provenance enfatiza origen, historia y Evidence.

---

# 4. Fronteras conceptuales

```text
Lineage ≠ Audit Log
Lineage ≠ Distributed Trace
Lineage ≠ Architecture Diagram
Provenance ≠ Assertion solamente
```

Audit puede registrar acciones.

Tracing describe ejecución operacional.

Un diagrama describe flujo esperado.

Lineage deberá representar relaciones declaradas, observadas o inferidas con Semantics explícitas.

---

# 5. Lineage Identity, Scope y Boundary

Artifacts materiales podrán poseer:

```text
LineageGraphId
LineageEntityId
LineageActivityId
ProvenanceStatementId
```

Scope podrá expresarse por:

```text
dataset
field
record
product
pipeline
exchange
federation
tenant
domain
time range
version
```

Boundary deberá declarar hasta dónde se garantiza trazabilidad.

```text
Unknown Beyond Boundary
≠
No Upstream History
```

---

# 6. Lineage Contract y Policy

Conceptualmente:

```text
DataLineageContract
├── id
├── version
├── scope
├── granularity
├── capture
├── propagation
├── evidence
├── retention
├── security
├── privacy
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

ENG-051 será autoridad general de Policy.

Policy podrá definir qué capturar, granularidad, retención, visibilidad, redacción y requisitos de Evidence.

---

# 7. Entity, Activity y Agent

`Lineage Entity` representa Data o un artefacto informacional relevante.

`Lineage Activity` representa una operación que usa, genera o transforma Entities.

`Lineage Agent` representa actor responsable o ejecutor relevante.

```text
Entity ≠ Activity ≠ Agent
Agent ≠ Owner necesariamente
```

Entities podrán incluir Dataset, Table, Field, Record, File, Event, Data Product, Federated Result o Exchange Package.

Activities podrán incluir Extract, Transform, Join, Aggregate, Publish, Exchange, Federate, Replicate, Synchronize, Archive o Delete.

---

# 8. Source, Origin y Destination

`Source` representa una Entity o sistema del cual se obtiene Data.

`Origin` representa el punto de procedencia relevante dentro del Scope de Provenance.

`Destination` representa la Entity o sistema receptor.

```text
Immediate Source ≠ Ultimate Origin necesariamente
Destination ≠ Ownership
```

---

# 9. Derivation y Transformation

Derivation representa que una Entity fue obtenida total o parcialmente a partir de otra.

```text
A
│
▼
Transformation
│
▼
B

B derivedFrom A
```

ENG-063 será autoridad general de Data Transformation.

Lineage deberá poder referenciar Transformation Identity, Version, Inputs y Outputs.

---

# 10. Lineage Edge, Graph y Path

Conceptualmente:

```text
LineageEdge
├── from
├── to
├── relation
├── activity
├── timestamp
├── version
└── evidence
```

Relaciones podrán incluir:

```text
USED
GENERATED
DERIVED_FROM
PUBLISHED_AS
CONSUMED_BY
EXCHANGED_TO
FEDERATED_FROM
REPLICATED_FROM
SYNCHRONIZED_WITH
ARCHIVED_AS
```

`Lineage Graph` representa Entities, Activities, Agents y relaciones.

`Lineage Path` representa una secuencia de relaciones útil para Impact, Root Cause, Compliance y Source Analysis.

---

# 11. Granularidad

MEF distinguirá:

```text
Dataset Lineage
Field Lineage
Record Lineage
```

Record Lineage puede ser costoso y solo deberá exigirse cuando Requirement, Risk, Governance o Compliance lo justifiquen.

```text
Field Lineage ≠ Record Lineage
```

---

# 12. Product, Pipeline, Exchange y Federation Lineage

ENG-086 será autoridad de Data Product.

ENG-064 será autoridad de Data Pipeline.

ENG-087 será autoridad de Data Exchange & Sharing.

ENG-088 será autoridad de Data Federation.

Lineage deberá preservar las identidades y versiones propias de esos dominios sin redefinir sus Contracts.

Federated Results deberán preservar contribuciones relevantes de Sources y Composition.

Sharing no deberá borrar Origin.

---

# 13. Provenance Statement, Assertion y Evidence

Conceptualmente:

```text
ProvenanceStatement
├── id
├── subject
├── origin
├── activity
├── agent
├── timestamp
├── version
├── assertion
└── evidence
```

```text
Assertion ≠ Evidence
Attestation ≠ Truth
```

Evidence podrá incluir Signed Event, Immutable Reference, Execution Record, Hash, Attestation, Source Receipt o Version Reference.

---

# 14. Capture Methods

Capture podrá ser:

```text
declared
observed
instrumented
inferred
imported
```

El Capture Method deberá ser identificable cuando afecte Trust.

```text
Declared ≠ Observed
Inferred ≠ Observed
```

MEF no deberá presentar Lineage inferido como observado.

---

# 15. Propagation y Correlation

Lineage Metadata deberá propagarse cuando una operación material produzca nuevas Entities.

Correlation podrá utilizar:

```text
entity ids
activity ids
pipeline run ids
product ids
exchange ids
query ids
trace context
```

TraceId o RunId no deberán convertirse en Lineage Identity universal.

---

# 16. Upstream, Downstream, Impact y Root Cause

Upstream Analysis deberá identificar Sources, Transformations y Versions participantes.

Downstream Analysis deberá identificar Products, Pipelines, Exchanges y Consumers potencialmente afectados.

Impact Analysis podrá considerar:

```text
schema change
semantic change
quality incident
source outage
privacy change
retirement
```

Lineage podrá apoyar Root Cause Analysis.

```text
Lineage Evidence ≠ Root Cause Proof automáticamente
```

---

# 17. Versioning y Temporal Semantics

ENG-014 será autoridad general.

Lineage deberá distinguir, cuando sean materiales:

```text
entity version
activity version
transformation version
schema version
contract version
product version
```

También deberá diferenciar:

```text
event time
processing time
capture time
effective time
```

---

# 18. Retention e Historical Lineage

Lineage Retention podrá ser diferente del Payload Retention.

```text
Lineage Retention ≠ Payload Retention
```

Retirar o eliminar un Product no deberá borrar automáticamente Historical Lineage cuando exista obligación legítima de conservarlo.

ENG-092 gobernará Retention & Disposal.

ENG-093 gobernará Archival & Preservation.

---

# 19. Security, Authorization y Privacy

ENG-024 será autoridad general de Security.

ENG-046 será autoridad general de Authorization.

ENG-082 será autoridad de Privacy.

Lineage puede revelar Topology, Source Identities, Consumers, Sensitive Fields y Business Relationships.

```text
Data Access ≠ Lineage Access
```

Record-Level Lineage podrá requerir controles más estrictos.

---

# 20. Governance, Compliance y Ethics

```text
Governance → ENG-081
Compliance → ENG-083
Ethics     → ENG-084
```

Governance podrá definir Coverage, Granularity, Ownership, Retention y Visibility.

Lineage podrá servir como Evidence para Compliance, pero:

```text
Lineage ≠ Compliance automáticamente
```

---

# 21. Integrity, Trust y Quality

```text
Integrity → ENG-079
Quality   → ENG-080
Trust     → ENG-085
```

Lineage Integrity podrá proteger relaciones y Evidence mediante Hash, Signature, Append-only Storage, Versioning o Immutable References.

Quality Dimensions específicas podrán incluir:

```text
coverage
completeness
accuracy
freshness
consistency
resolution
```

```text
Trusted Lineage ≠ Complete Lineage
Integrity Verified ≠ Correct Lineage automáticamente
Coverage ≠ Correctness
```

---

# 22. Coverage y Completeness

Coverage deberá medirse respecto al Scope esperado.

Complete Lineage deberá interpretarse dentro de Boundary y Scope declarados.

```text
Complete Within Boundary
≠
Universal Complete History
```

---

# 23. External, Cross-Organization y Cross-Tenant Lineage

Cuando un Source externo no proporcione historia completa, MEF deberá representar el Boundary explícitamente.

No deberá inventar Provenance faltante.

Cross-Organization Lineage podrá requerir Contract, Sharing Policy, Redaction, Attestation y Trust Evaluation.

ENG-048 será autoridad sobre Multi-Tenancy.

Lineage Traversal no deberá permitir exposición Cross-Tenant no autorizada.

---

# 24. Integraciones posteriores

ENG-090 podrá exponer Lineage Metadata autorizada en Catalog.

ENG-091 podrá utilizar Lineage para Discovery & Classification.

ENG-094 podrá requerir Provenance exportable.

ENG-095 deberá preservar Source, Target y Sync Activity.

ENG-096 deberá representar Replica Derivation sin confundir Replica con Origin.

ENG-097 podrá preservar Lineage a través de Partitions y Shards.

ENG-098 deberá conservar Origin y Placement History cuando sea necesario.

ENG-099 será autoridad sobre Localization & Residency.

ENG-100 podrá utilizar Lineage para determinar dependencias antes de Archive, Retire, Dispose, Migrate o Relocate.

---

# 25. Observability

ENG-025 será autoridad general.

Metrics podrán incluir:

```text
mef.data_lineage.entity.total
mef.data_lineage.activity.total
mef.data_lineage.edge.total
mef.data_lineage.capture.total
mef.data_lineage.capture.failed.total
mef.data_lineage.coverage.ratio
mef.data_lineage.provenance.statement.total
mef.data_lineage.provenance.evidence.total
mef.data_lineage.traversal.total
mef.data_lineage.traversal.duration
mef.data_lineage.integrity.failure.total
```

Labels podrán incluir EntityType, ActivityType, RelationType, CaptureMethod, Result y FailureType con Cardinality controlada.

---

# 26. Diagnostics

Deberá poder responder:

```text
which entity?
which version?
which source?
which origin?
which activity?
which agent?
which transformation?
which upstream entities?
which downstream entities?
which product?
which pipeline?
which exchange?
which federation?
which capture method?
which evidence?
which boundary?
which tenant?
which integrity state?
which coverage?
```

---

# 27. Modelos Conceptuales

```text
LineageEntity
├── id
├── type
├── version
├── schema
├── owner
├── tenant
└── metadata
```

```text
LineageActivity
├── id
├── type
├── version
├── agent
├── startedAt
├── endedAt
└── metadata
```

```text
LineageGraph
├── id
├── scope
├── boundary
├── entities
├── activities
├── agents
├── edges
├── version
└── generatedAt
```

---

# 28. Lineage Runtime

Conceptualmente:

```text
DataLineageRuntime
├── register
├── capture
├── correlate
├── propagate
├── traverseUpstream
├── traverseDownstream
├── impact
├── verify
├── observe
└── diagnose
```

---

# 29. Testing

ENG-009 será autoridad general.

Deberán existir pruebas para:

```text
entity identity
activity identity
agent identity
derivation
transformation lineage
field lineage
product lineage
pipeline lineage
exchange lineage
federation lineage
capture method
propagation
correlation
upstream traversal
downstream traversal
impact analysis
provenance evidence
versioning
retention
tenant isolation
privacy
integrity
coverage
external boundary
```

---

# 30. Architecture Test

Podrá impedir:

```text
lineage treated as provenance universally
lineage treated as audit log
lineage treated as distributed trace
architecture diagram treated as observed lineage
agent treated as owner
immediate source treated as ultimate origin
assertion treated as evidence
declared lineage treated as observed lineage
inferred lineage treated as observed lineage
trace id treated as lineage identity
root cause inferred as proven solely from lineage
lineage retention treated as payload retention
data access treated as lineage access
trusted lineage treated as complete lineage
external missing provenance invented
catalog visibility treated as unrestricted graph access
payload disposal treated as automatic lineage disposal
```

---

# 31. CLI

ENG-007 podrá proporcionar:

```text
mef data-lineage
mef data-lineage:show
mef data-lineage:upstream
mef data-lineage:downstream
mef data-lineage:impact
mef data-lineage:provenance
mef data-lineage:verify
mef data-lineage:coverage
mef data-lineage:diagnose
```

---

# 32. Error Namespace

ENG-089 utilizará:

```text
MEF-DATA-LINEAGE-xxx
```

Taxonomía inicial:

```text
MEF-DATA-LINEAGE-001 Lineage entity identifier invalid
MEF-DATA-LINEAGE-002 Lineage activity identifier invalid
MEF-DATA-LINEAGE-003 Lineage agent invalid
MEF-DATA-LINEAGE-004 Lineage relation invalid
MEF-DATA-LINEAGE-005 Lineage contract invalid
MEF-DATA-LINEAGE-006 Lineage scope invalid
MEF-DATA-LINEAGE-007 Lineage boundary invalid
MEF-DATA-LINEAGE-008 Lineage capture failed
MEF-DATA-LINEAGE-009 Lineage propagation failed
MEF-DATA-LINEAGE-010 Lineage correlation failed
MEF-DATA-LINEAGE-011 Lineage traversal failed
MEF-DATA-LINEAGE-012 Lineage cycle invalid
MEF-DATA-LINEAGE-013 Provenance statement invalid
MEF-DATA-LINEAGE-014 Provenance evidence unavailable
MEF-DATA-LINEAGE-015 Provenance evidence invalid
MEF-DATA-LINEAGE-016 Lineage integrity violation
MEF-DATA-LINEAGE-017 Lineage privacy violation
MEF-DATA-LINEAGE-018 Lineage authorization denied
MEF-DATA-LINEAGE-019 Lineage tenant violation
MEF-DATA-LINEAGE-020 Lineage retention violation
MEF-DATA-LINEAGE-021 Lineage coverage insufficient
MEF-DATA-LINEAGE-022 External lineage unavailable
MEF-DATA-LINEAGE-023 Lineage version mismatch
MEF-DATA-LINEAGE-024 Lineage schema mismatch
MEF-DATA-LINEAGE-025 Lineage policy denied
MEF-DATA-LINEAGE-026 Lineage evidence expired
MEF-DATA-LINEAGE-027 Lineage graph unavailable
MEF-DATA-LINEAGE-028 Lineage impact analysis failed
MEF-DATA-LINEAGE-029 Lineage state invalid
MEF-DATA-LINEAGE-030 Lineage invariant violation
```

---

# 33. First Implementation Components

```text
LineageEntityId
LineageActivityId
LineageGraphId
LineageEntity
LineageActivity
LineageAgent
LineageEdge
LineageGraph
DataLineageContract
DataLineageScope
DataLineageBoundary
ProvenanceStatement
ProvenanceEvidence
LineageCapture
LineageTraversal
LineageImpactAnalyzer
DataLineageRuntime
DataLineageError
```

---

# 34. Estructura Conceptual

```text
src/
└── DataLineage/
    ├── Identity/
    │   ├── LineageEntityId
    │   ├── LineageActivityId
    │   └── LineageGraphId
    ├── Entity/
    │   └── LineageEntity
    ├── Activity/
    │   └── LineageActivity
    ├── Agent/
    │   └── LineageAgent
    ├── Relation/
    │   └── LineageEdge
    ├── Graph/
    │   └── LineageGraph
    ├── Contract/
    │   └── DataLineageContract
    ├── Scope/
    │   ├── DataLineageScope
    │   └── DataLineageBoundary
    ├── Provenance/
    │   ├── ProvenanceStatement
    │   └── ProvenanceEvidence
    ├── Capture/
    │   └── LineageCapture
    ├── Analysis/
    │   ├── LineageTraversal
    │   └── LineageImpactAnalyzer
    ├── Runtime/
    │   └── DataLineageRuntime
    └── Error/
        └── DataLineageError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 35. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Entity Identity
Explicit Activity Identity
Explicit Scope
Explicit Boundary
Dataset Lineage
Field Lineage where required
Product Lineage
Pipeline Lineage
Exchange Lineage
Federation Lineage
Declared vs Observed distinction
Provenance Statements
Evidence References
Upstream Traversal
Downstream Traversal
Impact Analysis
Versioning
Tenant Isolation
Security
Privacy
Integrity
Coverage
Observability
Testing
```

No deberá requerir inicialmente:

```text
Universal Record-Level Lineage
Global Provenance Ledger
Automatic Complete Lineage Inference
Universal Cross-Organization Lineage
Blockchain-Based Provenance
AI-Assisted Provenance Reconstruction
```

---

# 36. Invariantes de Ingeniería

ENG-089 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1726 | Todo Lineage material deberá declarar Scope, Boundary, Entities, Activities, Relations, Versions y Capture Semantics suficientes para explicar dependencias sin depender de contexto implícito. |
| EI-1727 | Data Lineage, Data Provenance, Audit Log, Distributed Trace y Architecture Diagram deberán permanecer diferenciados y ninguno deberá utilizarse como sustituto universal de los demás. |
| EI-1728 | Lineage Entity, Activity y Agent deberán poseer identidades diferenciadas y Agent no deberá interpretarse automáticamente como Owner, Steward o Source. |
| EI-1729 | Immediate Source, Ultimate Origin y Destination deberán permanecer diferenciados y ausencia de historia más allá de una Boundary no deberá representarse como ausencia absoluta de Upstream Provenance. |
| EI-1730 | Derivation y Transformation deberán preservar referencias suficientes a Inputs, Outputs, Activity y Version y una transformación no deberá borrar silenciosamente el origen de Data material. |
| EI-1731 | Dataset, Field y Record Lineage deberán conservar granularidades diferenciadas y Record-Level Lineage no deberá imponerse universalmente cuando su costo no esté justificado. |
| EI-1732 | Product, Pipeline, Exchange y Federation Lineage deberán preservar las identidades propias de ENG-086, ENG-064, ENG-087 y ENG-088 y Lineage no deberá redefinir sus Contracts o Lifecycle. |
| EI-1733 | Provenance Assertion, Provenance Evidence y Provenance Attestation deberán permanecer diferenciadas y una afirmación o attestation no deberá considerarse verdadera automáticamente sin Evidence y Trust Evaluation suficientes. |
| EI-1734 | Declared, Observed, Inferred e Imported Lineage deberán identificar su Capture Method y Lineage inferido o declarado no deberá presentarse como observado. |
| EI-1735 | Lineage Correlation deberá preservar Entity, Activity, Product, Pipeline, Exchange, Query y Trace references relevantes sin convertir TraceId, RunId u otro identificador operacional en Lineage Identity universal. |
| EI-1736 | Upstream, Downstream, Impact y Root Cause Analysis deberán conservar Semantics diferenciadas y Lineage Evidence no deberá presentarse por sí sola como prueba concluyente de Root Cause. |
| EI-1737 | Lineage Versioning deberá distinguir Entity, Activity, Transformation, Schema, Contract y Product Versions cuando sean materiales y no deberá reconstruir historia utilizando únicamente el estado actual. |
| EI-1738 | Event Time, Processing Time, Capture Time y Effective Time deberán permanecer diferenciados cuando afecten Provenance y no deberán intercambiarse silenciosamente. |
| EI-1739 | Lineage Retention y Payload Retention deberán evaluarse separadamente y Retirement o Disposal de Data no deberá borrar automáticamente Historical Lineage requerido legítimamente. |
| EI-1740 | Lineage Security, Privacy, Governance, Compliance, Ethics y Authorization deberán aplicarse al Graph y a sus Traversals y Data Access no deberá conferir automáticamente acceso irrestricto a Lineage. |
| EI-1741 | Lineage Integrity, Trust, Quality, Coverage y Completeness deberán permanecer diferenciados y Trusted o Integrity-verified Lineage no deberá considerarse automáticamente completo o correcto. |
| EI-1742 | External y Cross-Organization Lineage deberán representar explícitamente Boundaries, Evidence disponible y Unknown Provenance y MEF no deberá inventar historia faltante para cerrar el Graph. |
| EI-1743 | Cross-Tenant Lineage Traversal deberá preservar Tenant Isolation y Catalog, Discovery o Metadata visibility no deberán utilizarse para revelar relaciones de otro Tenant sin Authorization explícita. |
| EI-1744 | Lineage Observability, Diagnostics y Testing deberán permitir reconstruir Entity, Version, Source, Origin, Activity, Agent, Transformation, Upstream, Downstream, Capture Method, Evidence, Boundary, Tenant, Integrity y Coverage sin exponer Payload sensible innecesariamente. |
| EI-1745 | La primera implementación deberá priorizar Entity/Activity Identity, Scope, Boundary, Dataset/Field Lineage, Product/Pipeline/Exchange/Federation Lineage, Capture Method, Provenance Evidence, Upstream/Downstream Traversal, Impact Analysis, Versioning, Security, Privacy, Integrity, Coverage, Observability y Testing antes de introducir Universal Record-Level Lineage, Global Provenance Ledger o AI-Assisted Reconstruction. |

---

# 37. Continuidad de Invariantes

```text
ENG-085 → EI-1646 a EI-1665
ENG-086 → EI-1666 a EI-1685
ENG-087 → EI-1686 a EI-1705
ENG-088 → EI-1706 a EI-1725
ENG-089 → EI-1726 a EI-1745
```

---

# 38. Criterios de Conformidad

Una implementación será conforme con ENG-089 cuando:

- modele Entity, Activity y Agent;
- defina Identity, Scope y Boundary;
- modele Edge y Graph;
- diferencie Lineage y Provenance;
- diferencie Declared, Observed e Inferred Lineage;
- preserve Source, Origin, Destination y Derivation;
- preserve Transformation Version;
- soporte Dataset y Field Lineage;
- modele Product, Pipeline, Exchange y Federation Lineage;
- produzca Provenance Statements y Evidence;
- implemente Upstream y Downstream Traversal;
- soporte Impact Analysis;
- preserve Temporal Semantics y Versioning;
- aplique Retention, Security, Privacy y Tenant Isolation;
- mida Coverage;
- implemente Integrity, Observability, Diagnostics y Testing.

---

# 39. Relación con ENG-088

ENG-088 gobierna Data Federation.

```text
ENG-088
DATA FEDERATION
│
└── How is distributed Data queried
    and composed logically?

ENG-089
LINEAGE & PROVENANCE
│
└── Which Sources contributed to
    the Federated Result?
```

---

# 40. Relación con ENG-090

ENG-090 formaliza **Data Catalog Engineering**.

```text
ENG-089
LINEAGE & PROVENANCE
│
└── Captures and explains Data history,
    origin and dependency.

ENG-090
DATA CATALOG
│
└── Organizes and exposes governed
    metadata about Data assets.
```

Catalog podrá mostrar Lineage autorizado, pero no será autoridad primaria de Lineage Semantics.

---

# 41. Principio Rector

> **MEF deberá poder explicar la historia material de sus Data Assets sin inventarla: qué entidad existió, qué actividad la utilizó o generó, qué agente participó, de qué origen provino, qué transformación ocurrió, qué evidencia existe, qué frontera limita el conocimiento y qué dependencias upstream y downstream pueden demostrarse.**

---

# 42. Conclusión

**ENG-089 — Data Lineage & Provenance Engineering** formaliza trazabilidad histórica, derivación, dependencia y evidencia de origen de Data dentro de MEF.

```text
LINEAGE ≠ PROVENANCE
LINEAGE ≠ AUDIT LOG
LINEAGE ≠ DISTRIBUTED TRACE

ENTITY ≠ ACTIVITY ≠ AGENT
IMMEDIATE SOURCE ≠ ULTIMATE ORIGIN

ASSERTION ≠ EVIDENCE
ATTESTATION ≠ TRUTH

DECLARED ≠ OBSERVED
INFERRED ≠ OBSERVED

FIELD LINEAGE ≠ RECORD LINEAGE

TRUST ≠ COMPLETENESS
INTEGRITY ≠ CORRECTNESS
COVERAGE ≠ CORRECTNESS

DATA ACCESS ≠ LINEAGE ACCESS
```

Con **ENG-089**, la serie global alcanza:

```text
EI-1745
```

---

# Referencias

## Ingeniería

- ENG-009 — Testing Engineering
- ENG-014 — Versioning Engineering
- ENG-016 — Compatibility Engineering
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-033 — Interface Engineering
- ENG-036 — Validation Engineering
- ENG-043 — Data Access Engineering
- ENG-046 — Authorization Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-051 — Policy Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-057 — Metadata Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Data Transformation Engineering
- ENG-064 — Data Pipeline Engineering
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
- ENG-090 — Data Catalog Engineering
- ENG-091 — Data Discovery & Classification Engineering
- ENG-092 — Data Retention & Disposal Engineering
- ENG-093 — Data Archival & Preservation Engineering
- ENG-094 — Data Portability Engineering
- ENG-095 — Data Synchronization Engineering
- ENG-096 — Data Replication Engineering
- ENG-097 — Data Partitioning & Sharding Engineering
- ENG-098 — Data Distribution Engineering
- ENG-099 — Data Localization & Residency Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
