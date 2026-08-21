# FASE 12.5 --- Workflow de Aprobación y Versionado

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Precondición:** `FASE_12_4 = CLOSED / PASS`\
**MEF-V3:** `FROZEN`\
**Baseline:** `203 conceptos canónicos`

## 1. Objetivo

Formalizar el flujo obligatorio que transforma una solicitud de cambio
en una decisión, aplicación validada y, cuando corresponda, un nuevo
baseline versionado.

## 2. Workflow normativo

``` text
PROPUESTO → EN_VALIDACION → PRE-VALIDATION → EVALUADO
                                      ├→ RECHAZADO → CERRADO
                                      ├→ DIFERIDO → EN_VALIDACION
                                      └→ APROBADO → APLICADO
                                                     ↓
                                              POST-VALIDATION
                                                     ↓
                                                  VALIDADO
                                                     ↓
                                                   COMMIT
                                                     ↓
                                              NUEVA VERSION
                                                     ↓
                                                   CERRADO
```

## 3. Regla de mutación

Sólo `APROBADO → APLICADO` puede producir mutación canónica y
exclusivamente dentro del alcance aprobado.

``` text
MUTATION_WITHOUT_APPROVAL = FORBIDDEN
SCOPE_EXPANSION_DURING_APPLICATION = FORBIDDEN
```

## 4. Prevalidación

Antes de decidir deben ejecutarse los controles aplicables de 12.4. Un
`ERROR` bloqueante impide la aplicación.

## 5. Decisión

Las decisiones permitidas son `APROBAR`, `RECHAZAR` y `DIFERIR`; todas
requieren justificación trazable.

## 6. Aplicación y postvalidación

La ejecución debe corresponder exactamente al alcance aprobado. Después
se ejecutan nuevamente los controles automáticos.

``` text
POST_VALIDATION = PASS → CONTINUE
POST_VALIDATION = BLOCKED → NO BASELINE
```

## 7. Commit

Toda mutación de artefactos versionados debe registrar el commit en el
expediente. El commit prueba la aplicación técnica, pero no sustituye la
aprobación normativa.

## 8. Versionado

Se define política `MAJOR.MINOR.PATCH`:

-   **PATCH:** metadata/trazabilidad sin cambio de identidad.
-   **MINOR:** altas compatibles, aliases aprobados y ampliaciones
    compatibles.
-   **MAJOR:** cambios estructurales incompatibles que requieren
    migración explícita.

``` text
VERSION_CHANGE ≠ ID_CHANGE
```

## 9. Nuevo baseline

Sólo procede con:

``` text
CHANGE_ID = CLOSED
DECISION = APPROVED
APPLICATION = COMPLETE
POST_VALIDATION = PASS
COMMIT = RECORDED
CHANGELOG = UPDATED
```

## 10. Rollback

Una reversión que altere el estado canónico constituye un nuevo cambio
gobernado y no una reescritura histórica.

## 11. Cierre

``` text
FASE_12_5 = CLOSED / PASS
WORKFLOW = ACTIVE
VERSIONING_POLICY = DEFINED
BASELINE_IMMUTABILITY = PROTECTED
MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
NEXT_PHASE = FASE_12_6_CIERRE_Y_BASELINE_DE_GOBERNANZA
```
