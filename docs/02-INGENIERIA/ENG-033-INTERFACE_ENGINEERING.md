---
id: ENG-033
titulo: Interface Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Interface Engineering
estado: Accepted
version: 1.1.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11dependencias:

ENG-005

ENG-014

ENG-015

ENG-016

ENG-019

ENG-020

ENG-021

ENG-023

ENG-024

ENG-025

ENG-027

ENG-028

ENG-031

ENG-032relacionados:

ENG-003

ENG-006

ENG-007

ENG-009

ENG-010

ENG-011

ENG-012

ENG-013

ENG-017

ENG-022

ENG-026

ENG-029

ENG-030

ENG-034

ENG-044

ENG-070keywords:

interface

interface-contract

operation

boundary

adapter

request

response

input-contract

output-contract

error-contract

mapping

versioning

compatibility

deprecation

discovery

security

observability

documentation

testing

mef

ENG-033

Interface Engineering

Estado

Accepted.

1. Propósito

Definir el modelo de Interface Engineering de MEF (Modular Enterprise Framework).

ENG-033 establece las reglas arquitectónicas para diseñar, publicar, evolucionar y consumir Interfaces contractuales entre:

Modules
Components
Processes
Applications
Adapters
Consumers

Una Interface define qué capacidades pueden invocarse y bajo qué Contract, sin quedar acoplada al Transport, Protocol, Serialization o implementación interna utilizada para materializar dicha interacción.

ENG-033 constituye la base contractual de Interface sobre la cual disciplinas especializadas —incluyendo ENG-044 — API Engineering— podrán definir mecanismos concretos de exposición.

ENG-033 establece reglas para:

Interface
Interface Boundary
Interface Contract
Public Interface
Internal Interface
Operation
Operation Identity
Input Contract
Output Contract
Error Contract
Interface Adapter
Handler
Input Mapping
Output Mapping
Boundary Validation
Interface Versioning
Compatibility
Deprecation
Interface Lifecycle
Interface Discovery
Interface Registry
Security Requirements
Observability Requirements
Performance Requirements
Documentation
Contract Testing

2. Declaración

La regla fundamental será:

Toda Interface publicada por MEF deberá constituir un Contract explícito, versionable, validable, observable y protegido, independiente de la representación interna de Application, Domain, Persistence, Serialization, Transport y Protocol.

Arquitectura conceptual:

Consumer
   │
   ▼
Interface Boundary
   │
   ▼
Input Contract
   │
   ▼
Boundary Validation
   │
   ▼
Input Mapper
   │
   ▼
Application
   │
   ▼
Output Mapper
   │
   ▼
Output Contract
   │
   ▼
Interface Adapter
   │
   ▼
Transport / Protocol

3. Interface

Una Interface representa una Boundary contractual mediante la cual un Consumer interactúa con capacidades de MEF.

4. Interface Boundary

Todo dato que cruce una Interface deberá considerarse contractual.

5. Public Interface

Una Public Interface es aquella cuyo Contract puede ser consumido fuera del componente que lo implementa.

6. Internal Interface

Una Internal Interface podrá tener menor alcance, pero deberá mantener Contracts explícitos cuando cruce Modules, Components o Processes.

7. Interface ≠ Transport

Deberán mantenerse separados:

Interface
→ operations and semantics

Transport
→ communication mechanism

ENG-032 será autoridad sobre Transport Engineering.

8. Interface ≠ Protocol

Una Interface no deberá definirse exclusivamente como:

HTTP
REST
gRPC
GraphQL
CLI
Message Transport

Estos son mecanismos o estilos mediante los cuales una Interface podrá exponerse.

9. Interface ≠ Serialization

ENG-031 Serialization
→ representation encoding

ENG-033 Interface
→ contractual semantics

10. Interface ≠ Adapter

Un Adapter materializa una Interface para un mecanismo concreto.

La Interface es el Contract.

11. Interface ≠ Domain Model

No deberá exponerse automáticamente un Domain Object como Interface Contract.

12. Interface ≠ Persistence Model

Una Entity de Persistence no deberá convertirse automáticamente en Input u Output contractual.

13. Interface Contract

Un Interface Contract define al menos:

operation
input
output
errors
security requirements
compatibility expectations
lifecycle

14. Contract Authority

ENG-021 será autoridad general sobre Contracts.

ENG-033 especializa Contracts de Interface.

15. Operation

Una Operation representa una capacidad invocable a través de una Interface.

Ejemplos conceptuales:

CreateCustomer
GetCustomer
UpdateCustomer
ListCustomers
DeleteCustomer

16. Operation Identity

Toda Operation publicada deberá poseer identidad estable.

17. Operation ID

Podrá utilizarse:

customer.create
customer.get
customer.update
customer.list
customer.delete

18. Operation ID ≠ Route

No deberán confundirse.

Operation ID
→ logical identity

Route / Topic / Command Name
→ adapter or transport mapping

19. Adapter Mapping

La relación entre Operation y mecanismo de exposición deberá ser explícita y determinista.

20. Duplicate Mapping

No deberá permitirse ambigüedad en la resolución de una Operation.

21. Interface Adapter

Un Interface Adapter conecta una Interface contractual con Transport, Protocol o mecanismo de invocación concreto.

22. Adapter Responsibility

Deberá limitarse principalmente a:

receive
parse
validate boundary
map
invoke
map result
encode / return

23. Thin Adapter

MEF deberá favorecer Adapters delgados.

24. Adapter Anti-Pattern

Un Adapter no deberá concentrar:

business rules
SQL
transactions
domain calculations
unbounded orchestration

25. Handler

Un Handler podrá representar la unidad que procesa una Operation.

26. Adapter ≠ Handler

Podrán separarse:

Adapter
→ boundary / protocol adaptation

Handler
→ application operation execution

27. Input Contract

Representa Input contractual aceptado por una Operation.

28. Input Contract Definition

Deberá definir:

fields
types
requiredness
constraints
semantics

29. Input DTO

Podrá utilizarse un DTO explícito.

30. DTO ≠ Domain Entity

El DTO pertenece a la Boundary.

31. Input Mapping

Conceptualmente:

Interface Input
      │
      ▼
Input DTO
      │
      ▼
Mapper
      │
      ▼
Application Command / Query

32. Output Contract

Representa Output contractual producido por una Operation.

33. Output DTO

Deberá poder evolucionar independientemente del Domain Model.

34. Output Mapping

Conceptualmente:

Application Result
       │
       ▼
Output Mapper
       │
       ▼
Output DTO
       │
       ▼
Interface Adapter

35. No Entity Exposure

No deberá utilizarse como comportamiento por defecto:

return $entity;

36. Entity Exposure Risk

Puede exponer:

internal IDs
private state
lazy relations
security fields
persistence metadata
implementation details

37. Boundary Validation

Todo Input externo deberá validarse antes de alcanzar componentes que lo consideren confiable.

38. Validation Layers

Deberán distinguirse:

Structural Validation
Semantic Validation
Business Validation
Authorization

39. Structural Validation

Comprueba:

required fields
types
formats
length
shape

40. Semantic Validation

Comprueba significado básico del dato en el Contract.

41. Business Validation

Pertenece a Application/Domain según la regla.

42. Validation ≠ Authorization

Un Input válido no implica permiso para ejecutar una Operation.

43. Unknown Fields

La Policy deberá ser explícita y consistente con ENG-031 y ENG-036.

44. Invalid Input

Deberá producir Error contractual.

45. Error Mapping

ENG-023 será autoridad general sobre Error Handling.

ENG-033 deberá traducir errores internos a errores de Interface estables.

46. Internal Error ≠ Interface Error

No deberán ser equivalentes automáticamente.

47. Interface Error

Conceptualmente:

InterfaceError
├── code
├── message
├── details
├── correlationId
└── metadata

48. Stable Error Code

Consumers deberán poder depender de un código estable cuando corresponda.

49. Error Message

No deberá utilizarse como identificador programático.

50. Internal Stack Trace

Nunca deberá formar parte de Output público ordinario.

51. Exception Class

No deberá exponerse como parte del Contract.

52. Error Namespace

ENG-033 utilizará:

MEF-INTERFACE-xxx

53. Taxonomía ENG-033

MEF-INTERFACE-001 Interface configuration invalid
MEF-INTERFACE-002 Interface not found
MEF-INTERFACE-003 Operation not found
MEF-INTERFACE-004 Operation mapping conflict
MEF-INTERFACE-005 Invalid input
MEF-INTERFACE-006 Required field missing
MEF-INTERFACE-007 Invalid field
MEF-INTERFACE-008 Unsupported interface version
MEF-INTERFACE-009 Unsupported representation
MEF-INTERFACE-010 Interface contract invalid
MEF-INTERFACE-011 Interface compatibility violation
MEF-INTERFACE-012 Interface deprecated
MEF-INTERFACE-013 Interface retired
MEF-INTERFACE-014 Error mapping failed
MEF-INTERFACE-015 Interface security requirement failed
MEF-INTERFACE-016 Interface registration failed
MEF-INTERFACE-017 Interface activation failed
MEF-INTERFACE-018 Interface discovery failed
MEF-INTERFACE-019 Interface documentation drift
MEF-INTERFACE-020 Interface invariant violated

54. Collection Operations

Operations que produzcan colecciones potencialmente grandes deberán declarar mecanismos de bounded access.

55. Pagination Semantics

ENG-033 define la necesidad contractual de limitar resultados.

La materialización específica de Pagination para APIs públicas será gobernada por ENG-044.

56. Filtering Semantics

Una Interface podrá declarar capacidades explícitas de Filtering.

No deberá traducirse Input arbitrario a Query Languages internos.

57. Sorting Semantics

Sorting deberá limitarse a capacidades contractualmente publicadas.

58. Search Semantics

Search deberá tratarse como capacidad explícita y distinta de Filtering.

59. Field Selection

Podrá declararse cuando aporte valor, pero solo sobre Fields públicos.

La forma concreta de exposición será responsabilidad de la disciplina especializada.

60. Expansion

Una Interface podrá declarar relaciones expandibles de manera limitada.

Recursive Expansion no deberá ser ilimitada.

61. Interface Versioning

ENG-014 gobierna Versioning general.

ENG-033 define Versioning de Interfaces contractuales.

62. Interface Version

Deberá identificar cambios contractuales incompatibles cuando sea necesario.

63. Versioning Mechanism ≠ Version Semantics

No deberán confundirse.

La forma concreta de transportar una versión pertenece al Adapter/API correspondiente.

64. Compatible Change

Podrá incluir:

adding optional output field
adding optional input capability
new operation
new error metadata

cuando el Contract lo permita.

65. Breaking Change

Podrá incluir:

removing field
renaming field
changing field meaning
changing requiredness
changing field type
removing operation
changing operation semantics

66. Semantic Breaking Change

Cambiar significado sin cambiar estructura continúa siendo Breaking.

67. Version Proliferation

No deberá crearse una nueva versión para todo cambio compatible.

68. Parallel Versions

Podrán coexistir durante Migration.

69. Version Isolation

Una versión nueva no deberá alterar silenciosamente el comportamiento de una anterior.

70. Deprecation

Una Interface, Operation o Field podrá declararse Deprecated.

71. Deprecation Metadata

Deberá poder indicar:

deprecatedSince
replacement
sunset
reason

72. Deprecation ≠ Removal

Son estados distintos.

73. Interface Lifecycle

Conceptualmente:

Experimental
    ↓
Stable
    ↓
Deprecated
    ↓
Retired

74. Lifecycle Authority

Deberá alinearse con ENG-015 y ENG-017.

75. Stable Interface

Deberá someterse a Compatibility Gates.

76. Security

ENG-024 será autoridad general.

Una Interface deberá declarar Security Requirements suficientes para que los Adapters y Consumers conozcan las condiciones de uso.

77. Authentication Requirement

Una Interface podrá requerir identidad autenticada.

78. Authorization Requirement

Cada Operation deberá poder declarar Authorization Requirements.

79. Authorization Scope

Podrá considerar:

principal
tenant
resource
operation
context

80. Object-Level Authorization

No deberá asumirse resuelta únicamente porque el Caller pueda alcanzar el Adapter.

81. Field-Level Authorization

Algunos Fields podrán requerir permisos adicionales.

82. Over-Posting

Input externo no deberá modificar propiedades fuera del Contract.

83. Mass Assignment

No deberá mapearse Input arbitrariamente a Entities.

84. Input Trust

Todo Input externo se considerará no confiable hasta completar controles de Boundary.

85. Output Security

Outputs deberán filtrar Data sensible no perteneciente al Contract.

86. Observability

ENG-025 gobernará Telemetry.

87. Interface Metrics

Podrán incluir:

mef.interface.invocations.total
mef.interface.failures.total
mef.interface.duration
mef.interface.inflight

88. Metric Dimensions

Podrán incluir:

interface
operation
version
result

con Cardinality controlada.

89. Dynamic Identifiers

IDs dinámicos no deberán utilizarse indiscriminadamente como Metric Labels.

90. Correlation

Toda invocación deberá poder correlacionarse con Logs/Traces cuando corresponda.

91. Payload Logging

No deberá habilitarse por defecto.

92. Sensitive Input

Deberá redactarse en Telemetry.

93. Performance Requirements

ENG-070 será autoridad sobre Performance Engineering general.

ENG-033 podrá declarar Performance Requirements por Interface/Operation.

ENG-026 — Runtime Performance Engineering será relevante únicamente para medir overhead introducido por el Framework/Runtime durante resolución, mapping o dispatch.

94. Interface Performance

Podrá considerar:

latency
throughput
mapping cost
serialization cost
transport cost
application cost
payload size

sin redefinir el modelo general de ENG-070.

95. Concurrency Semantics

Una Interface podrá exponer Tokens o precondiciones contractuales de Concurrency cuando el Use Case lo requiera.

La materialización mediante ETag u otros mecanismos específicos pertenece a ENG-044/Adapters correspondientes.

96. Idempotency Semantics

Una Operation deberá declarar semántica idempotente cuando la repetición pueda producir efectos relevantes.

El mecanismo concreto de transporte —por ejemplo Idempotency Keys HTTP— pertenece a ENG-044.

97. Bulk Operations

Podrán existir y deberán declarar:

size limit
atomicity
partial success semantics
error contract

98. Batch ≠ Transaction

No deberán confundirse.

99. Long-Running Operation

Una Interface no deberá exigir que todo trabajo se complete dentro de una interacción síncrona.

100. Async Operation

Podrá exponer una operación durable o identificable mediante Contract especializado.

101. Documentation

Toda Interface pública Stable deberá ser documentable desde su Contract.

102. Interface Documentation

Deberá incluir cuando corresponda:

operations
inputs
outputs
errors
security
version
examples
deprecation

103. Generated Documentation

Podrá generarse desde Metadata/Contracts.

104. Documentation Drift

No deberá divergir silenciosamente de la fuente contractual canónica.

105. Specification

Una Interface podrá generar Specification interoperable.

El formato concreto —por ejemplo OpenAPI para HTTP APIs— será gobernado por ENG-044.

106. Source of Truth

Deberá existir una fuente contractual canónica.

No deberán coexistir múltiples fuentes editables divergentes.

107. Contract-First

Podrá utilizarse.

108. Code-First

También podrá utilizarse si genera Contract determinista y verificable.

109. Consumer Compatibility

Cambios de Interface deberán evaluarse contra Consumers soportados.

110. Testing

ENG-009 gobernará Testing general.

111. Interface Unit Test

Deberá probar Mapping, Validation y Error Translation.

112. Interface Contract Test

Deberá comprobar:

input schema
output schema
error schema
operation metadata

113. Integration Test

Deberá comprobar Adapter + Application Integration cuando exista Adapter concreto.

114. Security Test

Deberá probar:

authentication requirements
authorization requirements
tenant isolation
over-posting
sensitive fields

115. Compatibility Test

Deberá comparar Interface Versions/Releases.

116. Golden Contract

Podrá almacenarse Snapshot de Contract/Specification.

117. Build Integration

ENG-012 podrá validar Interfaces.

118. Build Gate

Podrá fallar por:

duplicate operation ID
ambiguous adapter mapping
invalid schema
missing authorization metadata
breaking interface change
documentation mismatch

119. Interface Linting

Podrá aplicar reglas arquitectónicas.

120. Release Integration

ENG-017 deberá considerar Public Interface Changes.

121. Release Notes

Deberán identificar cuando corresponda:

new operations
deprecated operations
breaking changes
migration instructions

122. Registry Integration

ENG-020 podrá registrar:

Interfaces
Operations
Versions
Owners
Schemas
Security Requirements
Adapter Bindings

123. Interface Registry Entry

Conceptualmente:

InterfaceEntry
├── id
├── version
├── owner
├── lifecycle
├── operations
├── adapters
└── specification

124. Operation Registry Entry

Conceptualmente:

InterfaceOperationEntry
├── operationId
├── interface
├── version
├── inputSchema
├── outputSchema
├── errors
└── security

125. Module Integration

ENG-028 podrá permitir que Modules publiquen Interfaces.

126. Interface Ownership

Toda Interface deberá pertenecer a un Module/Subsystem identificable.

127. Module Disable

No deberá dejar Operations o Adapter Bindings huérfanos.

128. Extension Integration

ENG-029 podrá extender Interfaces mediante Extension Points gobernados.

129. Extension Safety

Una Extension no deberá sobrescribir arbitrariamente una Operation existente.

130. Runtime Integration

ENG-027 gobernará Registration, Activation y Shutdown.

131. Interface Bootstrap

Conceptualmente:

Discover Interface Definitions
          ↓
Validate Contracts
          ↓
Register Operations
          ↓
Register Adapter Bindings
          ↓
Apply Security Requirements
          ↓
Activate Interface

132. Activation

Una Interface no deberá aceptar invocaciones antes de completar validación obligatoria.

133. CLI Integration

ENG-007 podrá incorporar:

mef interface list
mef interface inspect
mef interface validate
mef interface compatibility
mef interface specification

134. interface list

Podrá mostrar:

Interface
Version
Lifecycle
Owner
Operations

135. interface inspect

Podrá mostrar:

operations
schemas
security
adapters
deprecation

136. First Implementation Components

La primera implementación deberá incluir conceptualmente:

InterfaceDefinition
InterfaceId
InterfaceVersion
InterfaceOperation
OperationId

InputContract
OutputContract
ErrorContract

InterfaceAdapter
OperationHandler

InputMapper
OutputMapper
InterfaceErrorMapper

InterfaceValidator
InterfaceRegistry
InterfaceLifecycle

137. Optional Initial Components

Podrán incorporarse:

FieldSelectionContract
CollectionContract
BulkOperationContract
LongRunningOperationContract
InterfaceSpecificationGenerator

cuando exista necesidad.

138. Conceptual Directory Structure

src/
└── Interface/
    ├── Contract/
    │   ├── InterfaceDefinition
    │   ├── InterfaceOperation
    │   ├── InputContract
    │   ├── OutputContract
    │   └── ErrorContract
    │
    ├── Identity/
    │   ├── InterfaceId
    │   ├── InterfaceVersion
    │   └── OperationId
    │
    ├── Adapter/
    │   └── InterfaceAdapter
    │
    ├── Handler/
    │   └── OperationHandler
    │
    ├── Mapping/
    │   ├── InputMapper
    │   ├── OutputMapper
    │   └── InterfaceErrorMapper
    │
    ├── Validation/
    │   └── InterfaceValidator
    │
    ├── Registry/
    │   └── InterfaceRegistry
    │
    └── Lifecycle/
        └── InterfaceLifecycle

La estructura física definitiva deberá obedecer ENG-006.

139. Interface Architecture

                     CONSUMER
                        │
                        ▼
                   INTERFACE
                        │
                        ▼
                 INPUT CONTRACT
                        │
                        ▼
                    VALIDATION
                        │
                        ▼
                  INPUT MAPPER
                        │
                        ▼
                    APPLICATION
                        │
                        ▼
                  OUTPUT MAPPER
                        │
                        ▼
                 OUTPUT CONTRACT
                        │
                        ▼
                INTERFACE ADAPTER
                        │
                        ▼
              SERIALIZATION/TRANSPORT

