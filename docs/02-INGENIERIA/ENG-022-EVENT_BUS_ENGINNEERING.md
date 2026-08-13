---
id: ENG-022
titulo: Event Bus Engineering
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
  - ENG-002
  - ENG-003
  - ENG-004
  - ENG-005
  - ENG-009
  - ENG-010
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ARQ-004
  - ARQ-006
  - ARQ-007
  - ARQ-008
  - ARQ-011
  - ARQ-012
  - ARQ-014
relacionados:
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
keywords:
  - event bus
  - events
  - publisher
  - subscriber
  - handler
  - dispatch
  - messaging
  - asynchronous
  - synchronous
  - idempotency
  - retries
  - dead letter
  - correlation
  - contracts
  - runtime
  - mef
---

# ENG-022

# Event Bus Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería del **Event Bus** de **MEF (Modular Enterprise Framework)**.

El Event Bus proporciona un mecanismo gobernado para comunicar hechos entre componentes sin requerir acoplamiento directo entre el emisor y los consumidores.

La relación fundamental será:

```text
Publisher
    │
    ▼
  Event
    │
    ▼
Event Bus
    │
    ├──────────┬──────────┐
    ▼          ▼          ▼
Handler A   Handler B   Handler C
```

El Publisher deberá conocer el Event que publica.

No deberá necesitar conocer qué Handlers reaccionarán al Event.

---

# 2. Declaración

La regla fundamental será:

> **El Event Bus deberá transportar y distribuir Events sin convertir al Publisher en conocedor de sus Subscribers ni convertir al Event Bus en propietario de la lógica de negocio ejecutada por éstos.**

Por tanto:

```text
Publisher
    ↓
Event
    ↓
Event Bus
    ↓
Subscribers
```

y no:

```text
Publisher
    ↓
Subscriber A
    ↓
Subscriber B
    ↓
Subscriber C
```

---

# 3. Posición Arquitectónica

```text
                     MODULE A
                        │
                        ▼
                    Publisher
                        │
                        ▼
                       Event
                        │
                        ▼
                    EVENT BUS
                        │
            ┌───────────┼───────────┐
            ▼           ▼           ▼
        Handler A   Handler B   Handler C
            │           │           │
            ▼           ▼           ▼
        MODULE B    MODULE C    MODULE D
```

---

# 4. Objetivos

El Event Bus deberá:

- desacoplar Publishers y Subscribers;
- distribuir Events;
- permitir múltiples Handlers;
- integrar Contracts;
- integrar Registry;
- integrar Service Container;
- soportar dispatch gobernado;
- permitir sincronía y asincronía cuando corresponda;
- definir ordering;
- definir failure semantics;
- soportar retries;
- soportar idempotency;
- soportar correlation;
- permitir observability;
- preservar Security;
- permitir Testing;
- mantener independencia tecnológica.

---

# 5. Event

Un Event representa un hecho que ya ocurrió.

Ejemplos:

```text
CustomerCreated
OrderPaid
UserAuthenticated
PackageInstalled
ModuleActivated
```

---

# 6. Event Semantics

Un Event deberá describir:

```text
something happened
```

y no ordinariamente:

```text
please do something
```

---

# 7. Event vs Command

La diferencia conceptual será:

```text
Command
→ intención de producir una acción

Event
→ notificación de un hecho ocurrido
```

Ejemplo:

```text
CreateCustomer
→ Command

CustomerCreated
→ Event
```

---

# 8. Event Naming

Los Events deberán nombrarse preferentemente en pasado cuando representen hechos.

Ejemplos:

```text
CustomerCreated
PaymentCompleted
ModuleActivated
```

---

# 9. Event Identity

Todo Event arquitectónicamente público deberá poseer identidad estable.

La nomenclatura exacta deberá seguir ENG-005.

Ejemplo conceptual:

```text
EV-CUSTOMER-CREATED-001
EV-MODULE-ACTIVATED-001
```

---

# 10. Event ID vs Event Instance ID

No deberán confundirse:

```text
Event Type ID
```

con:

```text
Event Instance ID
```

Ejemplo:

```text
type:
EV-CUSTOMER-CREATED-001

eventId:
01J...
```

---

# 11. Event Type

Representa la clase contractual del Event.

---

# 12. Event Instance

Representa una ocurrencia concreta del Event.

---

# 13. Event Contract

Todo Event que cruce una frontera arquitectónica deberá considerarse Contract conforme ENG-021.

---

# 14. Event Contract Definition

Podrá contener:

```text
id
version
owner
name
payload schema
metadata schema
semantics
visibility
compatibility
```

---

# 15. Event Owner

Todo Event público deberá tener Owner.

---

# 16. Event Ownership

El Owner será responsable de:

- definición;
- schema;
- semántica;
- versionado;
- compatibilidad;
- deprecation;
- documentación.

---

# 17. Event Publisher

Un Publisher es un componente autorizado para emitir un Event.

---

# 18. Publisher Independence

El Publisher no deberá conocer normalmente:

```text
subscriber classes
handler count
handler order
subscriber package
subscriber implementation
```

---

# 19. Subscriber

Un Subscriber declara interés en uno o más Events.

---

# 20. Handler

Un Handler ejecuta la reacción asociada a un Event.

Conceptualmente:

```text
Subscriber Registration
        ↓
      Handler
        ↓
Business / Application Action
```

---

# 21. Subscriber vs Handler

Los términos podrán coincidir físicamente en algunos Implementation Profiles.

Conceptualmente deberán distinguirse:

```text
Subscription
→ relación Event → Consumer

Handler
→ código que procesa Event
```

---

# 22. Event Bus

El Event Bus coordina:

```text
publication
routing
dispatch
delivery
failure handling
```

No deberá poseer la lógica de negocio específica del Handler.

---

# 23. Event Bus Contract

El Runtime debería exponer una abstracción estable para publicación.

Ejemplo conceptual:

```text
EventPublisher
```

---

# 24. Narrow Publisher Contract

Un componente que únicamente necesita publicar no debería recibir acceso administrativo completo al Event Bus.

Preferido:

```text
EventPublisher
```

frente a:

```text
CompleteEventBus
```

---

# 25. Event Envelope

Todo Event transportado podrá envolverse en un `EventEnvelope`.

Conceptualmente:

```text
EventEnvelope
├── eventId
├── eventType
├── eventVersion
├── occurredAt
├── correlationId
├── causationId
├── producer
├── payload
└── metadata
```

---

# 26. `eventId`

Identifica una ocurrencia única.

---

# 27. `eventType`

