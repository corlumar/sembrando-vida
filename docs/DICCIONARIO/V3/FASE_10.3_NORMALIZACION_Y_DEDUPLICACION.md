# FASE_10_3 — Normalización y deduplicación del Diccionario MEF-V3

**Estado:** `CLOSED`  
**Resultado:** `PASS`  
**Entrada:** `FASE_10_2 = CLOSED / PASS`

## 1. Objetivo

Reducir las **28,543 apariciones terminológicas brutas** de 10.2 a un universo conceptual manejable, separando:

- ruido editorial/técnico;
- variantes léxicas;
- aliases provisionales;
- duplicados exactos y cercanos;
- candidatos conceptuales únicos.

Esta fase **no canoniza** y **no asigna IDs**.

```text
CANONIZATION = 0
MEF_DIC_IDS_V3 = 0
```

## 2. Método

Se aplicó normalización conservadora:

- espacios y capitalización;
- acentos para clave de comparación;
- puntuación y separadores;
- singularización limitada inglés/español;
- agrupación por clave conceptual;
- selección de término preferido provisional según fuerza de evidencia y autoridad de capa.

No se utilizó el Diccionario histórico ni V2 como autoridad.

## 3. Ruido descartado

Se filtraron apariciones claramente editoriales o de implementación accidental, incluyendo:

- encabezados genéricos;
- rutas/archivos;
- URLs;
- versiones;
- frases completas;
- comandos o fragmentos de configuración;
- metadatos documentales.

```text
RAW_OCCURRENCES = 28543
NOISE_OCCURRENCES = 551
RETAINED_OCCURRENCES = 27992
```

El ruido queda preservado en un CSV separado para auditoría; no se elimina sin trazabilidad.

## 4. Universo conceptual normalizado

```text
NORMALIZED_CONCEPT_GROUPS = 19390
PROVISIONAL_VARIANT_RELATIONS = 436

CANDIDATO_CON_AUTORIDAD = 203
CANDIDATO_ENG_DEFINIDO = 255
CANDIDATO_ENG_REPETIDO = 1004
BAJA_SEÑAL = 17928
```

La categoría `BAJA_SEÑAL` no significa rechazo definitivo; significa que el concepto no posee todavía evidencia suficiente para pasar directamente a resolución de autoridad.

## 5. Regla de agrupación

Una agrupación en 10.3 significa:

`MISMA_CLAVE_CONCEPTUAL_PROVISIONAL`

No significa todavía:

`MISMO_CONCEPTO_CANONICO`

Las fusiones semánticas definitivas pertenecen a la fase 10.4/10.5.

## 6. Candidatos habilitados para 10.4

Los conceptos con autoridad FND/ARQ o evidencia ENG suficientemente estructurada/repetida se exportan a:

`10.3_CANDIDATOS_PARA_RESOLUCION_AUTORIDAD_V3.csv`

Total:

```text
READY_FOR_AUTHORITY_RESOLUTION = 1462
LOW_SIGNAL_DEFERRED = 17928
```

## 7. Artefactos

Se generan:

1. `FASE_10_3_NORMALIZACION_Y_DEDUPLICACION.md`
2. `10.3_CANDIDATOS_NORMALIZADOS_V3.csv`
3. `10.3_VARIANTES_Y_ALIASES_PROVISIONALES_V3.csv`
4. `10.3_RUIDO_DESCARTADO_V3.csv`
5. `10.3_CANDIDATOS_PARA_RESOLUCION_AUTORIDAD_V3.csv`

## 8. Integridad

```text
LEGACY_AS_AUTHORITY = 0
V2_AS_AUTHORITY = 0
AUTO_CANONIZATION = 0
MEF_DIC_IDS_V3 = 0

SOURCE_MUTATIONS = 0
```

## 9. Veredicto

**`PASS`**

El universo bruto de 10.2 queda transformado en un inventario conceptual normalizado y trazable.

No se han tomado decisiones canónicas.

## 10. Estado de salida

```text
FASE_10_3 = CLOSED
RESULT = PASS

RAW_OCCURRENCES = 28543
NORMALIZED_CONCEPT_GROUPS = 19390
READY_FOR_AUTHORITY_RESOLUTION = 1462
LOW_SIGNAL_DEFERRED = 17928

CANONICAL_TERMS_V3 = 0
MEF_DIC_IDS_V3 = 0

NEXT_PHASE = FASE_10_4_RESOLUCION_DE_AUTORIDAD
```

## 11. Conclusión

FASE 10.3 reduce el corpus terminológico a grupos conceptuales provisionales y separa las variantes sin convertirlas todavía en aliases oficiales.

La siguiente fase debe determinar, para cada candidato habilitado, si su autoridad proviene de FND, ARQ, ENG subordinado, evidencia transversal o si permanece sin autoridad suficiente.
