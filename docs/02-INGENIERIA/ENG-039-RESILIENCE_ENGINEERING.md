---
id: ENG-039
titulo: Resilience Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Resilience Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-011
  - ENG-016
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-032
  - ENG-034
  - ENG-037
  - ENG-038
relacionados:
  - ENG-006
  - ENG-012
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-022
  - ENG-031
  - ENG-033
  - ENG-035
  - ENG-036
  - ENG-040
keywords:
  - resilience
  - timeout
  - deadline
  - retry
  - backoff
  - jitter
  - circuit-breaker
  - bulkhead
  - fallback
  - load-shedding
  - graceful-degradation
  - recovery
  - failure
  - dependency
  - mef
---

# ENG-039

# Resilience Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Resilience Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-039 establece las reglas para:

```text
Failure Classification
Timeout
Deadline
Cancellation
Retry
Retry Budget
Backoff
Jitter
Circuit Breaker
Bulkhead
Fallback
Graceful Degradation
Load Shedding
Dependency Isolation
Resource Saturation
Failure Propagation
Partial Failure
Recovery
Health
Readiness
Liveness
Resilience Policy
Resilience Observability
Resilience Testing
```

---

# 2. Declaración

La regla fundamental será:

> **MEF deberá asumir que toda Dependency puede fallar, degradarse, responder lentamente o quedar parcialmente disponible, y deberá limitar el impacto de dicho Failure mediante Policies explícitas y acotadas.**

La jerarquía conceptual será:

```text
Dependency Call
      │
      ▼
Deadline / Timeout
      │
      ▼
Failure Classification
      │
      ├── Retryable
      │       │
      │       ▼
      │  Retry Policy
      │
      ├── Non-Retryable
      │       │
      │       ▼
      │    Propagate
      │
      └── Degradable
              │
              ▼
          Fallback
```

Complementada por:

```text
Circuit Breaker
Bulkhead
Load Shedding
Recovery
Observability
```

---

# 3. Resilience

`Resilience` es la capacidad del sistema para mantener comportamiento correcto o degradado de forma controlada ante Failures.

---

# 4. Resilience ≠ Availability

Un sistema puede permanecer disponible pero entregar resultados incorrectos.

MEF deberá priorizar:

```text
Correctness
+
Controlled Availability
```

---

# 5. Resilience ≠ Retry

Retry es únicamente una de varias estrategias.

---

# 6. Failure

Un `Failure` es una condición que impide completar una operación según su Contract.

---

# 7. Failure Sources

Podrán incluir:

```text
network
database
cache
filesystem
external API
resource exhaustion
timeout
invalid response
dependency outage
runtime failure
concurrency conflict
```

---

# 8. Partial Failure

En sistemas distribuidos deberá asumirse que:

```text
Component A
→ healthy

Component B
→ degraded

Component C
→ unavailable
```

pueden coexistir.

---

# 9. Failure Classification

Antes de aplicar Retry o Fallback deberá clasificarse el Failure.

---

# 10. Failure Categories

MEF deberá distinguir conceptualmente:

```text
Transient
Persistent
Permanent
Validation
Conflict
Authorization
Timeout
Cancellation
Overload
Dependency
Unknown
```

---

# 11. Transient Failure

Puede desaparecer sin modificación de la Request.

Ejemplos:

```text
temporary network interruption
short dependency overload
temporary connection failure
```

---

# 12. Persistent Failure

Puede continuar durante un periodo significativo.

Ejemplo:

```text
dependency outage
```

---

# 13. Permanent Failure

No se resolverá simplemente reintentando.

Ejemplos:

```text
invalid credentials
unsupported operation
malformed request
```

---

# 14. Validation Failure

ENG-036 gobernará Validation.

No deberá reintentarse automáticamente.

---

# 15. Authorization Failure

ENG-024 gobernará Security.

Normalmente no deberá reintentarse.

---

# 16. Concurrency Conflict

ENG-038 gobernará Concurrency.

Podrá ser Retryable únicamente cuando el Use Case lo permita.

---

# 17. Unknown Failure

Deberá tratarse conservadoramente.

---

# 18. Failure Classification Contract

MEF podrá proporcionar:

```text
FailureClassifier
```

---

# 19. Classification Output

Conceptualmente:

```text
FailureClassification
├── category
├── retryable
├── degradable
├── severity
└── metadata
```

---

# 20. Timeout

Un `Timeout` limita cuánto tiempo puede esperar una operación.

---

# 21. Every Remote Call

Toda llamada remota deberá poseer Timeout explícito o heredar un Deadline acotado.

---

# 22. Infinite Timeout

No deberá ser el Default.

---

# 23. Timeout Purpose

Evita que:

```text
slow dependency
→
blocked resources
→
queue growth
→
resource exhaustion
→
system-wide failure
```

---

# 24. Timeout Selection

Deberá considerar:

```text
dependency latency
SLO
caller deadline
retry strategy
network overhead
processing cost
```

---

# 25. Timeout Too Long

Puede producir Saturation.

---

# 26. Timeout Too Short

Puede generar Failures artificiales.

---

# 27. Deadline

Un `Deadline` representa el tiempo máximo restante para completar una operación completa.

---

# 28. Deadline Propagation

Deberá propagarse cuando sea técnicamente posible.

```text
Request Deadline
      │
      ▼
Application
      │
      ▼
Transport
      │
      ▼
Dependency
```

---

# 29. Child Timeout

Una operación hija no deberá utilizar un Timeout superior al Deadline restante del Caller.

---

# 30. Deadline Budget

Conceptualmente:

```text
remaining =
requestDeadline - now
```

---

# 31. Retry Deadline

Todo Retry deberá caber dentro del Deadline restante.

---

# 32. Deadline Exhausted

No deberá iniciarse nuevo trabajo significativo.

---

# 33. Monotonic Time

ENG-038 deberá favorecer Clock monotónico para medir Duration/Deadline local.

---

# 34. Cancellation

Cuando el Caller ya no necesita el resultado, deberá propagarse Cancellation cuando sea seguro.

---

# 35. Cancellation ≠ Failure

Deberá conservarse como categoría diferenciada.

---

# 36. Cancellation ≠ Rollback

Cancelar no revierte Side Effects ya realizados.

---

# 37. Cancellation Boundary

Operaciones críticas podrán requerir completar una sección atómica antes de observar Cancellation.

---

# 38. Retry

Un `Retry` vuelve a intentar una operación después de un Failure elegible.

---

# 39. Retry Principle

> **Nunca deberá aplicarse Retry sin conocer por qué la operación falló y si repetirla es seguro.**

---

# 40. Retryable Failures

Podrán incluir:

```text
temporary network error
selected timeout
temporary dependency unavailable
deadlock when safe
optimistic conflict when safe
```

---

# 41. Non-Retryable Failures

Normalmente incluirán:

```text
validation failure
authentication failure
authorization failure
unsupported operation
permanent contract violation
```

---

# 42. Retry Limit

Todo Retry deberá poseer:

```text
maxAttempts
```

o límite equivalente.

---

# 43. Infinite Retry

No deberá utilizarse dentro de Request Processing.

---

# 44. Retry Deadline

Además de Attempts deberá respetarse Deadline.

---

# 45. Retry Policy

Conceptualmente:

```text
RetryPolicy
├── maxAttempts
├── initialDelay
├── maxDelay
├── backoff
├── jitter
├── retryableFailures
└── budget
```

---

# 46. Retry Attempt

El intento inicial deberá diferenciarse de los Retries en Telemetry.

---

# 47. Immediate Retry

Puede ser útil para Failures extremadamente transitorios.

No deberá repetirse indiscriminadamente.

---

# 48. Retry Storm

Muchos Clients reintentando simultáneamente pueden impedir la recuperación de una Dependency.

---

# 49. Retry Amplification

Ejemplo:

```text
Service A retries 3x
      │
      ▼
Service B retries 3x
      │
      ▼
Service C

Potential attempts:
3 × 3 = 9
```

---

# 50. Retry Layer

Deberá evitarse aplicar Retry redundante en múltiples Layers sin coordinación.

---

# 51. Retry Ownership

Una Boundary deberá ser responsable principal de Retry.

---

# 52. Backoff

`Backoff` introduce espera entre Attempts.

---

# 53. Exponential Backoff

Podrá utilizar:

```text
delay_n =
base × 2^n
```

con límite.

---

# 54. Maximum Backoff

Deberá existir.

---

# 55. Backoff ≠ Busy Wait

La espera deberá liberar recursos cuando el Runtime lo permita.

---

# 56. Jitter

`Jitter` introduce variación para evitar sincronización masiva.

---

# 57. Jitter Purpose

Evita:

```text
1000 clients fail
      │
      ▼
all wait 1 second
      │
      ▼
all retry simultaneously
```

---

# 58. Jitter Strategies

Podrán utilizarse:

```text
full jitter
equal jitter
decorrelated jitter
```

según implementación.

---

# 59. Retry Budget

Un `Retry Budget` limita cuánto tráfico adicional puede producir Retry.

---

# 60. Retry Budget Purpose

Evita que Recovery Traffic supere Original Traffic de forma no controlada.

---

# 61. Budget Scope

Podrá definirse por:

```text
dependency
operation
tenant
runtime
```

---

# 62. Retry Budget Exhausted

Nuevos Retries deberán detenerse o degradarse según Policy.

---

# 63. Idempotency

Antes de reintentar operaciones con Side Effects deberá analizarse Idempotency.

---

# 64. Safe Retry

Será seguro cuando:

```text
operation is naturally idempotent
```

o:

```text
idempotency key protects effect
```

o exista mecanismo equivalente.

---

# 65. Unknown Commit State

Caso crítico:

```text
Client sends payment
Server commits
Network fails before response
```

El Client no sabe si el efecto ocurrió.

---

# 66. Ambiguous Outcome

No deberá resolverse mediante Retry ciego.

---

# 67. Idempotency Key

ENG-038/ENG-032 podrán proteger Requests repetidas.

---

# 68. Retry Side Effects

Toda operación Retryable con Side Effects deberá documentar su garantía.

---

# 69. Circuit Breaker

Un `Circuit Breaker` evita continuar enviando Calls a una Dependency que presenta Failure sostenido.

---

# 70. Circuit States

```text
CLOSED
  │
  │ failures exceed threshold
  ▼
OPEN
  │
  │ recovery delay
  ▼
HALF_OPEN
  │
  ├── success → CLOSED
  │
  └── failure → OPEN
```

---

# 71. CLOSED

Calls pasan normalmente.

---

# 72. OPEN

Calls se rechazan rápidamente.

---

# 73. HALF_OPEN

Se permiten Calls de prueba limitadas.

---

# 74. Circuit Scope

Deberá corresponder a Failure Domain.

Ejemplos:

```text
dependency
endpoint
operation
region
```

---

# 75. Global Circuit

No deberá utilizarse si una sola operación defectuosa puede bloquear operaciones saludables independientes.

---

# 76. Circuit Threshold

Deberá considerar volumen suficiente.

---

# 77. Low Traffic

Un porcentaje sobre muy pocas Requests puede producir decisiones incorrectas.

---

# 78. Failure Window

Podrá utilizar:

```text
count-based
time-based
```

---

# 79. Circuit Failure Classification

No todos los Failures deberán contar.

---

# 80. Validation Error

No deberá abrir Circuit.

---

# 81. Authorization Error

Normalmente tampoco.

---

# 82. Dependency Timeout

Sí podrá contribuir.

---

