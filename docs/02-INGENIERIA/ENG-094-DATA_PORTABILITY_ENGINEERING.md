---
id: ENG-094
titulo: Data Portability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Portability Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-13

dependencias:
  - ENG-000
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
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
  - ENG-059
  - ENG-061
  - ENG-062
  - ENG-079
  - ENG-080
  - ENG-081
  - ENG-082
  - ENG-083
  - ENG-085
  - ENG-086
  - ENG-087
  - ENG-089
  - ENG-090
  - ENG-091
  - ENG-092
  - ENG-093

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-030
  - ENG-031
  - ENG-034
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-058
  - ENG-060
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-084
  - ENG-088
  - ENG-095
  - ENG-096
  - ENG-097
  - ENG-098
  - ENG-099
  - ENG-100

keywords:
  - data-portability
  - export
  - import
  - transfer
  - portable-package
  - interoperability
  - schema
  - semantics
  - manifest
  - integrity
  - provenance
  - compatibility
  - migration
  - portability-contract
  - mef

---

# ENG-094 — Data Portability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Portability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-094 establece reglas para:

```text
Data Portability
Portable Data

Portability Identity
Portability Scope
Portability Boundary
Portability Contract
Portability Policy

Portability Request
Portability Authorization
Portability Plan
Portability Execution
Portability Result

Data Export
Data Import
Data Transfer

Portable Package
Package Manifest
Package Metadata
Package Schema
Package Semantics
Package Version

Source System
Target System

Source Representation
Portable Representation
Target Representation

Format
Encoding
Schema
Semantics
Units
Identifiers
Relationships

Transformation
Mapping
Normalization
Conversion

Compatibility
Interoperability
Fidelity
Completeness

Integrity
Fixity
Provenance
Lineage

Security
Privacy
Governance
Compliance
Residency

Portability Validation
Portability Verification
Portability Evidence

Portability Observability
Portability Diagnostics
Portability Testing
```

---

# 2. Declaración

> **MEF deberá permitir que Data autorizado pueda exportarse, transferirse o importarse mediante Contracts, Packages, Schemas, Semantics, Metadata, Integrity, Provenance y Validation explícitos, preservando suficiente fidelidad para que el Data siga siendo interpretable y utilizable fuera de su representación de origen, sin confundir copiar bytes con lograr Portability.**

Arquitectura conceptual:

```text
SOURCE SYSTEM
     │
     ▼
PORTABILITY REQUEST
     │
     ├── Scope
     ├── Authorization
     ├── Policy
     └── Contract
     │
     ▼
PORTABILITY PLAN
     │
     ▼
EXPORT / TRANSFORMATION
     │
     ▼
PORTABLE PACKAGE
     │
     ├── Manifest
     ├── Data
     ├── Schema
     ├── Semantics
     ├── Metadata
     ├── Integrity
     └── Provenance
     │
     ▼
TRANSFER
     │
     ▼
IMPORT / VALIDATION
     │
     ▼
TARGET SYSTEM
```

---

# 3. Data Portability

`Data Portability` representa la capacidad gobernada de extraer Data de un sistema o Boundary y representarlo de forma suficientemente completa, estructurada e interpretable para su transferencia o uso en otro contexto.

Portability podrá abarcar:

```text
records
datasets
files
events
data products
metadata
schemas
relationships
history
```

---

# 4. Portability ≠ Export

```text
Portability
≠
Export
```

Export es una operación.

Portability incluye además Semantics, Metadata, Compatibility, Integrity, Provenance y capacidad de interpretación en destino.

---

# 5. Portability ≠ Migration

```text
Portability
≠
Migration
```

Portability hace posible mover o reutilizar Data.

Migration podrá ser un proceso más amplio que incluya aplicaciones, configuraciones, cutover y cambios operacionales.

---

# 6. Portability ≠ Synchronization

ENG-095 será autoridad sobre Data Synchronization.

```text
Portability
≠
Synchronization
```

Una exportación puntual no crea por sí sola convergencia continua entre Source y Target.

---

# 7. Portability ≠ Replication

ENG-096 será autoridad sobre Data Replication.

```text
Portability
≠
Replication
```

Replication mantiene copias conforme a un modelo de consistencia.

Portability produce representaciones transferibles bajo un Contract.

---

# 8. Portability Identity

Artifacts materiales deberán poder poseer:

```text
PortabilityRequestId
PortabilityPlanId
PortabilityExecutionId
PortablePackageId
```

Identity deberá permanecer diferenciada de Source Asset Identity.

---

# 9. Portability Scope

Scope deberá declarar qué Data se incluye.

Podrá abarcar:

```text
tenant
domain
data product
dataset
records
time range
fields
metadata
relationships
history
```

---

# 10. Portability Boundary

Boundary deberá declarar qué queda dentro y fuera de la operación.

```text
Not Exported
≠
Not Existing
```

Exclusiones deberán ser explícitas cuando afecten Completeness.

---

# 11. Portability Contract

Conceptualmente:

```text
DataPortabilityContract
├── id
├── version
├── scope
├── format
├── schema
├── semantics
├── metadata
├── integrity
├── security
├── privacy
├── compatibility
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

---

# 12. Portability Policy

ENG-051 será autoridad general.

Policy podrá controlar:

```text
allowed scopes
allowed formats
authorization
redaction
transformations
encryption
destination
residency
retention
evidence
```

---

# 13. Portability Request

Conceptualmente:

```text
PortabilityRequest
├── id
├── requester
├── source
├── target
├── scope
├── purpose
├── contract
└── requestedAt
```

Request no deberá implicar Authorization.

---

# 14. Portability Authorization

ENG-046 será autoridad.

Deberán diferenciarse permisos para:

```text
request
export
read package
transfer
import
transform
verify
```

---

# 15. Portability Plan

Plan deberá resolver:

```text
scope
source
target
format
schema
mapping
transformations
security
transfer
validation
evidence
```

antes de Execution material cuando sea necesario.

---

# 16. Portability Execution

Execution deberá poseer estado explícito.

Podrá utilizar:

```text
PLANNED
AUTHORIZED
EXPORTING
EXPORTED
TRANSFERRING
IMPORTING
VALIDATING
COMPLETED
PARTIAL
FAILED
```

---

# 17. Data Export

Export deberá producir una representación gobernada del Scope solicitado.

No deberá exponer Data fuera del Scope por conveniencia técnica.

---

# 18. Data Import

Import deberá validar Package, Contract, Schema, Semantics, Integrity y Authorization antes de incorporar Data al Target.

---

# 19. Data Transfer

Transfer representa movimiento entre Source y Target o intermediarios.

```text
Export Completed
≠
Transfer Completed
≠
Import Completed
```

---

# 20. Portable Package

Conceptualmente:

```text
PortablePackage
├── id
├── version
├── manifest
├── data
├── schema
├── semantics
├── metadata
├── integrity
├── provenance
└── createdAt
```

---

# 21. Package Manifest

Manifest deberá describir contenido y estructura.

Podrá incluir:

```text
objects
paths
record counts
schemas
formats
checksums
relationships
metadata references
```

---

# 22. Package Metadata

Metadata deberá ser suficiente para interpretar el Package sin depender exclusivamente del Source System.

ENG-057 será autoridad general.

---

# 23. Package Schema

ENG-062 será autoridad sobre Schema.

Package deberá declarar Schema y Version cuando Structure sea relevante.

---

# 24. Package Semantics

Semantics deberán preservar significado suficiente.

Podrán incluir:

```text
business meaning
units
enumerations
null semantics
identifier semantics
time semantics
relationships
```

---

# 25. Package Version

Deberán diferenciarse:

```text
contract version
package version
schema version
mapping version
```

ENG-014 será autoridad general.

---

# 26. Source y Target

Source y Target deberán poseer Identity suficiente.

```text
Source Representation
≠
Portable Representation
≠
Target Representation
```

---

# 27. Format

Format deberá ser explícito y documentado.

File extension no deberá ser la única autoridad para determinarlo.

---

# 28. Encoding

Character, Binary, Date/Time y Numeric Encodings deberán ser explícitos cuando su interpretación pueda variar.

---

# 29. Units

Units deberán preservarse o transformarse explícitamente.

```text
Value
without Unit
may be semantically incomplete
```

---

# 30. Identifiers

Deberá definirse si Identifiers son:

```text
globally stable
source-local
target-remapped
opaque
business identifiers
```

Remapping deberá preservar Relationship Evidence.

---

# 31. Relationships

Relationships relevantes deberán preservarse o declarar explícitamente su exclusión.

Ejemplos:

```text
parent-child
foreign key
ownership
lineage
membership
references
```

---

# 32. Transformation

Transformation deberá registrar:

```text
source
target
rule
version
reason
loss characteristics
```

---

# 33. Mapping

Conceptualmente:

```text
PortabilityMapping
├── id
├── version
├── sourceSchema
├── targetSchema
├── fieldMappings
├── transformations
└── lossPolicy
```

---

# 34. Normalization

Normalization podrá crear una representación portable canónica.

```text
Normalized
≠
Identical to Source
```

La relación deberá ser trazable.

---

# 35. Conversion

Conversion deberá declarar pérdida, redondeo, truncamiento o cambio semántico cuando ocurra.

Silent Loss no deberá aceptarse.

---

# 36. Fidelity

Fidelity representa cuánto de la información y significado del Source se conserva.

Podrá considerar:

```text
values
types
precision
relationships
semantics
metadata
history
```

---

# 37. Completeness

Completeness deberá poder evaluarse respecto al Scope.

Podrá utilizar:

```text
record counts
object counts
required fields
relationship coverage
metadata coverage
```

---

# 38. Compatibility

ENG-016 será autoridad general.

Compatibility deberá evaluarse entre Contract, Package y Target Capability.

---

# 39. Interoperability

Interoperability representa capacidad de distintos sistemas para intercambiar e interpretar Data bajo Contracts compatibles.

```text
Portable
≠
Universally Interoperable
```

---

# 40. Lossless Portability

`Lossless` solo deberá declararse cuando el modelo preserve toda información material definida por el Contract.

---

# 41. Lossy Portability

Cuando exista pérdida aceptada deberá declararse:

```text
what is lost
why
under which policy
with which impact
```

---

# 42. Integrity

ENG-079 será autoridad.

Package deberá permitir detectar alteración cuando el Risk Model lo requiera.

---

# 43. Fixity

Checksums o mecanismos equivalentes podrán proteger Objects o Package.

```text
Fixity
≠
Authenticity
```

---

# 44. Provenance

ENG-089 será autoridad.

Portability deberá preservar Source, Export Event, Transformations y Target Import Relationship cuando sean materiales.

---

# 45. Lineage

Lineage podrá relacionar:

```text
source asset
portable package
transformed object
target asset
```

sin reemplazar Historical Lineage.

---

# 46. Security

ENG-024 será autoridad.

Portability podrá requerir:

```text
encryption
secure transfer
key management
least privilege
tamper protection
```

---

# 47. Privacy

ENG-082 será autoridad.

Portability deberá respetar:

```text
purpose
minimization
redaction
consent where applicable
data subject constraints
```

---

# 48. Governance

ENG-081 será autoridad.

Governance podrá definir:

```text
approved formats
export authorities
destination classes
required metadata
loss policies
evidence requirements
```

---

# 49. Compliance

ENG-083 será autoridad.

Portability podrá estar sujeta a obligaciones regulatorias o contractuales.

```text
Exportable
≠
Legally Transferable
```

---

# 50. Ethics

ENG-084 será autoridad.

La capacidad técnica de exportar Data no deberá ampliar Purpose o uso autorizado.

---

# 51. Trust

ENG-085 será autoridad.

Trust podrá considerar:

```text
source
integrity
provenance
transformation evidence
validation
target acknowledgement
```

---

# 52. Multi-Tenancy

ENG-048 será autoridad.

Tenant Context deberá preservarse durante:

```text
request
export
package creation
transfer
import
validation
diagnostics
```

---

# 53. Localization & Residency

ENG-099 será autoridad.

Portability deberá evaluar si Export, Transit, Temporary Storage e Import cambian Location o Residency.

---

# 54. Retention

ENG-092 será autoridad.

Portable Copies deberán poseer Retention y Disposal Semantics explícitas.

```text
Source Retention
≠
Export Copy Retention necesariamente
```

---

# 55. Archival & Preservation

ENG-093 será autoridad.

Un Preservation Package podrá ser portable.

Un Portable Package no deberá presentarse automáticamente como Preservation Package.

---

# 56. Catalog Integration

ENG-090 será autoridad.

Catalog podrá registrar:

```text
portable formats
export interfaces
schema references
portability capabilities
```

---

# 57. Discovery & Classification

ENG-091 será autoridad.

Classification podrá controlar Scope, Redaction, Encryption o Destination.

ENG-094 no deberá reinterpretar Classification.

---

# 58. Data Product Integration

ENG-086 será autoridad.

Data Product podrá exponer Portability Contract o Export Interface.

Portability no deberá sustituir Product Contract.

---

# 59. Exchange & Sharing

ENG-087 será autoridad.

```text
Portability
≠
Data Sharing
```

Sharing gobierna intercambio entre Participants.

Portability gobierna representación y movimiento reutilizable de Data.

---

# 60. Federation

ENG-088 será autoridad.

Federated Access sin materialización no deberá tratarse como Portability.

Materialized Export sí podrá entrar al Scope de ENG-094.

---

# 61. Synchronization

ENG-095 será autoridad.

Import posterior no deberá generar Synchronization implícita.

---

# 62. Replication

ENG-096 será autoridad.

Transferir un Package no crea Replica gobernada salvo que un Contract de Replication lo establezca.

---

# 63. Partitioning & Sharding

ENG-097 será autoridad.

Portability deberá evitar omitir Shards o Partitions relevantes al Scope.

---

# 64. Distribution

ENG-098 será autoridad.

Source Distribution no deberá filtrarse innecesariamente al Portable Contract.

El Package deberá ser interpretable sin conocer Topology interna cuando sea posible.

---

# 65. Lifecycle Orchestration

ENG-100 podrá orquestar Request, Export, Transfer, Import, Validation y Cleanup.

ENG-094 seguirá siendo autoritativo sobre Portability Semantics.

---

# 66. Portability Validation

ENG-036 será autoridad general.

Validation podrá comprobar:

```text
contract
scope
manifest
schema
format
metadata
mapping
integrity
authorization
target compatibility
```

---

# 67. Portability Verification

Verification deberá evaluar resultado respecto al Contract.

Podrá comprobar:

```text
package integrity
completeness
record counts
schema compatibility
relationship coverage
target acceptance
```

---

# 68. Portability Evidence

Conceptualmente:

```text
PortabilityEvidence
├── executionId
├── source
├── package
├── target
├── transformations
├── validation
├── verification
└── completedAt
```

---

# 69. Partial Portability

Si parte del Scope no pudo procesarse:

```text
PARTIAL
≠
COMPLETED
```

Missing Scope deberá ser explícito.

---

# 70. Failed Portability

Failure deberá conservar:

```text
stage
reason
scope
recoverability
evidence
```

No deberá presentarse Package parcial como completo.

---

# 71. Retry

Retry deberá evitar duplicación o corrupción cuando el Target pueda recibir operaciones repetidas.

Idempotency deberá definirse por Contract cuando sea necesaria.

---

# 72. Resume

Large Transfers podrán soportar Resume.

Resume deberá preservar Package Identity, Integrity y Progress Evidence.

---

# 73. Temporary Artifacts

Temporary Files, Staging Copies y Transfer Buffers deberán poseer Security, Retention y Cleanup explícitos.

---

# 74. Target Acknowledgement

Target podrá emitir Acknowledgement de recepción o importación.

```text
Acknowledged
≠
Semantically Validated necesariamente
```

---

# 75. Portability Observability

ENG-025 será autoridad general.

Metrics podrán incluir:

```text
mef.data_portability.request.total
mef.data_portability.export.total
mef.data_portability.export.failed.total
mef.data_portability.transfer.total
mef.data_portability.import.total
mef.data_portability.import.failed.total
mef.data_portability.partial.total
mef.data_portability.validation.failed.total
mef.data_portability.bytes
mef.data_portability.duration
mef.data_portability.completeness.ratio
```

---

# 76. Metric Labels

Podrán incluir:

```text
format
state
stage
result
assetType
targetType
failureType
```

con Cardinality controlada.

PackageId, TenantId, filenames o Personal Data no deberán utilizarse indiscriminadamente como Metric Labels.

---

# 77. Logging

Logging deberá evitar:

```text
raw exported data
personal data
credentials
encryption keys
sensitive identifiers
```

cuando no sean necesarios.

---

# 78. Diagnostics

Deberá poder responder:

```text
which request?
which source?
which target?
which scope?
which contract?
which package?
which manifest?
which format?
which schema?
which mapping?
which transformations?
which integrity evidence?
which classification?
which tenant?
which residency?
which execution?
which stage?
which missing scope?
which validation?
which verification?
```

---

# 79. Modelos Conceptuales

```text
PortabilityRequest
├── id
├── source
├── target
├── scope
├── purpose
├── contract
└── requester
```

```text
PortablePackage
├── id
├── version
├── manifest
├── objects
├── schema
├── semantics
├── metadata
├── integrity
└── provenance
```

```text
PortabilityExecution
├── id
├── request
├── plan
├── package
├── state
├── result
└── evidence
```

---

# 80. Portability Runtime

Conceptualmente:

```text
DataPortabilityRuntime
├── request
├── plan
├── export
├── transform
├── package
├── transfer
├── import
├── validate
├── verify
├── observe
└── diagnose
```

---

# 81. Registry Integration

ENG-020 podrá registrar:

```text
portable formats
export providers
import providers
mapping providers
transfer providers
verification providers
```

---

# 82. Metadata Integration

ENG-057 será autoridad.

Portable Package deberá incluir Metadata suficiente para Interpretation y Governance conforme al Contract.

---

# 83. Schema Integration

ENG-062 será autoridad.

Schema deberá ser versionado y transportable o resoluble mediante referencia estable.

---

# 84. Validation Integration

ENG-036 podrá validar:

```text
request
scope
contract
package
manifest
schema
mapping
format
metadata
integrity
target capability
```

---

# 85. Testing

ENG-009 será autoridad general.

Deberán existir pruebas para:

```text
scope enforcement
authorization
export
import
transfer
manifest
schema
semantics
encoding
units
identifiers
relationships
mapping
normalization
conversion
loss detection
fidelity
completeness
integrity
provenance
privacy
tenant isolation
residency
partial execution
retry
resume
temporary cleanup
target acknowledgement
```

---

# 86. Architecture Test

Podrá impedir:

```text
portability treated as export only
portability treated as migration
portability treated as synchronization
portability treated as replication
request treated as authorization
export completed treated as transfer completed
transfer completed treated as import completed
normalized treated as identical to source
silent conversion loss
portable treated as universally interoperable
fixity treated as authenticity
exportable treated as legally transferable
portable package treated as preservation package
federated access treated as portability
target acknowledgement treated as semantic validation
partial treated as completed
```

---

# 87. Build Integration

ENG-012 podrá validar:

```text
portability contracts
portable formats
schemas
mappings
loss policies
required metadata
security requirements
privacy requirements
residency constraints
verification requirements
```

---

# 88. CLI

ENG-007 podrá proporcionar:

```text
mef data-portability
mef data-portability:request
mef data-portability:plan
mef data-portability:export
mef data-portability:transfer
mef data-portability:import
mef data-portability:validate
mef data-portability:verify
mef data-portability:show
mef data-portability:diagnose
```

---

# 89. Error Namespace

ENG-094 utilizará:

```text
MEF-DATA-PORTABILITY-xxx
```

Taxonomía inicial:

```text
MEF-DATA-PORTABILITY-001 Portability contract invalid
MEF-DATA-PORTABILITY-002 Portability request invalid
MEF-DATA-PORTABILITY-003 Portability scope invalid
MEF-DATA-PORTABILITY-004 Portability authorization denied
MEF-DATA-PORTABILITY-005 Portability plan invalid
MEF-DATA-PORTABILITY-006 Portable format unsupported
MEF-DATA-PORTABILITY-007 Portable package invalid
MEF-DATA-PORTABILITY-008 Package manifest invalid
MEF-DATA-PORTABILITY-009 Package schema invalid
MEF-DATA-PORTABILITY-010 Package metadata incomplete
MEF-DATA-PORTABILITY-011 Portability mapping invalid
MEF-DATA-PORTABILITY-012 Portability conversion lossy
MEF-DATA-PORTABILITY-013 Portability integrity failure
MEF-DATA-PORTABILITY-014 Portability compatibility failure
MEF-DATA-PORTABILITY-015 Portability export failed
MEF-DATA-PORTABILITY-016 Portability transfer failed
MEF-DATA-PORTABILITY-017 Portability import failed
MEF-DATA-PORTABILITY-018 Portability validation failed
MEF-DATA-PORTABILITY-019 Portability verification failed
MEF-DATA-PORTABILITY-020 Portability partial
MEF-DATA-PORTABILITY-021 Portability tenant violation
MEF-DATA-PORTABILITY-022 Portability privacy violation
MEF-DATA-PORTABILITY-023 Portability security violation
MEF-DATA-PORTABILITY-024 Portability residency violation
MEF-DATA-PORTABILITY-025 Portability provenance incomplete
MEF-DATA-PORTABILITY-026 Portability retry unsafe
MEF-DATA-PORTABILITY-027 Portability resume invalid
MEF-DATA-PORTABILITY-028 Portability temporary cleanup failed
MEF-DATA-PORTABILITY-029 Portability state invalid
MEF-DATA-PORTABILITY-030 Portability invariant violation
```

---

# 90. First Implementation Components

La primera implementación deberá incluir:

```text
PortabilityRequestId
PortabilityPlanId
PortabilityExecutionId
PortablePackageId

DataPortabilityContract
PortabilityRequest
PortabilityPlan
PortablePackage
PackageManifest
PortabilityMapping
PortabilityExecution
PortabilityEvidence

DataPortabilityRuntime
DataPortabilityError
```

---

# 91. Optional Initial Components

Podrán incorporarse:

```text
PortabilityVerifier
PortabilityCompatibilityChecker
PortabilityResumeState
TargetAcknowledgement
PortabilityDiagnostics
```

---

# 92. Later Components

Solo cuando exista necesidad demostrada:

```text
Universal Portable Representation
Automatic Cross-System Mapping
Cross-Provider Portability Broker
Continuous Portability Validation
AI-Assisted Mapping
AI-Assisted Semantic Conversion
```

---

# 93. Estructura Conceptual

```text
src/
└── DataPortability/
    ├── Identity/
    │   ├── PortabilityRequestId
    │   ├── PortabilityPlanId
    │   ├── PortabilityExecutionId
    │   └── PortablePackageId
    ├── Contract/
    │   └── DataPortabilityContract
    ├── Request/
    │   └── PortabilityRequest
    ├── Plan/
    │   └── PortabilityPlan
    ├── Package/
    │   ├── PortablePackage
    │   └── PackageManifest
    ├── Mapping/
    │   └── PortabilityMapping
    ├── Execution/
    │   └── PortabilityExecution
    ├── Evidence/
    │   └── PortabilityEvidence
    ├── Runtime/
    │   └── DataPortabilityRuntime
    ├── Diagnostics/
    │   └── DataPortabilityDiagnostics
    └── Error/
        └── DataPortabilityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 94. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Scope
Explicit Authorization
Versioned Contract
Portable Package
Manifest
Schema
Semantics
Metadata
Format/Encoding
Identifier Semantics
Relationships
Mapping Version
Loss Declaration
Integrity
Provenance
Compatibility
Completeness
Partial State
Retry Safety
Temporary Cleanup
Tenant Isolation
Privacy
Residency
Observability
Testing
```

---

# 95. First Version Non-Goals

No deberá requerir inicialmente:

```text
Universal Portable Representation
Universal Cross-System Mapping
Automatic Legal Portability Decisions
Cross-Provider Portability Broker
Continuous Global Portability
AI-Assisted Semantic Conversion
```

---

# 96. Invariantes de Ingeniería

ENG-094 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1826 | Toda operación material de Data Portability deberá declarar Identity, Scope, Boundary, Source, Target, Contract, Authorization, Format, Schema, Semantics y Lifecycle suficientes para interpretar qué Data se mueve y bajo qué garantías. |
| EI-1827 | Data Portability, Export, Import, Transfer, Migration, Synchronization, Replication y Sharing deberán permanecer diferenciados y ninguna operación puntual deberá presentarse automáticamente como otra capacidad. |
| EI-1828 | Portability Request, Authorization, Plan, Execution y Result deberán permanecer diferenciados y la existencia de una Request no deberá conferir permiso de Export, Transfer o Import. |
| EI-1829 | Export Completed, Transfer Completed, Import Completed y Portability Verified deberán permanecer diferenciados y el éxito de una etapa no deberá presentarse como éxito end-to-end. |
| EI-1830 | Todo Portable Package material deberá preservar Package Identity/Version, Manifest, Data Objects, Schema, Semantics, Metadata, Integrity y Provenance suficientes para reducir dependencia implícita del Source System. |
| EI-1831 | Contract Version, Package Version, Schema Version y Mapping Version deberán permanecer diferenciadas y Compatibility deberá evaluarse contra las versiones realmente utilizadas. |
| EI-1832 | Source Representation, Portable Representation y Target Representation deberán permanecer diferenciadas y toda Normalization, Conversion o Transformation material deberá conservar trazabilidad entre ellas. |
| EI-1833 | Format, Encoding, Units, Identifier Semantics, Null Semantics, Time Semantics y Relationships deberán ser explícitos cuando afecten Interpretation y no deberán inferirse únicamente por nombres o convenciones locales. |
| EI-1834 | Toda Mapping o Conversion material deberá declarar Rules, Version y Loss Characteristics y ninguna pérdida, truncamiento, redondeo o exclusión material deberá ocurrir silenciosamente. |
| EI-1835 | Fidelity, Completeness, Compatibility e Interoperability deberán permanecer diferenciadas y un Package portable no deberá presentarse automáticamente como lossless, completo, compatible o universalmente interoperable. |
| EI-1836 | Integrity, Fixity, Authenticity, Provenance y Lineage deberán conservar Semantics diferenciadas y un Checksum válido no deberá presentarse automáticamente como prueba de origen o transformación correcta. |
| EI-1837 | Security, Privacy, Governance, Compliance, Ethics, Authorization, Trust y Multi-Tenancy deberán preservarse durante Request, Export, Packaging, Transfer, Import, Validation y Diagnostics sin redefinir las autoridades de sus ENG correspondientes. |
| EI-1838 | Exportable técnicamente no deberá interpretarse como transferible legal o contractualmente y Portability deberá evaluar Purpose, Destination, Classification, Policy, Privacy y Compliance aplicables. |
| EI-1839 | Export, Transit, Temporary Storage e Import deberán evaluar Localization & Residency y ninguna operación de Portability deberá mover Data o Evidence a una Location no autorizada por ENG-099. |
| EI-1840 | Portable Copies, Temporary Artifacts, Staging Data y Transfer Buffers deberán poseer Security, Retention, Disposal y Cleanup explícitos y no deberán convertirse en copias permanentes no gobernadas. |
| EI-1841 | Classification, Retention, Archival, Data Product, Sharing y Federation podrán aportar Contracts o Constraints a Portability, pero ENG-094 no deberá reinterpretar sus Semantics ni apropiarse de sus Lifecycles. |
| EI-1842 | Partial, Failed, Retried, Resumed, Acknowledged y Verified deberán conservar estados diferenciados y Missing Scope o Validation Failure no deberá ocultarse bajo un estado `COMPLETED`. |
| EI-1843 | Retry y Resume deberán preservar Package Identity, Integrity, Progress y Target Consistency y no deberán producir duplicación, corrupción o pérdida silenciosa cuando el Contract exija idempotencia. |
| EI-1844 | Portability Observability, Diagnostics, Evidence y Testing deberán permitir reconstruir Request, Source, Target, Scope, Contract, Package, Manifest, Format, Schema, Mapping, Transformations, Integrity, Classification, Tenant, Residency, Execution Stage, Missing Scope, Validation y Verification sin exponer Data exportado innecesariamente. |
| EI-1845 | La primera implementación deberá priorizar Scope, Authorization, Versioned Contracts, Portable Package/Manifest, Schema/Semantics/Metadata, Format/Encoding, Identifier/Relationship Semantics, Mapping Version, Loss Declaration, Integrity, Provenance, Compatibility, Completeness, Partial State, Retry Safety, Temporary Cleanup, Tenant Isolation, Privacy, Residency, Observability y Testing antes de introducir Universal Representations, Automatic Cross-System Mapping o AI-Assisted Semantic Conversion. |

---

# 97. Continuidad de Invariantes

```text
ENG-086 → EI-1666 a EI-1685
ENG-087 → EI-1686 a EI-1705
ENG-088 → EI-1706 a EI-1725
ENG-089 → EI-1726 a EI-1745
ENG-090 → EI-1746 a EI-1765
ENG-091 → EI-1766 a EI-1785
ENG-092 → EI-1786 a EI-1805
ENG-093 → EI-1806 a EI-1825
ENG-094 → EI-1826 a EI-1845
```

---

# 98. Criterios de Conformidad

Una implementación será conforme con ENG-094 cuando:

- modele Request, Scope, Boundary y Authorization;
- utilice Contracts versionados;
- diferencie Export, Transfer e Import;
- genere Portable Package y Manifest;
- preserve Schema, Semantics y Metadata;
- declare Format, Encoding, Units e Identifier Semantics;
- preserve Relationships relevantes;
- versione Mappings y Transformations;
- declare Loss Characteristics;
- mida Fidelity y Completeness cuando aplique;
- valide Compatibility;
- preserve Integrity, Provenance y Lineage;
- preserve Tenant Isolation, Privacy y Residency;
- gestione Partial/Failed Execution;
- implemente Retry/Resume seguros cuando aplique;
- gobierne Temporary Artifacts;
- implemente Validation, Verification, Evidence, Observability y Testing.

---

# 99. Riesgos

Deberán evitarse especialmente:

```text
Portability Equals Export
Portability Equals Migration
Portability Equals Synchronization
Portability Equals Replication

