---
id: ENG-041
titulo: Messaging Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Messaging Engineering
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
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-040
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-033
  - ENG-037
  - ENG-042
keywords:
  - messaging
  - message
  - envelope
  - producer
  - consumer
  - broker
  - topic
  - queue
  - routing
  - partition
  - ordering
  - acknowledgement
  - redelivery
  - idempotency
  - deduplication
  - dead-letter
  - schema-evolution
  - correlation
  - causation
  - mef
---

# ENG-041

# Messaging Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Messaging Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-041 establece las reglas para:

```text
Message
Message Type
Message Identity
Envelope
Headers
Payload
Producer
Publisher
Consumer
Subscriber
Broker
Destination
Queue
Topic
Subscription
Routing
Partitioning
Ordering
Delivery Semantics
Acknowledgement
Negative Acknowledgement
Redelivery
Retry
Backoff
Idempotency
Deduplication
Dead Letter
Poison Message
Message Expiration
Correlation
Causation
Schema Evolution
Compatibility
Security
Observability
Backpressure
Flow Control
Transactional Messaging
Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo mensaje intercambiado entre Boundaries deberá poseer Contract, identidad, semántica de entrega, Ownership y estrategia de Failure explícitos.**

La arquitectura conceptual será:

```text
Producer
   │
   ▼
Message
   │
   ▼
Envelope
   │
   ▼
Transport Adapter
   │
   ▼
Broker
   │
   ▼
Destination
   │
   ▼
Consumer
   │
   ▼
Message Handler
   │
   ├── ACK
   ├── RETRY
   ├── DEAD LETTER
   └── REJECT
```

---

# 3. Messaging

`Messaging` representa intercambio desacoplado de información entre Components, Processes o Systems.

---

# 4. Messaging ≠ Event Bus

ENG-022 define Event Bus principalmente dentro de una Boundary controlada por MEF.

ENG-041 define Messaging capaz de atravesar:

```text
process boundary
host boundary
service boundary
network boundary
organizational boundary
```

---

# 5. Messaging ≠ Background Jobs

ENG-040 representa trabajo que debe ejecutarse.

ENG-041 representa información que debe transportarse.

```text
Job
→ execute this work

Message
→ communicate this information
```

---

# 6. Messaging ≠ Transport

ENG-032 define mecanismos de transporte.

ENG-041 define semántica de mensajes sobre dichos mecanismos.

---

# 7. Message

Un `Message` representa información intercambiada mediante un Contract explícito.

---

# 8. Message Categories

MEF deberá distinguir conceptualmente:

```text
Command
Event
Notification
Reply
```

cuando dicha distinción tenga relevancia arquitectónica.

---

# 9. Command

Expresa intención:

```text
DoSomething
```

Ejemplo:

```text
CreateInvoice
```

---

# 10. Event

Expresa un hecho:

```text
SomethingHappened
```

Ejemplo:

```text
InvoiceCreated
```

---

# 11. Notification

Comunica información sin requerir necesariamente una acción específica.

---

# 12. Reply

Representa respuesta a una interacción basada en Messaging.

---

# 13. Command Naming

Deberá favorecer forma imperativa:

```text
GenerateInvoice
SynchronizeCustomer
SendNotification
```

---

# 14. Event Naming

Deberá favorecer pasado:

```text
InvoiceGenerated
CustomerSynchronized
OrderCancelled
```

---

# 15. Event Immutability

Un Event publicado representa un hecho ocurrido y no deberá modificarse retroactivamente.

---

# 16. Message Identity

Todo mensaje durable deberá poseer:

```text
messageId
```

único.

---

# 17. Message Type

Todo Contract deberá poseer identificador estable:

```text
messageType
```

---

# 18. Message Type Stability

No deberá derivarse exclusivamente del nombre físico de una Class.

---

# 19. Example

Preferir:

```text
sales.order.created.v1
```

sobre:

```text
App\Domain\Order\OrderCreatedEvent
```

---

# 20. Message Contract

Conceptualmente:

```text
Message
├── messageId
├── messageType
├── schemaVersion
├── payload
└── metadata
```

---

# 21. Envelope

El `Envelope` transporta Payload y Metadata.

---

# 22. Envelope Structure

Conceptualmente:

```text
Envelope
├── id
├── type
├── schemaVersion
├── timestamp
├── correlationId
├── causationId
├── tenantId
├── contentType
├── headers
└── payload
```

---

# 23. Payload vs Envelope

```text
Payload
→ business information

Envelope
→ transport/messaging metadata
```

---

# 24. Metadata Separation

Transport Metadata no deberá contaminar innecesariamente Domain Objects.

---

# 25. Headers

Podrán contener Metadata transversal.

---

# 26. Header Namespace

Deberá evitar colisiones.

MEF podrá reservar:

```text
mef.*
```

---

# 27. Reserved Headers

Conceptualmente:

```text
mef.message-id
mef.message-type
mef.schema-version
mef.correlation-id
mef.causation-id
mef.tenant-id
mef.created-at
mef.content-type
```

---

# 28. Application Headers

Deberán utilizar Namespace diferente cuando sea necesario.

---

# 29. Header Trust

Headers recibidos no deberán considerarse confiables automáticamente.

---

# 30. Header Size

Deberá mantenerse acotado.

---

# 31. Payload

El Payload deberá ser:

```text
explicit
serializable
versionable
minimal
```

---

# 32. Object Graph

No deberá serializarse arbitrariamente un Object Graph interno.

---

# 33. Payload Contract

Deberá representar datos del Contract, no Implementation State.

---

# 34. Serialization

ENG-031 gobernará:

```text
encoding
serialization
deserialization
canonical representation
```

---

# 35. Content Type

Deberá declararse cuando el Transport no lo determine inequívocamente.

Ejemplos:

```text
application/json
application/protobuf
application/msgpack
```

---

# 36. Payload Size

Deberá poseer límites.

---

# 37. Large Payload

No deberá enviarse indiscriminadamente mediante Broker.

---

# 38. Claim Check Pattern

Para Payloads grandes podrá utilizarse:

```text
Message
   │
   ▼
Reference
   │
   ▼
External Blob/Object Storage
```

---

# 39. Claim Check Security

La referencia deberá respetar Authorization y Expiration.

---

# 40. Producer

Un `Producer` crea mensajes.

---

# 41. Publisher

Un `Publisher` entrega mensajes al Messaging Infrastructure.

---

# 42. Producer ≠ Publisher

Podrán coincidir físicamente, pero conceptualmente:

```text
Producer
→ creates intent/information

Publisher
→ transports it
```

---

# 43. Publisher Contract

Conceptualmente:

```text
MessagePublisher
    publish(Envelope)
        → PublishResult
