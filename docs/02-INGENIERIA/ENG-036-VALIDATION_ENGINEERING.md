---
id: ENG-036
titulo: Validation Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Validation Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-011
  - ENG-016
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-028
  - ENG-031
  - ENG-033
  - ENG-034
  - ENG-035
relacionados:
  - ENG-006
  - ENG-012
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-030
  - ENG-032
  - ENG-037
keywords:
  - validation
  - validator
  - rule
  - violation
  - schema
  - structural-validation
  - boundary-validation
  - domain-validation
  - application-precondition
  - configuration-validation
  - fail-fast
  - error-aggregation
  - mef
---

# ENG-036

# Validation Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Validation Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-036 establece las reglas para:

```text
Validation
Validation Boundary
Validation Rule
Validator
Validation Result
Violation
Structural Validation
Schema Validation
Boundary Validation
Application Validation
Application Preconditions
Domain Validation
Configuration Validation
Contract Validation
Persistence Validation
Transport Validation
Validation Composition
Fail-Fast Validation
Aggregate Validation
Validation Errors
Validation Observability
Validation Testing
```

---

# 2. Declaración

La regla fundamental será:

> **Toda validación deberá ejecutarse en la Boundary que posee conocimiento suficiente para decidir su validez, sin trasladar reglas de negocio fuera del Domain ni utilizar Validation como sustituto de Authorization, Error Handling o Consistency.**

Por tanto:

```text
Input
  │
  ▼
Structural Validation
  │
  ▼
Boundary Validation
  │
  ▼
Application Preconditions
  │
  ▼
Domain Invariants
```

Cada nivel responde una pregunta distinta.

---

# 3. Validation

`Validation` es el proceso mediante el cual un componente determina si determinados datos, estructuras, estados o condiciones satisfacen las reglas aplicables a su Boundary.

---

# 4. Validation Is Contextual

Un dato puede ser válido en una Boundary e inválido en otra.

Ejemplo:

```text
"ABC"
```

puede ser:

```text
valid string
invalid UUID
valid external reference
invalid CustomerId
```

---

# 5. Validation ≠ Business Logic

Validation no deberá convertirse en un contenedor genérico para todas las reglas del sistema.

---

# 6. Validation ≠ Authorization

```text
Validation
→ Is this input/state acceptable?

Authorization
→ Is this actor allowed to perform this operation?
```

ENG-024 continuará gobernando Authorization.

---

# 7. Validation ≠ Error Handling

```text
Validation
→ detects invalidity

Error Handling
→ represents, propagates and translates failures
```

ENG-023 seguirá siendo autoridad sobre Error Handling.

---

# 8. Validation ≠ Sanitization

Sanitization transforma datos.

Validation determina si cumplen reglas.

---

# 9. Validation ≠ Normalization

Normalization produce una representación canónica.

Ejemplo:

```text
" USER@EXAMPLE.COM "
        │
        ▼
"user@example.com"
```

cuando el Contract permita dicha transformación.

---

# 10. Validation ≠ Parsing

Parsing transforma representación en estructura.

```text
JSON
 ↓
Object
```

El Parser puede fallar antes de Validation semántica.

---

# 11. Validation ≠ Serialization

ENG-031 gobierna Serialization.

---

# 12. Validation ≠ Persistence Constraint

Una restricción de Database puede reforzar una regla, pero no sustituye automáticamente la Validation de la Boundary propietaria.

---

# 13. Validation Layers

MEF reconocerá conceptualmente:

```text
Structural Validation
Schema Validation
Boundary Validation
Application Validation
Domain Validation
Configuration Validation
Contract Validation
Persistence Validation
Transport Validation
Security Validation
```

---

# 14. Validation Architecture

```text
External Input
      │
      ▼
┌─────────────────────┐
│ Structural          │
│ Validation          │
└──────────┬──────────┘
           ▼
┌─────────────────────┐
│ Boundary / Schema   │
│ Validation          │
└──────────┬──────────┘
           ▼
┌─────────────────────┐
│ Application         │
│ Preconditions       │
└──────────┬──────────┘
           ▼
┌─────────────────────┐
│ Domain              │
│ Invariants          │
└──────────┬──────────┘
           ▼
       Valid State
```

---

# 15. Structural Validation

Determina si un Input posee estructura técnicamente interpretable.

Ejemplos:

```text
required field exists
value is string
value is integer
array has expected structure
payload can be parsed
```

---

# 16. Structural Ownership

Normalmente pertenecerá a:

```text
API
Transport
Serialization
Configuration
```

según la Boundary.

---

# 17. Structural Validation ≠ Domain Validation

Ejemplo:

```text
quantity is integer
```

es estructural.

```text
quantity cannot exceed available allocation
```

puede ser Domain.

---

# 18. Schema Validation

Valida una representación contra un Schema explícito.

Ejemplos:

```text
JSON Schema
OpenAPI Schema
Configuration Schema
Event Schema
Manifest Schema
```

---

# 19. Schema Authority

El Schema deberá corresponder al Contract de su Boundary.

---

# 20. Schema Version

Cuando sea público deberá respetar ENG-016.

---

# 21. Unknown Fields

La Policy deberá ser explícita.

Podrá ser:

```text
reject
ignore
preserve
```

según Contract.

---

# 22. Missing Required Field

Deberá producir Violation identificable.

---

# 23. Type Mismatch

Igualmente.

---

# 24. Boundary Validation

Valida reglas propias de una interfaz o Contract.

