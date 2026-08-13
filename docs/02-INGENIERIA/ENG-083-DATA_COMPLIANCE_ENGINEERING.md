---
id: ENG-083
titulo: Data Compliance Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Compliance Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11
dependencias:
  - ENG-009
  - ENG-012
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
  - ENG-082
relacionados:
  - ENG-007
  - ENG-014
  - ENG-017
  - ENG-027
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-036
  - ENG-040
  - ENG-041
  - ENG-043
  - ENG-044
  - ENG-049
  - ENG-050
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-074
  - ENG-075
  - ENG-076
  - ENG-084
keywords:
  - compliance
  - data-compliance
  - compliance-engineering
  - obligation
  - requirement
  - control
  - evidence
  - attestation
  - assessment
  - compliance-status
  - compliance-mapping
  - regulatory-requirement
  - contractual-requirement
  - policy-compliance
  - control-testing
  - exception
  - remediation
  - audit-readiness
  - compliance-drift
  - mef
---

# ENG-083

# Data Compliance Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Compliance Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-083 establece reglas para:

```text
Compliance

Compliance Requirement
Compliance Obligation
Compliance Objective

Compliance Scope

Obligation Source
Obligation Applicability

Regulatory Obligation
Contractual Obligation
Internal Obligation
Policy Obligation

Compliance Mapping

Requirement Mapping
Control Mapping
Evidence Mapping

Compliance Control

Preventive Control
Detective Control
Corrective Control

Manual Control
Automated Control

Control Objective
Control Owner
Control Operator

Control Effectiveness

Design Effectiveness
Operating Effectiveness

Control Test
Compliance Test

Evidence
Evidence Source
Evidence Collector
Evidence Integrity

Attestation

Compliance Assessment

Compliance State
Compliance Finding
Compliance Violation

Compliance Gap

Compliance Exception
Compliance Waiver

Compensating Control

Compliance Remediation

Compliance Baseline
Compliance Drift
Compliance Regression

Audit Readiness

Compliance Security
Compliance Audit
Compliance Observability
Compliance Testing
```

---

# 2. Declaración

> **MEF deberá modelar Compliance como una relación verificable entre Obligations, Requirements, Controls y Evidence. Ningún sistema deberá declararse compliant únicamente porque posea Policies, cifrado, controles de acceso o documentación. Toda afirmación de conformidad deberá poder rastrearse desde una obligación aplicable hasta controles efectivos y evidencia suficiente.**

Modelo fundamental:

```text
OBLIGATION
    │
    ▼
REQUIREMENT
    │
    ▼
CONTROL
    │
    ▼
IMPLEMENTATION
    │
    ▼
EVIDENCE
    │
    ▼
ASSESSMENT
    │
    ▼
COMPLIANCE DECISION
```

---

# 3. Data Compliance Engineering

ENG-083 responde:

```text
Which obligations apply?

Why do they apply?

To which Data Assets?

To which Processing Activities?

Which requirements derive from them?

Which controls satisfy those requirements?

Are the controls actually implemented?

Are the controls operating effectively?

What evidence proves this?

When was the evidence collected?

Is the evidence trustworthy?

Which requirements are not satisfied?

Are exceptions valid?

Which remediation actions remain open?

Can the compliance posture be demonstrated?
```

---

# 4. Compliance

`Compliance` representa el grado verificable en que un Scope satisface Obligations y Requirements aplicables.

---

# 5. Compliance ≠ Governance

ENG-081 determina:

```text
who owns data
which policies govern it
how its lifecycle is controlled
```

ENG-083 determina:

```text
whether applicable obligations
are actually being satisfied
and whether sufficient evidence
exists to demonstrate it
```

---

# 6. Compliance ≠ Privacy

ENG-082 gobierna Privacy Engineering.

ENG-083 puede verificar cumplimiento de Privacy Requirements, pero no deberá redefinir:

```text
PersonalData
ProcessingPurpose
ProcessingBasis
Consent
PrivacyRightsRequest
PrivacyPolicy
```

---

# 7. Compliance ≠ Security

Security Controls pueden ser parte de Compliance.

Pero:

```text
secure
≠
compliant
```

y:

```text
compliant
≠
secure against every threat
```

---

# 8. Compliance ≠ Audit

Audit es un mecanismo de evaluación/evidencia.

Compliance es el estado respecto de Obligations.

---

# 9. Compliance ≠ Documentation

Un documento afirmando que existe un Control no demuestra que opere correctamente.

---

# 10. Compliance Requirement

Representa un Requirement verificable derivado de una Obligation aplicable.

Conceptualmente:

```text
ComplianceRequirement
├── id
├── obligation
├── scope
├── statement
├── controls
├── evidence
├── criticality
└── owner
```

---

# 11. Obligation

Representa una obligación cuyo cumplimiento debe evaluarse.

---

# 12. Obligation Source

Podrá ser:

```text
REGULATORY
CONTRACTUAL
POLICY
SECURITY
PRIVACY
GOVERNANCE
CUSTOMER
INTERNAL
OTHER
```

---

# 13. Regulation-Agnostic Core

MEF no deberá codificar una legislación, estándar o regulación concreta como verdad universal del Core.

---

# 14. Compliance Profile

Las obligaciones concretas deberán introducirse mediante Profiles, Policies, Extensions o Configuration gobernada.

Ejemplo:

```text
ComplianceProfile
├── id
├── jurisdiction
├── obligations
├── effectiveFrom
├── version
└── metadata
```

---

# 15. Applicability

Antes de evaluar Compliance deberá determinarse si una Obligation aplica.

---

# 16. Applicability Context

Podrá considerar:

```text
jurisdiction
organization
industry
contract
data category
processing activity
subject type
tenant
location
purpose
service
```

---

# 17. NOT_APPLICABLE

Deberá distinguirse de:

```text
COMPLIANT
```

---

# 18. Applicability Unknown

No deberá convertirse automáticamente en:

```text
NOT_APPLICABLE
```

---

# 19. Effective Period

Las Obligations deberán poder declarar:

```text
effectiveFrom
effectiveUntil
```

---

# 20. Historical Compliance

Una evaluación histórica deberá utilizar la versión aplicable en ese momento.

---

# 21. Obligation Versioning

Cambios materiales deberán versionarse.

