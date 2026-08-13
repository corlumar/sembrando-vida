---
id: ENG-018
titulo: Dependency Injection
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
  - ENG-001
  - ENG-002
  - ENG-004
  - ENG-005
  - ENG-006
  - ENG-009
  - ENG-011
  - ENG-015
  - ENG-016
  - ARQ-007
  - ARQ-011
  - ARQ-012
  - ARQ-014
relacionados:
  - ENG-019
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
keywords:
  - dependency injection
  - dependencies
  - inversion of control
  - constructor injection
  - contracts
  - composition
  - service container
  - runtime
  - mef
---

# ENG-018

# Dependency Injection

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería para **Dependency Injection (DI)** en **MEF (Modular Enterprise Framework)**.

ENG-018 establece cómo los componentes deberán declarar, recibir y utilizar sus dependencias sin acoplarse innecesariamente a implementaciones concretas.

Su objetivo es permitir:

- sustitución;
- Testing;
- composición;
- modularidad;
- portabilidad;
- control de Lifecycle;
- inversión de dependencias;
- análisis arquitectónico.

---

# 2. Declaración

Una dependencia necesaria para que un componente cumpla su responsabilidad deberá ser explícita.

La regla fundamental será:

> **Un componente no deberá descubrir arbitrariamente sus dependencias; deberá recibirlas mediante un mecanismo de composición gobernado.**

Conceptualmente:

```text
Consumer
   │
   ▼
Contract
   ▲
   │
Implementation
```

y:

```text
Composition Layer
      │
      ├── Consumer
      └── Implementation
```

---

# 3. Dependency Injection

Dependency Injection es el mecanismo mediante el cual una dependencia es proporcionada al componente que la necesita.

Ejemplo conceptual:

```text
CustomerService
      │
      │ requires
      ▼
CustomerRepository
```

La implementación concreta:

```text
MySqlCustomerRepository
```

deberá suministrarse externamente.

---

# 4. Dependency Injection no es Service Container

MEF deberá conservar:

```text
Dependency Injection
        ≠
Service Container
```

DI puede existir sin Container.

Ejemplo:

```text
repository = new MySqlCustomerRepository()

service = new CustomerService(repository)
```

Aquí existe Dependency Injection aunque no exista Container.

---

# 5. Service Container

Un Service Container puede automatizar:

```text
registration
resolution
lifecycle
composition
```

pero pertenece a `ENG-019 — Service Container`.

---

# 6. Inversion of Control

DI constituye una forma de Inversion of Control.

En lugar de:

```text
Consumer
   │
   ▼
construct dependency
```

se utilizará:

```text
Composition
   │
   ├── construct dependency
   └── inject dependency
```

---

# 7. Objetivos

DI deberá:

- hacer visibles las dependencias;
- reducir acoplamiento;
- favorecer Contracts;
- facilitar Testing;
- permitir implementaciones alternativas;
- evitar Service Locator;
- facilitar composición;
- soportar Lifecycle;
- preservar Module boundaries;
- permitir análisis de dependencias.

---

# 8. Dependencia Explícita

Una dependencia deberá poder identificarse mediante la superficie pública del componente cuando sea obligatoria.

Preferido:

```text
CustomerService(
    CustomerRepository repository
)
```

frente a:

```text
CustomerService()
```

que internamente haga:

```text
GlobalContainer.resolve(CustomerRepository)
```

---

# 9. Dependencia Obligatoria

Una dependencia sin la cual el componente no puede cumplir su Contract deberá considerarse obligatoria.

Deberá proporcionarse antes de utilizar el componente.

---

# 10. Dependencia Opcional

Una dependencia opcional deberá declararse explícitamente como tal.

No deberá representarse simplemente mediante:

```text
try resolve dependency
if missing ignore
```

sin Contract.

---

# 11. Optional Dependency Semantics

Una dependencia opcional deberá definir:

- comportamiento cuando existe;
- comportamiento cuando está ausente;
- capacidad degradada si aplica.

---

# 12. Dependency Contract

Los consumidores deberían depender de Contracts cuando exista una abstracción arquitectónica significativa.

Ejemplo:

```text
PaymentService
      │
      ▼
PaymentGateway
```

y no:

```text
PaymentService
      │
      ▼
StripePaymentAdapter
```

salvo que el consumidor requiera deliberadamente Stripe.

---

# 13. Dependency Inversion

La dirección preferida será:

```text
High-Level Policy
        │
        ▼
      Contract
        ▲
        │
Low-Level Implementation
```

Esto evita que la política superior dependa del detalle inferior.

---

# 14. Contracts

ARQ-011 y ENG-021 gobernarán Contracts.

ENG-018 define únicamente cómo dichos Contracts participan como dependencias.

---

# 15. Constructor Injection

MEF favorecerá **Constructor Injection** para dependencias obligatorias.

Conceptualmente:

```text
Component(
  RequiredDependencyA,
  RequiredDependencyB
)
```

Ventajas:

- dependencia visible;
- objeto válido después de construcción;
- Testing sencillo;
- menor estado parcial.

---

# 16. Constructor Completeness

Después de construcción, un componente debería poseer todas sus dependencias obligatorias.

Se evitará:

```text
service = new Service()
service.setRepository(...)
service.setLogger(...)
service.setConfig(...)
```

cuando esas dependencias sean necesarias para que el objeto sea válido.

---

# 17. Method Injection

Podrá utilizarse para una dependencia necesaria únicamente durante una operación concreta.

Ejemplo:

```text
execute(command, transaction)
```

si `transaction` pertenece al contexto de esa ejecución.

---

# 18. Setter Injection

Setter Injection deberá utilizarse con cautela.

Será apropiada principalmente cuando:

- la dependencia sea opcional;
- sea legítimamente mutable;
- el Lifecycle permita reconfiguración.

No deberá utilizarse para ocultar dependencias obligatorias.

---

# 19. Property Injection

La inyección directa de propiedades debería evitarse como mecanismo universal.

Puede producir:

- dependencias invisibles;
- objetos parcialmente inicializados;
- acoplamiento al framework;
- Testing más difícil.

---

# 20. Injection Preference

Orden recomendado:

```text
1. Constructor Injection
2. Method Injection
3. Explicit Setter Injection
4. Property Injection only when justified
```

---

# 21. Service Locator

MEF deberá evitar el patrón Service Locator dentro de lógica funcional.

Ejemplo a evitar:

```text
container.get(CustomerRepository)
```

desde cualquier Service.

---

# 22. Razón

Service Locator convierte:

```text
dependency
```

en:

```text
hidden runtime lookup
```

y dificulta:

- Testing;
- análisis;
- comprensión;
- refactorización.

---

# 23. Container Boundary

El Container podrá utilizarse dentro de la Composition Layer.

No deberá convertirse en dependencia universal de todos los componentes.

---

# 24. Composition Root

MEF deberá reconocer conceptualmente un **Composition Root**.

Es el lugar donde:

```text
implementations
+
configuration
+
lifecycle
```

se unen para construir el grafo de objetos.

---

# 25. Composition Root Responsibilities

Podrá:

- registrar bindings;
- seleccionar implementaciones;
- construir componentes;
- aplicar Configuration;
- conectar Providers;
- preparar Runtime.

No deberá contener lógica de negocio.

---

# 26. Composition Root Location

La ubicación concreta dependerá del Implementation Profile.

Conceptualmente deberá permanecer cerca de Bootstrap.

---

# 27. Bootstrap Integration

ARQ-014 deberá utilizar Composition antes de activar componentes.

Ejemplo:

```text
Configuration
    ↓
Registration
    ↓
Composition
    ↓
Resolution
    ↓
Initialization
    ↓
Activation
```

---

# 28. Dependency Graph

Las dependencias explícitas forman:

```text
Dependency Graph
```

Ejemplo:

```text
Controller
   ↓
Service
   ↓
Repository
   ↓
Storage Contract
```

---

# 29. Graph Validation

El grafo deberá poder validarse antes de Runtime cuando sea razonable.

Podrán detectarse:

- missing dependencies;
- cycles;
- ambiguity;
- invalid scope;
- forbidden dependency direction.

---

# 30. Missing Dependency

Una dependencia obligatoria no resuelta deberá producir fallo explícito.

Ejemplo:

```text
MEF-DI-001
Required dependency not resolved.
```

---

# 31. Ambiguous Dependency

Si existen múltiples implementaciones y no existe regla de selección:

```text
PaymentGateway
   ├── Stripe
   └── Adyen
```

el sistema no deberá escoger arbitrariamente una.

---

# 32. Explicit Selection

La selección podrá realizarse mediante:

- Configuration;
- qualifier;
- binding;
- Provider;
- capability;
- Policy.

La técnica concreta pertenecerá a ENG-019.

---

# 33. Circular Dependency

Ejemplo:

```text
A → B
B → A
```

deberá detectarse cuando la plataforma pueda hacerlo.

---

# 34. Circular Dependency Policy

Los ciclos deberán evitarse.

Un ciclo puede indicar:

- responsabilidades mezcladas;
- Contract incorrecto;
- Lifecycle defectuoso.

No deberá resolverse automáticamente mediante hacks de inicialización tardía sin justificación.

---

# 35. Lazy Dependency

Una dependencia podrá resolverse de forma lazy cuando exista necesidad real.

Ejemplo:

```text
Lazy<ExpensiveService>
```

conceptualmente.

---

# 36. Lazy Does Not Hide Dependency

Aunque sea lazy, deberá continuar siendo explícita.

---

# 37. Factory Dependency

Cuando un consumidor necesite crear múltiples instancias podrá recibir una Factory.

Ejemplo:

```text
ConnectionFactory
```

en lugar de Container.

---

# 38. Provider Dependency

Un Provider podrá utilizarse cuando sea necesario resolver una dependencia dinámicamente.

Deberá ser un Contract específico.

Evitar:

```text
GenericContainerProvider
```

que reintroduzca Service Locator.

---

# 39. Collections

Un consumidor podrá recibir múltiples implementaciones.

Ejemplo:

```text
validators: Validator[]
```

La colección deberá tener orden y semántica explícitos cuando sean relevantes.

---

# 40. Ordered Dependencies

Si el orden afecta comportamiento deberá declararse.

No deberá depender del orden accidental de Registration.

---

# 41. Decorators

DI podrá utilizar Decorators.

Ejemplo:

```text
CustomerRepository
       ▲
       │
CachingCustomerRepository
       ▲
       │
MySqlCustomerRepository
```

La composición deberá ser explícita.

---

# 42. Middleware Composition

Las cadenas de Middleware podrán construirse mediante DI.

El orden deberá ser determinista.

---

# 43. Adapter Injection

Los Adapters deberán inyectarse mediante Contracts cuando corresponda.

Ejemplo:

```text
Storage
   ▲
   │
S3StorageAdapter
```

---

# 44. Infrastructure Isolation

La lógica de Domain/Application no deberá construir directamente infraestructura concreta cuando exista una frontera contractual.

---

# 45. Module Boundary

Un Module no deberá inyectar componentes internos de otro Module.

Deberá depender de:

```text
Public Contract
```

o capacidad oficialmente expuesta.

---

# 46. Internal Dependency

Dentro del mismo Module podrán existir dependencias internas no publicadas.

Estas deberán respetar su organización interna.

---

# 47. Cross-Module Dependency

Ejemplo válido:

```text
MOD-CRM
   │
   ▼
CT-IDENTITY-001
   ▲
   │
MOD-IDENTITY
```

No:

```text
MOD-CRM
   ↓
IdentityInternalRepository
```

---

# 48. Correction of Contract Prefix

Los Contracts de MEF deberán utilizar el prefijo canónico definido en ENG-005:

```text
CT
```

Ejemplos:

```text
CT-IDENTITY-001
CT-PAYMENT-001
CT-CUSTOMER-001
```

No deberán introducirse nuevos prefijos alternativos para el mismo tipo de activo.

---

# 49. Dependency Declaration in Manifest

Las dependencias arquitectónicas de Module/Package deberán declararse también en Manifest cuando ENG-003 lo requiera.

La dependencia de objetos en código y la dependencia arquitectónica deberán ser coherentes.

---

# 50. Code vs Manifest

Ejemplo:

```text
Code:
CrmService requires IdentityContract
```

pero Manifest no declara Identity.

Esto deberá poder detectarse como inconsistencia cuando tooling tenga información suficiente.

---

# 51. Dependency Traceability

Idealmente deberá poder responderse:

```text
Why does MOD-CRM depend on MOD-IDENTITY?
```

con trazabilidad:

```text
CrmService
   ↓
CT-IDENTITY-001
   ↓
MOD-IDENTITY
```

---

# 52. Required vs Provided

MEF deberá distinguir:

```text
requires
provides
```

Ejemplo:

```text
MOD-CRM
requires CT-IDENTITY-001

MOD-IDENTITY
provides CT-IDENTITY-001
```

---

# 53. Compatibility Integration

ENG-016 deberá validar que la implementación proporcionada satisface:

- Contract ID;
- versión;
- capability;
- Compatibility.

---

# 54. State Machine Integration

Una dependencia no deberá inyectarse como activa cuando su Lifecycle State sea incompatible con el consumidor si la dependencia requiere estado operativo.

---

# 55. Construction vs Activation

Debe distinguirse:

```text
dependency can be constructed
```

de:

```text
dependency can be used now
```

ENG-015 gobernará Activation.

---

# 56. Lifecycle Scope

Las dependencias podrán tener Scopes.

Ejemplos conceptuales:

```text
Singleton
Application
Request
Operation
Transient
Module
```

La taxonomía definitiva corresponderá a ENG-019.

---

# 57. Scope Compatibility

Un componente de vida larga no deberá depender directamente de una instancia de vida más corta cuando esto provoque captura inválida.

Ejemplo problemático:

```text
Singleton
   ↓
RequestScopedObject
```

---

# 58. Captive Dependency

El caso anterior se denomina conceptualmente:

```text
Captive Dependency
```

y deberá poder detectarse cuando sea posible.

---

# 59. Scope Ownership

El componente que crea un Scope deberá controlar su Lifecycle.

---

# 60. Disposal

Las dependencias que posean recursos deberán liberarse conforme a su Scope.

Ejemplos:

- conexión;
- file handle;
- stream;
- lock;
- session.

---

# 61. Ownership of Dependencies

El consumidor no deberá destruir una dependencia que no posee.

La Composition Layer o Scope correspondiente será responsable cuando aplique.

---

# 62. Shared Dependency

Una dependencia compartida deberá tratarse de acuerdo con su Lifecycle.

---

# 63. Thread / Concurrency Safety

Si una dependencia se comparte entre ejecuciones concurrentes deberá ser segura para ese Scope o protegerse adecuadamente.

---

# 64. Mutable Singleton

Los Singleton mutables deberán utilizarse con cautela.

Podrán producir:

- race conditions;
- contaminación entre requests;
- Tests frágiles;
- estado oculto.

---

# 65. Stateless Components

Los Services compartidos deberían favorecer diseño stateless cuando sea razonable.

---

# 66. Configuration Injection

ENG-011 deberá favorecer Typed Configuration.

Ejemplo:

```text
PaymentConfiguration
```

podrá inyectarse directamente.

Evitar:

```text
GlobalConfig
```

cuando el componente necesita únicamente tres propiedades.

---

# 67. Logger Injection

ENG-010 podrá proporcionar Logger mediante DI.

El componente deberá depender del Contract de Logging y no del proveedor concreto.

---

# 68. Clock Injection

ENG-009 recomienda una abstracción de Clock para Testing.

DI será el mecanismo natural para suministrar:

```text
SystemClock
```

o:

```text
FakeClock
```

---

# 69. Security Dependencies

Las capacidades de Security deberán inyectarse mediante Contracts apropiados cuando corresponda.

No deberán accederse mediante singletons globales arbitrarios.

---

# 70. Event Bus Injection

ARQ-008 podrá proporcionar Event Bus mediante Contract.

Los componentes que publiquen Events podrán recibir:

```text
EventPublisher
```

en lugar de una referencia completa a infraestructura innecesaria.

---

# 71. Narrow Contracts

Los consumidores deberían recibir el Contract más pequeño que satisfaga su necesidad.

Preferido:

```text
EventPublisher
```

frente a:

```text
FullEventBusAdministrationService
```

cuando solo necesita publicar.

---

# 72. Interface Segregation

DI deberá favorecer Contracts pequeños y coherentes.

Las dependencias excesivamente amplias aumentan acoplamiento.

---

# 73. Dependency Count

Un constructor con demasiadas dependencias puede señalar demasiadas responsabilidades.

No deberá imponerse un número universal.

Sin embargo, tooling podrá advertir sobre casos extremos.

---

# 74. Constructor Explosion

Ejemplo:

```text
Service(
  A,
  B,
  C,
  D,
  E,
  F,
  G,
  H,
  I,
  J
)
```

deberá motivar revisión de diseño antes de recurrir a Container injection.

---

# 75. Dependency Object

No deberá solucionarse Constructor Explosion creando:

```text
ServiceDependencies
```

como bolsa genérica si solo oculta las mismas dependencias.

---

# 76. Facade

Cuando múltiples dependencias representan una capacidad coherente podrá introducirse un Contract superior legítimo.

---

# 77. Dependency Classification

Las dependencias podrán clasificarse como:

```text
Business Contract
Technical Contract
Configuration
Runtime Capability
Context Dependency
```

Esto facilita análisis.

---

# 78. Context Dependency

Información como:

```text
Current User
Current Request
Correlation ID
```

no deberá convertirse indiscriminadamente en Singleton.

Deberá utilizar Scope apropiado.

---

# 79. Ambient Context

MEF deberá evitar dependencias ambientales ocultas como:

```text
global current user
global request
global transaction
```

cuando puedan modelarse explícitamente.

---

# 80. Environment Access

Los componentes no deberían leer directamente Environment Variables si Configuration ya las resolvió.

Preferido:

```text
Configuration → inject value/object
```

frente a:

```text
component → getenv()
```

---

# 81. Filesystem Access

La lógica funcional no deberá construir directamente Filesystem adapters cuando deba ser sustituible.

---

# 82. Network Access

Lo mismo aplica a clientes HTTP, queues y sistemas externos.

---

# 83. Database Access

El acceso a datos debería proporcionarse mediante Contracts apropiados.

No deberá utilizarse un Database global como dependencia implícita universal.

---

# 84. Static Methods

Los métodos estáticos que acceden a dependencias globales deberán evitarse cuando oculten composición.

---

# 85. Global Singletons

Se evitarán:

```text
Database::instance()
Logger::global()
Container::instance()
Config::global()
```

como patrón arquitectónico ordinario.

---

# 86. Pure Functions

Las funciones puras no necesitan DI si todas sus entradas ya están expresadas en argumentos.

No deberá introducirse DI innecesariamente.

---

# 87. Value Objects

Los Value Objects normalmente deberán construirse directamente.

No deberán registrarse en Container únicamente porque existen como clases.

---

# 88. Entities

Las Entities tampoco deberán resolverse automáticamente desde Container.

Su construcción pertenece al Domain o Factory apropiado.

---

# 89. Container-Managed Components

Normalmente podrán ser gestionados:

```text
Services
Repositories
Adapters
Providers
Infrastructure Services
Factories
Policies
```

según perfil.

---

# 90. Non-Managed Objects

Normalmente:

```text
DTO
Entity
Value Object
Command
Query
Event
```

no deberán depender del Container para existir.

---

# 91. Commands

Los Commands deberán transportar intención/datos.

No deberían contener dependencias inyectadas de infraestructura.

---

# 92. Queries

Las Queries deberán representar solicitudes.

Las dependencias corresponden a Handlers o Services que las procesan.

---

# 93. Events

Los Events representan hechos.

No deberán contener referencias a Services o Container.

---

# 94. Handler Injection

Handlers podrán recibir sus dependencias mediante Constructor Injection.

Ejemplo:

```text
CreateCustomerHandler(
  CustomerRepository,
  EventPublisher
)
```

---

# 95. Provider Registration

Providers podrán declarar bindings durante Composition.

No deberán resolver dependencias para ejecutar lógica funcional durante Registration salvo necesidad de Bootstrap explícita.

---

# 96. Registration Phase

Conceptualmente:

```text
Provider
   ↓
register definitions
```

No:

```text
Provider
   ↓
execute business process
```

---

# 97. Resolution Phase

La construcción real podrá ocurrir posteriormente según Scope.

---

# 98. Eager Resolution

Algunos componentes críticos podrán resolverse durante Bootstrap para Fail Fast.

---

# 99. Lazy Resolution

Otros podrán resolverse al primer uso.

La política deberá ser explícita.

---

# 100. Eager vs Lazy

La elección deberá considerar:

```text
startup validation
performance
resource cost
failure timing
```

---

# 101. Fail Fast

Las dependencias obligatorias estructuralmente inválidas deberían detectarse antes de llegar a Runtime normal.

---

# 102. Dependency Validation Phase

Conceptualmente:

```text
Registration
    ↓
Graph Build
    ↓
Graph Validation
    ↓
Resolution
    ↓
Runtime
```

---

# 103. Autowiring

Un Implementation Profile podrá soportar Autowiring.

No será un requisito universal.

---

# 104. Autowiring Rule

Autowiring deberá utilizar metadata explícita del lenguaje cuando sea inequívoca.

No deberá depender excesivamente de heurísticas mágicas.

---

# 105. Ambiguous Autowiring

Ante múltiples Candidates deberá fallar o requerir configuración explícita.

---

# 106. Reflection

Los perfiles podrán utilizar Reflection.

MEF no dependerá universalmente de ella.

---

# 107. Attributes / Annotations

Podrán utilizarse para metadata.

No deberán convertir las clases de Domain en dependientes de infraestructura cuando pueda evitarse.

---

# 108. Generated DI

Los perfiles podrán generar composición estática.

Ejemplo conceptual:

```text
Definitions
   ↓
Generator
   ↓
Compiled Dependency Graph
```

---

# 109. Compile-Time DI

Podrá utilizarse para:

- rendimiento;
- validación temprana;
- reducción de Reflection.

---

# 110. Runtime DI

También podrá utilizarse resolución dinámica.

Ambas estrategias deberán respetar las mismas reglas conceptuales.

---

# 111. Static Composition

Una implementación podrá escribir Composition explícitamente sin Container.

Esto continúa siendo conforme con ENG-018.

---

# 112. Manual DI

Ejemplo:

```text
repository = new Repository(...)
service = new Service(repository)
controller = new Controller(service)
```

es una implementación válida.

---

# 113. Service Container Optionality

MEF podrá proporcionar Service Container como infraestructura oficial.

Sin embargo:

> **Los componentes correctamente diseñados no deberán necesitar saber que dicho Container existe.**

---

# 114. Testing

DI deberá facilitar reemplazar implementaciones.

Ejemplo:

```text
Production:
CustomerRepository → MySqlCustomerRepository

Test:
CustomerRepository → InMemoryCustomerRepository
```

---

# 115. Test Composition

Los Tests deberán poder construir componentes sin arrancar todo el Framework cuando no sea necesario.

---

# 116. Container-Free Unit Testing

Las Unit Tests deberían favorecer construcción directa.

Ejemplo:

```text
service = CustomerService(fakeRepository)
```

en lugar de inicializar Container completo.

---

# 117. Integration Testing

Las Integration Tests podrán utilizar el Container real para validar Composition.

---

# 118. DI Contract Tests

Podrán verificarse diferentes implementaciones bajo el mismo Contract.

---

# 119. Architecture Tests

ENG-009 deberá poder verificar reglas como:

```text
Domain does not resolve from Container
Modules do not inject internals of other Modules
No global Container access
Required dependencies are explicit
```

cuando el lenguaje lo permita.

---

# 120. Dependency Graph Tests

Podrán detectar:

```text
cycles
missing bindings
scope violations
forbidden dependencies
```

---

# 121. Composition Tests

Debería existir una prueba capaz de construir el grafo requerido por una Application.

Ejemplo conceptual:

```text
ApplicationCompositionTest
```

---

# 122. Bootstrap Test

Podrá verificar que todos los componentes obligatorios puedan resolverse antes de Runtime.

---

# 123. Replacement Test

Cuando un Contract prometa sustituibilidad podrá probarse:

```text
Implementation A
Implementation B
```

dentro de la misma Composition.

---

# 124. Logging

Los fallos de DI podrán registrarse conforme ENG-010.

Ejemplos:

```text
dependency.resolution.failed
dependency.cycle.detected
dependency.scope.invalid
```

---

# 125. Sensitive Data

Los errores de resolución no deberán imprimir Secrets contenidos en Configuration.

---

# 126. Diagnostics

El sistema debería poder explicar una ruta de resolución.

Ejemplo:

```text
Unable to resolve CustomerController

CustomerController
  requires CustomerService

CustomerService
  requires CustomerRepository

CustomerRepository
  has no binding
```

---

# 127. Resolution Path

La ruta deberá ser visible para facilitar diagnóstico.

---

# 128. Error Taxonomy

Taxonomía conceptual:

```text
MEF-DI-001 Missing dependency
MEF-DI-002 Ambiguous dependency
MEF-DI-003 Circular dependency
MEF-DI-004 Invalid dependency scope
MEF-DI-005 Forbidden dependency
MEF-DI-006 Resolution failed
MEF-DI-007 Invalid binding
MEF-DI-008 Incompatible implementation
MEF-DI-009 Captive dependency
MEF-DI-010 Dependency lifecycle error
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 129. Missing Dependency Diagnostic

Ejemplo:

```text
MEF-DI-001

Required dependency could not be resolved.

Consumer:
CreateCustomerHandler

Required:
CT-CUSTOMER-001

Resolution path:
CustomerController
→ CreateCustomerHandler
→ CT-CUSTOMER-001

Available implementations:
none
```

---

# 130. Ambiguity Diagnostic

Ejemplo:

```text
MEF-DI-002

Multiple implementations found.

Contract:
CT-PAYMENT-001

Candidates:
StripePaymentAdapter
AdyenPaymentAdapter

Resolution requires explicit selection.
```

---

# 131. Circular Dependency Diagnostic

Ejemplo:

```text
MEF-DI-003

Circular dependency detected.

A
→ B
→ C
→ A
```

---

# 132. Compatibility Failure

ENG-016 deberá poder impedir Binding cuando la implementación no satisfaga la versión requerida del Contract.

---

# 133. Dependency Metadata

Un Binding podrá poseer metadata:

```text
Contract
Implementation
Scope
Qualifier
Priority
Lifecycle
Compatibility
```

La estructura concreta pertenecerá a ENG-019.

---

# 134. Qualifier

Cuando varias implementaciones válidas existan podrá utilizarse un identificador explícito.

Ejemplo conceptual:

```text
CT-STORAGE-001
qualifier: primary
```

---

# 135. Named Dependency

Los nombres deberán utilizarse únicamente cuando el Contract no sea suficiente para distinguir implementaciones.

---

# 136. Magic Strings

Los Qualifiers deberían utilizar valores gobernados o tipados cuando el lenguaje lo permita.

---

# 137. Default Binding

Podrá existir una implementación por defecto.

La regla deberá ser explícita.

---

# 138. Override

Un Binding podrá sobrescribirse en scopes o entornos autorizados.

Ejemplo:

```text
Production → S3Storage
Test       → InMemoryStorage
```

---

# 139. Override Precedence

La precedencia deberá ser determinista.

---

# 140. Module Overrides

Un Module no deberá sobrescribir arbitrariamente bindings globales pertenecientes a otro Module.

---

# 141. Extension Overrides

Las Extensions deberán utilizar Extension Points oficiales para modificar Composition cuando esté permitido.

---

# 142. Security

Bindings sensibles deberán respetar Security Policy.

Ejemplo:

```text
AuthenticationProvider
```

no deberá poder sustituirse por cualquier Package sin controles.

---

# 143. Trusted Implementation

Policy podrá requerir que determinadas implementaciones provengan de:

```text
trusted Package
approved Publisher
signed Artifact
```

---

# 144. Capability Permission

Una implementación podrá requerir capacidades para operar.

Compatibility y Security deberán validarlas antes de Activation.

---

# 145. Runtime Replacement

Cambiar una implementación durante Runtime será una capacidad avanzada.

No deberá asumirse universalmente.

---

# 146. Static Binding

La mayoría de bindings deberían permanecer estables después de Composition.

---

# 147. Dynamic Binding

Cuando exista, deberá utilizar un mecanismo gobernado.

---

# 148. Dynamic Replacement Safety

Antes de reemplazar una dependencia activa deberán considerarse:

```text
Lifecycle
state
in-flight operations
compatibility
resource disposal
```

---

# 149. Hot Swap

Hot Swap no forma parte del requisito mínimo de DI.

---

# 150. Dependency State

Una Dependency Definition deberá mantenerse separada del objeto resuelto.

Conceptualmente:

```text
Definition
≠
Instance
```

---

# 151. Definition

Describe cómo obtener una dependencia.

---

# 152. Instance

Es el objeto real producido conforme a Definition y Scope.

---

# 153. Binding

Relaciona:

```text
Contract
→ Implementation Definition
```

---

# 154. Resolution

Transforma una Dependency Request en Instance.

---

# 155. Dependency Request

Podrá contener:

```text
Contract
Qualifier
Required Version
Scope
Consumer
```

---

# 156. Resolution Context

Podrá contener:

```text
current scope
module
application
runtime
```

---

# 157. Resolution Must Not Become Global Context

El Resolution Context no deberá utilizarse como bolsa genérica accesible a lógica de negocio.

---

# 158. Dependency Resolution Result

Deberá poder distinguir:

```text
Resolved
Missing
Ambiguous
Incompatible
ScopeViolation
Failed
```

---

# 159. Determinism

Dado el mismo:

```text
Dependency Graph
Configuration
Context
```

la resolución deberá ser determinista.

---

# 160. Resolution Priority

La selección no deberá depender accidentalmente del orden de carga de archivos.

---

# 161. Registration Ordering

Los Providers podrán registrarse en distinto orden.

Esto no deberá cambiar el resultado cuando las definiciones no declaren prioridad.

---

# 162. Priority

Si se utiliza Priority deberá ser explícita y restringida.

No deberá convertirse en mecanismo para resolver todo tipo de conflicto.

---

# 163. Dependency Graph as Data

El grafo debería poder inspeccionarse mediante tooling.

---

# 164. CLI Inspection

ENG-007 podrá incorporar en el futuro:

```text
mef dependency graph
mef dependency inspect
mef dependency why
```

o integrarlo dentro de Architecture tooling.

---

# 165. `dependency why`

Podrá responder:

```text
Why is CT-IDENTITY-001 required?
```

---

# 166. Graph Output

Podrá generar:

```text
MOD-CRM
  ↓
CustomerService
  ↓
CT-IDENTITY-001
  ↓
IdentityAdapter
```

---

# 167. Machine Output

El grafo deberá ser exportable de manera estructurada cuando se utilice para análisis.

---

# 168. Architecture Integration

Dependency Graph deberá poder relacionarse con Architecture Graph.

---

# 169. Code Dependency vs Architectural Dependency

No toda dependencia entre clases constituye dependencia arquitectónica entre Modules.

Tooling deberá distinguir ambas cuando sea posible.

---

# 170. Dependency Direction

Las reglas de Arquitectura tendrán precedencia sobre la conveniencia del Container.

El Container no deberá permitir dependencias prohibidas solo porque puede resolverlas.

---

# 171. Core Dependency

Core deberá continuar respetando los límites definidos en ARQ.

DI no deberá utilizarse como forma de esconder una dependencia arquitectónicamente inválida.

---

# 172. Abstraction Does Not Automatically Fix Architecture

Ejemplo:

```text
Core → BadContract → Business Module
```

sigue pudiendo ser una dependencia inválida aunque exista una interfaz.

---

# 173. Contract Ownership

La ubicación y ownership del Contract deberán respetar Architecture.

---

# 174. Stable Dependencies

Los componentes estables deberían depender de abstracciones igualmente estables cuando corresponda.

---

# 175. Dependency Volatility

Una implementación volátil debería aislarse detrás de Contract si su sustitución o variabilidad es relevante.

---

# 176. No Interface for Everything

MEF no exigirá crear Contract para cada clase.

La abstracción deberá existir cuando proporcione valor arquitectónico.

---

# 177. Concrete Dependency

Una clase podrá depender directamente de otra clase concreta cuando:

- pertenezcan al mismo límite;
- no exista necesidad de sustitución;
- no rompa Architecture;
- el acoplamiento sea intencional.

---

# 178. Over-Abstraction

Deberá evitarse:

```text
Foo
FooInterface
FooImpl
```

únicamente por seguir una regla mecánica.

---

# 179. Stable Contract Boundary

Los Contracts son especialmente apropiados para:

```text
cross-module
external systems
infrastructure
test seams
public extension points
```

---

# 180. Dependency Injection Security

DI puede convertirse en una superficie de ataque si Packages no confiables pueden registrar implementaciones arbitrarias.

---

# 181. Binding Authorization

Los bindings de capacidades sensibles deberán controlarse.

---

# 182. Registration Source

Deberá poder conocerse qué Package o Provider registró una implementación cuando sea relevante.

---

# 183. Binding Provenance

Conceptualmente:

```text
Binding
├── Contract
├── Implementation
├── Provider
├── Package
└── Trust Metadata
```

---

# 184. Untrusted Override

Un Package no confiable no deberá reemplazar silenciosamente:

```text
SecurityService
AuthenticationProvider
SignatureVerifier
```

u otros Contracts protegidos.

---

# 185. Protected Bindings

MEF podrá definir bindings:

```text
protected
sealed
restricted
```

según ENG-019/ENG-024.

---

# 186. Resolution Logging

La resolución normal de cada dependencia no debería producir INFO excesivo.

Podrá utilizarse:

```text
TRACE
DEBUG
```

para diagnóstico profundo.

---

# 187. Resolution Performance

El mecanismo de DI deberá evitar resolver repetidamente dependencias compartidas cuando su Scope no lo requiera.

---

# 188. Compiled Graph

Un Container futuro podrá compilar el grafo para mejorar:

- startup;
- resolución;
- validación.

---

# 189. Runtime Reflection Cost

Los perfiles basados en Reflection deberán considerar cache o compilación cuando sea necesario.

---

# 190. Startup Validation

Un modo Production debería favorecer validación anticipada del grafo.

---

# 191. Development Diagnostics

Development podrá proporcionar diagnósticos adicionales.

No deberá cambiar la semántica de resolución.

---

# 192. Dependency Cache

El cache de resolución deberá respetar Scopes.

No deberá convertir accidentalmente un Transient en Singleton.

---

# 193. Scope Cache

Cada Scope deberá administrar su propio conjunto de instancias cuando corresponda.

---

# 194. Error Recovery

Un fallo al construir una dependencia no deberá dejar una instancia parcialmente registrada como válida.

---

# 195. Construction Failure

El resultado deberá propagarse como fallo de Resolution.

---

# 196. Partial Graph

El sistema no deberá considerar válido un grafo obligatorio parcialmente resoluble.

---

# 197. Optional Graph Branch

Las ramas correspondientes exclusivamente a capacidades opcionales podrán permanecer no resueltas si la arquitectura lo permite.

---

# 198. State Machine Guard

Antes de `Active`, el Module deberá haber superado la validación de dependencias obligatorias.

---

# 199. Dependency Readiness

Dependencia resuelta y dependencia Ready pueden ser conceptos diferentes.

---

# 200. Health Integration

ENG-028 podrá posteriormente evaluar el estado operacional de dependencias.

DI no deberá asumir que una instancia resuelta está saludable.

---

# 201. Dependency Documentation

Los componentes públicos deberán documentar sus dependencias obligatorias cuando no sean inferibles automáticamente.

---

# 202. Generated Documentation

Tooling podrá generar parte de la documentación desde:

```text
Manifest
Contracts
Dependency Graph
```

---

# 203. Dependency Report

Podrá producirse:

```text
Required
Provided
Resolved
Unresolved
Optional
Incompatible
```

---

# 204. CI Integration

El Dependency Graph deberá poder validarse en CI.

---

# 205. Dependency Quality Gate

Podrá fallar por:

```text
cycle
missing binding
forbidden dependency
scope violation
incompatible Contract
```

---

# 206. Release Integration

Una Release no deberá declarar Compatibility válida si sus dependencias obligatorias no pueden satisfacerse bajo la Matrix soportada.

---

# 207. Package Integration

ENG-013 resuelve Packages.

ENG-018 resuelve dependencias de componentes.

No deberán confundirse.

---

# 208. Package Dependency vs Object Dependency

```text
Package Dependency
→ distribución

Component Dependency
→ composición Runtime
```

Pueden estar relacionadas.

No son la misma capa.

---

# 209. Example

```text
PKG-CRM
depends on
PKG-IDENTITY
```

permite que Runtime disponga de:

```text
MOD-IDENTITY
provides
CT-IDENTITY-001
```

que posteriormente puede inyectarse en:

```text
CrmService
```

---

# 210. Full Chain

```text
Package Dependency
        ↓
Package Manager
        ↓
Installed Package
        ↓
Manifest
        ↓
Module Discovery
        ↓
Contract Registration
        ↓
Dependency Graph
        ↓
Dependency Injection
        ↓
Runtime Composition
```

---

# 211. Dependency Definition Lifecycle

Conceptualmente:

```text
Declared
   ↓
Registered
   ↓
Validated
   ↓
Resolvable
   ↓
Resolved
```

No es necesario modelarlo como State Machine formal en la primera implementación.

---

# 212. Binding State

ENG-019 podrá formalizar estados si resulta necesario.

---

# 213. Implementation Independence

MEF no deberá depender universalmente de:

```text
Laravel Container
Symfony DI
Spring
Guice
.NET DI
NestJS
Inversify
```

Estos podrán ser adapters o Implementation Profiles.

---

# 214. Profile Mapping

Ejemplo:

```text
MEF DI Concepts
      │
      ├── PHP Container
      ├── Spring
      ├── .NET ServiceProvider
      └── TypeScript Container
```

La semántica deberá preservarse.

---

# 215. Minimal Implementation

La primera implementación puede ser muy simple:

```text
bindings
+
factories
+
constructor injection
+
singleton/transient
+
graph validation
```

No se necesita inicialmente un Container sofisticado.

---

# 216. First Runtime Goal

El objetivo de la primera versión será poder componer:

```text
Kernel
Registry
Configuration
Event Bus
Modules
Adapters
```

sin dependencias globales ocultas.

---

# 217. Invariantes de Ingeniería

ENG-018 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-306 | Las dependencias obligatorias de un componente deberán ser explícitas cuando formen parte de su construcción o comportamiento esencial. |
| EI-307 | Dependency Injection y Service Container deberán mantenerse como conceptos distintos. |
| EI-308 | Las dependencias obligatorias deberán favorecer Constructor Injection cuando el Implementation Profile lo permita razonablemente. |
| EI-309 | La lógica funcional no deberá utilizar Service Locator como mecanismo ordinario de resolución. |
| EI-310 | Los consumidores deberán depender de Contracts cuando exista una frontera arquitectónica que requiera sustituibilidad o desacoplamiento. |
| EI-311 | Los Modules no deberán inyectar APIs internas de otros Modules fuera de los mecanismos públicos permitidos. |
| EI-312 | Las dependencias circulares deberán detectarse y rechazarse cuando no estén explícitamente soportadas por un modelo válido. |
| EI-313 | La resolución ambigua no deberá seleccionar una implementación arbitrariamente. |
| EI-314 | Una dependencia obligatoria no resuelta deberá impedir la composición válida del consumidor. |
| EI-315 | La ausencia de una dependencia opcional deberá poseer semántica explícita. |
| EI-316 | Los componentes no deberán depender del Container únicamente para acceder a dependencias que podrían recibirse explícitamente. |
| EI-317 | Entities, Value Objects, Commands, Queries y Events no deberán requerir el Container como condición ordinaria de existencia. |
| EI-318 | Los Scopes de dependencias deberán respetar Lifecycle y evitar Captive Dependencies conocidas. |
| EI-319 | El propietario de un Scope deberá controlar el Lifecycle de las instancias que administra cuando corresponda. |
| EI-320 | La Configuration deberá inyectarse mediante superficies limitadas cuando sea razonable y no como bolsa global mutable. |
| EI-321 | La resolución de dependencias no deberá violar las direcciones de dependencia definidas por Architecture. |
| EI-322 | La existencia de una interfaz no convierte automáticamente una dependencia arquitectónicamente inválida en válida. |
| EI-323 | Los bindings de capacidades sensibles deberán poder someterse a Policy y controles de confianza. |
| EI-324 | El Dependency Graph deberá ser determinista para las mismas definiciones, Configuration y Context gobernados. |
| EI-325 | Las dependencias obligatorias necesarias para Activation deberán validarse antes de que el componente alcance `Active`. |

---

# 218. Criterios de Conformidad

Una implementación será conforme con ENG-018 cuando:

- declare dependencias obligatorias;
- favorezca Constructor Injection;
- evite Service Locator;
- utilice Contracts en fronteras relevantes;
- preserve Module boundaries;
- detecte Missing Dependencies;
- detecte Ambiguity;
- detecte Cycles;
- gestione dependencias opcionales;
- respete Scopes;
- controle Lifecycle;
- facilite Testing;
- permita Composition sin globals;
- respete Compatibility;
- respete Architectural State;
- proteja bindings sensibles;
- mantenga independencia tecnológica.

---

# 219. Riesgos

Deberán evitarse especialmente:

## Service Locator

```text
container.get(...)
```

desde cualquier componente.

## Hidden Dependency

Un Service parece independiente pero internamente resuelve todo desde globals.

## Container Everywhere

Todo objeto recibe Container en lugar de sus dependencias.

## Interface Explosion

Crear interfaces sin valor arquitectónico.

## Circular Composition

A depende de B, B depende de A.

## Ambiguous Binding

Varias implementaciones y ninguna regla explícita de selección.

## Captive Dependency

Un componente de Scope largo captura una instancia de Scope corto.

## Global Mutable Services

Singletons mutables compartidos indiscriminadamente.

## Cross-Module Internals

Inyectar clases privadas de otro Module.

## Package/Object Confusion

Confundir Package Dependency con Runtime Dependency.

## DI as Security Bypass

Permitir que cualquier Package sustituya capacidades sensibles.

## Framework Lock-in

Acoplar componentes al Container de una tecnología concreta.

---

# 220. Arquitectura Recomendada

```text
                    COMPOSITION ROOT
                          │
             ┌────────────┼────────────┐
             ▼            ▼            ▼
         Providers    Configuration   Registry
             │            │            │
             └────────────┼────────────┘
                          ▼
                 Dependency Definitions
                          │
                          ▼
                   Dependency Graph
                          │
                          ▼
                   Graph Validation
                          │
             ┌────────────┼────────────┐
             ▼            ▼            ▼
          Missing      Ambiguous      Cycles
             │            │            │
             └───────FAIL─┴────FAIL────┘
                          │
                          ▼
                       Resolve
                          │
                          ▼
                Construct Components
                          │
                          ▼
                  Lifecycle Guards
                          │
                          ▼
                       Runtime
```

---

# 221. Primera Implementación Recomendada

La primera implementación debería soportar:

```text
Constructor Injection
Explicit Bindings
Contract → Implementation
Singleton Scope
Transient Scope
Factory Bindings
Graph Validation
Circular Dependency Detection
Missing Dependency Detection
Ambiguous Dependency Detection
```

Sin introducir todavía:

```text
hot swap
distributed container
complex scopes
automatic interception
runtime rebinding
```

---

# 222. Segunda Fase

Podrá incorporar:

```text
Module Scope
Request Scope
Operation Scope
Compiled Container
Qualifiers
Decorators
Binding Provenance
Protected Bindings
```

---

# 223. Tercera Fase

Podrá incorporar:

```text
dynamic composition
advanced policy
distributed scopes
runtime reconciliation
dependency visualization
formal graph analysis
```

únicamente si aportan valor real.

---

# 224. Relación con ENG-019

ENG-018 define:

```text
What Dependency Injection means
and which rules it must preserve
```

ENG-019 definirá:

```text
How MEF's Service Container
registers, scopes, resolves,
builds and disposes dependencies
```

Por tanto:

```text
ENG-018
Dependency Injection
      │
      ▼
ENG-019
Service Container
```

---

# 225. Relación con ENG-020

ENG-020 deberá definir cómo Registry mantiene información de:

```text
Contracts
Providers
Implementations
Capabilities
Modules
```

sin convertirse automáticamente en el Container.

---

# 226. Relación con ENG-021

ENG-021 deberá profundizar en:

```text
Contract Definition
Contract Publication
Contract Version
Contract Compatibility
Implementation Verification
```

DI consumirá esos Contracts.

---

# 227. Principio Rector

> **Dependency Injection en MEF deberá hacer explícitas las colaboraciones entre componentes, permitir sustituibilidad y composición controlada, y preservar los límites arquitectónicos sin convertir el Service Container en una dependencia global del sistema.**

---

# 228. Conclusión

**ENG-018 — Dependency Injection** establece cómo se relacionan los componentes durante Composition.

La cadena fundamental será:

```text
Consumer
   │
   ▼
Required Contract
   │
   ▼
Dependency Definition
   │
   ▼
Compatible Implementation
   │
   ▼
Composition
   │
   ▼
Injection
   │
   ▼
Valid Component
```

El objetivo no es construir un Container sofisticado.

El objetivo es garantizar que:

```text
dependencies are visible,
boundaries are preserved,
implementations are replaceable,
tests remain simple,
and Runtime composition is predictable.
```

Esto permite que una clase como:

```text
CreateCustomerHandler
```

no necesite saber:

```text
qué Container existe,
qué Framework DI se utiliza,
cómo se encontró el Repository,
ni dónde está configurada la implementación.
```

Solo necesita conocer:

```text
CT-CUSTOMER-001
```

o el Contract técnico correspondiente.

La Composition Layer se ocupa del resto.

Así, MEF mantiene la cadena:

```text
Architecture
      ↓
Contracts
      ↓
Dependency Injection
      ↓
Service Container
      ↓
Runtime Composition
```

sin invertir la relación y convertir al Container en la arquitectura del Framework.

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
- ENG-001 — Organización del Código
- ENG-002 — Especificación de Modules
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-015 — Architectural State Machine
- ENG-016 — Compatibility
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering