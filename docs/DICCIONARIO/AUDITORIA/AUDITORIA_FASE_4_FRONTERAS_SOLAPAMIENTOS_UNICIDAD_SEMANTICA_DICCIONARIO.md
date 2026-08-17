# AUDITORÍA FASE 4 — FRONTERAS, SOLAPAMIENTOS Y UNICIDAD SEMÁNTICA DEL DICCIONARIO

## 1. Identificación

- **Componente auditado:** `docs/DICCIONARIO/`
- **Fase:** 4
- **Objeto:** fronteras conceptuales, solapamientos y unicidad semántica
- **Fecha:** 2026-08-13
- **Corpus:** `MEF-DIC-0001` → `MEF-DIC-0070`
- **Correcciones aplicadas durante esta fase:** ninguna

---

## 2. Objetivo

Verificar que los 70 términos canónicos del Diccionario:

1. representen conceptos distinguibles;
2. no posean definiciones duplicadas;
3. tengan fronteras suficientes frente a conceptos cercanos;
4. no absorban responsabilidades de otros términos;
5. utilicen correctamente relaciones del tipo `No confundir con`;
6. permitan identificar una autoridad terminológica única por concepto.

La fase analiza únicamente el corpus `DIC-001A` → `DIC-001G`.  
Los conflictos históricos de `DICCIONARIO_MEF.md` e `INDICE.md` permanecen registrados por Fases 2 y 3.

---

## 3. Resultado ejecutivo

```text
Términos canónicos auditados       70
IDs canónicos                      70
Nombres exactos duplicados          0
Definiciones literalmente iguales  0
Colisiones semánticas totales       0
Fronteras sólidas                  mayoritarias
Fronteras a reforzar                8 grupos
Solapamientos críticos              1 grupo
```

El corpus no presenta duplicidad semántica total entre los 70 términos.

El principal problema no es la existencia de dos conceptos idénticos, sino que varias parejas o familias necesitan expresar mejor su relación de especialización, composición, mecanismo o artefacto.

---

## 4. Criterio de clasificación

Cada relación fue clasificada como:

```text
PASS
Conceptos suficientemente distinguibles.

PASS CON REFORZAMIENTO
La diferencia se entiende, pero no está formalizada de manera simétrica.

SOLAPAMIENTO CONTROLADO
Existe intersección legítima de alcance que requiere una frontera explícita.

SOLAPAMIENTO ALTO
Dos términos pueden ser interpretados como equivalentes o como autoridades concurrentes.
```

---

## 5. Arquitectura base — MEF-DIC-0001 → 0010

### F4-01 — Architecture / Framework

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

`Architecture` describe la estructura conceptual y las dependencias permitidas.

`Framework` describe MEF como producto/plataforma tecnológica.

La distinción existe, pero `Framework` enumera arquitectura, componentes y convenciones, por lo que puede confundirse con la definición del sistema completo.

Frontera recomendada para corrección futura:

```text
Architecture → estructura y reglas organizativas de MEF.
Framework    → producto/sistema que adopta esa Architecture.
```

No deben fusionarse.

---

### F4-02 — Layer / Core / Platform / Module / Application

**Estado:** PASS

La relación está suficientemente diferenciada:

```text
Layer       → nivel arquitectónico.
Core        → núcleo tecnológico.
Platform    → servicios compartidos.
Module      → unidad funcional independiente de negocio.
Application → producto final construido con MEF.
```

El corpus incluye además fronteras explícitas `Core ≠ Platform ≠ Module` y `Module ≠ Application`.

No se recomienda fusionar ninguno de estos términos.

---

### F4-03 — Component / Module

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

`Component` es una unidad de software genérica con responsabilidad e interfaz.

`Module` es una unidad funcional independiente y extensión oficial de MEF.

La relación implícita es:

```text
Module puede contener Components.
Component no equivale a Module.
```

La definición actual de `Component` dice que puede formar parte de Core, Platform o Modules, lo cual permite distinguirlos, pero `Module` debería aparecer explícitamente en su frontera o relación canónica.

---

### F4-04 — Capability / Module / Component

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

`Capability` describe **qué puede hacer** el Framework o un Module.

`Component` y `Module` son unidades estructurales.

Frontera correcta:

```text
Capability = capacidad ofrecida.
Module/Component = elemento que implementa o expone capacidades.
```

La separación conceptual es válida y debe preservarse.

---

### F4-05 — Boundary / Layer

**Estado:** PASS

`Layer` agrupa componentes.

`Boundary` restringe las interacciones permitidas entre capas o componentes.

No existe equivalencia ni absorción conceptual.

---

## 6. Core y ciclo de vida — MEF-DIC-0011 → 0020

### F4-06 — Kernel / Bootstrap / Boot Sequence

**Estado:** PASS

El corpus ya contiene una frontera adecuada:

```text
Kernel        → coordinador principal.
Bootstrap     → proceso de inicialización.
Boot Sequence → secuencia ordenada de pasos del Bootstrap.
```

La propia sección de decisiones declara que Bootstrap es un proceso, no un componente.

No deben fusionarse.

---

### F4-07 — Registry / Discovery

**Estado:** PASS FUERTE

El Diccionario expresa explícitamente:

```text
Discovery descubre.
Registry registra.
```

Además, Discovery declara:

```text
No registra.
No inicializa.
```

La frontera es clara, simple y normativamente útil.

---

### F4-08 — Manifest / Module Metadata

**Estado:** PASS FUERTE

La separación es correcta:

```text
Manifest        → documento declarativo.
Module Metadata → representación validada en memoria del Manifest.
```

El propio corpus declara que ambos representan niveles distintos de información.

No deben fusionarse.

---

### F4-09 — Module Lifecycle / Framework State

**Estado:** PASS FUERTE

La distinción está correctamente declarada:

```text
Module Lifecycle → estados de un módulo.
Framework State  → estado operativo global de MEF.
```

La sección de decisiones confirma que son conceptos independientes.

---

### F4-10 — Bootstrap / Boot Sequence / Boot Context

**Estado:** PASS

```text
Bootstrap     → proceso.
Boot Sequence → orden de etapas.
Boot Context  → objeto compartido entre esas etapas.
```

No se detecta solapamiento material.

---

## 7. DI, Contracts y Container — MEF-DIC-0021 → 0030

### F4-11 — Contract / Interface

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

La distinción declarada es:

```text
Contract  → acuerdo semántico/comportamiento esperado.
Interface → mecanismo PHP usado para expresar un Contract.
```

La frase “todos los Contracts se implementan mediante interfaces” puede inducir a tratarlos como equivalentes.

Debe mantenerse explícito:

```text
Contract ≠ Interface

Contract es concepto arquitectónico.
Interface es representación técnica del Contract.
```

---

### F4-12 — Dependency Injection / Container / Binding / Autowiring

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

Las cuatro piezas son complementarias:

```text
Binding              → asociación Contract → Implementation.
Container            → resuelve/construye objetos.
Autowiring           → estrategia automática de resolución.
Dependency Injection → entrega dependencias al consumidor.
```

La frontera general es correcta, aunque el corpus actual atribuye al Container “resolver dependencias y construir objetos” y a DI el acto de recibir dependencias. Conviene mantener esa separación en forma de cláusula explícita.

---

### F4-13 — Singleton / Scoped Service / Transient Service

**Estado:** PASS

Son tres estrategias distintas de ciclo de vida de servicios:

```text
Singleton → una instancia compartida.
Scoped    → una instancia por scope.
Transient → una instancia por resolución.
```

No existe solapamiento semántico.

---

### F4-14 — Value Object frente a servicios de DI

**Estado:** PASS

`Value Object` pertenece al modelado de conceptos por valor y no compite con Container, Binding o ciclos de vida.

---

## 8. Sistema de Eventos — MEF-DIC-0031 → 0040

### F4-15 — Event / Integration Event

**Estado:** SOLAPAMIENTO CONTROLADO  
**Severidad:** Media/Alta

`Event` representa un hecho ya ocurrido dentro del Framework o de un módulo.

`Integration Event` es un evento diseñado para sistemas externos.

La relación conceptual parece ser de especialización:

```text
Integration Event ⊂ familia Event
```

pero el corpus afirma también que no necesariamente representa el mismo objeto que un Event interno.

Debe formalizarse:

```text
Event             → concepto general/interno de hecho.
Integration Event → contrato de evento para integración externa.
```

No deben considerarse sinónimos ni necesariamente la misma instancia serializada.

---

### F4-16 — Event Listener / Event Subscriber

**Estado:** PASS

La frontera es clara:

```text
Listener   → reacciona a un Event específico.
Subscriber → agrupa múltiples Listeners relacionados.
```

El término Listener además incluye `Subscriber` en “No confundir con”.

---

### F4-17 — Event Envelope / EventId / CorrelationId / CausationId

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Baja/Media

`Event Envelope` es el contenedor de metadatos.

`EventId`, `CorrelationId` y `CausationId` son identificadores con finalidades distintas.

Frontera recomendada:

```text
EventId       → identidad del evento.
CorrelationId → agrupa eventos del mismo flujo.
CausationId   → identifica la causa inmediata.
Envelope      → transporta esos metadatos.
```

El modelo es coherente y no requiere fusionar términos.

---

### F4-18 — Event Store / Event

**Estado:** PASS

`Event Store` es un repositorio especializado; `Event` es el hecho almacenado.

No existe conflicto de autoridad.

---

## 9. Construcción y generación — MEF-DIC-0041 → 0050

### F4-19 — Builder / Generator

**Estado:** PASS FUERTE

El Diccionario ya los distingue:

```text
Builder   → construye un tipo específico de artefacto.
Generator → coordina uno o varios Builders.
```

Ambos incluyen o implican una frontera directa.

---

### F4-20 — Builder Pipeline / Generator

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

Ambos coordinan procesos múltiples:

- `Builder Pipeline` = secuencia ordenada de Builders.
- `Generator` = componente de alto nivel que coordina uno o varios Builders.

Existe solapamiento de orquestación.

Debe establecerse:

```text
Generator puede invocar/poseer un Builder Pipeline.
Builder Pipeline define orden.
Generator define intención/orquestación de alto nivel.
```

No se recomienda fusionarlos.

---

### F4-21 — Template / Stub

**Estado:** SOLAPAMIENTO ALTO  
**Severidad:** ALTA

Las definiciones actuales son muy cercanas:

```text
Template
Documento base que define la estructura de un archivo generado.
Puede contener marcadores.

Stub
Archivo de plantilla utilizado como base para generar código fuente.
Generalmente contiene marcadores.
```

La frontera no está formalmente establecida.

El corpus sugiere una especialización plausible:

```text
Template → concepto general de plantilla.
Stub     → Template especializado en código fuente.
```

Pero esta relación no está declarada normativamente.

**Este es el solapamiento semántico interno más importante de Fase 4.**

No deben fusionarse todavía; primero debe decidirse si `Stub` es formalmente un subtipo de `Template`.

---

### F4-22 — Template Engine / Generator

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

```text
Template Engine → interpreta/renderiza plantillas.
Generator       → coordina el proceso completo de generación.
```

La diferencia existe pero debe reforzarse para impedir que Generator se convierta en sinónimo de Template Engine.

---

### F4-23 — Artifact / Scaffold

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Media

`Artifact` es cualquier resultado de Builder/Generator.

`Scaffold` es un conjunto inicial de archivos y directorios.

La relación natural es:

```text
Scaffold = resultado compuesto / conjunto de Artifacts.
```

El corpus no lo declara explícitamente.

---

### F4-24 — Workspace / Artifact

**Estado:** PASS

Workspace es el lugar temporal de producción; Artifact es el resultado producido.

---

## 10. Platform — MEF-DIC-0051 → 0060

### F4-25 — Authentication / Authorization

**Estado:** PASS FUERTE

La frontera está expresada mediante preguntas complementarias:

```text
Authentication → ¿Quién eres?
Authorization  → ¿Qué puedes hacer?
```

No se requiere fusión ni redefinición.

---

### F4-26 — Audit / Logging

**Estado:** PASS FUERTE

El corpus declara explícitamente que representan responsabilidades distintas:

```text
Audit   → acciones relevantes / trazabilidad / cumplimiento.
Logging → información técnica / diagnóstico / operación.
```

`Logging` además incluye `Audit` en “No confundir con”.

---

### F4-27 — Cache / Storage

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Baja/Media

Cache almacena temporalmente información para optimización.

Storage abstrae sistemas de almacenamiento.

Aunque ambos almacenan información:

```text
Cache   → optimización temporal.
Storage → abstracción de persistencia/almacenamiento.
```

Conviene incluir la frontera explícita para evitar que una implementación de cache respaldada por almacenamiento persistente diluya la diferencia conceptual.

---

### F4-28 — Localization

**Estado:** PASS DENTRO DEL DICCIONARIO ACTUAL

En este corpus `Localization` significa adaptación a idiomas, regiones y configuraciones culturales.

No colisiona con otro término `MEF-DIC`.

**Observación:** su relación con Data Localization/Residency pertenece a coherencia transversal DIC ↔ ENG y no constituye duplicidad interna de los 70 términos.

---

## 11. Desarrollo, calidad y extensibilidad — MEF-DIC-0061 → 0070

### F4-29 — Module / Plugin / Extension

**Estado:** SOLAPAMIENTO CONTROLADO  
**Severidad:** ALTA

Definiciones actuales:

```text
Module
unidad funcional independiente;
unidad oficial de extensión de MEF.

Plugin
componente opcional que amplía un módulo o servicio existente.

Extension
mecanismo mediante el cual MEF permite ampliar capacidades existentes.
```

El término `Module` utiliza “extensión” como función; `Plugin` representa un componente de extensión; `Extension` representa el mecanismo.

La frontera debe quedar formalmente:

```text
Module    → unidad funcional autónoma.
Plugin    → artefacto/componente concreto que extiende algo existente.
Extension → mecanismo o capacidad de extensión, no artefacto.
```

Actualmente `Plugin` sí indica “No confundir con Module”, pero `Extension` no define su frontera con `Plugin`.

---

### F4-30 — Plugin / Extension

**Estado:** SOLAPAMIENTO ALTO  
**Severidad:** ALTA

Es la segunda pareja de mayor riesgo tras Template/Stub.

Sin una cláusula explícita, un lector puede interpretar ambos como sinónimos de “extensión”.

Debe resolverse en corrección controlada:

```text
Plugin ≠ Extension

Plugin    → unidad concreta instalable/cargable, si así lo define MEF.
Extension → mecanismo/punto/capacidad mediante la cual ocurre la ampliación.
```

La formulación final deberá ser compatible con las autoridades ENG-029 y ENG-060 ya cerradas.

---

### F4-31 — ADR / RFC

**Estado:** PASS FUERTE

La separación temporal y funcional es adecuada:

```text
RFC → propone/discute un cambio antes de implementación.
ADR → registra una decisión arquitectónica y su justificación.
```

No deben fusionarse.

---

### F4-32 — Semantic Versioning / Deprecation

**Estado:** PASS

Semantic Versioning comunica impacto de versiones.

Deprecation define transición controlada hacia obsolescencia/eliminación.

Son mecanismos complementarios, no equivalentes.

---

### F4-33 — SDK / CLI

**Estado:** PASS CON REFORZAMIENTO  
**Severidad:** Baja/Media

CLI es una interfaz de comandos.

SDK es un conjunto de herramientas, bibliotecas, contratos y utilidades para desarrolladores.

La CLI podría formar parte del ecosistema de herramientas del SDK, pero no debe ser asumida como sinónimo o subconjunto sin declaración explícita.

---

## 12. Unicidad nominal

Se verificó:

```text
70 IDs
70 nombres canónicos
0 nombres exactos duplicados
```

No existen dos entradas canónicas con el mismo nombre.

La colisión nominal detectada en `DICCIONARIO_MEF.md` pertenece al baseline legacy y ya está controlada por F2/F3.

---

## 13. Cobertura de “No confundir con”

El corpus usa `No confundir con` de forma útil, pero no sistemática.

Existen fronteras bien documentadas para:

```text
Core / Platform / Module
Module / Plugin / Application
Kernel / Bootstrap
Registry / Repository / Database / Cache
Discovery / Registry / Builder
Manifest / Metadata
DI / Service Locator / Factory
Container / Registry / Service Locator
Event / Command / Action / Request
Listener / Subscriber / Observer
Builder / Factory / Generator
Generator / Builder
Authentication / Authorization
Logging / Audit
Plugin / Module / Package
```

Sin embargo, varias parejas de alto riesgo carecen de frontera simétrica:

```text
Architecture / Framework
Component / Module
Contract / Interface
Builder Pipeline / Generator
Template / Stub
Template Engine / Generator
Artifact / Scaffold
Cache / Storage
Plugin / Extension
SDK / CLI
```

---

## 14. Matriz de hallazgos

| ID | Relación | Severidad | Estado |
|---|---|---:|---|
| F4-01 | Architecture / Framework | Media | REFORZAR |
| F4-03 | Component / Module | Media | REFORZAR |
| F4-04 | Capability / Module / Component | Media | REFORZAR |
| F4-11 | Contract / Interface | Media | REFORZAR |
| F4-12 | DI / Container / Binding / Autowiring | Media | REFORZAR |
| F4-15 | Event / Integration Event | Media/Alta | SOLAPAMIENTO CONTROLADO |
| F4-17 | Envelope / EventId / CorrelationId / CausationId | Baja/Media | REFORZAR |
| F4-20 | Builder Pipeline / Generator | Media | REFORZAR |
| F4-21 | Template / Stub | **Alta** | **SOLAPAMIENTO ALTO** |
| F4-22 | Template Engine / Generator | Media | REFORZAR |
| F4-23 | Artifact / Scaffold | Media | REFORZAR |
| F4-27 | Cache / Storage | Baja/Media | REFORZAR |
| F4-29 | Module / Plugin / Extension | Alta | SOLAPAMIENTO CONTROLADO |
| F4-30 | Plugin / Extension | **Alta** | **SOLAPAMIENTO ALTO** |
| F4-33 | SDK / CLI | Baja/Media | REFORZAR |

---

## 15. Fronteras consideradas sólidas

Se consideran suficientemente diferenciadas:

```text
Layer / Core / Platform / Module / Application
Kernel / Bootstrap / Boot Sequence
Registry / Discovery
Manifest / Module Metadata
Module Lifecycle / Framework State
Bootstrap / Boot Context
Singleton / Scoped / Transient
Event Listener / Event Subscriber
Event Store / Event
Builder / Generator
Workspace / Artifact
Authentication / Authorization
Audit / Logging
ADR / RFC
Semantic Versioning / Deprecation
```

---

## 16. Correcciones que NO deben aplicarse todavía

No se autoriza en Fase 4:

- fusionar términos;
- eliminar IDs;
- renumerar `MEF-DIC-*`;
- convertir `Stub` automáticamente en alias de `Template`;
- convertir `Plugin` en alias de `Extension`;
- reescribir definiciones;
- agregar relaciones no aprobadas;
- alterar `No confundir con`;
- usar las observaciones de Ingeniería para sobreescribir el Diccionario antes de la fase de correcciones.

---

## 17. Dictamen

```text
FASE 4 — FRONTERAS, SOLAPAMIENTOS Y UNICIDAD SEMÁNTICA

IDs canónicos                           PASS
Nombres únicos                          PASS
Duplicidad semántica total             PASS — 0
Fronteras principales                  PASS
Fronteras incompletas                  PRESENTES
Solapamientos controlados              PRESENTES
Template / Stub                        REQUIERE RESOLUCIÓN
Plugin / Extension                     REQUIERE RESOLUCIÓN
Autoridad terminológica única          POSIBLE, NO CERRADA

RESULTADO GENERAL:
PASS CON HALLAZGOS SEMÁNTICOS
```

El corpus de 70 términos es recuperable sin renumeración ni eliminación masiva.

La auditoría no detecta necesidad de reconstruir el Diccionario desde cero.  
La mayoría de los conceptos posee identidad propia; los problemas se concentran en fronteras que deberán expresarse formalmente.

---

## 18. Gate de salida

Fase 4 queda **AUDITADA Y DOCUMENTADA**.

Hallazgos de máxima prioridad para corrección posterior:

```text
F4-21 — Template / Stub
F4-30 — Plugin / Extension
F4-15 — Event / Integration Event
F4-29 — Module / Plugin / Extension
```

Los demás hallazgos requieren principalmente reforzamiento de fronteras.

---

## 19. Siguiente fase recomendada

**FASE 5 — AUDITORÍA DE CONSISTENCIA TERMINOLÓGICA Y NOMENCLATURA GLOBAL**

Deberá comprobar:

- español vs. inglés;
- singular/plural;
- capitalización;
- acrónimos;
- nombres compuestos;
- uso uniforme de `Framework`, `Module`, `Core`, `Platform`, etc.;
- variantes como `Module Metadata` / `ModuleMetadata`;
- `EventId`, `CorrelationId`, `CausationId`;
- consistencia entre títulos, definiciones, resúmenes y referencias;
- nomenclatura canónica que deberán utilizar FND, ARQ y ENG.

---

**Estado Fase 4:** CERRADA COMO AUDITORÍA / HALLAZGOS ABIERTOS PARA CORRECCIÓN CONTROLADA.
