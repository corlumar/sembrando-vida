# AUDITORÍA FASE 9.3.7 — DEPURACIÓN Y VALIDACIÓN SEMÁNTICA ARQ

## 1. Identificación

| Campo | Valor |
|---|---|
| Proyecto | Modular Enterprise Framework (MEF) |
| Componente | Diccionario Canónico MEF — V2 |
| Fase | 9.3 — Extracción controlada de términos candidatos |
| Subfase | 9.3.7 — Depuración y validación semántica ARQ |
| Capa auditada | Arquitectura (`ARQ`) |
| Estado | Completada |
| Resultado | PASS METODOLÓGICO CON EVIDENCIA TRANSVERSAL |
| Fecha | 2026-08-19 |

---

## 2. Propósito

La presente subfase tiene como propósito depurar los candidatos obtenidos durante la Fase 9.3.6, separar ruido estructural de evidencia semántica real, consolidar evidencias repetidas y evaluar transversalmente los conceptos asociados a autoridades ARQ sin cuerpo normativo.

No se realiza todavía canonización definitiva.

No se asignan identificadores `MEF-DIC`.

---

## 3. Artefactos utilizados

```text
docs/DICCIONARIO/V2/CATALOGO/CANDIDATOS_ARQ.csv
docs/DICCIONARIO/V2/CATALOGO/REVISION_CANDIDATOS_ARQ.csv
docs/DICCIONARIO/V2/CATALOGO/CANDIDATOS_ARQ_SIN_CUERPO.csv
docs/DICCIONARIO/V2/CATALOGO/EVIDENCIA_TRANSVERSAL_ARQ_SIN_CUERPO.txt
docs/DICCIONARIO/V2/CATALOGO/COBERTURA_TRANSVERSAL_ARQ_SIN_CUERPO.csv
```

---

## 4. Estado inicial de candidatos ARQ

Después del refinamiento aplicado al extractor ARQ, el catálogo de trabajo contiene:

```text
TOTAL CANDIDATOS ARQ: 16
```

Distribución observada:

```text
DESCARTAR_EDITORIAL    11
CANDIDATO_FUERTE        5
```

---

## 5. Ruido estructural identificado

Se clasificaron como `DESCARTAR_EDITORIAL` expresiones asociadas principalmente con organización documental, entre ellas:

```text
Invariantes arquitectónicos
Invariantes Arquitectónicos
Modelo de Generación
Modelo Arquitectónico
```

Estas expresiones no demuestran por sí mismas identidad terminológica autónoma.

Se mantiene la regla:

```text
ENCABEZADO = CONTEXTO
ENCABEZADO ≠ TÉRMINO AUTOMÁTICO
```

---

## 6. Candidatos fuertes

La revisión identificó cinco evidencias clasificadas como `CANDIDATO_FUERTE`.

Estas cinco evidencias corresponden a cuatro conceptos únicos:

```text
Module
Contract
Dependency Injection
Configuration
```

`Contract` dispone de dos evidencias explícitas dentro de `ARQ-011`.

Por tanto:

```text
5 evidencias fuertes
=
4 conceptos únicos
```

---

## 7. Consolidación de evidencia repetida

Se establece:

> La multiplicidad de evidencias no produce automáticamente multiplicidad de términos.

Modelo:

```text
Contract
├── evidencia 1: ARQ-011
└── evidencia 2: ARQ-011
```

deberá consolidarse posteriormente como una sola identidad conceptual.

---

## 8. Conceptos ARQ sin cuerpo normativo

La Fase 9.3.6 confirmó que doce autoridades ARQ carecen de cuerpo normativo.

Conceptos nominales asociados:

```text
Arquitectura General
Visión Arquitectónica
Core
Platform
Kernel
Registry
Service Container
Event Bus
Builders
Framework Lifecycle
Extension Model
Security
```

Estos conceptos fueron registrados con:

```text
EstadoDocumento     = SIN_CUERPO_NORMATIVO
EstadoTerminologico = REQUIERE_EVIDENCIA_TRANSVERSAL
```

---

## 9. Principio de búsqueda transversal

La ausencia de cuerpo normativo no autoriza inferir una definición desde el título documental.

Por ello se ejecutó búsqueda transversal sobre:

```text
FND
ARQ
ENG
```

La finalidad fue medir existencia y dispersión de evidencia, no resolver todavía autoridad definitiva.

---

## 10. Resultado de cobertura transversal

| Concepto | Coincidencias | Documentos |
|---|---:|---:|
| Security | 1607 | 103 |
| Registry | 1237 | 102 |
| Core | 275 | 55 |
| Event Bus | 218 | 34 |
| Service Container | 192 | 54 |
| Platform | 140 | 43 |
| Framework Lifecycle | 82 | 77 |
| Builders | 24 | 16 |
| Kernel | 23 | 12 |
| Extension Model | 17 | 14 |
| Arquitectura General | 5 | 5 |
| Visión Arquitectónica | 5 | 5 |

---

## 11. Interpretación de las coincidencias

El número de coincidencias mide presencia textual y dispersión documental.

