---
id: ENG-093
titulo: Data Archival & Preservation Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Archival & Preservation Engineering
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
  - ENG-084
  - ENG-085
  - ENG-086
  - ENG-089
  - ENG-090
  - ENG-091
  - ENG-092

relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-030
  - ENG-031
  - ENG-034
  - ENG-037
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
  - ENG-073
  - ENG-074
  - ENG-075
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-087
  - ENG-088
  - ENG-094
  - ENG-095
  - ENG-096
  - ENG-097
  - ENG-098
  - ENG-099
  - ENG-100

keywords:
  - data-archival
  - preservation
  - archive
  - preservation-policy
  - preservation-package
  - fixity
  - integrity
  - authenticity
  - provenance
  - format-migration
  - bit-preservation
  - long-term-retention
  - restoration
  - evidence
  - mef
---

# ENG-093 — Data Archival & Preservation Engineering

## Estado

Accepted.

---
# 1. Propósito

Definir el modelo de **Data Archival & Preservation Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-093 establece reglas para:

```text
Data Archive
Data Archival
Data Preservation

Archive Identity
Archive Scope
Archive Boundary
Archive Contract
Archive Policy

Archive Package
Preservation Package
Preservation Object
Preservation Manifest

Archival Ingest
Archival Validation
Archival Acceptance
Archival Storage
Archival Retrieval
Archival Restore

Bit Preservation
Logical Preservation
Semantic Preservation
Evidence Preservation

Fixity
Checksum
Integrity Verification
Authenticity
Provenance
Chain of Custody

Preservation Format
Format Risk
Format Migration
Normalization
Transformation

Archive Copy
Preservation Replica
Geographic Copy
Offline Copy
Immutable Copy

Preservation Metadata
Technical Metadata
Descriptive Metadata
Administrative Metadata
Provenance Metadata

Archive Retention
Archive Hold
Archive Disposal

Archive Security
Archive Privacy
Archive Governance
Archive Compliance
Archive Ethics

Archive Availability
Archive Reliability
Archive Durability

Preservation Verification
Preservation Audit
Preservation Evidence

Archive Observability
Archive Diagnostics
Archive Testing
```

---

# 2. Declaración

> **MEF deberá tratar el Archival como una transición gobernada hacia almacenamiento y custodia de largo plazo, y Preservation como el conjunto de controles necesarios para mantener Bits, Integrity, Authenticity, Provenance, Interpretability y Evidence durante el periodo autorizado, sin confundir conservar bytes con preservar significado ni archivar con retener indefinidamente.**

Arquitectura conceptual:

```text
ACTIVE DATA
    │
    ▼
ARCHIVAL ELIGIBILITY
    │
    ├── Policy
    ├── Retention
    ├── Classification
    ├── Governance
    └── Holds
    │
    ▼
ARCHIVAL INGEST
    │
    ▼
PRESERVATION PACKAGE
    │
    ├── Content
    ├── Metadata
    ├── Manifest
    ├── Fixity
    ├── Provenance
    └── Policy
    │
    ▼
ARCHIVAL STORAGE
    │
    ├── Integrity Verification
    ├── Replication
    ├── Format Monitoring
    └── Preservation Actions
    │
    ▼
RETRIEVAL / RESTORE / DISPOSAL
```

---

# 3. Data Archival

`Data Archival` representa la transición gobernada de Data desde un estado operacional hacia custodia de archivo.

```text
Operational Storage ≠ Archive Storage
```

---

# 4. Data Preservation

`Data Preservation` representa controles y acciones para mantener Data utilizable, verificable e interpretable durante el tiempo requerido.

Preservation podrá abarcar Bits, Formats, Metadata, Provenance y Evidence.

---

# 5. Archival ≠ Backup

```text
Archive ≠ Backup
```

Backup está orientado principalmente a Recovery operacional. Archive está orientado a conservación gobernada de largo plazo. Una misma infraestructura no deberá borrar esta frontera conceptual.

---

# 6. Archival ≠ Retention

ENG-092 será autoridad sobre Retention & Disposal.

```text
Archive ≠ Retention Rule
```

Archivar Data no autoriza conservarlo más allá de su Retention aplicable.

---

# 7. Preservation ≠ Replication

```text
Preservation ≠ Replication
```

Tener múltiples copias reduce ciertos riesgos, pero no garantiza Authenticity, Format Readability, Semantic Preservation o Governance.

---

