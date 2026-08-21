# FASE_10.5 — Construcción del Catálogo Canónico del Diccionario MEF-V3

**Estado:** `CLOSED`  
**Resultado:** `PASS`  
**Entrada:** `FASE_10_4 = CLOSED / PASS`  
**Universo evaluado:** **1462 candidatos**

## 1. Objetivo

Construir el catálogo canónico preliminar de MEF-V3 a partir de los candidatos cuya autoridad fue resuelta en 10.4.

Esta fase decide qué conceptos entran al catálogo **antes de numeración**.

```text
MEF_DIC_IDS_V3 = 0
ID_ASSIGNMENT = DEFERRED_TO_10_6
```

## 2. Regla conservadora de construcción

La reconstrucción limpia no convierte automáticamente todo candidato técnico en entrada canónica.

Se aplica:

```text
AUTORIDAD_FND  → CANONICO_PRE_ID
AUTORIDAD_ARQ  → CANONICO_PRE_ID
ENG_ONLY       → DIFERIDO_ENG_ONLY
RUIDO_RESIDUAL → RECHAZADO
```

La decisión evita reproducir en V3 el problema de crecimiento indefinido del Diccionario histórico.

## 3. Resultado

```text
INPUT_CANDIDATES = 1462

CANONICO_PRE_ID = 203
DIFERIDO_ENG_ONLY = 1259
RECHAZADO_RUIDO_RESIDUAL = 0

PRELIMINARY_CANONICAL_ENTRIES = 203
PRELIMINARY_NAME_COLLISIONS = 0
MEF_DIC_IDS_ASSIGNED = 0
```

## 4. Tratamiento de FND

Los candidatos con autoridad FND directa se incorporan al catálogo preliminar.

FND constituye la máxima autoridad dentro de la cadena documental V3.

## 5. Tratamiento de ARQ

Los candidatos con autoridad ARQ y sin autoridad FND superior registrada también se incorporan al catálogo preliminar.

ARQ puede definir conceptos arquitectónicos propios siempre que éstos hayan sobrevivido extracción, normalización y resolución de autoridad.

## 6. Tratamiento de ENG

Los candidatos sustentados exclusivamente por ENG **no se canonizan en 10.5**.

Se conservan como:

`DIFERIDO_ENG_ONLY`

Esto no equivale a rechazo. Permite que una futura autoridad FND/ARQ o un proceso formal de promoción técnica los reabra sin contaminar el catálogo canónico actual.

## 7. Aliases

Las variantes agrupadas en 10.3 se conservan como `aliases_provisionales`.

```text
ALIAS_GETS_ID = NO
ALIAS_IS_INDEPENDENT_CANONICAL_ENTRY = NO
```

Su validación definitiva podrá realizarse durante el cierre 10.6 antes de congelar el índice.

## 8. IDs

No se asignan IDs en esta fase.

```text
CANONICAL_CONCEPTS_PRE_ID = 203
MEF_DIC_IDS_V3 = 0
LEGACY_ID_REUSE = 0
```

La numeración sólo podrá comenzar después de congelar este catálogo conceptual.

## 9. Controles de integridad

```text
CANONICAL_NAME_COLLISIONS = 0
LEGACY_AS_AUTHORITY = 0
V2_AS_AUTHORITY = 0
AUTO_CANONIZATION_FROM_ENG = 0
SOURCE_MUTATIONS = 0
```

## 10. Artefactos

Se generan:

1. `FASE_10_5_CONSTRUCCION_DEL_CATALOGO_CANONICO.md`
2. `10.5_CATALOGO_CANONICO_V3_PRE_ID.csv`
3. `10.5_DECISIONES_CATALOGO_V3.csv`
4. `10.5_DIFERIDOS_ENG_ONLY_V3.csv`
5. `10.5_RECHAZADOS_V3.csv`

## 11. Veredicto

**`PASS`**

El catálogo conceptual preliminar queda separado de los candidatos ENG-only y de cualquier ruido residual.

## 12. Estado de salida

```text
FASE_10_5 = CLOSED
RESULT = PASS

INPUT_CANDIDATES = 1462
CANONICAL_CONCEPTS_PRE_ID = 203
DEFERRED_ENG_ONLY = 1259
REJECTED = 0

CANONICAL_NAME_COLLISIONS = 0
MEF_DIC_IDS_V3 = 0

NEXT_PHASE = FASE_10_6_ASIGNACION_FINAL_DE_IDS_COMPATIBILIDAD_Y_CIERRE
```

## 13. Conclusión

FASE 10.5 construye un catálogo V3 deliberadamente más estricto: sólo los conceptos respaldados por autoridad FND o ARQ ingresan al catálogo canónico preliminar.

La evidencia exclusivamente ENG queda preservada pero diferida. La siguiente fase podrá congelar el catálogo, asignar IDs V3 de manera controlada y construir el mapeo de compatibilidad con el legado.
