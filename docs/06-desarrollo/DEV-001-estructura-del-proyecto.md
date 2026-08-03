# DEV-001

# Estructura Oficial del Proyecto ERP Core

**Versión:** 1.0

**Estado:** Vigente

**Clasificación:** Estándar de Desarrollo

**Autor:** Equipo de Arquitectura ERP Core

---

# Objetivo

Definir la estructura oficial del proyecto ERP Core para garantizar un desarrollo consistente, escalable y mantenible.

Este documento establece cómo debe organizarse el código fuente, evitando el crecimiento desordenado del proyecto y facilitando el trabajo colaborativo.

---

# Alcance

Este estándar aplica a:

- Core del ERP.
- Módulos funcionales.
- Dominios de negocio.
- Aplicaciones específicas.
- Componentes compartidos.
- Integraciones.
- APIs.
- Pruebas.

Todo nuevo desarrollo deberá respetar la estructura aquí definida.

---

# Principios

La organización del proyecto deberá cumplir los siguientes principios:

- Alta cohesión.
- Bajo acoplamiento.
- Separación de responsabilidades.
- Reutilización.
- Escalabilidad.
- Independencia entre dominios.
- Facilidad de pruebas.
- Mantenibilidad.

---

# Organización General

La estructura del proyecto se divide en cinco niveles principales:

```text
ERP Core
│
├── Core
├── Platform
├── Domains
├── Modules
└── Apps
```

Cada nivel tiene responsabilidades claramente definidas.

---

# Core

Contiene los componentes fundamentales del ERP.

Nunca dependerá de ningún dominio funcional.

Ejemplos:

- autenticación;
- autorización;
- auditoría;
- configuración;
- excepciones;
- contratos;
- eventos;
- utilidades;
- constantes.

Su propósito es proporcionar capacidades comunes a toda la plataforma.

---

# Platform

Agrupa servicios técnicos reutilizables.

Ejemplos:

- almacenamiento;
- correo electrónico;
- caché;
- colas;
- integraciones externas;
- servicios HTTP;
- generación de documentos;
- monitoreo.

La Platform encapsula la infraestructura tecnológica.

---

# Domains

Representan el negocio.

Cada dominio debe ser completamente independiente.

Ejemplos:

- CRM
- Recursos Humanos
- Inventarios
- Compras
- Ventas
- Comercialización
- Sembrando Vida

Cada dominio contendrá sus propias entidades, reglas y casos de uso.

---

# Modules

Los módulos implementan funcionalidades reutilizables construidas sobre uno o varios dominios.

Ejemplos:

- Dashboard
- Reportes
- Workflow
- Gestión Documental
- Importadores
- Exportadores

No contienen reglas propias del negocio.

---

# Apps

Representan implementaciones específicas del ERP.

Ejemplos:

- Sembrando Vida
- Corporativo Lumar
- Centro de Desarrollo Humano

Las Apps personalizan el comportamiento sin modificar el Core.

---

# Estructura Física

Inicialmente, la organización del directorio `app` será:

```text
app/
│
├── Core/
│
├── Platform/
│
├── Domains/
│
├── Modules/
│
└── Apps/
```

Esta estructura coexistirá con la organización estándar de Laravel durante la transición.

---

# Organización de un Dominio

Cada dominio seguirá una estructura uniforme.

Ejemplo:

```text
Domains/
└── CRM/
    ├── Actions/
    ├── DTO/
    ├── Entities/
    ├── Events/
    ├── Exceptions/
    ├── Http/
    │   ├── Controllers/
    │   ├── Middleware/
    │   ├── Requests/
    │   └── Resources/
    ├── Models/
    ├── Policies/
    ├── Repositories/
    ├── Rules/
    ├── Services/
    ├── Traits/
    ├── UseCases/
    └── routes.php
```

Todos los dominios deberán respetar esta organización.

---

# Dependencias

Las dependencias permitidas son:

```text
Apps
 ↓
Modules
 ↓
Domains
 ↓
Platform
 ↓
Core
```

No estarán permitidas dependencias en sentido contrario.

---

# Convenciones

- Un dominio no modificará directamente otro dominio.
- La comunicación entre dominios deberá realizarse mediante servicios, eventos o contratos.
- Toda funcionalidad reutilizable deberá implementarse fuera de las Apps.
- Ningún componente podrá acceder directamente a la infraestructura sin pasar por la Platform.

---

# Integración con Laravel

El ERP Core aprovechará las capacidades del framework Laravel, incluyendo:

- Service Providers.
- Dependency Injection.
- Middleware.
- Policies.
- Gates.
- Queues.
- Events.
- Jobs.
- Notifications.
- Migrations.
- Seeders.

La estructura definida en este documento complementa la organización de Laravel, sin reemplazar sus convenciones fundamentales.

---

# Beneficios Esperados

La adopción de esta estructura permitirá:

- mayor claridad del código;
- incorporación rápida de nuevos desarrolladores;
- reutilización entre proyectos;
- reducción del acoplamiento;
- facilidad para realizar pruebas;
- evolución independiente de cada dominio.

---

# Documentos Relacionados

- ADR-003 — Arquitectura Modular Basada en Dominios.
- ARQ-001 — Fundamentos Arquitectónicos.
- ARQ-003 — Arquitectura de Aplicaciones.
- DEV-002 — Convenciones de Desarrollo.
- DEV-003 — Organización de Módulos.

---

# Historial de Versiones

| Versión | Descripción | Estado |
|----------|-------------|--------|
| 1.0 | Primera versión del estándar de estructura del proyecto | Vigente |