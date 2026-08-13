---
id: ENG-021
titulo: Contracts Engineering
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
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-018
  - ENG-019
  - ENG-020
  - ARQ-004
  - ARQ-006
  - ARQ-007
  - ARQ-008
  - ARQ-011
  - ARQ-012
  - ARQ-014
relacionados:
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-027
keywords:
  - contracts
  - contract engineering
  - interfaces
  - schemas
  - signatures
  - compatibility
  - versioning
  - providers
  - consumers
  - contract testing
  - runtime
  - mef
---

# ENG-021

# Contracts Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería para diseñar, identificar, publicar, implementar, consumir, versionar, validar, deprecar y retirar **Contracts** dentro de **MEF (Modular Enterprise Framework)**.

Los Contracts constituyen fronteras estables entre componentes.

Su función principal será permitir que un consumidor dependa de una capacidad publicada sin depender directamente de los detalles internos de quien la implementa.

La relación fundamental será:

```text
Consumer
    │
    ▼
 Contract
    ▲
    │
Provider
```

---

# 2. Declaración

La regla fundamental será:

> **Un Contract deberá describir una obligación observable entre consumidores y proveedores sin exponer innecesariamente los detalles internos de su implementación.**

Por tanto:

```text
Contract
≠
Implementation
```

y:

```text
Contract
≠
Service Container Binding
```

---

# 3. Posición Arquitectónica

```text
                    CONTRACT
                       │
            ┌──────────┴──────────┐
            ▼                     ▼
        Consumers              Providers
            │                     │
            │                     ▼
            │              Implementations
            │                     │
            └──────────┬──────────┘
                       ▼
                  Compatibility
                       │
                       ▼
                    Runtime
```

---

# 4. Objetivos

Contracts Engineering deberá:

- desacoplar consumidores de implementaciones;
- definir fronteras estables;
- establecer identidad;
- establecer ownership;
- permitir múltiples implementaciones;
- permitir sustitución;
- permitir versionado;
- permitir Compatibility;
- permitir Contract Testing;
- facilitar Dependency Injection;
- facilitar Registry Discovery;
- facilitar evolución controlada;
- evitar dependencia de detalles internos.

---

# 5. Contract

Un Contract representa una expectativa pública y gobernada.

Puede describir:

```text
operations
inputs
outputs
errors
semantics
constraints
capabilities
version
compatibility
```

según el tipo de Contract.

---

# 6. Contract Identity

Todo Contract arquitectónicamente publicado deberá poseer una identidad estable.

El prefijo canónico será:

```text
CT
```

Ejemplos:

```text
CT-IDENTITY-001
CT-CUSTOMER-001
CT-PAYMENT-001
CT-STORAGE-001
```

---

# 7. Canonical Prefix

No deberán introducirse prefijos alternativos para representar el mismo concepto.

Por tanto:

```text
CT-CUSTOMER-001
```

es válido.

No se utilizará:

```text
CTR-CUSTOMER-001
```

para Contracts arquitectónicos.

---

# 8. Contract ID vs Version

La identidad y la versión deberán permanecer separadas.

```text
id:
CT-CUSTOMER-001

version:
2.1.0
```

No deberá codificarse cada cambio de versión creando automáticamente un nuevo ID.

---

# 9. Stable Identity

Mientras el Contract conserve su identidad conceptual compatible, deberá conservar su ID.

---

# 10. New Contract Identity

Un Contract nuevo podrá requerir nuevo ID cuando represente una frontera conceptualmente distinta.

---

# 11. Contract Ownership

Todo Contract publicado deberá tener Owner.

Ejemplo:

```text
CT-CUSTOMER-001
owner: MOD-CUSTOMER
```

---

# 12. Ownership

Ownership significa responsabilidad sobre:

- definición;
- documentación;
- evolución;
- versionado;
- compatibilidad;
- deprecation;
- retiro.

---

# 13. Owner Does Not Mean Sole Implementer

El propietario de un Contract no necesariamente será su única Implementation.

Ejemplo:

```text
CT-STORAGE-001
owner: MOD-STORAGE

implementations:
  LocalStorage
  S3Storage
  AzureStorage
```

---

# 14. Contract Provider

Un Provider ofrece una Implementation capaz de satisfacer un Contract.

```text
Provider
   │
   ▼
Implementation
   │
implements
   ▼
Contract
```

---

# 15. Contract Consumer

Un Consumer requiere el comportamiento descrito por el Contract.

---

# 16. Consumer Independence

El Consumer no deberá necesitar conocer:

```text
concrete implementation
provider package
service container technology
internal implementation details
```

salvo que esos elementos formen deliberadamente parte del Contract.

---

# 17. Contract Publication

Un Contract deberá considerarse publicado cuando esté disponible para consumidores externos a su frontera propietaria.

---

# 18. Internal Contract

Podrán existir Contracts internos.

Ejemplo:

```text
visibility: module
```

No deberán recibir las mismas garantías públicas si no han sido publicados.

---

# 19. Public Contract

Un Contract público deberá:

- poseer ID;
- poseer versión;
- poseer Owner;
- estar documentado;
- definir semántica;
- declarar Compatibility;
- poder validarse.

---

# 20. Contract Visibility

La taxonomía deberá alinearse con ENG-020:

```text
private
module
public
framework
```

---

# 21. Private Contract

No deberá utilizarse fuera de la frontera propietaria autorizada.

---

# 22. Module Contract

Podrá compartirse dentro de la frontera modular definida.

---

# 23. Public Contract

Podrá ser consumido por otros Modules autorizados.

---

# 24. Framework Contract

Representa una frontera publicada por infraestructura MEF.

---

# 25. Contract Representation

Un Contract podrá representarse de diferentes maneras según Implementation Profile.

Ejemplos:

```text
interface
protocol
abstract type
schema
IDL
function signature
message schema
HTTP specification
```

---

# 26. Technology Neutrality

MEF no deberá definir Contract como sinónimo universal de:

```text
PHP interface
Java interface
C# interface
TypeScript interface
```

Estos son mecanismos de representación.

---

# 27. Behavioral Contract

La firma por sí sola no constituye necesariamente el Contract completo.

Ejemplo:

```text
findCustomer(id)
```

