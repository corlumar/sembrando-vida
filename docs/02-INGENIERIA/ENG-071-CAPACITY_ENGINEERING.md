---
id: ENG-071
titulo: Capacity Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Capacity Engineering
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
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-043
  - ENG-048
  - ENG-049
  - ENG-054
  - ENG-055
  - ENG-057
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-070
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
  - ENG-042
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-053
  - ENG-056
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-072
keywords:
  - capacity
  - capacity-engineering
  - capacity-planning
  - capacity-model
  - sustainable-capacity
  - headroom
  - safety-margin
  - demand
  - peak-load
  - sustained-load
  - burst-capacity
  - sizing
  - right-sizing
  - scaling
  - autoscaling
  - scale-out
  - scale-in
  - failover-capacity
  - reservation
  - allocation
  - exhaustion
  - mef
---

# ENG-071

# Capacity Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Capacity Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-071 establece las reglas para:

```text
Capacity
Capacity Requirement
Capacity Objective
Capacity Budget

Demand
Load
Peak Load
Sustained Load
Burst Load

Capacity Limit
Sustainable Capacity
Maximum Capacity

Headroom
Safety Margin
Reserve Capacity

Resource Capacity

Compute Capacity
Memory Capacity
Storage Capacity
Network Capacity
Connection Capacity
Worker Capacity
Queue Capacity

Capacity Baseline
Capacity Envelope
Capacity Model

Capacity Planning
Sizing
Right-Sizing

Vertical Capacity
Horizontal Capacity

Scale Up
Scale Down
Scale Out
Scale In

Scaling Trigger
Scaling Threshold
Scaling Policy

Autoscaling

Minimum Capacity
Maximum Capacity
Desired Capacity

Burst Capacity
Failover Capacity
Maintenance Capacity
Disaster Recovery Capacity

Capacity Reservation
Capacity Allocation
Capacity Quota

Capacity Exhaustion
Capacity Degradation

Capacity Forecast
Growth Forecast

Capacity Validation

Capacity Security
Capacity Audit
Capacity Observability
Capacity Testing
```

---

# 2. Declaración

> **Toda Capacity gobernada por MEF deberá expresarse respecto de una Workload, Performance Objectives, Resource Constraints y Failure Assumptions explícitos. Ningún sistema deberá dimensionarse únicamente para su carga promedio, ninguna estrategia de Autoscaling deberá sustituir Capacity Planning y Maximum Capacity no deberá confundirse con Sustainable Capacity.**

Arquitectura conceptual:

```text
DEMAND
   │
   ▼
WORKLOAD
   │
   ▼
CAPACITY MODEL
   │
   ├── Compute
   ├── Memory
   ├── Storage
   ├── Network
   ├── Connections
   └── Workers
   │
   ▼
AVAILABLE CAPACITY
   │
   ├── used
   └── headroom
   │
   ▼
PERFORMANCE OBJECTIVES
   │
   ├── satisfied
   └── violated
```

---

# 3. Capacity Engineering

Capacity Engineering responde:

```text
How much load can the system sustain?
How much demand exists now?
How much demand is expected?
Which resource limits capacity?
How much headroom remains?
What happens if one node fails?
How much capacity is required during maintenance?
When should the system scale?
How quickly can additional capacity become available?
What is the minimum safe capacity?
What is the maximum allowed capacity?
```

---

# 4. Capacity

`Capacity` representa la cantidad de Workload que un sistema puede procesar dentro de Constraints y Objectives definidos.

---

# 5. Capacity ≠ Performance

Performance mide:

```text
latency
throughput
saturation
efficiency
```

Capacity determina:

```text
how much workload
can be sustained
while objectives remain satisfied
```

---

# 6. Capacity ≠ Resource Count

```text
10 CPUs
```

no constituye por sí solo una definición de Capacity.

---

# 7. Capacity ≠ Scalability

Capacity representa capacidad disponible.

Scalability representa cómo cambia al modificar Resources o Architecture.

---

# 8. Capacity ≠ Availability

Un sistema puede poseer Capacity suficiente y aun estar unavailable por Failure.

---

# 9. Capacity ≠ Autoscaling

Autoscaling modifica Capacity.

No sustituye su planificación.

---

# 10. Capacity Requirement

Todo requisito deberá declarar:

```text
scope
workload
performance objectives
availability assumptions
growth
headroom
```

---

# 11. Capacity Requirement Example

```text
Service:
orders-api

Sustained Load:
2,000 RPS

Peak Load:
3,500 RPS

p95 latency:
<= 200 ms

Error Rate:
< 0.1%

Failure Assumption:
one node unavailable

Required Headroom:
30%
```

---

# 12. Vague Capacity Requirement

No deberá utilizarse como Contract:

```text
support many users
handle high traffic
scale automatically
support enterprise usage
```

---

# 13. Capacity Objective

Define cantidad de Workload que debe soportarse dentro de Performance Objectives.

---

# 14. Capacity Budget

Podrá asignarse por:

```text
application
service
tenant
pipeline
queue
database
environment
```

---

# 15. Capacity Scope

Deberá ser explícito.

---

# 16. Demand

Representa Workload solicitada al sistema.

---

# 17. Current Demand

Demanda observada actualmente.

---

# 18. Forecast Demand

Demanda esperada futura.

---

# 19. Demand Dimensions

Podrán incluir:

```text
requests/s
transactions/s
messages/s
jobs/s
records/s
users
sessions
connections
storage growth
network throughput
```

---

# 20. Average Demand

No deberá utilizarse como única base de Capacity Planning.

---

# 21. Peak Load

Carga máxima esperada dentro de una ventana definida.

---

# 22. Sustained Load

Carga mantenida durante una duración suficientemente larga.

---

# 23. Burst Load

Incremento temporal por encima de carga sostenida.

---

# 24. Peak ≠ Burst

Peak podrá ser sostenido.

Burst implica normalmente duración limitada.

---

# 25. Demand Distribution

Podrá incluir:

```text
daily cycle
weekly cycle
seasonal cycle
campaign peak
month-end
year-end
event-driven spike
```

---

# 26. Demand Variability

Deberá considerarse en Headroom.

---

# 27. Capacity Limit

Representa punto donde Objectives dejan de satisfacerse.

---

# 28. Sustainable Capacity

Máxima carga que puede mantenerse durante periodo relevante sin violar Objectives.

---

# 29. Maximum Capacity

Máximo trabajo técnicamente alcanzable antes de Failure severo.

---

# 30. Sustainable Capacity ≠ Maximum Capacity

Ejemplo:

```text
Maximum:
10,000 RPS before collapse

Sustainable:
6,500 RPS with
p95 <= 200 ms
and errors < 0.1%
```

La cifra arquitectónicamente útil es normalmente Sustainable Capacity.

---

# 31. Capacity Boundary

Deberá definirse en términos de:

```text
latency
errors
saturation
resource limits
queue growth
recovery
```

---

# 32. Capacity Envelope

Describe conjunto de Workloads donde Objectives se cumplen.

Conceptualmente:

```text
CapacityEnvelope
├── workload dimensions
├── resource configuration
├── valid range
├── performance objectives
└── failure assumptions
```

