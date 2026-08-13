---
id: ENG-025
titulo: Observability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Runtime Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-004
  - ENG-005
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-022
  - ENG-023
  - ENG-024
  - ARQ-006
  - ARQ-007
  - ARQ-008
  - ARQ-014
  - ARQ-016
relacionados:
  - ENG-026
  - ENG-027
keywords:
  - observability
  - telemetry
  - metrics
  - tracing
  - logging
  - diagnostics
  - health
  - correlation
  - instrumentation
  - monitoring
  - runtime
  - mef
---

# ENG-025

# Observability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de Ingeniería de Observability de **MEF (Modular Enterprise Framework)**.

Observability deberá permitir comprender el comportamiento interno del Runtime a partir de señales externas estructuradas.

Las señales fundamentales serán:

```text
Logs
Metrics
Traces
Health
Diagnostics
Events
```

La arquitectura conceptual será:

```text
Runtime
   │
   ├── Logs
   ├── Metrics
   ├── Traces
   ├── Health
   └── Diagnostics
          │
          ▼
      Telemetry
          │
          ▼
    Observability
          │
          ▼
       Insight
          │
          ▼
 Operational Decision
```

---

# 2. Declaración

La regla fundamental será:

> **Todo componente arquitectónicamente significativo de MEF deberá poder explicar su estado y comportamiento mediante señales estructuradas, correlacionables y suficientemente estables, sin requerir inspección manual de su implementación interna.**

Por tanto:

```text
Runtime Behavior
      ↓
Instrumentation
      ↓
Telemetry
      ↓
Correlation
      ↓
Observation
      ↓
Diagnosis
```

y no:

```text
Something failed
      ↓
Open source code
      ↓
Add print()
      ↓
Guess
```

---

# 3. Observability

Observability representa la capacidad de inferir el estado interno de un sistema mediante sus Outputs.

---

# 4. Monitoring

Monitoring utiliza señales observables para comprobar condiciones conocidas.

---

# 5. Observability ≠ Monitoring

Conceptualmente:

```text
Observability
→ provides signals and context

Monitoring
→ evaluates those signals
```

---

# 6. Telemetry

Telemetry representa los datos producidos por Instrumentation.

---

# 7. Instrumentation

Instrumentation representa los mecanismos que generan Telemetry.

---

# 8. Signals

MEF reconocerá como señales principales:

```text
Logs
Metrics
Traces
Health
Diagnostics
```

---

# 9. Logs

ENG-010 continuará siendo la autoridad principal sobre Logging.

ENG-025 determinará cómo Logging participa en Observability.

---

# 10. Metrics

Metrics representan mediciones numéricas agregables del comportamiento del sistema.

---

# 11. Traces

Traces representan el recorrido lógico de una operación a través de Components.

---

# 12. Health

Health representa la capacidad actual de un componente para cumplir su función.

---

# 13. Diagnostics

Diagnostics representa información estructurada destinada a investigar comportamiento, configuración y Failures.

---

# 14. Observability Objectives

MEF deberá permitir responder preguntas como:

```text
Is the Runtime healthy?

Which Module is failing?

Which operation is slow?

Which Contract failed?

Which Event Handler produced the failure?

Which dependency caused the latency?

How many Errors are occurring?

What changed before the failure?

Which Runtime phase is active?
```

---

# 15. Observability Architecture

La arquitectura será:

```text
Component
   │
   ▼
Instrumentation
   │
   ▼
Telemetry API
   │
   ▼
Telemetry Provider
   │
   ▼
Exporter / Sink
   │
   ▼
Observability Backend
```

---

# 16. Technology Independence

MEF no deberá acoplar su Core directamente a:

```text
Prometheus
Grafana
Jaeger
Zipkin
Datadog
New Relic
Elastic
OpenTelemetry SDK
```

Estos podrán implementarse mediante Adapters.

---

# 17. Observability Contracts

El Core deberá depender de Contracts tecnológicos neutrales.

Ejemplos conceptuales:

```text
MetricRecorder
Tracer
Span
HealthReporter
DiagnosticProvider
```

---

# 18. No Vendor Leakage

Modules no deberán requerir SDKs propietarios de Observability para integrarse con MEF.

---

# 19. Telemetry Provider

Un Implementation Profile podrá seleccionar Provider concreto.

---

# 20. No Provider

Observability deberá permitir implementación:

```text
NoOp
```

cuando una señal no esté habilitada.

---

# 21. NoOp Safety

Deshabilitar Telemetry no deberá romper funcionalidad de negocio.

---

# 22. Observability Failure

Una Failure del Backend de Observability no deberá provocar automáticamente Failure del negocio.

---

# 23. Critical Audit Exception

Security Audit podrá tener reglas diferentes conforme ENG-024.

---

# 24. Structured Telemetry

Telemetry deberá favorecer estructura sobre texto libre.

Ejemplo:

```text
module.id
operation
duration
status
error.code
```

---

# 25. Semantic Attributes

Los Attributes deberán utilizar nombres estables.

---

# 26. Attribute Naming

La convención recomendada será:

```text
namespace.attribute
```

Ejemplos:

```text
mef.module.id
mef.runtime.phase
mef.contract.id
mef.event.type
error.code
```

---

# 27. Reserved Namespace

MEF reservará:

```text
mef.*
```

para atributos oficiales.

---

# 28. Module Attributes

Modules podrán utilizar Namespace propio.

Ejemplo:

```text
customer.operation
```

---

# 29. Attribute Stability

Attributes públicos utilizados por Tooling no deberán cambiar arbitrariamente.

---

# 30. Cardinality

La cardinalidad deberá controlarse.

---

# 31. High Cardinality

Ejemplos peligrosos como Metric Labels:

```text
userId
requestId
email
full URL
exception message
stack trace
```

---

# 32. Correlation ID

