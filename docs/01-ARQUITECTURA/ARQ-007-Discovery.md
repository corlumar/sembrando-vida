# ARQ-007 — Discovery

## Estado

Aceptado.

---

# Objetivo

Discovery es el componente responsable de localizar automáticamente los módulos disponibles dentro de MEF.

Su responsabilidad consiste en recorrer las ubicaciones configuradas, identificar módulos válidos, validar sus manifiestos y proporcionar dicha información al Kernel para su registro.

Discovery no mantiene estado permanente.

Discovery no registra módulos.

Discovery únicamente descubre componentes disponibles.

---

# Responsabilidades

Discovery es responsable de:

- localizar módulos;
- recorrer directorios configurados;
- identificar manifests;
- validar la estructura mínima;
- construir metadatos temporales;
- devolver la colección de módulos encontrados.

---

# Principios

Discovery debe cumplir los siguientes principios:

- Tener una única responsabilidad.
- No mantener estado.
- No registrar módulos.
- No inicializar módulos.
- No conocer lógica de negocio.
- Ser completamente determinista.
- Ser comprobable mediante pruebas.

---

# ¿Qué descubre?

Discovery busca componentes instalados dentro de las rutas configuradas por MEF.

Ejemplo:

app/

Modules/

CRM/

Organizacion/

Inventarios/

Compras/

Cada carpeta candidata deberá contener un manifest válido.

---

# Manifest

Cada módulo deberá incluir un archivo:

```text
module.json
```

Ejemplo:

```json
{
  "name": "CRM",
  "slug": "crm",
  "version": "1.0.0",
  "provider": "App\\Modules\\CRM\\Providers\\CRMServiceProvider"
}
```

---

# Proceso de descubrimiento

```text
Inicio

↓

Leer configuración

↓

Obtener rutas

↓

Recorrer directorios

↓

Buscar module.json

↓

Validar manifest

↓

Construir metadatos

↓

Entregar colección

↓

Fin
```

---

# Flujo con Kernel

```text
Kernel

↓

Discovery

↓

Manifest Validator

↓

Metadata

↓

Registry
```

Discovery no conoce el Registry.

Simplemente devuelve una colección de módulos válidos.

---

# Flujo interno

```text
Discovery

│

├── Leer rutas

├── Escanear carpetas

├── Buscar manifest

├── Validar

└── Construir metadatos
```

---

# Directorios

La primera versión buscará módulos en:

```text
app/Modules
```

En versiones futuras podrán añadirse:

```text
packages/

vendor/

plugins/

marketplace/
```

La incorporación de nuevas rutas deberá realizarse mediante configuración.

---

# Validación

Discovery verificará únicamente requisitos estructurales.

Ejemplos:

- existe module.json;
- JSON válido;
- nombre presente;
- slug presente;
- versión presente;
- provider presente.

No comprobará dependencias.

No inicializará clases.

---

# Errores

Discovery deberá utilizar excepciones específicas.

Ejemplos:

```text
ManifestNotFoundException

InvalidManifestException

InvalidModuleStructureException
```

Los errores de un módulo no deberán impedir descubrir los demás, salvo que el Kernel configure un modo estricto.

---

# Metadatos

Discovery construirá objetos temporales con información como:

- nombre;
- slug;
- versión;
- descripción;
- proveedor;
- ruta;
- dependencias.

Estos objetos serán entregados al Registry.

---

# Dependencias

Discovery puede depender de:

- Filesystem;
- Contracts;
- Manifest Validator;
- Configuración.

No puede depender de:

- Registry;
- Modules;
- Platform;
- Applications.

---

# Configuración

Ejemplo conceptual:

```php
'discovery' => [

    'paths' => [

        app_path('Modules'),

    ],

];
```

Las rutas deberán ser configurables.

---

# Beneficios

Discovery permite:

- instalación automática de módulos;
- reducción de configuración manual;
- menor acoplamiento;
- extensibilidad;
- preparación para Marketplace.

---

# Pruebas requeridas

La implementación deberá comprobar:

- directorio vacío;
- módulo válido;
- múltiples módulos;
- manifest inexistente;
- JSON inválido;
- slug duplicado;
- provider inexistente;
- rutas configurables.

---

# Evolución

En versiones posteriores Discovery podrá incorporar:

- cache de descubrimiento;
- plugins;
- módulos remotos;
- paquetes Composer;
- Marketplace.

Estas mejoras no deberán modificar su responsabilidad principal.

---

# Diagrama conceptual

```text
             Kernel

                │

                ▼

           Discovery

                │

        ┌───────┼────────┐

        ▼       ▼        ▼

   Filesystem  Validator  Config

                │

                ▼

         Module Metadata

                │

                ▼

            Registry
```

---

# Matriz de responsabilidades

| Actividad | Discovery |
|-----------|-----------|
| Buscar módulos | Sí |
| Leer directorios | Sí |
| Leer manifests | Sí |
| Validar manifest | Sí |
| Registrar módulos | No |
| Inicializar módulos | No |
| Resolver dependencias | No |
| Mantener estado | No |

---

# Decisiones arquitectónicas

1. Discovery no conserva estado.
2. Discovery devuelve metadatos temporales.
3. El Registry almacena el estado permanente.
4. El Kernel coordina el proceso.
5. Los manifests constituyen la fuente de información del módulo.
6. Las rutas de búsqueda son configurables.
7. La validación se limita a requisitos estructurales.

---

# Criterios de aceptación

ARQ-007 se considerará implementado cuando existan:

- DiscoveryContract;
- DiscoveryService;
- ManifestValidator;
- ModuleMetadata;
- excepciones específicas;
- pruebas unitarias;
- integración con Kernel;
- integración con Registry.

---

# Conclusión

Discovery representa el mecanismo de exploración automática de MEF.

Su misión consiste en localizar módulos válidos y proporcionar sus metadatos al Kernel para su posterior registro.

Discovery encuentra módulos.

El Registry los recuerda.

El Kernel los coordina.