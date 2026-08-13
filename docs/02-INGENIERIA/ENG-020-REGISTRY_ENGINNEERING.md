---
id: ENG-020
titulo: Registry Engineering
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
  - ENG-005
  - ENG-006
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ARQ-004
  - ARQ-006
  - ARQ-007
  - ARQ-008
  - ARQ-011
  - ARQ-014
relacionados:
  - ENG-021
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-027
keywords:
  - registry
  - catalog
  - discovery
  - metadata
  - modules
  - contracts
  - capabilities
  - providers
  - implementations
  - extension points
  - runtime
  - mef
---

# ENG-020

# Registry Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación de Ingeniería del **Registry** de **MEF (Modular Enterprise Framework)**.

El Registry deberá proporcionar un catálogo gobernado, consultable y determinista de los elementos arquitectónicos conocidos por una instancia de MEF.

Su responsabilidad principal será responder:

```text
¿Qué existe?
¿Qué está registrado?
¿Quién lo proporciona?
¿A quién pertenece?
¿Qué metadata posee?
¿Qué capacidades expone?
¿Qué versión publica?
¿En qué estado se encuentra?
¿Es visible desde este contexto?
```

El Registry no deberá construir las instancias de los componentes registrados.

---

# 2. Declaración

La regla fundamental será:

> **El Registry mantiene conocimiento arquitectónico; no administra ordinariamente instancias de Runtime.**

Por tanto:

```text
Registry
    │
    └── metadata / discovery / ownership / visibility

Service Container
    │
    └── construction / resolution / scopes / instances
```

---

# 3. Posición Arquitectónica

```text
                MANIFESTS
                    │
                    ▼
                DISCOVERY
                    │
                    ▼
                REGISTRY
                    │
       ┌────────────┼────────────┐
       ▼            ▼            ▼
    Modules      Contracts   Capabilities
       │            │            │
       └────────────┼────────────┘
                    ▼
               Metadata View
                    │
       ┌────────────┼────────────┐
       ▼            ▼            ▼
   Container      Runtime      Tooling
```

---

# 4. Objetivos

El Registry deberá:

- centralizar metadata arquitectónica;
- registrar elementos conocidos;
- permitir Discovery;
- permitir Lookup;
- preservar ownership;
- controlar visibility;
- identificar Providers;
- relacionar Contracts e Implementations;
- registrar Capabilities;
- registrar Extension Points;
- permitir inspección;
- facilitar validación;
- facilitar diagnóstico;
- soportar Runtime;
- soportar Tooling;
- preservar determinismo.

---

# 5. Registry no es Service Container

La separación deberá ser estricta:

```text
Registry
→ What exists?

Container
→ How do I build it?
```

Ejemplo:

```text
Registry:
CT-CUSTOMER-001 exists
provided by MOD-CUSTOMER
version 1.2.0

Container:
CT-CUSTOMER-001
→ MySqlCustomerRepository instance
```

---

# 6. Registry no es Package Manager

El Package Manager administra:

```text
Packages
installation
dependency resolution
artifacts
```

El Registry administra:

```text
architectural elements
discovered from installed/available components
```

---

# 7. Registry no es Manifest

El Manifest es una declaración.

El Registry es una representación activa del conocimiento derivado de declaraciones válidas.

```text
Manifest
    ↓
Discovery
    ↓
Validation
    ↓
Registry Entry
```

---

# 8. Registry no es Runtime

Runtime podrá consultar el Registry.

Pero:

```text
Registry ≠ Runtime
```

El Registry es una capacidad del Runtime, no el Runtime completo.

---

# 9. Elementos Registrables

La primera versión deberá considerar al menos:

```text
Modules
Contracts
Providers
Capabilities
Implementations
Extension Points
```

Posteriormente podrán añadirse:

```text
Adapters
Handlers
Subscribers
Commands
Policies
Resources
Schemas
Migrations
```

cuando exista necesidad arquitectónica.

---

# 10. Registry Entry

Todo elemento registrado deberá representarse mediante una `Registry Entry`.

Conceptualmente:

```text
RegistryEntry
├── id
├── type
├── version
├── owner
├── provider
├── visibility
├── state
├── metadata
└── provenance
```

---

# 11. Entry Identity

Toda Entry deberá poseer identidad estable.

Ejemplo:

```text
MOD-CRM
CT-CUSTOMER-001
CAP-AUDIT-001
```

La nomenclatura deberá respetar ENG-005.

---

# 12. Entry Type

Cada Entry deberá declarar su tipo.

Ejemplos:

```text
module
contract
provider
capability
implementation
extension-point
```

---

# 13. Registry Identity Uniqueness

Una identidad no deberá representar dos elementos incompatibles dentro del mismo namespace gobernado.

---

# 14. Duplicate Registration

Un registro duplicado deberá:

```text
merge
reject
version
```

únicamente conforme a una regla explícita.

Nunca deberá sobrescribirse silenciosamente.

---

# 15. Ownership

Toda Entry relevante deberá poder asociarse a un Owner.

Ejemplo:

```text
CT-CUSTOMER-001
owner: MOD-CUSTOMER
```

---

# 16. Ownership Semantics

Ownership representa responsabilidad arquitectónica.

No implica necesariamente:

```text
instance ownership
```

Eso pertenece al Container/Scope.

---

# 17. Provider

Una Entry podrá indicar qué Provider la declaró.

Ejemplo:

```text
CT-CUSTOMER-001
provider: CustomerProvider
```

---

# 18. Package Provenance

Cuando sea aplicable deberá conocerse:

```text
Package
Module
Provider
```

que originaron la Entry.

---

# 19. Provenance

Conceptualmente:

```text
Registry Entry
      │
      ├── Package
      ├── Manifest
      ├── Module
      ├── Provider
      └── Discovery Source
```

---

# 20. Provenance Importance

La procedencia permite:

- auditoría;
- diagnóstico;
- Security Policy;
- resolución de conflictos;
- trazabilidad;
- explicación de Runtime.

---

# 21. Registration

Registration incorpora una Entry válida al Registry.

```text
Candidate
    ↓
Validate
    ↓
Authorize
    ↓
Register
```

---

# 22. Registration Preconditions

Antes de registrar deberán comprobarse, según corresponda:

```text
identity
schema
ownership
compatibility
visibility
provenance
security policy
```

---

# 23. Registration Atomicity

Una operación compuesta de Registration no deberá dejar el Registry en un estado parcialmente inconsistente.

---

# 24. Registration Failure

Ante fallo:

```text
Registry before
      =
Registry after
```

cuando la operación sea atómica.

---

# 25. Registration Source

Las Entries podrán originarse desde:

```text
Manifest
Provider
Framework Core
Generated Metadata
Approved Runtime Discovery
```

---

# 26. Manual Registration

Podrá permitirse manualmente desde infraestructura autorizada.

No deberá convertirse en una API arbitraria disponible para cualquier componente.

---

# 27. Registration Phase

La mayor parte del registro debería ocurrir durante:

```text
Discovery
Bootstrap
Composition
```

antes de Activation.

---

# 28. Runtime Registration

Registrar nuevos elementos durante Runtime será una capacidad avanzada.

No deberá asumirse en la primera implementación.

---

# 29. Frozen Registry

Después de completar Bootstrap, el Registry podrá entrar en estado:

```text
Frozen
```

para impedir modificaciones no gobernadas.

---

# 30. Mutable vs Immutable Registry

Conceptualmente podrá existir:

```text
RegistryBuilder
      ↓
Registry Snapshot
```

donde el Snapshot sea inmutable.

---

# 31. Registry Builder

`RegistryBuilder` podrá:

- aceptar Entries;
- validar;
- detectar conflictos;
- construir índices;
- producir Snapshot.

---

# 32. Registry Snapshot

Un Snapshot representa una visión consistente del Registry en un momento determinado.

---

# 33. Snapshot Benefits

Permite:

- determinismo;
- concurrencia segura;
- cache;
- debugging;
- comparación;
- reproducibilidad.

---

# 34. Snapshot Identity

Un Snapshot podrá tener:

```text
registryVersion
timestamp
fingerprint
```

cuando resulte útil.

---

# 35. Registry Fingerprint

Podrá calcularse a partir de metadata significativa.

Ejemplo conceptual:

```text
hash(
  sorted registry entries
)
```

---

# 36. Deterministic Fingerprint

El mismo conjunto lógico de Entries deberá producir el mismo fingerprint cuando se utilice esta capacidad.

---

# 37. Lookup

Lookup recupera una Entry mediante identidad conocida.

Ejemplo conceptual:

```text
registry.get("CT-CUSTOMER-001")
```

---

# 38. Lookup Result

Deberá distinguir:

```text
Found
NotFound
Forbidden
Ambiguous
```

cuando corresponda.

---

# 39. Lookup by ID

Será el mecanismo más directo.

---

# 40. Lookup by Type

Podrá consultarse:

```text
all contracts
all modules
all capabilities
```

---

# 41. Lookup by Owner

Ejemplo:

```text
all entries owned by MOD-CRM
```

---

# 42. Lookup by Provider

Ejemplo:

```text
entries registered by CrmProvider
```

---

# 43. Lookup by Capability

Podrá responder:

```text
who provides CAP-AUDIT-001?
```

---

# 44. Discovery

Discovery es una consulta más amplia que Lookup.

```text
Lookup
→ known identity

Discovery
→ find matching architectural elements
```

---

# 45. Discovery Query

Podrá incluir:

```text
type
contract
capability
version
owner
provider
visibility
state
metadata
```

---

# 46. Discovery Determinism

Los mismos datos y Query deberán producir resultados equivalentes.

---

# 47. Discovery Ordering

El orden de resultados deberá definirse cuando tenga significado.

No deberá depender del orden de filesystem.

---

# 48. Discovery Does Not Instantiate

Una Query de Discovery:

```text
registry.find(...)
```

no deberá construir Services.

---

# 49. Discovery vs Resolution

```text
Registry Discovery
→ returns metadata

Container Resolution
→ returns instance
```

---

# 50. Module Registry

Los Modules deberán registrarse con metadata suficiente.

Ejemplo:

```text
id: MOD-CRM
version: 2.1.0
state: Registered
package: PKG-CRM
```

---

# 51. Module Metadata

Podrá incluir:

```text
name
version
owner
dependencies
contracts
capabilities
providers
extension points
state
```

---

# 52. Contract Registry

Los Contracts deberán poder descubrirse mediante su identificador canónico:

```text
CT-*
```

---

# 53. Contract Entry

Conceptualmente:

```text
CT-CUSTOMER-001
├── version
├── owner
├── schema/signature metadata
├── providers
└── compatibility metadata
```

---

# 54. Contract Implementation Relationship

El Registry podrá representar:

```text
Contract
    │
    ├── Implementation A
    └── Implementation B
```

sin construirlas.

---

# 55. Implementation Entry

Una Implementation podrá registrar:

```text
id
implements
version
provider
module
package
capabilities
visibility
```

---

# 56. Implementation Identity

No deberá depender exclusivamente del nombre físico de una clase cuando necesite identidad arquitectónica estable.

---

# 57. Container Integration

El Container podrá consultar:

```text
compatible implementations for CT-X
```

y posteriormente construir la seleccionada.

---

# 58. Registry Does Not Select Instance

El Registry podrá devolver Candidates.

La decisión final de Resolution pertenece al Container y Policy correspondiente.

---

# 59. Capability Registry

Una `Capability` representa algo que un componente puede proporcionar o requerir.

Ejemplo:

```text
CAP-AUDIT-001
CAP-STORAGE-001
CAP-MESSAGING-001
```

si esta nomenclatura es formalizada por ENG-005.

---

# 60. Capability Entry

Podrá incluir:

```text
id
version
provider
owner
requirements
metadata
```

---

# 61. Provides

El Registry deberá poder representar:

```text
MOD-AUDIT
provides
CAP-AUDIT-001
```

---

# 62. Requires

También:

```text
MOD-CRM
requires
CAP-AUDIT-001
```

cuando sea arquitectónicamente declarado.

---

# 63. Capability Resolution

El Registry puede descubrir Providers de una Capability.

El Container/Runtime determinará cómo utilizarla.

---

# 64. Provider Registry

Los Providers también podrán registrarse.

---

# 65. Provider Entry

Conceptualmente:

```text
Provider
├── owner module
├── package
├── provided entries
├── dependencies
└── state
```

---

# 66. Provider Ownership

Un Provider deberá pertenecer a una frontera conocida.

---

# 67. Provider Visibility

No todos los Providers necesitan ser públicamente descubribles por Modules externos.

---

# 68. Extension Point Registry

Los Extension Points deberán poseer identidad estable cuando formen parte de la arquitectura extensible.

---

# 69. Extension Point Entry

Podrá contener:

```text
id
owner
contract
version
allowed extensions
policy
multiplicity
ordering
```

---

# 70. Extension Registration

Una Extension podrá registrarse contra un Extension Point válido.

---

# 71. Invalid Extension Point

Una Extension dirigida a un punto inexistente deberá fallar o permanecer inactiva conforme a Policy explícita.

---

# 72. Extension Compatibility

Deberá verificarse:

```text
extension
↔
extension point
```

mediante ENG-016 cuando aplique.

---

# 73. Visibility

El Registry deberá poder modelar visibilidad.

Taxonomía inicial:

```text
private
module
public
framework
```

---

# 74. Private

Visible únicamente dentro del contexto propietario autorizado.

---

# 75. Module

Visible dentro del Module o frontera definida.

---

# 76. Public

Disponible para consumidores externos autorizados.

---

# 77. Framework

Reservado o disponible para infraestructura MEF según Policy.

---

# 78. Visibility Enforcement

Lookup y Discovery deberán respetar Context.

---

# 79. Registry Context

Una Query podrá ejecutarse con:

```text
consumer module
application
runtime
permissions
```

cuando sea necesario.

---

# 80. Forbidden Lookup

Una Entry existente pero no visible no deberá exponerse como si fuera públicamente accesible.

---

# 81. Information Disclosure

Security podrá requerir que:

```text
Forbidden
```

se presente externamente como:

```text
NotFound
```

para determinadas consultas.

---

# 82. Internal Registry API

Tooling autorizado podrá tener mayor visibilidad que un Module ordinario.

---

# 83. Registry Indexes

Para eficiencia podrán mantenerse índices por:

```text
id
type
owner
provider
contract
capability
package
```

---

# 84. Index Consistency

Los índices deberán corresponder siempre al Snapshot activo.

---

# 85. Derived Index

Un índice es derivado.

No deberá convertirse en Source of Truth independiente.

---

# 86. Source of Truth

La Source of Truth del Registry será el conjunto validado de Entries del Snapshot.

---

# 87. Metadata

Una Entry podrá poseer metadata extensible.

---

# 88. Core Metadata

Los campos esenciales deberán permanecer gobernados y tipados.

No deberán almacenarse únicamente dentro de un mapa arbitrario.

---

# 89. Extension Metadata

Podrá existir:

```text
metadata:
  vendor:
    ...
```

o equivalente.

---

# 90. Metadata Namespace

Las extensiones deberían utilizar namespace para evitar colisiones.

---

# 91. Metadata Validation

Metadata que afecte comportamiento deberá validarse.

---

# 92. Unknown Metadata

La política deberá definir si metadata desconocida:

```text
ignore
warn
reject
```

según Schema/version.

---

# 93. Manifest Integration

ENG-003 será una fuente principal de Registry Entries.

---

# 94. Manifest Parsing

Conceptualmente:

```text
Manifest
   ↓
Parse
   ↓
Schema Validation
   ↓
Normalize
   ↓
Registry Candidate
```

---

# 95. Manifest Does Not Register Directly

Un Manifest inválido no deberá introducir Entries parciales.

---

# 96. Normalization

Antes de Registration deberán normalizarse:

```text
identifiers
versions
visibility
metadata
references
```

---

# 97. Schema Version

El Registry deberá conocer la versión del Schema de origen cuando sea relevante.

---

# 98. Generated Metadata

Tooling podrá generar Registry metadata a partir de código.

Sin embargo, deberá reconciliarse con Manifest y Contracts oficiales.

---

# 99. Metadata Conflict

Si código y Manifest declaran información incompatible:

```text
FAIL
```

o diagnóstico explícito según Policy.

---

# 100. No Silent Reconciliation

El Registry no deberá decidir arbitrariamente qué fuente “gana”.

---

# 101. Discovery Pipeline

La cadena recomendada será:

```text
Installed Packages
       ↓
Manifest Discovery
       ↓
Schema Validation
       ↓
Candidate Entries
       ↓
Architecture Validation
       ↓
Security Validation
       ↓
Compatibility Validation
       ↓
Registry Builder
       ↓
Registry Snapshot
```

---

# 102. Package Discovery

ENG-013 determinará qué Packages están instalados/disponibles.

Registry Engineering no deberá escanear arbitrariamente todo el filesystem sin reglas.

---

# 103. Discovery Roots

Los lugares desde donde se descubre metadata deberán estar definidos por Configuration o Packaging.

---

# 104. Filesystem Discovery

Cuando se utilice deberá:

- limitar roots;
- evitar traversal no autorizado;
- ser determinista;
- validar archivos.

---

# 105. Network Discovery

No será requisito de la primera implementación.

---

