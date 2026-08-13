---
id: ENG-007
titulo: CLI
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: CLI
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-003
  - ENG-004
  - ENG-005
  - ENG-006
  - ARQ-005
  - ARQ-006
  - ARQ-014
relacionados:
  - ENG-008
  - ENG-009
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-014
keywords:
  - cli
  - commands
  - tooling
  - validation
  - modules
  - manifest
  - packages
  - automation
  - mef
---

# ENG-007

# CLI

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica de la **Command Line Interface (CLI)** oficial de **MEF (Modular Enterprise Framework)**.

El CLI proporciona una interfaz uniforme para ejecutar operaciones de Ingeniería sobre:

- Modules;
- Manifests;
- Contracts;
- Packages;
- configuración;
- validación;
- generación;
- arquitectura;
- Lifecycle;
- tooling.

Su objetivo es permitir operaciones consistentes, automatizables y trazables sin introducir reglas paralelas a las especificaciones oficiales.

---

# 2. Declaración

El CLI constituye una interfaz de operación.

No constituye una fuente de verdad arquitectónica.

La relación deberá ser:

```text
Specification
     │
     ▼
Engineering Rule
     │
     ▼
CLI Command
     │
     ▼
Execution
```

Nunca:

```text
CLI Behavior
     │
     ▼
New Architecture Rule
```

---

# 3. Nombre Canónico

La interfaz de línea de comandos utilizará conceptualmente:

```text
mef
```

Ejemplo:

```text
mef module validate
```

El nombre físico del ejecutable podrá adaptarse a cada plataforma.

La identidad conceptual permanecerá `mef`.

---

# 4. Objetivos

El CLI deberá:

- proporcionar comandos previsibles;
- reducir tareas manuales;
- automatizar validaciones;
- facilitar generación;
- facilitar diagnóstico;
- servir tanto a personas como CI/CD;
- exponer errores estructurados;
- preservar trazabilidad;
- evitar comportamiento implícito peligroso.

---

# 5. Filosofía

El CLI deberá favorecer:

```text
Explicit
Predictable
Composable
Scriptable
Inspectable
Safe
```

Se evitará:

```text
Magic
Implicit Mutation
Hidden State
Silent Failure
Undocumented Side Effects
```

---

# 6. Modelo de Comandos

La estructura general será:

```text
mef <resource> <action> [arguments] [options]
```

Ejemplos:

```text
mef module create crm
mef module validate crm
mef manifest validate
mef package install PKG-CRM
```

Se favorecerá una gramática consistente basada en:

```text
Resource + Action
```

---

# 7. Recursos Principales

La primera versión del CLI podrá reconocer recursos como:

```text
module
manifest
package
contract
architecture
config
extension
registry
project
```

Los nuevos recursos deberán incorporarse de forma gobernada.

---

# 8. Acciones Comunes

Cuando sea semánticamente correcto, los recursos deberían reutilizar acciones consistentes.

Ejemplos:

```text
create
validate
inspect
list
get
install
remove
enable
disable
build
test
check
publish
```

El mismo verbo deberá conservar significado equivalente entre recursos.

---

# 9. Comandos de Module

La interfaz podrá incluir:

```text
mef module create <name>
mef module validate <module>
mef module inspect <module>
mef module list
mef module enable <module>
mef module disable <module>
```

Las operaciones concretas deberán delegar en servicios de Ingeniería.

El CLI no deberá implementar directamente la lógica del Module.

---

# 10. `module create`

Conceptualmente:

```text
mef module create crm
```

deberá coordinar:

```text
Naming Validation
      ↓
Structure Generation
      ↓
Manifest Generation
      ↓
Initial Documentation
      ↓
Initial Tests
      ↓
Validation
```

La generación concreta será responsabilidad de **ENG-008 — Generadores**.

---

# 11. `module validate`

Deberá verificar al menos:

- Manifest;
- identidad;
- estructura;
- dependencias;
- Contracts;
- Lifecycle;
- convenciones;
- invariantes aplicables.

Conceptualmente:

```text
mef module validate MOD-CRM
```

Resultado:

```text
VALID
```

o una colección estructurada de errores.

---

# 12. `module inspect`

Deberá proporcionar información sin modificar el Module.

Podrá mostrar:

- ID;
- nombre;
- versión;
- tipo;
- estado;
- capacidades;
- dependencias;
- Contracts;
- Events;
- Extension Points.

---

# 13. Comandos de Manifest

La interfaz deberá soportar operaciones como:

```text
mef manifest validate
mef manifest inspect
mef manifest normalize
```

`validate` comprobará conformidad con ENG-003.

`inspect` mostrará información declarada.

`normalize` podrá producir una representación canónica cuando la especificación lo permita.

---

# 14. Comandos de Package

Podrán incluir:

```text
mef package build
mef package validate
mef package inspect
mef package install <package>
mef package remove <package>
mef package list
```

Las operaciones de administración corresponderán a ENG-013.

---

# 15. Comandos de Contract

Podrán incluir:

```text
mef contract list
mef contract inspect <id>
mef contract implementations <id>
```

El CLI podrá consultar Registry y metadata.

No deberá inferir Contracts mediante heurísticas cuando exista un catálogo oficial.

---

# 16. Comandos de Architecture

MEF deberá reservar un espacio específico para validación arquitectónica.

Ejemplos:

```text
mef architecture validate
mef architecture dependencies
mef architecture graph
mef architecture invariants
```

Esto permitirá convertir `AI` y `EI` en validaciones progresivamente ejecutables.

---

# 17. `architecture validate`

Podrá ejecutar:

```text
Structure Validation
Dependency Validation
Contract Validation
Invariant Validation
Cycle Detection
Manifest Validation
```

El resultado deberá ser adecuado para ejecución local y CI.

---

# 18. `architecture graph`

Podrá producir representaciones de:

- dependencias;
- Modules;
- Contracts;
- Events;
- Packages;
- Extension Points.

La salida podrá ser textual o estructurada.

Ejemplo conceptual:

```text
MOD-CRM
 ├── CT-IDENTITY-001
 └── MOD-NOTIFICATIONS (optional)
```

---

# 19. Comandos de Registry

Podrán existir:

```text
mef registry list
mef registry inspect <id>
mef registry search <query>
```

Estas operaciones serán principalmente de lectura.

Las escrituras deberán ocurrir mediante mecanismos de Lifecycle o Package Management, no mediante edición arbitraria del Registry.

---

# 20. Comandos de Configuration

Podrán incluir:

```text
mef config validate
mef config inspect
mef config list
```

Los secretos deberán enmascararse siempre.

---

# 21. Comandos de Extension

Podrán incluir:

```text
mef extension validate
mef extension list
mef extension enable
mef extension disable
```

Toda operación deberá respetar ARQ-015.

---

# 22. Comandos de Project

Para proyectos completos podrán existir:

```text
mef project init
mef project validate
mef project inspect
mef project doctor
```

`project doctor` tendrá propósito diagnóstico.

No deberá modificar silenciosamente el proyecto salvo opción explícita.

---

# 23. Comandos de Generación

Los comandos de generación podrán utilizar una estructura como:

```text
mef make:module
```

o:

```text
mef make module
```

Sin embargo, MEF deberá escoger una convención única.

La convención recomendada será:

```text
mef make <artifact>
```

Ejemplos:

```text
mef make module
mef make contract
mef make event
mef make command
mef make query
mef make provider
```

Esto mantiene consistencia con el modelo `resource + action`.

---

# 24. Regla de Mutación Explícita

Todo comando que modifique archivos, configuración, Registry o Packages deberá hacerlo explícitamente.

Un comando aparentemente informativo no deberá modificar estado.

Por ejemplo:

```text
inspect
list
get
validate
check
```

deberán ser read-only salvo especificación explícita.

---

# 25. Confirmaciones

Las operaciones destructivas deberán requerir confirmación interactiva cuando se ejecuten manualmente.

Ejemplos:

```text
package remove
module delete
project reset
```

En automatización podrá utilizarse una opción explícita:

```text
--yes
```

o equivalente.

---

# 26. Dry Run

Las operaciones mutables importantes deberían soportar:

```text
--dry-run
```

Ejemplo:

```text
mef package install PKG-CRM --dry-run
```

Deberá mostrar:

- cambios previstos;
- dependencias;
- archivos afectados;
- conflictos;
- validaciones.

Sin realizar modificaciones.

---

# 27. Force

La opción:

```text
--force
```

deberá utilizarse con extrema restricción.

No deberá permitir violar:

- seguridad;
- integridad;
- invariantes fundamentales;
- incompatibilidades críticas.

`--force` podrá omitir protecciones operativas menores, pero no reglas estructurales obligatorias.

---

# 28. Salidas

El CLI deberá soportar al menos salida humana.

Ejemplo:

```text
Module MOD-CRM is valid.
```

También debería soportar formatos estructurados para automatización.

Ejemplo:

```text
--format=json
```

---

# 29. Formatos de Salida

Podrán reconocerse:

```text
text
json
```

Otros formatos podrán añadirse.

La salida JSON deberá ser estable y versionable cuando sea utilizada por herramientas externas.

---

# 30. Salida Estructurada

Ejemplo conceptual:

```json
{
  "status": "success",
  "command": "module.validate",
  "resource": "MOD-CRM",
  "errors": [],
  "warnings": []
}
```

Las herramientas no deberán depender de analizar texto destinado a humanos.

---

# 31. Exit Codes

El CLI deberá utilizar códigos de salida consistentes.

Propuesta inicial:

```text
0   Success
1   General failure
2   Invalid usage
3   Validation failure
4   Compatibility failure
5   Dependency failure
6   Security failure
7   Not found
8   Conflict
```

La taxonomía definitiva deberá documentarse y mantenerse estable.

---

# 32. Errores

Todo error deberá proporcionar:

- código;
- mensaje;
- contexto relevante;
- sugerencia cuando sea razonable.

Ejemplo:

```text
MEF-MAN-004
Missing dependency: MOD-IDENTITY
```

No deberá mostrarse únicamente:

```text
Error.
```

---

# 33. Warnings

Las advertencias deberán diferenciarse de errores.

Un warning no deberá causar código de salida de error salvo que se utilice una política estricta.

Podrá existir:

```text
--strict
```

para convertir determinadas advertencias en fallos.

---

# 34. Verbosity

El CLI podrá admitir:

```text
--quiet
--verbose
--debug
```

La salida de debug no deberá exponer secretos.

---

# 35. Logging

El CLI podrá producir logs técnicos adicionales cuando corresponda.

Los mensajes interactivos no deberán confundirse con logs operativos persistentes.

---

# 36. Interactive vs Non-Interactive

El CLI deberá poder operar en:

```text
Interactive Mode
Non-Interactive Mode
```

CI/CD deberá poder utilizar el modo no interactivo.

Ejemplo:

```text
--no-interaction
```

---

# 37. Determinismo

Los comandos utilizados en automatización deberán producir resultados deterministas cuando las entradas y el entorno relevante sean equivalentes.

Especialmente:

```text
validate
build
normalize
generate
```

---

# 38. Idempotencia

Las operaciones deberán declarar cuando sean idempotentes.

Ejemplo:

```text
mef module validate
```

es naturalmente idempotente.

La instalación de Packages deberá diseñarse para manejar de forma segura estados ya aplicados.

---

# 39. Configuración del CLI

La configuración del CLI deberá provenir del sistema oficial de Configuration.

No deberán mantenerse parámetros ocultos en directorios personales sin una regla explícita de precedencia.

---

# 40. Precedencia de Parámetros

Cuando exista un mismo valor en múltiples fuentes, la precedencia deberá ser explícita.

Ejemplo conceptual:

```text
CLI option
    ↓
Environment
    ↓
Project configuration
    ↓
Default
```

La precedencia definitiva deberá mantenerse documentada.

---

# 41. Secrets

Los secretos proporcionados al CLI deberán evitar:

```text
command history
process listings
logs
error dumps
```

cuando exista una alternativa más segura.

Se favorecerán mecanismos específicos de secrets o entrada segura.

---

# 42. Paths

Los comandos deberán aceptar rutas portables.

Se evitarán suposiciones específicas de sistema operativo.

Ejemplo:

```text
mef manifest validate ./modules/Crm/mef.manifest.json
```

---

# 43. Current Working Directory

El CLI podrá utilizar el directorio actual para localizar contexto de proyecto.

Sin embargo, la detección deberá ser explícita y diagnosticable.

Un comando como:

```text
mef project inspect
```

deberá poder indicar qué raíz de proyecto detectó.

---

# 44. Project Root Discovery

La raíz podrá localizarse mediante indicadores oficiales como:

```text
mef.manifest.json
```

o configuración de proyecto.

No deberá depender únicamente de nombres de carpetas.

---

# 45. Autocomplete

El CLI debería diseñarse para permitir autocompletado de shell.

Ejemplos:

```text
module IDs
package IDs
contract IDs
commands
options
```

La implementación dependerá del entorno.

---

# 46. Help

Todo comando deberá proporcionar ayuda.

Ejemplos:

```text
mef --help
mef module --help
mef module validate --help
```

La ayuda deberá reflejar la especificación vigente.

---

# 47. Version

El CLI deberá exponer su versión:

```text
mef --version
```

La versión del CLI no deberá confundirse necesariamente con:

- versión de MEF;
- Manifest Schema;
- Module;
- Package.

Cuando difieran, deberán mostrarse claramente.

---

# 48. Doctor

Un comando diagnóstico como:

```text
mef doctor
```

podrá inspeccionar:

- Runtime;
- configuración;
- permisos;
- dependencias;
- estructura;
- herramientas;
- Registry;
- compatibilidad.

Deberá ser principalmente read-only.

---

# 49. CI Mode

Podrá existir un modo:

```text
--ci
```

que ajuste:

- colores;
- interacción;
- formato;
- detalle de salida.

No deberá cambiar las reglas de validación.

---

# 50. Color

El uso de color deberá ser opcional.

Las herramientas deberán poder desactivarlo:

```text
--no-color
```

La información crítica no deberá depender exclusivamente del color.

---

# 51. Progress Indicators

Las barras de progreso deberán evitarse en salida estructurada o CI cuando interfieran con parsing.

---

# 52. Streaming

Los comandos largos podrán emitir progreso incremental.

La salida estructurada deberá mantener un contrato claro si soporta streaming.

---

# 53. Plugins del CLI

En el futuro el CLI podrá admitir extensión controlada de comandos.

Toda extensión deberá:

- declarar identidad;
- utilizar un Extension Point oficial;
- evitar colisiones;
- respetar seguridad;
- documentar comandos.

No deberá permitirse que Packages arbitrarios sobrescriban comandos Core.

---

# 54. Namespaces de Comandos

Los comandos deberán agruparse por recurso para evitar colisiones.

Ejemplo:

```text
module validate
package validate
manifest validate
```

es preferible a múltiples comandos globales ambiguos:

```text
validate-module
validate-package
validate-manifest
```

---

# 55. Comandos Reservados

Términos fundamentales como:

```text
module
package
manifest
architecture
registry
config
```

deberán reservarse para el CLI oficial.

---

# 56. Backward Compatibility

Cambiar:

```text
mef module validate
```

por otra gramática incompatible deberá evaluarse como cambio de interfaz pública.

La CLI constituye una API para humanos y automatización.

---

# 57. Deprecación de Comandos

Los comandos deprecados deberán:

- seguir funcionando durante un periodo definido cuando sea viable;
- mostrar advertencia;
- indicar alternativa;
- documentar versión de retiro.

---

# 58. Aliases

Los aliases podrán existir para migración o ergonomía.

No deberán convertirse en múltiples nombres canónicos.

Ejemplo:

```text
Canonical:
mef package remove

Temporary alias:
mef package uninstall
```

La especificación deberá determinar cuál es la forma oficial.

---

# 59. Scriptability

Los comandos deberán diseñarse para pipelines.

Ejemplo:

```text
mef manifest validate --format=json
```

podrá integrarse con CI.

No deberá requerir interacción cuando se especifique modo no interactivo.

---

# 60. Composition

Las salidas y códigos deberán permitir composición con herramientas externas.

El CLI no deberá asumir que será utilizado únicamente por una persona.

---

# 61. No Business Logic

El CLI no deberá contener lógica de negocio ni reglas arquitectónicas duplicadas.

La estructura deberá ser:

```text
CLI
 │
 ▼
Application Service / Tool Service
 │
 ▼
Engineering Components
```

El CLI adapta entrada y salida.

---

# 62. Thin CLI

El CLI deberá mantenerse delgado.

Sus responsabilidades principales serán:

- parsear argumentos;
- validar sintaxis de comando;
- invocar capacidades;
- presentar resultado;
- mapear errores a exit codes.

---

# 63. Command Contract

Cada comando debería poder describirse mediante:

```text
Name
Arguments
Options
Input
Output
Exit Codes
Side Effects
Permissions
```

Esto permitirá documentación y testing automáticos.

---

# 64. Comando como Artefacto

MEF podrá considerar los comandos CLI como artefactos registrables.

Ejemplo conceptual:

```text
CLI-MODULE-VALIDATE
```

No es necesario definir este esquema en la primera implementación, pero la arquitectura deberá permitirlo.

---

# 65. Testing del CLI

Los comandos deberán poder probarse sin requerir terminal física.

Las pruebas deberían cubrir:

- parsing;
- opciones;
- exit codes;
- salida;
- errores;
- comportamiento no interactivo.

ENG-009 detallará la estrategia.

---

# 66. Security

Los comandos sensibles deberán considerar autorización cuando el entorno lo requiera.

Ejemplo:

```text
package install
extension enable
registry mutation
```

El CLI no deberá asumir que ejecutar el binario implica autorización absoluta.

---

# 67. Auditability

Las operaciones administrativas relevantes deberían poder generar registros de auditoría.

Ejemplo:

```text
Package installed
Module disabled
Extension enabled
```

El audit log no deberá depender únicamente del texto mostrado en consola.

---

# 68. Remote Operations

La primera versión del CLI podrá ser local.

Si posteriormente soporta operaciones remotas, estas deberán:

- utilizar Contracts explícitos;
- autenticar;
- autorizar;
- cifrar;
- manejar fallos de red.

El comando no deberá cambiar de semántica silenciosamente entre local y remoto.

---

# 69. Offline Mode

Las operaciones que no requieran red deberían funcionar offline.

Ejemplos:

```text
manifest validate
architecture validate
module inspect local
```

El CLI no deberá introducir dependencia de red innecesaria.

---

# 70. Telemetría

La telemetría del CLI deberá ser:

- explícita;
- documentada;
- respetuosa de privacidad;
- desactivable cuando corresponda.

No deberá enviar código, secretos o información sensible sin autorización.

---

# 71. Performance

Los comandos frecuentes deberían evitar inicializar componentes del Runtime que no necesiten.

Por ejemplo:

```text
manifest validate
```

no debería arrancar toda la aplicación.

Esto preserva una herramienta rápida y segura.

---

# 72. Lazy Initialization

El CLI deberá cargar únicamente las capacidades requeridas por el comando cuando resulte razonable.

---

# 73. Bootstrap Mínimo

Conceptualmente:

```text
CLI Start
   ↓
Parse Command
   ↓
Load Required Configuration
   ↓
Initialize Required Services
   ↓
Execute
   ↓
Exit
```

No todos los comandos deberán atravesar el Lifecycle completo de una Application.

---

# 74. Command Discovery

Los comandos oficiales podrán registrarse mediante metadata o Providers.

El mecanismo concreto deberá evitar ejecutar código no confiable durante Discovery.

---

# 75. Manifest Integration

Un Package podrá declarar capacidades CLI si el Extension Model lo permite.

Estas deberán validarse antes de activarse.

---

# 76. Naming

ENG-007 deberá respetar ENG-005.

Por tanto:

```text
mef module create
mef manifest validate
mef package install
```

serán preferidos frente a gramáticas inconsistentes.

---

# 77. Documentation Generation

La documentación de comandos debería poder generarse parcialmente a partir de sus Contracts.

Ejemplo:

```text
Command Specification
       │
       ├── CLI Help
       ├── Reference Docs
       └── Completion Metadata
```

Esto reduce divergencia.

---

# 78. Machine-Readable Command Catalog

En el futuro el CLI podrá exponer:

```text
mef commands --format=json
```

para permitir inspección de:

- comandos;
- argumentos;
- opciones;
- versiones;
- permisos.

---

# 79. Invariantes de Ingeniería

ENG-007 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-096 | El CLI no deberá constituir una fuente paralela de reglas arquitectónicas. |
| EI-097 | Los comandos deberán utilizar una gramática consistente. |
| EI-098 | Los comandos informativos deberán ser read-only salvo declaración explícita. |
| EI-099 | Las operaciones destructivas deberán ser explícitas y controladas. |
| EI-100 | El CLI deberá proporcionar códigos de salida adecuados para automatización. |
| EI-101 | La salida estructurada no deberá requerir parsing de texto humano. |
| EI-102 | El CLI no deberá exponer secretos en salida, logs o diagnóstico. |
| EI-103 | Las operaciones automatizables deberán disponer de modo no interactivo cuando corresponda. |
| EI-104 | El CLI deberá delegar lógica a servicios especializados y mantenerse delgado. |
| EI-105 | Los comandos públicos deberán considerarse interfaces versionables. |
| EI-106 | Los comandos de validación deberán ser deterministas ante entradas equivalentes. |
| EI-107 | Las opciones como `--force` no podrán desactivar invariantes fundamentales. |
| EI-108 | El CLI deberá permitir inspección y validación sin ejecutar innecesariamente el Runtime completo. |
| EI-109 | Las reglas de nomenclatura del CLI deberán respetar ENG-005. |
| EI-110 | Las extensiones del CLI deberán utilizar mecanismos oficiales de extensión. |

---

# 80. Criterios de Conformidad

Una implementación CLI será conforme con ENG-007 cuando:

- utilice `mef` como identidad conceptual;
- mantenga estructura recurso + acción;
- proporcione ayuda;
- utilice exit codes;
- soporte automatización;
- proteja secretos;
- mantenga operaciones read-only separadas de mutaciones;
- delegue la lógica;
- respete nomenclatura;
- permita validación;
- preserve compatibilidad de comandos públicos;
- documente excepciones justificadas.

---

# 81. Riesgos

Deberán evitarse especialmente:

## Fat CLI

Lógica significativa embebida directamente en comandos.

## Magic Mutation

Comandos aparentemente inocuos que modifican estado.

## Human-only Output

Salidas imposibles de consumir de forma fiable por CI.

## Silent Failure

Errores que terminan con código de salida exitoso.

## Secret Leakage

Credenciales visibles en consola o logs.

## Command Drift

Distintas áreas utilizando gramáticas incompatibles.

## Architecture Bypass

Comandos que modifican directamente elementos protegidos evitando Lifecycle, Registry o Package Manager.

---

# 82. Primera Superficie CLI Recomendada

La primera implementación podría comenzar con:

```text
mef --version
mef --help

mef project inspect
mef project validate

mef module create
mef module list
mef module inspect
mef module validate

mef manifest inspect
mef manifest validate

mef architecture validate
mef architecture graph

mef doctor
```

Después podrán incorporarse:

```text
package
extension
registry
config
build
test
release
```

conforme se implementen sus respectivas especificaciones.

---

# 83. Principio Rector

> **El CLI de MEF deberá ofrecer una interfaz explícita, predecible, segura y automatizable para operar sobre las capacidades del Framework, delegando siempre la lógica a las especificaciones y servicios que gobiernan cada operación.**

---

# 84. Conclusión

**ENG-007 — CLI** define la interfaz oficial de línea de comandos de MEF.

Su función no consiste únicamente en facilitar comandos.

El CLI será el punto de integración entre:

```text
Developer
    │
    ▼
CLI
    │
    ▼
Engineering Services
    │
    ▼
Architecture
    │
    ▼
Runtime / Packages / Validators
```

Esto permitirá que operaciones manuales y automatizadas utilicen exactamente las mismas reglas.

El CLI se convierte así en una **fachada de Ingeniería**, no en una arquitectura paralela.

---

# Referencias

## Arquitectura

- ARQ-005 — Kernel
- ARQ-006 — Registry
- ARQ-014 — Framework Lifecycle
- ARQ-015 — Extension Model
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado