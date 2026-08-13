---
id: ENG-015
titulo: Architectural State Machine
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Lifecycle
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-003
  - ENG-009
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-014
  - ARQ-004
  - ARQ-006
  - ARQ-014
  - ARQ-016
relacionados:
  - ENG-007
  - ENG-016
  - ENG-017
keywords:
  - state machine
  - lifecycle
  - state
  - transition
  - module
  - package
  - runtime
  - application
  - architectural state
  - mef
---

# ENG-015

# Architectural State Machine

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Architectural State Machine** de **MEF (Modular Enterprise Framework)**.

ENG-015 establece cómo los componentes arquitectónicos pueden:

- adquirir estado;
- cambiar de estado;
- validar transiciones;
- reaccionar ante fallos;
- recuperarse;
- finalizar;
- exponer su estado al sistema.

El objetivo es impedir que los componentes evolucionen mediante cambios de estado implícitos, ambiguos o inválidos.

---

# 2. Declaración

Todo componente con Lifecycle significativo deberá poder modelarse mediante:

```text
State
+
Transition
+
Guard
+
Action
+
Result
```

Conceptualmente:

```text
Current State
     │
     ▼
Transition Request
     │
     ▼
Guard Validation
     │
 ┌───┴────┐
 ▼        ▼
ALLOW    DENY
 │         │
 ▼         ▼
Action    Error
 │
 ▼
Next State
```

---

# 3. Objetivos

Architectural State Machine deberá:

- formalizar Lifecycle;
- impedir transiciones inválidas;
- hacer explícitos estados;
- proporcionar diagnóstico;
- soportar recuperación;
- facilitar Testing;
- facilitar observabilidad;
- reducir estados ambiguos;
- permitir automatización;
- soportar validación arquitectónica.

---

# 4. Conceptos Fundamentales

MEF reconoce:

```text
State
Transition
Guard
Action
Entry Action
Exit Action
Failure
Terminal State
State Machine
```

---

# 5. State

Un `State` representa una condición significativa y observable de una entidad.

Ejemplos:

```text
Registered
Resolved
Initialized
Active
Stopping
Stopped
Failed
```

Un State deberá poseer significado arquitectónico.

---

# 6. Transition

Una `Transition` representa un cambio permitido entre dos States.

Ejemplo:

```text
Initialized
    ↓
 activate
    ↓
Active
```

---

# 7. Guard

Una `Guard` determina si una Transition puede ejecutarse.

Ejemplo:

```text
Package Verified?
Module Dependencies Resolved?
Configuration Valid?
```

Si la Guard falla:

```text
Transition denied
```

---

# 8. Action

Una `Action` representa trabajo ejecutado como parte de una Transition.

Ejemplo:

```text
initialize()
activate()
stop()
register()
```

La Action no deberá cambiar arbitrariamente el State fuera del mecanismo oficial.

---

# 9. Entry Action

Una Entry Action podrá ejecutarse al ingresar a un State.

Ejemplo:

```text
enter Active
   ↓
publish lifecycle signal
```

---

# 10. Exit Action

Una Exit Action podrá ejecutarse al abandonar un State.

---

# 11. Terminal State

Un Terminal State representa un estado desde el cual no existen transiciones ordinarias posteriores.

Ejemplo conceptual:

```text
Removed
```

o:

```text
Terminated
```

según la entidad.

---

# 12. Failed State

`Failed` representa un estado conocido de fallo.

No significa necesariamente que la entidad sea irrecuperable.

Podrán existir transiciones:

```text
Failed
  ↓
Recovering
  ↓
Recovered State
```

cuando el modelo lo permita.

---

# 13. State Machine

Una State Machine define:

```text
States
+
Allowed Transitions
+
Guards
+
Actions
+
Failure Semantics
```

---

# 14. Architectural State

No todo valor interno constituye Architectural State.

Ejemplo:

```text
retryCount = 3
```

normalmente es estado operativo.

En cambio:

```text
Module = Active
```

es estado arquitectónico.

---

# 15. State vs Status

MEF favorecerá:

```text
State
```

para condiciones que gobiernan transiciones.

`Status` podrá utilizarse para información descriptiva que no participa directamente en State Machine.

---

# 16. Explicit State

El State deberá ser explícito cuando afecte decisiones arquitectónicas.

No deberá inferirse únicamente mediante heurísticas como:

```text
if object != null
then initialized
```

---

# 17. State Ownership

Cada State Machine deberá poseer un responsable claro.

Ejemplo:

```text
Module Lifecycle Manager
Package State Manager
Runtime Lifecycle Manager
```

---

# 18. State Mutation

El State no deberá modificarse libremente.

Evitar:

```text
module.state = ACTIVE
```

Preferir:

```text
module.activate()
```

o:

```text
stateMachine.transition(ACTIVATE)
```

según Implementation Profile.

---

# 19. Transition Validation

Toda Transition deberá validarse contra el Current State.

Ejemplo:

```text
Current:
Registered

Requested:
stop

Result:
INVALID_TRANSITION
```

si `Registered → Stopped` no está permitido.

---

# 20. Determinism

Para una misma combinación de:

```text
Current State
Transition
Context
```

la decisión de transición deberá ser determinista, salvo dependencias externas explícitas.

---

# 21. Transition Table

Las State Machines deberían poder representarse mediante una tabla.

Ejemplo:

| Current | Transition | Next |
|---|---|---|
| Registered | resolve | Resolved |
| Resolved | initialize | Initialized |
| Initialized | activate | Active |
| Active | stop | Stopping |
| Stopping | complete | Stopped |

---

# 22. Invalid Transition

Una transición no definida deberá rechazarse.

