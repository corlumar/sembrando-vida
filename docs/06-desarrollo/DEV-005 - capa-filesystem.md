# DEV-005 — Capa FileSystem del ERP Core

**Versión:** 1.0  
**Estado:** En desarrollo  
**Clasificación:** Estándar de desarrollo  
**Responsable:** Equipo de Arquitectura ERP Core  

---

## 1. Objetivo

Definir e implementar una capa centralizada para administrar las operaciones del sistema de archivos utilizadas por el ERP Core.

Esta capa evitará que los comandos, módulos, generadores y servicios utilicen directamente funciones como:

- `mkdir()`;
- `file_put_contents()`;
- `json_encode()` para escritura;
- `Filesystem::put()`;
- `Filesystem::makeDirectory()`.

Todas las operaciones deberán realizarse mediante componentes especializados del núcleo.

---

## 2. Alcance

DEV-005 comprende los siguientes componentes:

| Componente | Responsabilidad | Estado |
|---|---|---|
| `DirectoryManager` | Crear, comprobar y eliminar directorios | Completado |
| `FileWriter` | Escribir archivos de texto | Pendiente |
| `JsonWriter` | Generar y escribir archivos JSON | Pendiente |
| `GitKeepGenerator` | Crear archivos `.gitkeep` | Pendiente |
| `StubWriter` | Renderizar plantillas y escribir resultados | Pendiente |
| `FileCopier` | Copiar archivos de forma controlada | Futuro |

---

## 3. Principios

La capa FileSystem deberá cumplir los siguientes principios:

- responsabilidad única;
- bajo acoplamiento;
- manejo explícito de errores;
- rutas validadas;
- operaciones idempotentes cuando corresponda;
- compatibilidad con Windows y Linux;
- codificación UTF-8 sin BOM;
- facilidad para realizar pruebas unitarias.

---

## 4. Estructura

```text
app/
└── Core/
    ├── Contracts/
    │   ├── DirectoryManagerContract.php
    │   ├── FileWriterContract.php
    │   └── JsonWriterContract.php
    │
    └── FileSystem/
        ├── DirectoryManager.php
        ├── FileWriter.php
        ├── JsonWriter.php
        ├── GitKeepGenerator.php
        └── StubWriter.php