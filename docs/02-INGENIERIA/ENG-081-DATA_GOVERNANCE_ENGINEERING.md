---
id: ENG-081
titulo: Data Governance Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Governance Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11
dependencias:
  - ENG-005
  - ENG-009
  - ENG-012
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-034
  - ENG-035
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-051
  - ENG-053
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-079
  - ENG-080
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-011
  - ENG-013
  - ENG-014
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-029
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-036
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-049
  - ENG-050
  - ENG-052
  - ENG-054
  - ENG-055
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-066
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
  - ENG-082
keywords:
  - data-governance
  - governance
  - data-ownership
  - data-stewardship
  - data-domain
  - data-product
  - data-catalog
  - data-inventory
  - business-glossary
  - data-classification
  - sensitivity
  - data-policy
  - retention
  - deletion
  - data-access
  - data-sharing
  - data-residency
  - data-sovereignty
  - purpose-limitation
  - data-minimization
  - lineage-governance
  - master-data
  - reference-data
  - data-contract
  - policy-enforcement
  - mef
---

# ENG-081

# Data Governance Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Governance Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-081 establece las reglas para:

```text
Data Governance

Governance Requirement
Governance Objective
Governance Policy

Data Asset
Data Domain
Data Product

Data Ownership
Data Owner
Data Stewardship
Data Steward

Technical Custodian
Data Consumer
Data Producer

Governance Authority
Accountability
Responsibility

Data Inventory
Data Catalog

Data Definition
Business Glossary
Canonical Definition

Data Classification
Sensitivity Classification
Criticality Classification

Data Policy

Lifecycle Governance
Creation Governance
Usage Governance
Retention Governance
Archival Governance
Deletion Governance
Disposal Governance

Access Governance
Sharing Governance
Disclosure Governance

Data Residency
Data Sovereignty
Jurisdiction

Purpose Limitation
Data Minimization

Lineage Governance
Provenance Governance

Reference Data Governance
Master Data Governance

Data Contract Governance
Data Product Governance

Policy Enforcement

Governance Control
Governance Gate

Governance Exception
Governance Waiver

Governance Review
Governance Evidence

Governance Drift
Governance Violation
Governance Incident

Governance Security
Governance Audit
Governance Observability
Governance Testing
```

---

# 2. Declaración

> **Todo Data Asset gobernado por MEF deberá poseer Ownership, Classification, Purpose, Lifecycle y Policies suficientemente explícitos para determinar quién posee autoridad sobre él, quién puede utilizarlo, para qué puede utilizarse, dónde puede residir, cómo puede compartirse y durante cuánto tiempo deberá conservarse. La existencia técnica de acceso a Data no deberá interpretarse como autorización de Governance para utilizarlo.**

Arquitectura conceptual:

```text
DATA ASSET
    │
    ▼
IDENTIFY
    │
    ▼
CLASSIFY
    │
    ▼
ASSIGN OWNERSHIP
    │
    ▼
DEFINE PURPOSE
    │
    ▼
DEFINE POLICIES
    │
    ▼
ENFORCE
    │
    ▼
MONITOR
    │
    ▼
REVIEW
```

---

# 3. Data Governance Engineering

Data Governance Engineering responde:

```text
What data do we have?
What does it mean?
Who owns it?
Who stewards it?
Who produces it?
Who consumes it?

How sensitive is it?
How critical is it?

Why is it collected?
For what purposes may it be used?
Who may access it?
Who may share it?

Where may it reside?
Which jurisdictions apply?

How long must it be retained?
When must it be deleted?

Which source is authoritative?
Which definition is canonical?

Which policies govern it?
How are policies enforced?

Which exceptions exist?
Who approved them?
When do they expire?

Can governance decisions be audited?
```

---

# 4. Data Governance

`Data Governance` representa el sistema de:

```text
authority
accountability
ownership
stewardship
policies
controls
decision rights
evidence
```

utilizado para gobernar Data durante su Lifecycle.

---

# 5. Governance ≠ Management

Governance define:

```text
who decides?
under which policy?
with which authority?
```

Management ejecuta operaciones dentro de ese marco.

---

# 6. Governance ≠ Security

Security protege Data frente a:

```text
unauthorized access
tampering
disclosure
attack
```

Governance determina además:

```text
whether an otherwise technically
authorized use is permitted
for a particular purpose
```

---

# 7. Governance ≠ IAM

IAM responde:

```text
who are you?
what permissions do you have?
```

Data Governance responde:

```text
should this data be used
for this purpose under
the applicable policy?
```

---

# 8. Governance ≠ Compliance

Compliance evalúa conformidad respecto de obligaciones aplicables.

Governance proporciona parte del sistema mediante el cual dichas obligaciones pueden implementarse y demostrarse.

---

# 9. Governance ≠ Data Quality

ENG-080:

```text
Is data fit for purpose?
```

ENG-081:

```text
Who has authority over the data
and under what policies may
it be used?
```

---

# 10. Governance ≠ Data Integrity

ENG-079 determina si State satisface Integrity Rules.

ENG-081 determina Authority y Policy sobre ese State.

---

# 11. Governance Requirement

Todo Governance Requirement contractual deberá declarar cuando corresponda:

```text
scope
asset
domain
owner
steward
classification
purpose
policies
controls
retention
residency
sharing
exceptions
evidence
review
```

---

# 12. Governance Requirement Example

```text
Asset:
Customer Contact Data

Domain:
Customer

Owner:
Customer Domain Owner

Steward:
Customer Data Steward

Classification:
CONFIDENTIAL

Purpose:
Customer account servicing

Retention:
Contract-defined lifecycle

Sharing:
Approved processors only

Residency:
Allowed regions according
to applicable policy

Review:
Annual or upon material change
```

---

# 13. Vague Governance Requirement

No deberá utilizarse como Contract:

```text
protect customer data
use responsibly
keep only as necessary
restrict sensitive data
govern appropriately
```

sin Scope y Rules verificables.

---

# 14. Governance Scope

Podrá aplicarse a:

```text
field
record
entity
aggregate
table
dataset
stream
event
file
document
database
data product
domain
tenant
system
```

---

# 15. Data Asset

Representa Data con:

```text
identity
meaning
ownership
value
risk
lifecycle
```

suficientes para ser gobernado.

---

# 16. Data Asset Identifier

Todo Asset gobernado deberá poseer Identity estable dentro del Governance Scope.

---

# 17. Asset Metadata

Podrá incluir:

```text
id
name
description
domain
owner
steward
producer
consumers
classification
criticality
purpose
location
retention
lineage
quality status
```

---

# 18. Asset Registration

Data crítico deberá registrarse antes de convertirse en dependencia operacional significativa cuando sea viable.

---

# 19. Shadow Data Asset

Data relevante no registrado constituye Governance Risk.

---

# 20. Data Domain

Agrupa Data según contexto y Ownership semántico.

Ejemplos:

```text
Customer
Identity
Billing
Payments
Orders
Inventory
Workforce
```

---

# 21. Domain Ownership

Todo Domain crítico deberá poseer Owner identificable.

---

# 22. Domain Boundary

Deberá ser suficientemente clara para evitar Ownership ambiguo.

---

# 23. Shared Data

No deberá implicar:

```text
shared ownership by everyone
```

sin Accountability definida.

---

# 24. Data Product

Representa Data publicado para Consumers mediante Contract explícito.

---

# 25. Data Product Governance

Podrá declarar:

```text
owner
producer
consumers
schema
quality
freshness
classification
access policy
lifecycle
version
```

---

# 26. Data Product ≠ Raw Dataset Automatically

No todo Dataset constituye un Data Product.

---

# 27. Data Ownership

Define Accountability sobre decisiones de Governance de un Asset o Domain.

---

# 28. Data Owner

Deberá poseer Authority suficiente para:

```text
approve policy
approve purpose
approve sharing
approve exceptions
assign stewardship
approve lifecycle rules
```

según Scope.

---

# 29. Owner ≠ Database Administrator

Technical Custody no implica Business Ownership.

---

# 30. Owner ≠ Data Creator Automatically

Crear Data no otorga Authority permanente sobre Governance.

---

# 31. Ownership Scope

Deberá ser explícito.

---

# 32. Multiple Owners

Deberán evitarse cuando generen decisiones contradictorias.

---