---

# 22. Requirement Derivation

Una misma Obligation podrá producir múltiples Requirements técnicos y operacionales.

Ejemplo:

```text
OBLIGATION
    │
    ├──► RETENTION REQUIREMENT
    ├──► ACCESS REQUIREMENT
    ├──► AUDIT REQUIREMENT
    └──► DELETION REQUIREMENT
```

---

# 23. Requirement Traceability

Todo Requirement contractual deberá poder rastrearse hasta su Source.

---

# 24. Compliance Mapping

Relaciona:

```text
OBLIGATION
↕
REQUIREMENT
↕
CONTROL
↕
EVIDENCE
```

---

# 25. Many-to-Many Mapping

Una obligación puede usar varios Controls.

Un Control puede satisfacer varias Obligations.

---

# 26. Shared Control

Ejemplo:

```text
Access Review
```

puede contribuir simultáneamente a:

```text
Security
Privacy
Governance
Contractual Compliance
```

---

# 27. Control Reuse

Deberá favorecerse sin perder Traceability.

---

# 28. Compliance Control

Mecanismo utilizado para satisfacer uno o varios Requirements.

---

# 29. Control Contract

Conceptualmente:

```text
ComplianceControl
├── id
├── objective
├── type
├── requirements
├── implementation
├── owner
├── operator
├── frequency
├── evidence
└── test
```

---

# 30. Preventive Control

Evita una condición no conforme.

Ejemplo:

```text
deny deployment
when mandatory classification is absent
```

---

# 31. Detective Control

Detecta una condición no conforme.

Ejemplo:

```text
scan for unclassified data assets
```

---

# 32. Corrective Control

Restaura Compliance después de detectar Gap.

---

# 33. Manual Control

Podrá ser válido.

No deberá declararse inexistente únicamente por no estar automatizado.

---

# 34. Automated Control

Podrá reducir variabilidad y mejorar Evidence.

---

# 35. Automation ≠ Effective Control

Un Control automatizado incorrectamente configurado puede fallar sistemáticamente.

---

# 36. Control Objective

Deberá definir claramente qué riesgo o Requirement intenta satisfacer.

---

# 37. Control Owner

Responsable de la efectividad del Control.

---

# 38. Control Operator

Actor o componente que ejecuta el Control.

---

# 39. Owner ≠ Operator

Deberán poder ser distintos.

---

# 40. Control Frequency

Podrá ser:

```text
CONTINUOUS
PER_EVENT
DAILY
WEEKLY
MONTHLY
QUARTERLY
ANNUAL
ON_DEMAND
```

---

# 41. Frequency Requirement

Deberá derivarse de Criticality y Obligation.

---

# 42. Design Effectiveness

Responde:

```text
If this control operates as designed,
can it satisfy the intended requirement?
```

---

# 43. Operating Effectiveness

Responde:

```text
Did the control actually operate
as required during the period?
```

---

# 44. Design Effective ≠ Operating Effective

No deberán confundirse.

---

# 45. Control State

Podrá incluir:

```text
DESIGNED
IMPLEMENTED
OPERATING
DEGRADED
FAILED
NOT_TESTED
RETIRED
```

---

# 46. NOT_TESTED ≠ EFFECTIVE

Ausencia de Failure no demuestra efectividad.

---

# 47. Compliance Evidence

Artifact o información utilizada para demostrar que un Requirement o Control fue satisfecho.

---

# 48. Evidence Types

Podrán incluir:

```text
configuration
audit record
test result
access review
deployment record
policy decision
approval
system report
integrity check
retention execution
deletion verification
```

---

# 49. Evidence Contract

Conceptualmente:

```text
ComplianceEvidence
├── id
├── requirement
├── control
├── source
├── collectedAt
├── period
├── integrity
├── collector
└── metadata
```

---

# 50. Evidence Freshness

Evidence demasiado antigua puede no demostrar Compliance actual.

---

# 51. Evidence Period

Deberá declarar qué intervalo demuestra.

---

# 52. Evidence Integrity

Deberá protegerse contra:

```text
tampering
deletion
fabrication
unauthorized mutation
```

---

# 53. Evidence Provenance

Deberá ser identificable.

---

# 54. Self-Reported Evidence

Podrá utilizarse, pero deberá distinguirse de Evidence independiente.

---

# 55. Generated Evidence

Deberá poder relacionarse con Version/Configuration correspondiente.

---

# 56. Screenshot Evidence

No deberá ser el mecanismo primario cuando exista Evidence estructurada y reproducible.

---

# 57. Evidence Minimization

No deberá recopilarse Data sensible innecesario para demostrar Compliance.

---

# 58. Evidence Retention

Deberá poseer Retention Policy.

---

# 59. Evidence Access

Deberá restringirse según Sensitivity.

---

# 60. Evidence Chain

Conceptualmente:

```text
SOURCE
  │
  ▼
COLLECT
  │
  ▼
VERIFY
  │
  ▼
STORE
  │
  ▼
ASSESS
  │
  ▼
AUDIT
```

---

# 61. Evidence Collector

Podrá ser:

```text
runtime
CI/CD
auditor
operator
scanner
control system
```

---

# 62. Evidence Collector Trust

Deberá evaluarse.

---

# 63. Attestation

Declaración formal de que determinado Control o Requirement ha sido evaluado.

---

# 64. Attestation ≠ Evidence

Attestation puede referenciar Evidence.

No deberá sustituirla automáticamente.

---

# 65. Attestation Scope

Deberá declarar:

```text
subject
scope
period
requirements
evidence
actor
result
```

---

# 66. Compliance Assessment

Evalúa Requirements aplicables y determina Compliance State.

---

# 67. Assessment Inputs

Podrán incluir:

```text
obligations
requirements
controls
test results
evidence
exceptions
findings
```

---

# 68. Assessment Result

Conceptualmente:

```text
ComplianceAssessment
├── scope
├── profile
├── requirements
├── compliant
├── nonCompliant
├── notApplicable
├── unknown
├── exceptions
├── findings
└── assessedAt
```

---

# 69. Compliance State

Podrá incluir:

```text
COMPLIANT
PARTIALLY_COMPLIANT
NON_COMPLIANT
EXEMPTED
NOT_APPLICABLE
UNKNOWN
```

