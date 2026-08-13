---
id: ENG-047
titulo: Identity & Access Management Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Identity & Access Management Engineering
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
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-045
  - ENG-046
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
  - ENG-048
keywords:
  - identity
  - iam
  - identity-management
  - access-management
  - identity-lifecycle
  - account
  - provisioning
  - deprovisioning
  - joiner-mover-leaver
  - membership
  - group
  - role-assignment
  - entitlement
  - access-request
  - access-approval
  - access-review
  - access-certification
  - dormant-account
  - orphan-account
  - service-account
  - scim
  - directory
  - identity-synchronization
  - mef
---

# ENG-047

# Identity & Access Management Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Identity & Access Management Engineering (IAM)** de **MEF (Modular Enterprise Framework)**.

ENG-047 establece las reglas para:

```text
Identity Lifecycle
Identity Record
Identity Profile
Identity Source
Identity Correlation
Identity Verification
Account
Account Lifecycle
Account State
Account Activation
Account Suspension
Account Disablement
Account Reactivation
Account Deletion
Provisioning
Deprovisioning
Joiner-Mover-Leaver
Organization Membership
Tenant Membership
Group
Group Membership
Role Assignment Administration
Entitlement
Entitlement Lifecycle
Access Request
Access Approval
Access Denial
Access Expiration
Access Review
Access Certification
Privilege Review
Dormant Account
Orphan Account
Service Account Governance
Machine Identity Governance
External Directory
Directory Synchronization
Identity Synchronization
SCIM
Identity Reconciliation
Identity Conflict
Identity Audit
IAM Events
IAM Observability
IAM Testing
```

---

# 2. Declaración

La regla fundamental será:

> **MEF deberá administrar identidades y accesos mediante ciclos de vida explícitos, auditables y revocables, asegurando que cada cuenta, Membership, Role Assignment, Entitlement y Service Account posea origen, propósito, Scope, estado y responsabilidad conocidos.**

La arquitectura conceptual será:

```text
Authoritative Source
        │
        ▼
Identity Lifecycle
        │
        ├── Provision
        ├── Activate
        ├── Modify
        ├── Suspend
        ├── Reactivate
        └── Deprovision
        │
        ▼
Identity / Account
        │
        ├── Memberships
        ├── Groups
        ├── Roles
        ├── Entitlements
        └── Credentials
        │
        ▼
Authentication
        │
        ▼
Authorization
        │
        ▼
Access
```

---

# 3. IAM

`Identity & Access Management` administra:

```text
who exists
which accounts exist
where they belong
which access has been assigned
why access exists
when access expires
who approved it
when it must be reviewed
when it must be removed
```

---

# 4. IAM ≠ Authentication

ENG-045 responde:

```text
Who are you?
```

ENG-047 administra la identidad y su Lifecycle.

---

# 5. IAM ≠ Authorization

ENG-046 responde:

```text
What may this Principal do?
```

ENG-047 administra las asignaciones que pueden alimentar esa decisión.

---

# 6. Separación

La arquitectura deberá conservar:

```text
IAM
→ manages identities and access assignments

Authentication
→ establishes identity

Authorization
→ evaluates authority
```

---

# 7. Identity

Una `Identity` representa una entidad reconocida por MEF.

---

# 8. Identity Types

Podrán existir:

```text
HumanIdentity
ServiceIdentity
MachineIdentity
ExternalIdentity
FederatedIdentity
```

---

# 9. Identity Identifier

Toda Identity deberá poseer un identificador interno estable.

---

# 10. Mutable Identifier

Email, Username, Phone o Employee Number no deberán asumirse necesariamente como identificador interno permanente.

---

# 11. Identity Profile

Podrá contener atributos administrativos.

Conceptualmente:

```text
IdentityProfile
├── identityId
├── displayName
├── attributes
├── source
├── status
└── metadata
```

---

# 12. Profile ≠ Credential

El Identity Profile no deberá contener Passwords, Tokens o Secrets.

---

# 13. Identity Source

Toda Identity administrada deberá poder asociarse a un origen.

Ejemplos:

```text
LOCAL
HR
DIRECTORY
SCIM
EXTERNAL_IDP
API
IMPORT
```

---

# 14. Authoritative Source

Una fuente podrá declararse autoritativa para determinados Attributes.

---

# 15. Attribute Ownership

Deberá conocerse qué sistema posee autoridad sobre cada Attribute sincronizado.

---

# 16. Local Override

No deberá sobrescribir silenciosamente un Attribute controlado por una fuente autoritativa.

---

# 17. Identity Correlation

Relaciona registros provenientes de distintas fuentes con una Identity interna.

---

# 18. Correlation Rule

Deberá ser explícita y determinística.

---

# 19. Email Correlation

No deberá utilizarse automáticamente como prueba universal de que dos registros representan la misma Identity.

---

# 20. Correlation Conflict

Deberá producir revisión o tratamiento controlado.

---

# 21. Identity Merge

La fusión de identidades deberá ser una operación administrativa explícita y auditable.

---

# 22. Identity Split

Cuando sea soportado también deberá ser auditable.

---

# 23. Identity Verification

Podrá representar validaciones administrativas sobre atributos de identidad.

---

# 24. Identity Verification ≠ Authentication

Verificar:

```text
email
phone
employment relationship
organization relationship
```

no equivale necesariamente a autenticar una sesión.

---

# 25. Account

Una `Account` representa una cuenta operativa asociada a una Identity dentro de un Scope/System.

---

# 26. Identity ≠ Account

Una Identity podrá poseer:

```text
0..N Accounts
```

---

# 27. Account Example

```text
Identity
├── MEF Account
├── Tenant Account
├── External Directory Account
└── Service Account
```

---

# 28. Account Identifier

Deberá ser estable dentro de su Scope.

---

# 29. Account State

La primera implementación deberá reconocer:

```text
PENDING
ACTIVE
SUSPENDED
DISABLED
LOCKED
DEPROVISIONING
DEPROVISIONED
```

---

# 30. State Semantics

Cada estado deberá poseer semántica inequívoca.

---

# 31. PENDING

La cuenta existe administrativamente pero todavía no deberá considerarse plenamente habilitada.

---

# 32. ACTIVE

La cuenta puede participar en Authentication/Authorization según Policy.

---

# 33. SUSPENDED

Representa suspensión temporal.

---

# 34. DISABLED

Representa deshabilitación administrativa.

---

# 35. LOCKED

Podrá representar bloqueo derivado de Security Policy.

---

# 36. DEPROVISIONING

Representa remoción de acceso en curso.

---

# 37. DEPROVISIONED

La cuenta ya no deberá proporcionar acceso.

---

# 38. Account State Machine

```text
              ┌─────────────┐
              │   PENDING   │
              └──────┬──────┘
                     │ activate
                     ▼
              ┌─────────────┐
         ┌───►│   ACTIVE    │◄───┐
         │    └──────┬──────┘    │
         │           │           │
reactivate      suspend/disable  │ unlock
         │           │           │
         │      ┌────┴────┐      │
         │      ▼         ▼      │
   ┌───────────┐     ┌──────────┐│
   │ SUSPENDED │     │ DISABLED ││
   └───────────┘     └──────────┘│
                       │          │
                       │          │
                 ┌─────▼─────┐    │
                 │  LOCKED   │────┘
                 └───────────┘

ACTIVE / SUSPENDED / DISABLED
             │
             ▼
      DEPROVISIONING
             │
             ▼
       DEPROVISIONED
```

---

# 39. State Transition

Toda transición deberá validarse.

---

# 40. Invalid Transition

Deberá rechazarse explícitamente.

---

# 41. Account Activation

Deberá cumplir Pre-Conditions configuradas.

---

# 42. Activation Preconditions

Podrán incluir:

```text
identity verified
membership valid
required approval completed
credential enrollment completed
```

---

# 43. Suspension

Deberá ser reversible cuando la Policy lo permita.

---

# 44. Suspension Effect

Deberá impedir nuevo acceso según ENG-045/ENG-046.

---

# 45. Existing Sessions

Suspender una cuenta deberá considerar invalidación de Sessions y Tokens.

---

# 46. Disablement

Podrá utilizarse para terminación administrativa no necesariamente destructiva.

---

# 47. Reactivation

Deberá ser una operación explícita.

---

# 48. Reactivation Review

No deberá restaurar automáticamente todos los privilegios históricos si dejaron de ser válidos.

---

# 49. Account Deletion

Deberá distinguirse de Deprovisioning.

---

# 50. Deprovisioning

Elimina capacidad de acceso.

---

# 51. Deletion

Gestiona eliminación física/lógica de información conforme a Retention/Privacy Policy.

---

# 52. Delete ≠ Deprovision

Una cuenta podrá necesitar conservarse para Audit aunque ya no pueda acceder.

---

# 53. Provisioning

Crea o habilita Identity/Account/Assignments.

---

# 54. Provisioning Sources

Podrá iniciarse mediante:

```text
administrator
workflow
HR event
SCIM
directory synchronization
API
approved access request
```

---

# 55. Provisioning Idempotency

Deberá ser idempotente cuando procese eventos/reintentos externos.

---

# 56. Duplicate Provisioning

No deberá crear identidades duplicadas silenciosamente.

---

# 57. Provisioning Transaction

Cambios relacionados deberán utilizar ENG-042 cuando requieran atomicidad.

---

# 58. Partial Provisioning

Deberá detectarse y reconciliarse.

---

# 59. Provisioning Event

Deberá ser auditable.

---

# 60. Deprovisioning

Deberá remover acceso de manera controlada.

---

# 61. Deprovisioning Actions

Podrá incluir:

```text
disable account
revoke sessions
revoke credentials
remove memberships
revoke role assignments
revoke delegations
disable API keys
transfer ownership
schedule data retention
```

---

# 62. Deprovisioning Order

Deberá priorizar la eliminación de capacidad de acceso.

---

# 63. Access Revocation First

Ante terminación:

```text
revoke access
→ preserve evidence
→ perform cleanup
```

---

# 64. Deprovisioning Failure

No deberá considerarse completado si persiste acceso activo conocido.

---

# 65. Deprovisioning Retry

Deberá ser seguro e idempotente.

---

# 66. Emergency Deprovisioning

Deberá existir para incidentes críticos.

---

# 67. Joiner-Mover-Leaver

MEF deberá poder representar el Lifecycle:

```text
JOINER
MOVER
LEAVER
```

---

# 68. Joiner

Representa incorporación de una Identity.

---

# 69. Joiner Flow

```text
Source Event
    │
    ▼
Create/Correlate Identity
    │
    ▼
Create Account
    │
    ▼
Assign Membership
    │
    ▼
Request/Assign Baseline Access
    │
    ▼
Activate
```

---

# 70. Mover

Representa cambio de:

```text
role
department
tenant
organization
position
responsibility
location
```

---

# 71. Mover Principle

Un cambio no deberá únicamente agregar nuevos permisos.

También deberá revisar/remover acceso anterior.

---

# 72. Privilege Accumulation

Deberá evitarse.

---

# 73. Leaver

Representa salida de una Identity de una relación administrativa.

---

# 74. Leaver Priority

La revocación de acceso deberá ejecutarse con prioridad.

---

# 75. Leaver Flow

```text
Leaver Event
     │
     ▼
Disable Access
     │
     ▼
Revoke Credentials/Sessions
     │
     ▼
Remove Assignments
     │
     ▼
Transfer Ownership
     │
     ▼
Retention / Archive
```

---

# 76. Future-Dated Leaver

Podrá programarse para una fecha efectiva.

---

# 77. Early Termination

Deberá permitir ejecución inmediata.

---

# 78. Membership

Una `Membership` representa relación de una Identity con un Scope organizacional.

---

# 79. Membership Types

Podrán incluir:

```text
TenantMembership
OrganizationMembership
ProjectMembership
TeamMembership
```

---

# 80. Membership ≠ Permission

Ser miembro no deberá implicar automáticamente acceso irrestricto.

---

# 81. Membership Lifecycle

Podrá incluir:

```text
PENDING
ACTIVE
SUSPENDED
EXPIRED
REVOKED
```

---

# 82. Membership Scope

Deberá ser explícito.

---

# 83. Membership Validity

Podrá contener:

```text
validFrom
validUntil
```

---

# 84. Expired Membership

No deberá alimentar Authorization como Membership activa.

---

# 85. Tenant Membership

Deberá integrarse con Tenant Isolation de ENG-046.

---

# 86. Cross-Tenant Membership

Una Identity podrá pertenecer a múltiples Tenants sin mezclar autoridad entre ellos.

---

# 87. Current Tenant

No deberá inferirse únicamente desde Input del cliente.

---

# 88. Organization Membership

Podrá representar relación con una organización interna o externa.

---

# 89. Membership Removal

Deberá invalidar Authority derivada.

---

# 90. Group

Un `Group` agrupa Identities administrativamente.

---

# 91. Group Use

Podrá facilitar:

```text
role assignment
policy targeting
access review
directory synchronization
```

---

# 92. Group ≠ Role

```text
Group
→ who belongs together

Role
→ which permissions are grouped together
```

---

# 93. Group Membership

Deberá poseer Lifecycle explícito.

---

# 94. Nested Groups

Podrán soportarse posteriormente.

---

# 95. Group Cycle

Si existen Nested Groups deberán rechazarse ciclos.

---

# 96. Dynamic Group

Podrá definirse mediante Attributes confiables.

---

# 97. Dynamic Group Evaluation

Deberá ser determinística.

---

# 98. Group Removal

Deberá retirar acceso derivado cuando corresponda.

---

# 99. Entitlement

Un `Entitlement` representa una unidad administrable de acceso.

---

# 100. Entitlement Examples

```text
Permission
Role
Capability
Application Access
Dataset Access
Administrative Function
```

---

# 101. Entitlement ≠ Permission

Permission es una forma posible de Entitlement.

---

# 102. Entitlement Catalog

MEF podrá mantener catálogo administrable.

---

# 103. Entitlement Definition

Conceptualmente:

```text
Entitlement
├── id
├── type
├── target
├── scope
├── risk
├── owner
└── status
```

---

# 104. Entitlement Owner

Todo Entitlement sensible deberá poseer Owner administrativo.

---

# 105. Entitlement Risk

Podrá clasificarse:

```text
LOW
MEDIUM
HIGH
CRITICAL
```

---

# 106. High-Risk Entitlement

Podrá requerir aprobación adicional.

---

# 107. Entitlement Lifecycle

Podrá incluir:

```text
DRAFT
ACTIVE
DEPRECATED
RETIRED
```

---

# 108. Retired Entitlement

No deberá otorgarse nuevamente.

---

# 109. Existing Assignment

Deberá existir estrategia de migración/revocación.

---

# 110. Access Assignment

Relaciona una Identity con un Entitlement.

---

# 111. Assignment Metadata

Conceptualmente:

```text
AccessAssignment
├── subject
├── entitlement
├── scope
├── source
├── approvedBy
├── validFrom
├── validUntil
└── status
```

---

# 112. Assignment Source

Podrá ser:

```text
DIRECT
ROLE
GROUP
POLICY
REQUEST
PROVISIONING
DELEGATION
```

---

# 113. Direct Assignment

Deberá utilizarse con moderación.

---

# 114. Effective Access

Es el resultado de todas las asignaciones vigentes aplicables.

---

# 115. Effective Access Calculation

Deberá ser determinística.

---

# 116. Effective Access Explanation

Deberá poder responder:

```text
Why does this identity have this access?
```

---

# 117. Access Provenance

Toda autoridad administrada deberá poder rastrearse hasta su origen.

---

# 118. Access Request

Una Identity o Actor autorizado podrá solicitar acceso.

---

# 119. Access Request Definition

Conceptualmente:

```text
AccessRequest
├── requester
├── beneficiary
├── entitlement
├── scope
├── justification
├── requestedUntil
└── status
```

---

# 120. Requester ≠ Beneficiary

Podrán ser diferentes.

---

# 121. Access Request States

```text
DRAFT
SUBMITTED
UNDER_REVIEW
APPROVED
DENIED
CANCELLED
EXPIRED
FULFILLED
```

---

# 122. Access Request State Machine

```text
DRAFT
  │
  ▼
SUBMITTED
  │
  ▼
UNDER_REVIEW
  │
  ├─────────────┐
  ▼             ▼
APPROVED       DENIED
  │
  ▼
FULFILLED
```

---

# 123. Approval

Un Approval representa decisión administrativa sobre una solicitud.

---

# 124. Approval Policy

Podrá depender de:

```text
entitlement risk
tenant
resource
beneficiary
manager
entitlement owner
security team
```

---

# 125. Single Approval

Podrá ser suficiente para Access de bajo riesgo.

---

# 126. Multi-Level Approval

Podrá utilizarse para acceso sensible.

---

# 127. Self-Approval

No deberá permitirse cuando la Policy requiera independencia.

---

# 128. Approval Expiration

Una aprobación podrá expirar si no se Provisiona oportunamente.

---

# 129. Approval ≠ Provisioning

```text
approval
→ authority to provision

provisioning
→ actual assignment
```

---

# 130. Fulfillment

Una solicitud deberá marcarse `FULFILLED` únicamente cuando el acceso haya sido realmente aplicado.

---

# 131. Partial Fulfillment

Deberá registrarse y reconciliarse.

---

# 132. Access Expiration

Accesos temporales deberán expirar automáticamente.

---

# 133. Expiration Enforcement

No deberá depender exclusivamente de una revisión manual.

---

# 134. Temporary Privilege

Deberá favorecer:

```text
short lifetime
explicit scope
automatic revocation
```

---

# 135. Access Review

Proceso periódico para revisar acceso existente.

---

# 136. Review Scope

Podrá ser:

```text
identity
group
role
tenant
application
entitlement
high-risk access
service account
```

---

# 137. Review Decision

Podrá incluir:

```text
CERTIFY
REVOKE
MODIFY
ESCALATE
```

---

# 138. Access Certification

Confirma que acceso sigue siendo necesario y válido.

---

# 139. Certification ≠ Permanent Approval

Deberá tener vigencia limitada.

---

# 140. Review Campaign

Podrá agrupar múltiples Reviews.

---

# 141. Review Owner

Deberá estar claramente definido.

---

# 142. Reviewer Independence

Podrá requerirse para Privileged Access.

---

# 143. Unreviewed Access

Deberá seguir una Policy explícita.

---

# 144. High-Risk Unreviewed Access

Deberá favorecer suspensión/revocación o escalamiento.

---

# 145. Review Evidence

Deberá conservarse para Audit.

---

# 146. Privilege Review

Deberá enfocarse especialmente en:

```text
administrators
policy managers
credential managers
cross-tenant operators
impersonation privileges
break-glass access
```

---

# 147. Dormant Account

Una cuenta sin actividad durante periodo definido.

---

# 148. Dormancy Policy

Deberá ser configurable.

---

# 149. Dormant Account Detection

No deberá depender únicamente del último Login cuando existan Machine Identities.

---

# 150. Dormant Human Account

Podrá suspenderse después de Policy definida.

---

# 151. Dormant Privileged Account

Deberá recibir tratamiento más estricto.

---

# 152. Orphan Account

Cuenta sin Owner/Identity/Source válido.

---

# 153. Orphan Detection

Será obligatorio en reconciliaciones cuando existan sistemas externos.

---

# 154. Orphan Account Access

Deberá considerarse riesgo elevado.

---

# 155. Orphan Remediation

Podrá ser:

```text
correlate
assign owner
suspend
deprovision
investigate
```

---

# 156. Service Account Governance

Toda Service Account deberá poseer:

```text
owner
purpose
system
environment
credentials
review policy
lifecycle
```

---

# 157. Service Account Owner

Deberá ser una Identity/Team responsable identificable.

---

# 158. Service Account Purpose

Deberá documentarse.

---

# 159. Shared Human Use

No deberá permitirse salvo excepción explícita.

---

# 160. Service Account Review

Deberá realizarse periódicamente.

---

# 161. Service Account Expiration

Podrá requerirse para cuentas temporales.

---

# 162. Service Account Credential Rotation

Deberá integrarse con ENG-045.

---

# 163. Service Account Deprovisioning

Deberá revocar Credentials antes de completar Retire.

---

# 164. Machine Identity

Deberá administrarse con Lifecycle equivalente cuando corresponda.

---

# 165. Machine Identity Owner

No deberá existir sin responsabilidad humana/organizacional identificada.

---

# 166. Break-Glass Account

Deberá estar especialmente gobernada.

---

# 167. Break-Glass Controls

Deberá considerar:

```text
limited number
strong authentication
offline/restricted credential handling
monitoring
periodic testing
immediate audit
credential rotation after use
```

---

# 168. External Directory

MEF podrá integrarse con:

```text
LDAP
Active Directory
Cloud Directory
External IAM
```

---

# 169. Directory ≠ Source of Truth Automatically

Deberá declararse qué Attributes/Objects controla.

---

# 170. Directory Connector

Deberá implementar Contract explícito.

---

# 171. Directory Read

Podrá importar:

```text
users
groups
memberships
attributes
```

---

# 172. Directory Write

Deberá requerir configuración y permisos explícitos.

---

# 173. Bidirectional Synchronization

No deberá habilitarse sin Conflict Resolution definida.

---

# 174. Identity Synchronization

Deberá ser:

```text
deterministic
idempotent
observable
reconcilable
```

---

# 175. Sync Cursor

Podrá utilizarse para sincronización incremental.

---

# 176. Full Synchronization

Deberá soportarse cuando sea necesario para Reconciliation.

---

# 177. Sync Deletion

La ausencia de un registro en una carga incremental no deberá interpretarse automáticamente como Delete.

---

# 178. Tombstone

Podrá utilizarse para representar eliminación externa.

---

# 179. Sync Conflict

Deberá resolverse mediante Policy explícita.

---

# 180. Last Write Wins

No deberá utilizarse indiscriminadamente.

---

# 181. Attribute Conflict

Deberá respetar Authoritative Source.

---

# 182. Identity Reconciliation

Compara estado esperado con estado real.

---

# 183. Reconciliation Questions

Deberá poder detectar:

```text
missing accounts
orphan accounts
unexpected memberships
unexpected roles
missing assignments
stale assignments
disabled source identity with active target account
```

---

# 184. Reconciliation Frequency

Deberá depender del riesgo.

---

# 185. Reconciliation Repair

Podrá ser:

```text
automatic
approval-required
manual
```

---

# 186. Automatic Repair

Solo deberá ejecutarse cuando la Policy sea inequívoca.

---

# 187. SCIM

MEF podrá soportar **System for Cross-domain Identity Management**.

---

# 188. SCIM Purpose

Facilitará Provisioning y Lifecycle interoperable de:

```text
Users
Groups
Memberships
```

---

# 189. SCIM Server

MEF podrá actuar como SCIM Service Provider.

---

# 190. SCIM Client

MEF podrá actuar como Provisioning Client.

---

# 191. SCIM Mapping

Deberá existir Mapping explícito entre:

```text
SCIM attributes
MEF identity attributes
```

---

# 192. SCIM External ID

No deberá sustituir necesariamente el Identity ID interno.

---

# 193. SCIM Idempotency

Operaciones deberán ser seguras ante retries cuando corresponda.

---

# 194. SCIM Filtering

Deberá validar y limitar Input.

---

# 195. SCIM Patch

Deberá protegerse contra modificaciones no autorizadas.

---

# 196. SCIM Deactivation

Deberá mapearse correctamente al Account Lifecycle.

---

# 197. SCIM Authentication

Deberá utilizar ENG-045.

---

# 198. SCIM Authorization

Deberá utilizar ENG-046.

---

# 199. SCIM Audit

Cambios deberán ser auditables.

---

# 200. Import

MEF podrá permitir importación administrativa.

---

# 201. Import Validation

Deberá ejecutarse antes de mutar estado.

---

# 202. Import Preview

Deberá favorecerse para operaciones masivas.

---

# 203. Import Dry Run

Deberá mostrar conceptualmente:

```text
create
update
suspend
conflict
skip
error
```

---

# 204. Bulk IAM Operation

Deberá definir semántica transaccional.

---

# 205. Bulk Failure

No deberá ocultar resultados parciales.

---

# 206. Identity Data

Deberá clasificarse como información sensible según ENG-024.

---

# 207. Data Minimization

IAM deberá almacenar únicamente atributos necesarios.

---

# 208. Sensitive Attribute

Podrá requerir Field-Level Authorization.

---

# 209. Identity Search

Deberá respetar Authorization.

---

# 210. Identity Enumeration

No deberá exponerse indiscriminadamente.

---

# 211. Identity Export

Deberá requerir Permission explícita.

---

# 212. Identity Deletion

Deberá respetar:

```text
audit
retention
legal requirements
privacy
referential integrity
```

---

# 213. Historical Identity

Podrá conservarse pseudonimizada cuando corresponda.

---

# 214. Credential Administration

IAM podrá iniciar operaciones administrativas de Credential Lifecycle.

---

# 215. Credential Implementation

Seguirá perteneciendo a ENG-045.

---

# 216. Credential Reset Authorization

Seguirá perteneciendo a ENG-046.

---

# 217. Role Assignment Administration

IAM administra Assignments.

ENG-046 evalúa sus efectos.

---

# 218. Role Assignment Request

Podrá pasar por Access Request.

---

# 219. Direct Role Assignment

Deberá requerir Permission administrativa explícita.

---

# 220. Privileged Role Assignment

Podrá requerir:

```text
MFA
fresh authentication
multiple approvals
expiration
review
```

---

# 221. Self-Escalation

Deberá impedirse.

---

# 222. Role Assignment Audit

Será obligatorio.

---

# 223. Group-Based Assignment

Podrá derivar Roles/Entitlements desde Group Membership.

---

# 224. Derived Assignment

Deberá conservar Provenance.

---

# 225. Assignment Removal

Deberá eliminar Authority derivada cuando corresponda.

---

# 226. Access Graph

MEF deberá poder reconstruir conceptualmente:

```text
Identity
   │
   ├── Membership
   │
   ├── Group
   │      │
   │      └── Entitlement
   │
   ├── Role
   │      │
   │      └── Permission
   │
   └── Direct Entitlement
```

---

# 227. Why Access

Deberá poder explicarse:

```text
Identity X
has Permission Y
because
Group A
assigned Role B
within Tenant C
until Date D
approved by Actor E
```

---

# 228. Effective Access Report

Podrá generarse para Audit/Review.

---

# 229. Access Diff

Podrá comparar:

```text
expected access
vs
actual access
```

---

# 230. Toxic Combination

IAM podrá detectar combinaciones incompatibles definidas por ENG-046.

---

# 231. Separation of Duties Administration

IAM deberá evitar Assignments que violen Static SoD.

---

# 232. Dynamic SoD

Seguirá evaluándose durante Authorization.

---

# 233. Access Policy

IAM Policies deberán diferenciarse de Authorization Policies cuando sus responsabilidades sean distintas.

---

# 234. IAM Policy Examples

```text
account inactivity
approval requirement
review frequency
access expiration
service account ownership
provisioning source
```

---

# 235. Authorization Policy Examples

```text
may user approve invoice?
may user export report?
```

---

# 236. IAM Event

Eventos podrán incluir:

```text
identity.created
identity.updated
identity.merged
account.created
account.activated
account.suspended
account.disabled
account.deprovisioned
membership.created
membership.revoked
group.membership.changed
role.assignment.created
role.assignment.revoked
access.requested
access.approved
access.denied
access.expired
access.certified
access.revoked
service_account.created
service_account.orphaned
reconciliation.failed
```

---

# 237. Event Payload

No deberá incluir Credentials.

---

# 238. Event Provenance

Deberá conservar Actor/Source cuando corresponda.

---

# 239. Event Ordering

No deberá asumirse orden global.

---

# 240. Event Idempotency

Consumers deberán manejar duplicados cuando corresponda.

---

# 241. Audit

IAM deberá mantener Audit Trail para cambios sensibles.

---

# 242. Audit Actions

Como mínimo:

```text
account state changes
membership changes
role assignments
privileged access
access approvals
access revocations
identity merges
service account changes
directory synchronization changes
```

---

# 243. Audit Actor

Deberá distinguir:

```text
human administrator
service
synchronization process
system automation
```

---

# 244. Audit Reason

Operaciones administrativas sensibles podrán requerir Justification.

---

# 245. Audit Immutability

Deberá seguir ENG-024.

---

# 246. Observability

ENG-025 gobernará Telemetry.

---

# 247. IAM Metrics

Podrán incluir:

```text
mef.iam.identities.total
mef.iam.accounts.total
mef.iam.accounts.suspended
mef.iam.accounts.orphaned
mef.iam.provisioning.success
mef.iam.provisioning.failure
mef.iam.deprovisioning.failure
mef.iam.access_requests.pending
mef.iam.access_reviews.overdue
mef.iam.reconciliation.drift
```

---

# 248. Metric Cardinality

No deberán utilizarse como Labels:

```text
identityId
email
accountId
employeeId
```

---

# 249. IAM Logs

Podrán incluir:

```text
requestId
traceId
operation
source
result
reasonCode
```

---

# 250. Identity Data Logging

Deberá minimizarse.

---

# 251. Synchronization Metrics

Deberán distinguir:

```text
created
updated
disabled
conflict
failed
skipped
```

---

# 252. Reconciliation Alert

Podrá generarse ante:

```text
orphan privileged account
disabled source identity still active
unexpected administrator role
deprovisioning failure
large synchronization drift
```

---

# 253. Security

ENG-024 gobernará Security.

---

# 254. IAM Administrative Surface

Deberá considerarse de alto riesgo.

---

# 255. IAM Administrative Authentication

Podrá requerir ENG-045 Step-Up/MFA.

---

# 256. IAM Administrative Authorization

Deberá utilizar Permissions específicas de ENG-046.

---

# 257. Administrative Permissions

Ejemplos:

```text
iam.identities.read
iam.identities.manage
iam.accounts.activate
iam.accounts.suspend
iam.accounts.deprovision
iam.memberships.manage
iam.groups.manage
iam.roles.assign
iam.access.approve
iam.reviews.certify
iam.service_accounts.manage
iam.directories.manage
iam.reconciliation.execute
```

---

# 258. `iam.manage`

Una Permission excesivamente amplia no deberá ser Default.

---

# 259. Privileged IAM Action

Deberá auditarse.

---

# 260. Bulk Privileged Operation

Podrá requerir confirmación reforzada.

---

# 261. Fail Closed

Cuando IAM no pueda determinar estado válido de una cuenta o Assignment crítico, no deberá conceder acceso adicional.

---

# 262. Source Failure

Una caída temporal del sistema autoritativo no deberá reactivar acceso previamente revocado.

---

# 263. Stale Identity Data

Deberá existir Policy para Freshness.

---

# 264. Stale Membership

No deberá mantenerse indefinidamente sin Reconciliation.

---

# 265. Testing

ENG-009 gobernará Testing.

---

# 266. Identity Lifecycle Test

Deberá cubrir:

```text
create
update
suspend
reactivate
deprovision
delete
```

---

# 267. Account State Machine Test

Deberá probar todas las transiciones válidas e inválidas.

---

# 268. Provisioning Test

Deberá cubrir:

```text
new identity
existing identity
duplicate event
partial failure
retry
conflict
```

---

# 269. Deprovisioning Test

Deberá comprobar:

```text
account disabled
sessions revoked
credentials revoked
assignments removed
delegations revoked
```

---

# 270. Joiner Test

Deberá comprobar Baseline Access correcto.

---

# 271. Mover Test

Deberá comprobar que acceso anterior innecesario sea removido.

---

# 272. Leaver Test

Deberá comprobar revocación inmediata/efectiva.

---

# 273. Membership Test

Deberá comprobar:

```text
scope
expiration
revocation
multi-tenant isolation
```

---

# 274. Group Test

Deberá comprobar Membership y acceso derivado.

---

# 275. Access Request Test

Deberá cubrir State Machine completa.

---

# 276. Approval Test

Deberá comprobar:

```text
authorized approver
unauthorized approver
self-approval
expired approval
multi-level approval
```

---

# 277. Access Expiration Test

Deberá comprobar revocación automática.

---

# 278. Review Test

Deberá comprobar:

```text
certify
revoke
modify
overdue
```

---

# 279. Dormant Account Test

Deberá utilizar Clock controlado.

---

# 280. Orphan Account Test

Deberá comprobar detección/remediación.

---

# 281. Service Account Test

Deberá comprobar:

```text
owner
purpose
environment
credential lifecycle
review
deprovisioning
```

---

# 282. Synchronization Test

Deberá cubrir:

```text
full sync
incremental sync
duplicate event
out-of-order event
attribute conflict
source failure
```

---

# 283. Reconciliation Test

Deberá introducir Drift deliberadamente.

---

# 284. SCIM Test

Cuando exista deberá cubrir:

```text
create
replace
patch
deactivate
filter
group membership
authorization
idempotency
```

---

# 285. Privilege Escalation Test

Deberá intentar:

```text
self-assign role
self-approve access
modify entitlement
reactivate disabled account
cross-tenant membership
restore expired assignment
```

---

# 286. Architecture Test

Podrá impedir:

```text
IAM → password hashing implementation
IAM → direct authorization allow
Authentication → account provisioning
Domain → directory connector
Controller → direct role database mutation
```

---

# 287. Concurrency Test

Deberá cubrir:

```text
simultaneous approvals
assignment revoke vs use
deprovision vs login
sync vs local update
duplicate provisioning
```

---

# 288. Fault Injection

Podrá simular:

```text
directory unavailable
SCIM timeout
database failure
message duplication
partial deprovisioning
reconciliation interruption
```

---

# 289. Build Integration

ENG-012 podrá validar:

```text
duplicate entitlement
invalid account state
invalid role reference
missing entitlement owner
invalid group hierarchy
unsafe default access
unbounded privileged assignment
```

---

# 290. CLI

ENG-007 podrá proporcionar:

```text
mef iam:identities
mef iam:accounts
mef iam:memberships
mef iam:groups
mef iam:entitlements
mef iam:access
mef iam:requests
mef iam:reviews
mef iam:service-accounts
mef iam:sync
mef iam:reconcile
mef iam:diagnose
```

---

# 291. CLI Mutation

Toda mutación deberá utilizar ENG-046.

---

# 292. CLI Secret Policy

No deberá mostrar Credentials.

---

# 293. `iam:reconcile`

Podrá proporcionar:

```text
expected
actual
drift
proposed remediation
```

---

# 294. Dry Run

Operaciones masivas deberán favorecer:

```text
--dry-run
```

---

# 295. Configuration

ENG-011 podrá definir:

```text
iam:
  identity:
    correlation-policy: strict

  accounts:
    dormant-after: 90d

  access:
    default-expiration: null

  privileged-access:
    expiration-required: true
    review-interval: 30d

  provisioning:
    idempotency: true

  deprovisioning:
    revoke-sessions: true
    revoke-credentials: true

  reconciliation:
    enabled: true
    interval: 24h

  service-accounts:
    owner-required: true
    review-required: true
```

---

# 296. Configuration Validation

Deberá comprobar:

```text
valid lifecycle states
valid correlation policy
safe privileged access policy
valid review interval
valid dormancy threshold
deprovisioning security controls
service account ownership
reconciliation configuration
```

---

# 297. Registry Integration

ENG-020 podrá registrar:

```text
IdentitySourceDefinition
AccountTypeDefinition
EntitlementDefinition
GroupDefinition
ProvisioningProviderDefinition
DirectoryConnectorDefinition
```

---

# 298. Identity Source Definition

Conceptualmente:

```text
IdentitySourceDefinition
├── id
├── type
├── authoritativeAttributes
├── priority
└── metadata
```

---

# 299. Provisioning Provider

Conceptualmente:

```text
ProvisioningProvider
├── provision
├── update
├── suspend
├── reactivate
└── deprovision
```

---

# 300. Directory Connector

Conceptualmente:

```text
DirectoryConnector
├── discover
├── read
├── synchronize
├── reconcile
└── health
```

---

# 301. IAM Manager

Deberá coordinar Lifecycle administrativo.

---

# 302. IAM Manager ≠ Authentication Manager

No deberá verificar Passwords/Tokens.

---

# 303. IAM Manager ≠ Authorization Manager

No deberá producir Allow/Deny para Business Operations.

---

# 304. Access Administration Manager

Podrá coordinar:

```text
requests
approvals
assignments
reviews
certifications
```

---

# 305. Identity Lifecycle Manager

Podrá coordinar:

```text
provision
activate
suspend
reactivate
deprovision
```

---

# 306. Reconciliation Manager

Podrá coordinar:

```text
expected state
actual state
drift
remediation
```

---

# 307. Bootstrap

ENG-027 deberá construir IAM Runtime.

---

# 308. Bootstrap Flow

```text
Load Configuration
       │
       ▼
Discover Identity Sources
       │
       ▼
Discover Provisioning Providers
       │
       ▼
Discover Entitlements
       │
       ▼
Discover Directory Connectors
       │
       ▼
Validate Ownership
       │
       ▼
Validate Lifecycle Policies
       │
       ▼
Build IAM Registry
       │
       ▼
Build Lifecycle Managers
       │
       ▼
Build Reconciliation
       │
       ▼
Readiness
```

---

# 309. Bootstrap Failure

Deberá impedir Readiness ante:

```text
invalid lifecycle configuration
duplicate identity source
missing required entitlement owner
invalid provisioning provider
unsafe privileged access policy
invalid authoritative attribute mapping
```

---

# 310. Module Integration

Modules podrán declarar:

```text
entitlements
identity attributes
groups
baseline access
access review requirements
```

---

# 311. Module Baseline Access

Deberá ser mínimo.

---

# 312. Automatic Baseline Access

No deberá otorgar privilegios elevados.

---

# 313. Cross-Module Entitlement

Deberá utilizar Contract explícito.

---

# 314. Application Integration

ENG-034 podrá iniciar IAM Use Cases.

---

# 315. API Integration

ENG-044 podrá exponer IAM Administration Endpoints protegidos.

---

# 316. Authentication Integration

ENG-045 deberá consultar Account State cuando corresponda.

---

# 317. Authorization Integration

ENG-046 deberá consumir Assignments/Memberships vigentes según Contract.

---

# 318. Transaction Integration

ENG-042 deberá utilizarse para cambios críticos como:

```text
account activation
role assignment
access approval
membership change
deprovisioning
```

cuando requieran atomicidad.

---

# 319. Data Access Integration

ENG-043 deberá persistir IAM State mediante Repositories explícitos.

---

# 320. Cache Integration

ENG-037 podrá Cachear:

```text
identity profile
membership
effective access
directory metadata
```

con invalidación apropiada.

---

# 321. Authorization Cache Invalidation

Cambios IAM que afecten Authority deberán invalidar ENG-046.

---

# 322. Concurrency Integration

ENG-038 gobernará:

```text
duplicate provisioning
simultaneous approvals
assignment mutation
sync conflict
deprovision race
```

---

# 323. Resilience Integration

ENG-039 gobernará Connectors externos.

---

# 324. Scheduling Integration

ENG-040 podrá ejecutar:

```text
access expiration
dormant account detection
access reviews
certification campaigns
reconciliation
directory synchronization
```

---

# 325. Messaging Integration

ENG-041 podrá distribuir IAM Events.

---

# 326. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Identity
IdentityId
IdentityProfile
IdentitySource

Account
AccountId
AccountState

Membership
MembershipId

Group
GroupId
GroupMembership

Entitlement
EntitlementId
AccessAssignment

AccessRequest
AccessRequestStatus
AccessApproval

IdentityLifecycleManager
AccessAdministrationManager

ProvisioningProvider
IAMRegistry

IAMError
```

---

# 327. Optional Initial Components

Podrán incorporarse:

```text
AccessReview
AccessCertification
ServiceAccount
DormancyPolicy
ReconciliationManager
IdentityCorrelation
```

---

# 328. Later Components

Solo cuando exista necesidad demostrada:

```text
SCIM Server
SCIM Client
LDAP Connector
Active Directory Connector
Cloud Directory Connector
Nested Groups
Dynamic Groups
Identity Federation Administration
Advanced Access Certification
Enterprise Governance
```

---

# 329. Conceptual Directory Structure

```text
src/
└── IAM/
    ├── Identity/
    │   ├── Identity
    │   ├── IdentityId
    │   ├── IdentityProfile
    │   ├── IdentitySource
    │   └── IdentityCorrelation
    │
    ├── Account/
    │   ├── Account
    │   ├── AccountId
    │   └── AccountState
    │
    ├── Membership/
    │   ├── Membership
    │   └── MembershipId
    │
    ├── Group/
    │   ├── Group
    │   ├── GroupId
    │   └── GroupMembership
    │
    ├── Entitlement/
    │   ├── Entitlement
    │   ├── EntitlementId
    │   └── AccessAssignment
    │
    ├── Request/
    │   ├── AccessRequest
    │   ├── AccessRequestStatus
    │   └── AccessApproval
    │
    ├── Review/
    │   ├── AccessReview
    │   └── AccessCertification
    │
    ├── ServiceAccount/
    │   └── ServiceAccount
    │
    ├── Provisioning/
    │   └── ProvisioningProvider
    │
    ├── Directory/
    │   └── DirectoryConnector
    │
    ├── Reconciliation/
    │   └── ReconciliationManager
    │
    ├── Lifecycle/
    │   └── IdentityLifecycleManager
    │
    ├── Administration/
    │   └── AccessAdministrationManager
    │
    ├── Registry/
    │   └── IAMRegistry
    │
    └── Error/
        └── IAMError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 330. Error Handling

ENG-023 gobernará Error Translation.

---

# 331. Error Namespace

ENG-047 utilizará:

```text
MEF-IAM-xxx
```

---

# 332. Taxonomía ENG-047

```text
MEF-IAM-001 Identity not found
MEF-IAM-002 Identity already exists
MEF-IAM-003 Identity correlation conflict
MEF-IAM-004 Identity source invalid
MEF-IAM-005 Account not found
MEF-IAM-006 Account state invalid
MEF-IAM-007 Account transition invalid
MEF-IAM-008 Account suspended
MEF-IAM-009 Account disabled
MEF-IAM-010 Account deprovisioned
MEF-IAM-011 Membership invalid
MEF-IAM-012 Membership expired
MEF-IAM-013 Membership revoked
MEF-IAM-014 Group invalid
MEF-IAM-015 Group membership invalid
MEF-IAM-016 Entitlement not found
MEF-IAM-017 Entitlement inactive
MEF-IAM-018 Access assignment invalid
MEF-IAM-019 Access assignment expired
MEF-IAM-020 Access request invalid
MEF-IAM-021 Access request denied
MEF-IAM-022 Access approval invalid
MEF-IAM-023 Self-approval denied
MEF-IAM-024 Access review overdue
MEF-IAM-025 Service account owner missing
MEF-IAM-026 Orphan account detected
MEF-IAM-027 Provisioning failed
MEF-IAM-028 Deprovisioning failed
MEF-IAM-029 Synchronization conflict
MEF-IAM-030 Reconciliation drift detected
MEF-IAM-031 Directory unavailable
MEF-IAM-032 SCIM operation invalid
MEF-IAM-033 Privilege escalation attempt
MEF-IAM-034 IAM security violation
MEF-IAM-035 IAM invariant violation
```

---

# 333. First Implementation Constraints

La primera versión deberá favorecer:

```text
Stable Identity IDs
Explicit Account Lifecycle
Account State Machine
Provisioning
Deprovisioning
Joiner-Mover-Leaver
Memberships
Tenant Membership Isolation
Groups
Entitlements
Access Assignments
Access Provenance
Access Requests
Approvals
Automatic Expiration
Service Account Ownership
Dormant/Orphan Detection
Audit
Fail Closed
```

---

# 334. First Version Non-Goals

No deberá requerir:

```text
Enterprise Identity Governance Suite
Full SCIM Platform
Full LDAP Server
Active Directory Replacement
Universal Identity Broker
AI Access Recommendations
Behavioral Identity Analytics
Complex Nested Groups
Global Directory Federation
```

---

# 335. Second Phase

Podrá incorporar:

```text
Access Reviews
Certification Campaigns
SCIM
Directory Synchronization
Reconciliation
Dynamic Groups
Advanced Service Account Governance
```

---

# 336. Third Phase

Solo cuando exista necesidad demostrada:

```text
Enterprise Identity Governance
Multi-Directory Federation
Advanced Identity Correlation
Automated Risk Scoring
Access Recommendation Engine
Graph-Based Identity Governance
```

---

# 337. Invariantes de Ingeniería

ENG-047 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-886 | Toda Identity administrada deberá poseer identificador interno estable, Lifecycle explícito y Source/Provenance conocido cuando corresponda. |
| EI-887 | Identity, Account, Credential, Membership, Role, Entitlement y Authorization Decision deberán permanecer como conceptos separados. |
| EI-888 | Todo Account deberá operar mediante una State Machine explícita y ninguna transición inválida deberá habilitar acceso accidentalmente. |
| EI-889 | Provisioning y Deprovisioning deberán ser idempotentes cuando interactúen con retries, Events o sistemas externos, y Partial Failures deberán ser detectables. |
| EI-890 | Deprovisioning deberá priorizar la revocación efectiva de Sessions, Credentials, Memberships, Assignments y Delegations antes del Cleanup administrativo. |
| EI-891 | Joiner-Mover-Leaver deberá revisar tanto concesión como remoción de autoridad para impedir Privilege Accumulation. |
| EI-892 | Membership y Group Membership deberán poseer Scope, Lifecycle y Validity explícitos y nunca deberán implicar acceso irrestricto por sí mismos. |
| EI-893 | Todo Entitlement y Access Assignment deberá poseer Provenance suficiente para explicar por qué una Identity dispone de determinado acceso. |
| EI-894 | Privileged Access deberá favorecer Scope limitado, Expiration, Approval, Review y Revocation explícitos. |
| EI-895 | Access Requests, Approvals y Fulfillment deberán permanecer separados y una aprobación no deberá considerarse acceso efectivo hasta que Provisioning haya concluido correctamente. |
| EI-896 | Access Reviews y Certifications deberán producir evidencia auditable y el acceso de alto riesgo no revisado deberá seguir una Policy de remediación explícita. |
| EI-897 | Dormant, Orphan y Service Accounts deberán detectarse y gobernarse mediante Owner, Purpose, Review y Lifecycle explícitos. |
| EI-898 | Identity Synchronization deberá ser determinística, idempotente y respetar Authoritative Sources; los conflictos no deberán resolverse mediante Last-Write-Wins indiscriminado. |
| EI-899 | Reconciliation deberá detectar Drift entre estado esperado y real, especialmente Accounts huérfanas, acceso inesperado y Deprovisioning incompleto. |
| EI-900 | SCIM y Directory Integration deberán reutilizar Authentication, Authorization, Validation, Audit y Lifecycle de MEF en lugar de introducir Security Boundaries paralelas. |
| EI-901 | Toda mutación administrativa de Roles, Memberships, Entitlements, Accounts o Service Accounts deberá estar autorizada y las operaciones privilegiadas deberán ser auditables. |
| EI-902 | Cambios IAM que alteren Effective Access deberán invalidar o actualizar cualquier Authorization Cache o estado derivado relevante. |
| EI-903 | IAM Telemetry deberá permitir detectar Provisioning Failure, Drift, Orphan Accounts, Privilege Escalation y Review Overdue sin exponer Credentials ni Identity Data innecesaria. |
| EI-904 | IAM Testing deberá cubrir Lifecycle, State Transitions, Provisioning, Deprovisioning, JML, Memberships, Approvals, Expiration, Synchronization, Reconciliation, Concurrency y Privilege Escalation. |
| EI-905 | La primera implementación deberá favorecer Identity/Account Lifecycle, Provisioning, Deprovisioning, JML, Memberships, Entitlements, Access Provenance, Approvals, Expiration, Service Account Governance y Audit antes de introducir plataformas avanzadas de Identity Governance o Federation. |

---

# 338. Continuidad de Invariantes

```text
ENG-043 → EI-806 a EI-825
ENG-044 → EI-826 a EI-845
ENG-045 → EI-846 a EI-865
ENG-046 → EI-866 a EI-885
ENG-047 → EI-886 a EI-905
```

---

# 339. Criterios de Conformidad

Una implementación será conforme con ENG-047 cuando:

- modele Identity separada de Account;
- utilice IDs internos estables;
- modele Identity Source;
- controle Identity Correlation;
- modele Account State Machine;
- valide transiciones;
- implemente Provisioning;
- implemente Deprovisioning;
- revoque acceso antes del Cleanup;
- soporte Joiner-Mover-Leaver;
- evite Privilege Accumulation;
- modele Membership;
- preserve Multi-Tenant Isolation;
- separe Group de Role;
- modele Entitlement;
- conserve Access Provenance;
- permita explicar Effective Access;
- modele Access Requests;
- separe Approval de Fulfillment;
- soporte Expiration;
- gobierne Privileged Access;
- detecte Dormant Accounts;
- detecte Orphan Accounts;
- gobierne Service Accounts;
- permita Access Reviews cuando corresponda;
- sincronice identidades idempotentemente;
- respete Authoritative Sources;
- permita Reconciliation;
- proteja SCIM/Directory Integration;
- audite mutaciones sensibles;
- invalide estado derivado de Authorization;
- falle cerrada;
- pruebe Privilege Escalation.

---

# 340. Riesgos

Deberán evitarse especialmente:

## Identity = Account

El modelo no puede representar múltiples cuentas ni fuentes.

## Email as Primary Identity

Cambios o reutilización de Email rompen correlación.

## Duplicate Provisioning

Retries crean múltiples cuentas.

## Disable without Revocation

La cuenta aparece deshabilitada pero Tokens siguen activos.

## Delete before Revoke

Se pierde evidencia antes de cortar acceso.

## Privilege Accumulation

Cada cambio laboral agrega permisos sin remover los anteriores.

## Membership Means Full Access

Pertenecer al Tenant concede autoridad completa.

## Group = Role

Se mezclan estructura organizacional y permisos.

## Direct Assignment Everywhere

No puede explicarse ni gobernarse el acceso.

## Approval = Access

Se considera completada una solicitud aunque Provisioning falló.

## Permanent Privileged Access

Acceso crítico nunca expira ni se revisa.

## Self-Approval

Un usuario aprueba su propia escalación.

## Dormant Admin

Cuenta privilegiada permanece activa sin uso.

## Orphan Service Account

No existe responsable de una identidad con acceso.

## Shared Service Account

No existe Attribution.

## Last-Write-Wins Sync

Un sistema no autoritativo sobrescribe datos válidos.

## Missing Reconciliation

Drift permanece invisible.

## Incremental Delete Assumption

Un registro ausente se interpreta incorrectamente como eliminado.

## SCIM Bypass

SCIM modifica Roles o Accounts sin Authorization.

## Cross-Tenant Membership Leak

Membership de un Tenant se reutiliza en otro.

## Stale Authorization Cache

Una revocación IAM no afecta permisos efectivos inmediatamente.

---

# 341. Relación con ENG-045

ENG-047 administra:

```text
Identity
Account
Credential Lifecycle Request
Account State
```

ENG-045 implementa:

```text
Credential Verification
Authentication
Session
Token
MFA
```

---

# 342. Relación con ENG-046

ENG-047 administra:

```text
Membership
Role Assignment
Entitlement
Access Assignment
Access Request
Access Review
```

ENG-046 evalúa:

```text
Permission
Policy
Context
Resource
Action
Authorization Decision
```

---

# 343. Relación con ENG-024

Security Engineering gobierna:

```text
identity data protection
least privilege
privileged access
audit
threat model
incident response
```

---

# 344. Relación con ENG-034

Application Engineering deberá implementar los IAM Use Cases.

---

# 345. Relación con ENG-043

Data Access deberá persistir:

```text
identities
accounts
memberships
groups
entitlements
assignments
requests
reviews
```

sin introducir decisiones de Authorization.

---

# 346. Relación con ENG-040

Scheduling deberá ejecutar Lifecycle temporal.

Ejemplos:

```text
access expiration
dormancy detection
review campaigns
scheduled leaver
reconciliation
```

---

# 347. Relación con ENG-041

Messaging deberá permitir propagar cambios IAM.

---

# 348. Relación con ENG-042

Transactions deberán preservar consistencia de mutaciones IAM críticas.

---

# 349. Relación con ENG-037

Caching deberá invalidarse cuando cambie Effective Access.

---

# 350. Relación con ENG-038

Concurrency deberá evitar:

```text
duplicate provisioning
double approval
reactivation race
deprovision race
sync conflict
```

---

# 351. Relación con ENG-039

Resilience gobernará:

```text
directory
SCIM
external provisioning
external source
```

sin mantener autoridad obsoleta indefinidamente.

---

# 352. Relación con ENG-048

ENG-048 deberá formalizar **Multi-Tenancy Engineering**.

La separación propuesta será:

```text
ENG-045 Authentication
→ establishes Principal

ENG-046 Authorization
→ determines authority

ENG-047 IAM
→ manages identities and access lifecycle

ENG-048 Multi-Tenancy
→ isolates tenant-owned runtime, data,
  configuration and resources
```

ENG-048 deberá cubrir:

```text
Tenant
Tenant Identity
Tenant Lifecycle
Tenant Context
Tenant Resolution
Tenant Isolation
Tenant Boundary
Tenant-Aware Request
Tenant-Aware Authentication
Tenant-Aware Authorization
Tenant Membership
Tenant Data
Tenant Data Isolation
Tenant Database Strategy
Shared Database
Schema per Tenant
Database per Tenant
Tenant-Aware Repository
Tenant Query Scope
Tenant Configuration
Tenant Secrets
Tenant Cache
Tenant Session
Tenant Messaging
Tenant Jobs
Tenant Storage
Tenant Files
Tenant Observability
Tenant Rate Limits
Tenant Quotas
Tenant Provisioning
Tenant Migration
Tenant Backup
Tenant Restore
Cross-Tenant Operations
Platform Administration
Tenant Testing
```

---

# 353. Principio Rector

> **MEF deberá poder responder en todo momento quién posee una identidad, qué cuentas y accesos mantiene, de dónde provienen, quién los aprobó, dentro de qué Scope son válidos, cuándo expiran y cómo serán revocados.**

---

# 354. Conclusión

**ENG-047 — Identity & Access Management Engineering** formaliza el Lifecycle administrativo de identidades y accesos dentro de MEF.

La arquitectura completa queda:

```text
                AUTHORITATIVE SOURCE
                        │
                        ▼
                 IDENTITY SOURCE
                        │
                        ▼
              IDENTITY CORRELATION
                        │
                        ▼
                     IDENTITY
                        │
                        ▼
                     ACCOUNT
                        │
           ┌────────────┼────────────┐
           │            │            │
           ▼            ▼            ▼
      MEMBERSHIP      GROUP      ENTITLEMENT
           │            │            │
           └────────────┼────────────┘
                        │
                        ▼
                ACCESS ASSIGNMENT
                        │
                        ▼
                  EFFECTIVE ACCESS
                        │
             ┌──────────┴──────────┐
             │                     │
             ▼                     ▼
       AUTHENTICATION         AUTHORIZATION
          ENG-045                ENG-046
```

El Lifecycle principal queda:

```text
JOINER
  │
  ▼
Provision
  │
  ▼
Activate
  │
  ▼
ACTIVE
  │
  ├──────────► MOVER
  │               │
  │               ▼
  │          Recalculate Access
  │               │
  │               ▼
  │            ACTIVE
  │
  ▼
LEAVER
  │
  ▼
Revoke Access
  │
  ▼
Deprovision
  │
  ▼
Retain / Archive / Delete
```

El ciclo de acceso queda:

```text
Access Request
      │
      ▼
Approval
      │
   ┌──┴──┐
   │     │
 DENY  APPROVE
   │     │
   │     ▼
   │ Provision
   │     │
   │     ▼
   │ Assignment
   │     │
   │     ▼
   │ Effective Access
   │     │
   │     ▼
   │ Expiration / Review
   │     │
   │  ┌──┴───┐
   │  │      │
   │ CERTIFY REVOKE
   │  │      │
   │  ▼      ▼
   │ Keep   Remove
   │
   ▼
 Closed
```

La reconciliación queda:

```text
Authoritative State
        │
        ▼
    Expected State
        │
        │ compare
        ▼
     Actual State
        │
        ▼
        Drift
        │
   ┌────┼─────┐
   │    │     │
   ▼    ▼     ▼
Repair Review Alert
```

Y el modelo de seguridad completo alcanza ahora:

```text
ENG-024 Security
      │
      ▼
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

ENG-047 IAM
      │
      ├── Identity Lifecycle
      ├── Account Lifecycle
      ├── Membership
      ├── Groups
      ├── Entitlements
      ├── Assignments
      ├── Access Requests
      ├── Reviews
      └── Reconciliation
```

La separación fundamental queda:

```text
Authentication
→ prove identity

Authorization
→ decide authority

IAM
→ govern identity and access lifecycle
```

La primera implementación deberá concentrarse en:

```text
Identity
IdentityProfile
IdentitySource

Account
AccountState

Membership
Group
GroupMembership

Entitlement
AccessAssignment

AccessRequest
AccessApproval

IdentityLifecycleManager
AccessAdministrationManager
ProvisioningProvider
IAMRegistry
IAMError
```

con:

```text
Stable Identity IDs
Account State Machine
Provisioning
Deprovisioning
Joiner-Mover-Leaver
Membership Lifecycle
Tenant Isolation
Groups
Entitlements
Access Provenance
Approval
Expiration
Service Account Ownership
Dormant Account Detection
Orphan Account Detection
Audit
Fail Closed
```

antes de introducir:

```text
Full SCIM Platform
Advanced Directory Federation
Enterprise Identity Governance
AI Access Recommendations
Graph Identity Governance
Complex Nested Groups
Universal Identity Broker
```

Con **ENG-047** la serie global alcanza:

```text
EI-905
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
- ENG-048 — Multi-Tenancy Engineering
```