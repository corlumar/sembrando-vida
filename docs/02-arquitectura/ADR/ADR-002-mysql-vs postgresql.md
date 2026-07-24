# ADR-002

# Selección del Sistema de Gestión de Base de Datos (MySQL vs PostgreSQL)

**Estado:** Aprobado

**Versión:** 1.0

**Fecha:** 2026

**Autor:** Equipo de Arquitectura ERP Core

---

# Contexto

El ERP Core requiere un sistema de gestión de bases de datos relacional que proporcione estabilidad, rendimiento, seguridad y escalabilidad para soportar aplicaciones empresariales de misión crítica.

La base de datos deberá almacenar información correspondiente a múltiples dominios funcionales, entre ellos:

- Administración
- Seguridad
- CRM
- Recursos Humanos
- Inventarios
- Compras
- Ventas
- Comercialización
- Gestión Documental
- Proyectos
- Sembrando Vida
- futuras aplicaciones del ERP Core

Además, deberá soportar:

- millones de registros;
- múltiples usuarios concurrentes;
- integridad transaccional;
- respaldo y recuperación;
- auditoría;
- alta disponibilidad;
- crecimiento continuo.

---

# Problema

Era necesario seleccionar un motor de base de datos que equilibrara:

- rendimiento;
- facilidad de administración;
- madurez tecnológica;
- costo;
- soporte de Laravel;
- disponibilidad de talento;
- posibilidades de escalamiento.

---

# Alternativas evaluadas

## Alternativa 1 — MySQL

### Ventajas

- Integración nativa con Laravel.
- Amplia adopción mundial.
- Excelente documentación.
- Gran disponibilidad de administradores.
- Alto rendimiento para aplicaciones OLTP.
- Administración sencilla.
- Amplio soporte en proveedores de hosting.
- Excelente compatibilidad con herramientas de respaldo.
- Ecosistema muy maduro.

### Desventajas

- Algunas capacidades analíticas son inferiores a PostgreSQL.
- Menor flexibilidad en tipos avanzados de datos.
- Menor riqueza de funcionalidades SQL avanzadas.

---

## Alternativa 2 — PostgreSQL

### Ventajas

- Excelente cumplimiento del estándar SQL.
- Tipos de datos avanzados.
- JSONB nativo.
- Mejor soporte para consultas complejas.
- Muy potente para analítica.
- Excelente extensibilidad.
- Muy utilizado en arquitecturas empresariales.

### Desventajas

- Administración ligeramente más compleja.
- Mayor curva de aprendizaje.
- Menor disponibilidad en algunos servicios de hosting compartido.
- Requiere mayor experiencia para optimizar su rendimiento.

---

# Comparativa

| Criterio | MySQL | PostgreSQL |
|-----------|--------|------------|
| Integración con Laravel | Excelente | Excelente |
| Rendimiento OLTP | Excelente | Excelente |
| Consultas complejas | Bueno | Excelente |
| JSON | Bueno | Excelente |
| Curva de aprendizaje | Baja | Media |
| Comunidad | Muy grande | Muy grande |
| Hosting compartido | Excelente | Bueno |
| Facilidad de administración | Excelente | Muy buena |
| Escalabilidad | Excelente | Excelente |
| Madurez | Excelente | Excelente |

---

# Decisión

Se adopta **MySQL** como sistema de gestión de bases de datos oficial del ERP Core.

---

# Justificación

La decisión se fundamenta en los siguientes aspectos:

- Integración nativa y ampliamente probada con Laravel.
- Menor complejidad operativa.
- Amplia disponibilidad de personal especializado.
- Excelente rendimiento para aplicaciones empresariales transaccionales.
- Facilidad de respaldo y recuperación.
- Compatibilidad con la infraestructura tecnológica actualmente utilizada.
- Menores costos de operación y mantenimiento.
- Amplio soporte por proveedores de hospedaje y servicios administrados.

Para las necesidades funcionales previstas del ERP Core, MySQL satisface completamente los requerimientos técnicos y de negocio.

---

# Consecuencias

## Positivas

- Reducción en tiempos de desarrollo.
- Simplificación del despliegue.
- Administración más sencilla.
- Mayor disponibilidad de herramientas.
- Excelente integración con Laravel.
- Alta compatibilidad con servicios en la nube.

## Negativas

- Algunas funcionalidades avanzadas presentes en PostgreSQL no estarán disponibles de forma nativa.
- En escenarios analíticos muy complejos podrían requerirse soluciones complementarias.

---

# Riesgos

| Riesgo | Mitigación |
|---------|------------|
| Crecimiento acelerado de la base de datos | Particionamiento, índices y optimización periódica |
| Consultas lentas | Monitoreo y ajuste de índices |
| Aumento de usuarios concurrentes | Escalamiento vertical y horizontal |
| Incremento del volumen documental | Separación del almacenamiento de archivos |

---

# Revisión futura

Esta decisión podrá revisarse cuando ocurra alguno de los siguientes escenarios:

- necesidad de capacidades analíticas avanzadas;
- requerimientos especializados de georreferenciación;
- adopción de arquitecturas distribuidas que justifiquen otra tecnología;
- cambios significativos en la estrategia tecnológica del ERP Core.

---

# Impacto arquitectónico

La adopción de MySQL impacta directamente en:

- Arquitectura de Datos (ARQ-004)
- Arquitectura Tecnológica (ARQ-005)
- Estrategia de Respaldo y Recuperación
- Modelo de Persistencia
- Diseño de Migraciones Laravel
- Estrategia de Alta Disponibilidad
- Políticas de Auditoría

---

# Referencias

- Documentación oficial de Laravel.
- Documentación oficial de MySQL.
- Manual de Arquitectura del ERP Core.
- ADR-001 — Adopción de Laravel como Framework Principal.