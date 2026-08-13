---
id: ENG-074
titulo: Reliability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Reliability Engineering
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
  - ENG-034
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-041
  - ENG-043
  - ENG-048
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-064
  - ENG-068
  - ENG-069
  - ENG-070
  - ENG-071
  - ENG-072
  - ENG-073
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
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-037
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
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-062
  - ENG-063
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-075
keywords:
  - reliability
  - reliability-engineering
  - failure-rate
  - failure-probability
  - mttf
  - mtbf
  - mission-time
  - fault
  - defect
  - error
  - failure
  - fault-tolerance
  - fault-containment
  - defect-escape
  - failure-recurrence
  - reliability-baseline
  - reliability-regression
  - mef
---

# ENG-074

# Reliability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Reliability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-074 establece las reglas para:

```text
Reliability

Reliability Requirement
Reliability Objective
Reliability Target

Mission Time
Failure-Free Interval

Fault
Defect
Error
Failure

Failure Event
Failure Mode
Failure Cause
Failure Effect

Transient Failure
Intermittent Failure
Permanent Failure

Failure Rate
Failure Probability
Survival Probability

MTTF
MTBF
MTTR Relationship

Reliability Function

Fault Detection
Fault Identification
Fault Isolation
Fault Containment

Fault Tolerance
Error Detection
Error Correction

Failure Propagation
Failure Cascade

Dependency Reliability
Composite Reliability

Redundancy Reliability
Common-Mode Failure

Reliability Block Model

Reliability Degradation

Failure Recurrence
Defect Escape

Reliability Growth

Reliability Baseline
Reliability Regression

Reliability Gate

Reliability Security
Reliability Audit
Reliability Observability
Reliability Testing
```

---

# 2. Declaración

> **Toda Reliability gobernada por MEF deberá definirse respecto de una función, Mission Time y Failure Criterion explícitos. Un sistema no deberá considerarse Reliable únicamente porque posea Availability elevada, redundancia o recuperación rápida; MEF deberá distinguir Fault, Error y Failure, medir Failure Rate y recurrencia, analizar propagación y Common-Mode Failures, y verificar que los mecanismos de Fault Tolerance preserven Correctness.**

Arquitectura conceptual:

```text
FAULT
  │
  ▼
ERROR
  │
  ├── detected / corrected ──► CONTINUE
  │
  └── propagates
          │
          ▼
       FAILURE
          │
          ▼
     FAILURE EFFECT
```

Reliability observa:

```text
MISSION START
      │
      ▼
 CORRECT SERVICE
      │
      │
      │ failure-free interval
      │
      X FAILURE
      │
      ▼
MISSION FAILURE
```

---

# 3. Reliability Engineering

Responde:

```text
What function must remain correct?
For how long?
What counts as failure?
How often does it fail?
What failure modes exist?
Which faults are transient?
Which faults recur?
Can faults be isolated?
Can errors be corrected?
Can one component failure propagate?
What shared cause can defeat redundancy?
Is reliability improving or regressing?
```

---

# 4. Reliability

`Reliability` representa la probabilidad o capacidad de que un sistema cumpla correctamente una función requerida durante un intervalo definido y bajo condiciones especificadas.

---

# 5. Reliability ≠ Availability

Availability responde:

```text
Is the service usable when required?
```

Reliability responde:

```text
Can it continue operating correctly
without failure during the mission?
```

---

# 6. Reliability Example

Dos sistemas:

```text
SYSTEM A
fails every day
recovers in 2 seconds

SYSTEM B
fails once every 6 months
recovers in 30 minutes
```

pueden poseer perfiles de Availability y Reliability muy diferentes.

---

# 7. Reliability ≠ Resilience

Resilience gobierna adaptación y recuperación ante Failure.

Reliability busca evitar que Failure ocurra o se propague.

---

# 8. Reliability ≠ Health

Health representa estado actual observado.

Reliability representa comportamiento de Failure a lo largo del tiempo.

---

# 9. Reliability ≠ Durability

Durability deberá tratar persistencia correcta de información a través del tiempo y Failure.

---

# 10. Reliability ≠ Correctness

Correctness determina si el resultado es correcto.

Reliability determina con qué consistencia el sistema mantiene Correctness durante la operación.

---

# 11. Reliability Requirement

Todo Requirement deberá declarar:

```text
scope
required function
mission time
operating conditions
failure criterion
target
measurement method
```

---

# 12. Reliability Requirement Example

```text
Component:
payment-worker

Required Function:
process accepted payment message exactly
according to transaction contract

Mission Time:
24 hours continuous operation

Reliability Objective:
>= 99.99% probability of completing
mission without functional failure
under defined workload
```

---

# 13. Vague Requirement

No deberá utilizarse como Contract:

```text
stable
robust
reliable
enterprise grade
never fails
```

---

# 14. Mission Time

Intervalo durante el cual se evalúa Failure-Free Operation.

Ejemplos:

```text
single request
one job
8-hour batch
24-hour runtime
30-day mission
device lifetime
```

---

# 15. Mission Time Importance

La probabilidad de Failure normalmente cambia con la duración.

---

# 16. Failure-Free Interval

Periodo continuo sin Failure contractual.

---

# 17. Reliability Objective

Podrá expresarse mediante:

```text
failure probability
survival probability
failure rate
MTTF
MTBF
maximum recurrence
```

---

# 18. Reliability Scope

Podrá ser:

```text
operation
component
application
service
worker
pipeline
module
dependency
```

---

# 19. Fault

Condición anómala capaz de producir un Error.

---

# 20. Defect

Problema introducido en diseño, código, configuración, datos o proceso que puede originar Fault.

---

# 21. Error

Estado interno incorrecto resultante de un Fault.

---

# 22. Failure

Manifestación observable de que el sistema no cumple la función requerida.

---

# 23. Fault / Error / Failure Chain

Conceptualmente:

```text
DEFECT
   │
   ▼
FAULT ACTIVATION
   │
   ▼
ERROR
   │
   ▼
FAILURE
```

---

# 24. Defect ≠ Failure

Un Defect puede permanecer latente.

---

# 25. Fault ≠ Failure

Un Fault puede ser detectado y contenido antes de producir Failure.

---

# 26. Error ≠ Failure

Un Error interno puede corregirse.

---

# 27. Failure Criterion

Deberá ser explícito.

Ejemplos:

```text
incorrect result
lost message
duplicate forbidden side effect
unexpected termination
state corruption
contract violation
deadline missed
```

---

# 28. Performance Failure

Una operación demasiado lenta podrá considerarse Failure si el Contract incluye Deadline.

---

# 29. Silent Data Corruption

Deberá considerarse Failure crítico aunque el proceso permanezca Alive.

---

# 30. Failure Event

Representa una ocurrencia concreta.

Conceptualmente:

```text
FailureEvent
├── id
├── scope
├── mode
├── detectedAt
├── effect
├── cause
└── metadata
```

---

# 31. Failure Identity

Failures importantes deberán poder correlacionarse.

---

# 32. Failure Mode

Describe cómo falla el sistema.

Ejemplos:

```text
timeout
wrong result
crash
lost data
duplicate processing
deadlock
resource leak
corruption
```

---

# 33. Failure Cause

Describe origen conocido o inferido.

---

# 34. Failure Effect

Describe impacto observable.

---

# 35. Cause ≠ Effect

No deberán confundirse.

---

# 36. Failure Mode Taxonomy

Deberá ser estable y limitada.

---

# 37. Transient Failure

Existe temporalmente y puede desaparecer sin modificación permanente.

Ejemplos:

```text
temporary network loss
brief dependency overload
lock conflict
```

---

# 38. Intermittent Failure

Aparece y desaparece repetidamente.

---

# 39. Permanent Failure

Persiste hasta Repair, Replacement o intervención.

---

# 40. Failure Classification

Deberá influir en Recovery/Retry Policy.

---

# 41. Transient ≠ Retry Forever

Retries deberán seguir ENG-039.

---

# 42. Failure Rate

Representa frecuencia de Failures dentro de una población o intervalo apropiado.

Conceptualmente:

```text
Failure Rate =
Failures
/
Exposure
```

donde Exposure deberá definirse.

---

# 43. Exposure

Podrá ser:

```text
time
requests
transactions
jobs
messages
device-hours
```

---

# 44. Failure Rate Units

Deberán ser explícitas.

---

# 45. Failure Probability

Probabilidad de al menos un Failure dentro de condiciones y Mission Time definidos.

---

# 46. Survival Probability

Probabilidad de completar la Mission sin Failure.

---

# 47. Reliability Function

Conceptualmente:

```text
R(t) = P(T > t)
```

cuando el modelo probabilístico utilizado lo permita.

---

# 48. Model Assumptions

Deberán documentarse.

---

# 49. Constant Failure Rate

No deberá asumirse universalmente.

---

# 50. Software Failure Modeling

No deberá copiar mecánicamente modelos de desgaste físico cuando no sean apropiados.

---

# 51. MTTF

`Mean Time To Failure`.

Adecuado principalmente para elementos no reparables o cuando el Contract lo defina.

---

# 52. MTBF

`Mean Time Between Failures`.

Representa intervalo medio entre Failures de un sistema reparable.

---

# 53. MTTR

Tiempo medio de Repair/Recovery.

Es más relevante para Availability/Recovery que para Failure-Free Reliability.

---

# 54. MTBF ≠ Availability

No deberán confundirse.

Conceptualmente, bajo ciertos supuestos:

```text
Availability
≈
MTBF / (MTBF + MTTR)
```

pero la fórmula no deberá utilizarse fuera de sus condiciones.

---

# 55. Mean Metrics Limitation

Promedios pueden ocultar distribuciones.

---

# 56. Failure Interval Distribution

Podrá requerir:

```text
percentiles
histogram
survival analysis
```

cuando sea relevante.

---

# 57. Reliability Baseline

Representa comportamiento conocido de Failure para una Version/Environment.

---

# 58. Baseline Conditions

Deberán registrar:

```text
version
environment
workload
mission time
dependencies
resources
failure criteria
```

---

# 59. Reliability Baseline Drift

Cambios en condiciones deberán distinguirse de Regression.

---

# 60. Fault Detection

Identifica condición anómala.

---

# 61. Detection Latency

Deberá medirse cuando afecte propagación.

---

# 62. Fault Identification

Determina naturaleza del Fault.

---

# 63. Fault Localization

Determina componente o Scope origen.

---

# 64. Fault Isolation

Evita que Fault afecte otros Scopes.

---

# 65. Fault Containment

Limita propagación.

---

# 66. Containment Boundary

Podrá ser:

```text
request
process
worker
tenant
partition
module
service
zone
```

---

# 67. Failure Isolation

Deberá favorecer Blast Radius mínimo razonable.

---

# 68. Bulkhead

ENG-039 podrá utilizar Bulkheads como mecanismo de aislamiento.

---

# 69. Process Isolation

Un Worker defectuoso podrá terminar sin derribar todo Runtime cuando Architecture lo permita.

---

# 70. Tenant Isolation

Un Fault perteneciente a Tenant no deberá corromper otros Tenants.

---

# 71. Partition Isolation

Un Poison Record no deberá detener todo Pipeline si puede aislarse con seguridad.

---

# 72. Module Isolation

Module Fault deberá respetar boundaries.

---

# 73. Plugin Isolation

Plugin defectuoso no deberá comprometer Core Reliability innecesariamente.

---

# 74. Fault Tolerance

Permite continuar función correcta a pesar de determinados Faults.

---

# 75. Fault Tolerance Contract

Deberá declarar qué Faults tolera.

---

# 76. Fault Tolerance ≠ Ignore Error

Tolerar un Fault requiere preservar función correcta.

---

# 77. Error Detection

Puede identificar estado inválido antes de Failure externo.

---

# 78. Error Correction

Podrá restaurar estado correcto.

Ejemplos:

```text
retry safe operation
checksum correction
replica repair
state reconstruction
```

---

# 79. Correction Preconditions

Deberá conocer Source of Truth.

---

# 80. Guessing Correct State

Queda prohibido cuando pueda producir corrupción.

---

# 81. Fail Fast

Podrá mejorar Reliability sistémica cuando continuar produciría corrupción.

---

# 82. Fail Stop

Componente se detiene de forma detectable.

---

# 83. Byzantine Behavior

No deberá asumirse resuelto salvo arquitectura explícitamente diseñada para ello.

---

# 84. Failure Propagation

Describe cómo un Failure afecta otros componentes.

---

# 85. Propagation Path

Conceptualmente:

```text
Dependency Failure
      │
      ▼
Retry Storm
      │
      ▼
Resource Exhaustion
      │
      ▼
Application Failure
      │
      ▼
Service Outage
```

---

# 86. Cascading Failure

Deberá analizarse.

---

# 87. Cascade Prevention

Podrá utilizar:

```text
timeouts
circuit breakers
bulkheads
load shedding
backpressure
resource limits
```

---

# 88. Retry Amplification

Deberá considerarse Reliability Risk.

---

# 89. Timeout Cascade

Timeouts mal alineados pueden aumentar Failures.

---

# 90. Dependency Reliability

Cada Dependency deberá poseer Reliability assumptions conocidas cuando sea crítica.

---

# 91. Dependency Failure Modes

Deberán incluir más que simple:

```text
up / down
```

Ejemplos:

```text
slow
stale
corrupt
partial
inconsistent
rate limited
```

---

# 92. Partial Dependency Failure

Puede ser más difícil de detectar que Outage total.

---

# 93. Composite Reliability

Depende de estructura de Dependencies y Fault Correlation.

---

# 94. Serial Reliability Structure

Si todos los componentes son necesarios:

```text
A → B → C
```

cada Failure puede impedir Mission.

---

# 95. Parallel Reliability Structure

Redundancy puede permitir:

```text
A1
 ├──► Function
A2
```

---

# 96. Reliability Block Model

Podrá representar combinaciones serial/paralelo.

---

# 97. Independence Assumption

No deberá asumirse si Components comparten:

```text
provider
deployment
configuration
database
network
secret
code defect
```

---

# 98. Common-Mode Failure

Un solo Cause afecta múltiples componentes redundantes.

---

# 99. Common-Mode Examples

```text
bad release
invalid migration
expired shared certificate
shared DNS outage
shared secret rotation failure
same software defect
```

---

# 100. Redundancy Reliability

La redundancia solo mejora Reliability frente a Failure Modes realmente independientes.

---

# 101. Diverse Redundancy

Puede reducir Common-Mode Failure.

---

# 102. Diversity Cost

Introduce:

```text
complexity
operational cost
compatibility risk
```

---

# 103. Reliability Degradation

Failure Rate aumenta o Failure-Free Intervals disminuyen.

---

# 104. Degradation Signals

Podrán incluir:

```text
increasing crashes
increasing retries
increasing corruption
increasing deadlocks
increasing recurring incidents
```

---

# 105. Reliability Growth

Mejora demostrable de Reliability a lo largo de Versions.

---

# 106. Reliability Growth Evidence

Podrá incluir:

```text
reduced failure rate
longer failure-free intervals
lower recurrence
fewer escaped defects
```

---

# 107. Reliability Regression

Nueva Version presenta peor comportamiento de Failure.

---

# 108. Reliability Regression Example

```text
v1:
1 failure / 10M jobs

v2:
7 failures / 10M jobs
```

---

# 109. Reliability Regression ≠ Availability Regression

Recovery muy rápida puede ocultar Reliability Regression dentro del Availability Ratio.

---

# 110. Defect Escape

Defect que alcanza un Environment posterior al punto donde idealmente debía detectarse.

---

# 111. Escape Stages

Podrán incluir:

```text
unit test
integration test
staging
production
```

---

# 112. Production Escape

Deberá ser observable para defectos críticos.

---

# 113. Escape Rate

Podrá utilizarse como Reliability Engineering signal.

---

# 114. Defect Escape ≠ Failure Automatically

El Defect puede no activarse todavía.

---

# 115. Failure Recurrence

Mismo Failure Mode o Root Cause reaparece después de considerarse resuelto.

---

# 116. Recurrence Identity

Deberá permitir correlación por:

```text
failure mode
root cause
component
defect
```

---

# 117. Repeated Incident

No deberá tratarse como evento totalmente independiente cuando comparte Root Cause.

---

# 118. Recurrence Window

Podrá definirse.

---

# 119. Recurrence Policy

Failures críticos recurrentes deberán requerir análisis.

---

# 120. Permanent Fix

Deberá diferenciarse de Workaround.

---

# 121. Reliability and Correctness

Incorrect Output es Failure aunque Latency y Availability sean buenas.

---

# 122. Data Corruption

Deberá considerarse Reliability Failure de alta severidad.

---

# 123. Silent Failure

Failure no detectado es especialmente crítico.

---

# 124. False Success

Sistema reporta Success pero función no se completó correctamente.

---

# 125. Reliability Verification

Deberá incluir comprobación de outcomes, no solo process survival.

---

# 126. Reliability and State

ENG-053 deberá asegurar invariantes de State.

---

# 127. State Corruption Detection

Deberá existir cuando riesgo lo justifique.

---

# 128. State Repair

Deberá identificar Source of Truth.

---

# 129. Reliability and Transactions

ENG-042 deberá preservar Atomicity correspondiente.

---

# 130. Partial Commit

Podrá ser Reliability Failure.

---

# 131. Reliability and Messaging

ENG-041 deberá considerar:

```text
message loss
duplicate forbidden effect
ordering violation
poison message
consumer crash
```

---

# 132. Reliability and Pipelines

ENG-064 deberá considerar:

```text
lost record
duplicate side effect
checkpoint corruption
incorrect resume
stage failure
```

---

# 133. Reliability and Scheduling

ENG-040 deberá considerar:

```text
missed job
duplicate job
stuck job
incorrect schedule
```

---

# 134. Reliability and Data Access

ENG-043 deberá considerar:

```text
incorrect mapping
stale write
lost update
connection failure
transaction failure
```

---

# 135. Reliability and Serialization

ENG-031 deberá considerar:

```text
corrupt encoding
incompatible decode
silent truncation
```

---

# 136. Reliability and Transport

ENG-032 deberá considerar:

```text
packet/message corruption
truncation
timeout
partial delivery
```

---

# 137. Reliability and Caching

Cache deberá evitar:

```text
incorrect stale result
corrupt value
invalid cross-tenant result
```

---

# 138. Reliability and Concurrency

ENG-038 deberá considerar:

```text
race condition
deadlock
livelock
lost update
memory visibility
```

---

# 139. Concurrency Defects

Pueden producir Failures intermitentes difíciles de reproducir.

---

# 140. Deterministic Reproduction

Deberá favorecerse mediante Testing/Tracing cuando sea posible.

---

# 141. Reliability and Deployment

ENG-067 puede introducir Common-Mode Failure mediante Release defectuosa.

---

# 142. Progressive Deployment

Puede reducir Blast Radius de Reliability Regression.

---

# 143. Reliability and Upgrade

Mixed-Version behavior podrá revelar latent defects.

---

# 144. Reliability and Migration

Migration defectuosa puede producir persistent corruption.

---

# 145. Reliability and Environment

