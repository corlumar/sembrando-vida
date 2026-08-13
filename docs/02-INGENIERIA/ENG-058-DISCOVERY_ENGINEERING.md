---
categoria: Ingeniería
dependencias:
- ENG-005
- ENG-009
- ENG-012
- ENG-016
- ENG-019
- ENG-020
- ENG-021
- ENG-023
- ENG-024
- ENG-025
- ENG-027
- ENG-028
- ENG-034
- ENG-039
- ENG-049
- ENG-057
estado: Accepted
id: ENG-058
keywords:
- discovery
- discovery-engineering
- discovery-source
- discovery-provider
- discovery-strategy
- discovery-candidate
- discovery-result
- static-discovery
- runtime-discovery
- manifest-discovery
- registry-discovery
- module-discovery
- service-discovery
- reflection-discovery
- package-discovery
- discovery-cache
- discovery-index
- discovery-refresh
- discovery-security
- mef
nivel: L2
relacionados:
- ENG-006
- ENG-007
- ENG-008
- ENG-011
- ENG-013
- ENG-014
- ENG-015
- ENG-017
- ENG-018
- ENG-022
- ENG-026
- ENG-030
- ENG-031
- ENG-032
- ENG-033
- ENG-036
- ENG-037
- ENG-038
- ENG-040
- ENG-041
- ENG-044
- ENG-048
- ENG-050
- ENG-051
- ENG-052
- ENG-053
- ENG-054
- ENG-055
- ENG-056
- ENG-059
responsable: MEF Engineering Team
subcategoria: Discovery Engineering
tipo: Engineering
titulo: Discovery Engineering
ultima_revision: 2026-08-13
version: 1.0.0
---

# ENG-058

# Discovery Engineering

## Estado

Accepted.

------------------------------------------------------------------------

# 1. Propósito

Definir el modelo de **Discovery Engineering** de **MEF (Modular
Enterprise Framework)**.

ENG-058 establece las reglas para:

``` text
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

Discovery Index
Discovery Cache

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

------------------------------------------------------------------------

# 2. Declaración

> **Todo Discovery administrado por MEF deberá definir explícitamente
> qué busca, dónde busca, bajo qué Scope, mediante qué Strategy y con
> qué Trust Model; sus resultados deberán ser validados antes de
> incorporarse al Runtime y ninguna decisión arquitectónica crítica
> deberá depender del orden accidental del Filesystem, Reflection,
> Network o respuesta de Providers.**

Arquitectura conceptual:

``` text
             DISCOVERY REQUEST
                    │
                    ▼
                 TARGET
                    │
                    ▼
                 SOURCES
                    │
          ┌─────────┼─────────┐
          ▼         ▼         ▼
       STATIC    REGISTRY   RUNTIME
          │         │         │
          └─────────┼─────────┘
                    ▼
                CANDIDATES
                    │
                    ▼
                VALIDATION
                    │
                    ▼
                 FILTER
                    │
                    ▼
                 RANKING
                    │
                    ▼
                SELECTION
                    │
                    ▼
                  RESULT
```

------------------------------------------------------------------------

# 3. Discovery Engineering

Discovery responde:

``` text
What artifacts are available?
Where are they?
Which providers support a capability?
Which modules exist?
Which implementations satisfy a contract?
Which candidates are valid?
Which candidate should be selected?
Can the result be trusted?
When must discovery be refreshed?
```

------------------------------------------------------------------------

# 4. Discovery

`Discovery` es el proceso mediante el cual MEF localiza artefactos,
componentes, Providers, Modules, Services o Capabilities disponibles.

------------------------------------------------------------------------

# 5. Discovery ≠ Resolution

Discovery encuentra Candidates.

Resolution determina cuál corresponde utilizar.

``` text
DISCOVERY
   │
   ▼
Candidates
   │
   ▼
RESOLUTION
   │
   ▼