# 33. Joint Ownership

Solo deberá utilizarse con Decision Rules claras.

---

# 34. Orphan Data Asset

Asset sin Owner identificable deberá considerarse Governance Violation cuando requiera Governance.

---

# 35. Data Stewardship

Representa responsabilidad operacional sobre la aplicación cotidiana de Governance.

---

# 36. Data Steward

Podrá responsabilizarse de:

```text
definitions
catalog metadata
quality coordination
classification maintenance
issue triage
policy interpretation
governance review
```

---

# 37. Owner ≠ Steward

```text
OWNER
→ accountability / decision authority

STEWARD
→ operational governance responsibility
```

---

# 38. Technical Custodian

Administra infraestructura o mecanismos técnicos que almacenan/procesan Data.

---

# 39. Custodian ≠ Owner

No deberá decidir unilateralmente Purpose o Retention salvo Authority explícita.

---

# 40. Data Producer

Produce o publica Data.

---

# 41. Producer Responsibility

Deberá cumplir:

```text
data contract
classification
quality expectations
provenance
policy obligations
```

---

# 42. Data Consumer

Consume Data para un Purpose determinado.

---

# 43. Consumer Responsibility

No deberá:

```text
reuse outside approved purpose
bypass classification
retain beyond policy
redistribute without authority
```

---

# 44. Governance Authority

Define quién puede tomar una Governance Decision.

---

# 45. Authority Scope

Deberá declarar:

```text
asset/domain
decision type
conditions
limits
```

---

# 46. Delegated Authority

Podrá existir con Scope y Expiration explícitos.

---

# 47. Accountability

No deberá diluirse mediante Delegation.

---

# 48. Decision Rights

Podrán incluir:

```text
classify
approve access
approve purpose
approve sharing
approve retention
approve deletion
approve exception
```

---

# 49. Data Inventory

Representa registro de Assets conocidos.

---

# 50. Inventory Objective

Deberá permitir responder:

```text
what data exists?
where?
who owns it?
what system contains it?
```

---

# 51. Inventory ≠ Catalog

Inventory enfatiza:

```text
existence
location
ownership
```

Catalog añade mayor contexto semántico y operacional.

---

# 52. Data Catalog

Podrá incluir:

```text
definition
domain
owner
steward
classification
lineage
quality
schema
consumers
contracts
```

---

# 53. Catalog ≠ Source of Truth Automatically

El Catalog describe Governance Metadata.

No sustituye necesariamente la Source operacional del Data.

---

# 54. Catalog Registration

Podrá ser:

```text
manual
declarative
discovered
hybrid
```

---

# 55. Automatic Discovery

No deberá asignar automáticamente significado, Ownership o Purpose sin evidencia suficiente.

---

# 56. Catalog Drift

Metadata del Catalog puede quedar desactualizada respecto de Systems reales.

---

# 57. Catalog Verification

Deberá existir para Assets críticos.

---

# 58. Data Definition

Describe significado de Data.

---

# 59. Business Glossary

Mantiene términos relevantes del negocio.

---

# 60. Glossary Entry

Podrá contener:

```text
term
canonical definition
domain
owner
synonyms
status
effective version
```

---

# 61. Canonical Definition

Deberá existir cuando múltiples Systems utilicen un concepto compartido crítico.

---

# 62. Same Name ≠ Same Meaning

Campos llamados:

```text
status
customer
amount
date
```

no deberán asumirse semánticamente equivalentes.

---

# 63. Same Meaning ≠ Same Name

Sinónimos deberán poder relacionarse.

---

# 64. Definition Conflict

Deberá resolverse mediante Governance Authority.

---

# 65. Semantic Ownership

Todo término crítico deberá asociarse con Domain/Authority apropiados.

---

# 66. Data Classification

Asigna categorías que determinan Governance Controls.

---

# 67. Classification Dimensions

Podrán incluir:

```text
sensitivity
criticality
regulatory relevance
business value
sharing restriction
```

---

# 68. Sensitivity Classification

Una taxonomía inicial podrá incluir:

```text
PUBLIC
INTERNAL
CONFIDENTIAL
RESTRICTED
```

---

# 69. Classification Taxonomy

Deberá ser configurable y gobernada.

---

# 70. PUBLIC

No implica ausencia de Integrity, Licensing u otras restricciones.

---

# 71. INTERNAL

No deberá exponerse externamente por defecto.

---

# 72. CONFIDENTIAL

Requiere controles reforzados de acceso y sharing.

---

# 73. RESTRICTED

Requiere controles máximos definidos por Policy.

---

# 74. Criticality Classification

Podrá incluir:

```text
LOW
MEDIUM
HIGH
CRITICAL
```

---

# 75. Sensitivity ≠ Criticality

Data puede ser:

```text
low sensitivity
high operational criticality
```

o:

```text
high sensitivity
low operational criticality
```

---

# 76. Classification Inheritance

Derived Data deberá heredar o recalcular Classification según Policy.

---

# 77. Transformation Does Not Automatically Declassify

Cambiar formato no elimina Sensitivity.

---

# 78. Aggregation

Puede reducir o aumentar Risk según Context.

---

# 79. Declassification

Deberá requerir Authority y Evidence.

---

# 80. Classification Unknown

No deberá tratarse automáticamente como PUBLIC.

---

# 81. Default Classification

Deberá favorecer una postura segura conforme a Policy.

---

# 82. Classification Metadata

Deberá acompañar Assets cuando sea necesario para Enforcement.

---

# 83. Data Policy

Define reglas obligatorias de Governance.

---

# 84. Policy Scope

Podrá aplicarse a:

```text
domain
classification
asset
tenant
jurisdiction
purpose
consumer
```

---

# 85. Policy Structure

Conceptualmente:

```text
DataPolicy
├── id
├── scope
├── authority
├── conditions
├── obligations
├── prohibitions
├── controls
├── exceptions
├── effectiveFrom
└── version
```

---

# 86. Policy Versioning

Toda Policy contractual deberá versionarse.

---

# 87. Policy Effective Time

Deberá distinguir:

```text
publishedAt
effectiveFrom
retiredAt
```

cuando corresponda.

---

# 88. Retroactive Policy

No deberá asumirse sin Requirement explícito.

---

# 89. Policy Conflict

Deberá resolverse mediante Precedence Rules.

---

# 90. Policy Precedence

Deberá ser determinista.

---

# 91. More Restrictive Rule

Podrá prevalecer cuando la Governance Model lo establezca explícitamente.

---

# 92. Policy Ambiguity

Deberá producir:

```text
DENY
REVIEW
UNKNOWN
```

según Risk Policy.

---

# 93. Lifecycle Governance

Gobierna Data desde creación hasta eliminación.

```text
CREATE
  │
  ▼
STORE
  │
  ▼
USE
  │
  ▼
SHARE
  │
  ▼
ARCHIVE
  │
  ▼
DELETE
  │
  ▼
DISPOSE
```

---

# 94. Creation Governance

Podrá definir:

```text
allowed source
required metadata
classification
purpose
provenance
```

---

# 95. Collection Purpose

Deberá ser explícito cuando Policy lo requiera.

---

# 96. Purpose Limitation

Data recolectado para Purpose A no deberá utilizarse automáticamente para Purpose B.

---

# 97. Purpose Identifier

Podrá utilizar Identity estable.

Ejemplo:

```text
CUSTOMER_SUPPORT
BILLING
FRAUD_PREVENTION
ANALYTICS
```

---

# 98. Purpose Compatibility

Podrá existir Policy para determinar si Secondary Purpose es compatible.

---

# 99. Purpose Unknown

No deberá autorizar automáticamente Processing sensible.

---

# 100. Purpose Change

Deberá reevaluar:

```text
authority
classification
access
retention
sharing
```

---

# 101. Data Minimization

Solo deberá recopilarse, procesarse o conservarse Data necesario para Purpose autorizado cuando Policy lo requiera.

---

# 102. More Data ≠ Better Governance

La acumulación innecesaria incrementa Risk.

---

# 103. Minimization Review

Podrá detectar:

```text
unused fields
redundant copies
unnecessary historical data
unused exports
```

---

# 104. Storage Limitation

Retention deberá corresponder a Purpose y obligaciones aplicables.

---

# 105. Retention Governance

Define cuánto tiempo debe conservarse Data.