# 106. Remote Registry

Un Registry remoto podrá existir en versiones futuras para catálogo distribuido.

No forma parte del Runtime Registry mínimo.

---

# 107. Local Runtime Registry

La primera implementación deberá ser local a una instancia de Application/Runtime.

---

# 108. Registry Lifecycle

Conceptualmente:

```text
Empty
  ↓
Building
  ↓
Validated
  ↓
Frozen
  ↓
Active
  ↓
Disposed
```

La formalización exacta deberá coordinarse con ENG-015.

---

# 109. Empty

No contiene Entries de Application.

---

# 110. Building

Acepta Registration autorizada.

---

# 111. Validated

Las Entries y relaciones principales fueron verificadas.

---

# 112. Frozen

No acepta mutación ordinaria.

---

# 113. Active

El Snapshot está siendo utilizado por Runtime.

---

# 114. Disposed

Ya no deberá utilizarse.

---

# 115. Invalid Transition

Una Registration ordinaria sobre Registry Frozen deberá fallar.

---

# 116. Registry Version

Los cambios de Snapshot podrán incrementar una versión interna.

---

# 117. Version vs Contract Version

No deberán confundirse:

```text
Registry Snapshot Version
≠
Contract Version
≠
Module Version
```

---

# 118. Snapshot Replacement

Una futura implementación dinámica podrá construir:

```text
Snapshot N+1
```

y sustituir atómicamente:

```text
Snapshot N
```

---

# 119. Immutable Snapshot

Las Readers concurrentes deberían poder continuar utilizando un Snapshot consistente.

---

# 120. Dynamic Registry

No será requisito de la primera versión.

---

# 121. Registry Transaction

Una actualización múltiple podrá tratarse como transacción lógica.

---

# 122. Transaction Example

Registrar:

```text
Module
Provider
Contract
Implementation
```

como unidad coherente.

Si falla Implementation:

```text
rollback complete registration
```

cuando la operación requiera atomicidad.

---

# 123. Partial Module Registration

Un Module no deberá aparecer como completamente registrado si faltan Entries obligatorias.

---

# 124. Validation

El Registry deberá validar relaciones.

---

# 125. Referential Integrity

Una referencia como:

```text
implementation implements CT-X
```

deberá apuntar a Contract válido cuando éste sea obligatorio.

---

# 126. Owner Integrity

Un Owner declarado deberá existir o pertenecer a una categoría permitida.

---

# 127. Provider Integrity

Un Provider referenciado deberá ser válido.

---

# 128. Capability Integrity

Una Capability requerida/proporcionada deberá tener identidad válida.

---

# 129. Extension Integrity

Una Extension deberá referenciar un Extension Point válido.

---

# 130. Version Integrity

Las versiones deberán cumplir ENG-014.

---

# 131. Compatibility Integrity

Las relaciones versionadas deberán cumplir ENG-016.

---

# 132. State Integrity

Las Entries no deberán declarar estados imposibles respecto al estado del propietario.

---

# 133. Module State Projection

Registry podrá exponer el estado conocido de un Module.

Pero ENG-015 continúa siendo autoridad sobre semántica de estados.

---

# 134. Registry State Is Metadata

El Registry refleja estado.

No deberá sustituir al State Machine.

---

# 135. Event Integration

Cambios gobernados del Registry podrán emitir Events.

Ejemplos:

```text
registry.entry.registered
registry.snapshot.created
registry.snapshot.activated
```

---

# 136. Event Bus Dependency

El Bootstrap deberá evitar ciclos entre:

```text
Registry
Event Bus
Container
```

---

# 137. Bootstrap Events

Antes del Event Bus completo podrá utilizarse una estrategia mínima o diferida.

---

# 138. Event Delivery

Un Event de Registry no deberá considerarse Source of Truth.

El Snapshot continúa siendo la autoridad.

---

# 139. Query API

La API conceptual podrá incluir:

```text
get(id)
find(query)
exists(id)
list(type)
providers(capability)
implementations(contract)
owner(id)
```

La API concreta dependerá del lenguaje.

---

# 140. `get`

Busca una identidad exacta.

---

# 141. `find`

Realiza Discovery mediante filtros.

---

# 142. `exists`

Comprueba existencia visible.

---

# 143. `list`

Enumera Entries de un tipo.

---

# 144. `providers`

Devuelve metadata de Providers capaces de ofrecer una Capability.

---

# 145. `implementations`

Devuelve Implementations conocidas para un Contract.

---

# 146. Query Purity

Las Queries no deberán modificar Registry.

---

# 147. Query Side Effects

Una Query no deberá:

```text
instantiate
activate
install
download
register
```

componentes.

---

# 148. Pagination

Registries grandes podrán soportar paginación en APIs de Tooling.

---

# 149. Filtering

Los filtros deberán ser explícitos y tipados cuando sea razonable.

---

# 150. Search

Búsqueda textual podrá existir para Tooling.

No deberá sustituir Lookup por identidad.

---

# 151. Case Sensitivity

Los IDs arquitectónicos deberán seguir la regla definida en ENG-005.

El Registry no deberá introducir normalización incompatible.

---

# 152. Canonical IDs

Internamente deberán utilizarse identificadores canónicos.

---

# 153. Aliases

Los Aliases podrán existir únicamente si están gobernados.

---

# 154. Alias Resolution

No deberá crear ambigüedad.

---

# 155. Deprecated Entry

Una Entry podrá marcarse Deprecated.

---

# 156. Deprecation Metadata

Podrá contener:

```text
deprecatedSince
replacement
removalVersion
reason
```

---

# 157. Deprecated Does Not Mean Missing

Una Entry Deprecated sigue existiendo mientras sea soportada.

---

# 158. Removed Entry

Una Entry removida no deberá aparecer en el Snapshot activo.

---

# 159. Compatibility Query

Tooling podrá preguntar:

```text
which implementations satisfy CT-X@^2?
```

Registry devolverá Candidates; ENG-016 determinará compatibilidad.

---

# 160. Dependency Relationships

El Registry podrá representar relaciones entre Entries.

---

# 161. Relationship Types

Ejemplos:

```text
owns
provides
requires
implements
extends
depends-on
registered-by
packaged-by
```

---

# 162. Registry Graph

Estas relaciones forman un:

```text
Registry Graph
```

---

# 163. Registry Graph vs Dependency Graph

Debe distinguirse:

```text
Registry Graph
→ architectural metadata relationships

Dependency Graph
→ runtime object construction relationships
```

---

# 164. Architecture Graph

ARQ podrá definir relaciones de nivel superior.

Registry podrá materializar una vista parcial de ellas.

---

# 165. Graph Query

Tooling podrá responder:

```text
What provides CT-CUSTOMER-001?
What requires CAP-AUDIT-001?
Who owns this Contract?
Which Package introduced this Implementation?
```

---

# 166. `why`

Podrá explicar por qué una Entry existe.

Ejemplo:

```text
CT-CUSTOMER-001

declared by:
MOD-CUSTOMER

from:
PKG-CUSTOMER

source:
mef.manifest.json
```

---

# 167. Reverse Lookup

Podrá responder:

```text
what depends on MOD-IDENTITY?
```

---

# 168. Impact Analysis

El Registry Graph podrá utilizarse para análisis de impacto.

---

# 169. Removal Impact

Antes de eliminar un Package/Module podrá consultarse qué Entries dependen de él.

---

# 170. Package Manager Integration

ENG-013 podrá utilizar Registry metadata para advertir:

```text
removing PKG-X impacts...
```

pero la decisión de Package Dependency seguirá perteneciendo al Package Manager.

---

# 171. Build Integration

ENG-012 podrá generar un Registry Snapshot durante Build para validación.

---

# 172. Build-Time Registry

Podrá utilizarse para detectar:

```text
duplicate IDs
missing Contracts
invalid ownership
invalid extensions
incompatible versions
```

---

# 173. Runtime Registry

El Runtime podrá cargar un Snapshot validado o reconstruirlo determinísticamente.

---

# 174. Build vs Runtime Consistency

El Snapshot Runtime deberá ser compatible con lo validado durante Build para el mismo Artifact/Configuration.

---

# 175. Registry Artifact

Un Snapshot compilado podrá empaquetarse como Artifact derivado.

---

# 176. Registry Artifact Is Derived

No deberá reemplazar los Manifests como Source of Truth.

---

# 177. Cache

El Snapshot podrá cachearse.

---

# 178. Cache Invalidation

Deberá invalidarse cuando cambien elementos relevantes como:

```text
Packages
Manifests
Configuration affecting discovery
Contracts
Registry schema
```

---

# 179. Registry Schema

La representación serializable del Snapshot deberá tener Schema versionado si se persiste.

---

# 180. Backward Compatibility

Los Readers deberán manejar versiones soportadas conforme ENG-016.

---

# 181. Serialization

Un Snapshot podrá serializarse para:

- cache;
- debugging;
- tooling;
- build artifacts.

---

# 182. Serialization Determinism

La representación canónica debería ser estable cuando se utilice para hashing.

---

# 183. Sensitive Metadata

El Snapshot no deberá incluir Secrets.

---

# 184. Secret References

Cuando una Entry requiera Configuration sensible deberá registrar únicamente referencias o metadata no secreta.

---

# 185. Security

Registry es una superficie sensible porque revela arquitectura interna.

---

# 186. Registry Access Control

No todas las Queries deberán estar disponibles para todos los consumidores.

---

# 187. Public Registry View

Podrá existir una vista limitada.

---

# 188. Internal Registry View

Runtime/Tooling autorizado podrá utilizar una vista más completa.

---

# 189. Admin Registry View

Podrá existir para diagnóstico con permisos apropiados.

---

# 190. Least Information

Cada consumidor deberá recibir únicamente metadata necesaria.

---

# 191. Untrusted Module

Un Module no confiable no deberá enumerar automáticamente todas las Entries internas del Framework.

---

# 192. Registration Authorization

Packages/Providers deberán registrar únicamente tipos y namespaces autorizados.

---

# 193. Namespace Ownership

Un Publisher no deberá apropiarse arbitrariamente del namespace de otro.

---

# 194. Protected IDs

Core podrá reservar IDs o namespaces.

---

# 195. Signature Integration

Cuando Packages estén firmados, Provenance podrá incluir información de verificación.

---

# 196. Trust Metadata

Ejemplo conceptual:

```text
trusted: true
publisher: ...
signatureVerified: true
```

No deberá aceptarse solo porque el Manifest lo afirme.

---

# 197. Security Source of Truth

Los atributos de confianza deberán derivarse del mecanismo de Security, no de metadata auto-declarada no verificada.

---

# 198. Audit

Las mutaciones del Registry podrán generar evidencia auditable cuando sean relevantes.

---

# 199. Registry Audit Record

Podrá contener:

```text
operation
entry
source
actor
timestamp
result
snapshot
```

---

# 200. Logging

ENG-010 podrá registrar:

```text
registry.build.started
registry.entry.rejected
registry.conflict.detected
registry.snapshot.created
registry.snapshot.activated
```

---

# 201. Logging Volume

Las Queries normales no deberían generar INFO por cada Lookup.

TRACE/DEBUG podrán utilizarse para diagnóstico.

---

# 202. Metrics

Observability futura podrá medir:

```text
registry_entries_total
registry_build_duration
registry_conflicts_total
registry_queries_total
registry_cache_hits
```

---

# 203. Error Taxonomy

Taxonomía conceptual:

