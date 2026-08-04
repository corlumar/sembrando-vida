# ARQ-015 — Service Providers

## Estado

Aceptado.

---

# Objetivo

Los Service Providers son los componentes responsables de registrar, configurar e inicializar servicios dentro del contenedor de MEF.

Constituyen el punto de integración entre Laravel, el Core, Platform y los módulos.

Su función principal es declarar cómo deben construirse y resolverse los componentes del Framework.

Los Service Providers registran servicios.

No implementan casos de uso.

No contienen lógica de negocio.

No sustituyen al Kernel.

---

# Motivación

MEF necesita un mecanismo consistente para:

- registrar contratos e implementaciones;
- configurar ciclos de vida;
- cargar recursos;
- registrar comandos;
- incorporar módulos;
- ejecutar inicialización posterior al registro;
- mantener integración con Laravel.

Laravel proporciona Service Providers como mecanismo nativo para estas tareas.

MEF adoptará ese mecanismo y establecerá reglas estrictas para evitar que los Providers se conviertan en clases con responsabilidades excesivas.

---

# Principio fundamental

Un Service Provider debe responder únicamente a estas preguntas:

1. ¿Qué servicios deben registrarse?
2. ¿Qué componentes deben inicializarse después del registro?
3. ¿Qué recursos pertenecientes al proveedor deben cargarse?

No deberá responder:

- cómo funciona un caso de uso;
- cómo se construye un módulo;
- cómo se descubre un módulo;
- cómo se resuelve una regla de negocio.

---

# Tipos de Service Providers

MEF distinguirá inicialmente cuatro tipos de Providers.

## MEF Core Provider

Registra los servicios fundamentales del Framework.

Ejemplos:

- Kernel;
- Registry;
- Discovery;
- Builders;
- Template Engine;
- FileSystem;
- Application Services;
- comandos principales.

Nombre previsto:

```text
MEFServiceProvider
```

Durante la transición podrá coexistir temporalmente con:

```text
ERPServiceProvider
```

---

## Platform Provider

Registra servicios compartidos de Platform.

Ejemplos:

- AuthenticationServiceProvider;
- AuthorizationServiceProvider;
- NotificationServiceProvider;
- WorkflowServiceProvider;
- AuditServiceProvider.

Platform depende del Core.

Sus Providers no deberán registrar lógica propia de módulos empresariales.

---

## Module Provider

Registra los componentes internos de un módulo.

Ejemplos:

```text
CRMServiceProvider
OrganizacionServiceProvider
InventariosServiceProvider
```

Podrá registrar:

- repositorios;
- servicios de dominio;
- casos de uso;
- eventos;
- rutas;
- migraciones;
- vistas;
- traducciones;
- comandos propios.

No podrá modificar servicios internos del Core salvo mediante un punto de extensión autorizado.

---

## Compatibility Provider

Provider temporal utilizado durante migraciones o cambios de API.

Ejemplo:

```text
ERPCompatibilityServiceProvider
```

Su uso deberá:

- estar documentado;
- incluir fecha o versión de retiro;
- evitar duplicar instancias;
- mantenerse pequeño;
- no adquirir nuevas responsabilidades.

---

# Ciclo de vida

Los Service Providers de Laravel utilizan principalmente dos etapas:

```text
register()

↓

boot()
```

MEF conservará esta separación.

---

# Método register()

`register()` es responsable de declarar servicios en el contenedor.

Ejemplo:

```php
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
```

Durante `register()` se permite:

- registrar bindings;
- registrar singletons;
- registrar factories;
- combinar configuración;
- registrar aliases;
- registrar Providers subordinados.

Durante `register()` no se permite:

- ejecutar Discovery;
- consultar módulos;
- ejecutar migraciones;
- emitir eventos de negocio;
- acceder a servicios todavía no garantizados;
- realizar operaciones de archivos;
- iniciar casos de uso.

---

# Método boot()

`boot()` se ejecuta después de registrar los Providers.

Podrá utilizarse para:

- iniciar el Kernel;
- registrar comandos;
- cargar rutas;
- cargar vistas;
- cargar traducciones;
- cargar migraciones;
- publicar configuración y recursos;
- registrar listeners;
- ejecutar inicialización controlada.

Ejemplo:

```php
public function boot(
    MEFKernelContract $kernel
): void {
    $kernel->boot();
}
```

`boot()` no deberá convertirse en un contenedor de procesos complejos.

Cuando una operación requiera coordinación significativa deberá delegarse a:

- Kernel;
- Bootstrap Manager;
- Application Service;
- servicio especializado.

---

# Orden de registro

El orden conceptual será:

```text
Laravel Providers

        │

        ▼

MEF Core Provider

        │

        ▼

Platform Providers

        │

        ▼

Module Providers

        │

        ▼

Application Providers
```

Las capas inferiores no deberán depender de Providers pertenecientes a capas superiores.

---

# Flujo general

```text
Laravel inicia

    │

    ▼

Carga MEFServiceProvider

    │

    ├── mergeConfigFrom()
    ├── registra Contracts
    ├── registra servicios
    ├── registra Kernel
    └── registra comandos

    │

    ▼

Laravel ejecuta boot()

    │

    ▼

MEFKernel::boot()

    │

    ▼

Discovery y Registry

    │

    ▼

Module Service Providers

    │

    ▼

Framework READY
```

La incorporación dinámica de Providers de módulos deberá realizarse de manera controlada por el Bootstrap de MEF.

---

# MEFServiceProvider

El Provider principal deberá permanecer pequeño y legible.

Ejemplo conceptual:

```php
final class MEFServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfiguration();
        $this->registerKernel();
        $this->registerRegistry();
        $this->registerDiscovery();
        $this->registerFileSystem();
        $this->registerBuilders();
        $this->registerApplicationServices();
    }

    public function boot(
        MEFKernelContract $kernel
    ): void {
        $kernel->boot();
    }
}
```

La división en métodos privados podrá utilizarse para mejorar la legibilidad.

Cuando el Provider crezca demasiado deberán extraerse Providers especializados.

---

# Providers especializados

El Core podrá dividir sus registros en Providers internos.

Ejemplo:

```text
Providers/
├── MEFServiceProvider.php
├── KernelServiceProvider.php
├── RegistryServiceProvider.php
├── DiscoveryServiceProvider.php
├── FileSystemServiceProvider.php
├── BuilderServiceProvider.php
└── ConsoleServiceProvider.php
```

`MEFServiceProvider` podrá registrar estos Providers.

Esta estrategia deberá utilizarse cuando:

- el Provider principal pierda claridad;
- existan grupos cohesivos de bindings;
- los servicios tengan ciclos de vida diferentes;
- sea necesario habilitar capacidades opcionales.

No deberá fragmentarse el registro sin necesidad.

---

# Configuración

El Provider principal será responsable de incorporar la configuración de MEF.

Ejemplo:

```php
$this->mergeConfigFrom(
    __DIR__.'/../../../config/mef.php',
    'mef'
);
```

La transición desde:

```text
config/erp.php
```

hacia:

```text
config/mef.php
```

deberá mantener compatibilidad temporal.

La configuración cacheada deberá funcionar correctamente.

---

# Registro de comandos

Los comandos de MEF se registrarán mediante un Provider especializado o durante `boot()` cuando la aplicación se ejecute en consola.

Ejemplo:

```php
if ($this->app->runningInConsole()) {
    $this->commands([
        MEFStatusCommand::class,
        MEFMakeModuleCommand::class,
    ]);
}
```

Los comandos no deberán registrarse innecesariamente en contextos donde no puedan ejecutarse.

---

# Carga de recursos

Los Providers de módulos podrán cargar recursos propios.

## Rutas

```php
$this->loadRoutesFrom(
    __DIR__.'/../Presentation/Routes/web.php'
);
```

## Migraciones

```php
$this->loadMigrationsFrom(
    __DIR__.'/../Infrastructure/Database/Migrations'
);
```

## Vistas

```php
$this->loadViewsFrom(
    __DIR__.'/../Presentation/Views',
    'crm'
);
```

## Traducciones

```php
$this->loadTranslationsFrom(
    __DIR__.'/../Resources/Lang',
    'crm'
);
```

Cada recurso deberá permanecer dentro del módulo que lo posee.

---

# Publicación de recursos

Los Providers podrán definir recursos publicables para aplicaciones consumidoras.

Ejemplo:

```php
$this->publishes([
    __DIR__.'/../../../config/mef.php'
        => config_path('mef.php'),
], 'mef-config');
```

Los tags deberán seguir una convención consistente:

```text
mef-config
mef-assets
mef-migrations
mef-views
module-crm-config
```

---

# Registro de módulos

Un Module Provider no deberá agregarse manualmente en:

```text
bootstrap/providers.php
```

cuando el mecanismo de Discovery esté habilitado.

El flujo previsto será:

```text
module.json

    │

    ▼

Discovery

    │

    ▼

Validación del provider

    │

    ▼

Registro controlado

    │

    ▼

boot()
```

Esto evita configuración manual y mantiene la modularidad.

---

# Manifest y Provider

Cada módulo declarará su Provider en `module.json`.

Ejemplo:

```json
{
  "name": "CRM",
  "slug": "crm",
  "version": "1.0.0",
  "provider": "App\\Modules\\CRM\\Providers\\CRMServiceProvider"
}
```

Antes de registrar el Provider se deberá validar:

- que el valor exista;
- que tenga formato de clase válido;
- que la clase pueda cargarse;
- que extienda el tipo permitido;
- que pertenezca al módulo esperado;
- que el módulo esté habilitado.

---

# Seguridad

Registrar dinámicamente un Provider implica ejecutar código.

Por ello, MEF deberá tratar esta operación como sensible.

No se registrarán Providers provenientes de manifests:

- inválidos;
- no confiables;
- incompatibles;
- deshabilitados;
- fuera de rutas autorizadas.

En versiones futuras podrán incorporarse:

- firmas;
- checksums;
- listas de confianza;
- validación de paquetes;
- políticas de Marketplace.

---

# Dependencias entre módulos

Los Module Providers no deberán resolver dependencias entre módulos por sí mismos.

Ejemplo no recomendado:

```php
public function register(): void
{
    $this->app->register(
        InventariosServiceProvider::class
    );
}
```

Las dependencias deberán:

1. declararse en el manifest;
2. validarse mediante Dependency Resolver;
3. ordenarse durante Bootstrap;
4. registrarse de forma centralizada.

Esto evita dependencias ocultas y ciclos difíciles de detectar.

---

# Orden de Providers de módulos

Los Providers deberán registrarse respetando sus dependencias.

Ejemplo:

```text
Organización

    ↓

Usuarios

    ↓

CRM
```

Si CRM depende de Organización, el Provider de Organización deberá registrarse primero.

El orden no se decidirá alfabéticamente, sino mediante resolución de dependencias.

---

# Idempotencia

El registro de Providers deberá ser idempotente dentro de una misma ejecución.

Un Provider no deberá registrarse dos veces.

El Kernel o Bootstrap Manager deberá mantener control sobre:

- Providers pendientes;
- Providers registrados;
- Providers iniciados;
- Providers fallidos.

---

# Errores

Se utilizarán excepciones específicas.

Ejemplos:

```text
ServiceProviderNotFoundException
InvalidServiceProviderException
ServiceProviderRegistrationException
ServiceProviderBootException
DuplicateServiceProviderException
UntrustedServiceProviderException
```

Las excepciones deberán incluir contexto suficiente:

- módulo;
- provider;
- etapa;
- causa anterior.

---

# Observabilidad

El proceso de registro deberá ser observable.

MEF podrá registrar:

- inicio de registro;
- Provider cargado;
- duración;
- Provider iniciado;
- error;
- módulo relacionado.

La observabilidad no deberá exponer secretos ni datos sensibles.

---

# Rendimiento

Los Providers deberán evitar operaciones costosas durante `register()` y `boot()`.

No deberán realizar:

- consultas masivas;
- escaneo repetido de directorios;
- llamadas remotas;
- tareas de larga duración;
- procesamiento empresarial.

Estas operaciones deberán diferirse a:

- Jobs;
- Application Services;
- comandos;
- procesos en segundo plano.

---

# Providers diferidos

MEF podrá evaluar Providers diferidos para servicios opcionales o costosos.

Su adopción dependerá de las capacidades vigentes de Laravel y deberá documentarse antes de utilizarse.

La optimización no deberá comprometer la claridad del Bootstrap.

---

# Compatibilidad ERP → MEF

Durante la transición podrán coexistir:

```text
ERPServiceProvider
MEFServiceProvider
```

La estrategia recomendada será:

1. crear `MEFServiceProvider`;
2. mover los bindings principales;
3. convertir `ERPServiceProvider` en adaptador temporal;
4. evitar registrar ambos Providers como núcleos independientes;
5. marcar el Provider anterior como obsoleto;
6. retirarlo en una versión mayor.

Ejemplo conceptual:

```php
final class ERPServiceProvider
    extends MEFServiceProvider
{
}
```

Si la herencia genera restricciones, se utilizará delegación o alias de compatibilidad.

---

# Ubicación en el código

La estructura propuesta es:

```text
app/
└── Core/
    └── Providers/
        ├── MEFServiceProvider.php
        ├── KernelServiceProvider.php
        ├── RegistryServiceProvider.php
        ├── DiscoveryServiceProvider.php
        ├── FileSystemServiceProvider.php
        ├── BuilderServiceProvider.php
        └── ConsoleServiceProvider.php
```

Los Providers de Platform vivirán dentro de sus respectivos componentes.

```text
app/
└── Platform/
    └── Notifications/
        └── Providers/
            └── NotificationServiceProvider.php
```

Los Providers de módulos permanecerán dentro del módulo.

---

# Pruebas requeridas

La implementación deberá cubrir:

- registro del Provider principal;
- resolución de contratos;
- ejecución de `boot()`;
- carga de configuración;
- carga con configuración cacheada;
- registro de comandos;
- Provider de módulo válido;
- Provider inexistente;
- Provider inválido;
- Provider duplicado;
- error durante `register()`;
- error durante `boot()`;
- orden por dependencias;
- compatibilidad temporal ERP → MEF.

Las pruebas deberán evitar modificar permanentemente el estado global de la aplicación.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|---|---|
| Service Provider | Declarar y cargar servicios |
| Container | Construir y resolver objetos |
| Kernel | Coordinar el Framework |
| Bootstrap Manager | Ejecutar el orden de arranque |
| Discovery | Encontrar Providers declarados |
| Manifest Validator | Validar metadatos |
| Dependency Resolver | Ordenar módulos |
| Module Provider | Registrar recursos del módulo |
| Application Service | Ejecutar casos de uso |

---

# Decisiones arquitectónicas

1. MEF utilizará Service Providers de Laravel como mecanismo inicial de integración.
2. `register()` declarará servicios y no ejecutará lógica operativa.
3. `boot()` delegará procesos complejos al Kernel o servicios especializados.
4. Existirá un Provider principal del Core.
5. Podrán existir Providers especializados por componente.
6. Los Module Providers serán descubiertos mediante manifests.
7. Los Providers de módulos no registrarán directamente otros módulos.
8. El orden de Providers respetará dependencias declaradas.
9. El registro dinámico estará sujeto a validación y seguridad.
10. Los Providers deberán ser pequeños, cohesivos y comprobables.
11. La transición ERP → MEF mantendrá una estrategia explícita de compatibilidad.
12. La configuración cacheada deberá ser compatible con todos los Providers.

---

# Criterios de aceptación

ARQ-015 se considerará implementado cuando existan:

- `MEFServiceProvider`;
- bindings principales del Core;
- separación clara entre `register()` y `boot()`;
- registro de comandos MEF;
- carga de configuración `mef`;
- registro controlado de Module Providers;
- validación de Providers declarados;
- prevención de duplicados;
- pruebas unitarias;
- pruebas de integración;
- estrategia ERP → MEF documentada y funcional.

---

# Evolución prevista

En versiones futuras podrán incorporarse:

- Providers por capacidad;
- Providers compilados;
- carga diferida;
- cache de Providers;
- perfiles de Bootstrap;
- registro por tenant;
- sandbox de extensiones;
- firma y confianza de módulos;
- diagnóstico mediante `mef:doctor`.

Estas capacidades deberán mantener la separación entre registro, inicialización y ejecución.

---

# Conclusión

Los Service Providers constituyen el mecanismo oficial para incorporar servicios y recursos a MEF.

Los contratos definen el comportamiento.

Los Providers registran las implementaciones.

El contenedor construye los servicios.

El Kernel coordina su inicialización.

Los módulos aportan sus capacidades sin modificar el Core.