no especifica por sí misma:

```text
qué ocurre si no existe,
qué errores pueden ocurrir,
si devuelve null,
si lanza error,
si preserva ordering,
qué garantías ofrece.
```

---

# 28. Contract Semantics

Un Contract deberá definir las reglas observables necesarias para uso correcto.

---

# 29. Contract Surface

La superficie podrá contener:

```text
Operations
Inputs
Outputs
Errors
Events
Constraints
Preconditions
Postconditions
Invariants
```

según corresponda.

---

# 30. Operation

Cada operación pública deberá poseer semántica suficientemente definida.

Ejemplo:

```text
getCustomer(customerId)
```

---

# 31. Inputs

Los Inputs deberán definir:

```text
type
required/optional
constraints
semantics
```

cuando sea relevante.

---

# 32. Outputs

Los Outputs deberán definir:

```text
type
presence
semantics
error alternatives
```

---

# 33. Errors

Los errores observables que formen parte de la interacción deberán documentarse.

---

# 34. Implementation Error Leakage

Una Implementation no deberá filtrar indiscriminadamente errores internos no contemplados por el Contract.

Ejemplo a evitar:

```text
MySqlDriverException
```

atravesando una frontera de Domain Contract sin traducción apropiada.

---

# 35. Preconditions

Un Contract podrá declarar condiciones que el Consumer debe satisfacer.

---

# 36. Postconditions

Podrá declarar garantías posteriores a una operación exitosa.

---

# 37. Invariants

Podrá declarar condiciones que siempre deberán mantenerse.

---

# 38. Semantic Stability

La Compatibility no deberá evaluarse únicamente mediante firmas.

Cambiar semántica observable puede constituir Breaking Change.

---

# 39. Contract Granularity

Los Contracts deberían representar capacidades coherentes.

---

# 40. Narrow Contract

Se favorecerán Contracts suficientemente específicos.

Ejemplo:

```text
EventPublisher
```

frente a:

```text
CompleteEventBusAdministration
```

cuando el Consumer solo publica Events.

---

# 41. Interface Segregation

Los consumidores no deberían depender de operaciones que no utilizan cuando exista una frontera razonable.

---

# 42. God Contract

Deberá evitarse:

```text
PlatformService
  ├── users
  ├── payments
  ├── files
  ├── events
  ├── audit
  ├── email
  └── configuration
```

---

# 43. Contract Cohesion

Las operaciones deberán pertenecer a una responsabilidad coherente.

---

# 44. No Interface for Everything

No toda clase necesita Contract.

---

# 45. Contract Creation Criteria

Un Contract resulta especialmente útil cuando existe:

```text
cross-module boundary
multiple implementations
external integration
public extension point
test seam
technology abstraction
stable architectural capability
```

---

# 46. Concrete Internal Dependency

Dentro de un Module podrá utilizarse una clase concreta cuando:

- el acoplamiento sea deliberado;
- no exista frontera pública;
- no se requiera sustitución;
- no viole Architecture.

---

# 47. Contract Definition

Una definición conceptual podrá contener:

```text
id
name
version
owner
visibility
description
operations
errors
compatibility
status
metadata
```

---

# 48. Contract Status

Estados documentales posibles:

```text
Draft
Experimental
Stable
Deprecated
Retired
```

---

# 49. Draft

Todavía puede cambiar sin garantías públicas completas.

---

# 50. Experimental

Puede utilizarse bajo garantías limitadas.

---

# 51. Stable

Está sujeto formalmente a Versioning y Compatibility.

---

# 52. Deprecated

Continúa soportado temporalmente pero se recomienda migración.

---

# 53. Retired

Ya no forma parte de la superficie soportada.

---

# 54. Contract Status vs Runtime State

No deberán confundirse:

```text
Contract lifecycle status
```

con:

```text
Architectural Runtime State
```

de ENG-015.

---

# 55. Versioning

ENG-014 gobernará Versioning.

Los Contracts estables deberán utilizar Semantic Versioning o la política oficial definida por MEF.

---

# 56. Major Version

Un cambio incompatible deberá incrementar Major cuando corresponda.

---

# 57. Minor Version

Una ampliación backward-compatible podrá incrementar Minor.

---

# 58. Patch Version

Correcciones que no cambien comportamiento contractual incompatible podrán incrementar Patch.

---

# 59. Compatibility

ENG-016 será autoridad sobre reglas generales de Compatibility.

ENG-021 define cómo aplicarlas a Contracts.

---

# 60. Contract Compatibility Dimensions

Deberán considerarse al menos:

```text
syntactic
structural
behavioral
semantic
error
data
temporal
```

cuando sean relevantes.

---

# 61. Syntactic Compatibility

Evalúa firmas y representación.

---

# 62. Structural Compatibility

Evalúa forma de Inputs/Outputs.

---

# 63. Behavioral Compatibility

Evalúa comportamiento observable.

---

# 64. Semantic Compatibility

Evalúa significado.

---

# 65. Error Compatibility

Cambiar errores observables puede afectar consumidores.

---

# 66. Data Compatibility

Schemas persistidos/intercambiados podrán requerir reglas adicionales.

---

# 67. Temporal Compatibility

Puede ser relevante en:

```text
timeouts
ordering
event timing
retry semantics
```

---

# 68. Breaking Change

Ejemplos potenciales:

```text
remove operation
rename required field
change return meaning
tighten accepted input
introduce new mandatory parameter
remove documented error
change ordering guarantee
change transactional semantics
```

---

# 69. Non-Breaking Change

Ejemplos posibles:

```text
documentation clarification
optional capability addition
new optional field
performance improvement preserving semantics
```

si el tipo de Contract lo permite.

---

# 70. Additive Does Not Always Mean Compatible

Agregar algo puede romper consumidores.

Ejemplo:

```text
new enum value
```

puede romper un Consumer que asumía conjunto cerrado.

---

# 71. Compatibility Must Be Contextual

No deberá utilizarse una regla mecánica universal para todos los tipos de Contracts.

---

# 72. Contract Version Requirement

Un Consumer podrá declarar:

```text
requires:
  CT-CUSTOMER-001: ^2.0
```

conceptualmente.

---

# 73. Provider Version

