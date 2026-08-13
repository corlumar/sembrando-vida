---
id: ENG-063
titulo: Data Transformation Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Transformation Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-031
  - ENG-034
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-041
  - ENG-043
  - ENG-044
  - ENG-056
  - ENG-057
  - ENG-058
  - ENG-059
  - ENG-061
  - ENG-062
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
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-030
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-037
  - ENG-040
  - ENG-042
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-049
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-060
  - ENG-064
keywords:
  - data-transformation
  - transformation
  - mapper
  - converter
  - normalizer
  - enricher
  - filter
  - projector
  - aggregator
  - splitter
  - merger
  - mapping
  - pipeline
  - deterministic-transformation
  - lossless
  - lossy
  - batch-transformation
  - streaming-transformation
  - transformation-registry
  - transformation-version
  - mef
---

# ENG-063

# Data Transformation Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Transformation Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-063 establece las reglas para:

```text
Transformation
Transformation Definition
Transformation Identity
Transformation Version
Transformation Pipeline

Source Model
Target Model

Mapper
Converter
Normalizer
Enricher
Filter
Projector
Aggregator
Splitter
Merger

Transformation Context
Transformation Input
Transformation Output

Field Mapping
Type Conversion
Value Mapping
Code Mapping

Transformation Validation
Transformation Composition

Deterministic Transformation
Lossless Transformation
Lossy Transformation
Reversible Transformation

Transformation Compatibility
Transformation Migration

Transformation Error
Partial Transformation

Batch Transformation
Streaming Transformation

Transformation Registry
Transformation Discovery
Transformation Resolution

Transformation Security
Transformation Audit
Transformation Observability
Transformation Testing
```

---

# 2. Declaración

> **Toda transformación gobernada por MEF deberá declarar explícitamente su Source, Target, Identity, Version, comportamiento ante pérdida de información y Failure Semantics; las transformaciones deberán ser determinísticas siempre que su Contract lo requiera y ningún Mapping, Conversion, Normalization o Enrichment deberá alterar silenciosamente el significado de los datos.**

Arquitectura conceptual:

```text
SOURCE
   │
   ▼
VALIDATE
   │
   ▼
TRANSFORMATION
   │
   ├── map
   ├── convert
   ├── normalize
   ├── filter
   ├── enrich
   ├── aggregate
   └── project
   │
   ▼
VALIDATE
   │
   ▼
TARGET
```

---

# 3. Data Transformation Engineering

Responde:

```text
How does data change shape?
How are fields mapped?
How are types converted?
How are values translated?
How is data normalized?
How is data enriched?
Which information is discarded?
Is the transformation reversible?
Is it deterministic?
Which version performed it?
Can transformations be composed?
How are transformation failures handled?
```

---

# 4. Transformation

Una `Transformation` convierte Data de una representación o modelo Source hacia una representación o modelo Target.

Conceptualmente:

```text
T : Source → Target
```

---

# 5. Transformation ≠ Serialization

Serialization:

```text
Object → bytes/text
```

Transformation:

```text
Model A → Model B
```

---

# 6. Transformation ≠ Validation

Validation responde:

```text
Is this data valid?
```

Transformation responde:

```text
How should this data change?
```

---

# 7. Transformation ≠ Schema

Schema define estructura válida.

Transformation convierte entre estructuras.

---

# 8. Transformation ≠ Interoperability

ENG-061 gobierna la Boundary entre sistemas.

ENG-063 gobierna la transformación de Data que puede ocurrir dentro de esa Boundary.

---

# 9. Transformation ≠ Business Workflow

Transformation no deberá convertirse en motor de procesos.

ENG-052 gobierna Workflow.

---

# 10. Transformation ≠ Domain Behavior

Las reglas de negocio críticas deberán permanecer en Domain/Policy.

---

# 11. Transformation Identity

Toda Transformation reutilizable deberá poseer Identity estable.

Ejemplo:

```text
customer.external-to-canonical
order.v1-to-v2
currency.minor-units
```

---

# 12. Transformation Namespace

Deberá evitar colisiones.

Ejemplo:

```text
mef.transform.*
application.transform.*
plugin.vendor.transform.*
```

---

# 13. Transformation Version

Toda Transformation cuyo comportamiento pueda evolucionar deberá poseer Version.

---

# 14. Version Independence

Transformation Version deberá poder evolucionar independientemente de:

```text
Application Version
Schema Version
API Version
Plugin Version
Framework Version
```

---

# 15. Transformation Definition

Deberá describir:

```text
identity
version
source
target
steps
lossiness
determinism
failure semantics
metadata
```

---

# 16. Source Model

Define el modelo esperado como Input.

---

# 17. Target Model

Define el modelo producido como Output.

---

# 18. Source Schema

Podrá utilizar ENG-062.

---

# 19. Target Schema

Podrá utilizar ENG-062.

---

# 20. Source Validation

Input deberá validarse cuando la Boundary no garantice previamente su validez.

---

# 21. Target Validation

Output podrá validarse contra Target Contract.

---

# 22. Mapper

Realiza correspondencia estructural.

Ejemplo:

```text
source.first_name
        │
        ▼
target.firstName
```

---

# 23. Field Mapping

Deberá declarar explícitamente:

```text
source
target
operation
required
default
lossiness
```

---

# 24. Direct Mapping

```text
A.x → B.x
```

---

# 25. Rename Mapping

```text
first_name → firstName
```

---

# 26. Nested Mapping

```text
address.city → location.city
```

---

# 27. Multi-Source Mapping

Podrá combinar varios valores:

```text
firstName
lastName
   │
   ▼
fullName
```

---

# 28. Multi-Target Mapping

Podrá dividir un valor:

```text
fullName
   │
   ├── firstName
   └── lastName
```

Deberá reconocer ambigüedad cuando no exista transformación exacta.

---

# 29. Converter

Convierte un Type o representación.

Ejemplos:

```text
string → integer
string → UUID
string → datetime
decimal → minor currency units
```

---

# 30. Type Conversion

Deberá definir:

```text
sourceType
targetType
range
precision
overflow
failure
```

---

# 31. Numeric Conversion

No deberá truncar o desbordar silenciosamente.

---

# 32. Decimal Conversion

Deberá preservar precisión según Contract.

---

# 33. Date Conversion

Deberá distinguir:

```text
date
local datetime
offset datetime
instant
```

---

# 34. Timezone Conversion

Deberá poseer Source y Target Timezone conocidos cuando sea necesaria.

---

# 35. Unit Conversion

Deberá declarar unidad Source y Target.

---

# 36. Currency Conversion

No deberá confundirse con Unit Conversion.

Implica normalmente Rate, Currency y Effective Time.

---

# 37. Normalizer

Convierte valores equivalentes a representación canónica.

Ejemplos:

```text
trim whitespace
Unicode normalization
case normalization
phone normalization
identifier normalization
```

---

# 38. Normalization Idempotency

Cuando sea posible:

```text
normalize(normalize(x)) = normalize(x)
```

---

# 39. Normalization ≠ Correction

No deberá inventar información faltante.

---

# 40. Enricher

Agrega información derivada o recuperada.

```text
Input
  │
  ▼
Enrichment Source
  │
  ▼
Enriched Output
```

---

# 41. Pure Enrichment

Deriva información únicamente del Input.

---

# 42. External Enrichment

Consulta una dependencia externa.

Deberá declarar Side Effects, Timeout, Failure y Reproducibility implications.

---

# 43. Deterministic Enrichment

Solo podrá declararse Deterministic si las fuentes necesarias están fijadas o versionadas.

---

# 44. Filter

Elimina elementos conforme a Predicate explícito.

---

# 45. Filter Lossiness

Todo Filter que descarte información deberá considerarse potencialmente Lossy.

---

# 46. Projector

Selecciona subconjunto o nueva vista de datos.

---

# 47. Projection

Ejemplo:

```text
Customer
├── id
├── name
├── email
├── address
└── internalScore

        │
        ▼

PublicCustomer
├── id
├── name
└── email
```

---

# 48. Aggregator

Combina múltiples elementos.

Ejemplo:

```text
Transactions[]
      │
      ▼
sum(amount)
      │
      ▼
Total
```

---

# 49. Aggregation Semantics

Deberá declarar:

```text
grouping
ordering
window
precision
empty input
null handling
```

---

# 50. Splitter

Produce múltiples Outputs desde un Input.

---

# 51. Merger

Combina múltiples Inputs.

---

# 52. Merge Conflict

Deberá poseer Policy explícita.

Ejemplos:

```text
SOURCE_WINS
TARGET_WINS
LATEST_WINS
ERROR
CUSTOM
```

---

# 53. Latest Wins

No deberá utilizarse sin definición confiable de Ordering/Time.

---

# 54. Value Mapping

Traduce valores conocidos.

```text
"A" → ACTIVE
"I" → INACTIVE
```

---

# 55. Code Mapping

Mapea códigos entre sistemas o vocabularios.

---

# 56. Unknown Code

Deberá seguir Policy explícita:

```text
REJECT
PRESERVE
MAP_TO_UNKNOWN
IGNORE
```

---

# 57. Mapping Table

Deberá poder versionarse.

---

# 58. Mapping Collision

Dos Source Values no deberán mapear accidentalmente al mismo Target cuando Contract requiera reversibilidad.

---

# 59. Transformation Context

Podrá contener información necesaria para ejecutar la Transformation.

Ejemplos:

```text
locale
timezone
tenant
correlation
schema version
mapping version
```

---

# 60. Context Minimization

Solo deberá incluir información necesaria.

---

# 61. Transformation Context ≠ Global State

No deberá depender de estado global mutable implícito.

---

# 62. Transformation Input

Deberá poseer Contract conocido.

---

# 63. Transformation Output

Deberá poseer Contract conocido.

---

# 64. Transformation Result

Conceptualmente:

```text
TransformationResult
├── output
├── warnings
├── errors
├── metadata
└── partial
```

---

# 65. Deterministic Transformation

Para mismos:

```text
Input
Transformation Version
Context
Dependencies
```

deberá producir Output equivalente.

---

# 66. Non-Deterministic Transformation

Deberá declararse explícitamente.

---

# 67. Hidden Non-Determinism

Deberá evitarse.

Ejemplos:

```text
current time
random values
unordered iteration
mutable global state
unversioned external lookup
```

---

# 68. Transformation Purity

Transformations puras deberán favorecerse.

---

# 69. Side Effects

No deberán ocultarse dentro de Mapping básico.

---

# 70. Lossless Transformation

Preserva toda información necesaria para reconstruir Source conforme al Contract.

---

# 71. Lossy Transformation

Descarta, redondea, agrega o modifica información irreversiblemente.

---

# 72. Lossiness Declaration

Toda Transformation Lossy deberá declararlo.

---

# 73. Reversible Transformation

Deberá poseer operación inversa definida.

Conceptualmente:

```text
T⁻¹(T(x)) = x
```

dentro del Domain válido definido.

---

# 74. Reversible ≠ Lossless Automatically

La reversibilidad depende del Scope y Contract.

---

# 75. Round-Trip Test

Transformations reversibles deberán probar Round-Trip.

---

# 76. Transformation Composition

Transformations podrán componerse.

```text
A ─T1→ B ─T2→ C
```

---

# 77. Composition Result

```text
T3 = T2 ∘ T1
```

---

# 78. Composition Compatibility

Target de una etapa deberá ser compatible con Source de la siguiente.

---

# 79. Composition Validation

Deberá ocurrir antes de ejecutar Pipeline crítico cuando sea posible.

---

# 80. Transformation Pipeline

Representa secuencia ordenada de Transformations.

```text
Input
 │
 ▼
T1
 │
 ▼
T2
 │
 ▼
T3
 │
 ▼
Output
```

---

# 81. Pipeline Identity

Pipelines reutilizables deberán poseer Identity.

---

# 82. Pipeline Version

Deberá versionarse cuando cambie comportamiento observable.

---

# 83. Pipeline Step

Deberá identificar Transformation y Version.

---

# 84. Floating Step Version

No deberá utilizarse en Pipelines reproducibles.

---

# 85. Pipeline Determinism

Dependerá del determinismo de todos sus Steps y Dependencies.

---

# 86. Pipeline Failure

Deberá identificar Step causante.

---

# 87. Fail Fast

Podrá utilizarse cuando Output parcial no tenga valor contractual.

---

# 88. Continue on Error

Solo deberá utilizarse cuando Partial Transformation esté explícitamente soportada.

---

# 89. Partial Transformation

Produce Output incompleto o parcialmente exitoso.

---

# 90. Partial Result

Deberá distinguir:

```text
successful items
failed items
warnings
```

---

# 91. Partial ≠ Success

No deberá reportarse como Success completo.

---

# 92. Atomic Transformation

Podrá requerir:

```text
all transformed
or
none accepted
```

---

# 93. Transactional Transformation

Si existen Side Effects deberá coordinarse con ENG-042.

---

# 94. Transformation Error

Deberá seguir ENG-023.

---

# 95. Error Categories

Podrán incluir:

```text
INVALID_INPUT
MAPPING_FAILURE
CONVERSION_FAILURE
NORMALIZATION_FAILURE
ENRICHMENT_FAILURE
TARGET_VALIDATION_FAILURE
LOSSINESS_VIOLATION
PIPELINE_FAILURE
```

---

# 96. Field Error

Deberá poder identificar Path sin exponer datos sensibles.

---

# 97. Conversion Failure

No deberá reemplazarse silenciosamente por Default salvo Contract explícito.

---

# 98. Transformation Warning

Podrá representar:

```text
deprecated mapping
lossy conversion
unknown optional value
precision reduction
fallback used
```

---

# 99. Transformation Compatibility

Determina si una nueva Transformation Version conserva comportamiento contractual esperado.

---

# 100. Transformation Compatibility Dimensions

Podrán incluir:

```text
source compatibility
target compatibility
mapping compatibility
semantic compatibility
lossiness compatibility
error compatibility
```

---

# 101. Mapping Change

Puede ser Breaking aunque Source y Target Schemas no cambien.

---

# 102. Semantic Change

Ejemplo:

```text
status "P" → PENDING
```

cambiado a:

```text
status "P" → PROCESSING
```

es Breaking semántico aunque Types permanezcan iguales.

---

# 103. Transformation Evolution

Todo cambio deberá analizar:

```text
input contract
output contract
mapping
conversion
defaults
lossiness
errors
determinism
```

---

# 104. Transformation Diff

Podrá representar:

```text
added mappings
removed mappings
changed mappings
changed converters
changed defaults
changed lossiness
changed failure semantics
```

---

# 105. Transformation Migration

Podrá ser necesaria para reproducir o actualizar Outputs históricos.

---

# 106. Historical Reprocessing

Deberá utilizar la Transformation Version correspondiente cuando se requiera reproducibilidad histórica.

---

# 107. Transformation Registry

Mantiene Transformations conocidas.

Conceptualmente:

```text
TransformationRegistry
├── register
├── get
├── versions
├── resolve
└── metadata
```

---

# 108. Registration Identity

Deberá incluir:

```text
identity
version
source
target
```

cuando sea necesario para evitar ambigüedad.

---

# 109. Duplicate Registration

Misma Identity + Version con Definition diferente deberá rechazarse.

---

# 110. Published Transformation

No deberá modificarse silenciosamente.

---

# 111. Transformation Discovery

Deberá utilizar ENG-058.

---

# 112. Discovery Sources

Podrán incluir:

```text
core
modules
plugins
application
generated registry
configuration
```

---

# 113. Transformation Resolution

Deberá utilizar ENG-059.

---

# 114. Resolution Inputs

Podrán incluir:

```text
transformation id
version
source type
target type
schema versions
capabilities
```

---

# 115. Resolution Determinism

No deberá depender de Registration Order.

---

# 116. Ambiguous Transformation

Deberá fallar explícitamente.

---

# 117. Transformation Priority

Solo deberá utilizarse cuando Contract defina su semántica.

---

# 118. Automatic Conversion

No deberá seleccionarse mediante coerciones implícitas peligrosas.

---

# 119. Batch Transformation

Procesa múltiples Inputs.

---

# 120. Batch Contract

Deberá declarar:

```text
batch size
ordering
partial failure
atomicity
parallelism
```

---

# 121. Batch Ordering

No deberá asumirse preservado salvo Contract.

---

# 122. Batch Parallelism

Deberá respetar ENG-038 y ENG-054.

---

# 123. Batch Failure

Podrá utilizar:

```text
FAIL_FAST
COLLECT_ERRORS
PARTIAL
```

---

# 124. Streaming Transformation

Procesa Data incrementalmente.

---

# 125. Streaming Contract

Deberá declarar:

```text
framing
ordering
backpressure
state
checkpointing
failure
```

---

# 126. Stateful Transformation

Deberá declarar State explícitamente.

---

# 127. Stateless Transformation

Deberá favorecerse cuando sea suficiente.

---

# 128. Stream Ordering

No deberá asumirse globalmente.

---

# 129. Stream Backpressure

Deberá integrarse con Transport/Messaging cuando corresponda.

---

# 130. Streaming Failure

Deberá definir si:

```text
stream stops
item rejected
item quarantined
retry occurs
```

---

# 131. Transformation Caching

Podrá utilizar ENG-037 para Transformations puras y determinísticas.

---

# 132. Cache Eligibility

Deberá considerar:

```text
determinism
context
version
sensitivity
dependencies
```

---

# 133. Cache Key

Deberá incluir toda información que afecte Output.

---

# 134. Non-Deterministic Transformation Cache

No deberá cachearse como si fuera pura.

---

# 135. Transformation Security

ENG-024 gobernará Security general.

---

# 136. Untrusted Input

Deberá validarse antes de Transformations sensibles.

---

# 137. Expression Transformation

Si se permiten Expressions configurables deberán utilizar lenguaje restringido.

---

# 138. Arbitrary Code Execution

No deberá permitirse mediante Mapping Configuration.

---

# 139. Template Injection

Deberá evitarse.

---

# 140. Path Injection

Dynamic Field Paths deberán validarse.

---

# 141. Resource Exhaustion

Deberán limitarse:

```text
input size
output size
nesting
iterations
pipeline depth
batch size
```

---

# 142. Expansion Ratio

Transformations capaces de amplificar Data deberán poseer límites.

---

# 143. Sensitive Fields

No deberán copiarse automáticamente hacia Target menos confiable.

---

# 144. Classification-Aware Transformation

Podrá utilizar Metadata de ENG-057 para aplicar Policies.

---

# 145. Tenant Isolation

Transformations multi-tenant deberán respetar ENG-048.

---

# 146. Context Spoofing

Tenant o Identity recibidos desde Input no deberán confiarse automáticamente.

---

# 147. External Enrichment Security

Deberá aplicar ENG-061 y ENG-024.

---

# 148. Transformation Audit

Transformations sensibles deberán poder auditarse.

---

# 149. Audit Record

Podrá contener:

```text
transformationId
version
source
target
actor
result
lossy
correlation
timestamp
```

---

# 150. Audit Payload

No deberá almacenar Input/Output completo por Default.

---

# 151. Transformation Observability

ENG-025 gobernará Telemetry.

---

# 152. Metrics

Podrán incluir:

```text
mef.transform.total
mef.transform.duration
mef.transform.failure.total
mef.transform.partial.total
mef.transform.lossy.total
mef.transform.pipeline.failure.total
mef.transform.resolution.failure.total
```

---

# 153. Metric Labels

Podrán incluir:

```text
operation
result
failureType
sourceClass
targetClass
```

cuando Cardinality esté controlada.

---

# 154. Transformation ID as Label

No deberá utilizarse indiscriminadamente cuando sea dinámico.

---

# 155. Logging

Podrá incluir:

```text
transformationId
version
sourceType
targetType
duration
result
correlationId
```

---

# 156. Payload Logging

Deberá permanecer deshabilitado por Default para información sensible.

---

# 157. Diagnostics

Deberá poder responder:

```text
which transformation?
which version?
which source?
which target?
which mappings?
which converter?
which pipeline step failed?
was transformation lossy?
was fallback used?
was output partial?
```

---

# 158. Provenance

Outputs críticos podrán registrar Transformation Provenance.

---

# 159. Transformation Provenance

Podrá contener:

```text
transformationId
version
sourceSchema
targetSchema
mappingVersion
timestamp
```

---

# 160. Provenance ≠ Full Audit Payload

No deberá requerir almacenar Data completa.

---

# 161. Testing

ENG-009 gobernará Testing.

---

# 162. Mapper Test

Deberá comprobar Field Mapping.

---

# 163. Converter Test

Deberá comprobar:

```text
valid conversion
invalid conversion
overflow
precision
boundary values
```

---

# 164. Normalizer Test

Deberá comprobar Idempotency cuando sea Contract.

---

# 165. Filter Test

Deberá comprobar Predicate y Lossiness.

---

# 166. Enricher Test

Deberá controlar Dependencies.

---

# 167. Aggregator Test

Deberá comprobar:

```text
empty
single
multiple
null
ordering
precision
```

---

# 168. Splitter Test

Deberá comprobar reconstrucción cuando se declare reversible.

---

# 169. Merger Test

Deberá comprobar Conflicts.

---

# 170. Value Mapping Test

Deberá cubrir todos los códigos conocidos y Unknown Policy.

---

# 171. Determinism Test

Mismo Input/Context deberá producir Output equivalente.

---

# 172. Lossless Test

Deberá comprobar preservación contractual.

---

# 173. Lossy Test

Deberá comprobar pérdida esperada y declarada.

---

# 174. Round-Trip Test

Deberá utilizarse para Transformations reversibles.

---

# 175. Composition Test

Deberá comprobar compatibilidad entre Steps.

---

# 176. Pipeline Test

Deberá identificar Step Failure correctamente.

---

# 177. Partial Transformation Test

Deberá distinguir Success, Partial y Failure.

---

# 178. Batch Test

Deberá cubrir:

```text
ordering
parallelism
partial failure
atomicity
```

---

# 179. Streaming Test

Deberá cubrir:

```text
backpressure
ordering
state
failure
checkpoint
```

---

# 180. Security Test

Deberá intentar:

```text
expression injection
template injection
path injection
resource exhaustion
expansion attack
tenant spoofing
sensitive field leakage
```

---

# 181. Compatibility Test

Deberá detectar cambios semánticos aun cuando Schemas permanezcan iguales.

---

# 182. Historical Reprocessing Test

Deberá comprobar que Version fija reproduce comportamiento esperado.

---

# 183. Registry Test

Deberá comprobar:

```text
registration
duplicates
immutability
resolution
ambiguity
```

---

# 184. Architecture Test

Podrá impedir:

```text
unversioned published transformation
implicit vendor mapping in Domain
arbitrary code execution in mapping
hidden external enrichment
floating transformation version
silent lossy conversion
```

---

# 185. Build Integration

ENG-012 podrá validar:

```text
invalid transformation
duplicate identity
missing version
source/target mismatch
invalid composition
ambiguous resolution
missing converter
undeclared lossiness
floating pipeline step
```

---

# 186. CLI

ENG-007 podrá proporcionar:

```text
mef transform:list
mef transform:show
mef transform:validate
mef transform:run
mef transform:diff
mef transform:pipeline
mef transform:resolve
mef transform:diagnose
```

---

# 187. `transform:list`

Podrá mostrar:

```text
identity
version
source
target
lossy
deterministic
```

---

# 188. `transform:show`

Podrá mostrar Definition completa.

---

# 189. `transform:validate`

Podrá validar Definition y Composition.

---

# 190. `transform:run`

Podrá ejecutar Transformation en entorno controlado.

---

# 191. Dry Run

Deberá favorecerse para Transformations con Side Effects o Data crítica.

---

# 192. `transform:diff`

Podrá comparar versiones.

---

# 193. `transform:pipeline`

Podrá mostrar:

```text
Input
 ↓
T1
 ↓
T2
 ↓
T3
 ↓
Output
```

---

# 194. `transform:resolve`

Podrá explicar selección de Transformation.

---

# 195. `transform:diagnose`

Podrá mostrar:

```text
identity
version
source
target
pipeline
lossiness
determinism
dependencies
last failure
```

---

# 196. Registry Integration

ENG-020 podrá registrar:

```text
TransformationDefinition
Mapper
Converter
Normalizer
Enricher
TransformationPipeline
```

---

# 197. Transformation Contract

Conceptualmente:

```text
Transformation
├── identity
├── version
├── source
├── target
├── transform
├── deterministic
├── lossy
└── metadata
```

---

# 198. Mapper Contract

Conceptualmente:

```text
Mapper<S,T>
└── map(S, Context): T
```

---

# 199. Converter Contract

Conceptualmente:

```text
Converter<S,T>
├── supports(S,T)
└── convert(S, Context): T
```

---

# 200. Transformation Pipeline Contract

Conceptualmente:

```text
TransformationPipeline
├── identity
├── version
├── steps
├── execute
└── metadata
```

---

# 201. Transformation Registry Contract

Conceptualmente:

```text
TransformationRegistry
├── register
├── resolve
├── versions
└── metadata
```

---

# 202. Bootstrap

ENG-027 deberá validar Transformations críticas antes de Runtime Ready.

---

# 203. Bootstrap Flow

```text
Transformation Sources
        │
        ▼
     Discovery
        │
        ▼
Definition Validation
        │
        ▼
Source/Target Resolution
        │
        ▼
Composition Validation
        │
        ▼
Registry
        │
        ▼
Critical Pipeline Validation
        │
        ▼
Runtime Ready
```

---

# 204. Bootstrap Failure

Podrá impedir Readiness ante:

```text
invalid critical transformation
missing converter
missing schema
ambiguous transformation
invalid pipeline
incompatible pipeline steps
```

---

# 205. First Implementation Components

La primera implementación deberá incluir:

```text
TransformationId
TransformationVersion
TransformationDefinition

Transformation
TransformationContext
TransformationResult

Mapper
Converter
Normalizer

FieldMapping
ValueMapping

TransformationPipeline
TransformationStep

TransformationRegistry

TransformationError
TransformationException
```

---

# 206. Optional Initial Components

Podrán incorporarse:

```text
Enricher
Filter
Projector
Aggregator
Splitter
Merger

TransformationDiff
TransformationDiagnostics
TransformationProvenance
```

---

# 207. Later Components

Solo cuando exista necesidad demostrada:

```text
Visual Mapping Designer
Distributed Transformation Engine
Automatic Mapping Inference
Automatic Transformation Generation
Transformation Marketplace
AI-Assisted Mapping
```

---

# 208. Estructura Conceptual de Directorios

```text
src/
└── Transformation/
    ├── Identity/
    │   ├── TransformationId
    │   └── TransformationVersion
    │
    ├── Definition/
    │   └── TransformationDefinition
    │
    ├── Contract/
    │   ├── Transformation
    │   ├── Mapper
    │   ├── Converter
    │   └── Normalizer
    │
    ├── Mapping/
    │   ├── FieldMapping
    │   └── ValueMapping
    │
    ├── Operation/
    │   ├── Enricher
    │   ├── Filter
    │   ├── Projector
    │   ├── Aggregator
    │   ├── Splitter
    │   └── Merger
    │
    ├── Pipeline/
    │   ├── TransformationPipeline
    │   └── TransformationStep
    │
    ├── Runtime/
    │   ├── TransformationContext
    │   └── TransformationResult
    │
    ├── Registry/
    │   └── TransformationRegistry
    │
    ├── Compatibility/
    │   └── TransformationDiff
    │
    ├── Diagnostics/
    │   ├── TransformationDiagnostics
    │   └── TransformationProvenance
    │
    └── Error/
        ├── TransformationError
        └── TransformationException
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 209. Error Namespace

ENG-063 utilizará:

```text
MEF-TRANSFORM-xxx
```

---

# 210. Taxonomía ENG-063

```text
MEF-TRANSFORM-001 Transformation identifier invalid
MEF-TRANSFORM-002 Transformation duplicate
MEF-TRANSFORM-003 Transformation version invalid
MEF-TRANSFORM-004 Transformation definition invalid
MEF-TRANSFORM-005 Source contract invalid
MEF-TRANSFORM-006 Target contract invalid
MEF-TRANSFORM-007 Mapping invalid
MEF-TRANSFORM-008 Mapping failed
MEF-TRANSFORM-009 Conversion failed
MEF-TRANSFORM-010 Conversion overflow
MEF-TRANSFORM-011 Conversion precision loss
MEF-TRANSFORM-012 Normalization failed
MEF-TRANSFORM-013 Enrichment failed
MEF-TRANSFORM-014 Unknown mapping value
MEF-TRANSFORM-015 Lossiness violation
MEF-TRANSFORM-016 Target validation failed
MEF-TRANSFORM-017 Pipeline invalid
MEF-TRANSFORM-018 Pipeline step failed
MEF-TRANSFORM-019 Partial transformation
MEF-TRANSFORM-020 Transformation resolution failed
MEF-TRANSFORM-021 Transformation ambiguous
MEF-TRANSFORM-022 Transformation incompatible
MEF-TRANSFORM-023 Transformation immutable
MEF-TRANSFORM-024 Batch transformation failed
MEF-TRANSFORM-025 Streaming transformation failed
MEF-TRANSFORM-026 Transformation resource limit exceeded
MEF-TRANSFORM-027 Transformation security violation
MEF-TRANSFORM-028 Sensitive data transformation violation
MEF-TRANSFORM-029 Transformation context invalid
MEF-TRANSFORM-030 Transformation invariant violation
```

---

# 211. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Source
Explicit Target
Transformation Identity
Transformation Version

Mapper
Converter
Normalizer

Field Mapping
Value Mapping

Deterministic Transformations
Lossiness Declaration

Transformation Context
Transformation Result

Pipeline Composition
Failure Semantics

Registry
Discovery
Resolution

Security
Diagnostics
Testing
```

---

# 212. First Version Non-Goals

No deberá requerir:

```text
Visual Mapping Designer
Distributed Transformation Engine
Automatic Mapping Inference
Automatic Transformation Generation
Transformation Marketplace
AI-Assisted Mapping
```

---

# 213. Second Phase

Podrá incorporar:

```text
Enrichers
Filters
Projectors
Aggregators
Splitters
Mergers

Advanced Pipelines
Batch Processing
Streaming Processing
Transformation Provenance
Transformation Diff
```

---

# 214. Third Phase

Solo cuando exista necesidad demostrada:

```text
Distributed Transformation
Visual Mapping
Automatic Mapping Inference
Cross-Language Mapping Generation
Transformation Marketplace
AI-Assisted Transformation
```

---

# 215. Invariantes de Ingeniería

ENG-063 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1206 | Toda Transformation reutilizable o contractual deberá poseer Identity, Version, Source, Target, Failure Semantics, Determinism y Lossiness explícitos. |
| EI-1207 | Transformation, Validation, Serialization, Schema, Interoperability, Workflow y Domain Behavior deberán permanecer como responsabilidades separadas y ninguna Transformation deberá convertirse silenciosamente en motor de reglas de negocio o procesos. |
| EI-1208 | Field Mapping, Type Conversion, Value Mapping y Code Mapping deberán ser explícitos y ningún valor deberá truncarse, redondearse, descartarse, reinterpretarse o reemplazarse por Default silenciosamente cuando altere semántica contractual. |
| EI-1209 | Required Transformation Context deberá ser explícito y ninguna Transformation contractual deberá depender de Global Mutable State, Time, Randomness, Ordering o External Lookup no declarados. |
| EI-1210 | Una Transformation declarada Deterministic deberá producir Output equivalente para el mismo Input, Version, Context y Dependencies y cualquier fuente de Non-Determinism deberá declararse o eliminarse. |
| EI-1211 | Toda Transformation Lossy deberá declarar su Lossiness y ninguna operación de Filtering, Projection, Aggregation, Precision Reduction o Information Discarding deberá presentarse como Lossless. |
| EI-1212 | Toda Transformation declarada Reversible deberá poseer Inverse Contract y Round-Trip Tests dentro del Domain válido definido. |
| EI-1213 | Transformation Composition deberá validar que Target de cada Step sea compatible con Source del siguiente y Pipelines reproducibles deberán fijar Version de cada Step. |
| EI-1214 | Partial Transformation deberá distinguir Outputs exitosos, fallidos y Warnings y nunca deberá reportarse como Success completo cuando el Contract requiera Atomicity. |
| EI-1215 | Transformation Errors deberán conservar Category y Path suficientes para Diagnostics sin exponer Payloads sensibles y Conversion Failures no deberán convertirse silenciosamente en Defaults. |
| EI-1216 | Cambios de Mapping, Conversion, Defaults, Lossiness, Determinism o Error Semantics deberán evaluarse como posibles Breaking Changes aun cuando Source y Target Schemas permanezcan sin cambios. |
| EI-1217 | Transformations publicadas deberán ser inmutables y registrar misma Identity y Version con comportamiento diferente deberá rechazarse. |
| EI-1218 | Transformation Discovery y Resolution deberán ser determinísticos y ninguna Transformation crítica deberá resolverse mediante Registration Order, coerción implícita o Floating Version. |
| EI-1219 | Batch y Streaming Transformations deberán declarar Ordering, Partial Failure, Parallelism, Backpressure, State y Atomicity según corresponda y no asumir garantías inexistentes. |
| EI-1220 | Transformation Caching solo deberá aplicarse cuando Determinism, Context, Version, Dependencies y Sensitivity permitan construir una Cache Key correcta y estable. |
| EI-1221 | Transformation Security deberá impedir Arbitrary Code Execution, Expression Injection, Template Injection, Path Injection, Resource Exhaustion, Expansion Attacks, Tenant Spoofing y Sensitive Data Leakage. |
| EI-1222 | Transformation Audit, Provenance y Observability deberán permitir identificar Transformation, Version, Source, Target, Result, Lossiness y Pipeline Failure sin almacenar Payloads sensibles por Default. |
| EI-1223 | Transformation Testing deberá cubrir Mapping, Conversion, Normalization, Enrichment, Filtering, Aggregation, Splitting, Merging, Determinism, Lossiness, Reversibility, Composition, Partial Results, Batch, Streaming, Security y Compatibility según las capacidades utilizadas. |
| EI-1224 | Build y Architecture Tests deberán detectar Transformations públicas sin Version, Floating Pipeline Steps, Invalid Composition, Ambiguous Resolution, Hidden External Enrichment, Silent Lossy Conversion, Arbitrary Mapping Code y Vendor Mapping Leakage hacia Domain. |
| EI-1225 | La primera implementación deberá priorizar Identity, Version, Source/Target Contracts, Mapper, Converter, Normalizer, Field/Value Mapping, Determinism, Lossiness, Pipeline Composition, Registry, Discovery y Resolution antes de introducir Visual Mapping, Distributed Transformation o Automatic Mapping Generation. |

---

# 216. Continuidad de Invariantes

```text
ENG-059 → EI-1126 a EI-1145
ENG-060 → EI-1146 a EI-1165
ENG-061 → EI-1166 a EI-1185
ENG-062 → EI-1186 a EI-1205
ENG-063 → EI-1206 a EI-1225
```

---

# 217. Criterios de Conformidad

Una implementación será conforme con ENG-063 cuando:

- identifique Transformations;
- versione Transformations;
- declare Source;
- declare Target;
- declare Determinism;
- declare Lossiness;
- modele Field Mapping;
- modele Value Mapping;
- controle Type Conversion;
- controle Numeric Precision;
- controle Timezone y Units;
- implemente Normalization;
- diferencie Enrichment;
- controle Filters y Projections;
- controle Aggregation;
- gestione Split/Merge;
- utilice Transformation Context explícito;
- valide Composition;
- versione Pipelines;
- controle Partial Transformation;
- modele Errors;
- detecte Breaking Mapping Changes;
- preserve Published Transformation Immutability;
- implemente Registry;
- descubra Transformations;
- resuelva Transformations determinísticamente;
- controle Batch/Streaming cuando se utilicen;
- aplique Security;
- permita Diagnostics;
- implemente Tests.

---

# 218. Riesgos

Deberán evitarse especialmente:

```text
Implicit Mapping
Silent Type Coercion
Silent Truncation
Silent Precision Loss
Silent Default
Silent Lossiness
Hidden Non-Determinism
Global Mutable State
Unversioned Mapping
Floating Pipeline Step
Invalid Composition
Business Logic in Mapper
External Calls Hidden in Mapper
Unknown Code Silently Ignored
Ambiguous Transformation
Registration Order Resolution
Partial Reported as Success
Sensitive Field Leakage
Expression Injection
Template Injection
Path Injection
Expansion Attack
Resource Exhaustion
Vendor Mapping Leakage
```

---

# 219. Relación con ENG-031

Serialization responde:

```text
How is a representation encoded?
```

Transformation responde:

```text
How does the representation or model change?
```

---

# 220. Relación con ENG-036

Validation:

```text
Input → valid / invalid
```

Transformation:

```text
Source → Target
```

Validation puede existir antes y después de Transformation.

---

# 221. Relación con ENG-043

Data Access podrá utilizar Transformations para separar:

```text
Storage Model
      │
      ▼
Domain/Application Model
```

sin convertir el Mapper en Repository.

---

# 222. Relación con ENG-044

API Engineering podrá utilizar Transformations para:

```text
Application Model
      │
      ▼
API DTO
```

---

# 223. Relación con ENG-057

Metadata podrá describir:

```text
owner
description
sensitivity
deprecated
lossiness
```

---

# 224. Relación con ENG-058 / ENG-059

```text
Discover Transformations
          │
          ▼
Validate Candidates
          │
          ▼
Resolve Transformation
          │
          ▼
Execute
```

---

# 225. Relación con ENG-060

Plugins podrán proporcionar:

```text
Mappers
Converters
Normalizers
Enrichers
Transformation Pipelines
```

mediante Extension Points controlados.

---

# 226. Relación con ENG-061

Interoperability podrá utilizar Transformations:

```text
External Model
      │
      ▼
Interoperability Boundary
      │
      ▼
Transformation
      │
      ▼
Canonical Model
```

---

# 227. Relación con ENG-062

Schema define:

```text
What structure is valid?
```

Transformation define:

```text
How do we move from
one valid structure to another?
```

---

# 228. Relación con ENG-064

ENG-064 deberá formalizar **Data Pipeline Engineering**.

La separación propuesta será:

```text
Data Transformation Engineering
→ how individual data transformations
  and transformation compositions behave

Data Pipeline Engineering
→ how data moves through multi-stage
  processing flows at operational scale
```

ENG-064 deberá cubrir:

```text
Data Pipeline
Pipeline Definition
Pipeline Identity
Pipeline Version

Source
Sink
Stage
Processor

Batch Pipeline
Streaming Pipeline

Pipeline Execution
Pipeline Run
Pipeline State

Checkpoint
Offset
Cursor
Watermark

Partition
Parallelism
Ordering

Backpressure
Buffering
Flow Control

Retry
Replay
Reprocessing

Dead Letter
Quarantine

Exactly-Once Semantics
At-Least-Once Semantics
At-Most-Once Semantics

Pipeline Scheduling
Pipeline Trigger

Pipeline Recovery
Pipeline Resume

Data Lineage
Pipeline Provenance

Pipeline Registry
Pipeline Discovery
Pipeline Resolution

Pipeline Security
Pipeline Observability
Pipeline Testing
```

---

# 229. Principio Rector

> **MEF deberá transformar datos mediante operaciones explícitas, versionadas y verificables. Toda conversión deberá preservar o declarar la pérdida de significado, toda composición deberá validar sus Contracts y ninguna transformación deberá depender silenciosamente de estado, tiempo, servicios externos o coerciones implícitas que impidan comprender y reproducir el resultado.**

---

# 230. Conclusión

**ENG-063 — Data Transformation Engineering** formaliza cómo MEF cambia datos entre representaciones y modelos.

La arquitectura fundamental queda:

```text
SOURCE MODEL
     │
     ▼
SOURCE VALIDATION
     │
     ▼
TRANSFORMATION
     │
     ├── Mapper
     ├── Converter
     ├── Normalizer
     ├── Enricher
     ├── Filter
     ├── Projector
     ├── Aggregator
     ├── Splitter
     └── Merger
     │
     ▼
TARGET VALIDATION
     │
     ▼
TARGET MODEL
```

La composición queda:

```text
A
│
▼
T1
│
▼
B
│
▼
T2
│
▼
C
```

con la condición:

```text
Target(T1)
    │
    ▼
compatible with
    │
    ▼
Source(T2)
```

La relación entre Schema y Transformation queda:

```text
SCHEMA A
   │
   ▼
VALID SOURCE
   │
   ▼
TRANSFORMATION
   │
   ▼
VALID TARGET
   │
   ▼
SCHEMA B
```

La reproducibilidad queda:

```text
Input
+
Transformation Version
+
Context
+
Dependency Versions
        │
        ▼
Equivalent Output
```

La pérdida de información queda:

```text
Transformation
     │
     ├── LOSSLESS
     │
     └── LOSSY
           │
           ▼
     explicit declaration
```

El Pipeline de Transformation queda:

```text
INPUT
  │
  ▼
MAP
  │
  ▼
CONVERT
  │
  ▼
NORMALIZE
  │
  ▼
ENRICH
  │
  ▼
PROJECT
  │
  ▼
OUTPUT
```

La cadena reciente queda:

```text
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
    │
    ▼
SCHEMA
ENG-062
    │
    ▼
DATA TRANSFORMATION
ENG-063
```

La primera implementación deberá concentrarse en:

```text
TransformationId
TransformationVersion
TransformationDefinition

Transformation
TransformationContext
TransformationResult

Mapper
Converter
Normalizer

FieldMapping
ValueMapping

TransformationPipeline
TransformationStep

TransformationRegistry

TransformationError
TransformationException
```

antes de introducir:

```text
Visual Mapping Designer
Distributed Transformation Engine
Automatic Mapping Inference
Automatic Transformation Generation
Transformation Marketplace
AI-Assisted Mapping
```

Con **ENG-063**, la serie global alcanza:

```text
EI-1225
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
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-016 — Compatibility
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-031 — Serialization Engineering
- ENG-034 — Application Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-044 — API Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-054 — Resource Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-060 — Extension & Plugin Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-064 — Data Pipeline Engineering
```