```text
MEF-REG-001 Entry not found
MEF-REG-002 Duplicate entry
MEF-REG-003 Invalid entry
MEF-REG-004 Invalid owner
MEF-REG-005 Invalid provider
MEF-REG-006 Visibility violation
MEF-REG-007 Registry frozen
MEF-REG-008 Referential integrity failure
MEF-REG-009 Compatibility failure
MEF-REG-010 Registration unauthorized
MEF-REG-011 Invalid extension point
MEF-REG-012 Metadata conflict
MEF-REG-013 Snapshot invalid
MEF-REG-014 Schema unsupported
MEF-REG-015 Registry disposed
```

---

# 204. Entry Not Found

Ejemplo:

```text
MEF-REG-001

Registry entry not found.

Requested:
CT-CUSTOMER-001

Context:
MOD-CRM
```

---

# 205. Duplicate Entry

```text
MEF-REG-002

Duplicate registry identity.

ID:
CT-PAYMENT-001

Existing owner:
MOD-PAYMENT

Candidate owner:
MOD-EXTERNAL-PAYMENT
```

---

# 206. Visibility Violation

```text
MEF-REG-006

Registry entry is not visible
from the requesting context.

Entry:
IdentityInternalProvider

Owner:
MOD-IDENTITY

Consumer:
MOD-CRM
```

---

# 207. Frozen Registry

```text
MEF-REG-007

Registry mutation rejected.

Registry state:
Frozen

Attempted operation:
Register CT-NEW-001
```

---

# 208. Referential Integrity Failure

```text
MEF-REG-008

Implementation references unknown Contract.

Implementation:
CustomerRepositorySql

Contract:
CT-CUSTOMER-001
```

---

# 209. Metadata Conflict

```text
MEF-REG-012

Conflicting architectural metadata.

Entry:
MOD-CRM

Manifest version:
2.0.0

Generated metadata version:
1.9.0
```

---

# 210. Diagnostics

Los errores deberán indicar cuando sea posible:

```text
Entry
Source
Owner
Provider
Package
Manifest
Reason
Suggested action
```

---

# 211. Testing

ENG-009 deberá cubrir:

- Registration;
- Lookup;
- Discovery;
- duplicate detection;
- ownership;
- visibility;
- referential integrity;
- Snapshot creation;
- freeze;
- serialization;
- concurrency;
- compatibility.

---

# 212. Unit Tests

El Registry deberá probarse sin requerir Container completo.

---

# 213. Registration Tests

Deberán validar Entries válidas e inválidas.

---

# 214. Snapshot Tests

Dos Builders equivalentes deberán producir Snapshots equivalentes.

---

# 215. Fingerprint Tests

Si existe fingerprint, deberá ser determinista.

---

# 216. Visibility Tests

Deberán comprobar diferentes Query Contexts.

---

# 217. Integrity Tests

Deberán probar referencias inexistentes.

---

# 218. Conflict Tests

Deberán probar IDs duplicados y metadata incompatible.

---

# 219. Concurrency Tests

Un Snapshot inmutable deberá poder consultarse concurrentemente de forma segura.

---

# 220. Serialization Tests

Serializar/deserializar deberá preservar metadata soportada.

---

# 221. Security Tests

Deberán probar:

```text
unauthorized registration
private entry discovery
namespace takeover
protected metadata manipulation
```

---

# 222. Container Integration Tests

Deberán verificar que Candidates obtenidos del Registry puedan utilizarse por ENG-019 sin convertir el Registry en Container.

---

# 223. Performance

Registry Lookup estará en rutas potencialmente frecuentes.

Deberá favorecer índices eficientes.

---

# 224. Lookup Complexity

Lookup por ID debería aproximarse conceptualmente a:

```text
O(1)
```

cuando la estructura de datos lo permita.

---

# 225. Discovery Complexity

Queries amplias podrán usar índices secundarios.

---

# 226. Snapshot Optimization

Los índices deberán construirse al crear Snapshot cuando sea beneficioso.

---

# 227. Runtime Mutation Cost

Evitar mutación frecuente simplifica:

- índices;
- concurrencia;
- cache;
- consistencia.

---

# 228. Immutability Preference

Por ello, la primera versión deberá favorecer:

```text
mutable builder
+
immutable snapshot
```

---

# 229. Memory

Registry deberá almacenar metadata, no Instances pesadas.

---

# 230. No Service Instances

No deberán almacenarse ordinariamente:

```text
database connections
HTTP clients
repositories
business services
```

dentro del Registry.

---

# 231. Lightweight References

Podrá almacenar:

```text
implementation ID
class reference metadata
factory ID
provider ID
```

según perfil.

---

# 232. Language Independence

Registry no deberá requerir que todos los lenguajes representen Implementation mediante nombre de clase.

---

# 233. Implementation Descriptor

Podrá utilizarse un descriptor abstracto.

Ejemplo:

```text
implementation:
  type: class
  reference: ...
```

o:

```text
implementation:
  type: factory
  reference: ...
```

según Implementation Profile.

---

# 234. Technology Neutrality

MEF no deberá depender universalmente de:

```text
Laravel service discovery
Symfony bundles
Spring component scanning
.NET assembly scanning
NestJS metadata
```

Podrán existir adapters.

---

# 235. Profile Mapping

```text
MEF Registry
     │
     ├── PHP implementation
     ├── Java implementation
     ├── .NET implementation
     └── TypeScript implementation
```

todos deberán preservar la semántica esencial.

---

# 236. Minimal Implementation

La primera implementación puede utilizar estructuras sencillas:

```text
Map<ID, RegistryEntry>

Map<Type, Set<ID>>

Map<Owner, Set<ID>>

Map<Contract, Set<Implementation>>
```

---

# 237. No Database Required

La primera versión no necesita una base de datos para Registry Runtime.

---

# 238. In-Memory Snapshot

Un Snapshot en memoria es suficiente inicialmente.

---

# 239. Optional Persistence

Persistencia podrá añadirse para:

- cache;
- tooling;
- debugging;
- distributed systems.

