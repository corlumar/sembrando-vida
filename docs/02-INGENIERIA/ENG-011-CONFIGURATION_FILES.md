---
id: ENG-011
titulo: Configuration Files
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Configuration
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
  - ENG-010
  - ARQ-013
  - ARQ-016
relacionados:
  - ENG-007
  - ENG-009
  - ENG-012
  - ENG-013
  - ENG-014
  - ENG-015
keywords:
  - configuration
  - config
  - environment
  - secrets
  - schema
  - validation
  - precedence
  - overrides
  - defaults
  - mef
---

# ENG-011

# Configuration Files

## Estado

Accepted.

---

# 1. Propósito

Definir las reglas de Ingeniería para representar, cargar, combinar, validar y consumir la **Configuration** de **MEF (Modular Enterprise Framework)**.

ENG-011 materializa técnicamente el modelo definido por `ARQ-013 — Configuration`.

Su objetivo es proporcionar configuración:

- explícita;
- validable;
- portable;
- predecible;
- segura;
- versionable cuando corresponda;
- independiente de proveedores específicos.

---

# 2. Declaración

Configuration representa valores que modifican el comportamiento permitido de una implementación sin modificar su código fuente.

La configuración no deberá convertirse en:

- lógica de negocio;
- arquitectura dinámica arbitraria;
- almacenamiento de secretos inseguros;
- mecanismo para violar invariantes;
- sustituto del Manifest;
- sustituto del Registry.

La relación será:

```text
Architecture
      ↓
Configuration Model
      ↓
Configuration Schema
      ↓
Configuration Sources
      ↓
Resolution
      ↓
Validation
      ↓
Effective Configuration
      ↓
Runtime
```

---

# 3. Objetivos

El sistema de Configuration deberá:

- permitir configuración por entorno;
- definir defaults seguros;
- soportar overrides controlados;
- validar tipos y valores;
- proteger secretos;
- establecer precedencia;
- detectar configuración desconocida;
- facilitar diagnóstico;
- soportar automatización;
- mantener independencia tecnológica.

---

# 4. Configuration vs Manifest

`Manifest` y `Configuration` no son equivalentes.

## Manifest

Describe identidad y capacidades estructurales.

Ejemplos:

```text
Module ID
Package ID
Version
Dependencies
Contracts
Compatibility
Capabilities
```

## Configuration

Define parámetros operativos.

Ejemplos:

```text
timeout
log level
cache strategy
endpoint
feature setting
```

La regla será:

```text
Manifest
   ↓
What the component IS

Configuration
   ↓
How the component OPERATES
```

---

# 5. Configuration vs Secrets

Un Secret puede ser utilizado como entrada de Configuration.

Sin embargo:

```text
Configuration File
        ≠
Secret Store
```

Los archivos de configuración no deberán considerarse automáticamente mecanismos seguros de almacenamiento de secretos.

---

# 6. Configuration vs Code

La configuración no deberá utilizarse para introducir lógica programática arbitraria.

Se favorecerá:

```text
Declarative Configuration
```

frente a:

```text
Executable Configuration
```

cuando ambas alternativas sean técnicamente viables.

---

# 7. Modelo Conceptual

```text
Configuration Sources
        │
        ├── Defaults
        ├── Project Files
        ├── Environment
        ├── Secret Provider
        └── CLI Overrides
                │
                ▼
        Configuration Loader
                │
                ▼
        Configuration Resolver
                │
                ▼
          Schema Validator
                │
                ▼
       Effective Configuration
                │
                ▼
              Runtime
```

---

# 8. Configuration Source

Una `Configuration Source` representa un origen autorizado de valores.

Ejemplos:

```text
Default Values
Configuration File
Environment Variables
Secret Provider
CLI Arguments
Runtime Provider
```

Los perfiles podrán implementar fuentes adicionales.

---

# 9. Fuentes Iniciales

MEF reconoce conceptualmente:

| ID | Fuente |
|---|---|
| CFG-SRC-001 | Defaults |
| CFG-SRC-002 | Project Configuration |
| CFG-SRC-003 | Environment Configuration |
| CFG-SRC-004 | Environment Variables |
| CFG-SRC-005 | Secret Provider |
| CFG-SRC-006 | CLI Override |

Estas identidades podrán formalizarse posteriormente si se crea un Registry específico.

---

# 10. Precedencia

Cuando una misma propiedad exista en varias fuentes deberá existir una regla determinista de precedencia.

La recomendación inicial será:

```text
CLI Override
      ↓
Environment Variables
      ↓
Environment Configuration
      ↓
Project Configuration
      ↓
Defaults
```

El valor superior sustituye al inferior cuando la propiedad permita override.

---

# 11. Secret Provider

Los Secrets deberán resolverse mediante mecanismos especializados cuando sea posible.

Un Secret Provider no deberá perder prioridad de seguridad por la existencia de otros Configuration Sources.

La implementación deberá evitar convertir secretos resueltos en configuración persistida accidentalmente.

---

# 12. Precedencia Explícita

La precedencia deberá estar documentada.

No deberá depender accidentalmente de:

- orden de archivos del Filesystem;
- orden de carga no documentado;
- orden de iteración;
- comportamiento particular de una biblioteca.

---

# 13. Merge

La combinación de configuraciones deberá utilizar reglas explícitas.

Para valores escalares:

```text
higher precedence wins
```

Ejemplo:

```text
Default:
timeout = 30

Environment:
timeout = 60

Effective:
timeout = 60
```

---

# 14. Merge de Objetos

Los objetos podrán combinarse recursivamente cuando el Schema lo permita.

Ejemplo:

```text
Default
logging.level = info
logging.format = json

Environment
logging.level = debug
```

Resultado:

```text
logging.level = debug
logging.format = json
```

---

# 15. Merge de Arrays

Los arrays requieren una estrategia explícita.

No deberá asumirse automáticamente:

```text
append
```

o:

```text
replace
```

El Schema o la propiedad deberá definir la semántica cuando sea relevante.

---

# 16. Null

`null` deberá poseer semántica explícita.

Podrá significar:

```text
unset
disabled
no value
inherit
```

según el Schema.

No deberán utilizarse estas interpretaciones indistintamente.

---

# 17. Configuration Schema

Toda configuración pública o significativa debería disponer de un Schema.

El Schema podrá definir:

- propiedades;
- tipos;
- required;
- defaults;
- límites;
- enums;
- deprecation;
- sensibilidad;
- descripción.

---

# 18. Ejemplo Conceptual de Schema

```yaml
logging:
  type: object
  properties:
    level:
      type: string
      enum:
        - trace
        - debug
        - info
        - warn
        - error
        - fatal
      default: info
```

La sintaxis concreta dependerá del perfil.

---

# 19. Schema como Contract

El Configuration Schema constituye un Contract técnico entre:

```text
Configuration Author
        │
        ▼
Configuration System
        │
        ▼
Component
```

Cambios incompatibles deberán considerarse cuidadosamente.

---

# 20. Schema Version

Cuando un Configuration Schema sea público o persistente deberá poder versionarse.

Ejemplo conceptual:

```text
schemaVersion: 1
```

La representación exacta será definida por el perfil.

---

# 21. Validación

Toda Configuration deberá validarse antes de ser utilizada por componentes críticos.

La secuencia será:

```text
Load
 ↓
Parse
 ↓
Merge
 ↓
Resolve
 ↓
Validate
 ↓
Expose
```

---

# 22. Validación Sintáctica

Deberá detectar errores como:

```text
invalid JSON
invalid YAML
malformed environment variable
```

según el formato.

---

# 23. Validación Estructural

Deberá verificar:

- propiedades requeridas;
- tipos;
- estructura;
- propiedades desconocidas;
- restricciones.

---

# 24. Validación Semántica

Algunas reglas no podrán expresarse únicamente mediante tipos.

Ejemplo:

```text
minTimeout <= maxTimeout
```

Estas deberán validarse mediante reglas semánticas específicas.

---

# 25. Unknown Configuration

Las propiedades desconocidas deberían producir:

```text
ERROR
```

o:

```text
WARNING
```

según la política.

No deberán ignorarse silenciosamente por defecto.

Esto permite detectar errores como:

```text
loggin.level
```

en lugar de:

```text
logging.level
```

---

# 26. Strict Mode

MEF podrá soportar:

```text
strict configuration mode
```

donde:

- unknown properties;
- deprecated properties;
- invalid coercions;

puedan convertirse en errores.

---

# 27. Type Coercion

La conversión automática de tipos deberá ser limitada y predecible.

Ejemplo:

```text
"true"
```

podrá convertirse a boolean cuando la fuente solo soporte strings.

Sin embargo:

```text
"abc"
```

no deberá convertirse silenciosamente a:

```text
0
```

---

# 28. Environment Variables

Las variables de entorno podrán utilizarse como Configuration Source.

Su nomenclatura deberá ser determinista.

Ejemplo conceptual:

```text
MEF_LOGGING_LEVEL
MEF_CACHE_DRIVER
```

Las reglas exactas deberán respetar ENG-005.

---

# 29. Namespace

Las variables globales deberían utilizar un namespace reconocible.

Ejemplo:

```text
MEF_
```

Los Modules podrán utilizar namespaces derivados de su identidad cuando sea necesario.

---

# 30. Module Configuration

Cada Module deberá mantener un espacio de configuración identificable.

Ejemplo conceptual:

```text
modules:
  crm:
    enabled: true
    timeout: 30
```

Esto evita colisiones entre Modules.

---

# 31. Core Configuration

La configuración del Core deberá mantenerse separada de la configuración específica de Modules cuando sea razonable.

---

# 32. Platform Configuration

Platform podrá disponer de configuración para capacidades como:

```text
logging
cache
events
security
registry
```

según la arquitectura.

---

# 33. Configuration Ownership

Cada propiedad deberá tener un propietario conceptual.

Ejemplo:

```text
logging.level
```

pertenece al subsistema de Logging.

Un Module no deberá redefinir arbitrariamente la semántica de propiedades globales.

---

# 34. Defaults

Los defaults deberán:

- ser explícitos;
- ser seguros;
- ser documentados;
- permitir ejecución razonable cuando corresponda.

No deberán depender de valores accidentales del Runtime.

---

# 35. Secure Defaults

Cuando una propiedad afecte seguridad deberá utilizarse el comportamiento más seguro razonable.

Ejemplo:

```text
allowUnsignedPackages = false
```

es preferible a habilitar implícitamente comportamiento inseguro.

---

# 36. Required Configuration

Cuando un valor sea obligatorio y no exista un default seguro, el sistema deberá fallar explícitamente.

No deberá inventar valores.

---

# 37. Optional Configuration

Las propiedades opcionales deberán declarar claramente su comportamiento cuando estén ausentes.

---

# 38. Environment Profiles

MEF podrá reconocer perfiles como:

```text
development
test
staging
production
```

Estos nombres son convenciones operativas.

No deberán contener semántica arquitectónica oculta.

---

# 39. Environment-Specific Configuration

Podrán existir archivos específicos:

```text
config/
├── mef.*
├── development.*
├── test.*
└── production.*
```

La extensión concreta dependerá del Implementation Profile.

---

# 40. Environment Detection

El entorno activo deberá determinarse de manera explícita.

No deberá inferirse mediante heurísticas inseguras como:

```text
hostname contains "prod"
```

---

# 41. Production

La configuración de producción deberá favorecer:

- seguridad;
- estabilidad;
- observabilidad;
- validación estricta;
- errores explícitos.

---

# 42. Development

Development podrá habilitar:

- Debug;
- diagnostics;
- verbose errors;
- local adapters.

Sin embargo, no deberá desactivar controles fundamentales de seguridad.

---

# 43. Test

El entorno de Testing deberá poder:

- sustituir dependencias;
- utilizar Fakes;
- controlar tiempo;
- aislar recursos;
- evitar producción.

---

# 44. Local Configuration

Podrá existir configuración local ignorada por control de versiones.

Ejemplo conceptual:

```text
config.local.*
```

No deberá convertirse en requisito oculto para ejecutar el proyecto.

---

# 45. Example Configuration

Los proyectos deberían proporcionar ejemplos seguros.

Ejemplo:

```text
config.example.*
```

Los ejemplos no deberán contener secretos reales.

---

# 46. Configuration Templates

Los Generators podrán producir archivos iniciales de Configuration.

ENG-008 deberá garantizar que estos:

- sean válidos;
- utilicen defaults seguros;
- no incluyan secretos;
- correspondan al Schema vigente.

---

# 47. Secrets

Ejemplos de valores que deberán tratarse como Secrets:

```text
password
token
apiKey
privateKey
clientSecret
databaseCredential
```

---

# 48. Secret References

En lugar de almacenar el Secret directamente podrá utilizarse una referencia.

Ejemplo conceptual:

```yaml
database:
  password:
    secret: DATABASE_PASSWORD
```

La sintaxis exacta dependerá del perfil.

---

# 49. Secret Resolution

Conceptualmente:

```text
Configuration
     │
     ▼
Secret Reference
     │
     ▼
Secret Provider
     │
     ▼
Resolved Value
```

El valor resuelto deberá mantenerse fuera de Logs y diagnósticos.

---

# 50. Secret Lifetime

Los Secrets deberán mantenerse en memoria únicamente durante el tiempo necesario cuando sea técnicamente razonable.

---

# 51. Secret Redaction

Cualquier representación de Configuration deberá enmascarar Secrets.

Ejemplo:

```text
database.password = [REDACTED]
```

---

# 52. Configuration Inspection

El CLI podrá proporcionar:

```text
mef config inspect
```

La salida deberá mostrar Configuration efectiva sin revelar Secrets.

---

# 53. Configuration Validate

El CLI podrá proporcionar:

```text
mef config validate
```

La operación deberá:

- cargar;
- resolver;
- validar;
- reportar errores;

sin iniciar innecesariamente toda la Application.

---

# 54. Configuration List

Podrá existir:

```text
mef config list
```

para mostrar propiedades disponibles, Schema y defaults seguros.

---

# 55. Configuration Get

Podrá existir:

```text
mef config get logging.level
```

Los valores sensibles deberán permanecer protegidos.

---

# 56. Configuration Source Inspection

Para diagnóstico podrá mostrarse de qué fuente provino un valor.

Ejemplo:

```text
logging.level
value: debug
source: environment
```

Esto deberá ocultarse o restringirse cuando la metadata pueda ser sensible.

---

# 57. Effective Configuration

Después de aplicar:

```text
defaults
files
environment
overrides
```

el resultado será denominado:

```text
Effective Configuration
```

Esta será la configuración consumida por Runtime.

---

# 58. Immutable Effective Configuration

La Effective Configuration debería ser inmutable después de finalizar Bootstrap cuando sea razonable.

Esto evita cambios accidentales durante Runtime.

---

# 59. Runtime Changes

Si una propiedad admite cambio dinámico deberá declararlo explícitamente.

Ejemplo:

```text
logging.level
```

podría ser dinámico.

Otros valores podrán requerir reinicio.

---

# 60. Static Configuration

Una propiedad `static` requiere reinicio o reconstrucción del componente para cambiar.

---

# 61. Dynamic Configuration

Una propiedad `dynamic` podrá modificarse durante Runtime mediante un mecanismo gobernado.

---

# 62. Configuration Metadata

El Schema podrá declarar:

```text
dynamic: true
```

o equivalente.

Esto permitirá saber si una modificación requiere reinicio.

---

# 63. Runtime Configuration Mutation

La modificación dinámica no deberá realizarse mediante mutación arbitraria de objetos globales.

Deberá utilizar un mecanismo controlado.

---

# 64. Configuration Change Events

Cuando sea necesario, un cambio dinámico podrá producir un Event técnico o señal específica.

Esto deberá utilizar el mecanismo oficial correspondiente.

---

# 65. Restart Required

Cuando una propiedad estática cambie, tooling podrá indicar:

```text
restartRequired: true
```

---

# 66. Configuration Cache

La Configuration procesada podrá almacenarse en cache para mejorar startup.

El cache deberá invalidarse cuando cambien entradas relevantes.

---

# 67. Cache Integrity

La Configuration cacheada deberá conservar las mismas garantías de validación y seguridad.

No deberá permitir saltarse el Schema.

---

# 68. Compiled Configuration

Los Implementation Profiles podrán compilar Configuration a una representación optimizada.

Ejemplo conceptual:

```text
Configuration Sources
       ↓
Validation
       ↓
Compiled Configuration
       ↓
Runtime
```

---

# 69. Configuration Build Step

La validación podrá integrarse al Build System.

Ejemplo:

```text
Build
 ↓
Configuration Validation
 ↓
Artifact
```

Esto permite detectar errores antes del despliegue.

---

# 70. Configuration Drift

En sistemas distribuidos podrá existir drift cuando diferentes instancias utilicen configuraciones distintas.

MEF deberá permitir identificar la versión o fingerprint de Configuration cuando sea necesario.

---

# 71. Configuration Fingerprint

Podrá generarse un fingerprint de valores no sensibles o de una representación segura.

No deberá utilizarse un mecanismo que permita recuperar Secrets.

---

# 72. Reproducibility

Para reproducir una ejecución deberá ser posible conocer:

- Configuration Schema version;
- fuentes utilizadas;
- valores no sensibles relevantes;
- versiones;
- environment.

Los Secrets no deberán almacenarse en reportes de reproducción.

---

# 73. Version Control

Los archivos de Configuration no sensibles deberían almacenarse en control de versiones.

Esto facilita:

- revisión;
- historial;
- rollback;
- reproducibilidad.

---

# 74. Secrets y Version Control

Los Secrets no deberán almacenarse en Git u otro control de versiones como parte del flujo normal.

---

# 75. `.env`

Un archivo `.env` podrá utilizarse en determinados Implementation Profiles.

No será una obligación universal de MEF.

La regla será:

```text
MEF supports Environment Variables
```

no:

```text
MEF requires .env
```

---

# 76. YAML

YAML podrá utilizarse como representación de Configuration.

No constituye el formato universal de MEF.

---

# 77. JSON

JSON podrá utilizarse como representación.

Tampoco constituye el formato obligatorio universal.

---

# 78. TOML

TOML u otros formatos podrán utilizarse si el Implementation Profile los soporta.

---

# 79. Executable Config Files

Formatos ejecutables como:

```text
PHP
JavaScript
Python
```

deberán utilizarse cuidadosamente.

Introducen riesgos como:

- side effects;
- acceso al Filesystem;
- dependencia del Runtime;
- dificultad de análisis estático.

MEF favorecerá formatos declarativos para configuración portable.

---

# 80. Configuration Portability

Las propiedades universales deberán poder representarse sin depender de sintaxis exclusiva de una tecnología.

---

# 81. Implementation-Specific Configuration

Un perfil podrá añadir propiedades específicas.

Estas deberán estar claramente separadas de las propiedades universales.

---

# 82. Reserved Namespace

MEF podrá reservar:

```text
mef
```

como namespace para configuración del Framework.

Ejemplo conceptual:

```yaml
mef:
  logging:
    level: info
```

Los Modules deberán evitar apropiarse del namespace reservado.

---

# 83. Module Namespace

La configuración de Modules debería derivarse de su identidad estable.

Ejemplo:

```yaml
modules:
  MOD-CRM:
    ...
```

o representación equivalente definida por el perfil.

---

# 84. Configuration Keys

Las keys deberán seguir reglas de ENG-005.

Deberán ser:

- descriptivas;
- estables;
- consistentes;
- libres de abreviaturas ambiguas.

---

# 85. Boolean Naming

Los booleanos deberán expresar claramente la condición.

Preferible:

```text
enabled
allowUnsignedPackages
requireSignature
```

frente a:

```text
flag
mode
option1
```

---

# 86. Units

Los valores numéricos con unidades deberán evitar ambigüedad.

Preferible:

```text
timeoutSeconds
maxSizeBytes
```

o una representación tipada equivalente.

Evitar:

```text
timeout: 30
```

cuando la unidad no esté definida por Schema.

---

# 87. Duration

Los Implementation Profiles podrán utilizar formatos explícitos:

```text
30s
5m
1h
```

si el parser y Schema lo soportan.

---

# 88. Size

Los tamaños deberán utilizar unidades explícitas o definidas formalmente.

---

# 89. URLs

Los endpoints deberán validarse como URLs/URIs cuando corresponda.

No deberán tratarse simplemente como strings sin validación si su semántica es conocida.

---

# 90. Enumerations

Las propiedades con conjunto limitado de valores deberán declararlo.

Ejemplo:

```text
logging.level:
trace | debug | info | warn | error | fatal
```

---

# 91. Deprecation

Una Configuration Key podrá declararse deprecated.

El sistema debería:

- seguir aceptándola durante el periodo establecido;
- emitir Warning;
- indicar reemplazo;
- documentar versión de retiro.

---

# 92. Configuration Migration

Los cambios de Schema podrán requerir migración.

MEF podrá proporcionar tooling para:

```text
inspect
validate
migrate
```

sin modificar silenciosamente archivos.

---

# 93. Automatic Migration

Las migraciones automáticas deberán utilizar:

```text
--dry-run
```

cuando puedan modificar archivos.

Deberán preservar backup o rollback cuando sea razonable.

---

# 94. Unknown Environment Variable

Las variables con namespace MEF que no correspondan a ninguna propiedad conocida deberían poder detectarse en Strict Mode.

Esto permite identificar errores tipográficos.

---

# 95. Environment Variable Mapping

El mapping:

```text
MEF_LOGGING_LEVEL
```

hacia:

```text
mef.logging.level
```

deberá ser determinista y documentado.

---

# 96. Case Sensitivity

La sensibilidad a mayúsculas/minúsculas deberá definirse por formato.

La capa conceptual no deberá depender accidentalmente del comportamiento del sistema operativo.

---

# 97. Duplicate Keys

Los parsers deberían rechazar o advertir sobre keys duplicadas.

Ejemplo:

```yaml
logging:
  level: info
  level: debug
```

No deberá aceptarse silenciosamente si el resultado puede ser ambiguo.

---

# 98. Includes

Si un formato permite:

```text
include
import
extends
```

deberán definirse:

- resolución;
- precedencia;
- ciclos;
- seguridad.

---

# 99. Include Cycles

Una cadena como:

```text
A → B → C → A
```

deberá rechazarse.

---

# 100. Remote Configuration

En el futuro podrán existir fuentes remotas.

Deberán considerar:

- autenticación;
- integridad;
- disponibilidad;
- cache;
- timeout;
- fallback;
- seguridad.

No serán requeridas para la primera implementación.

---

# 101. Remote Failure

Una aplicación no deberá quedar con comportamiento ambiguo cuando falle una fuente remota.

La política deberá declarar si:

```text
fail
use cached
use default
```

según la propiedad y criticidad.

---

# 102. Fail Fast

La Configuration inválida requerida para Bootstrap deberá causar fallo temprano.

Preferible:

```text
Startup failed:
MEF-CFG-004
Invalid configuration property: mef.logging.level
```

frente a descubrir el error después durante una operación.

---

# 103. Configuration Errors

Los errores deberán utilizar códigos estables cuando sea razonable.

Ejemplos conceptuales:

```text
MEF-CFG-001 Parse failure
MEF-CFG-002 Missing required property
MEF-CFG-003 Unknown property
MEF-CFG-004 Invalid value
MEF-CFG-005 Secret resolution failure
MEF-CFG-006 Circular include
MEF-CFG-007 Schema incompatibility
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 104. Error Context

Los errores podrán incluir:

- property;
- source;
- expected type;
- actual type;
- schema version.

No deberán incluir valores sensibles.

---

# 105. Logging

ENG-010 podrá registrar:

```text
configuration.loaded
configuration.validation.failed
configuration.reload.completed
```

No deberá registrar Configuration completa.

---

# 106. Logging de Secret Resolution

Preferido:

```text
Secret reference resolved.
```

Evitar:

```text
Secret DATABASE_PASSWORD resolved to "..."
```

---

# 107. Audit

Cambios administrativos de Configuration podrán requerir Audit.

Esto será independiente de los Logs técnicos.

---

# 108. Testing

ENG-009 deberá verificar al menos:

- precedence;
- merge;
- defaults;
- required values;
- invalid types;
- unknown keys;
- secret redaction;
- environment mapping;
- schema compatibility;
- include cycles;
- dynamic/static behavior.

---

# 109. Property-Based Testing

El Resolver podrá beneficiarse de propiedades como:

```text
Resolving the same inputs twice
produces equivalent Effective Configuration.
```

---

# 110. Security Tests

Deberán existir pruebas que verifiquen:

```text
Secrets are not logged
Secrets are not exposed by inspect
Invalid secret reference fails safely
Production safeguards remain enabled
```

---

# 111. Configuration Contract Tests

Si existen múltiples loaders o formatos, una suite común podrá verificar que todos produzcan el mismo modelo conceptual.

Ejemplo:

```text
JSON Loader
YAML Loader
Environment Loader
       │
       ▼
Configuration Model
```

---

# 112. CLI

ENG-007 podrá exponer:

```text
mef config validate
mef config inspect
mef config list
mef config get
```

y eventualmente:

```text
mef config migrate
```

---

# 113. Generator Integration

ENG-008 podrá generar:

```text
Configuration Example
Configuration Schema
Environment Template
```

sin generar credenciales reales.

---

# 114. Build Integration

ENG-012 deberá poder incorporar:

```text
Configuration Schema Validation
```

como Quality Gate.

---

# 115. Package Configuration

Los Packages podrán incluir Schemas o defaults permitidos.

La instalación no deberá sobrescribir Configuration existente silenciosamente.

---

# 116. Package Defaults

Un Package podrá proporcionar defaults dentro de su namespace.

Los valores de proyecto autorizados deberán poder sobrescribirlos conforme a precedencia.

---

# 117. Package Removal

Eliminar un Package no deberá borrar automáticamente Configuration del usuario sin una política explícita.

Tooling podrá detectar configuración huérfana.

---

# 118. Orphan Configuration

Una propiedad asociada a un componente inexistente podrá:

```text
warn
```

o:

```text
fail in strict mode
```

según política.

---

# 119. Configuration Lifecycle

La Configuration participa en Bootstrap.

Conceptualmente:

```text
Runtime Start
    ↓
Discover Configuration Sources
    ↓
Load
    ↓
Resolve
    ↓
Validate
    ↓
Freeze Effective Configuration
    ↓
Configure Components
    ↓
Continue Bootstrap
```

---

# 120. Configuration State

Podrán reconocerse estados conceptuales:

```text
Unloaded
Loaded
Resolved
Validated
Active
Invalid
```

ENG-015 podrá formalizar estados si resulta necesario.

---

# 121. Configuration Reload

Si el Runtime permite Reload:

```text
Current Configuration
        ↓
Load Candidate
        ↓
Resolve
        ↓
Validate
        ↓
Compatibility Check
        ↓
Apply Dynamic Changes
```

La configuración inválida no deberá sustituir la configuración activa.

---

# 122. Atomic Reload

El Reload debería ser atómico cuando sea razonablemente posible.

Preferible:

```text
Old Valid Configuration
          ↓
New Candidate Invalid
          ↓
Reject
          ↓
Old Configuration remains active
```

---

# 123. Partial Reload

Los cambios parciales deberán evitar estados inconsistentes.

Si se permiten deberán existir límites transaccionales explícitos.

---

# 124. Configuration Snapshot

Podrá mantenerse una representación segura de la Configuration activa para diagnóstico.

Los Secrets deberán permanecer redacted.

---

# 125. Source Metadata

La Configuration resuelta podrá mantener metadata interna:

```text
value
source
schema
dynamic
sensitive
```

Esto facilita diagnóstico y tooling.

---

# 126. Sensitive Metadata

El Schema debería poder marcar propiedades:

```text
sensitive: true
```

para aplicar automáticamente:

- redaction;
- restricciones de inspección;
- protección de Logging.

---

# 127. Secret Detection

Tooling podrá detectar nombres potencialmente sensibles.

Sin embargo, la seguridad no deberá depender exclusivamente de heurísticas basadas en nombres.

---

# 128. Configuration Documentation

Las propiedades públicas deberán documentar:

- key;
- tipo;
- propósito;
- default;
- required;
- allowed values;
- dynamic/static;
- sensitive;
- deprecation.

---

# 129. Documentation Generation

La documentación podrá generarse parcialmente desde el Schema.

```text
Configuration Schema
        │
        ├── Validation
        ├── CLI Help
        ├── Documentation
        └── IDE Tooling
```

Esto reduce divergencia.

---

# 130. IDE Tooling

Los Schemas podrán permitir:

- autocompletion;
- validation;
- descriptions;
- deprecation warnings.

Esto no será requisito de la primera implementación.

---

# 131. Machine Readability

Los Configuration Schemas deberán ser procesables por tooling cuando sea posible.

---

# 132. Human Readability

Los archivos destinados a edición humana deberán favorecer claridad.

No deberán optimizarse únicamente para parsing.

---

# 133. Comments

Si el formato soporta comentarios, podrán utilizarse para explicar valores.

La semántica no deberá depender exclusivamente de comentarios.

---

# 134. Formatting

El formato podrá normalizarse mediante tooling.

Ejemplo:

```text
mef config format
```

si el Implementation Profile lo soporta.

La operación deberá preservar semántica.

---

# 135. Canonical Representation

MEF podrá definir una representación canónica interna independiente del formato físico.

Ejemplo:

```text
YAML ─┐
JSON ─┼─→ Configuration Model
ENV ──┘
```

Esto permite validar todas las fuentes mediante reglas comunes.

---

# 136. Configuration Resolver

El Resolver será responsable de:

- precedencia;
- merge;
- overrides;
- source tracking.

No deberá implementar lógica funcional de los componentes.

---

# 137. Configuration Validator

El Validator será responsable de:

- Schema;
- tipos;
- restricciones;
- reglas semánticas.

Esto deberá mantenerse separado del Loader cuando sea razonable.

---

# 138. Configuration Loader

El Loader será responsable de transformar una fuente física en representación intermedia.

Ejemplo:

```text
YAML Loader
JSON Loader
Environment Loader
```

---

# 139. Secret Resolver

La resolución de Secrets deberá permanecer separada del parser de Configuration.

Esto evita que cada formato implemente seguridad de manera diferente.

---

# 140. Separation of Concerns

La arquitectura recomendada será:

```text
Source
  ↓
Loader
  ↓
Raw Configuration
  ↓
Resolver
  ↓
Resolved Configuration
  ↓
Secret Resolver
  ↓
Validator
  ↓
Effective Configuration
```

El orden exacto de Secret Resolution y Validation podrá adaptarse cuando el Schema requiera validar referencias antes de resolver valores.

---

# 141. Bootstrap Configuration

El subsistema de Configuration deberá poder iniciarse con una configuración mínima.

Se deberá evitar una dependencia circular como:

```text
Configuration requires Container
Container requires Configuration
```

---

# 142. Bootstrap Boundary

Las capacidades necesarias para cargar Configuration deberán pertenecer a una fase temprana y mínima del Bootstrap.

---

# 143. Dependency Direction

Los componentes funcionales podrán depender de Configuration abstraída.

Configuration no deberá depender de Modules específicos para poder inicializar el Framework.

---

# 144. No Global Mutable Bag

Se evitará utilizar Configuration como:

```text
global mutable dictionary
```

accesible y modificable libremente desde cualquier componente.

---

# 145. Typed Configuration

Cuando el lenguaje lo permita se favorecerá mapear Configuration validada a objetos tipados.

Ejemplo conceptual:

```text
LoggingConfiguration
PackageConfiguration
SecurityConfiguration
```

frente a acceder constantemente mediante strings arbitrarios.

---

# 146. Configuration Injection

Los componentes deberían recibir únicamente la configuración que necesitan.

Preferible:

```text
PackageManager(PackageConfiguration)
```

frente a:

```text
PackageManager(GlobalConfiguration)
```

cuando sea razonable.

---

# 147. Least Configuration Knowledge

Cada componente deberá conocer la menor superficie de Configuration necesaria.

Esto reduce acoplamiento.

---

# 148. Feature Flags

Los Feature Flags podrán representarse mediante Configuration cuando corresponda.

Sin embargo, su gobernanza y Lifecycle pueden requerir una especificación adicional.

No deberán utilizarse para mantener indefinidamente dos arquitecturas incompatibles.

---

# 149. Kill Switches

Determinadas capacidades críticas podrán disponer de switches operativos.

Deberán:

- ser explícitos;
- tener defaults seguros;
- estar auditados cuando corresponda;
- documentar impacto.

---

# 150. Configuration as Public API

Las Configuration Keys consumidas por usuarios o Packages externos deberán tratarse como interfaz pública.

Cambiar:

```text
mef.logging.level
```

puede ser un cambio incompatible aunque el código interno no cambie.

---

# 151. Backward Compatibility

Los cambios de Configuration deberán clasificarse.

Ejemplos:

```text
Adding optional key with safe default
→ normalmente compatible

Removing public key
→ incompatible

Changing key type
→ potencialmente incompatible

Changing default
→ requiere evaluación
```

---

# 152. Versioning Integration

ENG-014 deberá considerar cambios de Configuration Schema al determinar impacto de versión.

---

# 153. Invariantes de Ingeniería

ENG-011 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-166 | Configuration deberá permanecer separada del Manifest y de la lógica de negocio. |
| EI-167 | La precedencia entre Configuration Sources deberá ser explícita y determinista. |
| EI-168 | La Configuration deberá validarse antes de ser consumida por componentes críticos. |
| EI-169 | Las propiedades desconocidas no deberán ignorarse silenciosamente por defecto. |
| EI-170 | Los defaults deberán ser explícitos y seguros. |
| EI-171 | Los valores obligatorios sin default seguro deberán provocar fallo explícito cuando estén ausentes. |
| EI-172 | Los Secrets no deberán almacenarse como parte normal de archivos versionados de Configuration. |
| EI-173 | Los Secrets deberán permanecer protegidos en Logs, diagnósticos e inspección. |
| EI-174 | Los Configuration Files universales deberán favorecer representaciones declarativas. |
| EI-175 | MEF no deberá depender universalmente de `.env`, YAML, JSON u otro formato físico específico. |
| EI-176 | La Configuration efectiva deberá derivarse mediante reglas reproducibles de resolución. |
| EI-177 | Los Modules deberán mantener espacios de Configuration identificables y evitar colisiones. |
| EI-178 | Las Configuration Keys públicas deberán tratarse como interfaces versionables. |
| EI-179 | Las propiedades dinámicas y estáticas deberán diferenciarse cuando el Runtime soporte modificación. |
| EI-180 | Una Configuration inválida candidata no deberá reemplazar silenciosamente una Configuration activa válida. |
| EI-181 | Los Includes de Configuration no deberán permitir ciclos. |
| EI-182 | La resolución de Secrets deberá permanecer separada de la lógica funcional de los componentes. |
| EI-183 | Los componentes deberán conocer únicamente la superficie de Configuration que necesiten cuando sea razonable. |
| EI-184 | La Configuration no deberá implementarse como un estado global mutable sin control. |
| EI-185 | Los cambios incompatibles de Configuration Schema deberán participar en la estrategia de versionado. |

---

# 154. Criterios de Conformidad

Una implementación será conforme con ENG-011 cuando:

- defina Configuration Sources;
- establezca precedencia;
- implemente resolución determinista;
- valide Configuration;
- proteja Secrets;
- proporcione defaults seguros;
- detecte propiedades inválidas;
- diferencie Configuration de Manifest;
- soporte namespaces;
- permita diagnóstico seguro;
- respete Configuration Schemas;
- mantenga independencia del formato físico;
- gestione Reload de forma segura cuando exista;
- trate Configuration pública como interfaz versionable.

---

# 155. Riesgos

Deberán evitarse especialmente:

## Configuration as Code

Introducir lógica arbitraria en archivos de Configuration.

## Secret Leakage

Guardar credenciales en Git, Logs o diagnósticos.

## Hidden Precedence

No saber qué valor terminó aplicándose ni por qué.

## Configuration Sprawl

Crear cientos de propiedades sin ownership claro.

## Global Config Bag

Permitir que todos los componentes lean y modifiquen cualquier propiedad.

## Silent Typo

Ignorar:

```text
loggin.level
```

sin advertencia.

## Environment Magic

Cambiar comportamiento crítico mediante heurísticas de entorno.

## Unsafe Defaults

Activar capacidades sensibles automáticamente.

## Format Lock-in

Confundir el modelo de Configuration de MEF con YAML, JSON o `.env`.

## Dynamic Everything

Permitir cambios en Runtime sin controlar consistencia.

---

# 156. Arquitectura Recomendada

La primera implementación debería aproximarse a:

```text
Configuration Sources
        │
        ▼
      Loaders
        │
        ▼
Raw Configuration
        │
        ▼
Configuration Resolver
        │
        ▼
Secret References
        │
        ▼
Secret Resolver
        │
        ▼
Configuration Validator
        │
        ▼
Effective Configuration
        │
        ▼
Typed Configuration
        │
        ▼
Components
```

Con tooling paralelo:

```text
Schema
  │
  ├── Validator
  ├── CLI
  ├── Documentation
  ├── Generator
  └── IDE
```

---

# 157. Primera Superficie Recomendada

La primera implementación de Configuration debería soportar:

```text
Defaults
Project Configuration
Environment Configuration
Environment Variables
Secret References
CLI Overrides
```

junto con:

```text
Schema Validation
Strict Mode
Source Tracking
Secret Redaction
Effective Configuration
```

Y desde CLI:

```text
mef config validate
mef config inspect
mef config list
mef config get
```

---

# 158. Principio Rector

> **La Configuration de MEF deberá ser explícita, declarativa, validable, determinista y segura, manteniendo separados los parámetros operativos de la identidad estructural, la lógica funcional y los secretos.**

---

# 159. Conclusión

**ENG-011 — Configuration Files** materializa el modelo arquitectónico de Configuration definido por `ARQ-013`.

La cadena completa será:

```text
Configuration Sources
        ↓
      Load
        ↓
      Merge
        ↓
     Resolve
        ↓
 Secret Resolution
        ↓
    Validation
        ↓
Effective Configuration
        ↓
Typed Configuration
        ↓
     Runtime
```

Esto permite que MEF utilice Configuration sin quedar ligado a una tecnología concreta.

Una implementación podrá utilizar:

```text
YAML
JSON
ENV
TOML
Cloud Configuration
Secret Manager
```

mientras todas produzcan el mismo concepto:

```text
Validated Effective Configuration
```

De esta forma, Configuration se convierte en una interfaz técnica gobernada y no en una colección informal de archivos y variables.

---

# Referencias

## Arquitectura

- ARQ-003 — Platform
- ARQ-006 — Registry
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine