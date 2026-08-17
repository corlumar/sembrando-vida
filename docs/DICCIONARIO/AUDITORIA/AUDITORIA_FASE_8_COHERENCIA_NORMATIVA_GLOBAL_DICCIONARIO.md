# AUDITORÍA FASE 8 — COHERENCIA NORMATIVA GLOBAL DEL DICCIONARIO

## 1. Identificación

- **Componente:** `docs/DICCIONARIO/`
- **Fase:** 8
- **Objeto:** coherencia normativa global y consolidación de hallazgos Fases 1–7
- **Fecha:** 2026-08-13
- **Corpus canónico:** `DIC-001A` → `DIC-001G`
- **Rango terminológico:** `MEF-DIC-0001` → `MEF-DIC-0070`
- **Documentos auxiliares:** `README.md`, `INDICE.md`, `DICCIONARIO_MEF.md`
- **Correcciones aplicadas:** ninguna
- **Propósito de esta fase:** establecer el baseline previo a correcciones controladas

---

## 2. Objetivo

Consolidar las Fases 1–7 para responder cinco preguntas:

1. ¿El Diccionario posee una autoridad canónica identificable?
2. ¿Qué hallazgos bloquean una certificación global?
3. ¿Qué correcciones son deterministas y cuáles requieren decisión semántica?
4. ¿Qué orden debe seguir la normalización?
5. ¿Qué debe permanecer inmutable durante las correcciones?

Esta fase no reaudita desde cero cada término. Utiliza los hallazgos ya demostrados y comprueba si, considerados conjuntamente, forman un contrato normativo coherente.

---

## 3. Baseline consolidado

```text
Documentos temáticos canónicos        7
Entradas canónicas                    70
Primer ID                             MEF-DIC-0001
Último ID                             MEF-DIC-0070
Huecos de ID                          0
IDs canónicos duplicados              0
Nombres exactos duplicados            0
Definiciones literalmente iguales     0
Colisiones semánticas totales         0

Definición                            70/70
Propósito                             69/70
Categoría                             32/70
Documento de origen                   63/70
Estado                                70/70
Historial                              1/70

Documento paralelo conflictivo        1
Índice global                         incompleto
Plantilla uniforme                    no
Taxonomía normalizada aplicada        no
```

El núcleo terminológico es recuperable sin renumeración ni reconstrucción integral.

---

# PARTE A — AUTORIDAD Y JERARQUÍA

## 4. Jerarquía normativa consolidada

Se mantiene la jerarquía establecida en Fase 3:

```text
FND — Fundación
   ↓
ARQ — Arquitectura
   ↓
DIC — Diccionario
   ↓
ENG — Ingeniería
```

Interpretación:

- **FND** gobierna identidad, doctrina, lenguaje y principios.
- **ARQ** gobierna estructura, fronteras, contratos y comportamiento arquitectónico.
- **DIC** normaliza el significado oficial y no debe redefinir FND/ARQ.
- **ENG** materializa y operacionaliza las decisiones superiores.

El Diccionario es autoridad terminológica, pero no autoridad superior a Fundación o Arquitectura sobre identidad o diseño arquitectónico.

---

## 5. Autoridad interna del Diccionario

La autoridad terminológica canónica queda delimitada a:

```text
DIC-001A
DIC-001B
DIC-001C
DIC-001D
DIC-001E
DIC-001F
DIC-001G
```

Estos siete documentos contienen exactamente los 70 IDs canónicos continuos.

`README.md` cumple función normativa introductoria.

`INDICE.md` cumple función derivada de navegación y no debe convertirse en fuente de verdad independiente.

`DICCIONARIO_MEF.md` no puede continuar como autoridad concurrente porque reutiliza IDs canónicos con significados distintos.

---

## 6. Dictamen sobre `DICCIONARIO_MEF.md`

Fase 2 demostró una colisión:

```text
Corpus canónico:
MEF-DIC-0001 = Architecture
MEF-DIC-0002 = Layer

DICCIONARIO_MEF.md:
MEF-DIC-0001 = Module
MEF-DIC-0002 = Registry
```

### Decisión de Fase 8

`DICCIONARIO_MEF.md` debe clasificarse como **LEGACY NO CANÓNICO**.

No debe:

- participar en resolución de IDs;
- alimentar `INDICE.md`;
- utilizarse para validar definiciones;
- permanecer presentado como Diccionario Oficial concurrente.

### Tratamiento recomendado

Antes de eliminarlo físicamente:

1. comparar si contiene contenido histórico útil no migrado;
2. preservar, si corresponde, la evidencia histórica;
3. retirar su autoridad canónica;
4. moverlo posteriormente a una ubicación legacy/archivo o eliminarlo mediante una decisión explícita.

**No se autoriza borrado automático en Fase 8.**

---

# PARTE B — BLOQUEANTES GLOBALES

## 7. Clasificación de severidad

Se establece:

```text
P0 — BLOQUEANTE
Impide certificar identidad o unicidad de autoridad.

P1 — MAYOR
Impide declarar normalización estructural o trazabilidad completa.

P2 — MODERADO
No rompe autoridad, pero genera ambigüedad o deriva.

P3 — EDITORIAL
Puede corregirse después de estabilizar semántica y estructura.
```

---

## 8. Hallazgos P0 — Bloqueantes

### P0-01 — Identidad incorrecta de MEF

`MEF-DIC-0010` contiene:

```text
MEF (Modular ERP Framework)
```

La identidad vigente es:

```text
MEF — Modular Enterprise Framework
```

**Acción:** corrección obligatoria y determinista, preservando `MEF-DIC-0010`.

### P0-02 — Autoridad concurrente de `DICCIONARIO_MEF.md`

Reutiliza IDs canónicos para conceptos diferentes.

**Acción:** desautorizarlo como fuente canónica y resolver su destino legacy.

### P0-03 — Fronteras `Template / Stub`

Fase 4 clasificó la pareja como `SOLAPAMIENTO ALTO`.

**Acción:** reforzar definiciones y/o `No confundir con` sin fusionar IDs.

### P0-04 — Fronteras `Plugin / Extension`

Fase 4 clasificó la pareja como `SOLAPAMIENTO ALTO`.

**Acción:** definir explícitamente la frontera semántica sin fusionar IDs.

---

## 9. Hallazgos P1 — Mayores

```text
P1-01  Plantilla terminológica no uniforme.
P1-02  38 términos sin Categoría.
P1-03  7 términos sin Documento de origen.
P1-04  Event Store sin Propósito.
P1-05  Estados mezclan ciclo de vida, obligatoriedad,
       implementación y horizonte.
P1-06  Relaciones no normalizadas.
P1-07  INDICE.md incompleto.
P1-08  Política lingüística canónica no explícita.
P1-09  Autoridad primaria, relacionados e implementación
       no están formalmente separados.
P1-10  Metadatos documentales de los archivos DIC
       no están normalizados.
```

Los siete términos sin `Documento de origen` son:

```text
MEF-DIC-0063 — Plugin
MEF-DIC-0064 — Extension
MEF-DIC-0066 — ADR
MEF-DIC-0067 — RFC
MEF-DIC-0068 — Testing
MEF-DIC-0069 — Semantic Versioning
MEF-DIC-0070 — Deprecation
```

---

## 10. Hallazgos P2 — Moderados

Incluyen las fronteras que Fase 4 consideró reforzables o controladas:

```text
Architecture / Framework
Contract / Interface
DI / Container / Binding / Autowiring
Event / Integration Event
Envelope / EventId / CorrelationId / CausationId
Builder Pipeline / Generator
Template Engine / Generator
Artifact / Scaffold
Cache / Storage
Module / Plugin / Extension
SDK / CLI
```

También pertenecen a P2:

```text
Module Metadata / ModuleMetadata
EventId / eventId y equivalentes
Generator / Generadores
Template / Plantillas
Testing / Pruebas
Semantic Versioning / Versionado Semántico
Notification / Notifications
```

Estos hallazgos no justifican renombrar IDs.

---

# PARTE C — CONTRATO NORMATIVO CONSOLIDADO

## 11. Identidad mínima de una entrada

La normalización deberá utilizar:

```text
MUST
├── ID
├── Nombre Canónico
├── Definición
├── Propósito
├── Categoría
├── Documento de origen / autoridad primaria
└── Estado

SHOULD
└── Relacionados

MAY
├── No confundir con
├── Responsabilidades
├── Ejemplos
└── secciones específicas

PENDIENTE
└── Historial
```

### Decisión F8 sobre `Historial`

Dado que sólo 1/70 términos lo implementa y Git/ADR/RFC ya proporcionan mecanismos de trazabilidad, **no debe convertirse en MUST durante la normalización**.

Se clasifica como:

```text
Historial = MAY
```

No se crearán 69 historiales artificiales.

---

## 12. Taxonomía de Categorías — baseline de corrección

Fase 7 propuso:

```text
Arquitectura
Core
Platform
Ingeniería
```

Fase 8 lo adopta como **baseline de trabajo para corrección controlada**, sujeto a verificación término por término antes de escribir las 38 categorías faltantes.

Regla:

```text
Cada término MUST tener una categoría primaria.
No se asignará sólo por pertenecer físicamente a un archivo.
La asignación debe concordar con definición y autoridad.
```

---

## 13. Taxonomía de Estados — baseline de corrección

Se adopta como catálogo de ciclo de vida:

```text
Propuesto
Aceptado
Estable
Deprecado
Retirado
```

Los valores existentes:

```text
Opcional
No implementado
Evolución futura
Visión futura
```

no se reemplazarán ciegamente.

Deberán descomponerse, cuando aplique, en:

```text
Estado
Obligatoriedad
Implementación
Horizonte
```

La información original debe preservarse.

---

## 14. Taxonomía de Relaciones — baseline de corrección

Se adopta inicialmente:

```text
Relacionados
Depende de
Compuesto por
Especializa
No confundir con
```

Reglas:

- preferir `MEF-DIC-XXXX — Nombre` cuando exista ID;
- no inventar relaciones para completar campos;
- `No confundir con` no se fusiona con `Relacionados`;
- `Depende de` es conceptual, no dependencia de código;
- relaciones vacías se omiten.

---

## 15. Trazabilidad: refinamiento necesario

Fase 3 propuso distinguir:

```yaml
autoridad_primaria:
relacionados:
implementacion:
```

Fase 8 confirma que esta separación es conceptualmente correcta.

Sin embargo, para no introducir una ruptura editorial innecesaria, durante la corrección puede conservarse el encabezado visible:

```text
Documento de origen
```

siempre que su semántica quede definida como **autoridad primaria del término**.

Las referencias secundarias deberán ir a `Relacionados` o a una sección explícita de implementación/referencias, no mezclarse con la autoridad primaria.

---

# PARTE D — POLÍTICA LINGÜÍSTICA

## 16. Contrato lingüístico consolidado

Para resolver Fase 5 sin traducir masivamente el corpus:

```text
LANG-001  Cada MEF-DIC posee un único Nombre Canónico.
LANG-002  El nombre canónico técnico se conserva en inglés
          cuando así está establecido por el corpus.
LANG-003  La definición y explicación pueden redactarse en español.
LANG-004  Una traducción descriptiva no crea un alias canónico.
LANG-005  Código y campos técnicos pueden aplicar casing tecnológico.
LANG-006  Identidad conceptual y representación de código son distintas.
LANG-007  No se permiten reemplazos globales por traducción.
```

Ejemplo:

```text
Nombre canónico: Semantic Versioning
Descripción: versionado semántico

Concepto: EventId
Campo técnico posible: eventId
```

---

# PARTE E — QUÉ PUEDE AUTOMATIZARSE

## 17. Correcciones deterministas

Pueden automatizarse **después de respaldar el corpus y bajo diff controlado**:

```text
A1  corregir Modular ERP Framework → Modular Enterprise Framework;
A2  regenerar INDICE.md desde los 70 IDs ya normalizados;
A3  validar continuidad MEF-DIC-0001 → 0070;
A4  validar IDs duplicados;
A5  validar campos MUST presentes;
A6  validar valores contra catálogos aprobados;
A7  detectar referencias a IDs MEF-DIC inexistentes;
A8  detectar categorías/estados fuera de catálogo;
A9  validar encoding UTF-8;
A10 generar matrices de cobertura posteriores.
```

---

## 18. Correcciones que requieren revisión humana

No deben automatizarse por inferencia:

```text
H1  asignación de las 38 categorías faltantes;
H2  determinación de los 7 documentos de origen faltantes;
H3  redacción del Propósito de Event Store;
H4  frontera Template / Stub;
H5  frontera Plugin / Extension;
H6  refuerzo de las demás fronteras semánticas;
H7  migración de Opcional / No implementado /
    Evolución futura / Visión futura;
H8  asignación de relaciones;
H9  decisión final sobre contenido histórico de DICCIONARIO_MEF.md;
H10 cambios de definición derivados de autoridad FND/ARQ.
```

---

# PARTE F — ORDEN DE CORRECCIÓN

## 19. Secuencia obligatoria recomendada

```text
PASO 0 — SNAPSHOT
    │
    ├── git status
    ├── commit/tag previo a normalización
    └── conservar auditorías F1–F8
    │
    ▼
PASO 1 — AUTORIDAD E IDENTIDAD
    ├── corregir Modular Enterprise Framework
    ├── desautorizar DICCIONARIO_MEF.md
    └── fijar README como contrato introductorio
    │
    ▼
PASO 2 — CONTRATO
    ├── plantilla MUST/SHOULD/MAY
    ├── política lingüística
    ├── categorías
    ├── estados
    └── relaciones
    │
    ▼
PASO 3 — TRAZABILIDAD
    ├── resolver 7 orígenes faltantes
    ├── revisar referencias legacy
    └── separar autoridad / relacionados / implementación
    │
    ▼
PASO 4 — SEMÁNTICA
    ├── Template / Stub
    ├── Plugin / Extension
    └── demás fronteras Fase 4
    │
    ▼
PASO 5 — COMPLETITUD
    ├── Propósito Event Store
    ├── 38 categorías
    └── relaciones justificadas
    │
    ▼
PASO 6 — NORMALIZACIÓN EDITORIAL
    ├── headings
    ├── nombres de campos
    ├── casing
    └── traducciones descriptivas
    │
    ▼
PASO 7 — DERIVADOS
    ├── regenerar INDICE.md
    └── actualizar README
    │
    ▼
PASO 8 — VALIDACIÓN
    ├── auditor automático
    ├── diff
    ├── 70/70 MUST
    └── cero colisiones
```

El orden es importante: no debe regenerarse el índice antes de estabilizar la autoridad y los metadatos.

---

# PARTE G — INVARIANTES DE CORRECCIÓN

## 20. Elementos que deben permanecer inmutables

Salvo una decisión arquitectónica posterior explícita:

```text
INV-DIC-01  Deben conservarse 70 IDs canónicos.
INV-DIC-02  MEF-DIC-0001 → MEF-DIC-0070 no se renumera.
INV-DIC-03  Un ID no se reutiliza para otro concepto.
INV-DIC-04  No se crean MEF-DIC-0071+ durante esta normalización.
INV-DIC-05  No se fusionan términos por similitud nominal.
INV-DIC-06  DIC no contradice FND/ARQ.
INV-DIC-07  ENG no sustituye autoridad primaria FND/ARQ.
INV-DIC-08  No se inventan orígenes, relaciones ni categorías.
INV-DIC-09  No se pierde información al normalizar Estado.
INV-DIC-10  INDICE.md es derivado, no autoridad primaria.
INV-DIC-11  DICCIONARIO_MEF.md no puede resolver IDs canónicos.
INV-DIC-12  Toda modificación debe ser trazable por diff.
```

---

# PARTE H — MATRIZ CONSOLIDADA

## 21. Estado por fase

| Fase | Área | Resultado consolidado | Pasa a corrección |
|---|---|---|---|
| 1 | Inventario y alcance | PASS con observación | Índice |
| 2 | Identidad/formato/metadatos | PASS con hallazgos mayores | Sí |
| 3 | Referencias/trazabilidad | Incompleta | Sí |
| 4 | Fronteras/unicidad | Sin duplicidad total; 2 solapamientos altos | Sí |
| 5 | Nomenclatura | Hallazgo crítico de identidad | Sí |
| 6 | Cobertura/estructura | Cobertura conceptual PASS; estructura FAIL | Sí |
| 7 | Taxonomía | Definida/auditada; no aplicada | Sí |
| 8 | Coherencia global | Baseline consolidado | Gate |

---

## 22. Matriz de acciones

| Prioridad | Acción | Tipo |
|---|---|---|
| P0 | `Modular ERP Framework` → `Modular Enterprise Framework` | Determinista |
| P0 | Resolver autoridad de `DICCIONARIO_MEF.md` | Humana/controlada |
| P0 | Reforzar Template / Stub | Semántica |
| P0 | Reforzar Plugin / Extension | Semántica |
| P1 | Aprobar/aplicar plantilla MUST/SHOULD/MAY | Normativa |
| P1 | Resolver 7 documentos de origen | Trazabilidad |
| P1 | Completar Propósito de Event Store | Semántica |
| P1 | Completar 38 categorías | Clasificación |
| P1 | Migrar estados heterogéneos sin pérdida | Taxonomía |
| P1 | Normalizar relaciones | Taxonomía |
| P1 | Formalizar política lingüística | Normativa |
| P1 | Regenerar `INDICE.md` al final | Automática |
| P2 | Reforzar familias semánticas restantes | Semántica |
| P2 | Normalizar casing/traducciones | Editorial |
| P3 | Uniformar presentación Markdown | Editorial |

---

# PARTE I — GATE DE FASE 8

## 23. ¿Puede declararse cerrado el Diccionario?

**No todavía.**

El corpus es suficientemente estable para entrar a correcciones controladas, pero no para certificarse como normalizado.

```text
IDENTIDAD DE IDs                    PASS
CONTINUIDAD                         PASS
UNICIDAD NOMINAL                   PASS
UNICIDAD SEMÁNTICA GLOBAL          PASS
AUTORIDAD DOCUMENTAL               FAIL — legacy concurrente
IDENTIDAD DE MEF                    FAIL — 1 error crítico
TRAZABILIDAD                        FAIL — 7 orígenes + legacy
COMPLETITUD ESTRUCTURAL             FAIL
TAXONOMÍA                           DEFINIDA / NO APLICADA
FRONTERAS                           2 SOLAPAMIENTOS ALTOS
ÍNDICE                              FAIL / INCOMPLETO
```

---

## 24. Dictamen formal

```text
FASE 8 — AUDITORÍA DE COHERENCIA NORMATIVA GLOBAL

BASELINE CANÓNICO                  ESTABLECIDO
70 IDs                             PRESERVAR
RECONSTRUCCIÓN TOTAL              NO REQUERIDA
CORRECCIONES CONTROLADAS          REQUERIDAS
HALLAZGOS P0                      4
HALLAZGOS P1                      10 GRUPOS
HALLAZGOS P2                      CONTROLABLES
AUTOMATIZACIÓN                    PARCIAL
REVISIÓN HUMANA                   OBLIGATORIA

RESULTADO:
PASS PARA ENTRAR A CORRECCIONES CONTROLADAS
FAIL PARA CIERRE/CERTIFICACIÓN FINAL
```

---

## 25. Decisiones de Fase 8

```text
DEC-F8-01
El corpus canónico es DIC-001A → DIC-001G.

DEC-F8-02
MEF-DIC-0001 → MEF-DIC-0070 se preserva sin renumeración.

DEC-F8-03
DICCIONARIO_MEF.md queda clasificado como LEGACY NO CANÓNICO
hasta resolver su destino físico.

DEC-F8-04
INDICE.md será un artefacto derivado y deberá regenerarse después
de normalizar el corpus.

DEC-F8-05
Historial deja de ser requisito MUST; queda MAY.

DEC-F8-06
La taxonomía Fase 7 se adopta como baseline de trabajo, con
verificación término por término antes de escritura.

DEC-F8-07
No se realizarán reemplazos semánticos masivos.

DEC-F8-08
La siguiente etapa será de CORRECCIONES CONTROLADAS, no una
nueva auditoría diagnóstica.
```

---

## 26. Siguiente fase

La secuencia recomendada es:

**FASE 9 — CORRECCIONES CONTROLADAS Y NORMALIZACIÓN CANÓNICA DEL DICCIONARIO**

Debe ejecutarse por lotes pequeños y verificables:

```text
9.1 Autoridad e identidad
9.2 Contrato/README
9.3 Trazabilidad
9.4 Fronteras semánticas
9.5 Categorías y estados
9.6 Relaciones
9.7 Normalización estructural
9.8 Regeneración del índice
9.9 Validación automática
```

Después deberá realizarse una **reauditoría integral** antes del cierre formal.

---

**Estado Fase 8:** CERRADA COMO AUDITORÍA GLOBAL.  
**Gate:** AUTORIZA CORRECCIONES CONTROLADAS; NO AUTORIZA CIERRE FINAL.
