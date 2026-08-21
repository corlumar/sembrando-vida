# FASE 12 --- Gobernanza y Control de Cambios MEF-V3

**Estado:** `OPEN`\
**Precondición:** `FASE_11 = CLOSED / PASS`\
**MEF-V3:** `FROZEN`\
**Conceptos canónicos de baseline:** `203`

## 1. Propósito

FASE 12 establece el modelo permanente de gobernanza, evolución,
aprobación, validación y versionado del Diccionario MEF-V3.

Su objetivo no es reconstruir ni recanonizar el diccionario. Su función
es impedir cambios informales o silenciosos y proporcionar un
procedimiento reproducible para cualquier evolución posterior.

## 2. Baseline de entrada

``` text
FASE_10 = CLOSED / PASS
FASE_11 = CLOSED / PASS

MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203
INTEGRACION_NORMATIVA_MEF_V3 = COMPLETE

FND → ARQ → ENG
CRITICAL_CONFLICTS = 0
```

FASE 12 toma este estado como baseline normativo. Las decisiones
cerradas en FASE 10 y FASE 11 no se reinterpretan retroactivamente.

## 3. Principios de gobernanza

### 3.1 Inmutabilidad histórica

Los artefactos cerrados de FASE 10 y FASE 11 constituyen evidencia
histórica y no deben reescribirse para reflejar decisiones futuras.

### 3.2 Identidad persistente

Un identificador MEF-V3 asignado no puede reutilizarse para representar
otro concepto.

``` text
ID_REUSE = FORBIDDEN
```

La deprecación de un concepto no libera su ID.

### 3.3 Cambios explícitos

Toda modificación futura debe originarse en una solicitud de cambio
identificable y trazable.

``` text
SILENT_CHANGE = FORBIDDEN
SILENT_CANONIZATION = FORBIDDEN
```

### 3.4 Autoridad normativa

Se conserva la jerarquía:

``` text
FND → ARQ → ENG
```

-   FND aporta la autoridad normativa superior.
-   ARQ aporta autoridad arquitectónica subordinada a FND.
-   ENG aporta evidencia y especificación técnica subordinada a FND y
    ARQ.
-   MEF-V3 representa el catálogo canónico resultante, no una fuente
    independiente de autoridad documental.

### 3.5 Evidencia antes de modificación

Ninguna alta, modificación, deprecación, fusión, división o cambio de
alias debe aplicarse sin evidencia suficiente y una decisión registrada.

## 4. Alcance

FASE 12 gobierna al menos las siguientes operaciones:

``` text
NUEVO_CONCEPTO
CAMBIO_DEFINICION
NUEVO_ALIAS
ELIMINACION_ALIAS
CAMBIO_NOMBRE_CANONICO
DEPRECACION
REEMPLAZO
FUSION
DIVISION
CAMBIO_AUTORIDAD
CAMBIO_TRAZABILIDAD
CORRECCION_METADATA
```

No todas las operaciones implican una nueva identidad. La resolución de
identidad debe formar parte del análisis de cada solicitud.

## 5. Modelo de cambio

Toda propuesta deberá poseer un identificador de cambio independiente de
los IDs del diccionario.

Estructura mínima:

``` text
CHANGE_ID
FECHA
TIPO_CAMBIO
MEF_V3_ID
ESTADO
PROPUESTA
JUSTIFICACION
EVIDENCIA_FND
EVIDENCIA_ARQ
EVIDENCIA_ENG
IMPACTO
DECISION
APROBACION
VERSION_OBJETIVO
COMMIT
```

Un `CHANGE_ID` registra una decisión de evolución; nunca sustituye al
`MEF-V3-ID`.

## 6. Estados de una solicitud

El ciclo mínimo será:

``` text
PROPUESTO
   ↓
EN_VALIDACION
   ↓
EVALUADO
   ↓
APROBADO / RECHAZADO / DIFERIDO
   ↓
APLICADO
   ↓
VALIDADO
   ↓
CERRADO
```

Una solicitud rechazada o diferida permanece registrada para preservar
trazabilidad.

## 7. Reglas de identidad

### 7.1 Nuevo concepto

Sólo procede cuando la evidencia demuestra una identidad conceptual no
representada por los 203 conceptos existentes.

### 7.2 Alias

Una variante terminológica no genera automáticamente un nuevo ID.

Debe comprobarse primero si corresponde a:

``` text
ALIAS
DENOMINACION_HISTORICA
VARIANTE_ORTOGRAFICA
SINONIMO_CONTROLADO
TERMINO_AMBIGUO
CONCEPTO_NUEVO
```

### 7.3 Deprecación

La deprecación conserva:

-   ID original;
-   nombre histórico;
-   motivo;
-   fecha;
-   reemplazo, cuando exista;
-   solicitud de cambio;
-   trazabilidad documental.

### 7.4 Fusión

Una fusión no autoriza a reutilizar IDs. Los IDs anteriores permanecen
registrados y deben apuntar al resultado de la decisión.

### 7.5 División

Una división conceptual puede requerir nuevas identidades, pero el ID
histórico original debe conservar su trazabilidad y estado.

## 8. Control de versiones

Todo cambio aprobado que altere el estado canónico debe producir un
nuevo baseline versionado.

No se modifica retroactivamente un baseline cerrado.

Ejemplo conceptual:

``` text
MEF-V3 baseline
      ↓
CHANGE REQUESTS
      ↓
VALIDACION
      ↓
APROBACION
      ↓
NUEVO BASELINE VERSIONADO
```

La estrategia exacta de numeración/versionado se formalizará en 12.5.

## 9. Validaciones obligatorias

Antes del cierre de cualquier cambio deberán comprobarse, como mínimo:

``` text
IDs_UNICOS
NOMBRES_CANONICOS_CONTROLADOS
ALIASES_NO_AMBIGUOS
AUTORIDAD_DEFINIDA
FUENTES_EXISTENTES
REFERENCIAS_VALIDAS
TRAZABILIDAD_BIDIRECCIONAL
LEGACY_IDS_NO_REINTRODUCIDOS
ENG_ONLY_NO_PROMOVIDO_SIN_AUTORIZACION
ID_REUSE = 0
UNCONTROLLED_CHANGES = 0
```

Los controles deberán evolucionar hacia ejecución automática y
reproducible.

## 10. Prohibiciones

Queda prohibido:

1.  editar silenciosamente una identidad canónica;
2.  reutilizar un ID deprecado;
3.  introducir conceptos directamente desde ENG sin resolución de
    autoridad;
4.  eliminar evidencia histórica para simplificar el catálogo;
5.  modificar FASE 10 o FASE 11 para hacer coincidir decisiones
    posteriores;
6.  asignar nuevos IDs fuera del procedimiento de gobernanza;
7.  realizar canonización implícita durante tareas de mantenimiento.

## 11. Subfases

FASE 12 se divide en:

``` text
12.1  POLITICA_DE_GOBERNANZA_Y_AUTORIDAD
12.2  MODELO_DE_SOLICITUD_DE_CAMBIO
12.3  REGLAS_DE_ALTA_MODIFICACION_Y_DEPRECACION
12.4  VALIDACIONES_AUTOMATICAS_DE_INTEGRIDAD
12.5  WORKFLOW_DE_APROBACION_Y_VERSIONADO
12.6  CIERRE_Y_BASELINE_DE_GOBERNANZA
```

### 12.1 --- Política de gobernanza y autoridad

Formaliza roles lógicos, autoridad, criterios de evidencia y
responsabilidades de decisión.

### 12.2 --- Modelo de solicitud de cambio

Define el registro canónico de solicitudes y sus campos obligatorios.

### 12.3 --- Reglas de alta, modificación y deprecación

Establece las reglas específicas para cada clase de evolución.

### 12.4 --- Validaciones automáticas de integridad

Convierte controles críticos en validaciones reproducibles.

### 12.5 --- Workflow de aprobación y versionado

Define transición de estados, aprobación, aplicación, commit y creación
de nuevos baselines.

### 12.6 --- Cierre y baseline de gobernanza

Consolida los controles y declara activo el régimen permanente de
gobernanza.

## 12. Artefactos esperados

FASE 12 deberá producir, como mínimo:

``` text
FASE_12_GOBERNANZA_Y_CONTROL_DE_CAMBIOS_MEF-V3.md

FASE_12.1_...
FASE_12.2_...
FASE_12.3_...
FASE_12.4_...
FASE_12.5_...
FASE_12.6_...
```

Las subfases podrán incorporar CSV, scripts y manifiestos cuando el
control requiera información estructurada o ejecución automática.

## 13. Criterios de cierre

FASE 12 podrá cerrarse únicamente cuando exista:

``` text
GOVERNANCE_POLICY = DEFINED
CHANGE_REQUEST_MODEL = DEFINED
EVOLUTION_RULES = DEFINED
AUTOMATED_VALIDATION = ACTIVE
APPROVAL_WORKFLOW = DEFINED
VERSIONING_POLICY = DEFINED

ID_REUSE = FORBIDDEN
SILENT_CHANGE = FORBIDDEN
UNCONTROLLED_CHANGES = FORBIDDEN
```

## 14. Estado objetivo

El cierre exitoso deberá permitir declarar:

``` text
FASE_12 = CLOSED / PASS

MEF-V3 = GOVERNED
CHANGE_CONTROL = ACTIVE
AUTOMATED_VALIDATION = ACTIVE

CANONICAL_BASELINE = PROTECTED
ID_REUSE = FORBIDDEN
SILENT_CANONIZATION = FORBIDDEN
UNCONTROLLED_CHANGES = FORBIDDEN
```

## 15. Estado inicial de ejecución

``` text
FASE_12 = OPEN
MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0

NEXT_PHASE = FASE_12_1_POLITICA_DE_GOBERNANZA_Y_AUTORIDAD
```
