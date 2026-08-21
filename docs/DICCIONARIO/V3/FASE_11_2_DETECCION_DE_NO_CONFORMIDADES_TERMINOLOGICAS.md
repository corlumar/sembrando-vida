# FASE 11.2 --- Detección de no conformidades terminológicas

**Estado:** `CLOSED`\
**Resultado:** `PASS_WITH_OBSERVATIONS`\
**Entrada:** `FASE_11_1 = CLOSED / PASS`\
**MEF-V3:** `FROZEN`

## 1. Objetivo

Detectar usos y situaciones documentales que se apartan del catálogo
canónico MEF-V3, sin modificar FND, ARQ, ENG ni el diccionario.

## 2. Universo

``` text
MEF-V3 CONCEPTS = 203/203
SOURCE CORPUS = 134/134
ENG-ONLY DEFERRED INPUT = 1259
```

## 3. Clases registradas

-   `ALIAS_NO_DECLARADO`: uso comprobado de una variante provisional en
    las fuentes.
-   `LEGACY_ID_REFERENCE`: presencia de un identificador histórico
    `MEF-DIC-####` en FND/ARQ/ENG.
-   `ENG_ONLY_TERM`: candidato técnico diferido por 10.5, sin autoridad
    FND/ARQ.
-   `POSSIBLE_MISSING_LINK`: autoridad FND/ARQ declarada cuya capa no
    mostró cobertura léxica en 11.1.

Estas clases son diagnósticas y no implican corrección automática.

## 4. Resultado

``` text
TOTAL_NONCONFORMITY_RECORDS = 6003

ALIAS_NO_DECLARADO = 4744
LEGACY_ID_REFERENCE = 0
ENG_ONLY_TERM = 1259
POSSIBLE_MISSING_LINK = 0

SEVERITY_HIGH = 0
SEVERITY_MEDIUM = 4744
SEVERITY_LOW = 1259

CANONICAL_CONCEPTS_WITH_DIRECT_FINDINGS = 6
```

## 5. Tratamiento

`ALIAS_NO_DECLARADO` pasa a 11.3 para resolver si se controla como
alias, denominación histórica o variante no admitida.

`LEGACY_ID_REFERENCE` debe vincularse con la matriz Legacy→V3, sin
sustitución automática.

`ENG_ONLY_TERM` permanece diferido y no recibe ID durante FASE 11.

`POSSIBLE_MISSING_LINK` debe revisarse antes de asumir que existe una
falla documental real.

## 6. Mutaciones

``` text
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

## 7. Artefactos

1.  `FASE_11_2_DETECCION_DE_NO_CONFORMIDADES_TERMINOLOGICAS.md`
2.  `11.2_NO_CONFORMIDADES_TERMINOLOGICAS.csv`
3.  `11.2_RESUMEN_NO_CONFORMIDADES_POR_CONCEPTO.csv`
4.  `11.2_CONTROLES_INTEGRIDAD.csv`

## 8. Veredicto

**`PASS_WITH_OBSERVATIONS`**

La existencia de observaciones es esperada: 11.2 tiene como finalidad
localizarlas y clasificarlas, no corregirlas.

## 9. Estado de salida

``` text
FASE_11_2 = CLOSED / PASS_WITH_OBSERVATIONS
MEF_V3 = FROZEN
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0

NEXT_PHASE = FASE_11_3_RESOLUCION_DE_ALIASES_Y_DENOMINACIONES_HISTORICAS
```