No mide automáticamente:

- calidad de definición;
- autoridad primaria;
- precisión semántica;
- grado de canonización;
- relevancia arquitectónica.

Por tanto:

```text
FRECUENCIA ≠ AUTORIDAD
```

y:

```text
MUCHAS COINCIDENCIAS ≠ DEFINICIÓN CANÓNICA
```

---

## 12. Hallazgo ARQ-9.3.7-01 — Evidencia transversal disponible

Los doce conceptos nominales asociados a documentos ARQ sin cuerpo presentan evidencia textual fuera de su propia autoridad nominal.

Resultado:

```text
Conceptos sin evidencia transversal: 0
Conceptos con evidencia transversal: 12
```

Esto permite continuar su investigación sin inventar definiciones.

---

## 13. Hallazgo ARQ-9.3.7-02 — Registry

`Registry` presenta:

```text
1237 coincidencias
102 documentos
```

La elevada dispersión demuestra presencia transversal significativa dentro del corpus MEF.

Sin embargo, no se determina todavía autoridad primaria.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 14. Hallazgo ARQ-9.3.7-03 — Security

`Security` presenta:

```text
1607 coincidencias
103 documentos
```

Es el concepto con mayor número de coincidencias dentro del conjunto investigado.

Su elevada frecuencia no autoriza una definición automática.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 15. Hallazgo ARQ-9.3.7-04 — Core

`Core` presenta:

```text
275 coincidencias
55 documentos
```

Existe evidencia transversal suficiente para justificar análisis semántico posterior.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 16. Hallazgo ARQ-9.3.7-05 — Event Bus

`Event Bus` presenta:

```text
218 coincidencias
34 documentos
```

La evidencia distribuida permite conservarlo como candidato transversal.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 17. Hallazgo ARQ-9.3.7-06 — Service Container

`Service Container` presenta:

```text
192 coincidencias
54 documentos
```

Existe evidencia transversal amplia.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 18. Hallazgo ARQ-9.3.7-07 — Platform

`Platform` presenta:

```text
140 coincidencias
43 documentos
```

Se conserva como candidato transversal.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 19. Hallazgo ARQ-9.3.7-08 — Framework Lifecycle

`Framework Lifecycle` presenta:

```text
82 coincidencias
77 documentos
```

La distribución es amplia respecto de su frecuencia absoluta.

Se conserva como candidato transversal pendiente de validación definitoria.

---

## 20. Hallazgo ARQ-9.3.7-09 — Builders

`Builders` presenta:

```text
24 coincidencias
16 documentos
```

Se conserva como candidato transversal.

No se determina todavía si el nombre canónico deberá permanecer en plural o normalizarse posteriormente.

---

## 21. Hallazgo ARQ-9.3.7-10 — Kernel

`Kernel` presenta:

```text
23 coincidencias
12 documentos
```

Existe evidencia transversal suficiente para continuar su análisis.

Estado:

```text
REQUIERE_VALIDACION_DE_AUTORIDAD
```

---

## 22. Hallazgo ARQ-9.3.7-11 — Extension Model

`Extension Model` presenta:

```text
17 coincidencias
14 documentos
```

Se conserva como candidato transversal pendiente de análisis definitorio.

---

## 23. Hallazgo ARQ-9.3.7-12 — Arquitectura General

`Arquitectura General` presenta:

```text
5 coincidencias
5 documentos
```

La evidencia es limitada en comparación con otros conceptos.

No se descarta.

Se mantiene como:

```text
REQUIERE_EVIDENCIA_SEMANTICA_ESPECIFICA
```

---

## 24. Hallazgo ARQ-9.3.7-13 — Visión Arquitectónica

`Visión Arquitectónica` presenta:

```text
5 coincidencias
5 documentos
```

La evidencia es limitada y deberá analizarse principalmente como posible concepto documental o institucional.

Estado:

```text
REQUIERE_EVIDENCIA_SEMANTICA_ESPECIFICA
```

---

## 25. Clasificación resultante

La depuración ARQ permite distinguir tres grupos principales.

### Grupo A — Candidatos fuertes con definición explícita

```text
Module
Contract
Dependency Injection
Configuration
```

### Grupo B — Candidatos transversales asociados a autoridad ARQ sin cuerpo

```text
Core
Platform
Kernel
Registry
Service Container
Event Bus
Builders
Framework Lifecycle
Extension Model
Security
```

### Grupo C — Candidatos documentales con evidencia transversal limitada

```text
Arquitectura General
Visión Arquitectónica
```

---

## 26. Estado de los candidatos fuertes

Los candidatos del Grupo A se mantienen como:

```text
CANDIDATO_FUERTE
```

No se promueven todavía a:

```text
TÉRMINO_CANÓNICO
```

porque falta la consolidación transversal FND–ARQ–ENG y la determinación final de autoridad.

---

## 27. Estado de los candidatos transversales

Los candidatos del Grupo B se mantienen como:

```text
CANDIDATO_TRANSVERSAL
```

con necesidad de identificar:

- definición explícita;
- fuente más especializada;
- fronteras semánticas;
- responsabilidades;
- posibles contratos técnicos;
- autoridad normativa primaria.

---

## 28. Estado de candidatos documentales limitados

Los candidatos del Grupo C se mantienen como:

```text
REQUIERE_EVIDENCIA_SEMANTICA_ESPECIFICA
```

No deberán promoverse únicamente por coincidir con títulos documentales.

---

## 29. Regla de frecuencia

Se formaliza:

> La frecuencia textual puede utilizarse para priorizar investigación, pero no para resolver autoridad ni canonización.

Por tanto:

```text
FRECUENCIA
    ↓
PRIORIDAD DE REVISIÓN
```

pero no:

```text
FRECUENCIA
    ↓
AUTORIDAD CANÓNICA
```

---

## 30. Regla de transversalidad

Cuando un concepto cuya autoridad nominal carece de cuerpo aparece en múltiples capas:

```text
FND
ARQ
ENG
```

deberá construirse un expediente de evidencia transversal antes de decidir su autoridad primaria.

---

## 31. Regla de consolidación conceptual

La unidad del Diccionario continúa siendo el concepto.

Por tanto:

```text
N ocurrencias
+
N documentos
+
N evidencias
```

pueden consolidarse en:

```text
1 concepto
```

si no existe diferencia semántica que justifique múltiples entradas.

---

## 32. Regla de no inferencia

Permanece vigente:

> La ausencia de cuerpo en una autoridad nominal no autoriza inferir su definición a partir de frecuencia, título, metadatos o conocimiento técnico externo.

---

## 33. Artefactos estructurados resultantes

Como resultado de la subfase se generaron o utilizaron:

```text
REVISION_CANDIDATOS_ARQ.csv
CANDIDATOS_ARQ_SIN_CUERPO.csv
EVIDENCIA_TRANSVERSAL_ARQ_SIN_CUERPO.txt
COBERTURA_TRANSVERSAL_ARQ_SIN_CUERPO.csv
```

Estos artefactos deberán conservarse como evidencia del proceso de depuración.

---

## 34. Canonización

Durante esta subfase:

```text
Términos canónicos aprobados: 0
IDs MEF-DIC asignados:        0
```

No se altera todavía el Diccionario V1.

No se generan documentos DIC definitivos.

---

## 35. Gate de calidad

| Control | Resultado |
|---|---|
| Candidatos ARQ revisados | PASS — 16 |
| Ruido editorial identificado | PASS — 11 |
| Evidencias fuertes identificadas | PASS — 5 |
| Conceptos fuertes únicos | PASS — 4 |
| Autoridades ARQ sin cuerpo registradas | PASS — 12 |
| Búsqueda transversal ejecutada | PASS |
| Conceptos sin evidencia transversal | PASS — 0 |
| Conceptos con evidencia transversal | PASS — 12 |
| Frecuencia separada de autoridad | PASS |
| Duplicidad de evidencia separada de duplicidad conceptual | PASS |
| Canonización prematura | PASS — 0 |
| IDs MEF-DIC prematuros | PASS — 0 |

---

## 36. Resultado cuantitativo consolidado

```text
CANDIDATOS ARQ DIRECTOS
Total:                         16
Descartar editorial:           11
Evidencias fuertes:             5
Conceptos fuertes únicos:       4

AUTORIDADES SIN CUERPO
Total:                         12
Con evidencia transversal:     12
Sin evidencia transversal:      0

CANONIZACIÓN
Términos canónicos:             0
MEF-DIC asignados:              0
```

---

## 37. Resultado

La subfase:

```text
9.3.7 — DEPURACIÓN Y VALIDACIÓN SEMÁNTICA ARQ
```

se declara:

```text
PASS METODOLÓGICO
CON EVIDENCIA TRANSVERSAL DISPONIBLE
```

---

## 38. Decisión de avance

Se autoriza continuar con la siguiente actividad de la Fase 9.3.

La siguiente etapa deberá:

1. identificar evidencia definitoria concreta para los candidatos transversales;
2. determinar autoridad primaria provisional;
3. consolidar candidatos FND y ARQ;
4. preparar el método de extracción ENG;
5. mantener separados frecuencia, evidencia y autoridad;
6. evitar todavía la asignación de `MEF-DIC`.

---

## 39. Conclusión

La Fase 9.3.7 confirma que la depuración semántica reduce significativamente el ruido producido por la extracción estructural.

De 16 registros ARQ directos:

```text
11
```

corresponden a ruido editorial o estructural, mientras:

```text
5 evidencias
```

respaldan:

```text
4 conceptos fuertes
```

Además, los doce conceptos asociados a autoridades ARQ sin cuerpo presentan evidencia transversal en el corpus FND–ARQ–ENG.

Esto permite continuar su investigación sin inventar definiciones.

El resultado consolida un principio central de DICCIONARIO V2:

> La autoridad terminológica deberá demostrarse mediante evidencia normativa trazable; ni la frecuencia, ni el título documental, ni la existencia histórica de un término sustituyen esa evidencia.
