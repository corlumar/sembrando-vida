---
id: ENG-072
titulo: Scalability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Scalability Engineering
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
  - ENG-041
  - ENG-043
  - ENG-048
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-057
  - ENG-064
  - ENG-068
  - ENG-069
  - ENG-070
  - ENG-071
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
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-073
keywords:
  - scalability
  - scalability-engineering
  - horizontal-scaling
  - vertical-scaling
  - scaling-efficiency
  - strong-scaling
  - weak-scaling
  - scale-factor
  - scalability-limit
  - bottleneck
  - partitioning
  - sharding
  - replication
  - skew
  - hot-partition
  - elasticity
  - rebalancing
  - scalability-regression
  - mef
---

# ENG-072

# Scalability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Scalability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-072 establece las reglas para:

```text
Scalability
Scalability Requirement
Scalability Objective

Scale Dimension
Scale Factor

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
Scaling Curve

Linear Scalability
Sublinear Scalability
Superlinear Behavior

Strong Scaling
Weak Scaling

Scalability Limit
Scaling Bottleneck

Shared State
Coordination Cost
Synchronization Cost
Contention Cost

Partitioning
Partition Key
Sharding
Replication

Stateless Scaling
Stateful Scaling

Hot Partition
Data Skew
Workload Skew

Rebalancing
Partition Movement
State Transfer

Elasticity
Elastic Response
Elasticity Delay

Scaling Transition

Scalability Baseline
Scalability Regression

Scalability Security
Scalability Audit
Scalability Observability
Scalability Testing
```

---

# 2. Declaración

> **Toda afirmación de Scalability gobernada por MEF deberá especificar qué dimensión escala, desde qué Baseline, bajo qué Workload, con qué Resource Factor y dentro de qué Performance Objectives. Agregar Resources no deberá considerarse evidencia suficiente de Scalability; MEF deberá medir Capacity Gain, Scaling Efficiency, Coordination Cost, Skew, Rebalancing y el punto donde nuevos Resources dejan de producir una mejora útil.**

Arquitectura conceptual:

```text
           SCALE DIMENSION
                 │
      ┌──────────┼──────────┐
      ▼          ▼          ▼
   WORKLOAD     DATA      RESOURCES
      │          │          │
      └──────────┼──────────┘
                 ▼
               SYSTEM
                 │
       ┌─────────┼─────────┐
       ▼         ▼         ▼
 PERFORMANCE   CAPACITY   COST
       │         │         │
       └─────────┼─────────┘
                 ▼
        SCALABILITY CURVE
                 │
          ┌──────┴──────┐
          ▼             ▼
      efficient      bottleneck
```

---

# 3. Scalability Engineering

Scalability Engineering responde:

```text
What dimension is increasing?
How much are resources increasing?
How much capacity is gained?
Does latency remain within objective?
Does throughput increase proportionally?
Where does scaling stop being efficient?
Which shared resource becomes the bottleneck?
Does data skew create hot partitions?
How expensive is rebalancing?
Can stateful workloads scale safely?
How long does elastic capacity take to become useful?
```

---

# 4. Scalability

`Scalability` representa la capacidad de un sistema para mantener o aumentar su capacidad útil cuando cambian Workload, Data o Resources.

---

# 5. Scalability ≠ Performance

Performance mide comportamiento en una configuración concreta.

Scalability mide cómo ese comportamiento cambia entre configuraciones o escalas.

---

# 6. Scalability ≠ Capacity

Capacity responde:

```text
How much can this configuration sustain?
```

Scalability responde:

```text
How does sustainable capacity change
as the system scales?
```

---

# 7. Scalability ≠ Elasticity

Scalability describe capacidad estructural para escalar.

Elasticity describe capacidad operacional para modificar recursos dinámicamente según demanda.

---

# 8. Scalability ≠ High Availability

Agregar replicas puede ayudar a Availability, pero no prueba Scalability.

---

# 9. Scalability ≠ Distribution

Un sistema distribuido no es automáticamente escalable.

---

# 10. Scalability Requirement

Todo Requirement deberá declarar:

```text
scope
scale dimension
baseline
target scale
resource factor
workload
performance objectives
minimum efficiency
```

---

# 11. Scalability Requirement Example

```text
Component:
orders-api

Baseline:
4 instances

Target:
16 instances

Resource Factor:
4x

Workload:
2,000 → 7,000 RPS

Requirement:
p95 <= 200 ms

Minimum Scaling Efficiency:
>= 80%
```

---

# 12. Vague Scalability Requirement

No deberá considerarse suficiente:

```text
must scale
cloud native
horizontally scalable
supports millions
enterprise scale
```

---

# 13. Scalability Objective

Podrá expresarse mediante:

```text
capacity gain
latency stability
throughput gain
resource efficiency
maximum scale
```

---

# 14. Scale Dimension

Define qué aumenta.

---

# 15. Workload Scaling

Incrementa volumen de trabajo.

Ejemplos:

```text
requests/s
messages/s
jobs/s
transactions/s
```

---

# 16. Data Scaling

Incrementa:

```text
rows
documents
objects
events
indexes
history
```

---

# 17. User Scaling

Incrementa usuarios activos o sesiones.

---

# 18. Tenant Scaling

Incrementa número de Tenants.

---

# 19. Geographic Scaling

Incrementa:

```text
regions
zones
locations
markets
```

---

# 20. Resource Scaling

Incrementa o reduce recursos computacionales.

---

# 21. Scale Dimensions Are Independent

Un sistema puede escalar bien en Requests y mal en Data Size.

---

# 22. Multi-Dimensional Scaling

Deberá considerarse cuando varias dimensiones aumentan simultáneamente.

---

# 23. Scale Factor

Relación entre Baseline y Target.

Ejemplo:

```text
4 nodes → 16 nodes

Resource Scale Factor = 4
```

---

# 24. Load Scale Factor

Ejemplo:

```text
2,000 RPS → 8,000 RPS

Load Scale Factor = 4
```

---

# 25. Capacity Gain

Podrá calcularse conceptualmente:

```text
Capacity Gain =
Target Sustainable Capacity
/
Baseline Sustainable Capacity
```

---

# 26. Scaling Efficiency

Conceptualmente:

```text
Scaling Efficiency =
Capacity Gain
/
Resource Scale Factor
```

---

# 27. Efficiency Example

```text
4 nodes  → 4,000 RPS
8 nodes  → 7,200 RPS

Capacity Gain      = 1.8
Resource Factor    = 2
Scaling Efficiency = 90%
```

---

# 28. Efficiency ≠ Utilization

No deberán confundirse.

---

# 29. Linear Scalability

Idealmente:

```text
2x resources
→
2x sustainable capacity
```

---

# 30. Perfect Linear Scaling

No deberá asumirse como expectativa universal.

---

# 31. Sublinear Scalability

Ejemplo:

```text
2x resources
→
1.6x capacity
```

---

# 32. Sublinear Causes

Podrán incluir:

```text
coordination
contention
shared storage
network
serialization
locks
cache coherence
partition skew
```

---

# 33. Superlinear Behavior

Puede observarse temporalmente por:

```text
cache effects
working set fit
algorithm thresholds
```

---

# 34. Superlinear ≠ Unlimited Scaling

Deberá comprobarse en mayores escalas.

---

# 35. Scaling Curve

Representa relación entre Resource Scale y Capacity/Performance.

Conceptualmente:

```text
capacity
   │
   │              ______
   │           __/
   │        __/
   │     __/
   │  __/
   │_/
   └──────────────────── resources
```

---

# 36. Scaling Curve Analysis

Deberá identificar:

```text
linear region
diminishing returns
saturation point
regression region
```

---

# 37. Strong Scaling

Mantiene Workload total aproximadamente constante mientras aumentan Resources.

Pregunta:

```text
Can the same work finish faster?
```

---

# 38. Strong Scaling Objective

Podrá medir reducción de Execution Time.

---

# 39. Weak Scaling

Aumenta Workload proporcionalmente a Resources.

Pregunta:

```text
Can each unit of resource sustain
approximately the same workload?
```

---

# 40. Weak Scaling Objective

Podrá medir estabilidad de Latency/Throughput por Resource Unit.

---

# 41. Strong vs Weak Scaling

No deberán confundirse.

---

# 42. Vertical Scalability

Modifica recursos de una misma Unit.

---

# 43. Scale Up

Incrementa:

```text
CPU
memory
storage performance
network capacity
```

---

# 44. Scale Down

Reduce dichos recursos.

---

# 45. Vertical Scaling Limit

Todo sistema tendrá límites técnicos o económicos.

---

# 46. Vertical Scaling Downtime

Podrá requerir Restart o Replacement.

---

# 47. Horizontal Scalability

Modifica número de Units.

---

# 48. Scale Out

Agrega Units.

---

# 49. Scale In

Retira Units.

---

# 50. Horizontal Scaling Preconditions

Deberá considerar:

```text
state
sessions
partitioning
coordination
shared resources
routing
dependency limits
```

---

# 51. Stateless Scaling

Favorece distribución de Requests entre Units equivalentes.

---

# 52. Stateless ≠ No State Exists

State podrá estar externalizado.

---

# 53. Externalized State

Puede convertirse en Bottleneck compartido.

---

# 54. Stateful Scaling

Requiere distribución o afinidad de State.

---

# 55. Stateful Scaling Requirements

Deberá considerar:

```text
partition ownership
state transfer
replication
consistency
recovery
rebalancing
```

---

# 56. Shared State

Puede limitar Scalability.

---

# 57. Shared Database

Agregar Application Nodes no necesariamente incrementa Database Capacity.

---

# 58. Shared Cache

Puede mejorar o limitar Scalability según:

```text
network
memory
hot keys
coherence
connection count
```

---

# 59. Shared Lock

Podrá serializar trabajo.

---

# 60. Global Mutex

Deberá considerarse Scalability Bottleneck.

---

# 61. Coordination Cost

Aumenta trabajo necesario para coordinar Units.

Ejemplos:

```text
leader election
consensus
distributed locks
membership
barriers
coordination messages
```

---

# 62. Coordination Overhead

Deberá medirse.

---

# 63. Synchronization Cost

Puede crecer con número de Participants.

---

# 64. Contention Cost

Puede aumentar con Concurrency.

---

# 65. Serialization Point

Cualquier operación que deba ejecutarse secuencialmente puede limitar Scalability.

---

# 66. Critical Section

Deberá minimizarse cuando sea Hot Path.

---

# 67. Amdahl Constraint

La parte serial limita Strong Scaling.

Conceptualmente:

```text
total work
├── parallelizable
└── serial
```

Incluso gran cantidad de Resources no elimina Serial Fraction.

---

# 68. Scalability Bottleneck

Elemento que impide obtener Capacity Gain útil al agregar Resources.

---

# 69. Bottleneck Types

Podrán incluir:

```text
CPU
memory bandwidth
database
storage I/O
network
lock
partition
broker
external API
coordination
algorithm
```

---

# 70. Bottleneck Shift

Al escalar un componente, Bottleneck puede trasladarse.

---

# 71. Scalability Limit

Punto donde aumentar Scale deja de satisfacer Objectives o produce beneficio insuficiente.

---

# 72. Limit Definition

Podrá estar determinado por:

```text
performance
cost
coordination
data model
provider quota
partition count
external dependency
```

---

# 73. Hard Limit

No puede superarse sin cambio estructural.

---

# 74. Soft Limit

Puede ampliarse mediante Configuration o Resource Change.

---

# 75. Economic Scalability Limit

Más Resources pueden ser técnicamente posibles pero económicamente ineficientes.

---

# 76. Partitioning

Divide Workload o Data en conjuntos independientes.

---

# 77. Partition Key

Determina distribución.

---

# 78. Good Partition Key

Deberá favorecer:

```text
distribution
locality
stable ownership
bounded skew
query patterns
```

---

# 79. Poor Partition Key

Puede crear Hot Partitions.

---

# 80. Partition Count

Puede limitar máximo Parallelism.

---

# 81. Partition Count Planning

Deberá considerar crecimiento futuro.

---

# 82. Too Few Partitions

Puede limitar Scale Out.

---

# 83. Too Many Partitions

Puede incrementar:

```text
metadata
coordination
memory
rebalancing
file handles
```

---

# 84. Sharding

Distribuye Data entre Stores o Nodes.

---

# 85. Shard Key

Deberá analizar:

```text
distribution
locality
cardinality
growth
query patterns
```

---

# 86. Sharding ≠ Partitioning Universally

La tecnología podrá diferenciar sus semánticas.

---

# 87. Cross-Shard Operation

Podrá introducir:

```text
network
coordination
aggregation
distributed transaction
```

---

# 88. Replication

Duplica Data o State.

---

# 89. Replication Scalability

Puede aumentar Read Capacity pero no necesariamente Write Capacity.

---

# 90. Replication Cost

Incluye:

```text
network
storage
consistency
replication lag
coordination
```

