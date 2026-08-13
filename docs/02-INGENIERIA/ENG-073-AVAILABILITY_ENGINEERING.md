---
id: ENG-073
titulo: Availability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Availability Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-012
  - ENG-016
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-034
  - ENG-038
  - ENG-039
  - ENG-041
  - ENG-043
  - ENG-048
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-057
  - ENG-061
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-070
  - ENG-071
  - ENG-072
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
  - ENG-020
  - ENG-021
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-036
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
  - ENG-056
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-074
keywords:
  - availability
  - availability-engineering
  - uptime
  - downtime
  - availability-objective
  - downtime-budget
  - redundancy
  - failover
  - failback
  - active-active
  - active-passive
  - failure-domain
  - spof
  - graceful-degradation
  - partial-availability
  - maintenance
  - dependency-availability
  - mef
---

# ENG-073

# Availability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Availability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-073 establece las reglas para:

```text
Availability

Availability Requirement
Availability Objective
Availability Target

Service Availability
Component Availability
Capability Availability

Uptime
Downtime

Availability Window
Measurement Period

Planned Downtime
Unplanned Downtime

Availability Budget
Downtime Budget

Availability State

Failure
Outage
Partial Outage
Degraded Availability

Failure Domain
Blast Radius

Redundancy

Active-Active
Active-Passive
N+1
N+M

Failover
Failback

Failover Trigger
Failover Time

Dependency Availability
Composite Availability

Single Point of Failure
SPOF Detection

Graceful Degradation
Partial Availability

Maintenance Availability

Availability Measurement
Availability Calculation

Availability Gate

Availability Security
Availability Audit
Availability Observability
Availability Testing
```

---

# 2. Declaración

> **Toda Availability gobernada por MEF deberá definirse respecto de un Service, Capability, Measurement Window y Success Criterion explícitos. La existencia de múltiples instancias no deberá interpretarse automáticamente como alta disponibilidad, y ningún diseño deberá declarar un Availability Objective sin analizar Failure Domains, Dependencies, Failover, Recovery, Capacity durante Failure y Single Points of Failure.**

Arquitectura conceptual:

```text
SERVICE
   │
   ▼
CAPABILITY
   │
   ▼
AVAILABLE?
   │
 ┌─┴───────────────┐
 ▼                 ▼
YES                NO
 │                  │
 ▼                  ▼
UPTIME           DOWNTIME
 │                  │
 └────────┬─────────┘
          ▼
 AVAILABILITY
          │
          ▼
COMPARE WITH OBJECTIVE
```

---

# 3. Availability Engineering

Responde:

```text
What must remain available?
For whom?
For how long?
What counts as unavailable?
What is the measurement window?
How much downtime is allowed?
Which failures can the system tolerate?
Which components are redundant?
Which dependencies are SPOFs?
How quickly can failover occur?
Can service continue partially?
Does maintenance count as downtime?
```

---

# 4. Availability

`Availability` representa la proporción del tiempo requerido durante la cual un Service o Capability puede proporcionar correctamente su función definida.

Conceptualmente:

```text
Availability
=
Available Time
/
Required Service Time
```

---

# 5. Availability ≠ Health

Health es un estado operacional observado.

Availability es una propiedad medida a lo largo de una ventana temporal.

---

# 6. Availability ≠ Reliability

Reliability responderá principalmente:

```text
How consistently does the system
operate without failure?
```

Availability responde:

```text
Is the service usable when required?
```

Un sistema puede fallar con relativa frecuencia pero recuperarse con rapidez y conservar Availability elevada.

---

# 7. Availability ≠ Resilience

Resilience gobierna cómo el sistema tolera y responde ante Failure.

Availability mide el resultado observable de esas capacidades.

---

# 8. Availability ≠ Redundancy

Redundancy es una técnica.

Availability es el resultado.

---

# 9. Availability ≠ Scalability

Muchas instancias pueden escalar Capacity sin eliminar un SPOF compartido.

---

# 10. Availability Requirement

Todo Requirement deberá declarar:

```text
service
capability
consumer scope
measurement window
success criterion
availability target
downtime semantics
```

---

# 11. Availability Requirement Example

```text
Service:
payments-api

Capability:
authorize-payment

Measurement Window:
calendar month

Availability Target:
99.95%

Success Criterion:
valid request receives
contractually valid response

Excluded Downtime:
none
```

---

# 12. Vague Requirement

No deberá utilizarse como Contract:

```text
highly available
always online
24/7
enterprise availability
never down
```

sin definición medible.

---

# 13. Availability Objective

Valor objetivo de Availability.

Ejemplos:

```text
99%
99.9%
99.95%
99.99%
```

---

# 14. Availability Target ≠ Architecture

Una cifra no define por sí misma cómo alcanzarla.

---

# 15. Service Availability

Evalúa servicio observable por Consumers.

---

# 16. Component Availability

Evalúa un componente individual.

---

# 17. Service ≠ Component Availability

Un componente puede fallar mientras el Service permanece disponible mediante redundancia.

---

# 18. Capability Availability

Podrá evaluarse por función.

Ejemplo:

```text
Application
├── read        AVAILABLE
├── write       UNAVAILABLE
└── reporting   DEGRADED
```

---

# 19. Partial Capability Availability

Deberá representarse explícitamente.

---

# 20. Availability Scope

Podrá ser:

```text
application
service
endpoint
operation
tenant
region
capability
dependency
```

---

# 21. Consumer Perspective

Cuando Availability sea contractual deberá favorecer perspectiva del Consumer.

---

# 22. Internal Uptime ≠ Service Availability

Un Process activo no implica que el servicio sea utilizable.

---

# 23. Uptime

Tiempo durante el cual el Scope cumple Success Criterion.

---

# 24. Downtime

Tiempo durante el cual no cumple dicho criterio.

---

# 25. Downtime Start

Deberá definir cuándo comienza medición.

---

# 26. Downtime End

Deberá definir cuándo termina.

---

# 27. Detection Delay

No deberá confundirse con duración real del Outage.

---

# 28. Recovery Detection

Deberá evitar declarar Recovery antes de que Service sea realmente utilizable.

---

# 29. Availability Window

Periodo sobre el que se calcula Availability.

Ejemplos:

```text
rolling 30 days
calendar month
quarter
year
business hours
24x7
```

---

# 30. Window Semantics

Deberán ser explícitas.

---

# 31. Availability Calculation

Conceptualmente:

```text
Availability =
(Total Required Time - Downtime)
/
Total Required Time
```

---

# 32. Downtime Budget

Cantidad de indisponibilidad permitida por Objective.

---

# 33. Downtime Budget Example

Para un periodo aproximado de 30 días:

```text
99.9%
≈ 43.2 minutes downtime

99.99%
≈ 4.32 minutes downtime
```

El cálculo contractual deberá utilizar la ventana exacta definida.

---

# 34. Downtime Budget ≠ Error Budget Universally

Podrán relacionarse, pero no deberán asumirse idénticos si sus métricas difieren.

---

# 35. Availability Budget Consumption

Deberá ser observable.

---

# 36. Budget Exhaustion

Podrá producir:

```text
release restrictions
risk review
reliability work
capacity review
manual intervention
```

según Policy.

---

# 37. Planned Downtime

Indisponibilidad causada por actividad programada.

---

# 38. Unplanned Downtime

Indisponibilidad no planificada.

---

# 39. Planned Downtime Exclusion

Solo deberá excluirse si Contract lo establece explícitamente.

---

# 40. Maintenance Window

No implica automáticamente que Downtime no cuente.

---

# 41. Scheduled Maintenance Availability

Podrá requerir que Service permanezca disponible mediante Rolling Maintenance.

---

# 42. Outage

Periodo de pérdida total o suficiente de Capability para violar Success Criterion.

---

# 43. Partial Outage

Solo parte de:

```text
traffic
tenants
regions
capabilities
operations
```

queda afectada.

---

# 44. Partial Outage Accounting

No deberá clasificarse automáticamente como:

```text
100% available
```

o:

```text
100% unavailable
```

sin Policy.

---

# 45. Weighted Availability

Podrá utilizar ponderación por:

```text
requests
users
tenants
regions
transactions
```

si el Contract lo define.

---

# 46. Weighting Transparency

La fórmula deberá documentarse.

---

# 47. Availability State

El modelo podrá incluir:

```text
AVAILABLE
DEGRADED
PARTIALLY_AVAILABLE
UNAVAILABLE
UNKNOWN
```

---

# 48. AVAILABLE

El Success Criterion contractual se satisface.

---

# 49. DEGRADED

Service continúa disponible con capacidad o calidad reducida.

---

# 50. PARTIALLY_AVAILABLE

Un subconjunto definido permanece utilizable.

---

# 51. UNAVAILABLE

Capability requerida no puede proporcionarse.

---

# 52. UNKNOWN

No existe evidencia suficiente.

---

# 53. UNKNOWN ≠ AVAILABLE

Ausencia de medición no deberá considerarse Uptime.

---

# 54. Failure

Evento que impide a un componente cumplir su función esperada.

---

# 55. Failure ≠ Outage

Un Failure interno puede ser completamente absorbido.

```text
node failure
    │
    ▼
failover
    │
    ▼
service remains available
```

---

# 56. Fault

Condición que puede producir Failure.

---

# 57. Failure Propagation

Deberá analizarse.

---

# 58. Failure Domain

Conjunto de componentes que pueden fallar conjuntamente.

Ejemplos:

```text
process
host
rack
zone
region
cluster
database
identity provider
network provider
```

---

# 59. Independent Replicas

No deberán declararse independientes si comparten el mismo Failure Domain crítico.

---

# 60. Failure Domain Diversity

La redundancia deberá distribuirse entre Domains relevantes.

---

# 61. Blast Radius

Conjunto máximo esperado de Consumers/Capabilities afectados por Failure.

---

# 62. Blast Radius Reduction

Podrá lograrse mediante:

```text
partitioning
cells
bulkheads
regional isolation
tenant isolation
dependency isolation
```

---

# 63. Single Point of Failure

Un `SPOF` es un componente o dependencia cuyo Failure individual puede causar pérdida del Service requerido.

---

# 64. SPOF Examples

```text
single database
single load balancer
single DNS dependency
single credential authority
single storage system
single coordinator
single network path
single configuration source
```

---

# 65. SPOF Detection

Deberá formar parte del análisis de Availability.

---

# 66. Logical SPOF

Puede existir aunque haya múltiples servidores.

Ejemplo:

```text
10 API nodes
       │
       ▼
single database
```

---

# 67. Control Plane SPOF

Deberá considerarse cuando su Failure afecte Data Plane.

---

# 68. Deployment SPOF

Una mala Release global puede eliminar Availability aunque Infrastructure tenga redundancia.

---

# 69. Redundancy

Introduce múltiples medios para proporcionar una Capability.

---

# 70. Redundancy Types

Podrán incluir:

```text
instance redundancy
zone redundancy
region redundancy
dependency redundancy
network redundancy
storage redundancy
```

---

# 71. Redundancy ≠ Independence

Replicas que comparten misma causa de Failure pueden fallar juntas.

---

# 72. Common-Mode Failure

Deberá analizarse.

Ejemplos:

```text
same bad deployment
same configuration
same secret
same provider
same schema migration
same dependency
```

---

# 73. Redundancy Factor

No deberá utilizarse aislado para inferir Availability.

---

# 74. Active-Active

Dos o más Units sirven trabajo simultáneamente.

---

# 75. Active-Active Requirements

Deberá considerar:

```text
routing
state
consistency
capacity
conflict handling
failure isolation
```

---

# 76. Active-Passive

Un conjunto atiende trabajo y otro espera Failover.

---

# 77. Passive Readiness

Standby deberá poder asumir trabajo dentro del Recovery Time requerido.

---

# 78. Cold Standby

Puede necesitar Provisioning/Startup antes de servir.

---

# 79. Warm Standby

Mantiene parte de recursos preparados.

---

# 80. Hot Standby

Mantiene estado cercano a Active.

---

# 81. Standby Capacity

Deberá ser suficiente para Workload esperada después del Failover.

---

# 82. N+1

Puede tolerar pérdida de una Unit si N Units restantes o disponibles sostienen la carga.

---

# 83. N+M

Mantiene M Units adicionales según Failure Model.

---

# 84. N+1 ≠ Zone Resilience Automatically

Las Units pueden compartir Zone.

---

# 85. Failover

Transfiere trabajo desde componente o Domain fallido hacia alternativa.

---

# 86. Failover Trigger

Deberá ser explícito.

Podrá basarse en:

```text
health
readiness
lease loss
connection failure
operator action
provider signal
```

---

# 87. Automatic Failover

Deberá poseer suficientes señales para evitar Failover innecesario.

---

# 88. False Positive Failover

Puede producir Outage por sí mismo.

---

# 89. Failover Time

Tiempo entre Failure efectivo y restauración del Service.

---

# 90. Failover Time Components

Podrán incluir:

```text
detection
decision
promotion
routing
warm-up
state recovery
readiness
```

---

# 91. Failover Objective

Deberá alinearse con Availability Objective.

---

# 92. Failover Capacity

ENG-071 deberá validar que Target sostenga Load.

---

# 93. Failover Without Capacity

No constituye Availability efectiva.

---

# 94. Failover State

Deberá preservar Correctness.

---

# 95. Stateful Failover

Deberá considerar:

```text
replication
consistency
durability
split brain
fencing
state freshness
```

---

# 96. Failback

Retorna servicio hacia ubicación o componente preferido.

---

# 97. Failback ≠ Failover Reversed Automatically

Podrá requerir:

```text
state synchronization
capacity validation
routing
drain
verification
```

---

# 98. Failback Risk

No deberá ejecutarse automáticamente sin necesidad cuando pueda introducir nuevo Outage.

---

# 99. Failover Oscillation

Deberá evitarse.

---

# 100. Failover Hysteresis

Podrá requerirse.

---

# 101. Split Brain

Dos componentes creen poseer Authority simultáneamente.

---

# 102. Split-Brain Prevention

Deberá utilizar mecanismos como:

```text
lease
quorum
fencing
single-writer authority
```

según Architecture.

---

# 103. Quorum

Podrá mejorar Failure handling pero introduce Capacity/Latency trade-offs.

---

# 104. Dependency Availability

Availability del Service depende de Dependencies requeridas.

---

# 105. Critical Dependency

Puede limitar Service Availability.

---

# 106. Optional Dependency

Su pérdida podrá producir DEGRADED sin Outage total.

---

# 107. Dependency Chain

Ejemplo:

```text
API
 │
 ▼
Database
 │
 ▼
Identity
 │
 ▼
Network
```

---

# 108. Serial Dependency Availability

En una cadena estrictamente necesaria, cada dependencia puede reducir Availability end-to-end.

---

# 109. Composite Availability

No deberá calcularse con fórmulas simples si las fallas no son independientes.

---

# 110. Correlated Failures

Deberán considerarse.

---

# 111. Shared Dependency

Puede correlacionar Availability de múltiples Services.

---

# 112. Third-Party Dependency

Deberá poseer Failure Strategy.

---

# 113. Dependency SLO ≠ Own SLO Guarantee

La Availability de terceros limita pero no define por sí sola la del Service.

---

# 114. Multiple Providers

Podrán mejorar Availability cuando exista independencia real y Failover funcional.

---

# 115. Provider Diversity

Puede reducir Common-Mode Failure, pero aumenta complejidad.

---

# 116. Graceful Degradation

Permite preservar parte de Capability cuando otra falla.

---

# 117. Graceful Degradation Example

```text
Recommendation Service unavailable
        │
        ▼
Core checkout remains available
```

---

# 118. Degraded Mode

Deberá poseer Contract explícito.

---

# 119. Silent Incorrectness

No deberá utilizarse como degradación.

---

# 120. Fallback

Deberá preservar Correctness mínima requerida.

---

# 121. Stale Data Fallback

Solo deberá utilizarse cuando Semantics lo permitan.

---

# 122. Read-Only Mode

Podrá mantener disponibilidad parcial.

---

# 123. Write Degradation

No deberá reportarse como disponibilidad total si Writes son Capability contractual.

---

# 124. Feature Shedding

Features no críticas podrán deshabilitarse para preservar Core Service.

---

# 125. Load Shedding

Puede preservar Availability para Workloads prioritarias.

---

# 126. Admission Control

Puede rechazar trabajo antes de saturación catastrófica.

---

# 127. Partial Availability Policy

Deberá definir qué Capabilities y Consumers se priorizan.

---

# 128. Multi-Tenant Availability

ENG-048 deberá preservar aislamiento.

---

# 129. Tenant Failure Isolation

Un Tenant defectuoso no deberá derribar a los demás.

---

# 130. Tenant-Level Availability

Podrá medirse independientemente cuando exista Contract.

---

# 131. Noisy Neighbor

Puede provocar Availability Failure indirecto mediante Capacity Exhaustion.

---

# 132. Regional Availability

Podrá medirse por Region.

---

# 133. Global Availability

No deberá ocultar Outage regional significativo mediante promedio global sin Policy explícita.

---

# 134. Zone Availability

Deberá considerar Failure Domains reales.

---

# 135. Geographic Redundancy

Podrá aumentar Availability ante Failure regional.

---

# 136. Cross-Region Dependency

Puede convertirse en SPOF.

---

# 137. Data Locality

Puede limitar Failover regional.

---

# 138. Maintenance Availability

Mantenimiento deberá diseñarse conforme Objective.

---

# 139. Rolling Maintenance

Podrá mantener Service Available.

---

# 140. Maintenance Capacity

ENG-071 deberá garantizar carga con Units temporalmente fuera.

---

# 141. Maintenance Drain

ENG-055 y ENG-069 deberán retirar Readiness antes de detener Units.

---

# 142. Deployment Availability

ENG-067 deberá preservar disponibilidad según Strategy.

---

# 143. Recreate Deployment

Podrá implicar Downtime.

---

# 144. Rolling Deployment

Podrá mantener Availability si:

```text
minimum ready capacity
compatibility
health gates
drain
```

se preservan.

---

# 145. Blue-Green Availability

Requiere suficiente Capacity y compatibilidad de State.

---

# 146. Canary Availability

Reduce Blast Radius de una Release defectuosa.

---

# 147. Upgrade Availability

ENG-066 deberá contemplar Mixed-Version Availability.

---

# 148. Migration Availability

ENG-065 deberá distinguir Online y Offline Migrations.

---

# 149. Configuration Availability

ENG-049 no deberá convertir una Configuration Source en SPOF innecesario.

---

# 150. Secret Provider Availability

Deberá analizarse.

---

# 151. Cache Availability

Cache Failure podrá ser:

```text
degraded
partial
critical
```

según Architecture.

---

# 152. Database Availability

Deberá considerar:

```text
replication
failover
quorum
connections
storage
backup/recovery
```

---

# 153. Messaging Availability

Deberá considerar:

```text
broker
partitions
replication
producer behavior
consumer behavior
buffering
```

---

# 154. API Availability

Deberá medirse por operación/capability cuando sea relevante.

---

# 155. Background Job Availability

Puede expresarse como capacidad de completar trabajo dentro de ventana requerida, no necesariamente disponibilidad HTTP.

---

# 156. Availability Measurement

Deberá basarse en señales que representen Service real.

---

# 157. Measurement Sources

Podrán incluir:

```text
synthetic probes
real request success
external monitoring
transaction completion
consumer-visible errors
```

---

# 158. Internal Metrics Only

No deberán utilizarse como única evidencia si no representan Consumer Experience.

---

# 159. Synthetic Availability Probe

Deberá comprobar Capability suficientemente representativa.

---

# 160. Probe Side Effects

Deberán ser controlados.

---

# 161. Probe Location

Podrá afectar resultados.

---

# 162. Multi-Point Measurement

Podrá ser necesario para servicios geográficamente distribuidos.

---

# 163. Success Criterion

Deberá distinguir:

```text
response received
valid response
correct status
within required latency
```

según Contract.

---

# 164. Slow Success

Podrá considerarse unavailable si excede límite contractual de utilidad.

---

# 165. Availability and Performance

ENG-070 podrá aportar Latency Threshold.

---

# 166. Availability and Health

ENG-069 aporta estado actual.

No reemplaza medición histórica de Availability.

---

# 167. Availability Snapshot

Podrá representar estado actual estimado.

---

# 168. Availability Measurement Record

Conceptualmente:

```text
AvailabilityMeasurement
├── scope
├── window
├── requiredTime
├── availableTime
├── downtime
├── partialDowntime
├── availability
└── observedAt
```

---

# 169. Availability Event

Podrá representar:

```text
outage start
outage end
partial outage
degradation
failover
failback
maintenance
```

---

# 170. Outage Identity

Outages relevantes deberán poseer ID estable.

---

# 171. Outage Correlation

Múltiples síntomas derivados de misma causa no deberán necesariamente contarse como incidentes independientes.

---

# 172. Overlapping Outages

No deberán duplicar Downtime del mismo Scope.

---

# 173. Availability Budget

Conceptualmente:

```text
AvailabilityBudget
├── objective
├── measurementWindow
├── allowedDowntime
├── consumedDowntime
└── remainingDowntime
```

---

# 174. Budget Reset

Deberá seguir Window Semantics.

---

# 175. Rolling Window

Deberá recalcular correctamente al avanzar el tiempo.

---

# 176. Availability Gate

Podrá utilizarse para:

```text
release
deployment
maintenance
capacity reduction
architecture change
```

---

# 177. Gate Inputs

Podrán incluir:

```text
remaining downtime budget
current availability
active outage
failover health
redundancy state
capacity
```

---

# 178. Availability Gate Override

Deberá requerir Authority y Audit.

---

# 179. Availability State Machine

Conceptualmente:

```text
UNKNOWN
   │
   ▼
AVAILABLE
   │
   ├──► DEGRADED
   │       │
   │       ▼
   ├──► PARTIALLY_AVAILABLE
   │       │
   │       ▼
   └──► UNAVAILABLE
```

---

# 180. Recovery Transition

No deberá declararse AVAILABLE hasta Verification.

---

# 181. Availability Recovery

Podrá requerir:

```text
failover
dependency recovery
capacity restoration
routing restoration
state recovery
verification
```

---

# 182. Recovery ≠ Root Cause Fixed

Service puede recuperar Availability mediante Workaround.

---

# 183. Failback After Recovery

Deberá tratarse como operación separada.

---

# 184. Availability Security

ENG-024 gobernará controles generales.

---

# 185. Security Control Availability

Servicios críticos como:

```text
authentication
authorization
key management
secret provider
certificate validation
```

deberán incluirse en Failure Analysis.

---

# 186. Fail Open

No deberá utilizarse para aumentar Availability cuando viole Security.

---

# 187. Fail Closed

Puede reducir Availability y deberá considerarse en Objective.

---

# 188. Availability vs Security Trade-Off

No deberá resolverse degradando controles críticos silenciosamente.

---

# 189. DoS

Puede convertirse en Availability Failure.

---

# 190. Resource Exhaustion Protection

Deberá coordinarse con ENG-054 y ENG-071.

---

# 191. Dependency Amplification

Retry Storms pueden convertir Failure parcial en Outage.

---

# 192. Availability Information Exposure

Topología de redundancia y Failure Domains no deberá exponerse innecesariamente.

---

# 193. Availability Audit

Cambios críticos deberán ser auditables.

---

# 194. Audit Events

Podrán incluir:

```text
availability objective changed
downtime classification changed
planned downtime approved
failover initiated
failback initiated
redundancy reduced
availability gate overridden
```

---

# 195. Availability Observability

ENG-025 gobernará Telemetry.

---

# 196. Metrics

Podrán incluir:

```text
mef.availability.status
mef.availability.ratio
mef.availability.downtime
mef.availability.budget.remaining
mef.availability.outage.total
mef.availability.partial_outage.total
mef.availability.failover.total
mef.availability.failover.duration
```

---

# 197. Availability Labels

Podrán incluir:

```text
scopeType
capability
regionClass
result
```

con Cardinality controlada.

---

# 198. Outage ID as Metric Label

Deberá evitarse por Cardinality.

---

# 199. Availability Logs

Deberán favorecer transiciones:

```text
AVAILABLE → DEGRADED
DEGRADED → UNAVAILABLE
UNAVAILABLE → AVAILABLE
```

---

# 200. Availability Diagnostics

Deberá poder responder:

```text
what is current availability?
what is availability over the window?
how much downtime budget remains?
which capability is unavailable?
which dependency is responsible?
which failure domain is affected?
is failover active?
is redundancy degraded?
which SPOFs exist?
```

---

# 201. SPOF Inventory

Deberá poder mantenerse para componentes críticos.

---

# 202. Availability Dependency Graph

Conceptualmente:

```text
SERVICE
 ├── API
 │    ├── Database
 │    └── Identity
 ├── Broker
 └── DNS
```

---

# 203. Failure Domain Graph

Podrá representar qué componentes comparten:

```text
host
zone
region
provider
network
storage
```

---

# 204. Common-Mode Analysis

Deberá detectar dependencias compartidas que invaliden independencia supuesta.

---

# 205. Testing

ENG-009 gobernará Testing.

---

# 206. Availability Objective Test

Deberá comprobar fórmula y Window.

---

# 207. Measurement Test

Deberá comprobar Success Criterion.

---

# 208. Planned Downtime Test

Deberá validar inclusión/exclusión según Contract.

---

# 209. Partial Outage Test

Deberá comprobar Accounting correcto.

---

# 210. SPOF Test

Deberá retirar componente identificado.

---

# 211. Node Failure Test

Service deberá conservar Availability cuando Architecture lo prometa.

---

# 212. Zone Failure Test

Deberá probarse cuando exista Zone Resilience contractual.

---

# 213. Dependency Failure Test

Deberá comprobar:

```text
critical
required
optional
```

---

# 214. Active-Active Test

Deberá comprobar distribución y Failure de un Active.

---

# 215. Active-Passive Test

Deberá comprobar:

```text
standby readiness
promotion
routing
capacity
```

---

# 216. Failover Test

Deberá medir:

```text
detection
decision
promotion
routing
recovery
total failover time
```

---

# 217. Failback Test

Deberá comprobar State Synchronization y Drain.

---

# 218. Split-Brain Test

Deberá comprobar Fencing/Authority.

---

# 219. Common-Mode Failure Test

Deberá simular Dependency compartida.

---

# 220. Graceful Degradation Test

Deberá comprobar preservación de Core Capability.

---

# 221. Read-Only Degradation Test

Deberá comprobar Availability Accounting.

---

# 222. Maintenance Test

Deberá comprobar disponibilidad durante Maintenance prometida.

---

# 223. Capacity-Under-Failure Test

Deberá verificar que Failover Target sostenga Load.

---

# 224. Deployment Failure Test

Deberá comprobar Blast Radius de Release defectuosa.

---

# 225. Security Availability Test

Deberá comprobar que Failover no omita Security Controls.

---

# 226. DoS Availability Test

Deberá ejecutarse solo de forma autorizada.

---

# 227. Recovery Verification Test

Service no deberá declararse Available antes de cumplir Success Criterion nuevamente.

---

# 228. Architecture Test

Podrá impedir:

```text
high availability claim without objective
redundancy claim without failure-domain analysis
multiple instances interpreted as HA
single database hidden as SPOF
failover without capacity validation
fail-open security fallback
planned downtime silently excluded
availability measured only by process uptime
```

---

# 229. Build Integration

ENG-012 podrá validar estáticamente:

```text
availability requirement definitions
measurement windows
availability targets
dependency criticality
redundancy declarations
failover policy
SPOF declarations
```

---

# 230. Availability Tests in CI

Pruebas de Failure Domain amplias podrán ejecutarse en:

```text
integration environment
release candidate pipeline
scheduled resilience pipeline
preproduction environment
```

en lugar de cada Commit.

---

# 231. CLI

ENG-007 podrá proporcionar:

```text
mef availability
mef availability:requirements
mef availability:budget
mef availability:dependencies
mef availability:spof
mef availability:failover
mef availability:history
mef availability:test
mef availability:diagnose
```

---

# 232. `mef availability`

Podrá mostrar:

```text
state
current ratio
objective
window
budget remaining
```

---

# 233. `availability:requirements`

Podrá mostrar:

```text
service
capability
objective
window
success criterion
```

---

# 234. `availability:budget`

Podrá mostrar:

```text
allowed downtime
consumed downtime
remaining downtime
window
```

---

# 235. `availability:dependencies`

Podrá mostrar:

```text
dependency
criticality
availability
redundancy
failure domain
```

---

# 236. `availability:spof`

Podrá mostrar SPOFs conocidos.

---

# 237. `availability:failover`

Podrá mostrar:

```text
active target
standby
failover state
last failover
failover time
```

---

# 238. `availability:history`

Podrá mostrar Outages y degradaciones.

---

# 239. `availability:test`

Podrá ejecutar Failure Scenario autorizado.

---

# 240. `availability:diagnose`

Podrá mostrar:

```text
scope
objective
window
availability
downtime
budget
current state
dependencies
failure domains
redundancy
SPOFs
failover
last outage
```

---

# 241. Registry Integration

ENG-020 podrá registrar:

```text
AvailabilityRequirement
AvailabilityPolicy
AvailabilityMeasurement
AvailabilityBudget
FailoverPolicy
AvailabilityGate
```

---

# 242. Availability Requirement Contract

Conceptualmente:

```text
AvailabilityRequirement
├── id
├── scope
├── capability
├── objective
├── window
├── successCriterion
├── downtimePolicy
└── metadata
```

---

# 243. Availability Measurement Contract

Conceptualmente:

```text
AvailabilityMeasurement
├── scope
├── start
├── end
├── requiredTime
├── availableTime
├── downtime
├── partialDowntime
├── ratio
└── metadata
```

---

# 244. Availability Budget Contract

Conceptualmente:

```text
AvailabilityBudget
├── objective
├── window
├── allowedDowntime
├── consumedDowntime
├── remainingDowntime
└── state
```

---

# 245. Failure Domain Contract

Conceptualmente:

```text
FailureDomain
├── id
├── type
├── members
├── parent
└── metadata
```

---

# 246. Availability Dependency

Conceptualmente:

```text
AvailabilityDependency
├── id
├── criticality
├── redundancy
├── failureDomains
├── fallback
└── metadata
```

---

# 247. Failover Policy

Conceptualmente:

```text
FailoverPolicy
├── trigger
├── source
├── target
├── timeout
├── capacityRequirement
├── fencing
├── verification
└── failbackPolicy
```

---

# 248. Availability Snapshot

Conceptualmente:

```text
AvailabilitySnapshot
├── state
├── measuredAt
├── objective
├── currentAvailability
├── budgetRemaining
├── activeFailures
├── redundancyState
└── failoverState
```

---

# 249. Availability Runtime

Conceptualmente:

```text
AvailabilityRuntime
├── measure
├── state
├── budget
├── dependencies
├── spof
├── failover
├── verify
└── diagnose
```

---

# 250. Availability Policy

Podrá definir:

```text
availability objective
measurement method
partial outage accounting
planned downtime policy
degraded behavior
failover policy
budget actions
```

---

# 251. Availability Registry

Podrá mantener:

```text
requirements
policies
dependencies
failure domains
budgets
gates
```

---

# 252. Availability Ownership

Todo Requirement deberá poseer Owner.

---

# 253. Owner Responsibility

Incluye:

```text
objective
measurement
dependency inventory
failure analysis
SPOF review
downtime policy
failover validation
```

---

# 254. Availability Review

Deberá realizarse ante:

```text
architecture change
dependency change
new region
database change
deployment strategy change
major release
availability objective change
```

---

# 255. Bootstrap

Availability Runtime podrá utilizar Health, Environment y Dependency metadata después del Bootstrap básico.

---

# 256. Runtime Readiness

Availability actual no deberá utilizarse como único criterio de Readiness local.

---

# 257. Current Outage

Podrá influir en Routing o Admission Control según Policy.

---

# 258. Environment Integration

ENG-068 proporciona:

```text
regions
zones
dependencies
failure domains
resources
```

---

# 259. Health Integration

ENG-069 proporciona señales actuales para:

```text
failover
degraded state
recovery verification
```

---

# 260. Performance Integration

ENG-070 podrá definir cuándo una respuesta excesivamente lenta deja de ser usable.

---

# 261. Capacity Integration

ENG-071 deberá validar:

```text
failover capacity
maintenance capacity
redundancy capacity
```

---

# 262. Scalability Integration

ENG-072 deberá asegurar que aumento de replicas no se confunda con eliminación de SPOFs.

---

# 263. Resilience Integration

ENG-039 proporciona mecanismos:

```text
retry
timeout
circuit breaker
bulkhead
fallback
```

que pueden mejorar o empeorar Availability según su configuración.

---

# 264. Lifecycle Integration

ENG-055 deberá permitir:

```text
drain
stop
restart
recover
```

sin producir Outage innecesario.

---

# 265. Deployment Integration

ENG-067 deberá preservar Availability Objectives durante Rollout cuando Strategy lo prometa.

---

# 266. Upgrade Integration

ENG-066 deberá comprobar Availability durante Mixed-Version Window.

---

# 267. Migration Integration

ENG-065 deberá declarar Downtime esperado si una Migration requiere Maintenance.

---

# 268. Multi-Tenancy Integration

ENG-048 deberá limitar Blast Radius por Tenant cuando Architecture lo permita.

---

# 269. First Implementation Components

La primera implementación deberá incluir:

```text
AvailabilityState

AvailabilityRequirement
AvailabilityMeasurement
AvailabilityBudget

AvailabilityPolicy

AvailabilityDependency
FailureDomain

FailoverPolicy

AvailabilitySnapshot
AvailabilityRuntime

AvailabilityRegistry
AvailabilityError
```

---

# 270. Optional Initial Components

Podrán incorporarse:

```text
SPOFAnalyzer
AvailabilityGate

Outage
OutageRegistry

FailoverCoordinator
AvailabilityDiagnostics
```

---

# 271. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Failure Domain Modeling
Predictive Availability
Automated Failover Optimization
Cross-Region Availability Optimizer
Autonomous SPOF Remediation
AI-Assisted Availability Analysis
```

---

# 272. Estructura Conceptual de Directorios

```text
src/
└── Availability/
    ├── State/
    │   └── AvailabilityState
    │
    ├── Requirement/
    │   └── AvailabilityRequirement
    │
    ├── Measurement/
    │   └── AvailabilityMeasurement
    │
    ├── Budget/
    │   └── AvailabilityBudget
    │
    ├── Policy/
    │   └── AvailabilityPolicy
    │
    ├── Dependency/
    │   └── AvailabilityDependency
    │
    ├── FailureDomain/
    │   └── FailureDomain
    │
    ├── SPOF/
    │   └── SPOFAnalyzer
    │
    ├── Failover/
    │   ├── FailoverPolicy
    │   └── FailoverCoordinator
    │
    ├── Outage/
    │   ├── Outage
    │   └── OutageRegistry
    │
    ├── Snapshot/
    │   └── AvailabilitySnapshot
    │
    ├── Gate/
    │   └── AvailabilityGate
    │
    ├── Runtime/
    │   └── AvailabilityRuntime
    │
    ├── Registry/
    │   └── AvailabilityRegistry
    │
    ├── Diagnostics/
    │   └── AvailabilityDiagnostics
    │
    └── Error/
        └── AvailabilityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 273. Error Namespace

ENG-073 utilizará:

```text
MEF-AVAILABILITY-xxx
```

---

# 274. Taxonomía ENG-073

```text
MEF-AVAILABILITY-001 Availability requirement invalid
MEF-AVAILABILITY-002 Availability objective invalid
MEF-AVAILABILITY-003 Availability window invalid
MEF-AVAILABILITY-004 Availability measurement invalid
MEF-AVAILABILITY-005 Availability state unknown
MEF-AVAILABILITY-006 Availability budget exhausted
MEF-AVAILABILITY-007 Availability dependency unavailable
MEF-AVAILABILITY-008 Availability critical dependency failed
MEF-AVAILABILITY-009 Availability degraded
MEF-AVAILABILITY-010 Availability partial outage
MEF-AVAILABILITY-011 Availability outage
MEF-AVAILABILITY-012 Availability failure domain invalid
MEF-AVAILABILITY-013 Availability SPOF detected
MEF-AVAILABILITY-014 Availability redundancy insufficient
MEF-AVAILABILITY-015 Availability failover unavailable
MEF-AVAILABILITY-016 Availability failover failed
MEF-AVAILABILITY-017 Availability failover timeout
MEF-AVAILABILITY-018 Availability failback failed
MEF-AVAILABILITY-019 Availability split brain detected
MEF-AVAILABILITY-020 Availability capacity insufficient
MEF-AVAILABILITY-021 Availability graceful degradation failed
MEF-AVAILABILITY-022 Availability maintenance violation
MEF-AVAILABILITY-023 Availability recovery verification failed
MEF-AVAILABILITY-024 Availability gate failed
MEF-AVAILABILITY-025 Availability override denied
MEF-AVAILABILITY-026 Availability tenant violation
MEF-AVAILABILITY-027 Availability test unauthorized
MEF-AVAILABILITY-028 Availability security violation
MEF-AVAILABILITY-029 Availability measurement unavailable
MEF-AVAILABILITY-030 Availability invariant violation
```

---

# 275. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Availability Requirements
Explicit Measurement Windows
Explicit Success Criteria

Service / Component distinction
Capability Availability

Availability State
Availability Measurement

Downtime Budget
Planned / Unplanned distinction

Dependency Criticality

Failure Domains
SPOF Awareness

Redundancy Awareness

Failover Policy
Failover Capacity
Failback Awareness

Partial Availability
Graceful Degradation

Security
Audit
Observability
Testing
```

---

# 276. First Version Non-Goals

No deberá requerir:

```text
Predictive Availability
Automatic Failure-Domain Discovery
Autonomous Failover Optimization
Automatic SPOF Remediation
Cross-Region Availability Optimizer
AI-Assisted Availability Engineering
```

---

# 277. Second Phase

Podrá incorporar:

```text
SPOF Analyzer
Availability Gates

Outage Registry
Advanced Partial-Outage Accounting

Failover Coordinator

Failure Domain Graph
Dependency Availability Graph
```

---

# 278. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Failure Domain Modeling
Predictive Availability
Automated Failover Optimization
Cross-Region Availability Optimization
Autonomous SPOF Remediation
AI-Assisted Availability Analysis
```

---

# 279. Invariantes de Ingeniería

ENG-073 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1406 | Todo Availability Requirement contractual deberá declarar Service/Capability Scope, Consumer Scope, Measurement Window, Success Criterion, Availability Objective y Downtime Policy suficientes para ser medible. |
| EI-1407 | Availability deberá permanecer diferenciada de Health, Reliability, Resilience, Redundancy, Capacity y Scalability y ninguna de dichas propiedades deberá utilizarse como prueba automática de Availability. |
| EI-1408 | Service Availability deberá medirse desde una perspectiva suficientemente cercana al Consumer y Process Uptime, Node Health o Component Liveness no deberán utilizarse por sí solos como sustituto de disponibilidad funcional. |
| EI-1409 | Uptime, Downtime, Planned Downtime, Unplanned Downtime, Degradation y Partial Outage deberán poseer Semantics explícitas y Planned Maintenance solo podrá excluirse cuando el Contract así lo establezca. |
| EI-1410 | Availability Objectives deberán utilizar Measurement Windows explícitas y el Downtime Budget deberá calcularse sobre dicha ventana sin mezclar periodos, exclusiones o Partial Outages de forma opaca. |
| EI-1411 | Failure interno no deberá contarse automáticamente como Outage cuando Redundancy o Failover preserven el Success Criterion, y Recovery no deberá declararse hasta que Service vuelva a satisfacerlo. |
| EI-1412 | Redundancy deberá analizar Failure Domains y Common-Mode Failures y múltiples Instances que compartan Database, Network, Identity, Configuration, Storage u otro elemento crítico no deberán considerarse independientes por Default. |
| EI-1413 | Todo Service crítico deberá analizar Single Points of Failure, incluyendo SPOFs lógicos, operacionales, de Control Plane, Deployment, Configuration y External Dependencies, no solo Hardware individual. |
| EI-1414 | Active-Active, Active-Passive, N+1 y N+M deberán declarar Capacity, State, Routing, Failure Domain y Failover Semantics y ninguna Standby Unit deberá considerarse protección útil si no puede recibir carga dentro del tiempo requerido. |
| EI-1415 | Failover deberá poseer Trigger, Decision, Target, Capacity Requirement, State/Consistency Requirements, Verification y Timeout explícitos y deberá evitar Split Brain mediante Authority/Fencing apropiados cuando exista State compartido. |
| EI-1416 | Failback deberá tratarse como operación independiente y no deberá ejecutarse automáticamente cuando la restauración del estado preferido pueda introducir un nuevo Outage, inconsistencia o Capacity Deficit. |
| EI-1417 | Dependency Availability deberá considerar Criticality, Correlation y Common-Mode Failure y fórmulas de disponibilidad compuesta no deberán asumir independencia cuando las Dependencies compartan causas de Failure. |
| EI-1418 | Graceful Degradation, Read-Only Mode, Feature Shedding y Fallback deberán preservar Correctness y Security mínimas y Partial Availability no deberá presentarse como Availability total cuando una Capability contractual esté perdida. |
| EI-1419 | Capacity bajo Failure, Maintenance, Deployment, Upgrade y Migration deberá validarse conforme ENG-071 y Redundancy sin capacidad suficiente para absorber Load no deberá considerarse garantía efectiva de Availability. |
| EI-1420 | Multi-Tenant y Multi-Region Availability deberán preservar aislamiento y el cálculo global no deberá ocultar Outages significativos de Tenants, Regions o Capabilities mediante promedios agregados sin Policy explícita. |
| EI-1421 | Availability Security deberá impedir que Failover, Fallback o Degraded Mode omitan Authentication, Authorization, Encryption, Integrity u otros controles críticos con el único propósito de mantener Service disponible. |
| EI-1422 | Availability Audit y Observability deberán permitir determinar Objective, Window, Current State, Downtime, Budget Remaining, Active Failures, Dependencies, Failure Domains, Redundancy y Failover State sin exponer Topology o información sensible innecesaria. |
| EI-1423 | Availability Testing deberá cubrir Measurement, Partial Outage Accounting, SPOFs, Node/Zone/Dependency Failures, Active-Active, Active-Passive, Failover, Failback, Split Brain, Common-Mode Failure, Graceful Degradation, Maintenance, Capacity Under Failure, Security y Recovery Verification según Architecture. |
| EI-1424 | Build y Architecture Tests deberán detectar Availability Claims sin Objective, Process Uptime usado como Service Availability, Redundancy sin Failure-Domain Analysis, Hidden SPOFs, Failover sin Capacity, Planned Downtime excluido implícitamente y Security Fail-Open no autorizado. |
| EI-1425 | La primera implementación deberá priorizar Requirements, Measurement Windows, Success Criteria, Availability States, Measurements, Downtime Budgets, Dependency Criticality, Failure Domains, SPOF Awareness, Redundancy, Failover, Partial Availability y Recovery Verification antes de introducir Predictive Availability, Autonomous Failover o Automatic SPOF Remediation. |

---

# 280. Continuidad de Invariantes

```text
ENG-069 → EI-1326 a EI-1345
ENG-070 → EI-1346 a EI-1365
ENG-071 → EI-1366 a EI-1385
ENG-072 → EI-1386 a EI-1405
ENG-073 → EI-1406 a EI-1425
```

---

# 281. Criterios de Conformidad

Una implementación será conforme con ENG-073 cuando:

- defina Availability Requirements medibles;
- declare Measurement Window;
- declare Success Criterion;
- diferencie Service y Component Availability;
- modele Capability Availability;
- diferencie Uptime y Downtime;
- diferencie Planned y Unplanned Downtime;
- calcule Availability;
- calcule Downtime Budget;
- controle Budget Consumption;
- modele Partial Outages;
- modele Degraded Availability;
- identifique Failure Domains;
- analice Common-Mode Failure;
- detecte SPOFs;
- modele Redundancy;
- diferencie Active-Active y Active-Passive;
- defina Failover Trigger;
- mida Failover Time;
- valide Failover Capacity;
- evite Split Brain;
- modele Failback;
- analice Dependency Availability;
- permita Graceful Degradation;
- contabilice Partial Availability;
- preserve Security;
- preserve Tenant Isolation;
- implemente Availability Observability;
- implemente Failure Tests;
- verifique Recovery.

---

# 282. Riesgos

Deberán evitarse especialmente:

```text
"Highly Available" Without Objective
Process Uptime Equals Availability
Health Equals Availability

Multiple Nodes Equals HA
Replica Equals Independent Failure Domain

Single Shared Database
Single Identity Provider
Single DNS Dependency
Single Configuration Source

Redundancy Without Capacity
Standby Not Ready
Failover Without Verification

Automatic Failback
Failover Oscillation
Split Brain

Common-Mode Failure Ignored
Correlated Dependency Failure Ignored

Planned Maintenance Silently Excluded
Partial Outage Hidden by Global Average

Graceful Degradation With Incorrect Data
Fail Open Security

Recovery Declared Before Verification

Global Availability Hides Regional Failure
Global Availability Hides Tenant Failure
```

---

# 283. Relación con ENG-039

Resilience proporciona mecanismos para responder al Failure.

Availability evalúa si dichos mecanismos preservan el Service observable.

---

# 284. Relación con ENG-069

Health responde:

```text
What is the operational state now?
```

Availability responde:

```text
How much of the required time
has the Service been usable?
```

---

# 285. Relación con ENG-071

Capacity deberá demostrar que la arquitectura puede sostener Load durante:

```text
node failure
zone failure
maintenance
failover
rolling deployment
```

cuando estos escenarios formen parte del Availability Objective.

---

# 286. Relación con ENG-072

Scalability puede aumentar número de Units.

Availability deberá comprobar que esas Units no compartan SPOFs que invaliden la redundancia.

---

# 287. Relación con ENG-067

Deployment deberá preservar Availability cuando su Strategy lo prometa.

---

# 288. Relación con ENG-068

Environment proporciona Failure Domains:

```text
host
zone
region
provider
network boundary
```

que ENG-073 deberá utilizar para analizar independencia real.

---

# 289. Relación con ENG-074

**ENG-074 deberá formalizar Reliability Engineering.**

La frontera será:

```text
AVAILABILITY
ENG-073
→ Is the service usable
  when it is required?

RELIABILITY
ENG-074
→ How consistently does the system
  perform its required function
  without failure over time?
```

ENG-074 deberá cubrir:

```text
Reliability
Reliability Requirement
Reliability Objective

Failure
Fault
Defect
Error

Failure Rate
Failure Probability

MTTF
MTBF

Failure-Free Interval
Mission Time

Reliability Function

Transient Failure
Intermittent Failure
Permanent Failure

Fault Detection
Fault Isolation
Fault Containment

Fault Tolerance

Error Detection
Error Correction

Redundancy Reliability

Reliability Block Model

Dependency Reliability
Composite Reliability

Reliability Degradation

Reliability Growth

Defect Escape
Failure Recurrence

Reliability Baseline
Reliability Regression

Reliability Security
Reliability Audit
Reliability Observability
Reliability Testing
```

---

# 290. Principio Rector

> **MEF deberá medir Availability desde la capacidad real de prestar el servicio requerido, no desde la mera existencia de procesos activos. Redundancy solo tendrá valor cuando sobreviva Failure Domains relevantes, Failover solo contará cuando preserve Correctness y Capacity, y toda declaración de alta disponibilidad deberá estar respaldada por objetivos, mediciones y pruebas reproducibles de Failure.**

---

# 291. Conclusión

**ENG-073 — Availability Engineering** formaliza durante cuánto tiempo MEF puede proporcionar correctamente sus capacidades requeridas.

La relación fundamental queda:

```text
REQUIRED SERVICE TIME
         │
         ├── AVAILABLE TIME
         │
         └── DOWNTIME
                │
                ▼
          AVAILABILITY
```

Conceptualmente:

```text
Availability =
Available Time
/
Required Time
```

El Budget queda:

```text
AVAILABILITY OBJECTIVE
          │
          ▼
MEASUREMENT WINDOW
          │
          ▼
ALLOWED DOWNTIME
          │
          ▼
DOWNTIME BUDGET
          │
      ┌───┴─────────┐
      ▼             ▼
  consumed       remaining
```

La relación Failure/Outage queda:

```text
FAILURE
   │
   ▼
REDUNDANCY / FAILOVER
   │
 ┌─┴───────┐
 ▼         ▼
works     fails
 │         │
 ▼         ▼
SERVICE   OUTAGE
STAYS
AVAILABLE
```

Esto significa:

```text
Failure ≠ Outage
```

La redundancia real exige:

```text
INSTANCE A ── Failure Domain A
INSTANCE B ── Failure Domain B

        │
        ▼
independent enough
for the Failure Model
```

y no simplemente:

```text
INSTANCE A ─┐
INSTANCE B ─┼── same database
INSTANCE C ─┘
                 │
                 ▼
                SPOF
```

El Failover queda:

```text
FAILURE
   │
   ▼
DETECT
   │
   ▼
DECIDE
   │
   ▼
FENCE OLD OWNER
   │
   ▼
PROMOTE TARGET
   │
   ▼
RESTORE ROUTING
   │
   ▼
READINESS
   │
   ▼
VERIFY
   │
   ▼
AVAILABLE
```

La degradación queda:

```text
FULL SERVICE
    │
    X optional capability
    │
    ▼
DEGRADED SERVICE
    │
    ├── core capability available
    └── optional capability unavailable
```

Por tanto:

```text
DEGRADED
≠
necessarily UNAVAILABLE
```

La relación de este bloque queda:

```text
HEALTH & READINESS
ENG-069
   │
   ▼
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
```

La primera implementación deberá concentrarse en:

```text
AvailabilityState

AvailabilityRequirement
AvailabilityMeasurement
AvailabilityBudget

AvailabilityPolicy

AvailabilityDependency
FailureDomain

FailoverPolicy

AvailabilitySnapshot
AvailabilityRuntime

AvailabilityRegistry
AvailabilityError
```

con:

```text
Explicit Objectives
Measurement Windows
Success Criteria

Service / Component separation
Capability Availability

Uptime / Downtime
Downtime Budgets

Partial Outages
Degraded Availability

Failure Domains
SPOF Analysis
Common-Mode Failure

Redundancy
Active-Active
Active-Passive

Failover
Failover Capacity
Failback
Split-Brain Protection

Dependency Availability
Graceful Degradation

Security
Audit
Observability
Failure Testing
Recovery Verification
```

antes de introducir:

```text
Automatic Failure Domain Modeling
Predictive Availability
Automated Failover Optimization
Cross-Region Availability Optimization
Autonomous SPOF Remediation
AI-Assisted Availability Analysis
```

Con **ENG-073**, la serie global alcanza:

```text
EI-1425
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
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-034 — Application Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-066 — Upgrade Engineering
- ENG-067 — Deployment Engineering
- ENG-068 — Environment Engineering
- ENG-069 — Health & Readiness Engineering
- ENG-070 — Performance Engineering
- ENG-071 — Capacity Engineering
- ENG-072 — Scalability Engineering
- ENG-074 — Reliability Engineering
```