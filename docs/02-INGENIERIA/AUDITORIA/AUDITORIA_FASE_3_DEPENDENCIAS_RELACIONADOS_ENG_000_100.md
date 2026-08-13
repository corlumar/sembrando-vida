# AUDITORÍA FASE 3 — DEPENDENCIAS Y RELACIONADOS ENG-000 → ENG-100

## 1. Objetivo

Auditar el grafo documental de `02-INGENIERIA` para verificar:

- referencias ENG existentes;
- ausencia de auto-dependencias;
- ausencia de dependencias hacia ENG posteriores;
- ausencia de ciclos en el grafo de dependencias;
- duplicados dentro de `dependencias` o `relacionados`;
- separación entre `dependencias` y `relacionados`;
- dependencias externas a otras familias normativas;
- conectividad general de la arquitectura.

Esta fase es diagnóstica. No modifica archivos.

---

## 2. Resultado ejecutivo

- Documentos auditados: **101**.
- Aristas internas de dependencia ENG→ENG: **2129**.
- Aristas internas de relación ENG↔/→ENG declaradas: **1981**.
- Dependencias externas declaradas (FND/ARQ u otras familias): **126**.
- Relaciones externas declaradas: **0**.
- Referencias a ENG inexistentes: **0**.
- Auto-referencias: **0**.
- Dependencias hacia ENG posteriores: **0**.
- Ciclos de dependencia ENG: **0**.
- Entradas duplicadas dentro de una misma lista: **0**.
- Elementos simultáneamente en `dependencias` y `relacionados` del mismo documento: **0**.

### Dictamen

**APROBADA.** El grafo normativo ENG no presenta referencias internas rotas, auto-dependencias, dependencias adelantadas ni ciclos.

---

## 3. Integridad referencial ENG

Todas las referencias con prefijo `ENG-` encontradas en `dependencias` y `relacionados` resuelven dentro del universo:

```text
ENG-000 → ENG-100
```

Resultado:

```text
REFERENCIAS ENG INEXISTENTES = 0
```

---

## 4. Dirección de dependencias

Las dependencias ENG siguen una dirección retrospectiva: ningún documento depende normativamente de un ENG con número superior.

```text
DEPENDENCIAS ADELANTADAS = 0
```

Esto permite mantener una progresión normativa acíclica.

---

## 5. Ciclos

Se construyó el grafo dirigido utilizando únicamente `dependencias` ENG→ENG y se analizaron sus componentes fuertemente conexos.

```text
CICLOS DETECTADOS = 0
```

Por tanto, el grafo de dependencias internas es un DAG respecto de los documentos ENG auditados.

---

## 6. Auto-referencias y duplicados

```text
AUTO-REFERENCIAS = 0
ENTRADAS DUPLICADAS = 0
SOLAPAMIENTO DEPENDENCIAS/RELACIONADOS = 0
```

No se detectaron documentos que se dependan o relacionen consigo mismos, ni referencias repetidas dentro de una misma lista, ni una misma referencia clasificada simultáneamente como dependencia y relacionado dentro del mismo ENG.

---

## 7. Dependencias externas

Se identificaron **126 dependencias externas** a la familia ENG. Estas referencias pertenecen principalmente a capas rectoras como `FND-*` y `ARQ-*`.

Estas referencias no se clasifican como rotas en Fase 3, porque esta auditoría valida la integridad interna de `02-INGENIERIA`. Su existencia física y semántica deberá contrastarse en una auditoría transversal MEF.

### Referencias externas únicas

```text
ARQ-000
ARQ-001
ARQ-002
ARQ-003
ARQ-004
ARQ-005
ARQ-006
ARQ-007
ARQ-008
ARQ-009
ARQ-010
ARQ-011
ARQ-012
ARQ-013
ARQ-014
ARQ-015
ARQ-016
ARQ-017
FND-004
FND-005
FND-011
FND-013
```

---

## 8. Relacionados no recíprocos

Se observaron **1913 relaciones dirigidas no recíprocas**.

Esto **no se considera un error** en esta fase: `relacionados` funciona como vínculo semántico/documental y no existe una regla demostrada que obligue a que `A → B` implique `B → A`.

Por ello, la reciprocidad se registra como característica del grafo, no como incumplimiento.

---

## 9. Documentos con mayor conectividad interna

