# ARQ-009 — Builders

## Estado

Aceptado.

---

# Objetivo

Los Builders son componentes del Core responsables de construir artefactos del Framework de manera automática, consistente y repetible.

Su propósito es encapsular el conocimiento necesario para generar módulos, clases, configuraciones y estructuras de directorios siguiendo las convenciones oficiales de MEF.

Los Builders no contienen lógica de negocio.

Los Builders construyen componentes.

---

# Motivación

Crear manualmente un módulo implica:

- crear directorios;
- copiar plantillas;
- escribir archivos JSON;
- generar Service Providers;
- crear pruebas;
- generar documentación.

Este proceso es repetitivo y propenso a errores.

Los Builders eliminan esa repetición.

---

# Responsabilidades

Un Builder es responsable de:

- crear estructuras de carpetas;
- generar archivos;
- aplicar plantillas;
- escribir manifests;
- validar parámetros;
- garantizar consistencia;
- respetar las convenciones del Framework.

---

# Lo que un Builder NO debe hacer

Los Builders nunca deberán:

- ejecutar lógica de negocio;
- inicializar módulos;
- registrar componentes;
- modificar el Registry;
- consultar la base de datos;
- depender de aplicaciones.

---

# Filosofía

Cada Builder representa una única operación de construcción.

Ejemplo:

ModuleBuilder

↓

Construir un módulo

No deberá realizar tareas ajenas a esa responsabilidad.

---

# Componentes

Inicialmente MEF contará con los siguientes Builders.

## ModuleBuilder

Genera un módulo completo.

Incluye:

- estructura de carpetas;
- module.json;
- README;
- Service Provider;
- pruebas;
- plantillas;
- archivos base.

---

## ControllerBuilder

Genera controladores.

---

## ServiceBuilder

Genera servicios.

---

## EventBuilder

Genera eventos.

---

## ListenerBuilder

Genera listeners.

---

## MigrationBuilder

Genera migraciones.

---

## TestBuilder

Genera pruebas.

---

# Arquitectura

```text
CLI

    │

    ▼

ModuleBuilder

    │

    ├── DirectoryManager

    ├── StubWriter

    ├── JsonWriter

    ├── FileWriter

    └── GitKeepGenerator
```

Cada componente mantiene una responsabilidad específica.

---

# Relación con CLI

La CLI nunca deberá conocer cómo construir un módulo.

Ejemplo:

php artisan mef:make-module CRM

↓

CLI

↓

ModuleBuilder

↓

Archivos generados

La CLI únicamente interpreta argumentos.

Toda la lógica reside en los Builders.

---

# Relación con Template Engine

Los Builders no generan texto manualmente.

Delegan esa responsabilidad al Template Engine.

```text
Builder

↓

Template Engine

↓

Stub

↓

Archivo final
```

---

# Relación con FileSystem

Los Builders nunca escribirán archivos directamente.

Toda escritura deberá realizarse mediante:

- FileWriter;
- JsonWriter;
- StubWriter.

Esto garantiza consistencia y facilita las pruebas.

---

# Relación con Value Objects

Los Builders recibirán Value Objects siempre que sea posible.

Ejemplo:

```php
$builder->build(
    new ModuleName('CRM')
);
```

Las conversiones desde cadenas deberán realizarse antes de invocar el Builder.

---

# Flujo de construcción

```text
CLI

↓

Validación

↓

Builder

↓

Template Engine

↓

FileSystem

↓

Módulo generado
```

---

# Estructura generada

ModuleBuilder producirá una estructura similar a:

```text
Modules/

CRM/

Application/

Domain/

Infrastructure/

Providers/

Console/

Config/

Database/

Resources/

Routes/

Tests/

module.json

README.md
```

---

# Dependencias

Los Builders pueden depender de:

- Template Engine;
- FileWriter;
- JsonWriter;
- StubWriter;
- DirectoryManager;
- Value Objects.

No pueden depender de:

- Registry;
- Discovery;
- Modules;
- Platform;
- Applications.

---

# Errores

Los Builders utilizarán excepciones específicas.

Ejemplos:

BuilderException

ModuleAlreadyExistsException

InvalidModuleNameException

TemplateNotFoundException

DestinationNotWritableException

---

# Idempotencia

Los Builders deberán evitar sobrescribir archivos existentes salvo autorización explícita.

Ejemplo:

```php
$builder->build(
    metadata: $metadata,
    overwrite: false,
);
```

---

# Configuración

Las rutas utilizadas por los Builders deberán obtenerse desde la configuración del Framework.

No deberán contener rutas codificadas.

---

# Pruebas requeridas

Cada Builder deberá cubrir:

- generación correcta;
- directorio inexistente;
- plantilla inexistente;
- sobrescritura controlada;
- parámetros inválidos;
- escritura de manifests;
- integración con Template Engine;
- integración con FileSystem.

---

# Evolución

En versiones posteriores podrán incorporarse:

- ScaffoldBuilder;
- ResourceBuilder;
- CommandBuilder;
- JobBuilder;
- PolicyBuilder;
- NotificationBuilder;
- WorkflowBuilder.

Todos deberán respetar la misma filosofía.

---

# Convenciones

Todo Builder deberá:

- implementar un contrato;
- tener una única responsabilidad;
- utilizar Value Objects;
- ser completamente comprobable;
- delegar la escritura al FileSystem;
- delegar la generación al Template Engine.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|------------|-----------------|
| CLI | Recibir comandos |
| Builder | Orquestar la construcción |
| Template Engine | Renderizar plantillas |
| FileSystem | Escribir archivos |
| Value Objects | Validar conceptos |
| Discovery | Descubrir módulos |
| Registry | Registrar módulos |

---

# Decisiones arquitectónicas

1. Los Builders encapsulan la lógica de construcción.
2. La CLI nunca implementa lógica de generación.
3. El Template Engine es responsable del renderizado.
4. FileSystem controla toda escritura.
5. Los Builders utilizarán Value Objects.
6. La sobrescritura será siempre explícita.
7. Cada Builder tendrá una única responsabilidad.

---

# Criterios de aceptación

ARQ-009 se considerará implementado cuando existan:

- BuilderContract;
- ModuleBuilder;
- pruebas unitarias;
- integración con Template Engine;
- integración con FileSystem;
- soporte para Value Objects;
- documentación de la API pública.

---

# Conclusión

Los Builders representan el mecanismo oficial para generar artefactos dentro de MEF.

Su misión es automatizar tareas repetitivas, garantizar la consistencia del Framework y aplicar las convenciones oficiales de forma centralizada.

Los Builders construyen.

El Template Engine genera contenido.

El FileSystem escribe.

La CLI únicamente inicia el proceso.