140. Contract Separation

Interface DTO
     │
     ▼
Mapper
     │
     ▼
Application Model
     │
     ▼
Domain Model

Nunca deberá asumirse:

Interface DTO
=
Domain Entity
=
Persistence Entity

141. First Implementation Constraints

La primera versión deberá favorecer:

Explicit Interface Contracts
Explicit Operation IDs
Explicit Input/Output DTOs
Thin Adapters
Boundary Validation
Error Mapping
Interface Versioning
Deprecation Metadata
Security Requirements
Interface Registry
Contract Testing
Specification Generation where practical

142. First Version Non-Goals

No deberá requerir en ENG-033:

HTTP-specific API design
REST resource modeling
HTTP methods/status codes
CORS
ETag
OpenAPI as universal authority
GraphQL-specific semantics
gRPC-specific semantics
API Gateway
API monetization
Developer Portal

Estas capacidades pertenecen a ENG-044 u otras especializaciones de Interface/Transport.

143. Second Phase

Podrá incorporar:

Advanced Interface Discovery
Consumer Contract Tests
Advanced Interface Composition
Cross-Process Interface Metadata
Interface Conformance Profiles

144. Third Phase

Solo cuando exista necesidad:

Dynamic Interface Composition
Semantic Interface Discovery
Interface Federation abstractions
Adaptive Compatibility Analysis
Generated Multi-Protocol Adapters

145. Invariantes de Ingeniería

ENG-033 conserva la serie global EI-606 a EI-625.

ID

Invariante

EI-606

Toda Interface publicada deberá constituir un Contract explícito y no una exposición accidental de Implementation.

EI-607

Interface Semantics deberán mantenerse separadas de Serialization, Transport y Protocol Semantics.

EI-608

Domain Entities, Persistence Entities y Runtime Objects no deberán convertirse automáticamente en Interface Contracts.

EI-609

Toda Operation publicada deberá poseer identidad y Ownership determinables.

EI-610

Interface Adapters deberán actuar principalmente como Adapters y no concentrar Business Logic.

EI-611

Todo Input externo deberá validarse en la Boundary antes de alcanzar componentes que lo consideren confiable.

EI-612

Validation, Business Rules y Authorization deberán conservar responsabilidades distinguibles.

EI-613

Errores internos deberán traducirse a Interface Errors estables sin exponer Implementation Details.

EI-614

Operaciones potencialmente no acotadas deberán declarar mecanismos de bounded access o procesamiento equivalente.

EI-615

Filtering, Sorting, Searching, Field Selection y Expansion deberán operar únicamente sobre capacidades contractualmente permitidas y limitadas.

EI-616

Tokens o referencias opacas expuestas por una Interface deberán permanecer opacas cuando su estructura no forme parte del Contract.

EI-617

Interface Versioning deberá representar evolución contractual y no depender únicamente del mecanismo utilizado para transportar la versión.

EI-618

Cambios semánticos incompatibles deberán tratarse como Breaking Changes aunque la estructura permanezca igual.

EI-619

Deprecation y Removal deberán permanecer como estados distintos del Interface Lifecycle.

EI-620

Mass Assignment y Over-Posting desde Inputs externos hacia Entities deberán impedirse por diseño.

EI-621

Authorization deberá aplicarse al Scope real de la Operation y no únicamente al acceso general al Adapter o Boundary.

EI-622

Interface Telemetry deberá utilizar identidades normalizadas y evitar Payloads sensibles o dimensiones de alta Cardinality.

EI-623

Stable Interfaces deberán someterse a Contract, Compatibility, Security y Documentation Gates antes de Release.

EI-624

Interface Documentation y Specification no deberán divergir silenciosamente de la fuente contractual canónica.

EI-625

La primera implementación deberá favorecer Interfaces explícitas, limitadas y contractuales antes de introducir generación automática o composición dinámica avanzada.

146. Continuidad de Invariantes

ENG-029 → EI-526 a EI-545
ENG-030 → EI-546 a EI-565
ENG-031 → EI-566 a EI-585
ENG-032 → EI-586 a EI-605
ENG-033 → EI-606 a EI-625

147. Criterios de Conformidad

Una implementación será conforme con ENG-033 cuando:

defina Interfaces explícitas;

defina Operations;

utilice Operation IDs;

separe Operation y Adapter Mapping;

utilice Adapters delgados;

utilice Input/Output Contracts;

no exponga Entities automáticamente;

valide Input;

separe Validation y Authorization;

traduzca Errors;

utilice códigos contractuales estables;

limite Operations potencialmente no acotadas;

limite Filtering, Sorting, Searching y Expansion;

soporte Interface Versioning;

soporte Deprecation;

integre Security Requirements;

integre Observability;

integre Testing;

integre Registry;

integre Runtime;

permita Documentation/Specification;

preserve Compatibility;

mantenga Interface separada de Serialization, Transport y Protocol;

delegue semánticas específicas de API pública a ENG-044.

148. Riesgos

Deberán evitarse especialmente:

Entity as Interface
Fat Adapter
Transport Mapping as Entire Contract
Validation Equals Authorization
Mass Assignment
Unbounded Operation
Arbitrary Filtering
Arbitrary Sorting
Recursive Expansion
Internal Error Leakage
Message as Error Code
Silent Breaking Change
Version Explosion
Permanent Deprecation
Documentation Drift
Authorization by Adapter Only
High-Cardinality Metrics
Automatic CRUD Contract
HTTP Semantics Embedded in General Interface Model
OpenAPI Treated as Universal Interface Authority
Protocol Coupling

149. Relación con ENG-014

Versionado gobierna evolución general.

ENG-033 especializa Interface Versioning.

150. Relación con ENG-015

Architectural State Machine gobierna Lifecycle formal cuando corresponda.

151. Relación con ENG-016

Compatibility determina si un Interface Change es compatible.

152. Relación con ENG-019

Service Container podrá construir:

Adapters
Handlers
Mappers
Validators
Error Mappers

153. Relación con ENG-020

Registry podrá mantener Interfaces, Operations y Adapter Bindings.

154. Relación con ENG-021

Contracts constituyen la base semántica de Input/Output/Error Contracts.

155. Relación con ENG-022

Events no deberán confundirse con Interface Operations Request/Response.

156. Relación con ENG-023

Error Handling proporciona la taxonomía y Translation Model general.

157. Relación con ENG-024

Security gobierna:

Authentication
Authorization
Tenant Isolation
Credentials
Sensitive Data
Security Policies

158. Relación con ENG-025

Observability gobierna:

Interface Metrics
Tracing
Correlation
Logging
Diagnostics

159. Relación con ENG-026 y ENG-070

La frontera de Performance será:

ENG-026
Runtime Performance Engineering
→ framework/runtime overhead

ENG-070
Performance Engineering
→ general application/system/workload performance

ENG-033 podrá declarar Performance Requirements de Interface, pero no redefinirá el modelo general de ENG-070.

ENG-026 será relevante cuando la medición corresponda al costo introducido por el propio Runtime de MEF.

160. Relación con ENG-027

Runtime gobierna Registration, Activation y Shutdown.

161. Relación con ENG-028

Modules podrán publicar Interfaces con Ownership explícito.

162. Relación con ENG-029

Extensions podrán extender Interfaces únicamente mediante Extension Points gobernados.

163. Relación con ENG-030

Persistence Models no deberán convertirse directamente en Interface Contracts.

164. Relación con ENG-031

ENG-031 Serialization
→ representation encoding

ENG-033 Interface
→ contractual semantics

165. Relación con ENG-032

ENG-032 Transport
→ movement and communication mechanics

ENG-033 Interface
→ operations and contractual semantics

La cadena será:

Interface Contract
      │
      ▼
Serialization
      │
      ▼
Transport
      │
      ▼
Protocol

166. Relación con ENG-034

Application ejecutará Use Cases invocados mediante Interfaces.

Interface
   │
   ▼
Application
   │
   ▼
Domain

167. Relación con ENG-044

ENG-044 — API Engineering especializa el modelo general de Interface definido por ENG-033 para APIs públicas orientadas a Consumers.

La frontera de autoridad será:

ENG-033
Interface Engineering
│
└── Interface / Operation / Contract Semantics

ENG-044
API Engineering
│
└── Public API / Endpoint / HTTP / Consumer Semantics

ENG-033 será autoritativo para:

Interface
Interface Contract
Operation Contract
Input Contract
Output Contract
Error Contract
Interface Boundary
Interface Adapter
Interface Versioning
Interface Compatibility
Interface Lifecycle
Interface Discovery Metadata
Interface Contract Testing

ENG-044 será autoritativo para:

Public API
API Boundary
Endpoint
Resource
HTTP Method
HTTP Status
URI
Headers
Content Negotiation
Problem Details
API Pagination
API Filtering
API Sorting
API Rate Limiting
API Quotas
Idempotency Keys
Conditional Requests
ETag
CORS
OpenAPI
API Discovery
API Lifecycle

Cuando exista conflicto conceptual:

general Interface semantics
→ ENG-033

public API / HTTP / Consumer semantics
→ ENG-044

ENG-033 no deberá redefinir mecanismos específicos de exposición gobernados por ENG-044.

ENG-044 no deberá redefinir los fundamentos contractuales generales de Interface gobernados por ENG-033.

168. Principio Rector

MEF deberá publicar capacidades mediante Interfaces contractuales y no implementaciones: toda Interface deberá mantener estable su semántica observable y conservar separados Application, Domain, Persistence, Serialization, Transport, Protocol y Adapter-specific concerns.

169. Conclusión

ENG-033 — Interface Engineering formaliza la Boundary contractual general de MEF.

La arquitectura queda:

                  CONSUMER
                     │
                     ▼
                  INTERFACE
                     │
                     ▼
               INPUT CONTRACT
                     │
                     ▼
                 VALIDATION
                     │
                     ▼
                   MAPPER
                     │
                     ▼
                APPLICATION
                     │
                     ▼
                   DOMAIN
                     │
                     ▼
                   RESULT
                     │
                     ▼
                   MAPPER
                     │
                     ▼
              OUTPUT CONTRACT
                     │
                     ▼
              INTERFACE ADAPTER
                     │
                     ▼
          SERIALIZATION / TRANSPORT

Las Boundaries quedan diferenciadas:

Domain
→ business meaning

Application
→ use-case orchestration

Interface
→ contractual interaction semantics

Serialization
→ representation

Transport
→ movement

Protocol
→ communication implementation

API
→ specialized public/HTTP-facing interface governed by ENG-044

La primera implementación deberá concentrarse en:

Explicit Interface Contracts
Operation IDs
Input/Output DTOs
Thin Adapters
Validation
Error Mapping
Versioning
Deprecation
Security Requirements
Observability
Contract Testing
Compatibility

antes de introducir:

Dynamic Interface Composition
Automatic Interface Generation
Semantic Interface Federation
Universal Multi-Protocol Generation

Con ENG-033 la serie global permanece en:

EI-625

Referencias

Arquitectura

ARQ-004 — Modules

ARQ-006 — Registry

ARQ-007 — Service Container

ARQ-008 — Event Bus

ARQ-011 — Contracts

ARQ-014 — Framework Lifecycle

ARQ-016 — Security

Ingeniería

ENG-005 — Nomenclatura

ENG-006 — Estructura de Directorios

ENG-007 — CLI

ENG-009 — Testing

ENG-012 — Build System

ENG-014 — Versionado

ENG-015 — Architectural State Machine

ENG-016 — Compatibility

ENG-019 — Service Container

ENG-020 — Registry Engineering

ENG-021 — Contracts Engineering

ENG-022 — Event Bus Engineering

ENG-023 — Error Handling

ENG-024 — Security Engineering

ENG-025 — Observability Engineering

ENG-026 — Runtime Performance Engineering

ENG-027 — Runtime Engineering

ENG-028 — Module Engineering

ENG-029 — Extension Engineering

ENG-030 — Persistence Engineering

ENG-031 — Serialization Engineering

ENG-032 — Transport Engineering

ENG-034 — Application Engineering

ENG-044 — API Engineering

ENG-070 — Performance Engineering