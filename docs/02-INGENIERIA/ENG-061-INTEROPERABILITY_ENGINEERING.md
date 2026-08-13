---
id: ENG-061
titulo: Interoperability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Interoperability Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-034
  - ENG-036
  - ENG-039
  - ENG-041
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-049
  - ENG-056
  - ENG-057
  - ENG-058
  - ENG-059
  - ENG-060
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-030
  - ENG-035
  - ENG-037
  - ENG-038
  - ENG-040
  - ENG-042
  - ENG-043
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-062
keywords:
  - interoperability
  - integration
  - adapter
  - bridge
  - gateway
  - facade
  - translator
  - external-system
  - external-runtime
  - protocol-compatibility
  - format-compatibility
  - semantic-compatibility
  - canonical-model
  - model-mapping
  - transformation
  - version-negotiation
  - capability-negotiation
  - interoperability-profile
  - error-mapping
  - identity-mapping
  - mef
---

# ENG-061

# Interoperability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Interoperability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-061 establece las reglas para:

```text
Interoperability
Interoperability Boundary
Interoperability Contract
Interoperability Profile

External System
External Runtime
External Protocol
External Format

Adapter
Bridge
Gateway
Facade
Translator

Canonical Model
External Model
Model Mapping
Transformation

Protocol Compatibility
Format Compatibility
Semantic Compatibility

Version Negotiation
Capability Negotiation

Encoding
Character Set
Locale
Timezone
Units

Boundary Validation
Boundary Normalization
Boundary Sanitization

External Error Mapping
External Identity Mapping

Interoperability Security
Interoperability Resilience
Interoperability Audit
Interoperability Observability
Interoperability Testing
```

---

# 2. Declaración

> **Toda interoperabilidad de MEF con sistemas externos deberá atravesar Boundaries explícitos y Contracts versionados; los modelos externos deberán validarse, normalizarse y transformarse antes de ingresar al Core; y ninguna diferencia de protocolo, formato, identidad, tiempo, unidades, errores o semántica deberá resolverse mediante supuestos implícitos o dependencias directas del Domain sobre representaciones externas.**

Arquitectura conceptual:

```text
             EXTERNAL SYSTEM
                    │
                    ▼
          INTEROPERABILITY BOUNDARY
                    │
                    ▼
               ADAPTER / GATEWAY
                    │
                    ▼
              VALIDATE / NORMALIZE
                    │
                    ▼
                 TRANSLATE
                    │
                    ▼
              CANONICAL MODEL
                    │
                    ▼
                  MEF CORE
```

---

# 3. Interoperability Engineering

Interoperability responde:

```text
How does MEF communicate with an external system?
Which protocol is supported?
Which format is exchanged?
Which version applies?
What semantics does a field have?
How is an external model translated?
How are errors mapped?
How are identities mapped?
Which capabilities are supported?
How are incompatibilities detected?
How is external behavior isolated?
```

---

# 4. Interoperability

`Interoperability` es la capacidad de MEF de intercambiar información o comportamiento con sistemas externos preservando significado, límites y Contracts.

---

# 5. Interoperability ≠ Integration

`Integration` es el caso concreto de conexión.

`Interoperability` define las reglas generales que permiten que esa conexión sea predecible.

---

# 6. Interoperability ≠ Transport

ENG-032 gobierna cómo se transportan datos.

ENG-061 gobierna cómo se entienden entre sistemas.

---

# 7. Interoperability ≠ Serialization

ENG-031 convierte estructuras a representación externa.

ENG-061 define compatibilidad y traducción semántica.

---

# 8. Interoperability ≠ API

ENG-044 define APIs.

ENG-061 gobierna cómo APIs propias o externas se relacionan semánticamente.

---

# 9. Interoperability ≠ Domain

El Domain no deberá depender directamente de:

```text
external API DTOs
vendor SDK models
protocol-specific structures
external error codes
external identity formats
```

---

# 10. Interoperability Boundary

Todo sistema externo deberá cruzar una Boundary explícita.

Ejemplos:

```text
HTTP API
Message Broker
Database Interface
File Exchange
CLI Process
SDK
External Runtime
RPC
Webhook
```

---

# 11. Boundary Ownership

Cada Boundary deberá poseer Owner conocido.

---

# 12. Boundary Contract

Deberá definir:

```text
protocol
format
version
authentication
semantics
timeouts
error model
compatibility
```

---

# 13. External System

Un sistema cuya autoridad operacional se encuentra fuera del Core de MEF.

Ejemplos:

```text
payment provider
identity provider
ERP
CRM
message broker
external database
government API
cloud service
legacy system
```

---

# 14. External Runtime

Un entorno de ejecución diferente al Runtime principal de MEF.

Ejemplos:

```text
JVM
.NET
Node.js
Python runtime
browser
mobile runtime
remote worker
```

---

# 15. External Protocol

Ejemplos:

```text
HTTP
HTTPS
REST
SOAP
GraphQL
gRPC
AMQP
MQTT
WebSocket
SFTP
SMTP
```

---

# 16. Protocol Support

Toda implementación deberá declarar protocolos soportados explícitamente.

---

# 17. Protocol Version

Deberá poder formar parte del Contract.

---

# 18. Protocol Negotiation

Cuando exista deberá ser explícita.

---

# 19. External Format

Ejemplos:

```text
JSON
XML
CSV
YAML
Protocol Buffers
Avro
EDI
fixed-width
multipart
```

---

# 20. Format Version

Deberá poder versionarse independientemente del protocolo.

---

# 21. Adapter

Traduce una Interface externa a una Interface esperada por MEF.

```text
External API
    │
    ▼
 Adapter
    │
    ▼
MEF Contract
```

---

# 22. Bridge

Conecta dos abstracciones que pueden evolucionar independientemente.