Ejemplos:

```text
maximum request size
allowed enum value
pagination limit
header format
filename format
```

---

# 25. Boundary Validation Ownership

La regla deberá vivir cerca de la Boundary que la define.

---

# 26. API Validation

ENG-033 podrá validar:

```text
path parameters
query parameters
headers
request body
media type
API schema
```

---

# 27. Transport Validation

ENG-032 podrá validar:

```text
frame
message envelope
protocol metadata
transport limits
```

---

# 28. Serialization Validation

ENG-031 podrá validar:

```text
wire representation
required serialized fields
type compatibility
schema compatibility
```

---

# 29. Application Validation

ENG-034 podrá validar Preconditions necesarias para ejecutar un Use Case.

---

# 30. Application Precondition

Representa una condición de ejecución que no constituye por sí misma una Invariant interna del Domain.

Ejemplos:

```text
required feature enabled
required dependency available
request context present
operation supported
```

---

# 31. Application Precondition ≠ Domain Invariant

Ejemplo:

```text
Payment provider configured
```

puede ser Application Precondition.

```text
Order cannot be approved without items
```

es Domain Invariant.

---

# 32. Domain Validation

ENG-035 continuará siendo Source of Truth para reglas de negocio.

---

# 33. Domain Validation Example

```text
Customer cannot exceed credit limit.
```

Si esta es una regla de negocio, deberá permanecer en Domain.

---

# 34. Domain Validator

Podrá existir cuando una regla Domain no pertenezca naturalmente a una sola Entity o Value Object.

---

# 35. Prefer Domain Behavior

Antes de crear:

```text
OrderValidator
```

deberá evaluarse si la regla pertenece realmente a:

```text
Order
OrderPolicy
OrderSpecification
Domain Service
```

---

# 36. Validator Explosion

No deberá trasladarse todo el Domain a clases `*Validator`.

---

# 37. Configuration Validation

ENG-011 deberá validar Configuration antes de que Runtime dependa de ella.

---

# 38. Configuration Validation Example

```text
required key
allowed value
numeric range
valid URI
mutually exclusive options
```

---

# 39. Configuration Semantic Validation

Podrá validar relaciones entre opciones.

Ejemplo:

```text
TLS enabled
→ certificate required
```

---

# 40. Configuration Fail Early

Configuration inválida requerida para Startup deberá detectarse antes de Readiness.

---

# 41. Contract Validation

ENG-021 podrá definir reglas que deben cumplir Implementations o Consumers.

---

# 42. Contract Input

Deberá validarse en la Boundary apropiada.

---

# 43. Contract Output

También podrá validarse, especialmente en Tests y Development.

---

# 44. Design by Contract

MEF podrá utilizar conceptos de:

```text
preconditions
postconditions
invariants
```

sin requerir un lenguaje formal de Contracts.

---

# 45. Preconditions

Deben cumplirse antes de una operación.

---

# 46. Postconditions

Describen garantías después de una operación exitosa.

---

# 47. Invariants

Permanecen verdaderas durante estados válidos del objeto/sistema correspondiente.

---

# 48. Persistence Validation

ENG-030 podrá validar:

```text
database constraints
mapping constraints
storage limits
optimistic concurrency expectations
```

---

# 49. Persistence Constraint

Podrá funcionar como Defense in Depth.

---

# 50. Unique Constraint

Puede proteger una propiedad de Storage.

Si representa Business Rule, el Domain/Application deberá modelar también su semántica cuando corresponda.

---

# 51. Database Error Translation

Una Constraint Violation no deberá exponerse directamente como Database Error cuando existe una abstracción superior apropiada.

---

# 52. Security Validation

ENG-024 continuará gobernando:

```text
credentials
tokens
signatures
permissions
capabilities
security policy
```

---

# 53. Security Input Validation

ENG-036 podrá definir mecanismos generales, pero ENG-024 posee la semántica Security.

---

# 54. Validator

Un `Validator<T>` evalúa un Subject contra una o varias Rules.

Conceptualmente:

```text
Validator<T>
    │
    ▼
ValidationResult
```

---

# 55. Validator Responsibility

Deberá:

```text
evaluate
report violations
remain deterministic where possible
avoid unrelated side effects
```

---

# 56. Validator Side Effects

No deberá:

```text
persist
send email
publish integration events
modify unrelated state
```

como efecto ordinario.

---

# 57. Pure Validator

Deberá favorecerse cuando sea posible.

---

# 58. Contextual Validator

Podrá requerir Context explícito.

---

# 59. Validation Context

Conceptualmente:

```text
ValidationContext
├── operation
├── locale
├── tenant
├── version
└── metadata
```

solo cuando sean necesarios.

---

# 60. Context ≠ Service Locator

No deberá contener Container/Runtime arbitrario.

---

# 61. Validation Rule

Una `ValidationRule<T>` representa una condición evaluable.

---

# 62. Rule Identity

Rules reutilizables deberían poseer identidad/nombre estable cuando ayude a:

```text
diagnostics
testing
documentation
metrics
```

---

# 63. Rule Composition

Podrá soportar:

```text
AND
OR
NOT
```

cuando la semántica sea clara.

---

# 64. Rule Ordering

Cuando el orden importe deberá declararse.

---

# 65. Rule Dependency

Una Rule no debería depender implícitamente del resultado oculto de otra.

---

# 66. Conditional Rule

Podrá ejecutarse cuando una condición previa sea válida.

---

# 67. Cross-Field Rule

Podrá evaluar múltiples propiedades.

Ejemplo:

```text
startDate <= endDate
```

---

# 68. Cross-Object Rule

Deberá colocarse en la Boundary que posee conocimiento suficiente.

---

# 69. Validation Result

Un `ValidationResult` representa el resultado completo de una evaluación.

Conceptualmente:

```text
ValidationResult
├── valid
├── violations[]
└── metadata
```

---

# 70. Valid Result

```text
valid = true
violations = []
```

---

# 71. Invalid Result

```text
valid = false
violations = [...]
```

---

# 72. Violation

Una `Violation` representa una regla incumplida.

---

# 73. Violation Structure

Conceptualmente:

```text
Violation
├── code
├── path
├── rule
├── messageKey
├── parameters
├── severity
└── metadata
```

No todos los campos serán obligatorios.

---

# 74. Stable Violation Code

Deberá favorecerse para Contracts machine-oriented.

---

# 75. Message

El texto humano no deberá ser el único identificador de una Violation.

---

# 76. Message Localization

Podrá ocurrir fuera del Validator mediante:

```text
messageKey
parameters
```

---

# 77. Path

Podrá identificar:

```text
customer.email
items[2].quantity
configuration.database.host
```

---

# 78. Path ≠ Internal Object Address

No deberá exponer internals sensibles innecesarios.

---

# 79. Severity

Podrá utilizarse:

```text
error
warning
info
```

cuando el Contract lo permita.

---

# 80. Warning

No deberá impedir automáticamente la operación salvo Policy explícita.

---

# 81. Error

Normalmente representa invalidación.

---

# 82. Validation Exception

Podrá existir para Boundaries que utilicen Exception-based control.

---

# 83. Validation Result vs Exception

MEF no impondrá una única estrategia universal.

---

# 84. Expected Invalid Input

Deberá favorecerse `ValidationResult` cuando la invalidación sea esperable y frecuente.

---

# 85. Programmer Contract Violation

Podrá justificar Exception.

---

# 86. Domain Invariant Violation

ENG-035/ENG-023 determinarán representación.

---

# 87. Error Namespace

ENG-036 utilizará:

```text
MEF-VAL-xxx
```

---

# 88. Taxonomía ENG-036

```text
MEF-VAL-001 Validation failed
MEF-VAL-002 Required value missing
MEF-VAL-003 Invalid value type
MEF-VAL-004 Invalid value format
MEF-VAL-005 Value outside allowed range
MEF-VAL-006 Value too short
MEF-VAL-007 Value too long
MEF-VAL-008 Unsupported value
MEF-VAL-009 Unknown field
MEF-VAL-010 Invalid schema
MEF-VAL-011 Schema version unsupported
MEF-VAL-012 Cross-field validation failed
MEF-VAL-013 Validation rule failed
MEF-VAL-014 Validator unavailable
MEF-VAL-015 Validator configuration invalid
MEF-VAL-016 Validation context invalid
MEF-VAL-017 Validation dependency unavailable
MEF-VAL-018 Validation cycle detected
MEF-VAL-019 Validation contract violation
MEF-VAL-020 Validation pipeline failed
```

---

# 89. Missing Value

```text
MEF-VAL-002

Required value missing.

Path:
customer.email
```

---

# 90. Invalid Format

```text
MEF-VAL-004

Invalid value format.

Path:
customer.email

Rule:
email-format
```

---

# 91. Range Violation

```text
MEF-VAL-005

Value outside allowed range.

Path:
page.size

Minimum:
1

Maximum:
100
```

---

# 92. Unknown Field

```text
MEF-VAL-009

Unknown field.

Path:
customer.legacyCode
```

---

# 93. Validation Cycle

```text
MEF-VAL-018

Validation cycle detected.

Rules:
RuleA
→ RuleB
→ RuleA
```

---

# 94. Fail-Fast Validation

Detiene evaluación después de una Violation suficiente.

---

# 95. Fail-Fast Use

Puede ser apropiado para:

```text
security-sensitive parsing
expensive validation
dependency ordering
invalid root structure
```

---

# 96. Aggregate Validation

Continúa evaluando para devolver varias Violations.

---

# 97. Aggregate Use

Puede ser apropiado para:

```text
forms
configuration
developer feedback
batch validation
```

---

# 98. Strategy Explicitness

La estrategia deberá ser explícita cuando afecte Contract observable.

---

# 99. Hybrid Validation

Podrá utilizar:

```text
fatal structural failure
→ fail fast

field violations
→ aggregate
```

---

# 100. Validation Pipeline

Podrá existir:

```text
ValidationPipeline<T>
```

---

# 101. Pipeline Architecture

```text
Subject
   │
   ▼
Rule 1
   │
   ▼
Rule 2
   │
   ▼
Rule 3
   │
   ▼
ValidationResult
```

---

# 102. Pipeline Ordering

Deberá ser determinista.

---

# 103. Pipeline Mutation

No deberá cambiar durante una Validation activa.

---

# 104. Validation Phase

Podrá agrupar Rules por fases:

```text
parse
structure
schema
semantic
context
```

---

# 105. Dependency-Aware Validation

Una fase posterior podrá omitirse si una fase requerida falla.

---

# 106. Example

No tiene sentido comprobar:

```text
startDate <= endDate
```

si `startDate` ni siquiera pudo convertirse en Date.

---

# 107. Cascading Validation

Objetos compuestos podrán validar Children.

---

# 108. Collection Validation

Podrá validar:

```text
minimum size
maximum size
individual elements
uniqueness
cross-element rules
```

---

# 109. Collection Limit

Deberá existir protección frente a Inputs excesivamente grandes cuando la Boundary sea externa.

---

# 110. Recursive Validation

Deberá poseer límites cuando Input no sea confiable.

---

# 111. Cycle Detection

Deberá impedir recursión infinita.

---

# 112. Validation Depth

Podrá limitarse.

---

# 113. Validation Resource Limits

Podrán incluir:

```text
max depth
max elements
max rules
max input size
deadline
```

---

# 114. Security Against Validation DoS

Inputs externos no deberán poder provocar consumo no acotado de:

```text
CPU
memory
stack
network
```

mediante Validation.

---

# 115. Regex Validation

Regex deberá diseñarse evitando catastrophic backtracking cuando procese Input no confiable.

---

# 116. External Lookup Validation

Deberá utilizarse con precaución.

---

# 117. Validator With I/O

Una Rule que requiere I/O deja de ser una Validation puramente local.

---

# 118. Existence Check

Ejemplo:

```text
customerId exists
```

puede ser Application Precondition o Repository Query, no necesariamente Field Validation.

---

# 119. Uniqueness Check

Ejemplo:

```text
email must be unique
```

requiere analizar si es:

```text
business rule
application coordination
persistence constraint
```

---

# 120. Race Condition

Validar:

```text
email is currently unique
```

antes de Insert no garantiza unicidad concurrente.

---

# 121. Persistence Enforcement

Cuando la regla requiere atomicidad, Persistence deberá reforzarla.

---

# 122. Validation Is Not Locking

Validation por sí sola no resuelve Concurrency.

---

# 123. Async Validation

Podrá existir para Dependencies externas.

---

# 124. Async Validator

Deberá indicar que puede producir I/O/latencia.

---

# 125. Async vs Sync

No deberán ocultarse Calls remotos dentro de Validators aparentemente locales.

---

# 126. Deadline

Async Validation deberá respetar Deadline.

---

# 127. Cancellation

También.

---

# 128. Retry

No deberá aplicarse ciegamente.

ENG-032/ENG-034 gobernarán Retry según Boundary.

---

# 129. Validation Cache

Podrá utilizarse únicamente cuando:

```text
result is safely reusable
inputs are stable
context is included
security isolation is preserved
```

---

# 130. Stale Validation

No deberá asumirse que una validación dependiente de State externo sigue siendo verdadera indefinidamente.

---

# 131. Normalization

Podrá ocurrir antes de Validation semántica.

---

# 132. Normalization Rule

Deberá estar definida por Contract.

---

# 133. Dangerous Normalization

No deberá alterar significado silenciosamente.

---

# 134. Example

Eliminar espacios exteriores puede ser válido.

Cambiar un Identifier arbitrariamente puede no serlo.

---

# 135. Canonicalization

Podrá producir representación canónica.

---

# 136. Canonicalization Security

Deberá ocurrir antes de comparaciones Security-sensitive cuando ENG-024 así lo requiera.

---

# 137. Input Preservation

Cuando sea necesario para Audit, podrá conservarse Input original separado del valor normalizado.

---

# 138. Validation and DTO

Input DTO podrá existir después de Structural Validation.

---

# 139. Validated Input

Podrá utilizar un tipo distinto para representar:

```text
RawInput
→ ValidatedInput
```

---

# 140. Type-State Validation

Cuando el lenguaje lo permita podrá codificarse:

```text
Unvalidated<T>
Validated<T>
```

---

# 141. Benefit

Reduce operaciones sobre datos no validados.

---

# 142. Cost

Aumenta tipos y complejidad.

No deberá imponerse universalmente.

---

# 143. Value Object Construction

Crear un Value Object puede constituir Validation de Domain.

---

# 144. Example

```text
EmailAddress::fromString(...)
```

puede rechazar valores inválidos.

---

# 145. Double Validation

No deberá repetirse innecesariamente la misma Validation costosa en cada Layer.

---

# 146. Defense in Depth

La duplicación podrá justificarse cuando distintas Boundaries protejan garantías distintas.

---

# 147. Source of Truth

Toda Rule importante deberá tener Owner identificable.

---

# 148. Rule Ownership Matrix

Conceptualmente:

| Regla | Owner |
|---|---|
| JSON parseable | Serialization |
| Request matches API schema | API |
| Feature enabled | Application |
| Order can be cancelled | Domain |
| Column unique | Persistence |
| Token signature valid | Security |

---

# 149. Validation Registry

ENG-020 podrá registrar Validators de Framework.

---

# 150. Registry Use

Podrá facilitar:

```text
schema validators
configuration validators
contract validators
```

---

# 151. Domain Validators Registry

No deberá convertirse en Service Locator para reglas Domain.

---

# 152. Validator Resolution

Deberá ser determinista.

---

# 153. Duplicate Validator

Podrá permitirse cuando se compongan Rules explícitamente.

---

# 154. Ambiguous Validator

Deberá rechazarse cuando se espere uno único.

---

# 155. Validator Metadata

Podrá incluir:

```text
validatorId
subjectType
version
phase
priority
```

---

# 156. Priority

No deberá sustituir Dependency explícita.

---

# 157. Validation Dependency Graph

Podrá utilizarse para Validators complejos.

---

# 158. Cycle

Deberá detectarse antes de ejecución cuando sea posible.

---

# 159. Build-Time Validation

ENG-012 podrá validar:

```text
schemas
configuration definitions
validator registrations
rule IDs
duplicate codes
dependency cycles
```

---

# 160. Generated Validator

Podrá generarse desde Schema.

---

# 161. Generated ≠ Semantic

Un Validator generado no deberá asumirse capaz de validar reglas Domain.

---

# 162. Schema Generation

Podrá generar:

```text
type checks
required checks
range checks
enum checks
```

---

# 163. Custom Rules

Deberán poder añadirse cuando Schema no sea suficiente.

---

# 164. Contract Generation

OpenAPI/Event Schemas podrán producir Validators.

---

# 165. Runtime Validation

Contracts externos deberían validarse en Runtime cuando Input no sea confiable.

---

# 166. Trusted Internal Calls

Podrán omitir Validation redundante en Hot Paths si existe garantía arquitectónica comprobable.

---

# 167. Trust Boundary

La omisión deberá basarse en Trust Boundary explícita.

---

# 168. Never Trust External Input

Toda Boundary externa deberá validar Input según su Contract.

---

# 169. Validation and API

Flujo recomendado:

```text
HTTP Request
     │
     ▼
Parsing
     │
     ▼
Structural Validation
     │
     ▼
API Schema Validation
     │
     ▼
Request DTO
     │
     ▼
Application Command
```

---

# 170. Application Flow

```text
Command
   │
   ▼
Application Preconditions
   │
   ▼
Domain Operation
   │
   ▼
Domain Invariants
```

---

# 171. Domain Flow

```text
Raw Primitive
     │
     ▼
Value Object Construction
     │
     ▼
Valid Domain Value
```

---

# 172. Configuration Flow

```text
Raw Configuration
       │
       ▼
Parse
       │
       ▼
Schema Validation
       │
       ▼
Semantic Validation
       │
       ▼
Validated Configuration
       │
       ▼
Runtime
```

---

# 173. Event Flow

```text
Message
   │
   ▼
Envelope Validation
   │
   ▼
Schema Validation
   │
   ▼
Deserialize
   │
   ▼
Application Mapping
```

---

# 174. Validation Before Deserialization

La secuencia exacta dependerá del Serializer.

Algunas validaciones estructurales forman parte de Deserialization.

---

# 175. Invalid External Input

No deberá alcanzar Domain como objeto parcialmente válido.

---

# 176. Invalid Domain State

No deberá construirse únicamente para después ejecutar un Validator global.

---

# 177. Make Invalid States Hard to Represent

Deberá favorecerse cuando el costo sea razonable.

---

# 178. Validation Messages

Deberán distinguir:

```text
machine code
human message
debug detail
```

---

# 179. Production Detail

No deberá exponer información sensible.

---

# 180. Development Detail

Podrá contener mayor diagnóstico.

---

# 181. Localization

El Validator debería producir:

```text
messageKey
parameters
```

cuando se requiera internacionalización.

---

# 182. API Error Mapping

ENG-033 deberá mapear Violations a Public Error Representation.

---

# 183. CLI Error Mapping

ENG-007 podrá mapearlas a mensajes de consola.

---

# 184. Configuration Error Mapping

ENG-011 podrá mostrar Paths y Sources.

---

# 185. Observability

ENG-025 gobernará Telemetry.

---

# 186. Validation Metrics

Podrán incluir:

```text
mef.validation.total
mef.validation.failures.total
mef.validation.duration
```

---

# 187. Dimensions

Podrán incluir:

```text
validator
boundary
result
rule
```

con Cardinality controlada.

---

# 188. Field Value

No deberá utilizarse como Metric Label.

---

# 189. Sensitive Data

No deberá registrarse automáticamente.

---

# 190. Validation Trace

Validations costosas podrán generar Span.

---

# 191. Violation Logging

No toda Violation deberá registrarse como Error operacional.

---

# 192. Expected Invalid Request

Puede ser:

```text
normal client behavior
```

y no una Failure interna.

---

# 193. Abuse Detection

Patrones anómalos deberán delegarse a Security/Observability.

---

# 194. Performance

ENG-026 gobernará Performance.

---

# 195. Validation Budget

Podrá definirse para Boundaries de alto volumen.

---

# 196. Short-Circuit

Podrá reducir costo cuando el resultado ya esté determinado.

---

# 197. Rule Ordering Optimization

No deberá alterar semántica observable.

---

# 198. Expensive Rule

Debería ejecutarse después de Checks baratos cuando no exista otra Dependency.

---

# 199. Validation Benchmark

Podrá existir:

```text
BM-VALIDATION-PIPELINE
BM-SCHEMA-VALIDATION
```

---

# 200. Memory

Aggregate Validation deberá limitar número de Violations.

---

# 201. Maximum Violations

Podrá definirse:

```text
maxViolations
```

---

# 202. Truncation

El resultado deberá indicar si existen más Violations no reportadas.

---

# 203. Batch Validation

Podrá validar múltiples Subjects.

---

# 204. Batch Result

Conceptualmente:

```text
BatchValidationResult
├── total
├── valid
├── invalid
└── itemResults[]
```

---

# 205. Partial Success

Solo tendrá significado cuando el Consumer Contract lo permita.

---

# 206. Validation Concurrency

Rules independientes podrán evaluarse en paralelo si:

```text
determinism is preserved
resource limits are respected
result ordering is defined
```

---

# 207. Deterministic Output

El orden de Violations debería ser estable.

---

# 208. Concurrency Race

Validators no deberán compartir State mutable inseguro.

---

# 209. Stateless Validator

Deberá favorecerse.

---

# 210. Validator Lifecycle

Normalmente podrá ser:

```text
singleton
```

solo si es realmente Stateless.

---

# 211. Scoped Validator

Podrá utilizarse cuando dependa de Context.

---

# 212. Validation Testing

ENG-009 continuará gobernando Testing.

---

# 213. Rule Unit Test

Cada Rule crítica deberá probar:

```text
valid case
invalid case
boundary values
```

---

# 214. Validator Test

Deberá comprobar composición.

---

# 215. Violation Code Test

Los códigos públicos deberán permanecer estables conforme Compatibility.

---

# 216. Path Test

Deberá comprobar que Violations apunten al elemento correcto.

---

# 217. Fail-Fast Test

Deberá comprobar que no se ejecuten Rules posteriores cuando corresponda.

---

# 218. Aggregate Test

Deberá comprobar múltiples Violations.

---

# 219. Schema Test

Deberá cubrir:

```text
missing fields
unknown fields
wrong types
invalid formats
limits
```

---

# 220. Property-Based Testing

Será útil para Validators de:

```text
ranges
formats
collections
numeric constraints
```

---

# 221. Fuzz Testing

Será recomendable para Parsers/Validators expuestos a Input no confiable.

---

# 222. Security Fuzzing

Deberá considerar:

```text
deep nesting
huge collections
malformed encodings
pathological regex inputs
```

---

# 223. Mutation Testing

Podrá utilizarse para comprobar fuerza de Rules críticas.

---

# 224. Contract Test

Deberá verificar que Provider y Consumer coincidan en Validation semantics cuando formen parte del Contract.

---

# 225. Regression Test

Toda Validation Bug crítica debería producir Test reproducible.

---

# 226. Architecture Test

Podrá verificar Ownership.

Ejemplo:

```text
Domain
must not import
Api\Validation\RequestValidator
```

---

# 227. Validation Build Gate

Podrá impedir Build ante:

```text
duplicate violation code
invalid schema
missing required validator
validation dependency cycle
invalid rule metadata
```

---

# 228. Compatibility

ENG-016 gobernará Compatibility.

---

# 229. Tightening Validation

Hacer una Validation más estricta puede constituir Breaking Change.

---

# 230. Example

Antes:

```text
name max length = 255
```

Después:

```text
name max length = 100
```

puede romper Consumers.

---

# 231. Relaxing Validation

Normalmente es más compatible, pero puede alterar downstream assumptions.

---

# 232. Required Field Addition

Será normalmente Breaking Change para Input Contracts existentes.

---

# 233. Optional Field Addition

Normalmente será compatible si Unknown Fields Policy lo permite.

---

# 234. Enum Expansion

Puede romper Consumers que asumen conjunto exhaustivo.

---

# 235. Validation Versioning

Rules públicas podrán estar asociadas a Contract Version.

---

# 236. Migration

Cambios de Validation sobre datos persistentes deberán considerar Records históricos.

---

# 237. Existing Invalid Data

No deberá asumirse inexistente.

---

# 238. Migration Validation

Podrá identificar:

```text
valid
repairable
legacy-valid
invalid
```

según estrategia.

---

# 239. Release

ENG-017 deberá documentar cambios relevantes en Validation Contracts.

---

# 240. Deprecation

Una Rule pública podrá deprecarse.

---

# 241. Validation Documentation

Contracts públicos deberán documentar restricciones significativas.

---

# 242. Machine-Readable Constraints

Deberán favorecerse cuando sea posible.

---

# 243. Human Documentation

Seguirá siendo necesaria para reglas semánticas complejas.

---

# 244. Generated Documentation

Podrá derivarse de:

```text
schema
rule metadata
contract metadata
```

---

# 245. Validation Rule Catalog

Podrá generarse para Framework Rules.

---

# 246. No Business Rule Leakage

El catálogo Framework no deberá convertirse en fuente universal de reglas específicas de negocio.

---

# 247. First Implementation Components

La primera implementación deberá incluir conceptualmente:

```text
Validator<T>
ValidationRule<T>
ValidationResult
Violation
ViolationCode
ValidationPath
ValidationContext
ValidationPipeline
ValidationStrategy
```

---

# 248. Validation Strategy

Como mínimo:

```text
FAIL_FAST
COLLECT_ALL
```

---

# 249. Optional Components

Podrán añadirse:

```text
SchemaValidator
CompositeValidator
ConditionalRule
CollectionValidator
AsyncValidator
BatchValidator
```

---

# 250. Base Validator

No deberá obligar a herencia compleja.

---

# 251. Rule Interface

Deberá ser pequeña.

Conceptualmente:

```text
ValidationRule<T>
    validate(T subject, ValidationContext context)
        → ValidationResult
```

---

# 252. Boolean Validator

Devolver únicamente:

```text
true / false
```

será insuficiente cuando el Consumer requiera diagnóstico.

---

# 253. Exception-Only Validator

Tampoco deberá ser obligatorio.

---

# 254. Conceptual Directory Structure

```text
src/
└── Validation/
    ├── Contract/
    │   ├── Validator
    │   └── ValidationRule
    │
    ├── Result/
    │   ├── ValidationResult
    │   ├── Violation
    │   └── ViolationCode
    │
    ├── Path/
    │   └── ValidationPath
    │
    ├── Context/
    │   └── ValidationContext
    │
    ├── Pipeline/
    │   └── ValidationPipeline
    │
    ├── Strategy/
    │   ├── FailFast
    │   └── CollectAll
    │
    ├── Schema/
    │   └── SchemaValidator
    │
    └── Error/
        └── ValidationError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 255. Domain-Specific Validators

Deberán permanecer dentro de su Module/Domain cuando representen reglas propias del negocio.

Ejemplo:

```text
Modules/
└── Orders/
    └── Domain/
        └── ...
```

y no necesariamente en el Validation Framework global.

---

# 256. Framework Validation

El Package común deberá concentrarse en:

```text
mechanisms
contracts
composition
generic rules
results
```

no en Business Rules.

---

# 257. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Rule Ownership
Stable Violation Codes
ValidationResult
ValidationPath
Fail-Fast
Collect-All
Deterministic Ordering
Stateless Validators
Schema Validation
Configuration Validation
Boundary Validation
Resource Limits
Testing
```

---

# 258. First Version Non-Goals

No deberá requerir:

```text
Universal Business Rule Engine
Visual Rule Designer
Dynamic Scripting
Remote Validation Service
Distributed Validation
AI-Based Validation
Automatic Domain Rule Discovery
```

---

# 259. Second Phase

Podrá incorporar:

```text
Async Validation
Generated Validators
Advanced Schema Composition
Validation Dependency Graph
Property-Based Validation Tooling
Rule Documentation Generation
```

---

# 260. Third Phase

Solo cuando exista necesidad:

```text
Distributed Validation
Policy-as-Code integration
Advanced Rule Compilation
Cross-Service Validation Contracts
```

---

# 261. Invariantes de Ingeniería

ENG-036 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-666 | Toda Validation deberá ejecutarse en una Boundary que posea autoridad suficiente sobre la regla evaluada. |
| EI-667 | Validation no deberá utilizarse como sustituto de Authorization, Error Handling, Parsing, Normalization o Concurrency Control. |
| EI-668 | Las Domain Invariants deberán permanecer bajo autoridad de ENG-035 aunque otras Boundaries realicen Defense in Depth. |
| EI-669 | Structural, Schema, Application y Domain Validation deberán permanecer conceptualmente distinguibles. |
| EI-670 | Toda Violation destinada a Consumers machine-oriented deberá poseer un identificador estable independiente del texto humano. |
| EI-671 | ValidationResult deberá permitir distinguir inequívocamente un Subject válido de uno inválido y conservar las Violations relevantes. |
| EI-672 | Validators deberán evitar Side Effects no relacionados y favorecer comportamiento determinista y testeable. |
| EI-673 | ValidationContext no deberá convertirse en Service Locator ni proporcionar acceso irrestricto al Runtime o Container. |
| EI-674 | Fail-Fast y Collect-All deberán poseer semántica explícita y determinista cuando sean observables por Consumers. |
| EI-675 | Validation de Inputs externos deberá aplicar límites de recursos que impidan profundidad, tamaño o complejidad no acotados. |
| EI-676 | Una Validation dependiente de State externo no deberá asumirse suficiente para garantizar Atomicity o Concurrency. |
| EI-677 | Validators que ejecuten I/O deberán hacerlo explícito y respetar Deadline, Cancellation y Failure semantics de su Boundary. |
| EI-678 | Normalization y Canonicalization no deberán alterar silenciosamente el significado del Input fuera del Contract definido. |
| EI-679 | El Owner de toda Rule significativa deberá ser identificable para evitar duplicación contradictoria entre Layers. |
| EI-680 | Validation Framework común deberá proporcionar mecanismos genéricos sin convertirse en repositorio central de Business Rules específicas. |
| EI-681 | Cambios que hagan más restrictivo un Validation Contract público deberán someterse a Compatibility Analysis. |
| EI-682 | Validation Errors no deberán exponer Values sensibles, Infrastructure internals o detalles innecesarios a Consumers externos. |
| EI-683 | Validator Resolution, Rule Ordering y Violation Ordering deberán ser deterministas cuando afecten resultados observables. |
| EI-684 | Build y Testing deberán poder detectar Schemas inválidos, códigos duplicados, ciclos y Registrations obligatorias inconsistentes antes de Production. |
| EI-685 | La primera implementación deberá favorecer Validators explícitos, composables y locales antes de introducir Rule Engines dinámicos o Validation distribuida. |

---

# 262. Continuidad de Invariantes

```text
ENG-032 → EI-586 a EI-605
ENG-033 → EI-606 a EI-625
ENG-034 → EI-626 a EI-645
ENG-035 → EI-646 a EI-665
ENG-036 → EI-666 a EI-685
```

---

# 263. Criterios de Conformidad

Una implementación será conforme con ENG-036 cuando:

- diferencie Validation de Authorization;
- diferencie Validation de Error Handling;
- diferencie Validation de Parsing;
- diferencie Validation de Normalization;
- identifique Ownership de Rules;
- soporte Structural Validation;
- soporte Schema Validation;
- soporte Boundary Validation;
- preserve Domain Invariants en ENG-035;
- soporte Application Preconditions;
- soporte Configuration Validation;
- proporcione Validator;
- proporcione ValidationRule;
- proporcione ValidationResult;
- proporcione Violation;
- utilice códigos estables;
- soporte Validation Paths;
- soporte Fail-Fast;
- soporte Collect-All;
- limite Validation de Input no confiable;
- evite Side Effects inesperados;
- permita Testing aislado;
- preserve Compatibility de Contracts públicos;
- integre Observability sin exponer datos sensibles.

---

# 264. Riesgos

Deberán evitarse especialmente:

## Validation Everywhere

La misma regla se implementa de manera distinta en cada Layer.

## Business Rules in Request Validator

Las invariantes del Domain terminan en la API.

## Validator as Domain Service Replacement

Toda lógica del negocio se mueve a `*Validator`.

## Authorization as Validation

Se responde "invalid" cuando realmente la operación está prohibida.

## Database as Validator

La única protección de la regla es una Constraint.

## Boolean-Only Validation

Se pierde información diagnóstica.

## Exception for Every User Error

Input inválido normal se convierte innecesariamente en Failure excepcional.

## Validation Service Locator

Validator consulta Container global.

## Hidden Network Validation

Una Rule aparentemente local realiza Calls remotos.

## Validation Race

Se supone que `check then write` garantiza unicidad concurrente.

## Unlimited Recursive Validation

Input hostil consume Resources sin límite.

## Catastrophic Regex

Regex mal diseñada permite CPU exhaustion.

## Sensitive Violation

El Error devuelve Tokens, Passwords o Values confidenciales.

## Unstable Error Message Contract

Consumers dependen de texto humano.

## Validation Rule Engine Too Early

Se introduce infraestructura dinámica sin necesidad real.

---

# 265. Relación con ENG-011

Configuration Files deberán validarse estructural y semánticamente antes de Runtime Readiness.

---

# 266. Relación con ENG-016

Cambios de restricciones públicas deberán someterse a Compatibility Analysis.

---

# 267. Relación con ENG-021

Contracts podrán definir Preconditions, Schemas y restricciones observables.

---

# 268. Relación con ENG-023

ENG-036 detecta invalididad.

ENG-023 determina cómo esa invalididad se representa y propaga como Failure.

---

# 269. Relación con ENG-024

La separación fundamental será:

```text
Validation
→ Is the request/value/state valid?

Authorization
→ May this principal perform the operation?
```

---

# 270. Relación con ENG-028

Cada Module será responsable de sus reglas específicas.

El Framework Validation Package no deberá centralizar Business Rules de Modules.

---

# 271. Relación con ENG-030

Persistence Constraints reforzarán garantías donde Atomicity o integridad física lo requieran.

---

# 272. Relación con ENG-031

Serialization y Validation colaborarán para transformar Wire Data en estructuras seguras.

---

# 273. Relación con ENG-032

Transport deberá validar Envelopes y Protocol Constraints sin asumir reglas del Domain.

---

# 274. Relación con ENG-033

API deberá ejecutar Boundary/Schema Validation antes de entregar Inputs estructuralmente inválidos a Application.

---

# 275. Relación con ENG-034

Application podrá ejecutar Preconditions del Use Case.

No deberá duplicar indiscriminadamente las invariantes de ENG-035.

---

# 276. Relación con ENG-035

Esta separación será obligatoria:

```text
ENG-036
Validation Engineering
       │
       ├── Structural
       ├── Schema
       ├── Boundary
       └── Application Preconditions

ENG-035
Domain Engineering
       │
       └── Business Invariants
```

ENG-036 proporciona mecanismos.

ENG-035 conserva autoridad sobre reglas de negocio.

---

# 277. Relación con ENG-037

ENG-037 — Caching Engineering deberá considerar especialmente la relación entre Cache y Validation dependiente de State externo.

Un resultado validado en:

```text
T1
```

no deberá asumirse automáticamente válido en:

```text
T2
```

cuando la Rule depende de State mutable.

---

# 278. Principio Rector

> **MEF deberá validar cada dato, estructura o condición en la Boundary que posee su significado, devolviendo Violations explícitas y estables, sin convertir Validation en una capa universal que absorba Domain, Security, Persistence o Application Logic.**

---

# 279. Conclusión

**ENG-036 — Validation Engineering** formaliza el sistema transversal de validación de MEF.

La arquitectura completa queda:

```text
External Input
      │
      ▼
Parsing
      │
      ▼
Structural Validation
      │
      ▼
Schema / Boundary Validation
      │
      ▼
Validated DTO
      │
      ▼
Application
      │
      ▼
Application Preconditions
      │
      ▼
Domain
      │
      ▼
Domain Invariants
      │
      ▼
Valid Business State
```

La separación conceptual queda:

```text
Parsing
→ Can I understand this representation?

Structural Validation
→ Does it have the expected shape?

Schema Validation
→ Does it satisfy the Boundary contract?

Application Precondition
→ Can this Use Case execute?

Domain Invariant
→ Is this Business State valid?

Authorization
→ May this Actor do it?

Persistence Constraint
→ Can Storage preserve the required integrity?

Error Handling
→ How is a Failure represented and propagated?
```

La primera implementación deberá concentrarse en:

```text
Validator
ValidationRule
ValidationResult
Violation
ViolationCode
ValidationPath
ValidationContext
ValidationPipeline
FAIL_FAST
COLLECT_ALL
Schema Validation
Resource Limits
```

sin introducir todavía:

```text
Universal Rule Engine
Distributed Validation
Dynamic Rule Scripting
Remote Validation Services
AI-Based Validation
```

Con **ENG-036** la serie global alcanza:

```text
EI-685
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
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
- ENG-033 — API Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-037 — Caching Engineering