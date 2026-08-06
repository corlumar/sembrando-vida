# DIC-001G — Desarrollo, Calidad y Extensibilidad

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario oficial utilizado durante el desarrollo, mantenimiento, evolución y extensión de MEF.

Este documento establece el lenguaje común para los procesos de ingeniería, calidad de software, herramientas de desarrollo y evolución del Framework.

---

# Alcance

Este documento cubre los conceptos relacionados con:

- Desarrollo
- SDK
- CLI
- Versionado
- Calidad
- Pruebas
- Extensibilidad
- Compatibilidad
- Marketplace

No describe implementaciones concretas.

---

# MEF-DIC-0061

## CLI

### Definición

La **CLI (Command Line Interface)** es la interfaz oficial de línea de comandos de MEF.

Permite ejecutar tareas administrativas, de desarrollo y automatización mediante comandos.

### Propósito

Automatizar operaciones del Framework.

### Categoría

Ingeniería

### Documento de origen

ARQ-011

### Ejemplos

- mef:install
- mef:doctor
- mef:make-module
- mef:list

### Estado

Estable

---

# MEF-DIC-0062

## SDK

### Definición

El **Software Development Kit (SDK)** es el conjunto oficial de herramientas, bibliotecas, contratos y utilidades que facilitan el desarrollo de módulos para MEF.

### Propósito

Proporcionar una experiencia consistente para los desarrolladores.

### Documento de origen

ARQ-017

### Estado

Estable

---

# MEF-DIC-0063

## Plugin

### Definición

Componente opcional que amplía el comportamiento de un módulo o servicio existente sin modificar su implementación original.

### Propósito

Permitir extensiones ligeras y desacopladas.

### No confundir con

- Module
- Package

### Estado

Propuesto

---

# MEF-DIC-0064

## Extension

### Definición

Mecanismo mediante el cual MEF permite ampliar capacidades existentes respetando los contratos definidos por el Framework.

### Propósito

Facilitar la evolución del sistema sin alterar el Core.

### Estado

Estable

---

# MEF-DIC-0065

## Marketplace

### Definición

Repositorio oficial de módulos, extensiones y recursos distribuidos para MEF.

### Propósito

Facilitar la distribución e instalación de componentes reutilizables.

### Documento de origen

ARQ-004

### Estado

Visión futura

---

# MEF-DIC-0066

## ADR (Architecture Decision Record)

### Definición

Documento que registra una decisión arquitectónica importante, su contexto, alternativas evaluadas y justificación.

### Propósito

Preservar la memoria arquitectónica del proyecto.

### Estado

Estable

---

# MEF-DIC-0067

## RFC (Request for Comments)

### Definición

Documento utilizado para proponer cambios significativos antes de su implementación.

Permite discutir nuevas funcionalidades, mejoras o modificaciones arquitectónicas.

### Propósito

Favorecer decisiones consensuadas y documentadas.

### Estado

Estable

---

# MEF-DIC-0068

## Testing

### Definición

Conjunto de prácticas destinadas a verificar que el Framework cumple los requisitos funcionales y no funcionales definidos.

### Propósito

Garantizar la calidad y estabilidad de MEF.

### Tipos

- Unit Testing
- Integration Testing
- Architecture Testing
- End-to-End Testing

### Estado

Estable

---

# MEF-DIC-0069

## Semantic Versioning

### Definición

Esquema oficial de versionado utilizado por MEF.

Formato:

MAJOR.MINOR.PATCH

### Propósito

Comunicar el impacto de los cambios realizados en el Framework.

### Ejemplo

1.4.2

### Estado

Estable

---

# MEF-DIC-0070

## Deprecation

### Definición

Proceso formal mediante el cual un componente continúa disponible, pero se marca como obsoleto y será eliminado en una versión futura.

### Propósito

Permitir una evolución controlada del Framework sin romper compatibilidad de forma abrupta.

### Estado

Estable

---

# Principios

La ingeniería de MEF seguirá estas reglas:

- Toda decisión importante deberá documentarse.
- Los cambios arquitectónicos requerirán un ADR.
- Las funcionalidades relevantes podrán discutirse mediante RFC.
- El Framework utilizará Versionado Semántico.
- La calidad será responsabilidad de todo el proyecto.
- La extensibilidad será un principio de diseño.

---

# Relaciones

```text
RFC
 │
 ▼
ADR
 │
 ▼
Arquitectura
 │
 ▼
Implementación
 │
 ▼
Testing
 │
 ▼
Release
 │
 ▼
Marketplace
```

---

# Resumen

| ID | Término |
|----|----------|
| MEF-DIC-0061 | CLI |
| MEF-DIC-0062 | SDK |
| MEF-DIC-0063 | Plugin |
| MEF-DIC-0064 | Extension |
| MEF-DIC-0065 | Marketplace |
| MEF-DIC-0066 | ADR |
| MEF-DIC-0067 | RFC |
| MEF-DIC-0068 | Testing |
| MEF-DIC-0069 | Semantic Versioning |
| MEF-DIC-0070 | Deprecation |

---

# Decisiones

1. Toda evolución importante del Framework deberá documentarse mediante ADR o RFC.
2. La CLI y el SDK constituyen la interfaz oficial para desarrolladores.
3. El Framework utilizará Versionado Semántico.
4. Todo componente podrá evolucionar mediante un proceso formal de Deprecation.
5. El Marketplace será el mecanismo oficial para distribuir módulos y extensiones.

---

# Conclusión

DIC-001G completa la primera edición del Diccionario Oficial de MEF.

Con este documento queda definido el lenguaje de ingeniería que utilizarán los desarrolladores para construir, extender y mantener el Framework, garantizando procesos consistentes y una evolución controlada.