# ARQ-001
# Principios Arquitectónicos del ERP Core

**Código:** ARQ-001-04

**Versión:** 1.0

**Estado:** Aprobado

---

# 1. Introducción

Los principios arquitectónicos representan las reglas fundamentales que orientan el diseño, desarrollo y evolución del ERP Core.

Su propósito es garantizar que todos los módulos del sistema mantengan una arquitectura consistente, segura, escalable y fácil de mantener.

Estos principios son de cumplimiento obligatorio para cualquier desarrollo realizado dentro del ERP Core.

---

# 2. Principios generales

## 2.1 Modularidad

Cada funcionalidad deberá implementarse como un módulo independiente.

Un módulo encapsula:

- reglas de negocio;
- modelos;
- controladores;
- servicios;
- políticas;
- validaciones;
- vistas;
- rutas;
- pruebas.

Ningún módulo deberá depender directamente de la implementación interna de otro módulo.

---

## 2.2 Separación de responsabilidades

Cada componente deberá tener una única responsabilidad claramente definida.

Ejemplos:

- El controlador recibe la petición HTTP.
- El servicio ejecuta la lógica de negocio.
- El modelo representa la entidad.
- El repositorio obtiene información.
- La política controla permisos.
- El Form Request valida datos.

---

## 2.3 Bajo acoplamiento

Los módulos deberán comunicarse mediante interfaces públicas, eventos o servicios compartidos.

Se prohíbe acceder directamente a clases internas de otro módulo.

---

## 2.4 Alta cohesión

Todas las clases pertenecientes a un módulo deberán estar relacionadas con el mismo dominio de negocio.

No deberán mezclarse responsabilidades distintas dentro del mismo componente.

---

# 3. Organización del proyecto

La estructura mínima del proyecto será:

```text
app/

Core/
Modules/
Shared/
Domain/
Infrastructure/
Application/
```

Cada módulo podrá contener:

```text
CRM/

Controllers/
Services/
Models/
Policies/
Requests/
Repositories/
Events/
Listeners/
Observers/
Jobs/
Notifications/
Rules/
Exports/
Imports/
Tests/
```

---

# 4. Reglas para Controladores

Los controladores deben ser ligeros.

Un controlador únicamente deberá:

- validar la petición;
- invocar un servicio;
- devolver una respuesta.

No deberá contener reglas de negocio.

Ejemplo correcto:

```php
public function store(StoreClientRequest $request)
{
    return $this->clientService->create($request->validated());
}
```

---

# 5. Reglas para Servicios

Toda lógica de negocio deberá implementarse dentro de servicios.

Ejemplos:

- Crear cliente.
- Registrar cosecha.
- Procesar venta.
- Generar factura.
- Calcular indicadores.

Los servicios deberán ser reutilizables.

---

# 6. Reglas para Modelos

Los modelos Eloquent representan entidades del dominio.

No deberán contener procesos complejos.

Se utilizarán para:

- relaciones;
- scopes;
- casts;
- atributos calculados;
- mutadores.

---

# 7. Validaciones

Toda validación deberá implementarse mediante Form Request.

No deberán existir validaciones distribuidas en:

- controladores;
- vistas;
- modelos.

---

# 8. Autorización

La autorización deberá implementarse mediante Policies y Gates.

No se permitirán verificaciones de permisos distribuidas en el código.

Ejemplo:

```php
$this->authorize('update', $cliente);
```

---

# 9. Eventos

Los eventos deberán utilizarse cuando una acción pueda interesar a múltiples módulos.

Ejemplos:

- ClienteRegistrado
- UsuarioCreado
- VentaConfirmada
- PagoAplicado

Esto reduce el acoplamiento entre módulos.

---

# 10. Jobs y Colas

Los procesos pesados deberán ejecutarse mediante colas.

Ejemplos:

- envío de correos;
- generación de reportes;
- exportaciones;
- importaciones;
- procesamiento masivo.

La interfaz nunca deberá esperar procesos largos.

---

# 11. API First

Toda funcionalidad deberá poder exponerse mediante API.

Las vistas consumirán la misma lógica utilizada por la API.

Esto facilita futuras integraciones.

---

# 12. Convenciones de nombres

## Clases

PascalCase

Ejemplo:

```
ClientService
HarvestController
CommercializationRepository
```

---

## Variables

camelCase

```
clientName
totalHarvest
activeUsers
```

---

## Tablas

snake_case

```
clients
client_addresses
harvest_records
```

---

## Rutas

kebab-case

```
/clientes
/comercializacion
/cosechas
```

---

# 13. Base de datos

Toda modificación deberá realizarse mediante migraciones.

Queda prohibido modificar tablas manualmente en producción.

Cada migración deberá ser reversible mediante:

```php
down()
```

---

# 14. Pruebas

Todo módulo deberá incorporar pruebas automatizadas.

Tipos mínimos:

- Unitarias
- Integración
- Funcionales

Las nuevas funcionalidades no deberán reducir la cobertura existente.

---

# 15. Seguridad

Todo desarrollo deberá cumplir como mínimo:

- validación de entradas;
- protección CSRF;
- protección XSS;
- consultas parametrizadas;
- autorización;
- autenticación;
- auditoría;
- registro de errores.

---

# 16. Observabilidad

Todas las operaciones críticas deberán generar información para auditoría.

Ejemplos:

- inicio de sesión;
- modificaciones;
- eliminaciones;
- exportaciones;
- cambios de permisos.

---

# 17. Rendimiento

Se deberán evitar:

- consultas N+1;
- cargas innecesarias;
- duplicidad de consultas;
- procesamiento dentro de ciclos.

Se promoverá:

- eager loading;
- cache;
- índices;
- paginación.

---

# 18. Evolución

La arquitectura deberá permitir incorporar nuevos módulos sin modificar el núcleo del sistema.

La incorporación de un nuevo módulo no deberá afectar el funcionamiento de los existentes.

---

# 19. Architecture Decision Records (ADR)

Toda decisión arquitectónica relevante deberá documentarse.

Ejemplos:

- elección de Laravel;
- elección de PostgreSQL;
- incorporación de Redis;
- uso de OAuth;
- estrategia de despliegue.

Cada ADR deberá indicar:

- problema;
- alternativas;
- decisión;
- consecuencias.

---

# 20. Conclusión

Los principios definidos en este documento constituyen la guía oficial para el desarrollo del ERP Core.

Su cumplimiento permitirá construir una plataforma consistente, mantenible y preparada para evolucionar durante los próximos años sin perder coherencia arquitectónica.