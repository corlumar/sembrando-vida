---
id: ENG-006
titulo: Estructura de Directorios
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Estructura de Directorios
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
  - ENG-005
  - ARQ-002
  - ARQ-003
  - ARQ-004
  - ARQ-015
relacionados:
  - ENG-007
  - ENG-008
  - ENG-009
  - ENG-011
  - ENG-012
  - ENG-013
keywords:
  - directories
  - structure
  - source
  - modules
  - tests
  - configuration
  - packages
  - organization
  - mef
---

# ENG-006

# Estructura de Directorios

## Estado

Accepted.

---

# 1. Propósito

Definir la estructura física de referencia para organizar una implementación de **MEF (Modular Enterprise Framework)**.

La estructura de directorios deberá materializar los límites lógicos, responsabilidades y relaciones establecidos por la Fundación, la Arquitectura y las especificaciones de Ingeniería.

Su propósito es proporcionar una organización:

- predecible;
- navegable;
- modular;
- verificable;
- portable;
- extensible;
- compatible con automatización.

---

# 2. Declaración

La estructura física deberá reflejar la arquitectura.

No deberá determinarla.

La regla fundamental será:

> **Los directorios materializan límites arquitectónicos existentes; nunca crean por sí solos nuevos límites o responsabilidades.**

---

# 3. Relación con ENG-001

ENG-001 define la organización lógica.

ENG-006 establece una materialización física de referencia.

```text
Logical Architecture
        │
        ▼
Engineering Boundaries
        │
        ▼
Directory Structure
        │
        ▼
Source Code
```

La estructura física podrá variar entre lenguajes cuando exista una razón técnica válida.

La semántica deberá permanecer equivalente.

---

# 4. Objetivos

La estructura deberá:

- permitir identificar responsabilidades rápidamente;
- separar código productivo de pruebas;
- separar código propio de dependencias;
- separar Framework de Applications;
- preservar autonomía de Modules;
- aislar infraestructura;
- facilitar generación automática;
- facilitar validación estructural;
- soportar Packaging;
- mantener documentación próxima al proyecto.

---

# 5. Principio de Estructura Universal y Perfil

MEF distinguirá dos niveles:

```text
MEF Universal Structure
          │
          ▼
Implementation Profile
          │
          ▼
Physical Project
```

La estructura universal define responsabilidades.

El perfil de implementación define cómo esas responsabilidades se representan en una tecnología concreta.

Ejemplos futuros:

```text
PHP Profile
Java Profile
.NET Profile
TypeScript Profile
```

---

# 6. Estructura Raíz de Referencia

Una implementación completa de MEF deberá poder representarse conceptualmente mediante:

```text
/
├── docs/
├── src/
├── modules/
├── extensions/
├── config/
├── resources/
├── templates/
├── tests/
├── examples/
├── tools/
├── packages/
├── var/
├── README.md
├── LICENSE
├── CHANGELOG.md
└── mef.manifest.json
```

No todos los directorios serán obligatorios en todos los Packages.

La presencia dependerá del tipo de proyecto o componente.

---

# 7. Directorio `/docs`

Contendrá documentación técnica y normativa perteneciente al repositorio.

Ejemplo:

```text
docs/
├── 00-FUNDACION/
├── 01-ARQUITECTURA/
├── 02-INGENIERIA/
├── 03-CONOCIMIENTO/
├── 04-ADR/
├── 05-RFC/
└── ...
```

La documentación no deberá mezclarse con código productivo.

---

# 8. Directorio `/src`

`src/` contendrá la implementación principal del Framework.

Conceptualmente:

```text
src/
├── Core/
├── Platform/
├── Contracts/
└── Infrastructure/
```

La estructura exacta podrá adaptarse según el lenguaje.

---

# 9. `/src/Core`

Contendrá implementaciones pertenecientes al Core definido en `ARQ-002`.

Ejemplo conceptual:

```text
src/Core/
├── Kernel/
├── Registry/
├── Container/
├── Events/
└── Lifecycle/
```

Este ejemplo no obliga a que cada concepto sea un directorio independiente.

La estructura deberá preservar los límites y responsabilidades definidos arquitectónicamente.

---

# 10. Restricciones de `/src/Core`

`src/Core/` no deberá contener:

- lógica de negocio;
- código específico de Applications;
- Modules funcionales;
- integraciones con proveedores concretos;
- componentes dependientes innecesariamente de infraestructura externa.

---

# 11. `/src/Platform`

Contendrá servicios compartidos pertenecientes a Platform.

Ejemplo conceptual:

```text
src/Platform/
├── Builders/
├── Templates/
├── Configuration/
├── Logging/
└── Support/
```

La existencia de `Support/` deberá justificarse y mantenerse controlada para evitar convertirse en una colección genérica.

---

# 12. `/src/Contracts`

Podrá contener Contracts compartidos por el Framework cuando su ubicación común sea apropiada.

Ejemplo:

```text
src/Contracts/
├── ModuleContract
├── RegistryContract
├── EventBusContract
└── ConfigurationContract
```

Los Contracts específicos de un Module deberán permanecer preferentemente dentro de la frontera del propio Module.

---

# 13. `/src/Infrastructure`

Contendrá adaptadores e implementaciones dependientes de tecnología cuando formen parte de la implementación principal del Framework.

Conceptualmente:

```text
src/Infrastructure/
├── Persistence/
├── Filesystem/
├── Networking/
└── Runtime/
```

El Core no deberá depender directamente de estos detalles salvo mediante los Contracts apropiados.

---

# 14. Directorio `/modules`

Los Modules instalados o desarrollados dentro del repositorio podrán residir en:

```text
modules/
```

Ejemplo:

```text
modules/
├── Crm/
├── Identity/
├── Inventory/
└── Reporting/
```

Cada Module representa una frontera independiente.

---

# 15. Estructura de un Module

La estructura física de referencia será:

```text
modules/Crm/
├── Contracts/
├── Application/
├── Domain/
├── Infrastructure/
├── Events/
├── Providers/
├── Configuration/
├── Resources/
├── Tests/
├── README.md
├── CHANGELOG.md
└── mef.manifest.json
```

No todas las carpetas serán obligatorias.

Solo deberán existir cuando representen responsabilidades reales.

---

# 16. `/Contracts` dentro del Module

Contendrá la API contractual pública o compartida del Module.

Ejemplo:

```text
modules/Crm/Contracts/
├── CustomerRepository
├── CustomerService
└── CustomerQueryService
```

No deberán colocarse implementaciones concretas dentro de `Contracts/`.

---

# 17. `/Application`

Contendrá coordinación de casos de uso y lógica de aplicación.

Podrá incluir:

```text
Application/
├── Commands/
├── Queries/
├── Handlers/
├── Services/
└── DTO/
```

La organización deberá favorecer capacidades y responsabilidades claras.

---

# 18. `/Domain`

Contendrá conceptos de dominio propios del Module cuando existan.

Ejemplo:

```text
Domain/
├── Entities/
├── ValueObjects/
├── Policies/
├── Services/
└── Events/
```

Un Module técnico podrá no necesitar una capa `Domain`.

---

# 19. `/Infrastructure`

Contendrá implementaciones dependientes de tecnología.

Ejemplo:

```text
Infrastructure/
├── Persistence/
├── Http/
├── Messaging/
└── External/
```

Los consumidores internos deberán depender de Contracts cuando corresponda.

---

# 20. `/Events`

Podrá contener Events públicos del Module cuando se decida mantenerlos separados de Events estrictamente internos del dominio.

La ubicación deberá preservar claramente la diferencia entre:

```text
Public Integration Events
```

y

```text
Internal Domain Events
```

---

# 21. `/Providers`

Contendrá Providers técnicos del Module.

Ejemplo:

```text
Providers/
└── CrmProvider
```

No deberá utilizarse para lógica funcional.

---

# 22. `/Configuration`

Contendrá schemas, defaults o definiciones de configuración del Module.

Ejemplo:

```text
Configuration/
├── config.schema.json
└── defaults.*
```

Los secretos no deberán almacenarse aquí.

---

# 23. `/Resources`

Podrá contener recursos necesarios para el Module:

```text
Resources/
├── translations/
├── assets/
├── schemas/
└── templates/
```

La semántica concreta dependerá del tipo de Module.

---

# 24. `/Tests` dentro del Module

Podrá contener pruebas específicas del Module.

Ejemplo:

```text
Tests/
├── Unit/
├── Integration/
├── Contract/
└── Architecture/
```

La estrategia definitiva se establecerá en `ENG-009`.

---

# 25. Manifest por Module

Cada Module distribuible deberá tener su propio:

```text
mef.manifest.json
```

en su raíz lógica.

Ejemplo:

```text
modules/Crm/mef.manifest.json
```

El Manifest describirá únicamente ese Module o Package.

---

# 26. Directorio `/extensions`

Contendrá extensiones no consideradas Modules principales.

Ejemplo:

```text
extensions/
├── SamlAuthentication/
├── PdfExport/
└── CustomerProfileEnhancer/
```

Cada Extension deberá respetar `ARQ-015`.

---

# 27. Estructura de una Extension

Conceptualmente:

```text
extensions/SamlAuthentication/
├── Contracts/
├── Implementation/
├── Configuration/
├── Tests/
├── README.md
└── mef.manifest.json
```

La estructura concreta dependerá del Extension Type.

---

# 28. Directorio `/config`

Contendrá configuración global de proyecto o Framework cuando corresponda.

Ejemplo conceptual:

```text
config/
├── framework.*
├── modules.*
├── logging.*
└── runtime.*
```

Los formatos concretos serán definidos en `ENG-011`.

---

# 29. Configuración vs Secrets

`config/` no deberá almacenar secretos.

La separación conceptual será:

```text
Configuration
     ≠
Secrets
```

Los secretos deberán resolverse mediante mecanismos específicos del entorno o plataforma.

---

# 30. Directorio `/resources`

Podrá contener recursos compartidos por el proyecto:

```text
resources/
├── schemas/
├── translations/
├── assets/
└── data/
```

Los recursos específicos de un Module deberán permanecer preferentemente dentro del Module correspondiente.

---

# 31. Directorio `/templates`

Contendrá plantillas utilizadas por el Template Engine o Generators.

Ejemplo:

```text
templates/
├── module/
├── contract/
├── event/
├── command/
├── query/
└── provider/
```

Las plantillas deberán producir artefactos conformes con ENG-004 y ENG-005.

---

# 32. Directorio `/tests`

Contendrá pruebas globales del Framework.

Ejemplo:

```text
tests/
├── Unit/
├── Integration/
├── Contract/
├── Architecture/
├── Compatibility/
├── Security/
└── EndToEnd/
```

Las pruebas estrictamente pertenecientes a un Module podrán residir dentro del mismo Module según el perfil adoptado.

---

# 33. `/tests/Architecture`

Este directorio tendrá especial importancia en MEF.

Podrá contener pruebas para verificar:

- dirección de dependencias;
- acceso entre Modules;
- cumplimiento de Contracts;
- ausencia de ciclos;
- estructura de Packages;
- cumplimiento de `AI` y `EI`.

Ejemplo conceptual:

```text
tests/Architecture/
├── CoreDependencyTest
├── ModuleBoundaryTest
├── ContractDependencyTest
└── ManifestComplianceTest
```

---

# 34. Directorio `/examples`

Contendrá implementaciones o usos demostrativos.

Ejemplo:

```text
examples/
├── minimal/
├── modular-application/
└── extension-example/
```

Los ejemplos deberán ser ejecutables o verificables cuando corresponda.

No deberán contener patrones contrarios a la especificación oficial.

---

# 35. Directorio `/tools`

Contendrá herramientas de desarrollo propias del proyecto.

Ejemplos:

```text
tools/
├── validators/
├── generators/
├── migration/
└── scripts/
```

Estas herramientas no forman necesariamente parte del Runtime.

---

# 36. Directorio `/packages`

Podrá utilizarse como espacio de construcción o composición de Packages cuando la implementación lo requiera.

No deberá convertirse en fuente primaria duplicada del código.

Ejemplo conceptual:

```text
packages/
└── build-output/
```

La estrategia definitiva corresponderá a `ENG-013`.

---

# 37. Directorio `/var`

Podrá contener datos generados en Runtime o durante tooling.

Ejemplo:

```text
var/
├── cache/
├── logs/
├── tmp/
└── runtime/
```

No deberá contener código fuente.

---

# 38. Archivos de Raíz

Un repositorio MEF completo podrá contener:

```text
README.md
LICENSE
CHANGELOG.md
CONTRIBUTING.md
CODE_OF_CONDUCT.md
SECURITY.md
mef.manifest.json
```

No todos serán obligatorios para todo tipo de Package.

---

# 39. README

El `README.md` de raíz deberá explicar al menos:

- propósito;
- requisitos;
- instalación;
- uso básico;
- referencia documental.

Los Packages importantes deberán disponer de README propio cuando corresponda.

---

# 40. CHANGELOG

Los componentes versionados deberán mantener historial de cambios cuando aplique.

La ubicación preferida será la raíz del componente versionado.

Ejemplo:

```text
modules/Crm/CHANGELOG.md
```

---

# 41. LICENSE

Todo componente distribuido deberá incluir o referenciar adecuadamente su licencia.

No deberá perderse la información de licencia durante Packaging.

---

# 42. Separación Source / Generated

El código generado deberá poder distinguirse del código fuente mantenido manualmente.

Una implementación podrá adoptar:

```text
generated/
```

cuando resulte útil.

Ejemplo:

```text
src/generated/
```

No se recomienda mezclar silenciosamente archivos generados y manuales cuando eso dificulte identificar su origen.

---

# 43. Separación Source / Vendor

Las dependencias de terceros deberán mantenerse separadas del código propio.

Conceptualmente:

```text
Own Source
   ≠
Third-party Dependencies
```

La ubicación concreta dependerá del Package Manager.

---

# 44. Directorios Genéricos

Se evitarán directorios como:

```text
misc/
common/
utils/
helpers/
stuff/
others/
temp-code/
```

como solución predeterminada para elementos difíciles de clasificar.

Si un artefacto no encuentra ubicación natural, deberá revisarse su responsabilidad.

---

# 45. Directorio `Support`

`Support/` podrá existir únicamente para componentes técnicos verdaderamente compartidos y claramente delimitados.

No deberá convertirse en un sinónimo de:

```text
Everything Else
```

---

# 46. Profundidad

La estructura deberá evitar profundidad innecesaria.

Se evitarán rutas excesivas como:

```text
modules/Crm/Application/Services/Customer/Creation/Internal/Handlers/
```

cuando una estructura más simple preserve el mismo significado.

La profundidad deberá justificar separación real.

---

# 47. Directorios Vacíos

No deberán crearse directorios únicamente para cumplir una plantilla si el componente no utiliza esa responsabilidad.

Ejemplo:

Un Module sin Domain no deberá contener:

```text
Domain/
```

vacío únicamente por convención.

---

# 48. Evolución de la Estructura

Los directorios podrán evolucionar cuando:

- cambie una responsabilidad;
- se introduzca una nueva capacidad;
- sea necesario reducir acoplamiento;
- cambie un perfil técnico.

Mover archivos sin cambiar identidad lógica no deberá alterar automáticamente los IDs arquitectónicos.

---

# 49. Independencia de Ruta

La identidad de un artefacto no deberá depender de su ubicación física.

Ejemplo:

```text
MOD-CRM
```

seguirá siendo:

```text
MOD-CRM
```

aunque su implementación se mueva físicamente dentro del repositorio.

---

# 50. Rutas Públicas

Las rutas físicas internas no deberán utilizarse como APIs públicas salvo que una especificación lo declare expresamente.

Los consumidores deberán utilizar:

- Contracts;
- APIs;
- Package identifiers;
- resolvers;
- mecanismos oficiales.

---

# 51. Descubrimiento

El Framework podrá utilizar la estructura física como uno de varios mecanismos para Discovery.

Sin embargo:

> **La ubicación no sustituye al Manifest.**

El Manifest seguirá siendo la fuente declarativa para identidad y composición.

---

# 52. Discovery Example

```text
modules/
    │
    ▼
Locate Package
    │
    ▼
Read mef.manifest.json
    │
    ▼
Validate
    │
    ▼
Register
```

El directorio permite localizar.

El Manifest permite comprender.

---

# 53. Packaging

La estructura de un Package deberá permitir extraer:

```text
Package
├── Manifest
├── Source
├── Contracts
├── Configuration
├── Resources
├── Documentation
└── Tests (cuando corresponda)
```

El formato final de distribución será definido en ENG-013.

---

# 54. Estructura Monorepo

MEF podrá utilizar una organización monorepo.

Ejemplo:

```text
/
├── src/
├── modules/
├── extensions/
├── tools/
├── docs/
└── tests/
```

Esto no implica que MEF requiera monorepo.

---

# 55. Estructura Multirepo

También podrán existir repositorios independientes:

```text
mef-core
mef-crm
mef-identity
mef-reporting
```

Cada repositorio deberá preservar:

- Manifest;
- identidad;
- versión;
- documentación;
- dependencias.

---

# 56. Monorepo vs Multirepo

La elección no deberá modificar la arquitectura conceptual.

```text
Repository Topology
        ≠
Architecture
```

Un Module sigue siendo un Module independientemente del repositorio donde se encuentre.

---

# 57. Aplicaciones

Las Applications construidas sobre MEF deberán mantenerse separadas del Framework.

Conceptualmente:

```text
framework/
applications/
```

o repositorios independientes.

No deberán mezclarse funcionalidades específicas de una Application dentro de `src/Core`.

---

# 58. Application Modules

Una Application podrá contener Modules propios.

Ejemplo conceptual:

```text
application/
└── modules/
    ├── Sales/
    └── Procurement/
```

Estos deberán respetar ENG-002 aunque no formen parte del Framework oficial.

---

# 59. Framework Modules vs Application Modules

Deberá distinguirse entre:

```text
Official MEF Module
```

y

```text
Application-specific Module
```

Ambos podrán utilizar la misma especificación técnica.

La diferencia reside en:

- propiedad;
- distribución;
- soporte;
- gobernanza.

---

# 60. Profiles

Cada lenguaje podrá definir un perfil físico.

Ejemplo conceptual:

```text
MEF Universal
   │
   ├── PHP Profile
   ├── Java Profile
   ├── .NET Profile
   └── TypeScript Profile
```

Un perfil podrá adaptar:

- ubicación de source;
- casing;
- namespaces;
- tests;
- recursos;
- build files.

---

# 61. Ejemplo de Perfil PHP

Puramente ilustrativo:

```text
src/
modules/
tests/
config/
resources/
composer.json
```

Esto no convierte Composer o PHP en requisitos universales.

---

# 62. Ejemplo de Perfil Java

Conceptualmente:

```text
src/main/
src/test/
modules/
resources/
build-file
```

La implementación deberá mapear los límites universales de MEF a las convenciones de la plataforma.

---

# 63. Validación Estructural

La estructura podrá validarse automáticamente.

Ejemplo:

```text
Project
   │
   ▼
Structure Validator
   │
   ├── Manifest Present
   ├── Module Boundaries
   ├── Forbidden Directories
   ├── Required Files
   └── Naming Rules
```

---

# 64. Validator

El futuro Validator deberá evitar reglas excesivamente rígidas.

Deberá distinguir:

```text
Required
Recommended
Optional
Forbidden
```

No todos los proyectos necesitarán exactamente los mismos directorios.

---

# 65. Estructura Mínima de Module

Como mínimo, un Module distribuible deberá poder representarse mediante:

```text
Module/
├── Source or Implementation
├── README.md
└── mef.manifest.json
```

Y además disponer de:

- pruebas;
- documentación suficiente;
- dependencias explícitas;

aunque la ubicación concreta pueda depender del perfil.

---

# 66. Estructura Recomendada de Module

Para Modules complejos:

```text
Module/
├── Contracts/
├── Application/
├── Domain/
├── Infrastructure/
├── Providers/
├── Configuration/
├── Resources/
├── Tests/
├── README.md
├── CHANGELOG.md
└── mef.manifest.json
```

---

# 67. Tests Colocados junto al Código

Un perfil podrá permitir:

```text
src/
└── Customer/
    ├── CustomerService
    └── CustomerServiceTest
```

si esto es idiomático para la plataforma.

ENG-006 no obliga universalmente a separar tests físicamente.

Sí obliga a mantener trazabilidad y diferenciación clara.

---

# 68. Generated Packages

Los artefactos de build no deberán escribirse dentro de las carpetas de source salvo que la plataforma lo requiera expresamente.

Se favorecerá una separación del tipo:

```text
source/
build/
dist/
```

o equivalente.

---

# 69. Cache

Los archivos de cache deberán permanecer fuera de source y no deberán versionarse salvo caso excepcional documentado.

---

# 70. Temporary Files

Los temporales deberán permanecer en áreas descartables.

No deberán convertirse en dependencias permanentes del proyecto.

---

# 71. Logs

Los logs no deberán almacenarse dentro de:

```text
src/
modules/
docs/
```

Deberán residir en ubicación operativa apropiada.

---

# 72. User Data

La información generada por usuarios o Applications no deberá almacenarse junto al código fuente del Framework salvo que exista una razón específica y controlada.

---

# 73. Security Boundaries

La estructura física podrá reforzar límites de seguridad.

Ejemplos:

- secretos fuera del repositorio;
- código ejecutable separado de uploads;
- generated files separados de source;
- terceros separados de código propio.

La estructura no sustituye controles de seguridad adicionales.

---

# 74. Access Control

Cuando el entorno lo permita, los permisos físicos deberán alinearse con responsabilidades.

Por ejemplo:

```text
source        → read-only in production
runtime cache → writable
logs          → writable
secrets       → restricted
```

La política concreta pertenecerá al perfil de operación.

---

# 75. Normalización de Rutas

Las herramientas MEF deberán utilizar abstracciones de rutas cuando resulte necesario para mantener portabilidad.

No deberán asumir arbitrariamente:

```text
/
\
drive letters
```

como parte de la lógica arquitectónica.

---

# 76. Case Sensitivity

Las herramientas deberán considerar que algunos sistemas de archivos distinguen mayúsculas y minúsculas y otros no.

Por ello, los nombres canónicos deberán mantenerse consistentemente.

---

# 77. Rutas en Manifest

Las rutas declaradas en Manifest deberán ser relativas al Package cuando sea posible.

Ejemplo:

```json
{
  "configuration": {
    "schema": "Configuration/config.schema.json"
  }
}
```

No deberán utilizarse rutas absolutas específicas de una máquina.

---

# 78. Portabilidad

La estructura deberá permitir mover un Package entre entornos sin modificar sus rutas internas declarativas.

```text
Local
  ↓
CI
  ↓
Package
  ↓
Production
```

La identidad deberá permanecer estable.

---

# 79. Git

Los repositorios deberán evitar versionar:

- caches;
- logs;
- temporales;
- secretos;
- build artifacts cuando no sea necesario;
- dependencias regenerables.

El detalle se gestionará mediante archivos y perfiles de control de versiones.

---

# 80. Generated vs Committed

No todo código generado deberá excluirse de Git.

La política dependerá de si:

- puede regenerarse;
- es parte de una API pública;
- es necesario para consumidores;
- su generación depende de tooling no disponible.

La decisión deberá ser explícita.

---

# 81. Invariantes de Ingeniería

ENG-006 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-081 | La estructura física deberá reflejar límites arquitectónicos existentes. |
| EI-082 | La ubicación física de un artefacto no determinará su identidad arquitectónica. |
| EI-083 | El Core no deberá contener Modules de negocio o Application code. |
| EI-084 | Los Modules deberán mantener fronteras físicas reconocibles. |
| EI-085 | Los detalles de infraestructura deberán permanecer separados de Contracts cuando corresponda. |
| EI-086 | Los secretos no deberán almacenarse dentro de la estructura versionada del proyecto. |
| EI-087 | Los artefactos de Runtime no deberán mezclarse con Source. |
| EI-088 | Las dependencias de terceros deberán permanecer diferenciadas del código propio. |
| EI-089 | Los directorios genéricos sin responsabilidad explícita deberán evitarse. |
| EI-090 | Un Module distribuible deberá disponer de Manifest en su raíz lógica. |
| EI-091 | La estructura no deberá obligar a crear directorios vacíos sin responsabilidad real. |
| EI-092 | Monorepo o Multirepo no deberán modificar los límites arquitectónicos. |
| EI-093 | Las rutas declarativas deberán favorecer portabilidad. |
| EI-094 | La estructura deberá permitir validación automatizada cuando sea razonable. |
| EI-095 | Las Applications deberán permanecer separadas del Core del Framework. |

---

# 82. Criterios de Conformidad

Una estructura será conforme con ENG-006 cuando:

- refleje los límites definidos por Arquitectura;
- preserve separación Core / Platform / Modules / Infrastructure;
- mantenga Modules identificables;
- incluya Manifest donde corresponda;
- separe Runtime de Source;
- separe terceros de código propio;
- no almacene secretos en repositorio;
- sea portable;
- respete ENG-005;
- pueda validarse estructuralmente;
- documente excepciones del perfil técnico.

---

# 83. Riesgos

Deberán evitarse especialmente:

## Architecture by Folder

Suponer que crear una carpeta equivale a crear una arquitectura.

## Directory Explosion

Crear demasiados niveles sin responsabilidades reales.

## Flat Monolith

Colocar todo el código en una estructura plana que destruya límites.

## Shared Dump

Utilizar `common`, `utils` o `helpers` como depósitos.

## Runtime Pollution

Mezclar logs, cache y temporales con Source.

## Vendor Leakage

Integrar dependencias externas directamente en la estructura conceptual.

## Application Leakage

Introducir necesidades de una Application dentro del Core.

---

# 84. Relación con Generators

ENG-008 deberá generar estructuras conformes con ENG-006.

Ejemplo conceptual:

```text
mef module create crm
```

podrá generar:

```text
modules/Crm/
├── Contracts/
├── Application/
├── Infrastructure/
├── Tests/
├── README.md
└── mef.manifest.json
```

El Generator deberá omitir directorios innecesarios cuando pueda determinarlo.

---

# 85. Relación con CLI

ENG-007 utilizará esta estructura para:

- Discovery;
- generación;
- validación;
- inspección;
- Packaging.

Sin embargo, CLI deberá priorizar Manifest sobre heurísticas de ruta cuando exista información explícita.

---

# 86. Relación con Package Manager

ENG-013 deberá poder instalar un Package preservando:

- identidad;
- estructura;
- dependencias;
- integridad.

La ubicación de instalación podrá variar según el perfil.

---

# 87. Relación con Build System

ENG-012 distinguirá entre:

```text
Source
   ↓
Build
   ↓
Artifact
```

Los outputs no deberán confundirse con la estructura fuente.

---

# 88. Relación con Testing

ENG-009 determinará la política definitiva para:

- tests junto al código;
- tests separados;
- fixtures;
- test resources;
- architecture tests.

ENG-006 únicamente exige separación semántica suficiente.

---

# 89. Principio Rector

> **La estructura física de MEF deberá materializar límites y responsabilidades arquitectónicas de forma predecible, portable y verificable, sin convertir rutas, herramientas o convenciones específicas de plataforma en fundamentos universales del Framework.**

---

# 90. Conclusión

**ENG-006 — Estructura de Directorios** establece la materialización física de referencia para las implementaciones de MEF.

Su objetivo no es imponer una única distribución rígida de archivos.

Busca garantizar que cualquier perfil tecnológico preserve:

```text
Architecture
     ↓
Logical Organization
     ↓
Naming
     ↓
Physical Structure
     ↓
Tooling
```

La estructura deberá ayudar a comprender el sistema, no ocultarlo.

MEF reconoce que PHP, Java, .NET, TypeScript y otros entornos poseen convenciones físicas diferentes. Por ello, la especificación define **responsabilidades y fronteras universales**, permitiendo que cada perfil adapte la disposición concreta sin perder la semántica arquitectónica.

---

# Referencias

## Fundación

- FND-013 — Independencia del Framework

## Arquitectura

- ARQ-002 — Core
- ARQ-003 — Platform
- ARQ-004 — Modules
- ARQ-015 — Extension Model
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-001 — Organización del Código
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager