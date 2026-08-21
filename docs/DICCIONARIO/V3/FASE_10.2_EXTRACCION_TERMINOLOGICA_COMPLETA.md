# FASE_10_2 — Extracción terminológica completa del Diccionario MEF-V3

**Estado:** `CLOSED`  
**Resultado:** `PASS`  
**Entrada:** `FASE_10_1 = CLOSED / PASS / 134 fuentes`

## 1. Objetivo

Extraer candidatos terminológicos desde el corpus limpio `FND → ARQ → ENG`, preservando la evidencia de origen y sin reutilizar el Diccionario histórico/V2 como autoridad.

Esta fase es deliberadamente **extractiva**:

```text
DEDUPLICATION = 0
CANONIZATION = 0
MEF_DIC_IDS_V3 = 0
```

## 2. Corpus procesado

```text
SOURCES_SCANNED = 134/134
FND_SCANNED = 15/15
ARQ_SCANNED = 18/18
ENG_SCANNED = 101/101
```

El `ARQ-015-EXTENSION_MODEL.md` recuperado en 10.1 está incluido.

## 3. Método de extracción

Se registraron candidatos provenientes de evidencia textual estructural y definitoria:

- encabezados Markdown;
- definiciones explícitas;
- términos destacados;
- identificadores técnicos en código inline;
- primera columna conceptual de tablas.

La extracción conserva **apariciones**, no conceptos únicos. Una misma expresión puede aparecer múltiples veces y con variantes.

La columna `clave_lexica_provisional` sirve exclusivamente para conteo descriptivo exacto/case-insensitive; **no constituye normalización canónica**.

## 4. Resultado bruto

```text
RAW_TERM_OCCURRENCES = 28543
PROVISIONAL_EXACT_LEXICAL_FORMS = 19777

FND_OCCURRENCES = 59
ARQ_OCCURRENCES = 259
ENG_OCCURRENCES = 28225
```

Distribución por tipo de evidencia:

- `ENCABEZADO`: **23812**
- `TABLA_COLUMNA_PRINCIPAL`: **2099**
- `CODIGO_INLINE`: **1265**
- `DEFINICION_EXPLICITA`: **845**
- `TERMINO_DESTACADO`: **522**

## 5. Qué significa este inventario

`10.2_CANDIDATOS_BRUTOS_V3.csv` no es todavía el Diccionario.

Puede contener:

- singular/plural;
- inglés/español;
- aliases;
- acrónimos;
- nombres de clases/interfaces;
- variantes de capitalización;
- términos editoriales;
- términos demasiado específicos;
- duplicados conceptuales;
- candidatos que posteriormente serán rechazados.

Todo esto es intencional. Resolverlo antes de terminar la extracción volvería a mezclar descubrimiento con canonización.

## 6. Exclusiones

No se utilizaron como autoridad:

```text
LEGACY_DICTIONARY = NO
V2_DICTIONARY = NO
HISTORICAL_MEF_DIC_IDS = NO
V2_CANDIDATE_LISTS = NO
```

Tampoco se asignó valor normativo a la frecuencia.

```text
FREQUENCY_AS_AUTHORITY = NO
SIMILARITY_AS_AUTHORITY = NO
```

## 7. Trazabilidad

Cada aparición extraída conserva:

- término/variante original;
- capa;
- ID de fuente;
- archivo;
- línea;
- tipo de evidencia;
- contexto;
- estado bruto;
- clave léxica provisional;
- número de apariciones de esa forma exacta.

La cobertura conserva además SHA-256 por fuente.

## 8. Artefactos

Se generan:

1. `FASE_10_2_EXTRACCION_TERMINOLOGICA_COMPLETA.md`
2. `10.2_CANDIDATOS_BRUTOS_V3.csv`
3. `10.2_COBERTURA_EXTRACCION_V3.csv`

## 9. Controles de cierre

```text
SOURCE_COVERAGE_COMPLETE = YES
FND_COVERAGE_COMPLETE = YES
ARQ_COVERAGE_COMPLETE = YES
ENG_COVERAGE_COMPLETE = YES

DEDUPLICATION_PERFORMED = NO
CANONIZATION_PERFORMED = NO
MEF_DIC_IDS_ASSIGNED = 0
```

## 10. Veredicto

**`PASS`**

Las 134 fuentes fueron recorridas y sus candidatos brutos quedaron registrados con trazabilidad suficiente para la siguiente fase.

## 11. Estado de salida

```text
FASE_10_2 = CLOSED
RESULT = PASS

SOURCES_SCANNED = 134
RAW_TERM_OCCURRENCES = 28543
PROVISIONAL_EXACT_LEXICAL_FORMS = 19777

CANONICAL_TERMS_V3 = 0
MEF_DIC_IDS_V3 = 0

NEXT_PHASE = FASE_10_3_NORMALIZACION_Y_DEDUPLICACION
```

## 12. Conclusión

FASE 10.2 produce el inventario terminológico bruto de MEF-V3 sin heredar decisiones del Diccionario histórico.

La siguiente fase deberá trabajar sobre este CSV para separar conceptos, aliases, variantes, duplicados y ruido editorial, todavía sin asignar IDs definitivos.
