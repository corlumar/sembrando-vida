---
id: ENG-048
titulo: Multi-Tenancy Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Multi-Tenancy Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-011
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-028
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-017
  - ENG-022
  - ENG-026
  - ENG-033
  - ENG-049
keywords:
  - multi-tenancy
  - tenant
  - tenant-context
  - tenant-isolation
  - tenant-resolution
  - tenant-lifecycle
  - tenant-provisioning
  - tenant-data
  - tenant-database
  - tenant-schema
  - tenant-cache
  - tenant-session
  - tenant-storage
  - tenant-messaging
  - tenant-jobs
  - tenant-configuration
  - tenant-secrets
  - tenant-observability
  - tenant-quota
  - tenant-rate-limit
  - cross-tenant
  - platform-administration
  - noisy-neighbor
  - mef
---

# ENG-048

# Multi-Tenancy Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Multi-Tenancy Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-048 establece las reglas para:

```text
Tenant
Tenant Identity
Tenant Lifecycle
Tenant State
Tenant Provisioning
Tenant Activation
Tenant Suspension
Tenant Deprovisioning
Tenant Context
Tenant Resolution
Tenant Boundary
Tenant Isolation
Tenant Membership
Tenant-Aware Authentication
Tenant-Aware Authorization
Tenant-Aware Application
Tenant-Aware Data Access
Tenant Data Isolation
Tenant Database Strategy
Shared Database
Schema per Tenant
Database per Tenant
Tenant Query Scope
Tenant Transaction
Tenant Configuration
Tenant Secrets
Tenant Cache
Tenant Session
Tenant Messaging
Tenant Jobs
Tenant Scheduling
Tenant Storage
Tenant Files
Tenant Search
Tenant Observability
Tenant Audit
Tenant Rate Limits
Tenant Quotas
Resource Isolation
Noisy Neighbor Protection
Cross-Tenant Operations
Platform Administration
Tenant Migration
Tenant Backup
Tenant Restore
Tenant Export
Tenant Import
Tenant Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Todo estado, operación o recurso Tenant-Aware deberá ejecutarse dentro de un Tenant Context explícito, validado y propagado de extremo a extremo; ningún dato, Cache Entry, Session, Message, Job, File, Configuration, Secret o autorización perteneciente a un Tenant deberá ser observable o reutilizable por otro Tenant salvo una operación Cross-Tenant explícitamente autorizada.**

Arquitectura conceptual:

```text
Request / Message / Job
          │
          ▼
    Tenant Resolution
          │
          ▼
    Tenant Validation
          │
          ▼
      Tenant Context
          │
          ├── Authentication
          ├── Authorization
          ├── Application
          ├── Data Access
          ├── Cache
          ├── Messaging
          ├── Jobs
          ├── Storage
          └── Observability
          │
          ▼
   Tenant-Owned Resources
```

---

# 3. Multi-Tenancy

`Multi-Tenancy` permite que una misma plataforma atienda múltiples Tenants preservando aislamiento.

---

# 4. Tenant

Un `Tenant` representa una Boundary lógica de:

```text
ownership
configuration
data
access
resources
operations
```

---

# 5. Tenant ≠ User

Un Tenant podrá contener múltiples Identities.

---

# 6. Tenant ≠ Organization

Una Organization podrá coincidir con un Tenant, pero ambos conceptos no deberán acoplarse necesariamente.

---

# 7. Tenant ≠ Database

El Tenant es una Boundary de plataforma.

La Database Strategy es una decisión de implementación.

---

# 8. Tenant Identity

Todo Tenant deberá poseer un identificador interno estable.

Conceptualmente:

```text
TenantId
```

---

# 9. Tenant ID

No deberá reutilizarse después de Deprovisioning cuando pueda producir ambigüedad histórica.

---

# 10. Tenant Slug

Podrá existir para navegación o resolución.

Ejemplo:

```text
acme
northwind
contoso
```

---

# 11. Slug ≠ TenantId

El Slug podrá cambiar.

El TenantId deberá permanecer estable.

---

# 12. Tenant Metadata

Podrá incluir:

```text
name
slug
state
plan
region
createdAt
activatedAt
metadata
```

---

# 13. Tenant State

La primera implementación deberá reconocer:

```text
PROVISIONING
ACTIVE
SUSPENDED
DEPROVISIONING
DEPROVISIONED
```

---

# 14. Tenant State Machine

```text
PROVISIONING
     │
     ▼
   ACTIVE
     │
 ┌───┴────┐
 │        │
 ▼        ▼
SUSPENDED DEPROVISIONING
 │              │
 │ reactivate   ▼
 └──────────► DEPROVISIONED
```

---

# 15. Invalid Transition

Toda transición inválida deberá rechazarse.

---

# 16. Tenant Provisioning

Deberá preparar los recursos necesarios para operar el Tenant.

---

# 17. Provisioning Scope

Podrá incluir:

```text
tenant record
database/schema
configuration
storage namespace
secret namespace
cache namespace
baseline roles
baseline policies
quotas
administrative membership
```

---

# 18. Provisioning Idempotency

Deberá ser idempotente.

---

# 19. Partial Provisioning

Deberá detectarse y reconciliarse.

---

# 20. Tenant Activation

Solo deberá ocurrir cuando los recursos obligatorios estén preparados.

---

# 21. Tenant Suspension

Deberá impedir operaciones normales según Policy.

---

# 22. Suspension ≠ Deletion

La información podrá mantenerse durante suspensión.

---

# 23. Suspended Tenant

No deberá recuperar acceso únicamente porque una Identity conserve Session válida.

---

# 24. Tenant Reactivation

Deberá ser explícita y auditable.

---

# 25. Tenant Deprovisioning

Deberá retirar capacidad operativa de manera controlada.

---

# 26. Deprovisioning Flow

```text
Suspend Tenant
      │
      ▼
Reject New Operations
      │
      ▼
Drain/Cancel Jobs
      │
      ▼
Revoke Tenant Sessions
      │
      ▼
Disable Integrations
      │
      ▼
Backup / Export if required
      │
      ▼
Retention / Destruction
      │
      ▼
DEPROVISIONED
```

---

# 27. Tenant Deletion

Deberá distinguirse de Deprovisioning.

---

# 28. Tenant Context

`TenantContext` representa el Tenant efectivo de una operación.

Conceptualmente:

```text
TenantContext
├── tenantId
├── source
├── actor
├── correlationId
└── metadata
```

---

# 29. Tenant Context Required

Toda operación Tenant-Aware deberá poseer Tenant Context.

---

# 30. Missing Tenant Context

Deberá producir rechazo cuando el recurso requiera Tenant.

---

# 31. Tenant Context ≠ Global Variable

No deberá almacenarse en estado global mutable compartido entre Requests.

---

# 32. Tenant Context Immutability

Durante una operación deberá favorecerse un Context inmutable.

---

# 33. Tenant Context Propagation

Deberá propagarse explícitamente a:

```text
Application
Authorization
Data Access
Cache
Messaging
Jobs
Storage
Observability
```

---

# 34. Tenant Resolution

Determina el Tenant candidato de una operación.

---

# 35. Resolution Sources

Podrán incluir:

```text
authenticated principal
hostname
subdomain
route
trusted token claim
message metadata
job metadata
platform administration context
```

---

# 36. Untrusted Tenant Input

Un valor proveniente directamente de:

```text
query string
request body
arbitrary header
form field
```

no deberá constituir por sí mismo prueba de Tenant Membership o autorización.

---

# 37. Tenant Resolver

Conceptualmente:

```text
resolve(input)
    → TenantResolution
```

---

# 38. Resolution ≠ Authorization

Resolver un Tenant no significa que el Actor pueda acceder a él.

---

# 39. Tenant Validation

Después de Resolution deberán validarse:

```text
tenant exists
tenant state
membership
authorization
context consistency
```

---

# 40. Ambiguous Tenant

Deberá rechazarse o requerir selección explícita segura.

---

# 41. Multiple Tenant Sources

Si varias fuentes confiables producen Tenant IDs distintos deberá rechazarse la operación.

---

# 42. Tenant Spoofing

Deberá considerarse una violación de seguridad.

---

# 43. Tenant Boundary

Define el límite lógico dentro del cual operan recursos Tenant-Owned.

---

# 44. Tenant-Owned Resource

Todo Resource Tenant-Owned deberá poder asociarse inequívocamente a un Tenant.

---

# 45. Tenant-Neutral Resource

Podrá existir para:

```text
platform metadata
public catalog
global reference data
```

---

# 46. Tenant Ownership Classification

Los recursos deberán clasificarse como:

```text
TENANT_OWNED
PLATFORM_OWNED
SHARED_REFERENCE
```

---

# 47. Unknown Ownership

No deberá asumirse automáticamente como Shared.

---

# 48. Tenant Isolation

Deberá aplicarse transversalmente.

---

# 49. Isolation Layers

```text
Identity
Authorization
Application
Data
Cache
Session
Messaging
Jobs
Storage
Configuration
Secrets
Observability
```

---

# 50. Defense in Depth

El aislamiento no deberá depender de una sola capa.

---

# 51. Tenant Membership

ENG-047 administra Membership.

ENG-048 exige que el Tenant Context sea consistente con ella.

---

# 52. Membership ≠ Authorization

Una Membership activa no implica acceso a todos los Resources del Tenant.

---

# 53. Multi-Tenant Identity

Una Identity podrá pertenecer a múltiples Tenants.

---

# 54. Authority Separation

Los permisos deberán evaluarse dentro del Tenant efectivo.

---

# 55. Tenant Role Assignment

Un Role asignado en:

```text
Tenant A
```

no deberá aplicarse automáticamente en:

```text
Tenant B
```

---

# 56. Tenant-Aware Authentication

ENG-045 podrá incorporar Tenant Context cuando el método lo requiera.

---

# 57. Authentication ≠ Tenant Authorization

Una Identity autenticada no deberá cambiar libremente de Tenant.

---

# 58. Tenant Switching

Deberá validar:

```text
membership
tenant state
authorization
session policy
```

---

# 59. Session Tenant Binding

Una Session podrá estar ligada a:

```text
single tenant
```

o soportar Multi-Tenant Switching bajo Policy explícita.

---

# 60. Tenant Session

Deberá conservar Tenant Context verificable.

---

# 61. Session Reuse

Una Session ligada a Tenant A no deberá reutilizar autoridad de Tenant A dentro de Tenant B.

---

# 62. Tenant-Aware Authorization

ENG-046 deberá incluir Tenant Context en toda decisión Tenant-Aware.

---

# 63. Authorization Request

Deberá preservar:

```text
subject
actor
action
resource
tenant
```

---

# 64. Tenant Mismatch

Deberá producir:

```text
DENY
```

---

# 65. Cross-Tenant Permission

Deberá ser explícita.

Ejemplo:

```text
platform.tenants.read
platform.tenants.support
platform.tenants.migrate
```

---

# 66. Cross-Tenant Wildcard

Deberá evitarse.

---

# 67. Tenant-Aware Application

ENG-034 deberá preservar Tenant Context durante todo Use Case.

---

# 68. Use Case Tenant

Un Use Case Tenant-Aware deberá declarar o recibir su Tenant Scope.

---

# 69. Tenant Context Loss

Deberá considerarse Error crítico.

---

# 70. Data Access Isolation

ENG-043 deberá aplicar Tenant Scope antes de acceder a datos Tenant-Owned.

---

# 71. Tenant Query Scope

Conceptualmente:

```text
TenantScope(tenantId)
```

---

# 72. Query Example

```text
SELECT ...
FROM orders
WHERE tenant_id = :tenant_id
```

---

# 73. Developer Memory

El aislamiento no deberá depender exclusivamente de que cada Developer recuerde agregar manualmente el Tenant Filter.

---

# 74. Tenant-Aware Repository

Deberá favorecerse.

Conceptualmente:

```text
TenantAwareRepository
```

---

# 75. Repository Context

Podrá recibir TenantContext o TenantScope mediante Contract explícito.

---

# 76. Global Repository

Deberá diferenciarse claramente.

---

# 77. Unscoped Query

Sobre datos Tenant-Owned deberá rechazarse o estar restringida a componentes de plataforma explícitos.

---

# 78. Raw SQL

Deberá recibir controles adicionales.

---

# 79. Database Strategy

MEF deberá permitir diferentes estrategias.

---

# 80. Shared Database

Modelo:

```text
Database
├── Tenant A rows
├── Tenant B rows
└── Tenant C rows
```

---

# 81. Shared Database Requirement

Toda tabla Tenant-Owned deberá poseer Scope suficiente para aislamiento.

---

# 82. Composite Uniqueness

Constraints podrán requerir:

```text
tenant_id + business_key
```

---

# 83. Foreign Keys

No deberán permitir relaciones Cross-Tenant accidentales.

---

# 84. Cross-Tenant Foreign Key

Deberá impedirse cuando los recursos sean Tenant-Owned.

---

# 85. Row-Level Security

Podrá utilizarse como Defense in Depth.

---

# 86. Schema per Tenant

Modelo:

```text
Database
├── tenant_a_schema
├── tenant_b_schema
└── tenant_c_schema
```

---

# 87. Schema Resolution

Deberá derivarse de Tenant Context validado.

---

# 88. Dynamic Identifier Injection

No deberá construirse desde Input no confiable.

---

# 89. Database per Tenant

Modelo:

```text
Tenant A → Database A
Tenant B → Database B
Tenant C → Database C
```

---

# 90. Connection Resolution

Deberá utilizar Mapping confiable:

```text
TenantId → ConnectionDefinition
```

---

# 91. Connection Pool

No deberá reutilizar estado Tenant-Specific incorrectamente.

---

# 92. Strategy Independence

Application/Domain no deberán depender innecesariamente de la estrategia física.

---

# 93. Hybrid Strategy

Podrá existir.

Ejemplo:

```text
standard tenants → shared database
enterprise tenants → dedicated database
```

---

# 94. Tenant Transaction

Toda Transaction deberá mantener Tenant Scope consistente.

---

# 95. Cross-Tenant Transaction

Deberá ser excepcional y explícita.

---

# 96. Transaction Context Switch

No deberá cambiar Tenant silenciosamente durante una Transaction.

---

# 97. Tenant Configuration

Configuración podrá existir por Tenant.

---

# 98. Configuration Resolution

Orden conceptual:

```text
Framework Default
      │
      ▼
Platform Configuration
      │
      ▼
Tenant Configuration
```

---

# 99. Tenant Override

Solo deberá permitirse para Keys declaradas como Tenant-Configurable.

---

# 100. Security Configuration

No deberá debilitarse mediante Tenant Override salvo Policy explícita.

---

# 101. Configuration Cache

Deberá incluir TenantId.

---

# 102. Configuration Leakage

Una configuración resuelta para Tenant A no deberá reutilizarse para Tenant B.

---

# 103. Tenant Secrets

Secrets Tenant-Specific deberán estar aislados.

---

# 104. Secret Namespace

Conceptualmente:

```text
tenant/{tenantId}/...
```

---

# 105. Secret Access

Deberá requerir Tenant Context y Authorization apropiada.

---

# 106. Secret Logging

No deberá ocurrir.

---

# 107. Secret Cache

Deberá preservar Tenant Scope.

---

# 108. Tenant Cache

Toda Cache Entry derivada de datos Tenant-Owned deberá incluir Tenant Scope.

---

# 109. Cache Key

Conceptualmente:

```text
tenant:{tenantId}:{namespace}:{key}
```

---

# 110. Cache Namespace

Deberá impedir colisiones Cross-Tenant.

---

# 111. Shared Cache

Podrá utilizarse físicamente siempre que exista aislamiento lógico robusto.

---

# 112. Dedicated Cache

Podrá utilizarse para Tenants de mayor aislamiento.

---

# 113. Cache Invalidation

Deberá operar dentro del Tenant correcto.

---

# 114. Flush Tenant

No deberá convertirse accidentalmente en:

```text
flush all tenants
```

---

# 115. Cached Authorization

Deberá incluir Tenant Context conforme ENG-046.

---

# 116. Cached Identity

Deberá preservar Scope cuando el dato dependa del Tenant.

---

# 117. Tenant Session Storage

Session Keys deberán evitar colisiones.

---

# 118. Session Metadata

Podrá incluir:

```text
tenantId
identityId
sessionId
issuedAt
```

---

# 119. Tenant Messaging

Todo Message Tenant-Aware deberá transportar Tenant Context verificable.

---

# 120. Message Metadata

Conceptualmente:

```text
tenantId
messageId
correlationId
causationId
```

---

# 121. Message Payload Tenant ID

No deberá confiarse si Metadata autenticada/validada establece otro Tenant.

---

# 122. Message Consumer

Deberá reconstruir Tenant Context antes de ejecutar Application Logic.

---

# 123. Missing Tenant Message

Deberá rechazarse si el Message requiere Tenant.

---

# 124. Dead Letter

Deberá conservar Tenant Context suficiente para investigación segura.

---

# 125. Message Retry

No deberá perder Tenant Context.

---

# 126. Tenant Jobs

Todo Background Job Tenant-Aware deberá preservar Tenant Context.

---

# 127. Job Payload

Deberá incluir Tenant Reference estable.

---

# 128. Job Execution

Antes de ejecutar deberá comprobar:

```text
tenant exists
tenant active/allowed
job still valid
```

---

# 129. Suspended Tenant Job

No deberá ejecutarse normalmente salvo Job administrativo permitido.

---

# 130. Scheduled Job

Deberá distinguir:

```text
platform job
tenant job
```

---

# 131. Tenant Job Concurrency

Podrá limitarse por Tenant.

---

# 132. Noisy Neighbor

Un Tenant no deberá agotar recursos compartidos de manera que degrade desproporcionadamente a otros.

---

# 133. Resource Isolation

Podrá aplicarse a:

```text
CPU
memory
database connections
queue throughput
worker concurrency
storage
API requests
```

---

# 134. Tenant Rate Limit

Deberá ser independiente del User Rate Limit cuando corresponda.

---

# 135. Tenant Quota

Podrá limitar:

```text
users
storage
API calls
jobs
records
exports
integrations
```

---

# 136. Quota Scope

Deberá ser explícito.

---

# 137. Quota Enforcement

No deberá depender únicamente de UI.

---

# 138. Quota Race

Deberá considerar Concurrency.

---

# 139. Quota Exceeded

Deberá producir Error estable.

---

# 140. Tenant Storage

Todo almacenamiento Tenant-Owned deberá poseer Namespace aislado.

---

# 141. Storage Example

```text
tenants/{tenantId}/documents/...
```

---

# 142. User Filename

No deberá controlar el Namespace Tenant.

---

# 143. Path Traversal

Deberá impedirse conforme ENG-024.

---

# 144. Tenant File

Metadata deberá preservar Tenant Ownership.

---

# 145. File Download

Deberá autorizar Tenant + Resource.

---

# 146. Signed URL

Deberá estar limitada a:

```text
resource
tenant
expiration
operation
```

cuando la tecnología lo permita.

---

# 147. File Move

No deberá permitir Cross-Tenant Move salvo operación explícita.

---

# 148. Object Storage Bucket

Podrá utilizar:

```text
shared bucket + tenant prefix
```

o:

```text
bucket per tenant
```

---

# 149. Search Index

Deberá preservar Tenant Scope.

---

# 150. Search Document

Todo documento Tenant-Owned indexado deberá contener Tenant Identity verificable.

---

# 151. Search Query

Deberá aplicar Tenant Filter antes de retornar resultados.

---

# 152. Search Cache

También deberá incluir Tenant Scope.

---

# 153. Search Count

No deberá filtrar datos después de calcular Counts globales.

---

# 154. Search Suggestions

No deberán revelar términos de otros Tenants.

---

# 155. Tenant Observability

ENG-025 deberá permitir investigar comportamiento por Tenant sin generar Cardinality incontrolada.

---

# 156. Tenant Logs

Podrán incluir TenantId cuando sea apropiado y permitido.

---

# 157. Tenant Metrics

No deberán incluir TenantId indiscriminadamente como Label.

---

# 158. High-Cardinality Tenant Metrics

Deberán utilizar mecanismos alternativos cuando existan muchos Tenants.

---

# 159. Tenant Trace

Podrá conservar Tenant Context como Attribute controlado.

---

# 160. Audit

Operaciones sensibles deberán conservar Tenant Scope.

---

# 161. Audit Tenant

No deberá inferirse posteriormente si puede registrarse al momento de la operación.

---

# 162. Cross-Tenant Audit

Deberá registrar:

```text
actor
sourceTenant
targetTenant
action
reason
authorization
timestamp
```

cuando corresponda.

---

# 163. Platform Administration

La plataforma podrá requerir operaciones fuera de un Tenant ordinario.

---

# 164. Platform Context

Deberá modelarse explícitamente.

---

# 165. Platform Admin ≠ Tenant Admin

Deberán utilizar Permissions distintas.

---

# 166. Tenant Administrator

Administra recursos dentro de un Tenant.

---

# 167. Platform Administrator

Podrá administrar Tenants bajo controles reforzados.

---

# 168. Platform Admin Session

No deberá convertirse automáticamente en acceso indiscriminado a Tenant Data.

---

# 169. Support Access

Deberá ser explícito, temporal y auditable.

---

# 170. Support Impersonation

Deberá seguir ENG-045, ENG-046 y ENG-047.

---

# 171. Cross-Tenant Operation

Toda operación que acceda a más de un Tenant deberá declararse explícitamente.

---

# 172. Cross-Tenant Query

No deberá estar disponible para código Tenant ordinario.

---

# 173. Cross-Tenant Export

Deberá requerir Permission de plataforma específica.

---

# 174. Cross-Tenant Analytics

Deberá definir:

```text
data minimization
aggregation
privacy
authorization
audit
```

---

# 175. Tenant Migration

Permite mover un Tenant entre estrategias o infraestructura.

---

# 176. Migration Examples

```text
shared DB → dedicated DB
region A → region B
schema A → schema B
storage cluster A → B
```

---

# 177. Migration Safety

Deberá preservar:

```text
identity
data integrity
authorization
configuration
secrets
audit
```

---

# 178. Migration State

Podrá incluir:

```text
PLANNED
PREPARING
COPYING
VALIDATING
CUTTING_OVER
COMPLETED
FAILED
ROLLING_BACK
```

---

# 179. Migration Write Strategy

Deberá definirse:

```text
downtime
dual write
change capture
read-only window
```

---

# 180. Tenant Migration Validation

Deberá verificar ausencia de Cross-Tenant Contamination.

---

# 181. Tenant Backup

Deberá permitir identificar qué Tenant Data contiene.

---

# 182. Shared Database Backup

Puede contener múltiples Tenants.

Su acceso deberá tratarse como altamente sensible.

---

# 183. Tenant-Level Restore

Cuando sea soportado deberá restaurar únicamente el Tenant objetivo.

---

# 184. Restore Contamination

Deberá probarse explícitamente.

---

# 185. Backup Encryption

Deberá seguir ENG-024.

---

# 186. Backup Retention

Deberá seguir Policy definida.

---

# 187. Tenant Export

Deberá ser una operación autorizada y auditable.

---

# 188. Export Scope

Deberá limitarse al Tenant objetivo.

---

# 189. Export Manifest

Podrá incluir:

```text
tenantId
exportId
createdAt
schemaVersion
resourceTypes
checksums
```

---

# 190. Tenant Import

Deberá validar que los datos no introduzcan referencias Cross-Tenant inválidas.

---

# 191. Import Target

Deberá ser explícito.

---

# 192. Import Dry Run

Deberá favorecerse.

---

# 193. Tenant Data Residency

Podrá incorporarse cuando existan requisitos geográficos.

---

# 194. Tenant Region

Podrá influir en:

```text
database
storage
backup
processing
```

---

# 195. Region Change

Deberá tratarse como Migration.

---

# 196. Tenant Encryption

Podrá utilizar claves:

```text
platform-wide
group-specific
tenant-specific
```

según Threat Model.

---

# 197. Tenant-Specific Key

Aumenta aislamiento pero también Lifecycle Complexity.

---

# 198. Key Destruction

Podrá formar parte de Crypto-Erasure cuando sea apropiado.

---

# 199. Tenant API

ENG-044 deberá resolver y validar Tenant Context.

---

# 200. API Tenant Header

Un Header podrá transportar Tenant Candidate, pero no demostrar autorización por sí mismo.

---

# 201. API Route Tenant

Ejemplo:

```text
/tenants/{tenantId}/orders
```

El `tenantId` deberá compararse con Context autorizado.

---

# 202. API Response

No deberá contener datos de otro Tenant aunque la Request manipule Identifiers.

---

# 203. GraphQL

Resolvers deberán preservar Tenant Context si se soporta.

---

# 204. Batch API

Deberá impedir mezclar Resources de múltiples Tenants salvo Contract Cross-Tenant explícito.

---

# 205. WebSocket

Tenant Context deberá establecerse y validarse durante Connection/Subscription.

---

# 206. Long-Lived Connection

Cambios de Membership/Tenant State deberán poder invalidar autoridad.

---

# 207. Webhook

Outbound Webhooks deberán utilizar Configuration/Secrets del Tenant correcto.

---

# 208. Inbound Webhook

Deberá resolver Tenant mediante información confiable.

---

# 209. Webhook Secret

Deberá estar Scoped por Tenant cuando corresponda.

---

# 210. External Integration

Toda integración Tenant-Specific deberá preservar:

```text
tenant ownership
credentials
configuration
rate limits
audit
```

---

# 211. Integration Credential

No deberá compartirse accidentalmente entre Tenants.

---

# 212. Tenant Error

ENG-023 gobernará Error Translation.

---

# 213. Error Namespace

ENG-048 utilizará:

```text
MEF-TENANT-xxx
```

---

# 214. Taxonomía ENG-048

```text
MEF-TENANT-001 Tenant required
MEF-TENANT-002 Tenant not found
MEF-TENANT-003 Tenant inactive
MEF-TENANT-004 Tenant suspended
MEF-TENANT-005 Tenant deprovisioned
MEF-TENANT-006 Tenant resolution failed
MEF-TENANT-007 Tenant resolution ambiguous
MEF-TENANT-008 Tenant context mismatch
MEF-TENANT-009 Tenant access denied
MEF-TENANT-010 Cross-tenant access denied
MEF-TENANT-011 Tenant membership invalid
MEF-TENANT-012 Tenant query scope missing
MEF-TENANT-013 Tenant data isolation violation
MEF-TENANT-014 Tenant cache isolation violation
MEF-TENANT-015 Tenant session mismatch
MEF-TENANT-016 Tenant message context missing
MEF-TENANT-017 Tenant job context missing
MEF-TENANT-018 Tenant storage isolation violation
MEF-TENANT-019 Tenant configuration invalid
MEF-TENANT-020 Tenant secret access denied
MEF-TENANT-021 Tenant quota exceeded
MEF-TENANT-022 Tenant provisioning failed
MEF-TENANT-023 Tenant deprovisioning failed
MEF-TENANT-024 Tenant migration failed
MEF-TENANT-025 Tenant backup failed
MEF-TENANT-026 Tenant restore failed
MEF-TENANT-027 Tenant import invalid
MEF-TENANT-028 Tenant export denied
MEF-TENANT-029 Tenant security violation
MEF-TENANT-030 Tenant invariant violation
```

---

# 215. Tenant Context Mismatch Example

```text
MEF-TENANT-008

Tenant context mismatch.

Requested resource does not belong
to the active tenant context.
```

---

# 216. Cross-Tenant Example

```text
MEF-TENANT-010

Cross-tenant access denied.
```

---

# 217. Query Scope Example

```text
MEF-TENANT-012

Tenant query scope is required
for tenant-owned data.
```

---

# 218. Isolation Violation

Deberá considerarse Security Event.

---

# 219. Isolation Severity

Una confirmación de exposición Cross-Tenant deberá tratarse como incidente de alta severidad.

---

# 220. Testing

ENG-009 gobernará Testing.

---

# 221. Tenant Resolution Test

Deberá cubrir:

```text
valid source
missing tenant
ambiguous tenant
spoofed tenant
conflicting sources
```

---

# 222. Tenant Context Test

Deberá comprobar propagación completa.

---

# 223. Context Leakage Test

Deberá ejecutar Requests concurrentes para Tenants diferentes.

---

# 224. Data Isolation Test

Será obligatorio.

---

# 225. Horizontal IDOR Test

Deberá intentar:

```text
Tenant A user
→ Tenant B resource ID
```

y producir Deny.

---

# 226. Repository Isolation Test

Deberá comprobar que Queries sin Tenant Scope sean rechazadas.

---

# 227. Raw SQL Test

Deberá cubrir Paths que eviten Repository.

---

# 228. Foreign Key Test

Deberá impedir relaciones Cross-Tenant inválidas.

---

# 229. Cache Isolation Test

Deberá utilizar la misma Logical Key para dos Tenants y obtener valores independientes.

---

# 230. Cache Flush Test

Deberá comprobar que invalidación de A no destruya B salvo operación de plataforma explícita.

---

# 231. Session Isolation Test

Deberá intentar cambiar Tenant sin autorización.

---

# 232. Authentication Tenant Test

Deberá comprobar Session/Token Binding cuando aplique.

---

# 233. Authorization Tenant Test

Deberá comprobar que Role de Tenant A no autorice Tenant B.

---

# 234. Messaging Isolation Test

Deberá comprobar:

```text
tenant metadata
retry
dead letter
duplicate
```

---

# 235. Job Isolation Test

Deberá comprobar Tenant Context en Background Execution.

---

# 236. Storage Isolation Test

Deberá intentar:

```text
path traversal
foreign tenant file ID
signed URL reuse
cross-tenant move
```

---

# 237. Search Isolation Test

Deberá comprobar:

```text
results
counts
aggregations
suggestions
```

---

# 238. Configuration Isolation Test

Deberá comprobar que Config de Tenant A no aparezca en B.

---

# 239. Secret Isolation Test

Será obligatorio.

---

# 240. Quota Test

Deberá comprobar Race Conditions.

---

# 241. Noisy Neighbor Test

Podrá simular carga desproporcionada de un Tenant.

---

# 242. Migration Test

Deberá comprobar:

```text
data completeness
tenant identity
authorization
configuration
rollback
isolation
```

---

# 243. Backup Restore Test

Deberá comprobar restauración sin contaminación Cross-Tenant.

---

# 244. Deprovisioning Test

Deberá comprobar que Tenant suspendido/deprovisionado no pueda continuar mediante:

```text
session
token
job
message
integration
```

---

# 245. Platform Admin Test

Deberá comprobar separación entre:

```text
Tenant Admin
Platform Admin
Support Operator
```

---

# 246. Cross-Tenant Test

Deberá existir Suite dedicada.

---

# 247. Property-Based Testing

Podrá verificar:

```text
resource tenant != context tenant
→ access never succeeds

cache key same + tenant different
→ values never collide

tenant suspended
→ ordinary operations never execute
```

---

# 248. Concurrency Testing

Deberá comprobar Context Leakage entre Workers/Threads/Coroutines.

---

# 249. Architecture Test

Podrá impedir:

```text
global mutable TenantContext
unscoped Tenant-Owned Repository
tenantless Cache Key
tenantless Job
tenantless Message
client-trusted TenantId
```

---

# 250. Build Integration

ENG-012 podrá validar:

```text
Tenant-Owned entity without tenant scope
unscoped repository
unsafe cache namespace
missing tenant job metadata
missing tenant message metadata
invalid tenant configuration
cross-tenant foreign key
```

---

# 251. Static Analysis

Podrá detectar Paths Tenant-Aware sin TenantContext.

---

# 252. CLI

ENG-007 podrá proporcionar:

```text
mef tenant:list
mef tenant:show
mef tenant:create
mef tenant:activate
mef tenant:suspend
mef tenant:reactivate
mef tenant:deprovision
mef tenant:config
mef tenant:quota
mef tenant:migrate
mef tenant:backup
mef tenant:restore
mef tenant:export
mef tenant:diagnose
```

---

# 253. CLI Tenant Context

Comandos Tenant-Specific deberán requerir Tenant explícito.

---

# 254. CLI Platform Operation

Deberá diferenciarse visual y semánticamente.

---

# 255. Destructive CLI

Deberá requerir controles reforzados.

---

# 256. `tenant:diagnose`

Podrá comprobar:

```text
state
database
storage
cache
configuration
secrets
jobs
integrations
quota
```

---

# 257. Configuration

ENG-011 podrá definir:

```text
multi_tenancy:
  enabled: true

  resolution:
    strategy: authenticated-context

  isolation:
    require-context: true
    fail-on-mismatch: true

  database:
    strategy: shared

  cache:
    namespace-by-tenant: true

  sessions:
    bind-tenant: true

  messaging:
    require-tenant-metadata: true

  jobs:
    require-tenant-context: true

  storage:
    namespace-by-tenant: true

  quotas:
    enabled: true
```

---

# 258. Configuration Validation

Deberá comprobar:

```text
valid resolution strategy
valid database strategy
tenant context required
cache namespace isolation
session binding
message propagation
job propagation
storage namespace
quota configuration
```

---

# 259. Registry Integration

ENG-020 podrá registrar:

```text
TenantResolverDefinition
TenantDatabaseStrategy
TenantStorageStrategy
TenantConfigurationProvider
TenantQuotaDefinition
TenantProvisioningStep
```

---

# 260. Tenant Resolver Definition

Conceptualmente:

```text
TenantResolver
├── priority
├── source
├── resolve
└── validate
```

---

# 261. Tenant Database Resolver

Conceptualmente:

```text
resolve(TenantId)
    → DatabaseContext
```

---

# 262. Tenant Storage Resolver

Conceptualmente:

```text
resolve(TenantId)
    → StorageContext
```

---

# 263. Tenant Configuration Provider

Conceptualmente:

```text
get(TenantId, key)
```

---

# 264. Tenant Manager

Deberá coordinar Tenant Lifecycle.

---

# 265. Tenant Context Manager

Deberá establecer Context Scoped a la operación.

---

# 266. Context Manager Safety

Deberá garantizar Cleanup al finalizar ejecución.

---

# 267. Worker Reuse

Es especialmente crítico en:

```text
long-running workers
queue consumers
application servers
coroutines
```

---

# 268. Context Reset

Antes y después de cada operación deberá evitarse contaminación de Context.

---

# 269. Runtime Integration

ENG-027 deberá construir Multi-Tenant Runtime.

---

# 270. Bootstrap Flow

```text
Load Configuration
       │
       ▼
Discover Tenant Resolvers
       │
       ▼
Validate Isolation Strategy
       │
       ▼
Build Tenant Registry
       │
       ▼
Build Context Manager
       │
       ▼
Build Database Strategy
       │
       ▼
Build Storage Strategy
       │
       ▼
Validate Cache Namespace
       │
       ▼
Validate Messaging / Jobs
       │
       ▼
Validate Tenant Security
       │
       ▼
Readiness
```

---

# 271. Bootstrap Failure

Deberá impedir Readiness ante:

```text
missing resolver
unsafe default tenant
invalid database strategy
missing cache isolation
missing storage isolation
invalid tenant configuration
unsafe platform bypass
```

---

# 272. Default Tenant

No deberá utilizarse silenciosamente para operaciones que requieran Tenant explícito.

---

# 273. Module Integration

Cada Module deberá declarar si sus Resources son:

```text
TENANT_OWNED
PLATFORM_OWNED
SHARED_REFERENCE
```

---

# 274. Module Tenant Contract

Podrá declarar:

```text
tenant-aware repositories
tenant configuration
tenant quotas
tenant storage
tenant jobs
```

---

# 275. Cross-Module Tenant Context

Deberá preservarse mediante Contracts.

---

# 276. Module Isolation

Un Module no deberá cambiar Tenant Context de otro Module.

---

# 277. Application Integration

ENG-034 deberá recibir TenantContext explícito en Use Cases Tenant-Aware.

---

# 278. Domain Integration

ENG-035 podrá modelar Tenant Ownership cuando forme parte real del Domain.

---

# 279. Domain Pollution

No deberá introducirse TenantId en cada Domain Object únicamente por infraestructura si no es semánticamente necesario.

---

# 280. Data Access Integration

ENG-043 deberá ser una de las principales capas de Defense in Depth.

---

# 281. API Integration

ENG-044 deberá resolver/validar Tenant antes de ejecutar Use Cases Tenant-Aware.

---

# 282. Authentication Integration

ENG-045 deberá preservar Tenant Binding cuando aplique.

---

# 283. Authorization Integration

ENG-046 deberá evaluar Tenant como parte del Authorization Context.

---

# 284. IAM Integration

ENG-047 deberá administrar Tenant Membership y Scoped Assignments.

---

# 285. Transaction Integration

ENG-042 deberá impedir Tenant Context Switch accidental durante Transaction.

---

# 286. Cache Integration

ENG-037 deberá Namespacear toda entrada Tenant-Specific.

---

# 287. Messaging Integration

ENG-041 deberá preservar Tenant Metadata.

---

# 288. Scheduling Integration

ENG-040 deberá distinguir Jobs de plataforma y Tenant.

---

# 289. Concurrency Integration

ENG-038 deberá impedir Context Leakage.

---

# 290. Resilience Integration

ENG-039 deberá evitar que Fallbacks rompan Tenant Isolation.

---

# 291. Observability Integration

ENG-025 deberá conservar suficiente Tenant Context para diagnóstico sin producir Telemetry insegura.

---

# 292. Security Integration

ENG-024 deberá tratar Cross-Tenant Data Exposure como amenaza crítica.

---

# 293. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Tenant
TenantId
TenantState

TenantContext
TenantResolution
TenantResolver

TenantManager
TenantContextManager

TenantScope
TenantAwareRepository

TenantDatabaseResolver
TenantStorageResolver
TenantConfigurationProvider

TenantQuota
TenantError
```

---

# 294. Optional Initial Components

Podrán incorporarse:

```text
TenantProvisioner
TenantCacheNamespace
TenantSessionBinding
TenantMessageMetadata
TenantJobContext
TenantAuditContext
```

---

# 295. Later Components

Solo cuando exista necesidad demostrada:

```text
Database per Tenant
Schema per Tenant
Tenant Migration Engine
Tenant-Specific Encryption Keys
Data Residency
Dedicated Tenant Infrastructure
Advanced Noisy Neighbor Control
Cross-Region Tenant Mobility
```

---

# 296. Conceptual Directory Structure

```text
src/
└── MultiTenancy/
    ├── Tenant/
    │   ├── Tenant
    │   ├── TenantId
    │   └── TenantState
    │
    ├── Context/
    │   ├── TenantContext
    │   ├── TenantContextManager
    │   └── TenantScope
    │
    ├── Resolution/
    │   ├── TenantResolver
    │   └── TenantResolution
    │
    ├── Lifecycle/
    │   ├── TenantManager
    │   └── TenantProvisioner
    │
    ├── Database/
    │   └── TenantDatabaseResolver
    │
    ├── Storage/
    │   └── TenantStorageResolver
    │
    ├── Configuration/
    │   └── TenantConfigurationProvider
    │
    ├── Quota/
    │   └── TenantQuota
    │
    ├── Cache/
    │   └── TenantCacheNamespace
    │
    ├── Session/
    │   └── TenantSessionBinding
    │
    ├── Messaging/
    │   └── TenantMessageMetadata
    │
    ├── Job/
    │   └── TenantJobContext
    │
    ├── Audit/
    │   └── TenantAuditContext
    │
    └── Error/
        └── TenantError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 297. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Stable TenantId
Explicit Tenant Lifecycle
Tenant State Machine
Explicit Tenant Context
Trusted Tenant Resolution
Context Propagation
Fail on Missing Context
Tenant Membership Validation
Tenant-Aware Authorization
Tenant-Aware Repository
Shared Database Isolation
Tenant Cache Namespace
Tenant Session Binding
Tenant Messaging Context
Tenant Job Context
Tenant Storage Namespace
Tenant Configuration
Tenant Quotas
Cross-Tenant Deny by Default
Audit
Isolation Testing
```

---

# 298. First Version Non-Goals

No deberá requerir:

```text
Database per Tenant
Schema per Tenant
Dedicated Kubernetes Namespace per Tenant
Dedicated Infrastructure
Cross-Region Tenant Mobility
Tenant-Specific Encryption Key Infrastructure
Global Tenant Federation
Automatic Tenant Sharding
```

---

# 299. Second Phase

Podrá incorporar:

```text
Schema per Tenant
Database per Tenant
Tenant Migration
Tenant Backup/Restore
Data Residency
Dedicated Cache
Advanced Quotas
Noisy Neighbor Controls
```

---

# 300. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automated Tenant Placement
Cross-Region Mobility
Tenant-Specific Encryption Keys
Dedicated Runtime Pools
Advanced Sharding
Enterprise Data Residency
Global Tenant Federation
```

---

# 301. Invariantes de Ingeniería

ENG-048 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-906 | Todo Resource Tenant-Owned deberá asociarse inequívocamente a un Tenant mediante un TenantId interno estable y toda operación Tenant-Aware deberá ejecutarse dentro de TenantContext explícito. |
| EI-907 | Tenant Resolution deberá permanecer separada de Authentication y Authorization; ningún Tenant ID proporcionado por el Consumer deberá constituir por sí mismo prueba de Membership o autoridad. |
| EI-908 | Tenant Context deberá propagarse de extremo a extremo y nunca deberá almacenarse como estado global mutable susceptible de filtrarse entre Requests, Workers, Threads o Coroutines. |
| EI-909 | Toda discrepancia entre Tenant Context, Resource Ownership, Membership, Session o fuentes confiables de Resolution deberá producir rechazo y nunca selección silenciosa de un Tenant alternativo. |
| EI-910 | Data Access sobre Resources Tenant-Owned deberá aplicar Tenant Scope antes de recuperar o modificar datos y no deberá depender exclusivamente de filtros manuales añadidos por cada Developer. |
| EI-911 | Shared Database, Schema-per-Tenant, Database-per-Tenant e implementaciones híbridas deberán preservar la misma semántica de aislamiento para Application y Domain. |
| EI-912 | Cache, Session, Configuration, Secrets, Search y Storage Tenant-Specific deberán utilizar Namespaces o Boundaries que impidan reutilización o colisión Cross-Tenant. |
| EI-913 | Messages, Background Jobs, Scheduled Work y operaciones asíncronas Tenant-Aware deberán transportar, validar, reconstruir y limpiar Tenant Context antes y después de cada ejecución. |
| EI-914 | Tenant Membership y Role Assignments deberán permanecer Scoped al Tenant correspondiente y nunca deberán transferir autoridad implícitamente entre Tenants. |
| EI-915 | Cross-Tenant Operations deberán estar prohibidas por Default y solo podrán ejecutarse mediante Contracts, Permissions y Audit explícitamente diseñados para operaciones de plataforma. |
| EI-916 | Tenant Suspension y Deprovisioning deberán impedir acceso mediante Sessions, Tokens, Jobs, Messages, Integrations o cualquier otro Path operativo que sobreviva al cambio de estado. |
| EI-917 | Tenant Provisioning, Deprovisioning, Migration, Import, Export, Backup y Restore deberán ser observables, reconciliables y preservar Isolation e Integrity incluso ante Partial Failure. |
| EI-918 | Tenant Quotas, Rate Limits y Resource Isolation deberán impedir que un Tenant degrade de manera desproporcionada la disponibilidad de otros Tenants cuando compartan infraestructura. |
| EI-919 | Platform Administration, Tenant Administration y Support Access deberán utilizar autoridades distintas; ninguna condición de Platform Admin deberá implicar acceso indiscriminado a Tenant Data. |
| EI-920 | Search Results, Counts, Aggregations, Suggestions, Exports y Analytics deberán preservar Tenant Isolation y no deberán revelar información derivada de Tenants no autorizados. |
| EI-921 | Toda confirmación de Cross-Tenant Data Exposure, Cache Leakage, Session Leakage, Secret Leakage o Storage Leakage deberá tratarse como Security Incident de alta severidad. |
| EI-922 | Cambios de Tenant State, Membership, Configuration, Database Mapping, Storage Mapping o Infrastructure Placement deberán invalidar o actualizar todo estado derivado relevante. |
| EI-923 | Tenant Observability deberá permitir correlacionar operaciones y detectar Isolation Violations sin exponer Secrets ni introducir Cardinality incontrolada. |
| EI-924 | Multi-Tenancy Testing deberá cubrir Resolution, Context Propagation, Data, Cache, Session, Messaging, Jobs, Storage, Search, Configuration, Secrets, Concurrency, Migration y Cross-Tenant Attacks. |
| EI-925 | La primera implementación deberá favorecer TenantContext explícito, Trusted Resolution, Shared-Database Isolation, Tenant-Aware Repositories, Namespaced Cache/Storage, Context-Aware Async Processing y Cross-Tenant Deny-by-Default antes de introducir infraestructura dedicada o movilidad avanzada. |

---

# 302. Continuidad de Invariantes

```text
ENG-044 → EI-826 a EI-845
ENG-045 → EI-846 a EI-865
ENG-046 → EI-866 a EI-885
ENG-047 → EI-886 a EI-905
ENG-048 → EI-906 a EI-925
```

---

# 303. Criterios de Conformidad

Una implementación será conforme con ENG-048 cuando:

- modele Tenant mediante ID interno estable;
- modele Tenant Lifecycle;
- implemente Tenant State Machine;
- modele TenantContext;
- rechace Context faltante donde sea obligatorio;
- resuelva Tenant mediante fuentes confiables;
- separe Resolution de Authorization;
- detecte fuentes contradictorias;
- preserve Context entre capas;
- limpie Context en Workers reutilizables;
- clasifique Resource Ownership;
- preserve Tenant Membership Scope;
- preserve Role Assignment Scope;
- incluya Tenant en Authorization;
- implemente Tenant-Aware Repositories;
- impida Queries Tenant-Owned sin Scope;
- preserve aislamiento en Shared Database;
- permita estrategias alternativas sin contaminar Domain;
- preserve Tenant Scope en Transactions;
- namespace Cache;
- namespace Sessions;
- aisle Configuration;
- aisle Secrets;
- propague Tenant en Messages;
- propague Tenant en Jobs;
- namespace Storage;
- preserve Tenant en Search;
- aplique Quotas;
- controle Noisy Neighbor;
- diferencie Tenant Admin de Platform Admin;
- prohíba Cross-Tenant por Default;
- audite Cross-Tenant Operations;
- preserve aislamiento en Migration;
- preserve aislamiento en Backup/Restore;
- trate Isolation Violation como Security Event;
- pruebe Cross-Tenant Attacks.

---

# 304. Riesgos

Deberán evitarse especialmente:

## Global Tenant Context

```text
CurrentTenant::$id
```

permanece entre Requests.

## Default Tenant

Una operación sin Context cae silenciosamente en un Tenant predeterminado.

## Client-Trusted Tenant ID

El cliente selecciona Tenant y el servidor lo acepta sin validar Membership.

## Tenant Resolution = Authorization

Encontrar un Tenant se interpreta como permiso para acceder.

## Manual WHERE Everywhere

Cada Developer debe recordar:

```text
WHERE tenant_id = ?
```

## Unscoped Repository

Permite recuperar Resources de cualquier Tenant.

## Cross-Tenant Foreign Key

Un Resource de Tenant A referencia Resource de Tenant B.

## Cache Collision

```text
order:123
```

es compartida entre Tenants.

## Configuration Leakage

La configuración resuelta para A queda en memoria y se utiliza en B.

## Secret Leakage

Una Integration obtiene Credential de otro Tenant.

## Session Tenant Confusion

Una Session cambia de Tenant sin reevaluar autoridad.

## Worker Context Leakage

Un Queue Worker procesa Tenant B conservando Context de Tenant A.

## Tenantless Message

El Consumer ejecuta sin saber a qué Tenant pertenece.

## Tenantless Job

Background Work utiliza Default Tenant.

## Search Leakage

Resultados o Suggestions incluyen información de otro Tenant.

## Count Leakage

Counts globales revelan existencia de datos ajenos.

## Storage Prefix Injection

El usuario controla el Tenant Prefix.

## Signed URL Reuse

Una URL emitida para A permite acceder desde B.

## Platform Admin Bypass

Platform Admin se convierte en lectura global automática.

## Backup Contamination

Restore de A introduce datos de B.

## Migration Contamination

Proceso de migración copia Resources incorrectos.

## Noisy Neighbor

Un Tenant monopoliza Connections, Workers o Storage.

## Suspended Tenant Still Running

Jobs y Tokens sobreviven a suspensión.

---

# 305. Relación con ENG-045

Authentication establece:

```text
Principal
Session
Token
Authentication Assurance
```

ENG-048 exige preservar Tenant Binding cuando corresponda.

---

# 306. Relación con ENG-046

Authorization deberá evaluar:

```text
Principal
Action
Resource
TenantContext
```

La regla central será:

```text
resource.tenantId != context.tenantId
→ DENY
```

salvo Cross-Tenant Policy explícita.

---

# 307. Relación con ENG-047

IAM administra:

```text
Tenant Membership
Scoped Role Assignment
Access Assignment
```

ENG-048 garantiza que esa autoridad permanezca dentro del Tenant correspondiente.

---

# 308. Relación con ENG-043

Data Access deberá aplicar Tenant Scope como parte estructural de la operación.

---

# 309. Relación con ENG-037

Cache deberá utilizar Tenant Namespace.

---

# 310. Relación con ENG-041

Messaging deberá transportar Tenant Metadata confiable.

---

# 311. Relación con ENG-040

Scheduling/Jobs deberán reconstruir Tenant Context antes de ejecutar.

---

# 312. Relación con ENG-038

Concurrency deberá garantizar aislamiento de Context en ejecución concurrente.

---

# 313. Relación con ENG-042

Transactions deberán permanecer dentro de Tenant Boundary salvo Contract Cross-Tenant explícito.

---

# 314. Relación con ENG-044

API deberá resolver Tenant Candidate y validar su consistencia antes de ejecutar Application.

---

# 315. Relación con ENG-024

Cross-Tenant Exposure deberá formar parte del Threat Model principal.

---

# 316. Relación con ENG-025

Observability deberá permitir identificar:

```text
tenant context mismatch
cross-tenant attempt
quota exhaustion
tenant provisioning failure
migration failure
context leakage
```

---

# 317. Relación con ENG-049

ENG-049 deberá formalizar **Configuration Management Engineering** a nivel operativo y dinámico.

La separación propuesta será:

```text
ENG-011 Configuration Files
→ formato, carga y validación base

ENG-048 Multi-Tenancy
→ Tenant-scoped configuration isolation

ENG-049 Configuration Management
→ lifecycle, sources, precedence,
  dynamic configuration and change control
```

ENG-049 deberá cubrir:

```text
Configuration Source
Configuration Provider
Configuration Key
Configuration Value
Configuration Schema
Configuration Namespace
Configuration Scope
Configuration Precedence
Configuration Resolution
Configuration Snapshot
Configuration Version
Dynamic Configuration
Runtime Configuration
Immutable Configuration
Configuration Reload
Configuration Refresh
Configuration Change
Configuration Validation
Configuration Diff
Configuration Rollback
Configuration Audit
Configuration Secret Reference
Environment Configuration
Module Configuration
Tenant Configuration
Feature Configuration
Configuration Cache
Configuration Distribution
Configuration Consistency
Configuration Drift
Configuration Observability
Configuration Testing
```

---

# 318. Principio Rector

> **En MEF, Tenant deberá ser una Boundary de seguridad y ejecución, no solamente una columna de base de datos. El Tenant Context deberá acompañar la operación desde su entrada hasta Data Access, Cache, Messaging, Jobs, Storage y Observability, y cualquier pérdida o contradicción de ese Context deberá fallar de forma segura.**

---

# 319. Conclusión

**ENG-048 — Multi-Tenancy Engineering** formaliza la Boundary de aislamiento entre Tenants dentro de MEF.

La arquitectura transversal queda:

```text
                    ENTRY POINT
                        │
                        ▼
                TENANT RESOLUTION
                        │
                        ▼
                TENANT VALIDATION
                        │
                        ▼
                  TENANT CONTEXT
                        │
       ┌────────────────┼────────────────┐
       │                │                │
       ▼                ▼                ▼
 Authentication    Authorization     Application
       │                │                │
       └────────────────┼────────────────┘
                        │
          ┌─────────────┼─────────────┐
          │             │             │
          ▼             ▼             ▼
      Data Access      Cache        Messaging
          │             │             │
          ├─────────────┼─────────────┤
          │             │             │
          ▼             ▼             ▼
        Jobs          Storage    Observability
          │             │             │
          └─────────────┼─────────────┘
                        │
                        ▼
                TENANT RESOURCES
```

El modelo de aislamiento queda:

```text
                    PLATFORM
                       │
       ┌───────────────┼───────────────┐
       │               │               │
       ▼               ▼               ▼
    TENANT A         TENANT B        TENANT C
       │               │               │
   ┌───┼───┐       ┌───┼───┐       ┌───┼───┐
   │   │   │       │   │   │       │   │   │
 Data Cache Files  Data Cache Files Data Cache Files
   │   │   │       │   │   │       │   │   │
   └───┼───┘       └───┼───┘       └───┼───┘
       │               │               │
       X───────────────X───────────────X
             NO IMPLICIT CROSSOVER
```

La integración de identidad queda:

```text
ENG-047 IAM
     │
     ▼
Tenant Membership
     │
     ▼
ENG-045 Authentication
     │
     ▼
Principal
     │
     ▼
Tenant Resolution
     │
     ▼
TenantContext
     │
     ▼
ENG-046 Authorization
     │
     ▼
ALLOW / DENY
```

El aislamiento de datos queda:

```text
TenantContext
      │
      ▼
 TenantScope
      │
      ▼
Tenant-Aware Repository
      │
      ▼
Database Strategy
      │
 ┌────┼──────────────┐
 ▼    ▼              ▼
Shared Schema/Tenant Dedicated
 DB       Schema        DB
```

La ejecución asíncrona queda:

```text
Tenant Request
     │
     ▼
Create Message / Job
     │
     ▼
Persist Tenant Metadata
     │
     ▼
Queue
     │
     ▼
Worker
     │
     ▼
Validate Tenant
     │
     ▼
Create TenantContext
     │
     ▼
Execute
     │
     ▼
Clear TenantContext
```

El Lifecycle queda:

```text
PROVISIONING
     │
     ▼
   ACTIVE
     │
     ├──────────────► SUSPENDED
     │                    │
     │                    └──► ACTIVE
     │
     ▼
DEPROVISIONING
     │
     ▼
DEPROVISIONED
```

La primera implementación deberá concentrarse en:

```text
Tenant
TenantId
TenantState

TenantContext
TenantResolution
TenantResolver

TenantManager
TenantContextManager

TenantScope
TenantAwareRepository

TenantDatabaseResolver
TenantStorageResolver
TenantConfigurationProvider

TenantQuota
TenantError
```

con:

```text
Explicit Tenant Context
Trusted Tenant Resolution
Tenant State Validation
Context Propagation
Context Cleanup
Tenant-Aware Authorization
Tenant-Aware Data Access
Shared Database Isolation
Cache Namespace
Session Binding
Messaging Context
Job Context
Storage Namespace
Configuration Isolation
Secret Isolation
Cross-Tenant Deny by Default
Tenant Quotas
Audit
Isolation Testing
```

antes de introducir:

```text
Schema per Tenant
Database per Tenant
Dedicated Infrastructure
Tenant-Specific Encryption Keys
Cross-Region Mobility
Automatic Sharding
Global Tenant Federation
```

Con **ENG-048** la serie global alcanza:

```text
EI-925
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
- ENG-044 — API Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
- ENG-049 — Configuration Management Engineering
```