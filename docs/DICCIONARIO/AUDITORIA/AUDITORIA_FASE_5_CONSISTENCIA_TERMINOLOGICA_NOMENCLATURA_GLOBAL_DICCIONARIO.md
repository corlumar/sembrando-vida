# AUDITORÍA FASE 5 — CONSISTENCIA TERMINOLÓGICA Y NOMENCLATURA GLOBAL

## 1. Identificación

- **Componente auditado:** `docs/DICCIONARIO/`
- **Fase:** 5
- **Objeto:** consistencia terminológica y nomenclatura global
- **Fecha:** 2026-08-13
- **Corpus canónico:** `MEF-DIC-0001` → `MEF-DIC-0070`
- **Fuentes de contraste:** Fundación, Arquitectura e Ingeniería, con énfasis en `ENG-005 — Nomenclatura`
- **Correcciones aplicadas durante esta fase:** ninguna

---

## 2. Objetivo

Verificar que el Diccionario utilice de forma consistente:

- nombre oficial de MEF;
- idioma de términos canónicos;
- singular y plural;
- capitalización;
- acrónimos;
- nombres compuestos;
- formas conceptuales frente a representaciones técnicas;
- nombres utilizados en títulos, definiciones, resúmenes y relaciones;
- términos reservados y nomenclatura ya gobernada por Ingeniería.

La fase no modifica documentos. Los hallazgos se reservan para correcciones controladas.

---

## 3. Norma de contraste

`ENG-005 — Nomenclatura` establece criterios relevantes para esta auditoría:

```text
- las identidades oficiales deben respetarse;
- los IDs deben ser únicos;
- deben utilizarse términos definidos por MEF;
- deben evitarse abreviaturas ambiguas;
- debe separarse identidad conceptual de representación tecnológica;
- los tipos y artefactos individuales utilizan singular;
- las colecciones utilizan plural;
- debe evitarse Naming Drift;
- debe evitarse Mixed Language sin una política clara;
- los términos reservados no deben redefinirse con significados incompatibles.
```

La Fase 5 utiliza esas reglas como contraste, sin convertir automáticamente las convenciones de implementación en reglas editoriales del Diccionario.

---

## 4. Resultado ejecutivo

```text
Identidad MEF                      FAIL CRÍTICO
IDs MEF-DIC                       PASS
Nombres canónicos únicos          PASS
Singularidad de entradas          PASS
Acrónimos principales             PASS CON OBSERVACIONES
Capitalización canónica           PASS CON OBSERVACIONES
Idioma del corpus                 MIXTO — SIN POLÍTICA EXPLÍCITA
Nombres compuestos                PASS PARCIAL
Forma conceptual vs técnica       REQUIERE NORMALIZACIÓN
Naming Drift interno              PRESENTE, LIMITADO
Naming Drift legacy               PRESENTE, YA CONTROLADO

RESULTADO GENERAL:
PASS CON HALLAZGO CRÍTICO DE IDENTIDAD
Y HALLAZGOS DE NORMALIZACIÓN TERMINOLÓGICA
```

---

## 5. Hallazgos

### F5-01 — Expansión incorrecta del acrónimo MEF en `MEF-DIC-0010 Framework`

**Severidad:** CRÍTICA  
**Estado:** ABIERTO

El Diccionario define:

```text
MEF (Modular ERP Framework)
```

mientras el corpus vigente de Fundación, Arquitectura e Ingeniería utiliza de forma sistemática:

```text
MEF (Modular Enterprise Framework)
```

La Carta del Proyecto, la Visión, la Misión y numerosos documentos ARQ/ENG utilizan `Modular Enterprise Framework`.

En el consolidado FND/ARQ/ENG se detectan más de cien usos de `Modular Enterprise Framework` y no se detectó `Modular ERP Framework`.

Por tanto:

```text
Modular Enterprise Framework = identidad vigente
Modular ERP Framework        = deriva terminológica en DIC-0010
```

