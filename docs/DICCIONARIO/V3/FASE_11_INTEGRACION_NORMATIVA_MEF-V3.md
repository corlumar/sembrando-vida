# FASE 11 --- INTEGRACIÓN NORMATIVA MEF-V3

**Estado:** `OPEN`\
**Tipo de fase:** Integración normativa y control de conformidad
documental\
**Baseline Git:** `7ef1faa`\
**Predecesora:**
`FASE 10 — Reconstrucción limpia del Diccionario MEF-V3`\
**Diccionario de entrada:** `MEF-V3 = FROZEN`

------------------------------------------------------------------------

## 1. Propósito

FASE 11 tiene como propósito integrar el Diccionario MEF-V3 ya
reconstruido y congelado con el corpus documental del framework, de
forma que los conceptos canónicos y sus identificadores se conviertan en
la referencia terminológica normativa efectiva de las capas:

`FND → ARQ → ENG`

FASE 11 no reconstruye el diccionario, no vuelve a decidir qué conceptos
son canónicos y no reabre las decisiones cerradas en FASE 10.

Su función es comprobar, vincular y controlar el uso documental de
MEF-V3.

------------------------------------------------------------------------

## 2. Baseline normativo de entrada

FASE 11 inicia exclusivamente desde el checkpoint aprobado al cierre de
FASE 10:

``` text
BASELINE_GIT = 7ef1faa

FASE_10 = CLOSED / PASS
MEF-V3 = FROZEN

CANONICAL_CONCEPTS_V3 = 203
MEF_V3_IDS = 203

FIRST_ID = MEF-V3-DIC-0001
LAST_ID  = MEF-V3-DIC-0203

LEGACY_IDENTITIES_CONTROLLED = 70/70

SOURCE_CORPUS = 134
FND = 15
ARQ = 18
ENG = 101
```

Este baseline constituye la frontera de entrada de FASE 11.

------------------------------------------------------------------------

## 3. Autoridad normativa

La cadena documental de autoridad permanece:

``` text
FND
 ↓
ARQ
 ↓
ENG
```

MEF-V3 no sustituye esa cadena.

MEF-V3 actúa como catálogo terminológico canónico transversal que
identifica y vincula los conceptos reconocidos por dichas fuentes.

Por tanto:

``` text
FND = autoridad fundacional
ARQ = autoridad arquitectónica subordinada a FND
ENG = autoridad técnica subordinada a FND/ARQ
MEF-V3 = identidad terminológica canónica transversal
```

La frecuencia de aparición de un término no modifica esta jerarquía.

------------------------------------------------------------------------

## 4. Regla de inmutabilidad de MEF-V3

Durante FASE 11 el catálogo congelado de 203 conceptos se considera
entrada inmutable.

Queda expresamente prohibido:

``` text
RECANONIZAR_CONCEPTOS = NO
RENUMERAR_MEF_V3 = NO
REUTILIZAR_IDS_LEGACY = NO
ELIMINAR_CONCEPTOS_CANONICOS = NO
FUSIONAR_CONCEPTOS_AUTOMATICAMENTE = NO
DIVIDIR_CONCEPTOS_AUTOMATICAMENTE = NO
AGREGAR_IDS_AUTOMATICAMENTE = NO
PROMOVER_ENG_ONLY_AUTOMATICAMENTE = NO
```

Una incidencia detectada durante FASE 11 deberá registrarse como no
conformidad o solicitud futura de evolución.

No deberá modificarse silenciosamente el diccionario congelado.

------------------------------------------------------------------------

## 5. Universo documental

El universo documental de integración está compuesto por las 134 fuentes
congeladas en FASE 10:

  Capa          Fuentes
  ----------- ---------
  FND                15
  ARQ                18
  ENG               101
  **Total**     **134**

Cada comprobación de FASE 11 deberá preservar trazabilidad hacia la
fuente documental correspondiente.

------------------------------------------------------------------------

## 6. Universo terminológico

El universo canónico de FASE 11 está compuesto por:

``` text
MEF-V3-DIC-0001
...
MEF-V3-DIC-0203
```

Total:

``` text
CANONICAL_TERMS = 203
```

Los IDs constituyen identidades estables dentro del namespace V3.

Los IDs históricos:

``` text
MEF-DIC-0001
...
MEF-DIC-0070
```

permanecen únicamente como referencias Legacy controladas mediante el
mapeo construido en FASE 10.6.

------------------------------------------------------------------------

## 7. Tratamiento de candidatos ENG-only

FASE 10.5 dejó 1,259 candidatos sustentados exclusivamente por ENG fuera
del catálogo canónico.

Su estado permanece:

``` text
DIFERIDO_ENG_ONLY
```

Durante FASE 11:

-   pueden aparecer como evidencia técnica;
-   pueden detectarse como denominaciones no conformes;
-   pueden vincularse con conceptos existentes cuando exista evidencia
    demostrable;
-   no reciben automáticamente un nuevo ID;
-   no se incorporan automáticamente a MEF-V3.

Si alguno requiere promoción futura, deberá abrirse un procedimiento
formal de evolución del diccionario posterior al cierre de FASE 11.

------------------------------------------------------------------------

## 8. Objetivos de integración

FASE 11 deberá responder, como mínimo, las siguientes preguntas:

1.  ¿En qué fuentes FND, ARQ y ENG aparece cada uno de los 203 conceptos
    MEF-V3?
2.  ¿Qué conceptos poseen cobertura transversal?
3.  ¿Qué conceptos están sustentados únicamente por una capa?
4.  ¿Qué documentos utilizan denominaciones diferentes al nombre
    canónico?
5.  ¿Qué aliases históricos continúan presentes?
6.  ¿Existen referencias Legacy que deban sustituirse o documentarse?
7.  ¿Existen términos técnicos sin correspondencia canónica?
8.  ¿Puede vincularse cada uso normativo relevante con un ID MEF-V3?
9.  ¿Existen contradicciones terminológicas entre FND, ARQ y ENG?
10. ¿El corpus puede declararse integrado normativamente con MEF-V3?

------------------------------------------------------------------------

## 9. Estructura de FASE 11

FASE 11 se divide en seis subfases controladas.

### 11.1 --- Matriz de cobertura MEF-V3 ↔ FND ↔ ARQ ↔ ENG

Construirá la matriz transversal de los 203 conceptos contra las 134
fuentes.

Resultado esperado:

``` text
MEF-V3-ID
CANONICAL_TERM
FND_COVERAGE
ARQ_COVERAGE
ENG_COVERAGE
SOURCE_REFERENCES
COVERAGE_STATUS
```

No se modificará ninguna fuente.

------------------------------------------------------------------------

### 11.2 --- Detección de no conformidades terminológicas

Identificará usos documentales que no correspondan con la denominación
canónica vigente.

Podrán clasificarse, entre otros, como:

``` text
ALIAS_NO_DECLARADO
DENOMINACION_HISTORICA
VARIANTE_NO_CONTROLADA
LEGACY_ID_REFERENCE
ENG_ONLY_TERM
AMBIGUOUS_REFERENCE
POSSIBLE_MISSING_LINK
```

La detección no implica corrección automática.

------------------------------------------------------------------------

### 11.3 --- Resolución de aliases y denominaciones históricas

Determinará qué variantes pueden reconocerse formalmente como aliases de
conceptos MEF-V3 existentes.

Toda relación deberá conservar:

``` text
ALIAS
MEF-V3-ID
CANONICAL_TERM
SOURCE
EVIDENCE
RESOLUTION
```

No se crearán conceptos nuevos mediante aliasing.

------------------------------------------------------------------------

### 11.4 --- Vinculación normativa MEF-V3 con fuentes

Construirá la relación explícita:

``` text
MEF-V3-ID ↔ FND/ARQ/ENG
```

La finalidad será permitir trazabilidad bidireccional:

``` text
CONCEPTO → FUENTES
FUENTE → CONCEPTOS
```

Esta vinculación será la base del control normativo futuro del
framework.

------------------------------------------------------------------------

### 11.5 --- Validación transversal FND → ARQ → ENG

Comprobará coherencia terminológica y jerárquica entre las tres capas.

Se revisará:

``` text
FND ↔ ARQ
FND ↔ ENG
ARQ ↔ ENG
FND ↔ ARQ ↔ ENG
```

Las contradicciones deberán registrarse explícitamente y no resolverse
mediante frecuencia o similitud textual.

------------------------------------------------------------------------

### 11.6 --- Cierre de integración normativa

Consolidará los resultados de 11.1--11.5 y determinará si el corpus
puede declararse integrado con MEF-V3.

El cierre deberá producir un baseline normativo verificable y
reproducible.

------------------------------------------------------------------------

## 10. Política de modificaciones

FASE 11 inicia en modo de análisis y vinculación.

``` text
SOURCE_MUTATIONS_INITIAL = 0
DICTIONARY_MUTATIONS = 0
```

Si posteriormente se requiere modificar FND, ARQ o ENG para corregir una
no conformidad, la modificación deberá:

1.  estar respaldada por evidencia;
2.  indicar el ID MEF-V3 afectado;
3.  preservar la jerarquía FND → ARQ → ENG;
4.  quedar registrada en la auditoría de la subfase correspondiente;
5.  no modificar el significado canónico congelado de forma implícita.

------------------------------------------------------------------------

## 11. Compatibilidad Legacy

El mapeo Legacy construido en 10.6 permanece como evidencia histórica.

FASE 11 no utilizará Legacy como autoridad.

``` text
LEGACY_AS_AUTHORITY = NO
V2_AS_AUTHORITY = NO
LEGACY_AS_TRACEABILITY = YES
```

Las referencias Legacy encontradas dentro del corpus deberán registrarse
y, cuando corresponda, vincularse con MEF-V3.

------------------------------------------------------------------------

## 12. Criterios globales de cierre

FASE 11 sólo podrá cerrarse cuando:

``` text
203/203 CONCEPTOS EVALUADOS
134/134 FUENTES EVALUADAS

COVERAGE_MATRIX_COMPLETE = YES
NONCONFORMITIES_CLASSIFIED = YES
ALIASES_CONTROLLED = YES
NORMATIVE_LINKS_COMPLETE = YES
TRANSVERSAL_VALIDATION_COMPLETE = YES

UNRESOLVED_CRITICAL_CONFLICTS = 0
DICTIONARY_ID_COLLISIONS = 0
UNCONTROLLED_LEGACY_AUTHORITY = 0
```

Una ausencia de cobertura no constituye automáticamente un error.

Lo que sí debe existir es una clasificación explícita y trazable.

------------------------------------------------------------------------

## 13. Artefactos rectores esperados

FASE 11 deberá producir, como mínimo:

``` text
FASE_11_INTEGRACION_NORMATIVA_MEF-V3.md

11.1_MATRIZ_COBERTURA_MEF_V3.csv
11.2_NO_CONFORMIDADES_TERMINOLOGICAS.csv
11.3_ALIASES_CONTROLADOS_MEF_V3.csv
11.4_VINCULACION_NORMATIVA_MEF_V3_FUENTES.csv
11.5_VALIDACION_TRANSVERSAL_FND_ARQ_ENG.csv

FASE_11_6_CIERRE_INTEGRACION_NORMATIVA_MEF-V3.md
```

Los nombres específicos podrán complementarse con artefactos de
evidencia y control sin alterar esta estructura.

------------------------------------------------------------------------

## 14. Principio de no regresión

FASE 11 no deberá convertirse en una repetición de FASE 9 o FASE 10.

La regla operativa será:

``` text
DESCUBRIMIENTO TERMINOLOGICO → CERRADO EN FASE 10
CANONIZACION                → CERRADA EN FASE 10
ASIGNACION DE IDs           → CERRADA EN FASE 10

COBERTURA                    → FASE 11
CONFORMIDAD                  → FASE 11
VINCULACION                  → FASE 11
VALIDACION TRANSVERSAL       → FASE 11
```

Cualquier hallazgo que implique cambiar estructuralmente MEF-V3 deberá
registrarse para una fase futura de evolución y no incorporarse
silenciosamente al baseline actual.

------------------------------------------------------------------------

## 15. Estado inicial

``` text
FASE_11 = OPEN
FASE_11_1 = NOT_STARTED
FASE_11_2 = NOT_STARTED
FASE_11_3 = NOT_STARTED
FASE_11_4 = NOT_STARTED
FASE_11_5 = NOT_STARTED
FASE_11_6 = NOT_STARTED

BASELINE_GIT = 7ef1faa

MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203
SOURCE_CORPUS = 134

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

------------------------------------------------------------------------

## 16. Siguiente paso

El primer procedimiento operativo será:

**FASE 11.1 --- MATRIZ DE COBERTURA MEF-V3 ↔ FND ↔ ARQ ↔ ENG**

Su entrada será:

``` text
10.6_INDICE_MEF_V3.csv
+
134 FUENTES FND/ARQ/ENG
```

y su objetivo será determinar la cobertura documental real de los 203
conceptos canónicos sin modificar ninguna fuente.

------------------------------------------------------------------------

## 17. Declaración de apertura

Con este documento se declara formalmente abierta:

**FASE 11 --- INTEGRACIÓN NORMATIVA MEF-V3**

bajo el baseline Git `7ef1faa` y con MEF-V3 congelado como referencia
terminológica canónica de entrada.