Una operación lógica podrá poseer:

```text
correlationId
```

---

# 33. Correlation Purpose

Correlation permite relacionar:

```text
Logs
Errors
Events
Traces
Diagnostics
```

---

# 34. Correlation Propagation

Cuando una operación derive otra operación relacionada, debería propagarse Correlation cuando corresponda.

---

# 35. Correlation Generation

Si una Boundary inicia un nuevo flujo y no existe Correlation ID válido, podrá generarse uno.

---

# 36. Correlation Trust

Un Correlation ID proveniente de una Trust Boundary deberá validarse antes de utilizarse.

---

# 37. Correlation ≠ Authentication

Correlation ID no deberá utilizarse como identidad de seguridad.

---

# 38. Trace

Un Trace representa una operación distribuida o compuesta.

---

# 39. Trace ID

Cada Trace deberá poseer identificador.

---

# 40. Span

Un Span representa una unidad de trabajo dentro de un Trace.

---

# 41. Span Structure

Conceptualmente:

```text
Span
├── traceId
├── spanId
├── parentSpanId
├── name
├── start
├── end
├── status
└── attributes
```

---

# 42. Parent-Child

Los Spans podrán formar:

```text
Root Span
├── Child A
│   └── Child B
└── Child C
```

---

# 43. Span Naming

Los nombres deberán describir operaciones estables.

Preferir:

```text
module.activate
contract.resolve
event.publish
event.handle
```

sobre:

```text
processCustomer12345
```

---

# 44. Span Duration

Todo Span terminado deberá permitir calcular Duration.

---

# 45. Span Status

Podrá representar:

```text
unset
ok
error
```

según Implementation Profile.

---

# 46. Business Failure

Una Failure de negocio esperada no deberá necesariamente marcar todo Trace como fallo técnico.

---

# 47. Error Trace Integration

ENG-023 deberá permitir asociar:

```text
error.code
error.category
```

al Span.

---

# 48. Stack Trace

No deberá convertirse automáticamente en Span Attribute.

---

# 49. Sensitive Trace Data

ENG-024 deberá gobernar datos sensibles incluidos en Traces.

---

# 50. Trace Context

Podrá propagarse entre:

```text
HTTP
Events
Workers
CLI
Services
```

cuando exista relación causal.

---

# 51. Event Trace

ENG-022 deberá permitir correlacionar:

```text
Publish Span
    ↓
Event
    ↓
Handler Span
```

---

# 52. Async Trace

Procesamiento asíncrono deberá preservar relación sin asumir ejecución simultánea.

---

# 53. Span Links

Implementation Profiles podrán utilizar Links para relaciones no jerárquicas.

---

# 54. Metrics Model

MEF reconocerá tipos conceptuales:

```text
Counter
Gauge
Histogram
```

---

# 55. Counter

Representa valor acumulativo.

Ejemplo:

```text
mef.events.published.total
```

---

# 56. Gauge

Representa valor que puede aumentar o disminuir.

Ejemplo:

```text
mef.modules.active
```

---

# 57. Histogram

Representa distribución.

Ejemplo:

```text
mef.event.handler.duration
```

---

# 58. Metric Naming

Las métricas deberán poseer nombres estables y semánticos.

---

# 59. Metric Units

Las unidades deberán ser explícitas.

Ejemplos:

```text
seconds
bytes
items
```

---

# 60. Duration Unit

La implementación deberá evitar ambigüedad entre:

```text
milliseconds
microseconds
seconds
```

---

# 61. Runtime Metrics

Como mínimo podrán existir:

```text
mef.runtime.uptime
mef.runtime.errors.total
mef.runtime.state.transitions.total
```

---

# 62. Module Metrics

```text
mef.modules.discovered
mef.modules.active
mef.modules.failed
mef.module.activation.duration
```

---

# 63. Container Metrics

```text
mef.container.resolutions.total
mef.container.resolution.failures.total
mef.container.resolution.duration
```

---

# 64. Registry Metrics

```text
mef.registry.entries
mef.registry.lookup.total
mef.registry.lookup.failures.total
```

---

# 65. Contract Metrics

```text
mef.contract.resolutions.total
mef.contract.failures.total
mef.contract.compatibility.failures.total
```

---

# 66. Event Metrics

```text
mef.events.published.total
mef.events.handled.total
mef.events.failed.total
mef.event.handler.duration
```

---

# 67. Error Metrics

ENG-023 podrá aportar:

```text
mef.errors.total
mef.errors.unhandled.total
mef.errors.retryable.total
```

---

# 68. Security Metrics

ENG-024 podrá aportar:

```text
mef.security.authorization.denied.total
mef.security.authentication.failed.total
mef.security.policy.violations.total
```

---

# 69. Metric Labels

Deberán utilizarse únicamente Labels con cardinalidad controlada.

---

# 70. Recommended Labels

Ejemplos:

```text
module
operation
status
error_code
runtime_phase
```

si su dominio está controlado.

---

# 71. User IDs in Metrics

No deberán utilizarse como Labels.

---

# 72. Correlation IDs in Metrics

No deberán utilizarse como Labels.

---

# 73. Error Messages in Metrics

No deberán utilizarse como Labels.

---

# 74. Metric Explosion

Tooling deberá evitar combinaciones arbitrarias de Labels.

---

# 75. Metric Budget

Applications podrán establecer presupuesto de Metrics/Labels.

---

# 76. Sampling

Tracing podrá utilizar Sampling.

---

# 77. Sampling Purpose

Reducir:

```text
storage
network
processing
cost
```

---

# 78. Sampling Policy

Deberá ser configurable.

---

# 79. Sampling Independence

Sampling no deberá alterar comportamiento funcional.

---

# 80. Error Sampling

Podrá favorecer conservar Traces con Errors.

---

# 81. Security Sampling

Security Audit no deberá descartarse mediante Trace Sampling cuando sea obligatorio.

---

# 82. Health Model

MEF distinguirá:

```text
Liveness
Readiness
Component Health
```

---

# 83. Liveness

Responde:

```text
Is the process/runtime alive?
```

---

# 84. Readiness

Responde:

```text
Can the runtime currently serve its intended workload?
```

---

# 85. Component Health

Responde:

```text
Can this component fulfill its responsibility?
```

---

# 86. Liveness ≠ Readiness

Un Runtime puede estar vivo pero no listo.

---

# 87. Health Status

Estados conceptuales:

```text
Healthy
Degraded
Unhealthy
Unknown
```

---

# 88. Healthy

El componente opera dentro de condiciones esperadas.

---

# 89. Degraded

Puede operar parcialmente o con capacidad reducida.

---

# 90. Unhealthy

No puede cumplir correctamente su responsabilidad.

---

# 91. Unknown

No existe suficiente información para determinar Health.

---

# 92. Health Check

Un Health Check deberá ser:

```text
bounded
safe
fast
non-destructive
```

---

# 93. Health Timeout

Todo Health Check externo deberá poseer Timeout.

---

# 94. Health Side Effects

Un Health Check no debería modificar Business State.

---

# 95. Health Authentication

Endpoints externos de Health deberán aplicar Security Policy apropiada.

---

# 96. Health Disclosure

No deberán revelar:

```text
credentials
internal paths
database passwords
stack traces
```

---

# 97. Public Health

Podrá limitarse a:

```text
status
```

---

# 98. Internal Health

Podrá incluir Diagnostics adicionales para operadores autorizados.

---

# 99. Dependency Health

Un componente podrá reportar dependencias.

---

# 100. Dependency Failure

Una dependencia opcional no deberá necesariamente volver Unhealthy todo Runtime.

---

# 101. Required Dependency

Una dependencia requerida para Readiness sí podrá afectar estado global.

---

# 102. Health Aggregation

Conceptualmente:

```text
Runtime Health
├── Registry
├── Container
├── Event Bus
├── Modules
└── External Dependencies
```

---

# 103. Aggregation Policy

No deberá utilizarse simplemente:

```text
one unhealthy
→ everything unhealthy
```

sin considerar criticidad.

---

# 104. Critical Component

Components críticos deberán afectar Readiness.

---

# 105. Optional Component

Podrán producir:

```text
Degraded
```

en lugar de:

```text
Unhealthy
```

---

# 106. Runtime State Integration

ENG-015 es autoridad sobre Runtime State.

Health no deberá modificar unilateralmente State.

---

# 107. State vs Health

Deberán distinguirse:

```text
State
→ lifecycle position

Health
→ operational condition
```

---

# 108. Example

```text
State:
ACTIVE

Health:
DEGRADED
```

es válido.

---

# 109. Diagnostics

MEF deberá proporcionar Diagnostics estructurados.

---

# 110. Diagnostic Provider

Conceptualmente:

```text
DiagnosticProvider
```

---

# 111. Diagnostic Scope

Podrá informar:

```text
runtime
modules
registry
container
contracts
events
configuration
security
```

---

# 112. Diagnostic Snapshot

Un Snapshot representa estado observable en un momento.

---

# 113. Snapshot Consistency

No deberá asumirse consistencia transaccional global salvo que esté garantizada.

---

# 114. Diagnostic Security

Diagnostics internos deberán requerir autorización cuando revelen información sensible.

---

# 115. Secret Redaction

Todo Diagnostic deberá respetar ENG-024.

---

# 116. Configuration Diagnostics

Podrá mostrar:

```text
configuration source
resolved keys
effective profile
```

sin mostrar Secrets.

---

# 117. Module Diagnostics

Podrá mostrar:

```text
module id
version
state
health
dependencies
contracts
```

---

# 118. Registry Diagnostics

Podrá mostrar:

```text
entry count
owners
types
conflicts
freeze state
```

según permisos.

---

# 119. Container Diagnostics

Podrá mostrar:

```text
bindings
scopes
visibility
resolution failures
```

sin exponer objetos sensibles.

---

# 120. Contract Diagnostics

Podrá mostrar:

```text
providers
consumers
versions
compatibility
resolution
```

---

# 121. Event Diagnostics

Podrá mostrar:

```text
event types
handlers
failures
retry state
dead-letter state
```

cuando exista.

---

# 122. Security Diagnostics

Podrá mostrar:

```text
policy status
package trust
capability validation
security configuration status
```

sin exponer Secrets.

---

# 123. Diagnostic Levels

Podrán existir:

```text
basic
standard
verbose
```

---

# 124. Production Diagnostics

Deberán ser más restrictivos.

---

# 125. Development Diagnostics

Podrán proporcionar más contexto.

---

# 126. Diagnostic ID

ENG-023 podrá asociar una Failure a:

```text
diagnosticId
```

---

# 127. Diagnostic Lookup

Tooling podrá utilizarlo para recuperar contexto correlacionado.

---

# 128. Logging Integration

ENG-010 seguirá gobernando:

```text
log levels
structured logs
log sinks
format
```

---

# 129. Observability Logging Requirements

ENG-025 añade:

```text
correlation
trace context
semantic attributes
cross-signal consistency
```

---

# 130. Log Correlation

Un Log emitido dentro de un Trace debería poder incluir:

```text
traceId
spanId
correlationId
```

cuando estén disponibles.

---

# 131. Error Log Correlation

Errors de ENG-023 deberán poder correlacionarse con Trace y Logs.

---

# 132. Event Log Correlation

Events de ENG-022 deberán conservar Correlation apropiada.

---

# 133. Security Log Correlation

Security Events de ENG-024 podrán asociarse al mismo flujo.

---

# 134. Timestamp

Telemetry deberá utilizar timestamps consistentes.

---

# 135. Clock

Durations deberían utilizar un reloj monotónico cuando la plataforma lo permita.

---

# 136. Wall Clock

Timestamps humanos podrán utilizar reloj de sistema.

---

# 137. Clock Skew

Sistemas distribuidos deberán considerar desalineación temporal.

---

# 138. Telemetry Context

Conceptualmente:

```text
TelemetryContext
├── correlationId
├── traceId
├── spanId
├── moduleId
├── runtimePhase
└── attributes
```

---

# 139. Context Immutability

IDs fundamentales no deberán modificarse arbitrariamente durante la misma operación lógica.

---

# 140. Context Propagation

Deberá evitar depender exclusivamente de Globals.

---

# 141. Async Context

La implementación deberá preservar Context en operaciones asíncronas cuando técnicamente sea posible.

---

# 142. Context Loss

La pérdida de Context no deberá alterar resultado funcional.

Sí reduce calidad diagnóstica.

---

# 143. Context Injection

Datos externos no deberán poder inyectar Attributes arbitrarios sin validación.

---

# 144. Sensitive Attributes

Deberán filtrarse conforme ENG-024.

---

# 145. Personal Data

No deberá incluirse innecesariamente en Telemetry.

---

# 146. Data Minimization

Telemetry deberá recopilar solo información necesaria.

---

# 147. Telemetry Retention

La retención pertenece a Operations/Provider Policy.

MEF deberá permitir configurarla mediante Adapters.

---

# 148. Telemetry Export

La exportación deberá desacoplarse del Business Path cuando sea posible.

---

# 149. Exporter

Conceptualmente:

```text
TelemetryExporter
```

---

# 150. Export Failure

No deberá provocar recursión infinita de Telemetry.

---

# 151. Telemetry Recursion

Deberá evitarse:

```text
Exporter fails
   ↓
Emit telemetry
   ↓
Exporter fails
   ↓
Emit telemetry
   ↓
...
```

---

# 152. Last-Resort Diagnostics

Podrá existir mecanismo mínimo independiente para Failures críticas de Telemetry.

---

# 153. Backpressure

Telemetry no deberá consumir recursos ilimitados.

---

# 154. Queue Limits

Exporters asíncronos deberán poseer límites.

---

# 155. Drop Policy

Cuando sea necesario descartar Telemetry deberá existir Policy.

---

# 156. Business Priority

Business Workload deberá tener prioridad sobre Telemetry no crítica.

---

# 157. Audit Priority

Security Audit puede tener requisitos superiores conforme ENG-024.

---

# 158. Observability Configuration

ENG-011 deberá permitir:

```yaml
observability:
  enabled: true
  logs: true
  metrics: true
  tracing: true
  health: true
```

La sintaxis definitiva dependerá del Configuration Contract.

---

# 159. Per-Signal Configuration

Cada Signal podrá habilitarse/configurarse independientemente.

---

# 160. Sampling Configuration

Ejemplo conceptual:

```yaml
tracing:
  sampling:
    strategy: parent
    ratio: 0.10
```

---

# 161. Exporter Configuration

Provider-specific Configuration deberá mantenerse fuera del Core.

---

# 162. Environment Profiles

Development, Test y Production podrán usar diferentes niveles.

---

# 163. Development Profile

Podrá favorecer:

```text
verbose diagnostics
console exporter
high sampling
```

---

# 164. Production Profile

Podrá favorecer:

```text
structured telemetry
controlled sampling
redaction
remote exporters
```

---

# 165. Test Profile

Deberá permitir:

```text
in-memory provider
deterministic assertions
NoOp provider
```

---

# 166. Testing

ENG-009 deberá cubrir Observability Contracts.

---

# 167. Metric Tests

Deberán verificar:

```text
metric name
type
unit
labels
value
```

---

# 168. Trace Tests

Deberán verificar:

```text
span hierarchy
attributes
status
error association
```

---

# 169. Correlation Tests

Deberán comprobar propagación entre:

```text
Logs
Events
Errors
Traces
```

---

# 170. Health Tests

Deberán comprobar:

```text
Healthy
Degraded
Unhealthy
Unknown
```

---

# 171. Health Timeout Test

Una dependencia bloqueada no deberá bloquear indefinidamente el Health Check.

---

# 172. Sensitive Data Test

Deberá comprobar que Telemetry no expone Secrets.

---

# 173. Cardinality Test

Tooling podrá validar Labels prohibidos.

---

# 174. NoOp Test

Deshabilitar Observability no deberá cambiar Business Behavior.

---

# 175. Exporter Failure Test

Una Failure del Exporter no deberá derribar Runtime salvo Policy extraordinaria explícita.

---

# 176. Event Trace Test

Deberá comprobar relación:

```text
publisher
→ event
→ handler
```

---

# 177. Error Trace Test

Deberá comprobar:

```text
error.code
→ span
→ logs
```

---

# 178. Security Telemetry Test

Deberá comprobar Redaction y acceso a Diagnostics.

---

# 179. CLI Integration

ENG-007 podrá incorporar:

```text
mef status
mef health
mef diagnostics
mef metrics
mef trace
mef observability validate
```

---

# 180. `mef status`

Podrá mostrar resumen:

```text
Runtime State
Runtime Health
Active Modules
Failed Modules
```

---

# 181. `mef health`

Podrá mostrar:

```text
runtime
registry
container
event bus
modules
dependencies
```

---

# 182. `mef diagnostics`

Podrá proporcionar Snapshot estructurado.

---

# 183. `mef metrics`

Podrá listar Metrics registradas.

---

# 184. `mef trace`

Podrá consultar Trace/Correlation cuando exista Backend compatible.

---

# 185. `observability validate`

Podrá validar:

```text
provider
exporters
metric definitions
health checks
reserved attributes
configuration
```

---

# 186. Machine Output

Los comandos deberán soportar:

```text
JSON
```

u otro formato estructurado gobernado por CLI Contract.

---

# 187. Build Integration

ENG-012 podrá validar definiciones de Observability.

---

# 188. Build Checks

Podrán incluir:

```text
duplicate metric names
invalid units
reserved attribute misuse
high-cardinality labels
invalid health registration
```

---

# 189. Static Instrumentation Analysis

Tooling podrá detectar patrones inseguros cuando sea posible.

---

# 190. Telemetry Schema

MEF deberá gobernar sus nombres oficiales como Schema lógico.

---

# 191. Schema Evolution

Cambios en nombres consumidos por Tooling deberán evaluarse mediante ENG-016.

---

# 192. Metric Compatibility

Renombrar una Metric pública puede romper Dashboards y Alerts.

---

# 193. Attribute Compatibility

Eliminar un Attribute estable puede romper Consumers.

---

# 194. Trace Compatibility

Los nombres de Spans importantes deberían permanecer estables.

---

# 195. Health Compatibility

Cambiar semántica de Health Status deberá evaluarse cuidadosamente.

---

# 196. Observability Versioning

No será necesario versionar cada Metric individualmente.

---

# 197. Semantic Versioning

Cambios mayores de Telemetry Contract podrán seguir ENG-014/ENG-016.

---

# 198. Runtime Integration

ENG-027 deberá instrumentar fases fundamentales.

---

# 199. Bootstrap Trace

Conceptualmente:

```text
runtime.bootstrap
├── configuration.load
├── packages.discover
├── registry.build
├── container.build
├── contracts.validate
├── events.configure
├── security.validate
└── modules.activate
```

---

# 200. Bootstrap Metrics

Podrán existir:

```text
mef.bootstrap.duration
mef.bootstrap.failures.total
```

---

# 201. Runtime Phase Attribute

Telemetry de Bootstrap deberá poder incluir:

```text
mef.runtime.phase
```

---

# 202. Module Activation Span

```text
module.activate
```

deberá permitir identificar Module.

---

# 203. Contract Resolution Span

```text
contract.resolve
```

podrá identificar Contract.

---

# 204. Event Publish Span

```text
event.publish
```

---

# 205. Event Handle Span

```text
event.handle
```

---

# 206. Container Resolution Span

No deberá instrumentarse cada Resolution indiscriminadamente si produce overhead excesivo.

---

# 207. Instrumentation Cost

Toda Instrumentation tiene costo.

---

# 208. Cost Awareness

Deberán considerarse:

```text
CPU
memory
network
storage
latency
```

---

# 209. Hot Paths

En Hot Paths deberá evitarse Instrumentation excesiva.

---

# 210. Lazy Attribute Evaluation

Implementation Profiles podrán calcular Attributes costosos solo cuando sean necesarios.

---

# 211. Benchmarking

ENG-026 podrá medir overhead de Observability.

---

# 212. Observability Overhead

Deberá existir capacidad de medir:

```text
Telemetry enabled
vs
Telemetry disabled
```

---

# 213. Performance Budget

La implementación podrá establecer presupuesto máximo aceptable.

---

# 214. Health Performance

Health Checks deberán mantenerse rápidos.

---

# 215. Diagnostic Performance

Diagnostics detallados podrán ser más costosos, pero deberán ejecutarse bajo demanda.

---

# 216. Continuous Diagnostics

No deberán recolectarse continuamente datos costosos sin necesidad.

---

# 217. Event Bus Integration

ENG-022 deberá proporcionar Hooks suficientes para instrumentar:

```text
publish
dispatch
handler
retry
dead-letter
```

---

# 218. Error Handling Integration

ENG-023 deberá proporcionar Hooks para:

```text
error creation
translation
unhandled error
fatal error
```

sin producir duplicación innecesaria.

---

# 219. Security Integration

ENG-024 deberá controlar:

```text
telemetry access
sensitive fields
security metrics
audit separation
```

---

# 220. Registry Integration

ENG-020 podrá registrar:

```text
metric definitions
health providers
diagnostic providers
instrumentation providers
```

---

# 221. Registry Freeze

Definitions deberían estabilizarse antes de Runtime Active cuando sea posible.

---

# 222. Container Integration

ENG-019 deberá resolver Providers mediante Contracts.

---

# 223. Dependency Injection

ENG-018 podrá inyectar:

```text
Tracer
MetricRecorder
HealthReporter
```

sin exponer Backend concreto.

---

# 224. Contract Integration

ENG-021 deberá formalizar APIs de Telemetry.

---

# 225. Module Manifest

ENG-003 podrá declarar opcionalmente:

```text
health providers
diagnostic providers
metrics
```

cuando la arquitectura lo formalice.

---

# 226. No Manifest Overload

No toda Instrumentation deberá declararse manualmente en Manifest.

---

# 227. Auto-Instrumentation

Implementation Profiles podrán incorporar Auto-Instrumentation.

---

# 228. Auto-Instrumentation Limits

No deberá romper encapsulamiento ni introducir dependencia propietaria en Domain Logic.

---

# 229. Open Standards

MEF deberá favorecer estándares abiertos cuando sean adecuados.

---

# 230. OpenTelemetry Compatibility

Los Contracts deberán diseñarse de forma compatible conceptualmente con modelos modernos de:

```text
traces
metrics
context propagation
```

sin convertir OpenTelemetry en dependencia obligatoria del Core.

---

# 231. Prometheus Compatibility

Metrics deberían poder exportarse a sistemas de tipo Prometheus mediante Adapter.

---

# 232. Backend Independence

Cambiar Backend no deberá requerir modificar Business Modules.

---

# 233. Multi-Exporter

Podrá permitirse exportar una Signal a múltiples destinos.

---

# 234. Exporter Isolation

La Failure de un Exporter no deberá necesariamente impedir otros Exporters.

---

# 235. Exporter Security

Credentials de Exporters deberán gestionarse como Secrets.

---

# 236. Telemetry Transport

La transmisión remota deberá aplicar Security apropiada.

---

# 237. Observability Access

Dashboards/Backends externos quedan fuera del Core, pero deberán considerarse activos sensibles.

---

# 238. Diagnostic Access Control

CLI/API de Diagnostics deberán aplicar ENG-024.

---

# 239. Production Exposure

No deberá exponerse públicamente un Endpoint detallado de Diagnostics por defecto.

---

# 240. Health Endpoint Exposure

Podrá existir Endpoint mínimo independiente de Diagnostics completos.

---

# 241. Alerting

MEF podrá producir señales aptas para Alerting.

---

# 242. Alerting Is External

La evaluación y entrega de Alerts podrá pertenecer a sistemas externos.

---

# 243. Framework Alerts

MEF no deberá convertirse inicialmente en plataforma completa de Alert Management.

---

# 244. SLI

Las Applications podrán construir Service Level Indicators a partir de Metrics.

---

# 245. SLO

Service Level Objectives pertenecen principalmente al dominio operacional.

---

# 246. Error Budget

Podrá calcularse externamente utilizando Telemetry.

---

# 247. Framework Responsibility

MEF deberá producir señales suficientemente estables para soportar SLI/SLO.

---

# 248. Diagnostic Bundle

Tooling futuro podrá generar:

```text
Diagnostic Bundle
```

---

# 249. Bundle Contents

Podrá incluir:

```text
runtime state
health
module inventory
configuration summary
recent errors
telemetry configuration
versions
```

---

# 250. Bundle Redaction

Deberá aplicar Redaction antes de exportación.

---

# 251. Support Bundle

Podrá utilizarse para soporte técnico.

---

# 252. Reproducibility

Diagnostics deberían incluir suficiente contexto para reproducir problemas cuando sea seguro.

---

# 253. Environment Fingerprint

Podrá incluir:

```text
MEF version
runtime version
OS
architecture
package versions
```

---

# 254. Environment Privacy

No deberá incluir identificadores sensibles innecesarios.

---

# 255. Observability Error Namespace

ENG-025 utilizará:

```text
MEF-OBS-xxx
```

---

# 256. Taxonomía ENG-025

```text
MEF-OBS-001 Invalid telemetry configuration
MEF-OBS-002 Telemetry provider unavailable
MEF-OBS-003 Invalid metric definition
MEF-OBS-004 Duplicate metric name
MEF-OBS-005 Invalid metric unit
MEF-OBS-006 Invalid metric label
MEF-OBS-007 High-cardinality label rejected
MEF-OBS-008 Trace context invalid
MEF-OBS-009 Correlation context invalid
MEF-OBS-010 Span creation failed
MEF-OBS-011 Telemetry export failed
MEF-OBS-012 Health provider unavailable
MEF-OBS-013 Health check timed out
MEF-OBS-014 Invalid health status
MEF-OBS-015 Diagnostic provider failed
MEF-OBS-016 Diagnostic access denied
MEF-OBS-017 Sensitive telemetry rejected
MEF-OBS-018 Reserved attribute violation
MEF-OBS-019 Telemetry queue overflow
MEF-OBS-020 Observability invariant violated
```

---

# 257. Invalid Metric

```text
MEF-OBS-003

Invalid metric definition.

Metric:
mef.event.duration

Reason:
Missing unit.
```

---

# 258. High Cardinality

```text
MEF-OBS-007

High-cardinality metric label rejected.

Metric:
mef.requests.total

Label:
user_id
```

---

# 259. Health Timeout

```text
MEF-OBS-013

Health check timed out.

Provider:
database

Timeout:
2s
```

---

# 260. Sensitive Telemetry

```text
MEF-OBS-017

Sensitive telemetry attribute rejected.

Attribute:
authorization_header
```

---

# 261. Observability Invariant Violation

```text
MEF-OBS-020

Observability invariant violated.

Reason:
Telemetry exporter altered business operation result.
```

---

# 262. Failure Classification

La mayoría de Failures de Observability deberán considerarse:

```text
non-fatal
```

para Business Runtime.

---

# 263. Exceptions

Podrán existir casos donde Telemetry sea operacionalmente obligatoria.

---

# 264. Mandatory Telemetry

Deberá definirse mediante Policy explícita.

---

# 265. Audit Distinction

Mandatory Security Audit seguirá ENG-024 y no deberá confundirse con Telemetry opcional.

---

# 266. Graceful Degradation

Si Metrics Backend falla:

```text
Business Runtime
→ continue

Metrics
→ degraded
```

cuando Policy lo permita.

---

# 267. Export Retry

Exporters podrán aplicar Retry.

---

# 268. Retry Boundaries

Retry deberá ser limitado para evitar presión sobre Runtime.

---

# 269. Buffering

Podrá utilizarse Buffer temporal.

---

# 270. Buffer Limit

Deberá ser finito.

---

# 271. Disk Buffer

Si se utiliza deberá considerar:

```text
capacity
security
retention
cleanup
```

---

# 272. Telemetry Loss

La arquitectura deberá reconocer que Telemetry puede perderse.

---

# 273. Delivery Guarantee

No deberá afirmarse:

```text
exactly once telemetry
```

sin mecanismos que realmente lo garanticen.

---

# 274. Health Reliability

Un Health Check no garantiza ausencia de Failures futuras.

---

# 275. Observability Truth

Telemetry representa observaciones, no una verdad absoluta del sistema.

---

# 276. Diagnostic Consistency

Los Diagnostics deberán indicar cuando una vista sea parcial.

---

# 277. Runtime Shutdown

Telemetry deberá disponer de oportunidad razonable para Flush durante Shutdown.

---

# 278. Flush Timeout

No deberá bloquear Shutdown indefinidamente.

---

# 279. Shutdown Telemetry

Podrá registrar:

```text
runtime.shutdown.duration
runtime.shutdown.errors
```

---

# 280. Fatal Error Telemetry

ENG-023 deberá intentar registrar Failure Fatal antes de terminación cuando sea seguro.

---

# 281. Crash Limitations

No deberá garantizarse Telemetry completa durante Crash abrupto.

---

# 282. Bootstrap Failure

Observability mínima debería estar disponible suficientemente temprano para diagnosticar Bootstrap.

---

# 283. Early Diagnostics

Antes de inicializar Providers completos podrá existir mecanismo mínimo.

---

# 284. Bootstrap Provider

Podrá utilizar:

```text
BootstrapLogger
MinimalTracer
```

según Implementation Profile.

---

# 285. Provider Transition

Al inicializar Observability completa deberá evitarse perder contexto relevante.

---

# 286. Operational Readiness

Antes de Production deberá verificarse:

```text
logs
metrics
health
tracing
error correlation
security redaction
```

---

# 287. Observability Checklist

Como mínimo:

```text
[ ] Runtime health visible
[ ] Module failures visible
[ ] Errors use stable codes
[ ] Correlation works
[ ] Sensitive data redacted
[ ] Metrics cardinality bounded
[ ] Export failure does not break business
[ ] Health checks have timeouts
```

---

# 288. Primera Implementación Recomendada

Implementar:

```text
TelemetryContext

MetricRecorder
Counter
Gauge
Histogram

Tracer
Span

HealthReporter
HealthCheck
HealthStatus

DiagnosticProvider

CorrelationId
TraceId
SpanId

NoOp Providers
InMemory Test Providers
```

---

# 289. Estructura Conceptual

```text
src/
└── Observability/
    ├── TelemetryContext
    ├── Metrics/
    │   ├── MetricRecorder
    │   ├── Counter
    │   ├── Gauge
    │   └── Histogram
    │
    ├── Tracing/
    │   ├── Tracer
    │   ├── Span
    │   └── TraceContext
    │
    ├── Health/
    │   ├── HealthReporter
    │   ├── HealthCheck
    │   └── HealthStatus
    │
    └── Diagnostics/
        └── DiagnosticProvider
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 290. Segunda Fase

Incorporar:

```text
OpenTelemetry Adapter
Prometheus Adapter
Health HTTP Adapter
Diagnostic CLI
Telemetry Validation
Runtime Dashboard Metrics
```

---

# 291. Tercera Fase

Solo cuando exista necesidad:

```text
Distributed Tracing
Adaptive Sampling
Diagnostic Bundles
Advanced Profiling
Continuous Profiling
SLO Tooling
Anomaly Detection
```

---

# 292. Invariantes de Ingeniería

ENG-025 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-446 | Todo componente arquitectónicamente significativo deberá poder producir información suficiente para diagnosticar su estado sin requerir inspección directa de su implementación. |
| EI-447 | Logging, Metrics, Tracing, Health y Diagnostics deberán mantenerse como señales conceptualmente diferenciadas aunque puedan correlacionarse. |
| EI-448 | La instrumentación de Observability no deberá modificar el resultado funcional de una operación de negocio. |
| EI-449 | La Failure de un Provider o Exporter de Telemetry no deberá provocar automáticamente Failure del Business Runtime. |
| EI-450 | Las señales relacionadas con una misma operación deberán poder correlacionarse mediante identificadores estructurados cuando exista Context disponible. |
| EI-451 | Correlation ID, Trace ID y Span ID no deberán utilizarse como mecanismos de Authentication o Authorization. |
| EI-452 | Las Metrics deberán evitar Labels de cardinalidad no controlada. |
| EI-453 | Los nombres, unidades y semántica de Metrics oficiales deberán mantenerse estables cuando sean consumidos por Tooling externo. |
| EI-454 | Telemetry no deberá contener Secrets ni información sensible innecesaria. |
| EI-455 | Health y Runtime State deberán mantenerse como conceptos independientes. |
| EI-456 | Todo Health Check deberá ser limitado en tiempo y evitar Side Effects de negocio. |
| EI-457 | La agregación de Health deberá considerar criticidad de Components y no degradar automáticamente todo Runtime por cualquier Failure opcional. |
| EI-458 | Los Diagnostics deberán respetar Security Policy y aplicar Redaction antes de exposición. |
| EI-459 | Trace Sampling no deberá modificar el comportamiento funcional de la operación instrumentada. |
| EI-460 | La propagación de Context deberá respetar Trust Boundaries y no aceptar Metadata externa arbitraria como confiable. |
| EI-461 | Telemetry deberá utilizar recursos limitados y no competir ilimitadamente con Business Workload. |
| EI-462 | Los Exporters deberán evitar ciclos recursivos de Error Reporting. |
| EI-463 | La observabilidad del Bootstrap deberá comenzar suficientemente temprano para permitir diagnosticar Failures de inicialización. |
| EI-464 | Los cambios en Telemetry Contracts consumidos externamente deberán someterse a Compatibility Analysis. |
| EI-465 | MEF no deberá afirmar garantías de entrega, consistencia o completitud de Telemetry superiores a las realmente proporcionadas por la Implementation. |

---

# 293. Continuidad de Invariantes

```text
ENG-018 → EI-306 a EI-325
ENG-019 → EI-326 a EI-345
ENG-020 → EI-346 a EI-365
ENG-021 → EI-366 a EI-385
ENG-022 → EI-386 a EI-405
ENG-023 → EI-406 a EI-425
ENG-024 → EI-426 a EI-445
ENG-025 → EI-446 a EI-465
```

---

# 294. Criterios de Conformidad

Una implementación será conforme con ENG-025 cuando:

- proporcione Contracts neutrales de Telemetry;
- soporte Metrics;
- soporte Tracing;
- soporte Health;
- soporte Diagnostics;
- integre Logging;
- soporte Correlation;
- proteja información sensible;
- controle Cardinality;
- permita NoOp Providers;
- permita Testing determinista;
- trate Exporter Failures de forma segura;
- distinga Health de Runtime State;
- aplique Timeouts a Health Checks;
- permita Instrumentation del Runtime;
- mantenga independencia de Vendors.

---

# 295. Riesgos

Deberán evitarse especialmente:

## Logging Is Observability

Logs por sí solos no proporcionan necesariamente Observability suficiente.

## Metrics with Unlimited Labels

Produce Cardinality Explosion.

## User IDs as Metric Labels

Genera alta cardinalidad y posibles problemas de privacidad.

## Trace Everything

Puede introducir costo excesivo.

## Telemetry Changes Behavior

La Instrumentation altera el resultado funcional.

## Exporter Dependency

El negocio deja de funcionar porque el Backend de Metrics está caído.

## Health Equals State

Confunde Lifecycle con condición operacional.

## Deep Health Checks

Health Endpoints ejecutan operaciones costosas o destructivas.

## Public Diagnostics

Se exponen internals a usuarios no autorizados.

## Secret Telemetry

Tokens/Credentials terminan en Logs o Traces.

## Vendor Lock-In

Business Modules importan directamente SDK propietario.

## Unbounded Buffers

Telemetry consume memoria ilimitadamente.

## Telemetry Recursion

Una Failure del Exporter genera Telemetry que vuelve a fallar.

## Correlation as Identity

Se utiliza Trace ID para tomar decisiones de Security.

## False Delivery Guarantees

Se afirma que toda Telemetry será entregada sin mecanismos suficientes.

---

# 296. Relación con ENG-010

ENG-010 define Logging.

ENG-025 integra Logging dentro del modelo global:

```text
Logging
   +
Metrics
   +
Tracing
   +
Health
   +
Diagnostics
       ↓
Observability
```

---

# 297. Relación con ENG-015

ENG-015 define State.

ENG-025 observa:

```text
State
Transitions
Duration
Health
Failures
```

sin controlar unilateralmente State Machine.

---

# 298. Relación con ENG-018

Dependency Injection permitirá inyectar:

```text
Tracer
MetricRecorder
HealthReporter
DiagnosticProvider
```

mediante Contracts.

---

# 299. Relación con ENG-019

Service Container deberá resolver Providers sin exponer Backends concretos.

---

# 300. Relación con ENG-020

Registry podrá registrar:

```text
Health Providers
Diagnostic Providers
Metric Definitions
Instrumentation Providers
```

---

# 301. Relación con ENG-021

Contracts deberán estabilizar las APIs de Observability.

---

# 302. Relación con ENG-022

Event Bus deberá proporcionar:

```text
publish metrics
handler metrics
retry metrics
failure metrics
publish spans
handler spans
```

---

# 303. Relación con ENG-023

Error Handling proporcionará:

```text
error.code
category
correlationId
diagnosticId
```

para correlación.

---

# 304. Relación con ENG-024

Security Engineering controlará:

```text
Redaction
Diagnostic Authorization
Sensitive Attributes
Telemetry Transport
Exporter Secrets
```

---

# 305. Relación con ENG-026

ENG-026 deberá medir el costo de Instrumentation y establecer criterios de Performance.

---

# 306. Relación con ENG-027

Runtime Engineering será el principal productor de Telemetry estructural.

Conceptualmente:

```text
Runtime
  │
  ├── Bootstrap
  ├── Registry
  ├── Container
  ├── Contracts
  ├── Events
  ├── Security
  ├── Modules
  └── Shutdown
        │
        ▼
   Observability
```

---

# 307. Principio Rector

> **Observability en MEF deberá convertir el comportamiento del Runtime en señales estructuradas, correlacionables, seguras y tecnológicamente neutrales, permitiendo comprender estado, rendimiento y fallos sin acoplar la lógica de negocio a herramientas específicas de monitoreo.**

---

# 308. Conclusión

**ENG-025 — Observability Engineering** establece cómo MEF podrá observarse a sí mismo.

La arquitectura queda:

```text
                    MEF RUNTIME
                         │
        ┌────────────────┼────────────────┐
        │                │                │
        ▼                ▼                ▼
      LOGS            METRICS           TRACES
        │                │                │
        └──────────┬─────┴───────┬────────┘
                   │             │
                   ▼             ▼
                 HEALTH      DIAGNOSTICS
                   │             │
                   └──────┬──────┘
                          ▼
                      TELEMETRY
                          │
                          ▼
                    OBSERVABILITY
                          │
                          ▼
                      DIAGNOSIS
```

La cadena transversal del núcleo continúa:

```text
ENG-021  Contracts
    ↓
ENG-022  Event Bus
    ↓
ENG-023  Error Handling
    ↓
ENG-024  Security Engineering
    ↓
ENG-025  Observability Engineering
```

La primera implementación deberá priorizar:

```text
Structured Logging Integration
+
Correlation
+
Metrics
+
Tracing
+
Health
+
Diagnostics
+
NoOp Providers
+
Security Redaction
```

sin convertir MEF en una plataforma de Monitoring completa.

La separación fundamental será:

```text
MEF
→ produces structured telemetry

Adapter
→ exports telemetry

Observability Platform
→ stores / queries / visualizes

Operations
→ monitors / alerts / diagnoses
```

Esto permitirá conectar posteriormente:

```text
OpenTelemetry
Prometheus
Grafana
Jaeger
Elastic
Datadog
New Relic
```

mediante Adapters, sin introducir estas tecnologías como dependencias arquitectónicas del Core.

---

# Referencias

## Arquitectura

- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-026
- ENG-027 — Runtime Engineering