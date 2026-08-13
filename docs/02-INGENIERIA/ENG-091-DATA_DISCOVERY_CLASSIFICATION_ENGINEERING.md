---
id: ENG-091
titulo: Data Discovery & Classification Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Discovery & Classification Engineering
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
  - ENG-058
  - ENG-059
  - ENG-061
  - ENG-062
  - ENG-079
  - ENG-080
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-084
  - ENG-085
  - ENG-086
  - ENG-089
  - ENG-090

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-023
  - ENG-030
  - ENG-031
  - ENG-034
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-060
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-087
  - ENG-088
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
  - data-discovery
  - data-classification
  - discovery
  - classification
  - sensitive-data
  - metadata
  - profiling
  - scanning
  - detection
  - classification-rule
  - confidence
  - evidence
  - catalog
  - governance
  - mef
---

# ENG-091 — Data Discovery & Classification Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Discovery & Classification Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-091 establece reglas para:

```text
Data Discovery
Data Classification

Discovery Identity
Discovery Scope
Discovery Boundary
Discovery Contract
Discovery Policy

Discovery Source
Discovery Target
Discovery Scan
Discovery Run
Discovery Result

Asset Discovery
Schema Discovery
Field Discovery
Pattern Discovery
Semantic Discovery

Classification Scheme
Classification Taxonomy
Classification Level
Classification Category
Classification Label

Classification Rule
Classification Policy
Classification Assignment

Manual Classification
Rule-Based Classification
Metadata-Based Classification
Content-Based Classification
Inferred Classification

Classification Confidence
Classification Evidence
Classification Reason
Classification Source

Sensitive Data Discovery
Personal Data Discovery
Regulated Data Discovery

Classification Validation
Classification Review
Classification Approval
Classification Override

Classification Version
Classification Freshness
Classification Drift

False Positive
False Negative
Ambiguous Classification
Unknown Classification

Catalog Integration
Lineage Integration
Governance Integration
Privacy Integration
Compliance Integration

Discovery Security
Discovery Privacy
Discovery Authorization
Discovery Multi-Tenancy

Discovery Observability
Discovery Diagnostics
Discovery Testing
```

---

# 2. Declaración

> **MEF deberá descubrir e identificar Data Assets y asignar Classification mediante Scope, Rules, Evidence, Confidence y Governance explícitos, preservando la diferencia entre encontrar un Asset, inferir su naturaleza y establecer una Classification autoritativa, sin convertir una detección automática en verdad gobernada sin Validation suficiente.**

Arquitectura conceptual:

```text
DATA SOURCES
    │
    ▼
DISCOVERY
    │
    ├── Scope
    ├── Boundary
    ├── Scan
    ├── Detection
    ├── Profiling
    └── Evidence
    │
    ▼
DISCOVERY RESULT
    │
    ▼
CLASSIFICATION
    │
    ├── Scheme
    ├── Rules
    ├── Category
    ├── Level
    ├── Confidence
    ├── Evidence
    └── Review
    │
    ▼
GOVERNED CLASSIFICATION
    │
    ├── Catalog
    ├── Governance
    ├── Privacy
    ├── Security
    └── Compliance
```

---

# 3. Data Discovery

`Data Discovery` representa el proceso de localizar, identificar y describir Data Assets o características relevantes dentro de un Scope.

Podrá descubrir:

```text
datasets
tables
fields
files
streams
events
schemas
data products
external sources
sensitive fields
regulated data
```

Discovery no deberá implicar automáticamente Classification autoritativa.

---

# 4. Data Classification

`Data Classification` representa la asignación gobernada de categorías, niveles o etiquetas semánticas a Data o Data Assets.

Podrá representar:

```text
sensitivity
privacy category
business category
regulatory category
security level
data domain
criticality
retention relevance
```

---

# 5. Discovery ≠ Classification

Principio obligatorio:

```text
Discovery
≠
Classification
```

Discovery responde principalmente:

```text
What exists?
Where is it?
What characteristics were detected?
```

Classification responde:

```text
What category or level applies?
Under which rules?
With what evidence and authority?
```

---

# 6. Detection ≠ Authoritative Classification

```text
Detected Pattern
≠
Authoritative Classification
```

Un detector podrá producir una Candidate Classification.

La Classification final podrá requerir Validation, Review, Approval o Policy.

---

# 7. Classification ≠ Tag

```text
Classification
≠
Tag
```

Un Tag podrá servir para organización.

Una Classification gobernada deberá poseer Semantics, Scheme, Authority y Lifecycle suficientes.

---

# 8. Classification ≠ Authorization

```text
Classification
≠
Authorization
```

Classification podrá informar decisiones de acceso.

ENG-046 seguirá siendo autoridad sobre Authorization.

---

# 9. Discovery Identity