---

# 70. COMPLIANT

Todos los Requirements obligatorios aplicables evaluados se satisfacen dentro del Scope.

---

# 71. PARTIALLY_COMPLIANT

Algunos Requirements aplicables permanecen insatisfechos o incompletamente demostrados.

---

# 72. NON_COMPLIANT

Existe Requirement obligatorio incumplido.

---

# 73. EXEMPTED

Existe Exception/Waiver válida para el Requirement correspondiente.

---

# 74. NOT_APPLICABLE

La Obligation no aplica al Scope.

---

# 75. UNKNOWN

No existe Evidence suficiente o Applicability no pudo determinarse.

---

# 76. UNKNOWN ≠ COMPLIANT

Principio obligatorio.

---

# 77. Compliance Finding

Representa observación resultante de Assessment/Test.

---

# 78. Finding Types

Podrán incluir:

```text
OBSERVATION
IMPROVEMENT
GAP
VIOLATION
EVIDENCE_MISSING
CONTROL_FAILURE
```

---

# 79. Compliance Gap

Diferencia entre Requirement y estado actual.

---

# 80. Compliance Violation

Incumplimiento demostrado de Requirement obligatorio.

---

# 81. Gap ≠ Violation Automatically

Un Gap de Evidence puede no demostrar aún violación operacional.

---

# 82. Severity

Podrá clasificarse:

```text
LOW
MEDIUM
HIGH
CRITICAL
```

---

# 83. Severity Inputs

Podrán incluir:

```text
requirement criticality
data sensitivity
scope
duration
affected tenants
affected subjects
control failure
repeat occurrence
```

---

# 84. Compliance Exception

Deberá reutilizar el modelo de Exception de Governance cuando corresponda.

---

# 85. Exception Requirement

Deberá declarar:

```text
requirement
scope
reason
authority
risk
compensating controls
effectiveFrom
expiresAt
```

---

# 86. Exception ≠ Compliance

Un Scope exceptuado deberá permanecer:

```text
EXEMPTED
```

y no:

```text
COMPLIANT
```

si el Requirement original continúa incumplido.

---

# 87. Compensating Control

Control alternativo utilizado para reducir Risk cuando Control primario no puede aplicarse.

---

# 88. Compensating Control Equivalence

No deberá asumirse.

Deberá evaluarse respecto del Control Objective.

---

# 89. Exception Expiration

Deberá generar reevaluación automática o revisión.

---

# 90. Permanent Exception

Deberá provocar revisión del Requirement/Architecture.

---

# 91. Compliance Remediation

Acciones destinadas a cerrar Finding, Gap o Violation.

---

# 92. Remediation Plan

Conceptualmente:

```text
ComplianceRemediation
├── finding
├── rootCause
├── owner
├── actions
├── targetDate
├── controls
├── verification
└── state
```

---

# 93. Remediation State

Podrá incluir:

```text
OPEN
PLANNED
IN_PROGRESS
BLOCKED
READY_FOR_VERIFICATION
CLOSED
ACCEPTED
```

---

# 94. Closure

No deberá ocurrir únicamente porque el cambio fue implementado.

---

# 95. Closure Verification

Deberá comprobar que:

```text
requirement satisfied
control effective
evidence available
regression absent
```

---

# 96. Root Cause

Deberá distinguirse del Finding superficial.

---

# 97. Repeat Finding

Podrá indicar Control Design o Operating Failure sistémico.

---

# 98. Compliance Baseline

Representa Compliance Posture conocida para:

```text
requirements
controls
evidence
exceptions
findings
```

---

# 99. Compliance Drift

Ocurre cuando estado observado se separa del Baseline o Compliance Model.

---

# 100. Drift Examples

```text
mandatory encryption disabled

new data store lacks classification

new region violates residency control

access review stops executing

retention job fails

evidence collection stops

expired exception remains active
```

---

# 101. Compliance Regression

Nueva Version o Configuration reduce Compliance Posture.

---

# 102. Regression Example

```text
before:
all required controls effective

after deployment:
audit events missing
```

---

# 103. Compliance Gate

Podrá bloquear:

```text
build
release
deployment
migration
data publication
new integration
new processing activity
external sharing
```

---

# 104. Gate Inputs

Podrán incluir:

```text
critical requirements
control status
evidence
open violations
expired exceptions
assessment result
```

---

# 105. Gate Result

Podrá ser:

```text
PASS
WARN
BLOCK
REVIEW_REQUIRED
```

---

# 106. Gate Override

Deberá requerir Authority, Reason, Scope, Expiration y Audit.

---

# 107. Audit Readiness

Capacidad de producir rápidamente Evidence y Traceability suficientes para una evaluación autorizada.

---

# 108. Audit Readiness ≠ Continuous Compliance

No deberán confundirse.

---

# 109. Continuous Compliance

Podrá evaluar automáticamente determinados Requirements durante Runtime o CI/CD.

---

# 110. Continuous ≠ Complete

No todos los Requirements pueden verificarse continuamente.

---

# 111. Point-in-Time Compliance

Determina estado en un momento concreto.

---

# 112. Period Compliance

Determina estado durante un intervalo.

---

# 113. Current Compliance ≠ Historical Compliance

No deberán confundirse.

---

# 114. Compliance Snapshot

Conceptualmente:

```text
ComplianceSnapshot
├── scope
├── profile
├── state
├── requirements
├── controls
├── evidenceCoverage
├── findings
├── exceptions
└── observedAt
```

---

# 115. Evidence Coverage

Podrá medir proporción de Requirements que poseen Evidence suficiente.

---

# 116. Evidence Coverage ≠ Compliance Score

Tener evidencia completa de un Control fallido no hace al sistema compliant.

---

# 117. Compliance Score

Podrá utilizarse solo como señal agregada.

---

# 118. Score Restrictions

No deberá:

```text
hide critical violations
convert UNKNOWN into PASS
treat NOT_APPLICABLE as satisfied
hide expired exceptions
```

---

# 119. Critical Requirement

Una única violación crítica podrá determinar:

```text
NON_COMPLIANT
```

independientemente del Score agregado.

---

# 120. Compliance and Data Governance

ENG-081 define:

```text
assets
owners
classification
purposes
retention
residency
sharing
```

ENG-083 verifica que Requirements sobre dichos conceptos estén satisfechos.

---

# 121. Governance Evidence

Podrá reutilizarse como Compliance Evidence.

---

# 122. Compliance and Privacy

ENG-082 define:

```text
personal data
processing
purpose
basis
consent
rights
privacy risks
```

ENG-083 podrá verificar Requirements derivados sin duplicar esos modelos.

---

# 123. Compliance and Security

ENG-024 proporciona Security Controls y Evidence técnica.

---

# 124. Security Control Mapping

Ejemplo:

```text
Compliance Requirement
      │
      ▼
Encryption Required
      │
      ▼
Security Control
      │
      ▼
Encryption Configuration
      │
      ▼
Verification Evidence
```

---

# 125. Compliance and IAM

ENG-045/046/047 podrán proporcionar Evidence sobre:

```text
identity
access
entitlements
access reviews
revocation
```

---

# 126. Compliance and Policy

ENG-051 proporciona Policy Infrastructure.

---

# 127. Compliance Policy

No deberá crear un segundo Policy Engine.

Deberá reutilizar ENG-051.

---

# 128. Compliance and Metadata

ENG-057 deberá permitir Metadata como:

```text
requirementId
controlId
evidenceType
complianceProfile
criticality
```

---

# 129. Compliance and Discovery

ENG-058 podrá localizar Resources que deberían entrar al Compliance Scope.

---

# 130. Discovered Resource

No deberá considerarse compliant hasta su evaluación.

---

# 131. Compliance and Resolution

ENG-059 podrá resolver Requirements/Profiles según Context.

---

# 132. Compliance and Extensions

ENG-029/060 deberán registrar Compliance Impact de Extensions cuando corresponda.

---

# 133. Third-Party Component

No deberá considerarse compliant únicamente por poseer certificación externa.

---

# 134. External Certification

Podrá formar parte de Evidence, no necesariamente sustituir evaluación interna.

---

# 135. Compliance and Interoperability

ENG-061 deberá preservar Evidence/Requirement Metadata cuando atraviese Boundaries relevantes.

---

# 136. Compliance and Schema

ENG-062 podrá proporcionar Evidence de:

```text
required fields
classification annotations
constraints
```

---

# 137. Compliance and Data Transformation

ENG-063 deberá permitir verificar que Transformations preservan Requirements aplicables.

---

# 138. Compliance and Pipelines

ENG-064 podrá introducir Compliance Gates.

---

# 139. Compliance and Migration

ENG-065 deberá verificar Compliance antes y después de Migration.

---

# 140. Migration Compliance Regression

Ejemplos:

```text
lost auditability
wrong residency
lost retention metadata
missing encryption
```

---

# 141. Compliance and Upgrade

ENG-066 deberá detectar cambios de Controls.

---

# 142. Compliance and Deployment

ENG-067 podrá evaluar Compliance Gates antes de Promotion.

---

# 143. Compliance and Environment

ENG-068 deberá distinguir Requirements por Environment.

---

# 144. Production Compliance

No deberá inferirse automáticamente de Tests en Development.

---

# 145. Compliance and Observability

ENG-025 proporcionará Telemetry.

---

# 146. Compliance Observability

Podrá incluir:

```text
mef.compliance.requirement.total
mef.compliance.requirement.failed.total

mef.compliance.control.total
mef.compliance.control.failed.total

mef.compliance.evidence.missing.total
mef.compliance.exception.active.total
mef.compliance.exception.expired.total

mef.compliance.finding.open.total
mef.compliance.remediation.overdue.total
```

---

# 147. Compliance Labels

Podrán incluir:

```text
profile
requirementType
controlType
severity
state
```

con Cardinality controlada.

---

# 148. Evidence IDs as Metric Labels

No deberán utilizarse indiscriminadamente.

---

# 149. Compliance Diagnostics

Deberá poder responder:

```text
which compliance profiles apply?

which obligations apply?

which requirements derive from them?

which controls satisfy each requirement?

are those controls implemented?

are they effective?

what evidence exists?

which evidence is stale?

which gaps remain?

which exceptions are active?

which remediation items are overdue?
```

---

# 150. Compliance Security

ENG-024 gobernará Security general.

---

# 151. Compliance Metadata Security

Deberán protegerse especialmente:

```text
obligations
control weaknesses
findings
exceptions
evidence
audit results
```

---

# 152. Evidence Tampering

Constituye Compliance + Security Violation.

---

# 153. Control Tampering

No deberá poder hacerse sin Authority.

---

# 154. False Attestation

Deberá prevenirse y auditarse.

---

# 155. Separation of Duties

Podrá requerirse entre:

```text
control operator
control owner
control tester
assessor
approver
```

---

# 156. Self-Assessment

Podrá utilizarse, pero deberá declararse como tal.

---

# 157. Independent Assessment

Podrá requerirse por Compliance Profile.

---

# 158. Compliance Audit

Toda decisión material deberá ser auditada.

---

# 159. Audit Events

Podrán incluir:

```text
obligation registered
requirement changed
control changed
control test executed
evidence collected
assessment completed
finding opened
finding closed
exception granted
exception expired
remediation verified
compliance gate overridden
```

---

# 160. Compliance Testing

ENG-009 gobernará Testing.

---

# 161. Applicability Test

Deberá comprobar:

```text
applicable
not applicable
unknown
```

---

# 162. Requirement Mapping Test

Deberá detectar Obligations sin Requirements.

---

# 163. Control Mapping Test

Deberá detectar Requirements sin Controls cuando sean exigibles.

---

# 164. Evidence Mapping Test

Deberá detectar Controls sin Evidence esperada.

---

# 165. Control Design Test

Deberá comprobar que el Control pueda satisfacer Objective.

---

# 166. Operating Effectiveness Test

Deberá comprobar ejecución real.

---

# 167. Evidence Freshness Test

Deberá detectar Evidence stale.

---

# 168. Evidence Integrity Test

Deberá detectar manipulación.

---

# 169. Exception Expiration Test

Deberá comprobar que Exception deje de aplicarse.

---

# 170. Compensating Control Test

Deberá verificar Objective equivalente requerido.

---

# 171. Compliance Drift Test

Deberá modificar Observed State y detectar desviación.

---

# 172. Regression Test

Deberá comparar Baseline y Candidate.

---

# 173. Gate Test

Deberá cubrir:

```text
PASS
WARN
BLOCK
REVIEW_REQUIRED
OVERRIDE
```

---

# 174. Privacy Compliance Test

Podrá reutilizar Evidence generada por ENG-082.

---

# 175. Governance Compliance Test

Podrá reutilizar Evidence generada por ENG-081.

---

# 176. Security Compliance Test

Podrá reutilizar Security Control Evidence.

---

# 177. Multi-Tenant Compliance Test

Deberá impedir que Compliance de un Tenant o Scope oculte Failure de otro cuando Requirements sean independientes.

---

# 178. Environment Compliance Test

Deberá verificar Profiles diferentes por Environment.

---

# 179. Third-Party Compliance Test

Deberá comprobar Evidence y Scope, no solo existencia de una certificación.

---

# 180. Architecture Test

Podrá impedir:

```text
compliance without obligations

requirement without source

applicability unknown treated as not applicable

control without owner

control never tested

not tested treated as effective

evidence missing treated as compliant

expired evidence treated as current

exception treated as compliance

expired exception still active

aggregate score hides critical violation

external certification treated as universal proof

policy document treated as operating evidence
```

---

# 181. Build Integration

ENG-012 podrá validar:

```text
compliance profiles
obligation declarations
requirement mappings
control mappings
evidence definitions
exception metadata
```

---

# 182. Compliance Tests in CI

Podrán incluir:

```text
policy tests
control tests
architecture tests
evidence-generation tests
mapping tests
regression tests
```

---

# 183. Runtime Compliance Verification

Podrá validar Controls continuos.

---

# 184. CLI

ENG-007 podrá proporcionar:

```text
mef compliance
mef compliance:profiles
mef compliance:obligations
mef compliance:requirements
mef compliance:controls
mef compliance:evidence
mef compliance:assess
mef compliance:findings
mef compliance:exceptions
mef compliance:remediation
mef compliance:diagnose
```

---

# 185. `mef compliance`

Podrá mostrar:

```text
state
profiles
critical findings
evidence coverage
exceptions
```

---

# 186. `compliance:profiles`

Podrá mostrar Profiles activos.

---

# 187. `compliance:obligations`

Podrá mostrar:

```text
source
applicability
version
effective period
```

---

# 188. `compliance:requirements`

Podrá mostrar Requirement Traceability.

---

# 189. `compliance:controls`

Podrá mostrar:

```text
objective
owner
operator
state
lastTest
```

---

# 190. `compliance:evidence`

Podrá mostrar:

```text
source
period
freshness
integrity
coverage
```

---

# 191. `compliance:assess`

Podrá ejecutar Compliance Assessment.

---

# 192. `compliance:findings`

Podrá mostrar Findings abiertos.

---

# 193. `compliance:exceptions`

Podrá mostrar:

```text
scope
reason
authority
controls
expiration
```

---

# 194. `compliance:remediation`

Podrá mostrar Remediation Plan y estado.

---

# 195. `compliance:diagnose`

Podrá mostrar:

```text
profiles
obligations
applicability
requirements
controls
tests
evidence
findings
exceptions
remediation
state
```

---

# 196. Registry Integration

ENG-020 podrá registrar:

```text
ComplianceProfile
ComplianceObligation
ComplianceRequirement
ComplianceControl
ComplianceEvidence
ComplianceAssessment
ComplianceFinding
ComplianceException
ComplianceRemediation
```

---

# 197. Compliance Profile

Conceptualmente:

```text
ComplianceProfile
├── id
├── name
├── scope
├── jurisdiction
├── obligations
├── version
├── effectiveFrom
└── metadata
```

---

# 198. Compliance Obligation

Conceptualmente:

```text
ComplianceObligation
├── id
├── source
├── statement
├── applicability
├── version
├── effectiveFrom
├── effectiveUntil
└── metadata
```

---

# 199. Compliance Requirement

Conceptualmente:

```text
ComplianceRequirement
├── id
├── obligation
├── scope
├── statement
├── criticality
├── controls
└── owner
```

---

# 200. Compliance Control

Conceptualmente:

```text
ComplianceControl
├── id
├── objective
├── type
├── owner
├── operator
├── implementation
├── frequency
├── evidence
└── state
```

---

# 201. Control Test Result

Conceptualmente:

```text
ControlTestResult
├── control
├── designEffective
├── operatingEffective
├── evidence
├── findings
├── testedAt
└── tester
```

---

# 202. Compliance Evidence

Conceptualmente:

```text
ComplianceEvidence
├── id
├── requirement
├── control
├── source
├── period
├── collectedAt
├── integrity
└── metadata
```

---

# 203. Compliance Finding

Conceptualmente:

```text
ComplianceFinding
├── id
├── requirement
├── control
├── type
├── severity
├── evidence
├── owner
├── state
└── detectedAt
```

---

# 204. Compliance Exception

Conceptualmente:

```text
ComplianceException
├── requirement
├── scope
├── reason
├── authority
├── risk
├── compensatingControls
├── approvedAt
└── expiresAt
```

---

# 205. Compliance Assessment

Conceptualmente:

```text
ComplianceAssessment
├── scope
├── profile
├── requirements
├── controls
├── evidence
├── findings
├── exceptions
├── state
└── assessedAt
```

---

# 206. Compliance Runtime

Conceptualmente:

```text
ComplianceRuntime
├── resolveProfiles
├── resolveApplicability
├── evaluateRequirements
├── evaluateControls
├── collectEvidence
├── assess
├── detectDrift
└── diagnose
```

---

# 207. Compliance Registry

Podrá mantener:

```text
profiles
obligations
requirements
controls
evidence descriptors
assessments
findings
exceptions
remediations
```

---

# 208. First Implementation Components

La primera implementación deberá incluir:

```text
ComplianceState

ComplianceProfile
ComplianceObligation
ComplianceRequirement

ComplianceControl
ControlState
ControlTestResult

ComplianceEvidence

ComplianceAssessment
ComplianceFinding

ComplianceException
ComplianceRemediation

ComplianceRuntime
ComplianceRegistry

ComplianceError
```

---

# 209. Optional Initial Components

Podrán incorporarse:

```text
ComplianceSnapshot
ComplianceGate

ComplianceBaseline
ComplianceDriftDetector

Attestation

ComplianceDiagnostics
```

---

# 210. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Obligation Ingestion
Semantic Requirement Mapping
Automatic Control Mapping
Continuous Evidence Collection Platform
Compliance Knowledge Graph
Predictive Compliance Risk
AI-Assisted Compliance Assessment
```

---

# 211. Estructura Conceptual

```text
src/
└── Compliance/
    ├── State/
    │   └── ComplianceState
    │
    ├── Profile/
    │   └── ComplianceProfile
    │
    ├── Obligation/
    │   └── ComplianceObligation
    │
    ├── Requirement/
    │   └── ComplianceRequirement
    │
    ├── Control/
    │   ├── ComplianceControl
    │   ├── ControlState
    │   └── ControlTestResult
    │
    ├── Evidence/
    │   └── ComplianceEvidence
    │
    ├── Assessment/
    │   └── ComplianceAssessment
    │
    ├── Finding/
    │   └── ComplianceFinding
    │
    ├── Exception/
    │   └── ComplianceException
    │
    ├── Remediation/
    │   └── ComplianceRemediation
    │
    ├── Baseline/
    │   └── ComplianceBaseline
    │
    ├── Drift/
    │   └── ComplianceDriftDetector
    │
    ├── Gate/
    │   └── ComplianceGate
    │
    ├── Attestation/
    │   └── Attestation
    │
    ├── Runtime/
    │   └── ComplianceRuntime
    │
    ├── Registry/
    │   └── ComplianceRegistry
    │
    ├── Diagnostics/
    │   └── ComplianceDiagnostics
    │
    └── Error/
        └── ComplianceError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 212. Error Namespace

ENG-083 utilizará:

```text
MEF-COMPLIANCE-xxx
```

---

# 213. Taxonomía de Errores

```text
MEF-COMPLIANCE-001 Compliance profile invalid
MEF-COMPLIANCE-002 Compliance obligation invalid
MEF-COMPLIANCE-003 Compliance applicability unknown
MEF-COMPLIANCE-004 Compliance requirement invalid
MEF-COMPLIANCE-005 Compliance requirement unmapped
MEF-COMPLIANCE-006 Compliance control missing
MEF-COMPLIANCE-007 Compliance control invalid
MEF-COMPLIANCE-008 Compliance control owner missing
MEF-COMPLIANCE-009 Compliance control not tested
MEF-COMPLIANCE-010 Compliance control failed

MEF-COMPLIANCE-011 Compliance evidence missing
MEF-COMPLIANCE-012 Compliance evidence stale
MEF-COMPLIANCE-013 Compliance evidence integrity violation
MEF-COMPLIANCE-014 Compliance evidence insufficient

MEF-COMPLIANCE-015 Compliance assessment failed
MEF-COMPLIANCE-016 Compliance finding detected
MEF-COMPLIANCE-017 Compliance critical violation

MEF-COMPLIANCE-018 Compliance exception invalid
MEF-COMPLIANCE-019 Compliance exception expired
MEF-COMPLIANCE-020 Compensating control insufficient

MEF-COMPLIANCE-021 Compliance remediation overdue
MEF-COMPLIANCE-022 Compliance remediation verification failed

MEF-COMPLIANCE-023 Compliance drift detected
MEF-COMPLIANCE-024 Compliance regression detected

MEF-COMPLIANCE-025 Compliance gate failed
MEF-COMPLIANCE-026 Compliance gate override denied
MEF-COMPLIANCE-027 Compliance authorization denied
MEF-COMPLIANCE-028 Compliance security violation
MEF-COMPLIANCE-029 Compliance state unknown
MEF-COMPLIANCE-030 Compliance invariant violation
```

---

# 214. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Compliance Profiles

Explicit Obligations
Explicit Applicability

Requirement Traceability

Control Mapping
Control Ownership

Design Effectiveness
Operating Effectiveness

Evidence
Evidence Freshness
Evidence Integrity

Assessments
Findings

Exceptions
Compensating Controls

Remediation
Closure Verification

Compliance Drift
Compliance Gates

Security
Audit
Observability
Testing
```

---

# 215. First Version Non-Goals

No deberá requerir:

```text
Automatic Regulation Parsing
Automatic Legal Interpretation
Semantic Obligation Extraction
Automatic Requirement Mapping
Automatic Control Mapping
Predictive Compliance Risk
AI-Assisted Compliance Decisions
```

---

# 216. Second Phase

Podrá incorporar:

```text
Compliance Baselines
Compliance Gates
Compliance Snapshots

Automated Evidence Collection

Compliance Drift Detection

Attestations

Audit Readiness Reports

Cross-Profile Control Reuse
```

---

# 217. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Obligation Ingestion
Semantic Requirement Mapping
Compliance Knowledge Graph
Advanced Continuous Compliance
Predictive Compliance Risk
Automated Audit Packages
AI-Assisted Compliance Engineering
```

---

# 218. Invariantes de Ingeniería

ENG-083 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1606 | Toda afirmación de Compliance deberá poder rastrearse desde una Obligation aplicable hasta Requirements, Controls y Evidence suficientes; la existencia de Policies, Documentation o Security Features no deberá considerarse prueba automática de conformidad. |
| EI-1607 | Compliance deberá permanecer diferenciada de Governance, Privacy, Security, Audit y Documentation y ningún estado de esas disciplinas deberá convertirse automáticamente en Compliance sin evaluar Obligations aplicables. |
| EI-1608 | Toda Obligation deberá poseer Source, Scope, Version, Effective Period y Applicability suficientes y `UNKNOWN` no deberá convertirse automáticamente en `NOT_APPLICABLE` ni `COMPLIANT`. |
| EI-1609 | El Core de MEF deberá permanecer regulation-agnostic y las obligaciones jurídicas, contractuales o sectoriales concretas deberán incorporarse mediante Compliance Profiles configurables y versionados. |
| EI-1610 | Todo Compliance Requirement deberá conservar Traceability hacia su Obligation de origen y toda transformación de texto normativo o contractual hacia Requirement técnico deberá poder revisarse y auditarse. |
| EI-1611 | Compliance Controls deberán declarar Objective, Requirements, Owner, Operator, Implementation, Frequency, Evidence y Testing suficientes y ningún Control sin Owner o nunca probado deberá considerarse efectivo. |
| EI-1612 | Design Effectiveness y Operating Effectiveness deberán evaluarse separadamente y un Control correctamente diseñado no deberá considerarse operativo únicamente porque exista en Configuration o Documentation. |
| EI-1613 | Compliance Evidence deberá poseer Source, Scope, Period, Freshness, Provenance e Integrity suficientes y Evidence antigua, manipulada, incompleta o fuera del periodo evaluado no deberá utilizarse como prueba actual sin justificación explícita. |
| EI-1614 | Attestation, Screenshot, Certificate o Self-Assessment podrán contribuir a Evidence pero no deberán sustituir automáticamente evidencia verificable del funcionamiento real de Controls cuando el Requirement exija Operating Effectiveness. |
| EI-1615 | Compliance State deberá distinguir `COMPLIANT`, `PARTIALLY_COMPLIANT`, `NON_COMPLIANT`, `EXEMPTED`, `NOT_APPLICABLE` y `UNKNOWN`; Exception o Waiver válidos no deberán reclasificar automáticamente un Requirement incumplido como `COMPLIANT`. |
| EI-1616 | Compliance Findings deberán diferenciar Observation, Gap, Evidence Missing, Control Failure y Violation y ausencia de Evidence no deberá confundirse automáticamente con evidencia positiva de incumplimiento ni con conformidad. |
| EI-1617 | Toda Compliance Exception deberá declarar Scope, Requirement, Reason, Authority, Risk, Compensating Controls y Expiration y las excepciones expiradas deberán dejar de modificar Compliance Decisions automáticamente. |
| EI-1618 | Compensating Controls deberán evaluarse respecto del Control Objective que sustituyen y su mera existencia no deberá asumirse equivalente al Control original. |
| EI-1619 | Compliance Remediation deberá preservar Finding, Root Cause, Owner, Actions, Target Date y Verification y ningún Finding deberá cerrarse únicamente porque se haya desplegado un cambio sin demostrar que el Requirement volvió a satisfacerse. |
| EI-1620 | Compliance Drift y Regression deberán detectarse cuando cambios de Version, Configuration, Environment, Data Location, Policy, Access, Retention, Evidence Collection o Control Execution reduzcan Compliance Posture respecto del Baseline aplicable. |
| EI-1621 | Aggregate Compliance Scores no deberán ocultar Critical Violations, `UNKNOWN`, Evidence Missing, Expired Exceptions o Requirements no evaluados y un único Requirement crítico podrá determinar `NON_COMPLIANT` cuando el Profile así lo establezca. |
| EI-1622 | Governance, Privacy, Security, IAM, Schema, Pipelines, Migration y Deployment deberán proporcionar Evidence reutilizable a Compliance sin duplicar sus modelos ni convertir ENG-083 en un segundo sistema de Policy, Identity, Retention o Privacy. |
| EI-1623 | Compliance Security deberá proteger Obligations, Findings, Evidence, Exceptions, Assessments y Control Configuration contra manipulación, y False Attestation, Evidence Tampering o Unauthorized Control Modification deberán ser auditables como violaciones críticas. |
| EI-1624 | Compliance Testing deberá cubrir Applicability, Obligation→Requirement Traceability, Requirement→Control Mapping, Control Design/Operating Effectiveness, Evidence Freshness/Integrity, Exceptions, Compensating Controls, Drift, Regression, Gates y Multi-Tenant/Environment Scope según Architecture. |
| EI-1625 | La primera implementación deberá priorizar Compliance Profiles, Obligations, Applicability, Requirements, Controls, Evidence, Assessments, Findings, Exceptions y Remediation antes de introducir Automatic Regulation Parsing, Semantic Requirement Mapping, Predictive Compliance Risk o AI-Assisted Compliance Decisions. |

---

# 219. Continuidad de Invariantes

```text
ENG-079 → EI-1526 a EI-1545
ENG-080 → EI-1546 a EI-1565
ENG-081 → EI-1566 a EI-1585
ENG-082 → EI-1586 a EI-1605
ENG-083 → EI-1606 a EI-1625
```

---

# 220. Criterios de Conformidad

Una implementación será conforme con ENG-083 cuando:

- defina Compliance Profiles;
- registre Obligations;
- versione Obligations;
- determine Applicability;
- diferencie UNKNOWN y NOT_APPLICABLE;
- derive Compliance Requirements;
- preserve Obligation Traceability;
- mapee Requirements a Controls;
- asigne Control Owners;
- diferencie Owner y Operator;
- modele Control Frequency;
- evalúe Design Effectiveness;
- evalúe Operating Effectiveness;
- defina Evidence;
- preserve Evidence Provenance;
- evalúe Evidence Freshness;
- proteja Evidence Integrity;
- ejecute Compliance Assessments;
- diferencie Findings y Violations;
- modele Compliance State;
- implemente Exceptions;
- controle Exception Expiration;
- evalúe Compensating Controls;
- implemente Remediation;
- verifique Closure;
- mantenga Compliance Baseline;
- detecte Drift;
- detecte Regression;
- implemente Compliance Gates;
- preserve Multi-Tenant Scope;
- preserve Environment Scope;
- aplique Security;
- implemente Audit;
- implemente Observability;
- implemente Compliance Testing.

---

# 221. Riesgos

Deberán evitarse especialmente:

```text
Policy Exists Therefore Compliant

Encrypted Therefore Compliant

Certified Vendor Therefore Compliant

Documentation Equals Evidence

Screenshot Equals Operating Effectiveness

Control Exists Therefore Effective

Control Never Tested

Unknown Equals Compliant

Unknown Equals Not Applicable

Exception Equals Compliance

Expired Exception Still Active

Compensating Control Assumed Equivalent

Current Compliance Used as Historical Compliance

Compliance Score Hides Critical Violation

Evidence Outside Assessment Period

Stale Evidence

Evidence Tampering

Self-Attestation Without Context

Requirement Without Source

Obligation Without Applicability

Hard-Coded Regulation in Framework Core

Finding Closed Without Verification

Compliance Engine Duplicates Governance
Compliance Engine Duplicates Privacy
Compliance Engine Duplicates IAM
```

---

# 222. Relación con ENG-081

La separación deberá permanecer:

```text
DATA GOVERNANCE
ENG-081
│
├── Who owns the data?
├── How is it classified?
├── Why may it be used?
├── How long may it exist?
├── Where may it reside?
└── How may it be shared?

DATA COMPLIANCE
ENG-083
│
├── Which obligations apply?
├── Which requirements follow?
├── Which controls satisfy them?
├── Are the controls effective?
└── What evidence proves it?
```

---

# 223. Relación con ENG-082

```text
DATA PRIVACY
ENG-082
│
└── Privacy processing model

DATA COMPLIANCE
ENG-083
│
└── Verification that applicable
    Privacy obligations and controls
    are satisfied
```

ENG-083 no deberá redefinir:

```text
Consent
Purpose
ProcessingBasis
PrivacyRights
PersonalData
```

---

# 224. Relación con ENG-024

Security Controls podrán formar parte de Compliance Evidence.

```text
SECURITY CONTROL
       │
       ▼
CONTROL TEST
       │
       ▼
EVIDENCE
       │
       ▼
COMPLIANCE ASSESSMENT
```

---

# 225. Relación con ENG-051

Policy Engineering sigue siendo el mecanismo general de Policy.

Compliance deberá referenciar Policies, no duplicarlas.

---

# 226. Relación con ENG-057

Metadata Engineering podrá representar:

```text
compliance profile
requirement
control
evidence
criticality
applicability
```

---

# 227. Relación con ENG-067

Deployment podrá someterse a:

```text
COMPLIANCE GATE
        │
    ┌───┼─────┐
    ▼   ▼     ▼
 PASS WARN   BLOCK
```

---

# 228. Relación con ENG-084

El siguiente documento deberá formalizar **Data Ethics Engineering**.

La frontera deberá ser:

```text
DATA PRIVACY
ENG-082
│
└── Is Personal Data processing
    permitted under Privacy requirements?

DATA COMPLIANCE
ENG-083
│
└── Are applicable obligations
    demonstrably satisfied?

DATA ETHICS
ENG-084
│
└── Even when processing is lawful,
    compliant and technically permitted,
    is the use responsible, proportionate
    and aligned with declared ethical
    principles and human impact?
```

ENG-084 deberá cubrir al menos:

```text
Data Ethics

Ethical Requirement
Ethical Principle

Responsible Data Use

Fairness
Non-Discrimination

Proportionality

Human Impact
Affected Party

Potential Harm
Benefit

Ethical Risk

Secondary Use Ethics

Sensitive Inference

Profiling Ethics

Automated Decision Ethics

Human Oversight

Contestability
Explainability

Manipulation Risk

Dark Pattern Risk

Vulnerable Population

Bias
Bias Detection
Bias Mitigation

Ethical Review

Ethics Assessment

Ethics Decision

Ethics Exception

Ethics Evidence

Ethics Governance

Ethics Security
Ethics Audit
Ethics Observability
Ethics Testing
```

---

# 229. Principio Rector

> **MEF no deberá declarar Compliance porque un sistema “parezca correcto”. Compliance deberá demostrarse mediante una cadena trazable: Obligation → Requirement → Control → Evidence → Assessment. Si cualquiera de esos enlaces es desconocido, obsoleto, insuficiente o no verificable, la incertidumbre deberá permanecer explícita.**

---

# 230. Conclusión

**ENG-083 — Data Compliance Engineering** cierra una frontera arquitectónica importante.

Ahora tenemos:

```text
DATA GOVERNANCE
ENG-081
      │
      ▼
define authority and policies
      │
      ▼
DATA PRIVACY
ENG-082
      │
      ▼
define personal-data processing rules
      │
      ▼
DATA COMPLIANCE
ENG-083
      │
      ▼
verify applicable obligations
```

La cadena de Compliance queda:

```text
OBLIGATION
    │
    ▼
APPLICABILITY
    │
    ▼
REQUIREMENT
    │
    ▼
CONTROL
    │
    ▼
CONTROL TEST
    │
    ▼
EVIDENCE
    │
    ▼
ASSESSMENT
    │
    ▼
COMPLIANCE STATE
```

Y deberá evitarse:

```text
"We have a policy"
        │
        ▼
"Therefore compliant"
```

La relación correcta es:

```text
POLICY
  │
  ▼
CONTROL
  │
  ▼
OPERATING EFFECTIVENESS
  │
  ▼
EVIDENCE
  │
  ▼
ASSESSMENT
  │
  ▼
COMPLIANCE
```

Las tres disciplinas recientes quedan claramente separadas:

```text
ENG-081
DATA GOVERNANCE
│
└── authority and policy

ENG-082
DATA PRIVACY
│
└── personal-data processing

ENG-083
DATA COMPLIANCE
│
└── obligation satisfaction
    and demonstrable evidence
```

La cadena reciente queda:

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
    │
ENG-083  Data Compliance
    │
ENG-084  Data Ethics
```

La primera implementación deberá concentrarse en:

```text
ComplianceState

ComplianceProfile
ComplianceObligation
ComplianceRequirement

ComplianceControl
ControlState
ControlTestResult

ComplianceEvidence

ComplianceAssessment
ComplianceFinding

ComplianceException
ComplianceRemediation

ComplianceRuntime
ComplianceRegistry
ComplianceError
```

antes de introducir:

```text
Automatic Regulation Parsing
Automatic Legal Interpretation
Semantic Obligation Extraction
Automatic Requirement Mapping
Automatic Control Mapping
Compliance Knowledge Graph
Predictive Compliance Risk
AI-Assisted Compliance Assessment
```

Con **ENG-083**, la serie global alcanza:

```text
EI-1625
```

---

# Referencias

## Ingeniería

- ENG-009 — Testing
- ENG-012 — Build System
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-029 — Extension Engineering
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
- ENG-066 — Upgrade Engineering
- ENG-067 — Deployment Engineering
- ENG-068 — Environment Engineering
- ENG-079 — Data Integrity Engineering
- ENG-080 — Data Quality Engineering
- ENG-081 — Data Governance Engineering
- ENG-082 — Data Privacy Engineering
- ENG-084 — Data Ethics Engineering
```