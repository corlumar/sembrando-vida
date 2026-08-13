---
id: ENG-037
titulo: Caching Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Caching Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-011
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-031
  - ENG-034
  - ENG-036
relacionados:
  - ENG-006
  - ENG-009
  - ENG-012
  - ENG-020
  - ENG-022
  - ENG-032
  - ENG-033
  - ENG-035
  - ENG-038
keywords:
  - cache
  - caching
  - cache-key
  - ttl
  - expiration
  - invalidation
  - cache-aside
  - read-through
  - write-through
  - write-behind
  - stampede
  - negative-cache
  - distributed-cache
  - consistency
  - mef
---

# ENG-037

# Caching Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Caching Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-037 establece las reglas para:

```text
Cache
Cache Store
Cache Contract
Cache Entry
Cache Key
Cache Namespace
Cache Scope
TTL
Expiration
Invalidation
Eviction
Cache-Aside
Read-Through
Write-Through
Write-Behind
Refresh-Ahead
Negative Caching
Stampede Protection
Multi-Level Cache
Local Cache
Distributed Cache
Cache Serialization
Cache Consistency
Cache Isolation
Cache Observability
Cache Failure Policy
```

---

# 2. Declaración

La regla fundamental será:

> **El Cache deberá considerarse una optimización explícita y gobernada, nunca la fuente implícita de verdad de un Domain State salvo que un Contract arquitectónico declare expresamente otra semántica.**

La arquitectura general será:

```text
Consumer
   │
   ▼
Application
   │
   ▼
Cache
   │
 ┌─┴───────────┐
 │             │
Hit           Miss
 │             │
 ▼             ▼
Result      Source of Truth
               │
               ▼
             Cache
               │
               ▼
             Result
```

---

# 3. Cache

Un `Cache` almacena temporalmente información derivada o recuperable con el objetivo principal de reducir:

```text
latency
I/O
network calls
database load
CPU work
repeated computation
```

---

# 4. Cache ≠ Source of Truth

Por defecto:

```text
Cache
≠
Authoritative Storage
```

---

# 5. Source of Truth

La fuente autoritativa podrá ser:

```text
Database
Domain State
External Service
Configuration Source
Artifact
```

según el caso.

---

# 6. Cache Loss

El sistema deberá asumir que un Cache no autoritativo puede perderse.

---

# 7. Reconstructability

Los datos deberán poder reconstruirse desde su Source of Truth cuando el Cache sea derivado.

---

# 8. Cache Correctness

Una optimización de Cache no deberá alterar silenciosamente la corrección funcional del sistema.

---

# 9. Cache Optionality

Cuando Architecture lo permita:

```text
Cache unavailable
→ slower system
```

deberá preferirse sobre:

```text
Cache unavailable
→ incorrect system
```

---

# 10. Cache Contract

MEF deberá proporcionar un Contract abstracto de Cache.

Conceptualmente:

```text
Cache
├── get()
├── put()
├── delete()
├── has()
├── getOrCompute()
└── clearNamespace()
```

La API definitiva deberá mantenerse mínima.

---

# 11. Cache Store

`CacheStore` representa la implementación física.

Ejemplos conceptuales:

```text
MemoryCacheStore
RedisCacheStore
FilesystemCacheStore
DistributedCacheStore
```

---

# 12. Dependency Direction

Consumers deberán depender de:

```text
Cache Contract
```

y no directamente de:

```text
Redis Client
Memcached Client
Filesystem API
Vendor SDK
```

---

# 13. Cache Adapter

La tecnología concreta deberá implementarse mediante Adapter.

```text
Application
     │
     ▼
Cache Contract
     ▲
     │ implements
Cache Adapter
     │
     ▼
Cache Technology
```

---

# 14. Cache Entry

Una `CacheEntry` representa un Value almacenado junto con Metadata relevante.

Conceptualmente:

```text
CacheEntry<T>
├── key
├── value
├── createdAt
├── expiresAt
├── version
└── metadata
```

---

# 15. Cache Key

Toda Entry deberá poseer una Key determinista.

---

# 16. Key Determinism

Los mismos Inputs semánticos deberán producir la misma Key cuando se espera compartir Entry.

---

# 17. Key Collision

Dos recursos semánticamente distintos no deberán producir accidentalmente la misma Key.

---

# 18. Cache Key Structure

La estructura recomendada será conceptualmente:

```text
namespace
:
version
:
scope
:
resource
:
identifier
```

Ejemplo:

```text
customer:v2:tenant-15:profile:1234
```

---

# 19. Cache Key ≠ Sensitive Data

La Key no deberá incluir innecesariamente:

```text
password
token
secret
personal data
credential
```

---

# 20. Key Encoding

Los componentes variables deberán codificarse de manera inequívoca.

---

# 21. Ambiguous Concatenation

Deberá evitarse:

```text
"12" + "34"
```

si puede confundirse con:

```text
"1" + "234"
```

---

# 22. Key Length

Deberá respetar los límites del Store.

---

# 23. Cache Namespace

Un `Namespace` agrupa Entries relacionadas.

Ejemplos:

```text
configuration
customers
permissions
queries
metadata
modules
```

---

# 24. Namespace Ownership

Todo Namespace deberá tener Owner arquitectónico identificable.

---

# 25. Namespace Isolation

Un Module no deberá limpiar indiscriminadamente Namespaces pertenecientes a otros Modules.

---

# 26. Cache Version

La Key podrá contener Version.

---

# 27. Version Purpose

Permite invalidar una familia de Entries sin recorrer individualmente todo el Cache.

---

# 28. Version Change

Un cambio incompatible en representación podrá producir:

```text
v1
→
v2
```

---

# 29. Cache Scope

Una Entry deberá poseer Scope coherente con sus datos.

Podrá ser:

```text
global
application
module
tenant
principal
request
node
```

---

# 30. Scope Isolation

Un Value de Scope reducido no deberá exponerse mediante una Key de Scope mayor.