Artifacts materiales deberán poder poseer Identity.

```text
DiscoveryRunId
DiscoveryResultId
ClassificationAssignmentId
```

Identity deberá permanecer diferenciada de Source Location o Scanner Instance.

---

# 10. Discovery Scope

Scope deberá definir qué se inspecciona.

Podrá incluir:

```text
tenant
domain
catalog
data source
schema
dataset
field
storage location
environment
region
jurisdiction
```

---

# 11. Discovery Boundary

Boundary deberá declarar límites técnicos, organizacionales, contractuales y jurisdiccionales.

```text
Not Scanned
≠
No Data Exists
```

---

# 12. Discovery Contract

Conceptualmente:

```text
DataDiscoveryContract
├── id
├── version
├── scope
├── boundary
├── sourceTypes
├── discoveryMethods
├── classificationScheme
├── evidence
├── privacy
├── security
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

---

# 13. Discovery Policy

ENG-051 será autoridad general.

Policy podrá controlar:

```text
allowed sources
scan depth
content inspection
sampling
classification rules
confidence thresholds
review requirements
retention
visibility
```

---

# 14. Discovery Source y Target

`Discovery Source` representa sistema, Catalog, Storage o Interface inspeccionada.

`Discovery Target` representa el Asset o Scope concreto analizado.

```text
Source
≠
Target necesariamente
```

---

# 15. Discovery Scan

Conceptualmente:

```text
DiscoveryScan
├── id
├── source
├── scope
├── method
├── startedAt
├── completedAt
├── status
└── evidence
```

Scan deberá ser observable y auditable cuando sea material.

---

# 16. Discovery Run

Run deberá identificar una ejecución específica.

```text
Discovery Definition
≠
Discovery Run
```

Un mismo Discovery Contract podrá producir múltiples Runs.

---

# 17. Discovery Result

Conceptualmente:

```text
DiscoveryResult
├── id
├── runId
├── asset
├── observations
├── candidates
├── confidence
├── evidence
└── capturedAt
```

Result deberá diferenciar Observation de goberned Classification.

---

# 18. Asset Discovery

Asset Discovery podrá identificar nuevos Assets no registrados previamente.

El descubrimiento no deberá publicar automáticamente el Asset en ENG-090 sin Validation y Policy aplicables.

---

# 19. Schema Discovery

Schema Discovery podrá detectar:

```text
fields
types
constraints
structures
formats
relationships
```

ENG-062 seguirá siendo autoridad sobre Schema.

---

# 20. Field Discovery

Field Discovery podrá producir observaciones sobre:

```text
name
type
nullability
format
patterns
semantic candidates
sensitivity candidates
```

Field Name no deberá tratarse automáticamente como Business Meaning.

---

# 21. Pattern Discovery

Podrá identificar patrones estructurales o de contenido.

Ejemplos:

```text
email-like
phone-like
identifier-like
date-like
financial-like
location-like
```

Pattern Match no deberá considerarse Classification concluyente.

---

# 22. Semantic Discovery

Semantic Discovery podrá utilizar:

```text
metadata
schema
business glossary
lineage
context
content evidence
```

para proponer significado.

```text
Semantic Candidate
≠
Authoritative Business Term
```

---

# 23. Classification Scheme

Conceptualmente:

```text
ClassificationScheme
├── id
├── version
├── categories
├── levels
├── rules
├── authority
└── lifecycle
```

Todo Assignment material deberá referenciar Scheme y Version.

---

# 24. Classification Taxonomy

Taxonomy podrá definir relaciones:

```text
parent
child
equivalent
related
more restrictive
less restrictive
```

No deberán inferirse equivalencias únicamente por similitud nominal.

---

# 25. Classification Level

Ejemplo conceptual:

```text
PUBLIC
INTERNAL
CONFIDENTIAL
RESTRICTED
```

Los nombres concretos deberán ser definidos por Policy o Scheme.

ENG-091 no impone una taxonomía universal.

---

# 26. Classification Category

Categories podrán representar dimensiones independientes.

Ejemplos:

```text
privacy
security
business
regulatory
criticality
retention
```

```text
Category
≠
Level
```

---

# 27. Classification Label

Label deberá referenciar Semantics gobernadas.

Display Label no deberá utilizarse como única Identity de Classification.

---

# 28. Classification Rule

Conceptualmente:

```text
ClassificationRule
├── id
├── version
├── condition
├── classification
├── priority
├── confidence
├── evidenceRequirements
└── policy
```

---

# 29. Rule Evaluation

Rules deberán evaluarse de manera determinista cuando estén definidas como deterministas.

Conflicts deberán resolverse mediante Policy explícita.

---

# 30. Manual Classification

Manual Classification deberá registrar:

```text
actor
authority
classification
reason
timestamp
version
```

Manual no significa automáticamente correcto.

---

# 31. Rule-Based Classification

Rule-Based Classification deberá conservar:

```text
rule id
rule version
input evidence
result
confidence
```

---

# 32. Metadata-Based Classification

Podrá utilizar Metadata sin inspeccionar Payload.

Ejemplos:

```text
field name
schema annotations
business terms
source type
owner metadata
```

Deberá indicar que la clasificación se basó en Metadata.

---

# 33. Content-Based Classification

Podrá inspeccionar contenido cuando Policy, Privacy y Authorization lo permitan.

Deberá aplicar minimización.

No deberá persistir muestras sensibles innecesariamente.

---

# 34. Inferred Classification

Classification inferida deberá marcarse explícitamente.

```text
Inferred
≠
Validated
≠
Approved
```

---

# 35. Classification Assignment

Conceptualmente:

```text
ClassificationAssignment
├── id
├── subject
├── scheme
├── category
├── level
├── source
├── confidence
├── evidence
├── state
├── version
└── assignedAt
```

---

# 36. Classification Source

Source podrá ser:

```text
MANUAL
RULE
METADATA
CONTENT
EXTERNAL
INFERRED
IMPORTED
```

Source deberá ser preservada cuando afecte Trust.

---

# 37. Classification Confidence

Confidence representa fuerza estimada de una Candidate Classification.

```text
Confidence
≠
Probability necesariamente
Confidence
≠
Truth
```

Su Semantics deberán estar definidas por el Classifier.

---

# 38. Classification Evidence

Evidence podrá incluir:

```text
rule match
metadata reference
pattern observation
schema annotation
business glossary mapping
external attestation
review record
```

Evidence deberá ser trazable cuando la Classification sea material.

---

# 39. Classification Reason

Reason deberá explicar por qué se produjo una Assignment.

Especialmente importante para:

```text
restricted classifications
regulatory classifications
automatic decisions
overrides
```

---

# 40. Sensitive Data Discovery

Sensitive Data Discovery podrá identificar candidatos de Data sensible.

No deberá exponer el contenido sensible en resultados más allá de lo necesario.

---

# 41. Personal Data Discovery

ENG-082 será autoridad sobre Data Privacy.

Discovery de Personal Data deberá operar bajo Purpose, Authorization y minimización.

```text
Personal Data Candidate
≠
Confirmed Personal Data Classification automáticamente
```

---

# 42. Regulated Data Discovery

ENG-083 será autoridad sobre Data Compliance.

Regulated Data Discovery podrá proponer categorías relacionadas con obligaciones regulatorias.

Classification automática no deberá presentarse como interpretación jurídica definitiva.

---

# 43. Classification Validation

ENG-036 será autoridad general.

Validation podrá comprobar:

```text
scheme
category
level
rule
evidence
confidence
subject
version
state
```

---

# 44. Classification Review

Review podrá requerirse por:

```text
low confidence
high sensitivity
regulatory impact
rule conflict
manual override
classification drift
```

---

# 45. Classification Approval

Approval deberá registrar autoridad y estado.

```text
Detected
≠
Validated
≠
Approved
```

---

# 46. Classification Override

Override deberá ser explícito y trazable.

Conceptualmente:

```text
ClassificationOverride
├── original
├── replacement
├── reason
├── actor
├── authority
├── timestamp
└── expiry
```

---

# 47. Classification State

Podrá utilizar:

```text
CANDIDATE
VALIDATED
APPROVED
OVERRIDDEN
STALE
RETIRED
```

ENG-055 será autoridad general de Lifecycle.

---

# 48. Classification Version

ENG-014 será autoridad general.

Deberán poder distinguirse:

```text
scheme version
rule version
assignment version
asset version
```

---

# 49. Classification Freshness

Una Classification podrá quedar stale cuando cambie:

```text
asset
schema
content
policy
scheme
rule
business meaning
```

---

# 50. Classification Drift

Drift representa cambio material entre Classification esperada y observada.

Podrá disparar Review o Reclassification.

---

# 51. False Positive

False Positive representa detección o Classification incorrectamente positiva.

Deberá poder medirse cuando exista Ground Truth suficiente.

---

# 52. False Negative

False Negative representa Data relevante no detectada o no clasificada.

```text
No Detection
≠
No Sensitive Data
```

---

# 53. Ambiguous Classification

Cuando múltiples categorías sean plausibles sin resolución suficiente, el sistema deberá poder representar Ambiguity.

No deberá forzar una Classification falsa por conveniencia.

---

# 54. Unknown Classification

`UNKNOWN` deberá ser un estado válido cuando Evidence sea insuficiente.

```text
Unknown
≠
Public
Unknown
≠
Unrestricted
```

---

# 55. Catalog Integration

ENG-090 será autoridad sobre Data Catalog.

Discovery podrá:

```text
find new assets
enrich metadata
propose classification
update discovery evidence
```

Catalog decidirá Registration/Publication conforme a su Contract y Policy.

---

# 56. Lineage Integration

ENG-089 será autoridad sobre Lineage & Provenance.

Lineage podrá aportar Context para Classification.

Classification no deberá alterar Historical Lineage Evidence.

---

# 57. Governance Integration

ENG-081 será autoridad.

Governance podrá definir:

```text
classification schemes
authorities
reviewers
required coverage
approval requirements
reclassification frequency
```

---

# 58. Privacy Integration

ENG-082 será autoridad.

Discovery deberá limitar Content Inspection y Evidence Retention según Purpose y Privacy Policy.

---

# 59. Compliance Integration

ENG-083 será autoridad.

Classification podrá alimentar Compliance Controls.

```text
Classification
≠
Compliance automáticamente
```

---

# 60. Ethics Integration

ENG-084 será autoridad.

Discovery y Classification no deberán utilizar atributos o inferencias fuera del Purpose permitido.

---

# 61. Trust Integration

ENG-085 será autoridad.

Trust de una Classification podrá considerar:

```text
source
evidence
classifier
validation
approval
freshness
drift
```

---

# 62. Quality Integration

ENG-080 será autoridad general.

Classification Quality podrá medir:

```text
precision
recall
coverage
accuracy
consistency
freshness
review agreement
```

cuando exista Ground Truth suficiente.

---

# 63. Security

ENG-024 será autoridad general.

Discovery Engines podrán tener acceso privilegiado y deberán aplicar Least Privilege.

Credentials de Sources no deberán incorporarse a Discovery Results.

---

# 64. Authorization

ENG-046 será autoridad.

Deberá existir Authorization para:

```text
scan
inspect content
view results
review classification
approve
override
export evidence
```

---

# 65. Multi-Tenancy

ENG-048 será autoridad.

Tenant Context deberá preservarse durante:

```text
scan
detection
classification
review
catalog update
search
diagnostics
```

Cross-Tenant Discovery no deberá ocurrir sin autoridad explícita.

---

# 66. Privacy of Evidence

Evidence podrá ser más sensible que la Classification.

```text
Classification Visibility
≠
Evidence Visibility
```

Una persona autorizada para ver `RESTRICTED` no necesariamente deberá ver la muestra que causó la clasificación.

---

# 67. Discovery Retention

ENG-092 será autoridad sobre Retention & Disposal.

Deberán distinguirse:

```text
scan metadata retention
discovery result retention
evidence retention
classification retention
```

---

# 68. Archival

ENG-093 será autoridad.

Historical Classification podrá archivarse para explicar decisiones previas.

---

# 69. Portability

ENG-094 será autoridad.

Classification Metadata podrá exportarse con Scheme, Version, Source y Evidence References cuando Contract lo permita.

---

# 70. Localization & Residency

ENG-099 será autoridad.

Discovery Results y Evidence también podrán estar sujetos a Residency.

Content Samples no deberán trasladarse entre jurisdicciones sin Policy aplicable.

---

# 71. Lifecycle Orchestration

ENG-100 podrá utilizar Classification para decisiones sobre:

```text
retention
archival
disposal
relocation
access review
```

pero ENG-091 no ejecutará directamente esos Lifecycle Actions salvo Contract explícito.

---

# 72. Discovery Observability

ENG-025 será autoridad general.

Metrics podrán incluir:

```text
mef.data_discovery.run.total
mef.data_discovery.run.failed.total
mef.data_discovery.asset.discovered.total
mef.data_discovery.field.scanned.total
mef.data_discovery.classification.candidate.total
mef.data_discovery.classification.approved.total
mef.data_discovery.classification.override.total
mef.data_discovery.classification.unknown.total
mef.data_discovery.classification.drift.total
mef.data_discovery.review.total
mef.data_discovery.false_positive.total
mef.data_discovery.false_negative.total
mef.data_discovery.coverage.ratio
```

---

# 73. Metric Labels

Podrán incluir:

```text
sourceType
assetType
classificationCategory
classificationState
method
result
failureType
```

con Cardinality controlada.

AssetId, FieldName, Raw Pattern o Personal Data no deberán utilizarse indiscriminadamente como Metric Labels.

---

# 74. Logging

Logging deberá evitar:

```text
raw payload
personal data samples
credentials
secrets
full sensitive values
```

cuando no sean estrictamente necesarios.

---

# 75. Diagnostics

Deberá poder responder:

```text
which run?
which source?
which target?
which scope?
which boundary?
which asset?
which field?
which method?
which rule?
which rule version?
which scheme?
which category?
which level?
which source type?
which confidence?
which evidence?
which state?
which reviewer?
which override?
which tenant?
which policy?
which freshness?
which drift?
```

---

# 76. Modelos Conceptuales

```text
DiscoveryRun
├── id
├── contract
├── source
├── scope
├── boundary
├── method
├── startedAt
├── completedAt
└── status
```

```text
DiscoveryResult
├── id
├── runId
├── subject
├── observations
├── candidates
├── confidence
├── evidence
└── capturedAt
```

```text
ClassificationAssignment
├── id
├── subject
├── scheme
├── category
├── level
├── source
├── confidence
├── evidence
├── state
├── version
└── assignedAt
```

---

# 77. Discovery Runtime

Conceptualmente:

```text
DataDiscoveryRuntime
├── discover
├── scan
├── detect
├── classify
├── validate
├── review
├── approve
├── override
├── reclassify
├── observe
└── diagnose
```

---

# 78. Registry Integration

ENG-020 podrá registrar:

```text
discovery providers
classifiers
classification schemes
classification rules
review providers
```

---

# 79. Metadata Integration

ENG-057 será autoridad general.

Discovery podrá producir Metadata.

Catalog podrá persistir Metadata gobernada.

Discovery Result no deberá convertirse automáticamente en Authoritative Metadata.

---

# 80. Schema Integration

ENG-062 será autoridad.

Schema Discovery podrá producir Candidate Schema Observations.

La adopción de un Schema autoritativo deberá obedecer ENG-062 y Validation aplicable.

---

# 81. Validation Integration

ENG-036 podrá validar:

```text
discovery contract
scope
boundary
scheme
rule
assignment
confidence
evidence
state
override
```

---

# 82. Testing

ENG-009 será autoridad general.

Deberán existir pruebas para:

```text
scope enforcement
boundary enforcement
asset discovery
schema discovery
field discovery
pattern detection
semantic discovery
classification scheme
rule evaluation
rule conflict
manual classification
metadata classification
content classification
inferred classification
confidence
evidence
validation
review
approval
override
versioning
freshness
drift
false positive handling
false negative handling
ambiguous classification
unknown classification
catalog integration
tenant isolation
privacy
authorization
retention
```

---

# 83. Architecture Test

Podrá impedir:

```text
discovery treated as classification
detection treated as authoritative classification
classification treated as tag
classification treated as authorization
not scanned treated as no data
field name treated as business meaning
pattern match treated as conclusive classification
semantic candidate treated as authoritative business term
confidence treated as truth
inferred treated as validated
detected treated as approved
unknown treated as public
unknown treated as unrestricted
no detection treated as no sensitive data
classification visibility treated as evidence visibility
discovery result treated as authoritative catalog metadata
automatic classification treated as legal interpretation
```

---

# 84. Build Integration

ENG-012 podrá validar:

```text
discovery contracts
classification schemes
classification rules
confidence thresholds
review requirements
privacy constraints
security constraints
tenant boundaries
catalog integration
```

---

# 85. CLI

ENG-007 podrá proporcionar:

```text
mef data-discovery
mef data-discovery:scan
mef data-discovery:show
mef data-discovery:classify
mef data-discovery:review
mef data-discovery:approve
mef data-discovery:override
mef data-discovery:drift
mef data-discovery:coverage
mef data-discovery:diagnose
```

---

# 86. Error Namespace

ENG-091 utilizará:

```text
MEF-DATA-DISCOVERY-xxx
```

Taxonomía inicial:

```text
MEF-DATA-DISCOVERY-001 Discovery contract invalid
MEF-DATA-DISCOVERY-002 Discovery scope invalid
MEF-DATA-DISCOVERY-003 Discovery boundary invalid
MEF-DATA-DISCOVERY-004 Discovery source unavailable
MEF-DATA-DISCOVERY-005 Discovery scan failed
MEF-DATA-DISCOVERY-006 Discovery result invalid
MEF-DATA-DISCOVERY-007 Classification scheme invalid
MEF-DATA-DISCOVERY-008 Classification rule invalid
MEF-DATA-DISCOVERY-009 Classification conflict
MEF-DATA-DISCOVERY-010 Classification assignment invalid
MEF-DATA-DISCOVERY-011 Classification confidence invalid
MEF-DATA-DISCOVERY-012 Classification evidence missing
MEF-DATA-DISCOVERY-013 Classification review required
MEF-DATA-DISCOVERY-014 Classification approval denied
MEF-DATA-DISCOVERY-015 Classification override invalid
MEF-DATA-DISCOVERY-016 Classification stale
MEF-DATA-DISCOVERY-017 Classification drift detected
MEF-DATA-DISCOVERY-018 Discovery authorization denied
MEF-DATA-DISCOVERY-019 Discovery tenant violation
MEF-DATA-DISCOVERY-020 Discovery privacy violation
MEF-DATA-DISCOVERY-021 Discovery security violation
MEF-DATA-DISCOVERY-022 Content inspection denied
MEF-DATA-DISCOVERY-023 Catalog integration failed
MEF-DATA-DISCOVERY-024 Classification version mismatch
MEF-DATA-DISCOVERY-025 Classification state invalid
MEF-DATA-DISCOVERY-026 Classification unknown
MEF-DATA-DISCOVERY-027 Classification ambiguous
MEF-DATA-DISCOVERY-028 Discovery coverage insufficient
MEF-DATA-DISCOVERY-029 Discovery evidence unavailable
MEF-DATA-DISCOVERY-030 Discovery invariant violation
```

---

# 87. First Implementation Components

La primera implementación deberá incluir:

```text
DiscoveryRunId
DiscoveryResultId
ClassificationAssignmentId