---

# 106. Retention Rule

Deberá declarar:

```text
scope
trigger
duration
action
exceptions
authority
```

---

# 107. Retention Trigger

Ejemplos:

```text
createdAt
contractEndedAt
accountClosedAt
lastActivityAt
eventOccurredAt
```

---

# 108. Retention Duration

No deberá interpretarse sin Trigger.

---

# 109. Retention State

Podrá incluir:

```text
ACTIVE
RETENTION_PENDING
HOLD
ARCHIVED
DELETION_DUE
DELETED
```

---

# 110. Legal/Business Hold

Podrá suspender eliminación cuando una Policy aplicable lo requiera.

---

# 111. Hold Scope

Deberá ser preciso.

---

# 112. Hold Expiration

Deberá revisarse.

---

# 113. Indefinite Hold

No deberá utilizarse por conveniencia sin Authority.

---

# 114. Retention Conflict

Deberá resolverse mediante Governance Rules explícitas.

---

# 115. Archive

No elimina obligaciones de Governance.

---

# 116. Archived Data

Deberá continuar sujeto a:

```text
classification
access
retention
security
deletion
```

---

# 117. Deletion Governance

Define cuándo y cómo Data deberá eliminarse.

---

# 118. Logical Delete ≠ Physical Deletion

Deberán distinguirse.

---

# 119. Deletion Scope

Podrá incluir:

```text
primary store
replicas
cache
search index
derived stores
exports
backups
```

según Policy y capacidad técnica.

---

# 120. Derived Data Deletion

Deberá evaluarse mediante Lineage.

---

# 121. Deletion Evidence

Podrá registrar:

```text
asset
scope
policy
requestedAt
executedAt
result
exceptions
```

sin conservar innecesariamente el contenido eliminado.

---

# 122. Deletion Verification

Deberá existir para Data crítico cuando sea requerida.

---

# 123. Cryptographic Erasure

Podrá utilizarse cuando Architecture/Policy lo permitan.

---

# 124. Backup Deletion

Deberá seguir Policy compatible con Recoverability/Durability.

---

# 125. Governance vs Recovery Conflict

Retention/Deletion y Recovery deberán coordinarse explícitamente.

---

# 126. Access Governance

Determina bajo qué condiciones Data puede ser accedido.

---

# 127. Access Governance ≠ Authorization Engine

ENG-046 ejecuta Authorization.

ENG-081 define parte de las Policies que deberán informar esa decisión.

---

# 128. Access Decision Context

Podrá considerar:

```text
identity
role
tenant
asset
classification
purpose
jurisdiction
time
device
environment
```

según Policy.

---

# 129. Least Privilege

Deberá aplicarse conforme ENG-024/046.

---

# 130. Need to Know

Podrá ser Governance Condition.

---

# 131. Access Review

Deberá realizarse periódicamente para Data crítico.

---

# 132. Stale Access

Permisos que ya no corresponden al Purpose/Role deberán revocarse.

---

# 133. Sharing Governance

Controla transferencia de Data entre:

```text
services
domains
tenants
organizations
partners
jurisdictions
```

---

# 134. Sharing Requirement

Podrá declarar:

```text
sender
recipient
asset
purpose
classification
contract
jurisdiction
retention
security
```

---

# 135. Internal Sharing ≠ Automatically Allowed

Mover Data entre Systems internos también puede requerir Governance.

---

# 136. External Sharing

Deberá requerir Controls apropiados.

---

# 137. Redistribution

Consumer no deberá redistribuir Data salvo Policy explícita.

---

# 138. Data Export

Deberá considerarse Sharing.

---

# 139. Bulk Export

Deberá recibir controles reforzados para Data sensible.

---

# 140. Data Residency

Define ubicaciones permitidas para almacenar/procesar Data.

---

# 141. Residency Scope

Podrá aplicarse a:

```text
country
region
cloud region
data center
jurisdiction
```

---

# 142. Residency ≠ Sovereignty

Residency:

```text
where is data physically/logically hosted?
```

Sovereignty:

```text
which legal/governance authority
may apply to it?
```

---

# 143. Data Sovereignty

Deberá modelarse cuando sea relevante.

---

# 144. Jurisdiction

Podrá derivarse de múltiples factores y no deberá inferirse únicamente de Storage Location.

---

# 145. Cross-Border Transfer

Deberá evaluarse según Policy aplicable.

---

# 146. Replication Residency

Replicas deberán cumplir Residency Policy.

---

# 147. Backup Residency

Backups también deberán cumplir Governance Requirements.

---

# 148. Observability Data Residency

Logs, Traces y Metrics pueden contener Data gobernado.

---

# 149. Derived Metadata

No deberá asumirse no sensible.

---

# 150. Lineage Governance

Determina qué Lineage deberá capturarse, conservarse y protegerse.

---

# 151. Lineage Requirement

Podrá depender de:

```text
criticality
sensitivity
regulatory relevance
data product importance
```

---

# 152. Provenance Governance

Determina qué información de origen deberá conservarse.

---

# 153. Provenance Sensitivity

Provenance puede revelar:

```text
identity
system topology
source names
business relationships
```

y deberá protegerse.

---

# 154. Lineage Access

No deberá ser universal por defecto.

---

# 155. Reference Data Governance

Deberá definir:

```text
authority
owner
version
publication
effective period
change process
```

---

# 156. Reference Data Example

```text
country codes
currencies
taxonomies
status definitions
product classifications
```

---

# 157. Reference Data Change

Puede afectar múltiples Domains.

---

# 158. Reference Data Publication

Deberá ser versionada cuando el cambio pueda alterar Semantics.

---

# 159. Master Data Governance

Gobierna Entities compartidas y sus Authorities.

---

# 160. Master Data Examples

```text
customer
supplier
product
employee
organization
location
```

---

# 161. Golden Record Governance

Deberá definir:

```text
identity
authority
survivorship
merge
split
conflict resolution
```

---

# 162. Golden Record ≠ Single Database Necessarily

Puede existir una representación autoritativa lógica.

---

# 163. Merge Governance

Semantic Merge deberá ser auditado cuando afecte Entities críticas.

---

# 164. Split Governance

Deberá existir capacidad de corregir False Merge cuando sea necesaria.

---

# 165. Data Contract Governance

ENG-021 proporciona Contract Engineering.

ENG-081 gobierna:

```text
ownership
approval
classification
purpose
quality obligations
compatibility obligations
lifecycle
```

de Data Contracts.

---

# 166. Data Contract Owner

Deberá ser identificable.

---

# 167. Contract Change

Deberá evaluar impacto sobre:

```text
consumers
quality
classification
lineage
retention
purpose
```

---

# 168. Contract Deprecation

No deberá eliminar obligaciones de Governance sobre Data histórico.

---

# 169. Policy Enforcement

Governance Policies deberán convertirse en controles cuando técnicamente sea posible y proporcional.

---

# 170. Enforcement Types

Podrán incluir:

```text
preventive
detective
corrective
manual
automated
```

---

# 171. Preventive Control

Evita Governance Violation.

Ejemplo:

```text
deny restricted export
```

---

# 172. Detective Control

Detecta violación posteriormente.

Ejemplo:

```text
unregistered data store discovered
```

---

# 173. Corrective Control

Ayuda a restaurar conformidad.

---

# 174. Manual Control

Podrá ser válido cuando Automation no sea razonable.

---

# 175. Control Evidence

Todo Control crítico deberá producir Evidence suficiente.

---

# 176. Policy as Code

Podrá utilizarse para Rules automatizables.

---

# 177. Policy as Code ≠ All Governance

Ownership, judgment, approval y excepciones pueden requerir procesos humanos.

---

# 178. Governance Gate

Podrá bloquear:

```text
new data source
new integration
new data product
external sharing
bulk export
migration
deployment
purpose change
```

---

# 179. Gate Decision

Podrá ser:

```text
ALLOW
DENY
REVIEW
ALLOW_WITH_CONDITIONS
UNKNOWN
```

---

# 180. UNKNOWN

No deberá convertirse silenciosamente en ALLOW para Data sensible.

---

# 181. Governance Exception

Desviación aprobada respecto de Policy.

---

# 182. Exception Requirement

Deberá declarar:

```text
policy
scope
reason
authority
controls
approvedAt
expiresAt
```

