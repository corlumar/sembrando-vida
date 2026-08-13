---
id: ENG-044
titulo: API Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: API Engineering
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
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-034
  - ENG-036
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-043
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-022
  - ENG-030
  - ENG-035
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-045
keywords:
  - api
  - rest
  - http
  - endpoint
  - resource
  - request
  - response
  - api-contract
  - versioning
  - idempotency
  - pagination
  - filtering
  - sorting
  - rate-limit
  - openapi
  - cors
  - etag
  - compatibility
  - deprecation
  - mef
---

# ENG-044

# API Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **API Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-044 establece las reglas para:

```text
API
API Boundary
API Contract
Endpoint
Resource
Operation
Request
Response
HTTP Semantics
HTTP Method
Status Code
Header
Content Type
Content Negotiation
Representation
API Version
Compatibility
Deprecation
Pagination
Filtering
Sorting
Field Selection
Validation
Error Contract
Problem Details
Idempotency
Conditional Request
ETag
Caching
Authentication Integration
Authorization Integration
Tenant Context
Rate Limiting
Quota
CORS
OpenAPI
API Discovery
API Observability
API Security
API Testing
API Lifecycle
```

---

# 2. Declaración

La regla fundamental será:

> **Toda API pública deberá ser tratada como un contrato versionado, seguro, observable y evolutivo, independiente de la estructura interna de Application, Domain, Persistence y Transport.**

Arquitectura conceptual:

```text
External Consumer
       │
       ▼
   API Boundary
       │
       ├── Authentication
       ├── Authorization
       ├── Rate Limit
       ├── Validation
       ├── Versioning
       └── Contract
       │
       ▼
    Endpoint
       │
       ▼
  Application
       │
       ▼
    Domain
       │
       ▼
Infrastructure
```

---

# 3. API

Una `API` representa una interfaz explícita ofrecida a Consumers.

---

# 4. API ≠ Application

API expone Application Capabilities.

No deberá contener Business Logic sustantiva.

---

# 5. API ≠ Transport

La separación será:

```text
ENG-032 Transport
→ cómo viaja la información

ENG-044 API
→ qué contrato se expone
```

---

# 6. API ≠ Serialization

```text
ENG-031 Serialization
→ representación física

ENG-044 API
→ semántica pública
```

---

# 7. API ≠ Domain

Domain no deberá conocer:

```text
HTTP
URL
status codes
headers
JSON
OpenAPI
controllers
```

---

# 8. API Boundary

Toda entrada externa deberá atravesar una Boundary controlada.

---

# 9. Boundary Responsibilities

Podrá incluir:

```text
routing
authentication
authorization
tenant resolution
rate limiting
request parsing
validation
contract translation
response translation
observability
```

---

# 10. API Contract

Un `API Contract` define comportamiento observable por Consumers.

Incluye:

```text
operations
inputs
outputs
errors
status semantics
headers
pagination
compatibility guarantees
```

---

# 11. Contract First

APIs públicas deberán diseñarse preferentemente desde Contract antes de exponer implementación.

---

# 12. Implementation First

Podrá utilizarse internamente, pero no deberá permitir que estructuras accidentales se conviertan automáticamente en contratos públicos.

---

# 13. Public Contract Stability

Una vez publicada una API estable, cambios incompatibles deberán gobernarse mediante Versioning/Deprecation.

---

# 14. Endpoint

Un `Endpoint` representa una operación direccionable de API.

---

# 15. Endpoint Definition

Conceptualmente:

```text
EndpointDefinition
├── id
├── method
├── path
├── version
├── request
├── response
├── errors
├── authorization
└── metadata
```

---

# 16. Endpoint ID

Todo Endpoint deberá poseer identificador lógico estable.

Ejemplo:

```text
orders.create
orders.get
orders.list
orders.cancel
```

---

# 17. Endpoint ID ≠ URL

La URL podrá evolucionar independientemente del identificador lógico.

---

# 18. Resource

En APIs Resource-Oriented deberá modelarse un concepto estable del negocio.

Ejemplo:

```text
/orders
/customers
/invoices
```

---

# 19. Resource ≠ Table

No deberá reflejar automáticamente Database Schema.

---

# 20. Resource ≠ Domain Entity Always

Una API podrá exponer:

```text
resource
projection
workflow
operation
```

sin mapear 1:1 a Domain Entity.

---

# 21. URI Design

URIs deberán ser:

```text
stable
predictable
resource-oriented
implementation-neutral
```

---

# 22. Internal Technology in URI

No deberá exponerse:

```text
/php/
mysql
repository
controller
serviceImpl
```

---

# 23. Resource Naming

Deberá ser consistente.

---

# 24. HTTP Methods

Para HTTP APIs deberán respetarse semánticas estándar.

---

# 25. GET

Deberá utilizarse para lectura.

---

# 26. GET Safety

GET no deberá modificar Business State intencionalmente.

---

# 27. GET Idempotency

Múltiples GET equivalentes deberán preservar semántica de lectura.

---

# 28. POST

Normalmente representa:

```text
create
command
process
```

cuando no exista semántica mejor.

---

# 29. PUT

Normalmente representa reemplazo o escritura idempotente sobre Resource conocido.

---

# 30. PATCH

Representa modificación parcial.

---

# 31. DELETE

Representa solicitud de eliminación según Business Semantics.

---

# 32. DELETE ≠ Physical Delete

Puede significar:

```text
deactivate
archive
cancel
soft-delete
```

---

# 33. OPTIONS

Podrá utilizarse para capacidades HTTP/CORS.

---

# 34. HEAD

Deberá comportarse coherentemente con GET sin Body.

---

# 35. Method Semantics

No deberá elegirse HTTP Method únicamente por conveniencia del Framework.

---

# 36. Safe Methods

Deberá respetarse el concepto HTTP de Safe Method.

---

# 37. Idempotent Methods

Deberá respetarse la semántica de:

```text
GET
HEAD
PUT
DELETE
```

según Contract.

---

# 38. POST Idempotency

POST podrá hacerse Idempotent mediante Idempotency Key.

---

# 39. Request

Un `Request` contiene Input externo.

---

# 40. Request DTO

Deberá utilizarse Contract específico.

Ejemplo:

```text
CreateOrderRequest
```

---

# 41. Request DTO ≠ Domain Entity

No deberá deserializarse Input directamente a Aggregate.

---

# 42. Mass Assignment

No deberá permitirse automáticamente.

---

# 43. Explicit Mapping

La transformación deberá ser:

```text
API Request
   │
   ▼
Application Input
   │
   ▼
Domain
```

---

# 44. Unknown Fields

La Policy deberá definirse explícitamente:

```text
reject
ignore
```

---

# 45. Strict Input

Para APIs críticas deberá favorecerse rechazo de campos desconocidos.

---

# 46. Required Field

Deberá distinguirse de:

```text
optional
nullable
missing
```

---

# 47. Null Semantics

Deberán definirse.

Especialmente para PATCH.

---

# 48. PATCH Missing

Puede significar:

```text
do not modify
```

---

