---
id: ENG-069
titulo: Health & Readiness Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Health & Readiness Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-016
  - ENG-020
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-028
  - ENG-034
  - ENG-036
  - ENG-039
  - ENG-048
  - ENG-049
  - ENG-054
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-058
  - ENG-059
  - ENG-061
  - ENG-067
  - ENG-068
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-014
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-021
  - ENG-022
  - ENG-026
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-037
  - ENG-038
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-053
  - ENG-060
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-070
keywords:
  - health
  - readiness
  - liveness
  - startup
  - health-check
  - health-probe
  - health-status
  - health-result
  - degraded
  - unhealthy
  - health-aggregation
  - dependency-health
  - health-gate
  - readiness-gate
  - startup-gate
  - probe-timeout
  - health-freshness
  - health-endpoint
  - mef
---

# ENG-069

# Health & Readiness Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Health & Readiness Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-069 establece las reglas para:

```text
Health
Health Check
Health Probe

Liveness
Readiness
Startup

Health Status
Health Result

Healthy
Degraded
Unhealthy
Unknown

Health Component
Health Dependency

Critical Health Check
Required Health Check
Optional Health Check

Composite Health
Health Aggregation

Health Policy
Health Gate
Readiness Gate
Startup Gate

Probe Timeout
Probe Interval

Failure Threshold
Success Threshold

Grace Period
Warm-Up Period

Dependency Health
External Health

Health Cache
Health Freshness
Health Staleness

Health Endpoint

Health Security
Health Audit
Health Observability
Health Testing
```

---

# 2. Declaración

> **MEF deberá mantener separadas las nociones de Liveness, Startup, Health y Readiness. Un proceso vivo no deberá considerarse automáticamente sano, un componente sano no deberá considerarse automáticamente Ready, y la indisponibilidad de una Dependency opcional no deberá convertir automáticamente toda la Application en Unhealthy. Todo resultado de Health deberá poseer Scope, Status, Timestamp, Freshness y Policy de agregación explícitos.**

Arquitectura conceptual:

```text
                    COMPONENT
                        │
            ┌───────────┼───────────┐
            ▼           ▼           ▼
         STARTUP     LIVENESS     HEALTH
            │           │           │
            └───────────┼───────────┘
                        ▼
                    READINESS
                        │
                   ┌────┴────┐
                   ▼         ▼
                 READY    NOT READY
                   │
                   ▼
             RECEIVE WORK
```

---

# 3. Health & Readiness Engineering

Responde:

```text
Is the process alive?
Has startup completed?
Is the component healthy?
Is it degraded?
Is it ready to receive traffic?
Which dependency is unhealthy?
Is the result fresh?
Which checks are critical?
How are multiple checks aggregated?
When should a deployment stop?
When should traffic be removed?
```

---

# 4. Health

`Health` representa el estado operacional observado de un componente dentro de un Scope conocido.

---

# 5. Health ≠ Liveness

Liveness responde:

```text
Should this process continue to be considered alive?
```

Health responde:

```text
Is this component operating correctly?
```

---

# 6. Health ≠ Readiness

Health responde:

```text
Is it functioning?
```

Readiness responde:

```text
May it receive new work?
```

---

# 7. Health ≠ Startup

Startup determina si Initialization requerida terminó.

---

# 8. Health ≠ Availability

Un componente local puede estar Healthy mientras una ruta funcional completa esté unavailable por una dependencia externa.

---

# 9. Health ≠ Monitoring

Health produce señales.

Monitoring consume esas señales junto con Telemetry de ENG-025.

---

# 10. Liveness

Liveness deberá responder exclusivamente si Runtime debe seguir considerándose operativo.

---

# 11. Liveness Principle

Una Liveness Probe no deberá realizar comprobaciones externas innecesarias.

---

# 12. Dependency in Liveness

Una base de datos inaccesible no deberá matar automáticamente el proceso si éste puede recuperarse cuando la base vuelva.

---

# 13. Liveness Failure

Podrá justificar Restart cuando Runtime esté irrecuperablemente bloqueado o corrupto.

---

# 14. Restart Loop

Una Liveness mal diseñada no deberá provocar:

```text
dependency outage
      │
      ▼
liveness failure
      │
      ▼
restart
      │
      ▼
dependency still down
      │
      ▼
restart loop
```

---

# 15. Startup

Startup determina si Initialization inicial requerida terminó.

---

# 16. Startup Probe

Podrá proteger aplicaciones con inicialización larga.

---

# 17. Startup Success

Deberá indicar que Runtime alcanzó estado suficiente para que Liveness/Readiness normales gobiernen.

---

# 18. Startup Failure

Deberá distinguir:

```text
still initializing
initialization failed
startup timeout
```

---

# 19. Startup Timeout

Deberá ser explícito.

---

# 20. Warm-Up

Podrá formar parte de Startup o Deployment.

---

# 21. Warm-Up ≠ Ready Automatically

El fin de Warm-Up deberá validarse antes de Readiness.

---

# 22. Readiness

Readiness representa capacidad actual para aceptar nuevo trabajo conforme al Contract.

---

# 23. Ready

Un componente Ready puede recibir:

```text
requests
messages
jobs
events
traffic
```

según su función.

---

# 24. Not Ready

Deberá impedir asignación de nuevo trabajo cuando Routing/Infrastructure lo permita.

---

# 25. Readiness Failure

No deberá provocar automáticamente Restart.

---

# 26. Temporary Not Ready

Podrá utilizarse durante:

```text
startup
drain
dependency outage
resource saturation
maintenance
migration
deployment
```

---

# 27. Drain and Readiness

Al iniciar Drain:

```text
READY
  │
  ▼
NOT READY
  │
  ▼
stop new work
  │
  ▼
finish in-flight work
```

---

# 28. Health Status

El modelo mínimo deberá incluir:

