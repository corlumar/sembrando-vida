# ARQ-012 — Application Services

## Estado

Aceptado.

---

# Objetivo

Los Application Services constituyen la capa encargada de coordinar los casos de uso de MEF.

Su propósito es recibir solicitudes provenientes de interfaces externas, validar la intención de la operación y orquestar los componentes del Core necesarios para completarla.

Los Application Services no contienen lógica de negocio empresarial.

Tampoco implementan detalles técnicos de infraestructura.

Coordinan casos de uso del Framework.

---

# Motivación

MEF podrá ser utilizado desde diferentes interfaces:

- CLI;
- API REST;
- interfaz web;
- instalador gráfico;
- procesos automatizados;
- integraciones externas.

Si cada interfaz invocara directamente Builders, Registry, Discovery o FileSystem, se producirían:

- duplicación de lógica;
- acoplamiento;
- flujos inconsistentes;
- mayor dificultad para probar;
- dependencia excesiva de la CLI.

Por ello, MEF incorporará una capa de Application Services reutilizable por cualquier interfaz.

---

# Posición arquitectónica

```text
Interfaces

├── CLI
├── API
├── Web
└── Automation

        │

        ▼

Application Services

        │

        ▼

Core Services

├── Builders
├── Discovery
├── Registry
├── Validators
└── Installers
```

Las interfaces dependen de los Application Services.

Los Application Services dependen de contratos del Core.

El Core no depende de las interfaces.

---

# Responsabilidades

Los Application Services son responsables de:

- representar casos de uso;
- coordinar servicios del Core;
- definir el orden de ejecución;
- convertir resultados internos en respuestas utilizables;
- controlar transacciones cuando corresponda;
- propagar o transformar errores de aplicación;
- mantener consistencia entre diferentes interfaces.

---

# Lo que NO deben hacer

Los Application Services nunca deberán:

- renderizar vistas;
- imprimir mensajes en consola;
- acceder directamente a HTTP;
- escribir archivos sin utilizar abstracciones;
- ejecutar consultas empresariales;
- contener reglas específicas de módulos;
- depender de implementaciones concretas cuando exista un contrato;
- reemplazar las responsabilidades de Builders, Registry o Discovery.

---

# Diferencia entre Application Service y Core Service

## Application Service

Representa un caso de uso completo.

Ejemplos:

- crear un módulo;
- descubrir módulos;
- validar un módulo;
- instalar un módulo;
- habilitar un módulo.

Coordina varios componentes.

---

## Core Service

Ejecuta una responsabilidad técnica específica.

Ejemplos:

- Discovery localiza módulos;
- Registry almacena metadatos;
- ModuleBuilder construye estructuras;
- ManifestValidator valida manifests;
- Template Engine renderiza plantillas.

No coordina una operación completa por sí mismo.

---

# Ejemplo: creación de un módulo

```text
CLI

    │

    ▼

CreateModuleService

    │

    ├── valida ModuleName
    ├── consulta existencia
    ├── invoca ModuleBuilder
    ├── ejecuta validación posterior
    └── devuelve resultado

    │

    ▼

ModuleBuilder

    │

    ▼

FileSystem
```

La CLI no necesita conocer el flujo interno.

---

# Ejemplo conceptual

```php
final readonly class CreateModuleService
{
    public function __construct(
        private ModuleBuilderContract $builder,
    ) {
    }

    public function execute(
        CreateModuleRequest $request
    ): CreateModuleResult {
        $path = $this->builder->build(
            name: $request->name,
            overwrite: $request->overwrite,
        );

        return new CreateModuleResult(
            moduleName: $request->name,
            path: $path,
        );
    }
}
```

El ejemplo es conceptual.

La API definitiva se definirá durante la implementación.

---

# Requests y Results

Los Application Services podrán recibir objetos de entrada específicos.

Ejemplo:

```text
CreateModuleRequest
InstallModuleRequest
DiscoverModulesRequest
ValidateModuleRequest
```

Y devolver objetos de resultado:

```text
CreateModuleResult
InstallModuleResult
DiscoverModulesResult
ValidateModuleResult
```

Estos objetos deberán:

- ser inmutables;
- contener únicamente los datos necesarios;
- evitar dependencia de CLI, HTTP o vistas;
- ser fáciles de probar.

---

# Value Objects

Las solicitudes deberán utilizar Value Objects para conceptos relevantes.

Ejemplo:

```php
new CreateModuleRequest(
    name: new ModuleName('CRM'),
    overwrite: false,
);
```

Los Application Services no deberán recibir valores ambiguos cuando exista un Value Object definido.

---

# Servicios iniciales

La primera versión de MEF podrá incluir:

## CreateModuleService

Coordina la creación de módulos.

---

## DiscoverModulesService

Ejecuta Discovery y devuelve módulos encontrados.

---

## RegisterModulesService

Registra una colección de metadatos en Registry.

---

## ValidateModuleService

Coordina la validación estructural de un módulo.

---

## ListModulesService

Consulta Registry y devuelve módulos disponibles.

---

## InstallModuleService

Coordina el proceso de instalación.

Su implementación completa corresponde a una versión posterior.

---

# Relación con CLI

La CLI será un adaptador.

Ejemplo:

```text
mef:make-module CRM

        │

        ▼

MakeModuleCommand

        │

        ▼

CreateModuleService

        │

        ▼

CreateModuleResult

        │

        ▼

Salida en consola
```

El comando únicamente:

- obtiene argumentos;
- crea la solicitud;
- ejecuta el servicio;
- presenta el resultado;
- traduce excepciones a mensajes y códigos de salida.

---

# Relación con API

Una futura API utilizará el mismo servicio:

```text
HTTP Request

    │

    ▼

Controller

    │

    ▼

CreateModuleService

    │

    ▼

CreateModuleResult

    │

    ▼

JSON Response
```

La lógica del caso de uso no se duplica.

---

# Relación con Builders

Los Application Services pueden utilizar Builders mediante contratos.

```text
Application Service

        │

        ▼

Builder Contract

        │

        ▼

Builder Implementation
```

El Application Service no debe conocer cómo se generan los archivos.

---

# Relación con Registry y Discovery

Un servicio puede coordinar ambos componentes.

Ejemplo:

```text
DiscoverModulesService

        │

        ├── Discovery
        │
        └── Registry

        ▼

Resultado
```

La coordinación deberá respetar la separación definida en ARQ-006 y ARQ-007:

- Discovery encuentra;
- Registry almacena;
- Application Service coordina.

---

# Manejo de errores

Los Application Services podrán propagar excepciones específicas del Core o traducirlas a errores propios de aplicación.

Ejemplos:

```text
ModuleAlreadyExistsException
ModuleNotFoundException
ModuleValidationException
ApplicationServiceException
```

Las interfaces serán responsables de convertir esos errores en:

- mensajes de consola;
- respuestas HTTP;
- eventos;
- registros de auditoría.

---

# Transacciones

Cuando un caso de uso incluya múltiples operaciones que deban completarse de forma atómica, el Application Service coordinará la transacción mediante una abstracción.

Ejemplo futuro:

```text
Instalar módulo

├── copiar archivos;
├── registrar metadata;
├── ejecutar migraciones;
└── habilitar módulo.
```

Si una operación falla, el servicio deberá aplicar una estrategia de reversión.

La implementación no deberá quedar acoplada directamente a una base de datos concreta.

---

# Idempotencia

Los Application Services deberán definir explícitamente si una operación es idempotente.

Ejemplos:

- listar módulos: idempotente;
- descubrir módulos: idempotente;
- validar módulo: idempotente;
- crear módulo: no idempotente sin política de sobrescritura;
- habilitar módulo: idempotente si ya está habilitado.

---

# Organización del código

La estructura propuesta es:

```text
app/
└── Core/
    └── Application/
        ├── Contracts/
        ├── Requests/
        ├── Results/
        └── Services/
            ├── CreateModuleService.php
            ├── DiscoverModulesService.php
            ├── RegisterModulesService.php
            ├── ValidateModuleService.php
            └── ListModulesService.php
```

La organización podrá evolucionar hacia casos de uso individuales:

```text
Application/
└── Modules/
    ├── Create/
    ├── Discover/
    ├── Register/
    ├── Validate/
    └── List/
```

Cualquier cambio estructural deberá conservar la separación de responsabilidades.

---

# Dependencias permitidas

Los Application Services pueden depender de:

- contratos del Core;
- Value Objects;
- Builders mediante contrato;
- Registry mediante contrato;
- Discovery mediante contrato;
- Validators;
- Requests;
- Results;
- excepciones del Core.

No pueden depender de:

- comandos Artisan;
- controladores HTTP;
- vistas;
- módulos empresariales;
- aplicaciones concretas;
- implementaciones de infraestructura sin abstracción.

---

# Pruebas requeridas

Cada Application Service deberá cubrir:

- caso exitoso;
- entradas inválidas;
- errores de componentes dependientes;
- orden correcto de coordinación;
- resultado esperado;
- idempotencia cuando aplique;
- ausencia de efectos secundarios no autorizados.

Las pruebas deberán utilizar dobles o mocks de los contratos cuando sea apropiado.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|---|---|
| CLI / API / Web | Recibir y presentar solicitudes |
| Application Service | Coordinar el caso de uso |
| Value Objects | Validar conceptos |
| Builder | Construir artefactos |
| Discovery | Encontrar módulos |
| Registry | Mantener módulos registrados |
| Validator | Validar estructura y metadatos |
| FileSystem | Ejecutar operaciones de archivos |

---

# Decisiones arquitectónicas

1. Las interfaces no invocarán directamente componentes complejos del Core cuando exista un caso de uso.
2. Los Application Services representarán operaciones completas del Framework.
3. Los servicios serán independientes de CLI, HTTP y vistas.
4. Los datos de entrada y salida se representarán mediante objetos inmutables.
5. Los Application Services dependerán de contratos.
6. La lógica específica seguirá perteneciendo al componente especializado.
7. La capa permitirá reutilizar los mismos casos de uso desde múltiples interfaces.

---

# Criterios de aceptación

ARQ-012 se considerará implementado cuando existan:

- estructura `Core/Application`;
- al menos un Application Service funcional;
- objetos Request y Result;
- integración con CLI;
- dependencia mediante contratos;
- pruebas unitarias;
- documentación de la API pública.

El primer caso de uso recomendado será:

```text
CreateModuleService
```

---

# Evolución prevista

En versiones posteriores podrán incorporarse:

- InstallModuleService;
- UpdateModuleService;
- EnableModuleService;
- DisableModuleService;
- RemoveModuleService;
- PublishModuleResourcesService;
- ResolveDependenciesService;
- MarketplaceSearchService.

Cada servicio deberá representar un caso de uso claramente definido.

---

# Conclusión

Los Application Services constituyen la capa de coordinación de casos de uso de MEF.

Permiten que CLI, API, Web y automatizaciones utilicen el mismo comportamiento sin duplicar lógica.

Las interfaces reciben solicitudes.

Los Application Services coordinan.

Los componentes del Core ejecutan.

La infraestructura materializa los cambios.