# 8. Bit Preservation ≠ Semantic Preservation

```text
Bit Preservation ≠ Semantic Preservation
```

Bits intactos pueden dejar de ser interpretables si desaparecen Format, Schema, Encoding, Context o Software Requirements.

---

# 9. Archive Identity

Todo Archive material deberá poseer Identity estable.

```text
ArchiveId
ArchivePackageId
PreservationObjectId
```

---

# 10. Archive Scope

Scope podrá definirse por Asset, Product, Domain, Tenant, Classification, Jurisdiction, Retention Class o Collection. Scope deberá ser explícito.

---

# 11. Archive Boundary

Boundary deberá declarar sistemas, Stores, jurisdicciones y autoridades comprendidas. `Outside Archive Boundary` no deberá interpretarse como `Not Preserved` ni `Disposed`.

---

# 12. Archive Contract

Conceptualmente:

```text
DataArchiveContract
├── id
├── version
├── scope
├── ingest
├── preservation
├── retrieval
├── retention
├── security
├── verification
└── lifecycle
```

ENG-021 será autoridad general de Contracts.

---

# 13. Archive Policy

ENG-051 será autoridad general. Policy podrá controlar Eligibility, Accepted Formats, Required Metadata, Fixity, Replication, Verification Frequency, Retrieval, Holds y Disposal.

---

# 14. Archival Eligibility

Eligibility deberá considerar Retention, Lifecycle, Classification, Holds, Contract, Value y Policy. `Inactive` no deberá significar automáticamente `Eligible for Archive`.

---

# 15. Archival Ingest

Ingest deberá recibir Data y Preservation Metadata de forma verificable. Deberá producir una transición observable y auditable.

---

# 16. Archival Validation

Antes de Acceptance deberán validarse, cuando apliquen, Identity, Package Structure, Manifest, Format, Metadata, Fixity, Classification, Retention y Authorization.

---

# 17. Archival Acceptance

```text
Submitted ≠ Accepted
Accepted ≠ Preserved Forever
```

Acceptance deberá producir estado explícito y Evidence.

---

# 18. Preservation Package

Conceptualmente:

```text
PreservationPackage
├── id
├── objects
├── manifest
├── metadata
├── fixity
├── provenance
├── policy
└── createdAt
```

---

# 19. Preservation Object

Preservation Object representa una unidad preservada dentro de un Package. Object Identity deberá permanecer diferenciada de Package Identity y Source Asset Identity.

---

# 20. Preservation Manifest

Manifest deberá enumerar Objects, Paths o Logical Members, Fixity Information, Formats y Metadata relevantes para verificar Package Completeness.

---

# 21. Fixity

Fixity representa capacidad de detectar cambios no autorizados o accidentales en contenido preservado.

```text
Fixity ≠ Authenticity
```

---

# 22. Checksum

Checksum podrá utilizarse como mecanismo de Fixity. Algorithm, Value, Scope y Capture Time deberán ser explícitos. Un checksum válido no demuestra por sí solo origen legítimo.

---

# 23. Integrity Verification

ENG-079 será autoridad sobre Data Integrity. Verification deberá comparar Evidence actual con Baseline autoritativa y registrar resultado.

---

# 24. Authenticity

Authenticity representa confianza de que el objeto es lo que afirma ser y conserva relación legítima con su origen. Podrá requerir Provenance, Identity, Signatures, Custody y Evidence.

---

# 25. Provenance

ENG-089 será autoridad. Archive deberá preservar Provenance relevante sin reescribir la historia del Asset.

---

# 26. Chain of Custody

Cuando sea material, cambios de custodia deberán registrar Actor/System, Time, Action, Source, Destination y Evidence. Chain of Custody no deberá inferirse de timestamps aislados.

---

# 27. Bit Preservation

Deberá proteger la secuencia de bits mediante Storage Controls, Fixity, Replication y Verification apropiados.

---

# 28. Logical Preservation

Deberá conservar estructura lógica suficiente: files, records, relationships, ordering, packaging y schema references cuando sean necesarios.

---

# 29. Semantic Preservation

Deberá conservar significado suficiente mediante Schema, Business Terms, Documentation, Encoding, Units, Context y Version cuando el uso futuro lo requiera.

---

# 30. Evidence Preservation

Evidence utilizada para Integrity, Authenticity, Compliance o Custody podrá requerir Preservation propia y Retention independiente.

---

# 31. Preservation Format

