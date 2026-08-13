---
id: ENG-019
titulo: Service Container
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
  - ENG-005
  - ENG-006
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-015
  - ENG-016
  - ENG-018
  - ARQ-004
  - ARQ-006
  - ARQ-007
  - ARQ-011
  - ARQ-012
  - ARQ-014
relacionados:
  - ENG-020
  - ENG-021
  - ENG-022
  - ENG-023
  - ENG-024
  - ENG-027
keywords:
  - service container
  - dependency injection
  - bindings
  - service resolution
  - scopes
  - lifecycle
  - factories
  - providers
  - composition
  - dependency graph
  - runtime
  - mef
---

# ENG-019

# Service Container

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica del **Service Container** de **MEF (Modular Enterprise Framework)**.

ENG-019 establece cómo deberán:

- registrarse;
- describirse;
- validar;
- resolver;
- construir;
- compartir;
- aislar;
- destruir;

las dependencias administradas por el Runtime.

El Service Container deberá materializar las reglas de `ENG-018 — Dependency Injection` sin convertirse en una dependencia global de los componentes funcionales.

---

# 2. Declaración

El Service Container es infraestructura de composición.

No es:

- el Registry arquitectónico;
- el Dependency Injection Pattern;
- el Runtime completo;
- el Module Manager;
- el Package Manager;
- un Service Locator global.

La regla fundamental será:

> **El Container administra la composición de dependencias; los componentes correctamente diseñados no deberán necesitar conocerlo.**

---

# 3. Modelo General

```text
Providers
   │
   ▼
Definitions
   │
   ▼
Bindings
   │
   ▼
Dependency Graph
   │
   ▼
Validation
   │
   ▼
Service Container
   │
   ▼
Resolution
   │
   ▼
Instances
   │
   ▼
Scopes / Lifecycle
```

---

# 4. Objetivos

El Service Container deberá:

- mantener Bindings explícitos;
- resolver Contracts;
- construir dependencias;
- gestionar Scopes;
- detectar errores de composición;
- controlar Lifecycle;
- soportar Providers;
- permitir Factories;
- facilitar Testing;
- facilitar diagnóstico;
- preservar Module boundaries;
- mantener independencia tecnológica.

---

# 5. Conceptos Fundamentales

MEF reconoce en el Container:

```text
Service Definition
Binding
Contract
Implementation
Factory
Provider
Scope
Instance
Resolution Request
Resolution Context
Resolution Result
Dependency Graph
Container
Child Scope
Disposal
```

---

# 6. Service Definition

Una `Service Definition` describe cómo obtener una dependencia.

Podrá contener:

```text
Contract
Implementation
Factory
Scope
Qualifier
Metadata
Lifecycle
Policy
```

No deberá representar todavía necesariamente una instancia construida.

---

# 7. Definition vs Instance

Se deberá conservar:

```text
Definition
≠
Instance
```

La primera describe.

La segunda es el objeto materializado.

---

# 8. Binding

Un `Binding` establece una relación entre una dependencia solicitada y una Definition capaz de satisfacerla.

Ejemplo:

```text
CT-CUSTOMER-001
        ↓
MySqlCustomerRepository
```

---

# 9. Contract Binding

Cuando exista un Contract formal:

```text
Contract
    ↓
Binding
    ↓
Implementation
```

La versión y compatibilidad deberán validarse mediante ENG-016.

---

# 10. Concrete Binding

Dentro de un mismo límite podrá existir Binding hacia una clase concreta cuando no se requiera Contract público.

Ejemplo:

```text
CustomerValidator
      ↓
CustomerValidator
```

La existencia de Container no obliga a crear interfaces artificiales.

---

# 11. Binding Identity

Cada Binding deberá poder distinguirse suficientemente cuando existan múltiples implementaciones.

Podrán utilizarse:

```text
Contract
Qualifier
Module
Scope
```

según el caso.

---

# 12. Explicit Binding

MEF deberá favorecer Bindings explícitos para dependencias arquitectónicamente relevantes.

No deberá depender únicamente de convenciones implícitas.

---

# 13. Auto-Registration

Un Implementation Profile podrá utilizar Auto-Registration.

Sin embargo deberá:

- respetar boundaries;
- evitar ambigüedad;
- ser determinista;
- permitir diagnóstico.

---

# 14. Container Registration

Conceptualmente:

```text
container.bind(
  CT-CUSTOMER-001,
  MySqlCustomerRepository
)
```

La API exacta dependerá del lenguaje.

---

# 15. Registration Phase

Los Bindings deberían registrarse durante una fase explícita del Bootstrap.

```text
Bootstrap
   ↓
Provider Registration
   ↓
Container Definitions
```

---

# 16. Registration no es Resolution

Debe conservarse:

```text
Registration
≠
Resolution
```

Registrar una Definition no implica construir inmediatamente su Instance.

---

# 17. Provider

Un `Provider` registra capacidades o Definitions.

Ejemplo conceptual:

```text
CrmProvider
   │
   ├── register CT-CUSTOMER-001
   └── register CustomerService
```

---

# 18. Provider Responsibility

Un Provider deberá:

- declarar Bindings;
- registrar Factories;
- registrar metadata;
- configurar Composition.

No deberá ejecutar lógica funcional ordinaria.

---

# 19. Provider Ordering

El orden de Providers no deberá alterar accidentalmente el resultado.

Cuando exista dependencia de orden deberá declararse explícitamente.

---

# 20. Provider Dependency

Un Provider podrá declarar que requiere otro Provider o capacidad previa.

Esto deberá validarse.

---

# 21. Duplicate Binding

Si dos Providers registran el mismo Contract sin regla explícita de coexistencia:

```text
CT-PAYMENT-001
   ├── Stripe
   └── Adyen
```

el Container deberá detectar ambigüedad.

---

# 22. Binding Collision

No deberá aplicarse:

```text
last registration wins
```

como regla universal silenciosa.

---

# 23. Override

Un Override deberá ser explícito y gobernado.

Podrá utilizarse para:

```text
Testing
Environment profile
Application composition
Extension Point
```

---

# 24. Override Source

El sistema deberá poder identificar:

```text
who registered
who replaced
why
```

cuando sea relevante.

---

# 25. Protected Binding

Determinadas capacidades críticas podrán marcarse como:

```text
protected
```

o equivalente.

No deberán ser reemplazadas por cualquier Provider.

---

# 26. Restricted Binding

Security Policy podrá definir qué Publishers o Packages pueden sustituir una capacidad.

---

# 27. Binding Provenance

Conceptualmente:

```text
Binding
├── Contract
├── Implementation
├── Provider
├── Module
├── Package
└── Trust Metadata
```

---

# 28. Resolution Request

Una solicitud de resolución podrá contener:

```text
Contract
Qualifier
Consumer
Scope
Required Version
Capabilities
```

---

# 29. Resolution

La resolución transforma:

```text
Dependency Request
        ↓
Matching Definition
        ↓
Instance
```

---

# 30. Resolution Pipeline

Conceptualmente:

```text
Request
   ↓
Normalize
   ↓
Find Candidates
   ↓
Compatibility Check
   ↓
Scope Check
   ↓
Select Definition
   ↓
Build Instance
   ↓
Cache by Scope
   ↓
Return
```

---

# 31. Candidate Resolution

El Container deberá localizar todas las Definitions que puedan satisfacer la Request.

---

# 32. Compatibility Filtering

Los Candidates incompatibles deberán eliminarse mediante ENG-016.

---

# 33. Qualifier Filtering

Si se especificó Qualifier, deberá aplicarse antes de selección final.

---

# 34. Ambiguous Result

Si permanecen múltiples Candidates igualmente válidos sin regla de selección:

```text
RESOLUTION AMBIGUOUS
```

---

# 35. No Candidate

Si no existe Candidate para dependencia obligatoria:

```text
RESOLUTION FAILED
```

---

# 36. Deterministic Selection

La selección deberá ser determinista.

No deberá depender de:

- orden de filesystem;
- orden de reflection;
- orden accidental de Packages;
- timing.

---

# 37. Default Binding

Un Contract podrá declarar una Definition predeterminada.

Deberá ser explícita.

---

# 38. Priority

Podrá existir Priority.

Ejemplo:

```text
priority: 100
```

Pero no deberá utilizarse como sustituto indiscriminado de Qualifiers o Policy.

---

# 39. Resolution Path

El Container deberá poder construir una ruta diagnóstica.

Ejemplo:

```text
CustomerController
→ CustomerService
→ CT-CUSTOMER-001
→ MySqlCustomerRepository
→ DatabaseConnection
```

---

# 40. Recursive Resolution

Resolver una dependencia podrá requerir resolver sus dependencias transitivas.

---

# 41. Dependency Graph

La resolución completa genera un grafo.

```text
A
├── B
│   └── D
└── C
```

---

# 42. Graph Validation

Antes de Runtime, cuando sea razonable, deberá validarse:

- Missing Bindings;
- Circular Dependencies;
- Scope Violations;
- Forbidden Boundaries;
- Incompatible Contracts;
- Duplicate Bindings.

---

# 43. Graph Build

El Container debería poder construir una representación del Dependency Graph sin instanciar todos los objetos cuando el perfil lo permita.

---

# 44. Circular Dependency

```text
A → B
B → C
C → A
```

deberá detectarse.

---

# 45. Cycle Detection

El error deberá mostrar la ruta completa del ciclo.

---

# 46. Lazy Resolution and Cycles

`Lazy` no deberá utilizarse automáticamente para ocultar un ciclo arquitectónico inválido.

---

# 47. Factory

Una `Factory` produce Instances.

Ejemplo conceptual:

```text
DatabaseConnectionFactory
```

---

# 48. Factory Binding

Una Definition podrá utilizar:

```text
factory
```

en lugar de clase concreta.

---

# 49. Factory Dependencies

La propia Factory podrá recibir dependencias mediante DI.

---

# 50. Factory Does Not Receive Container by Default

Se evitará:

```text
Factory(Container container)
```

cuando pueda recibir Contracts específicos.

---

# 51. Generic Factory

Una Factory genérica podrá existir dentro de infraestructura del Container, pero no deberá convertirse en Service Locator para lógica funcional.

---

# 52. Instance Binding

Podrá registrarse una Instance existente.

Ejemplo:

```text
Clock → SystemClock instance
```

Esto deberá respetar Scope y ownership.

---

# 53. Constant / Value Binding

Valores técnicos simples podrán registrarse cuando el perfil lo permita.

Sin embargo, Configuration estructurada debería inyectarse como objetos tipados conforme ENG-011.

---

# 54. Scope

Un `Scope` define cuánto tiempo vive una Instance y dentro de qué frontera puede reutilizarse.

---

# 55. Scopes Iniciales

La primera implementación debería reconocer:

```text
Singleton
Transient
```

Posteriormente podrán añadirse:

```text
Application
Module
Request
Operation
```

---

# 56. Singleton Scope

Existe una Instance compartida dentro del Container o frontera definida.

```text
Definition
   ↓
one instance
```

---

# 57. Singleton Semantics

`Singleton` no deberá significar:

```text
global static object
```

Representa una Instance única administrada por Scope.

---

# 58. Transient Scope

Cada Resolution produce una nueva Instance.

---

# 59. Application Scope

Podrá representar una Instance compartida durante el Lifecycle de una Application.

---

# 60. Module Scope

Podrá asociar Instances al Lifecycle de un Module.

Ejemplo:

```text
MOD-CRM Active
   │
   └── CrmModuleScope
```

---

# 61. Request Scope

Podrá existir cuando el perfil posea concepto de Request.

---

# 62. Operation Scope

Podrá asociarse a una unidad de trabajo técnica.

---

# 63. Scope Hierarchy

Conceptualmente:

```text
Application
   │
   ├── Module
   │     └── Operation
   │
   └── Request
```

La jerarquía concreta dependerá del Runtime.

---

# 64. Child Scope

Un Scope podrá generar Child Scopes.

---

# 65. Child Visibility

Un Child Scope podrá resolver Definitions del Parent.

El Parent no deberá depender automáticamente de Instances exclusivas del Child.

---

# 66. Captive Dependency

Ejemplo inválido:

```text
Singleton Service
      ↓
Request Scoped Dependency
```

si la instancia de Request queda capturada permanentemente.

---

# 67. Scope Validation

El Container deberá poder detectar Captive Dependencies cuando la información sea suficiente.

---

# 68. Scope Promotion

No deberá promoverse silenciosamente una Instance de Scope corto a uno largo.

---

# 69. Scope Disposal

Cerrar un Scope deberá liberar las Instances que éste posee.

---

# 70. Ownership

El Container deberá saber cuándo posee una Instance.

---

# 71. External Instance Ownership

Una Instance registrada externamente podrá declararse:

```text
externally owned
```

cuando el Container no deba destruirla.

---

# 72. Disposable Service

Una dependencia podrá declarar necesidad de Cleanup.

Ejemplos:

```text
close()
dispose()
shutdown()
```

según lenguaje.

---

# 73. Disposal Ordering

El Disposal debería ocurrir en orden inverso a la dependencia.

Si:

```text
A depends on B
```

normalmente:

```text
dispose A
before
dispose B
```

---

# 74. Graceful Disposal

El Container deberá integrarse con ARQ-014 y ENG-015 durante Shutdown.

---

# 75. Disposal Failure

Un fallo de Cleanup deberá:

- registrarse;
- continuar con recursos independientes cuando sea seguro;
- no ocultarse.

---

# 76. Async Disposal

Los perfiles podrán soportar Disposal asíncrono.

---

# 77. Instance Cache

Los Scopes reutilizables podrán mantener cache de Instances.

---

# 78. Cache Key

La identidad de Instance deberá considerar cuando corresponda:

```text
Definition
Qualifier
Scope
```

---

# 79. Cache Safety

No deberá reutilizarse una Instance fuera de su Scope válido.

---

# 80. Thread Safety

Scopes compartidos deberán considerar concurrencia.

---

# 81. Concurrent Singleton Creation

Dos solicitudes simultáneas no deberán producir dos Singletons distintos accidentalmente.

---

# 82. Construction Synchronization

El Container deberá coordinar construcción de Instances compartidas cuando corresponda.

---

# 83. Reentrant Resolution

Una Instance en construcción que intenta resolverse a sí misma deberá producir diagnóstico de ciclo o reentrancia inválida.

---

# 84. Construction State

Internamente podrá utilizarse:

```text
Uninitialized
Constructing
Ready
Failed
Disposed
```

para administrar Instances.

No constituye necesariamente una State Machine pública.

---

# 85. Failed Construction

Una Instance parcialmente construida no deberá almacenarse como válida.

---

# 86. Retry Construction

La política deberá definir si un fallo de construcción es retryable.

No deberá reintentarse infinitamente.

---

# 87. Eager Services

Algunos Services podrán marcarse para resolución durante Bootstrap.

---

# 88. Lazy Services

Otros podrán construirse al primer uso.

---

# 89. Eager Validation

Incluso Services lazy deberían poder validar sus Definitions antes de Runtime cuando sea posible.

---

# 90. Eager Construction

Podrá utilizarse para:

- detectar fallos temprano;
- inicializar infraestructura crítica.

---

# 91. Lazy Construction

Podrá utilizarse para:

- reducir startup;
- evitar recursos no utilizados.

---

# 92. Critical Services

Services críticos como:

```text
Configuration
Logger
Registry
Event Bus
Security
```

podrán resolverse anticipadamente.

---

# 93. Bootstrap Container

El propio Container deberá poder inicializarse con dependencias mínimas.

---

# 94. Bootstrap Cycle

Se deberá evitar:

```text
Container requires Registry
Registry requires Container
```

sin una frontera de Bootstrap clara.

---

# 95. Bootstrap Services

Un conjunto mínimo podrá crearse manualmente antes del Container completo.

Ejemplo conceptual:

```text
Clock
Filesystem
Configuration Loader
Bootstrap Logger
```

---

# 96. Container Build

Conceptualmente:

```text
Definitions
    ↓
ContainerBuilder
    ↓
Validate
    ↓
Compile/Freeze
    ↓
Container
```

---

# 97. Mutable Registration Phase

Durante Bootstrap podrá permitirse Registration.

---

# 98. Frozen Container

Después de Composition, el Container debería quedar:

```text
frozen
```

o restringido contra Bindings arbitrarios cuando sea razonable.

---

# 99. Runtime Mutation

Modificar Bindings durante Runtime deberá considerarse capacidad avanzada.

---

# 100. No Arbitrary Runtime Registration

Los Modules no deberán registrar y reemplazar servicios globales libremente después de Activation.

---

# 101. Extension Registration

Las Extensions podrán modificar Composition únicamente mediante Extension Points oficiales.

---

# 102. Dynamic Container

Un perfil podrá soportar Composition dinámica.

Deberá mantener:

- seguridad;
- consistencia;
- lifecycle;
- concurrency;
- compatibility.

---

# 103. Container Builder

Podrá existir:

```text
ContainerBuilder
```

encargado de acumular Definitions antes de construir el Container final.

---

# 104. Builder Responsibilities

Podrá:

- add definitions;
- add providers;
- validate;
- compile.

No deberá resolver Services para lógica funcional.

---

# 105. Container Compilation

Los perfiles podrán compilar el Dependency Graph.

---

# 106. Compiled Container

Puede generar una representación optimizada.

Ventajas:

- rendimiento;
- menor Reflection;
- detección temprana;
- determinismo.

---

# 107. Compiled Container Input

Deberá derivarse de Definitions y metadata gobernadas.

---

# 108. Compiled Output

No deberá convertirse en Source of Truth.

La Source of Truth siguen siendo Definitions y Contracts.

---

# 109. Container Cache

El Container compilado podrá cachearse.

---

# 110. Cache Invalidation

Deberá invalidarse cuando cambien:

```text
Definitions
Contracts
Configuration
Modules
Providers
Compatibility requirements
```

relevantes.

---

# 111. Autowiring

Un perfil podrá soportar Autowiring.

---

# 112. Type-Based Autowiring

Podrá utilizar tipos para resolver dependencias inequívocas.

---

# 113. Autowiring Limit

Si existe más de un Candidate:

```text
FAIL
```

salvo Qualifier o regla explícita.

---

# 114. Primitive Parameters

No deberán resolverse primitivas ambiguas automáticamente.

Ejemplo:

```text
Service(string value)
```

no indica qué string debe usarse.

---

# 115. Typed Configuration

Preferir:

```text
Service(LoggingConfiguration config)
```

frente a múltiples strings no identificables.

---

# 116. Named Arguments

Los Implementation Profiles podrán usar nombres de parámetros como metadata secundaria.

No debería ser la única regla para dependencias críticas.

---

# 117. Reflection

Puede utilizarse para inspección y Autowiring.

No será requisito universal.

---

# 118. Generated Metadata

Los perfiles podrán generar metadata de resolución.

---

# 119. Container API

La API mínima conceptual podrá ofrecer:

```text
resolve(contract)
has(contract)
scope(...)
```

pero su acceso deberá limitarse principalmente a infraestructura de Composition.

---

# 120. `resolve()`

La existencia de `resolve()` no significa que toda lógica funcional deba utilizarla.

---

# 121. `has()`

No deberá utilizarse para convertir dependencias obligatorias en opcionales de manera silenciosa.

---

# 122. Service Locator Guard

Architecture Tests deberían detectar uso directo del Container fuera de fronteras permitidas.

---

# 123. Allowed Container Consumers

Normalmente:

```text
Composition Root
Providers
Framework Runtime
Factories explicitly designed for resolution
Tooling
```

---

# 124. Forbidden Ordinary Consumers

Normalmente:

```text
Domain Entities
Value Objects
Commands
Queries
Events
Business Services
```

no deberán recibir el Container completo.

---

# 125. Module Container Access

Un Module podrá registrar Definitions mediante Provider.

Sus componentes internos deberán recibir dependencias explícitamente.

---

# 126. Container per Module

MEF podrá permitir sub-containers o Module Scopes.

No deberá requerirse un Container completamente independiente por Module.

---

# 127. Module Isolation

El Container deberá respetar visibilidad de Contracts públicos e internos.

---

# 128. Private Service

Un Module podrá declarar Services internos.

Otros Modules no deberán resolverlos.

---

# 129. Public Service

Una dependencia destinada a otros Modules deberá exponerse mediante Contract apropiado.

---

# 130. Visibility

Las Definitions podrán disponer conceptualmente de:

```text
private
module
public
framework
```

según necesidad.

---

# 131. Visibility Enforcement

El Container deberá impedir Resolution fuera de la frontera permitida cuando tenga información suficiente.

---

# 132. Cross-Module Resolution

Deberá ocurrir mediante Contracts públicos.

---

# 133. Registry Integration

ENG-020 podrá mantener metadata sobre:

```text
Contracts
Providers
Capabilities
Modules
Implementations
```

---

# 134. Container vs Registry

La separación será:

```text
Registry
→ knows what exists

Container
→ constructs what is needed
```

---

# 135. Registry Does Not Own Instances

El Registry no deberá convertirse automáticamente en almacenamiento de objetos construidos.

---

# 136. Container Does Not Own Global Knowledge

El Container no deberá sustituir el Registry arquitectónico.

---

# 137. Contract Registry

ENG-020/ENG-021 podrán permitir que Container consulte Contracts disponibles.

---

# 138. Binding Source from Registry

Podrá utilizar Registry para descubrir candidatos, pero la selección y construcción pertenecen al Container.

---

# 139. Compatibility Integration

Antes de aceptar una Implementation para un Contract deberá validarse:

```text
Contract Identity
Version
Capabilities
Policy
```

cuando aplique.

---

# 140. Incompatible Binding

No deberá registrarse como Candidate válido.

---

# 141. Compatibility at Build Time

El Container Builder podrá detectar incompatibilidades antes de Runtime.

---

# 142. State Machine Integration

ENG-015 deberá gobernar cuándo determinadas dependencias están disponibles para uso.

---

# 143. Instance Lifecycle vs Architectural State

Se deberá distinguir:

```text
Service Instance Lifecycle
```

de:

```text
Module Architectural State
```

---

# 144. Module Stop

Cuando un Module se detenga, su Module Scope deberá liberar sus Services cuando corresponda.

---

# 145. Package Removal

ENG-013 no deberá eliminar un Package mientras existan Instances activas que dependan de él sin coordinar Lifecycle.

---

# 146. Container Freeze before Activation

El Runtime debería validar/fijar Composition antes de activar Modules obligatorios.

---

# 147. Activation Guard

Una Module Activation podrá requerir:

```text
all mandatory service dependencies resolvable
```

---

# 148. Runtime Health

Una dependencia resuelta no implica que esté saludable.

Health pertenece a otra capa.

---

# 149. Container Diagnostics

El Container deberá ofrecer diagnósticos claros.

---

# 150. `why`

Tooling podrá responder:

```text
Why was MySqlCustomerRepository selected?
```

Resultado conceptual:

```text
Requested:
CT-CUSTOMER-001

Selected:
MySqlCustomerRepository

Registered by:
CrmInfrastructureProvider

Scope:
Singleton

Reason:
Default compatible binding
```

---

# 151. `why-not`

Podrá explicar por qué un Candidate no fue seleccionado.

---

# 152. Graph Inspection

Podrá mostrarse:

```text
Service
├── Dependency
│   └── Dependency
└── Dependency
```

---

# 153. Scope Inspection

Tooling podrá mostrar:

```text
Service A: Singleton
Service B: Transient
Service C: Module
```

---

# 154. Binding Inspection

Deberá poder identificarse:

```text
Contract
Implementation
Provider
Scope
Visibility
```

---

# 155. CLI Integration

ENG-007 podrá incorporar:

```text
mef container validate
mef container inspect
mef container graph
```

o integrarlos bajo:

```text
mef dependency ...
```

La superficie definitiva deberá evitar duplicación.

---

# 156. Container Validation Command

Podrá ejecutar:

```text
definitions
cycles
missing dependencies
scope rules
visibility
compatibility
```

sin iniciar toda la Application cuando sea posible.

---

# 157. Structured Diagnostics

Deberá soportar machine-readable output cuando se integre con CI.

---

# 158. Logging

ENG-010 podrá registrar:

```text
container.build.started
container.build.completed
service.resolution.failed
dependency.cycle.detected
scope.disposal.failed
```

---

# 159. Logging Level

La resolución normal no debería registrarse en INFO.

TRACE/DEBUG podrán utilizarse para análisis detallado.

---

# 160. Sensitive Configuration

Los diagnósticos no deberán imprimir Secrets de Configuration.

---

# 161. Metrics

Futuros documentos podrán medir:

```text
resolution_count
resolution_duration
container_build_duration
scope_count
resolution_failures
```

---

# 162. Testing

ENG-009 deberá cubrir:

- successful resolution;
- missing dependency;
- ambiguous binding;
- cycle;
- scope violation;
- override;
- visibility;
- disposal;
- concurrency;
- compatibility.

---

# 163. Container Unit Tests

El Container deberá probarse como infraestructura aislada.

---

# 164. Composition Tests

Las Applications deberán disponer de pruebas que construyan el Container completo o una Composition representativa.

---

# 165. Provider Tests

Cada Provider crítico deberá poder comprobar que registra Definitions válidas.

---

# 166. Contract Tests

Los adapters del Container, si existen varios Implementation Profiles, deberán mantener semántica equivalente.

---

# 167. Scope Tests

Deberán comprobar:

```text
Singleton same instance
Transient different instances
Child scope isolation
Disposal
```

---

# 168. Concurrency Tests

Especialmente para:

```text
Singleton creation
Scope creation
Disposal
Concurrent resolve
```

---

# 169. Negative Tests

Deberán probar:

```text
forbidden private service access
protected binding override
invalid scope capture
```

---

# 170. Architecture Tests

Deberán detectar cuando sea posible:

```text
Container injected into Domain
Cross-module private resolution
Direct global container access
```

---

# 171. Performance

El Container se encuentra en una ruta crítica de Runtime.

Debe evitar:

- Reflection repetitiva innecesaria;
- Graph rebuild por cada Request;
- locks globales excesivos;
- creación innecesaria de objetos.

---

# 172. Resolution Complexity

El Container deberá favorecer lookup eficiente de Definitions.

---

# 173. Precomputed Graph

Los perfiles podrán precomputar relaciones.

---

# 174. Lazy Metadata

Metadata costosa podrá cargarse únicamente cuando se requiera, manteniendo determinismo.

---

# 175. Memory

Singletons y caches deberán liberarse conforme Lifecycle.

---

# 176. Leak Prevention

Module/Request Scopes no deberán conservar referencias después de cerrar.

---

# 177. Weak References

Podrán utilizarse en perfiles específicos cuando ayuden, pero no serán requisito universal.

---

# 178. Container Reset

Un Container de Production no debería resetearse arbitrariamente.

---

# 179. Test Reset

Las pruebas podrán crear Containers nuevos por caso.

Preferible a mutar un Container global compartido.

---

# 180. Child Container

Un Implementation Profile podrá utilizar Child Containers.

La semántica deberá preservar:

- visibility;
- scope;
- ownership.

---

# 181. Overlay Container

Testing podrá utilizar un overlay explícito para reemplazar Bindings.

---

# 182. Test Overrides

Ejemplo:

```text
CT-CUSTOMER-001
Production → MySqlCustomerRepository
Test       → InMemoryCustomerRepository
```

---

# 183. Override Isolation

Un Override de Test no deberá escapar al entorno productivo.

---

# 184. Environment Bindings

ENG-011 podrá influir en selección.

Ejemplo:

```text
storage.driver = s3
```

podrá seleccionar un Adapter registrado.

---

# 185. Configuration Does Not Register Arbitrary Classes

La Configuration debería seleccionar capacidades conocidas.

No deberá permitir:

```text
className: AnyArbitraryClass
```

como mecanismo universal no controlado.

---

# 186. Factory from Configuration

El Provider o Binding Resolver podrá interpretar Configuration validada y seleccionar una Implementation permitida.

---

# 187. Secure Selection

Solo Candidates autorizados deberán ser seleccionables.

---

# 188. Serialization

Las Instances del Container no deberán serializarse automáticamente.

---

# 189. Container Persistence

El Container en sí no deberá persistirse como objeto de Runtime.

Definitions compiladas sí podrán cachearse.

---

# 190. Hot Reload

Actualizar Definitions durante Runtime será una capacidad avanzada.

---

# 191. Hot Reload Safety

Deberá considerar:

```text
existing instances
scopes
in-flight operations
disposal
compatibility
state machine
```

---

# 192. No Initial Requirement for Hot Reload

La primera versión de MEF no necesita soportarlo.

---

# 193. Container Replacement

El Framework no deberá depender de semántica propietaria que impida sustituir la implementación de Container.

---

# 194. Container Contract

MEF podrá definir un Contract mínimo de infraestructura.

No deberá exponer todas las características de una biblioteca específica.

---

# 195. Implementation Adapter

Podría utilizarse:

```text
MEF Container Contract
        │
        ├── Native Container
        ├── Symfony Adapter
        ├── Laravel Adapter
        ├── .NET Adapter
        └── Java Adapter
```

cuando exista valor.

---

# 196. Least Common Denominator Risk

El Contract universal no deberá reducirse excesivamente para intentar cubrir todas las librerías.

Debe expresar las capacidades que MEF realmente necesita.

---

# 197. Required Container Capabilities

La primera versión necesitará al menos:

```text
Binding
Resolution
Factory
Singleton
Transient
Validation
Cycle Detection
Disposal
```

---

# 198. Optional Capabilities

Podrán ser:

```text
Request Scope
Compiled Container
Decorators
Interceptors
Child Containers
Lazy proxies
```

---

# 199. Capability Declaration

Un Container Adapter podrá declarar capacidades.

ENG-016 podrá validar si una Application requiere alguna opcional.

---

# 200. No Container-Specific Domain Code

El Domain no deberá utilizar:

```text
#[Inject]
@Autowired
ContainerInterface
ServiceProvider
```

cuando ello lo acople innecesariamente a infraestructura.

---

# 201. Framework Metadata

Metadata de DI podrá permitirse en capas de Application/Infrastructure cuando el perfil lo requiera.

Deberá evaluarse el acoplamiento.

---

# 202. Constructor Injection Remains Portable

La forma más portable seguirá siendo:

```text
constructor(required dependencies)
```

---

# 203. Container as Composition Infrastructure

La arquitectura final será:

```text
Architecture
    ↓
Contracts
    ↓
Providers
    ↓
Definitions
    ↓
Container Builder
    ↓
Dependency Graph
    ↓
Validation
    ↓
Container
    ↓
Instances
```

---

# 204. Error Taxonomy

Taxonomía conceptual:

```text
MEF-CTR-001 Binding not found
MEF-CTR-002 Ambiguous binding
MEF-CTR-003 Circular dependency
MEF-CTR-004 Invalid scope
MEF-CTR-005 Captive dependency
MEF-CTR-006 Construction failed
MEF-CTR-007 Protected binding violation
MEF-CTR-008 Visibility violation
MEF-CTR-009 Disposal failed
MEF-CTR-010 Container frozen
MEF-CTR-011 Incompatible binding
MEF-CTR-012 Provider conflict
MEF-CTR-013 Invalid definition
MEF-CTR-014 Scope closed
MEF-CTR-015 Concurrent construction failure
```

La numeración podrá formalizarse posteriormente.

---

# 205. Prefix Note

El prefijo de errores:

```text
MEF-CTR-xxx
```

pertenece únicamente a **Container Runtime Errors**.

No deberá confundirse con el identificador de Contracts, cuyo prefijo canónico continúa siendo:

```text
CT-*
```

---

# 206. Missing Binding Diagnostic

```text
MEF-CTR-001

Unable to resolve required service.

Consumer:
CreateCustomerHandler

Required Contract:
CT-CUSTOMER-001

Resolution path:
CustomerController
→ CreateCustomerHandler
→ CT-CUSTOMER-001

Matching bindings:
0
```

---

# 207. Ambiguous Diagnostic

```text
MEF-CTR-002

Multiple compatible bindings found.

Contract:
CT-PAYMENT-001

Candidates:
StripePaymentAdapter
AdyenPaymentAdapter

Explicit qualifier or default binding required.
```

---

# 208. Scope Diagnostic

```text
MEF-CTR-005

Captive dependency detected.

Singleton:
InvoiceService

depends on:

RequestScoped:
CurrentRequestContext
```

---

# 209. Visibility Diagnostic

```text
MEF-CTR-008

Private service cannot be resolved outside its Module.

Consumer:
MOD-CRM

Requested Service:
IdentityTokenRepository

Owner:
MOD-IDENTITY

Use a public Contract instead.
```

---

# 210. CI Quality Gate

Container validation deberá poder formar parte de:

```text
ENG-012 Build
```

antes de Release.

---

# 211. Quality Gate Failures

Deberán bloquear Build cuando afecten dependencias obligatorias:

```text
Missing Binding
Cycle
Invalid Scope
Forbidden Boundary
Incompatible Contract
```

---

# 212. Release Integration

ENG-017 deberá verificar que la Composition requerida por una Release soportada pueda validarse bajo sus Compatibility Matrices cuando corresponda.

---

# 213. Runtime Integration

ENG-027 podrá utilizar el Container para construir la Composition activa.

---

# 214. Event Bus Integration

ENG-022 podrá registrar:

```text
EventPublisher
EventDispatcher
SubscriberRegistry
```

mediante Container.

---

# 215. Registry Integration

ENG-020 proporcionará metadata; Container producirá Instances.

---

# 216. Contracts Engineering Integration

ENG-021 definirá qué significa implementar y publicar `CT-*`.

Container consumirá esa metadata.

---

# 217. Error Handling Integration

ENG-023 definirá cómo propagar errores de Resolution sin acoplar consumidores a excepciones propietarias del Container.

---

# 218. Security Integration

ENG-024 deberá gobernar Protected Bindings y registraciones provenientes de Packages no confiables.

---

# 219. Invariantes de Ingeniería

ENG-019 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-326 | El Service Container deberá permanecer infraestructura de composición y no convertirse en dependencia global de lógica funcional. |
| EI-327 | Registration y Resolution deberán mantenerse como fases conceptualmente distintas. |
| EI-328 | Los Bindings arquitectónicamente relevantes deberán ser explícitos y diagnosticables. |
| EI-329 | Los conflictos de Binding no deberán resolverse mediante `last registration wins` silencioso. |
| EI-330 | Una Resolution sin Candidate obligatorio deberá fallar explícitamente. |
| EI-331 | Una Resolution con múltiples Candidates igualmente válidos deberá considerarse ambigua hasta que exista regla explícita. |
| EI-332 | El Container deberá resolver dependencias de manera determinista para las mismas Definitions y Context. |
| EI-333 | Las Circular Dependencies inválidas deberán detectarse y rechazarse. |
| EI-334 | Los Scopes deberán controlar reutilización y Lifecycle de Instances. |
| EI-335 | Los Captive Dependencies conocidas deberán detectarse cuando sea razonablemente posible. |
| EI-336 | Cerrar un Scope deberá liberar las Instances que posea cuando requieran Disposal. |
| EI-337 | Una Instance parcialmente construida no deberá almacenarse como válida. |
| EI-338 | El Container deberá respetar Visibility y Module Boundaries durante Resolution. |
| EI-339 | Los Services internos de un Module no deberán resolverse desde otro Module fuera de Contracts públicos permitidos. |
| EI-340 | Los Protected Bindings no deberán ser reemplazados sin Policy explícita. |
| EI-341 | Configuration podrá seleccionar Bindings conocidos, pero no deberá permitir instanciación arbitraria no gobernada. |
| EI-342 | El Container no deberá sustituir al Registry arquitectónico. |
| EI-343 | El Registry no deberá sustituir al Container como gestor ordinario de Instances. |
| EI-344 | La Compatibility de Contract deberá validarse antes de seleccionar una Implementation cuando aplique. |
| EI-345 | La Composition obligatoria deberá poder validarse antes de que los Modules dependientes alcancen `Active`. |

---

# 220. Criterios de Conformidad

Una implementación será conforme con ENG-019 cuando:

- mantenga Definitions;
- mantenga Bindings;
- distinga Registration y Resolution;
- detecte Missing Bindings;
- detecte Ambiguity;
- detecte Cycles;
- soporte Factories;
- soporte Singleton y Transient;
- gestione Scope ownership;
- realice Disposal;
- respete Visibility;
- respete Module Boundaries;
- soporte Providers;
- permita Graph Validation;
- proteja Bindings sensibles;
- integre Compatibility;
- facilite Testing;
- produzca diagnósticos;
- permanezca tecnológicamente neutral.

---

# 221. Riesgos

Deberán evitarse especialmente:

## Container Everywhere

Todo componente recibe Container.

## Last Binding Wins

Una registración posterior sobrescribe silenciosamente otra.

## Global Singleton Registry

Todas las Instances permanecen globalmente accesibles.

## Captive Dependencies

Scopes largos retienen objetos de Scope corto.

## Runtime Mutation Chaos

Bindings cambian mientras existen Instances dependientes.

## Private Service Leakage

Otros Modules consumen Services internos.

## Container as Registry

Se utiliza Resolution para descubrir arquitectura.

## Registry as Container

Se almacenan objetos construidos dentro del catálogo arquitectónico.

## Reflection Magic

El sistema resuelve Classes mediante heurísticas imposibles de diagnosticar.

## Arbitrary Configuration Instantiation

Configuration especifica clases no gobernadas.

## Protected Service Override

Un Package sustituye autenticación o seguridad sin Policy.

## Premature Complexity

Se implementan proxies, interceptors, hot reload y scopes avanzados antes de necesitarse.

---

# 222. Arquitectura Recomendada

```text
                     PROVIDERS
                         │
                         ▼
                   DEFINITIONS
                         │
                         ▼
                    BINDINGS
                         │
                         ▼
                CONTAINER BUILDER
                         │
                         ▼
                 GRAPH VALIDATION
                         │
       ┌─────────────────┼─────────────────┐
       ▼                 ▼                 ▼
    Missing           Cycles          Scope Errors
       │                 │                 │
       └─────────────FAIL┴────────────FAIL─┘
                         │
                         ▼
                      FREEZE
                         │
                         ▼
                   CONTAINER
                         │
            ┌────────────┼────────────┐
            ▼            ▼            ▼
        Singleton     Transient      Scopes
            │            │            │
            └────────────┼────────────┘
                         ▼
                     INSTANCES
                         │
                         ▼
                      RUNTIME
                         │
                         ▼
                     DISPOSAL
```

---

# 223. Primera Implementación Recomendada

La primera versión deberá ser deliberadamente pequeña:

```text
Explicit Bindings
Constructor Injection
Singleton
Transient
Factory Bindings
Providers
Missing Binding Detection
Ambiguity Detection
Cycle Detection
Graph Validation
Disposal
Container Freeze
```

No implementaría inicialmente:

```text
Request Scope
Hot Reload
Runtime Rebinding
Interceptors
AOP
Distributed Container
Automatic Proxies
Complex Child Containers
```

---

# 224. Segunda Fase

Podrá incorporar:

```text
Module Scope
Request Scope
Operation Scope
Qualifiers
Protected Bindings
Binding Provenance
Compiled Container
Graph Visualization
```

---

# 225. Tercera Fase

Solo cuando exista necesidad real:

```text
Dynamic Composition
Hot Swap
Advanced Child Scopes
Interceptors
Distributed Resolution
Policy-driven Reconciliation
```

---

# 226. Relación con ENG-018

```text
ENG-018
Dependency Injection
      │
      │ establece reglas
      ▼
ENG-019
Service Container
      │
      │ materializa resolución
      ▼
Runtime Instances
```

---

# 227. Relación con ENG-020

La diferencia deberá permanecer:

```text
ENG-020 Registry Engineering
→ qué componentes/capacidades existen

ENG-019 Service Container
→ cómo se construyen sus Instances
```

---

# 228. Relación con ENG-021

```text
ENG-021 Contracts Engineering
→ define el Contract

ENG-019
→ relaciona el Contract con una Implementation
```

---

# 229. Relación con ENG-022

El Event Bus utilizará Services resueltos mediante Container, pero conservará su propio Lifecycle y Registry de handlers/subscribers.

---

# 230. Relación con ENG-027

Runtime Engineering será responsable de coordinar:

```text
Configuration
Registry
Container
Modules
Events
State
```

El Container será una pieza del Runtime, no el Runtime completo.

---

# 231. Principio Rector

> **El Service Container de MEF deberá construir y administrar dependencias de forma explícita, determinista y gobernada, respetando Contracts, Scopes, Lifecycle y límites modulares, sin transformarse en un Service Locator global ni en la fuente de verdad arquitectónica del Framework.**

---

# 232. Conclusión

**ENG-019 — Service Container** define la infraestructura mediante la cual las dependencias descritas en ENG-018 se convierten en Instances utilizables.

La cadena queda:

```text
Contracts
    ↓
Providers
    ↓
Definitions
    ↓
Bindings
    ↓
Dependency Graph
    ↓
Validation
    ↓
Container
    ↓
Resolution
    ↓
Scopes
    ↓
Instances
    ↓
Runtime
```

Y mantiene una separación esencial:

```text
Dependency Injection
→ expresa colaboración

Service Container
→ automatiza composición

Registry
→ mantiene conocimiento

Compatibility
→ valida combinación

State Machine
→ gobierna Lifecycle

Runtime
→ coordina ejecución
```

Así, una clase como:

```text
CreateCustomerHandler
```

podrá declarar:

```text
CT-CUSTOMER-001
EventPublisher
Clock
```

sin saber:

```text
qué Container se usa,
quién registró las implementaciones,
qué Package las proporcionó,
cómo se administran sus Scopes,
ni cómo serán destruidas.
```

Ese conocimiento permanece en la infraestructura de Composition, que es precisamente donde debe vivir.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-012 — Dependency Injection
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-002 — Especificación de Modules
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-022 — Event Bus Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-027 — Runtime Engineering