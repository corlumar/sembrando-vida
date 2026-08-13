# 02 — Ingeniería

## MEF — Modular Enterprise Framework

La capa de **Ingeniería** define cómo se materializa técnicamente la arquitectura de **MEF (Modular Enterprise Framework)**.

Mientras la Fundación establece los principios y la Arquitectura define la estructura conceptual del Framework, Ingeniería especifica los mecanismos, estándares, convenciones y procesos necesarios para convertir esa arquitectura en implementaciones verificables.

---

# 1. Propósito

Esta sección tiene como propósito establecer las especificaciones técnicas necesarias para construir MEF de manera:

- consistente;
- modular;
- reproducible;
- verificable;
- mantenible;
- portable;
- segura;
- trazable.

La pregunta principal de esta capa es:

> **¿Cómo se construye MEF?**

---

# 2. Posición dentro del modelo documental

MEF organiza su conocimiento mediante diferentes niveles de abstracción.

```text
00-FUNDACION
      │
      │ ¿Por qué?
      ▼
01-ARQUITECTURA
      │
      │ ¿Qué?
      ▼
02-INGENIERIA
      │
      │ ¿Cómo?
      ▼
IMPLEMENTACION
      │
      │ ¿Con qué código?
      ▼
OPERACION
      │
      │ ¿Cómo se ejecuta?
      ▼
Runtime
```

Cada nivel posee responsabilidades diferentes.

Ingeniería no redefine la Fundación ni la Arquitectura.

Las materializa.

---

# 3. Regla Fundamental

La Ingeniería deberá permanecer subordinada a la Arquitectura.

```text
Fundación
    │
    ▼
Arquitectura
    │
    ▼
Ingeniería
    │
    ▼
Implementación
```

Una decisión técnica no deberá convertirse automáticamente en una decisión arquitectónica.

Cuando una implementación requiera modificar una regla arquitectónica, el cambio deberá procesarse mediante los mecanismos de gobernanza correspondientes.

---

# 4. Documento Rector

El documento principal de esta sección es:

**ENG-000 — Ingeniería General**

Este documento establece:

- propósito de Ingeniería;
- principios de implementación;
- relación con Arquitectura;
- criterios de conformidad;
- trazabilidad;
- validación;
- reproducibilidad;
- invariantes de Ingeniería.

Todos los documentos `ENG` deberán ser compatibles con `ENG-000`.

---

# 5. Estructura Documental

La estructura inicial de Ingeniería es:

```text
02-INGENIERIA/
│
├── README.md
│
├── ENG-000-INGENIERIA_GENERAL.md
├── ENG-001-ORGANIZACION_DEL_CODIGO.md
├── ENG-002-ESPECIFICACION_DE_MODULES.md
├── ENG-003-MANIFEST.md
├── ENG-004-CONVENCIONES.md
├── ENG-005-NOMENCLATURA.md
├── ENG-006-ESTRUCTURA_DE_DIRECTORIOS.md
├── ENG-007-CLI.md
├── ENG-008-GENERADORES.md
├── ENG-009-TESTING.md
├── ENG-010-LOGGING.md
├── ENG-011-CONFIGURATION_FILES.md
├── ENG-012-BUILD_SYSTEM.md
├── ENG-013-PACKAGE_MANAGER.md
├── ENG-014-VERSIONADO.md
├── ENG-015-ARCHITECTURAL_STATE_MACHINE.md
├── ENG-016-EXTENSION_SDK.md
└── ENG-017-RELEASE_PROCESS.md
```

La numeración posterior a `ENG-000` constituye el mapa inicial de Ingeniería y podrá evolucionar mediante los mecanismos oficiales de gobernanza.

---

# 6. Índice de Ingeniería

| ID | Documento | Propósito | Estado |
|----|-----------|-----------|--------|
| ENG-000 | Ingeniería General | Define el marco general de Ingeniería | Accepted |
| ENG-001 | Organización del Código | Define la organización lógica del código | Planned |
| ENG-002 | Especificación de Modules | Define cómo implementar un Module | Planned |
| ENG-003 | Manifest | Define la especificación técnica del Manifest | Planned |
| ENG-004 | Convenciones | Define convenciones generales de implementación | Planned |
| ENG-005 | Nomenclatura | Define reglas oficiales de nombres | Planned |
| ENG-006 | Estructura de Directorios | Define la organización física del proyecto | Planned |
| ENG-007 | CLI | Define la interfaz de línea de comandos | Planned |
| ENG-008 | Generadores | Define generación y scaffolding de artefactos | Planned |
| ENG-009 | Testing | Define la estrategia oficial de pruebas | Planned |
| ENG-010 | Logging | Define estándares técnicos de registro y diagnóstico | Planned |
| ENG-011 | Configuration Files | Define formatos y carga de configuración | Planned |
| ENG-012 | Build System | Define el proceso reproducible de construcción | Planned |
| ENG-013 | Package Manager | Define administración y resolución de Packages | Planned |
| ENG-014 | Versionado | Define las reglas técnicas de versionado | Planned |
| ENG-015 | Architectural State Machine | Implementa técnicamente el Lifecycle | Planned |
| ENG-016 | Extension SDK | Define herramientas para desarrollar extensiones | Planned |
| ENG-017 | Release Process | Define construcción, validación y publicación de releases | Planned |

---

# 7. Relación Arquitectura → Ingeniería

La Ingeniería materializa los conceptos definidos en Arquitectura.

```text
ARQ
 │
 │ especifica
 ▼
ENG
 │
 │ implementa
 ▼
CODE
```

Ejemplos:

| Arquitectura | Ingeniería |
|--------------|------------|
| ARQ-004 — Modules | ENG-002 — Especificación de Modules |
| ARQ-006 — Registry | ENG-001 / especificaciones técnicas relacionadas |
| ARQ-007 — Service Container | Especificaciones técnicas de composición |
| ARQ-008 — Event Bus | Especificaciones técnicas de eventos |
| ARQ-010 — Template Engine | ENG-008 — Generadores |
| ARQ-011 — Contracts | Convenciones y especificaciones técnicas |
| ARQ-013 — Configuration | ENG-011 — Configuration Files |
| ARQ-014 — Framework Lifecycle | ENG-015 — Architectural State Machine |
| ARQ-015 — Extension Model | ENG-016 — Extension SDK |
| ARQ-017 — Packaging | ENG-013 / ENG-017 |

No existe necesariamente una correspondencia uno a uno entre documentos `ARQ` y `ENG`.

Una especificación de Ingeniería podrá implementar requisitos provenientes de múltiples documentos arquitectónicos.

---

# 8. Alcance

La sección de Ingeniería podrá especificar:

- organización del código;
- estructuras de archivos;
- formatos;
- esquemas;
- interfaces técnicas;
- convenciones;
- herramientas;
- comandos;
- generadores;
- validadores;
- pruebas;
- procesos de construcción;
- empaquetado;
- versionado;
- automatización;
- distribución técnica.

---

# 9. Fuera de Alcance

Ingeniería no deberá redefinir:

- propósito de MEF;
- principios fundamentales;
- doctrina arquitectónica;
- límites arquitectónicos;
- responsabilidades conceptuales;
- decisiones de gobernanza.

Cuando sea necesario modificar alguno de estos elementos, deberá escalarse al nivel documental correspondiente.

---

# 10. Invariantes de Ingeniería

Los documentos de Ingeniería utilizarán la nomenclatura:

```text
EI-xxx
```

Ejemplo:

```text
EI-001
Toda implementación deberá respetar la arquitectura vigente.
```

Esta nomenclatura se mantiene separada de los:

```text
AI-xxx
```

utilizados para los **Invariantes Arquitectónicos**.

La separación permite identificar inmediatamente el nivel al que pertenece cada regla.

---

# 11. Jerarquía de Reglas

La prioridad conceptual será:

```text
Fundación
    │
    ▼
Arquitectura
    │
    ▼
Ingeniería
    │
    ▼
Implementación
```

Una especificación inferior no deberá contradecir una especificación superior.

En caso de conflicto deberá revisarse la decisión mediante los mecanismos oficiales de gobernanza.

---

# 12. Trazabilidad

MEF buscará mantener una cadena de trazabilidad completa.

```text
Principio
   │
   ▼
FND
   │
   ▼
ARQ
   │
   ▼
ENG
   │
   ▼
Implementation
   │
   ▼
Tests
   │
   ▼
Package
```

Cuando corresponda, esta cadena podrá incorporar:

```text
RFC
ADR
KCS
```

para documentar propuestas, decisiones y conocimiento relacionado.

---

# 13. Estados Documentales

Los documentos `ENG` podrán utilizar estados como:

| Estado | Significado |
|--------|-------------|
| Draft | Documento en elaboración |
| Proposed | Especificación propuesta |
| Accepted | Especificación aprobada |
| Deprecated | Especificación en proceso de retiro |
| Superseded | Sustituida por otra especificación |

El estado deberá declararse en los metadatos del documento.

---

# 14. Versionado Documental

Cada documento `ENG` deberá declarar su propia versión.

Ejemplo:

```yaml
version: 1.0.0
```

Los cambios deberán reflejar la magnitud de la modificación realizada.

El versionado de una especificación documental no deberá confundirse con el versionado del Framework o de sus Packages.

---

# 15. Estructura Base de un Documento ENG

Cuando corresponda, una especificación de Ingeniería deberá contener:

```text
Metadata
   │
   ├── Propósito
   ├── Alcance
   ├── Dependencias
   ├── Especificación
   ├── Reglas
   ├── Validación
   ├── Testing
   ├── Invariantes
   ├── Riesgos
   ├── Criterios de conformidad
   └── Referencias
```

No todas las secciones serán obligatorias para todos los documentos.

La estructura deberá adaptarse al propósito de cada especificación sin perder consistencia editorial.

---

# 16. Independencia Tecnológica

Las especificaciones de Ingeniería deberán distinguir entre:

```text
Regla de Ingeniería
        │
        ▼
Implementación de Referencia
        │
        ▼
Tecnología
```

Una tecnología utilizada por una implementación de referencia no deberá convertirse automáticamente en requisito universal de MEF.

Por ejemplo:

```text
Contract
   │
   ├── PHP
   ├── Java
   ├── .NET
   └── JavaScript
```

MEF define el acuerdo.

Cada implementación selecciona los mecanismos adecuados para cumplirlo.

---

# 17. Implementaciones de Referencia

MEF podrá proporcionar implementaciones de referencia.

Estas tendrán como propósito:

- demostrar la especificación;
- validar decisiones;
- facilitar adopción;
- proporcionar ejemplos;
- servir como base de pruebas.

Una implementación de referencia no sustituye la especificación.

---

# 18. Validación

Las especificaciones ENG deberán favorecer mecanismos automáticos de validación.

Podrán existir:

- linters;
- validators;
- schema validators;
- contract tests;
- architecture tests;
- dependency checks;
- compatibility checks.

La validación automática deberá complementar, no sustituir, la revisión técnica.

---

# 19. Testing

Las implementaciones deberán incorporar pruebas proporcionales a su criticidad.

MEF reconocerá, entre otras:

```text
Unit Tests
Integration Tests
Contract Tests
Architecture Tests
Compatibility Tests
Security Tests
End-to-End Tests
```

La estrategia detallada será definida en **ENG-009 — Testing**.

---

# 20. Conformidad

Una implementación podrá declararse conforme con MEF cuando:

- respete los principios aplicables;
- respete la Arquitectura;
- cumpla las especificaciones ENG correspondientes;
- respete los Contracts;
- supere las validaciones requeridas;
- no viole invariantes vigentes;
- documente las excepciones autorizadas.

---

# 21. Gestión de Excepciones

Cuando una implementación no pueda cumplir una especificación deberá documentarse la excepción.

La excepción deberá indicar:

- regla afectada;
- motivo;
- alcance;
- impacto;
- riesgo;
- duración prevista;
- mecanismo de resolución.

Una excepción técnica no modifica automáticamente la especificación.

---

# 22. Evolución

La sección de Ingeniería evolucionará conforme MEF incorpore nuevas capacidades.

Podrán añadirse especificaciones para:

- nuevos runtimes;
- nuevos protocolos;
- nuevos adaptadores;
- nuevas herramientas;
- nuevos mecanismos de construcción;
- nuevas estrategias de despliegue;
- nuevas capacidades de automatización.

Toda evolución deberá mantener compatibilidad con los niveles superiores o iniciar formalmente su revisión.

---

# 23. Navegación Recomendada

Para comprender la Ingeniería de MEF se recomienda seguir este orden:

```text
ENG-000
   │
   ▼
ENG-001
   │
   ▼
ENG-002
   │
   ▼
ENG-003
   │
   ▼
...
   │
   ▼
ENG-017
```

No obstante, cada documento deberá conservar suficiente autonomía para ser consultado individualmente.

---

# 24. Principio Rector

> **La Ingeniería de MEF define cómo materializar la arquitectura mediante especificaciones técnicas explícitas, verificables, reproducibles y trazables, preservando la independencia entre principios, arquitectura, implementación y tecnología.**

---

# 25. Estado de la Sección

```text
02-INGENIERIA

ENG-000  ████████████████████  Accepted
ENG-001  ░░░░░░░░░░░░░░░░░░░░  Planned
ENG-002  ░░░░░░░░░░░░░░░░░░░░  Planned
ENG-003  ░░░░░░░░░░░░░░░░░░░░  Planned
...
ENG-017  ░░░░░░░░░░░░░░░░░░░░  Planned
```

La actualización de este estado deberá realizarse conforme se aprueben nuevas especificaciones.

---

# 26. Referencias

## Fundación

- FND-004 — Principios de Arquitectura
- FND-011 — Doctrina de Arquitectura
- FND-013 — Independencia del Framework

## Arquitectura

- ARQ-000 — Arquitectura General
- ARQ-001 — Visión Arquitectónica
- ARQ-004 — Modules
- ARQ-010 — Template Engine
- ARQ-014 — Framework Lifecycle
- ARQ-015 — Extension Model
- ARQ-016 — Security
- ARQ-017 — Packaging

## Ingeniería

- ENG-000 — Ingeniería General