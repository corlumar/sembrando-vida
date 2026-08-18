# AUDITORÍA FASE 9.3.6 — EXTRACCIÓN CONTROLADA DE CANDIDATOS ARQ

## 1. Identificación

| Campo | Valor |
|---|---|
| Proyecto | Modular Enterprise Framework (MEF) |
| Componente | Diccionario Canónico MEF — V2 |
| Fase | 9.3 — Extracción controlada de términos candidatos |
| Subfase | 9.3.6 — Extracción controlada de candidatos ARQ |
| Capa auditada | Arquitectura (`ARQ`) |
| Estado | Completada |
| Resultado | PASS TÉCNICO CON HALLAZGO DE COBERTURA DOCUMENTAL |
| Fecha | 2026-08-18 |

---

## 2. Propósito

La presente subfase tiene como propósito ejecutar y documentar la extracción controlada de términos candidatos desde la capa de Arquitectura (`ARQ`) del corpus normativo de Modular Enterprise Framework (MEF).

La extracción ARQ continúa el proceso iniciado sobre la capa Fundación (`FND`) y mantiene el principio establecido para DICCIONARIO V2:

> Ninguna expresión será promovida automáticamente a término canónico por aparecer en un documento normativo.

La existencia de una expresión dentro del corpus constituye evidencia documental, pero no implica por sí misma autoridad terminológica suficiente.

La extracción deberá preservar la trazabilidad hacia la fuente documental y distinguir entre:

- identidad documental;
- evidencia semántica;
- candidato terminológico;
- término canónico.

En esta subfase únicamente se trabaja con candidatos.

No se asignan identificadores `MEF-DIC`.

---

## 3. Corpus ARQ auditado

La capa Arquitectura utilizada durante esta subfase se encuentra en:

```text
docs/01-ARQUITECTURA/
```

El inventario contiene 18 documentos ARQ:

```text
ARQ-000 — Arquitectura General
ARQ-001 — Visión Arquitectónica
ARQ-002 — Core
ARQ-003 — Platform
ARQ-004 — Modules
ARQ-005 — Kernel
ARQ-006 — Registry
ARQ-007 — Service Container
ARQ-008 — Event Bus
ARQ-009 — Builders
ARQ-010 — Template Engine
ARQ-011 — Contracts
ARQ-012 — Dependency Injection
ARQ-013 — Configuration
ARQ-014 — Framework Lifecycle
ARQ-015 — Extension Model
ARQ-016 — Security
ARQ-017 — Packaging
```

Total:

```text
18 documentos ARQ
```

---

## 4. Inventario documental verificado

El inventario observado durante la auditoría fue:

| ID | Archivo | Título |
|---|---|---|
| ARQ-000 | ARQ-000-ARQUITECTURA_GENERAL.md | Arquitectura General |
| ARQ-001 | ARQ-001-VISION_ARQUITECTONICA.md | Visión Arquitectónica |
| ARQ-002 | ARQ-002-CORE.md | Core |
| ARQ-003 | ARQ-003-PLATFORM.md | Platform |
| ARQ-004 | ARQ-004-MODULES.md | Modules |
| ARQ-005 | ARQ-005-KERNEL.md | Kernel |
| ARQ-006 | ARQ-006-REGISTRY.md | Registry |
| ARQ-007 | ARQ-007-SERVICE_CONTAINER.md | Service Container |
| ARQ-008 | ARQ-008-EVENT_BUS.md | Event Bus |
| ARQ-009 | ARQ-009-BUILDERS.md | Builders |
| ARQ-010 | ARQ-010-TEMPLATE_ENGINE.md | Template Engine |
| ARQ-011 | ARQ-011-CONTRACTS.md | Contracts |
| ARQ-012 | ARQ-012-DEPENDENCY_INJECTION.md | Dependency Injection |
| ARQ-013 | ARQ-013-CONFIGURATION.md | Configuration |
| ARQ-014 | ARQ-014-FRAMEWORK_LIFECYCLE.md | Framework Lifecycle |
| ARQ-015 | ARQ-015-EXTENSION_MODEL.md | Extension Model |
| ARQ-016 | ARQ-016-SECURITY.md | Security |
| ARQ-017 | ARQ-017-PACKAGING.md | Packaging |

---

## 5. Validación previa de identidad documental

Antes de ejecutar la extracción se verificó la identidad documental de los 18 documentos ARQ.

Resultado:

```text
Documentos ARQ:       18
IDs vacíos:            0
IDs duplicados:        0
```

No se detectaron identificadores vacíos.

No se detectaron identificadores duplicados.

La comprobación archivo ↔ identificador tampoco reportó desalineaciones después de las correcciones documentales realizadas previamente.

Por tanto, la identidad documental ARQ se considera estructuralmente consistente para efectos de esta subfase.

---

## 6. Estado de ARQ-004

Durante la preparación del corpus se había detectado previamente una desalineación relacionada con `ARQ-004-MODULES.md`.

El documento vigente declara:

```yaml
id: ARQ-004
titulo: Modules
tipo: Architecture
nivel: L1
categoria: Núcleo
subcategoria: Modules
estado: Accepted
version: 2.0.0
responsable: MEF Architecture Team
ultima_revision: 2026-08-06
```

La revisión posterior confirmó que `ARQ-004` posee identidad documental válida y cuerpo normativo disponible.

Por tanto, para esta subfase:

```text
ARQ-004 = autoridad documental válida
ARQ-004 = fuente con cuerpo normativo
```

---

## 7. Principio de extracción ARQ

La extracción de candidatos ARQ se rige por el principio:

> La presencia textual de una expresión no equivale a canonización terminológica.

El extractor deberá localizar evidencia potencial sin decidir todavía si dicha evidencia constituye:

- término canónico;
- sinónimo;
- alias;
- encabezado editorial;
- construcción gramatical;
- relación;
- frontera semántica;
- responsabilidad;
- invariante;
- concepto auxiliar.

La clasificación definitiva corresponde a etapas posteriores de validación semántica.

---

## 8. Método de extracción

La extracción se ejecutó mediante el script de trabajo:

```text
extract_diccionario_v2_arq.ps1
```

El procedimiento fue diseñado como una operación de análisis de sólo lectura sobre las autoridades ARQ.

El extractor:

- recorre las fuentes ARQ;
- identifica construcciones con posible valor semántico;
- conserva el documento de procedencia;
- conserva el archivo de procedencia;
- conserva la sección;
- conserva el texto utilizado como evidencia;
- clasifica provisionalmente el tipo de evidencia;
- asigna un nivel inicial de confianza;
- registra cada resultado como `CANDIDATO`;
- no asigna identificadores `MEF-DIC`;
- no modifica las autoridades ARQ;
- no modifica definiciones normativas;
- no promueve automáticamente expresiones al Diccionario Canónico.

---

## 9. Esquema de candidatos

Los candidatos ARQ mantienen el esquema establecido para la extracción controlada:

```text
Termino
NombreCanonico
Capa
Documento
Archivo
Seccion
TipoEvidencia
TextoEvidencia
EstadoValidacion
Confianza
Notas
```

Durante esta etapa:

```text
Capa = ARQ
EstadoValidacion = CANDIDATO
```

`NombreCanonico` continúa siendo provisional.

No constituye todavía una decisión de canonización.

---

## 10. Primera ejecución del extractor

La primera ejecución reportó:

```text
==============================================
EXTRACCION ARQ TERMINADA
==============================================
Fuentes procesadas: 18
Candidatos generados: 20
Salida: .\docs\DICCIONARIO\V2\CATALOGO\CANDIDATOS_ARQ.csv
```

Por tanto:

```text
Fuentes procesadas:       18
Candidatos generados:     20
```

---

## 11. Distribución inicial por tipo de evidencia

Los 20 candidatos iniciales presentaron la siguiente distribución:

| Tipo de evidencia | Cantidad |
|---|---:|
| ENCABEZADO_SEMANTICO | 11 |
| DEFINICION_EXPLICITA | 9 |
| **Total** | **20** |

Esta distribución fue considerada provisional.

La existencia de 11 candidatos originados en encabezados motivó una revisión específica para determinar si se estaba confundiendo organización documental con identidad terminológica.

---

## 12. Validación estructural inicial

La primera validación estructural detectó tres registros aparentemente inválidos.

Los registros fueron:

```text
Esta estructura
Invariantes arquitectónicos
Un Module
```

Los tres procedían de:

```text
ARQ-004-MODULES.md
```

El campo `Documento` aparecía vacío.

La revisión determinó que el problema correspondía a la información utilizada por el proceso de extracción y no a ausencia de identidad en el documento ARQ vigente.

ARQ-004 declara correctamente:

```text
id: ARQ-004
```

Una vez alineada la referencia documental, el problema de identidad quedó resuelto.

---

## 13. Hallazgo de falsos positivos gramaticales

La inspección de los candidatos iniciales permitió detectar expresiones que habían sido interpretadas como posibles términos aunque funcionaban únicamente como sujetos gramaticales.

Entre ellas:

```text
Esta estructura
Su responsabilidad
Cada paquete
No
```

