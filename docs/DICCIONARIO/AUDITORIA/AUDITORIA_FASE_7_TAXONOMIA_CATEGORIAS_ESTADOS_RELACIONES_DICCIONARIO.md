# AUDITORÍA FASE 7 — NORMALIZACIÓN DE TAXONOMÍA DE CATEGORÍAS, ESTADOS Y RELACIONES

## 1. Identificación

- **Componente:** `docs/DICCIONARIO/`
- **Fase:** 7
- **Objeto:** taxonomía de Categorías, Estados y Relaciones
- **Fecha:** 2026-08-13
- **Corpus:** `MEF-DIC-0001` → `MEF-DIC-0070`
- **Correcciones aplicadas al corpus:** ninguna
- **Resultado:** TAXONOMÍA PROPUESTA Y AUDITADA / PENDIENTE DE APLICACIÓN CONTROLADA

---

## 2. Objetivo

Establecer una taxonomía terminológica coherente y verificable para tres dimensiones que actualmente presentan heterogeneidad:

1. `Categoría`
2. `Estado`
3. relaciones entre términos

La Fase 7 no modifica las 70 entradas. Define el contrato que deberá utilizarse posteriormente durante la corrección controlada.

---

# PARTE A — CATEGORÍAS

## 3. Inventario real de categorías existentes

La auditoría de las 70 entradas detectó cuatro valores de `Categoría` actualmente utilizados:

| Categoría | Entradas |
|---|---:|
| `Core` | 19 |
| `Arquitectura` | 10 |
| `Platform` | 2 |
| `Ingeniería` | 1 |
| **Sin categoría** | **38** |

Cobertura total:

```text
Categoría declarada   32 / 70
Sin categoría         38 / 70
```

No se detectaron otras categorías en las entradas canónicas.

---

## 4. Patrón estructural observado

Los documentos temáticos muestran un patrón suficientemente claro:

```text
DIC-001A — Arquitectura
    → las 10 entradas ya usan Categoría: Arquitectura

DIC-001B — Core y Ciclo de Vida
    → las 10 entradas ya usan Categoría: Core

DIC-001C — DI y Contratos
    → las primeras entradas clasificadas usan Core

DIC-001D — Sistema de Eventos
    → las entradas clasificadas usan Core

DIC-001E — Construcción y Generación
    → Builder ya usa Core

DIC-001F — Platform
    → Authentication y Cache ya usan Platform

DIC-001G — Desarrollo, Calidad y Extensibilidad
    → CLI ya usa Ingeniería
```

Esto permite identificar una taxonomía de categorías ya implícita en el corpus.

---

## 5. Taxonomía canónica propuesta de Categoría

Se propone un catálogo **cerrado** de cuatro categorías:

```yaml
categorias:
  - Arquitectura
  - Core
  - Platform
  - Ingeniería
```

### 5.1 Arquitectura

Conceptos que describen estructura, capas, límites y unidades arquitectónicas fundamentales.

Ejemplos actuales:

```text
Architecture
Layer
Core
Platform
Module
Application
Component
Capability
Boundary
Framework
```

### 5.2 Core

Conceptos que forman parte del núcleo tecnológico y sus mecanismos internos.

Incluye, por evidencia actual:

```text
Kernel
Bootstrap
Registry
Discovery
Manifest
Module Metadata
Module Lifecycle
Framework State
Boot Sequence
Boot Context
Dependency Injection
Contract
Interface
Container
Events
Builders
```

### 5.3 Platform

Servicios compartidos consumibles por Modules y Applications sin pertenecer a lógica de negocio.

Ejemplos:

```text
Authentication
Authorization
Cache
Scheduler
Notification
Audit
Logging
Localization
Configuration
Storage
```

### 5.4 Ingeniería

Conceptos relativos a construcción, evolución, tooling, calidad, gobernanza técnica y experiencia de desarrollo.

Ejemplos del bloque DIC-001G:

```text
CLI
SDK
Plugin
Extension
Marketplace
ADR
RFC
Testing
Semantic Versioning
Deprecation
```

---

## 6. Regla normativa para Categoría

```text
CAT-001  Todo MEF-DIC MUST declarar exactamente una Categoría primaria.
CAT-002  Categoría MUST pertenecer al catálogo oficial.
CAT-003  Un término MUST NOT crear categorías ad hoc.
CAT-004  Categoría representa dominio primario, no ubicación física.
CAT-005  Relación con otros dominios se expresa mediante Relaciones.
CAT-006  El nombre del archivo DIC no sustituye la Categoría.
CAT-007  La futura ampliación del catálogo requiere decisión documentada.
```

### Dictamen de Categorías

```text
CATÁLOGO ACTUAL IMPLÍCITO     IDENTIFICADO
NÚMERO DE CATEGORÍAS          4
COBERTURA                     32/70
TAXONOMÍA PROPUESTA           COHERENTE
APLICACIÓN                    PENDIENTE
```

---

# PARTE B — ESTADOS

## 7. Inventario real de Estados

Las 70 entradas poseen `Estado`, pero utilizan seis valores:

| Estado observado | Cantidad |
|---|---:|
| `Estable` | 55 |
| `Propuesto` | 10 |
| `Evolución futura` | 2 |
| `Opcional` | 1 |
| `No implementado` | 1 |
| `Visión futura` | 1 |

Cobertura:

```text
Estado presente    70/70
```

La cobertura es completa; la semántica no está normalizada.

---

## 8. Problema taxonómico de Estado

Los seis valores mezclan dimensiones diferentes:

```text
Estable
Propuesto
    → madurez / ciclo de aceptación

Opcional
    → obligatoriedad

No implementado
    → estado de implementación

Evolución futura
Visión futura
    → horizonte temporal / roadmap
```

Por tanto, un único campo `Estado` no debería representar simultáneamente:

```text
madurez
obligatoriedad
implementación
horizonte
```

---

## 9. Taxonomía canónica propuesta de Estado

Se propone reservar `Estado` exclusivamente para el **ciclo de vida terminológico**:

```yaml
estados:
  - Propuesto
  - Aceptado
  - Estable
  - Deprecado
  - Retirado
```

### Definiciones

#### Propuesto
El término existe como propuesta, pero su definición o adopción todavía puede cambiar materialmente.

#### Aceptado
El término fue aprobado como parte del lenguaje oficial, aunque todavía puede no considerarse suficientemente maduro o consolidado.

#### Estable
El término está aceptado, ampliamente consolidado y su significado no debería cambiar sin proceso formal.

#### Deprecado
El término permanece reconocible por compatibilidad, pero existe una alternativa canónica o se planea su retirada.

#### Retirado
El término ya no forma parte del vocabulario activo. Su ID no debe reutilizarse.

---

## 10. Dimensiones que NO deben permanecer dentro de Estado

Se recomienda separar, cuando sean necesarias:

```yaml
obligatoriedad:
  - Obligatorio
  - Opcional

implementacion:
  - Implementado
  - Parcial
  - No implementado

horizonte:
  - Actual
  - Futuro
  - Vision
```

Estas dimensiones son **opcionales** y sólo deben existir si el proyecto realmente necesita gobernarlas.

No deben agregarse a las 70 entradas automáticamente.

---

## 11. Casos que requieren migración semántica controlada

Los valores actuales:

```text
Opcional
No implementado
Evolución futura
Visión futura
```

no deben sustituirse automáticamente por `Propuesto`.

Antes de migrarlos deberá determinarse:

```text
Estado terminológico real
+
obligatoriedad / implementación / horizonte aplicable
```

Esto evita perder información.

---

## 12. Reglas normativas para Estado

```text
STA-001  Todo MEF-DIC MUST declarar Estado.
STA-002  Estado MUST representar ciclo de vida terminológico.
STA-003  Estado MUST usar un valor del catálogo cerrado.
STA-004  Obligatoriedad MUST NOT expresarse mediante Estado.
STA-005  Implementación MUST NOT expresarse mediante Estado.
STA-006  Roadmap/horizonte MUST NOT expresarse mediante Estado.
STA-007  Un ID Retirado MUST NOT reutilizarse.
STA-008  Cambios Estable → Deprecado/Retirado requieren trazabilidad.
```

### Dictamen de Estados

```text
COBERTURA                    PASS 70/70
VALORES                      6
SEMÁNTICA                    HETEROGÉNEA
CATÁLOGO NORMALIZADO         PROPUESTO
MIGRACIÓN AUTOMÁTICA         PROHIBIDA
```

---

# PARTE C — RELACIONES

## 13. Inventario estructural de relaciones

Las relaciones aparecen actualmente mediante varias formas:

```text
Componentes relacionados     3 entradas
Componentes                  1 entrada
Relación                     1 entrada
No confundir con            26 entradas
relaciones narrativas        múltiples
listas específicas           múltiples
```

Esto demuestra que el Diccionario posee relaciones semánticas, pero carece de un vocabulario relacional uniforme.

---

## 14. Problema del campo `Componentes relacionados`

`Componentes relacionados` es demasiado restrictivo.

Un término puede relacionarse con:

```text
otro Component
un proceso
un artefacto
un concepto
una política
un estado
una capacidad
```

Por ejemplo:

```text
Architecture → Kernel
Module Metadata → Manifest
Contract → Interface
Event → Command
Plugin → Module
```

No todos esos elementos son necesariamente `Componentes`.

Se recomienda sustituir conceptualmente el campo por:

```text
Relacionados
```

---

## 15. `No confundir con` debe conservar identidad propia

No debe fusionarse con `Relacionados`.

Ejemplo:

```text
Module
  Relacionados:
    Manifest
    Registry

  No confundir con:
    Plugin
    Package
    Application
```

`Relacionados` expresa proximidad conceptual.

`No confundir con` expresa una frontera semántica.

Son relaciones distintas.

---

## 16. Taxonomía canónica propuesta de Relaciones

Se propone comenzar con un conjunto pequeño y expresivo:

```yaml
relaciones:
  relacionados:
    cardinalidad: 0..n

  depende_de:
    cardinalidad: 0..n

  compuesto_por:
    cardinalidad: 0..n

  especializa:
    cardinalidad: 0..n

  no_confundir_con:
    cardinalidad: 0..n
```

### 16.1 Relacionados

Asociación semántica general cuando no existe una relación más específica.

```text
Registry ↔ Discovery
Event ↔ Event Dispatcher
Builder ↔ Generator
```

### 16.2 Depende de

El concepto requiere conceptualmente otro concepto para ser definido u operar correctamente.

```text
Autowiring → Container
Binding → Contract
```

Esta relación no equivale necesariamente a dependencia de código.

### 16.3 Compuesto por

El término representa una estructura que contiene o agrupa otros elementos conceptuales.

```text
Core → Kernel, Registry, Discovery...
Event Envelope → EventId, CorrelationId, CausationId...
```

### 16.4 Especializa

Un concepto representa una forma especializada de otro.

Ejemplo candidato:

```text
Integration Event → Event
```

La relación deberá usarse únicamente cuando la especialización haya sido validada semánticamente.

### 16.5 No confundir con

Frontera explícita contra términos próximos o conceptos que suelen confundirse.

```text
Authentication ≠ Authorization
Logging ≠ Audit
Module ≠ Plugin
Registry ≠ Repository
```

---

## 17. Relaciones NO incluidas inicialmente

No se recomienda introducir todavía un catálogo excesivamente grande como:

```text
implementa
usa
produce
consume
publica
registra
resuelve
contiene
orquesta
transforma
```

Estas relaciones pueden ser útiles en un futuro Knowledge Graph, pero hoy aumentarían complejidad sin evidencia de necesidad normativa suficiente.

La Fase 7 adopta el principio:

```text
mínimo vocabulario relacional suficiente
```

---

## 18. Identidad de los extremos de una relación

Siempre que exista un término MEF-DIC para el concepto relacionado, la futura normalización debería preferir su ID:

```text
MEF-DIC-0005 — Module
MEF-DIC-0015 — Manifest
```

en lugar de una cadena libre aislada:

```text
Module
Manifest
```

Modelo recomendado:

```yaml
relacionados:
  - id: MEF-DIC-0015
    termino: Manifest
```

Esto reduce ambigüedad y permite validación automática.

Cuando el concepto relacionado no posea `MEF-DIC`, puede mantenerse como referencia textual controlada.

---

## 19. Simetría de relaciones

No todas las relaciones deben ser simétricas.

```text
Relacionados
  puede ser simétrica conceptualmente

No confundir con
  SHOULD ser simétrica cuando ambos conceptos son MEF-DIC

Depende de
  NO es simétrica

Compuesto por
  NO es simétrica

Especializa
  NO es simétrica
```

Ejemplo:

```text
Authentication
No confundir con → Authorization
```

idealmente debería existir también:

```text
Authorization
No confundir con → Authentication
```

si ambos términos son canónicos.

---

## 20. Reglas normativas para Relaciones

```text
REL-001  Las relaciones SHOULD utilizar IDs MEF-DIC cuando existan.
REL-002  `Relacionados` expresa asociación, no frontera.
REL-003  `No confundir con` MUST permanecer semánticamente separado.
REL-004  `Depende de` representa dependencia conceptual, no de código.
REL-005  `Compuesto por` representa composición semántica.
REL-006  `Especializa` requiere una relación de generalización demostrable.
REL-007  No deberán inventarse relaciones sólo para completar una plantilla.
REL-008  Relaciones vacías SHOULD omitirse.
REL-009  Una relación MUST NOT contradecir la definición oficial.
REL-010  Relaciones nuevas deberán incorporarse al catálogo antes de utilizarse normativamente.
```

---

# PARTE D — TAXONOMÍA NORMALIZADA

## 21. Contrato propuesto

```yaml
categoria:
  enum:
    - Arquitectura
    - Core
    - Platform
    - Ingeniería

estado:
  enum:
    - Propuesto
    - Aceptado
    - Estable
    - Deprecado
    - Retirado

relaciones:
  relacionados: []
  depende_de: []
  compuesto_por: []
  especializa: []
  no_confundir_con: []

atributos_opcionales:
  obligatoriedad:
    enum:
      - Obligatorio
      - Opcional

  implementacion:
    enum:
      - Implementado
      - Parcial
      - No implementado

  horizonte:
    enum:
      - Actual
      - Futuro
      - Vision
```

Este contrato es una propuesta normativa de Fase 7; todavía no ha sido aplicado a las entradas.

---

## 22. Matriz de hallazgos

| ID | Hallazgo | Severidad | Estado |
|---|---|---:|---|
| F7-01 | 38 términos carecen de Categoría | Alta | ABIERTO |
| F7-02 | El corpus ya contiene cuatro categorías coherentes | — | PASS |
| F7-03 | Estado tiene cobertura 70/70 | — | PASS |
| F7-04 | Estado mezcla cuatro dimensiones semánticas | Crítica | ABIERTO |
| F7-05 | `Opcional` no es estado de ciclo de vida | Alta | ABIERTO |
| F7-06 | `No implementado` no es estado terminológico | Alta | ABIERTO |
| F7-07 | `Evolución futura` / `Visión futura` expresan horizonte | Alta | ABIERTO |
| F7-08 | Relaciones usan nombres de campos heterogéneos | Alta | ABIERTO |
| F7-09 | `Componentes relacionados` es demasiado restrictivo | Media | ABIERTO |
| F7-10 | `No confundir con` posee semántica propia | — | PASS |
| F7-11 | Relaciones deberían usar MEF-DIC cuando exista | Media | PROPUESTO |
| F7-12 | Falta contrato cerrado de relaciones | Alta | ABIERTO |

---

## 23. Decisiones propuestas para aprobación

### DEC-F7-01 — Categorías

Adoptar como catálogo cerrado:

```text
Arquitectura
Core
Platform
Ingeniería
```

### DEC-F7-02 — Estados

Reservar `Estado` para:

```text
Propuesto
Aceptado
Estable
Deprecado
Retirado
```

y separar obligatoriedad, implementación y horizonte cuando resulte necesario.

### DEC-F7-03 — Relaciones

Adoptar inicialmente:

```text
Relacionados
Depende de
Compuesto por
Especializa
No confundir con
```

### DEC-F7-04 — IDs en relaciones

Preferir:

```text
MEF-DIC-XXXX — Nombre
```

cuando el concepto relacionado ya tenga identidad oficial.

---

## 24. Correcciones prohibidas durante Fase 7

No se autoriza todavía:

- asignar automáticamente Categoría a las 38 entradas;
- cambiar todos los estados no canónicos a `Propuesto`;
- borrar información `Opcional`, `No implementado` o `Visión futura`;
- transformar relaciones por búsquedas/reemplazos globales;
- agregar relaciones inferidas sin revisión término por término;
- crear nuevos MEF-DIC;
- modificar IDs existentes;
- editar DIC-001A → DIC-001G antes de la fase de corrección.

---

## 25. Dictamen

```text
FASE 7 — TAXONOMÍA DE CATEGORÍAS, ESTADOS Y RELACIONES

CATEGORÍAS
Cobertura actual                    FAIL 32/70
Catálogo implícito                  IDENTIFICADO
Catálogo propuesto                  4 valores
Coherencia                          PASS

ESTADOS
Cobertura                           PASS 70/70
Consistencia semántica              FAIL
Dimensiones mezcladas               CRÍTICO
Catálogo propuesto                  5 estados

RELACIONES
Existencia                          PASS
Uniformidad                         FAIL
No confundir con                    VÁLIDO
Componentes relacionados            REQUIERE NORMALIZACIÓN
Catálogo relacional                 PROPUESTO

RESULTADO GENERAL:
TAXONOMÍA DEFINIDA Y AUDITADA
APLICACIÓN CONTROLADA PENDIENTE
```

---

## 26. Gate de salida

La Fase 7 puede considerarse cerrada como **AUDITORÍA Y DISEÑO TAXONÓMICO** si se aprueban las decisiones `DEC-F7-01` → `DEC-F7-04`.

Una vez aprobadas, la siguiente fase no debería volver a auditar la taxonomía. Debe comprobar la **coherencia global del Diccionario contra su contrato normativo consolidado** antes de iniciar correcciones masivas.

---

## 27. Siguiente fase recomendada

**FASE 8 — AUDITORÍA DE COHERENCIA NORMATIVA GLOBAL DEL DICCIONARIO**

Deberá consolidar los hallazgos de Fases 1–7 y determinar:

- qué hallazgos son bloqueantes;
- cuáles pueden corregirse automáticamente;
- cuáles requieren decisión humana;
- qué documentos legacy deben retirarse, fusionarse o archivarse;
- qué orden exacto deben seguir las correcciones;
- cuál será el baseline previo a la normalización final.

---

**Estado de Fase 7:** CERRADA COMO AUDITORÍA / TAXONOMÍA PROPUESTA PARA APROBACIÓN.
