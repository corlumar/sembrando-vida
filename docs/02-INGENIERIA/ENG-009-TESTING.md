---
id: ENG-009
titulo: Testing
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Testing
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-000
  - ENG-001
  - ENG-002
  - ENG-003
  - ENG-004
  - ENG-005
  - ENG-006
  - ENG-007
  - ENG-008
  - ARQ-011
  - ARQ-014
  - ARQ-016
relacionados:
  - ENG-010
  - ENG-011
  - ENG-012
  - ENG-013
  - ENG-014
  - ENG-015
keywords:
  - testing
  - unit testing
  - integration testing
  - contract testing
  - architecture testing
  - compatibility
  - security testing
  - quality
  - compliance
  - mef
---

# ENG-009

# Testing

## Estado

Accepted.

---

# 1. Propósito

Definir la estrategia oficial de **Testing** de **MEF (Modular Enterprise Framework)**.

El Testing proporciona evidencia verificable de que una implementación:

- cumple su comportamiento esperado;
- respeta Contracts;
- mantiene límites arquitectónicos;
- preserva compatibilidad;
- satisface invariantes;
- opera de forma segura;
- puede evolucionar sin introducir regresiones.

---

# 2. Declaración

En MEF, las pruebas constituyen evidencia de conformidad.

No se utilizan únicamente para detectar defectos.

También permiten comprobar que la implementación continúa alineada con:

- Fundación;
- Arquitectura;
- Ingeniería;
- Contracts;
- Invariantes Arquitectónicos;
- Invariantes de Ingeniería.

---

# 3. Objetivos

La estrategia de Testing deberá:

- detectar regresiones;
- verificar comportamiento;
- validar Contracts;
- proteger límites;
- verificar integración;
- comprobar compatibilidad;
- soportar refactorización;
- facilitar evolución;
- proporcionar confianza;
- automatizar conformidad.

---

# 4. Principio de Evidencia

Una afirmación técnica relevante deberá poder respaldarse mediante evidencia cuando sea razonable.

Ejemplo:

```text
Claim
"Core does not depend on Modules"
        │
        ▼
Architecture Test
        │
        ▼
Pass / Fail
```

La documentación establece la regla.

El test proporciona evidencia.

---

# 5. Pirámide de Testing de MEF

MEF reconoce diferentes niveles:

```text
              End-to-End
                 ▲
            Compatibility
                 ▲
              Security
                 ▲
            Architecture
                 ▲
             Contract
                 ▲
           Integration
                 ▲
               Unit
```

La cantidad de pruebas no deberá distribuirse necesariamente de forma uniforme.

Las pruebas más cercanas al código deberían ser más rápidas y numerosas.

---

# 6. Tipos Oficiales de Pruebas

MEF reconoce inicialmente:

| ID | Tipo |
|---|---|
| TST-001 | Unit Test |
| TST-002 | Integration Test |
| TST-003 | Contract Test |
| TST-004 | Architecture Test |
| TST-005 | Compatibility Test |
| TST-006 | Security Test |
| TST-007 | End-to-End Test |
| TST-008 | Lifecycle Test |
| TST-009 | Performance Test |
| TST-010 | Smoke Test |

---

# 7. Unit Tests

Los Unit Tests deberán verificar unidades pequeñas de comportamiento de forma aislada.

Deberán favorecer:

- rapidez;
- determinismo;
- aislamiento;
- claridad;
- diagnóstico preciso.

Ejemplo conceptual:

```text
ManifestValidator
        │
        ▼
Unit Test
```

---

# 8. Alcance de Unit Tests

Podrán verificar:

- Value Objects;
- Validators;
- Policies;
- Builders;
- Resolvers;
- Services;
- Parsers;
- Normalizers;
- comportamiento interno.

No deberán necesitar infraestructura real cuando ésta pueda sustituirse de manera razonable.

---

# 9. Integration Tests

Los Integration Tests verificarán interacción real entre dos o más componentes.

Ejemplos:

```text
Container + Registry
Module + Event Bus
Repository + Database Adapter
CLI + Validator
```

Su objetivo será comprobar que las integraciones funcionan conforme a Contracts y configuración.

---

# 10. Contract Tests

Los Contract Tests verificarán que una implementación respeta un Contract público.

Ejemplo:

```text
CustomerRepository Contract
        │
        ├── MySqlCustomerRepository
        ├── ApiCustomerRepository
        └── InMemoryCustomerRepository
                 │
                 ▼
          Same Contract Suite
```

La misma suite podrá ejecutarse contra múltiples implementaciones.

---

# 11. Contract Test Suite

Cuando un Contract público lo justifique, debería existir una suite reusable.

Conceptualmente:

```text
Contract Specification
        │
        ▼
Contract Test Suite
        │
        ├── Implementation A
        ├── Implementation B
        └── Implementation C
```

Esto permite validar sustituibilidad.

---

# 12. Architecture Tests

Los Architecture Tests verificarán reglas estructurales.

Ejemplos:

```text
Core must not depend on Modules
Modules must not access another Module Internal API
Contracts must not depend on Infrastructure
Circular dependencies must not exist
```

Estas pruebas forman parte central de MEF.

---

# 13. Relación AI → Architecture Test

Cada `AI-xxx` verificable podrá relacionarse con una prueba.

Ejemplo:

```text
AI-001
Core does not depend on Modules
        │
        ▼
Architecture Rule
        │
        ▼
Automated Test
```

No todos los `AI` serán necesariamente automatizables.

---

# 14. Relación EI → Engineering Test

Los `EI-xxx` objetivos también podrán convertirse en tests.

Ejemplo:

```text
EI-090
Module must contain Manifest
        │
        ▼
Structure Test
```

---

# 15. Architecture Test Registry

MEF podrá mantener un catálogo:

```text
AT-AI-001
AT-AI-015
AT-EI-090
```

La nomenclatura definitiva podrá definirse posteriormente.

El objetivo será mantener trazabilidad entre regla y prueba.

---

# 16. Compatibility Tests

Los Compatibility Tests verificarán que:

- versiones declaradas son compatibles;
- Packages pueden coexistir;
- Contracts permanecen compatibles;
- Manifest Schema es soportado;
- APIs públicas mantienen comportamiento.

---

# 17. Compatibility Matrix

Cuando corresponda podrá mantenerse una matriz:

```text
MEF 1.0 ── Module CRM 1.x       ✓
MEF 1.0 ── Module CRM 2.x       ✗
MEF 2.0 ── Module CRM 2.x       ✓
```

Las pruebas deberán validar relaciones críticas de compatibilidad.

---

# 18. Security Tests

Los Security Tests deberán verificar controles relevantes derivados de `ARQ-016`.

Podrán incluir:

- autorización;
- validación de entrada;
- integridad de Package;
- manejo de secretos;
- límites de confianza;
- permisos;
- exposición de información sensible.

---

# 19. Security Negative Tests

Las pruebas de seguridad deberán incluir escenarios donde la operación **debe fallar**.

Ejemplos:

```text
Invalid signature → rejected
Unauthorized extension → rejected
Secret in manifest → rejected
Forbidden dependency → rejected
```

---

# 20. End-to-End Tests

Los End-to-End Tests verificarán flujos completos.

Ejemplo:

```text
Package
  ↓
Install
  ↓
Register
  ↓
Enable
  ↓
Execute
  ↓
Disable
  ↓
Remove
```

Deberán reservarse para escenarios donde la interacción completa aporte valor.

---

# 21. Lifecycle Tests

Los Lifecycle Tests verificarán estados y transiciones definidos en `ARQ-014`.

Ejemplos:

```text
Created → Configured
Configured → Booting
Ready → Running
Running → Stopping
```

También deberán verificar transiciones prohibidas.

---

# 22. Lifecycle Negative Tests

Ejemplos:

```text
Disposed → Running       ✗
Running → Created        ✗
Unvalidated → Registered ✗
```

Una transición inválida deberá fallar de forma explícita.

---

# 23. Performance Tests

Los Performance Tests podrán medir:

- startup;
- resolution;
- event dispatch;
- package validation;
- dependency resolution;
- build;
- CLI commands.

Los objetivos de rendimiento deberán definirse antes de interpretar el resultado.

---

# 24. Performance Baseline

Cuando una capacidad sea crítica podrá existir un baseline.

Ejemplo conceptual:

```text
Manifest validation:
baseline = X
regression threshold = Y
```

La cifra concreta dependerá de la implementación y entorno.

---

# 25. Smoke Tests

Los Smoke Tests verificarán rápidamente que una build o Package mantiene funcionalidades esenciales.

Ejemplo:

```text
Framework boots
Registry loads
Container resolves
Manifest validates
```

---

# 26. Test Organization

La organización recomendada podrá ser:

```text
tests/
├── Unit/
├── Integration/
├── Contract/
├── Architecture/
├── Compatibility/
├── Security/
├── Lifecycle/
├── Performance/
└── EndToEnd/
```

La estructura física podrá adaptarse según el perfil.

---

# 27. Tests por Module

Un Module podrá mantener:

```text
Module/
└── Tests/
    ├── Unit/
    ├── Integration/
    ├── Contract/
    └── Architecture/
```

Esto favorece autonomía.

---

# 28. Naming de Tests

Los nombres deberán expresar:

```text
Condition
+
Behavior
+
Expected Result
```

Ejemplo:

```text
invalid_manifest_is_rejected
```

o forma idiomática equivalente.

---

# 29. Test Intent

Una prueba deberá permitir comprender rápidamente:

- escenario;
- comportamiento;
- expectativa.

Se evitarán nombres como:

```text
test1
works
testMethod
scenarioA
```

---

# 30. Arrange / Act / Assert

Cuando resulte apropiado se favorecerá una estructura conceptual:

```text
Arrange
Act
Assert
```

o equivalente.

No será obligatorio cuando otro estilo sea más claro.

---

# 31. Given / When / Then

Para escenarios de comportamiento también podrá utilizarse:

```text
Given
When
Then
```

La elección deberá favorecer claridad.

---

# 32. Determinismo

Las pruebas deberán ser deterministas.

Las mismas:

- entradas;
- configuración;
- dependencias;
- estado;

deberán producir el mismo resultado esperado.

---

# 33. Fuentes de No Determinismo

Se deberán controlar especialmente:

- tiempo;
- aleatoriedad;
- concurrencia;
- red;
- filesystem;
- orden de ejecución;
- servicios externos.

---

# 34. Clock

Las pruebas dependientes del tiempo deberían utilizar una abstracción controlable.

Conceptualmente:

```text
Clock Contract
   ├── SystemClock
   └── FakeClock
```

Esto evita tests sensibles al reloj real.

---

# 35. Randomness

La aleatoriedad deberá poder:

- fijar seed;
- sustituirse;
- registrarse;

cuando afecte reproducibilidad.

---

# 36. Isolation

Una prueba no deberá depender innecesariamente de otra prueba.

No deberá asumirse un orden específico salvo que la suite explícitamente represente un flujo secuencial.

---

# 37. Shared State

El estado compartido mutable entre pruebas deberá evitarse.

Cuando exista deberá reinicializarse de forma controlada.

---

# 38. Test Data

Los datos de prueba deberán:

- ser mínimos;
- expresar intención;
- evitar dependencias irrelevantes.

No deberán copiar grandes snapshots sin necesidad.

---

# 39. Fixtures

Las Fixtures deberán representar escenarios conocidos y reutilizables.

Ejemplo:

```text
ValidManifest
ManifestWithMissingDependency
CompatiblePackage
```

---

# 40. Factories para Tests

Las Test Factories podrán facilitar la construcción de escenarios.

No deberán ocultar información crítica para comprender la prueba.

---

# 41. Test Doubles

MEF reconoce conceptualmente:

```text
Stub
Fake
Spy
Mock
```

Cada uno deberá utilizarse según su propósito.

No deberán tratarse como términos intercambiables sin necesidad.

---

# 42. Fake

Un Fake proporciona una implementación funcional simplificada.

Ejemplo:

```text
InMemoryModuleRepository
```

---

# 43. Stub

Un Stub proporciona respuestas controladas.

Ejemplo conceptual:

```text
IdentityProviderStub
```

---

# 44. Spy

Un Spy registra interacciones para verificarlas posteriormente.

Ejemplo:

```text
EventPublisherSpy
```

---

# 45. Mock

Un Mock podrá verificar expectativas de interacción.

Su uso excesivo deberá evitarse cuando produzca tests fuertemente acoplados a la implementación.

---

# 46. Preferencia por Fakes

Cuando sea razonable, MEF favorecerá Fakes simples sobre mocks complejos para Contracts importantes.

Esto facilita pruebas más cercanas al comportamiento real.

---

# 47. External Systems

Los sistemas externos deberán aislarse.

Las pruebas unitarias no deberán depender de:

- APIs públicas reales;
- servicios cloud reales;
- proveedores externos.

Estas integraciones podrán verificarse en suites específicas.

---

# 48. Integration Environment

Los Integration Tests deberán utilizar entornos reproducibles cuando sea posible.

Ejemplo:

```text
Test Database
Test Queue
Test Filesystem
```

La configuración deberá ser explícita.

---

# 49. Production Data

No deberán utilizarse datos productivos reales en tests salvo procesos formalmente autorizados y protegidos.

---

# 50. Secrets in Tests

Los tests no deberán requerir secretos productivos.

Las credenciales de testing deberán permanecer aisladas y controladas.

---

# 51. Assertions

Las assertions deberán proporcionar suficiente contexto para diagnosticar fallos.

Se favorecerán assertions específicas.

Ejemplo:

```text
expected dependency MOD-IDENTITY to be declared
```

en lugar de mensajes genéricos.

---

# 52. False Positives

Una suite que pasa sin verificar realmente la regla se considera defectuosa.

Las pruebas deberán demostrar que son capaces de fallar ante una violación real.

---

# 53. Mutation Testing

Cuando resulte útil, MEF podrá utilizar Mutation Testing para evaluar la efectividad de tests críticos.

No será obligatorio universalmente.

---

# 54. Coverage

La cobertura será una métrica auxiliar.

No constituirá evidencia suficiente de calidad.

```text
100% Coverage
≠
100% Correctness
```

---

# 55. Coverage Targets

Los proyectos podrán definir thresholds específicos.

No se impondrá inicialmente un porcentaje universal para todos los componentes.

La criticidad deberá influir en la exigencia.

---

# 56. Critical Components

Los componentes críticos deberán disponer de un nivel de pruebas superior.

Ejemplos:

- Kernel;
- Registry;
- Container;
- Manifest Validator;
- Package Manager;
- Security;
- Lifecycle.

---

# 57. Test Pyramid

MEF favorecerá mayor cantidad de pruebas rápidas y específicas.

Conceptualmente:

```text
Many Unit
Moderate Integration
Focused E2E
```

No deberá dependerse exclusivamente de End-to-End.

---

# 58. Test Speed

La suite deberá clasificarse cuando sea útil:

```text
fast
medium
slow
```

Esto permitirá diferentes pipelines.

---

# 59. Local Test Suite

Los desarrolladores deberían poder ejecutar una suite rápida localmente.

Ejemplo conceptual:

```text
mef test
```

o mediante el Build System correspondiente.

---

# 60. CI Test Suite

CI deberá ejecutar las suites necesarias para determinar conformidad.

Podrá incluir:

```text
Unit
Contract
Architecture
Integration
Security
Compatibility
```

según el cambio.

---

# 61. Test Selection

Podrá permitirse selección por:

```text
type
module
tag
invariant
changed component
```

Ejemplo conceptual:

```text
mef test --type=architecture
```

La interfaz concreta será definida por CLI/Build.

---

# 62. Test Tags

Los tests podrán declararse mediante tags estables.

Ejemplos:

```text
unit
integration
contract
architecture
security
slow
```

No deberán depender de nombres arbitrarios de archivos para clasificación cuando exista metadata más adecuada.

---

# 63. Testing Generator

ENG-008 podrá generar pruebas iniciales.

Sin embargo:

> Un test generado no se considerará evidencia hasta contener expectativas reales.

---

# 64. Generated Empty Tests

Los Generators no deberán crear suites vacías que pasen automáticamente y aparenten conformidad.

---

# 65. Test Failure

Una prueba fallida deberá:

- identificar regla o comportamiento;
- proporcionar contexto;
- fallar con código adecuado;
- integrarse correctamente con CI.

---

# 66. Flaky Tests

Los flaky tests deberán tratarse como defectos.

No deberán normalizarse mediante reintentos indiscriminados.

---

# 67. Retry de Tests

El retry automático podrá utilizarse únicamente para diagnóstico o condiciones externas justificadas.

No deberá ocultar pruebas no deterministas.

---

# 68. Test Quarantine

Una organización podrá disponer de una cuarentena temporal para tests inestables.

Todo test en cuarentena deberá tener:

- razón;
- propietario;
- ticket;
- criterio de salida.

No será una solución permanente.

---

# 69. Test Documentation

Las suites complejas deberán documentar:

- propósito;
- requisitos;
- entorno;
- comandos;
- datos;
- limitaciones.

---

# 70. Architectural Fitness Functions

Las pruebas estructurales reutilizables podrán convertirse formalmente en **Architectural Fitness Functions**.

Ejemplo:

```text
AFF-001
Core must not depend on Modules
```

El esquema definitivo podrá definirse posteriormente.

---

# 71. Continuous Architecture Validation

El objetivo será ejecutar Architecture Tests en cada cambio relevante.

```text
Commit
  ↓
CI
  ↓
Architecture Tests
  ↓
Pass / Fail
```

Así una violación arquitectónica podrá detectarse antes de merge.

---

# 72. Contract Compatibility Pipeline

Antes de publicar una nueva versión de un Contract:

```text
Contract Change
    ↓
Contract Tests
    ↓
Compatibility Tests
    ↓
Version Impact
```

El resultado deberá alimentar la decisión de versionado.

---

# 73. Package Testing

Antes de distribuir un Package deberá validarse:

- Manifest;
- estructura;
- integridad;
- dependencias;
- tests aplicables;
- compatibilidad.

---

# 74. Pre-Release Testing

Un Release deberá ejecutar el conjunto de pruebas definido en `ENG-017`.

Testing será una condición de publicación, no una actividad opcional posterior.

---

# 75. Testing en Multiple Profiles

Cuando existan varias implementaciones:

```text
PHP
Java
.NET
TypeScript
```

podrán ejecutarse suites conceptualmente equivalentes.

La sintaxis será distinta.

La regla verificada deberá ser la misma.

---

# 76. Cross-Implementation Contract Tests

Los Contracts universales podrán utilizar suites equivalentes para garantizar que diferentes implementaciones preserven la misma semántica.

---

# 77. Snapshot Tests

Los Snapshot Tests podrán utilizarse para representaciones apropiadas.

No deberán reemplazar assertions semánticas cuando el significado real sea importante.

---

# 78. Golden Files

Podrán utilizarse Golden Files para artefactos como:

- Manifest normalizado;
- generated structures;
- serialization.

Deberán revisarse conscientemente cuando cambien.

---

# 79. Property-Based Testing

Cuando una regla se exprese mejor mediante propiedades generales, podrá utilizarse Property-Based Testing.

Ejemplo:

```text
Any valid Manifest normalized twice remains equivalent.
```

---

# 80. Fuzz Testing

Los Parsers, Manifest Validator y otras superficies de entrada podrán beneficiarse de Fuzz Testing.

Especialmente para:

- formatos;
- parsers;
- validadores;
- seguridad.

---

# 81. Concurrency Testing

Los componentes concurrentes deberán probar:

- race conditions;
- ordering;
- synchronization;
- idempotency.

---

# 82. Failure Testing

Las pruebas deberán incluir fallos esperados.

Ejemplos:

```text
dependency unavailable
filesystem error
invalid manifest
event handler failure
shutdown failure
```

---

# 83. Recovery Testing

Cuando exista recuperación automática deberán probarse:

- retry;
- rollback;
- recovery;
- restart;
- graceful degradation.

---

# 84. Graceful Shutdown Testing

ARQ-014 requiere Shutdown ordenado.

Los tests deberán verificar que:

- no se aceptan nuevas operaciones;
- los recursos se liberan;
- procesos pendientes se completan cuando corresponda;
- el estado final es consistente.

---

# 85. Observability Testing

Las capacidades críticas de observabilidad también podrán probarse.

Ejemplos:

```text
error generates expected log
request preserves correlation id
security operation generates audit event
```

---

# 86. Log Assertions

Las pruebas no deberían acoplarse excesivamente al texto exacto del log salvo que éste forme parte de un Contract.

Se favorecerá comprobar:

- nivel;
- código;
- contexto;
- metadata.

---

# 87. Audit Tests

Las operaciones sensibles deberán verificar que generan evidencia de auditoría adecuada.

---

# 88. Test Environment Isolation

Los tests deberán evitar contaminación entre:

```text
development
test
production
```

El entorno de test deberá estar explícitamente identificado.

---

# 89. Destructive Tests

Los tests destructivos deberán ejecutarse únicamente contra recursos controlados.

Nunca deberán apuntar accidentalmente a producción.

---

# 90. Safety Guards

Las suites que puedan destruir datos deberán incluir protecciones explícitas.

Ejemplo conceptual:

```text
ENVIRONMENT == test
```

antes de continuar.

---

# 91. Reproducibility

Una ejecución de tests deberá poder reproducirse con:

- versión;
- dependencias;
- configuración;
- seed cuando aplique;
- entorno relevante.

---

# 92. Test Reports

CI deberá poder producir reportes estructurados.

Podrán incluir:

- tests ejecutados;
- duración;
- fallos;
- cobertura;
- invariantes verificados.

---

# 93. Compliance Report

En el futuro MEF podrá producir un reporte como:

```text
Architecture Compliance
AI-001 PASS
AI-002 PASS
AI-003 FAIL

Engineering Compliance
EI-090 PASS
EI-096 PASS
```

Esto convertirá pruebas en evidencia de cumplimiento.

---

# 94. Traceability

Cuando una prueba verifique una regla explícita debería poder referenciarla.

Ejemplo:

```text
Test:
CoreCannotDependOnModules

Verifies:
AI-001
```

---

# 95. Rule Metadata

Podrá utilizarse metadata:

```text
verifies: AI-001
```

o mecanismo equivalente según el lenguaje.

---

# 96. Test Ownership

Las suites críticas deberán tener propietario técnico identificable.

No deberán quedar sin mantenimiento.

---

# 97. Deprecated Tests

Una prueba podrá eliminarse cuando:

- la regla desaparezca;
- el comportamiento se retire;
- sea sustituida por otra prueba equivalente.

La eliminación de un test no deberá utilizarse para ocultar una regresión.

---

# 98. Test Refactoring

Los tests podrán refactorizarse manteniendo la misma intención y evidencia.

---

# 99. Tests as Documentation

Las pruebas bien diseñadas pueden servir como documentación ejecutable.

No sustituyen la documentación conceptual.

La relación será:

```text
Specification
   ↓
Documentation
   ↓
Executable Test
```

---

# 100. Testing de Manifest

ENG-003 deberá contar con suites que verifiquen al menos:

```text
Valid schema
Missing required fields
Invalid ID
Invalid version
Unknown dependency
Compatibility conflict
Secret detection
Unknown fields
```

---

# 101. Testing de Modules

ENG-002 deberá poder verificarse con pruebas como:

```text
Module has Manifest
Module exposes public API
Module does not access another Module Internal API
Module declares dependencies
Module participates in Lifecycle
```

---

# 102. Testing de CLI

ENG-007 deberá verificar:

- syntax;
- help;
- exit codes;
- structured output;
- dry-run;
- destructive confirmations;
- secret masking;
- non-interactive mode.

---

# 103. Testing de Generators

ENG-008 deberá verificar:

- output correcto;
- no overwrite;
- deterministic generation;
- Template version;
- rollback;
- generated Manifest validity.

---

# 104. Testing de Directory Structure

ENG-006 deberá poder probar:

- forbidden directories;
- Manifest placement;
- separation source/runtime;
- module boundaries;
- structural portability.

---

# 105. Testing de Naming

ENG-005 deberá permitir tests para patrones objetivos:

```text
Module ID
Contract ID
Event naming
Package ID
Manifest filename
```

---

# 106. Testing de Invariants

Los invariantes deberán clasificarse como:

```text
Automatable
Partially Automatable
Human Review
```

Esto evita intentar automatizar reglas puramente conceptuales.

---

# 107. Human Review

Las pruebas automáticas no sustituyen revisión humana para:

- responsabilidad;
- diseño;
- claridad;
- adecuación conceptual;
- mantenibilidad.

---

# 108. Quality Gates

MEF podrá definir Quality Gates.

Ejemplo:

```text
Build
  ↓
Unit
  ↓
Contract
  ↓
Architecture
  ↓
Security
  ↓
Package
```

Un fallo crítico deberá detener el pipeline.

---

# 109. Severity

Los resultados podrán clasificarse:

```text
error
warning
info
```

Las reglas obligatorias deberán producir error cuando se violen.

---

# 110. Local Overrides

No deberá permitirse desactivar silenciosamente pruebas obligatorias mediante configuración local.

Las excepciones deberán documentarse.

---

# 111. Invariantes de Ingeniería

ENG-009 continúa la serie global `EI`.

| ID | Invariante |
|----|------------|
| EI-126 | Las pruebas deberán proporcionar evidencia verificable de comportamiento o conformidad. |
| EI-127 | Las pruebas deberán ser deterministas cuando las condiciones relevantes sean equivalentes. |
| EI-128 | Las pruebas críticas no deberán depender innecesariamente de servicios externos reales. |
| EI-129 | Los Contract Tests deberán poder aplicarse a múltiples implementaciones cuando exista sustituibilidad. |
| EI-130 | Las reglas arquitectónicas objetivamente verificables deberán disponer de Architecture Tests cuando sea razonable. |
| EI-131 | Los Tests no deberán depender de orden de ejecución salvo especificación explícita. |
| EI-132 | Los secretos productivos no deberán utilizarse en Testing. |
| EI-133 | Los flaky tests deberán tratarse como defectos. |
| EI-134 | La cobertura no deberá utilizarse como única medida de calidad. |
| EI-135 | Los tests generados no deberán presentarse como evidencia si no contienen verificaciones reales. |
| EI-136 | Los tests de seguridad deberán incluir escenarios de rechazo y fallo. |
| EI-137 | Las transiciones inválidas del Lifecycle deberán verificarse mediante pruebas negativas. |
| EI-138 | Los Packages deberán superar las pruebas requeridas antes de publicación. |
| EI-139 | Las pruebas que verifiquen invariantes deberían mantener trazabilidad hacia el ID correspondiente. |
| EI-140 | Las suites destructivas deberán protegerse contra ejecución accidental en entornos productivos. |
| EI-141 | Las pruebas deberán producir resultados adecuados para automatización y CI. |
| EI-142 | Las excepciones a Quality Gates deberán ser explícitas y gobernadas. |
| EI-143 | Eliminar una prueba no deberá utilizarse como mecanismo para ocultar una regresión. |
| EI-144 | Los Tests deberán preservar separación entre especificación y herramienta concreta. |
| EI-145 | Las pruebas automáticas complementan pero no sustituyen revisión técnica cuando la regla no pueda verificarse objetivamente. |

---

# 112. Criterios de Conformidad

Una implementación será conforme con ENG-009 cuando:

- posea estrategia de pruebas apropiada;
- cubra comportamientos críticos;
- verifique Contracts;
- disponga de Architecture Tests para reglas automatizables;
- mantenga pruebas deterministas;
- controle infraestructura externa;
- proteja secretos;
- pruebe fallos relevantes;
- integre Testing con CI;
- produzca reportes;
- respete Quality Gates;
- mantenga trazabilidad cuando corresponda.

---

# 113. Riesgos

Deberán evitarse especialmente:

## Coverage Theater

Optimizar cobertura sin verificar comportamiento significativo.

## Mock Everything

Construir tests excesivamente acoplados a implementación.

## E2E Only

Depender exclusivamente de pruebas completas, lentas y difíciles de diagnosticar.

## Flaky Acceptance

Aceptar inestabilidad como comportamiento normal.

## Architecture Without Tests

Documentar reglas verificables pero no protegerlas.

## Testing Production

Utilizar recursos o datos productivos accidentalmente.

## False Compliance

Declarar conformidad solo porque una suite incompleta pasó.

---

# 114. Primera Estrategia Recomendada

La primera implementación de MEF debería priorizar:

```text
Unit Tests
Contract Tests
Architecture Tests
Integration Tests
```

y añadir progresivamente:

```text
Security
Compatibility
Lifecycle
End-to-End
Performance
```

según madurez y criticidad.

---

# 115. Principio Rector

> **El Testing de MEF deberá proporcionar evidencia reproducible de que la implementación funciona conforme a sus Contracts, respeta la Arquitectura y satisface las reglas de Ingeniería que puedan verificarse objetivamente.**

---

# 116. Conclusión

**ENG-009 — Testing** convierte la calidad de MEF en una disciplina verificable.

La cadena completa será:

```text
Principle
   ↓
Architecture
   ↓
Invariant
   ↓
Engineering Rule
   ↓
Test
   ↓
Evidence
   ↓
Compliance
```

Esto permitirá que MEF no dependa únicamente de afirmar:

> “La arquitectura debería respetarse.”

Sino que pueda demostrar, cuando sea técnicamente posible:

```text
Architecture validated: PASS
Contracts validated: PASS
Engineering invariants: PASS
Package compatibility: PASS
```

De esta forma, Testing se convierte no solo en protección contra errores, sino en uno de los principales mecanismos de **gobernanza ejecutable** del Framework.

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-007 — Service Container
- ARQ-008 — Event Bus
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General
- ENG-001 — Organización del Código
- ENG-002 — Especificación de Modules
- ENG-003 — Manifest
- ENG-004 — Convenciones
- ENG-005 — Nomenclatura
- ENG-006 — Estructura de Directorios
- ENG-007 — CLI
- ENG-008 — Generadores
- ENG-010 — Logging
- ENG-011 — Configuration Files
- ENG-012 — Build System
- ENG-013 — Package Manager
- ENG-014 — Versionado
- ENG-015 — Architectural State Machine