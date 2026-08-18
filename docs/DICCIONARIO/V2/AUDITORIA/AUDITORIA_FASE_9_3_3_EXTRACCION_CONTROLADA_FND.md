# AUDITORÍA FASE 9.3.3 — EXTRACCIÓN CONTROLADA FND

## 1. Identificación

| Campo | Valor |
|---|---|
| Proyecto | Modular Enterprise Framework (MEF) |
| Componente | Diccionario Canónico MEF — V2 |
| Fase | 9.3 — Extracción controlada de términos candidatos |
| Subfase | 9.3.3 — Extracción controlada FND |
| Capa | Fundación (`FND`) |
| Estado | Completada |
| Resultado | PASS TÉCNICO |
| Fecha | 2026-08-18 |

---

## 2. Propósito

Ejecutar por primera vez el método de extracción controlada sobre el corpus fundacional de MEF.

La operación tiene carácter de descubrimiento y no constituye canonización terminológica.

---

## 3. Corpus

Se procesaron 15 autoridades FND:

```text
FND-000
FND-001
FND-002
FND-003
FND-004
FND-005
FND-006
FND-007
FND-008
FND-009
FND-010
FND-011
FND-012
FND-013
FND-014
```

Resultado:

```text
Fuentes procesadas: 15
```

---

## 4. Extractor

Se utilizó:

```text
extract_diccionario_v2_fnd.ps1
```

El extractor opera sobre las fuentes FND sin modificarlas.

---

## 5. Incidencia técnica de codificación

Durante la preparación del extractor se detectó inicialmente:

```text
Falta la cadena en el terminador: ".
```

La codificación del archivo fue normalizada y posteriormente el extractor pudo ejecutarse correctamente.

Esta incidencia no afectó los documentos FND.

---

## 6. Ejecución válida

```text
==============================================
EXTRACCIÓN FND TERMINADA
==============================================
Fuentes procesadas: 15
Candidatos generados: 52
Salida: .\docs\DICCIONARIO\V2\CATALOGO\CANDIDATOS_FND.csv
```

---

## 7. Artefacto generado

```text
docs/DICCIONARIO/V2/CATALOGO/CANDIDATOS_FND.csv
```

Tamaño observado:

```text
8998 bytes
```

---

## 8. Resultado cuantitativo

| Tipo de evidencia | Cantidad |
|---|---:|
| ENCABEZADO_CONCEPTUAL | 37 |
| TITULO_DOCUMENTAL | 15 |
| TOTAL | 52 |

---

## 9. Definiciones explícitas

La extracción automática inicial no produjo registros `DEFINICION_EXPLICITA`.

Esto no demuestra que FND carezca de definiciones; demuestra que los patrones iniciales no detectaron todas las formas lingüísticas del corpus.

---

## 10. Validación estructural

Resultado:

```text
Registros estructuralmente invalidos: 0
```

```text
52/52 registros estructuralmente válidos
```

---

## 11. Integridad de fuentes

Se ejecutó:

```text
git status --short docs/00-FUNDACION
```

sin modificaciones reportadas.

Resultado:

```text
Fuentes FND modificadas: 0
```

---

## 12. Duplicidad de evidencia

Se encontraron múltiples evidencias para:

```text
Ingeniería
Misión
Visión
Comunidad
Arquitectura
Carta del Proyecto
Compromisos
```

Estas repeticiones deberán consolidarse durante la validación semántica.

---

## 13. Hallazgo principal

La extracción fue técnicamente correcta pero semánticamente amplia.

La mayoría de los registros corresponden a títulos, encabezados y estructura editorial.

> La extracción automática es adecuada como mecanismo de descubrimiento, pero insuficiente como mecanismo de canonización.

---

## 14. Restricción derivada

Los 52 registros no deberán interpretarse como 52 términos del Diccionario.

Su interpretación correcta es:

```text
52 evidencias/candidatos iniciales pendientes de auditoría
```

---

## 15. Gate de calidad

| Control | Resultado |
|---|---|
| Fuentes procesadas | PASS — 15/15 |
| Ejecución del extractor | PASS |
| Archivo de salida | PASS |
| Registros generados | 52 |
| Registros inválidos | PASS — 0 |
| Fuentes modificadas | PASS — 0 |
| Canonización automática | NO REALIZADA |
| IDs MEF-DIC asignados | 0 |

---

## 16. Resultado

La subfase:

```text
9.3.3 — EXTRACCIÓN CONTROLADA FND
```

se declara:

```text
PASS TÉCNICO
```

Se autoriza avanzar a la auditoría de los candidatos FND.