Selected Target
```

------------------------------------------------------------------------

# 6. Discovery ≠ Registry

Registry contiene elementos conocidos.

Discovery puede utilizar Registry como Source.

------------------------------------------------------------------------

# 7. Discovery ≠ Metadata

Metadata describe Candidates.

Discovery los encuentra.

------------------------------------------------------------------------

# 8. Discovery ≠ Dependency Injection

DI utiliza componentes ya resueltos.

Discovery puede localizar Implementations candidatas.

------------------------------------------------------------------------

# 9. Discovery ≠ Service Locator

No deberá convertirse en mecanismo arbitrario para solicitar cualquier
Dependency durante ejecución.

------------------------------------------------------------------------

# 10. Discovery Target

Define qué se busca.

Ejemplos:

``` text
MODULE
COMPONENT
PROVIDER
SERVICE
CONTRACT_IMPLEMENTATION
CAPABILITY
PLUGIN
HANDLER
SERIALIZER
TRANSPORT
VALIDATOR
```

------------------------------------------------------------------------

# 11. Target Contract

Todo Target deberá poseer semántica conocida.

------------------------------------------------------------------------

# 12. Discovery Scope

Podrá ser:

``` text
FRAMEWORK
APPLICATION
MODULE
PROCESS
RUNTIME
TENANT
REQUEST
REMOTE
```

------------------------------------------------------------------------

# 13. Scope Restriction

Discovery no deberá buscar fuera de su Scope sin autorización explícita.

------------------------------------------------------------------------

# 14. Discovery Source

Representa origen de Candidates.

Ejemplos:

``` text
MANIFEST
REGISTRY
GENERATED_INDEX
FILESYSTEM
PACKAGE
REFLECTION
MODULE
RUNTIME
REMOTE
```

------------------------------------------------------------------------

# 15. Source Authority

Cada Source deberá poseer nivel de Trust conocido.

------------------------------------------------------------------------

# 16. Discovery Strategy

Define cómo se realiza búsqueda.

Podrá ser:

``` text
STATIC
INDEXED
REGISTRY
SCAN
REFLECTION
REMOTE
HYBRID
```

------------------------------------------------------------------------

# 17. Strategy Selection

Deberá seleccionarse según:

``` text
target
scope
performance
security
determinism
availability
runtime model
```

------------------------------------------------------------------------

# 18. Discovery Provider

Conceptualmente:

``` text
DiscoveryProvider
├── id
├── supports
├── discover
├── priority
├── trust
└── capabilities
```

------------------------------------------------------------------------

# 19. Provider Registration

Deberá seguir ENG-020.

------------------------------------------------------------------------

# 20. Provider Determinism

Mismas entradas y Sources estables deberán producir resultados
equivalentes.

------------------------------------------------------------------------

# 21. Static Discovery

Los Candidates se conocen antes del Runtime.

Ejemplo:

``` text
generated registry
compiled manifest
build index
```

------------------------------------------------------------------------

# 22. Build-Time Discovery

ENG-012 podrá localizar artefactos durante Build.

------------------------------------------------------------------------

# 23. Build-Time Advantages

Favorece:

``` text
determinism
startup performance
early validation
security
reproducibility
```

------------------------------------------------------------------------

# 24. Bootstrap Discovery

Ocurre durante inicialización de Runtime.

------------------------------------------------------------------------

# 25. Bootstrap Discovery Rule

Todo Candidate crítico deberá validarse antes de Readiness.

------------------------------------------------------------------------

# 26. Runtime Discovery

Ocurre después de que Runtime está Ready.

------------------------------------------------------------------------

# 27. Runtime Discovery Restriction

Deberá limitarse cuando pueda modificar Invariants arquitectónicos.

------------------------------------------------------------------------

# 28. Manifest Discovery

Utiliza Descriptors explícitos.

Ejemplos:

``` text
module manifest
plugin manifest
application descriptor
package descriptor
```

------------------------------------------------------------------------

# 29. Manifest Preference

MEF deberá favorecer Manifest o Generated Index sobre Scanning
indiscriminado cuando sea viable.

------------------------------------------------------------------------

# 30. Registry Discovery

Utiliza ENG-020 como Source.

------------------------------------------------------------------------

# 31. Registry Snapshot

Discovery podrá operar sobre Snapshot consistente.

------------------------------------------------------------------------

# 32. Filesystem Discovery

Busca Candidates en Filesystem.

------------------------------------------------------------------------

# 33. Filesystem Discovery Restrictions

Deberá definir:

``` text
root
patterns
depth
extensions
symlink policy
size limits
```

------------------------------------------------------------------------

# 34. Filesystem Ordering

El orden del Filesystem no deberá definir Priority.

------------------------------------------------------------------------

# 35. Symlink Safety

Scanning deberá prevenir escapes fuera de Roots autorizados.

------------------------------------------------------------------------

# 36. Path Traversal

Inputs externos no deberán controlar Paths arbitrarios.

------------------------------------------------------------------------

# 37. Reflection Discovery

Podrá localizar Types, Attributes o Implementations.

------------------------------------------------------------------------

# 38. Reflection Restrictions

Deberá definir Scope explícito.

------------------------------------------------------------------------

# 39. Reflection Cost

Deberá considerarse en Startup y Runtime.

------------------------------------------------------------------------

# 40. Reflection Ordering

No deberá considerarse estable salvo garantía de plataforma.

------------------------------------------------------------------------

# 41. Package Discovery

Podrá localizar Packages instalados compatibles con MEF.

------------------------------------------------------------------------

# 42. Package Trust

La existencia de un Package no implica que sea confiable.

------------------------------------------------------------------------

# 43. Module Discovery

ENG-028 utilizará Discovery para localizar Module Descriptors.

------------------------------------------------------------------------

# 44. Module Validation

Un Module descubierto deberá pasar Validation antes de Registration.

------------------------------------------------------------------------

# 45. Service Discovery

Podrá localizar Services internos o remotos.

------------------------------------------------------------------------

# 46. Local Service Discovery

Podrá utilizar:

``` text
registry
container
generated index
module descriptor
```

------------------------------------------------------------------------

# 47. Remote Service Discovery

Podrá utilizar mecanismos externos cuando la arquitectura distribuida lo
requiera.

------------------------------------------------------------------------

# 48. Remote Discovery Non-Goal Inicial

No será requisito de la primera implementación.

------------------------------------------------------------------------

# 49. Discovery Candidate

Representa una posible coincidencia.

Conceptualmente:

``` text
DiscoveryCandidate
├── id
├── target
├── descriptor
├── source
├── trust
├── priority
└── metadata
```

------------------------------------------------------------------------

# 50. Candidate Identity

Deberá ser estable dentro del Scope requerido.

------------------------------------------------------------------------

# 51. Candidate Metadata

Deberá seguir ENG-057.

------------------------------------------------------------------------

# 52. Candidate Validation

Todo Candidate deberá validarse antes de Selection cuando afecte
Runtime.

------------------------------------------------------------------------

# 53. Invalid Candidate

Podrá:

``` text
REJECT
QUARANTINE
WARN
IGNORE
```

según criticidad.

------------------------------------------------------------------------

# 54. Discovery Descriptor

Describe un Candidate sin necesariamente instanciarlo.

------------------------------------------------------------------------

# 55. Lazy Instantiation

Discovery no deberá instanciar automáticamente todos los Candidates.

------------------------------------------------------------------------

# 56. Discovery Result

Conceptualmente:

``` text
DiscoveryResult
├── target
├── candidates
├── selected
├── sourceSummary
├── diagnostics
└── generation
```

------------------------------------------------------------------------

# 57. Empty Result

Deberá distinguirse de Discovery Failure.

------------------------------------------------------------------------

# 58. Discovery Failure

Ejemplos:

``` text
source unavailable
invalid index
provider failure
security violation
timeout
```

------------------------------------------------------------------------

# 59. Discovery Filter

Elimina Candidates no compatibles.

Ejemplos:

``` text
version
capability
scope
visibility
platform
tenant
```

------------------------------------------------------------------------

# 60. Filter Determinism

Mismo conjunto de Candidates deberá producir mismo resultado.

------------------------------------------------------------------------

# 61. Discovery Constraint

Representa requisito obligatorio.

Ejemplos:

``` text
contract version >= 2
supports async
platform = php
visibility = public
```

------------------------------------------------------------------------

# 62. Constraint Failure

Candidate deberá excluirse.

------------------------------------------------------------------------

# 63. Discovery Ranking

Ordena Candidates válidos.

------------------------------------------------------------------------

# 64. Ranking Inputs

Podrán incluir:

``` text
explicit priority
version compatibility
specificity
locality
capability match
health
```

------------------------------------------------------------------------

# 65. Ranking Determinism

Empates deberán poseer Tie-Breaker estable.

------------------------------------------------------------------------

# 66. Random Ranking

No deberá utilizarse para decisiones arquitectónicas críticas salvo
Contract explícito.

------------------------------------------------------------------------

# 67. Discovery Selection

Selecciona Candidate.

------------------------------------------------------------------------

# 68. Selection Policy

Podrá ser:

``` text
FIRST_VALID
HIGHEST_PRIORITY
MOST_SPECIFIC
EXACT_MATCH
ALL
SINGLE_REQUIRED
```

------------------------------------------------------------------------

# 69. FIRST_VALID

Solo será válido cuando Ordering sea explícito y determinístico.

------------------------------------------------------------------------

# 70. SINGLE_REQUIRED

Deberá producir Error si existen:

``` text
0 candidates
>1 equally valid candidates
```

------------------------------------------------------------------------

# 71. Discovery Conflict

Ocurre cuando Candidates incompatibles compiten sin regla suficiente.

------------------------------------------------------------------------

# 72. Conflict Resolution

No deberá depender de orden accidental.

------------------------------------------------------------------------

# 73. Discovery Ordering

Deberá ser explícito cuando tenga semántica.

------------------------------------------------------------------------

# 74. Provider Priority

Priority deberá poseer rango y significado documentado.

------------------------------------------------------------------------

# 75. Discovery Index

Representa catálogo optimizado de Candidates.

------------------------------------------------------------------------

# 76. Generated Index

ENG-008/ENG-012 podrán generar Index.

------------------------------------------------------------------------

# 77. Index Contents

Podrá incluir:

``` text
candidate id
target
descriptor location
metadata summary
version
capabilities
checksum
```

------------------------------------------------------------------------

# 78. Index Version

Deberá versionarse.

------------------------------------------------------------------------

# 79. Index Validation

Deberá validarse antes de uso.

------------------------------------------------------------------------

# 80. Stale Index

Deberá detectarse cuando sea posible.

------------------------------------------------------------------------

# 81. Index Generation

Podrá vincularse a Build Artifact o Registry Generation.

------------------------------------------------------------------------

# 82. Discovery Cache

ENG-037 podrá almacenar resultados.

------------------------------------------------------------------------

# 83. Cache Key

Deberá incluir Inputs relevantes.

Ejemplo:

``` text
target
scope
constraints
generation
```

------------------------------------------------------------------------

# 84. Cache Invalidation

Deberá producirse cuando cambien Sources relevantes.

------------------------------------------------------------------------

# 85. Negative Cache

Podrá almacenar temporalmente ausencia de Candidates.

------------------------------------------------------------------------

# 86. Negative Cache Safety

No deberá ocultar indefinidamente nuevos Candidates.

------------------------------------------------------------------------

# 87. Discovery Refresh

Actualiza conocimiento disponible.

------------------------------------------------------------------------

# 88. Refresh Strategy

Podrá ser:

``` text
MANUAL
BOOTSTRAP
INTERVAL
EVENT_DRIVEN
ON_DEMAND
```

------------------------------------------------------------------------

# 89. Refresh Atomicity

Consumers no deberán observar Registry parcialmente reconstruido.

------------------------------------------------------------------------

# 90. Snapshot Swap

Podrá utilizarse:

``` text
Old Snapshot
     │
     ▼
