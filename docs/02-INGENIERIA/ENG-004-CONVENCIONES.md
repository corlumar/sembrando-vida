---
id: ENG-004
titulo: Convenciones
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Convenciones
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-001
  - ENG-002
  - ENG-003
  - FND-013
relacionados:
  - ENG-005
  - ENG-006
  - ENG-007
  - ENG-009
  - ENG-011
  - ENG-014
keywords:
  - conventions
  - standards
  - consistency
  - code
  - interfaces
  - errors
  - documentation
  - portability
  - mef
---

# ENG-004

# Convenciones

## Estado

Accepted.

---

# 1. Propósito

Definir las convenciones generales de Ingeniería que deberán observar las implementaciones de **MEF (Modular Enterprise Framework)**.

Estas convenciones establecen un lenguaje técnico común para reducir ambigüedad, mejorar consistencia y facilitar:

- comprensión;
- interoperabilidad;
- automatización;
- validación;
- mantenimiento;
- portabilidad;
- evolución.

---

# 2. Declaración

Toda implementación conforme con MEF deberá respetar un conjunto explícito de convenciones técnicas.

Las convenciones no deberán depender innecesariamente de:

- un lenguaje;
- un framework;
- un sistema operativo;
- un proveedor;
- una herramienta concreta.

Cuando una implementación necesite convenciones específicas de plataforma, estas deberán declararse como reglas adicionales y no como fundamentos universales de MEF.

---

# 3. Objetivo

Las convenciones tienen como objetivo reducir decisiones accidentales.

Sin convenciones:

```text
Developer A → solución A
Developer B → solución B
Developer C → solución C
```

Con convenciones:

```text
MEF Engineering Rules
        │
        ▼
Consistent Implementations
```

La consistencia facilita que personas y herramientas puedan comprender una implementación sin depender de conocimiento implícito.

---

# 4. Alcance

ENG-004 establece convenciones generales relacionadas con:

- claridad;
- consistencia;
- explicitud;
- organización;
- interfaces;
- dependencias;
- errores;
- configuración;
- datos;
- Events;
- Commands;
- Queries;
- Contracts;
- documentación;
- pruebas;
- seguridad;
- observabilidad;
- compatibilidad;
- automatización.

---

# 5. Fuera de Alcance

ENG-004 no define exhaustivamente:

- nomenclatura concreta;
- estructura física de directorios;
- sintaxis específica de un lenguaje;
- estilo particular de un formatter;
- comandos concretos del CLI;
- formato completo de configuración;
- estrategia completa de Testing;
- reglas detalladas de versionado.

Estos aspectos corresponden a documentos especializados.

---

# 6. Principio de Explicitud

MEF favorecerá lo explícito frente a lo implícito.

Se favorecerá:

```text
Declared Dependency
Declared Contract
Declared Configuration
Declared Capability
Declared Version
```

frente a:

```text
Hidden Dependency
Implicit Contract
Magic Configuration
Undocumented Capability
Unknown Version
```

Una implementación no deberá depender de conocimiento oculto para funcionar correctamente.

---

# 7. Principio de Consistencia

Una misma situación deberá resolverse utilizando el mismo patrón cuando no exista una razón técnica suficiente para hacerlo de otra manera.

La consistencia deberá prevalecer sobre preferencias individuales.

> Una convención imperfecta pero consistente puede ser más mantenible que múltiples soluciones individualmente razonables pero incompatibles.

---

# 8. Principio de Intención

El código y los artefactos deberán expresar intención.

Se favorecerán estructuras que permitan comprender:

- qué hace un elemento;
- qué responsabilidad posee;
- quién puede utilizarlo;
- de qué depende;
- qué produce.

La intención deberá ser visible sin necesidad de inspeccionar toda la implementación.

---

# 9. Principio de Menor Sorpresa

Los componentes deberán comportarse de forma coherente con:

- su nombre;
- su Contract;
- su documentación;
- su tipo;
- sus efectos declarados.

Una operación aparentemente de lectura no deberá producir efectos funcionales inesperados.

---

# 10. Principio de Simplicidad

Las implementaciones deberán utilizar la solución más simple que satisfaga correctamente:

- Arquitectura;
- Contracts;
- seguridad;
- mantenibilidad;
- requisitos funcionales.

La simplicidad no deberá confundirse con omitir validaciones o límites necesarios.

---

# 11. Convenciones Normativas

Los documentos de Ingeniería podrán utilizar los términos:

| Término | Significado |
|---|---|
| DEBERÁ | Requisito obligatorio |
| NO DEBERÁ | Prohibición |
| DEBERÍA | Recomendación fuerte |
| NO DEBERÍA | Práctica desaconsejada |
| PODRÁ | Opción permitida |

Las implementaciones conformes deberán interpretar estos términos de forma consistente.

---

# 12. Convención de Identidad

Los artefactos arquitectónicamente relevantes deberán poseer identidad estable cuando corresponda.

Ejemplos:

```text
Module
Contract
Event
Extension Point
Package
```

La identidad lógica no deberá depender exclusivamente de:

- nombre de clase;
- ruta;
- nombre del archivo;
- dirección física;
- posición en el repositorio.

---

# 13. Convención de Nombres

Todo nombre deberá favorecer:

- claridad;
- intención;
- estabilidad;
- precisión;
- ausencia de ambigüedad.

Se evitarán nombres genéricos como:

```text
Manager
Helper
Utils
Thing
Object
Misc
Data
Processor
```

cuando no expresen adecuadamente una responsabilidad.

Las reglas concretas serán definidas en **ENG-005 — Nomenclatura**.

---

# 14. Convención de Abreviaturas

Las abreviaturas deberán utilizarse únicamente cuando:

- sean oficiales;
- estén documentadas;
- sean ampliamente reconocibles dentro de MEF;
- reduzcan longitud sin destruir significado.

Ejemplos aceptables dentro del contexto MEF podrán incluir:

```text
MEF
API
CLI
DTO
ID
```

No deberán introducirse abreviaturas locales ambiguas sin definición.

---

# 15. Convención de Idioma

La documentación conceptual podrá mantenerse en español conforme a la política editorial del proyecto.

Los identificadores técnicos destinados a interoperabilidad internacional podrán utilizar inglés cuando así lo determine la especificación correspondiente.

La elección deberá ser consistente dentro de cada categoría de artefactos.

No deberán mezclarse idiomas arbitrariamente dentro del mismo sistema de nomenclatura.

---

# 16. Convención de APIs Públicas

Toda API pública deberá ser:

- explícita;
- mínima;
- estable;
- documentada;
- versionable;
- testeable.

Por defecto, los detalles de implementación deberán considerarse internos.

```text
Public by intention
Internal by default
```

---

# 17. Convención de Contracts

Los Contracts deberán:

- expresar una responsabilidad concreta;
- evitar detalles de implementación;
- mantenerse pequeños cuando sea posible;
- documentar comportamiento observable;
- declarar expectativas relevantes;
- permitir implementaciones alternativas.

Un Contract no deberá existir únicamente para ocultar una clase sin proporcionar una abstracción real.

---

# 18. Convención de Dependencias

Toda dependencia significativa deberá ser:

- explícita;
- justificable;
- versionable cuando corresponda;
- reemplazable cuando la arquitectura lo requiera;
- observable mediante herramientas cuando sea posible.

Las dependencias globales ocultas deberán evitarse.

---

# 19. Convención de Inyección

Cuando una dependencia forme parte de la colaboración necesaria de un componente, deberá proporcionarse mediante mecanismos explícitos.

Conceptualmente:

```text
Consumer
   │
   ▼
Contract
   ▲
   │
Implementation
```

La implementación concreta podrá utilizar:

- constructor;
- factory;
- container;
- provider;
- mecanismo equivalente.

La técnica específica dependerá del Runtime.

---

# 20. Convención de Estado Global

El estado global mutable deberá evitarse.

Cuando sea inevitable deberá:

- estar encapsulado;
- poseer propietario;
- tener ciclo de vida conocido;
- ser observable;
- permitir pruebas controladas.

No deberán utilizarse variables globales como mecanismo ordinario de integración entre Modules.

---

# 21. Convención de Mutabilidad

MEF favorecerá datos inmutables para artefactos que representen hechos o mensajes.

Especialmente:

```text
Events
Value Objects
Configuration Snapshots
Messages
```

La mutabilidad deberá introducirse únicamente cuando exista una necesidad clara.

---

# 22. Convención de Events

Un Event representa un hecho que ya ocurrió.

Por tanto, deberá expresarse conceptualmente en pasado.

