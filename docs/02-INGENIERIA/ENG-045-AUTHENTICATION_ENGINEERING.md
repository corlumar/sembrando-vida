---
id: ENG-045
titulo: Authentication Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Authentication Engineering
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
  - ENG-026
  - ENG-027
  - ENG-028
  - ENG-031
  - ENG-032
  - ENG-034
  - ENG-036
  - ENG-037
  - ENG-038
  - ENG-039
  - ENG-042
  - ENG-043
  - ENG-044
relacionados:
  - ENG-006
  - ENG-007
  - ENG-012
  - ENG-017
  - ENG-022
  - ENG-030
  - ENG-033
  - ENG-035
  - ENG-040
  - ENG-041
  - ENG-046
keywords:
  - authentication
  - identity
  - principal
  - credential
  - password
  - password-hashing
  - api-key
  - bearer-token
  - access-token
  - refresh-token
  - jwt
  - opaque-token
  - session
  - mfa
  - totp
  - webauthn
  - passkey
  - recovery-code
  - brute-force
  - credential-stuffing
  - token-rotation
  - token-revocation
  - service-account
  - machine-identity
  - mef
---

# ENG-045

# Authentication Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Authentication Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-045 establece las reglas para:

```text
Identity
Principal
Subject
Credential
Authentication
Authentication Context
Authentication Method
Authentication Result
Authentication Policy
Password Authentication
Password Hashing
Password Verification
Credential Storage
Credential Rotation
API Keys
Bearer Tokens
Access Tokens
Refresh Tokens
JWT
Opaque Tokens
Token Validation
Token Rotation
Token Revocation
Session Authentication
Session Lifecycle
Session Fixation Protection
MFA
TOTP
WebAuthn
Passkeys
Recovery Codes
Recovery Flow
Brute Force Protection
Credential Stuffing Protection
Authentication Throttling
Account Lockout
Reauthentication
Step-Up Authentication
Machine Identity
Service Accounts
Authentication Events
Authentication Observability
Authentication Testing
```

---

# 2. Declaración

La regla fundamental será:

> **MEF deberá establecer identidad únicamente mediante mecanismos de autenticación explícitos, verificables, revocables cuando corresponda y resistentes a replay, credential theft, brute force y confusion entre Authentication y Authorization.**

Arquitectura conceptual:

```text
External Actor
      │
      ▼
Credential
      │
      ▼
Authentication Boundary
      │
      ├── Credential Parsing
      ├── Credential Validation
      ├── Identity Resolution
      ├── Authentication Policy
      ├── Risk Controls
      └── Authentication Events
      │
      ▼
Authentication Result
      │
      ▼
Authenticated Principal
      │
      ▼
Authentication Context
      │
      ▼
Application / Authorization
```

---

# 3. Authentication

`Authentication` responde:

```text
Who are you?
```

o, con mayor precisión:

```text
What identity has been sufficiently established
for this interaction?
```

---

# 4. Authentication ≠ Authorization

La separación será:

```text
Authentication
→ establishes identity

Authorization
→ determines permitted actions
```

---

# 5. Authentication Success

Una autenticación exitosa no deberá implicar permiso para ejecutar ninguna operación específica.

---

# 6. Authorization After Authentication

La secuencia conceptual será:

```text
Credential
    │
    ▼
Authentication
    │
    ▼
Principal
    │
    ▼
Authorization
    │
    ▼
Operation
```

---

# 7. Identity

Una `Identity` representa una identidad reconocible por el sistema.

---

# 8. Identity ≠ User Record

Una Identity no deberá equivaler necesariamente a una fila de:

```text
users
```

---

# 9. Identity Types

Podrán existir:

```text
Human Identity
Machine Identity
Service Identity
External Identity
Federated Identity
```

---

# 10. Subject

`Subject` representa la entidad a la cual pertenece la identidad autenticada.

---

# 11. Principal

Un `Principal` representa la identidad efectiva utilizada durante una interacción.

---

# 12. Principal Example

Conceptualmente:

```text
Principal
├── subjectId
├── identityId
├── type
├── authenticationMethod
├── authenticationTime
├── assurance
└── attributes
```

---

# 13. Principal Immutability

El Principal deberá ser inmutable durante el Scope de una Request/Operation salvo transición explícita de Authentication.

---

# 14. Principal ≠ Authorization State

No deberá almacenar decisiones dinámicas de autorización como si fueran parte permanente de la identidad.

---

# 15. Anonymous Principal

Podrá existir representación explícita:

```text
AnonymousPrincipal
```

---

# 16. Anonymous ≠ Null

Deberá favorecerse una representación explícita cuando simplifique Security Boundaries.

---

# 17. Credential

Una `Credential` es evidencia presentada para demostrar identidad.

---

# 18. Credential Types

Podrán incluir:

```text
password
API key
session token
access token
client certificate
TOTP
WebAuthn assertion
recovery code
```

---

# 19. Credential ≠ Identity

Una Credential demuestra o ayuda a demostrar una Identity; no es la Identity.

---

# 20. Credential Lifecycle

Toda Credential deberá poseer Lifecycle apropiado:

```text
ISSUED
ACTIVE
ROTATED
REVOKED
EXPIRED
```

según tipo.

---

# 21. Credential Confidentiality

Credentials secretas deberán tratarse como información sensible.

---

# 22. Credential Logging

No deberán registrarse en:

```text
logs
traces
metrics
exceptions
analytics
```

---

# 23. Credential URL

Credentials no deberán transmitirse mediante URL o Query String.

---

# 24. Authentication Method

Un `AuthenticationMethod` representa un mecanismo reconocido.

Ejemplos:

```text
PASSWORD
SESSION
API_KEY
BEARER_TOKEN
TOTP
WEBAUTHN
PASSKEY
CLIENT_CERTIFICATE
```

---

# 25. Method Registry

ENG-020 podrá registrar Authentication Methods disponibles.

---

# 26. Authentication Provider

Cada Method podrá delegar validación a un `AuthenticationProvider`.

---

# 27. Provider Contract

Conceptualmente:

```text
AuthenticationProvider
    supports(Credential)
    authenticate(Credential, Context)
        → AuthenticationResult
```

---

# 28. Provider Independence

Application no deberá conocer detalles criptográficos o físicos del Provider.

---

# 29. Authentication Request

Representa intento de establecer identidad.

---

# 30. Authentication Context

Deberá contener únicamente información necesaria para la decisión.

Conceptualmente:

```text
AuthenticationContext
├── requestId
├── channel
├── source
├── requestedMethod
├── timestamp
└── riskContext
```

---

# 31. Authentication Result

Conceptualmente:

```text
AuthenticationResult
├── status
├── principal
├── method
├── assurance
├── authenticatedAt
└── metadata
```

---

# 32. Authentication Status

Podrá incluir:

```text
SUCCESS
FAILED
CHALLENGE_REQUIRED
LOCKED
EXPIRED
REVOKED
```

---

# 33. Authentication Failure

Deberá producir resultado controlado y no Exception interna indiscriminadamente.

---

# 34. Authentication Assurance

Podrá expresar fuerza/confianza de la autenticación.

---

# 35. Assurance Level

Podrá utilizarse para Step-Up Authentication.

---

# 36. Assurance ≠ Role

No deberá confundirse con Authorization Role.

---

# 37. Password Authentication

MEF podrá soportar Password Authentication.

---

# 38. Password Storage

Passwords nunca deberán almacenarse en texto plano.

---

# 39. Reversible Password Encryption

No deberá utilizarse como sustituto de Password Hashing.

---

# 40. Password Hashing

Deberá utilizar algoritmo adaptativo diseñado para passwords.

---

# 41. Password Hash Algorithm

La implementación deberá permitir evolución del algoritmo.

---

# 42. Preferred Algorithms

La Policy podrá favorecer:

```text
Argon2id
```

o algoritmo reconocido equivalente según plataforma.

---

# 43. Legacy Hash

Hashes antiguos podrán verificarse durante migración controlada.

---

# 44. Rehash on Login

Después de verificación exitosa podrá realizarse:

```text
verify
   │
   ▼
needsRehash?
   │
   ├── no → continue
   │
   └── yes
          │
          ▼
       new hash
```

---

# 45. Password Hash Parameters

Deberán ser configurables y versionables.

---

# 46. Salt

Deberá generarse adecuadamente por Credential.

---

# 47. Manual Salt

No deberá diseñarse un esquema criptográfico propio si la primitive seleccionada ya maneja Salt correctamente.

---

# 48. Pepper

Podrá utilizarse como defensa adicional.

---

# 49. Pepper Storage

Deberá permanecer separado de Database cuando sea posible.

---

# 50. Password Comparison

Deberá utilizar primitive segura del Password Hasher.

---

# 51. Password Policy

Deberá favorecer passwords suficientemente largos.

---

# 52. Maximum Password Length

También deberá existir un límite operativo razonable para prevenir Resource Exhaustion.

---

# 53. Arbitrary Complexity Rules

No deberán imponerse reglas excesivas sin justificación.

---

# 54. Common Password

Podrá rechazarse mediante Blocklist apropiada.

---

# 55. Password Truncation

No deberá ocurrir silenciosamente.

---

# 56. Unicode Password

La semántica deberá definirse consistentemente.

---

# 57. Password Change

Deberá requerir Authentication/Authorization apropiada.

---

# 58. Password Change Event

Deberá invalidar o reevaluar Sessions según Policy.

---

# 59. Password Reset

Deberá utilizar Token de propósito limitado.

---

# 60. Reset Token

Deberá ser:

```text
random
unguessable
single-purpose
time-limited
single-use
```

---

# 61. Reset Token Storage

Deberá favorecerse almacenamiento de representación no reutilizable, por ejemplo Hash.

---

# 62. Reset Enumeration

El flujo no deberá confirmar innecesariamente existencia de una cuenta.

---

# 63. Reset Completion

Después del Reset deberá considerarse:

```text
session invalidation
token revocation
security notification
```

---

# 64. Password Recovery ≠ Password Disclosure

El sistema nunca deberá recuperar y mostrar Password existente.

---

# 65. API Key

Una `API Key` representa Credential normalmente asociada a:

```text
application
integration
service
consumer
```

---

# 66. API Key Generation

Deberá utilizar Entropy criptográficamente segura.

---

# 67. API Key Identifier

Podrá separarse:

```text
keyId
secret
```

---

# 68. API Key Storage

El Secret deberá almacenarse de forma que una Database Leak no permita reutilización directa cuando el diseño lo permita.

---

# 69. API Key Display

El Secret completo deberá mostrarse normalmente una sola vez.

---

# 70. API Key Prefix

Podrá existir Prefix no secreto para identificación operacional.

---

# 71. API Key Scope

Una Key deberá asociarse a:

```text
identity
tenant
consumer
environment
```

según arquitectura.

---

# 72. API Key Expiration

Podrá ser obligatoria según Security Policy.

---

# 73. API Key Rotation

Deberá soportarse sin Downtime cuando sea necesario.

---

# 74. Overlapping Keys

Durante Rotation podrán coexistir temporalmente Key antigua y nueva.

---

# 75. API Key Revocation

Deberá poder ejecutarse explícitamente.

---

# 76. API Key in Source Code

No deberá almacenarse en Source Control.

---

# 77. Bearer Token

Un `Bearer Token` concede autenticación a quien pueda presentarlo válidamente.

---

# 78. Bearer Security

Deberá protegerse contra:

```text
leakage
replay
logging
insecure transport
```

---

# 79. Access Token

Representa Credential de vida relativamente corta utilizada para acceder a Resources.

---

# 80. Access Token Lifetime

Deberá ser limitado.

---

# 81. Long-Lived Access Token

No deberá ser Default.

---

# 82. Refresh Token

Permite obtener nuevos Access Tokens bajo Policy.

---

# 83. Refresh Token Sensitivity

Deberá tratarse como Credential de alto valor.

---

# 84. Refresh Token Lifetime

Podrá ser mayor que Access Token, pero siempre deberá ser limitado.

---

# 85. Refresh Token Rotation

Deberá favorecerse para detectar Replay.

---

# 86. Rotation Flow

```text
Refresh Token A
      │
      ▼
Exchange
      │
      ├── Access Token B
      └── Refresh Token B

Refresh Token A
      │
      ▼
invalid/reused
```

---

# 87. Refresh Token Reuse

Deberá considerarse señal de posible Credential Theft.

---

# 88. Token Family

Podrá rastrearse una cadena de Refresh Tokens.

---

# 89. Family Revocation

Reuse Detection podrá revocar toda la familia.

---

# 90. Token Revocation

Deberá existir cuando el Threat Model lo requiera.

---

# 91. Revocation ≠ Expiration

```text
expiration
→ automatic end of validity

revocation
→ explicit invalidation before expiration
```

---

# 92. JWT

MEF podrá soportar JSON Web Tokens.

---

# 93. JWT ≠ Authentication Architecture

Será únicamente un Token Format/Mechanism.

---

# 94. JWT Validation

Deberá validar como mínimo según Contract:

```text
signature
issuer
audience
expiration
not-before
algorithm
```

---

# 95. Algorithm Allowlist

Deberá existir.

---

# 96. Algorithm from Token

No deberá aceptarse sin Policy.

---

# 97. `none`

No deberá aceptarse para Tokens firmados de Production.

---

# 98. Key Selection

Deberá utilizar mecanismo seguro.

---

# 99. `kid`

No deberá permitir acceso arbitrario a filesystem, URL o Key Store.

---

# 100. JWT Claims

Solo Claims necesarios deberán incluirse.

---

# 101. Sensitive JWT Claims

No deberá asumirse confidencialidad por estar firmado.

---

# 102. JWT Size

Deberá mantenerse acotado.

---

# 103. JWT Revocation

Deberá diseñarse explícitamente si se requiere revocación inmediata.

---

# 104. Opaque Token

Un `Opaque Token` no revela estructura útil al Consumer.

---

# 105. Opaque Token Validation

Podrá requerir:

```text
lookup
introspection
session store
```

---

# 106. Opaque Token Benefit

Facilita revocación centralizada.

---

# 107. JWT vs Opaque

La selección deberá depender de:

```text
architecture
revocation needs
latency
distribution
security
operational complexity
```

---

# 108. Token Parser

Deberá rechazar Input malformado antes de validación criptográfica costosa cuando sea seguro hacerlo.

---

# 109. Token Clock

Validation deberá utilizar Clock controlado.

---

# 110. Clock Skew

Podrá existir tolerancia pequeña y configurable.

---

# 111. Excessive Clock Skew

No deberá utilizarse para ocultar problemas de sincronización.

---

# 112. Session Authentication

MEF podrá utilizar Sessions Server-Side.

---

# 113. Session ID

Deberá poseer Entropy criptográficamente segura.

---

# 114. Session Storage

Deberá permitir:

```text
expiration
revocation
rotation
```

---

# 115. Session Cookie

Cuando HTTP Cookie sea utilizada deberá considerar:

```text
Secure
HttpOnly
SameSite
```

---

# 116. Cookie Scope

Deberá limitar:

```text
Domain
Path
```

cuando corresponda.

---

# 117. Session Fixation

Después de Authentication exitosa deberá rotarse Session Identifier cuando sea necesario.

---

# 118. Privilege Transition

Cambios sensibles de Authentication State deberán considerar Session Rotation.

---

# 119. Session Expiration

Podrá combinar:

```text
idle timeout
absolute timeout
```

---

# 120. Idle Timeout

Limita inactividad.

---

# 121. Absolute Timeout

Limita duración total aunque exista actividad.

---

# 122. Remember Me

Deberá implementarse mediante Credential separada y revocable, no mediante Session infinita.

---

# 123. Logout

Deberá invalidar Session/Credential según Contract.

---

# 124. Global Logout

Podrá invalidar todas las Sessions de una Identity.

---

# 125. Session Enumeration

El usuario podrá visualizar Sessions activas cuando el producto lo requiera.

---

# 126. Session Revocation

Podrá revocar una Session específica.

---

# 127. Session Metadata

Podrá incluir información operacional limitada.

---

# 128. Session Metadata Privacy

No deberá almacenar información innecesaria.

---

# 129. CSRF

Authentication basada en Cookie deberá integrarse con protección CSRF donde corresponda.

---

# 130. CSRF ≠ Authentication

Será control independiente.

---

# 131. MFA

`Multi-Factor Authentication` utiliza factores independientes.

---

# 132. Factor Categories

Conceptualmente:

```text
knowledge
possession
inherence
```

---

# 133. Two Passwords

No constituyen dos factores independientes.

---

# 134. MFA Policy

Podrá depender de:

```text
identity type
operation
risk
tenant
environment
```

---

# 135. MFA Enrollment

Deberá requerir Identity Assurance suficiente.

---

# 136. MFA Removal

Deberá considerarse operación sensible.

---

# 137. MFA Reset

También.

---

# 138. TOTP

MEF podrá soportar Time-Based One-Time Password.

---

# 139. TOTP Secret

Deberá tratarse como Credential secreta.

---

# 140. TOTP Secret Storage

Deberá protegerse apropiadamente.

---

# 141. TOTP Window

Deberá mantenerse pequeña y configurable.

---

# 142. TOTP Replay

Un código ya utilizado podrá rechazarse dentro del periodo relevante.

---

# 143. TOTP Enrollment

Deberá confirmar que el Factor funciona antes de activarlo.

---

# 144. WebAuthn

MEF podrá soportar WebAuthn.

---

# 145. WebAuthn Benefit

Permite Authentication resistente a Phishing cuando se implementa correctamente.

---

# 146. WebAuthn Challenge

Deberá ser:

```text
random
short-lived
single-purpose
bound to ceremony
```

---

# 147. Origin Validation

Será obligatoria.

---

# 148. RP ID Validation

Será obligatoria.

---

# 149. Signature Counter

Deberá manejarse conforme a capacidades del Authenticator y Policy.

---

# 150. User Verification

Podrá requerirse según Assurance.

---

# 151. Passkeys

Podrán utilizarse mediante WebAuthn.

---

# 152. Passkey ≠ Password

No deberá modelarse como Password Storage.

---

# 153. Passkey Credential

Deberá almacenar únicamente material público y Metadata necesaria.

---

# 154. Multiple Authenticators

Una Identity podrá registrar múltiples Authenticators.

---

# 155. Authenticator Removal

Deberá requerir autorización/reauthentication apropiada.

---

# 156. Recovery Code

Representa Credential de emergencia.

---

# 157. Recovery Code Generation

Deberá utilizar Entropy segura.

---

# 158. Recovery Code Storage

Deberá almacenarse de manera no reutilizable cuando sea posible.

---

# 159. Recovery Code Use

Deberá ser Single-Use.

---

# 160. Recovery Code Display

Normalmente deberá mostrarse una sola vez.

---

# 161. Recovery Flow

Deberá diseñarse como parte del Threat Model.

---

# 162. Recovery ≠ Security Bypass

No deberá ser más débil de forma desproporcionada que Authentication normal.

---

# 163. Recovery Enumeration

No deberá revelar innecesariamente existencia de Identity.

---

# 164. Recovery Event

Deberá ser auditable.

---

# 165. Reauthentication

Operaciones sensibles podrán requerir Authentication reciente.

---

# 166. Authentication Age

El Principal podrá registrar:

```text
authenticatedAt
```

---

# 167. Fresh Authentication

Podrá exigirse, por ejemplo:

```text
authenticated within last 5 minutes
```

según Policy.

---

# 168. Step-Up Authentication

Incrementa Assurance para una operación sensible.

---

# 169. Step-Up Example

```text
Password Session
      │
      ▼
Sensitive Operation
      │
      ▼
MFA Challenge
      │
      ▼
Higher Assurance Context
```

---

# 170. Step-Up Scope

Deberá ser temporal y limitado.

---

# 171. Authentication Context Upgrade

No deberá convertir automáticamente permisos de Authorization.

---

# 172. Brute Force

MEF deberá proteger Authentication contra intentos repetitivos.

---

# 173. Brute Force Controls

Podrán incluir:

```text
rate limiting
progressive delay
temporary lock
risk detection
MFA
```

---

# 174. Account Lockout

No deberá facilitar Denial of Service trivial.

---

# 175. Permanent Lock

No deberá ser Default por intentos fallidos ordinarios.

---

# 176. Authentication Throttling

Deberá considerar múltiples dimensiones:

```text
account
IP
device
tenant
credential
```

---

# 177. IP Only

No deberá ser única dimensión.

---

# 178. Credential Stuffing

Deberá considerarse independientemente de Brute Force tradicional.

---

# 179. Compromised Password Detection

Podrá utilizarse cuando exista integración apropiada.

---

# 180. Failure Message

No deberá distinguir innecesariamente:

```text
unknown account
wrong password
disabled account
```

en Contexts públicos.

---

# 181. Timing Enumeration

La implementación deberá reducir diferencias de Timing explotables cuando sea razonable.

---

# 182. Dummy Verification

Podrá utilizarse para Accounts inexistentes en Password Authentication.

---

# 183. Authentication Failure Counter

Deberá tener Scope y Expiration.

---

# 184. Successful Authentication

Podrá resetear ciertos Counters según Policy.

---

# 185. Risk-Based Authentication

Podrá considerar señales adicionales.

---

# 186. Risk Signals

Podrán incluir:

```text
new device
unusual location
impossible travel
credential reuse
known compromised credential
abnormal request pattern
```

---

# 187. Risk Signal ≠ Identity Proof

No deberá convertirse por sí mismo en Factor.

---

# 188. Risk Decision

Podrá producir:

```text
allow
challenge
deny
```

---

# 189. Privacy

Risk Signals deberán recolectarse bajo Policy de Privacy.

---

# 190. Machine Identity

Servicios también deberán autenticarse.

---

# 191. Service Account

Representa Identity no humana.

---

# 192. Human Shared Service Account

No deberá utilizarse para interacción humana ordinaria.

---

# 193. Machine Credential

Podrá utilizar:

```text
API key
client certificate
signed assertion
short-lived token
workload identity
```

---

# 194. Long-Lived Machine Secret

Deberá evitarse cuando exista alternativa viable.

---

# 195. Workload Identity

Deberá favorecer Credentials cortas emitidas dinámicamente cuando infraestructura lo permita.

---

# 196. Service Account Ownership

Deberá poseer Owner y Purpose explícitos.

---

# 197. Service Account Lifecycle

Deberá incluir:

```text
creation
rotation
revocation
retirement
```

---

# 198. Orphan Service Account

Deberá detectarse.

---

# 199. Shared Credential

Deberá evitarse.

---

# 200. Environment Isolation

Credentials de:

```text
development
test
staging
production
```

no deberán reutilizarse.

---

# 201. Credential Rotation

Todo Secret de larga duración deberá poseer estrategia de Rotation.

---

# 202. Rotation Without Downtime

Deberá soportarse para Credentials críticas.

---

# 203. Credential Version

Podrá registrarse.

---

# 204. Revocation

Deberá ser rápida para Credentials comprometidas.

---

# 205. Revocation Event

Deberá propagarse a componentes relevantes.

---

# 206. Revocation Cache

Deberá poseer consistencia compatible con Security Requirement.

---

# 207. Revocation Failure

No deberá ocultarse.

---

# 208. Credential Compromise

Deberá existir procedimiento para:

```text
revoke
rotate
invalidate sessions
audit
notify
investigate
```

según Policy.

---

# 209. Authentication Event

Eventos relevantes podrán incluir:

```text
authentication.succeeded
authentication.failed
credential.created
credential.rotated
credential.revoked
password.changed
password.reset
session.created
session.revoked
mfa.enrolled
mfa.removed
recovery.used
```

---

# 210. Event Sensitivity

No deberán contener Credential Secret.

---

# 211. Event Ordering

No deberá asumirse orden global.

---

# 212. Audit

Eventos sensibles deberán integrarse con Audit Security.

---

# 213. Authentication Event ≠ Domain Event

Podrá ser Security/Audit Event especializado.

---

# 214. Observability

ENG-025 gobernará Telemetry.

---

# 215. Authentication Metrics

Podrán incluir:

```text
mef.auth.attempts.total
mef.auth.success.total
mef.auth.failure.total
mef.auth.challenge.total
mef.auth.lockout.total
mef.auth.token_refresh.total
mef.auth.token_reuse.total
```

---

# 216. Metric Dimensions

Podrán incluir:

```text
method
result
provider
```

con Cardinality acotada.

---

# 217. Identity Metric Label

No deberá utilizarse.

---

# 218. Email Metric Label

No deberá utilizarse.

---

# 219. API Key ID Metric Label

No deberá utilizarse si genera Cardinality o exposición innecesaria.

---

# 220. Authentication Logs

Podrán incluir:

```text
requestId
traceId
method
result
reasonCode
```

---

# 221. Credential Logging

Será prohibido.

---

# 222. Authentication Failure Reason

Internamente podrá ser preciso.

Externamente deberá obedecer Anti-Enumeration Policy.

---

# 223. Authentication Trace

No deberá incluir Password, Token o Secret.

---

# 224. Security Alert

Podrá generarse ante:

```text
refresh token reuse
multiple failed MFA
credential compromise
unexpected service account use
```

---

# 225. Performance

ENG-026 gobernará Performance.

---

# 226. Password Hash Cost

Deberá equilibrar:

```text
security
latency
CPU
memory
capacity
```

---

# 227. Hash Cost Benchmark

Deberá medirse en Hardware objetivo.

---

# 228. Authentication Resource Exhaustion

Inputs deberán limitarse antes de operaciones criptográficas costosas.

---

# 229. Token Validation Cache

Podrá utilizarse cuando sea seguro.

---

# 230. Revocation Freshness

Cache no deberá prolongar validez más allá de Security Policy.

---

# 231. External Identity Provider

MEF podrá delegar Authentication.

---

# 232. External Provider Failure

Deberá tratarse como Dependency Failure controlado.

---

# 233. External Provider Timeout

Deberá ser acotado.

---

# 234. External Provider Retry

No deberá ejecutarse indiscriminadamente.

---

# 235. Federated Authentication

Podrá incorporarse en una fase posterior.

---

# 236. Federation Boundary

MEF deberá validar Assertions/Tokens recibidos; no deberá confiar únicamente en que provienen de una URL conocida.

---

# 237. Identity Linking

Vincular identidades externas a internas deberá ser operación explícita.

---

# 238. Automatic Linking by Email

No deberá realizarse sin garantías suficientes sobre identidad y Email Verification.

---

# 239. Authentication State

No deberá almacenarse en Global Mutable State.

---

# 240. Request Scope

Authentication Context deberá estar acotado a Request/Operation.

---

# 241. Async Propagation

Solo Metadata de identidad necesaria deberá propagarse.

---

# 242. Background Job

No deberá heredar Session interactiva completa.

---

# 243. Delegated Identity

Cuando un Job actúe en nombre de un usuario deberá existir Context explícito y auditable.

---

# 244. Impersonation

Deberá ser Capability administrativa explícita.

---

# 245. Impersonation Event

Deberá ser auditado.

---

# 246. Impersonation Context

Deberá conservar:

```text
actor
subject
reason
```

---

# 247. Impersonation UI

Deberá hacer evidente la identidad efectiva cuando corresponda.

---

# 248. Impersonation Credential

No deberá revelar Credential del usuario objetivo.

---

# 249. Secret Management

ENG-024 gobernará Secrets.

---

# 250. Authentication Secret

No deberá almacenarse en Configuration pública.

---

# 251. Environment Variable

No deberá asumirse automáticamente como Secret Store suficiente para todo Threat Model.

---

# 252. Secret Access

Deberá seguir Least Privilege.

---

# 253. Key Rotation

Signing/Encryption Keys deberán soportar Rotation.

---

# 254. Multiple Verification Keys

Podrán coexistir durante transición.

---

# 255. Signing Key ID

Deberá utilizar identificador seguro.

---

# 256. Key Retirement

No deberá invalidar Tokens todavía soportados accidentalmente salvo revocación intencional.

---

# 257. Key Compromise

Deberá permitir Emergency Rotation.

---

# 258. Authentication Availability

Deberá considerarse componente crítico.

---

# 259. Authentication Dependency

Failure deberá clasificarse correctamente.

---

# 260. Fail Open

Authentication protegida no deberá utilizar `fail-open`.

---

# 261. Fail Closed

Deberá ser Default para incapacidad de verificar Credential.

---

# 262. Cached Identity

No deberá permitir bypass de Credential Validation más allá de Policy.

---

# 263. Offline Validation

Podrá utilizarse para Tokens firmados cuando Contract lo permita.

---

# 264. Online Introspection

Podrá utilizarse cuando Revocation Freshness lo requiera.

---

# 265. Hybrid Validation

Podrá combinar mecanismos bajo Policy explícita.

---

# 266. Error Handling

ENG-023 gobernará Error Translation.

---

# 267. Error Namespace

ENG-045 utilizará:

```text
MEF-AUTHN-xxx
```

---

# 268. Taxonomía ENG-045

```text
MEF-AUTHN-001 Authentication required
MEF-AUTHN-002 Invalid credential
MEF-AUTHN-003 Credential expired
MEF-AUTHN-004 Credential revoked
MEF-AUTHN-005 Credential malformed
MEF-AUTHN-006 Unsupported authentication method
MEF-AUTHN-007 Authentication failed
MEF-AUTHN-008 Authentication throttled
MEF-AUTHN-009 Authentication temporarily locked
MEF-AUTHN-010 MFA required
MEF-AUTHN-011 MFA failed
MEF-AUTHN-012 MFA enrollment invalid
MEF-AUTHN-013 Recovery credential invalid
MEF-AUTHN-014 Recovery credential already used
MEF-AUTHN-015 Session invalid
MEF-AUTHN-016 Session expired
MEF-AUTHN-017 Session revoked
MEF-AUTHN-018 Token invalid
MEF-AUTHN-019 Token expired
MEF-AUTHN-020 Token revoked
MEF-AUTHN-021 Refresh token reused
MEF-AUTHN-022 Token issuer invalid
MEF-AUTHN-023 Token audience invalid
MEF-AUTHN-024 Token signature invalid
MEF-AUTHN-025 Authentication assurance insufficient
MEF-AUTHN-026 Reauthentication required
MEF-AUTHN-027 Identity provider unavailable
MEF-AUTHN-028 Credential rotation required
MEF-AUTHN-029 Authentication security violation
MEF-AUTHN-030 Authentication invariant violation
```

---

# 269. Invalid Credential Example

```text
MEF-AUTHN-002

Authentication failed.

Public message:
Invalid credentials.
```

---

# 270. MFA Example

```text
MEF-AUTHN-010

Additional authentication is required.

Required assurance:
MFA
```

---

# 271. Refresh Reuse Example

```text
MEF-AUTHN-021

Refresh token reuse detected.

Action:
token family revoked
```

---

# 272. Reauthentication Example

```text
MEF-AUTHN-026

Recent authentication is required
for this operation.
```

---

# 273. Provider Failure Example

```text
MEF-AUTHN-027

Authentication provider is temporarily unavailable.
```

---

# 274. Security

ENG-024 gobernará:

```text
credential protection
secret management
cryptographic policy
threat modeling
audit
incident response
```

---

# 275. Authentication Security Defaults

Deberán favorecer:

```text
deny by default
fail closed
short-lived credentials
explicit expiration
explicit revocation
secure randomness
secret redaction
least privilege
```

---

# 276. Cryptographic Randomness

Tokens, Session IDs, Recovery Codes y API Keys deberán utilizar CSPRNG.

---

# 277. Predictable Token

Será una violación crítica.

---

# 278. Token Entropy

Deberá ser suficiente para resistir Guessing.

---

# 279. Custom Cryptography

No deberá diseñarse para Authentication salvo necesidad extraordinaria y revisión especializada.

---

# 280. Security Review

Cambios en:

```text
password hashing
token validation
session handling
MFA
recovery
credential storage
```

deberán recibir revisión reforzada.

---

# 281. Testing

ENG-009 gobernará Testing.

---

# 282. Authentication Provider Contract Test

Todo Provider deberá cumplir el mismo Contract.

---

# 283. Password Test

Deberá cubrir:

```text
valid
invalid
rehash
malformed hash
legacy hash
```

---

# 284. Password Reset Test

Deberá cubrir:

```text
valid token
expired token
used token
tampered token
account enumeration
```

---

# 285. API Key Test

Deberá cubrir:

```text
valid
invalid
expired
revoked
rotation overlap
```

---

# 286. Access Token Test

Deberá cubrir:

```text
valid
expired
wrong issuer
wrong audience
invalid signature
unsupported algorithm
```

---

# 287. Refresh Token Test

Deberá cubrir:

```text
rotation
reuse
family revocation
expiration
concurrent exchange
```

---

# 288. Session Test

Deberá cubrir:

```text
creation
rotation
expiration
idle timeout
absolute timeout
logout
revocation
```

---

# 289. Session Fixation Test

Será obligatorio para Cookie Sessions.

---

# 290. Cookie Test

Deberá verificar:

```text
Secure
HttpOnly
SameSite
Path
Domain
```

según Policy.

---

# 291. MFA Test

Deberá cubrir:

```text
enrollment
challenge
invalid factor
replay
removal
reset
```

---

# 292. TOTP Test

Deberá utilizar Clock controlado.

---

# 293. WebAuthn Test

Deberá cubrir:

```text
challenge
origin
RP ID
signature
user verification
replay
```

---

# 294. Recovery Test

Deberá comprobar Single-Use.

---

# 295. Brute Force Test

Deberá comprobar Throttling.

---

# 296. Lockout DoS Test

Deberá comprobar que un atacante no pueda bloquear permanentemente cuentas triviales.

---

# 297. Enumeration Test

Deberá comparar:

```text
messages
status
timing
```

cuando sea relevante.

---

# 298. Reauthentication Test

Deberá comprobar Authentication Age.

---

# 299. Step-Up Test

Deberá comprobar Assurance Upgrade.

---

# 300. Service Account Test

Deberá comprobar:

```text
credential
scope
expiration
revocation
environment isolation
```

---

# 301. Secret Leakage Test

Deberá inspeccionar:

```text
logs
errors
traces
metrics
```

---

# 302. Key Rotation Test

Deberá comprobar transición entre Keys.

---

# 303. Provider Failure Test

Deberá comprobar Fail Closed.

---

# 304. Concurrency Test

Deberá probar:

```text
refresh token race
session rotation race
recovery code race
credential rotation race
```

---

# 305. Fault Injection

Podrá simular:

```text
identity provider timeout
session store unavailable
revocation store unavailable
key store unavailable
clock skew
```

---

# 306. Architecture Test

Podrá impedir:

```text
Controller → password hash implementation
Domain → HTTP Session
Domain → JWT library
Application → raw credential storage
Authentication → Authorization decision
```

---

# 307. Build Integration

ENG-012 podrá validar:

```text
weak authentication configuration
missing credential expiration
unsafe cookie configuration
unsupported token algorithm
missing authentication provider
duplicate provider
```

cuando sea detectable.

---

# 308. CLI

ENG-007 podrá proporcionar:

```text
mef auth:methods
mef auth:providers
mef auth:status
mef auth:sessions
mef auth:credentials
mef auth:keys
mef auth:diagnose
```

---

# 309. CLI Secret Policy

La CLI no deberá imprimir Credentials completas.

---

# 310. CLI Credential Rotation

Podrá facilitar Rotation mediante operación protegida.

---

# 311. Configuration

ENG-011 podrá definir:

```text
authentication:
  default-method: session

  password:
    algorithm: argon2id
    rehash-on-login: true

  session:
    idle-timeout: 30m
    absolute-timeout: 12h
    rotate-on-login: true

  token:
    access-lifetime: 15m
    refresh-lifetime: 30d
    refresh-rotation: true

  mfa:
    enabled: true

  throttling:
    enabled: true

  security:
    fail-closed: true
```

---

# 312. Configuration Validation

Deberá comprobar:

```text
supported password algorithm
positive credential lifetimes
valid session limits
valid token policy
valid MFA configuration
valid throttling policy
fail-closed security
```

---

# 313. Registry Integration

ENG-020 podrá registrar:

```text
AuthenticationProviderDefinition
AuthenticationMethodDefinition
CredentialTypeDefinition
AuthenticationPolicyDefinition
```

---

# 314. Authentication Provider Definition

Conceptualmente:

```text
AuthenticationProviderDefinition
├── id
├── method
├── credentialType
├── implementation
├── priority
└── metadata
```

---

# 315. Authentication Policy Definition

Conceptualmente:

```text
AuthenticationPolicy
├── methods
├── assurance
├── reauthentication
├── mfa
├── throttling
└── recovery
```

---

# 316. Credential Definition

Conceptualmente:

```text
CredentialDefinition
├── type
├── lifecycle
├── expiration
├── rotation
└── revocation
```

---

# 317. Bootstrap

ENG-027 deberá construir Authentication Runtime.

---

# 318. Bootstrap Flow

```text
Load Configuration
       │
       ▼
Discover Authentication Providers
       │
       ▼
Validate Providers
       │
       ▼
Validate Cryptographic Policy
       │
       ▼
Validate Credential Policy
       │
       ▼
Build Authentication Registry
       │
       ▼
Build Authentication Manager
       │
       ▼
Validate Security Defaults
       │
       ▼
Readiness
```

---

# 319. Bootstrap Failure

Deberá impedir Readiness ante:

```text
missing default provider
unsupported password algorithm
invalid signing key
unsafe token algorithm
invalid session policy
invalid credential lifetime
fail-open protected authentication
```

---

# 320. Module Integration

Modules podrán declarar Authentication Requirements.

---

# 321. Module Credential Provider

Un Module podrá aportar Provider únicamente mediante Contract explícito.

---

# 322. Provider Override

No deberá ocurrir silenciosamente.

---

# 323. Authentication Manager

Deberá seleccionar Provider mediante Registry/Policy.

---

# 324. Authentication Manager ≠ Authorization Manager

Serán componentes distintos.

---

# 325. API Integration

ENG-044 deberá recibir Authentication Result y construir Principal/Context apropiado.

---

# 326. Data Access Integration

Credential Stores deberán atravesar ENG-043.

---

# 327. Transaction Integration

Operaciones como:

```text
password reset
refresh rotation
recovery code consumption
credential rotation
```

deberán utilizar ENG-042 cuando requieran atomicidad.

---

# 328. Cache Integration

ENG-037 podrá utilizarse para:

```text
session cache
token introspection cache
authentication throttling
```

bajo Security Policy.

---

# 329. Concurrency Integration

ENG-038 gobernará:

```text
refresh token race
credential rotation race
session rotation race
recovery code race
```

---

# 330. Resilience Integration

ENG-039 gobernará Failure de Providers externos sin introducir `fail-open`.

---

# 331. Messaging Integration

Eventos de Authentication podrán publicarse mediante ENG-041 cuando corresponda.

---

# 332. Background Jobs

ENG-040 podrá ejecutar:

```text
expired session cleanup
credential expiration processing
orphan service account detection
security notifications
```

---

# 333. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Identity
IdentityId

Principal
AnonymousPrincipal

Credential
CredentialType
CredentialStatus

AuthenticationMethod
AuthenticationRequest
AuthenticationContext
AuthenticationResult
AuthenticationStatus

AuthenticationProvider
AuthenticationManager
AuthenticationPolicy

PasswordCredential
PasswordHasher

ApiKeyCredential

AccessToken
RefreshToken
TokenValidator

Session
SessionId
SessionManager

AuthenticationAssurance

AuthenticationError
```

---

# 334. Optional Initial Components

Podrán incorporarse:

```text
MfaChallenge
TotpCredential
RecoveryCode
ReauthenticationPolicy
StepUpPolicy
AuthenticationThrottle
```

---

# 335. Later Components

Solo cuando exista necesidad demostrada:

```text
WebAuthn
Passkeys
Federated Authentication
OIDC
SAML
Workload Identity Federation
Risk Engine
Adaptive Authentication
Device Trust
```

---

# 336. Conceptual Directory Structure

```text
src/
└── Authentication/
    ├── Identity/
    │   ├── Identity
    │   ├── IdentityId
    │   ├── Principal
    │   └── AnonymousPrincipal
    │
    ├── Credential/
    │   ├── Credential
    │   ├── CredentialType
    │   └── CredentialStatus
    │
    ├── Method/
    │   └── AuthenticationMethod
    │
    ├── Provider/
    │   ├── AuthenticationProvider
    │   └── AuthenticationProviderDefinition
    │
    ├── Context/
    │   ├── AuthenticationRequest
    │   ├── AuthenticationContext
    │   ├── AuthenticationResult
    │   └── AuthenticationStatus
    │
    ├── Password/
    │   ├── PasswordCredential
    │   └── PasswordHasher
    │
    ├── ApiKey/
    │   └── ApiKeyCredential
    │
    ├── Token/
    │   ├── AccessToken
    │   ├── RefreshToken
    │   └── TokenValidator
    │
    ├── Session/
    │   ├── Session
    │   ├── SessionId
    │   └── SessionManager
    │
    ├── Assurance/
    │   └── AuthenticationAssurance
    │
    ├── Policy/
    │   └── AuthenticationPolicy
    │
    ├── Manager/
    │   └── AuthenticationManager
    │
    └── Error/
        └── AuthenticationError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 337. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Authentication Boundary
Principal
Authentication Context
Provider Contracts
Password Hashing
Argon2id where available
Rehash on Login
Password Reset Tokens
API Keys
Short-Lived Access Tokens
Refresh Token Rotation
Token Revocation
Server-Side Sessions
Session Rotation
Secure Cookies
Authentication Throttling
Anti-Enumeration
Credential Rotation
Machine Identity
Fail Closed
Security Events
Observability
```

---

# 338. First Version Non-Goals

No deberá requerir:

```text
Custom Cryptography
Custom Password Hash Algorithm
Custom JWT Algorithm
Universal Identity Provider
SAML
Full OIDC Provider
Biometric Platform
Risk AI
Device Fingerprinting Platform
Passwordless-Only Architecture
Global Identity Federation
```

---

# 339. Second Phase

Podrá incorporar:

```text
TOTP
Recovery Codes
Step-Up Authentication
WebAuthn
Passkeys
External OIDC Providers
Service Identity Improvements
```

---

# 340. Third Phase

Solo cuando exista necesidad demostrada:

```text
SAML
Identity Federation
Workload Identity Federation
Adaptive Authentication
Risk Engine
Device Trust
Enterprise Identity Broker
```

---

# 341. Invariantes de Ingeniería

ENG-045 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-846 | Toda identidad autenticada deberá establecerse mediante Authentication Boundary explícita y un mecanismo verificable reconocido por Policy. |
| EI-847 | Authentication deberá limitarse a establecer identidad/assurance y no deberá tomar decisiones de Authorization. |
| EI-848 | Credentials secretas nunca deberán almacenarse en texto plano ni aparecer en Logs, Traces, Metrics, URLs o mensajes de Error. |
| EI-849 | Passwords deberán protegerse mediante Password Hashing adaptativo y versionable, permitiendo Rehash controlado cuando evolucione la Policy. |
| EI-850 | Tokens, Session IDs, API Keys, Recovery Codes y Credentials aleatorias deberán generarse mediante CSPRNG con Entropy suficiente. |
| EI-851 | Access Tokens deberán poseer vida limitada y Refresh Tokens deberán protegerse mediante Rotation/Revocation cuando el Threat Model lo requiera. |
| EI-852 | JWT deberá tratarse como Token Format y toda validación deberá restringir Algorithm, Issuer, Audience, Lifetime y Key Selection mediante Policy explícita. |
| EI-853 | Session Authentication deberá utilizar identificadores impredecibles, Expiration, Revocation y protección contra Session Fixation. |
| EI-854 | Authentication basada en Cookies deberá aplicar atributos seguros y controles CSRF cuando corresponda. |
| EI-855 | MFA, Reauthentication y Step-Up deberán incrementar Authentication Assurance sin modificar implícitamente Authorization. |
| EI-856 | Recovery y Password Reset deberán utilizar Credentials Single-Purpose, Time-Limited y Single-Use sin permitir Account Enumeration innecesaria. |
| EI-857 | Authentication deberá resistir Brute Force, Credential Stuffing y Enumeration mediante controles multidimensionales que no faciliten Lockout DoS trivial. |
| EI-858 | Machine Identities y Service Accounts deberán poseer Owner, Purpose, Credential Lifecycle y Environment Isolation explícitos. |
| EI-859 | Credentials de larga duración deberán soportar Rotation y Revocation, y una Credential comprometida deberá poder invalidarse sin depender únicamente de Expiration. |
| EI-860 | Authentication protegida deberá fallar cerrada cuando no sea posible verificar una Credential de forma confiable. |
| EI-861 | Authentication Context y Principal deberán estar acotados al Scope de la operación y no almacenarse en Global Mutable State. |
| EI-862 | Impersonation y Delegated Identity deberán preservar Actor, Subject y Audit Context sin revelar Credentials del Subject. |
| EI-863 | Telemetry de Authentication deberá permitir diagnóstico y detección de abuso sin exponer Identity Data innecesaria ni Credential Material. |
| EI-864 | Authentication Testing deberá cubrir Credential Lifecycle, Token Validation, Sessions, Replay, Rotation, Enumeration, Concurrency, Provider Failure y Secret Leakage. |
| EI-865 | La primera implementación deberá favorecer Providers explícitos, Password Hashing seguro, Sessions, API Keys, Short-Lived Tokens, Rotation, Revocation, Fail-Closed y Observability antes de introducir Federation, Adaptive Authentication o plataformas avanzadas de Identity. |

---

# 342. Continuidad de Invariantes

```text
ENG-041 → EI-766 a EI-785
ENG-042 → EI-786 a EI-805
ENG-043 → EI-806 a EI-825
ENG-044 → EI-826 a EI-845
ENG-045 → EI-846 a EI-865
```

---

# 343. Criterios de Conformidad

Una implementación será conforme con ENG-045 cuando:

- separe Authentication de Authorization;
- modele Identity y Principal explícitamente;
- modele Credentials explícitamente;
- utilice Authentication Providers;
- proteja Credentials;
- utilice Password Hashing seguro;
- permita evolución/Rehash;
- implemente Reset seguro;
- genere Tokens mediante CSPRNG;
- limite Access Token Lifetime;
- controle Refresh Tokens;
- soporte Rotation;
- soporte Revocation;
- valide JWT estrictamente cuando exista;
- soporte Opaque Tokens cuando corresponda;
- rote Sessions;
- proteja Cookies;
- limite Session Lifetime;
- proteja contra Brute Force;
- reduzca Enumeration;
- permita Reauthentication;
- modele Assurance;
- permita MFA cuando corresponda;
- controle Recovery;
- gestione Machine Identities;
- aísle Credentials por Environment;
- falle cerrada;
- emita Security Events;
- integre Observability;
- pruebe Replay y Concurrency;
- pruebe Secret Leakage.

---

# 344. Riesgos

Deberán evitarse especialmente:

## Authentication = Authorization

Una identidad autenticada recibe permisos automáticamente.

## Plaintext Password

Una fuga de Database revela Credentials inmediatamente.

## Reversible Password Encryption

La aplicación puede recuperar todos los Passwords.

## Weak Password Hash

El costo de ataque offline es insuficiente.

## Custom Password Algorithm

Se introduce criptografía no revisada.

## Infinite Session

Una Session robada permanece válida indefinidamente.

## Session Fixation

El atacante controla Session ID antes del Login.

## Long-Lived Access Token

Una Credential filtrada conserva acceso durante demasiado tiempo.

## Refresh Token without Rotation

Replay puede permanecer indetectado.

## JWT without Audience Validation

Un Token emitido para otro servicio puede ser aceptado.

## JWT Algorithm Confusion

La validación acepta algoritmos no previstos.

## Trusting `kid`

El Token controla indirectamente Key Lookup inseguro.

## Sensitive JWT Claims

Información sensible queda visible al poseedor del Token.

## API Key in Source Control

La Credential queda persistida en Repository History.

## API Key in URL

La Credential aparece en Logs y Browser History.

## Weak Recovery Flow

El atacante evita MFA mediante Recovery.

## Account Enumeration

El Endpoint confirma qué identidades existen.

## Permanent Lockout

Un atacante puede provocar Denial of Service.

## IP-Only Throttling

Botnets distribuidas evaden protección.

## Credential Logging

Logs se convierten en Credential Store.

## Shared Service Account

No existe Attribution individual.

## Same Credentials Across Environments

Compromiso de Development afecta Production.

## Fail-Open Authentication

Una dependencia caída permite acceso.

## Authentication State Global

Identidad puede filtrarse entre Requests.

## Blind Identity Linking

Una identidad externa se vincula por Email sin garantías suficientes.

---

# 345. Relación con ENG-044

La secuencia será:

```text
API Request
     │
     ▼
Authentication
     │
     ▼
Principal
     │
     ▼
Authorization
     │
     ▼
Application
```

ENG-044 define la Boundary pública.

ENG-045 establece la identidad.

---

# 346. Relación con ENG-024

ENG-024 define Security Policy global.

ENG-045 implementa los mecanismos específicos para establecimiento de identidad.

---

# 347. Relación con ENG-034

Application deberá recibir Principal/Context ya autenticado cuando el Use Case lo requiera.

---

# 348. Relación con ENG-035

Domain no deberá depender de:

```text
password
JWT
session
cookie
authentication provider
```

---

# 349. Relación con ENG-036

Validation deberá validar estructura de Authentication Input sin sustituir Credential Verification.

---

# 350. Relación con ENG-037

Caching podrá acelerar:

```text
session lookup
token introspection
revocation lookup
```

sin extender validez más allá de Security Policy.

---

# 351. Relación con ENG-038

Concurrency deberá proteger:

```text
refresh rotation
session rotation
recovery consumption
credential replacement
```

---

# 352. Relación con ENG-039

Resilience deberá proteger Availability sin permitir `fail-open`.

---

# 353. Relación con ENG-040

Background Jobs podrán ejecutar Maintenance de Authentication State.

---

# 354. Relación con ENG-041

Messaging podrá distribuir Security Events sin incluir Credentials.

---

# 355. Relación con ENG-042

Transactions deberán proteger cambios atómicos de Credential State.

---

# 356. Relación con ENG-043

Credential Stores, Session Stores y Identity Lookups deberán respetar Data Access Boundaries.

---

# 357. Relación con ENG-031

Serialization gobernará representación de Tokens/Authentication Contracts cuando corresponda.

---

# 358. Relación con ENG-032

Transport gobernará transmisión de Authentication Material.

---

# 359. Relación con ENG-016

Compatibility deberá gobernar evolución de Authentication Contracts sin conservar mecanismos inseguros indefinidamente.

---

# 360. Relación con ENG-017

Release Process deberá detectar configuraciones incompatibles o Security Regressions.

---

# 361. Relación con ENG-046

ENG-046 deberá formalizar **Authorization Engineering**.

La separación será:

```text
ENG-045 Authentication
→ Who is the Principal?

ENG-046 Authorization
→ What may the Principal do?

ENG-024 Security
→ What security guarantees and controls govern both?
```

ENG-046 deberá cubrir:

```text
Authorization
Authorization Context
Subject
Actor
Resource
Action
Permission
Capability
Role
RBAC
ABAC
Policy
Policy Decision
Policy Enforcement Point
Policy Decision Point
Deny by Default
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
Policy Composition
Explicit Deny
Authorization Caching
Authorization Audit
Authorization Observability
Authorization Testing
```

---

# 362. Principio Rector

> **MEF deberá autenticar identidades mediante evidencia verificable y Credentials correctamente protegidas, manteniendo Authentication separada de Authorization y diseñando cada Credential bajo un Lifecycle explícito de emisión, uso, expiración, rotación y revocación.**

---

# 363. Conclusión

**ENG-045 — Authentication Engineering** formaliza el establecimiento de identidad dentro de MEF.

La arquitectura queda:

```text
                    EXTERNAL ACTOR
                          │
                          ▼
                      CREDENTIAL
                          │
                          ▼
               AUTHENTICATION BOUNDARY
                          │
       ┌──────────────────┼──────────────────┐
       │                  │                  │
       ▼                  ▼                  ▼
 CREDENTIAL PARSER   AUTH PROVIDER       RISK CONTROL
       │                  │                  │
       └──────────────────┼──────────────────┘
                          │
                          ▼
                AUTHENTICATION RESULT
                          │
                          ▼
                      PRINCIPAL
                          │
                          ▼
              AUTHENTICATION CONTEXT
                          │
                          ▼
                   AUTHORIZATION
```

El ciclo Password queda:

```text
Password
   │
   ▼
Password Hasher
   │
   ▼
Verify
   │
   ├── invalid → Authentication Failed
   │
   └── valid
         │
         ▼
     Needs Rehash?
         │
    ┌────┴────┐
    │         │
    no       yes
    │         │
    │         ▼
    │      Rehash
    │         │
    └────┬────┘
         ▼
     Principal
```

El ciclo Token queda:

```text
Credential
    │
    ▼
Token Parser
    │
    ▼
Token Validator
    │
    ├── Signature
    ├── Algorithm
    ├── Issuer
    ├── Audience
    ├── Expiration
    ├── Revocation
    └── Security Policy
    │
    ▼
Principal
```

El ciclo Refresh queda:

```text
Refresh A
    │
    ▼
Atomic Exchange
    │
    ├── Access B
    └── Refresh B

Reuse Refresh A
    │
    ▼
Replay Detection
    │
    ▼
Revoke Token Family
```

El ciclo Session queda:

```text
Login
  │
  ▼
Authenticate
  │
  ▼
Rotate Session ID
  │
  ▼
Authenticated Session
  │
  ├── Idle Timeout
  ├── Absolute Timeout
  ├── Reauthentication
  └── Revocation
```

La relación central queda:

```text
ENG-044
API Engineering
      │
      ▼
ENG-045
Authentication Engineering
      │
      ▼
Principal
      │
      ▼
ENG-046
Authorization Engineering
      │
      ▼
ENG-034
Application Engineering
      │
      ▼
ENG-035
Domain Engineering
```

La separación conceptual queda:

```text
Identity
→ recognized system identity

Principal
→ effective authenticated identity

Credential
→ evidence used to establish identity

Authentication Method
→ recognized authentication mechanism

Authentication Provider
→ credential verification implementation

Authentication Context
→ scoped authentication information

Authentication Assurance
→ confidence/strength of authentication

Access Token
→ short-lived access credential

Refresh Token
→ credential for obtaining new access tokens

Session
→ server-managed authenticated interaction state

MFA
→ authentication using independent factors

Reauthentication
→ fresh proof of identity

Step-Up
→ temporary increase in authentication assurance

Machine Identity
→ non-human authenticated identity
```

La primera implementación deberá concentrarse en:

```text
Identity
Principal
Credential

AuthenticationMethod
AuthenticationProvider
AuthenticationManager
AuthenticationPolicy

AuthenticationRequest
AuthenticationContext
AuthenticationResult

PasswordHasher
PasswordCredential

ApiKeyCredential

AccessToken
RefreshToken
TokenValidator

Session
SessionManager

AuthenticationAssurance
AuthenticationError
```

con:

```text
Explicit Authentication Boundary
Secure Password Hashing
Rehash on Login
Secure Password Reset
CSPRNG Credentials
API Key Rotation
Short-Lived Access Tokens
Refresh Token Rotation
Token Revocation
Session Rotation
Secure Cookies
Anti-Enumeration
Authentication Throttling
Machine Identity
Environment Isolation
Fail Closed
Security Events
Observability
```

antes de introducir:

```text
SAML
Identity Federation
Adaptive Authentication
Risk AI
Device Trust
Enterprise Identity Broker
Custom Cryptography
```

Con **ENG-045** la serie global alcanza:

```text
EI-865
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
- ENG-046 — Authorization Engineering
```