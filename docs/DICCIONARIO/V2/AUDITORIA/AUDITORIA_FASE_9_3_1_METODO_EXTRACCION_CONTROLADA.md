# AUDITORÍA FASE 9.3.1 — MÉTODO DE EXTRACCIÓN CONTROLADA

## 1. Identificación

| Campo | Valor |
|---|---|
| Proyecto | Modular Enterprise Framework (MEF) |
| Componente | Diccionario Canónico MEF — V2 |
| Fase | 9.3 — Extracción controlada de términos candidatos |
| Subfase | 9.3.1 — Método de extracción controlada |
| Estado | Completada |
| Resultado | PASS METODOLÓGICO |
| Fecha | 2026-08-18 |

---

## 2. Propósito

Definir el método mediante el cual DICCIONARIO V2 identificará términos candidatos a partir del corpus normativo vigente de MEF.

La extracción deberá utilizar como fuentes primarias:

- Fundación (`FND`);
- Arquitectura (`ARQ`);
- Ingeniería (`ENG`).

El Diccionario V1 no constituye autoridad para crear automáticamente términos en V2.

---

## 3. Principio fundamental

La reconstrucción del Diccionario V2 deberá realizarse desde las fuentes normativas vigentes.

Se establece:

> La existencia previa de un término en el Diccionario V1 no demuestra su validez terminológica en DICCIONARIO V2.

El corpus V1 podrá utilizarse posteriormente para comparación, detección de pérdida conceptual, identificación de candidatos históricos y construcción de trazabilidad V1 → V2.

---

## 4. Unidad de extracción

La unidad primaria de extracción no será el archivo ni el encabezado.

Será la evidencia documental asociada a un concepto.

```text
FUENTE NORMATIVA
      ↓
EVIDENCIA
      ↓
CONCEPTO CANDIDATO
      ↓
VALIDACIÓN
```

---

## 5. Fuentes permitidas

La extracción deberá realizarse exclusivamente sobre autoridades documentales identificadas en el inventario canónico.

```text
FND — Fundación
ARQ — Arquitectura
ENG — Ingeniería
```

Los archivos `README.md` podrán utilizarse como orientación documental, pero no deberán considerarse automáticamente autoridades definitorias de términos.

---

## 6. Principio de no modificación

La extracción será de sólo lectura.

Durante esta fase no se modificarán documentos FND, ARQ ni ENG; no se alterarán definiciones para hacerlas coincidir con V1; y no se asignarán identificadores `MEF-DIC`.

---

## 7. Señales de descubrimiento

El extractor podrá utilizar como señales iniciales:

- títulos documentales;
- encabezados conceptuales;
- definiciones explícitas;
- expresiones definitorias;
- responsabilidades;
- fronteras semánticas;
- relaciones;
- invariantes;
- taxonomías;
- expresiones de no equivalencia.

Una señal de descubrimiento no constituye automáticamente evidencia suficiente para crear un término canónico.

---

## 8. Regla de promoción

Se prohíbe el modelo:

```text
ENCABEZADO
    ↓
TÉRMINO CANÓNICO
```

La promoción deberá seguir:

```text
DESCUBRIMIENTO
      ↓
EVIDENCIA
      ↓
VALIDACIÓN SEMÁNTICA
      ↓
CONSOLIDACIÓN
      ↓
DECISIÓN TERMINOLÓGICA
```

---

## 9. Separación de etapas

La fase de extracción no realizará simultáneamente asignación de identificadores, redacción definitiva, resolución automática de autoridad, eliminación de términos históricos ni migración V1 → V2.

---

## 10. Consolidación

Un concepto podrá aparecer en múltiples fuentes.

```text
Concepto X
├── FND
├── ARQ
└── ENG
```

Estas ocurrencias no deberán generar automáticamente tres términos.

La unidad final del Diccionario será el concepto consolidado.

---

## 11. Trazabilidad

Cada candidato deberá conservar suficiente información para determinar dónde fue encontrado, qué documento lo respalda, qué evidencia produjo su descubrimiento, qué capa documental lo utiliza y cuál es su estado de validación.

---

## 12. Criterio conservador

Ante evidencia insuficiente:

```text
NO PROMOVER
```

Un falso negativo podrá recuperarse posteriormente mediante nuevas evidencias. Un falso positivo incorporado prematuramente al Diccionario puede introducir ambigüedad normativa.

---

## 13. Orden de extracción

La extracción se realizará progresivamente:

```text
FND
 ↓
ARQ
 ↓
ENG
```

FND permitirá validar el método sobre el corpus fundacional antes de escalarlo hacia capas documentalmente más densas.

---

## 14. Gate de calidad

| Control | Resultado |
|---|---|
| Fuentes canónicas identificadas | PASS |
| Separación V1/V2 establecida | PASS |
| Extracción de sólo lectura | PASS |
| Trazabilidad requerida | PASS |
| Promoción automática prohibida | PASS |
| Asignación prematura de MEF-DIC prohibida | PASS |

---

## 15. Resultado

La subfase:

```text
9.3.1 — MÉTODO DE EXTRACCIÓN CONTROLADA
```

se declara:

```text
PASS METODOLÓGICO
```

Se autoriza definir el esquema estructurado de candidatos.