ENG-068 proporciona Failure Conditions y Operating Context.

---

# 146. Reliability and Health

ENG-069 proporciona señales actuales.

Reliability agrega History y Failure Behavior.

---

# 147. Reliability and Performance

Performance Regression podrá convertirse en Reliability Failure cuando viola Deadline contractual.

---

# 148. Reliability and Capacity

Capacity Exhaustion puede producir Failure.

---

# 149. Reliability and Scalability

Scaling puede introducir:

```text
coordination failures
state transfer failures
hot partition failures
rebalancing failures
```

---

# 150. Reliability and Availability

ENG-073 mide Service Uptime.

ENG-074 mide Failure-Free Behavior.

---

# 151. Fault Injection

Podrá utilizarse para validar Fault Tolerance.

---

# 152. Fault Injection Scope

Deberá estar autorizado y acotado.

---

# 153. Fault Injection Examples

```text
exception
timeout
connection reset
process kill
disk error
message corruption
clock skew
resource exhaustion
```

---

# 154. Fault Injection Safety

No deberá producir daño irreversible fuera del Scope autorizado.

---

# 155. Chaos Engineering

Podrá utilizarse en fases posteriores para validar Reliability y Resilience bajo Failure realista.

---

# 156. Chaos ≠ Random Destruction

Deberá partir de hipótesis y Safety Controls.

---

# 157. Reliability Experiment

Conceptualmente:

```text
Hypothesis
   │
   ▼
Failure Injection
   │
   ▼
Observe
   │
   ▼
Contain?
Recover?
Correct?
   │
   ▼
Conclusion
```

---

# 158. Reliability Measurement

Podrá basarse en:

```text
failure events
transactions
jobs
runtime hours
mission completions
incident recurrence
```

---

# 159. Measurement Denominator

Deberá ser apropiado.

---

# 160. Failure Per Request

Puede ser útil para request-driven systems.

---

# 161. Failure Per Time

Puede ser útil para continuously running components.

---

# 162. Failure Per Job

Puede ser útil para batch/background workloads.

---

# 163. Reliability Snapshot

Conceptualmente:

```text
ReliabilitySnapshot
├── observedAt
├── scope
├── failureRate
├── failureProbability
├── failureFreeInterval
├── recurringFailures
└── state
```

---

# 164. Reliability State

Podrá clasificarse:

```text
RELIABLE
DEGRADED
UNRELIABLE
REGRESSION
UNKNOWN
```

---

# 165. RELIABLE

Requirements se satisfacen.

---

# 166. DEGRADED

Signals muestran deterioro sin violación completa del Requirement.

---

# 167. UNRELIABLE

Requirement contractual se viola.

---

# 168. REGRESSION

Nueva Version empeora significativamente frente a Baseline.

---

# 169. UNKNOWN

No existe evidencia suficiente.

---

# 170. UNKNOWN ≠ RELIABLE

La falta de Failures observados en exposición insuficiente no prueba Reliability.

---

# 171. Exposure Confidence

Deberá considerarse.

---

# 172. Zero Failures

```text
0 failures / 10 requests
```

no es equivalente a:

```text
0 failures / 1,000,000,000 requests
```

---

# 173. Sample Size

Deberá ser suficiente para afirmaciones fuertes.

---

# 174. Reliability Confidence

Podrá incorporar incertidumbre estadística cuando sea necesario.

---

# 175. Rare Failure

Failures de baja frecuencia requieren alta Exposure para validación.

---

# 176. Reliability Gate

Podrá utilizarse durante Release/Promotion.

---

# 177. Gate Inputs

Podrán incluir:

```text
failure rate
critical failures
recurrence
escaped defects
reliability regression
exposure
```

---

# 178. Gate Override

Deberá requerir Authority y Audit.

---

# 179. Reliability Security

ENG-024 gobernará Security.

---

# 180. Reliability Failure vs Security Failure

Security violation también puede constituir Failure funcional cuando el Contract exige protección.

---

# 181. Security Control Bypass

No deberá aceptarse como Fault Tolerance.

---

# 182. Fail Open

No deberá utilizarse para mejorar Reliability aparente si viola Security Contract.

---

# 183. Fault Injection Authorization

Deberá ser obligatoria en Production o Shared Environments.

---

# 184. Fault Injection Abuse

Puede convertirse en DoS o Data Corruption.

---

# 185. Reliability Data Sensitivity

Failure reports podrán contener:

```text
stack traces
queries
identifiers
topology
payload excerpts
```

y deberán protegerse.

---

# 186. Reliability Audit

Cambios relevantes deberán ser auditables.

---

# 187. Audit Events

Podrán incluir:

```text
reliability objective changed
failure classification changed
reliability baseline changed
fault injection started
reliability gate overridden
failure marked resolved
```

---

# 188. Reliability Observability

ENG-025 gobernará Telemetry.

---

# 189. Metrics

Podrán incluir:

```text
mef.reliability.failure.total
mef.reliability.failure.rate
mef.reliability.failure_free_interval
mef.reliability.recurrence.total
mef.reliability.defect_escape.total
mef.reliability.regression
```

---

# 190. Failure Metrics

Podrán utilizar Labels acotados:

```text
failureMode
componentType
classification
severity
```

---

# 191. Failure ID as Metric Label

Queda desaconsejado.

---

# 192. Reliability Logs

Deberán registrar especialmente:

```text
first occurrence
state transition
recurrence
containment failure
correction failure
```

---

# 193. Failure Log Flood

Deberá evitarse en Failures repetitivos.

---

# 194. Reliability Tracing

Podrá utilizarse para reconstruir Failure Propagation.

---

# 195. Correlation

Deberá utilizar ENG-056.

---

# 196. Diagnostics

Deberá poder responder:

```text
what failed?
how often?
what was the failure mode?
what caused it?
was it contained?
did it propagate?
is it recurring?
which version introduced it?
what is failure rate?
what is current failure-free interval?
```

---

# 197. Failure Registry

Podrá mantener conocimiento limitado de:

```text
failure mode
root cause
known defect
workaround
permanent fix
recurrence
```

---

# 198. Failure Registry ≠ Issue Tracker

No deberá convertirse en un sistema completo de gestión de proyectos.

---

# 199. Reliability Testing

ENG-009 gobernará Testing.

---

# 200. Failure Criterion Test

Deberá comprobar definición de Failure.

---

# 201. Mission Test

Deberá ejecutar función durante Mission Time relevante cuando sea viable.

---

# 202. Long-Running Test

Podrá detectar:

```text
leaks
state drift
deadlocks
resource exhaustion
recurring intermittent failures
```

---

# 203. Fault Injection Test

Deberá comprobar Fault Tolerance.

---

# 204. Fault Detection Test

Deberá comprobar Detection.

---

# 205. Fault Isolation Test

Deberá comprobar Containment Boundary.

---

# 206. Fault Propagation Test

Deberá comprobar que Failure no se propague más allá de lo prometido.

---

# 207. Error Correction Test

Deberá verificar Source of Truth y Correctness.

---

# 208. Common-Mode Failure Test

Deberá comprobar redundancia frente a shared causes.

---

# 209. Dependency Reliability Test

Deberá probar:

```text
timeout
slow response
invalid response
partial response
stale response
corrupt response
```

---

# 210. Intermittent Failure Test

Deberá introducir Failure no determinista/recurrente.

---

# 211. Permanent Failure Test

Deberá comprobar Recovery/Replacement apropiado.

---

# 212. Retry Reliability Test

Deberá comprobar que Retry no produzca duplicate forbidden effects.

---

# 213. Concurrency Reliability Test

Deberá probar:

```text
race
deadlock
livelock
contention
```

---

# 214. State Corruption Test

Deberá verificar Detection y Recovery.

---

# 215. Message Reliability Test

Deberá cubrir:

```text
loss
duplicate
reordering
poison message
consumer crash
```

según Contract.

---

# 216. Pipeline Reliability Test

Deberá cubrir:

```text
checkpoint failure
resume
duplicate processing
lost record
stage crash
```

---

# 217. Deployment Reliability Test

Deberá comprobar Release Failure y Rollback/Rollforward.

---

# 218. Reliability Regression Test

Deberá comparar Baseline y Candidate.

---

# 219. Recurrence Test

Deberá comprobar que Defect corregido no reaparezca.

---

# 220. Defect Escape Analysis

Deberá revisar Critical Production Failures.

---

# 221. Security Reliability Test

Deberá comprobar que Fault Tolerance no reduzca Security.

---

# 222. Architecture Test

Podrá impedir:

```text
reliability claim without mission time
availability used as reliability proof
fault/error/failure conflation
retry used as universal fault tolerance
redundancy without common-mode analysis
zero failures with tiny sample used as proof
failure ignored because process stayed alive
```

---

# 223. Build Integration

ENG-012 podrá validar:

```text
reliability requirement definitions
failure mode taxonomy
missing failure criteria
invalid mission time
fault tolerance declarations
reliability baseline configuration
```

---

# 224. Reliability Tests in CI

Tests extensos podrán ejecutarse en:

```text
integration pipeline
scheduled reliability pipeline
release candidate environment
preproduction
```

---

# 225. CLI

ENG-007 podrá proporcionar:

```text
mef reliability
mef reliability:requirements
mef reliability:failures
mef reliability:rate
mef reliability:baseline
mef reliability:compare
mef reliability:recurrence
mef reliability:inject
mef reliability:test
mef reliability:diagnose
```

---

# 226. `mef reliability`

Podrá mostrar Reliability Snapshot.

---

# 227. `reliability:requirements`

Podrá mostrar:

```text
scope
mission time
failure criterion
objective
```

---

# 228. `reliability:failures`

Podrá mostrar Failure Modes conocidos.

---

# 229. `reliability:rate`

Podrá mostrar:

```text
failures
exposure
failure rate
```

---

# 230. `reliability:baseline`

Podrá mostrar Baseline.

---

# 231. `reliability:compare`

Podrá comparar:

```text
baseline
candidate
```

---

# 232. `reliability:recurrence`

Podrá mostrar Failure Recurrence.

---

# 233. `reliability:inject`

Solo deberá ejecutar Fault Injection autorizada.

---

# 234. `reliability:test`

Podrá ejecutar Reliability Experiment.

---

# 235. `reliability:diagnose`

Podrá mostrar:

```text
state
requirement
mission time
failure rate
failure-free interval
failure modes
recurrences
escaped defects
containment failures
baseline
regressions
```

---

# 236. Registry Integration

ENG-020 podrá registrar:

```text
ReliabilityRequirement
FailureMode
ReliabilityPolicy
ReliabilityBaseline
ReliabilityGate
FaultInjector
```

---

# 237. Reliability Requirement Contract

Conceptualmente:

```text
ReliabilityRequirement
├── id
├── scope
├── requiredFunction
├── missionTime
├── operatingConditions
├── failureCriterion
├── objective
└── metadata
```

---

# 238. Failure Mode Contract

Conceptualmente:

```text
FailureMode
├── id
├── category
├── severity
├── detectability
├── effects
└── metadata
```

---

# 239. Failure Event Contract

Conceptualmente:

```text
FailureEvent
├── id
├── scope
├── mode
├── cause
├── effect
├── detectedAt
├── contained
└── metadata
```

---

# 240. Reliability Measurement

Conceptualmente:

```text
ReliabilityMeasurement
├── scope
├── exposure
├── failures
├── failureRate
├── failureProbability
├── failureFreeInterval
└── measuredAt
```

---

# 241. Reliability Baseline Contract

Conceptualmente:

```text
ReliabilityBaseline
├── version
├── environment
├── workload
├── missionTime
├── exposure
├── failureRate
├── failureModes
└── recordedAt
```

---

# 242. Reliability Comparison

Conceptualmente:

```text
ReliabilityComparison
├── baseline
├── candidate
├── failureRateDelta
├── newFailureModes
├── recurrences
├── regressions
└── improvements
```

---

# 243. Reliability Policy

Conceptualmente:

```text
ReliabilityPolicy
├── requirements
├── failureClassification
├── containment
├── recurrence
├── gate
└── metadata
```

---

# 244. Reliability Gate

Conceptualmente:

```text
ReliabilityGate
├── requirement
├── baseline
├── exposure
├── threshold
└── evaluate
```

---

# 245. Reliability Snapshot

Conceptualmente:

```text
ReliabilitySnapshot
├── state
├── measuredAt
├── failureRate
├── failureFreeInterval
├── recurringFailures
├── escapedDefects
├── activeFailureModes
└── baselineComparison
```

---

# 246. Reliability Runtime

Conceptualmente:

```text
ReliabilityRuntime
├── recordFailure
├── measure
├── baseline
├── compare
├── recurrence
├── evaluate
└── diagnose
```

---

# 247. Reliability State Machine

Conceptualmente:

```text
UNKNOWN
   │
   ▼
RELIABLE
   │
   ├──► DEGRADED
   │        │
   │        ▼
   └────► UNRELIABLE

RELIABLE / DEGRADED
        │
        ▼
    REGRESSION
```

---

# 248. Recovery from Regression

No deberá declararse hasta que nueva Exposure demuestre mejora suficiente.

---

# 249. Reliability Ownership

Todo Reliability Requirement deberá poseer Owner.

---

# 250. Owner Responsibility

Incluye:

```text
failure criterion
mission time
failure taxonomy
failure review
recurrence review
baseline
reliability gates
```

---

# 251. Reliability Review

Deberá realizarse ante:

```text
major release
architecture change
dependency change
new failure mode
recurrent incident
data corruption
significant reliability regression
```

---

# 252. First Implementation Components

La primera implementación deberá incluir:

```text
ReliabilityState

ReliabilityRequirement

FailureMode
FailureEvent
FailureClassification

ReliabilityMeasurement
ReliabilityBaseline
ReliabilityComparison

ReliabilityPolicy
ReliabilityGate

ReliabilityRuntime
ReliabilityRegistry

ReliabilityError
```

---

# 253. Optional Initial Components

Podrán incorporarse:

```text
FailureRegistry
RecurrenceAnalyzer

FaultInjector
ReliabilityExperiment

ReliabilityDiagnostics
ReliabilitySnapshot
```

---

# 254. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Failure Correlation
Probabilistic Reliability Modeling
Reliability Block Model Engine
Predictive Failure Detection
Automated Chaos Engineering
AI-Assisted Reliability Analysis
```

---

# 255. Estructura Conceptual de Directorios

```text
src/
└── Reliability/
    ├── State/
    │   └── ReliabilityState
    │
    ├── Requirement/
    │   └── ReliabilityRequirement
    │
    ├── Failure/
    │   ├── FailureMode
    │   ├── FailureEvent
    │   └── FailureClassification
    │
    ├── Measurement/
    │   └── ReliabilityMeasurement
    │
    ├── Baseline/
    │   └── ReliabilityBaseline
    │
    ├── Comparison/
    │   └── ReliabilityComparison
    │
    ├── Policy/
    │   └── ReliabilityPolicy
    │
    ├── Gate/
    │   └── ReliabilityGate
    │
    ├── Registry/
    │   ├── ReliabilityRegistry
    │   └── FailureRegistry
    │
    ├── Recurrence/
    │   └── RecurrenceAnalyzer
    │
    ├── Injection/
    │   ├── FaultInjector
    │   └── ReliabilityExperiment
    │
    ├── Runtime/
    │   └── ReliabilityRuntime
    │
    ├── Snapshot/
    │   └── ReliabilitySnapshot
    │
    ├── Diagnostics/
    │   └── ReliabilityDiagnostics
    │
    └── Error/
        └── ReliabilityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 256. Error Namespace

ENG-074 utilizará:

```text
MEF-RELIABILITY-xxx
```

---

# 257. Taxonomía ENG-074

```text
MEF-RELIABILITY-001 Reliability requirement invalid
MEF-RELIABILITY-002 Reliability objective invalid
MEF-RELIABILITY-003 Reliability mission time invalid
MEF-RELIABILITY-004 Reliability failure criterion invalid
MEF-RELIABILITY-005 Reliability failure mode invalid
MEF-RELIABILITY-006 Reliability failure event invalid
MEF-RELIABILITY-007 Reliability measurement invalid
MEF-RELIABILITY-008 Reliability exposure insufficient
MEF-RELIABILITY-009 Reliability failure rate exceeded
MEF-RELIABILITY-010 Reliability failure probability exceeded
MEF-RELIABILITY-011 Reliability degraded
MEF-RELIABILITY-012 Reliability requirement violated
MEF-RELIABILITY-013 Reliability regression detected
MEF-RELIABILITY-014 Reliability recurring failure detected
MEF-RELIABILITY-015 Reliability defect escape detected
MEF-RELIABILITY-016 Reliability fault detection failed
MEF-RELIABILITY-017 Reliability fault isolation failed
MEF-RELIABILITY-018 Reliability containment failed
MEF-RELIABILITY-019 Reliability error correction failed
MEF-RELIABILITY-020 Reliability cascading failure detected
MEF-RELIABILITY-021 Reliability common-mode failure detected
MEF-RELIABILITY-022 Reliability state corruption detected
MEF-RELIABILITY-023 Reliability fault injection failed
MEF-RELIABILITY-024 Reliability gate failed
MEF-RELIABILITY-025 Reliability gate override denied
MEF-RELIABILITY-026 Reliability tenant violation
MEF-RELIABILITY-027 Reliability test unauthorized
MEF-RELIABILITY-028 Reliability security violation
MEF-RELIABILITY-029 Reliability state unknown
MEF-RELIABILITY-030 Reliability invariant violation
```

---

# 258. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Reliability Requirements
Explicit Mission Time
Explicit Failure Criteria

Fault / Error / Failure distinction

Failure Modes
Failure Events
Failure Classification

Failure Rate
Failure-Free Interval

Reliability Baselines
Reliability Comparison
Reliability Regression

Fault Detection
Fault Isolation
Fault Containment

Failure Propagation Awareness
Common-Mode Failure Awareness

Failure Recurrence
Defect Escape

Security
Audit
Observability
Testing
```

---

# 259. First Version Non-Goals

No deberá requerir:

```text
Probabilistic Reliability Engine
Automatic Failure Correlation
Predictive Failure Detection
Automated Chaos Platform
Reliability Block Model Solver
AI-Assisted Reliability Engineering
```

---

# 260. Second Phase

Podrá incorporar:

```text
Failure Registry
Recurrence Analyzer

Reliability Gates

Controlled Fault Injection
Reliability Experiments

Failure Distribution Analysis
Reliability Growth Analysis
```

---

# 261. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Failure Correlation
Probabilistic Reliability Modeling
Reliability Block Modeling
Predictive Failure Detection
Automated Chaos Engineering
AI-Assisted Reliability Analysis
```

---

# 262. Invariantes de Ingeniería