DataDiscoveryContract
DiscoveryScope
DiscoveryBoundary
DiscoverySource
DiscoveryRun
DiscoveryResult

ClassificationScheme
ClassificationCategory
ClassificationLevel
ClassificationRule
ClassificationAssignment
ClassificationConfidence
ClassificationEvidence
ClassificationState

DataDiscoveryRuntime
DataDiscoveryError
```

---

# 88. Optional Initial Components

Podrán incorporarse:

```text
ClassificationReview
ClassificationApproval
ClassificationOverride
ClassificationDriftDetector
DiscoveryDiagnostics
DiscoveryCoverage
```

---

# 89. Later Components

Solo cuando exista necesidad demostrada:

```text
Universal Content Scanner
Cross-Organization Discovery Network
Automatic Semantic Ontology Mapping
Continuous Global Classification
AI-Assisted Classification
AI-Assisted Sensitive Data Discovery
```

---

# 90. Estructura Conceptual

```text
src/
└── DataDiscovery/
    ├── Identity/
    │   ├── DiscoveryRunId
    │   ├── DiscoveryResultId
    │   └── ClassificationAssignmentId
    ├── Contract/
    │   └── DataDiscoveryContract
    ├── Scope/
    │   ├── DiscoveryScope
    │   └── DiscoveryBoundary
    ├── Source/
    │   └── DiscoverySource
    ├── Discovery/
    │   ├── DiscoveryRun
    │   └── DiscoveryResult
    ├── Classification/
    │   ├── ClassificationScheme
    │   ├── ClassificationCategory
    │   ├── ClassificationLevel
    │   ├── ClassificationRule
    │   ├── ClassificationAssignment
    │   ├── ClassificationConfidence
    │   ├── ClassificationEvidence
    │   └── ClassificationState
    ├── Review/
    │   ├── ClassificationReview
    │   └── ClassificationOverride
    ├── Runtime/
    │   └── DataDiscoveryRuntime
    ├── Diagnostics/
    │   └── DataDiscoveryDiagnostics
    └── Error/
        └── DataDiscoveryError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 91. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Discovery Scope