---

# 183. Exception ≠ Policy Change

Una Exception no redefine la regla general.

---

# 184. Exception Expiration

Deberá ser obligatoria salvo justificación explícita.

---

# 185. Permanent Exception

Deberá provocar revisión de Policy cuando se convierta en práctica permanente.

---

# 186. Governance Waiver

Podrá representar aceptación temporal de un Requirement no satisfecho.

---

# 187. Waiver Risk

Deberá documentarse.

---

# 188. Waiver Chain

No deberá utilizarse para mantener incumplimiento indefinido.

---

# 189. Governance Review

Deberá realizarse ante cambios materiales.

---

# 190. Review Triggers

Podrán incluir:

```text
new data source
new purpose
new consumer
new jurisdiction
classification change
schema change
migration
security incident
quality incident
new regulation/policy
```

---

# 191. Periodic Review

Podrá requerirse según Criticality.

---

# 192. Governance Evidence

Podrá incluir:

```text
ownership assignment
classification decision
policy evaluation
access review
sharing approval
retention execution
deletion verification
exception approval
```

---

# 193. Evidence Integrity

Governance Evidence deberá protegerse contra modificación no autorizada.

---

# 194. Evidence Retention

Deberá tener Policy propia.

---

# 195. Evidence ≠ Data Copy

No deberá conservarse Data sensible innecesariamente como evidencia.

---

# 196. Governance Drift

Ocurre cuando implementación real deja de corresponder con Governance Model.

---

# 197. Drift Examples

```text
catalog says CONFIDENTIAL
storage marks PUBLIC

owner changed but catalog did not

new replica exists in forbidden region

retention rule not executed

new consumer uses unapproved purpose
```

---

# 198. Governance Drift Detection

Podrá comparar:

```text
declared state
observed state
```

---

# 199. Governance Baseline

Podrá incluir:

```text
assets
owners
classifications
policies
residency
retention
approved consumers
exceptions
```

---

# 200. Governance Violation

Incumplimiento de una Governance Policy o Requirement.

---

# 201. Violation Severity

Podrá clasificarse:

```text
LOW
MEDIUM
HIGH
CRITICAL
```

---

# 202. Governance Incident

Conjunto de Violations con impacto suficiente para requerir Incident Handling.

---

# 203. Governance Violation ≠ Security Incident Automatically

Puede existir Governance Violation sin compromiso técnico de Security.

---

# 204. Security Incident May Be Governance Incident

Cuando afecta Data gobernado, ambas disciplinas pueden intersectarse.

---

# 205. Governance State

Podrá clasificarse:

```text
COMPLIANT
DEGRADED
NON_COMPLIANT
EXEMPTED
UNKNOWN
```

---

# 206. COMPLIANT

Requirements aplicables satisfechos.

---

# 207. DEGRADED

Existen Issues controlados que no invalidan completamente Governance Posture.

---

# 208. NON_COMPLIANT

Existe Requirement obligatorio incumplido.

---

# 209. EXEMPTED

Existe Exception/Waiver válido.

---

# 210. UNKNOWN

No existe Evidence suficiente.

---

# 211. UNKNOWN ≠ COMPLIANT

Ausencia de Evidence no demuestra conformidad.

---

# 212. Multi-Tenancy Governance

ENG-048 deberá preservar Scope de Tenant.

---

# 213. Tenant Governance

Podrá permitir:

```text
tenant-specific retention
tenant-specific residency
tenant-specific sharing
tenant-specific classification
```

cuando Contract lo permita.

---

# 214. Global Policy

Podrá establecer mínimos que Tenants no puedan reducir.

---

# 215. Tenant Override

No deberá debilitar controles obligatorios superiores.

---

# 216. Cross-Tenant Sharing

Deberá prohibirse salvo Contract/Authority explícitos.

---

# 217. Cross-Tenant Analytics

Deberá aplicar Governance Policy específica.

---

# 218. Derived Aggregate

No deberá asumirse automáticamente anónimo o no sensible.

---

# 219. Governance and Metadata

ENG-057 deberá permitir Metadata suficiente para Governance.

---

# 220. Governance Metadata

Podrá incluir:

```text
assetId
domain
owner
steward
classification
purpose
retentionPolicy
residencyPolicy
qualityRequirement
lineageRequirement
```

---

# 221. Metadata Integrity

Governance Metadata incorrecta puede producir decisiones incorrectas.

---

# 222. Metadata Authority

Deberá ser explícita.

---

# 223. Governance and Discovery

ENG-058 podrá descubrir Assets y Sources.

---

# 224. Discovered Asset

Deberá clasificarse inicialmente como:

```text
UNREVIEWED
```

o equivalente seguro.

---

# 225. Discovery ≠ Governance Approval

Descubrir un Asset no aprueba su existencia o uso.

---

# 226. Governance and Resolution

ENG-059 podrá resolver Policy/Metadata según Scope y Context.

---

# 227. Resolution Ambiguity

No deberá escoger silenciosamente una Policy menos restrictiva.

---

# 228. Governance and Plugins

ENG-029/060 deberán respetar Governance de Data procesado por Extensions/Plugins.

---

# 229. Plugin Data Access

Deberá limitarse al Scope declarado.

---

# 230. Third-Party Extension

No deberá recibir Data gobernado únicamente porque esté técnicamente instalado.

---

# 231. Governance and Interoperability

ENG-061 deberá preservar Classification, Purpose y Contract Metadata cuando cruce Boundaries donde sea necesario.

---

# 232. Governance and Schema

ENG-062 deberá permitir identificar Fields gobernados.

---

# 233. Schema Change

Podrá requerir Governance Review cuando:

```text
adds sensitive field
changes semantic meaning
changes retention implication
changes sharing scope
```

---

# 234. Governance and Data Transformation

ENG-063 deberá preservar Governance Semantics.

---

# 235. Transformation Governance

Deberá determinar si Output:

```text
inherits classification
changes classification
requires new purpose
creates derived asset
```

---

# 236. Governance and Data Pipeline

ENG-064 deberá permitir Enforcement/Gates entre Stages.

---

# 237. Pipeline Stage

No deberá eliminar Governance Metadata necesaria para downstream enforcement.

---

# 238. Governance and Migration

ENG-065 deberá preservar:

```text
ownership
classification
retention
residency
lineage
purpose
```

durante Migration.

---

# 239. Migration Destination

Deberá ser Governance-compatible antes de Cutover.

---

# 240. Governance and Upgrade

ENG-066 deberá evitar que Upgrade desactive Controls o altere Policy Semantics silenciosamente.

---

# 241. Governance and Deployment

ENG-067 deberá permitir Gates cuando Deployment modifica Data Processing.

---

# 242. Governance and Environment

ENG-068 deberá impedir uso de Production Data en Environments no autorizados.

---

# 243. Non-Production Data

Deberá:

```text
mask
anonymize
synthesize
restrict
```

según Policy.

---

# 244. Governance and Observability

Telemetry puede constituir Data Asset.

---

# 245. Log Governance

Deberá considerar:

```text
sensitivity
retention
residency
access
purpose
```

---

# 246. Trace Governance

Trace Attributes no deberán incluir Data sensible innecesaria.

---

# 247. Metric Governance

Metric Labels deberán evitar exposición de Data sensible.

---

# 248. Governance and Backups

Backup es una copia gobernada de Data.

---

# 249. Backup Policy

Deberá coordinar:

```text
retention
encryption
residency
access
deletion
recovery
```

---

# 250. Governance and Data Integrity

ENG-079 proporciona:

```text
source of truth
provenance
lineage
integrity verification
```

que pueden utilizarse como Governance Evidence.

---

# 251. Governance and Data Quality

ENG-080 proporciona:

```text
quality requirements
quality state
quality owner
quality issues
```

que Governance puede catalogar y supervisar.

---

# 252. Quality Ownership vs Governance Ownership

Data Owner mantiene Accountability general.

Quality Owner/Steward puede mantener responsabilidad específica de Quality.

---

# 253. Governance and Security

ENG-024 gobierna Security Engineering.

---

# 254. Security Classification Integration

Classification deberá poder informar:

```text
encryption
access control
logging
masking
sharing
```

---

# 255. Governance Policy Must Not Weaken Security

Una Governance Exception no deberá desactivar Security Controls obligatorios fuera de su Authority.

---

# 256. Governance and Authentication

ENG-045 identifica Actors.

---

# 257. Governance and Authorization

ENG-046 aplica Access Decisions.

---

# 258. Governance and IAM

ENG-047 administra Identity Lifecycle y Entitlements.

---

# 259. Governance Context

ENG-056 podrá transportar:

```text
purpose
tenant
jurisdiction
classification
consumer
```

cuando sean necesarios para Policy Evaluation.

---

# 260. Policy Engineering

ENG-051 deberá proporcionar mecanismos generales de Policy.

ENG-081 define Data Governance Policies especializadas.

---

# 261. Policy Decision

Conceptualmente:

```text
SUBJECT
   +
DATA ASSET
   +
ACTION
   +
PURPOSE
   +
CONTEXT
   │
   ▼
GOVERNANCE POLICY
   │
   ▼
ALLOW / DENY / REVIEW
```

---

# 262. Purpose-Aware Authorization

Podrá requerirse cuando Permission por sí sola sea insuficiente.

---

# 263. Governance Security

Deberán protegerse especialmente:

```text
ownership assignments
classification
policies
exceptions
catalog metadata
retention rules
deletion operations
sharing approvals
governance evidence
```

---

# 264. Governance Tampering

Podrá intentar:

```text
declassify data
change owner
extend retention
disable deletion
forge exception
change residency policy
approve unauthorized sharing
```

---

# 265. Privileged Governance Operation

Deberá requerir Authority reforzada.

---

# 266. Separation of Duties

Podrá aplicarse a decisiones críticas.

Ejemplo:

```text
request sharing
≠
approve sharing
```

---

# 267. Governance Audit

Toda decisión crítica deberá ser auditable.

---

# 268. Audit Events

Podrán incluir:

```text
asset registered
owner assigned
steward assigned
classification changed
purpose approved
policy changed
sharing approved
retention changed
hold created
deletion executed
exception granted
exception expired
governance gate overridden
```

---

# 269. Audit Context

Deberá incluir suficiente información para explicar:

```text
who
what
why
under which policy
when
```

---

# 270. Governance Observability

ENG-025 gobernará Telemetry.

---

# 271. Metrics

Podrán incluir:

```text
mef.governance.asset.total
mef.governance.asset.unowned.total
mef.governance.asset.unclassified.total

mef.governance.policy.violation.total
mef.governance.exception.total
mef.governance.exception.expired.total

mef.governance.retention.overdue.total
mef.governance.deletion.overdue.total

mef.governance.residency.violation.total
mef.governance.sharing.denied.total

mef.governance.review.overdue.total
```

---

# 272. Governance Metric Labels

Podrán incluir:

```text
domain
classification
policyType
severity
result
```

con Cardinality controlada.

---

# 273. Sensitive Asset Name as Label

No deberá utilizarse indiscriminadamente.

---

# 274. Governance Logs

Deberán registrar:

```text
policy decision
classification change
exception
retention action
deletion action
sharing decision
```

sin filtrar Data sensible innecesariamente.

---

# 275. Governance Diagnostics

Deberá poder responder:

```text
what assets exist?
who owns this asset?
who stewards it?
what does it mean?
how is it classified?
why do we have it?
who consumes it?
where is it stored?
where may it be stored?
how long is it retained?
may it be shared?
which policies apply?
which exceptions exist?
is governance evidence complete?
```

---

# 276. Governance Snapshot

Conceptualmente:

```text
GovernanceSnapshot
├── asset
├── domain
├── owner
├── steward
├── classification
├── purposes
├── policies
├── retention
├── residency
├── consumers
├── exceptions
└── state
```

---

# 277. Governance Review Result

Conceptualmente:

```text
GovernanceReviewResult
├── scope
├── requirements
├── evidence
├── violations
├── exceptions
├── decision
└── reviewedAt
```

---

# 278. Testing

ENG-009 gobernará Testing.

---

# 279. Ownership Test

Deberá detectar Asset crítico sin Owner.

---

# 280. Stewardship Test

Deberá comprobar asignación cuando sea requerida.

---

# 281. Classification Test

Deberá comprobar Classification y Defaults.

---

# 282. Unknown Classification Test

Deberá comprobar que UNKNOWN no se convierta automáticamente en PUBLIC.

---

# 283. Purpose Limitation Test

Deberá intentar utilizar Data con Purpose no autorizado.

---

# 284. Data Minimization Test

Podrá detectar Fields innecesarios.

---

# 285. Retention Test

Deberá comprobar Trigger + Duration + Action.

---

# 286. Hold Test

Deberá impedir Deletion cuando Hold válido aplique.

---

# 287. Hold Release Test

Deberá restaurar Lifecycle normal.

---

# 288. Deletion Test

Deberá comprobar Scope y Evidence.

---

# 289. Derived Data Deletion Test

Deberá comprobar downstream copies cuando Policy lo requiera.

---

# 290. Access Governance Test

Deberá comprobar Purpose/Classification Context.

---

# 291. Sharing Test

Deberá intentar compartir con Recipient no autorizado.

---

# 292. Bulk Export Test

Deberá comprobar Controls reforzados.

---

# 293. Residency Test

Deberá intentar almacenar/replicar en Location prohibida.

---

# 294. Backup Residency Test

Deberá incluir Backups.

---

# 295. Lineage Governance Test

Deberá comprobar acceso y Retention de Lineage.

---

# 296. Reference Data Governance Test

Deberá comprobar Authority y Version.

---

# 297. Master Data Governance Test

Deberá comprobar Merge/Split Authority.

---

# 298. Contract Governance Test

Deberá comprobar Ownership y Approval.

---

# 299. Exception Test

Deberá comprobar:

```text
scope
authority
expiration
controls
audit
```

---

# 300. Expired Exception Test

Deberá dejar de autorizar automáticamente.

---

# 301. Governance Drift Test

Deberá introducir diferencia entre Declared y Observed State.

---

# 302. Catalog Drift Test

Deberá detectar Metadata obsoleta.

---

# 303. Migration Governance Test

Deberá comprobar preservación de Policies.

---

# 304. Environment Governance Test

Deberá impedir Production Data no autorizado en Non-Production.

---

# 305. Multi-Tenant Governance Test

Deberá comprobar:

```text
tenant policy isolation
cross-tenant sharing
tenant retention
tenant residency
```

---

# 306. Security Test

Deberá intentar:

```text
owner tampering
classification downgrade
policy tampering
exception forgery
retention extension
deletion bypass
unauthorized sharing
residency bypass
governance evidence tampering
```

---

# 307. Architecture Test

Podrá impedir:

```text
critical asset without owner
sensitive asset without classification
purpose-less processing
retention without trigger
permanent exception without review
unknown classification treated as public
catalog treated as operational source of truth
custodian treated as business owner
plugin receives governed data without policy
production data copied to dev without governance
```

---

# 308. Build Integration

ENG-012 podrá validar:

```text
asset declarations
ownership
classification
purpose
policy references
retention definitions
residency constraints
exception metadata
```

---

# 309. Governance Tests in CI

Podrán incluir:

```text
policy tests
classification tests
contract tests
architecture tests
migration governance tests
```

---

# 310. Runtime Governance Verification

Podrá ejecutarse continuamente o periódicamente según Risk.

---

# 311. CLI

ENG-007 podrá proporcionar:

```text
mef governance
mef governance:assets
mef governance:catalog
mef governance:owners
mef governance:classify
mef governance:policies
mef governance:purposes
mef governance:retention
mef governance:residency
mef governance:sharing
mef governance:exceptions
mef governance:review
mef governance:diagnose
```

---

# 312. `mef governance`

Podrá mostrar Governance Snapshot agregado.

---

# 313. `governance:assets`

Podrá mostrar Assets registrados.

---

# 314. `governance:catalog`

Podrá consultar Metadata.

---

# 315. `governance:owners`

Podrá detectar:

```text
unowned assets
owner conflicts
stale ownership
```

---

# 316. `governance:classify`

Las mutaciones deberán requerir Authority.

---

# 317. `governance:policies`

Podrá mostrar Policies aplicables.

---

# 318. `governance:purposes`

Podrá mostrar Purposes autorizados.

---

# 319. `governance:retention`

Podrá mostrar:

```text
policy
trigger
due date
hold
deletion state
```

---

# 320. `governance:residency`

Podrá mostrar Allowed/Observed Locations.

---

# 321. `governance:sharing`

Podrá evaluar Sharing Request.

---

# 322. `governance:exceptions`

Podrá mostrar Exceptions activas y expiradas.

---

# 323. `governance:review`

Podrá ejecutar Governance Review.

---

# 324. `governance:diagnose`

Podrá mostrar:

```text
asset
domain
owner
steward
classification
purpose
policies
retention
residency
consumers
lineage
quality
exceptions
violations
```

---

# 325. Registry Integration

ENG-020 podrá registrar:

```text
DataAsset
DataDomain
DataProduct

DataOwner
DataSteward

DataClassification
DataPurpose

DataPolicy
RetentionPolicy
ResidencyPolicy
SharingPolicy

GovernanceRequirement
GovernanceControl
GovernanceException
```

---

# 326. Data Asset Contract

Conceptualmente:

```text
DataAsset
├── id
├── name
├── definition
├── domain
├── owner
├── steward
├── classification
├── criticality
├── purposes
├── locations
├── retention
└── metadata
```

---

# 327. Data Domain Contract

Conceptualmente:

```text
DataDomain
├── id
├── name
├── definition
├── owner
├── stewards
└── assets
```

---

# 328. Data Product Contract

Conceptualmente:

```text
DataProduct
├── id
├── domain
├── owner
├── producer
├── consumers
├── contract
├── quality
├── classification
└── lifecycle
```

---

# 329. Data Classification Contract

Conceptualmente:

```text
DataClassification
├── sensitivity
├── criticality
├── restrictions
└── metadata
```

---

# 330. Data Purpose Contract

Conceptualmente:

```text
DataPurpose
├── id
├── description
├── owner
├── allowedAssets
├── allowedActions
└── conditions
```

---

# 331. Retention Policy

Conceptualmente:

```text
RetentionPolicy
├── scope
├── trigger
├── duration
├── action
├── holds
├── exceptions
└── authority
```

---

# 332. Residency Policy

Conceptualmente:

```text
ResidencyPolicy
├── scope
├── allowedLocations
├── forbiddenLocations
├── transferRules
└── authority
```

---

# 333. Sharing Policy

Conceptualmente:

```text
SharingPolicy
├── asset
├── recipients
├── purposes
├── conditions
├── restrictions
└── authority
```

---

# 334. Governance Requirement

Conceptualmente:

```text
GovernanceRequirement
├── id
├── scope
├── asset
├── owner
├── classification
├── purpose
├── policies
├── controls
├── evidence
└── review
```

---

# 335. Governance Control

Conceptualmente:

```text
GovernanceControl
├── id
├── policy
├── type
├── enforcement
├── evidence
└── owner
```

---

# 336. Governance Exception

Conceptualmente:

```text
GovernanceException
├── id
├── policy
├── scope
├── reason
├── authority
├── compensatingControls
├── approvedAt
└── expiresAt
```

---

# 337. Governance Decision

Conceptualmente:

```text
GovernanceDecision
├── subject
├── asset
├── action
├── purpose
├── context
├── policies
├── decision
├── obligations
└── evidence
```

---

# 338. Governance Policy

Conceptualmente:

```text
GovernancePolicy
├── requirements
├── ownership
├── classification
├── purpose
├── lifecycle
├── access
├── sharing
├── residency
├── exceptions
└── security
```

---

# 339. Governance Runtime

Conceptualmente:

```text
GovernanceRuntime
├── registerAsset
├── classify
├── resolveOwner
├── evaluatePurpose
├── evaluatePolicy
├── evaluateSharing
├── evaluateRetention
├── evaluateResidency
├── review
└── diagnose
```

---

# 340. Governance Registry

Podrá mantener:

```text
assets
domains
products
owners
stewards
classifications
purposes
policies
controls
exceptions
```

---

# 341. Governance Gate

Conceptualmente:

```text
GovernanceGate
├── scope
├── requirements
├── evidence
├── violations
├── exceptions
├── decision
└── obligations
```

---

# 342. First Implementation Components

La primera implementación deberá incluir:

```text
GovernanceState

DataAsset
DataDomain

DataOwner
DataSteward

DataClassification
DataPurpose

GovernanceRequirement
GovernancePolicy
GovernanceControl

RetentionPolicy
ResidencyPolicy
SharingPolicy

GovernanceDecision
GovernanceException

GovernanceRuntime
GovernanceRegistry

GovernanceError
```

---

# 343. Optional Initial Components

Podrán incorporarse:

```text
DataProduct
DataCatalog
BusinessGlossary

GovernanceGate
GovernanceSnapshot

GovernanceReviewResult
GovernanceDiagnostics
```

---

# 344. Later Components

Solo cuando exista necesidad demostrada:

```text
Automated Data Discovery
Automatic Classification
Semantic Catalog
Automated Lineage Governance
Adaptive Governance Policies
Automated Stewardship
Governance Knowledge Graph
AI-Assisted Data Governance
```

---

# 345. Estructura Conceptual de Directorios

```text
src/
└── DataGovernance/
    ├── State/
    │   └── GovernanceState
    │
    ├── Asset/
    │   ├── DataAsset
    │   └── DataProduct
    │
    ├── Domain/
    │   └── DataDomain
    │
    ├── Ownership/
    │   ├── DataOwner
    │   └── DataSteward
    │
    ├── Classification/
    │   └── DataClassification
    │
    ├── Purpose/
    │   └── DataPurpose
    │
    ├── Policy/
    │   ├── GovernancePolicy
    │   ├── RetentionPolicy
    │   ├── ResidencyPolicy
    │   └── SharingPolicy
    │
    ├── Requirement/
    │   └── GovernanceRequirement
    │
    ├── Control/
    │   └── GovernanceControl
    │
    ├── Decision/
    │   └── GovernanceDecision
    │
    ├── Exception/
    │   └── GovernanceException
    │
    ├── Catalog/
    │   ├── DataCatalog
    │   └── BusinessGlossary
    │
    ├── Gate/
    │   └── GovernanceGate
    │
    ├── Review/
    │   └── GovernanceReviewResult
    │
    ├── Snapshot/
    │   └── GovernanceSnapshot
    │
    ├── Runtime/
    │   └── GovernanceRuntime
    │
    ├── Registry/
    │   └── GovernanceRegistry
    │
    ├── Diagnostics/
    │   └── GovernanceDiagnostics
    │
    └── Error/
        └── GovernanceError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 346. Error Namespace

ENG-081 utilizará:

```text
MEF-DATA-GOVERNANCE-xxx
```

---

# 347. Taxonomía ENG-081

```text
MEF-DATA-GOVERNANCE-001 Governance requirement invalid
MEF-DATA-GOVERNANCE-002 Data asset unregistered
MEF-DATA-GOVERNANCE-003 Data asset owner missing
MEF-DATA-GOVERNANCE-004 Data steward missing
MEF-DATA-GOVERNANCE-005 Data classification missing
MEF-DATA-GOVERNANCE-006 Data classification invalid
MEF-DATA-GOVERNANCE-007 Data purpose unspecified
MEF-DATA-GOVERNANCE-008 Data purpose denied
MEF-DATA-GOVERNANCE-009 Governance policy invalid
MEF-DATA-GOVERNANCE-010 Governance policy conflict
MEF-DATA-GOVERNANCE-011 Retention policy invalid
MEF-DATA-GOVERNANCE-012 Retention overdue
MEF-DATA-GOVERNANCE-013 Data deletion overdue
MEF-DATA-GOVERNANCE-014 Data deletion blocked by hold
MEF-DATA-GOVERNANCE-015 Data sharing denied
MEF-DATA-GOVERNANCE-016 Data redistribution denied
MEF-DATA-GOVERNANCE-017 Data residency violation
MEF-DATA-GOVERNANCE-018 Data sovereignty violation
MEF-DATA-GOVERNANCE-019 Data minimization violation
MEF-DATA-GOVERNANCE-020 Data contract governance violation
MEF-DATA-GOVERNANCE-021 Governance exception invalid
MEF-DATA-GOVERNANCE-022 Governance exception expired
MEF-DATA-GOVERNANCE-023 Governance evidence insufficient
MEF-DATA-GOVERNANCE-024 Governance drift detected
MEF-DATA-GOVERNANCE-025 Governance gate failed
MEF-DATA-GOVERNANCE-026 Governance gate override denied
MEF-DATA-GOVERNANCE-027 Governance authorization denied
MEF-DATA-GOVERNANCE-028 Governance security violation
MEF-DATA-GOVERNANCE-029 Governance state unknown
MEF-DATA-GOVERNANCE-030 Governance invariant violation
```

---

# 348. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Data Assets
Explicit Data Domains

Explicit Ownership
Explicit Stewardship

Classification
Criticality

Purpose
Purpose Limitation
Data Minimization

Governance Policies

Retention
Deletion
Residency
Sharing

Governance Decisions
Governance Exceptions

Governance Evidence

Security
Audit
Observability
Testing
```

---

# 349. First Version Non-Goals

No deberá requerir:

```text
Automatic Data Discovery
Automatic Semantic Classification
Automated Ownership Inference
Semantic Governance Knowledge Graph
Adaptive Governance Policies
Automatic Stewardship
AI-Assisted Data Governance
```

---

# 350. Second Phase

Podrá incorporar:

```text
Data Catalog
Business Glossary
Data Products

Governance Gates
Governance Snapshots

Automated Asset Discovery
Governance Drift Detection

Advanced Lineage Governance
Reference/Master Data Governance
```

---

# 351. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Classification
Semantic Catalog
Governance Knowledge Graph
Automated Stewardship
Adaptive Governance Policies
Predictive Governance Risk
AI-Assisted Data Governance
```

---

# 352. Invariantes de Ingeniería

ENG-081 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1566 | Todo Data Asset crítico gobernado por MEF deberá poseer Identity, Domain, Ownership, Classification, Purpose, Lifecycle y Policies suficientes para determinar quién posee Authority sobre él y bajo qué condiciones puede utilizarse. |
| EI-1567 | Data Governance deberá permanecer diferenciada de Data Management, Security, IAM, Compliance, Data Integrity y Data Quality y la existencia de acceso técnico a Data no deberá interpretarse automáticamente como autorización de Governance para utilizarlo. |
| EI-1568 | Todo Data Domain y Asset crítico deberá poseer Accountability explícita y Technical Custody, Data Creation, Storage Administration o acceso operativo no deberán conferir automáticamente Business Ownership. |
| EI-1569 | Data Owner, Data Steward, Technical Custodian, Producer y Consumer deberán mantener responsabilidades diferenciadas y Delegation no deberá eliminar Accountability ni ampliar Authority fuera de su Scope. |
| EI-1570 | Data Inventory, Catalog y Business Glossary deberán distinguir existencia, Metadata y significado semántico y ningún mecanismo de Discovery deberá asignar automáticamente Ownership, Purpose o Canonical Meaning sin Evidence suficiente. |
| EI-1571 | Data Classification deberá distinguir Sensitivity, Criticality y demás dimensiones aplicables; UNKNOWN no deberá tratarse automáticamente como PUBLIC y Transformations o Aggregations no deberán reducir Classification sin Policy, Authority y Evidence apropiados. |
| EI-1572 | Toda Governance Policy contractual deberá poseer Scope, Authority, Version, Effective Time, Conditions, Obligations, Prohibitions, Controls y Exception Rules suficientes y los conflictos entre Policies deberán resolverse mediante Precedence determinista. |
| EI-1573 | Purpose Limitation deberá impedir reutilización automática de Data fuera de Purposes autorizados y todo cambio material de Purpose deberá reevaluar Authority, Access, Classification, Sharing, Retention y demás Policies aplicables. |
| EI-1574 | Data Minimization deberá impedir recopilación, procesamiento, replicación o conservación innecesaria cuando Policy lo requiera y Quality, Analytics, Convenience o Future Use indefinido no deberán utilizarse por sí solos como justificación para acumular Data. |
| EI-1575 | Retention Governance deberá declarar Scope, Trigger, Duration, Action, Holds, Exceptions y Authority y Archived, Replicated, Cached, Derived y Backup Data no deberán considerarse fuera del Lifecycle Governance por cambiar de Storage Tier. |
| EI-1576 | Deletion Governance deberá distinguir Logical y Physical Deletion, considerar Derived State y Recovery Copies conforme Policy y producir Evidence suficiente sin conservar innecesariamente el contenido que debía eliminarse. |
| EI-1577 | Access y Sharing Governance deberán evaluar Asset, Classification, Purpose, Recipient, Tenant, Jurisdiction y Context aplicables y Internal Sharing, Bulk Export, Plugin Access o Technical Connectivity no deberán equivaler automáticamente a Governance Approval. |
| EI-1578 | Data Residency y Data Sovereignty deberán conservar Semantics diferenciadas y Replicas, Backups, Telemetry y Derived Stores deberán considerarse al verificar restricciones geográficas o jurisdiccionales aplicables. |
| EI-1579 | Lineage, Provenance, Reference Data, Master Data y Data Contracts deberán gobernarse mediante Ownership, Authority, Versioning, Access y Lifecycle apropiados y Golden Record, Merge o Survivorship no deberán resolverse arbitrariamente. |
| EI-1580 | Governance Enforcement deberá combinar Controls preventivos, detectivos, correctivos, manuales o automatizados según Risk y Policy-as-Code no deberá presentarse como sustituto completo de Ownership, Judgment, Approval y Accountability humanos. |
| EI-1581 | Toda Governance Exception o Waiver deberá declarar Policy, Scope, Reason, Authority, Compensating Controls y Expiration apropiados y una cadena de excepciones no deberá utilizarse para convertir incumplimiento temporal en práctica permanente no gobernada. |
| EI-1582 | Governance Drift deberá detectarse comparando Declared y Observed State cuando sea material y cambios de Owner, Classification, Purpose, Consumer, Residency, Retention, Schema, Pipeline o Environment deberán provocar Review cuando alteren Governance Posture. |
| EI-1583 | Multi-Tenant Governance deberá preservar aislamiento de Policies, Ownership, Purpose, Retention, Residency y Sharing y ningún Tenant Override deberá debilitar controles obligatorios establecidos por Authority superior. |
| EI-1584 | Governance Security, Audit y Observability deberán proteger Ownership, Classification, Policies, Exceptions, Retention, Deletion, Sharing, Catalog Metadata y Evidence y permitir reconstruir quién tomó una decisión, sobre qué Asset, por qué, cuándo y bajo qué Policy. |
| EI-1585 | La primera implementación deberá priorizar Data Assets, Domains, Ownership, Stewardship, Classification, Purpose, Policies, Retention, Deletion, Residency, Sharing, Governance Decisions, Exceptions y Evidence antes de introducir Automatic Discovery, Semantic Classification, Governance Knowledge Graph, Adaptive Policies o AI-Assisted Data Governance. |

---

# 353. Continuidad de Invariantes

```text
ENG-077 → EI-1486 a EI-1505
ENG-078 → EI-1506 a EI-1525
ENG-079 → EI-1526 a EI-1545
ENG-080 → EI-1546 a EI-1565
ENG-081 → EI-1566 a EI-1585
```

---

# 354. Criterios de Conformidad

Una implementación será conforme con ENG-081 cuando:

- registre Data Assets críticos;
- defina Data Domains;
- asigne Data Owners;
- asigne Data Stewards cuando corresponda;
- diferencie Owner, Steward y Custodian;
- defina Classification;
- diferencie Sensitivity y Criticality;
- trate UNKNOWN de forma segura;
- defina Purpose;
- implemente Purpose Limitation;
- implemente Data Minimization cuando aplique;
- defina Governance Policies;
- versione Policies;
- resuelva Policy Conflicts;
- defina Retention Rules;
- defina Holds;
- gobierne Archives;
- gobierne Deletion;
- considere Derived Data;
- gobierne Backups;
- implemente Access Governance;
- implemente Sharing Governance;
- gobierne Bulk Exports;
- defina Residency Policies;
- diferencie Residency y Sovereignty;
- gobierne Lineage/Provenance;
- gobierne Reference/Master Data;
- gobierne Data Contracts;
- implemente Governance Controls;
- implemente Governance Exceptions;
- controle Expiration;
- produzca Governance Evidence;
- detecte Governance Drift;
- preserve Multi-Tenant Governance;
- aplique Security;
- implemente Audit;
- implemente Observability;
- implemente Governance Testing.

---

# 355. Riesgos

Deberán evitarse especialmente:

```text
No Owner
Everyone Owns the Data

DBA Equals Data Owner
Creator Equals Owner
Custodian Equals Owner

Access Equals Permission to Use
Internal Equals Automatically Allowed

Unknown Classification Equals Public

Transformation Equals Declassification
Aggregation Equals Anonymous

Purpose-Free Processing
Future Use as Unlimited Purpose

More Data Equals Better Governance

Retention Without Trigger
Archive Equals Outside Governance
Backup Equals Outside Governance

Logical Delete Equals Physical Delete

Internal Sharing Without Policy
Bulk Export Without Governance

Storage Location Equals Jurisdiction

Catalog Equals Operational Source of Truth
Discovery Equals Approval

Policy Without Version
Policy Conflict Without Precedence

Permanent Exception
Exception Chain

Golden Record Without Authority
Automatic Semantic Merge

Production Data in Development

Governance Metadata Tampering
Classification Downgrade
Retention Extension Without Authority
Deletion Bypass
```

---

# 356. Relación con ENG-024

Security protege Data.

Governance determina además qué usos están permitidos y bajo qué Policy.

---

# 357. Relación con ENG-045/046/047

```text
AUTHENTICATION
ENG-045
→ Who are you?

AUTHORIZATION
ENG-046
→ May this subject perform
  this action?

IAM
ENG-047
→ How are identities and
  entitlements governed?

DATA GOVERNANCE
ENG-081
→ Is this action on this Data Asset
  permitted for this Purpose,
  Classification and Context?
```

---

# 358. Relación con ENG-048

Tenant Scope deberá conservarse en todas las decisiones de Governance.

---

# 359. Relación con ENG-051

Policy Engineering proporciona infraestructura general.

ENG-081 define Data Governance Policies especializadas.

---

# 360. Relación con ENG-057

Metadata Engineering deberá permitir expresar Governance Metadata sin convertirse por sí mismo en Governance Authority.

---

# 361. Relación con ENG-058

Discovery podrá localizar Assets.

No podrá declarar unilateralmente:

```text
owner
meaning
purpose
classification
approval
```

---

# 362. Relación con ENG-063

**ENG-063 — Data Transformation Engineering** deberá preservar o recalcular Governance Semantics cuando transforme Data.

---

# 363. Relación con ENG-064

Data Pipeline Engineering deberá permitir Governance Controls y Gates entre Stages.

---

# 364. Relación con ENG-065

Migration Engineering deberá preservar Governance Posture durante Source → Target.

---

# 365. Relación con ENG-079

```text
DATA INTEGRITY
ENG-079
→ Is the state valid?
```

Provenance, Lineage y Authority definidos allí pueden proporcionar Evidence para Governance.

---

# 366. Relación con ENG-080

```text
DATA QUALITY
ENG-080
→ Is the data fit for purpose?
```

Quality Requirements y Quality State podrán formar parte del Data Product Governance.

---

# 367. Relación con ENG-082

El siguiente documento deberá formalizar **Data Privacy Engineering**.

La frontera será:

```text
DATA GOVERNANCE
ENG-081
│
└── Who owns and governs
    data and under which policies?

DATA PRIVACY
ENG-082
│
└── How must personal or
    privacy-relevant data be
    processed and protected
    throughout its lifecycle?
```

ENG-082 deberá cubrir al menos:

```text
Data Privacy

Privacy Requirement
Privacy Policy

Personal Data
Sensitive Personal Data

Data Subject

Controller
Processor

Processing Activity

Lawful/Authorized Processing Basis

Purpose Limitation
Data Minimization

Consent
Consent State
Consent Lifecycle

Notice
Transparency

Data Subject Rights

Access
Correction
Deletion
Restriction
Objection
Portability

Privacy Preference

Privacy Classification

Pseudonymization
Anonymization

Re-identification Risk

Privacy by Design
Privacy by Default

Privacy Impact Assessment

Data Processing Inventory

Privacy Boundary

Cross-Border Privacy

Third-Party Processing

Privacy Incident

Privacy Evidence

Privacy Security
Privacy Audit
Privacy Observability
Privacy Testing
```

---

# 368. Principio Rector

> **MEF deberá gobernar Data mediante Authority, Ownership, Classification, Purpose y Lifecycle explícitos. La capacidad técnica de almacenar, consultar, copiar, transformar o compartir un dato nunca deberá interpretarse por sí sola como autorización para hacerlo. Toda decisión material sobre Data deberá poder relacionarse con un Asset, un Purpose, una Policy y una Authority identificables.**

---

# 369. Conclusión

**ENG-081 — Data Governance Engineering** formaliza quién posee autoridad sobre Data y qué reglas gobiernan su ciclo de vida.

La cadena conceptual queda:

```text
DATA
 │
 ▼
DATA ASSET
 │
 ▼
DOMAIN
 │
 ▼
OWNER / STEWARD
 │
 ▼
CLASSIFICATION
 │
 ▼
PURPOSE
 │
 ▼
POLICY
 │
 ▼
CONTROL
 │
 ▼
EVIDENCE
```

La separación fundamental queda:

```text
ENG-079
DATA INTEGRITY
│
└── ¿El State es válido?

ENG-080
DATA QUALITY
│
└── ¿El Data es apto
    para el Purpose?

ENG-081
DATA GOVERNANCE
│
└── ¿Quién tiene Authority
    sobre el Data y bajo qué
    Policies puede utilizarse?
```

Un dato puede ser:

```text
INTEGRITY    ✓
QUALITY      ✓
SECURITY     ✓
```

y aun así su uso ser:

```text
GOVERNANCE   ✗
```

Ejemplo:

```text
Customer email
    │
    ├── valid              ✓
    ├── accurate           ✓
    ├── encrypted          ✓
    └── accessible by user ✓
```

pero:

```text
Approved Purpose:
ACCOUNT_SERVICING

Attempted Purpose:
UNAPPROVED_SECONDARY_USE
```

Resultado:

```text
Technical Access    ALLOWED
Governance Use      DENIED
```

La decisión deberá considerar:

```text
SUBJECT
    +
ACTION
    +
DATA ASSET
    +
PURPOSE
    +
TENANT
    +
JURISDICTION
    +
CONTEXT
    │
    ▼
GOVERNANCE POLICY
    │
    ├── ALLOW
    ├── DENY
    ├── REVIEW
    └── ALLOW_WITH_CONDITIONS
```

El Lifecycle queda:

```text
COLLECT
   │
   ▼
CLASSIFY
   │
   ▼
STORE
   │
   ▼
USE
   │
   ▼
SHARE
   │
   ▼
ARCHIVE
   │
   ▼
DELETE
   │
   ▼
VERIFY
```

y cada etapa permanece gobernada.

La cadena de datos queda ahora:

```text
DURABILITY
ENG-077
   │
   ▼
CONSISTENCY
ENG-078
   │
   ▼
DATA INTEGRITY
ENG-079
   │
   ▼
DATA QUALITY
ENG-080
   │
   ▼
DATA GOVERNANCE
ENG-081
   │
   ▼
DATA PRIVACY
ENG-082
```

La primera implementación deberá concentrarse en:

```text
GovernanceState

DataAsset
DataDomain

DataOwner
DataSteward

DataClassification
DataPurpose

GovernanceRequirement
GovernancePolicy
GovernanceControl

RetentionPolicy
ResidencyPolicy
SharingPolicy

GovernanceDecision
GovernanceException

GovernanceRuntime
GovernanceRegistry
GovernanceError
```

antes de introducir:

```text
Automatic Data Discovery
Automatic Semantic Classification
Automated Ownership Inference
Semantic Governance Knowledge Graph
Adaptive Governance Policies
Automated Stewardship
AI-Assisted Data Governance
```

Con **ENG-081**, la serie global alcanza:

```text
EI-1585
```

---

# Referencias

## Arquitectura

- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-029 — Extension Engineering
- ENG-035 — Domain Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-051 — Policy Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-060 — Extension & Plugin Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Data Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-079 — Data Integrity Engineering
- ENG-080 — Data Quality Engineering
- ENG-082 — Data Privacy Engineering
```