---

# 31. Tenant Isolation

Datos de distintos Tenants deberán permanecer aislados.

---

# 32. Principal Isolation

Información específica de User/Principal deberá incluir el Scope necesario.

---

# 33. Authorization-Sensitive Cache

Un resultado dependiente de Authorization no deberá reutilizarse entre Principals sin demostrar equivalencia de Policy Context.

---

# 34. Security Context

ENG-024 continuará gobernando:

```text
principal
tenant
permissions
security boundaries
```

---

# 35. Cache Poisoning

Inputs no confiables no deberán poder introducir Entries que posteriormente sean tratadas como confiables sin Validation.

---

# 36. Cache Key Injection

Las Keys derivadas de Input externo deberán normalizarse/codificarse.

---

# 37. Sensitive Cache

Información sensible deberá cumplir las mismas reglas de Security aplicables al Source original.

---

# 38. Encryption

Podrá requerirse según Threat Model.

---

# 39. Cache ACL

Distributed Stores deberán restringir acceso.

---

# 40. TTL

`Time To Live` define cuánto tiempo puede permanecer válida una Entry antes de expirar.

---

# 41. Explicit TTL

Toda familia de Cache debería poseer Policy explícita sobre Expiration.

---

# 42. Infinite TTL

No deberá utilizarse por accidente.

---

# 43. TTL Selection

Deberá considerar:

```text
data volatility
staleness tolerance
recomputation cost
source load
consistency requirements
security
```

---

# 44. TTL ≠ Correct Invalidation

Un TTL no sustituye automáticamente una estrategia de Invalidation.

---

# 45. Expiration

Una Entry expirada deberá considerarse no utilizable salvo estrategia explícita de stale serving.

---

# 46. Lazy Expiration

Podrá eliminarse al acceder.

---

# 47. Active Expiration

El Store podrá eliminarla proactivamente.

---

# 48. Expiration Semantics

El Consumer no deberá depender de detalles internos del Store.

---

# 49. TTL Jitter

Podrá añadirse variación controlada:

```text
TTL ± jitter
```

para evitar expiraciones simultáneas masivas.

---

# 50. Jitter Bound

Deberá estar acotado.

---

# 51. Invalidation

`Invalidation` marca una Entry como no válida antes de su Expiration natural.

---

# 52. Invalidation Principle

La pregunta:

```text
When does this cached value stop being correct?
```

deberá responderse para toda Cache relevante.

---

# 53. Invalidation Ownership

La Boundary que conoce el cambio de State deberá poder iniciar o solicitar Invalidation.

---

# 54. Explicit Invalidation

Podrá realizarse por:

```text
key
namespace
tag
version
dependency
event
```

---

# 55. Key Invalidation

Elimina una Entry específica.

---

# 56. Namespace Invalidation

Invalida un conjunto relacionado.

---

# 57. Tag Invalidation

Podrá utilizarse cuando varias Entries dependan del mismo recurso.

---

# 58. Version Invalidation

Podrá cambiar Namespace Version.

---

# 59. Event-Driven Invalidation

Un Event podrá provocar Invalidation.

Ejemplo:

```text
CustomerUpdated
      │
      ▼
Invalidate customer profile cache
```

---

# 60. Event Delivery

La estrategia deberá considerar:

```text
duplicate events
delayed events
lost events
out-of-order events
```

---

# 61. Invalidation Idempotency

Invalidar dos veces deberá ser seguro.

---

# 62. Invalidation Failure

Deberá existir Policy explícita.

---

# 63. Stale Window

Si Invalidation falla, deberá conocerse cuánto tiempo podría permanecer Stale la Entry.

---

# 64. Strong Consistency

Caches no deberán utilizarse en una operación que requiera State absolutamente actual salvo estrategia capaz de proporcionar dicha garantía.

---

# 65. Eventual Consistency

Podrá ser aceptable cuando el Use Case tolere Staleness.

---

# 66. Consistency Contract

La tolerancia a Staleness deberá formar parte de la decisión arquitectónica.

---

# 67. Staleness Budget

Podrá definirse:

```text
maximum acceptable stale duration
```

---

# 68. Cache-Aside

Patrón recomendado para muchos Use Cases:

```text
Application
   │
   ▼
Cache Lookup
   │
 ┌─┴─────────┐
 ▼           ▼
Hit         Miss
 │           │
 │           ▼
 │       Source
 │           │
 │           ▼
 │       Cache Put
 │           │
 └───────────┘
      │
      ▼
    Result
```

---

# 69. Cache-Aside Responsibility

El Consumer coordina:

```text
lookup
load
store
```

---

# 70. Cache-Aside Advantage

Mantiene la estrategia explícita.

---

# 71. Cache-Aside Risk

Puede producir Stampede ante Miss concurrentes.

---

# 72. Read-Through

El Cache Adapter carga automáticamente el Value desde Source.

---

# 73. Read-Through Contract

La Source Loader deberá ser explícita.

---

# 74. Hidden I/O

No deberá ocultarse una llamada costosa detrás de una operación que parezca Memory-only sin documentación.

---

# 75. Write-Through

Una escritura actualiza Source y Cache de forma coordinada.

---

# 76. Write-Through Consistency

Deberá definirse qué ocurre si:

```text
source succeeds
cache fails
```

o:

```text
cache succeeds
source fails
```

---

# 77. Source First

Para Cache no autoritativo deberá favorecerse preservar primero Source of Truth.

---

# 78. Write-Behind

La escritura puede almacenarse temporalmente antes de persistir al Source.

---

# 79. Write-Behind Risk

Introduce:

```text
data loss risk
ordering complexity
durability concerns
recovery complexity
```

---

# 80. Write-Behind Restriction

No deberá utilizarse como estrategia genérica en la primera implementación.

---

# 81. Refresh-Ahead

Una Entry podrá refrescarse antes de Expiration.

---

# 82. Refresh Threshold

Podrá definirse:

```text
refreshAt
```

---

# 83. Refresh Failure

La Policy deberá determinar si se sirve la Entry anterior.

---

# 84. Stale-While-Revalidate

Podrá permitirse:

```text
serve stale
+
refresh asynchronously
```

cuando el Contract tolere Staleness.

---

# 85. Stale-If-Error

Podrá servir Value expirado si Source falla.

---

# 86. Stale Security

No deberá utilizarse si el Value podría violar Security/Authorization actual.

---

# 87. Negative Caching

Permite cachear temporalmente:

```text
not found
empty result
known absence
```

---

# 88. Negative Cache TTL

Deberá ser cuidadosamente seleccionado.

---

# 89. Negative Cache Risk

Puede ocultar un recurso recién creado.

---

# 90. Negative Cache Invalidation

La creación del recurso deberá invalidar la ausencia cacheada cuando corresponda.

---

# 91. Error Caching

Failures transitorias no deberán cachearse como resultados normales sin Policy explícita.

---

# 92. Cache Stampede

Ocurre cuando muchas Requests intentan recomputar simultáneamente la misma Entry.

---

# 93. Stampede Example

```text
Entry expires
      │
      ├── Request 1 → Database
      ├── Request 2 → Database
      ├── Request 3 → Database
      ├── Request 4 → Database
      └── Request N → Database
```

---

# 94. Stampede Protection

MEF podrá soportar:

```text
single-flight
lock
lease
early refresh
jitter
request coalescing
```

---

# 95. Single-Flight

Dentro de un Scope:

```text
N concurrent misses
→
1 computation
```

---

# 96. Lock Scope

Deberá ser tan específico como la Cache Key.

---

# 97. Distributed Lock

Solo deberá utilizarse cuando sea necesario y con semántica explícita.

---

# 98. Lock Timeout

Nunca deberá ser infinito.

---

# 99. Lock Failure

Deberá existir estrategia:

```text
wait
compute independently
serve stale
fail
```

---

# 100. Lock Ownership

Deberá evitar Unlock por un Actor que no posee el Lock.

---

# 101. Lease

Podrá utilizar Token de Ownership.

---

# 102. Thundering Herd

TTL Jitter y Refresh-Ahead podrán reducirlo.

---

# 103. Hot Key

Una Key extremadamente popular puede saturar un Store distribuido.

---

# 104. Hot Key Mitigation

Podrá utilizar:

```text
local L1
replication
request coalescing
partitioning
```

según necesidad.

---

# 105. Multi-Level Cache

MEF podrá soportar:

```text
L1 → Local
L2 → Distributed
L3 → Source
```

---

# 106. Multi-Level Read

```text
Request
  │
  ▼
L1
 │
 ├─ Hit → Result
 │
 ▼
L2
 │
 ├─ Hit → populate L1
 │
 ▼
Source
 │
 ▼
populate L2
 │
 ▼
populate L1
```

---

# 107. L1 Cache

Normalmente será:

```text
process-local
fast
small
non-shared
```

---

# 108. L2 Cache

Podrá ser:

```text
distributed
shared
network-accessed
```

---

# 109. Multi-Level Consistency

Invalidation deberá considerar todos los Levels.

---

# 110. L1 Staleness

Una actualización de L2 no invalida automáticamente L1.

---

# 111. Local Cache

Podrá ser apropiada para:

```text
immutable metadata
configuration snapshots
compiled artifacts
small lookup tables
```

---

# 112. Distributed Cache

Podrá utilizarse para compartir Entries entre Runtime Nodes.

---

# 113. Distributed Cache ≠ Distributed Database

No deberá asumirse que proporciona las mismas garantías.

---

# 114. Network Failure

Un Distributed Cache introduce:

```text
latency
timeouts
partial failures
network partitions
```

---

# 115. Cache Timeout

Deberá ser significativamente menor que el Deadline del Use Case cuando Cache sea una optimización.

---

# 116. Cache Retry

No deberá consumir todo el Deadline.

---

# 117. Cache Bypass

Podrá existir para:

```text
diagnostics
recovery
administrative operation
fresh-read requirement
```

---

# 118. Cache Bypass Authorization

Un Bypass administrativo podrá requerir ENG-024.

---

# 119. Cache Disable

Podrá existir Configuration para desactivar una Cache no esencial.

---

# 120. Disabled Cache Semantics

El sistema deberá continuar contra Source cuando sea posible.

---

# 121. Cache Failure Policy

Cada Cache deberá definir:

```text
fail-open
fail-closed
fallback
serve-stale
bypass
```

según semántica.

---

# 122. Fail-Open

Ejemplo:

```text
Cache failure
→
read Source
```

---

# 123. Fail-Closed

Solo deberá utilizarse cuando Cache participe en una garantía crítica explícita.

---

# 124. Cache Availability

No deberá confundirse con Source Availability.

---

# 125. Cache Circuit Breaker

Podrá utilizarse para Stores remotos.

---

# 126. Circuit Open

Requests podrán omitir Cache temporalmente.

---

# 127. Recovery

Deberá evitar un Stampede masivo al recuperar Cache.

---

# 128. Warm-Up

Podrá precargar Entries.

---

# 129. Warm-Up Requirement

No deberá ser requisito de Correctness salvo Contract explícito.

---

# 130. Cold Start

El sistema deberá comportarse correctamente con Cache vacío.

---

# 131. Cache Priming

Podrá realizarse durante:

```text
startup
deployment
scheduled job
first access
```

---

# 132. Startup Blocking

No deberá retrasar Readiness innecesariamente por Warm-Up opcional.

---

# 133. Cache Serialization

ENG-031 gobernará representación.

---

# 134. Serialized Cache Entry

Deberá poseer Version cuando la representación pueda cambiar.

---

# 135. Native Object Cache

Podrá utilizarse únicamente dentro de Scope compatible.

---

# 136. Distributed Cache Serialization

Deberá utilizar representación portable.