---

# 91. Read Scaling

Podrá utilizar replicas.

---

# 92. Write Scaling

Normalmente requerirá Partitioning/Sharding u otro cambio estructural.

---

# 93. Data Skew

Distribución desigual de Data.

---

# 94. Workload Skew

Distribución desigual de operaciones.

---

# 95. Hot Partition

Partition recibe carga desproporcionada.

---

# 96. Hot Key

Un Key puede concentrar tráfico incluso con muchas Partitions.

---

# 97. Skew Metrics

Podrán medir:

```text
max/average load
partition imbalance
hot-key frequency
storage imbalance
```

---

# 98. Average Partition Load

No deberá ocultar Hot Partition.

---

# 99. Skew Detection

Deberá formar parte de Observability cuando Partitioning sea crítico.

---

# 100. Skew Mitigation

Podrá incluir:

```text
better key
salting
splitting
replication
routing changes
specialized caching
```

según Contract.

---

# 101. Rebalancing

Redistribuye ownership de Workload/Data.

---

# 102. Rebalancing Trigger

Podrá ocurrir ante:

```text
scale out
scale in
node failure
skew
capacity change
```

---

# 103. Rebalancing Cost

Podrá consumir:

```text
network
CPU
disk
memory
coordination
```

---

# 104. Rebalancing Capacity Tax

Deberá considerarse dentro de Headroom.

---

# 105. Rebalancing Duration

Deberá medirse.

---

# 106. State Transfer

No deberá saturar Production Resources sin límites.

---

# 107. Rebalancing Throttle

Podrá ser necesario.

---

# 108. Rebalancing Failure

Deberá poseer Recovery.

---

# 109. Scale Out with Rebalancing

Nueva Unit no aporta Capacity plena inmediatamente.

---

# 110. Effective Scaling Delay

Podrá incluir:

```text
provision
startup
warm-up
readiness
routing
rebalance
state transfer
```

---

# 111. Scale In Rebalancing

Deberá mover State antes de retirar Owner cuando corresponda.

---

# 112. Scale In Safety

No deberá causar Data Loss.

---

# 113. Elasticity

Capacidad operacional de ajustar Resources frente a Demand.

---

# 114. Elasticity ≠ Scalability

Un sistema puede ser escalable pero tener Elasticity lenta.

---

# 115. Elastic Response

Tiempo desde señal de Scaling hasta Capacity efectiva.

---

# 116. Elasticity Delay

Conceptualmente:

```text
Scaling Trigger
      │
      ▼
Provision
      │
      ▼
Startup
      │
      ▼
Warm-Up
      │
      ▼
Readiness
      │
      ▼
Rebalance
      │
      ▼
Effective Capacity
```

---

# 117. Demand Growth Faster Than Elasticity

Puede producir Saturation temporal.

---

# 118. Predictive Capacity

Puede reducir riesgo cuando Workload es predecible.

---

# 119. Scale Transition

Periodo durante el cual diferentes tamaños/topologías coexisten.

---

# 120. Transition Safety

Deberá conservar:

```text
correctness
availability
state ownership
routing
capacity
```

---

# 121. Scale Transition State

Podrá ser:

```text
STABLE
SCALING_OUT
REBALANCING
SCALING_IN
DEGRADED
FAILED
```

---

# 122. Scaling Failure

Deberá ser observable.

---

# 123. Partial Scale-Out

Algunas Units nuevas pueden estar Ready y otras no.

---

# 124. Partial Scale-In

No deberá retirar más Capacity de la segura.

---

# 125. Scaling Rollback

Podrá restaurar Desired Capacity previa cuando sea seguro.

---

# 126. Scaling Idempotency

Operaciones de Scaling deberán tolerar Retry apropiadamente.

---

# 127. Autoscaling

ENG-071 gobierna Scaling Policy.

ENG-072 evalúa si el sistema realmente escala de forma útil.

---

# 128. Autoscaling Efficiency

Podrá comparar:

```text
resources added
vs
capacity gained
```

---

# 129. Scaling Oscillation

Deberá evitarse conforme ENG-071.

---

# 130. Scaling and Performance

ENG-070 deberá medir Performance en cada escala.

---

# 131. Performance Preservation

Scalability Requirement podrá exigir:

```text
p95 remains <= X
while load increases Yx
```

---

# 132. Tail Scalability

p99 podrá degradarse antes que p50.

---

# 133. Throughput Scalability

Deberá medirse respecto del Resource Factor.

---

# 134. Memory Scalability

Data/Users mayores pueden incrementar Working Set.

---

# 135. Connection Scalability

Agregar Nodes puede aumentar conexiones a Shared Dependencies.

---

# 136. Connection Storm

Scale Out masivo puede saturar Dependency.

---

# 137. Startup Storm

Muchas Units iniciando simultáneamente pueden saturar:

```text
database
secret provider
configuration service
service discovery
cache
```

---

# 138. Thundering Herd

Deberá mitigarse.

---

# 139. Staggered Scale-Out

Podrá utilizarse para proteger Dependencies.

---

# 140. Cache Scalability

Deberá analizar:

```text
cache capacity
hot keys
invalidation
coherence
stampede
network
```

---

# 141. Cache Warm-Up During Scale-Out

Puede reducir Capacity inicial.

---

# 142. Database Scalability

Deberá analizar:

```text
query load
connections
locks
replicas
partitioning
write contention
storage
```

---

# 143. N+1 Queries

Pueden impedir Application Scalability.

---

# 144. Database Lock Contention

Puede empeorar con más Application Nodes.

---

# 145. Messaging Scalability

Deberá analizar:

```text
partitions
consumer groups
broker nodes
producer throughput
consumer lag
ordering
```

---

# 146. Consumer Scaling

No deberá superar Parallelism permitido por Partitions.

---

# 147. Pipeline Scalability

ENG-064 deberá considerar:

```text
partitioning
workers
state
sink capacity
backpressure
checkpoint cost
```

---

# 148. Scheduler Scalability

ENG-040 deberá evitar central coordination Bottleneck.

---

# 149. Registry Scalability

ENG-020 deberá evitar global locks o scans costosos en Hot Paths.

---

# 150. Service Container Scalability

ENG-019 deberá evitar resolución repetitiva costosa en Hot Paths.

---

# 151. Multi-Tenant Scalability

ENG-048 deberá considerar:

```text
tenant count
tenant skew
resource isolation
metadata cardinality
routing
storage
```

---

# 152. Tenant Count Scaling

No deberá asumirse equivalente a User Scaling.

---

# 153. Large Tenant

Un Tenant grande puede dominar recursos.

---

# 154. Tenant Sharding

Podrá ser necesario cuando Tenant Count o Size crezcan.

---

# 155. Cross-Tenant Coordination

Deberá minimizarse.

---

# 156. Metadata Scalability

ENG-057 deberá considerar Registry/Metadata cardinality.

---

# 157. Configuration Scalability

ENG-049 deberá evitar recalcular Configuration completa por Request.

---

# 158. Discovery Scalability

ENG-058 no deberá realizar scans globales repetidos en Runtime Hot Path.

---

# 159. Resolution Scalability

ENG-059 deberá evitar búsquedas no acotadas durante operaciones frecuentes.

---

# 160. Schema Scalability

ENG-062 deberá limitar Reference/Validation complexity.

---

# 161. Transformation Scalability

ENG-063 deberá considerar:

```text
batching
parallelism
state
external enrichment
```

---

# 162. Scalability Baseline

Representa comportamiento de Scaling conocido.

---

# 163. Baseline Structure

Podrá contener:

```text
resource levels
workload levels
capacity
latency percentiles
throughput
efficiency
bottlenecks
```

---

# 164. Scalability Comparison

Compara Scaling Curves entre Versions.

---

# 165. Scalability Regression

Ocurre cuando nueva Version escala peor significativamente.

Ejemplos:

```text
lower efficiency
earlier bottleneck
higher coordination cost
higher rebalance time
higher tail latency
```

---

# 166. Scalability Regression ≠ Performance Regression

Una nueva versión puede ser más rápida con 1 Node y escalar peor a 32 Nodes.

---

# 167. Scalability Gate

Podrá utilizarse para Releases críticas.

---

# 168. Gate Requirement

Deberá poseer Baseline estable.

---

# 169. Scaling Cost

Deberá observarse.

---

# 170. Resource Efficiency

Podrá disminuir a mayores escalas.

---

# 171. Cost per Work Unit

Podrá medirse:

```text
resource units / transaction
cost / million requests
CPU-seconds / message
```

---

# 172. Economic Scalability

Deberá considerarse cuando Cost sea Contract relevante.

---

# 173. Geographic Scalability

Puede requerir:

```text
regional routing
data locality
replication
latency management
consistency model
```

---

# 174. Cross-Region Coordination

Puede limitar Scalability por Network Latency.

---

# 175. Data Locality

Deberá favorecerse cuando sea importante.

---

# 176. Global Writes

Podrán introducir Coordination Cost considerable.

---

# 177. Regional Partitioning

Podrá reducir Coordination.

---

# 178. Regulatory Constraints

Pueden limitar Geographic Scaling.

---

# 179. Scalability Security

ENG-024 gobernará Security general.

---

# 180. Scaling as Attack Surface

Un atacante podría generar:

```text
resource amplification
autoscaling amplification
partition hotspots
connection storms
```

---

# 181. Scale Limits

Deberán proteger contra crecimiento ilimitado.

---

# 182. Partition Key Abuse

Input controlado por usuario no deberá permitir crear Hot Partition trivialmente cuando pueda evitarse.

---

# 183. Tenant Scaling Abuse

Tenant no deberá obtener recursos ilimitados mediante creación masiva de objetos/partitions.

---

# 184. Rebalancing Security

State Transfer deberá preservar:

```text
authentication
authorization
encryption
tenant isolation
```

---

# 185. Scaling Operations Authorization

Scale manual deberá requerir Authority adecuada.

---

# 186. Topology Disclosure

Detalles internos no deberán exponerse innecesariamente.

---

# 187. Scalability Audit

Cambios de Scaling Architecture o Limits críticos podrán auditarse.

---

# 188. Audit Events

Podrán incluir:

```text
scalability requirement changed
partition count changed
shard strategy changed
scaling limit changed
manual scale executed
rebalance initiated
scalability gate overridden
```

---

# 189. Scalability Observability

ENG-025 gobernará Telemetry.

---

# 190. Metrics

Podrán incluir:

```text
mef.scalability.resource_factor
mef.scalability.capacity_gain
mef.scalability.efficiency
mef.scalability.rebalance.duration
mef.scalability.skew
mef.scalability.hot_partition
mef.scalability.elasticity.delay
mef.scalability.limit
```

---

# 191. Scaling Event Metrics

Podrán incluir:

```text
scale-out requested
scale-out completed
scale-in requested
scale-in completed
rebalance started
rebalance completed
```

---

# 192. Scaling Efficiency Metric

Deberá poseer Resource/Workload Scope conocido.

---

# 193. Skew Metrics

Deberán evitar usar Partition IDs como Labels cuando Cardinality sea grande.

---

# 194. Scalability Diagnostics

Deberá poder responder:

```text
what is the scale factor?
what capacity gain was achieved?
what is scaling efficiency?
where does scaling become sublinear?
which resource becomes the bottleneck?
which partitions are hot?
how long does rebalancing take?
how long until new capacity becomes effective?
what is the scalability limit?
```

---

# 195. Scalability Visualization

Podrá representarse conceptualmente:

```text
Resources   Capacity   Efficiency
1x          1.0x       100%
2x          1.9x        95%
4x          3.4x        85%
8x          5.2x        65%
16x         6.0x        37.5%
```

El sistema continúa escalando en términos absolutos, pero su eficiencia disminuye.

---

# 196. Testing

ENG-009 gobernará Testing.

---

# 197. Vertical Scaling Test

Deberá aumentar Resource Size y medir Capacity Gain.

---

# 198. Horizontal Scaling Test

Deberá aumentar Unit Count y medir Capacity Gain.

---

# 199. Strong Scaling Test

Deberá mantener Workload aproximadamente fija.

---

# 200. Weak Scaling Test

Deberá aumentar Workload proporcionalmente a Resources.

---

# 201. Scaling Efficiency Test

Deberá calcular eficiencia por Scale Level.

---

# 202. Scalability Limit Test

Deberá identificar punto de Diminishing Returns o Objective Failure.

---

# 203. Shared State Test

Deberá comprobar Bottleneck compartido.

---

# 204. Coordination Test

Deberá medir overhead al aumentar Participants.

---

# 205. Contention Test

Deberá incrementar concurrencia y medir Locks/Queues.

---

# 206. Partition Test

Deberá comprobar distribución.

---

# 207. Skew Test

Deberá introducir distribución no uniforme.

---

# 208. Hot Partition Test

Deberá comprobar capacidad del sistema de detectar/mitigar hotspot.

---

# 209. Rebalancing Test

Deberá medir:

```text
duration
resource usage
availability
capacity reduction
```

---

# 210. Scale-Out Transition Test

Deberá comprobar período hasta Capacity efectiva.

---

# 211. Scale-In Transition Test

Deberá comprobar:

```text
drain
state transfer
partition movement
capacity safety
```

---

# 212. Failure During Rebalance Test

Deberá comprobar Recovery.

---

# 213. Data Scaling Test

Deberá aumentar Dataset Size manteniendo Workload comparable.

---

# 214. Tenant Scaling Test

Deberá aumentar Tenant Count.

---

# 215. Large-Tenant Skew Test

Deberá comprobar Noisy Neighbor.

---

# 216. Geographic Scaling Test

Cuando aplique deberá medir:

```text
latency
replication
coordination
data locality
```

---

# 217. Elasticity Test

Deberá medir tiempo:

```text
trigger → effective capacity
```

---

# 218. Startup Storm Test

Deberá aumentar simultáneamente Units.

---

# 219. Connection Storm Test

Deberá comprobar Dependencies compartidas.

---

# 220. Scalability Regression Test

Deberá comparar Scaling Curves entre Baseline y Candidate.

---

# 221. Security Test

Deberá intentar:

```text
autoscaling amplification
hot-key attack
partition hotspot
resource amplification
rebalancing abuse
tenant-scale abuse
```

---

# 222. Architecture Test

Podrá impedir:

```text
"scalable" without scale dimension
horizontal scaling assumed linear
unbounded scale target
global lock in hot path
single partition bottleneck
scale-in without state transfer
scalability benchmark without baseline
```

---

# 223. Build Integration

ENG-012 podrá validar estáticamente:

```text
scalability requirement definitions
maximum scale
partition constraints
scaling limits
unsupported stateful scaling
```

---

# 224. Scalability Tests in CI

Tests grandes no deberán ejecutarse en cada Commit si su coste lo impide.

Podrán ejecutarse en:

```text
scheduled performance pipeline
release candidate pipeline
architecture validation environment
```

---

# 225. CLI

ENG-007 podrá proporcionar:

```text
mef scalability
mef scalability:requirements
mef scalability:test
mef scalability:curve
mef scalability:efficiency
mef scalability:partitions
mef scalability:skew
mef scalability:rebalance
mef scalability:limit
mef scalability:compare
mef scalability:diagnose
```

---

# 226. `mef scalability`

Podrá mostrar Snapshot general.

---

# 227. `scalability:requirements`

Podrá mostrar:

```text
dimension
baseline
target
resource factor
minimum efficiency
objectives
```

---

# 228. `scalability:test`

Podrá ejecutar Test autorizado.

---

# 229. `scalability:curve`

Podrá mostrar:

```text
resource factor
capacity
latency
throughput
efficiency
```

---

# 230. `scalability:efficiency`

Podrá calcular Efficiency por nivel.

---

# 231. `scalability:partitions`

Podrá mostrar:

```text
count
ownership
distribution
capacity
```

---

# 232. `scalability:skew`

Podrá mostrar:

```text
load distribution
data distribution
hot partitions
hot keys
```

---

# 233. `scalability:rebalance`

Podrá mostrar:

```text
state
progress
duration
bytes moved
capacity impact
```

---

# 234. `scalability:limit`

Podrá mostrar Bottleneck y Scale Limit estimados.

---

# 235. `scalability:compare`

Podrá comparar Baseline/Candidate Scaling Curves.

---

# 236. `scalability:diagnose`

Podrá mostrar:

```text
scale dimension
resource levels
workload levels
capacity gain
efficiency
bottlenecks
coordination overhead
skew
rebalancing
elasticity delay
scale limit
```

---

# 237. Registry Integration

ENG-020 podrá registrar:

```text
ScalabilityRequirement
ScalabilityBaseline
ScalabilityModel
ScalabilityPolicy
ScalabilityGate
```

---

# 238. Scalability Requirement Contract

Conceptualmente:

```text
ScalabilityRequirement
├── id
├── scope
├── dimension
├── baseline
├── targetScale
├── workload
├── performanceObjectives
├── minimumEfficiency
└── metadata
```

---

# 239. Scalability Measurement

Conceptualmente:

```text
ScalabilityMeasurement
├── scaleFactor
├── resourceConfiguration
├── workload
├── sustainableCapacity
├── latency
├── throughput
├── efficiency
├── bottleneck
└── observedAt
```

---

# 240. Scalability Curve

Conceptualmente:

```text
ScalabilityCurve
├── measurements[]
├── linearRegion
├── diminishingRegion
├── limit
└── metadata
```

---

# 241. Scalability Baseline

Conceptualmente:

```text
ScalabilityBaseline
├── version
├── environment
├── workload
├── measurements
├── bottlenecks
└── recordedAt
```

---

# 242. Scalability Comparison

Conceptualmente:

```text
ScalabilityComparison
├── baseline
├── candidate
├── efficiencyDelta
├── limitDelta
├── regressions
└── improvements
```

---

# 243. Partition Distribution

Conceptualmente:

```text
PartitionDistribution
├── partitions
├── load
├── dataSize
├── skew
└── hotspots
```

---

# 244. Rebalance Plan

Conceptualmente:

```text
RebalancePlan
├── sourceOwnership
├── targetOwnership
├── movements
├── throttle
├── estimatedCost
└── recovery
```

---

# 245. Scalability Runtime

Conceptualmente:

```text
ScalabilityRuntime
├── measure
├── evaluate
├── curve
├── efficiency
├── skew
├── rebalance
├── limit
└── diagnose
```

---

# 246. Scalability State

Podrá clasificarse:

```text
SCALABLE
DEGRADED
BOTTLENECKED
LIMIT_REACHED
REBALANCING
UNKNOWN
```

---

# 247. SCALABLE

El sistema continúa obteniendo Capacity Gain conforme Requirements.

---

# 248. DEGRADED

Continúa escalando, pero Efficiency o Performance se han deteriorado significativamente.

---

# 249. BOTTLENECKED

Un recurso compartido limita mejoras adicionales.

---

# 250. LIMIT_REACHED

La siguiente escala no satisface Requirements o no produce beneficio suficiente.

---

# 251. REBALANCING

El sistema se encuentra redistribuyendo State/Ownership.

---

# 252. UNKNOWN

No existen mediciones suficientes.

---

# 253. UNKNOWN ≠ SCALABLE

No deberá declararse Scalability por ausencia de evidencia contraria.

---

# 254. Scalability Policy

