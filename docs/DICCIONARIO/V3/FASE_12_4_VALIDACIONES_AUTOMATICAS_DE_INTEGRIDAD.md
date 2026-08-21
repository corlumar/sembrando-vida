# FASE 12.4 --- Validaciones Automáticas de Integridad

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Precondición:** `FASE_12_3 = CLOSED / PASS`\
**MEF-V3:** `FROZEN`\
**Baseline:** `203 conceptos canónicos`

## 1. Objetivo

Convertir las reglas críticas de gobernanza definidas en 12.1--12.3 en
controles reproducibles que puedan ejecutarse antes de aceptar, aplicar
o cerrar cambios futuros de MEF-V3.

FASE 12.4 no modifica el diccionario: crea la capa de prevención.

## 2. Principio

``` text
VALIDATION BEFORE CHANGE
VALIDATION AFTER CHANGE
FAIL → BLOCK
```

Un cambio que viole una invariante crítica no debe llegar al nuevo
baseline.

## 3. Dominios de validación

Se establecen controles sobre:

``` text
CATALOGO
ALIASES
AUTORIDAD
TRAZABILIDAD
GOBERNANZA
HISTORICO
VERSIONADO
```

## 4. Controles mínimos

El catálogo de 12.4 contiene 20 validaciones normativas, incluyendo:

-   unicidad y no reutilización de IDs;
-   nombres canónicos presentes y no duplicados;
-   aliases no ambiguos;
-   autoridad definida;
-   jerarquía FND → ARQ → ENG;
-   referencias de fuente válidas;
-   trazabilidad bidireccional;
-   bloqueo de promoción ENG-only sin CHANGE_ID aprobado;
-   CHANGE_ID obligatorio y único;
-   aplicación sólo de cambios aprobados;
-   cierre sólo después de validación;
-   conservación de IDs deprecados;
-   prohibición de reescritura retroactiva de fases cerradas;
-   commit trazable para cambios aplicados.

## 5. Severidad

``` text
ERROR → BLOCKED
OBSERVATION → NON_BLOCKING
```

Las invariantes de identidad, autoridad, aprobación e historia se
clasifican como `ERROR`.

## 6. Validador automatizado

Se crea:

``` text
validate_mef_v3_governance.py
```

El validador recibe archivos explícitos para evitar depender de nombres
internos rígidos:

``` text
python validate_mef_v3_governance.py --catalog <catalogo.csv>
python validate_mef_v3_governance.py --catalog <catalogo.csv> --aliases <aliases.csv> --changes <cambios.csv>
```

Genera:

``` text
MEF_V3_VALIDATION_REPORT.csv
```

y códigos de salida:

``` text
0 = PASS
1 = BLOCKED
2 = ERROR_DE_CONFIGURACION_O_ENTRADA
```

## 7. Diseño conservador

El script no intenta corregir automáticamente el diccionario.

``` text
AUTO_FIX = FORBIDDEN
```

Su función es detectar y bloquear. La resolución debe realizarse
mediante `CHANGE_ID`.

## 8. Validación pre-change

Antes de aplicar un cambio:

1.  validar baseline;
2.  validar expediente CHANGE_ID;
3.  comprobar duplicidad/identidad;
4.  comprobar autoridad;
5.  comprobar aliases;
6.  comprobar trazabilidad;
7.  bloquear si existe `ERROR`.

## 9. Validación post-change

Después de aplicar un cambio aprobado:

1.  ejecutar nuevamente controles;
2.  verificar que no aparezcan IDs duplicados;
3.  verificar continuidad histórica;
4.  comprobar trazabilidad;
5.  registrar reporte;
6.  asociar commit;
7.  sólo entonces permitir `VALIDADO → CERRADO`.

## 10. Integración futura

En 12.5 estos controles se integrarán al workflow de aprobación y
versionado.

El objetivo es que el ciclo futuro sea:

``` text
CHANGE REQUEST
     ↓
PRE-VALIDATION
     ↓
APPROVAL
     ↓
APPLICATION
     ↓
POST-VALIDATION
     ↓
COMMIT
     ↓
NEW BASELINE
```

## 11. Artefactos

1.  `FASE_12_4_VALIDACIONES_AUTOMATICAS_DE_INTEGRIDAD.md`
2.  `12.4_CATALOGO_VALIDACIONES_AUTOMATICAS.csv`
3.  `12.4_CONTROLES_VALIDACIONES_AUTOMATICAS.csv`
4.  `validate_mef_v3_governance.py`

## 12. Controles de cierre

``` text
VALIDATION_CATALOG = 20/20
AUTOMATED_VALIDATOR = CREATED

ID_UNIQUENESS_CONTROL = DEFINED
ID_REUSE_CONTROL = DEFINED
ALIAS_AMBIGUITY_CONTROL = DEFINED
AUTHORITY_CONTROL = DEFINED
TRACEABILITY_CONTROL = DEFINED
CHANGE_ID_CONTROL = DEFINED
APPROVAL_STATE_CONTROL = DEFINED
DEPRECATION_HISTORY_CONTROL = DEFINED
COMMIT_TRACEABILITY_CONTROL = DEFINED

AUTO_FIX = FORBIDDEN

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

## 13. Veredicto

**`PASS`**

La gobernanza MEF-V3 dispone ahora de un catálogo formal de validaciones
y un validador ejecutable para bloquear violaciones críticas antes de
incorporarlas a un baseline.

## 14. Estado de salida

``` text
FASE_12_4 = CLOSED / PASS

AUTOMATED_VALIDATION = ACTIVE
VALIDATION_RULES = 20
FAIL_POLICY = BLOCK
AUTO_FIX = FORBIDDEN

MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0

NEXT_PHASE = FASE_12_5_WORKFLOW_DE_APROBACION_Y_VERSIONADO
```
