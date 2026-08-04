# ARQ-006 — Registry

## Estado

Aceptado.

---

# Objetivo

El Registry es el componente encargado de mantener el registro oficial de módulos y metadatos disponibles dentro de MEF.

Su función es proporcionar una fuente única y confiable de información sobre los módulos descubiertos, registrados y habilitados en el Framework.

El Registry no descubre módulos por sí mismo.

El Registry recibe módulos validados y los mantiene disponibles para consulta durante el ciclo de vida de MEF.

---

# Responsabilidades

El Registry es responsable de:

- registrar módulos;
- almacenar metadatos;
- consultar módulos registrados;
- comprobar si un módulo existe;
- obtener módulos habilitados;
- consultar versiones;
- consultar proveedores de servicios;
- consultar dependencias;
- evitar registros duplicados;
- mantener el estado interno de los módulos.

---

# Principios

El Registry debe cumplir los siguientes principios:

- Tener una única responsabilidad.
- Mantener una fuente única de verdad.
- No ejecutar lógica de negocio.
- No descubrir archivos directamente.
- No registrar proveedores por sí mismo.
- Exponer una API predecible.
- Ser comprobable mediante pruebas.
- Mantener consistencia durante todo el ciclo de vida del Framework.

---

# Fuente única de verdad

Dentro de MEF, el Registry constituye la fuente oficial para conocer qué módulos están disponibles.

Otros componentes no deberán escanear directamente el sistema de archivos para responder preguntas como:

- ¿Existe el módulo CRM?
- ¿Qué versión tiene Organización?
- ¿Cuál es su Service Provider?
- ¿Está habilitado?
- ¿Qué dependencias declara?

Estas consultas deberán resolverse mediante el Registry.

---

# Información registrada

Cada módulo deberá aportar, como mínimo, los siguientes metadatos:

```text
Nombre
Slug
Versión
Descripción
Proveedor de servicios
Estado
Dependencias
Ruta física
Manifest
```

En versiones posteriores podrán añadirse:

```text
Autor
Licencia
Compatibilidad
Checksum
Fecha de instalación
Fecha de actualización
Canal de distribución
```

---

# Flujo de registro

El registro de un módulo sigue este proceso:

```text
Discovery

    │

    ▼

Manifest localizado

    │

    ▼

Validación

    │

    ▼

Creación de metadatos

    │

    ▼

Registry

    │

    ▼

Módulo disponible
```

El Registry recibe únicamente módulos válidos.

---

# Relación con Discovery

Discovery localiza módulos.

Registry almacena módulos.

```text
Discovery
    │
    ▼
Registry
```

Discovery no deberá conservar el estado permanente de los módulos encontrados.

Registry no deberá recorrer directorios ni leer manifests directamente.

---

# Relación con Kernel

El Kernel coordina el proceso de inicialización.

Durante el arranque:

1. el Kernel ejecuta Discovery;
2. Discovery localiza módulos;
3. los manifests se validan;
4. los módulos válidos se registran;
5. el Kernel consulta el Registry;
6. los proveedores correspondientes se inicializan.

```text
Kernel
   │
   ├── Discovery
   │      │
   │      ▼
   └── Registry
```

---

# Relación con los módulos

Los módulos no deberán modificar directamente el estado interno del Registry.

El registro se realizará mediante una API controlada.

Ejemplo conceptual:

```php
$registry->register($moduleMetadata);
```

La consulta podrá realizarse mediante operaciones como:

```php
$registry->has('crm');

$registry->get('crm');

$registry->all();

$registry->enabled();

$registry->dependenciesOf('crm');
```

La API definitiva se documentará en la implementación correspondiente.

---

# Modelo conceptual

```text
ModuleRegistry

├── modules
│
├── register()
├── has()
├── get()
├── all()
├── enabled()
├── disabled()
└── dependenciesOf()
```

---

# Identidad de un módulo

Cada módulo deberá tener un identificador único.

MEF utilizará preferentemente el `slug` del módulo como identificador interno.

Ejemplo:

```text
Nombre: Organización
Slug: organizacion
```

No podrán registrarse dos módulos con el mismo `slug`.

---

# Registros duplicados

Cuando se intente registrar un módulo ya existente, el Registry deberá aplicar una política explícita.

La política inicial será:

> Un módulo duplicado genera una excepción.

Esto evita sobrescrituras silenciosas y estados inconsistentes.

En futuras versiones podrá existir una estrategia controlada de reemplazo o actualización.

---

# Estados de un módulo

El Registry podrá distinguir los siguientes estados:

```text
Descubierto
Registrado
Habilitado
Deshabilitado
Incompatible
Inválido
```

Durante las primeras versiones se utilizarán principalmente:

```text
Habilitado
Deshabilitado
```

Los demás estados se incorporarán conforme evolucione el ciclo de vida de módulos.

