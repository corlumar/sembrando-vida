# FASE 12.2 --- Modelo de Solicitud de Cambio

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Precondición:** `FASE_12_1 = CLOSED / PASS`\
**MEF-V3:** `FROZEN`\
**Baseline:** `203 conceptos canónicos`

## 1. Objetivo

Definir el registro formal y obligatorio mediante el cual deberá
proponerse, evaluar, aprobar, aplicar, validar y cerrar cualquier
evolución futura del Diccionario MEF-V3.

A partir de esta subfase, ninguna modificación canónica debe existir sin
un `CHANGE_ID`.

## 2. Principio rector

``` text
NO CHANGE_ID → NO CHANGE
```

Una solicitud de cambio es un expediente de gobernanza. No es un ID del
diccionario y no sustituye al `MEF-V3-ID`.

## 3. Identificador de cambio

Formato normativo:

``` text
MEF-CHG-YYYY-NNNN
```

Ejemplo:

``` text
MEF-CHG-2026-0001
```

Reglas:

-   único;
-   secuencial dentro del año;
-   no reutilizable;
-   persistente aunque la solicitud sea rechazada o diferida;
-   independiente de los IDs MEF-V3.

## 4. Campos obligatorios

El registro de cambio deberá contener, como mínimo:

``` text
CHANGE_ID
FECHA_SOLICITUD
TIPO_CAMBIO
ESTADO
MEF_V3_ID_AFECTADO
CANDIDATO
TITULO
PROPUESTA
JUSTIFICACION
EVIDENCIA_FND
EVIDENCIA_ARQ
EVIDENCIA_ENG
AUTORIDAD_PROPUESTA
IMPACTO_IDENTIDAD
IMPACTO_TRAZABILIDAD
IMPACTO_ALIASES
IMPACTO_FUENTES
REQUIERE_NUEVO_ID
PROPONENTE
VALIDADOR
AUTORIDAD_DECISION
DECISION
JUSTIFICACION_DECISION
VERSION_OBJETIVO
COMMIT_APLICACION
FECHA_CIERRE
OBSERVACIONES
```

## 5. Tipos de cambio permitidos

``` text
NUEVO_CONCEPTO
NUEVO_ID
CAMBIO_NOMBRE_CANONICO
CAMBIO_DEFINICION
NUEVO_ALIAS
ELIMINACION_ALIAS
CAMBIO_AUTORIDAD
CAMBIO_TRAZABILIDAD
CORRECCION_METADATA
DEPRECACION
REEMPLAZO
FUSION
DIVISION
```

El tipo debe elegirse explícitamente. No se permiten categorías
genéricas como `OTRO` para evadir las reglas de gobernanza.

## 6. Estados

Flujo base:

``` text
PROPUESTO
   ↓
EN_VALIDACION
   ↓
EVALUADO
   ↓
APROBADO ──────┐
RECHAZADO      │
DIFERIDO       │
               ↓
            APLICADO
               ↓
            VALIDADO
               ↓
             CERRADO
```

### PROPUESTO

La solicitud existe, pero aún no ha sido validada.

### EN_VALIDACION

Se verifica completitud, evidencia, duplicidad, autoridad e impacto.

### EVALUADO

El expediente está listo para decisión.

### APROBADO

La autoridad autorizó el cambio, pero éste aún no necesariamente ha sido
aplicado.

### RECHAZADO

La propuesta no procede. El `CHANGE_ID` permanece reservado.

### DIFERIDO

No existe evidencia suficiente o se requiere una decisión posterior. El
expediente permanece abierto administrativamente, sin modificar MEF-V3.

### APLICADO

El cambio aprobado fue ejecutado.

### VALIDADO

Los controles posteriores a la aplicación resultaron satisfactorios.

### CERRADO

El expediente terminó y su evidencia, decisión, versión y commit
quedaron registrados.

## 7. Decisiones permitidas

``` text
APROBAR
RECHAZAR
DIFERIR
```

Una decisión debe incluir justificación.

No existe decisión implícita.

## 8. Reglas por identidad

### Solicitud sobre concepto existente

Debe indicar:

``` text
MEF_V3_ID_AFECTADO = MEF-V3-...
```

y evaluar si cambia identidad, definición, nombre, autoridad, alias o
trazabilidad.

### Solicitud sobre candidato nuevo

Debe usar:

``` text
MEF_V3_ID_AFECTADO = VACIO
CANDIDATO = <termino>
REQUIERE_NUEVO_ID = POR_DETERMINAR
```

El ID no debe preasignarse antes de la aprobación.

## 9. Evidencia

Los campos FND, ARQ y ENG deben contener referencias trazables o indicar
explícitamente:

``` text
NO_APLICA
NO_EXISTE
PENDIENTE
```

No deben quedar ambiguamente vacíos cuando la solicitud llegue a
`EVALUADO`.

La ausencia de una capa no invalida automáticamente la solicitud; la
suficiencia depende del tipo de cambio y de la política de autoridad de
12.1.

## 10. Impacto obligatorio

Toda solicitud debe evaluar cuatro dimensiones:

``` text
IMPACTO_IDENTIDAD
IMPACTO_TRAZABILIDAD
IMPACTO_ALIASES
IMPACTO_FUENTES
```

Valores mínimos recomendados:

``` text
NINGUNO
BAJO
MEDIO
ALTO
```

Para `IMPACTO_IDENTIDAD = ALTO`, la solicitud no debe aplicarse sin
validación específica de duplicidad, aliases, IDs y relaciones
históricas.

## 11. Nuevo ID

`REQUIERE_NUEVO_ID` admite:

``` text
NO
SI
POR_DETERMINAR
```

Un `SI` no constituye autorización para asignarlo. La asignación sólo
procede después de la resolución de identidad y aprobación.

## 12. Separación de responsabilidades

Los campos:

``` text
PROPONENTE
VALIDADOR
AUTORIDAD_DECISION
```

deben quedar explícitamente registrados.

La plantilla no presupone nombres personales concretos; éstos dependerán
de la implementación organizacional de la gobernanza.

## 13. Registro de aplicación

Un cambio aprobado y aplicado deberá incorporar:

``` text
VERSION_OBJETIVO
COMMIT_APLICACION
```

La ausencia del commit impide declarar el expediente `CERRADO` cuando el
cambio afecte artefactos versionados.

## 14. Invariantes

``` text
CHANGE_ID_UNIQUE = REQUIRED
CHANGE_ID_REUSE = FORBIDDEN
MEF_V3_ID_REUSE = FORBIDDEN
DECISION_WITHOUT_JUSTIFICATION = FORBIDDEN
APPLY_WITHOUT_APPROVAL = FORBIDDEN
CLOSE_WITHOUT_VALIDATION = FORBIDDEN
SILENT_CHANGE = FORBIDDEN
```

## 15. Regla de transición

Transiciones permitidas:

``` text
PROPUESTO → EN_VALIDACION
EN_VALIDACION → EVALUADO
EVALUADO → APROBADO
EVALUADO → RECHAZADO
EVALUADO → DIFERIDO
DIFERIDO → EN_VALIDACION
APROBADO → APLICADO
APLICADO → VALIDADO
VALIDADO → CERRADO
RECHAZADO → CERRADO
```

Cualquier transición distinta requiere una corrección administrativa
explícitamente registrada; no debe utilizarse para saltar controles.

## 16. Plantilla canónica

El archivo:

``` text
12.2_PLANTILLA_SOLICITUD_DE_CAMBIO.csv
```

define el esquema estructurado mínimo para registrar solicitudes.

La plantilla se entrega sin solicitudes reales. Su existencia no
modifica el baseline MEF-V3.

## 17. Controles de cierre

``` text
CHANGE_ID_MODEL = DEFINED
CHANGE_TYPES = DEFINED
CHANGE_STATES = DEFINED
DECISION_MODEL = DEFINED
EVIDENCE_FIELDS = DEFINED
IMPACT_MODEL = DEFINED
ROLE_FIELDS = DEFINED
VERSION_COMMIT_TRACEABILITY = DEFINED

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

## 18. Veredicto

**`PASS`**

El modelo formal de solicitud de cambio queda definido y preparado para
gobernar cualquier evolución posterior de MEF-V3.

## 19. Estado de salida

``` text
FASE_12_2 = CLOSED / PASS

CHANGE_REQUEST_MODEL = DEFINED
CHANGE_ID_FORMAT = MEF-CHG-YYYY-NNNN
CHANGE_CONTROL_RECORD = REQUIRED

MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0

NEXT_PHASE = FASE_12_3_REGLAS_DE_ALTA_MODIFICACION_Y_DEPRECACION
```