**Impacto:** afecta la identidad del producto, no sólo estilo editorial.

**Acción futura obligatoria:** corregir `MEF-DIC-0010` durante la fase de correcciones controladas, preservando el ID `MEF-DIC-0010`.

---

### F5-02 — Política de idioma no explicitada para los términos canónicos

**Severidad:** ALTA  
**Estado:** ABIERTO

El Diccionario está redactado predominantemente en español, pero los nombres canónicos son mayoritariamente ingleses:

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
Kernel
Bootstrap
Registry
Discovery
Manifest
Module Metadata
...
```

Esto no es necesariamente incorrecto. De hecho, Ingeniería utiliza extensamente la misma terminología inglesa.

El problema es que el Diccionario no declara una política como:

```text
Nombre canónico técnico: inglés
Definición y explicación: español
Traducción: descriptiva, no alias canónico
```

`ENG-005` identifica `Mixed Language` como riesgo cuando se mezclan idiomas sin política clara.

**Resultado:** no se recomienda traducir los 70 términos; se recomienda definir primero la política lingüística oficial.

---

### F5-03 — Alternancia español/inglés dentro del mismo dominio de generación

**Severidad:** MEDIA  
**Estado:** ABIERTO

En `DIC-001E` aparecen simultáneamente formas como:

```text
Builders
Generadores
Plantillas
Stubs
```

mientras los términos canónicos son:

```text
Builder
Generator
Template
Stub
```

En otras secciones vuelven a utilizarse formas inglesas pluralizadas:

```text
Builders
Generators
Templates
```

El uso plural en prosa es legítimo, pero la alternancia `Generator / Generadores` y `Template / Plantillas` introduce Naming Drift editorial.

**Acción futura:** decidir si la prosa debe:

A. conservar siempre el término canónico inglés (`Generator`, `Template`), incluso dentro de texto español; o  
B. permitir traducción descriptiva, pero marcando la primera aparición con el término canónico.

---

### F5-04 — `Notification` vs `Notifications`

**Severidad:** BAJA/MEDIA  
**Estado:** ABIERTO

El término canónico es:

```text
MEF-DIC-0055 — Notification
```

y así aparece en su resumen.

Sin embargo, `Platform` enumera entre sus ejemplos:

```text
Notifications
```

La forma plural puede ser una referencia colectiva, pero dentro de una lista de nombres de servicios/capacidades mezcla singular y plural:

```text
Authentication
Authorization
Audit
Cache
Notifications
Scheduler
```

**Acción futura:** si la lista pretende enumerar nombres canónicos, usar `Notification`; si pretende describir capacidades genéricas, documentar que no es una lista de identidades terminológicas.

---

### F5-05 — `Module Metadata` vs `ModuleMetadata`

**Severidad:** MEDIA  
**Estado:** ABIERTO / LEGACY

El nombre canónico vigente es:

```text
MEF-DIC-0016 — Module Metadata
```

y el propio resumen/decisiones de `DIC-001B` utiliza `Module Metadata`.

No obstante, el documento legacy `DICCIONARIO_MEF.md` contiene:

```text
ModuleMetadata
```

como componente relacionado.

El corpus FND/ARQ/ENG consultado utiliza `Module Metadata` y no mostró `ModuleMetadata` como término documental canónico.

**Conclusión:**

```text
Forma humana/canónica del concepto: Module Metadata
ModuleMetadata: representación técnica posible, pero no nombre terminológico oficial
```

Este hallazgo refuerza la decisión de no considerar `DICCIONARIO_MEF.md` autoridad concurrente.

---

### F5-06 — Conceptos `EventId`, `CorrelationId`, `CausationId` frente a campos técnicos camelCase

**Severidad:** MEDIA  
**Estado:** REQUIERE REGLA

El Diccionario define como nombres conceptuales:

```text
EventId
CorrelationId
CausationId
```

Mientras Ingeniería utiliza representaciones técnicas como:

```text
eventId
correlationId
causationId
```

No existe contradicción necesaria. Son niveles distintos:

```text
EventId       = concepto / tipo terminológico
eventId       = nombre de campo técnico
```

`ENG-005` exige separar identidad conceptual de representación tecnológica.

**Acción futura:** formalizar esta distinción en el README del Diccionario para evitar convertir accidentalmente camelCase de código en nombre terminológico o viceversa.

---

### F5-07 — Acrónimos CLI, SDK, ADR y RFC correctamente expandidos, pero sin política uniforme de primera aparición

**Severidad:** BAJA/MEDIA  
**Estado:** PASS CON OBSERVACIÓN

El corpus contiene:

```text
CLI (Command Line Interface)
Software Development Kit (SDK)
ADR (Architecture Decision Record)
RFC (Request for Comments)
Dependency Injection (DI)
```

La intención es clara y no hay colisiones.

Sin embargo, el orden no es uniforme:

```text
CLI (Command Line Interface)
Software Development Kit (SDK)
ADR (Architecture Decision Record)
RFC (Request for Comments)
Dependency Injection (DI)
```

Se alternan los patrones:

```text
ACRÓNIMO (expansión)
expansión (ACRÓNIMO)
```

**Acción futura recomendada:** definir un patrón único de presentación inicial, por ejemplo:

```text
Nombre completo (ACRÓNIMO)
```

sin modificar el nombre corto canónico cuando éste sea el término oficial (`CLI`, `SDK`, `ADR`, `RFC`).

---

### F5-08 — `DI` e `IoC`: relación no terminológicamente gobernada

**Severidad:** MEDIA  
**Estado:** ABIERTO

`DIC-001C` declara que cubre:

```text
Inversión de Control (IoC)
Inyección de Dependencias (DI)
```

pero sólo `Dependency Injection (DI)` posee entrada `MEF-DIC`.

`IoC` aparece como contexto, no como término canónico independiente.

Esto puede ser correcto si MEF decide:

```text
IoC = principio relacionado
DI  = mecanismo canónico especificado
```

pero la relación no está declarada explícitamente.

**Acción futura:** decidir si IoC:

- requiere entrada propia;
- queda como concepto relacionado no gobernado por ID;
- o se incorpora como relación explícita de `MEF-DIC-0021`.

No crear un nuevo ID durante esta fase.

---

### F5-09 — Singular/plural de nombres canónicos

**Severidad:** N/A  
**Estado:** PASS

Las 70 entradas canónicas están, en general, expresadas como conceptos o artefactos individuales:

```text
Module
Contract
Event
Builder
Generator
Template
Artifact
Plugin
Extension
```

Esto es consistente con `ENG-005`, que exige singular para tipos y artefactos individuales.

Los plurales presentes en prosa (`Modules`, `Builders`, `Generators`, `Templates`, etc.) pueden representar colecciones o referencias genéricas y no constituyen por sí solos un defecto.

**Excepción puntual:** `Notifications` en una lista que aparenta enumerar nombres canónicos, registrada como F5-04.

---

### F5-10 — Nombres de documentos fuente en plural no implican cambio del término canónico

**Severidad:** N/A  
**Estado:** PASS

Ejemplos:

```text
ARQ-004 — Modules
ARQ-009 — Builders
```

frente a:

```text
MEF-DIC-0005 — Module
MEF-DIC-0041 — Builder
```

No se considera inconsistencia terminológica.

El documento arquitectónico puede gobernar una familia o subsistema en plural, mientras el Diccionario define el concepto individual en singular.

---

### F5-11 — Capitalización de términos reservados principales

**Severidad:** BAJA  
**Estado:** PASS CON OBSERVACIONES

Los términos:

```text
Core
Platform
Kernel
Registry
Module
Contract
Manifest
Framework
```

se utilizan mayoritariamente con capitalización consistente cuando representan conceptos MEF.

`ENG-005` los trata como ejemplos de términos reservados que no deben redefinirse con significados incompatibles.

No se detectó una colisión global de capitalización que justifique renombrado.

La prosa en español utiliza ocasionalmente formas comunes en minúscula (`módulo`, `evento`, etc.); esto puede ser correcto cuando no se pretende invocar el término canónico como identidad.

---

### F5-12 — `Framework` como nombre conceptual y como sustantivo genérico

**Severidad:** MEDIA  
**Estado:** ABIERTO

Existe `MEF-DIC-0010 — Framework`, pero a lo largo del corpus se usa también `Framework` para referirse genéricamente al producto MEF.

Esto no es necesariamente conflictivo, pero debe definirse una regla editorial:

```text
MEF / Framework = producto identificado
framework        = categoría genérica, si se usa
```

El corpus actual tiende a escribir `Framework` con mayúscula incluso en construcciones genéricas.

**Acción futura:** decidir si `Framework` es término reservado de MEF y debe mantenerse con mayúscula cuando refiere al producto, evitando utilizarlo como sustantivo genérico ambiguo.

---

### F5-13 — `Platform`, `Core`, `Module`, `Application`: uso bilingüe semánticamente estable

**Severidad:** N/A  
**Estado:** PASS

Aunque las definiciones están en español, los nombres canónicos ingleses se mantienen de forma estable en títulos y relaciones.

No se recomienda traducirlos a:

```text
Plataforma
Núcleo
Módulo
Aplicación
```

como identidades alternativas sin una política formal de alias.

Las traducciones pueden utilizarse en explicación narrativa, no como reemplazo automático del término canónico.

---

### F5-14 — `Testing` vs `Pruebas`

**Severidad:** MEDIA  
**Estado:** ABIERTO

`MEF-DIC-0068` utiliza:

```text
Testing
```

como nombre canónico.

El alcance de `DIC-001G` utiliza:

```text
Pruebas
```

La situación es análoga a `Generator / Generadores`.

**Acción futura:** aplicar la política lingüística que se defina en F5-02.

---

### F5-15 — `Semantic Versioning` vs `Versionado Semántico`

**Severidad:** MEDIA  
**Estado:** ABIERTO

El término canónico es:

```text
Semantic Versioning
```

pero las decisiones del mismo documento declaran:

```text
El Framework utilizará Versionado Semántico.
```

No hay contradicción conceptual, pero sí una alternancia de nombre.

**Acción futura:** distinguir:

```text
Semantic Versioning = término canónico
versionado semántico = traducción explicativa permitida
```

o adoptar otra política única, pero no mantener ambas como posibles nombres oficiales.

---

## 6. Hallazgo transversal — Naming Drift y Mixed Language

Los hallazgos F5-02, F5-03, F5-04, F5-14 y F5-15 forman un mismo patrón:

```text
Término canónico inglés
        │
        ├── aparece en algunos lugares intacto
        │
        └── aparece en otros traducido o pluralizado
```

Esto no obliga a traducir ni a reescribir masivamente el Diccionario.

La solución recomendada es crear una regla editorial mínima:

```text
1. Cada MEF-DIC posee un único Nombre Canónico.
2. El nombre canónico se conserva sin traducción en referencias normativas.
3. La prosa explicativa puede usar traducción si no crea un alias oficial.
4. La primera aparición puede mostrar:
   Nombre Canónico (traducción descriptiva)
   o
   Traducción descriptiva (Nombre Canónico),
   según la política aprobada.
5. Código/campos técnicos pueden aplicar casing tecnológico sin cambiar
   la identidad terminológica.
```

---

## 7. Matriz de hallazgos

| ID | Hallazgo | Severidad | Estado |
|---|---|---:|---|
| F5-01 | `Modular ERP Framework` vs `Modular Enterprise Framework` | **Crítica** | ABIERTO |
| F5-02 | Política de idioma no explícita | Alta | ABIERTO |
| F5-03 | Generator/Generadores, Template/Plantillas | Media | ABIERTO |
| F5-04 | Notification/Notifications | Baja/Media | ABIERTO |
| F5-05 | Module Metadata/ModuleMetadata | Media | LEGACY / ABIERTO |
| F5-06 | EventId vs eventId y equivalentes | Media | NORMALIZAR REGLA |
| F5-07 | Patrón de expansión de acrónimos | Baja/Media | OBSERVACIÓN |
| F5-08 | IoC sin identidad terminológica explícita | Media | ABIERTO |
| F5-09 | Singular/plural canónico | — | PASS |
| F5-10 | ARQ plural vs DIC singular | — | PASS |
| F5-11 | Capitalización de términos reservados | Baja | PASS CON OBS. |
| F5-12 | Framework producto vs sustantivo genérico | Media | ABIERTO |
| F5-13 | Core/Platform/Module/Application | — | PASS |
| F5-14 | Testing/Pruebas | Media | ABIERTO |
| F5-15 | Semantic Versioning/Versionado Semántico | Media | ABIERTO |

---

## 8. Aspectos que NO deben corregirse todavía

Fase 5 no autoriza:

- traducir masivamente nombres canónicos;
- renombrar IDs;
- convertir `Module Metadata` en `ModuleMetadata`;
- cambiar `EventId` por `eventId` en el Diccionario;
- crear una entrada `IoC`;
- cambiar nombres de ARQ o ENG;
- alterar acrónimos;
- sustituir todos los plurales;
- ejecutar reemplazos globales de `Framework`, `Module`, `Event`, etc.

La única corrección indiscutible identificada es la expansión errónea `Modular ERP Framework`; aun así se reserva para la fase de correcciones controladas para mantener trazabilidad del proceso.

---

## 9. Dictamen

```text
FASE 5 — CONSISTENCIA TERMINOLÓGICA Y NOMENCLATURA GLOBAL

MEF-DIC IDs                            PASS
Unicidad de nombres                    PASS
Nombre completo de MEF                 FAIL CRÍTICO
Términos reservados principales        PASS
Singularidad de términos canónicos     PASS
Acrónimos                              PASS CON OBSERVACIONES
Capitalización                         PASS CON OBSERVACIONES
Idioma                                 NO NORMALIZADO
Traducciones descriptivas              NO GOBERNADAS
Concepto vs representación técnica     NO FORMALIZADO
Naming Drift                           PRESENTE, CONTROLABLE
Mixed Language                         PRESENTE, CONTROLABLE

RESULTADO GENERAL:
PASS CON HALLAZGO CRÍTICO DE IDENTIDAD
```

El corpus no requiere reconstrucción.  
Requiere una política lingüística y nominal explícita, más correcciones puntuales.

---

## 10. Gate de salida

Fase 5 queda **AUDITADA Y DOCUMENTADA**.

Prioridades para corrección posterior:

```text
P0  F5-01 — Modular ERP Framework → identidad incorrecta
P1  F5-02 — política lingüística canónica
P1  F5-05 — Module Metadata / ModuleMetadata
P1  F5-06 — concepto vs casing técnico
P2  F5-03 — Generator/Generadores; Template/Plantillas
P2  F5-14 — Testing/Pruebas
P2  F5-15 — Semantic Versioning/Versionado Semántico
```

---

## 11. Siguiente fase recomendada

**FASE 6 — AUDITORÍA DE COBERTURA, COMPLETITUD Y ESTRUCTURA TERMINOLÓGICA**

Objetivos:

- comprobar campos mínimos por término;
- cuantificar cobertura de `Categoría`;
- cuantificar cobertura de `Documento de origen`;
- revisar `Responsabilidad`, `Relacionados`, `Ejemplos`, `No confundir con`, `Estado`;
- distinguir campos obligatorios y opcionales;
- detectar términos demasiado pobres o excesivamente desarrollados;
- preparar la plantilla normativa única que posteriormente será aplicada en correcciones controladas.

---

**Estado Fase 5:** CERRADA COMO AUDITORÍA / HALLAZGOS ABIERTOS PARA CORRECCIÓN CONTROLADA.
