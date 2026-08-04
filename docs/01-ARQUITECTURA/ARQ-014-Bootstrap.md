# ARQ-014 — Bootstrap

## Estado

Aceptado.

---

# Objetivo

Bootstrap define el proceso oficial de inicialización de MEF.

Su responsabilidad consiste en coordinar el arranque del Framework, registrar los servicios del Core, cargar la configuración, descubrir módulos, registrar componentes y dejar el sistema listo para recibir solicitudes.

Bootstrap representa el ciclo de vida completo del Framework.

No contiene lógica empresarial.

No ejecuta casos de uso.

Únicamente prepara el entorno de ejecución.

---

# Motivación

Un Framework modular necesita un proceso de inicialización determinista.

Todos los componentes deben arrancar en el mismo orden.

Un orden incorrecto puede provocar:

- servicios no registrados;
- módulos parcialmente cargados;
- dependencias no resueltas;
- errores difíciles de diagnosticar;
- comportamiento inconsistente.

Bootstrap garantiza un proceso repetible.

---

# Principios

Bootstrap deberá ser:

- determinista;
- repetible;
- desacoplado;
- observable;
- extensible;
- comprobable.

---

# Flujo general

```text
Laravel

    │

    ▼

MEFServiceProvider

    │

    ▼

Registrar Contracts

    │

    ▼

Registrar Core Services

    │

    ▼

Construir Kernel

    │

    ▼

Cargar Configuración

    │

    ▼

Discovery

    │

    ▼

Manifest Validator

    │

    ▼

ModuleMetadata

    │

    ▼

Registry

    │

    ▼

Service Providers de módulos

    │

    ▼

Event System

    │

    ▼

Framework listo
```

---

# Etapa 1

## Inicialización de Laravel

Laravel prepara:

- Container
- Configuration
- Logging
- Providers
- Artisan
- Environment

MEF no modifica este proceso.

---

# Etapa 2

## Registro del Core

MEFServiceProvider registra:

- Contracts
- Builders
- Registry
- Discovery
- Template Engine
- FileSystem
- Application Services

En esta etapa no se ejecuta lógica.

Únicamente se registran dependencias.

---

# Etapa 3

## Construcción del Kernel

El contenedor resuelve:

```text
MEFKernel
```

El Kernel representa el coordinador principal.

Todavía no inicializa módulos.

---

# Etapa 4

## Configuración

El Kernel obtiene la configuración.

Ejemplos:

```text
modules.path

templates.path

cache.enabled

strict_mode
```

Toda la configuración deberá estar disponible antes de iniciar Discovery.

---

# Etapa 5

## Discovery

Discovery localiza módulos.

Resultado:

```text
Collection<ModuleMetadata>
```

Todavía no se registran.

---

# Etapa 6

## Validación

Cada manifest será validado.

Ejemplos:

- JSON válido;
- Provider definido;
- Version válida;
- Namespace correcto.

Los módulos inválidos no deberán registrarse.

---

# Etapa 7

## Registry

Registry recibe únicamente módulos válidos.

```text
Registry

↓

ModuleMetadata

↓

Index interno
```

---

# Etapa 8

## Registro de Providers

Cada módulo registrado podrá registrar sus servicios.

Ejemplo:

```text
CRMServiceProvider

InventoryServiceProvider

OrganizationServiceProvider
```

Todavía no ejecutan lógica empresarial.

Únicamente registran dependencias.

---

# Etapa 9

## Boot de módulos

Después del registro:

```text
boot()
```

Cada módulo podrá:

- registrar eventos;
- publicar recursos;
- registrar rutas;
- cargar traducciones;
- inicializar componentes.

---

# Etapa 10

## Framework listo

El Kernel cambia a:

```text
READY
```

A partir de este momento:

- CLI
- HTTP
- API
- Queue

podrán utilizar el Framework.

---

# Estados del Kernel

```text
CREATED

↓

REGISTERING

↓

CONFIGURING

↓

DISCOVERING

↓

VALIDATING

↓

REGISTERING_MODULES

↓

BOOTING

↓

READY
```

Estos estados facilitarán:

- diagnóstico;
- observabilidad;
- depuración.

---

# Errores

Bootstrap deberá detenerse cuando falle un componente crítico.

Ejemplos:

```text
ConfigurationException

RegistryException

BootstrapException

DiscoveryException
```

En modo estricto cualquier error crítico abortará el arranque.

---

# Bootstrap parcial

Versiones futuras podrán permitir:

```text
CLI

↓

Solo Core
```

Sin cargar módulos.

Esto mejorará el rendimiento de ciertas operaciones.

---

# Bootstrap incremental

También podrá soportarse:

```text
Nuevo módulo

↓

Discovery

↓

Registry

↓

Provider

↓

READY
```

Sin reiniciar completamente el Framework.

---

# Relación con Application Services

Bootstrap nunca ejecuta casos de uso.

Los Application Services solo estarán disponibles cuando Bootstrap haya finalizado.

---

# Relación con CLI

La CLI siempre asumirá que Bootstrap ya terminó correctamente.

---

# Relación con Event System

Bootstrap inicializará el Event Dispatcher antes del estado READY.

Esto permitirá que los módulos registren listeners durante boot().

---

# Relación con Dependency Injection

Todo servicio deberá resolverse desde el Container.

Bootstrap nunca construirá objetos manualmente.

---

# Pruebas requeridas

El proceso deberá cubrir:

- arranque exitoso;
- configuración inválida;
- manifest inválido;
- provider inexistente;
- módulo duplicado;
- error durante boot();
- modo estricto;
- modo tolerante;
- bootstrap parcial;
- bootstrap incremental.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|------------|-----------------|
| Laravel | Inicializar la infraestructura |
| MEFServiceProvider | Registrar servicios |
| Container | Resolver dependencias |
| Kernel | Coordinar el arranque |
| Discovery | Localizar módulos |
| Validator | Validar manifests |
| Registry | Registrar módulos |
| Module Providers | Registrar servicios del módulo |
| Event System | Inicializar eventos |

---

# Decisiones arquitectónicas

1. Bootstrap será completamente determinista.
2. Todo servicio deberá registrarse antes de utilizarse.
3. Discovery ocurrirá antes del Registry.
4. Registry solo almacenará módulos válidos.
5. Los módulos registrarán servicios antes de ejecutar boot().
6. El Kernel mantendrá el estado del Framework.
7. Bootstrap no ejecutará lógica empresarial.
8. El contenedor será el único responsable de construir servicios.
9. El estado READY indicará que MEF puede atender solicitudes.
10. El proceso será observable y comprobable.

---

# Criterios de aceptación

ARQ-014 se considerará implementado cuando existan:

- Kernel Boot Sequence;
- Bootstrap Manager;
- estados del Kernel;
- integración con Discovery;
- integración con Registry;
- carga de configuración;
- registro automático de Providers;
- pruebas unitarias;
- pruebas de integración.

---

# Evolución prevista

Versiones futuras podrán incorporar:

- arranque paralelo;
- cache de bootstrap;
- compilación de módulos;
- lazy bootstrap;
- hot reload;
- bootstrap distribuido;
- multi-tenant bootstrap.

Estas capacidades deberán preservar el orden lógico definido en este documento.

---

# Conclusión

Bootstrap constituye el ciclo oficial de inicialización de MEF.

Coordina el registro de servicios, la carga de configuración, el descubrimiento de módulos y la preparación completa del Framework.

Laravel inicia.

Bootstrap coordina.

Discovery encuentra.

Registry registra.

Los módulos se preparan.

El Kernel declara el estado READY.