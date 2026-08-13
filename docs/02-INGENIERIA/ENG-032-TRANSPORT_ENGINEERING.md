---
id: ENG-032
titulo: Transport Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Communication Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-019
  - ENG-021
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-031
relacionados:
  - ENG-003
  - ENG-006
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-020
  - ENG-029
  - ENG-030
  - ENG-033
keywords:
  - transport
  - networking
  - protocol
  - endpoint
  - request
  - response
  - timeout
  - retry
  - idempotency
  - correlation
  - remote
  - connection
  - resilience
  - mef
---

# ENG-032

# Transport Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Transport Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-032 deberá establecer las reglas para:

```text
Transport
Transport Boundary
Endpoints
Requests
Responses
Protocol Adapters
Connections
Timeouts
Deadlines
Retries
Idempotency
Correlation
Remote Failures
Cancellation
Backpressure
Transport Security
Transport Observability
Transport Lifecycle
Transport Testing
```

El objetivo fundamental será permitir que Contracts y Messages crucen límites de proceso o red sin acoplar la lógica de negocio a protocolos, clientes, sockets o tecnologías concretas.

---

# 2. Declaración

La regla fundamental será:

> **El transporte en MEF deberá mover representaciones contractuales a través de Boundaries explícitas sin convertir el protocolo, la red o el cliente concreto en parte accidental del Business Contract.**

Por tanto:

```text
Business Contract
       │
       ▼
Transport Port
       │
       ▼
Protocol Adapter
       │
       ▼
Serialization
       │
       ▼
Transport
       │
       ▼
Remote Boundary
```

y no:

```text
Business Logic
      ↓
HTTP Client
      ↓
Hard-coded URL
      ↓
Remote System
```

---

# 3. Transport

`Transport` representa el mecanismo responsable de mover información entre dos Communication Endpoints.

---

# 4. Transport Boundary

Una `Transport Boundary` aparece cuando una interacción cruza, por ejemplo:

```text
Process
Host
Container
Virtual Machine
Network
Region
External System
```

---

# 5. Local Call ≠ Remote Call

MEF deberá reconocer:

```text
local invocation
≠
remote invocation
```

Una llamada remota introduce Failure Modes adicionales.

---

# 6. Remote Failure Modes

Entre otros:

```text
latency
timeout
connection failure
partial delivery
duplicate delivery
remote unavailability
protocol failure
serialization failure
authentication failure
rate limiting
```

---

# 7. Fallacies of Distributed Computing

La arquitectura no deberá asumir:

```text
the network is reliable
latency is zero
bandwidth is infinite
the network is secure
topology does not change
transport cost is zero
```

---

# 8. Transport ≠ Business Contract

Deberán mantenerse separados:

```text
Business Contract
→ meaning and behavior

Transport Contract
→ communication mechanics
```

---

# 9. Transport ≠ Serialization

También:

```text
Serialization
→ representation

Transport
→ movement
```

---

# 10. Transport ≠ Protocol

`Transport` es el concepto arquitectónico.

`Protocol` es una implementación o convención concreta.

---

# 11. Protocol Examples

Podrán existir Adapters para:

```text
HTTP
HTTPS
HTTP/2
HTTP/3
WebSocket
gRPC
TCP
Unix Domain Socket
Message Broker Protocols
```

sin convertirlos todos en requisitos del Core.

---

# 12. First Implementation

La primera implementación deberá favorecer protocolos maduros e interoperables.

---

# 13. Protocol Adapter

Un `Protocol Adapter` traduce entre el modelo de Transport de MEF y un protocolo concreto.

```text
MEF Transport
      │
      ▼
Protocol Adapter
      │
      ▼
HTTP / gRPC / etc.
```

---

# 14. Protocol Independence

Business Logic no deberá depender directamente de:

```text
HTTP status codes
HTTP headers
socket objects
gRPC stubs
broker clients
```

salvo en infraestructura especializada.

---

# 15. Transport Port

Un `Transport Port` representa la abstracción utilizada por Consumers.

---

# 16. Outbound Port

Representa una comunicación iniciada desde MEF hacia otro Endpoint.

---

# 17. Inbound Port

Representa una comunicación recibida por MEF.

---

# 18. Endpoint

Un `Endpoint` representa un destino u origen direccionable dentro de un Transport.

---

# 19. Endpoint Identity

Deberá distinguirse entre:

```text
logical endpoint
physical address
```

---

# 20. Logical Endpoint

Ejemplo conceptual:

```text
customer-service
payment-provider
identity-service
```

---

# 21. Physical Address

Ejemplo:

```text
host
port
URL
socket path
broker address
```

---

# 22. Logical ≠ Physical

Business Logic debería depender de identidad lógica cuando sea posible.

---

# 23. Endpoint Resolution

La traducción:

```text
Logical Endpoint
      ↓
Physical Endpoint
```

deberá ocurrir mediante infraestructura.

---

# 24. Endpoint Resolver

Podrá existir:

```text
EndpointResolver
```

---

# 25. Hard-Coded Address

No deberá formar parte de Business Logic.

---

# 26. Configuration

ENG-011 gobernará:

```text
addresses
ports
timeouts
transport options
```

---

# 27. Dynamic Discovery

Podrá incorporarse posteriormente mediante infraestructura especializada.

---

# 28. Request

Un `Request` representa una interacción que espera alguna forma de resultado o aceptación.

---

# 29. Response

Un `Response` representa el resultado transportado de una Request.

---

# 30. One-Way Message

También podrán existir interacciones sin Response de negocio inmediata.

---

# 31. Request/Response ≠ Command/Event

No deberán confundirse.

```text
Request/Response
→ transport interaction pattern

Command/Event
→ semantic message type
```

---

# 32. Command Over Transport

Un Command podrá viajar mediante Request/Response.

---

# 33. Event Over Transport

