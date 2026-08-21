# FASE 11.1 --- Matriz de cobertura MEF-V3 ↔ FND ↔ ARQ ↔ ENG

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Fase rectora:** `FASE 11 — Integración Normativa MEF-V3`\
**Baseline Git:** `7ef1faa`

## 1. Objetivo

Determinar la cobertura documental observable de los 203 conceptos
canónicos MEF-V3 sobre el corpus congelado de 134 fuentes FND, ARQ y
ENG, sin modificar el diccionario ni las fuentes.

## 2. Entrada validada

``` text
MEF-V3 CONCEPTS = 203/203
SOURCE CORPUS = 134/134
FND = 15/15
ARQ = 18/18
ENG = 101/101
```

## 3. Método

Se realizó una búsqueda léxica normalizada del nombre canónico y de los
aliases provisionales asociados a cada entrada V3. La normalización
controla mayúsculas/minúsculas, acentos, espacios y separadores.

Cada coincidencia conserva ID V3, capa, fuente, archivo, línea, tipo de
coincidencia y contexto.

**Importante:** cobertura léxica no equivale por sí sola a equivalencia
semántica ni autoridad normativa. Esta fase mide presencia documental
trazable.

## 4. Resultado

``` text
CONCEPTS_EVALUATED = 203
CONCEPTS_WITH_LEXICAL_COVERAGE = 203
CONCEPTS_WITHOUT_LEXICAL_COVERAGE = 0

COVERAGE_3_LAYERS = 23
COVERAGE_2_LAYERS = 74
COVERAGE_1_LAYER = 106
NO_LEXICAL_COVERAGE = 0

EVIDENCE_OCCURRENCES = 27746
```

Una ausencia de coincidencia léxica no invalida un concepto canónico.
Puede indicar variación terminológica, alias no controlado, referencia
implícita o necesidad de análisis en 11.2.

## 5. Integridad

``` text
MATRIX_ROWS = 203/203
SOURCE_FILES = 134/134
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

## 6. Artefactos

1.  `FASE_11_1_MATRIZ_DE_COBERTURA_MEF_V3_FND_ARQ_ENG.md`
2.  `11.1_MATRIZ_COBERTURA_MEF_V3.csv`
3.  `11.1_EVIDENCIA_COBERTURA_MEF_V3.csv`
4.  `11.1_COBERTURA_POR_FUENTE.csv`
5.  `11.1_CONTROLES_INTEGRIDAD.csv`

## 7. Veredicto

**`PASS`**

Los 203 conceptos y las 134 fuentes fueron evaluados. La matriz
resultante constituye la entrada controlada para detectar no
conformidades terminológicas en 11.2.

## 8. Estado de salida

``` text
FASE_11_1 = CLOSED / PASS
MEF_V3 = FROZEN
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0

NEXT_PHASE = FASE_11_2_DETECCION_DE_NO_CONFORMIDADES_TERMINOLOGICAS
```