---

# 240. Persistence Is Not Authority

Un Registry persistido continúa siendo derivado de Sources of Truth gobernadas.

---

# 241. CLI Integration

ENG-007 podrá incorporar:

```text
mef registry validate
mef registry inspect
mef registry list
mef registry graph
mef registry why
```

---

# 242. `registry list`

Ejemplo:

```text
TYPE          ID                    OWNER
module        MOD-CRM               CORE
contract      CT-CUSTOMER-001       MOD-CRM
capability    CAP-AUDIT-001         MOD-AUDIT
```

---

# 243. `registry inspect`

Podrá mostrar metadata completa autorizada.

---

# 244. `registry graph`

Podrá mostrar relaciones:

```text
MOD-CRM
 ├── owns CT-CUSTOMER-001
 ├── requires CAP-AUDIT-001
 └── registered-by CrmProvider
```

---

# 245. `registry why`

Podrá explicar Provenance.

---

# 246. Machine Output

Los comandos deberán soportar formato estructurado cuando se utilicen en CI.

---

# 247. Build Quality Gate

ENG-012 podrá ejecutar:

```text
mef registry validate
```

como Quality Gate.

---

# 248. Quality Gate Failures

Deberán bloquear Build cuando afecten arquitectura obligatoria:

```text
duplicate identity
broken reference
invalid ownership
invalid Contract
unauthorized registration
incompatible relation
```

---

# 249. Release Integration

ENG-017 deberá evitar publicar una Release cuyo Registry derivado obligatorio sea inconsistente.

---

# 250. Compatibility Integration

ENG-016 deberá participar en validación de:

```text
Contract ↔ Implementation
Extension ↔ Extension Point
Module ↔ Required Capability
```

---

# 251. Dependency Injection Integration

ENG-018 utilizará Contracts/Capabilities registrados para expresar dependencias.

---

# 252. Service Container Integration

ENG-019 podrá consultar Registry para obtener Definitions/Candidates.

Pero:

```text
Registry Query
→ metadata

Container Resolve
→ instance
```

deberá mantenerse.

---

# 253. Event Bus Integration

ENG-022 podrá utilizar Registry para conocer:

```text
Event Types
Subscribers
Handlers
```

si estos se formalizan como Registry Entries.

---

# 254. Contracts Engineering Integration

ENG-021 definirá:

```text
Contract Identity
Contract Schema
Contract Version
Contract Publication
Contract Compatibility
```

Registry almacenará la metadata resultante.

---

# 255. Runtime Integration

ENG-027 deberá coordinar:

```text
Package Discovery
Manifest Loading
Registry Build
Container Build
Module Activation
```

---

# 256. Recommended Bootstrap Sequence

```text
Configuration
      ↓
Installed Package Discovery
      ↓
Manifest Validation
      ↓
Registry Builder
      ↓
Registry Validation
      ↓
Registry Snapshot
      ↓
Container Builder
      ↓
Dependency Graph Validation
      ↓
Module Initialization
      ↓
Activation
```

---

# 257. Registry Before Container

La secuencia preferida será:

```text
Registry
   ↓
Container
```

porque el Container puede necesitar metadata del Registry.

---

# 258. Bootstrap Exception

Un Container mínimo de infraestructura podrá existir antes para construir componentes del propio Bootstrap.

Esto no deberá invertir la autoridad conceptual.

---

# 259. Circular Bootstrap Prevention

Debe evitarse:

```text
Full Registry requires Full Container
Full Container requires Full Registry
```

La frontera mínima deberá diseñarse explícitamente.

---

# 260. Invariantes de Ingeniería

ENG-020 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-346 | El Registry deberá mantener metadata arquitectónica y no actuar como almacén ordinario de Instances de Runtime. |
| EI-347 | Registry y Service Container deberán permanecer responsabilidades separadas. |
| EI-348 | Toda Registry Entry gobernada deberá poseer identidad canónica y tipo definido. |
| EI-349 | Las identidades duplicadas incompatibles deberán rechazarse y no sobrescribirse silenciosamente. |
| EI-350 | Toda Entry que requiera Ownership deberá conservar un Owner arquitectónico identificable. |
| EI-351 | La Provenance de Entries relevantes deberá poder determinarse cuando sea necesaria para diagnóstico, seguridad o auditoría. |
| EI-352 | Lookup y Discovery no deberán instanciar ni activar componentes como efecto secundario ordinario. |
| EI-353 | El Registry deberá respetar Visibility y Query Context. |
| EI-354 | Las referencias entre Entries deberán mantener integridad referencial. |
| EI-355 | Los conflictos entre Sources of Metadata no deberán reconciliarse silenciosamente. |
| EI-356 | El mismo conjunto lógico de Entries deberá producir un Registry equivalente independientemente del orden accidental de Discovery. |
| EI-357 | El Registry deberá favorecer una fase de construcción mutable seguida por un Snapshot estable o semántica equivalente. |
| EI-358 | Un Registry Frozen no deberá aceptar mutaciones ordinarias. |
| EI-359 | Los índices del Registry deberán ser derivados del conjunto de Entries y no constituir una Source of Truth independiente. |
| EI-360 | Los atributos de confianza no deberán aceptarse únicamente por auto-declaración de Packages no verificados. |
| EI-361 | Las Queries del Registry deberán exponer únicamente metadata autorizada al consumidor. |
| EI-362 | El Registry Graph y el Runtime Dependency Graph deberán mantenerse como conceptos distintos. |
| EI-363 | Un Snapshot persistido o compilado deberá considerarse Artifact derivado y no reemplazar las Sources of Truth gobernadas. |
| EI-364 | Las relaciones Contract–Implementation deberán someterse a Compatibility antes de considerarse utilizables cuando aplique. |
| EI-365 | El Registry obligatorio deberá ser válido antes de construir la Composition Runtime que dependa de él. |

---

