# ARQ-010 — Template Engine

## Estado

Aceptado.

---

# Objetivo

El Template Engine es el componente del Core responsable de transformar plantillas parametrizadas en contenido listo para escribirse en archivos.

Su misión consiste en separar completamente la generación de contenido de la escritura en disco y de la lógica de construcción.

El Template Engine no crea archivos.

El Template Engine no conoce módulos.

El Template Engine únicamente transforma plantillas en texto.

---

# Motivación

La generación automática de código requiere reutilizar estructuras comunes.

Ejemplos:

- clases PHP;
- interfaces;
- Service Providers;
- manifests;
- archivos JSON;
- archivos YAML;
- archivos Markdown;
- configuraciones.

Sin un motor de plantillas cada Builder tendría que generar texto manualmente.

Esto produciría:

- duplicación;
- inconsistencias;
- mayor mantenimiento;
- menor reutilización.

---

# Responsabilidades

El Template Engine es responsable de:

- cargar plantillas;
- reemplazar variables;
- validar plantillas;
- producir contenido final;
- mantener un comportamiento determinista.

---

# Lo que NO debe hacer

El Template Engine nunca deberá:

- escribir archivos;
- crear directorios;
- descubrir módulos;
- registrar componentes;
- conocer el Registry;
- conocer la CLI;
- ejecutar lógica de negocio.

---

# Filosofía

El Template Engine debe ser completamente independiente.

Su única entrada es:

- una plantilla;
- un conjunto de variables.

Su única salida es:

- texto generado.

---

# Flujo

```text
Template

↓

Variables

↓

Template Engine

↓

Texto generado
```

---

# Relación con Builders

Los Builders delegan completamente la generación de contenido.

```text
Builder

↓

Template Engine

↓

Contenido

↓

FileWriter
```

Builder coordina.

Template Engine genera.

FileWriter escribe.

---

# Relación con FileSystem

El Template Engine nunca deberá utilizar el sistema de archivos directamente para escribir.

Únicamente podrá leer plantillas.

La escritura será responsabilidad del FileSystem.

---

# Variables

Las plantillas utilizarán variables delimitadas mediante llaves dobles.

Ejemplo:

```php
namespace {{ Namespace }};

final class {{ ClassName }}
{
}
```

Durante el renderizado:

```text
Namespace

↓

App\Modules\CRM\Application

ClassName

↓

CustomerService
```

Resultado:

```php
namespace App\Modules\CRM\Application;

final class CustomerService
{
}
```

---

# Sintaxis inicial

La primera versión soportará únicamente sustitución de variables.

Ejemplo:

```text
{{ Variable }}
```

No soportará:

- condiciones;
- ciclos;
- expresiones;
- funciones;
- filtros.

Estas capacidades podrán añadirse en versiones futuras.

---

# Renderizado

Ejemplo conceptual:

```php
$templateEngine->render(
    template: $stub,
    variables: [
        'Namespace' => 'App\\Modules\\CRM',
        'ClassName' => 'CustomerService',
    ],
);
```

Resultado:

```php
namespace App\Modules\CRM;

final class CustomerService
{
}
```

---

# Plantillas

Las plantillas oficiales de MEF vivirán en:

```text
app/
└── Core/
    └── Templates/
```

Los módulos podrán proporcionar plantillas propias.

---

# Validación

El Template Engine deberá comprobar:

- existencia de la plantilla;
- lectura correcta;
- variables requeridas;
- sintaxis válida.

Cuando una variable obligatoria no exista deberá producir una excepción.

---

# Excepciones

Ejemplos:

```text
TemplateNotFoundException

TemplateSyntaxException

MissingTemplateVariableException

TemplateRenderException
```

---

# Idempotencia

El mismo template con las mismas variables deberá producir exactamente el mismo resultado.

El motor no deberá depender del estado del sistema.

---

# Configuración

La ubicación de las plantillas deberá obtenerse desde la configuración del Framework.

No deberán utilizarse rutas codificadas.

---

# Rendimiento

En futuras versiones podrán añadirse:

- cache de plantillas;
- compilación previa;
- optimización de renderizado.

La API pública deberá permanecer estable.

---

# Evolución

Versiones futuras podrán incorporar:

- condicionales;
- ciclos;
- plantillas anidadas;
- layouts;
- bloques reutilizables;
- filtros;
- helpers.

La primera versión permanecerá deliberadamente sencilla.

---

# Dependencias

El Template Engine puede depender de:

- Filesystem (lectura);
- Contracts;
- Exceptions.

No puede depender de:

- Builders;
- Registry;
- Discovery;
- CLI;
- Modules;
- Platform.

---

# API conceptual

```php
$templateEngine->render(
    template: string,
    variables: array,
): string;
```

La implementación podrá ampliarse sin romper esta interfaz.

---

# Pruebas requeridas

La implementación deberá cubrir:

- plantilla existente;
- plantilla inexistente;
- sustitución correcta;
- múltiples variables;
- variable faltante;
- variable repetida;
- plantilla vacía;
- contenido sin variables;
- caracteres especiales;
- renderizado determinista.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|------------|-----------------|
| Builder | Coordinar construcción |
| Template Engine | Generar contenido |
| FileWriter | Escribir archivos |
| DirectoryManager | Crear directorios |
| JsonWriter | Escribir JSON |
| StubWriter | Integrar Template Engine y FileWriter |

---

# Relación con StubWriter

StubWriter constituye una especialización del uso del Template Engine.

```text
Stub

↓

Template Engine

↓

Contenido

↓

FileWriter

↓

Archivo
```

El Template Engine no conoce StubWriter.

StubWriter sí conoce Template Engine.

---

# Decisiones arquitectónicas

1. El Template Engine será completamente independiente.
2. La generación de contenido estará desacoplada de la escritura.
3. La primera versión soportará únicamente sustitución de variables.
4. Las plantillas serán texto plano.
5. Los Builders delegarán completamente la generación.
6. La API deberá permanecer pequeña y estable.
7. La evolución futura no romperá compatibilidad.

---

# Criterios de aceptación

ARQ-010 se considerará implementado cuando existan:

- TemplateEngineContract;
- TemplateEngine;
- excepciones específicas;
- pruebas unitarias;
- integración con StubWriter;
- integración con ModuleBuilder.

---

# Conclusión

El Template Engine constituye el mecanismo oficial de generación de contenido de MEF.

Su misión consiste en transformar plantillas parametrizadas en texto listo para ser escrito por el FileSystem.

Genera contenido.

No escribe archivos.

No construye módulos.

No conoce el Framework.

Su responsabilidad es exclusivamente el renderizado de plantillas.