Ejemplos:

```text
CustomerCreated
InvoiceApproved
PaymentRegistered
```

No deberá representar una orden.

Incorrecto conceptualmente:

```text
CreateCustomerEvent
```

cuando la intención real sea solicitar una acción.

---

# 23. Convención de Commands

Un Command representa intención de ejecutar una operación.

Deberá expresarse como una acción.

Ejemplos:

```text
CreateCustomer
ApproveInvoice
RegisterPayment
```

Un Command podrá ser rechazado.

Un Event representa un hecho ya ocurrido.

---

# 24. Convención de Queries

Una Query representa una solicitud de información.

Deberá evitar efectos secundarios funcionales.

Ejemplos:

```text
GetCustomer
FindInvoice
ListPayments
```

Se deberá preservar conceptualmente:

```text
Command → change
Query   → read
Event   → fact
```

---

# 25. Convención de DTO

Un DTO deberá utilizarse para transportar datos entre límites cuando sea necesario.

Un DTO:

- no deberá contener lógica de negocio significativa;
- deberá tener propósito claro;
- deberá representar una estructura de intercambio;
- no deberá convertirse automáticamente en modelo de dominio.

---

# 26. Convención de Value Objects

Un Value Object deberá representar un concepto mediante su valor y no mediante identidad propia.

Debería:

- validar sus invariantes;
- favorecer inmutabilidad;
- encapsular reglas propias;
- evitar estados inválidos.

Ejemplos conceptuales:

```text
Email
Money
DateRange
Coordinates
```

---

# 27. Convención de Servicios

Un Service deberá representar una capacidad o responsabilidad concreta.

Se evitarán servicios genéricos excesivamente amplios como:

```text
ApplicationService
GeneralService
CommonService
ManagerService
```

cuando acumulen responsabilidades no relacionadas.

---

# 28. Convención de Providers

Los Providers deberán utilizarse para composición e integración técnica.

Podrán:

- registrar implementaciones;
- registrar listeners;
- registrar configuración;
- registrar capacidades.

No deberán contener lógica de negocio.

---

# 29. Convención de Adapters

Los Adapters deberán encapsular interacción con tecnologías o sistemas externos.

```text
MEF Contract
      │
      ▼
Adapter
      │
      ▼
External System
```

El resto del Framework no deberá depender innecesariamente de detalles propios del proveedor externo.

---

# 30. Convención de Repositories

Cuando se utilice el patrón Repository, este deberá representar acceso a una colección o mecanismo de persistencia desde la perspectiva del consumidor.

El Contract no deberá exponer innecesariamente:

- SQL;
- ORM;
- driver;
- proveedor;
- detalles físicos de almacenamiento.

---

# 31. Convención de Factories

Una Factory deberá utilizarse cuando la construcción de un objeto requiera conocimiento que no deba recaer directamente sobre el consumidor.

No deberá utilizarse una Factory cuando una construcción directa sea suficiente y más clara.

---

# 32. Convención de Builders

Un Builder deberá utilizarse cuando la construcción implique:

- múltiples etapas;
- composición compleja;
- configuración progresiva;
- validación previa a construcción.

No deberá introducirse únicamente para ocultar constructores simples.

---

# 33. Convención de Errores

Los errores deberán:

- ser explícitos;
- ser clasificables;
- proporcionar contexto suficiente;
- evitar filtrar información sensible;
- ser trazables.

Se evitarán errores genéricos sin significado técnico.

---

# 34. Códigos de Error

Los errores relevantes para interoperabilidad podrán disponer de identificadores estables.

Ejemplo conceptual:

```text
MEF-MAN-001
MEF-MOD-001
MEF-REG-001
MEF-CFG-001
```

Un código de error deberá mantener significado estable dentro de una versión compatible.

---

# 35. Excepciones

Cuando el lenguaje soporte excepciones, deberán utilizarse para representar situaciones excepcionales y no como mecanismo ordinario de control de flujo.

Las excepciones deberán preservar:

- causa;
- contexto;
- trazabilidad.

No deberán capturarse silenciosamente.

---

# 36. Fallos Explícitos

Se evitará:

```text
try
    operation
catch
    ignore
```

salvo que ignorar el error constituya un comportamiento explícitamente diseñado, documentado y observable.

---

# 37. Convención Fail Fast

Cuando una condición invalide de forma inequívoca una operación, deberá detectarse lo antes razonablemente posible.

Ejemplos:

- Manifest inválido;
- dependencia inexistente;
- versión incompatible;
- configuración inválida.

Se evitará trasladar errores estructurales hasta fases tardías del Runtime.

---

# 38. Convención de Configuración

La configuración deberá:

- ser explícita;
- ser validable;
- poseer defaults cuando corresponda;
- documentarse;
- separarse del código cuando represente variabilidad operativa.

No deberán existir parámetros mágicos ocultos en la implementación.

---

# 39. Convención de Secretos

Los secretos deberán mantenerse separados de:

- código fuente;
- Manifest;
- documentación;
- repositorio;
- logs.

Ejemplos:

```text
Passwords
Tokens
API Keys
Private Keys
Credentials
```

---

# 40. Convención de Valores por Defecto

Los valores por defecto deberán ser:

- seguros;
- previsibles;
- documentados.

Un default no deberá activar silenciosamente capacidades sensibles.

---

# 41. Convención de Datos Nulos

El uso de valores nulos deberá ser explícito.

Una API deberá diferenciar conceptualmente entre:

```text
Value exists
Value absent
Value unknown
Value invalid
```

cuando estas condiciones tengan significado diferente.

No deberá utilizarse `null` indiscriminadamente para representar múltiples estados semánticos.

---

# 42. Convención de Fechas y Tiempo

Los componentes deberán evitar ambigüedades temporales.

Cuando se intercambien fechas u horas deberán declararse, según corresponda:

- zona horaria;
- offset;
- precisión;
- formato.

Para intercambio interoperable deberá favorecerse un estándar reconocido como ISO 8601 cuando resulte aplicable.

---

# 43. Convención de Identificadores

Los identificadores deberán tratarse como valores opacos salvo que su especificación indique lo contrario.

Los consumidores no deberán inferir lógica de negocio a partir de partes internas de un ID.

---

# 44. Convención de Serialización

Los formatos de intercambio deberán:

- estar especificados;
- ser versionables;
- ser deterministas cuando corresponda;
- evitar dependencias innecesarias de objetos internos.

Una representación serializada pública forma parte del Contract cuando consumidores externos dependen de ella.

---

# 45. Convención de Compatibilidad

Los cambios deberán considerar explícitamente su impacto sobre consumidores existentes.

Antes de modificar una API pública deberá evaluarse:

```text
Contract
   ↓
Consumers
   ↓
Compatibility
   ↓
Version Impact
```

La estrategia completa será definida en **ENG-014 — Versionado**.

---

# 46. Convención de Deprecación

Una capacidad pública no deberá eliminarse inmediatamente cuando exista una ruta razonable de migración.

La deprecación deberá indicar:

- elemento afectado;
- alternativa;
- versión desde la cual está deprecated;
- versión prevista de retiro cuando sea conocida.

---

# 47. Convención de Logging

Los logs deberán registrar información útil para operación y diagnóstico.

No deberán utilizarse como sustituto de:

- manejo de errores;
- métricas;
- auditoría;
- Events de dominio.

La especificación completa corresponderá a **ENG-010 — Logging**.

---

# 48. Convención de Logs Sensibles

Los logs no deberán contener:

- passwords;
- tokens;
- claves privadas;
- credenciales;
- secretos completos;
- información sensible innecesaria.

Los valores sensibles deberán eliminarse, enmascararse o protegerse según corresponda.

---

# 49. Convención de Correlación

Las operaciones distribuidas o compuestas deberían permitir correlación cuando sea técnicamente relevante.

Ejemplo conceptual:

```text
Request
  │
  └── Correlation ID
         │
         ├── Service A
         ├── Event
         └── Service B
```

Esto facilita observabilidad sin introducir acoplamiento funcional.

---

# 50. Convención de Testing

Las pruebas deberán:

- ser deterministas;
- estar aisladas cuando corresponda;
- expresar intención;
- evitar dependencia innecesaria del entorno;
- proporcionar fallos comprensibles.

Una prueba deberá verificar comportamiento o regla relevante y no únicamente aumentar métricas de cobertura.

---

# 51. Convención de Tests

Los nombres de pruebas deberán expresar:

```text
Condition
    +
Behavior
    +
Expected Result
```

La sintaxis exacta dependerá del lenguaje y será refinada en **ENG-009 — Testing**.

---

# 52. Convención de Determinismo

Una operación determinista deberá producir el mismo resultado ante:

- las mismas entradas;
- el mismo estado;
- la misma configuración relevante.

Cuando exista comportamiento no determinista deberá estar explícitamente identificado.

---

# 53. Convención de Side Effects

Los efectos secundarios deberán ser explícitos y mantenerse cerca de los límites apropiados.

Ejemplos:

```text
Database
Filesystem
Network
Message Queue
External API
```

La lógica que pueda mantenerse pura debería permanecer separada de estos efectos.

---

# 54. Convención de I/O

La interacción con recursos externos deberá realizarse mediante límites identificables.

```text
Logic
  │
  ▼
Contract
  │
  ▼
I/O Adapter
```

Esto facilita:

- pruebas;
- sustitución;
- observabilidad;
- portabilidad.

---

# 55. Convención de Concurrencia

Cuando una implementación utilice concurrencia deberá documentar:

- propiedad del estado;
- condiciones de carrera relevantes;
- estrategia de sincronización;
- garantías de orden;
- idempotencia cuando corresponda.

La concurrencia no deberá introducirse sin necesidad demostrable.

---

# 56. Convención de Idempotencia

Las operaciones que puedan repetirse por diseño deberían declarar si son idempotentes.

Especialmente:

- handlers;
- migrations;
- retries;
- operaciones distribuidas;
- procesos de instalación.

La idempotencia no deberá asumirse implícitamente.

---

# 57. Convención de Retries

Los reintentos deberán utilizarse únicamente para fallos potencialmente transitorios.

Deberán considerar:

- límite de intentos;
- espera;
- backoff;
- idempotencia;
- observabilidad.

No deberán utilizarse para ocultar errores permanentes de configuración o lógica.

---

# 58. Convención de Timeouts

Toda operación remota o potencialmente bloqueante debería disponer de límites temporales razonables.

Un timeout deberá ser:

- configurable cuando corresponda;
- observable;
- coherente con la operación.

---

# 59. Convención de Recursos

Los recursos adquiridos deberán liberarse de manera determinista cuando la plataforma lo permita.

Ejemplos:

```text
Files
Connections
Locks
Streams
Processes
```

La gestión de recursos deberá permanecer explícita.

---

# 60. Convención de Seguridad

La seguridad deberá integrarse durante la implementación.

Se favorecerá:

```text
Secure by Design
Secure by Default
Least Privilege
Explicit Trust Boundaries
Input Validation
```

No deberá dependerse únicamente de controles externos posteriores.

---

# 61. Convención de Validación de Entrada

Toda entrada proveniente de un límite no confiable deberá validarse antes de utilizarse.

Ejemplos:

- usuario;
- red;
- archivo;
- Package;
- Manifest;
- sistema externo.

La validación deberá ocurrir en el límite apropiado.

---

# 62. Convención de Sanitización

Validación y sanitización no deberán considerarse equivalentes.

```text
Validation
→ determina si el dato es aceptable

Sanitization
→ transforma el dato cuando existe una regla explícita
```

No deberá modificarse silenciosamente una entrada inválida para hacerla parecer válida cuando esto altere su significado.

---

# 63. Convención de Documentación

Todo artefacto público deberá poseer documentación proporcional a su importancia.

La documentación deberá explicar principalmente:

- propósito;
- Contract;
- comportamiento;
- restricciones;
- ejemplos cuando sean útiles.

No deberá limitarse a repetir literalmente el código.

---

# 64. Comentarios de Código

Los comentarios deberán explicar principalmente:

```text
Why
```

cuando el:

```text
What
```

ya sea evidente por el código.

Los comentarios obsoletos deberán considerarse defectos.

---

# 65. TODO

Los marcadores `TODO`, `FIXME` o equivalentes no deberán convertirse en mecanismos permanentes de gestión de trabajo.

Cuando representen deuda o trabajo relevante deberán vincularse con el mecanismo de seguimiento correspondiente.

---

# 66. Convención de Código Generado

Todo código generado deberá ser identificable como tal.

Cuando no deba modificarse manualmente deberá declararse explícitamente.

Ejemplo conceptual:

```text
GENERATED FILE
DO NOT EDIT DIRECTLY
```

La fuente generadora deberá ser identificable.

---

# 67. Convención de Dependencias Externas

Las dependencias externas deberán:

- declararse;
- versionarse;
- evaluarse;
- mantenerse identificables.

No deberán incorporarse simplemente por conveniencia si una solución interna simple resulta suficiente.

---

# 68. Convención de Licencias

Toda dependencia externa deberá utilizarse de forma compatible con la licencia del proyecto y del componente correspondiente.

Los Packages deberán conservar la información de licencia requerida.

---

# 69. Convención de Automatización

Una regla repetitiva y verificable debería automatizarse cuando sea razonable.

Ejemplos:

```text
Formatting
Linting
Schema Validation
Architecture Rules
Tests
Dependency Validation
Packaging
```

La automatización deberá reflejar las especificaciones y no sustituirlas.

---

# 70. Convención de Tooling

Las herramientas deberán tratarse como implementaciones de reglas.

```text
Specification
      │
      ▼
Rule
      │
      ▼
Tool
```

No al contrario.

La existencia de una herramienta no deberá definir por sí misma una regla de MEF.

---

# 71. Convención de Formato

Cada implementación podrá utilizar formatters adecuados a su lenguaje.

El formato deberá:

- ser consistente;
- ser automatizable;
- reducir discusiones estilísticas;
- evitar configuraciones innecesariamente complejas.

Las reglas de formato específicas pertenecerán al perfil de cada implementación.

---

# 72. Convención de Portabilidad

Las convenciones universales de MEF deberán poder expresarse conceptualmente en diferentes lenguajes.

Ejemplo:

```text
MEF Concept      PHP       Java       C#        TypeScript
-----------------------------------------------------------
Contract         interface interface  interface interface
Module           class     class      class      class
Adapter          class     class      class      class
```

La equivalencia técnica exacta podrá variar.

La intención arquitectónica deberá mantenerse.

---

# 73. Convenciones Específicas de Implementación

Una implementación podrá definir reglas adicionales.

Ejemplo:

```text
MEF Universal Conventions
          │
          ├── PHP Profile
          ├── Java Profile
          ├── .NET Profile
          └── TypeScript Profile
```

Un perfil específico no deberá contradecir ENG-004.

---

# 74. Precedencia

Cuando existan varias convenciones aplicables, la precedencia será:

```text
Foundation
    ↓
Architecture
    ↓
ENG-000
    ↓
ENG Specialized Specification
    ↓
Implementation Profile
    ↓
Local Tool Configuration
```

Una configuración local no podrá invalidar una regla superior.

---

# 75. Excepciones a Convenciones

Una convención podrá exceptuarse únicamente cuando exista una razón técnica documentada.

La excepción deberá indicar:

- regla;
- motivo;
- alcance;
- impacto;
- duración cuando corresponda.

Una preferencia personal no constituye justificación suficiente.

---

# 76. Machine-Enforceable Conventions

Cuando sea posible, las convenciones deberán clasificarse como:

```text
Human Review
Machine Verifiable
Hybrid
```

Ejemplos:

| Convención | Verificación |
|---|---|
| formato | automática |
| dependencia circular | automática |
| Manifest válido | automática |
| nombre suficientemente expresivo | humana/híbrida |
| responsabilidad adecuada | humana |
| acceso a API interna | automática cuando sea posible |

---

# 77. Convenciones como Política Ejecutable

La evolución de MEF deberá buscar transformar reglas objetivas en validaciones automáticas.

```text
Convention
    │
    ▼
Rule
    │
    ▼
Validator
    │
    ▼
CI
    │
    ▼
Compliance
```

Esto reducirá divergencia entre documentación e implementación.

---

# 78. Invariantes de Ingeniería

ENG-004 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-051 | Las convenciones universales de MEF no deberán depender innecesariamente de una tecnología concreta. |
| EI-052 | Las dependencias significativas deberán ser explícitas. |
| EI-053 | Las APIs públicas deberán declararse intencionalmente y mantenerse mínimas. |
| EI-054 | Los detalles de implementación deberán considerarse internos por defecto. |
| EI-055 | Los Events públicos representarán hechos y no órdenes. |
| EI-056 | Las Queries no deberán producir efectos secundarios funcionales intencionales. |
| EI-057 | Los Providers no deberán contener lógica de negocio. |
| EI-058 | Los secretos no deberán almacenarse en código, Manifest, documentación o logs. |
| EI-059 | Las entradas provenientes de límites no confiables deberán validarse. |
| EI-060 | Los errores relevantes no deberán ignorarse silenciosamente. |
| EI-061 | El estado global mutable deberá evitarse y, cuando exista, permanecer controlado. |
| EI-062 | Las dependencias externas deberán permanecer declaradas e identificables. |
| EI-063 | Las reglas objetivamente verificables deberían automatizarse cuando sea razonable. |
| EI-064 | Una herramienta no constituye por sí misma una especificación de MEF. |
| EI-065 | Las convenciones específicas de implementación no podrán contradecir las convenciones universales. |

---

# 79. Criterios de Conformidad

Una implementación será conforme con ENG-004 cuando:

- utilice convenciones consistentes;
- declare dependencias explícitamente;
- mantenga APIs públicas controladas;
- diferencie Commands, Queries y Events;
- proteja secretos;
- valide entradas no confiables;
- gestione errores explícitamente;
- mantenga límites de infraestructura;
- documente elementos públicos;
- preserve independencia tecnológica;
- automatice reglas objetivas cuando corresponda;
- documente excepciones relevantes.

---

# 80. Riesgos

Deberán evitarse especialmente:

## Convenciones implícitas

Reglas conocidas únicamente por algunos desarrolladores.

## Convention Drift

Diferentes áreas utilizando reglas incompatibles.

## Tool-Driven Architecture

Permitir que una herramienta determine la arquitectura.

## Language Lock-in

Convertir características de un lenguaje en reglas universales innecesarias.

## Magic Behavior

Comportamiento importante basado en convenciones ocultas.

## Over-Convention

Crear reglas sin beneficio técnico que incrementen innecesariamente la carga cognitiva.

---

# 81. Evolución

Las convenciones podrán evolucionar conforme MEF madure.

Una nueva convención deberá evaluarse considerando:

- necesidad;
- claridad;
- beneficio;
- automatización;
- compatibilidad;
- costo de adopción.

Las convenciones obsoletas deberán deprecarse formalmente cuando afecten implementaciones existentes.

---

# 82. Relación con Nomenclatura

ENG-004 establece principios generales de nombres.

**ENG-005 — Nomenclatura** definirá las reglas concretas para:

- Modules;
- Contracts;
- Events;
- Commands;
- Queries;
- Providers;
- Adapters;
- Packages;
- archivos;
- identificadores.

```text
ENG-004
General Naming Conventions
        │
        ▼
ENG-005
Normative Naming System
```

---

# 83. Relación con Directorios

ENG-004 establece principios de organización y consistencia.

**ENG-006 — Estructura de Directorios** definirá cómo se materializan físicamente.

```text
ENG-001
Logical Organization
        │
        ▼
ENG-004
General Conventions
        │
        ▼
ENG-006
Physical Structure
```

---

# 84. Relación con Tooling

Las convenciones deberán poder alimentar posteriormente:

```text
MEF Specification
       │
       ▼
Convention Rules
       │
       ├── Formatter
       ├── Linter
       ├── Validator
       ├── Architecture Tests
       └── CI
```

De esta forma, la documentación podrá convertirse progresivamente en política verificable.

---

# 85. Principio Rector

> **Las convenciones de MEF deberán hacer explícita la intención, reducir ambigüedad y producir implementaciones consistentes y verificables sin convertir las características accidentales de una tecnología en reglas universales del Framework.**

---

# 86. Conclusión

**ENG-004 — Convenciones** establece el lenguaje común de Ingeniería de MEF.

Su propósito no consiste en imponer preferencias estilísticas arbitrarias.

Busca que cualquier implementación sea:

- comprensible;
- consistente;
- predecible;
- interoperable;
- verificable;
- mantenible.

Las convenciones constituyen además el puente entre documentación y automatización:

```text
Principle
   ↓
Convention
   ↓
Rule
   ↓
Validator
   ↓
Compliance
```

A medida que MEF evolucione, aquellas convenciones que puedan expresarse objetivamente deberán convertirse progresivamente en reglas ejecutables.

---

# Referencias

## Fundación

- FND-013 — Independencia del Framework

## Arquitectura

- ARQ-004 — Modules
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-012 — Dependency Injection
- ARQ-013 — Configuration
- ARQ-015 — Extension Model
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-001 — Organización del Código
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-014 — Versionado