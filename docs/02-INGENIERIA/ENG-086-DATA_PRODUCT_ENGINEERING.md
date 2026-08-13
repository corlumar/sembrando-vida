---
id: ENG-086
titulo: Data Product Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Product Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11

dependencias:
  - ENG-000
  - ENG-005
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
  - ENG-033
  - ENG-036
  - ENG-043
  - ENG-046
  - ENG-048
  - ENG-051
  - ENG-053
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-058
  - ENG-059
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
  - ENG-084
  - ENG-085

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-027
  - ENG-034
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-054
  - ENG-060
  - ENG-065
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-071
  - ENG-072
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-087

keywords:
  - data-product
  - data-as-a-product
  - data-contract
  - product-owner
  - producer
  - consumer
  - data-interface
  - data-quality
  - data-trust
  - freshness
  - availability
  - discoverability
  - lineage
  - publication
  - subscription
  - consumption
  - lifecycle
  - mef
---

# ENG-086 — Data Product Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Product Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-086 establece las reglas para:

```text
Data Product
Data Product Requirement
Data Product Contract
Data Product Policy
Data Product Identity
Data Product Version
Data Product Owner
Data Product Producer
Data Product Consumer
Data Product Boundary
Data Product Interface
Data Product Access Point
Data Product Schema
Data Product Semantics
Data Product Quality
Data Product Trust
Data Product Freshness
Data Product Availability
Data Product Reliability
Data Product SLI
Data Product SLO
Data Product Discoverability
Data Product Documentation
Data Product Metadata
Data Product Lineage
Data Product Provenance
Data Product Security
Data Product Privacy
Data Product Governance
Data Product Compliance
Data Product Ethics
Data Product Publication
Data Product Subscription
Data Product Consumption
Data Product Compatibility
Data Product Evolution
Data Product Deprecation
Data Product Retirement
Data Product Lifecycle
Data Product Dependency
Data Product Incident
Data Product Observability
Data Product Testing
```

---

# 2. Declaración

> **MEF deberá tratar un Data Product como una unidad de Data explícitamente gobernada, identificable, versionada, documentada, consumible y operable, con Owner, Contract, Quality, Trust, Access, Lifecycle y SLO suficientes para que sus Consumers conozcan qué reciben, bajo qué garantías y con qué responsabilidades.**

```text
SOURCE / DOMAIN
      │
      ▼
PRODUCER
      │
      ▼
DATA PRODUCT
      │
      ├── Identity
      ├── Contract
      ├── Schema
      ├── Semantics
      ├── Quality
      ├── Trust
      ├── Freshness
      ├── SLO
      ├── Security
      ├── Governance
      └── Documentation
      │
      ▼
ACCESS POINT
      │
      ▼
CONSUMER
```

---

# 3. Data Product

`Data Product` representa Data ofrecido como una capacidad consumible y gobernada.

No deberá tratarse únicamente como:

```text
table
file
database
topic
API
dashboard
dataset
```

aunque cualquiera de esos mecanismos pueda formar parte de su implementación.

---

# 4. Fronteras conceptuales

```text
Data Product ≠ Dataset
Data Product ≠ Data Source
Data Product ≠ API
Data Product ≠ Pipeline
Data Product ≠ Report
```

Un Dataset puede convertirse en Data Product, pero requiere responsabilidades, contratos y garantías operacionales explícitas.

ENG-064 gobierna Data Pipeline.

---

# 5. Data Product Requirement

Todo Requirement material deberá poder declarar:

```text
purpose
scope
owner
producer
consumers
contract
interface
schema
semantics
quality
freshness
availability
security
privacy
governance
lifecycle
```

---

# 6. Data Product Contract

Conceptualmente:

```text
DataProductContract
├── id
├── version
├── product
├── schema
├── semantics
├── interfaces
├── quality
├── freshness
├── availability
├── compatibility
├── security
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

ENG-086 especializa Contract Semantics para Data Products.

---

# 7. Data Product Identity y Version

Todo Data Product deberá poseer Identity estable:

```text
DataProductId
```

Identity deberá permanecer diferenciada de:

```text
Name
Dataset Name
Storage Location
Access Point
```

Todo cambio material deberá poder asociarse a una Version.

ENG-014 será autoridad general de Versioning.

```text
Product Version
≠
Schema Version necesariamente
```

Un Product puede cambiar Quality, Semantics, Freshness o SLO sin alterar Schema.

---

# 8. Product Owner, Producer y Consumer

Toda instancia material deberá tener Owner explícito.

Responsabilidades posibles:

```text
contract
quality
documentation
access
lifecycle
deprecation
consumer communication
```

Principios:

```text
Owner ≠ Producer necesariamente
Owner ≠ Steward necesariamente
Producer ≠ Source automáticamente
Consumer ≠ Subscriber necesariamente
```

Consumer Identity deberá ser explícita cuando Security, SLO o Usage Policy lo requieran.

---

# 9. Data Product Boundary

Define qué forma parte del Product y qué queda fuera.

Podrá incluir:

```text
data
schema
interface
metadata
documentation
quality guarantees
SLI/SLO
lifecycle
```

```text
Product Boundary
≠
Storage Boundary
```

---

# 10. Interface y Access Point

ENG-033 será autoridad general sobre Interfaces.

Tipos posibles:

```text
API
SQL
file
object storage
stream
event
query endpoint
federated interface
```

```text
Interface
≠
Product
```

Access Point representa ubicación o mecanismo concreto de acceso:

```text
DataProductAccessPoint
├── id
├── type
├── endpoint
├── protocol
├── contract
├── authorization
└── state
```

Un Product podrá poseer múltiples Access Points.

```text
Access Point
≠
Independent Product
```

---

# 11. Schema y Semantics

ENG-062 será autoridad sobre Schema Engineering.

Todo Product estructurado deberá exponer Schema suficiente para permitir Consumption reproducible.

```text
Schema
≠
Semantics
```

Semantics podrá incluir:

```text
business meaning
units
enumerations
relationships
calculation rules
time semantics
null semantics
aggregation semantics
```

```text
Schema Compatible
≠
Semantically Compatible
```

---

# 12. Data Product Quality

ENG-080 será autoridad general sobre Data Quality.

Quality Dimensions podrán incluir:

```text
accuracy
completeness
consistency
validity
uniqueness
timeliness
freshness
```

Todo Quality Requirement contractual deberá ser medible.

Product Quality podrá incluir además:

```text
documentation
availability
discoverability
stability
supportability
```

```text
Quality Score
≠
Product Contract
```

Quality Gate podrá impedir Publication.

Quality Failure no deberá ocultarse.

---

# 13. Data Product Trust

ENG-085 será autoridad general sobre Data Trust.

Trust Inputs podrán incluir:

```text
source trust
quality
lineage
provenance
owner
verification
attestation
security
```

```text
Trusted Product ≠ Correct Product
Trusted Product ≠ High Quality Product automáticamente
```

---

# 14. Freshness

Freshness representa actualidad del Data.

Podrá expresarse mediante:

```text
maximum age
maximum lag
update frequency
watermark
effective timestamp
```

```text
Freshness ≠ Availability
Freshness ≠ Timeliness exactamente
```

Un Product stale puede continuar disponible.

```text
Stale ≠ Invalid siempre
```

La validez dependerá del Contract.

---

# 15. Availability y Reliability

ENG-073 será autoridad general de Availability.

Availability Requirement podrá definir:

```text
availability percentage
service window
regional availability
access-point availability
```

```text
Product Availability
≠
Source Availability
```

ENG-074 será autoridad general de Reliability.

Reliability Requirement podrá incluir:

```text
successful refresh
successful publication
consistent delivery
recovery
dependency behavior
```

---

# 16. Data Product SLI y SLO

SLI representa un indicador medible.

Ejemplos:

```text
freshness_seconds
quality_score
availability_ratio
successful_refresh_ratio
schema_compatibility_ratio
```

SLO representa un objetivo contractual u operacional.

Ejemplos:

```text
99.9% access availability
95% of records available within 10 minutes of source event
quality score >= 0.98
```

```text
SLO ≠ SLA
```

---

# 17. Discoverability y Documentation

Un Product deberá poder localizarse por Consumers autorizados.

```text
Discoverable ≠ Public
Discoverable ≠ Authorized
```

Todo Product material deberá documentar:

```text
purpose
owner
consumer use
schema
semantics
access
quality
freshness
SLO
security
limitations
lifecycle
```

```text
Documentation ≠ Contract
```

Documentation deberá mantenerse alineada con Product Version.

---

# 18. Metadata

ENG-057 será autoridad general.

Product Metadata podrá incluir:

```text
id
name
version
owner
producer
domain
classification
schema
access points
quality
freshness
lifecycle
```

```text
Metadata ≠ Product Payload
```

---

# 19. Lineage y Provenance

ENG-089 será autoridad sobre Data Lineage & Provenance Engineering.

Todo Product deberá poder declarar Sources y Transformations relevantes cuando Contract o Governance lo requieran.

```text
Lineage ≠ Provenance
```

Provenance deberá preservar origen verificable cuando Contract, Trust, Governance o Compliance lo requieran.

No deberá utilizarse como prueba automática de Correctness.

---

# 20. Security

ENG-024 será autoridad general.

Security Requirements podrán incluir:

```text
authentication
authorization
encryption
integrity
tenant isolation
classification
audit
```

Cada Access Point deberá respetar Product Security Contract.

```text
Secure Storage ≠ Secure Product
```

---

# 21. Privacy, Governance, Compliance y Ethics

Las autoridades serán:

```text
Privacy     → ENG-082
Governance  → ENG-081
Compliance  → ENG-083
Ethics      → ENG-084
```

Privacy Requirement podrá restringir:

```text
fields
consumers
purpose
location
retention
export
aggregation
```

```text
Privacy ≠ Security
```

Product Ownership deberá estar registrado.

Un Product sin Owner no deberá considerarse Production-ready.

Ethical Constraints podrán limitar Publication o Consumption aunque el acceso técnico sea posible.

---

# 22. Publication

Publication representa hacer Product disponible conforme a su Contract.

Publication Preconditions podrán incluir:

```text
owner assigned
contract valid
schema valid
quality gate passed
security configured
documentation available
lifecycle active
```

```text
Publication ≠ Public Access
Published ≠ Subscribed
```

---

# 23. Data Product State

Podrá utilizarse:

```text
DRAFT
VALIDATING
PUBLISHED
DEGRADED
DEPRECATED
RETIRED
SUSPENDED
```

Semántica:

```text
DRAFT       → Contract todavía no estable
VALIDATING  → evaluando Preconditions
PUBLISHED   → disponible conforme Contract
DEGRADED    → garantías por debajo de objetivo
DEPRECATED  → disponible temporalmente antes de retiro
RETIRED     → no acepta Consumption normal
SUSPENDED   → Publication/Consumption temporalmente suspendida
```

---

# 24. Subscription y Consumption

Subscription representa relación explícita de consumo continuo.

Podrá incluir:

```text
consumer
product
version
access point
purpose
SLO
start
state
```

```text
Subscription ≠ Authorization
Subscription ≠ Delivery
```

Consumption representa uso autorizado del Product.

```text
Consumption ≠ Ownership Transfer
```

Consumption Policy podrá limitar:

```text
purpose
rate
scope
retention
redistribution
derivation
export
```

---

# 25. Compatibility y Evolution

ENG-016 será autoridad general.

Compatibility Dimensions podrán incluir:

```text
schema
semantics
interface
quality
freshness
behavior
```

```text
Schema Compatibility
≠
Product Compatibility
```

Evolution Types podrán incluir:

```text
schema change
semantic change
quality change
freshness change
access change
security change
lifecycle change
```

```text
Breaking Change
≠
Schema Change solamente
```

Compatibility deberá considerar Consumers conocidos.

---

# 26. Deprecation y Retirement

Deprecation deberá preceder Retirement cuando Consumers requieran Migration Window.

Deprecation Notice deberá declarar:

```text
version
reason
replacement
effective date
retirement date
migration guidance
```

```text
Deprecation ≠ Retirement
```

Retirement Preconditions podrán incluir:

```text
consumer migration
retention evaluation
archive decision
dependency analysis
access shutdown
documentation
```

```text
Product Retirement ≠ Data Disposal
```

---

# 27. Data Product Lifecycle

Conceptualmente:

```text
DRAFT
  │
  ▼
VALIDATING
  │
  ▼
PUBLISHED
  │
  ▼
DEPRECATED
  │
  ▼
RETIRED
```

No constituye Lifecycle universal obligatorio.

ENG-055 será autoridad general.

```text
Product Lifecycle ≠ Underlying Data Lifecycle
```

---

# 28. Data Product Dependency

Un Product podrá depender de otros Products o Sources.

Dependency Types:

```text
source dependency
product dependency
schema dependency
pipeline dependency
service dependency
```

Transitive Dependencies podrán afectar:

```text
Quality
Freshness
Availability
Trust
Compatibility
```

Dependency Failure no deberá ocultarse.

---

# 29. Product Health e Incident

Product Health podrá derivarse de:

```text
quality
freshness
availability
dependencies
publication state
security
```

```text
Product Health ≠ System Health
```

Data Product Incident representa incidente que afecta Product Contract.

Ejemplos:

```text
quality breach
freshness breach
schema break
availability breach
unauthorized access
incorrect publication
lineage failure
```

```text
Incident ≠ Defect automáticamente
```

---

# 30. Product Recovery

Recovery deberá restaurar garantías requeridas cuando sea posible.

```text
Recovery ≠ Republish blindly
```

---

# 31. Data Product Observability

ENG-025 será autoridad general.

Product Metrics podrán incluir:

```text
mef.data_product.total
mef.data_product.state
mef.data_product.consumer.total
mef.data_product.subscription.total
mef.data_product.quality.score
mef.data_product.freshness.seconds
mef.data_product.availability.ratio
mef.data_product.refresh.failure.total
mef.data_product.contract.violation.total
mef.data_product.schema.break.total
mef.data_product.deprecation.total
mef.data_product.incident.total
```

Metric Labels podrán incluir:

```text
state
version
domain
result
failureType
```

con Cardinality controlada.

Product IDs no deberán utilizarse indiscriminadamente como Metric Labels.

---

# 32. Tracing, Logging y Diagnostics

Tracing podrá representar:

```text
source
  │
  ▼
production
  │
  ▼
validation
  │
  ▼
publication
  │
  ▼
access
  │
  ▼
consumption
```

Logging no deberá revelar Payload sensible innecesariamente.

Diagnostics deberá poder responder:

```text
which product?
which version?
who owns it?
who produces it?
who consumes it?
which contract?
which schema?
which semantics?
which access points?
what is its quality?
what is its freshness?
what is its availability?
which SLO applies?
which dependencies?
which lineage?
which state?
is it deprecated?
when will it retire?
which incidents are active?
```

---

# 33. Modelos Conceptuales

```text
DataProduct
├── id
├── version
├── name
├── owner
├── producer
├── contract
├── schema
├── semantics
├── accessPoints
├── quality
├── freshness
├── state
└── metadata
```

```text
DataProductContract
├── id
├── version
├── product
├── interfaces
├── schema
├── semantics
├── quality
├── freshness
├── availability
├── security
├── compatibility
└── lifecycle
```

```text
DataProductSubscription
├── id
├── product
├── consumer
├── version
├── purpose
├── accessPoint
├── state
└── createdAt
```

---

# 34. Data Product Runtime

```text
DataProductRuntime
├── resolve
├── validate
├── publish
├── subscribe
├── consume
├── deprecate
├── retire
├── observe
└── diagnose
```

---

# 35. Integraciones

ENG-020 podrá registrar Product, Contract, Version, Access Point y Subscription.

ENG-090 podrá publicar Metadata autorizada en Catalog.

ENG-058 podrá localizar Products.

ENG-059 podrá resolver Product, Version, Access Point y Contract.

ENG-057 será autoridad sobre Metadata.

ENG-062 será autoridad sobre Schema.

ENG-063 podrá transformar Source Data para generar Product.

ENG-064 podrá implementar producción o refresco.

ENG-036 podrá implementar Quality y Contract checks.

ENG-051 podrá gobernar Publication y Consumption.

ENG-048 deberá preservar Tenant Scope.

ENG-024 y ENG-046 aplicarán Security y Authorization.

---

# 36. Data Product Testing

ENG-009 será autoridad general.

Las pruebas deberán incluir, cuando corresponda:

```text
Contract Test
Identity Test
Schema Test
Semantic Test
Quality Test
Freshness Test
Availability Test
Security Test
Privacy Test
Compatibility Test
Breaking Change Test
Publication Test
Subscription Test
Consumption Test
Deprecation Test
Retirement Test
Dependency Failure Test
Incident Test
Multi-Tenant Test
```

---

# 37. Architecture Test

Podrá impedir:

```text
dataset treated as data product
source treated as data product
API treated as complete product
pipeline treated as product
report treated as product
product identity treated as name
product identity treated as storage location
product version treated as schema version universally
owner treated as producer universally
consumer treated as subscriber
boundary treated as storage boundary
interface treated as product
access point treated as independent product
schema treated as semantics
schema compatibility treated as product compatibility
quality score treated as contract
trusted product treated as correct product
freshness treated as availability
discoverable treated as public
discoverable treated as authorized
documentation treated as contract
metadata treated as payload
lineage treated as provenance
secure storage treated as secure product
privacy treated as security
publication treated as public access
subscription treated as authorization
subscription treated as delivery
consumption treated as ownership transfer
breaking change treated as schema-only
deprecation treated as retirement
retirement treated as data disposal
product lifecycle treated as underlying data lifecycle
product health treated as system health
incident treated as defect universally
```

---

# 38. Build Integration y CLI

ENG-012 podrá validar:

```text
product contracts
product identities
versions
owners
access points
schemas
quality requirements
freshness requirements
compatibility
publication state
```

ENG-007 podrá proporcionar:

```text
mef data-product
mef data-product:list
mef data-product:show
mef data-product:validate
mef data-product:publish
mef data-product:subscribe
mef data-product:consumers
mef data-product:quality
mef data-product:freshness
mef data-product:deprecate
mef data-product:retire
mef data-product:diagnose
```

---

# 39. Error Namespace

ENG-086 utilizará:

```text
MEF-DATA-PRODUCT-xxx
```

Taxonomía inicial:

```text
MEF-DATA-PRODUCT-001 Data product identifier invalid
MEF-DATA-PRODUCT-002 Data product contract invalid
MEF-DATA-PRODUCT-003 Data product version invalid
MEF-DATA-PRODUCT-004 Data product owner missing
MEF-DATA-PRODUCT-005 Data product producer invalid
MEF-DATA-PRODUCT-006 Data product consumer invalid
MEF-DATA-PRODUCT-007 Data product boundary invalid
MEF-DATA-PRODUCT-008 Data product interface invalid
MEF-DATA-PRODUCT-009 Data product access point invalid
MEF-DATA-PRODUCT-010 Data product schema invalid
MEF-DATA-PRODUCT-011 Data product semantics invalid
MEF-DATA-PRODUCT-012 Data product quality below threshold
MEF-DATA-PRODUCT-013 Data product freshness exceeded
MEF-DATA-PRODUCT-014 Data product unavailable
MEF-DATA-PRODUCT-015 Data product SLO violated
MEF-DATA-PRODUCT-016 Data product publication prohibited
MEF-DATA-PRODUCT-017 Data product subscription invalid
MEF-DATA-PRODUCT-018 Data product consumption prohibited
MEF-DATA-PRODUCT-019 Data product compatibility violation
MEF-DATA-PRODUCT-020 Data product breaking change detected
MEF-DATA-PRODUCT-021 Data product deprecation invalid
MEF-DATA-PRODUCT-022 Data product retirement prohibited
MEF-DATA-PRODUCT-023 Data product dependency failed
MEF-DATA-PRODUCT-024 Data product lineage unavailable
MEF-DATA-PRODUCT-025 Data product incident detected
MEF-DATA-PRODUCT-026 Data product tenant violation
MEF-DATA-PRODUCT-027 Data product privacy violation
MEF-DATA-PRODUCT-028 Data product security violation
MEF-DATA-PRODUCT-029 Data product state unknown
MEF-DATA-PRODUCT-030 Data product invariant violation
```

---

# 40. First Implementation Components

La primera implementación deberá incluir:

```text
DataProductState
DataProductId
DataProductVersion
DataProduct
DataProductContract
DataProductOwner
DataProductProducer
DataProductAccessPoint
DataProductQuality
DataProductFreshness
DataProductSubscription
DataProductDependency
DataProductRegistry
DataProductRuntime
DataProductError
```

Podrán incorporarse:

```text
DataProductSli
DataProductSlo
DataProductCompatibility
DataProductPublisher
DataProductConsumerRegistry
DataProductDiagnostics
```

---

# 41. Estructura Conceptual

```text
src/
└── DataProduct/
    ├── State/
    │   └── DataProductState
    ├── Identity/
    │   ├── DataProductId
    │   └── DataProductVersion
    ├── Product/
    │   └── DataProduct
    ├── Contract/
    │   └── DataProductContract
    ├── Ownership/
    │   ├── DataProductOwner
    │   └── DataProductProducer
    ├── Access/
    │   └── DataProductAccessPoint
    ├── Quality/
    │   └── DataProductQuality
    ├── Freshness/
    │   └── DataProductFreshness
    ├── Objective/
    │   ├── DataProductSli
    │   └── DataProductSlo
    ├── Subscription/
    │   └── DataProductSubscription
    ├── Dependency/
    │   └── DataProductDependency
    ├── Compatibility/
    │   └── DataProductCompatibility
    ├── Registry/
    │   └── DataProductRegistry
    ├── Runtime/
    │   └── DataProductRuntime
    ├── Diagnostics/
    │   └── DataProductDiagnostics
    └── Error/
        └── DataProductError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 42. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Product Identity
Explicit Ownership
Explicit Producer
Explicit Product Contracts
Schema
Semantics
Quality Requirements
Freshness Requirements
Availability Objectives
Access Points
Consumer Registration
Compatibility
Publication Lifecycle
Deprecation
Retirement
Lineage
Security
Privacy
Governance
Observability
Testing
```

No deberá requerir inicialmente:

```text
Data Product Marketplace
Universal Product Recommendation
Automatic Data Product Composition
Cross-Organization Marketplace
Dynamic SLO Optimization
AI-Assisted Product Ownership
AI-Assisted Data Product Design
```

---

# 43. Invariantes de Ingeniería

ENG-086 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1666 | Todo Data Product material deberá poseer Identity, Version, Owner, Producer, Contract, Interfaces, Schema, Semantics, Quality, Freshness, Security, Lifecycle y Metadata suficientes para que su consumo no dependa de conocimiento implícito. |
| EI-1667 | Data Product, Dataset, Data Source, API, Pipeline y Report deberán permanecer diferenciados y un artefacto técnico no deberá considerarse automáticamente Data Product sin Ownership, Contract y garantías de consumo explícitas. |
| EI-1668 | Data Product Identity deberá permanecer diferenciada de Name, Dataset Name, Storage Location y Access Point y deberá conservarse durante cambios de infraestructura compatibles. |
| EI-1669 | Product Version, Schema Version y Interface Version deberán permanecer diferenciadas y un cambio material de Semantics, Quality, Freshness o comportamiento podrá requerir Product Version aun sin Schema Change. |
| EI-1670 | Product Owner, Producer, Steward y Consumer deberán conservar responsabilidades diferenciadas y Production Responsibility no deberá conferir automáticamente Governance Authority u Ownership. |
| EI-1671 | Data Product Boundary, Interface y Access Point deberán permanecer diferenciados y múltiples Access Points podrán representar el mismo Product sin crear Products independientes. |
| EI-1672 | Schema y Semantics deberán permanecer diferenciados y Schema Compatibility no deberá utilizarse automáticamente como prueba de Semantic o Product Compatibility. |
| EI-1673 | Product Quality deberá utilizar Requirements medibles cuando forme parte del Contract y Quality Score no deberá sustituir el Contract ni ocultar incumplimientos por dimensión. |
| EI-1674 | Product Trust, Correctness y Quality deberán permanecer diferenciados y un Product confiable no deberá considerarse automáticamente correcto o de alta calidad. |
| EI-1675 | Freshness, Timeliness, Availability y Reliability deberán conservar Semantics diferenciadas y un Product disponible no deberá considerarse Fresh ni un Product stale inválido universalmente fuera de su Contract. |
| EI-1676 | Data Product SLI y SLO deberán ser medibles, Scoped y versionables y SLO no deberá confundirse con SLA ni utilizarse sin definir Measurement Semantics. |
| EI-1677 | Discoverability, Publication, Authorization, Subscription y Consumption deberán permanecer diferenciadas y Product Discoverable o Published no deberá considerarse automáticamente público, autorizado o consumido. |
| EI-1678 | Product Documentation y Metadata deberán mantenerse alineadas con Product Version y no deberán utilizarse como sustituto de Contract, Schema o Semantics autoritativas. |
| EI-1679 | Lineage y Provenance deberán conservarse cuando el Product Contract lo requiera y deberán permitir explicar Sources/Transformations sin confundir relación histórica con prueba absoluta de Correctness. |
| EI-1680 | Product Security, Privacy, Governance, Compliance y Ethics deberán preservar Authorities diferenciadas y cada Access Point/Consumer deberá aplicar controles correspondientes al mismo Product Contract. |
| EI-1681 | Product Evolution deberá identificar Breaking Changes más allá de Schema, incluyendo Semantics, Quality, Freshness, Interface, Security y Lifecycle y deberá proporcionar Compatibility/Migration Semantics suficientes a Consumers afectados. |
| EI-1682 | Deprecation, Retirement y Underlying Data Disposal deberán permanecer diferenciados y retirar un Product no deberá destruir automáticamente sus datos subyacentes ni ignorar Retention/Archive Requirements. |
| EI-1683 | Product Dependencies deberán declarar Requirements y Criticality suficientes y Upstream Quality, Freshness, Availability o Compatibility degradation deberá poder propagarse al Product State de forma observable. |
| EI-1684 | Data Product Observability, Diagnostics y Testing deberán permitir reconstruir Identity, Version, Owner, Producer, Contract, Consumers, Access Points, Quality, Freshness, Availability, Dependencies, Lineage, State e Incidents sin exponer Payload sensible innecesariamente. |
| EI-1685 | La primera implementación deberá priorizar Identity, Ownership, Contracts, Schema/Semantics, Quality, Freshness, Access Points, Consumer Registration, Compatibility, Publication, Deprecation, Retirement, Lineage, Security, Governance, Observability y Testing antes de introducir Marketplace, Automatic Composition o AI-Assisted Data Product Engineering. |

---

# 44. Continuidad de Invariantes

```text
ENG-082 → EI-1586 a EI-1605
ENG-083 → EI-1606 a EI-1625
ENG-084 → EI-1626 a EI-1645
ENG-085 → EI-1646 a EI-1665
ENG-086 → EI-1666 a EI-1685
```

---

# 45. Criterios de Conformidad

Una implementación será conforme con ENG-086 cuando:

- modele Data Product Identity;
- versione Products;
- modele Owner, Producer y Consumers;
- defina Product Boundary;
- modele Product Contract, Interfaces y Access Points;
- declare Schema y Semantics;
- declare Quality Requirements;
- mida Freshness;
- defina Availability Objectives y SLI/SLO cuando corresponda;
- publique Metadata y mantenga Documentation;
- preserve Lineage y Provenance cuando corresponda;
- implemente Security, Privacy, Governance y Compliance;
- diferencie Publication, Subscription y Consumption;
- implemente Compatibility y detecte Breaking Changes;
- soporte Deprecation y Retirement;
- modele Dependencies e Incidents;
- implemente Observability y Testing.

---

# 46. Riesgos

Deberán evitarse especialmente:

```text
Dataset Equals Data Product
Source Equals Data Product
API Equals Data Product
Pipeline Equals Data Product
Report Equals Data Product
Product Identity Equals Name
Product Identity Equals Storage Location
Product Version Equals Schema Version
Owner Equals Producer
Consumer Equals Subscriber
Boundary Equals Storage Boundary
Interface Equals Product
Access Point Equals Independent Product
Schema Equals Semantics
Schema Compatibility Equals Product Compatibility
Quality Score Equals Product Contract
Trusted Equals Correct
Freshness Equals Availability
Discoverable Equals Public
Discoverable Equals Authorized
Documentation Equals Contract
Metadata Equals Payload
Lineage Equals Provenance
Secure Storage Equals Secure Product
Privacy Equals Security
Publication Equals Public Access
Subscription Equals Authorization
Subscription Equals Delivery
Consumption Equals Ownership Transfer
Breaking Change Equals Schema Change
Deprecation Equals Retirement
Retirement Equals Data Disposal
Product Lifecycle Equals Data Lifecycle
Product Health Equals System Health
```

---

# 47. Relación con ENG-080

ENG-080 gobierna Data Quality.

```text
ENG-080
DATA QUALITY
│
└── Is the Data fit according
    to quality dimensions?

ENG-086
DATA PRODUCT
│
└── What Quality does this Product
    contractually provide to Consumers?
```

ENG-086 consume Quality.

No redefine sus dimensiones generales.

---

# 48. Relación con ENG-081 a ENG-085

```text
ENG-081 → Data Governance
ENG-082 → Data Privacy
ENG-083 → Data Compliance
ENG-084 → Data Ethics
ENG-085 → Data Trust
```

ENG-086 especializa cómo estas garantías se exponen y operan dentro del Product, sin sustituir sus respectivas autoridades.

---

# 49. Relación con ENG-087

ENG-087 formaliza **Data Exchange & Sharing Engineering**.

```text
ENG-086
DATA PRODUCT
│
└── What consumable Data capability exists?

ENG-087
DATA EXCHANGE & SHARING
│
└── How is Data transferred/shared
    between Producers, Products,
    Consumers or Organizations?
```

---

# 50. Principio Rector

> **MEF deberá tratar Data como Product únicamente cuando exista una capacidad consumible con identidad, propietario, contrato, interfaces, semántica, calidad, frescura, seguridad, lifecycle y garantías suficientemente explícitas. La disponibilidad de un Dataset o Endpoint no deberá convertirlo por sí sola en Data Product.**

---

# 51. Conclusión

**ENG-086 — Data Product Engineering** formaliza cómo MEF transforma Data administrado en una capacidad consumible y gobernada.

```text
DATA SOURCE
    │
    ▼
PRODUCER
    │
    ▼
DATA PRODUCT
    │
    ├── IDENTITY
    ├── OWNER
    ├── CONTRACT
    ├── SCHEMA
    ├── SEMANTICS
    ├── QUALITY
    ├── FRESHNESS
    ├── SLO
    ├── SECURITY
    ├── GOVERNANCE
    ├── LINEAGE
    └── LIFECYCLE
    │
    ▼
ACCESS POINT
    │
    ▼
CONSUMER
```

Las separaciones esenciales quedan:

```text
DATASET ≠ DATA PRODUCT
PRODUCT ≠ API
PRODUCT IDENTITY ≠ STORAGE LOCATION
SCHEMA ≠ SEMANTICS
SCHEMA COMPATIBILITY ≠ PRODUCT COMPATIBILITY
QUALITY ≠ TRUST
FRESHNESS ≠ AVAILABILITY
DISCOVERABLE ≠ PUBLIC
PUBLISHED ≠ AUTHORIZED
SUBSCRIBED ≠ AUTHORIZED
DEPRECATED ≠ RETIRED
RETIRED PRODUCT ≠ DISPOSED DATA
```

Con **ENG-086**, la serie global alcanza:

```text
EI-1685
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
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Data Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-070 — Performance Engineering
- ENG-073 — Availability Engineering
- ENG-074 — Reliability Engineering
- ENG-079 — Data Integrity Engineering
- ENG-080 — Data Quality Engineering
- ENG-081 — Data Governance Engineering
- ENG-082 — Data Privacy Engineering
- ENG-083 — Data Compliance Engineering
- ENG-084 — Data Ethics Engineering
- ENG-085 — Data Trust Engineering
- ENG-087 — Data Exchange & Sharing Engineering