---

# 23. Gateway

Encapsula acceso a un sistema externo.

---

# 24. Facade

Proporciona Interface simplificada sobre uno o más servicios externos.

---

# 25. Translator

Convierte representaciones o semánticas.

---

# 26. Adapter ≠ Gateway

Un Gateway gobierna acceso externo.

Un Adapter puede traducir Interfaces.

Pueden coexistir.

---

# 27. Anti-Corruption Layer

Integraciones complejas deberán considerar una capa que proteja el Domain de modelos externos.

---

# 28. Canonical Model

Representa una estructura neutral utilizada dentro del Boundary de interoperabilidad.

---

# 29. Canonical Model ≠ Universal Domain Model

No deberá intentarse construir un modelo universal para todos los sistemas.

---

# 30. Canonical Scope

Deberá limitarse a Boundary o Integration Domain conocido.

---

# 31. External Model

Representa estructura controlada por otro sistema.

---

# 32. External Model Ownership

MEF no deberá asumir autoridad sobre su evolución.

---

# 33. Model Mapping

Define correspondencia entre External y Canonical/Internal Model.

Conceptualmente:

```text
ExternalCustomer
      │
      ▼
   Mapping
      │
      ▼
CanonicalCustomer
```

---

# 34. Mapping Contract

Deberá documentar:

```text
source field
target field
type
conversion
default
required
lossiness
```

---

# 35. Bidirectional Mapping

Deberá definir direcciones por separado cuando la transformación no sea simétrica.

---

# 36. Lossy Mapping

Deberá identificarse explícitamente.

---

# 37. Round-Trip Guarantee

No deberá asumirse salvo Contract explícito.

---

# 38. Transformation

Puede incluir:

```text
rename
type conversion
aggregation
splitting
normalization
unit conversion
timezone conversion
code mapping
```

---

# 39. Transformation Determinism

Mismo Input y misma Mapping Version deberán producir mismo Output.

---

# 40. Transformation Side Effects

Deberán evitarse.

---

# 41. Protocol Compatibility

Indica si dos extremos pueden comunicarse a nivel de protocolo.

---

# 42. Format Compatibility

Indica si pueden intercambiar y parsear representación.

---

# 43. Semantic Compatibility

Indica si ambos extremos interpretan la información de forma equivalente.

---

# 44. Semantic Compatibility Priority

Deberá considerarse más allá de validar sintaxis.

Ejemplo:

```text
"status": "closed"
```

puede tener significado diferente entre dos sistemas.

---

# 45. Syntactic Compatibility ≠ Semantic Compatibility

Poder parsear un mensaje no implica comprenderlo correctamente.

---

# 46. Compatibility Matrix

Podrá documentarse:

```text
MEF Version
External Version
Protocol Version
Schema Version
Supported
Limitations
```

---

# 47. Version Negotiation

Permite seleccionar versión compatible.

---

# 48. Negotiation Inputs

Podrán incluir:

```text
protocol version
schema version
API version
capabilities
features
```

---

# 49. Negotiation Failure

Deberá ser explícito.

---

# 50. Silent Version Downgrade

No deberá ocurrir cuando pueda afectar Security o Semantics.

---

# 51. Capability Negotiation

Permite determinar funcionalidades soportadas por ambas partes.

---

# 52. Capability Set

Ejemplo:

```text
compression
streaming
pagination
batching
encryption
idempotency
partial update
```

---

# 53. Capability Intersection

Podrá calcularse:

```text
effectiveCapabilities =
localCapabilities ∩ remoteCapabilities
```

---

# 54. Required Capability

Si no existe deberá fallar Negotiation.

---

# 55. Optional Capability

Podrá producir Degraded Mode conocido.

---

# 56. Interoperability Profile

Agrupa reglas para un sistema o ecosistema.

Conceptualmente:

```text
InteroperabilityProfile
├── id
├── protocol
├── format
├── versions
├── capabilities
├── mappings
├── errorModel
└── security
```

---

# 57. Profile Version

Deberá versionarse.

---

# 58. Profile Ownership

Deberá poseer Owner.

---

# 59. Profile Discovery

Podrá utilizar ENG-058.

---

# 60. Profile Resolution

Podrá utilizar ENG-059.

---

# 61. Boundary Validation

Todo Input externo deberá validarse antes de ingresar al Core.

---

# 62. Validation Layers

Podrán incluir:

```text
transport
syntax
schema
type
constraints
semantic
identity
security
```

---

# 63. Boundary Normalization

Convierte Input válido a forma canónica.

---

# 64. Normalization Examples

```text
Unicode normalization
case normalization
phone normalization
URI normalization
date normalization
code normalization
```

---

# 65. Boundary Sanitization

Elimina o neutraliza información no permitida.

---

# 66. Unknown Field

Deberá seguir Compatibility Policy.

---

# 67. Unknown Enum Value

Deberá producir comportamiento definido.

---

# 68. Defaulting

No deberá ocultar datos críticos faltantes.

---

# 69. Encoding

Toda Boundary textual deberá definir Encoding.

---

# 70. UTF-8

Deberá favorecerse cuando el protocolo lo permita.

---

# 71. Character Set Mismatch

Deberá detectarse o normalizarse explícitamente.

---

# 72. Unicode Normalization

Deberá considerarse en identificadores sensibles y comparaciones.

---

# 73. Locale

No deberá inferirse ciegamente de representación textual.

---

# 74. Locale-Sensitive Parsing

Deberá utilizar Locale explícito.

---

# 75. Decimal Parsing

Ejemplo:

```text
1,234
```

no deberá interpretarse sin contexto cuando exista ambigüedad.

---

# 76. Timezone

Todo instante absoluto deberá poseer Offset o zona conocida.

---

# 77. UTC Internal Representation

Podrá favorecerse para instantes absolutos.

---

# 78. Local Date

No deberá convertirse automáticamente a UTC si semánticamente no representa instante.

---

# 79. Daylight Saving

Deberá considerarse cuando exista Timezone regional.

---

# 80. Units

Valores físicos deberán declarar unidades.

Ejemplos:

```text
kg
g
meters
feet
ms
seconds
bytes
MiB
```

---

# 81. Unit Conversion

Deberá ser explícita y testeada.

---

# 82. Currency

Deberá incluir Currency Code.

---

# 83. Money

No deberá representarse únicamente como Float sin semántica monetaria.

---

# 84. Identifier Mapping

IDs externos e internos deberán permanecer separados.

---

# 85. External Identifier

Deberá conservar Namespace o System of Origin.

Ejemplo:

```text
salesforce:account:123
sap:customer:987
```

---

# 86. Identity Mapping

ENG-047 gobernará Identity interna.

ENG-061 podrá mapear Identity externa.

---

# 87. Identity Link

Deberá ser explícito.

---

# 88. Identity Collision

Dos External Identities no deberán fusionarse por igualdad textual únicamente.

---

# 89. Tenant Mapping

Deberá seguir ENG-048.

---

# 90. External Tenant Identifier

No deberá convertirse en Tenant interno sin Resolution confiable.

---

# 91. External Error Model

Cada sistema externo podrá poseer Errors propios.

---

# 92. Error Mapping

Deberá traducirse a modelo interno controlado.

Ejemplo:

```text
HTTP 429
VendorCode RATE_LIMITED
        │
        ▼
ExternalRateLimited
        │
        ▼
MEF Resilience
```

---

# 93. External Error Preservation

Información necesaria para Diagnostics podrá conservarse sin filtrar detalles sensibles.

---

# 94. Error Code Collision

Códigos externos no deberán ocupar Namespace interno de MEF.

---

# 95. Retry Classification

Deberá derivarse de Error Mapping y ENG-039.

---

# 96. External Success ≠ Business Success

Un `200 OK` no implica necesariamente operación semánticamente exitosa.

---

# 97. Partial Success

Deberá modelarse cuando el sistema externo lo soporte.

---

# 98. External State

No deberá copiarse indiscriminadamente al Domain.

---

# 99. External Source of Truth

Deberá declararse cuando el sistema externo sea Authority de cierto dato.

---

# 100. Synchronization

Deberá seguir Ownership y Authority explícitos.

---

# 101. Polling

Podrá utilizarse como Integration Strategy.

---

# 102. Event-Driven Synchronization

Podrá utilizar ENG-041.

---

# 103. Reconciliation

Deberá utilizar ENG-053 cuando existan representaciones divergentes.

---

# 104. Idempotency

Operaciones externas retryables deberán considerar Idempotency.

---

# 105. Idempotency Key Mapping

Deberá respetar Scope del sistema remoto.

---

# 106. Duplicate External Request

No deberá producir Side Effects duplicados cuando el protocolo soporte Idempotency.

---

# 107. Webhook Interoperability

Deberá considerar:

```text
signature
replay protection
event identity
ordering
duplication
schema version
retry
```

---

# 108. Callback Correlation

Deberá poder correlacionar Response o Event con operación original.

---

# 109. External Ordering

No deberá asumirse orden total salvo garantía contractual.

---

# 110. External Duplication

Handlers deberán tolerarla cuando el protocolo sea At-Least-Once.

---

# 111. External Timeout

Deberá poseer Deadline o Timeout explícito.

---

# 112. Timeout ≠ Cancellation

No garantiza que el sistema externo haya detenido procesamiento.

---

# 113. Unknown Outcome

Deberá modelarse.

Ejemplo:

```text
Request sent
    │
    ▼
Timeout
    │
    ▼
Did remote execute?
UNKNOWN
```

---

# 114. Unknown Outcome Strategy

Podrá incluir:

```text
status query
reconciliation
idempotent retry
manual review
compensation
```

---

# 115. External Concurrency

Deberá respetar Constraints del proveedor.

---

# 116. Rate Limits

Deberán modelarse mediante ENG-054 y ENG-039.

---

# 117. Quotas

Deberán modelarse explícitamente.

---

# 118. Backpressure

Deberá aplicarse cuando el sistema externo no pueda aceptar carga.

---

# 119. Batch Interoperability

Deberá definir:

```text
batch size
partial failure
ordering
retry
idempotency
```

---

# 120. Pagination

Deberá encapsularse para evitar contaminar Domain.

---

# 121. Cursor Semantics

No deberán asumirse estables fuera del Contract externo.

---

# 122. Streaming

Deberá declarar:

```text
framing
ordering
backpressure
termination
error semantics
```

---

# 123. File Exchange

Deberá definir:

```text
filename rules
encoding
format
schema
integrity
atomic delivery
archive
reprocessing
```

---

# 124. Partial File

No deberá procesarse como completo.

---

# 125. Atomic File Publication

Podrá utilizar:

```text
temporary file
rename
manifest
done marker
```

---

# 126. External SDK

Deberá encapsularse detrás de Adapter o Gateway.

---

# 127. Vendor SDK Leakage

Tipos del SDK no deberán propagarse al Domain.

---

# 128. Vendor Lock-In Boundary

Deberá localizarse en Infrastructure/Interoperability Layer.

---

# 129. Interoperability Security

ENG-024 gobernará Security general.

---

# 130. External Boundary Trust

Toda Boundary externa deberá considerarse Trust Boundary.

---

# 131. External Input

Deberá considerarse no confiable inicialmente.

---

# 132. Authentication

Deberá seguir ENG-045.

---

# 133. Authorization

Deberá seguir ENG-046.

---

# 134. Identity Federation

Deberá seguir ENG-047.

---

# 135. Encryption

Deberá utilizarse cuando el Threat Model lo requiera.

---

# 136. Certificate Validation

No deberá deshabilitarse para resolver problemas de interoperabilidad.

---

# 137. Security Downgrade

Negotiation no deberá seleccionar protocolo o algoritmo inseguro silenciosamente.

---

# 138. SSRF

Gateways HTTP deberán controlar destinos cuando Input externo pueda influir en URL.

---

# 139. XML Security

Parsers XML deberán deshabilitar comportamientos inseguros cuando corresponda.

---

# 140. Deserialization Security

Deberá seguir ENG-031 y ENG-024.

---

# 141. External Secrets

Credentials deberán obtenerse desde mecanismo seguro.

---

# 142. Secret Rotation

No deberá requerir recompilar Adapters cuando Configuration soporte Rotation.

---

# 143. Interoperability Resilience

ENG-039 gobernará:

```text
timeouts
retry
backoff
circuit breaker
bulkhead
fallback
```

---

# 144. Fallback

No deberá alterar semántica contractual silenciosamente.

---

# 145. Circuit Boundary

Circuit Breaker deberá aplicarse en Boundary apropiada.

---

# 146. Bulkhead

Integraciones críticas podrán aislar recursos.

---

# 147. Dependency Failure

No deberá convertirse automáticamente en Failure global si el Contract permite Degraded Mode.

---

# 148. Interoperability Context

ENG-056 deberá propagar:

```text
correlation
trace
tenant
deadline
cancellation
```

según Boundary Policy.

---

# 149. External Context

No deberá confiarse automáticamente.

---

# 150. Correlation Mapping

Podrá mapear identificadores internos a headers o fields externos.

---

# 151. Trace Propagation

Deberá seguir estándares compatibles cuando correspondan.

---

# 152. External Metadata

ENG-057 podrá describir:

```text
protocol
version
capabilities
schema
provider
limitations
```

---

# 153. Discovery Integration

ENG-058 podrá descubrir Adapters o Profiles.

---

# 154. Resolution Integration

ENG-059 podrá seleccionar Adapter compatible.

---

# 155. Plugin Integration

ENG-060 podrá proporcionar Adapters como Extensions.

---

# 156. Interoperability Registry

ENG-020 podrá registrar:

```text
InteroperabilityProfile
Adapter
Translator
Mapping
ProtocolDescriptor
FormatDescriptor
```

---

# 157. Runtime Selection

No deberá cambiar de Adapter arbitrariamente durante una operación crítica.

---

# 158. Interoperability Versioning

Deberá seguir ENG-014 y ENG-016.

---

# 159. Mapping Version

Mappings deberán poder versionarse.

---

# 160. Mapping Change

Podrá ser Breaking incluso si Schema externo no cambió.

---

# 161. Semantic Versioning of Mapping

Podrá utilizarse cuando sea útil.

---

# 162. Compatibility Testing

Deberá utilizar Fixtures y Contract Tests.

---

# 163. Golden Samples

Podrán conservar ejemplos conocidos de intercambio.

---

# 164. Consumer-Driven Contract

Podrá utilizarse cuando la Integration Architecture lo justifique.

---

# 165. Provider Sandbox

Ambientes externos de prueba deberán diferenciarse de Production.

---

# 166. Environment Mixing

Credentials o endpoints de Test no deberán mezclarse con Production.

---

# 167. Interoperability Audit

Operaciones sensibles podrán auditarse.

---

# 168. Audit Record

Podrá contener:

```text
externalSystem
profile
operation
version
result
actor
correlation
timestamp
```

---

# 169. Audit Payload

No deberá copiar Payload completo por Default.

---

# 170. Sensitive External Data

Deberá redactarse.

---

# 171. Interoperability Observability

ENG-025 gobernará Telemetry.

---

# 172. Metrics

Podrán incluir:

```text
mef.interop.request.total
mef.interop.request.duration
mef.interop.failure.total
mef.interop.timeout.total
mef.interop.retry.total
mef.interop.mapping.failure.total
mef.interop.negotiation.failure.total
mef.interop.unknown_outcome.total
```

---

# 173. Metric Labels

Podrán incluir:

```text
profile
operation
protocol
result
failureType
```

cuando cardinalidad esté controlada.

---

# 174. External Identifier as Label

No deberá utilizarse indiscriminadamente.

---

# 175. Logging

Podrá incluir:

```text
externalSystem
operation
profileVersion
protocol
duration
result
correlationId
```

---

# 176. Payload Logging

Deberá estar deshabilitado por Default para datos sensibles.

---

# 177. Interoperability Diagnostics

Deberá poder responder:

```text
which profile?
which adapter?
which protocol?
which schema version?
which mapping?
which capability negotiation?
which external error?
which internal error?
was fallback used?
was outcome unknown?
```

---

# 178. Health

La disponibilidad externa no deberá confundirse con Liveness del Runtime.

---

# 179. Readiness

Una dependencia externa crítica podrá afectar Readiness según Contract.

---

# 180. Optional Dependency

No deberá afectar Readiness global automáticamente.

---

# 181. Testing

ENG-009 gobernará Testing.

---

# 182. Adapter Test

Deberá comprobar traducción correcta.

---

# 183. Mapping Test

Deberá cubrir todos los Fields críticos.

---

# 184. Lossy Mapping Test

Deberá documentar pérdida esperada.

---

# 185. Round-Trip Test

Solo cuando Contract prometa Round-Trip.

---

# 186. Protocol Test

Deberá probar versiones soportadas.

---

# 187. Format Test

Deberá probar Encoding y Schema.

---

# 188. Semantic Test

Deberá validar significado, no solo parseo.

---

# 189. Version Negotiation Test

Deberá cubrir:

```text
exact
compatible
unsupported
downgrade forbidden
```

---

# 190. Capability Negotiation Test

Deberá cubrir Required y Optional Capabilities.

---

# 191. Locale Test

Deberá probar diferentes Formats.

---

# 192. Timezone Test

Deberá cubrir DST y Offset.

---

# 193. Unit Test

Deberá comprobar conversiones.

---

# 194. Currency Test

Deberá comprobar Currency Code y precisión.

---

# 195. Error Mapping Test

Deberá probar códigos externos conocidos y desconocidos.

---

# 196. Timeout Test

Deberá modelar Unknown Outcome.

---

# 197. Retry Test

Deberá comprobar Idempotency.

---

# 198. Duplicate Test

Deberá simular Message/Webhook duplicado.

---

# 199. Ordering Test

Deberá comprobar que no se asuma orden no garantizado.

---

# 200. Partial Success Test

Deberá comprobar semántica de Batch.

---

# 201. Security Test

Deberá intentar:

```text
malformed payload
schema bypass
identity spoofing
tenant spoofing
SSRF
certificate bypass
unsafe deserialization
XML entity attack
protocol downgrade
replay
```

---

# 202. Resilience Test

Deberá simular:

```text
timeout
rate limit
remote outage
partial response
connection reset
slow response
```

---

# 203. Compatibility Test

Deberá ejecutarse contra versiones soportadas.

---

# 204. Contract Test

Deberá poder ejecutarse independientemente del Domain.

---

# 205. Architecture Test

Podrá impedir:

```text
vendor SDK types in Domain
external DTOs in Domain
direct external API calls from Domain
unversioned mapping
silent protocol downgrade
external errors leaking directly
```

---

# 206. Build Integration

ENG-012 podrá validar:

```text
missing adapter
duplicate profile
invalid mapping
unsupported profile version
unknown protocol
unknown format
unversioned mapping
incompatible capability requirement
```

---

# 207. CLI

ENG-007 podrá proporcionar:

```text
mef interop:list
mef interop:show
mef interop:validate
mef interop:test
mef interop:negotiate
mef interop:mapping
mef interop:diagnose
```

---

# 208. `interop:list`

Podrá mostrar Profiles registrados.

---

# 209. `interop:show`

Podrá mostrar:

```text
system
protocol
format
versions
capabilities
mapping
security
```

---

# 210. `interop:validate`

Deberá validar Profile y Mapping.

---

# 211. `interop:test`

Podrá ejecutar Contract Test controlado.

---

# 212. `interop:negotiate`

Podrá simular Version/Capability Negotiation.

---

# 213. `interop:mapping`

Podrá explicar transformación de Fields.

---

# 214. `interop:diagnose`

Podrá mostrar:

```text
profile
adapter
protocol
format
versions
capabilities
mapping
last failure
external health
```

---

# 215. Registry Integration

ENG-020 podrá registrar:

```text
InteroperabilityProfile
InteroperabilityAdapter
InteroperabilityGateway
InteroperabilityTranslator
ModelMapping
ProtocolDescriptor
FormatDescriptor
```

---

# 216. Interoperability Profile Contract

Conceptualmente:

```text
InteroperabilityProfile
├── id
├── owner
├── externalSystem
├── protocol
├── format
├── versions
├── capabilities
├── mappings
├── security
└── errorModel
```

---

# 217. Adapter Contract

Conceptualmente:

```text
InteroperabilityAdapter
├── supports
├── encode
├── decode
├── translate
├── normalize
└── validate
```

---

# 218. Gateway Contract

Conceptualmente:

```text
ExternalGateway
├── execute
├── health
├── capabilities
└── diagnose
```

---

# 219. Mapping Contract

Conceptualmente:

```text
ModelMapping
├── sourceModel
├── targetModel
├── version
├── fields
├── transformations
└── lossiness
```

---

# 220. Negotiation Result

Conceptualmente:

```text
NegotiationResult
├── version
├── capabilities
├── degraded
├── rejectedCapabilities
└── reason
```

---

# 221. Bootstrap

ENG-027 deberá validar Interoperability Profiles críticos antes de Readiness.

---

# 222. Bootstrap Flow

```text
Configuration
      │
      ▼
Interop Profiles
      │
      ▼
Protocol / Format Validation
      │
      ▼
Adapter Discovery
      │
      ▼
Adapter Resolution
      │
      ▼
Compatibility Validation
      │
      ▼
Mapping Validation
      │
      ▼
Security Validation
      │
      ▼
Gateway Construction
      │
      ▼
Runtime Ready
```

---

# 223. Bootstrap Failure

Podrá impedir Readiness ante:

```text
missing critical adapter
invalid critical mapping
unsupported required protocol
incompatible required version
security configuration invalid
critical external dependency unavailable
```

---

# 224. External Dependency Criticality

Deberá declarar:

```text
CRITICAL
REQUIRED
OPTIONAL
```

---

# 225. Criticality Semantics

Deberá integrarse con ENG-055.

---

# 226. Shutdown

Gateways deberán liberar Resources conforme ENG-054.

---

# 227. Active Request Drain

Deberá integrarse con Lifecycle.

---

# 228. First Implementation Components

La primera implementación deberá incluir:

```text
InteroperabilityProfile
InteroperabilityBoundary

ProtocolDescriptor
FormatDescriptor

InteroperabilityAdapter
ExternalGateway
InteroperabilityTranslator

CanonicalModel
ModelMapping

CompatibilityProfile
CapabilitySet
NegotiationResult

ExternalErrorMapper

InteroperabilityError
```

---

# 229. Optional Initial Components

Podrán incorporarse:

```text
IdentityMapper
UnitConverter
InteroperabilityDiagnostics
ContractTestSuite
ProfileRegistry
```

---

# 230. Later Components

Solo cuando exista necesidad demostrada:

```text
DynamicProtocolNegotiation
FederatedInteroperabilityRegistry
Cross-RegionInteroperability
AutomaticMappingGeneration
SchemaInference
AI-AssistedMapping
```

---

# 231. Estructura Conceptual de Directorios

```text
src/
└── Interoperability/
    ├── Profile/
    │   └── InteroperabilityProfile
    │
    ├── Boundary/
    │   └── InteroperabilityBoundary
    │
    ├── Protocol/
    │   └── ProtocolDescriptor
    │
    ├── Format/
    │   └── FormatDescriptor
    │
    ├── Adapter/
    │   └── InteroperabilityAdapter
    │
    ├── Gateway/
    │   └── ExternalGateway
    │
    ├── Translation/
    │   ├── InteroperabilityTranslator
    │   ├── CanonicalModel
    │   └── ModelMapping
    │
    ├── Compatibility/
    │   ├── CompatibilityProfile
    │   ├── CapabilitySet
    │   └── NegotiationResult
    │
    ├── Identity/
    │   └── IdentityMapper
    │
    ├── Error/
    │   ├── ExternalErrorMapper
    │   └── InteroperabilityError
    │
    ├── Diagnostics/
    │   └── InteroperabilityDiagnostics
    │
    └── Testing/
        └── ContractTestSuite
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 232. Error Namespace

ENG-061 utilizará:

```text
MEF-INTEROP-xxx
```

---

# 233. Taxonomía ENG-061

```text
MEF-INTEROP-001 Interoperability profile invalid
MEF-INTEROP-002 Interoperability profile duplicate
MEF-INTEROP-003 External system unsupported
MEF-INTEROP-004 Protocol unsupported
MEF-INTEROP-005 Protocol version unsupported
MEF-INTEROP-006 Format unsupported
MEF-INTEROP-007 Format version unsupported
MEF-INTEROP-008 Adapter not found
MEF-INTEROP-009 Adapter incompatible
MEF-INTEROP-010 Mapping invalid
MEF-INTEROP-011 Mapping failed
MEF-INTEROP-012 Mapping lossy
MEF-INTEROP-013 Semantic incompatibility
MEF-INTEROP-014 Version negotiation failed
MEF-INTEROP-015 Capability negotiation failed
MEF-INTEROP-016 Encoding invalid
MEF-INTEROP-017 Locale conversion failed
MEF-INTEROP-018 Timezone conversion failed
MEF-INTEROP-019 Unit conversion failed
MEF-INTEROP-020 Identity mapping failed
MEF-INTEROP-021 External error unmapped
MEF-INTEROP-022 External timeout
MEF-INTEROP-023 External outcome unknown
MEF-INTEROP-024 External rate limited
MEF-INTEROP-025 External dependency unavailable
MEF-INTEROP-026 External response invalid
MEF-INTEROP-027 Tenant mapping violation
MEF-INTEROP-028 Interoperability security violation
MEF-INTEROP-029 Interoperability compatibility violation
MEF-INTEROP-030 Interoperability invariant violation
```

---

# 234. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Boundaries
Versioned Profiles
Adapters
Gateways
Canonical Boundary Models
Explicit Mappings

Protocol Compatibility
Format Compatibility
Semantic Compatibility

Version Negotiation
Capability Negotiation

Boundary Validation
Normalization
Error Mapping

Encoding
Timezone
Units
Identity Mapping

Timeouts
Idempotency
Resilience
Security
Diagnostics
Contract Testing
```

---

# 235. First Version Non-Goals

No deberá requerir:

```text
Dynamic Protocol Discovery
Federated Interoperability Registry
Automatic Schema Inference
Automatic Mapping Generation
Cross-Region Interoperability Mesh
AI-Generated Mappings
```

---

# 236. Second Phase

Podrá incorporar:

```text
Advanced Capability Negotiation
External Contract Testing
Mapping Migration
Profile Simulation
Advanced Identity Mapping
Interoperability Catalog
```

---

# 237. Third Phase

Solo cuando exista necesidad demostrada:

```text
Federated Interoperability
Dynamic Protocol Negotiation
Automatic Mapping
Schema Inference
Cross-Region Profiles
AI-Assisted Translation
```

---

# 238. Invariantes de Ingeniería

ENG-061 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1166 | Toda interacción de MEF con sistemas externos deberá atravesar una Interoperability Boundary y Contract explícitos y ningún External Model, DTO, SDK Type o Error Model deberá convertirse en dependencia directa del Domain. |
| EI-1167 | Protocol, Format, Schema y Semantic Compatibility deberán evaluarse como dimensiones distintas y la capacidad de parsear una representación no deberá interpretarse como compatibilidad semántica. |
| EI-1168 | Todo Interoperability Profile deberá poseer Identity, Owner, Version, External System, Protocol, Format, Capabilities, Mappings, Error Model y Security requirements conocidos. |
| EI-1169 | Model Mappings deberán ser explícitos, versionados, determinísticos y capaces de declarar Lossiness; Bidirectional Mapping no deberá asumir simetría ni Round-Trip salvo Contract explícito. |
| EI-1170 | Version y Capability Negotiation deberán utilizar reglas explícitas y ningún Downgrade deberá reducir Security, Integrity o Semantics silenciosamente. |
| EI-1171 | Todo Input externo deberá atravesar Validation, Normalization y Sanitization apropiadas antes de convertirse en Canonical o Internal Model confiable. |
| EI-1172 | Encoding, Character Set, Locale, Timezone, Units, Currency e Identifier Namespace deberán tratarse como semántica explícita y no inferirse mediante Defaults ambiguos cuando puedan alterar significado. |
| EI-1173 | External y Internal Identifiers deberán permanecer diferenciados y todo Identity o Tenant Mapping deberá preservar System of Origin y pasar por Resolution confiable. |
| EI-1174 | External Errors deberán mapearse a taxonomía interna controlada y códigos, mensajes o Exceptions de proveedor no deberán propagarse directamente como Contract público de MEF. |
| EI-1175 | Timeouts, Network Failures y Connection Loss deberán poder producir Unknown Outcome explícito y ningún Retry deberá repetirse ciegamente cuando pueda duplicar Side Effects externos. |
| EI-1176 | Integraciones retryables deberán utilizar Idempotency, Reconciliation o mecanismos equivalentes cuando el sistema externo pueda procesar una operación aunque MEF no reciba confirmación. |
| EI-1177 | External Ordering, Duplication, Partial Success, Pagination, Streaming y Batch Semantics deberán basarse únicamente en garantías documentadas del sistema externo. |
| EI-1178 | Vendor SDKs, Protocol Libraries y External DTOs deberán permanecer encapsulados dentro de Interoperability/Infrastructure Boundaries para limitar Vendor Lock-In y proteger el Domain. |
| EI-1179 | Toda Boundary externa deberá considerarse Trust Boundary y aplicar Authentication, Authorization, Integrity, Encryption, Replay Protection y Input Security conforme al Threat Model. |
| EI-1180 | Interoperability Resilience deberá utilizar Timeouts, Backoff, Retry, Circuit Breaking, Bulkheads, Rate-Limit Handling y Backpressure sin convertir Fallos externos en Retry Storms o agotamiento de Resources. |
| EI-1181 | Criticality de dependencias externas deberá ser explícita y Fallos de dependencias OPTIONAL no deberán afectar automáticamente Liveness o Readiness global cuando exista Degraded Mode válido. |
| EI-1182 | Interoperability Observability y Audit deberán permitir identificar Profile, Adapter, Protocol, Mapping, Negotiation, Failure y Unknown Outcome sin copiar Payloads sensibles ni IDs externos como Labels de alta cardinalidad. |
| EI-1183 | Interoperability Testing deberá cubrir Protocol, Format, Mapping, Semantic Compatibility, Negotiation, Encoding, Locale, Timezone, Units, Identity, Errors, Timeouts, Idempotency, Duplication, Ordering, Partial Success, Security y Resilience. |
| EI-1184 | Build y Architecture Tests deberán detectar External DTOs o Vendor SDK Types en Domain, Mappings sin Version, Unsupported Profiles, Silent Protocol Downgrades, Direct External Calls desde Domain y External Errors expuestos como Contracts internos. |
| EI-1185 | La primera implementación deberá favorecer Boundaries explícitos, Adapters, Gateways, Versioned Profiles, Canonical Boundary Models, Mapping, Semantic Compatibility, Negotiation, Error Mapping, Validation, Resilience y Contract Testing antes de introducir Federation, Dynamic Protocols o Automatic Mapping. |

---

# 239. Continuidad de Invariantes

```text
ENG-057 → EI-1086 a EI-1105
ENG-058 → EI-1106 a EI-1125
ENG-059 → EI-1126 a EI-1145
ENG-060 → EI-1146 a EI-1165
ENG-061 → EI-1166 a EI-1185
```

---

# 240. Criterios de Conformidad

Una implementación será conforme con ENG-061 cuando:

- defina Boundaries explícitos;
- defina Interoperability Profiles;
- versione Profiles;
- encapsule Protocols;
- encapsule Formats;
- utilice Adapters;
- utilice Gateways;
- proteja Domain de modelos externos;
- defina Canonical Boundary Models;
- versione Mappings;
- detecte Lossy Mapping;
- evalúe Protocol Compatibility;
- evalúe Format Compatibility;
- evalúe Semantic Compatibility;
- negocie Versions cuando corresponda;
- negocie Capabilities;
- valide Inputs;
- normalice representación;
- controle Encoding;
- controle Locale;
- controle Timezone;
- controle Units;
- diferencie External/Internal IDs;
- mapee Identity de forma confiable;
- mapee Errors externos;
- modele Unknown Outcome;
- aplique Idempotency;
- preserve Tenant Isolation;
- aplique Resilience;
- controle Security;
- permita Diagnostics;
- implemente Contract Tests.

---

# 241. Riesgos

Deberán evitarse especialmente:

```text
External DTO Leakage
Vendor SDK Leakage
Domain Direct External Calls
Implicit Mapping
Unversioned Mapping
Silent Lossy Transformation
Syntax Equals Semantics
Silent Protocol Downgrade
Silent Capability Downgrade
Ambiguous Locale
Ambiguous Timezone
Unit Confusion
Currency Confusion
External ID Collision
Identity Mapping Collision
Tenant Mapping Spoofing
Raw External Errors
Blind Retry
Unknown Outcome Ignored
Duplicate Side Effects
Ordering Assumption
Payload Logging
Certificate Validation Disabled
SSRF
Unsafe Deserialization
Vendor Lock-In Leakage
```

---

# 242. Relación con ENG-032

Transport responde:

```text
How are bytes/messages moved?
```

Interoperability responde:

```text
What do those bytes/messages mean
between different systems?
```

---

# 243. Relación con ENG-031

Serialization convierte representación.

Interoperability gobierna Mapping y Compatibility semántica.

---

# 244. Relación con ENG-039

Resilience protege la Boundary ante fallos externos.

---

# 245. Relación con ENG-044

API Engineering define API Contracts.

Interoperability gobierna adaptación con APIs externas y ecosistemas diferentes.

---

# 246. Relación con ENG-047

IAM mantiene identidad interna.

Interoperability puede traducir identidades externas hacia References internas controladas.

---

# 247. Relación con ENG-048

Tenant Mapping deberá respetar Tenant Isolation.

---

# 248. Relación con ENG-056

Context transporta:

```text
correlation
trace
deadline
cancellation
tenant
```

pero toda información recibida externamente deberá revalidarse.

---

# 249. Relación con ENG-057

Metadata describe Profiles, Protocols, Formats y Capabilities.

---

# 250. Relación con ENG-058 / ENG-059

```text
Discover Adapters
      │
      ▼
Validate Candidates
      │
      ▼
Resolve Compatible Adapter
      │
      ▼
Execute Interoperability Boundary
```

---

# 251. Relación con ENG-060

Plugins podrán proporcionar:

```text
Adapters
Gateways
Translators
Profiles
Mappings
```

sin romper Contracts de Interoperability.

---

# 252. Relación con ENG-062

ENG-062 deberá formalizar **Schema Engineering**.

La separación propuesta será:

```text
Interoperability Engineering
→ how MEF communicates semantically
  with external systems

Schema Engineering
→ how MEF formally defines,
  versions, validates and evolves
  structural data contracts
```

ENG-062 deberá cubrir:

```text
Schema
Schema Identifier
Schema Namespace
Schema Version

Schema Definition
Schema Field
Schema Type
Schema Constraint
Schema Default

Required Field
Optional Field
Nullable Field

Primitive Type
Composite Type
Collection Type
Reference Type
Enum Type
Union Type

Schema Validation
Schema Normalization

Schema Compatibility
Backward Compatibility
Forward Compatibility
Full Compatibility

Schema Evolution
Field Addition
Field Removal
Field Rename
Type Change
Constraint Change

Schema Migration

Schema Registry
Schema Discovery
Schema Resolution

Schema Serialization
Schema Generation
Schema Code Generation

Schema Security
Schema Audit
Schema Observability
Schema Testing
```

---

# 253. Principio Rector

> **MEF deberá interoperar mediante Boundaries explícitos que protejan su modelo interno. Toda diferencia de protocolo, formato, versión, identidad, unidades, tiempo, errores o semántica deberá traducirse de forma visible y testeable, y ningún detalle perteneciente a un proveedor externo deberá infiltrarse silenciosamente en Contracts o Domain Models internos.**

---

# 254. Conclusión

**ENG-061 — Interoperability Engineering** formaliza la relación de MEF con sistemas externos.

La arquitectura queda:

```text
EXTERNAL SYSTEM
      │
      ▼
INTEROPERABILITY BOUNDARY
      │
      ▼
    GATEWAY
      │
      ▼
    ADAPTER
      │
      ▼
VALIDATE / NORMALIZE
      │
      ▼
   TRANSLATE
      │
      ▼
CANONICAL BOUNDARY MODEL
      │
      ▼
   APPLICATION
      │
      ▼
     DOMAIN
```

La compatibilidad queda:

```text
Compatibility
   │
   ├── Protocol
   ├── Format
   ├── Schema
   └── Semantic
```

y:

```text
Valid JSON
   │
   ▼
Syntactically valid
   │
   X
   │
   ▼
Semantically compatible
```

La negociación queda:

```text
Local Versions / Capabilities
            │
            ▼
       NEGOTIATION
            ▲
            │
Remote Versions / Capabilities
            │
            ▼
      Effective Profile
```

El Mapping queda:

```text
External Model
      │
      ▼
Versioned Mapping
      │
      ├── rename
      ├── convert
      ├── normalize
      ├── map codes
      └── map units
      │
      ▼
Canonical Model
```

El Error Mapping queda:

```text
External Failure
      │
      ▼
External Error Mapper
      │
      ▼
MEF Error Taxonomy
      │
      ▼
Resilience / Application
```

El Unknown Outcome queda:

```text
Request Sent
     │
     ▼
 Remote System
     │
     X connection lost
     │
     ▼
UNKNOWN OUTCOME
     │
     ├── status query
     ├── reconcile
     ├── idempotent retry
     └── manual handling
```

La relación del bloque reciente queda:

```text
METADATA
ENG-057
    │
    ▼
DISCOVERY
ENG-058
    │
    ▼
RESOLUTION
ENG-059
    │
    ▼
EXTENSIONS
ENG-060
    │
    ▼
INTEROPERABILITY
ENG-061
```

La primera implementación deberá concentrarse en:

```text
InteroperabilityProfile
InteroperabilityBoundary

ProtocolDescriptor
FormatDescriptor

InteroperabilityAdapter
ExternalGateway
InteroperabilityTranslator

CanonicalModel
ModelMapping

CompatibilityProfile
CapabilitySet
NegotiationResult

ExternalErrorMapper
InteroperabilityError
```

con:

```text
Explicit Boundaries
Versioned Profiles
Adapters
Gateways
Canonical Boundary Models
Versioned Mappings
Semantic Compatibility
Version Negotiation
Capability Negotiation
Boundary Validation
Normalization
Error Mapping
Identity Mapping
Timezone / Units / Currency
Timeouts
Unknown Outcome
Idempotency
Resilience
Security
Contract Testing
```

antes de introducir:

```text
Federated Interoperability
Dynamic Protocol Negotiation
Automatic Mapping Generation
Schema Inference
Cross-Region Interoperability Mesh
AI-Assisted Translation
```

Con **ENG-061**, la serie global alcanza:

```text
EI-1185
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-014 — Versionado
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-033 — Communication Engineering
- ENG-034 — Application Engineering
- ENG-036 — Validation Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering
- ENG-044 — API Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-049 — Configuration Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-060 — Extension & Plugin Engineering
- ENG-062 — Schema Engineering
```