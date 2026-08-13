---
id: ENG-016
titulo: Compatibility
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Compatibility
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
  - ENG-015
  - ARQ-004
  - ARQ-006
  - ARQ-011
  - ARQ-013
  - ARQ-014
  - ARQ-016
  - ARQ-017
relacionados:
  - ENG-007
  - ENG-017
keywords:
  - compatibility
  - compatibility engine
  - compatibility matrix
  - contracts
  - packages
  - modules
  - schemas
  - runtime
  - platform
  - protocols
  - dependency resolution
  - mef
---

# ENG-016

# Compatibility

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Compatibility** de **MEF (Modular Enterprise Framework)**.

ENG-016 establece cómo determinar si:

- Frameworks;
- Packages;
- Modules;
- Contracts;
- Schemas;
- Configurations;
- Runtimes;
- Platforms;
- Protocols;
- APIs;
- herramientas;

pueden coexistir y operar correctamente dentro de una solución MEF.

El objetivo es convertir la compatibilidad en una propiedad:

```text
Explicit
+
Declarative
+
Deterministic
+
Verifiable
+
Diagnosable
```

y no en una suposición descubierta únicamente durante Runtime.

---

# 2. Declaración

En MEF:

```text
Installed
≠
Compatible
```

y:

```text
Resolvable
≠
Executable
```

La compatibilidad deberá comprobarse explícitamente antes de permitir determinadas operaciones arquitectónicas.

---

# 3. Modelo General

Conceptualmente:

```text
Consumer
   │
   ▼
Requirements
   │
   ▼
Compatibility Engine
   │
   ├── Framework
   ├── Package
   ├── Contract
   ├── Schema
   ├── Runtime
   ├── Platform
   ├── Protocol
   └── Policy
   │
   ▼
Compatibility Result
```

---

# 4. Objetivos

El sistema de Compatibility deberá:

- declarar requisitos;
- verificar capacidades;
- comparar versiones;
- detectar incompatibilidades;
- detectar Breaking Changes;
- impedir activaciones inválidas;
- proporcionar diagnósticos;
- integrarse con Dependency Resolution;
- integrarse con Build;
- integrarse con Package Manager;
- integrarse con Lifecycle;
- integrarse con Release;
- permitir automatización.

---

# 5. Compatibility

Dos componentes son compatibles cuando pueden interactuar bajo sus Contracts y garantías declaradas sin violar restricciones arquitectónicas conocidas.

---

# 6. Compatibility no es Igualdad

No deberá exigirse:

```text
Version A = Version B
```

para declarar compatibilidad.

Ejemplo:

```text
PKG-CRM 3.4.2
```

podrá ser compatible con:

```text
MEF 2.7.1
```

si sus restricciones lo permiten.

---

# 7. Compatibility Dimensions

MEF reconoce inicialmente:

```text
Framework Compatibility
Package Compatibility
Module Compatibility
Contract Compatibility
Schema Compatibility
Configuration Compatibility
Runtime Compatibility
Platform Compatibility
Protocol Compatibility
Security Compatibility
```

---

# 8. Multidimensional Compatibility

La compatibilidad total deberá evaluarse como composición de dimensiones.

Conceptualmente:

```text
Compatible =
Framework
AND Package
AND Contract
AND Schema
AND Runtime
AND Platform
AND Protocol
AND Policy
```

según las dimensiones aplicables.

---

# 9. Not Applicable

Una dimensión que no aplique deberá representarse como:

```text
NOT_APPLICABLE
```

y no como fallo.

---

# 10. Compatibility Result

El resultado mínimo deberá distinguir:

```text
COMPATIBLE
INCOMPATIBLE
UNKNOWN
```

Podrán añadirse:

```text
COMPATIBLE_WITH_WARNINGS
DEPRECATED
NOT_APPLICABLE
```

cuando corresponda.

---

# 11. Compatible

`COMPATIBLE` significa que todos los requisitos obligatorios evaluables fueron satisfechos.

---

# 12. Incompatible

`INCOMPATIBLE` significa que al menos una condición obligatoria conocida no fue satisfecha.

---

# 13. Unknown

`UNKNOWN` significa que no existe información suficiente para demostrar compatibilidad o incompatibilidad.

`UNKNOWN` no deberá interpretarse automáticamente como `COMPATIBLE`.

---

# 14. Compatible With Warnings

Podrá utilizarse cuando:

- existe Deprecation;
- existe una condición no crítica;
- se utiliza una capacidad próxima a EOL;
- existe una excepción permitida.

---

# 15. Compatibility Requirement

Un consumidor deberá poder declarar Requirements.

Ejemplo:

```text
PKG-CRM
requires
CTR-IDENTITY >=2.0 <3.0
```

---

# 16. Capability

Un proveedor deberá poder declarar capacidades.

Ejemplo:

```text
MOD-IDENTITY
provides
CTR-IDENTITY 2.4.1
```

---

# 17. Requirement Matching

Conceptualmente:

```text
Requirement
    │
    ▼
Constraint
    │
    ▼
Provided Capability
    │
    ▼
Match?
```

---

# 18. Compatibility Contract

La compatibilidad deberá derivarse principalmente de Contracts y metadata explícita.

No deberá depender de:

```text
"probablemente funciona"
```

---

# 19. Framework Compatibility

Un Package podrá declarar qué versiones de MEF soporta.

Ejemplo conceptual:

```yaml
compatibility:
  mef: ">=2.0 <3.0"
```

---

# 20. Framework Compatibility Check

Si:

```text
Installed MEF:
3.1.0

Package Requirement:
>=2.0 <3.0
```

el resultado será:

```text
INCOMPATIBLE
```

---

# 21. Framework Minimum Version

Un Package podrá requerir una versión mínima por utilizar una capacidad introducida posteriormente.

Ejemplo:

```text
requires MEF >=2.5
```

---

# 22. Framework Maximum Version

Un límite superior podrá utilizarse cuando una futura versión MAJOR no esté garantizada.

Ejemplo:

```text
>=2.5 <3.0
```

---

# 23. Package Compatibility

Packages podrán declarar dependencias sobre otros Packages.

Ejemplo:

```text
PKG-SALES
requires
PKG-CRM ^3.0
```

---

# 24. Package Conflict

También podrá declararse incompatibilidad explícita.

Ejemplo conceptual:

```text
PKG-A
conflicts with
PKG-B <2.0
```

---

# 25. Package Coexistence

Dos Packages instalables individualmente pueden ser incompatibles cuando coexisten.

El Resolver deberá considerar el conjunto completo.

---

# 26. Module Compatibility

Los Modules deberán evaluarse principalmente mediante:

- Contracts requeridos;
- Contracts proporcionados;
- Lifecycle;
- Configuration;
- Policy;
- dependencia arquitectónica.

---

# 27. Module Compatibility no Implica Activación

Un Module compatible puede encontrarse:

```text
Disabled
```

La compatibilidad no modifica por sí misma el State definido en ENG-015.

---

# 28. Activation Compatibility

Antes de:

```text
Initialized → Active
```

ENG-015 deberá poder solicitar un Compatibility Check.

---

# 29. Activation Gate

Conceptualmente:

```text
Module Initialized
       │
       ▼
Compatibility Check
       │
   ┌───┴────┐
   ▼        ▼
 PASS      FAIL
   │        │
   ▼        ▼
Active   Remain /
         Failed /
         Disabled
```

La política determinará el resultado de fallo.

---

# 30. Contract Compatibility

ARQ-011 define Contracts como superficies explícitas.

Compatibility deberá comprobar:

```text
required Contract
provided Contract
version
capabilities
constraints
```

---

# 31. Contract Requirement

Ejemplo:

```text
MOD-CRM requires:
CTR-IDENTITY ^2.0
```

Proveedor:

```text
MOD-IDENTITY provides:
CTR-IDENTITY 2.4.1
```

Resultado:

```text
COMPATIBLE
```

---

# 32. Contract Major Incompatibility

Si el proveedor expone:

```text
CTR-IDENTITY 3.0.0
```

y el consumidor requiere:

```text
^2.0
```

el resultado será normalmente:

```text
INCOMPATIBLE
```

---

# 33. Contract Identity

La comparación deberá considerar:

```text
Contract ID
+
Version
```

No únicamente el nombre humano.

---

# 34. Contract Capability

Un Contract podrá declarar capacidades opcionales.

Ejemplo:

```text
CTR-IDENTITY 2.4
capabilities:
  - password-auth
  - mfa
  - token-refresh
```

---

# 35. Capability Requirement

Un consumidor podrá requerir:

```text
CTR-IDENTITY ^2.0
+
capability: mfa
```

Un proveedor que implemente la versión correcta pero carezca de `mfa` no satisface el Requirement.

---

# 36. Structural Compatibility

En determinadas superficies podrá comprobarse estructura.

Ejemplo:

```text
operation exists
parameter type compatible
required field available
```

---

# 37. Semantic Compatibility

La compatibilidad estructural no garantiza compatibilidad semántica.

Ejemplo:

```text
authenticate()
```

puede existir en ambas versiones, pero haber cambiado garantías de seguridad.

Por ello:

```text
Structural Compatibility
≠
Semantic Compatibility
```

---

# 38. Behavioral Compatibility

El comportamiento observable forma parte de Compatibility cuando esté gobernado por Contract.

---

# 39. Schema Compatibility

Los Schemas deberán poder compararse.

Aplicará a:

```text
Manifest
Configuration
Events
Persistence
API payloads
```

cuando corresponda.

---

# 40. Backward-Compatible Schema

Ejemplo típico:

```text
v1:
name: string

v2:
name: string
description?: string
```

podrá ser compatible si los consumidores toleran propiedades opcionales.

---

# 41. Breaking Schema Change

Ejemplo:

```text
v1:
name: string

v2:
name: object
```

podrá ser incompatible.

---

# 42. Required Field

Añadir un campo obligatorio a un Schema público normalmente deberá considerarse Breaking Change para productores existentes.

---

# 43. Optional Field

Añadir un campo opcional podrá ser compatible si consumidores existentes toleran extensiones.

---

# 44. Field Removal

Eliminar un campo utilizado públicamente deberá considerarse potencialmente incompatible.

---

# 45. Enum Compatibility

Eliminar un valor de Enum podrá ser Breaking Change.

Añadir un valor también podrá afectar consumidores que no toleren valores desconocidos.

Por tanto deberá evaluarse según dirección de compatibilidad.

---

# 46. Directional Compatibility

Schema Compatibility puede ser direccional.

Ejemplo:

```text
Can v1 reader consume v2 document?
```

no equivale necesariamente a:

```text
Can v2 reader consume v1 document?
```

---

# 47. Backward Compatibility

Conceptualmente:

```text
New Consumer
can consume
Old Producer Output
```

o según el Contract específico.

La dirección deberá definirse explícitamente para cada tipo de Schema.

---

# 48. Forward Compatibility

Conceptualmente:

```text
Old Consumer
can tolerate
New Producer Output
```

cuando el formato esté diseñado para ello.

---

# 49. Full Compatibility

Un Schema podrá considerarse Fully Compatible cuando satisfaga las direcciones requeridas de backward y forward compatibility.

---

# 50. Configuration Compatibility

ENG-011 deberá participar en Compatibility.

Se deberá comprobar:

- Schema Version;
- required keys;
- types;
- accepted values;
- defaults;
- environment restrictions.

---

# 51. Configuration Runtime Compatibility

Una Configuration válida sintácticamente puede ser incompatible con el Runtime.

Ejemplo:

```text
driver: redis-cluster
```

cuando el Runtime instalado no proporciona dicho driver.

---

# 52. Configuration Capability Check

La Configuration podrá generar Requirements.

```text
configured capability
       ↓
Compatibility Engine
       ↓
available capability?
```

---

# 53. Runtime Compatibility

Un componente podrá declarar requisitos de Runtime.

Ejemplos según Implementation Profile:

```text
PHP
Node.js
JVM
.NET
Python
```

MEF Core no deberá imponer un Runtime universal.

---

# 54. Runtime Version

Ejemplo conceptual:

```yaml
runtime:
  php: ">=8.4 <9.0"
```

---

# 55. Runtime Extensions

También podrán declararse capacidades adicionales.

Ejemplo conceptual:

```yaml
runtime:
  extensions:
    - pdo
    - openssl
```

---

# 56. Runtime Feature Compatibility

No toda compatibilidad depende únicamente del número de versión.

Podrá requerirse:

```text
extension
feature
ABI
execution mode
```

---

# 57. Platform Compatibility

Platform podrá representar:

```text
Operating System
Architecture
Container Environment
Cloud Capability
Filesystem Capability
```

según Implementation Profile.

---

# 58. Architecture Compatibility

Ejemplo:

```text
x86_64
arm64
```

Un Artifact binario podrá ser compatible únicamente con determinadas arquitecturas.

---

# 59. OS Compatibility

Ejemplo:

```text
linux
windows
macos
```

No deberá asumirse portabilidad si el Artifact posee restricciones.

---

# 60. Platform Capability

Preferiblemente se declararán capacidades cuando sean más precisas que nombres de plataforma.

Ejemplo:

```text
requires:
  filesystem.atomic-rename
```

puede ser más útil que:

```text
requires:
  linux
```

cuando esa sea la necesidad real.

---

# 61. Protocol Compatibility

Los componentes que intercambien mensajes mediante Protocol deberán declarar compatibilidad cuando corresponda.

---

# 62. Protocol Version

Ejemplo:

```text
Protocol:
MEF-RPC/2
```

Un consumidor podrá aceptar:

```text
>=2 <3
```

---

# 63. Protocol Negotiation

Cuando sea necesario podrá existir:

```text
Client Supported Versions
          │
          ▼
      Negotiation
          ▲
          │
Server Supported Versions
          │
          ▼
 Selected Version
```

---

# 64. No Common Protocol

Si no existe intersección:

```text
INCOMPATIBLE
```

---

# 65. API Compatibility

Una API pública deberá evaluarse como Contract.

Podrán considerarse:

```text
operations
parameters
responses
errors
authorization semantics
pagination
machine-readable formats
```

---

# 66. CLI Compatibility

ENG-007 deberá tratar CLI automatizable como API.

Podrán comprobarse:

```text
commands
flags
arguments
exit codes
structured output
```

---

# 67. Persistence Compatibility

Cuando una versión nueva utilice estado persistido previo deberá comprobar:

```text
schema compatibility
migration availability
downgrade constraints
```

---

# 68. Data Compatibility

Una aplicación compatible a nivel de código puede ser incompatible con datos existentes.

Por ello:

```text
Code Compatibility
≠
Data Compatibility
```

---

# 69. Migration Compatibility

Si existe una Migration válida:

```text
Old Schema
   ↓
Migration
   ↓
New Schema
```

la incompatibilidad podrá ser resoluble mediante Migration.

---

# 70. Compatible After Migration

El Engine podrá distinguir:

```text
COMPATIBLE_AFTER_MIGRATION
```

cuando sea útil.

---

# 71. Downgrade Compatibility

Deberá comprobarse separadamente.

No deberá inferirse:

```text
Upgrade works
⇒
Downgrade works
```

---

# 72. Security Compatibility

Una combinación técnicamente ejecutable puede ser incompatible con Security Policy.

Ejemplo:

```text
Package valid
Signature valid
Algorithm prohibited by policy
```

Resultado:

```text
INCOMPATIBLE
```

para ese Environment.

---

# 73. Policy Compatibility

Policy podrá restringir combinaciones permitidas.

Ejemplos:

```text
minimum TLS
approved package sources
required signatures
forbidden capabilities
allowed licenses
```

según el alcance de otras especificaciones.

---

# 74. Environment Compatibility

La compatibilidad podrá variar entre:

```text
Development
Testing
Staging
Production
```

debido a Policy o capacidades disponibles.

---

# 75. Environment Is Input

El Environment deberá considerarse Input del Compatibility Check.

No deberá codificarse arbitrariamente dentro de los componentes.

---

# 76. Compatibility Context

Conceptualmente:

```text
CompatibilityContext
├── Framework
├── Runtime
├── Platform
├── Environment
├── Installed Packages
├── Available Contracts
├── Configuration
└── Policies
```

---

# 77. Compatibility Engine

MEF podrá implementar un `Compatibility Engine` responsable de evaluar Requirements contra el Context.

---

# 78. Engine Input

Entradas mínimas:

```text
Subject
Requirements
Available Capabilities
Versions
Context
Policy
```

---

# 79. Engine Output

Salida conceptual:

```text
CompatibilityResult
├── status
├── subject
├── checks[]
├── warnings[]
├── failures[]
└── recommendations[]
```

---

# 80. Compatibility Check

Cada Check debería indicar:

```text
dimension
requirement
actual
result
reason
```

---

# 81. Example Result

```text
Subject:
PKG-CRM 3.4.2

Result:
INCOMPATIBLE

Checks:

Framework:
PASS
required >=2.0 <3.0
actual 2.8.1

Runtime:
PASS
required PHP >=8.4
actual PHP 8.4.5

Contract:
FAIL
required CTR-IDENTITY ^2.0
actual CTR-IDENTITY 3.0.0
```

---

# 82. Failure Explanation

Un fallo deberá indicar:

```text
what was required
what was found
why they do not match
what may resolve it
```

cuando sea posible.

---

# 83. Recommendation

Ejemplo:

```text
Install CTR-IDENTITY >=2.0 <3.0
```

o:

```text
Upgrade PKG-CRM to a version compatible with CTR-IDENTITY 3.x
```

---

# 84. No Automatic Guessing

El Engine no deberá recomendar una versión específica si no puede demostrar que es compatible.

---

# 85. Compatibility Matrix

MEF podrá representar relaciones mediante Matrix.

Ejemplo:

| Component | Version | MEF | Runtime | Contract |
|---|---:|---:|---:|---|
| PKG-CRM | 2.x | 1.x | PHP 8.2+ | Identity 1.x |
| PKG-CRM | 3.x | 2.x | PHP 8.4+ | Identity 2.x |
| PKG-CRM | 4.x | 3.x | PHP 8.4+ | Identity 3.x |

---

# 86. Matrix Purpose

La Matrix permite:

- documentación;
- Release validation;
- support;
- upgrade planning;
- automated testing.

---

# 87. Matrix Source

Cuando sea posible, la Matrix deberá derivarse de metadata autoritativa.

No deberá mantenerse manualmente en múltiples ubicaciones divergentes.

---

# 88. Matrix Generation

Conceptualmente:

```text
Package Metadata
Contract Metadata
Runtime Requirements
Framework Requirements
        │
        ▼
Compatibility Model
        │
        ▼
Compatibility Matrix
```

---

# 89. Compatibility Graph

Para ecosistemas complejos podrá utilizarse un Graph.

```text
PKG-CRM
   │
   ├── requires CTR-IDENTITY ^2
   ├── requires PKG-DATA ^4
   └── requires MEF ^2
```

---

# 90. Compatibility Graph vs Dependency Graph

No deberán confundirse.

```text
Dependency Graph
→ who depends on whom

Compatibility Graph
→ which combinations are valid
```

Pueden relacionarse, pero representan preguntas diferentes.

---

# 91. Constraint Intersection

El Resolver deberá calcular intersecciones.

Ejemplo:

```text
PKG-A requires CTR-X >=2 <4
PKG-B requires CTR-X >=3 <5
```

Intersección:

```text
>=3 <4
```

---

# 92. Empty Intersection

Si:

```text
PKG-A requires CTR-X >=1 <2
PKG-B requires CTR-X >=3 <4
```

entonces:

```text
intersection = ∅
```

Resultado:

```text
DEPENDENCY CONFLICT
```

---

# 93. Constraint Solver

ENG-013 podrá utilizar Compatibility Engine durante Dependency Resolution.

Conceptualmente:

```text
Dependency Requirements
        │
        ▼
Constraint Solver
        │
        ▼
Candidate Versions
        │
        ▼
Compatibility Engine
        │
        ▼
Valid Resolution
```

---

# 94. Candidate Filtering

Las versiones incompatibles deberán eliminarse del conjunto de Candidates antes de selección final.

---

# 95. Resolution Does Not Prove Runtime Health

Incluso una Resolution compatible no garantiza:

```text
Healthy Runtime
```

Compatibility verifica condiciones conocidas, no ausencia absoluta de fallos.

---

# 96. Static Compatibility

Puede comprobarse sin ejecutar el componente.

Ejemplos:

```text
version constraints
manifest schema
platform
runtime
declared contracts
```

---

# 97. Dynamic Compatibility

Algunas condiciones podrán requerir Runtime.

Ejemplo:

```text
external service capability
protocol negotiation
runtime extension availability
```

---

# 98. Static First

MEF deberá favorecer:

```text
Static Compatibility Check
before
Dynamic Compatibility Check
```

cuando sea posible.

---

# 99. Build-Time Compatibility

ENG-012 deberá comprobar Compatibility conocida durante Build.

---

# 100. Install-Time Compatibility

ENG-013 deberá comprobar Compatibility antes de Commit de instalación cuando sea aplicable.

---

# 101. Bootstrap-Time Compatibility

ARQ-014 podrá comprobar Compatibility antes de activar Modules.

---

# 102. Runtime Compatibility

Durante Runtime podrán detectarse cambios externos.

Ejemplo:

```text
external protocol capability changed
```

La respuesta deberá depender de Policy.

---

# 103. Release-Time Compatibility

ENG-017 deberá validar que una Release declara correctamente sus Requirements y Compatibility Guarantees.

---

# 104. Compatibility Gates

MEF podrá establecer:

```text
Build Gate
Install Gate
Activation Gate
Release Gate
```

---

# 105. Build Gate

Debe impedir producir o aprobar Artifacts incompatibles con Requirements obligatorios conocidos.

---

# 106. Install Gate

Debe impedir instalaciones cuya incompatibilidad sea determinable antes de Commit.

---

# 107. Activation Gate

Debe impedir que un Module alcance `Active` si sus Requirements obligatorios no están satisfechos.

---

# 108. Release Gate

Debe impedir publicar metadata contradictoria o una versión incompatible con sus garantías declaradas.

---

# 109. Compatibility Snapshot

Una instalación podrá generar un Snapshot.

Ejemplo:

```text
MEF: 2.8.1
Runtime: PHP 8.4.5
PKG-CRM: 3.4.2
CTR-IDENTITY: 2.6.0
Compatibility: PASS
```

---

# 110. Snapshot Purpose

Podrá utilizarse para:

- diagnostics;
- support;
- reproducibility;
- audit;
- incident analysis.

---

# 111. Snapshot vs Lock

No deberá confundirse:

```text
Dependency Lock
```

con:

```text
Compatibility Snapshot
```

El Lock registra Resolution.

El Snapshot registra el Context evaluado.

---

# 112. Compatibility Cache

Los resultados podrán almacenarse temporalmente cuando Inputs no hayan cambiado.

---

# 113. Cache Invalidation

Deberá invalidarse cuando cambien:

```text
Framework Version
Package Version
Runtime
Platform
Configuration
Policy
Contracts
```

relevantes.

---

# 114. Compatibility Fingerprint

Podrá generarse un Fingerprint del Context para detectar cambios.

---

# 115. Fingerprint

Conceptualmente:

```text
hash(
  framework +
  runtime +
  packages +
  contracts +
  configuration schema +
  policy
)
```

No deberá incluir Secrets.

---

# 116. Compatibility Evidence

Un resultado podrá adjuntar Evidence.

Ejemplos:

```text
Manifest
Contract descriptor
Schema
Runtime probe
Policy rule
```

---

# 117. Evidence Traceability

Cada Check debería poder explicar de dónde obtuvo:

```text
required
```

y:

```text
actual
```

---

# 118. Compatibility Provenance

Esto permitirá responder:

```text
Why was this Package considered incompatible?
```

con evidencia reproducible.

---

# 119. Compatibility Diagnostics

Taxonomía conceptual:

```text
MEF-CMP-001 Framework incompatible
MEF-CMP-002 Package incompatible
MEF-CMP-003 Contract incompatible
MEF-CMP-004 Schema incompatible
MEF-CMP-005 Runtime incompatible
MEF-CMP-006 Platform incompatible
MEF-CMP-007 Protocol incompatible
MEF-CMP-008 Policy incompatible
MEF-CMP-009 Compatibility unknown
MEF-CMP-010 Dependency constraint conflict
MEF-CMP-011 Migration required
MEF-CMP-012 Deprecated compatibility
MEF-CMP-013 Capability missing
MEF-CMP-014 Compatibility metadata invalid
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 120. Diagnostic Example

```text
MEF-CMP-003

Contract incompatibility detected.

Consumer:
MOD-CRM

Requirement:
CTR-IDENTITY >=2.0 <3.0

Provider:
MOD-IDENTITY

Provided:
CTR-IDENTITY 3.1.0

Result:
INCOMPATIBLE

Recommendation:
Use a compatible Identity provider or upgrade MOD-CRM.
```

---

# 121. Compatibility CLI

ENG-007 podrá incorporar:

```text
mef compatibility check
```

---

# 122. Subject Check

Podrá soportar:

```text
mef compatibility check PKG-CRM
```

---

# 123. Project Check

Podrá integrarse:

```text
mef project validate
```

---

# 124. Explain

Podrá existir:

```text
mef compatibility explain PKG-CRM
```

para diagnóstico detallado.

---

# 125. Matrix CLI

Podrá existir:

```text
mef compatibility matrix
```

para inspección.

---

# 126. Structured Output

La CLI deberá permitir output procesable cuando se utilice en CI.

Ejemplo conceptual:

```text
--format=json
```

---

# 127. Exit Codes

Compatibility Check deberá producir Exit Codes deterministas para automatización.

---

# 128. CI Integration

Ejemplo:

```text
mef compatibility check
          │
          ▼
       PASS/FAIL
          │
          ▼
     CI Quality Gate
```

---

# 129. Testing Integration

ENG-009 deberá probar Compatibility.

---

# 130. Compatibility Test

Ejemplos:

```text
PKG-CRM 3.x works with MEF 2.x
PKG-CRM 3.x rejects MEF 3.x
CTR-IDENTITY 2.x accepted
CTR-IDENTITY 3.x rejected
```

---

# 131. Matrix Testing

Las combinaciones soportadas deberán probarse de acuerdo con criticidad y Support Policy.

---

# 132. Negative Compatibility Testing

También deberán probarse combinaciones explícitamente incompatibles.

---

# 133. Boundary Testing

Especialmente:

```text
minimum supported version
maximum supported version
first unsupported version
```

---

# 134. Contract Compatibility Tests

Podrán validar:

```text
required operations
required semantics
capabilities
version constraints
```

---

# 135. Schema Compatibility Tests

Podrán comparar:

```text
old schema
new schema
```

y producir Compatibility Result.

---

# 136. Runtime Matrix Tests

Podrán ejecutarse Builds contra varias versiones de Runtime soportadas.

---

# 137. Platform Matrix Tests

Los componentes multiplataforma deberán probar Platforms declaradas como soportadas cuando sea razonable.

---

# 138. Compatibility Claims

No deberá declararse compatibilidad pública sin evidencia razonable.

---

# 139. Tested Compatibility

Podrá distinguirse:

```text
Declared Compatible
Tested Compatible
Certified Compatible
```

si el ecosistema lo requiere.

---

# 140. Declared Compatible

Significa que metadata y Constraints permiten la combinación.

---

# 141. Tested Compatible

Significa que la combinación fue probada por el Pipeline definido.

---

# 142. Certified Compatible

Podrá reservarse para un proceso formal futuro.

No deberá utilizarse sin criterios definidos.

---

# 143. Unknown Compatibility

Cuando una combinación no esté declarada ni probada podrá quedar:

```text
UNKNOWN
```

---

# 144. Unknown Policy

Cada Environment podrá definir si `UNKNOWN`:

```text
allow with warning
deny
```

Production debería favorecer políticas más restrictivas.

---

# 145. Strict Mode

Podrá existir:

```text
strict compatibility
```

donde:

```text
UNKNOWN = FAIL
```

---

# 146. Development Mode

Development podrá permitir determinadas combinaciones `UNKNOWN` con Warning, según Policy.

---

# 147. Compatibility Override

Podrá existir una excepción administrativa controlada.

Ejemplo conceptual:

```text
override compatibility
```

pero deberá ser excepcional.

---

# 148. Override Requirements

Un Override deberá registrar:

```text
actor
reason
scope
expiration
incompatibility
```

cuando aplique.

---

# 149. No Silent Override

Nunca deberá convertirse automáticamente:

```text
INCOMPATIBLE
```

en:

```text
COMPATIBLE
```

sin evidencia o excepción explícita.

---

# 150. Override Does Not Change Truth

Un Override significa:

```text
execution permitted despite compatibility result
```

no:

```text
components are compatible
```

---

# 151. Deprecation Compatibility

Una dependencia Deprecated puede continuar siendo compatible.

Resultado posible:

```text
COMPATIBLE_WITH_WARNINGS
```

---

# 152. EOL Compatibility

Una versión EOL puede seguir siendo técnicamente compatible.

Pero Policy podrá rechazarla.

Por tanto:

```text
Technical Compatibility
≠
Support Compatibility
```

---

# 153. Support Compatibility

Podrá evaluarse:

```text
supported version?
security supported?
maintenance active?
```

---

# 154. License Compatibility

Cuando MEF implemente Governance de licencias, podrá añadirse como dimensión Policy.

No deberá confundirse con compatibilidad técnica.

---

# 155. Deployment Compatibility

Futuros documentos podrán extender Compatibility hacia:

```text
deployment topology
resource requirements
infrastructure
region
availability
```

sin modificar el núcleo conceptual.

---

# 156. Resource Compatibility

Podrá comprobarse:

```text
memory
storage
cpu architecture
required ports
```

cuando exista una especificación de Deployment.

---

# 157. Capability-Based Compatibility

MEF deberá favorecer Requirements basados en capacidades cuando reduzcan acoplamiento.

Preferible:

```text
requires CTR-CACHE ^2
```

a:

```text
requires Redis 7
```

si el consumidor realmente depende del Contract y no del producto.

---

# 158. Vendor Independence

Compatibility no deberá introducir dependencias de Vendor innecesarias en el Core.

---

# 159. Implementation Profile

Los perfiles tecnológicos podrán extender dimensiones.

Ejemplo PHP:

```text
PHP version
extensions
Composer platform
OS capabilities
```

Ejemplo JVM:

```text
JDK version
JVM features
```

---

# 160. Core Compatibility Model

El Core deberá permanecer expresable como:

```text
Requirement
Capability
Constraint
Context
Result
Evidence
```

independientemente de tecnología.

---

# 161. Compatibility Rule

Una Rule conceptual podrá representarse como:

```text
IF
  requirement applies
THEN
  evaluate constraint against capability
ELSE
  NOT_APPLICABLE
```

---

# 162. Rule Determinism

La misma Rule con los mismos Inputs deberá producir el mismo resultado.

---

# 163. Rule Ordering

Cuando Rules dependan unas de otras, el orden deberá ser explícito.

---

# 164. Short Circuit

Un Engine podrá detenerse ante fallo crítico para ejecución.

Para diagnóstico completo podrá continuar evaluando Rules independientes.

---

# 165. Fast Mode

Podrá existir:

```text
fail-fast
```

---

# 166. Diagnostic Mode

Podrá existir:

```text
collect-all
```

para producir todos los conflictos detectables.

---

# 167. Compatibility Severity

Los Checks podrán clasificarse:

```text
INFO
WARNING
ERROR
CRITICAL
```

sin sustituir el Compatibility Result.

---

# 168. Critical Incompatibility

Ejemplo:

```text
unsupported runtime ABI
```

puede impedir incluso cargar un Artifact.

---

# 169. Warning

Ejemplo:

```text
dependency deprecated but still supported
```

---

# 170. Compatibility Versioning

El propio modelo de Compatibility deberá evolucionar bajo ENG-014.

---

# 171. Rule Versioning

Rules persistidas o distribuidas deberán poder versionarse cuando cambien semántica.

---

# 172. Compatibility Schema

La metadata de Compatibility deberá disponer de Schema Version cuando sea necesario.

---

# 173. Compatibility Metadata Example

Ejemplo conceptual:

```yaml
compatibility:
  schemaVersion: 1

  framework:
    mef: ">=2.0 <3.0"

  contracts:
    requires:
      CTR-IDENTITY: ">=2.0 <3.0"

  runtime:
    php: ">=8.4 <9.0"

  platform:
    architecture:
      - x86_64
      - arm64
```

La sintaxis definitiva pertenecerá al Manifest Schema.

---

# 174. Metadata Validation

Compatibility Metadata inválida deberá impedir utilizarla como evidencia confiable.

---

# 175. Metadata Conflict

Si distintas fuentes autoritativas declaran requisitos contradictorios, deberá producirse Error.

---

# 176. Source of Truth

Los Requirements deberán poseer una fuente autoritativa.

No deberán duplicarse manualmente en:

```text
Manifest
README
Build Script
CI
Runtime
```

sin mecanismo de sincronización.

---

# 177. Documentation Derivation

La documentación de Compatibility debería derivarse de metadata cuando sea posible.

---

# 178. Compatibility Report

El Pipeline podrá producir:

```text
Compatibility Report
```

---

# 179. Report Contents

Debería incluir:

```text
subject
version
context
requirements
capabilities
results
warnings
failures
evidence
timestamp
```

---

# 180. Report Reproducibility

El Report deberá permitir reconstruir razonablemente las condiciones de evaluación.

---

# 181. Report Security

No deberá incluir Secrets.

---

# 182. Release Compatibility Report

ENG-017 podrá requerirlo como evidencia de Release.

---

# 183. Upgrade Planning

Compatibility Engine podrá ayudar a planificar Upgrades.

Ejemplo:

```text
Current:
MEF 2.8
PKG-CRM 3.4
CTR-IDENTITY 2.6

Target:
MEF 3.0
```

Resultado:

```text
PKG-CRM 3.4 incompatible
CTR-IDENTITY 2.6 incompatible
```

---

# 184. Upgrade Path

Tooling podrá buscar una ruta:

```text
Current State
     ↓
Compatible Intermediate Versions
     ↓
Target State
```

---

# 185. Compatibility Path

Ejemplo:

```text
MEF 2
PKG-CRM 3
     │
     ▼
Upgrade PKG-CRM 4
     │
     ▼
Upgrade MEF 3
```

en lugar de actualizar MEF directamente.

---

# 186. Upgrade Planner

Podrá existir en versiones futuras:

```text
Compatibility Engine
       +
Dependency Resolver
       +
Migration Metadata
       ↓
Upgrade Planner
```

---

# 187. Downgrade Planning

Deberá evaluarse por separado y considerar Data Compatibility.

---

# 188. Compatibility History

Podrá conservarse historial de Compatibility Results relevantes para Releases o Production.

---

# 189. Regression Detection

Si una combinación previamente compatible deja de serlo:

```text
Compatibility Regression
```

deberá detectarse antes de Release cuando sea posible.

---

# 190. Compatibility Regression Test

Ejemplo:

```text
PKG-CRM 3.4
+
MEF 2.8
```

estaba soportado.

Una corrección `3.4.1` no debería romper esa combinación sin Version Impact adecuado.

---

# 191. Versioning Integration

ENG-014 deberá utilizar Compatibility para determinar impacto.

Conceptualmente:

```text
Old Public Surface
        │
        ▼
Compatibility Diff
        ▲
        │
New Public Surface
        │
        ▼
Breaking?
        │
   ┌────┴────┐
   ▼         ▼
  YES        NO
   │         │
   ▼         ▼
 MAJOR    MINOR/PATCH
```

---

# 192. State Machine Integration

ENG-015 deberá utilizar Compatibility como Guard.

Ejemplo:

```text
Initialized
    │
    ▼
Compatibility Guard
    │
    ├── PASS → Active
    └── FAIL → Transition denied
```

---

# 193. Package Manager Integration

ENG-013 deberá utilizar Compatibility:

```text
before resolution
during candidate filtering
before installation
after installation verification
```

según corresponda.

---

# 194. Build Integration

ENG-012 deberá utilizar Compatibility para:

```text
validate dependencies
validate runtime
validate schemas
validate contracts
```

---

# 195. Configuration Integration

ENG-011 deberá producir Requirements derivados de Configuration cuando corresponda.

---

# 196. Testing Integration

ENG-009 deberá verificar Compatibility Claims y Matrix soportadas.

---

# 197. Logging Integration

ENG-010 deberá registrar fallos de Compatibility de forma estructurada.

---

# 198. Release Integration

ENG-017 deberá impedir Release cuando:

```text
declared compatibility
```

contradiga:

```text
verified compatibility
```

según Quality Gates aplicables.

---

# 199. Architectural Integration

La cadena completa será:

```text
Manifest
   │
   ▼
Requirements
   │
   ▼
Dependency Resolver
   │
   ▼
Candidate Set
   │
   ▼
Compatibility Engine
   │
   ▼
Compatible Resolution
   │
   ▼
Installation
   │
   ▼
State Machine
   │
   ▼
Activation Guard
   │
   ▼
Active
```

---

# 200. Compatibility Engine Architecture

Arquitectura conceptual:

```text
                  Compatibility Engine
                          │
       ┌──────────────────┼──────────────────┐
       │                  │                  │
       ▼                  ▼                  ▼
 Requirement          Capability           Context
   Reader              Registry            Reader
       │                  │                  │
       └──────────────────┼──────────────────┘
                          ▼
                    Rule Evaluator
                          │
       ┌──────────────────┼──────────────────┐
       ▼                  ▼                  ▼
    Version           Contract            Schema
    Rules              Rules              Rules
       │                  │                  │
       ├──────────────────┼──────────────────┤
       ▼                  ▼                  ▼
    Runtime           Platform            Policy
     Rules             Rules              Rules
       │                  │                  │
       └──────────────────┼──────────────────┘
                          ▼
                 Compatibility Result
                          │
             ┌────────────┼────────────┐
             ▼            ▼            ▼
           PASS         WARNING        FAIL
```

---

# 201. Compatibility Engine no Ejecuta Lifecycle

El Engine determina compatibilidad.

No deberá:

```text
install package
activate module
migrate database
publish release
```

Esas operaciones pertenecen a otros componentes.

---

# 202. Compatibility Engine no Resuelve por Sí Solo

El Engine responde:

```text
Is this candidate compatible?
```

El Dependency Resolver responde:

```text
Which candidate should be selected?
```

---

# 203. Separation

Por tanto:

```text
Resolver
≠
Compatibility Engine
≠
State Machine
≠
Package Manager
```

aunque colaboren.

---

# 204. Primera Implementación

La primera implementación debería verificar al menos:

```text
Framework Version
Package Dependencies
Contract Versions
Runtime Version
Manifest Schema
Configuration Schema
```

---

# 205. Segunda Etapa

Posteriormente:

```text
Platform Capabilities
Protocol Compatibility
Schema Diff
Contract Diff
Support Lifecycle
Security Policy
```

---

# 206. Tercera Etapa

Posteriormente:

```text
Upgrade Planner
Compatibility History
Compatibility Regression Detection
Distributed Compatibility
Certified Compatibility
```

---

# 207. Invariantes de Ingeniería

ENG-016 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-266 | La compatibilidad deberá derivarse de Requirements, Capabilities, Constraints y Context explícitos cuando exista información gobernada. |
| EI-267 | `Installed`, `Resolved`, `Compatible`, `Active` y `Healthy` deberán mantenerse como conceptos distintos. |
| EI-268 | Una incompatibilidad obligatoria conocida deberá impedir las operaciones gobernadas que requieran compatibilidad. |
| EI-269 | `UNKNOWN` no deberá interpretarse silenciosamente como `COMPATIBLE`. |
| EI-270 | La compatibilidad deberá evaluarse en todas las dimensiones obligatorias aplicables al componente. |
| EI-271 | Los Requirements de Framework deberán verificarse contra la versión real del Framework antes de Activation cuando corresponda. |
| EI-272 | Los Contracts requeridos deberán comprobar identidad, versión y capacidades obligatorias. |
| EI-273 | Una coincidencia estructural no deberá considerarse prueba suficiente de compatibilidad semántica cuando el Contract defina comportamiento. |
| EI-274 | Schema Compatibility deberá considerar dirección cuando productores y consumidores posean capacidades diferentes. |
| EI-275 | Configuration válida sintácticamente no deberá considerarse automáticamente compatible con Runtime. |
| EI-276 | Runtime y Platform deberán mantenerse como dimensiones distintas. |
| EI-277 | Dependency Resolution deberá excluir Candidates incompatibles conocidos. |
| EI-278 | Una intersección vacía de Constraints obligatorios deberá producir conflicto explícito. |
| EI-279 | El Activation Lifecycle deberá poder utilizar Compatibility como Guard. |
| EI-280 | Las Compatibility Claims públicas deberán poseer evidencia razonable y trazable. |
| EI-281 | Compatibility Overrides deberán ser explícitos y no deberán modificar el resultado técnico subyacente. |
| EI-282 | Compatibility Metadata deberá poseer una Source of Truth autoritativa. |
| EI-283 | El Compatibility Engine no deberá ejecutar instalación, Lifecycle, Migration ni Release. |
| EI-284 | Cambios que rompan Compatibility pública deberán integrarse con Version Impact de ENG-014. |
| EI-285 | Los resultados de Compatibility deberán ser deterministas para los mismos Inputs gobernados. |

---

# 208. Criterios de Conformidad

Una implementación será conforme con ENG-016 cuando:

- modele Requirements;
- modele Capabilities;
- modele Constraints;
- evalúe Framework Compatibility;
- evalúe Package Compatibility;
- evalúe Contract Compatibility;
- evalúe Schema Compatibility cuando aplique;
- evalúe Runtime Compatibility;
- distinga Platform;
- produzca resultados explícitos;
- no trate Unknown como Compatible silenciosamente;
- proporcione diagnósticos;
- se integre con Dependency Resolution;
- se integre con Build;
- se integre con Lifecycle;
- se integre con Versioning;
- permita Testing automatizado.

---

# 209. Riesgos

Deberán evitarse especialmente:

## Version Equality Compatibility

Asumir:

```text
same version = compatible
```

## Installed Means Compatible

Asumir:

```text
installed = usable
```

## Runtime-Only Detection

Descubrir incompatibilidades únicamente cuando el sistema falla en Production.

## Unknown Means Yes

Convertir falta de información en aprobación.

## Manifest Duplication

Mantener Requirements distintos en README, CI y Manifest.

## Structural-Only Compatibility

Comparar firmas sin semántica.

## Platform Hardcoding

Acoplar innecesariamente Packages a Vendors o sistemas concretos.

## Resolver/Compatibility Coupling

Convertir Compatibility Engine en Package Manager.

## Silent Override

Ignorar incompatibilidades porque “parece funcionar”.

## Matrix Drift

Mantener Compatibility Matrix manual divergente de metadata real.

## Upgrade Equals Downgrade

Asumir simetría entre ambas operaciones.

## Version-Only Contracts

Ignorar capacidades obligatorias porque la versión coincide.

---

# 210. Ejemplo Completo

Supongamos:

```text
MEF:
2.8.1

Runtime:
PHP 8.4.5

PKG-CRM:
3.4.2

MOD-CRM requires:
CTR-IDENTITY >=2.0 <3.0
CTR-DATA >=4.0 <5.0

Available:

MOD-IDENTITY
provides CTR-IDENTITY 2.7.1

MOD-DATA
provides CTR-DATA 4.3.0
```

Evaluation:

```text
Framework:
PASS

Runtime:
PASS

CTR-IDENTITY:
PASS

CTR-DATA:
PASS

Package:
PASS
```

Resultado:

```text
COMPATIBLE
```

ENG-015 podrá entonces permitir:

```text
MOD-CRM
Initialized
   ↓
activate
   ↓
Active
```

---

# 211. Ejemplo de Incompatibilidad

Ahora:

```text
MOD-IDENTITY
provides CTR-IDENTITY 3.0.0
```

pero CRM requiere:

```text
>=2.0 <3.0
```

Resultado:

```text
MEF-CMP-003

Contract incompatibility.

Required:
CTR-IDENTITY >=2.0 <3.0

Available:
CTR-IDENTITY 3.0.0
```

Por tanto:

```text
Compatibility:
FAIL
```

y:

```text
Initialized
   │
   ▼
activate
   │
   ▼
Compatibility Guard
   │
   ▼
DENIED
```

El Module no deberá alcanzar `Active`.

---

# 212. Ejemplo de Conflicto entre Packages

```text
PKG-CRM
requires CTR-DATA >=3 <5

PKG-REPORTS
requires CTR-DATA >=4 <6
```

Intersección:

```text
>=4 <5
```

Existe Resolution posible.

Pero:

```text
PKG-CRM
requires CTR-DATA >=2 <3

PKG-REPORTS
requires CTR-DATA >=4 <5
```

produce:

```text
∅
```

y deberá rechazarse antes de instalación.

---

# 213. Modelo Final

```text
                       COMPONENT
                           │
                           ▼
                      Requirements
                           │
                           ▼
                 Compatibility Context
                           │
         ┌─────────────────┼─────────────────┐
         ▼                 ▼                 ▼
     Framework          Contracts          Runtime
         │                 │                 │
         ▼                 ▼                 ▼
      Packages          Schemas           Platform
         │                 │                 │
         └─────────────────┼─────────────────┘
                           ▼
                  Compatibility Engine
                           │
            ┌──────────────┼──────────────┐
            ▼              ▼              ▼
       COMPATIBLE       WARNING      INCOMPATIBLE
            │              │              │
            ▼              ▼              ▼
        Continue       Policy        Block / Resolve
            │
            ▼
      Lifecycle Guard
            │
            ▼
          Active
```

---

# 214. Principio Rector

> **MEF deberá demostrar compatibilidad antes de depender de ella: ningún componente deberá considerarse compatible únicamente porque pueda instalarse, cargarse o comenzar a ejecutarse.**

---

# 215. Conclusión

**ENG-016 — Compatibility** convierte la compatibilidad en una propiedad arquitectónica verificable.

La cadena queda definida como:

```text
Requirements
     ↓
Constraints
     ↓
Capabilities
     ↓
Context
     ↓
Compatibility Engine
     ↓
Compatibility Result
```

y posteriormente:

```text
Compatibility Result
        │
        ├──→ Dependency Resolver
        ├──→ Build Gate
        ├──→ Install Gate
        ├──→ Activation Guard
        └──→ Release Gate
```

Esto establece una separación fundamental:

```text
Versioning
→ expresa evolución

Compatibility
→ determina coexistencia válida

Dependency Resolution
→ selecciona componentes

State Machine
→ gobierna Lifecycle

Package Manager
→ ejecuta operaciones

Release Process
→ publica Artifacts
```

De esta forma, MEF puede pasar de:

```text
"instálalo y veamos si funciona"
```

a:

```text
"demostremos primero que la combinación
satisface las restricciones conocidas"
```

La arquitectura resultante será capaz de detectar incompatibilidades:

```text
antes del Build
durante el Build
antes de instalar
antes de activar
antes de publicar
```

reduciendo la posibilidad de descubrirlas únicamente en Production.

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
- ENG-015 — Architectural State Machine
- ENG-017 — Release Process