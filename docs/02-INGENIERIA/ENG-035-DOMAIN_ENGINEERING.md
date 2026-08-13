---
id: ENG-035
titulo: Domain Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Domain Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-014
  - ENG-015
  - ENG-016
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-028
  - ENG-034
relacionados:
  - ENG-006
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-018
  - ENG-019
  - ENG-020
  - ENG-022
  - ENG-025
  - ENG-026
  - ENG-027
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-036
keywords:
  - domain
  - domain-model
  - entity
  - value-object
  - aggregate
  - aggregate-root
  - domain-service
  - domain-event
  - invariant
  - factory
  - specification
  - policy
  - repository
  - ubiquitous-language
  - bounded-context
  - ddd
  - mef
---

# ENG-035

# Domain Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Domain Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-035 establece las reglas para diseñar y proteger el modelo de negocio mediante:

```text
Domain Model
Ubiquitous Language
Entity
Value Object
Aggregate
Aggregate Root
Domain Invariant
Domain Service
Domain Event
Factory
Specification
Policy
Repository Contract
Domain Error
Domain Boundary
Domain State
Domain Identity
```

El objetivo será que el software represente explícitamente las reglas y conceptos del negocio sin subordinarlos a:

```text
Database
API
Framework
ORM
Transport
UI
Controller
```

---

# 2. Declaración

La regla fundamental será:

> **El Domain deberá modelar conceptos, reglas, estados e invariantes del negocio mediante objetos y Contracts que permanezcan independientes de las tecnologías utilizadas para almacenar, transportar o presentar dicha información.**

Por tanto:

```text
Business Concept
      │
      ▼
Domain Model
      │
      ▼
Business Behavior
      │
      ▼
Invariant
      │
      ▼
Valid State
```

y no:

```text
Database Table
      │
      ▼
ORM Entity
      │
      ▼
Generated CRUD
      │
      ▼
Business Model
```

---

# 3. Domain

`Domain` representa el espacio conceptual y funcional del problema que una Application intenta resolver.

---

# 4. Domain Model

El `Domain Model` representa mediante software los conceptos relevantes del Domain.

Podrá contener:

```text
Entities
Value Objects
Aggregates
Domain Services
Domain Events
Factories
Specifications
Policies
Domain Errors
```

---

# 5. Domain ≠ Application

Deberán mantenerse separados:

```text
Domain
→ decides business validity and behavior

Application
→ coordinates use cases
```

---

# 6. Domain ≠ Persistence

También:

```text
Domain Model
≠
Persistence Model
```

---

# 7. Domain ≠ API

También:

```text
Domain Entity
≠
API DTO
```

---

# 8. Domain ≠ Transport

El Domain no deberá conocer:

```text
HTTP
JSON
gRPC
message brokers
sockets
```

como requisito ordinario.

---

# 9. Domain ≠ Framework

El Domain deberá evitar dependencias innecesarias hacia MEF Infrastructure.

---

# 10. Technology Independence

El Domain debería poder probarse sin:

```text
Database
HTTP Server
Message Broker
Service Container
Network
Filesystem
```

salvo que un concepto concreto del Domain requiera un Port.

---

# 11. Ubiquitous Language

El modelo deberá favorecer un vocabulario consistente entre:

```text
business
requirements
code
tests
contracts
documentation
```

---

# 12. Language Consistency

Si el negocio utiliza el término:

```text
Order
```

el código no debería utilizar arbitrariamente:

```text
PurchaseThing
TransactionDocument
SalesObject
```

para representar el mismo concepto.

---

# 13. Concept Identity

Cada concepto importante deberá poseer significado claro dentro de su Domain Boundary.

---

# 14. Ambiguous Term

Cuando una palabra posea diferentes significados según contexto, deberán diferenciarse los modelos.

Ejemplo:

```text
Customer
```

puede significar cosas diferentes en:

```text
Sales
Billing
Support
Identity
```

---

# 15. Domain Boundary

Un Domain Model deberá existir dentro de una Boundary arquitectónica identificable.

---

# 16. Bounded Context

Cuando sea aplicable, un `Bounded Context` delimitará dónde un modelo y lenguaje poseen significado consistente.

---

# 17. Bounded Context ≠ Module

No deberán considerarse equivalentes universalmente.

Podrán relacionarse:

```text
1 Bounded Context
→ 1 Module
```

pero también existir otras composiciones según Architecture.

---

# 18. Module Boundary

ENG-028 seguirá gobernando Modules.

ENG-035 gobierna el modelo de negocio dentro de dichas Boundaries.

---

# 19. Context Mapping

Las relaciones entre modelos distintos deberán ser explícitas cuando sea necesario.

---

# 20. No Universal Enterprise Model

MEF no deberá intentar construir un único modelo global para todos los Domains.

---

# 21. Entity

Una `Entity` es un objeto definido principalmente por su identidad y continuidad a través del tiempo.

---

# 22. Entity Identity

Dos Entities con los mismos atributos pueden seguir siendo diferentes si poseen identidades distintas.

---

# 23. Example

```text
Customer A
name: Ana

Customer B
name: Ana
```

siguen siendo dos Customers diferentes.

---

# 24. Stable Identity

La identidad deberá permanecer estable durante el Lifetime lógico de la Entity.

---

# 25. Entity Equality

Deberá basarse principalmente en Identity dentro del Context correspondiente.

---

# 26. Entity Mutation

Una Entity podrá cambiar estado manteniendo identidad.

---

# 27. Entity Behavior

Deberá favorecer comportamiento significativo.

Preferir:

```text
customer.changeEmail(newEmail)
order.cancel(reason)
account.freeze()
```

sobre modificar propiedades arbitrariamente.

---

# 28. Anemic Entity

Deberá evitarse cuando la Entity posea reglas de negocio significativas pero solo contiene:

```text
getters
setters
```

---

# 29. Setter Exposure

No deberá utilizarse Setter genérico cuando una transición necesite reglas.

Incorrecto:

```text
order.setStatus("cancelled")
```

Preferible:

```text
order.cancel(reason)
```

---

# 30. Valid State

Una Entity no deberá quedar deliberadamente en estado inválido entre operaciones públicas ordinarias.

---

# 31. Constructor

Deberá establecer como mínimo las invariantes necesarias para crear una instancia válida.

---

# 32. Factory Creation

Cuando construcción sea compleja podrá utilizarse Factory.

---

# 33. Rehydration

Reconstruir una Entity desde Persistence no deberá implicar necesariamente ejecutar lógica de creación nueva.

---

# 34. Creation ≠ Rehydration

Deberán mantenerse separados cuando sus invariantes temporales sean distintas.

---

# 35. Entity Internal State

Deberá protegerse de modificación externa arbitraria.

