---
id: ENG-090
titulo: Data Catalog Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Catalog Engineering
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
  - ENG-087
  - ENG-088
  - ENG-089

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
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-070
  - ENG-071
  - ENG-072
  - ENG-073
  - ENG-074
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-078
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
  - data-catalog
  - catalog
  - metadata
  - data-asset
  - catalog-entry
  - ownership
  - stewardship
  - classification
  - glossary
  - discoverability
  - lineage
  - governance
  - search
  - mef
---

# ENG-090 — Data Catalog Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Catalog Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-090 establece reglas para:

```text
Data Catalog
Catalog Identity
Catalog Scope
Catalog Boundary
Catalog Contract
Catalog Policy

Catalog Entry
Catalog Asset
Asset Identity
Asset Type
Asset Version

Technical Metadata
Business Metadata
Operational Metadata
Governance Metadata
Security Metadata
Quality Metadata
Trust Metadata
Lineage Metadata

Asset Owner
Asset Steward
Asset Producer
Asset Consumer

Business Glossary
Business Term
Term Definition
Term Relationship
Semantic Association

Tag
Label
Classification
Domain
Category

Catalog Registration
Catalog Publication
Catalog Update
Catalog Synchronization
Catalog Deprecation
Catalog Retirement

Catalog Search
Catalog Browse
Catalog Filter
Catalog Facet
Catalog Ranking

Catalog Visibility
Catalog Authorization
Catalog Security
Catalog Privacy

Catalog Governance
Catalog Compliance
Catalog Ethics

Catalog Freshness
Catalog Quality
Catalog Trust
Catalog Integrity

Catalog Lineage
Catalog Discovery

Catalog Federation
External Catalog

Catalog Lifecycle

Catalog Observability
Catalog Diagnostics
Catalog Testing
```

---

# 2. Declaración

> **MEF deberá tratar el Data Catalog como una capacidad gobernada para registrar, organizar, relacionar, buscar y exponer Metadata sobre Data Assets, sin confundir visibilidad del Metadata con autorización para acceder al Data, ni Catalog Entry con el Data Asset material que describe.**

Arquitectura conceptual:

```text
DATA ASSETS
    │
    ├── Data Products
    ├── Datasets
    ├── Schemas
    ├── Pipelines
    ├── Exchanges
    ├── Federations
    └── External Sources
    │
    ▼
CATALOG REGISTRATION
    │
    ▼
DATA CATALOG
    │
    ├── Identity
    ├── Metadata
    ├── Ownership
    ├── Classification
    ├── Glossary
    ├── Quality
    ├── Trust
    ├── Lineage
    ├── Governance
    └── Lifecycle
    │
    ▼
DISCOVERY / SEARCH
    │
    ▼
AUTHORIZED CONSUMER
```

---

# 3. Data Catalog

`Data Catalog` representa una colección gobernada de Metadata y relaciones sobre Data Assets.

Podrá catalogar:

```text
datasets
tables
fields
schemas
files
streams
events
data products
pipelines
exchange contracts
federations
reports
models
external data sources
```

Catalog no deberá asumir Ownership sobre los Assets registrados.

---

# 4. Catalog ≠ Data Store

Principio obligatorio:

```text
Catalog
≠
Data Store
```

El Catalog describe Data Assets.

No deberá convertirse implícitamente en repositorio primario del Payload.

---

# 5. Catalog Entry ≠ Data Asset

```text
Catalog Entry
≠
Data Asset
```

Una Entry representa Metadata acerca de un Asset.

Eliminar una Entry no deberá implicar automáticamente eliminar el Asset.

Eliminar un Asset tampoco deberá borrar automáticamente Historical Catalog Metadata cuando exista obligación legítima de conservarlo.

---

# 6. Catalog ≠ Registry

ENG-020 será autoridad general de Registry.

```text
Registry
→ operational identity / registration / resolution support

Data Catalog
→ governed metadata / understanding / discovery
```

Una implementación podrá compartir infraestructura, pero deberá preservar responsabilidades conceptuales.

---

# 7. Catalog ≠ Discovery

ENG-058 será autoridad general de Discovery.

ENG-091 especializará Data Discovery & Classification.

```text
Catalog
≠
Discovery
```

Catalog organiza Metadata.

Discovery localiza Assets o Entries relevantes.

---

# 8. Catalog ≠ Governance

ENG-081 será autoridad sobre Data Governance.

Catalog podrá implementar y exponer Governance Metadata.

No será por sí mismo la totalidad del Governance Model.

---

# 9. Catalog Identity

Todo Catalog material deberá poseer Identity estable.