Un Event podrá viajar mediante Transport asíncrono.

---

# 34. Envelope

Transport podrá utilizar un Envelope.

---

# 35. Transport Envelope

Conceptualmente:

```text
TransportEnvelope
├── messageId
├── correlationId
├── causationId
├── destination
├── contentType
├── schemaVersion
├── deadline
├── metadata
└── payload
```

---

# 36. Envelope ≠ Payload

Deberán mantenerse separados.

---

# 37. Payload

Representa el contenido contractual.

---

# 38. Metadata

Representa información necesaria para transportar, observar o controlar la interacción.

---

# 39. Metadata Pollution

Business Data no deberá esconderse arbitrariamente en Transport Metadata.

---

# 40. Message Identity

Toda interacción que necesite deduplicación o trazabilidad deberá poseer `messageId`.

---

# 41. Correlation

`correlationId` permite relacionar operaciones pertenecientes al mismo flujo lógico.

---

# 42. Causation

`causationId` permite indicar qué Message originó otro.

---

# 43. Correlation ≠ Causation

No deberán confundirse.

---

# 44. Trace Context

ENG-025 gobernará Distributed Trace Context.

---

# 45. Correlation ≠ Trace ID

Podrán coincidir en algunos sistemas.

No deberán asumirse equivalentes.

---

# 46. Request Identity

Requests reintentables deberían poseer identidad estable cuando la operación lo requiera.

---

# 47. Serialization Integration

ENG-031 será responsable de:

```text
payload serialization
schema validation
encoding
content representation
```

---

# 48. Transport Responsibility

ENG-032 será responsable de:

```text
delivery
connection
routing
timeout
retry
remote failure
transport metadata
```

---

# 49. Content Type

Transport deberá identificar la representación del Payload cuando exista más de una.

---

# 50. Content Negotiation

Podrá existir en Protocol Adapters que lo soporten.

---

# 51. Negotiation

No deberá modificar arbitrariamente la semántica del Business Contract.

---

# 52. Unsupported Representation

Deberá producir Failure explícita.

---

# 53. Connection

Una `Connection` representa un recurso de comunicación con Lifetime limitado.

---

# 54. Connection Ownership

Business Logic no deberá abrir/cerrar Connections directamente.

---

# 55. Connection Manager

Podrá existir:

```text
ConnectionManager
```

---

# 56. Connection Pool

Podrá utilizarse cuando Protocol lo permita.

---

# 57. Pool Bounds

Deberán existir límites.

---

# 58. Unbounded Connections

No deberán ser comportamiento predeterminado.

---

# 59. Connection Timeout

Deberá existir donde sea aplicable.

---

# 60. Idle Timeout

Podrá existir.

---

# 61. Keepalive

Podrá utilizarse cuando Protocol lo soporte.

---

# 62. Keepalive ≠ Health

Una Connection viva no implica que el Remote Service esté funcional.

---

# 63. Connection Reuse

Podrá favorecerse para reducir coste.

---

# 64. Stale Connection

Deberá detectarse/tratarse.

---

# 65. Connection Leak

Deberá considerarse Failure operacional.

---

# 66. Timeout

Toda operación remota deberá poder tener Timeout o Deadline finito.

---

# 67. Infinite Wait

No deberá ser Default.

---

# 68. Timeout Types

Podrán diferenciarse:

```text
connect timeout
request timeout
read timeout
write timeout
idle timeout
```

---

# 69. Deadline

Un `Deadline` representa el instante máximo permitido para completar una operación.

---

# 70. Timeout ≠ Deadline

```text
Timeout
→ duration

Deadline
→ absolute limit
```

---

# 71. Deadline Propagation

Cuando una Request downstream forme parte de una operación upstream, deberá respetar el tiempo restante.

---

# 72. Timeout Budget

No deberá reiniciarse ingenuamente en cada Hop.

---

# 73. Example

Incorrecto:

```text
Client: 5 s
  ↓
Service A: 5 s
  ↓
Service B: 5 s
```

Correcto conceptualmente:

```text
Total budget: 5 s
      ↓
remaining budget propagated
```

---

# 74. Cancellation

Transport deberá poder propagar Cancellation cuando Protocol/Runtime lo permita.

---

# 75. Cancellation Is Cooperative

No deberá asumirse que toda operación remota puede detenerse instantáneamente.

---

# 76. Cancelled Request

El Consumer no deberá asumir automáticamente que el Remote Side no produjo efectos.

---

# 77. Timeout Ambiguity

Un Timeout puede significar:

```text
request never arrived
request arrived but not processed
request processed but response lost
request still executing
```

---

# 78. Retry

Un Retry vuelve a intentar una operación después de Failure elegible.

---

# 79. Retry Is Not Universal

No toda Failure deberá reintentarse.

---

# 80. Retry Eligibility

Podrá depender de:

```text
failure category
operation semantics
idempotency
deadline
attempt count
```

---

# 81. Retry Limit

Todo Retry deberá ser limitado.

---

# 82. Infinite Retry

No deberá existir en Request Path ordinario.

---

# 83. Backoff

Retries deberán poder utilizar Backoff.

---

# 84. Exponential Backoff

Podrá utilizarse.

---

# 85. Jitter

Deberá considerarse para evitar sincronización masiva.

---

# 86. Retry Storm

Deberá prevenirse.

---

# 87. Retry Budget

Un sistema podrá limitar el volumen global de Retries.

---

# 88. Deadline Before Retry

No deberá iniciarse Retry si no queda tiempo razonable dentro del Deadline.

---

# 89. Retry Location

Deberá evitarse aplicar múltiples Retry Layers sin coordinación.

---

# 90. Retry Multiplication

Ejemplo peligroso:

```text
Client retries 3x
Service A retries 3x
Service B retries 3x
```

puede multiplicar carga significativamente.

---

# 91. Retry Ownership

