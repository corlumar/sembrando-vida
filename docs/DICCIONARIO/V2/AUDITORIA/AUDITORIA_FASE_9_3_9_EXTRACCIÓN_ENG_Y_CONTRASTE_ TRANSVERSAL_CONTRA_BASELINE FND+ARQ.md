# 9.3.9 — Extracción ENG y contraste transversal contra baseline FND+ARQ

**Estado:** EJECUTADO  
**Resultado:** `PASS WITH OBSERVATIONS / ENG EXTRACTED / TRANSVERSAL CROSS-REFERENCE BUILT`  
**Entrada heredada:** `9.3.8 = CLOSED / BASELINE_FND_ARQ = ESTABLISHED`

## 1. Objetivo

Ejecutar la extracción de la capa **ENG (Ingeniería)** y contrastar sus referencias explícitas contra el baseline congelado **FND + ARQ**, preservando la cadena de autoridad:

**FND → ARQ → ENG**

Esta etapa no modifica FND ni ARQ, no transfiere autoridad por frecuencia documental y no genera canonización automática ni nuevos IDs MEF-DIC.

## 2. Universo procesado

Se procesó el paquete `ENG_9.3.9.zip`.

Resultado de inventario:

- Documentos ENG: **101**
- Rango: **ENG-000 → ENG-100**
- Auditorías internas incluidas: **13**
- Corpus Engineering previamente cerrado: **101 documentos**
- Techo de invariantes declarado por la auditoría interna: **EI-1965**

La auditoría interna de Fase 10 establece que su cierre certificó el estado interno de Engineering, pero dejó expresamente las referencias FND/ARQ para una auditoría transversal posterior. La presente etapa ocupa esa función de extracción y pre-contraste.

## 3. Extracción transversal

La extracción produjo tres clases estructurales:

| Clase | Documentos ENG | Interpretación |
|---|---:|---|
| DEPENDENCIA_EXPLICITA | 30 | El front matter ENG declara al menos una dependencia FND/ARQ. |
| EVIDENCIA_TRANSVERSAL | 50 | No existe dependencia externa en front matter, pero el cuerpo referencia FND/ARQ. |
| SIN_RELACION_EXPLICITA | 21 | No se encontró referencia textual explícita FND/ARQ en el documento ENG. |

Total clasificado: **101 / 101**.

## 4. Dependencias externas declaradas

El front matter de ENG contiene **126 dependencias externas declaradas** distribuidas en **30 documentos ENG**.

Por familia:

- ARQ: **120**
- FND: **6**

Autoridades únicas referenciadas:

**FND:** FND-004, FND-005, FND-011, FND-013

**ARQ:** ARQ-000, ARQ-001, ARQ-002, ARQ-003, ARQ-004, ARQ-005, ARQ-006, ARQ-007, ARQ-008, ARQ-009, ARQ-010, ARQ-011, ARQ-012, ARQ-013, ARQ-014, ARQ-015, ARQ-016, ARQ-017

La cobertura de identificadores ARQ es completa respecto del rango observado `ARQ-000 → ARQ-017`: **18/18 identificadores distintos aparecen en ENG**.

En FND aparecen explícitamente **4 identificadores**: `FND-004`, `FND-005`, `FND-011`, `FND-013`.

## 5. Evidencia transversal fuera del front matter

Además de las dependencias declaradas, múltiples ENG incluyen referencias FND/ARQ en su cuerpo normativo, secciones de autoridad, materialización, restricciones o documentos relacionados.

Esto eleva la cantidad de documentos con alguna referencia externa explícita a:

**80 / 101 documentos ENG.**

De ellos:

- **30** declaran dependencia externa estructurada.
- **50** contienen únicamente evidencia transversal textual.
- **21** no contienen referencia FND/ARQ explícita.

La presencia textual se registra como evidencia; no se interpreta automáticamente como dependencia formal ni como transferencia de autoridad.

## 6. Documentos sin relación FND/ARQ explícita

Los siguientes **21 ENG** no presentan referencia FND/ARQ explícita en el corpus analizado:

```text
ENG-058
ENG-064
ENG-082
ENG-083
ENG-084
ENG-085
ENG-086
ENG-087
ENG-088
ENG-089
ENG-090
ENG-091
ENG-092
ENG-093
ENG-094
ENG-095
ENG-096
ENG-097
ENG-098
ENG-099
ENG-100
```

Este grupo se concentra principalmente en el tramo tardío de Data Engineering.

La clasificación correcta para esta etapa es:

`SIN_RELACION_EXPLICITA`

No significa que carezcan de fundamento arquitectónico o fundacional; significa únicamente que **el corpus ENG analizado no declara esa relación mediante identificadores FND/ARQ**.

## 7. Contraste contra el baseline 9.3.8

Se respetaron las reglas heredadas del baseline:

- FND permanece congelado.
- ARQ permanece congelado.
- ENG se analiza como capa subordinada.
- La repetición no constituye canonización.
- Las referencias cruzadas no crean autoridad.
- La evidencia transversal permanece separada de la dependencia explícita.
- No se asignan nuevos IDs MEF-DIC.
- No se reescriben documentos ENG.

La extracción confirma una dependencia arquitectónica fuerte de ENG hacia ARQ, especialmente a través de las autoridades de Modules, Contracts, Framework Lifecycle, Registry, Security, Service Container y Event Bus.

## 8. Conflictos

**Conflictos estructurales explícitos detectados:** `0`.

No se identificaron referencias ENG hacia IDs ARQ fuera de `ARQ-000 → ARQ-017`, ni referencias FND fuera del conjunto observado.

Sin embargo, este resultado **no equivale a una certificación semántica completa FND/ARQ ↔ ENG**. Para declarar ausencia de conflicto semántico término por término se requiere tener disponible en la misma auditoría el contenido fuente congelado de FND y ARQ o su matriz consolidada detallada.

Por ello, el estado se mantiene como:

`PASS WITH OBSERVATIONS`

y no como certificación semántica absoluta.

## 9. Canonización

Resultado:

```text
AUTO_CANONIZATION = 0
NEW_MEF_DIC_IDS = 0
FND_MUTATIONS = 0
ARQ_MUTATIONS = 0
ENG_MUTATIONS = 0
```

La etapa 9.3.9 es de extracción y contraste, no de canonización automática.

## 10. Artefacto de trazabilidad

Se generó el archivo:

`9.3.9_ENG_crosswalk.csv`

con una fila por cada `ENG-000 → ENG-100` y los campos:

- `eng_id`
- `titulo`
- `fnd_referenciadas`
- `arq_referenciadas`
- `dependencias_externas_frontmatter`
- `clasificacion_9_3_9`
- `canonizacion`
- `mef_dic_id_nuevo`

Este archivo constituye la evidencia estructurada de extracción de 9.3.9.

## 11. Hallazgos principales

1. El universo ENG está completo: **101/101 documentos**.
2. Existen **126 dependencias externas declaradas en front matter**.
3. ENG utiliza los **18 IDs ARQ-000 → ARQ-017**.
4. ENG referencia explícitamente **4 FND**: 004, 005, 011 y 013.
5. **80 ENG** poseen alguna referencia explícita FND/ARQ.
6. **21 ENG** quedan como `SIN_RELACION_EXPLICITA`.
7. No se detectaron referencias externas estructuralmente fuera de los rangos observados.
8. No se efectuó ninguna canonización ni creación automática de IDs MEF-DIC.

## 12. Estado de salida

```text
9.3.9 = EXECUTED
ENG_CORPUS = 101/101
ENG_RANGE = ENG-000 -> ENG-100
EXTERNAL_DEPENDENCIES_DECLARED = 126
ENG_WITH_STRUCTURED_EXTERNAL_DEPENDENCY = 30
ENG_WITH_TEXTUAL_TRANSVERSAL_EVIDENCE_ONLY = 50
ENG_WITHOUT_EXPLICIT_FND_ARQ_REFERENCE = 21
UNIQUE_FND_REFERENCED = 4
UNIQUE_ARQ_REFERENCED = 18
STRUCTURAL_EXTERNAL_CONFLICTS = 0
AUTO_CANONIZATION = 0
NEW_MEF_DIC_IDS = 0
FND = FROZEN
ARQ = FROZEN
RESULT = PASS_WITH_OBSERVATIONS
```

---

**Conclusión:** la extracción ENG quedó ejecutada y trazada contra el baseline FND+ARQ en el nivel estructural disponible. El corpus confirma una relación transversal dominante hacia Arquitectura y una referencia fundacional más selectiva. Los 21 ENG sin identificador FND/ARQ explícito quedan visibles para la siguiente etapa de validación semántica; no se consideran errores por defecto.
