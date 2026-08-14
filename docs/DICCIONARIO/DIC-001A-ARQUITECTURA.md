# DIC-001A — Arquitectura

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario arquitectónico oficial de MEF.

Este documento constituye la referencia única para los conceptos fundamentales sobre los cuales se construye el Framework.

Todo documento, componente de software, ADR, RFC o guía deberá utilizar estas definiciones de forma consistente.

---

# Alcance

DIC-001A define exclusivamente conceptos arquitectónicos.

No describe implementaciones específicas ni detalles de código.

---

# Convenciones

Cada término incluye:

- Identificador único.
- Definición oficial.
- Propósito.
- Categoría.
- Documento de origen.
- Componentes relacionados.
- Conceptos que no deben confundirse.
- Estado.
- Historial.

---

# MEF-DIC-0001

## Architecture

### Definición

La **Architecture** representa la estructura conceptual de MEF.

Define la organización del Framework, las dependencias permitidas entre componentes y las reglas que garantizan su evolución ordenada.

La arquitectura describe **cómo está construido el Framework**, no las funcionalidades que implementa.

### Propósito

Servir como base estructural permanente del proyecto.

### Categoría

Arquitectura

### Documento de origen

ARQ-001

### Componentes relacionados

- Core
- Platform
- Modules
- Applications
- Kernel

### No confundir con

- Diseño
- Código fuente
- Organización de carpetas

### Estado

Estable

### Historial

v0.1 — Creación del término.

---

# MEF-DIC-0002

## Layer

### Definición

Una **Layer** es un nivel arquitectónico que agrupa componentes con responsabilidades similares.

Cada capa posee dependencias claramente definidas y no puede acceder arbitrariamente a otra.

### Propósito

Reducir el acoplamiento entre componentes.

### Categoría

Arquitectura

### Documento de origen

ARQ-001

### Capas oficiales

- Foundation
- Core
- Platform
- Modules
- Applications

### No confundir con

- Namespace
- Carpeta
- Módulo

### Estado

Estable

---

# MEF-DIC-0003

## Core

### Definición

El **Core** constituye el núcleo tecnológico de MEF.

Contiene los servicios fundamentales sobre los cuales se construyen Platform, Modules y Applications.

No contiene lógica de negocio.

### Propósito

Proporcionar infraestructura reutilizable para todo el Framework.

### Categoría

Arquitectura

### Documento de origen

ARQ-002

### Componentes

- Kernel
- Registry
- Discovery
- Bootstrap
- Events
- Contracts
- Value Objects
- Builders

### No confundir con

- Platform
- Module

### Estado

Estable

---

# MEF-DIC-0004

## Platform

### Definición

La **Platform** agrupa servicios compartidos reutilizables por cualquier módulo.

Representa capacidades comunes que no pertenecen al Core ni a un dominio de negocio específico.

### Propósito

Centralizar infraestructura compartida.

### Categoría

Arquitectura

### Documento de origen

ARQ-003

### Ejemplos

- Authentication
- Authorization
- Audit
- Cache
- Notifications
- Scheduler

### No confundir con

- Core
- Module

### Estado

Estable

---

# MEF-DIC-0005

## Module

### Definición

Un **Module** es una unidad funcional independiente que encapsula una capacidad específica del negocio.

Representa la unidad oficial de extensión de MEF.

Puede instalarse, habilitarse, actualizarse o eliminarse sin modificar el Core.

### Propósito

Extender el Framework mediante componentes desacoplados.

### Categoría

Arquitectura

### Documento de origen

ARQ-004

### Responsabilidades

- Encapsular funcionalidad.
- Declarar un Manifest.
- Registrar un Service Provider.
- Publicar eventos.
- Exponer casos de uso.

### Ejemplos

- CRM
- Inventory
- Finance
- Organization
- HR

### No confundir con

- Package
- Plugin
- Application

### Estado

Estable

---

# MEF-DIC-0006

## Application

### Definición

Una **Application** es un sistema construido utilizando MEF.

Consume capacidades del Core, Platform y Modules para resolver necesidades de una organización.

### Propósito

Representar el producto final desplegado para los usuarios.

### Categoría

Arquitectura

### Documento de origen

ARQ-001

### Ejemplos

- ERP Empresarial
- CRM Comercial
- Plataforma Sembrando Vida
- Sistema Hospitalario

### No confundir con

- Module
- Core

### Estado

Estable

---

# MEF-DIC-0007

## Component

### Definición

Un **Component** es una unidad de software con una responsabilidad claramente definida y una interfaz bien establecida.

Puede formar parte del Core, Platform o Modules.

### Propósito

Favorecer la reutilización y la alta cohesión.

### Categoría

Arquitectura

### Documento de origen

ARQ-001

### Ejemplos

- Registry
- Discovery
- Builder
- Event Dispatcher

### Estado

Estable

---

# MEF-DIC-0008

## Capability

### Definición

Una **Capability** representa una capacidad funcional ofrecida por el Framework o por un Module.

Describe **qué puede hacer** un componente, sin definir cómo está implementado.

### Propósito

Modelar funcionalidades desde una perspectiva arquitectónica.

### Categoría

Arquitectura

### Documento de origen

ARQ-003

### Ejemplos

- Gestión de usuarios
- Inventarios
- Notificaciones
- Autenticación

### No confundir con

- Clase
- Método
- Feature técnica

### Estado

Estable

---

# MEF-DIC-0009

## Boundary

### Definición

Un **Boundary** es un límite arquitectónico que define las interacciones permitidas entre componentes o capas.

Su finalidad es preservar el desacoplamiento y proteger la arquitectura.

### Propósito

Controlar las dependencias del Framework.

### Categoría

Arquitectura

### Documento de origen

04-PRINCIPIOS_DE_ARQUITECTURA.md

### Ejemplos

- Core ↔ Platform
- Platform ↔ Modules
- Modules ↔ Applications

### Estado

Estable

---

# MEF-DIC-0010

## Framework

### Definición

**MEF (Modular ERP Framework)** es un Framework modular orientado a la construcción de aplicaciones empresariales.

Proporciona una arquitectura, un conjunto de componentes reutilizables y convenciones de desarrollo que permiten crear sistemas complejos de forma consistente.

### Propósito

Servir como plataforma tecnológica para el desarrollo de aplicaciones empresariales.

### Categoría

Arquitectura

### Documento de origen

01-VISION.md

### Estado

Estable

---

# Resumen de términos

| ID | Término | Documento |
|----|----------|-----------|
| MEF-DIC-0001 | Architecture | ARQ-001 |
| MEF-DIC-0002 | Layer | ARQ-001 |
| MEF-DIC-0003 | Core | ARQ-002 |
| MEF-DIC-0004 | Platform | ARQ-003 |
| MEF-DIC-0005 | Module | ARQ-004 |
| MEF-DIC-0006 | Application | ARQ-001 |
| MEF-DIC-0007 | Component | ARQ-001 |
| MEF-DIC-0008 | Capability | ARQ-003 |
| MEF-DIC-0009 | Boundary | Principios de Arquitectura |
| MEF-DIC-0010 | Framework | Visión |

---

# Decisiones

1. Cada término posee una única definición oficial.
2. Las definiciones son independientes de la implementación.
3. Todo documento futuro deberá utilizar esta terminología.
4. Los cambios de significado requerirán un ADR.
5. El Diccionario constituye el lenguaje oficial de MEF.

---

# Conclusión

DIC-001A establece el vocabulario arquitectónico fundamental de MEF.

Estos conceptos sirven como base para la Fundación, la Arquitectura y la implementación del Framework, garantizando un lenguaje consistente entre la documentación y el código.