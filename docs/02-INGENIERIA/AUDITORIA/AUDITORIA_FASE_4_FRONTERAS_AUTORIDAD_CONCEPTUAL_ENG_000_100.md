# AUDITORÍA FASE 4 — FRONTERAS Y AUTORIDAD CONCEPTUAL ENG-000 → ENG-100

## 1. Objetivo

Evaluar si las disciplinas de `02-INGENIERIA` mantienen fronteras de responsabilidad claras y si existe una autoridad normativa identificable cuando dos o más ENG tratan conceptos próximos.

Esta fase no modifica documentos. Clasifica conflictos y prepara correcciones controladas para una fase posterior.

---

## 2. Método

Se revisaron:

- títulos, propósito y declaración;
- secciones `Relación con ENG-*`;
- cláusulas `≠`;
- expresiones `gobierna`, `especializa`, `autoritativo`, `frontera` y equivalentes;
- documentos con alta proximidad semántica;
- cadenas de especialización general → específica;
- documentos recientemente corregidos (`ENG-026`, `ENG-033`, `ENG-094`, `ENG-100`).

Cobertura textual del corpus canónico:

```text
Documentos auditados:                         101
Con sección explícita "Relación con ENG-*":   83
Con separaciones mediante "≠":                85
Con lenguaje de autoridad/frontera:           89
```

La ausencia de una palabra concreta no se considera por sí sola defecto; se evalúa la semántica del documento.

---

## 3. Resultado ejecutivo

```text
FRONTERAS CRÍTICAS REVISADAS:  20

🟢 CORRECTAS:                  15
🟡 REQUIEREN CLARIFICACIÓN:     3
🔴 REQUIEREN CORRECCIÓN:        2
```

### Dictamen

**FASE 4: APROBADA CON CORRECCIONES OBLIGATORIAS.**

La arquitectura conceptual general es coherente, pero quedan dos inconsistencias normativas reales concentradas en `ENG-044 — API Engineering`, además de ajustes menores en `ENG-026`, `ENG-029/060` y `ENG-058/059`.

---

## 4. Matriz de fronteras auditadas

| Frontera | Estado | Dictamen |
|---|---|---|
| **ENG-026 ↔ ENG-070** | 🟡 AJUSTE MENOR | La frontera normativa está explícita y correcta: ENG-070 gobierna Performance general; ENG-026 sólo Framework/Runtime Overhead. Sin embargo, la conclusión de ENG-026 todavía se denomina a sí misma “Performance Engineering” y afirma establecer el modelo formal general, por lo que debe alinearse con su especialización. |
| **ENG-033 ↔ ENG-044** | 🔴 CORRECCIÓN | ENG-033 contiene una frontera de autoridad explícita y robusta: Interface/Operation/Contract Semantics en ENG-033; Public API/HTTP/Consumer Semantics en ENG-044. ENG-044 conserva texto anterior que asigna a ENG-033 “protocolo/adapters” y omite su autoridad contractual general. Debe actualizarse ENG-044 para reflejar ENG-033 v1.1.0. |
| **ENG-044 ↔ ENG-026/070** | 🔴 CORRECCIÓN | ENG-044 aún declara a ENG-026 como autoridad general de Performance para latency/throughput/payload/concurrency. Tras la especialización de ENG-026, esas propiedades pertenecen a ENG-070 salvo que midan overhead interno del Runtime MEF. |
| **ENG-029 ↔ ENG-060** | 🟡 CLARIFICAR | ENG-060 reconoce que ENG-029 define el modelo base de Extension Engineering y que ENG-060 lo consume para Plugin Engineering. La frontera es conceptualmente válida, pero conviene hacerla normativa y explícita: Extension Point/Extension Contract → ENG-029; Plugin artifact/install/validation/activation/isolation/permissions → ENG-060. |
| **ENG-058 ↔ ENG-059** | 🟡 CLARIFICAR | Discovery y Resolution están separados en la arquitectura: Discovery encuentra Candidates y Resolution selecciona el Target efectivo. ENG-058 incluye términos como Ranking/Selection, por lo que conviene limitar esos términos a filtrado/priorización de candidatos sin invadir la decisión autoritativa de ENG-059. |
| **ENG-011 ↔ ENG-049** | 🟢 CORRECTO | La frontera está explícita: ENG-011 gobierna files/formats/parsing/environment loading; ENG-049 gobierna Source/Provider/Schema/Scope/Precedence/Resolution/Snapshot/Version/Change/Distribution/Rollback/Drift. |
| **ENG-049 ↔ ENG-050 ↔ ENG-051** | 🟢 CORRECTO | Configuration decide valores efectivos, Feature Management decide habilitación de capacidades y Policy define reglas declarativas reutilizables. ENG-050 documenta expresamente esta separación. |
| **ENG-046 ↔ ENG-050 ↔ ENG-051** | 🟢 CORRECTO | Authorization permanece autoridad sobre permisos; Feature Management no sustituye Authorization; Policy puede producir decisiones reutilizadas por diferentes dominios. |
| **ENG-015 ↔ ENG-052 ↔ ENG-053** | 🟢 CORRECTO | ENG-052 documenta la separación entre principios de State Machine (ENG-015), coordinación durable de procesos (ENG-052) y gestión de Runtime State (ENG-053). |
| **ENG-052 ↔ ENG-055** | 🟢 CORRECTO | ENG-055 distingue Workflow de Lifecycle: Workflow coordina procesos persistentes; Lifecycle gobierna existencia operativa de componentes. |
| **ENG-053 ↔ ENG-055** | 🟢 CORRECTO | ENG-053 gobierna State general; ENG-055 usa State para Lifecycle y añade semántica operacional de startup/readiness/drain/shutdown. |
| **ENG-055 ↔ ENG-100** | 🟢 CORRECTO | ENG-100 declara que ENG-055 define Lifecycle general y que ENG-100 lo especializa para Data Lifecycle Orchestration; ante conflicto general, ENG-055 es autoritativo. |
| **ENG-079 ↔ ENG-080** | 🟢 CORRECTO | Frontera estricta: Integrity pregunta si el State es válido; Quality pregunta si el State válido es apto para el propósito. |
| **ENG-080 ↔ ENG-081** | 🟢 CORRECTO | Quality se limita a fitness-for-purpose y Governance a ownership/policy/stewardship/lifecycle governance. |
| **ENG-081 ↔ ENG-082 ↔ ENG-083** | 🟢 CORRECTO | La separación reciente está explícita: Governance = authority/policy; Privacy = personal-data processing; Compliance = obligation satisfaction + demonstrable evidence. |
| **ENG-092 ↔ ENG-093** | 🟢 CORRECTO | ENG-092 gobierna duración, Holds, Eligibility y Disposal; ENG-093 preserva Data/Evidence a largo plazo sin convertir Archive en excepción automática. |
| **ENG-093 ↔ ENG-094** | 🟢 CORRECTO | Preservation responde cómo conservar Data en el tiempo; Portability cómo exportarlo/transferirlo en forma gobernada y utilizable. |
| **ENG-094 ↔ ENG-095** | 🟢 CORRECTO | Portability queda acotada a export/package/transfer/import; Synchronization a correspondencia continua y convergencia. |
| **ENG-095 ↔ ENG-096 ↔ ENG-097 ↔ ENG-098 ↔ ENG-099** | 🟢 CORRECTO | La secuencia mantiene dominios separados: Synchronization, Replication, Partitioning/Sharding, Distribution y Localization/Residency. |
| **ENG-092…099 ↔ ENG-100** | 🟢 CORRECTO | ENG-100 declara que coordina Retention, Archive, Portability, Synchronization, Replication, Partitioning, Distribution y Residency sin absorber su autoridad. |


---

## 5. Correcciones obligatorias detectadas

### 5.1 ENG-044 — API Engineering: autoridad de Interface

El modelo vigente debe ser:

```text
ENG-033 — Interface Engineering
→ Interface
→ Interface Contract
→ Operation Contract
→ Input / Output / Error Contract
→ Interface Boundary
→ Interface Adapter
→ Interface Versioning / Compatibility / Lifecycle

ENG-044 — API Engineering
→ Public API
→ API Boundary
→ Endpoint / Resource
→ HTTP Method / Status / URI / Headers
→ Content Negotiation
→ Pagination / Filtering / Sorting
→ Rate Limiting / Quotas
→ Idempotency Keys
→ ETag / Conditional Requests
→ CORS / OpenAPI
→ API Lifecycle
```

Por tanto, cualquier texto de ENG-044 que reduzca ENG-033 a `protocol/adapters` deberá sustituirse.

Cláusula recomendada:

> **ENG-033 será autoritativo para las semánticas contractuales generales de Interface. ENG-044 especializa dichas semánticas para APIs públicas y HTTP/Consumer-facing concerns. ENG-044 no deberá redefinir los fundamentos contractuales generales de Interface y ENG-033 no deberá redefinir mecanismos específicos de exposición pública gobernados por ENG-044.**

---

### 5.2 ENG-044 — API Engineering: Performance

Texto conceptual correcto:

```text
ENG-026
→ Framework / Runtime Overhead

ENG-070
→ Application / System / Workload Performance

ENG-044
→ API-specific Performance Requirements
  subordinados al modelo general ENG-070
```

Por tanto:

```text
latency
throughput
payload size
compression
concurrency
```

de una API pública pertenecen al ámbito general de ENG-070.

ENG-026 sólo será autoridad cuando se mida el overhead añadido por el Framework/Runtime MEF al procesamiento de API.

---

## 6. Ajustes menores recomendados

### 6.1 ENG-026 — Runtime Performance Engineering

La sección de relación con ENG-070 ya está correctamente delimitada.

Debe corregirse, sin embargo, cualquier frase final que todavía presente ENG-026 como el modelo general de Performance.

Forma recomendada:

```text
ENG-026 — Runtime Performance Engineering
establece el modelo especializado para medir,
presupuestar y controlar el overhead introducido
por el propio Framework y su Runtime.

ENG-070 — Performance Engineering
permanece autoritativo para Performance general.
```

---

### 6.2 ENG-029 ↔ ENG-060

La relación actual es conceptualmente correcta pero deberá formalizarse como frontera de autoridad:

```text
ENG-029 — Extension Engineering
→ Extension
→ Extension Point
→ Extension Contract
→ Extension eligibility/order/lifecycle contract

ENG-060 — Extension & Plugin Engineering
→ Plugin
→ Plugin Artifact / Manifest
→ Installation
→ Validation
→ Activation / Deactivation
→ Plugin Isolation
→ Permissions / Trust
→ Quarantine
→ Upgrade / Migration / Uninstall
```

Cuando un concepto sea general de Extension, ENG-029 será autoritativo.

Cuando corresponda a la unidad empaquetada y operativa Plugin, ENG-060 será autoritativo.

---

### 6.3 ENG-058 ↔ ENG-059

La frontera recomendada será:

```text
ENG-058 — Discovery Engineering
→ locate / enumerate / validate candidates

ENG-059 — Resolution Engineering
→ eligibility / compatibility / specificity /
   priority / tie-break / effective target
```

`Discovery Ranking` o `Discovery Selection` sólo podrán utilizarse como optimización o filtrado de Candidates y no como sustituto de la resolución autoritativa cuando existan múltiples Candidates elegibles.

---

## 7. Fronteras consideradas sólidas

### Configuration / Feature / Policy

```text
ENG-011 → physical/base configuration files
ENG-049 → configuration lifecycle and effective configuration
ENG-050 → capability enablement
ENG-051 → reusable declarative decision rules
ENG-046 → authorization of principal/action
```

### State / Workflow / Lifecycle

```text
ENG-015 → architectural state-machine principles
ENG-052 → long-running process coordination
ENG-053 → runtime state management
ENG-055 → operational component lifecycle
ENG-100 → data lifecycle orchestration
```

### Data validity / fitness / governance

```text
ENG-079 → Is state valid?
ENG-080 → Is valid data fit for purpose?
ENG-081 → Who governs/owns it?
ENG-082 → How may personal data be processed?
ENG-083 → Which obligations are satisfied and evidenced?
```

### Data lifecycle specialization

```text
ENG-092 → Retention & Disposal
ENG-093 → Archival & Preservation
ENG-094 → Portability
ENG-095 → Synchronization
ENG-096 → Replication
ENG-097 → Partitioning & Sharding
ENG-098 → Distribution
ENG-099 → Localization & Residency
ENG-100 → Lifecycle Orchestration
```

ENG-100 coordina, pero no absorbe, la autoridad de ENG-092 → ENG-099.

---

## 8. Regla general de autoridad resultante

Cuando dos ENG se relacionen por generalización/especialización:

```text
GENERAL ENGINEERING
       │
       ├── defines general concepts
       ├── owns general invariants
       └── remains authoritative for shared semantics
       │
       ▼
SPECIALIZED ENGINEERING
       ├── narrows scope
       ├── adds domain-specific semantics
       └── remains authoritative only inside that specialization
```

Por tanto:

```text
specialization ≠ redefinition
orchestration ≠ ownership
integration ≠ authority transfer
implementation concern ≠ general concept authority
```

---

## 9. Criterios de conformidad

```text
[x] se revisaron las fronteras de mayor riesgo
[x] se distinguieron autoridad general y especialización
[x] se revisó Runtime Performance vs Performance
[x] se revisó Interface vs API
[x] se revisó Extension vs Plugin
[x] se revisó Discovery vs Resolution
[x] se revisó Configuration vs Feature vs Policy
[x] se revisó State vs Workflow vs Lifecycle
[x] se revisó Integrity vs Quality vs Governance
[x] se revisó Retention/Archive/Portability/Data Lifecycle
[x] se identificaron contradicciones documentales reales
[x] no se modificaron ENG durante la auditoría
```

---

## 10. Resultado formal

```text
ARQUITECTURA DE AUTORIDAD GLOBAL       🟢 COHERENTE

CONFLICTOS CONCEPTUALES CRÍTICOS       2
→ ambos concentrados en ENG-044

AJUSTES MENORES                         3
→ ENG-026
→ ENG-029 / ENG-060
→ ENG-058 / ENG-059

FRONTERAS DATA ENGINEERING             🟢 SÓLIDAS
FRONTERAS LIFECYCLE                    🟢 SÓLIDAS
FRONTERAS POLICY/FEATURE/CONFIG        🟢 SÓLIDAS

FASE 4                                 ✅ APROBADA
                                       CON CORRECCIONES
```

---

## 11. Orden recomendado de corrección posterior

```text
1. ENG-044
   - Interface authority
   - Performance authority

2. ENG-026
   - ajustar conclusión/nombre de autoridad residual

3. ENG-060
   - formalizar frontera normativa con ENG-029
   - alinear título metadata con identidad final

4. ENG-058 / ENG-059
   - limitar Selection/Ranking de Discovery
   - declarar Resolution como decisión efectiva
```

Estas modificaciones deberán ejecutarse en la fase de correcciones controladas, no dentro de la auditoría diagnóstica.

---

## 12. Conclusión

La capa `02-INGENIERIA` presenta una arquitectura de autoridad conceptual madura y mayoritariamente bien delimitada.

Los principales conflictos no están distribuidos por todo el corpus: se concentran en documentos que conservaron texto anterior después de especializaciones posteriores.

El caso más importante es `ENG-044 — API Engineering`, que todavía refleja una versión anterior de las responsabilidades de `ENG-026` y `ENG-033`.

Una vez corregidos esos puntos, las fronteras de autoridad podrán considerarse estructuralmente cerradas.

El siguiente control recomendado es:

**AUDITORÍA FASE 5 — INVARIANTES EI Y CONTINUIDAD GLOBAL.**