Deberá existir un Owner claro de Retry Policy.

---

# 92. Idempotency

Una operación idempotente puede repetirse sin cambiar el resultado semántico después de la primera aplicación válida.

---

# 93. Retry ≠ Idempotency

Retry es mecanismo.

Idempotency es propiedad/estrategia semántica.

---

# 94. Idempotency Key

Operaciones sensibles podrán utilizar:

```text
idempotencyKey
```

---

# 95. Idempotency Scope

Deberá definirse:

```text
consumer
operation
resource
time window
```

según Contract.

---

# 96. Idempotency Storage

Podrá requerir Persistence conforme ENG-030.

---

# 97. Duplicate Request

Deberá devolver resultado coherente cuando Idempotency Contract lo garantice.

---

# 98. Same Key, Different Payload

Deberá rechazarse cuando viole el Contract.

---

# 99. Idempotency Expiration

Podrá existir Retention Policy.

---

# 100. Idempotency Is Not Exactly Once

No deberá afirmarse equivalencia.

---

# 101. At-Most-Once

Podrá ser propiedad de ciertos mecanismos.

---

# 102. At-Least-Once

También.

---

# 103. Exactly-Once

No deberá prometerse sin alcance y mecanismos demostrables.

---

# 104. Delivery Semantics

Todo Transport asíncrono deberá documentar sus garantías.

---

# 105. Ordering

No deberá asumirse orden global.

---

# 106. Ordered Delivery

Si existe deberá definirse Scope.

Ejemplo:

```text
per connection
per partition
per aggregate
```

---

# 107. Duplicate Delivery

Consumers deberán estar preparados cuando Delivery Semantics lo permitan.

---

# 108. Partial Failure

Una operación distribuida puede fallar parcialmente.

---

# 109. Partial Failure Is Normal

La arquitectura deberá contemplarla.

---

# 110. Remote Failure

Los errores remotos deberán traducirse a categorías estables.

---

# 111. Transport Error ≠ Business Error

Deberán distinguirse.

```text
Transport Error
→ communication failed

Business Error
→ remote system processed request and rejected business operation
```

---

# 112. Protocol Error

También deberá distinguirse.

---

# 113. Remote Error Envelope

Podrá transportar información contractual limitada.

---

# 114. Internal Stack Trace

No deberá exponerse como Remote Error Contract.

---

# 115. Error Translation

Protocol-specific Errors deberán traducirse a ENG-023.

---

# 116. Error Namespace

ENG-032 utilizará:

```text
MEF-TRN-xxx
```

---

# 117. Taxonomía ENG-032

```text
MEF-TRN-001 Transport configuration invalid
MEF-TRN-002 Transport unavailable
MEF-TRN-003 Endpoint not found
MEF-TRN-004 Endpoint resolution failed
MEF-TRN-005 Connection failed
MEF-TRN-006 Connection timeout
MEF-TRN-007 Request timeout
MEF-TRN-008 Deadline exceeded
MEF-TRN-009 Request cancelled
MEF-TRN-010 Protocol error
MEF-TRN-011 Unsupported protocol
MEF-TRN-012 Unsupported content type
MEF-TRN-013 Remote unavailable
MEF-TRN-014 Remote transport failure
MEF-TRN-015 Retry exhausted
MEF-TRN-016 Idempotency conflict
MEF-TRN-017 Rate limited
MEF-TRN-018 Backpressure limit reached
MEF-TRN-019 Transport security failure
MEF-TRN-020 Transport invariant violated
```

---

# 118. Endpoint Failure

```text
MEF-TRN-004

Endpoint resolution failed.

Logical endpoint:
payment-provider
```

---

# 119. Connection Failure

```text
MEF-TRN-005

Transport connection failed.

Endpoint:
identity-service

Protocol:
HTTPS
```

---

# 120. Deadline Failure

```text
MEF-TRN-008

Transport deadline exceeded.

Endpoint:
customer-service

Elapsed:
4800 ms

Deadline:
5000 ms
```

---

# 121. Retry Exhausted

```text
MEF-TRN-015

Transport retry policy exhausted.

Endpoint:
payment-provider

Attempts:
3

Last failure:
remote unavailable
```

---

# 122. Idempotency Conflict

```text
MEF-TRN-016

Idempotency key conflict.

Operation:
create-payment

Reason:
same key received with different payload
```

---

# 123. Backpressure

`Backpressure` limita el trabajo aceptado cuando Consumer/Remote no puede procesarlo suficientemente rápido.

---

# 124. No Unlimited Queue

Transport no deberá acumular Requests ilimitadamente.

---

# 125. Queue Bounds

Deberán existir límites cuando se utilicen Buffers/Queues.

---

# 126. Saturation Policy

Podrá ser:

```text
reject
wait bounded
shed load
degrade
```

según Profile.

---

# 127. Load Shedding

Podrá rechazarse trabajo antes de agotar recursos.

---

# 128. Backpressure Failure

Deberá ser observable.

---

# 129. Rate Limiting

Podrá limitar Requests por:

```text
consumer
endpoint
tenant
operation
```

según Security/Architecture.

---

# 130. Rate Limit ≠ Backpressure

```text
Rate Limit
→ policy-controlled admission

Backpressure
→ capacity-controlled flow
```

---

# 131. Rate Limit Response

Deberá permitir al Consumer distinguirla de una Failure permanente.

---

# 132. Retry-After

Podrá utilizarse cuando Protocol lo soporte.

---

# 133. Circuit Breaker

Transport remoto podrá utilizar Circuit Breaker.

---

# 134. Circuit States

Conceptualmente:

```text
Closed
  ↓
Open
  ↓
Half-Open
  ↓
Closed
```

sin crear una State Machine normativa independiente de ENG-015.

---

# 135. Circuit Purpose

Evitar llamadas repetidas hacia un destino probablemente fallido.