Una Implementation deberá declarar qué versión o rango del Contract implementa.

---

# 74. Compatibility Resolution

Conceptualmente:

```text
Consumer Requirement
        │
        ▼
Contract Version
        │
        ▼
Compatible Implementation
```

---

# 75. Registry Integration

ENG-020 deberá registrar:

```text
Contract ID
version
owner
visibility
status
providers
implementations
```

---

# 76. Registry Is Not Contract Authority

El Registry almacena metadata.

La definición oficial del Contract continúa siendo su Source of Truth gobernada.

---

# 77. Manifest Integration

ENG-003 podrá declarar:

```text
provides
requires
contracts
```

---

# 78. Manifest Requirement

Ejemplo conceptual:

```yaml
requires:
  contracts:
    CT-IDENTITY-001: "^2.0"
```

---

# 79. Manifest Provision

Ejemplo:

```yaml
provides:
  contracts:
    CT-CUSTOMER-001: "1.4.0"
```

---

# 80. Manifest and Code Consistency

Si Manifest afirma que un Module proporciona:

```text
CT-CUSTOMER-001
```

pero no existe Implementation válida:

```text
FAIL
```

cuando tooling pueda verificarlo.

---

# 81. Implementation

Una Implementation materializa el comportamiento del Contract.

---

# 82. Implementation Declaration

Deberá poder declarar:

```text
implements:
  CT-CUSTOMER-001
```

---

# 83. Multiple Implementations

Un Contract podrá tener múltiples Implementations.

```text
CT-STORAGE-001
   ├── LocalStorage
   ├── S3Storage
   └── AzureStorage
```

---

# 84. Multiple Contracts

Una Implementation podrá implementar múltiples Contracts cuando sea coherente.

---

# 85. Implementation Independence

Dos Implementations del mismo Contract no deberán requerir que el Consumer conozca diferencias internas no declaradas.

---

# 86. Behavioral Equivalence

No significa que sean idénticas.

Significa que satisfacen las garantías del Contract.

---

# 87. Implementation-Specific Capability

Una Implementation podrá ofrecer capacidades adicionales.

El Consumer que las utilice deja de depender exclusivamente del Contract base.

---

# 88. Capability Extension

Cuando una capacidad adicional sea arquitectónicamente relevante debería publicarse como:

```text
additional Contract
```

o:

```text
Capability
```

en lugar de downcasting arbitrario.

---

# 89. Contract Validation

Una Implementation deberá validarse contra el Contract cuando sea posible.

---

# 90. Validation Layers

Podrán existir:

```text
static validation
schema validation
contract tests
compatibility tests
runtime assertions
```

---

# 91. Static Validation

El compilador/type system podrá verificar firmas en determinados lenguajes.

---

# 92. Static Validation Is Insufficient

No puede demostrar necesariamente semántica.

---

# 93. Contract Tests

ENG-009 deberá soportar **Contract Tests**.

---

# 94. Contract Test Suite

El Owner podrá publicar una suite reutilizable.

Ejemplo conceptual:

```text
CustomerRepositoryContractTests
```

---

# 95. Provider Contract Testing

Cada Implementation deberá ejecutar la misma suite cuando corresponda.

```text
Contract Test Suite
        │
   ┌────┼────┐
   ▼    ▼    ▼
 Impl A Impl B Impl C
```

---

# 96. Contract Test Purpose

Verificar que distintas Implementations preservan garantías comunes.

---

# 97. Consumer-Driven Contracts

MEF podrá soportar Consumer-Driven Contract Testing cuando exista valor.

No será requisito universal inicial.

---

# 98. Provider Verification

Un Provider deberá demostrar conformidad antes de ser considerado compatible cuando la política lo requiera.

---

# 99. Contract Test Version

La suite deberá versionarse junto con el Contract o declarar claramente qué versión valida.

---

# 100. Test Evolution

Al cambiar un Contract deberá actualizarse su Contract Test Suite.

---

# 101. Negative Contract Tests

Deberán probar errores y entradas inválidas cuando formen parte de la semántica.

---

# 102. Property-Based Contract Tests

Podrán utilizarse para invariantes complejos.

---

# 103. Integration Contract Tests

Podrán verificar una Implementation contra infraestructura real.

---

# 104. Contract Compliance Result

Conceptualmente:

```text
Compliant
NonCompliant
Unknown
```

---

# 105. Unknown Compliance

La ausencia de evidencia no deberá interpretarse automáticamente como cumplimiento verificado.

---

# 106. Build Integration

ENG-012 podrá ejecutar Contract Tests como Quality Gate.

---

# 107. Quality Gate

Una Implementation obligatoria que no satisface Contract Tests requeridos deberá bloquear Build/Release.

---

# 108. Package Integration

ENG-013 deberá resolver Packages que proporcionen Contracts compatibles.

---

# 109. Package Dependency vs Contract Dependency

Debe distinguirse:

```text
Package Dependency
→ distribución

Contract Dependency
→ arquitectura/comportamiento
```

---

# 110. Dependency Injection Integration

ENG-018 utilizará Contracts como dependencias.

Ejemplo:

```text
CustomerService(
  CT-IDENTITY-001 identity
)
```

conceptualmente.

---

# 111. Container Integration

ENG-019 realizará:

```text
Contract
   ↓
Binding
   ↓
Implementation
   ↓
Instance
```

---

# 112. Registry Integration

ENG-020 realizará:

```text
Contract
   ↓
Known Implementations
```

sin instanciarlas.

---

# 113. Consumer Binding Independence

El Consumer no deberá decidir normalmente qué Implementation concreta recibe.

---

# 114. Explicit Implementation Requirement

Si el Consumer requiere una Implementation específica deberá expresarlo deliberadamente.

En ese caso el acoplamiento forma parte del diseño.

---

# 115. Contract Dependency Direction

Los Contracts deberán ubicarse de forma que preserven la dirección arquitectónica correcta.

---

# 116. Contract Ownership Rule

No siempre deberá ser propietario el proveedor concreto.

El ownership debe colocarse donde tenga sentido arquitectónico.

---

# 117. Dependency Inversion Example

Incorrecto:

```text
High-Level Module
       ↓
Low-Level Implementation
```

Preferido:

```text
High-Level Policy
       ↓
Contract
       ↑
Low-Level Implementation
```

---

# 118. Contract Location

La ubicación física deberá seguir ENG-006.

No deberá determinar por sí sola ownership semántico.

---

# 119. Cross-Module Contract

Ejemplo:

```text
MOD-CRM
   │
   ▼
CT-IDENTITY-001
   ▲
   │
MOD-IDENTITY
```

---

# 120. Internal API Protection

`MOD-CRM` no deberá depender de:

```text
IdentityInternalRepository
```

si `MOD-IDENTITY` publica `CT-IDENTITY-001` para esa interacción.

---

# 121. Contract Evolution

Todo Contract Stable deberá evolucionar de forma controlada.

---

# 122. Evolution Workflow

```text
Change Proposal
      ↓
Impact Analysis
      ↓
Compatibility Analysis
      ↓
Contract Update
      ↓
Contract Tests
      ↓
Version Decision
      ↓
Migration Guidance
      ↓
Release
```

---

# 123. Impact Analysis

Deberán identificarse:

```text
Consumers
Providers
Implementations
Packages
Modules
Extensions
```

afectados.

---

# 124. Registry-Assisted Impact Analysis

ENG-020 podrá responder:

```text
who consumes CT-X?
who implements CT-X?
```

---

# 125. Breaking Change Review

Un Breaking Change deberá requerir revisión explícita.

---

# 126. Migration Path

Cuando sea razonable deberá proporcionarse ruta de migración.

---

# 127. Parallel Versions

MEF podrá permitir coexistencia temporal de versiones Major.

Ejemplo:

```text
CT-CUSTOMER-001 v1
CT-CUSTOMER-001 v2
```

como versiones de una misma identidad lógica si la infraestructura lo soporta.

---

# 128. Major Version Identity

La estrategia exacta de representación deberá permanecer consistente con ENG-014.

No deberá inventarse un nuevo Contract ID únicamente para evitar gestionar versiones.

---

# 129. Version Adapter

Podrá existir Adapter:

```text
CT-X v1
   ↓
Adapter
   ↓
CT-X v2 Implementation
```

si las semánticas permiten traducción válida.

---

# 130. Compatibility Bridge

Los Bridges deberán declararse explícitamente.

---

# 131. Bridge Does Not Create Compatibility Automatically

Un Adapter solo es válido si puede preservar las garantías necesarias.

---

# 132. Deprecation

Un Contract deberá poder marcarse:

```text
Deprecated
```

sin desaparecer inmediatamente.

---

# 133. Deprecation Metadata

Deberá incluir cuando sea posible:

```text
deprecatedSince
replacement
reason
plannedRemoval
migrationGuide
```

---

# 134. Deprecation Warning

Tooling podrá advertir cuando un Consumer dependa de Contract Deprecated.

---

# 135. Deprecation Is Not Failure

Mientras continúe soportado, un Contract Deprecated deberá seguir funcionando conforme a sus garantías.

---

# 136. Removal

Retirar un Contract constituye cambio potencialmente incompatible.

---

# 137. Removal Preconditions

Antes de retirar deberían revisarse:

```text
known consumers
support window
migration path
replacement
release policy
```

---

# 138. Retired Contract

Un Contract Retired no deberá considerarse disponible para nueva Composition.

---

# 139. Historical Metadata

Tooling/documentación podrá conservar metadata histórica sin registrarlo como Contract activo.

---

# 140. Contract Documentation

Todo Contract público deberá poseer documentación suficiente.

---

# 141. Required Documentation

Debería incluir:

```text
purpose
owner
version
status
operations
inputs
outputs
errors
semantics
compatibility
examples
deprecation
```

según corresponda.

---

# 142. Documentation Is Part of Contract Governance

La documentación no deberá considerarse un elemento completamente separado cuando describe semántica normativa.

---

# 143. Normative vs Informative

La documentación debería distinguir cuando sea necesario:

```text
Normative
Informative
```

---

# 144. Normative Statement

Define una obligación.

Ejemplo:

```text
The provider MUST return...
```

---

# 145. Informative Example

Ilustra sin introducir una nueva obligación.

---

# 146. Contract Schema

Contracts basados en datos deberán disponer de Schema cuando sea razonable.

---

# 147. Schema Evolution

La evolución del Schema deberá someterse a Compatibility.

---

# 148. Required Field Addition

Agregar un campo obligatorio normalmente constituye Breaking Change para productores existentes.

---

# 149. Optional Field Addition

Puede ser compatible si Consumers toleran campos desconocidos.

---

# 150. Field Removal

Puede romper Producers o Consumers según dirección del Contract.

---

# 151. Enum Evolution

Agregar un valor puede ser Breaking si Consumers requieren exhaustividad.

---

# 152. Nullability

Cambiar:

```text
non-null → nullable
```

o viceversa puede afectar Compatibility.

---

# 153. Default Values

Los defaults forman parte de la semántica cuando son observables.

---

# 154. Ordering

Si el orden está garantizado deberá documentarse.

Si no está garantizado, Consumers no deberán depender de él.

---

# 155. Idempotency

Si una operación es idempotente deberá declararse.

---

# 156. Retry Semantics

Cuando sea relevante deberán documentarse.

---

# 157. Transactional Semantics

Cuando un Contract garantice atomicidad o transacción deberá expresarse.

---

# 158. Consistency Semantics

Ejemplos:

```text
strong
eventual
best-effort
```

solo cuando sean relevantes y formalmente definidos.

---

# 159. Timeout Semantics

No todos los Contracts deberán fijar tiempos.

Pero si existe garantía temporal deberá documentarse.

---

# 160. Cancellation

Cuando una operación soporte cancelación deberá definirse comportamiento observable.

---

# 161. Async Contracts

Contracts asíncronos deberán definir:

```text
completion
failure
cancellation
ordering
```

cuando corresponda.

---

# 162. Event Contracts

Events publicados entre Modules deberán tratarse como Contracts cuando formen parte de la superficie pública.

---

# 163. Event Schema

Un Event público deberá poseer Schema/version cuando sea necesario.

---

# 164. Event Semantics

Deberá definir:

```text
what happened
when it is emitted
payload
delivery expectations
ordering assumptions
```