---

# Dependencias

El Registry almacenará las dependencias declaradas por cada módulo.

Ejemplo:

```json
{
  "name": "CRM",
  "dependencies": [
    "organizacion",
    "usuarios"
  ]
}
```

El Registry no resolverá por sí mismo las dependencias.

La resolución corresponderá a un componente especializado, previsto como:

```text
DependencyResolver
```

El Registry únicamente proporcionará la información necesaria.

---

# Persistencia

En su primera versión, el Registry mantendrá los módulos en memoria durante la ejecución.

```text
Registry en memoria
```

En versiones futuras podrán incorporarse mecanismos como:

- cache;
- archivo compilado;
- base de datos;
- almacenamiento distribuido.

La persistencia no deberá alterar la API pública del Registry.

---

# Consistencia

El Registry deberá garantizar:

- identificadores únicos;
- metadatos válidos;
- ausencia de registros duplicados;
- consultas predecibles;
- estados coherentes;
- colecciones inmutables cuando sea posible.

---

# Errores

El Registry deberá utilizar excepciones específicas para situaciones como:

```text
ModuleAlreadyRegisteredException

ModuleNotFoundException

InvalidModuleMetadataException
```

No deberán utilizarse excepciones genéricas cuando exista una condición claramente identificable.

---

# Dependencias permitidas

El Registry puede depender de:

- contratos del Core;
- objetos de metadatos;
- colecciones;
- excepciones del Core.

El Registry no puede depender de:

- módulos concretos;
- aplicaciones;
- controladores;
- vistas;
- lógica de negocio;
- infraestructura externa sin abstracción.

---

# Pruebas requeridas

La implementación del Registry deberá cubrir como mínimo:

- registro de un módulo;
- consulta de un módulo;
- listado de módulos;
- comprobación de existencia;
- rechazo de duplicados;
- módulo inexistente;
- filtrado por estado;
- consulta de dependencias;
- conservación correcta de metadatos.

---

# Beneficios

Un Registry centralizado permite:

- evitar escaneos repetidos;
- mantener una fuente única de verdad;
- simplificar el Kernel;
- facilitar la CLI;
- mejorar la trazabilidad;
- preparar la resolución de dependencias;
- facilitar la administración de módulos.

---

# Uso previsto en la CLI

Comandos futuros utilizarán el Registry.

Ejemplos:

```bash
php artisan mef:list

php artisan mef:status

php artisan mef:module CRM

php artisan mef:enable CRM

php artisan mef:disable CRM
```

Estos comandos deberán consultar el Registry en lugar de recorrer el sistema de archivos directamente.

---

# Evolución prevista

El Registry evolucionará para soportar:

- módulos instalados;
- módulos disponibles;
- módulos habilitados;
- compatibilidad de versiones;
- dependencias;
- plugins;
- extensiones;
- paquetes remotos;
- Marketplace.

Toda evolución deberá preservar su responsabilidad principal:

> Mantener el registro oficial de componentes disponibles en MEF.

---

# Diagrama conceptual

```text
                Kernel

                   │

                   ▼

              Discovery

                   │

                   ▼

            Manifest Validator

                   │

                   ▼

                Registry

       ┌───────────┼───────────┐

       ▼           ▼           ▼

     CLI       Providers    Dependency
                            Resolver
```

---

# Matriz de responsabilidad

| Actividad | Kernel | Discovery | Registry |
|---|---:|---:|---:|
| Coordinar el arranque | Sí | No | No |
| Buscar módulos | No | Sí | No |
| Leer manifests | No | Sí | No |
| Validar manifests | Coordina | Puede delegar | No |
| Registrar metadatos | No | Solicita | Sí |
| Mantener estado | No | No | Sí |
| Consultar módulos | Sí | No | Sí |
| Resolver dependencias | Coordina | No | Proporciona datos |

---

# Decisiones arquitectónicas

1. El Registry será la fuente única de verdad para módulos registrados.
2. Discovery no conservará estado permanente.
3. Los módulos se identificarán mediante un `slug` único.
4. Los registros duplicados producirán una excepción.
5. La primera implementación será en memoria.
6. La persistencia futura no deberá romper la API pública.
7. La resolución de dependencias pertenecerá a un componente independiente.

---

# Criterios de aceptación

ARQ-006 se considerará implementado cuando existan:

- contrato del Registry;
- implementación en memoria;
- objeto de metadatos de módulo;
- excepciones específicas;
- pruebas unitarias;
- integración con Kernel;
- integración con Discovery;
- documentación de la API pública.

---

# Conclusión

El Registry constituye el catálogo oficial de módulos de MEF.

Su responsabilidad es mantener información confiable, consistente y consultable sobre los componentes registrados durante la ejecución del Framework.

El Registry conoce los módulos.

No los descubre.

No los ejecuta.

No implementa su negocio.