Build New Snapshot
     │
     ▼
Validate
     │
     ▼
Atomic Swap
```

------------------------------------------------------------------------

# 91. Discovery Invalidation

Deberá invalidar Cache e Index dependientes cuando corresponda.

------------------------------------------------------------------------

# 92. Dynamic Discovery

Deberá estar controlado.

------------------------------------------------------------------------

# 93. Dynamic Registration

No deberá permitir modificación arbitraria del Runtime.

------------------------------------------------------------------------

# 94. Discovery Generation

Cada conjunto coherente de resultados podrá poseer Generation.

------------------------------------------------------------------------

# 95. Generation Purpose

Podrá soportar:

``` text
cache invalidation
diagnostics
snapshot consistency
change detection
```

------------------------------------------------------------------------

# 96. Discovery Determinism

Es requisito fundamental para artefactos locales y Build-Time.

------------------------------------------------------------------------

# 97. Determinism Inputs

Deberán normalizarse:

``` text
paths
versions
priorities
metadata
constraints
provider ordering
```

------------------------------------------------------------------------

# 98. Remote Non-Determinism

Remote Discovery podrá cambiar dinámicamente.

La Selection Policy deberá manejarlo explícitamente.

------------------------------------------------------------------------

# 99. Discovery Trust

Cada Candidate deberá conservar Trust asociado a Source.

------------------------------------------------------------------------

# 100. Trust Levels

Podrán ser:

``` text
FRAMEWORK
SIGNED
LOCAL_TRUSTED
APPLICATION
MODULE
EXTERNAL
UNTRUSTED
```

------------------------------------------------------------------------

# 101. Trust ≠ Priority

Candidate confiable no necesariamente posee mayor Functional Priority.

------------------------------------------------------------------------

# 102. Discovery Validation

Podrá comprobar:

``` text
identity
schema
version
signature
checksum
compatibility
capabilities
ownership
visibility
```

------------------------------------------------------------------------

# 103. Discovery Security

ENG-024 gobernará controles generales.

------------------------------------------------------------------------

# 104. Untrusted Discovery Source

No deberá poder registrar automáticamente componentes privilegiados.

------------------------------------------------------------------------

# 105. Discovery Injection

Deberá prevenir Candidates falsos introducidos mediante Input externo.

------------------------------------------------------------------------

# 106. Path Injection

Filesystem Discovery deberá validar Roots y Patterns.

------------------------------------------------------------------------

# 107. Package Injection

Package Metadata deberá validarse.

------------------------------------------------------------------------

# 108. Reflection Exposure

Reflection Discovery no deberá exponer Types internos fuera del Scope
permitido.

------------------------------------------------------------------------

# 109. Remote Discovery Security

Deberá validar:

``` text
transport
identity
integrity
authorization
freshness
```

cuando sea implementado.

------------------------------------------------------------------------

# 110. Discovery DoS

Deberán existir límites para:

``` text
scan depth
candidate count
file count
provider count
response size
execution time
```

------------------------------------------------------------------------

# 111. Discovery Timeout

Runtime Discovery deberá respetar Deadline cuando corresponda.

------------------------------------------------------------------------

# 112. Discovery Cancellation

Deberá integrarse con ENG-056.

------------------------------------------------------------------------

# 113. Tenant Discovery

ENG-048 deberá controlar cualquier Discovery Scoped por Tenant.

------------------------------------------------------------------------

# 114. Cross-Tenant Discovery

No deberá exponer Candidates privados de otro Tenant.

------------------------------------------------------------------------

# 115. Discovery Observability

ENG-025 gobernará Telemetry.

------------------------------------------------------------------------

# 116. Metrics

Podrán incluir:

``` text
mef.discovery.total
mef.discovery.duration
mef.discovery.candidates
mef.discovery.failure.total
mef.discovery.cache.hit
mef.discovery.cache.miss
mef.discovery.refresh.total
mef.discovery.conflict.total
```

------------------------------------------------------------------------

# 117. Metric Labels

Podrán incluir:

``` text
target
strategy
sourceType
result
```

------------------------------------------------------------------------

# 118. High Cardinality

No deberán utilizarse indiscriminadamente:

``` text
candidateId
path
serviceAddress
tenantId
arbitrary metadata
```

------------------------------------------------------------------------

# 119. Discovery Logs

Podrán registrar:

``` text
target
strategy
source count
candidate count
selected candidate
duration
result
```

cuando sea seguro.

------------------------------------------------------------------------

# 120. Discovery Trace

Podrá crear Span para operaciones costosas o remotas.

------------------------------------------------------------------------

# 121. Discovery Diagnostics

Deberá poder explicar:

``` text
target
scope
strategy
sources
candidates
rejected candidates
constraints
ranking
selection
generation
cache state
```

------------------------------------------------------------------------

# 122. Rejection Diagnostics

Deberá poder indicar razón:

``` text
version mismatch
missing capability
invalid metadata
untrusted source
scope mismatch
security rejection
```

------------------------------------------------------------------------

# 123. Selection Diagnostics

Deberá explicar por qué ganó un Candidate.

------------------------------------------------------------------------

# 124. Discovery Audit

Operaciones sensibles podrán auditar:

``` text
provider registered
dynamic source added
candidate trusted
candidate rejected
registry refreshed
remote source changed
```

------------------------------------------------------------------------

# 125. Testing

ENG-009 gobernará Testing.

------------------------------------------------------------------------

# 126. Static Discovery Test

Deberá comprobar Candidates esperados.

------------------------------------------------------------------------

# 127. Manifest Discovery Test

Deberá probar Descriptors válidos e inválidos.

------------------------------------------------------------------------

# 128. Filesystem Test

Deberá probar:

``` text
root restriction
patterns
depth
symlinks
path traversal
ordering
```

------------------------------------------------------------------------

# 129. Reflection Test

Deberá probar Scope y Ordering.

------------------------------------------------------------------------

# 130. Registry Discovery Test

Deberá comprobar Snapshot consistente.

------------------------------------------------------------------------

# 131. Candidate Validation Test

Deberá rechazar Candidate inválido.

------------------------------------------------------------------------

# 132. Filter Test

Deberá comprobar Constraints.

------------------------------------------------------------------------

# 133. Ranking Test

Deberá comprobar Ordering determinístico.

------------------------------------------------------------------------

# 134. Tie Test

Deberá comprobar Tie-Breaker.

------------------------------------------------------------------------

# 135. Conflict Test

Deberá producir Error cuando corresponda.

------------------------------------------------------------------------

# 136. Empty Result Test

Deberá diferenciar ausencia de Failure.

------------------------------------------------------------------------

# 137. Cache Test

Deberá comprobar Hit, Miss e Invalidation.

------------------------------------------------------------------------

# 138. Refresh Test

Deberá comprobar Snapshot Swap.

------------------------------------------------------------------------

# 139. Generation Test

Deberá comprobar consistencia.

------------------------------------------------------------------------

# 140. Security Test

Deberá intentar:

``` text
discovery injection
path traversal
symlink escape
untrusted privileged candidate
oversized scan
cross-tenant discovery
metadata spoofing
```

------------------------------------------------------------------------

# 141. Determinism Test

Mismo Input local deberá producir mismo Candidate Set y Ordering.

------------------------------------------------------------------------

# 142. Filesystem Order Test

Alterar Directory Enumeration no deberá alterar Selection.

------------------------------------------------------------------------

# 143. Concurrency Test

Refresh concurrente no deberá exponer Snapshot parcial.

------------------------------------------------------------------------

# 144. Failure Test

Deberá cubrir:

``` text
provider unavailable
invalid index
corrupt manifest
timeout
cancellation
security rejection
```

------------------------------------------------------------------------

# 145. Architecture Test

Podrá impedir:

``` text
runtime full filesystem scan by default
selection by filesystem order
unvalidated dynamic provider
discovery as service locator
unbounded reflection scan
remote discovery without trust policy
```

------------------------------------------------------------------------

# 146. Build Integration

ENG-012 podrá validar:

``` text
duplicate candidate id
invalid manifest
invalid discovery metadata
unsupported version
ambiguous selection
reserved provider id
invalid generated index
discovery dependency cycle
```

------------------------------------------------------------------------

# 147. CLI

ENG-007 podrá proporcionar:

``` text
mef discovery:list
mef discovery:find
mef discovery:providers
mef discovery:sources
mef discovery:index
mef discovery:refresh
mef discovery:validate
mef discovery:diagnose
```

------------------------------------------------------------------------

# 148. `discovery:list`

Podrá mostrar Candidates conocidos.

------------------------------------------------------------------------

# 149. `discovery:find`

Podrá ejecutar Discovery controlado.

------------------------------------------------------------------------

# 150. `discovery:providers`

Podrá mostrar Providers registrados.

------------------------------------------------------------------------

# 151. `discovery:sources`

Podrá mostrar Sources y Trust.

------------------------------------------------------------------------

# 152. `discovery:index`

Podrá inspeccionar Generated Index.

------------------------------------------------------------------------

# 153. `discovery:refresh`

Podrá solicitar Refresh autorizado.

------------------------------------------------------------------------

# 154. `discovery:validate`

Podrá validar Candidate o Descriptor.

------------------------------------------------------------------------

# 155. `discovery:diagnose`

Podrá explicar:

``` text
target
scope
sources
strategy
constraints
candidates
ranking
selection
cache
generation
```

------------------------------------------------------------------------

# 156. Registry Integration

ENG-020 podrá registrar:

``` text
DiscoveryProvider
DiscoverySource
DiscoveryStrategy
DiscoveryFilter
DiscoverySelector
```

------------------------------------------------------------------------

# 157. Discovery Request

Conceptualmente:

``` text
DiscoveryRequest
├── target
├── scope
├── constraints
├── filters
├── selectionPolicy
└── context
```

------------------------------------------------------------------------

# 158. Discovery Source Definition

Conceptualmente:

``` text
DiscoverySource
├── id
├── type
├── scope
├── trust
├── priority
└── configuration
```

------------------------------------------------------------------------

# 159. Discovery Candidate Definition

Conceptualmente:

``` text
DiscoveryCandidate
├── id
├── target
├── descriptor
├── metadata
├── source
├── trust
└── priority
```

------------------------------------------------------------------------

# 160. Discovery Engine

Conceptualmente:

``` text
DiscoveryEngine
├── discover
├── validate
├── filter
├── rank
├── select
├── refresh
└── diagnose
```

------------------------------------------------------------------------

# 161. Discovery Selector

Conceptualmente:

``` text
DiscoverySelector
├── filter
├── rank
├── resolveTie
└── select
```

------------------------------------------------------------------------

# 162. Discovery Snapshot

Conceptualmente:

``` text
DiscoverySnapshot
├── generation
├── createdAt
├── candidates
├── sources
└── metadata
```

------------------------------------------------------------------------

# 163. Bootstrap

ENG-027 deberá ejecutar Discovery crítico antes de Runtime Ready.

------------------------------------------------------------------------

# 164. Bootstrap Flow

``` text
Configuration
      │
      ▼
Metadata Registry
      │
      ▼
Discovery Providers
      │
      ▼
Discovery Sources
      │
      ▼
Static / Indexed Discovery
      │
      ▼
Candidate Validation
      │
      ▼
Conflict Detection
      │
      ▼
Registry Publication
      │
      ▼
Runtime Ready
```

------------------------------------------------------------------------

# 165. Bootstrap Failure

Podrá impedir Readiness ante:

``` text
missing required module
missing required provider
ambiguous critical implementation
invalid critical manifest
untrusted critical candidate
discovery dependency cycle
```

------------------------------------------------------------------------

# 166. Discovery Dependency Graph

Providers y Candidates podrán poseer Dependencies.

------------------------------------------------------------------------

# 167. Dependency Cycle

Deberá detectarse cuando impida Bootstrap determinístico.

------------------------------------------------------------------------

# 168. Discovery and Runtime

ENG-027 deberá distinguir:

``` text
bootstrap discovery
runtime discovery
dynamic refresh
```

------------------------------------------------------------------------

# 169. Discovery and Modules

ENG-028 podrá utilizar:

``` text
manifest discovery
generated indexes
module registry
```

------------------------------------------------------------------------

# 170. Discovery and Container

ENG-019 no deberá realizar Scanning arbitrario para resolver
Dependencies.

------------------------------------------------------------------------

# 171. Discovery and Registry

ENG-020 almacena Candidates validados.

------------------------------------------------------------------------

# 172. Discovery and Metadata

ENG-057 describe Candidates.

------------------------------------------------------------------------

# 173. Discovery and Context

ENG-056 proporciona:

``` text
deadline
cancellation
tenant
trace
```

cuando Discovery sea Runtime.

------------------------------------------------------------------------

# 174. Discovery and Caching

ENG-037 podrá cachear Results por Generation.

------------------------------------------------------------------------

# 175. Discovery and Resilience

ENG-039 gobernará Remote Discovery Failure cuando exista.

------------------------------------------------------------------------

# 176. Discovery and Configuration

ENG-049 podrá definir Sources y Strategy permitidas.

------------------------------------------------------------------------

# 177. Discovery and Features

ENG-050 podrá condicionar Candidates experimentales, pero Feature State
no deberá sustituir Discovery Validation.

------------------------------------------------------------------------

# 178. Discovery and Policy

ENG-051 podrá determinar si Candidate es elegible.

------------------------------------------------------------------------

# 179. Discovery and Security

ENG-024 deberá controlar Trust, Visibility y Dynamic Sources.

------------------------------------------------------------------------

# 180. Discovery and Compatibility

ENG-016 deberá gobernar Version Compatibility.

------------------------------------------------------------------------

# 181. Discovery and Build

ENG-012 deberá favorecer Generated Indexes cuando reduzcan Runtime
Scanning.

------------------------------------------------------------------------

# 182. First Implementation Components

La primera implementación deberá incluir:

``` text
DiscoveryTarget
DiscoveryScope

DiscoveryRequest
DiscoverySource
DiscoveryStrategy

DiscoveryProvider
DiscoveryCandidate
DiscoveryResult

DiscoveryFilter
DiscoverySelector

DiscoveryEngine
DiscoverySnapshot

DiscoveryError
```

------------------------------------------------------------------------

# 183. Optional Initial Components

Podrán incorporarse:

``` text
DiscoveryIndex
DiscoveryCache
DiscoveryDiagnostics
DiscoveryRefreshManager
```

------------------------------------------------------------------------

# 184. Later Components

Solo cuando exista necesidad demostrada:

``` text
RemoteServiceDiscovery
DistributedDiscoveryRegistry
Cross-ClusterDiscovery
DiscoveryFederation
Health-AwareDiscovery
Topology-AwareDiscovery
```

------------------------------------------------------------------------

# 185. Estructura Conceptual de Directorios

``` text
src/
└── Discovery/
    ├── Definition/
    │   ├── DiscoveryTarget
    │   ├── DiscoveryScope
    │   └── DiscoveryStrategy
    │
    ├── Request/
    │   └── DiscoveryRequest
    │
    ├── Source/
    │   └── DiscoverySource
    │
    ├── Provider/
    │   └── DiscoveryProvider
    │
    ├── Candidate/
    │   ├── DiscoveryCandidate
    │   └── DiscoveryResult
    │
    ├── Selection/
    │   ├── DiscoveryFilter
    │   └── DiscoverySelector
    │
    ├── Runtime/
    │   ├── DiscoveryEngine
    │   └── DiscoverySnapshot
    │
    ├── Index/
    │   └── DiscoveryIndex
    │
    ├── Diagnostics/
    │   └── DiscoveryDiagnostics
    │
    └── Error/
        └── DiscoveryError
```

La estructura física definitiva deberá obedecer ENG-006.

------------------------------------------------------------------------

# 186. Error Namespace

ENG-058 utilizará:

``` text
MEF-DISCOVERY-xxx
```

------------------------------------------------------------------------

# 187. Taxonomía ENG-058

``` text
MEF-DISCOVERY-001 Discovery target invalid
MEF-DISCOVERY-002 Discovery scope invalid
MEF-DISCOVERY-003 Discovery source invalid
MEF-DISCOVERY-004 Discovery strategy invalid
MEF-DISCOVERY-005 Discovery provider invalid
MEF-DISCOVERY-006 Discovery provider duplicate
MEF-DISCOVERY-007 Discovery source unavailable
MEF-DISCOVERY-008 Discovery candidate invalid
MEF-DISCOVERY-009 Discovery candidate duplicate
MEF-DISCOVERY-010 Discovery validation failed
MEF-DISCOVERY-011 Discovery constraint unsatisfied
MEF-DISCOVERY-012 Discovery conflict
MEF-DISCOVERY-013 Discovery selection ambiguous
MEF-DISCOVERY-014 Required discovery target not found
MEF-DISCOVERY-015 Discovery index invalid
MEF-DISCOVERY-016 Discovery index stale
MEF-DISCOVERY-017 Discovery refresh failed
MEF-DISCOVERY-018 Discovery timeout
MEF-DISCOVERY-019 Discovery cancelled
MEF-DISCOVERY-020 Discovery trust violation
MEF-DISCOVERY-021 Discovery security violation
MEF-DISCOVERY-022 Discovery path violation
MEF-DISCOVERY-023 Discovery limit exceeded
MEF-DISCOVERY-024 Discovery generation invalid
MEF-DISCOVERY-025 Discovery dependency cycle
MEF-DISCOVERY-026 Discovery cache failure
MEF-DISCOVERY-027 Discovery remote source failure
MEF-DISCOVERY-028 Discovery tenant violation
MEF-DISCOVERY-029 Discovery provider failure
MEF-DISCOVERY-030 Discovery invariant violation
```

------------------------------------------------------------------------

# 188. First Implementation Constraints

La primera implementación deberá favorecer:

``` text
Static Discovery
Manifest Discovery
Generated Indexes
Registry Discovery

Explicit Targets
Explicit Scopes
Explicit Sources
Explicit Strategies

Candidate Validation
Deterministic Filtering
Deterministic Ranking
Explicit Selection
Conflict Detection

Snapshots
Generation
Caching
Diagnostics
Security
Testing
```

------------------------------------------------------------------------

# 189. First Version Non-Goals

No deberá requerir:

``` text
Remote Service Discovery
Distributed Discovery
Cross-Cluster Discovery
Discovery Federation
Topology-Aware Selection
Health-Aware Remote Routing
```

------------------------------------------------------------------------

# 190. Second Phase

Podrá incorporar:

``` text
Dynamic Refresh
Advanced Discovery Indexes
Runtime Provider Registration
Advanced Querying
Health Information
```

------------------------------------------------------------------------

# 191. Third Phase

Solo cuando exista necesidad demostrada:

``` text
Remote Service Discovery
Distributed Registry
Cross-Cluster Discovery
Discovery Federation
Topology-Aware Discovery
```

------------------------------------------------------------------------

# 192. Invariantes de Ingeniería

ENG-058 continúa la serie global `EI`.

  -----------------------------------------------------------------------
  ID                                  Invariante
  ----------------------------------- -----------------------------------
  EI-1106                             Todo Discovery administrado por MEF
                                      deberá definir Target, Scope,
                                      Source, Strategy y Trust Model
                                      explícitos.

  EI-1107                             Discovery deberá permanecer
                                      separado de Resolution, Registry,
                                      Metadata, Dependency Injection y
                                      Service Locator.

  EI-1108                             Todo Candidate que pueda afectar
                                      Runtime deberá validarse antes de
                                      Registration o Selection.

  EI-1109                             Discovery local y Build-Time deberá
                                      ser determinístico y no depender
                                      del orden accidental del
                                      Filesystem, Reflection, Providers o
                                      Registry Iteration.

  EI-1110                             Filesystem Discovery deberá
                                      restringirse a Roots autorizados y
                                      protegerse contra Path Traversal,
                                      Symlink Escape y Scanning
                                      ilimitado.

  EI-1111                             Manifest y Generated Index
                                      Discovery deberán favorecerse
                                      frente a Runtime Scanning
                                      indiscriminado cuando sea
                                      técnicamente viable.

  EI-1112                             Discovery Filtering, Ranking y
                                      Selection deberán utilizar reglas
                                      explícitas y todo empate crítico
                                      deberá poseer Tie-Breaker estable o
                                      producir Error.

  EI-1113                             Trust y Functional Priority deberán
                                      permanecer diferenciados y ningún
                                      Candidate no confiable deberá
                                      obtener privilegios por poseer
                                      mayor Priority.

  EI-1114                             Discovery Indexes y Caches deberán
                                      relacionarse con Version o
                                      Generation y deberán invalidarse
                                      cuando cambien Sources relevantes.

  EI-1115                             Refresh deberá publicar conjuntos
                                      coherentes de Candidates y
                                      Consumers no deberán observar
                                      Registry parcialmente reconstruido.

  EI-1116                             Dynamic Discovery y Runtime
                                      Registration deberán permanecer
                                      controlados y no deberán modificar
                                      Invariants arquitectónicos sin
                                      Validation y Policy.

  EI-1117                             Discovery remoto deberá aplicar
                                      Identity, Integrity, Authorization,
                                      Freshness, Timeout y Resilience
                                      antes de ser considerado confiable.

  EI-1118                             Discovery deberá aplicar límites de
                                      tiempo, profundidad, Files,
                                      Candidates, Providers y Response
                                      Size para prevenir abuso o
                                      agotamiento de recursos.

  EI-1119                             Tenant-Scoped Discovery deberá
                                      preservar aislamiento y no deberá
                                      revelar Candidates privados
                                      pertenecientes a otros Tenants.

  EI-1120                             Discovery Diagnostics deberá poder
                                      explicar Sources, Candidates,
                                      Rejections, Constraints, Ranking,
                                      Selection, Generation y Cache
                                      State.

  EI-1121                             Discovery Observability deberá
                                      evitar Paths, Candidate IDs, Tenant
                                      IDs y otros valores de alta
                                      cardinalidad como Metric Labels
                                      indiscriminados.

  EI-1122                             Discovery Testing deberá cubrir
                                      Static, Manifest, Filesystem,
                                      Reflection, Registry, Validation,
                                      Filtering, Ranking, Conflicts,
                                      Cache, Refresh, Security,
                                      Determinism y Concurrency.

  EI-1123                             Build y Architecture Tests deberán
                                      detectar Duplicate Candidates,
                                      Invalid Manifests, Ambiguous
                                      Selection, Unbounded Scanning,
                                      Selection por Filesystem Order y
                                      Dynamic Providers no validados.

  EI-1124                             Modules, Registry, Metadata,
                                      Runtime, Configuration, Features y
                                      Policies deberán consumir un modelo
                                      canónico de Discovery y no
                                      implementar Scanners o Selection
                                      Engines paralelos incompatibles.

  EI-1125                             La primera implementación deberá
                                      favorecer Static, Manifest,
                                      Generated Index y Registry
                                      Discovery con Validation y
                                      Selection determinística antes de
                                      introducir Remote, Distributed o
                                      Federated Discovery.
  -----------------------------------------------------------------------

------------------------------------------------------------------------

# 193. Continuidad de Invariantes

``` text
ENG-054 → EI-1026 a EI-1045
ENG-055 → EI-1046 a EI-1065
ENG-056 → EI-1066 a EI-1085
ENG-057 → EI-1086 a EI-1105
ENG-058 → EI-1106 a EI-1125
```

------------------------------------------------------------------------

# 194. Criterios de Conformidad

Una implementación será conforme con ENG-058 cuando:

-   defina Discovery Targets;
-   defina Discovery Scope;
-   defina Sources;
-   defina Strategies;
-   registre Providers;
-   valide Candidates;
-   diferencie Discovery de Resolution;
-   favorezca Manifest e Indexes;
-   limite Filesystem Discovery;
-   controle Reflection;
-   implemente Filtering;
-   implemente Constraints;
-   implemente Ranking determinístico;
-   defina Selection Policies;
-   detecte Ambiguity;
-   detecte Conflicts;
-   versione Indexes;
-   controle Cache;
-   implemente Generation;
-   controle Refresh;
-   publique Snapshots coherentes;
-   aplique Trust;
-   proteja Tenant Scope;
-   aplique Security;
-   implemente Diagnostics;
-   pruebe Determinism;
-   pruebe Concurrency;
-   pruebe Security.

------------------------------------------------------------------------

# 195. Riesgos

Deberán evitarse especialmente:

``` text
Runtime Full Filesystem Scan
Filesystem-Order Selection
Reflection-Order Selection
Discovery as Service Locator
Unbounded Reflection
Unbounded Directory Scanning
Candidate Injection
Path Traversal
Symlink Escape
Untrusted Privileged Candidate
Stale Discovery Index
Stale Discovery Cache
Partial Refresh Publication
Ambiguous Selection
Silent Candidate Conflict
Cross-Tenant Discovery
Remote Discovery Without Trust
```

------------------------------------------------------------------------

# 196. Relación con ENG-057

La separación fundamental será:

``` text
METADATA
ENG-057
What describes the candidate?
        │
        ▼
DISCOVERY
ENG-058
Where is the candidate?
        │
        ▼
RESOLUTION
Which candidate should be used?
```

------------------------------------------------------------------------

# 197. Relación con ENG-059

ENG-059 deberá formalizar **Resolution Engineering**.

La separación será:

``` text
Discovery
→ finds candidates

Resolution
→ determines the effective target
```

ENG-059 deberá cubrir:

``` text
Resolution
Resolution Request
Resolution Target
Resolution Candidate

Resolution Scope
Resolution Context
Resolution Constraint

Resolution Strategy
Resolution Policy

Candidate Eligibility
Candidate Compatibility
Candidate Specificity

Resolution Priority
Resolution Ranking
Tie Breaking

Single Resolution
Multiple Resolution
Optional Resolution
Required Resolution

Resolution Fallback
Resolution Chain

Resolution Cache
Resolution Memoization

Resolution Cycle
Resolution Dependency

Resolution Failure
Resolution Ambiguity

Resolution Determinism

Resolution Security
Resolution Observability
Resolution Diagnostics
Resolution Testing
```

------------------------------------------------------------------------

# 197A. Frontera normativa Discovery vs Resolution

ENG-058 --- Discovery Engineering es autoritativo para localizar,
enumerar, validar y priorizar Candidates como parte del proceso de
descubrimiento.

ENG-059 --- Resolution Engineering es autoritativo para determinar el
**Effective Target** cuando existen múltiples Candidates elegibles.

Discovery Ranking o Discovery Selection sólo podrán utilizarse como
filtrado o priorización de Candidates. No deberán sustituir la decisión
autoritativa de Resolution.

------------------------------------------------------------------------

# 198. Principio Rector

> **MEF deberá descubrir artefactos mediante Sources explícitas,
> acotadas y confiables; validar todo Candidate antes de incorporarlo al
> Runtime; y producir conjuntos determinísticos y diagnosticables sobre
> los cuales Resolution pueda operar sin depender de orden accidental,
> Scanning ilimitado o Trust implícito.**

------------------------------------------------------------------------

# 199. Conclusión

**ENG-058 --- Discovery Engineering** formaliza cómo MEF encuentra los
elementos disponibles de su arquitectura.

``` text
METADATA
   │
   ▼
DISCOVERY
   │
   ▼
CANDIDATES
   │
   ▼
VALIDATION
   │
   ▼
FILTERING
   │
   ▼
RANKING
   │
   ▼
SELECTION
```

La primera implementación deberá concentrarse en:

``` text
DiscoveryTarget
DiscoveryScope
DiscoveryRequest
DiscoverySource
DiscoveryStrategy

DiscoveryProvider
DiscoveryCandidate
DiscoveryResult

DiscoveryFilter
DiscoverySelector

DiscoveryEngine
DiscoverySnapshot

DiscoveryError
```

antes de introducir:

``` text
Remote Service Discovery
Distributed Discovery
Discovery Federation
Cross-Cluster Discovery
Topology-Aware Discovery
```

Con **ENG-058** la serie global alcanza:

``` text
EI-1125
```

------------------------------------------------------------------------

# Referencias

## Ingeniería

-   ENG-005 --- Nomenclatura
-   ENG-006 --- Estructura de Directorios
-   ENG-007 --- CLI
-   ENG-008 --- Generadores
-   ENG-009 --- Testing
-   ENG-012 --- Build System
-   ENG-016 --- Compatibility
-   ENG-019 --- Service Container
-   ENG-020 --- Registry Engineering
-   ENG-021 --- Contracts Engineering
-   ENG-023 --- Error Handling
-   ENG-024 --- Security Engineering
-   ENG-025 --- Observability Engineering
-   ENG-027 --- Runtime Engineering
-   ENG-028 --- Module Engineering
-   ENG-037 --- Caching Engineering
-   ENG-039 --- Resilience Engineering
-   ENG-048 --- Multi-Tenancy Engineering
-   ENG-049 --- Configuration Management Engineering
-   ENG-050 --- Feature Management Engineering
-   ENG-051 --- Policy Engineering
-   ENG-056 --- Context Management Engineering
-   ENG-057 --- Metadata Engineering
-   ENG-059 --- Resolution Engineering \`\`\`