| ENG | Dependencias ENG | Relacionados ENG | Dependencias externas | Total interno |
|---|---:|---:|---:|---:|
| ENG-099 | 47 | 30 | 0 | 77 |
| ENG-094 | 39 | 37 | 0 | 76 |
| ENG-097 | 36 | 40 | 0 | 76 |
| ENG-081 | 27 | 49 | 0 | 76 |
| ENG-096 | 40 | 35 | 0 | 75 |
| ENG-095 | 42 | 32 | 0 | 74 |
| ENG-080 | 29 | 45 | 0 | 74 |
| ENG-100 | 51 | 22 | 0 | 73 |
| ENG-079 | 31 | 42 | 0 | 73 |
| ENG-098 | 41 | 31 | 0 | 72 |
| ENG-078 | 32 | 40 | 0 | 72 |
| ENG-088 | 38 | 33 | 0 | 71 |
| ENG-077 | 34 | 37 | 0 | 71 |
| ENG-076 | 35 | 35 | 0 | 70 |
| ENG-090 | 31 | 38 | 0 | 69 |
| ENG-075 | 29 | 40 | 0 | 69 |
| ENG-074 | 30 | 38 | 0 | 68 |
| ENG-093 | 32 | 35 | 0 | 67 |
| ENG-073 | 25 | 42 | 0 | 67 |
| ENG-092 | 31 | 35 | 0 | 66 |

---

## 10. Matriz ENG-000 → ENG-100

| ENG | Dependencias ENG | Relacionados ENG | Dependencias externas | Resultado |
|---|---:|---:|---:|---|
| ENG-000 | 0 | 4 | 5 | OK |
| ENG-001 | 1 | 4 | 5 | OK |
| ENG-002 | 2 | 5 | 5 | OK |
| ENG-003 | 3 | 5 | 5 | OK |
| ENG-004 | 4 | 6 | 1 | OK |
| ENG-005 | 5 | 6 | 1 | OK |
| ENG-006 | 6 | 6 | 4 | OK |
| ENG-007 | 5 | 6 | 3 | OK |
| ENG-008 | 5 | 4 | 2 | OK |
| ENG-009 | 9 | 6 | 3 | OK |
| ENG-010 | 4 | 3 | 3 | OK |
| ENG-011 | 6 | 6 | 2 | OK |
| ENG-012 | 6 | 6 | 1 | OK |
| ENG-013 | 6 | 5 | 3 | OK |
| ENG-014 | 5 | 6 | 3 | OK |
| ENG-015 | 8 | 3 | 4 | OK |
| ENG-016 | 9 | 2 | 7 | OK |
| ENG-017 | 10 | 1 | 4 | OK |
| ENG-018 | 10 | 5 | 4 | OK |
| ENG-019 | 10 | 6 | 6 | OK |
| ENG-020 | 13 | 5 | 6 | OK |
| ENG-021 | 12 | 4 | 7 | OK |
| ENG-022 | 14 | 5 | 7 | OK |
| ENG-023 | 16 | 4 | 7 | OK |
| ENG-024 | 22 | 3 | 8 | OK |
| ENG-025 | 18 | 2 | 5 | OK |
| ENG-026 | 20 | 1 | 4 | OK |
| ENG-027 | 21 | 1 | 5 | OK |
| ENG-028 | 13 | 9 | 3 | OK |
| ENG-029 | 11 | 10 | 3 | OK |
| ENG-030 | 11 | 11 | 0 | OK |
| ENG-031 | 10 | 14 | 0 | OK |
| ENG-032 | 14 | 12 | 0 | OK |
| ENG-033 | 14 | 16 | 0 | OK |
| ENG-034 | 13 | 14 | 0 | OK |
| ENG-035 | 9 | 16 | 0 | OK |
| ENG-036 | 12 | 11 | 0 | OK |
| ENG-037 | 16 | 9 | 0 | OK |
| ENG-038 | 16 | 10 | 0 | OK |
| ENG-039 | 16 | 11 | 0 | OK |
| ENG-040 | 20 | 8 | 0 | OK |
| ENG-041 | 21 | 9 | 0 | OK |
| ENG-042 | 23 | 8 | 0 | OK |
| ENG-043 | 22 | 9 | 0 | OK |
| ENG-044 | 20 | 13 | 0 | OK |
| ENG-045 | 24 | 11 | 0 | OK |
| ENG-046 | 23 | 13 | 0 | OK |
| ENG-047 | 26 | 11 | 0 | OK |
| ENG-048 | 30 | 8 | 0 | OK |
| ENG-049 | 28 | 12 | 0 | OK |
| ENG-050 | 27 | 15 | 0 | OK |
| ENG-051 | 27 | 16 | 0 | OK |
| ENG-052 | 32 | 12 | 0 | OK |
| ENG-053 | 26 | 19 | 0 | OK |
| ENG-054 | 20 | 25 | 0 | OK |
| ENG-055 | 21 | 26 | 0 | OK |
| ENG-056 | 28 | 19 | 0 | OK |
| ENG-057 | 20 | 29 | 0 | OK |
| ENG-058 | 16 | 30 | 0 | OK |
| ENG-059 | 24 | 28 | 0 | OK |
| ENG-060 | 26 | 29 | 0 | OK |
| ENG-061 | 27 | 28 | 0 | OK |
| ENG-062 | 20 | 36 | 0 | OK |
| ENG-063 | 25 | 32 | 0 | OK |
| ENG-064 | 31 | 27 | 0 | OK |
| ENG-065 | 25 | 34 | 0 | OK |
| ENG-066 | 26 | 34 | 0 | OK |
| ENG-067 | 23 | 38 | 0 | OK |
| ENG-068 | 22 | 40 | 0 | OK |
| ENG-069 | 23 | 40 | 0 | OK |
| ENG-070 | 22 | 42 | 0 | OK |
| ENG-071 | 24 | 41 | 0 | OK |
| ENG-072 | 24 | 42 | 0 | OK |
| ENG-073 | 25 | 42 | 0 | OK |
| ENG-074 | 30 | 38 | 0 | OK |
| ENG-075 | 29 | 40 | 0 | OK |
| ENG-076 | 35 | 35 | 0 | OK |
| ENG-077 | 34 | 37 | 0 | OK |
| ENG-078 | 32 | 40 | 0 | OK |
| ENG-079 | 31 | 42 | 0 | OK |
| ENG-080 | 29 | 45 | 0 | OK |
| ENG-081 | 27 | 49 | 0 | OK |
| ENG-082 | 24 | 26 | 0 | OK |
| ENG-083 | 25 | 30 | 0 | OK |
| ENG-084 | 25 | 29 | 0 | OK |
| ENG-085 | 32 | 28 | 0 | OK |
| ENG-086 | 38 | 27 | 0 | OK |
| ENG-087 | 25 | 15 | 0 | OK |
| ENG-088 | 38 | 33 | 0 | OK |
| ENG-089 | 29 | 16 | 0 | OK |
| ENG-090 | 31 | 38 | 0 | OK |
| ENG-091 | 30 | 27 | 0 | OK |
| ENG-092 | 31 | 35 | 0 | OK |
| ENG-093 | 32 | 35 | 0 | OK |
| ENG-094 | 39 | 37 | 0 | OK |
| ENG-095 | 42 | 32 | 0 | OK |
| ENG-096 | 40 | 35 | 0 | OK |
| ENG-097 | 36 | 40 | 0 | OK |
| ENG-098 | 41 | 31 | 0 | OK |
| ENG-099 | 47 | 30 | 0 | OK |
| ENG-100 | 51 | 22 | 0 | OK |

---

## 11. Hallazgos que pasan a fases posteriores

### 11.1 Autoridad conceptual

Que una referencia sea estructuralmente válida no demuestra que la dirección de autoridad conceptual sea correcta. Esa validación corresponde a:

```text
FASE 4 — FRONTERAS Y AUTORIDAD CONCEPTUAL
```

Ahí deberán revisarse especialmente relaciones como:

```text
ENG-026 ↔ ENG-070
ENG-029 ↔ ENG-060
ENG-033 ↔ ENG-044
ENG-055 ↔ ENG-100
ENG-079 ↔ ENG-080
ENG-092 ↔ ENG-100
ENG-094 ↔ ENG-100
ENG-095 ↔ ENG-100
ENG-096 ↔ ENG-100
ENG-097 ↔ ENG-100
ENG-098 ↔ ENG-100
ENG-099 ↔ ENG-100
```

### 11.2 Referencias externas

Las dependencias `FND-*` y `ARQ-*` requieren auditoría transversal posterior para comprobar que:

- existen físicamente;
- su título corresponde;
- la dirección de dependencia es correcta;
- no existe inversión entre Arquitectura e Ingeniería.

---

## 12. Criterios de conformidad de Fase 3

```text
[x] todos los ENG-000 → ENG-100 son resolubles
[x] no existen referencias ENG inexistentes
[x] no existen auto-dependencias
[x] no existen dependencias hacia ENG posteriores
[x] no existen ciclos internos de dependencia
[x] no existen entradas duplicadas en listas
[x] dependencias y relacionados permanecen separados
[x] dependencias externas fueron inventariadas
[x] reciprocidad de relacionados fue medida sin imponerla como regla
[x] no se modificó ningún ENG
```

---

## 13. Resultado final

```text
INTEGRIDAD REFERENCIAL ENG        🟢 APROBADA
DIRECCIÓN DE DEPENDENCIAS        🟢 APROBADA
AUTO-REFERENCIAS                 🟢 0
CICLOS                           🟢 0
REFERENCIAS ENG ROTAS            🟢 0
DUPLICADOS EN LISTAS             🟢 0
DEP→REL SOLAPADOS                🟢 0
DEPENDENCIAS EXTERNAS            🟡 INVENTARIADAS
RECIPROCIDAD DE RELACIONADOS     ℹ️ NO OBLIGATORIA
FASE 3                           ✅ APROBADA
```

---

## 14. Conclusión

La arquitectura documental `ENG-000 → ENG-100` posee un grafo interno de dependencias estructuralmente consistente.

No se detectaron dependencias internas rotas, auto-referencias, dependencias hacia documentos posteriores ni ciclos. Las referencias externas quedan registradas para una futura auditoría transversal entre Fundación, Arquitectura e Ingeniería.

El siguiente control recomendado es:

**AUDITORÍA FASE 4 — FRONTERAS Y AUTORIDAD CONCEPTUAL.**