---
id: ENG-024
titulo: Security Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Security Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-002
  - ENG-003
  - ENG-004
  - ENG-005
  - ENG-006
  - ENG-007
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-022
  - ENG-023
  - ARQ-004
  - ARQ-006
  - ARQ-007
  - ARQ-008
  - ARQ-011
  - ARQ-012
  - ARQ-014
  - ARQ-016
relacionados:
  - ENG-025
  - ENG-026
  - ENG-027
keywords:
  - security
  - authentication
  - authorization
  - identity
  - permissions
  - capabilities
  - trust
  - secrets
  - encryption
  - audit
  - supply chain
  - package integrity
  - threat modeling
  - secure defaults
  - least privilege
  - zero trust
  - mef
---

# ENG-024

# Security Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería de Seguridad de **MEF (Modular Enterprise Framework)**.

Security Engineering deberá proteger:

```text
Runtime
Modules
Packages
Contracts
Registry
Container
Event Bus
Configuration
Secrets
Data
Build
Release
Tooling
```

contra:

```text
unauthorized access
privilege escalation
spoofing
tampering
information disclosure
unsafe execution
malicious packages
supply-chain compromise
configuration abuse
secret leakage
```

La arquitectura fundamental será:

```text
Actor / Component
        │
        ▼
     Identity
        │
        ▼
 Authentication
        │
        ▼
 Authorization
        │
        ▼
     Policy
        │
        ▼
    Capability
        │
        ▼
     Resource
        │
        ▼
      Audit
```

---

# 2. Declaración

La regla fundamental será:

> **Ningún Actor, Module, Package, Service, Handler o componente de MEF deberá recibir confianza, acceso o capacidades superiores a las estrictamente necesarias para ejecutar su responsabilidad declarada.**

Por tanto:

```text
Identity
   ↓
Authentication
   ↓
Authorization
   ↓
Least Privilege
   ↓
Explicit Capability
   ↓
Controlled Access
```

y no:

```text
Component Loaded
      ↓
Trusted Automatically
      ↓
Access Everything
```

---

# 3. Security as Architecture

Security no deberá implementarse únicamente como middleware periférico.

Deberá formar parte de:

```text
Architecture
Engineering
Build
Runtime
Testing
Release
Operations
```

---

# 4. Security Objectives

MEF deberá proteger:

```text
Confidentiality
Integrity
Availability
Authenticity
Authorization
Accountability
Traceability
```

---

# 5. Confidentiality

Información protegida solo deberá ser accesible por Subjects autorizados.

---

# 6. Integrity

Datos, código, Contracts y Runtime State deberán protegerse contra modificación no autorizada.

---

# 7. Availability

Los mecanismos de seguridad deberán contribuir a mantener el sistema disponible frente a abuso y fallos.

---

# 8. Authenticity

El Runtime deberá poder establecer cuando sea necesario la identidad/origen de:

```text
users
services
modules
packages
publishers
administrative operations
```

---

# 9. Accountability

Acciones relevantes deberán poder atribuirse a una identidad o contexto confiable.

---

# 10. Traceability

Las decisiones relevantes de Security deberán poder diagnosticarse y auditarse.

---

# 11. Security Model

El modelo conceptual será:

```text
Subject
   │
   ▼
Identity
   │
   ▼
Principal
   │
   ▼
Policy Decision
   │
   ├── Allow
   └── Deny
          │
          ▼
       Resource
```

---

# 12. Subject

Un Subject es una entidad que intenta ejecutar una acción.

Puede ser:

```text
User
Service
Module
Package
Process
Worker
CLI Actor
External System
```

---

# 13. Identity

Identity representa quién es el Subject.

---

# 14. Principal

Principal representa una identidad autenticada utilizada por el sistema para tomar decisiones de autorización.

---

# 15. Authentication

Authentication responde:

```text
Who are you?
```

---

# 16. Authorization

Authorization responde:

```text
What are you allowed to do?
```

---

# 17. Authentication ≠ Authorization

Un Subject autenticado no deberá considerarse automáticamente autorizado.

---

# 18. Security Context

MEF podrá representar información de seguridad mediante:

```text
SecurityContext
├── principal
├── authentication
├── permissions
├── capabilities
├── tenant
├── trustLevel
├── correlationId
└── metadata
```

---

# 19. Security Context Immutability

El Security Context no deberá ser modificado arbitrariamente por código no autorizado.

---

# 20. Trusted Context Creation

Solo infraestructura autorizada deberá crear Contexts considerados confiables.

---

# 21. Context Propagation

Cuando una operación genere otra operación, deberá definirse si el Security Context:

```text
propagates
transforms
is replaced
is dropped
```

---

# 22. No Implicit Context

No deberá asumirse que un Context HTTP original existe dentro de:

```text
background workers
async handlers
scheduled jobs
CLI
```

---

# 23. Identity Types

MEF podrá distinguir:

```text
Human Identity
Service Identity
Module Identity
System Identity
Anonymous Identity
```

---

# 24. Human Identity

Representa un usuario humano autenticado.

---

# 25. Service Identity

Representa un servicio o proceso.

---

# 26. Module Identity

Representa un Module reconocido por Runtime.

---

# 27. System Identity

Representa una operación interna privilegiada controlada.

---

# 28. Anonymous Identity

Representa ausencia explícita de autenticación.

No deberá confundirse con System Identity.

---

# 29. Identity Stability

Las identidades deberán utilizar identificadores estables cuando formen parte de Audit o Authorization.

---

# 30. Display Name

No deberá utilizarse como identificador de seguridad principal.

---

# 31. Authentication Mechanisms

MEF deberá permanecer neutral respecto a mecanismos concretos.

Adapters podrán utilizar:

```text
password
session
token
certificate
API key
OIDC
OAuth
mTLS
platform identity
```

---

# 32. Authentication Contract

El Core deberá depender de una abstracción, no del mecanismo concreto.

---

# 33. Authentication Result

Conceptualmente:

```text
AuthenticationResult
├── authenticated
├── principal
├── method
├── assurance
└── metadata
```

---

# 34. Authentication Failure

Deberá utilizar ENG-023.

---

# 35. Credential Validation

Credentials deberán validarse exclusivamente mediante componentes autorizados.

---

# 36. Password Handling

Si un Implementation Profile maneja Passwords deberá:

```text
never store plaintext
use approved password hashing
use unique salts where applicable
protect reset flows
avoid password logging
```

---

# 37. Password Hashing

No deberán utilizarse hashes rápidos genéricos para almacenamiento de Passwords.

Ejemplos que no deberán utilizarse directamente:

```text
MD5
SHA-1
SHA-256(password)
```

---

# 38. Password Hashing Algorithms

El Implementation Profile deberá utilizar algoritmos de Password Hashing reconocidos y configurables.

Ejemplos conceptuales:

```text
Argon2id
scrypt
bcrypt
PBKDF2
```

según plataforma y Security Policy.

---

# 39. Password Comparison

Deberá realizarse mediante mecanismos seguros proporcionados por el Implementation Profile.

---

# 40. Credential Exposure

Credentials nunca deberán aparecer en:

```text
logs
exceptions
metrics
URLs
source control
diagnostic dumps
```

---

# 41. Tokens

Los Tokens deberán tratarse como Secrets cuando otorguen acceso.

---

# 42. Token Lifetime

Deberán tener Lifetime apropiado al riesgo.

---

# 43. Token Revocation

Cuando el modelo lo requiera deberá existir estrategia de revocación.

---

# 44. Token Validation

Deberá validar cuando corresponda:

```text
signature
issuer
audience
expiration
not-before
scope
```

---

# 45. Authorization Model

La arquitectura base será:

```text
Principal
    │
    ▼
 Requested Action
    │
    ▼
 Resource
    │
    ▼
 Authorization Policy
    │
    ├── Allow
    └── Deny
```

---

# 46. Authorization Decision

Deberá ser explícita.

---

# 47. Default Deny

Cuando una acción requiera Authorization:

```text
no explicit allow
→ deny
```

---

# 48. Least Privilege

Todo Subject deberá recibir únicamente los permisos/capacidades necesarios.

---

# 49. Privilege Minimization

Los privilegios deberán reducirse tanto en:

```text
scope
duration
resources
operations
```

como sea razonablemente posible.

---

# 50. Permission

Una Permission representa autorización para ejecutar una operación.

Ejemplo conceptual:

```text
customer.read
customer.create
module.activate
event.publish
```

---

# 51. Capability

Una Capability representa una capacidad explícita concedida a un componente.

---

# 52. Permission vs Capability

Conceptualmente:

```text
Permission
→ policy statement about allowed action

Capability
→ explicit authority/token/reference enabling action
```

---

# 53. Capability-Based Access

MEF debería favorecer interfaces estrechas que entreguen únicamente las capacidades requeridas.

Ejemplo:

```text
EventPublisher
```

en lugar de:

```text
FullRuntime
```

---

# 54. No God Context

No deberá entregarse universalmente un objeto:

```text
Application
Runtime
Container
Kernel
```

que permita acceder a todos los recursos.

---

# 55. Roles

Roles podrán agrupar Permissions.

---

# 56. Role Is Not Permission

Los Components deberían depender de Permissions/Capabilities cuando sea posible, no de nombres rígidos de Roles.

---

# 57. RBAC

Role-Based Access Control podrá utilizarse como Policy Model.

---

# 58. ABAC

Attribute-Based Access Control podrá utilizar:

```text
principal attributes
resource attributes
environment
operation
```

---

# 59. Policy Independence

MEF no deberá imponer universalmente RBAC o ABAC.

---

# 60. Policy Decision Point

Podrá existir:

```text
AuthorizationService
```

como punto de decisión.

---

# 61. Policy Enforcement Point

El componente que protege el Resource deberá aplicar la decisión.

---

# 62. Decision vs Enforcement

Deberán distinguirse:

```text
PDP
→ decides

PEP
→ enforces
```

---

# 63. Authorization Bypass

No deberá existir una ruta alternativa que acceda al mismo Resource evitando Enforcement.

---

# 64. Defense in Depth

Resources críticos podrán validar Authorization en más de una frontera cuando existan diferentes Trust Boundaries.

---

# 65. Trust

Trust deberá ser explícito y limitado.

---

# 66. Trust Boundary

Una Trust Boundary existe cuando datos/código atraviesan entre zonas con niveles diferentes de confianza.

Ejemplos:

```text
Internet → HTTP Adapter
External Package → Runtime
Module → Framework Core
Event Broker → Consumer
CLI User → Administrative Command
```

---

# 67. Boundary Validation

Todo dato que cruza una Trust Boundary deberá tratarse como no confiable hasta ser validado.

---

# 68. Never Trust Input

Input externo no deberá utilizarse directamente para:

```text
SQL
shell
file paths
template execution
dynamic code
authorization decisions
```

---

# 69. Input Validation

Deberá validar:

```text
type
format
length
range
structure
semantics
```

según contexto.

---

# 70. Allowlist

Para Inputs de dominio limitado deberá favorecerse Allowlist.

---

# 71. Denylist

No deberá considerarse suficiente como única defensa para Inputs estructurados peligrosos.

---

# 72. Output Encoding

Cuando datos no confiables se inserten en un contexto de salida deberán codificarse apropiadamente.

---

# 73. Context-Specific Encoding

La codificación deberá corresponder al destino:

```text
HTML
JavaScript
URL
SQL
shell
JSON
```

---

# 74. Parameterization

Consultas a almacenamiento deberán utilizar Parameterization cuando la tecnología lo permita.

---

# 75. SQL Injection

No deberá construirse SQL mediante concatenación directa de Inputs no confiables.

---

# 76. Command Injection

No deberán construirse comandos de sistema concatenando Input no confiable.

---

# 77. Path Traversal

Operaciones de filesystem deberán normalizar y restringir Paths.

---

# 78. Dynamic Code Execution

Funciones equivalentes a:

```text
eval
exec
dynamic include
runtime compilation
```

deberán evitarse con Input no confiable.

---

# 79. Deserialization

Datos serializados no confiables deberán tratarse como riesgo.

---

# 80. Unsafe Deserialization

No deberá permitirse construcción arbitraria de objetos ejecutables desde Input externo.

---

# 81. File Uploads

Cuando un Adapter permita Upload deberá validar:

```text
size
type
extension
content
destination
authorization
```

según riesgo.

---

# 82. File Name

El nombre proporcionado por usuario no deberá utilizarse como Path confiable.

---

# 83. Secrets

Un Secret es información cuya exposición permite o facilita acceso no autorizado.

Ejemplos:

```text
password
API key
private key
access token
database credential
encryption key
```

---

# 84. Secret Storage

Secrets no deberán almacenarse en:

```text
source code
repository
package manifest
logs
public configuration
```

---

# 85. Secret Provider

MEF deberá permitir abstracción:

```text
SecretProvider
```

---

# 86. Secret Retrieval

Los Components deberán solicitar Secrets necesarios mediante mecanismo gobernado.

---

# 87. Secret Scope

Un Module no deberá poder leer todos los Secrets globales.

---

# 88. Secret Naming

Los Secrets deberán poseer nombres estables y no contener el valor en el identificador.

---

# 89. Secret Rotation

La arquitectura deberá permitir Rotation sin modificar código.

---

# 90. Secret Revocation

Deberá poder revocarse una Credential comprometida.

---

# 91. Secret Lifetime

Secrets temporales deberán preferirse cuando la plataforma lo permita.

---

# 92. Secret Caching

Si se cachean Secrets deberá definirse:

```text
lifetime
memory protection
rotation behavior
invalidation
```

---

# 93. Secret Logging

Deberá aplicarse Redaction.

---

# 94. Secret Error Handling

ENG-023 no deberá incluir el valor del Secret en Context/Cause.

---

# 95. Configuration vs Secrets

ENG-011 deberá distinguir:

```text
Configuration
```

de:

```text
Secret
```

---

# 96. Environment Variables

Podrán transportar Secrets, pero no deberán considerarse un Secret Store universalmente seguro por sí mismas.

---

# 97. Cryptography

MEF no deberá implementar primitivas criptográficas propias.

---

# 98. Approved Cryptography

Deberán utilizarse Libraries/Providers reconocidos por el Implementation Profile.

---

# 99. Encryption at Rest

Datos sensibles persistentes podrán requerir Encryption según Threat Model.

---

# 100. Encryption in Transit

Comunicación a través de redes no confiables deberá utilizar transporte protegido apropiado.

---

# 101. Key Management

Las claves deberán administrarse separadamente de los datos cifrados cuando sea posible.

---

# 102. Key Rotation

La arquitectura deberá permitir Rotation.

---

# 103. Key IDs

Los datos cifrados podrán referenciar qué Key Version se utilizó.

---

# 104. Cryptographic Agility

La arquitectura deberá permitir reemplazar Algorithms/Providers sin reescribir Domain Logic.

---

# 105. Randomness

Security Tokens deberán utilizar CSPRNG del sistema/plataforma.

---

# 106. Predictable IDs

Identificadores utilizados como Security Tokens no deberán ser predecibles.

---

# 107. Hashing

Hashing y Encryption no deberán confundirse.

---

# 108. Digital Signatures

Podrán utilizarse para comprobar:

```text
authenticity
integrity
origin
```

---

# 109. Package Security

ENG-013 deberá integrarse con Security Engineering.

---

# 110. Package Trust

Un Package instalado no deberá considerarse automáticamente confiable por existir en Repository.

---

# 111. Package Provenance

Cuando sea posible deberá conocerse:

```text
source
publisher
version
integrity
signature
```

---

# 112. Package Integrity

El Package Manager deberá poder verificar Integrity antes de instalación/ejecución.

---

# 113. Package Hash

Un Hash criptográfico podrá verificar integridad del artefacto.

---

# 114. Package Signature

Una Signature podrá verificar integridad y autenticidad del Publisher cuando exista infraestructura de confianza.

---

# 115. Unsigned Package

La Policy deberá decidir si:

```text
reject
warn
allow in development
```

---

# 116. Production Package Policy

Production debería utilizar reglas más estrictas que Development.

---

# 117. Dependency Security

Las dependencias deberán ser inventariables.

---

# 118. Transitive Dependency

El riesgo de dependencias transitivas deberá considerarse.

---

# 119. Dependency Pinning

ENG-013 deberá definir cuándo utilizar versiones resueltas reproducibles.

---

# 120. Lock File Integrity

El Lock File deberá tratarse como parte relevante del Supply Chain.

---

# 121. Dependency Confusion

Los Namespaces internos deberán diseñarse para reducir riesgo de Dependency Confusion.

---

# 122. Typosquatting

Tooling podrá detectar Packages con nombres sospechosamente similares.

---

# 123. Vulnerability Scanning

Build/CI deberá poder analizar dependencias conocidas como vulnerables.

---

# 124. Vulnerability Severity

La política deberá considerar:

```text
severity
exploitability
reachability
environment
available fix
```

---

# 125. Vulnerability Gate

Una vulnerabilidad crítica explotable podrá bloquear Release conforme Policy.

---

# 126. SBOM

MEF debería permitir generar **Software Bill of Materials**.

---

# 127. SBOM Contents

Podrá incluir:

```text
packages
versions
licenses
checksums
dependencies
```

---

# 128. Build Security

ENG-012 deberá tratar Build como Trust Boundary.

---

# 129. Build Environment

Deberá minimizar:

```text
credentials
network access
privileges
persistent state
```

cuando sea posible.

---

# 130. Build Reproducibility

Builds reproducibles facilitan detectar manipulación.

---

# 131. Build Artifact Integrity

Los Artifacts deberán poder verificarse.

---

# 132. Build Secrets

Los Secrets de CI no deberán incorporarse al Artifact final.

---

# 133. Build Logs

No deberán exponer Secrets.

---

# 134. Build Scripts

Scripts ejecutados durante instalación/build constituyen código ejecutable y deberán tratarse como riesgo.

---

# 135. Package Install Scripts

No deberán obtener privilegios adicionales automáticamente.

---

# 136. Release Security

ENG-017 deberá incorporar Security Gates.

---

# 137. Release Artifact

Deberá corresponder al Source/Build aprobado.

---

# 138. Release Signing

Podrá utilizarse Artifact Signing cuando la infraestructura lo soporte.

---

# 139. Release Provenance

Podrá conservar:

```text
source revision
build identity
build timestamp
dependencies
artifact hash
signature
```

---

# 140. Compromised Release

Deberá existir procedimiento para:

```text
revoke
withdraw
replace
notify
```

cuando aplique.

---

# 141. Module Security

Cada Module deberá considerarse una unidad de privilegios.

---

# 142. Module Identity

Todo Module cargado deberá poseer identidad arquitectónica válida.

---

# 143. Module Capabilities

El Manifest podrá declarar capacidades requeridas.

Ejemplo conceptual:

```yaml
security:
  capabilities:
    - event.publish.customer
    - secret.read.mail
```

---

# 144. Capability Declaration

Declarar una Capability no significa obtenerla automáticamente.

---

# 145. Capability Grant

Runtime/Policy deberá decidir si se concede.

---

# 146. Undeclared Capability

Un Module no deberá obtener capacidades no declaradas salvo mecanismo explícitamente privilegiado.

---

# 147. Excessive Capability

Tooling debería detectar permisos innecesariamente amplios cuando sea posible.

---

# 148. Module Isolation

La primera implementación puede no ofrecer aislamiento fuerte de proceso.

Esto deberá documentarse claramente.

---

# 149. Logical Isolation

Aunque Modules compartan proceso deberán respetarse fronteras lógicas.

---

# 150. Process Isolation

Versiones futuras podrán ejecutar Modules en procesos separados.

---

# 151. Sandbox

Un Sandbox podrá limitar:

```text
filesystem
network
process execution
memory
CPU
APIs
```

---

# 152. Sandbox Is Not Initial Requirement

No deberá afirmarse aislamiento fuerte si únicamente existe separación lógica.

---

# 153. Container Security

ENG-019 deberá aplicar Visibility y Capabilities.

---

# 154. Container Access

Un Module no debería recibir acceso completo al Service Container.

---

# 155. Service Visibility

Un Service privado no deberá resolverse desde Modules no autorizados.

---

# 156. Service Capability

Servicios sensibles podrán requerir Capability explícita.

---

# 157. DI Security

ENG-018 no deberá convertirse en bypass de Authorization.

---

# 158. Injection Does Not Grant Unlimited Authority

Una dependencia inyectada deberá exponer únicamente la autoridad requerida.

---

# 159. Registry Security

ENG-020 deberá proteger metadata sensible y operaciones de mutación.

---

# 160. Registry Read

No todo Module necesita acceso a todo Registry.

---

# 161. Registry Write

La mutación deberá restringirse especialmente.

---

# 162. Registry Spoofing

Un Module no deberá registrar Entries haciéndose pasar por otro Owner.

---

# 163. Registry Freeze

Después de Bootstrap, la inmutabilidad reduce superficie de ataque.

---

# 164. Contract Security

ENG-021 deberá proteger Contracts contra:

```text
spoofing
unauthorized replacement
schema manipulation
version downgrade
```

---

# 165. Contract Owner

Solo Owner autorizado deberá publicar/modificar un Contract cuando aplique.

---

# 166. Contract Downgrade

No deberá aceptarse automáticamente una versión inferior insegura.

---

# 167. Contract Validation

Datos contractuales que crucen Trust Boundary deberán validarse.

---

# 168. Event Bus Security

ENG-022 deberá aplicar:

```text
publisher authorization
subscriber authorization
event visibility
payload validation
trusted metadata
```

---

# 169. Event Publisher Identity

La identidad del Publisher no deberá confiarse únicamente al Payload.

---

# 170. Event Spoofing

Un Module no deberá poder publicar:

```text
producer: MOD-PAYMENTS
```

si no posee dicha identidad.

---

# 171. Event Authorization

Podrá existir Permission:

```text
event.publish.<event>
event.subscribe.<event>
```

---

# 172. Sensitive Event

Un Event sensible podrá requerir Consumers explícitamente autorizados.

---

# 173. Event Payload

Deberá aplicar Data Minimization.

---

# 174. Event Replay

Deberá distinguirse:

```text
authorized replay
malicious replay
```

---

# 175. Replay Protection

Cuando sea requerido podrá utilizar:

```text
nonce
timestamp
eventId
deduplication
signature
```

según Threat Model.

---

# 176. Async Security Context

No deberá serializarse indiscriminadamente todo Security Context dentro de un Event.

---

# 177. Delegation

Una operación asíncrona podrá necesitar identidad delegada limitada.

---

# 178. Delegated Authority

Deberá ser:

```text
explicit
scoped
time-limited
auditable
```

cuando aplique.

---

# 179. Confused Deputy

MEF deberá evitar que un componente privilegiado ejecute una acción en nombre de otro sin validar Authority.

---

# 180. Privilege Escalation

Toda transición hacia mayores privilegios deberá ser explícita, gobernada y auditable.

---

# 181. System Privilege

`System` no deberá utilizarse como bypass general de Authorization.

---

# 182. Administrative Operations

Operaciones administrativas deberán requerir privilegios específicos.

Ejemplos:

```text
module.install
module.activate
package.trust
security.policy.modify
secret.rotate
```

---

# 183. CLI Security

ENG-007 deberá tratar comandos administrativos como operaciones privilegiadas.

---

# 184. CLI Authentication

Podrá depender de identidad del sistema operativo, Token u otro Adapter.

---

# 185. CLI Authorization

Un usuario con acceso al ejecutable no deberá considerarse automáticamente autorizado a todas las operaciones remotas/administrativas.

---

# 186. Destructive Commands

Deberán aplicar protecciones adicionales cuando corresponda.

---

# 187. Configuration Security

ENG-011 deberá proteger Configuration sensible.

---

# 188. Security Configuration

Ejemplo conceptual:

```yaml
security:
  defaultPolicy: deny
  audit: true
  packageVerification: required
```

---

# 189. Secure Defaults

La Configuration por defecto deberá favorecer seguridad.

---

# 190. Fail Secure

Cuando una decisión de Authorization no pueda evaluarse de forma confiable, deberá preferirse Deny.

---

# 191. Fail Open

Solo podrá utilizarse mediante Policy explícita y justificada.

---

# 192. Missing Security Configuration

No deberá producir privilegios ilimitados por accidente.

---

# 193. Development Security

Development podrá flexibilizar ciertas restricciones.

Deberá hacerlo explícitamente.

---

# 194. Production Security

Production deberá activar políticas más estrictas.

---

# 195. Environment Detection

No deberá confiarse exclusivamente en datos controlables por Request para decidir Security Mode.

---

# 196. Error Security

ENG-023 deberá prevenir Information Disclosure.

---

# 197. Authentication Failure Message

Deberá evitar revelar innecesariamente:

```text
account exists
password correct but MFA failed
internal provider
database structure
```

cuando incremente riesgo.

---

# 198. Authorization Failure

No deberá revelar metadata sensible del Resource.

---

# 199. Security Exception

Podrá poseer detalles internos diferentes del Public Error.

---

# 200. Audit

Security Audit deberá registrar eventos relevantes de forma estructurada.

---

# 201. Audit vs Logging

Deberán distinguirse:

```text
Logging
→ operational diagnostics

Audit
→ accountability/security record
```

---

# 202. Audit Event

Ejemplos:

```text
authentication.success
authentication.failure
authorization.denied
privilege.granted
module.installed
module.activated
package.signature.failed
secret.rotated
security.policy.changed
```

---

# 203. Audit Record

Podrá contener:

```text
timestamp
actor
action
resource
result
correlationId
source
metadata
```

---

# 204. Audit Integrity

Los Audit Records deberán protegerse contra modificación no autorizada.

---

# 205. Audit Access

El acceso al Audit deberá restringirse.

---

# 206. Audit Secrets

Audit no deberá contener Secrets.

---

# 207. Audit Failure

La política deberá definir qué ocurre si no puede escribirse un Audit crítico.

---

# 208. Audit Availability

Para determinadas operaciones críticas podría requerirse:

```text
audit unavailable
→ deny operation
```

---

# 209. Audit Retention

Deberá definirse según requisitos operacionales/regulatorios del Implementation.

---

# 210. Audit Time

Los registros deberán utilizar una fuente temporal suficientemente confiable para su propósito.

---

# 211. Security Logging

ENG-010 deberá soportar categorías de Security.

---

# 212. Security Log

Podrá incluir:

```text
security.authentication
security.authorization
security.integrity
security.package
security.runtime
```

---

# 213. Security Metrics

Podrán incluir:

```text
authentication_failures_total
authorization_denials_total
invalid_tokens_total
package_verification_failures_total
security_policy_violations_total
```

---

# 214. Metric Privacy

Labels no deberán incluir:

```text
password
token
personal data
arbitrary user input
```

---

# 215. Alerting

Eventos críticos podrán generar Alerts.

---

# 216. Alert Examples

```text
repeated privilege escalation attempts
package integrity failure
security configuration changed
multiple authentication failures
unexpected module signature
```

---

# 217. Security Event Correlation

Correlation podrá relacionar múltiples indicadores.

---

# 218. Threat Modeling

Features relevantes deberán someterse a Threat Modeling proporcional al riesgo.

---

# 219. Threat Model

Deberá identificar:

```text
assets
actors
entry points
trust boundaries
threats
controls
residual risk
```

---

# 220. STRIDE

Podrá utilizarse metodología como:

```text
Spoofing
Tampering
Repudiation
Information Disclosure
Denial of Service
Elevation of Privilege
```

---

# 221. Method Independence

MEF no deberá depender exclusivamente de STRIDE.

---

# 222. Threat Modeling Timing

Deberá realizarse antes de implementar cambios de alto riesgo cuando sea posible.

---

# 223. Threat Model Update

Cambios arquitectónicos deberán provocar revisión cuando modifiquen Trust Boundaries.

---

# 224. Attack Surface

Cada Feature deberá minimizar superficie expuesta.

---

# 225. Unused Feature

Una capacidad innecesaria debería poder deshabilitarse.

---

# 226. Network Exposure

Servicios no destinados a acceso externo no deberán exponerse externamente por defecto.

---

# 227. Administrative Interface

Deberá recibir protección reforzada.

---

# 228. Rate Limiting

Boundaries expuestas podrán aplicar Rate Limits.

---

# 229. Resource Limits

Deberán existir límites razonables para Inputs potencialmente costosos.

Ejemplos:

```text
request size
file size
event size
collection size
recursion depth
```

---

# 230. Denial of Service

Security Engineering deberá considerar agotamiento de:

```text
CPU
memory
disk
connections
threads
queues
```

---

# 231. Backpressure

ENG-022 deberá colaborar para evitar saturación del Event Bus.

---

# 232. Timeouts

Operaciones externas deberán poseer Timeouts apropiados.

---

# 233. Security Testing

ENG-009 deberá incluir Security Tests.

---

# 234. Authentication Tests

Deberán cubrir:

```text
valid credentials
invalid credentials
expired credentials
revoked credentials
malformed credentials
```

---

# 235. Authorization Tests

Deberán cubrir:

```text
allowed
denied
missing permission
wrong resource
privilege escalation
```

---

# 236. Default Deny Test

Una acción no declarada deberá ser rechazada.

---

# 237. Input Validation Tests

Deberán probar Inputs:

```text
malformed
oversized
unexpected
boundary values
```

---

# 238. Injection Tests

Adapters relevantes deberán probar:

```text
SQL injection
command injection
path traversal
template injection
```

---

# 239. Secret Exposure Tests

Deberán verificar ausencia de Secrets en:

```text
logs
errors
responses
build artifacts
```

---

# 240. Event Security Tests

Deberán cubrir:

```text
unauthorized publisher
unauthorized subscriber
spoofed producer
malformed payload
replay
```

---

# 241. Package Security Tests

Deberán cubrir:

```text
invalid checksum
invalid signature
unknown publisher
tampered package
```

cuando esas capacidades existan.

---

# 242. Security Regression

Una vulnerabilidad corregida debería recibir Regression Test cuando sea razonable.

---

# 243. Static Analysis

Build podrá utilizar:

```text
SAST
secret scanning
dependency scanning
configuration scanning
```

---

# 244. Dynamic Analysis

Versiones posteriores podrán incorporar:

```text
DAST
fuzzing
penetration testing
```

---

# 245. Fuzzing

Parsers y Boundaries de alto riesgo podrán beneficiarse de Fuzzing.

---

# 246. Penetration Testing

Releases de alto impacto podrán requerir evaluación especializada.

---

# 247. Security Review

Cambios que afecten:

```text
authentication
authorization
cryptography
package execution
secret management
trust boundaries
```

deberán recibir revisión reforzada.

---

# 248. Code Review

Código de Security crítico deberá requerir Review por otra persona cuando el proceso organizacional lo permita.

---

# 249. Dependency Review

Agregar una dependencia Security-sensitive deberá justificar necesidad y mantenimiento.

---

# 250. Minimal Dependencies

Reducir dependencias innecesarias reduce Supply Chain Risk.

---

# 251. Secure Coding

Las Implementations deberán seguir prácticas seguras del lenguaje/plataforma.

---

# 252. Memory Safety

Cuando el Implementation Profile utilice lenguajes sin Memory Safety deberán considerarse controles adicionales.

---

# 253. Type Safety

Los tipos deberán utilizarse para reducir estados inválidos cuando sea posible.

---

# 254. Race Conditions

Operaciones Security-sensitive deberán considerar concurrencia.

---

# 255. TOCTOU

Deberán considerarse vulnerabilidades:

```text
Time Of Check
→ Time Of Use
```

especialmente en filesystem y autorización mutable.

---

# 256. Canonicalization

Paths, identifiers y URLs deberán normalizarse antes de decisiones de Security cuando corresponda.

---

# 257. Unicode Security

Identificadores sensibles podrán requerir normalización para evitar confusables/homographs.

---

# 258. Redirects

Adapters Web deberán validar Redirect destinations.

---

# 259. CSRF

Interfaces Web basadas en sesiones deberán implementar protección apropiada contra Cross-Site Request Forgery.

---

# 260. XSS

Outputs Web deberán protegerse contra Cross-Site Scripting.

---

# 261. CORS

No deberá configurarse:

```text
allow everything
```

por defecto.

---

# 262. Security Headers

Adapters HTTP podrán establecer headers apropiados según Application Profile.

---

# 263. Session Security

Cuando existan Sessions deberán proteger:

```text
session identifier
expiration
rotation
logout
cookie attributes
```

---

# 264. Session Fixation

Deberá prevenirse mediante Rotation cuando cambie Authentication State.

---

# 265. MFA

MEF deberá permitir Authentication Factors adicionales sin acoplar Core a un Provider específico.

---

# 266. Step-Up Authentication

Operaciones de alto riesgo podrán requerir Assurance superior.

---

# 267. Authentication Assurance

El Security Context podrá indicar nivel/método de Authentication.

---

# 268. Tenant Isolation

Si una Application es Multi-Tenant deberá tratar Tenant como frontera de autorización.

---

# 269. Tenant ID

No deberá confiarse únicamente en un identificador enviado por el usuario.

---

# 270. Cross-Tenant Access

Deberá rechazarse salvo privilegio explícito.

---

# 271. Data Classification

Applications podrán clasificar información:

```text
public
internal
confidential
restricted
```

---

# 272. Classification Policy

La clasificación podrá afectar:

```text
access
logging
encryption
retention
event propagation
```

---

# 273. Privacy

Security Engineering deberá facilitar Data Minimization y protección de información personal.

---

# 274. Data Minimization

Components deberán recibir solo los datos necesarios.

---

# 275. Data Retention

Información sensible no deberá conservarse indefinidamente sin propósito.

---

# 276. Data Deletion

Applications podrán requerir mecanismos de eliminación conforme sus obligaciones.

---

# 277. Backup Security

Backups deberán recibir protección equivalente a los datos que contienen.

---

# 278. Test Data

Production Secrets/Data no deberán copiarse indiscriminadamente a entornos de Test.

---

# 279. Debugging

Debug Mode no deberá habilitarse en Production por defecto.

---

# 280. Diagnostic Endpoints

Deberán protegerse.

---

# 281. Health Endpoint

No deberá exponer información sensible innecesaria.

---

# 282. Version Disclosure

La exposición de versiones internas deberá minimizarse cuando no sea necesaria.

---

# 283. Security Update

Dependencias vulnerables deberán poder actualizarse sin romper innecesariamente Contracts.

---

# 284. Compatibility vs Security

ENG-016 no deberá impedir una corrección crítica de seguridad.

---

# 285. Emergency Security Change

Podrá requerirse cambio incompatible para mitigar riesgo crítico.

---

# 286. Security Exception to Compatibility

Deberá:

```text
document risk
document rationale
provide migration when possible
communicate clearly
```

---

# 287. Vulnerability Handling

El proyecto deberá disponer de proceso para:

```text
receive
triage
validate
fix
test
release
disclose
```

vulnerabilidades.

---

# 288. Responsible Disclosure

Podrá existir canal privado para reportes.

---

# 289. Vulnerability Information

No deberá divulgarse prematuramente información que incremente riesgo antes de mitigación cuando corresponda.

---

# 290. Incident Response

Security Architecture deberá facilitar:

```text
detection
containment
eradication
recovery
postmortem
```

---

# 291. Compromised Credential

Deberá poder:

```text
revoke
rotate
audit
identify affected scope
```

---

# 292. Compromised Package

Deberá poder:

```text
block
remove
quarantine
identify installations
replace
```

---

# 293. Compromised Module

Runtime deberá poder impedir Activation.

---

# 294. Security State

Un componente podrá quedar:

```text
QUARANTINED
```

si ENG-015 formaliza ese State.

---

# 295. No Invented State

ENG-024 no deberá introducir unilateralmente nuevos estados del State Machine.

---

# 296. Quarantine Capability

Si `QUARANTINED` no existe en ENG-015, deberá modelarse mediante Policy/Status existente hasta formalización.

---

# 297. Security Policy

Podrá existir:

```text
SecurityPolicy
```

como Contract interno estable.

---

# 298. Policy Examples

```text
PackageVerificationPolicy
AuthorizationPolicy
SecretPolicy
AuditPolicy
CryptographyPolicy
```

---

# 299. Policy Configuration

Policies podrán parametrizarse mediante ENG-011.

---

# 300. Policy Code

Las decisiones Security-critical no deberán depender únicamente de Configuration textual sin validación.

---

# 301. Policy Validation

Policies deberán validarse durante Bootstrap.

---

# 302. Invalid Security Policy

Deberá impedir Activation cuando comprometa garantías requeridas.

---

# 303. Policy Versioning

Policies persistidas/distribuidas podrán requerir Versioning.

---

# 304. Policy Ownership

Toda Policy deberá tener Owner.

---

# 305. Security Registry

ENG-020 podrá registrar metadata como:

```text
permissions
capabilities
security policies
trusted publishers
protected resources
```

---

# 306. Registry Is Not Authorization Engine

Registry describe metadata.

Authorization Service toma decisiones.

---

# 307. Permission Registry

Podrá detectar:

```text
duplicate permissions
unknown permissions
undeclared capabilities
```

---

# 308. Capability Registry

Podrá registrar capacidades disponibles.

---

# 309. Security Bootstrap

Secuencia conceptual:

```text
Configuration
      ↓
Security Policy Load
      ↓
Package Verification
      ↓
Manifest Validation
      ↓
Registry Build
      ↓
Permission/Capability Validation
      ↓
Container Build
      ↓
Event Security Validation
      ↓
Module Security Validation
      ↓
Activation
```

---

# 310. Security Before Activation

Las validaciones críticas deberán completarse antes de Activation.

---

# 311. Package Verification Timing

Deberá realizarse antes de ejecutar código del Package cuando técnicamente sea posible.

---

# 312. Chicken-and-Egg Risk

No deberá ejecutarse un Installer no confiable para descubrir si el Installer es confiable.

---

# 313. Bootstrap Privilege

Bootstrap posee privilegios elevados y deberá minimizar operaciones ejecutadas desde código no confiable.

---

# 314. Runtime Privilege

Después de Bootstrap deberían reducirse privilegios cuando sea posible.

---

# 315. Privilege Separation

Procesos posteriores podrán separar:

```text
installer
runtime
worker
administrator
```

---

# 316. Security Error Taxonomy

ENG-024 utilizará namespace:

```text
MEF-SEC-xxx
```

---

# 317. Taxonomía ENG-024

```text
MEF-SEC-001 Authentication required
MEF-SEC-002 Authentication failed
MEF-SEC-003 Invalid credential
MEF-SEC-004 Credential expired
MEF-SEC-005 Credential revoked
MEF-SEC-006 Authorization denied
MEF-SEC-007 Permission required
MEF-SEC-008 Capability required
MEF-SEC-009 Invalid security context
MEF-SEC-010 Untrusted principal
MEF-SEC-011 Security policy violation
MEF-SEC-012 Invalid security policy
MEF-SEC-013 Secret access denied
MEF-SEC-014 Secret unavailable
MEF-SEC-015 Package integrity verification failed
MEF-SEC-016 Package signature verification failed
MEF-SEC-017 Untrusted package publisher
MEF-SEC-018 Event publication denied
MEF-SEC-019 Event subscription denied
MEF-SEC-020 Event publisher spoofing detected
MEF-SEC-021 Invalid security metadata
MEF-SEC-022 Replay detected
MEF-SEC-023 Privilege escalation denied
MEF-SEC-024 Registry mutation denied
MEF-SEC-025 Protected service access denied
MEF-SEC-026 Unsafe configuration detected
MEF-SEC-027 Cryptographic operation failed
MEF-SEC-028 Audit operation failed
MEF-SEC-029 Security invariant violated
MEF-SEC-030 Runtime security validation failed
```

---

# 318. Authentication Required

```text
MEF-SEC-001

Authentication required.

Operation:
module.install
```

---

# 319. Authorization Denied

```text
MEF-SEC-006

Authorization denied.

Principal:
USR-...

Operation:
module.activate

Resource:
MOD-CUSTOMER
```

La representación pública podrá omitir campos según Policy.

---

# 320. Capability Required

```text
MEF-SEC-008

Required capability not granted.

Module:
MOD-NOTIFICATION

Capability:
event.publish.customer
```

---

# 321. Package Integrity Failure

```text
MEF-SEC-015

Package integrity verification failed.

Package:
PKG-CUSTOMER

Version:
2.1.0
```

---

# 322. Event Spoofing

```text
MEF-SEC-020

Event publisher identity mismatch detected.

Authenticated module:
MOD-CUSTOMER

Claimed producer:
MOD-PAYMENTS
```

---

# 323. Security Invariant Violation

```text
MEF-SEC-029

Security invariant violated.

Component:
ServiceContainer

Invariant:
Private service exposed outside owner module.
```

---

# 324. Security Failure Severity

Determinadas Failures deberán considerarse especialmente críticas:

```text
integrity failure
signature failure
privilege escalation
security invariant violation
trusted registry corruption
```

---

# 325. Fail Secure Runtime

Cuando no pueda determinarse de forma confiable si una operación crítica está autorizada:

```text
deny
```

deberá ser la política predeterminada.

---

# 326. Security Diagnostics

Podrán incluir:

```text
error code
principal ID
module ID
operation
resource ID
policy ID
correlation ID
timestamp
```

cuando sea seguro.

---

# 327. No Credential Diagnostics

Nunca deberán incluirse Credentials completos.

---

# 328. Audit Correlation

Security Error y Audit Record podrán compartir:

```text
correlationId
```

---

# 329. CLI Integration

ENG-007 podrá incorporar:

```text
mef security status
mef security validate
mef security permissions
mef security capabilities
mef security audit
mef security packages
```

---

# 330. `security status`

Podrá mostrar postura general sin revelar Secrets.

---

# 331. `security validate`

Podrá verificar:

```text
policies
permissions
capabilities
package integrity
configuration
registry visibility
event security
```

---

# 332. `security permissions`

Podrá inspeccionar Permissions registradas.

---

# 333. `security capabilities`

Podrá mostrar:

```text
available
required
granted
denied
```

según privilegios del Caller.

---

# 334. `security audit`

Deberá requerir autorización específica.

---

# 335. `security packages`

Podrá mostrar estado de confianza:

```text
verified
unsigned
invalid
untrusted
```

---

# 336. Machine Output

Los comandos deberán soportar salida estructurada cuando corresponda.

---

# 337. Build Integration

ENG-012 deberá poder ejecutar:

```text
security policy validation
secret scanning
dependency scanning
package integrity validation
SAST
permission validation
capability validation
```

según capacidades disponibles.

---

# 338. Security Quality Gate

El Build deberá fallar ante violaciones obligatorias.

---

# 339. Critical Vulnerability Gate

Una vulnerabilidad crítica confirmada y aplicable podrá bloquear Release.

---

# 340. Secret Gate

Secrets detectados en Source/Artifact deberán bloquear Build/Release conforme Policy.

---

# 341. Package Integrity Gate

Un Artifact cuya integridad no pueda verificarse cuando sea requerida no deberá publicarse.

---

# 342. Release Integration

ENG-017 deberá incorporar:

```text
security scan status
dependency status
artifact integrity
provenance
signature
security approvals
```

cuando aplique.

---

# 343. Security Release Notes

Cambios de Security relevantes deberán documentarse sin divulgar detalles explotables innecesarios antes de mitigación.

---

# 344. Compatibility Integration

ENG-016 deberá evaluar cambios en:

```text
permissions
capabilities
authentication requirements
authorization semantics
security defaults
```

---

# 345. Permission Removal

Eliminar una Permission pública puede constituir Breaking Change.

---

# 346. Permission Requirement Increase

Exigir un nuevo privilegio puede afectar Compatibility.

---

# 347. Security Override

Security puede justificar Breaking Change urgente.

Deberá documentarse.

---

# 348. Testing Integration

ENG-009 deberá incluir Security Suites separables.

---

# 349. Required Security Tests

La primera implementación debería cubrir como mínimo:

```text
authorization
default deny
service visibility
registry ownership
event publisher identity
event authorization
secret redaction
error sanitization
package integrity
```

---

# 350. Security Test Isolation

Los Tests no deberán depender de Production Credentials.

---

# 351. Mock Security Context

Testing podrá crear Contexts controlados explícitamente.

---

# 352. No Global Authentication Mock

Un Test no debería accidentalmente autenticar toda Suite.

---

# 353. Threat Regression

Una vulnerabilidad corregida deberá conservar prueba que demuestre la mitigación cuando sea posible.

---

# 354. Security Documentation

MEF deberá documentar:

```text
security model
trust boundaries
permission model
capability model
secret handling
package trust
reporting process
```

---

# 355. Security Assumptions

Las garantías deberán declarar sus supuestos.

Ejemplo:

```text
Modules execute in same process.
Therefore MEF provides logical isolation,
not operating-system isolation.
```

---

# 356. No False Security Claims

MEF no deberá afirmar:

```text
sandboxed
isolated
zero trust
tamper-proof
exactly secure
```

sin mecanismos reales que sustenten dichas garantías.

---

# 357. Zero Trust Principle

MEF podrá adoptar principios de Zero Trust:

```text
verify explicitly
least privilege
assume breach
```

sin utilizar el término como sustituto de controles concretos.

---

# 358. Assume Breach

La arquitectura deberá considerar que un componente puede ser comprometido.

---

# 359. Blast Radius

Capabilities y aislamiento deberán limitar impacto.

---

# 360. Security Boundaries Diagram

```text
                    UNTRUSTED
                        │
                        ▼
                ┌───────────────┐
                │ TRUST BOUNDARY│
                └───────┬───────┘
                        │
                        ▼
                  AUTHENTICATION
                        │
                        ▼
                 SECURITY CONTEXT
                        │
                        ▼
                  AUTHORIZATION
                        │
              ┌─────────┴─────────┐
              ▼                   ▼
             DENY                ALLOW
                                   │
                                   ▼
                              CAPABILITY
                                   │
                                   ▼
                                RESOURCE
                                   │
                                   ▼
                                 AUDIT
```

---

# 361. Module Security Diagram

```text
                 MODULE
                   │
                   ▼
                MANIFEST
                   │
        ┌──────────┼──────────┐
        ▼          ▼          ▼
   Permissions  Capabilities  Events
        │          │          │
        └──────────┼──────────┘
                   ▼
              VALIDATION
                   │
                   ▼
                POLICY
                   │
          ┌────────┴────────┐
          ▼                 ▼
        DENIED            GRANTED
                            │
                            ▼
                       MODULE RUNTIME
```

---

# 362. Supply Chain Diagram

```text
Source
  │
  ▼
Dependencies
  │
  ▼
Lock File
  │
  ▼
Security Scan
  │
  ▼
Build
  │
  ▼
Artifact
  │
  ├── Hash
  ├── SBOM
  ├── Provenance
  └── Signature
         │
         ▼
   Package Verification
         │
         ▼
      Installation
         │
         ▼
      Activation
```

---

# 363. Event Security Diagram

```text
Publisher
    │
    ▼
Authenticated Module Identity
    │
    ▼
Publish Authorization
    │
    ▼
Event Contract Validation
    │
    ▼
Event Bus
    │
    ▼
Subscription Authorization
    │
    ▼
Handler
```

---

# 364. Secret Flow

```text
Secret Store
     │
     ▼
Secret Provider
     │
     ▼
Authorization
     │
     ▼
Scoped Secret
     │
     ▼
Component
```

y no:

```text
.env / Global Config
        │
        ▼
Every Module
```

---

# 365. Primera Implementación Recomendada

La primera implementación de MEF deberá concentrarse en:

```text
SecurityContext
Principal
Permission
Capability

AuthorizationService
AuthorizationPolicy

SecretProvider

Module Identity
Service Visibility
Registry Ownership
Event Authorization

Package Integrity Verification

Audit Record
Security Error Codes
Security Validation
```

---

# 366. Primera Fase

Implementar:

```text
Default Deny
Least Privilege
Explicit Permissions
Explicit Capabilities
Service Visibility
Registry Ownership
Event Publisher Validation
Event Subscription Validation
Secret Redaction
Package Checksums
Security Audit
Build Security Validation
```

---

# 367. Segunda Fase

Podrá incorporar:

```text
Package Signatures
Trusted Publisher Registry
SBOM
Artifact Provenance
Secret Manager Adapters
Policy Engine
Advanced Audit
SAST Integration
Dependency Vulnerability Gates
```

---

# 368. Tercera Fase

Solo cuando exista necesidad:

```text
Process Isolation
Module Sandbox
mTLS Service Identity
Distributed Authorization
Remote Policy Engine
Hardware-backed Keys
Attestation
Signed Provenance
Advanced Supply Chain Controls
```

---

# 369. Invariantes de Ingeniería

ENG-024 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-426 | Todo acceso Security-sensitive deberá producirse dentro de una frontera donde Identity, Authority o Capability puedan evaluarse explícitamente. |
| EI-427 | Authentication y Authorization deberán mantenerse como responsabilidades conceptualmente separadas. |
| EI-428 | La ausencia de una autorización explícita deberá producir Deny cuando la operación requiera autorización. |
| EI-429 | Todo componente deberá operar con el menor conjunto razonable de privilegios y capacidades necesario para su responsabilidad. |
| EI-430 | Un Module no deberá obtener autoridad adicional únicamente por encontrarse cargado o registrado en Runtime. |
| EI-431 | Todo Input que atraviese una Trust Boundary deberá considerarse no confiable hasta ser validado. |
| EI-432 | Secrets no deberán almacenarse ni exponerse mediante Source Code, Logs, Errors o Contracts públicos. |
| EI-433 | MEF no deberá implementar primitivas criptográficas propias cuando existan Providers reconocidos del Implementation Profile. |
| EI-434 | La identidad confiable de un Module, Publisher o Principal no deberá derivarse únicamente de datos declarados por el propio Subject. |
| EI-435 | El Service Container no deberá convertirse en mecanismo para evadir Visibility, Permissions o Capabilities. |
| EI-436 | El Registry no deberá aceptar mutaciones que suplanten Ownership o Identity sin autorización. |
| EI-437 | Event Publication y Event Subscription deberán respetar Identity, Visibility y Authorization. |
| EI-438 | Un Package no deberá considerarse confiable únicamente porque pueda ser descargado o resuelto por el Package Manager. |
| EI-439 | La integridad de Artifacts y Packages deberá poder verificarse antes de su uso cuando la Security Policy lo requiera. |
| EI-440 | Los mecanismos de Audit deberán preservar Accountability sin almacenar Secrets innecesariamente. |
| EI-441 | Security Errors públicos no deberán revelar información interna que incremente innecesariamente la superficie de ataque. |
| EI-442 | Una Failure de evaluación de Authorization deberá resolverse de forma segura y no conceder privilegios accidentalmente. |
| EI-443 | Los cambios que alteren Trust Boundaries, Permissions, Capabilities o Security Defaults deberán someterse a Security Review y Compatibility Analysis. |
| EI-444 | Las garantías de aislamiento deberán corresponder a mecanismos reales y no deberán presentarse como más fuertes de lo que la implementación proporciona. |
| EI-445 | Una violación de un Security Invariant que comprometa la confianza del Runtime deberá impedir que éste continúe bajo un estado falsamente considerado seguro. |

---

# 370. Continuidad de Invariantes

```text
ENG-018 → EI-306 a EI-325
ENG-019 → EI-326 a EI-345
ENG-020 → EI-346 a EI-365
ENG-021 → EI-366 a EI-385
ENG-022 → EI-386 a EI-405
ENG-023 → EI-406 a EI-425
ENG-024 → EI-426 a EI-445
```

---

# 371. Criterios de Conformidad

Una implementación será conforme con ENG-024 cuando:

- distinga Authentication de Authorization;
- utilice Default Deny en operaciones protegidas;
- aplique Least Privilege;
- permita Permissions explícitas;
- permita Capabilities explícitas;
- represente Security Context;
- valide Trust Boundaries;
- proteja Secrets;
- evite Credential Leakage;
- utilice criptografía reconocida;
- proteja Registry;
- proteja Container;
- proteja Contracts;
- proteja Event Bus;
- permita verificar Package Integrity;
- integre Security con Build;
- integre Security con Release;
- implemente Audit;
- integre Error Handling;
- permita Security Testing;
- documente garantías reales de aislamiento.

---

# 372. Riesgos

Deberán evitarse especialmente:

## Trust by Loading

```text
Module loaded
→ Module trusted
```

## Authentication Equals Authorization

```text
authenticated
→ access everything
```

## Global Container Access

Permite evadir límites entre Modules.

## Global Secret Access

Todos los Modules pueden leer todas las Credentials.

## Self-Declared Identity

Un componente decide quién es mediante Metadata controlada por sí mismo.

## Allow by Default

Una Permission desconocida termina autorizada.

## Hardcoded Secrets

Credentials almacenadas en Source.

## Weak Password Hashing

Uso de MD5/SHA rápido para Password Storage.

## Custom Cryptography

Implementación propia de Algorithms.

## Event Spoofing

Un Publisher suplanta otro Module.

## Registry Spoofing

Un Module registra recursos como si pertenecieran a otro.

## Unsigned Equals Trusted

Un Package se considera confiable únicamente porque se instaló correctamente.

## Build Secret Leakage

CI incorpora Credentials al Artifact.

## Excessive Permissions

Un Module solicita acceso global para simplificar implementación.

## Security Through Obscurity

La protección depende únicamente de ocultar detalles.

## False Sandbox

Se afirma aislamiento fuerte cuando todos los Modules ejecutan en el mismo proceso.

## Audit as Logging

Se pierde Accountability al mezclar ambos conceptos sin garantías.

## Fail Open

Un fallo del Authorization Service concede acceso.

## Unlimited Input

Un atacante agota Resources mediante Payloads sin límites.

## Error Disclosure

Stack Traces, Paths, SQL o Secrets llegan al Consumer.

---

# 373. Relación con ENG-018

Dependency Injection deberá entregar únicamente dependencias autorizadas.

```text
Module
   │
   ▼
Dependency Request
   │
   ▼
DI
   │
   ▼
Security / Visibility
   │
   ├── Denied
   └── Allowed
          │
          ▼
       Service
```

---

# 374. Relación con ENG-019

Service Container deberá aplicar:

```text
service ownership
visibility
scope
capability requirements
```

No deberá ser un Service Locator global privilegiado.

---

# 375. Relación con ENG-020

Registry deberá conservar:

```text
identity
ownership
visibility
security metadata
```

y evitar:

```text
spoofing
unauthorized mutation
private metadata disclosure
```

---

# 376. Relación con ENG-021

Contracts deberán declarar cuando corresponda:

```text
required permissions
security semantics
data classification
visibility
trust assumptions
```

---

# 377. Relación con ENG-022

Event Bus deberá aplicar:

```text
Publisher Identity
        ↓
Publish Permission
        ↓
Event Validation
        ↓
Subscription Permission
        ↓
Handler
```

---

# 378. Relación con ENG-023

Error Handling deberá:

```text
sanitize
redact
preserve internal cause
expose safe public error
audit security failures
```

---

# 379. Relación con ENG-013

Package Manager deberá incorporar:

```text
integrity
provenance
trust
dependency security
```

---

# 380. Relación con ENG-012

Build System deberá convertirse en Security Gate para:

```text
Secrets
Dependencies
Policies
Integrity
Static Analysis
```

---

# 381. Relación con ENG-017

Release Process deberá preservar:

```text
Artifact Integrity
Security Validation
Provenance
Optional Signing
Vulnerability Status
```

---

# 382. Relación con ENG-015

Security Failures que afecten Runtime State deberán utilizar exclusivamente las transiciones formalizadas por Architectural State Machine.

---

# 383. Relación con ENG-027

Runtime deberá coordinar:

```text
Security Configuration
        ↓
Policies
        ↓
Package Trust
        ↓
Registry Security
        ↓
Container Security
        ↓
Event Security
        ↓
Module Validation
        ↓
Activation
```

---

# 384. Principio Rector

> **Security Engineering en MEF deberá asumir que toda frontera puede ser atacada, toda autoridad debe justificarse y toda confianza debe limitarse; Identity, Authorization, Capabilities, Secrets, Packages, Contracts, Events y Runtime State deberán protegerse mediante controles explícitos, verificables, auditables y proporcionales al riesgo.**

---

# 385. Conclusión

**ENG-024 — Security Engineering** establece el modelo transversal de seguridad de MEF.

La cadena fundamental queda:

```text
Subject
   ↓
Identity
   ↓
Authentication
   ↓
Principal
   ↓
Authorization
   ↓
Permission / Capability
   ↓
Protected Resource
   ↓
Audit
```

Security deja de ser únicamente:

```text
login
+
password
```

y pasa a proteger:

```text
Packages
Modules
Services
Registry
Contracts
Events
Configuration
Secrets
Build
Release
Runtime
```

La relación del núcleo queda:

```text
ENG-018
Dependency Injection
→ entrega dependencias controladas

ENG-019
Service Container
→ protege acceso a Services

ENG-020
Registry
→ protege Identity y Ownership

ENG-021
Contracts
→ define fronteras públicas

ENG-022
Event Bus
→ protege Publishers y Subscribers

ENG-023
Error Handling
→ evita Information Disclosure

ENG-024
Security Engineering
→ gobierna Identity, Trust y Authority
```

La primera implementación deberá priorizar:

```text
Default Deny
+
Least Privilege
+
Security Context
+
Permissions
+
Capabilities
+
Secret Protection
+
Registry Ownership
+
Service Visibility
+
Event Authorization
+
Package Integrity
+
Audit
```

antes de introducir mecanismos complejos como:

```text
distributed policy engines
hardware attestation
process sandboxing
advanced cryptographic infrastructure
```

De esta manera MEF podrá evolucionar desde aislamiento lógico hacia controles más fuertes sin afirmar garantías que todavía no posee.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-012 — Dependency Injection
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-004 — Convenciones
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
- ENG-017 — Release Process
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-025
- ENG-026
- ENG-027 — Runtime Engineering