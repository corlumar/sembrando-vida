# FASE 11.3 --- Resolución de aliases y denominaciones históricas

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Entrada:** `FASE_11_2 = CLOSED / PASS_WITH_OBSERVATIONS`\
**MEF-V3:** `FROZEN`

## 1. Objetivo

Resolver las apariciones clasificadas por 11.2 como
`ALIAS_NO_DECLARADO`, reduciendo las ocurrencias documentales a
relaciones únicas alias → concepto canónico, sin recanonizar MEF-V3 ni
modificar fuentes.

## 2. Entrada

``` text
ALIAS_OCCURRENCES_11_2 = 4744
ENG_ONLY_DEFERRED = 1259
```

## 3. Método

Las 4,744 apariciones se agruparon por:

``` text
MEF-V3-ID + TERMINO_CANONICO + FORMA_OBSERVADA
```

Una forma se acepta como `ALIAS_CONTROLADO` cuando:

1.  ya estaba asociada provisionalmente al concepto V3;
2.  existe uso documental comprobado en 11.2;
3.  la misma forma no apunta a más de un ID V3.

Si una forma apuntara a múltiples IDs, quedaría bloqueada como ambigua.

## 4. Resultado

``` text
DOCUMENTED_ALIAS_OCCURRENCES = 4744
UNIQUE_ALIAS_RELATIONS = 7
CONTROLLED_ALIASES = 7
AMBIGUOUS_ALIASES = 0
CONCEPTS_WITH_CONTROLLED_ALIASES = 6

ENG_ONLY_TERMS_KEPT_DEFERRED = 1259
```

## 5. Regla sobre ENG-only

Los 1,259 términos ENG-only no se convierten en aliases por mera
similitud y permanecen:

``` text
MANTENER_DIFERIDO
```

No reciben ID y no modifican el catálogo.

## 6. Mutaciones

``` text
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

El registro de alias controlado es un artefacto de integración de FASE
11; no altera la identidad de los 203 conceptos congelados.

## 7. Artefactos

1.  `FASE_11_3_RESOLUCION_DE_ALIASES_Y_DENOMINACIONES_HISTORICAS.md`
2.  `11.3_ALIASES_CONTROLADOS_MEF_V3.csv`
3.  `11.3_ENG_ONLY_MANTENIDOS_DIFERIDOS.csv`
4.  `11.3_RESUMEN_ALIASES_POR_CONCEPTO.csv`
5.  `11.3_CONTROLES_INTEGRIDAD.csv`

## 8. Veredicto

**`PASS`**

Las apariciones documentales de aliases quedaron consolidadas en
relaciones únicas y controladas, sin colisiones entre IDs V3.

## 9. Estado de salida

``` text
FASE_11_3 = CLOSED / PASS
MEF_V3 = FROZEN
DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0

NEXT_PHASE = FASE_11_4_VINCULACION_NORMATIVA_MEF_V3_CON_FUENTES
```
