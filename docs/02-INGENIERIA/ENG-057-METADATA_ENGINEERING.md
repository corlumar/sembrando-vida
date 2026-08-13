---
id: ENG-057
titulo: Metadata Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Metadata Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-011
  - ENG-014
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-028
  - ENG-031
  - ENG-034
  - ENG-036
  - ENG-049
  - ENG-050
  - ENG-051
  - ENG-053
  - ENG-056
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-012
  - ENG-013
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-022
  - ENG-026
  - ENG-030
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-037
  - ENG-038
  - ENG-040
  - ENG-041
  - ENG-043
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-052
  - ENG-054
  - ENG-055
  - ENG-058
keywords:
  - metadata
  - metadata-engineering
  - metadata-schema
  - metadata-registry
  - metadata-descriptor
  - metadata-provider
  - metadata-key
  - metadata-value
  - metadata-type
  - metadata-namespace
  - metadata-discovery
  - metadata-resolution
  - metadata-inheritance
  - metadata-override
  - metadata-merge
  - metadata-validation
  - metadata-normalization
  - metadata-versioning
  - metadata-indexing
  - metadata-query
  - annotation
  - attribute
  - tag
  - label
  - descriptor
  - mef
---

# ENG-057

# Metadata Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Metadata Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-057 establece las reglas para:

```text
Metadata
Metadata Identifier
Metadata Key
Metadata Value
Metadata Type
Metadata Schema
Metadata Namespace

Metadata Owner
Metadata Authority
Metadata Scope
Metadata Lifetime

Static Metadata
Runtime Metadata
Derived Metadata

Metadata Descriptor
Metadata Provider
Metadata Registry

Metadata Annotation
Metadata Attribute
Metadata Tag
Metadata Label

Metadata Discovery
Metadata Resolution
Metadata Inheritance
Metadata Override
Metadata Merge

Metadata Validation
Metadata Normalization
Metadata Versioning
Metadata Compatibility

Metadata Serialization
Metadata Deserialization

Metadata Indexing
Metadata Query

Metadata Security
Metadata Sensitivity
Metadata Audit
Metadata Observability
Metadata Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo Metadata administrado por MEF deberá poseer significado, Namespace, Type, Owner y Scope conocidos; deberá validarse contra un Contract o Schema cuando participe en comportamiento arquitectónico; su resolución deberá ser determinística; y ningún Metadata deberá convertirse en mecanismo implícito para almacenar State operacional, Secrets, Dependencies o comportamiento arbitrario.**

Arquitectura conceptual:

```text
                  ARTIFACT
                     │
                     ▼
                  METADATA
                     │
       ┌─────────────┼─────────────┐
       ▼             ▼             ▼
      KEY           TYPE          OWNER
       │             │             │
       └─────────────┼─────────────┘
                     ▼
                   SCHEMA
                     │
                     ▼
                 VALIDATION
                     │
                     ▼
                  REGISTRY
                     │
          ┌──────────┴──────────┐
          ▼                     ▼
      DISCOVERY              QUERY
```

---

# 3. Metadata Engineering

`Metadata Engineering` gobierna información descriptiva acerca de artefactos, componentes, Contracts, Modules, Applications y modelos administrados por MEF.

Deberá poder responder:

```text
What is this artifact?
Who owns it?
What type is it?
Which version does it use?
What capabilities does it declare?
Which metadata schema applies?
Where did this metadata come from?
Is this metadata trusted?
Can it be inherited?
Can it be overridden?
How is it resolved?
Can it be indexed?
Can it be queried?
```

---

# 4. Metadata

Metadata representa información que describe otra entidad.

Ejemplos:

```text
module name
component type
contract version
schema identifier
capability
deprecation status
visibility
classification
tags
labels
```

---

# 5. Metadata ≠ Data

Metadata describe.

Data constituye el contenido principal.

Ejemplo:

```text
Data:
CustomerRecord

Metadata:
schemaVersion = 3
classification = confidential
owner = crm
```

---

# 6. Metadata ≠ State

State representa información operacional que evoluciona.

Metadata describe propiedades o características.

---

# 7. Metadata ≠ Context

Context acompaña una ejecución.

Metadata describe una entidad o artefacto.

---

# 8. Metadata ≠ Configuration

Configuration determina comportamiento configurable.

Metadata describe características.

Ejemplo:

```text
Metadata:
cacheable = true

Configuration:
cache.ttl = 300
```

---

# 9. Metadata ≠ Policy

Metadata podrá ser Input para Policy.

No deberá convertirse por sí mismo en Policy Engine.

---

# 10. Metadata ≠ Registry

Metadata es información descriptiva.

Registry organiza y permite resolver elementos.

---

# 11. Metadata ≠ Annotation

Annotation es una forma de declarar Metadata.

---

# 12. Metadata ≠ Arbitrary Property Bag

No deberá utilizarse como:

```text
global variable store
service locator
session storage
request state
configuration dump
secret store
domain database
```

---

# 13. Metadata Identifier

Todo Metadata estructurado relevante deberá poder poseer identidad estable.

Ejemplos:

```text
metadata:module
metadata:contract
metadata:component
metadata:capability
```

---

# 14. Metadata Key

Toda propiedad deberá utilizar Key estable.

Ejemplos:

```text
mef.module.name
mef.module.version
mef.contract.version
mef.component.visibility
```

---

# 15. Key Semantics

Cada Key deberá poseer significado único y documentado.

---

# 16. Metadata Namespace

Keys extensibles deberán utilizar Namespace.

Ejemplo:

```text
mef.*
module.billing.*
vendor.example.*
```

---

# 17. Reserved Namespace

`mef.*` deberá permanecer reservado para Metadata definido por MEF.

---

# 18. Namespace Collision

Deberá detectarse cuando sea posible.

---

# 19. Metadata Value

Todo Value deberá corresponder al Type declarado.

---

# 20. Metadata Type

Podrá incluir:

```text
STRING
INTEGER
DECIMAL
BOOLEAN
ENUM
IDENTIFIER
VERSION
URI
TIMESTAMP
DURATION
LIST
MAP
OBJECT
```

---

# 21. Strong Typing

Metadata arquitectónico deberá favorecer Types explícitos.

---

# 22. Free-Form Metadata

Deberá limitarse a casos donde no determine comportamiento crítico.

---

# 23. Metadata Schema

Define estructura y reglas.

Conceptualmente:

```text
MetadataSchema
├── id
├── version
├── namespace
├── fields
├── constraints
├── defaults
└── compatibility
```

---

# 24. Schema Requirement

Metadata utilizado para:

```text
discovery
routing
security
compatibility
dependency resolution
code generation
runtime behavior
```

deberá poseer Schema o Contract explícito.

---

# 25. Schema Version

Todo Schema evolutivo deberá poseer Version.

---

# 26. Schema Validation

Metadata deberá validarse antes de incorporarse al Registry cuando afecte comportamiento arquitectónico.

---

# 27. Metadata Owner

Todo Metadata administrado deberá poseer Owner lógico.

Ejemplos:

```text
Framework
Module
Application
Contract
Plugin
Subsystem
```

---

# 28. Metadata Authority

Deberá conocerse quién puede declarar o modificar Metadata sensible.

---

# 29. Owner ≠ Authority

Owner determina responsabilidad.

Authority determina quién puede establecer un Value confiable.

---

# 30. Metadata Scope

Podrá ser:

```text
FRAMEWORK
RUNTIME
APPLICATION
MODULE
COMPONENT
CONTRACT
TYPE
METHOD
PROPERTY
RESOURCE
ENDPOINT
MESSAGE
WORKFLOW
```

---

# 31. Metadata Lifetime

Podrá clasificarse:

```text
BUILD_TIME
BOOTSTRAP
RUNTIME
PERSISTENT
```

---

# 32. Static Metadata

Existe antes de Runtime.

Ejemplos:

```text
manifest
annotations
descriptors
schemas
package metadata
```

---

# 33. Runtime Metadata

Se produce o resuelve durante Runtime.

---

# 34. Derived Metadata

Se calcula a partir de otras fuentes.

Ejemplo:

```text
effectiveVisibility
effectiveCapabilities
effectiveVersion
```

---

# 35. Derived Metadata Rule

Deberá poder identificarse su Source.

---

# 36. Metadata Source

Toda entrada relevante deberá conocer procedencia.

Ejemplos:

```text
MANIFEST
ANNOTATION
CODE
CONFIGURATION
REGISTRY
DISCOVERY
RUNTIME
EXTERNAL
DERIVED
```

---

# 37. Source Precedence

Cuando múltiples Sources definan la misma propiedad deberá existir regla explícita.

---

# 38. Metadata Descriptor

Representa Metadata estructurado asociado a una entidad.

Conceptualmente:

```text
MetadataDescriptor
├── subject
├── schema
├── version
├── values
├── source
├── owner
└── metadata
```

---

# 39. Descriptor Subject

Deberá identificar inequívocamente la entidad descrita.

---

# 40. Descriptor Immutability

Descriptors publicados deberán favorecer inmutabilidad.

---

# 41. Metadata Provider

Produce Metadata.

Conceptualmente:

```text
MetadataProvider
├── supports
├── describe
└── priority
```

---

# 42. Provider Determinism

Misma entrada y mismas condiciones deberán producir resultado equivalente.

---

# 43. Provider Side Effects

Deberán minimizarse.

---

# 44. Metadata Registry

ENG-020 podrá proporcionar Registry especializado.

---

# 45. Registry Responsibilities

Podrá:

```text
register schema
register descriptor
resolve descriptor
query metadata
validate namespace
detect collision
```

---

# 46. Registry Authority

Registry deberá ser Authority sobre Metadata publicado dentro de su Scope.

---

# 47. Duplicate Descriptor

Deberá resolverse mediante Policy explícita.

---

# 48. Duplicate Metadata Key

No deberá resolverse por orden accidental de carga.

---

# 49. Metadata Discovery

Permite localizar Metadata disponible.

---

# 50. Discovery Sources

Podrán incluir:

```text
manifests
annotations
registries
module descriptors
generated indexes
runtime providers
```

---

# 51. Discovery Determinism

Mismo conjunto de artefactos deberá producir resultado estable.

---

# 52. Filesystem Order

No deberá determinar Precedence.

---

# 53. Reflection Discovery

Podrá utilizarse cuando la plataforma lo soporte.

---

# 54. Reflection Cost

No deberá asumirse gratuito.

---

# 55. Generated Metadata

ENG-008 podrá generar Metadata Indexes durante Build.

---

# 56. Generated Index

Podrá reducir Reflection o Discovery dinámico.

---

# 57. Metadata Resolution

Determina Metadata efectivo para un Subject.

Conceptualmente:

```text
Sources
  │
  ▼
Normalize
  │
  ▼
Validate
  │
  ▼
Apply Precedence
  │
  ▼
Inheritance
  │
  ▼
Override
  │
  ▼
Merge
  │
  ▼
Effective Metadata
```

---

# 58. Resolution Determinism

El mismo Input deberá producir el mismo Effective Metadata.

---

# 59. Resolution Trace

Deberá poder explicar cómo se obtuvo un Value relevante.

Ejemplo:

```text
visibility = private
source = module manifest
overrode = framework default
```

---

# 60. Metadata Inheritance

Podrá permitir que Child Subjects hereden Metadata.

---

# 61. Inheritance Contract

Cada Key deberá definir si es:

```text
INHERITABLE
NON_INHERITABLE
CONDITIONAL
```

---

# 62. Recursive Inheritance

Deberá poseer límite o estructura acíclica.

---

# 63. Metadata Override

Permite sustituir Value heredado o Default.

---

# 64. Override Authority

No cualquier Source deberá poder sobrescribir Metadata sensible.

---

# 65. Forbidden Override

Deberá rechazarse.

---

# 66. Metadata Merge

Combina Values compatibles.

---

# 67. Merge Strategy

Podrá ser:

```text
REPLACE
APPEND
UNION
INTERSECT
DEEP_MERGE
MIN
MAX
CUSTOM
```

---

# 68. Merge Strategy Requirement

Todo Metadata combinable deberá definir estrategia.

---

# 69. Deep Merge

No deberá ser Default universal.

---

# 70. Merge Conflict

Deberá resolverse determinísticamente o producir Error.

---

# 71. Metadata Default

Schema podrá declarar Default.

---

# 72. Explicit ≠ Default

Diagnostics deberá poder distinguirlos.

---

# 73. Metadata Normalization

Convierte representaciones equivalentes a forma canónica.

Ejemplos:

```text
version strings
identifiers
enum values
URI
case normalization
```

---

# 74. Normalization Before Comparison

Comparaciones deberán utilizar forma canónica cuando corresponda.

---

# 75. Metadata Validation

Deberá comprobar:

```text
type
schema
required fields
constraints
namespace
version
sensitivity
source authority
```

---

# 76. Validation Failure

Metadata inválido que afecte comportamiento crítico deberá rechazarse.

---

# 77. Lenient Metadata

Solo deberá permitirse para Metadata no crítico.

---

# 78. Unknown Key

Deberá seguir Compatibility Policy.

---

# 79. Metadata Versioning

Deberá seguir ENG-014 y ENG-016.

---

# 80. Metadata Schema Evolution

Podrá incluir:

```text
field addition
field deprecation
field removal
type evolution
constraint evolution
namespace migration
```

---

# 81. Breaking Metadata Change

Deberá identificarse explícitamente.

---

# 82. Deprecated Metadata

Deberá poder marcarse.

---

# 83. Deprecation Metadata

Podrá incluir:

```text
deprecated = true
since
replacement
removalVersion
reason
```

---

# 84. Compatibility

Consumers deberán conocer versiones soportadas.

---

# 85. Forward Compatibility

Unknown optional Fields podrán ignorarse según Contract.

---

# 86. Backward Compatibility

Defaults podrán utilizarse para Fields nuevos cuando sea seguro.

---

# 87. Metadata Migration

Podrá transformar Descriptor antiguo a Schema nuevo.

---

# 88. Migration Determinism

Deberá ser reproducible.

---

# 89. Metadata Serialization

ENG-031 gobernará representación externa.

---

# 90. Serialization Requirement

Deberá conservar:

```text
schema id
schema version
subject
values
```

cuando sea necesario.

---

# 91. Metadata Deserialization

Deberá validar antes de publicar.

---

# 92. External Metadata

Deberá considerarse no confiable inicialmente.

---

# 93. Metadata Annotation

Annotation representa declaración asociada al código o modelo.

Ejemplo conceptual:

```text
#[Capability("cache")]
class ProductService
```

---

# 94. Annotation Contract

Toda Annotation reconocida deberá mapear a Metadata Schema conocido.

---

# 95. Unknown Annotation

No deberá alterar Runtime silenciosamente.

---

# 96. Metadata Attribute

Representa propiedad descriptiva estructurada.

---

# 97. Metadata Tag

Representa clasificación ligera.

Ejemplos:

```text
experimental
internal
deprecated
critical
```

---

# 98. Tag Semantics

Tags utilizados por Runtime deberán documentarse.

---

# 99. Metadata Label

Representa par Key/Value para clasificación o búsqueda.

Ejemplo:

```text
team = payments
layer = application
```

---

# 100. Label Cardinality

Deberá controlarse cuando se utilice para Indexing u Observability.

---

# 101. Tag ≠ Label

Conceptualmente:

```text
Tag:
experimental

Label:
team=payments
```

---

# 102. Capability Metadata

Podrá declarar capacidades.

Ejemplos:

```text
supportsTransactions
supportsAsync
supportsStreaming
supportsCaching
```

---

# 103. Capability Truth

Una Capability declarada deberá corresponder a comportamiento realmente soportado.

---

# 104. Capability Validation

Podrá verificarse mediante Tests o Contracts.

---

# 105. Metadata Indexing

Metadata consultado frecuentemente podrá indexarse.

---

# 106. Index Scope

Deberá ser conocido.

---

# 107. Index Consistency

Deberá definirse relación entre Registry e Index.

---

# 108. Generated Index

Podrá ser:

```text
build-time index
bootstrap index
runtime index
```

---

# 109. Index Rebuild

Deberá ser determinístico.

---

# 110. Metadata Query

Podrá permitir búsquedas como:

```text
components with capability X
modules owned by team Y
contracts version >= N
deprecated endpoints
internal services
```

---

# 111. Query Contract

Deberá definir:

```text
scope
filters
sorting
pagination
limits
authorization
```

---

# 112. Unbounded Query

Deberá evitarse.

---

# 113. Metadata Query Authorization

Metadata sensible deberá respetar ENG-046.

---

# 114. Metadata Cache

ENG-037 podrá almacenar resultados derivados.

---

# 115. Cache Invalidation

Deberá relacionarse con Version o Registry Generation.

---

# 116. Metadata Generation

ENG-008 podrá generar:

```text
descriptors
indexes
schemas
documentation
code
```

a partir de Metadata confiable.

---

# 117. Generated Code Trust

Solo Metadata validado deberá alimentar Code Generation.

---

# 118. Metadata and Contracts

ENG-021 podrá utilizar Metadata para describir:

```text
contract id
version
capabilities
compatibility
deprecation
```

---

# 119. Metadata and Modules

ENG-028 podrá describir:

```text
module id
version
dependencies
capabilities
visibility
entry points
```

---

# 120. Metadata and Applications

ENG-034 podrá describir:

```text
application id
type
modules
capabilities
entry points
```

---

# 121. Metadata and APIs

ENG-044 podrá describir:

```text
endpoint
version
operation
visibility
deprecation
security requirements
```

---

# 122. Metadata and Messaging

ENG-041 podrá describir:

```text
message type
schema
version
producer
consumer
compatibility
```

---

# 123. Metadata and Data Access

ENG-043 podrá describir:

```text
repository type
entity mapping
capabilities
transaction support
```

sin almacenar Runtime Query State.

---

# 124. Metadata and Workflow

ENG-052 podrá describir:

```text
workflow type
version
step types
capabilities
```

---

# 125. Metadata and Resources

ENG-054 podrá describir:

```text
resource type
capacity model
ownership model
capabilities
```

---

# 126. Metadata and Lifecycle

ENG-055 podrá describir:

```text
lifecycle type
states
criticality
supported transitions
```

---

# 127. Metadata and Context

ENG-056 podrá utilizar Metadata para describir Context Keys y Propagation Rules.

---

# 128. Metadata and Configuration

ENG-049 podrá utilizar Metadata para describir Configuration Keys.

Ejemplo:

```text
key
type
default
required
sensitive
reloadable
```

---

# 129. Metadata and Features

ENG-050 podrá describir:

```text
feature id
owner
status
dependencies
scope
```

---

# 130. Metadata and Policies

ENG-051 podrá describir Policy Types sin almacenar Policy Decisions como Metadata.

---

# 131. Metadata Security

ENG-024 gobernará controles generales.

---

# 132. Metadata Sensitivity

Metadata deberá poder clasificarse.

Ejemplo:

```text
PUBLIC
INTERNAL
CONFIDENTIAL
RESTRICTED
```

---

# 133. Metadata Is Not Automatically Safe

Que una información sea Metadata no significa que pueda exponerse públicamente.

---

# 134. Sensitive Metadata

Podrá incluir:

```text
internal topology
security capabilities
private endpoints
owner contacts
infrastructure identifiers
tenant information
```

---

# 135. Secret Metadata

Secrets no deberán almacenarse como Metadata.

---

# 136. Metadata Exposure

Deberá seguir Classification y Authorization.

---

# 137. Metadata Injection

Input externo no deberá poder registrar Metadata arquitectónico confiable sin Validation y Authority.

---

# 138. Metadata Spoofing

Deberá prevenirse.

---

# 139. Metadata Tampering

Descriptors persistentes o distribuidos deberán proteger Integrity cuando corresponda.

---

# 140. Metadata Query Security

Queries no deberán permitir enumeración no autorizada de arquitectura interna.

---

# 141. Metadata Audit

Operaciones sensibles podrán auditarse.

Ejemplos:

```text
schema registered
descriptor registered
metadata overridden
metadata deprecated
metadata removed
metadata migration executed
```

---

# 142. Audit Record

Podrá contener:

```text
subject
schema
key
operation
actor
source
result
timestamp
```

---

# 143. Audit Sensitivity

Values sensibles podrán omitirse o redactarse.

---

# 144. Metadata Observability

ENG-025 gobernará Telemetry.

---

# 145. Metrics

Podrán incluir:

```text
mef.metadata.registry.entries
mef.metadata.schema.total
mef.metadata.validation.failure.total
mef.metadata.resolution.total
mef.metadata.resolution.duration
mef.metadata.query.total
mef.metadata.query.duration
mef.metadata.cache.hit
mef.metadata.cache.miss
```

---

# 146. Metric Labels

Podrán incluir Labels acotados:

```text
schema
operation
result
sourceType
```

---

# 147. High Cardinality

No deberán utilizarse indiscriminadamente:

```text
subjectId
descriptorId
userId
tenantId
arbitraryMetadataValue
```

---

# 148. Metadata Logs

Deberán permitir diagnosticar Registration, Validation y Resolution.

---

# 149. Resolution Diagnostics

Deberá poder responder:

```text
effective value
source
precedence
inherited from
override source
merge strategy
schema version
```

---

# 150. Metadata Provenance

Metadata crítico deberá poder rastrear su procedencia.

---

# 151. Provenance Model

Conceptualmente:

```text
MetadataProvenance
├── source
├── provider
├── declaredAt
├── transformedBy
└── authority
```

---

# 152. Derived Metadata Provenance

Deberá registrar Inputs conceptuales suficientes para Diagnostics.

---

# 153. Metadata Integrity

Podrá requerir Hash, Signature o Validation adicional cuando atraviese Trust Boundaries.

---

# 154. Metadata Testing

ENG-009 gobernará Testing.

---

# 155. Schema Test

Deberá validar Metadata correcto e incorrecto.

---

# 156. Namespace Test

Deberá detectar Collisions.

---

# 157. Type Test

Deberá rechazar Value incompatible.

---

# 158. Required Field Test

Deberá detectar ausencia.

---

# 159. Normalization Test

Representaciones equivalentes deberán producir forma canónica.

---

# 160. Resolution Test

Deberá comprobar Precedence.

---

# 161. Inheritance Test

Deberá comprobar Keys heredables y no heredables.

---

# 162. Override Test

Deberá comprobar Authority.

---

# 163. Forbidden Override Test

Deberá rechazar modificación no permitida.

---

# 164. Merge Test

Deberá cubrir cada Strategy soportada.

---

# 165. Conflict Test

Deberá comprobar comportamiento determinístico.

---

# 166. Version Test

Deberá probar versiones compatibles e incompatibles.

---

# 167. Migration Test

Deberá verificar reproducibilidad.

---

# 168. Serialization Test

Deberá conservar Schema y Version.

---

# 169. External Metadata Test

Deberá tratar entrada como no confiable.

---

# 170. Query Test

Deberá comprobar:

```text
filtering
sorting
pagination
limits
authorization
```

---

# 171. Index Test

Deberá comprobar consistencia con Registry.

---

# 172. Security Test

Deberá intentar:

```text
reserved namespace override
metadata injection
metadata spoofing
sensitive metadata enumeration
unauthorized override
schema bypass
oversized metadata
```

---

# 173. Determinism Test

Mismo Input deberá producir mismo Effective Metadata.

---

# 174. Discovery Order Test

Cambiar orden del Filesystem no deberá cambiar resultado.

---

# 175. Architecture Test

Podrá impedir:

```text
metadata as service locator
metadata as secret store
metadata as request state
untyped critical metadata
runtime behavior from unvalidated metadata
reserved namespace mutation
```

---

# 176. Build Integration

ENG-012 podrá validar:

```text
unknown schema
duplicate schema
duplicate metadata key
namespace collision
missing metadata owner
invalid metadata type
missing schema version
forbidden override
invalid merge strategy
deprecated key usage
```

---

# 177. CLI

ENG-007 podrá proporcionar:

```text
mef metadata:list
mef metadata:show
mef metadata:schema
mef metadata:validate
mef metadata:resolve
mef metadata:query
mef metadata:provenance
mef metadata:diagnose
```

---

# 178. `metadata:list`

Podrá mostrar Descriptors registrados.

---

# 179. `metadata:show`

Podrá mostrar Metadata de un Subject.

---

# 180. `metadata:schema`

Podrá mostrar:

```text
schema
version
namespace
fields
constraints
```

---

# 181. `metadata:validate`

Deberá validar Descriptor contra Schema.

---

# 182. `metadata:resolve`

Podrá mostrar Effective Metadata.

---

# 183. `metadata:query`

Permitirá consultas controladas.

---

# 184. `metadata:provenance`

Podrá explicar Source y transformaciones.

---

# 185. `metadata:diagnose`

Podrá mostrar:

```text
subject
schema
effective values
sources
overrides
inheritance
merge strategies
validation state
```

---

# 186. Registry Integration

ENG-020 podrá registrar:

```text
MetadataSchema
MetadataDescriptor
MetadataProvider
MetadataResolver
MetadataNormalizer
MetadataMigration
```

---

# 187. Metadata Schema Definition

Conceptualmente:

```text
MetadataSchema
├── id
├── version
├── namespace
├── fields
├── constraints
├── defaults
└── compatibility
```

---

# 188. Metadata Field Definition

Conceptualmente:

```text
MetadataField
├── key
├── type
├── required
├── default
├── inheritable
├── overridePolicy
├── mergeStrategy
├── sensitivity
└── constraints
```

---

# 189. Metadata Descriptor Definition

Conceptualmente:

```text
MetadataDescriptor
├── subject
├── schema
├── values
├── source
├── owner
└── provenance
```

---

# 190. Metadata Resolver

Conceptualmente:

```text
MetadataResolver
├── normalize
├── validate
├── resolveSources
├── inherit
├── override
├── merge
└── effective
```

---

# 191. Metadata Registry

Conceptualmente:

```text
MetadataRegistry
├── registerSchema
├── registerDescriptor
├── resolve
├── query
├── invalidate
└── diagnose
```

---

# 192. Metadata Query

Conceptualmente:

```text
MetadataQuery
├── scope
├── schema
├── filters
├── sort
├── page
└── limit
```

---

# 193. Metadata Result

Podrá distinguir:

```text
FOUND
NOT_FOUND
INVALID
CONFLICT
UNAUTHORIZED
UNSUPPORTED_VERSION
```

---

# 194. Bootstrap

ENG-027 deberá construir Metadata Infrastructure antes de utilizar Metadata para Runtime Discovery.

---

# 195. Bootstrap Flow

```text
Configuration
      │
      ▼
Metadata Schemas
      │
      ▼
Namespace Validation
      │
      ▼
Providers
      │
      ▼
Discovery
      │
      ▼
Normalization
      │
      ▼
Validation
      │
      ▼
Registry
      │
      ▼
Indexes
      │
      ▼
Runtime Resolution
```

---

# 196. Bootstrap Failure

Podrá impedir Readiness ante:

```text
duplicate critical schema
invalid framework metadata
reserved namespace collision
unsupported critical metadata version
metadata dependency cycle
critical descriptor validation failure
```

---

# 197. Metadata Dependency

Metadata derivado podrá depender de otros Metadata.

---

# 198. Metadata Dependency Graph

Cuando exista derivación compleja deberá poder modelarse.

---

# 199. Metadata Dependency Cycle

Deberá detectarse cuando pueda producir Resolution infinita.

---

# 200. Lazy Metadata

Podrá resolverse bajo demanda.

---

# 201. Lazy Resolution Safety

No deberá ocultar Validation crítica hasta demasiado tarde.

---

# 202. Metadata Freeze

Registry podrá pasar a State inmutable después de Bootstrap.

---

# 203. Runtime Registration

Cuando se permita deberá estar controlada.

---

# 204. Dynamic Metadata

No deberá alterar Invariants arquitectónicos sin Validation y Policy.

---

# 205. Registry Generation

Cada cambio estructural podrá incrementar una Generation lógica.

---

# 206. Generation Usage

Podrá utilizarse para:

```text
cache invalidation
index invalidation
diagnostics
consistency
```

---

# 207. Metadata Snapshot

Podrá representar una vista inmutable de Registry.

---

# 208. Snapshot Consistency

Queries complejas podrán ejecutarse contra misma Generation.

---

# 209. Metadata Documentation

Metadata Schema deberá ser documentable automáticamente cuando sea posible.

---

# 210. Documentation Generation

Podrá producir:

```text
schema reference
key reference
deprecation report
capability catalog
module catalog
contract catalog
```

---

# 211. Metadata Governance

Todo Metadata arquitectónico deberá tener Lifecycle de gobernanza.

Conceptualmente:

```text
PROPOSED
   │
   ▼
DEFINED
   │
   ▼
ACTIVE
   │
   ▼
DEPRECATED
   │
   ▼
REMOVED
```

---

# 212. Metadata Definition Review

Nuevas Keys críticas deberán revisarse antes de reservar Namespace global.

---

# 213. Metadata Proliferation

Deberá evitarse crear Keys nuevas cuando una existente tenga la misma semántica.

---

# 214. Canonical Metadata

MEF deberá favorecer definiciones canónicas reutilizables.

---

# 215. Metadata Interoperability

Schemas públicos deberán documentar representación portable.

---

# 216. Internal Metadata

Podrá utilizar representación optimizada, siempre que no escape accidentalmente.

---

# 217. Metadata Boundary

Al cruzar Boundary deberá aplicarse:

```text
classification
authorization
serialization
version compatibility
size limits
validation
```

---

# 218. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
MetadataId
MetadataKey
MetadataType
MetadataNamespace

MetadataSchema
MetadataField

MetadataDescriptor
MetadataProvenance

MetadataProvider
MetadataResolver
MetadataRegistry

MetadataError
```

---

# 219. Optional Initial Components

Podrán incorporarse:

```text
MetadataNormalizer
MetadataQuery
MetadataIndex
MetadataMigration
MetadataDiagnostics
```

---

# 220. Later Components

Solo cuando exista necesidad demostrada:

```text
Distributed Metadata Registry
Metadata Federation
Remote Metadata Discovery
Metadata Graph Query
Cross-Cluster Metadata Index
Dynamic Metadata Schema Service
```

---

# 221. Estructura Conceptual de Directorios

```text
src/
└── Metadata/
    ├── Definition/
    │   ├── MetadataId
    │   ├── MetadataKey
    │   ├── MetadataType
    │   ├── MetadataNamespace
    │   ├── MetadataSchema
    │   └── MetadataField
    │
    ├── Descriptor/
    │   ├── MetadataDescriptor
    │   └── MetadataProvenance
    │
    ├── Provider/
    │   └── MetadataProvider
    │
    ├── Resolution/
    │   ├── MetadataResolver
    │   └── MetadataNormalizer
    │
    ├── Registry/
    │   └── MetadataRegistry
    │
    ├── Query/
    │   ├── MetadataQuery
    │   └── MetadataIndex
    │
    ├── Migration/
    │   └── MetadataMigration
    │
    ├── Diagnostics/
    │   └── MetadataDiagnostics
    │
    └── Error/
        └── MetadataError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 222. Error Namespace

ENG-057 utilizará:

```text
MEF-METADATA-xxx
```

---

# 223. Taxonomía ENG-057

```text
MEF-METADATA-001 Metadata not found
MEF-METADATA-002 Metadata identifier invalid
MEF-METADATA-003 Metadata key invalid
MEF-METADATA-004 Metadata type invalid
MEF-METADATA-005 Metadata namespace invalid
MEF-METADATA-006 Metadata namespace collision
MEF-METADATA-007 Metadata schema invalid
MEF-METADATA-008 Metadata schema duplicate
MEF-METADATA-009 Metadata schema unsupported
MEF-METADATA-010 Metadata descriptor invalid
MEF-METADATA-011 Metadata descriptor duplicate
MEF-METADATA-012 Metadata owner missing
MEF-METADATA-013 Metadata source invalid
MEF-METADATA-014 Metadata value invalid
MEF-METADATA-015 Metadata validation failed
MEF-METADATA-016 Metadata normalization failed
MEF-METADATA-017 Metadata resolution failed
MEF-METADATA-018 Metadata inheritance failed
MEF-METADATA-019 Metadata override denied
MEF-METADATA-020 Metadata merge conflict
MEF-METADATA-021 Metadata version unsupported
MEF-METADATA-022 Metadata migration failed
MEF-METADATA-023 Metadata serialization failed
MEF-METADATA-024 Metadata query invalid
MEF-METADATA-025 Metadata query denied
MEF-METADATA-026 Metadata size exceeded
MEF-METADATA-027 Metadata integrity violation
MEF-METADATA-028 Metadata security violation
MEF-METADATA-029 Metadata dependency cycle
MEF-METADATA-030 Metadata invariant violation
```

---

# 224. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Typed Metadata
Namespaces
Schemas
Ownership
Source Tracking
Immutable Descriptors
Validation
Normalization
Deterministic Resolution
Explicit Precedence
Explicit Inheritance
Explicit Override
Explicit Merge
Versioning
Compatibility
Registry
Provenance
Security Classification
Diagnostics
Testing
```

---

# 225. First Version Non-Goals

No deberá requerir:

```text
Distributed Metadata Registry
Metadata Federation
Remote Metadata Discovery
Graph Query Engine
Cross-Cluster Metadata Index
Dynamic Schema Service
```

---

# 226. Second Phase

Podrá incorporar:

```text
Metadata Indexes
Advanced Queries
Schema Migration
Generated Metadata Catalogs
Advanced Provenance
Runtime Metadata Registration
```

---

# 227. Third Phase

Solo cuando exista necesidad demostrada:

```text
Metadata Federation
Distributed Registry
Remote Discovery
Metadata Graph
Cross-Cluster Search
Dynamic Metadata Schemas
```

---

# 228. Invariantes de Ingeniería

ENG-057 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-1086 | Todo Metadata administrado por MEF deberá poseer significado, Namespace, Type, Owner, Scope y Source conocidos cuando participe en comportamiento arquitectónico. |
| EI-1087 | Metadata deberá permanecer diferenciado de Data, State, Context, Configuration, Policy, Registry y Secrets y no deberá utilizarse como Property Bag arbitrario, Service Locator o almacenamiento operacional. |
| EI-1088 | Todo Metadata que influya en Discovery, Routing, Security, Compatibility, Dependency Resolution, Code Generation o Runtime Behavior deberá validarse contra Schema o Contract explícito antes de utilizarse. |
| EI-1089 | Metadata Keys extensibles deberán utilizar Namespaces estables, `mef.*` permanecerá reservado al Framework y ninguna Source externa o Module deberá sobrescribir Metadata reservado sin Authority explícita. |
| EI-1090 | Metadata Resolution deberá ser determinística y no deberá depender del orden del Filesystem, Reflection, Provider Discovery, Module Loading o Registry Iteration cuando dicho orden no forme parte del Contract. |
| EI-1091 | Toda combinación de múltiples Metadata Sources deberá definir Precedence, Inheritance, Override y Merge Strategy explícitas y cualquier Conflict no resoluble determinísticamente deberá producir Error. |
| EI-1092 | Metadata publicado deberá favorecer Descriptors inmutables y toda modificación estructural deberá producir nueva versión, Descriptor o Registry Generation en lugar de mutación invisible. |
| EI-1093 | Metadata crítico deberá conservar Provenance suficiente para identificar Source, Provider, Authority, transformación y causa de su Effective Value. |
| EI-1094 | Metadata Schema evolutivo deberá poseer Version y Compatibility Rules y cualquier Breaking Change, Deprecation, Migration o Removal deberá seguir ENG-014 y ENG-016. |
| EI-1095 | Metadata externo deberá considerarse no confiable hasta completar Deserialization, Normalization, Validation, Authority Verification y Sanitization cuando corresponda. |
| EI-1096 | Metadata sensible deberá clasificarse y protegerse mediante Authorization; Secrets, Credentials y Tokens no deberán almacenarse como Metadata y Metadata interno no deberá exponerse automáticamente por ser descriptivo. |
| EI-1097 | Metadata utilizado para Code Generation, Runtime Discovery o Security Decisions deberá provenir exclusivamente de Sources validadas y ninguna entrada no confiable deberá alterar comportamiento arquitectónico mediante Metadata Injection. |
| EI-1098 | Metadata Indexing y Caching deberán mantener relación explícita con Registry Generation o Version para impedir resultados obsoletos después de cambios estructurales. |
| EI-1099 | Metadata Queries deberán poseer Scope, Limits, Authorization y comportamiento determinístico y no deberán permitir enumeración ilimitada o no autorizada de arquitectura interna. |
| EI-1100 | Derived Metadata deberá declarar Sources conceptuales y conservar Provenance suficiente para explicar cómo se obtuvo el Effective Value. |
| EI-1101 | Metadata Observability deberá permitir diagnosticar Registration, Validation, Resolution, Precedence, Inheritance, Override, Merge, Version y Provenance sin exponer Values sensibles ni generar Labels de alta cardinalidad. |
| EI-1102 | Metadata Testing deberá cubrir Schema, Namespace, Types, Validation, Normalization, Resolution, Inheritance, Override, Merge, Conflict, Versioning, Migration, Serialization, Query, Indexing, Security y Determinism. |
| EI-1103 | Build y Architecture Tests deberán detectar Duplicate Schemas, Namespace Collisions, Untyped Critical Metadata, Missing Owners, Missing Versions, Forbidden Overrides, Invalid Merge Strategies y Runtime Behavior derivado de Metadata no validado. |
| EI-1104 | Modules, Contracts, Applications, APIs, Messaging, Workflow, Configuration, Features, Policies, Resources, Lifecycle y Context deberán utilizar un modelo canónico de Metadata y no implementar sistemas paralelos incompatibles de Tags, Labels, Descriptors o Capabilities. |
| EI-1105 | La primera implementación deberá favorecer Metadata tipado, Namespaces, Schemas, Ownership, Provenance, Validation, Normalization, Deterministic Resolution, Explicit Precedence, Versioning, Security y Registry antes de introducir Federation, Distributed Metadata o Graph Query Engines. |

---

# 229. Continuidad de Invariantes

```text
ENG-053 → EI-1006 a EI-1025
ENG-054 → EI-1026 a EI-1045
ENG-055 → EI-1046 a EI-1065
ENG-056 → EI-1066 a EI-1085
ENG-057 → EI-1086 a EI-1105
```

---

# 230. Criterios de Conformidad

Una implementación será conforme con ENG-057 cuando:

- defina Metadata Keys;
- utilice Namespaces;
- reserve Namespace MEF;
- defina Types;
- defina Schemas;
- versione Schemas;
- defina Metadata Owner;
- defina Metadata Source;
- diferencie Metadata de State y Context;
- valide Metadata crítico;
- normalice Values;
- registre Descriptors;
- implemente Metadata Registry;
- implemente Resolution determinística;
- defina Source Precedence;
- controle Inheritance;
- controle Overrides;
- defina Merge Strategies;
- detecte Conflicts;
- conserve Provenance;
- controle Compatibility;
- soporte Deprecation;
- controle Serialization;
- trate Metadata externo como no confiable;
- clasifique Metadata sensible;
- proteja Queries;
- limite Query Results;
- controle Indexes y Caches;
- permita Diagnostics;
- pruebe Determinism;
- pruebe Security.

---

# 231. Riesgos

Deberán evitarse especialmente:

## Metadata as State

```text
metadata["currentBalance"] = ...
```

## Metadata as Service Locator

```text
metadata["database"] = databaseService
```

## Metadata as Secret Store

```text
metadata["apiKey"] = secret
```

## Untyped Metadata

```text
metadata["timeout"] = "whatever"
```

## Namespace Collision

Dos Modules registran:

```text
priority
```

con semánticas diferentes.

## Filesystem Precedence

El resultado depende del archivo descubierto primero.

## Reflection Order

El Runtime depende de un orden de Reflection no garantizado.

## Silent Override

Un Module reemplaza Metadata de Framework sin Authority.

## Universal Deep Merge

Objetos incompatibles se combinan silenciosamente.

## Metadata Injection

Input externo altera Runtime Discovery.

## Metadata Spoofing

Descriptor externo declara una Capability inexistente.

## Stale Metadata Index

Registry cambia pero Index permanece obsoleto.

## Sensitive Metadata Exposure

Una API publica topología interna o información de seguridad.

## Metadata Proliferation

Se crean múltiples Keys para el mismo concepto.

## Versionless Metadata

Schema cambia sin forma de detectar incompatibilidad.

## Metadata Dependency Cycle

```text
A derived from B
B derived from C
C derived from A
```

---

# 232. Relación con ENG-020

ENG-020 proporciona las reglas generales de Registry.

ENG-057 especializa:

```text
Registry
   │
   ▼
Metadata Registry
   │
   ├── Schemas
   ├── Descriptors
   ├── Providers
   └── Indexes
```

---

# 233. Relación con ENG-021

Contracts podrán exponerse mediante Metadata estructurado.

Metadata no sustituye al Contract.

---

# 234. Relación con ENG-025

Observability podrá consumir Metadata para enriquecer Telemetry.

No deberá copiar Metadata arbitrario a Logs o Metric Labels.

---

# 235. Relación con ENG-028

Module Descriptor será uno de los principales Consumers de ENG-057.

---

# 236. Relación con ENG-031

Serialization gobierna representación externa de Metadata.

---

# 237. Relación con ENG-036

Validation proporciona mecanismos reutilizables para Metadata Schema Validation.

---

# 238. Relación con ENG-049

Configuration Metadata podrá describir Configuration Keys.

Configuration Values no deberán almacenarse como Metadata por Default.

---

# 239. Relación con ENG-050

Feature Metadata describe Feature Definition.

Feature State permanece bajo Feature Management.

---

# 240. Relación con ENG-051

Policy Metadata describe Policies.

Policy Decisions no deberán almacenarse como Metadata.

---

# 241. Relación con ENG-053

La separación fundamental será:

```text
Metadata
→ describes the State model

State
→ represents current operational value
```

---

# 242. Relación con ENG-056

Context Metadata deberá permanecer acotado y Scoped.

ENG-057 define significado y Schema.

ENG-056 gobierna Propagation y Lifetime.

---

# 243. Relación con ENG-058

ENG-058 deberá formalizar **Discovery Engineering**.

La separación propuesta será:

```text
ENG-057 Metadata Engineering
→ What describes an artifact?

ENG-058 Discovery Engineering
→ How does MEF find available artifacts,
  components, providers and capabilities?
```

ENG-058 deberá cubrir:

```text
Discovery
Discovery Target
Discovery Source
Discovery Scope
Discovery Strategy
Discovery Provider

Static Discovery
Build-Time Discovery
Bootstrap Discovery
Runtime Discovery

Manifest Discovery
Registry Discovery
Filesystem Discovery
Reflection Discovery
Package Discovery
Module Discovery
Service Discovery

Discovery Candidate
Discovery Descriptor
Discovery Result

Discovery Filter
Discovery Constraint
Discovery Ranking
Discovery Selection

Discovery Cache
Discovery Index

Discovery Refresh
Discovery Invalidation

Discovery Determinism
Discovery Ordering
Discovery Conflict

Discovery Trust
Discovery Validation
Discovery Security

Discovery Observability
Discovery Diagnostics
Discovery Testing
```

---

# 244. Principio Rector

> **MEF deberá tratar Metadata como descripción tipada, versionada, gobernada y trazable de sus artefactos. Ninguna propiedad arquitectónica deberá depender de Metadata ambiguo, no validado o resuelto por orden accidental, y todo Metadata crítico deberá poder explicar qué significa, quién lo declaró, de dónde proviene y cómo se obtuvo su valor efectivo.**

---

# 245. Conclusión

**ENG-057 — Metadata Engineering** formaliza el sistema descriptivo de MEF.

La arquitectura fundamental queda:

```text
                  SUBJECT
                     │
                     ▼
                  METADATA
                     │
       ┌─────────────┼─────────────┐
       ▼             ▼             ▼
      KEY           TYPE         SCHEMA
       │             │             │
       └─────────────┼─────────────┘
                     ▼
                 DESCRIPTOR
                     │
                     ▼
                  REGISTRY
```

La resolución queda:

```text
Metadata Sources
       │
       ▼
   Normalize
       │
       ▼
    Validate
       │
       ▼
   Precedence
       │
       ▼
  Inheritance
       │
       ▼
    Override
       │
       ▼
      Merge
       │
       ▼
Effective Metadata
```

La Provenance queda:

```text
Effective Value
      │
      ▼
  Provenance
      │
 ┌────┼─────────┐
 ▼    ▼         ▼
Source Provider Authority
      │
      ▼
Transformation
```

La evolución queda:

```text
Schema v1
   │
   ▼
Compatible Change
   │
   ▼
Schema v2
   │
   ▼
Deprecation
   │
   ▼
Migration
   │
   ▼
Schema v3
```

La frontera de seguridad queda:

```text
External Metadata
       │
       ▼
  Deserialization
       │
       ▼
  Normalization
       │
       ▼
    Validation
       │
       ▼
Authority Check
       │
       ▼
Trusted Descriptor
       │
       ▼
Metadata Registry
```

La relación con Context queda:

```text
Metadata
ENG-057
defines meaning/schema
       │
       ▼
Context
ENG-056
carries selected values
during execution
```

El bloque arquitectónico queda:

```text
STATE
ENG-053
What information evolves?
        │
        ▼
RESOURCE
ENG-054
What finite capacity is consumed?
        │
        ▼
LIFECYCLE
ENG-055
When may components operate?
        │
        ▼
CONTEXT
ENG-056
What information accompanies execution?
        │
        ▼
METADATA
ENG-057
What describes artifacts and models?
```

La primera implementación deberá concentrarse en:

```text
MetadataId
MetadataKey
MetadataType
MetadataNamespace

MetadataSchema
MetadataField

MetadataDescriptor
MetadataProvenance

MetadataProvider
MetadataResolver
MetadataRegistry

MetadataError
```

con:

```text
Typed Metadata
Namespaces
Schemas
Ownership
Source Tracking
Immutable Descriptors
Validation
Normalization
Deterministic Resolution
Explicit Precedence
Explicit Inheritance
Explicit Override
Explicit Merge
Versioning
Compatibility
Provenance
Security Classification
Diagnostics
Testing
```

antes de introducir:

```text
Distributed Metadata Registry
Metadata Federation
Remote Metadata Discovery
Metadata Graph Query
Cross-Cluster Metadata Index
Dynamic Metadata Schema Service
```

Con **ENG-057** la serie global alcanza:

```text
EI-1105
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
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-031 — Serialization Engineering
- ENG-034 — Application Engineering
- ENG-036 — Validation Engineering
- ENG-037 — Caching Engineering
- ENG-041 — Messaging Engineering
- ENG-044 — API Engineering
- ENG-046 — Authorization Engineering
- ENG-049 — Configuration Management Engineering
- ENG-050 — Feature Management Engineering
- ENG-051 — Policy Engineering
- ENG-052 — Workflow Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-056 — Context Management Engineering
- ENG-058 — Discovery Engineering
```