Explicit Discovery Boundary
Explicit Discovery Run Identity
Asset Discovery
Schema/Field Discovery
Rule-Based Classification
Metadata-Based Classification
Controlled Content Inspection
Classification Scheme
Classification Rule Versioning
Classification Source
Confidence
Evidence
Unknown State
Validation
Review
Approval where required
Override Traceability
Freshness
Drift
Catalog Integration
Tenant Isolation
Security
Privacy
Observability
Testing
```

---

# 92. First Version Non-Goals

No deberá requerir inicialmente:

```text
Universal Deep Content Inspection
Automatic Legal Classification
Global Cross-Organization Discovery
Universal Semantic Reconciliation
Continuous Full-Data Scanning
AI-Assisted Classification
```

---

# 93. Invariantes de Ingeniería

ENG-091 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1766 | Todo proceso material de Data Discovery deberá declarar Identity, Scope, Boundary, Source, Method, Run y Evidence suficientes para que un resultado pueda interpretarse sin conocimiento implícito. |
| EI-1767 | Data Discovery, Data Classification, Detection, Catalog Registration y Authorization deberán permanecer diferenciados y ninguno deberá utilizarse como sustituto universal de los demás. |
| EI-1768 | No haber inspeccionado o detectado Data no deberá interpretarse como prueba de inexistencia y `Not Scanned`, `No Detection` y `No Data` deberán permanecer diferenciados. |
| EI-1769 | Discovery Result, Observation, Candidate Classification y Authoritative Classification deberán permanecer diferenciados y una detección automática no deberá publicarse como Classification gobernada sin Validation suficiente. |
| EI-1770 | Classification Scheme, Category, Level, Label, Tag y Business Term deberán conservar Semantics diferenciadas y similitud nominal no deberá utilizarse como equivalencia automática. |
| EI-1771 | Todo Classification Assignment material deberá preservar Subject, Scheme, Scheme Version, Category/Level, Source, Confidence, Evidence, State, Assignment Version y Timestamp suficientes para explicar su origen y vigencia. |
| EI-1772 | Manual, Rule-Based, Metadata-Based, Content-Based, Imported e Inferred Classification deberán identificar su Source y una Classification inferida no deberá presentarse como Validated o Approved. |
| EI-1773 | Classification Confidence deberá poseer Semantics definidas por el Classifier y no deberá presentarse automáticamente como Probability, Truth, Accuracy o Trust. |
| EI-1774 | Classification Evidence y Classification Visibility deberán permanecer diferenciadas y acceso a una Classification no deberá conferir automáticamente acceso a muestras, Payload o Evidence sensible que la originó. |
| EI-1775 | Sensitive, Personal y Regulated Data Discovery deberán aplicar Purpose, Authorization, minimización y Evidence controls y una Classification automática no deberá presentarse como interpretación jurídica definitiva. |
| EI-1776 | Detected, Validated, Approved, Overridden, Stale, Retired, Ambiguous y Unknown deberán conservar estados diferenciados y `UNKNOWN` nunca deberá degradarse automáticamente a `PUBLIC` o `UNRESTRICTED`. |
| EI-1777 | Classification Override deberá preservar Classification original, reemplazo, Reason, Actor, Authority, Timestamp y Expiry cuando aplique y no deberá destruir Historical Classification. |
| EI-1778 | Scheme Version, Rule Version, Assignment Version y Asset Version deberán permanecer diferenciadas y Reclassification deberá preservar suficiente historia para explicar cambios de Classification. |
| EI-1779 | Classification Freshness y Classification Drift deberán ser observables y cambios materiales de Asset, Schema, Content, Policy, Scheme, Rule o Business Meaning deberán poder provocar Review o Reclassification. |
| EI-1780 | Catalog Integration deberá preservar la frontera entre Discovery y ENG-090: Discovery podrá proponer Assets y Metadata, pero Registration, Publication y Catalog Lifecycle deberán permanecer gobernados por Data Catalog Engineering. |
| EI-1781 | Lineage, Governance, Privacy, Compliance, Ethics, Quality y Trust podrán aportar Context o Controls a Classification, pero ENG-091 no deberá redefinir las autoridades establecidas por ENG-089, ENG-081, ENG-082, ENG-083, ENG-084, ENG-080 o ENG-085. |
| EI-1782 | Discovery Security, Authorization y Multi-Tenancy deberán preservar Least Privilege, Tenant Context y Source Boundaries durante Scan, Content Inspection, Classification, Review, Catalog Update y Diagnostics. |
| EI-1783 | Scan Metadata, Discovery Results, Evidence y Classification Retention deberán evaluarse separadamente y Content Samples sensibles no deberán persistirse más allá de lo necesario para Purpose, Validation o Compliance legítimos. |
| EI-1784 | Discovery Observability, Diagnostics y Testing deberán permitir reconstruir Run, Source, Target, Scope, Boundary, Asset, Method, Rule/Version, Scheme, Category, Level, Source Type, Confidence, Evidence, State, Reviewer, Override, Tenant, Policy, Freshness y Drift sin exponer Payload sensible innecesariamente. |
| EI-1785 | La primera implementación deberá priorizar Scope/Boundary, Run Identity, Asset/Schema/Field Discovery, Rule/Metadata Classification, Controlled Content Inspection, Scheme/Rule Versioning, Source, Confidence, Evidence, Unknown State, Validation, Review, Override Traceability, Freshness, Drift, Catalog Integration, Tenant Isolation, Security, Privacy, Observability y Testing antes de introducir Universal Deep Scanning, Automatic Legal Classification o AI-Assisted Classification. |

---

# 94. Continuidad de Invariantes

```text
ENG-086 → EI-1666 a EI-1685
ENG-087 → EI-1686 a EI-1705
ENG-088 → EI-1706 a EI-1725
ENG-089 → EI-1726 a EI-1745
ENG-090 → EI-1746 a EI-1765
ENG-091 → EI-1766 a EI-1785
```

---

# 95. Criterios de Conformidad

Una implementación será conforme con ENG-091 cuando:

- modele Discovery Identity, Scope y Boundary;
- preserve Source, Target, Scan y Run;
- diferencie Discovery y Classification;
- diferencie Detection y Authoritative Classification;
- implemente Classification Scheme, Category y Level;
- preserve Classification Source, Confidence y Evidence;
- soporte Manual, Rule-Based, Metadata-Based e Inferred Classification;
- controle Content-Based Classification;
- modele Validation, Review, Approval y Override;
- preserve Unknown y Ambiguous Classification;
- gestione Version, Freshness y Drift;
- integre Catalog sin apropiarse de Catalog Lifecycle;
- preserve Lineage/Governance/Privacy/Compliance boundaries;
- preserve Tenant Isolation;
- implemente Security, Authorization y Evidence Privacy;
- implemente Observability, Diagnostics y Testing.

---

# 96. Riesgos

Deberán evitarse especialmente:

```text
Discovery Equals Classification
Detection Equals Authoritative Classification
Classification Equals Tag
Classification Equals Authorization

