# FASE 12.1 --- Política de Gobernanza y Autoridad

**Estado:** `CLOSED`\
**Resultado:** `PASS`\
**Precondición:** `FASE_12 = OPEN`\
**Baseline:** `MEF-V3 / 203 conceptos canónicos`\
**MEF-V3:** `FROZEN`

## 1. Objetivo

Formalizar la política de autoridad y gobernanza aplicable a cualquier
cambio futuro del Diccionario MEF-V3, estableciendo qué evidencia puede
originar una propuesta, qué capa posee autoridad normativa, qué
decisiones requieren control formal y qué operaciones están prohibidas.

FASE 12.1 no modifica el catálogo. Define el régimen bajo el cual podrá
evolucionar.

## 2. Principio de autoridad

Se conserva la jerarquía normativa consolidada en FASE 11:

``` text
FND
 ↓
ARQ
 ↓
ENG
```

La jerarquía determina autoridad, no frecuencia de aparición.

Una forma terminológica repetida muchas veces en ENG no adquiere por
repetición autoridad superior a una definición FND o ARQ vigente.

## 3. Función de cada capa

### 3.1 FND --- Autoridad normativa superior

FND puede aportar:

-   definición normativa;
-   propósito funcional;
-   alcance del concepto;
-   reglas o restricciones de dominio;
-   criterios que condicionan ARQ y ENG.

Cuando existe evidencia FND suficiente y vigente, ésta constituye la
referencia primaria para resolver incompatibilidades conceptuales.

### 3.2 ARQ --- Autoridad arquitectónica

ARQ define la representación arquitectónica y estructural del concepto
dentro del sistema.

Puede precisar:

-   componentes;
-   responsabilidades;
-   límites arquitectónicos;
-   relaciones;
-   dependencias;
-   patrones de interacción.

ARQ no debe contradecir una regla FND superior.

### 3.3 ENG --- Evidencia técnica

ENG aporta evidencia de implementación, ingeniería y uso técnico.

Puede demostrar:

-   existencia técnica;
-   nomenclatura utilizada;
-   interfaces;
-   componentes implementados;
-   dependencias técnicas;
-   comportamiento observable.

ENG por sí solo no canoniza automáticamente un concepto nuevo cuando no
existe autoridad suficiente.

## 4. Autoridad del catálogo MEF-V3

MEF-V3 es el registro canónico de identidades terminológicas aprobadas.

No constituye una cuarta fuente documental superior a FND, ARQ o ENG.

Su autoridad consiste en registrar formalmente:

``` text
IDENTIDAD_CANONICA
ID
NOMBRE_CANONICO
ALIASES_CONTROLADOS
AUTORIDAD_RESUELTA
TRAZABILIDAD
ESTADO
```

Una entrada MEF-V3 sólo puede cambiar mediante el procedimiento de
gobernanza de FASE 12.

## 5. Principio de separación de funciones

La gobernanza distingue cuatro funciones lógicas:

``` text
PROPONENTE
VALIDADOR
AUTORIDAD_DE_DECISION
EJECUTOR_DEL_CAMBIO
```

Estas funciones pueden ser desempeñadas por personas o procesos
autorizados, pero deben permanecer conceptualmente separadas en el
registro de cambio.

### Proponente

Presenta la solicitud y evidencia.

No obtiene por ello autoridad para aprobarla.

### Validador

Comprueba:

-   completitud;
-   evidencia;
-   impacto;
-   duplicidad;
-   trazabilidad;
-   integridad de IDs;
-   compatibilidad con el baseline.

### Autoridad de decisión

Aprueba, rechaza o difiere la solicitud con base en evidencia y
jerarquía normativa.

### Ejecutor

Aplica exclusivamente una decisión previamente aprobada y deja evidencia
del cambio, validación y commit.

## 6. Matriz de autoridad

  -------------------------------------------------------------------------------
  Materia          FND             ARQ              ENG            MEF-V3
  ---------------- --------------- ---------------- -------------- --------------
  Definición       Primaria        Complementaria   Evidencia      Registra
  funcional                                                        

  Arquitectura     Condicionante   Primaria         Evidencia      Registra

  Implementación   Condicionante   Condicionante    Primaria       Registra
  técnica                                           técnica        

  Identidad        Evidencia       Evidencia        Evidencia      Registro
  canónica         superior                                        canónico
                                                                   aprobado

  Nuevo alias      Evidencia       Evidencia        Evidencia      Controla tras
                                                                   aprobación

  Nuevo ID         Justificación   Justificación    Evidencia      Asigna sólo
                                                                   tras
                                                                   aprobación

  Deprecación      Puede           Puede justificar Puede          Registra tras
                   justificar                       evidenciar     aprobación
  -------------------------------------------------------------------------------

## 7. Reglas de resolución de autoridad

### R12.1-01 --- Prevalencia normativa

Ante contradicción material:

``` text
FND > ARQ > ENG
```

salvo que exista una solicitud formal aprobada que actualice la
autoridad aplicable.

### R12.1-02 --- Evidencia no equivale a canonización

La aparición documental no crea por sí sola una identidad MEF-V3.

### R12.1-03 --- ENG-only

Un término exclusivamente ENG debe permanecer diferido mientras no
exista resolución formal suficiente para promoverlo.

### R12.1-04 --- Alias

Una variante no genera ID nuevo mientras pueda resolverse de manera no
ambigua como alias de una identidad existente.

### R12.1-05 --- Ambigüedad

Una forma asociable a más de un concepto no puede incorporarse como
alias controlado sin resolución explícita.

### R12.1-06 --- Cambio de autoridad

Modificar la autoridad declarada de un concepto requiere solicitud de
cambio y análisis de impacto.

### R12.1-07 --- Conflicto documental

Un conflicto entre capas no debe resolverse editando silenciosamente las
fuentes ni el catálogo.

Debe registrarse y resolverse mediante gobernanza.

## 8. Operaciones sujetas a aprobación

Requieren control formal:

``` text
NUEVO_CONCEPTO
NUEVO_ID
CAMBIO_NOMBRE_CANONICO
CAMBIO_DEFINICION
NUEVO_ALIAS
ELIMINACION_ALIAS
CAMBIO_AUTORIDAD
CAMBIO_TRAZABILIDAD
DEPRECACION
REEMPLAZO
FUSION
DIVISION
```

Las correcciones puramente editoriales también deben ser trazables
cuando afecten un artefacto canónico.

## 9. Operaciones prohibidas

``` text
ID_REUSE = FORBIDDEN
SILENT_CHANGE = FORBIDDEN
SILENT_CANONIZATION = FORBIDDEN
UNCONTROLLED_CHANGE = FORBIDDEN
RETROACTIVE_REWRITE_OF_CLOSED_PHASES = FORBIDDEN
DIRECT_ENG_ONLY_PROMOTION = FORBIDDEN
```

No se permite modificar FASE 10 o FASE 11 para aparentar que una
decisión futura siempre formó parte del baseline.

## 10. Evidencia mínima para una decisión

Toda decisión debe poder responder:

1.  ¿Qué se propone cambiar?
2.  ¿Qué identidad o artefacto afecta?
3.  ¿Qué evidencia FND existe?
4.  ¿Qué evidencia ARQ existe?
5.  ¿Qué evidencia ENG existe?
6.  ¿Existe ya un concepto equivalente?
7.  ¿Hay aliases o denominaciones históricas relacionadas?
8.  ¿Qué impacto tendrá en trazabilidad?
9.  ¿Requiere ID nuevo?
10. ¿Quién tomó la decisión y cuál fue el resultado?

La ausencia de evidencia en una capa no implica automáticamente rechazo;
debe evaluarse según el tipo de cambio y la autoridad requerida.

## 11. Criterios para nuevo ID

Un nuevo ID sólo puede autorizarse cuando se demuestre que:

``` text
NO_ES_ALIAS
NO_ES_VARIANTE
NO_ES_DUPLICADO
NO_ES_RENOMBRE
NO_ES_CONCEPTO_EXISTENTE
IDENTIDAD_NUEVA = DEMOSTRADA
AUTORIDAD = SUFICIENTE
CHANGE_REQUEST = APPROVED
```

El siguiente ID disponible no se asigna hasta que la solicitud haya sido
aprobada.

## 12. Deprecación y continuidad histórica

Deprecar no significa borrar.

Una identidad deprecada debe conservar:

``` text
MEF_V3_ID
NOMBRE_HISTORICO
ESTADO = DEPRECATED
MOTIVO
CHANGE_ID
FECHA
REEMPLAZO, SI EXISTE
TRAZABILIDAD
```

Su ID permanece reservado permanentemente.

## 13. Registro de decisiones

Cada decisión futura deberá vincular como mínimo:

``` text
CHANGE_ID
MEF_V3_ID / CANDIDATO
TIPO_CAMBIO
AUTORIDAD_APLICADA
EVIDENCIA
DECISION
JUSTIFICACION
ESTADO
VERSION_OBJETIVO
COMMIT
```

La estructura completa se formalizará en FASE 12.2.

## 14. Control del baseline

El baseline actual permanece:

``` text
MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203
```

FASE 12.1 no autoriza cambios sobre esos 203 conceptos. Sólo establece
las reglas para evaluar futuras solicitudes.

## 15. Controles de cierre

``` text
AUTHORITY_HIERARCHY_DEFINED = PASS
GOVERNANCE_ROLES_DEFINED = PASS
CHANGE_APPROVAL_REQUIRED = PASS
NEW_ID_POLICY_DEFINED = PASS
DEPRECATION_POLICY_DEFINED = PASS
ENG_ONLY_PROMOTION_CONTROLLED = PASS
ID_REUSE_FORBIDDEN = PASS
SILENT_CHANGE_FORBIDDEN = PASS
CLOSED_PHASE_REWRITE_FORBIDDEN = PASS

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0
```

## 16. Veredicto

**`PASS`**

La política de gobernanza y autoridad queda formalmente definida sin
modificar el baseline canónico.

## 17. Estado de salida

``` text
FASE_12_1 = CLOSED / PASS
MEF-V3 = FROZEN
CANONICAL_CONCEPTS = 203

GOVERNANCE_POLICY = DEFINED
AUTHORITY_MODEL = DEFINED
CHANGE_APPROVAL = REQUIRED

DICTIONARY_MUTATIONS = 0
SOURCE_MUTATIONS = 0
NEW_MEF_V3_IDS = 0

NEXT_PHASE = FASE_12_2_MODELO_DE_SOLICITUD_DE_CAMBIO
```