Format deberá identificarse explícitamente cuando afecte Readability o Migration. File extension por sí sola no deberá ser autoridad suficiente.

---

# 32. Format Risk

Podrá evaluarse por obsolescence, software dependency, proprietary constraints, corruption risk, complexity o lack of specification.

---

# 33. Format Migration

Migration deberá preservar Source, Target, Tool/Process, Time, Reason, Validation y Relationship entre versiones.

---

# 34. Normalization

Normalization podrá convertir Data a formatos preferidos durante Ingest.

```text
Normalized Copy ≠ Original Copy
```

La relación deberá preservarse.

---

# 35. Transformation

Toda transformación material deberá ser trazable y verificable. No deberá sobrescribir silenciosamente el Original cuando éste deba preservarse.

---

# 36. Preservation Copies

Podrán existir `Archive Copy`, `Preservation Replica`, `Geographic Copy`, `Offline Copy` e `Immutable Copy`. Cada tipo deberá poseer Purpose y Semantics explícitas.

---

# 37. Preservation Replication

ENG-096 será autoridad general sobre Replication. Replicas de Preservation deberán verificarse independientemente cuando el Risk Model lo requiera.

---

# 38. Geographic Diversity

Copies podrán distribuirse entre Failure Domains o regiones. Geographic Diversity no deberá violar ENG-099 Localization & Residency.

---

# 39. Offline Copy

Offline Copy podrá reducir ciertos riesgos de modificación o ataque. Su existencia no elimina requisitos de Inventory, Fixity, Access Control y Restore Testing.

---

# 40. Immutable Copy

Immutability deberá tener Scope y Duration explícitos.

```text
Immutable ≠ Indestructible
Immutable ≠ Permanently Retained
```

---

# 41. Preservation Metadata

Metadata de Preservation deberá permitir interpretar, verificar, administrar y auditar objetos preservados.

---

# 42. Technical Metadata

Podrá incluir Format, Encoding, Size, Schema, Software Requirements, Checksums y Storage Characteristics.

---

# 43. Descriptive Metadata

Podrá incluir Name, Description, Domain, Business Context, Subjects y Relationships necesarios para Discovery e Interpretation.

---

# 44. Administrative Metadata

Podrá incluir Owner, Custodian, Classification, Access Policy, Retention, Holds, Rights y Lifecycle.

---

# 45. Provenance Metadata

Podrá incluir Origin, Ingest, Transformations, Migrations, Custody Events y Verification History.

---

# 46. Metadata Preservation

Preservation Metadata deberá protegerse con controles proporcionales a su función. `Content Preserved` no deberá implicar `Metadata Preserved` automáticamente.

---

# 47. Archive Retention

ENG-092 será autoridad. Archive podrá poseer Retention específica, pero nunca deberá interpretarse como conservación indefinida por defecto.

---

# 48. Archive Hold

Holds aplicables deberán impedir Disposal del Archive Scope correspondiente sin eliminar Retention History.

---

# 49. Archive Disposal

Cuando ENG-092 determine Disposal, ENG-093 deberá coordinar eliminación de Preservation Copies, Manifests o Metadata conforme a sus Retention Semantics diferenciadas.

---

# 50. Retrieval

Retrieval deberá respetar Authorization, Tenant, Classification, Integrity y Audit requirements. `Discoverable` no deberá significar `Retrievable`.

---

# 51. Restore

Restore deberá producir una copia o estado operacional controlado.

```text
Retrieved ≠ Restored
```

---

# 52. Restore Validation

Restore deberá validar Fixity, Format, Required Metadata y, cuando aplique, Semantic Usability antes de declarar Success.

---

# 53. Restore Safety

Restore no deberá reintroducir Data cuya Retention haya expirado o que haya sido dispuesto posteriormente. ENG-092 será autoritativo sobre Disposal Tombstones y suppression.

---

# 54. Archive Availability

Availability representa capacidad de acceder al Archive conforme a SLO aplicable. Un Archive podrá priorizar Durability sobre baja latencia.

---

# 55. Archive Reliability

Reliability deberá considerar Ingest, Storage, Verification, Retrieval y Restore, no únicamente Storage Uptime.

---

# 56. Archive Durability

Durability representa probabilidad de conservar Data correctamente a largo plazo.

```text
Durability ≠ Availability
```

---

# 57. Security

ENG-024 será autoridad. Archive deberá aplicar Least Privilege, Encryption, Key Management, Segregation y Tamper Protection según Risk.

