# DEV-003

# Organización de Módulos del ERP Core

**Versión:** 1.0

**Estado:** Vigente

**Clasificación:** Estándar de Desarrollo

**Autor:** Equipo de Arquitectura ERP Core

---

# Objetivo

Definir la estructura, responsabilidades, ciclo de vida y reglas de construcción de los módulos que conforman el ERP Core.

Este documento establece un modelo uniforme para desarrollar componentes funcionales reutilizables, desacoplados y escalables.

Todo módulo desarrollado para el ERP deberá cumplir este estándar.

---

# ¿Qué es un módulo?

Un módulo representa una capacidad funcional del ERP.

Debe encapsular completamente un conjunto de procesos relacionados.

Ejemplos:

- CRM
- Recursos Humanos
- Inventarios
- Compras
- Ventas
- Comercialización
- Gestión Documental
- Sembrando Vida

Cada módulo deberá ser independiente y responsable únicamente de su propio dominio funcional.

---

# Objetivos de un módulo

Todo módulo deberá:

- encapsular reglas de negocio;
- minimizar dependencias externas;
- reutilizar componentes del Core;
- ser instalable;
- ser actualizable;
- ser deshabilitable;
- poder evolucionar independientemente.

---

# Principios

Los módulos deberán cumplir:

- Alta cohesión.
- Bajo acoplamiento.
- Responsabilidad única.
- Reutilización.
- Separación entre negocio e infraestructura.
- Independencia tecnológica.

---

# Arquitectura interna

Cada módulo seguirá la siguiente organización:

```text
Modules/
└── CRM/
    │
    ├── Config/
    │
    ├── Console/
    │
    ├── Database/
    │     ├── Factories/
    │     ├── Migrations/
    │     └── Seeders/
    │
    ├── Domain/
    │     ├── Entities/
    │     ├── Events/
    │     ├── Exceptions/
    │     ├── Policies/
    │     ├── Repositories/
    │     ├── Services/
    │     ├── ValueObjects/
    │     └── Rules/
    │
    ├── Application/
    │     ├── Actions/
    │     ├── Commands/
    │     ├── DTO/
    │     ├── Queries/
    │     └── UseCases/
    │
    ├── Infrastructure/
    │     ├── Persistence/
    │     ├── Notifications/
    │     ├── Mail/
    │     ├── Storage/
    │     └── Cache/
    │
    ├── Http/
    │     ├── Controllers/
    │     ├── Middleware/
    │     ├── Requests/
    │     ├── Resources/
    │     └── routes.php
    │
    ├── Providers/
    │
    ├── Resources/
    │     ├── Lang/
    │     ├── Views/
    │     └── Assets/
    │
    ├── Tests/
    │
    ├── module.json
    │
    └── README.md
```

---

# Responsabilidad de cada carpeta

## Config

Configuraciones propias del módulo.

---

## Console

Comandos Artisan específicos.

---

## Database

Migraciones, seeders y factories.

Nunca deberán mezclarse con otros módulos.

---

## Domain

Contiene el negocio puro.

Aquí viven:

- entidades;
- reglas;
- eventos;
- excepciones;
- contratos;
- políticas.

No deberá depender de Laravel siempre que sea posible.

---

## Application

Orquesta los casos de uso.

Coordina:

- servicios;
- DTO;
- comandos;
- consultas.

No contiene infraestructura.

---

## Infrastructure

Implementa detalles técnicos.

Ejemplos:

- Eloquent
- Cache
- Mail
- Storage
- HTTP
- Integraciones

---

## Http

Expone el módulo al exterior.

Incluye:

- Controllers
- Requests
- Resources
- Middleware
- Routes

---

## Providers

Registra automáticamente el módulo.

---

## Resources

Recursos visuales.

- vistas;
- traducciones;
- JavaScript;
- CSS;
- imágenes.

---

## Tests

Todas las pruebas del módulo.

Debe existir una carpeta de pruebas desde la creación del módulo.

---

# Archivo module.json

Cada módulo deberá incluir un manifiesto.

Ejemplo:

```json
{
  "name": "CRM",
  "display_name": "Gestión Comercial",
  "version": "1.0.0",
  "description": "Gestión de clientes y oportunidades",
  "provider": "Modules\\CRM\\Providers\\CRMServiceProvider",
  "dependencies": [],
  "enabled": true,
  "permissions": true,
  "routes": true,
  "migrations": true,
  "seeders": true,
  "menu": true
}
```

---

# Descubrimiento automático

El ERP Core implementará un mecanismo de descubrimiento automático.

Proceso:

1. Buscar módulos en `/app/Modules`.
2. Leer `module.json`.
3. Validar dependencias.
4. Registrar `ServiceProvider`.
5. Registrar rutas.
6. Registrar migraciones.
7. Registrar permisos.
8. Registrar menús.
9. Publicar recursos.

Este proceso deberá ejecutarse durante el arranque de la aplicación.

---

# Dependencias entre módulos

Las dependencias deberán declararse explícitamente.

Ejemplo:

```json
{
    "dependencies": [
        "CRM",
        "Security"
    ]
}
```

No estarán permitidas dependencias circulares.

---

# Registro de permisos

Cada módulo publicará automáticamente sus permisos.

Ejemplo:

```
crm.view

crm.create

crm.update

crm.delete
```

Los permisos serán consumidos por el módulo de Seguridad.

---

# Registro de menús

Cada módulo podrá publicar sus propios elementos de navegación.

Ejemplo:

```
CRM

├── Clientes
├── Contactos
├── Prospectos
└── Oportunidades
```

El menú final será construido dinámicamente.

---

# Versionado

Cada módulo tendrá un ciclo de vida independiente.

Ejemplo:

```
CRM

1.0.0

↓

1.1.0

↓

1.2.0

↓

2.0.0
```

Las actualizaciones deberán respetar Semantic Versioning.

---

# Instalación

El ERP Core proporcionará comandos Artisan para administrar módulos.

Ejemplos:

```bash
php artisan erp:make-module CRM

php artisan erp:install-module CRM

php artisan erp:update-module CRM

php artisan erp:disable-module CRM

php artisan erp:enable-module CRM

php artisan erp:list-modules
```

---

# Requisitos mínimos

Todo módulo deberá incluir:

- README.
- Tests.
- module.json.
- Service Provider.
- Migraciones.
- Policies.
- Validaciones.
- Documentación.

No se aceptarán módulos incompletos.

---

# Definition of Done

Un módulo se considerará terminado cuando:

- compile correctamente;
- registre sus rutas;
- registre sus permisos;
- registre su menú;
- pase todas las pruebas;
- incluya documentación;
- tenga migraciones;
- respete DEV-001 y DEV-002.

---

# Documentos Relacionados

- ADR-003 – Arquitectura Modular Basada en Dominios.
- ARQ-006 – Arquitectura del Sistema Modular.
- DEV-001 – Estructura del Proyecto.
- DEV-002 – Convenciones de Desarrollo.

---

# Historial de Versiones

| Versión | Descripción | Estado |
|----------|-------------|--------|
| 1.0 | Primera versión del estándar de módulos | Vigente |