No deberá improvisarse un Next State.

---

# 23. Invalid Transition Error

Ejemplo conceptual:

```text
MEF-STM-001
Invalid transition.

Entity:
MOD-CRM

Current State:
Registered

Requested Transition:
activate

Expected:
resolve
```

---

# 24. State Machine Scope

MEF podrá utilizar State Machines para:

```text
Framework
Application
Module
Package
Configuration
Build
Release
```

cuando exista Lifecycle significativo.

---

# 25. Universal State Machine

MEF no deberá forzar una única State Machine idéntica para todas las entidades.

La regla será:

```text
Common State Machine Principles
+
Entity-specific Lifecycle
```

---

# 26. Framework Lifecycle

Conceptualmente:

```text
Created
   ↓
Bootstrapping
   ↓
Initialized
   ↓
Running
   ↓
Stopping
   ↓
Stopped
```

Ante fallo:

```text
Bootstrapping
     ↓
   Failed
```

---

# 27. Framework States

Estados iniciales recomendados:

```text
Created
Bootstrapping
Initialized
Running
Stopping
Stopped
Failed
```

---

# 28. Framework Transition Table

| Current | Transition | Next |
|---|---|---|
| Created | bootstrap | Bootstrapping |
| Bootstrapping | complete | Initialized |
| Initialized | run | Running |
| Running | stop | Stopping |
| Stopping | complete | Stopped |
| Bootstrapping | fail | Failed |
| Initialized | fail | Failed |
| Running | fail | Failed |
| Stopping | fail | Failed |

---

# 29. Framework Created

`Created` significa que existe una instancia de Framework pero Bootstrap aún no ha comenzado.

---

# 30. Framework Bootstrapping

Durante `Bootstrapping` podrán ejecutarse:

```text
Configuration
Registry
Container
Package Discovery
Module Discovery
Dependency Resolution
Initialization
```

según ARQ-014.

---

# 31. Framework Initialized

`Initialized` significa que las dependencias fundamentales requeridas para iniciar Runtime están preparadas.

---

# 32. Framework Running

`Running` representa operación normal.

---

# 33. Framework Stopping

`Stopping` representa Shutdown en progreso.

---

# 34. Framework Stopped

`Stopped` representa finalización ordenada.

---

# 35. Framework Failed

`Failed` representa que el Framework no puede continuar normalmente sin recuperación o reinicio.

---

# 36. Application Lifecycle

Una Application podrá utilizar:

```text
Created
Configured
Bootstrapped
Running
Stopping
Stopped
Failed
```

El Implementation Profile podrá adaptar estos States manteniendo equivalencia conceptual.

---

# 37. Module Lifecycle

El Lifecycle de Module deberá mantenerse separado del Package Lifecycle.

Modelo recomendado:

```text
Discovered
    ↓
Registered
    ↓
Resolved
    ↓
Initialized
    ↓
Active
    ↓
Stopping
    ↓
Stopped
```

Con:

```text
Failed
Disabled
```

cuando corresponda.

---

# 38. Module Discovered

El Module fue encontrado mediante Manifest, Package o mecanismo oficial.

Todavía no participa necesariamente en Runtime.

---

# 39. Module Registered

La identidad y metadata del Module fueron aceptadas por el Registry correspondiente.

---

# 40. Module Resolved

Sus dependencias obligatorias fueron resueltas.

---

# 41. Module Initialized

Sus recursos y Contracts necesarios para activación fueron preparados.

---

# 42. Module Active

El Module participa normalmente en Runtime.

---

# 43. Module Stopping

El Module está liberando recursos o finalizando operaciones.

---

# 44. Module Stopped

El Module dejó de participar activamente en Runtime.

---

# 45. Module Disabled

Un Module instalado o disponible podrá permanecer deshabilitado.

`Disabled` no deberá confundirse con `Failed`.

---

# 46. Module Failed

El Module experimentó un fallo que impide su operación normal.

---

# 47. Module State Diagram

```text
Discovered
    │
    ▼
Registered
    │
    ▼
Resolved
    │
    ▼
Initialized
    │
    ▼
 Active
    │
    ▼
Stopping
    │
    ▼
 Stopped
```

Con rutas de fallo:

```text
Registered ───┐
Resolved ─────┤
Initialized ──┼──→ Failed
Active ───────┤
Stopping ─────┘
```

---

# 48. Module Transition Table

| Current | Transition | Next |
|---|---|---|
| Discovered | register | Registered |
| Registered | resolve | Resolved |
| Resolved | initialize | Initialized |
| Initialized | activate | Active |
| Active | stop | Stopping |
| Stopping | complete | Stopped |
| Registered | disable | Disabled |
| Resolved | disable | Disabled |
| Initialized | disable | Disabled |
| Active | fail | Failed |
| Initialized | fail | Failed |
| Resolved | fail | Failed |

---

# 49. Module Activation Guard

Antes de:

```text
Initialized → Active
```

deberán verificarse al menos:

```text
Required Contracts available
Required dependencies active or available
Configuration valid
Security requirements satisfied
```

según el Module.

---

# 50. Module Dependency State

Si:

```text
MOD-A
depends on
MOD-B
```

la activación de `MOD-A` podrá requerir que `MOD-B` se encuentre en un State compatible.

Ejemplo:

```text
MOD-B = Active
```

---

# 51. Activation Ordering

El Dependency Graph podrá determinar el orden:

```text
MOD-B
  ↓
MOD-A
```

si A depende de B.

---

# 52. Shutdown Ordering

El Shutdown normalmente invertirá el orden:

```text
MOD-A
  ↓
MOD-B
```

para evitar destruir primero una dependencia todavía utilizada.

---

# 53. Dependency Failure

Si una dependencia obligatoria falla, el consumidor deberá aplicar una política explícita.

Ejemplos:

```text
fail
degrade
disable
retry
```

No deberá continuar silenciosamente como si la dependencia existiera.

---

# 54. Optional Dependency

La ausencia de una dependencia opcional no deberá forzar `Failed` cuando el Contract permita operación degradada.

---

# 55. Degraded State

MEF podrá introducir:

```text
Degraded
```

cuando una entidad pueda continuar operando con capacidades reducidas.

No deberá utilizarse como sustituto genérico de Error.

---

# 56. Degraded Semantics

Un State `Degraded` deberá declarar:

- qué capacidad falta;
- qué operaciones continúan;
- qué recuperación es posible.

---

# 57. Package Lifecycle

ENG-013 ya define estados conceptuales de Package.

ENG-015 formaliza su relación.

Modelo:

```text
Discovered
    ↓
Resolved
    ↓
Downloaded
    ↓
Verified
    ↓
Staged
    ↓
Installed
    ↓
Registered
```

Podrán existir:

```text
Failed
Removed
```

---

# 58. Package State Diagram

```text
Discovered
    │
    ▼
Resolved
    │
    ▼
Downloaded
    │
    ▼
Verified
    │
    ▼
 Staged
    │
    ▼
Installed
    │
    ▼
Registered
```

---

# 59. Package Verification Guard

La transición:

```text
Downloaded → Verified
```

deberá requerir las verificaciones aplicables:

```text
Manifest
Integrity
Signature
Compatibility
Policy
```

---

# 60. Package Installation Guard

La transición:

```text
Staged → Installed
```

solo podrá ocurrir después de completar las verificaciones requeridas.

---

# 61. Package Removed

`Removed` deberá representar que el Package ya no forma parte del Installed State.

Podrá ser Terminal para esa instancia concreta.

---

# 62. Package Failure

Una operación fallida podrá llevar a:

```text
Failed
```

o restaurar el State anterior mediante rollback.

La política dependerá de la operación.

---

# 63. Package Transaction

Para operaciones mutables:

```text
Current State
     ↓
Transitioning
     ↓
Validation
 ┌───┴────┐
 ▼        ▼
Commit   Rollback
 │        │
 ▼        ▼
Next    Previous
State    State
```

---

# 64. Package vs Module

Debe conservarse:

```text
Package Installed
        ≠
Module Active
```

Un Package puede estar:

```text
Installed
```

mientras un Module contenido se encuentra:

```text
Disabled
```

---

# 65. Configuration Lifecycle

ENG-011 podrá modelarse como:

```text
Unloaded
   ↓
Loaded
   ↓
Resolved
   ↓
Validated
   ↓
Active
```

Ante error:

```text
Invalid
```

---

# 66. Configuration Candidate

Para Reload:

```text
Active Configuration
        │
        ▼
Load Candidate
        │
        ▼
Resolve
        │
        ▼
Validate
    ┌───┴────┐
    ▼        ▼
  Valid    Invalid
    │
    ▼
  Commit
    │
    ▼
 New Active
```

Una Candidate inválida no deberá sustituir la Configuration activa.

---

# 67. Configuration States

Estados recomendados:

```text
Unloaded
Loaded
Resolved
Validated
Active
Invalid
```

---

# 68. Build Lifecycle

ENG-012 podrá representarse mediante:

```text
Created
   ↓
Resolving
   ↓
Validating
   ↓
Testing
   ↓
Building
   ↓
Packaging
   ↓
Verifying
   ↓
Succeeded
```

Con:

```text
Failed
Cancelled
```

---

# 69. Build Terminal States

Podrán considerarse:

```text
Succeeded
Failed
Cancelled
```

como Terminal States para una instancia de Build.

---

# 70. Build Failure

Un Build que alcanza:

```text
Failed
```

no deberá transicionar posteriormente a:

```text
Succeeded
```

La corrección deberá producir una nueva instancia de Build o un nuevo intento explícitamente identificado.

---

# 71. Release Lifecycle

ENG-017 podrá utilizar:

```text
Draft
  ↓
Candidate
  ↓
Validated
  ↓
Approved
  ↓
Published
```

Con:

```text
Rejected
Withdrawn
```

según política.

---

# 72. Release Published

`Published` representa que una Release oficial fue puesta a disposición de consumidores.

El Artifact correspondiente deberá ser inmutable.

---

# 73. Release Rejection

Un Candidate que no supere los Gates podrá pasar a:

```text
Rejected
```

No deberá convertirse silenciosamente en Published.

---

# 74. State Machine Composition

Una entidad de alto nivel podrá depender de varias State Machines.

Ejemplo:

```text
Framework Running
      │
      ├── Configuration Active
      ├── Registry Ready
      ├── Modules Active
      └── Runtime Active
```

---

# 75. Composite Guard

La transición de Framework podrá depender de condiciones compuestas.

Ejemplo:

```text
Initialized → Running
```

requiere:

```text
Configuration Active
AND
Required Modules Active
AND
Required Infrastructure Ready
```

---

# 76. Parent/Child State

Un Parent State podrá imponer restricciones sobre Child States.

Ejemplo:

```text
Framework = Stopped
```

no deberá coexistir normalmente con:

```text
Module = Active
```

---

# 77. State Consistency

El sistema deberá detectar combinaciones imposibles o inválidas.

---

# 78. Global Architectural State

MEF podrá construir una vista agregada:

```text
Framework: Running
Configuration: Active
Registry: Ready

Modules:
  MOD-IDENTITY: Active
  MOD-CRM: Active
  MOD-REPORTS: Degraded
```

---

# 79. State Snapshot

Podrá generarse un Snapshot para:

- diagnostics;
- observability;
- support;
- testing.

---

# 80. State Snapshot Safety

El Snapshot no deberá incluir Secrets ni datos sensibles innecesarios.

---

# 81. State Persistence

No todas las State Machines deberán persistirse.

Ejemplo:

```text
Module Active
```

puede reconstruirse durante Bootstrap.

Mientras:

```text
Package Installed
```

normalmente requiere estado persistente.

---

# 82. Persistent State

Cuando un State sea persistente deberán definirse:

- storage;
- version;
- consistency;
- recovery.

---

# 83. Ephemeral State

Estados puramente de Runtime podrán mantenerse únicamente en memoria.

---

# 84. State Reconstruction

Después de restart, el sistema deberá distinguir entre:

```text
persisted state
```

y:

```text
runtime state
```

No deberá asumir que un Module estaba Active y por ello continúa Active después de reinicio.

---

# 85. Desired State

MEF podrá distinguir:

```text
Desired State
```

de:

```text
Actual State
```

Ejemplo:

```text
Desired:
MOD-CRM = Active

Actual:
MOD-CRM = Failed
```

---

# 86. Reconciliation

Un componente de Lifecycle podrá intentar reconciliar:

```text
Desired State
      ↓
Current State
      ↓
Valid Transition Path
      ↓
Target State
```

---

# 87. Declarative Lifecycle

La separación Desired/Actual permite modelos declarativos futuros.

No será requisito de la primera implementación.

---

# 88. Transition Atomicity

Una Transition debería ser atómica respecto al State observable cuando sea posible.

Evitar:

```text
state = Active
then initialize resources
```

Preferir:

```text
initialize resources
validate
commit state = Active
```

---

# 89. Transition in Progress

Cuando una Transition larga necesite ser observable podrá utilizarse un State intermedio.

Ejemplo:

```text
Stopping
```

en lugar de mantener:

```text
Active
```

durante todo Shutdown.

---

# 90. Transitional States

Estados como:

```text
Bootstrapping
Stopping
Resolving
Installing
```

representan trabajo en progreso.

---

# 91. Transitional State Timeout

Una entidad no deberá permanecer indefinidamente en State transitorio sin diagnóstico.

Podrán existir:

```text
timeout
watchdog
failure policy
```

---

# 92. Transition Timeout

Un timeout deberá producir una política explícita:

```text
retry
fail
rollback
cancel
```

---

# 93. Retry

Las Transitions podrán permitir Retry cuando el fallo sea potencialmente transitorio.

---

# 94. Retry Policy

Deberá definir:

```text
max attempts
delay
backoff
retryable failures
```

cuando corresponda.

---

# 95. Non-Retryable Failure

Errores como:

```text
invalid configuration
invalid signature
architecture violation
```

normalmente no deberán reintentarse automáticamente sin cambios de entrada.

---

# 96. Recovery

Una State Machine podrá definir rutas de recuperación.

Ejemplo:

```text
Failed
  ↓
recover
  ↓
Initialized
```

solo cuando pueda garantizarse consistencia.

---

# 97. Recovery Guard

Antes de salir de `Failed` deberán verificarse las condiciones que causaron el fallo.

---

# 98. Restart

Algunas entidades podrán requerir restart completo en lugar de Recovery local.

---

# 99. Failed Terminal

Para determinadas entidades, `Failed` podrá ser Terminal.

Ejemplo:

```text
Build Failed
```

para una instancia concreta de Build.

---

# 100. Cancellation

Las operaciones largas podrán soportar:

```text
Cancelled
```

cuando puedan detenerse de forma segura.

---

# 101. Cancellation Guard

No toda fase deberá ser cancelable.

Ejemplo:

```text
atomic commit in progress
```

podrá requerir completar o rollback antes de aceptar cancelación.

---

# 102. Idempotent Transition

Las Actions deberían ser idempotentes cuando sea razonable.

Ejemplo:

```text
stop()
```

sobre un recurso ya detenido podrá responder de manera segura.

---

# 103. Repeated Transition

La State Machine deberá definir qué ocurre si se solicita:

```text
Active → activate
```

Opciones:

```text
NO-OP
ERROR
IDEMPOTENT SUCCESS
```

La política deberá ser explícita.

---

# 104. Reentrancy

Una Transition no deberá ejecutarse nuevamente sobre la misma entidad mientras ya está en progreso, salvo diseño explícito.

---

# 105. Concurrency

Las State Machines deberán protegerse contra Transitions concurrentes incompatibles.

Ejemplo:

```text
activate()
```

y:

```text
stop()
```

simultáneamente.

---

# 106. Transition Lock

Podrá existir coordinación temporal por entidad.

Esto no deberá confundirse con Dependency Lock de ENG-013.

---

# 107. Compare-and-Set

Implementaciones concurrentes podrán utilizar mecanismos equivalentes a:

```text
transition only if currentState == expectedState
```

---

# 108. State Version

En sistemas distribuidos podrá utilizarse una versión o revision del State para evitar actualizaciones perdidas.

---

# 109. Distributed State

MEF no deberá asumir que todas las State Machines son distribuidas.

Cuando lo sean deberán considerar:

- concurrency;
- consistency;
- partitions;
- retries;
- idempotency.

---

# 110. State Events

Una Transition podrá producir Events.

Ejemplo:

```text
ModuleActivated
PackageInstalled
FrameworkStarted
```

La taxonomía definitiva deberá pertenecer al sistema de Events.

---

# 111. Before Transition

Podrá existir una señal previa:

```text
ModuleActivating
```

cuando sea necesaria.

No deberá permitir modificación arbitraria del State.

---

# 112. After Transition

Un Event posterior deberá emitirse después de confirmar el nuevo State.

```text
commit state
    ↓
publish ModuleActivated
```

---

# 113. Failed Transition Event

Podrá existir:

```text
ModuleActivationFailed
```

con información diagnóstica segura.

---

# 114. Event Ordering

El orden entre Commit y Event deberá ser explícito.

---

# 115. Event Failure

Un fallo de listener posterior no deberá revertir automáticamente una Transition ya confirmada salvo que el modelo transaccional lo defina expresamente.

---

# 116. Logging

ENG-010 deberá permitir registrar:

```text
entityId
previousState
transition
nextState
result
duration
correlationId
```

cuando sea apropiado.

---

# 117. Transition Log

Ejemplo conceptual:

```text
entity: MOD-CRM
transition: activate
from: Initialized
to: Active
result: success
```

---

# 118. Sensitive Context

Los Logs de State Machine no deberán incluir Secrets ni payloads sensibles innecesarios.

---

# 119. Audit

Determinadas Transitions administrativas podrán generar Audit.

Ejemplos:

```text
Package Installed
Module Disabled
Release Published
Security Policy Changed
```

---

# 120. Metrics

Podrán generarse métricas como:

```text
transition_duration
transition_failures
state_count
recovery_attempts
```

---

# 121. Health

El State podrá contribuir a Health, pero:

```text
State ≠ Health
```

Ejemplo:

```text
Module = Active
Health = Degraded
```

puede ser válido.

---

# 122. Readiness

De igual forma:

```text
Lifecycle State
≠
Readiness
```

Un componente puede estar Active pero todavía no estar Ready para una operación específica.

---

# 123. Liveness

`Liveness` tampoco deberá confundirse con Lifecycle State.

---

# 124. Observability

La observabilidad podrá combinar:

```text
State
Health
Readiness
Liveness
Metrics
Logs
```

sin mezclar sus significados.

---

# 125. State Inspection

La CLI podrá proporcionar una vista del estado.

Ejemplo:

```text
mef state
```

o integrarse dentro de:

```text
mef status
```

según ENG-007.

---

# 126. Module State Inspection

Podrá existir:

```text
mef module status MOD-CRM
```

---

# 127. Package State Inspection

ENG-013 podrá exponer:

```text
mef package info PKG-CRM
```

incluyendo su State.

---

# 128. Machine-Readable State

La inspección deberá poder proporcionar salida estructurada cuando sea necesaria para automatización.

---

# 129. Transition CLI

Las operaciones administrativas podrán solicitar Transitions.

Ejemplo:

```text
mef module enable MOD-CRM
mef module disable MOD-CRM
```

La CLI no deberá asignar States directamente.

---

# 130. No `set-state`

Como regla general deberá evitarse:

```text
mef module set-state Active
```

porque permite saltarse Guards y Lifecycle.

---

# 131. Intent Commands

Preferible:

```text
enable
disable
start
stop
install
remove
```

que expresan intención y permiten que State Machine determine la transición.

---

# 132. State Machine Contract

Las implementaciones deberían exponer una abstracción equivalente a:

```text
currentState()
can(transition)
transition(transition)
```

sin imponer una API universal concreta.

---

# 133. Transition Result

Una Transition deberá producir un resultado explícito.

Ejemplo conceptual:

```text
success
previousState
currentState
transition
error
```

---

# 134. Transition Context

Algunas Transitions podrán requerir Context.

Ejemplo:

```text
actor
correlationId
reason
timeout
```

No deberá utilizarse Context como bolsa global arbitraria.

---

# 135. Transition Reason

Para operaciones administrativas podrá registrarse una razón.

Ejemplo:

```text
Module disabled due to maintenance.
```

---

# 136. Transition Actor

Cuando exista autenticación administrativa podrá registrarse quién solicitó la Transition.

Esto pertenece a Audit cuando sea sensible o normativamente relevante.

---

# 137. Authorization

Antes de ejecutar determinadas Transitions deberá verificarse autorización.

Ejemplo:

```text
publish release
remove package
disable security module
```

---

# 138. Authorization vs Guard

Authorization puede formar parte de las condiciones previas, pero conceptualmente:

```text
Authorization
→ may the actor request this?

Guard
→ can the entity perform this now?
```

---

# 139. Policy

Una Policy podrá intervenir antes de una Transition.

Ejemplo:

```text
Production policy denies unsigned package activation.
```

---

# 140. Security Boundary

La State Machine no deberá permitir saltarse Security mediante transición directa.

---

# 141. Failure Isolation

El fallo de una entidad no deberá llevar automáticamente a todas las entidades a `Failed`.

La propagación deberá depender del Dependency Graph y criticidad.

---

# 142. Critical Dependency

Una dependencia crítica fallida podrá provocar fallo del consumidor.

---

# 143. Non-Critical Dependency

Una dependencia no crítica podrá llevar al consumidor a:

```text
Degraded
```

en lugar de `Failed`.

---

# 144. Failure Propagation

Conceptualmente:

```text
Dependency Failed
      ↓
Dependency Classification
      ↓
┌───────────────┬───────────────┐
▼               ▼               ▼
Critical      Optional       Recoverable
▼               ▼               ▼
Failed        Degraded         Retry
```

---

# 145. Cascading Shutdown

Cuando una dependencia fundamental se detenga, los consumidores deberán detenerse en orden seguro cuando sea necesario.

---

# 146. Dependency Graph Integration

La State Machine deberá poder utilizar el Dependency Graph para:

- startup ordering;
- shutdown ordering;
- failure propagation;
- recovery ordering.

---

# 147. Cycles

Los ciclos arquitectónicos deberán detectarse antes de depender de ellos para Lifecycle ordering.

---

# 148. Transition Planning

Para múltiples entidades podrá construirse:

```text
Transition Plan
```

antes de ejecutar.

Ejemplo:

```text
Activate:
1. MOD-CONFIG
2. MOD-EVENTS
3. MOD-IDENTITY
4. MOD-CRM
```

---

# 149. Multi-Entity Transition

Una operación de Framework podrá implicar múltiples Transitions coordinadas.

---

# 150. Partial Startup

Si algunos Modules opcionales fallan, el Framework podrá continuar únicamente cuando la política lo permita.

El estado resultante deberá ser explícito.

---

# 151. Startup Failure

Si falla un Module requerido:

```text
Framework Bootstrapping
        ↓
      Failed
```

podrá ser el resultado correcto.

---

# 152. Graceful Shutdown

Shutdown deberá intentar llevar entidades desde estados activos hasta estados detenidos de forma ordenada.

---

# 153. Forced Shutdown

Podrá existir una ruta de emergencia cuando Graceful Shutdown exceda límites.

Deberá quedar diferenciada y registrada.

---

# 154. Shutdown Timeout

Un timeout podrá provocar:

```text
force stop
```

o:

```text
Failed
```

según política.

---

# 155. Resource Cleanup

Las Exit Actions deberán liberar recursos cuando corresponda.

---

# 156. Cleanup Failure

Un fallo durante Cleanup deberá registrarse y reflejarse en State cuando comprometa consistencia.

---

# 157. Testing

ENG-009 deberá verificar:

```text
valid transitions
invalid transitions
guards
failure paths
recovery
timeouts
concurrency
ordering
idempotency
```

---

# 158. Transition Coverage

Toda Transition pública debería tener pruebas.

---

# 159. Invalid Transition Coverage

También deberán probarse transiciones prohibidas.

Ejemplo:

```text
Discovered → Active
```

debe fallar si requiere pasar por Registration, Resolution e Initialization.

---

# 160. State Reachability

Testing deberá detectar States imposibles de alcanzar cuando no sean intencionalmente abstractos.

---

# 161. Dead State

Un State sin ruta válida de entrada puede indicar un error de diseño.

---

# 162. Dead-End State

Un State no terminal sin salida válida puede indicar un error.

---

# 163. Transition Completeness

Tooling podrá verificar que toda combinación relevante tenga comportamiento definido.

---

# 164. Property-Based Testing

Podrán probarse invariantes como:

```text
Active implies Initialized occurred previously.
```

o:

```text
Removed Package cannot become Installed
without a new installation lifecycle.
```

---

# 165. Architecture Tests

ENG-009 podrá verificar reglas como:

```text
Module cannot activate before dependencies resolve.
Package cannot install before verification.
Release cannot publish before approval.
```

---

# 166. State Machine Definition

Las State Machines deberían ser declarativas o procesables por tooling cuando sea razonable.

Ejemplo conceptual:

```yaml
states:
  - Registered
  - Resolved
  - Initialized
  - Active

transitions:
  resolve:
    from: Registered
    to: Resolved

  initialize:
    from: Resolved
    to: Initialized

  activate:
    from: Initialized
    to: Active
```

La sintaxis concreta dependerá del Implementation Profile.

---

# 167. Machine Readability

Una definición procesable permitirá:

```text
State Machine
   │
   ├── Runtime Validation
   ├── Tests
   ├── Documentation
   ├── Diagrams
   └── CLI Diagnostics
```

---

# 168. Documentation Generation

Los diagramas y Transition Tables podrán generarse desde una definición canónica.

Esto reduce divergencia.

---

# 169. State Machine Versioning

Una State Machine pública deberá evaluarse bajo ENG-014.

---

# 170. Breaking State Change

Podrá ser Breaking Change:

```text
remove State
remove valid Transition
change Transition semantics
add mandatory intermediate State
change terminal semantics
```

si afecta consumidores públicos.

---

# 171. Compatible State Change

Añadir una Transition opcional podrá ser compatible si no altera garantías existentes.

---

# 172. State Migration

Cuando State persistido cambie entre versiones deberá existir estrategia de Migration.

---

# 173. Unknown Persisted State

Una versión nueva no deberá reinterpretar silenciosamente un State persistido desconocido.

---

# 174. State Schema

El estado persistido podrá disponer de Schema Version cuando sea necesario.

---

# 175. State Corruption

Un State imposible o corrupto deberá detectarse.

No deberá normalizarse silenciosamente sin política.

---

# 176. Repair

Podrá existir un mecanismo de Repair para determinadas State Machines persistentes.

Debe:

- validar;
- explicar;
- aplicar reglas gobernadas;
- registrar cambios.

---

# 177. Manual State Editing

La edición manual del State persistido deberá evitarse como operación ordinaria.

---

# 178. State Machine Errors

Taxonomía conceptual:

```text
MEF-STM-001 Invalid transition
MEF-STM-002 Guard rejected
MEF-STM-003 Transition failed
MEF-STM-004 Transition timeout
MEF-STM-005 Invalid state
MEF-STM-006 State conflict
MEF-STM-007 Recovery failed
MEF-STM-008 State corruption
MEF-STM-009 Concurrent transition
MEF-STM-010 Dependency state incompatible
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 179. Error Context

Los errores podrán incluir:

```text
entity
currentState
requestedTransition
expectedStates
guard
cause
correlationId
```

sin revelar información sensible.

---

# 180. State Machine Engine

MEF podrá implementar un Engine común.

Conceptualmente:

```text
State Machine Definition
        │
        ▼
Transition Engine
        │
   ┌────┼────┐
   ▼    ▼    ▼
 Guard Action Event
        │
        ▼
     State Store
```

---

# 181. State Store

El State Store deberá abstraer persistencia cuando la State Machine requiera almacenamiento.

No todas las máquinas necesitarán State Store persistente.

---

# 182. Transition Engine

El Engine será responsable de:

- leer Current State;
- localizar Transition;
- validar Guards;
- ejecutar Action;
- confirmar Next State;
- producir resultado.

---

# 183. Separation of Concerns

El Engine no deberá contener lógica específica de CRM, Identity u otros Domains.

---

# 184. Domain State Machines

Los Domains podrán implementar sus propias State Machines de negocio.

Ejemplos:

```text
Order
Invoice
Case
Workflow
```

Estas no deberán confundirse con Architectural State Machine.

---

# 185. Architectural vs Domain State

```text
Architectural State
→ lifecycle técnico

Domain State
→ lifecycle del negocio
```

Ejemplo:

```text
MOD-ORDERS = Active
```

es arquitectónico.

```text
Order = Paid
```

es Domain State.

---

# 186. Shared Engine

Un mismo motor técnico podrá soportar ambas categorías si respeta separación de Contracts.

Pero sus State Definitions deberán mantenerse separadas.

---

# 187. Workflow vs State Machine

Un Workflow puede coordinar múltiples actividades.

Una State Machine define estados y transiciones válidas.

No deberán considerarse sinónimos.

---

# 188. Process vs State

Un proceso describe:

```text
what happens
```

La State Machine describe:

```text
what states are valid
and how they may change
```

---

# 189. Orchestration Integration

Un Orchestrator podrá solicitar Transitions.

No deberá modificar State directamente.

---

# 190. Scheduler Integration

Un Scheduler podrá activar Transitions programadas cuando esté autorizado.

---

# 191. Event Integration

Un Event Handler podrá solicitar una Transition.

La State Machine deberá validar igualmente Guards.

---

# 192. API Integration

Una API administrativa podrá solicitar una Transition.

La API no deberá saltarse State Machine.

---

# 193. Implementation Independence

MEF no deberá depender universalmente de una librería específica de State Machine.

Podrán utilizarse:

```text
custom engine
framework workflow component
state machine library
```

mediante Implementation Profiles.

---

# 194. Minimal Implementation

Una primera implementación podrá utilizar:

```text
enum State
enum Transition
transition table
guard callbacks
transition service
```

sin requerir un motor complejo.

---

# 195. Evolution

Posteriormente podrá añadirse:

```text
declarative definitions
visualization
distributed state
reconciliation
policy integration
automatic documentation
formal verification
```

sin alterar el modelo fundamental.

---

# 196. Formal Verification

Las State Machines son candidatas naturales para verificación formal.

Tooling podrá detectar:

- unreachable States;
- invalid cycles;
- missing transitions;
- contradictory Guards;
- unsafe terminal paths.

---

# 197. Architectural Verification

En combinación con AI y EI:

```text
Architecture
     ↓
State Machine Definition
     ↓
Static Verification
     ↓
Runtime Enforcement
```

Esto permite verificar arquitectura antes y durante ejecución.

---

# 198. Invariantes de Ingeniería

ENG-015 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-246 | Todo componente con Lifecycle arquitectónicamente significativo deberá poseer States y Transitions explícitos. |
| EI-247 | El State arquitectónico no deberá modificarse fuera del mecanismo de transición gobernado. |
| EI-248 | Toda Transition deberá validarse contra el Current State antes de ejecutarse. |
| EI-249 | Las Transitions no definidas deberán rechazarse explícitamente. |
| EI-250 | Las Guards deberán evaluarse antes de confirmar el Next State. |
| EI-251 | Un State no deberá declararse alcanzado antes de completar las condiciones necesarias para hacerlo válido. |
| EI-252 | Package Lifecycle y Module Lifecycle deberán permanecer separados. |
| EI-253 | `Package Installed` no deberá implicar automáticamente `Module Active`. |
| EI-254 | Las dependencias obligatorias deberán encontrarse en States compatibles antes de activar consumidores dependientes. |
| EI-255 | El Startup deberá respetar Dependency Order y el Shutdown deberá respetar el orden seguro correspondiente. |
| EI-256 | Una Candidate Configuration inválida no deberá sustituir una Configuration activa válida. |
| EI-257 | Una instancia de Build fallida no deberá convertirse posteriormente en Build exitoso sin un nuevo intento identificable. |
| EI-258 | Las Transitions concurrentes incompatibles sobre una misma entidad deberán coordinarse o rechazarse. |
| EI-259 | Las rutas de Recovery deberán estar explícitamente definidas y no deberán inferirse arbitrariamente. |
| EI-260 | `Failed`, `Disabled`, `Degraded`, `Stopped` y `Removed` deberán conservar semánticas diferentes. |
| EI-261 | State, Health, Readiness y Liveness deberán mantenerse como conceptos distintos. |
| EI-262 | Las operaciones administrativas deberán expresar intención de transición y no asignar States directamente. |
| EI-263 | Las State Machines públicas deberán participar en Versioning cuando sus cambios afecten compatibilidad. |
| EI-264 | El estado persistido incompatible deberá migrarse o rechazarse explícitamente; no reinterpretarse silenciosamente. |
| EI-265 | Architectural State Machine y Domain State Machine deberán permanecer conceptualmente separadas. |

---

# 199. Criterios de Conformidad

Una implementación será conforme con ENG-015 cuando:

- identifique States explícitos;
- defina Transitions permitidas;
- rechace Transitions inválidas;
- implemente Guards;
- controle State Mutation;
- modele Failure;
- modele Recovery cuando corresponda;
- proteja concurrencia;
- respete Dependency Ordering;
- distinga Package y Module Lifecycle;
- soporte diagnóstico;
- integre Logging;
- permita Testing;
- mantenga State separado de Health;
- versione State Machines públicas;
- distinga Architectural State de Domain State.

---

# 200. Riesgos

Deberán evitarse especialmente:

## Boolean State Explosion

Representar Lifecycle mediante combinaciones como:

```text
isLoaded
isStarted
isStopped
isFailed
isEnabled
```

que pueden producir estados imposibles.

## Direct State Mutation

Permitir:

```text
state = Active
```

sin Guards ni Actions.

## Hidden Transition

Cambiar State como side effect no documentado.

## State Before Action

Declarar `Active` antes de terminar Initialization.

## Package/Module Confusion

Asumir:

```text
Installed = Active
```

## Failed = Disabled

Confundir fallo técnico con decisión administrativa.

## State = Health

Utilizar Lifecycle como único indicador de salud.

## Retry Everything

Reintentar automáticamente errores estructurales.

## Recovery Magic

Salir de Failed sin comprobar la causa.

## Concurrent Transition

Ejecutar Start y Stop simultáneamente sin coordinación.

## Domain Leakage

Introducir estados de negocio dentro del Lifecycle arquitectónico.

## Framework Lock-in

Atar MEF a una librería concreta de State Machine.

---

# 201. Arquitectura Recomendada

```text
                    Transition Request
                           │
                           ▼
                    Authorization
                           │
                           ▼
                     Current State
                           │
                           ▼
                    Transition Lookup
                           │
                           ▼
                         Guard
                           │
                    ┌──────┴──────┐
                    ▼             ▼
                  DENY          ALLOW
                    │             │
                    ▼             ▼
                  Error         Action
                                  │
                             ┌────┴────┐
                             ▼         ▼
                           FAIL      SUCCESS
                             │         │
                             ▼         ▼
                          Failure    Commit
                           Policy      │
                             │         ▼
                             │      Next State
                             │         │
                             └─────────┼─────────┐
                                       ▼         ▼
                                      Log       Event
```

---

# 202. State Machines Iniciales

La primera implementación debería formalizar al menos:

```text
Framework State Machine
Module State Machine
Package State Machine
Configuration State Machine
Build State Machine
```

Posteriormente:

```text
Release State Machine
Deployment State Machine
Plugin State Machine
```

cuando existan sus respectivas especificaciones.

---

# 203. Module State Machine Inicial

La primera versión debería implementar:

```text
Discovered
    ↓
Registered
    ↓
Resolved
    ↓
Initialized
    ↓
Active
    ↓
Stopping
    ↓
Stopped
```

más:

```text
Disabled
Failed
```

---

# 204. Regla de Activación

La transición crítica:

```text
Initialized
    ↓
 activate
    ↓
Active
```

deberá exigir:

```text
Configuration valid
AND
Required Contracts available
AND
Required dependencies compatible
AND
Security Guards satisfied
```

---

# 205. Regla de Package

La transición crítica:

```text
Downloaded
    ↓
 verify
    ↓
Verified
```

deberá completarse antes de cualquier ejecución de código no confiable contenido en el Package.

---

# 206. Regla de Configuration

La transición:

```text
Validated
    ↓
 activate
    ↓
Active
```

solo deberá sustituir la Configuration anterior después de validación exitosa.

---

# 207. Regla de Build

La secuencia:

```text
Created
   ↓
Resolving
   ↓
Validating
   ↓
Testing
   ↓
Building
   ↓
Packaging
   ↓
Verifying
   ↓
Succeeded
```

deberá detenerse ante un Quality Gate obligatorio fallido.

---

# 208. Principio Rector

> **El estado arquitectónico de MEF deberá ser explícito, observable y gobernado: ninguna entidad podrá alcanzar un nuevo State sin ejecutar una Transition válida, satisfacer sus Guards y completar las acciones necesarias para que dicho State sea verdadero.**

---

# 209. Conclusión

**ENG-015 — Architectural State Machine** convierte los Lifecycles de MEF en modelos verificables.

En lugar de:

```text
Module exists
Module starts
Module somehow fails
Module maybe stops
```

MEF define:

```text
Discovered
    ↓
Registered
    ↓
Resolved
    ↓
Initialized
    ↓
Active
    ↓
Stopping
    ↓
Stopped
```

y cada cambio posee:

```text
Current State
      ↓
Transition
      ↓
Guard
      ↓
Action
      ↓
Next State
```

Esto permite que el Framework responda formalmente preguntas como:

```text
¿Puede activarse este Module?
¿Por qué no puede activarse?
¿Qué transición falta?
¿Qué dependencia lo bloquea?
¿Puede recuperarse?
¿Puede detenerse?
¿En qué estado quedó después del fallo?
```

Y además crea una relación directa entre:

```text
Architecture
     │
     ▼
Lifecycle Specification
     │
     ▼
State Machine
     │
     ├── Static Validation
     ├── Runtime Enforcement
     ├── Testing
     ├── Diagnostics
     ├── Observability
     └── Documentation
```

Con ello, una regla arquitectónica deja de ser únicamente una frase documental y puede convertirse en una propiedad ejecutable y comprobable del Framework.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-006 — Registry
- ARQ-011 — Contracts
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-003 — Manifest
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-016 — Compatibility
- ENG-017 — Release Process