---
id: ENG-017
titulo: Release Process
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Release Engineering
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
  - ENG-016
  - ARQ-011
  - ARQ-014
  - ARQ-016
  - ARQ-017
relacionados:
  - ENG-007
keywords:
  - release
  - release process
  - release engineering
  - release candidate
  - artifact
  - publication
  - registry
  - signing
  - provenance
  - rollback
  - versioning
  - compatibility
  - mef
---

# ENG-017

# Release Process

## Estado

Accepted.

---

# 1. Propósito

Definir el proceso oficial de **Release Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-017 establece cómo una modificación al código fuente evoluciona desde:

```text
Source
```

hasta convertirse en:

```text
Official Release
```

mediante un proceso controlado, verificable, reproducible y auditable.

El objetivo es garantizar que ninguna versión sea publicada oficialmente sin haber satisfecho los controles requeridos de:

- Versioning;
- Testing;
- Build;
- Compatibility;
- Security;
- Integrity;
- Packaging;
- Documentation;
- Approval;
- Publication.

---

# 2. Declaración

En MEF:

```text
Build
≠
Release
```

y:

```text
Artifact
≠
Official Artifact
```

y:

```text
Version Number
≠
Released Version
```

Una Release existe únicamente después de completar el proceso oficial de publicación.

---

# 3. Modelo General

```text
Source
  │
  ▼
Changes
  │
  ▼
Version Impact
  │
  ▼
Testing
  │
  ▼
Build
  │
  ▼
Compatibility
  │
  ▼
Security Validation
  │
  ▼
Packaging
  │
  ▼
Release Candidate
  │
  ▼
Quality Gates
  │
  ▼
Approval
  │
  ▼
Signing
  │
  ▼
Publication
  │
  ▼
Registry
  │
  ▼
Official Release
```

---

# 4. Objetivos

Release Process deberá:

- producir Releases deterministas;
- impedir publicación accidental;
- verificar calidad;
- verificar compatibilidad;
- verificar seguridad;
- garantizar integridad;
- conservar Provenance;
- generar Artifacts identificables;
- soportar automatización;
- soportar auditoría;
- soportar Rollback operativo;
- permitir reproducibilidad;
- mantener trazabilidad entre Source y Artifact.

---

# 5. Release

Una `Release` representa una versión oficialmente publicada de un componente MEF.

Podrá corresponder a:

```text
Framework
Package
Module Distribution
CLI
SDK
Tooling
Contract Package
```

según el Artifact.

---

# 6. Release Identity

Toda Release deberá poseer identidad inequívoca.

Conceptualmente:

```text
Component ID
+
Version
+
Artifact Identity
```

Ejemplo:

```text
mef/core@2.4.1
```

---

# 7. Release Version

La versión deberá cumplir ENG-014.

Una Release no deberá inventar su versión durante Publication.

---

# 8. Release Artifact

Un Release Artifact es el Artifact exacto aprobado para publicación.

Ejemplos:

```text
package archive
container image
binary
library
contract bundle
source archive
```

---

# 9. Artifact Immutability

Después de publicar:

```text
Component@Version
```

su contenido no deberá sustituirse silenciosamente.

Si cambia el contenido deberá producirse una nueva Release.

---

# 10. Immutable Identity

Deberá mantenerse:

```text
Version
        │
        ▼
Exact Artifact
```

y no:

```text
Version
        │
        ├── Artifact A
        └── Artifact B
```

para una misma identidad oficial.

---

# 11. Release Candidate

Una `Release Candidate` es un Artifact candidato a convertirse en Release oficial.

Ejemplo:

```text
2.4.0-rc.1
```

cuando el esquema de Versioning lo permita.

---

# 12. Candidate no es Release

```text
Release Candidate
≠
Production Release
```

aunque técnicamente puedan contener código equivalente.

---

# 13. Candidate Identity

Cada Candidate deberá ser identificable.

No deberá sustituirse silenciosamente.

---

# 14. Candidate Promotion

Una Release podrá derivarse de un Candidate aprobado.

Conceptualmente:

```text
RC
 │
 ▼
Validation
 │
 ▼
Approval
 │
 ▼
Promotion
 │
 ▼
Release
```

---

# 15. Build Once, Promote

MEF deberá favorecer:

```text
Build Once
Validate
Promote
```

sobre:

```text
Build
Validate
Rebuild
Publish
```

cuando sea técnicamente posible.

---

# 16. Razón

Reconstruir después de validar puede producir un Artifact distinto del realmente probado.

---

# 17. Release Pipeline

Pipeline recomendado:

```text
Source Validation
       ↓
Version Validation
       ↓
Dependency Resolution
       ↓
Static Analysis
       ↓
Tests
       ↓
Build
       ↓
Artifact Verification
       ↓
Compatibility
       ↓
Security Checks
       ↓
Package
       ↓
Release Candidate
       ↓
Release Gates
       ↓
Approval
       ↓
Sign
       ↓
Publish
       ↓
Registry Update
       ↓
Post-Release Verification
```

---

# 18. Source Validation

Antes del Build deberá verificarse que el Source utilizado sea identificable.

Ejemplo:

```text
Repository
Commit
Tag
Branch Policy
```

---

# 19. Source Commit

Toda Release deberá poder relacionarse con un Commit específico.

---

# 20. Dirty Working Tree

Una Release oficial no debería generarse desde un Working Tree con cambios no registrados.

---

# 21. Source Provenance

Deberá poder responderse:

```text
¿Qué código produjo este Artifact?
```

---

# 22. Version Impact

ENG-014 deberá determinar el impacto de los cambios.

Ejemplo:

```text
PATCH
MINOR
MAJOR
```

---

# 23. Version Validation

Antes de Release deberá comprobarse:

- formato válido;
- incremento válido;
- ausencia de versión ya publicada;
- coherencia con Compatibility;
- coherencia con Breaking Changes.

---

# 24. Duplicate Version

No deberá permitirse publicar nuevamente:

```text
2.4.1
```

con contenido diferente.

---

# 25. Testing Gate

ENG-009 deberá ejecutarse antes de aprobación.

El conjunto exacto dependerá del componente.

---

# 26. Test Categories

Podrán incluir:

```text
Unit
Integration
Contract
Architecture
Compatibility
Security
Regression
End-to-End
```

según aplicabilidad.

---

# 27. Mandatory Tests

Los Tests clasificados como obligatorios deberán aprobarse.

---

# 28. Failed Test

Un Test obligatorio fallido deberá bloquear Release.

---

# 29. Flaky Test

Un Test inestable no deberá ignorarse silenciosamente.

Deberá:

```text
fix
quarantine under policy
or block
```

según Governance.

---

# 30. Test Evidence

El Pipeline deberá conservar evidencia suficiente del resultado de Testing.

---

# 31. Build Gate

ENG-012 deberá producir el Artifact mediante proceso controlado.

---

# 32. Build Identity

El Build deberá poseer identificador.

Ejemplo conceptual:

```text
buildId
commit
version
timestamp
```

---

# 33. Build Reproducibility

Cuando sea posible, MEF deberá favorecer Builds reproducibles.

---

# 34. Artifact Hash

Todo Artifact oficial deberá poseer un Digest criptográfico.

Conceptualmente:

```text
SHA-256
```

o algoritmo permitido por Security Policy.

---

# 35. Digest Purpose

Permite comprobar:

```text
Integrity
Identity
Provenance
Distribution correctness
```

---

# 36. Artifact Verification

Antes de Promotion deberá verificarse:

```text
expected artifact
correct version
correct manifest
correct metadata
integrity
```

---

# 37. Manifest Validation

ENG-003 deberá validarse como parte del Release.

---

# 38. Package Validation

Cuando el Artifact sea Package deberá cumplir ENG-013 y ARQ-017.

---

# 39. Dependency Lock

Cuando aplique, la Release deberá conservar o referenciar el Lock utilizado para construir o verificar el Artifact.

---

# 40. Compatibility Gate

ENG-016 deberá ejecutarse antes de Release.

---

# 41. Compatibility Requirements

Deberán verificarse al menos las dimensiones obligatorias declaradas:

```text
Framework
Packages
Contracts
Schemas
Runtime
Platform
Protocols
Policy
```

según aplicabilidad.

---

# 42. Incompatible Candidate

Un Candidate `INCOMPATIBLE` no deberá publicarse como Release soportada.

---

# 43. Unknown Compatibility

La política de Release deberá definir si:

```text
UNKNOWN
```

bloquea Release.

Para componentes Core deberá favorecerse:

```text
UNKNOWN = FAIL
```

en dimensiones obligatorias.

---

# 44. Compatibility Evidence

El Compatibility Report podrá formar parte de Release Evidence.

---

# 45. Security Gate

ARQ-016 deberá participar antes de publicación.

---

# 46. Security Checks

Podrán incluir:

```text
dependency vulnerability checks
secret detection
signature validation
artifact integrity
policy checks
static analysis
provenance validation
```

según Implementation Profile.

---

# 47. Secrets

Una Release no deberá contener Secrets incorporados accidentalmente.

---

# 48. Secret Detection Failure

La detección de un Secret deberá bloquear Publication hasta su resolución.

---

# 49. Vulnerability Policy

La política deberá determinar qué severidades bloquean Release.

---

# 50. Security Exception

Una excepción deberá ser explícita, autorizada, limitada y auditable.

---

# 51. Security Exception Metadata

Debería registrar:

```text
reason
approver
scope
expiration
risk
```

cuando corresponda.

---

# 52. Packaging Gate

El Artifact deberá empaquetarse en el formato oficial correspondiente.

---

# 53. Package Contents

Deberán excluirse archivos innecesarios o sensibles.

Ejemplos:

```text
.env
local credentials
temporary files
test secrets
IDE state
unnecessary build cache
```

---

# 54. Package Metadata

Deberá contener metadata necesaria para:

- identidad;
- Versioning;
- Compatibility;
- Dependency Resolution;
- Integrity;
- instalación.

---

# 55. Release Metadata

Toda Release debería poder describirse mediante metadata estructurada.

Ejemplo conceptual:

```yaml
release:
  component: mef/core
  version: 2.4.1
  commit: abc123
  build: build-8742
  artifactDigest: sha256:...
```

---

# 56. Release Manifest

Podrá existir un Release Manifest distinto del Component Manifest.

---

# 57. Component Manifest vs Release Manifest

```text
Component Manifest
→ describe el componente

Release Manifest
→ describe una publicación específica
```

---

# 58. Release Manifest Contents

Podrá incluir:

```text
releaseId
componentId
version
sourceCommit
buildId
artifactDigest
compatibility
signatures
provenance
publicationTimestamp
```

---

# 59. Release Notes

Toda Release pública debería disponer de Release Notes.

---

# 60. Release Notes Purpose

Deberán explicar:

- cambios relevantes;
- Breaking Changes;
- nuevas capacidades;
- correcciones;
- Deprecations;
- Migration Requirements;
- Compatibility changes;
- Security changes.

---

# 61. Generated Release Notes

Podrán derivarse parcialmente de:

```text
Changesets
Commits
Issue Metadata
Version Impact
```

---

# 62. Human Review

La generación automática no elimina la necesidad de revisión cuando las notas sean parte del Contract público.

---

# 63. Changelog

MEF podrá mantener un Changelog acumulativo.

---

# 64. Changelog vs Release Notes

```text
Changelog
→ historial acumulado

Release Notes
→ descripción de una Release concreta
```

---

# 65. Changeset

Un Changeset representa una descripción estructurada de un cambio destinado a Release.

Podrá contener:

```text
component
change type
summary
version impact
migration impact
compatibility impact
```

---

# 66. Changeset Example

```yaml
component: mef/core
type: feature
versionImpact: minor
summary: Add compatibility inspection API.
```

---

# 67. Changeset Validation

El Pipeline podrá verificar que cambios públicos relevantes posean Changeset.

---

# 68. Version Calculation

Los Changesets podrán contribuir a determinar:

```text
next version
```

según ENG-014.

---

# 69. Release State Machine

ENG-015 podrá modelar Release mediante:

```text
Draft
  │
  ▼
Candidate
  │
  ▼
Validated
  │
  ▼
Approved
  │
  ▼
Signed
  │
  ▼
Published
```

Con rutas:

```text
Rejected
Withdrawn
Failed
```

cuando corresponda.

---

# 70. Draft

`Draft` representa una Release todavía en preparación.

---

# 71. Candidate

`Candidate` representa que existe un Artifact candidato identificable.

---

# 72. Validated

`Validated` significa que los Quality Gates obligatorios fueron satisfechos.

---

# 73. Approved

`Approved` significa que la Release recibió las autorizaciones requeridas.

---

# 74. Signed

`Signed` significa que el Artifact o metadata correspondiente posee las firmas requeridas.

---

# 75. Published

`Published` significa que la Release fue puesta oficialmente a disposición mediante los canales gobernados.

---

# 76. Rejected

`Rejected` significa que el Candidate no fue aprobado.

---

# 77. Withdrawn

`Withdrawn` significa que una Release publicada dejó de recomendarse o distribuirse por canales normales.

No significa que su historia haya sido borrada.

---

# 78. Failed

`Failed` representa fallo técnico del Release Process.

---

# 79. Release Transition Table

| Current | Transition | Next |
|---|---|---|
| Draft | create-candidate | Candidate |
| Candidate | validate | Validated |
| Candidate | reject | Rejected |
| Validated | approve | Approved |
| Validated | reject | Rejected |
| Approved | sign | Signed |
| Signed | publish | Published |
| Published | withdraw | Withdrawn |

---

# 80. Invalid Release Transition

No deberá permitirse:

```text
Draft → Published
```

saltándose Gates.

---

# 81. Release Gates

Los Gates iniciales serán:

```text
Source Gate
Version Gate
Test Gate
Build Gate
Artifact Gate
Compatibility Gate
Security Gate
Documentation Gate
Approval Gate
Signing Gate
Publication Gate
```

---

# 82. Gate

Un Gate es una condición obligatoria que debe satisfacerse antes de continuar.

---

# 83. Gate Result

Resultado:

```text
PASS
FAIL
WARNING
NOT_APPLICABLE
```

---

# 84. Gate Failure

Un Gate obligatorio con:

```text
FAIL
```

deberá detener el proceso.

---

# 85. Gate Warning

`WARNING` podrá continuar únicamente según Policy.

---

# 86. Gate Evidence

Cada Gate debería producir Evidence verificable.

---

# 87. Gate Ordering

El orden deberá minimizar trabajo innecesario.

Ejemplo:

```text
Source
Version
Static Validation
Tests
Build
Compatibility
Security
Approval
Signing
Publication
```

---

# 88. Fail Fast

Fallos baratos y deterministas deberían detectarse antes de operaciones costosas.

---

# 89. Approval

La aprobación representa una decisión explícita de permitir Promotion.

---

# 90. Automated Approval

Para Releases de bajo riesgo podrá existir aprobación automática cuando todos los Gates se satisfagan.

---

# 91. Manual Approval

Production Releases críticas podrán requerir aprobación humana.

---

# 92. Separation of Duties

Para componentes críticos podrá requerirse que:

```text
Author
≠
Approver
```

según Governance.

---

# 93. Approval Evidence

Deberá registrarse:

```text
approver
release
timestamp
result
```

cuando sea requerido.

---

# 94. Signing

Los Artifacts oficiales podrán firmarse criptográficamente.

---

# 95. Signing Purpose

La firma permite verificar:

```text
origin
integrity
authorization
```

según el mecanismo utilizado.

---

# 96. Signature Does Not Replace Hash

```text
Signature
≠
Digest
```

Ambos pueden cumplir funciones complementarias.

---

# 97. Signing Key

Las claves privadas de firma no deberán almacenarse dentro del Source Repository.

---

# 98. Key Access

El acceso deberá limitarse según Security Policy.

---

# 99. Key Rotation

El sistema deberá permitir rotación de claves sin destruir la verificabilidad histórica.

---

# 100. Signature Metadata

Podrá incluir:

```text
algorithm
keyId
signature
signedDigest
timestamp
```

---

# 101. Provenance

Toda Release debería disponer de información suficiente para rastrear:

```text
Source
↓
Build
↓
Artifact
↓
Release
```

---

# 102. Provenance Record

Conceptualmente:

```text
Release
├── source repository
├── source commit
├── build identity
├── build environment
├── artifact digest
├── dependency resolution
├── compatibility result
└── signatures
```

---

# 103. Provenance Integrity

La Provenance no deberá poder modificarse silenciosamente después de Publication.

---

# 104. Build Environment

Cuando sea relevante deberá registrarse información suficiente del entorno de Build para diagnóstico y reproducibilidad.

---

# 105. SBOM

MEF podrá producir una:

```text
Software Bill of Materials
```

para Releases cuando el componente y Security Policy lo requieran.

---

# 106. SBOM Purpose

Permite identificar componentes incluidos y dependencias relevantes.

---

# 107. SBOM Relationship

Conceptualmente:

```text
Release
  │
  ├── Artifact
  ├── Manifest
  ├── Provenance
  └── SBOM
```

---

# 108. Publication

Publication representa poner la Release a disposición mediante un canal oficial.

---

# 109. Publication Targets

Podrán existir:

```text
Package Registry
Artifact Registry
Container Registry
Source Release
Documentation Site
Internal Registry
```

según Artifact.

---

# 110. Publication Atomicity

Cuando sea posible, Publication deberá evitar estados parcialmente publicados.

---

# 111. Partial Publication

Si algunos Targets fallan, el sistema deberá registrar claramente el estado.

No deberá declarar éxito completo.

---

# 112. Publication Retry

La operación deberá ser idempotente cuando sea posible.

---

# 113. Registry

ARQ-017 y ENG-013 podrán utilizar un Registry para descubrir Releases.

---

# 114. Registry Metadata

El Registry deberá exponer información suficiente para:

```text
identity
version
digest
compatibility
dependencies
status
```

---

# 115. Registry Integrity

Metadata crítica del Registry deberá corresponder al Artifact publicado.

---

# 116. Registry Update

No deberá publicarse metadata que apunte a un Artifact inexistente.

---

# 117. Artifact Before Metadata

Cuando la arquitectura lo permita:

```text
Artifact
   ↓
Verify
   ↓
Registry Metadata
```

es preferible a anunciar primero un Artifact todavía inexistente.

---

# 118. Release Channels

MEF podrá soportar Channels.

Ejemplos:

```text
stable
candidate
preview
nightly
```

---

# 119. Stable

`stable` representa Releases destinadas a uso soportado ordinario.

---

# 120. Candidate

`candidate` representa Releases en validación previa.

---

# 121. Preview

`preview` podrá representar capacidades anticipadas sin garantías completas de estabilidad.

---

# 122. Nightly

`nightly` podrá contener Builds automatizados no considerados Releases estables.

---

# 123. Channel Does Not Replace Version

Channel y Version deberán mantenerse separados.

---

# 124. Promotion Between Channels

Podrá existir:

```text
candidate
    ↓
stable
```

sin reconstruir Artifact.

---

# 125. Promotion Evidence

La Promotion deberá registrar qué Artifact fue promovido.

---

# 126. Release Tags

El Source Repository podrá utilizar Tags.

Ejemplo:

```text
v2.4.1
```

---

# 127. Tag Immutability

Un Tag de Release publicado no deberá moverse silenciosamente a otro Commit.

---

# 128. Tag Verification

El Pipeline deberá comprobar que:

```text
Tag
→ Expected Commit
→ Expected Version
```

---

# 129. Documentation Gate

Antes de Release deberá verificarse documentación requerida.

---

# 130. Documentation Requirements

Podrán incluir:

```text
Release Notes
Migration Guide
Compatibility Matrix
API Changes
Deprecations
Security Notes
```

según impacto.

---

# 131. Migration Guide

Un Breaking Change que requiera acciones del consumidor deberá documentar Migration.

---

# 132. No Hidden Migration

No deberá publicarse una versión que requiera Migration obligatoria sin declararla.

---

# 133. Deprecation Documentation

Las Deprecations deberán reflejar:

```text
deprecated capability
replacement
timeline
```

cuando se conozca.

---

# 134. Release Checklist

El proceso podrá producir una Checklist equivalente a:

```text
[PASS] Source
[PASS] Version
[PASS] Tests
[PASS] Build
[PASS] Artifact
[PASS] Compatibility
[PASS] Security
[PASS] Documentation
[PASS] Approval
[PASS] Signing
[PASS] Publication
```

---

# 135. Checklist Generation

Preferiblemente deberá generarse automáticamente desde Gates.

---

# 136. Release Report

Toda Release podrá producir un Report estructurado.

---

# 137. Release Report Contents

Podrá incluir:

```text
releaseId
component
version
commit
buildId
artifactDigest
test result
compatibility result
security result
approvals
signature
publication targets
timestamps
```

---

# 138. Release Evidence Bundle

Podrá agrupar:

```text
Release Manifest
Test Report
Compatibility Report
Security Report
SBOM
Provenance
Signatures
Release Notes
```

---

# 139. Evidence Retention

La retención deberá definirse según Governance y criticidad.

---

# 140. Release Automation

El proceso debería automatizar todo paso determinista.

---

# 141. Human Decisions

Las decisiones humanas deberán reservarse principalmente para:

```text
risk acceptance
approval
exception
business timing
```

cuando correspondan.

---

# 142. CLI Integration

ENG-007 podrá incorporar:

```text
mef release prepare
mef release validate
mef release status
mef release publish
```

---

# 143. Prepare

`prepare` podrá:

- validar Changesets;
- calcular versión;
- generar Release Notes;
- preparar metadata.

---

# 144. Validate

`validate` podrá ejecutar los Gates disponibles sin publicar.

---

# 145. Status

`status` deberá mostrar el State definido por ENG-015.

---

# 146. Publish

`publish` deberá requerir que los Gates previos estén satisfechos.

---

# 147. No Force Publish by Default

No deberá existir un camino ordinario equivalente a:

```text
publish --ignore-everything
```

---

# 148. Release Dry Run

Podrá existir:

```text
mef release publish --dry-run
```

para verificar el proceso sin Publication real.

---

# 149. Structured Output

Los comandos deberán soportar salida procesable para CI cuando corresponda.

---

# 150. CI/CD Integration

Release Process deberá ser automatizable mediante Pipeline.

Conceptualmente:

```text
Pull Request
     │
     ▼
Validation
     │
     ▼
Merge
     │
     ▼
Release Preparation
     │
     ▼
Candidate
     │
     ▼
Release Pipeline
     │
     ▼
Publication
```

---

# 151. Pull Request Gate

Los controles baratos deberían ejecutarse antes del Merge.

---

# 152. Merge Gate

Branch Protection podrá exigir:

```text
tests
architecture checks
compatibility checks
review
```

---

# 153. Release Branch

MEF no deberá exigir universalmente una estrategia concreta de Branching.

---

# 154. Branching Independence

Podrán utilizarse:

```text
trunk-based
release branches
GitFlow-like models
```

según Implementation Profile.

---

# 155. Release Process Independence

Independientemente de Branching, los Release Gates deberán mantenerse.

---

# 156. Hotfix

Una corrección urgente podrá utilizar un flujo reducido únicamente si Policy lo define.

---

# 157. Hotfix Does Not Mean Unvalidated

Un Hotfix deberá mantener los Gates mínimos obligatorios.

---

# 158. Hotfix Version

Deberá cumplir ENG-014.

Normalmente podrá producir:

```text
PATCH
```

cuando no introduzca cambios incompatibles.

---

# 159. Emergency Release

Podrá existir para incidentes críticos.

---

# 160. Emergency Approval

Podrá reducir el número de Approvers, pero no deberá eliminar trazabilidad.

---

# 161. Post-Release Verification

Después de Publication deberá comprobarse:

```text
artifact available
digest correct
registry metadata correct
signature verifiable
```

---

# 162. Smoke Verification

Podrá realizarse una verificación mínima del Artifact publicado.

---

# 163. Publication Failure

Si Publication falla antes de completarse, el State deberá reflejarlo.

---

# 164. Release Failure

Un fallo de Publication no deberá producir falsamente:

```text
Published
```

---

# 165. Rollback

Rollback de Deployment y Rollback de Release no son equivalentes.

---

# 166. Release Rollback

Una Release publicada no debería eliminarse de la historia simplemente porque presente un problema.

---

# 167. Preferred Response

Normalmente:

```text
Bad Release
    │
    ├── Withdraw
    └── Publish Corrective Release
```

---

# 168. Corrective Release

Ejemplo:

```text
2.4.1 problematic
        ↓
withdraw / deprecate
        ↓
2.4.2 corrective
```

---

# 169. No Artifact Replacement

Nunca:

```text
replace contents of 2.4.1
```

por el contenido corregido de 2.4.2.

---

# 170. Yank / Withdraw

Un Registry podrá marcar una versión como:

```text
withdrawn
yanked
deprecated
```

sin borrar necesariamente el Artifact.

---

# 171. Security Removal

En incidentes extremos, Security Policy podrá requerir retirar físicamente un Artifact.

La acción deberá quedar auditada.

---

# 172. Rollback Compatibility

Antes de recomendar una versión anterior deberá comprobarse:

```text
Data Compatibility
Configuration Compatibility
Migration State
```

---

# 173. Release Reversal

No deberá asumirse:

```text
install previous version
=
safe rollback
```

---

# 174. Release Failure Classification

Podrán distinguirse:

```text
Validation Failure
Build Failure
Compatibility Failure
Security Failure
Approval Failure
Signing Failure
Publication Failure
Post-Publication Failure
```

---

# 175. Failure Diagnostics

Los fallos deberán identificar la fase.

---

# 176. Release Error Taxonomy

Taxonomía conceptual:

```text
MEF-REL-001 Invalid release version
MEF-REL-002 Duplicate release
MEF-REL-003 Release test gate failed
MEF-REL-004 Build gate failed
MEF-REL-005 Artifact verification failed
MEF-REL-006 Compatibility gate failed
MEF-REL-007 Security gate failed
MEF-REL-008 Documentation gate failed
MEF-REL-009 Approval missing
MEF-REL-010 Signing failed
MEF-REL-011 Publication failed
MEF-REL-012 Registry update failed
MEF-REL-013 Artifact digest mismatch
MEF-REL-014 Invalid provenance
MEF-REL-015 Release withdrawn
MEF-REL-016 Invalid release transition
MEF-REL-017 Post-release verification failed
```

La taxonomía definitiva podrá formalizarse posteriormente.

---

# 177. Diagnostic Example

```text
MEF-REL-006

Release blocked by Compatibility Gate.

Component:
mef/crm

Candidate:
4.0.0-rc.2

Requirement:
CTR-IDENTITY >=3.0 <4.0

Verified environment:
CTR-IDENTITY 2.8.4

Result:
INCOMPATIBLE

Release state:
Candidate
```

---

# 178. Logging

ENG-010 deberá registrar eventos relevantes.

Ejemplos:

```text
release candidate created
release validated
release approved
artifact signed
release published
release withdrawn
```

---

# 179. Correlation

Todo Release Pipeline debería disponer de:

```text
releaseId
```

o `correlationId` equivalente.

---

# 180. Audit

Acciones sensibles deberán ser auditables.

Ejemplos:

```text
approve
override
sign
publish
withdraw
```

---

# 181. Metrics

Podrán generarse:

```text
release_frequency
release_lead_time
release_failure_rate
gate_failure_rate
rollback_rate
candidate_to_release_time
```

---

# 182. Release Health

El éxito del Pipeline no garantiza que el Software nunca falle en Runtime.

Release Quality y Runtime Health deberán mantenerse separados.

---

# 183. Supply Chain Security

Release Process deberá proteger la cadena:

```text
Source
  ↓
Dependencies
  ↓
Build
  ↓
Artifact
  ↓
Registry
  ↓
Consumer
```

---

# 184. Trusted Source

Los Artifacts oficiales deberán originarse únicamente desde Sources autorizados.

---

# 185. Trusted Builder

Para componentes críticos podrá requerirse un Build Environment gobernado.

---

# 186. Trusted Registry

Los canales oficiales deberán estar definidos explícitamente.

---

# 187. Artifact Consumer Verification

ENG-013 deberá poder verificar:

```text
digest
signature
source
```

cuando Policy lo requiera.

---

# 188. Release Provenance Chain

```text
Source Commit
     │
     ▼
Build Identity
     │
     ▼
Artifact Digest
     │
     ▼
Signature
     │
     ▼
Registry Record
     │
     ▼
Installed Artifact
```

---

# 189. Provenance Break

Si una parte crítica no puede verificarse, Policy podrá impedir instalación o Promotion.

---

# 190. Reproducible Release

Una Release será reproducible cuando el proceso permita producir un Artifact equivalente bajo las reglas definidas.

---

# 191. Deterministic Build

ENG-012 deberá favorecer entradas controladas para mejorar reproducibilidad.

---

# 192. Timestamp Problem

Datos variables como timestamps incrustados pueden impedir igualdad binaria.

La estrategia de reproducibilidad deberá definir su tratamiento.

---

# 193. Dependency Drift

La Release no deberá depender silenciosamente de:

```text
latest
```

si ello impide reproducibilidad.

---

# 194. Locked Dependencies

Las dependencias de Build deberían fijarse cuando el ecosistema lo requiera.

---

# 195. Release Rebuild

Si por razones excepcionales debe reconstruirse un Candidate, deberá obtener nueva identidad.

---

# 196. Artifact Promotion

Promotion deberá mover o marcar el mismo Artifact lógico aprobado.

---

# 197. Multi-Artifact Release

Una Release podrá contener múltiples Artifacts.

Ejemplo:

```text
source archive
binary linux-x64
binary linux-arm64
container image
SBOM
```

---

# 198. Artifact Set

Todos deberán asociarse a la misma Release Identity.

---

# 199. Platform-Specific Artifact

Cada Artifact podrá declarar:

```text
platform
architecture
runtime
digest
```

---

# 200. Partial Artifact Failure

Si un Artifact obligatorio falla, la Release completa deberá bloquearse.

Artifacts opcionales podrán seguir otra Policy.

---

# 201. Release Bundle

Conceptualmente:

```text
Release
  │
  ├── Artifact A
  ├── Artifact B
  ├── Artifact C
  ├── Release Manifest
  ├── SBOM
  ├── Provenance
  ├── Signatures
  └── Release Notes
```

---

# 202. Release Compatibility Matrix

Cada Release podrá publicar una Compatibility Matrix derivada de ENG-016.

---

# 203. Matrix Accuracy

La Matrix publicada deberá corresponder con las Compatibility Claims verificadas.

---

# 204. Compatibility Regression

Una Release PATCH no debería reducir Compatibility pública sin análisis de Version Impact.

---

# 205. Release API Stability

Las superficies públicas deberán compararse contra la Release anterior.

---

# 206. Contract Diff

El Pipeline podrá ejecutar:

```text
Old Contract
     │
     ▼
Compatibility Diff
     ▲
     │
New Contract
```

---

# 207. Schema Diff

También:

```text
Old Schema
    │
    ▼
Schema Compatibility
    ▲
    │
New Schema
```

---

# 208. Version Enforcement

Si se detecta Breaking Change pero la versión propuesta es:

```text
PATCH
```

el Version Gate deberá fallar.

---

# 209. Release Policy

Las reglas específicas deberán centralizarse en Release Policy.

---

# 210. Policy Contents

Podrá definir:

```text
required gates
required tests
required approvers
signature requirements
allowed channels
security thresholds
unknown compatibility policy
evidence retention
```

---

# 211. Policy by Component

Componentes distintos podrán poseer diferente criticidad.

Ejemplo:

```text
Core
→ strict

Experimental Tool
→ relaxed
```

sin eliminar garantías mínimas.

---

# 212. Policy by Channel

`stable` podrá requerir más Gates que:

```text
preview
```

---

# 213. Policy Versioning

Release Policy deberá versionarse cuando sus cambios afecten reproducibilidad o Governance.

---

# 214. Release Configuration

La configuración del Pipeline deberá tratarse como código cuando sea posible.

---

# 215. Pipeline as Code

Permite:

```text
review
versioning
testing
audit
reproducibility
```

---

# 216. Release Secrets

Credenciales de Registry y Signing deberán inyectarse de forma segura.

No deberán almacenarse en archivos versionados.

---

# 217. Least Privilege

El Pipeline deberá poseer únicamente los permisos necesarios.

---

# 218. Publish Permission

No todo Build Agent deberá tener permiso de Publication.

---

# 219. Signing Permission

No todo proceso deberá tener acceso a Signing Keys.

---

# 220. Environment Separation

Development Credentials no deberán permitir Publication en Production Registry.

---

# 221. Release Ownership

Cada componente deberá poseer un Owner o Team responsable.

---

# 222. Ownership Purpose

Permite determinar quién:

```text
reviews
approves
maintains
responds to incidents
```

---

# 223. Release Responsibility

Automation ejecuta el proceso.

Ownership conserva responsabilidad sobre la Release.

---

# 224. Release Cadence

MEF no deberá imponer universalmente una frecuencia de Releases.

---

# 225. Scheduled Release

Podrá existir calendario periódico.

---

# 226. Continuous Release

También podrá existir Release continua cuando Gates y Policy lo permitan.

---

# 227. Release Train

Múltiples componentes podrán coordinarse en un Release Train.

---

# 228. Independent Versioning

Los componentes deberán poder conservar Versioning independiente cuando la arquitectura lo permita.

---

# 229. Coordinated Compatibility

Un Release Train no deberá obligar a que todos los componentes tengan el mismo número de versión.

---

# 230. Monorepo

MEF deberá soportar Release Process en Monorepo.

---

# 231. Polyrepo

También deberá ser compatible conceptualmente con Polyrepo.

---

# 232. Repository Topology Independence

La topología del Source no deberá alterar las garantías fundamentales de Release.

---

# 233. Release Discovery

Consumers deberán poder descubrir Releases mediante mecanismos oficiales.

---

# 234. Latest

La etiqueta:

```text
latest
```

no deberá considerarse una identidad inmutable.

---

# 235. Exact Version

Para reproducibilidad deberá favorecerse:

```text
exact version
+
digest
```

cuando sea apropiado.

---

# 236. Release Retention

Las políticas deberán definir cuánto tiempo conservar Artifacts.

---

# 237. Historical Metadata

Incluso si un Artifact expira por Policy, debería preservarse metadata histórica suficiente cuando Governance lo requiera.

---

# 238. Release Deletion

Eliminar una Release publicada deberá considerarse operación excepcional.

---

# 239. Release Incident

Cuando se detecte un problema después de Publication deberá abrirse un flujo de Incident.

---

# 240. Incident Actions

Podrán incluir:

```text
withdraw
notify
fix
release patch
rotate keys
revoke signature
update advisory
```

según causa.

---

# 241. Security Incident

Una vulnerabilidad crítica podrá requerir Withdrawal inmediato.

---

# 242. Revocation

Si una firma o clave deja de ser confiable deberá existir mecanismo de Revocation según Security Architecture.

---

# 243. Release Advisory

Podrá publicarse información sobre Releases afectadas.

---

# 244. Consumer Notification

Futuros mecanismos podrán notificar:

```text
deprecated release
withdrawn release
security affected release
incompatible release
```

---

# 245. Release Verification by Consumer

El consumidor debería poder responder:

```text
Is this an official MEF Release?
```

mediante:

```text
Registry
+
Digest
+
Signature
+
Provenance
```

según Policy.

---

# 246. Verification Result

Conceptualmente:

```text
VERIFIED
UNVERIFIED
INVALID
REVOKED
```

---

# 247. Verified

Significa que las verificaciones requeridas fueron satisfechas.

---

# 248. Unverified

No significa necesariamente malicioso.

Significa que no pudo establecerse confianza suficiente.

---

# 249. Invalid

Significa que alguna evidencia esperada no coincide.

---

# 250. Revoked

Significa que una evidencia previamente válida fue revocada.

---

# 251. Package Manager Integration

ENG-013 deberá utilizar Release Metadata durante:

```text
discovery
resolution
download
verification
installation
```

---

# 252. Compatibility Integration

ENG-016 deberá consumir Compatibility Metadata publicada por Release.

---

# 253. Versioning Integration

ENG-014 deberá gobernar:

```text
version identity
version impact
pre-release semantics
deprecation
```

---

# 254. State Machine Integration

ENG-015 gobernará:

```text
Draft
Candidate
Validated
Approved
Signed
Published
Withdrawn
```

---

# 255. Build Integration

ENG-012 producirá Artifacts, pero no los declarará Releases por sí mismo.

---

# 256. Testing Integration

ENG-009 aportará Evidence al Release Gate.

---

# 257. Logging Integration

ENG-010 registrará eventos y errores del Pipeline.

---

# 258. Configuration Integration

ENG-011 gobernará configuración del proceso cuando corresponda.

---

# 259. Manifest Integration

ENG-003 será una de las fuentes autoritativas de metadata del componente.

---

# 260. Architectural Integration

La arquitectura completa queda:

```text
                         SOURCE
                            │
                            ▼
                        Changes
                            │
                            ▼
                       Changesets
                            │
                            ▼
                       Versioning
                        ENG-014
                            │
                            ▼
                         Testing
                         ENG-009
                            │
                            ▼
                          Build
                         ENG-012
                            │
                            ▼
                        Artifact
                            │
                            ▼
                      Compatibility
                         ENG-016
                            │
                            ▼
                         Security
                            │
                            ▼
                         Package
                         ENG-013
                            │
                            ▼
                    Release Candidate
                            │
                            ▼
                      State Machine
                         ENG-015
                            │
                            ▼
                     Release Gates
                            │
                            ▼
                        Approval
                            │
                            ▼
                         Signing
                            │
                            ▼
                       Publication
                            │
                            ▼
                         Registry
                            │
                            ▼
                    OFFICIAL RELEASE
```

---

# 261. Invariantes de Ingeniería

ENG-017 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-286 | Un Build no deberá considerarse Release hasta completar el proceso oficial de Publication. |
| EI-287 | Toda Release deberá estar asociada a una versión válida y a Source identificable. |
| EI-288 | Una identidad de Release publicada no deberá reutilizarse para contenido diferente. |
| EI-289 | El Artifact aprobado deberá ser el mismo Artifact lógico promovido a Release cuando el modelo tecnológico lo permita. |
| EI-290 | Todo Artifact oficial deberá poseer un Digest verificable. |
| EI-291 | Los Tests obligatorios deberán aprobarse antes de Promotion. |
| EI-292 | Una incompatibilidad obligatoria conocida deberá bloquear una Release soportada. |
| EI-293 | Los Security Gates obligatorios deberán aprobarse o poseer una excepción explícita autorizada. |
| EI-294 | Una Release con Breaking Changes deberá reflejar el impacto requerido por ENG-014. |
| EI-295 | Las Release Notes deberán declarar Breaking Changes y Migration Requirements relevantes. |
| EI-296 | Una Release no deberá saltar States obligatorios de ENG-015 para alcanzar Published. |
| EI-297 | La Publication deberá conservar trazabilidad entre Source, Build, Artifact y Release. |
| EI-298 | Los Tags oficiales de Release no deberán reasignarse silenciosamente a otro Source Commit. |
| EI-299 | Una Release publicada defectuosa no deberá corregirse sustituyendo silenciosamente su Artifact. |
| EI-300 | Withdrawal deberá conservar la identidad e historia de la Release afectada. |
| EI-301 | Los Secrets de Signing y Publication no deberán almacenarse en Source versionado. |
| EI-302 | La Release Metadata crítica deberá corresponder al Artifact efectivamente publicado. |
| EI-303 | Las acciones de Approval, Override, Signing, Publication y Withdrawal deberán ser auditables cuando aplique. |
| EI-304 | El Release Process deberá poder producir Evidence suficiente para verificar sus Gates obligatorios. |
| EI-305 | Release, Deployment y Runtime Health deberán mantenerse como conceptos distintos. |

---

# 262. Criterios de Conformidad

Una implementación será conforme con ENG-017 cuando:

- identifique Source;
- determine Version;
- ejecute Tests obligatorios;
- produzca Artifact controlado;
- calcule Digest;
- valide Manifest;
- evalúe Compatibility;
- aplique Security Gates;
- produzca Candidate;
- aplique Release Gates;
- modele Approval;
- soporte Signing cuando sea requerido;
- publique mediante canales gobernados;
- registre Release Metadata;
- preserve Provenance;
- mantenga Artifact Immutability;
- permita Withdrawal;
- produzca diagnósticos;
- se integre con ENG-009 a ENG-016.

---

# 263. Riesgos

Deberán evitarse especialmente:

## Build Equals Release

Considerar cualquier Artifact generado como Release oficial.

## Rebuild After Approval

Validar un Artifact y publicar otro reconstruido.

## Mutable Release

Modificar el contenido de una versión ya publicada.

## Manual Version Drift

Cambiar la versión sin relación con ENG-014.

## Untested Publication

Publicar antes de completar Testing.

## Compatibility Blindness

Publicar sin verificar Compatibility.

## Secret Leakage

Incluir credenciales en Artifact.

## Unsigned Critical Artifact

Distribuir Artifacts críticos sin el mecanismo de confianza requerido.

## Tag Mutation

Mover Tags de Releases existentes.

## Latest Dependency

Construir Release contra dependencias no fijadas cuando se requiere reproducibilidad.

## Silent Override

Ignorar Gates sin Evidence.

## Deleting History

Eliminar una Release problemática en lugar de marcarla apropiadamente.

## Rollback Assumption

Asumir que instalar la versión anterior siempre es seguro.

## Registry Drift

Publicar metadata distinta al Artifact real.

## Release Without Provenance

No poder determinar de dónde surgió el Artifact.

---

# 264. Implementación Inicial Recomendada

La primera implementación podrá utilizar:

```text
Git
+
CI Pipeline
+
ENG-009 Tests
+
ENG-012 Build
+
ENG-014 Versioning
+
ENG-016 Compatibility
+
Artifact Digest
+
Release Manifest
+
Registry Publication
```

sin implementar inicialmente toda la infraestructura avanzada.

---

# 265. Release Manifest Inicial

Versión mínima conceptual:

```yaml
release:
  schemaVersion: 1

  component:
    id: mef/core
    version: 1.0.0

  source:
    commit: "<commit>"

  build:
    id: "<build-id>"

  artifact:
    digest: "sha256:<digest>"

  compatibility:
    status: COMPATIBLE

  state:
    status: Published
```

---

# 266. Primera Fase

Implementar:

```text
Version Validation
Testing
Build
Artifact Digest
Compatibility Check
Release Candidate
Release Manifest
Publication
```

---

# 267. Segunda Fase

Agregar:

```text
Changesets
Automatic Release Notes
Signing
SBOM
Provenance
Release Channels
Approval Workflow
```

---

# 268. Tercera Fase

Agregar:

```text
Reproducible Builds
Advanced Supply Chain Verification
Automated Promotion
Compatibility Regression
Release Train
Release Analytics
Revocation
```

---

# 269. Principio Rector

> **Una Release de MEF no es simplemente una versión compilada: es un Artifact inmutable cuya identidad, origen, calidad, compatibilidad, integridad y autorización pueden demostrarse.**

---

# 270. Conclusión

**ENG-017 — Release Process** completa el ciclo de ingeniería necesario para convertir Source en Software distribuible de forma gobernada.

La cadena fundamental queda:

```text
Source
  ↓
Versioning
  ↓
Testing
  ↓
Build
  ↓
Artifact
  ↓
Compatibility
  ↓
Security
  ↓
Release Candidate
  ↓
Validation
  ↓
Approval
  ↓
Signing
  ↓
Publication
  ↓
Registry
  ↓
Official Release
```

Y establece una separación fundamental:

```text
Build
→ produce Artifact

Versioning
→ identifica evolución

Compatibility
→ demuestra combinaciones válidas

State Machine
→ gobierna el Lifecycle

Release Process
→ autoriza y publica

Registry
→ distribuye identidad y metadata

Package Manager
→ consume e instala
```

Con ENG-017, MEF puede responder formalmente:

```text
¿Qué código produjo esta versión?

¿Qué pruebas superó?

¿Qué compatibilidad declara?

¿Con qué Artifact exacto corresponde?

¿Cuál es su Digest?

¿Quién la aprobó?

¿Está firmada?

¿Dónde fue publicada?

¿Sigue siendo una Release válida?

¿Fue retirada?

¿Puede demostrarse su origen?
```

El resultado final es:

```text
             SOURCE
                │
                ▼
          ENGINEERING
                │
                ▼
        VERIFIED ARTIFACT
                │
                ▼
        RELEASE PROCESS
                │
                ▼
        OFFICIAL RELEASE
                │
                ▼
             REGISTRY
                │
                ▼
            CONSUMER
```

Así, la publicación deja de ser una acción manual de:

```text
"subir una nueva versión"
```

y se convierte en una operación arquitectónica gobernada:

```text
Build
+
Evidence
+
Compatibility
+
Security
+
Approval
+
Integrity
+
Provenance
=
Official MEF Release
```

---

# Referencias

## Arquitectura

- ARQ-011 — Contracts
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
- ENG-016 — Compatibility