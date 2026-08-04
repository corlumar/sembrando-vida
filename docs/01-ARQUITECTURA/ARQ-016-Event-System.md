# ARQ-016 — Event System

## Estado

Aceptado.

---

# Objetivo

El Event System es el mecanismo oficial de MEF para comunicar hechos relevantes entre componentes sin introducir dependencias directas.

Su propósito es permitir que Core, Platform, módulos y aplicaciones reaccionen a sucesos del Framework mediante eventos y listeners desacoplados.

Un evento representa algo que ya ocurrió.

Un listener reacciona a ese hecho.

El emisor no necesita conocer quién consumirá el evento.

---

# Motivación

En una arquitectura modular, las dependencias directas entre módulos dificultan:

- la instalación independiente;
- la sustitución de componentes;
- las pruebas aisladas;
- la evolución del sistema;
- la eliminación de módulos;
- la reutilización.

Ejemplo no recomendado:

```php
final readonly class CustomerService
{
    public function __construct(
        private InventoryService $inventory,
        private NotificationService $notifications,
        private AuditService $audit,
    ) {
    }
}
```

Este diseño obliga al componente emisor a conocer todas las reacciones posteriores.

El Event System permite sustituir esa relación por:

```text
CustomerCreated

        │

        ├── Inventory Listener
        ├── Notification Listener
        └── Audit Listener
```

El emisor publica un hecho.

Los consumidores deciden cómo reaccionar.

---

# Principios

El Event System deberá cumplir los siguientes principios:

- bajo acoplamiento;
- eventos inmutables;
- nombres explícitos;
- comportamiento observable;
- listeners independientes;
- errores controlados;
- ejecución predecible;
- compatibilidad con pruebas;
- independencia respecto de interfaces externas.

---

# Responsabilidades

El Event System es responsable de:

- publicar eventos;
- registrar listeners;
- distribuir eventos;
- ejecutar listeners;
- controlar errores de entrega;
- proporcionar trazabilidad;
- permitir ejecución síncrona o asíncrona;
- evitar dependencias directas entre emisores y consumidores.

---

# Lo que el Event System NO debe hacer

El Event System nunca deberá:

- sustituir todos los llamados directos;
- ocultar flujos que requieren respuesta inmediata;
- contener lógica de negocio;
- modificar eventos después de publicarlos;
- asumir que todos los listeners tendrán éxito;
- utilizarse para evitar diseñar contratos adecuados;
- convertirse en un mecanismo global sin límites;
- introducir dependencias circulares ocultas.

---

# Definición de evento

Un evento representa un hecho relevante que ya ocurrió.

Los nombres deberán utilizar tiempo pasado.

Ejemplos recomendados:

```text
ModuleDiscovered
ModuleRegistered
ModuleEnabled
ModuleDisabled
ModuleInstalled
ModuleRemoved
FrameworkBooted
FrameworkReady
BootstrapFailed
```

Ejemplos no recomendados:

```text
DiscoverModule
RegisterModule
EnableModule
SendNotification
```

Los últimos nombres representan órdenes o acciones, no hechos.

---

# Eventos y comandos

MEF distinguirá entre comandos y eventos.

## Comando

Expresa una intención.

Ejemplo:

```text
CreateModule
EnableModule
InstallModule
```

Puede rechazarse.

Normalmente tiene un destinatario principal.

---

## Evento

Expresa un hecho consumado.

Ejemplo:

```text
ModuleCreated
ModuleEnabled
ModuleInstalled
```

Puede tener cero, uno o múltiples listeners.

No debe representar una solicitud.

---

# Modelo conceptual

```text
Emisor

    │

    ▼

Evento inmutable

    │

    ▼

Event Dispatcher

    │

    ├── Listener A
    ├── Listener B
    └── Listener C
```

El emisor no conoce los listeners.

---

# Componentes principales

## Event

Objeto inmutable que contiene los datos necesarios para describir un hecho.

---

## Event Dispatcher

Servicio encargado de distribuir un evento a sus listeners registrados.

---

## Listener

Componente que reacciona a un evento.

---

## Event Subscriber

Componente que declara varios eventos y sus respectivos métodos consumidores.

Su uso será opcional y deberá justificarse cuando agrupe reacciones relacionadas.

---

## Event Registry

Catálogo interno de eventos y listeners registrados.

No deberá confundirse con el Module Registry.

---

## Event Envelope

Contenedor opcional que podrá añadir metadatos técnicos al evento sin contaminar su contenido.

Ejemplos:

- identificador;
- fecha;
- correlación;
- causalidad;
- origen;
- versión;
- tenant;
- usuario técnico.

---

# Tipos de eventos

MEF distinguirá inicialmente tres categorías.

## Eventos del Framework

Describen hechos internos del Core.

Ejemplos:

```text
FrameworkBooting
FrameworkBooted
FrameworkReady
BootstrapFailed
```

---

## Eventos del ciclo de vida de módulos

Describen cambios relacionados con módulos.

Ejemplos:

```text
ModuleDiscovered
ModuleValidated
ModuleRegistered
ModuleBooted
ModuleEnabled
ModuleDisabled
ModuleInstalled
ModuleUpdated
ModuleRemoved
```

---

## Eventos de negocio

Describen hechos pertenecientes a módulos empresariales.

Ejemplos:

```text
CustomerCreated
InventoryAdjusted
PurchaseApproved
EmployeeHired
```

Los eventos de negocio pertenecerán al módulo que posee el concepto.

No pertenecerán al Core.

---

# Eventos internos y públicos

## Evento interno

Solo forma parte de la implementación de un componente.

Puede cambiar sin considerarse API pública, siempre que no sea consumido externamente.

---

## Evento público

Constituye un punto oficial de extensión.

Deberá contar con:

- nombre estable;
- documentación;
- versión;
- esquema definido;
- estrategia de compatibilidad.

Los módulos de terceros podrán consumir eventos públicos.

---

# Inmutabilidad

Los eventos deberán ser inmutables.

La implementación recomendada utilizará clases `final readonly`.

Ejemplo:

```php
final readonly class ModuleRegistered
{
    public function __construct(
        public ModuleMetadata $module,
        public DateTimeImmutable $occurredAt,
    ) {
    }
}
```

No se permitirán setters.

Los listeners no podrán modificar el evento recibido.

---

# Datos del evento

Un evento deberá contener únicamente información necesaria para describir el hecho.

Ejemplo recomendado:

```php
final readonly class ModuleEnabled
{
    public function __construct(
        public ModuleId $moduleId,
        public ModuleVersion $version,
        public DateTimeImmutable $occurredAt,
    ) {
    }
}
```

No deberá contener:

- servicios;
- repositorios;
- objetos del contenedor;
- conexiones;
- requests HTTP;
- comandos Artisan;
- closures;
- recursos no serializables.

---

# Value Objects

Los eventos deberán utilizar Value Objects para conceptos relevantes.

Ejemplo:

```php
new ModuleEnabled(
    moduleId: new ModuleId('crm'),
    version: ModuleVersion::fromString('1.0.0'),
    occurredAt: new DateTimeImmutable(),
);
```

Esto evita transportar datos ambiguos.

---

# Tiempo del evento

Todo evento relevante deberá registrar cuándo ocurrió.

Se utilizará:

```php
DateTimeImmutable
```

La fecha deberá representar la ocurrencia del hecho, no necesariamente el momento de procesamiento del listener.

---

# Identificador del evento

Los eventos públicos o persistentes podrán incluir un identificador único.

Ejemplo:

```text
EventId
```

Este identificador facilitará:

- deduplicación;
- trazabilidad;
- reintentos;
- auditoría;
- integración distribuida.

En la primera versión podrá ser opcional para eventos exclusivamente internos y síncronos.

---

# Correlación y causalidad

En versiones posteriores podrán utilizarse:

```text
CorrelationId
CausationId
```

## CorrelationId

Agrupa eventos y operaciones pertenecientes al mismo flujo.

## CausationId

Identifica el comando o evento que provocó el evento actual.

Ejemplo:

```text
InstallModuleCommand

        │

        ▼

ModuleInstalled

        │

        ▼

ResourcesPublished
```

Estos datos formarán parte preferentemente del Event Envelope.

---

# Event Dispatcher

El Event Dispatcher será la abstracción oficial para publicar eventos.

Contrato conceptual:

```php
interface EventDispatcherContract
{
    public function dispatch(object $event): void;
}
```

La implementación inicial podrá adaptar el dispatcher de Laravel.

Los emisores deberán depender del contrato de MEF, no directamente de una fachada global.

---

# Ejemplo de publicación

```php
final readonly class RegisterModulesService
{
    public function __construct(
        private RegistryContract $registry,
        private EventDispatcherContract $events,
    ) {
    }

    public function execute(
        ModuleMetadata $module
    ): void {
        $this->registry->register($module);

        $this->events->dispatch(
            new ModuleRegistered(
                module: $module,
                occurredAt: new DateTimeImmutable(),
            )
        );
    }
}
```

El evento deberá emitirse únicamente después de completar exitosamente el hecho descrito.

---

# Orden de publicación

Los eventos se publicarán después de que la operación principal haya sido confirmada.

Ejemplo:

```text
Registrar módulo

    │

    ├── validación
    ├── registro
    └── confirmación

    │

    ▼

ModuleRegistered
```

No deberá emitirse `ModuleRegistered` antes de que el Registry confirme el registro.

---

# Eventos previos

En algunas operaciones podrá ser necesario notificar que un proceso está por comenzar.

Ejemplos:

```text
FrameworkBooting
ModuleInstalling
ModuleEnabling
```

Estos eventos deberán diferenciarse claramente de los eventos consumados:

```text
FrameworkBooted
ModuleInstalled
ModuleEnabled
```

Los eventos previos no deberán utilizarse para simular comandos o alterar arbitrariamente el flujo.

---

# Eventos cancelables

La primera versión de MEF no adoptará eventos cancelables como mecanismo general.

Motivos:

- dificultan el razonamiento;
- vuelven incierto el resultado;
- introducen dependencias ocultas;
- mezclan comandos con eventos;
- complican la ejecución asíncrona.

Cuando una operación requiera autorización o validación deberá utilizar:

- políticas;
- contratos;
- validators;
- Application Services;
- comandos explícitos.

---

# Listeners

Un listener representa una única reacción.

Ejemplo:

```php
final readonly class WriteModuleAuditLog
{
    public function __construct(
        private AuditContract $audit
    ) {
    }

    public function handle(
        ModuleRegistered $event
    ): void {
        $this->audit->record(
            action: 'module.registered',
            subject: $event->module->id,
        );
    }
}
```

Los listeners deberán:

- ser pequeños;
- tener una responsabilidad;
- depender de contratos;
- ser idempotentes cuando sea posible;
- poder probarse de forma aislada.

---

# Lo que un listener NO debe hacer

Un listener no deberá:

- coordinar procesos extensos sin delegación;
- contener múltiples responsabilidades;
- modificar el evento;
- depender de la interfaz que originó la operación;
- provocar dependencias circulares entre módulos;
- esconder un caso de uso principal.

Cuando una reacción sea compleja deberá delegarse a un Application Service.

---

# Ejecución síncrona

La primera implementación de los eventos fundamentales del Core será síncrona.

Ventajas:

- comportamiento determinista;
- depuración sencilla;
- errores visibles;
- menor complejidad;
- pruebas directas.

Ejemplo:

```text
Dispatch

↓

Listener A

↓

Listener B

↓

Fin
```

---

# Ejecución asíncrona

Los listeners que realicen operaciones costosas podrán ejecutarse mediante colas.

Ejemplos:

- envío de correo;
- generación de reportes;
- sincronización remota;
- indexación;
- procesamiento de archivos.

La decisión de ejecutar asincrónicamente pertenecerá al listener o a su adaptador de infraestructura.

El evento no deberá conocer el mecanismo de transporte.

---

# Fallos de listeners síncronos

La política inicial será:

> Un listener síncrono que lance una excepción detiene la distribución y propaga el error.

Esta política ofrece comportamiento predecible durante las primeras versiones.

Podrán existir estrategias futuras:

- continuar con los demás listeners;
- acumular errores;
- registrar y omitir;
- reintentar;
- enviar a una cola de fallos.

La estrategia deberá configurarse explícitamente.

---

# Fallos de listeners asíncronos

Los listeners en cola utilizarán las políticas de:

- reintentos;
- backoff;
- timeout;
- failed jobs;
- dead-letter queue, cuando exista.

Los errores asíncronos no deberán modificar retroactivamente el hecho que originó el evento.

---

# Transacciones

Cuando un evento dependa de una operación transaccional, deberá emitirse después de confirmar la transacción.

Ejemplo:

```text
Transacción

├── guardar módulo
├── registrar estado
└── commit

        │

        ▼

ModuleInstalled
```

No deberá publicarse antes del `commit`, porque los listeners podrían observar un estado que posteriormente sea revertido.

En Laravel podrá utilizarse una estrategia `afterCommit` cuando corresponda.

---

# Idempotencia

Los listeners asíncronos y aquellos sujetos a reintentos deberán diseñarse como idempotentes.

Ejemplo:

```text
EventId

    │

    ▼

¿Ya procesado?

├── Sí → finalizar
└── No → ejecutar y registrar
```

La idempotencia será especialmente importante para:

- notificaciones;
- integraciones;
- actualización de índices;
- procesos distribuidos;
- auditoría externa.

---

# Orden de listeners

El Framework no deberá depender del orden entre listeners salvo que dicho orden se declare explícitamente.

Cuando una reacción dependa obligatoriamente de otra, deberá considerarse:

- un Application Service;
- un workflow;
- una secuencia explícita;
- un nuevo evento derivado.

Ejemplo preferido:

```text
ModuleInstalled

    │

    ▼

PublishResources

    │

    ▼

ModuleResourcesPublished
```

En lugar de asumir que un listener siempre se ejecutará antes que otro.

---

# Registro de listeners

Los listeners podrán registrarse mediante:

- Service Providers;
- configuración;
- subscribers;
- descubrimiento controlado.

Ejemplo:

```php
protected array $listen = [
    ModuleRegistered::class => [
        WriteModuleAuditLog::class,
        ClearModuleCache::class,
    ],
];
```

La estrategia definitiva deberá integrarse con Laravel sin acoplar los eventos públicos a sus fachadas.

---

# Eventos entre módulos

Un módulo podrá consumir eventos públicos emitidos por otro módulo.

Ejemplo:

```text
CRM

    │

    ▼

CustomerCreated

    │

    ▼

Notifications Module
```

El módulo consumidor dependerá del contrato público del evento, no de servicios internos del módulo emisor.

---

# Propiedad de los eventos

Cada evento tendrá un propietario arquitectónico.

## Core

Eventos del ciclo de vida del Framework.

## Platform

Eventos de servicios compartidos.

## Module

Eventos de su dominio empresarial.

Un módulo no deberá declarar eventos que representen conceptos pertenecientes a otro módulo.

---

# Versionado de eventos

Los eventos públicos constituyen una API.

Los cambios incompatibles deberán evitarse.

Cambios compatibles:

- añadir metadatos opcionales;
- crear métodos derivados;
- publicar un nuevo evento.

Cambios potencialmente incompatibles:

- renombrar propiedades;
- eliminar campos;
- cambiar tipos;
- modificar significado;
- cambiar el momento de publicación.

Cuando un evento necesite una ruptura podrá crearse una nueva versión:

```text
ModuleInstalledV2
```

o un nuevo nombre semántico.

La estrategia deberá documentarse mediante ADR.

---

# Serialización

Los eventos destinados a colas, persistencia o integración deberán ser serializables.

La serialización deberá:

- utilizar valores escalares;
- conservar tipos relevantes;
- incluir versión;
- evitar objetos de infraestructura;
- ser estable;
- validar datos durante la reconstrucción.

Los Value Objects podrán proporcionar métodos de serialización controlada.

---

# Eventos externos

Los eventos internos de MEF no serán automáticamente eventos de integración externos.

Cuando sea necesario comunicar hechos a otros sistemas, se utilizará una transformación explícita:

```text
Domain Event

    │

    ▼

Integration Event Mapper

    │

    ▼

Integration Event

    │

    ▼

Message Broker
```

Esto evitará exponer detalles internos del Framework.

---

# Event Store

La primera versión no incluirá Event Sourcing ni un Event Store obligatorio.

El Event System se diseñará de forma que permita incorporar en el futuro:

- persistencia de eventos;
- replay;
- auditoría avanzada;
- proyecciones;
- integración distribuida.

Esta posibilidad no deberá añadir complejidad prematura a la implementación inicial.

---

# Observabilidad

La distribución de eventos deberá ser observable.

Podrán registrarse:

- tipo de evento;
- identificador;
- fecha;
- emisor;
- listeners ejecutados;
- duración;
- resultado;
- errores;
- correlación.

No deberán registrarse datos sensibles sin políticas de protección.

---

# Auditoría

Los eventos pueden alimentar sistemas de auditoría, pero no sustituyen un registro de auditoría formal.

Un evento describe un hecho técnico o empresarial.

Una auditoría puede requerir además:

- actor;
- IP;
- contexto;
- valores anteriores;
- valores nuevos;
- justificación;
- retención.

Platform Audit podrá consumir eventos y construir registros adecuados.

---

# Seguridad

Los eventos no deberán incluir:

- contraseñas;
- tokens;
- secretos;
- claves privadas;
- datos personales innecesarios;
- contenido completo de archivos sensibles.

Los listeners deberán asumir que un evento puede quedar registrado, en cola o persistido.

Los eventos provenientes de sistemas externos deberán validarse antes de ingresar al Event System interno.

---

# Compatibilidad con Laravel

La implementación inicial podrá utilizar:

```text
Illuminate\Contracts\Events\Dispatcher
```

mediante un adaptador que implemente:

```text
EventDispatcherContract
```

Esto permitirá:

- aprovechar Laravel Events;
- mantener una API propia;
- facilitar pruebas;
- sustituir la implementación en el futuro.

Los componentes del Core no deberán depender directamente de la fachada `Event`.

---

# Organización del código

La estructura propuesta es:

```text
app/
└── Core/
    └── Events/
        ├── Contracts/
        │   └── EventDispatcherContract.php
        ├── Framework/
        │   ├── FrameworkBooting.php
        │   ├── FrameworkBooted.php
        │   └── FrameworkReady.php
        ├── Modules/
        │   ├── ModuleDiscovered.php
        │   ├── ModuleRegistered.php
        │   ├── ModuleEnabled.php
        │   └── ModuleDisabled.php
        ├── Dispatcher/
        │   └── LaravelEventDispatcher.php
        ├── Exceptions/
        └── Support/
```

Los eventos empresariales permanecerán dentro de sus módulos:

```text
app/
└── Modules/
    └── CRM/
        └── Domain/
            └── Events/
                └── CustomerCreated.php
```

---

# Eventos iniciales del Core

La primera versión podrá incluir:

```text
FrameworkBooting
FrameworkBooted
FrameworkReady
BootstrapFailed
ModuleDiscovered
ModuleValidated
ModuleRegistered
ModuleBooted
ModuleEnabled
ModuleDisabled
```

La incorporación de cada evento deberá responder a un consumidor o necesidad observable real.

No se crearán eventos especulativos sin uso definido.

---

# Integración con Bootstrap

El flujo previsto será:

```text
Kernel

    │

    ▼

FrameworkBooting

    │

    ▼

Discovery

    │

    ├── ModuleDiscovered
    └── ModuleValidated

    │

    ▼

Registry

    │

    └── ModuleRegistered

    │

    ▼

Providers

    │

    └── ModuleBooted

    │

    ▼

FrameworkBooted

    │

    ▼

FrameworkReady
```

Los eventos deberán emitirse únicamente cuando el estado correspondiente sea real.

---

# Integración con Application Services

Los Application Services serán los principales emisores de eventos relacionados con casos de uso.

Ejemplo:

```text
EnableModuleService

    │

    ├── valida estado
    ├── habilita módulo
    └── publica ModuleEnabled
```

Los Builders no deberán emitir eventos de negocio.

Podrán emitir eventos técnicos únicamente si existe una necesidad clara y documentada.

---

# Integración con Registry

Registry mantendrá el estado.

El Application Service o Kernel publicará el evento después de que Registry confirme el cambio.

Esto evita que Registry mezcle almacenamiento con comunicación.

---

# Integración con CLI

La CLI no deberá escuchar eventos para determinar el resultado directo de un comando.

El comando recibirá el resultado del Application Service.

Los eventos podrán utilizarse para:

- auditoría;
- logs;
- métricas;
- reacciones adicionales.

La respuesta principal seguirá siendo explícita.

---

# Excepciones

Podrán definirse excepciones como:

```text
EventDispatchException
ListenerExecutionException
InvalidEventException
EventSerializationException
DuplicateEventListenerException
```

Las excepciones deberán conservar la causa original cuando exista.

---

# Pruebas requeridas

La implementación deberá cubrir:

- publicación de un evento;
- cero listeners;
- un listener;
- múltiples listeners;
- evento inmutable;
- listener fallido;
- orden documentado;
- propagación de errores;
- listener asíncrono;
- serialización;
- evento después de commit;
- idempotencia;
- integración con Laravel;
- integración con Bootstrap;
- eventos de módulos;
- ausencia de fachadas globales en el Core.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|---|---|
| Emisor | Publicar un hecho consumado |
| Event | Representar el hecho |
| Dispatcher | Distribuir el evento |
| Listener | Reaccionar al evento |
| Application Service | Coordinar el caso de uso y publicar |
| Registry | Mantener estado |
| Kernel | Coordinar eventos del ciclo de vida |
| Service Provider | Registrar listeners |
| Queue | Ejecutar listeners asíncronos |
| Audit | Construir registros de auditoría |

---

# Decisiones arquitectónicas

1. Los eventos representarán hechos consumados.
2. Los nombres utilizarán tiempo pasado.
3. Los eventos serán inmutables.
4. Los emisores dependerán de `EventDispatcherContract`.
5. La implementación inicial adaptará el dispatcher de Laravel.
6. Los eventos fundamentales del Core serán síncronos inicialmente.
7. Los listeners costosos podrán ejecutarse en cola.
8. Los eventos públicos serán tratados como API versionada.
9. Los eventos deberán emitirse después de confirmar la operación.
10. No se utilizarán eventos cancelables como mecanismo general.
11. Los listeners deberán ser pequeños e idempotentes cuando corresponda.
12. Los eventos internos no se expondrán automáticamente como eventos externos.
13. El Event System no sustituirá contratos, comandos ni Application Services.
14. Los eventos empresariales pertenecerán a sus módulos.
15. La primera versión no requerirá Event Sourcing.

---

# Criterios de aceptación

ARQ-016 se considerará implementado cuando existan:

- `EventDispatcherContract`;
- adaptador para Laravel;
- eventos inmutables;
- eventos iniciales del ciclo de vida;
- registro de listeners;
- integración con Bootstrap;
- integración con Application Services;
- política de errores;
- pruebas unitarias;
- pruebas de integración;
- documentación de eventos públicos;
- ausencia de dependencias directas entre emisores y listeners.

---

# Evolución prevista

En versiones futuras podrán incorporarse:

- Event Envelope;
- EventId;
- CorrelationId;
- CausationId;
- eventos persistentes;
- Event Store;
- replay;
- Integration Events;
- Message Broker;
- outbox pattern;
- dead-letter queues;
- métricas avanzadas;
- eventos multi-tenant;
- contratos de eventos publicados.

Cada capacidad deberá introducirse mediante ADR o RFC según su impacto.

---

# Conclusión

El Event System constituye el mecanismo oficial de comunicación desacoplada de MEF.

Los Application Services completan operaciones.

Los eventos describen lo ocurrido.

El Dispatcher distribuye.

Los listeners reaccionan.

Los módulos permanecen desacoplados.