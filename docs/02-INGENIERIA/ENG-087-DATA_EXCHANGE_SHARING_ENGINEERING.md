---
id: ENG-087
titulo: Data Exchange & Sharing Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Exchange & Sharing Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11

dependencias:
  - ENG-000
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-021
  - ENG-024
  - ENG-025
  - ENG-033
  - ENG-036
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

relacionados:
  - ENG-007
  - ENG-012
  - ENG-020
  - ENG-043
  - ENG-058
  - ENG-059
  - ENG-073
  - ENG-074
  - ENG-088
  - ENG-089
  - ENG-092
  - ENG-094
  - ENG-095
  - ENG-096
  - ENG-099

keywords:
  - data-exchange
  - data-sharing
  - sender
  - recipient
  - exchange-contract
  - transfer
  - delivery
  - acknowledgement
  - external-sharing
  - third-party-sharing
  - cross-boundary
  - security
  - privacy
  - governance
  - compliance
  - observability
  - mef
---

# ENG-087 — Data Exchange & Sharing Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Exchange & Sharing Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-087 establece reglas para:

```text
Data Exchange
Data Sharing
Sender
Recipient
Exchange Identity
Exchange Contract
Exchange Policy
Exchange Package
Exchange Manifest
Transfer
Delivery
Acknowledgement
Sharing Scope
Sharing Purpose
Exchange Authorization
Secure Exchange
Cross-Boundary Exchange
Cross-Tenant Exchange
External Sharing
Third-Party Sharing
Exchange Evidence
Exchange Audit
Exchange Retry
Exchange Idempotency
Exchange Failure
Exchange Lifecycle
Exchange Security
Exchange Privacy
Exchange Governance
Exchange Compliance
Exchange Ethics
Exchange Observability
Exchange Testing
```

---

# 2. Declaración

> **MEF deberá tratar todo intercambio o compartición material de Data como una operación explícita, identificable, gobernada y observable entre un Sender y un Recipient, sujeta a Contract, Purpose, Scope, Authorization, Security, Privacy, Governance, Compliance y Evidence suficientes para demostrar qué Data fue compartido, con quién, por qué, bajo qué condiciones y con qué resultado.**

```text
DATA / DATA PRODUCT
        │
        ▼
      SENDER
        │
        ▼
EXCHANGE CONTRACT
        │
        ├── Purpose
        ├── Scope
        ├── Policy
        ├── Security
        ├── Privacy
        ├── Governance
        └── Compliance
        │
        ▼
 EXCHANGE PACKAGE
        │
        ▼
     TRANSFER
        │
        ▼
    RECIPIENT
        │
        ▼
ACKNOWLEDGEMENT / EVIDENCE
```

---

# 3. Data Exchange y Data Sharing

`Data Exchange` representa transferencia controlada de Data desde un Sender hacia un Recipient.

`Data Sharing` representa la concesión gobernada de capacidad de acceso o uso de Data.

```text
Data Exchange
≠
Data Sharing necesariamente
```

Un Sharing Agreement puede permitir múltiples Exchanges.

Un Exchange puede ejecutar una obligación de Sharing.

---

# 4. Fronteras conceptuales

```text
Exchange ≠ Replication
Exchange ≠ Synchronization
Exchange ≠ Federation
Exchange ≠ Data Product
```

ENG-096 gobierna Replication.

ENG-095 gobierna Synchronization.

ENG-088 gobierna Federation.

ENG-086 gobierna Data Product.

---

# 5. Sender y Recipient

`Sender` representa la entidad autorizada que inicia o produce el Exchange.

`Recipient` representa la entidad autorizada para recibir o acceder al Data.

Podrán ser:

```text
service
application
tenant
organization
data product
integration
operator
external system
```

Principios:

```text
Sender ≠ Owner automáticamente
Recipient ≠ Consumer universalmente
```

Sender y Recipient deberán poseer Identity suficiente cuando el Exchange cruce una Boundary material.

---

# 6. Exchange Identity

Todo Exchange material deberá poder poseer:

```text
ExchangeId
```

Exchange Identity deberá permitir correlación entre:

```text
request
authorization
package
transfer
delivery
acknowledgement
audit
incident
```

---

# 7. Exchange Requirement

Todo Exchange material deberá poder declarar:

```text
sender
recipient
purpose
scope
data
contract
policy
authorization
security
privacy
retention
location
delivery semantics
evidence
```

---

# 8. Exchange Contract

Conceptualmente:

```text
DataExchangeContract
├── id
├── version
├── sender
├── recipient
├── purpose
├── scope
├── dataContract
├── delivery
├── security
├── privacy
├── governance
├── compliance
├── retention
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

ENG-087 especializa Contract Semantics para Data Exchange & Sharing.

---

# 9. Exchange Policy

ENG-051 será autoridad general.

Exchange Policy podrá restringir:

```text
who
what
why
when
where
how
how much
how long
redistribution
derivation
```

---

# 10. Exchange Package y Manifest

`Exchange Package` representa una unidad lógica de Data preparada para Exchange.

Podrá contener:

```text
payload
manifest
schema reference
metadata
checksums
classification
timestamps
signatures
```

```text
Exchange Package
≠
Transport Message
```

Un Package podrá fragmentarse en múltiples Transport Messages.

Manifest podrá describir:

```text
exchange id
package id
version
sender
recipient
content
schema
classification
size
hash
createdAt
expiresAt
```

---

# 11. Transfer, Delivery y Acknowledgement

`Transfer` representa movimiento o exposición técnica del Package/Data.

`Delivery` representa cumplimiento de las Delivery Semantics definidas por Contract.

`Acknowledgement` representa evidencia emitida por Recipient.

```text
Transfer
≠
Delivery

Delivery
≠
Acknowledgement

Acknowledgement
≠
Semantic Acceptance necesariamente
```

---

# 12. Delivery Semantics

Podrán incluir:

```text
at-most-once
at-least-once
effectively-once
best-effort
confirmed delivery
```

MEF no deberá declarar `exactly-once` sin definir Scope, Boundary y Failure Model.

---

# 13. Sharing Scope y Purpose

Scope podrá expresarse por:

```text
dataset
data product
schema
fields
records
classification
tenant
time range
partition
purpose
```

Todo Sharing sujeto a Purpose Limitation deberá declarar Purpose explícito.

```text
Authorization
≠
Purpose
```

---

# 14. Exchange Authorization

ENG-046 será autoridad general.

Authorization deberá poder evaluarse contra:

```text
sender
recipient
scope
purpose
policy
classification
tenant
location
time
```

Principios:

```text
Authorization ≠ Delivery
Authorization ≠ Consent universalmente
```

---

# 15. Secure Exchange

ENG-024 será autoridad general.

Secure Exchange podrá requerir:

```text
authentication
authorization
encryption in transit
encryption at rest
integrity
signatures
key management
audit
replay protection
```

Transport Security por sí sola no constituye Secure Exchange end-to-end.

---

# 16. Integrity e Idempotency

Package o Transfer podrá utilizar:

```text
hash
MAC
digital signature
content digest
manifest digest
```

Integrity Verification no demuestra Correctness del Data.

Retry deberá disponer de Idempotency Semantics suficientes cuando exista riesgo de efectos duplicados.

---

# 17. Cross-Boundary Exchange

Todo Exchange que cruce una Boundary material deberá identificarla.

Ejemplos:

```text
tenant
organization
region
country
jurisdiction
trust zone
network zone
provider
```

Cross-Tenant Exchange deberá estar explícitamente autorizado conforme ENG-048.

---

# 18. External y Third-Party Sharing

External Sharing representa Sharing fuera del Boundary organizacional o de confianza definido.

Third-Party Sharing deberá declarar, cuando corresponda:

```text
recipient identity
purpose
scope
redistribution rights
retention
location
security requirements
privacy requirements
compliance requirements
termination conditions
```

```text
Receive
≠
Redistribute
```

---

# 19. Data Minimization, Retention y Localization

Exchange deberá limitar Data al mínimo requerido cuando Contract, Privacy o Governance lo exijan.

ENG-092 gobernará Retention & Disposal.

ENG-099 gobernará Localization & Residency.

Transformation no deberá ampliar implícitamente Scope o Purpose.

---

# 20. Exchange Evidence

Todo Exchange material deberá poder producir Evidence suficiente.

Podrá incluir:

```text
exchange id
sender
recipient
purpose
scope
contract version
authorization decision
package hash
timestamps
delivery result
acknowledgement
policy version
```

```text
Evidence
≠
Payload
```

Evidence no deberá duplicar Data sensible innecesariamente.

---

# 21. Exchange Audit

Audit deberá permitir reconstruir decisiones materiales sin requerir Payload completo cuando no sea necesario.

ENG-087 especializa Evidence de Exchange sin redefinir la autoridad general de Audit.

---

# 22. Exchange State

Podrá utilizarse:

```text
CREATED
AUTHORIZED
PREPARED
TRANSFERRING
DELIVERED
ACKNOWLEDGED
REJECTED
FAILED
EXPIRED
CANCELLED
```

La implementación deberá preservar las diferencias de estado cuando afecten comportamiento, evidencia o recuperación.

---

# 23. Exchange Retry

Retry deberá obedecer:

```text
retry policy
idempotency
expiration
authorization validity
package validity
recipient state
```

```text
Retry
≠
New Exchange necesariamente
```

Contract deberá definir cuándo Retry conserva Exchange Identity y cuándo crea una nueva.

---

# 24. Partial Delivery y Failure

Partial Delivery deberá tener semántica explícita.

```text
Partial Delivery
≠
Successful Delivery automáticamente
```

Failure Types podrán incluir:

```text
authorization failure
policy failure
contract failure
schema failure
security failure
privacy failure
network failure
delivery failure
recipient failure
integrity failure
expiration
```

---

# 25. Exchange Lifecycle

Conceptualmente:

```text
CREATED
   │
   ▼