---

# 137. Domain Object Caching

No deberá serializar Aggregate arbitrariamente sin considerar:

```text
versioning
invariants
rehydration
compatibility
lazy state
events
```

---

# 138. DTO Cache

Podrá ser preferible para Read Models.

---

# 139. Read Model Cache

Es un caso natural de Cache.

---

# 140. Query Cache

ENG-034 podrá cachear resultados de Queries.

---

# 141. Query Key

Deberá incorporar todos los Inputs que alteran el resultado.

---

# 142. Missing Input in Key

Produce contaminación de Cache.

---

# 143. Pagination

La Key deberá considerar:

```text
page
pageSize
sort
filters
```

cuando afecten Result.

---

# 144. Locale

Deberá incluirse si modifica Representation.

---

# 145. Tenant

Deberá incluirse cuando corresponda.

---

# 146. Principal

También cuando Authorization altere Result.

---

# 147. Version

Deberá incluirse cuando Contract/Projection cambie.

---

# 148. Cache Key Builder

MEF podrá proporcionar:

```text
CacheKeyBuilder
```

---

# 149. Key Builder Responsibility

Deberá producir Keys:

```text
deterministic
collision-resistant
bounded
observable
safe
```

---

# 150. Hashing

Inputs largos podrán resumirse mediante Hash.

---

# 151. Hash Collision

La estrategia deberá poseer riesgo aceptable.

---

# 152. Cryptographic Hash

No será obligatorio para todas las Keys.

---

# 153. Secret Hashing

Hashing no convierte automáticamente información sensible en segura.

---

# 154. Cache Tags

Podrán representar Dependencies.

Ejemplo:

```text
customer:123
```

puede etiquetar varias Entries.

---

# 155. Tag Cardinality

Deberá controlarse.

---

# 156. Tag Index

Puede introducir costo adicional.

---

# 157. Cache Dependency

Una Entry podrá depender de:

```text
resource
version
configuration
tenant
policy
```

---

# 158. Dependency Invalidation

Deberá ser explícita cuando la Entry quede incorrecta por cambio de Dependency.

---

# 159. Configuration Cache

ENG-011 podrá cachear Configuration derivada.

---

# 160. Configuration Reload

Deberá invalidar Snapshot apropiado.

---

# 161. Contract Metadata Cache

ENG-021 podrá cachear Metadata inmutable/versionada.

---

# 162. Registry Cache

ENG-020 podrá cachear resolución cuando Registry sea estable.

---

# 163. DI Cache

ENG-018/019 podrán cachear Resolution Plans cuando sea seguro.

---

# 164. Authorization Cache

Requiere especial cuidado.

---

# 165. Permission Cache

Podrá utilizarse si:

```text
scope
principal
tenant
policy version
TTL
invalidation
```

están correctamente definidos.

---

# 166. Permission Revocation

Una Cache no deberá prolongar permisos revocados más allá de la Security Policy permitida.

---

# 167. Security-First Invalidation

Cambios que reducen privilegios deberán priorizar Invalidation.

---

# 168. Validation Cache

ENG-036 podrá cachear únicamente Validations seguras de reutilizar.

---

# 169. State-Dependent Validation

No deberá cachearse indefinidamente.

---

# 170. Persistence Cache

ENG-030 podrá utilizar:

```text
identity map
query cache
second-level cache
```

cuando la estrategia esté definida.

---

# 171. Identity Map

No deberá confundirse con Cache distribuido.

---

# 172. Transaction Scope

Una Cache de Persistence deberá respetar Transaction semantics.

---

# 173. Uncommitted State

No deberá publicarse a Cache compartido antes de Commit.

---

# 174. Commit

La actualización/invalidation deberá coordinarse con Transaction.

---

# 175. Rollback

No deberá dejar una Entry reflejando State revertido.

---

# 176. Cache and Outbox

Invalidation/Event Publication podrá coordinarse mediante Outbox cuando se requiera consistencia.

---

# 177. Transactional Cache

No deberá asumirse disponible salvo soporte explícito.

---

# 178. Write Race

Dos Writers concurrentes pueden producir Cache obsoleto.

---

# 179. Example

```text
Writer A reads version 1
Writer B writes version 2
Writer A writes cached version 1
```

---

# 180. Versioned Entry

Podrá prevenir overwrite de versiones más nuevas.

---

# 181. Compare Version

El Store podrá rechazar:

```text
older version
→ overwrite newer version
```

cuando soporte dicha semántica.

---

# 182. Concurrency Engineering

ENG-038 deberá formalizar:

```text
locks
optimistic concurrency
atomic operations
coordination
```

---

# 183. Atomic Cache Operation

Podrá requerirse para:

```text
increment
compare-and-set
lease acquisition
```

---

# 184. Cache Counter

No deberá utilizarse como Business Ledger sin garantías suficientes.

---

# 185. Rate Limiting

Aunque pueda usar Cache Store, pertenece principalmente a Security/Resilience.

---

# 186. Session Storage

No deberá clasificarse automáticamente como Cache.

Si su pérdida afecta Correctness, posee semántica de State Store.

---

# 187. Idempotency Store

Tampoco deberá tratarse como Cache ordinario si su pérdida permite efectos duplicados.

---

# 188. Lock Store

No es Cache aunque utilice Redis.

---

# 189. Technology ≠ Semantics

La misma tecnología puede implementar:

```text
cache
session store
queue
lock store
idempotency store
```

pero cada uso posee Contracts diferentes.

---

# 190. Cache Eviction

`Eviction` elimina Entries por Policy de capacidad.

---

# 191. Expiration ≠ Eviction

```text
Expiration
→ time validity

Eviction
→ capacity/resource management
```

---

# 192. Eviction Policy

Podrá ser:

```text
LRU
LFU
FIFO
random
size-based
vendor-specific
```

---

# 193. Eviction Correctness

El sistema deberá funcionar aunque una Entry sea evicted antes de TTL.

---

# 194. Cache Capacity

Deberá configurarse.

---

# 195. Unbounded Cache

No deberá permitirse en Runtime de larga duración.

---

# 196. Local Cache Memory

Deberá poseer límites.

---

# 197. Entry Size

Podrá limitarse.

---

# 198. Oversized Entry

Deberá rechazarse o no cachearse según Policy.

---

# 199. Cache Admission

No todo resultado deberá almacenarse.

---

# 200. Admission Policy

Podrá considerar:

```text
size
cost
frequency
sensitivity
TTL
```

---

# 201. One-Hit Wonder

Cachear valores utilizados una sola vez puede desperdiciar capacidad.

---

# 202. Cache Compression

Podrá utilizarse para Entries grandes.

---

# 203. Compression Cost

Deberá medirse.

---

# 204. Compression Bomb

Data no confiable deberá tener límites al descomprimir.

---

# 205. Observability

ENG-025 gobernará Telemetry.

---

# 206. Cache Metrics

Como mínimo podrán incluir:

```text
mef.cache.requests.total
mef.cache.hits.total
mef.cache.misses.total
mef.cache.errors.total
mef.cache.evictions.total
mef.cache.invalidations.total
mef.cache.duration
```

---

# 207. Hit Ratio

Conceptualmente:

```text
hits
────────────
hits + misses
```

---

# 208. Hit Ratio ≠ Success

Un Hit Ratio alto no significa automáticamente que la Cache sea correcta o útil.

---

# 209. Cache Effectiveness

Deberá considerar:

```text
latency reduction
source load reduction
memory cost
staleness
failure rate
```

---

# 210. Cache Span

Distributed Cache Calls podrán generar Spans.

---

# 211. Span Attributes

Podrán incluir:

```text
cache.system
cache.operation
cache.namespace
cache.hit
```

---

# 212. Cache Key Telemetry

No deberá registrar Keys completas cuando contengan información sensible o alta Cardinality.

---

# 213. Logs

Deberán registrar Events relevantes:

```text
store unavailable
serialization failure
invalidation failure
stampede protection failure
```

---

# 214. Expected Miss

No deberá registrarse como Error.

---

# 215. Cache Miss Metric

Sí deberá poder observarse.

---

# 216. Performance

ENG-026 gobernará Performance.

---

# 217. Cache Benefit

Toda Cache significativa debería justificar:

```text
what cost is reduced?
```

---

# 218. Cache Benchmark

Podrán existir:

```text
BM-CACHE-LOCAL-GET
BM-CACHE-DISTRIBUTED-GET
BM-CACHE-SERIALIZATION
BM-CACHE-STAMPEDE
```

---

# 219. Cache Overhead

Una Cache puede ser más lenta que recomputar.

---

# 220. Measure

No deberá introducirse Cache únicamente por intuición.

---

# 221. Cache Hit Latency

Deberá medirse separadamente.

---

# 222. Cache Miss Latency

También.

---

# 223. Source Latency

También.

---

# 224. Serialization Cost

Deberá incluirse.

---

# 225. Network Cost

También para Distributed Cache.

---

# 226. Cache Memory Budget

Deberá definirse.

---

# 227. Cache Network Budget

Podrá definirse.

---

# 228. Cache Availability SLO

Solo cuando la Cache sea operacionalmente relevante.

---

# 229. Cache Correctness Test

Deberá comprobar que:

```text
cache hit
==
source result
```

dentro de Consistency Contract.

---

# 230. Testing

ENG-009 gobernará Testing.

---

# 231. Cache Contract Test

Todo Adapter deberá cumplir una suite común.

---

# 232. Contract Test Cases

Como mínimo:

```text
put/get
delete
expiration
missing key
overwrite
namespace isolation
serialization
```

---

# 233. TTL Test

Deberá utilizar Clock controlable cuando sea posible.

---

# 234. No Sleep-Based Test

Deberá evitarse depender de Sleeps largos para comprobar TTL.

---

# 235. Fake Clock

Podrá utilizarse.

---

# 236. Invalidation Test

Deberá comprobar que State actualizado no sirva Entry obsoleta fuera de Policy.

---

# 237. Stampede Test

Deberá comprobar concurrencia.

---

# 238. Tenant Isolation Test

Será obligatorio para Cache Multi-Tenant.

---

# 239. Principal Isolation Test

Cuando corresponda.

---

# 240. Serialization Compatibility Test

Deberá comprobar Entries entre versiones cuando sobrevivan Deployments.

---

# 241. Corrupt Entry Test

El Adapter deberá manejar Data inválida.

---

# 242. Corrupt Entry Policy

Normalmente:

```text
discard
+
reload source
```

cuando Cache sea derivado.

---

# 243. Cache Outage Test

Deberá comprobar Failure Policy.

---

# 244. Slow Cache Test

Deberá comprobar Timeout/Fallback.

---

# 245. Eviction Test

El sistema deberá continuar correctamente tras Eviction.

---

# 246. Cold Cache Test

Deberá comprobar funcionamiento con Cache vacío.

---

# 247. Warm Cache Test

Deberá comprobar Hit Path.

---

# 248. Property-Based Testing

Podrá utilizarse para Cache Key Builders.

---

# 249. Collision Testing

Deberá comprobar composiciones de Key relevantes.

---

# 250. Fuzz Testing

Podrá aplicarse a:

```text
key parsing
serialization
cache metadata
```

---

# 251. Build Integration

ENG-012 podrá validar:

```text
cache namespaces
duplicate cache IDs
invalid TTL configuration
invalid cache adapters
unsupported serialization
```

---

# 252. Static Architecture Test

Podrá impedir:

```text
Domain
→ RedisClient
```

---

# 253. Cache Registry

ENG-020 podrá registrar Cache Stores y Policies.

---

# 254. Cache Registry Entry

Conceptualmente:

```text
CacheDefinition
├── id
├── namespace
├── store
├── ttl
├── scope
├── serialization
├── failurePolicy
└── metadata
```