---

# 165. Event Bus Engineering

ENG-022 definirá transporte, dispatch y subscribers.

ENG-021 define la estabilidad contractual del Event publicado.

---

# 166. Command Contracts

Commands públicos podrán ser Contracts cuando atraviesen fronteras arquitectónicas.

---

# 167. Query Contracts

Lo mismo aplica a Queries públicas.

---

# 168. HTTP Contracts

Una API HTTP podrá representar Contract mediante:

```text
method
path
request schema
response schema
status semantics
error schema
```

---

# 169. Message Contracts

Mensajes de queue/broker deberán versionarse cuando sean públicos.

---

# 170. Persistence Contract

Una interfaz de almacenamiento también puede constituir Contract.

---

# 171. Database Schema Is Not Automatically Public Contract

Un Schema interno de base de datos no deberá convertirse automáticamente en Contract entre Modules.

---

# 172. Data Ownership

Los Modules deberían interactuar mediante Contracts y no mediante acceso directo arbitrario a tablas internas de otros Modules.

---

# 173. External Contracts

Una integración externa podrá estar gobernada mediante Adapter.

---

# 174. Anti-Corruption Boundary

Cuando un proveedor externo tenga semántica diferente podrá introducirse un Contract MEF interno y Adapter.

```text
MEF Consumer
     ↓
MEF Contract
     ↑
External Adapter
     ↓
External API
```

---

# 175. External Vendor Leakage

El Domain no deberá depender innecesariamente de tipos propietarios del proveedor externo.

---

# 176. Contract Security

Un Contract deberá especificar requisitos de Security cuando formen parte de su uso.

Ejemplo:

```text
required capability
authorization context
data classification
```

---

# 177. Authorization Is Not Implementation Detail

Si una operación exige permiso observable, deberá formar parte de la política contractual correspondiente.

---

# 178. Sensitive Data

Inputs/Outputs sensibles deberán clasificarse cuando la plataforma lo requiera.

---

# 179. Secret Handling

Los Contracts no deberán requerir Secrets en lugares inseguros o registrables cuando pueda evitarse.

---

# 180. Trust Boundary

Un Contract que atraviesa Trust Boundary deberá validar Inputs.

---

# 181. Validation Ownership

Debe quedar claro si valida:

```text
Consumer
Provider
Boundary Adapter
```

según la regla aplicable.

---

# 182. Provider Must Defend Boundary

Un Provider no deberá asumir que todo Consumer es confiable cuando atraviesa una frontera de seguridad.

---

# 183. Error Information Disclosure

Los errores públicos no deberán filtrar detalles sensibles.

---

# 184. Contract Observability

Las operaciones podrán emitir Telemetry sin cambiar su semántica funcional.

---

# 185. Correlation

Contracts distribuidos podrán transportar Correlation Context mediante mecanismo gobernado.

---

# 186. Telemetry Fields Are Not Automatically Business Contract

Deberá distinguirse metadata técnica de payload funcional.

---

# 187. Contract Performance

Las expectativas de rendimiento solo deberán convertirse en obligaciones contractuales cuando sea necesario.

---

# 188. SLA vs Contract

Un SLA operacional no es automáticamente el mismo tipo de Contract de software.

Podrán relacionarse pero deberán mantenerse conceptualmente separados.

---

# 189. Contract Determinism

Si una operación promete determinismo deberá documentarse.

---

# 190. Side Effects

Los efectos laterales observables deberán estar definidos cuando sean relevantes.

---

# 191. Hidden Side Effects

Una Implementation no debería introducir efectos externos inesperados incompatibles con el Contract.

---

# 192. Consumer Assumptions

Los Consumers no deberán depender de comportamiento no garantizado.

---

# 193. Hyrum's Law Risk

Incluso comportamiento no documentado puede terminar siendo utilizado.

Por ello, los Contracts públicos deberán minimizar comportamientos accidentales observables.

---

# 194. Compatibility Testing

Además de Contract Tests podrán existir pruebas entre versiones.

---

# 195. Golden Contract Tests

Para Schemas/serialization podrán conservarse ejemplos canónicos.

---

# 196. Snapshot Testing

Puede utilizarse como apoyo.

No deberá sustituir razonamiento semántico sobre Compatibility.

---

# 197. Static Contract Analysis

Tooling podrá comparar versiones.

---

# 198. Contract Diff

Podrá generar:

```text
added operations
removed operations
changed inputs
changed outputs
changed errors
changed metadata
```

---

# 199. Compatibility Classification

El resultado podrá clasificarse:

```text
Compatible
Conditionally Compatible
Breaking
Unknown
```

---

# 200. Unknown

Cuando tooling no pueda determinar semántica deberá marcar:

```text
Unknown
```

en lugar de asumir compatibilidad.

---

# 201. Human Review

Los cambios semánticos pueden requerir revisión humana.

---

# 202. CLI Integration

ENG-007 podrá incorporar:

```text
mef contract validate
mef contract inspect
mef contract diff
mef contract test
mef contract consumers
mef contract providers
```

---

# 203. `contract inspect`

Podrá mostrar:

```text
ID
Version
Owner
Status
Visibility
Operations
Providers
Consumers
```

---

# 204. `contract diff`

Comparará dos versiones.

---

# 205. `contract test`

Ejecutará Contract Test Suite cuando exista.

---

# 206. `contract consumers`

Podrá consultar Registry Graph.

---

# 207. `contract providers`

Podrá mostrar Implementations conocidas.

---

# 208. Machine-Readable Output

Las herramientas deberán permitir formato estructurado para CI cuando corresponda.

---

# 209. Build Quality Gate

ENG-012 podrá validar:

```text
contract schema
version consistency
breaking changes
implementation compliance
manifest consistency
```

---

# 210. Breaking Change Gate

Un cambio incompatible no acompañado del Version Change requerido deberá bloquear Build/Release.

---

# 211. Release Integration

ENG-017 deberá incluir Contracts públicos dentro del análisis de Release.

---

# 212. Release Notes

Breaking Changes y Deprecations deberán documentarse cuando afecten Contracts públicos.

---

# 213. Compatibility Matrix

ENG-016 podrá mantener Matrix entre:

```text
Consumer
Contract Version
Provider
Implementation Version
```

---

# 214. Contract Fingerprint

Tooling podrá generar fingerprint de la representación normativa.

---

# 215. Fingerprint Purpose

Podrá ayudar a detectar cambios inesperados.

---

# 216. Fingerprint Does Not Determine Semantic Compatibility

Dos fingerprints diferentes no significan automáticamente Breaking Change.

---

# 217. Generated Client/Adapter

Contracts formales podrán utilizarse para generar:

```text
clients
stubs
validators
test fixtures
```

---

# 218. Generated Code

Será Artifact derivado.

No deberá convertirse en Source of Truth independiente.

---

# 219. Source of Truth

Todo Contract deberá tener una Source of Truth identificable.

Puede ser:

```text
interface definition
schema
IDL
specification file
governed source code
```

según Implementation Profile.

---

# 220. Multiple Representations

Si existen varias representaciones deberán derivarse o reconciliarse mediante regla explícita.

---

# 221. Source Conflict

No deberá existir:

```text
interface says A
schema says B
documentation says C
```

sin diagnóstico.

---

# 222. Contract Repository

Los Contracts podrán almacenarse junto al Module propietario o en ubicación compartida gobernada.

La estructura física deberá seguir ENG-006.

---

# 223. Shared Contracts Package

Podrá existir Package dedicado para Contracts cuando sea necesario evitar dependencias de Implementation.

---

# 224. Contract-Only Package

Ejemplo:

```text
PKG-IDENTITY-CONTRACTS
```

podrá publicar:

```text
CT-IDENTITY-001
```

sin contener Implementation.

---

# 225. Contract Package Independence

Un Consumer no debería necesitar instalar toda la infraestructura del Provider solo para conocer el Contract.

---

# 226. Circular Package Prevention

Separar Contracts podrá ayudar a evitar:

```text
Package A → Package B
Package B → Package A
```

pero no deberá utilizarse mecánicamente si no existe necesidad.

---

# 227. Contract Dependency Graph

Los Contracts pueden formar relaciones.

Ejemplo:

```text
CT-ORDER-001
    ↓
CT-MONEY-001
```

si uno utiliza tipos públicos definidos por otro.

---

# 228. Contract Graph Validation

Deberán evitarse ciclos innecesarios.

---

# 229. Shared Types

Tipos compartidos deberán tener ownership claro.

---

# 230. Primitive Obsession

No deberá evitarse un Contract bien definido utilizando únicamente:

```text
string
array
map
```

si ello elimina semántica necesaria.

---

# 231. DTO Contract

Un DTO público puede formar parte del Contract.

---

# 232. DTO Evolution

Sus cambios deberán someterse a Compatibility.

---

# 233. Domain Entity Exposure

Las Entities internas no deberían exponerse directamente como DTO público cuando ello acople Consumers al modelo interno.

---

# 234. Contract DTO

Se favorecerán representaciones explícitas de frontera cuando sea necesario.

---

# 235. Serialization Contract

Si un DTO cruza proceso/red deberá definirse su representación serializada.

---

# 236. Local Contract

Un Contract exclusivamente in-process puede depender del type system del Implementation Profile.

---

# 237. Distributed Contract

Un Contract distribuido deberá ser más explícito sobre:

```text
serialization
timeouts
partial failure
retries
idempotency
versioning
```

---

# 238. Local vs Remote Transparency

MEF no deberá asumir que una llamada remota es idéntica a una llamada local.

---

# 239. Contract Boundary Type

Podrá clasificarse:

```text
in-process
inter-module
inter-process
external
```

---

# 240. Boundary Metadata

Esta clasificación podrá influir en validación y Tooling.

---

# 241. Contract Registry Entry

La representación mínima recomendada será:

```text
ContractEntry
├── id
├── version
├── owner
├── status
├── visibility
├── boundary
├── source
├── providers
└── metadata
```

---

# 242. Provider Declaration

Una Implementation Entry podrá contener:

```text
implements:
  - contract: CT-CUSTOMER-001
    version: "^1.4"
```

---

# 243. Consumer Declaration

Un Module podrá declarar:

```text
requires:
  - contract: CT-CUSTOMER-001
    version: "^1.0"
```

---

# 244. Resolution Chain

La cadena completa será:

```text
Consumer
   ↓
Contract Requirement
   ↓
Registry
   ↓
Compatible Implementations
   ↓
Container Binding
   ↓
Instance
   ↓
Dependency Injection
```

---

# 245. Failure: Contract Missing

Si el Contract requerido no existe:

```text
Contract Resolution Failure
```

antes de intentar construir la dependencia.

---

# 246. Failure: No Compatible Provider

El Contract puede existir pero no existir Implementation compatible.

Deberá distinguirse del caso anterior.

---

# 247. Failure: Provider Non-Compliant

Puede existir Provider declarado pero fallar Contract Validation.

---

# 248. Failure: Deprecated Dependency

Normalmente deberá producir Warning, no Failure, mientras continúe soportado.

---

# 249. Failure: Retired Contract

No deberá utilizarse para nueva Composition soportada.

---

# 250. Error Taxonomy

Taxonomía conceptual:

```text
MEF-CT-001 Contract not found
MEF-CT-002 Invalid contract definition
MEF-CT-003 Contract identity conflict
MEF-CT-004 Contract version conflict
MEF-CT-005 Implementation non-compliant
MEF-CT-006 Breaking change detected
MEF-CT-007 Invalid owner
MEF-CT-008 Visibility violation
MEF-CT-009 Contract deprecated
MEF-CT-010 Contract retired
MEF-CT-011 No compatible provider
MEF-CT-012 Contract test failed
MEF-CT-013 Source representation conflict
MEF-CT-014 Invalid schema
MEF-CT-015 Compatibility unknown
```

---

# 251. Prefix

Los errores de Contracts utilizarán:

```text
MEF-CT-xxx
```

Esto es coherente con el identificador arquitectónico:

```text
CT-*
```

pero ambos namespaces tienen propósitos distintos.

---

# 252. Missing Contract Diagnostic

```text
MEF-CT-001

Required Contract not found.

Consumer:
MOD-CRM

Contract:
CT-IDENTITY-001

Required version:
^2.0
```

