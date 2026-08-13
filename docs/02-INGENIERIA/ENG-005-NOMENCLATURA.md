---
id: ENG-005
titulo: Nomenclatura
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Nomenclatura
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-001
  - ENG-002
  - ENG-003
  - ENG-004
  - FND-005
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-009
  - ENG-011
  - ENG-014
keywords:
  - naming
  - nomenclature
  - identifiers
  - modules
  - contracts
  - events
  - commands
  - queries
  - packages
  - mef
---

# ENG-005

# Nomenclatura

## Estado

Accepted.

---

# 1. Propósito

Definir el sistema oficial de nomenclatura utilizado por las implementaciones de **MEF (Modular Enterprise Framework)**.

La nomenclatura establece reglas consistentes para identificar y nombrar:

- Modules;
- Contracts;
- Events;
- Commands;
- Queries;
- Services;
- Providers;
- Builders;
- Adapters;
- Extension Points;
- Packages;
- configuración;
- artefactos;
- identificadores técnicos.

Su objetivo es proporcionar un lenguaje técnico uniforme, predecible y procesable por personas y herramientas.

---

# 2. Declaración

Los nombres constituyen parte de la arquitectura observable del software.

Un nombre deberá comunicar intención, responsabilidad y categoría.

MEF evitará nombres ambiguos, accidentales o dependientes innecesariamente de tecnologías concretas.

La regla fundamental será:

> **Un artefacto deberá poder identificarse por su nombre sin necesidad de inspeccionar su implementación para comprender su propósito principal.**

---

# 3. Objetivos

La nomenclatura tiene como objetivos:

- reducir ambigüedad;
- facilitar búsqueda;
- mejorar navegación;
- favorecer automatización;
- facilitar generación de código;
- mejorar trazabilidad;
- permitir validación;
- mantener consistencia entre implementaciones;
- preservar un vocabulario técnico común.

---

# 4. Fuente Terminológica

La nomenclatura técnica deberá respetar el lenguaje oficial definido por MEF.

La relación será:

```text
FND-005
Lenguaje Oficial
      │
      ▼
Diccionario Oficial
      │
      ▼
ENG-005
Nomenclatura Técnica
      │
      ▼
Código
```

ENG-005 no redefine conceptos.

Define cómo se representan técnicamente.

---

# 5. Idioma Técnico

Los identificadores técnicos interoperables de MEF utilizarán preferentemente **inglés**.

Ejemplos:

```text
Customer
Invoice
Payment
Registry
Module
Contract
Provider
```

La documentación podrá permanecer en español.

Por tanto:

```text
Documentación → Español
Código        → Inglés
Identifiers   → Inglés
API           → Inglés
CLI           → Inglés
```

No deberán mezclarse idiomas arbitrariamente dentro del mismo identificador.

---

# 6. Principios de Nomenclatura

Todo nombre deberá ser:

- claro;
- específico;
- estable;
- coherente;
- suficientemente descriptivo;
- proporcional a la responsabilidad que representa.

Se evitarán nombres innecesariamente largos cuando no agreguen información útil.

---

# 7. Intención antes que Implementación

Los nombres deberán describir **qué representa el artefacto**, no únicamente cómo está implementado.

Preferido:

```text
CustomerRepository
```

Evitar cuando forme parte de una API conceptual:

```text
CustomerMySqlRepositoryManager
```

El detalle tecnológico deberá aparecer únicamente cuando sea necesario distinguir una implementación concreta:

```text
CustomerRepository
        │
        ├── MySqlCustomerRepository
        └── ApiCustomerRepository
```

---

# 8. Nombres Genéricos

Se evitarán nombres como:

```text
Manager
Helper
Utils
Common
Generic
Base
Misc
Processor
Handler
Service
Data
Object
```

cuando aparezcan sin contexto suficiente.

Ejemplo débil:

```text
CustomerManager
```

Preferible:

```text
CustomerRegistrationService
CustomerStatusUpdater
CustomerImporter
```

La responsabilidad deberá ser reconocible.

---

# 9. Abreviaturas

Las abreviaturas deberán evitarse salvo que sean:

- oficiales;
- ampliamente reconocidas;
- no ambiguas.

Ejemplos aceptables:

```text
API
CLI
DTO
ID
URL
HTTP
JSON
MEF
```

Ejemplo a evitar:

```text
CustMgr
UsrCfg
ModRegSvc
```

La reducción de caracteres no deberá sacrificar comprensión.

---

# 10. Acrónimos en Identificadores

Cuando el lenguaje utilice `PascalCase`, los acrónimos deberán integrarse de manera consistente.

Preferido:

```text
ApiClient
HttpRequest
JsonSerializer
UrlResolver
```

Se evitará alternar arbitrariamente:

```text
APIClient
HttpREQUEST
JSONSerializer
URLresolver
```

Los perfiles específicos de lenguaje podrán adaptar esta regla cuando exista una convención ampliamente establecida.

---

# 11. Identificadores Arquitectónicos

Los identificadores arquitectónicos deberán mantenerse separados de los nombres de implementación.

Ejemplo:

```text
MOD-CRM
```

es identidad arquitectónica.

Mientras:

```text
CrmModule
```

puede ser una representación en código.

El cambio de clase no deberá cambiar automáticamente la identidad arquitectónica.

---

# 12. Module IDs

Los Modules utilizarán conceptualmente:

```text
MOD-<IDENTIFIER>
```

Ejemplos:

```text
MOD-CRM
MOD-IDENTITY
MOD-INVENTORY
MOD-BILLING
MOD-REPORTING
```

El identificador deberá:

- ser único;
- ser estable;
- utilizar caracteres permitidos;
- evitar referencias tecnológicas innecesarias.

---

# 13. Module Names

En código, un Module deberá utilizar un nombre que exprese su capacidad.

Ejemplos:

```text
CrmModule
IdentityModule
InventoryModule
BillingModule
```

Se evitará:

```text
Module1
MainModule
GeneralModule
SystemModule
```

---

# 14. Module Slugs

Cuando se requiera un `slug`, deberá ser:

- minúsculo;
- estable;
- legible;
- apropiado para CLI y rutas técnicas.

Ejemplos:

```text
crm
identity
inventory
billing
customer-support
```

Se favorecerá `kebab-case` cuando el identificador contenga varias palabras:

```text
customer-support
```

---

# 15. Contract IDs

Los Contracts podrán utilizar:

```text
CT-<DOMAIN>-<NUMBER>
```

Ejemplos:

```text
CT-CUSTOMER-001
CT-IDENTITY-001
CT-PAYMENT-001
```

Los identificadores oficiales serán gobernados y no deberán reutilizarse.

---

# 16. Contract Names

Las representaciones técnicas de Contracts deberán nombrar claramente la capacidad.

Ejemplos:

```text
CustomerRepository
PaymentGateway
EventPublisher
ConfigurationProvider
Clock
Logger
```

Cuando la plataforma necesite distinguir explícitamente una interfaz, el perfil técnico podrá utilizar una convención como:

```text
CustomerRepositoryInterface
```

pero MEF no impondrá el sufijo `Interface` universalmente.

La intención conceptual prevalece sobre la característica del lenguaje.

---

# 17. Implementaciones de Contracts

Una implementación deberá expresar aquello que la diferencia.

Ejemplos:

```text
MySqlCustomerRepository
PostgreSqlCustomerRepository
InMemoryCustomerRepository
ApiCustomerRepository
```

Evitar:

```text
CustomerRepositoryImpl
CustomerRepositoryImplementation
```

cuando exista una característica más significativa para identificarla.

---

# 18. Service Names

Los Services deberán nombrarse según la capacidad que proporcionan.

Ejemplos:

```text
CustomerRegistrationService
InvoiceCalculationService
PaymentProcessingService
```

Un nombre como:

```text
CustomerService
```

podrá considerarse demasiado amplio si concentra múltiples responsabilidades.

---

# 19. Providers

Los Providers deberán utilizar el sufijo:

```text
Provider
```

cuando representen el concepto definido por MEF.

Ejemplos:

```text
CrmProvider
EventBusProvider
DatabaseProvider
```

Un Provider deberá representar composición técnica, no lógica funcional.

---

# 20. Adapters

Las implementaciones de adaptadores deberán utilizar el concepto:

```text
Adapter
```

cuando la naturaleza del artefacto no resulte suficientemente clara por sí sola.

Ejemplos:

```text
StripePaymentAdapter
SapInventoryAdapter
FilesystemStorageAdapter
```

Cuando el Contract ya exprese claramente la responsabilidad, podrá utilizarse una forma como:

```text
StripePaymentGateway
```

La consistencia dentro del contexto será prioritaria.

---

# 21. Builders

Los Builders deberán utilizar:

```text
<Artifact>Builder
```

Ejemplos:

```text
ModuleBuilder
ManifestBuilder
PipelineBuilder
PackageBuilder
```

Un Builder deberá corresponder al proceso de construcción definido arquitectónicamente.

---

# 22. Factories

Las Factories deberán utilizar:

```text
<Artifact>Factory
```

Ejemplos:

```text
ConnectionFactory
ModuleFactory
EventFactory
```

No deberá utilizarse `Factory` como nombre genérico para cualquier mecanismo de creación.

---

# 23. Commands

Los Commands deberán nombrarse mediante:

```text
Verb + Object
```

Ejemplos:

```text
CreateCustomer
ApproveInvoice
RegisterPayment
DisableModule
InstallPackage
```

Deberán expresar intención de cambio.

---

# 24. Command Handlers

Cuando una implementación utilice Handlers explícitos:

```text
<Command>Handler
```

Ejemplos:

```text
CreateCustomerHandler
ApproveInvoiceHandler
InstallPackageHandler
```

El Handler implementa el comportamiento requerido por el Command.

---

# 25. Queries

Las Queries utilizarán verbos de consulta.

Ejemplos:

```text
GetCustomer
FindCustomer
ListCustomers
SearchInvoices
GetModuleStatus
```

Se evitarán nombres que sugieran modificación.

---

# 26. Query Handlers

Cuando aplique:

```text
<Query>Handler
```

Ejemplos:

```text
GetCustomerHandler
ListInvoicesHandler
```

---

# 27. Events

Los Events representarán hechos ocurridos y se nombrarán en pasado.

Ejemplos:

```text
CustomerCreated
InvoiceApproved
PaymentReceived
ModuleInstalled
FrameworkStarted
```

No deberán utilizar nombres imperativos:

```text
CreateCustomer
ApproveInvoice
```

para representar Events.

---

# 28. Event IDs

Los Events gobernados podrán utilizar una identidad del tipo:

```text
EVT-<DOMAIN>-<EVENT>
```

Ejemplos:

```text
EVT-CRM-CUSTOMER-CREATED
EVT-BILLING-INVOICE-APPROVED
EVT-MEF-MODULE-INSTALLED
```

La codificación definitiva deberá mantenerse estable una vez publicada.

---

# 29. Event Listeners

Los Listeners deberán expresar el hecho que atienden y, cuando sea útil, la acción realizada.

Ejemplos:

```text
SendWelcomeEmailOnCustomerCreated
UpdateStatisticsOnInvoiceApproved
```

También podrá utilizarse:

```text
CustomerCreatedListener
```

cuando el contexto haga inequívoca su responsabilidad.

---

# 30. Subscribers

Los componentes que consuman varios Events relacionados podrán utilizar:

```text
<Context>Subscriber
```

Ejemplos:

```text
AuditSubscriber
ModuleLifecycleSubscriber
```

No deberán utilizarse Subscribers para ocultar responsabilidades no relacionadas.

---

# 31. DTO

Los DTO deberán usar nombres asociados a su propósito.

Ejemplos:

```text
CreateCustomerData
CustomerDetails
PaymentRequest
InvoiceSummary
```

El sufijo:

```text
Dto
```

podrá utilizarse según el perfil de implementación:

```text
CustomerDto
```

pero no será obligatorio universalmente si el nombre semántico es suficiente.

---

# 32. Value Objects

Los Value Objects deberán nombrarse utilizando el concepto que representan.

Ejemplos:

```text
Email
Money
Currency
DateRange
Coordinates
ModuleId
ContractId
```

Se evitarán nombres como:

```text
EmailValueObject
MoneyVO
```

salvo necesidad específica del perfil técnico.

---

# 33. Entities

Las Entities deberán nombrarse por el concepto de identidad que representan.

Ejemplos:

```text
Customer
Invoice
Module
Package
```

No deberá añadirse `Entity` universalmente salvo que el perfil del lenguaje lo justifique.

---

# 34. Repositories

Los Repositories utilizarán:

```text
<Entity>Repository
```

Ejemplos:

```text
CustomerRepository
ModuleRepository
PackageRepository
```

Las implementaciones podrán añadir el mecanismo:

```text
MySqlCustomerRepository
InMemoryModuleRepository
```

---

# 35. Policies

Las Policies deberán expresar la decisión o capacidad que gobiernan.

Ejemplos:

```text
ModuleActivationPolicy
PackageInstallationPolicy
CustomerAccessPolicy
```

Se evitarán nombres genéricos como:

```text
DefaultPolicy
GeneralPolicy
```

sin contexto.

---

# 36. Validators

Los Validators deberán nombrar el objeto o regla validada.

Ejemplos:

```text
ManifestValidator
ModuleCompatibilityValidator
ContractValidator
```

Cuando se trate de una regla específica:

```text
DependencyCycleValidator
```

---

# 37. Resolvers

Los Resolvers deberán especificar aquello que resuelven.

Ejemplos:

```text
DependencyResolver
ContractResolver
ModulePathResolver
```

No deberá utilizarse `Resolver` cuando el componente realmente ejecute lógica de negocio.

---

# 38. Parsers

Los Parsers deberán utilizar:

```text
<FormatOrArtifact>Parser
```

Ejemplos:

```text
ManifestParser
ConfigurationParser
```

Un Parser interpreta una representación.

No deberá asumir responsabilidades de validación semántica completa si corresponden a otro componente.

---

# 39. Serializers

Ejemplos:

```text
ManifestSerializer
EventSerializer
JsonSerializer
```

Cuando el formato sea relevante deberá ser visible.

---

# 40. Normalizers

Ejemplos:

```text
ManifestNormalizer
ConfigurationNormalizer
```

Un Normalizer transforma una representación equivalente hacia una forma canónica.

---

# 41. Mappers

Los Mappers deberán declarar claramente las estructuras entre las que transforman cuando resulte necesario.

Ejemplos:

```text
CustomerMapper
ManifestMapper
```

En contextos ambiguos podrá utilizarse:

```text
CustomerRecordMapper
```

---

# 42. Middleware

Los Middleware deberán nombrarse según la responsabilidad aplicada.

Ejemplos:

```text
AuthenticationMiddleware
TracingMiddleware
RateLimitMiddleware
```

Se evitará numerar Middleware según su orden:

```text
Middleware1
Middleware2
```

---

# 43. Pipelines

Los Pipelines deberán expresar el proceso coordinado.

Ejemplos:

```text
BootPipeline
ValidationPipeline
PackageInstallationPipeline
```

---

# 44. Pipeline Stages

Las etapas deberán nombrarse según la acción o fase.

Ejemplos:

```text
DiscoveryStage
ValidationStage
RegistrationStage
CompositionStage
```

---

# 45. Lifecycle Hooks

Los Hooks deberán utilizar nombres semánticamente coherentes con las fases oficiales.

Ejemplos conceptuales:

```text
initialize
ready
shutdown
```

No deberán inventarse Hooks fuera del Lifecycle oficial sin extender formalmente su especificación.

---

# 46. Extension Point IDs

Los Extension Points utilizarán conceptualmente:

```text
EP-<DOMAIN>-<CAPABILITY>
```

Ejemplos:

```text
EP-CRM-CUSTOMER-PROFILE
EP-MEF-AUTHENTICATION
EP-REPORTING-EXPORT
```

---

# 47. Extension Names

Las implementaciones podrán utilizar nombres como:

```text
CustomerProfileExtension
SamlAuthenticationExtension
PdfExportExtension
```

El propósito debe ser evidente.

---

# 48. Package IDs

Los Packages deberán poseer identidad estable independiente del archivo físico.

Conceptualmente:

```text
PKG-<IDENTIFIER>
```

Ejemplos:

```text
PKG-CRM
PKG-IDENTITY
PKG-REPORTING
```

La relación exacta entre `MOD-*` y `PKG-*` será definida por Packaging y Package Manager.

---

# 49. Package Names

Los nombres físicos para distribución deberán seguir las convenciones del Package Manager correspondiente sin sustituir la identidad MEF.

Ejemplo conceptual:

```text
MEF ID:
PKG-CRM

Distribution name:
mef/crm
```

La segunda representación depende de la tecnología.

La primera pertenece a MEF.

---

# 50. Manifest

El nombre canónico recomendado inicialmente será:

```text
mef.manifest.json
```

según ENG-003.

No deberán aparecer múltiples nombres arbitrarios para el mismo descriptor dentro de una misma implementación.

---

# 51. Configuration Files

Los nombres físicos de Configuration se definirán en **ENG-011**.

Sin embargo deberán:

- expresar alcance;
- evitar ambigüedad;
- distinguir configuración de secretos;
- preservar consistencia.

---

# 52. Environment Variables

Cuando se utilicen variables de entorno, deberán utilizar un prefijo que identifique claramente su alcance.

Conceptualmente:

```text
MEF_<SCOPE>_<NAME>
```

Ejemplos:

```text
MEF_RUNTIME_ENV
MEF_LOG_LEVEL
MEF_CACHE_ENABLED
```

Los Modules podrán utilizar prefijos propios gobernados:

```text
MEF_CRM_...
```

cuando resulte apropiado.

---

# 53. Boolean Names

Los valores booleanos deberán formularse de forma que su significado sea evidente.

Preferido:

```text
isEnabled
hasPermission
canRetry
supportsAsync
requiresAuthentication
```

Evitar:

```text
enabledFlag
value
statusBool
```

La sintaxis exacta dependerá del lenguaje.

---

# 54. Collection Names

Las colecciones deberán utilizar nombres plurales.

Ejemplos:

```text
modules
contracts
events
dependencies
```

Una variable singular no deberá representar ambiguamente una colección.

---

# 55. Count Names

Los valores de conteo deberán expresar aquello que cuentan.

Ejemplos:

```text
moduleCount
retryCount
failedPackageCount
```

Evitar:

```text
count
number
total
```

cuando el contexto no sea inequívoco.

---

# 56. Date and Time Names

Los nombres temporales deberán expresar su semántica.

Ejemplos:

```text
createdAt
updatedAt
expiresAt
startedAt
completedAt
```

Cuando represente únicamente una fecha:

```text
publicationDate
birthDate
```

La nomenclatura no deberá confundir fecha y timestamp.

---

# 57. IDs en Código

Los identificadores deberán expresar su dominio.

Preferido:

```text
moduleId
contractId
customerId
packageId
```

Evitar variables genéricas:

```text
id
```

cuando existan múltiples identidades en el mismo contexto.

---

# 58. Methods / Functions

Los nombres de operaciones deberán iniciar con un verbo cuando representen una acción.

Ejemplos:

```text
registerModule()
validateManifest()
resolveContract()
publishEvent()
```

Las operaciones de consulta deberán expresar claramente lectura:

```text
getModule()
findContract()
hasCapability()
isRegistered()
```

---

# 59. Predicados

Las funciones que devuelvan condiciones booleanas deberán formularse como preguntas.

Ejemplos:

```text
isValid()
isEnabled()
hasDependency()
canInstall()
supportsCapability()
```

---

# 60. Getters

El uso de `get` dependerá del perfil del lenguaje.

No deberá imponerse universalmente si el lenguaje proporciona propiedades o mecanismos más naturales.

La semántica será más importante que la sintaxis.

---

# 61. Setters

MEF no favorecerá setters genéricos indiscriminados.

Preferido:

```text
activate()
disable()
rename()
changeEmail()
```

frente a:

```text
setStatus()
setEnabled()
setEmail()
```

cuando exista una operación de dominio o estado más expresiva.

---

# 62. Constants

Las constantes deberán utilizar nombres descriptivos según la convención del lenguaje.

Una constante pública forma parte de la superficie compatible cuando los consumidores dependen de ella.

No deberá modificarse sin considerar impacto de versión.

---

# 63. Enumerations

Los tipos enumerados deberán nombrarse por el concepto.

Ejemplo:

```text
ModuleStatus
PackageState
ContractType
```

Sus valores deberán evitar repetir innecesariamente el nombre del enum cuando el lenguaje ya proporciona contexto.

Conceptualmente:

```text
ModuleStatus::ACTIVE
```

en lugar de:

```text
ModuleStatus::MODULE_STATUS_ACTIVE
```

cuando la plataforma lo permita.

---

# 64. Error Codes

Los códigos de error deberán seguir una estructura consistente.

Formato recomendado:

```text
MEF-<DOMAIN>-<NUMBER>
```

Ejemplos:

```text
MEF-MAN-001
MEF-MOD-001
MEF-REG-001
MEF-PKG-001
MEF-CFG-001
```

El código deberá conservar significado estable.

---

# 65. Exception Names

Cuando existan excepciones, deberán expresar la condición.

Ejemplos:

```text
InvalidManifestException
ModuleNotFoundException
DependencyCycleException
IncompatiblePackageException
```

Evitar:

```text
MefException
GeneralException
CustomException
```

salvo como tipos base claramente justificados.

---

# 66. Test Names

Las pruebas deberán expresar comportamiento.

Podrán seguir conceptualmente:

```text
<condition>_<behavior>_<expected-result>
```

o una convención equivalente propia del lenguaje.

Ejemplo conceptual:

```text
invalid_manifest_is_rejected
module_without_dependency_cannot_start
```

La forma concreta será establecida en ENG-009.

---

# 67. Test Doubles

Los Test Doubles deberán expresar su propósito.

Ejemplos:

```text
FakeClock
InMemoryCustomerRepository
StubPaymentGateway
SpyEventPublisher
```

No deberán utilizarse indistintamente los términos:

```text
Mock
Stub
Fake
Spy
```

cuando representen comportamientos diferentes.

---

# 68. Fixtures

Las Fixtures deberán expresar el escenario que representan.

Ejemplos:

```text
ValidCrmManifest
ExpiredPackageFixture
CustomerWithActiveSubscription
```

---

# 69. Generated Artifacts

Los artefactos generados deberán utilizar exactamente las mismas reglas de nomenclatura que los creados manualmente.

El Generator no podrá introducir una nomenclatura paralela.

---

# 70. Template Names

Las plantillas deberán identificarse por el artefacto que generan.

Ejemplos:

```text
module
contract
event
command
query
provider
```

La forma física exacta será definida por el Template Engine y Generators.

---

# 71. CLI Commands

Los comandos de CLI deberán utilizar lenguaje orientado a recursos y acciones.

Conceptualmente:

```text
mef module create
mef module validate
mef module inspect
mef package install
mef package remove
mef manifest validate
```

La especificación definitiva corresponderá a **ENG-007 — CLI**.

---

# 72. Namespace Conceptual

Las implementaciones deberán mantener una raíz reconocible de MEF.

Conceptualmente:

```text
MEF
```

o equivalente según el lenguaje.

Dentro de la implementación deberán reflejarse responsabilidades como:

```text
MEF.Core
MEF.Platform
MEF.Contracts
MEF.Modules
MEF.Extensions
```

La representación física será definida posteriormente.

---

# 73. Namespaces de Modules

Los Modules deberán poseer un espacio propio.

Conceptualmente:

```text
MEF.Modules.Crm
MEF.Modules.Identity
MEF.Modules.Inventory
```

Las implementaciones específicas podrán utilizar convenciones idiomáticas equivalentes.

---

# 74. Nombres de Archivos

Los nombres físicos deberán ser consistentes con el artefacto que contienen.

Cuando un archivo corresponda a una unidad principal, deberá reflejar su nombre.

Ejemplo conceptual:

```text
CustomerRepository
→ CustomerRepository.<ext>
```

La extensión y el casing dependerán del lenguaje.

---

# 75. Directorios

Los directorios deberán representar responsabilidades o capacidades reconocibles.

Ejemplos conceptuales:

```text
Contracts
Events
Commands
Queries
Providers
Infrastructure
Tests
```

La estructura normativa completa será definida en ENG-006.

---

# 76. Markdown y Documentos

Los nombres de documentos normativos continuarán utilizando:

```text
PREFIX-NNN-TITULO_EN_MAYUSCULAS.md
```

Ejemplos:

```text
ENG-005-NOMENCLATURA.md
ARQ-011-CONTRACTS.md
FND-013-INDEPENDENCIA_DEL_FRAMEWORK.md
```

Los títulos internos utilizarán escritura normal.

Ejemplo:

```markdown
# Nomenclatura
```

---

# 77. Casing Conceptual

MEF reconoce conceptualmente distintas formas según contexto.

| Contexto | Forma recomendada |
|---|---|
| Types / Classes | PascalCase |
| Methods / Functions | camelCase o convención idiomática |
| Variables | camelCase o convención idiomática |
| Constants | convención idiomática |
| Slugs | kebab-case |
| Machine IDs | UPPERCASE con guiones |
| CLI | lowercase |
| Document filenames | UPPERCASE |
| JSON fields | camelCase |

Los perfiles específicos podrán adaptar aquellos elementos dependientes del lenguaje.

---

# 78. JSON Fields

Para especificaciones JSON de referencia, MEF utilizará inicialmente:

```text
camelCase
```

Ejemplos:

```json
{
  "optionalDependencies": {},
  "extensionPoints": [],
  "entrypoint": "CrmModule"
}
```

Una misma especificación no deberá mezclar arbitrariamente:

```text
camelCase
snake_case
kebab-case
```

---

# 79. IDs y Casing

Los identificadores gobernados utilizarán mayúsculas:

```text
MOD-CRM
CT-CUSTOMER-001
EVT-CRM-CUSTOMER-CREATED
EP-CRM-CUSTOMER-PROFILE
PKG-CRM
```

Estos IDs son opacos.

Los consumidores no deberán depender de interpretar internamente sus segmentos salvo que la especificación lo autorice.

---

# 80. Catálogo de Prefijos

El catálogo inicial será:

| Prefijo | Activo |
|---|---|
| FND | Foundation document |
| ARQ | Architecture document |
| ENG | Engineering document |
| DIC | Dictionary document |
| KCS | Knowledge document |
| ADR | Architecture Decision Record |
| RFC | Request for Comments |
| MOD | Module |
| CT | Contract |
| EVT | Event |
| EP | Extension Point |
| PKG | Package |
| AI | Architectural Invariant |
| EI | Engineering Invariant |
| MT | Module Type |
| DI | Dependency Injection strategy |
| CFG | Configuration type |

Los nuevos prefijos deberán incorporarse de manera gobernada.

---

# 81. Unicidad de Prefijos

Un prefijo no deberá reutilizarse para dos categorías distintas.

Ejemplo prohibido:

```text
CT = Contract
CT = Component Type
```

Toda colisión deberá resolverse antes de publicar el nuevo identificador.

---

# 82. Estabilidad de IDs

Un ID publicado no deberá reasignarse a otro concepto.

Si un artefacto desaparece:

```text
deprecated
retired
removed
```

su ID permanecerá reservado históricamente.

No deberá reciclarse.

---

# 83. Renombrado

Cambiar un nombre legible no implica necesariamente cambiar identidad.

Ejemplo:

```text
MOD-CRM
Name: Customer Management
```

podrá evolucionar a:

```text
MOD-CRM
Name: Customer Relationship Management
```

manteniendo:

```text
MOD-CRM
```

si el significado arquitectónico esencial permanece.

---

# 84. Renombrado Semántico

Cuando un cambio de nombre represente realmente un cambio de responsabilidad o significado, deberá evaluarse como evolución arquitectónica y no como simple refactorización nominal.

---

# 85. Alias

Los alias deberán evitarse como mecanismo permanente.

Cuando sean necesarios para migración deberán:

- ser explícitos;
- estar documentados;
- poseer periodo de compatibilidad;
- señalar el identificador canónico.

---

# 86. Deprecated Names

Los nombres deprecados deberán indicar la alternativa oficial.

Conceptualmente:

```text
OldCustomerManager
DEPRECATED → CustomerRegistrationService
```

La compatibilidad deberá gestionarse conforme al versionado.

---

# 87. Machine Readability

Los nombres destinados a máquinas deberán evitar:

- espacios;
- caracteres ambiguos;
- símbolos innecesarios;
- dependencias de locale.

Los nombres para humanos podrán ser más descriptivos cuando corresponda.

---

# 88. Unicode

Los identificadores técnicos gobernados deberán favorecer un subconjunto interoperable y predecible de caracteres.

Los IDs oficiales utilizarán inicialmente:

```text
A-Z
0-9
-
```

según el patrón aplicable.

Los nombres humanos podrán utilizar Unicode cuando corresponda.

---

# 89. Case Sensitivity

Los identificadores oficiales deberán tratarse de forma canónica.

Por ejemplo:

```text
MOD-CRM
```

no deberá considerarse una identidad distinta de una variante accidental como:

```text
mod-crm
```

La representación canónica será la definida por la especificación.

---

# 90. Naming Validation

Las reglas objetivas deberán ser verificables.

Conceptualmente:

```text
Artifact
   │
   ▼
Naming Validator
   │
   ├── valid
   └── invalid
```

El Validator podrá revisar:

- patrón;
- prefijo;
- casing;
- unicidad;
- palabras prohibidas;
- consistencia.

---

# 91. Naming Registry

MEF podrá mantener un catálogo de identificadores oficiales para evitar:

- duplicados;
- colisiones;
- reutilización;
- inconsistencias.

El Registry o Knowledge System podrá participar en esta validación.

---

# 92. Reserved Terms

Podrá existir un catálogo de términos reservados.

Ejemplos conceptuales:

```text
Core
Platform
Kernel
Registry
Module
Contract
Package
Manifest
```

Estos términos no deberán redefinirse con significados incompatibles.

---

# 93. Technology Names

Los nombres de tecnologías podrán utilizarse en implementaciones específicas cuando expresen una diferencia real.

Ejemplo:

```text
RedisCacheAdapter
MySqlCustomerRepository
AwsS3StorageAdapter
```

No deberán aparecer innecesariamente en Contracts generales:

```text
MySqlCustomerRepositoryContract
```

salvo que el Contract sea deliberadamente específico de MySQL.

---

# 94. Vendor Names

Los nombres de proveedores deberán quedar confinados preferentemente a adapters o integraciones.

Ejemplos:

```text
StripePaymentAdapter
TwilioSmsAdapter
AzureBlobStorageAdapter
```

El resto del dominio deberá depender del Contract conceptual correspondiente.

---

# 95. Business Names

Los Modules de dominio podrán utilizar términos empresariales cuando formen parte explícita de su dominio.

Ejemplos:

```text
Customer
Invoice
Payroll
Inventory
```

La neutralidad de MEF implica que el Core no deberá depender de esos términos, no que los Modules de dominio deban evitarlos.

---

# 96. Verbos Recomendados

Para mantener consistencia podrán utilizarse verbos semánticos frecuentes:

```text
create
register
install
enable
disable
remove
validate
resolve
publish
load
build
generate
inspect
list
find
get
```

Su significado deberá mantenerse consistente dentro del ecosistema.

---

# 97. Verbos Ambiguos

Se deberá tener cuidado con:

```text
process
handle
manage
execute
do
run
```

cuando oculten la verdadera responsabilidad.

Podrán utilizarse cuando sean términos correctos del contexto, pero no como sustitutos de nombres más precisos.

---

# 98. Singular y Plural

Los tipos y artefactos individuales utilizarán singular:

```text
Module
Contract
Customer
```

Las colecciones utilizarán plural:

```text
modules
contracts
customers
```

No deberán mezclarse arbitrariamente.

---

# 99. Nomenclatura de Capacidades

Las capacidades declaradas en Manifest utilizarán inicialmente:

```text
kebab-case
```

Ejemplos:

```text
customer-management
lead-management
package-installation
event-publishing
```

Una capacidad deberá representar una habilidad observable y relativamente estable.

---

# 100. Nomenclatura de Permissions

Las permissions deberán seguir una jerarquía predecible.

Formato recomendado:

```text
<domain>.<resource>.<action>
```

Ejemplos:

```text
crm.customer.read
crm.customer.create
billing.invoice.approve
mef.module.install
```

La especificación de seguridad podrá refinar estas reglas.

---

# 101. Nomenclatura de Configuration Keys

Las claves estructuradas deberán expresar jerarquía semántica.

Ejemplo conceptual:

```text
runtime.environment
logging.level
modules.crm.enabled
```

La representación concreta dependerá del formato definido en ENG-011.

---

# 102. Nomenclatura de Logs

Los eventos técnicos de logging deberán utilizar nombres estables cuando se necesite correlación o métricas.

Ejemplo:

```text
module.registered
package.installation.failed
manifest.validation.completed
```

No deberán confundirse con los Events funcionales oficiales.

---

# 103. Nomenclatura de Métricas

Las métricas deberán reflejar claramente:

- dominio;
- fenómeno medido;
- unidad o tipo cuando corresponda.

Ejemplo conceptual:

```text
mef_module_registered_total
mef_manifest_validation_duration
```

La convención específica dependerá del sistema de observabilidad.

---

# 104. Nomenclatura de Feature Flags

Cuando existan Feature Flags deberán usar nombres descriptivos y temporales cuando correspondan.

Ejemplo:

```text
enable-new-package-resolver
```

Una Feature Flag no deberá convertirse silenciosamente en configuración permanente.

---

# 105. Nomenclatura de Migrations

Las migrations deberán poseer identidad y orden determinables sin depender únicamente de un nombre humano.

La estructura específica será definida por el perfil técnico correspondiente.

---

# 106. Nomenclatura de Releases

Los releases del Framework utilizarán una versión oficial independiente de nombres promocionales.

Ejemplo:

```text
v1.4.0
```

Un nombre de release, si se utiliza, será únicamente complementario.

---

# 107. Nomenclatura de Branches

La estrategia de Git podrá utilizar prefijos coherentes.

Ejemplos:

```text
feature/
fix/
docs/
refactor/
release/
hotfix/
```

La política completa deberá pertenecer al proceso de contribución y Release, no convertirse automáticamente en regla arquitectónica.

---

# 108. Nomenclatura de Commits

Los mensajes de Commit deberían expresar intención claramente.

Podrán utilizar una convención del tipo:

```text
docs:
feat:
fix:
refactor:
test:
build:
ci:
```

si el proyecto adopta formalmente dicha convención.

La especificación del Release Process podrá hacerla normativa posteriormente.

---

# 109. Excepciones

Una excepción de nomenclatura deberá estar justificada por:

- interoperabilidad;
- compatibilidad;
- convención obligatoria de plataforma;
- estándar externo;
- migración.

La preferencia personal no constituye una justificación suficiente.

---

# 110. Perfiles de Lenguaje

MEF podrá definir posteriormente perfiles específicos:

```text
ENG-PHP
ENG-JAVA
ENG-DOTNET
ENG-TYPESCRIPT
```

Cada perfil podrá determinar detalles como:

- casing de métodos;
- nombres de archivos;
- namespaces;
- package names;
- keywords reservadas.

Los perfiles no podrán contradecir la intención establecida en ENG-005.

---

# 111. Invariantes de Ingeniería

ENG-005 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-066 | Todo identificador arquitectónico publicado deberá ser único y estable. |
| EI-067 | Los identificadores técnicos interoperables deberán utilizar la representación canónica definida por MEF. |
| EI-068 | Un ID retirado no deberá reutilizarse para otro concepto. |
| EI-069 | Los nombres deberán expresar intención y responsabilidad. |
| EI-070 | Las abreviaturas ambiguas deberán evitarse. |
| EI-071 | Los Events deberán nombrarse como hechos ocurridos. |
| EI-072 | Los Commands deberán expresar acciones. |
| EI-073 | Las Queries deberán expresar solicitudes de información. |
| EI-074 | Las implementaciones concretas deberán identificar aquello que las distingue cuando sea relevante. |
| EI-075 | Los detalles tecnológicos no deberán incorporarse innecesariamente a Contracts generales. |
| EI-076 | Los Providers deberán utilizar nomenclatura consistente con su responsabilidad técnica. |
| EI-077 | Los Extension Points publicados deberán poseer identificadores estables. |
| EI-078 | Los Packages distribuidos deberán poseer identidad independiente de su nombre físico. |
| EI-079 | Las capacidades declaradas deberán utilizar nomenclatura estable y procesable por máquinas. |
| EI-080 | Las reglas de nomenclatura objetivas deberán poder validarse automáticamente cuando sea razonable. |

---

# 112. Validación

La validación de nomenclatura podrá comprobar:

```text
Identifier
    │
    ▼
Syntax
    │
    ▼
Prefix
    │
    ▼
Canonical Form
    │
    ▼
Uniqueness
    │
    ▼
Reserved Terms
    │
    ▼
Semantic Checks
```

Las comprobaciones semánticas que requieran interpretación humana podrán permanecer fuera de la validación automática.

---

# 113. Criterios de Conformidad

Una implementación será conforme con ENG-005 cuando:

- respete las identidades oficiales;
- mantenga IDs únicos;
- utilice términos definidos por MEF;
- diferencie correctamente Commands, Queries y Events;
- utilice nombres expresivos;
- evite abreviaturas ambiguas;
- separe identidad conceptual de representación tecnológica;
- mantenga APIs consistentes;
- respete los patrones de identificadores aplicables;
- documente excepciones justificadas.

---

# 114. Riesgos

Deberán evitarse especialmente:

## Naming Drift

El mismo concepto recibe nombres distintos en diferentes componentes.

## Semantic Collision

Un mismo término representa conceptos diferentes.

## Technology Leakage

La tecnología invade nombres conceptuales.

## Generic Naming

Los nombres no permiten identificar responsabilidades.

## ID Recycling

Una identidad histórica se asigna a otro activo.

## Mixed Language

Se mezclan idiomas sin una política clara.

## Abbreviation Explosion

El código se llena de acrónimos locales difíciles de comprender.

---

# 115. Relación con ENG-006

ENG-005 determina cómo se nombran los artefactos.

ENG-006 determinará cómo se organizan físicamente.

```text
ENG-001
Organización lógica
      │
      ▼
ENG-004
Convenciones
      │
      ▼
ENG-005
Nomenclatura
      │
      ▼
ENG-006
Estructura física
```

La estructura de directorios deberá utilizar los nombres y conceptos establecidos en esta especificación.

---

# 116. Relación con Generators

ENG-008 deberá generar artefactos conformes automáticamente con ENG-005.

Ejemplo:

```text
mef make:event CustomerCreated
```

deberá producir una representación válida de un Event conforme con:

```text
EI-071
```

Los Generators no deberán inventar convenciones alternativas.

---

# 117. Relación con CLI

ENG-007 utilizará la nomenclatura oficial para:

- recursos;
- comandos;
- opciones;
- identificadores;
- mensajes.

Así:

```text
module
package
manifest
contract
```

mantendrán el mismo significado en documentación, código y tooling.

---

# 118. Relación con Knowledge System

Los identificadores de Ingeniería podrán relacionarse con el sistema de conocimiento:

```text
MOD-CRM
    │
    ├── CT-CUSTOMER-001
    ├── EVT-CRM-CUSTOMER-CREATED
    └── EP-CRM-CUSTOMER-PROFILE
             │
             ▼
       Knowledge Graph
```

La consistencia nominal facilita construir relaciones procesables automáticamente.

---

# 119. Principio Rector

> **Todo nombre e identificador de MEF deberá comunicar intención, preservar identidad y utilizar un vocabulario técnico consistente, estable e independiente de detalles tecnológicos accidentales.**

---

# 120. Conclusión

**ENG-005 — Nomenclatura** establece el lenguaje técnico mediante el cual se materializan los conceptos de MEF en código, configuración, APIs, Packages y herramientas.

La nomenclatura no constituye únicamente una decisión estética.

Permite que:

```text
Arquitectura
     ↓
Conceptos
     ↓
Nombres
     ↓
Código
     ↓
Tooling
     ↓
Knowledge Graph
```

utilicen el mismo vocabulario.

Una nomenclatura estable constituye además un requisito para automatizar:

- validación;
- generación;
- búsqueda;
- trazabilidad;
- documentación;
- análisis arquitectónico.

---

# Referencias

## Fundación

- FND-005 — Lenguaje Oficial de MEF
- FND-013 — Independencia del Framework

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-008 — Event Bus
- ARQ-009 — Builders
- ARQ-011 — Contracts
- ARQ-013 — Configuration
- ARQ-015 — Extension Model
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-001 — Organización del Código
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-014 — Versionado