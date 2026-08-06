# DIC-001D — Sistema de Eventos

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario oficial del Sistema de Eventos de MEF.

Este documento establece el significado único de los conceptos relacionados con la comunicación desacoplada entre componentes del Framework.

Todos los módulos, servicios y componentes deberán utilizar esta terminología de forma consistente.

---

# Alcance

Este documento cubre los conceptos relacionados con:

- Eventos
- Publicación
- Consumo
- Dispatcher
- Listeners
- Subscribers
- Metadatos
- Correlación
- Integración

No describe implementaciones específicas.

---

# MEF-DIC-0031

## Event

### Definición

Un **Event** representa un hecho relevante que ya ocurrió dentro del Framework o de un módulo.

Los eventos describen sucesos consumados.

Nunca representan solicitudes ni intenciones.

### Propósito

Comunicar hechos entre componentes desacoplados.

### Categoría

Core

### Documento de origen

ARQ-016

### Ejemplos

- ModuleRegistered
- ModuleEnabled
- FrameworkBooted
- CustomerCreated

### No confundir con

- Command
- Action
- Request

### Estado

Estable

---

# MEF-DIC-0032

## Event Dispatcher

### Definición

Componente responsable de distribuir un Event hacia todos los Listeners registrados.

El Dispatcher no contiene lógica de negocio.

### Propósito

Coordinar la publicación de eventos.

### Categoría

Core

### Documento de origen

ARQ-016

### Responsabilidades

- Recibir eventos.
- Localizar listeners.
- Ejecutarlos.
- Propagar errores según la política definida.

### Estado

Estable

---

# MEF-DIC-0033

## Event Listener

### Definición

Componente que reacciona a un Event específico.

Cada Listener debe representar una única responsabilidad.

### Propósito

Responder a hechos publicados por otros componentes.

### Categoría

Core

### Documento de origen

ARQ-016

### Ejemplos

- WriteAuditLog
- ClearModuleCache
- SendNotification

### No confundir con

- Subscriber
- Observer

### Estado

Estable

---

# MEF-DIC-0034

## Event Subscriber

### Definición

Componente que agrupa múltiples Listeners relacionados mediante una única declaración.

Permite registrar varias reacciones pertenecientes a un mismo contexto.

### Propósito

Organizar listeners relacionados.

### Categoría

Core

### Documento de origen

ARQ-016

### Estado

Opcional

---

# MEF-DIC-0035

## Event Envelope

### Definición

Contenedor opcional que añade metadatos técnicos a un Event sin modificar su contenido funcional.

### Propósito

Transportar información transversal.

### Información típica

- EventId
- Fecha
- CorrelationId
- CausationId
- Tenant
- Usuario técnico

### Documento de origen

ARQ-016

### Estado

Evolución futura

---

# MEF-DIC-0036

## EventId

### Definición

Identificador único asociado a un Event.

Permite identificar un evento de forma inequívoca.

### Propósito

Facilitar:

- auditoría;
- deduplicación;
- reintentos;
- trazabilidad.

### Documento de origen

ARQ-016

### Estado

Propuesto

---

# MEF-DIC-0037

## CorrelationId

### Definición

Identificador compartido por todos los eventos pertenecientes a un mismo flujo de trabajo.

### Propósito

Relacionar eventos distribuidos.

### Ejemplo

```text
InstallModule

↓

ModuleInstalled

↓

ResourcesPublished

↓

CacheCleared
```

Todos comparten el mismo CorrelationId.

### Documento de origen

ARQ-016

### Estado

Propuesto

---

# MEF-DIC-0038

## CausationId

### Definición

Identificador del Event o Command que originó el Event actual.

### Propósito

Mantener la cadena de causalidad.

### Ejemplo

```text
Command

↓

ModuleInstalled

↓

ModuleEnabled

↓

ResourcesPublished
```

Cada evento referencia al anterior.

### Documento de origen

ARQ-016

### Estado

Propuesto

---

# MEF-DIC-0039

## Integration Event

### Definición

Evento diseñado para ser compartido con sistemas externos.

No representa necesariamente el mismo objeto que un Event interno del Framework.

### Propósito

Comunicar hechos relevantes fuera de MEF.

### Documento de origen

ARQ-016

### No confundir con

- Domain Event
- Internal Event

### Estado

Evolución futura

---

# MEF-DIC-0040

## Event Store

### Definición

Repositorio especializado para almacenar eventos de forma persistente.

Su incorporación permitirá capacidades como:

- replay;
- auditoría;
- proyecciones;
- Event Sourcing.

No forma parte de la primera versión de MEF.

### Documento de origen

ARQ-016

### Estado

No implementado

---

# Principios

El Sistema de Eventos de MEF seguirá estas reglas:

- los eventos representan hechos consumados;
- los nombres utilizan tiempo pasado;
- los eventos son inmutables;
- los listeners poseen una única responsabilidad;
- el Dispatcher coordina la distribución;
- los emisores no conocen a los consumidores.

---

# Relaciones

```text
Application Service
        │
        ▼
     Event
        │
        ▼
Event Dispatcher
        │
        ├── Listener A
        ├── Listener B
        └── Listener C
```

---

# Resumen

| ID | Término |
|----|----------|
| MEF-DIC-0031 | Event |
| MEF-DIC-0032 | Event Dispatcher |
| MEF-DIC-0033 | Event Listener |
| MEF-DIC-0034 | Event Subscriber |
| MEF-DIC-0035 | Event Envelope |
| MEF-DIC-0036 | EventId |
| MEF-DIC-0037 | CorrelationId |
| MEF-DIC-0038 | CausationId |
| MEF-DIC-0039 | Integration Event |
| MEF-DIC-0040 | Event Store |

---

# Decisiones

1. Los eventos representan hechos ya ocurridos.
2. Los emisores permanecen desacoplados de los consumidores.
3. El Dispatcher distribuye eventos; no implementa lógica de negocio.
4. Los Listeners tendrán una única responsabilidad.
5. Los eventos públicos constituyen parte de la API del Framework.
6. Los Integration Events serán independientes de los eventos internos.
7. Event Store no será obligatorio en la primera versión de MEF.

---

# Conclusión

DIC-001D establece el vocabulario oficial del Sistema de Eventos de MEF.

Este lenguaje garantiza una comunicación consistente entre Core, Platform y Modules, permitiendo una arquitectura desacoplada, extensible y preparada para evolucionar hacia escenarios distribuidos.