---

# 255. Deterministic Resolution

Una Cache Definition deberá resolverse de forma determinista.

---

# 256. Missing Required Store

Deberá impedir Readiness cuando la Cache sea obligatoria.

---

# 257. Optional Store

Podrá degradar hacia No-Op/Source cuando Architecture lo permita.

---

# 258. No-Op Cache

MEF podrá proporcionar:

```text
NullCache
```

para Cache opcional.

---

# 259. NullCache Semantics

```text
get
→ miss

put
→ no-op

delete
→ no-op
```

---

# 260. Cache Configuration

ENG-011 deberá definir Configuration.

Ejemplo conceptual:

```text
cache:
  default:
    adapter: redis
    ttl: 300
    timeout: 50ms
```

---

# 261. Secrets

Credentials del Store no deberán formar parte de Config pública.

---

# 262. Runtime Integration

ENG-027 deberá construir Cache Infrastructure durante Bootstrap.

---

# 263. Bootstrap

Conceptualmente:

```text
Load Configuration
       ↓
Resolve Cache Adapters
       ↓
Validate Definitions
       ↓
Connect Required Stores
       ↓
Build Cache Registry
       ↓
Readiness
```

---

# 264. Lazy Connection

Stores opcionales podrán conectarse bajo demanda.

---

# 265. Required Cache

Solo deberá marcarse Required cuando su ausencia realmente impida funcionamiento correcto.

---

# 266. Shutdown

Distributed Cache Clients deberán cerrarse correctamente.

---

# 267. In-Flight Operations

Deberán respetar Shutdown Deadline.

---

# 268. Cache Error

MEF deberá distinguir Failures de Cache.

---

# 269. Error Namespace

ENG-037 utilizará:

```text
MEF-CACHE-xxx
```

---

# 270. Taxonomía ENG-037

```text
MEF-CACHE-001 Cache unavailable
MEF-CACHE-002 Cache key invalid
MEF-CACHE-003 Cache namespace invalid
MEF-CACHE-004 Cache entry not found
MEF-CACHE-005 Cache entry expired
MEF-CACHE-006 Cache serialization failed
MEF-CACHE-007 Cache deserialization failed
MEF-CACHE-008 Cache write failed
MEF-CACHE-009 Cache read failed
MEF-CACHE-010 Cache deletion failed
MEF-CACHE-011 Cache invalidation failed
MEF-CACHE-012 Cache configuration invalid
MEF-CACHE-013 Cache adapter not found
MEF-CACHE-014 Cache adapter conflict
MEF-CACHE-015 Cache capacity exceeded
MEF-CACHE-016 Cache lock timeout
MEF-CACHE-017 Cache stampede protection failed
MEF-CACHE-018 Cache consistency violation
MEF-CACHE-019 Cache isolation violation
MEF-CACHE-020 Cache contract violation
```

---

# 271. Cache Unavailable

```text
MEF-CACHE-001

Cache unavailable.

Cache:
application-query-cache
```

---

# 272. Serialization Failure

```text
MEF-CACHE-006

Cache serialization failed.

Namespace:
customer-profile
```

---

# 273. Isolation Violation

```text
MEF-CACHE-019

Cache isolation violation.

Namespace:
customer-profile

Expected scope:
tenant-15
```

---

# 274. Consistency Violation

```text
MEF-CACHE-018

Cache consistency violation.

Resource:
Customer:1234

Cached version:
41

Current version:
42
```

---

# 275. Cache Error Translation

Consumers no deberán depender directamente de Vendor Exceptions.

---

# 276. Miss ≠ Error

Una Cache Miss ordinaria no deberá representarse como Failure.

---

# 277. Expiration ≠ Operational Error

Tampoco.

---

# 278. Error Handling

ENG-023 seguirá gobernando:

```text
propagation
translation
retry classification
diagnostics
```

---

# 279. Compatibility

ENG-016 gobernará Cache Contracts públicos.

---

# 280. Internal Cache Key

Podrá cambiar libremente si las Entries pueden invalidarse de forma segura.

---

# 281. Persistent Cache Across Releases

Si Entries sobreviven Deployments, Representation Versioning será obligatorio cuando exista incompatibilidad.

---

# 282. Rolling Deployment

Deberá considerar Nodes de versiones distintas.

---

# 283. Shared Cache During Rolling Deploy

Las dos versiones deberán:

```text
share compatible entries
```

o utilizar:

```text
separate versions/namespaces
```

---

# 284. Deployment Invalidation

Un Release podrá requerir invalidar determinadas Entries.

---

# 285. Full Cache Flush

No deberá ser la estrategia predeterminada.

---

# 286. Targeted Invalidation

Deberá favorecerse.

---

# 287. Cache Migration

Podrá utilizar:

```text
lazy migration
dual read
dual write
versioned namespace
```

cuando sea necesario.

---

# 288. Documentation

Toda Cache significativa debería documentar:

```text
owner
source of truth
key
scope
ttl
invalidation
failure policy
staleness tolerance
```

---

# 289. Cache Decision Record

Caches críticas podrán requerir ADR.

---

# 290. Cache Inventory

Podrá mantenerse un inventario generado.

---

# 291. Inventory Entry

Conceptualmente:

```text
Cache:
customer-profile

Owner:
Customer Module

Source:
CustomerRepository

TTL:
5m

Invalidation:
CustomerUpdated

Scope:
tenant

Failure:
bypass
```

---

# 292. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Cache
CacheStore
CacheEntry
CacheKey
CacheKeyBuilder
CacheNamespace
CachePolicy
CacheResult
CacheError
NullCache
```

---

# 293. Cache Result

Podrá representar:

```text
CacheResult<T>
├── hit
├── value
├── stale
└── metadata
```

---

# 294. CachePolicy

Conceptualmente:

```text
CachePolicy
├── ttl
├── jitter
├── scope
├── stalePolicy
├── failurePolicy
└── stampedePolicy
```

---

# 295. Optional Initial Components

Podrán incorporarse:

```text
CacheLock
SingleFlight
MultiLevelCache
TaggableCache
RefreshAhead
```

---

# 296. Conceptual Directory Structure

```text
src/
└── Cache/
    ├── Contract/
    │   ├── Cache
    │   └── CacheStore
    │
    ├── Entry/
    │   └── CacheEntry
    │
    ├── Key/
    │   ├── CacheKey
    │   └── CacheKeyBuilder
    │
    ├── Namespace/
    │   └── CacheNamespace
    │
    ├── Policy/
    │   ├── CachePolicy
    │   ├── ExpirationPolicy
    │   ├── FailurePolicy
    │   └── StampedePolicy
    │
    ├── Result/
    │   └── CacheResult
    │
    ├── Adapter/
    │   ├── Memory/
    │   └── Distributed/
    │
    ├── Coordination/
    │   ├── SingleFlight
    │   └── CacheLock
    │
    ├── Null/
    │   └── NullCache
    │
    └── Error/
        └── CacheError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 297. First Implementation Constraints

La primera versión deberá favorecer:

```text
Cache-Aside
Explicit Keys
Explicit Namespaces
Explicit TTL
Explicit Failure Policy
Local Cache
Optional Distributed Adapter
Serialization Versioning
Tenant Isolation
Cache Metrics
Cold-Cache Correctness
Cache Contract Tests
```

---

# 298. First Version Non-Goals

No deberá requerir:

```text
Write-Behind
Distributed Lock Manager
Global Cache Coherence
Cross-Region Cache Replication
Universal Query Cache
Automatic Domain Object Caching
Distributed Transactional Cache
Predictive Cache Warming
```

---

# 299. Second Phase

Podrá incorporar:

```text
Single-Flight
TTL Jitter
Refresh-Ahead
Stale-While-Revalidate
Tag Invalidation
Multi-Level Cache
Advanced Query Cache
```

---

# 300. Third Phase

Solo cuando exista necesidad:

```text
Cross-Region Cache
Distributed Coherence
Advanced Lease Protocols
Adaptive TTL
Predictive Warming
Advanced Admission Policies
```

---

# 301. Invariantes de Ingeniería

ENG-037 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-686 | Todo Cache no autoritativo deberá considerarse una optimización reconstruible y no la Source of Truth implícita del sistema. |
| EI-687 | La pérdida, Expiration o Eviction de una Entry no deberá alterar Correctness cuando el Cache haya sido declarado derivado. |
| EI-688 | Toda Cache Key deberá ser determinista, inequívoca y contener todos los componentes de Scope que alteren el resultado cacheado. |
| EI-689 | Cache Keys, Metadata y Telemetry no deberán exponer Secrets o información sensible innecesaria. |
| EI-690 | Todo Namespace de Cache deberá poseer Ownership y Scope arquitectónicos identificables. |
| EI-691 | Tenant, Principal y Authorization-sensitive data deberán preservar aislamiento equivalente o superior al Source original. |
| EI-692 | Toda familia de Entries deberá poseer Policy explícita de Expiration o justificar formalmente la ausencia de TTL. |
| EI-693 | TTL no deberá utilizarse como sustituto implícito de una estrategia de Invalidation cuando la corrección requiera invalidación anticipada. |
| EI-694 | La estrategia de Invalidation deberá considerar el cambio de State que convierte una Entry en obsoleta y definir Failure semantics. |
| EI-695 | La tolerancia a Staleness deberá ser explícita para Use Cases donde un Value obsoleto pueda alterar comportamiento observable. |
| EI-696 | Cache Miss y Expiration ordinarios no deberán tratarse como Operational Failures. |
| EI-697 | Cache-Aside deberá favorecerse como estrategia inicial salvo que otro patrón posea ventajas demostrables para el Use Case. |
| EI-698 | Cache Stampede deberá mitigarse cuando una Entry de alto costo o alta concurrencia pueda generar carga no acotada sobre su Source. |
| EI-699 | Multi-Level Cache deberá mantener una estrategia explícita de Invalidation y Staleness para cada Level. |
| EI-700 | Distributed Cache deberá tratarse como Dependency remota sujeta a Timeout, Partial Failure, Network Partition y Observability. |
| EI-701 | Entries compartidas entre Releases deberán poseer representación compatible o Namespace/Version independiente. |
| EI-702 | Un Cache no deberá publicar State no confirmado por una Transaction cuando ello pueda exponer datos posteriormente revertidos. |
| EI-703 | Cache Failure Policy deberá declarar explícitamente si la operación realiza Bypass, Fallback, Serve-Stale, Fail-Open o Fail-Closed. |
| EI-704 | Toda Cache deberá poseer límites de Capacity o Resources apropiados a su Store y Lifecycle. |
| EI-705 | La primera implementación deberá favorecer Cache explícito, medible, aislado y prescindible antes de introducir coherencia distribuida, Write-Behind o coordinación avanzada. |

---

# 302. Continuidad de Invariantes

```text
ENG-033 → EI-606 a EI-625
ENG-034 → EI-626 a EI-645
ENG-035 → EI-646 a EI-665
ENG-036 → EI-666 a EI-685
ENG-037 → EI-686 a EI-705
```

---

# 303. Criterios de Conformidad

Una implementación será conforme con ENG-037 cuando:

- utilice Cache mediante Contract;
- diferencie Cache y Source of Truth;
- defina Cache Keys deterministas;
- utilice Namespaces;
- preserve Tenant Isolation;
- preserve Principal Isolation cuando corresponda;
- defina TTL;
- defina Invalidation;
- distinga Expiration y Eviction;
- soporte Cache Miss sin Error;
- permita Cache-Aside;
- maneje Cache Failure;
- soporte Cold Start;
- permita Cache vacío;
- defina Serialization;
- permita Versioning de Entries;
- preserve Transaction semantics;
- evite publicar State no confirmado;
- integre Observability;
- defina Resource Limits;
- permita Contract Testing;
- preserve Compatibility entre Releases;
- no requiera Distributed Cache para Correctness salvo Contract explícito.

---

# 304. Riesgos

Deberán evitarse especialmente:

## Cache as Database

El Cache se convierte accidentalmente en Source of Truth.

## Missing Scope in Key

Dos Tenants o Principals reciben la misma Entry.

## Cache Poisoning

Input no confiable introduce Data tratada después como confiable.

## Infinite TTL

Data mutable permanece indefinidamente.

## TTL-Only Consistency

Se ignora la necesidad de Invalidation.

## Full Flush Culture

Toda modificación ejecuta `flush all`.

## Stampede

Miles de Requests recomputan simultáneamente.

## Hidden Remote Cache

Una operación aparentemente local realiza Network I/O.

## Cache Without Timeout

Una optimización consume todo el Deadline.

## Cache Failure Becomes System Failure

El Source está disponible pero el sistema falla por Cache.

## Authorization Cache Leak

Permissions de un Principal se reutilizan para otro.

## Tenant Leak

Data cruza Tenant Boundaries.

## Uncommitted Cache

State no confirmado se hace visible.

## Stale Security State

Permisos revocados siguen activos por Cache.

## Domain Object Serialization

Aggregates internos se convierten accidentalmente en Cache Contracts permanentes.

## Unbounded Local Cache

El Runtime termina consumiendo memoria sin límite.

## Cache Everything

Se incrementa complejidad sin beneficio medido.

## Redis Semantics Confusion

Una misma tecnología se usa como Cache, Lock, Queue y State Store sin diferenciar Contracts.

---

# 305. Relación con ENG-018

Dependency Injection suministrará Cache Contracts y Stores.

---

# 306. Relación con ENG-019

Service Container construirá Cache Adapters y Policies.

---

# 307. Relación con ENG-020

Registry podrá mantener Cache Definitions.

---

# 308. Relación con ENG-021

Cache Contracts públicos deberán seguir Compatibility y Contract Engineering.

---

# 309. Relación con ENG-023

Cache Failures deberán integrarse con Error Handling y no exponer Vendor Exceptions.

---

# 310. Relación con ENG-024

Security gobernará:

```text
Tenant Isolation
Principal Isolation
Sensitive Data
Authorization-sensitive caching
Store Credentials
```

---

# 311. Relación con ENG-025

Observability gobernará:

```text
hits
misses
latency
errors
evictions
invalidations
```

---

# 312. Relación con ENG-026

Performance Engineering deberá demostrar el beneficio de una Cache significativa.

---

# 313. Relación con ENG-027

Runtime construirá, validará y cerrará Cache Infrastructure.

---

# 314. Relación con ENG-028

Modules serán Owners de sus Namespaces y Policies específicas.

---

# 315. Relación con ENG-030

Persistence coordinará Cache con:

```text
Transactions
Commit
Rollback
Concurrency
Outbox
```

---

# 316. Relación con ENG-031

Serialization gobernará representación portable y Versioning de Entries.

---

# 317. Relación con ENG-034

Application podrá aplicar Cache a Queries y Use Cases cuando la semántica lo permita.

---

# 318. Relación con ENG-035

Domain no deberá depender de Cache Infrastructure concreta.

La regla será:

```text
Domain
→ Business Truth

Cache
→ Performance Optimization
```

---

# 319. Relación con ENG-036

Validation dependiente de State externo deberá considerar Staleness antes de utilizar resultados cacheados.

---

# 320. Relación con ENG-038

ENG-038 — Concurrency Engineering deberá formalizar:

```text
Atomicity
Locks
Leases
Optimistic Concurrency
Compare-and-Set
Race Conditions
Deadlocks
Distributed Coordination
Fencing Tokens
```

que ENG-037 únicamente utiliza cuando necesita coordinar acceso concurrente al Cache.

---

# 321. Principio Rector

> **MEF deberá utilizar Cache para reducir costo, no para ocultar arquitectura: toda Entry deberá poseer identidad, Scope, Lifecycle, Consistency y Failure semantics explícitos, y el sistema deberá seguir siendo correcto cuando una Cache derivada esté vacía, expirada o indisponible.**

---

# 322. Conclusión

**ENG-037 — Caching Engineering** formaliza la arquitectura de Cache de MEF.

La arquitectura principal queda:

```text
                 APPLICATION
                      │
                      ▼
                    CACHE
                      │
            ┌─────────┴─────────┐
            ▼                   ▼
           HIT                 MISS
            │                   │
            │                   ▼
            │             SOURCE OF TRUTH
            │                   │
            │                   ▼
            │               CACHE PUT
            │                   │
            └──────────┬────────┘
                       ▼
                     RESULT
```

La separación conceptual queda:

```text
Source of Truth
→ authoritative state

Cache
→ temporary optimization

TTL
→ temporal validity

Invalidation
→ explicit loss of validity

Eviction
→ capacity management

Cache Key
→ entry identity

Namespace
→ ownership/isolation

Scope
→ visibility boundary

Stampede Protection
→ concurrent recomputation control

Failure Policy
→ behavior when cache fails
```

La primera implementación deberá concentrarse en:

```text
Cache Contract
CacheStore
CacheEntry
CacheKey
CacheKeyBuilder
CacheNamespace
CachePolicy
CacheResult
Cache-Aside
TTL
Invalidation
Failure Policy
Local Cache
Distributed Adapter
Serialization Versioning
Tenant Isolation
Metrics
Contract Tests
```

antes de introducir:

```text
Write-Behind
Cross-Region Coherence
Distributed Transactional Cache
Advanced Lease Protocols
Predictive Warming
Adaptive TTL
```

Con **ENG-037** la serie global alcanza:

```text
EI-705
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
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-016 — Compatibility
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
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-038 — Concurrency Engineering