# 83. Circuit Open Failure

Deberá distinguirse de Dependency Failure original.

---

# 84. Circuit Recovery

HALF_OPEN deberá limitar Calls simultáneas.

---

# 85. Circuit Oscillation

Deberá evitarse abrir/cerrar excesivamente.

---

# 86. Circuit Breaker ≠ Health Check

Son mecanismos distintos.

---

# 87. Bulkhead

Un `Bulkhead` limita cuánto recurso puede consumir un Failure Domain.

---

# 88. Bulkhead Principle

```text
Failure in A
≠
Resource exhaustion in B
```

---

# 89. Bulkhead Resources

Podrá aislar:

```text
threads
workers
connections
queues
memory
concurrency slots
```

---

# 90. Dependency Bulkhead

Una Dependency lenta no deberá consumir todos los Workers del Runtime.

---

# 91. Tenant Bulkhead

Podrá utilizarse para evitar que un Tenant monopolice recursos.

---

# 92. Bulkhead Limit

Deberá configurarse y medirse.

---

# 93. Bulkhead Saturation

Podrá producir:

```text
reject
queue
fallback
```

según Policy.

---

# 94. Bounded Queue

Si se utiliza Queue deberá poseer Capacity.

---

# 95. Infinite Queue

No deberá utilizarse como estrategia de Resilience.

---

# 96. Queueing Delay

Deberá contar contra Deadline.

---

# 97. Bulkhead ≠ Rate Limiter

Bulkhead limita concurrencia/recursos.

Rate Limiter limita frecuencia.

---

# 98. Fallback

Un `Fallback` proporciona una respuesta alternativa cuando la operación principal falla.

---

# 99. Fallback Correctness

Un Fallback no deberá inventar datos que el Contract presenta como autoritativos.

---

# 100. Fallback Types

Podrán incluir:

```text
cached value
stale value
default value
secondary dependency
reduced functionality
partial result
```

---

# 101. Stale Fallback

ENG-037 gobernará Cache Staleness.

---

# 102. Security-Sensitive Fallback

No deberá reutilizar datos que puedan violar Authorization actual.

---

# 103. Default Value

Solo deberá utilizarse cuando semánticamente sea válido.

---

# 104. Empty Result Fallback

No deberá convertir:

```text
dependency unavailable
```

en:

```text
no records exist
```

si ambas condiciones poseen significado diferente.

---

# 105. Secondary Dependency

Podrá utilizarse como Fallback.

---

# 106. Correlated Failure

Deberá analizarse si Primary y Secondary dependen de la misma infraestructura.

---

# 107. Fallback Failure

También deberá estar acotado.

---

# 108. Fallback Chain

No deberá crecer indefinidamente.

---

# 109. Graceful Degradation

Permite reducir funcionalidad conservando capacidades esenciales.

---

# 110. Example

```text
Recommendation Engine unavailable
          │
          ▼
Product Catalog remains available
without recommendations
```

---

# 111. Degradation Contract

La respuesta deberá indicar degradación cuando ello sea relevante para Consumer.

---

# 112. Silent Degradation

No deberá ocultar pérdida de Correctness.

---

# 113. Optional Capability

Es candidata natural a Graceful Degradation.

---

# 114. Critical Capability

Puede requerir Fail Closed.

---

# 115. Load Shedding

`Load Shedding` rechaza trabajo para proteger la estabilidad del sistema.

---

# 116. Load Shedding Principle

> **Es preferible rechazar una fracción controlada del trabajo que aceptar todo y colapsar completamente.**

---

# 117. Shedding Signals

Podrán incluir:

```text
queue depth
worker saturation
memory pressure
dependency saturation
deadline probability
```

---

# 118. Early Rejection

Deberá favorecerse cuando el sistema sabe que no podrá cumplir el Deadline.

---

# 119. Admission Control

Decide si una operación puede entrar al sistema.

---

# 120. Admission Criteria

Podrán considerar:

```text
priority
tenant
operation cost
resource availability
deadline
```

---

# 121. Priority

Work crítico podrá recibir prioridad.

---

# 122. Priority Starvation

No deberá provocar Starvation permanente de Work normal.

---

# 123. Overload

Deberá representarse explícitamente.

---

# 124. Overload Error

ENG-039 utilizará una categoría diferenciada.

---

# 125. Backpressure

Producers deberán reducir producción cuando Consumers no puedan mantener el ritmo.

---

# 126. Backpressure Mechanisms

Podrán incluir:

```text
bounded queues
flow control
rejection
pull-based consumption
concurrency limits
```

---

# 127. Backpressure Propagation

Deberá propagarse cuando sea posible en lugar de acumular Work ilimitado.

---

# 128. Dependency Isolation

Cada Dependency relevante deberá poseer Failure Boundary.

---

# 129. Failure Domain

Podrá ser:

```text
database
cache
payment service
email provider
search engine
external API
```

---

# 130. Dependency Policy

Conceptualmente:

```text
DependencyPolicy
├── timeout
├── retry
├── circuitBreaker
├── bulkhead
├── fallback
└── telemetry
```

---

# 131. Policy Composition

El orden de Policies deberá ser explícito.

---

# 132. Example Composition

Conceptualmente:

```text
Bulkhead
   │
   ▼
Circuit Breaker
   │
   ▼
Retry
   │
   ▼
Timeout
   │
   ▼
Dependency
```

La composición real dependerá del Contract.

---

# 133. Policy Order Matters

Cambiar el orden puede alterar:

```text
metrics
failure counting
resource usage
latency
```

---

# 134. Retry + Circuit

El Circuit deberá observar Failures de manera coherente con Attempts y Calls lógicas.

---

# 135. Timeout + Retry

Cada Attempt podrá tener Timeout, pero todos deberán compartir Deadline global.

---

# 136. Bulkhead + Retry

Retries deberán consumir Capacity controlada.

---

# 137. Fallback + Circuit

Fallback podrá activarse ante Circuit Open.

---

# 138. Policy Explosion

No toda Dependency necesita todas las Policies.

---

# 139. Minimal Policy

Deberá utilizarse la menor combinación suficiente.

---

# 140. Resilience Policy

MEF deberá proporcionar una representación explícita.

Conceptualmente:

```text
ResiliencePolicy
├── timeout
├── deadline
├── retry
├── circuitBreaker
├── bulkhead
├── fallback
└── metadata
```

---

# 141. Named Policy

Podrán existir Policies reutilizables:

```text
external-api-default
database-read
payment-write
cache-optional
```

---

# 142. Policy Ownership

Toda Policy deberá poseer Owner.

---

# 143. Policy Override

Un Module podrá especializar Policy dentro de límites arquitectónicos.

---

# 144. Configuration

ENG-011 gobernará Configuration.

---

# 145. Example Configuration

```text
resilience:
  external-api:
    timeout: 2s

    retry:
      max-attempts: 3
      backoff: exponential
      jitter: true

    circuit-breaker:
      failure-threshold: 50%
      minimum-calls: 20

    bulkhead:
      max-concurrency: 25
      queue-capacity: 50
```

---

# 146. Configuration Validation

ENG-036 deberá validar combinaciones imposibles o peligrosas.

---

# 147. Invalid Example

```text
timeout: 10s
deadline: 2s
```

sin semántica específica no deberá aceptarse.

---

# 148. Retry Delay vs Deadline

Deberá comprobarse que la Policy pueda ejecutar dentro del Budget.

---

# 149. Zero Timeout

No deberá aceptarse salvo semántica explícita de Non-Blocking.

---

# 150. Unlimited Retry

Deberá rechazarse para Request Processing.

---

# 151. Unlimited Queue

También.

---

# 152. Runtime Integration

ENG-027 deberá construir Resilience Infrastructure.

---

# 153. Bootstrap

Conceptualmente:

```text
Load Configuration
       │
       ▼
Validate Policies
       │
       ▼
Build Failure Classifiers
       │
       ▼
Build Resilience Registry
       │
       ▼
Bind Dependency Policies
       │
       ▼
Readiness
```

---

# 154. Resilience Registry

ENG-020 podrá mantener:

```text
ResiliencePolicyDefinition
```

---

# 155. Registry Entry

Conceptualmente:

```text
ResiliencePolicyDefinition
├── id
├── dependency
├── timeout
├── retry
├── circuit
├── bulkhead
├── fallback
└── metadata
```

---

# 156. Immutable Registry

Después de Bootstrap deberá favorecerse inmutabilidad.

---

# 157. Dynamic Policy

Cambios dinámicos deberán ser atómicos y observables.

---

# 158. Service Container

ENG-019 construirá componentes de Resilience mediante Contracts.

---

# 159. Dependency Injection

ENG-018 deberá evitar dependencia directa de Vendor Libraries.

---

# 160. Transport

ENG-032 deberá propagar:

```text
deadline
cancellation
idempotency
retry metadata when required
```

---

# 161. Persistence

ENG-030 deberá definir qué Failures son Retryable.

---

# 162. Database Timeout

Deberá ser coherente con Request Deadline.

---

# 163. Database Retry

No deberá repetirse una Transaction con Side Effects externos no protegidos.

---

# 164. Deadlock Retry

Podrá ser válido cuando la Transaction completa sea segura de repetir.

---

# 165. Serialization Failure

ENG-031 normalmente será Non-Retryable sin cambio de Input/Software State.

---

# 166. Cache Resilience

ENG-037 podrá utilizar:

```text
timeout
bypass
serve-stale
circuit breaker
```

---

# 167. Optional Cache

Failure debería normalmente degradar a Source.

---

# 168. Cache Retry

Deberá ser limitado porque Cache suele ser una optimización.

---

# 169. Concurrency

ENG-038 gobernará:

```text
bounded concurrency
locks
leases
idempotency
conflicts
```

---

# 170. Retry Conflict

No deberá aplicarse automáticamente a todos los Concurrency Conflicts.

---

# 171. Application

ENG-034 deberá decidir si el Use Case permite:

```text
fallback
partial result
degradation
retry
```

---

# 172. Domain

ENG-035 no deberá depender de Circuit Breakers o Retry Libraries.

---

# 173. Domain Invariant

Resilience no deberá violar una Invariant para aumentar Availability.

---

# 174. Security

ENG-024 continuará teniendo prioridad.

---

# 175. Security Failure

No deberá transformarse en Success mediante Fallback inseguro.

---

# 176. Fail Open

Solo deberá utilizarse cuando el Threat Model lo permita.

---

# 177. Fail Closed

Deberá favorecerse para controles de Security críticos.

---

# 178. Observability

ENG-025 gobernará Telemetry.

---

# 179. Resilience Metrics

Podrán incluir:

```text
mef.resilience.calls.total
mef.resilience.failures.total
mef.resilience.timeouts.total
mef.resilience.retries.total
mef.resilience.retry.exhausted.total
mef.resilience.circuit.open.total
mef.resilience.bulkhead.rejected.total
mef.resilience.fallback.total
mef.resilience.load_shed.total
```

---

# 180. Retry Metrics

Deberán distinguir:

```text
logical request
attempt
retry
```

---

# 181. Circuit Metrics

Podrán incluir:

```text
state
transitions
rejected calls
half-open probes
```

---

# 182. Bulkhead Metrics

Podrán incluir:

```text
active
queued
rejected
wait duration
```

---

# 183. Fallback Metrics

Deberán permitir conocer cuánto tráfico opera degradado.

---

# 184. Hidden Fallback

Un sistema no deberá permanecer degradado durante semanas sin visibilidad.

---

# 185. Load Shedding Metrics

Deberán distinguir rechazo por Overload de Failure funcional.

---

# 186. Telemetry Cardinality

Dependency IDs deberán ser controlados.

---

# 187. Trace

Cada Attempt remoto podrá producir Span según ENG-025.

---

# 188. Retry Trace

Deberá ser posible identificar Attempts pertenecientes a la misma operación lógica.

---

# 189. Circuit Open Trace

Podrá registrarse sin realizar Network Call.

---

# 190. Logs

Eventos relevantes:

```text
circuit opened
circuit closed
retry exhausted
bulkhead saturated
fallback activated
load shedding activated
```

---

# 191. Log Storm

No deberá producirse un Log por cada Failure cuando una Dependency está completamente caída sin Sampling/aggregation apropiados.

---

# 192. Health

Resilience deberá integrarse con Health Model del Runtime.

---

# 193. Liveness

Responde conceptualmente:

```text
Is this process alive and capable of making progress?
```

---

# 194. Readiness

Responde:

```text
Can this instance currently serve its required workload?
```

---

# 195. Dependency Failure and Liveness

Una Dependency externa caída no deberá marcar automáticamente el proceso como Dead.

---

# 196. Dependency Failure and Readiness

Solo deberá afectar Readiness cuando sea indispensable para servir Work requerido.

---

# 197. Optional Dependency

No deberá impedir Readiness.

---

# 198. Health Check Timeout

Todo Health Check remoto deberá poseer Timeout corto.

---

# 199. Health Check Storm

No deberá amplificar una caída mediante Checks excesivos.

---

# 200. Deep Health Check

No deberá ejecutarse indiscriminadamente en cada Probe.

---

# 201. Startup

Podrá existir Startup Health separado.

---

# 202. Recovery

Un sistema resiliente deberá considerar cómo vuelve a estado saludable.

---

# 203. Recovery ≠ Restart

Reiniciar no deberá ser la única estrategia.

---

# 204. Recovery Actions

Podrán incluir:

```text
circuit half-open
connection recreation
cache repopulation
worker restart
queue drain
dependency reconnection
```

---

# 205. Recovery Storm

Miles de Instances recuperándose simultáneamente pueden volver a saturar una Dependency.

---

# 206. Recovery Jitter

Podrá utilizarse.

---

# 207. Gradual Recovery

Deberá favorecerse cuando una Dependency haya estado saturada.

---

# 208. Half-Open Probe Limit

Deberá limitarse.

---

# 209. Warm-Up

Recovery podrá requerir Warm-Up controlado.

---

# 210. Cache Warm-Up

ENG-037 gobernará Cache.

---

# 211. Connection Recovery

Pools deberán evitar reconexión masiva sincronizada.

---

# 212. Graceful Shutdown

ENG-027 gobernará Shutdown.

---

# 213. Drain

Durante Shutdown deberá:

```text
stop accepting new work
allow in-flight work
respect deadline
release resources
```

---

# 214. Shutdown Timeout

Deberá ser acotado.

---

# 215. Failure Propagation

Un Failure deberá propagarse con contexto suficiente.

---

# 216. Failure Translation

ENG-023 gobernará Error Translation.

---

# 217. Vendor Error

No deberá escapar directamente hacia Application/Domain.

---

# 218. Failure Cause

Deberá preservarse internamente cuando sea seguro.

---

# 219. Failure Context

Podrá incluir:

```text
dependency
operation
attempt
timeout
policy
```

---

# 220. Sensitive Data

No deberá incluirse innecesariamente.

---

# 221. Error Namespace

ENG-039 utilizará:

```text
MEF-RES-xxx
```

---

# 222. Taxonomía ENG-039

```text
MEF-RES-001 Dependency unavailable
MEF-RES-002 Dependency timeout
MEF-RES-003 Deadline exceeded
MEF-RES-004 Retry exhausted
MEF-RES-005 Retry budget exhausted
MEF-RES-006 Circuit open
MEF-RES-007 Circuit configuration invalid
MEF-RES-008 Bulkhead saturated
MEF-RES-009 Bulkhead queue full
MEF-RES-010 Fallback unavailable
MEF-RES-011 Fallback failed
MEF-RES-012 Load shed
MEF-RES-013 Overload detected
MEF-RES-014 Dependency degraded
MEF-RES-015 Health check failed
MEF-RES-016 Recovery failed
MEF-RES-017 Resilience configuration invalid
MEF-RES-018 Failure classification unknown
MEF-RES-019 Resilience contract violation
MEF-RES-020 Resilience invariant violation
```

---

# 223. Dependency Timeout

```text
MEF-RES-002

Dependency timeout.

Dependency:
payment-service

Operation:
authorize

Timeout:
2s
```

---

# 224. Deadline Exceeded

```text
MEF-RES-003

Request deadline exceeded.

Operation:
CreateOrder
```

---

# 225. Circuit Open

```text
MEF-RES-006

Circuit breaker open.

Dependency:
search-service
```

---

# 226. Bulkhead Saturated

```text
MEF-RES-008

Bulkhead saturated.

Dependency:
external-report-service

Active:
25

Limit:
25
```

---

# 227. Retry Exhausted

```text
MEF-RES-004

Retry attempts exhausted.

Dependency:
customer-api

Attempts:
3
```

---

# 228. Load Shed

```text
MEF-RES-012

Request rejected due to overload.

Operation:
GenerateReport
```

---

# 229. Error Translation

Consumers no deberán conocer Vendor Exceptions.

---

# 230. Retryable Metadata

Podrá acompañar internamente al Failure.

---

# 231. Client Retry Hint

Transport podrá exponer información apropiada como:

```text
Retry-After
```

cuando Contract/Protocol lo permita.

---

# 232. Retry-After

No deberá prometer recuperación exacta si no puede conocerse.

---

# 233. Testing

ENG-009 gobernará Testing.

---

# 234. Timeout Test

Deberá comprobar:

```text
slow dependency
→ timeout
```

sin Sleeps innecesariamente largos.

---

# 235. Fake Clock

Podrá utilizarse cuando sea técnicamente viable.

---

# 236. Retry Test

Deberá comprobar:

```text
attempt count
classification
backoff
deadline
```

---

# 237. Non-Retryable Test

Validation/Security Failure no deberá reintentarse.

---

# 238. Retry Exhaustion Test

Deberá comprobar límite.

---

# 239. Retry Budget Test

También.

---

# 240. Circuit Breaker Test

Deberá comprobar:

```text
CLOSED
OPEN
HALF_OPEN
CLOSED
```

y:

```text
HALF_OPEN
→ OPEN
```

---

# 241. Circuit Classification Test

Failures excluidos no deberán abrir Circuit.

---

# 242. Bulkhead Test

Deberá comprobar:

```text
capacity
queue
rejection
release
```

---

# 243. Fallback Test

Deberá comprobar activación únicamente para Failures elegibles.

---

# 244. Fallback Correctness Test

Deberá comprobar que no transforme Failure semántico en Success incorrecto.

---

# 245. Load Shedding Test

Deberá comprobar rechazo bajo Saturation.

---

# 246. Recovery Test

Deberá comprobar retorno gradual.

---

# 247. Dependency Outage Test

Deberá comprobar comportamiento durante caída completa.

---

# 248. Slow Dependency Test

Será especialmente importante.

---

# 249. Partial Failure Test

Deberá comprobar que una Dependency fallida no derribe capacidades independientes.

---

# 250. Retry Storm Test

Podrá comprobar Jitter/Budget.

---

# 251. Recovery Storm Test

Podrá comprobar Half-Open Limits.

---

# 252. Chaos Testing

Podrá introducir:

```text
latency
timeouts
connection resets
dependency outage
partial responses
resource saturation
```

---

# 253. Chaos Scope

Deberá estar controlado.

---

# 254. Production Chaos

No será requisito de primera versión.

---

# 255. Fault Injection

Podrá existir en Test Environment.

---

# 256. Resilience Contract Test

Adapters remotos podrán compartir Test Suite.

---

# 257. Performance

ENG-026 gobernará Performance.

---

# 258. Resilience Overhead

Policies introducen costo.

---

# 259. Circuit Fast Failure

Puede reducir Latency durante Outage.

---

# 260. Retry Latency

Puede aumentar Tail Latency.

---

# 261. Fallback Latency

Deberá incluirse en Deadline.

---

# 262. Queue Latency

También.

---

# 263. Tail Latency

Deberán observarse:

```text
p95
p99
```

cuando sea relevante.

---

# 264. Saturation

Deberá correlacionarse con:

```text
latency
timeouts
rejections
```

---

# 265. Resilience Benchmark

Podrán existir:

```text
BM-RES-TIMEOUT
BM-RES-CIRCUIT
BM-RES-BULKHEAD
BM-RES-RETRY
```

---

# 266. Build Integration

ENG-012 podrá validar:

```text
missing timeout
unbounded retry
unbounded queue
invalid policy composition
missing resilience policy
```

---

# 267. Architecture Test

Podrá impedir:

```text
Domain
→ CircuitBreakerVendor
```

---

# 268. Static Validation

Podrá detectar Remote Clients sin Policy cuando sean gestionados por MEF.

---

# 269. Documentation

Toda Dependency crítica deberá documentar:

```text
owner
criticality
timeout
retry
idempotency
circuit
bulkhead
fallback
degradation
```

---

# 270. Dependency Inventory

Podrá generarse automáticamente.

---

# 271. Inventory Example

```text
Dependency:
payment-service

Criticality:
critical

Timeout:
2s

Retry:
disabled for ambiguous writes

Circuit:
enabled

Bulkhead:
10

Fallback:
none

Failure Mode:
fail closed
```

---

# 272. Resilience Decision Record

Policies críticas podrán requerir ADR.

---

# 273. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
ResiliencePolicy
FailureClassifier
FailureClassification
TimeoutPolicy
Deadline
RetryPolicy
BackoffStrategy
JitterStrategy
CircuitBreaker
CircuitState
Bulkhead
Fallback
ResilienceError
```

---

# 274. Optional Initial Components

Podrán incorporarse:

```text
RetryBudget
LoadShedder
AdmissionController
DependencyHealth
```

---

# 275. Circuit Breaker Contract

Conceptualmente:

```text
CircuitBreaker
├── allowRequest()
├── recordSuccess()
├── recordFailure()
└── state()
```

---

# 276. Bulkhead Contract

Conceptualmente:

```text
Bulkhead
├── acquire()
├── release()
├── active()
└── capacity()
```

---

# 277. Deadline Contract

Conceptualmente:

```text
Deadline
├── expiresAt
├── remaining()
├── isExpired()
└── childTimeout(max)
```

---

# 278. Failure Classifier Contract

Conceptualmente:

```text
FailureClassifier
    classify(Throwable)
        → FailureClassification
```

---

# 279. Fallback Contract

Conceptualmente:

```text
Fallback<T>
    execute(FailureContext)
        → T
```

---

# 280. Conceptual Directory Structure

```text
src/
└── Resilience/
    ├── Contract/
    │   ├── FailureClassifier
    │   ├── CircuitBreaker
    │   ├── Bulkhead
    │   └── Fallback
    │
    ├── Policy/
    │   ├── ResiliencePolicy
    │   ├── TimeoutPolicy
    │   ├── RetryPolicy
    │   └── BulkheadPolicy
    │
    ├── Deadline/
    │   └── Deadline
    │
    ├── Retry/
    │   ├── BackoffStrategy
    │   ├── JitterStrategy
    │   └── RetryBudget
    │
    ├── Circuit/
    │   ├── CircuitBreaker
    │   └── CircuitState
    │
    ├── Bulkhead/
    │   └── Bulkhead
    │
    ├── Failure/
    │   ├── FailureClassification
    │   └── FailureContext
    │
    ├── Fallback/
    │   └── Fallback
    │
    ├── Overload/
    │   ├── LoadShedder
    │   └── AdmissionController
    │
    └── Error/
        └── ResilienceError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 281. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Timeouts
Deadline Propagation
Failure Classification
Bounded Retry
Exponential Backoff
Jitter
Circuit Breaker
Bounded Bulkhead
Safe Fallback
Dependency Isolation
Graceful Degradation
Observability
Resilience Tests
```

---

# 282. First Version Non-Goals

No deberá requerir:

```text
Adaptive Machine-Learned Retry
Global Traffic Controller
Cross-Region Failover Engine
Custom Service Mesh
Custom Consensus
Predictive Failure Detection
Automatic Chaos Platform
```

---

# 283. Second Phase

Podrá incorporar:

```text
Retry Budgets
Load Shedding
Admission Control
Dynamic Policies
Advanced Dependency Health
Fault Injection Toolkit
```

---

# 284. Third Phase

Solo cuando exista necesidad demostrada:

```text
Adaptive Concurrency
Cross-Region Resilience
Predictive Load Shedding
Automated Recovery Optimization
Advanced Chaos Engineering
```

---

# 285. Invariantes de Ingeniería

ENG-039 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-726 | Toda Dependency remota deberá poseer Timeout explícito o Deadline acotado que impida espera indefinida. |
| EI-727 | Ninguna operación hija deberá disponer de más tiempo que el Deadline restante de su Caller salvo Contract explícitamente desacoplado. |
| EI-728 | Todo Failure deberá clasificarse antes de aplicar Retry, Fallback o Circuit Breaker cuando dicha clasificación afecte Correctness. |
| EI-729 | Todo Retry deberá estar limitado por Attempts, Deadline o Budget y no deberá ejecutarse indefinidamente dentro de Request Processing. |
| EI-730 | Operaciones con Side Effects no deberán reintentarse automáticamente sin garantía de Idempotency o mecanismo equivalente. |
| EI-731 | Backoff y Jitter deberán utilizarse cuando Retries simultáneos puedan amplificar un Failure o impedir Recovery. |
| EI-732 | Retry no deberá duplicarse indiscriminadamente en múltiples Layers produciendo Retry Amplification. |
| EI-733 | Circuit Breaker deberá contar únicamente Failures relevantes para la salud de su Failure Domain. |
| EI-734 | Circuit Scope deberá corresponder al Failure Domain real y no bloquear capacidades independientes innecesariamente. |
| EI-735 | Bulkheads, Worker Pools y Queues utilizados para Resilience deberán poseer Capacity acotada. |
| EI-736 | Fallback no deberá convertir indisponibilidad, error o incertidumbre en un resultado autoritativo incorrecto. |
| EI-737 | Graceful Degradation deberá preservar Domain Invariants y Security aunque reduzca funcionalidad. |
| EI-738 | El sistema deberá poder rechazar Work bajo Overload antes de permitir Resource Exhaustion sistémico. |
| EI-739 | Backpressure deberá propagarse o traducirse en Capacity/Rejection explícita en lugar de acumulación ilimitada. |
| EI-740 | Toda Dependency crítica deberá poseer Failure Boundary y Policy de Resilience identificables. |
| EI-741 | Cancellation deberá propagarse cuando sea seguro, pero nunca deberá asumirse que revierte Side Effects ya realizados. |
| EI-742 | Health, Readiness y Liveness deberán modelarse separadamente y una Dependency opcional caída no deberá matar artificialmente una instancia saludable. |
| EI-743 | Recovery deberá ser gradual cuando una recuperación simultánea pueda volver a saturar la Dependency. |
| EI-744 | Resilience deberá ser observable mediante Attempts, Timeouts, Retries, Circuit State, Saturation, Fallbacks, Load Shedding y Recovery. |
| EI-745 | La primera implementación deberá favorecer Policies simples, explícitas, acotadas y medibles antes de introducir mecanismos adaptativos o coordinación global avanzada. |

---

# 286. Continuidad de Invariantes

```text
ENG-035 → EI-646 a EI-665
ENG-036 → EI-666 a EI-685
ENG-037 → EI-686 a EI-705
ENG-038 → EI-706 a EI-725
ENG-039 → EI-726 a EI-745
```

---

# 287. Criterios de Conformidad

Una implementación será conforme con ENG-039 cuando:

- clasifique Failures relevantes;
- utilice Timeout en Calls remotas;
- propague Deadline cuando corresponda;
- preserve Cancellation semantics;
- limite Retries;
- utilice Backoff;
- utilice Jitter cuando exista riesgo de sincronización;
- analice Idempotency;
- evite Retry Amplification;
- soporte Circuit Breaker;
- delimite Circuit Scope;
- soporte Bulkhead;
- utilice Capacity acotada;
- permita Fallback seguro;
- preserve Domain Correctness;
- preserve Security;
- permita Graceful Degradation;
- soporte Backpressure;
- permita Load Shedding cuando sea necesario;
- diferencie Liveness y Readiness;
- contemple Recovery;
- integre Observability;
- disponga de Resilience Tests;
- no acople Domain a Vendor Libraries.

---

# 288. Riesgos

Deberán evitarse especialmente:

## Retry Everything

Todo Failure se reintenta.

## Retry Forever

No existe límite.

## Retry Amplification

Cada Layer multiplica Attempts.

## Retry Storm

Miles de Clients reintentan simultáneamente.

## No Timeout

Una Dependency bloquea recursos indefinidamente.

## Timeout Larger Than Deadline

La operación hija continúa cuando el Caller ya no puede esperar.

## Blind Write Retry

Un Side Effect ambiguo se ejecuta dos veces.

## Circuit Everything

Se utiliza Circuit Breaker donde no aporta valor.

## Global Circuit

Una operación defectuosa bloquea otras saludables.

## Unbounded Bulkhead Queue

La Queue oculta Saturation hasta agotar memoria.

## Fake Fallback

Se devuelve un Value aparentemente válido cuando realmente existe Failure.

## Empty-on-Error

Un Error se convierte en colección vacía.

## Security Fail-Open

Un Failure de autorización permite acceso.

## Cascading Failure

Una Dependency lenta consume recursos de todo el sistema.

## Health Check Cascade

Health Checks agravan la caída.

## Recovery Storm

Todas las Instances regresan simultáneamente.

## Hidden Degradation

Fallback se vuelve comportamiento permanente sin Telemetry.

## Restart as Resilience

Todo Failure se intenta solucionar reiniciando.

---

# 289. Relación con ENG-023

Error Handling clasificará y traducirá Failures sin exponer Exceptions del proveedor.

---

# 290. Relación con ENG-024

Security tendrá prioridad sobre Availability cuando un Fallback pueda ampliar privilegios o exponer información.

---

# 291. Relación con ENG-025

Observability permitirá determinar si Resilience está:

```text
protecting the system
```

o:

```text
hiding a persistent failure
```

---

# 292. Relación con ENG-026

Performance Engineering definirá:

```text
latency budgets
capacity
saturation points
tail latency
```

---

# 293. Relación con ENG-027

Runtime gestionará:

```text
deadlines
cancellation
health
readiness
shutdown
recovery
```

---

# 294. Relación con ENG-030

Persistence definirá Transaction Retry y Failure semantics.

---

# 295. Relación con ENG-032

Transport propagará Deadline, Cancellation, Retry Hints e Idempotency Metadata cuando corresponda.

---

# 296. Relación con ENG-034

Application decidirá qué degradaciones son semánticamente válidas para cada Use Case.

---

# 297. Relación con ENG-035

Domain seguirá definiendo Correctness.

La regla será:

```text
Resilience
≠
permission to violate Domain invariants
```

---

# 298. Relación con ENG-037

Caching podrá proporcionar Fallback/Stale Data únicamente dentro de su Staleness y Security Contract.

---

# 299. Relación con ENG-038

Concurrency limitará ejecución simultánea e Idempotency.

Resilience gobernará comportamiento ante Failure.

```text
Concurrency
→ how simultaneous work interacts

Resilience
→ how failing work is contained/recovered
```

---

# 300. Relación con ENG-040

ENG-040 deberá formalizar **Scheduling & Background Jobs Engineering**.

La separación será:

```text
Resilience
→ survive and contain failure

Scheduling
→ determine when deferred/background work executes
```

ENG-040 deberá cubrir:

```text
Job
Scheduler
Queue
Worker
Delayed Job
Recurring Job
Cron
Job State
Job Retry
Job Timeout
Job Lease
Job Idempotency
Job Deduplication
Dead Letter
Poison Job
Job Priority
Job Cancellation
Job Recovery
Job Observability
```

---

# 301. Principio Rector

> **MEF deberá diseñar cada interacción con una Dependency bajo la premisa de que puede fallar o responder lentamente, limitando tiempo, concurrencia, repetición y propagación del Failure sin sacrificar Correctness ni Security.**

---

# 302. Conclusión

**ENG-039 — Resilience Engineering** formaliza cómo MEF contiene y recupera Failures.

La arquitectura principal queda:

```text
                    REQUEST
                       │
                       ▼
                   DEADLINE
                       │
                       ▼
                    POLICY
                       │
        ┌──────────────┼──────────────┐
        │              │              │
        ▼              ▼              ▼
     BULKHEAD       CIRCUIT         RETRY
        │              │              │
        └──────────────┼──────────────┘
                       ▼
                    TIMEOUT
                       │
                       ▼
                  DEPENDENCY
                       │
              ┌────────┴────────┐
              │                 │
           SUCCESS            FAILURE
              │                 │
              ▼                 ▼
           RESULT        CLASSIFICATION
                                │
                    ┌───────────┼───────────┐
                    ▼           ▼           ▼
                  RETRY      FALLBACK    PROPAGATE
```

La separación conceptual queda:

```text
Timeout
→ maximum wait for an operation

Deadline
→ maximum remaining time for complete work

Retry
→ repeat eligible failed operation

Backoff
→ delay between retries

Jitter
→ desynchronize retries

Circuit Breaker
→ stop calling failing dependency

Bulkhead
→ isolate resource consumption

Fallback
→ controlled alternative result

Graceful Degradation
→ reduced but valid functionality

Load Shedding
→ reject work to preserve stability

Backpressure
→ prevent unlimited work accumulation

Recovery
→ controlled return to healthy operation
```

La primera implementación deberá concentrarse en:

```text
ResiliencePolicy
FailureClassifier
FailureClassification
TimeoutPolicy
Deadline
RetryPolicy
BackoffStrategy
JitterStrategy
CircuitBreaker
CircuitState
Bulkhead
Fallback
ResilienceError

+
Explicit Timeouts
Deadline Propagation
Bounded Retry
Dependency Isolation
Safe Fallback
Observability
Resilience Tests
```

antes de introducir:

```text
Adaptive Retry
Predictive Failure Detection
Cross-Region Failover
Global Traffic Control
Advanced Chaos Engineering
Machine-Learned Resilience Policies
```

Con **ENG-039** la serie global alcanza:

```text
EI-745
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-026 — Performance Engineering
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-040 — Scheduling & Background Jobs Engineering