---

# 33. Single-Dimension Capacity

No deberá asumirse cuando Workload dependa de múltiples dimensiones.

Ejemplo:

```text
RPS alone
```

puede ser insuficiente si Payload Size varía fuertemente.

---

# 34. Capacity Model

Relaciona:

```text
Demand
Resources
Performance
Saturation
```

---

# 35. Model Inputs

Podrán incluir:

```text
request rate
concurrency
payload size
data size
CPU
memory
workers
connections
dependency latency
cache hit ratio
```

---

# 36. Empirical Capacity Model

Podrá derivarse de Tests y Production Telemetry.

---

# 37. Analytical Capacity Model

Podrá utilizar modelos matemáticos cuando sus supuestos sean válidos.

---

# 38. Model Validation

Toda Capacity Model deberá contrastarse con mediciones.

---

# 39. Model ≠ Truth

El modelo es una aproximación.

---

# 40. Capacity Baseline

Representa capacidad conocida para una configuración concreta.

---

# 41. Baseline Conditions

Deberán registrar:

```text
version
environment
resources
dataset
configuration
workload
dependencies
```

---

# 42. Capacity Baseline Drift

Cambios de Environment o Resource Shape deberán distinguirse de Regression.

---

# 43. Headroom

Representa Capacity disponible por encima de Demand actual o esperada.

Conceptualmente:

```text
Headroom =
Sustainable Capacity
-
Expected Load
```

---

# 44. Headroom Percentage

Podrá expresarse proporcionalmente.

---

# 45. Headroom Purpose

Deberá contemplar:

```text
traffic variance
growth
failure
maintenance
deployments
autoscaling delay
dependency degradation
```

---

# 46. Zero Headroom

No deberá considerarse estado deseable de operación sostenida.

---

# 47. Safety Margin

Capacidad adicional deliberadamente reservada frente a incertidumbre.

---

# 48. Safety Margin ≠ Waste Automatically

Puede ser requisito de Reliability.

---

# 49. Capacity Reserve

Podrá permanecer sin utilizar durante operación normal.

---

# 50. Resource Capacity

Capacidad física o lógica de un recurso.

---

# 51. Compute Capacity

Podrá expresarse mediante:

```text
cores
CPU time
compute units
worker slots
```

---

# 52. CPU Capacity

No deberá inferirse únicamente de Core Count.

Arquitectura, frecuencia, throttling y Workload pueden alterar capacidad efectiva.

---

# 53. Memory Capacity

Deberá distinguir:

```text
total
reserved
allocated
working set
available
```

---

# 54. Memory Headroom

Deberá proteger contra:

```text
traffic spikes
GC pressure
large payloads
cache growth
fragmentation
```

---

# 55. Storage Capacity

Deberá considerar:

```text
used space
growth rate
retention
indexes
temporary space
backup overhead
migration overhead
```

---

# 56. Storage Capacity ≠ Disk Size

IOPS y Latency también pueden limitar capacidad.

---

# 57. Network Capacity

Deberá considerar:

```text
bandwidth
connections
packets/s
latency
egress limits
ingress limits
```

---

# 58. Connection Capacity

Podrá incluir:

```text
database connections
HTTP connections
broker sessions
socket limits
file descriptors
```

---

# 59. Worker Capacity

Representa cantidad de trabajo concurrente administrable.

---

# 60. Queue Capacity

Deberá ser acotada conforme ENG-054 y ENG-070.

---

# 61. Queue Capacity ≠ Processing Capacity

Una Queue grande puede ocultar incapacidad de procesamiento.

---

# 62. Queue Growth

Es evidencia de Demand > Processing Capacity durante una ventana.

---

# 63. Resource Bottleneck

La menor capacidad efectiva puede limitar todo el sistema.

Conceptualmente:

```text
App capacity       = 5000
DB capacity        = 3000
Broker capacity    = 8000

Effective capacity ≈ 3000
```

cuando DB sea Bottleneck real.

---

# 64. External Dependency Capacity

Deberá incluirse cuando limite Workload.

---

# 65. Rate-Limited Dependency

Podrá establecer Capacity máxima externa.

---

# 66. Capacity Planning

Proceso de estimar Capacity necesaria.

---

# 67. Planning Inputs

Deberán incluir:

```text
current demand
forecast demand
peak demand
growth
performance targets
failure assumptions
maintenance requirements
deployment strategy
resource lead time
```

---

# 68. Planning Horizon

Deberá ser explícito.

Ejemplos:

```text
1 month
1 quarter
1 year
```

---

# 69. Capacity Lead Time

Tiempo necesario para adquirir o activar nueva Capacity.

---

# 70. Lead Time Importance

Cuanto mayor sea, mayor importancia adquieren Forecast y Headroom.

---

# 71. Capacity Shortage Window

Podrá ocurrir cuando:

```text
demand growth
>
capacity activation speed
```

---

# 72. Capacity Planning Frequency

Deberá corresponder a velocidad de cambio de Demand y Resources.

---

# 73. Sizing

Determina Resources requeridos.

---

# 74. Right-Sizing

Busca equilibrar:

```text
capacity
performance
reliability
cost
```

---

# 75. Under-Sizing

Puede provocar:

```text
saturation
latency
errors
queue growth
availability loss
```

---

# 76. Over-Sizing

Puede aumentar coste sin beneficio proporcional.

---

# 77. Right-Sizing ≠ Minimum Cost

Debe respetar Safety Margin.

---

# 78. Vertical Capacity

Aumenta capacidad de una Unit.

---

# 79. Scale Up

Incrementa Resources.

Ejemplos:

```text
CPU
memory
IOPS
```

---

# 80. Scale Down

Reduce Resources.

---

# 81. Vertical Limit

Existe máximo técnico o económico por Unit.

---

# 82. Horizontal Capacity

Aumenta número de Units.

---

# 83. Scale Out

Añade Units.

---

# 84. Scale In

Reduce Units.

---

# 85. Horizontal Scaling Preconditions

Deberán considerar:

```text
statelessness
partitioning
shared state
sessions
coordination
external bottlenecks
```

---

# 86. Scale Out ≠ Linear Capacity

Duplicar Nodes no garantiza duplicar Capacity.

---

# 87. Scaling Efficiency

Deberá medirse:

```text
capacity gain
/
resource increase
```

---

# 88. Diminishing Returns

Deberán esperarse cuando aparecen Bottlenecks compartidos.

---

# 89. Minimum Capacity

Capacidad mínima operativa segura.

---

# 90. Minimum Replica Count

Podrá depender de:

```text
availability
failure domains
maintenance
load
```

---

# 91. Desired Capacity

Capacidad objetivo actual según Policy.

---

# 92. Maximum Capacity Limit

Deberá existir para impedir crecimiento ilimitado.

---

# 93. Scaling Trigger

Señal que inicia Scaling.

---

# 94. Scaling Metrics

Podrán incluir:

```text
CPU
memory
queue depth
request rate
concurrency
latency
consumer lag
custom demand metric
```

---

# 95. CPU-Only Scaling

No deberá utilizarse universalmente.

