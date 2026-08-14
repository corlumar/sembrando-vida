# DIC-001F — Platform y Servicios Compartidos

## Estado

Aceptado.

---

# Objetivo

Definir el vocabulario oficial de la Platform de MEF.

La Platform agrupa servicios transversales reutilizables por cualquier módulo del Framework.

Estos servicios no pertenecen a un dominio específico del negocio y pueden ser utilizados por múltiples componentes.

---

# Alcance

Este documento define los conceptos relacionados con:

- Seguridad
- Configuración
- Persistencia transversal
- Comunicación
- Auditoría
- Observabilidad
- Programación de tareas

No describe implementaciones concretas.

---

# MEF-DIC-0051

## Authentication

### Definición

Proceso mediante el cual el Framework verifica la identidad de un usuario, servicio o sistema externo.

Authentication responde a la pregunta:

> ¿Quién eres?

### Propósito

Garantizar que únicamente identidades válidas puedan acceder al Framework.

### Categoría

Platform

### Documento de origen

ARQ-003

### No confundir con

Authorization

### Estado

Estable

---

# MEF-DIC-0052

## Authorization

### Definición

Proceso mediante el cual el Framework determina las acciones permitidas para una identidad autenticada.

Authorization responde a la pregunta:

> ¿Qué puedes hacer?

### Propósito

Controlar el acceso a recursos y operaciones.

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0053

## Cache

### Definición

Servicio destinado a almacenar temporalmente información para reducir tiempos de respuesta y consumo de recursos.

### Propósito

Optimizar el rendimiento del Framework.

### Categoría

Platform

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0054

## Scheduler

### Definición

Servicio encargado de ejecutar procesos programados de forma automática.

### Propósito

Automatizar tareas periódicas del Framework y de los módulos.

### Ejemplos

- Limpieza de archivos temporales.
- Envío de recordatorios.
- Sincronización de datos.

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0055

## Notification

### Definición

Servicio responsable del envío de mensajes hacia usuarios o sistemas externos.

### Propósito

Centralizar la comunicación saliente del Framework.

### Canales

- Correo electrónico
- SMS
- Push
- Webhook
- Mensajería interna

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0056

## Audit

### Definición

Servicio encargado de registrar acciones relevantes realizadas dentro del Framework.

### Propósito

Proporcionar trazabilidad y cumplimiento normativo.

### Información registrada

- Usuario
- Fecha y hora
- Acción
- Recurso
- Resultado

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0057

## Logging

### Definición

Servicio encargado de registrar información técnica sobre la ejecución del Framework.

Los logs están orientados al diagnóstico y operación.

### Propósito

Facilitar el análisis de errores y el monitoreo.

### No confundir con

Audit

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0058

## Localization

### Definición

Servicio que permite adaptar el Framework a distintos idiomas, regiones y configuraciones culturales.

### Propósito

Facilitar la internacionalización de las aplicaciones.

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0059

## Configuration

### Definición

Servicio responsable de proporcionar acceso consistente a la configuración del Framework.

Representa la fuente oficial de parámetros de ejecución.

### Propósito

Centralizar la gestión de configuración.

### Documento de origen

ARQ-003

### Estado

Estable

---

# MEF-DIC-0060

## Storage

### Definición

Servicio encargado de abstraer el acceso a sistemas de almacenamiento.

Permite trabajar con distintos proveedores sin modificar la lógica de negocio.

### Propósito

Desacoplar el Framework de implementaciones específicas de almacenamiento.

### Ejemplos

- Disco local
- Amazon S3
- Azure Blob Storage
- Google Cloud Storage

### Documento de origen

ARQ-003

### Estado

Estable

---

# Principios

Los servicios de Platform deberán:

- ser reutilizables;
- no contener lógica de negocio;
- exponer contratos estables;
- poder sustituirse por implementaciones equivalentes;
- estar disponibles para cualquier módulo.

---

# Relaciones

```text
Application
        │
        ▼
Module
        │
        ▼
Platform
        │
        ▼
Authentication
Authorization
Cache
Scheduler
Notification
Audit
Logging
Localization
Configuration
Storage
```

---

# Resumen

| ID | Término |
|----|----------|
| MEF-DIC-0051 | Authentication |
| MEF-DIC-0052 | Authorization |
| MEF-DIC-0053 | Cache |
| MEF-DIC-0054 | Scheduler |
| MEF-DIC-0055 | Notification |
| MEF-DIC-0056 | Audit |
| MEF-DIC-0057 | Logging |
| MEF-DIC-0058 | Localization |
| MEF-DIC-0059 | Configuration |
| MEF-DIC-0060 | Storage |

---

# Decisiones

1. La Platform proporciona capacidades transversales; no implementa lógica de negocio.
2. Todos los servicios de Platform deberán exponerse mediante Contracts.
3. Los módulos consumirán servicios de Platform mediante Inyección de Dependencias.
4. Logging y Audit representan responsabilidades distintas y no deberán mezclarse.
5. Los servicios de Platform podrán sustituirse sin afectar a los consumidores.

---

# Conclusión

DIC-001F establece el vocabulario oficial de la Platform de MEF.

Estos conceptos representan las capacidades compartidas del Framework y constituyen la base sobre la que los módulos implementarán funcionalidades de negocio sin duplicar infraestructura.