Not Scanned Equals No Data
No Detection Equals No Sensitive Data

Field Name Equals Business Meaning
Pattern Match Equals Conclusive Classification

Confidence Equals Truth
Confidence Equals Probability

Inferred Equals Validated
Detected Equals Approved

Unknown Equals Public
Unknown Equals Unrestricted

Classification Visibility Equals Evidence Visibility

Discovery Result Equals Authoritative Catalog Metadata
Automatic Classification Equals Legal Interpretation

Cross-Tenant Discovery
Uncontrolled Content Inspection
Sensitive Evidence Leakage
Historical Classification Loss
```

---

# 97. Relación con ENG-090

ENG-090 gobierna Data Catalog.

```text
ENG-090
DATA CATALOG
│
└── Organizes and exposes governed
    metadata about known Data Assets.

ENG-091
DATA DISCOVERY & CLASSIFICATION
│
└── Finds Data Assets and determines
    candidate or governed classifications.
```

Discovery podrá alimentar Catalog Entries y Classification Metadata.

ENG-090 seguirá siendo autoritativo sobre Catalog Registration, Publication, Search Surface y Lifecycle.

---

# 98. Relación con ENG-092

ENG-092 formaliza **Data Retention & Disposal Engineering**.

La frontera será:

```text
ENG-091
DISCOVERY & CLASSIFICATION
│
└── What Data exists and
    what classification applies?

ENG-092
RETENTION & DISPOSAL
│
└── How long should Data be retained
    and how is it disposed?
```

Classification podrá ser Input para Retention Policy.

ENG-091 no deberá ejecutar Disposal por inferencia propia.

---

# 99. Principio Rector

> **MEF deberá distinguir siempre entre encontrar, observar, inferir, validar y gobernar: descubrir Data no equivale a clasificarlo, detectar un patrón no equivale a conocer su significado, y una Classification automática no deberá adquirir autoridad mayor que la Evidence, Policy y Validation que la respaldan.**

---

# 100. Conclusión

**ENG-091 — Data Discovery & Classification Engineering** formaliza el descubrimiento de Data Assets y su Classification gobernada dentro de MEF.

```text
DATA SOURCE
    │
    ▼
DISCOVERY RUN
    │
    ├── Scope
    ├── Boundary
    ├── Method
    └── Evidence
    │
    ▼
DISCOVERY RESULT
    │
    ▼
CLASSIFICATION CANDIDATE
    │
    ├── Scheme
    ├── Rule
    ├── Source
    ├── Confidence
    └── Evidence
    │
    ▼
VALIDATION / REVIEW
    │
    ▼
GOVERNED CLASSIFICATION
    │
    ├── Catalog
    ├── Governance
    ├── Privacy
    ├── Security
    └── Compliance