Identifica el Contract del Event.

---

# 28. `eventVersion`

Identifica la versión contractual.

---

# 29. `occurredAt`

Representa cuándo ocurrió el hecho.

No necesariamente cuándo fue procesado.

---

# 30. `correlationId`

Permite relacionar múltiples operaciones pertenecientes al mismo flujo lógico.

---

# 31. `causationId`

Permite identificar qué operación/Event causó otro Event.

---

# 32. `producer`

Identifica el componente productor cuando sea necesario.

---

# 33. `payload`

Contiene los datos contractuales del hecho.

---

# 34. `metadata`

Contiene información técnica gobernada.

---

# 35. Payload vs Metadata

Deberá distinguirse:

```text
payload
→ business/event information

metadata
→ transport/runtime context
```

---

# 36. No Secret Metadata

El Envelope no deberá utilizarse como almacenamiento indiscriminado de Secrets.

---

# 37. Event Immutability

Una vez publicado, un Event deberá considerarse inmutable.

---

# 38. Handler Mutation

Un Handler no deberá modificar el Event para alterar lo que reciban otros Handlers.

---

# 39. Event Serialization

Cuando el Event cruce procesos deberá existir representación serializable gobernada.

---

# 40. In-Process Event

Podrá utilizar representación nativa del Implementation Profile.

---

# 41. Inter-Process Event

Deberá definir:

```text
serialization
schema
version
compatibility
```

---

# 42. Event Schema

El Payload de un Event público deberá poseer Schema suficientemente definido.

---

# 43. Schema Evolution

Se regirá por ENG-021 y ENG-016.

---

# 44. Required Field

Agregar un campo obligatorio podrá constituir Breaking Change.

---

# 45. Optional Field

Agregar un campo opcional puede ser compatible si los Consumers toleran campos desconocidos.

---

# 46. Event Versioning

La versión deberá permanecer separada de la identidad del Event.

```text
eventType:
EV-CUSTOMER-CREATED-001

version:
2.0.0
```

---

# 47. Event Type Stability

No deberá crearse automáticamente un nuevo Event ID por cada Minor/Patch.

---

# 48. Breaking Event Change

Deberá aplicar la política de ENG-021.

---

# 49. Publisher API

La API conceptual mínima podrá ser:

```text
publish(event)
```

---

# 50. Dispatch

Dispatch es el proceso de entregar un Event a los Handlers aplicables.

---

# 51. Publication vs Dispatch

Deberán distinguirse:

```text
Publication
→ Publisher entrega Event al Bus

Dispatch
→ Bus entrega Event a Handler(s)
```

---

# 52. Delivery

Delivery representa el intento de procesamiento por un Handler específico.

---

# 53. Delivery Identity

En sistemas avanzados cada Delivery podrá poseer identidad propia.

---

# 54. Dispatch Modes

MEF podrá soportar:

```text
synchronous
asynchronous
```

---

# 55. Synchronous Dispatch

El Publisher y los Handlers se ejecutan dentro del flujo temporal de la publicación.

Conceptualmente:

```text
publish()
   ↓
Handler A
   ↓
Handler B
   ↓
return
```

---

# 56. Asynchronous Dispatch

La publicación y procesamiento podrán desacoplarse temporalmente.

```text
publish()
   ↓
Queue/Broker
   ↓
return

later:

Queue
  ↓
Handler
```

---

# 57. Default Initial Implementation

La primera implementación de MEF podrá comenzar con:

```text
in-process
synchronous
```

manteniendo Contracts que permitan evolución futura.

---

# 58. Sync Does Not Mean Direct Call

Aunque sea síncrono:

```text
Publisher
```

no deberá invocar directamente al Handler.

---

# 59. Async Does Not Mean Distributed

Un Event Bus asíncrono puede existir dentro del mismo proceso.

---

# 60. Distributed Does Not Mean Event

No todo mensaje distribuido es un Event.

---

# 61. Subscription Registration

Los Handlers deberán registrarse de forma gobernada.

---

# 62. Subscription Entry

Conceptualmente:

```text
Subscription
├── eventType
├── handler
├── owner
├── priority
├── mode
└── metadata
```

---

# 63. Registry Integration

ENG-020 podrá registrar:

```text
Event Types
Publishers
Subscriptions
Handlers
```

cuando formen parte de la arquitectura descubrible.

---

# 64. Registry Does Not Dispatch

El Registry conoce las relaciones.

El Event Bus ejecuta Dispatch.

---

# 65. Container Integration

ENG-019 deberá construir Handler Instances cuando corresponda.

---

# 66. Event Bus Does Not Construct Arbitrarily

El Bus deberá delegar construcción al Service Container.

---

# 67. Handler Resolution

La cadena recomendada será:

```text
Event
  ↓
Registry
  ↓
Subscription Metadata
  ↓
Container
  ↓
Handler Instance
  ↓
Dispatch
```

---

# 68. Handler Dependency Injection

Los Handlers podrán utilizar ENG-018.

Ejemplo:

```text
CustomerCreatedHandler(
    Mailer mailer,
    AuditWriter audit
)
```

---

# 69. Handler Scope

El Scope deberá definirse conforme ENG-019.

---

# 70. Event Bus Scope

El Event Bus suele ser infraestructura de Application Scope.

No deberá imponerse universalmente.

---

# 71. Subscription Discovery

Podrá originarse desde:

```text
Manifest
Provider
Generated Metadata
Explicit Registration
```

---

# 72. No Arbitrary Reflection

MEF no deberá depender universalmente de escanear todas las clases buscando métodos llamados:

```text
handle()
```

---

# 73. Explicit Registration

La primera versión debería favorecer Registration explícita.

---

# 74. Manifest Subscription

Ejemplo conceptual:

```yaml
events:
  subscriptions:
    - event: EV-CUSTOMER-CREATED-001
      handler: SendWelcomeEmail
```

---

# 75. Provider Registration

También podrá realizarse mediante Provider gobernado.

---

# 76. Duplicate Subscription

Registrar accidentalmente la misma Subscription dos veces no deberá producir procesamiento duplicado silencioso.

---

# 77. Multiple Handlers

Un Event podrá tener:

```text
0..N
```

Handlers.

---

# 78. Zero Handlers

Publicar un Event sin Subscribers puede ser válido.

---

# 79. Required Subscriber

Si un flujo exige que exista Consumer específico, esa relación probablemente no debería depender únicamente de Event semantics.

---

# 80. Event as Notification

Los Publishers no deberán asumir ordinariamente que un Handler específico procesará el Event.

---

# 81. Event Result

Un Event no debería utilizarse como mecanismo request-response ordinario.

---

# 82. Handler Return Value

Los valores retornados por Handlers normalmente no deberán agregarse como resultado del Event.

---

# 83. Query Through Event Bus

No deberá utilizarse el Event Bus para implementar Queries síncronas arbitrarias.

---

# 84. Command Bus Separation

Si MEF introduce Command Bus, deberá ser especificación separada.

---

# 85. Ordering

El Event Bus deberá definir explícitamente qué ordering garantiza.

---

# 86. No Implicit Ordering

Los Handlers no deberán depender del orden de Registration salvo que el Contract lo garantice.

---

# 87. Handler Ordering

Podrá existir prioridad explícita:

```text
priority
```

cuando sea necesario.

---

# 88. Priority

La prioridad deberá tener semántica estable.

Ejemplo:

```text
lower number → earlier
```

o equivalente.

La regla exacta deberá documentarse.

---

# 89. Equal Priority

El comportamiento deberá ser determinista o declararse unordered.

---

# 90. Event Ordering

En sistemas asíncronos podrán distinguirse:

```text
global ordering
stream ordering
partition ordering
no ordering
```

---

# 91. Default Ordering

La primera implementación no deberá prometer ordering global más allá de lo explícitamente definido.

---

# 92. Handler Dependency Ordering

Si Handler B necesita que Handler A termine primero, probablemente existe una dependencia de workflow que deberá modelarse explícitamente.

---

# 93. Chained Event

Una alternativa puede ser:

```text
Event A
   ↓
Handler A
   ↓
Event B
   ↓
Handler B
```

si representa hechos reales.

---

# 94. Failure Semantics

El Event Bus deberá definir qué ocurre cuando un Handler falla.

---

# 95. Handler Failure

Un fallo deberá identificarse respecto a:

```text
Event
Handler
Attempt
Error
```

---

# 96. Sync Failure Policy

Para dispatch síncrono podrán existir políticas como:

```text
fail-fast
continue
aggregate
```

---

# 97. Fail-Fast

El primer fallo detiene Dispatch.

---

# 98. Continue

Los Handlers restantes continúan.

---

# 99. Aggregate

Se procesan los Handlers aplicables y posteriormente se reportan múltiples fallos.

---

# 100. Policy Must Be Explicit

No deberá depender accidentalmente del Adapter de Event Bus utilizado.

---

# 101. Async Failure

En asincronía el fallo deberá poder activar:

```text
retry
dead-letter
discard
manual intervention
```

según Policy.

---

# 102. Retry

Un Delivery fallido podrá reintentarse.

---

# 103. Retry Policy

Podrá definir:

```text
maxAttempts
delay
backoff
jitter
retryable errors
```

---

# 104. Retry Safety

Un Retry puede ejecutar nuevamente efectos laterales.

Por ello deberá considerarse Idempotency.

---

# 105. Idempotency

Un Handler idempotente podrá procesar el mismo Event más de una vez sin producir efectos incorrectos adicionales.

---

# 106. Delivery Guarantees

Un Event Bus podrá ofrecer:

```text
at-most-once
at-least-once
effectively-once
```

según implementación.

---

# 107. Exactly Once

MEF no deberá prometer universalmente:

```text
exactly-once
```

sin definir con precisión la frontera y mecanismo que lo garantizan.

---

# 108. At-Most-Once

Puede perder Events pero evita redelivery intencional.

---

# 109. At-Least-Once

Puede producir duplicados.

Los Consumers deberán estar preparados cuando esta garantía aplique.

---

# 110. Effectively-Once

Puede lograrse mediante:

```text
idempotency
deduplication
transactional coordination
```

sin afirmar entrega física exactamente una vez.

---

# 111. Idempotency Key

Podrá utilizarse:

```text
eventId
```

o clave específica.

---

# 112. Deduplication

Un Handler podrá registrar Events procesados cuando sea necesario.

---

# 113. Deduplication Scope

Deberá definirse:

```text
per handler
per subscriber
per operation
```

---

# 114. Deduplication Retention

En sistemas persistentes deberá definirse cuánto tiempo se conserva evidencia.

---

# 115. Dead Letter

Un Event/Delivery que no puede procesarse después de la política de Retry podrá enviarse a:

```text
Dead Letter Queue
```

o mecanismo equivalente.

---

# 116. DLQ Entry

Debería conservar:

```text
event
handler/subscription
attempts
last error
timestamps
correlation
```

sin exponer Secrets innecesariamente.

---

# 117. Dead Letter Is Not Deletion

Enviar a DLQ significa conservar evidencia para análisis/reproceso.

---

# 118. Reprocessing

Tooling podrá permitir reprocesar Dead Letters.

---

# 119. Reprocessing Safety

Deberá aplicar nuevamente Idempotency y Security.

---

# 120. Poison Event

Un Event que falla sistemáticamente deberá detectarse para evitar Retry infinito.

---

# 121. Retry Limit

Los Retries deberán estar acotados por Policy.

---

# 122. Backoff

Sistemas distribuidos deberían soportar Backoff.

---

# 123. Jitter

Podrá utilizarse para reducir retry storms.

---

# 124. Transaction Boundary

Events y transacciones requieren tratamiento explícito.

---

# 125. Publish Before Commit Risk

Ejemplo peligroso:

```text
DB update
   ↓
publish Event
   ↓
DB rollback
```

El Event podría describir un hecho que finalmente no ocurrió.

---

# 126. Publish After Commit Risk

Ejemplo:

```text
DB commit
   ↓
process crashes
   ↓
Event never published
```

---

# 127. Transactional Outbox

Para sistemas que requieran consistencia podrá utilizarse:

```text
Transactional Outbox
```

---

# 128. Outbox Pattern

```text
Business Transaction
       │
       ├── Data Change
       └── Outbox Event
              │
            COMMIT
              │
              ▼
        Outbox Dispatcher
              │
              ▼
          Event Bus
```

---

# 129. Outbox Is Optional Infrastructure

No será obligatorio para un Event Bus in-process simple.

---

# 130. Inbox Pattern

Consumers asíncronos podrán utilizar Inbox/Deduplication.

---

# 131. Transaction Scope

El Event Bus no deberá asumir automáticamente que todos los Handlers participan en la misma transacción.

---

# 132. Distributed Transaction

MEF no deberá requerir Distributed Transactions como mecanismo predeterminado.

---

# 133. Eventual Consistency

Los flujos asíncronos podrán producir consistencia eventual.

Deberá reconocerse explícitamente.

---

# 134. Event Publication Timing

El Contract deberá indicar cuando sea importante si el Event se publica:

```text
before commit
after commit
after durable persistence
```

---

# 135. Domain Event

Un Domain Event representa un hecho significativo dentro del Domain.

---

# 136. Integration Event

Un Integration Event está diseñado para atravesar fronteras entre Modules/Processes.

---

# 137. Domain vs Integration Event

No deberán asumirse idénticos.

```text
Domain Event
      ↓
Mapping
      ↓
Integration Event
```

puede ser una estrategia válida.

---

# 138. Internal Event

Puede permanecer dentro de un Module.

---

# 139. Public Event

Cruza una frontera publicada y deberá recibir garantías contractuales.

---

# 140. Event Visibility

Deberá alinearse con ENG-020:

```text
private
module
public
framework
```

---

# 141. Framework Events

MEF podrá publicar Events como:

```text
ModuleRegistered
ModuleInitialized
ModuleActivated
ModuleStopped
```

si son formalizados.

---

# 142. Lifecycle Event

Un Lifecycle Event deberá alinearse con ENG-015.

---

# 143. Event Does Not Control State Machine

El Event puede anunciar:

```text
ModuleActivated
```

pero ENG-015 continúa siendo autoridad sobre la transición.

---

# 144. Event Publication After Transition

Un Event que afirma:

```text
ModuleActivated
```

deberá publicarse únicamente después de que la transición correspondiente haya ocurrido exitosamente.

---

# 145. Event Naming Truthfulness

No deberá publicarse:

```text
PaymentCompleted
```

si el pago todavía no está completado.

---

# 146. Intent Events

Si algo representa intención deberá modelarse como Command/Request u otra abstracción adecuada.

---

# 147. Event Causality

Los Events podrán formar cadenas causales.

---

# 148. Causation Example

```text
Command:
CreateOrder
    │
    ▼
EV-ORDER-CREATED
    │
    ▼
Handler
    │
    ▼
EV-INVENTORY-RESERVED
```

---

# 149. Correlation Example

Todos podrán compartir:

```text
correlationId
```

---

# 150. Causation Chain

Cada Event podrá apuntar al elemento que lo causó mediante:

```text
causationId
```

---

# 151. Correlation Propagation

Los Handlers deberían propagar Correlation Context cuando generen nuevos Events dentro del mismo flujo.

---

# 152. New Business Flow

No toda publicación deberá heredar indefinidamente el mismo Correlation ID.

La semántica deberá estar definida.

---

# 153. Trace Context

Podrá integrarse con Distributed Tracing.

---

# 154. Correlation vs Trace

No deberán asumirse idénticos:

```text
correlationId
→ business/logical flow

traceId
→ observability trace
```

aunque puedan relacionarse.

---

# 155. Observability

El Event Bus deberá integrarse con ENG-010 y futuras capacidades de Observability.

---

# 156. Logging

Podrá registrar:

```text
event.published
event.dispatched
event.handler.started
event.handler.completed
event.handler.failed
event.retry.scheduled
event.dead_lettered
```

---

# 157. Logging Level

No todos los Events deberán registrarse a INFO.

La política deberá considerar volumen.

---

# 158. Sensitive Payload Logging

Los Payloads no deberán loguearse indiscriminadamente.

---

# 159. Metrics

Podrán medirse:

```text
events_published_total
events_processed_total
event_failures_total
event_retries_total
event_dead_letters_total
event_processing_duration
event_queue_depth
```

---

# 160. Tracing

Un Dispatch podrá crear Span por:

```text
publish
delivery
handler
```

cuando aplique.

---

# 161. Event Context

El Handler podrá recibir Context técnico separado del Payload.

---

# 162. Context Contents

Podrá contener:

```text
eventId
correlationId
causationId
attempt
timestamp
security context
trace context
```

---

# 163. Business Payload Isolation

El Domain Payload no debería contaminarse con detalles de infraestructura si no son parte del Contract.

---

# 164. Security

El Event Bus constituye una frontera de Security.

---

# 165. Publish Authorization

No todo componente deberá poder publicar cualquier Event.

---

# 166. Subscribe Authorization

No todo componente deberá poder consumir cualquier Event.

---

# 167. Event Visibility Enforcement

Registry y Event Bus deberán respetar Visibility.

---

# 168. Publisher Identity

El Bus podrá conocer qué Module/Provider originó el Event.

---

# 169. Spoofing Prevention

Un Module no deberá poder declarar arbitrariamente que otro Module publicó el Event.

---

# 170. Trust Metadata

La identidad confiable del Publisher deberá derivarse del Runtime/Security Context, no únicamente del Payload.

---

# 171. Sensitive Event

Events sensibles podrán requerir:

```text
authorization
encryption
redaction
restricted subscribers
audit
```

---

# 172. Payload Validation

Los Events que atraviesen Trust Boundaries deberán validarse.

---

# 173. Schema Validation

La representación deberá comprobarse contra Schema cuando aplique.

---

# 174. Untrusted Metadata

Metadata proveniente de transporte externo no deberá tratarse automáticamente como confiable.

---

# 175. Event Injection

El Bus deberá prevenir publicación/consumo no autorizado.

---

# 176. Replay Attack

En determinados contextos deberá considerarse protección contra replay malicioso.

---

# 177. Legitimate Replay

No deberá confundirse un ataque Replay con reprocesamiento autorizado.

---

# 178. Security Context Propagation

La propagación de identidad/permisos deberá ser explícita.

---

# 179. No Implicit User Context

Un Handler asíncrono no deberá asumir que existe la sesión HTTP original.

---

# 180. Authorization Re-Evaluation

En procesamiento diferido podrá ser necesario reevaluar permisos.

---

# 181. Data Minimization

Un Event deberá contener únicamente la información necesaria para su propósito contractual.

---

# 182. Event as Database Dump

Deberá evitarse publicar Entities completas o registros arbitrarios sin necesidad.

---

# 183. Event Payload Stability

Payloads pequeños y explícitos reducen acoplamiento.

---

# 184. Identifier References

En muchos casos podrá publicarse:

```text
customerId
```

en lugar de una representación completa del Customer.

La decisión depende del Contract.

---

# 185. Temporal Coupling

Publicar solo IDs puede obligar al Consumer a consultar estado que ya cambió.

Por ello deberá decidirse conscientemente entre:

```text
notification
state transfer
```

---

# 186. Notification Event

Indica que algo ocurrió y contiene información mínima.

---

# 187. Event-Carried State Transfer

Transporta suficiente estado para que Consumers no necesiten consultar al Producer.

---

# 188. Trade-Off

La elección afecta:

```text
coupling
payload size
consistency
consumer independence
privacy
```

---

# 189. Event Evolution

Los Events públicos deberán evolucionar como Contracts.

---

# 190. Consumer Tolerance

Los Consumers deberían tolerar cambios compatibles.

---

# 191. Unknown Fields

En formatos extensibles los Consumers deberían ignorar campos desconocidos cuando el Contract así lo permita.

---

# 192. Unknown Event Type

El comportamiento deberá definirse.

Podrá ser:

```text
ignore
dead-letter
reject
```

según contexto.

---

# 193. Unsupported Event Version

No deberá procesarse silenciosamente como versión conocida.

---

# 194. Version Adapter

Podrán existir Upcasters/Adapters.

---

# 195. Event Upcaster

Transforma representación antigua hacia una versión entendida.

```text
Event v1
   ↓
Upcaster
   ↓
Event v2
```

---

# 196. Upcaster Safety

No deberá inventar semántica imposible de derivar.

---

# 197. Downcasting

Normalmente será más riesgoso y deberá evitarse salvo soporte explícito.

---

# 198. Event Deprecation

Un Event podrá marcarse Deprecated conforme ENG-021.

---

# 199. Event Retirement

No deberá retirarse mientras existan Consumers soportados sin ruta de migración conforme a Release Policy.

---

# 200. Subscription Lifecycle

Las Subscriptions también poseen Lifecycle.

---

# 201. Registration

Durante Bootstrap:

```text
Discover
  ↓
Validate
  ↓
Register
  ↓
Freeze
```

---

# 202. Runtime Subscription Mutation

No será requisito inicial.

---

# 203. Dynamic Subscription

Podrá incorporarse en versiones futuras.

---

# 204. Frozen Subscription Graph

La primera versión debería favorecer un conjunto estable después de Bootstrap.

---

# 205. Subscription Graph

Conceptualmente:

```text
Event Type
   │
   ├── Handler A
   ├── Handler B
   └── Handler C
```

---

# 206. Graph Validation

Antes de Activation deberán validarse:

```text
event exists
handler exists
visibility
compatibility
handler constructability
authorization
```

cuando corresponda.

---

# 207. Handler Constructability

ENG-019 deberá poder construir el Handler antes de considerarlo válido cuando se realice validación anticipada.

---

# 208. Lazy Handler

Podrá construirse solo al llegar el Event.

---

# 209. Eager Validation

Aunque sea Lazy, su Dependency Graph debería poder validarse antes de Activation cuando sea posible.

---

# 210. Handler Failure Isolation

En Dispatch con múltiples Handlers, un fallo no deberá corromper silenciosamente el estado interno del Event Bus.

---

# 211. Event Bus Internal State

El Bus deberá preservar consistencia aun si un Handler falla.

---

# 212. Reentrant Publication

Un Handler podrá publicar nuevos Events.

---

# 213. Reentrancy Risk

Puede producir:

```text
deep recursion
event loops
unexpected ordering
```

---

# 214. Event Loop

Ejemplo:

```text
Event A
 ↓
Handler
 ↓
Event B
 ↓
Handler
 ↓
Event A
```

---

# 215. Loop Detection

Tooling podrá detectar ciclos estáticos conocidos.

Runtime podrá aplicar límites cuando sea necesario.

---

# 216. Recursion Limit

Un Bus síncrono podrá protegerse contra profundidad patológica.

---

# 217. Queueing During Dispatch

Una implementación podrá utilizar cola interna para evitar recursión directa.

---

# 218. Breadth-First Dispatch

Podrá utilizarse:

```text
Event A
  ├── handlers
  └── generated Events queued
```

para procesamiento posterior.

---

# 219. Dispatch Strategy

La estrategia exacta deberá documentarse porque afecta ordering.

---

# 220. Concurrency

Handlers podrán ejecutarse:

```text
sequentially
concurrently
```

según Policy.

---

# 221. Sequential Dispatch

Es más simple y determinista.

Será adecuado para primera implementación.

---

# 222. Concurrent Dispatch

Puede mejorar throughput pero introduce:

```text
race conditions
ordering complexity
resource contention
```

---

# 223. Thread Safety

Implementations concurrentes deberán proteger su estado interno.

---

# 224. Handler Thread Safety

El Scope del Handler deberá ser compatible con concurrencia.

---

# 225. Backpressure

Sistemas asíncronos deberán considerar qué ocurre cuando Publishers producen más rápido que Consumers.

---

# 226. Backpressure Strategies

Podrán incluir:

```text
buffer
block
reject
drop
scale
```

según Contract operacional.

---

# 227. Queue Capacity

Buffers ilimitados deberán evitarse.

---

# 228. Overflow

El comportamiento ante overflow deberá ser explícito.

---

# 229. Rate Limiting

Podrá aplicarse a Publishers o Consumers.

---

# 230. Circuit Breaker

Integraciones externas ejecutadas por Handlers podrán utilizar Circuit Breakers.

No es responsabilidad central del Event Bus.

---

# 231. Timeout

Handlers podrán tener Timeout gobernado.

---

# 232. Cancellation

Dispatch síncrono/asíncrono podrá soportar Cancellation cuando el Implementation Profile lo permita.

---

# 233. Cancellation Semantics

Cancelar un Dispatch no significa automáticamente revertir efectos ya producidos.

---

# 234. Event Persistence

Un Event Bus puede ser:

```text
ephemeral
durable
```

---

# 235. Ephemeral Bus

Los Events existen solo durante Runtime.

---

# 236. Durable Bus

Los Events/Deliveries se almacenan para procesamiento confiable.

---

# 237. First Implementation

MEF podrá comenzar con:

```text
ephemeral
in-process
synchronous
```

---

# 238. Architecture Must Permit Evolution

Las abstracciones no deberán impedir agregar posteriormente:

```text
durable
async
distributed
```

---

# 239. Broker Adapter

Podrán existir Adapters para:

```text
RabbitMQ
Kafka
AWS SNS/SQS
Azure Service Bus
Google Pub/Sub
```

sin convertirlos en dependencia arquitectónica de MEF.

---

# 240. Broker Semantics

Cada Broker posee garantías diferentes.

El Adapter no deberá fingir garantías que el Broker no ofrece.

---

# 241. Technology Independence

MEF Event Bus deberá permanecer neutral respecto del Broker.

---

# 242. Lowest Common Denominator Risk

Neutralidad no significa reducir todas las capacidades al mínimo común.

Podrán existir Capability Extensions.

---

# 243. Broker-Specific Capability

Una capacidad específica deberá declararse explícitamente.

---

# 244. Capability Registry

ENG-020 podrá registrar capacidades como:

```text
CAP-EVENT-DURABLE
CAP-EVENT-ORDERED
CAP-EVENT-DEAD-LETTER
```

si ENG-005 formaliza estos IDs.

---

# 245. Capability Requirement

Un Module podrá requerir una capacidad concreta cuando sea necesaria.

---

# 246. No Hidden Capability Dependency

Un Module no deberá asumir que todos los Event Bus Adapters soportan:

```text
transactions
global ordering
exactly-once
```

---

# 247. Testing

ENG-009 deberá cubrir Event Bus.

---

# 248. Unit Testing Publisher

Un Publisher deberá poder probarse utilizando:

```text
FakeEventPublisher
```

o equivalente.

---

# 249. Event Capture

Testing podrá capturar Events publicados.

---

# 250. Handler Unit Test

Un Handler deberá poder probarse directamente contra un Event válido.

---

# 251. Bus Integration Test

Deberá probar:

```text
publish
subscription discovery
handler resolution
dispatch
failure policy
```

---

# 252. Contract Test

Events públicos deberán probar Schema y Compatibility.

---

# 253. Ordering Test

Si existe garantía de Ordering deberá probarse.

---

# 254. Retry Test

Deberá verificar:

```text
attempt count
backoff policy
final failure
```

cuando exista.

---

# 255. Idempotency Test

Handlers que requieran Idempotency deberán probar duplicados.

---

# 256. DLQ Test

Deberá probar Poison Events cuando exista DLQ.

---

# 257. Correlation Test

Deberá verificarse propagación de Correlation/Causation cuando aplique.

---

# 258. Security Test

Deberá cubrir:

```text
unauthorized publish
unauthorized subscription
spoofed publisher
invalid payload
sensitive data leakage
```

---

# 259. Concurrency Test

Solo será necesario cuando la implementación soporte Dispatch concurrente.

---

# 260. Replay Test

Sistemas durables deberán probar Reprocessing.

---

# 261. Error Taxonomy

Taxonomía conceptual:

```text
MEF-EVT-001 Unknown event type
MEF-EVT-002 Unsupported event version
MEF-EVT-003 Invalid event payload
MEF-EVT-004 Publish unauthorized
MEF-EVT-005 Subscription unauthorized
MEF-EVT-006 Handler not found
MEF-EVT-007 Handler resolution failed
MEF-EVT-008 Handler execution failed
MEF-EVT-009 Dispatch failed
MEF-EVT-010 Retry exhausted
MEF-EVT-011 Event dead-lettered
MEF-EVT-012 Duplicate subscription
MEF-EVT-013 Invalid subscription
MEF-EVT-014 Event loop detected
MEF-EVT-015 Delivery timeout
MEF-EVT-016 Queue overflow
MEF-EVT-017 Serialization failed
MEF-EVT-018 Deserialization failed
MEF-EVT-019 Correlation context invalid
MEF-EVT-020 Event bus unavailable
```

---

# 262. Unknown Event

```text
MEF-EVT-001

Unknown event type.

Event:
EV-CUSTOMER-CREATED-001

Version:
1.0.0
```

---

# 263. Unsupported Version

```text
MEF-EVT-002

Unsupported event version.

Event:
EV-CUSTOMER-CREATED-001

Received:
3.0.0

Supported:
^2.0
```

---

# 264. Handler Failure

```text
MEF-EVT-008

Event handler execution failed.

Event:
EV-CUSTOMER-CREATED-001

Event ID:
01J...

Handler:
SendWelcomeEmail

Attempt:
2
```

---

# 265. Retry Exhausted

```text
MEF-EVT-010

Event delivery retry limit exhausted.

Event:
EV-PAYMENT-COMPLETED-001

Handler:
UpdateAccounting

Attempts:
5
```

---

# 266. Duplicate Subscription

```text
MEF-EVT-012

Duplicate event subscription detected.

Event:
EV-CUSTOMER-CREATED-001

Handler:
SendWelcomeEmail
```

---

# 267. Event Loop

```text
MEF-EVT-014

Possible event publication loop detected.

Chain:
EV-A
→ EV-B
→ EV-C
→ EV-A
```

---

# 268. Diagnostics

Los errores deberían incluir cuando sea seguro:

```text
eventType
eventVersion
eventId
handler
subscription
publisher
attempt
correlationId
cause
```

---

# 269. No Payload Dump

Un Error no deberá incluir automáticamente el Payload completo.

---

# 270. CLI Integration

ENG-007 podrá incorporar:

```text
mef event list
mef event inspect
mef event subscribers
mef event graph
mef event validate
mef event replay
mef event dead-letter
```

---

# 271. `event list`

Podrá mostrar Events registrados.

---

# 272. `event inspect`

Podrá mostrar:

```text
ID
Version
Owner
Visibility
Schema
Publishers
Subscribers
```

---

# 273. `event subscribers`

Podrá mostrar Handlers registrados.

---

# 274. `event graph`

Ejemplo:

```text
EV-CUSTOMER-CREATED-001
├── SendWelcomeEmail
├── CreateAuditRecord
└── UpdateAnalytics
```

---

# 275. `event validate`

Validará:

```text
schemas
subscriptions
handlers
compatibility
visibility
```

---

# 276. `event replay`

Solo estará disponible para infraestructura durable que soporte Replay.

---

# 277. `event dead-letter`

Permitirá inspección gobernada de DLQ cuando exista.

---

# 278. Machine Output

Los comandos deberán soportar salida estructurada para CI/automation cuando corresponda.

---

# 279. Build Integration

ENG-012 podrá validar durante Build:

```text
event schemas
duplicate subscriptions
unknown events
invalid handlers
compatibility
visibility
```

---

# 280. Quality Gate

Deberá fallar cuando existan inconsistencias arquitectónicas obligatorias.

---

# 281. Release Integration

ENG-017 deberá detectar Breaking Changes en Events públicos.

---

# 282. Release Notes

Cambios relevantes deberán documentarse:

```text
new events
deprecated events
retired events
breaking schema changes
delivery semantic changes
```

---

# 283. Event Bus Configuration

ENG-011 deberá gestionar Configuration.

Ejemplo conceptual:

```yaml
eventBus:
  mode: synchronous
  failurePolicy: fail-fast
```

---

# 284. Configuration Validation

Valores inválidos deberán detectarse durante Bootstrap.

---

# 285. Configuration Does Not Redefine Contract

Cambiar Configuration no deberá modificar silenciosamente garantías contractuales publicadas.

---

# 286. Adapter Configuration

Los Adapters podrán tener Configuration específica.

---

# 287. Runtime Integration

ENG-027 deberá coordinar inicialización del Event Bus.

---

# 288. Bootstrap Sequence

Secuencia recomendada:

```text
Configuration
      ↓
Package Discovery
      ↓
Manifest Validation
      ↓
Registry Build
      ↓
Contract Validation
      ↓
Subscription Discovery
      ↓
Subscription Validation
      ↓
Container Build
      ↓
Event Bus Build
      ↓
Handler Graph Validation
      ↓
Module Initialization
      ↓
Activation
```

---

# 289. Event Bus Availability

Los Modules que requieran publicación durante Initialization deberán recibir un Publisher válido únicamente cuando el Lifecycle lo permita.

---

# 290. Bootstrap Events

Publicar Events durante Bootstrap puede producir ciclos.

Deberá gobernarse explícitamente.

---

# 291. Pre-Activation Events

La primera implementación debería limitar Events de negocio antes de Activation.

---

# 292. Lifecycle Events

MEF podrá utilizar un canal interno controlado para Events de Lifecycle.

---

# 293. Shutdown

El Event Bus deberá participar en Shutdown.

---

# 294. Graceful Shutdown

En asincronía podrá requerirse:

```text
stop accepting new work
drain in-flight deliveries
flush durable state
close broker connections
```

---

# 295. Shutdown Timeout

Deberá existir límite cuando corresponda.

---

# 296. In-Flight Events

La política deberá determinar qué ocurre con Deliveries en curso.

---

# 297. Durable Shutdown

Los Events persistidos no deberán perderse por Shutdown normal.

---

# 298. In-Memory Shutdown

Los Events pendientes pueden perderse si la infraestructura es explícitamente ephemeral.

---

# 299. Runtime Failure

Tras fallo abrupto, las garantías dependerán del Delivery Mode.

---

# 300. Architecture Does Not Overpromise

MEF deberá exponer las garantías reales de cada Adapter.

---

# 301. Invariantes de Ingeniería

ENG-022 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-386 | Todo Event público deberá representar un hecho observable y poseer identidad contractual estable. |
| EI-387 | Event Type ID y Event Instance ID deberán mantenerse como conceptos distintos. |
| EI-388 | Todo Event público que cruce una frontera arquitectónica deberá gobernarse como Contract. |
| EI-389 | El Publisher no deberá requerir conocimiento directo de los Subscribers de un Event. |
| EI-390 | El Event Bus no deberá contener la lógica de negocio específica perteneciente a los Handlers. |
| EI-391 | Los Events publicados deberán considerarse inmutables. |
| EI-392 | Publication, Dispatch y Delivery deberán mantenerse como conceptos distinguibles. |
| EI-393 | Registry deberá descubrir metadata de Events/Subscriptions sin asumir la responsabilidad de Dispatch. |
| EI-394 | El Service Container deberá conservar la responsabilidad de construcción de Handler Instances. |
| EI-395 | El Ordering de Events y Handlers no deberá asumirse cuando no esté explícitamente garantizado. |
| EI-396 | La política de fallos de múltiples Handlers deberá ser explícita y determinista. |
| EI-397 | Todo mecanismo de Retry deberá considerar la posibilidad de ejecución duplicada y sus requisitos de Idempotency. |
| EI-398 | MEF no deberá prometer Exactly-Once universalmente sin una frontera y mecanismo formal que lo garanticen. |
| EI-399 | Los Retries deberán estar acotados por una Policy gobernada. |
| EI-400 | Los Events que excedan la política de recuperación no deberán desaparecer silenciosamente cuando la infraestructura prometa durabilidad. |
| EI-401 | Los Events públicos deberán evolucionar conforme Versioning y Compatibility. |
| EI-402 | Un Event que afirma que un hecho ocurrió no deberá publicarse antes de que ese hecho sea verdadero conforme a su Contract. |
| EI-403 | Correlation Context y Causation Context deberán permanecer separados de la semántica del Payload salvo que formen parte explícita del Contract. |
| EI-404 | El Event Bus deberá aplicar Visibility y Security a Publication y Subscription. |
| EI-405 | Las garantías reales de Delivery, Ordering, Durability y Failure deberán corresponder a las capacidades efectivas del Adapter utilizado. |

---

# 302. Criterios de Conformidad

Una implementación será conforme con ENG-022 cuando:

- represente Events mediante identidad estable;
- distinga Event Type e Instance;
- integre ENG-021;
- mantenga Publisher desacoplado de Subscribers;
- permita Registration de Subscriptions;
- integre Registry;
- integre Container;
- permita DI en Handlers;
- defina Dispatch Mode;
- defina Ordering;
- defina Failure Policy;
- defina Retry cuando aplique;
- considere Idempotency;
- soporte Correlation;
- preserve Event Immutability;
- aplique Security;
- permita Testing;
- permita Diagnostics;
- mantenga independencia tecnológica;
- no prometa garantías inexistentes.

---

# 303. Riesgos

Deberán evitarse especialmente:

## Event Bus as Service Locator

Utilizar el Bus para encontrar y ejecutar Services arbitrarios.

## Event Bus as Command Bus

Enviar instrucciones disfrazadas sistemáticamente de Events.

## Event Bus as Query Bus

Intentar obtener respuestas síncronas de múltiples Subscribers.

## Direct Subscriber Coupling

El Publisher conoce los Handlers.

## Hidden Ordering

Handlers dependen accidentalmente del orden de Registration.

## Retry Without Idempotency

Un Retry duplica efectos.

## Infinite Retry

Poison Events se procesan indefinidamente.

## Payload Database Dump

Events transportan Entities completas sin necesidad.

## Mutable Events

Un Handler modifica el Event para otros Consumers.

## Silent Subscriber Failure

Los errores desaparecen sin diagnóstico.

## False Exactly-Once

Se promete una garantía que la infraestructura no puede cumplir.

## Transactional Gap

Se confirma negocio pero se pierde Event, o se publica Event de una transacción revertida.

## Broker Leakage

Los Modules dependen directamente de APIs de Kafka/RabbitMQ/etc.

## Global Bus Access

Cualquier Module puede publicar o consumir cualquier Event.

## Event Loop

Handlers producen ciclos no controlados.

## Sync-to-Async Semantic Drift

Cambiar el Adapter altera silenciosamente garantías del Contract.

---

# 304. Arquitectura Recomendada

```text
                        PUBLISHER
                            │
                            ▼
                     EVENT CONTRACT
                            │
                            ▼
                      EVENT ENVELOPE
                            │
                            ▼
                       EVENT BUS
                            │
                 ┌──────────┴──────────┐
                 ▼                     ▼
             ROUTING               DELIVERY
                 │                     │
                 ▼                     ▼
             REGISTRY              CONTAINER
                 │                     │
                 ▼                     ▼
           SUBSCRIPTIONS            HANDLER
                 │                     │
                 └──────────┬──────────┘
                            ▼
                        EXECUTION
                            │
                 ┌──────────┼──────────┐
                 ▼          ▼          ▼
              SUCCESS     RETRY      FAILURE
                            │          │
                            ▼          ▼
                       REDELIVERY     DLQ
```

---

# 305. Primera Implementación Recomendada

La primera implementación de MEF debería utilizar:

```text
In-process Event Bus
Synchronous Dispatch
Explicit Subscriptions
Immutable Events
Sequential Handlers
Deterministic Subscription Ordering
Fail-Fast Policy
Registry Discovery
Container Handler Resolution
Correlation Context
Contract Validation
```

Estructura conceptual mínima:

```text
EventBus
EventPublisher
EventEnvelope
EventContext

Subscription
SubscriptionRegistry

EventDispatcher
HandlerResolver
```

---

# 306. Interfaces Conceptuales

```text
EventPublisher
└── publish(Event)

EventBus
├── publish(Event)
└── dispatch(EventEnvelope)

SubscriptionRegistry
├── subscribers(eventType)
└── exists(subscription)

HandlerResolver
└── resolve(handlerId)
```

---

# 307. Flujo Inicial

```text
CustomerService
      │
      ▼
CustomerCreated
      │
      ▼
EventPublisher
      │
      ▼
EventEnvelope
      │
      ▼
EventBus
      │
      ▼
SubscriptionRegistry
      │
      ├───────────────────┐
      ▼                   ▼
SendWelcomeEmail     AuditCustomerCreation
      │                   │
      ▼                   ▼
 Service Container    Service Container
      │                   │
      ▼                   ▼
 Handler Instance     Handler Instance
      │                   │
      └─────────┬─────────┘
                ▼
             Complete
```

---

# 308. Segunda Fase

Podrá incorporar:

```text
Asynchronous In-Process Dispatch
Retry Policies
Idempotency Infrastructure
Handler Timeout
Dead Letter Storage
Event Replay
Transactional Outbox
Inbox
```

---

# 309. Tercera Fase

Solo cuando exista necesidad:

```text
Distributed Event Bus
Broker Adapters
Kafka
RabbitMQ
Cloud Messaging
Partitioning
Distributed Ordering
Backpressure
Durable Replay
Cross-Process Contract Registry
```

---

# 310. Relación con ENG-018

```text
Handler
   │
   ▼
Dependencies
   │
   ▼
Dependency Injection
```

ENG-018 entrega dependencias al Handler.

---

# 311. Relación con ENG-019

```text
Handler Descriptor
       │
       ▼
Service Container
       │
       ▼
Handler Instance
```

ENG-019 construye los Handlers.

---

# 312. Relación con ENG-020

```text
Event
   │
   ▼
Registry
   │
   ├── Event Contract
   ├── Publisher
   └── Subscriptions
```

ENG-020 conoce la topología.

No ejecuta Dispatch.

---

# 313. Relación con ENG-021

```text
Event
   │
   ▼
Contract
   │
   ├── Identity
   ├── Version
   ├── Schema
   ├── Semantics
   └── Compatibility
```

ENG-021 gobierna la frontera contractual del Event.

---

# 314. Relación con ENG-023

ENG-023 deberá formalizar:

```text
Handler Errors
Dispatch Errors
Retryable Errors
Fatal Errors
Error Propagation
Error Translation
```

---

# 315. Relación con ENG-024

ENG-024 deberá gobernar:

```text
Publisher Authorization
Subscriber Authorization
Trust
Payload Protection
Sensitive Events
Replay Protection
Audit
```

---

# 316. Relación con ENG-027

Runtime coordinará:

```text
Registry
   ↓
Contracts
   ↓
Container
   ↓
Subscriptions
   ↓
Event Bus
   ↓
Modules
   ↓
Activation
```

---

# 317. Principio Rector

> **El Event Bus de MEF deberá proporcionar comunicación desacoplada, gobernada y observable mediante Events contractuales e inmutables, preservando la independencia entre Publishers y Subscribers y haciendo explícitas sus garantías de Dispatch, Ordering, Delivery, Failure, Retry, Security y Durability.**

---

# 318. Conclusión

**ENG-022 — Event Bus Engineering** establece la infraestructura de comunicación reactiva de MEF.

La cadena fundamental queda:

```text
Business Operation
       ↓
      Fact
       ↓
     Event
       ↓
Event Contract
       ↓
Event Envelope
       ↓
  Event Publisher
       ↓
    Event Bus
       ↓
 Subscription
       ↓
    Handler
       ↓
Business Reaction
```

La separación de responsabilidades será:

```text
ENG-018
Dependency Injection
→ entrega dependencias

ENG-019
Service Container
→ construye Handlers

ENG-020
Registry
→ conoce Events y Subscriptions

ENG-021
Contracts
→ define Events públicos y su semántica

ENG-022
Event Bus
→ publica, enruta y despacha Events
```

De esta forma:

```text
MOD-CUSTOMER
      │
      ▼
EV-CUSTOMER-CREATED-001
      │
      ▼
   Event Bus
      │
      ├───────────────┬────────────────┐
      ▼               ▼                ▼
MOD-NOTIFICATION   MOD-AUDIT      MOD-ANALYTICS
```

`MOD-CUSTOMER` no necesita conocer:

```text
SendWelcomeEmail
AuditCustomerCreated
AnalyticsCustomerHandler
```

y esos Consumers podrán agregarse o eliminarse sin modificar al Publisher, siempre que respeten:

```text
Event Contract
Visibility
Compatibility
Security
Subscription Policy
```

La primera versión deberá mantenerse deliberadamente sencilla:

```text
in-process
+
synchronous
+
explicit subscriptions
+
sequential dispatch
+
immutable events
```

sin cerrar la arquitectura a una evolución posterior hacia:

```text
async
durable
distributed
broker-backed
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-012 — Dependency Injection
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-027 — Runtime Engineering