```

---

# 44. Publish Result

Podrá representar:

```text
accepted
rejected
failed
```

---

# 45. Publish Accepted

No deberá interpretarse necesariamente como:

```text
consumer processed successfully
```

---

# 46. Broker

Un `Broker` almacena, enruta o distribuye mensajes según su Contract.

---

# 47. Broker Abstraction

Domain/Application no deberán depender directamente de APIs específicas del Broker salvo Adapter Boundary.

---

# 48. Destination

Representa destino lógico.

---

# 49. Destination Types

Podrán incluir:

```text
queue
topic
stream
subscription
```

---

# 50. Queue

Conceptualmente:

```text
one logical message
→ one consumer execution
```

dentro del Consumer Group correspondiente.

---

# 51. Topic

Conceptualmente:

```text
one publication
→ multiple independent subscriptions
```

---

# 52. Subscription

Representa interés durable o lógico de un Consumer en un Topic.

---

# 53. Queue ≠ Topic

No deberán intercambiarse conceptualmente aunque un Broker implemente ambos con primitives similares.

---

# 54. Stream

Podrá representar Log ordenado y retenido.

---

# 55. Stream Semantics

No deberán asumirse si el Broker no las garantiza.

---

# 56. Routing

Determina a qué Destination llega un mensaje.

---

# 57. Routing Key

Podrá derivarse de:

```text
messageType
tenant
aggregate
region
business category
```

---

# 58. Routing Stability

Una Routing Key persistida deberá tratarse como parte del Contract operativo.

---

# 59. Routing Logic

No deberá depender de detalles accidentales de Class Names.

---

# 60. Wildcard Routing

Podrá soportarse cuando el Broker lo permita.

---

# 61. Dynamic Destination

No deberá crearse indiscriminadamente a partir de Input no confiable.

---

# 62. Consumer

Un `Consumer` recibe mensajes.

---

# 63. Subscriber

Representa interés en uno o más Message Types/Destinations.

---

# 64. Message Handler

Procesa un Message Type.

---

# 65. Handler Contract

Conceptualmente:

```text
MessageHandler<TMessage>
    handle(TMessage, MessageContext)
        → MessageResult
```

---

# 66. Message Context

Podrá contener:

```text
messageId
messageType
attempt
correlationId
causationId
tenantId
receivedAt
deadline
cancellation
```

---

# 67. Consumer Scope

Cada Message Handling deberá poseer Scope independiente.

---

# 68. Context Reset

Después de cada Message deberán limpiarse:

```text
tenant
principal
transaction
trace context
temporary state
```

---

# 69. Consumer Group

Permite distribuir trabajo entre múltiples Consumers equivalentes.

---

# 70. Group Identity

Deberá ser estable.

---

# 71. Group Rename

Puede alterar Delivery semantics y deberá tratarse como cambio operativo relevante.

---

# 72. Delivery Semantics

Todo Consumer durable deberá declarar semántica.

---

# 73. At-Most-Once

```text
deliver
→ acknowledge before/without guaranteed processing
```

Puede perder mensajes.

---

# 74. At-Least-Once

```text
deliver
→ process
→ acknowledge
```

Puede producir Redelivery.

---

# 75. Exactly-Once

MEF no deberá prometer Exactly-Once Processing distribuido de forma general.

---

# 76. Preferred Semantics

Para integración durable importante deberá favorecerse:

```text
at-least-once delivery
+
idempotent consumer
```

---

# 77. Delivery ≠ Effect

Múltiples Deliveries pueden producir un único efecto lógico.

---

# 78. Acknowledgement

`ACK` confirma al Transport/Broker que la Delivery puede considerarse procesada.

---

# 79. ACK Timing

Deberá ser explícito.

---

# 80. ACK Before Processing

Reduce duplicados pero aumenta riesgo de pérdida.

---

# 81. ACK After Processing

Reduce pérdida pero permite Redelivery.

---

# 82. Preferred Durable ACK

Normalmente:

```text
process
→ durable effect
→ ACK
```

---

# 83. Negative Acknowledgement

`NACK` indica que el mensaje no pudo procesarse.

---

# 84. NACK Semantics

Podrá significar:

```text
retry
requeue
dead-letter
reject
```

según Adapter.

---

# 85. Adapter Normalization

ENG-041 deberá normalizar diferencias entre Brokers mediante Contracts MEF.

---

# 86. Redelivery

Todo Consumer At-Least-Once deberá asumir Redelivery.

---

# 87. Redelivery Causes

Podrán incluir:

```text
consumer crash
ACK loss
lease expiration
network failure
broker failover
processing timeout
```

---

# 88. Redelivery Count

Podrá registrarse cuando el Broker lo proporcione.

---

# 89. Broker Attempt ≠ Business Attempt

No deberán confundirse necesariamente.

---

# 90. Idempotency

Todo Consumer sujeto a Redelivery deberá analizar Idempotency.

---

# 91. Idempotent Consumer

Procesar dos veces el mismo Message produce el mismo efecto lógico que procesarlo una vez.

---

# 92. Idempotency Key

Normalmente:

```text
messageId
```

o una Business Key explícita.

---

# 93. Processed Message Store

Podrá conservar:

```text
consumerId
messageId
processedAt
```

---

# 94. Atomicity

Cuando sea posible:

```text
business effect
+
processed-message record
```

deberán realizarse dentro de la misma Transaction Boundary.

---

# 95. External Side Effect

Cuando no exista Transaction común deberá utilizarse:

```text
idempotency key
reconciliation
outbox
state machine
```

según caso.

---

# 96. Idempotency Retention

Deberá ser suficiente para la ventana máxima de Redelivery esperada.

---

# 97. Deduplication

Evita procesar o publicar duplicados detectables.

---

# 98. Deduplication ≠ Idempotency

```text
Deduplication
→ detect duplicate

Idempotency
→ duplicate is safe
```

---

# 99. Broker Deduplication

No deberá sustituir Idempotency de Consumer cuando existan otros caminos de duplicación.

---

# 100. Duplicate Message ID

Deberá definirse si:

```text
same ID + same payload
```

es válido y:

```text
same ID + different payload
```

es Contract Violation.

---

# 101. Message Fingerprint

Podrá utilizarse para detectar inconsistencia.

---

# 102. Ordering

No deberá asumirse Global Ordering.

---

# 103. Ordering Scope

Podrá existir:

```text
partition
aggregate
key
consumer
```

---

# 104. Partition Ordering

Un Broker podrá garantizar orden únicamente dentro de Partition.

---

# 105. Completion Ordering

Incluso Delivery ordenada no garantiza Completion ordenada con Consumer Concurrency > 1.

---

# 106. Business Ordering

Si el negocio requiere orden deberá modelarse explícitamente.

---

# 107. Sequence Number

Podrá utilizarse:

```text
aggregateVersion
sequence
```

---

# 108. Out-of-Order Message

Deberá existir Policy.

Podrá ser:

```text
reject
buffer
retry
reconcile
ignore stale
```

---

# 109. Buffer

Deberá ser acotado.

---

# 110. Missing Sequence

No deberá esperarse indefinidamente.

---

# 111. Stale Message

Podrá ignorarse cuando un Version más nuevo ya haya sido aplicado y el Contract lo permita.

---

# 112. Partitioning

Distribuye mensajes entre unidades de procesamiento.

---

# 113. Partition Key

Deberá elegirse según:

```text
ordering
parallelism
load distribution
ownership
```

---

# 114. Hot Partition

Una Key dominante puede limitar Throughput.

---

# 115. Partition Count

Puede formar parte de Capacity Planning.

---

# 116. Repartitioning

Puede alterar Ordering y Consumer Assignment.

---

# 117. Retry

ENG-039 gobernará Retry.

---

# 118. Consumer Retry

Deberá distinguirse:

```text
immediate retry
delayed retry
broker redelivery
```

---

# 119. Immediate Retry

Deberá ser limitado.

---

# 120. Delayed Retry

Para Backoff significativo deberá favorecerse:

```text
retry destination
delayed delivery
scheduled redelivery
```

sobre bloquear Consumer Thread.

---

# 121. Retry Topic/Queue

Podrá existir:

```text
orders.retry.5s
orders.retry.1m
orders.retry.10m
```

según infraestructura.

---

# 122. Retry Ordering

Mover mensajes a Retry Destination puede romper Ordering original.

---

# 123. Retry Storm

ENG-039 gobernará Backoff/Jitter/Budget.

---

# 124. Retry Classification

No deberá reintentarse automáticamente:

```text
invalid schema
unsupported version
authorization failure
permanent contract violation
```

---

# 125. Poison Message

Un `Poison Message` falla repetidamente por causa determinística o no recuperable.

---

# 126. Poison Detection

Podrá considerar:

```text
failure classification
attempt count
schema failure
handler failure
```

---

# 127. Poison Isolation

No deberá bloquear Partition/Queue indefinidamente.

---

# 128. Dead Letter

Un mensaje no procesable podrá trasladarse a Dead Letter.

---

# 129. Dead Letter Destination

Podrá ser:

```text
DLQ
dead-letter topic
quarantine store
```

---

# 130. Dead Letter Record

Deberá preservar Context suficiente para Diagnosis.

---

# 131. DLQ Metadata

Podrá incluir:

```text
messageId
messageType
schemaVersion
consumer
destination
attempts
failureCode
failedAt
```

---

# 132. Sensitive Payload

No deberá duplicarse innecesariamente.

---

# 133. DLQ Retention

Deberá configurarse.

---

# 134. DLQ Alerting

Será obligatorio para mensajes críticos.

---

# 135. DLQ Replay

Podrá permitirse.

---

# 136. Replay ≠ Retry

```text
Retry
→ automated failure handling

Replay
→ explicit reprocessing operation
```

---

# 137. Replay Audit

Deberá registrarse:

```text
who
when
why
which messages
```

cuando exista actor humano/administrativo.

---

# 138. Replay Safety

Deberá analizar Idempotency antes de Replay.

---

# 139. Bulk Replay

Deberá ser acotado y observable.

---

# 140. Message Expiration

Mensajes podrán poseer TTL.

---

# 141. TTL

Representa cuánto tiempo conserva valor el mensaje.

---

# 142. Expired Message

No deberá procesarse como si fuera vigente cuando el Contract indique Expiration.

---

# 143. Expiration Policy

Podrá:

```text
discard
dead-letter
audit
```

---

# 144. TTL ≠ Retention

```text
TTL
→ message usefulness

Retention
→ infrastructure storage policy
```

---

# 145. Correlation

`correlationId` agrupa mensajes pertenecientes a una operación lógica.

---

# 146. Correlation Propagation

Deberá propagarse cuando un Message cause otro Message.

---

# 147. Causation

`causationId` identifica el Message/Operation que causó directamente otro.

---

# 148. Example

```text
HTTP Request
    │
    ▼
CreateOrder Command
    │
    ▼
OrderCreated Event
    │
    ▼
SendConfirmation Command
```

Podrá conservar:

```text
correlationId = same logical flow
causationId = immediate predecessor
```

---

# 149. Correlation ≠ Identity

No deberá reutilizarse `correlationId` como `messageId`.

---

# 150. Trace Context

ENG-025 podrá propagar Trace Context independientemente de Business Correlation.

---

# 151. Trace Context Lifetime

No deberá asumirse que un Trace permanecerá abierto durante días.

---

# 152. Schema

Todo Message Contract durable deberá poseer Schema explícito.

---

# 153. Schema Version

Deberá identificarse.

---

# 154. Schema Evolution

ENG-016 y ENG-031 gobernarán Compatibility.

---

# 155. Compatible Evolution

Deberá favorecer:

```text
add optional field
preserve meaning
preserve existing field
```

---

# 156. Breaking Evolution

Ejemplos:

```text
remove required field
change field meaning
change incompatible type
reinterpret enum
```

---

# 157. Breaking Change

Deberá crear nueva Version cuando no pueda mantenerse Compatibility.

---

# 158. Consumer Tolerance

Consumers deberán ignorar campos desconocidos cuando el Serialization Contract lo permita.

---

# 159. Producer Discipline

Producers no deberán asumir que todos los Consumers se actualizan simultáneamente.

---

# 160. Rolling Deployment

Deberá asumirse coexistencia de Versions.

---

# 161. Schema Registry

MEF podrá proporcionar Registry conceptual.

---

# 162. Message Schema Definition

Conceptualmente:

```text
MessageSchemaDefinition
├── messageType
├── version
├── schema
├── compatibilityMode
└── metadata
```

---

# 163. Compatibility Modes

Podrán incluir:

```text
BACKWARD
FORWARD
FULL
NONE
```

---

# 164. Default Compatibility

Deberá definirse arquitectónicamente.

---

# 165. Unknown Message Type

No deberá deserializarse hacia una Class arbitraria.

---

# 166. Unknown Schema Version

Deberá producir Failure explícito.

---

# 167. Upcasting

Podrá convertir Payload antiguo a representación actual.

---

# 168. Upcaster

Conceptualmente:

```text
MessageUpcaster
    upcast(oldEnvelope)
        → newEnvelope