---

# 36. Value Object

Un `Value Object` representa un concepto definido por sus valores y no por identidad individual.

Ejemplos:

```text
Money
EmailAddress
DateRange
Coordinates
Percentage
Address
```

dependiendo del Domain.

---

# 37. Value Equality

Dos Value Objects con los mismos valores deberán ser semánticamente iguales.

---

# 38. Value Object Immutability

Deberán favorecerse Value Objects inmutables.

---

# 39. Replace, Don't Mutate

En lugar de:

```text
money.amount = 200
```

deberá favorecerse construir otro Value Object.

---

# 40. Self Validation

Un Value Object deberá impedir estados inválidos relevantes.

---

# 41. Email Example

Conceptualmente:

```text
EmailAddress
```

no debería poder representar una dirección inválida según las reglas definidas por su Domain.

---

# 42. Money

`Money` deberá representar explícitamente:

```text
amount
currency
```

cuando ambos sean necesarios.

---

# 43. Money Precision

No deberá depender de Floating Point inapropiado.

---

# 44. Currency Compatibility

Operaciones entre monedas deberán exigir semántica explícita.

---

# 45. Primitive Obsession

Deberá evitarse cuando un Primitive tenga reglas propias.

Ejemplo:

```text
string email
string customerId
float money
```

podrán transformarse en tipos de Domain cuando aporten garantías significativas.

---

# 46. Value Object Overuse

No todo String o Integer deberá convertirse automáticamente en Value Object.

---

# 47. Domain Value

La decisión deberá basarse en:

```text
semantics
validation
behavior
invariants
reuse
clarity
```

---

# 48. Aggregate

Un `Aggregate` representa un conjunto de Domain Objects tratados como una unidad de consistencia.

---

# 49. Aggregate Root

Todo Aggregate deberá poseer una raíz identificable:

```text
Aggregate Root
```

---

# 50. Aggregate Access

Los Consumers externos deberán interactuar con el Aggregate principalmente a través del Aggregate Root.

---

# 51. Internal Entity

Entities internas del Aggregate no deberán modificarse directamente desde afuera.

---

# 52. Aggregate Invariant

El Aggregate Root será responsable de preservar invariantes que abarcan componentes internos del Aggregate.

---

# 53. Aggregate Transaction Boundary

Un Aggregate deberá favorecerse como unidad principal de consistencia transaccional.

---

# 54. One Transaction, One Aggregate

Como guía inicial:

```text
one command
→ one aggregate
```

deberá favorecerse cuando el Use Case lo permita.

---

# 55. Multiple Aggregates

Cuando una operación modifique varios Aggregates deberá evaluarse cuidadosamente:

```text
consistency
transaction scope
eventual consistency
workflow
```

---

# 56. Aggregate Size

Deberá mantenerse suficientemente pequeño para evitar:

```text
large loads
lock contention
high coupling
long transactions
```

---

# 57. Giant Aggregate

Deberá evitarse un Aggregate que contenga todo el Module.

---

# 58. Tiny Aggregate

Tampoco deberá dividirse artificialmente si rompe invariantes reales.

---

# 59. Aggregate Reference

Un Aggregate debería referenciar otro Aggregate principalmente por Identity cuando sea apropiado.

---

# 60. Direct Object Graph

No deberá asumirse que todo el Domain forma un Object Graph navegable y cargado.

---

# 61. Lazy Loading

El Domain no deberá depender implícitamente de Lazy Loading ORM para funcionar.

---

# 62. Aggregate Loading

Repository deberá reconstruir un Aggregate válido.

---

# 63. Aggregate Save

Persistence deberá preservar cambios del Aggregate conforme ENG-030.

---

# 64. Invariant

Una `Domain Invariant` es una regla que deberá ser verdadera en todo estado válido del Domain Model.

---

# 65. Example

```text
An approved order cannot have zero items.
```

si esa regla pertenece al Domain.

---

# 66. Invariant Enforcement

Deberá ocurrir dentro de la Boundary que posee la regla.

---

# 67. No Controller Invariant

Un Controller no deberá ser el único lugar donde se protege una regla de Domain.

---

# 68. No UI-Only Invariant

Tampoco deberá depender únicamente de validación de UI.

---

# 69. Defense in Depth

API/Persistence podrán reforzar restricciones, pero el Domain deberá conservar autoridad sobre reglas propias.

---

# 70. Invariant Failure

Deberá producir Domain Error explícito cuando corresponda.

---

# 71. Domain Error

Un `Domain Error` representa una violación o resultado inválido significativo del Domain.

---

# 72. Domain Error Examples

```text
OrderAlreadyCancelled
CreditLimitExceeded
InvalidMoneyOperation
CustomerAlreadySuspended
```

---

# 73. Domain Error ≠ Infrastructure Error

Deberán distinguirse.

```text
CreditLimitExceeded
≠
DatabaseConnectionFailure
```

---

# 74. Domain Error ≠ API Error

API deberá mapear Domain Errors conforme ENG-033.

---

# 75. Domain Error Code

Podrá poseer código estable si cruza Contracts.

---

# 76. Error Namespace

ENG-035 utilizará:

```text
MEF-DOM-xxx
```

para errores propios de infraestructura/modelado Domain de MEF.

Errores específicos del negocio podrán utilizar Namespaces propios del Module.

---

# 77. Taxonomía ENG-035

```text
MEF-DOM-001 Domain model invalid
MEF-DOM-002 Entity identity invalid
MEF-DOM-003 Entity state invalid
MEF-DOM-004 Value Object invalid
MEF-DOM-005 Aggregate invalid
MEF-DOM-006 Aggregate invariant violated
MEF-DOM-007 Domain operation not allowed
MEF-DOM-008 Domain transition invalid
MEF-DOM-009 Domain service unavailable
MEF-DOM-010 Domain specification invalid
MEF-DOM-011 Domain policy invalid
MEF-DOM-012 Domain factory failed
MEF-DOM-013 Domain event invalid
MEF-DOM-014 Domain identity conflict
MEF-DOM-015 Domain dependency violation
MEF-DOM-016 Cross-domain boundary violation
MEF-DOM-017 Domain persistence leakage detected
MEF-DOM-018 Domain transport leakage detected
MEF-DOM-019 Domain framework leakage detected
MEF-DOM-020 Domain invariant violated
```

---

# 78. Aggregate Invariant Failure

```text
MEF-DOM-006

Aggregate invariant violated.

Aggregate:
Order

Invariant:
An order must contain at least one item before approval.
```

---

# 79. Invalid Transition

```text
MEF-DOM-008

Invalid domain transition.

Entity:
Order

Current state:
CANCELLED

Requested transition:
APPROVED
```

---

# 80. Framework Leakage

```text
MEF-DOM-019

Domain framework leakage detected.

Domain component:
Customer

Dependency:
HttpRequest
```

---

# 81. Domain State

Domain Objects podrán poseer State.

---

# 82. State Transition

Una transición significativa deberá ocurrir mediante comportamiento explícito.

---

# 83. State Machine

Cuando un concepto posea Lifecycle complejo podrá utilizar State Machine.

---

# 84. Domain State Machine ≠ Runtime State Machine

Deberán distinguirse.

```text
ENG-015
→ architectural/runtime state

ENG-035
→ business/domain state
```

---

# 85. Domain State Example

```text
Order

DRAFT
  ↓
SUBMITTED
  ↓
APPROVED
  ↓
FULFILLED
```

---

# 86. Illegal Transition

Deberá rechazarse.

---

# 87. Transition Guard

Podrá protegerse mediante invariantes.

---

# 88. State as String

No deberá favorecerse String arbitrario cuando existe conjunto cerrado con comportamiento.

---

# 89. Domain Service

Un `Domain Service` representa comportamiento de negocio que:

```text
belongs to the Domain
```

pero no encaja naturalmente dentro de una única Entity o Value Object.

---

# 90. Domain Service Characteristics

Deberá:

```text
use domain language
express business behavior
avoid infrastructure details
prefer statelessness
```

---

# 91. Domain Service ≠ Application Service

```text
Domain Service
→ business decision

Application Service
→ use-case coordination
```

---

# 92. Domain Service Example

Conceptualmente:

```text
PricingPolicy
RiskCalculator
ExchangePolicy
EligibilityService
```

cuando representen comportamiento puro del Domain.

---

# 93. Service Overuse

No deberá mover todo comportamiento fuera de Entities hacia Services.

---

# 94. Rich Model

Las reglas deberán vivir tan cerca como sea razonable del concepto que las posee.

---

# 95. Domain Dependency

Un Domain Service podrá depender de otro Domain Contract cuando sea estrictamente necesario.

---

# 96. Infrastructure Dependency

No deberá depender directamente de:

```text
SQL
HTTP
Redis
filesystem
framework container
```

---

# 97. External Information

Si una decisión Domain requiere información externa podrá recibirla como:

```text
Value
Domain Policy input
Domain Contract
```

según el caso.

---

# 98. Time

Si Time forma parte de una regla del negocio deberá suministrarse explícitamente.

---

# 99. Clock

Podrá utilizarse un Domain/Application Port.

---

# 100. No Hidden Now

Deberá evitarse:

```text
new DateTime()
```

disperso en reglas Domain cuando impida determinismo.

---

# 101. Domain Factory

Una `Factory` encapsula construcción compleja de Domain Objects.

---

# 102. Factory Purpose

Podrá:

```text
validate creation rules
generate internal structure
select subtype
construct aggregate
```

---

# 103. Factory ≠ Repository

```text
Factory
→ creates new domain object

Repository
→ retrieves/persists existing domain object
```

---

# 104. Factory Naming

Deberá utilizar lenguaje del Domain.

---

# 105. Static Factory

Podrá utilizarse:

```text
Order.create(...)
```

cuando sea claro.

---

# 106. External Factory

Podrá utilizarse para construcción compleja.

---

# 107. Factory Validity

No deberá producir objetos inválidos.

---

# 108. Domain Event

Un `Domain Event` representa un hecho significativo que ocurrió dentro del Domain.

---

# 109. Event Naming

Deberá utilizar tiempo pasado o semántica equivalente.

Ejemplos:

```text
OrderSubmitted
CustomerActivated
PaymentAuthorized
```

---

# 110. Domain Event ≠ Command

Se mantiene:

```text
Command
→ intent

Domain Event
→ fact
```

---

# 111. Domain Event ≠ Integration Event

Deberán poder mantenerse separados.

---

# 112. Domain Event

Puede ser interno al Domain/Module.

---

# 113. Integration Event

Está diseñado para Consumers externos/cross-module.

---

# 114. Event Mapping

Podrá existir:

```text
Domain Event
      ↓
Application
      ↓
Integration Event
```

---

# 115. No Internal Model Exposure

Un Domain Event interno no deberá convertirse automáticamente en Public Event Contract.

---

# 116. Event Immutability

Un Event representa un hecho ocurrido y deberá favorecerse como inmutable.

---

# 117. Event Timestamp

Podrá incluir cuándo ocurrió.

---

# 118. Event Identity

Podrá poseer Identity cuando se distribuya.

---

# 119. Event Data

Deberá contener información suficiente para su semántica sin exponer internals innecesarios.

---

# 120. Aggregate Domain Events

Aggregate Root podrá registrar Events derivados de operaciones válidas.

---

# 121. Event Recording

Conceptualmente:

```text
order.submit()
      │
      ├── changes state
      └── records OrderSubmitted
```

---

# 122. Event Publication

El Domain no deberá conocer Event Bus concreto.

---

# 123. Application Publication

ENG-034 deberá coordinar Publication.

---

# 124. Domain Event Handler

Podrá existir dentro del Domain únicamente cuando represente reacción de Domain pura.

---

# 125. Side Effects

Efectos externos deberán pasar normalmente por Application/Infrastructure.

---

# 126. Specification

Una `Specification` representa una regla o criterio de negocio composable.

---

# 127. Specification Example

```text
CustomerIsEligibleForCredit
OrderCanBeCancelled
ProductRequiresReview
```

---

# 128. Specification Purpose

Podrá encapsular:

```text
eligibility
selection rule
validation rule
business criterion
```

---

# 129. Specification ≠ Query Builder

No deberá convertirse en SQL disfrazado.

---

# 130. Domain Specification

Deberá utilizar lenguaje del Domain.

---

# 131. Specification Composition

Podrá soportar:

```text
AND
OR
NOT
```

cuando posea semántica clara.

---

# 132. Specification Persistence Translation

Infrastructure podrá traducir ciertas Specifications a Queries.

---

# 133. Translation Limitation

No toda Specification deberá ser necesariamente traducible a Persistence Query.

---

# 134. Policy

Una `Policy` representa una decisión o estrategia de Domain.

---

# 135. Policy Example

```text
PricingPolicy
CancellationPolicy
CreditPolicy
AllocationPolicy
```

---

# 136. Policy ≠ Security Policy

Deberán mantenerse separados cuando el término sea ambiguo.

---

# 137. Domain Policy

Representa una regla/estrategia de negocio.

---

# 138. Security Policy

ENG-024 gobierna Authorization/Security.

---

# 139. Policy Selection

Podrá depender del Context de negocio.

---

# 140. Strategy

Una Policy podrá implementarse mediante Strategy Pattern.

No es requisito.

---

# 141. Domain Contract

Cuando el Domain necesite una abstracción externa, deberá definirse mediante Contract apropiado.

---

# 142. Repository Contract

Es un ejemplo fundamental.

---

# 143. Repository

Representa una colección conceptual de Aggregates/Entities apropiados para Persistence.

---

# 144. Repository Language

Deberá utilizar operaciones Domain-specific cuando sean necesarias.

Ejemplo:

```text
OrderRepository
├── findById()
├── save()
└── findPendingForCustomer()
```

---

# 145. Repository Interface Location

El Contract deberá pertenecer a la Boundary que lo necesita, no necesariamente al Adapter que lo implementa.

---

# 146. Repository ≠ ORM

El Repository no deberá exponer API del ORM al Domain.

---

# 147. Repository ≠ Query Everything

No deberá ofrecer acceso arbitrario a cualquier tabla.

---

# 148. Aggregate Repository

Deberá favorecerse Repository por Aggregate Root cuando el modelo utilice Aggregates.

---

# 149. Child Repository

No deberá existir automáticamente para cada Entity interna.

---

# 150. Save Semantics

`save()` deberá preservar Aggregate como unidad consistente.

---

# 151. Identity Generation

La estrategia podrá variar.

---

# 152. Domain-Generated Identity

Puede generarse antes de Persistence.

---

# 153. Persistence-Generated Identity

También podrá utilizarse cuando no rompa Domain semantics.

---

# 154. Identity Availability

Si otros objetos necesitan Identity antes de Persist, deberá seleccionarse estrategia adecuada.

---

# 155. Domain Identifier

Deberá poder representarse como Value Object.

---

# 156. Identity Leakage

No deberá depender innecesariamente del tipo físico de Primary Key.

---

# 157. Domain Primitive Types

Podrán definirse:

```text
CustomerId
OrderId
PaymentId
```

cuando aporten Type Safety y claridad.

---

# 158. Type Safety

Deberá evitar errores como mezclar:

```text
CustomerId
```

con:

```text
OrderId
```

cuando el lenguaje permita protección razonable.

---

# 159. Validation

ENG-036 especializará Validation Engineering.

ENG-035 distingue qué validación pertenece al Domain.

---

# 160. Structural Validation

Ejemplo:

```text
field is required
valid JSON
maximum payload length
```

no pertenece necesariamente al Domain.

---

# 161. Domain Validation

Ejemplo:

```text
an order cannot be approved without items
```

sí pertenece al Domain.

---

# 162. Business Rule

Deberá modelarse en el componente que posee el conocimiento.

---

# 163. Validation Duplication

Puede existir Defense in Depth, pero deberán conservarse Sources of Truth claras.

---

# 164. Domain Invariant Source

El Domain será Source of Truth de sus invariantes.

---

# 165. Persistence Constraint

Puede reforzar la misma regla estructuralmente.

---

# 166. API Validation

Puede rechazar Inputs obviamente inválidos antes.

---

# 167. But

Ni Persistence ni API deberán sustituir la regla Domain.

---

# 168. Null

El Domain deberá evitar Null ambiguo cuando exista una representación conceptual mejor.

---

# 169. Optional Value

Podrá modelarse explícitamente.

---

# 170. Null Object

Podrá utilizarse cuando sea semánticamente apropiado.

---

# 171. Magic Values

Deberán evitarse.

Ejemplo:

```text
-1
999999
"N/A"
```

como estados Domain ocultos.

---

# 172. Explicit Concept

Preferir tipos/estados explícitos.

---

# 173. Domain Collections

Podrán encapsular comportamiento.

Ejemplo:

```text
OrderItems
```

en lugar de Array arbitrario cuando existan invariantes.

---

# 174. Collection Mutation

Deberá proteger invariantes.

---

# 175. Public Mutable Collection

No debería permitir modificación que el Aggregate no pueda controlar.

---

# 176. Domain Calculation

Cálculos de negocio deberán residir en Domain.

---

# 177. Presentation Calculation

No deberá confundirse.

Ejemplo:

```text
format currency for UI
```

no pertenece al Domain.

---

# 178. Persistence Calculation

Tampoco necesariamente.

---

# 179. Derived Value

Puede calcularse desde Domain State.

---

# 180. Stored Derived Value

Deberá evitarse si puede producir inconsistencia, salvo motivo de Performance/History.

---

# 181. Historical Value

En algunos Domains deberá almacenarse para preservar la decisión original.

---

# 182. Current vs Historical

Deberán distinguirse.

Ejemplo:

```text
current product price
```

no necesariamente es:

```text
price used in an existing order
```

---

# 183. Snapshot Value

Un Aggregate puede necesitar capturar Value histórico.

---

# 184. Domain Time

Las reglas temporales deberán utilizar semántica explícita.

---

# 185. Instant

Representa punto absoluto en el tiempo.

---

# 186. Local Date

Representa fecha dentro de un Calendar/Timezone Context.

---

# 187. Duration

Representa intervalo.

---

# 188. Temporal Ambiguity

Deberá evitarse cuando el negocio dependa de ello.

---

# 189. Timezone Rule

Debe pertenecer al Domain cuando tenga significado de negocio.

---

# 190. Localization

Traducción de textos normalmente no pertenece al Domain.

---

# 191. Domain Message

Errores Domain deberán favorecer códigos/conceptos y no textos finales localizados.

---

# 192. Security

ENG-024 gobierna Security.

---

# 193. Domain Security Rule

Algunas reglas pueden representar negocio.

Ejemplo conceptual:

```text
Only account owner can close an account
```

puede involucrar tanto Domain como Authorization.

---

# 194. Separation

Deberá analizarse:

```text
Does the rule define business validity?
or
Does the rule define technical access authority?
```

---

# 195. No Framework Principal

Domain no debería depender de objeto `HttpUser`, `Session`, etc.

---

# 196. Actor

Podrá recibir un concepto Domain como:

```text
ActorId
AccountOwner
Approver
```

si forma parte de la regla.

---

# 197. Tenant

Si Tenant es concepto de negocio puede participar en Domain.

Si es aislamiento técnico, ENG-045 futuro deberá gobernarlo.

---

# 198. External Services

El Domain no deberá invocar directamente servicios remotos.

---

# 199. External Result

Application podrá obtener información externa y suministrarla al Domain.

---

# 200. Domain Port

En casos excepcionales el Domain podrá depender de un Contract abstracto.

---

# 201. Determinism Preference

Las reglas Domain deberían ser deterministas para los mismos Inputs cuando sea posible.

---

# 202. Hidden I/O

Deberá evitarse dentro de Domain Methods.

---

# 203. No Hidden Database Query

Una Entity no deberá realizar Query automáticamente.

---

# 204. No Hidden Network Call

Tampoco.

---

# 205. Pure Domain Function

Las operaciones puras deberán favorecerse cuando sea adecuado.

---

# 206. Side Effect Boundary

Los efectos externos deberán coordinarse en Application.

---

# 207. Domain Modeling Style

MEF no impondrá una única implementación de DDD.

---

# 208. Simple Domain

Un Domain sencillo podrá utilizar modelos simples.

---

# 209. Complex Domain

Un Domain complejo podrá utilizar:

```text
Aggregates
Value Objects
Policies
Specifications
Domain Events
```

---

# 210. No Pattern Quota

No deberá exigirse utilizar todos los Patterns.

---

# 211. Pattern Purpose

Cada Pattern deberá resolver una necesidad concreta.

---

# 212. Domain Complexity

La complejidad del código deberá ser proporcional a la complejidad real del negocio.

---

# 213. CRUD Domain

Un Module simple podrá no necesitar modelo rico.

---

# 214. Rich Domain

Deberá utilizarse cuando existan:

```text
complex rules
state transitions
interdependent invariants
business calculations
```

---

# 215. Domain Model Purity

No significa ausencia absoluta de Libraries.

Significa proteger Dependency Direction y Business Semantics.

---

# 216. Framework Annotations

Deberán evitarse cuando aten Domain fuertemente a Infrastructure.

---

# 217. Persistence Attributes

No deberán invadir Domain cuando existe separación razonable.

---

# 218. Serialization Attributes

Igualmente.

---

# 219. Domain Serialization

ENG-031 no deberá serializar Domain Objects automáticamente como Contracts externos.

---

# 220. Domain Persistence

ENG-030 podrá mapear Domain hacia Persistence Model.

---

# 221. Persistence Mapper

Conceptualmente:

```text
Aggregate
    │
    ▼
Persistence Mapper
    │
    ▼
Persistence Model
```

---

# 222. Rehydration Mapper

En sentido inverso deberá reconstruir un Aggregate válido.

---

# 223. Mapping Failure

Deberá considerarse Infrastructure/Data Failure, salvo que revele Domain State inválido.

---

# 224. Legacy Invalid Data

La estrategia deberá ser explícita.

---

# 225. Domain Evolution

Los modelos Domain evolucionarán con el negocio.

---

# 226. Refactoring

Cambiar internals no implica necesariamente Breaking Change.

---

# 227. Public Domain Contract

Si un Domain Type forma parte de Contract público deberá aplicarse Compatibility.

---

# 228. Internal Domain Type

Puede evolucionar libremente dentro de sus Tests/Contracts.

---

# 229. Invariant Evolution

Cambiar una regla de negocio puede requerir:

```text
data migration
API change
workflow change
compatibility analysis
```

---

# 230. Historical Data

Una nueva regla no deberá asumirse automáticamente válida para datos históricos.

---

# 231. Migration

ENG-030 deberá manejar cambios persistentes.

---

# 232. Domain Migration

Puede requerir transformación semántica de datos, no solo cambio de Schema.

---

# 233. Release

ENG-017 deberá documentar cambios Domain significativos cuando afecten Contracts.

---

# 234. Deprecation

Conceptos Domain públicos podrán seguir proceso de Deprecation.

---

# 235. Testing

ENG-009 gobernará Testing general.

---

# 236. Domain Unit Tests

Deberán ejecutarse sin Infrastructure cuando sea posible.

---

# 237. Entity Test

Deberá comprobar comportamiento e invariantes.

---

# 238. Value Object Test

Deberá comprobar:

```text
valid construction
invalid construction
equality
immutability
```

---

# 239. Aggregate Test

Deberá comprobar:

```text
business behavior
state transitions
invariants
domain events
```

---

# 240. Domain Service Test

Deberá probar reglas de negocio independientemente de Infrastructure.

---

# 241. Policy Test

Deberá probar decisiones.

---

# 242. Specification Test

Deberá probar criterios y composición.

---

# 243. Factory Test

Deberá comprobar que solo produzca objetos válidos.

---

# 244. Domain Event Test

Deberá verificar hechos producidos por operaciones relevantes.

---

# 245. Property-Based Testing

Será especialmente útil para:

```text
Value Objects
calculations
invariants
```

---

# 246. Invariant Test

Deberá intentar estados límite.

---

# 247. Mutation Testing

Podrá utilizarse para medir fuerza de Tests de reglas críticas.

---

# 248. Example-Based Testing

Seguirá siendo válido.

---

# 249. Persistence Integration Test

Pertenece principalmente a ENG-030.

---

# 250. Domain Test Does Not Need Database

Regla preferida:

```text
Domain Test
→ no database
```

salvo justificación excepcional.

---

# 251. Observability

El Domain deberá minimizar dependencia directa de Telemetry.

---

# 252. Domain Logging

No deberá llenar Entities con Logging Infrastructure.

---

# 253. Application Observation

ENG-034/ENG-025 podrán observar la ejecución alrededor del Domain.

---

# 254. Domain Event Telemetry

Podrá observarse externamente.

---

# 255. Domain Metrics

Algunas métricas de negocio podrán producirse desde Events/Results.

---

# 256. Business Metric ≠ Infrastructure Metric

Deberán diferenciarse.

---

# 257. Performance

ENG-026 gobernará Performance.

---

# 258. Domain Optimization

No deberá romper expresividad/invariantes por micro-optimizaciones no demostradas.

---

# 259. Aggregate Performance

Aggregate demasiado grande podrá revelar problema de Boundary.

---

# 260. Value Object Allocation

No deberá evitarse Value Objects únicamente por intuición de Performance.

---

# 261. Measure First

Se mantiene la regla de ENG-026.

---

# 262. Repository Performance

Pertenece a Persistence.

---

# 263. Query Model

Lecturas complejas no deberán forzar Domain Aggregate si no necesitan comportamiento Domain.

---

# 264. Read Model

Application podrá utilizar Projection/Read Model.

---

# 265. Domain vs Read Model

Deberán mantenerse separados.

---

# 266. Architecture Tests

Build podrá verificar Dependency Rules.

---

# 267. Forbidden Domain Dependency

Podrán prohibirse imports desde Domain hacia:

```text
Api
Transport
Persistence implementation
Framework HTTP
UI
```

---

# 268. Build Gate

ENG-012 podrá detectar violaciones estructurales.

---

# 269. Static Analysis

Podrá comprobar:

```text
Domain imports
public mutability
framework dependencies
repository direction
```

cuando el lenguaje lo permita.

---

# 270. Domain Registry

ENG-020 no deberá convertirse en mecanismo de descubrimiento interno de reglas Domain.

---

# 271. No Service Locator

Domain no deberá consultar Registry/Container para localizar Dependencies.

---

# 272. DI

ENG-018 podrá construir Domain Services cuando posean Dependencies abstractas.

---

# 273. Entity Construction via Container

Entities no deberán requerir Container para existir.

---

# 274. Value Object via Container

Tampoco.

---

# 275. Aggregate via Container

Tampoco como requisito ordinario.

---

# 276. Domain Service via Container

Podrá ser válido si Service posee Ports.

---

# 277. Runtime Independence

Domain Models deberán ser utilizables sin arrancar Runtime completo cuando sea posible.

---

# 278. Application Integration

ENG-034 será principal Consumer/orchestrator del Domain.

---

# 279. Application Flow

```text
Command
   │
   ▼
Handler
   │
   ▼
Repository
   │
   ▼
Aggregate
   │
   ▼
Domain Behavior
   │
   ▼
Domain Events
   │
   ▼
Application
```

---

# 280. API Integration

ENG-033 nunca deberá invocar Entities como sustituto de Application Layer.

---

# 281. Correct Flow

```text
API
 ↓
Application
 ↓
Domain
```

---

# 282. Incorrect Flow

```text
API Controller
 ↓
Entity setters
 ↓
ORM save
```

para Domains con reglas significativas.

---

# 283. Module Integration

Cada Module puede poseer su propio Domain Model.

---

# 284. Cross-Module Domain Access

Un Module no deberá importar Entities internas de otro Module.

---

# 285. Cross-Module Contract

Deberá utilizar ENG-021.

---

# 286. Cross-Module Event

O ENG-022 cuando corresponda.

---

# 287. Shared Kernel

Un conjunto muy pequeño de tipos Domain compartidos podrá existir si Architecture lo autoriza.

---

# 288. Shared Kernel Risk

Incrementa coupling.

---

# 289. Shared Kernel Rule

Deberá mantenerse:

```text
small
stable
jointly governed
```

---

# 290. Copying Concepts

En algunos Bounded Contexts puede ser preferible tener dos representaciones del mismo concepto real.

---

# 291. Model Independence

No deberá forzarse reutilización únicamente para evitar duplicación de código.

---

# 292. Anti-Corruption Layer

Cuando se integre con un modelo externo incompatible podrá utilizarse:

```text
Anti-Corruption Layer
```

---

# 293. ACL Purpose

Evitar que el modelo externo contamine el Domain interno.

---

# 294. External Model

Deberá mapearse.

```text
External Model
      │
      ▼
ACL / Mapper
      │
      ▼
Domain Model
```

---

# 295. Integration Engineering

ENG-044 futuro podrá especializar Anti-Corruption Layers e integración externa.

---

# 296. Domain Documentation

Conceptos significativos deberían documentarse.

---

# 297. Domain Glossary

Podrá mantener:

```text
term
meaning
context
synonyms
deprecated terms
```

---

# 298. Decision Documentation

Invariantes críticas deberían ser comprensibles en código y documentación.

---

# 299. Business Rule Traceability

Podrá existir vínculo entre:

```text
requirement
rule
code
test
```

---

# 300. Domain Diagram

Podrá documentarse:

```text
Entities
Value Objects
Aggregates
Relationships
Events
```

---

# 301. No Database Diagram as Domain Diagram

Un ERD no sustituye necesariamente el modelo Domain.

---

# 302. Domain Model Architecture

```text
                    DOMAIN
                      │
        ┌─────────────┼─────────────┐
        ▼             ▼             ▼
      Entity      Value Object    Service
        │             │             │
        └─────────────┼─────────────┘
                      ▼
                   Aggregate
                      │
            ┌─────────┼─────────┐
            ▼         ▼         ▼
       Invariants   Events    Policies
```

---

# 303. Aggregate Architecture

```text
                AGGREGATE ROOT
                      │
             ┌────────┼────────┐
             ▼        ▼        ▼
          Entity   Entity   Value Object
             │        │        │
             └────────┼────────┘
                      ▼
                  Invariants
```

Acceso externo:

```text
Consumer
   │
   ▼
Aggregate Root
```

y no:

```text
Consumer
   ↓
Internal Entity
```

---

# 304. Application/Domain Architecture

```text
                APPLICATION
                     │
                     ▼
                 USE CASE
                     │
                     ▼
                  DOMAIN
              ┌──────┼──────┐
              ▼      ▼      ▼
           Entity  Service Policy
              │      │      │
              └──────┼──────┘
                     ▼
               Domain Result
```

---

# 305. Persistence Architecture

```text
              DOMAIN
                │
                ▼
        Repository Contract
                ▲
                │ implements
                │
        Persistence Adapter
                │
                ▼
            Database
```

---

# 306. Event Architecture

```text
Domain Behavior
      │
      ▼
Domain Event
      │
      ▼
Application
      │
      ▼
Integration Mapping
      │
      ▼
Event Bus
```

---

# 307. Boundary Architecture

```text
┌──────────────── MOD-A ────────────────┐
│                                       │
│  Domain                               │
│  ├── Entities                         │
│  ├── Value Objects                    │
│  ├── Aggregates                       │
│  └── Domain Services                  │
│                                       │
│          Public Contract ──────────────┼────► MOD-B
│                                       │
└───────────────────────────────────────┘
```

MOD-B no deberá acceder a los internals del Domain de MOD-A.

---

# 308. First Implementation Components

La primera implementación deberá reconocer conceptualmente:

```text
Entity
EntityId

ValueObject

Aggregate
AggregateRoot

DomainService

DomainEvent

DomainFactory

Specification
DomainPolicy

DomainError
DomainInvariantViolation

Repository Contract
```

---

# 309. Base Classes

MEF no deberá exigir que todos los Domain Objects hereden de clases pesadas.

---

# 310. Marker Interfaces

Podrán utilizarse cuando aporten Tooling/claridad.

---

# 311. Entity Base Class

Podrá existir opcionalmente.

No deberá imponer Infrastructure.

---

# 312. ValueObject Base Class

También podrá existir opcionalmente.

---

# 313. AggregateRoot Base Class

Podrá facilitar Domain Event recording.

---

# 314. Minimalism

Las abstracciones base deberán permanecer pequeñas.

---

# 315. Conceptual Directory Structure

```text
src/
└── Domain/
    ├── Model/
    │   ├── Entity
    │   ├── EntityId
    │   ├── ValueObject
    │   ├── Aggregate
    │   └── AggregateRoot
    │
    ├── Service/
    │   └── DomainService
    │
    ├── Event/
    │   └── DomainEvent
    │
    ├── Factory/
    │   └── DomainFactory
    │
    ├── Specification/
    │   └── Specification
    │
    ├── Policy/
    │   └── DomainPolicy
    │
    ├── Repository/
    │   └── Repository
    │
    └── Error/
        ├── DomainError
        └── DomainInvariantViolation
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 316. Module Domain Structure

Un Module podrá organizar:

```text
Modules/
└── Customer/
    ├── Domain/
    ├── Application/
    ├── Infrastructure/
    └── Api/
```

si ENG-006 determina dicha convención.

---

# 317. Dependency Direction

Dentro de un Module:

```text
Api
  ↓
Application
  ↓
Domain
```

Infrastructure deberá implementar Ports definidos hacia adentro.

---

# 318. Domain Has No Outer Dependency

La regla ideal será:

```text
Domain
→ depends inward on itself
```

y no hacia Layers externas.

---

# 319. Domain Quality Characteristics

Un Domain Model saludable debería favorecer:

```text
expressiveness
cohesion
explicit invariants
controlled mutation
technology independence
testability
clear boundaries
```

---

# 320. Domain Smells

Podrán indicar problemas:

```text
entities with only getters/setters
business rules in controllers
SQL inside domain objects
HTTP calls inside entities
public mutable collections
one global domain model
huge aggregates
stringly typed states
```

---

# 321. First Implementation Constraints

La primera versión deberá favorecer:

```text
Explicit Domain Boundaries
Entities with Identity
Immutable Value Objects
Aggregate Roots
Explicit Invariants
Domain Services only when needed
Domain Events
Factories for complex creation
Repository Contracts
Technology-independent Domain
Domain Unit Testing
```

---

# 322. First Version Non-Goals

No deberá requerir:

```text
Event Sourcing
Full CQRS
Every DDD tactical pattern
Distributed Aggregates
Global Enterprise Domain Model
Dynamic Domain Models
Runtime-generated Entities
Universal Specification Engine
```

---

# 323. Second Phase

Podrá incorporar:

```text
Shared Kernel Governance
Advanced Specifications
Domain Policy Registry
Domain Model Tooling
Invariant Static Analysis
Domain Documentation Generation
```

---

# 324. Third Phase

Solo cuando exista necesidad:

```text
Event-Sourced Aggregates
Temporal Domain Models
Complex Process Models
Distributed Domain Coordination
Advanced Rule Engines
```

---

# 325. Invariantes de Ingeniería

ENG-035 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-646 | El Domain deberá representar reglas y conceptos de negocio sin depender innecesariamente de API, Transport, Persistence o Framework Infrastructure. |
| EI-647 | Domain, Application, API y Persistence Models deberán conservar responsabilidades y ciclos de evolución distinguibles. |
| EI-648 | Una Entity deberá preservar una identidad estable durante su Lifetime lógico dentro del Context correspondiente. |
| EI-649 | Las transiciones significativas de Entity deberán favorecer comportamiento explícito sobre mutación arbitraria de propiedades. |
| EI-650 | Los Value Objects deberán definirse por sus valores y favorecer inmutabilidad cuando su semántica lo permita. |
| EI-651 | Un Aggregate deberá poseer una raíz identificable responsable de preservar sus invariantes internas. |
| EI-652 | Consumers externos no deberán modificar directamente Entities internas de un Aggregate fuera de su Aggregate Root. |
| EI-653 | Los Aggregate Boundaries deberán seleccionarse conforme a necesidades reales de consistencia y no por conveniencia de Object Graph o Database. |
| EI-654 | Las Domain Invariants deberán protegerse dentro de la Boundary que posee la regla y no depender exclusivamente de UI, API o Persistence Validation. |
| EI-655 | Domain Errors deberán permanecer distinguibles de Infrastructure Errors y Public API Errors. |
| EI-656 | Domain Services deberán representar comportamiento de negocio y no utilizarse como contenedores indiscriminados de lógica que pertenece a Entities o Value Objects. |
| EI-657 | Domain Events deberán representar hechos ocurridos y mantenerse conceptualmente separados de Commands e Integration Events. |
| EI-658 | La publicación de Domain Events hacia infraestructura externa deberá coordinarse fuera del Domain Model. |
| EI-659 | Specifications y Policies deberán expresar conceptos del Domain y no convertirse en APIs disfrazadas de Infrastructure. |
| EI-660 | Repository Contracts deberán preservar lenguaje y Boundaries del Domain sin exponer ORM, SQL o almacenamiento concreto. |
| EI-661 | Domain Objects no deberán utilizar Registry, Service Container o Runtime como Service Locator. |
| EI-662 | Una regla Domain dependiente del tiempo, identidad o información externa deberá recibir el Context necesario de forma explícita y testeable. |
| EI-663 | Cross-Module Domain collaboration deberá realizarse mediante Contracts o Events gobernados y no mediante acceso directo a internals de otro Module. |
| EI-664 | Domain Unit Tests deberán poder ejecutarse sin Infrastructure externa cuando la naturaleza de la regla lo permita. |
| EI-665 | La primera implementación deberá favorecer modelos Domain explícitos y proporcionales a la complejidad real del negocio antes de introducir patrones avanzados como Event Sourcing o Rule Engines. |

---

# 326. Continuidad de Invariantes

```text
ENG-031 → EI-566 a EI-585
ENG-032 → EI-586 a EI-605
ENG-033 → EI-606 a EI-625
ENG-034 → EI-626 a EI-645
ENG-035 → EI-646 a EI-665
```

---

# 327. Criterios de Conformidad

Una implementación será conforme con ENG-035 cuando:

- mantenga Domain independiente de Infrastructure concreta;
- defina Boundaries de Domain;
- utilice lenguaje consistente;
- diferencie Entity y Value Object;
- preserve Entity Identity;
- preserve Value Equality;
- permita Aggregates;
- defina Aggregate Root;
- proteja Aggregate internals;
- preserve Domain Invariants;
- permita Domain Services;
- permita Domain Events;
- distinga Commands y Events;
- distinga Domain e Integration Events;
- permita Factories;
- permita Specifications;
- permita Domain Policies;
- utilice Repository Contracts;
- no exponga ORM al Domain;
- no utilice Container como Service Locator;
- mantenga Cross-Module isolation;
- permita Domain Testing sin Infrastructure;
- integre Application correctamente;
- preserve Compatibility cuando Domain Types sean públicos.

---

# 328. Riesgos

Deberán evitarse especialmente:

## Anemic Domain Model

Entities contienen únicamente getters/setters y todas las reglas viven fuera.

## Fat Domain Service

Todo comportamiento termina en Services genéricos.

## Database-Driven Domain

Tables determinan el Domain Model.

## ORM Entity as Domain

El Domain queda subordinado al ORM.

## API DTO as Domain Entity

Boundary externa define el modelo interno.

## Public Setters

Invariantes pueden romperse desde cualquier componente.

## Giant Aggregate

Todo el Module forma una única unidad transaccional.

## Aggregate per Table

Database Schema determina los Aggregates.

## Hidden I/O

Entities realizan Database/Network Calls.

## Domain Service Locator

Domain consulta Container/Registry.

## Primitive Obsession

Conceptos importantes se representan con Primitives sin semántica.

## Value Object Explosion

Todo Primitive se convierte artificialmente en clase.

## Domain Event Equals Integration Event

Internals se convierten accidentalmente en Contracts públicos.

## Command Equals Event

Intención y hecho se confunden.

## Repository as ORM Wrapper

Domain conoce Query Builder/ORM.

## Specification as SQL

Reglas Domain se acoplan al almacenamiento.

## Global Enterprise Model

Todos los Bounded Contexts deben compartir las mismas Entities.

## Pattern Cargo Cult

Se utilizan todos los Patterns de DDD aunque no exista necesidad.

---

# 329. Relación con ENG-015

ENG-015 gobierna State Machine arquitectónica de MEF.

ENG-035 podrá modelar State Machines propias del negocio.

Nunca deberán confundirse:

```text
Runtime State
≠
Domain State
```

---

# 330. Relación con ENG-018

Dependency Injection podrá suministrar Dependencies a Domain Services.

Entities, Value Objects y Aggregates no deberán depender del Container.

---

# 331. Relación con ENG-019

Service Container podrá construir Domain Services.

No deberá gobernar comportamiento de Entities.

---

# 332. Relación con ENG-020

Registry no deberá convertirse en catálogo de objetos de negocio ni Service Locator del Domain.

---

# 333. Relación con ENG-021

Cross-Module Domain interaction deberá utilizar Contracts cuando exista dependencia síncrona.

---

# 334. Relación con ENG-022

Event Bus podrá transportar Events externos derivados de Domain Events.

---

# 335. Relación con ENG-023

Error Handling proporciona mecanismos generales para transportar/traducir Domain Errors fuera de su Boundary.

---

# 336. Relación con ENG-024

Security gobierna autorización técnica.

Domain gobierna reglas de negocio.

Algunas reglas podrán requerir colaboración explícita entre ambas capas.

---

# 337. Relación con ENG-025

Observability deberá envolver ejecución Domain principalmente desde Application/Runtime sin contaminar Entities con Telemetry Infrastructure.

---

# 338. Relación con ENG-026

Performance Engineering deberá medir antes de comprometer expresividad o invariantes del Domain.

---

# 339. Relación con ENG-027

Runtime construye Application/Infrastructure necesarias para ejecutar Domain, pero Domain no deberá depender de Runtime.

---

# 340. Relación con ENG-028

Cada Module podrá poseer su Domain Boundary.

Los internals Domain de un Module permanecen privados salvo Contracts explícitos.

---

# 341. Relación con ENG-030

Persistence deberá implementar Repository Contracts y mapear Domain Objects sin convertir Persistence Model en Domain Model automáticamente.

---

# 342. Relación con ENG-031

Serialization no deberá utilizar Domain Objects como Wire Contracts por defecto.

---

# 343. Relación con ENG-032

Transport permanece completamente fuera del Domain ordinario.

---

# 344. Relación con ENG-033

API adapta Consumers hacia Application.

No deberá manipular Domain Entities directamente como mecanismo principal.

---

# 345. Relación con ENG-034

Esta es la Boundary principal:

```text
ENG-034
Application Engineering
        │
        │ orchestrates
        ▼
ENG-035
Domain Engineering
```

Application pregunta al Domain:

```text
What should happen?
```

El Domain responde según:

```text
business rules
state
invariants
policies
```

---

# 346. Relación con ENG-036

ENG-036 — Validation Engineering deberá formalizar las distintas clases de Validation:

```text
Structural Validation
Boundary Validation
Application Preconditions
Domain Validation
Schema Validation
Security Validation
```

sin trasladar las invariantes de ENG-035 fuera del Domain.

---

# 347. Principio Rector

> **El Domain de MEF deberá expresar el negocio en sus propios términos: Entities deberán proteger identidad y comportamiento, Value Objects deberán proteger significado, Aggregates deberán proteger consistencia y el conjunto del modelo deberá permanecer independiente de cómo los datos se almacenan, transportan o presentan.**

---

# 348. Conclusión

**ENG-035 — Domain Engineering** formaliza el núcleo semántico de las Applications construidas sobre MEF.

La arquitectura queda:

```text
                    DOMAIN
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
       Entity     Value Object   Domain Service
          │            │            │
          └────────────┼────────────┘
                       ▼
                   Aggregate
                       │
          ┌────────────┼────────────┐
          ▼            ▼            ▼
      Invariants     Events       Policies
```

La cadena completa de ejecución queda:

```text
Consumer
   │
   ▼
API / CLI / Event
   │
   ▼
Application
   │
   ▼
Domain
   │
   ├── Entity
   ├── Value Object
   ├── Aggregate
   ├── Service
   ├── Policy
   ├── Specification
   └── Domain Event
   │
   ▼
Application
   │
   ▼
Ports
   │
   ▼
Infrastructure
```

La dirección de dependencias deberá mantenerse:

```text
Presentation / API
        ↓
Application
        ↓
Domain
```

mientras:

```text
Infrastructure
       │
       │ implements
       ▼
Domain / Application Ports
```

La separación conceptual queda:

```text
Entity
→ identity + behavior

Value Object
→ value + meaning

Aggregate
→ consistency boundary

Aggregate Root
→ access boundary

Invariant
→ valid-state rule

Domain Service
→ business behavior without natural Entity owner

Factory
→ valid construction

Specification
→ business criterion

Policy
→ business decision strategy

Domain Event
→ business fact

Repository
→ persistence abstraction
```

MEF evita con ello una arquitectura basada en:

```text
Database Table
     ↓
ORM Entity
     ↓
Getters / Setters
     ↓
Controller Logic
```

y establece:

```text
Business Language
       ↓
Domain Model
       ↓
Explicit Behavior
       ↓
Protected Invariants
       ↓
Application Use Cases
```

La primera implementación deberá concentrarse en:

```text
Entities
Value Objects
Aggregate Roots
Invariants
Domain Services
Domain Events
Factories
Repository Contracts
Domain Errors
Domain Unit Tests
```

sin exigir innecesariamente:

```text
Event Sourcing
Full CQRS
Rule Engines
Every DDD Pattern
Distributed Aggregates
```

Con **ENG-035** la serie global alcanza:

```text
EI-665
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
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
- ENG-036 — Validation Engineering