# 49. PATCH Null

Puede significar:

```text
clear value
```

si Contract lo permite.

---

# 50. Response

Una `Response` representa Output público.

---

# 51. Response DTO

No deberá exponer Domain Object o ORM Entity directamente.

---

# 52. Explicit Projection

La Response deberá utilizar representación pública explícita.

---

# 53. Internal Field Leakage

No deberán exponerse accidentalmente:

```text
password_hash
internal flags
database ids not intended as public
audit secrets
tenant internals
```

---

# 54. Stable Response Shape

Cambios deberán respetar Compatibility Policy.

---

# 55. Response Envelope

No será obligatorio universalmente.

---

# 56. Envelope Use

Podrá utilizarse cuando aporte:

```text
metadata
pagination
links
warnings
```

---

# 57. Envelope Consistency

Si se adopta deberá ser uniforme.

---

# 58. HTTP Status

Deberá representar resultado protocolario, no sustituir Error Contract.

---

# 59. 2xx

Representan Success.

---

# 60. 200 OK

Adecuado para respuesta exitosa general.

---

# 61. 201 Created

Deberá utilizarse cuando se crea Resource.

---

# 62. Location

Una creación podrá retornar:

```text
Location
```

del Resource creado.

---

# 63. 202 Accepted

Deberá utilizarse cuando trabajo fue aceptado pero aún no completado.

---

# 64. 204 No Content

No deberá incluir Body.

---

# 65. 3xx

Redirections deberán utilizarse únicamente con semántica explícita.

---

# 66. 400 Bad Request

Deberá reservarse para Request inválida a nivel general cuando no exista código más preciso.

---

# 67. 401 Unauthorized

Representa falta o invalidez de Authentication.

---

# 68. 403 Forbidden

Representa Authentication válida pero autorización insuficiente.

---

# 69. 404 Not Found

Podrá utilizarse también para evitar Resource Enumeration según Security Policy.

---

# 70. 405 Method Not Allowed

Deberá utilizarse para Method no permitido sobre Resource conocido.

---

# 71. 409 Conflict

Podrá representar:

```text
state conflict
optimistic concurrency conflict
duplicate operation
```

---

# 72. 412 Precondition Failed

Adecuado para Conditional Requests fallidas.

---

# 73. 415 Unsupported Media Type

Deberá utilizarse cuando Request Media Type no sea soportado.

---

# 74. 422 Unprocessable Content

Podrá utilizarse para Input sintácticamente válido pero semánticamente inválido.

---

# 75. 429 Too Many Requests

Representa Rate Limit excedido.

---

# 76. 5xx

Representan Failure del servidor o dependencia que no debe atribuirse al Consumer.

---

# 77. 500 Internal Server Error

No deberá exponer detalles internos.

---

# 78. 503 Service Unavailable

Podrá utilizarse para incapacidad temporal.

---

# 79. Status Mapping

ENG-023 deberá gobernar traducción Error → API Response.

---

# 80. Error Contract

Toda API deberá poseer formato de Error estable.

---

# 81. Problem Details

Para HTTP deberá favorecerse un modelo compatible conceptualmente con:

```text
application/problem+json
```

---

# 82. Problem Shape

Conceptualmente:

```text
type
title
status
detail
instance
code
traceId
errors
```

---

# 83. Stable Error Code

Deberá existir código machine-readable estable.

---

# 84. Human Message

No deberá utilizarse como identificador programático.

---

# 85. Validation Errors

Podrán contener:

```text
field
code
message
```

---

# 86. Error Detail Security

No deberá revelar:

```text
stack trace
SQL
filesystem path
secret
credential
internal topology
```

---

# 87. Internal Error

Deberá traducirse a Error público apropiado.

---

# 88. Error Correlation

Response podrá incluir:

```text
traceId
requestId
```

---

# 89. Stack Trace

No deberá enviarse al Consumer en Production.

---

# 90. Content Type

Toda representación deberá declarar Media Type apropiado.

---

# 91. JSON

Podrá ser representación Default.

---

# 92. JSON Contract

ENG-031 gobernará detalles de Serialization.

---

# 93. Content Negotiation

Podrá utilizar:

```text
Accept
Content-Type
```

---

# 94. Unsupported Representation

Deberá rechazarse explícitamente.

---

# 95. Charset

Deberá utilizarse encoding interoperable, normalmente UTF-8.

---

# 96. Date/Time

Deberá utilizar formato estándar e inequívoco.

---

# 97. Timezone

No deberá omitirse cuando el instante lo requiera.

---

# 98. Decimal

Valores monetarios no deberán depender de Float binario cuando precisión sea crítica.

---

# 99. Enum

Valores públicos deberán tratarse como parte del Contract.

---

# 100. Enum Evolution

Agregar nuevos valores puede ser Breaking para Consumers no tolerantes.

---

# 101. Identifier

Los identificadores públicos deberán tener representación estable.

---

# 102. Internal Sequential ID

No deberá exponerse cuando genere riesgo innecesario.

---

# 103. Versioning

Toda API estable deberá poseer estrategia explícita de Versioning.

---

# 104. Version ≠ Release

```text
Framework Release
≠
API Contract Version
```

---

# 105. Versioning Strategies

Podrán incluir:

```text
URI
Header
Media Type
```

---

# 106. First Version Strategy

La primera implementación deberá favorecer una estrategia única y consistente.

---

# 107. URI Versioning

Ejemplo:

```text
/api/v1/orders
```

---

# 108. Header Versioning

Podrá utilizarse cuando exista necesidad clara.

---

# 109. Mixed Versioning

No deberá utilizarse sin justificación.

---

# 110. Version Scope

Deberá definirse si Version aplica a:

```text
whole API
module
resource
operation
```

---

# 111. Compatibility

ENG-016 gobernará Compatibility general.

---

# 112. API Compatibility

Deberá analizarse desde perspectiva del Consumer.

---

# 113. Breaking Change

Ejemplos:

```text
remove endpoint
remove field
rename field
change field type
make optional field required
change semantics
remove enum value
change error meaning
```

---

# 114. Potentially Breaking Change

Agregar:

```text
enum value
required response behavior
new validation
```

puede romper Consumers.

---

# 115. Usually Compatible Change

Podrá incluir:

```text
new optional request field
new endpoint
new optional response field
```

si Consumer Contract lo permite.

---

# 116. Consumer Robustness

No deberá utilizarse como excusa para cambios arbitrarios.

---

# 117. API Compatibility Matrix

Podrá documentarse:

```text
API version
framework version
support status
deprecation date
removal date
```

---

# 118. Deprecation

Toda funcionalidad pública retirada deberá pasar por Lifecycle explícito.

---

# 119. Deprecation States

Conceptualmente:

```text
ACTIVE
DEPRECATED
SUNSET
REMOVED
```

---

# 120. Deprecation Notice

Podrá comunicarse mediante:

```text
documentation
headers
release notes
telemetry
```

---

# 121. Sunset

Podrá declararse fecha prevista de retiro.

---

# 122. Immediate Removal