ENG-074 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1426 | Todo Reliability Requirement contractual deberá declarar Scope, Required Function, Mission Time, Operating Conditions, Failure Criterion, Objective y Measurement Method suficientes para ser verificable. |
| EI-1427 | Reliability deberá permanecer diferenciada de Availability, Health, Resilience, Durability, Correctness y Redundancy y ninguna de estas propiedades deberá utilizarse como prueba automática de Reliability. |
| EI-1428 | Defect, Fault, Error y Failure deberán conservar semánticas diferenciadas y un Fault o Error contenido antes de violar la función contractual no deberá registrarse automáticamente como Service Failure. |
| EI-1429 | Failure Criteria deberán incluir resultados incorrectos, corrupción, pérdidas, duplicaciones prohibidas, terminaciones inesperadas y Deadline Violations cuando dichos comportamientos violen el Contract, aunque el Process continúe Alive. |
| EI-1430 | Failure Rate y Failure Probability deberán declarar Exposure, Units y Mission Time apropiados y valores medios como MTTF o MTBF no deberán utilizarse sin conocer sus supuestos y distribución subyacente. |
| EI-1431 | Reliability Assertions deberán considerar cantidad de Exposure; ausencia de Failures sobre muestras pequeñas no deberá utilizarse como evidencia suficiente de Reliability alta. |
| EI-1432 | Fault Detection, Isolation y Containment deberán minimizar Failure Propagation y el Failure de un Request, Tenant, Partition, Module, Plugin o Worker no deberá propagarse fuera de su Boundary sin necesidad arquitectónica. |
| EI-1433 | Fault Tolerance solo deberá declararse para Fault Models explícitos y ningún mecanismo deberá llamarse tolerante a fallos si únicamente ignora Errors o continúa produciendo resultados potencialmente incorrectos. |
| EI-1434 | Error Correction deberá utilizar Source of Truth o mecanismo verificable y ningún componente deberá inventar silenciosamente State supuestamente correcto para mantener operación aparente. |
| EI-1435 | Reliability Engineering deberá analizar Cascading Failures, Retry Amplification, Timeout Cascades, Shared Dependencies y Common-Mode Failures y la redundancia no deberá asumirse efectiva frente a Causes compartidas. |
| EI-1436 | Dependency Reliability deberá modelar Failures parciales tales como Slow, Stale, Corrupt, Inconsistent y Rate-Limited, no únicamente estados Up/Down. |
| EI-1437 | Reliability Regression deberá compararse contra Baseline, Workload, Mission Time y Exposure equivalentes y deberá mantenerse diferenciada de Availability Regression o Performance Regression. |
| EI-1438 | Failure Recurrence deberá correlacionarse con Failure Mode, Root Cause o Defect cuando sea posible y un Workaround no deberá marcarse como Permanent Fix sin evidencia suficiente. |
| EI-1439 | Defect Escape deberá observarse como señal de Reliability Engineering y Production Escapes críticos deberán alimentar Testing, Failure Prevention y Architecture Review. |
| EI-1440 | Stateful, Transactional, Messaging, Pipeline y Concurrent Components deberán tratar Data Corruption, Partial Commit, Message Loss, Forbidden Duplication, Incorrect Resume, Race, Deadlock y otros Contract Violations como Reliability Failures aunque no causen Outage total. |
| EI-1441 | Fault Injection y Reliability Experiments deberán poseer Hypothesis, Scope, Authorization, Safety Controls y Stop Conditions y no deberán utilizarse como destrucción aleatoria de Production. |
| EI-1442 | Reliability Security deberá impedir que Fault Tolerance, Fallback o Recovery omitan Security Controls y deberá proteger Failure Data, Fault Injection Interfaces y Topology Information. |
| EI-1443 | Reliability Audit y Observability deberán permitir determinar Failure Rate, Exposure, Failure Modes, Failure-Free Intervals, Recurrence, Escaped Defects, Containment Failures y Regression mediante datos de Cardinality controlada. |
| EI-1444 | Reliability Testing deberá cubrir Mission Operation, Fault Detection, Isolation, Propagation, Correction, Common-Mode Failures, Dependency Partial Failures, Intermittent/Permanent Faults, Retries, Concurrency, State Corruption, Messaging, Pipelines, Deployment, Recurrence, Security y Regression según Architecture. |
| EI-1445 | La primera implementación deberá priorizar Reliability Requirements, Mission Time, Failure Criteria, Fault/Error/Failure semantics, Failure Events, Failure Rates, Baselines, Regression, Fault Isolation, Propagation, Common-Mode Analysis, Recurrence y Defect Escape antes de introducir Probabilistic Modeling, Predictive Failure Detection o Automated Chaos Engineering. |

---

# 263. Continuidad de Invariantes

```text
ENG-070 → EI-1346 a EI-1365
ENG-071 → EI-1366 a EI-1385
ENG-072 → EI-1386 a EI-1405
ENG-073 → EI-1406 a EI-1425
ENG-074 → EI-1426 a EI-1445
```

---

# 264. Criterios de Conformidad

Una implementación será conforme con ENG-074 cuando:

- defina Reliability Requirements;
- declare Mission Time;
- declare Operating Conditions;
- declare Failure Criteria;
- diferencie Defect;
- diferencie Fault;
- diferencie Error;
- diferencie Failure;
- modele Failure Events;
- modele Failure Modes;
- clasifique Failure temporal;
- mida Exposure;
- mida Failure Rate;
- mida Failure-Free Intervals;
- mantenga Reliability Baselines;
- compare Candidate contra Baseline;
- detecte Reliability Regression;
- implemente Fault Detection;
- implemente Fault Isolation;
- implemente Fault Containment;
- controle Failure Propagation;
- analice Cascading Failure;
- analice Common-Mode Failure;
- modele Dependency Partial Failures;
- detecte Failure Recurrence;
- registre Defect Escape;
- preserve State Correctness;
- preserve Tenant Isolation;
- preserve Security;
- implemente Observability;
- implemente Reliability Testing.

---

# 265. Riesgos

Deberán evitarse especialmente:

```text
Reliability Equals Availability
Reliability Equals Uptime
Reliability Equals Redundancy

No Mission Time
No Failure Criterion

Defect Equals Failure
Fault Equals Failure
Error Equals Failure

Process Alive Means No Failure
Incorrect Result Ignored
Silent Corruption Ignored

MTBF Used Without Assumptions
Zero Failures With Tiny Exposure

Retry Equals Fault Tolerance
Retry Forever

Fault Tolerance Through Ignoring Errors
Correction Without Source of Truth

Global Failure From Local Fault
Cross-Tenant Failure Propagation

Shared Dependency Common-Mode Failure
Bad Release Defeats All Replicas

Slow Dependency Treated as Healthy
Corrupt Dependency Response Ignored

Reliability Regression Hidden by Fast Recovery

Recurring Failure Marked Fixed
Workaround Equals Permanent Fix

Random Chaos Without Hypothesis
Fault Injection Without Safety Controls
```

