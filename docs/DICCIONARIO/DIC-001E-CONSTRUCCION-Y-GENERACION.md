# DIC-001E — Construcción y Generación

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario oficial utilizado por el subsistema de construcción y generación de artefactos de MEF.

Este documento establece el significado único de los conceptos relacionados con la creación automatizada de módulos, componentes y estructuras del Framework.

---

# Alcance

Este documento cubre los conceptos relacionados con:

- Builders
- Generadores
- Plantillas
- Stubs
- Artefactos
- Scaffolding
- Workspace
- Pipeline de construcción

No describe implementaciones concretas.

---

# MEF-DIC-0041

## Builder

### Definición

Un **Builder** es un componente especializado cuya responsabilidad consiste en construir un tipo específico de artefacto del Framework.

Un Builder recibe información estructurada y produce componentes completos y consistentes.

### Propósito

Automatizar la generación de código y recursos.

### Categoría

Core

### Documento de origen

ARQ-009

### Ejemplos

- ModuleBuilder
- CommandBuilder
- MigrationBuilder
- ProviderBuilder

### No confundir con

- Factory
- Generator

### Estado

Estable

---

# MEF-DIC-0042

## Builder Pipeline

### Definición

Secuencia ordenada de Builders ejecutados para construir un artefacto complejo.

Cada Builder realiza una única responsabilidad dentro del proceso.

### Propósito

Dividir la generación en etapas independientes y reutilizables.

### Documento de origen

ARQ-009

### Flujo

```text
Metadata
    │
    ▼
DirectoryBuilder
    │
    ▼
ManifestBuilder
    │
    ▼
ProviderBuilder
    │
    ▼
ResourceBuilder
```

### Estado

Propuesto

---

# MEF-DIC-0043

## Generator

### Definición

Componente de alto nivel que coordina uno o varios Builders para producir un resultado completo.

### Propósito

Orquestar procesos complejos de generación.

### Documento de origen

ARQ-009

### Ejemplos

- ModuleGenerator
- ProjectGenerator

### No confundir con

- Builder

### Estado

Estable

---

# MEF-DIC-0044

## Template

### Definición

Documento base que define la estructura de un archivo generado.

Puede contener marcadores que serán reemplazados durante la generación.

### Propósito

Separar la estructura del código de la lógica de generación.

### Documento de origen

ARQ-010

### Ejemplos

- PHP
- JSON
- Markdown
- YAML

### Estado

Estable

---

# MEF-DIC-0045

## Template Engine

### Definición

Componente encargado de interpretar Templates y producir archivos finales mediante la sustitución de variables.

### Propósito

Transformar plantillas en artefactos completos.

### Documento de origen

ARQ-010

### Responsabilidades

- Leer templates.
- Sustituir variables.
- Validar marcadores.
- Generar contenido.

### Estado

Estable

---

# MEF-DIC-0046

## Stub

### Definición

Archivo de plantilla utilizado como base para generar código fuente.

Generalmente contiene marcadores que serán reemplazados durante la generación.

### Propósito

Estandarizar el código generado.

### Documento de origen

ARQ-010

### No confundir con

- Template Engine
- Artifact

### Estado

Estable

---

# MEF-DIC-0047

## Stub Writer

### Definición

Componente responsable de escribir el contenido generado a partir de un Stub en el sistema de archivos.

### Propósito

Persistir artefactos generados.

### Documento de origen

ARQ-010

### Estado

Propuesto

---

# MEF-DIC-0048

## Artifact

### Definición

Resultado producido por un Builder o Generator.

Un Artifact puede ser cualquier recurso generado automáticamente por MEF.

### Propósito

Representar el producto final de un proceso de generación.

### Ejemplos

- Clase PHP
- Manifest
- Provider
- Vista
- Archivo JSON

### Documento de origen

ARQ-009

### Estado

Estable

---

# MEF-DIC-0049

## Scaffold

### Definición

Conjunto inicial de archivos y directorios generados automáticamente para iniciar un componente o módulo.

### Propósito

Reducir el trabajo repetitivo y garantizar una estructura consistente.

### Documento de origen

ARQ-009

### Ejemplo

```text
Modules/
└── CRM/
    ├── Domain/
    ├── Application/
    ├── Infrastructure/
    ├── Providers/
    └── module.json
```

### Estado

Estable

---

# MEF-DIC-0050

## Workspace

### Definición

Espacio de trabajo donde los Builders y Generators crean temporalmente artefactos antes de su publicación o integración.

### Propósito

Aislar procesos de generación y facilitar validaciones previas.

### Documento de origen

ARQ-009

### Estado

Propuesto

---

# Principios

El subsistema de generación de MEF seguirá estas reglas:

- Cada Builder tendrá una única responsabilidad.
- Los Builders serán reutilizables.
- Los Generators coordinarán procesos complejos.
- Los Templates estarán separados de la lógica.
- Todo Artifact será reproducible.
- El código generado seguirá las convenciones oficiales del Framework.

---

# Relaciones

```text
Generator
      │
      ▼
Builder Pipeline
      │
      ▼
Builder
      │
      ▼
Template Engine
      │
      ▼
Template / Stub
      │
      ▼
Artifact
      │
      ▼
Filesystem
```

---

# Resumen

| ID | Término |
|----|----------|
| MEF-DIC-0041 | Builder |
| MEF-DIC-0042 | Builder Pipeline |
| MEF-DIC-0043 | Generator |
| MEF-DIC-0044 | Template |
| MEF-DIC-0045 | Template Engine |
| MEF-DIC-0046 | Stub |
| MEF-DIC-0047 | Stub Writer |
| MEF-DIC-0048 | Artifact |
| MEF-DIC-0049 | Scaffold |
| MEF-DIC-0050 | Workspace |

---

# Decisiones

1. Los Builders construirán un único tipo de artefacto.
2. Los Generators coordinarán múltiples Builders.
3. Los Templates permanecerán separados del código.
4. Todo Artifact deberá ser reproducible.
5. El código generado seguirá los estándares oficiales de MEF.
6. El proceso de generación podrá ejecutarse mediante una Builder Pipeline.

---

# Conclusión

DIC-001E establece el vocabulario oficial del subsistema de construcción y generación de MEF.

Estos conceptos servirán como base para implementar los Builders, el Template Engine, los Generators y el comando `php artisan mef:make-module`, garantizando una generación consistente, reproducible y alineada con la arquitectura del Framework.