```text
HEALTHY
DEGRADED
UNHEALTHY
UNKNOWN
```

---

# 29. HEALTHY

El componente satisface Health Policy requerida.

---

# 30. DEGRADED

El componente continúa operativo, pero existe capacidad reducida o Dependency/Capability afectada.

---

# 31. UNHEALTHY

Existe Failure que viola Health Policy requerida.

---

# 32. UNKNOWN

No existe evidencia suficiente o actual para clasificar Health.

---

# 33. UNKNOWN ≠ HEALTHY

La ausencia de evidencia de Failure no deberá interpretarse automáticamente como Healthy.

---

# 34. UNKNOWN ≠ UNHEALTHY

Tampoco deberá tratarse universalmente como Failure.

Su semántica dependerá de Policy.

---

# 35. Health Result

Conceptualmente:

```text
HealthResult
├── status
├── scope
├── timestamp
├── duration
├── freshness
├── reason
├── checks
└── metadata
```

---

# 36. Health Check

Una operación lógica que evalúa una condición de Health.

---

# 37. Health Check Identity

Cada Check deberá poseer ID estable.

Ejemplos:

```text
runtime.event-loop
database.primary
queue.publisher
cache.redis
storage.write
```

---

# 38. Health Check Scope

Deberá declarar qué evalúa.

---

# 39. Health Probe

Es el mecanismo concreto que ejecuta uno o varios Health Checks.

---

# 40. Probe ≠ Check

```text
Check
→ logical health condition

Probe
→ mechanism used to evaluate it
```

---

# 41. Probe Side Effects

Deberán minimizarse.

---

# 42. Destructive Probe

Queda prohibida salvo diseño específico y controlado.

---

# 43. Health Component

Representa unidad evaluable.

Ejemplos:

```text
runtime
application
module
database
broker
cache
external API
filesystem
scheduler
```

---

# 44. Component Identity

Deberá ser estable.

---

# 45. Health Dependency

Representa dependencia cuya condición puede afectar Health o Readiness.

---

# 46. Dependency Criticality

Deberá declararse:

```text
CRITICAL
REQUIRED
OPTIONAL
```

---

# 47. Critical Dependency

Su Failure puede impedir operación esencial.

---

# 48. Required Dependency

Necesaria para determinada capacidad o Scope.

---

# 49. Optional Dependency

Su Failure deberá favorecer:

```text
DEGRADED
```

cuando exista modo degradado válido.

---

# 50. Dependency Health ≠ Dependency Reachability

Poder establecer conexión no implica que Dependency funcione correctamente.

---

# 51. Connectivity Check

Podrá ser una señal.

---

# 52. Semantic Health Check

Podrá verificar una operación funcional mínima.

---

# 53. Expensive Semantic Check

No deberá ejecutarse con alta frecuencia si puede degradar la propia Dependency.

---

# 54. Health Check Type

Podrá clasificarse:

```text
LOCAL
DEPENDENCY
RESOURCE
FUNCTIONAL
SECURITY
CAPACITY
```

---

# 55. Local Check

No depende de sistemas externos.

---

# 56. Resource Check

Podrá evaluar:

```text
memory
disk
thread pool
connection pool
queue depth
file descriptors
```

---

# 57. Saturation

Puede provocar DEGRADED o Not Ready antes de Failure total.

---

# 58. Capacity Health

Deberá utilizar ENG-054.

---

# 59. Functional Check

Comprueba capacidad funcional concreta.

---

# 60. Security Health

Podrá comprobar estado técnico de:

```text
certificate expiry
key availability
security provider
authentication backend
```

sin exponer Secret Material.

---

# 61. Critical Health Check

Su Failure contribuye fuertemente al estado agregado.

---

# 62. Optional Health Check

Su Failure podrá producir Degraded.

---

# 63. Health Policy

Define cómo interpretar Checks.

Conceptualmente:

```text
HealthPolicy
├── requiredChecks
├── optionalChecks
├── aggregation
├── thresholds
├── freshness
└── failureBehavior
```

---

# 64. Policy Scope

Podrá variar entre:

```text
liveness
startup
readiness
application health
environment health
deployment gate
```

---

# 65. Composite Health

Combina múltiples Health Results.

---

# 66. Health Aggregation

Deberá utilizar reglas explícitas.

---

# 67. Worst-State Aggregation

Ejemplo:

```text
HEALTHY + HEALTHY   → HEALTHY
HEALTHY + DEGRADED  → DEGRADED
HEALTHY + UNHEALTHY → UNHEALTHY
```

solo será válida cuando Criticality permita esa semántica.

---

# 68. Optional Failure Aggregation

Ejemplo:

```text
required checks healthy
optional check unhealthy
        │
        ▼
     DEGRADED
```

---

# 69. Aggregation Determinism

Mismos Results deberán producir mismo Composite Status.

---

# 70. Aggregation Ordering

No deberá depender de Registration Order.

---

# 71. Health Gate

Decide si una operación puede progresar.

Ejemplos:

```text
deployment promotion
upgrade batch
traffic shift
migration cutover
```

---

# 72. Gate ≠ Probe

Probe obtiene señal.

Gate toma decisión.

---

# 73. Readiness Gate

Determina si puede recibirse nuevo trabajo.

---

# 74. Startup Gate

Determina si Initialization terminó satisfactoriamente.

---

# 75. Deployment Gate

ENG-067 podrá consumir Health Results.

---

# 76. Upgrade Gate

ENG-066 podrá consumir Health Results.

---

# 77. Gate Threshold

Deberá ser explícito.

---

# 78. Gate Evaluation Window

Podrá requerir múltiples muestras.

---

# 79. Single Sample Promotion

No deberá utilizarse para operaciones críticas cuando señales sean ruidosas.

---

# 80. Success Threshold

Número de éxitos requeridos antes de considerar estado recuperado.

---

# 81. Failure Threshold

Número de fallos requeridos antes de marcar Failure.

---

# 82. Threshold Purpose

Reduce flapping.

---

# 83. Flapping

Transición rápida:

```text
HEALTHY
UNHEALTHY
HEALTHY
UNHEALTHY
```

deberá mitigarse cuando afecte Routing o Restart.

---

# 84. Hysteresis

Podrá utilizar diferentes Success/Failure Thresholds.

---

# 85. Probe Interval

Deberá ser explícito.

---

# 86. Probe Frequency

No deberá saturar dependencia o Runtime.

---

# 87. Probe Timeout

Toda Probe externa deberá tener Timeout.

---

# 88. Timeout Result

Deberá clasificarse explícitamente.

---

# 89. Probe Concurrency

Deberá estar acotada.

---

# 90. Probe Storm

Deberá evitarse cuando muchas instancias comprueben la misma Dependency simultáneamente.

---

# 91. Jitter

Podrá utilizarse para distribuir Probe Load.

---

# 92. Grace Period

Periodo durante el cual ciertos Failures todavía no cambian Status definitivo.

---

# 93. Startup Grace Period

Podrá proteger inicialización legítimamente lenta.

---

# 94. Recovery Grace Period

Podrá evitar Promotion prematura tras Recovery.

---

# 95. Health Freshness

Todo Result cacheado deberá indicar antigüedad.

---

# 96. Fresh Result

Se encuentra dentro de Freshness Window.

---

# 97. Stale Result

Ha excedido Freshness Window.

---

# 98. Stale Healthy

No deberá seguir considerándose Healthy indefinidamente.

---

# 99. Stale Policy

Podrá convertir Result en:

```text
UNKNOWN
UNHEALTHY
DEGRADED
```

según Scope.

---

# 100. Health Timestamp

Deberá registrar momento de observación.

---

# 101. Health Cache

Podrá utilizar ENG-037.

---

# 102. Cache Purpose

Evita ejecutar checks costosos por cada request al Health Endpoint.

---

# 103. Cache Key

Deberá considerar:

```text
component
scope
policy
```

---

# 104. Cache TTL

Deberá ser menor o igual a Freshness requirements.

---

# 105. Cache Failure

No deberá devolver estado antiguo como actual sin indicarlo.

---

# 106. Background Health Evaluation

Podrá ejecutar Checks periódicamente.

---

# 107. On-Demand Health Evaluation

Podrá utilizarse para Checks baratos.

---

# 108. Synchronous Probe Chain

No deberá crear latencia excesiva en Health Endpoint.

---

# 109. Dependency Health

Deberá distinguir Health local de Remote Health.

---

# 110. Remote Self-Reported Health

No deberá considerarse evidencia absoluta.

---

# 111. External API Health

Podrá inferirse mediante:

```text
recent requests
synthetic probe
provider health endpoint
circuit state
```

---

# 112. External Health Aggregation

Deberá integrarse con ENG-039.

---

# 113. Circuit Breaker Open

Podrá contribuir a DEGRADED/UNHEALTHY según Criticality.

---

# 114. Retry State

No deberá usarse por sí solo como Health.

---

# 115. Recent Successful Traffic

Podrá considerarse evidencia de Health.

---

# 116. Passive Health

Deriva señales de tráfico real.

---

# 117. Active Health

Ejecuta Probes explícitas.

---

# 118. Active + Passive

Podrán combinarse mediante Policy.

---

# 119. Health Endpoint

Podrá exponer estado a infraestructura o operadores.

Ejemplos:

```text
/health
/health/live
/health/ready
/health/startup
```

---

# 120. Endpoint Semantics

Cada Endpoint deberá poseer semántica estable.

---

# 121. Liveness Endpoint

Deberá favorecer Checks locales y baratos.

---

# 122. Readiness Endpoint

Podrá incluir Required Dependencies.

---

# 123. Full Health Endpoint

Podrá proporcionar diagnóstico más amplio.

---

# 124. Diagnostic Endpoint ≠ Probe Endpoint

La infraestructura no deberá depender necesariamente de un endpoint costoso de diagnóstico completo.

---

# 125. HTTP Status Mapping

Cuando se utilice HTTP deberá ser explícito.

Ejemplo:

```text
healthy/ready → 2xx
not ready     → 5xx
```

según Contract del entorno.

---

# 126. Response Schema

Deberá versionarse si forma parte de un Contract externo.

---

# 127. Health Payload

Podrá contener:

```text
status
timestamp
version
checks summary
```

---

# 128. Sensitive Health Data

No deberá exponer:

```text
passwords
tokens
connection strings
internal IPs
database credentials
stack traces
secret identifiers
```

sin autorización.

---

# 129. Public Health Endpoint

Deberá minimizar información.

---

# 130. Administrative Health Endpoint

Podrá proporcionar más Diagnostics con Authorization.

---

# 131. Health Security

ENG-024 gobernará controles generales.

---

# 132. Health Endpoint Abuse

Deberá considerar:

```text
DoS
dependency amplification
information disclosure
enumeration
```

---

# 133. Rate Limiting

Podrá aplicarse a endpoints diagnosticables expuestos externamente.

---

# 134. Probe Authentication

Internal probes podrán utilizar Network/Identity Policy adecuada.

---

# 135. Probe Must Not Require Fragile Dependency

Liveness no deberá depender de Authentication Service remoto si ello crea ciclo de dependencia.

---

# 136. Health Circular Dependency

Deberá evitarse.

Ejemplo:

```text
Service A checks B
Service B checks A
both mark themselves unhealthy
```

sin Policy adecuada.

---

# 137. Health Dependency Graph

Podrá modelarse.

---

# 138. Dependency Cycle

No deberá convertir Health Aggregation en recursión infinita.

---

# 139. Health Depth

Deberá limitarse.

---

# 140. Deep Dependency Checks

No deberán ejecutarse indiscriminadamente.

---

# 141. Local Responsibility

Cada componente deberá reportar su propio Health inmediato.

---

# 142. Transitive Health

Deberá agregarse solo cuando Contract lo necesite.

---

# 143. Health and Readiness During Shutdown

Al comenzar shutdown:

```text
READINESS → false
LIVENESS  → true
```

mientras se drena trabajo.

---

# 144. Final Shutdown

Después de completar Drain el proceso podrá terminar.

---

# 145. Health During Maintenance

Podrá estar:

```text
alive
healthy
not ready
```

simultáneamente.

---

# 146. Health During Migration

Migration crítica podrá alterar Readiness sin implicar Liveness Failure.

---

# 147. Health During Deployment

ENG-067 deberá utilizar Readiness antes de Exposure.

---

# 148. Health During Upgrade

ENG-066 deberá utilizar Gates por Batch/Wave.

---

# 149. Environment Health

ENG-068 podrá utilizar Checks de:

```text
network
storage
identity
capacity
shared services
```

---

# 150. Application Health

ENG-034 podrá agregar:

```text
runtime
modules
required dependencies
resources
```

---

# 151. Module Health

ENG-028 podrá proporcionar Health Checks propios.

---

# 152. Plugin Health

ENG-060 podrá proporcionar Checks dentro de Extension Point controlado.

---

# 153. Plugin Check Isolation

Un Plugin defectuoso no deberá bloquear indefinidamente Health Evaluation global.

---

# 154. Health Registration

ENG-020 podrá registrar:

```text
HealthCheck
HealthPolicy
HealthAggregator
HealthGate
```

---

# 155. Health Discovery

ENG-058 podrá descubrir Checks.

---

# 156. Health Resolution

ENG-059 podrá seleccionar Implementation cuando existan alternativas.

---

# 157. Dynamic Health Check Registration

Deberá estar controlada.

---

# 158. Health Check Ownership

Todo Check deberá poseer Owner.

---

# 159. Duplicate Health Check ID

Deberá rechazarse.

---

# 160. Health Metadata

Deberá seguir ENG-057.

Podrá incluir:

```text
owner
description
criticality
timeout
category
deprecated
```

---

# 161. Context

ENG-056 deberá proporcionar Deadline/Cancellation.

---

# 162. Probe Cancellation

Deberá ser cooperativa.

---

# 163. Health Probe Deadline

No deberá exceder Deadline del caller.

---

# 164. Resource Management

ENG-054 deberá limitar:

```text
probe concurrency
probe threads
network connections
buffers
```

---

# 165. Resilience

ENG-039 gobernará Failures de Dependencies.

---

# 166. Health Check Retry

No deberá aplicar Retries excesivos dentro de Probe.

---

# 167. Probe Retry

Cuando se utilice deberá estar acotado y respetar Probe Timeout global.

---

# 168. Retry Masking

No deberá ocultar latencia o Failure persistente.

---

# 169. Health State Transitions

Podrán modelarse:

```text
UNKNOWN
   │
   ▼
HEALTHY
   │
   ├──► DEGRADED
   │        │
   │        ▼
   └────► UNHEALTHY
```

---

# 170. Transition Timestamp

Podrá conservarse para Diagnostics.

---

# 171. Last Success

Podrá conservarse.

---

# 172. Last Failure

Podrá conservarse.

---

# 173. Consecutive Failures

Podrá utilizarse para Thresholds.

---

# 174. Consecutive Successes

Podrá utilizarse para Recovery.

---

# 175. Health History

Podrá conservar una ventana limitada.

---

# 176. Health History ≠ Observability Backend

No deberá reconstruir un sistema de métricas completo.

---

# 177. Audit

Cambios administrativos de Health Policy deberán ser auditables.

---

# 178. Audit Events

Podrán incluir:

```text
health policy changed
health check registered
health check disabled
health gate overridden
readiness manually forced
```

---

# 179. Manual Override

Deberá estar fuertemente controlado.

---

# 180. Force Healthy

No deberá utilizarse para ocultar Failure real.

---

# 181. Force Ready

Deberá requerir Authority y Audit.

---

# 182. Override Expiration

Deberá poseer duración limitada cuando sea posible.

---

# 183. Health Observability

ENG-025 gobernará Telemetry.

---

# 184. Metrics

Podrán incluir:

```text
mef.health.check.total
mef.health.check.duration
mef.health.check.failure.total

mef.health.status
mef.health.degraded

mef.readiness.ready
mef.liveness.alive
mef.startup.complete

mef.health.stale.total
mef.health.gate.failure.total
```

---

# 185. Metric Labels

Podrán incluir Labels acotados:

```text
checkType
criticality
status
scope
result
```

---

# 186. Component ID as Metric Label

Deberá limitarse cuando Cardinality sea dinámica.

---

# 187. Health Logs

Podrán registrar transiciones relevantes.

Ejemplo:

```text
HEALTHY → DEGRADED
DEGRADED → UNHEALTHY
UNHEALTHY → HEALTHY
READY → NOT_READY
```

---

# 188. Repeated Failure Logging

Deberá evitar Log Flooding.

---

# 189. Transition Logging

Deberá favorecerse frente a repetir mismo estado en cada Probe.

---

# 190. Health Tracing

No deberá crear Span para cada Probe frecuente si genera Trace Explosion.

---

# 191. Diagnostics

Deberá poder responder:

```text
is process alive?
is startup complete?
is application ready?
overall health?
which check failed?
which dependency is degraded?
is result stale?
when was last success?
when did status change?
which policy aggregated the result?
```

---

# 192. Testing

ENG-009 gobernará Testing.

---

# 193. Liveness Test

Deberá comprobar que Outage externo no provoca Restart Loop indebido.

---

# 194. Startup Test

Deberá comprobar:

```text
initializing
success
failure
timeout
```

---

# 195. Readiness Test

Deberá retirar capacidad de recibir nuevo trabajo ante Failure requerido.

---

# 196. Degraded Test

Dependency Optional caída deberá producir comportamiento esperado.

---

# 197. Unknown Test

Deberá comprobar Policy de Result ausente o stale.

---

# 198. Aggregation Test

Deberá cubrir combinaciones de:

```text
HEALTHY
DEGRADED
UNHEALTHY
UNKNOWN
```

---

# 199. Criticality Test

Deberá diferenciar Critical/Required/Optional.

---

# 200. Threshold Test

Deberá probar Failure y Success Threshold.

---

# 201. Flapping Test

Deberá comprobar Hysteresis cuando se implemente.

---

# 202. Timeout Test

Probe lenta deberá terminar dentro de Timeout.

---

# 203. Cancellation Test

Deberá cancelar Probe cooperativamente.

---

# 204. Stale Result Test

Deberá comprobar Freshness Policy.

---

# 205. Cache Test

Deberá comprobar TTL e invalidación.

---

# 206. Dependency Test

Deberá probar:

```text
connection refused
timeout
partial degradation
slow dependency
recovery
```

---

# 207. Probe Storm Test

Deberá comprobar límites de Concurrency/Frequency.

---

# 208. Drain Test

Deberá comprobar:

```text
readiness false
liveness true
in-flight work finishes
```

---

# 209. Maintenance Test

Deberá permitir:

```text
alive + healthy + not ready
```

cuando Contract lo requiera.

---

# 210. Security Test

Deberá intentar:

```text
health information disclosure
unauthorized detailed diagnostics
probe amplification
health endpoint DoS
manual health override
health registration injection
```

---

# 211. Circular Dependency Test

Deberá evitar recursión infinita.

---

# 212. Architecture Test

Podrá impedir:

```text
database check in liveness by default
liveness equals readiness
startup equals readiness
unknown equals healthy
optional dependency makes global unhealthy
unbounded probe timeout
health endpoint executes all deep checks synchronously
```

---

# 213. Build Integration

ENG-012 podrá validar:

```text
duplicate health check id
unknown criticality
missing timeout
invalid health policy
invalid aggregation
missing readiness requirements
invalid endpoint configuration
```

---

# 214. CLI

ENG-007 podrá proporcionar:

```text
mef health
mef health:list
mef health:check
mef health:live
mef health:ready
mef health:startup
mef health:dependencies
mef health:policy
mef health:diagnose
```

---

# 215. `mef health`

Podrá mostrar Composite Health.

---

# 216. `health:list`

Podrá mostrar:

```text
check
type
criticality
status
lastRun
```

---

# 217. `health:check`

Podrá ejecutar Check específico.

---

# 218. `health:live`

Deberá mostrar Liveness.

---

# 219. `health:ready`

Deberá mostrar Readiness.

---

# 220. `health:startup`

Deberá mostrar Startup State.

---

# 221. `health:dependencies`

Podrá mostrar:

```text
dependency
criticality
status
freshness
```

---

# 222. `health:policy`

Podrá explicar Aggregation Rules.

---

# 223. `health:diagnose`

Podrá mostrar:

```text
overall status
liveness
startup
readiness
checks
dependencies
thresholds
freshness
last transitions
```

---

# 224. Registry Integration

ENG-020 podrá registrar:

```text
HealthCheck
HealthPolicy
HealthAggregator
HealthGate
HealthEndpoint
```

---

# 225. Health Check Contract

Conceptualmente:

```text
HealthCheck
├── id
├── type
├── criticality
├── timeout
└── check(context): HealthResult
```

---

# 226. Health Result Contract

Conceptualmente:

```text
HealthResult
├── status
├── checkId
├── observedAt
├── duration
├── reason
└── metadata
```

---

# 227. Composite Health Result

Conceptualmente:

```text
CompositeHealthResult
├── status
├── results
├── policy
├── evaluatedAt
└── freshness
```

---

# 228. Health Policy Contract

Conceptualmente:

```text
HealthPolicy
├── id
├── scope
├── requiredChecks
├── optionalChecks
├── aggregator
├── thresholds
└── freshness
```

---

# 229. Health Gate Contract

Conceptualmente:

```text
HealthGate
├── id
├── policy
├── window
├── successThreshold
├── failureThreshold
└── evaluate
```

---

# 230. Health Runtime

Conceptualmente:

```text
HealthRuntime
├── check
├── aggregate
├── liveness
├── startup
├── readiness
├── dependencies
└── diagnose
```

---

# 231. Health Snapshot

Podrá representar:

```text
HealthSnapshot
├── generatedAt
├── liveness
├── startup
├── readiness
├── overallHealth
└── checks
```

---

# 232. Snapshot Consistency

Los Results agregados deberán pertenecer a una ventana temporal compatible.

---

# 233. Bootstrap

ENG-027 deberá construir Health Runtime suficientemente temprano para observar Startup.

---

# 234. Bootstrap Flow

```text
Runtime Start
     │
     ▼
Health Infrastructure
     │
     ▼
Startup Checks
     │
     ▼
Core Services
     │
     ▼
Dependencies
     │
     ▼
Application Bootstrap
     │
     ▼
Startup Complete
     │
     ▼
Readiness Evaluation
     │
     ▼
READY
```

---

# 235. Bootstrap Failure

Podrá producir:

```text
startup failed
startup timeout
critical dependency unavailable
required initialization failed
security initialization failed
```

sin confundir todo Failure con Liveness.

---

# 236. Shutdown

La secuencia recomendada:

```text
READY
  │
  ▼
NOT READY
  │
  ▼
DRAIN
  │
  ▼
STOPPING
  │
  ▼
NOT ALIVE
```

---

# 237. First Implementation Components

La primera implementación deberá incluir:

```text
HealthStatus

HealthCheck
HealthResult

HealthCriticality

HealthPolicy
HealthAggregator

HealthRuntime

LivenessEvaluator
StartupEvaluator
ReadinessEvaluator

HealthRegistry
HealthError
```

---

# 238. Optional Initial Components

Podrán incorporarse:

```text
HealthGate
HealthSnapshot
HealthCache

HealthEndpoint
DependencyHealthChecker

HealthDiagnostics
HealthHistory
```

---

# 239. Later Components

Solo cuando exista necesidad demostrada:

```text
Adaptive Health Policies
Predictive Health
Distributed Health Aggregation
Cross-Region Health
Automatic Root Cause Correlation
Machine-Learned Health Scoring
```

---

# 240. Estructura Conceptual de Directorios

```text
src/
└── Health/
    ├── Status/
    │   └── HealthStatus
    │
    ├── Check/
    │   ├── HealthCheck
    │   └── HealthCriticality
    │
    ├── Result/
    │   ├── HealthResult
    │   └── CompositeHealthResult
    │
    ├── Policy/
    │   └── HealthPolicy
    │
    ├── Aggregation/
    │   └── HealthAggregator
    │
    ├── Evaluation/
    │   ├── LivenessEvaluator
    │   ├── StartupEvaluator
    │   └── ReadinessEvaluator
    │
    ├── Gate/
    │   └── HealthGate
    │
    ├── Dependency/
    │   └── DependencyHealthChecker
    │
    ├── Cache/
    │   └── HealthCache
    │
    ├── Snapshot/
    │   └── HealthSnapshot
    │
    ├── Endpoint/
    │   └── HealthEndpoint
    │
    ├── Registry/
    │   └── HealthRegistry
    │
    ├── Runtime/
    │   └── HealthRuntime
    │
    ├── Diagnostics/
    │   ├── HealthDiagnostics
    │   └── HealthHistory
    │
    └── Error/
        └── HealthError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 241. Error Namespace

ENG-069 utilizará:

```text
MEF-HEALTH-xxx
```

---

# 242. Taxonomía ENG-069

```text
MEF-HEALTH-001 Health check identifier invalid
MEF-HEALTH-002 Health check duplicate
MEF-HEALTH-003 Health check invalid
MEF-HEALTH-004 Health policy invalid
MEF-HEALTH-005 Health aggregation failed
MEF-HEALTH-006 Health status unknown
MEF-HEALTH-007 Health result stale
MEF-HEALTH-008 Health probe timeout
MEF-HEALTH-009 Health probe cancelled
MEF-HEALTH-010 Health probe failed
MEF-HEALTH-011 Liveness failed
MEF-HEALTH-012 Startup incomplete
MEF-HEALTH-013 Startup failed
MEF-HEALTH-014 Startup timeout
MEF-HEALTH-015 Readiness failed
MEF-HEALTH-016 Dependency unhealthy
MEF-HEALTH-017 Critical dependency unavailable
MEF-HEALTH-018 Health threshold exceeded
MEF-HEALTH-019 Health flapping detected
MEF-HEALTH-020 Health cache failure
MEF-HEALTH-021 Health endpoint failure
MEF-HEALTH-022 Health dependency cycle
MEF-HEALTH-023 Health probe limit exceeded
MEF-HEALTH-024 Health gate failed
MEF-HEALTH-025 Health override denied
MEF-HEALTH-026 Health result invalid
MEF-HEALTH-027 Health registration invalid
MEF-HEALTH-028 Health information disclosure prevented
MEF-HEALTH-029 Health security violation
MEF-HEALTH-030 Health invariant violation
```

---

# 243. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Health Status

Separate Liveness
Separate Startup
Separate Readiness

Health Checks
Health Results
Criticality

Health Policies
Deterministic Aggregation

Required vs Optional Dependencies

Probe Timeout
Bounded Probe Concurrency

Success / Failure Thresholds

Freshness
Stale Detection

Readiness Before Work

Drain Integration

Security
Diagnostics
Observability
Testing
```

---

# 244. First Version Non-Goals

No deberá requerir:

```text
Predictive Health
Machine Learning Health Scores
Distributed Health Consensus
Automatic Root Cause Analysis
Cross-Region Health Federation
Adaptive Probe Generation
```

---

# 245. Second Phase

Podrá incorporar:

```text
Health Gates
Health Cache
Health History

Passive Health Signals
Advanced Dependency Health

Flapping Detection
Hysteresis

Advanced Diagnostic Endpoints
```

---

# 246. Third Phase

Solo cuando exista necesidad demostrada:

```text
Predictive Health
Adaptive Health Policies
Distributed Health Aggregation
Cross-Region Health
Automatic Root Cause Correlation
Machine-Learned Health Scoring
```

---

# 247. Invariantes de Ingeniería

ENG-069 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1326 | MEF deberá mantener Liveness, Startup, Health y Readiness como conceptos separados y ningún estado deberá inferirse automáticamente de otro sin Policy explícita. |
| EI-1327 | Liveness deberá evaluar principalmente la capacidad del Runtime de continuar operando y no deberá depender por Default de Dependencies externas cuyo Failure pueda recuperarse sin Restart. |
| EI-1328 | Startup deberá representar Initialization inicial y una aplicación no deberá declararse Ready hasta completar las Preconditions de Startup correspondientes. |
| EI-1329 | Readiness deberá gobernar aceptación de nuevo trabajo y un componente Not Ready deberá poder permanecer Alive mientras drena, espera una Dependency o se encuentra en Maintenance. |
| EI-1330 | Todo Health Result deberá poseer Status, Scope, Observation Time, Duration y Freshness suficientes para impedir que Results antiguos se interpreten indefinidamente como estado actual. |
| EI-1331 | HEALTHY, DEGRADED, UNHEALTHY y UNKNOWN deberán conservar semánticas distintas y `UNKNOWN` no deberá convertirse automáticamente en `HEALTHY`. |
| EI-1332 | Health Dependencies deberán declarar Criticality y el Failure de una Dependency OPTIONAL no deberá transformar automáticamente el Composite Health en UNHEALTHY cuando exista Degraded Mode válido. |
| EI-1333 | Health Aggregation deberá ser explícita, determinística y sensible a Criticality; el resultado no deberá depender de Registration Order ni de la secuencia accidental de ejecución de Checks. |
| EI-1334 | Toda Probe externa deberá poseer Timeout y Concurrency acotada y la frecuencia de Probes no deberá crear Probe Storms, Dependency Amplification o Resource Exhaustion. |
| EI-1335 | Success Threshold, Failure Threshold, Grace Period y Freshness deberán utilizarse cuando sea necesario para evitar Flapping, Promotion prematura y transiciones basadas en muestras aisladas. |
| EI-1336 | Health Cache deberá indicar Freshness y ningún Result stale deberá presentarse como observación actual sin marcar explícitamente su antigüedad o convertirlo conforme a Stale Policy. |
| EI-1337 | Health Endpoints de infraestructura deberán favorecer Checks baratos y estables y no deberán ejecutar indiscriminadamente Dependency Graphs profundos o diagnósticos costosos de forma síncrona. |
| EI-1338 | Health Endpoint Payloads deberán minimizar información y no deberán revelar Secrets, Credentials, Connection Strings, Internal Topology o Stack Traces a consumidores no autorizados. |
| EI-1339 | Drain y Shutdown deberán retirar Readiness antes de terminar Liveness para permitir que el sistema deje de recibir nuevo trabajo mientras completa trabajo en vuelo. |
| EI-1340 | Deployment, Upgrade, Migration y Environment Gates podrán consumir Health, pero Health Checks no deberán incorporar decisiones de Deployment, Routing o Rollout dentro de sí mismos. |
| EI-1341 | Health Evaluation deberá respetar Deadline, Cancellation, Resource Limits y Failure Isolation y un Plugin o Check defectuoso no deberá bloquear indefinidamente la evaluación global. |
| EI-1342 | Health Observability deberá favorecer Status Transitions, Durations, Failures y Freshness sin producir Log Flooding, Trace Explosion o Metric Cardinality descontrolada. |
| EI-1343 | Health Testing deberá cubrir Liveness, Startup, Readiness, Degraded Mode, Unknown, Aggregation, Criticality, Thresholds, Flapping, Timeout, Freshness, Dependency Failure, Drain, Maintenance, Security y Circular Dependencies. |
| EI-1344 | Build y Architecture Tests deberán detectar Liveness dependiente innecesariamente de servicios externos, Liveness=Readiness, UNKNOWN=HEALTHY, Optional Dependency como Global Failure, Probes sin Timeout, Health Endpoints costosos y Manual Overrides no gobernados. |
| EI-1345 | La primera implementación deberá priorizar separación Liveness/Startup/Readiness, Health Status explícito, Health Checks, Criticality, Policies, Deterministic Aggregation, Probe Limits, Freshness y Drain Integration antes de introducir Predictive Health, Distributed Aggregation o Automatic Root Cause Analysis. |

---

# 248. Continuidad de Invariantes

```text
ENG-065 → EI-1246 a EI-1265
ENG-066 → EI-1266 a EI-1285
ENG-067 → EI-1286 a EI-1305
ENG-068 → EI-1306 a EI-1325
ENG-069 → EI-1326 a EI-1345
```

---

# 249. Criterios de Conformidad

Una implementación será conforme con ENG-069 cuando:

- diferencie Liveness;
- diferencie Startup;
- diferencie Health;
- diferencie Readiness;
- implemente `HEALTHY`;
- implemente `DEGRADED`;
- implemente `UNHEALTHY`;
- implemente `UNKNOWN`;
- identifique Health Checks;
- clasifique Criticality;
- modele Health Results;
- registre Timestamp y Duration;
- controle Freshness;
- detecte Stale Results;
- defina Health Policies;
- agregue resultados determinísticamente;
- diferencie Required y Optional Dependencies;
- limite Probe Timeout;
- limite Probe Frequency;
- limite Probe Concurrency;
- controle Thresholds;
- permita Grace Period;
- evite Flapping;
- retire Readiness antes de Shutdown;
- proteja Health Endpoints;
- minimice Health Payloads;
- permita Diagnostics;
- aplique Security;
- implemente Tests de Failure y Recovery.

---

# 250. Riesgos

Deberán evitarse especialmente:

```text
Liveness Equals Readiness
Liveness Depends on Database
Liveness Depends on Remote Authentication
Restart Loop During Dependency Outage

Startup Equals Ready
Warm-Up Equals Ready

Unknown Equals Healthy
Stale Healthy Forever

Optional Dependency Makes App Unhealthy
Reachability Equals Health

Probe Without Timeout
Probe Storm
Probe Amplification
Unlimited Probe Concurrency

Health Endpoint Runs Full Dependency Graph
Health Endpoint Leaks Secrets
Health Endpoint Leaks Internal Topology

Readiness Remains True During Drain
Kill Before Drain

Single-Sample Deployment Promotion
Flapping Health State

Manual Force-Healthy Without Audit
Manual Force-Ready Without Expiration

Plugin Health Check Blocks Global Health
Health Dependency Recursion
```

---

# 251. Relación con ENG-025

Observability responde:

```text
What happened?
How much?
How long?
Why?
```

Health responde:

```text
What is the operational status now,
and may this component receive work?
```

---

# 252. Relación con ENG-039

Resilience gobierna cómo reaccionar ante Failures.

Health proporciona señales sobre esas Failures.

---

# 253. Relación con ENG-054

Resource saturation podrá afectar Health/Readiness.

Health no deberá implementar Resource Manager paralelo.

---

# 254. Relación con ENG-055

Lifecycle utiliza Health durante:

```text
STARTING
READY
DRAINING
STOPPING
```

---

# 255. Relación con ENG-067

Deployment deberá aplicar:

```text
START
  │
  ▼
WARM-UP
  │
  ▼
STARTUP COMPLETE
  │
  ▼
READINESS
  │
  ▼
EXPOSE
```

---

# 256. Relación con ENG-068

Environment Health representa salud del hosting context.

Application Health representa salud del workload.

No deberán confundirse.

---

# 257. Relación con ENG-070

**ENG-070 deberá formalizar Performance Engineering.**

La separación será:

```text
HEALTH & READINESS
ENG-069
→ Is the system alive, healthy
  and capable of receiving work?

PERFORMANCE
ENG-070
→ How efficiently does the system
  execute that work within measurable
  latency, throughput and resource budgets?
```

ENG-070 deberá cubrir:

```text
Performance
Performance Requirement
Performance Budget

Latency
Response Time
Service Time
Queue Time

Throughput
Operations Per Second

Concurrency
Saturation
Utilization

Percentile
p50
p95
p99

Tail Latency

Performance Baseline
Performance Target

Benchmark
Microbenchmark
Macrobenchmark

Load Test
Stress Test
Soak Test
Spike Test

Warm-Up
Steady State

Performance Regression

Profiling
CPU Profiling
Memory Profiling
Allocation Profiling
I/O Profiling

Hot Path
Critical Path

Performance Optimization
Optimization Validation

Caching Impact
Serialization Cost
Network Cost
Database Cost

Performance Capacity Relationship

Performance Security
Performance Observability
Performance Testing
```

---

# 258. Principio Rector

> **MEF deberá determinar Health mediante señales explícitas, acotadas y frescas. Estar vivo, haber terminado Startup, estar sano y estar preparado para recibir trabajo son propiedades distintas; confundirlas puede provocar reinicios innecesarios, tráfico hacia instancias incapaces, falsas recuperaciones y cascadas de Failure.**

---

# 259. Conclusión

**ENG-069 — Health & Readiness Engineering** formaliza el estado operacional de MEF.

La separación fundamental queda:

```text
STARTUP
│
└── Has initialization completed?

LIVENESS
│
└── Should this process remain alive?

HEALTH
│
└── Is the component operating correctly?

READINESS
│
└── May it receive new work?
```

Un estado completamente válido puede ser:

```text
Liveness  = ALIVE
Startup   = COMPLETE
Health    = DEGRADED
Readiness = READY
```

si solo existe una Dependency opcional degradada.

También:

```text
Liveness  = ALIVE
Startup   = COMPLETE
Health    = HEALTHY
Readiness = NOT_READY
```

durante Drain o Maintenance.

La agregación queda:

```text
CHECKS
 │
 ├── Runtime        HEALTHY / CRITICAL
 ├── Database       HEALTHY / REQUIRED
 ├── Cache          UNHEALTHY / OPTIONAL
 └── Email Provider HEALTHY / OPTIONAL
 │
 ▼
HEALTH POLICY
 │
 ▼
DEGRADED
```

y no necesariamente:

```text
UNHEALTHY
```

La secuencia de Startup queda:

```text
PROCESS START
     │
     ▼
STARTUP
     │
     ▼
INITIALIZATION
     │
     ▼
STARTUP COMPLETE
     │
     ▼
READINESS CHECK
     │
     ▼
READY
     │
     ▼
RECEIVE WORK
```

La secuencia de Shutdown queda:

```text
READY
  │
  ▼
NOT READY
  │
  ▼
DRAIN
  │
  ▼
IN-FLIGHT WORK COMPLETE
  │
  ▼
STOP
  │
  ▼
NOT ALIVE
```

La Freshness queda:

```text
Health Result
     │
     ├── observedAt
     ├── TTL
     └── freshness
     │
     ▼
Fresh?
 ┌───┴────┐
 ▼        ▼
YES       NO
 │        │
 ▼        ▼
use     UNKNOWN /
        stale policy
```

La cadena reciente queda:

```text
UPGRADE
ENG-066
   │
   ▼
DEPLOYMENT
ENG-067
   │
   ▼
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
```

La primera implementación deberá concentrarse en:

```text
HealthStatus

HealthCheck
HealthResult
HealthCriticality

HealthPolicy
HealthAggregator

LivenessEvaluator
StartupEvaluator
ReadinessEvaluator

HealthRuntime
HealthRegistry

HealthError
```

con:

```text
Explicit Health States
Liveness / Startup / Readiness Separation
Required / Optional Dependencies
Deterministic Aggregation
Probe Timeouts
Bounded Concurrency
Thresholds
Freshness
Stale Detection
Drain Integration
Health Endpoint Security
Diagnostics
Observability
Testing
```

antes de introducir:

```text
Predictive Health
Adaptive Health Policies
Distributed Health Aggregation
Cross-Region Health
Automatic Root Cause Correlation
Machine-Learned Health Scoring
```

Con **ENG-069**, la serie global alcanza:

```text
EI-1345
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
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
- ENG-028 — Module Engineering
- ENG-034 — Application Engineering
- ENG-037 — Caching Engineering
- ENG-039 — Resilience Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-049 — Configuration Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-060 — Extension & Plugin Engineering
- ENG-061 — Interoperability Engineering
- ENG-066 — Upgrade Engineering
- ENG-067 — Deployment Engineering
- ENG-068 — Environment Engineering
- ENG-070 — Performance Engineering
```