```text
DataCatalogId
```

Identity deberá permanecer diferenciada de:

```text
database name
URL
deployment
search index
UI name
```

---

# 10. Catalog Scope

Scope podrá definirse por:

```text
organization
domain
tenant
product family
environment
region
jurisdiction
asset type
```

Scope deberá ser explícito cuando afecte Visibility, Governance o Search.

---

# 11. Catalog Boundary

Boundary deberá determinar qué Assets y Metadata pueden registrarse o exponerse.

```text
Catalog Boundary
≠
Authorization Boundary necesariamente
```

---

# 12. Catalog Contract

Conceptualmente:

```text
DataCatalogContract
├── id
├── version
├── scope
├── assetTypes
├── metadataSchema
├── visibility
├── search
├── governance
├── retention
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

---

# 13. Catalog Policy

ENG-051 será autoridad general.

Policy podrá controlar:

```text
registration
publication
visibility
classification
required metadata
ownership
retention
external metadata
search exposure
```

---

# 14. Catalog Entry

Conceptualmente:

```text
CatalogEntry
├── id
├── asset
├── assetType
├── assetVersion
├── name
├── description
├── owner
├── steward
├── domain
├── classification
├── schema
├── quality
├── trust
├── lineage
├── lifecycle
└── metadata
```

---

# 15. Asset Identity

Catalog deberá preservar la Identity autoritativa del Asset.

```text
CatalogEntryId
≠
AssetId
```

Catalog no deberá generar una nueva identidad de Asset cuando ya exista una Identity autoritativa.

---

# 16. Asset Type

Asset Type deberá ser explícito.

Ejemplos:

```text
DATASET
TABLE
FIELD
SCHEMA
FILE
STREAM
EVENT
DATA_PRODUCT
PIPELINE
EXCHANGE
FEDERATION
REPORT
MODEL
EXTERNAL_SOURCE
```

---

# 17. Asset Version

ENG-014 será autoridad general de Versioning.

Catalog deberá poder distinguir Asset Versions cuando afecten Schema, Semantics, Contract, Quality o Lifecycle.

---

# 18. Metadata Categories

MEF distinguirá, cuando sean materiales:

```text
Technical Metadata
Business Metadata
Operational Metadata
Governance Metadata
Security Metadata
Quality Metadata
Trust Metadata
Lineage Metadata
```

Una categoría no deberá sustituir universalmente a las demás.

---

# 19. Technical Metadata

Podrá incluir:

```text
schema
field types
format
location reference
interface
protocol
partitioning
serialization
```

---

# 20. Business Metadata

Podrá incluir:

```text
business name
description
domain
business terms
business meaning
business owner
usage guidance
```

---

# 21. Operational Metadata

Podrá incluir:

```text
freshness
availability
last update
volume
usage
runtime state
SLO references
```

Operational Metadata no deberá confundirse con Observability Raw Data.

---

# 22. Governance Metadata

Podrá incluir:

```text
owner
steward
policy
classification
retention
jurisdiction
approval
lifecycle state
```

---

# 23. Security Metadata

Podrá incluir:

```text
sensitivity
access classification
security policy references
encryption requirements
```

Catalog no deberá exponer Secrets o Credentials.

---

# 24. Quality Metadata

ENG-080 será autoridad sobre Data Quality.

Podrá incluir:

```text
quality score
quality dimensions
quality status
last assessment
quality SLO
```

```text
Cataloged Quality Metadata
≠
Quality Guarantee automáticamente
```

---

# 25. Trust Metadata

ENG-085 será autoridad sobre Data Trust.

Podrá incluir:

```text
trust status
trust signals
attestations
evidence references
trust assessment
```

Catalog no deberá inventar Trust.

---

# 26. Lineage Metadata

ENG-089 será autoridad sobre Data Lineage & Provenance.

Catalog podrá exponer:

```text
upstream
downstream
origin
lineage coverage
provenance references
```

```text
Catalog Lineage View
≠
Lineage Authority
```

---

# 27. Ownership y Stewardship

Catalog deberá diferenciar:

```text
Owner
Steward
Producer
Consumer
```

```text
Owner ≠ Steward
Producer ≠ Owner necesariamente
Consumer ≠ Owner
```

---

# 28. Business Glossary

Catalog podrá integrar un Business Glossary.

Conceptualmente:

```text
BusinessGlossary
└── BusinessTerm
    ├── id
    ├── name
    ├── definition
    ├── domain
    ├── owner
    ├── synonyms
    └── relationships
```

---

# 29. Business Term

Business Term deberá poseer Definition suficientemente precisa.

Term no deberá derivarse automáticamente de Field Name cuando exista significado de negocio diferente.

```text
Field Name
≠
Business Meaning
```

---

# 30. Semantic Association

Assets podrán asociarse a Business Terms.

Ejemplo:

```text
customer_birth_date
        │
        ▼
Business Term: Date of Birth
```

La asociación deberá poder versionarse cuando cambie significado.

---

# 31. Tags, Labels y Classification

Tags y Labels podrán ayudar a organización.

Classification deberá obedecer ENG-091 cuando represente Data Classification.

```text
Tag
≠
Authoritative Classification necesariamente
```

---

# 32. Domain y Category

Assets podrán agruparse por Domain y Category.

La agrupación deberá permanecer diferenciada de Ownership y Authorization.

---

# 33. Catalog Registration

Registration deberá validar Metadata mínima requerida.

Podrá originarse desde:

```text
manual registration
build-time registration
runtime registration
metadata ingestion
external catalog import
data product publication
pipeline publication
```

---

# 34. Catalog Publication

Publication hace visible una Entry dentro de un Scope autorizado.

```text
Registered
≠
Published
```

Una Entry podrá existir sin estar publicada.

---

# 35. Catalog Update

Update deberá preservar:

```text
asset identity
version semantics
ownership
history
auditability
```

---

# 36. Catalog Synchronization

Catalog podrá sincronizar Metadata con Sources externas.

ENG-095 seguirá siendo autoridad general de Data Synchronization cuando corresponda.

```text
Metadata Synchronization
≠
Payload Synchronization
```

---

# 37. Catalog Deprecation

Entry podrá marcarse:

```text
DEPRECATED
```

sin eliminar inmediatamente Historical Metadata.

---

# 38. Catalog Retirement

Retirement deberá distinguir:

```text
catalog entry retirement
asset retirement
```

Uno no deberá implicar automáticamente el otro.

---

# 39. Catalog Lifecycle

Podrá utilizar:

```text
DRAFT
REGISTERED
VALIDATING
PUBLISHED
DEPRECATED
RETIRED
```

ENG-055 será autoridad general de Lifecycle.

---

# 40. Catalog Search

Search deberá operar sobre Metadata autorizada.

Podrá considerar:

```text
name
description
business term
domain
owner
asset type
classification
tag
schema
quality
trust
```

---

# 41. Browse, Filter y Facet

Catalog podrá proporcionar:

```text
browse
filter
facet
sort
ranking
```

Estas capacidades no deberán modificar Authorization.

---

# 42. Search Ranking

Ranking podrá considerar:

```text
text relevance
metadata completeness
quality
trust
freshness
usage
domain relevance
```

Ranking deberá permanecer explicable cuando afecte decisiones materiales.

---

# 43. Catalog Visibility

Visibility define qué Metadata puede observar un Consumer.

Podrá ser:

```text
PUBLIC
ORGANIZATION
DOMAIN
TENANT
RESTRICTED
PRIVATE
```

---

# 44. Visibility ≠ Data Authorization

Principio crítico:

```text
Catalog Visibility
≠
Data Access Authorization
```

Encontrar o visualizar una Entry no deberá otorgar acceso al Data Asset.

---

# 45. Catalog Authorization

ENG-046 será autoridad general.

Authorization podrá aplicarse a:

```text
catalog
entry
metadata field
lineage view
business glossary
administrative operation
```

---

# 46. Multi-Tenancy

ENG-048 será autoridad.

Tenant Context deberá preservarse en:

```text
registration
publication
search
browse
lineage view
administration
```

Search no deberá producir Metadata Leakage Cross-Tenant.

---

# 47. Catalog Security

ENG-024 será autoridad general.

Catalog deberá proteger Metadata sensible.

Especial cuidado con:

```text
physical locations
internal endpoints
security classifications
consumer relationships
lineage topology
personal metadata
```

---

# 48. Catalog Privacy

ENG-082 será autoridad.

Catalog deberá aplicar minimización.

No deberá indexar Personal Data del Payload como Metadata salvo Requirement explícito y autorizado.

---

# 49. Catalog Governance

ENG-081 será autoridad.

Catalog deberá poder hacer visibles:

```text
ownership
stewardship
classification
policies
quality
retention
lineage
lifecycle
```

sin convertirse en autoridad primaria de todos esos conceptos.

---

# 50. Catalog Compliance

ENG-083 será autoridad.

Catalog podrá apoyar Compliance mediante Metadata y Evidence references.

```text
Catalog Presence
≠
Compliance Proof
```

---

# 51. Catalog Ethics

ENG-084 será autoridad.

Search, Ranking y Classification no deberán utilizarse para evadir restricciones éticas aplicables.

---

# 52. Catalog Integrity

ENG-079 será autoridad general.

Catalog deberá proteger:

```text
asset identity mapping
ownership
classification
version
lineage references
governance metadata
```

contra alteración no autorizada.

---

# 53. Catalog Quality

Catalog Quality podrá considerar:

```text
metadata completeness
metadata accuracy
freshness
consistency
coverage
validity
```

```text
Catalog Quality
≠
Asset Data Quality
```

---

# 54. Catalog Trust

Catalog Trust podrá considerar:

```text
metadata source
verification
ownership
freshness
integrity
evidence
```

```text
Trusted Catalog Entry
≠
Trusted Data Asset automáticamente
```

---

# 55. Catalog Freshness

Catalog deberá distinguir:

```text
metadata freshness
asset freshness
```

Una Entry recientemente actualizada no demuestra que el Data Asset esté fresco.

---

# 56. Catalog Discovery

ENG-058 será autoridad general de Discovery.

ENG-091 especializará Data Discovery & Classification.

Catalog deberá exponer Metadata suficiente para Discovery sin redefinir Search Authorization.

---

# 57. Catalog Federation

Podrán existir múltiples Catalogs coordinados.

```text
LOCAL CATALOG A ──┐
                  ├──► FEDERATED CATALOG VIEW
LOCAL CATALOG B ──┤
                  │
EXTERNAL CATALOG ─┘
```

Catalog Federation no deberá eliminar Source Catalog Identity.

---

# 58. External Catalog

Metadata importada deberá conservar:

```text
source catalog
source identity
capture time
mapping
trust
boundary
```

```text
Imported Metadata
≠
Locally Verified Metadata
```

---

# 59. Catalog Lineage

Changes materiales en Catalog Metadata podrán poseer historial.

Catalog Metadata Lineage deberá permanecer diferenciada de Data Lineage del Asset.

---

# 60. Retention

Catalog Metadata Retention podrá diferir de Asset Retention.

ENG-092 será autoridad sobre Retention & Disposal.

Historical Catalog Metadata podrá conservarse cuando Governance o Compliance lo requieran.

---

# 61. Archival

ENG-093 será autoridad sobre Archival & Preservation.

Catalog History podrá archivarse preservando Identity y Version.

---

# 62. Portability

ENG-094 será autoridad sobre Data Portability.

Catalog Metadata podrá ser exportable en formatos gobernados cuando Contract lo permita.

---

# 63. Localization & Residency

ENG-099 será autoridad.

Catalog Metadata también podrá estar sujeta a Localization y Residency.

---

# 64. Lifecycle Orchestration

ENG-100 podrá utilizar Catalog Metadata para identificar:

```text
owner
dependencies
classification
retention
location
lifecycle state
```

antes de ejecutar Lifecycle Actions.

---

# 65. Observability

ENG-025 será autoridad general.

Metrics podrán incluir:

```text
mef.data_catalog.entry.total
mef.data_catalog.entry.registered.total
mef.data_catalog.entry.published.total
mef.data_catalog.entry.deprecated.total
mef.data_catalog.search.total
mef.data_catalog.search.duration
mef.data_catalog.search.empty.total
mef.data_catalog.metadata.validation.failed.total
mef.data_catalog.metadata.freshness.age
mef.data_catalog.metadata.coverage.ratio
mef.data_catalog.authorization.denied.total
mef.data_catalog.external.import.total
```

---

# 66. Metric Labels

Podrán incluir:

```text
assetType
state
result
failureType
visibility
sourceType
```

con Cardinality controlada.

AssetId, OwnerId o SearchQuery no deberán utilizarse indiscriminadamente como Metric Labels.

---

# 67. Catalog Logging

Logging deberá evitar:

```text
credentials
secrets
raw personal data
sensitive search terms
unauthorized metadata
```

---

# 68. Catalog Diagnostics

Deberá poder responder:

```text
which catalog?
which entry?
which asset?
which asset version?
which asset type?
which owner?
which steward?
which domain?
which classification?
which metadata source?
which glossary terms?
which quality?
which trust?
which lineage?
which visibility?
which tenant?
which policy?
which lifecycle state?
when was metadata refreshed?
```

---

# 69. Modelos Conceptuales

```text
DataCatalog
├── id
├── scope
├── boundary
├── contract
├── policy
├── state
└── metadata
```

```text
CatalogEntry
├── id
├── assetId
├── assetType
├── assetVersion
├── name
├── description
├── owner
├── steward
├── domain
├── classification
├── terms
├── quality
├── trust
├── lineage
├── visibility
├── state
└── metadata
```

```text
BusinessTerm
├── id
├── name
├── definition
├── domain
├── owner
├── synonyms
└── relationships
```

---

# 70. Catalog Runtime

Conceptualmente:

```text
DataCatalogRuntime
├── register
├── validate
├── publish
├── update
├── search
├── browse
├── resolve
├── deprecate
├── retire
├── observe
└── diagnose
```

---

# 71. Registry Integration

ENG-020 podrá registrar:

```text
catalogs
catalog entry types
metadata schemas
glossaries
catalog providers
```

Catalog no deberá reemplazar Registry para Resolution operacional cuando Registry sea autoridad.

---

# 72. Metadata Integration

ENG-057 será autoridad general de Metadata.

ENG-090 especializa organización y exposición de Metadata para Data Assets.

```text
ENG-057
Metadata primitives / semantics

ENG-090
Data Catalog organization / publication / search
```

---

# 73. Schema Integration

ENG-062 será autoridad sobre Schema.

Catalog podrá almacenar referencias o representaciones de Schema.

Catalog no deberá redefinir Schema Compatibility.

---

# 74. Data Product Integration

ENG-086 podrá publicar Data Products en Catalog.

Catalog deberá preservar:

```text
product identity
product version
owner
contract
access points
quality
trust
lifecycle
```

Catalog Entry no reemplaza Product Contract.

---

# 75. Exchange Integration

ENG-087 podrá registrar Exchange Metadata autorizada.

Catalog Visibility no deberá otorgar Exchange Authorization.

---

# 76. Federation Integration

ENG-088 podrá registrar:

```text
federation
logical schema
sources
capabilities
owner
```

sin exponer Source Details restringidos.

---

# 77. Lineage Integration

ENG-089 será autoridad.

Catalog podrá presentar Upstream y Downstream Views autorizadas.

No deberá reconstruir o inventar Lineage ausente.

---

# 78. Discovery & Classification Integration

ENG-091 será autoridad sobre Data Discovery & Classification.

La frontera será:

```text
ENG-090
DATA CATALOG
│
└── Organizes and exposes governed
    metadata about known assets.

ENG-091
DATA DISCOVERY & CLASSIFICATION
│
└── Finds, identifies and classifies
    data/assets using explicit rules
    and evidence.
```

---

# 79. Validation

ENG-036 podrá validar:

```text
catalog identity
entry identity
asset reference
asset type
metadata schema
required metadata
classification
visibility
business terms
lifecycle state
```

---

# 80. Testing

ENG-009 será autoridad general.

Deberán existir pruebas para:

```text
catalog identity
entry identity
asset identity mapping
asset versioning
metadata validation
ownership
stewardship
business glossary
semantic associations
registration
publication
update
deprecation
retirement
search
filter
facet
ranking
visibility
authorization
tenant isolation
security
privacy
quality metadata
trust metadata
lineage metadata
external catalog import
retention
```

---

# 81. Architecture Test

Podrá impedir:

```text
catalog treated as data store
catalog entry treated as data asset
catalog treated as registry universally
catalog treated as discovery universally
catalog treated as governance
catalog entry id treated as asset id
field name treated as business meaning
tag treated as authoritative classification
registered treated as published
metadata synchronization treated as payload synchronization
catalog entry retirement treated as asset retirement
catalog visibility treated as data authorization
catalog presence treated as compliance proof
catalog quality treated as asset data quality
trusted catalog entry treated as trusted asset
metadata freshness treated as asset freshness
imported metadata treated as locally verified metadata
catalog metadata lineage treated as asset data lineage
```

---

# 82. Build Integration

ENG-012 podrá validar:

```text
catalog contracts
metadata schemas
required ownership
required classification
visibility rules
business glossary references
quality metadata requirements
trust metadata requirements
lineage requirements
```

---

# 83. CLI

ENG-007 podrá proporcionar:

```text
mef data-catalog
mef data-catalog:list
mef data-catalog:show
mef data-catalog:register
mef data-catalog:validate
mef data-catalog:publish
mef data-catalog:search
mef data-catalog:terms
mef data-catalog:lineage
mef data-catalog:diagnose
```

---

# 84. Error Namespace

ENG-090 utilizará:

```text
MEF-DATA-CATALOG-xxx
```

Taxonomía inicial:

```text
MEF-DATA-CATALOG-001 Catalog identifier invalid
MEF-DATA-CATALOG-002 Catalog contract invalid
MEF-DATA-CATALOG-003 Catalog boundary invalid
MEF-DATA-CATALOG-004 Catalog entry invalid
MEF-DATA-CATALOG-005 Asset reference invalid
MEF-DATA-CATALOG-006 Asset type invalid
MEF-DATA-CATALOG-007 Asset version invalid
MEF-DATA-CATALOG-008 Metadata schema invalid
MEF-DATA-CATALOG-009 Required metadata missing
MEF-DATA-CATALOG-010 Owner missing
MEF-DATA-CATALOG-011 Steward invalid
MEF-DATA-CATALOG-012 Business term invalid
MEF-DATA-CATALOG-013 Semantic association invalid
MEF-DATA-CATALOG-014 Classification invalid
MEF-DATA-CATALOG-015 Catalog publication denied
MEF-DATA-CATALOG-016 Catalog authorization denied
MEF-DATA-CATALOG-017 Catalog tenant violation
MEF-DATA-CATALOG-018 Catalog privacy violation
MEF-DATA-CATALOG-019 Catalog integrity violation
MEF-DATA-CATALOG-020 Catalog search failed
MEF-DATA-CATALOG-021 Catalog external import failed
MEF-DATA-CATALOG-022 Catalog metadata stale
MEF-DATA-CATALOG-023 Catalog lineage unavailable
MEF-DATA-CATALOG-024 Catalog quality metadata invalid
MEF-DATA-CATALOG-025 Catalog trust metadata invalid
MEF-DATA-CATALOG-026 Catalog retention violation
MEF-DATA-CATALOG-027 Catalog lifecycle invalid
MEF-DATA-CATALOG-028 Catalog synchronization failed
MEF-DATA-CATALOG-029 Catalog state invalid
MEF-DATA-CATALOG-030 Catalog invariant violation
```

---

# 85. First Implementation Components

La primera implementación deberá incluir:

```text
DataCatalogId
CatalogEntryId
DataCatalog
DataCatalogContract
CatalogEntry
CatalogAssetType
CatalogMetadata
CatalogVisibility
CatalogState
BusinessGlossary
BusinessTerm
CatalogSearch
DataCatalogRuntime
DataCatalogError
```

---

# 86. Optional Initial Components

Podrán incorporarse:

```text
CatalogPolicy
CatalogRegistry
CatalogDiagnostics
CatalogQuality
CatalogFederation
ExternalCatalogAdapter
```

---

# 87. Later Components

Solo cuando exista necesidad demostrada:

```text
Semantic Knowledge Graph
Automatic Metadata Enrichment
Global Cross-Organization Catalog
Behavior-Based Ranking
AI-Assisted Catalog Curation
AI-Assisted Business Glossary
```

---

# 88. Estructura Conceptual

```text
src/
└── DataCatalog/
    ├── Identity/
    │   ├── DataCatalogId
    │   └── CatalogEntryId
    ├── Catalog/
    │   └── DataCatalog
    ├── Contract/
    │   └── DataCatalogContract
    ├── Entry/
    │   ├── CatalogEntry
    │   └── CatalogAssetType
    ├── Metadata/
    │   └── CatalogMetadata
    ├── Visibility/
    │   └── CatalogVisibility
    ├── Glossary/
    │   ├── BusinessGlossary
    │   └── BusinessTerm
    ├── Search/
    │   └── CatalogSearch
    ├── State/
    │   └── CatalogState
    ├── Runtime/
    │   └── DataCatalogRuntime
    ├── Diagnostics/
    │   └── DataCatalogDiagnostics
    └── Error/
        └── DataCatalogError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 89. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Catalog Identity
Explicit Entry Identity
Authoritative Asset Identity
Explicit Asset Type
Asset Version
Metadata Schema
Ownership
Stewardship
Business Glossary
Classification References
Registration
Publication
Search
Visibility
Authorization
Tenant Isolation
Quality Metadata
Trust Metadata
Lineage References
Lifecycle
Observability
Testing
```

---

# 90. First Version Non-Goals

No deberá requerir inicialmente:

```text
Universal Enterprise Knowledge Graph
Automatic Complete Metadata Inference
Global Cross-Organization Catalog
Universal Semantic Reconciliation
Behavior-Based Personalized Ranking
AI-Assisted Catalog Curation
```

---

# 91. Invariantes de Ingeniería

ENG-090 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1746 | Todo Data Catalog material deberá poseer Identity, Scope, Boundary, Contract, Metadata Schema, Asset Types, Visibility y Lifecycle suficientes para que su comportamiento no dependa de conocimiento implícito. |
| EI-1747 | Data Catalog, Data Store, Registry, Discovery y Data Governance deberán permanecer diferenciados y Catalog no deberá convertirse en autoridad universal sobre Payload, Resolution, Discovery o Governance. |
| EI-1748 | Catalog Entry Identity y Asset Identity deberán permanecer diferenciadas y Catalog no deberá reemplazar una Asset Identity autoritativa por una identidad local de Entry. |
| EI-1749 | Catalog Entry y Data Asset deberán permanecer diferenciados y creación, actualización, deprecación, retiro o eliminación de una Entry no deberán alterar automáticamente el Lifecycle del Asset material. |
| EI-1750 | Technical, Business, Operational, Governance, Security, Quality, Trust y Lineage Metadata deberán conservar Semantics diferenciadas y ninguna categoría deberá sustituir universalmente a las demás. |
| EI-1751 | Owner, Steward, Producer y Consumer deberán permanecer diferenciados y Catalog no deberá inferir Ownership exclusivamente a partir de Production, Consumption o ubicación técnica. |
| EI-1752 | Business Term, Field Name, Tag, Label y Authoritative Classification deberán permanecer diferenciados y similitud textual no deberá utilizarse como equivalencia semántica automática. |
| EI-1753 | Catalog Registration y Publication deberán permanecer diferenciados y una Entry registrada no deberá hacerse visible fuera de su Scope sin Policy y Authorization aplicables. |
| EI-1754 | Catalog Search, Browse, Filter, Facet y Ranking deberán operar únicamente sobre Metadata visible para el Consumer y ninguna optimización de Search deberá producir Metadata Leakage. |
| EI-1755 | Catalog Visibility y Data Access Authorization deberán permanecer diferenciadas y descubrir o visualizar Metadata de un Asset no deberá otorgar derecho a consultar, descargar, intercambiar o modificar su Data. |
| EI-1756 | Tenant Context deberá preservarse durante Registration, Publication, Search, Browse, Lineage View y Administration y Catalog no deberá producir Cross-Tenant Metadata Leakage. |
| EI-1757 | Catalog Security, Privacy, Governance, Compliance y Ethics deberán aplicarse al Metadata y Search Surface y Catalog no deberá indexar Secrets, Credentials o Payload Personal Data innecesario. |
| EI-1758 | Catalog Quality, Asset Data Quality, Catalog Trust y Asset Trust deberán permanecer diferenciados y Metadata de alta calidad o una Entry confiable no deberán presentarse automáticamente como garantía de calidad o confianza del Asset. |
| EI-1759 | Metadata Freshness y Asset Freshness deberán permanecer diferenciadas y una actualización reciente del Catalog no deberá utilizarse como prueba de actualidad del Payload. |
| EI-1760 | Catalog Lineage View y Data Lineage Authority deberán permanecer diferenciadas y ENG-090 no deberá inventar, reconstruir o modificar Provenance que corresponda a ENG-089. |
| EI-1761 | Metadata importada desde External Catalog deberá preservar Source, Identity, Capture Time, Mapping, Boundary y Trust suficientes y no deberá presentarse como Locally Verified Metadata sin verificación explícita. |
| EI-1762 | Catalog Federation deberá preservar Source Catalog Identity, Authorization y Tenant Boundaries y una vista federada no deberá borrar el origen o autoridad de Metadata participante. |
| EI-1763 | Catalog Metadata Retention, Asset Retention y Historical Metadata deberán evaluarse separadamente y Disposal o Retirement de uno no deberá implicar automáticamente eliminación de los demás. |
| EI-1764 | Catalog Observability, Diagnostics y Testing deberán permitir reconstruir Catalog, Entry, Asset, Version, Owner, Steward, Domain, Classification, Metadata Source, Quality, Trust, Lineage, Visibility, Tenant, Policy, Lifecycle y Freshness sin exponer Metadata restringida innecesariamente. |
| EI-1765 | La primera implementación deberá priorizar Catalog/Entry Identity, Authoritative Asset Identity, Metadata Schema, Asset Type/Version, Ownership, Stewardship, Glossary, Registration, Publication, Search, Visibility, Authorization, Tenant Isolation, Quality/Trust/Lineage Metadata, Lifecycle, Observability y Testing antes de introducir Knowledge Graph, Automatic Enrichment o AI-Assisted Catalog Curation. |

---

# 92. Continuidad de Invariantes

```text
ENG-086 → EI-1666 a EI-1685
ENG-087 → EI-1686 a EI-1705
ENG-088 → EI-1706 a EI-1725
ENG-089 → EI-1726 a EI-1745
ENG-090 → EI-1746 a EI-1765
```

---

# 93. Criterios de Conformidad

Una implementación será conforme con ENG-090 cuando:

- modele Catalog Identity, Scope y Boundary;
- diferencie Catalog Entry y Data Asset;
- preserve Authoritative Asset Identity;
- modele Asset Type y Version;
- valide Metadata Schema;
- diferencie categorías de Metadata;
- modele Owner y Steward;
- implemente Business Glossary y Business Terms;
- diferencie Tags y Classification;
- implemente Registration y Publication;
- implemente Search, Browse y Filter;
- preserve Visibility y Authorization;
- preserve Tenant Isolation;
- aplique Security y Privacy;
- integre Quality, Trust y Lineage Metadata sin asumir su autoridad;
- preserve Metadata Source en External Catalog;
- implemente Lifecycle y Retention;
- implemente Observability, Diagnostics y Testing.

---

# 94. Riesgos

Deberán evitarse especialmente:

```text
Catalog Equals Data Store
Catalog Entry Equals Data Asset
Catalog Equals Registry
Catalog Equals Discovery
Catalog Equals Governance

CatalogEntryId Equals AssetId

Field Name Equals Business Meaning
Tag Equals Authoritative Classification

Registered Equals Published

Catalog Visibility Equals Data Authorization

Catalog Presence Equals Compliance Proof

Catalog Quality Equals Asset Quality
Catalog Trust Equals Asset Trust
Metadata Freshness Equals Asset Freshness

Catalog Lineage View Equals Lineage Authority

Imported Metadata Equals Locally Verified Metadata

Catalog Federation Loses Source Identity

Catalog Entry Retirement Equals Asset Retirement
Metadata Retention Equals Asset Retention

Cross-Tenant Metadata Leakage
```

---

# 95. Relación con ENG-089

ENG-089 gobierna Data Lineage & Provenance.

```text
ENG-089
LINEAGE & PROVENANCE
│
└── Explains Data history,
    origin and dependency.

ENG-090
DATA CATALOG
│
└── Organizes and exposes governed
    metadata about Data assets.
```

ENG-090 podrá presentar Lineage autorizado, pero ENG-089 seguirá siendo autoritativo sobre Lineage Semantics y Provenance.

---

# 96. Relación con ENG-091

ENG-091 formaliza **Data Discovery & Classification Engineering**.

```text
ENG-090
DATA CATALOG
│
└── What known Data Assets and
    Metadata are organized and exposed?

ENG-091
DATA DISCOVERY & CLASSIFICATION
│
└── How are Data Assets found,
    identified and classified?
```

ENG-091 podrá alimentar nuevas Entries o Classification Metadata al Catalog.

ENG-090 seguirá siendo autoritativo sobre Catalog Structure, Publication, Search Surface y Catalog Lifecycle.

---

# 97. Principio Rector

> **MEF deberá catalogar Data sin confundir conocimiento con permiso: el Catalog deberá explicar qué Assets existen, qué significan, quién responde por ellos, cómo se clasifican, qué calidad, confianza y lineage conocidos poseen y cómo encontrarlos, preservando siempre la separación entre Metadata Visibility y Data Authorization.**

---

# 98. Conclusión

**ENG-090 — Data Catalog Engineering** formaliza el sistema gobernado de Metadata para Data Assets dentro de MEF.

```text
DATA ASSET
    │
    ▼
CATALOG ENTRY
    │
    ├── Identity
    ├── Version
    ├── Metadata
    ├── Owner
    ├── Steward
    ├── Glossary
    ├── Classification
    ├── Quality
    ├── Trust
    ├── Lineage
    ├── Visibility
    └── Lifecycle
    │
    ▼
CATALOG SEARCH
    │
    ▼
DISCOVERY
    │
    ▼
AUTHORIZED CONSUMER
```

Las separaciones esenciales quedan:

```text
CATALOG ≠ DATA STORE
CATALOG ≠ REGISTRY
CATALOG ≠ DISCOVERY
CATALOG ≠ GOVERNANCE

CATALOG ENTRY ≠ DATA ASSET
CATALOG ENTRY ID ≠ ASSET ID

REGISTERED ≠ PUBLISHED

FIELD NAME ≠ BUSINESS MEANING
TAG ≠ AUTHORITATIVE CLASSIFICATION

CATALOG VISIBILITY ≠ DATA AUTHORIZATION

CATALOG QUALITY ≠ ASSET QUALITY
CATALOG TRUST ≠ ASSET TRUST
METADATA FRESHNESS ≠ ASSET FRESHNESS

CATALOG LINEAGE VIEW ≠ LINEAGE AUTHORITY
```

Con **ENG-090**, la serie global alcanza:

```text
EI-1765
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
