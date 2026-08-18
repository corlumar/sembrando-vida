# AUDITORÍA FASE 9.3.2 — ESQUEMA DE CANDIDATOS TERMINOLÓGICOS

## 1. Identificación

| Campo | Valor |
|---|---|
| Proyecto | Modular Enterprise Framework (MEF) |
| Componente | Diccionario Canónico MEF — V2 |
| Fase | 9.3 — Extracción controlada de términos candidatos |
| Subfase | 9.3.2 — Esquema de candidatos terminológicos |
| Estado | Completada |
| Resultado | PASS |
| Fecha | 2026-08-18 |

---

## 2. Propósito

Establecer la estructura utilizada para registrar candidatos terminológicos durante la reconstrucción del Diccionario Canónico MEF.

El esquema deberá conservar evidencia y trazabilidad sin convertir automáticamente un candidato en término canónico.

---

## 3. Campos utilizados

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

---

## 4. Termino

Contiene la expresión detectada durante la extracción. No implica aprobación terminológica.

---

## 5. NombreCanonico

Representa el nombre normalizado provisional del concepto. Durante la extracción inicial podrá coincidir con `Termino`.

---

## 6. Capa

Identifica la capa documental de procedencia.

```text
FND
ARQ
ENG
```

---

## 7. Documento

Identifica la autoridad documental concreta.

```text
FND-000
ARQ-004
ENG-043
```

---

## 8. Archivo

Conserva el archivo físico del cual fue obtenida la evidencia.

---

## 9. Seccion

Identifica la sección o contexto documental donde fue detectado el candidato.

---

## 10. TipoEvidencia

Durante la primera extracción FND se utilizaron:

```text
TITULO_DOCUMENTAL
ENCABEZADO_CONCEPTUAL
DEFINICION_EXPLICITA
```

La taxonomía podrá ampliarse controladamente al analizar ARQ y ENG.

---

## 11. TextoEvidencia

Conserva el fragmento documental que provocó la detección.

---

## 12. EstadoValidacion

Durante la extracción inicial:

```text
CANDIDATO
```

significa únicamente una expresión detectada que requiere análisis.

No significa:

```text
APROBADO
CANÓNICO
ESTABLE
```

---

## 13. Confianza

La confianza inicial mide la fuerza de la señal de extracción, no la validez terminológica definitiva.

```text
ALTA
MEDIA
```

---

## 14. Notas

Campo reservado para observaciones de auditoría, ambigüedades, decisiones o información necesaria para etapas posteriores.

---

## 15. Separación entre evidencia y decisión

```text
CONFIANZA DE EXTRACCIÓN
        ≠
VALIDEZ TERMINOLÓGICA
```

```text
CANDIDATO
        ≠
TÉRMINO CANÓNICO
```

---

## 16. Multiplicidad de evidencias

```text
Arquitectura — FND-001
Arquitectura — FND-002
```

deberá interpretarse posteriormente como:

```text
Arquitectura
├── evidencia FND-001
└── evidencia FND-002
```

y no necesariamente como dos términos.

---

## 17. Validación estructural

Campos mínimos:

- término;
- documento;
- tipo de evidencia;
- estado de validación.

---

## 18. Prohibición de MEF-DIC

Durante esta etapa no se asignarán identificadores:

```text
MEF-DIC-XXXX
```

---

## 19. Gate de calidad

| Control | Resultado |
|---|---|
| Trazabilidad documental | PASS |
| Evidencia conservada | PASS |
| Estado separado de canonización | PASS |
| Confianza separada de validez | PASS |
| Multiplicidad de evidencias soportada | PASS |
| MEF-DIC no asignado | PASS |

---

## 20. Resultado

La subfase:

```text
9.3.2 — ESQUEMA DE CANDIDATOS TERMINOLÓGICOS
```

se declara:

```text
PASS
```

El esquema queda habilitado para la extracción controlada FND.