```

---

# 169. Upcasting Chain

Deberá ser determinística.

---

# 170. Downcasting

No deberá requerirse salvo caso explícito.

---

# 171. Message Registry

ENG-020 podrá registrar:

```text
message type
schema
serializer
handler
routing
compatibility
```

---

# 172. Duplicate Message Type

Deberá fallar durante Bootstrap.

---

# 173. Missing Handler

Para Commands dirigidos deberá detectarse cuando el Contract requiera Handler único.

---

# 174. Event Subscribers

Podrán ser cero, uno o muchos según Contract.

---

# 175. Command Handler Cardinality

Normalmente:

```text
one command
→ one logical handler
```

---

# 176. Event Handler Cardinality

Normalmente:

```text
one event
→ zero..N subscribers
```

---

# 177. Request/Reply Messaging

Podrá soportarse.

---

# 178. Request/Reply Warning

No deberá utilizarse para recrear RPC síncrono innecesariamente sobre Broker.

---

# 179. Reply Destination

Deberá estar acotado y protegido.

---

# 180. Correlation for Reply

Deberá existir:

```text
requestMessageId
```

o mecanismo equivalente.

---

# 181. Reply Timeout

Deberá existir Deadline.

---

# 182. Orphan Reply

Una Reply tardía deberá manejarse explícitamente.

---

# 183. Fan-Out

Topics pueden producir múltiples Consumer executions.

---

# 184. Fan-Out Capacity

Deberá considerarse en Capacity Planning.

---

# 185. Fan-In

Múltiples mensajes podrán contribuir a un resultado agregado.

---

# 186. Aggregation

No deberá implementarse accidentalmente mediante Memory local cuando requiera Durability.

---

# 187. Saga

Procesos distribuidos de larga duración podrán requerir Saga.

---

# 188. Saga ≠ Messaging Core

Saga no será responsabilidad primaria de ENG-041.

---

# 189. Orchestration

Podrá formalizarse en documento posterior.

---

# 190. Choreography

Podrá utilizar Events para coordinación desacoplada.

---

# 191. Choreography Risk

Dependencias implícitas entre Consumers deberán permanecer observables/documentadas.

---

# 192. Transactional Messaging

Caso crítico:

```text
Database Commit
+
Message Publish
```

---

# 193. Dual Write Problem

Ejemplo:

```text
save order succeeds
publish event fails
```

produce inconsistencia.

---

# 194. Transactional Outbox

Deberá ser Pattern preferido cuando Database y Broker no comparten Transaction.

---

# 195. Outbox Flow

```text
Application Transaction
        │
        ├── Business State
        │
        └── Outbox Record
                │
              COMMIT
                │
                ▼
            Outbox Relay
                │
                ▼
              Broker
```

---

# 196. Outbox Atomicity

Business State y Outbox Record deberán compartir Transaction cuando el Pattern se utilice.

---

# 197. Outbox Relay

Deberá tolerar publicación repetida.

---

# 198. Outbox Publication

Consumer deberá asumir duplicados incluso con Outbox.

---

# 199. Outbox State

Podrá incluir:

```text
PENDING
PUBLISHED
FAILED
```

---

# 200. Outbox Cleanup

Deberá existir Retention.

---

# 201. Inbox Pattern

Podrá registrar Messages procesados.

---

# 202. Inbox Purpose

Ayuda a implementar Idempotent Consumer.

---

# 203. Inbox Atomicity

Cuando sea posible:

```text
Inbox record
+
Business Effect
```

deberán compartir Transaction.

---

# 204. Inbox/Outbox

Podrán utilizarse conjuntamente.

---

# 205. Distributed Transaction

MEF no deberá requerir 2PC como solución Default.

---

# 206. Transaction Boundary

Deberá permanecer explícita.

---

# 207. Security

ENG-024 gobernará Message Security.

---

# 208. Authentication

El Transport deberá autenticar Producer/Consumer cuando corresponda.

---

# 209. Authorization

Deberá limitar:

```text
publish
consume
manage destination
replay
inspect DLQ
```

---

# 210. Least Privilege

Un Consumer deberá acceder únicamente a Destinations necesarias.

---

# 211. Tenant Isolation

Tenant Context deberá preservarse sin confiar ciegamente en Input.

---

# 212. Tenant Header

No deberá ser suficiente por sí solo para autorizar acceso.

---

# 213. Encryption in Transit

Deberá utilizarse cuando el Threat Model lo requiera.

---

# 214. Encryption at Rest

Dependerá del Broker y Data Classification.

---

# 215. Message Integrity

Podrá requerirse:

```text
signature
MAC
broker integrity control
```

---

# 216. Secret in Message

No deberá incluirse salvo necesidad estricta y protección explícita.

---

# 217. Credentials

No deberán viajar como Business Payload.

---

# 218. PII

Deberá minimizarse.

---

# 219. Sensitive Data Retention

Deberá considerar:

```text
broker retention
retry destinations
DLQ
logs
traces
```

---

# 220. Replay Security

Replay deberá requerir Authorization reforzada cuando pueda producir Side Effects.

---

# 221. Untrusted Message

Todo mensaje externo deberá validarse antes de alcanzar Domain/Application internals.

---

# 222. Deserialization Security

ENG-031 deberá impedir Object Instantiation arbitraria basada en Input.

---

# 223. Message Bomb

Deberán limitarse:

```text
payload size
nested depth
decompression ratio
header count
```

---

# 224. Poison Payload

No deberá derribar Consumer Process completo.

---

# 225. Observability

ENG-025 gobernará Telemetry.

---

# 226. Producer Metrics

Podrán incluir:

```text
mef.messaging.publish.total
mef.messaging.publish.failed.total
mef.messaging.publish.duration
```

---

# 227. Consumer Metrics

Podrán incluir:

```text
mef.messaging.consume.total
mef.messaging.consume.failed.total
mef.messaging.consume.duration
mef.messaging.redelivery.total
```

---

# 228. Broker Metrics

Podrán incluir:

```text
queue depth
consumer lag
oldest message age
partition lag
```

---

# 229. DLQ Metrics

Podrán incluir:

```text
mef.messaging.dlq.total
mef.messaging.dlq.depth
```

---

# 230. Retry Metrics

Podrán incluir:

```text
retry count
retry exhausted
retry delay
```

---

# 231. Message Size Metrics

Deberán evitar Cardinality no controlada.

---

# 232. Metric Labels

Podrán incluir:

```text
messageType
destination
consumer
result
```

cuando sus dominios sean acotados.

---

# 233. Message ID Metric Label

No deberá utilizarse.

---

# 234. Tracing

Publish y Consume podrán generar Spans.

---

# 235. Async Trace

Podrá utilizar:

```text
trace propagation
span links
```

según duración y Topology.

---

# 236. Correlation Logging

Logs deberán permitir búsqueda por:

```text
messageId
correlationId
causationId
```

---

# 237. Payload Logging

No deberá realizarse por Default.

---

# 238. Message Failure Logging

Deberá incluir Error Code y Metadata segura.

---

# 239. Consumer Lag

Será indicador principal de incapacidad para mantener ritmo.

---

# 240. Alerting

Podrá considerar:

```text
publish failures
consumer failures
lag
oldest message age
DLQ growth
poison messages
consumer unavailable
```

---

# 241. SLO

Integraciones críticas podrán definir:

```text
publish availability
delivery latency
processing latency
maximum lag
success rate
```

---

# 242. Performance

ENG-026 gobernará Performance.

---

# 243. Batch Publish

Podrá utilizarse para Throughput.

---

# 244. Batch Consume

También.

---

# 245. Batch Size

Deberá equilibrar:

```text
throughput
latency
memory
failure scope
```

---

# 246. Batch Failure

Deberá definir si:

```text
whole batch retries
failed items retry
```

---

# 247. Prefetch

Podrá mejorar Throughput.

---

# 248. Excessive Prefetch

Puede:

```text
increase memory
reduce fairness
increase redelivery
```

---

# 249. Consumer Concurrency

Deberá ser acotada.

---

# 250. Backpressure

ENG-039 gobernará Backpressure.

---

# 251. Flow Control

Consumers deberán evitar aceptar más mensajes de los que pueden procesar.

---

# 252. Broker Flow Control

Deberá aprovecharse cuando exista.

---

# 253. Producer Backpressure

Publishers deberán responder correctamente a Broker Saturation.

---

# 254. Infinite Buffer

No deberá utilizarse.

---

# 255. Local Buffer

Deberá ser acotado.

---

# 256. Message Retention

Deberá configurarse según Contract.

---

# 257. Retention ≠ Backup

Broker Retention no deberá tratarse automáticamente como Backup.

---

# 258. Compaction

Podrá soportarse en Streams.

---

# 259. Compaction Semantics

Deberán documentarse.

---

# 260. Tombstone

Podrá representar eliminación lógica en sistemas de Log compactado.

---

# 261. Broker Availability

ENG-039 gobernará Failure handling.

---

# 262. Broker Timeout

Publish/Consume operations deberán poseer límites apropiados.

---

# 263. Circuit Breaker

Podrá aplicarse a Publisher Connections según Adapter/Contract.

---

# 264. Consumer Circuit

No deberá abrirse globalmente por un Poison Message individual.

---

# 265. Bulkhead

Cada Integration crítica podrá poseer recursos aislados.

---

# 266. Broker Outage

Producers deberán definir:

```text
fail
buffer durably
outbox
degrade
```

---

# 267. In-Memory Broker Outage Buffer

No deberá utilizarse para mensajes críticos sin límite/Durability.

---

# 268. Consumer Shutdown

ENG-027 gobernará Graceful Shutdown.

---

# 269. Consumer Drain

Durante Shutdown:

```text
stop receiving
      │
      ▼
finish in-flight
      │
      ▼
ACK / release safely
      │
      ▼
close connection
```

---

# 270. Forced Shutdown

Mensajes no ACK deberán poder Redeliver según Contract.

---

# 271. Deployment

Consumers de distintas Versions podrán coexistir.

---

# 272. Compatibility

ENG-016 deberá garantizar coexistencia durante Rolling Deployment.

---

# 273. Consumer Removal

No deberá eliminarse un Consumer requerido sin revisar:

```text
subscriptions
retention
backlog
business dependency
```

---

# 274. Message Type Removal

Deberá considerar mensajes retenidos antiguos.

---

# 275. Destination Removal

No deberá destruir Backlog sin operación explícita.

---

# 276. Topic Rename

Puede crear una integración nueva desde perspectiva del Broker.

---

# 277. Migration

Deberá existir Strategy para cambios incompatibles.

---

# 278. Dual Publish

Podrá utilizarse temporalmente:

```text
v1
+
v2
```

---

# 279. Dual Publish Risk

Puede duplicar Side Effects si Consumers no están aislados.

---

# 280. Dual Consume

Podrá utilizarse durante Migration.

---

# 281. Cutover

Deberá ser observable y reversible cuando sea posible.

---

# 282. Registry Engineering

ENG-020 podrá mantener:

```text
MessageDefinition
ConsumerDefinition
DestinationDefinition
RoutingDefinition
```

---

# 283. Message Definition

Conceptualmente:

```text
MessageDefinition
├── type
├── version
├── category
├── schema
├── serializer
└── metadata
```

---

# 284. Consumer Definition

Conceptualmente:

```text
ConsumerDefinition
├── id
├── messageTypes
├── destination
├── handler
├── retryPolicy
└── deadLetterPolicy
```

---

# 285. Destination Definition

Conceptualmente:

```text
DestinationDefinition
├── id
├── type
├── durability
├── retention
└── metadata
```

---

# 286. Bootstrap

ENG-027 deberá construir Messaging Infrastructure.

---

# 287. Bootstrap Flow

Conceptualmente:

```text
Load Configuration
      │
      ▼
Discover Message Definitions
      │
      ▼
Discover Consumers
      │
      ▼
Validate Schemas
      │
      ▼
Validate Routing
      │
      ▼
Build Messaging Registry
      │
      ▼
Build Broker Adapters
      │
      ▼
Start Consumers
      │
      ▼
Readiness
```

---

# 288. Bootstrap Validation

Deberá detectar:

```text
duplicate message type/version
missing serializer
missing handler
unknown destination
invalid routing
incompatible schema
```

---

# 289. Module Integration

ENG-028 permitirá registrar:

```text
Messages
Consumers
Publishers
Subscriptions
Routing
```

---

# 290. Module Disable

Deberá considerar Consumers activos y Backlog.

---

# 291. Module Uninstall

No deberá dejar mensajes huérfanos sin Migration Strategy.

---

# 292. Service Container

ENG-019 resolverá Handler Dependencies por Message Scope.

---

# 293. Dependency Injection

ENG-018 deberá permitir cambiar Broker Adapter sin modificar Domain.

---

# 294. Contracts

ENG-021 gobernará:

```text
Publisher
Consumer
Serializer
Router
Schema Registry
```

---

# 295. Event Bus Integration

ENG-022 podrá adaptarse hacia Messaging externo.

---

# 296. Internal Event

No deberá publicarse externamente automáticamente.

---

# 297. Integration Event

Deberá ser Contract explícito.

---

# 298. Domain Event ≠ Integration Event

```text
Domain Event
→ internal domain fact

Integration Event
→ external communication contract
```

---

# 299. Translation

Application/Integration Layer podrá traducir:

```text
Domain Event
→ Integration Event
```

---

# 300. Why Translation

Evita exponer directamente Internal Domain Model.

---

# 301. Background Jobs Integration

ENG-040 podrá consumir mensajes y producir Jobs.

---

# 302. Message-to-Job

Ejemplo:

```text
CustomerImported
      │
      ▼
GenerateCustomerReportJob
```

---

# 303. Job-to-Message

Un Job completado podrá publicar Integration Event.

---

# 304. Message ≠ Job Persistence

Broker no deberá convertirse automáticamente en Job State Store.

---

# 305. Persistence

ENG-030 gobernará:

```text
outbox
inbox
deduplication store
consumer state
```

---

# 306. Transport

ENG-032 gobernará Protocol Adapters.

---

# 307. Application

ENG-034 gobernará cuándo publicar Commands/Integration Events.

---

# 308. Domain

ENG-035 no deberá conocer:

```text
broker
topic
queue
consumer group
ACK
NACK
```

---

# 309. Validation

ENG-036 validará:

```text
headers
payload
schema
routing
configuration
```

---

# 310. Caching

ENG-037 no deberá utilizarse como única fuente de Deduplication durable crítica.

---

# 311. Concurrency

ENG-038 gobernará:

```text
consumer concurrency
atomic inbox
partition ownership
deduplication races
```

---

# 312. Resilience

ENG-039 gobernará:

```text
timeout
retry
backoff
jitter
circuit breaker
bulkhead
load shedding
```

---

# 313. Scheduling

ENG-040 podrá proporcionar Delayed Retry cuando la infraestructura de Messaging no lo soporte nativamente.

---

# 314. Error Namespace

ENG-041 utilizará:

```text
MEF-MSG-xxx
```

---

# 315. Taxonomía ENG-041

```text
MEF-MSG-001 Unknown message type
MEF-MSG-002 Unsupported schema version
MEF-MSG-003 Invalid message envelope
MEF-MSG-004 Invalid message payload
MEF-MSG-005 Duplicate message type
MEF-MSG-006 Message serialization failed
MEF-MSG-007 Message deserialization failed
MEF-MSG-008 Publish failed
MEF-MSG-009 Publish rejected
MEF-MSG-010 Broker unavailable
MEF-MSG-011 Destination unavailable
MEF-MSG-012 Consumer unavailable
MEF-MSG-013 Consumer processing failed
MEF-MSG-014 Acknowledgement failed
MEF-MSG-015 Redelivery limit exceeded
MEF-MSG-016 Poison message detected
MEF-MSG-017 Message dead-lettered
MEF-MSG-018 Message expired
MEF-MSG-019 Duplicate message detected
MEF-MSG-020 Message ordering violation
MEF-MSG-021 Message sequence gap
MEF-MSG-022 Invalid routing
MEF-MSG-023 Unknown destination
MEF-MSG-024 Schema compatibility failure
MEF-MSG-025 Message replay rejected
MEF-MSG-026 Message security violation
MEF-MSG-027 Message too large
MEF-MSG-028 Consumer lag exceeded
MEF-MSG-029 Messaging contract violation
MEF-MSG-030 Messaging invariant violation
```

---

# 316. Unknown Message

```text
MEF-MSG-001

Unknown message type.

Message Type:
sales.order.created.v3
```

---

# 317. Unsupported Schema

```text
MEF-MSG-002

Unsupported message schema version.

Message Type:
sales.order.created

Version:
7
```

---

# 318. Publish Failure

```text
MEF-MSG-008

Message publish failed.

Destination:
orders

Message Type:
sales.order.created.v1
```

---

# 319. Poison Message

```text
MEF-MSG-016

Poison message detected.

Message:
01J...

Consumer:
billing.order-created
```

---

# 320. Dead Letter

```text
MEF-MSG-017

Message moved to dead letter.

Message:
01J...

Failure:
MEF-MSG-004
```

---

# 321. Ordering Violation

```text
MEF-MSG-020

Message ordering violation.

Aggregate:
order:123

Expected:
42

Received:
44
```

---

# 322. Testing

ENG-009 gobernará Testing.

---

# 323. Producer Contract Test

Deberá comprobar:

```text
message type
schema version
envelope
routing
```

---

# 324. Consumer Contract Test

Deberá comprobar compatibilidad con Payload real.

---

# 325. Serialization Roundtrip Test

Deberá comprobar:

```text
message
→ serialize
→ deserialize
→ equivalent contract
```

---

# 326. Old Schema Test

Deberá probar Versions aún soportadas.

---

# 327. Unknown Field Test

Deberá comprobar Compatibility Policy.

---

# 328. Unknown Version Test

Deberá fallar explícitamente.

---

# 329. Redelivery Test

Deberá procesar el mismo Message múltiples veces.

---

# 330. Idempotency Test

Deberá comprobar único efecto lógico.

---

# 331. ACK Failure Test

Deberá comprobar Redelivery segura.

---

# 332. Consumer Crash Test

Deberá comprobar recuperación.

---

# 333. Poison Message Test

Deberá comprobar aislamiento.

---

# 334. DLQ Test

Deberá comprobar:

```text
routing
metadata
retention semantics
```

---

# 335. Replay Test

Deberá comprobar Idempotency y Audit.

---

# 336. Ordering Test

Deberá comprobar Scope de garantía.

---

# 337. Out-of-Order Test

Deberá comprobar Policy.

---

# 338. Partition Test

Deberá comprobar Routing Key.

---

# 339. Transactional Outbox Test

Deberá comprobar:

```text
business commit
+
outbox record
```

atómicamente.

---

# 340. Relay Crash Test

Deberá comprobar publicación repetida segura.

---

# 341. Inbox Test

Deberá comprobar deduplicación atómica.

---

# 342. Broker Outage Test

Deberá comprobar Failure Policy.

---

# 343. Slow Consumer Test

Deberá comprobar Backpressure/Lag.

---

# 344. Consumer Restart Test

Deberá comprobar Recovery.

---

# 345. Rolling Deployment Test

Deberá comprobar coexistencia de Versions.

---

# 346. Security Test

Deberá comprobar:

```text
unauthorized publish
unauthorized consume
cross-tenant message
malformed headers
oversized payload
```

---

# 347. Performance Test

Deberá medir:

```text
publish throughput
consume throughput
end-to-end latency
consumer lag
memory
batch efficiency
```

---

# 348. Soak Test

Podrá detectar:

```text
connection leak
memory leak
lag growth
stuck consumer
unbounded retry
DLQ growth
```

---

# 349. Fault Injection

Podrá simular:

```text
broker outage
connection reset
ACK loss
consumer crash
duplicate delivery
out-of-order delivery
partition reassignment
```

---

# 350. Architecture Test

Podrá impedir:

```text
Domain
→ Kafka/RabbitMQ/SQS/etc.
```

directamente.

---

# 351. Build Integration

ENG-012 podrá validar:

```text
duplicate message types
missing schema
missing handler
unknown destination
invalid routing
unsupported compatibility
unbounded local buffer
```

---

# 352. CLI

ENG-007 podrá proporcionar:

```text
mef messaging:messages
mef messaging:consumers
mef messaging:destinations
mef messaging:routes
mef messaging:status
mef messaging:dlq
mef messaging:inspect <messageId>
mef messaging:replay <messageId>
mef messaging:schemas
```

---

# 353. CLI Replay

Deberá requerir intención explícita.

---

# 354. CLI Payload

No deberá mostrar información sensible sin Authorization.

---

# 355. Configuration

ENG-011 podrá definir:

```text
messaging:
  default-transport: primary

  transports:
    primary:
      adapter: broker

  consumers:
    concurrency: 8
    prefetch: 16

  retry:
    max-attempts: 5

  dead-letter:
    enabled: true

  schemas:
    compatibility: backward
```

---

# 356. Configuration Validation

Deberá detectar:

```text
unknown adapter
invalid destination
invalid concurrency
invalid retry
invalid schema policy
```

---

# 357. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Message
MessageId
MessageType
MessageCategory
Envelope
MessageHeaders
MessageContext

MessagePublisher
PublishResult

MessageConsumer
MessageHandler
MessageResult

MessageRouter
Destination
DestinationType

MessageDefinition
ConsumerDefinition

DeliverySemantics
Acknowledgement

MessageSchema
SchemaVersion
MessageSerializer

MessageRetryPolicy
DeadLetter
DeadLetterStore

MessageError
```

---

# 358. Optional Initial Components

Podrán incorporarse:

```text
MessageDeduplicator
Inbox
Outbox
OutboxRelay
MessageUpcaster
PartitionKey
SequenceNumber
```

---

# 359. Later Components

Solo cuando exista necesidad demostrada:

```text
Schema Registry Service
Stream Processing
Saga Runtime
Workflow Orchestration
Cross-Region Messaging
Advanced Event Streaming
```

---

# 360. Conceptual Directory Structure

```text
src/
└── Messaging/
    ├── Contract/
    │   ├── MessagePublisher
    │   ├── MessageConsumer
    │   ├── MessageHandler
    │   ├── MessageRouter
    │   └── MessageSerializer
    │
    ├── Message/
    │   ├── Message
    │   ├── MessageId
    │   ├── MessageType
    │   ├── MessageCategory
    │   ├── Envelope
    │   ├── MessageHeaders
    │   └── MessageContext
    │
    ├── Definition/
    │   ├── MessageDefinition
    │   └── ConsumerDefinition
    │
    ├── Routing/
    │   ├── Destination
    │   ├── DestinationType
    │   └── MessageRouter
    │
    ├── Delivery/
    │   ├── DeliverySemantics
    │   └── Acknowledgement
    │
    ├── Schema/
    │   ├── MessageSchema
    │   ├── SchemaVersion
    │   └── MessageUpcaster
    │
    ├── Reliability/
    │   ├── MessageRetryPolicy
    │   ├── MessageDeduplicator
    │   ├── Inbox
    │   ├── Outbox
    │   └── OutboxRelay
    │
    ├── DeadLetter/
    │   ├── DeadLetter
    │   └── DeadLetterStore
    │
    └── Error/
        └── MessageError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 361. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Message Contracts
Stable Message Types
Versioned Schemas
Envelope
Producer/Consumer Separation
Explicit Destinations
At-Least-Once Delivery
ACK After Durable Effect
Idempotent Consumers
Bounded Retry
Dead Letter
Correlation
Causation
Transactional Outbox
Inbox when required
Schema Compatibility
Bounded Consumer Concurrency
Backpressure
Observability
Security
```

---

# 362. First Version Non-Goals

No deberá requerir:

```text
Exactly-Once Distributed Processing
Custom Broker
Custom Distributed Log
Custom Consensus
Cross-Region Replication
Full Stream Processing Engine
Saga Runtime
Workflow Engine
Global Schema Registry Service
```

---

# 363. Second Phase

Podrá incorporar:

```text
Advanced Deduplication
Message Upcasting
Retry Destinations
Partition-Aware Consumers
Sequence Enforcement
Claim Check
Advanced Replay
```

---

# 364. Third Phase

Solo cuando exista necesidad demostrada:

```text
Stream Processing
Saga Runtime
Cross-Region Messaging
Advanced Schema Registry
Event Sourcing Integration
Complex Choreography Tooling
```

---

# 365. Invariantes de Ingeniería

ENG-041 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-766 | Todo mensaje durable deberá poseer Message Identity, Message Type y Schema Version explícitos. |
| EI-767 | Message Types persistidos o publicados no deberán depender exclusivamente de nombres físicos de Classes o detalles internos de implementación. |
| EI-768 | Payload y Envelope deberán permanecer conceptualmente separados, evitando contaminar Domain Contracts con Metadata del Transport. |
| EI-769 | Todo Consumer durable deberá declarar Delivery Semantics y ACK semantics explícitas. |
| EI-770 | MEF no deberá prometer Exactly-Once Processing distribuido de forma general. |
| EI-771 | Consumers sujetos a At-Least-Once Delivery deberán ser Idempotent o poseer mecanismo equivalente que preserve un único efecto lógico. |
| EI-772 | Deduplication del Broker no deberá considerarse sustituto suficiente de Consumer Idempotency. |
| EI-773 | Ordering deberá declararse por Scope y no deberá asumirse Global Ordering cuando la infraestructura no lo garantice. |
| EI-774 | Partition Keys deberán elegirse considerando simultáneamente Ordering, Parallelism y Load Distribution. |
| EI-775 | Retries y Redeliveries deberán estar acotados y no deberán bloquear Consumers durante Backoff prolongado. |
| EI-776 | Poison Messages deberán aislarse y no deberán impedir indefinidamente el procesamiento de mensajes independientes. |
| EI-777 | Dead Letters deberán poseer Retention, Observability, Diagnosis y Replay semantics explícitas. |
| EI-778 | Message Schemas deberán evolucionar bajo Compatibility explícita mientras puedan coexistir Producers, Consumers o mensajes de Versions diferentes. |
| EI-779 | Domain Events no deberán exponerse automáticamente como Integration Events sin Translation/Contract explícito. |
| EI-780 | Cuando Business State y Message Publication no compartan Transaction, deberá utilizarse un mecanismo de consistencia como Transactional Outbox cuando la pérdida del mensaje sea inaceptable. |
| EI-781 | Inbox/Idempotency State deberá actualizarse atómicamente con Business Effect cuando compartan la misma Transaction Boundary y Correctness lo requiera. |
| EI-782 | Messaging deberá preservar Security, Tenant Isolation, Data Minimization e Integrity a través de Producer, Broker, Consumer, Retry y DLQ. |
| EI-783 | Consumers y Publishers deberán utilizar Capacity acotada y Backpressure en lugar de Buffers ilimitados. |
| EI-784 | Messaging deberá ser observable mediante Publish Rate, Failure Rate, Consumer Lag, Message Age, Redelivery, Retry, DLQ y Processing Latency. |
| EI-785 | La primera implementación deberá favorecer Contracts explícitos, At-Least-Once + Idempotency, Outbox/Inbox y Schema Compatibility antes de introducir Stream Processing, Saga Runtime o coordinación distribuida avanzada. |

---

# 366. Continuidad de Invariantes

```text
ENG-037 → EI-686 a EI-705
ENG-038 → EI-706 a EI-725
ENG-039 → EI-726 a EI-745
ENG-040 → EI-746 a EI-765
ENG-041 → EI-766 a EI-785
```

---

# 367. Criterios de Conformidad

Una implementación será conforme con ENG-041 cuando:

- diferencie Message de Envelope;
- utilice Message ID;
- utilice Message Type estable;
- versione Schema;
- diferencie Command, Event y Notification cuando corresponda;
- diferencie Queue y Topic;
- modele Routing explícito;
- declare Delivery Semantics;
- declare ACK semantics;
- asuma Redelivery;
- implemente Consumer Idempotency cuando corresponda;
- diferencie Deduplication de Idempotency;
- modele Ordering por Scope;
- modele Partitioning;
- limite Retry;
- utilice Backoff apropiado;
- gestione Poison Messages;
- soporte Dead Letter;
- gestione Message Expiration;
- preserve Correlation y Causation;
- soporte Schema Evolution;
- preserve Compatibility durante Rolling Deployment;
- utilice Outbox cuando sea necesario;
- permita Inbox cuando sea necesario;
- preserve Security y Tenant Isolation;
- limite Payload;
- limite Consumer Concurrency;
- implemente Backpressure;
- integre Observability;
- no acople Domain al Broker.

---

# 368. Riesgos

Deberán evitarse especialmente:

## Broker Coupling

Domain depende directamente del SDK del Broker.

## Class Name Contract

Message Type depende del Namespace/Class Name interno.

## Unversioned Messages

No existe estrategia para Consumers antiguos/nuevos.

## Exactly-Once Myth

Se promete una garantía distribuida no sostenible.

## ACK Before Durable Effect

Puede perderse el mensaje.

## ACK After Effect Without Idempotency

Puede duplicarse el efecto.

## Infinite Redelivery

Poison Message consume recursos indefinidamente.

## Blocking Retry

Consumer queda ocupado durante Backoff largo.

## Global Ordering Assumption

Se diseña lógica sobre garantía inexistente.

## Hot Partition

Una sola Key limita el sistema completo.

## Silent DLQ

Los mensajes fallidos desaparecen operacionalmente.

## Blind Replay

Se duplican Side Effects.

## Domain Event Leakage

Modelo interno se convierte accidentalmente en API pública.

## Dual Write

Database y Broker divergen.

## Infinite Local Buffer

Broker lento provoca Memory Exhaustion.

## Payload Dump

Se envían Object Graphs completos.

## Sensitive DLQ

Datos sensibles permanecen indefinidamente en Dead Letter.

## Tenant Header Trust

Se utiliza un Header recibido como única fuente de Authorization.

## Messaging as RPC Everywhere

Se introduce complejidad asíncrona donde no aporta valor.

## Broker as Database

Business State termina almacenado únicamente en infraestructura de Messaging.

---

# 369. Relación con ENG-022

La separación será:

```text
ENG-022
Event Bus Engineering
        │
        ▼
In-Process / Runtime Events
        │
        ▼
Internal Decoupling


ENG-041
Messaging Engineering
        │
        ▼
Cross-Process Messages
        │
        ▼
Distributed Integration
```

Un Event interno podrá convertirse explícitamente en Integration Event.

Nunca automáticamente.

---

# 370. Relación con ENG-040

La separación será:

```text
ENG-040
Job
→ work to execute


ENG-041
Message
→ information to communicate
```

Un Consumer podrá crear un Job.

Un Job podrá publicar un Message.

Pero:

```text
Message != Job
```

---

# 371. Relación con ENG-030

Persistence proporcionará las primitivas necesarias para:

```text
Outbox
Inbox
Deduplication
Consumer State
```

---

# 372. Relación con ENG-031

Serialization definirá representación estable del Envelope/Payload.

---

# 373. Relación con ENG-032

Transport implementará Protocol/Broker Adapters.

---

# 374. Relación con ENG-034

Application decidirá:

```text
when to publish
what to publish
which integration contract
```

---

# 375. Relación con ENG-035

Domain permanecerá independiente de:

```text
Broker
Queue
Topic
ACK
NACK
Partition
Consumer Group
```

---

# 376. Relación con ENG-038

Concurrency gobernará Consumer Concurrency, Partition Ownership y Atomic Inbox.

---

# 377. Relación con ENG-039

Resilience gobernará:

```text
Timeout
Retry
Backoff
Jitter
Circuit Breaker
Bulkhead
Backpressure
Load Shedding
```

---

# 378. Relación con ENG-042

ENG-042 deberá formalizar **Transaction Engineering**.

La separación será:

```text
Messaging
→ communication across boundaries

Transactions
→ atomic consistency inside explicit boundaries
```

ENG-042 deberá cubrir:

```text
Transaction
Transaction Boundary
Unit of Work
Commit
Rollback
Isolation
Consistency
Savepoint
Nested Transaction
Transaction Context
Transaction Propagation
Optimistic Concurrency
Pessimistic Concurrency
Deadlock
Retry
After Commit
Transactional Event
Outbox Integration
Cross-Resource Consistency
Distributed Transaction
Compensation
Transaction Observability
Transaction Testing
```

---

# 379. Principio Rector

> **MEF deberá tratar todo Message como un Contract versionado y potencialmente duplicado, retrasado, reordenado o redelivered, preservando Correctness mediante Idempotency, Compatibility, explicit Delivery semantics y Transactional Boundaries.**

---

# 380. Conclusión

**ENG-041 — Messaging Engineering** formaliza la infraestructura de comunicación distribuida de MEF.

La arquitectura principal queda:

```text
                    PRODUCER
                       │
                       ▼
                    MESSAGE
                       │
                       ▼
                    ENVELOPE
                       │
                       ▼
                   PUBLISHER
                       │
                       ▼
                     BROKER
                       │
              ┌────────┴────────┐
              │                 │
            QUEUE              TOPIC
              │                 │
              ▼                 ▼
          CONSUMER         SUBSCRIPTIONS
              │                 │
              └────────┬────────┘
                       ▼
                    HANDLER
                       │
            ┌──────────┼──────────┐
            │          │          │
            ▼          ▼          ▼
           ACK       RETRY       DLQ
```

La arquitectura de consistencia queda:

```text
BUSINESS TRANSACTION
        │
        ├── Business State
        │
        └── Outbox
              │
            COMMIT
              │
              ▼
         OUTBOX RELAY
              │
              ▼
            BROKER
              │
              ▼
           CONSUMER
              │
              ▼
        ┌──────────────┐
        │    INBOX     │
        │      +       │
        │Business State│
        └──────┬───────┘
               │
             COMMIT
               │
               ▼
              ACK
```

La separación conceptual queda:

```text
Domain Event
→ internal fact

Integration Event
→ external versioned contract

Command
→ request to perform work

Notification
→ informational message

Envelope
→ transport metadata

Payload
→ contract data

Queue
→ competing consumption

Topic
→ independent subscriptions

ACK
→ delivery successfully handled

Redelivery
→ same message delivered again

Idempotency
→ duplicate delivery remains safe

Deduplication
→ duplicate detection

Outbox
→ atomic business change + publication intent

Inbox
→ atomic consumer deduplication + effect

Dead Letter
→ isolated failed message

Replay
→ intentional reprocessing
```

La primera implementación deberá concentrarse en:

```text
Message
MessageId
MessageType
MessageCategory

Envelope
MessageHeaders
MessageContext

MessagePublisher
MessageConsumer
MessageHandler

MessageRouter
Destination

DeliverySemantics
Acknowledgement

MessageSchema
SchemaVersion
MessageSerializer

MessageRetryPolicy

DeadLetter
DeadLetterStore

Outbox
Inbox

MessageError
```

con:

```text
Explicit Contracts
Stable Message Types
Versioned Schemas
At-Least-Once Delivery
ACK After Durable Effect
Idempotent Consumers
Transactional Outbox
Atomic Inbox
Bounded Retry
Dead Letter
Correlation
Causation
Schema Compatibility
Backpressure
Security
Observability
```

antes de introducir:

```text
Exactly-Once Distributed Processing
Custom Broker
Custom Distributed Log
Saga Runtime
Workflow Engine
Stream Processing Engine
Cross-Region Messaging
Advanced Event Streaming
```

Con **ENG-041** la serie global alcanza:

```text
EI-785
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
- ENG-007 — CLI
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
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-042 — Transaction Engineering