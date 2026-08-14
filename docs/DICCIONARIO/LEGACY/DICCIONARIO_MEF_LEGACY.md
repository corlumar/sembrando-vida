> [!WARNING]
> Documento LEGACY NO CANÓNICO.
> Conservado únicamente como evidencia histórica.
> No debe utilizarse para resolver identificadores MEF-DIC.
> La autoridad terminológica vigente corresponde a DIC-001A → DIC-001G.

---
# MEF-DIC-0001

# Module

## Definición

Unidad funcional independiente que encapsula capacidades de negocio dentro de MEF.

Representa la unidad básica de extensión del Framework.

---

## Categoría

Core

---

## Documento de origen

ARQ-004

---

## Responsabilidad

Agrupar funcionalidades relacionadas en un componente reutilizable y desacoplado.

---

## Componentes relacionados

- Registry
- Discovery
- Module Provider
- Manifest
- Builder

---

## Ejemplos

- CRM
- Inventarios
- Recursos Humanos
- Compras
- Organización

---

## No confundir con

- Package
- Plugin
- Application

---

## Estado

Estable


# MEF-DIC-0002

# Registry

## Definición

Componente del Core responsable de mantener el catálogo de módulos registrados durante la ejecución.

No almacena datos de negocio.

No persiste información en bases de datos.

Su propósito es mantener el estado operativo del Framework respecto a los módulos cargados.

---

## Categoría

Core

---

## Documento de origen

ARQ-006

---

## Responsabilidad

Registrar, localizar y consultar módulos disponibles.

---

## Componentes relacionados

- Kernel
- Discovery
- Bootstrap
- ModuleMetadata

---

## Ejemplos

Registry::register()

Registry::find()

Registry::all()

---

## No confundir con

Repository

Database

Cache

---

## Estado

Estable