---

# 58. Authorization

ENG-046 será autoridad. Deberán diferenciarse permisos para Ingest, Read Metadata, Retrieve Content, Restore, Migrate, Place Hold, Verify y Dispose.

---

# 59. Privacy

ENG-082 será autoridad. Archival no deberá utilizarse para evadir Purpose Limitation, Data Minimization o Maximum Retention.

---

# 60. Governance

ENG-081 será autoridad. Governance podrá definir Archive Owners, Custodians, Preservation Policies, Approved Formats, Verification Cadence y Exception Authorities.

---

# 61. Compliance

ENG-083 será autoridad. Archive podrá aportar Evidence, pero `Archived` no deberá equivaler automáticamente a `Compliant`.

---

# 62. Ethics

ENG-084 será autoridad. Long-term Preservation no deberá ampliar Purpose o uso autorizado del Data.

---

# 63. Trust

ENG-085 será autoridad. Trust podrá considerar Fixity History, Provenance, Custody, Verification, Provider Controls y Restore Evidence.

---

# 64. Multi-Tenancy

ENG-048 será autoridad. Tenant Context deberá preservarse en Ingest, Storage, Search, Retrieval, Restore, Verification y Disposal.

---

# 65. Catalog Integration

ENG-090 será autoridad. Catalog podrá registrar Archive Location References, Preservation State y Metadata autorizada sin convertirse en Archive Store.

---

# 66. Discovery & Classification Integration

ENG-091 será autoridad. Classification deberá preservarse con Version y Source cuando afecte Access, Retention o Preservation Controls.

---

# 67. Data Product Integration

ENG-086 será autoridad. Product Retirement podrá iniciar Archival Evaluation, pero no deberá determinar automáticamente Archive Retention.

---

# 68. Exchange & Federation Integration

ENG-087/088 serán autoridades en sus dominios. Materialized or received Data archivado deberá conservar Source, Contract y Provenance suficientes.

---

# 69. Portability Integration

ENG-094 será autoridad. Preservation Packages exportados deberán mantener Identity, Manifest, Metadata, Fixity y Provenance suficientes.

---

# 70. Synchronization Integration

ENG-095 será autoridad. Archive no deberá sincronizar silenciosamente cambios operacionales sobre Preservation Objects considerados immutable.

---

# 71. Distribution Integration

ENG-098 será autoridad. Placement de Archive Copies deberá conservar Inventory y Failure Domain Awareness.

---

# 72. Localization & Residency Integration

ENG-099 será autoridad. Archive Copies, Metadata, Evidence y Encryption Keys deberán cumplir restricciones de Location/Residency aplicables.

---

# 73. Lifecycle Orchestration Integration

ENG-100 podrá orquestar Eligibility, Ingest, Verification, Migration, Retrieval y Disposal. ENG-093 seguirá siendo autoritativo sobre Archival & Preservation Semantics.

---

# 74. Preservation Verification

Verification deberá ejecutarse según Policy o Risk. Podrá incluir Fixity, Package Completeness, Replica Health, Metadata Integrity y Format Readability.

---

# 75. Preservation Audit

Audit deberá poder revisar Policies, Actions, Evidence, Exceptions, Migrations, Access y Verification History sin requerir acceso indiscriminado al Payload.

---

# 76. Preservation Evidence

Evidence deberá ser suficiente para demostrar qué fue preservado, cuándo, bajo qué Policy, con qué Fixity, qué acciones ocurrieron y qué Verification resultó.

---

# 77. Observability

ENG-025 será autoridad general. Metrics podrán incluir:

```text
mef.data_archive.ingest.total
mef.data_archive.ingest.failed.total
mef.data_archive.object.total
mef.data_archive.fixity.failed.total
mef.data_archive.verification.total
mef.data_archive.verification.failed.total
mef.data_archive.migration.total
mef.data_archive.retrieve.total
mef.data_archive.restore.total
mef.data_archive.restore.failed.total
mef.data_archive.copy.unhealthy.total
mef.data_archive.format.risk.total
```

---

# 78. Metric Labels

Podrán incluir `objectType`, `format`, `state`, `result`, `failureType`, `copyType` y `verificationType` con Cardinality controlada. ObjectId, TenantId o sensitive paths no deberán utilizarse indiscriminadamente.

---

# 79. Logging

Logging deberá evitar Payload, Secrets, Credentials, Encryption Keys y Personal Data innecesarios. Logs de Archive no deberán convertirse en copias no gobernadas del contenido preservado.

---

# 80. Diagnostics

Deberá poder responder:

```text
which archive?
which package?
which object?
which source asset?
which format?
which manifest?
which fixity?
which copies?
which locations?
which policy?
which retention?
which hold?
which provenance?
which migration?
which verification?
which tenant?
which classification?
which restore?
which failures?
```

---

# 81. Modelos Conceptuales

```text
PreservationPackage
├── id
├── sourceAsset
├── objects
├── manifest
├── metadata
├── fixity
├── provenance
├── policy
└── state
```

```text
PreservationObject
├── id
├── sourceIdentity
├── format
├── size
├── fixity
├── copies
├── classification
└── metadata
```

```text
PreservationVerification
├── id
├── object
├── type
├── baseline
├── observed
├── result
└── verifiedAt
```

---

# 82. Archive Runtime

Conceptualmente:

```text
DataArchiveRuntime
├── evaluate
├── ingest
├── validate
├── accept
├── preserve
├── verify
├── migrate
├── retrieve
├── restore
├── dispose
├── observe
└── diagnose
```

---

# 83. Registry Integration

ENG-020 podrá registrar:

```text
archive providers
preservation formats
fixity algorithms
migration providers
verification providers
archive policies
```

---

# 84. Validation Integration

ENG-036 podrá validar:

```text
archive contract
package
manifest
object identity
format
metadata
fixity
retention
hold
migration
verification
restore state
```

---

# 85. Testing

ENG-009 será autoridad general.

Deberán existir pruebas para:

```text
archival eligibility
ingest validation
package completeness
manifest validation
fixity capture
fixity verification
corruption detection
replica verification
format identification
format migration
normalization provenance
metadata preservation
hold behavior
retention integration
retrieval authorization
restore validation
restore safety
tenant isolation
residency
archive disposal
verification evidence
```

---

# 86. Architecture Test

Podrá impedir:

```text
archive treated as backup
archive treated as retention rule
preservation treated as replication
bit preservation treated as semantic preservation
submitted treated as accepted
accepted treated as preserved forever
fixity treated as authenticity
checksum treated as proof of origin
normalized copy treated as original
immutable treated as indestructible
immutable treated as permanently retained
content preserved treated as metadata preserved
discoverable treated as retrievable
retrieved treated as restored
durability treated as availability
archived treated as compliant
archive used to bypass privacy or maximum retention
```

---

# 87. Build Integration

ENG-012 podrá validar:

```text
archive contracts
accepted formats
required metadata
fixity algorithms
replication requirements
verification cadence
retention references
residency constraints
restore requirements
```

---

# 88. CLI

ENG-007 podrá proporcionar:

```text
mef data-archive
mef data-archive:evaluate
mef data-archive:ingest
mef data-archive:show
mef data-archive:verify
mef data-archive:migrate
mef data-archive:retrieve
mef data-archive:restore
mef data-archive:copies
mef data-archive:diagnose
```

---

# 89. Error Namespace

ENG-093 utilizará:

```text
MEF-DATA-ARCHIVE-xxx
```

Taxonomía inicial:

```text
MEF-DATA-ARCHIVE-001 Archive contract invalid
MEF-DATA-ARCHIVE-002 Archive scope invalid
MEF-DATA-ARCHIVE-003 Archive boundary invalid
MEF-DATA-ARCHIVE-004 Archive eligibility denied
MEF-DATA-ARCHIVE-005 Preservation package invalid
MEF-DATA-ARCHIVE-006 Preservation manifest invalid
MEF-DATA-ARCHIVE-007 Preservation object invalid
MEF-DATA-ARCHIVE-008 Archive ingest failed
MEF-DATA-ARCHIVE-009 Archive acceptance denied
MEF-DATA-ARCHIVE-010 Fixity unavailable
MEF-DATA-ARCHIVE-011 Fixity verification failed
MEF-DATA-ARCHIVE-012 Archive integrity violation
MEF-DATA-ARCHIVE-013 Archive authenticity uncertain
MEF-DATA-ARCHIVE-014 Archive provenance incomplete
MEF-DATA-ARCHIVE-015 Archive copy unhealthy
MEF-DATA-ARCHIVE-016 Preservation format unsupported
MEF-DATA-ARCHIVE-017 Preservation format at risk
MEF-DATA-ARCHIVE-018 Format migration failed
MEF-DATA-ARCHIVE-019 Archive metadata incomplete
MEF-DATA-ARCHIVE-020 Archive retention conflict
MEF-DATA-ARCHIVE-021 Archive hold active
MEF-DATA-ARCHIVE-022 Archive authorization denied
MEF-DATA-ARCHIVE-023 Archive privacy violation
MEF-DATA-ARCHIVE-024 Archive tenant violation
MEF-DATA-ARCHIVE-025 Archive residency violation
MEF-DATA-ARCHIVE-026 Archive retrieval failed
MEF-DATA-ARCHIVE-027 Archive restore failed
MEF-DATA-ARCHIVE-028 Archive verification failed
MEF-DATA-ARCHIVE-029 Archive state invalid
MEF-DATA-ARCHIVE-030 Archive invariant violation
```

---

# 90. First Implementation Components

La primera implementación deberá incluir:

```text
ArchiveId
ArchivePackageId
PreservationObjectId
DataArchiveContract
PreservationPackage
PreservationObject
PreservationManifest
PreservationFormat
FixityRecord
ArchiveCopy
PreservationVerification
ArchiveState
DataArchiveRuntime
DataArchiveError
```

---

# 91. Optional Initial Components

Podrán incorporarse:

```text
ArchivePolicy
FormatRiskAssessment
FormatMigration
ChainOfCustody
PreservationAudit
ArchiveDiagnostics
```

---

# 92. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Format Migration Network
Cross-Provider Preservation Federation
Cryptographic Preservation Ledger
Continuous Semantic Preservation Analysis
AI-Assisted Format Risk Detection
AI-Assisted Preservation Planning
```

---

# 93. Estructura Conceptual

```text
src/
└── DataArchive/
    ├── Identity/
    │   ├── ArchiveId
    │   ├── ArchivePackageId
    │   └── PreservationObjectId
    ├── Contract/
    │   └── DataArchiveContract
    ├── Package/
    │   ├── PreservationPackage
    │   └── PreservationManifest
    ├── Object/
    │   └── PreservationObject
    ├── Format/
    │   ├── PreservationFormat
    │   └── FormatMigration
    ├── Fixity/
    │   └── FixityRecord
    ├── Copy/
    │   └── ArchiveCopy
    ├── Verification/
    │   └── PreservationVerification
    ├── State/
    │   └── ArchiveState
    ├── Runtime/
    │   └── DataArchiveRuntime
    ├── Diagnostics/
    │   └── DataArchiveDiagnostics
    └── Error/
        └── DataArchiveError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 94. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Archive Identity
Explicit Package/Object Identity
Archival Eligibility
Package Manifest
Fixity Capture
Fixity Verification
Integrity
Provenance
Accepted Formats
Format Risk
Preservation Metadata
Archive Copies
Retention/Hold Integration
Retrieval Authorization
Restore Validation
Restore Safety
Tenant Isolation
Residency
Observability
Testing
```

---

# 95. First Version Non-Goals

No deberá requerir inicialmente:

```text
Universal Preservation Network
Automatic Global Format Migration
Cryptographic Preservation Ledger
Universal Semantic Emulation
Cross-Organization Archive Federation
AI-Assisted Preservation Planning
```

---

# 96. Invariantes de Ingeniería

ENG-093 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1806 | Todo Archive material deberá declarar Identity, Scope, Boundary, Contract, Policy, Package/Object Identity, Preservation Metadata y Lifecycle suficientes para que su custodia no dependa de conocimiento implícito. |
| EI-1807 | Data Archival, Backup, Retention, Replication y Preservation deberán permanecer diferenciados y ninguna de estas capacidades deberá utilizarse como sustituto universal de las demás. |
| EI-1808 | Bit Preservation, Logical Preservation, Semantic Preservation y Evidence Preservation deberán conservar Semantics diferenciadas y la conservación íntegra de bytes no deberá presentarse automáticamente como preservación de significado o usabilidad. |
| EI-1809 | Submitted, Validated, Accepted, Preserved, Retrieved, Restored y Disposed deberán permanecer como estados o acciones diferenciadas y ninguna transición deberá inferirse únicamente por presencia física de Data. |
| EI-1810 | Todo Preservation Package material deberá preservar Manifest, Object Identities, Source Relationships, Metadata, Fixity, Provenance, Policy y Creation Context suficientes para verificar su contenido y origen. |
| EI-1811 | Fixity, Integrity y Authenticity deberán permanecer diferenciadas y un Checksum coincidente no deberá presentarse por sí solo como prueba de origen, autenticidad o custodia legítima. |
| EI-1812 | Provenance y Chain of Custody deberán preservar eventos materiales de Origin, Ingest, Transformation, Migration, Custody y Verification sin reescribir silenciosamente Historical Evidence. |
| EI-1813 | Preservation Format, Format Identification, Format Risk, Normalization y Format Migration deberán ser explícitos y toda transformación deberá conservar relación verificable entre Source y Target. |
| EI-1814 | Original Copy y Normalized/Migrated Copy deberán permanecer diferenciadas y una transformación no deberá sobrescribir silenciosamente el Original cuando Policy, Evidence o Authenticity requieran preservarlo. |
| EI-1815 | Archive Copy, Preservation Replica, Geographic Copy, Offline Copy e Immutable Copy deberán declarar Purpose, Location/Failure Domain y State y multiplicidad de copias no deberá presentarse automáticamente como Preservation suficiente. |
| EI-1816 | Immutability deberá poseer Scope y Duration explícitos y no deberá interpretarse como indestructibilidad, conservación permanente o excepción a Retention/Disposal. |
| EI-1817 | Content, Technical/Descriptive/Administrative/Provenance Metadata y Preservation Evidence deberán poseer Preservation y Retention Semantics explícitas y preservar uno no deberá implicar automáticamente preservar todos los demás. |
| EI-1818 | Archive Retention, Holds y Disposal deberán obedecer ENG-092 y Archival no deberá utilizarse para evadir Maximum Retention, Purpose Limitation o una obligación válida de Disposal. |
| EI-1819 | Retrieval, Restore y Restore Validation deberán permanecer diferenciados y ningún Restore deberá declararse exitoso sin verificar Fixity, Required Metadata y Usability aplicable ni reintroducir Data previamente dispuesto. |
| EI-1820 | Archive Availability, Reliability y Durability deberán permanecer diferenciadas y alta Durability no deberá presentarse automáticamente como alta Availability o baja Retrieval Latency. |
| EI-1821 | Archive Security, Privacy, Governance, Compliance, Ethics, Authorization, Trust y Multi-Tenancy deberán preservarse durante Ingest, Storage, Verification, Migration, Retrieval, Restore y Disposal sin redefinir las autoridades de sus ENG correspondientes. |
| EI-1822 | Archive Copies, Preservation Metadata, Evidence y Encryption/Key dependencies deberán respetar Localization & Residency y ninguna estrategia de Geographic Diversity deberá violar ENG-099. |
| EI-1823 | Preservation Verification deberá detectar y representar explícitamente Corruption, Missing Copies, Metadata Failure, Format Risk y Verification Failure y ningún resultado fallido o desconocido deberá convertirse silenciosamente en Healthy. |
| EI-1824 | Archive Observability, Diagnostics, Audit y Testing deberán permitir reconstruir Archive, Package, Object, Source Asset, Format, Manifest, Fixity, Copies, Locations, Policy, Retention, Holds, Provenance, Migrations, Verification, Tenant, Classification, Restore y Failures sin exponer Payload innecesariamente. |
| EI-1825 | La primera implementación deberá priorizar Archive/Package/Object Identity, Eligibility, Manifest, Fixity, Integrity, Provenance, Accepted Formats, Format Risk, Preservation Metadata, Archive Copies, Retention/Hold Integration, Retrieval Authorization, Restore Validation/Safety, Tenant Isolation, Residency, Observability y Testing antes de introducir Universal Preservation Networks, Automatic Global Migration o AI-Assisted Preservation Planning. |

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
```

---

# 98. Criterios de Conformidad

Una implementación será conforme con ENG-093 cuando:

- modele Archive, Package y Preservation Object Identity;
- determine Archival Eligibility;
- valide Ingest y Package Manifest;
- capture y verifique Fixity;
- preserve Integrity, Provenance y Custody cuando aplique;
- identifique Preservation Formats y Format Risk;
- preserve Original/Normalized/Migrated relationships;
- gestione Archive Copies y Failure Domains;
- preserve Technical, Descriptive, Administrative y Provenance Metadata;
- integre Retention, Holds y Disposal con ENG-092;
- diferencie Retrieval y Restore;
- valide Restore y Restore Safety;
- preserve Security, Privacy, Tenant Isolation y Residency;
- implemente Preservation Verification, Audit, Observability, Diagnostics y Testing.

---

# 99. Riesgos

Deberán evitarse especialmente:

```text
Archive Equals Backup
Archive Equals Retention
Preservation Equals Replication
Bit Preservation Equals Semantic Preservation

Submitted Equals Accepted
Accepted Equals Preserved Forever

Fixity Equals Authenticity
Checksum Equals Proof of Origin

Normalized Copy Equals Original
Migrated Copy Replaces Original Silently

Multiple Copies Equals Preservation
Immutable Equals Indestructible
Immutable Equals Permanent Retention

Content Preserved Equals Metadata Preserved
Archived Equals Exempt from Disposal

Discoverable Equals Retrievable
Retrieved Equals Restored

Durability Equals Availability
Archived Equals Compliant

Archive Bypasses Privacy
Archive Bypasses Residency
Restore Reintroduces Disposed Data
```

---

# 100. Relación con ENG-092

ENG-092 gobierna **Data Retention & Disposal Engineering**.

```text
ENG-092
RETENTION & DISPOSAL
│
└── Determines how long Data may/must remain
    and how Disposal is executed and verified.

ENG-093
ARCHIVAL & PRESERVATION
│
└── Preserves authorized Data and Evidence
    across long-term lifecycle.
```

ENG-093 no podrá convertir Archive en excepción automática a Retention o Disposal.

Cuando exista conflicto conceptual sobre duración, Holds, Eligibility o Disposal, **ENG-092 será autoritativo**.

---

# 101. Relación con ENG-094

ENG-094 formaliza **Data Portability Engineering**.

La frontera será:

```text
ENG-093
ARCHIVAL & PRESERVATION
│
└── How is Data preserved over time?

ENG-094
DATA PORTABILITY
│
└── How is Data exported, transferred
    or moved in a usable governed form?
```

Un Preservation Package podrá ser portable, pero Preservation y Portability deberán permanecer diferenciadas.

ENG-094 deberá continuar la serie global en **EI-1826 → EI-1845**.

---

# 102. Principio Rector

> **MEF deberá preservar Data de forma demostrable, no meramente almacenarlo: un Archive confiable deberá conservar Identity, Integrity, Provenance, Metadata, Interpretability y Evidence suficientes durante el periodo autorizado, verificar periódicamente que siguen siendo válidos y permitir Retrieval, Restore o Disposal sin borrar la historia necesaria para explicar qué ocurrió.**

---

# 103. Conclusión

**ENG-093 — Data Archival & Preservation Engineering** formaliza la custodia y preservación de largo plazo dentro de MEF.

```text
ACTIVE DATA
    │
    ▼
ARCHIVAL ELIGIBILITY
    │
    ▼
PRESERVATION PACKAGE
    │
    ├── Objects
    ├── Manifest
    ├── Metadata
    ├── Fixity
    └── Provenance
    │
    ▼
ARCHIVE
    │
    ├── Copies
    ├── Verification
    ├── Format Management
    ├── Retention / Holds
    └── Security / Residency
    │
    ▼
RETRIEVE / RESTORE / DISPOSE
```

Las separaciones esenciales quedan:

```text
ARCHIVE ≠ BACKUP
ARCHIVE ≠ RETENTION
PRESERVATION ≠ REPLICATION

BIT PRESERVATION ≠ SEMANTIC PRESERVATION
FIXITY ≠ AUTHENTICITY
CHECKSUM ≠ PROOF OF ORIGIN

NORMALIZED COPY ≠ ORIGINAL COPY
IMMUTABLE ≠ PERMANENTLY RETAINED

RETRIEVED ≠ RESTORED
DURABILITY ≠ AVAILABILITY
ARCHIVED ≠ COMPLIANT
```

Con **ENG-093**, la serie global alcanza:

```text
EI-1825
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
- ENG-091 — Data Discovery & Classification Engineering
- ENG-092 — Data Retention & Disposal Engineering
- ENG-094 — Data Portability Engineering
- ENG-095 — Data Synchronization Engineering
- ENG-096 — Data Replication Engineering
- ENG-097 — Data Partitioning & Sharding Engineering
- ENG-098 — Data Distribution Engineering
- ENG-099 — Data Localization & Residency Engineering
- ENG-100 — Data Lifecycle Orchestration Engineering
