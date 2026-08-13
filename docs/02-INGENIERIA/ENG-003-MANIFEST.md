---
id: ENG-003
titulo: Manifest
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Manifest
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-001
  - ENG-002
  - ARQ-004
  - ARQ-006
  - ARQ-014
  - ARQ-015
  - ARQ-017
relacionados:
  - ENG-004
  - ENG-005
  - ENG-006
  - ENG-007
  - ENG-014
keywords:
  - manifest
  - metadata
  - modules
  - schema
  - dependencies
  - compatibility
  - validation
  - mef
---

# ENG-003

# Manifest

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica del **Manifest** de MEF.

El Manifest constituye el descriptor estructurado mediante el cual un componente distribuible declara su:

- identidad;
- tipo;
- versión;
- compatibilidad;
- capacidades;
- dependencias;
- Contracts;
- punto de entrada;
- configuración;
- extensiones;
- requisitos técnicos.

Su propósito es permitir que MEF pueda comprender y validar un componente antes de ejecutarlo.

---

# 2. Declaración

Todo Module distribuible deberá disponer de un Manifest válido.

El Manifest constituye la **fuente técnica declarativa de identidad y composición del Module**.

No deberá contener lógica ejecutable.

No deberá sustituir el código.

No deberá sustituir la documentación.

Describe el componente para que el Framework pueda:

```text
Discover
   ↓
Identify
   ↓
Validate
   ↓
Register
   ↓
Compose
   ↓
Execute
```

---

# 3. Principio Declarativo

El Manifest deberá describir el componente mediante datos estructurados.

La información necesaria para descubrir y validar un Module no deberá depender de ejecutar su código.

Por tanto:

> **MEF deberá poder inspeccionar un Package antes de cargar su implementación.**

---

# 4. Responsabilidades

El Manifest es responsable de declarar:

- identidad;
- versión;
- clasificación;
- compatibilidad;
- dependencias;
- capacidades;
- Contracts;
- Entry Point;
- requisitos;
- metadatos de integración.

---

# 5. No Responsabilidades

El Manifest no deberá:

- ejecutar código;
- contener lógica de negocio;
- resolver dependencias;
- inicializar componentes;
- almacenar secretos;
- sustituir Configuration;
- implementar Contracts;
- contener credenciales.

---

# 6. Relación con el Module

```text
Module
   │
   ├── Manifest
   ├── Public API
   ├── Internal Implementation
   ├── Configuration
   ├── Tests
   └── Documentation
```

El Manifest describe al Module.

No constituye el Module.

---

# 7. Relación con el Registry

Durante Discovery:

```text
Package
   │
   ▼
Manifest
   │
   ▼
Validation
   │
   ▼
Registry
```

El Registry podrá construir su catálogo utilizando la información declarada en los Manifests.

El Registry no deberá inferir información esencial que el Manifest tenga obligación de declarar.

---

# 8. Nombre del Archivo

La implementación de referencia de MEF utilizará inicialmente:

```text
mef.manifest.json
```

como nombre canónico recomendado.

La extensión concreta podrá evolucionar mediante una decisión formal.

El concepto arquitectónico será siempre:

```text
MEF Manifest
```

y no dependerá permanentemente de JSON.

---

# 9. Formato

El Manifest deberá utilizar un formato:

- estructurado;
- legible por máquinas;
- validable mediante schema;
- portable;
- determinista;
- interoperable.

La implementación inicial podrá utilizar **JSON**.

Esto no convierte JSON en un principio arquitectónico de MEF.

---

# 10. Schema Version

Todo Manifest deberá declarar la versión de la especificación que utiliza.

Ejemplo:

```json
{
  "schema": "1.0"
}
```

El `schema` representa la versión del formato del Manifest.

No deberá confundirse con la versión del Module.

---

# 11. Identidad

Todo Manifest deberá declarar un identificador único.

Ejemplo:

```json
{
  "id": "MOD-CRM"
}
```

El ID deberá:

- ser estable;
- ser único;
- ser independiente del directorio;
- ser independiente del Package Manager;
- ser independiente de la aplicación.

---

# 12. Nombre

Deberá declararse un nombre legible.

```json
{
  "name": "Customer Relationship Management"
}
```

El nombre podrá utilizarse en:

- CLI;
- interfaces administrativas;
- documentación;
- Registry;
- herramientas de diagnóstico.

---

# 13. Slug

Podrá declararse un identificador técnico simplificado.

```json
{
  "slug": "crm"
}
```

El `slug` podrá utilizarse para:

- comandos;
- rutas internas;
- nombres de Package;
- referencias técnicas.

El `slug` no sustituye al ID arquitectónico.

---

# 14. Versión

Todo Manifest deberá declarar la versión del componente.

```json
{
  "version": "1.4.0"
}
```

La versión deberá ajustarse a las reglas establecidas posteriormente por:

**ENG-014 — Versionado**.

---

# 15. Tipo

Todo Module deberá declarar su clasificación.

Ejemplo:

```json
{
  "type": "MT-001"
}
```

Los tipos oficiales provienen de la Arquitectura.

Ejemplo:

```text
MT-001 Business Module
MT-002 Technical Module
MT-003 Integration Module
MT-004 Presentation Module
MT-005 AI Module
MT-006 Infrastructure Module
```

---

# 16. Estado de Madurez

El Manifest podrá declarar la madurez del componente.

```json
{
  "maturity": "stable"
}
```

Estados posibles podrán incluir:

```text
experimental
preview
stable
deprecated
retired
```

La lista definitiva deberá mantenerse gobernada.

---

# 17. Descripción

Podrá declararse una descripción corta.

```json
{
  "description": "Customer relationship management capabilities."
}
```

La descripción no sustituye la documentación completa del Module.

---

# 18. Compatibilidad con MEF

Todo Module deberá declarar las versiones de MEF con las que es compatible.

Ejemplo conceptual:

```json
{
  "compatibility": {
    "mef": ">=1.0 <2.0"
  }
}
```

La sintaxis exacta de restricciones será definida por las reglas de versionado y Package Management.

---

# 19. Runtime

Cuando corresponda, podrán declararse requisitos técnicos de Runtime.

Ejemplo:

```json
{
  "runtime": {
    "php": ">=8.4"
  }
}
```

Este campo pertenece a una implementación.

No transforma dicho Runtime en una dependencia conceptual de la arquitectura MEF.

---

# 20. Entry Point

Todo Module deberá declarar su punto de entrada técnico.

Ejemplo conceptual:

```json
{
  "entrypoint": "CRMModule"
}
```

El Entry Point deberá implementar el Contract oficial correspondiente.

El Manifest únicamente declara dónde localizarlo.

---

# 21. Provider

Cuando el Module utilice un Provider podrá declararlo:

```json
{
  "provider": "CRMProvider"
}
```

El Provider será responsable de registrar integraciones técnicas autorizadas.

No deberá contener lógica de negocio.

---

# 22. Capacidades

Todo Module deberá declarar las capacidades públicas relevantes que proporciona.

Ejemplo:

```json
{
  "capabilities": [
    "customer-management",
    "lead-management",
    "opportunity-management"
  ]
}
```

Las capacidades deberán ser:

- estables;
- identificables;
- documentadas;
- consultables.

---

# 23. Dependencies

Toda dependencia obligatoria deberá declararse explícitamente.

Ejemplo:

```json
{
  "dependencies": {
    "MOD-IDENTITY": "^1.2.0"
  }
}
```

Una dependencia no declarada no deberá considerarse válida.

---

# 24. Dependencias Opcionales

Las integraciones opcionales deberán distinguirse de las obligatorias.

```json
{
  "optionalDependencies": {
    "MOD-NOTIFICATIONS": "^2.0.0"
  }
}
```

La ausencia de una dependencia opcional no deberá impedir el funcionamiento básico del Module.

---

# 25. Conflicts

Cuando existan incompatibilidades conocidas podrán declararse explícitamente.

```json
{
  "conflicts": {
    "MOD-LEGACY-CRM": "<3.0"
  }
}
```

Esto permitirá detectar conflictos antes del Runtime.

---

# 26. Contracts Proporcionados

El Manifest podrá declarar Contracts públicos implementados o proporcionados.

```json
{
  "provides": {
    "contracts": [
      "CT-CUSTOMER-001",
      "CT-LEAD-001"
    ]
  }
}
```

El Manifest no sustituye la especificación del Contract.

Únicamente declara la relación.

---

# 27. Contracts Requeridos

También podrá declarar Contracts requeridos.

```json
{
  "requires": {
    "contracts": [
      "CT-IDENTITY-001"
    ]
  }
}
```

Esto permite validar el grafo de composición antes de inicializar el Module.

---

# 28. Events

Los Events públicos podrán declararse.

```json
{
  "events": {
    "publishes": [
      "EVT-CRM-CUSTOMER-CREATED"
    ],
    "subscribes": [
      "EVT-IDENTITY-USER-CREATED"
    ]
  }
}
```

La declaración permite construir un mapa de comunicación.

---

# 29. Extension Points

Los puntos de extensión podrán declararse:

```json
{
  "extensionPoints": [
    "EP-CRM-CUSTOMER-PROFILE"
  ]
}
```

Cada Extension Point deberá poseer su especificación y Contract correspondiente.

---

# 30. Extensions

Cuando un Package implemente extensiones existentes podrá declararlo:

```json
{
  "extends": [
    "EP-CRM-CUSTOMER-PROFILE"
  ]
}
```

Esto permitirá validar que la extensión utiliza únicamente mecanismos oficiales.

---

# 31. Configuration

El Manifest podrá declarar el esquema de configuración asociado.

Ejemplo:

```json
{
  "configuration": {
    "schema": "config.schema.json"
  }
}
```

El Manifest describe la existencia de configuración.

Los valores operativos no deberán almacenarse necesariamente dentro del Manifest.

---

# 32. Permissions

Cuando corresponda podrán declararse permisos o capacidades de seguridad requeridos.

Ejemplo conceptual:

```json
{
  "security": {
    "permissions": [
      "crm.customer.read",
      "crm.customer.write"
    ]
  }
}
```

La semántica completa será definida por las especificaciones de seguridad.

---

# 33. Lifecycle Hooks

El Module podrá declarar Hooks oficiales del Lifecycle que utiliza.

```json
{
  "lifecycle": {
    "hooks": [
      "initialize",
      "ready",
      "shutdown"
    ]
  }
}
```

Solo podrán utilizarse Hooks definidos oficialmente.

---

# 34. Assets

Un Module podrá declarar recursos distribuibles.

Ejemplo:

```json
{
  "assets": [
    "resources/"
  ]
}
```

La semántica dependerá del tipo de Module.

---

# 35. Migrations

Cuando corresponda, el Module podrá declarar mecanismos de migración.

Ejemplo conceptual:

```json
{
  "migrations": {
    "path": "migrations/"
  }
}
```

La ejecución de migraciones no corresponde al Manifest.

El Manifest únicamente declara su existencia.

---

# 36. Documentation

El Manifest podrá referenciar documentación oficial.

```json
{
  "documentation": {
    "readme": "README.md",
    "changelog": "CHANGELOG.md"
  }
}
```

Esto facilitará integración con herramientas de desarrollo y Registry.

---

# 37. License

Todo Package distribuible deberá declarar su licencia cuando corresponda.

```json
{
  "license": "MIT"
}
```

El Manifest no sustituye el archivo de licencia requerido por el Package.

---

# 38. Responsable

Podrá declararse el equipo responsable.

```json
{
  "maintainer": "MEF CRM Team"
}
```

Se favorecerán roles o equipos frente a dependencias personales permanentes.

---

# 39. Metadata

El Manifest podrá admitir metadatos adicionales mediante un espacio explícitamente controlado.

Ejemplo:

```json
{
  "metadata": {
    "category": "business"
  }
}
```

Los metadatos adicionales no deberán utilizarse para eludir campos oficiales.

---

# 40. Campos Obligatorios

La versión inicial del Manifest deberá requerir al menos:

| Campo | Obligatorio |
|---|:---:|
| schema | Sí |
| id | Sí |
| name | Sí |
| version | Sí |
| type | Sí |
| entrypoint | Sí |
| compatibility | Sí |
| dependencies | Sí |
| capabilities | Sí |

Otros campos serán obligatorios según las características del componente.

---

# 41. Ejemplo Mínimo

```json
{
  "schema": "1.0",
  "id": "MOD-CRM",
  "name": "Customer Relationship Management",
  "slug": "crm",
  "version": "1.0.0",
  "type": "MT-001",
  "maturity": "stable",
  "entrypoint": "CRMModule",
  "compatibility": {
    "mef": "^1.0"
  },
  "dependencies": {},
  "capabilities": [
    "customer-management"
  ]
}
```

Este ejemplo es ilustrativo de la versión inicial de la especificación.

---

# 42. Ejemplo Extendido

```json
{
  "schema": "1.0",
  "id": "MOD-CRM",
  "name": "Customer Relationship Management",
  "slug": "crm",
  "description": "Customer relationship management capabilities.",
  "version": "1.4.0",
  "type": "MT-001",
  "maturity": "stable",

  "compatibility": {
    "mef": "^1.0"
  },

  "runtime": {
    "php": ">=8.4"
  },

  "entrypoint": "CRMModule",
  "provider": "CRMProvider",

  "capabilities": [
    "customer-management",
    "lead-management",
    "opportunity-management"
  ],

  "dependencies": {
    "MOD-IDENTITY": "^1.2"
  },

  "optionalDependencies": {
    "MOD-NOTIFICATIONS": "^2.0"
  },

  "provides": {
    "contracts": [
      "CT-CUSTOMER-001"
    ]
  },

  "requires": {
    "contracts": [
      "CT-IDENTITY-001"
    ]
  },

  "events": {
    "publishes": [
      "EVT-CRM-CUSTOMER-CREATED"
    ],
    "subscribes": [
      "EVT-IDENTITY-USER-CREATED"
    ]
  },

  "extensionPoints": [
    "EP-CRM-CUSTOMER-PROFILE"
  ],

  "configuration": {
    "schema": "config.schema.json"
  },

  "security": {
    "permissions": [
      "crm.customer.read",
      "crm.customer.write"
    ]
  },

  "lifecycle": {
    "hooks": [
      "initialize",
      "ready",
      "shutdown"
    ]
  },

  "documentation": {
    "readme": "README.md",
    "changelog": "CHANGELOG.md"
  },

  "license": "MIT",
  "maintainer": "MEF CRM Team"
}
```

---

# 43. Schema de Validación

El formato deberá disponer de un schema procesable por máquinas.

Conceptualmente:

```text
mef.manifest.json
        │
        ▼
Manifest Schema
        │
        ▼
Validator
        │
        ├── Valid
        └── Invalid
```

El schema deberá validar:

- campos obligatorios;
- tipos;
- formatos;
- enumeraciones;
- estructuras;
- restricciones básicas.

---

# 44. Validación Semántica

El Schema Validation no será suficiente.

Después de validar sintaxis deberá ejecutarse validación semántica.

Ejemplos:

- el Module ID debe ser único;
- las dependencias deben existir;
- las versiones deben ser compatibles;
- los Contracts requeridos deben estar disponibles;
- los Extension Points deben existir;
- no deben existir ciclos;
- los Lifecycle Hooks deben ser válidos.

---

# 45. Pipeline de Validación

```text
Manifest
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
Compatibility Validation
   │
   ▼
Dependency Validation
   │
   ▼
Architecture Validation
   │
   ▼
Accepted
```

Un error crítico deberá impedir Registration.

---

# 46. Errores

Los errores deberán ser identificables y comprensibles.

Ejemplos conceptuales:

```text
MEF-MAN-001 Missing required field
MEF-MAN-002 Invalid module ID
MEF-MAN-003 Unsupported schema version
MEF-MAN-004 Missing dependency
MEF-MAN-005 Version conflict
MEF-MAN-006 Unknown Contract
MEF-MAN-007 Circular dependency
```

La taxonomía definitiva de errores podrá definirse en una especificación posterior.

---

# 47. Compatibilidad del Schema

La evolución del Manifest deberá distinguir:

```text
Manifest Schema Version
```

de:

```text
Module Version
```

Ejemplo:

```json
{
  "schema": "2.0",
  "version": "7.3.1"
}
```

Significa:

- utiliza Manifest Schema 2.0;
- el Module es versión 7.3.1.

---

# 48. Evolución del Schema

Los cambios al Manifest Schema deberán clasificarse.

## Cambio compatible

Agregar un campo opcional.

## Cambio potencialmente incompatible

Modificar la semántica de un campo.

## Cambio incompatible

Eliminar o redefinir un campo obligatorio.

Los cambios incompatibles requerirán una nueva versión mayor del Schema.

---

# 49. Campos Desconocidos

La política sobre campos desconocidos deberá ser explícita.

La implementación inicial debería favorecer una política controlada:

- campos oficiales desconocidos podrán generar advertencia o error según versión;
- extensiones de metadata deberán utilizar espacios previstos;
- no deberán aceptarse silenciosamente errores tipográficos como campos válidos.

Esto reduce configuraciones aparentemente válidas pero incorrectas.

---

# 50. Determinismo

Dado el mismo Manifest y el mismo contexto de Registry, la validación deberá producir el mismo resultado.

La validación del Manifest deberá ser determinista.

---

# 51. Seguridad

El Manifest deberá tratarse como entrada no confiable hasta completar su validación.

Antes de cargar código deberán verificarse:

- estructura;
- identidad;
- compatibilidad;
- dependencias;
- integridad del Package;
- políticas de seguridad aplicables.

El Manifest nunca deberá permitir ejecución arbitraria.

---

# 52. Secretos

El Manifest no deberá almacenar:

```text
Passwords
API Keys
Private Keys
Tokens
Credentials
```

Los secretos deberán administrarse mediante mecanismos de configuración y seguridad específicos.

---

# 53. Integridad

Cuando el Packaging lo requiera, el Manifest podrá relacionarse con información de integridad:

```text
Package
   │
   ├── Manifest
   ├── Checksums
   └── Signature
```

La implementación concreta será definida por las especificaciones de Packaging y Security.

---

# 54. Registry Fingerprint

MEF podrá generar una representación normalizada del Manifest para:

- hashing;
- caché;
- comparación;
- auditoría;
- detección de cambios.

El algoritmo concreto deberá definirse posteriormente.

---

# 55. Normalización

Antes de ciertas operaciones, el Manifest podrá convertirse a una representación canónica.

Conceptualmente:

```text
Raw Manifest
     │
     ▼
Parse
     │
     ▼
Normalize
     │
     ▼
Canonical Manifest
```

La normalización no deberá alterar su significado.

---

# 56. Discovery sin Ejecución

Una propiedad fundamental del Manifest será permitir:

```text
Package Inspection
```

sin:

```text
Package Execution
```

MEF deberá poder conocer:

- qué es el Package;
- qué versión tiene;
- qué necesita;
- qué ofrece;
- si es compatible;

antes de cargar su código.

---

# 57. Uso por CLI

El futuro CLI podrá utilizar el Manifest para operaciones como:

```text
mef module inspect
mef module validate
mef module install
mef module dependencies
mef module info
```

Los comandos concretos serán especificados en **ENG-007 — CLI**.

---

# 58. Uso por Registry

El Registry podrá obtener del Manifest:

- identidad;
- versión;
- tipo;
- capacidades;
- Contracts;
- dependencias;
- estado;
- compatibilidad.

Esto permitirá construir el mapa estructural del Framework.

---

# 59. Uso por Package Manager

El Package Manager podrá utilizarlo para:

- resolver dependencias;
- comprobar versiones;
- detectar conflictos;
- verificar compatibilidad;
- preparar instalación.

La especificación completa corresponderá a **ENG-013 — Package Manager**.

---

# 60. Uso por Knowledge System

En el futuro, la información del Manifest podrá conectarse con el **MEF Knowledge System**.

Ejemplo:

```text
Manifest
   │
   ├── Module ID
   ├── Contract IDs
   ├── Event IDs
   └── Extension Point IDs
             │
             ▼
      Knowledge Graph
```

Así, el conocimiento documental y la composición real del Framework podrán relacionarse.

---

# 61. Invariantes de Ingeniería

ENG-003 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-036 | Todo Module distribuible deberá poseer un Manifest válido. |
| EI-037 | El Manifest deberá ser declarativo y no contener lógica ejecutable. |
| EI-038 | Todo Manifest deberá declarar la versión de su Schema. |
| EI-039 | Todo Manifest deberá declarar identidad y versión del componente. |
| EI-040 | Las dependencias obligatorias deberán declararse explícitamente. |
| EI-041 | El Manifest no deberá contener secretos. |
| EI-042 | MEF deberá poder validar un Manifest antes de ejecutar código del Package. |
| EI-043 | La validación del Manifest deberá incluir validación sintáctica y semántica. |
| EI-044 | El Manifest deberá distinguir su Schema Version de la versión del componente. |
| EI-045 | Los Contracts declarados deberán utilizar identificadores oficiales. |
| EI-046 | Los Extension Points declarados deberán existir y ser válidos. |
| EI-047 | La validación del Manifest deberá ser determinista. |
| EI-048 | Los campos desconocidos no deberán aceptarse silenciosamente cuando puedan representar errores. |
| EI-049 | El Manifest deberá permitir inspección del componente sin cargar su implementación. |
| EI-050 | La información esencial para Discovery y Registration deberá estar disponible de forma declarativa. |

---

# 62. Criterios de Conformidad

Un Manifest será conforme con ENG-003 cuando:

- utilice una versión soportada del Schema;
- contenga todos los campos obligatorios;
- posea ID válido;
- declare versión válida;
- declare tipo válido;
- declare compatibilidad;
- declare dependencias;
- pueda validarse mediante Schema;
- supere validación semántica;
- no contenga secretos;
- pueda inspeccionarse sin ejecutar código;
- satisfaga los `EI` y `AI` aplicables.

---

# 63. Riesgos

Deberán evitarse especialmente:

## Manifest ejecutable

Incorporar scripts o expresiones arbitrarias.

## Metadatos implícitos

Depender de convenciones ocultas para información crítica.

## Manifest monolítico

Convertirlo en depósito de toda la configuración del Module.

## Secretos

Guardar credenciales dentro del descriptor.

## Duplicación

Mantener la misma información con valores distintos en varias fuentes.

## Schema sin versión

Modificar la estructura sin poder identificar la especificación utilizada.

## Validación tardía

Descubrir incompatibilidades únicamente durante Runtime.

---

# 64. Fuente de Verdad

Para los metadatos técnicos declarados por ENG-003, el Manifest constituirá la fuente principal de verdad del Package.

No deberá existir información contradictoria sobre:

- ID;
- versión;
- tipo;
- dependencias;
- Entry Point;

en otras fuentes técnicas del mismo Package.

Cuando existan datos derivados, deberán generarse a partir de la fuente oficial.

---

# 65. Principio Rector

> **Todo componente distribuible de MEF deberá describirse mediante un Manifest declarativo, versionado, validable y procesable por máquinas que permita conocer su identidad, capacidades, compatibilidad y dependencias antes de ejecutar su código.**

---

# 66. Conclusión

**ENG-003 — Manifest** establece el contrato descriptivo entre un Package y el ecosistema MEF.

El Manifest permite transformar un conjunto de archivos desconocidos en un componente:

- identificable;
- inspeccionable;
- validable;
- versionable;
- resoluble;
- registrable;
- trazable.

Su importancia excede la simple configuración de un Module.

Constituye el punto donde la arquitectura declarativa de MEF empieza a convertirse en una **arquitectura procesable por máquinas**.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-015 — Extension Model
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-001 — Organización del Código
- ENG-002 — Especificación de Modules
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-013 — Package Manager
- ENG-014 — Versionado