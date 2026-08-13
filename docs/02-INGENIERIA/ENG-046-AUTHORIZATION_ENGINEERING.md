---
id: ENG-046
titulo: Authorization Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Authorization Engineering
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
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-045
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-017
  - ENG-022
  - ENG-026
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-040
  - ENG-041
  - ENG-047
keywords:
  - authorization
  - access-control
  - permission
  - capability
  - role
  - rbac
  - abac
  - policy
  - policy-engine
  - policy-decision-point
  - policy-enforcement-point
  - resource
  - action
  - subject
  - actor
  - tenant
  - ownership
  - least-privilege
  - deny-by-default
  - explicit-deny
  - delegation
  - impersonation
  - separation-of-duties
  - row-level-security
  - field-level-security
  - mef
---

# ENG-046

# Authorization Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Authorization Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-046 establece las reglas para:

```text
Authorization
Authorization Context
Authorization Request
Authorization Decision
Subject
Actor
Principal
Resource
Resource Type
Resource Identifier
Action
Permission
Capability
Role
Role Assignment
RBAC
ABAC
Attribute
Policy
Policy Rule
Policy Set
Policy Evaluation
Policy Decision Point
Policy Enforcement Point
Policy Information Point
Policy Administration Point
Deny by Default
Explicit Deny
Least Privilege
Resource Ownership
Tenant Authorization
Field-Level Authorization
Row-Level Authorization
Administrative Authorization
Delegation
Impersonation Authorization
Separation of Duties
Permission Hierarchy
Role Hierarchy
Policy Composition
Authorization Cache
Authorization Audit
Authorization Events
Authorization Observability
Authorization Testing
```

---

# 2. Declaración

La regla fundamental será:

> **MEF deberá autorizar cada operación protegida mediante una decisión explícita, contextual y verificable, aplicando Deny by Default y Least Privilege, sin confundir identidad autenticada, Role, Permission, Ownership o Tenant Membership con autorización automática.**

Arquitectura conceptual:

```text
Authenticated Principal
         │
         ▼
Authorization Request
         │
         ├── Subject
         ├── Actor
         ├── Action
         ├── Resource
         ├── Tenant
         ├── Attributes
         └── Context
         │
         ▼
 Policy Decision Point
         │
         ├── RBAC
         ├── ABAC
         ├── Ownership
         ├── Tenant Policy
         ├── Explicit Deny
         └── Security Policy
         │
         ▼
Authorization Decision
         │
      ┌──┴──┐
      │     │
    ALLOW  DENY
      │     │
      ▼     ▼
 Execute  Reject
```

---

# 3. Authorization

`Authorization` responde:

```text
May this Principal perform this Action
on this Resource
under this Context?
```

---

# 4. Authorization ≠ Authentication

La separación será:

```text
Authentication
→ establishes identity

Authorization
→ establishes permission
```

---

# 5. Authentication Success

No deberá implicar:

```text
ALLOW
```

---

# 6. Authorization Required

Toda operación protegida deberá alcanzar una decisión explícita antes de ejecutar efectos sensibles.

---

# 7. Authorization Request

Una `AuthorizationRequest` representa la pregunta de autorización.

Conceptualmente:

```text
AuthorizationRequest
├── subject
├── actor
├── action
├── resource
├── tenant
├── attributes
└── context
```

---

# 8. Subject

`Subject` representa la identidad efectiva sobre la cual se evalúan permisos.

---

# 9. Actor

`Actor` representa quien está ejecutando materialmente la operación.

---

# 10. Subject ≠ Actor

Normalmente:

```text
Actor == Subject
```

pero pueden diferir en:

```text
delegation
impersonation
service acting on behalf of user
background processing
```

---

# 11. Actor Preservation

Cuando Actor y Subject sean diferentes deberán conservarse ambos.

---

# 12. Principal

ENG-045 proporcionará el Principal autenticado.

---

# 13. Principal ≠ Authorization Decision

El Principal es Input de Authorization, no resultado de Authorization.

---

# 14. Resource

Un `Resource` representa el objeto protegido.

---

# 15. Resource Examples

```text
Order
Invoice
Customer
Document
Tenant
User
Credential
Configuration
Report
```

---

# 16. Resource Type

Todo Resource protegido deberá poseer Type estable.

Ejemplo:

```text
order
invoice
customer
user
```

---

# 17. Resource Identifier

Podrá utilizarse cuando Authorization dependa de instancia específica.

---

# 18. Resource ≠ Database Row

El Resource de autorización deberá representar concepto de seguridad, no necesariamente almacenamiento físico.

---

# 19. Action

Una `Action` representa la operación solicitada.

Ejemplos:

```text
create
read
update
delete
approve
publish
cancel
export
impersonate
manage_credentials
```

---

# 20. Action Naming

Deberá utilizar nombres semánticos estables.

---

# 21. CRUD Only

No deberá limitarse Authorization únicamente a:

```text
create
read
update
delete
```

cuando el negocio posea acciones más precisas.

---

# 22. Permission

Una `Permission` representa autorización abstracta para realizar una Action sobre un Resource Type o Scope.

---

# 23. Permission Naming

Podrá utilizar:

```text
resource.action
```

Ejemplos:

```text
orders.read
orders.create
orders.cancel
users.manage_credentials
reports.export
```

---

# 24. Stable Permission ID

Todo Permission público/interno persistido deberá poseer identificador estable.

---

# 25. Permission ≠ UI Element

Ocultar un botón no constituye autorización.

---

# 26. Permission ≠ Endpoint

Una Permission podrá proteger múltiples Endpoints y otros Entry Points.

---

# 27. Capability

Una `Capability` representa autoridad concreta o delegable para ejecutar una operación.

---

# 28. Capability Use

Podrá modelar:

```text
temporary authority
delegated authority
resource-specific authority
machine authority
```

---

# 29. Capability ≠ Role

Una Capability podrá existir independientemente de Roles.

---

# 30. Role

Un `Role` agrupa Permissions bajo una responsabilidad reconocible.

---

# 31. Role Example

```text
Administrator
BillingManager
Auditor
SupportAgent
OrderApprover
```

---

# 32. Role ≠ Permission

Un Role no deberá consultarse directamente en Business Code cuando una Permission semántica pueda expresar la intención.

Evitar:

```text
if role == ADMIN
```

Favorecer:

```text
authorize("users.manage")
```

---

# 33. Role Assignment

Relaciona:

```text
Subject
Role
Scope
Validity
```

---

# 34. Scoped Role

Un Role podrá estar limitado a:

```text
tenant
organization
project
resource group
```

---

# 35. Global Role

Deberá utilizarse únicamente cuando el Scope realmente sea global.

---

# 36. Role Lifetime

Podrá poseer:

```text
validFrom
validUntil
```

---

# 37. Expired Assignment

No deberá conceder Permissions.

---

# 38. RBAC

`Role-Based Access Control` utilizará Roles para agrupar Permissions.

---

# 39. RBAC Flow

```text
Principal
   │
   ▼
Role Assignments
   │
   ▼
Roles
   │
   ▼
Permissions
   │
   ▼
Decision
```

---

# 40. RBAC Benefit

Simplifica administración cuando responsabilidades son relativamente estables.

---

# 41. RBAC Limitation

No deberá utilizarse para modelar toda condición contextual mediante explosión de Roles.

---

# 42. Role Explosion

Ejemplo problemático:

```text
ManagerMexico
ManagerMexicoNorth
ManagerMexicoNorthProjectA
ManagerMexicoNorthProjectAReadOnly
```

---

# 43. ABAC

`Attribute-Based Access Control` evalúa Attributes.

---

# 44. Attribute Sources

Podrán incluir:

```text
subject
resource
tenant
environment
request
time
authentication assurance
```

---

# 45. ABAC Example

```text
ALLOW invoice.approve

IF
subject.department == "finance"
AND
resource.amount <= subject.approvalLimit
AND
resource.tenantId == subject.tenantId
```

---

# 46. Attribute Trust

Todo Attribute utilizado para autorización deberá provenir de fuente confiable.

---

# 47. Client-Supplied Attribute

No deberá confiarse directamente.

---

# 48. Attribute Normalization

Deberá existir semántica consistente.

---

# 49. Missing Attribute

Deberá producir comportamiento seguro.

---

# 50. Default Missing Attribute

Deberá favorecer:

```text
DENY
```

---

# 51. RBAC + ABAC

MEF podrá combinar ambos.

---

# 52. Hybrid Authorization

Ejemplo:

```text
Role grants candidate permission
        │
        ▼
ABAC evaluates context
        │
        ▼
Ownership/Tenant checks
        │
        ▼
Decision
```

---

# 53. Policy

Una `Policy` define reglas de autorización.

---

# 54. Policy ID

Toda Policy deberá poseer identificador estable.

---

# 55. Policy Version

Policies persistidas o distribuidas deberán poder versionarse.

---

# 56. Policy Rule

Conceptualmente:

```text
PolicyRule
├── id
├── effect
├── action
├── resource
├── condition
└── metadata
```

---

# 57. Policy Effect

Inicialmente:

```text
ALLOW
DENY
```

---

# 58. Deny by Default

En ausencia de una autorización válida:

```text
DENY
```

---

# 59. Implicit Allow

No deberá existir.

---

# 60. Explicit Deny

Una Policy podrá declarar Deny explícito.

---

# 61. Explicit Deny Precedence

Deberá definirse una estrategia determinística.

La primera implementación deberá favorecer:

```text
EXPLICIT DENY
>
ALLOW
>
DEFAULT DENY
```

---

# 62. Policy Composition

Cuando múltiples Policies aplican, el algoritmo de combinación deberá ser explícito.

---

# 63. Policy Conflict

No deberá resolverse mediante orden accidental de registro.

---

# 64. Policy Set

Agrupa Policies relacionadas.

---

# 65. Policy Scope

Podrá ser:

```text
global
tenant
module
resource
operation
```

---

# 66. Policy Inheritance

No deberá introducir autoridad accidental.

---

# 67. Policy Evaluation

Deberá ser determinística para los mismos Inputs confiables.

---

# 68. Authorization Decision

Conceptualmente:

```text
AuthorizationDecision
├── effect
├── reasonCode
├── policyIds
├── obligations
└── metadata
```

---

# 69. Decision Effect

Inicialmente:

```text
ALLOW
DENY
```

---

# 70. Indeterminate

Internamente podrá existir:

```text
INDETERMINATE
```

---

# 71. Indeterminate External Semantics

Deberá convertirse a:

```text
DENY
```

para ejecución protegida.

---

# 72. Reason Code

Deberá ser machine-readable.

---

# 73. Public Reason

No deberá revelar información sensible sobre Policies internas.

---

# 74. Obligations

Una decisión podrá producir requisitos adicionales.

Ejemplos:

```text
mask_fields
require_audit
limit_rows
require_step_up
```

---

# 75. Obligation Enforcement

Un `ALLOW` con Obligations no deberá ejecutarse ignorándolas.

---

# 76. Advice

Podrá existir Metadata no obligatoria, separada de Obligations.

---

# 77. Policy Decision Point

`PDP` evalúa Policies y produce Authorization Decision.

---

# 78. PDP Contract

Conceptualmente:

```text
authorize(AuthorizationRequest)
    → AuthorizationDecision
```

---

# 79. Policy Enforcement Point

`PEP` intercepta la operación y aplica la decisión.

---

# 80. PEP Responsibilities

```text
build authorization request
invoke PDP
enforce decision
enforce obligations
reject unauthorized operation
```

---

# 81. PEP ≠ PDP

```text
PEP
→ enforcement

PDP
→ decision
```

---

# 82. Policy Information Point

`PIP` proporciona Attributes confiables necesarios para evaluación.

---

# 83. PIP Examples

```text
tenant membership
resource ownership
department
resource classification
approval limit
```

---

# 84. PIP Failure

Deberá favorecer:

```text
DENY
```

cuando un Attribute requerido no pueda obtenerse.

---

# 85. Policy Administration Point

`PAP` administra Policies.

---

# 86. PAP Security

Modificar Policies deberá considerarse operación altamente privilegiada.

---

# 87. Policy Change Audit

Será obligatorio.

---

# 88. Policy Activation

Cambios críticos deberán poder pasar por:

```text
draft
validation
activation
retirement
```

---

# 89. Policy Runtime

No deberá ejecutar código arbitrario no confiable.

---

# 90. Policy Language

Si se introduce DSL deberá ser:

```text
bounded
deterministic
validated
sandboxed where necessary
```

---

# 91. Least Privilege

Toda Identity deberá recibir únicamente autoridad necesaria.

---

# 92. Broad Permission

Deberá evitarse.

Ejemplo:

```text
*
```

---

# 93. Wildcard Permission

Solo deberá permitirse bajo Policy explícita.

---

# 94. Administrator

No deberá convertirse automáticamente en bypass absoluto de Security Controls.

---

# 95. Superuser

Si existe deberá ser explícito, excepcional y auditable.

---

# 96. Break Glass

Podrá existir para emergencias.

---

# 97. Break Glass Requirements

Deberá requerir:

```text
strong authentication
explicit reason
short lifetime
audit
alerting
```

---

# 98. Break Glass ≠ Permanent Admin

No deberá utilizarse como operación cotidiana.

---

# 99. Resource Ownership

Ownership podrá ser una condición de autorización.

---

# 100. Ownership ≠ Authentication

Ser propietario deberá verificarse.

---

# 101. Ownership Source

Deberá provenir de fuente confiable.

---

# 102. Owner ID from Request

No deberá confiarse directamente.

---

# 103. Ownership Transfer

Deberá ser operación autorizada independiente.

---

# 104. Ownership Authorization

Ejemplo:

```text
ALLOW document.update

IF
resource.ownerId == subject.id
```

---

# 105. Tenant Authorization

Toda operación Tenant-Aware deberá preservar Tenant Isolation.

---

# 106. Tenant Membership

No deberá implicar acceso irrestricto a todos los Resources del Tenant.

---

# 107. Tenant Context

Deberá provenir de Context autenticado/autorizado.

---

# 108. Tenant ID from Header

No deberá constituir prueba de Membership.

---

# 109. Cross-Tenant Access

Deberá requerir Permission explícita.

---

# 110. Cross-Tenant Admin

Deberá ser altamente restringido y auditable.

---

# 111. Tenant Escape

Será una violación crítica.

---

# 112. Tenant Filter

No deberá depender únicamente de que el Developer recuerde agregar:

```text
WHERE tenant_id = ?
```

---

# 113. Defense in Depth

Podrá utilizarse:

```text
authorization policy
repository scope
database row-level security
tenant-aware cache
```

---

# 114. Row-Level Authorization

Controla qué registros puede observar/modificar un Subject.

---

# 115. Row-Level Filter

Podrá traducirse a Query Constraint seguro.

---

# 116. Post-Query Filtering

No deberá ser estrategia primaria para grandes conjuntos o datos sensibles.

---

# 117. Query-Time Authorization

Deberá favorecerse cuando sea posible.

---

# 118. Row-Level Security

Database RLS podrá utilizarse como defensa adicional.

---

# 119. Database RLS ≠ Complete Authorization

No sustituye Application-Level Business Authorization.

---

# 120. Field-Level Authorization

Controla acceso a propiedades específicas.

---

# 121. Field Read Authorization

Ejemplo:

```text
salary
personal_email
security_metadata
```

---

# 122. Field Write Authorization

Deberá evaluarse independientemente de Read cuando corresponda.

---

# 123. Response Serialization

ENG-031/ENG-044 deberán respetar Field-Level Authorization.

---

# 124. Mass Assignment

No deberá permitir modificar Fields no autorizados.

---

# 125. Hidden Field

Que un Field no aparezca en UI no significa que esté protegido.

---

# 126. Administrative Authorization

Operaciones administrativas deberán poseer Permissions específicas.

---

# 127. Admin Endpoint

No deberá depender únicamente de:

```text
/admin/*
```

---

# 128. Administrative Permission

Ejemplos:

```text
users.disable
users.reset_mfa
roles.assign
policies.modify
credentials.revoke
```

---

# 129. Sensitive Administrative Action

Podrá requerir:

```text
fresh authentication
MFA
approval
audit
```

---

# 130. Reauthentication Integration

ENG-045 podrá producir mayor Assurance antes de Authorization final.

---

# 131. Step-Up Obligation

Authorization podrá responder conceptualmente:

```text
ALLOW only after stronger authentication
```

---

# 132. Step-Up Flow

```text
Authorization Request
       │
       ▼
Current Assurance insufficient
       │
       ▼
Require Step-Up
       │
       ▼
ENG-045 Authentication
       │
       ▼
New Assurance
       │
       ▼
Re-evaluate Authorization
```

---

# 133. Separation of Duties

`SoD` evita concentrar funciones incompatibles.

---

# 134. Static SoD

Evita asignar Roles incompatibles.

Ejemplo:

```text
PaymentCreator
PaymentApprover
```

---

# 135. Dynamic SoD

Evita ejecutar acciones incompatibles dentro de una operación concreta.

Ejemplo:

```text
creator cannot approve same payment
```

---

# 136. Self-Approval

Deberá impedirse cuando Business Policy lo requiera.

---

# 137. Four-Eyes Principle

Podrá requerirse aprobación de segundo Actor.

---

# 138. Authorization ≠ Workflow

Authorization decide autoridad.

Workflow coordina pasos.

---

# 139. Approval State

Podrá formar parte del Resource Context.

---

# 140. Delegation

Una Identity podrá delegar autoridad limitada.

---

# 141. Delegation Scope

Deberá incluir:

```text
delegator
delegate
permissions/capabilities
resource scope
validity
```

---

# 142. Delegation Maximum Authority

Nadie deberá delegar autoridad que no posee, salvo mecanismo administrativo explícito.

---

# 143. Delegation Lifetime

Deberá ser limitado cuando sea posible.

---

# 144. Delegation Revocation

Deberá soportarse.

---

# 145. Delegation Chain

Deberá limitarse para evitar complejidad y privilege amplification.

---

# 146. Delegation Audit

Deberá conservar:

```text
delegator
delegate
scope
createdAt
expiresAt
```

---

# 147. Impersonation Authorization

ENG-045 establece Actor/Subject.

ENG-046 decide si la Impersonation está permitida.

---

# 148. Impersonation Permission

Deberá ser explícita.

Ejemplo:

```text
users.impersonate
```

---

# 149. Impersonation Scope

Deberá limitar:

```text
target identities
operations
duration
tenant
```

---

# 150. Impersonation Restrictions

Podrá impedir:

```text
credential changes
MFA reset
role escalation
policy changes
```

---

# 151. Impersonation Audit

Será obligatorio.

---

# 152. Impersonation Banner

La presentación deberá indicar claramente el estado cuando exista UI interactiva.

---

# 153. Role Hierarchy

Podrá permitir herencia de Permissions.

---

# 154. Role Hierarchy Direction

Deberá ser inequívoca.

---

# 155. Cyclic Role Hierarchy

Deberá rechazarse.

---

# 156. Deep Role Hierarchy

Deberá limitarse.

---

# 157. Permission Hierarchy

Podrá existir cuando semánticamente sea segura.

---

# 158. Permission Implication

Ejemplo:

```text
orders.manage
    ├── orders.read
    ├── orders.update
    └── orders.cancel
```

---

# 159. Implication Explicitness

No deberá inferirse únicamente por nombres.

---

# 160. Permission Wildcards

Deberán expandirse de forma determinística.

---

# 161. Permission Namespace

Deberá evitar colisiones entre Modules.

---

# 162. Module Permission

Podrá utilizar:

```text
module.resource.action
```

si se requiere.

---

# 163. Registry Integration

ENG-020 podrá registrar:

```text
PermissionDefinition
RoleDefinition
PolicyDefinition
ResourceTypeDefinition
ActionDefinition
```

---

# 164. Duplicate Permission

Deberá detectarse durante Bootstrap.

---

# 165. Conflicting Permission Definition

También.

---

# 166. Unknown Permission

No deberá convertirse en Allow.

---

# 167. Removed Permission

Deberá migrarse de Assignments persistidos.

---

# 168. Permission Lifecycle

Podrá incluir:

```text
ACTIVE
DEPRECATED
REMOVED
```

---

# 169. Policy Versioning

Cambios de Policy deberán poder correlacionarse con decisiones.

---

# 170. Decision Policy Version

Podrá incluirse en Audit interno.

---

# 171. Authorization Cache

Podrá utilizarse para reducir costo de evaluación.

---

# 172. Cache Key

Deberá considerar todos los Inputs que afectan la decisión.

Conceptualmente:

```text
subject
actor
action
resource
tenant
relevant attributes
policy version
```

---

# 173. Incomplete Cache Key

Podrá producir Privilege Escalation.

---

# 174. Cache Lifetime

Deberá ser acotado.

---

# 175. Revocation

Cambios de:

```text
role
permission
policy
membership
delegation
```

deberán invalidar o acotar Cache.

---

# 176. Authorization Cache Fail Open

No deberá ocurrir.

---

# 177. Stale Allow

Es más peligroso que Stale Deny.

---

# 178. Negative Cache

Podrá utilizarse con TTL apropiado.

---

# 179. Distributed Authorization Cache

Deberá considerar consistencia.

---

# 180. Policy Change Propagation

Deberá existir estrategia explícita.

---

# 181. Authorization in Application

Application deberá solicitar autorización antes de efectos protegidos.

---

# 182. Controller-Only Authorization

No deberá ser única defensa.

---

# 183. Multiple Entry Points

La misma Use Case podrá invocarse desde:

```text
HTTP
CLI
Job
Message
Internal API
```

---

# 184. Application-Level Enforcement

Deberá proteger Use Cases independientemente del Entry Point.

---

# 185. API Enforcement

ENG-044 podrá actuar como PEP adicional.

---

# 186. Defense in Depth

Podrán existir múltiples PEP coherentes.

---

# 187. Duplicate Decision

Deberá evitarse cuando solo agregue costo sin seguridad.

---

# 188. Domain Authorization

Domain podrá imponer Business Invariants, pero no deberá depender del Framework Authorization Engine.

---

# 189. Business Invariant ≠ Permission

Ejemplo:

```text
Invoice cannot be approved after cancellation
```

es Domain Invariant.

---

# 190. Permission Example

```text
Principal may approve invoices
```

es Authorization.

---

# 191. Data Access Integration

ENG-043 deberá permitir Query Constraints derivados de Authorization.

---

# 192. Repository Authorization

Repository no deberá decidir Roles arbitrariamente.

---

# 193. Authorized Query Specification

Podrá recibir Constraint explícito producido por Authorization Layer.

---

# 194. Query Bypass

Deberá impedirse en Paths sensibles.

---

# 195. Bulk Authorization

Operaciones masivas deberán definir semántica.

---

# 196. Bulk Strategies

Podrán ser:

```text
all-or-nothing
filter-unauthorized
per-item-result
```

---

# 197. Silent Partial Authorization

No deberá ocurrir sin Contract explícito.

---

# 198. Search Authorization

Search deberá aplicar Row-Level Authorization antes de retornar resultados.

---

# 199. Count Authorization

Counts también deberán respetar Visibility.

---

# 200. Aggregate Leakage

Aggregations no deberán revelar datos no autorizados.

---

# 201. Existence Leakage

Authorization deberá considerar si revelar existencia de Resource.

---

# 202. 403 vs 404

ENG-044 podrá mapear DENY a:

```text
403
404
```

según Anti-Enumeration Policy.

---

# 203. Error Detail

No deberá revelar:

```text
missing role
internal policy
resource owner
tenant membership
```

cuando sea sensible.

---

# 204. Authorization Error

ENG-023 gobernará Error Translation.

---

# 205. Error Namespace

ENG-046 utilizará:

```text
MEF-AUTHZ-xxx
```

---

# 206. Taxonomía ENG-046

```text
MEF-AUTHZ-001 Authorization required
MEF-AUTHZ-002 Access denied
MEF-AUTHZ-003 Permission missing
MEF-AUTHZ-004 Role assignment invalid
MEF-AUTHZ-005 Role assignment expired
MEF-AUTHZ-006 Policy not found
MEF-AUTHZ-007 Policy invalid
MEF-AUTHZ-008 Policy evaluation failed
MEF-AUTHZ-009 Explicit deny
MEF-AUTHZ-010 Resource access denied
MEF-AUTHZ-011 Resource ownership required
MEF-AUTHZ-012 Tenant access denied
MEF-AUTHZ-013 Cross-tenant access denied
MEF-AUTHZ-014 Field read denied
MEF-AUTHZ-015 Field write denied
MEF-AUTHZ-016 Row access denied
MEF-AUTHZ-017 Delegation invalid
MEF-AUTHZ-018 Delegation expired
MEF-AUTHZ-019 Delegation revoked
MEF-AUTHZ-020 Impersonation denied
MEF-AUTHZ-021 Separation of duties violation
MEF-AUTHZ-022 Self-approval denied
MEF-AUTHZ-023 Authentication assurance insufficient
MEF-AUTHZ-024 Authorization context incomplete
MEF-AUTHZ-025 Authorization cache invalid
MEF-AUTHZ-026 Policy conflict
MEF-AUTHZ-027 Permission hierarchy invalid
MEF-AUTHZ-028 Role hierarchy invalid
MEF-AUTHZ-029 Authorization security violation
MEF-AUTHZ-030 Authorization invariant violation
```

---

# 207. Access Denied Example

```text
MEF-AUTHZ-002

Access denied.

Action:
orders.cancel

Resource:
order
```

---

# 208. Tenant Example

```text
MEF-AUTHZ-013

Cross-tenant access denied.
```

---

# 209. Field Authorization Example

```text
MEF-AUTHZ-015

Write access denied for protected field.
```

---

# 210. Separation of Duties Example

```text
MEF-AUTHZ-021

Operation violates separation-of-duties policy.

Policy:
payment-approval
```

---

# 211. Assurance Example

```text
MEF-AUTHZ-023

Current authentication assurance
is insufficient for this operation.

Required:
MFA
```

---

# 212. Policy Evaluation Failure

Una falla interna del Policy Engine no deberá convertirse en Allow.

---

# 213. Fail Closed

El comportamiento Default será:

```text
cannot decide
→ DENY
```

---

# 214. External Policy Engine

Podrá utilizarse.

---

# 215. External PDP Failure

Deberá producir Deny/Service Failure según Contract, nunca Allow implícito.

---

# 216. External PDP Timeout

Deberá ser acotado.

---

# 217. External PDP Retry

Deberá respetar ENG-039.

---

# 218. Local Fallback

No deberá conceder autoridad adicional.

---

# 219. Authorization Availability

Deberá diseñarse como componente crítico.

---

# 220. Policy Distribution

Deberá ser autenticada e íntegra.

---

# 221. Policy Tampering

Será violación crítica.

---

# 222. Policy Signature

Podrá utilizarse cuando Policies se distribuyan fuera del mismo Trust Boundary.

---

# 223. Authorization Event

Eventos relevantes podrán incluir:

```text
authorization.allowed
authorization.denied
role.assigned
role.revoked
permission.changed
policy.activated
policy.retired
delegation.created
delegation.revoked
impersonation.started
impersonation.ended
break_glass.activated
```

---

# 224. Authorization Event Secret

No deberá contener Credentials.

---

# 225. Authorization Audit

Decisiones sensibles deberán ser auditables.

---

# 226. Audit Context

Podrá contener:

```text
actor
subject
action
resourceType
resourceId
tenant
decision
reasonCode
policyVersion
timestamp
requestId
traceId
```

---

# 227. Audit Privacy

No deberá capturar más información que la necesaria.

---

# 228. Audit Integrity

Deberá protegerse contra alteración.

---

# 229. Audit Authorization

Acceder a Audit Records deberá estar autorizado.

---

# 230. Observability

ENG-025 gobernará Telemetry.

---

# 231. Authorization Metrics

Podrán incluir:

```text
mef.authz.decisions.total
mef.authz.denied.total
mef.authz.evaluation.duration
mef.authz.cache.hit
mef.authz.cache.miss
mef.authz.policy.error
```

---

# 232. Metric Dimensions

Podrán incluir:

```text
action
resourceType
decision
policySet
```

con Cardinality acotada.

---

# 233. Subject Metric Label

No deberá utilizarse.

---

# 234. Resource ID Metric Label

No deberá utilizarse.

---

# 235. Tenant ID Metric Label

No deberá utilizarse indiscriminadamente.

---

# 236. Authorization Log

Podrá registrar:

```text
requestId
traceId
action
resourceType
decision
reasonCode
```

---

# 237. Sensitive Policy Detail

No deberá exponerse en Logs de bajo Trust Level.

---

# 238. Denial Monitoring

Incrementos anómalos de Deny podrán indicar:

```text
attack
misconfiguration
broken client
policy regression
```

---

# 239. Privilege Escalation Detection

Podrá observar:

```text
role changes
policy changes
delegation
break-glass
impersonation
```

---

# 240. Security Alert

Podrá generarse ante operaciones críticas.

---

# 241. Testing

ENG-009 gobernará Testing.

---

# 242. Default Deny Test

Será obligatorio.

---

# 243. Permission Test

Deberá comprobar:

```text
granted
missing
revoked
deprecated
```

---

# 244. Role Test

Deberá comprobar:

```text
assignment
scope
expiration
hierarchy
revocation
```

---

# 245. ABAC Test

Deberá comprobar combinaciones de Attributes.

---

# 246. Missing Attribute Test

Deberá producir Deny cuando sea requerido.

---

# 247. Explicit Deny Test

Deberá prevalecer según Policy.

---

# 248. Policy Conflict Test

Deberá ser determinístico.

---

# 249. Ownership Test

Deberá comprobar:

```text
owner
non-owner
transferred ownership
missing ownership
```

---

# 250. Tenant Isolation Test

Será obligatorio.

---

# 251. Cross-Tenant Test

Deberá intentar acceso explícito a Resource de otro Tenant.

---

# 252. Field-Level Test

Deberá comprobar Read y Write por separado.

---

# 253. Row-Level Test

Deberá comprobar Query Visibility.

---

# 254. Search Leakage Test

Search no deberá retornar Resources no autorizados.

---

# 255. Count Leakage Test

Counts no deberán revelar información prohibida.

---

# 256. Aggregate Leakage Test

También deberá probarse.

---

# 257. Delegation Test

Deberá cubrir:

```text
valid
expired
revoked
over-delegation
```

---

# 258. Impersonation Test

Deberá cubrir:

```text
authorized actor
unauthorized actor
restricted target
restricted action
audit context
```

---

# 259. Separation of Duties Test

Será obligatorio donde exista SoD.

---

# 260. Self-Approval Test

Deberá comprobar rechazo.

---

# 261. Step-Up Test

Deberá comprobar Assurance insuficiente y reevaluación posterior.

---

# 262. Cache Test

Deberá comprobar:

```text
cache hit
cache miss
role revocation
policy change
membership change
delegation revocation
```

---

# 263. Stale Allow Test

Será obligatorio si existe Authorization Cache.

---

# 264. Policy Engine Failure Test

Deberá comprobar Fail Closed.

---

# 265. Multiple Entry Point Test

La misma Use Case deberá permanecer protegida desde:

```text
HTTP
CLI
Job
Message
```

cuando aplique.

---

# 266. Bypass Test

Deberá buscar Paths que eviten PEP.

---

# 267. Privilege Escalation Test

Deberá intentar:

```text
assign own role
modify own permissions
change policy
cross tenant
impersonate admin
modify protected fields
```

---

# 268. Architecture Test

Podrá impedir:

```text
Controller → role string comparison
Domain → AuthorizationManager
Repository → arbitrary role decision
UI-only authorization
AuthenticationProvider → permission grant
```

---

# 269. Property-Based Testing

Podrá comprobar invariantes como:

```text
adding restrictions never increases authority
revoking permission never increases authority
expired delegation never grants authority
cross-tenant default never allows access
```

---

# 270. Mutation Testing

Será especialmente útil para detectar Policies cuya inversión no rompe Tests.

---

# 271. Build Integration

ENG-012 podrá validar:

```text
duplicate permission
duplicate role
invalid hierarchy
cyclic hierarchy
unknown permission
invalid policy
unprotected endpoint
unsafe wildcard
missing authorization metadata
```

---

# 272. Static Analysis

Podrá detectar Endpoints sensibles sin PEP declarado.

---

# 273. CLI

ENG-007 podrá proporcionar:

```text
mef authz:permissions
mef authz:roles
mef authz:policies
mef authz:check
mef authz:explain
mef authz:assignments
mef authz:delegations
mef authz:diagnose
```

---

# 274. `authz:check`

Ejemplo conceptual:

```text
mef authz:check \
  --subject=user:123 \
  --action=orders.cancel \
  --resource=order:456
```

---

# 275. `authz:explain`

Deberá estar restringido porque puede revelar estructura sensible de Policies.

---

# 276. CLI Mutation

Asignaciones y cambios de Policy deberán requerir autorización apropiada.

---

# 277. Configuration

ENG-011 podrá definir:

```text
authorization:
  default-effect: deny

  policy:
    explicit-deny-precedence: true

  roles:
    hierarchy-enabled: true

  permissions:
    wildcard-enabled: false

  cache:
    enabled: true
    ttl: 30s

  tenant:
    isolation-required: true

  audit:
    sensitive-decisions: true
```

---

# 278. Configuration Validation

Deberá comprobar:

```text
default-effect == deny
valid policy composition
valid role hierarchy
valid permission hierarchy
safe wildcard policy
bounded cache TTL
tenant isolation
audit requirements
```

---

# 279. Registry

ENG-020 podrá mantener:

```text
AuthorizationRegistry
├── permissions
├── roles
├── policies
├── resourceTypes
└── actions
```

---

# 280. Permission Definition

Conceptualmente:

```text
PermissionDefinition
├── id
├── resourceType
├── actions
├── scope
├── status
└── metadata
```

---

# 281. Role Definition

Conceptualmente:

```text
RoleDefinition
├── id
├── permissions
├── parents
├── scope
└── metadata
```

---

# 282. Policy Definition

Conceptualmente:

```text
PolicyDefinition
├── id
├── version
├── effect
├── target
├── condition
├── obligations
└── metadata
```

---

# 283. Role Assignment Definition

Conceptualmente:

```text
RoleAssignment
├── subject
├── role
├── scope
├── validFrom
└── validUntil
```

---

# 284. Delegation Definition

Conceptualmente:

```text
Delegation
├── delegator
├── delegate
├── capabilities
├── scope
├── validFrom
├── validUntil
└── status
```

---

# 285. Authorization Context

Conceptualmente:

```text
AuthorizationContext
├── principal
├── actor
├── subject
├── tenant
├── authenticationAssurance
├── requestContext
└── environment
```

---

# 286. Authorization Manager

Deberá coordinar:

```text
context
policy retrieval
attribute retrieval
decision
obligations
audit
```

---

# 287. Authorization Manager ≠ Authentication Manager

Deberán permanecer separados.

---

# 288. Bootstrap

ENG-027 deberá construir Authorization Runtime.

---

# 289. Bootstrap Flow

```text
Load Configuration
       │
       ▼
Discover Permissions
       │
       ▼
Discover Roles
       │
       ▼
Discover Policies
       │
       ▼
Validate Hierarchies
       │
       ▼
Validate Policy References
       │
       ▼
Validate Default Deny
       │
       ▼
Build Authorization Registry
       │
       ▼
Build PDP
       │
       ▼
Build PEP Integration
       │
       ▼
Validate Protected Entry Points
       │
       ▼
Readiness
```

---

# 290. Bootstrap Failure

Deberá impedir Readiness ante:

```text
default allow
cyclic role hierarchy
invalid permission
unknown policy reference
policy syntax error
conflicting permission definition
unsafe wildcard configuration
missing required PEP
```

---

# 291. Module Integration

Cada Module podrá declarar:

```text
permissions
roles
policies
resource types
authorization requirements
```

---

# 292. Module Permission Namespace

Deberá evitar colisiones.

---

# 293. Cross-Module Permission

Deberá utilizar Contract público.

---

# 294. Module Private Permission

Podrá existir para operaciones internas.

---

# 295. Private ≠ Unprotected

Una operación interna sensible también deberá protegerse.

---

# 296. Module Policy Override

No deberá ocurrir silenciosamente.

---

# 297. Policy Extension

Deberá utilizar mecanismo explícito.

---

# 298. Application Integration

ENG-034 deberá proporcionar Enforcement cercano al Use Case.

Ejemplo:

```text
Application Command
      │
      ▼
Authorization PEP
      │
      ▼
Authorization Manager
      │
      ▼
ALLOW?
  │       │
 yes      no
  │       │
  ▼       ▼
Use Case  Reject
```

---

# 299. API Integration

ENG-044 podrá declarar Authorization Requirement por Endpoint.

---

# 300. Endpoint Metadata

Ejemplo conceptual:

```text
Endpoint:
orders.cancel

Authorization:
  permission: orders.cancel
  resource: order
```

---

# 301. Authentication Integration

ENG-045 deberá proporcionar:

```text
Principal
Actor
Authentication Method
Authentication Time
Authentication Assurance
```

---

# 302. Domain Integration

ENG-035 deberá mantener Business Invariants independientes del Authorization Framework.

---

# 303. Validation Integration

ENG-036 validará estructura de Input.

Authorization validará autoridad.

---

# 304. Data Access Integration

ENG-043 deberá permitir aplicar:

```text
tenant scope
ownership scope
row-level constraints
authorized projections
```

---

# 305. Transaction Integration

ENG-042 deberá proteger operaciones como:

```text
role assignment
permission change
delegation
policy activation
ownership transfer
```

cuando requieran atomicidad.

---

# 306. Cache Integration

ENG-037 podrá almacenar Decisions bajo Cache Key completa y TTL seguro.

---

# 307. Concurrency Integration

ENG-038 deberá proteger cambios concurrentes de:

```text
roles
permissions
delegations
policies
ownership
```

---

# 308. Resilience Integration

ENG-039 deberá gobernar PDP remoto sin permitir Fail Open.

---

# 309. Messaging Integration

ENG-041 podrá distribuir:

```text
role changed
policy changed
delegation revoked
membership changed
```

para invalidación/observabilidad.

---

# 310. Scheduling Integration

ENG-040 podrá ejecutar:

```text
expired assignment cleanup
expired delegation cleanup
policy activation
permission consistency checks
```

---

# 311. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
AuthorizationRequest
AuthorizationContext
AuthorizationDecision
AuthorizationEffect

Subject
Actor

Resource
ResourceType
ResourceId
Action

Permission
PermissionId
PermissionDefinition

Role
RoleId
RoleDefinition
RoleAssignment

Policy
PolicyId
PolicyDefinition
PolicyRule

AuthorizationManager
PolicyDecisionPoint
PolicyEnforcementPoint
PolicyInformationPoint

AuthorizationRegistry

AuthorizationError
```

---

# 312. Optional Initial Components

Podrán incorporarse:

```text
Attribute
AttributeSet
PolicySet
Obligation
ResourceOwnership
TenantScope
PermissionHierarchy
RoleHierarchy
AuthorizationCache
```

---

# 313. Later Components

Solo cuando exista necesidad demostrada:

```text
Policy DSL
External PDP
Distributed Policy Store
Capability Tokens
Advanced Delegation
Temporal Policies
Risk-Aware Authorization
Relationship-Based Access Control
Graph Authorization
```

---

# 314. Conceptual Directory Structure

```text
src/
└── Authorization/
    ├── Context/
    │   ├── AuthorizationRequest
    │   └── AuthorizationContext
    │
    ├── Decision/
    │   ├── AuthorizationDecision
    │   └── AuthorizationEffect
    │
    ├── Subject/
    │   ├── Subject
    │   └── Actor
    │
    ├── Resource/
    │   ├── Resource
    │   ├── ResourceType
    │   └── ResourceId
    │
    ├── Action/
    │   └── Action
    │
    ├── Permission/
    │   ├── Permission
    │   ├── PermissionId
    │   └── PermissionDefinition
    │
    ├── Role/
    │   ├── Role
    │   ├── RoleId
    │   ├── RoleDefinition
    │   └── RoleAssignment
    │
    ├── Policy/
    │   ├── Policy
    │   ├── PolicyId
    │   ├── PolicyDefinition
    │   ├── PolicyRule
    │   └── PolicySet
    │
    ├── Attribute/
    │   ├── Attribute
    │   └── AttributeSet
    │
    ├── Enforcement/
    │   └── PolicyEnforcementPoint
    │
    ├── DecisionPoint/
    │   └── PolicyDecisionPoint
    │
    ├── Information/
    │   └── PolicyInformationPoint
    │
    ├── Registry/
    │   └── AuthorizationRegistry
    │
    ├── Manager/
    │   └── AuthorizationManager
    │
    ├── Cache/
    │   └── AuthorizationCache
    │
    └── Error/
        └── AuthorizationError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 315. First Implementation Constraints

La primera versión deberá favorecer:

```text
Deny by Default
Least Privilege
Explicit Permissions
Stable Permission IDs
RBAC
Scoped Role Assignments
Basic ABAC
Explicit Deny
Deterministic Policy Composition
PDP
PEP
Trusted Attributes
Ownership Authorization
Tenant Isolation
Application-Level Enforcement
Field-Level Protection
Row-Level Protection
Administrative Permissions
Authorization Audit
Fail Closed
Authorization Testing
```

---

# 316. First Version Non-Goals

No deberá requerir:

```text
Custom General-Purpose Policy Language
Distributed Policy Platform
Graph Authorization
Relationship-Based Authorization Engine
Capability Token Infrastructure
AI Authorization
Automatic Policy Generation
Universal Enterprise IAM
Complex Delegation Chains
```

---

# 317. Second Phase

Podrá incorporar:

```text
Policy Sets
Advanced ABAC
Role Hierarchies
Permission Hierarchies
Delegation
Impersonation Restrictions
Separation of Duties
Authorization Cache
External PDP Adapter
```

---

# 318. Third Phase

Solo cuando exista necesidad demostrada:

```text
Relationship-Based Access Control
Graph Authorization
Capability-Based Security
Distributed Policy Store
Advanced Temporal Policies
Risk-Aware Authorization
Enterprise Policy Federation
```

---

# 319. Invariantes de Ingeniería

ENG-046 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-866 | Toda operación protegida deberá recibir una Authorization Decision explícita antes de ejecutar efectos sensibles. |
| EI-867 | Authentication y Authorization deberán permanecer separadas: identidad autenticada nunca deberá implicar autoridad automática. |
| EI-868 | Authorization deberá operar bajo Deny by Default y toda incapacidad para decidir de forma confiable deberá resolverse sin conceder autoridad adicional. |
| EI-869 | Permissions deberán poseer identificadores semánticos estables y Business/Application Code deberá favorecer Permissions sobre comparaciones directas de Role. |
| EI-870 | Roles deberán agrupar Permissions y sus Assignments deberán respetar Scope, Lifetime y Revocation explícitos. |
| EI-871 | Attributes utilizados por ABAC deberán provenir de fuentes confiables y la ausencia de Attributes requeridos no deberá producir Allow implícito. |
| EI-872 | Policy Composition deberá ser determinística y Explicit Deny deberá prevalecer conforme a una estrategia documentada, nunca por orden accidental de registro. |
| EI-873 | PEP y PDP deberán permanecer conceptualmente separados y toda Obligation emitida por una decisión deberá aplicarse antes de considerar autorizada la operación. |
| EI-874 | Tenant Membership, Resource Ownership, Client-Supplied IDs o UI Visibility nunca deberán considerarse por sí solos prueba suficiente de autorización. |
| EI-875 | Tenant Isolation deberá aplicarse transversalmente a Operations, Queries, Caches, Search, Counts, Aggregations y Administrative Paths. |
| EI-876 | Field-Level y Row-Level Authorization deberán aplicarse antes de exponer o modificar datos sensibles y no depender únicamente de filtrado posterior o de la UI. |
| EI-877 | Administrative, Delegated, Impersonated y Break-Glass Authority deberán ser explícitas, limitadas, revocables cuando corresponda y auditables. |
| EI-878 | Separation of Duties deberá impedir combinaciones o acciones incompatibles cuando Business/Security Policy lo requiera. |
| EI-879 | Authorization Cache deberá incluir todos los Inputs relevantes para la decisión y ningún Stale Allow deberá sobrevivir más allá de la Security Policy definida. |
| EI-880 | Authorization deberá proteger Application Use Cases independientemente del Entry Point y no deberá depender exclusivamente de Controller, Route, UI o API Gateway. |
| EI-881 | Policy/Authorization Engine Failure deberá operar Fail Closed y ningún Fallback deberá conceder mayor autoridad que la Policy primaria. |
| EI-882 | Cambios de Roles, Permissions, Policies, Memberships, Ownership y Delegations deberán ser consistentes, auditables y capaces de invalidar decisiones previamente cacheadas. |
| EI-883 | Authorization Telemetry deberá permitir investigar Decisions y Privilege Escalation sin exponer Credentials, atributos sensibles o identificadores de alta Cardinality innecesarios. |
| EI-884 | Authorization Testing deberá cubrir Default Deny, RBAC, ABAC, Ownership, Tenant Isolation, Field/Row Security, Delegation, SoD, Cache, Bypass, Failure y Privilege Escalation. |
| EI-885 | La primera implementación deberá favorecer Permissions explícitas, RBAC, ABAC básico, PDP/PEP, Tenant Isolation, Ownership, Application-Level Enforcement, Audit y Fail-Closed antes de introducir Policy DSL, Graph Authorization o plataformas distribuidas avanzadas. |

---

# 320. Continuidad de Invariantes

```text
ENG-042 → EI-786 a EI-805
ENG-043 → EI-806 a EI-825
ENG-044 → EI-826 a EI-845
ENG-045 → EI-846 a EI-865
ENG-046 → EI-866 a EI-885
```

---

# 321. Criterios de Conformidad

Una implementación será conforme con ENG-046 cuando:

- separe Authorization de Authentication;
- aplique Deny by Default;
- modele AuthorizationRequest;
- modele AuthorizationDecision;
- modele Resource y Action;
- utilice Permissions explícitas;
- utilice identificadores estables;
- permita Roles;
- permita Role Assignments Scoped;
- soporte RBAC;
- soporte Attributes confiables;
- permita ABAC básico;
- soporte Explicit Deny;
- componga Policies determinísticamente;
- separe PDP de PEP;
- aplique Obligations;
- proteja Resource Ownership;
- preserve Tenant Isolation;
- proteja Rows;
- proteja Fields;
- proteja operaciones administrativas;
- permita Reauthentication/Step-Up;
- modele Delegation cuando exista;
- controle Impersonation;
- soporte Separation of Duties cuando corresponda;
- proteja múltiples Entry Points;
- integre Data Access;
- controle Authorization Cache;
- falle cerrada;
- audite decisiones sensibles;
- integre Observability;
- pruebe Privilege Escalation;
- pruebe Bypass;
- pruebe Tenant Escape.

---

# 322. Riesgos

Deberán evitarse especialmente:

## Authentication Means Access

Todo usuario autenticado puede ejecutar operaciones sensibles.

## Role String Authorization

```text
if user.role == "admin"
```

se distribuye por toda la aplicación.

## Default Allow

Una Permission no configurada permite acceso.

## UI Authorization

Ocultar un botón se considera Security Control.

## Controller-Only Authorization

CLI, Jobs o Messages evitan el control.

## Route Authorization Only

El Use Case queda desprotegido.

## Client-Supplied Tenant

El Consumer selecciona Tenant sin validación.

## Ownership by Request

El Consumer declara ser propietario.

## Cross-Tenant Query

Una Query omite Scope.

## Cache Tenant Leak

Una Response autorizada para un Tenant se reutiliza para otro.

## Post-Query Security

Se recuperan todos los datos y luego se filtran.

## Count Leakage

Aunque Rows estén ocultas, Counts revelan información.

## Aggregate Leakage

Estadísticas revelan datos restringidos.

## Mass Assignment

El Consumer modifica Fields protegidos.

## Role Explosion

Cada condición contextual genera un Role nuevo.

## Policy Order Dependency

El resultado cambia según Discovery Order.

## Stale Allow Cache

Un permiso revocado continúa funcionando.

## Admin Bypass

El Role Administrator evita todas las Policies.

## Unbounded Delegation

Un usuario delega más autoridad de la que posee.

## Impersonation without Audit

No puede determinarse quién realizó la operación.

## Self Approval

El mismo Actor crea y aprueba una operación restringida.

## Fail-Open PDP

Una caída del Authorization Engine permite acceso.

## Policy Injection

Input externo altera expresión de Policy.

## Wildcard Escalation

Una Permission amplia concede capacidades futuras no previstas.

---

# 323. Relación con ENG-045

La frontera fundamental será:

```text
ENG-045 Authentication
        │
        ▼
     Principal
        │
        ▼
ENG-046 Authorization
        │
        ▼
Authorization Decision
```

Authentication establece:

```text
who
```

Authorization decide:

```text
what
where
when
under which conditions
```

---

# 324. Relación con ENG-044

API deberá actuar como PEP cuando corresponda.

Pero no deberá ser la única capa de Enforcement.

---

# 325. Relación con ENG-034

Application será una Boundary principal de Authorization.

---

# 326. Relación con ENG-035

Domain seguirá protegiendo Business Invariants independientemente de permisos.

---

# 327. Relación con ENG-043

Data Access deberá soportar Enforcement eficiente de:

```text
tenant scope
ownership
row visibility
authorized projection
```

---

# 328. Relación con ENG-024

Security Engineering define:

```text
security policy
threat model
least privilege
audit requirements
incident response
```

ENG-046 implementa Access Control.

---

# 329. Relación con ENG-025

Observability gobernará:

```text
authorization metrics
decision traces
security logs
alerts
```

---

# 330. Relación con ENG-037

Caching deberá preservar Scope de Authorization.

---

# 331. Relación con ENG-038

Concurrency deberá proteger cambios simultáneos de Authority.

---

# 332. Relación con ENG-039

Resilience deberá mantener Fail-Closed bajo fallas.

---

# 333. Relación con ENG-042

Transaction Engineering deberá proteger mutaciones críticas de Authorization State.

---

# 334. Relación con ENG-041

Messaging podrá propagar cambios de Authorization State para:

```text
cache invalidation
audit
security monitoring
```

---

# 335. Relación con ENG-047

ENG-047 deberá formalizar **Identity & Access Management Engineering** como capa de administración y Lifecycle sobre ENG-045 y ENG-046.

La separación propuesta será:

```text
ENG-045 Authentication
→ establish identity

ENG-046 Authorization
→ decide authority

ENG-047 Identity & Access Management
→ administer identities, memberships, roles,
  credentials and access lifecycle
```

ENG-047 deberá cubrir:

```text
Identity Lifecycle
Identity Provisioning
Identity Deprovisioning
User Account
Account State
Account Activation
Account Suspension
Account Disablement
Account Deletion
Identity Profile
Identity Verification
Email Verification
Membership
Organization Membership
Tenant Membership
Group
Group Membership
Role Assignment Administration
Access Request
Access Approval
Access Review
Access Certification
Joiner-Mover-Leaver
Entitlement Lifecycle
Privilege Review
Dormant Account
Orphan Account
Service Account Governance
Identity Synchronization
External Directory
SCIM
Directory Integration
Identity Audit
IAM Observability
IAM Testing
```

---

# 336. Principio Rector

> **MEF deberá conceder autoridad únicamente como resultado de una decisión explícita y contextual, aplicando Deny by Default, Least Privilege, Tenant Isolation y Enforcement independiente del Entry Point; ningún Role, Tenant ID, Ownership Claim, UI State o Authentication Success deberá convertirse por sí mismo en permiso.**

---

# 337. Conclusión

**ENG-046 — Authorization Engineering** formaliza el sistema de decisiones de acceso de MEF.

La arquitectura completa queda:

```text
                    EXTERNAL ACTOR
                          │
                          ▼
                     CREDENTIAL
                          │
                          ▼
              ENG-045 AUTHENTICATION
                          │
                          ▼
                      PRINCIPAL
                          │
                          ▼
              AUTHORIZATION REQUEST
                          │
            ┌─────────────┼─────────────┐
            │             │             │
            ▼             ▼             ▼
          ACTION       RESOURCE       CONTEXT
            │             │             │
            └─────────────┼─────────────┘
                          │
                          ▼
                  POLICY DECISION POINT
                          │
        ┌─────────────────┼─────────────────┐
        │                 │                 │
        ▼                 ▼                 ▼
       RBAC              ABAC           OWNERSHIP
        │                 │                 │
        ├─────────────────┼─────────────────┤
        │                 │                 │
        ▼                 ▼                 ▼
 TENANT POLICY      EXPLICIT DENY       SoD POLICY
        │                 │                 │
        └─────────────────┼─────────────────┘
                          │
                          ▼
                AUTHORIZATION DECISION
                          │
                   ┌──────┴──────┐
                   │             │
                   ▼             ▼
                 ALLOW          DENY
                   │             │
                   ▼             ▼
                 PEP           REJECT
                   │
                   ▼
              APPLICATION
```

La jerarquía conceptual queda:

```text
Identity
   │
   ▼
Principal
   │
   ▼
Role Assignment
   │
   ▼
Role
   │
   ▼
Permission
   │
   ▼
Policy
   │
   ▼
Authorization Decision
```

Pero una decisión real podrá incorporar:

```text
Principal
+
Action
+
Resource
+
Role
+
Permission
+
Attributes
+
Ownership
+
Tenant
+
Authentication Assurance
+
Environment
+
Policy
=
Authorization Decision
```

La separación completa queda:

```text
Authentication
→ Who are you?

Authorization
→ What may you do?

Application
→ What use case should execute?

Domain
→ What business states and transitions are valid?

Data Access
→ What data may be retrieved/persisted?

Security
→ What guarantees protect the whole system?
```

El Enforcement queda:

```text
                 ENTRY POINTS
        ┌──────────┼──────────┐
        │          │          │
       API        CLI       MESSAGE
        │          │          │
        └──────────┼──────────┘
                   │
                   ▼
             APPLICATION
                   │
                   ▼
                  PEP
                   │
                   ▼
                  PDP
                   │
             ┌─────┴─────┐
             │           │
           ALLOW        DENY
             │           │
             ▼           ▼
          USE CASE      REJECT
```

La protección de datos queda:

```text
Authorization Decision
         │
         ├── Tenant Scope
         ├── Ownership
         ├── Row Constraint
         └── Field Constraint
         │
         ▼
      Data Access
         │
         ▼
       Storage
```

La primera implementación deberá concentrarse en:

```text
AuthorizationRequest
AuthorizationContext
AuthorizationDecision
AuthorizationEffect

Subject
Actor

Resource
ResourceType
Action

Permission
PermissionDefinition

Role
RoleDefinition
RoleAssignment

Policy
PolicyDefinition
PolicyRule

AuthorizationManager
PolicyDecisionPoint
PolicyEnforcementPoint
PolicyInformationPoint

AuthorizationRegistry
AuthorizationError
```

con:

```text
Deny by Default
Least Privilege
Stable Permission IDs
RBAC
Scoped Roles
Basic ABAC
Explicit Deny
Deterministic Policies
PDP / PEP
Trusted Attributes
Ownership
Tenant Isolation
Field-Level Authorization
Row-Level Authorization
Application-Level Enforcement
Administrative Permissions
Fail Closed
Audit
Observability
Security Testing
```

antes de introducir:

```text
Policy DSL
Graph Authorization
Relationship-Based Access Control
Capability Infrastructure
Distributed Policy Platform
Risk-Aware Authorization
AI-Generated Policies
```

Con **ENG-046** la serie global alcanza:

```text
EI-885
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
- ENG-047 — Identity & Access Management Engineering
```