# 261. Criterios de Conformidad

Una implementación será conforme con ENG-020 cuando:

- mantenga Registry Entries tipadas;
- garantice identidad;
- preserve Ownership;
- preserve Provenance;
- soporte Registration;
- soporte Lookup;
- soporte Discovery;
- detecte duplicados;
- valide relaciones;
- controle Visibility;
- permita Snapshot estable;
- soporte índices derivados;
- no almacene ordinariamente Service Instances;
- no sustituya al Container;
- no sustituya al Package Manager;
- integre Manifest;
- integre Compatibility;
- permita diagnóstico;
- permita Testing;
- mantenga independencia tecnológica.

---

# 262. Riesgos

Deberán evitarse especialmente:

## Registry as Container

Guardar Services construidos dentro del Registry.

## Container as Registry

Resolver Services para descubrir qué existe.

## Silent Duplicate Override

Una Entry sustituye otra sin diagnóstico.

## Metadata Drift

Manifest, código y Registry divergen.

## Discovery Side Effects

Consultar Registry activa Modules o crea Services.

## Filesystem Magic

El Framework descubre componentes escaneando ubicaciones arbitrarias.

## Global Metadata Exposure

Todos los Modules pueden enumerar toda la arquitectura interna.

## Trust by Declaration

Un Package se declara trusted y el Registry lo acepta.

## Mutable Runtime Registry

Cualquier componente registra o elimina Entries durante ejecución.

## Broken Referential Integrity

Implementations apuntan a Contracts inexistentes.

## Registry Database Prematurity

Se introduce persistencia compleja antes de necesitarla.

## Architecture Graph Confusion

Se confunde Registry Graph con Dependency Graph.

---

# 263. Arquitectura Recomendada

```text
                    SOURCES
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
      Manifests     Providers    Core Metadata
          │            │            │
          └────────────┼────────────┘
                       ▼
                  NORMALIZATION
                       │
                       ▼
                   VALIDATION
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
      Identity      Security    Compatibility
          │            │            │
          └────────────┼────────────┘
                       ▼
                REGISTRY BUILDER
                       │
                       ▼
                 RELATION CHECK
                       │
                       ▼
               REGISTRY SNAPSHOT
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
       Runtime      Container      Tooling
```

---

# 264. Primera Implementación Recomendada

La primera versión deberá incluir:

```text
RegistryEntry
RegistryBuilder
Immutable Registry Snapshot

Registration
Lookup by ID
Lookup by Type
Lookup by Owner

Contract → Implementations
Capability → Providers

Duplicate Detection
Referential Integrity
Visibility
Provenance
Freeze
```

Estructura mínima conceptual:

```text
entriesById

entriesByType

entriesByOwner

implementationsByContract

providersByCapability
```

---

# 265. Segunda Fase

Podrá incorporar:

```text
Registry Graph
Fingerprint
Compiled Snapshot
Advanced Query
Extension Point Registry
Impact Analysis
CLI Visualization
```

---

# 266. Tercera Fase

Solo si existe necesidad:

```text
Dynamic Snapshots
Atomic Snapshot Replacement
Remote Registry
Distributed Registry
Registry Federation
Runtime Reconciliation
```

---

# 267. Relación con ENG-019

La frontera definitiva será:

```text
                    CT-CUSTOMER-001
                           │
               ┌───────────┴───────────┐
               ▼                       ▼

            Registry                Container

        knows that:              knows how to:
        ───────────              ─────────────
        Contract exists         resolve Contract
        owner                    select Binding
        providers                build Instance
        implementations          apply Scope
        metadata                 manage Lifecycle
```

---

# 268. Relación con ENG-021

`ENG-021 — Contracts Engineering` será autoridad sobre:

```text
qué es un Contract,
cómo se publica,
cómo se versiona,
qué significa implementarlo.
```

`ENG-020` únicamente registra y permite descubrir esa información.

---

# 269. Relación con ENG-022

Event Bus podrá utilizar Registry metadata para Discovery de Handlers/Subscribers.

No deberá almacenar el Event Bus como “la instancia” dentro del Registry.

---

# 270. Relación con ENG-027

Runtime deberá coordinar la secuencia:

```text
Discover
   ↓
Register
   ↓
Validate
   ↓
Freeze Registry
   ↓
Build Container
   ↓
Resolve
   ↓
Initialize
   ↓
Activate
```

---

# 271. Principio Rector

> **El Registry de MEF deberá ser el catálogo determinista y gobernado de conocimiento arquitectónico disponible para una instancia del Framework, preservando identidad, ownership, provenance, visibility e integridad, sin asumir las responsabilidades de construcción de instancias del Service Container.**

---

# 272. Conclusión

**ENG-020 — Registry Engineering** establece la infraestructura de conocimiento de MEF.

La cadena fundamental será:

```text
Package
   ↓
Manifest
   ↓
Discovery
   ↓
Normalization
   ↓
Validation
   ↓
Registry Entry
   ↓
Registry Snapshot
   ↓
Lookup / Discovery
```

El Registry podrá responder:

```text
¿Qué Modules existen?
¿Qué Contracts publican?
¿Qué Implementations existen?
¿Qué Capabilities proporcionan?
¿Quién es propietario?
¿De qué Package provienen?
¿Qué es visible?
¿Qué relaciones existen?
```

pero no deberá responder mediante la creación del objeto.

La construcción pertenece a:

```text
ENG-019
Service Container
```

De esta forma:

```text
Registry
   │
   │ discovers
   ▼
Implementation Metadata
   │
   │ informs
   ▼
Service Container
   │
   │ constructs
   ▼
Runtime Instance
```

y queda consolidada una separación fundamental de MEF:

```text
Manifest
→ declares

Registry
→ knows

Container
→ constructs

Dependency Injection
→ supplies

State Machine
→ governs

Runtime
→ executes
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
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
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
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-027 — Runtime Engineering