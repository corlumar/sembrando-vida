---
id: ENG-075
titulo: Maintainability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Maintainability Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-012
  - ENG-014
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-028
  - ENG-034
  - ENG-035
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-043
  - ENG-049
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-060
  - ENG-069
  - ENG-070
  - ENG-073
  - ENG-074
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-011
  - ENG-013
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-022
  - ENG-026
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-037
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-058
  - ENG-059
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-071
  - ENG-072
  - ENG-076
keywords:
  - maintainability
  - maintainability-engineering
  - analyzability
  - diagnosability
  - modifiability
  - changeability
  - repairability
  - testability
  - complexity
  - coupling
  - cohesion
  - technical-debt
  - refactoring
  - dead-code
  - deprecation
  - runbook
  - mttr
  - mttd
  - change-risk
  - mef
---

# ENG-075

# Maintainability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Maintainability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-075 establece las reglas para:

```text
Maintainability

Maintainability Requirement
Maintainability Objective

Analyzability
Diagnosability
Understandability

Changeability
Modifiability

Repairability
Restorability

Testability

Change
Change Scope
Change Impact
Change Risk

Diagnosis
Detection
Localization
Root Cause Analysis

MTTD
MTTI
MTTR
Time To Change
Time To Validate

Diagnostic Coverage

Complexity
Cyclomatic Complexity
Cognitive Complexity

Coupling
Cohesion

Dependency Direction
Dependency Depth

Code Smell
Architecture Smell

Technical Debt
Debt Principal
Debt Interest

Refactoring
Refactoring Safety

Dead Code
Unused Dependency
Deprecated Code
Legacy Path

Documentation Maintainability

Operational Maintainability

Runbook
Repair Procedure
Diagnostic Procedure

Maintainability Baseline
Maintainability Regression

Maintainability Gate

Maintainability Security
Maintainability Audit
Maintainability Observability
Maintainability Testing
```

---

# 2. Declaración

> **MEF deberá tratar Maintainability como la capacidad medible de comprender, diagnosticar, modificar, validar y reparar el sistema con riesgo y esfuerzo controlados. Ninguna métrica aislada de complejidad deberá considerarse prueba suficiente de Maintainability, y ningún Refactoring deberá aceptarse si mejora indicadores locales a costa de Contracts, Testability, diagnosabilidad, Compatibility o claridad arquitectónica.**

Arquitectura conceptual:

```text
SYSTEM
   │
   ├── Code
   ├── Architecture
   ├── Configuration
   ├── Dependencies
   ├── Runtime
   └── Operations
   │
   ▼
UNDERSTAND
   │
   ▼
DIAGNOSE
   │
   ▼
CHANGE / REPAIR
   │
   ▼
VALIDATE
   │
   ▼
DEPLOY
   │
   ▼
VERIFY
```

---

# 3. Maintainability Engineering

Maintainability Engineering responde:

```text
Can engineers understand the system?
Can a failure be localized quickly?
How many components must change?
How risky is a modification?
How difficult is validation?
How quickly can a defect be repaired?
Does architecture make change local or global?
Is technical debt increasing change cost?
Can deprecated paths be removed safely?
Are runbooks sufficient to restore service?
```

---

# 4. Maintainability

`Maintainability` representa la capacidad de un sistema para ser analizado, modificado, reparado y validado de forma controlada durante su ciclo de vida.

---

# 5. Maintainability ≠ Reliability

Reliability busca reducir:

```text
Failure
```

Maintainability busca reducir:

```text
effort
risk
time
```

para comprender y corregir el sistema.

---

# 6. Maintainability ≠ Availability

Availability mide Service Usability a través del tiempo.

Maintainability puede reducir Downtime al facilitar Diagnosis y Repair.

---

# 7. Maintainability ≠ Code Quality

Code Quality es un concepto más amplio.

Maintainability es una propiedad específica relacionada con evolución y reparación.

---

# 8. Maintainability ≠ Low Complexity

Complejidad baja puede contribuir, pero no garantiza:

```text
diagnosability
modifiability
testability
operational repairability
```

---

# 9. Maintainability ≠ Refactoring

Refactoring es una técnica para mejorar estructura preservando comportamiento.

---

# 10. Maintainability Requirement

Todo Requirement deberá definir:

```text
scope
maintenance activity
target
measurement method
operating assumptions
```

---

# 11. Maintainability Requirement Example

```text
Scope:
order-processing module

Change:
add a new payment provider

Objective:
no modification outside declared
payment extension boundary

Validation:
unit + contract + integration tests

Expected Change Scope:
<= 3 owned components
```

---

# 12. Vague Requirement

No deberá utilizarse como Contract:

```text
easy to maintain
clean
simple
well designed
developer friendly
```

sin criterio verificable.

---

# 13. Maintainability Dimensions

MEF distinguirá al menos:

```text
ANALYZABILITY
DIAGNOSABILITY
MODIFIABILITY
REPAIRABILITY
TESTABILITY
```

---

# 14. Analyzability

Capacidad para entender estructura, comportamiento y relaciones relevantes.

---

# 15. Understandability

Incluye capacidad de responder:

```text
what does this component do?
who owns it?
what does it depend on?
what depends on it?
which invariants apply?
```

---

# 16. Architecture Discoverability

Deberá favorecerse mediante:

```text
metadata
registry
contracts
dependency information
documentation
```

---

# 17. Hidden Behavior

Reduce Maintainability.

Ejemplos:

```text
implicit global state
magic discovery
undocumented side effects
runtime mutation
hidden dependency
```

---

# 18. Diagnosability

Capacidad para identificar rápidamente:

```text
failure
scope
cause
affected component
relevant state
```

---

# 19. Diagnosability ≠ Observability

Observability proporciona señales.

Diagnosability representa la facilidad real para convertir dichas señales en una explicación útil.

---

# 20. Diagnostic Coverage

Proporción o conjunto de Failure Modes para los que existe evidencia suficiente para:

```text
detect
localize
explain
repair
```

---

# 21. Diagnostic Context

Deberá incluir cuando corresponda:

```text
correlation id
component
version
environment
tenant scope
operation
failure code
```

---

# 22. Diagnostic Noise

Exceso de Logs o Metrics puede reducir Diagnosability.

---

# 23. Diagnosis

Podrá dividirse:

```text
Detection
     │
     ▼
Identification
     │
     ▼
Localization
     │
     ▼
Root Cause Analysis
```

---

# 24. Detection

Determina que existe un problema.

---

# 25. Identification

Determina qué tipo de problema existe.

---

# 26. Localization

Determina dónde se encuentra.

---

# 27. Root Cause

Determina la causa suficientemente profunda para prevenir recurrencia.

---

# 28. Symptom ≠ Root Cause

No deberán confundirse.

---

# 29. Root Cause Uncertainty

Podrá permanecer explícita.

No deberá inventarse una causa para cerrar un diagnóstico.

---

# 30. Modifiability

Capacidad de cambiar comportamiento o estructura con impacto limitado y predecible.

---

# 31. Changeability

Podrá utilizarse como propiedad operacional de realizar cambios de forma eficiente.

---

# 32. Local Change

Deberá favorecer cambios cuyo Scope coincida con Ownership arquitectónico.

---

# 33. Change Amplification

Ocurre cuando una pequeña Feature requiere modificaciones en muchos componentes.

---

# 34. Change Amplification Signal

Podrá medir:

```text
files changed
modules changed
contracts changed
tests changed
configurations changed
deployments affected
```

---

# 35. Shotgun Surgery

Cambios repetidos y dispersos pueden indicar mala Maintainability.

---

# 36. Ripple Effect

Cambio en un componente obliga modificaciones no obvias en otros.

---

# 37. Change Impact

Deberá poder analizarse antes de modificaciones críticas.

---

# 38. Change Scope

Podrá incluir:

```text
code
schema
configuration
contract
runtime
deployment
documentation
tests
```

---

# 39. Change Risk

Podrá considerar:

```text
scope
criticality
coupling
test coverage
reversibility
data impact
deployment complexity
```

---

# 40. Change Risk ≠ Change Size Alone

Un cambio pequeño sobre un Contract central puede ser más riesgoso que uno grande y aislado.

---

# 41. Repairability

Capacidad de restaurar función correcta después de identificar un Defect o Failure.

---

# 42. Repair

Podrá incluir:

```text
code fix
configuration correction
dependency replacement
data repair
rollback
rollforward
resource repair
```

---

# 43. Temporary Repair

Podrá existir.

---

# 44. Workaround

Reduce impacto sin eliminar necesariamente Root Cause.

---

# 45. Permanent Repair

Deberá eliminar o controlar Root Cause suficientemente.

---

# 46. Workaround ≠ Permanent Fix

No deberán confundirse.

---

# 47. Restorability

Capacidad de devolver el sistema a estado operacional aceptable.

---

# 48. Restorability ≠ Repairability

Puede restaurarse Service mediante rollback sin haber reparado todavía el Defect.

---

# 49. Testability

Capacidad de verificar comportamiento de forma aislada, determinística y suficientemente rápida.

---

# 50. Testability Drivers

Podrán incluir:

```text
dependency injection
explicit contracts
deterministic state
controlled time
isolated I/O
stable boundaries
```

---

# 51. Hidden Dependency

Reduce Testability.

---

# 52. Global State

Deberá minimizarse en lógica que requiera Tests aislados.

---

# 53. Non-Determinism

Deberá ser controlable.

Ejemplos:

```text
clock
randomness
network
filesystem
external APIs
concurrency scheduling
```

---

# 54. Test Seam

Boundary que permite sustituir Dependency o controlar Input.

---

# 55. Over-Mocking

No deberá utilizarse para ocultar Contracts incorrectos.

---

# 56. MTTD

`Mean Time To Detect`.

Mide tiempo medio desde aparición relevante del problema hasta su detección.

---

# 57. MTTI

`Mean Time To Identify/Isolate`.

Podrá utilizarse para medir localización o identificación.

---

# 58. MTTR

El acrónimo deberá definirse localmente porque puede significar:

```text
Mean Time To Repair
Mean Time To Restore
Mean Time To Recover
```

---

# 59. MEF MTTR Semantics

Toda métrica MTTR deberá declarar explícitamente cuál de las anteriores mide.

---

# 60. Mean Time To Diagnose

Podrá medirse por separado.

---

# 61. Time To Change

Tiempo desde cambio aprobado/iniciado hasta implementación lista para validación.

---

# 62. Time To Validate

Tiempo necesario para obtener evidencia suficiente de Correctness.

---

# 63. Time To Restore

Tiempo hasta restablecer Service.

---

# 64. Time To Repair

Tiempo hasta corregir Root Cause o Defect.

---

# 65. Restore Before Repair

Es una estrategia válida:

```text
FAILURE
   │
   ▼
ROLLBACK
   │
   ▼
SERVICE RESTORED
   │
   ▼
ROOT CAUSE ANALYSIS
   │
   ▼
PERMANENT FIX
```

---

# 66. Maintainability Metrics

Podrán incluir:

```text
MTTD
MTTI
time-to-diagnose
time-to-change
time-to-validate
time-to-repair
time-to-restore
change-failure-rate
change-amplification
diagnostic coverage
```

---

# 67. Maintainability Index

Podrá utilizarse como señal auxiliar.

---

# 68. Maintainability Index ≠ Contract Universal

No deberá establecerse una fórmula única como verdad arquitectónica.

---

# 69. Complexity

Podrá medirse como señal.

---

# 70. Cyclomatic Complexity

Puede aproximar cantidad de caminos lógicos independientes.

---

# 71. Cognitive Complexity

Puede aproximar dificultad humana de comprensión.

---

# 72. Complexity Threshold

Deberá ser contextual.

---

# 73. Complexity Metric Gaming

No deberá dividirse código artificialmente solo para mejorar un número.

---

# 74. Necessary Complexity

Parte de la complejidad pertenece al dominio.

---

# 75. Accidental Complexity

Proviene de estructura o implementación innecesariamente complicada.

---

# 76. Maintainability Goal

Deberá reducir especialmente Accidental Complexity.

---

# 77. Coupling

Representa dependencia entre componentes.

---

# 78. High Coupling

Puede aumentar Change Amplification.

---

# 79. Coupling Types

Podrán incluir:

```text
compile-time
runtime
data
temporal
deployment
configuration
operational
```

---

# 80. Hidden Temporal Coupling

Ejemplo:

```text
A must run before B
```

sin Contract explícito.

---

# 81. Cohesion

Representa qué tan relacionadas están las responsabilidades internas de un componente.

---

# 82. High Cohesion

Deberá favorecerse dentro de Boundaries apropiados.

---

# 83. Cohesion ≠ Large Module

Un componente grande puede tener baja Cohesion.

---

# 84. Dependency Direction

Deberá respetar Architecture.

---

# 85. Dependency Inversion

ENG-018 y ENG-021 deberán favorecer Contracts cuando reduzcan Coupling real.

---

# 86. Abstraction ≠ Maintainability Automatically

Una abstracción innecesaria puede aumentar Complexity.

---

# 87. Indirection Cost

Toda capa deberá justificar:

```text
stability
reuse
isolation
testability
extension
```

---

# 88. Dependency Depth

Cadenas muy profundas pueden dificultar análisis.

---

# 89. Circular Dependency

Reduce Maintainability y deberá evitarse conforme Architecture.

---

# 90. Dependency Graph

Deberá poder analizarse.

---

# 91. Change Impact Graph

Conceptualmente:

```text
CHANGE
  │
  ▼
COMPONENT
  │
  ├── contracts
  ├── dependents
  ├── data
  ├── configuration
  └── deployments
  │
  ▼
IMPACT
```

---

# 92. Code Smell

Señal de posible problema estructural.

No constituye Defect automáticamente.

---

# 93. Architecture Smell

Podrá incluir:

```text
cyclic dependency
god component
hidden global state
shared mutable state
layer violation
cross-module data access
```

---

# 94. Smell ≠ Mandatory Refactor

Deberá evaluarse según impacto.

---

# 95. Technical Debt

Compromiso estructural que reduce velocidad o seguridad futura de cambio.

---

# 96. Technical Debt ≠ Bad Code

Puede ser una decisión consciente con Trade-Off explícito.

---

# 97. Debt Principal

Coste estimado de eliminar o corregir Debt.

---

# 98. Debt Interest

Coste adicional recurrente provocado por mantener Debt.

Ejemplos:

```text
slower changes
extra testing
higher incident rate
manual operations
duplicate logic
```

---

# 99. Debt Metadata

Podrá incluir:

```text
owner
reason
scope
principal
interest
risk
expiration/review date
```

---

# 100. Debt Without Owner

Deberá evitarse para Debt significativa.

---

# 101. Debt Expiration

Algunas decisiones temporales deberán poseer Review Date.

---

# 102. Debt Prioritization

Deberá considerar:

```text
change frequency
failure risk
security risk
interest
business criticality
```

---

# 103. Refactoring

Cambio de estructura interna que preserva comportamiento contractual.

---

# 104. Refactoring Safety

Deberá apoyarse en Testing suficiente.

---

# 105. Behavioral Preservation

Es requisito esencial.

---

# 106. Refactoring + Contract Change

Si cambia comportamiento externo ya no deberá clasificarse únicamente como Refactoring.

---

# 107. Refactoring Scope

Deberá ser acotado cuando sea posible.

---

# 108. Large-Bang Refactoring

Deberá evitarse cuando pueda realizarse incrementalmente.

---

# 109. Branch by Abstraction

Podrá utilizarse para Refactoring gradual.

---

# 110. Strangler Pattern

Podrá utilizarse para sustituir Legacy Paths progresivamente.

---

# 111. Characterization Tests

Podrán capturar comportamiento existente antes de modificar Legacy Code.

---

# 112. Golden Master

Podrá utilizarse con cuidado cuando Contracts no estén formalizados.

---

# 113. Refactoring Regression

Deberá detectarse mediante Tests.

---

# 114. Dead Code

Código sin ruta válida de ejecución conocida.

---

# 115. Dead Code Cost

Incrementa:

```text
search space
cognitive load
security surface
test burden
upgrade burden
```

---

# 116. Dead Code Detection

Deberá favorecer evidencia antes de eliminación.

---

# 117. Dynamic Invocation

Puede dificultar análisis estático.

---

# 118. Dead Code Removal

Deberá seguir Compatibility y Release Policy.

---

# 119. Unused Dependency

Dependency no utilizada deberá eliminarse cuando sea seguro.

---

# 120. Dependency Removal Benefits

Reduce:

```text
attack surface
build complexity
upgrade burden
supply-chain exposure
```

---

# 121. Deprecated Code

Continúa disponible temporalmente pero no deberá utilizarse para nuevos consumidores.

---

# 122. Deprecation

Deberá seguir Versioning/Compatibility.

---

# 123. Deprecation Metadata

Deberá indicar:

```text
deprecated since
replacement
removal target
migration guidance
```

---

# 124. Permanent Deprecation

Deberá evitarse.

---

# 125. Deprecation Window

Debe poseer duración razonable conforme Compatibility Policy.

---

# 126. Legacy Path

Ruta mantenida por Compatibility o migración.

---

# 127. Legacy Path Ownership

Deberá ser explícito.

---

# 128. Legacy Path Exit Criteria

Deberán definirse.

---

# 129. Feature Flags as Legacy Paths

Flags temporales deberán retirarse después de transición.

---

# 130. Configuration Legacy

Keys obsoletas deberán poseer deprecation/migration.

---

# 131. Schema Legacy

Campos antiguos deberán retirarse mediante ENG-062/ENG-065.

---

# 132. Documentation Maintainability

Documentación deberá evolucionar junto con Contracts relevantes.

---

# 133. Documentation Drift

Ocurre cuando Documentation deja de representar implementación efectiva.

---

# 134. Documentation Source of Truth

Deberá definirse por tipo de información.

---

# 135. Generated Documentation

Podrá reducir Drift cuando derive de Metadata/Contracts.

---

# 136. Documentation Duplication

Deberá evitarse cuando múltiples copias puedan divergir.

---

# 137. Architecture Documentation

Deberá explicar:

```text
boundaries
dependencies
ownership
invariants
extension points
failure semantics
```

---

# 138. Runbook

Documento operativo para responder a situación conocida.

---

# 139. Runbook Scope

Podrá cubrir:

```text
diagnosis
containment
rollback
restart
failover
data repair
verification
```

---

# 140. Runbook Preconditions

Deberá declarar:

```text
authority
environment
required tools
risk
```

---

# 141. Runbook Verification

Toda acción de reparación deberá incluir verificación posterior cuando corresponda.

---

# 142. Runbook Staleness

Deberá controlarse.

---

# 143. Operational Maintainability

Capacidad de operar y reparar el sistema sin conocimiento tribal excesivo.

---

# 144. Tribal Knowledge

Deberá reducirse mediante:

```text
runbooks
diagnostics
automation
ownership
documentation
```

---

# 145. Manual Procedure

No deberá eliminarse solo por ser manual.

Deberá automatizarse cuando frecuencia, riesgo o tiempo lo justifiquen.

---

# 146. Automation ≠ Maintainability Automatically

Automatización opaca puede empeorar diagnosis.

---

# 147. Operational Escape Hatch

Operaciones críticas podrán necesitar mecanismos manuales controlados.

---

# 148. Escape Hatch Security

Deberá requerir Authority y Audit.

---

# 149. Repair Procedure

Conceptualmente:

```text
Detect
  │
  ▼
Diagnose
  │
  ▼
Contain
  │
  ▼
Restore
  │
  ▼
Repair
  │
  ▼
Validate
  │
  ▼
Monitor
```

---

# 150. Diagnosis Before Mutation

Deberá favorecerse salvo emergencia donde Restore inmediato sea prioritario.

---

# 151. Emergency Repair

Podrá reducir proceso normal, pero no deberá eliminar:

```text
authorization
audit
verification
follow-up
```

---

# 152. Hotfix

Deberá integrarse con ENG-017, ENG-066 y ENG-067.

---

# 153. Rollback

Puede mejorar Restorability.

---

# 154. Rollforward

Puede ser más mantenible cuando Persistent State impide Rollback.

---

# 155. Data Repair

Deberá seguir ENG-043, ENG-053 y ENG-065 cuando corresponda.

---

# 156. Ad-Hoc Production Mutation

Deberá evitarse.

---

# 157. Production Console

Si existe deberá tener:

```text
authorization
audit
safe operations
scope
guardrails
```

---

# 158. Change Management

Maintainability deberá integrarse con Change Risk.

---

# 159. Small Change Principle

Deberán favorecerse cambios pequeños, independientes y verificables.

---

# 160. Large Change

Podrá ser necesario, pero deberá incrementar Validation y Recovery Planning.

---

# 161. Reversibility

Cambios reversibles suelen mejorar Maintenability operacional.

---

# 162. Irreversible Change

Deberá recibir mayor revisión.

---

# 163. Change Isolation

Un cambio en un módulo no deberá obligar desplegar todo el sistema salvo necesidad arquitectónica.

---

# 164. Deployment Coupling

Deberá observarse como Maintainability concern.

---

# 165. Independent Deployability

Puede mejorar Maintainability, pero también aumentar complejidad operacional.

---

# 166. Architecture Trade-Off

No deberá maximizarse una métrica aisladamente.

---

# 167. Maintainability and Modularity

ENG-028 deberá favorecer Ownership y Local Change.

---

# 168. Maintainability and Contracts

ENG-021 permite modificar implementación manteniendo Contracts.

---

# 169. Maintainability and Dependency Injection

ENG-018 puede mejorar Testability y sustitución controlada.

---

# 170. Maintainability and Service Container

ENG-019 no deberá ocultar Dependency Graph.

---

# 171. Service Locator Smell

Resolución global arbitraria puede reducir Analyzability.

---

# 172. Maintainability and Registry

ENG-020 deberá permitir inspección.

---

# 173. Runtime Registry Dump

Podrá ayudar Diagnostics si protege información sensible.

---

# 174. Maintainability and Errors

ENG-023 deberá producir Errors suficientemente diagnósticos.

---

# 175. Error Code Stability

Ayuda Runbooks y búsqueda.

---

# 176. Generic Error

Deberá evitarse cuando impida diagnóstico.

---

# 177. Maintainability and Observability

ENG-025 proporciona señales.

---

# 178. Maintainability and Context

ENG-056 proporciona correlación.

---

# 179. Maintainability and Metadata

ENG-057 proporciona:

```text
ownership
deprecation
description
criticality
```

---

# 180. Maintainability and Configuration

ENG-049 deberá favorecer Configuration explícita, validada y explicable.

---

# 181. Configuration Sprawl

Demasiadas Keys sin Ownership reducen Maintainability.

---

# 182. Configuration Diagnosis

Deberá ser posible determinar:

```text
effective value
source
override chain
```

sin exponer Secrets.

---

# 183. Maintainability and State

ENG-053 deberá evitar State implícito difícil de inspeccionar.

---

# 184. Maintainability and Persistence

Schema/Data changes deberán poseer Migration Path.

---

# 185. Maintainability and Plugins

ENG-060 deberá impedir que Extensions creen dependencias ocultas.

---

# 186. Maintainability and Health

ENG-069 deberá facilitar localización de componentes degradados.

---

# 187. Maintainability and Reliability

ENG-074 proporciona Failure Modes y Recurrence.

ENG-075 utiliza esa evidencia para mejorar Repairability y prevención.

---

# 188. Maintainability and Availability

Lower diagnosis/restore times pueden aumentar Availability.

---

# 189. Maintainability and Performance

Performance optimization no deberá introducir estructuras incomprensibles sin beneficio medido suficiente.

---

# 190. Performance Complexity Tax

Toda optimización compleja deberá justificar coste de mantenimiento.

---

# 191. Maintainability and Security

ENG-024 gobernará Security general.

---

# 192. Maintainability Security

Cambios fáciles no deberán significar cambios sin control.

---

# 193. Debug Interface

No deberá exponer:

```text
secrets
credentials
sensitive state
internal administrative actions
```

---

# 194. Diagnostic Access

Deberá aplicar Least Privilege.

---

# 195. Production Debugging

Deberá utilizar herramientas autorizadas.

---

# 196. Temporary Debug Code

Deberá poseer Cleanup.

---

# 197. Debug Backdoor

Queda prohibida.

---

# 198. Repair Authorization

Deberá ser proporcional al impacto.

---

# 199. Maintainability Audit

Cambios críticos deberán ser auditables.

---

# 200. Audit Events

Podrán incluir:

```text
technical debt accepted
technical debt retired
deprecated API extended
runbook executed
emergency repair executed
maintenance gate overridden
production diagnostic access
manual data repair
```

---

# 201. Maintainability Observability

ENG-025 gobernará Telemetry.

---

# 202. Metrics

Podrán incluir:

```text
mef.maintainability.time_to_detect
mef.maintainability.time_to_diagnose
mef.maintainability.time_to_restore
mef.maintainability.time_to_repair

mef.maintainability.change_failure_rate
mef.maintainability.change_scope
mef.maintainability.change_amplification

mef.maintainability.debt.total
mef.maintainability.deprecation.total
mef.maintainability.dead_code.total
```

---

# 203. Metric Caveat

Maintainability Metrics deberán utilizarse como señales.

No deberán convertirse en objetivos fácilmente manipulables sin contexto.

---

# 204. Change Failure Rate

Podrá medir proporción de cambios que causan:

```text
rollback
incident
hotfix
repair
```

según definición explícita.

---

# 205. Change Failure Rate ≠ Reliability Failure Rate

No deberán confundirse.

---

# 206. Diagnostic Coverage Metric

Podrá medir qué Failure Modes poseen:

```text
error code
telemetry
runbook
owner
```

---

# 207. Maintainability Snapshot

Conceptualmente:

```text
MaintainabilitySnapshot
├── observedAt
├── diagnosticCoverage
├── changeRisk
├── changeAmplification
├── technicalDebt
├── deprecations
├── repairability
└── state
```

---

# 208. Maintainability State

Podrá clasificarse:

```text
HEALTHY
DEGRADED
HIGH_RISK
REGRESSION
UNKNOWN
```

---

# 209. HEALTHY

Maintainability Requirements relevantes se satisfacen.

---

# 210. DEGRADED

Signals indican deterioro manejable.

---

# 211. HIGH_RISK

Cambios o reparación presentan riesgo elevado.

---

# 212. REGRESSION

Nueva versión incrementó significativamente Maintenance Cost/Risk.

---

# 213. UNKNOWN

No existe evidencia suficiente.

---

# 214. UNKNOWN ≠ HEALTHY

Ausencia de métricas no prueba Maintainability.

---

# 215. Maintainability Baseline

Representa estado conocido.

---

# 216. Baseline Dimensions

Podrán incluir:

```text
diagnosis time
change scope
complexity
coupling
test duration
technical debt
deprecation
runbook coverage
```

---

# 217. Maintainability Regression

Nueva Version empeora significativamente Maintainability.

---

# 218. Regression Examples

```text
same feature requires 2x modules changed
diagnosis takes 3x longer
integration test duration doubles
new hidden dependency introduced
new cyclic dependency introduced
```

---

# 219. Regression ≠ More Lines

Cantidad de líneas no es indicador suficiente.

---

# 220. Maintainability Gate

Podrá impedir Promotion ante Regression crítica.

---

# 221. Gate Inputs

Podrán incluir:

```text
dependency cycles
architecture violations
critical complexity
missing owner
missing tests
missing migration
unbounded technical debt
critical deprecation
```

---

# 222. Gate Override

Deberá requerir Authority y Audit.

---

# 223. Maintainability Review

Deberá ocurrir ante:

```text
architecture change
major dependency change
large refactor
recurring incident
critical technical debt
module split/merge
legacy removal
```

---

# 224. Code Ownership

Componentes críticos deberán tener Owner.

---

# 225. Orphan Code

Código sin Owner deberá detectarse cuando sea relevante.

---

# 226. Bus Factor

Podrá utilizarse como riesgo organizacional auxiliar.

No deberá inferirse únicamente del historial Git.

---

# 227. Knowledge Distribution

Deberá favorecerse en componentes críticos.

---

# 228. Documentation Review

Cambios contractuales deberán revisar documentación asociada.

---

# 229. Runbook Review

Incidentes deberán validar si Runbook fue suficiente.

---

# 230. Incident Learning

Failure recurrente deberá producir cambios en:

```text
tests
diagnostics
runbook
architecture
automation
```

cuando corresponda.

---

# 231. Technical Debt Registry

ENG-020 podrá registrar Debt metadata si se implementa.

---

# 232. Debt Registry ≠ Project Manager

No deberá duplicar herramientas externas completas.

---

# 233. Deprecation Registry

Podrá registrar:

```text
deprecated item
replacement
since
removal version
consumers
```

---

# 234. Dead-Code Registry

Normalmente no será necesario persistirlo; Build Analysis podrá calcularlo.

---

# 235. Testing

ENG-009 gobernará Testing.

---

# 236. Analyzability Test

Podrá comprobar existencia de:

```text
owner
contract
metadata
dependency graph
documentation
```

para componentes críticos.

---

# 237. Diagnosability Test

Deberá simular Failure y comprobar si puede localizarse.

---

# 238. Error Diagnostic Test

Deberá verificar:

```text
error code
correlation
component
safe reason
```

---

# 239. Change Impact Test

Podrá comprobar Boundary mediante Architecture Tests.

---

# 240. Modifiability Test

Podrá implementar cambio representativo y medir Scope cuando sea apropiado.

---

# 241. Repairability Test

Deberá simular Defect conocido y ejecutar Repair Procedure.

---

# 242. Restore Test

Deberá comprobar:

```text
rollback
restart
failover
restore
```

según Contract.

---

# 243. Testability Test

Deberá comprobar que Dependencies relevantes puedan controlarse.

---

# 244. Refactoring Test

Deberá demostrar Behavioral Preservation.

---

# 245. Deprecation Test

Deberá detectar uso de elementos deprecated.

---

# 246. Dead Code Test

Podrá identificar código no alcanzable con cautela ante Dynamic Invocation.

---

# 247. Dependency Cycle Test

Deberá detectar Cycles prohibidos.

---

# 248. Complexity Test

Podrá producir Warning/Gate según Scope.

---

# 249. Runbook Test

Runbooks críticos deberán probarse periódicamente cuando sea viable.

---

# 250. Documentation Drift Test

Podrá comparar Metadata/Contracts con documentación generada.

---

# 251. Security Test

Deberá intentar:

```text
unauthorized debug access
production diagnostic escalation
debug secret disclosure
repair authorization bypass
unsafe manual data repair
deprecated insecure path usage
```

---

# 252. Architecture Test

Podrá impedir:

```text
dependency cycles
cross-module internal access
global service locator
hidden mutable global state
critical component without owner
deprecated API used by new code
architecture bypass for convenience
```

---

# 253. Build Integration

ENG-012 podrá validar:

```text
dependency direction
cycles
deprecated usage
dead code
unused dependencies
complexity thresholds
missing metadata
missing ownership
missing tests
```

---

# 254. Static Analysis

Podrá contribuir a Maintainability mediante:

```text
type checking
linting
complexity analysis
dependency analysis
dead-code detection
security analysis
```

---

# 255. Static Analysis ≠ Proof

Resultados deberán interpretarse dentro del contexto.

---

# 256. CLI

ENG-007 podrá proporcionar:

```text
mef maintainability
mef maintainability:diagnose
mef maintainability:impact
mef maintainability:dependencies
mef maintainability:complexity
mef maintainability:debt
mef maintainability:deprecated
mef maintainability:dead-code
mef maintainability:runbook
mef maintainability:compare
```

---

# 257. `mef maintainability`

Podrá mostrar Snapshot general.

---

# 258. `maintainability:diagnose`

Podrá mostrar:

```text
diagnostic coverage
owners
error taxonomy
runbook coverage
```

---

# 259. `maintainability:impact`

Podrá estimar Change Impact.

---

# 260. `maintainability:dependencies`

Podrá mostrar Dependency Graph y Cycles.

---

# 261. `maintainability:complexity`

Podrá mostrar:

```text
cyclomatic
cognitive
dependency depth
hotspots
```

---

# 262. `maintainability:debt`

Podrá mostrar Debt registrada.

---

# 263. `maintainability:deprecated`

Podrá mostrar:

```text
item
since
replacement
removal target
consumers
```

---

# 264. `maintainability:dead-code`

Podrá mostrar candidatos con Confidence.

---

# 265. `maintainability:runbook`

Podrá verificar cobertura de procedimientos.

---

# 266. `maintainability:compare`

Podrá comparar Baseline/Candidate.

---

# 267. Registry Integration

ENG-020 podrá registrar:

```text
MaintainabilityRequirement
MaintainabilityPolicy
TechnicalDebt
Deprecation
RunbookReference
MaintainabilityGate
```

---

# 268. Maintainability Requirement Contract

Conceptualmente:

```text
MaintainabilityRequirement
├── id
├── scope
├── activity
├── target
├── measurement
├── conditions
└── metadata
```

---

# 269. Change Impact

Conceptualmente:

```text
ChangeImpact
├── source
├── components
├── contracts
├── data
├── configuration
├── tests
├── deployments
└── risk
```

---

# 270. Change Risk

Conceptualmente:

```text
ChangeRisk
├── scope
├── criticality
├── coupling
├── testability
├── reversibility
├── dataImpact
└── score
```

---

# 271. Technical Debt

Conceptualmente:

```text
TechnicalDebt
├── id
├── scope
├── reason
├── owner
├── principal
├── interest
├── risk
├── acceptedAt
└── reviewAt
```

---

# 272. Deprecation

Conceptualmente:

```text
Deprecation
├── item
├── deprecatedSince
├── replacement
├── removalTarget
├── consumers
└── migrationGuide
```

---

# 273. Runbook Reference

Conceptualmente:

```text
RunbookReference
├── id
├── scenario
├── owner
├── authority
├── verification
├── lastTestedAt
└── location
```

---

# 274. Maintainability Baseline

Conceptualmente:

```text
MaintainabilityBaseline
├── version
├── diagnosticCoverage
├── changeAmplification
├── complexity
├── coupling
├── technicalDebt
├── testability
└── recordedAt
```

---

# 275. Maintainability Comparison

Conceptualmente:

```text
MaintainabilityComparison
├── baseline
├── candidate
├── improvements
├── regressions
├── newDebt
├── removedDebt
└── riskDelta
```

---

# 276. Maintainability Gate

Conceptualmente:

```text
MaintainabilityGate
├── requirement
├── baseline
├── threshold
├── violations
└── evaluate
```

---

# 277. Maintainability Runtime

Conceptualmente:

```text
MaintainabilityRuntime
├── inspect
├── impact
├── diagnose
├── debt
├── deprecated
├── compare
└── report
```

---

# 278. Runtime Maintainability

Runtime deberá facilitar inspección sin permitir mutación arbitraria.

---

# 279. Diagnostic Snapshot

Podrá incluir:

```text
version
environment
modules
dependencies
health
configuration sources
recent failures
```

sin Secrets.

---

# 280. First Implementation Components

La primera implementación deberá incluir:

```text
MaintainabilityState

MaintainabilityRequirement

ChangeImpact
ChangeRisk

MaintainabilityBaseline
MaintainabilityComparison

MaintainabilityPolicy
MaintainabilityGate

TechnicalDebt
Deprecation
RunbookReference

MaintainabilityRegistry
MaintainabilityError
```

---

# 281. Optional Initial Components

Podrán incorporarse:

```text
ComplexityAnalyzer
DependencyAnalyzer
DeadCodeAnalyzer

DiagnosticCoverage

MaintainabilityRuntime
MaintainabilitySnapshot
MaintainabilityDiagnostics
```

---

# 282. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Refactoring Planner
Automated Technical Debt Prioritization
Predictive Change Risk
Semantic Change Impact Analysis
Automated Runbook Generation
AI-Assisted Maintainability Analysis
```

---

# 283. Estructura Conceptual de Directorios

```text
src/
└── Maintainability/
    ├── State/
    │   └── MaintainabilityState
    │
    ├── Requirement/
    │   └── MaintainabilityRequirement
    │
    ├── Change/
    │   ├── ChangeImpact
    │   └── ChangeRisk
    │
    ├── Analysis/
    │   ├── ComplexityAnalyzer
    │   ├── DependencyAnalyzer
    │   └── DeadCodeAnalyzer
    │
    ├── Diagnosis/
    │   └── DiagnosticCoverage
    │
    ├── Debt/
    │   └── TechnicalDebt
    │
    ├── Deprecation/
    │   └── Deprecation
    │
    ├── Operations/
    │   └── RunbookReference
    │
    ├── Baseline/
    │   └── MaintainabilityBaseline
    │
    ├── Comparison/
    │   └── MaintainabilityComparison
    │
    ├── Policy/
    │   └── MaintainabilityPolicy
    │
    ├── Gate/
    │   └── MaintainabilityGate
    │
    ├── Runtime/
    │   └── MaintainabilityRuntime
    │
    ├── Snapshot/
    │   └── MaintainabilitySnapshot
    │
    ├── Registry/
    │   └── MaintainabilityRegistry
    │
    ├── Diagnostics/
    │   └── MaintainabilityDiagnostics
    │
    └── Error/
        └── MaintainabilityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 284. Error Namespace

ENG-075 utilizará:

```text
MEF-MAINTAIN-xxx
```

---

# 285. Taxonomía ENG-075

```text
MEF-MAINTAIN-001 Maintainability requirement invalid
MEF-MAINTAIN-002 Maintainability objective invalid
MEF-MAINTAIN-003 Maintainability analysis failed
MEF-MAINTAIN-004 Maintainability diagnostic coverage insufficient
MEF-MAINTAIN-005 Maintainability change impact unknown
MEF-MAINTAIN-006 Maintainability change risk excessive
MEF-MAINTAIN-007 Maintainability dependency cycle detected
MEF-MAINTAIN-008 Maintainability dependency direction violated
MEF-MAINTAIN-009 Maintainability complexity threshold exceeded
MEF-MAINTAIN-010 Maintainability coupling excessive
MEF-MAINTAIN-011 Maintainability technical debt invalid
MEF-MAINTAIN-012 Maintainability technical debt overdue
MEF-MAINTAIN-013 Maintainability deprecated usage detected
MEF-MAINTAIN-014 Maintainability removal blocked by consumer
MEF-MAINTAIN-015 Maintainability dead code detected
MEF-MAINTAIN-016 Maintainability unused dependency detected
MEF-MAINTAIN-017 Maintainability runbook missing
MEF-MAINTAIN-018 Maintainability runbook stale
MEF-MAINTAIN-019 Maintainability repair procedure failed
MEF-MAINTAIN-020 Maintainability restore procedure failed
MEF-MAINTAIN-021 Maintainability refactoring regression
MEF-MAINTAIN-022 Maintainability documentation drift detected
MEF-MAINTAIN-023 Maintainability ownership missing
MEF-MAINTAIN-024 Maintainability regression detected
MEF-MAINTAIN-025 Maintainability gate failed
MEF-MAINTAIN-026 Maintainability gate override denied
MEF-MAINTAIN-027 Maintainability diagnostic access denied
MEF-MAINTAIN-028 Maintainability security violation
MEF-MAINTAIN-029 Maintainability state unknown
MEF-MAINTAIN-030 Maintainability invariant violation
```

---

# 286. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Maintainability Requirements

Analyzability
Diagnosability
Modifiability
Repairability
Testability

Explicit Change Scope
Change Impact
Change Risk

Dependency Graph
Dependency Direction
Cycle Detection

Diagnostic Coverage

Technical Debt Ownership
Deprecation Lifecycle

Runbook Coverage

Maintainability Baselines
Regression Detection

Security
Audit
Observability
Testing
```

---

# 287. First Version Non-Goals

No deberá requerir:

```text
Automatic Refactoring Planner
Predictive Change Risk
Semantic Whole-System Impact Analysis
Automatic Debt Prioritization
Automated Runbook Generation
AI-Assisted Maintainability Engineering
```

---

# 288. Second Phase

Podrá incorporar:

```text
Complexity Analyzer
Dependency Analyzer
Dead-Code Analyzer

Diagnostic Coverage

Maintainability Gates
Advanced Change Impact

Debt Interest Analysis
Runbook Validation
```

---

# 289. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automatic Refactoring Planning
Predictive Change Risk
Semantic Change Impact
Automatic Debt Prioritization
Automated Runbook Generation
AI-Assisted Maintainability Analysis
```

---

# 290. Invariantes de Ingeniería

ENG-075 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1446 | Todo Maintainability Requirement contractual deberá declarar Scope, Maintenance Activity, Objective, Measurement Method y Operating Conditions suficientes para ser verificable. |
| EI-1447 | Maintainability deberá permanecer diferenciada de Reliability, Availability, Code Quality, Complexity, Refactoring y Automation y ninguna métrica aislada deberá utilizarse como prueba universal de Maintainability. |
| EI-1448 | MEF deberá tratar Analyzability, Diagnosability, Modifiability, Repairability y Testability como dimensiones relacionadas pero diferenciadas y una mejora en una de ellas no deberá asumirse automáticamente como mejora global. |
| EI-1449 | Componentes críticos deberán exponer Ownership, Contracts, Metadata y Dependency Information suficientes para permitir determinar qué hacen, de qué dependen, quién los mantiene y qué puede verse afectado por un cambio. |
| EI-1450 | Diagnosis deberá distinguir Detection, Identification, Localization y Root Cause y un Symptom no deberá registrarse como Root Cause únicamente para cerrar un incidente. |
| EI-1451 | Change Scope, Change Impact y Change Risk deberán evaluarse respecto de Contracts, Data, Configuration, Dependencies, Tests, Deployment y Reversibility y el tamaño textual de un cambio no deberá utilizarse como único indicador de riesgo. |
| EI-1452 | Architecture deberá favorecer Local Change, Cohesion y Dependency Direction estable y deberá detectar Cycles, Hidden Dependencies, Global Mutable State, Service Locator abuse y otras estructuras que amplifiquen cambios innecesariamente. |
| EI-1453 | Testability deberá favorecer Dependencies explícitas, State determinístico y control de Time, Randomness, I/O y External Systems, sin utilizar Over-Mocking para ocultar Contracts inválidos. |
| EI-1454 | MTTD, MTTI y MTTR deberán declarar su semántica exacta y Restore, Recover y Repair no deberán utilizarse intercambiablemente cuando representen momentos distintos del ciclo de mantenimiento. |
| EI-1455 | Complexity, Coupling, Cohesion, Dependency Depth y Maintainability Index deberán utilizarse como señales contextuales y no deberán convertirse en objetivos susceptibles de gaming o sustitutos automáticos de revisión arquitectónica. |
| EI-1456 | Technical Debt significativa deberá poseer Scope, Reason, Owner, Risk y Review/Exit Criteria explícitos y los Workarounds temporales no deberán convertirse silenciosamente en arquitectura permanente. |
| EI-1457 | Refactoring deberá preservar comportamiento contractual y apoyarse en Testing suficiente; cambios de Contract, Semantics o Data no deberán etiquetarse únicamente como Refactoring para reducir controles de revisión. |
| EI-1458 | Deprecated y Legacy Paths deberán poseer Replacement y Exit/Removal Criteria y no deberán mantenerse indefinidamente sin Consumers conocidos, Compatibility Requirement o Ownership explícito. |
| EI-1459 | Dead Code, Unused Dependencies y obsolescencia deberán eliminarse de forma segura cuando exista evidencia suficiente, considerando Dynamic Invocation, Compatibility y Release Policy antes de suprimirlos. |
| EI-1460 | Operational Maintainability deberá reducir Tribal Knowledge mediante Runbooks, Diagnostics, Automation explicable y Ownership, y los procedimientos críticos deberán incluir Preconditions, Authority, Verification y revisión periódica. |
| EI-1461 | Maintainability Security deberá proteger Debug/Diagnostic Interfaces, Production Repair Operations, Manual Data Mutation y Escape Hatches mediante Least Privilege, Audit y Guardrails y ningún Debug Backdoor deberá aceptarse. |
| EI-1462 | Maintainability Observability deberá permitir medir tiempos de Detection, Diagnosis, Restore, Repair, Change Scope, Change Failure, Debt y Diagnostic Coverage sin convertir estas métricas en incentivos de gaming ni producir Cardinality descontrolada. |
| EI-1463 | Maintainability Testing deberá cubrir Analyzability, Diagnosability, Change Impact, Modifiability, Repairability, Restorability, Testability, Refactoring Safety, Deprecation, Dependency Cycles, Runbooks, Documentation Drift y Security según Architecture. |
| EI-1464 | Build y Architecture Tests deberán detectar Dependency Cycles, Direction Violations, Global Service Locator abuse, Hidden Mutable State, Critical Components sin Owner, Deprecated APIs usados por nuevo código, Missing Tests y otras violaciones estructurales definidas por Policy. |
| EI-1465 | La primera implementación deberá priorizar Requirements, Ownership, Analyzability, Diagnosability, Change Impact/Risk, Dependency Graphs, Testability, Technical Debt, Deprecation, Runbook Coverage, Baselines y Regression Detection antes de introducir Predictive Change Risk, Automatic Refactoring o AI-Assisted Maintainability. |

---

# 291. Continuidad de Invariantes

```text
ENG-071 → EI-1366 a EI-1385
ENG-072 → EI-1386 a EI-1405
ENG-073 → EI-1406 a EI-1425
ENG-074 → EI-1426 a EI-1445
ENG-075 → EI-1446 a EI-1465
```

---

# 292. Criterios de Conformidad

Una implementación será conforme con ENG-075 cuando:

- defina Maintainability Requirements;
- modele Analyzability;
- modele Diagnosability;
- modele Modifiability;
- modele Repairability;
- modele Testability;
- declare Ownership;
- exponga Dependency Graph;
- controle Dependency Direction;
- detecte Cycles;
- identifique Change Scope;
- evalúe Change Impact;
- evalúe Change Risk;
- diferencie Restore y Repair;
- defina semántica de MTTD/MTTI/MTTR;
- mida Diagnostic Coverage;
- utilice Complexity como señal;
- analice Coupling/Cohesion;
- controle Technical Debt;
- defina Debt Owner;
- controle Refactoring;
- preserve Behavioral Contracts;
- gestione Deprecation;
- defina Removal Criteria;
- controle Legacy Paths;
- detecte Dead Code;
- detecte Unused Dependencies;
- mantenga Runbooks;
- controle Documentation Drift;
- mantenga Baselines;
- detecte Maintainability Regression;
- proteja Diagnostic Access;
- audite Repairs críticas;
- implemente Maintainability Testing.

---

# 293. Riesgos

Deberán evitarse especialmente:

```text
Maintainability Equals Low Complexity
Maintainability Index as Truth
Lines of Code as Maintainability

Hidden Dependencies
Global Mutable State
Global Service Locator
Dependency Cycle

Small Diff Equals Low Risk
Large Diff Equals High Risk Automatically

Symptom Equals Root Cause
No Diagnostic Context
Log Volume Equals Diagnosability

MTTR Without Definition
Restore Equals Repair

Technical Debt Without Owner
Temporary Workaround Becomes Permanent

Permanent Deprecation
Legacy Path Without Exit Criteria

Dead Code Kept Forever
Unused Dependencies

Refactoring Without Tests
Behavior Change Called Refactoring

Tribal Knowledge
Stale Runbooks

Debug Backdoor
Production Mutation Without Audit

Automation That Cannot Be Diagnosed
```

---

# 294. Relación con ENG-018

Dependency Injection puede mejorar:

```text
explicit dependencies
testability
substitutability
```

si no introduce Indirection innecesaria.

---

# 295. Relación con ENG-019

Service Container deberá conservar Dependency Graph explicable.

```text
container resolution
≠
dependency invisibility
```

---

# 296. Relación con ENG-020

Registry deberá facilitar introspección de:

```text
components
owners
contracts
metadata
deprecations
```

---

# 297. Relación con ENG-023

Error Handling deberá favorecer Diagnosis mediante:

```text
stable code
safe context
cause
scope
correlation
```

---

# 298. Relación con ENG-025

Observability proporciona Signals.

Maintainability transforma Signals en capacidad efectiva de diagnóstico y reparación.

---

# 299. Relación con ENG-028

Module Boundaries deberán favorecer Local Change y Cohesion.

---

# 300. Relación con ENG-049

Configuration deberá permanecer explicable:

```text
effective value
source
override
validation
```

---

# 301. Relación con ENG-057

Metadata deberá proveer Ownership, Description, Criticality y Deprecation Information.

---

# 302. Relación con ENG-074

Reliability responde:

```text
Why and how often does the system fail?
```

Maintainability responde:

```text
How quickly and safely can engineers
understand, diagnose and repair it?
```

---

# 303. Relación con ENG-073

Maintainability puede mejorar Availability reduciendo:

```text
time to detect
time to diagnose
time to restore
```

pero no sustituye Redundancy o Failover.

---

# 304. Relación con ENG-076

**ENG-076 deberá formalizar Recoverability Engineering.**

La frontera será:

```text
RELIABILITY
ENG-074
→ How consistently does the system
  avoid failure?

MAINTAINABILITY
ENG-075
→ How efficiently can engineers
  diagnose, change and repair it?

RECOVERABILITY
ENG-076
→ After a failure or disaster,
  how can the system restore service,
  state and data to an acceptable point?
```

ENG-076 deberá cubrir:

```text
Recoverability
Recovery Requirement
Recovery Objective

Recovery Point Objective
RPO

Recovery Time Objective
RTO

Recovery Point
Recovery Window

Recovery Procedure
Recovery Plan

Recovery State

Backup
Restore
Recovery Backup

Snapshot
Checkpoint

Point-In-Time Recovery

Rollback
Rollforward

State Recovery
Data Recovery
Configuration Recovery
Secret Recovery

Application Recovery
Service Recovery
Environment Recovery

Dependency Recovery

Partial Recovery
Degraded Recovery

Disaster Recovery
DR Strategy

Cold Recovery
Warm Recovery
Hot Recovery

Recovery Site
Failover Site

Recovery Consistency
Recovery Integrity

Recovery Verification

Recovery Drill
Recovery Exercise

Recovery Readiness

Recovery Security
Recovery Audit
Recovery Observability
Recovery Testing
```

---

# 305. Principio Rector

> **MEF deberá diseñarse para que comprender y cambiar el sistema sea una operación controlada, no una investigación arqueológica. La Maintainability deberá reducir incertidumbre, Change Amplification y Time To Diagnose/Repair mediante Boundaries claros, Dependencies explícitas, Diagnostics útiles, Testability, Ownership, Debt gobernada y procedimientos verificables.**

---

# 306. Conclusión

**ENG-075 — Maintainability Engineering** formaliza la capacidad de comprender, modificar y reparar MEF de forma segura.

Las dimensiones principales quedan:

```text
MAINTAINABILITY
      │
      ├── ANALYZABILITY
      ├── DIAGNOSABILITY
      ├── MODIFIABILITY
      ├── REPAIRABILITY
      └── TESTABILITY
```

El flujo de diagnóstico queda:

```text
PROBLEM
   │
   ▼
DETECT
   │
   ▼
IDENTIFY
   │
   ▼
LOCALIZE
   │
   ▼
ROOT CAUSE
   │
   ▼
REPAIR
```

No:

```text
SYMPTOM
=
ROOT CAUSE
```

El ciclo operacional queda:

```text
FAILURE
   │
   ▼
DETECT
   │
   ▼
DIAGNOSE
   │
   ▼
CONTAIN
   │
   ▼
RESTORE SERVICE
   │
   ▼
REPAIR ROOT CAUSE
   │
   ▼
VALIDATE
```

Esto permite separar:

```text
Time To Detect
Time To Diagnose
Time To Restore
Time To Repair
```

en lugar de ocultarlos todos bajo un `MTTR` ambiguo.

El cambio mantenible queda:

```text
CHANGE REQUEST
      │
      ▼
IMPACT ANALYSIS
      │
      ▼
CHANGE RISK
      │
      ▼
LOCAL MODIFICATION
      │
      ▼
TEST
      │
      ▼
DEPLOY
      │
      ▼
VERIFY
```

El Technical Debt queda:

```text
DEBT
 │
 ├── principal
 ├── interest
 ├── risk
 ├── owner
 └── exit criteria
```

y no simplemente:

```text
TODO someday
```

La Deprecation queda:

```text
ACTIVE
  │
  ▼
DEPRECATED
  │
  ├── replacement
  ├── migration guide
  └── removal target
  │
  ▼
REMOVED
```

La relación con Reliability queda:

```text
RELIABILITY
ENG-074
│
└── failures should occur less often
        │
        ▼
MAINTAINABILITY
ENG-075
│
└── failures and changes should be
    easier to understand and repair
```

La cadena reciente queda:

```text
CAPACITY
ENG-071
   │
   ▼
SCALABILITY
ENG-072
   │
   ▼
AVAILABILITY
ENG-073
   │
   ▼
RELIABILITY
ENG-074
   │
   ▼
MAINTAINABILITY
ENG-075
   │
   ▼
RECOVERABILITY
ENG-076
```

La primera implementación deberá concentrarse en:

```text
MaintainabilityState

MaintainabilityRequirement

ChangeImpact
ChangeRisk

MaintainabilityBaseline
MaintainabilityComparison

MaintainabilityPolicy
MaintainabilityGate

TechnicalDebt
Deprecation
RunbookReference

MaintainabilityRegistry
MaintainabilityError
```

con:

```text
Ownership
Analyzability
Diagnosability
Modifiability
Repairability
Testability

Change Scope
Change Impact
Change Risk

Dependency Graphs
Dependency Direction
Cycle Detection

Diagnostic Coverage

Technical Debt Governance
Deprecation Lifecycle
Dead-Code Awareness

Runbooks
Documentation Drift

Baselines
Regression Detection

Security
Audit
Observability
Testing
```

antes de introducir:

```text
Automatic Refactoring Planner
Predictive Change Risk
Semantic Change Impact Analysis
Automatic Debt Prioritization
Automated Runbook Generation
AI-Assisted Maintainability Analysis
```

Con **ENG-075**, la serie global alcanza:

```text
EI-1465
```

---

# Referencias

## Arquitectura

- ARQ-004 — Modules
- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-014 — Versionado
- ENG-016 — Compatibility
- ENG-018 — Dependency Injection
- ENG-019 — Service Container
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-028 — Module Engineering
- ENG-034 — Application Engineering
- ENG-035 — Domain Engineering
- ENG-036 — Validation Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-049 — Configuration Management Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-060 — Extension & Plugin Engineering
- ENG-069 — Health & Readiness Engineering
- ENG-070 — Performance Engineering
- ENG-073 — Availability Engineering
- ENG-074 — Reliability Engineering
- ENG-076 — Recoverability Engineering
```