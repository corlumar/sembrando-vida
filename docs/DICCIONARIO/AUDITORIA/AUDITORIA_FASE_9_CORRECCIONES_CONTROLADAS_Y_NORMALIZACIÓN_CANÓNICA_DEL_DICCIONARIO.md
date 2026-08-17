# FASE 9 — CORRECCIONES CONTROLADAS Y NORMALIZACIÓN CANÓNICA DEL DICCIONARIO

## 1. Identificación

- **Componente:** `docs/DICCIONARIO/`
- **Fase:** 9
- **Tipo:** Correcciones controladas
- **Fecha de inicio:** 2026-08-13
- **Baseline:** Fases 1–8 cerradas como auditoría
- **Corpus canónico:** `DIC-001A` → `DIC-001G`
- **IDs protegidos:** `MEF-DIC-0001` → `MEF-DIC-0070`
- **Estado:** INICIADA

---

## 2. Objetivo

Aplicar las correcciones identificadas y aprobadas durante las Fases 1–8 sin alterar la identidad de los 70 términos canónicos, sin inventar información normativa y manteniendo trazabilidad por lote y por `git diff`.

La Fase 9 se ejecutará en subfases independientes y verificables.

---

## 3. Invariantes

```text
INV-9-01  No renumerar MEF-DIC-0001 → MEF-DIC-0070.
INV-9-02  No crear MEF-DIC-0071+.
INV-9-03  No reutilizar IDs.
INV-9-04  No fusionar términos por similitud.
INV-9-05  No inventar Documentos de origen.
INV-9-06  No inventar Categorías sin validación.
INV-9-07  No ejecutar reemplazos semánticos masivos.
INV-9-08  Preservar información histórica antes de retirar legacy.
INV-9-09  Toda corrección debe revisarse mediante git diff.
INV-9-10  El índice se regenera sólo al final.
```

---

## 4. Secuencia de ejecución

```text
9.1  Autoridad e Identidad
9.2  Contrato Normativo / README
9.3  Trazabilidad y Documentos de Origen
9.4  Fronteras Semánticas
9.5  Categorías y Estados
9.6  Relaciones
9.7  Normalización Estructural y Editorial
9.8  Regeneración de INDICE.md
9.9  Validación Automática
```

Cada subfase debe quedar documentada antes de continuar con la siguiente.

---

# 9.1 — AUTORIDAD E IDENTIDAD

## 5. Objetivo de 9.1

Resolver exclusivamente:

1. identidad oficial de MEF;
2. autoridad del corpus canónico;
3. tratamiento seguro de `DICCIONARIO_MEF.md`;
4. protección del baseline antes de editar.

No se modificarán todavía Categorías, Estados, Relaciones, Documentos de origen ni fronteras semánticas.

---

## 6. Corrección 9.1-A — Identidad oficial de MEF

Hallazgo confirmado:

```text
Actual:
MEF (Modular ERP Framework)

Canónico:
MEF (Modular Enterprise Framework)
```

Ubicación:

```text
DIC-001A-ARQUITECTURA.md
MEF-DIC-0010 — Framework
```

Corrección autorizada:

```text
Modular ERP Framework
        ↓
Modular Enterprise Framework
```

No cambia:

```text
ID
Nombre del término
Categoría
Documento de origen
Estado
Propósito
```

---

## 7. Corrección 9.1-B — `DICCIONARIO_MEF.md`

La inspección completa del archivo legacy demuestra que contiene únicamente dos entradas:

```text
MEF-DIC-0001 — Module
MEF-DIC-0002 — Registry
```

Ambos conceptos ya existen en el corpus canónico bajo:

```text
MEF-DIC-0005 — Module
MEF-DIC-0013 — Registry
```

Por tanto, el archivo no puede continuar resolviendo IDs.

### Decisión

No eliminarlo todavía.

Debe archivarse como evidencia histórica:

```text
docs/DICCIONARIO/LEGACY/DICCIONARIO_MEF_LEGACY.md
```

y quedar fuera del corpus canónico.

### Motivo

Preserva evidencia del baseline anterior sin permitir que compita con:

```text
DIC-001A → DIC-001G
```

---

## 8. Orden operativo de 9.1

### Paso 9.1.0 — Verificar estado Git

```powershell
git status
```

No ejecutar correcciones si existen cambios no identificados en `docs/DICCIONARIO/` que puedan confundirse con esta subfase.

### Paso 9.1.1 — Crear snapshot lógico

Recomendado:

```powershell
git switch -c docs/diccionario-normalizacion
```

Si ya existe una rama específica de normalización, conservarla y no crear otra.

### Paso 9.1.2 — Confirmar error antes del cambio

```powershell
Select-String `
  -Path ".\docs\DICCIONARIO\DIC-001A-ARQUITECTURA.md" `
  -Pattern "Modular ERP Framework"
```

Resultado esperado: una coincidencia dentro de `MEF-DIC-0010`.

### Paso 9.1.3 — Aplicar corrección determinista

```powershell
$path = ".\docs\DICCIONARIO\DIC-001A-ARQUITECTURA.md"
$utf8 = New-Object System.Text.UTF8Encoding($false)

$text = [System.IO.File]::ReadAllText($path)
$text = $text.Replace(
    "MEF (Modular ERP Framework)",
    "MEF (Modular Enterprise Framework)"
)

[System.IO.File]::WriteAllText($path, $text, $utf8)
```

### Paso 9.1.4 — Verificar identidad

```powershell
Select-String `
  -Path ".\docs\DICCIONARIO\DIC-001A-ARQUITECTURA.md" `
  -Pattern "Modular (ERP|Enterprise) Framework"
```

Resultado esperado:

```text
Modular Enterprise Framework
```

y cero apariciones de `Modular ERP Framework`.

Verificación global:

```powershell
Get-ChildItem ".\docs" -Recurse -File -Filter "*.md" |
Select-String -Pattern "Modular ERP Framework"
```

Resultado esperado: vacío.

---

## 9. Archivo legacy — procedimiento controlado

### Paso 9.1.5 — Crear carpeta LEGACY

```powershell
New-Item `
  -ItemType Directory `
  -Path ".\docs\DICCIONARIO\LEGACY" `
  -Force
```

### Paso 9.1.6 — Mover, no borrar

```powershell
Move-Item `
  ".\docs\DICCIONARIO\DICCIONARIO_MEF.md" `
  ".\docs\DICCIONARIO\LEGACY\DICCIONARIO_MEF_LEGACY.md"
```

### Paso 9.1.7 — Añadir aviso de no canonicidad

El archivo archivado deberá comenzar con:

```markdown
> [!WARNING]
> Documento LEGACY NO CANÓNICO.
> Conservado únicamente como evidencia histórica.
> No debe utilizarse para resolver identificadores MEF-DIC.
> La autoridad terminológica vigente corresponde a DIC-001A → DIC-001G.
```

Este aviso debe insertarse sin modificar el contenido histórico restante.

---

## 10. Verificaciones de 9.1

### Verificar estructura

```powershell
Get-ChildItem ".\docs\DICCIONARIO" -Force |
Select-Object Name, Mode
```

Debe existir:

```text
LEGACY/
DIC-001A...
...
DIC-001G...
INDICE.md
README.md
```

y ya no:

```text
DICCIONARIO_MEF.md
```

en la raíz.

### Verificar archivo archivado

```powershell
Get-Item ".\docs\DICCIONARIO\LEGACY\DICCIONARIO_MEF_LEGACY.md"
```

### Verificar IDs canónicos

```powershell
$ids = Get-ChildItem ".\docs\DICCIONARIO" -File -Filter "DIC-*.md" |
    Select-String -Pattern 'MEF-DIC-\d{4}' |
    ForEach-Object { $_.Matches.Value } |
    Sort-Object -Unique

$ids.Count
$ids | Select-Object -First 1
$ids | Select-Object -Last 1
```

Resultado obligatorio:

```text
70
MEF-DIC-0001
MEF-DIC-0070
```

### Verificar diff

```powershell
git diff -- docs/DICCIONARIO
```

El diff de 9.1 debe mostrar únicamente:

```text
1. Modular ERP Framework → Modular Enterprise Framework
2. movimiento de DICCIONARIO_MEF.md a LEGACY/
3. aviso de documento legacy
```

No deben aparecer cambios sobre los demás términos.

---

## 11. Gate de 9.1

9.1 podrá cerrarse únicamente si:

```text
[ ] Modular ERP Framework = 0 ocurrencias
[ ] Modular Enterprise Framework está correcto en MEF-DIC-0010
[ ] DICCIONARIO_MEF.md dejó de ser fuente canónica
[ ] archivo legacy fue preservado
[ ] DIC-001A → DIC-001G siguen presentes
[ ] 70 IDs únicos
[ ] rango 0001 → 0070 intacto
[ ] git diff no contiene cambios ajenos a 9.1
```

---

# 9.2 → 9.9 — PLAN APROBADO

## 12. 9.2 — Contrato Normativo / README

Se aplicarán:

- política MUST / SHOULD / MAY;
- política lingüística;
- definición de `Documento de origen`;
- taxonomía de Categorías;
- taxonomía de Estados;
- taxonomía de Relaciones;
- `Historial = MAY`.

## 13. 9.3 — Trazabilidad

Resolver:

```text
MEF-DIC-0063 Plugin
MEF-DIC-0064 Extension
MEF-DIC-0066 ADR
MEF-DIC-0067 RFC
MEF-DIC-0068 Testing
MEF-DIC-0069 Semantic Versioning
MEF-DIC-0070 Deprecation
```

y corregir referencias ARQ legacy/inválidas demostradas en Fase 3.

## 14. 9.4 — Fronteras Semánticas

Prioridad:

```text
Template / Stub
Plugin / Extension
Event / Integration Event
Module / Plugin / Extension
```

seguido de las fronteras P2.

## 15. 9.5 — Categorías y Estados

- completar 38 Categorías mediante validación;
- migrar valores de Estado sin pérdida de información;
- separar obligatoriedad, implementación u horizonte sólo cuando sea necesario.

## 16. 9.6 — Relaciones

Normalizar hacia:

```text
Relacionados
Depende de
Compuesto por
Especializa
No confundir con
```

sin inventar relaciones.

## 17. 9.7 — Normalización estructural/editorial

- headings;
- nombres de campos;
- casing;
- traducciones descriptivas;
- consistencia de plantilla.

## 18. 9.8 — Regeneración de índice

`INDICE.md` deberá derivarse de las 70 entradas ya normalizadas.

## 19. 9.9 — Validación automática

Debe comprobar al menos:

```text
70/70 IDs
0 huecos
0 duplicados
70/70 Definición
70/70 Propósito
70/70 Categoría
70/70 Documento de origen
70/70 Estado
0 estados fuera de catálogo
0 categorías fuera de catálogo
0 referencias legacy canónicas
0 Modular ERP Framework
```

---

## 20. Estado

```text
FASE 9                         INICIADA
9.1 AUTORIDAD E IDENTIDAD      LISTA PARA EJECUCIÓN
9.2 → 9.9                      PENDIENTES
```

No debe iniciarse 9.2 hasta cerrar y verificar 9.1.