---

# 96. Demand-Based Scaling

Podrá ser más apropiado cuando Capacity se relacione directamente con Work Units.

---

# 97. Scaling Threshold

Deberá ser explícito.

---

# 98. Scale-Out Threshold

Podrá diferir de Scale-In Threshold.

---

# 99. Hysteresis

Deberá evitar Oscillation.

---

# 100. Scaling Cooldown

Podrá impedir cambios demasiado frecuentes.

---

# 101. Scale-Out Delay

Deberá incluir:

```text
provisioning
startup
warm-up
readiness
routing
```

---

# 102. Effective Capacity Delay

Nueva Capacity no existe funcionalmente hasta que Units estén Ready.

---

# 103. Predictive Scaling

Podrá utilizar Forecast cuando patrones sean conocidos.

---

# 104. Reactive Scaling

Reacciona a señales observadas.

---

# 105. Autoscaling

Automatiza modificaciones de Desired Capacity.

---

# 106. Autoscaling Preconditions

Deberá poseer:

```text
min
max
metric
target
cooldown
failure policy
```

---

# 107. Autoscaling ≠ Infinite Scaling

Maximum Capacity deberá existir.

---

# 108. Autoscaling Failure

Deberá ser observable.

---

# 109. Capacity Provider Exhaustion

Infrastructure puede no disponer de Resources solicitados.

---

# 110. Autoscaling Dependency

No deberá considerarse garantía absoluta.

---

# 111. Scaling During Incident

Puede agravar Failure si Bottleneck no es Compute.

---

# 112. Scale-Out Against Database Bottleneck

Podrá aumentar conexiones y empeorar problema.

---

# 113. Scaling Validation

Deberá verificar que acción mejora Capacity real.

---

# 114. Scale-In Safety

Deberá considerar:

```text
drain
in-flight work
sessions
partitions
jobs
connections
```

---

# 115. Scale-In Too Fast

Puede provocar Oscillation o sobrecarga.

---

# 116. Burst Capacity

Capacity disponible durante periodo corto.

---

# 117. Burst Mechanisms

Podrán incluir:

```text
temporary replicas
CPU bursting
queue buffering
temporary worker pools
cloud burst
```

---

# 118. Burst Capacity Duration

Deberá conocerse.

---

# 119. Burst Credits

Cuando plataforma los utilice deberán observarse.

---

# 120. Burst ≠ Sustainable Capacity

No deberá utilizarse para planificación de carga continua.

---

# 121. Failover Capacity

Capacity necesaria para operar tras pérdida de componente o Failure Domain.

---

# 122. N+1 Capacity

Ejemplo:

```text
N units required for load
+
1 unit reserve
```

---

# 123. N+1 ≠ Universal

La estrategia deberá derivarse de Architecture y Failure Model.

---

# 124. Zone Failure Capacity

Podrá requerir soportar Peak Load con una Zone indisponible.

---

# 125. Region Failure Capacity

Podrá requerirse en arquitecturas multi-region.

---

# 126. Maintenance Capacity

Capacity necesaria mientras parte del sistema está fuera de servicio por mantenimiento.

---

# 127. Rolling Deployment Capacity

ENG-067 podrá requerir Surge Capacity.

---

# 128. Upgrade Capacity

ENG-066 podrá requerir coexistencia Old/New.

---

# 129. Migration Capacity

ENG-065 puede consumir CPU, I/O, Connections y Storage temporales.

---

# 130. Backup Capacity

Backups pueden consumir:

```text
storage
network
I/O
CPU
```

y deberán considerarse.

---

# 131. Disaster Recovery Capacity

Deberá alinearse con estrategia de Recovery.

---

# 132. DR Capacity Modes

Podrán incluir:

```text
COLD
PILOT_LIGHT
WARM
HOT
ACTIVE_ACTIVE
```

---

# 133. DR Capacity ≠ Production Capacity Automatically

Dependerá de Recovery Objectives.

---

# 134. Capacity Reservation

Aparta Capacity para uso futuro o Workload crítica.

---

# 135. Reservation Scope

Podrá ser:

```text
application
tenant
service
workload
region
```

---

# 136. Capacity Allocation

Representa Capacity asignada actualmente.

---

# 137. Allocation ≠ Utilization

Asignar 8 CPUs no implica utilizarlas completamente.

---

# 138. Capacity Quota

Limita Capacity consumible.

---

# 139. Quota Purpose

Puede proteger:

```text
fairness
cost
blast radius
shared environment
tenant isolation
```

---

# 140. Reserved vs Shared Capacity

Deberá distinguirse.

---

# 141. Overcommit

Podrá utilizarse cuando comportamiento sea conocido.

---

# 142. Overcommit Risk

Puede fallar simultáneamente bajo Demand correlacionada.

---

# 143. Capacity Exhaustion

Ocurre cuando Demand excede Capacity disponible.

---

# 144. Exhaustion Symptoms

Podrán incluir:

```text
queue growth
timeouts
rejections
OOM
connection exhaustion
disk full
rate-limit failures
```

---

# 145. Capacity Degradation

Ocurre cuando Capacity efectiva disminuye.

Ejemplos:

```text
node failure
dependency slowdown
thermal throttling
disk degradation
network degradation
```

---

# 146. Capacity Loss Detection

Deberá ser observable.

---

# 147. Degraded Capacity Mode

System podrá continuar operando con menor Capacity.

---

# 148. Load Shedding

Podrá utilizarse para mantener Workload crítica dentro de Capacity restante.

---

# 149. Priority

Podrá decidir qué Workload preservar.

---

# 150. Admission Control

Podrá evitar aceptar más trabajo del procesable.

---

# 151. Admission Control ≠ Rate Limiting

Rate Limiting es una posible técnica.

Admission Control es concepto más amplio.

---

# 152. Backpressure

Podrá limitar ingreso de Demand cuando sea posible.

---

# 153. Capacity and Queueing

Queueing no crea Processing Capacity.

---

# 154. Queue as Shock Absorber

Puede absorber Bursts limitados.

---

# 155. Queue as Capacity Debt

Carga acumulada deberá procesarse posteriormente.

---

# 156. Queue Drain Time

Podrá estimarse:

```text
backlog
/
excess processing capacity
```

cuando el modelo aplique.

---

# 157. Recovery Capacity

Después de Outage deberá existir Capacity adicional para procesar Backlog.

---

# 158. Catch-Up Capacity

Deberá considerarse para:

```text
message consumers
pipelines
scheduled jobs
replication
```

---

# 159. Capacity Forecast

Proyecta Demand y Capacity futura.

---

# 160. Forecast Inputs

Podrán incluir:

```text
historical demand
business growth
seasonality
planned launches
customer growth
data growth
traffic campaigns
```

---

# 161. Forecast Uncertainty

Deberá expresarse.

---

# 162. Single Forecast Value

No deberá considerarse certeza absoluta.

---

# 163. Forecast Range

Podrá utilizar:

```text
expected
high
low
```

o intervalos equivalentes.

---

# 164. Scenario Planning

Deberá considerarse para sistemas críticos.

Ejemplos:

```text
normal growth
2x growth
campaign spike
dependency degradation
one-zone failure
```

---

# 165. Capacity Forecast Horizon

Deberá ser suficiente para Resource Lead Time.

---

# 166. Storage Growth Forecast

Deberá considerar Retention y Deletion.

---

# 167. Data Growth

Puede reducir Performance incluso con mismo RPS.

---

# 168. Cardinality Growth

Puede incrementar:

```text
index size
cache size
query cost
memory
```

---

# 169. Connection Growth

Puede limitar Capacity antes que CPU.

---

# 170. Capacity Validation

Deberá comprobar modelo mediante Testing.

---

# 171. Capacity Test

Busca determinar Sustainable Capacity bajo Objectives.

---

# 172. Capacity Test Procedure

Conceptualmente:

```text
increase load
     │
     ▼
measure objectives
     │
     ▼
still valid?
 ┌───┴────┐
 ▼        ▼
YES       NO
 │        │
 ▼        ▼
increase  boundary found
```

---

# 173. Capacity Test Stop Conditions

Deberán proteger Environment.

---

# 174. Capacity Test Environment

Deberá ser adecuado para carga aplicada.

---

# 175. Production Capacity Test

Deberá requerir controles reforzados.

---

# 176. Capacity Baseline Test

Deberá registrar configuración exacta.

---

# 177. Failover Capacity Test

Deberá retirar componente y verificar Objectives.

---

# 178. Maintenance Capacity Test

Deberá simular capacidad reducida.

---

# 179. Scaling Test

Deberá comprobar:

```text
trigger
provisioning
startup
readiness
capacity increase
```

---

# 180. Scale-In Test

Deberá comprobar Drain.

---

# 181. Autoscaling Test

Deberá evaluar:

```text
scale-out
scale-in
cooldown
hysteresis
min
max
failure
```

---

# 182. Burst Test

Deberá comprobar duración soportada.

---

# 183. Recovery Capacity Test

Deberá comprobar Catch-Up después de Outage.

---

# 184. Storage Exhaustion Test

Deberá ejecutarse de forma controlada.

---

# 185. Connection Exhaustion Test

Deberá comprobar rechazo y recuperación.

---

# 186. Multi-Tenant Capacity

ENG-048 deberá preservar aislamiento.

---

# 187. Tenant Capacity Budget

Podrá limitar:

```text
requests
workers
connections
storage
queue
memory
```

---

# 188. Noisy Neighbor

Deberá mitigarse mediante ENG-054.

---

# 189. Shared Capacity

Deberá declarar Allocation Policy.

---

# 190. Tenant Burst

Podrá permitirse sobre Shared Capacity si no viola garantías de otros Tenants.

---

# 191. Capacity and Performance

ENG-070 proporciona Performance Objectives y Measurements.

---

# 192. Capacity Boundary Example

```text
Load increases
      │
      ▼
p95 stable
      │
      ▼
CPU rises
      │
      ▼
queue rises
      │
      ▼
p95 exceeds target
      │
      ▼
SUSTAINABLE CAPACITY BOUNDARY
```

---

# 193. Capacity and Health

ENG-069 podrá utilizar Saturation para Readiness/Degraded Policies.

---

# 194. Saturated ≠ Dead

Un sistema saturado puede continuar Alive.

---

# 195. Capacity and Resources

ENG-054 es Owner de Resource limits.

ENG-071 modela cuánto trabajo dichos Resources pueden sostener.

---

# 196. Capacity and Deployment

ENG-067 deberá validar Capacity antes de Rolling/Blue-Green.

---

# 197. Deployment Surge

Debe considerarse dentro de Capacity Planning.

---

# 198. Capacity and Upgrade

Mixed-Version coexistence puede consumir Resources adicionales.

---

# 199. Capacity and Migration

Backfills no deberán consumir todo Headroom de Production.

---

# 200. Capacity and Resilience

ENG-039 puede alterar Capacity mediante:

```text
retry
bulkhead
circuit breaker
fallback
```

---

# 201. Retry Capacity Tax

Retries consumen Capacity adicional.

---

# 202. Retry Budget

Podrá limitarse.

---

# 203. Capacity and Caching

Cache puede desplazar Capacity Bottleneck.

---

# 204. Cache Memory Capacity

Deberá considerarse.

---

# 205. Cache Failure Capacity

Sistema deberá conocer comportamiento de Capacity sin Cache cuando sea relevante.

---

# 206. Capacity and Database

Deberá considerar:

```text
connections
IOPS
storage
locks
replicas
query capacity
```

---

# 207. Database Replica Capacity

Read replicas no incrementan necesariamente Write Capacity.

---

# 208. Capacity and Messaging

Podrá considerar:

```text
partition count
consumer count
broker throughput
lag
retention
```

---

# 209. Partition Capacity

Deberá considerarse antes de añadir Consumers ilimitadamente.

---

# 210. Capacity and Pipelines

ENG-064 deberá considerar:

```text
workers
partitioning
buffers
backpressure
checkpoint overhead
```

---

# 211. Capacity and Scheduling

ENG-040 deberá evitar coincidir Jobs pesados sin Capacity suficiente.

---

# 212. Capacity Calendar

Podrá considerar ventanas conocidas:

```text
backups
batch jobs
reports
maintenance
deployments
```

---

# 213. Capacity Security

ENG-024 gobernará controles generales.

---

# 214. Resource Exhaustion Attack

Capacity Controls deberán contribuir a mitigar DoS.

---

# 215. Capacity Limits as Security Control

Podrán utilizarse:

```text
rate limits
connection limits
queue limits
tenant quotas
payload limits
worker limits
```

---

# 216. Autoscaling Abuse

Input externo no deberá poder provocar escalamiento ilimitado sin límites económicos y operacionales.

---

# 217. Cost Amplification

Ataques o errores pueden aumentar Resources automáticamente.

---

# 218. Maximum Autoscaling Limit

Deberá existir.

---

# 219. Capacity Information

Puede revelar detalles de Infrastructure.

---

# 220. Public Exposure

No deberá divulgar:

```text
exact infrastructure limits
internal topology
reserved capacity
failure thresholds
```

sin necesidad.

---

# 221. Capacity Audit

Cambios relevantes deberán ser auditables.

---

# 222. Audit Events

Podrán incluir:

```text
capacity requirement changed
capacity reservation changed
quota changed
autoscaling policy changed
maximum capacity changed
capacity gate overridden
```

---

# 223. Capacity Observability

ENG-025 gobernará Telemetry.

---

# 224. Metrics

Podrán incluir:

```text
mef.capacity.demand
mef.capacity.available
mef.capacity.sustainable
mef.capacity.headroom
mef.capacity.utilization
mef.capacity.saturation
mef.capacity.exhaustion.total
mef.capacity.scale.total
mef.capacity.scale.failure.total
```

---

# 225. Resource Metrics

Podrán incluir:

```text
cpu capacity
memory capacity
storage capacity
connection capacity
worker capacity
queue capacity
```

---

# 226. Headroom Metric

Deberá indicar Scope.

---

# 227. Capacity Metric Units

Deberán ser explícitas.