```

Las separaciones esenciales quedan:

```text
DISCOVERY ≠ CLASSIFICATION
DETECTION ≠ AUTHORITATIVE CLASSIFICATION
CLASSIFICATION ≠ TAG
CLASSIFICATION ≠ AUTHORIZATION

NOT SCANNED ≠ NO DATA
NO DETECTION ≠ NO SENSITIVE DATA

FIELD NAME ≠ BUSINESS MEANING
PATTERN MATCH ≠ CONCLUSIVE CLASSIFICATION

CONFIDENCE ≠ TRUTH
INFERRED ≠ VALIDATED
DETECTED ≠ APPROVED

UNKNOWN ≠ PUBLIC
UNKNOWN ≠ UNRESTRICTED

CLASSIFICATION VISIBILITY ≠ EVIDENCE VISIBILITY
```

Con **ENG-091**, la serie global alcanza:

```text
EI-1785
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
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-062 — Schema Engineering
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
- ENG-092 — Data Retention & Disposal Engineering
- ENG-093 — Data Archival & Preservation Engineering
- ENG-094 — Data Portability Engineering
- ENG-095 — Data Synchronization Engineering
- ENG-096 — Data Replication Engineering
- ENG-097 — Data Partitioning & Sharding Engineering
- ENG-098 — Data Distribution Engineering
- ENG-099 — Data Localization & Residency Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
