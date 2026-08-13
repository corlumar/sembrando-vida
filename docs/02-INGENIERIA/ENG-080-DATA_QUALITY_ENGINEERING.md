---
id: ENG-080
titulo: Data Quality Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Quality Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
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
  - ENG-030
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-041
  - ENG-043
  - ENG-048
  - ENG-053
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-076
  - ENG-077
  - ENG-078
  - ENG-079
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
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-042
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-049
  - ENG-050
  - ENG-051
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
  - ENG-081
keywords:
  - data-quality
  - quality
  - fitness-for-purpose
  - completeness
  - accuracy
  - validity
  - freshness
  - timeliness
  - uniqueness
  - relevance
  - profiling
  - quality-score
  - quality-threshold
  - quality-drift
  - anomaly
  - stewardship
  - remediation
  - mef
---

# ENG-080

# Data Quality Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Quality Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-080 establece las reglas para:

```text
Data Quality

Quality Requirement
Quality Objective
Quality Policy

Fitness for Purpose

Quality Dimension

Completeness
Accuracy
Validity
Consistency
Timeliness
Freshness
Uniqueness
Relevance

Quality Rule
Quality Constraint

Quality Threshold
Quality Target
Quality Tolerance

Data Quality Score
Dimension Score

Data Profiling
Profile

Null Rate
Missing Rate
Duplicate Rate

Distribution
Cardinality
Distinctness

Outlier
Anomaly

Reference Data Quality
Master Data Quality

Quality Issue
Quality Incident

Quality Drift
Distribution Drift
Freshness Drift

Quality Baseline
Quality Regression

Quality Monitoring
Quality Validation
Quality Verification

Quality Gate

Quality Remediation

Data Steward
Data Owner
Quality Ownership

Quality Security
Quality Audit
Quality Observability
Quality Testing
```

---

# 2. Declaración

> **MEF deberá evaluar Data Quality respecto de un propósito explícito. Un dato no deberá considerarse de alta calidad únicamente porque satisfaga Schema, Constraints o Integrity Rules: deberá ser suficientemente completo, exacto, válido, oportuno, fresco, único, consistente y relevante para el Consumer y Use Case definidos. Ningún Quality Score agregado deberá ocultar la violación crítica de una dimensión contractual.**

Arquitectura conceptual:

```text
DATA
 │
 ▼
INTEGRITY
 │
 ▼
QUALITY DIMENSIONS
 │
 ├── Completeness
 ├── Accuracy
 ├── Validity
 ├── Freshness
 ├── Timeliness
 ├── Uniqueness
 ├── Consistency
 └── Relevance
 │
 ▼
FITNESS FOR PURPOSE
 │
 ├── FIT
 ├── DEGRADED
 └── UNFIT
```

---

# 3. Data Quality Engineering

Data Quality Engineering responde:

```text
Is the data good enough for this use?
Is required information present?
Is the value accurate?
Is it sufficiently fresh?
Did it arrive in time?
Are duplicates acceptable?
Does it match reference/master data?
Has its distribution changed?
Is quality getting worse?
Who owns the quality problem?
Can low-quality data be quarantined?
Should this data be allowed into a critical process?
```

---

# 4. Data Quality

`Data Quality` representa el grado en que Data satisface los requisitos necesarios para un propósito determinado.

---

# 5. Fitness for Purpose

Es el principio central de ENG-080.

```text
DATA
+
USE CASE
+
QUALITY REQUIREMENTS
=
FITNESS FOR PURPOSE
```

---

# 6. Quality Is Contextual

Un mismo dato puede ser:

```text
FIT
```

para un Use Case y:

```text
UNFIT
```

para otro.

---

# 7. Ejemplo

```text
customer.phone = NULL
```

Puede ser válido para:

```text
anonymous analytics
```

y ser insuficiente para:

```text
telephone campaign
```

---

# 8. Data Quality ≠ Data Integrity

Integrity responde:

```text
Is the state valid according
to its invariants?
```

Quality responde:

```text
Is the state sufficiently good
for the intended use?
```

---

# 9. Data Quality ≠ Accuracy

Accuracy es una dimensión.

No representa toda la calidad.

---

# 10. Data Quality ≠ Completeness

Data completo puede ser incorrecto.

---

# 11. Data Quality ≠ Validation

Validation es un mecanismo.

Quality es una propiedad evaluada.

---

# 12. Data Quality ≠ Consistency Engineering

ENG-078 utiliza Consistency para definir observaciones/versiones de State.

ENG-080 podrá utilizar `consistency` como dimensión de calidad entre datasets o atributos.

Ambos conceptos deberán distinguirse por Scope.

---

# 13. Data Quality ≠ Freshness Only

Data reciente puede ser:

```text
incorrect
duplicated
incomplete
irrelevant
```

---

# 14. Quality Requirement

Todo Requirement deberá declarar:

```text
scope
consumer
use case
dimensions
metrics
thresholds
measurement window
failure behavior
owner
```

---

# 15. Quality Requirement Example

```text
Scope:
active customer records

Use Case:
billing notifications

Completeness:
email >= 98%

Validity:
valid email syntax >= 99.5%

Freshness:
customer contact data
updated <= 90 days

Duplicate Rate:
< 0.5%

Critical Rule:
customer_id uniqueness = 100%
```

---

# 16. Vague Quality Requirement

No deberá utilizarse como Contract:

```text
high quality
clean data
good data
accurate enough
fresh data
trusted data
```

sin métricas.

---

# 17. Quality Objective

Define nivel requerido para una o varias Dimensions.

---

# 18. Quality Scope

Podrá ser:

```text
field
record
entity
aggregate
dataset
table
stream
tenant
report
model input
data product
```

---

# 19. Consumer

Toda Quality Requirement deberá identificar quién o qué consume Data cuando el Use Case sea relevante.

---

# 20. Use Case

Ejemplos:

```text
transaction processing
reporting
regulatory reporting
machine learning
marketing
billing
fraud detection
operational decision
```

---

# 21. Criticality

Quality Requirement deberá poder clasificar Importance.

Ejemplo:

```text
OPTIONAL
STANDARD
IMPORTANT
CRITICAL
```

---

# 22. Quality Dimension

Representa un aspecto medible de Fitness for Purpose.

---

# 23. Core Dimensions

ENG-080 reconocerá al menos:

```text
COMPLETENESS
ACCURACY
VALIDITY
CONSISTENCY
TIMELINESS
FRESHNESS
UNIQUENESS
RELEVANCE
```

---

# 24. Completeness

Mide presencia de Data requerida.

Conceptualmente:

```text
Completeness =
Present Required Values
/
Expected Required Values
```

---

# 25. Completeness Scope

Podrá ser:

```text
field
record
entity
dataset
```

---

# 26. Null Rate

Podrá utilizarse como señal:

```text
NULL values
/
total records
```

---

# 27. Null ≠ Missing Universally

El Domain deberá definir Semantics.

---

# 28. Empty Value

No deberá interpretarse automáticamente como válido para Completeness.

Ejemplos:

```text
""
" "
"N/A"
"unknown"
"000000"
```

podrán representar Missing Data.

---

# 29. Placeholder Value

Deberá identificarse cuando pueda inflar artificialmente Completeness.

---

# 30. Conditional Completeness

Ejemplo:

```text
if account.type = COMPANY
then tax_id required
```

---

# 31. Record Completeness

Podrá calcularse por conjunto de campos.

---

# 32. Dataset Completeness

Puede incluir Records esperados, no solo Fields presentes.

---

# 33. Missing Record

Puede ser Quality Issue aunque no viole Integrity.

---

# 34. Accuracy

Representa correspondencia con realidad o Source autoritativa.

---

# 35. Accuracy Requires Reference

No deberá afirmarse Accuracy fuerte sin criterio de comparación.

---

# 36. Accuracy Reference

Podrá ser:

```text
authoritative system
verified source
manual observation
certified reference
reconciliation source
```

---

# 37. Accuracy Example

```text
postal_code = "01000"
```

puede ser sintácticamente válido y aun pertenecer a otra dirección.

---

# 38. Accuracy Confidence

Podrá declararse cuando Truth no sea perfectamente observable.

---

# 39. Accuracy ≠ Precision

Un valor puede ser preciso pero incorrecto.

---

# 40. Precision

Podrá formar parte de Quality para:

```text
financial values
measurements
timestamps
scientific data
```

---

# 41. Rounding

Deberá seguir Domain Rules.

---

# 42. Validity

Mide conformidad con reglas/formats permitidos.

---

# 43. Validity Examples

```text
enum allowed
date parseable
number range
identifier pattern
country code known
```

---

# 44. Integrity vs Quality Validity

Integrity podrá exigir una regla como absoluta.

Quality podrá medir su cumplimiento sobre un Data Set histórico o externo.

---

# 45. Consistency Dimension

Mide compatibilidad de Data entre atributos, registros o fuentes.

---

# 46. Quality Consistency Example

```text
country = MX
currency = MXN
```

según regla de negocio específica.

---

# 47. Cross-Source Consistency

Puede medirse mediante Reconciliation.

---

# 48. Internal Consistency

Campos de un mismo Record no deberán contradecirse.

---

# 49. Consistency Score

No deberá confundirse con el Consistency Model de ENG-078.

---

# 50. Timeliness

Mide si Data estuvo disponible a tiempo para el proceso consumidor.

---

# 51. Timeliness Example

```text
fraud signal
must arrive within 2 seconds
```

---

# 52. Timeliness ≠ Freshness

Timeliness:

```text
did the data arrive by the required time?
```

Freshness:

```text
how old is the information?
```

---

# 53. Freshness

Mide antigüedad del Data respecto de su Source/Event o último Update relevante.

---

# 54. Freshness Age

Conceptualmente:

```text
Freshness Age =
Current Time
-
Data Effective Time
```

---

# 55. Ingestion Time ≠ Event Time

No deberán confundirse.

---

# 56. Event Time

Momento en que ocurrió el hecho representado.

---

# 57. Processing Time

Momento en que MEF procesó el dato.

---

# 58. Ingestion Time

Momento en que ingresó al sistema.

---

# 59. Freshness Source

Deberá declarar cuál Timestamp se utiliza.

---

# 60. Stale Data

Data que excede Freshness Requirement.

---

# 61. Stale ≠ Invalid Automatically

Puede seguir siendo válido pero no apto para el Use Case.

---

# 62. Freshness Window

Podrá expresarse:

```text
seconds
minutes
hours
days
versions
```

---

# 63. Uniqueness

Mide ausencia de duplicación semánticamente inválida.

---

# 64. Duplicate Rate

Conceptualmente:

```text
Duplicate Entities
/
Observed Entities
```

con Identity Policy explícita.

---

# 65. Exact Duplicate

Records idénticos según Matching Fields.

---

# 66. Semantic Duplicate

Records diferentes que representan la misma Entity.

---

# 67. Duplicate Detection Confidence

Deberá declararse para Matching probabilístico.

---

# 68. False Merge

Es un riesgo crítico.

---

# 69. Relevance

Mide utilidad de Data respecto del Purpose.

---

# 70. Relevance Is Contextual

No deberá evaluarse universalmente sin Use Case.

---

# 71. Excess Data

Puede reducir:

```text
clarity
privacy
processing efficiency
governance quality
```

---

# 72. Unnecessary Data Collection

No deberá justificarse mediante Quality.

---

# 73. Quality Rule

Regla utilizada para evaluar una dimensión.

Conceptualmente:

```text
QualityRule
├── scope
├── dimension
├── expression
├── metric
├── threshold
└── severity
```

---

# 74. Rule Types

Podrán incluir:

```text
field
record
dataset
cross-source
temporal
statistical
domain
```

---

# 75. Deterministic Rule

Produce resultado reproducible para mismos Inputs.

---

# 76. Statistical Rule

Evalúa patrones o distribuciones.

---

# 77. Statistical Rule ≠ Domain Invariant

No deberán confundirse.

---

# 78. Quality Threshold

Define límite aceptable.

---

# 79. Threshold Example

```text
email completeness >= 98%
```

---

# 80. Hard Threshold

Su violación puede bloquear proceso.

---

# 81. Soft Threshold

Puede producir Warning o Investigation.

---

# 82. Threshold Ownership

Deberá poseer Owner.

---

# 83. Threshold Justification

Deberá derivarse del Use Case.

---

# 84. Arbitrary Threshold

Deberá evitarse.

---

# 85. Quality Tolerance

Podrá aceptar determinado nivel de anomalía.

---

# 86. Zero Tolerance

Podrá aplicarse a dimensiones críticas.

Ejemplo:

```text
duplicate payment transaction = 0
```

---

# 87. Quality Score

Puede agregar resultados de varias Dimensions.

---

# 88. Score ≠ Quality Truth

No deberá ocultar detalles.

---

# 89. Weighted Score

Podrá asignar pesos.

Conceptualmente:

```text
Quality Score =
Σ(dimension score × weight)
```

---

# 90. Weight Ownership

Los pesos deberán justificarse por Purpose.

---

# 91. Critical Dimension Override

Una violación crítica podrá marcar Data como UNFIT aun con Score global alto.

---

# 92. Example

```text
Completeness  100%
Freshness     100%
Uniqueness    100%
Accuracy        0%
```

Un promedio:

```text
75%
```

no hace Data apto automáticamente.

---

# 93. Dimension Score

Deberá conservarse junto al Aggregate Score.

---

# 94. Quality State

Podrá clasificarse:

```text
FIT
DEGRADED
UNFIT
QUARANTINED
UNKNOWN
```

---

# 95. FIT

Quality Requirements relevantes se satisfacen.

---

# 96. DEGRADED

Data continúa siendo utilizable bajo restricciones explícitas.

---

# 97. UNFIT

No satisface Purpose contractual.

---

# 98. QUARANTINED

Data ha sido aislado para impedir consumo no seguro.

---

# 99. UNKNOWN

No existe evidencia suficiente.

---

# 100. UNKNOWN ≠ FIT

No medir Quality no demuestra Quality.

---

# 101. Data Profiling

Proceso de analizar características de un Data Set.

---

# 102. Profile Dimensions

Podrán incluir:

```text
row count
null rate
distinct count
min
max
distribution
pattern frequency
duplicate rate
cardinality
```

---

# 103. Profiling ≠ Quality Requirement

Profiling describe Data.

Requirement define qué necesita el Consumer.

---

# 104. Profile Snapshot

Podrá conservarse como Baseline.

---

# 105. Profiling Scope

Deberá ser explícito.

---

# 106. Full Profiling

Puede ser costoso.

---

# 107. Sample Profiling

Deberá declarar Sampling.

---

# 108. Cardinality

Cantidad de valores distintos.

---

# 109. Cardinality Change

Puede indicar:

```text
new category
data loss
unexpected normalization
bad ingestion
```

---

# 110. Distinctness

Podrá medir proporción de valores únicos.

---

# 111. Distribution

Describe frecuencia/forma de valores.

---

# 112. Distribution Shift

Puede indicar cambio real o Quality Problem.

---

# 113. Distribution ≠ Domain Truth

Una distribución diferente no es Failure automáticamente.

---

# 114. Outlier

Valor significativamente diferente del patrón esperado.

---

# 115. Outlier ≠ Error Automatically

Puede representar evento real.

---

# 116. Outlier Policy

Deberá distinguir:

```text
valid rare value
suspicious value
invalid value
```

---

# 117. Anomaly

Observación que se desvía del comportamiento esperado.

---

# 118. Anomaly Detection

Podrá utilizar:

```text
rules
statistics
baselines
models
```

---

# 119. Anomaly ≠ Quality Violation Automatically

Debe evaluarse.

---

# 120. Quality Drift

Deterioro o cambio material de Quality a través del tiempo.

---

# 121. Drift Dimensions

Podrán incluir:

```text
completeness drift
accuracy drift
freshness drift
duplicate drift
distribution drift
```

---

# 122. Distribution Drift

Cambio estadístico respecto de Baseline.

---

# 123. Distribution Drift ≠ Integrity Drift

ENG-079 controla Integrity Drift.

ENG-080 analiza Fitness/Quality Drift.

---

# 124. Freshness Drift

Data tarda progresivamente más en actualizarse.

---

# 125. Completeness Drift

Aumentan Missing Values/Records.

---

# 126. Duplicate Drift

Aumenta Duplicate Rate.

---

# 127. Drift Baseline

Deberá declarar:

```text
period
sample
scope
conditions
```

---

# 128. Seasonal Data

No deberá clasificarse como Drift anómalo sin considerar estacionalidad.

---

# 129. Quality Baseline

Representa estado conocido de Quality.

Podrá incluir:

```text
dimension scores
profiles
distributions
freshness
duplicate rate
issue rate
```

---

# 130. Quality Regression

Ocurre cuando una Version, Pipeline, Source o Process reduce Quality materialmente.

---

# 131. Regression Examples

```text
null rate increases
freshness worsens
duplicates increase
new invalid category
accuracy decreases
```

---

# 132. Quality Regression ≠ Integrity Regression

Puede existir deterioro de utilidad sin State inválido.

---

# 133. Data Quality Issue

Incumplimiento o anomalía individual o agregada.

---

# 134. Quality Issue Fields

Podrán incluir:

```text
dimension
scope
rule
severity
detectedAt
owner
status
```

---

# 135. Quality Incident

Conjunto de Issues de impacto suficiente para afectar Consumers.

---

# 136. Issue ≠ Incident

No deberán confundirse.

---

# 137. Root Cause

Podrá ser:

```text
source
ingestion
transformation
schema
manual entry
integration
timing
reference data
```

---

# 138. Quality Propagation

Poor Quality puede propagarse a:

```text
reports
models
decisions
notifications
billing
analytics
```

---

# 139. Blast Radius

Deberá poder analizarse mediante Lineage de ENG-079 cuando exista.

---

# 140. Source Quality

Todo External Source crítico deberá poseer expectations.

---

# 141. Supplier Data Contract

Podrá declarar:

```text
schema
completeness
freshness
validity
delivery
```

---

# 142. Bad Source Data

No deberá corregirse silenciosamente de forma que oculte el problema de origen.

---

# 143. Quality at Ingestion

Deberá evaluarse antes de introducir Data no apto en pipelines críticos.

---

# 144. Quarantine

Podrá aislar Data que no cumple Thresholds.

---

# 145. Quarantine Policy

Deberá definir:

```text
reason
retention
review
repair
replay
```

---

# 146. Quarantine ≠ Drop

No deberá perderse evidencia sin Policy.

---

# 147. Reject

Podrá utilizarse para Rules críticas.

---

# 148. Accept With Warning

Podrá permitirse para degradación tolerada.

---

# 149. Quality Degradation Contract

Podrá declarar qué Consumers pueden seguir utilizando Data.

---

# 150. Reference Data Quality

Reference Data deberá poseer:

```text
authority
version
validity period
completeness
```

---

# 151. Reference Data Staleness

Puede degradar múltiples Systems simultáneamente.

---

# 152. Master Data Quality

Master Entities podrán requerir:

```text
identity resolution
deduplication
golden record
authority
stewardship
```

---

# 153. Golden Record

No deberá generarse arbitrariamente.

---

# 154. Golden Record Policy

Deberá declarar cómo se seleccionan o fusionan Sources.

---

# 155. Survivorship Rule

Determina qué Source gana por Attribute.

---

# 156. Survivorship ≠ LWW Automatically

Domain/Source authority puede ser más importante que tiempo.

---

# 157. Master Data Conflict

Deberá conservarse para resolución cuando no exista regla segura.

---

# 158. Data Stewardship

Responsabilidad operacional sobre definición, monitoreo y mejora de Data Quality.

---

# 159. Data Steward

Podrá responsabilizarse de:

```text
rules
thresholds
issues
reference definitions
remediation coordination
```

---

# 160. Data Owner

Posee Accountability sobre Data/Domain correspondiente.

---

# 161. Owner ≠ Steward

Podrán ser roles distintos.

---

# 162. Quality Ownership

Todo Quality Requirement crítico deberá poseer Owner.

---

# 163. Rule Ownership

Toda Rule no trivial deberá poder rastrearse a responsable o Domain.

---

# 164. Orphan Quality Rule

Deberá evitarse.

---

# 165. Quality Monitoring

Deberá ejecutarse con frecuencia acorde al Use Case.

---

# 166. Batch Quality Monitoring

Podrá utilizarse para:

```text
warehouse
reports
master data
historical data
```

---

# 167. Streaming Quality Monitoring

Podrá utilizarse para:

```text
events
real-time feeds
fraud signals
telemetry
```

---

# 168. Monitoring Frequency

Deberá corresponder al Freshness/Timeliness Objective.

---

# 169. Quality Validation

Evalúa Rules sobre Data.

---

# 170. Quality Verification

Determina si Quality Requirements fueron satisfechos en Scope/Window.

---

# 171. Validation ≠ Verification

Validation:

```text
does this data satisfy this rule?
```

Verification:

```text
does the data product satisfy
its quality contract?
```

---

# 172. Quality Evidence

Deberá incluir:

```text
scope
window
sample/full
rule version
measurement
result
```

---

# 173. Rule Versioning

Quality Rules deberán versionarse cuando cambios alteren significado de Metrics.

---

# 174. Metric Comparability

No deberá compararse directamente resultados obtenidos con Rules incompatibles sin ajuste.

---

# 175. Quality Gate

Podrá bloquear:

```text
ingestion
pipeline stage
publication
report
model training
migration
release
cutover
```

---

# 176. Gate Severity

Podrá ser:

```text
WARN
BLOCK
QUARANTINE
REQUIRE_OVERRIDE
```

---

# 177. Critical Gate

No deberá basarse únicamente en Aggregate Score.

---

# 178. Gate Override

Deberá requerir:

```text
authority
reason
scope
expiration
audit
```

---

# 179. Quality Remediation

Acciones destinadas a mejorar Quality.

---

# 180. Remediation Types

Podrán incluir:

```text
source correction
data repair
normalization
deduplication
re-ingestion
reference correction
backfill
manual review
```

---

# 181. Remediation ≠ Integrity Repair Universally

ENG-079 repara State inválido.

ENG-080 también puede mejorar Data válido pero insuficiente.

---

# 182. Example

```text
address_line_2 = NULL
```

puede ser íntegro.

Completarlo mediante enriquecimiento podrá mejorar Quality sin reparar Integrity.

---

# 183. Auto-Fill

No deberá inventar Data para mejorar Scores.

---

# 184. Synthetic Completion

Solo deberá utilizarse cuando Contract identifique explícitamente que el valor es:

```text
estimated
inferred
imputed
generated
```

---

# 185. Imputation

Podrá ser aceptable en Analytics/ML con Metadata explícita.

---

# 186. Imputed ≠ Observed

No deberán confundirse.

---

# 187. Confidence Metadata

Podrá acompañar valores inferidos.

---

# 188. Normalization

Puede mejorar comparabilidad.

---

# 189. Normalization ≠ Correction

Transformar formato no garantiza Accuracy.

---

# 190. Deduplication

Deberá seguir Identity Rules de ENG-079.

---

# 191. Automated Merge

No deberá ejecutarse con Confidence insuficiente.

---

# 192. Remediation Verification

Toda Remediation material deberá volver a medir Quality.

---

# 193. Remediation Feedback Loop

Conceptualmente:

```text
DETECT
  │
  ▼
CLASSIFY
  │
  ▼
ROOT CAUSE
  │
  ▼
REMEDIATE
  │
  ▼
VERIFY
  │
  ▼
MONITOR
```

---

# 194. Quality in Pipelines

ENG-064 deberá permitir Quality Gates entre Stages.

---

# 195. Pipeline Quality Contract

Podrá declarar:

```text
input quality
transformation quality
output quality
```

---

# 196. Bad Input

Podrá:

```text
reject
quarantine
route to repair
accept degraded
```

según Policy.

---

# 197. Transformation Quality

ENG-063 deberá preservar o mejorar Quality según Contract.

---

# 198. Transformation Loss

Podrá degradar:

```text
precision
completeness
semantic richness
```

---

# 199. Quality Propagation Metadata

Podrá registrar Quality State junto con Data Products cuando sea útil.

---

# 200. Data Product Quality

Todo Data Product crítico podrá exponer:

```text
quality requirements
current status
freshness
known issues
owner
```

---

# 201. Quality and Schema

Schema Validation no sustituye Quality.

---

# 202. Quality and Integrity

ENG-079 protege Invariants.

ENG-080 mide utilidad.

---

# 203. Quality and Consistency

Stale Data puede ser Consistency-valid y Quality-unfit para un Use Case concreto.

---

# 204. Quality and Durability

Durability perfecta puede conservar datos de baja calidad indefinidamente.

---

# 205. Quality and Recovery

Recovery deberá evitar publicar Data restaurada antes de comprobar Quality crítica cuando el Use Case lo requiera.

---

# 206. Quality and Migration

Migration deberá comparar Quality Baseline antes/después.

---

# 207. Migration Quality Regression

Ejemplos:

```text
precision loss
missing values
duplicates
freshness delay
reference mapping loss
```

---

# 208. Quality and Imports

Bulk Imports deberán perfilarse y validarse.

---

# 209. Quality and APIs

External API Data deberá someterse a Quality Expectations cuando sea critical input.

---

# 210. Quality and User Input

UX podrá reducir problemas mediante:

```text
controlled vocabulary
format validation
required fields
reference lookup
```

---

# 211. Required Field Abuse

No deberá hacerse obligatorio un campo sin necesidad real únicamente para mejorar Completeness Score.

---

# 212. Quality and Machine Learning

Model Input deberá declarar Quality Requirements específicos.

---

# 213. ML Input Quality

Podrá considerar:

```text
missingness
distribution
freshness
label quality
feature validity
```

---

# 214. Training/Serving Skew

Podrá constituir Quality Problem para ML Systems.

---

# 215. Quality and Analytics

Reports deberán conocer Data Freshness y Coverage.

---

# 216. Reporting Cutoff

Deberá ser explícito cuando Data continúe llegando.

---

# 217. Late Arriving Data

Podrá modificar resultados históricos.

---

# 218. Late Data Policy

Deberá declarar:

```text
recompute
ignore
next window
manual review
```

---

# 219. Quality and Time

Clock/Timezone semantics deberán preservarse para Timeliness/Freshness.

---

# 220. Quality and Multi-Tenancy

ENG-048 deberá preservar Tenant Scope.

---

# 221. Tenant-Level Quality

Podrá variar entre Tenants.

---

# 222. Global Quality Score

No deberá ocultar un Tenant crítico con mala Quality.

---

# 223. Tenant Quality Threshold

Podrá diferir por Contract.

---

# 224. Cross-Tenant Aggregation

Deberá preservar Security y Statistical Meaning.

---

# 225. Quality and Privacy

Más Data no significa mejor Quality automáticamente.

---

# 226. Data Minimization

Security/Privacy Policy podrá limitar atributos incluso si aumentaran Completeness para otro Use Case.

---

# 227. Quality vs Data Minimization

Deberá resolverse por Requirements explícitos, no acumulando datos innecesarios.

---

# 228. Sensitive Attributes

Quality Metrics no deberán exponer valores sensibles.

---

# 229. Quality Security

ENG-024 gobernará Security general.

---

# 230. Quality Rule Abuse

Un atacante no deberá manipular Rules o Thresholds para hacer pasar Data malicioso como apto.

---

# 231. Quality Score Tampering

Deberá protegerse.

---

# 232. Source Identity

Deberá preservarse para evaluar Trust/Accuracy cuando corresponda.

---

# 233. Quality Remediation Authorization

Correcciones críticas deberán requerir Authority.

---

# 234. Quarantine Access

Deberá limitarse.

---

# 235. Quality Audit

Cambios críticos deberán ser auditables.

---

# 236. Audit Events

Podrán incluir:

```text
quality requirement changed
quality rule changed
threshold changed
quality gate failed
quality gate overridden
data quarantined
remediation executed
quality incident opened
quality incident closed
```

---

# 237. Quality Observability

ENG-025 gobernará Telemetry.

---

# 238. Metrics

Podrán incluir:

```text
mef.data_quality.score

mef.data_quality.completeness
mef.data_quality.accuracy
mef.data_quality.validity
mef.data_quality.freshness
mef.data_quality.timeliness
mef.data_quality.uniqueness

mef.data_quality.issue.total
mef.data_quality.gate.failure.total
mef.data_quality.quarantine.total
mef.data_quality.drift.total
```

---

# 239. Quality Metric Units

Deberán ser explícitas.

---

# 240. Percentage Metric

Deberá declarar denominator.

---

# 241. Quality Labels

Podrán incluir:

```text
dimension
scopeType
severity
result
```

con Cardinality controlada.

---

# 242. Record ID

No deberá utilizarse indiscriminadamente como Metric Label.

---

# 243. Quality Logs

Deberán registrar especialmente:

```text
threshold breach
quality state transition
drift detection
gate decision
remediation
```

---

# 244. Quality Diagnostics

Deberá poder responder:

```text
what is the intended use?
which quality requirements apply?
what is the score per dimension?
which threshold failed?
how fresh is the data?
what is the duplicate rate?
which source caused the issue?
is quality drifting?
who owns remediation?
```

---

# 245. Quality Snapshot

Conceptualmente:

```text
QualitySnapshot
├── state
├── scope
├── useCase
├── measuredAt
├── dimensionScores
├── aggregateScore
├── violations
├── drift
└── freshness
```

---

# 246. Quality State Transition

Conceptualmente:

```text
UNKNOWN
   │
   ▼
FIT
 │
 ├──► DEGRADED
 │       │
 │       ▼
 └────► UNFIT
          │
          ▼
      QUARANTINED
```

---

# 247. Recovery to FIT

Deberá requerir nueva Verification.

---

# 248. Quality Baseline Comparison

Deberá utilizar Rules comparables.

---

# 249. Data Quality Contract

Podrá actuar como Contract entre Producer y Consumer.

---

# 250. Producer Responsibility

Incluye Quality prometida en Boundary publicada.

---

# 251. Consumer Responsibility

Incluye no asumir garantías superiores a las declaradas.

---

# 252. Data Contract Quality Section

Podrá incluir:

```text
freshness
completeness
validity
uniqueness
known limitations
```

---

# 253. Quality SLA/SLO

Podrá definirse para Data Products críticos.

---

# 254. Quality SLO Example

```text
99% of hourly partitions
published within 10 minutes

customer_id completeness = 100%

duplicate rate < 0.1%
```

---

# 255. Error Budget Analogy

Podrá utilizarse para Quality, pero deberá definirse independientemente de Availability Error Budgets.

---

# 256. Quality Gate Before Publication

Deberá impedir que Data críticamente defectuoso se publique cuando Policy lo requiera.

---

# 257. Testing

ENG-009 gobernará Testing.

---

# 258. Completeness Test

Deberá comprobar Missing Fields/Records.

---

# 259. Accuracy Test

Deberá comparar contra Reference cuando exista.

---

# 260. Validity Test

Deberá comprobar Allowed Values/Formats.

---

# 261. Freshness Test

Deberá comprobar Age.

---

# 262. Timeliness Test

Deberá comprobar Delivery Deadline.

---

# 263. Uniqueness Test

Deberá detectar Duplicates.

---

# 264. Relevance Test

Podrá requerir Review por Use Case.

---

# 265. Profiling Test

Deberá comprobar Profile generation.

---

# 266. Distribution Test

Deberá detectar cambios relevantes sin clasificarlos automáticamente como Failure.

---

# 267. Null Drift Test

Deberá introducir aumento de Missingness.

---

# 268. Duplicate Drift Test

Deberá introducir duplicados.

---

# 269. Freshness Drift Test

Deberá introducir retraso.

---

# 270. Quality Gate Test

Deberá comprobar:

```text
pass
warn
block
quarantine
override
```

---

# 271. Aggregate Score Test

Deberá comprobar que una dimensión Critical pueda invalidar Score global cuando Policy lo requiera.

---

# 272. Quarantine Test

Deberá comprobar aislamiento y posterior Replay.

---

# 273. Remediation Test

Deberá volver a medir Quality.

---

# 274. Imputation Test

Deberá comprobar que valores inferidos permanezcan identificables.

---

# 275. Master Data Test

Deberá comprobar Survivorship Rules.

---

# 276. Reference Data Test

Deberá comprobar versión y Freshness.

---

# 277. Migration Quality Test

Deberá comparar Baseline y Candidate.

---

# 278. Pipeline Quality Test

Deberá comprobar Gates por Stage.

---

# 279. Multi-Tenant Quality Test

Deberá impedir que agregación global oculte violaciones relevantes.

---

# 280. Security Test

Deberá intentar:

```text
quality threshold tampering
quality score tampering
source spoofing
quarantine bypass
unauthorized remediation
cross-tenant quality leakage
```

---

# 281. Architecture Test

Podrá impedir:

```text
quality requirement without use case
aggregate score hides critical violation
freshness based on wrong timestamp
accuracy claimed without reference
null placeholder counted as complete
quality rule without owner
silent auto-correction
imputed data presented as observed
```

---

# 282. Build Integration

ENG-012 podrá validar:

```text
quality requirement declarations
quality rule definitions
threshold units
critical dimensions
rule ownership
quality gate configuration
```

---

# 283. Quality Tests in CI

Podrán dividirse en:

```text
unit rule tests
sample profile tests
pipeline quality tests
scheduled full-data verification
```

---

# 284. Production Quality Monitoring

Podrá ser continuo o programado según Criticality.

---

# 285. CLI

ENG-007 podrá proporcionar:

```text
mef quality
mef quality:requirements
mef quality:profile
mef quality:score
mef quality:rules
mef quality:issues
mef quality:drift
mef quality:gate
mef quality:quarantine
mef quality:diagnose
```

---

# 286. `mef quality`

Podrá mostrar:

```text
state
aggregate score
dimension scores
critical violations
freshness
```

---

# 287. `quality:requirements`

Podrá mostrar:

```text
scope
consumer
use case
dimensions
thresholds
owner
```

---

# 288. `quality:profile`

Podrá mostrar:

```text
records
nulls
distinct values
duplicates
distribution
```

---

# 289. `quality:score`

Podrá mostrar Score por Dimension.

---

# 290. `quality:rules`

Podrá mostrar Rules activas.

---

# 291. `quality:issues`

Podrá mostrar Issues abiertas.

---

# 292. `quality:drift`

Podrá comparar contra Baseline.

---

# 293. `quality:gate`

Podrá evaluar publicación/promoción.

---

# 294. `quality:quarantine`

Deberá operar solo con Authority apropiada para mutaciones.

---

# 295. `quality:diagnose`

Podrá mostrar:

```text
use case
requirements
scores
profile
threshold violations
drift
sources
issues
ownership
remediation
```

---

# 296. Registry Integration

ENG-020 podrá registrar:

```text
QualityRequirement
QualityDimension
QualityRule
QualityPolicy
QualityGate
QualityOwner
```

---

# 297. Quality Requirement Contract

Conceptualmente:

```text
QualityRequirement
├── id
├── scope
├── consumer
├── useCase
├── dimensions
├── thresholds
├── measurementWindow
├── criticality
└── owner
```

---

# 298. Quality Dimension Contract

Conceptualmente:

```text
QualityDimension
├── id
├── definition
├── metric
├── unit
└── semantics
```

---

# 299. Quality Rule Contract

Conceptualmente:

```text
QualityRule
├── id
├── scope
├── dimension
├── expression
├── threshold
├── severity
├── owner
└── version
```

---

# 300. Quality Measurement

Conceptualmente:

```text
QualityMeasurement
├── rule
├── scope
├── window
├── numerator
├── denominator
├── value
├── result
└── measuredAt
```

---

# 301. Quality Score

Conceptualmente:

```text
QualityScore
├── scope
├── useCase
├── dimensions
├── aggregate
├── criticalViolations
└── measuredAt
```

---

# 302. Data Profile

Conceptualmente:

```text
DataProfile
├── scope
├── recordCount
├── nullRates
├── cardinality
├── distinctness
├── distributions
├── duplicateRate
└── generatedAt
```

---

# 303. Quality Issue

Conceptualmente:

```text
QualityIssue
├── id
├── scope
├── rule
├── dimension
├── severity
├── evidence
├── owner
├── status
└── detectedAt
```

---

# 304. Quality Drift

Conceptualmente:

```text
QualityDrift
├── scope
├── dimension
├── baseline
├── current
├── delta
├── significance
└── observedAt
```

---

# 305. Quality Policy

Conceptualmente:

```text
QualityPolicy
├── requirements
├── rules
├── scoring
├── gate
├── quarantine
├── remediation
└── security
```

---

# 306. Quality Gate

Conceptualmente:

```text
QualityGate
├── scope
├── requirements
├── measurements
├── criticalViolations
├── decision
└── overridePolicy
```

---

# 307. Quality Remediation Plan

Conceptualmente:

```text
QualityRemediationPlan
├── issue
├── rootCause
├── source
├── actions
├── authority
├── verification
└── metadata
```

---

# 308. Quality Runtime

Conceptualmente:

```text
QualityRuntime
├── profile
├── measure
├── score
├── drift
├── evaluateGate
├── quarantine
├── remediate
└── diagnose
```

---

# 309. Quality Registry

Podrá mantener:

```text
requirements
dimensions
rules
owners
gates
known limitations
```

---

# 310. First Implementation Components

La primera implementación deberá incluir:

```text
QualityState

QualityRequirement
QualityDimension
QualityRule

QualityMeasurement
QualityScore

DataProfile
QualityIssue

QualityPolicy
QualityGate

QualityRuntime
QualityRegistry

QualityError
```

---

# 311. Optional Initial Components

Podrán incorporarse:

```text
QualitySnapshot

QualityDrift
DriftDetector

QuarantinePolicy
QualityRemediationPlan

QualityDiagnostics
```

---

# 312. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Quality Remediation
Semantic Quality Inference
Advanced Anomaly Detection
Automatic Threshold Tuning
Predictive Quality Drift
Automated Data Steward Assistant
AI-Assisted Data Quality Engineering
```

---

# 313. Estructura Conceptual de Directorios

```text
src/
└── DataQuality/
    ├── State/
    │   └── QualityState
    │
    ├── Requirement/
    │   └── QualityRequirement
    │
    ├── Dimension/
    │   └── QualityDimension
    │
    ├── Rule/
    │   └── QualityRule
    │
    ├── Measurement/
    │   └── QualityMeasurement
    │
    ├── Score/
    │   └── QualityScore
    │
    ├── Profile/
    │   └── DataProfile
    │
    ├── Issue/
    │   └── QualityIssue
    │
    ├── Drift/
    │   ├── QualityDrift
    │   └── DriftDetector
    │
    ├── Policy/
    │   ├── QualityPolicy
    │   └── QuarantinePolicy
    │
    ├── Gate/
    │   └── QualityGate
    │
    ├── Remediation/
    │   └── QualityRemediationPlan
    │
    ├── Snapshot/
    │   └── QualitySnapshot
    │
    ├── Runtime/
    │   └── QualityRuntime
    │
    ├── Registry/
    │   └── QualityRegistry
    │
    ├── Diagnostics/
    │   └── QualityDiagnostics
    │
    └── Error/
        └── QualityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 314. Error Namespace

ENG-080 utilizará:

```text
MEF-DATA-QUALITY-xxx
```

---

# 315. Taxonomía ENG-080

```text
MEF-DATA-QUALITY-001 Quality requirement invalid
MEF-DATA-QUALITY-002 Quality use case unspecified
MEF-DATA-QUALITY-003 Quality dimension invalid
MEF-DATA-QUALITY-004 Quality rule invalid
MEF-DATA-QUALITY-005 Quality threshold invalid
MEF-DATA-QUALITY-006 Quality measurement invalid
MEF-DATA-QUALITY-007 Quality completeness insufficient
MEF-DATA-QUALITY-008 Quality accuracy insufficient
MEF-DATA-QUALITY-009 Quality validity insufficient
MEF-DATA-QUALITY-010 Quality consistency insufficient
MEF-DATA-QUALITY-011 Quality timeliness insufficient
MEF-DATA-QUALITY-012 Quality freshness insufficient
MEF-DATA-QUALITY-013 Quality uniqueness insufficient
MEF-DATA-QUALITY-014 Quality relevance insufficient
MEF-DATA-QUALITY-015 Quality profile invalid
MEF-DATA-QUALITY-016 Quality anomaly detected
MEF-DATA-QUALITY-017 Quality drift detected
MEF-DATA-QUALITY-018 Quality regression detected
MEF-DATA-QUALITY-019 Quality issue critical
MEF-DATA-QUALITY-020 Quality data unfit
MEF-DATA-QUALITY-021 Quality quarantine required
MEF-DATA-QUALITY-022 Quality remediation failed
MEF-DATA-QUALITY-023 Quality reference data invalid
MEF-DATA-QUALITY-024 Quality master data conflict
MEF-DATA-QUALITY-025 Quality gate failed
MEF-DATA-QUALITY-026 Quality gate override denied
MEF-DATA-QUALITY-027 Quality ownership missing
MEF-DATA-QUALITY-028 Quality security violation
MEF-DATA-QUALITY-029 Quality state unknown
MEF-DATA-QUALITY-030 Quality invariant violation
```

---

# 316. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Quality Requirements
Explicit Use Cases
Fitness for Purpose

Completeness
Accuracy
Validity
Consistency
Timeliness
Freshness
Uniqueness
Relevance

Dimension-Specific Metrics
Explicit Thresholds

Critical Dimension Overrides

Data Profiling
Quality Baselines

Quality Issues
Quality Drift

Quality Gates
Quarantine

Ownership
Stewardship Awareness

Security
Audit
Observability
Testing
```

---

# 317. First Version Non-Goals

No deberá requerir:

```text
Automatic Quality Remediation
Automatic Threshold Learning
Advanced Statistical Anomaly Platform
Semantic Data Cleaning
Predictive Quality Drift
AI-Assisted Data Stewardship
```

---

# 318. Second Phase

Podrá incorporar:

```text
Quality Drift Detection
Quality Snapshots

Advanced Profiling
Quality SLOs

Reference/Master Data Quality

Quarantine Workflow
Remediation Plans

Data Product Quality Contracts
```

---

# 319. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Quality Remediation
Adaptive Quality Thresholds
Advanced Anomaly Detection
Semantic Quality Inference
Predictive Quality Drift
Automated Steward Assistance
AI-Assisted Data Quality Engineering
```

---

# 320. Invariantes de Ingeniería

ENG-080 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1546 | Todo Data Quality Requirement contractual deberá declarar Scope, Consumer, Use Case, Dimensions, Metrics, Thresholds, Measurement Window, Criticality, Failure Behavior y Ownership suficientes para determinar Fitness for Purpose. |
| EI-1547 | Data Quality deberá permanecer diferenciada de Data Integrity, Accuracy, Completeness, Validation, Consistency Engineering y Data Profiling y ninguna dimensión o mecanismo individual deberá utilizarse como prueba universal de Quality. |
| EI-1548 | Fitness for Purpose deberá ser contextual y el mismo Data podrá clasificarse FIT para un Consumer y UNFIT para otro cuando sus requisitos de Completeness, Freshness, Accuracy u otras Dimensions sean diferentes. |
| EI-1549 | Completeness deberá distinguir Missing, Null, Empty, Placeholder y Conditionally Required Values y ningún Placeholder deberá utilizarse para inflar artificialmente Quality Metrics. |
| EI-1550 | Accuracy deberá utilizar Reference, Authority, Evidence o Confidence explícitos cuando sea medible y un valor sintáctica o estructuralmente válido no deberá presentarse automáticamente como exacto. |
| EI-1551 | Timeliness y Freshness deberán conservar semánticas diferenciadas y toda Freshness Metric deberá declarar si utiliza Event Time, Effective Time, Ingestion Time, Processing Time u otra referencia temporal. |
| EI-1552 | Uniqueness deberá evaluarse respecto de una Identity Policy explícita y Semantic Deduplication probabilística no deberá fusionar automáticamente Records cuando el Confidence sea insuficiente o exista riesgo de False Merge. |
| EI-1553 | Quality Rules, Thresholds, Tolerances y Weights deberán derivarse del Use Case y poseer Ownership; valores arbitrarios, sin explicación o no versionados no deberán utilizarse como Gates contractuales críticos. |
| EI-1554 | Aggregate Quality Scores deberán conservar Dimension Scores y ninguna puntuación promedio deberá ocultar una violación de una Critical Dimension cuyo Contract determine que el Data es UNFIT. |
| EI-1555 | Data Profiling deberá describir características observadas sin sustituir Quality Requirements y Full/Sampled Profiling deberán conservar Semantics distintas respecto del nivel de Confidence. |
| EI-1556 | Outliers, Anomalies y Distribution Drift deberán considerarse Signals que requieren interpretación y no deberán clasificarse automáticamente como errores cuando puedan representar cambios legítimos del Domain. |
| EI-1557 | Quality Baselines y Regression Analysis deberán considerar Scope, Seasonality, Rule Version y Measurement Window suficientes para distinguir deterioro real de cambios esperados de población o negocio. |
| EI-1558 | External, Reference y Master Data críticos deberán poseer Authority, Freshness y Quality Expectations y problemas de Source no deberán ocultarse mediante correcciones silenciosas que destruyan Provenance o Root Cause Evidence. |
| EI-1559 | Quarantine, Reject y Accept-With-Warning deberán ser comportamientos explícitos de Policy y Data crítico que viole un Blocking Threshold no deberá continuar por Pipelines como si fuera FIT. |
| EI-1560 | Quality Remediation deberá preservar Provenance y distinguir Observed, Corrected, Inferred, Imputed y Generated Values y el sistema no deberá inventar Data no marcada con el único propósito de mejorar Quality Scores. |
| EI-1561 | Data Stewardship y Ownership deberán existir para Data Quality crítica y Rules, Issues, Thresholds y Remediation sin responsable identificable deberán considerarse riesgo de Governance. |
| EI-1562 | Data Quality en Pipelines, Migrations, Imports, Data Products, Analytics y ML deberá verificarse en Boundaries apropiadas y una transformación técnicamente exitosa no deberá considerarse exitosa si degrada Quality más allá del Contract. |
| EI-1563 | Data Quality Security y Audit deberán proteger Rules, Thresholds, Scores, Source Identity, Quarantine y Remediation Operations y deberán impedir manipulación que haga pasar Data no apto como FIT. |
| EI-1564 | Data Quality Observability y Testing deberán permitir medir Completeness, Accuracy cuando exista Reference, Validity, Timeliness, Freshness, Uniqueness, Drift, Issues, Gates y Remediation con Units, Denominators y Cardinality controlados. |
| EI-1565 | La primera implementación deberá priorizar Fitness for Purpose, explicit Quality Requirements, Core Dimensions, Metrics, Thresholds, Critical Overrides, Profiles, Baselines, Issues, Drift, Gates, Quarantine y Ownership antes de introducir Automatic Remediation, Adaptive Thresholds, Predictive Quality Drift o AI-Assisted Data Stewardship. |

---

# 321. Continuidad de Invariantes

```text
ENG-076 → EI-1466 a EI-1485
ENG-077 → EI-1486 a EI-1505
ENG-078 → EI-1506 a EI-1525
ENG-079 → EI-1526 a EI-1545
ENG-080 → EI-1546 a EI-1565
```

---

# 322. Criterios de Conformidad

Una implementación será conforme con ENG-080 cuando:

- defina Data Quality Requirements;
- identifique Consumer;
- identifique Use Case;
- implemente Fitness for Purpose;
- modele Completeness;
- modele Accuracy;
- modele Validity;
- modele Quality Consistency;
- modele Timeliness;
- modele Freshness;
- modele Uniqueness;
- modele Relevance;
- defina Metrics por Dimension;
- defina Thresholds;
- defina Critical Dimensions;
- preserve Dimension Scores;
- implemente Data Profiling;
- diferencie Sampling y Full Verification;
- detecte Null/Missing Drift;
- detecte Duplicate Drift;
- detecte Freshness Drift;
- mantenga Quality Baselines;
- detecte Quality Regressions;
- registre Quality Issues;
- implemente Quality Gates;
- implemente Quarantine;
- preserve Provenance en Remediation;
- distinga valores Observed e Imputed;
- defina Ownership;
- soporte Stewardship;
- preserve Multi-Tenant Scope;
- aplique Security;
- implemente Audit;
- implemente Observability;
- implemente Quality Testing.

---

# 323. Riesgos

Deberán evitarse especialmente:

```text
Integrity Equals Quality
Schema Valid Equals High Quality

Quality Without Use Case
One Global Quality Definition

Completeness Equals Accuracy
Freshness Equals Timeliness

Null Placeholder Counted as Complete
"N/A" Used to Game Completeness

Accuracy Claimed Without Reference

Aggregate Score Hides Critical Failure
Average Quality Hides Bad Tenant

Outlier Equals Error
Distribution Drift Equals Failure

Seasonality Ignored

Semantic Duplicate Auto-Merge
False Merge

Imputed Equals Observed
Generated Value Presented as Real

Quality Rule Without Owner
Threshold Without Justification

Quality Gate Without Rule Version
Silent Quality Downgrade

Bad Source Hidden by Local Correction

Quarantine Equals Delete

More Data Equals Better Quality
Quality Used to Defeat Data Minimization

Quality Score Tampering
Unauthorized Remediation
```

---

# 324. Relación con ENG-036

Validation responde:

```text
Does this input satisfy
specified rules?
```

Data Quality responde:

```text
Is the resulting data sufficiently
good for its intended purpose?
```

---

# 325. Relación con ENG-057

Metadata podrá declarar:

```text
owner
steward
description
quality requirements
criticality
```

---

# 326. Relación con ENG-062

Schema Engineering define Structure.

Data Quality puede medir calidad incluso cuando todos los Records satisfacen Schema.

---

# 327. Relación con ENG-063

Transformation Engineering deberá preservar:

```text
accuracy
precision
completeness
meaning
```

cuando formen parte del Quality Contract.

---

# 328. Relación con ENG-064

Data Pipeline Engineering deberá permitir Quality Gates entre Stages:

```text
SOURCE
  │
  ▼
QUALITY GATE
  │
  ▼
TRANSFORMATION
  │
  ▼
QUALITY GATE
  │
  ▼
SINK
```

---

# 329. Relación con ENG-065

Migration deberá comparar Quality:

```text
BEFORE
vs
AFTER
```

y detectar Regression.

---

# 330. Relación con ENG-076

Recovery exitoso en Integrity no garantiza automáticamente que Data restaurada sea suficientemente fresca para todos los Consumers.

---

# 331. Relación con ENG-078

ENG-078 puede permitir Read Stale según su Consistency Contract.

ENG-080 podrá clasificar ese mismo dato como UNFIT si el Consumer necesita mayor Freshness.

---

# 332. Relación con ENG-079

Esta frontera deberá mantenerse estrictamente:

```text
INTEGRITY
ENG-079
→ Is the state valid?

QUALITY
ENG-080
→ Is the valid state good enough
  for this purpose?
```

---

# 333. Relación con ENG-081

**ENG-081 deberá formalizar Data Governance Engineering.**

La frontera será:

```text
DATA INTEGRITY
ENG-079
→ Is data valid?

DATA QUALITY
ENG-080
→ Is data fit for purpose?

DATA GOVERNANCE
ENG-081
→ Who owns the data, who may define
  policies over it, how is it classified,
  stewarded, retained, shared and governed
  across its lifecycle?
```

ENG-081 deberá cubrir:

```text
Data Governance

Governance Requirement
Governance Policy

Data Ownership
Data Stewardship

Data Domain
Data Product Ownership

Data Classification
Data Sensitivity

Data Catalog
Data Inventory

Data Asset
Data Definition

Business Glossary
Canonical Definition

Data Policy

Data Lifecycle Governance

Retention Governance
Deletion Governance

Data Access Governance
Data Sharing Governance

Data Residency
Data Sovereignty

Purpose Limitation

Data Minimization

Data Lineage Governance
Provenance Governance

Reference Data Governance
Master Data Governance

Data Contract Governance

Policy Enforcement

Governance Exception
Governance Waiver

Governance Review

Governance Security
Governance Audit
Governance Observability
Governance Testing
```

---

# 334. Principio Rector

> **MEF deberá considerar Data de calidad únicamente cuando sea apto para el propósito explícito que lo consume. Un registro puede ser perfectamente válido y durable y aun ser inútil si está incompleto, desactualizado, duplicado, impreciso o llega demasiado tarde. La calidad deberá medirse por dimensiones y requisitos verificables, nunca mediante etiquetas vagas ni Scores agregados que oculten fallas críticas.**

---

# 335. Conclusión

**ENG-080 — Data Quality Engineering** formaliza el concepto de:

```text
FITNESS FOR PURPOSE
```

La relación fundamental queda:

```text
DATA
  │
  ▼
INTEGRITY
  │
  ▼
QUALITY REQUIREMENTS
  │
  ├── Completeness
  ├── Accuracy
  ├── Validity
  ├── Consistency
  ├── Timeliness
  ├── Freshness
  ├── Uniqueness
  └── Relevance
  │
  ▼
FITNESS FOR PURPOSE
```

La separación entre Integrity y Quality queda:

```text
customer.phone = NULL
```

Puede ser:

```text
STRUCTURALLY VALID     ✓
DOMAIN VALID           ✓
REFERENTIAL INTEGRITY  ✓
```

pero para:

```text
telephone campaign
```

ser:

```text
COMPLETENESS           ✗
FITNESS FOR PURPOSE    ✗
```

En sentido contrario:

```text
customer.phone = "+52 55 1234 5678"
```

puede ser completo y sintácticamente válido, pero si pertenece a otra persona:

```text
COMPLETENESS    ✓
VALIDITY        ✓
ACCURACY        ✗
QUALITY         ✗
```

Esto demuestra que:

```text
VALID
≠
ACCURATE

COMPLETE
≠
ACCURATE

FRESH
≠
CORRECT

INTEGRAL
≠
FIT FOR PURPOSE
```

La diferencia Timeliness/Freshness queda:

```text
EVENT OCCURS
    │
    ▼
2026-08-10 10:00
    │
    │
    │  delayed transport
    │
    ▼
ARRIVES
2026-08-10 16:00
```

El dato puede representar correctamente el evento pero llegar:

```text
6 hours late
```

Por tanto:

```text
Accuracy     ✓
Integrity    ✓
Timeliness   ✗
```

El Quality Score deberá conservar las dimensiones:

```text
QUALITY
│
├── Completeness  99%
├── Accuracy      98%
├── Freshness     97%
├── Uniqueness    99.9%
└── Validity      99.5%
```

y no reducir toda la evaluación a:

```text
Quality = 98.68%
```

si, por ejemplo:

```text
payment uniqueness
```

requiere:

```text
100%
```

Un solo Critical Threshold puede hacer que:

```text
aggregate score = high
```

pero:

```text
FITNESS = UNFIT
```

El ciclo de calidad queda:

```text
DEFINE PURPOSE
      │
      ▼
DEFINE QUALITY REQUIREMENTS
      │
      ▼
PROFILE
      │
      ▼
MEASURE
      │
      ▼
COMPARE WITH THRESHOLDS
      │
   ┌──┴───────────────┐
   ▼                  ▼
  FIT               UNFIT
                       │
                       ▼
                  QUARANTINE
                       │
                       ▼
                    ANALYZE
                       │
                       ▼
                   REMEDIATE
                       │
                       ▼
                     VERIFY
```

El Drift queda:

```text
BASELINE
Completeness = 99.4%
     │
     ▼
98.9%
     │
     ▼
97.1%
     │
     ▼
93.8%
     │
     ▼
QUALITY DRIFT
```

La arquitectura de State/Data queda ahora:

```text
DURABILITY
ENG-077
│
└── ¿sobrevive el State?

CONSISTENCY
ENG-078
│
└── ¿qué versión se observa?

INTEGRITY
ENG-079
│
└── ¿esa versión es válida?

QUALITY
ENG-080
│
└── ¿esa versión válida es
    suficientemente buena
    para este propósito?
```

La cadena reciente queda:

```text
RECOVERABILITY
ENG-076
   │
   ▼
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
```

La primera implementación deberá concentrarse en:

```text
QualityState

QualityRequirement
QualityDimension
QualityRule

QualityMeasurement
QualityScore

DataProfile
QualityIssue

QualityPolicy
QualityGate

QualityRuntime
QualityRegistry
QualityError
```

con:

```text
Fitness for Purpose

Explicit Use Cases
Explicit Consumers

Completeness
Accuracy
Validity
Consistency
Timeliness
Freshness
Uniqueness
Relevance

Explicit Metrics
Explicit Thresholds

Critical Dimension Overrides

Data Profiling
Baselines
Regression
Drift

Quality Issues
Quality Gates
Quarantine

Ownership
Stewardship

Security
Audit
Observability
Testing
```

antes de introducir:

```text
Automatic Quality Remediation
Adaptive Quality Thresholds
Advanced Anomaly Detection
Semantic Quality Inference
Predictive Quality Drift
Automated Data Steward Assistant
AI-Assisted Data Quality Engineering
```

Con **ENG-080**, la serie global alcanza:

```text
EI-1565
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
- ENG-027 — Runtime Engineering
- ENG-030 — Persistence Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-053 — State Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-076 — Recoverability Engineering
- ENG-077 — Durability Engineering
- ENG-078 — Consistency Engineering
- ENG-079 — Data Integrity Engineering
- ENG-081 — Data Governance Engineering
```