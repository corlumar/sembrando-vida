# ARQ-003 — Platform

## Estado

Aceptado.

---

# Objetivo

La Platform constituye la capa de servicios compartidos de MEF.

Su propósito es proporcionar capacidades comunes utilizadas por múltiples módulos sin incorporarlas al Core.

Mientras el Core ofrece infraestructura técnica, Platform ofrece servicios de plataforma reutilizables.

---

# ¿Por qué existe Platform?

No toda funcionalidad reutilizable pertenece al Core.

Existen servicios que:

- no representan lógica de negocio;
- son utilizados por muchos módulos;
- requieren configuración propia;
- pueden evolucionar independientemente.

Estos servicios pertenecen a Platform.

---

# Responsabilidades

Platform proporciona servicios compartidos como:

- Autenticación
- Autorización
- Notificaciones
- Auditoría
- Cache
- Queue
- Scheduler
- Workflow
- Configuración
- Logs
- Gestión de archivos
- Búsqueda
- Integraciones

Estos servicios pueden ser utilizados por cualquier módulo.

---

# Lo que Platform NO es

Platform no implementa procesos empresariales.

No contiene:

- CRM
- Inventarios
- Recursos Humanos
- Compras
- Ventas
- Producción

Estas responsabilidades pertenecen exclusivamente a los módulos.

---

# Diferencia entre Core y Platform

## Core

Proporciona infraestructura.

Ejemplos:

- Kernel
- Registry
- Discovery
- Builders
- Template Engine
- CLI
- Contracts

---

## Platform

Proporciona servicios compartidos.

Ejemplos:

- Authentication
- Authorization
- Notifications
- Workflow
- Cache
- Queue
- Scheduler
- Search

---

# Organización prevista

```text
app/
└── Platform/
    ├── Authentication/
    ├── Authorization/
    ├── Cache/
    ├── Configuration/
    ├── Events/
    ├── Logging/
    ├── Notifications/
    ├── Queue/
    ├── Scheduler/
    ├── Search/
    └── Workflow/
```

---

# Dependencias

Platform puede depender de:

- Core

Platform no puede depender de:

- Modules
- Applications

---

# Relación con los módulos

Los módulos pueden consumir cualquier servicio de Platform.

Ejemplo:

CRM

↓

Authentication

↓

Notifications

↓

Workflow

↓

Core

Los módulos nunca deberán implementar nuevamente funcionalidades que ya existan en Platform.

---

# Ejemplo práctico

Cuando el módulo CRM necesita enviar una notificación:

NO hace esto:

CRM

↓

SMTP

Hace esto:

CRM

↓

Platform Notifications

↓

Proveedor de correo

La infraestructura permanece desacoplada.

---

# Principios

Platform deberá cumplir:

- Bajo acoplamiento.
- Alta cohesión.
- Independencia del negocio.
- Reutilización.
- Configuración centralizada.
- Pruebas automatizadas.

---

# Componentes previstos

Durante la evolución de MEF se incorporarán:

## Seguridad

- Authentication
- Authorization
- MFA

---

## Comunicación

- Notifications
- Mail
- SMS
- Push
- Webhooks

---

## Procesamiento

- Queue
- Scheduler
- Jobs

---

## Persistencia

- Cache
- Search
- Storage

---

## Observabilidad

- Logs
- Metrics
- Monitoring
- Audit

---

## Automatización

- Workflow
- Rules Engine
- Automation

---

# Beneficios

Separar Platform del Core permite:

- mantener un Core pequeño;
- reutilizar servicios;
- evitar duplicación;
- facilitar pruebas;
- desacoplar la infraestructura del negocio.

---

# Evolución

Platform crecerá conforme aparezcan nuevas necesidades compartidas.

Sin embargo, deberá conservar el mismo principio fundamental:

> Todo componente de Platform debe ser útil para múltiples módulos.

Si un componente únicamente sirve para un módulo específico, probablemente pertenece a dicho módulo y no a Platform.

---

# Conclusión

Platform representa la capa de servicios compartidos de MEF.

Su misión es ofrecer capacidades reutilizables que permitan construir módulos empresariales sin duplicar infraestructura ni contaminar el Core con responsabilidades que no le corresponden.