Podrá determinar:

```text
minimum efficiency
maximum coordination overhead
maximum skew
maximum rebalance time
scale limit
```

---

# 255. Minimum Scaling Efficiency

Deberá ser específica del sistema.

No existe un porcentaje universal.

---

# 256. Scalability Ownership

Todo Requirement deberá poseer Owner.

---

# 257. Architecture Ownership

Cambios estructurales como:

```text
sharding
partitioning
replication
state distribution
```

deberán poseer Ownership claro.

---

# 258. First Implementation Components

La primera implementación deberá incluir:

```text
ScalabilityState

ScalabilityRequirement
ScalabilityMeasurement
ScalabilityBaseline

ScalabilityCurve
ScalabilityComparison

ScalingEfficiency

ScalabilityPolicy
ScalabilityRuntime

ScalabilityRegistry
ScalabilityError
```

---

# 259. Optional Initial Components

Podrán incorporarse:

```text
PartitionDistribution
SkewAnalyzer

RebalancePlan
RebalanceRuntime

ScalabilityGate
ScalabilityDiagnostics
```

---

# 260. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Partition Tuning
Adaptive Sharding
Predictive Rebalancing
Cross-Region Scaling Optimizer
Automatic Bottleneck Elimination
AI-Assisted Scalability Optimization
```

---

# 261. Estructura Conceptual de Directorios

```text
src/
└── Scalability/
    ├── State/
    │   └── ScalabilityState
    │
    ├── Requirement/
    │   └── ScalabilityRequirement
    │
    ├── Measurement/
    │   └── ScalabilityMeasurement
    │
    ├── Baseline/
    │   └── ScalabilityBaseline
    │
    ├── Curve/
    │   └── ScalabilityCurve
    │
    ├── Efficiency/
    │   └── ScalingEfficiency
    │
    ├── Comparison/
    │   └── ScalabilityComparison
    │
    ├── Partition/
    │   └── PartitionDistribution
    │
    ├── Skew/
    │   └── SkewAnalyzer
    │
    ├── Rebalance/
    │   ├── RebalancePlan
    │   └── RebalanceRuntime
    │
    ├── Policy/
    │   └── ScalabilityPolicy
    │
    ├── Gate/
    │   └── ScalabilityGate
    │
    ├── Runtime/
    │   └── ScalabilityRuntime
    │
    ├── Registry/
    │   └── ScalabilityRegistry
    │
    ├── Diagnostics/
    │   └── ScalabilityDiagnostics
    │
    └── Error/
        └── ScalabilityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 262. Error Namespace

ENG-072 utilizará:

```text
MEF-SCALABILITY-xxx
```

---

# 263. Taxonomía ENG-072

```text
MEF-SCALABILITY-001 Scalability requirement invalid
MEF-SCALABILITY-002 Scalability dimension invalid
MEF-SCALABILITY-003 Scalability baseline missing
MEF-SCALABILITY-004 Scalability baseline incompatible
MEF-SCALABILITY-005 Scalability measurement invalid
MEF-SCALABILITY-006 Scalability efficiency insufficient
MEF-SCALABILITY-007 Scalability bottleneck detected
MEF-SCALABILITY-008 Scalability limit reached
MEF-SCALABILITY-009 Scalability regression detected
MEF-SCALABILITY-010 Horizontal scaling failed
MEF-SCALABILITY-011 Vertical scaling failed
MEF-SCALABILITY-012 Stateful scaling unsupported
MEF-SCALABILITY-013 Partitioning invalid
MEF-SCALABILITY-014 Partition count insufficient
MEF-SCALABILITY-015 Partition skew detected
MEF-SCALABILITY-016 Hot partition detected
MEF-SCALABILITY-017 Hot key detected
MEF-SCALABILITY-018 Rebalance failed
MEF-SCALABILITY-019 Rebalance timeout
MEF-SCALABILITY-020 State transfer failed
MEF-SCALABILITY-021 Scaling transition failed
MEF-SCALABILITY-022 Elasticity delay exceeded
MEF-SCALABILITY-023 Coordination overhead exceeded
MEF-SCALABILITY-024 Scaling resource limit reached
MEF-SCALABILITY-025 Scaling provider limit reached
MEF-SCALABILITY-026 Scalability tenant violation
MEF-SCALABILITY-027 Scalability test unauthorized
MEF-SCALABILITY-028 Scalability security violation
MEF-SCALABILITY-029 Scalability state unknown
MEF-SCALABILITY-030 Scalability invariant violation
```

---

# 264. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Scalability Requirements
Explicit Scale Dimensions

Baseline / Target Scale

Resource Factor
Capacity Gain
Scaling Efficiency

Vertical / Horizontal distinction

Strong / Weak Scaling distinction

Scaling Curves
Scalability Limits
Bottleneck Detection

Shared-State Awareness
Coordination / Contention Awareness

Partitioning
Skew Detection
Hot Partition Detection

Rebalancing Awareness
Effective Scaling Delay

Scalability Regression

Security
Observability
Testing
```

---

# 265. First Version Non-Goals

No deberá requerir:

```text
Automatic Partition Tuning
Adaptive Sharding
Predictive Rebalancing
Cross-Region Scaling Optimizer
Automatic Bottleneck Elimination
AI-Assisted Scalability Optimization
```

---

# 266. Second Phase

Podrá incorporar:

```text
Skew Analyzer
Rebalance Plans
Scalability Gates

Advanced Strong/Weak Scaling Analysis

Geographic Scalability
Cost per Work Unit

Advanced Stateful Scaling
```

---

# 267. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Partition Tuning
Adaptive Sharding
Predictive Rebalancing
Cross-Region Scaling Optimization
Automatic Bottleneck Remediation
AI-Assisted Scalability Optimization
```

---

# 268. Invariantes de Ingeniería