---

# 266. Relación con ENG-039

Resilience proporciona mecanismos para:

```text
retry
timeout
circuit breaker
bulkhead
fallback
recovery
```

Reliability evalúa si esos mecanismos reducen Failure y preservan Correctness.

---

# 267. Relación con ENG-069

Health describe:

```text
current operational condition
```

Reliability describe:

```text
failure behavior over exposure/time
```

---

# 268. Relación con ENG-073

Availability puede aproximarse conceptualmente mediante Failure y Recovery behavior, pero no deberá sustituirse con Reliability.

```text
Reliability
→ how often failures occur

Recovery
→ how long restoration takes

Availability
→ resulting service usability
```

---

# 269. Relación con ENG-070

Una Deadline Violation podrá clasificarse como Reliability Failure cuando el tiempo sea parte de la función requerida.

---

# 270. Relación con ENG-071

Capacity Exhaustion puede ser causa de Failure.

Reliability deberá identificarla como Failure Mode/Cause, no crear otro Capacity Manager.

---

# 271. Relación con ENG-072

Scaling puede introducir nuevos Failure Modes:

```text
coordination failure
hot partition
state transfer failure
rebalance failure
connection storm
```

---

# 272. Relación con ENG-075

**ENG-075 deberá formalizar Maintainability Engineering.**

La separación será:

```text
RELIABILITY
ENG-074
→ How consistently can the system
  perform its required function
  without failure?

MAINTAINABILITY
ENG-075
→ How efficiently and safely can
  the system be understood, diagnosed,
  changed, repaired and restored?
```

ENG-075 deberá cubrir:

```text
Maintainability
Maintainability Requirement
Maintainability Objective

Changeability
Modifiability
Analyzability
Diagnosability
Repairability

Maintainability Index

Change Scope
Change Impact
Change Risk

Mean Time To Diagnose
Mean Time To Repair
Mean Time To Restore

Diagnostic Coverage

Code Complexity
Cyclomatic Complexity
Cognitive Complexity

Coupling
Cohesion

Dependency Direction

Code Smell
Technical Debt

Refactoring
Refactoring Safety

Dead Code
Deprecated Code

Documentation Maintainability

Operational Maintainability

Repair Procedure
Runbook

Maintainability Baseline
Maintainability Regression

Maintainability Security
Maintainability Audit
Maintainability Observability
Maintainability Testing
```

---

# 273. Principio Rector

> **MEF deberá tratar Reliability como la capacidad demostrable de continuar produciendo resultados correctos durante una Mission definida. Mantener procesos encendidos, reiniciar rápidamente o duplicar infraestructura no bastará: los Failures deberán medirse, clasificarse, contenerse y correlacionarse con su Exposure, y cualquier mecanismo de tolerancia deberá preservar Correctness, State Integrity y Security.**

---

# 274. Conclusión

**ENG-074 — Reliability Engineering** formaliza el comportamiento de Failure de MEF.

La cadena fundamental queda:

```text
DEFECT
   │
   ▼
FAULT
   │
   ▼
ERROR
   │
 ┌─┴────────────┐
 ▼              ▼
DETECT /        PROPAGATE
CORRECT             │
 │                  ▼
 ▼               FAILURE
CONTINUE
```

La Mission queda:

```text
MISSION START
      │
      ▼
CORRECT OPERATION
      │
      │
      │ Failure-Free Interval
      │
      X
      │
      ▼
    FAILURE
```

La medición queda:

```text
FAILURES
   │
   ▼
────────────
EXPOSURE
   │
   ▼
FAILURE RATE
```

donde Exposure puede ser:

```text
time
requests
jobs
messages
transactions
```

según el sistema.

La diferencia con Availability queda:

```text
RELIABILITY
│
├── How often does it fail?
├── How long can it run failure-free?
└── What is probability of mission success?
        │
        ▼
RECOVERY BEHAVIOR
        │
        ▼
AVAILABILITY
│
└── How much required service time
    remains usable?
```

La contención queda:

```text
FAULT
  │
  ▼
REQUEST
  │
  X containment boundary
  │
  └──── should not become
        application-wide failure
```

El Common-Mode Failure queda:

```text
NODE A ─┐
NODE B ─┼──► SAME BAD RELEASE
NODE C ─┘
             │
             ▼
      all nodes fail
```

Por eso:

```text
Redundancy
≠
Reliability against every Fault
```

La regresión queda:

```text
VERSION A
1 failure / 10M operations
       │
       ▼
VERSION B
7 failures / 10M operations
       │
       ▼
RELIABILITY REGRESSION
```

aunque ambas versiones pudieran conservar un Availability similar mediante Recovery rápida.

La cadena reciente queda:

```text
PERFORMANCE
ENG-070
   │
   ▼
CAPACITY
ENG-071
   │
   ▼
SCALABILITY
ENG-072
   │
   ▼
AVAILABILITY
ENG-073
   │
   ▼
RELIABILITY
ENG-074
   │
   ▼
MAINTAINABILITY
ENG-075
```

La primera implementación deberá concentrarse en:

```text
ReliabilityState

ReliabilityRequirement

FailureMode
FailureEvent
FailureClassification

ReliabilityMeasurement
ReliabilityBaseline
ReliabilityComparison

ReliabilityPolicy
ReliabilityGate

ReliabilityRuntime
ReliabilityRegistry
ReliabilityError
```

con:

```text
Explicit Mission Time
Explicit Failure Criteria

Fault / Error / Failure Separation

Failure Modes
Failure Classification

Exposure
Failure Rate
Failure-Free Interval

Baselines
Regression Detection

Fault Detection
Fault Isolation
Fault Containment

Failure Propagation
Cascading Failure
Common-Mode Failure

Failure Recurrence
Defect Escape

Security
Audit
Observability
Testing
```

antes de introducir:

```text
Automatic Failure Correlation
Probabilistic Reliability Modeling
Reliability Block Model Engine
Predictive Failure Detection
Automated Chaos Engineering
AI-Assisted Reliability Analysis
```

Con **ENG-074**, la serie global alcanza:

```text
EI-1445
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
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
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-034 — Application Engineering
- ENG-036 — Validation Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-068 — Environment Engineering
- ENG-069 — Health & Readiness Engineering
- ENG-070 — Performance Engineering
- ENG-071 — Capacity Engineering
- ENG-072 — Scalability Engineering
- ENG-073 — Availability Engineering
- ENG-075 — Maintainability Engineering
```