# FASE 12.3 --- Reglas de Alta, Modificación y Deprecación

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Precondición:** `FASE_12_2 = CLOSED / PASS`\
**MEF-V3:** `FROZEN`\
**Baseline:** `203 conceptos canónicos`

## 1. Objetivo

Definir las reglas normativas para evolucionar MEF-V3 sin destruir
identidad histórica, reutilizar IDs, introducir canonización silenciosa
o alterar retroactivamente los baselines cerrados.

## 2. Regla principal

``` text
CAMBIO APROBADO ≠ NUEVO ID AUTOMATICO
```

Antes de asignar un nuevo ID debe resolverse si el cambio representa una
identidad nueva o la evolución de una identidad existente.

## 3. Árbol de decisión de identidad

``` text
PROPUESTA
   ↓
¿Existe concepto equivalente?
   ├─ SI → ¿es alias / variante / renombre?
   │          ├─ SI → CONSERVAR ID
   │          └─ NO → evaluar cambio semántico
   │
   └─ NO → ¿identidad nueva demostrada?
              ├─ NO → RECHAZAR / DIFERIR
              └─ SI → APROBAR ALTA
                         ↓
                  ASIGNAR NUEVO ID
```

## 4. Alta de concepto

Un nuevo concepto requiere demostrar:

``` text
NO_ES_ALIAS
NO_ES_VARIANTE
NO_ES_RENOMBRE
NO_ES_DUPLICADO
NO_ESTA_REPRESENTADO
AUTORIDAD_SUFICIENTE
CHANGE_ID_APROBADO
```

El ID se asigna después de la aprobación, nunca durante la propuesta.

## 5. Renombre

Si sólo cambia la denominación y permanece la identidad:

``` text
MEF_V3_ID = CONSERVAR
```

El nombre anterior debe conservarse como denominación histórica o alias
cuando corresponda.

Un renombre no puede utilizarse para sustituir silenciosamente un
concepto por otro.

## 6. Cambio de definición

Debe clasificarse como:

``` text
NO_IDENTITARIO
IDENTITARIO
```

Un cambio no identitario conserva el ID.

Si el cambio altera materialmente la identidad, alcance o significado,
debe evaluarse como potencial concepto nuevo, reemplazo, fusión o
división. No debe sobrescribirse la identidad histórica.

## 7. Aliases

Un alias:

-   no crea ID;
-   debe apuntar inequívocamente a un único concepto;
-   debe conservar evidencia;
-   puede retirarse sin borrar su historia.

``` text
AMBIGUOUS_ALIAS → NOT_ACCEPTED
```

## 8. Cambio de autoridad

Todo cambio de autoridad requiere evidencia y un `CHANGE_ID`.

La frecuencia documental no altera por sí misma la jerarquía:

``` text
FND → ARQ → ENG
```

## 9. Cambio de trazabilidad

Puede añadir, corregir o retirar vínculos documentales, pero debe:

-   conservar la historia del cambio;
-   mantener trazabilidad bidireccional;
-   no transformar presencia documental en autoridad automáticamente.

## 10. Corrección de metadata

Una corrección editorial o de metadata conserva el ID cuando no altera
significado ni identidad.

Si la supuesta corrección cambia semántica, debe reclasificarse como
`CAMBIO_DEFINICION` u otro tipo apropiado.

## 11. Deprecación

``` text
DEPRECATED ≠ DELETED
```

Una entrada deprecada conserva permanentemente:

``` text
MEF_V3_ID
NOMBRE
ESTADO
MOTIVO
CHANGE_ID
FECHA
TRAZABILIDAD
REEMPLAZO, SI EXISTE
```

Su ID nunca vuelve al conjunto disponible.

## 12. Reemplazo

El reemplazo debe conservar las dos identidades y registrar
explícitamente:

``` text
ORIGEN → replaced_by → DESTINO
DESTINO → replaces → ORIGEN
```

No se transfiere el ID del concepto antiguo al nuevo.

## 13. Fusión

En una fusión:

1.  los IDs preexistentes permanecen reservados;
2.  se registran todos los predecesores;
3.  la identidad resultante se resuelve formalmente;
4.  si requiere identidad nueva, recibe un ID nuevo sólo después de
    aprobación.

## 14. División

En una división:

1.  el ID original conserva su historia;
2.  se registran los conceptos sucesores;
3.  cada identidad nueva aprobada recibe un ID nuevo;
4.  el ID original no se recicla para uno de los sucesores.

## 15. ENG-only

Un término exclusivamente ENG no puede promoverse directamente.

Debe pasar por:

``` text
CHANGE_ID
  ↓
VALIDACION_IDENTIDAD
  ↓
RESOLUCION_AUTORIDAD
  ↓
APROBACION
  ↓
ALTA, SI PROCEDE
```

## 16. Continuidad histórica

Toda transformación debe permitir reconstruir:

``` text
ANTES
 ↓
CHANGE_ID
 ↓
DECISION
 ↓
DESPUES
```

La gobernanza debe preservar tanto el estado actual como la explicación
histórica de cómo se llegó a él.

## 17. Invariantes

``` text
ID_REUSE = FORBIDDEN
DEPRECATED_ID_REUSE = FORBIDDEN
DELETE_CANONICAL_HISTORY = FORBIDDEN
PREASSIGN_NEW_ID = FORBIDDEN
APPLY_WITHOUT_CHANGE_ID = FORBIDDEN
APPLY_WITHOUT_APPROVAL = FORBIDDEN
SILENT_IDENTITY_CHANGE = FORBIDDEN
```

## 18. Artefactos

1.  `FASE_12_3_REGLAS_DE_ALTA_MODIFICACION_Y_DEPRECACION.md`
2.  `12.3_MATRIZ_REGLAS_EVOLUCION_MEF_V3.csv`
3.  `12.3_REGLAS_IDENTIDAD_Y_CONTINUIDAD.csv`
4.  `12.3_CONTROLES_REGLAS_EVOLUCION.csv`

## 19. Controles de cierre

``` text
CHANGE_TYPES_COVERED = 13/13
NEW_CONCEPT_RULE = DEFINED
RENAME_RULE = DEFINED
DEFINITION_CHANGE_RULE = DEFINED
ALIAS_RULE = DEFINED
DEPRECATION_RULE = DEFINED
REPLACEMENT_RULE = DEFINED
MERGE_RULE = DEFINED
SPLIT_RULE = DEFINED

ID_REUSE = FORBIDDEN
HISTORICAL_TRACEABILITY = REQUIRED

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

## 20. Veredicto

**`PASS`**

Las operaciones de alta, modificación, deprecación, reemplazo, fusión y
división quedan gobernadas por reglas explícitas de identidad,
continuidad histórica y control de IDs.

## 21. Estado de salida

``` text
FASE_12_3 = CLOSED / PASS

EVOLUTION_RULES = DEFINED
IDENTITY_CONTINUITY = PROTECTED
DEPRECATION_MODEL = DEFINED
ID_REUSE = FORBIDDEN

MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0

NEXT_PHASE = FASE_12_4_VALIDACIONES_AUTOMATICAS_DE_INTEGRIDAD
```
