# ARQ-002 — Core

## Estado

Aceptado.

---

# Objetivo

El Core constituye el núcleo de MEF.

Su responsabilidad es proporcionar infraestructura reutilizable para todas las aplicaciones y módulos construidos sobre el Framework.

El Core no implementa reglas de negocio.

Su propósito es ofrecer servicios técnicos comunes que permitan construir soluciones empresariales de forma consistente, mantenible y escalable.

---

# Responsabilidades

El Core es responsable de:

- Inicializar el Framework.
- Administrar el ciclo de vida de MEF.
- Descubrir módulos.
- Registrar componentes.
- Resolver dependencias.
- Proporcionar herramientas de generación.
- Gestionar plantillas.
- Administrar operaciones sobre el sistema de archivos.
- Exponer la CLI del Framework.
- Definir contratos reutilizables.

---

# Principios

El Core debe cumplir los siguientes principios:

- No contiene lógica de negocio.
- No depende de módulos.
- No depende de aplicaciones.
- Es reutilizable.
- Es comprobable mediante pruebas.
- Evoluciona sin romper compatibilidad siempre que sea posible.

---

# Componentes actuales

Actualmente el Core está compuesto por los siguientes componentes.

## Kernel

Responsable del arranque del Framework.

Funciones:

- iniciar MEF;
- cargar configuración;
- descubrir módulos;
- registrar proveedores;
- inicializar servicios.

---

## Contracts

Define las interfaces oficiales del Framework.

Ejemplos:

- FileWriterContract
- JsonWriterContract
- StubWriterContract
- ModuleBuilderContract
- ERPKernelContract

Los contratos representan el punto de extensión oficial de MEF.

---

## FileSystem

Abstrae las operaciones sobre archivos y directorios.

Componentes actuales:

- DirectoryManager
- FileWriter
- JsonWriter
- StubWriter

Objetivos:

- reducir duplicación;
- centralizar operaciones;
- facilitar pruebas;
- mantener consistencia.

---

## Builders

Responsables de generar artefactos automáticamente.

Ejemplos:

- ModuleBuilder
- futuros EntityBuilder
- MigrationBuilder
- ControllerBuilder

Los Builders nunca implementan lógica de negocio.

---

## Template Engine

Sistema encargado de transformar plantillas (stubs) en archivos reales mediante sustitución de variables.

Ejemplo:

```
service.stub
```

↓

```
ExampleService.php
```

---

## CLI

Conjunto de comandos Artisan propios de MEF.

Ejemplos:

```
mef:make-module

mef:status

mef:install
```

La CLI actúa únicamente como orquestador.

Toda lógica debe residir en servicios del Core.

---

## Registry

Mantiene el registro de módulos y componentes disponibles.

Responsabilidades:

- registrar módulos;
- consultar módulos;
- almacenar metadatos;
- exponer información al Kernel.

---

## Discovery

Permite detectar automáticamente módulos instalados.

Responsabilidades:

- localizar manifests;
- identificar Service Providers;
- registrar módulos disponibles.

---

# Dependencias permitidas

El Core puede depender de:

- PHP
- Laravel Framework
- Componentes internos del Core

El Core no puede depender de:

- Platform
- Modules
- Applications

---

# Organización del código

Actualmente el Core se organiza de la siguiente manera:

```text
app/
└── Core/
    ├── Builders/
    ├── Contracts/
    ├── Console/
    ├── FileSystem/
    ├── Kernel/
    ├── Providers/
    ├── Templates/
    └── Support/
```

Esta estructura podrá evolucionar conforme el Framework incorpore nuevos componentes.

---

# Criterios para incorporar componentes

Un componente podrá incorporarse al Core únicamente si:

- resuelve un problema reutilizable;
- no contiene lógica de negocio;
- está desacoplado;
- dispone de pruebas automatizadas;
- está documentado;
- sigue las convenciones del proyecto.

---

# Componentes previstos

Durante la evolución de MEF se incorporarán nuevos componentes al Core.

Entre ellos:

- Event Bus
- Configuration Manager
- Package Manager
- Cache Manager
- Scheduler
- Queue Manager
- Plugin Manager
- Installer
- Update Manager
- Marketplace Client

Cada nuevo componente deberá documentarse antes de su implementación.

---

# Relación con otras capas

```text
Applications
        │
        ▼
Modules
        │
        ▼
Platform
        │
        ▼
Core
```

El Core constituye la base sobre la que se construyen todas las capas superiores.

---

# Conclusión

El Core representa la infraestructura fundamental de MEF.

Toda decisión relacionada con el Core deberá priorizar:

- simplicidad;
- reutilización;
- estabilidad;
- mantenibilidad;
- compatibilidad;
- calidad.

El éxito de MEF depende de mantener un Core pequeño, sólido y desacoplado.