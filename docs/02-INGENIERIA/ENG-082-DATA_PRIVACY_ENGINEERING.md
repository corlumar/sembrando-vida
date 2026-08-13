---
id: ENG-082
titulo: Data Privacy Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Privacy Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11
dependencias:
  - ENG-009
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
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
  - ENG-081
relacionados:
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-036
  - ENG-037
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-049
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
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-083
keywords:
  - privacy
  - data-privacy
  - personal-data
  - sensitive-data
  - data-subject
  - processing
  - purpose-limitation
  - data-minimization
  - consent
  - privacy-notice
  - transparency
  - privacy-rights
  - pseudonymization
  - anonymization
  - re-identification
  - privacy-by-design
  - privacy-by-default
  - privacy-impact-assessment
  - privacy-risk
  - privacy-preference
  - cross-border
  - third-party-processing
  - mef
---

# ENG-082

# Data Privacy Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Privacy Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-082 establece principios, contratos y controles técnicos para:

```text
Privacy

Personal Data
Sensitive Personal Data

Data Subject
Privacy Identity

Processing Activity
Processing Purpose
Processing Basis

Privacy Policy
Privacy Requirement

Privacy Notice
Transparency

Consent
Consent State
Consent Lifecycle

Privacy Preference

Purpose Limitation
Data Minimization
Storage Limitation

Data Subject Rights

Access
Correction
Deletion
Restriction
Objection
Portability

Pseudonymization
Anonymization
De-identification
Re-identification Risk

Privacy by Design
Privacy by Default

Privacy Impact Assessment
Privacy Risk

Data Processing Inventory

Third-Party Processing
Cross-Border Processing

Privacy Incident

Privacy Evidence
Privacy Audit
Privacy Observability
Privacy Testing
```

---

# 2. Declaración

> **MEF deberá tratar Privacy como una propiedad arquitectónica y de Lifecycle, no como una validación añadida al final del desarrollo. Todo procesamiento de Personal Data deberá poseer Purpose, Scope, Authority, Lifecycle y controles suficientemente explícitos para determinar qué Data se procesa, por qué, por quién, durante cuánto tiempo y bajo qué condiciones.**

Arquitectura:

```text
PERSONAL DATA
      │
      ▼
   IDENTIFY
      │
      ▼
   CLASSIFY
      │
      ▼
DEFINE PURPOSE
      │
      ▼
DETERMINE PROCESSING BASIS
      │
      ▼
   MINIMIZE
      │
      ▼
   PROCESS
      │
      ▼
   PROTECT
      │
      ▼
   RETAIN
      │
      ▼
DELETE / ANONYMIZE
      │
      ▼
    VERIFY
```

---

# 3. Data Privacy Engineering

Responde:

```text
Is this Personal Data?

Whose data is it?

Why is it processed?

Is the processing authorized?

Which data is actually necessary?

Which privacy requirements apply?

What notice or transparency is required?

Is consent required?

What preferences exist?

Which rights must be supported?

How long may data remain identifiable?

Can it be pseudonymized?

Can it be anonymized?

Could it be re-identified?

Who receives the data?

Does it cross organizational
or jurisdictional boundaries?

Can the processing be audited?
```

---

# 4. Privacy ≠ Security

Security responde principalmente:

```text
Can unauthorized actors
access, modify or destroy data?
```

Privacy responde además:

```text
Should this Personal Data
be processed at all,
for this Purpose,
under these conditions?
```

Data puede estar perfectamente cifrado y aun así utilizarse de manera incompatible con Privacy Requirements.

---

# 5. Privacy ≠ Data Governance

ENG-081:

```text
Who governs Data
and under which Policies?
```

ENG-082:

```text
How must Personal Data
and privacy-relevant processing
be handled?
```

Privacy utiliza Governance Infrastructure, pero introduce requisitos especializados.

---

# 6. Privacy ≠ Consent

Consent es solamente uno de los posibles mecanismos de autorización o Processing Basis.

No deberá modelarse:

```text
PRIVACY = CONSENT
```

---

# 7. Privacy ≠ Confidentiality

Confidentiality protege contra Disclosure no autorizada.

Privacy cubre además:

```text
collection
purpose
processing
retention
profiling
sharing
rights
transparency
```

---

# 8. Personal Data

Representa Data relacionado directa o indirectamente con un Data Subject identificable según el Privacy Model aplicable.

Ejemplos conceptuales:

```text
name
email
phone
address
account identifier
device identifier
location
behavioral information
transaction history
```

La clasificación jurídica concreta dependerá del régimen aplicable y no deberá codificarse universalmente en el Core.

---

# 9. Sensitive Personal Data

Representa categorías que requieren controles reforzados según Policy aplicable.

MEF no deberá asumir una lista jurídica universal.

La taxonomía deberá ser configurable.

---

# 10. Direct Identifier

Permite identificar directamente a un Subject dentro del Context correspondiente.

---

# 11. Indirect Identifier

Puede contribuir a identificación cuando se combina con otro Data.

---

# 12. Identifier Combination

Data aparentemente no identificable aisladamente puede volverse identificable mediante combinación.

---

# 13. Personal Data Classification

Deberá considerar:

```text
direct identifiers
indirect identifiers
sensitive attributes
behavioral data
location data
derived data
metadata
```

según Policy.

---

# 14. Derived Personal Data

Data inferido o calculado puede seguir siendo Personal Data.

---

# 15. Metadata

Metadata puede contener Personal Data.

No deberá considerarse automáticamente neutral.

---

# 16. Telemetry

Logs, Metrics y Traces podrán contener Personal Data.

---

# 17. Data Subject

Representa la persona o Subject al que se relaciona Personal Data según el Privacy Model.

---

# 18. Subject Identity

Deberá poder resolverse sin introducir Identity Coupling innecesario.

---

# 19. Subject Identifier

Deberá utilizarse de forma proporcional al Purpose.

---

# 20. Subject Correlation

La correlación entre múltiples Systems deberá estar gobernada.

---

# 21. Universal Subject Identifier

No deberá introducirse automáticamente.

Puede aumentar Re-identification y Correlation Risk.

---

# 22. Processing

Representa cualquier operación relevante sobre Personal Data.

Podrá incluir:

```text
collect
receive
record
organize
store
retrieve
read
analyze
transform
combine
share
export
archive
delete
anonymize
```

---

# 23. Processing Activity

Deberá poder describirse como Contract.

Conceptualmente:

```text
ProcessingActivity
├── id
├── data
├── subjects
├── purpose
├── basis
├── producer
├── processor
├── recipients
├── locations
├── retention
└── controls
```

---

# 24. Processing Inventory

Los Processing Activities críticos deberán poder inventariarse.

---

# 25. Processing Purpose

Todo Processing sensible deberá poseer Purpose explícito.

---

# 26. Purpose Identifier

Deberá utilizar Identity estable cuando participe en Policy Evaluation.

Ejemplo:

```text
ACCOUNT_MANAGEMENT
CUSTOMER_SUPPORT
BILLING
SECURITY_MONITORING
ANALYTICS
```

---

# 27. Purpose Limitation

Data obtenido para Purpose A no deberá reutilizarse automáticamente para Purpose B.

---

# 28. Secondary Purpose

Deberá evaluarse explícitamente.

---

# 29. Purpose Expansion

No deberá producirse silenciosamente.

---

# 30. Purpose Drift

Ocurre cuando el Processing real se aleja del Purpose declarado.

---

# 31. Processing Basis

Representa la Authority o fundamento permitido por el Privacy Policy aplicable para realizar Processing.

---

# 32. Processing Basis ≠ Consent Automatically

El modelo deberá admitir múltiples Basis Types configurables.

---

# 33. Basis Type

Podrá representarse mediante identificadores configurables:

```text
CONSENT
CONTRACTUAL
LEGAL_REQUIREMENT
LEGITIMATE_PURPOSE
VITAL_INTEREST
PUBLIC_FUNCTION
OTHER
```

Los nombres anteriores son abstracciones de ingeniería y no deberán interpretarse como equivalencia jurídica universal.

---

# 34. Basis Validation

Toda Basis deberá:

```text
exist
apply to purpose
apply to data
apply to processing
remain valid
```

según Policy.

---

# 35. Basis Expiration

Una Basis puede dejar de ser válida.

---

# 36. Basis Change

Deberá provocar reevaluación del Processing.

---

# 37. Privacy Requirement

Deberá poder declarar:

```text
scope
data
subjects
purpose
basis
notice
consent
rights
retention
recipients
locations
controls
evidence
```

---

# 38. Privacy Policy

Especializa Policy Engineering y Data Governance para Privacy.

---

# 39. Privacy Policy Version

Deberá ser versionada.

---

# 40. Effective Privacy Policy

Deberá poder determinarse según Context y Time.

---

# 41. Policy Change

No deberá reinterpretar automáticamente Processing histórico.

---

# 42. Privacy Notice

Representa información proporcionada al Subject respecto del Processing.

---

# 43. Notice ≠ Consent

Informar no equivale automáticamente a obtener Consent.

---

# 44. Notice Contract

Podrá contener:

```text
version
purposes
data categories
recipients
retention
rights
contact
effectiveFrom
```

---

# 45. Notice Versioning

Deberá permitir determinar qué Notice estaba vigente.

---

# 46. Notice Evidence

Podrá registrarse cuando Policy lo requiera.

---

# 47. Transparency

El sistema deberá permitir explicar Processing relevante de forma proporcional al Context.

---

# 48. Transparency Metadata

Podrá incluir:

```text
purpose
categories
source
recipients
retention
automated processing
```

---

# 49. Consent

Representa una autorización explícita cuando el Privacy Policy aplicable la requiera.

---

# 50. Consent Contract

Conceptualmente:

```text
Consent
├── subject
├── purpose
├── scope
├── status
├── noticeVersion
├── grantedAt
├── expiresAt
├── withdrawnAt
└── evidence
```

---

# 51. Consent State

Podrá incluir:

```text
UNKNOWN
REQUESTED
GRANTED
DENIED
WITHDRAWN
EXPIRED
```

---

# 52. UNKNOWN ≠ GRANTED

Ausencia de Consent Evidence nunca deberá convertirse silenciosamente en Consent.

---

# 53. Consent Scope

Deberá ser suficientemente granular.

---

# 54. Bundled Consent

No deberá utilizarse cuando Policies requieran decisiones independientes.

---

# 55. Consent Purpose

Consent deberá relacionarse con Purpose identificable.

---

# 56. Consent Version

Deberá relacionarse con Notice/Terms aplicables cuando corresponda.

---

# 57. Consent Evidence

Deberá permitir demostrar:

```text
who
what
purpose
scope
when
under which notice/version
```

sin conservar Data innecesario.

---

# 58. Consent Withdrawal

Deberá poder propagarse a Processing dependiente cuando corresponda.

---

# 59. Withdrawal ≠ Historical Erasure Automatically

La consecuencia dependerá de Retention y demás Policies aplicables.

---

# 60. Consent Expiration

Deberá reevaluarse antes de continuar Processing dependiente.

---

# 61. Consent Revocation Latency

Podrá existir Requirement sobre cuánto tiempo puede tardar la propagación.

---

# 62. Privacy Preference

Representa preferencias del Subject que pueden no ser equivalentes a Consent.

---

# 63. Preference Types

Podrán incluir:

```text
communication preferences
personalization preferences
tracking preferences
sharing preferences
```

---

# 64. Preference Scope

Deberá distinguir:

```text
subject
channel
purpose
tenant
context
```

cuando corresponda.

---

# 65. Preference Precedence

Deberá ser determinista.

---

# 66. Data Minimization

Solo deberá procesarse Personal Data necesario para Purpose autorizado cuando Policy lo requiera.

---

# 67. Collection Minimization

Evitar Fields innecesarios desde el origen.

---

# 68. Processing Minimization

Aunque Data exista, no deberá exponerse automáticamente a cada Processor.

---

# 69. Storage Minimization

No deberán mantenerse copias innecesarias.

---

# 70. Transmission Minimization

No deberá enviarse más Data del necesario.

---

# 71. Logging Minimization

Logs no deberán convertirse en copias accidentales de Personal Data.

---

# 72. Response Minimization

APIs deberán retornar solamente Data necesario para Contract/Purpose.

---

# 73. Data Masking

Podrá reducir exposición sin convertir Data automáticamente en Anonymous Data.

---

# 74. Field-Level Controls

Podrán aplicarse según Classification y Purpose.

---

# 75. Storage Limitation

Personal Data no deberá permanecer identificable indefinidamente sin Requirement.

---

# 76. Retention Integration

ENG-081 proporciona Retention Governance.

ENG-082 añade Privacy Requirements al Retention Model.

---

# 77. Privacy Retention

Podrá depender de:

```text
purpose
basis
subject state
contract state
policy
hold
```

---

# 78. Retention Expiration

Podrá provocar:

```text
delete
anonymize
aggregate
archive under restricted policy
```

según Requirement.

---

# 79. Data Subject Rights

El Framework deberá permitir implementar Rights configurables.

---

# 80. Rights Taxonomy

Podrá incluir:

```text
ACCESS
CORRECTION
DELETION
RESTRICTION
OBJECTION
PORTABILITY
```

sin asumir que todos aplican universalmente.

---

# 81. Rights Request

Conceptualmente:

```text
PrivacyRightsRequest
├── id
├── subject
├── right
├── scope
├── status
├── requestedAt
├── deadline
├── decision
└── evidence
```

---

# 82. Rights Request State

Podrá incluir:

```text
RECEIVED
IDENTITY_PENDING
VALIDATING
IN_PROGRESS
FULFILLED
PARTIALLY_FULFILLED
DENIED
CANCELLED
```

---

# 83. Subject Verification

La ejecución de Rights deberá verificar Identity de forma proporcional al Risk.

---

# 84. Over-Verification

No deberá recolectarse Data excesivo únicamente para verificar Identity.

---

# 85. Access Right Engineering

Deberá poder localizar Personal Data relevante mediante:

```text
identity resolution
inventory
lineage
data discovery
```

---

# 86. Access Response

Deberá aplicar:

```text
scope
authorization
third-party protection
security
minimization
```

---

# 87. Correction Engineering

Deberá coordinar:

```text
source of truth
integrity
derived data
replicas
downstream consumers
```

---

# 88. Correction ≠ Blind Mutation

No deberá modificar Records sin preservar Integrity.

---

# 89. Deletion Engineering

Deberá integrarse con ENG-081 y ENG-076/077.

---

# 90. Deletion Scope

Podrá considerar:

```text
primary stores
replicas
indexes
caches
exports
derived stores
archives
backups
```

según Policy.

---

# 91. Deletion Conflict

Rights Requests podrán entrar en conflicto con Holds u otras Retention Requirements.

La resolución deberá ser explícita y auditable.

---

# 92. Restriction Engineering

Podrá impedir determinadas operaciones sin requerir eliminación inmediata.

---

# 93. Restriction State

Deberá propagarse cuando Processing distribuido dependa de ella.

---

# 94. Objection Engineering

Deberá permitir Policy Evaluation respecto de Processing específico.

---

# 95. Portability Engineering

Deberá utilizar formatos y Transport Contracts apropiados.

---

# 96. Portability Security

La exportación deberá verificar Recipient/Subject y proteger Data en tránsito.

---

# 97. Rights Deadline

Podrá modelarse como Requirement configurable.

---

# 98. Rights Evidence

Deberá permitir demostrar:

```text
request
verification
decision
actions
completion
```

---

# 99. Rights Automation

No deberá eliminar Review humana cuando Policy requiera Judgment.

---

# 100. Pseudonymization

Transforma Identifiers para reducir asociación directa sin eliminar necesariamente la posibilidad de Re-identification.

---

# 101. Pseudonymized Data ≠ Anonymous Data

Deberá continuar tratándose según Privacy Policy aplicable.

---

# 102. Pseudonym Mapping

Deberá protegerse separadamente cuando exista.

---

# 103. Pseudonym Rotation

Podrá utilizarse para reducir Correlation Risk.

---

# 104. Contextual Pseudonym

Podrán utilizarse identificadores diferentes entre Contexts.

---

# 105. Tokenization

Podrá ser una implementación de protección, pero no deberá asumirse equivalente a Anonymization.

---

# 106. Anonymization

Busca transformar Data de manera que el Privacy Model aplicable lo considere no razonablemente atribuible a un Subject.

---

# 107. Anonymization ≠ Remove Name

Eliminar identificadores directos puede ser insuficiente.

---

# 108. Re-identification Risk

Deberá evaluarse considerando:

```text
quasi-identifiers
linkability
external datasets
population size
uniqueness
context
```

---

# 109. Anonymization Context

No deberá evaluarse únicamente sobre una columna aislada.

---

# 110. Anonymous Data Classification

Solo deberá asignarse cuando los criterios definidos hayan sido satisfechos.

---

# 111. Anonymization Evidence

Deberá registrar Method y Assessment apropiados.

---

# 112. Re-identification

Intentos no autorizados deberán prohibirse y auditarse.

---

# 113. De-identification

Podrá utilizarse como término general para técnicas que reduzcan Identifiability.

---

# 114. Aggregation

Puede reducir Risk pero no garantiza Anonymity.

---

# 115. Small Groups

Aggregates pequeños pueden revelar Subjects.

---

# 116. Privacy by Design

Privacy Requirements deberán considerarse durante:

```text
architecture
schema
API design
storage
processing
integration
observability
deployment
operations
```

---

# 117. Privacy by Default

Configuraciones iniciales deberán favorecer el Processing mínimo compatible con Requirements.

---

# 118. Default Collection

No deberá recolectar Optional Personal Data innecesario.

---

# 119. Default Sharing

Deberá ser restrictivo.

---

# 120. Default Visibility

Deberá ser mínima.

---

# 121. Default Retention

No deberá ser indefinida por conveniencia.

---

# 122. Privacy Impact Assessment

Representa evaluación estructurada de Privacy Risk para Processing significativo.

---

# 123. PIA Trigger

Podrá incluir:

```text
new sensitive data
new purpose
large-scale processing
profiling
new tracking
new external sharing
cross-border processing
new correlation
new automated decision
new technology
```

---

# 124. PIA Contract

Conceptualmente:

```text
PrivacyImpactAssessment
├── processing
├── data
├── subjects
├── purposes
├── risks
├── controls
├── residualRisk
├── owner
├── decision
└── reviewedAt
```

---

# 125. Privacy Risk

Podrá considerar:

```text
unauthorized disclosure
unexpected use
excessive collection
excessive retention
correlation
profiling
re-identification
loss of control
inaccurate personal data
```

---

# 126. Privacy Risk ≠ Security Risk Only

Un sistema puede no ser vulnerable y aun así producir Privacy Harm mediante Processing autorizado pero inapropiado.

---

# 127. Risk Treatment

Podrá ser:

```text
AVOID
REDUCE
TRANSFER
ACCEPT
```

según Policy.

---

# 128. Residual Risk

Deberá documentarse cuando sea material.

---

# 129. Privacy Gate

Podrá bloquear cambios cuando Requirements críticos no estén satisfechos.

---

# 130. Gate Triggers

Podrán incluir:

```text
new personal data
new purpose
new recipient
new jurisdiction
new tracking
new profiling
new AI/automation use
```

---

# 131. Privacy Decision

Podrá ser:

```text
ALLOW
DENY
REVIEW
ALLOW_WITH_CONDITIONS
```

---

# 132. Processing Inventory

Deberá relacionar:

```text
activity
purpose
data
subjects
basis
systems
recipients
locations
retention
owner
```

---

# 133. Processing Inventory ≠ Data Catalog

Data Catalog describe Assets.

Processing Inventory describe cómo Personal Data es utilizado.

---

# 134. Processing Lineage

Deberá permitir identificar dónde fluye Personal Data cuando sea necesario.

---

# 135. Source

Deberá poder determinarse cuando Privacy Requirement lo requiera.

---

# 136. Recipient

Deberá modelarse explícitamente.

---

# 137. Third-Party Processing

Deberá tratarse como Boundary explícito.

---

# 138. Processor Contract

Podrá declarar:

```text
data
purpose
instructions
retention
security
subprocessing
locations
deletion
audit
```

---

# 139. Third Party ≠ Trusted Automatically

La existencia de integración no constituye Privacy Approval.

---

# 140. Subprocessor

Deberá estar sujeto a Governance apropiada cuando aplique.

---

# 141. Third-Party Termination

Deberá contemplar:

```text
access revocation
data return
data deletion
evidence
```

---

# 142. Cross-Border Processing

Deberá evaluarse conforme Privacy Policy y Governance Residency/Sovereignty.

---

# 143. Cross-Border ≠ Storage Only

Puede incluir:

```text
remote access
support access
replication
processing
backup
analytics
```

---

# 144. Multi-Tenancy Privacy

ENG-048 deberá preservar Subject/Tenant Boundaries.

---

# 145. Cross-Tenant Personal Data

No deberá mezclarse salvo Requirement explícito.

---

# 146. Tenant Analytics

Deberá evaluar Privacy Risk de Aggregation y Re-identification.

---

# 147. Privacy Context

ENG-056 podrá transportar:

```text
purpose
subject
tenant
processing basis
privacy policy
jurisdiction
```

cuando sea necesario.

---

# 148. Privacy Metadata

ENG-057 podrá expresar:

```text
personalData
sensitivity
subjectType
purpose
basis
retention
consentRequirement
rightsApplicability
```

---

# 149. Metadata Leakage

Privacy Metadata también puede revelar información sensible.

---

# 150. Schema Privacy

ENG-062 deberá permitir marcar Fields sujetos a Privacy Controls.

---

# 151. Schema Annotation

Conceptualmente:

```text
email:
  personalData: true
  classification: CONFIDENTIAL
  subject: CUSTOMER
  purposes:
    - ACCOUNT_MANAGEMENT
```

---

# 152. Schema Evolution

Añadir Personal Data deberá poder activar Privacy Review.

---

# 153. Transformation Privacy

ENG-063 deberá preservar Privacy Metadata y evaluar Re-identification.

---

# 154. Derived Data

Una inferencia sobre un Subject deberá entrar al Privacy Model.

---

# 155. Pipeline Privacy

ENG-064 deberá preservar Privacy Context entre Stages.

---

# 156. Pipeline Copy

No deberá crear Storage persistente accidental.

---

# 157. Migration Privacy

ENG-065 deberá preservar:

```text
classification
purpose
retention
consent state
restrictions
rights state
```

cuando corresponda.

---

# 158. Migration Cleanup

Source residual deberá gestionarse según Policy después de Cutover.

---

# 159. Environment Privacy

Production Personal Data no deberá copiarse a Development/Test sin Policy y Controls apropiados.

---

# 160. Synthetic Data

Deberá preferirse cuando satisfaga Testing Requirements.

---

# 161. Masked Production Data

No deberá considerarse automáticamente Anonymous.

---

# 162. API Privacy

ENG-044 deberá aplicar Data Minimization.

---

# 163. Overfetching

APIs no deberán devolver Personal Data innecesario.

---

# 164. Query Privacy

Data Access Engineering deberá limitar Fields y Rows al Purpose.

---

# 165. Cache Privacy

ENG-037 deberá considerar:

```text
classification
tenant
retention
invalidation
deletion
```

---

# 166. Cache Key Privacy

No deberá incluir Personal Data sensible innecesario.

---

# 167. Messaging Privacy

ENG-041 deberá evitar payloads excesivos.

---

# 168. Event Privacy

Eventos deberán transportar únicamente Data necesario.

---

# 169. Event Retention

Logs/event stores deberán respetar Privacy Retention.

---

# 170. Background Jobs Privacy

ENG-040 deberá preservar Privacy Context cuando ejecute Processing diferido.

---

# 171. Context Expiration

Un Job no deberá utilizar Consent/Basis obsoletos sin reevaluación cuando sea necesario.

---

# 172. Serialization Privacy

ENG-031 deberá impedir exposición accidental de Fields privados.

---

# 173. Transport Privacy

ENG-032 deberá aplicar Confidentiality e Integrity apropiadas.

---

# 174. Observability Privacy

ENG-025 deberá tratar Telemetry como posible Personal Data.

---

# 175. Logging

No deberá registrar indiscriminadamente:

```text
passwords
tokens
credentials
sensitive personal data
full request bodies
full response bodies
```

---

# 176. Structured Logging

Deberá favorecer Allowlisting de Fields.

---

# 177. Error Privacy

ENG-023 deberá evitar Disclosure de Personal Data en Errors.

---

# 178. Stack Traces

No deberán exponerse externamente con Data sensible.

---

# 179. Metrics

Labels de alta Cardinality basados en Subjects deberán evitarse.

---

# 180. Tracing

Trace Attributes deberán minimizar Personal Data.

---

# 181. Privacy Security

ENG-024 deberá proporcionar controles de:

```text
confidentiality
integrity
access control
encryption
secret management
security monitoring
```

---

# 182. Encryption ≠ Privacy Compliance

Cifrar Data no legitima un Purpose no autorizado.

---

# 183. Authentication

ENG-045 podrá verificar Subject/Operator Identity.

---

# 184. Authorization

ENG-046 deberá aplicar Privacy-aware Policies cuando corresponda.

---

# 185. IAM

ENG-047 deberá permitir revocar acceso a Personal Data al cambiar Roles/Relationships.

---

# 186. Least Privilege

Deberá combinarse con Need-to-Know y Purpose Limitation.

---

# 187. Privacy Incident

Evento que compromete Privacy Requirements.

---

# 188. Privacy Incident ≠ Data Breach Only

Podrá incluir:

```text
unauthorized purpose
excessive collection
excessive retention
wrong recipient
rights failure
consent failure
re-identification
cross-tenant exposure
```

---

# 189. Incident Severity

Podrá considerar:

```text
data sensitivity
subject count
identifiability
duration
scope
recipient
reversibility
```

---

# 190. Incident Response

Deberá integrarse con Security/Operational Incident Handling.

---

# 191. Privacy Evidence

Podrá incluir:

```text
processing inventory
purpose approval
basis decision
notice version
consent evidence
rights request
retention action
deletion evidence
PIA
third-party approval
```

---

# 192. Evidence Minimization

Evidence no deberá convertirse en nueva colección excesiva de Personal Data.

---

# 193. Privacy Audit

Deberá permitir reconstruir decisiones críticas.

---

# 194. Audit Questions

```text
what data?
whose data?
what purpose?
what basis?
who processed it?
who received it?
where?
when?
for how long?
under which policy?
```

---

# 195. Audit Access

Privacy Audit Data deberá protegerse.

---

# 196. Privacy Observability

Podrá incluir Metrics como:

```text
mef.privacy.processing.total
mef.privacy.processing.denied.total

mef.privacy.consent.withdrawn.total
mef.privacy.consent.expired.total

mef.privacy.rights.request.total
mef.privacy.rights.overdue.total

mef.privacy.retention.overdue.total
mef.privacy.deletion.overdue.total

mef.privacy.policy.violation.total
mef.privacy.incident.total
```

---

# 197. Metric Labels

Podrán incluir:

```text
purpose
dataCategory
requestType
result
severity
```

con Cardinality controlada.

---

# 198. Subject Identifier as Metric Label

No deberá utilizarse.

---

# 199. Privacy Diagnostics

Deberá poder responder:

```text
what Personal Data exists?
where is it?
why is it processed?
under which basis?
which subjects are affected?
who receives it?
how long is it retained?
what consent exists?
what restrictions exist?
which rights requests are active?
which third parties process it?
which privacy risks exist?
```

---

# 200. Privacy Snapshot

Conceptualmente:

```text
PrivacySnapshot
├── processing
├── data
├── subjects
├── purposes
├── bases
├── notices
├── consents
├── recipients
├── retention
├── locations
├── risks
└── state
```

---

# 201. Privacy State

Podrá incluir:

```text
COMPLIANT
DEGRADED
NON_COMPLIANT
EXEMPTED
UNKNOWN
```

---

# 202. UNKNOWN ≠ COMPLIANT

Ausencia de Evidence no demuestra Privacy Compliance.

---

# 203. Privacy Testing

ENG-009 gobernará Testing.

---

# 204. Personal Data Discovery Test

Deberá comprobar que Data clasificado como Personal sea reconocido por Controls.

---

# 205. Purpose Test

Deberá intentar Processing para Purpose no autorizado.

---

# 206. Basis Test

Deberá comprobar Basis inexistente, inválida y expirada.

---

# 207. Consent Test

Deberá cubrir:

```text
unknown
granted
denied
withdrawn
expired
```

---

# 208. Withdrawal Test

Deberá comprobar propagación.

---

# 209. Notice Version Test

Deberá comprobar asociación correcta entre Consent y Notice cuando aplique.

---

# 210. Minimization Test

Deberá detectar:

```text
overcollection
overfetching
overlogging
over-sharing
```

---

# 211. Retention Test

Deberá detectar Personal Data fuera de Retention.

---

# 212. Rights Access Test

Deberá comprobar búsqueda y entrega segura.

---

# 213. Rights Correction Test

Deberá comprobar Source of Truth y downstream propagation.

---

# 214. Rights Deletion Test

Deberá comprobar Stores aplicables.

---

# 215. Rights Restriction Test

Deberá comprobar que Processing prohibido se detenga.

---

# 216. Portability Test

Deberá comprobar formato y seguridad.

---

# 217. Pseudonymization Test

Deberá comprobar separación de Mapping.

---

# 218. Re-identification Test

Deberá evaluar Linkability según Risk Model.

---

# 219. Anonymization Test

No deberá limitarse a comprobar ausencia de Name/Email.

---

# 220. Third-Party Test

Deberá comprobar Recipient y Purpose.

---

# 221. Cross-Border Test

Deberá comprobar Locations y Remote Access.

---

# 222. Multi-Tenant Test

Deberá intentar Cross-Tenant Exposure.

---

# 223. Cache Privacy Test

Deberá comprobar invalidación/deletion.

---

# 224. Messaging Privacy Test

Deberá detectar payload excesivo.

---

# 225. Observability Privacy Test

Deberá buscar Personal Data prohibido en Logs/Traces/Metrics.

---

# 226. Error Privacy Test

Deberá provocar Errors con Inputs sensibles y verificar Redaction.

---

# 227. Environment Privacy Test

Deberá detectar Production Personal Data en Non-Production.

---

# 228. Migration Privacy Test

Deberá comprobar Source Cleanup.

---

# 229. Privacy Drift Test

Deberá comparar Declared Processing con Observed Processing.

---

# 230. Architecture Test

Podrá impedir:

```text
personal data without purpose
unknown consent treated as granted
consent used as universal basis
purpose expansion without review
indefinite retention by default
production PII in development
raw PII in logs
subject IDs in metric labels
pseudonymized data treated as anonymous
remove-name-only anonymization
third-party sharing without policy
cross-tenant personal data exposure
```

---

# 231. Build Integration

ENG-012 podrá validar:

```text
privacy annotations
purpose declarations
processing contracts
retention policies
consent requirements
privacy tests
```

---

# 232. Privacy Tests in CI

Podrán incluir:

```text
schema privacy tests
API minimization tests
serialization tests
logging tests
policy tests
architecture tests
```

---

# 233. Runtime Privacy Verification

Podrá verificar continuamente Processing crítico.

---

# 234. CLI

ENG-007 podrá proporcionar:

```text
mef privacy
mef privacy:inventory
mef privacy:processing
mef privacy:purposes
mef privacy:consents
mef privacy:rights
mef privacy:retention
mef privacy:third-parties
mef privacy:assess
mef privacy:diagnose
```

---

# 235. `mef privacy`

Podrá mostrar Privacy Posture.

---

# 236. `privacy:inventory`

Podrá mostrar Personal Data Assets y Processing Activities.

---

# 237. `privacy:processing`

Podrá mostrar:

```text
activity
purpose
basis
subjects
recipients
retention
```

---

# 238. `privacy:purposes`

Podrá detectar Purpose Drift.

---

# 239. `privacy:consents`

Deberá proteger acceso a Consent Evidence.

---

# 240. `privacy:rights`

Podrá administrar Rights Requests.

---

# 241. `privacy:retention`

Podrá mostrar Personal Data fuera de Policy.

---

# 242. `privacy:third-parties`

Podrá mostrar Processing Boundaries.

---

# 243. `privacy:assess`

Podrá iniciar Privacy Impact Assessment.

---

# 244. `privacy:diagnose`

Podrá mostrar:

```text
processing
personal data
subjects
purpose
basis
consent
notice
recipients
retention
locations
rights
risks
violations
```

---

# 245. Registry Integration

ENG-020 podrá registrar:

```text
PrivacyRequirement
PrivacyPolicy

PersonalDataCategory
DataSubjectType

ProcessingActivity
ProcessingPurpose
ProcessingBasis

PrivacyNotice
Consent
PrivacyPreference

PrivacyRightsRequest

PrivacyImpactAssessment
PrivacyRisk

PrivacyControl
PrivacyException
```

---

# 246. Privacy Requirement Contract

Conceptualmente:

```text
PrivacyRequirement
├── scope
├── data
├── subjects
├── purpose
├── basis
├── notice
├── consent
├── rights
├── retention
├── recipients
├── locations
├── controls
└── evidence
```

---

# 247. Personal Data Category

Conceptualmente:

```text
PersonalDataCategory
├── id
├── classification
├── sensitivity
├── subjectType
├── purposes
└── controls
```

---

# 248. Processing Purpose

Conceptualmente:

```text
ProcessingPurpose
├── id
├── description
├── owner
├── allowedData
├── allowedActions
└── conditions
```

---

# 249. Processing Basis

Conceptualmente:

```text
ProcessingBasis
├── type
├── scope
├── purpose
├── validFrom
├── validUntil
└── evidence
```

---

# 250. Privacy Notice

Conceptualmente:

```text
PrivacyNotice
├── id
├── version
├── purposes
├── dataCategories
├── recipients
├── retention
├── rights
└── effectiveFrom
```

---

# 251. Consent

Conceptualmente:

```text
Consent
├── subject
├── purpose
├── scope
├── state
├── noticeVersion
├── grantedAt
├── expiresAt
├── withdrawnAt
└── evidence
```

---

# 252. Privacy Preference

Conceptualmente:

```text
PrivacyPreference
├── subject
├── category
├── purpose
├── channel
├── value
├── effectiveFrom
└── updatedAt
```

---

# 253. Rights Request

Conceptualmente:

```text
PrivacyRightsRequest
├── id
├── subject
├── right
├── scope
├── state
├── verification
├── decision
├── deadline
└── evidence
```

---

# 254. Privacy Risk

Conceptualmente:

```text
PrivacyRisk
├── id
├── processing
├── threat
├── impact
├── likelihood
├── controls
├── residualRisk
└── owner
```

---

# 255. Privacy Impact Assessment

Conceptualmente:

```text
PrivacyImpactAssessment
├── processing
├── purposes
├── data
├── subjects
├── risks
├── controls
├── residualRisk
├── decision
└── review
```

---

# 256. Privacy Decision

Conceptualmente:

```text
PrivacyDecision
├── subject
├── data
├── action
├── purpose
├── basis
├── context
├── policies
├── decision
└── obligations
```

---

# 257. Privacy Runtime

Conceptualmente:

```text
PrivacyRuntime
├── classify
├── evaluateProcessing
├── evaluatePurpose
├── evaluateBasis
├── resolveConsent
├── resolvePreference
├── processRightsRequest
├── assessRisk
└── diagnose
```

---

# 258. Privacy Registry

Podrá mantener:

```text
data categories
subject types
processing activities
purposes
bases
notices
consents
preferences
rights requests
assessments
controls
```

---

# 259. First Implementation Components

La primera implementación deberá incluir:

```text
PrivacyState

PrivacyRequirement
PrivacyPolicy

PersonalDataCategory
DataSubjectType

ProcessingActivity
ProcessingPurpose
ProcessingBasis

PrivacyNotice

Consent
ConsentState

PrivacyPreference

PrivacyRightsRequest

PrivacyDecision

PrivacyRuntime
PrivacyRegistry

PrivacyError
```

---

# 260. Optional Initial Components

Podrán incorporarse:

```text
PrivacyImpactAssessment
PrivacyRisk
PrivacyControl

PseudonymizationService
AnonymizationAssessment

PrivacySnapshot
PrivacyDiagnostics
```

---

# 261. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Personal Data Discovery
Automated Privacy Classification
Automated PIA
Advanced Re-identification Analysis
Privacy Knowledge Graph
Automated Rights Fulfillment
Adaptive Privacy Policies
AI-Assisted Privacy Engineering
```

---

# 262. Estructura Conceptual

```text
src/
└── Privacy/
    ├── State/
    │   └── PrivacyState
    │
    ├── Requirement/
    │   └── PrivacyRequirement
    │
    ├── Policy/
    │   └── PrivacyPolicy
    │
    ├── Data/
    │   ├── PersonalDataCategory
    │   └── DataSubjectType
    │
    ├── Processing/
    │   ├── ProcessingActivity
    │   ├── ProcessingPurpose
    │   └── ProcessingBasis
    │
    ├── Notice/
    │   └── PrivacyNotice
    │
    ├── Consent/
    │   ├── Consent
    │   └── ConsentState
    │
    ├── Preference/
    │   └── PrivacyPreference
    │
    ├── Rights/
    │   └── PrivacyRightsRequest
    │
    ├── Risk/
    │   ├── PrivacyRisk
    │   └── PrivacyImpactAssessment
    │
    ├── Decision/
    │   └── PrivacyDecision
    │
    ├── Runtime/
    │   └── PrivacyRuntime
    │
    ├── Registry/
    │   └── PrivacyRegistry
    │
    ├── Diagnostics/
    │   └── PrivacyDiagnostics
    │
    └── Error/
        └── PrivacyError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 263. Error Namespace

ENG-082 utilizará:

```text
MEF-PRIVACY-xxx
```

---

# 264. Taxonomía de Errores

```text
MEF-PRIVACY-001 Privacy requirement invalid
MEF-PRIVACY-002 Personal data classification missing
MEF-PRIVACY-003 Processing activity unregistered
MEF-PRIVACY-004 Processing purpose missing
MEF-PRIVACY-005 Processing purpose denied
MEF-PRIVACY-006 Processing basis missing
MEF-PRIVACY-007 Processing basis invalid
MEF-PRIVACY-008 Processing basis expired
MEF-PRIVACY-009 Privacy notice missing
MEF-PRIVACY-010 Privacy notice version invalid

MEF-PRIVACY-011 Consent required
MEF-PRIVACY-012 Consent denied
MEF-PRIVACY-013 Consent withdrawn
MEF-PRIVACY-014 Consent expired
MEF-PRIVACY-015 Consent evidence invalid

MEF-PRIVACY-016 Data minimization violation
MEF-PRIVACY-017 Privacy retention violation
MEF-PRIVACY-018 Privacy deletion overdue

MEF-PRIVACY-019 Rights request invalid
MEF-PRIVACY-020 Rights request verification failed
MEF-PRIVACY-021 Rights request overdue
MEF-PRIVACY-022 Rights request denied

MEF-PRIVACY-023 Pseudonymization failure
MEF-PRIVACY-024 Anonymization requirement failed
MEF-PRIVACY-025 Re-identification risk excessive

MEF-PRIVACY-026 Third-party processing denied
MEF-PRIVACY-027 Cross-border processing denied
MEF-PRIVACY-028 Cross-tenant privacy violation

MEF-PRIVACY-029 Privacy policy conflict
MEF-PRIVACY-030 Privacy invariant violation
```

---

# 265. Invariantes de Ingeniería

ENG-082 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1586 | Todo Processing crítico de Personal Data deberá poseer Data Scope, Subject Scope, Purpose, Processing Basis, Lifecycle, Recipients y Privacy Controls suficientemente explícitos para determinar por qué, cómo, dónde y durante cuánto tiempo puede realizarse. |
| EI-1587 | Privacy deberá permanecer diferenciada de Security, Confidentiality, Consent y Data Governance; Encryption, Authentication, Authorization o Technical Access no deberán interpretarse automáticamente como autorización de Privacy para realizar Processing. |
| EI-1588 | Personal Data deberá identificarse considerando Direct Identifiers, Indirect Identifiers, Derived Data, Metadata y Context y la eliminación de un identificador directo no deberá interpretarse automáticamente como Anonymization. |
| EI-1589 | Todo Processing significativo deberá declarar Purpose identificable y Purpose Limitation deberá impedir reutilización o expansión silenciosa hacia Secondary Purposes no evaluados. |
| EI-1590 | Processing Basis deberá evaluarse respecto de Data, Purpose, Processing y Time aplicables y Consent no deberá utilizarse como Basis universal ni UNKNOWN deberá convertirse automáticamente en autorización. |
| EI-1591 | Cuando Consent sea requerido, deberá poseer Subject, Purpose, Scope, State, Version/Evidence y Lifecycle suficientes y Withdrawal o Expiration deberán propagarse a Processing dependiente conforme Requirements aplicables. |
| EI-1592 | Data Minimization deberá aplicarse a Collection, Processing, Storage, Transmission, API Responses, Messaging y Observability y la existencia de Personal Data en un System no deberá justificar su exposición a todos los Consumers o Processors. |
| EI-1593 | Privacy Retention deberá limitar cuánto tiempo Personal Data permanece identificable y Archive, Cache, Replica, Derived Store, Export, Event Store o Backup no deberán considerarse automáticamente fuera del Privacy Lifecycle. |
| EI-1594 | Data Subject Rights deberán modelarse como procesos verificables y auditables y Subject Verification deberá ser proporcional al Risk sin exigir recolección innecesaria de Personal Data adicional. |
| EI-1595 | Correction, Deletion, Restriction, Objection y Portability deberán coordinarse con Source of Truth, Integrity, Lineage, Retention, Holds, Distributed Processing y Security sin aplicar mutaciones ciegas que comprometan otros invariantes. |
| EI-1596 | Pseudonymized, Tokenized, Masked, Aggregated o De-identified Data no deberá considerarse automáticamente Anonymous y toda declaración de Anonymization deberá considerar Re-identification, Linkability, Uniqueness y Context. |
| EI-1597 | Privacy by Design y Privacy by Default deberán minimizar Collection, Visibility, Sharing y Retention desde Architecture y Configuration y no deberán depender exclusivamente de controles añadidos después de implementar el Processing. |
| EI-1598 | Processing de Privacy Risk elevado deberá poder someterse a Privacy Impact Assessment que documente Processing, Data, Subjects, Purpose, Risks, Controls, Residual Risk, Ownership y Decision. |
| EI-1599 | Third-Party y Cross-Border Processing deberán tratarse como Boundaries explícitos y Technical Integration, Internal Trust, Remote Access, Replication o Backup no deberán interpretarse automáticamente como Privacy Approval. |
| EI-1600 | Multi-Tenant Privacy deberá preservar Subject y Tenant Boundaries y Aggregation, Analytics o Cross-Tenant Processing deberán evaluar Correlation y Re-identification Risk antes de compartir o reutilizar Personal Data. |
| EI-1601 | Schema, Transformation, Pipeline, Migration, API, Cache, Messaging, Background Jobs, Serialization y Transport deberán preservar Privacy Metadata, Purpose, Restrictions y Lifecycle necesarios para mantener Privacy Posture end-to-end. |
| EI-1602 | Logs, Metrics, Traces, Errors y Diagnostics deberán minimizar Personal Data y Secrets; Subject Identifiers no deberán utilizarse como Metric Labels y Production Personal Data no deberá copiarse indiscriminadamente a Non-Production Environments. |
| EI-1603 | Toda Privacy Decision material deberá producir Evidence suficiente para reconstruir Data, Subject Scope, Purpose, Basis, Actor, Recipient, Policy, Time y Result sin convertir Evidence en una nueva colección excesiva de Personal Data. |
| EI-1604 | Privacy Drift e Incidents deberán incluir no solo Unauthorized Disclosure sino también Purpose Drift, Overcollection, Excessive Retention, Wrong Recipient, Consent Failure, Rights Failure, Re-identification y Cross-Tenant Exposure. |
| EI-1605 | La primera implementación deberá priorizar Personal Data Classification, Processing Activities, Purposes, Bases, Notices, Consent, Preferences, Rights, Minimization, Retention, Privacy Decisions, Evidence, Security, Audit y Testing antes de introducir Automatic Discovery, Automated Classification, Privacy Knowledge Graph, Adaptive Policies o AI-Assisted Privacy Engineering. |

---

# 266. Continuidad de Invariantes

```text
ENG-079 → EI-1526 a EI-1545
ENG-080 → EI-1546 a EI-1565
ENG-081 → EI-1566 a EI-1585
ENG-082 → EI-1586 a EI-1605
```

---

# 267. Criterios de Conformidad

Una implementación será conforme con ENG-082 cuando:

- identifique Personal Data;
- permita clasificar Sensitive Personal Data;
- considere Direct e Indirect Identifiers;
- considere Derived Data y Metadata;
- registre Processing Activities críticos;
- defina Processing Purpose;
- aplique Purpose Limitation;
- defina Processing Basis;
- no reduzca Privacy a Consent;
- versione Privacy Notices;
- modele Consent State;
- trate UNKNOWN de forma segura;
- soporte Withdrawal y Expiration;
- modele Privacy Preferences;
- implemente Data Minimization;
- aplique Storage Limitation;
- soporte Rights Requests configurables;
- verifique Subject Identity proporcionalmente;
- coordine Correction con Integrity;
- coordine Deletion con Retention/Recovery;
- soporte Restriction;
- soporte Objection;
- soporte Portability;
- diferencie Pseudonymization y Anonymization;
- evalúe Re-identification Risk;
- implemente Privacy by Design;
- implemente Privacy by Default;
- soporte Privacy Impact Assessments;
- inventaríe Processing relevante;
- gobierne Third-Party Processing;
- gobierne Cross-Border Processing;
- preserve Multi-Tenant Privacy;
- preserve Privacy Metadata;
- minimice Personal Data en Telemetry;
- proteja Non-Production;
- produzca Privacy Evidence;
- implemente Audit;
- implemente Observability;
- implemente Privacy Testing.

---

# 268. Riesgos

Deberán evitarse especialmente:

```text
Privacy Equals Security
Privacy Equals Consent

Encryption Equals Permission to Process

Unknown Consent Equals Granted

Consent for Everything
Bundled Consent

Purpose-Free Processing
Silent Purpose Expansion

Collect Everything
Store Everything
Log Everything

Indefinite Retention

Delete Name Equals Anonymous
Hash Equals Anonymous
Tokenized Equals Anonymous
Masked Equals Anonymous

Ignoring Re-identification

Rights Without Identity Verification
Over-Verification of Subjects

Logical Delete Equals Complete Erasure

Third Party Equals Trusted
Internal Equals Privacy Approved

Cross-Border Equals Storage Only

Production PII in Development

Personal Data in Logs
Personal Data in Errors
Subject IDs in Metric Labels

Cross-Tenant Personal Data Exposure

Privacy Evidence Becoming Shadow PII Store
```

---

# 269. Relación con ENG-079

```text
DATA INTEGRITY
ENG-079

Is the Personal Data
internally valid and trustworthy?
```

Privacy Requests de Correction no deberán comprometer Integrity.

---

# 270. Relación con ENG-080

```text
DATA QUALITY
ENG-080

Is the Personal Data
fit for its authorized purpose?
```

Incorrect Personal Data puede convertirse simultáneamente en Quality y Privacy Issue.

---

# 271. Relación con ENG-081

```text
DATA GOVERNANCE
ENG-081
│
├── Ownership
├── Classification
├── Purpose
├── Policy
├── Retention
├── Residency
└── Sharing

DATA PRIVACY
ENG-082
│
├── Personal Data
├── Data Subject
├── Processing
├── Basis
├── Notice
├── Consent
├── Rights
├── Minimization
├── Pseudonymization
└── Privacy Risk
```

ENG-082 deberá reutilizar Governance Infrastructure en lugar de crear un segundo sistema incompatible de Ownership, Policy o Retention.

---

# 272. Relación con ENG-024

```text
SECURITY
→ protect data from unauthorized
  access/modification/disclosure

PRIVACY
→ determine whether personal data
  should be processed and under
  which conditions
```

Ambas disciplinas son obligatorias.

---

# 273. Relación con ENG-045/046/047

```text
Authentication
      │
      ▼
Actor Identity
      │
      ▼
Authorization
      │
      ▼
Technical Permission
      │
      ▼
Privacy Policy
      │
      ▼
Purpose/Basis Evaluation
      │
      ▼
PROCESS / DENY / REVIEW
```

---

# 274. Relación con ENG-048

Multi-Tenancy deberá preservar:

```text
tenant
subject
purpose
policy
consent
rights
retention
```

---

# 275. Relación con ENG-051

Policy Engineering proporciona el mecanismo general.

ENG-082 especializa:

```text
PrivacyPolicy
ProcessingPolicy
ConsentPolicy
RightsPolicy
```

---

# 276. Relación con ENG-062

Schema Engineering deberá permitir identificar Personal Data sin convertir Schema Metadata en la única fuente de Privacy Truth.

---

# 277. Relación con ENG-063

Data Transformation Engineering deberá reevaluar Privacy cuando genere Derived Data.

---

# 278. Relación con ENG-064

Data Pipeline Engineering deberá preservar Privacy Context durante cada Stage.

---

# 279. Relación con ENG-065

Migration Engineering deberá preservar Privacy Posture durante Source → Target y gestionar Data residual.

---

# 280. Principio Rector

> **MEF deberá asumir que Privacy acompaña al Processing y no únicamente al Storage. Copiar, consultar, transformar, correlacionar, inferir, registrar, exportar o conservar Personal Data son decisiones de Privacy incluso cuando todas ellas sean técnicamente seguras.**

---

# 281. Conclusión

**ENG-082 — Data Privacy Engineering** establece el Privacy Model especializado de MEF.

La cadena conceptual queda:

```text
PERSONAL DATA
      │
      ▼
DATA SUBJECT
      │
      ▼
PROCESSING ACTIVITY
      │
      ▼
PURPOSE
      │
      ▼
PROCESSING BASIS
      │
      ▼
PRIVACY POLICY
      │
      ▼
MINIMIZATION
      │
      ▼
PROCESSING
      │
      ▼
RIGHTS / RETENTION
      │
      ▼
EVIDENCE
```

La frontera fundamental:

```text
ENG-081
DATA GOVERNANCE
│
└── Who governs the Data
    and under which Policies?

ENG-082
DATA PRIVACY
│
└── Under which conditions
    may Personal Data
    be processed?
```

Un procesamiento puede ser:

```text
Authentication     ✓
Authorization      ✓
Encryption         ✓
Data Integrity     ✓
Data Quality       ✓
Data Governance    ✓
```

pero aun así:

```text
Privacy Purpose    ✗
```

por ejemplo:

```text
Personal Data
      │
      ▼
AUTHORIZED USER
      │
      ▼
AUTHORIZED DATA ACCESS
      │
      ▼
UNAUTHORIZED PURPOSE
      │
      ▼
PRIVACY DECISION
      │
      ▼
DENY
```

Por tanto:

```text
TECHNICALLY POSSIBLE
        ≠
PRIVACY PERMITTED
```

La evolución completa queda:

```text
ENG-077  Durability
    │
ENG-078  Consistency
    │
ENG-079  Data Integrity
    │
ENG-080  Data Quality
    │
ENG-081  Data Governance
    │
ENG-082  Data Privacy
```

La serie global alcanza:

```text
EI-1605
```

---

# Referencias

## Ingeniería

- ENG-009 — Testing
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-035 — Domain Engineering
- ENG-037 — Caching Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
- ENG-044 — API Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-051 — Policy Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Data Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-076 — Recoverability Engineering
- ENG-077 — Durability Engineering
- ENG-079 — Data Integrity Engineering
- ENG-080 — Data Quality Engineering
- ENG-081 — Data Governance Engineering
```