ENG-072 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1386 | Toda afirmación contractual de Scalability deberá declarar Scope, Scale Dimension, Baseline, Target Scale, Resource Factor, Workload, Performance Objectives y Efficiency Requirement suficientes para ser comprobable. |
| EI-1387 | Scalability deberá permanecer diferenciada de Performance, Capacity, Elasticity, Distribution y Availability y ninguna arquitectura deberá declararse escalable únicamente porque pueda añadir Resources o Nodes. |
| EI-1388 | Capacity Gain y Scaling Efficiency deberán medirse respecto de Resource Scale y Sustainable Capacity y duplicar Resources no deberá asumirse equivalente a duplicar Capacity. |
| EI-1389 | Strong Scaling y Weak Scaling deberán mantenerse diferenciados y los Tests deberán declarar si mantienen Workload total o Workload por Resource Unit aproximadamente constante. |
| EI-1390 | Vertical y Horizontal Scaling deberán considerar límites técnicos, State, Sessions, Coordination, Shared Resources, Routing, Dependency Capacity y Downtime/Transition Costs según corresponda. |
| EI-1391 | Shared State, Global Locks, Serialization Points, Coordination, Synchronization y Contention deberán tratarse como posibles Scalability Bottlenecks y no ocultarse mediante aumento de Application Nodes. |
| EI-1392 | Scalability Limits deberán identificarse explícitamente y podrán ser técnicos, contractuales, externos o económicos; el sistema no deberá asumir Scale Out ilimitado. |
| EI-1393 | Partitioning y Sharding deberán utilizar Keys cuya Distribution, Cardinality, Locality, Growth y Query Patterns hayan sido evaluados y un aumento de Partition Count no deberá considerarse gratuito. |
| EI-1394 | Data Skew, Workload Skew, Hot Partitions y Hot Keys deberán ser observables cuando puedan limitar Capacity y los promedios de Partition Load no deberán ocultar Hotspots. |
| EI-1395 | Stateful Scaling deberá declarar Ownership, State Transfer, Replication, Consistency, Recovery y Rebalancing y Scale-In no deberá destruir State ni retirar Owners antes de completar transferencia requerida. |
| EI-1396 | Rebalancing deberá tratarse como operación con Resource Cost y Capacity Tax explícitos y ningún sistema deberá asumir que una nueva Unit aporta Capacity plena antes de completar Startup, Readiness y State Redistribution requerida. |
| EI-1397 | Elasticity Delay deberá medir el tiempo desde Scaling Trigger hasta Capacity efectiva, incluyendo Provisioning, Startup, Warm-Up, Readiness, Routing y Rebalancing cuando correspondan. |
| EI-1398 | Scaling Transitions deberán preservar Correctness, Availability, State Ownership y Capacity y los estados parciales de Scale-Out/Scale-In/Rebalancing deberán ser observables y recuperables. |
| EI-1399 | Scaling de Application Nodes deberá considerar Connection Storms, Startup Storms y capacidad de Shared Dependencies y no deberá multiplicar carga externa de forma no acotada. |
| EI-1400 | Multi-Tenant Scalability deberá considerar Tenant Count, Tenant Size, Skew, Resource Isolation y Metadata Cardinality y un Tenant dominante no deberá determinar por sí solo la Capacity disponible para los demás sin Policy explícita. |
| EI-1401 | Scalability Baselines deberán registrar Version, Environment, Resource Levels, Workloads, Capacity, Latency, Efficiency y Bottlenecks y Scalability Regression deberá permanecer diferenciada de Performance Regression en una sola escala. |
| EI-1402 | Scalability Security deberá limitar Resource/Autoscaling Amplification, Hot-Key/Partition Attacks, Tenant-Scale Abuse y Rebalancing Abuse y deberá proteger State Transfer y Topology Information. |
| EI-1403 | Scalability Observability deberá permitir determinar Scale Factor, Capacity Gain, Efficiency, Bottlenecks, Skew, Rebalancing Cost, Elasticity Delay y Scalability Limit mediante Metrics de Scope y Cardinality controlados. |
| EI-1404 | Scalability Testing deberá cubrir Vertical, Horizontal, Strong, Weak, Efficiency, Limits, Shared State, Coordination, Contention, Partitioning, Skew, Hotspots, Rebalancing, Stateful Transition, Data/Tenant Scaling, Elasticity, Startup/Connection Storms, Security y Regression según Architecture. |
| EI-1405 | La primera implementación deberá priorizar Requirements, Scale Dimensions, Capacity Gain, Scaling Efficiency, Scaling Curves, Limits, Bottleneck Awareness, Shared-State/Coordination Costs, Partitioning, Skew, Rebalancing, Elasticity Delay y Regression Detection antes de introducir Adaptive Sharding, Predictive Rebalancing o Automatic Scalability Optimization. |

---

# 269. Continuidad de Invariantes

```text
ENG-068 → EI-1306 a EI-1325
ENG-069 → EI-1326 a EI-1345
ENG-070 → EI-1346 a EI-1365
ENG-071 → EI-1366 a EI-1385
ENG-072 → EI-1386 a EI-1405
```

---

# 270. Criterios de Conformidad

Una implementación será conforme con ENG-072 cuando:

- defina Scalability Requirements explícitos;
- declare Scale Dimension;
- declare Baseline;
- declare Target Scale;
- declare Workload;
- mida Resource Scale Factor;
- mida Capacity Gain;
- calcule Scaling Efficiency;
- diferencie Strong y Weak Scaling;
- diferencie Vertical y Horizontal Scaling;
- construya Scaling Curves;
- detecte Diminishing Returns;
- identifique Scalability Limits;
- identifique Bottlenecks;
- evalúe Shared State;
- evalúe Coordination;
- evalúe Contention;
- evalúe Serialization Points;
- controle Partitioning;
- analice Partition Keys;
- detecte Data Skew;
- detecte Workload Skew;
- detecte Hot Partitions;
- detecte Hot Keys;
- controle Rebalancing;
- mida Rebalancing Cost;
- mida Effective Scaling Delay;
- preserve State durante Scale-In;
- controle Connection/Startup Storms;
- detecte Scalability Regressions;
- preserve Tenant Isolation;
- aplique Security;
- implemente Observability;
- implemente Testing.

---

# 271. Riesgos

Deberán evitarse especialmente:

```text
"Scalable" Without Dimension
More Nodes Equals Scalability
Distributed Equals Scalable

Scale Out Assumed Linear
Unlimited Scale Target

Strong/Weak Scaling Confusion

Stateless Means No State
Externalized State Bottleneck Ignored

Shared Database Ignored
Global Lock
Serialization Point

Too Few Partitions
Too Many Partitions
Bad Shard Key
Hot Partition
Hot Key
Average Hides Skew

Scale Out Before Rebalance Complete
Scale In Before State Transfer
Rebalancing Without Throttle

Elasticity Equals Immediate Capacity
Scaling Trigger Equals Effective Capacity

Startup Storm
Connection Storm
Thundering Herd

One Tenant Dominates System
Tenant Count Equals User Count

Single-Node Performance Equals Scalability

Scaling Without Cost Measurement
```

---

# 272. Relación con ENG-070

Performance mide cada punto de la Scaling Curve:

```text
Scale 1
→ Performance

Scale 2
→ Performance

Scale 4
→ Performance

Scale 8
→ Performance
```

ENG-072 compara esos puntos.

---

# 273. Relación con ENG-071

Capacity determina Sustainable Capacity para cada configuración.

ENG-072 determina cómo cambia dicha Capacity al modificar escala.

```text
Resources 1x
    │
    ▼
Capacity A

Resources 2x
    │
    ▼
Capacity B

Resources 4x
    │
    ▼
Capacity C
```

---

# 274. Relación con ENG-038

Concurrency es una dimensión de ejecución.

Scalability analiza qué ocurre cuando aumenta Concurrency y número de Workers/Nodes.

---

# 275. Relación con ENG-053

State Management deberá soportar Ownership, Transfer y Recovery requeridos por Stateful Scaling.

---

# 276. Relación con ENG-054

Resource Management controla Resources reales.

Scalability analiza la ganancia obtenida al incrementarlos.

---

# 277. Relación con ENG-064

Data Pipeline podrá escalar mediante:

```text
partitions
workers
stages
sinks
```

pero deberá respetar Ordering, State y Backpressure.

---

# 278. Relación con ENG-048

Multi-Tenancy Scaling deberá preservar Isolation y evitar Noisy Neighbor.

---

# 279. Relación con ENG-073

**ENG-073 deberá formalizar Availability Engineering.**

La separación será:

```text
PERFORMANCE
ENG-070
→ How fast?

CAPACITY
ENG-071
→ How much sustainable workload?

SCALABILITY
ENG-072
→ How does capacity/performance
  change with scale?

AVAILABILITY
ENG-073
→ For what proportion of required time
  can the system successfully provide
  its intended service?
```

ENG-073 deberá cubrir:

```text
Availability
Availability Requirement
Availability Objective

Service Availability
Component Availability

Uptime
Downtime

Availability Window
Measurement Period

Planned Downtime
Unplanned Downtime

Availability Budget
Downtime Budget

Failure
Outage
Partial Outage

Availability State

Redundancy
Failover
Failback

Active-Active
Active-Passive

Failure Domain
Fault Isolation

Availability Zone
Region

Single Point of Failure
SPOF Detection

Dependency Availability
Composite Availability

Graceful Degradation
Partial Availability

Maintenance Availability

Availability Measurement
Availability Calculation

Availability Security
Availability Audit
Availability Observability
Availability Testing
```

---

# 280. Principio Rector

> **MEF deberá demostrar Scalability mediante curvas y mediciones, no mediante etiquetas arquitectónicas. Añadir Resources solo constituye escalamiento útil cuando produce Capacity Gain suficiente dentro de los Performance Objectives definidos y sin introducir Coordination, Contention, Skew, Rebalancing o Cost que hagan la nueva escala ineficiente o insegura.**

---

# 281. Conclusión

**ENG-072 — Scalability Engineering** formaliza cómo MEF se comporta cuando cambia su escala.

La secuencia fundamental queda:

```text
BASELINE
   │
   ▼
Scale Resources / Workload
   │
   ▼
MEASURE
   │
   ├── Capacity
   ├── Latency
   ├── Throughput
   ├── Efficiency
   ├── Coordination
   └── Skew
   │
   ▼
SCALABILITY CURVE
```

La eficiencia queda:

```text
Capacity Gain
     │
     ▼
──────────────────
Resource Scale
     │
     ▼
Scaling Efficiency
```

Ejemplo:

```text
1x resources → 1.0x capacity → 100%
2x resources → 1.9x capacity → 95%
4x resources → 3.4x capacity → 85%
8x resources → 5.2x capacity → 65%
```

El sistema sigue aumentando Capacity, pero entra en una zona de **Diminishing Returns**.

La curva conceptual queda:

```text
Capacity
   │
   │                    ────── Scalability Limit
   │                ___/
   │             __/
   │          __/
   │       __/
   │    __/
   │ __/
   └──────────────────────────── Resources
      linear      diminishing
```

Stateful Scaling queda:

```text
ADD NODE
   │
   ▼
START
   │
   ▼
READY
   │
   ▼
STATE TRANSFER
   │
   ▼
REBALANCE
   │
   ▼
NEW OWNERSHIP
   │
   ▼
EFFECTIVE CAPACITY
```

No:

```text
node created
=
capacity available
```

El problema de Skew queda:

```text
Partition A ████████████████
Partition B ███
Partition C ██
Partition D ███

Average load
   │
   X
   │
does not reveal
   │
   ▼
HOT PARTITION A
```

El Scale Out con Bottleneck compartido queda:

```text
APP NODE ──┐
APP NODE ──┼──► DATABASE
APP NODE ──┤
APP NODE ──┘
             │
             ▼
         BOTTLENECK
```

Agregar Application Nodes puede incluso empeorar el sistema si aumenta:

```text
connections
locks
queries
coordination
```

La relación entre los tres documentos queda:

```text
PERFORMANCE
ENG-070
│
└── behavior of one configuration
        │
        ▼
CAPACITY
ENG-071
│
└── sustainable workload of that configuration
        │
        ▼
SCALABILITY
ENG-072
│
└── relationship across configurations
```

La cadena reciente queda:

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
```

La primera implementación deberá concentrarse en:

```text
ScalabilityState

ScalabilityRequirement
ScalabilityMeasurement
ScalabilityBaseline

ScalabilityCurve
ScalabilityComparison

ScalingEfficiency

ScalabilityPolicy
ScalabilityRuntime

ScalabilityRegistry
ScalabilityError
```

con:

```text
Explicit Scale Dimensions
Baseline / Target Scale
Resource Factors
Capacity Gain
Scaling Efficiency
Strong / Weak Scaling
Vertical / Horizontal Scaling
Scaling Curves
Scalability Limits
Bottleneck Detection
Shared State Awareness
Coordination / Contention Analysis
Partitioning
Skew
Hot Partitions
Rebalancing
Elasticity Delay
Scalability Regression
Security
Observability
Testing
```

antes de introducir:

```text
Automatic Partition Tuning
Adaptive Sharding
Predictive Rebalancing
Cross-Region Scaling Optimization
Automatic Bottleneck Remediation
AI-Assisted Scalability Optimization
```

Con **ENG-072**, la serie global alcanza:

```text
EI-1405
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
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-034 — Application Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-057 — Metadata Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-068 — Environment Engineering
- ENG-069 — Health & Readiness Engineering
- ENG-070 — Performance Engineering
- ENG-071 — Capacity Engineering
- ENG-073 — Availability Engineering
```