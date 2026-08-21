# FASE 10 — Reconstrucción limpia del Diccionario MEF-V3

**Estado inicial:** `OPEN`
**Origen:** cierre del bloque incremental V2 y suspensión de `9.4.3`
**Objetivo:** reconstruir el Diccionario MEF desde fuentes de autoridad, sin heredar automáticamente IDs, duplicados ni inconsistencias del diccionario histórico.

## 1. Decisión de reconstrucción

A partir de esta fase:

```text
DICCIONARIO_V2 = FROZEN / HISTORICAL
DICCIONARIO_LEGACY = READ_ONLY
FASE_9_4_3 = STOPPED_WITHOUT_ID_ASSIGNMENT

TARGET = DICCIONARIO_MEF_V3
NEW_MEF_DIC_IDS = 0
```

No se elimina físicamente el material anterior.

V2, los documentos `DIC-001*`, los IDs históricos `MEF-DIC-*`, las auditorías y los artefactos auxiliares permanecen como evidencia histórica y material de contraste.

## 2. Principio rector

```text
LOS IDs NO SON AUTORIDAD.

LA AUTORIDAD PROVIENE DEL CONCEPTO
Y DE SU TRAZABILIDAD DOCUMENTAL.

LOS IDs SE ASIGNAN AL FINAL.
```

La reconstrucción V3 no parte de la numeración histórica.

## 3. Fuentes primarias

La reconstrucción utilizará como corpus fuente:

```text
FND = FUNDACIÓN
ARQ = ARQUITECTURA
ENG = INGENIERÍA
```

Cadena de autoridad:

```text
FND
 ↓
ARQ
 ↓
ENG
```

El diccionario histórico podrá utilizarse posteriormente para comparación y compatibilidad, pero **no para determinar automáticamente qué conceptos deben existir en V3**.

## 4. Reglas de aislamiento

Durante la reconstrucción:

```text
LEGACY_IDS_AS_AUTHORITY = FORBIDDEN
V2_IDS_AS_AUTHORITY = FORBIDDEN
AUTO_CANONIZATION = FORBIDDEN
CANONIZATION_BY_FREQUENCY = FORBIDDEN
CANONIZATION_BY_SIMILARITY = FORBIDDEN
ID_REUSE_WITHOUT_VALIDATION = FORBIDDEN
```

No se modifica:

* FND;
* ARQ;
* ENG;
* Diccionario histórico;
* Diccionario V2.

## 5. Estructura propuesta

Crear:

```text
docs/
└── DICCIONARIO/
    └── V3/
        ├── README.md
        ├── FUENTES/
        ├── EXTRACCION/
        ├── CANDIDATOS/
        ├── NORMALIZACION/
        ├── CANONICO/
        ├── TRAZABILIDAD/
        ├── COMPATIBILIDAD/
        └── AUDITORIA/
```

## 6. Fases de reconstrucción

### FASE 10.1 — Inventario fuente limpio

Objetivo:

* identificar las fuentes FND, ARQ y ENG;
* comprobar integridad;
* registrar hashes;
* excluir del corpus de autoridad los diccionarios anteriores.

Salida:

```text
FUENTES_V3.csv
MANIFEST_FUENTES_V3.csv
```

---

### FASE 10.2 — Extracción terminológica completa

Extraer conceptos potenciales sin asignar IDs.

Cada candidato deberá conservar como mínimo:

```text
termino
variante
fuente
capa
ubicacion
contexto
tipo_evidencia
```

Salida:

```text
CANDIDATOS_BRUTOS_V3.csv
```

---

### FASE 10.3 — Normalización y deduplicación

Resolver:

* singular/plural;
* mayúsculas/minúsculas;
* español/inglés;
* acrónimos;
* aliases;
* variantes ortográficas;
* términos equivalentes;
* homónimos;
* duplicados conceptuales.

Salida:

```text
CANDIDATOS_NORMALIZADOS_V3.csv
ALIASES_V3.csv
DUPLICADOS_RESUELTOS_V3.csv
```

Todavía:

```text
MEF_DIC_IDS = 0
```

---

### FASE 10.4 — Resolución de autoridad

Para cada concepto normalizado determinar:

```text
AUTORIDAD_FND
AUTORIDAD_ARQ
EVIDENCIA_ENG
SIN_AUTORIDAD
CONFLICTO
```

La frecuencia documental podrá utilizarse como evidencia auxiliar, nunca como autoridad.

Salida:

```text
MATRIZ_AUTORIDAD_V3.csv
```

---

### FASE 10.5 — Construcción del catálogo canónico

Clasificar cada candidato como:

```text
CANONICO
ALIAS
DIFERIDO
RECHAZADO
CONFLICTO
```

Cada entrada `CANONICO` deberá tener:

```text
nombre canonico
definicion
alcance
aliases
autoridad
evidencia
relaciones
notas
estado
```

Todavía no se asignarán IDs definitivos.

Salida:

```text
CATALOGO_CANONICO_V3_PRE_ID.csv
```

---

### FASE 10.6 — Asignación final de IDs y cierre

Sólo después de congelar el catálogo conceptual se asignará una nueva secuencia estable.

La numeración deberá cumplir:

```text
1 concepto canonico = 1 ID
1 ID = 1 concepto canonico
aliases = 0 IDs independientes
duplicados = 0 IDs
IDs reutilizados accidentalmente = 0
```

Después se generará una tabla de compatibilidad:

```text
ID_LEGACY
TERMINO_LEGACY
ID_V3
TERMINO_V3
RELACION
```

Relaciones permitidas:

```text
EQUIVALENTE
RENOMBRADO
FUSIONADO
DIVIDIDO
DEPRECADO
SIN_EQUIVALENTE
```

Salida:

```text
DICCIONARIO_MEF_V3.md
INDICE_MEF_V3.csv
MAPEO_LEGACY_A_V3.csv
MANIFEST_CIERRE_V3.csv
```

## 7. Regla sobre los antiguos MEF-DIC

El rango histórico observado:

```text
MEF-DIC-0001 → MEF-DIC-0070
```

queda reservado únicamente como **identidad histórica** hasta completar el mapeo.

No se supondrá que:

```text
NEXT_ID = MEF-DIC-0071
```

ni tampoco se reutilizarán automáticamente los números existentes.

La política de numeración V3 se decidirá únicamente cuando el catálogo conceptual esté cerrado.

## 8. Condiciones de cierre

FASE 10 sólo podrá cerrarse cuando se cumpla:

```text
FUENTES_INVENTARIADAS = 100%
CANDIDATOS_EXTRAIDOS = 100%
CANDIDATOS_NORMALIZADOS = 100%
DUPLICADOS_RESUELTOS = 100%
AUTORIDAD_RESUELTA = 100%
CONFLICTOS_VISIBLES = 100%
CATALOGO_CANONICO_CONGELADO = YES
IDS_UNICOS = YES
ALIASES_CON_ID_PROPIO = 0
MAPEO_LEGACY_COMPLETO = YES
```

## 9. Estado inicial formal

```text
FASE_10 = OPEN

DICCIONARIO_MEF_V3 = INITIALIZED

LEGACY = FROZEN
V2 = FROZEN

FND = FROZEN
ARQ = FROZEN
ENG = FROZEN

CANONICAL_TERMS_V3 = 0
MEF_DIC_IDS_V3 = 0

NEXT_PHASE = FASE_10_1_INVENTARIO_FUENTE_LIMPIO
```

## 10. Punto de partida

La reconstrucción comienza desde las fuentes y **no desde los 70 IDs históricos ni desde los candidatos acumulados de V2**.

Los artefactos anteriores se preservan para auditoría, comparación y posterior mapeo de compatibilidad.

**FASE 10 queda formalmente abierta.**
