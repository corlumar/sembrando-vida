# AUDITORÍA FASE 9.1 — CONTRATO CANÓNICO DEL DICCIONARIO V2

## 1. Identificación

**Proyecto:** Modular Enterprise Framework (MEF)  
**Componente:** Diccionario Canónico MEF — V2  
**Fase:** 9.1 — Contrato Canónico  
**Fecha:** 2026-08-17  
**Estado:** CERRADA  
**Resultado:** PASS

---

## 2. Objetivo

La FASE 9.1 tiene como objetivo establecer el contrato normativo, metodológico y estructural que gobernará la reconstrucción del Diccionario Canónico MEF V2.

Esta fase define las reglas bajo las cuales deberán identificarse las fuentes de autoridad, extraerse términos candidatos, determinarse autoridades documentales, construirse el Catálogo Maestro, asignarse identificadores terminológicos, generarse los documentos definitivos, validarse las relaciones entre términos y conservarse la trazabilidad histórica con el Diccionario V1.

---

## 3. Motivación de la reconstrucción

Durante la auditoría del Diccionario V1 se identificaron inconsistencias que impedían garantizar que todas las entradas existentes representaran correctamente el corpus normativo vigente de MEF.

Entre los problemas detectados se encontraron referencias documentales históricas, referencias a documentos renombrados, desplazamientos entre identificadores ARQ, documentos existentes físicamente pero semánticamente incorrectos como autoridad, términos sin documento de origen y diferencias entre autoridad arquitectónica y autoridad de ingeniería.

Se aprobó por tanto la reconstrucción controlada del Diccionario.

---

## 4. Decisión arquitectónica de la fase

> DICCIONARIO V2 deberá construirse desde las fuentes normativas vigentes de MEF y no mediante la reproducción o modificación automática del Diccionario V1.

El corpus V1 se conservará como referencia histórica y mecanismo de comparación.

---

## 5. Fuentes normativas

```text
FND — Fundación
ARQ — Arquitectura
ENG — Ingeniería
```

---

## 6. Modelo de autoridad

```text
FND
 ↓
ARQ
 ↓
ENG
```

DIC funciona como representación terminológica transversal:

```text
FND ─┐
     │
ARQ ─┼──> DIC
     │
ENG ─┘
```

---

## 7. Documento de autoridad

Todo término canónico deberá identificar el documento que posee autoridad normativa primaria sobre el concepto.

Deberá distinguirse entre:

```text
MENCIÓN
REFERENCIA
DEPENDENCIA
RELACIÓN
DEFINICIÓN
AUTORIDAD PRIMARIA
```

---

## 8. Autoridad FND

Los documentos FND podrán actuar como autoridad primaria para conceptos relacionados con identidad, visión, misión, valores, principios, doctrina, lenguaje oficial, gobernanza, filosofía, constitución e independencia del Framework.

---

## 9. Autoridad ARQ

Los documentos ARQ podrán actuar como autoridad primaria para estructuras arquitectónicas, componentes, límites, responsabilidades, relaciones, modelos arquitectónicos, lifecycle y mecanismos estructurales del Framework.

---

## 10. Autoridad ENG

Los documentos ENG podrán actuar como autoridad primaria para contratos técnicos, mecanismos de ingeniería, comportamiento operativo, implementación normativa, testing, versionado, CLI, runtime, persistencia, observabilidad, seguridad técnica, integración y disciplinas especializadas de ingeniería.

---

## 11. Principio de evidencia

Ningún término podrá incorporarse al Diccionario Canónico únicamente por tradición, similitud nominal, existencia previa en V1, conveniencia editorial, inferencia no documentada o aparición aislada dentro del corpus.

---

## 12. Catálogo Maestro

Como mínimo deberá registrar:

```text
Termino
NombreCanonico
Dominio
Tipo
Autoridad
Documento
Seccion
DefinicionFuente
EstadoValidacion
```

Podrá incorporar adicionalmente:

```text
Sinonimos
Relacionados
NoConfundirCon
Notas
OrigenV1
Confianza
```

---

## 13. Estados de validación

```text
CANDIDATO
EN_REVISION
CONFIRMADO
AMBIGUO
DUPLICADO
DESCARTADO
```

---

## 14. Política de identificadores

Durante la extracción inicial no deberán asignarse identificadores definitivos `MEF-DIC-XXXX`.

La asignación se realizará únicamente después de estabilizar el Catálogo Maestro.

---

## 15. Continuidad de identificadores V1

La continuidad histórica será deseable cuando no produzca inconsistencias semánticas, pero no tendrá prioridad sobre la corrección terminológica.

---

## 16. Definición canónica

Toda definición terminológica deberá representar el significado establecido por su autoridad, conservar las fronteras conceptuales de la fuente, diferenciar concepto de implementación y evitar comportamiento no respaldado documentalmente.

---

## 17. Relaciones terminológicas

```text
RelacionadoCon
DependeDe
CompuestoPor
Especializa
NoConfundirCon
```

---

## 18. Política lingüística

La documentación explicativa utilizará español. Los nombres técnicos podrán conservarse en inglés cuando formen parte del lenguaje arquitectónico o técnico oficial de MEF.

---

## 19. Tratamiento del Diccionario V1

```text
DIC-001A → DIC-001G
MEF-DIC-0001 → MEF-DIC-0070
```

se declara DICCIONARIO V1 durante el proceso de reconstrucción y se conserva como referencia histórica, inventario de términos candidatos y mecanismo de migración V1 → V2.

---

## 20. Regla de no destrucción

Los documentos V1 deberán conservarse hasta que V2 haya sido construido, validado, reauditado, aprobado, versionado y sometido a migración V1 → V2.

---

## 21. Migración V1 → V2

```text
CONSERVADO
RENOMBRADO
RECLASIFICADO
CAMBIO_DE_AUTORIDAD
FUSIONADO
DIVIDIDO
DEPRECADO
RETIRADO
NUEVO
```

---

## 22. Generación documental

```text
FUENTES CANÓNICAS
       ↓
EXTRACCIÓN
       ↓
CATÁLOGO MAESTRO
       ↓
VALIDACIÓN
       ↓
ASIGNACIÓN DE IDs
       ↓
GENERACIÓN DIC
       ↓
ÍNDICE
       ↓
AUDITORÍA
```

---

## 23. Validaciones obligatorias

Deberán verificarse unicidad de términos e identificadores, existencia de documentos de autoridad, trazabilidad, ausencia de referencias rotas, coherencia de categorías y relaciones, cobertura FND/ARQ/ENG, compatibilidad con el corpus y migración completa V1 → V2.

---

## 24. Estructura de trabajo

```text
docs/DICCIONARIO/V2/
│
├── README.md
├── FUENTES/
├── CATALOGO/
├── GENERADO/
└── AUDITORIA/
```

---

## 25. Separación de auditorías

Auditorías V1:

```text
docs/DICCIONARIO/AUDITORIA/
```

Auditorías V2:

```text
docs/DICCIONARIO/V2/AUDITORIA/
```

---

## 26. Prohibiciones durante la reconstrucción

Hasta estabilizar el Catálogo Maestro no deberá generarse el Diccionario definitivo, asignarse arbitrariamente nuevos IDs, renumerarse V1, eliminarse términos V1, sustituirse V1 por V2 ni declarar V2 como autoridad vigente.

---

## 27. Baseline inicial

```text
DICCIONARIO V2
Estado: EN CONSTRUCCIÓN
Fuente normativa: FND + ARQ + ENG
Diccionario V1: CONGELADO COMO REFERENCIA HISTÓRICA
Catálogo Maestro: PENDIENTE
IDs V2: NO ASIGNADOS
Documentos DIC V2: NO GENERADOS
```

---

## 28. Controles de la fase

| Control | Resultado |
|---|---|
| Reconstrucción V2 autorizada | PASS |
| Fuentes FND definidas | PASS |
| Fuentes ARQ definidas | PASS |
| Fuentes ENG definidas | PASS |
| Modelo de autoridad definido | PASS |
| Principio de evidencia definido | PASS |
| Catálogo Maestro definido | PASS |
| Estados de validación definidos | PASS |
| Política de IDs definida | PASS |
| Política lingüística definida | PASS |
| Tratamiento de V1 definido | PASS |
| Migración V1 → V2 definida | PASS |
| Regla de no destrucción definida | PASS |
| Estructura V2 definida | PASS |
| Separación de auditorías definida | PASS |

---

## 29. Dictamen

```text
FASE 9.1
CONTRATO CANÓNICO DEL DICCIONARIO V2

MODELO DE AUTORIDAD             PASS
PRINCIPIO DE EVIDENCIA          PASS
CATÁLOGO MAESTRO                DEFINIDO
POLÍTICA DE IDENTIFICADORES     DEFINIDA
POLÍTICA DE MIGRACIÓN           DEFINIDA
TRAZABILIDAD                    DEFINIDA
NO DESTRUCCIÓN                  DEFINIDA
ESTRUCTURA V2                   DEFINIDA

RESULTADO GLOBAL                PASS
```

---

## 30. Condición de cierre

La FASE 9.1 queda cerrada al existir `docs/DICCIONARIO/V2/README.md` como contrato normativo y `docs/DICCIONARIO/V2/AUDITORIA/AUDITORIA_FASE_9_1_CONTRATO_CANONICO.md` como evidencia formal.

---

## 31. Autorización para siguiente fase

Queda autorizada la FASE 9.2 — INVENTARIO DE AUTORIDADES DOCUMENTALES.

---

## 32. Estado final

**FASE 9.1 — CERRADA**  
**Resultado:** PASS  
**Contrato:** ESTABLECIDO  
**DICCIONARIO V2:** EN CONSTRUCCIÓN  
**Siguiente fase:** FASE 9.2 — Inventario de Autoridades Documentales
-
