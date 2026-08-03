# DEV-002

# Convenciones de Desarrollo del ERP Core

**Versión:** 1.0

**Estado:** Vigente

**Clasificación:** Estándar de Desarrollo

**Autor:** Equipo de Arquitectura ERP Core

---

# Objetivo

Establecer las convenciones oficiales de desarrollo del ERP Core para garantizar un código consistente, legible, mantenible y alineado con la arquitectura definida.

Estas reglas son obligatorias para todos los módulos, dominios y aplicaciones construidos sobre la plataforma.

---

# Principios Generales

Todo desarrollo deberá seguir los siguientes principios:

- Simplicidad.
- Legibilidad.
- Reutilización.
- Bajo acoplamiento.
- Alta cohesión.
- Responsabilidad única.
- Inversión de dependencias.
- Código autodocumentado.
- Evitar duplicación (DRY).
- Preferir composición sobre herencia.

---

# Estándares Base

El ERP Core adopta como referencia:

- PSR-1
- PSR-4
- PSR-12
- Laravel Coding Style
- PHPDoc
- Semantic Versioning
- Conventional Commits

---

# Convenciones de Nombres

## Clases

Utilizar PascalCase.

Ejemplos:

```php
UserService
CreateOrderAction
GenerateInvoiceJob
SalesReportController
```

---

## Métodos

Utilizar camelCase.

```php
createUser()

sendNotification()

calculateTotal()
```

Los nombres deberán expresar claramente la acción realizada.

---

## Variables

camelCase.

```php
$totalAmount

$userName

$createdAt
```

Evitar abreviaturas innecesarias.

Incorrecto:

```php
$usr

$val

$tmp
```

---

## Constantes

UPPER_SNAKE_CASE.

```php
MAX_LOGIN_ATTEMPTS

DEFAULT_LANGUAGE

TOKEN_EXPIRATION
```

---

## Archivos

Cada clase deberá estar en un archivo con el mismo nombre.

Ejemplo:

```
UserService.php
```

---

# Namespaces

El namespace deberá reflejar exactamente la estructura física.

Ejemplo:

```php
App\Domains\CRM\Services
```

Nunca deberán utilizarse namespaces ambiguos.

---

# Controladores

Los controladores únicamente deberán:

- recibir la solicitud;
- validar;
- invocar un caso de uso o servicio;
- devolver la respuesta.

No deberán contener reglas de negocio.

Incorrecto:

```php
Controller

↓

consulta BD

↓

calcula impuestos

↓

genera factura

↓

envía correo
```

Correcto:

```php
Controller

↓

Service

↓

Repository

↓

Response
```

---

# Servicios

Los servicios contendrán la lógica del negocio.

Ejemplo:

```
CreateClientService

ApprovePurchaseService

GeneratePayrollService
```

Un servicio deberá tener una responsabilidad claramente definida.

---

# Repositorios

Toda interacción compleja con la persistencia deberá encapsularse mediante repositorios.

Los controladores nunca deberán construir consultas SQL complejas.

---

# DTO

Los objetos de transferencia de datos deberán utilizarse para transportar información entre capas.

Ejemplo:

```
CreateCustomerDTO

UpdateInventoryDTO
```

---

# Requests

Toda validación HTTP deberá implementarse mediante Form Requests.

Nunca validar directamente dentro del controlador.

---

# Policies

La autorización deberá implementarse mediante Policies o Gates.

Nunca realizar verificaciones de permisos directamente dentro de las vistas.

---

# Eventos

Los eventos deberán utilizarse para desacoplar procesos.

Ejemplos:

```
UserCreated

InvoiceGenerated

PaymentReceived
```

---

# Jobs

Las tareas de larga duración deberán ejecutarse mediante Jobs.

Ejemplos:

- envío masivo de correos;
- generación de reportes;
- importaciones;
- exportaciones.

---

# Excepciones

Nunca capturar excepciones genéricas innecesariamente.

Crear excepciones específicas.

Ejemplo:

```
UserNotFoundException

InsufficientStockException

InvalidWorkflowStateException
```

---

# Modelos

Los modelos Eloquent deberán representar únicamente entidades persistentes.

No deberán contener lógica compleja de negocio.

---

# Base de Datos

Las migraciones deberán:

- ser reversibles;
- utilizar claves foráneas;
- incluir índices cuando corresponda;
- respetar las convenciones de nombres.

---

# Pruebas

Todo desarrollo nuevo deberá incluir pruebas.

Tipos de pruebas:

- Unitarias.
- Integración.
- Funcionales.
- Feature Tests.

---

# Comentarios

Se deberán evitar comentarios innecesarios.

Preferir nombres descriptivos.

Incorrecto:

```php
// Incrementa contador
$count++;
```

Correcto:

```php
$failedAttempts++;
```

---

# PHPDoc

Los métodos públicos deberán documentarse cuando su propósito no sea evidente.

Ejemplo:

```php
/**
 * Genera el resumen mensual de ventas.
 */
```

---

# Logging

No utilizar:

```php
dd();

dump();

var_dump();

print_r();
```

en código de producción.

Utilizar siempre el sistema de logging oficial.

---

# Seguridad

Nunca:

- concatenar SQL;
- almacenar contraseñas en texto plano;
- exponer excepciones al usuario;
- confiar en datos del cliente.

Utilizar siempre:

- Hash::make()
- Policies
- CSRF
- Validaciones
- Middleware

---

# Git

Cada cambio deberá:

- pertenecer a una única responsabilidad;
- tener un commit claro;
- seguir Conventional Commits.

Ejemplo:

```
feat(crm): agregar gestión de oportunidades

fix(auth): corregir expiración de sesión

docs(arq): actualizar ADR-003
```

---

# Definición de Hecho (Definition of Done)

Una funcionalidad se considerará terminada cuando:

- compile correctamente;
- pase las pruebas;
- respete los estándares;
- incluya documentación;
- tenga migraciones;
- tenga autorización;
- tenga validaciones;
- esté registrada en Git.

---

# Documentos Relacionados

- DEV-001 — Estructura del Proyecto.
- DEV-003 — Organización de Módulos.
- ADR-003 — Arquitectura Modular Basada en Dominios.
- ARQ-001 — Fundamentos Arquitectónicos.

---

# Historial de Versiones

| Versión | Descripción | Estado |
|----------|-------------|--------|
| 1.0 | Primera versión del estándar de desarrollo | Vigente |