AUTHORIZED
   │
   ▼
PREPARED
   │
   ▼
TRANSFERRING
   │
   ▼
DELIVERED
   │
   ▼
ACKNOWLEDGED
```

Failure, Rejection, Expiration o Cancellation podrán interrumpir el flujo.

ENG-055 será autoridad general de Lifecycle.

---

# 26. Security, Privacy, Governance, Compliance y Ethics

Las autoridades deberán permanecer diferenciadas:

```text
Security    → ENG-024
Privacy     → ENG-082
Governance  → ENG-081
Compliance  → ENG-083
Ethics      → ENG-084
```

Una decisión permisiva en una disciplina no deberá anular restricciones de otra.

---

# 27. Integración con Data Product

ENG-086 será autoridad de Data Product.

Un Exchange podrá referenciar:

```text
product id
product version
contract
schema
quality
freshness
```

ENG-087 no redefine Product Identity, Quality o Lifecycle.

---

# 28. Integraciones de Data

```text
Schema          → ENG-062
Transformation  → ENG-063
Pipeline        → ENG-064
Quality         → ENG-080
Trust           → ENG-085
Lineage         → ENG-089
Metadata        → ENG-057
```

Exchange Success no demuestra Data Quality.

---

# 29. Exchange Observability

ENG-025 será autoridad general.

Metrics podrán incluir:

```text
mef.data_exchange.total
mef.data_exchange.active
mef.data_exchange.delivered.total
mef.data_exchange.failed.total
mef.data_exchange.rejected.total
mef.data_exchange.retry.total
mef.data_exchange.bytes
mef.data_exchange.duration
mef.data_exchange.integrity_failure.total
mef.data_exchange.authorization_failure.total
mef.data_exchange.policy_failure.total
mef.data_exchange.acknowledgement.total
```

Labels deberán mantener Cardinality controlada.

ExchangeId, SenderId y RecipientId no deberán utilizarse indiscriminadamente como Metric Labels.

---

# 30. Exchange Tracing y Logging

Tracing podrá representar:

```text
request
  │
  ▼
authorization
  │
  ▼
package preparation
  │
  ▼
transfer
  │
  ▼
delivery
  │
  ▼
acknowledgement
```

Logging deberá evitar:

```text
raw sensitive payload
credentials
secrets
unnecessary personal data
cryptographic material
```

---

# 31. Exchange Diagnostics

Deberá poder responder:

```text
which exchange?
which sender?
which recipient?
which purpose?
which scope?
which contract?
which policy?
which authorization?
which package?
which schema?
which classification?
which boundary?
which transfer?
was it delivered?
was it acknowledged?
was integrity verified?
were retries performed?
which failure occurred?
which evidence exists?
```

---

# 32. Modelos Conceptuales

```text
DataExchange
├── id
├── version
├── sender
├── recipient
├── contract
├── purpose
├── scope
├── package
├── state
├── createdAt
└── expiresAt
```

```text
DataExchangePackage
├── id
├── exchange
├── manifest
├── schema
├── classification
├── digest
├── size
└── createdAt
```

```text
DataExchangeEvidence
├── exchange
├── authorization
├── policyVersion
├── packageDigest
├── transfer
├── delivery
├── acknowledgement
└── timestamps
```

```text
DataSharingAgreement
├── id
├── version
├── provider
├── recipient
├── purpose
├── scope
├── policy
├── retention
├── redistribution
├── location
└── lifecycle
```

---

# 33. Exchange Runtime

Conceptualmente:

```text
DataExchangeRuntime
├── authorize
├── prepare
├── transfer
├── deliver
├── acknowledge
├── retry
├── cancel
├── observe
└── diagnose
```

---

# 34. Registry, Discovery, Resolution y Validation

ENG-020 podrá registrar Contracts, Sharing Agreements y Exchange Endpoints.

ENG-058 podrá localizar capacidades autorizables de Exchange.

ENG-059 podrá resolver Recipient, Endpoint, Contract, Policy y Schema.

ENG-036 podrá validar Contract, Manifest, Schema, Scope, Recipient y Package.

Discovery no deberá implicar Authorization.

---

# 35. Testing

ENG-009 será autoridad general.

Deberán existir pruebas para:

```text
contract
sender identity
recipient identity
authorization
purpose
scope
schema
package integrity
encryption
delivery
acknowledgement
retry
idempotency
partial delivery
cross-tenant
external sharing
third-party sharing
privacy
retention
localization
audit evidence
failure handling
```

---

# 36. Architecture Test

Podrá impedir:

```text
exchange treated as sharing universally
exchange treated as replication
exchange treated as synchronization
exchange treated as federation
exchange treated as data product
sender treated as owner
recipient treated as consumer universally
transfer treated as delivery
delivery treated as acknowledgement
acknowledgement treated as semantic acceptance
authorization treated as delivery
authorization treated as consent universally
package treated as transport message
evidence treated as payload
receive treated as redistribute
retry without idempotency
partial delivery treated as success universally
transport security treated as complete exchange security
exchange success treated as data quality
discovery treated as authorization
```

---

# 37. Build Integration

ENG-012 podrá validar:

```text
exchange contracts
sharing agreements
sender/recipient definitions
purpose requirements
scope requirements
security requirements
privacy requirements
location constraints
retention constraints
```

---

# 38. CLI

ENG-007 podrá proporcionar:

```text
mef data-exchange
mef data-exchange:list
mef data-exchange:show
mef data-exchange:validate
mef data-exchange:authorize
mef data-exchange:send
mef data-exchange:status
mef data-exchange:evidence
mef data-exchange:retry
mef data-exchange:cancel
mef data-exchange:diagnose
```

---

# 39. Error Namespace

ENG-087 utilizará:

```text
MEF-DATA-EXCHANGE-xxx
```

Taxonomía inicial:

```text
MEF-DATA-EXCHANGE-001 Exchange identifier invalid
MEF-DATA-EXCHANGE-002 Exchange contract invalid
MEF-DATA-EXCHANGE-003 Sender invalid
MEF-DATA-EXCHANGE-004 Recipient invalid
MEF-DATA-EXCHANGE-005 Purpose invalid
MEF-DATA-EXCHANGE-006 Scope invalid
MEF-DATA-EXCHANGE-007 Exchange authorization denied
MEF-DATA-EXCHANGE-008 Exchange policy denied
MEF-DATA-EXCHANGE-009 Exchange package invalid
MEF-DATA-EXCHANGE-010 Exchange manifest invalid
MEF-DATA-EXCHANGE-011 Exchange schema invalid
MEF-DATA-EXCHANGE-012 Exchange integrity verification failed
MEF-DATA-EXCHANGE-013 Exchange security violation
MEF-DATA-EXCHANGE-014 Exchange privacy violation
MEF-DATA-EXCHANGE-015 Exchange governance violation
MEF-DATA-EXCHANGE-016 Exchange compliance violation
MEF-DATA-EXCHANGE-017 Exchange location violation
MEF-DATA-EXCHANGE-018 Exchange retention violation
MEF-DATA-EXCHANGE-019 Exchange transfer failed
MEF-DATA-EXCHANGE-020 Exchange delivery failed
MEF-DATA-EXCHANGE-021 Exchange acknowledgement invalid
MEF-DATA-EXCHANGE-022 Exchange retry prohibited
MEF-DATA-EXCHANGE-023 Exchange idempotency violation
MEF-DATA-EXCHANGE-024 Exchange expired
MEF-DATA-EXCHANGE-025 Exchange cancelled
MEF-DATA-EXCHANGE-026 Cross-tenant exchange prohibited
MEF-DATA-EXCHANGE-027 External sharing prohibited
MEF-DATA-EXCHANGE-028 Third-party sharing prohibited
MEF-DATA-EXCHANGE-029 Exchange evidence unavailable
MEF-DATA-EXCHANGE-030 Exchange invariant violation
```

---

# 40. First Implementation Components

La primera implementación deberá incluir:

```text
DataExchangeState
DataExchangeId
DataExchange
DataExchangeContract
DataExchangeSender
DataExchangeRecipient
DataExchangeScope
DataExchangePurpose
DataExchangePackage
DataExchangeManifest
DataExchangeEvidence
DataSharingAgreement
DataExchangeRuntime
DataExchangeError
```

Podrán incorporarse inicialmente:

```text
DataExchangePolicy
DataExchangeAuthorization
DataExchangeAcknowledgement
DataExchangeDiagnostics
DataExchangeRegistry
```

---

# 41. Estructura Conceptual

```text
src/
└── DataExchange/
    ├── State/
    │   └── DataExchangeState
    ├── Identity/
    │   └── DataExchangeId
    ├── Exchange/
    │   └── DataExchange
    ├── Contract/
    │   └── DataExchangeContract
    ├── Party/
    │   ├── DataExchangeSender
    │   └── DataExchangeRecipient
    ├── Scope/
    │   ├── DataExchangeScope
    │   └── DataExchangePurpose
    ├── Package/
    │   ├── DataExchangePackage
    │   └── DataExchangeManifest
    ├── Sharing/
    │   └── DataSharingAgreement
    ├── Evidence/
    │   └── DataExchangeEvidence
    ├── Runtime/
    │   └── DataExchangeRuntime
    ├── Diagnostics/
    │   └── DataExchangeDiagnostics
    └── Error/
        └── DataExchangeError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 42. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Sender
Explicit Recipient
Explicit Purpose
Explicit Scope
Explicit Exchange Contract
Authorization
Policy Evaluation
Package Integrity
Delivery Semantics
Acknowledgement
Retry + Idempotency
Cross-Boundary Controls
External / Third-Party Sharing Controls
Security
Privacy
Governance
Compliance
Evidence
Auditability
Observability
Testing
```

No deberá requerir inicialmente:

```text
Universal Data Exchange Marketplace
Automatic Partner Negotiation
Automatic Legal Agreement Generation
Adaptive Cross-Organization Routing
AI-Assisted Sharing Decisions
```

---

# 43. Invariantes de Ingeniería

ENG-087 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1686 | Todo Data Exchange material deberá identificar Sender, Recipient, Purpose, Scope, Contract, Policy, Authorization, Security, Privacy y resultado suficiente para reconstruir la operación sin depender de contexto implícito. |
| EI-1687 | Data Exchange, Data Sharing, Replication, Synchronization, Federation y Data Product deberán permanecer diferenciados y compartir o transferir Data no deberá implicar automáticamente replicación, sincronización o federación. |
| EI-1688 | Sender, Data Owner, Producer, Recipient, Consumer y Third Party deberán conservar responsabilidades diferenciadas y la capacidad técnica de enviar o recibir Data no deberá conferir Ownership ni derechos adicionales de uso. |
| EI-1689 | Exchange Identity deberá correlacionar Request, Authorization, Package, Transfer, Delivery, Acknowledgement, Evidence e Incident cuando corresponda, sin utilizar Transport Identity como sustituto universal. |
| EI-1690 | Exchange Contract deberá declarar Purpose y Scope suficientes y Authorization no deberá interpretarse como autorización ilimitada para otros Purposes, Scopes, Recipients, Locations o Retention periods. |
| EI-1691 | Exchange Package, Transport Message, Manifest y Payload deberán permanecer diferenciados y fragmentación, batching o transporte no deberán alterar silenciosamente Contract Semantics. |
| EI-1692 | Transfer, Delivery, Acknowledgement y Semantic Acceptance deberán permanecer diferenciados y la existencia de bytes transferidos no deberá utilizarse como prueba automática de entrega contractual o aceptación. |
| EI-1693 | Delivery Semantics deberán declarar Failure Model y Scope y MEF no deberá prometer exactly-once sin definir explícitamente la frontera dentro de la cual dicha garantía puede sostenerse. |
| EI-1694 | Retry deberá respetar Idempotency, Expiration, Authorization y Package validity y no deberá producir duplicación material silenciosa ni ampliar el Scope original. |
| EI-1695 | Cross-Tenant, Cross-Organization, Cross-Region, Cross-Jurisdiction y Third-Party Exchanges deberán identificar explícitamente la Boundary cruzada y aplicar controles adicionales cuando Policy lo requiera. |
| EI-1696 | Receipt de Data no deberá conferir automáticamente derecho de Redistribution, Derivation, Retention indefinida o Transfer a terceros y tales capacidades deberán derivarse de Contract y Policy explícitos. |
| EI-1697 | Data Minimization, Purpose Limitation, Retention y Localization deberán aplicarse al Exchange cuando correspondan y Transformation no deberá utilizarse para ampliar implícitamente derechos de Sharing. |
| EI-1698 | Secure Exchange deberá considerar controles end-to-end y Transport Security por sí sola no deberá considerarse evidencia suficiente de Authorization, Integrity, Privacy, Governance o Compliance del Exchange. |
| EI-1699 | Exchange Evidence deberá demostrar decisiones y resultados materiales sin duplicar Payload sensible innecesariamente y deberá conservar integridad y trazabilidad suficientes para Audit. |
| EI-1700 | Exchange Success, Data Quality, Data Trust e Integrity Verification deberán permanecer diferenciados y una entrega exitosa o hash válido no deberá considerarse prueba de Correctness o Fitness del Data. |
| EI-1701 | Exchange State y Lifecycle deberán distinguir Created, Authorized, Prepared, Transferring, Delivered, Acknowledged, Rejected, Failed, Expired y Cancelled cuando dichas diferencias afecten comportamiento o evidencia. |
| EI-1702 | Exchange Observability deberá permitir diagnosticar Sender, Recipient, Purpose, Scope, Contract, Policy, Package, Boundary, Delivery, Retry, Failure y Evidence sin exponer Payload, Secrets o Personal Data innecesariamente. |
| EI-1703 | Exchange Security, Privacy, Governance, Compliance y Ethics deberán conservar Authorities diferenciadas y una decisión permisiva en una disciplina no deberá anular restricciones de otra. |
| EI-1704 | Architecture y Testing deberán comprobar Cross-Tenant isolation, Authorization, Purpose, Scope, Integrity, Delivery, Retry, Idempotency, External Sharing, Retention, Localization y Evidence antes de considerar conforme un mecanismo de Exchange. |
| EI-1705 | La primera implementación deberá priorizar Contracts, Parties, Purpose, Scope, Authorization, Package Integrity, Delivery Semantics, Retry/Idempotency, Boundary Controls, Security, Privacy, Evidence, Observability y Testing antes de introducir Marketplace, Dynamic Negotiation o AI-Assisted Sharing. |

---

# 44. Continuidad de Invariantes

```text
ENG-083 → EI-1606 a EI-1625
ENG-084 → EI-1626 a EI-1645
ENG-085 → EI-1646 a EI-1665
ENG-086 → EI-1666 a EI-1685
ENG-087 → EI-1686 a EI-1705
```

---

# 45. Criterios de Conformidad

Una implementación será conforme con ENG-087 cuando:

- modele Sender y Recipient;
- defina Exchange Identity;
- modele Exchange Contract;
- declare Purpose y Scope;
- evalúe Authorization y Policy;
- modele Package y Manifest;
- preserve Schema references cuando corresponda;
- implemente Integrity Verification;
- defina Delivery Semantics;
- diferencie Transfer, Delivery y Acknowledgement;
- gobierne Retry e Idempotency;
- preserve Tenant Context;
- controle Cross-Boundary, External y Third-Party Sharing;
- respete Privacy, Retention y Localization;
- produzca Evidence;
- preserve Auditability;
- implemente Observability, Diagnostics y Testing.

---

# 46. Riesgos

Deberán evitarse especialmente:

```text
Exchange Equals Sharing
Exchange Equals Replication
Exchange Equals Synchronization
Exchange Equals Federation
Sender Equals Owner
Recipient Equals Consumer
Transfer Equals Delivery
Delivery Equals Acknowledgement
Acknowledgement Equals Acceptance
Authorization Equals Purpose
Authorization Equals Consent
Package Equals Transport Message
Evidence Equals Payload
Receive Equals Redistribute
Retry Without Idempotency
Implicit Cross-Tenant Sharing
Implicit External Sharing
Implicit Third-Party Sharing
Transport Security Equals Secure Exchange
Exchange Success Equals Data Quality
Integrity Equals Correctness
Discovery Equals Authorization
```

---

# 47. Relación con ENG-086

ENG-086 gobierna Data Product.

```text
ENG-086
DATA PRODUCT
│
└── What consumable Data capability exists?

ENG-087
DATA EXCHANGE & SHARING
│
└── How is Data transferred or shared
    between authorized parties?
```

---

# 48. Relación con ENG-088

ENG-088 formaliza **Data Federation Engineering**.

```text
ENG-087
DATA EXCHANGE & SHARING
│
└── How is Data transferred/shared?

ENG-088
DATA FEDERATION
│
└── How can distributed Data be exposed
    through a coordinated logical access model?
```

Federation no deberá tratarse automáticamente como Exchange persistente.

---

# 49. Principio Rector

> **MEF deberá hacer explícito todo intercambio material de Data: quién envía, quién recibe, qué se comparte, con qué propósito, bajo qué contrato, autorización y políticas, qué frontera se cruza, qué garantías de seguridad y privacidad aplican y qué evidencia demuestra el resultado.**

---

# 50. Conclusión

**ENG-087 — Data Exchange & Sharing Engineering** formaliza el movimiento y la compartición gobernada de Data dentro y fuera de MEF.

```text
DATA / DATA PRODUCT
        │
        ▼
      SENDER
        │
        ▼
 PURPOSE + SCOPE
        │
        ▼
 CONTRACT + POLICY
        │
        ▼
 AUTHORIZATION
        │
        ▼
 EXCHANGE PACKAGE
        │
        ▼
     TRANSFER
        │
        ▼
     DELIVERY
        │
        ▼
    RECIPIENT
        │
        ▼
ACKNOWLEDGEMENT
        │
        ▼
     EVIDENCE
```

Con **ENG-087**, la serie global alcanza:

```text
EI-1705
```

---

# Referencias

## Ingeniería

- ENG-009 — Testing Engineering
- ENG-014 — Versioning Engineering
- ENG-016 — Compatibility Engineering
- ENG-021 — Contracts Engineering
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-033 — Interface Engineering
- ENG-036 — Validation Engineering
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
- ENG-088 — Data Federation Engineering
