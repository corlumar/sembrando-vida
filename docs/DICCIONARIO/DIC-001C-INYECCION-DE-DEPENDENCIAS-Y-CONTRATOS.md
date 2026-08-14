# DIC-001C — Inyección de Dependencias y Contratos

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario oficial relacionado con la Inversión de Control (IoC), la Inyección de Dependencias (DI) y los Contratos utilizados por MEF.

Estos conceptos permiten que los componentes del Framework colaboren entre sí mediante abstracciones, evitando dependencias directas sobre implementaciones concretas.

---

# Alcance

Este documento cubre los conceptos relacionados con:

- Contratos
- Interfaces
- Contenedor
- Inyección de Dependencias
- Ciclo de vida de servicios
- Resolución de dependencias
- Objetos de Valor

No describe implementaciones específicas de Laravel.

---

# MEF-DIC-0021

## Dependency Injection (DI)

### Definición

La **Inyección de Dependencias** es el mecanismo mediante el cual un componente recibe sus colaboraciones desde el exterior, en lugar de crearlas por sí mismo.

### Propósito

Reducir el acoplamiento entre componentes y facilitar las pruebas, la sustitución de implementaciones y la evolución del Framework.

### Categoría

Core

### Documento de origen

ARQ-013

### Ejemplo conceptual

Correcto:

```php
final readonly class RegisterModuleService
{
    public function __construct(
        private RegistryContract $registry,
    ) {}
}
```

Incorrecto:

```php
$this->registry = new Registry();
```

### No confundir con

- Service Locator
- Factory

### Estado

Estable

---

# MEF-DIC-0022

## Contract

### Definición

Un **Contract** define el comportamiento esperado de un componente sin especificar su implementación.

Representa un acuerdo entre quien solicita un servicio y quien lo proporciona.

### Propósito

Permitir múltiples implementaciones intercambiables.

### Categoría

Core

### Documento de origen

ARQ-013

### Ejemplos

- RegistryContract
- DiscoveryContract
- EventDispatcherContract

### No confundir con

- Clase concreta
- Trait

### Estado

Estable

---

# MEF-DIC-0023

## Interface

### Definición

Una **Interface** es el mecanismo del lenguaje PHP utilizado para expresar un Contract.

En MEF, todos los Contracts se implementan mediante interfaces.

### Propósito

Formalizar contratos entre componentes.

### Categoría

Core

### Documento de origen

ARQ-013

### Relación

Toda Interface utilizada como API pública del Core representa un Contract.

### Estado

Estable

---

# MEF-DIC-0024

## Container

### Definición

El **Container** es el componente responsable de resolver dependencias y construir objetos.

En la implementación inicial, MEF utiliza el contenedor de Laravel mediante adaptadores propios.

### Propósito

Centralizar la resolución de dependencias.

### Categoría

Core

### Documento de origen

ARQ-013

### Responsabilidades

- Resolver dependencias.
- Administrar ciclos de vida.
- Construir servicios.

### No confundir con

- Registry
- Service Locator

### Estado

Estable

---

# MEF-DIC-0025

## Binding

### Definición

Un **Binding** es la asociación entre un Contract y su implementación.

### Propósito

Permitir sustituir implementaciones sin modificar el código consumidor.

### Ejemplo

```text
RegistryContract
        │
        ▼
ModuleRegistry
```

### Documento de origen

ARQ-013

### Estado

Estable

---

# MEF-DIC-0026

## Singleton

### Definición

Un **Singleton** es un servicio cuya instancia se crea una única vez y se reutiliza durante todo el ciclo de vida de la aplicación.

### Propósito

Compartir recursos comunes.

### Ejemplos

- Registry
- Event Dispatcher
- Configuration

### Documento de origen

ARQ-013

### Estado

Estable

---

# MEF-DIC-0027

## Scoped Service

### Definición

Servicio cuya instancia permanece viva únicamente durante el alcance definido por el Framework.

En aplicaciones web normalmente corresponde al ciclo de vida de una petición.

### Propósito

Compartir estado temporal sin convertirlo en global.

### Documento de origen

ARQ-013

### Estado

Propuesto

---

# MEF-DIC-0028

## Transient Service

### Definición

Servicio cuya instancia se crea cada vez que es solicitado al Container.

### Propósito

Evitar compartir estado entre consumidores.

### Documento de origen

ARQ-013

### Estado

Estable

---

# MEF-DIC-0029

## Autowiring

### Definición

Proceso mediante el cual el Container resuelve automáticamente las dependencias de un componente analizando su constructor.

### Propósito

Reducir configuración manual.

### Documento de origen

ARQ-013

### Estado

Estable

---

# MEF-DIC-0030

## Value Object

### Definición

Objeto inmutable que representa un concepto del dominio mediante su valor y no por una identidad propia.

Dos Value Objects son iguales cuando representan el mismo valor.

### Propósito

Modelar conceptos pequeños de forma segura y expresiva.

### Ejemplos

- ModuleId
- ModuleName
- ModuleVersion
- ModulePath
- ProviderClass

### Documento de origen

ARQ-013

### No confundir con

- Entity
- DTO

### Estado

Estable

---

# Principios

Los componentes del Core deberán:

- depender de Contracts;
- recibir dependencias mediante el constructor;
- evitar crear colaboradores con `new`;
- utilizar Value Objects para conceptos del dominio;
- no depender directamente del contenedor.

---

# Relaciones

```text
Contract
    │
    ▼
Binding
    │
    ▼
Implementation
    │
    ▼
Container
    │
    ▼
Dependency Injection
```

---

# Resumen

| ID | Término |
|----|----------|
| MEF-DIC-0021 | Dependency Injection |
| MEF-DIC-0022 | Contract |
| MEF-DIC-0023 | Interface |
| MEF-DIC-0024 | Container |
| MEF-DIC-0025 | Binding |
| MEF-DIC-0026 | Singleton |
| MEF-DIC-0027 | Scoped Service |
| MEF-DIC-0028 | Transient Service |
| MEF-DIC-0029 | Autowiring |
| MEF-DIC-0030 | Value Object |

---

# Decisiones

1. Todo componente del Core dependerá de Contracts.
2. Los Contracts se implementarán mediante interfaces.
3. La resolución de dependencias será responsabilidad del Container.
4. El Core no dependerá directamente de la implementación del contenedor.
5. Los conceptos del dominio se representarán mediante Value Objects.
6. El uso de `new` para crear colaboradores del Core deberá evitarse, salvo cuando se creen objetos de valor u objetos sin dependencias.

---

# Conclusión

DIC-001C establece el lenguaje oficial de MEF para la Inyección de Dependencias y los Contratos.

Este vocabulario servirá como base para el desarrollo del Kernel, Registry, Discovery, Application Services y del resto de componentes del Core, garantizando un modelo consistente de colaboración entre ellos.