Solo deberá ocurrir ante:

```text
critical security issue
legal requirement
unrecoverable operational risk
```

o contrato explícito que lo permita.

---

# 123. Deprecated Endpoint Telemetry

Deberá poder medirse su uso.

---

# 124. Removal Decision

Deberá basarse en:

```text
support policy
consumer usage
migration readiness
security
```

---

# 125. Pagination

ENG-043 gobernará mecanismo interno.

ENG-044 gobernará Contract externo.

---

# 126. Pagination Request

Podrá exponer:

```text
page
pageSize
```

o:

```text
cursor
limit
```

---

# 127. Pagination Response

Podrá contener:

```text
items
nextCursor
previousCursor
hasMore
total
```

según estrategia.

---

# 128. Pagination Strategy

No deberá mezclar Offset y Cursor arbitrariamente en un mismo Endpoint.

---

# 129. Maximum Page Size

Deberá aplicarse.

---

# 130. Client Page Size

No deberá superar Maximum configurado.

---

# 131. Default Page Size

Deberá documentarse.

---

# 132. Total Count

No deberá prometerse cuando resulte costoso o inconsistente.

---

# 133. Cursor Opaqueness

El Consumer deberá tratar Cursor como valor opaco.

---

# 134. Cursor Tampering

Deberá detectarse cuando Cursor contenga State verificable.

---

# 135. Filtering

API deberá exponer únicamente Filters permitidos.

---

# 136. Filter Contract

Cada Filter deberá documentar:

```text
name
type
operators
cardinality expectations
```

---

# 137. Internal Field Mapping

Public Filter Name no deberá requerir coincidir con Database Column.

---

# 138. Sorting

Solo campos permitidos deberán ser Sortable.

---

# 139. Default Sort

Deberá ser determinístico.

---

# 140. Multi-Sort

Podrá permitirse con límites.

---

# 141. Arbitrary SQL Sort

No deberá existir.

---

# 142. Field Selection

Podrá soportarse:

```text
fields=id,name,status
```

cuando sea seguro.

---

# 143. Field Allowlist

Será obligatoria.

---

# 144. Sensitive Field Selection

No deberá ser posible mediante Field Selection genérico.

---

# 145. Expansion

Podrá soportarse:

```text
include
expand
```

---

# 146. Expansion Limit

Deberá evitar Graph Explosion y N+1.

---

# 147. Nested Expansion

Deberá limitarse en profundidad.

---

# 148. Validation

ENG-036 gobernará Validation.

---

# 149. API Validation

Deberá distinguir:

```text
syntax validation
schema validation
semantic validation
business validation
```

---

# 150. Syntax Validation

Ocurre en API Boundary.

---

# 151. Schema Validation

Verifica Contract.

---

# 152. Semantic Validation

Podrá ocurrir en Application.

---

# 153. Business Invariant

Permanece en Domain.

---

# 154. Validation Duplication

Podrá existir únicamente cuando proteja Boundaries diferentes.

---

# 155. Validation Error Stability

Error Codes deberán ser estables.

---

# 156. Authentication

ENG-024 gobernará Security.

---

# 157. Authentication Boundary

Deberá ejecutarse antes de operaciones protegidas.

---

# 158. Anonymous Endpoint

Deberá declararse explícitamente.

---

# 159. Default Security

Deberá favorecer:

```text
deny by default
```

---

# 160. Authorization

Cada operación protegida deberá declarar Authorization Requirement.

---

# 161. Authorization ≠ Routing

Ocultar Endpoint no sustituye autorización.

---

# 162. Resource Authorization

Podrá depender de Resource específico.

---

# 163. Field Authorization

Podrá limitar campos de Response.

---

# 164. Tenant Context

Deberá derivarse de identidad/contexto autorizado.

---

# 165. Tenant Header

No deberá confiarse por sí solo.

---

# 166. Cross-Tenant API

Deberá requerir privilegio explícito.

---

# 167. Authentication Error

No deberá revelar información que facilite Account Enumeration.

---

# 168. Authorization Error

Podrá utilizar 403 o 404 según Security Policy.

---

# 169. Rate Limiting

Toda API pública susceptible de abuso deberá soportar Rate Limiting.

---

# 170. Rate Limit Scope

Podrá aplicarse por:

```text
identity
tenant
API key
IP
endpoint
resource
```

---

# 171. IP Rate Limit

No deberá ser único mecanismo para Consumers autenticados.

---

# 172. Rate Limit Algorithm

Podrá utilizar:

```text
token bucket
leaky bucket
fixed window
sliding window
```

---

# 173. Rate Limit Headers

Podrán exponerse cuando formen parte del Contract.

---

# 174. Retry-After

Deberá utilizarse cuando sea apropiado.

---

# 175. Rate Limit Storage

Deberá considerar consistencia y distribución.

---

# 176. Rate Limit Failure Mode

Deberá definirse:

```text
fail-open
fail-closed
```

según riesgo.

---

# 177. Quota

`Quota` representa límite de consumo en periodo mayor.

---

# 178. Quota ≠ Rate Limit

```text
Rate Limit
→ velocity

Quota
→ total allowance
```

---

# 179. Cost-Based Limit

Endpoints costosos podrán consumir unidades distintas.

---

# 180. Abuse Protection

Podrá combinar:

```text
rate limit
quota
payload limit
query complexity
concurrency limit
```

---

# 181. Request Size Limit

Deberá existir.

---

# 182. Header Size Limit

Deberá existir en Transport/Server.

---

# 183. Upload Limit

Deberá ser explícito cuando exista Upload.

---

# 184. Compression Bomb

Deberá considerarse para Input comprimido.

---

# 185. Idempotency

Operaciones susceptibles de Retry deberán definir semántica de Idempotency.

---

# 186. Idempotency Key

Podrá utilizarse para Commands no naturalmente Idempotent.

---

# 187. Idempotency Scope

Deberá incluir contexto suficiente:

```text
consumer
tenant
operation
key
```

---

# 188. Idempotency Key Reuse

Misma Key + misma operación deberá retornar resultado compatible.

---

# 189. Key Payload Conflict

Misma Key con Payload diferente deberá rechazarse.

---

# 190. Idempotency Record

Podrá contener:

```text
key
request fingerprint
state
response
createdAt
expiresAt
```

---

# 191. Idempotency States

Conceptualmente:

```text
PROCESSING
COMPLETED
FAILED
```

---

# 192. Concurrent Duplicate

Solo una ejecución deberá adquirir Ownership.

---

# 193. Idempotency Expiration

Deberá documentarse.

---

# 194. Idempotency ≠ Authentication

La Key no deberá considerarse Credential.

---

# 195. Transaction Integration

ENG-042 deberá gobernar persistencia atómica cuando Idempotency State y Business Effect deban coordinarse.

---

# 196. Retry

ENG-039 gobernará Retry.

---

# 197. Client Retry Guidance

API podrá comunicar:

```text
Retry-After
retryable error code
```

cuando sea seguro.

---

# 198. Unsafe Retry

No deberá recomendarse Retry para operación no Idempotent sin protección.

