---
id: ENG-031
titulo: Serialization Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-003
  - ENG-005
  - ENG-014
  - ENG-016
  - ENG-021
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-028
  - ENG-030
relacionados:
  - ENG-006
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-019
  - ENG-020
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-029
  - ENG-032
keywords:
  - serialization
  - deserialization
  - encoding
  - decoding
  - schema
  - codec
  - canonicalization
  - compatibility
  - json
  - binary
  - contracts
  - events
  - persistence
  - mef
---

# ENG-031

# Serialization Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Serialization Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-031 deberá establecer las reglas para:

```text
Serialization
Deserialization
Encoding
Decoding
Schemas
Codecs
Formats
Canonical Representation
Type Mapping
Compatibility
Versioning
Validation
Security
Limits
Error Handling
Observability
Testing
```

El objetivo fundamental será transformar estructuras internas en representaciones transportables o persistibles sin convertir detalles internos de implementación en Contracts públicos accidentales.

---

# 2. Declaración

La regla fundamental será:

> **Toda representación serializada que cruce una Boundary arquitectónica deberá obedecer un Contract o Schema explícito, aplicar validación y límites definidos, y evolucionar mediante reglas de Versioning y Compatibility sin depender accidentalmente de la representación interna de los objetos.**

Por tanto:

```text
Internal Model
      │
      ▼
Serializable Contract
      │
      ▼
Serializer
      │
      ▼
Format
      │
      ▼
Bytes / Text
```

y en sentido inverso:

```text
Bytes / Text
      │
      ▼
Decoder
      │
      ▼
Validation
      │
      ▼
Deserializer
      │
      ▼
Contract Model
```

---

# 3. Serialization

`Serialization` representa la transformación de una estructura lógica a una representación que pueda:

```text
persistirse
transportarse
almacenarse
firmarse
compararse
intercambiarse
```

---

# 4. Deserialization

`Deserialization` representa la reconstrucción controlada de una estructura a partir de una representación serializada.

---

# 5. Serialization ≠ Encoding

Deberán mantenerse separados:

```text
Serialization
→ object/data structure → logical representation

Encoding
→ logical representation → bytes/text encoding
```

---

# 6. Deserialization ≠ Decoding

También:

```text
Decoding
→ bytes/text → logical representation

Deserialization
→ logical representation → typed structure
```

---

# 7. Conceptual Pipeline

```text
Object
  ↓
Serialization
  ↓
Logical Representation
  ↓
Encoding
  ↓
Bytes
```

y:

```text
Bytes
  ↓
Decoding
  ↓
Logical Representation
  ↓
Validation
  ↓
Deserialization
  ↓
Object
```

---

# 8. Serializer

Un `Serializer` transforma datos conforme a un Contract/Schema.

---

# 9. Deserializer

Un `Deserializer` reconstruye datos conforme a un Contract/Schema.

---

# 10. Codec

Un `Codec` podrá agrupar:

```text
encode
decode
```

para un Format determinado.

---

# 11. Codec ≠ Contract

El Codec define cómo representar.

El Contract define qué significa la información.

---

# 12. Format

Un `Format` representa una convención de representación.

Ejemplos:

```text
JSON
MessagePack
CBOR
Protocol Buffers
Avro
custom binary format
```

MEF Core no deberá depender obligatoriamente de todos ellos.

---

# 13. Default Interoperable Format

La primera implementación podrá favorecer:

```text
JSON
```

para representaciones textuales interoperables.

---

# 14. JSON Is Not Universal

JSON no deberá considerarse automáticamente el formato correcto para:

```text
high-performance binary transport
large binary payloads
streaming media
specialized persistence
```

---

# 15. Binary Formats

Podrán incorporarse mediante Adapters/Extensions.

---

# 16. Serialization Boundary

La Serialization deberá ser explícita cuando los datos crucen:

```text
Process Boundary
Module Public Boundary
Persistence Boundary
Event Boundary
External API Boundary
CLI Machine Boundary
Cache Boundary
```

---

# 17. Internal Objects

Objetos puramente internos no requieren necesariamente Serialization Contract público.

---

# 18. Public Representation

Toda representación pública deberá poseer semántica estable.

---

# 19. Internal Model ≠ Wire Model

Deberán poder mantenerse separados:

```text
Domain Model
Wire Model
Persistence Model
```

---

# 20. Wire Model

`Wire Model` representa datos preparados para intercambio.

---

# 21. Persistence Model

ENG-030 continuará gobernando representación persistente.

---

# 22. Contract Model

ENG-021 gobierna semántica contractual.

---

# 23. Mapping

Podrá existir:

```text
Domain Model
      ↓
Mapper
      ↓
Contract Model
      ↓
Serializer
      ↓
Wire Format
```

---

# 24. No Automatic Object Dump

MEF no deberá definir como mecanismo público:

```text
serialize every property automatically
```

sin Contract explícito.

---

# 25. Why

Porque puede exponer accidentalmente:

```text
private fields
internal IDs
secrets
implementation details
deprecated fields
security state
```

---

# 26. Schema

Un `Schema` describe la estructura válida de una representación serializada.

---

# 27. Schema Purpose

Podrá definir:

```text
fields
types
required fields
optional fields
constraints
defaults
version
```

---

# 28. Schema Ownership

Todo Schema público deberá poseer Owner.

---

# 29. Schema Identity

Un Schema público deberá poseer identidad estable cuando participe en Contracts versionados.

---

# 30. Schema Version

Deberá mantenerse separada de:

```text
Module Version
Package Version
Runtime Version
```

cuando corresponda.

---

# 31. Schema vs Contract Version

Podrán coincidir en algunos Designs.

No deberán asumirse equivalentes universalmente.

---

# 32. Schema Registry

ENG-020 podrá mantener metadata sobre Schemas conocidos.

---

# 33. Schema Registry Entry

Conceptualmente:

```text
SchemaEntry
├── id
├── version
├── owner
├── format
├── compatibility
├── fingerprint
└── provenance
```

---

# 34. Schema Source of Truth

Deberá existir una fuente canónica identificable.

---

# 35. Generated Schema

Tooling podrá generar Schemas desde Contracts cuando el mecanismo sea determinista.

---

# 36. Generated Code

También podrá generarse código desde Schema.

---

# 37. Schema Drift

Schema, Contract e Implementation no deberán divergir silenciosamente.

---

# 38. Schema Validation

Input serializado deberá validarse cuando cruce una Boundary no confiable o Contractual.

---

# 39. Validation Before Construction

Deberá favorecerse:

```text
decode
   ↓
validate
   ↓
construct typed object
```

---

# 40. Invalid Payload

No deberá convertirse silenciosamente en objeto parcialmente válido.

---

# 41. Required Field

La ausencia deberá producir Failure salvo que Compatibility Policy indique comportamiento distinto.

---

# 42. Optional Field

Deberá poseer semántica clara.

---

# 43. Missing ≠ Null

Deberán distinguirse cuando el Contract lo requiera:

```text
field missing
field = null
```

---

# 44. Default

Un Default deberá formar parte de la semántica contractual cuando afecte interpretación.

---

# 45. Unknown Fields

La Policy deberá definir qué ocurre con campos desconocidos.

Posibles estrategias:

```text
reject
ignore
preserve
```

---

# 46. Default Unknown Field Policy

Para Contracts evolutivos podrá favorecerse:

```text
ignore unknown fields
```

solo cuando no afecte Security o Correctness.

---

# 47. Strict Mode

Podrá existir para Schemas donde campos desconocidos deban rechazarse.

---

# 48. Preserve Unknown Fields

Podrá utilizarse en sistemas de intermediación donde sea necesario round-trip.

---

# 49. Type System

Serialization deberá definir Mapping de tipos.

---

# 50. Primitive Types

Como mínimo deberá contemplar:

```text
string
boolean
integer
decimal
null
array/list
object/map
```

según Format.

---

# 51. Integer

Deberán considerarse límites del Format/Consumer.

---

# 52. Large Integer

No deberá asumirse que todos los Consumers preservan enteros arbitrariamente grandes.

---

# 53. Floating Point

No deberá utilizarse para valores que requieran precisión decimal exacta.

---

# 54. Decimal

Valores financieros deberán utilizar representación de precisión apropiada.

---

# 55. Money

Debería representarse explícitamente.

Conceptualmente:

```json
{
  "amount": "1250.50",
  "currency": "MXN"
}
```

cuando el Contract lo defina.

---

# 56. Date

Deberá diferenciarse de DateTime.

---

# 57. DateTime

Deberá poseer representación inequívoca.

---

# 58. Timezone

Deberá incluir Offset/Timezone cuando la semántica lo requiera.

---

# 59. UTC

Podrá favorecerse para instantes absolutos.

---

# 60. Local Time

No deberá interpretarse como instante global sin Context adicional.

---

# 61. Duration

Deberá poseer representación explícita.

---

# 62. UUID

Podrá representarse como String canónico.

---

# 63. Enum

Deberá utilizar valores estables.

---

# 64. Enum Ordinal

No deberá exponerse públicamente por defecto:

```text
0
1
2
```

si el significado depende del orden interno.

---

# 65. Stable Enum Value

Preferir:

```text
"active"
"inactive"
"suspended"
```

---

# 66. Enum Evolution

Eliminar o reinterpretar valores puede constituir Breaking Change.

---

# 67. Binary Data

No deberá insertarse arbitrariamente como String sin Encoding explícito.

---

# 68. Base64

Podrá utilizarse para Payloads pequeños cuando el Contract lo requiera.

---

# 69. Large Binary Payload

Deberá favorecer mecanismos especializados de Storage/Streaming.

---

# 70. Collection

El orden deberá considerarse semántico solo cuando el Contract lo defina.

---

# 71. Set

No deberá serializarse como List asumiendo semántica de orden si realmente representa conjunto.

---

# 72. Map Keys

Deberán respetar restricciones del Format.

---

# 73. Recursive Structures

Deberán tener límites.

---

# 74. Object Graph

Serialization pública no deberá recorrer grafos arbitrarios de objetos.

---

# 75. Cyclic Object Graph

Deberá rechazarse o tratarse mediante estrategia explícita.

---

# 76. Reference Serialization

No será comportamiento predeterminado.

---

# 77. Depth Limit

Deserializer deberá soportar límite de profundidad cuando Input pueda ser no confiable.

---

# 78. Collection Limit

Deberá poder limitar:

```text
array length
map entries
```

---

# 79. String Limit

Deberá poder limitar longitud.

---

# 80. Payload Limit

Toda Boundary externa deberá poder establecer tamaño máximo.

---

# 81. Binary Limit

También.

---

# 82. Decompression Limit

Si existe Compression deberá protegerse contra expansión descontrolada.

---

# 83. Resource Exhaustion

Serialization deberá tratarse como superficie potencial de DoS.

---

# 84. Deserialization Security

Deserialization de Input no confiable deberá considerarse operación sensible.

---

# 85. No Arbitrary Class Instantiation

Deserializer no deberá permitir que Payload externo seleccione clases arbitrarias.

---

# 86. No Executable Payload

La representación serializada deberá tratarse como datos.

No como código.

---

# 87. Type Metadata

No deberá permitir:

```text
$class
__type
objectClass
```

para instanciar tipos arbitrarios sin Allowlist estricta.

---

# 88. Allowlist

Cuando Polymorphism sea necesario deberá existir lista explícita de tipos permitidos.

---

# 89. Polymorphism

Deberá estar gobernado por Contract.

---

# 90. Discriminator

Podrá utilizarse:

```json
{
  "type": "customer.created"
}
```

si los valores permitidos están definidos.

---

# 91. Discriminator Is Data

No deberá convertirse directamente en nombre de clase ejecutable.

---

# 92. Prototype Pollution

Implementations en ecosistemas susceptibles deberán protegerse contra claves peligrosas.

---

# 93. Duplicate Keys

La Policy deberá ser explícita.

---

# 94. Duplicate JSON Keys

La primera implementación debería rechazarlas en Inputs contractuales cuando sea técnicamente viable.

---

# 95. Unicode

Text Formats deberán manejar Unicode de forma consistente.

---

# 96. UTF-8

La primera implementación deberá favorecer:

```text
UTF-8
```

como Encoding textual estándar.

---

# 97. Invalid UTF-8

Deberá rechazarse o tratarse mediante Policy explícita.

---

# 98. Unicode Normalization

No deberá aplicarse automáticamente a todos los Strings.

---

# 99. Identifier Normalization

Podrá requerir reglas específicas.

---

# 100. Canonicalization

`Canonicalization` produce una representación determinista equivalente para los mismos datos lógicos.

---

# 101. Canonicalization Purpose

Será necesaria para casos como:

```text
hashing
signatures
fingerprints
cache keys
deterministic tests
```

---

# 102. Ordinary Serialization ≠ Canonical Serialization

No deberá asumirse que toda Serialization produce bytes idénticos.

---

# 103. Canonical Serializer

Deberá existir explícitamente cuando se necesite.

---

# 104. Canonical Property Ordering

Podrá requerir orden determinista.

---

# 105. Whitespace

Deberá normalizarse según Canonical Format.

---

# 106. Number Representation

Deberá poseer reglas deterministas.

---

# 107. Unicode Representation

También deberá estar definida cuando forme parte de Canonicalization.

---

# 108. Canonicalization Version

Un algoritmo canónico utilizado para Signature/Fingerprint deberá versionarse.

---

# 109. Hash

Hash deberá calcularse sobre una representación definida.

---

# 110. Hash ≠ Serialization Format

No deberán confundirse.

---

# 111. Signature

ENG-024 gobernará Cryptographic Signature.

ENG-031 define la representación determinista que podrá firmarse.

---

# 112. Sign What You Mean

La representación firmada deberá corresponder exactamente a la semántica que se pretende proteger.

---

# 113. Compatibility

ENG-016 será autoridad general.

ENG-031 define Compatibility de representaciones serializadas.

---

# 114. Backward Compatibility

Conceptualmente:

```text
new reader
can read
old payload
```

---

# 115. Forward Compatibility

Conceptualmente:

```text
old reader
can tolerate/read
new payload
```

según Contract.

---

# 116. Full Compatibility

Cuando ambas sean válidas.

---

# 117. Add Optional Field

Normalmente puede ser compatible si Consumers toleran Unknown Fields.

---

# 118. Add Required Field

Normalmente constituye Breaking Change para Payloads anteriores.

---

# 119. Remove Optional Field

Puede afectar Consumers que lo esperaban.

Deberá evaluarse.

---

# 120. Rename Field

Conceptualmente equivale a:

```text
remove old field
+
add new field
```

y puede ser Breaking.

---

# 121. Change Field Type

Normalmente deberá tratarse como Breaking salvo Conversion Contract explícito.

---

# 122. Narrow Constraint

Ejemplo:

```text
maxLength 500
→
maxLength 50
```

puede ser Breaking.

---

# 123. Widen Constraint

Puede ser compatible para Writers pero no necesariamente para Readers.

---

# 124. Semantic Change

Cambiar significado sin cambiar Schema sigue siendo Breaking.

---

# 125. Semantic Compatibility

No deberá reducirse únicamente a comparar estructura.

---

# 126. Field Reuse

Un campo retirado no deberá reutilizarse posteriormente con significado diferente.

---

# 127. Field Identity

En Binary Schemas con Field Numbers, éstos deberán considerarse identidad estable.

---

# 128. Reserved Fields

Podrán marcarse para evitar reutilización.

---

# 129. Deprecation

Campos podrán marcarse Deprecated antes de Removal.

---

# 130. Migration Window

Podrá soportarse temporalmente:

```text
old field
+
new field
```

---

# 131. Dual Read

Readers podrán aceptar ambas representaciones durante Migration.

---

# 132. Dual Write

Writers podrán emitir ambas solo cuando sea necesario y gobernado.

---

# 133. Dual Write Risk

No deberá mantenerse indefinidamente.

---

# 134. Version Field

Un Payload podrá incluir versión explícita.

Ejemplo:

```json
{
  "schemaVersion": 2
}
```

---

# 135. Version Envelope

También podrá formar parte del Envelope externo.

---

# 136. Version Location

Deberá ser consistente dentro del mismo Contract family.

---

# 137. No Version Guessing

Deserializer no debería inferir versiones ambiguas basándose únicamente en presencia accidental de campos.

---

# 138. Version Resolver

Podrá existir:

```text
SchemaVersionResolver
```

---

# 139. Upcaster

Un `Upcaster` transforma Payload antiguo hacia representación actual.

---

# 140. Upcasting

Podrá utilizarse especialmente para Events persistidos.

---

# 141. Upcaster Chain

Conceptualmente:

```text
v1
 ↓
v2
 ↓
v3
```

---

# 142. Deterministic Upcasting

Deberá ser determinista.

---

# 143. Side-Effect-Free Upcasting

No debería requerir llamadas externas para interpretar Payload histórico.

---

# 144. Upcaster Ownership

Deberá pertenecer al Contract/Schema Owner.

---

# 145. Downcasting

No será requisito universal.

---

# 146. Event Serialization

ENG-022 utilizará ENG-031 para representación de Events.

---

# 147. Event Envelope

Podrá contener:

```text
eventId
eventType
schemaVersion
occurredAt
correlationId
causationId
payload
metadata
```

según ENG-022.

---

# 148. Event Payload

Deberá obedecer Contract/Schema.

---

# 149. Event Type

No deberá depender del nombre físico de una clase.

---

# 150. Event Evolution

Deberá preservar Consumers o utilizar Versioning/Upcasting.

---

# 151. Event Replay

Payload histórico deberá poder interpretarse mientras permanezca soportado.

---

# 152. Persistence Serialization

ENG-030 podrá utilizar ENG-031 para:

```text
JSON columns
documents
snapshots
outbox payloads
cached representations
```

---

# 153. Stored Payload

Deberá poseer Schema/Version cuando su evolución lo requiera.

---

# 154. Snapshot

Un Snapshot deberá indicar versión de representación.

---

# 155. Outbox

Payload de Outbox deberá preservar Event Contract.

---

# 156. Configuration Serialization

ENG-011 podrá utilizar parsers/codecs para:

```text
JSON
YAML
TOML
ENV-derived structures
```

pero Configuration Semantics siguen perteneciendo a ENG-011.

---

# 157. Manifest Serialization

ENG-003 podrá utilizar ENG-031 para parsing/encoding.

---

# 158. CLI Serialization

ENG-007 podrá utilizar formatos estructurados.

Ejemplo:

```text
--format=json
```

---

# 159. CLI JSON

Deberá poseer Schema suficientemente estable cuando esté destinado a automatización.

---

# 160. Human Output ≠ Machine Output

No deberán compartir necesariamente representación.

---

# 161. Registry Serialization

ENG-020 podrá serializar metadata para:

```text
cache
diagnostics
export
build artifacts
```

---

# 162. Module Metadata

ENG-028 deberá evitar serializar Runtime Objects arbitrarios.

---

# 163. Extension Metadata

ENG-029 aplicará las mismas reglas.

---

# 164. Serialization Provider

MEF podrá definir un Contract:

```text
Serializer
```

---

# 165. Serializer Contract

Conceptualmente:

```text
serialize(value, schema)
deserialize(payload, schema)
```

---

# 166. Codec Contract

Conceptualmente:

```text
encode(value)
decode(payload)
```

---

# 167. Schema Validator

Podrá existir:

```text
SchemaValidator
```

---

# 168. Serializer Registry

Podrá existir un Registry especializado o integrarse con ENG-020.

---

# 169. Codec Registry

Deberá permitir resolución por Format explícito.

---

# 170. No Magic Global Serializer

No deberá existir comportamiento donde cualquier objeto pueda serializarse globalmente sin Contract.

---

# 171. Serializer Selection

Deberá ser determinista.

---

# 172. Format Identifier

Deberá poseer identificador estable.

Ejemplos:

```text
application/json
application/cbor
```

cuando corresponda.

---

# 173. Media Type

Podrá utilizarse como Format Identifier en Boundaries externas.

---

# 174. Charset

Text Formats deberán declarar Charset cuando sea necesario.

---

# 175. Content Negotiation

Podrá implementarse posteriormente en Transport/API Engineering.

ENG-031 únicamente define Formats y Codecs.

---

# 176. Compression

Compression es una transformación distinta.

---

# 177. Serialization ≠ Compression

La cadena podrá ser:

```text
Object
 ↓
Serialize
 ↓
Encode
 ↓
Compress
 ↓
Encrypt
 ↓
Transport
```

---

# 178. Reverse Pipeline

```text
Transport
 ↓
Decrypt
 ↓
Decompress
 ↓
Decode
 ↓
Validate
 ↓
Deserialize
```

---

# 179. Pipeline Order

Deberá definirse explícitamente por el protocolo correspondiente.

---

# 180. Encryption

ENG-024 gobierna Encryption.

---

# 181. Encryption Before/After Serialization

La semántica dependerá del mecanismo, pero no deberá mezclarse dentro del Serializer sin Contract explícito.

---

# 182. Serialization Context

Podrá existir:

```text
SerializationContext
```

---

# 183. Recommended SerializationContext

Conceptualmente:

```text
SerializationContext
├── schema
├── schemaVersion
├── format
├── locale-independent options
├── limits
└── compatibility mode
```

---

# 184. No Security Authority in Context

SerializationContext no deberá otorgar Permissions.

---

# 185. Locale Independence

Serialization contractual deberá ser independiente de Locale salvo que el Contract diga lo contrario.

---

# 186. Decimal Locale

Nunca deberá serializarse:

```text
1.234,56
```

solo porque el Runtime esté en un Locale determinado.

---

# 187. Date Locale

Tampoco deberán utilizarse formatos ambiguos como:

```text
08/10/2026
```

en Contracts interoperables.

---

# 188. Determinism

Serialization deberá poder ser determinista cuando el Use Case lo requiera.

---

# 189. Map Ordering

No deberá asumirse significativo salvo Contract.

---

# 190. Stable Tests

Tests de Serialization deberán comparar semántica y, cuando corresponda, Canonical Representation.

---

# 191. Round Trip

Podrá verificarse:

```text
value
 ↓ serialize
payload
 ↓ deserialize
value'
```

---

# 192. Round-Trip Equality

La igualdad deberá definirse según semántica del Contract.

---

# 193. Lossless Serialization

Deberá utilizarse cuando toda la información deba preservarse.

---

# 194. Lossy Serialization

Solo deberá utilizarse cuando el Contract lo permita explícitamente.

---

# 195. Error Handling

ENG-023 gobernará estructura general de errores.

---

# 196. Serialization Errors

Deberán diferenciar:

```text
encoding failure
decoding failure
schema validation failure
unsupported format
unsupported version
type mapping failure
limit exceeded
canonicalization failure
```

---

# 197. Error Namespace

ENG-031 utilizará:

```text
MEF-SER-xxx
```

---

# 198. Taxonomía ENG-031

```text
MEF-SER-001 Serialization failed
MEF-SER-002 Deserialization failed
MEF-SER-003 Encoding failed
MEF-SER-004 Decoding failed
MEF-SER-005 Unsupported format
MEF-SER-006 Unsupported encoding
MEF-SER-007 Schema not found
MEF-SER-008 Schema invalid
MEF-SER-009 Schema validation failed
MEF-SER-010 Schema version unsupported
MEF-SER-011 Type mapping failed
MEF-SER-012 Required field missing
MEF-SER-013 Invalid field type
MEF-SER-014 Unknown field rejected
MEF-SER-015 Payload size limit exceeded
MEF-SER-016 Structure depth limit exceeded
MEF-SER-017 Collection limit exceeded
MEF-SER-018 Canonicalization failed
MEF-SER-019 Unsafe deserialization attempt
MEF-SER-020 Serialization invariant violated
```

---

# 199. Invalid Schema

```text
MEF-SER-008

Serialization Schema is invalid.

Schema:
SC-CUSTOMER-001

Version:
2.0.0
```

---

# 200. Validation Failure

```text
MEF-SER-009

Payload does not satisfy Schema.

Schema:
SC-CUSTOMER-001

Field:
email

Reason:
invalid format
```

---

# 201. Unsupported Version

```text
MEF-SER-010

Unsupported Schema version.

Schema:
SC-ORDER-EVENT-001

Received:
1

Supported:
2-3
```

---

# 202. Required Field Missing

```text
MEF-SER-012

Required field missing.

Schema:
SC-PAYMENT-001

Field:
currency
```

---

# 203. Payload Limit

```text
MEF-SER-015

Payload exceeds configured size limit.

Maximum:
1048576 bytes
```

---

# 204. Unsafe Deserialization

```text
MEF-SER-019

Unsafe deserialization attempt rejected.

Reason:
Payload requested an unauthorized runtime type.
```

---

# 205. Security

ENG-024 gobernará Security Policies.

ENG-031 deberá tratar Deserialization como Trust Boundary.

---

# 206. Untrusted Input

Todo Payload externo deberá considerarse no confiable hasta validación.

---

# 207. Validation Does Not Equal Authorization

Un Payload estructuralmente válido no implica que la operación esté autorizada.

---

# 208. Authorization

Deberá ocurrir en la Layer correspondiente.

---

# 209. Sensitive Fields

Schemas podrán marcar campos sensibles mediante Metadata gobernada.

---

# 210. Redaction

Diagnostics deberán evitar imprimir valores sensibles.

---

# 211. Secret Serialization

Secrets no deberán serializarse salvo mecanismo explícitamente diseñado para ello.

---

# 212. Password

Nunca deberá incluirse accidentalmente por Reflection/Object Dump.

---

# 213. Token

Igualmente.

---

# 214. Private Key

No deberá formar parte de Serialization general.

---

# 215. Serialization Bomb

Implementations deberán limitar estructuras maliciosamente grandes o profundas.

---

# 216. Parser Safety

Deberán utilizarse Parsers seguros y mantenidos.

---

# 217. Unsafe Native Serialization

Mecanismos nativos que puedan ejecutar código durante Deserialization no deberán utilizarse para Input no confiable.

---

# 218. Observability

ENG-025 deberá instrumentar Serialization cuando sea relevante.

---

# 219. Metrics

Podrán incluir:

```text
mef.serialization.operations.total
mef.serialization.failures.total
mef.serialization.duration
mef.serialization.payload.bytes
```

---

# 220. Metric Dimensions

Podrán utilizar:

```text
format
schema
operation
result
```

evitando Cardinality excesiva.

---

# 221. Payload Content in Metrics

No deberá incluirse.

---

# 222. Tracing

Serialization crítica podrá producir Spans.

---

# 223. Logging

Podrá registrar:

```text
schema
version
format
payload size
failure category
```

sin registrar Payload completo por defecto.

---

# 224. Performance

ENG-026 gobernará Benchmarks.

---

# 225. Serialization Performance

Deberá medirse con Payloads representativos.

---

# 226. Metrics

Deberán considerar:

```text
throughput
latency
allocations
payload size
```

---

# 227. Format Comparison

No deberá elegirse un formato únicamente por Benchmark sintético.

---

# 228. Human Readability

Puede ser criterio válido.

---

# 229. Interoperability

También.

---

# 230. Payload Size

También.

---

# 231. CPU Cost

También.

---

# 232. Streaming

Serializer podrá soportar Streaming para Payloads grandes.

---

# 233. Streaming Serialization

Deberá evitar construir Payload completo en Memory cuando no sea necesario.

---

# 234. Streaming Deserialization

También podrá procesar progresivamente.

---

# 235. Streaming Validation

Deberá preservar límites y Security.

---

# 236. Buffer Limits

Buffers deberán poseer límites.

---

# 237. Caching Serialized Form

Podrá utilizarse.

---

# 238. Cache Invalidation

Deberá considerar:

```text
schema version
format
source data version
```

---

# 239. Testing

ENG-009 deberá incluir Serialization Tests.

---

# 240. Schema Test

Deberá comprobar validez del Schema.

---

# 241. Round-Trip Test

Deberá comprobar Serialization + Deserialization.

---

# 242. Compatibility Test

Deberá comprobar versiones anteriores soportadas.

---

# 243. Unknown Field Test

Deberá comprobar Policy.

---

# 244. Missing Field Test

También.

---

# 245. Invalid Type Test

También.

---

# 246. Limit Test

Deberá probar:

```text
payload size
depth
collection size
string length
```

---

# 247. Malicious Payload Test

Deberá probar Inputs diseñados para romper Parser/Deserializer.

---

# 248. Canonicalization Test

Mismos datos lógicos deberán producir representación canónica equivalente.

---

# 249. Determinism Test

Deberá comprobar estabilidad cuando se requiera.

---

# 250. Golden Files

Podrán utilizarse para Schemas/Wire Formats estables.

---

# 251. Golden File Review

Cambios deberán revisarse como potenciales Contract Changes.

---

# 252. Fuzz Testing

Podrá aplicarse a Parsers/Deserializers.

---

# 253. Property-Based Testing

Podrá utilizarse para Round-Trip y límites.

---

# 254. Cross-Language Test

Contracts interoperables deberían probarse entre Implementations cuando sea relevante.

---

# 255. Build Integration

ENG-012 deberá poder validar Schemas durante Build.

---

# 256. Build Gate

Podrá fallar por:

```text
invalid schema
duplicate schema ID
incompatible schema change
missing codec
invalid canonicalization rule
```

---

# 257. Generated Artifacts

Build podrá generar:

```text
schemas
serializers
deserializers
type definitions
compatibility reports
```

---

# 258. Generated Artifact Reproducibility

Deberá ser determinista cuando forme parte de Build reproducible.

---

# 259. Release Integration

ENG-017 deberá considerar cambios de Schemas públicos.

---

# 260. Release Notes

Deberán incluir Breaking Serialization Changes cuando existan.

---

# 261. Compatibility Gate

Una Release no deberá introducir silenciosamente Schema incompatible.

---

# 262. Package Integration

ENG-013 podrá distribuir:

```text
schemas
codecs
generated serializers
```

---

# 263. Package Trust

Codecs ejecutables externos deberán someterse a ENG-024.

---

# 264. Extension Integration

ENG-029 podrá proporcionar Codecs adicionales mediante Extension Point.

---

# 265. Serialization Extension Point

Conceptualmente:

```text
XP-SERIALIZATION-CODEC-001
```

---

# 266. Codec Extension

Podrá declarar:

```text
format
media type
capabilities
version
```

---

# 267. Codec Selection

Deberá ser determinista.

---

# 268. Unsupported Format

Deberá producir Error explícito.

---

# 269. Registry Integration

ENG-020 podrá registrar:

```text
Schemas
Codecs
Formats
Compatibility Metadata
```

---

# 270. CLI Integration

ENG-007 podrá incorporar:

```text
mef schema list
mef schema inspect
mef schema validate
mef schema compatibility
mef serialization formats
```

---

# 271. `schema list`

Podrá mostrar:

```text
ID
Version
Owner
Format
```

---

# 272. `schema inspect`

Podrá mostrar:

```text
fields
types
constraints
compatibility
owner
fingerprint
```

---

# 273. `schema validate`

Podrá validar Schema o Payload.

---

# 274. `schema compatibility`

Podrá comparar:

```text
old schema
new schema
```

---

# 275. Machine Output

Los comandos deberán soportar salida estructurada.

---

# 276. First Implementation

La primera implementación deberá incluir conceptualmente:

```text
Serializer
Deserializer
Codec

SerializationFormat
SerializationContext

Schema
SchemaId
SchemaVersion
SchemaValidator

CodecRegistry
SchemaRegistry

SerializationLimits

CanonicalSerializer
CanonicalizationVersion

SchemaCompatibilityChecker
```

---

# 277. Optional Initial Components

Podrán incorporarse:

```text
Upcaster
UpcasterChain
StreamingSerializer
StreamingDeserializer
```

cuando exista necesidad inmediata.

---

# 278. Conceptual Directory Structure

```text
src/
└── Serialization/
    ├── Contract/
    │   ├── Serializer
    │   ├── Deserializer
    │   └── Codec
    │
    ├── Format/
    │   └── SerializationFormat
    │
    ├── Context/
    │   └── SerializationContext
    │
    ├── Schema/
    │   ├── Schema
    │   ├── SchemaId
    │   ├── SchemaVersion
    │   ├── SchemaValidator
    │   └── SchemaCompatibilityChecker
    │
    ├── Registry/
    │   ├── CodecRegistry
    │   └── SchemaRegistry
    │
    ├── Canonical/
    │   ├── CanonicalSerializer
    │   └── CanonicalizationVersion
    │
    ├── Evolution/
    │   ├── Upcaster
    │   └── UpcasterChain
    │
    └── Limits/
        └── SerializationLimits
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 279. Serialization Architecture

```text
                 SOURCE MODEL
                      │
                      ▼
                    MAPPER
                      │
                      ▼
                CONTRACT MODEL
                      │
                      ▼
                  SERIALIZER
                      │
                      ▼
                    CODEC
                      │
                      ▼
                 TEXT / BYTES
```

---

# 280. Deserialization Architecture

```text
                 TEXT / BYTES
                      │
                      ▼
                    CODEC
                      │
                      ▼
                   DECODER
                      │
                      ▼
                  VALIDATION
                      │
                      ▼
                DESERIALIZER
                      │
                      ▼
                CONTRACT MODEL
```

---

# 281. Schema Architecture

```text
                  CONTRACT
                      │
                      ▼
                    SCHEMA
                      │
          ┌───────────┼───────────┐
          ▼           ▼           ▼
       Validator   Serializer   Compatibility
```

---

# 282. Event Integration Architecture

```text
Domain Event
     │
     ▼
Event Contract
     │
     ▼
Event Schema
     │
     ▼
Serializer
     │
     ▼
Event Envelope
     │
     ▼
Event Bus
```

---

# 283. Persistence Integration Architecture

```text
Domain Model
     │
     ▼
Persistence Model
     │
     ▼
Persistence Schema
     │
     ▼
Serializer
     │
     ▼
Stored Representation
```

---

# 284. Canonicalization Architecture

```text
Logical Data
     │
     ▼
Canonical Serializer
     │
     ▼
Canonical Representation
     │
   ┌─┴───────────┐
   ▼             ▼
 Hash         Signature
```

---

# 285. Compatibility Architecture

```text
Schema v1
   │
   ▼
Compatibility Checker
   ▲
   │
Schema v2
```

Resultado:

```text
compatible
conditionally compatible
breaking
```

---

# 286. Evolution Architecture

```text
Historical Payload v1
        │
        ▼
     Upcaster
        │
        ▼
     Payload v2
        │
        ▼
     Upcaster
        │
        ▼
     Payload v3
        │
        ▼
 Current Deserializer
```

---

# 287. Security Architecture

```text
Untrusted Payload
       │
       ▼
   Size Limits
       │
       ▼
     Decoder
       │
       ▼
Depth / Collection Limits
       │
       ▼
Schema Validation
       │
       ▼
Allowed Type Mapping
       │
       ▼
Typed Contract Object
```

---

# 288. First Implementation Constraints

La primera versión deberá favorecer:

```text
JSON
UTF-8
Explicit Schemas
Explicit Type Mapping
Schema Validation
Payload Limits
Depth Limits
Deterministic Codec Selection
Compatibility Checking
Safe Deserialization
Canonical Serialization when required
```

---

# 289. First Version Non-Goals

No deberá requerir:

```text
Every serialization format
Runtime class serialization
Arbitrary polymorphic deserialization
Automatic object graph serialization
Remote schema federation
Universal schema language
Transparent compression
Transparent encryption
```

---

# 290. Second Phase

Podrá incorporar:

```text
Binary Codecs
Streaming
Generated Serializers
Advanced Schema Registry
Upcasting Infrastructure
Cross-Language Contract Tests
Fuzz Testing
```

---

# 291. Third Phase

Solo cuando exista necesidad:

```text
Federated Schema Registry
Remote Schema Resolution
Dynamic Codec Loading
Zero-Copy Serialization
Advanced Binary Protocols
Schema Negotiation
```

---

# 292. Invariantes de Ingeniería

ENG-031 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-566 | Toda representación serializada que cruce una Boundary contractual deberá poseer semántica explícita mediante Contract, Schema o mecanismo equivalente. |
| EI-567 | Serialization, Encoding, Compression y Encryption deberán mantenerse como transformaciones conceptualmente distintas aunque formen parte de un mismo Pipeline. |
| EI-568 | La representación pública de datos no deberá depender accidentalmente de la estructura interna de clases, propiedades privadas o nombres físicos de Implementation. |
| EI-569 | Domain Model, Contract/Wire Model y Persistence Model deberán poder evolucionar independientemente cuando sus Boundaries lo requieran. |
| EI-570 | Todo Schema público deberá poseer Ownership y Versioning identificables cuando participe en Compatibility. |
| EI-571 | Schema, Contract e Implementation no deberán divergir silenciosamente sobre la estructura contractual de los datos. |
| EI-572 | Input serializado no confiable deberá validarse antes de convertirse en estructuras operacionales confiables. |
| EI-573 | Missing, Null, Default y Unknown Field deberán conservar semánticas explícitas cuando el Contract las diferencie. |
| EI-574 | La Serialization contractual deberá utilizar representaciones de tipos que preserven la semántica y precisión requeridas por el Domain. |
| EI-575 | Deserialization no deberá permitir instanciación arbitraria de clases o ejecución de código controlada por Payload externo. |
| EI-576 | Payload size, nesting depth y collection size deberán poder limitarse en Trust Boundaries externas. |
| EI-577 | Canonical Serialization deberá utilizarse explícitamente cuando Hashing, Signing o Fingerprinting dependan de una representación determinista. |
| EI-578 | Cambios estructurales compatibles no deberán asumirse semánticamente compatibles sin evaluar el significado del Contract. |
| EI-579 | Campos retirados no deberán reutilizarse con significado incompatible dentro de la misma identidad contractual. |
| EI-580 | Event Types y otros discriminadores públicos no deberán depender de nombres físicos de clases Runtime. |
| EI-581 | Payloads históricos soportados deberán permanecer interpretables mediante Compatibility, Migration o Upcasting explícitos. |
| EI-582 | Serialization Telemetry no deberá registrar Payloads sensibles completos por defecto. |
| EI-583 | Codecs externos ejecutables deberán someterse a las mismas reglas de Trust, Security y Lifecycle aplicables a otras Extensions. |
| EI-584 | Machine-readable Output destinado a automatización deberá poseer una representación suficientemente estable y distinta de Human Presentation cuando sea necesario. |
| EI-585 | La primera implementación deberá favorecer formatos explícitos, Schemas verificables, límites estrictos y Deserialization segura antes de introducir mecanismos dinámicos avanzados. |

---

# 293. Continuidad de Invariantes

```text
ENG-027 → EI-486 a EI-505
ENG-028 → EI-506 a EI-525
ENG-029 → EI-526 a EI-545
ENG-030 → EI-546 a EI-565
ENG-031 → EI-566 a EI-585
```

---

# 294. Criterios de Conformidad

Una implementación será conforme con ENG-031 cuando:

- diferencie Serialization de Encoding;
- diferencie Serialization de Compression y Encryption;
- defina Serializer/Deserializer;
- permita Codecs;
- defina Formats;
- utilice UTF-8 como Default textual cuando corresponda;
- permita Schemas explícitos;
- defina Schema Ownership;
- defina Schema Version;
- valide Payloads;
- diferencie Missing y Null cuando corresponda;
- controle Unknown Fields;
- defina Type Mapping;
- preserve precisión;
- limite Payload Size;
- limite Nesting Depth;
- limite Collections;
- impida Arbitrary Class Instantiation;
- permita Canonicalization;
- compruebe Compatibility;
- permita evolución de Schemas;
- soporte Upcasting cuando sea necesario;
- integre Events;
- integre Persistence;
- integre CLI Machine Output;
- aplique Security;
- aplique Observability;
- soporte Testing;
- no dependa de Serialization automática de Runtime Objects.

---

# 295. Riesgos

Deberán evitarse especialmente:

## Object Dump as Contract

Se serializan todas las propiedades de una clase automáticamente.

## Runtime Class Name on Wire

El Payload depende del namespace/nombre físico de Implementation.

## Unsafe Deserialization

El Input controla qué clases se instancian.

## Unlimited Payload

No existen límites de tamaño.

## Unlimited Depth

Payload profundamente anidado agota recursos.

## Unlimited Collections

Arrays enormes consumen Memory.

## Float for Money

Se pierde precisión.

## Locale-Dependent Representation

Dates/Decimals dependen del Locale del servidor.

## Schema Drift

Schema y Implementation divergen.

## Semantic Breaking Change

Schema parece compatible pero cambia significado.

## Field Reuse

Un campo retirado vuelve con otra semántica.

## Version Guessing

Deserializer intenta adivinar Schema Version.

## Payload Logging

Datos sensibles aparecen en Logs.

## Canonicalization Assumption

Se firma JSON ordinario suponiendo que siempre produce los mismos bytes.

## Serialization Equals Encryption

Se considera que codificar datos los protege.

## Event Class Name

Event Type depende de una clase concreta.

## Golden File Blind Update

Se actualizan Fixtures para hacer pasar Tests sin revisar Compatibility.

---

# 296. Relación con ENG-003

Manifest podrá utilizar Serialization Infrastructure.

ENG-003 conserva autoridad sobre semántica de Manifest.

---

# 297. Relación con ENG-007

CLI podrá utilizar Serialization para Machine-readable Output.

---

# 298. Relación con ENG-011

Configuration podrá utilizar Codecs/Parsers.

Configuration Semantics continúan perteneciendo a ENG-011.

---

# 299. Relación con ENG-014

ENG-014 gobierna Versioning general.

ENG-031 aplica Versioning a:

```text
Schemas
Formats
Canonicalization
Serialized Contracts
```

---

# 300. Relación con ENG-016

ENG-016 gobierna Compatibility.

ENG-031 define qué cambios de representación deberán evaluarse.

---

# 301. Relación con ENG-020

Registry podrá conocer:

```text
Schemas
Codecs
Formats
Versions
Owners
```

---

# 302. Relación con ENG-021

Contracts definen significado.

Serialization define representación.

```text
Contract
→ meaning

Schema
→ structure

Serializer
→ transformation

Codec
→ representation
```

---

# 303. Relación con ENG-022

Event Bus utiliza Serialization para representar Events sin depender de Runtime Classes.

---

# 304. Relación con ENG-023

Serialization Failures deberán traducirse a errores estables `MEF-SER-*`.

---

# 305. Relación con ENG-024

Security gobierna:

```text
Trust
Sensitive Data
Encryption
Signatures
Secrets
Redaction
```

Serialization deberá proporcionar representaciones seguras para estos mecanismos.

---

# 306. Relación con ENG-025

Observability podrá medir Serialization sin registrar Payload sensible.

---

# 307. Relación con ENG-026

Performance Engineering evaluará:

```text
latency
throughput
allocations
payload size
```

---

# 308. Relación con ENG-027

Runtime podrá registrar Codecs/Schemas requeridos durante Bootstrap.

---

# 309. Relación con ENG-028

Modules podrán:

```text
own schemas
require serializers
publish serialized contracts
```

sin exponer sus modelos internos.

---

# 310. Relación con ENG-029

Codecs adicionales podrán incorporarse mediante Extensions gobernadas.

---

# 311. Relación con ENG-030

Persistence podrá utilizar Serialization para:

```text
documents
JSON columns
snapshots
outbox
cache
```

pero el Stored Model seguirá siendo responsabilidad de Persistence Engineering.

---

# 312. Principio Rector

> **MEF deberá serializar Contracts, no implementaciones: toda representación que cruce una Boundary deberá ser explícita, versionable, validable, limitada y segura, preservando significado sin revelar accidentalmente la estructura interna del Runtime.**

---

# 313. Conclusión

**ENG-031 — Serialization Engineering** formaliza cómo MEF convierte información estructurada en representaciones intercambiables.

La cadena fundamental queda:

```text
Domain / Internal Model
          │
          ▼
       Mapper
          │
          ▼
    Contract Model
          │
          ▼
        Schema
          │
          ▼
      Serializer
          │
          ▼
        Codec
          │
          ▼
      Text / Bytes
```

y en sentido inverso:

```text
Text / Bytes
     │
     ▼
   Codec
     │
     ▼
 Validation
     │
     ▼
Deserializer
     │
     ▼
Contract Model
```

La separación arquitectónica queda:

```text
Contract
→ defines meaning

Schema
→ defines structure

Serializer
→ transforms data

Codec
→ defines representation

Canonicalizer
→ produces deterministic representation

Compatibility
→ governs evolution
```

MEF evita así que:

```text
PHP class
Java class
TypeScript object
database entity
ORM model
```

se conviertan accidentalmente en Protocol Contracts.

La primera implementación deberá concentrarse en:

```text
JSON
UTF-8
Explicit Schemas
Safe Deserialization
Validation
Type Mapping
Payload Limits
Schema Compatibility
Canonicalization
```

antes de introducir:

```text
Binary Protocols
Remote Schema Registries
Dynamic Codecs
Zero-Copy Serialization
Schema Federation
```

Con ENG-031 la serie global alcanza:

```text
EI-585
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-003 — Manifest
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado
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