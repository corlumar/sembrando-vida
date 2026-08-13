---
id: ENG-010
titulo: Logging
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Logging
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-004
  - ENG-005
  - ENG-009
  - ARQ-008
  - ARQ-014
  - ARQ-016
relacionados:
  - ENG-011
  - ENG-012
  - ENG-015
keywords:
  - logging
  - logs
  - observability
  - diagnostics
  - correlation
  - structured logging
  - security
  - runtime
  - mef
---

# ENG-010

# Logging

## Estado

Accepted.

---

# 1. Propósito

Definir la especificación técnica del sistema de **Logging** de **MEF (Modular Enterprise Framework)**.

Logging proporciona registros estructurados sobre el comportamiento técnico del Framework y sus componentes para facilitar:

- diagnóstico;
- operación;
- observabilidad;
- investigación de fallos;
- correlación;
- mantenimiento;
- análisis técnico.

---

# 2. Declaración

Un Log representa una observación técnica acerca de la ejecución.

No representa necesariamente:

- un hecho de dominio;
- una evidencia de auditoría;
- una métrica;
- una traza distribuida;
- un mecanismo de persistencia.

La regla fundamental será:

> **Los Logs describen la ejecución; no gobiernan el comportamiento del sistema.**

---

# 3. Objetivos

El sistema de Logging deberá:

- proporcionar diagnóstico útil;
- registrar fallos técnicos relevantes;
- mantener contexto;
- permitir correlación;
- utilizar formatos procesables;
- proteger información sensible;
- permanecer desacoplado del dominio;
- soportar distintos destinos de salida;
- facilitar integración con sistemas de observabilidad.

---

# 4. Separación de Responsabilidades

MEF distinguirá conceptualmente:

```text
Logging
   │
   └── ¿Qué ocurrió técnicamente?

Audit
   │
   └── ¿Quién realizó una acción relevante?

Metrics
   │
   └── ¿Cuánto / con qué frecuencia / durante cuánto tiempo?

Tracing
   │
   └── ¿Cómo atravesó una operación varios componentes?

Domain Events
   │
   └── ¿Qué hecho funcional ocurrió?
```

Un mismo hecho podrá producir más de una señal, pero cada una conservará su responsabilidad.

---

# 5. Logging no es Event Bus

El Event Bus definido en `ARQ-008` permite comunicación desacoplada.

Logging proporciona observabilidad técnica.

No deberá utilizarse:

```text
log("CustomerCreated")
```

como sustituto de:

```text
publish(CustomerCreated)
```

cuando otros componentes deban reaccionar al hecho.

---

# 6. Logging no es Auditoría

Un Log ordinario podrá modificarse, rotarse o eliminarse conforme a políticas operativas.

Un registro de auditoría puede requerir:

- integridad;
- conservación;
- identidad del actor;
- controles adicionales;
- políticas regulatorias.

Por tanto:

```text
Technical Log
       ≠
Audit Record
```

---

# 7. Logging no es Métrica

Ejemplo:

```text
INFO Package installed
```

no sustituye una métrica como:

```text
packages_installed_total
```

Las métricas deberán modelarse como señales propias cuando corresponda.

---

# 8. Logging no es Tracing

Un `Correlation ID` puede vincular Logs.

Sin embargo, eso no convierte Logging automáticamente en Distributed Tracing.

Tracing podrá incorporar:

- Trace ID;
- Span ID;
- parent-child relationships;
- duration;
- topology.

---

# 9. Modelo Conceptual

```text
Component
    │
    ▼
Logger Contract
    │
    ▼
Logging Pipeline
    │
    ├── Enrichment
    ├── Filtering
    ├── Redaction
    ├── Formatting
    └── Routing
            │
            ▼
          Sink
```

Los componentes deberán depender del Contract, no del proveedor concreto de Logging.

---

# 10. Logger Contract

MEF deberá disponer de una abstracción de Logging cuando el componente necesite registrar información técnica.

Conceptualmente:

```text
Logger
```

deberá permitir registrar:

- nivel;
- mensaje;
- contexto;
- excepción o error;
- metadata estructurada.

La sintaxis exacta dependerá del perfil tecnológico.

---

# 11. Structured Logging

MEF favorecerá **Structured Logging**.

Ejemplo conceptual:

```json
{
  "level": "info",
  "event": "module.registered",
  "moduleId": "MOD-CRM",
  "version": "1.2.0"
}
```

frente a depender únicamente de:

```text
CRM module version 1.2.0 registered successfully
```

La representación humana podrá generarse adicionalmente.

---

# 12. Ventajas del Logging Estructurado

Permite:

- búsqueda;
- filtrado;
- agregación;
- correlación;
- análisis automático;
- reglas de alertamiento;
- integración con tooling.

Los campos importantes no deberán quedar ocultos exclusivamente dentro del texto del mensaje.

---

# 13. Evento Técnico de Log

Los registros relevantes podrán declarar un nombre técnico estable.

Ejemplos:

```text
module.registered
module.initialization.failed
manifest.validation.failed
package.installation.completed
framework.started
```

Estos identificadores pertenecen al sistema de Logging.

No deberán confundirse con `EVT-*` del Event Bus.

---

# 14. Niveles de Logging

MEF reconoce conceptualmente:

| Nivel | Uso |
|---|---|
| TRACE | Información extremadamente detallada |
| DEBUG | Diagnóstico de desarrollo |
| INFO | Operación normal relevante |
| WARN | Condición anómala recuperable |
| ERROR | Operación fallida |
| FATAL | Fallo crítico que compromete la ejecución |

Los perfiles podrán mapear estos niveles a las capacidades del proveedor utilizado.

---

# 15. TRACE

Deberá utilizarse para información de granularidad muy alta.

Ejemplo:

```text
Dependency candidate evaluated
```

Normalmente estará desactivado en producción salvo diagnóstico específico.

---

# 16. DEBUG

Podrá registrar:

- decisiones internas;
- resolución de dependencias;
- configuración efectiva no sensible;
- pasos de procesamiento.

No deberá utilizarse para información imprescindible de operación.

---

# 17. INFO

Representará acontecimientos técnicos normales que puedan ser relevantes operacionalmente.

Ejemplos:

```text
Framework started
Module registered
Package installed
Configuration loaded
```

---

# 18. WARN

Indica una condición inesperada que no impidió continuar.

Ejemplos:

```text
Deprecated configuration used
Optional dependency unavailable
Retry scheduled
```

Un `WARN` no deberá utilizarse para fallos definitivos.

---

# 19. ERROR

Representa una operación que no pudo completarse.

Ejemplos:

```text
Manifest validation failed
Package installation failed
Module initialization failed
```

El error deberá incluir contexto suficiente para diagnóstico.

---

# 20. FATAL

Deberá reservarse para situaciones donde:

- el Framework no pueda continuar;
- se comprometa integridad;
- el Runtime deba detenerse.

No deberá utilizarse como sinónimo de cualquier `ERROR`.

---

# 21. Selección del Nivel

El nivel deberá representar severidad técnica real.

Se evitará:

```text
INFO -> errores
ERROR -> advertencias
WARN -> mensajes rutinarios
```

La inconsistencia reduce el valor operacional de los Logs.

---

# 22. Contexto

Los Logs deberán incluir contexto estructurado cuando sea relevante.

Ejemplos:

```text
moduleId
packageId
contractId
correlationId
operation
version
duration
errorCode
```

---

# 23. Contexto Estable

Los nombres de campos utilizados públicamente por tooling deberán mantenerse consistentes.

Ejemplo:

```text
moduleId
```

no deberá alternar arbitrariamente con:

```text
module_id
module
modId
```

dentro del mismo perfil.

---

# 24. Correlation ID

Las operaciones compuestas deberían utilizar un identificador de correlación cuando resulte útil.

```text
Request
   │
   └── correlationId
          │
          ├── Module A
          ├── Event Bus
          ├── Module B
          └── Adapter
```

Esto permitirá vincular Logs relacionados sin acoplar funcionalmente los componentes.

---

# 25. Trace Context

Cuando exista Distributed Tracing, Logging debería poder incorporar:

```text
traceId
spanId
```

sin convertirse en responsable de administrar la traza.

---

# 26. Operation ID

Procesos largos o administrativos podrán utilizar un identificador propio.

Ejemplo:

```text
packageInstallationId
```

Esto permitirá seguir la operación completa.

---

# 27. Module Context

Los Logs emitidos desde Modules deberían incluir:

```text
moduleId
```

cuando sea relevante y esté disponible.

Ejemplo:

```json
{
  "event": "module.initialization.failed",
  "moduleId": "MOD-CRM"
}
```

---

# 28. Package Context

Las operaciones sobre Packages deberían incluir:

```text
packageId
packageVersion
```

cuando corresponda.

---

# 29. Error Codes

Los errores que dispongan de identificador estable deberán incluirlo.

Ejemplo:

```json
{
  "level": "error",
  "errorCode": "MEF-MAN-004",
  "event": "manifest.validation.failed"
}
```

Esto facilita búsqueda y automatización.

---

# 30. Excepciones

Cuando exista una excepción o error técnico deberá conservarse, cuando sea seguro:

- tipo;
- mensaje;
- causa;
- stack trace;
- error code;
- contexto.

La representación dependerá del entorno.

---

# 31. Stack Traces

Los stack traces deberán utilizarse principalmente para diagnóstico.

No deberán exponerse automáticamente a usuarios finales.

Podrán contener:

- rutas;
- nombres internos;
- detalles técnicos;
- datos sensibles accidentales.

---

# 32. Message Templates

Los mensajes deberían utilizar estructuras relativamente estables.

Ejemplo:

```text
"Module {moduleId} registered"
```

con:

```json
{
  "moduleId": "MOD-CRM"
}
```

Se favorecerá mantener propiedades estructuradas por separado.

---

# 33. Logging de Objetos

No deberán serializarse objetos completos indiscriminadamente.

Esto puede provocar:

- fuga de secretos;
- exposición de datos personales;
- Logs gigantes;
- ciclos de serialización;
- alto costo.

Deberá registrarse únicamente la información necesaria.

---

# 34. Datos Sensibles

Los Logs no deberán contener en texto claro:

```text
Passwords
Authentication Tokens
API Keys
Private Keys
Session Secrets
Database Credentials
```

---

# 35. Información Personal

La información personal deberá minimizarse.

Cuando sea necesario registrar identificadores para diagnóstico deberán evaluarse:

- necesidad;
- retención;
- acceso;
- regulación;
- anonimización o pseudonimización.

---

# 36. Redaction

El Logging Pipeline deberá poder aplicar reglas de redacción.

Ejemplo conceptual:

```text
token: "abc123..."
```

deberá convertirse en:

```text
token: "[REDACTED]"
```

antes de persistirse.

---

# 37. Redaction antes del Sink

La protección de secretos deberá ocurrir antes de enviar el Log al destino.

```text
Log Event
   ↓
Redaction
   ↓
Sink
```

No deberá asumirse que el proveedor externo protegerá automáticamente la información.

---

# 38. Allowlist sobre Blocklist

Cuando sea viable, para objetos sensibles se favorecerá registrar campos permitidos explícitamente frente a intentar eliminar posteriormente todos los campos peligrosos.

---

# 39. Security Logging

Los eventos técnicos relacionados con seguridad podrán registrarse.

Ejemplos:

```text
authentication.failed
package.signature.invalid
extension.permission.denied
```

Sin embargo, aquellos que requieran evidencia formal deberán también utilizar el sistema de Auditoría correspondiente.

---

# 40. Logging de Configuración

Podrá registrarse que una configuración fue cargada.

No deberán registrarse valores secretos.

Preferido:

```text
Configuration loaded from source X.
```

Evitar:

```text
DATABASE_PASSWORD=...
```

---

# 41. Effective Configuration

El sistema podrá permitir inspeccionar configuración efectiva con valores sensibles enmascarados.

Esto puede facilitar diagnóstico sin comprometer secretos.

---

# 42. Logging de Manifest

Podrán registrarse:

- Manifest ID;
- versión;
- Schema;
- resultado de validación.

No deberá registrarse innecesariamente todo el documento.

---

# 43. Logging del Lifecycle

Las transiciones importantes podrán producir Logs técnicos.

Ejemplos:

```text
framework.booting
framework.ready
framework.stopping
framework.stopped
```

Esto es independiente de los Lifecycle Events utilizados internamente por el Framework.

---

# 44. Logging del Kernel

El Kernel deberá registrar únicamente información útil sobre coordinación.

No deberá producir un Log por cada operación trivial si eso genera ruido excesivo.

---

# 45. Logging del Registry

Podrá registrar:

```text
component.registered
component.deprecated
registration.failed
```

según necesidad operacional.

---

# 46. Logging del Container

Podrá registrar a niveles `TRACE` o `DEBUG`:

```text
contract.resolved
service.created
resolution.failed
```

Se deberá evitar generar grandes volúmenes de INFO durante resolución normal.

---

# 47. Logging del Event Bus

Podrá registrar:

- fallo de dispatch;
- listener fallido;
- evento descartado;
- latencia relevante.

No deberá registrar indiscriminadamente cada payload completo.

---

# 48. Logging de Generators

ENG-008 podrá registrar:

- Generator utilizado;
- Template version;
- target;
- resultado;
- errores.

No deberá registrar secretos incluidos accidentalmente en inputs.

---

# 49. Logging del CLI

El CLI deberá distinguir:

```text
Console Output
```

de:

```text
Technical Logging
```

Un mensaje mostrado al desarrollador no deberá considerarse automáticamente un Log persistente.

---

# 50. Logging de Tests

Las pruebas no deberían depender excesivamente del texto exacto de Logs.

Cuando se pruebe Logging deberá favorecerse verificar:

- nivel;
- event name;
- código;
- propiedades estructuradas.

---

# 51. Logging Pipeline

El pipeline conceptual será:

```text
Log Request
    │
    ▼
Level Evaluation
    │
    ▼
Context Enrichment
    │
    ▼
Sensitive Data Redaction
    │
    ▼
Filtering
    │
    ▼
Formatting
    │
    ▼
Routing
    │
    ▼
Sink
```

El orden concreto podrá adaptarse si preserva las garantías.

---

# 52. Enrichment

Podrán añadirse automáticamente campos como:

```text
timestamp
application
environment
moduleId
correlationId
traceId
host
runtimeVersion
```

cuando estén disponibles.

---

# 53. Timestamp

Todo registro persistente deberá incluir timestamp.

El formato deberá:

- evitar ambigüedad;
- declarar timezone/offset cuando corresponda;
- favorecer interoperabilidad.

ISO 8601 será una representación apropiada cuando el formato lo permita.

---

# 54. Timestamp Source

La fuente temporal debería ser coherente dentro del proceso.

Cuando Testing requiera control temporal podrá utilizarse un `Clock Contract`.

---

# 55. Environment

Los Logs deberían identificar el entorno cuando sea relevante:

```text
development
test
staging
production
```

Se deberá evitar mezclar Logs de entornos sin poder distinguirlos.

---

# 56. Application Identity

Cuando múltiples Applications utilicen MEF, los Logs deberían identificar la aplicación o servicio emisor cuando corresponda.

---

# 57. Runtime Identity

En sistemas distribuidos podrá resultar útil registrar:

```text
instanceId
host
containerId
region
```

según el entorno operativo.

Estos campos no son universalmente obligatorios.

---

# 58. Sink

Un Sink representa el destino de Logs.

Ejemplos conceptuales:

```text
Console
File
System Log
Remote Collector
Observability Platform
```

MEF no deberá acoplarse conceptualmente a un proveedor específico.

---

# 59. Multiple Sinks

El Logging Pipeline podrá enviar registros a múltiples destinos cuando corresponda.

Ejemplo:

```text
ERROR → Console + Remote Collector
DEBUG → Local File
```

Las reglas deberán ser configurables y explícitas.

---

# 60. Sink Failure

Un fallo en un Sink no deberá provocar automáticamente una caída del Framework salvo que Logging sea crítico para ese contexto.

La estrategia deberá considerar:

- fallback;
- buffer;
- pérdida controlada;
- diagnóstico.

---

# 61. Logging Failure

La aplicación deberá evitar recursión como:

```text
Logging fails
   ↓
Log logging failure
   ↓
Logging fails
   ↓
...
```

El sistema deberá disponer de una estrategia mínima de fallback.

---

# 62. Fallback

Cuando el sistema principal de Logging falle, podrá utilizarse un mecanismo simple como:

```text
stderr
```

o equivalente del Runtime.

---

# 63. Buffering

Los Sinks podrán utilizar buffering para rendimiento.

La política deberá considerar riesgo de pérdida ante fallo.

---

# 64. Flush

Durante Graceful Shutdown deberán vaciarse buffers relevantes cuando sea razonablemente posible.

Esto deberá integrarse con `ARQ-014`.

---

# 65. Async Logging

Logging podrá realizarse de forma asíncrona.

No deberá alterar el orden semántico necesario ni comprometer la estabilidad.

Los fallos deberán manejarse explícitamente.

---

# 66. Performance

El Logging no deberá introducir una sobrecarga desproporcionada.

Se deberán evitar especialmente:

- serialización pesada innecesaria;
- construcción costosa de mensajes deshabilitados;
- I/O síncrono excesivo;
- Logging dentro de loops críticos sin necesidad.

---

# 67. Lazy Evaluation

Cuando el Runtime lo permita, los datos costosos de Logging deberían calcularse únicamente si el nivel correspondiente está habilitado.

---

# 68. Sampling

En sistemas de alto volumen podrá utilizarse sampling para determinados Logs.

No deberá aplicarse a eventos críticos que requieran registro completo sin una política explícita.

---

# 69. Rate Limiting

Los Logs repetitivos podrán limitarse para evitar:

```text
log storms
```

especialmente ante fallos persistentes.

La reducción deberá ser observable.

---

# 70. Duplicate Suppression

La supresión de duplicados podrá utilizarse cuando preserve suficiente evidencia diagnóstica.

---

# 71. Retention

La retención corresponde principalmente a operación.

Sin embargo, las implementaciones deberán permitir políticas sobre:

- tiempo;
- tamaño;
- rotación;
- almacenamiento.

No se deberá asumir retención infinita.

---

# 72. Rotation

Los Sinks basados en archivos deberán soportar políticas de rotación cuando sea necesario.

La estrategia concreta depende del entorno.

---

# 73. Log Integrity

Los Logs ordinarios no deberán presentarse como evidencia inmutable si el sistema no garantiza realmente dicha propiedad.

Si se requiere integridad fuerte deberá utilizarse Auditoría u otro mecanismo adecuado.

---

# 74. Searchability

Los campos estructurados deberán facilitar búsquedas como:

```text
moduleId = MOD-CRM
errorCode = MEF-MAN-004
correlationId = ...
```

Esto justifica mantener nombres de campos consistentes.

---

# 75. Observability Integration

Logging deberá diseñarse para integrarse con una arquitectura más amplia:

```text
           Observability
          /      |       \
         /       |        \
      Logs     Metrics    Traces
```

Ninguna señal deberá intentar sustituir completamente a las demás.

---

# 76. Open Interfaces

MEF deberá favorecer Contracts y formatos abiertos para integrar Logging con herramientas externas.

No deberá convertir un vendor específico en requisito arquitectónico.

---

# 77. Configuration

El Logging deberá ser configurable.

Podrán configurarse:

- nivel;
- sinks;
- filtros;
- formato;
- redaction;
- sampling;
- buffering.

ENG-011 definirá la representación de Configuration Files.

---

# 78. Default Level

El nivel por defecto deberá ser razonable y seguro.

La primera implementación podría utilizar:

```text
INFO
```

para producción y:

```text
DEBUG
```

para desarrollo.

Sin embargo, esto corresponderá al perfil de implementación.

---

# 79. Runtime Level Changes

Un Runtime podrá permitir modificar niveles sin reiniciar completamente.

Esta capacidad deberá controlarse y ser observable.

---

# 80. Module Logging Configuration

Los Modules podrán declarar niveles o categorías específicas cuando el sistema lo soporte.

Se deberá evitar que cada Module configure independientemente toda la infraestructura de Logging.

---

# 81. Logger Ownership

La infraestructura de Logging deberá pertenecer a Platform o al componente técnico correspondiente.

Los Modules serán consumidores.

No deberán instalar arbitrariamente proveedores globales de Logging durante Runtime.

---

# 82. Categories

Los Logs podrán organizarse por categorías.

Ejemplos:

```text
mef.kernel
mef.registry
mef.container
mef.module.crm
mef.package
```

La nomenclatura deberá respetar ENG-005.

---

# 83. Event Names vs Categories

Se distinguirá:

```text
category: mef.module
event: module.registered
```

La categoría identifica origen o contexto.

El evento técnico describe aquello que ocurrió.

---

# 84. Schema de Log

MEF podrá definir un Schema mínimo de Log estructurado.

Ejemplo conceptual:

```json
{
  "timestamp": "2026-08-10T14:00:00Z",
  "level": "info",
  "event": "module.registered",
  "message": "Module registered",
  "context": {
    "moduleId": "MOD-CRM"
  }
}
```

La especificación exacta podrá evolucionar.

---

# 85. Campos Mínimos

Un Log estructurado persistente debería contener cuando corresponda:

```text
timestamp
level
event or message
context
```

Otros campos serán añadidos según necesidad.

---

# 86. Schema Version

Si MEF publica formalmente un esquema interoperable de Logs, deberá versionarse.

Esto será importante si herramientas externas dependen de la estructura.

---

# 87. Machine Readability

La salida destinada a collectors deberá ser procesable por máquinas.

La presentación de consola podrá ser más amigable para humanos.

---

# 88. Human Readability

La información relevante deberá continuar siendo comprensible por personas.

Structured Logging no deberá producir únicamente estructuras crípticas sin mensaje diagnóstico útil.

---

# 89. Localization

Los identificadores técnicos de Logs deberán permanecer estables e independientes del idioma.

Ejemplo:

```text
module.registered
```

El mensaje humano podría traducirse posteriormente sin afectar tooling.

---

# 90. Testing

El Logging deberá poder probarse mediante un Logger de test.

Ejemplo conceptual:

```text
InMemoryLogger
```

o:

```text
LoggerSpy
```

Esto evita depender de archivos reales.

---

# 91. Logging Contract Tests

Si existen múltiples proveedores, podrán ejecutarse Contract Tests para verificar capacidades mínimas como:

- niveles;
- contexto;
- errores;
- redaction;
- formatting expectations.

---

# 92. Redaction Tests

Deberán existir pruebas negativas que aseguren que datos sensibles no llegan a los Sinks.

Ejemplo:

```text
Given token
When logging context
Then token is redacted
```

---

# 93. Error Logging Tests

Los errores críticos deberán probar que incluyen contexto suficiente sin filtrar datos sensibles.

---

# 94. Correlation Tests

Cuando una operación utilice correlación deberá verificarse que `correlationId` se propaga a través de los límites definidos.

---

# 95. Lifecycle Logging Tests

Podrá verificarse:

```text
Framework starts → framework.started emitted
Framework stops → framework.stopped emitted
```

sin depender necesariamente del mensaje humano exacto.

---

# 96. Health Diagnostics

Los Logs podrán complementar Health Checks.

No deberán sustituir un modelo explícito de Health.

---

# 97. Diagnostic Bundle

En el futuro MEF podrá generar un paquete de diagnóstico compuesto por:

- metadata de Runtime;
- configuración enmascarada;
- Logs recientes;
- estado del Registry;
- versiones.

Deberá excluir secretos.

---

# 98. CLI Diagnostics

`mef doctor` podrá utilizar Logs y diagnósticos, pero no deberá requerir acceder a información sensible innecesaria.

---

# 99. Development Logging

En desarrollo podrá utilizarse mayor detalle.

Sin embargo, también en desarrollo deberán mantenerse reglas de protección de secretos.

---

# 100. Production Logging

Producción deberá favorecer:

- información operacional útil;
- volumen controlado;
- Structured Logging;
- seguridad;
- correlación;
- rendimiento.

---

# 101. Debug Mode

Activar Debug no deberá desactivar automáticamente:

- redaction;
- controles de seguridad;
- protección de secretos.

---

# 102. Error Boundaries

Los componentes deberán registrar fallos en el límite apropiado.

Se deberá evitar registrar el mismo error en cada capa.

Ejemplo negativo:

```text
Repository logs ERROR
Service logs same ERROR
Controller logs same ERROR
Global Handler logs same ERROR
```

Esto genera duplicación.

---

# 103. Single Responsible Logging Point

Cuando un error se propague, deberá definirse qué límite es responsable de registrarlo.

Las capas internas podrán añadir contexto al error sin necesariamente escribir Logs redundantes.

---

# 104. Log and Rethrow

El patrón:

```text
log error
throw error
```

deberá utilizarse cuidadosamente para evitar doble registro.

---

# 105. Expected Errors

Los errores esperados de negocio no deberán registrarse automáticamente como `ERROR` técnico.

Ejemplo:

```text
Customer validation rejected
```

puede ser comportamiento funcional válido.

La severidad dependerá del contexto.

---

# 106. Exceptions as Logs

Una excepción no es automáticamente un Log.

El sistema deberá decidir si y dónde registrarla.

---

# 107. Logging Contracts Públicos

La semántica interna de Logging no debería formar parte de Contracts públicos de negocio salvo que exista una razón explícita.

Los consumidores no deberán depender de que una operación produzca un texto exacto de Log.

---

# 108. Audit Boundary

Cuando una operación requiera evidencia de seguridad o cumplimiento:

```text
Business Operation
     │
     ├── Technical Log
     └── Audit Record
```

podrán generarse ambas señales.

No deberán mezclarse sus políticas de retención o integridad.

---

# 109. Compliance

Las reglas de Logging verificables deberán incorporarse a Testing y CI.

Ejemplos:

```text
No secrets in test logs
Required structured fields present
Valid levels
Valid event names
```

---

# 110. Static Analysis

Las herramientas podrán detectar patrones inseguros como:

```text
logger.info(password)
logger.debug(token)
```

cuando el lenguaje permita análisis suficiente.

---

# 111. Log Linter

MEF podrá desarrollar un `Log Linter` para validar:

- nombres de Events;
- campos reservados;
- estructura;
- categorías;
- uso de niveles.

---

# 112. Invariantes de Ingeniería

ENG-010 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-146 | Logging deberá utilizarse para observabilidad técnica y no como mecanismo de comunicación funcional. |
| EI-147 | Logging no sustituirá al Event Bus, Audit, Metrics o Tracing. |
| EI-148 | Los Logs persistentes deberán incluir timestamp y severidad cuando corresponda. |
| EI-149 | Los secretos no deberán registrarse en texto claro. |
| EI-150 | La información sensible deberá minimizarse y protegerse antes de alcanzar un Sink. |
| EI-151 | Los Logs estructurados deberán utilizar nombres de campos consistentes. |
| EI-152 | Los componentes deberán depender de una abstracción de Logging cuando la arquitectura requiera desacoplamiento del proveedor. |
| EI-153 | Los Modules no deberán sustituir arbitrariamente la infraestructura global de Logging. |
| EI-154 | Los errores no deberán registrarse repetidamente en múltiples capas sin aportar contexto distinto. |
| EI-155 | El nivel asignado a un Log deberá representar su severidad técnica real. |
| EI-156 | El modo Debug no deberá desactivar protección de secretos. |
| EI-157 | Los Logs no deberán presentar garantías de integridad o auditoría que el sistema no proporcione. |
| EI-158 | Los identificadores técnicos de Log destinados a tooling deberán mantenerse estables. |
| EI-159 | El Logging deberá permitir correlación cuando una operación atraviese múltiples componentes y ésta sea técnicamente relevante. |
| EI-160 | Los Sinks deberán permanecer sustituibles sin modificar la lógica funcional. |
| EI-161 | Los fallos de Logging deberán disponer de una estrategia que evite recursión infinita. |
| EI-162 | Las operaciones de Shutdown deberán intentar finalizar apropiadamente buffers de Logging cuando corresponda. |
| EI-163 | Las reglas de redaction deberán disponer de pruebas para información sensible relevante. |
| EI-164 | La configuración de Logging deberá ser explícita y no contener secretos. |
| EI-165 | Los Logs destinados a automatización deberán ser procesables sin depender exclusivamente de texto humano. |

---

# 113. Criterios de Conformidad

Una implementación será conforme con ENG-010 cuando:

- diferencie Logging de Audit, Metrics, Tracing y Events;
- utilice niveles coherentes;
- proteja secretos;
- soporte contexto estructurado;
- permita correlación;
- mantenga Sinks desacoplados;
- gestione fallos del sistema de Logging;
- evite duplicación excesiva;
- pueda probar redaction;
- respete configuración;
- permita salida procesable por máquinas cuando corresponda.

---

# 114. Riesgos

Deberán evitarse especialmente:

## Log Everything

Registrar todo indiscriminadamente hasta volver inútil la señal.

## Log Nothing

Carecer de información suficiente para diagnóstico.

## Secret Leakage

Exponer credenciales o información sensible.

## String-only Logging

Ocultar todo contexto dentro de mensajes imposibles de procesar.

## Double Logging

Registrar repetidamente el mismo error.

## Logging as Audit

Asumir garantías que los Logs ordinarios no proporcionan.

## Logging as Event Bus

Acoplar comportamiento funcional a lectura de Logs.

## Vendor Lock-in

Diseñar componentes alrededor de una plataforma concreta de observabilidad.

## Production Debug Forever

Mantener volumen y detalle excesivos permanentemente.

---

# 115. Arquitectura Recomendada

La primera implementación debería aproximarse a:

```text
Components
     │
     ▼
Logger Contract
     │
     ▼
Logging Service
     │
     ▼
Context Enricher
     │
     ▼
Redaction
     │
     ▼
Filter
     │
     ▼
Formatter
     │
     ▼
Sink Adapter
```

Esto mantiene separación entre:

- API;
- procesamiento;
- seguridad;
- representación;
- transporte.

---

# 116. Principio Rector

> **El Logging de MEF deberá proporcionar observabilidad técnica estructurada, segura y correlacionable sin convertirse en un mecanismo de negocio, auditoría, comunicación o dependencia de un proveedor específico.**

---

# 117. Conclusión

**ENG-010 — Logging** establece el sistema oficial mediante el cual MEF registra información técnica sobre su ejecución.

La arquitectura resultante será:

```text
Runtime
   │
   ▼
Technical Signals
   │
   ├── Logs
   ├── Metrics
   ├── Traces
   └── Audit
```

Cada señal conserva una responsabilidad distinta.

Logging permitirá comprender:

```text
qué ocurrió,
dónde ocurrió,
cuándo ocurrió,
en qué contexto ocurrió,
y por qué falló técnicamente
```

sin comprometer secretos ni transformar el registro técnico en una fuente de comportamiento funcional.

---

# Referencias

## Arquitectura

- ARQ-003 — Platform
- ARQ-008 — Event Bus
- ARQ-013 — Configuration
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-015 — Architectural State Machine