---

# 199. Conditional Request

Permite ejecutar operación únicamente si una condición sobre Resource se cumple.

---

# 200. ETag

Podrá representar Version de una Representation.

---

# 201. Strong ETag

Representa equivalencia byte/representation apropiada según HTTP Semantics.

---

# 202. Weak ETag

Podrá utilizarse cuando equivalencia semántica sea suficiente.

---

# 203. If-None-Match

Podrá utilizarse para Cache Validation.

---

# 204. If-Match

Podrá utilizarse para Optimistic Concurrency.

---

# 205. Lost Update Protection

Ejemplo:

```text
GET /orders/123
ETag: "v7"

PUT /orders/123
If-Match: "v7"
```

---

# 206. Stale Version

Deberá producir:

```text
412 Precondition Failed
```

o Contract equivalente.

---

# 207. ETag ≠ Secret

No deberá contener datos sensibles.

---

# 208. Cache

ENG-037 gobernará Caching.

---

# 209. Cache-Control

API deberá definir Policy apropiada.

---

# 210. Private Data

No deberá marcarse como public cacheable accidentalmente.

---

# 211. No-Store

Deberá utilizarse cuando Response sensible no deba almacenarse.

---

# 212. Vary

Deberá utilizarse correctamente cuando Representation dependa de Request Headers.

---

# 213. Cache Key Variation

Deberá considerar:

```text
authorization
tenant
language
representation
version
```

cuando corresponda.

---

# 214. CORS

CORS deberá configurarse explícitamente.

---

# 215. CORS ≠ Authentication

No es control de acceso del servidor.

---

# 216. Allowed Origins

No deberá utilizarse:

```text
*
```

con Credentials sensibles sin evaluación explícita.

---

# 217. Allowed Methods

Deberán limitarse.

---

# 218. Allowed Headers

Deberán limitarse.

---

# 219. Exposed Headers

Deberán declararse cuando Client necesite accederlos.

---

# 220. Preflight

Deberá responder de forma consistente.

---

# 221. CSRF

Para Authentication basada en Cookie deberá evaluarse CSRF independientemente de CORS.

---

# 222. API Key

Deberá transmitirse únicamente mediante mecanismo seguro.

---

# 223. API Key in URL

No deberá utilizarse.

---

# 224. Secret in Query String

No deberá utilizarse.

---

# 225. TLS

APIs sensibles deberán utilizar transporte seguro.

---

# 226. Security Headers

Deberán aplicarse cuando sean relevantes al tipo de Consumer.

---

# 227. OpenAPI

Toda HTTP API pública estable deberá poder describirse mediante OpenAPI o Contract equivalente.

---

# 228. OpenAPI Ownership

La Specification deberá formar parte del Source Control.

---

# 229. OpenAPI Generation

Podrá ser:

```text
contract-first
code-first
hybrid
```

---

# 230. Generated Specification

Deberá validarse.

---

# 231. OpenAPI Drift

No deberá existir divergencia silenciosa entre Runtime y Specification.

---

# 232. Schema Reuse

Deberá evitar duplicación innecesaria.

---

# 233. Operation ID

Deberá ser estable y único.

---

# 234. Examples

Podrán incluirse ejemplos sanitizados.

---

# 235. Secrets in Examples

No deberán existir.

---

# 236. Documentation

Deberá explicar semántica que Schema por sí solo no puede expresar.

---

# 237. API Discovery

MEF podrá registrar APIs disponibles.

---

# 238. API Registry

ENG-020 podrá mantener:

```text
ApiDefinition
EndpointDefinition
ApiVersion
DeprecationMetadata
```

---

# 239. Duplicate Route

Deberá detectarse durante Bootstrap.

---

# 240. Ambiguous Route

También.

---

# 241. Route Priority

No deberá depender de orden accidental de Module Discovery.

---

# 242. Module API

ENG-028 permitirá que cada Module declare Endpoints públicos.

---

# 243. Private Module API

Deberá distinguirse de Public API.

---

# 244. Internal API

Podrá poseer Contract diferente, pero no deberá considerarse sin gobernanza.

---

# 245. API Exposure

La visibilidad podrá ser:

```text
PUBLIC
PARTNER
INTERNAL
ADMIN
```

---

# 246. Exposure Policy

Deberá afectar:

```text
authentication
documentation
rate limits
network exposure
support policy
```

---

# 247. Admin API

Deberá poseer controles reforzados.

---

# 248. Internal ≠ Trusted

Una API interna también deberá autenticar/autorizar según Threat Model.

---

# 249. API Gateway

Podrá existir delante de MEF.

---

# 250. Gateway Responsibility

Podrá manejar:

```text
TLS termination
routing
WAF
coarse rate limiting
authentication assistance
```

---

# 251. Gateway ≠ Application Authorization

Business Authorization deberá permanecer en Application/API Boundary.

---

# 252. Proxy Awareness

Runtime deberá interpretar correctamente:

```text
Forwarded
X-Forwarded-For
X-Forwarded-Proto
```

solo desde Proxies confiables.

---

# 253. Client IP

No deberá confiarse en Headers arbitrarios.

---

# 254. Request ID

Toda Request deberá poseer identificador.

---

# 255. Correlation ID

Podrá aceptar uno externo bajo Policy.

---

# 256. Trace Context

ENG-025 gobernará Distributed Tracing.

---

# 257. Observability

Toda operación deberá ser observable.

---

# 258. API Metrics

Podrán incluir:

```text
mef.api.requests.total
mef.api.request.duration
mef.api.errors.total
mef.api.inflight
```

---

# 259. Metric Dimensions

Podrán incluir:

```text
endpointId
method
statusClass
version
```

con Cardinality acotada.

---

# 260. Raw Path Label

No deberá utilizarse cuando contenga IDs.

---

# 261. User ID Metric Label

No deberá utilizarse.

---

# 262. Tenant ID Metric Label

No deberá utilizarse salvo arquitectura controlada de Cardinality y Privacy.

---

# 263. Logs

Podrán incluir:

```text
requestId
traceId
endpointId
method
status
duration
```

---

# 264. Request Body Logging

No deberá activarse indiscriminadamente.

---

# 265. Response Body Logging

Tampoco.

---

# 266. Sensitive Headers

Deberán redactarse.

Ejemplos:

```text
Authorization
Cookie
Set-Cookie
API-Key
```

---

# 267. Slow API

Deberá existir Threshold configurable.

---

# 268. SLI

Podrán definirse:

```text
availability
latency
error rate
```

por API/Endpoint.

---

# 269. API Health

No deberá inferirse únicamente de que HTTP Server responda.

---

# 270. Dependency Failure

Deberá reflejarse mediante Error Contract apropiado.

---

# 271. Performance

ENG-026 gobernará Performance.

---

# 272. Payload Size

Deberá limitarse.

---

# 273. Response Size

Deberá limitarse o paginarse.

---

# 274. Compression

Podrá utilizarse según Payload y Transport.

---

# 275. Compression Cost

Deberá considerarse CPU.

---

# 276. Streaming

Podrá utilizarse para grandes Responses.

---

# 277. Streaming Error

Una vez iniciada Response puede no ser posible cambiar Status Code.

---

# 278. Streaming Contract

Deberá diseñarse explícitamente.

---

# 279. Timeout

Toda Request deberá tener Deadline apropiado.

---

# 280. Deadline Propagation

Deberá propagarse a:

```text
Application
Data Access
Transport
external dependencies
```

cuando sea posible.

---

# 281. Client Disconnect

Deberá cancelar trabajo innecesario cuando Runtime lo soporte.

---

# 282. Concurrency Limit

Endpoints costosos podrán limitar ejecución simultánea.

---

# 283. Backpressure

ENG-039 gobernará Backpressure.

---

# 284. Load Shedding

Podrá rechazarse trabajo antes de saturación total.

---

# 285. Bulk API

Podrá existir para reducir Round Trips.

---

# 286. Bulk Request Limit

Deberá ser acotado.

---

# 287. Bulk Atomicity

Deberá definirse explícitamente:

```text
all-or-nothing
partial success
per-item transaction
```

---

# 288. Partial Success

Deberá poseer Contract explícito.

---

# 289. Async API

Operaciones largas deberán poder utilizar modelo asíncrono.

---

# 290. Async Pattern

Ejemplo:

```text
POST /exports
      │
      ▼
202 Accepted
      │
      ▼
Operation Resource
      │
      ▼
GET /operations/{id}
```

---

# 291. Operation Resource

Podrá contener:

```text
id
status
progress
result
error
createdAt
completedAt
```

---

# 292. Operation State

Conceptualmente:

```text
PENDING
RUNNING
SUCCEEDED
FAILED
CANCELLED
```

---

# 293. Async Retry

Deberá integrarse con ENG-040 y ENG-039.

---

# 294. Webhook

No forma parte obligatoria de la primera versión.

---

# 295. Webhook Contract

Cuando exista deberá cubrir:

```text
delivery
signature
retry
idempotency
ordering
replay
```

---

# 296. API Security

ENG-024 gobernará Threat Model.

---

# 297. Security Requirements

Deberán contemplar:

```text
broken access control
injection
mass assignment
resource exhaustion
credential leakage
data exposure
replay
enumeration
SSRF through API input
```

---

# 298. Input URL

Si Endpoint acepta URLs externas deberá validarlas y proteger contra SSRF.

---

# 299. File Upload

Deberá validar:

```text
size
content
media type
storage location
authorization
```

---

# 300. Filename

No deberá confiarse como filesystem path.

---

# 301. Content-Type Trust

No deberá confiarse únicamente en Header enviado por cliente.

---

# 302. Download

Deberá aplicar Authorization en cada acceso.

---

# 303. Object Reference

No deberá equivaler automáticamente a permiso de acceso.

---

# 304. BOLA

Object-Level Authorization deberá proteger Resources.

---

# 305. BFLA

Function-Level Authorization deberá proteger Operations.

---

# 306. Testing

ENG-009 gobernará Testing.

---

# 307. Contract Test

Toda API pública deberá poseer Contract Tests.

---

# 308. Request Schema Test

Deberá probar:

```text
valid
missing
null
unknown
wrong type
oversized
```

---

# 309. Response Schema Test

Deberá comprobar Contract publicado.

---

# 310. Status Code Test

Deberá comprobar Mapping correcto.

---

# 311. Error Contract Test

Deberá comprobar formato estable.

---

# 312. Authentication Test

Deberá probar:

```text
missing
invalid
expired
valid
```

---

# 313. Authorization Test

Deberá probar permisos positivos y negativos.

---

# 314. Tenant Isolation Test

Será obligatorio.

---

# 315. BOLA Test

Deberá intentar acceder Resource de otro Owner/Tenant.

---

# 316. Rate Limit Test

Deberá comprobar límite y Recovery.

---

# 317. Idempotency Test

Deberá comprobar:

```text
same key same payload
same key different payload
concurrent duplicate
expired key
```

---

# 318. Pagination Test

Deberá comprobar Boundaries.

---

# 319. Cursor Test

Deberá comprobar manipulación.

---

# 320. Filter Test

Deberá probar Allowlist.

---

# 321. Sort Test

También.

---

# 322. Conditional Request Test

Deberá comprobar:

```text
If-Match
If-None-Match
ETag
```

---

# 323. CORS Test

Deberá comprobar Origins autorizados y no autorizados.

---

# 324. Compatibility Test

Deberá comparar Contract con versión publicada anterior.

---

# 325. OpenAPI Test

Runtime y Specification deberán permanecer alineados.

---

# 326. Deprecated API Test

Deberá comprobar Headers/Metadata cuando aplique.

---

# 327. Payload Limit Test

Deberá comprobar rechazo temprano.

---

# 328. Timeout Test

Deberá comprobar Deadline y Cancellation.

---

# 329. Fault Injection

Podrá simular:

```text
database failure
dependency timeout
message broker failure
rate-limit store failure
client disconnect
```

---

# 330. Fuzz Testing

Podrá utilizarse para Parsers y Inputs complejos.

---

# 331. Security Testing

Deberá incluir:

```text
injection
authorization bypass
mass assignment
resource exhaustion
invalid content type
oversized input
```

---

# 332. Architecture Test

Podrá impedir:

```text
Controller → Database
Controller → ORM
API DTO → Domain Entity inheritance
Domain → HTTP
Domain → OpenAPI
```

---

# 333. Build Integration

ENG-012 podrá validar:

```text
duplicate route
duplicate operationId
invalid OpenAPI
missing authorization metadata
missing response contract
breaking API change
```

---

# 334. CLI

ENG-007 podrá proporcionar:

```text
mef api:list
mef api:routes
mef api:describe <endpoint>
mef api:openapi
mef api:validate
mef api:diff
mef api:deprecated
mef api:diagnose
```

---

# 335. API Diff

Deberá identificar:

```text
breaking
potentially-breaking
compatible
```

---

# 336. Configuration

ENG-011 podrá definir:

```text
api:
  prefix: /api
  versioning:
    strategy: uri
    default: v1

  request:
    max-body-size: 10MB
    timeout: 30s

  pagination:
    default-size: 25
    max-size: 100

  security:
    authentication-required: true

  rate-limit:
    enabled: true

  cors:
    enabled: true

  openapi:
    enabled: true
```

---

# 337. Configuration Validation

Deberá comprobar:

```text
valid prefix
valid version
bounded body size
positive timeout
bounded pagination
valid CORS policy
valid rate-limit policy
```

---

# 338. API Definition

Conceptualmente:

```text
ApiDefinition
├── id
├── version
├── exposure
├── endpoints
├── security
└── metadata
```

---

# 339. API Version

Conceptualmente:

```text
ApiVersion
├── value
├── status
├── introducedAt
├── deprecatedAt
└── sunsetAt
```

---

# 340. Endpoint Definition

Conceptualmente:

```text
EndpointDefinition
├── id
├── method
├── path
├── requestContract
├── responseContract
├── errorContract
├── authorization
├── rateLimit
├── idempotency
└── metadata
```

---

# 341. Request Contract

Conceptualmente:

```text
RequestContract
├── headers
├── path
├── query
├── body
└── limits
```

---

# 342. Response Contract

Conceptualmente:

```text
ResponseContract
├── statuses
├── headers
├── contentTypes
└── schemas
```

---

# 343. API Registry

ENG-020 podrá registrar:

```text
ApiDefinition
ApiVersion
EndpointDefinition
RequestContract
ResponseContract
ErrorContract
```

---

# 344. Bootstrap

ENG-027 deberá construir API Runtime.

---

# 345. Bootstrap Flow

```text
Load Configuration
       │
       ▼
Discover API Definitions
       │
       ▼
Discover Endpoints
       │
       ▼
Validate Routes
       │
       ▼
Validate Contracts
       │
       ▼
Validate Security
       │
       ▼
Validate Versioning
       │
       ▼
Build API Registry
       │
       ▼
Build Router
       │
       ▼
Generate/Validate OpenAPI
       │
       ▼
Readiness
```

---

# 346. Bootstrap Failure

Deberá impedir Readiness ante:

```text
duplicate route
ambiguous route
invalid contract
missing authorization policy
invalid version
invalid OpenAPI
```

cuando la Policy lo considere crítica.

---

# 347. Module Integration

Cada Module podrá declarar:

```text
api
endpoints
contracts
authorization
```

---

# 348. Module Isolation

Un Module no deberá modificar Routes de otro Module silenciosamente.

---

# 349. Route Override

Deberá requerir mecanismo explícito.

---

# 350. Endpoint Ownership

Todo Endpoint deberá poseer Module Owner.

---

# 351. Cross-Module Endpoint

Podrá orquestar Application Contracts públicos sin acceder a internals de otros Modules.

---

# 352. API Lifecycle

Estados conceptuales:

```text
DRAFT
EXPERIMENTAL
STABLE
DEPRECATED
SUNSET
REMOVED
```

---

# 353. Experimental API

No deberá recibir las mismas Compatibility Guarantees que STABLE.

---

# 354. Stable API

Deberá cumplir Support Policy.

---

# 355. Deprecated API

Continúa operativa durante Migration Window.

---

# 356. Sunset API

Se encuentra próxima a retiro.

---

# 357. Removed API

No deberá seguir registrada.

---

# 358. Lifecycle Transition

Deberá ser explícita.

---

# 359. Release Integration

ENG-017 deberá considerar API Compatibility antes de Release.

---

# 360. API Breaking Change

Deberá afectar Versioning según Compatibility Policy.

---

# 361. Changelog

Cambios públicos deberán documentarse.

---

# 362. Consumer Migration

Deprecation deberá incluir Guidance cuando sea posible.

---

# 363. Error Namespace

ENG-044 utilizará:

```text
MEF-API-xxx
```

---

# 364. Taxonomía ENG-044

```text
MEF-API-001 Invalid request
MEF-API-002 Unsupported media type
MEF-API-003 Unsupported representation
MEF-API-004 Validation failed
MEF-API-005 Authentication required
MEF-API-006 Authentication failed
MEF-API-007 Access denied
MEF-API-008 Resource not found
MEF-API-009 Method not allowed
MEF-API-010 Resource conflict
MEF-API-011 Precondition failed
MEF-API-012 Rate limit exceeded
MEF-API-013 Quota exceeded
MEF-API-014 Payload too large
MEF-API-015 Invalid pagination
MEF-API-016 Invalid cursor
MEF-API-017 Unsupported filter
MEF-API-018 Unsupported sort
MEF-API-019 Invalid field selection
MEF-API-020 Idempotency key conflict
MEF-API-021 Idempotency operation in progress
MEF-API-022 API version unsupported
MEF-API-023 API version deprecated
MEF-API-024 API contract violation
MEF-API-025 Request timeout
MEF-API-026 Dependency unavailable
MEF-API-027 Invalid CORS request
MEF-API-028 Unsafe API operation
MEF-API-029 API security violation
MEF-API-030 Internal API failure
```

---

# 365. Validation Example

```text
MEF-API-004

Request validation failed.

Endpoint:
orders.create

Field:
quantity

Code:
must_be_positive
```

---

# 366. Idempotency Example

```text
MEF-API-020

Idempotency key was previously used
with a different request.

Endpoint:
payments.create
```

---

# 367. Rate Limit Example

```text
MEF-API-012

API rate limit exceeded.

Endpoint:
search.execute

Retry-After:
10
```

---

# 368. Version Example

```text
MEF-API-022

Requested API version is not supported.

Requested:
v0

Supported:
v1
```

---

# 369. Contract Violation Example

```text
MEF-API-024

API response violated its published contract.

Endpoint:
orders.get
```

---

# 370. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
ApiDefinition
ApiId
ApiVersion
ApiExposure

EndpointDefinition
EndpointId
HttpMethod
Route

RequestContract
ResponseContract
ErrorContract

ApiRequest
ApiResponse

ApiError
ProblemDetails

PaginationContract
FilterContract
SortContract

IdempotencyKey
IdempotencyPolicy

RateLimitPolicy

ApiSecurityPolicy

ApiRegistry

OpenApiGenerator
OpenApiValidator
```

---

# 371. Optional Initial Components

Podrán incorporarse:

```text
ETag
ConditionalRequest
FieldSelection
Expansion
QuotaPolicy
DeprecationMetadata
ApiDiff
```

---

# 372. Later Components

Solo cuando exista necesidad:

```text
Webhook
Advanced Content Negotiation
GraphQL Adapter
gRPC API Adapter
API Federation
Developer Portal
Consumer Registry
Advanced Quota Billing
```

---

# 373. Conceptual Directory Structure

```text
src/
└── Api/
    ├── Contract/
    │   ├── ApiDefinition
    │   ├── RequestContract
    │   ├── ResponseContract
    │   └── ErrorContract
    │
    ├── Endpoint/
    │   ├── EndpointDefinition
    │   ├── EndpointId
    │   ├── Route
    │   └── HttpMethod
    │
    ├── Request/
    │   ├── ApiRequest
    │   └── RequestMapper
    │
    ├── Response/
    │   ├── ApiResponse
    │   └── ResponseMapper
    │
    ├── Error/
    │   ├── ApiError
    │   └── ProblemDetails
    │
    ├── Version/
    │   ├── ApiVersion
    │   └── DeprecationMetadata
    │
    ├── Pagination/
    │   └── PaginationContract
    │
    ├── Filtering/
    │   ├── FilterContract
    │   └── SortContract
    │
    ├── Idempotency/
    │   ├── IdempotencyKey
    │   └── IdempotencyPolicy
    │
    ├── Security/
    │   └── ApiSecurityPolicy
    │
    ├── RateLimit/
    │   └── RateLimitPolicy
    │
    ├── Registry/
    │   └── ApiRegistry
    │
    └── OpenApi/
        ├── OpenApiGenerator
        └── OpenApiValidator
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 374. First Implementation Constraints

La primera versión deberá favorecer:

```text
HTTP/JSON
REST-oriented APIs
Explicit API Contracts
Explicit Request/Response DTOs
URI Versioning
Stable Endpoint IDs
Problem Details
Strict Validation
Deny-by-default Security
Tenant Context
Bounded Pagination
Allowlisted Filtering
Allowlisted Sorting
Idempotency Keys
Rate Limiting
Request Limits
OpenAPI
Contract Testing
Compatibility Testing
Observability
```

---

# 375. First Version Non-Goals

No deberá requerir:

```text
GraphQL
gRPC
API Federation
Universal API Gateway
Developer Portal
Webhook Platform
Dynamic API Composition
Automatic API Monetization
Custom HTTP Server
Custom OpenAPI Standard
```

---

# 376. Second Phase

Podrá incorporar:

```text
Conditional Requests
ETag
Field Selection
Expansion
Advanced Quotas
Webhook Delivery
Advanced Deprecation Analytics
```

---

# 377. Third Phase

Solo cuando exista necesidad demostrada:

```text
GraphQL Adapter
gRPC Adapter
API Federation
Developer Portal
Consumer Registry
Advanced API Products
```

---

# 378. Invariantes de Ingeniería

ENG-044 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-826 | Toda API pública deberá constituir una Boundary contractual explícita, versionada, segura y observable. |
| EI-827 | Domain no deberá depender de HTTP, Routes, Status Codes, Headers, Serialization ni OpenAPI. |
| EI-828 | Request/Response Contracts públicos deberán permanecer separados de Domain Entities, Persistence Models y estructuras internas accidentales. |
| EI-829 | HTTP Methods y Status Codes deberán preservar semánticas protocolarias y no seleccionarse únicamente por conveniencia de implementación. |
| EI-830 | Toda API deberá poseer Error Contract machine-readable estable que no exponga Stack Traces, Secrets ni detalles internos sensibles. |
| EI-831 | Toda API estable deberá poseer estrategia explícita de Versioning, Compatibility y Deprecation. |
| EI-832 | Cambios Breaking deberán detectarse antes de Release y no deberán introducirse silenciosamente en una versión estable. |
| EI-833 | Pagination externa deberá ser acotada, determinística y consistente con las garantías definidas por Data Access. |
| EI-834 | Filtering, Sorting, Field Selection y Expansion deberán utilizar Contracts y Allowlists explícitos. |
| EI-835 | Authentication, Authorization y Tenant Resolution deberán ejecutarse mediante Context confiable y una API interna no deberá considerarse implícitamente segura. |
| EI-836 | APIs susceptibles de abuso deberán imponer límites de Rate, Quota, Payload, Query Complexity o Concurrency según riesgo. |
| EI-837 | Operaciones Retryable no naturalmente Idempotent deberán poseer mecanismo explícito de Idempotency antes de recomendar Retry automático. |
| EI-838 | Idempotency Key deberá estar Scoped por Consumer/Tenant/Operation y su reutilización con Payload incompatible deberá rechazarse. |
| EI-839 | Conditional Requests y ETags deberán preservar semántica de Cache/Concurrency y no utilizarse como Credentials. |
| EI-840 | CORS no deberá utilizarse como sustituto de Authentication, Authorization o CSRF Protection. |
| EI-841 | Toda HTTP API pública estable deberá poseer Specification verificable y deberá evitar Drift entre Runtime y OpenAPI. |
| EI-842 | Telemetry de API deberá utilizar identificadores lógicos de Cardinality acotada y no registrar indiscriminadamente Bodies, Credentials, PII ni Paths dinámicos. |
| EI-843 | Toda API deberá imponer Deadline y límites de Resource Consumption compatibles con Resilience y Performance Policies. |
| EI-844 | Contract, Security, Compatibility, Idempotency, Pagination, Rate Limit y Failure Modes deberán formar parte de API Testing. |
| EI-845 | La primera implementación deberá favorecer HTTP/JSON, Contracts explícitos, URI Versioning, Problem Details, OpenAPI, Idempotency, Security y Observability antes de introducir GraphQL, gRPC, Federation o una plataforma avanzada de API Management. |

---

# 379. Continuidad de Invariantes

```text
ENG-040 → EI-746 a EI-765
ENG-041 → EI-766 a EI-785
ENG-042 → EI-786 a EI-805
ENG-043 → EI-806 a EI-825
ENG-044 → EI-826 a EI-845
```

---

# 380. Criterios de Conformidad

Una implementación será conforme con ENG-044 cuando:

- modele API Boundary explícita;
- utilice Contracts públicos explícitos;
- separe Request/Response DTOs de Domain;
- utilice Endpoint IDs estables;
- respete HTTP Semantics;
- utilice Error Contract estable;
- proteja Error Details;
- implemente Versioning;
- detecte Breaking Changes;
- implemente Deprecation Lifecycle;
- limite Pagination;
- limite Filtering;
- limite Sorting;
- controle Field Selection;
- valide Input;
- aplique Authentication;
- aplique Authorization;
- preserve Tenant Isolation;
- soporte Rate Limiting;
- limite Payloads;
- modele Idempotency;
- controle Retry;
- soporte Conditional Requests cuando corresponda;
- configure CORS explícitamente;
- mantenga OpenAPI alineado;
- integre Observability;
- imponga Deadlines;
- pruebe Contract;
- pruebe Compatibility;
- pruebe Security;
- pruebe Failure Modes.

---

# 381. Riesgos

Deberán evitarse especialmente:

## Database as API

La estructura pública refleja directamente tablas.

## ORM Entity as Response

Campos internos se convierten accidentalmente en Contract.

## Domain Entity as Request

Input externo modifica directamente Domain State.

## Business Logic in Controller

La API se convierte en Application/Domain.

## HTTP in Domain

Business Logic queda acoplada al protocolo.

## Generic CRUD API

Toda Entity se expone automáticamente sin analizar Business Semantics.

## Unversioned Public API

No existe estrategia segura de evolución.

## Silent Breaking Change

Consumer falla después de un Release aparentemente compatible.

## String Error Contract

Consumers dependen de mensajes humanos.

## Stack Trace Response

Se expone información interna.

## Unlimited Pagination

Una Request consume Resources excesivos.

## Arbitrary Filtering

Consumer controla indirectamente Query Structure.

## Arbitrary Expansion

Produce Graph Explosion/N+1.

## Tenant from Header

Se confía en Tenant solicitado sin Authorization.

## CORS as Security

Se supone que CORS protege directamente el Backend.

## Retry POST Blindly

Se duplican operaciones.

## Idempotency without Payload Fingerprint

Una misma Key representa operaciones distintas.

## API Key in URL

Credentials aparecen en Logs, History o Proxies.

## OpenAPI Drift

Documentación y Runtime divergen.

## Dynamic Route Metrics

Se genera Cardinality ilimitada.

## Request Body Logging

Se filtran Secrets/PII.

## Gateway Authorization Only

Se omite Business Authorization en Application.

## Internal Means Trusted

APIs internas quedan sin controles.

## Long Synchronous Operation

La Request permanece abierta innecesariamente.

---

# 382. Relación con ENG-031

```text
ENG-031 Serialization
→ representation encoding

ENG-044 API
→ public representation contract
```

---

# 383. Relación con ENG-032

```text
ENG-032 Transport
→ request/response transport mechanics

ENG-044 API
→ consumer-facing semantics
```

---

# 384. Relación con ENG-033

ENG-033 deberá proporcionar protocolo/adapters utilizados por API Runtime sin definir Business Contract.

---

# 385. Relación con ENG-034

Application ejecutará Use Cases invocados desde API.

```text
API
 │
 ▼
Application
 │
 ▼
Domain
```

---

# 386. Relación con ENG-035

Domain permanecerá completamente independiente de API Representation.

---

# 387. Relación con ENG-036

Validation gobernará Request/Criteria Validation.

---

# 388. Relación con ENG-037

Caching gobernará Cache Storage/Policy interna.

API Engineering gobernará HTTP Cache Contract.

---

# 389. Relación con ENG-038

Concurrency podrá exponerse mediante:

```text
ETag
If-Match
version
409
412
```

---

# 390. Relación con ENG-039

Resilience gobernará:

```text
timeout
retry
backpressure
load shedding
circuit breaker
```

---

# 391. Relación con ENG-040

Operaciones largas podrán convertirse en:

```text
202 Accepted
+
Background Job
+
Operation Resource
```

---

# 392. Relación con ENG-041

Messaging permanecerá detrás de Application/API Boundary.

Una API no deberá exponer detalles internos del Broker.

---

# 393. Relación con ENG-042

Transactions no deberán abarcar arbitrariamente toda Request HTTP.

---

# 394. Relación con ENG-043

Data Access proporcionará:

```text
pagination
filters
sorting
projection
read consistency
```

sin exponer SQL/ORM a API.

---

# 395. Relación con ENG-024

Security gobernará:

```text
authentication
authorization
tenant isolation
secrets
threat model
audit
```

---

# 396. Relación con ENG-025

Observability gobernará:

```text
metrics
logs
traces
request correlation
SLIs
```

---

# 397. Relación con ENG-026

Performance gobernará:

```text
latency
throughput
payload size
compression
concurrency
```

---

# 398. Relación con ENG-016

Compatibility gobernará evolución segura de Contracts públicos.

---

# 399. Relación con ENG-017

Release Process deberá impedir Releases con Breaking Changes no autorizados.

---

# 400. Relación con ENG-045

ENG-045 deberá formalizar **Authentication Engineering**.

La separación será:

```text
API Engineering
→ public interface and security boundary

Authentication Engineering
→ establishment and verification of identity

Security Engineering
→ global security policies and threat model

Authorization
→ decision of what an authenticated principal may do
```

ENG-045 deberá cubrir:

```text
Principal
Identity
Credential
Authentication Context
Authentication Method
Password Authentication
Password Hashing
Credential Storage
API Keys
Bearer Tokens
Session Authentication
Token Validation
JWT
Opaque Tokens
Refresh Tokens
Token Rotation
Token Revocation
MFA
TOTP
WebAuthn
Recovery Codes
Brute Force Protection
Credential Stuffing
Account Lockout
Session Fixation
Authentication Events
Machine Identity
Service Accounts
Authentication Observability
Authentication Testing
```

---

# 401. Principio Rector

> **MEF deberá considerar cada API pública como un producto contractual de larga duración: la implementación puede cambiar, pero el Consumer deberá recibir semántica estable, seguridad explícita, evolución controlada y comportamiento observable.**

---

# 402. Conclusión

**ENG-044 — API Engineering** formaliza la Boundary pública mediante la cual Consumers interactúan con MEF.

La arquitectura queda:

```text
                     EXTERNAL CONSUMER
                             │
                             ▼
                       API BOUNDARY
                             │
        ┌────────────────────┼────────────────────┐
        │                    │                    │
        ▼                    ▼                    ▼
 AUTHENTICATION         RATE LIMIT           VERSIONING
        │                    │                    │
        └────────────────────┼────────────────────┘
                             │
                             ▼
                         ENDPOINT
                             │
                 ┌───────────┼───────────┐
                 │           │           │
                 ▼           ▼           ▼
             VALIDATION  AUTHORIZATION  CONTRACT
                 │           │           │
                 └───────────┼───────────┘
                             │
                             ▼
                       APPLICATION
                             │
                             ▼
                          DOMAIN
```

El ciclo Request queda:

```text
HTTP Request
     │
     ▼
Routing
     │
     ▼
Authentication
     │
     ▼
Rate Limit
     │
     ▼
Validation
     │
     ▼
Authorization
     │
     ▼
Request Mapping
     │
     ▼
Application Use Case
     │
     ▼
Response Mapping
     │
     ▼
API Contract
     │
     ▼
HTTP Response
```

La evolución queda:

```text
DRAFT
  │
  ▼
EXPERIMENTAL
  │
  ▼
STABLE
  │
  ▼
DEPRECATED
  │
  ▼
SUNSET
  │
  ▼
REMOVED
```

La separación conceptual queda:

```text
API
→ consumer-facing interface

API Contract
→ externally observable behavior

Endpoint
→ addressable API operation

Request DTO
→ public input representation

Response DTO
→ public output representation

Problem Details
→ stable machine-readable error

Version
→ evolution boundary

Deprecation
→ controlled retirement process

Idempotency
→ duplicate execution protection

Rate Limit
→ request velocity control

Quota
→ consumption allowance

ETag
→ representation/concurrency validator

OpenAPI
→ machine-readable API specification
```

La primera implementación deberá concentrarse en:

```text
ApiDefinition
ApiId
ApiVersion
ApiExposure

EndpointDefinition
EndpointId
HttpMethod
Route

RequestContract
ResponseContract
ErrorContract

ApiRequest
ApiResponse

ApiError
ProblemDetails

PaginationContract
FilterContract
SortContract

IdempotencyKey
IdempotencyPolicy

RateLimitPolicy
ApiSecurityPolicy

ApiRegistry

OpenApiGenerator
OpenApiValidator
```

con:

```text
HTTP/JSON
Explicit Contracts
Explicit DTOs
URI Versioning
Stable Endpoint IDs
HTTP Semantics
Problem Details
Strict Validation
Deny by Default
Tenant Isolation
Bounded Pagination
Allowlisted Filtering
Allowlisted Sorting
Idempotency
Rate Limiting
Payload Limits
OpenAPI
Contract Tests
Compatibility Tests
Observability
```

antes de introducir:

```text
GraphQL
gRPC
API Federation
Developer Portal
Webhook Platform
Dynamic API Composition
Advanced API Management
```

Con **ENG-044** la serie global alcanza:

```text
EI-845
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
- ENG-017 — Release Process
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-026 — Performance Engineering
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-033
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-040 — Scheduling & Background Jobs Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-045 — Authentication Engineering
```