---

# 228. Metric Labels

Podrán incluir:

```text
resourceType
scopeType
scalingDirection
result
```

con Cardinality controlada.

---

# 229. Tenant ID as Metric Label

No deberá utilizarse indiscriminadamente.

---

# 230. Capacity Diagnostics

Deberá poder responder:

```text
what is current demand?
what is sustainable capacity?
what is headroom?
which resource limits capacity?
what happens if one node fails?
how much failover capacity exists?
what is forecast demand?
when will capacity be exhausted?
is autoscaling working?
```

---

# 231. Capacity Alerts

Podrán basarse en:

```text
headroom
growth rate
storage runway
connection saturation
queue growth
autoscaling failure
```

---

# 232. Runway

Tiempo estimado antes de agotar Capacity.

Ejemplo:

```text
remaining storage
/
growth rate
```

cuando modelo sea aplicable.

---

# 233. Runway Uncertainty

Deberá declararse.

---

# 234. Testing

ENG-009 gobernará Testing.

---

# 235. Sustainable Capacity Test

Deberá identificar carga máxima dentro de Objectives.

---

# 236. Peak Load Test

Deberá verificar Peak esperado.

---

# 237. Burst Test

Deberá verificar duración del Burst.

---

# 238. Headroom Test

Deberá comprobar Safety Margin requerida.

---

# 239. Failover Test

Deberá comprobar carga con Failure Domain reducido.

---

# 240. Maintenance Test

Deberá comprobar Capacity durante Maintenance.

---

# 241. Scaling Test

Deberá comprobar incremento efectivo de Capacity.

---

# 242. Scaling Efficiency Test

Deberá medir ganancia frente a Resources agregados.

---

# 243. Autoscaling Test

Deberá comprobar Policies y límites.

---

# 244. Capacity Exhaustion Test

Deberá comprobar Failure Mode controlado.

---

# 245. Admission Control Test

Deberá impedir aceptar Workload imposible de procesar cuando Policy lo requiera.

---

# 246. Recovery Capacity Test

Deberá comprobar Backlog Catch-Up.

---

# 247. Storage Growth Test

Deberá validar Forecast cuando corresponda.

---

# 248. Multi-Tenant Test

Deberá comprobar Noisy Neighbor.

---

# 249. Security Test

Deberá intentar:

```text
resource exhaustion
autoscaling amplification
quota bypass
connection exhaustion
queue exhaustion
cross-tenant resource abuse
```

---

# 250. Architecture Test

Podrá impedir:

```text
capacity based only on average load
maximum capacity used as sustainable capacity
zero headroom target
autoscaling without max limit
scale-in without drain
capacity model without performance objectives
queue size used as processing capacity
```

---

# 251. Build Integration

ENG-012 podrá validar estáticamente:

```text
capacity requirement definitions
resource units
quota definitions
autoscaling min/max
invalid thresholds
missing safety margin
```

---

# 252. Capacity Gates

Release/Deployment podrán utilizar Capacity Checks antes de promoción.

---

# 253. Deployment Capacity Gate

Podrá comprobar:

```text
current headroom
surge requirement
failover requirement
target resource availability
```

---

# 254. CLI

ENG-007 podrá proporcionar:

```text
mef capacity
mef capacity:requirements
mef capacity:baseline
mef capacity:headroom
mef capacity:forecast
mef capacity:plan
mef capacity:test
mef capacity:scaling
mef capacity:diagnose
```

---

# 255. `mef capacity`

Podrá mostrar Snapshot general.

---

# 256. `capacity:requirements`

Podrá mostrar:

```text
scope
sustained demand
peak demand
headroom
failure assumption
```

---

# 257. `capacity:baseline`

Podrá mostrar Capacity Baseline.

---

# 258. `capacity:headroom`

Podrá mostrar:

```text
demand
sustainable capacity
absolute headroom
percentage headroom
```

---

# 259. `capacity:forecast`

Podrá mostrar:

```text
current
forecast
high scenario
runway
```

---

# 260. `capacity:plan`

Podrá calcular Resource Requirement estimado.

---

# 261. `capacity:test`

Podrá ejecutar Capacity Test autorizado.

---

# 262. `capacity:scaling`

Podrá mostrar:

```text
minimum
desired
maximum
trigger
threshold
cooldown
```

---

# 263. `capacity:diagnose`

Podrá mostrar:

```text
demand
capacity
headroom
resources
bottleneck
forecast
scaling
failover capacity
maintenance capacity
last exhaustion
```

---

# 264. Registry Integration

ENG-020 podrá registrar:

```text
CapacityRequirement
CapacityModel
CapacityBaseline
CapacityPolicy
ScalingPolicy
CapacityGate
```

---

# 265. Capacity Requirement Contract

Conceptualmente:

```text
CapacityRequirement
├── id
├── scope
├── workload
├── sustainedLoad
├── peakLoad
├── performanceObjectives
├── failureAssumptions
├── headroom
└── metadata
```

---

# 266. Capacity Model Contract

Conceptualmente:

```text
CapacityModel
├── workloadDimensions
├── resources
├── performanceObjectives
├── estimate
├── assumptions
└── confidence
```

---

# 267. Capacity Baseline Contract

Conceptualmente:

```text
CapacityBaseline
├── version
├── environment
├── resourceConfiguration
├── workload
├── sustainableCapacity
├── bottleneck
└── recordedAt
```

---

# 268. Capacity Snapshot

Conceptualmente:

```text
CapacitySnapshot
├── observedAt
├── demand
├── availableCapacity
├── sustainableCapacity
├── headroom
├── saturation
└── bottlenecks
```

---

# 269. Scaling Policy Contract

Conceptualmente:

```text
ScalingPolicy
├── metric
├── target
├── minimum
├── maximum
├── scaleOutThreshold
├── scaleInThreshold
├── cooldown
└── policy
```

---

# 270. Capacity Forecast Contract

Conceptualmente:

```text
CapacityForecast
├── horizon
├── expectedDemand
├── lowerBound
├── upperBound
├── assumptions
└── generatedAt
```

---

# 271. Capacity Gate

Conceptualmente:

```text
CapacityGate
├── requirement
├── currentSnapshot
├── requiredHeadroom
├── failureScenario
└── evaluate
```

---

# 272. Capacity Runtime

Conceptualmente:

```text
CapacityRuntime
├── observe
├── estimate
├── headroom
├── forecast
├── evaluate
├── scaling
└── diagnose
```

---

# 273. Environment Integration

ENG-068 proporciona:

```text
resource capacity
constraints
quotas
regions
failure domains
```

---

# 274. Performance Integration

ENG-070 proporciona:

```text
latency objectives
throughput
saturation
performance boundary
```

---

# 275. Health Integration

ENG-069 podrá consumir Capacity/Saturation para Health Policies.

---

# 276. Deployment Integration

ENG-067 deberá consultar Capacity antes de:

```text
rolling surge
blue-green duplication
canary expansion
```

---

# 277. Upgrade Integration

ENG-066 deberá validar Capacity para Mixed-Version Window.

---

# 278. Migration Integration

ENG-065 deberá consumir únicamente Headroom autorizado para Backfills/Migrations.

---

# 279. Pipeline Integration

ENG-064 deberá declarar Capacity de:

```text
workers
partitions
buffers
sinks
```

---

# 280. Scheduling Integration

ENG-040 deberá poder considerar Capacity al ejecutar Workloads pesadas.

---

# 281. Resource Management Integration

ENG-054 continúa siendo Owner de:

```text
resource limit
quota
reservation
allocation
```

ENG-071 interpreta su impacto sobre Capacity.

---

# 282. Bootstrap

Capacity no deberá ser necesariamente Blocking en todo Runtime Bootstrap.

---

# 283. Critical Capacity Validation

Podrá impedir Readiness cuando:

```text
minimum capacity absent
critical resource unavailable
mandatory quota impossible
environment below safe minimum
```

---

# 284. Capacity State

Podrá clasificarse:

```text
SUFFICIENT
LOW_HEADROOM
SATURATED
EXHAUSTED
DEGRADED
UNKNOWN
```

---

# 285. SUFFICIENT

Sustainable Capacity satisface Demand + Required Headroom.

---

# 286. LOW_HEADROOM

Objectives aún se satisfacen, pero Safety Margin está por debajo del objetivo.

---

# 287. SATURATED

Uno o más Resources están limitando capacidad significativamente.

---

# 288. EXHAUSTED

Demand supera capacidad aceptable.

---

# 289. DEGRADED

Capacity efectiva disminuyó por Failure o restricción temporal.

---

# 290. UNKNOWN

No existen mediciones suficientes.

---

# 291. UNKNOWN ≠ SUFFICIENT

No deberá asumirse Capacity suficiente por falta de datos.

---

# 292. Capacity Policy

Podrá mapear Estados hacia:

```text
alert
scale
load shed
not ready
manual intervention
```

---

# 293. Low Headroom Policy

No deberá necesariamente retirar Readiness inmediatamente.

---

# 294. Exhaustion Policy

Podrá activar:

```text
admission control
load shedding
autoscaling
backpressure
```

---

# 295. Capacity Ownership

Todo Capacity Requirement deberá poseer Owner.

---

# 296. Owner Responsibility

Incluye:

```text
requirements
forecast assumptions
headroom policy
capacity review
scaling limits
```

---

# 297. Capacity Review

Deberá realizarse ante cambios relevantes:

```text
major release
traffic growth
architecture change
new tenant
new dependency
new data retention
new region
```

---

# 298. First Implementation Components

La primera implementación deberá incluir:

```text
CapacityState
CapacityMetric

CapacityRequirement
CapacityBaseline
CapacitySnapshot

CapacityModel

Headroom

CapacityPolicy
ScalingPolicy

CapacityRuntime

CapacityRegistry
CapacityError
```

---

# 299. Optional Initial Components

Podrán incorporarse:

```text
CapacityForecast
CapacityPlanner
CapacityGate

CapacityDiagnostics

ResourceCapacity
FailoverCapacity
MaintenanceCapacity
```

---

# 300. Later Components

Solo cuando exista necesidad demostrada:

```text
Predictive Autoscaling
Automatic Right-Sizing
Distributed Capacity Optimizer
Cross-Region Capacity Balancing
Cost-Aware Capacity Optimization
AI-Assisted Capacity Planning
```

---

# 301. Estructura Conceptual de Directorios

```text
src/
└── Capacity/
    ├── State/
    │   └── CapacityState
    │
    ├── Metric/
    │   └── CapacityMetric
    │
    ├── Requirement/
    │   └── CapacityRequirement
    │
    ├── Baseline/
    │   └── CapacityBaseline
    │
    ├── Snapshot/
    │   └── CapacitySnapshot
    │
    ├── Model/
    │   └── CapacityModel
    │
    ├── Headroom/
    │   └── Headroom
    │
    ├── Resource/
    │   ├── ResourceCapacity
    │   ├── FailoverCapacity
    │   └── MaintenanceCapacity
    │
    ├── Forecast/
    │   └── CapacityForecast
    │
    ├── Planning/
    │   └── CapacityPlanner
    │
    ├── Scaling/
    │   └── ScalingPolicy
    │
    ├── Policy/
    │   └── CapacityPolicy
    │
    ├── Gate/
    │   └── CapacityGate
    │
    ├── Runtime/
    │   └── CapacityRuntime
    │
    ├── Registry/
    │   └── CapacityRegistry
    │
    ├── Diagnostics/
    │   └── CapacityDiagnostics
    │
    └── Error/
        └── CapacityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 302. Error Namespace

ENG-071 utilizará:

```text
MEF-CAPACITY-xxx
```

---

# 303. Taxonomía ENG-071

```text
MEF-CAPACITY-001 Capacity requirement invalid
MEF-CAPACITY-002 Capacity metric invalid
MEF-CAPACITY-003 Capacity workload invalid
MEF-CAPACITY-004 Capacity model invalid
MEF-CAPACITY-005 Capacity baseline missing
MEF-CAPACITY-006 Capacity baseline incompatible
MEF-CAPACITY-007 Capacity insufficient
MEF-CAPACITY-008 Capacity headroom insufficient
MEF-CAPACITY-009 Capacity saturated
MEF-CAPACITY-010 Capacity exhausted
MEF-CAPACITY-011 Capacity resource unavailable
MEF-CAPACITY-012 Capacity quota exceeded
MEF-CAPACITY-013 Capacity reservation failed
MEF-CAPACITY-014 Capacity allocation failed
MEF-CAPACITY-015 Capacity forecast invalid
MEF-CAPACITY-016 Capacity forecast exhausted
MEF-CAPACITY-017 Capacity scaling policy invalid
MEF-CAPACITY-018 Capacity scale-out failed
MEF-CAPACITY-019 Capacity scale-in failed
MEF-CAPACITY-020 Capacity autoscaling failed
MEF-CAPACITY-021 Capacity maximum reached
MEF-CAPACITY-022 Capacity failover insufficient
MEF-CAPACITY-023 Capacity maintenance insufficient
MEF-CAPACITY-024 Capacity burst exhausted
MEF-CAPACITY-025 Capacity gate failed
MEF-CAPACITY-026 Capacity tenant quota violation
MEF-CAPACITY-027 Capacity test unauthorized
MEF-CAPACITY-028 Capacity security violation
MEF-CAPACITY-029 Capacity state unknown
MEF-CAPACITY-030 Capacity invariant violation
```

---

# 304. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Capacity Requirements
Explicit Workload
Sustainable Capacity

Headroom
Safety Margin

Resource Capacity
Bottleneck Awareness

Capacity Baselines
Capacity Models

Peak / Sustained / Burst distinction

Sizing
Right-Sizing

Minimum / Desired / Maximum Capacity

Scaling Policies
Bounded Autoscaling

Failover Capacity
Maintenance Capacity

Capacity Forecast
Exhaustion Detection

Security
Observability
Testing
```

---

# 305. First Version Non-Goals

No deberá requerir:

```text
Predictive Autoscaling
Automatic Right-Sizing
Cross-Region Capacity Balancing
Distributed Capacity Optimizer
Cost-Aware Autonomous Scaling
AI-Assisted Capacity Planning
```

---

# 306. Second Phase

Podrá incorporar:

```text
Capacity Forecasting
Capacity Gates
Scenario Modeling

Advanced Failover Capacity
Maintenance Capacity Planning

Capacity Calendar
Storage Runway

Advanced Scaling Policies
```

---

# 307. Third Phase

Solo cuando exista necesidad demostrada:

```text
Predictive Autoscaling
Automatic Right-Sizing
Distributed Capacity Optimization
Cross-Region Capacity Balancing
Cost-Aware Capacity Optimization
AI-Assisted Capacity Planning
```

---

# 308. Invariantes de Ingeniería

ENG-071 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1366 | Todo Capacity Requirement contractual deberá declarar Scope, Workload, Sustained/Peak Demand, Performance Objectives, Failure Assumptions, Headroom y Planning Horizon suficientes para ser verificable. |
| EI-1367 | Capacity deberá permanecer diferenciada de Performance, Scalability, Availability, Resource Count y Autoscaling y ninguna de estas propiedades deberá utilizarse como sustituto automático de las demás. |
| EI-1368 | Sustainable Capacity deberá definirse respecto de Performance, Error, Saturation y Recovery Objectives y Maximum Capacity antes del Collapse no deberá utilizarse como Capacity operativa segura. |
| EI-1369 | Capacity Planning no deberá dimensionarse únicamente sobre Average Demand y deberá considerar Peak, Burst, Variability, Growth, Resource Lead Time, Failure y Maintenance Scenarios. |
| EI-1370 | Todo sistema operativo sostenido deberá conservar Headroom/Safety Margin acorde a sus Failure Assumptions y un objetivo de Zero Headroom no deberá considerarse estado normal aceptable. |
| EI-1371 | Compute, Memory, Storage, Network, Connection, Worker y Queue Capacity deberán mantenerse como dimensiones diferenciadas y la menor capacidad efectiva podrá limitar el sistema completo. |
| EI-1372 | Queue Capacity no deberá confundirse con Processing Capacity y crecimiento persistente de Backlog deberá interpretarse como evidencia de Capacity Debt o demanda superior a capacidad efectiva. |
| EI-1373 | Capacity Models y Baselines deberán registrar Environment, Version, Resources, Dataset, Workload, Dependencies y Assumptions suficientes para permitir comparación y detectar Drift. |
| EI-1374 | Scale Up/Down y Scale Out/In deberán analizar límites, Bottlenecks, State, Sessions, Partitions, Drain y External Dependencies y Scale Out no deberá asumirse lineal. |
| EI-1375 | Toda Autoscaling Policy deberá poseer Minimum, Maximum, Metric, Target/Threshold, Cooldown y Failure Behavior explícitos; Autoscaling ilimitado queda prohibido. |
| EI-1376 | Nueva Capacity no deberá considerarse disponible hasta completar Provisioning, Startup, Warm-Up, Readiness y Routing necesarios para recibir Workload efectiva. |
| EI-1377 | Burst Capacity deberá permanecer diferenciada de Sustainable Capacity y no deberá utilizarse para justificar carga sostenida más allá de su Duration/Credit Contract. |
| EI-1378 | Capacity Planning deberá considerar Failover, Maintenance, Rolling Deployment, Upgrade, Migration, Backup y Recovery/Catch-Up Capacity cuando dichos escenarios consuman Resources relevantes. |
| EI-1379 | Scale-In deberá preservar Drain e In-Flight Work y ningún mecanismo automático deberá retirar Capacity tan rápidamente que provoque Oscillation, Lost Work o inmediata re-saturación. |
| EI-1380 | Capacity Reservation, Allocation, Utilization y Quota deberán permanecer diferenciadas y Shared/Multi-Tenant Capacity deberá preservar Resource Isolation y Fairness. |
| EI-1381 | Capacity Exhaustion deberá producir Failure Mode controlado mediante Backpressure, Admission Control, Load Shedding, Scaling u otras Policies autorizadas antes que crecimiento ilimitado de Queues o consumo de Resources. |
| EI-1382 | Capacity Security deberá limitar Resource Exhaustion, Quota Bypass, Connection/Queue Exhaustion y Autoscaling Amplification y no deberá exponer detalles sensibles de Capacity interna a actores no autorizados. |
| EI-1383 | Capacity Observability deberá permitir determinar Demand, Sustainable Capacity, Headroom, Saturation, Bottlenecks, Forecast, Scaling State y Exhaustion con unidades y Scope explícitos y Cardinality controlada. |
| EI-1384 | Capacity Testing deberá cubrir Sustainable Capacity, Peak, Burst, Headroom, Failover, Maintenance, Scaling, Autoscaling, Exhaustion, Admission Control, Recovery Capacity, Storage Growth y Multi-Tenant Isolation según el sistema evaluado. |
| EI-1385 | La primera implementación deberá priorizar Requirements, Sustainable Capacity, Headroom, Resource Capacity, Baselines, Models, Peak/Sustained/Burst semantics, Sizing, Bounded Scaling, Failover/Maintenance Capacity, Forecast y Exhaustion Detection antes de introducir Predictive Autoscaling, Autonomous Right-Sizing o Distributed Capacity Optimization. |

---

# 309. Continuidad de Invariantes

```text
ENG-067 → EI-1286 a EI-1305
ENG-068 → EI-1306 a EI-1325
ENG-069 → EI-1326 a EI-1345
ENG-070 → EI-1346 a EI-1365
ENG-071 → EI-1366 a EI-1385
```

---

# 310. Criterios de Conformidad

Una implementación será conforme con ENG-071 cuando:

- defina Capacity Requirements medibles;
- declare Workloads;
- diferencie Average, Sustained, Peak y Burst Load;
- defina Sustainable Capacity;
- diferencie Maximum Capacity;
- defina Headroom;
- defina Safety Margin;
- modele Resource Capacity;
- identifique Bottlenecks;
- mantenga Capacity Baselines;
- utilice Capacity Models;
- defina Planning Horizon;
- considere Resource Lead Time;
- implemente Sizing;
- implemente Right-Sizing;
- diferencie Vertical y Horizontal Scaling;
- defina Minimum Capacity;
- defina Desired Capacity;
- defina Maximum Capacity;
- limite Autoscaling;
- implemente Hysteresis/Cooldown cuando corresponda;
- considere Scale-Out Delay;
- modele Burst Capacity;
- modele Failover Capacity;
- modele Maintenance Capacity;
- modele Recovery/Catch-Up Capacity;
- gestione Reservations;
- gestione Allocations;
- gestione Quotas;
- detecte Exhaustion;
- permita Admission Control;
- preserve Multi-Tenant Isolation;
- implemente Forecasting cuando corresponda;
- aplique Security;
- implemente Observability;
- implemente Capacity Testing.

---

# 311. Riesgos

Deberán evitarse especialmente:

```text
Average Load Capacity Planning
Maximum Equals Sustainable
Zero Headroom

CPU Count Equals Capacity
Queue Size Equals Processing Capacity

Unlimited Queue
Unlimited Connections
Unlimited Workers

Scale Out Equals Linear Capacity
CPU-Only Autoscaling
Autoscaling Without Maximum
Autoscaling as Capacity Planning

Capacity Counted Before Readiness

Burst Equals Sustainable

No Failover Capacity
No Maintenance Capacity
No Rolling Deployment Surge
Migration Consumes All Headroom

Scale-In Without Drain
Scaling Oscillation

Shared Capacity Without Quota
Noisy Neighbor

Retry Capacity Amplification
Autoscaling Cost Amplification

Storage Growth Ignored
Connection Capacity Ignored
External Rate Limit Ignored

Forecast Treated as Certainty
```

---

# 312. Relación con ENG-054

Resource Management responde:

```text
What resources exist?
What are their limits,
quotas, reservations and allocations?
```

Capacity Engineering responde:

```text
How much sustainable workload
can those resources support?
```

---

# 313. Relación con ENG-069

Health puede clasificar un sistema como:

```text
HEALTHY
READY
LOW_HEADROOM
```

sin convertir inmediatamente baja Capacity en Liveness Failure.

---

# 314. Relación con ENG-070

Performance identifica:

```text
latency
throughput
saturation
```

Capacity utiliza esas mediciones para encontrar Sustainable Capacity.

---

# 315. Relación con ENG-067

Deployment deberá comprobar:

```text
current load
headroom
surge
minimum availability
```

antes de consumir Capacity temporal.

---

# 316. Relación con ENG-066

Rolling o Blue-Green Upgrade podrá requerir Capacity simultánea para Source y Target Versions.

---

# 317. Relación con ENG-065

Backfill y Migration deberán ejecutarse dentro de Capacity Budget.

---

# 318. Relación con ENG-064

Pipelines deberán conocer Capacity operacional de:

```text
Source
Partitions
Workers
Buffers
Stages
Sink
```

---

# 319. Relación con ENG-072

**ENG-072 deberá formalizar Scalability Engineering.**

La separación será:

```text
PERFORMANCE
ENG-070
→ How fast and efficiently
  does the system operate?

CAPACITY
ENG-071
→ How much sustainable workload
  can the current resource configuration support?

SCALABILITY
ENG-072
→ How does capacity/performance change
  when workload, data or resources scale?
```

ENG-072 deberá cubrir:

```text
Scalability
Scalability Requirement
Scalability Model

Scale Dimension
Workload Scaling
Data Scaling
User Scaling
Tenant Scaling
Geographic Scaling

Vertical Scalability
Horizontal Scalability

Scale Up
Scale Down
Scale Out
Scale In

Scaling Efficiency
Scaling Factor

Linear Scalability
Sublinear Scalability
Superlinear Behavior

Strong Scaling
Weak Scaling

Scalability Limit
Scaling Bottleneck

Shared State
Coordination Cost
Contention Cost
Serialization Cost

Partitioning
Sharding
Replication

Stateless Scaling
Stateful Scaling

Hot Partition
Skew

Elasticity
Elastic Response

Scale Transition
Rebalancing

Scalability Regression

Scalability Security
Scalability Observability
Scalability Testing
```

---

# 320. Principio Rector

> **MEF deberá planear Capacity respecto de carga sostenible, no del punto de colapso. La capacidad efectiva deberá incluir Headroom para variación, fallas, mantenimiento y operaciones transitorias, y ninguna automatización de Scaling deberá sustituir el conocimiento explícito de los Bottlenecks, límites y escenarios de Failure del sistema.**

---

# 321. Conclusión

**ENG-071 — Capacity Engineering** formaliza cuánto trabajo puede soportar MEF de manera sostenible.

La relación básica queda:

```text
CURRENT DEMAND
      │
      ▼
SUSTAINABLE CAPACITY
      │
      ▼
HEADROOM
```

donde:

```text
Headroom
=
Sustainable Capacity
-
Demand
```

El concepto crítico queda:

```text
MAXIMUM CAPACITY
      │
      │ system close to collapse
      ▼
──────────────────────────────

SUSTAINABLE CAPACITY
      │
      │ performance objectives
      │ still satisfied
      ▼
──────────────────────────────

CURRENT LOAD
      │
      ▼

HEADROOM
```

Capacity Planning queda:

```text
CURRENT DEMAND
      │
      ▼
FORECAST
      │
      ▼
PEAK / BURST / GROWTH
      │
      ▼
FAILURE ASSUMPTIONS
      │
      ▼
HEADROOM
      │
      ▼
RESOURCE REQUIREMENT
      │
      ▼
CAPACITY PLAN
```

El Scaling queda:

```text
DEMAND
   │
   ▼
CAPACITY POLICY
   │
   ├── Scale Up
   ├── Scale Down
   ├── Scale Out
   └── Scale In
        │
        ▼
Provision / Start / Warm
        │
        ▼
Readiness
        │
        ▼
Effective Capacity
```

No:

```text
instance requested
=
capacity immediately available
```

La Capacity frente a Failure queda:

```text
NORMAL
N units
   │
   X one unit
   │
   ▼
N-1 units
   │
   ▼
still satisfy objectives?
        │
     ┌──┴──┐
     ▼     ▼
    YES    NO
     │     │
     ▼     ▼
 sufficient insufficient
 failover  failover
 capacity  capacity
```

La relación Queue/Capacity queda:

```text
DEMAND
  │
  ▼
PROCESSING CAPACITY
  │
  ├── sufficient ──► stable queue
  │
  └── insufficient
          │
          ▼
      queue growth
          │
          ▼
     capacity debt
```

Una Queue más grande **no soluciona** el déficit de Processing Capacity.

La cadena reciente queda:

```text
ENVIRONMENT
ENG-068
   │
   ▼
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
```

La primera implementación deberá concentrarse en:

```text
CapacityState
CapacityMetric

CapacityRequirement
CapacityBaseline
CapacitySnapshot

CapacityModel
Headroom

CapacityPolicy
ScalingPolicy

CapacityRuntime
CapacityRegistry
CapacityError
```

con:

```text
Explicit Workloads
Sustainable Capacity
Headroom
Safety Margin
Resource Capacity
Bottleneck Awareness
Peak / Sustained / Burst
Capacity Baselines
Capacity Models
Sizing
Right-Sizing
Min / Desired / Max Capacity
Bounded Autoscaling
Failover Capacity
Maintenance Capacity
Recovery Capacity
Forecasting
Exhaustion Detection
Admission Control
Security
Observability
Testing
```

antes de introducir:

```text
Predictive Autoscaling
Automatic Right-Sizing
Distributed Capacity Optimization
Cross-Region Capacity Balancing
Cost-Aware Capacity Optimization
AI-Assisted Capacity Planning
```

Con **ENG-071**, la serie global alcanza:

```text
EI-1385
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
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-049 — Configuration Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-057 — Metadata Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-066 — Upgrade Engineering
- ENG-067 — Deployment Engineering
- ENG-068 — Environment Engineering
- ENG-069 — Health & Readiness Engineering
- ENG-070 — Performance Engineering
- ENG-072 — Scalability Engineering
```