Estas expresiones no representan por sí mismas conceptos arquitectónicos autónomos.

El hallazgo demuestra que una construcción semánticamente relevante puede contener un sujeto que no constituye identidad terminológica.

Por tanto:

> El extractor no deberá confundir sujeto gramatical con término arquitectónico.

---

## 14. Normalización controlada de artículos

También se observaron expresiones con conceptos válidos precedidos por artículos:

```text
Un Module
Un Contract
La Dependency Injection
La Configuration
```

Estas expresiones fueron normalizadas como:

```text
Module
Contract
Dependency Injection
Configuration
```

La normalización elimina exclusivamente artículos iniciales cuando éstos forman parte de una construcción definitoria.

No altera el significado del concepto.

No constituye traducción.

No constituye canonización.

No implica todavía aceptación terminológica.

---

## 15. Candidatos arquitectónicos fuertes observados

Después de la normalización se identificaron como candidatos con evidencia explícita, entre otros:

| Candidato | Documento | Tipo de evidencia | Confianza |
|---|---|---|---|
| Module | ARQ-004 | DEFINICION_EXPLICITA | ALTA |
| Contract | ARQ-011 | DEFINICION_EXPLICITA | ALTA |
| Dependency Injection | ARQ-012 | DEFINICION_EXPLICITA | ALTA |
| Configuration | ARQ-013 | DEFINICION_EXPLICITA | ALTA |

`Contract` presenta más de una evidencia dentro de `ARQ-011`.

La multiplicidad de evidencias no implica multiplicidad de términos.

Las evidencias deberán consolidarse durante la validación semántica posterior.

---

## 16. Hallazgo sobre encabezados

La extracción inicial también produjo expresiones como:

```text
Invariantes arquitectónicos
Invariantes Arquitectónicos
Modelo de Generación
Modelo Arquitectónico
```

Estas expresiones corresponden principalmente a encabezados o mecanismos de organización del documento.

La revisión determinó que un encabezado puede aportar contexto, pero no debe convertirse automáticamente en término.

Se establece:

> Un encabezado documental no constituye por sí mismo evidencia semántica suficiente para promover una expresión a término canónico.

El encabezado deberá conservarse principalmente como información de contexto en:

```text
Seccion
```

---

## 17. Regla encabezado ≠ término

Como resultado de la revisión se adopta la siguiente regla metodológica para DICCIONARIO V2:

```text
ENCABEZADO = CONTEXTO DOCUMENTAL
ENCABEZADO ≠ TÉRMINO AUTOMÁTICO
```

Un encabezado podrá originar investigación terminológica únicamente cuando exista evidencia semántica adicional en el cuerpo normativo.

Ejemplos como:

```text
Modelo Arquitectónico
Invariantes Arquitectónicos
Modelo de Generación
```

no deberán ser canonizados únicamente por aparecer como títulos de sección.

---

## 18. Búsqueda semántica ampliada

Debido a que la primera extracción sólo produjo candidatos en una parte del corpus, se ejecutó una búsqueda semántica ampliada.

Se examinaron construcciones asociadas con:

- definición;
- representación;
- constitución;
- responsabilidad;
- encapsulación;
- provisión;
- comportamiento;
- frontera negativa;
- prohibición arquitectónica;
- diferenciación conceptual.

Entre los patrones investigados se incluyeron:

```text
es un
es una
son
representa
representan
constituye
constituyen
define
se define
responsable de
tiene la responsabilidad
su responsabilidad
encapsula
proporciona
actúa como
permite
no es
no deberá
≠
```

---

## 19. Resultado de la búsqueda semántica ampliada

La búsqueda produjo:

```text
Coincidencias semánticas ARQ: 54
```

Las coincidencias se concentraron exclusivamente en seis documentos.

Distribución:

| Documento | Coincidencias |
|---|---:|
| ARQ-004-MODULES.md | 16 |
| ARQ-010-TEMPLATE_ENGINE.md | 6 |
| ARQ-011-CONTRACTS.md | 14 |
| ARQ-012-DEPENDENCY_INJECTION.md | 5 |
| ARQ-013-CONFIGURATION.md | 6 |
| ARQ-017-PACKAGING.md | 7 |
| **TOTAL** | **54** |

---

## 20. Concentración de evidencia

Los seis documentos con evidencia semántica detectada fueron:

```text
ARQ-004 — Modules
ARQ-010 — Template Engine
ARQ-011 — Contracts
ARQ-012 — Dependency Injection
ARQ-013 — Configuration
ARQ-017 — Packaging
```

Los restantes doce documentos no produjeron ninguna coincidencia mediante los patrones semánticos examinados.

Esta diferencia requirió una investigación adicional antes de modificar nuevamente el extractor.

---

## 21. Documentos inicialmente sin evidencia

Los doce documentos sin coincidencias fueron:

```text
ARQ-000-ARQUITECTURA_GENERAL.md
ARQ-001-VISION_ARQUITECTONICA.md
ARQ-002-CORE.md
ARQ-003-PLATFORM.md
ARQ-005-KERNEL.md
ARQ-006-REGISTRY.md
ARQ-007-SERVICE_CONTAINER.md
ARQ-008-EVENT_BUS.md
ARQ-009-BUILDERS.md
ARQ-014-FRAMEWORK_LIFECYCLE.md
ARQ-015-EXTENSION_MODEL.md
ARQ-016-SECURITY.md
```

No se asumió que la ausencia de coincidencias constituyera automáticamente un defecto del extractor.

Se abrió una comprobación estructural específica.

---

## 22. Hipótesis de investigación

La ausencia de evidencia podía deberse a tres escenarios:

### Escenario A — Patrón insuficiente

Los documentos contienen cuerpo normativo, pero utilizan construcciones lingüísticas no contempladas por el extractor.

### Escenario B — Estructura documental diferente

Los documentos contienen información normativa utilizando una estructura distinta a la observada en los seis documentos con evidencia.

### Escenario C — Ausencia de cuerpo normativo

Los documentos poseen identidad y metadatos, pero todavía no contienen desarrollo normativo.

La auditoría procedió a comprobar cuál escenario correspondía al corpus real.

---

## 23. Diagnóstico estructural de los doce documentos

Los doce documentos fueron inspeccionados individualmente.

Resultado:

| Documento | Líneas | Front matter inicial | Separadores YAML | Headings |
|---|---:|---|---:|---:|
| ARQ-000-ARQUITECTURA_GENERAL.md | 26 | Sí | 2 | 0 |
| ARQ-001-VISION_ARQUITECTONICA.md | 26 | Sí | 2 | 0 |
| ARQ-002-CORE.md | 27 | Sí | 2 | 0 |
| ARQ-003-PLATFORM.md | 27 | Sí | 2 | 0 |
| ARQ-005-KERNEL.md | 27 | Sí | 2 | 0 |
| ARQ-006-REGISTRY.md | 26 | Sí | 2 | 0 |
| ARQ-007-SERVICE_CONTAINER.md | 27 | Sí | 2 | 0 |
| ARQ-008-EVENT_BUS.md | 26 | Sí | 2 | 0 |
| ARQ-009-BUILDERS.md | 26 | Sí | 2 | 0 |
| ARQ-014-FRAMEWORK_LIFECYCLE.md | 27 | Sí | 2 | 0 |
| ARQ-015-EXTENSION_MODEL.md | 27 | Sí | 2 | 0 |
| ARQ-016-SECURITY.md | 27 | Sí | 2 | 0 |

Los doce documentos presentan:

```text
Front matter inicial: Sí
Separadores YAML:     2
Headings Markdown:    0
```

---

## 24. Verificación de cuerpo normativo

La ausencia de headings no era suficiente para concluir que los documentos carecían de contenido.

Por ello se verificaron específicamente las líneas existentes después del segundo delimitador YAML:

```text
---
```

La comprobación contó únicamente líneas no vacías posteriores al cierre del front matter.

Resultado:

```text
CON CUERPO: 0
SIN CUERPO: 12
```

Por tanto, ninguno de los doce documentos contiene actualmente cuerpo normativo después del front matter.

---

## 25. Hallazgo ARQ-9.3.6-01 — Autoridad documental sin cuerpo normativo

Se establece formalmente el siguiente hallazgo:

> Doce de las dieciocho autoridades ARQ registradas en el corpus vigente poseen identidad documental y front matter válido, pero carecen actualmente de cuerpo normativo.

Documentos afectados:

```text
ARQ-000
ARQ-001
ARQ-002
ARQ-003
ARQ-005
ARQ-006
ARQ-007
ARQ-008
ARQ-009
ARQ-014
ARQ-015
ARQ-016
```

Este resultado constituye un hallazgo de cobertura documental.

No constituye un error del extractor.

---

## 26. Autoridad documental y autoridad semántica

El hallazgo obliga a distinguir formalmente dos conceptos operativos dentro del proceso de reconstrucción.

### Autoridad documental

Existe un documento registrado con:

- identificador;
- título;
- clasificación;
- estado;
- metadatos;
- relaciones documentales.

### Autoridad semántica

Existe contenido normativo suficiente para determinar:

- definición;
- responsabilidad;
- frontera;
- relación;
- comportamiento;
- restricciones;
- invariantes;
- significado arquitectónico.

Por tanto:

```text
AUTORIDAD DOCUMENTAL ≠ AUTORIDAD SEMÁNTICA SUFICIENTE
```

---

## 27. Consecuencia para los títulos de documentos vacíos

Los títulos:

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

demuestran la existencia de conceptos o áreas documentales reconocidas por la arquitectura.

Sin embargo, el título y los metadatos no proporcionan por sí mismos una definición semántica suficiente para redactar una entrada canónica del Diccionario V2.

Por tanto, estos nombres podrán:

- permanecer como candidatos documentales;
- utilizarse como objetivos de búsqueda;
- buscar autoridad complementaria en otras capas;
- relacionarse con evidencia encontrada en ENG;
- relacionarse con evidencia encontrada en FND;
- quedar pendientes de desarrollo normativo.

No deberán recibir una definición inventada.

---

## 28. Regla de no inferencia

DICCIONARIO V2 adopta para esta situación la siguiente regla:

> Cuando una autoridad documental carezca de cuerpo normativo, el proceso de reconstrucción no deberá completar, reconstruir ni inferir una definición utilizando únicamente el nombre del archivo, el título o sus metadatos.

La definición deberá localizarse mediante evidencia normativa suficiente.

Las fuentes posibles incluyen:

```text
FND
ARQ con cuerpo normativo
ENG
```

o una futura ampliación normativa del documento correspondiente.

---

## 29. Regla de búsqueda transversal

La ausencia de cuerpo en una autoridad ARQ no implica que el concepto carezca de definición en todo MEF.

Por ejemplo, conceptos como:

```text
Core
Kernel
Registry
Service Container
Event Bus
Security
```

podrían estar desarrollados o utilizados normativamente en:

- otros documentos ARQ;
- documentos ENG;
- documentos FND.

Por tanto:

> La ausencia de cuerpo en la autoridad nominal obliga a ampliar la búsqueda de evidencia, no a inventar la definición.

Esta regla será aplicada durante la consolidación transversal FND–ARQ–ENG.

---

## 30. Autoridades ARQ con cuerpo normativo

La auditoría confirmó que seis documentos sí contienen cuerpo normativo directamente susceptible de extracción semántica:

```text
ARQ-004 — Modules
ARQ-010 — Template Engine
ARQ-011 — Contracts
ARQ-012 — Dependency Injection
ARQ-013 — Configuration
ARQ-017 — Packaging
```

Estos seis documentos constituyen el corpus ARQ efectivo disponible para extracción semántica directa durante esta subfase.

---

## 31. Cobertura normativa observada

La situación del corpus ARQ queda cuantificada de la siguiente manera:

```text
Autoridades ARQ registradas:        18
Autoridades con cuerpo normativo:    6
Autoridades sin cuerpo normativo:   12
```

Cobertura con cuerpo normativo:

```text
6 / 18 = 33.33 %
```

Autoridades sin cuerpo:

```text
12 / 18 = 66.67 %
```

Estos porcentajes describen exclusivamente la disponibilidad de cuerpo normativo en los documentos ARQ auditados.

No deberán interpretarse como porcentaje general de avance o madurez de la arquitectura MEF.

---

## 32. Implicación para la extracción

El resultado demuestra que aumentar indiscriminadamente la cantidad de expresiones regulares no solucionaría la ausencia de candidatos en los doce documentos.

No existe cuerpo sobre el cual ejecutar extracción semántica.

Por tanto, queda descartada la estrategia:

```text
más regex → más términos
```

para estos documentos.

La estrategia correcta será:

```text
identidad documental
        ↓
búsqueda transversal
        ↓
evidencia normativa real
        ↓
validación semántica
        ↓
candidato consolidado
```

---

## 33. Artefactos generados

Durante esta subfase se generaron artefactos auxiliares de auditoría y extracción.

Entre ellos:

```text
docs/DICCIONARIO/V2/CATALOGO/CANDIDATOS_ARQ.csv
```

y:

```text
docs/DICCIONARIO/V2/CATALOGO/ARQ_SIN_EVIDENCIA_PATRONES.txt
```

Asimismo se preparó evidencia de búsqueda semántica ARQ mediante el proceso de diagnóstico correspondiente.

Los artefactos auxiliares:

- no constituyen el Diccionario Canónico;
- no asignan autoridad terminológica;
- no sustituyen los documentos fuente;
- pueden conservar resultados provisionales;
- sirven como evidencia reproducible del proceso.

---

## 34. Estado de CANDIDATOS_ARQ.csv

`CANDIDATOS_ARQ.csv` debe considerarse un artefacto de trabajo de la extracción.

La primera corrida permitió detectar:

- sujetos gramaticales;
- artículos iniciales;
- encabezados editoriales;
- duplicidad de evidencia;
- concentración de candidatos en documentos con cuerpo.

Por tanto, la existencia de una fila en:

```text
CANDIDATOS_ARQ.csv
```

no significa:

```text
término aceptado
```

ni:

```text
entrada MEF-DIC
```

El estado continúa siendo:

```text
CANDIDATO
```

---

## 35. Trazabilidad

Cada candidato deberá conservar trazabilidad suficiente hacia su evidencia.

Como mínimo:

```text
Candidato
    ↓
Documento
    ↓
Archivo
    ↓
Sección
    ↓
Tipo de evidencia
    ↓
Texto de evidencia
```

La trazabilidad deberá mantenerse incluso cuando varias evidencias sean posteriormente consolidadas en un único concepto.

---

## 36. Consolidación de evidencia repetida

La extracción mostró que un mismo concepto puede aparecer varias veces dentro de una misma autoridad.

Ejemplo observado:

```text
Contract
```

con más de una evidencia en:

```text
ARQ-011
```

Esto no deberá generar entradas terminológicas duplicadas.

La regla será:

> Las evidencias se acumulan; los términos no se duplican automáticamente.

La consolidación definitiva deberá realizarse después de comparar:

- significado;
- responsabilidad;
- frontera;
- documento de autoridad;
- relaciones;
- uso transversal.

---

## 37. Integridad del corpus ARQ

Durante la extracción se verificó el estado de:

```text
docs/01-ARQUITECTURA/
```

La comprobación mediante Git no mostró modificaciones producidas por la operación de extracción.

Por tanto:

> La extracción y el diagnóstico de la Fase 9.3.6 operaron como procesos de sólo lectura sobre el corpus arquitectónico.

La auditoría no alteró el contenido normativo para mejorar artificialmente los resultados.

---

## 38. Principio de preservación de evidencia

La reconstrucción del Diccionario V2 deberá preservar incluso los hallazgos de insuficiencia documental.

Una ausencia de definición también constituye información relevante.

Por tanto, el proceso no deberá ocultar:

- documentos sin cuerpo;
- conceptos sin definición suficiente;
- candidatos ambiguos;
- evidencia contradictoria;
- fronteras pendientes;
- autoridad insuficiente.

Estos casos deberán permanecer explícitamente identificados hasta su resolución.

---

## 39. Estado de canonización

Durante la Fase 9.3.6 no se realizó canonización.

No se asignaron identificadores:

```text
MEF-DIC-xxxx
```

No se realizó:

- numeración definitiva;
- promoción a término canónico;
- resolución global de sinónimos;
- resolución global de homónimos;
- selección definitiva de autoridad;
- migración V1 → V2;
- sustitución del Diccionario V1;
- modificación de las fuentes normativas para ajustarlas al Diccionario.

---

## 40. Hallazgos principales

La Fase 9.3.6 establece los siguientes hallazgos:

### ARQ-9.3.6-01

Doce autoridades ARQ poseen front matter válido pero carecen de cuerpo normativo.

### ARQ-9.3.6-02

Los encabezados documentales generan falsos candidatos cuando se interpretan automáticamente como términos.

### ARQ-9.3.6-03

Los sujetos gramaticales de construcciones definitorias no siempre representan conceptos terminológicos.

### ARQ-9.3.6-04

Los artículos iniciales pueden normalizarse de manera controlada sin alterar el concepto subyacente.

### ARQ-9.3.6-05

La evidencia semántica disponible se concentra actualmente en seis de las dieciocho autoridades ARQ.

### ARQ-9.3.6-06

La identidad documental no equivale a autoridad semántica suficiente.

---

## 41. Reglas derivadas

A partir de los hallazgos se establecen las siguientes reglas:

### Regla ARQ-R1

Un encabezado no será considerado término únicamente por su posición estructural.

### Regla ARQ-R2

Un sujeto gramatical genérico deberá descartarse cuando no posea identidad conceptual autónoma.

### Regla ARQ-R3

Los artículos iniciales podrán eliminarse durante la normalización cuando no formen parte del nombre conceptual.

### Regla ARQ-R4

Una autoridad sin cuerpo normativo no podrá utilizarse como fuente de una definición inexistente.

### Regla ARQ-R5

Los títulos de autoridades sin cuerpo podrán mantenerse como candidatos documentales para investigación transversal.

### Regla ARQ-R6

La autoridad semántica deberá demostrarse mediante evidencia normativa.

### Regla ARQ-R7

La ausencia de evidencia en un documento no autoriza inferencia terminológica.

---

## 42. Gate de calidad

| Control | Resultado |
|---|---|
| Inventario ARQ disponible | PASS |
| Autoridades ARQ identificadas | PASS — 18 |
| IDs vacíos | PASS — 0 |
| IDs duplicados | PASS — 0 |
| Extracción ejecutada | PASS |
| Fuentes procesadas | PASS — 18 |
| Primera extracción generada | PASS — 20 candidatos |
| Búsqueda semántica ampliada | PASS — 54 coincidencias |
| Falsos positivos identificados | PASS |
| Normalización gramatical controlada | PASS |
| Encabezados diferenciados de términos | PASS |
| Documentos sin evidencia investigados | PASS |
| Documentos sin cuerpo identificados | PASS — 12 |
| Documentos con cuerpo identificados | PASS — 6 |
| Definiciones inventadas | PASS — 0 |
| IDs MEF-DIC asignados | PASS — 0 |
| Corpus ARQ modificado por extracción | PASS — No |
| Cobertura normativa completa de ARQ | NO — hallazgo documentado |

---

## 43. Resultado cuantitativo consolidado

La Fase 9.3.6 deja el siguiente estado:

```text
FUENTES ARQ
Total:                              18

IDENTIDAD
IDs vacíos:                          0
IDs duplicados:                      0

CUERPO NORMATIVO
Con cuerpo:                          6
Sin cuerpo:                         12

EXTRACCIÓN INICIAL
Candidatos:                         20

EVIDENCIA AMPLIADA
Coincidencias semánticas:           54

CANONIZACIÓN
MEF-DIC asignados:                   0
```

---

## 44. Resultado cualitativo

La subfase obtiene:

```text
PASS TÉCNICO
CON HALLAZGO DE COBERTURA DOCUMENTAL ARQ
```

La extracción funcionó correctamente sobre las autoridades que contienen cuerpo normativo.

La ausencia de evidencia en doce documentos fue investigada.

La investigación confirmó que dichos documentos carecen actualmente de cuerpo normativo.

Por tanto, la ausencia de candidatos procedentes de ellos no deberá clasificarse como fallo del extractor.

---

## 45. Decisión sobre el extractor

No se autoriza ampliar indiscriminadamente el extractor con nuevas expresiones regulares para intentar obtener términos de documentos que carecen de cuerpo.

Las futuras mejoras del extractor deberán responder a evidencia real observada en el corpus.

El extractor deberá favorecer:

```text
precisión
sobre
cantidad artificial de candidatos
```

La reconstrucción del Diccionario V2 no será evaluada por el número bruto de términos extraídos.

---

## 46. Decisión sobre los doce documentos sin cuerpo

Los doce documentos conservarán su condición de autoridades documentales registradas.

Sus títulos podrán utilizarse para:

- búsquedas transversales;
- identificación de conceptos pendientes;
- comparación con ENG;
- comparación con FND;
- detección de referencias desde otros documentos.

No deberán utilizarse para generar definiciones inexistentes.

---

## 47. Decisión sobre los seis documentos con cuerpo

Los siguientes documentos quedan habilitados como fuentes directas de evidencia semántica ARQ:

```text
ARQ-004 — Modules
ARQ-010 — Template Engine
ARQ-011 — Contracts
ARQ-012 — Dependency Injection
ARQ-013 — Configuration
ARQ-017 — Packaging
```

Sus candidatos deberán pasar a una etapa posterior de:

```text
depuración
→ consolidación
→ validación semántica
→ contraste transversal
```

antes de cualquier canonización.

---

## 48. Relación con FND

La capa FND ya demostró que los documentos fundacionales pueden contener:

- conceptos;
- principios;
- declaraciones;
- autoridades;
- encabezados editoriales;
- definiciones explícitas.

La capa ARQ añade una diferencia relevante:

> La existencia formal de una autoridad arquitectónica no garantiza que su cuerpo normativo esté desarrollado.

Esta diferencia deberá conservarse durante la integración FND–ARQ.

---

## 49. Relación futura con ENG

La capa Ingeniería (`ENG`) será especialmente relevante para los conceptos cuya autoridad ARQ nominal carece de cuerpo.

ENG podrá aportar evidencia para conceptos como:

```text
Registry
Service Container
Event Bus
Kernel
Security
Framework Lifecycle
Extension Model
```

siempre que dicha evidencia exista realmente en el corpus.

ENG no deberá utilizarse para inventar retrospectivamente el contenido de una autoridad ARQ vacía.

Su función será aportar evidencia normativa complementaria y trazable.

---

## 50. Modelo de autoridad resultante

A partir de esta subfase, el proceso de reconstrucción utilizará el siguiente modelo:

```text
AUTORIDAD DOCUMENTAL
        │
        ├── tiene cuerpo normativo
        │       │
        │       └── analizar evidencia semántica
        │
        └── no tiene cuerpo normativo
                │
                └── buscar evidencia transversal
                        │
                        ├── FND
                        ├── otros ARQ
                        └── ENG
```

Sólo después de encontrar evidencia suficiente podrá evaluarse la promoción de un candidato.

---

## 51. Criterio de promoción futura

Un candidato arquitectónico no deberá promoverse a término canónico únicamente porque:

- coincide con el título de un documento;
- aparece repetidamente;
- está escrito en inglés;
- corresponde a un componente conocido;
- existía en DICCIONARIO V1;
- parece evidente por conocimiento técnico general.

La promoción deberá sustentarse en evidencia normativa del propio corpus MEF.

---

## 52. Criterio de autoridad futura

Cuando existan varias fuentes para un mismo candidato, la autoridad deberá determinarse considerando:

1. definición explícita;
2. responsabilidad explícita;
3. frontera semántica;
4. nivel documental;
5. especialización de la fuente;
6. consistencia transversal;
7. vigencia documental;
8. ausencia de contradicción normativa.

La existencia de múltiples fuentes deberá aumentar la trazabilidad, no producir definiciones independientes sin justificación.

---

## 53. Estado de la subfase

La Fase 9.3.6 se considera:

```text
COMPLETADA
```

en cuanto a:

- extracción inicial;
- diagnóstico del extractor;
- identificación de falsos positivos;
- normalización básica;
- búsqueda semántica ampliada;
- investigación de cobertura;
- diagnóstico de documentos sin cuerpo.

No se considera completada la canonización terminológica ARQ.

Esa actividad pertenece a etapas posteriores.

---

## 54. Decisión de avance

Se autoriza continuar con la depuración y validación de candidatos ARQ.

La siguiente actividad deberá:

1. eliminar candidatos puramente editoriales;
2. eliminar sujetos gramaticales sin identidad conceptual;
3. consolidar evidencias repetidas;
4. preservar los candidatos arquitectónicos fuertes;
5. identificar conceptos arquitectónicos pendientes;
6. buscar evidencia transversal para autoridades sin cuerpo;
7. mantener trazabilidad completa;
8. evitar todavía la asignación de identificadores `MEF-DIC`.

---

## 55. Condiciones para continuar

El avance posterior deberá respetar las siguientes condiciones:

```text
NO inventar definiciones
NO canonizar títulos automáticamente
NO usar DICCIONARIO V1 como autoridad
NO asignar MEF-DIC prematuramente
NO modificar ARQ para satisfacer al extractor
NO ocultar ausencia de cobertura
```

y:

```text
SÍ conservar evidencia
SÍ conservar procedencia
SÍ distinguir documento de concepto
SÍ buscar autoridad transversal
SÍ documentar ambigüedades
SÍ registrar hallazgos
```

---

## 56. Conclusión

La Fase 9.3.6 confirma que la reconstrucción del Diccionario Canónico MEF V2 no puede reducirse a extraer palabras desde nombres de archivos, títulos o encabezados.

La capa Arquitectura contiene:

```text
18 autoridades documentales
```

pero únicamente:

```text
6 autoridades con cuerpo normativo
```

mientras:

```text
12 autoridades carecen actualmente de cuerpo normativo
```

La búsqueda semántica sobre el contenido disponible produjo:

```text
54 coincidencias
```

concentradas en:

```text
ARQ-004
ARQ-010
ARQ-011
ARQ-012
ARQ-013
ARQ-017
```

La investigación permitió además distinguir entre:

```text
autoridad documental
```

y:

```text
autoridad semántica suficiente
```

Esta distinción es necesaria para evitar que el nuevo Diccionario herede definiciones inferidas, artificiales o sustentadas únicamente en nomenclatura documental.

La ausencia de cuerpo normativo constituye un hallazgo que deberá preservarse y resolverse mediante evidencia transversal o desarrollo normativo futuro.

Por tanto, la Fase 9.3.6 concluye con:

```text
PASS TÉCNICO
CON HALLAZGO DE COBERTURA DOCUMENTAL ARQ
```

y establece como principio final:

> El Diccionario deberá describir el MEF normativamente documentado, no un MEF inferido por el proceso de extracción.