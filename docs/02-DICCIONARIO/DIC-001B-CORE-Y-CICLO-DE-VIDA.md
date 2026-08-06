# DIC-001B — Core y Ciclo de Vida

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario oficial relacionado con el núcleo (Core) de MEF y con el ciclo de vida del Framework y de sus módulos.

Este documento complementa DIC-001A y constituye la referencia para comprender el funcionamiento interno de MEF.

---

# Alcance

Este documento describe conceptos relacionados con:

- Kernel
- Bootstrap
- Registry
- Discovery
- Manifest
- Metadata
- Ciclo de vida
- Estado del Framework

No describe detalles de implementación.

---

# MEF-DIC-0011

## Kernel

### Definición

El **Kernel** es el coordinador principal del ciclo de vida de MEF.

Representa el punto de entrada del Framework y coordina la inicialización, operación y finalización de sus componentes fundamentales.

El Kernel no implementa lógica de negocio.

Su función consiste en coordinar el funcionamiento del Framework.

### Propósito

Mantener un estado consistente del Framework durante toda su ejecución.

### Categoría

Core

### Documento de origen

ARQ-005

### Responsabilidades

- Coordinar Bootstrap.
- Inicializar Registry.
- Coordinar Discovery.
- Preparar Platform.
- Administrar el estado del Framework.
- Publicar eventos del ciclo de vida.

### Componentes relacionados

- Bootstrap
- Registry
- Discovery
- Event Dispatcher
- Framework State

### No confundir con

- Bootstrap
- Service Provider
- Application

### Estado

Estable

---

# MEF-DIC-0012

## Bootstrap

### Definición

Proceso mediante el cual MEF pasa de un estado inicial a un estado completamente operativo.

Bootstrap prepara el Framework.

No ejecuta lógica empresarial.

### Propósito

Inicializar el Framework de forma ordenada, determinista y repetible.

### Categoría

Core

### Documento de origen

ARQ-014

### Responsabilidades

- Leer configuración.
- Ejecutar Discovery.
- Registrar módulos.
- Inicializar Providers.
- Preparar Platform.
- Publicar eventos de inicio.

### No confundir con

- Kernel
- Boot Sequence

### Estado

Estable

---

# MEF-DIC-0013

## Registry

### Definición

Componente encargado de mantener el catálogo oficial de módulos registrados durante la ejecución.

Representa la fuente de verdad del estado de los módulos cargados.

No almacena información de negocio.

### Propósito

Administrar el inventario de módulos disponibles para el Framework.

### Categoría

Core

### Documento de origen

ARQ-006

### Responsabilidades

- Registrar módulos.
- Buscar módulos.
- Enumerar módulos.
- Consultar metadatos.

### No confundir con

- Repository
- Database
- Cache

### Estado

Estable

---

# MEF-DIC-0014

## Discovery

### Definición

Componente encargado de localizar módulos instalados y construir su representación inicial.

Discovery descubre.

No registra.

No inicializa.

### Propósito

Detectar módulos disponibles para Bootstrap.

### Categoría

Core

### Documento de origen

ARQ-008

### Responsabilidades

- Explorar directorios.
- Leer Manifest.
- Validar estructura.
- Construir Metadata.

### No confundir con

- Registry
- Builder

### Estado

Estable

---

# MEF-DIC-0015

## Manifest

### Definición

Documento declarativo que describe un módulo.

Contiene la información mínima necesaria para que el Framework pueda reconocerlo.

### Propósito

Describir un módulo de forma independiente de su implementación.

### Categoría

Core

### Documento de origen

ARQ-008

### Información típica

- ModuleId
- ModuleName
- Version
- Namespace
- Provider
- Dependencias

### No confundir con

- Metadata

### Estado

Estable

---

# MEF-DIC-0016

## Module Metadata

### Definición

Objeto que representa la información validada de un módulo.

Constituye la representación en memoria del Manifest.

### Propósito

Permitir que el Framework trabaje con información estructurada y tipada.

### Categoría

Core

### Documento de origen

ARQ-008

### Componentes relacionados

- Manifest
- Registry
- ModuleId
- ModuleVersion

### Estado

Estable

---

# MEF-DIC-0017

## Module Lifecycle

### Definición

Conjunto de estados por los que atraviesa un módulo desde que es localizado hasta que queda disponible para su uso.

### Propósito

Modelar la evolución de un módulo durante su inicialización.

### Categoría

Core

### Documento de origen

ARQ-014

### Estados

```text
DISCOVERED

↓

VALIDATED

↓

REGISTERED

↓

BOOTED

↓

READY
```

### Estado

Estable

---

# MEF-DIC-0018

## Framework State

### Definición

Representa el estado operativo global del Framework durante su ejecución.

### Propósito

Permitir que los componentes conozcan la etapa actual del ciclo de vida de MEF.

### Categoría

Core

### Documento de origen

ARQ-005

### Estados sugeridos

```text
CREATED

↓

BOOTING

↓

DISCOVERING

↓

REGISTERING

↓

BOOTED

↓

READY

↓

STOPPING

↓

STOPPED
```

### Estado

Propuesto

---

# MEF-DIC-0019

## Boot Sequence

### Definición

Secuencia oficial de pasos ejecutados durante Bootstrap.

Cada etapa debe finalizar correctamente antes de iniciar la siguiente.

### Propósito

Garantizar un inicio reproducible del Framework.

### Categoría

Core

### Documento de origen

ARQ-014

### Flujo

```text
Configuration

↓

Discovery

↓

Registry

↓

Providers

↓

Events

↓

READY
```

### Estado

Estable

---

# MEF-DIC-0020

## Boot Context

### Definición

Objeto compartido entre las etapas del Bootstrap que concentra toda la información necesaria para coordinar la inicialización del Framework.

### Propósito

Reducir el acoplamiento entre las fases del Bootstrap.

### Categoría

Core

### Documento de origen

ARQ-014

### Información típica

- Configuración.
- Módulos descubiertos.
- Registry.
- Estado del Kernel.
- Eventos publicados.

### No confundir con

- Container
- Registry

### Estado

Propuesto

---

# Resumen de términos

| ID | Término | Documento |
|----|----------|-----------|
| MEF-DIC-0011 | Kernel | ARQ-005 |
| MEF-DIC-0012 | Bootstrap | ARQ-014 |
| MEF-DIC-0013 | Registry | ARQ-006 |
| MEF-DIC-0014 | Discovery | ARQ-008 |
| MEF-DIC-0015 | Manifest | ARQ-008 |
| MEF-DIC-0016 | Module Metadata | ARQ-008 |
| MEF-DIC-0017 | Module Lifecycle | ARQ-014 |
| MEF-DIC-0018 | Framework State | ARQ-005 |
| MEF-DIC-0019 | Boot Sequence | ARQ-014 |
| MEF-DIC-0020 | Boot Context | ARQ-014 |

---

# Decisiones

1. El Kernel coordina el Framework; no implementa lógica de negocio.
2. Bootstrap representa un proceso, no un componente.
3. Discovery descubre módulos; Registry los registra.
4. Manifest y Module Metadata representan niveles distintos de información.
5. El ciclo de vida de los módulos y el estado global del Framework son conceptos independientes.
6. Todo componente del Core deberá utilizar esta terminología de forma consistente.

---

# Conclusión

DIC-001B establece el vocabulario oficial del núcleo de MEF.

Estos conceptos describen cómo el Framework inicia, descubre módulos, administra su estado y alcanza un estado operativo estable, constituyendo la base para la implementación del Kernel, Registry, Discovery y Bootstrap.