Request Equals Authorization

Export Complete Equals Transfer Complete
Transfer Complete Equals Import Complete
Import Complete Equals Verified

Normalized Equals Source
Silent Conversion Loss

Portable Equals Universally Interoperable
Portable Equals Lossless
Portable Equals Complete

Fixity Equals Authenticity

Exportable Equals Legally Transferable

Portable Package Equals Preservation Package
Federated Access Equals Portability

Acknowledged Equals Semantically Validated

Partial Equals Completed

Temporary Export Copy Becomes Permanent
Cross-Tenant Export
Residency Violation
```

---

# 100. Relación con ENG-093

ENG-093 gobierna **Data Archival & Preservation Engineering**.

```text
ENG-093
ARCHIVAL & PRESERVATION
│
└── Preserves Data and Evidence
    across long-term lifecycle.

ENG-094
DATA PORTABILITY
│
└── Represents and moves Data
    in a reusable governed form.
```

Un Preservation Package podrá utilizar mecanismos de Portability.

Un Portable Package no deberá considerarse automáticamente Preservation Package.

Cuando exista conflicto sobre Preservation, Fixity histórica o Archive Lifecycle, ENG-093 será autoritativo.

---

# 101. Relación con ENG-095

ENG-095 formaliza **Data Synchronization Engineering**.

La frontera será:

```text
ENG-094
DATA PORTABILITY
│
└── Export / Transfer / Import
    of governed portable representations.

ENG-095
DATA SYNCHRONIZATION
│
└── Maintains intended convergence
    between evolving Data states.
```

Una operación de Portability podrá inicializar un Target.

No deberá crear Synchronization continua de forma implícita.

ENG-095 deberá continuar la serie global en:

```text
EI-1846 → EI-1865
```

---

# 102. Principio Rector

> **MEF deberá considerar portable únicamente aquel Data que pueda salir de su representación de origen conservando suficiente Structure, Semantics, Metadata, Integrity, Provenance y Governance para ser interpretado y validado en otro contexto; copiar bytes fuera del sistema no constituye por sí solo Data Portability.**

---

# 103. Conclusión

**ENG-094 — Data Portability Engineering** formaliza la exportación, transferencia e importación gobernada de Data dentro de MEF.

```text
SOURCE
   │
   ▼
REQUEST / AUTHORIZATION
   │
   ▼
PORTABILITY PLAN
   │
   ▼
EXPORT
   │
   ▼
PORTABLE PACKAGE
   │
   ├── Manifest
   ├── Schema
   ├── Semantics
   ├── Metadata
   ├── Integrity
   └── Provenance
   │
   ▼
TRANSFER
   │
   ▼
IMPORT
   │
   ▼
VALIDATION / VERIFICATION
   │
   ▼
TARGET
```

Las separaciones esenciales quedan:

```text
PORTABILITY ≠ EXPORT
PORTABILITY ≠ MIGRATION
PORTABILITY ≠ SYNCHRONIZATION
PORTABILITY ≠ REPLICATION

REQUEST ≠ AUTHORIZATION

EXPORT COMPLETE ≠ TRANSFER COMPLETE
TRANSFER COMPLETE ≠ IMPORT COMPLETE
IMPORT COMPLETE ≠ VERIFIED

PORTABLE ≠ UNIVERSALLY INTEROPERABLE
FIXITY ≠ AUTHENTICITY

EXPORTABLE ≠ LEGALLY TRANSFERABLE
PORTABLE PACKAGE ≠ PRESERVATION PACKAGE
```

Con **ENG-094**, la serie global alcanza:

```text
EI-1845
```

---

# Referencias

## Ingeniería

- ENG-009 — Testing Engineering
- ENG-014 — Versioning Engineering
- ENG-016 — Compatibility Engineering
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling Engineering
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
- ENG-095 — Data Synchronization Engineering
- ENG-096 — Data Replication Engineering
- ENG-097 — Data Partitioning & Sharding Engineering
- ENG-098 — Data Distribution Engineering
- ENG-099 — Data Localization & Residency Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
