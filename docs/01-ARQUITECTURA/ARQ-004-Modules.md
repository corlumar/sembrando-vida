---
id: ARQ-004
titulo: Modules
tipo: Architecture
nivel: L1
categoria: Núcleo
subcategoria: Modules
estado: Accepted
version: 2.0.0
responsable: MEF Architecture Team
ultima_revision: 2026-08-06
dependencias:
  - ARQ-002
  - ARQ-003
  - FND-004
  - FND-011
  - FND-013
relacionados:
  - ARQ-005
  - ARQ-006
  - ARQ-008
  - ARQ-014
  - ARQ-015
keywords:
  - modules
  - modularidad
  - capacidades
  - dominio
  - extensibilidad
---

# ARQ-004

# Modules

## Estado

Accepted.

---

# 1. Propósito

Definir **Modules** como la unidad funcional de extensión de **MEF (Modular Enterprise Framework)**.

Un Module encapsula una capacidad coherente y delimitada que puede incorporarse al Framework sin modificar el Core.

Este documento establece sus responsabilidades, límites, dependencias, estructura conceptual y reglas de evolución.

---

# 2. Declaración

Los Modules constituyen el mecanismo principal mediante el cual MEF incorpora capacidades funcionales.

Cada Module deberá:

- representar una capacidad claramente delimitada;
- mantener alta cohesión interna;
- exponer contratos explícitos;
- evitar dependencias innecesarias;
- poder evolucionar con independencia razonable;
- integrarse sin modificar el Core.

Los Modules extienden el Framework.

No redefinen su arquitectura.

---

# 3. Objetivos

La arquitectura modular tiene los siguientes objetivos:

- separar capacidades funcionales;
- reducir el acoplamiento;
- facilitar la reutilización;
- permitir instalación y evolución independientes;
- aislar reglas de dominio;
- proteger la estabilidad del Core;
- permitir múltiples combinaciones de capacidades.

---

# 4. Definición de Module

Un **Module** es una unidad arquitectónica autónoma que agrupa elementos relacionados con una capacidad específica.

Puede incluir:

- contratos;
- casos de uso;
- modelos de dominio;
- eventos;
- adaptadores;
- configuración;
- recursos;
- pruebas;
- documentación;
- metadatos de integración.

La autonomía de un Module no implica aislamiento absoluto.

Implica que sus relaciones con el resto del Framework deberán ser explícitas, controladas y trazables.

---

# 5. Responsabilidades

Un Module es responsable de:

- encapsular una capacidad funcional;
- proteger sus límites internos;
- declarar sus dependencias;
- exponer únicamente una API pública definida;
- registrar sus servicios mediante mecanismos oficiales;
- publicar eventos relevantes;
- mantener sus pruebas y documentación;
- evolucionar sin comprometer otros componentes.

---

# 6. No responsabilidades

Un Module no deberá:

- modificar directamente el Core;
- acceder a elementos internos de otro Module;
- asumir responsabilidades globales del Framework;
- controlar el ciclo de vida general de MEF;
- convertirse en un contenedor genérico de funcionalidades;
- depender de una Application concreta;
- introducir servicios transversales que correspondan a Platform.

---

# 7. Anatomía conceptual

```text
Module
│
├── Manifest
├── Contracts
├── Domain
├── Application
├── Infrastructure
├── Providers
├── Events
├── Configuration
├── Resources
├── Tests
└── Documentation
```

Esta estructura representa responsabilidades conceptuales.

La estructura física definitiva deberá documentarse en las especificaciones de ingeniería correspondientes.

---

# 8. Manifest

Todo Module deberá declarar un **Manifest** que permita al Framework identificarlo y administrarlo.

El Manifest deberá contener, como mínimo:

- identificador;
- nombre;
- versión;
- namespace;
- provider principal;
- dependencias;
- capacidades declaradas;
- requisitos de compatibilidad.

```text
Manifest
    │
    ▼
Discovery
    │
    ▼
Validation
    │
    ▼
Registry
    │
    ▼
Lifecycle
```

El Manifest describe el Module.

No contiene lógica de negocio.

---

# 9. API pública

Cada Module deberá establecer una frontera clara entre su API pública y su implementación interna.

## API pública

Podrá incluir:

- contratos;
- comandos;
- consultas;
- eventos;
- DTO;
- servicios de aplicación;
- puntos de extensión autorizados.

## Implementación interna

Podrá incluir:

- entidades internas;
- repositorios concretos;
- adaptadores;
- listeners internos;
- servicios auxiliares;
- detalles de persistencia.

Los consumidores no deberán depender de elementos internos.

---

# 10. Dependencias permitidas

Un Module podrá depender de:

- contratos del Core;
- servicios públicos de Platform;
- contratos públicos de otros Modules;
- abstracciones de infraestructura;
- bibliotecas aprobadas mediante gobernanza.

```text
Module
   │
   ├── Core Contracts
   ├── Platform Services
   └── Public Contracts of Other Modules
```

Toda dependencia deberá declararse explícitamente.

---

# 11. Dependencias prohibidas

Un Module no deberá depender de:

- detalles internos del Core;
- implementaciones internas de Platform;
- clases privadas de otros Modules;
- Applications;
- interfaces de usuario específicas;
- infraestructura concreta sin una abstracción;
- rutas físicas internas de otro Module.

---

# 12. Dirección de dependencias

La dirección general será:

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
```

Las dependencias inversas no estarán permitidas.

Por tanto:

- Core no depende de Modules.
- Platform no depende de Modules.
- Un Module no depende de Applications.
- Applications podrán componer varios Modules.

---

# 13. Dependencias entre Modules

Las dependencias entre Modules deberán mantenerse al mínimo.

Cuando sean necesarias:

1. deberán utilizar contratos públicos;
2. deberán declararse en el Manifest;
3. deberán respetar el versionado;
4. no deberán generar ciclos;
5. deberán documentarse explícitamente.

## Ejemplo permitido

```text
Sales
  │
  ▼
InventoryContract
```

El Module `Sales` consume un contrato público de `Inventory`.

## Ejemplo prohibido

```text
Sales
  │
  ▼
Inventory\Infrastructure\Eloquent\InventoryRepository
```

Un Module no deberá consumir implementaciones internas de otro.

---

# 14. Comunicación entre Modules

Los Modules podrán comunicarse mediante:

- contratos;
- servicios públicos;
- comandos;
- consultas;
- eventos;
- mensajes de integración.

Se favorecerá la comunicación desacoplada cuando no se requiera una respuesta inmediata.

```text
Module A
   │
   ▼
Event Bus
   │
   ├── Module B
   └── Module C
```

El emisor no deberá conocer las implementaciones consumidoras.

---

# 15. Categorías de Modules

MEF podrá reconocer distintas categorías.

## Modules de dominio

Implementan capacidades de negocio.

Ejemplos:

- CRM;
- Inventory;
- Finance;
- Human Resources;
- Projects.

## Modules técnicos

Proporcionan capacidades técnicas extensibles que no pertenecen al Core.

Ejemplos:

- Search;
- Reporting;
- Import;
- Export.

## Modules de integración

Conectan MEF con sistemas externos mediante contratos y adaptadores.

Ejemplos:

- Payment Gateway;
- External Identity Provider;
- Logistics Connector.

La categoría deberá declararse en los metadatos del Module.

---

# 16. Ciclo de vida

Un Module deberá recorrer un ciclo de vida controlado.

```text
Discovered
    │
    ▼
Validated
    │
    ▼
Registered
    │
    ▼
Booted
    │
    ▼
Ready
    │
    ▼
Disabled
```

Las transiciones serán coordinadas por los componentes arquitectónicos correspondientes.

Un Module no controlará por sí mismo el ciclo de vida global del Framework.

---

# 17. Puntos de extensión

Un Module podrá extenderse mediante:

- contratos públicos;
- listeners;
- subscribers;
- providers;
- estrategias;
- adaptadores;
- configuración;
- hooks oficialmente definidos.

Los puntos de extensión deberán:

- estar documentados;
- mantener compatibilidad;
- evitar acceso a detalles internos;
- utilizar tipos y contratos estables.

---

# 18. Instalación y desinstalación

La arquitectura deberá permitir que un Module sea:

- descubierto;
- validado;
- instalado;
- registrado;
- habilitado;
- deshabilitado;
- actualizado;
- desinstalado.

Estas operaciones deberán preservar:

- consistencia;
- trazabilidad;
- integridad de dependencias;
- compatibilidad de versiones;
- recuperación ante errores.

La implementación concreta de estas operaciones se definirá en documentos posteriores.

---

# 19. Versionado

Cada Module deberá poseer una versión independiente.

El versionado deberá comunicar:

- compatibilidad;
- incorporación de capacidades;
- correcciones;
- cambios incompatibles.

Las dependencias declaradas deberán incluir restricciones de versión cuando corresponda.

Ejemplo conceptual:

```json
{
  "id": "sales",
  "version": "1.2.0",
  "requires": {
    "inventory": "^2.0"
  }
}
```

---

# 20. Datos y persistencia

Cada Module deberá controlar sus propios modelos y mecanismos de persistencia.

Un Module no deberá modificar directamente los datos internos de otro.

La colaboración entre Modules deberá realizarse mediante:

- contratos;
- casos de uso;
- eventos;
- APIs públicas.

La propiedad de los datos deberá permanecer claramente definida.

---

# 21. Seguridad

Cada Module será responsable de declarar:

- capacidades protegidas;
- permisos requeridos;
- políticas aplicables;
- operaciones sensibles;
- eventos auditables.

La ejecución de los mecanismos generales de seguridad corresponderá a los servicios arquitectónicos definidos por MEF.

---

# 22. Observabilidad

Todo Module deberá proporcionar información suficiente para su operación.

Cuando corresponda, deberá soportar:

- logging;
- métricas;
- auditoría;
- diagnóstico;
- eventos de ciclo de vida;
- identificación de errores.

La observabilidad no deberá exponer información sensible ni detalles internos innecesarios.

---

# 23. Pruebas

Cada Module deberá contar con pruebas proporcionales a sus responsabilidades.

Podrán incluir:

- pruebas unitarias;
- pruebas de integración;
- pruebas de contratos;
- pruebas arquitectónicas;
- pruebas de compatibilidad;
- pruebas de instalación y actualización.

Las pruebas deberán validar tanto el comportamiento como los límites arquitectónicos.

---

# 24. Documentación

Cada Module deberá documentar:

- propósito;
- capacidades;
- contratos públicos;
- dependencias;
- configuración;
- eventos;
- instalación;
- actualización;
- puntos de extensión;
- restricciones conocidas.

Un Module sin documentación suficiente se considerará incompleto.

---

# 25. Invariantes arquitectónicos

| ID | Invariante |
|----|------------|
| AI-011 | Un Module no modifica el Core. |
| AI-012 | Un Module no depende de Applications. |
| AI-013 | Los elementos internos de un Module no forman parte de su API pública. |
| AI-014 | Las dependencias entre Modules utilizan contratos públicos. |
| AI-015 | Las dependencias circulares entre Modules están prohibidas. |
| AI-016 | Todo Module declara identidad, versión y dependencias. |
| AI-017 | Cada Module controla sus propios límites funcionales y datos. |
| AI-018 | Todo Module debe poder habilitarse o deshabilitarse de forma controlada. |

---

# 26. Riesgos arquitectónicos

Deberán evitarse los siguientes riesgos:

## Module monolítico

Concentrar demasiadas capacidades dentro de un solo Module.

## Acoplamiento oculto

Consumir detalles internos de otro componente.

## Dependencias circulares

Crear relaciones que impidan la evolución independiente.

## Duplicación transversal

Implementar dentro de varios Modules una capacidad que pertenece a Platform.

## Contaminación del Core

Incorporar al Core una necesidad exclusiva de un Module.

## API pública accidental

Exponer clases internas sin una decisión arquitectónica explícita.

---

# 27. Criterios de evaluación

Antes de aceptar un nuevo Module deberá verificarse:

- ¿Representa una capacidad delimitada?
- ¿Tiene alta cohesión?
- ¿Su API pública está definida?
- ¿Declara sus dependencias?
- ¿Evita ciclos?
- ¿Protege sus elementos internos?
- ¿Puede evolucionar sin modificar el Core?
- ¿Incluye pruebas y documentación?
- ¿Respeta la neutralidad arquitectónica?

---

# 28. Relación con otros componentes

```text
                   Kernel
                      │
                      ▼
                  Discovery
                      │
                      ▼
                   Registry
                      │
                      ▼
                   Modules
                 ┌────┼────┐
                 ▼    ▼    ▼
               CRM  Sales Inventory
                      │
                      ▼
                 Event Bus
```

- Discovery localiza Modules.
- Registry conserva sus metadatos.
- Kernel coordina su inicialización.
- Event Bus facilita su comunicación desacoplada.
- Platform proporciona servicios compartidos.

---

# 29. Evolución

La arquitectura de Modules deberá evolucionar mediante:

- contratos versionados;
- puntos de extensión explícitos;
- migraciones controladas;
- compatibilidad declarada;
- procesos formales de deprecación.

Los cambios incompatibles deberán documentarse mediante RFC y ADR.

---

# 30. Principio Rector

> **Toda capacidad funcional deberá encapsularse en un Module cohesivo, explícitamente versionado y capaz de evolucionar sin modificar el Core ni invadir los límites de otros componentes.**

---

# Conclusión

Modules constituye el modelo oficial de extensión funcional de MEF.

Su arquitectura permite incorporar capacidades de dominio y técnicas mediante unidades autónomas, trazables y desacopladas, preservando la estabilidad del Core y facilitando la evolución sostenible del Framework.

---

# Referencias

- FND-004 — Principios de Arquitectura
- FND-011 — Doctrina de Arquitectura
- FND-012 — Constitución de MEF
- FND-013 — Independencia del Framework
- ARQ-001 — Visión Arquitectónica
- ARQ-002 — Core
- ARQ-003 — Platform
- ARQ-005 — Kernel
- ARQ-006 — Registry
- ARQ-008 — Event Bus
- ARQ-014 — Lifecycle
- ARQ-015 — Extension Model
