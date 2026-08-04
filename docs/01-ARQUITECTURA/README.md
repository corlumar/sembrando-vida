# Arquitectura de MEF

## Modular ERP Framework

Esta sección describe la arquitectura técnica de MEF.

Su objetivo es explicar cómo se organiza el Framework, cómo se relacionan sus capas y cuáles son las responsabilidades de cada componente principal.

---

## Alcance

| Documento | Propósito |
|---|---|
| `ARQ-001-Vision-General.md` | Explica la arquitectura global |
| `ARQ-002-Core.md` | Describe el núcleo |
| `ARQ-003-Platform.md` | Define los servicios compartidos |
| `ARQ-004-Modules.md` | Explica el sistema modular |
| `ARQ-005-Kernel.md` | Describe el arranque del Framework |
| `ARQ-006-Registry.md` | Explica el registro de módulos |
| `ARQ-007-Discovery.md` | Describe el descubrimiento automático |
| `ARQ-008-Value-Objects.md` | Define el modelo tipado del Core |
| `ARQ-009-Builders.md` | Documenta los Builders |
| `ARQ-010-Template-Engine.md` | Describe el motor de plantillas |
| `ARQ-011-CLI.md` | Define la interfaz de línea de comandos |
| `ARQ-012-Application-Services.md` | Define la coordinación de casos de uso |
| `ARQ-013-Dependency-Injection.md` | Define el uso del contenedor |
| `ARQ-014-Bootstrap.md` | Describe el ciclo de inicialización |
| `ARQ-015-Service-Providers.md` | Explica el registro de servicios |
| `ARQ-016-Event-System.md` | Define el sistema de eventos |
| `ARQ-017-Roadmap-Arquitectonico.md` | Presenta la evolución prevista |

## Modelo general

```text
Applications
      │
      ▼
Modules
      │
      ▼
Platform
      │
      ▼
Core