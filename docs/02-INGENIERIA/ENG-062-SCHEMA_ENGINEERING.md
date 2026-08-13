---
id: ENG-062
titulo: Schema Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Schema Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-014
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-031
  - ENG-034
  - ENG-036
  - ENG-043
  - ENG-044
  - ENG-049
  - ENG-057
  - ENG-058
  - ENG-059
  - ENG-061
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
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-030
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-056
  - ENG-060
  - ENG-063
keywords:
  - schema
  - schema-engineering
  - schema-definition
  - schema-identifier
  - schema-namespace
  - schema-version
  - schema-field
  - schema-type
  - schema-constraint
  - schema-validation
  - schema-compatibility
  - schema-evolution
  - schema-migration
  - schema-registry
  - schema-discovery
  - schema-resolution
  - schema-generation
  - backward-compatibility
  - forward-compatibility
  - mef
---

# ENG-062

# Schema Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Schema Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-062 establece las reglas para:

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

# 2. Declaración

> **Todo Schema gobernado por MEF deberá poseer identidad, Namespace, versión y semántica explícitos; su evolución deberá evaluarse mediante reglas de Compatibility conocidas; y ningún cambio estructural deberá considerarse seguro únicamente porque una representación continúe siendo sintácticamente válida.**

Arquitectura conceptual:

```text
                 DATA CONTRACT
                      │
                      ▼
                   SCHEMA
                      │
        ┌─────────────┼─────────────┐
        ▼             ▼             ▼
    IDENTITY       VERSION        FIELDS
        │             │             │
        └─────────────┼─────────────┘
                      ▼
                 CONSTRAINTS
                      │
                      ▼
                 VALIDATION
                      │
                      ▼
               COMPATIBILITY
                      │
                      ▼
                  EVOLUTION
```

---

# 3. Schema Engineering

Schema Engineering responde:

```text
What structure is valid?
Which fields exist?
Which fields are required?
Which types are allowed?
Which constraints apply?
Which defaults exist?
Which schema version applies?
Is a new schema compatible?
How may the schema evolve?
How is a schema discovered?
How is it resolved?
How is data migrated?
```

---

# 4. Schema

Un `Schema` es una definición formal y versionable de la estructura y restricciones de una representación de datos.

---

# 5. Schema ≠ Domain Model

Un Domain Model representa conceptos y comportamiento del negocio.

Un Schema describe estructura de datos.

```text
Domain Model
    │
    X
    │
Schema
```

Podrán relacionarse, pero no deberán confundirse.

---

# 6. Schema ≠ DTO

Un DTO es una representación concreta.

Un Schema define las reglas que una representación deberá satisfacer.

---

# 7. Schema ≠ Serialization Format

JSON, XML, YAML, Protobuf o Avro son formatos o tecnologías.

Un Schema describe estructura independientemente de que pueda expresarse mediante uno de ellos.

---

# 8. Schema ≠ Validation Rule Set

Validation podrá utilizar un Schema.

Sin embargo, ENG-036 gobierna Validation general.

ENG-062 gobierna estructura, evolución y compatibilidad del Schema.

---

# 9. Schema Scope

Un Schema deberá declarar su Scope cuando sea relevante.

Ejemplos:

```text
API
MESSAGE
EVENT
CONFIGURATION
STORAGE
INTEROPERABILITY
METADATA
COMMAND
```

---

# 10. Schema Identifier

Todo Schema deberá poseer identificador estable.

Ejemplo:

```text
mef.api.customer
mef.event.order-created
mef.config.database
```

---

# 11. Schema Namespace

Deberá evitar colisiones entre dominios, módulos y proveedores.

Ejemplo:

```text
mef.core.*
mef.application.*
org.example.*
```

---

# 12. Reserved Namespace

Namespaces reservados de MEF no deberán utilizarse por terceros.

---

# 13. Schema Identity

Conceptualmente:

```text
SchemaIdentity
├── namespace
├── name
└── version
```

---

# 14. Schema Version

Todo Schema evolutivo deberá poseer Version explícita.

---

# 15. Schema Version ≠ Application Version

La versión del Schema deberá poder evolucionar independientemente de:

```text
Framework Version
Application Version
Module Version
Plugin Version
API Version
```

---

# 16. Versioning Policy

Deberá seguir ENG-014.

---

# 17. Schema Definition

Deberá describir como mínimo:

```text
identity
scope
fields
types
constraints
compatibility policy
```

---

# 18. Schema Field

Un Field deberá poder declarar:

```text
name
type
required
nullable
default
constraints
metadata
```

---

# 19. Field Identifier

Cuando la tecnología subyacente soporte IDs estables de Fields, deberán considerarse para evolución segura.

---

# 20. Field Name

No deberá utilizarse como única identidad cuando una tecnología soporte Field IDs independientes.

---

# 21. Required Field

Debe estar presente.

---

# 22. Optional Field

Puede estar ausente.

---

# 23. Nullable Field

Puede contener valor nulo.

---

# 24. Optional ≠ Nullable

```text
optional
→ field may be absent

nullable
→ field may exist with null
```

Deberán permanecer diferenciados.

---

# 25. Default Value

Un Default deberá poseer semántica explícita.

---

# 26. Default ≠ Missing Data Repair

No deberá utilizarse para ocultar ausencia de información crítica.

---

# 27. Default Determinism

Mismo Schema y mismo Input deberán producir mismo Default cuando sea estático.

---

# 28. Dynamic Default

Deberá evitarse dentro de Schema puro.

Ejemplos:

```text
now()
currentUser()
random()
```

pertenecen a Application/Runtime Policy, no a estructura declarativa básica.

---

# 29. Primitive Type

Podrá incluir:

```text
boolean
integer
decimal
string
binary
date
time
datetime
duration
uuid
uri
```

---

# 30. Numeric Types

Deberán distinguir precisión y rango cuando sea relevante.

---

# 31. Decimal ≠ Float

Valores que requieran precisión decimal exacta no deberán depender de Float binario.

---

# 32. String Type

Podrá declarar:

```text
minLength
maxLength
pattern
encoding
normalization
```

---

# 33. Binary Type

Deberá declarar límites cuando corresponda.

---

# 34. Date Type

Representa fecha sin asumir instante.

---

# 35. DateTime Type

Deberá declarar semántica de Offset/Timezone.

---

# 36. Composite Type

Agrupa Fields.

Ejemplo:

```text
Address
├── street
├── city
├── postalCode
└── country
```

---

# 37. Collection Type

Deberá poder declarar:

```text
elementType
minItems
maxItems
unique
ordering
```

---

# 38. Map Type

Cuando exista deberá declarar tipos de Key y Value.

---

# 39. Reference Type

Permite referencia explícita a otro Schema.

---

# 40. Reference Resolution

Deberá utilizar ENG-059 cuando exista más de un Candidate.

---

# 41. Reference Cycle

Deberá detectarse cuando la tecnología no lo soporte o pueda provocar expansión infinita.

---

# 42. Enum Type

Deberá declarar conjunto permitido.

---

# 43. Enum Evolution

Agregar valores podrá ser Breaking para Consumers que asuman exhaustividad.

---

# 44. Unknown Enum Value

Deberá existir Policy explícita.

Podrá ser:

```text
REJECT
PRESERVE
MAP_TO_UNKNOWN
IGNORE
```

según Contract.

---

# 45. Union Type

Representa uno entre múltiples tipos permitidos.

---

# 46. Union Discriminator

Deberá ser explícito cuando exista ambigüedad estructural.

---

# 47. Schema Constraint

Podrá incluir:

```text
range
length
pattern
format
cardinality
uniqueness
allowed values
cross-field constraint
```

---

# 48. Structural Constraint

Describe forma.

---

# 49. Semantic Constraint

Describe significado.

No toda Semantic Constraint deberá residir en Schema.

---

# 50. Business Rule

No deberá trasladarse automáticamente a Schema.

Ejemplo:

```text
customer may purchase only if credit approved
```

pertenece al Domain/Policy.

---

# 51. Cross-Field Constraint

Podrá declararse cuando represente una invariante puramente estructural o contractual.

---

# 52. Schema Metadata

Deberá utilizar ENG-057.

Podrá incluir:

```text
description
owner
deprecated
examples
sensitivity
classification
```

---

# 53. Schema Validation

Deberá verificar que una representación satisface Schema.

---

# 54. Validation Stages

Conceptualmente:

```text
Input
  │
  ▼
Parse
  │
  ▼
Structural Validation
  │
  ▼
Constraint Validation
  │
  ▼
Normalization
  │
  ▼
Validated Representation
```

---

# 55. Parse Failure

No deberá convertirse en Validation Success con Defaults.

---

# 56. Unknown Fields

Deberán seguir Policy explícita.

Podrá ser:

```text
REJECT
IGNORE
PRESERVE
```

---

# 57. Strict Schema

Podrá rechazar Unknown Fields.

---

# 58. Extensible Schema

Podrá preservarlos o permitir Extension Namespace.

---

# 59. Schema Normalization

Podrá incluir:

```text
Unicode normalization
case normalization
canonical date representation
canonical identifier representation
whitespace normalization
```

---

# 60. Normalization ≠ Semantic Transformation

Transformaciones de negocio pertenecen a Application/Interoperability.

---

# 61. Schema Compatibility

Determina si Producers y Consumers pueden coexistir entre versiones.

---

# 62. Backward Compatibility

Un Consumer nuevo puede procesar Data producida con Schema anterior.

Conceptualmente:

```text
Old Data
   │
   ▼
New Consumer
```

---

# 63. Forward Compatibility

Un Consumer anterior puede procesar Data producida con Schema nuevo.

```text
New Data
   │
   ▼
Old Consumer
```

---

# 64. Full Compatibility

Implica Backward + Forward Compatibility dentro del Scope definido.

---

# 65. Compatibility Direction

Deberá declararse explícitamente.

---

# 66. Compatibility Window

Podrá limitarse a:

```text
previous version
last N versions
all supported versions
```

---

# 67. Compatibility ≠ Equality

Dos Schemas pueden diferir y continuar siendo compatibles.

---

# 68. Compatibility ≠ Parseability

Poder parsear datos no implica Compatibility semántica.

---

# 69. Compatibility Policy

Todo Schema evolutivo deberá declarar Policy.

Ejemplos:

```text
NONE
BACKWARD
FORWARD
FULL
BACKWARD_TRANSITIVE
FORWARD_TRANSITIVE
FULL_TRANSITIVE
```

---

# 70. Transitive Compatibility

Deberá comprobarse contra todas las versiones requeridas por la Policy.

---

# 71. Schema Evolution

Todo cambio deberá clasificarse.

---

# 72. Evolution Categories

```text
ADDITIVE
SUBTRACTIVE
MODIFYING
RESTRUCTURING
```

---

# 73. Field Addition

Agregar Optional Field suele ser más compatible que agregar Required Field.

No deberá asumirse universalmente; dependerá del Format y Compatibility Policy.

---

# 74. Required Field Addition

Deberá considerarse potencialmente Breaking.

---

# 75. Field Removal

Deberá considerarse potencialmente Breaking.

---

# 76. Field Rename

Semánticamente equivale normalmente a:

```text
remove old field
+
add new field
```

salvo tecnología con Field Identity estable.

---

# 77. Type Change

Deberá evaluarse explícitamente.

Ejemplo:

```text
integer → string
```

no deberá considerarse compatible automáticamente.

---

# 78. Numeric Widening

Podrá ser compatible en algunas tecnologías.

Deberá depender de reglas del Schema Format.

---

# 79. Numeric Narrowing

Deberá considerarse potencialmente Breaking.

---

# 80. Constraint Tightening

Ejemplo:

```text
maxLength 255 → 100
```

puede romper Data válida existente.

---

# 81. Constraint Relaxation

Puede afectar Consumers que dependan de límites anteriores.

Por ello también deberá evaluarse.

---

# 82. Default Change

Podrá ser semánticamente Breaking aunque estructura permanezca igual.

---

# 83. Enum Value Addition

Deberá analizar Forward Compatibility.

---

# 84. Enum Value Removal

Deberá considerarse Breaking salvo prueba contraria.

---

# 85. Nullability Change

```text
nullable → non-nullable
```

deberá considerarse potencialmente Breaking.

---

# 86. Optionality Change

```text
optional → required
```

deberá considerarse potencialmente Breaking.

---

# 87. Collection Cardinality Change

Deberá evaluarse como Constraint Change.

---

# 88. Schema Diff

MEF deberá poder representar diferencias entre versiones.

Conceptualmente:

```text
SchemaDiff
├── addedFields
├── removedFields
├── modifiedFields
├── typeChanges
├── constraintChanges
└── compatibilityImpact
```

---

# 89. Schema Diff Determinism

Mismos Schemas deberán producir mismo Diff.

---

# 90. Breaking Change

Deberá poder identificarse antes de publicación.

---

# 91. Breaking Change Override

Deberá requerir decisión explícita y versionado adecuado.

---

# 92. Schema Migration

Transforma Data de una versión a otra.

---

# 93. Migration ≠ Compatibility

Un Schema incompatible puede ser migrable.

Un Schema compatible puede no requerir Migration.

---

# 94. Migration Direction

Deberá declararse.

Ejemplo:

```text
v1 → v2
```

---

# 95. Migration Version

Deberá identificarse.

---

# 96. Migration Determinism

Mismo Input y misma Migration Version deberán producir mismo Output salvo Contract explícito.

---

# 97. Migration Side Effects

Deberán evitarse en Transformations puras.

---

# 98. Migration Chain

Podrá ser:

```text
v1 → v2 → v3 → v4
```

---

# 99. Direct Migration

Podrá existir:

```text
v1 ─────────► v4
```

cuando sea necesario.

---

# 100. Migration Path Resolution

Deberá ser determinístico.

---

# 101. Missing Migration Path

Deberá fallar explícitamente.

---

# 102. Migration Lossiness

Deberá declararse.

---

# 103. Migration Rollback

No deberá asumirse reversible.

---

# 104. Data Backup

Migraciones destructivas deberán considerar Backup/Recovery conforme al subsistema correspondiente.

---

# 105. Schema Registry

Mantiene Schemas conocidos.

Conceptualmente:

```text
SchemaRegistry
├── register
├── unregister
├── get
├── versions
├── compatibility
└── metadata
```

---

# 106. Registry Identity

La Key deberá incluir identidad suficiente para evitar colisiones.

---

# 107. Duplicate Registration

Misma Identity + Version con contenido diferente deberá rechazarse.

---

# 108. Idempotent Registration

Misma Identity + Version + Definition equivalente podrá tratarse como idempotente.

---

# 109. Immutable Published Schema

Una versión publicada no deberá modificarse silenciosamente.

---

# 110. Correction Strategy

Una corrección deberá producir nueva versión cuando altere Contract.

---

# 111. Schema Discovery

Deberá utilizar ENG-058.

---

# 112. Discovery Sources

Podrán incluir:

```text
generated index
module metadata
plugin metadata
application metadata
schema directory
registry
```

---

# 113. Discovery ≠ Registration

Un Schema descubierto deberá validarse antes de Registry.

---

# 114. Schema Resolution

Deberá utilizar ENG-059.

---

# 115. Resolution Inputs

Podrán incluir:

```text
schema id
namespace
version
version constraint
scope
format
```

---

# 116. Latest Version

No deberá seleccionarse implícitamente en Contracts críticos.

---

# 117. Floating Schema Version

Deberá evitarse cuando Reproducibility sea requerida.

---

# 118. Resolution Determinism

No deberá depender del orden del Filesystem o Registration.

---

# 119. Schema Serialization

Un Schema podrá expresarse en representación serializable.

---

# 120. Schema Format

Ejemplos posibles:

```text
JSON Schema
OpenAPI Schema
Avro Schema
Protocol Buffers
XML Schema
custom MEF schema
```

---

# 121. Schema Format Adapter

Deberá encapsular particularidades del formato.

---

# 122. Format-Specific Compatibility

Las reglas podrán variar según tecnología.

---

# 123. Generic Compatibility Layer

No deberá fingir equivalencia entre formatos con semánticas incompatibles.

---

# 124. Schema Import

Podrá importar Schema externo mediante ENG-061.

---

# 125. Imported Schema

Deberá conservar:

```text
origin
format
external version
mapping
limitations
```

---

# 126. Schema Export

Podrá producir representaciones externas.

---

# 127. Export Lossiness

Deberá identificarse cuando el formato destino no represente toda la semántica.

---

# 128. Schema Generation

Podrá generar Schemas desde Contracts explícitos.

---

# 129. Generation Source of Truth

Deberá existir una única Authority conocida.

---

# 130. Circular Generation

Deberá evitarse.

Ejemplo incorrecto:

```text
Code → Schema → Code → Schema
```

sin Authority definida.

---

# 131. Schema Code Generation

Podrá generar:

```text
DTOs
validators
serializers
clients
documentation
```

---

# 132. Generated Code

Deberá identificarse como generado.

---

# 133. Generated Code Modification

No deberá editarse manualmente cuando vaya a regenerarse.

---

# 134. Generation Reproducibility

Misma Source + Generator Version deberán producir Output equivalente.

---

# 135. Generator Version

Deberá registrarse cuando afecte Output.

---

# 136. Schema Documentation

Deberá poder generarse desde Metadata y Definition.

---

# 137. Examples

Podrán formar parte de Documentation.

No sustituyen Tests.

---

# 138. Schema Security

ENG-024 gobernará Security general.

---

# 139. Schema as Attack Surface

Schemas externos deberán considerarse Input no confiable cuando puedan ser suministrados dinámicamente.

---

# 140. Schema Complexity

Deberá limitarse para evitar:

```text
deep recursion
reference explosion
catastrophic patterns
resource exhaustion
```

---

# 141. Regex Constraint

Deberá evitar expresiones vulnerables a ReDoS.

---

# 142. Recursive Schema

Deberá poseer límites cuando pueda provocar expansión no controlada.

---

# 143. Schema Reference Security

References externas no deberán descargarse arbitrariamente sin Policy.

---

# 144. Remote Reference

Deberá estar deshabilitada por Default o limitada mediante Allowlist cuando exista riesgo.

---

# 145. Schema Injection

Schema Metadata o Expressions no deberán convertirse en ejecución arbitraria.

---

# 146. Sensitive Metadata

No deberá contener Secrets.

---

# 147. Schema Authorization

Registro, modificación, deprecación y eliminación deberán requerir Authority apropiada.

---

# 148. Schema Audit

Operaciones sensibles deberán poder auditarse.

Ejemplos:

```text
schema registered
schema deprecated
schema compatibility overridden
schema removed
migration registered
```

---

# 149. Audit Record

Podrá contener:

```text
schemaId
version
operation
actor
result
reason
timestamp
```

---

# 150. Schema Observability

ENG-025 gobernará Telemetry.

---

# 151. Metrics

Podrán incluir:

```text
mef.schema.validation.total
mef.schema.validation.failure.total
mef.schema.compatibility.total
mef.schema.compatibility.failure.total
mef.schema.resolution.failure.total
mef.schema.migration.total
mef.schema.migration.failure.total
```

---

# 152. Metric Labels

Podrán incluir:

```text
scope
format
operation
result
failureType
```

con Cardinality controlada.

---

# 153. Schema ID as Label

Deberá evitarse cuando pueda generar Cardinality no controlada.

---

# 154. Schema Diagnostics

Deberá poder responder:

```text
which schema?
which version?
which compatibility policy?
why validation failed?
what changed?
is the change breaking?
which migration path exists?
which schema was resolved?
where did it originate?
```

---

# 155. Schema Lifecycle

Podrá utilizar estados:

```text
DRAFT
VALIDATED
PUBLISHED
DEPRECATED
RETIRED
```

---

# 156. Draft Schema

No deberá utilizarse automáticamente como Production Contract.

---

# 157. Published Schema

Deberá ser inmutable.

---

# 158. Deprecated Schema

Deberá conservarse durante Compatibility Window requerida.

---

# 159. Retired Schema

No deberá seleccionarse para nuevas operaciones.

---

# 160. Schema Deprecation

Deberá poder declarar:

```text
deprecatedSince
replacement
removalVersion
reason
```

---

# 161. Schema Removal

Deberá verificar Consumers y Compatibility Policy cuando exista información disponible.

---

# 162. Consumer Awareness

MEF podrá registrar Consumers conocidos.

---

# 163. Unknown Consumers

Deberán asumirse posibles cuando el Schema sea público.

---

# 164. Public Schema

Cambios Breaking deberán seguir Release/Compatibility Policy estricta.

---

# 165. Internal Schema

Podrá tener Policy distinta, pero no deberá considerarse libre de Compatibility si existe persistencia o comunicación entre versiones.

---

# 166. Storage Schema

Deberá coordinarse con ENG-043 y ENG-042.

---

# 167. API Schema

Deberá coordinarse con ENG-044.

---

# 168. Message Schema

Deberá coordinarse con ENG-041.

---

# 169. Event Schema

Deberá coordinarse con ENG-022.

---

# 170. Configuration Schema

Deberá coordinarse con ENG-049.

---

# 171. Plugin Schema

Deberá coordinarse con ENG-060.

---

# 172. Interoperability Schema

Deberá coordinarse con ENG-061.

---

# 173. Schema Ownership

Todo Schema publicado deberá poseer Owner.

---

# 174. Ownership ≠ Consumer

Consumer no deberá modificar Schema del Producer unilateralmente.

---

# 175. Producer Responsibility

Producer deberá respetar Compatibility Contract.

---

# 176. Consumer Responsibility

Consumer no deberá asumir campos o valores fuera del Contract.

---

# 177. Tolerant Reader

Podrá utilizarse cuando Compatibility Policy lo permita.

---

# 178. Tolerant Writer

No deberá emitir campos fuera del Schema acordado.

---

# 179. Contract Boundary

Schema deberá validarse en Boundary adecuada.

---

# 180. Internal Revalidation

No deberá repetirse indiscriminadamente una vez establecida Trust Boundary, salvo necesidad contractual.

---

# 181. Testing

ENG-009 gobernará Testing.

---

# 182. Schema Definition Test

Deberá comprobar Schemas válidos e inválidos.

---

# 183. Validation Test

Deberá cubrir:

```text
required
optional
nullable
defaults
types
constraints
unknown fields
```

---

# 184. Compatibility Test

Deberá cubrir:

```text
backward
forward
full
transitive
```

cuando correspondan.

---

# 185. Evolution Test

Deberá probar:

```text
field addition
field removal
field rename
type change
constraint change
default change
enum change
nullability change
optionality change
```

---

# 186. Migration Test

Deberá cubrir:

```text
direct migration
migration chain
missing path
lossy migration
failure
```

---

# 187. Registry Test

Deberá cubrir:

```text
registration
duplicate
immutability
version lookup
deprecation
```

---

# 188. Discovery Test

Deberá comprobar Candidates válidos e inválidos.

---

# 189. Resolution Test

Deberá comprobar determinismo.

---

# 190. Reference Test

Deberá probar:

```text
valid reference
missing reference
cycle
version mismatch
```

---

# 191. Generation Test

Deberá comprobar reproducibilidad.

---

# 192. Security Test

Deberá intentar:

```text
schema bomb
deep recursion
reference explosion
remote reference abuse
ReDoS constraint
schema injection
unauthorized registration
```

---

# 193. Architecture Test

Podrá impedir:

```text
unversioned public schema
mutable published schema
floating critical schema version
business rules embedded as structural schema
vendor schema leakage into Domain
```

---

# 194. Build Integration

ENG-012 podrá validar:

```text
schema syntax
duplicate identity
missing version
invalid references
reference cycles
compatibility violations
breaking changes
missing migration
deprecated schema usage
```

---

# 195. CLI

ENG-007 podrá proporcionar:

```text
mef schema:list
mef schema:show
mef schema:validate
mef schema:diff
mef schema:compatibility
mef schema:migrate
mef schema:versions
mef schema:references
mef schema:diagnose
```

---

# 196. `schema:list`

Podrá mostrar:

```text
id
version
scope
status
compatibility
```

---

# 197. `schema:show`

Podrá mostrar Definition y Metadata.

---

# 198. `schema:validate`

Podrá validar:

```text
schema definition
data against schema
```

---

# 199. `schema:diff`

Deberá mostrar cambios estructurales entre versiones.

---

# 200. `schema:compatibility`

Deberá explicar por qué dos versiones son o no compatibles.

---

# 201. `schema:migrate`

Podrá ejecutar o simular Migration.

---

# 202. `schema:versions`

Podrá listar Compatibility Window.

---

# 203. `schema:references`

Podrá mostrar Dependency Graph entre Schemas.

---

# 204. `schema:diagnose`

Podrá mostrar:

```text
identity
version
scope
status
origin
compatibility policy
references
migration paths
last validation failure
```

---

# 205. Registry Integration

ENG-020 podrá registrar:

```text
SchemaDefinition
SchemaDescriptor
SchemaValidator
SchemaCompatibilityChecker
SchemaMigration
SchemaFormatAdapter
```

---

# 206. Schema Definition Contract

Conceptualmente:

```text
SchemaDefinition
├── identity
├── scope
├── fields
├── constraints
├── compatibility
└── metadata
```

---

# 207. Schema Descriptor

Conceptualmente:

```text
SchemaDescriptor
├── identity
├── version
├── format
├── status
├── origin
├── owner
└── metadata
```

---

# 208. Schema Field Contract

Conceptualmente:

```text
SchemaField
├── name
├── type
├── required
├── nullable
├── default
├── constraints
└── metadata
```

---

# 209. Schema Compatibility Result

Conceptualmente:

```text
SchemaCompatibilityResult
├── compatible
├── mode
├── violations
├── warnings
└── breakingChanges
```

---

# 210. Schema Migration Contract

Conceptualmente:

```text
SchemaMigration
├── schemaId
├── fromVersion
├── toVersion
├── migrate
├── lossy
└── metadata
```

---

# 211. Schema Registry Contract

Conceptualmente:

```text
SchemaRegistry
├── register
├── resolve
├── versions
├── compatibility
├── migrations
└── metadata
```

---

# 212. Bootstrap

ENG-027 deberá validar Schemas críticos antes de Runtime Ready.

---

# 213. Bootstrap Flow

```text
Schema Sources
      │
      ▼
Schema Discovery
      │
      ▼
Definition Validation
      │
      ▼
Reference Resolution
      │
      ▼
Compatibility Validation
      │
      ▼
Registry
      │
      ▼
Critical Schema Validation
      │
      ▼
Runtime Ready
```

---

# 214. Bootstrap Failure

Podrá impedir Readiness ante:

```text
invalid critical schema
duplicate critical schema
missing critical reference
reference cycle
incompatible required schema
missing required migration
```

---

# 215. Runtime Schema Mutation

No deberá permitirse sobre Published Schemas.

---

# 216. Dynamic Schema Registration

Podrá permitirse mediante Registry controlado.

---

# 217. Dynamic Registration Validation

Deberá aplicar las mismas reglas que Bootstrap.

---

# 218. Schema Cache

Podrá utilizar ENG-037.

---

# 219. Cache Key

Deberá incluir:

```text
schema identity
version
format
```

cuando corresponda.

---

# 220. Cache Invalidation

Deberá ocurrir ante cambios legítimos de Registry State.

---

# 221. First Implementation Components

La primera implementación deberá incluir:

```text
SchemaId
SchemaVersion
SchemaIdentity

SchemaDefinition
SchemaField
SchemaType
SchemaConstraint

SchemaValidator
SchemaValidationResult

SchemaCompatibilityPolicy
SchemaCompatibilityChecker
SchemaCompatibilityResult

SchemaDiff

SchemaRegistry
SchemaDescriptor

SchemaMigration
SchemaMigrationRegistry

SchemaError
```

---

# 222. Optional Initial Components

Podrán incorporarse:

```text
SchemaNormalizer
SchemaFormatAdapter
SchemaDiagnostics
SchemaReferenceResolver
SchemaGenerator
```

---

# 223. Later Components

Solo cuando exista necesidad demostrada:

```text
Remote Schema Registry
Federated Schema Registry
Automatic Schema Inference
Automatic Migration Generation
Cross-Language Code Generation
AI-Assisted Schema Evolution
```

---

# 224. Estructura Conceptual de Directorios

```text
src/
└── Schema/
    ├── Identity/
    │   ├── SchemaId
    │   ├── SchemaVersion
    │   └── SchemaIdentity
    │
    ├── Definition/
    │   ├── SchemaDefinition
    │   ├── SchemaField
    │   ├── SchemaType
    │   └── SchemaConstraint
    │
    ├── Validation/
    │   ├── SchemaValidator
    │   └── SchemaValidationResult
    │
    ├── Compatibility/
    │   ├── SchemaCompatibilityPolicy
    │   ├── SchemaCompatibilityChecker
    │   ├── SchemaCompatibilityResult
    │   └── SchemaDiff
    │
    ├── Registry/
    │   ├── SchemaRegistry
    │   └── SchemaDescriptor
    │
    ├── Migration/
    │   ├── SchemaMigration
    │   └── SchemaMigrationRegistry
    │
    ├── Reference/
    │   └── SchemaReferenceResolver
    │
    ├── Format/
    │   └── SchemaFormatAdapter
    │
    ├── Generation/
    │   └── SchemaGenerator
    │
    ├── Diagnostics/
    │   └── SchemaDiagnostics
    │
    └── Error/
        └── SchemaError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 225. Error Namespace

ENG-062 utilizará:

```text
MEF-SCHEMA-xxx
```

---

# 226. Taxonomía ENG-062

```text
MEF-SCHEMA-001 Schema identifier invalid
MEF-SCHEMA-002 Schema identifier duplicate
MEF-SCHEMA-003 Schema version invalid
MEF-SCHEMA-004 Schema definition invalid
MEF-SCHEMA-005 Schema field invalid
MEF-SCHEMA-006 Schema type invalid
MEF-SCHEMA-007 Schema constraint invalid
MEF-SCHEMA-008 Schema validation failed
MEF-SCHEMA-009 Schema reference missing
MEF-SCHEMA-010 Schema reference cycle
MEF-SCHEMA-011 Schema resolution failed
MEF-SCHEMA-012 Schema compatibility failed
MEF-SCHEMA-013 Breaking schema change
MEF-SCHEMA-014 Schema migration missing
MEF-SCHEMA-015 Schema migration failed
MEF-SCHEMA-016 Schema migration lossy
MEF-SCHEMA-017 Schema format unsupported
MEF-SCHEMA-018 Schema import failed
MEF-SCHEMA-019 Schema export failed
MEF-SCHEMA-020 Schema generation failed
MEF-SCHEMA-021 Schema immutable
MEF-SCHEMA-022 Schema deprecated
MEF-SCHEMA-023 Schema retired
MEF-SCHEMA-024 Schema unauthorized
MEF-SCHEMA-025 Schema complexity exceeded
MEF-SCHEMA-026 Schema reference security violation
MEF-SCHEMA-027 Schema registry failure
MEF-SCHEMA-028 Schema normalization failed
MEF-SCHEMA-029 Schema security violation
MEF-SCHEMA-030 Schema invariant violation
```

---

# 227. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Schema Identity
Namespaces
Explicit Versions
Immutable Published Schemas

Field Semantics
Required vs Optional
Nullable vs Missing
Explicit Defaults

Types
Constraints
References
Enums

Validation
Compatibility
Schema Diff
Breaking Change Detection

Evolution
Migration
Registry
Discovery
Resolution

Security
Diagnostics
Testing
```

---

# 228. First Version Non-Goals

No deberá requerir:

```text
Remote Schema Registry
Federated Schema Registry
Automatic Schema Inference
Automatic Migration Generation
Universal Schema Language
Cross-Language Code Generation
AI-Assisted Schema Evolution
```

---

# 229. Second Phase

Podrá incorporar:

```text
Multiple Schema Format Adapters
Schema Generation
Code Generation
Advanced Migration Planning
Consumer Tracking
Remote Registry Integration
```

---

# 230. Third Phase

Solo cuando exista necesidad demostrada:

```text
Federated Registry
Automatic Schema Inference
Automatic Migration Generation
Cross-Language Generation
Schema Governance Automation
AI-Assisted Evolution
```

---

# 231. Invariantes de Ingeniería

ENG-062 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1186 | Todo Schema gobernado por MEF deberá poseer Identity, Namespace, Version, Scope, Owner y Compatibility Policy explícitos cuando sea evolutivo o forme parte de un Contract persistente o público. |
| EI-1187 | Schema, Domain Model, DTO, Serialization Format y Validation Rule Set deberán permanecer como conceptos separados y ningún Schema externo o específico de proveedor deberá convertirse directamente en modelo del Domain. |
| EI-1188 | Required, Optional, Nullable y Default deberán conservar semánticas independientes; ausencia de Field no deberá confundirse con Null ni repararse automáticamente mediante Defaults cuando represente información crítica. |
| EI-1189 | Schema Types y Constraints deberán expresar estructura con precisión suficiente, diferenciando Date de DateTime, Decimal de Float, Collection Cardinality, Enum Semantics, References y Union Discriminators cuando correspondan. |
| EI-1190 | Todo Schema Input deberá validarse estructuralmente y todo Schema dinámico o externo deberá tratarse como Input no confiable, aplicando límites de Complexity, Reference Resolution y Constraint Safety. |
| EI-1191 | Backward, Forward, Full y Transitive Compatibility deberán evaluarse explícitamente conforme a una Policy conocida y Parseability no deberá utilizarse como sustituto de Compatibility semántica. |
| EI-1192 | Todo cambio de Schema deberá poder clasificarse y analizarse mediante Diff, incluyendo Field Addition, Removal, Rename, Type, Constraint, Default, Enum, Nullability, Optionality y Cardinality Changes. |
| EI-1193 | Ningún Breaking Change deberá publicarse silenciosamente bajo la misma versión contractual y cualquier Override deberá requerir decisión explícita, Authority y Versioning adecuado. |
| EI-1194 | Una versión de Schema publicada deberá ser inmutable; registrar la misma Identity y Version con Definition diferente deberá rechazarse. |
| EI-1195 | Schema Migration y Schema Compatibility deberán permanecer separadas; toda Migration deberá declarar Direction, Versions, Lossiness y Failure Semantics y no deberá asumirse reversible. |
| EI-1196 | Schema Discovery y Resolution deberán utilizar mecanismos determinísticos y una Critical Schema Version no deberá flotar implícitamente hacia `latest`. |
| EI-1197 | Schema References deberán resolverse mediante Identity y Version conocidas; Missing References, Unsupported Cycles y Version Mismatches deberán detectarse antes de Runtime crítico. |
| EI-1198 | Schema Generation y Code Generation deberán poseer Source of Truth y Generator Version conocidos y no deberán formar ciclos de generación ambiguos ni depender de modificaciones manuales de Output regenerable. |
| EI-1199 | API, Message, Event, Configuration, Storage, Plugin e Interoperability Schemas deberán respetar las Policies del subsistema propietario además de ENG-062. |
| EI-1200 | Schema Registry deberá preservar Identity, Version, Immutability, Metadata, Compatibility y Lifecycle y deberá impedir Registration no autorizada o colisiones silenciosas. |
| EI-1201 | Schema Security deberá impedir Remote Reference Abuse, uncontrolled recursion, reference explosion, ReDoS Constraints, Schema Injection y uso de Metadata para almacenar Secrets. |
| EI-1202 | Schema Observability y Audit deberán permitir explicar Validation, Compatibility, Resolution, Migration, Deprecation y Override sin exponer Data sensible ni generar Cardinality no controlada. |
| EI-1203 | Schema Testing deberá cubrir Definition, Validation, Compatibility, Evolution, Migration, Registry, Discovery, Resolution, References, Generation y Security, incluyendo casos positivos y negativos. |
| EI-1204 | Build y Architecture Tests deberán detectar Schemas públicos sin versión, Published Schemas mutables, Floating Critical Versions, Breaking Changes, Missing Migrations, Invalid References y Vendor Schema Leakage hacia Domain. |
| EI-1205 | La primera implementación deberá priorizar Schema Identity, Versioning, Field Semantics, Types, Constraints, Validation, Compatibility, Diff, Evolution, Migration, Registry, Discovery y Resolution antes de introducir Federation, Automatic Inference o Automatic Migration Generation. |

---

# 232. Continuidad de Invariantes

```text
ENG-058 → EI-1106 a EI-1125
ENG-059 → EI-1126 a EI-1145
ENG-060 → EI-1146 a EI-1165
ENG-061 → EI-1166 a EI-1185
ENG-062 → EI-1186 a EI-1205
```

---

# 233. Criterios de Conformidad

Una implementación será conforme con ENG-062 cuando:

- identifique Schemas explícitamente;
- utilice Namespaces;
- versione Schemas;
- declare Scope;
- declare Owner;
- diferencie Required, Optional y Nullable;
- controle Defaults;
- modele Types explícitos;
- modele Constraints;
- modele References;
- controle Enum Evolution;
- valide Schema Definitions;
- valide Data contra Schema;
- defina Compatibility Policy;
- compruebe Backward/Forward Compatibility;
- produzca Schema Diff;
- detecte Breaking Changes;
- preserve Published Schema Immutability;
- gestione Schema Evolution;
- gestione Migrations;
- detecte Lossy Migration;
- implemente Schema Registry;
- descubra Schemas;
- resuelva Schemas determinísticamente;
- proteja References;
- controle Schema Complexity;
- permita Diagnostics;
- audite operaciones sensibles;
- implemente Tests de Compatibility y Security.

---

# 234. Riesgos

Deberán evitarse especialmente:

```text
Schema Without Identity
Schema Without Version
Mutable Published Schema
Floating Critical Version
Required/Nullable Confusion
Missing/Null Confusion
Dynamic Defaults in Structural Schema
Decimal/Float Confusion
Date/DateTime Confusion
Enum Exhaustiveness Failure
Unknown Field Ambiguity
Implicit Breaking Change
Silent Field Rename
Constraint Tightening
Default Semantic Change
Compatibility Equals Parseability
Migration Equals Compatibility
Irreversible Migration Assumption
Reference Cycle
Remote Reference Abuse
Schema Bomb
ReDoS Constraint
Vendor Schema Leakage
Circular Code Generation
Schema Registry Collision
Unauthorized Schema Mutation
```

---

# 235. Relación con ENG-014

Versionado responde:

```text
How are versions represented and governed?
```

Schema Engineering responde:

```text
What does a version change mean
for a structural data contract?
```

---

# 236. Relación con ENG-016

Compatibility define principios globales.

ENG-062 los especializa para Schemas.

---

# 237. Relación con ENG-021

Contracts pueden utilizar Schemas como descripción estructural.

Schema no sustituye Contract semántico completo.

---

# 238. Relación con ENG-031

Serialization responde:

```text
How is data represented as bytes/text?
```

Schema responde:

```text
Which structures are valid?
```

---

# 239. Relación con ENG-036

Validation ejecuta reglas.

Schema Engineering define una fuente estructural de esas reglas.

---

# 240. Relación con ENG-041

Messages deberán poseer Schema versionable cuando formen parte de Contracts duraderos.

---

# 241. Relación con ENG-044

APIs podrán exponer Schemas.

Breaking Schema Changes deberán respetar API Compatibility.

---

# 242. Relación con ENG-049

Configuration podrá definirse mediante Schema para:

```text
types
required keys
defaults
constraints
deprecation
```

---

# 243. Relación con ENG-057

Metadata describe Schema sin reemplazar su Definition.

---

# 244. Relación con ENG-058

Discovery encuentra Schema Candidates.

---

# 245. Relación con ENG-059

Resolution selecciona Identity/Version compatible.

---

# 246. Relación con ENG-060

Plugins podrán proporcionar Schemas, Validators, Format Adapters o Migrations mediante Extension Points controlados.

---

# 247. Relación con ENG-061

Interoperability podrá utilizar Schemas para describir representaciones externas.

Sin embargo:

```text
External Schema
      │
      ▼
Interoperability Boundary
      │
      ▼
Mapping
      │
      ▼
Internal Contract
```

y no:

```text
External Schema
      │
      ▼
Domain Model
```

---

# 248. Relación con ENG-063

ENG-063 deberá formalizar **Data Transformation Engineering**.

La separación será:

```text
Schema Engineering
→ What structure is valid?

Data Transformation Engineering
→ How is valid data transformed
  from one representation,
  shape or semantic model
  into another?
```

ENG-063 deberá cubrir:

```text
Transformation
Transformation Definition
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

Transformation Version
Transformation Compatibility

Transformation Error
Partial Transformation

Batch Transformation
Streaming Transformation

Transformation Registry
Transformation Discovery
Transformation Resolution

Transformation Security
Transformation Observability
Transformation Testing
```

---

# 249. Principio Rector

> **MEF deberá tratar los Schemas como Contracts estructurales identificables, versionados e inmutables una vez publicados. Toda evolución deberá analizarse explícitamente en términos de Compatibility y Migration, y ninguna diferencia sintáctica aparentemente pequeña deberá introducirse sin evaluar su impacto sobre Producers, Consumers y Data persistente.**

---

# 250. Conclusión

**ENG-062 — Schema Engineering** formaliza los Contracts estructurales de MEF.

La cadena principal queda:

```text
DATA
 │
 ▼
SCHEMA
 │
 ├── Identity
 ├── Version
 ├── Fields
 ├── Types
 ├── Constraints
 └── Compatibility Policy
 │
 ▼
VALIDATION
 │
 ▼
VALID REPRESENTATION
```

La evolución queda:

```text
SCHEMA v1
    │
    ▼
CHANGE
    │
    ▼
SCHEMA DIFF
    │
    ▼
COMPATIBILITY CHECK
    │
    ├── compatible ─────► publish
    │
    └── breaking
           │
           ▼
       new contract
           │
           ▼
        migration
```

La relación entre Compatibility y Migration queda:

```text
COMPATIBILITY
    │
    └── Can old/new producers and
        consumers coexist?

MIGRATION
    │
    └── How is existing data
        transformed?
```

Son problemas relacionados, pero distintos.

El Registry queda:

```text
SCHEMA SOURCES
      │
      ▼
   DISCOVERY
      │
      ▼
  VALIDATION
      │
      ▼
   REGISTRY
      │
      ▼
  RESOLUTION
      │
      ▼
SCHEMA ID + VERSION
```

El modelo de evolución queda:

```text
Schema v1
   │
   ├── Add Field
   ├── Remove Field
   ├── Rename Field
   ├── Change Type
   ├── Change Constraint
   ├── Change Default
   ├── Change Enum
   └── Change Nullability
   │
   ▼
Schema Diff
   │
   ▼
Compatibility Policy
```

La relación reciente de documentos queda:

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
    │
    ▼
SCHEMA
ENG-062
```

La primera implementación deberá concentrarse en:

```text
SchemaId
SchemaVersion
SchemaIdentity

SchemaDefinition
SchemaField
SchemaType
SchemaConstraint

SchemaValidator
SchemaValidationResult

SchemaCompatibilityPolicy
SchemaCompatibilityChecker
SchemaCompatibilityResult
SchemaDiff

SchemaRegistry
SchemaDescriptor

SchemaMigration
SchemaMigrationRegistry

SchemaError
```

antes de incorporar:

```text
Remote Schema Registry
Federated Schema Registry
Automatic Schema Inference
Automatic Migration Generation
Cross-Language Code Generation
AI-Assisted Schema Evolution
```

Con **ENG-062**, la serie global alcanza:

```text
EI-1205
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
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-031 — Serialization Engineering
- ENG-034 — Application Engineering
- ENG-036 — Validation Engineering
- ENG-041 — Messaging Engineering
- ENG-043 — Data Access Engineering
- ENG-044 — API Engineering
- ENG-049 — Configuration Management Engineering
- ENG-057 — Metadata Engineering
- ENG-058 — Discovery Engineering
- ENG-059 — Resolution Engineering
- ENG-060 — Extension & Plugin Engineering
- ENG-061 — Interoperability Engineering
- ENG-063 — Data Transformation Engineering
```