---

# 253. Non-Compliant Implementation

```text
MEF-CT-005

Implementation does not satisfy Contract.

Contract:
CT-STORAGE-001

Implementation:
S3StorageAdapter

Failed rule:
delete() must be idempotent.
```

---

# 254. Breaking Change Diagnostic

```text
MEF-CT-006

Breaking Contract change detected.

Contract:
CT-CUSTOMER-001

Previous:
1.4.2

Candidate:
1.5.0

Breaking change:
Required parameter "tenantId" added.

Expected version:
2.0.0 or greater.
```

---

# 255. No Compatible Provider

```text
MEF-CT-011

No compatible provider available.

Contract:
CT-PAYMENT-001

Consumer requires:
^3.0

Available providers:
StripeAdapter → 2.x
AdyenAdapter  → 2.x
```

---

# 256. Contract Test Failure

```text
MEF-CT-012

Contract test failed.

Contract:
CT-CUSTOMER-001

Implementation:
PostgresCustomerRepository

Test:
returns NotFound for unknown customer

Actual:
null
```

---

# 257. Logging

ENG-010 podrá registrar:

```text
contract.validation.failed
contract.compatibility.breaking
contract.deprecated.used
contract.test.failed
```

---

# 258. Sensitive Information

Diagnostics no deberán exponer información sensible contenida en payloads reales.

---

# 259. Audit

Cambios de Contracts críticos podrán formar parte de Audit.

---

# 260. Security Review

Contracts que atraviesen Trust Boundaries podrán requerir revisión de Security antes de publicación.

---

# 261. Testing Requirements

ENG-009 deberá permitir al menos:

```text
definition tests
schema tests
contract tests
compatibility tests
implementation tests
consumer integration tests
```

---

# 262. Definition Test

Verifica que el Contract está estructuralmente bien definido.

---

# 263. Compatibility Test

Compara una versión Candidate contra una versión previa soportada.

---

# 264. Implementation Test

Verifica que una Implementation satisface el Contract.

---

# 265. Consumer Test

Verifica que un Consumer funciona contra una Implementation conforme.

---

# 266. Contract Mutation Testing

Podrá utilizarse para comprobar que Tests detectan violaciones relevantes.

No será requisito inicial.

---

# 267. Performance Testing

Solo será Contract Test cuando exista una garantía contractual de rendimiento.

---

# 268. Documentation Testing

Ejemplos ejecutables podrán comprobarse cuando la plataforma lo permita.

---

# 269. Governance

Los Contracts públicos deberán estar sujetos a Change Review.

---

# 270. Change Proposal

Un cambio deberá indicar:

```text
Contract
Current Version
Proposed Version
Change
Compatibility Impact
Affected Consumers
Affected Providers
Migration
```

---

# 271. Approval

Contracts críticos podrán requerir aprobación adicional.

---

# 272. Experimental Contract Governance

Los Contracts Experimental podrán tener proceso más ligero.

---

# 273. Stable Contract Governance

Los Stable deberán tener controles más estrictos.

---

# 274. Contract Ownership Transfer

Transferir ownership deberá ser explícito y trazable.

---

# 275. Ownership Transfer Does Not Change Identity

Un Contract no necesita nuevo ID únicamente porque cambió su Owner.

---

# 276. Contract Rename

Cambiar nombre descriptivo no necesariamente cambia identidad.

---

# 277. Contract Split

Dividir un Contract grande en varios puede requerir nuevos IDs.

---

# 278. Contract Merge

Fusionar Contracts puede requerir nueva frontera contractual.

---

# 279. Compatibility Policy

No deberá asumirse automáticamente que Split/Merge es compatible.

---

# 280. Architectural Review

Cambios estructurales de Contracts públicos deberán revisarse contra ARQ-011.

---

# 281. Invariantes de Ingeniería

ENG-021 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-366 | Todo Contract arquitectónico publicado deberá poseer una identidad canónica estable. |
| EI-367 | El prefijo canónico de Contracts arquitectónicos deberá ser `CT`. |
| EI-368 | La identidad del Contract y su versión deberán mantenerse como conceptos separados. |
| EI-369 | Todo Contract público deberá poseer Owner identificable. |
| EI-370 | Contract e Implementation deberán mantenerse como conceptos distintos. |
| EI-371 | El Owner de un Contract no deberá asumirse automáticamente como su único Provider. |
| EI-372 | Un Contract público deberá definir suficiente semántica observable para permitir implementación y consumo correctos. |
| EI-373 | La Compatibility de un Contract no deberá determinarse únicamente mediante igualdad sintáctica de firmas. |
| EI-374 | Los cambios semánticos observables deberán evaluarse como posibles Breaking Changes. |
| EI-375 | Los Consumers no deberán depender de detalles internos no publicados por el Contract. |
| EI-376 | Las Implementations deberán satisfacer las garantías del Contract que declaran implementar. |
| EI-377 | Los Contracts públicos Stable deberán someter su evolución a Versioning y Compatibility. |
| EI-378 | Un Breaking Change no deberá publicarse como versión compatible sin revisión explícita. |
| EI-379 | Los Contract Tests reutilizables deberán validar las mismas garantías esenciales para Implementations equivalentes cuando sean aplicables. |
| EI-380 | La ausencia de evidencia de conformidad no deberá interpretarse automáticamente como conformidad verificada. |
| EI-381 | Los Contracts Deprecated deberán continuar cumpliendo sus garantías mientras permanezcan soportados. |
| EI-382 | Los Contracts Retired no deberán utilizarse para nueva Composition soportada. |
| EI-383 | Manifest, Registry y representación ejecutable de un Contract no deberán divergir silenciosamente. |
| EI-384 | Los Contracts que atraviesen Module Boundaries deberán respetar Visibility, Ownership y Architecture. |
| EI-385 | La selección de una Implementation para un Contract deberá ocurrir únicamente después de validar su Compatibility cuando aplique. |

---

# 282. Criterios de Conformidad

Una implementación será conforme con ENG-021 cuando:

- utilice IDs `CT-*`;
- separe ID y Version;
- defina Ownership;
- distinga Consumer y Provider;
- distinga Contract e Implementation;
- defina Visibility;
- documente semántica pública;
- permita múltiples Implementations;
- integre Registry;
- integre Container;
- integre Dependency Injection;
- aplique Versioning;
- aplique Compatibility;
- detecte Breaking Changes;
- soporte Deprecation;
- soporte Retirement;
- permita Contract Testing;
- preserve Source of Truth;
- mantenga independencia tecnológica.

---

# 283. Riesgos

Deberán evitarse especialmente:

## Interface Equals Contract

Creer que una firma define toda la semántica.

## Contract Explosion

Crear interfaz para cada clase.

## God Contract

Una sola interfaz concentra capacidades no relacionadas.

## Implementation Leakage

El Contract expone tipos internos del Provider.

## Vendor Leakage

El Domain depende de tipos propietarios externos.

## Silent Breaking Change

Se cambia comportamiento sin incrementar versión apropiadamente.

## Registry as Authority

La metadata registrada sustituye la definición normativa.

## Version in ID

Crear IDs distintos para cada Patch/Minor.

## Contract Without Owner

Nadie es responsable de evolución.

## False Compatibility

Tooling declara compatible algo cuya semántica desconoce.

## Untested Provider

Una Implementation declara cumplimiento sin evidencia cuando ésta es requerida.

## Permanent Deprecation

Contracts Deprecated nunca se retiran ni migran.

## Direct Database Coupling

Un Module consume tablas internas de otro en lugar de una frontera contractual.

---

# 284. Arquitectura Recomendada

```text
                    CONTRACT SOURCE
                          │
                          ▼
                    CONTRACT MODEL
                          │
           ┌──────────────┼──────────────┐
           ▼              ▼              ▼
       Identity       Semantics       Version
           │              │              │
           └──────────────┼──────────────┘
                          ▼
                     VALIDATION
                          │
             ┌────────────┼────────────┐
             ▼            ▼            ▼
         Schema       Compatibility   Tests
             │            │            │
             └────────────┼────────────┘
                          ▼
                       REGISTRY
                          │
              ┌───────────┴───────────┐
              ▼                       ▼
           Consumer                 Provider
              │                       │
              │                       ▼
              │                 Implementation
              │                       │
              └───────────┬───────────┘
                          ▼
                       CONTAINER
                          │
                          ▼
                          DI
                          │
                          ▼
                       RUNTIME
```

---

# 285. Primera Implementación Recomendada

La primera versión deberá concentrarse en:

```text
Contract ID
Version
Owner
Visibility
Status

Interface/Schema representation

requires
provides
implements

Registry integration
Container integration

Contract Tests
Compatibility checks

Deprecation
Breaking Change detection
```

No será necesario inicialmente implementar:

```text
distributed schema registry
automatic semantic proof
remote contract federation
complex consumer-driven contract platform
runtime contract negotiation
```

---

# 286. Segunda Fase

Podrá incorporar:

```text
Contract Diff
Generated Validators
Generated Clients
Contract Fingerprints
Impact Analysis
Compatibility Reports
Consumer-Driven Contracts
```

---

# 287. Tercera Fase

Solo si existe necesidad:

```text
Remote Contract Registry
Distributed Contract Negotiation
Cross-runtime IDL
Automated Migration Bridges
Formal Semantic Verification
```

---

# 288. Relación con ENG-018

```text
ENG-021
Contract
   │
   ▼
ENG-018
Dependency Requirement
```

DI utiliza Contracts para evitar dependencia directa de Implementation.

---

# 289. Relación con ENG-019

```text
Contract
   ↓
Binding
   ↓
Implementation
   ↓
Instance
```

El Service Container materializa la relación.

---

# 290. Relación con ENG-020

```text
Contract
   ↓
Registry Entry
   ↓
Discovery
```

Registry conoce Contracts e Implementations sin construirlos.

---

# 291. Relación con ENG-022

Events públicos deberán tratarse como Contracts cuando crucen fronteras arquitectónicas.

ENG-022 gobernará su dispatch.

ENG-021 gobernará su estabilidad contractual.

---

# 292. Relación con ENG-023

Los errores públicos de un Contract deberán mapearse al modelo de Error Handling sin filtrar detalles internos.

---

# 293. Relación con ENG-024

Security Engineering deberá gobernar:

```text
authorization
trust boundaries
sensitive payloads
provider trust
```

cuando formen parte del Contract.

---

# 294. Relación con ENG-027

Runtime deberá resolver:

```text
Consumer Requirement
        ↓
Contract
        ↓
Registry Candidates
        ↓
Compatibility
        ↓
Container Binding
        ↓
Implementation
```

antes de Activation cuando la dependencia sea obligatoria.

---

# 295. Principio Rector

> **Un Contract en MEF deberá constituir una frontera estable, identificable, versionada y verificable entre consumidores y proveedores, describiendo comportamiento observable sin exponer innecesariamente la implementación y permitiendo evolución compatible, sustitución y validación independiente.**

---

# 296. Conclusión

**ENG-021 — Contracts Engineering** convierte `Contract` en un activo formal de Ingeniería de MEF.

La cadena fundamental queda:

```text
Owner
  ↓
Contract Definition
  ↓
CT-*
  ↓
Version
  ↓
Publication
  ↓
Registry
  ↓
Providers
  ↓
Implementations
  ↓
Compatibility
  ↓
Contract Tests
  ↓
Container
  ↓
Dependency Injection
  ↓
Consumer
```

Y consolida las responsabilidades:

```text
ENG-018
Dependency Injection
→ entrega la dependencia

ENG-019
Service Container
→ construye la Implementation

ENG-020
Registry
→ conoce Contract e Implementations

ENG-021
Contracts Engineering
→ define qué deben garantizar
```

Esto permite que:

```text
MOD-CRM
```

dependa de:

```text
CT-IDENTITY-001
```

sin depender directamente de:

```text
IdentityRepositorySql
IdentityServiceInternal
LaravelIdentityProvider
ExternalIdentityVendor
```

La Implementation podrá cambiar siempre que continúe satisfaciendo:

```text
Identity
Version
Semantics
Compatibility
Contract Tests
Security requirements
```

del Contract.

Así, el Contract se convierte en la frontera estable y la Implementation en un detalle sustituible.

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
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-027 — Runtime Engineering