---

# 136. Circuit Breaker ≠ Retry

Retry intenta nuevamente.

Circuit Breaker evita intentar temporalmente.

---

# 137. Circuit Scope

Deberá definirse por Endpoint/Operation apropiado.

---

# 138. Circuit Metrics

ENG-025 deberá poder observar su estado.

---

# 139. Bulkhead

Podrá aislar recursos entre destinos o Workloads.

---

# 140. Bulkhead Purpose

Evitar que un Remote Failure consuma todos los recursos del Runtime.

---

# 141. Separate Pools

Podrán utilizarse:

```text
connection pools
worker pools
concurrency limits
```

por destino.

---

# 142. Concurrency Limit

Toda integración remota crítica debería poder limitar concurrencia.

---

# 143. Remote Dependency

Un Remote Endpoint deberá considerarse Dependency explícita.

---

# 144. Required Dependency

Puede afectar Readiness.

---

# 145. Optional Dependency

Puede producir Degraded Mode.

---

# 146. Runtime Integration

ENG-027 gobernará Bootstrap/Shutdown de Transport Infrastructure.

---

# 147. Bootstrap

Conceptualmente:

```text
Load Transport Configuration
        ↓
Register Protocol Adapters
        ↓
Validate Endpoints
        ↓
Initialize Connection Infrastructure
        ↓
Start Inbound Listeners
        ↓
Ready
```

---

# 148. Listener

Un Inbound Transport podrá requerir Listener.

---

# 149. Listener Lifecycle

Deberá coordinarse con Runtime.

---

# 150. Readiness Before Listener

No deberá aceptar tráfico antes de que Dependencies obligatorias estén preparadas.

---

# 151. Shutdown

Conceptualmente:

```text
Stop accepting new requests
        ↓
Drain in-flight work
        ↓
Cancel remaining work
        ↓
Close listeners
        ↓
Close connections
        ↓
Dispose transport resources
```

---

# 152. Graceful Shutdown

Deberá ser limitado por Deadline.

---

# 153. Infinite Drain

No deberá impedir Shutdown indefinidamente.

---

# 154. In-Flight Request

La Policy deberá definir tratamiento durante Shutdown.

---

# 155. Transport Security

ENG-024 será autoridad sobre Security.

---

# 156. Transport Encryption

Remote Transport deberá utilizar Encryption cuando Security Policy lo requiera.

---

# 157. TLS

Podrá utilizarse para protocolos compatibles.

---

# 158. Certificate Validation

No deberá deshabilitarse silenciosamente en Production.

---

# 159. Authentication

Inbound/Outbound Transport podrá requerir Authentication.

---

# 160. Authentication ≠ Authorization

Deberán mantenerse separadas.

---

# 161. Transport Identity

Podrá representar identidad técnica del Caller/Service.

---

# 162. Service Identity

Deberá verificarse cuando Trust Model lo requiera.

---

# 163. Credentials

No deberán hardcodearse en Endpoint Configuration.

---

# 164. Secrets

ENG-024 gobernará Credentials/Keys/Tokens.

---

# 165. Header Injection

Protocol Adapters deberán protegerse contra Metadata no confiable.

---

# 166. SSRF

Outbound Transports que acepten destinos dinámicos deberán aplicar controles para evitar acceso arbitrario a recursos internos.

---

# 167. Open Redirect/Proxy Behavior

MEF no deberá convertirse accidentalmente en proxy hacia destinos controlados por Input no confiable.

---

# 168. Endpoint Allowlist

Podrá utilizarse cuando destinos estén restringidos.

---

# 169. DNS/Rebinding Risks

Transport Security deberá considerarlos cuando Endpoint Resolution sea dinámico.

---

# 170. Metadata Trust

Inbound Metadata no deberá considerarse confiable automáticamente.

---

# 171. Forwarded Identity

Solo deberá confiarse desde infraestructura autorizada.

---

# 172. Trace Headers

Deberán validarse y limitarse.

---

# 173. Sensitive Headers

No deberán aparecer en Logs.

---

# 174. Payload Security

ENG-031 y ENG-024 gobernarán Payload Validation/Protection.

---

# 175. Transport Size Limits

Inbound Transport deberá aplicar límites antes o durante lectura cuando sea posible.

---

# 176. Slow Client

Deberá evitarse que consuma recursos indefinidamente.

---

# 177. Slowloris-Type Risk

Timeouts y límites deberán mitigar conexiones extremadamente lentas.

---

# 178. Streaming

Transport podrá soportar Streaming.

---

# 179. Streaming ≠ Buffered Request

Deberán diferenciarse.

---

# 180. Stream

Podrá representar secuencia potencialmente larga de datos.

---

# 181. Streaming Backpressure

Deberá soportarse cuando sea posible.

---

# 182. Stream Cancellation

Deberá poder propagarse.

---

# 183. Stream Lifetime

Deberá poseer límites apropiados.

---

# 184. Streaming Serialization

ENG-031 podrá integrarse.

---

# 185. Bidirectional Streaming

Podrá existir en Protocols que lo soporten.

No será requisito inicial.

---

# 186. Chunking

Podrá ser responsabilidad del Protocol Adapter.

---

# 187. Large Payload

Deberá evaluarse si Transport directo es apropiado.

---

# 188. Blob Transfer

Podrá favorecer:

```text
Object Storage
+
Reference
```

sobre transportar grandes objetos dentro de Messages ordinarios.

---

# 189. Transport Contract

Podrá definir:

```text
endpoint
interaction pattern
deadline policy
delivery semantics
content type
idempotency
```

---

# 190. Business Contract

Seguirá definiendo:

```text
operation meaning
input semantics
output semantics
business errors
```

---

# 191. Adapter Translation

Protocol Adapter traduce entre ambos.

---

# 192. HTTP Adapter Example

Conceptualmente:

```text
Business Operation
       │
       ▼
Transport Request
       │
       ▼
HTTP Adapter
       │
       ├── method
       ├── path
       ├── headers
       └── status
```

---

# 193. HTTP Status

No deberá filtrarse automáticamente como Domain Error.

---

# 194. Status Translation

Ejemplo conceptual:

```text
HTTP 503
→ RemoteUnavailable

HTTP 429
→ RateLimited
```

según Adapter Contract.

---

# 195. Business Failure over HTTP

Un HTTP Response exitosamente transportado puede contener Business Failure.

---

# 196. Transport Success ≠ Business Success

Regla fundamental:

```text
message delivered successfully
≠
business operation succeeded
```

---

# 197. Async Transport

Podrá existir mediante Broker/Queue Adapter.

---

# 198. Async Delivery

Deberá declarar:

```text
ack semantics
redelivery
ordering
retention
dead-letter behavior
```

---

# 199. Acknowledgement

`ACK` deberá poseer semántica explícita.

---

# 200. ACK ≠ Business Completion

Puede significar únicamente recepción técnica.

---

# 201. Negative Acknowledgement

Podrá solicitar Redelivery según Adapter.

---

# 202. Dead Letter

Podrá utilizarse para Messages no procesables.

---

# 203. Dead-Letter Queue

No deberá convertirse en almacenamiento olvidado.

---

# 204. Dead-Letter Observability

Deberá generar señal operacional.

---

# 205. Poison Message

Un Message que falla repetidamente deberá evitar loops infinitos.

---

# 206. Redelivery Limit

Deberá ser finito.

---

# 207. Messaging Integration

ENG-022 continuará gobernando Event Bus Semantics.

---

# 208. Transport Role

ENG-032 podrá proporcionar infraestructura para transportar Events entre procesos.

---

# 209. Event Bus ≠ Transport

Event Bus define semántica de publicación/consumo.

Transport mueve los Messages.

---

# 210. Remote Event Bus

Conceptualmente:

```text
Event
  ↓
Event Bus
  ↓
Transport Adapter
  ↓
Broker / Network
```

---

# 211. Persistence Integration

ENG-030 podrá proporcionar:

```text
Outbox
Inbox
Idempotency Store
```

---

# 212. Outbox Transport

Publisher deberá transportar Outbox Records mediante ENG-032.

---

# 213. Delivery Confirmation

Deberá alinearse con la semántica del Adapter.

---

# 214. Observability

ENG-025 gobernará Transport Telemetry.

---

# 215. Standard Attributes

Podrán incluir:

```text
mef.transport.protocol
mef.transport.endpoint
mef.transport.direction
mef.transport.operation
mef.transport.result
```

---

# 216. Transport Metrics

Podrán incluir:

```text
mef.transport.requests.total
mef.transport.failures.total
mef.transport.duration
mef.transport.inflight
mef.transport.retries.total
mef.transport.timeouts.total
mef.transport.connections.active
```

---

# 217. Endpoint Cardinality

No deberán utilizarse URLs completas con IDs dinámicos como Metric Labels.

---

# 218. Normalized Endpoint

Preferir:

```text
/orders/{id}
```

sobre:

```text
/orders/987654
```

---

# 219. Trace Propagation

Transport deberá propagar Context autorizado.

---

# 220. Trace Context Security

No deberá utilizarse para transportar autorización de negocio.

---

# 221. Request Logging

No deberá registrar Payload completo por defecto.

---

# 222. Sensitive Metadata

Deberá aplicar Redaction.

---

# 223. Performance

ENG-026 gobernará Transport Performance.

---

# 224. Transport Benchmarks

Podrán medir:

```text
latency
throughput
connections
concurrency
payload size
serialization overhead
retry overhead
```

---

# 225. Tail Latency

Deberá considerarse:

```text
p95
p99
```

cuando sea relevante.

---

# 226. Average Is Not Enough

Promedio no deberá ser única métrica para sistemas remotos críticos.

---

# 227. Connection Pool Saturation

Deberá medirse.

---

# 228. Queue Saturation

También.

---

# 229. Retry Amplification

También.

---

# 230. Compression

Podrá reducir Network Cost pero aumentar CPU.

---

# 231. Compression Threshold

Podrá configurarse.

---

# 232. Small Payload Compression

No deberá asumirse beneficiosa.

---

# 233. Testing

ENG-009 deberá soportar Transport Tests.

---

# 234. Adapter Unit Test

Deberá probar traducción entre MEF y Protocol.

---

# 235. Contract Test

Deberá probar Business/Transport mapping.

---

# 236. Integration Test

Deberá utilizar Transport real cuando sea relevante.

---

# 237. Timeout Test

Deberá comprobar expiración.

---

# 238. Retry Test

Deberá comprobar:

```text
attempt limit
backoff
eligible failures
deadline
```

---

# 239. Idempotency Test

Deberá probar Requests duplicadas.

---

# 240. Different Payload Same Key Test

Deberá producir Conflict.

---

# 241. Cancellation Test

Deberá probar propagación.

---

# 242. Connection Failure Test

También.

---

# 243. Remote Failure Test

También.

---

# 244. Backpressure Test

Deberá probar Saturation.

---

# 245. Rate Limit Test

También.

---

# 246. Circuit Breaker Test

Deberá probar transiciones permitidas.

---

# 247. Security Test

Deberá probar:

```text
TLS validation
credential handling
endpoint restrictions
metadata validation
SSRF controls
```

cuando correspondan.

---

# 248. Chaos/Fault Injection

Podrá utilizarse para simular:

```text
latency
packet loss
connection reset
remote outage
partial response
```

---

# 249. Deterministic Tests

Retry/Timeout Tests deberían utilizar Clock/Scheduler controlable cuando sea posible.

---

# 250. Build Integration

ENG-012 podrá validar Transport Definitions.

---

# 251. Build Gate

Podrá detectar:

```text
invalid endpoint
missing protocol adapter
invalid timeout
incompatible content type
missing transport contract
duplicate route
```

---

# 252. Release Integration

ENG-017 deberá considerar cambios de Endpoints/Protocols públicos.

---

# 253. Breaking Transport Change

Puede incluir:

```text
endpoint removal
protocol removal
interaction pattern change
delivery semantics change
required metadata change
```

---

# 254. Endpoint Migration

Deberá permitir coexistencia cuando Compatibility lo requiera.

---

# 255. Protocol Versioning

Deberá obedecer ENG-014/ENG-016.

---

# 256. Registry Integration

ENG-020 podrá registrar:

```text
Transport Adapters
Protocols
Logical Endpoints
Capabilities
```

---

# 257. Extension Integration

ENG-029 podrá permitir Protocol Adapters adicionales.

---

# 258. Transport Extension Point

Conceptualmente:

```text
XP-TRANSPORT-ADAPTER-001
```

---

# 259. Transport Adapter Capability

Podrá declarar:

```text
request-response
one-way
streaming
multiplexing
encryption
ordered-delivery
```

---

# 260. Capability Validation

Runtime deberá verificar requisitos.

---

# 261. Container Integration

ENG-019 podrá construir:

```text
TransportClient
EndpointResolver
ConnectionManager
ProtocolAdapter
RetryPolicy
```

con Scopes apropiados.

---

# 262. DI Integration

Application Services deberán recibir Ports/Clients abstractos.

---

# 263. No Global HTTP Client Access

Business Logic no deberá resolver un cliente global para llamar cualquier URL arbitraria.

---

# 264. Typed Client

Podrá favorecerse:

```text
PaymentGateway
CustomerDirectory
IdentityProvider
```

sobre:

```text
HttpClient
```

en Application Layer.

---

# 265. Typed Client Contract

Deberá expresar semántica del Remote Dependency.

---

# 266. Typed Client Adapter

Traducirá hacia Transport.

---

# 267. Architecture

```text
Application
    │
    ▼
Typed Remote Contract
    │
    ▼
Transport Port
    │
    ▼
Protocol Adapter
    │
    ▼
Serializer
    │
    ▼
Network
```

---

# 268. CLI Integration

ENG-007 podrá incorporar:

```text
mef transport list
mef transport inspect
mef transport validate
mef endpoint list
mef endpoint inspect
mef endpoint probe
```

---

# 269. `transport list`

Podrá mostrar:

```text
Adapter
Protocol
Capabilities
State
```

---

# 270. `endpoint list`

Podrá mostrar:

```text
Logical ID
Protocol
State
Owner
```

sin Credentials.

---

# 271. `endpoint inspect`

Podrá mostrar Configuration no sensible.

---

# 272. `endpoint probe`

Podrá comprobar Connectivity.

---

# 273. Probe ≠ Business Health

Deberá indicarse claramente.

---

# 274. Machine Output

Los comandos deberán soportar salida estructurada.

---

# 275. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Transport
TransportClient
TransportRequest
TransportResponse
TransportEnvelope

Endpoint
EndpointId
EndpointResolver

ProtocolAdapter
ProtocolRegistry

ConnectionManager

TimeoutPolicy
Deadline
CancellationToken

RetryPolicy
BackoffPolicy

IdempotencyKey

TransportErrorTranslator
TransportHealth
```

---

# 276. Optional Initial Components

Podrán incorporarse:

```text
CircuitBreaker
RateLimiter
ConcurrencyLimiter
Bulkhead
StreamingTransport
```

cuando exista necesidad inmediata.

---

# 277. Conceptual Directory Structure

```text
src/
└── Transport/
    ├── Contract/
    │   ├── Transport
    │   └── TransportClient
    │
    ├── Message/
    │   ├── TransportRequest
    │   ├── TransportResponse
    │   └── TransportEnvelope
    │
    ├── Endpoint/
    │   ├── Endpoint
    │   ├── EndpointId
    │   └── EndpointResolver
    │
    ├── Protocol/
    │   ├── ProtocolAdapter
    │   └── ProtocolRegistry
    │
    ├── Connection/
    │   └── ConnectionManager
    │
    ├── Timeout/
    │   ├── TimeoutPolicy
    │   └── Deadline
    │
    ├── Cancellation/
    │   └── CancellationToken
    │
    ├── Retry/
    │   ├── RetryPolicy
    │   └── BackoffPolicy
    │
    ├── Idempotency/
    │   └── IdempotencyKey
    │
    ├── Resilience/
    │   ├── CircuitBreaker
    │   ├── RateLimiter
    │   └── Bulkhead
    │
    ├── Error/
    │   └── TransportErrorTranslator
    │
    └── Health/
        └── TransportHealth
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 278. Outbound Architecture

```text
Application
     │
     ▼
Remote Contract
     │
     ▼
Transport Client
     │
     ▼
Endpoint Resolver
     │
     ▼
Protocol Adapter
     │
     ▼
Serialization
     │
     ▼
Connection
     │
     ▼
Remote Endpoint
```

---

# 279. Inbound Architecture

```text
Network
   │
   ▼
Listener
   │
   ▼
Protocol Adapter
   │
   ▼
Transport Validation
   │
   ▼
Deserialization
   │
   ▼
Contract
   │
   ▼
Application
```

---

# 280. Resilience Architecture

```text
Request
  │
  ▼
Deadline
  │
  ▼
Rate / Concurrency Limit
  │
  ▼
Circuit Breaker
  │
  ▼
Transport Attempt
  │
  ├── success ─────────► Response
  │
  └── transient failure
            │
            ▼
       Retry Policy
            │
            ▼
         Backoff
            │
            └──────────► next attempt
```

---

# 281. Timeout Architecture

```text
Upstream Deadline
       │
       ▼
Remaining Budget
       │
       ▼
Service A
       │
       ▼
Reduced Remaining Budget
       │
       ▼
Service B
```

---

# 282. Idempotency Architecture

```text
Request
   │
   ▼
Idempotency Key
   │
   ▼
Idempotency Store
   │
 ┌─┴──────────────┐
 ▼                ▼
New             Existing
 │                │
 ▼                ▼
Process      Return prior result
 │
 ▼
Persist result
```

---

# 283. Remote Failure Architecture

```text
Protocol Failure
      │
      ▼
Protocol Adapter
      │
      ▼
Transport Error Translator
      │
      ▼
MEF-TRN Error
      │
 ┌────┴─────────┐
 ▼              ▼
Transient     Permanent
 │              │
 ▼              ▼
Retry?         Fail
```

---

# 284. Security Architecture

```text
Logical Endpoint
      │
      ▼
Endpoint Policy
      │
      ▼
Credential Provider
      │
      ▼
TLS / Authentication
      │
      ▼
Protocol Adapter
      │
      ▼
Remote Endpoint
```

---

# 285. Async Architecture

```text
Event / Message
      │
      ▼
Event Bus
      │
      ▼
Transport Adapter
      │
      ▼
Broker
      │
      ▼
Transport Adapter
      │
      ▼
Consumer
```

---

# 286. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Logical Endpoints
Typed Remote Contracts
Finite Timeouts
Deadline Propagation
Bounded Retries
Exponential Backoff + Jitter
Idempotency Support
Bounded Connections
Bounded Queues
Transport Error Translation
TLS-capable Protocol Adapters
Transport Observability
Static Endpoint Configuration
```

---

# 287. First Version Non-Goals

No deberá requerir:

```text
Service Mesh
Dynamic Service Discovery
HTTP/3
Universal RPC
Distributed Transactions
Exactly-Once Network Delivery
Transparent Failover Across Regions
Automatic Multi-Protocol Negotiation
Global Traffic Management
```

---

# 288. Second Phase

Podrá incorporar:

```text
Circuit Breakers
Bulkheads
Rate Limiting
Advanced Streaming
Dynamic Endpoint Discovery
Load Balancing
Health-aware Routing
Broker Transport
```

---

# 289. Third Phase

Solo cuando exista necesidad:

```text
Service Mesh Integration
Multi-Region Routing
Advanced RPC
Adaptive Concurrency
Traffic Shaping
Hedged Requests
Protocol Federation
```

---

# 290. Invariantes de Ingeniería

ENG-032 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-586 | Toda interacción remota deberá tratarse como una operación con Failure Modes diferentes a una invocación local. |
| EI-587 | Business Contracts no deberán depender accidentalmente de protocolos, sockets, clientes o direcciones físicas concretas. |
| EI-588 | Serialization y Transport deberán permanecer como responsabilidades arquitectónicas distintas. |
| EI-589 | Los Logical Endpoints deberán poder separarse de sus direcciones físicas cuando la Boundary lo requiera. |
| EI-590 | Business Logic no deberá administrar Connections o Listeners directamente. |
| EI-591 | Toda operación remota deberá poder poseer Timeout o Deadline finito apropiado. |
| EI-592 | Los Deadline Budgets deberán propagarse sin reiniciarse ingenuamente en cada Hop. |
| EI-593 | Un Timeout o Cancellation no deberá interpretarse automáticamente como ausencia de efectos remotos. |
| EI-594 | Los Retries deberán ser limitados, gobernados por Failure Category y compatibles con la semántica de la operación. |
| EI-595 | Una operación no idempotente no deberá reintentarse automáticamente sin un mecanismo que preserve su Correctness. |
| EI-596 | Idempotency no deberá confundirse con garantía de Exactly-Once Delivery. |
| EI-597 | Transport Success no deberá interpretarse como Business Success. |
| EI-598 | Transport Errors, Protocol Errors y Business Errors deberán conservar categorías distinguibles. |
| EI-599 | Buffers, Queues, Connections y Concurrency deberán poseer límites para evitar agotamiento de recursos. |
| EI-600 | Transport Security deberá validar identidad, Encryption y Metadata según ENG-024 sin confiar automáticamente en Input remoto. |
| EI-601 | Retries, Circuit Breakers y otras Resilience Policies no deberán componerse de forma que multipliquen carga sin control. |
| EI-602 | Event Bus Semantics y Transport Semantics deberán mantenerse separadas aunque utilicen la misma infraestructura física. |
| EI-603 | Transport Telemetry no deberá revelar Credentials, Tokens, Payloads sensibles o Endpoints dinámicos de alta Cardinality por defecto. |
| EI-604 | Runtime Shutdown deberá detener admisión de nuevo trabajo y drenar recursos de Transport dentro de un Deadline finito. |
| EI-605 | La primera implementación deberá favorecer comunicación explícita, limitada, observable y segura antes de introducir routing distribuido avanzado. |

---

# 291. Continuidad de Invariantes

```text
ENG-028 → EI-506 a EI-525
ENG-029 → EI-526 a EI-545
ENG-030 → EI-546 a EI-565
ENG-031 → EI-566 a EI-585
ENG-032 → EI-586 a EI-605
```

---

# 292. Criterios de Conformidad

Una implementación será conforme con ENG-032 cuando:

- diferencie Local y Remote Invocation;
- diferencie Business Contract y Transport;
- diferencie Transport y Serialization;
- utilice Logical Endpoints cuando corresponda;
- permita Endpoint Resolution;
- abstraiga Protocols mediante Adapters;
- administre Connections fuera del Domain;
- limite Connections;
- utilice Timeouts/Deadlines;
- permita Deadline Propagation;
- contemple Cancellation;
- trate Timeout como resultado ambiguo;
- limite Retries;
- utilice Backoff;
- contemple Jitter;
- preserve Idempotency;
- diferencie Transport y Business Errors;
- limite Buffers/Queues;
- soporte Backpressure;
- integre Security;
- integre Observability;
- coordine Lifecycle con Runtime;
- soporte Testing;
- no requiera infraestructura distribuida avanzada.

---

# 293. Riesgos

Deberán evitarse especialmente:

## Remote Equals Local

Una llamada de red se trata como llamada a método.

## Protocol Leakage

HTTP/gRPC invade Business Logic.

## Hard-Coded Endpoint

URLs forman parte del código de negocio.

## Infinite Timeout

Requests pueden esperar indefinidamente.

## Timeout Reset

Cada Hop reinicia el Budget completo.

## Blind Retry

Toda Failure se reintenta.

## Retry Storm

Un incidente genera más tráfico.

## Retry Multiplication

Múltiples Layers reintentan independientemente.

## Non-Idempotent Retry

Se duplican efectos de negocio.

## Exactly-Once Illusion

Se promete una garantía inexistente.

## Transport Success Equals Business Success

Una respuesta técnica se interpreta como éxito funcional.

## Unbounded Connection Pool

Un Remote Failure agota recursos locales.

## Unbounded Queue

Backpressure se transforma en Memory Exhaustion.

## Payload Logging

Transport Logs exponen datos sensibles.

## Disabled TLS Validation

Production acepta certificados no válidos.

## Arbitrary Destination

Input externo controla el destino de Requests.

## Event Bus Equals Broker

Se confunde semántica con infraestructura.

## ACK Equals Completed

Acknowledgement técnico se interpreta como operación terminada.

## Infinite Graceful Shutdown

El Runtime nunca finaliza por Requests pendientes.

---

# 294. Relación con ENG-019

Service Container construye:

```text
Transport Clients
Protocol Adapters
Endpoint Resolvers
Connection Managers
Resilience Policies
```

---

# 295. Relación con ENG-020

Registry podrá mantener:

```text
Protocols
Adapters
Logical Endpoints
Transport Capabilities
```

---

# 296. Relación con ENG-021

Contracts definen el significado de las operaciones transportadas.

Transport no redefine Business Semantics.

---

# 297. Relación con ENG-022

Event Bus define semántica de Events.

ENG-032 permite transportarlos entre Boundaries remotas.

---

# 298. Relación con ENG-023

Transport deberá traducir Failures específicas de Protocol a errores estables `MEF-TRN-*`.

---

# 299. Relación con ENG-024

Security gobierna:

```text
TLS
Authentication
Service Identity
Credentials
Endpoint Trust
Metadata Trust
SSRF Controls
```

---

# 300. Relación con ENG-025

Observability gobierna:

```text
Tracing
Correlation
Metrics
Logging
Remote Dependency Health
```

---

# 301. Relación con ENG-026

Performance Engineering gobierna:

```text
Latency
Throughput
Concurrency
Connection Saturation
Tail Latency
Retry Amplification
```

---

# 302. Relación con ENG-027

Runtime gobierna:

```text
Transport Bootstrap
Listener Activation
Readiness
Drain
Shutdown
Resource Disposal
```

---

# 303. Relación con ENG-028

Modules podrán declarar Remote Dependencies sin administrar directamente Protocol Infrastructure.

---

# 304. Relación con ENG-029

Protocol Adapters podrán incorporarse mediante Extension Points gobernados.

---

# 305. Relación con ENG-030

Persistence podrá proporcionar:

```text
Outbox
Inbox
Idempotency Store
Delivery State
```

---

# 306. Relación con ENG-031

Serialization transforma Contracts en representaciones.

Transport mueve esas representaciones.

```text
Contract
   ↓
Schema
   ↓
Serialization
   ↓
Transport
   ↓
Remote Boundary
```

---

# 307. Principio Rector

> **MEF deberá tratar toda comunicación remota como una Boundary explícita, falible, limitada y observable, separando Business Contracts de Protocols y aplicando Timeouts, Deadlines, Idempotency, Backpressure, Security y Error Translation como propiedades de primera clase.**

---

# 308. Conclusión

**ENG-032 — Transport Engineering** formaliza cómo MEF mueve información entre procesos, hosts y sistemas externos.

La arquitectura queda:

```text
                APPLICATION
                     │
                     ▼
             REMOTE CONTRACT
                     │
                     ▼
              TRANSPORT PORT
                     │
                     ▼
            ENDPOINT RESOLVER
                     │
                     ▼
             PROTOCOL ADAPTER
                     │
                     ▼
              SERIALIZATION
                     │
                     ▼
                 NETWORK
                     │
                     ▼
             REMOTE ENDPOINT
```

Las responsabilidades quedan separadas:

```text
Contract
→ defines meaning

Serialization
→ defines representation

Transport
→ moves representation

Protocol Adapter
→ talks protocol

Endpoint Resolver
→ determines destination

Resilience
→ controls failure behavior

Security
→ establishes trust

Observability
→ explains what happened
```

Una llamada remota nunca deberá modelarse simplemente como:

```text
remote.method()
```

sin considerar:

```text
Timeout
Deadline
Cancellation
Retry
Idempotency
Partial Failure
Backpressure
Security
Observability
```

La primera implementación deberá concentrarse en:

```text
Logical Endpoints
Typed Remote Contracts
Protocol Adapters
Finite Timeouts
Deadline Propagation
Bounded Retries
Idempotency
Connection Limits
Error Translation
Security
Observability
```

antes de introducir:

```text
Service Mesh
Multi-Region Routing
Adaptive Concurrency
Dynamic Service Discovery
Advanced RPC
Traffic Federation
```

Con ENG-032 la serie global alcanza:

```text
EI-605
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
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
- ENG-029 — Extension Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering