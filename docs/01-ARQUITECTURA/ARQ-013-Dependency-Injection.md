# ARQ-013 — Dependency Injection

## Estado

Aceptado.

---

# Objetivo

La inyección de dependencias constituye el mecanismo oficial mediante el cual MEF relaciona contratos, implementaciones y servicios durante la ejecución.

Su propósito es reducir el acoplamiento, centralizar la construcción de objetos y permitir que los componentes dependan de abstracciones en lugar de implementaciones concretas.

MEF utilizará el contenedor de servicios de Laravel como infraestructura de resolución de dependencias.

El Core definirá las reglas y convenciones para su uso.

---

# Motivación

Cuando una clase crea directamente sus dependencias, queda acoplada a implementaciones concretas.

Ejemplo no recomendado:

```php
final class CreateModuleService
{
    private ModuleBuilder $builder;

    public function __construct()
    {
        $this->builder = new ModuleBuilder(
            new DirectoryManager(),
            new JsonWriter(),
            new StubWriter(),
        );
    }
}
```

Este diseño produce:

- acoplamiento fuerte;
- construcción duplicada;
- pruebas más complejas;
- dificultad para sustituir implementaciones;
- dependencia de detalles internos;
- menor capacidad de evolución.

La inyección de dependencias permite delegar la construcción de objetos al contenedor.

---

# Principio fundamental

Los componentes de MEF deberán depender de contratos cuando exista más de una implementación posible, cuando la implementación pertenezca a infraestructura o cuando el desacoplamiento aporte valor real.

Ejemplo recomendado:

```php
final readonly class CreateModuleService
{
    public function __construct(
        private ModuleBuilderContract $builder,
    ) {
    }
}
```

El servicio conoce el comportamiento requerido.

No conoce cómo se construye la implementación.

---

# Responsabilidades del contenedor

El contenedor de dependencias será responsable de:

- registrar contratos;
- asociar contratos con implementaciones;
- construir objetos;
- resolver dependencias anidadas;
- administrar ciclos de vida;
- proporcionar fábricas;
- mantener instancias singleton;
- aplicar extensiones y decoradores cuando corresponda.

---

# Lo que el contenedor NO debe hacer

El contenedor no deberá utilizarse como:

- almacén global de variables;
- reemplazo de parámetros explícitos;
- mecanismo para ocultar dependencias;
- Service Locator dentro de clases del Core;
- sustituto de una arquitectura clara;
- fuente de lógica de negocio.

El uso indiscriminado de `app()` dentro de servicios estará prohibido salvo en adaptadores específicos o durante el proceso de bootstrap.

---

# Constructor Injection

La inyección por constructor será la estrategia predeterminada de MEF.

Ejemplo:

```php
final readonly class StubWriter
{
    public function __construct(
        private TemplateEngineContract $templates,
        private FileWriterContract $files,
    ) {
    }
}
```

Beneficios:

- dependencias visibles;
- objetos válidos desde su creación;
- mayor facilidad de pruebas;
- menor mutabilidad;
- mejor análisis estático.

---

# Method Injection

La inyección por método podrá utilizarse cuando una dependencia sea necesaria únicamente para una operación específica y el Framework que invoca el método controle su resolución.

Ejemplo típico:

```php
public function boot(
    MEFKernelContract $kernel
): void {
    $kernel->boot();
}
```

No deberá utilizarse para ocultar dependencias permanentes de una clase.

---

# Property Injection

La inyección directa de propiedades no será una estrategia aceptada en el Core.

Ejemplo no permitido:

```php
#[Inject]
public RegistryContract $registry;
```

Motivos:

- objetos incompletos durante la construcción;
- dependencias menos visibles;
- mayor dificultad para pruebas;
- mutabilidad innecesaria.

---

# Tipos de registro

MEF utilizará los siguientes tipos de registro.

## Binding transitorio

Se crea una instancia nueva cada vez que se resuelve el servicio.

Ejemplo conceptual:

```php
$this->app->bind(
    Contract::class,
    Implementation::class
);
```

Se utilizará para objetos con estado temporal o cuando compartir una instancia no aporte valor.

---

## Singleton

Se conserva una única instancia durante el ciclo de vida de la aplicación.

Ejemplo:

```php
$this->app->singleton(
    RegistryContract::class,
    ModuleRegistry::class
);
```

Se utilizará cuando:

- el servicio mantenga estado compartido;
- la identidad de la instancia sea relevante;
- la construcción sea costosa;
- el comportamiento deba ser consistente durante la ejecución.

---

## Scoped

Se conserva una instancia dentro de un alcance específico, como una solicitud o un proceso de trabajo.

Podrá utilizarse en futuras integraciones con:

- colas;
- workers persistentes;
- entornos multi-tenant;
- solicitudes HTTP.

Su incorporación deberá documentarse explícitamente.

---

## Instance

Registra una instancia ya construida.

Ejemplo:

```php
$this->app->instance(
    Configuration::class,
    $configuration
);
```

Se utilizará únicamente cuando la construcción externa esté justificada.

---

## Factory

Se utilizará una función de fábrica cuando la implementación requiera parámetros de configuración o una construcción no trivial.

Ejemplo:

```php
$this->app->singleton(
    ModuleBuilderContract::class,
    function ($app): ModuleBuilder {
        return new ModuleBuilder(
            directories: $app->make(
                DirectoryManager::class
            ),
            json: $app->make(
                JsonWriterContract::class
            ),
            stubs: $app->make(
                StubWriterContract::class
            ),
            gitKeep: $app->make(
                GitKeepGeneratorContract::class
            ),
            modulesPath: (string) config(
                'mef.modules.path'
            ),
            templatesPath: (string) config(
                'mef.templates.module_path'
            ),
        );
    }
);
```

La fábrica deberá permanecer dentro de un Service Provider o componente de bootstrap.

---

# Contratos

Los contratos representan los puntos oficiales de extensión de MEF.

Ejemplos:

```text
MEFKernelContract
RegistryContract
DiscoveryContract
ModuleBuilderContract
TemplateEngineContract
FileWriterContract
JsonWriterContract
StubWriterContract
GitKeepGeneratorContract
```

Un contrato deberá existir cuando:

- pueda haber múltiples implementaciones;
- se requiera sustituir infraestructura;
- represente una API pública del Core;
- facilite pruebas;
- constituya un punto de extensión.

---

# Cuándo NO crear un contrato

No todas las clases necesitan una interfaz.

No se creará un contrato cuando:

- solo exista una implementación estable;
- la clase sea un Value Object;
- no represente un punto de extensión;
- la abstracción no aporte desacoplamiento;
- solo duplique la API de una clase concreta.

MEF evitará interfaces ceremoniales sin valor arquitectónico.

---

# Organización de contratos

La estructura inicial será:

```text
app/
└── Core/
    ├── Contracts/
    │   ├── MEFKernelContract.php
    │   ├── RegistryContract.php
    │   ├── DiscoveryContract.php
    │   ├── ModuleBuilderContract.php
    │   ├── TemplateEngineContract.php
    │   ├── FileWriterContract.php
    │   ├── JsonWriterContract.php
    │   ├── StubWriterContract.php
    │   └── GitKeepGeneratorContract.php
    │
    └── Providers/
```

En versiones futuras los contratos podrán agruparse por componente:

```text
Contracts/
├── Builders/
├── Discovery/
├── FileSystem/
├── Kernel/
├── Registry/
└── Templates/
```

La reorganización no deberá alterar sus namespaces públicos sin una estrategia de compatibilidad.

---

# Service Providers

Los Service Providers serán responsables de registrar dependencias.

Ejemplo:

```php
final class MEFServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(
            MEFKernelContract::class,
            MEFKernel::class
        );

        $this->app->singleton(
            RegistryContract::class,
            ModuleRegistry::class
        );

        $this->app->bind(
            DiscoveryContract::class,
            ModuleDiscovery::class
        );
    }
}
```

El método `register()` deberá limitarse al registro de servicios.

La inicialización operativa pertenecerá a `boot()` o al Kernel, según corresponda.

---

# Registro modular

Cada módulo podrá registrar sus propias dependencias mediante su Service Provider.

Ejemplo:

```php
final class CRMServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            CustomerRepositoryContract::class,
            EloquentCustomerRepository::class
        );
    }
}
```

Los módulos no deberán registrar ni reemplazar servicios internos del Core sin utilizar un punto de extensión explícitamente autorizado.

---

# Dependencias entre capas

La dirección permitida será:

```text
Applications
        ↓
Modules
        ↓
Platform
        ↓
Core
        ↓
Foundation
```

El contenedor no deberá utilizarse para romper esta regla.

Que una clase pueda resolverse técnicamente no significa que la dependencia esté arquitectónicamente permitida.

---

# Service Locator

El siguiente patrón no será aceptado dentro de servicios del Core:

```php
final class ModuleService
{
    public function execute(): void
    {
        $registry = app(
            RegistryContract::class
        );
    }
}
```

La dependencia deberá declararse:

```php
final readonly class ModuleService
{
    public function __construct(
        private RegistryContract $registry
    ) {
    }
}
```

Excepciones limitadas:

- Service Providers;
- bootstrap;
- adaptadores del Framework;
- comandos heredados durante migraciones;
- factories controladas.

Toda excepción deberá ser evidente y justificable.

---

# Dependencias opcionales

Las dependencias opcionales deberán evitarse cuando provoquen objetos con comportamiento ambiguo.

Cuando sean necesarias podrán representarse mediante:

- Null Object;
- implementación predeterminada;
- contrato opcional explícito;
- configuración de capacidades.

Ejemplo:

```php
$this->app->bind(
    CacheContract::class,
    NullCache::class
);
```

Esto será preferible a propagar valores `null` en múltiples servicios.

---

# Decoradores

El contenedor podrá utilizarse para envolver implementaciones mediante decoradores.

Ejemplo conceptual:

```text
RegistryContract

        │

        ▼

CachedRegistry

        │

        ▼

ModuleRegistry
```

Los decoradores podrán añadir:

- cache;
- métricas;
- logs;
- auditoría;
- trazabilidad.

Deberán conservar el contrato original y no modificar semánticas inesperadamente.

---

# Aliases

Los aliases podrán utilizarse para compatibilidad temporal.

Ejemplo durante la transición de ERP a MEF:

```php
$this->app->alias(
    MEFKernelContract::class,
    ERPCompatibilityKernelContract::class
);
```

Los aliases de compatibilidad deberán:

- estar documentados;
- incluir una estrategia de retiro;
- evitar ciclos;
- no convertirse en una API permanente por accidente.

---

# Contextual Binding

El binding contextual podrá utilizarse cuando diferentes consumidores requieran implementaciones distintas del mismo contrato.

Ejemplo conceptual:

```php
$this->app
    ->when(LocalModuleDiscovery::class)
    ->needs(FilesystemContract::class)
    ->give(LocalFilesystem::class);
```

Su uso deberá ser excepcional porque puede dificultar la comprensión de la resolución de dependencias.

---

# Configuración

Los servicios configurables deberán recibir valores durante su construcción.

La configuración no deberá consultarse repetidamente mediante helpers globales dentro del servicio.

Ejemplo preferido:

```php
new ModuleDiscovery(
    paths: $configuredPaths,
    strictMode: $strictMode,
);
```

En lugar de:

```php
public function discover(): array
{
    $paths = config('mef.discovery.paths');
}
```

Esto mejora:

- pruebas;
- portabilidad;
- claridad;
- independencia de Laravel.

Durante las primeras versiones podrán aceptarse adaptadores de configuración mientras se completa la separación.

---

# Ciclos de dependencias

Los ciclos de dependencias no estarán permitidos.

Ejemplo inválido:

```text
Kernel
  ↓
Registry
  ↓
Discovery
  ↓
Kernel
```

Cuando aparezca un ciclo deberá revisarse el diseño mediante:

- extracción de un contrato;
- introducción de un Application Service;
- evento;
- inversión de dependencia;
- separación de responsabilidades.

El contenedor no deberá utilizarse para ocultar ciclos.

---

# Autowiring

MEF aprovechará la resolución automática de clases concretas proporcionada por Laravel cuando:

- las dependencias estén tipadas;
- no se requiera configuración especial;
- la clase no represente una API sustituible;
- el comportamiento sea inequívoco.

Ejemplo:

```php
final readonly class DirectoryManager
{
    public function __construct(
        private Filesystem $files
    ) {
    }
}
```

No será necesario registrar manualmente cada clase concreta.

---

# Resolución explícita

Los contratos deberán registrarse explícitamente.

Ejemplo:

```php
$this->app->singleton(
    JsonWriterContract::class,
    JsonWriter::class
);
```

Esto garantiza que el contenedor conozca qué implementación debe utilizar.

---

# Ciclos de vida recomendados

| Componente | Ciclo sugerido | Motivo |
|---|---|---|
| Kernel | Singleton | Coordina una ejecución |
| Registry | Singleton | Mantiene estado compartido |
| Discovery | Bind o singleton sin estado | Servicio determinista |
| Builders | Bind o singleton sin estado mutable | Coordinan construcción |
| Template Engine | Singleton sin estado | Renderizado reutilizable |
| FileWriter | Singleton sin estado mutable | Infraestructura compartida |
| Value Objects | Instancia normal | Representan valores |
| Application Services | Bind o autowiring | Ejecutan casos de uso |
| Commands | Administrado por Laravel | Adaptadores CLI |

La decisión definitiva dependerá del comportamiento real de cada implementación.

---

# Pruebas

La configuración del contenedor deberá cubrir:

- resolución de contratos;
- resolución de dependencias anidadas;
- singleton compartido;
- binding transitorio;
- factories;
- configuración faltante;
- implementación inexistente;
- ausencia de ciclos;
- aliases temporales;
- integración con Service Providers.

También deberán existir pruebas que confirmen que los servicios críticos pueden resolverse:

```php
app(MEFKernelContract::class);

app(RegistryContract::class);

app(ModuleBuilderContract::class);
```

---

# Errores

Los fallos de resolución deberán producir mensajes claros.

Ejemplos:

```text
MissingServiceBindingException
InvalidServiceConfigurationException
CircularDependencyException
ServiceResolutionException
```

Cuando Laravel produzca una excepción propia, MEF podrá traducirla únicamente si agrega contexto útil.

---

# Seguridad

El contenedor no deberá permitir que manifests o módulos no confiables definan bindings arbitrarios sin validación.

Los Service Providers cargados dinámicamente deberán:

- pertenecer a módulos validados;
- declarar una clase válida;
- respetar políticas de instalación;
- estar sujetos a controles de seguridad.

La resolución dinámica mediante nombres recibidos del usuario deberá evitarse.

---

# Rendimiento

Los registros del contenedor podrán compilarse o almacenarse en caché mediante las capacidades de Laravel.

Los Service Providers deberán ser compatibles con:

```bash
php artisan config:cache

php artisan optimize

php artisan package:discover
```

No deberán depender de operaciones que solo funcionen cuando la configuración no está cacheada.

---

# Compatibilidad

Durante la transición de la identidad `ERP` a `MEF`, podrán coexistir temporalmente:

```text
ERPKernelContract
MEFKernelContract

ERPServiceProvider
MEFServiceProvider
```

La estrategia preferida será:

1. crear los nombres nuevos;
2. mantener aliases o adaptadores;
3. marcar los nombres anteriores como obsoletos;
4. actualizar documentación;
5. retirar compatibilidad en una versión mayor.

No se deberán duplicar instancias del Kernel o Registry durante la transición.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|---|---|
| Contract | Definir comportamiento |
| Implementation | Ejecutar comportamiento |
| Service Provider | Registrar dependencias |
| Container | Construir y resolver objetos |
| Kernel | Coordinar el arranque |
| Application Service | Coordinar casos de uso |
| CLI / API / Web | Adaptar entradas y salidas |
| Module Provider | Registrar servicios del módulo |

---

# Decisiones arquitectónicas

1. MEF utilizará el contenedor de Laravel como implementación inicial.
2. La inyección por constructor será la estrategia predeterminada.
3. Los contratos se registrarán explícitamente.
4. Las clases concretas podrán resolverse mediante autowiring.
5. El patrón Service Locator estará prohibido dentro del Core.
6. Los Service Providers centralizarán los bindings.
7. Registry y Kernel utilizarán ciclo singleton.
8. La configuración se inyectará preferentemente durante la construcción.
9. El contenedor no podrá utilizarse para romper límites entre capas.
10. Los aliases de compatibilidad tendrán una estrategia de retiro.
11. Los ciclos de dependencias se resolverán mediante rediseño, no mediante ocultamiento.
12. No se crearán interfaces sin valor arquitectónico.

---

# Criterios de aceptación

ARQ-013 se considerará implementado cuando existan:

- contratos principales del Core;
- `MEFServiceProvider`;
- bindings documentados;
- ciclos de vida definidos;
- resolución correcta del Kernel;
- resolución correcta del Registry;
- resolución correcta de Discovery;
- resolución correcta de Builders;
- pruebas del contenedor;
- estrategia de compatibilidad ERP → MEF;
- ausencia de Service Locator en los servicios nuevos.

---

# Evolución prevista

En versiones futuras podrán incorporarse:

- contenedor independiente de Laravel;
- módulos de bindings compilados;
- decoradores automáticos;
- discovery de extensiones;
- scopes por tenant;
- scopes por módulo;
- resolución basada en capacidades;
- perfiles de ejecución;
- diagnóstico del contenedor mediante `mef:doctor`.

Estas capacidades no deberán romper los contratos públicos del Core.

---

# Conclusión

La inyección de dependencias constituye el mecanismo que conecta los componentes de MEF sin acoplarlos a implementaciones concretas.

Los contratos definen.

Los Service Providers registran.

El contenedor construye.

Los servicios consumen.

La arquitectura decide qué dependencias están permitidas.