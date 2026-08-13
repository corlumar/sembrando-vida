---
id: ENG-023
titulo: Error Handling
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
  - ENG-004
  - ENG-005
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-022
  - ARQ-004
  - ARQ-006
  - ARQ-007
  - ARQ-008
  - ARQ-011
  - ARQ-012
  - ARQ-014
relacionados:
  - ENG-024
  - ENG-025
  - ENG-026
  - ENG-027
keywords:
  - error handling
  - exceptions
  - failures
  - error taxonomy
  - propagation
  - translation
  - retryability
  - result
  - diagnostics
  - recovery
  - runtime
  - mef
---

# ENG-023

# Error Handling

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería para representar, clasificar, propagar, traducir, registrar, recuperar y diagnosticar errores dentro de **MEF (Modular Enterprise Framework)**.

El modelo deberá distinguir claramente entre:

```text
Expected Outcome
Domain Failure
Application Failure
Infrastructure Failure
Framework Failure
Programming Defect
Fatal Runtime Failure
```

La arquitectura fundamental será:

```text
Operation
   │
   ▼
Outcome
   │
   ├── Success
   │
   └── Failure
          │
          ▼
     Classification
          │
     ┌────┼────┐
     ▼    ▼    ▼
 Handle Translate Propagate
                 │
                 ▼
              Boundary
                 │
                 ▼
             Diagnostic
```

---

# 2. Declaración

La regla fundamental será:

> **Todo error deberá conservar suficiente información para comprender su naturaleza y causa, pero solo deberá propagarse hasta una frontera cuando dicha frontera pueda interpretarlo correctamente o transformarlo a su propio modelo de error.**

Por tanto:

```text
Internal Failure
      ↓
Classification
      ↓
Translation
      ↓
Public Error
```

y no:

```text
Database Driver Exception
      ↓
Domain
      ↓
API
      ↓
End User
```

---

# 3. Objetivos

Error Handling deberá:

- establecer una taxonomía común;
- diferenciar errores esperados y excepcionales;
- preservar causalidad;
- definir propagación;
- definir traducción;
- evitar leakage de Implementation;
- soportar Retry;
- soportar Diagnostics;
- integrarse con Logging;
- integrarse con Event Bus;
- integrarse con Contracts;
- integrarse con Security;
- proporcionar códigos estables;
- proteger información sensible;
- permitir Testing;
- mantener independencia tecnológica.

---

# 4. Error

`Error` será el término general para representar una condición no exitosa que requiere tratamiento.

---

# 5. Failure

`Failure` representa el resultado no exitoso de una operación.

Conceptualmente:

```text
Operation
   ↓
Failure
```

---

# 6. Exception

`Exception` representa un mecanismo técnico de interrupción/propagación disponible en determinados Implementation Profiles.

Por tanto:

```text
Failure
≠
Exception
```

Una Failure puede representarse mediante Exception.

Pero no toda Failure necesita Exception.

---

# 7. Defect

Un Defect representa una violación de una expectativa interna del software.

Ejemplos:

```text
impossible state
invalid invariant
null where impossible
unreachable branch reached
```

---

# 8. Expected Failure

Una Failure puede formar parte normal del Contract.

Ejemplo:

```text
CustomerNotFound
InvalidCredentials
InsufficientFunds
```

---

# 9. Exceptional Failure

Una Failure excepcional representa una condición que impide continuar normalmente.

Ejemplos:

```text
DatabaseUnavailable
RegistryCorrupted
ContainerResolutionFailure
```

---

# 10. Fatal Failure

Una Failure Fatal impide que el Runtime continúe de forma segura.

Ejemplos:

```text
invalid framework state
corrupted registry
critical configuration unavailable
security invariant violated
```

---

# 11. Error Classification

La clasificación base será:

```text
MEF Error
├── Domain
├── Application
├── Infrastructure
├── Contract
├── Runtime
├── Security
└── System
```

---

# 12. Domain Error

Representa una regla o condición del negocio.

Ejemplos:

```text
CustomerAlreadyExists
InsufficientInventory
PaymentRejected
```

---

# 13. Application Error

Representa una Failure asociada a coordinación de un caso de uso.

Ejemplos:

```text
RequiredDependencyUnavailable
OperationConflict
WorkflowNotAllowed
```

---

# 14. Infrastructure Error

Representa una Failure producida por infraestructura.

Ejemplos:

```text
DatabaseUnavailable
FileWriteFailed
BrokerUnavailable
NetworkTimeout
```

---

# 15. Contract Error

Representa incumplimiento o incompatibilidad contractual.

ENG-021 será autoridad sobre su semántica específica.

---

# 16. Runtime Error

Representa una Failure del Runtime MEF.

Ejemplos:

```text
ModuleActivationFailed
InvalidRuntimeState
BootstrapFailure
```

---

# 17. Security Error

Representa una Failure relacionada con:

```text
authentication
authorization
trust
integrity
policy
```

ENG-024 será autoridad especializada.

---

# 18. System Error

Representa condiciones del entorno de ejecución.

Ejemplos:

```text
OutOfMemory
DiskUnavailable
ProcessFailure
```

---

# 19. Error Identity

Todo Error arquitectónicamente significativo deberá poder identificarse mediante código estable.

Ejemplo:

```text
MEF-CT-001
MEF-EVT-008
MEF-RT-004
```

---

# 20. Error Code

Un Error Code deberá:

```text
identify category
identify condition
remain stable
support diagnostics
support automation
```

---

# 21. Error Code Is Not Message

Deberán mantenerse separados:

```text
code:
MEF-CT-001

message:
Required Contract not found.
```

---

# 22. Stable Error Codes

El texto podrá mejorar.

El significado fundamental del código no deberá cambiar silenciosamente.

---

# 23. Error Namespace

La estructura recomendada será:

```text
MEF-<SUBSYSTEM>-<NUMBER>
```

Ejemplos:

```text
MEF-DI-001
MEF-CTR-001
MEF-REG-001
MEF-CT-001
MEF-EVT-001
MEF-RT-001
MEF-SEC-001
```

---

# 24. Error Code Registry

Los códigos deberán formar un namespace gobernado.

No deberán duplicarse códigos con significados diferentes.

---

# 25. Existing Error Taxonomies

Las taxonomías ya definidas en otros documentos deberán integrarse al modelo global.

Ejemplo:

```text
ENG-021
MEF-CT-xxx

ENG-022
MEF-EVT-xxx
```

ENG-023 no deberá reemplazarlas arbitrariamente.

---

# 26. Canonical Error Structure

La representación conceptual será:

```text
Error
├── code
├── category
├── message
├── severity
├── retryable
├── cause
├── context
├── correlationId
└── metadata
```

---

# 27. `code`

Identificador estable.

---

# 28. `category`

Clasificación arquitectónica.

---

# 29. `message`

Descripción humana segura.

---

# 30. `severity`

Nivel de impacto.

---

# 31. `retryable`

Indica si la operación puede ser candidata a Retry.

No deberá significar que el Retry sea automáticamente seguro.

---

# 32. `cause`

Referencia causal a Failure previa.

---

# 33. `context`

Información diagnóstica relevante.

---

# 34. `correlationId`

Relaciona el Error con un flujo lógico.

---

# 35. `metadata`

Información técnica adicional gobernada.

---

# 36. Error Severity

La clasificación recomendada será:

```text
info
warning
error
critical
fatal
```

---

# 37. Severity vs Logging Level

Severity y Logging Level pueden relacionarse.

No deberán considerarse obligatoriamente idénticos.

---

# 38. Recoverability

Los Errors podrán clasificarse:

```text
recoverable
non-recoverable
fatal
```

---

# 39. Recoverable

El sistema puede continuar mediante estrategia conocida.

---

# 40. Non-Recoverable

La operación actual no puede recuperarse de forma segura.

El Runtime general podría continuar.

---

# 41. Fatal

El proceso/subsistema no puede continuar de forma segura.

---

# 42. Retryability

Deberá distinguirse:

```text
recoverable
```

de:

```text
retryable
```

Una Failure puede ser recuperable mediante fallback sin ser retryable.

---

# 43. Retryable Error

Ejemplos potenciales:

```text
temporary network failure
service unavailable
transient lock
rate limit
```

---

# 44. Non-Retryable Error

Ejemplos:

```text
invalid input
authorization denied
unsupported contract version
business rule violation
```

---

# 45. Retry Policy Authority

El Error podrá declarar elegibilidad.

La Policy del Caller decidirá si realmente se reintenta.

---

# 46. Retry Safety

Antes de Retry deberá evaluarse:

```text
idempotency
side effects
attempt count
backoff
transaction state
```

---

# 47. Error Cause

Toda traducción debería preservar la causa original cuando sea seguro y técnicamente posible.

---

# 48. Cause Chain

Ejemplo:

```text
CustomerRepositoryFailure
        ↓ caused by
DatabaseQueryFailure
        ↓ caused by
ConnectionTimeout
```

---

# 49. Root Cause

La causa raíz deberá conservarse para Diagnostics.

No necesariamente deberá exponerse públicamente.

---

# 50. Error Wrapping

Una capa podrá envolver una Failure inferior.

Ejemplo:

```text
PDOException
      ↓
DatabaseOperationException
      ↓
CustomerRepositoryUnavailable
```

---

# 51. Wrapping Purpose

El wrapping deberá:

- añadir contexto;
- preservar causa;
- evitar leakage;
- traducir abstracciones.

No deberá utilizarse simplemente para cambiar nombres sin aportar significado.

---

# 52. Error Translation

Cada Boundary podrá traducir errores internos a su propio lenguaje contractual.

---

# 53. Translation Example

```text
MySqlDuplicateKey
       ↓
RepositoryDuplicateRecord
       ↓
CustomerAlreadyExists
```

---

# 54. Translation Boundary

La traducción debería realizarse en la frontera que comprende ambas semánticas.

---

# 55. Infrastructure Leakage

No deberá llegar a Domain:

```text
PDOException
RedisException
KafkaException
AwsSdkException
```

cuando exista una abstracción apropiada.

---

# 56. Vendor Leakage

Un Contract público no deberá obligar a Consumers a interpretar Errors propietarios de un Vendor externo.

---

# 57. Contract Errors

ENG-021 deberá definir los Errors observables que forman parte de un Contract.

---

# 58. Undocumented Error

Una Implementation no deberá introducir arbitrariamente nuevos errores contractuales observables.

---

# 59. Unexpected Internal Failure

Deberá traducirse a una Failure apropiada de Boundary.

---

# 60. Error Propagation

Una Failure podrá:

```text
handle
translate
propagate
escalate
```

---

# 61. Handle

La capa resuelve completamente la Failure.

---

# 62. Translate

La convierte a una abstracción apropiada.

---

# 63. Propagate

La entrega a una capa superior sin perder significado.

---

# 64. Escalate

Incrementa el nivel de tratamiento porque no puede manejarse localmente.

---

# 65. Catch-and-Ignore

Deberá evitarse:

```text
try
  operation
catch
  do nothing
```

salvo que ignorar sea una Policy explícita.

---

# 66. Catch-and-Log

No deberá utilizarse automáticamente si posteriormente se vuelve a propagar y otra Boundary registrará el mismo Error.

---

# 67. Duplicate Logging

Registrar la misma Failure en cada capa produce ruido.

Deberá favorecerse Logging en la Boundary responsable.

---

# 68. Log Once Principle

Una Failure debería registrarse una vez con suficiente contexto, salvo que exista razón operacional para múltiples registros.

---

# 69. Error Boundary

Un Error Boundary es una frontera responsable de transformar o presentar una Failure.

Ejemplos:

```text
HTTP
CLI
Worker
Event Handler
Scheduler
Runtime Bootstrap
```

---

# 70. HTTP Boundary

Podrá transformar:

```text
Domain/Application Error
      ↓
HTTP Response
```

---

# 71. CLI Boundary

Podrá transformar:

```text
MEF Error
   ↓
Exit Code
+
Diagnostic
```

---

# 72. Worker Boundary

Podrá transformar Failure en:

```text
retry
dead-letter
failure state
```

---

# 73. Event Handler Boundary

ENG-022 deberá decidir:

```text
retry
continue
fail-fast
dead-letter
```

según Policy.

---

# 74. Bootstrap Boundary

Errores críticos de Bootstrap deberán impedir Activation cuando corresponda.

---

# 75. Runtime Boundary

Failures no recuperables del Runtime deberán conducir a estado seguro conforme ENG-015.

---

# 76. Result Pattern

Las operaciones podrán representar resultados esperados mediante:

```text
Result<T, E>
```

o equivalente conceptual.

---

# 77. Result Success

```text
Result::success(value)
```

---

# 78. Result Failure

```text
Result::failure(error)
```

---

# 79. Result Use Case

Result es especialmente apropiado cuando Failure forma parte normal del Contract.

---

# 80. Exception Use Case

Exception es apropiada cuando:

- la operación no puede continuar normalmente;
- la Failure no forma parte del flujo esperado;
- el lenguaje/framework la representa naturalmente;
- existe Boundary responsable.

---

# 81. No Universal Result Requirement

MEF no deberá obligar a utilizar Result para toda operación.

---

# 82. No Universal Exception Requirement

MEF tampoco deberá obligar a representar toda Failure mediante Exceptions.

---

# 83. Domain Errors

Los errores de negocio esperados deberían representarse explícitamente.

Ejemplo:

```text
InsufficientFunds
```

en lugar de:

```text
RuntimeException("error")
```

---

# 84. Generic Exception

Deberá evitarse para condiciones arquitectónicamente significativas.

---

# 85. Framework Exception Hierarchy

Un Implementation Profile basado en Exceptions podrá utilizar:

```text
MefException
├── ConfigurationException
├── ContractException
├── ContainerException
├── RegistryException
├── EventBusException
├── RuntimeException
└── SecurityException
```

---

# 86. Technology Neutrality

La jerarquía anterior es conceptual.

MEF deberá permanecer independiente del lenguaje.

---

# 87. Error Descriptor

La representación portable podrá utilizar:

```text
ErrorDescriptor
```

independiente de Exceptions.

---

# 88. Exception Adapter

Una Exception podrá transportar o mapear a `ErrorDescriptor`.

---

# 89. Error Immutability

Una vez creada y propagada, la identidad fundamental del Error no debería mutarse.

---

# 90. Context Enrichment

Las capas podrán enriquecer contexto sin cambiar la causa original.

---

# 91. Context Example

```text
code:
MEF-REG-004

context:
module: MOD-CUSTOMER
phase: bootstrap
manifest: customer.yaml
```

---

# 92. Context Safety

El Context no deberá incluir automáticamente:

```text
password
token
secret
authorization header
private key
```

---

# 93. Sensitive Data

Los errores deberán minimizar información sensible.

---

# 94. User Message

El mensaje mostrado a usuario podrá ser diferente del mensaje diagnóstico.

---

# 95. Diagnostic Message

Puede contener información técnica adicional para operadores/desarrolladores.

---

# 96. Public vs Internal Error

Conceptualmente:

```text
Internal Error
     ↓
Boundary Mapping
     ↓
Public Error
```

---

# 97. Public Error

Deberá ser:

```text
safe
stable
documented
appropriate to consumer
```

---

# 98. Internal Error

Puede contener detalles técnicos adicionales sujetos a Security Policy.

---

# 99. Stack Trace

Un Stack Trace es información diagnóstica interna.

No deberá exponerse por defecto a usuarios externos.

---

# 100. Production Mode

En Production deberán ocultarse detalles internos innecesarios.

---

# 101. Development Mode

Podrá mostrar Diagnostics ampliados conforme Configuration.

---

# 102. Error Exposure Policy

ENG-011 deberá permitir Configuration gobernada sin comprometer Security.

---

# 103. Correlation

Todo Error relevante debería poder asociarse a:

```text
correlationId
```

cuando exista Context.

---

# 104. Event Correlation

Los Errors de Event Handlers deberán preservar Correlation del Event.

---

# 105. Trace Correlation

Podrán integrarse:

```text
traceId
spanId
```

con Observability.

---

# 106. Error Timestamp

Los Diagnostics podrán registrar cuándo ocurrió la Failure.

---

# 107. Error Origin

Podrá registrarse:

```text
module
component
operation
runtime phase
```

---

# 108. Error Ownership

Los códigos deberán pertenecer a un subsistema responsable.

---

# 109. Ownership Example

```text
MEF-EVT-008
owner:
ENG-022 / Event Bus
```

---

# 110. Cross-Subsystem Error

La capa superior deberá traducirlo cuando necesite expresar una semántica diferente.

---

# 111. Error Registry

MEF deberá mantener catálogo gobernado de códigos.

---

# 112. Error Registry Entry

Conceptualmente:

```text
ErrorDefinition
├── code
├── owner
├── category
├── severity
├── retryability
├── description
├── public
└── status
```

---

# 113. Error Status

Podrá utilizar:

```text
Active
Deprecated
Retired
```

---

# 114. Error Code Deprecation

Un código público no deberá reutilizarse con significado distinto después de retirarse.

---

# 115. Error Code Versioning

No será necesario añadir versión al Error Code en cada Release.

---

# 116. Semantic Stability

Cambiar radicalmente el significado de un Error Code constituye incompatibilidad.

---

# 117. Contract Compatibility

Agregar/eliminar Errors documentados deberá evaluarse conforme ENG-016 y ENG-021.

---

# 118. Error Set

Un Contract podrá declarar:

```text
errors:
  - CUSTOMER_NOT_FOUND
  - CUSTOMER_ALREADY_EXISTS
```

---

# 119. Open vs Closed Error Set

El Contract deberá indicar cuando sea relevante si el conjunto de Errors es:

```text
closed
extensible
```

---

# 120. Unknown Error

Consumers robustos deberán disponer de estrategia para Errors desconocidos cuando el Contract permita extensibilidad.

---

# 121. Error Serialization

Cuando una Failure cruce proceso/red deberá existir representación serializable segura.

---

# 122. Serialized Error

Podrá contener:

```text
code
message
category
correlationId
details
```

según Boundary.

---

# 123. Cause Serialization

La cadena causal completa no deberá enviarse automáticamente fuera del Trust Boundary.

---

# 124. Remote Error

Un Error remoto deberá traducirse a abstracción local apropiada.

---

# 125. Remote Stack Trace

No deberá tratarse como Stack Trace local.

---

# 126. Network Failure

Deberá distinguirse entre:

```text
remote operation returned failure
```

y:

```text
could not communicate with remote operation
```

---

# 127. Timeout

Timeout representa incertidumbre.

No siempre significa que la operación remota no ocurrió.

---

# 128. Timeout Retry

Debe considerar Idempotency.

---

# 129. Cancellation

Cancellation no deberá confundirse automáticamente con Failure.

---

# 130. Cancellation Outcome

Podrá ser un estado separado:

```text
Success
Failure
Cancelled
```

---

# 131. User Cancellation

Puede ser un resultado esperado.

---

# 132. System Cancellation

Puede representar Shutdown, Timeout o Resource Policy.

---

# 133. Validation Error

Una Failure de validación deberá identificar campos/reglas sin exponer detalles sensibles.

---

# 134. Validation Collection

Podrá contener múltiples Violations.

---

# 135. Validation Structure

Ejemplo:

```text
ValidationError
├── code
└── violations
    ├── field
    ├── rule
    └── message
```

---

# 136. Validation Is Not Exception by Default

La entrada inválida esperada no necesita considerarse fallo interno excepcional.

---

# 137. Invariant Violation

Una violación de Invariant interna es más grave que Input Validation.

---

# 138. Assertion

Assertions podrán utilizarse para detectar Defects.

No deberán sustituir validación de Inputs no confiables.

---

# 139. Programmer Error

Ejemplos:

```text
invalid API usage
impossible state
incorrect dependency graph assumption
```

---

# 140. Programmer Error Recovery

No deberá ocultarse mediante fallback silencioso.

---

# 141. Configuration Error

ENG-011 deberá producir Errors específicos.

Ejemplos:

```text
missing required setting
invalid value
configuration source unavailable
```

---

# 142. Bootstrap Error

Durante Bootstrap una Failure deberá incluir:

```text
phase
component
cause
```

---

# 143. Bootstrap Phases

Ejemplos:

```text
configuration
package discovery
manifest validation
registry
container
contracts
events
modules
activation
```

---

# 144. Bootstrap Aggregation

Failures independientes podrán agregarse para mostrar múltiples problemas antes de abortar cuando sea seguro.

---

# 145. Fail-Fast Bootstrap

Failures que invaliden el estado global deberán detener inmediatamente el proceso.

---

# 146. Aggregate Error

MEF podrá representar múltiples Failures mediante:

```text
AggregateError
```

---

# 147. Aggregate Structure

```text
AggregateError
├── code
├── message
└── errors[]
```

---

# 148. Aggregate Cause

No deberá perder la identidad individual de cada Error.

---

# 149. Container Error

ENG-019 podrá producir:

```text
binding not found
circular dependency
construction failure
scope violation
```

---

# 150. DI Error

ENG-018 podrá producir:

```text
unresolvable dependency
ambiguous dependency
invalid injection target
```

---

# 151. Registry Error

ENG-020 podrá producir:

```text
duplicate identity
invalid metadata
registry conflict
unknown entry
```

---

# 152. Contract Error

ENG-021 define:

```text
MEF-CT-001 ... MEF-CT-015
```

---

# 153. Event Error

ENG-022 define:

```text
MEF-EVT-001 ... MEF-EVT-020
```

---

# 154. Error Handling Errors

ENG-023 utilizará namespace:

```text
MEF-ERR-xxx
```

---

# 155. Taxonomía ENG-023

```text
MEF-ERR-001 Invalid error definition
MEF-ERR-002 Duplicate error code
MEF-ERR-003 Unknown error code
MEF-ERR-004 Invalid error category
MEF-ERR-005 Invalid severity
MEF-ERR-006 Invalid cause chain
MEF-ERR-007 Circular cause chain
MEF-ERR-008 Error translation failed
MEF-ERR-009 Unsafe error exposure
MEF-ERR-010 Invalid retry classification
MEF-ERR-011 Invalid error context
MEF-ERR-012 Error serialization failed
MEF-ERR-013 Error deserialization failed
MEF-ERR-014 Invalid aggregate error
MEF-ERR-015 Error boundary failure
```

---

# 156. Invalid Error Definition

```text
MEF-ERR-001

Invalid error definition.

Code:
MEF-XYZ-001

Reason:
Missing category.
```

---

# 157. Duplicate Code

```text
MEF-ERR-002

Duplicate error code detected.

Code:
MEF-EVT-008

Existing owner:
Event Bus

Conflicting owner:
Custom Module
```

---

# 158. Circular Cause

```text
MEF-ERR-007

Circular error cause chain detected.

A
→ B
→ C
→ A
```

---

# 159. Unsafe Exposure

```text
MEF-ERR-009

Unsafe error exposure prevented.

Boundary:
HTTP

Detected:
stack trace

Policy:
production
```

---

# 160. Error Boundary Failure

Un Error Boundary que falla al procesar otro Error deberá utilizar fallback seguro.

---

# 161. Last-Resort Handler

El Runtime deberá poseer un mecanismo final para Failures no capturadas.

---

# 162. Last-Resort Responsibilities

Deberá:

```text
capture
sanitize
log
correlate
terminate safely when necessary
```

---

# 163. Last-Resort Limitation

No deberá intentar recuperar arbitrariamente de un estado desconocido.

---

# 164. Uncaught Failure

Toda Failure no manejada que alcance Runtime Boundary deberá diagnosticarse.

---

# 165. Panic/Fatal Handler

Un Implementation Profile podrá implementar mecanismo equivalente a:

```text
panic handler
fatal error handler
uncaught exception handler
```

---

# 166. Safe Termination

Si el estado es inseguro deberá preferirse terminación controlada.

---

# 167. Graceful Degradation

Cuando sea posible, un subsistema opcional podrá degradarse sin detener todo Runtime.

---

# 168. Required vs Optional Component

La recuperación dependerá de si el componente es:

```text
required
optional
```

---

# 169. Optional Module Failure

Un Module opcional podría marcarse Failed sin impedir Activation global si Architecture lo permite.

---

# 170. Required Module Failure

Un Module requerido deberá impedir un estado global que afirme falsamente funcionamiento completo.

---

# 171. State Machine Integration

ENG-015 deberá gobernar transiciones provocadas por Failures.

Ejemplo:

```text
INITIALIZING
    ↓ failure
FAILED
```

---

# 172. No Hidden State Transition

Un Error Handler no deberá cambiar arbitrariamente Runtime State fuera de ENG-015.

---

# 173. Event Bus Integration

ENG-022 utilizará clasificación de Retryability.

---

# 174. Handler Error Flow

```text
Handler
   ↓
Failure
   ↓
Classification
   ↓
Event Bus Policy
   ├── retry
   ├── continue
   ├── fail
   └── dead-letter
```

---

# 175. Handler Business Failure

No toda Failure de Handler debe reintentarse.

Ejemplo:

```text
InvalidRecipient
```

puede ser definitiva.

---

# 176. Handler Infrastructure Failure

Ejemplo:

```text
EmailProviderUnavailable
```

puede ser Retryable.

---

# 177. Error Does Not Decide Retry Alone

La Policy deberá considerar:

```text
error.retryable
handler idempotency
attempt
runtime state
```

---

# 178. Contract Integration

ENG-021 deberá declarar errores observables.

---

# 179. Error Compatibility

Cambiar:

```text
Error A
```

por:

```text
Error B
```

puede constituir Breaking Change.

---

# 180. Security Integration

ENG-024 deberá definir reglas específicas para:

```text
authentication failures
authorization failures
security policy violations
attack indicators
```

---

# 181. Authentication Error Disclosure

No deberá revelar información que facilite enumeración de cuentas cuando Security Policy lo prohíba.

---

# 182. Authorization Error Disclosure

No deberá revelar recursos inaccesibles innecesariamente.

---

# 183. Security Error Logging

Puede requerir Audit adicional.

---

# 184. Logging Integration

ENG-010 deberá registrar Errors de manera estructurada.

---

# 185. Structured Error Log

Ejemplo conceptual:

```text
timestamp
level
error.code
error.category
error.message
module
operation
correlationId
traceId
cause
```

---

# 186. Error Object Logging

El Logger debería comprender la estructura del Error.

---

# 187. Stack Trace Logging

Podrá registrarse internamente para Errors excepcionales.

---

# 188. Expected Failure Logging

No todo Error esperado deberá registrarse como ERROR.

---

# 189. Validation Failure Logging

Una entrada inválida de usuario normalmente no debería generar ERROR operacional.

---

# 190. Security Event

Una Failure aparentemente esperada puede requerir Security Audit según Policy.

---

# 191. Observability

Metrics podrán incluir:

```text
errors_total
errors_by_code
errors_by_category
retryable_errors_total
fatal_errors_total
unhandled_errors_total
```

---

# 192. Error Cardinality

No deberán utilizarse mensajes completos como Labels de Metrics de alta cardinalidad.

---

# 193. Error Code Metric

Deberá preferirse:

```text
error_code=MEF-EVT-008
```

---

# 194. Tracing

Un Error podrá marcar el Span correspondiente.

---

# 195. Trace Error Status

Deberá distinguirse entre:

```text
business failure
technical failure
```

cuando el sistema de Observability lo permita.

---

# 196. Testing

ENG-009 deberá cubrir Error Handling.

---

# 197. Error Unit Tests

Deberán verificar:

```text
code
category
severity
retryability
cause
context
```

---

# 198. Translation Tests

Cada Translator deberá comprobar mapeos.

---

# 199. Cause Preservation Test

El wrapping deberá conservar Cause.

---

# 200. Exposure Test

Deberá verificar que Production no expone:

```text
stack traces
secrets
internal paths
credentials
```

---

# 201. Retry Classification Test

Deberá verificar Errors Retryable y Non-Retryable.

---

# 202. Boundary Test

Cada Boundary importante deberá probar su representación final.

---

# 203. HTTP Error Test

Ejemplo:

```text
CustomerNotFound
      ↓
404
```

si esa es la política del Adapter HTTP.

---

# 204. CLI Error Test

Deberá comprobar:

```text
exit code
diagnostic
verbosity
```

---

# 205. Event Handler Error Test

Deberá comprobar integración con Retry/DLQ.

---

# 206. Aggregate Error Test

Deberá preservar todos los Errors internos.

---

# 207. Fatal Error Test

Deberá verificar transición segura de Runtime.

---

# 208. Fault Injection

Testing podrá introducir Failures deliberadamente.

Ejemplos:

```text
database unavailable
network timeout
invalid manifest
handler failure
```

---

# 209. Chaos Testing

Podrá incorporarse en fases posteriores para sistemas distribuidos.

No será requisito inicial.

---

# 210. CLI Integration

ENG-007 podrá incorporar:

```text
mef error list
mef error inspect
mef error validate
mef error trace
```

---

# 211. `error list`

Podrá mostrar catálogo de Error Codes.

---

# 212. `error inspect`

Ejemplo:

```text
Code:
MEF-EVT-008

Owner:
Event Bus

Category:
Infrastructure/Application

Severity:
error

Retryability:
policy-dependent
```

---

# 213. `error validate`

Validará:

```text
duplicate codes
invalid definitions
unknown owners
invalid categories
```

---

# 214. `error trace`

Podrá reconstruir Cause Chain a partir de Diagnostics disponibles.

---

# 215. Machine Output

Los comandos deberán permitir formato estructurado.

---

# 216. Build Integration

ENG-012 podrá validar:

```text
duplicate error codes
invalid taxonomy
missing definitions
invalid references
unsafe public mappings
```

---

# 217. Quality Gate

Errores estructurales del catálogo deberán bloquear Build cuando corresponda.

---

# 218. Static Analysis

Tooling podrá detectar:

```text
empty catch
generic catch
throw without cause
unsafe exception exposure
```

cuando el lenguaje lo permita.

---

# 219. Catch Generic Exception

Puede ser válido en Boundary.

Deberá evitarse indiscriminadamente dentro de lógica interna.

---

# 220. Error Documentation

Los Error Codes públicos deberán documentarse.

---

# 221. Documentation Entry

Deberá incluir:

```text
code
meaning
owner
conditions
retryability
consumer action
```

cuando corresponda.

---

# 222. Consumer Action

Ejemplo:

```text
MEF-CT-001
→ verify Contract installation/version
```

---

# 223. Operator Action

Podrá diferenciarse de Consumer Action.

---

# 224. Developer Action

También podrá existir guía específica.

---

# 225. Error Runbook

Errors operacionales críticos podrán vincularse a Runbook.

---

# 226. Runbook Independence

El Error Code no deberá depender de que el Runbook esté disponible para conservar significado.

---

# 227. Localization

Los Error Codes permanecerán estables independientemente del idioma.

---

# 228. Localized Message

La presentación humana podrá localizarse.

---

# 229. Machine Consumers

Los Consumers automatizados deberán utilizar:

```text
code
structured fields
```

y no analizar texto libre.

---

# 230. Message Parsing

Deberá evitarse:

```text
if message contains "timeout"
```

---

# 231. Error Equality

Dos Errors con mismo Code no son necesariamente la misma ocurrencia.

---

# 232. Error Instance ID

Podrá existir identificador único para una ocurrencia diagnóstica.

---

# 233. Error Code vs Error Instance

```text
MEF-EVT-008
→ tipo

ERR-01J...
→ ocurrencia
```

---

# 234. Diagnostic ID

Podrá mostrarse al usuario para soporte.

Ejemplo:

```text
Reference:
ERR-01J...
```

---

# 235. Diagnostic Lookup

Observability podrá localizar la Failure mediante ese ID.

---

# 236. Error Context Propagation

Cada capa podrá añadir contexto relevante.

---

# 237. Context Merge

No deberá sobrescribir silenciosamente información causal importante.

---

# 238. Reserved Context Keys

MEF podrá reservar:

```text
module
component
operation
phase
correlationId
traceId
```

---

# 239. Arbitrary Context

Modules podrán añadir metadata namespaced.

---

# 240. Context Cardinality

Deberá considerarse impacto en Logs/Metrics.

---

# 241. Error Serialization Version

La representación serializada podrá requerir versión propia.

---

# 242. Serialization Compatibility

Deberá permitir que Consumers interpreten Errors soportados.

---

# 243. Unknown Fields

Deberán tolerarse cuando el formato lo permita.

---

# 244. Error Transport

El transporte no deberá modificar semántica del Error.

---

# 245. HTTP Mapping

El código MEF no deberá confundirse con HTTP Status.

Ejemplo:

```text
MEF-DOM-004
→ HTTP 409
```

---

# 246. CLI Mapping

El código MEF tampoco deberá confundirse con Process Exit Code.

---

# 247. Exit Codes

CLI podrá mapear categorías a un conjunto limitado de Exit Codes.

---

# 248. Event Mapping

Un Error de Handler tampoco es automáticamente un Event.

---

# 249. Error Event

Podrá publicarse un Event operacional sobre una Failure cuando exista Contract explícito.

---

# 250. No Error-to-Event Recursion

El sistema deberá evitar ciclos:

```text
Error
 ↓
ErrorEvent
 ↓
Handler Failure
 ↓
ErrorEvent
```

---

# 251. Fallback Logging

Si Event Bus falla durante Error Reporting deberá existir Logger independiente o mecanismo de último recurso.

---

# 252. Error Reporting Independence

La infraestructura de Error Reporting no debería depender completamente del subsistema que está fallando.

---

# 253. Runtime Error Sink

Podrá existir un `ErrorSink` de último recurso.

---

# 254. Error Sink

Responsabilidad conceptual:

```text
accept critical diagnostic
write safely
avoid recursion
```

---

# 255. Error Sink Limitations

No deberá ejecutar lógica compleja.

---

# 256. Shutdown Errors

Durante Shutdown deberán manejarse de forma especial.

---

# 257. Shutdown Aggregation

Puede ser preferible intentar cerrar múltiples recursos y agregar Failures.

---

# 258. Shutdown Criticality

Un fallo al cerrar un recurso no siempre debe impedir cerrar los demás.

---

# 259. Cleanup Failure

No deberá ocultar necesariamente la Failure primaria.

---

# 260. Primary vs Secondary Error

Ejemplo:

```text
Primary:
OperationFailed

Secondary:
CleanupFailed
```

---

# 261. Suppressed Error

Un Implementation Profile podrá soportar Errors secundarios/suprimidos.

---

# 262. Cause vs Suppressed

Deberán distinguirse:

```text
cause
→ produjo el error actual

suppressed
→ ocurrió adicionalmente durante manejo/cleanup
```

---

# 263. Resource Cleanup

Deberá ejecutarse mediante mecanismos seguros del lenguaje cuando existan.

---

# 264. Partial Success

Algunas operaciones pueden terminar:

```text
PartiallySuccessful
```

---

# 265. Partial Failure

No deberá representarse falsamente como Success completo.

---

# 266. Batch Operation

Podrá devolver:

```text
BatchResult
├── successes
└── failures
```

---

# 267. Aggregate Failure Semantics

Un Batch deberá definir si:

```text
one failure aborts all
continue processing
transactional all-or-nothing
```

---

# 268. Concurrency Errors

Procesamiento concurrente deberá preservar cada Failure.

---

# 269. Race Condition

Una Race detectada como Defect no debería transformarse en Business Error.

---

# 270. Timeout Hierarchy

Timeouts podrán existir en:

```text
operation
handler
network
transaction
runtime shutdown
```

---

# 271. Timeout Context

El Error deberá indicar qué Boundary expiró.

---

# 272. Circuit Breaker

Un Circuit Open deberá distinguirse del Failure original.

---

# 273. Rate Limit

Deberá poder incluir información segura sobre Retry.

Ejemplo:

```text
retryAfter
```

---

# 274. Resource Exhaustion

Puede requerir reducción de carga o terminación controlada.

---

# 275. Memory Exhaustion

No deberá asumirse que puede manejarse mediante lógica compleja.

---

# 276. Disk Full

Podrá afectar Logging.

Por ello el Last-Resort Handler deberá mantenerse simple.

---

# 277. Error Storm

Muchos Errors idénticos pueden saturar Observability.

---

# 278. Rate-Limited Logging

Podrá aplicarse a Failures repetitivas.

---

# 279. Error Sampling

Podrá utilizarse para Diagnostics de alto volumen.

No deberá ocultar Metrics agregadas críticas.

---

# 280. Alerting

Los Error Codes estables facilitan Alerting.

---

# 281. Alert Policy

No todo Error deberá generar alerta.

---

# 282. Critical Alert

Deberá reservarse para condiciones que requieren acción operacional.

---

# 283. Error Budget

Sistemas posteriores podrán relacionar categorías con SLO/Error Budgets.

No forma parte de la primera implementación.

---

# 284. Primera Implementación Recomendada

La primera versión deberá implementar:

```text
ErrorDescriptor
ErrorCode
ErrorCategory
ErrorSeverity

MefException
ErrorTranslator
ErrorBoundary
ErrorRegistry

Cause Chain
Correlation Context
Structured Logging
Retryable Flag
Public/Internal Mapping
Last-Resort Handler
```

---

# 285. Estructura Conceptual

```text
src/
└── Error/
    ├── ErrorDescriptor
    ├── ErrorCode
    ├── ErrorCategory
    ├── ErrorSeverity
    ├── ErrorRegistry
    ├── ErrorTranslator
    ├── ErrorBoundary
    ├── ErrorContext
    ├── AggregateError
    └── Exception/
        └── MefException
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 286. Segunda Fase

Podrá incorporar:

```text
Diagnostic IDs
Error Catalog Generator
Static Error Analysis
HTTP Error Mapper
CLI Error Mapper
Error Metrics
Error Trace Tool
Runbook Integration
```

---

# 287. Tercera Fase

Solo cuando exista necesidad:

```text
Distributed Error Serialization
Cross-Service Cause Correlation
Error Sampling
Advanced Alert Policies
Automated Root Cause Analysis
SLO/Error Budget Integration
```

---

# 288. Invariantes de Ingeniería

ENG-023 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-406 | Toda Failure arquitectónicamente significativa deberá poseer una clasificación comprensible dentro de la Boundary que la maneja. |
| EI-407 | Error Code y Error Message deberán mantenerse como conceptos separados. |
| EI-408 | Los Error Codes públicos deberán conservar significado estable y no reutilizarse para condiciones diferentes. |
| EI-409 | Failure y Exception deberán mantenerse conceptualmente separadas. |
| EI-410 | Los Errors esperados que formen parte de un Contract deberán representarse explícitamente. |
| EI-411 | Las capas no deberán filtrar indiscriminadamente Errors específicos de Implementation a fronteras superiores. |
| EI-412 | Toda traducción de Error deberá preservar la causa original cuando sea seguro y técnicamente posible. |
| EI-413 | Las Cause Chains no deberán contener ciclos. |
| EI-414 | Retryability no deberá implicar automáticamente que Retry sea seguro o obligatorio. |
| EI-415 | Todo Retry deberá considerar Idempotency, Side Effects y Attempt Policy. |
| EI-416 | Los Errors públicos no deberán exponer Secrets, Stack Traces ni detalles internos sensibles por defecto. |
| EI-417 | Un Error esperado no deberá registrarse automáticamente como Error operacional severo. |
| EI-418 | El mismo Failure no deberá registrarse repetidamente en cada capa sin justificación operacional. |
| EI-419 | Toda Boundary pública deberá mapear Failures internas a una representación apropiada para su Consumer. |
| EI-420 | Las Failures no manejadas deberán alcanzar una Boundary de último recurso capaz de diagnosticarlas de forma segura. |
| EI-421 | Los Error Handlers no deberán realizar transiciones arbitrarias fuera del State Machine gobernado por ENG-015. |
| EI-422 | Los Errors de Event Handlers deberán conservar el Context de Correlation cuando esté disponible. |
| EI-423 | Los cambios en Errors contractualmente observables deberán someterse a Compatibility. |
| EI-424 | La infraestructura de Error Reporting deberá evitar depender exclusivamente del subsistema que se encuentra fallando. |
| EI-425 | Una Failure Fatal deberá conducir al Runtime hacia un estado seguro en lugar de permitir continuación bajo estado desconocido. |

---

# 289. Continuidad de Invariantes

```text
ENG-018 → EI-306 a EI-325
ENG-019 → EI-326 a EI-345
ENG-020 → EI-346 a EI-365
ENG-021 → EI-366 a EI-385
ENG-022 → EI-386 a EI-405
ENG-023 → EI-406 a EI-425
```

---

# 290. Criterios de Conformidad

Una implementación será conforme con ENG-023 cuando:

- posea Error Codes estables;
- mantenga catálogo gobernado;
- distinga Failure de Exception;
- distinga Errors esperados de excepcionales;
- clasifique Errors;
- preserve Cause Chains;
- permita Translation;
- evite Implementation Leakage;
- permita Retryability explícita;
- proteja información sensible;
- integre Correlation;
- integre Logging;
- integre Event Bus;
- integre Contracts;
- permita Error Boundaries;
- disponga de Last-Resort Handler;
- permita Testing;
- mantenga independencia tecnológica.

---

# 291. Riesgos

Deberán evitarse especialmente:

## Generic Exception Everywhere

```text
throw new Exception("Something failed")
```

elimina semántica.

## Catch and Ignore

Oculta Failures.

## Catch and Log Everywhere

Produce duplicación y ruido.

## Vendor Error Leakage

Expone detalles internos a Consumers.

## Message-Based Logic

```text
if error.message contains "timeout"
```

es frágil.

## Retry Everything

Puede duplicar efectos o empeorar una falla.

## Retry Nothing

Pierde recuperación ante errores transitorios.

## Stack Trace Exposure

Expone internals y potencialmente información sensible.

## Error Code Reuse

Rompe automatización y Compatibility.

## Error Translation Without Cause

Destruye Root Cause.

## Result Everywhere

Complica innecesariamente operaciones que deberían usar mecanismos naturales del lenguaje.

## Exception Everywhere

Convierte resultados esperados en control de flujo excepcional.

## Error Event Recursion

El sistema de reporte produce nuevos errores indefinidamente.

## Recovery from Unknown State

Intentar continuar después de una Failure Fatal puede corromper Runtime.

---

# 292. Arquitectura Recomendada

```text
                         OPERATION
                            │
                            ▼
                          OUTCOME
                            │
                ┌───────────┴───────────┐
                ▼                       ▼
             SUCCESS                 FAILURE
                                        │
                                        ▼
                                CLASSIFICATION
                                        │
                     ┌──────────────────┼──────────────────┐
                     ▼                  ▼                  ▼
                  HANDLE            TRANSLATE          PROPAGATE
                                        │                  │
                                        └─────────┬────────┘
                                                  ▼
                                             BOUNDARY
                                                  │
                               ┌──────────────────┼─────────────────┐
                               ▼                  ▼                 ▼
                           PUBLIC ERROR        LOGGING          RECOVERY
                                                                      │
                                                        ┌─────────────┼─────────────┐
                                                        ▼             ▼             ▼
                                                     RETRY         FALLBACK       FAIL
```

---

# 293. Flujo de Traducción Recomendado

```text
External Infrastructure
        │
        ▼
Vendor Exception
        │
        ▼
Infrastructure Adapter
        │
        ▼
Infrastructure Error
        │
        ▼
Application Boundary
        │
        ▼
Application / Domain Error
        │
        ▼
Delivery Boundary
        │
        ├── HTTP
        ├── CLI
        ├── Event
        └── Worker
```

---

# 294. Flujo de Runtime

```text
Component Failure
       │
       ▼
Error Classification
       │
       ├── Recoverable
       │       │
       │       ├── Retry
       │       └── Fallback
       │
       ├── Non-Recoverable
       │       │
       │       └── Operation Failure
       │
       └── Fatal
               │
               ▼
        Runtime Boundary
               │
               ▼
          Safe State
```

---

# 295. Relación con ENG-018

Dependency Injection deberá producir errores explícitos cuando una dependencia no pueda resolverse.

```text
Dependency Request
       ↓
DI Resolution
       ↓
Failure
       ↓
MEF-DI-xxx
```

ENG-023 gobierna su tratamiento transversal.

---

# 296. Relación con ENG-019

Service Container deberá preservar causas durante Construction Failures.

```text
Container
   ↓
Construction
   ↓
Dependency Failure
   ↓
Container Error
```

---

# 297. Relación con ENG-020

Registry deberá producir Errors estructurados para:

```text
duplicate identity
unknown entry
invalid metadata
conflict
```

---

# 298. Relación con ENG-021

Contracts determinan qué Errors forman parte de la superficie observable.

ENG-023 determina cómo se representan, traducen y propagan.

```text
ENG-021
What Errors are contractual?

ENG-023
How are Errors handled?
```

---

# 299. Relación con ENG-022

Event Bus consume Error Classification para decidir:

```text
Handler Failure
      ↓
Error Descriptor
      ↓
Retryability
      ↓
Event Policy
      ├── retry
      ├── continue
      ├── fail
      └── dead-letter
```

---

# 300. Relación con ENG-024

Security Engineering deberá especializar:

```text
authentication errors
authorization errors
security violations
attack indicators
sensitive diagnostics
audit
```

ENG-023 proporciona el modelo transversal.

---

# 301. Relación con ENG-027

Runtime utilizará Error Handling durante:

```text
Bootstrap
Initialization
Activation
Execution
Shutdown
```

para determinar:

```text
continue
degrade
retry
fail component
fail runtime
```

---

# 302. Principio Rector

> **El Error Handling de MEF deberá convertir las condiciones de fallo en información estructurada, estable, trazable y segura, preservando su causalidad y semántica mientras atraviesan las fronteras arquitectónicas, sin filtrar detalles internos ni ocultar condiciones que comprometan la integridad del Runtime.**

---

# 303. Conclusión

**ENG-023 — Error Handling** establece un lenguaje común de Failure para todo MEF.

La cadena fundamental queda:

```text
Operation
   ↓
Failure
   ↓
Error Classification
   ↓
Error Code
   ↓
Cause Chain
   ↓
Translation
   ↓
Boundary
   ↓
Public Representation
   +
Diagnostics
```

Las responsabilidades quedan separadas:

```text
ENG-018
Dependency Injection
→ detecta Failures de resolución

ENG-019
Service Container
→ detecta Failures de construcción

ENG-020
Registry
→ detecta Failures de metadata/identidad

ENG-021
Contracts
→ define Errors observables

ENG-022
Event Bus
→ aplica políticas ante Handler Failures

ENG-023
Error Handling
→ clasifica, traduce, propaga y diagnostica
```

El resultado será un Runtime donde:

```text
PDOException
KafkaException
VendorException
Generic Runtime Error
```

no circulen arbitrariamente por toda la arquitectura.

En su lugar:

```text
Technical Failure
      ↓
Infrastructure Boundary
      ↓
MEF Error
      ↓
Application Boundary
      ↓
Contractual Error
      ↓
Consumer
```

preservando internamente:

```text
Error Code
Cause
Context
Correlation
Diagnostics
```

y exponiendo únicamente:

```text
Safe Information
Stable Semantics
Actionable Error
```

a cada Consumer.

La primera implementación deberá mantenerse concentrada en:

```text
ErrorDescriptor
+
ErrorCode
+
Category
+
Severity
+
Cause Chain
+
Translation
+
Error Boundary
+
Structured Logging
+
Last-Resort Handler
```

antes de introducir mecanismos avanzados de análisis distribuido.

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
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-024 — Security Engineering
- ENG-027 — Runtime Engineering