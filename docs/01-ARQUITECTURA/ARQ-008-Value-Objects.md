# ARQ-008 — Value Objects

## Estado

Aceptado.

---

# Objetivo

Los Value Objects representan conceptos fundamentales del dominio interno de MEF.

Su propósito es sustituir valores primitivos y arreglos ambiguos por objetos pequeños, inmutables, expresivos y validados.

Estos objetos permitirán que el Core intercambie información mediante tipos explícitos, reduciendo errores y mejorando la claridad de sus APIs.

---

# Contexto

Los componentes principales de MEF necesitan compartir información relacionada con módulos.

Ejemplos:

- nombre del módulo;
- identificador;
- versión;
- ruta física;
- proveedor de servicios;
- namespace;
- dependencias;
- metadatos.

Representar estos conceptos únicamente mediante cadenas o arreglos genera varios problemas:

- valores inválidos;
- claves mal escritas;
- validaciones duplicadas;
- APIs poco expresivas;
- dependencia de estructuras internas;
- menor capacidad de análisis estático.

Por ello, MEF adoptará Value Objects para representar conceptos importantes del Framework.

---

# Definición

Un Value Object es un objeto que representa un valor o concepto mediante sus atributos.

No posee identidad propia.

Dos Value Objects con el mismo contenido representan el mismo valor.

Ejemplo conceptual:

```php
$first = new ModuleName('CRM');
$second = new ModuleName('CRM');
```

Ambos representan el mismo nombre de módulo.

---

# Principios

Los Value Objects de MEF deberán ser:

- inmutables;
- autocontenidos;
- validados desde su creación;
- comparables por valor;
- serializables cuando sea necesario;
- independientes de infraestructura externa;
- fáciles de utilizar en pruebas.

---

# Inmutabilidad

Los Value Objects no deberán cambiar después de ser creados.

La implementación preferida utilizará clases `final readonly` cuando la versión de PHP lo permita.

Ejemplo:

```php
final readonly class ModuleName
{
    public function __construct(
        private string $value
    ) {
    }
}
```

No se utilizarán setters.

---

# Validación temprana

Todo Value Object deberá validar su valor durante la construcción.

Un objeto inválido no deberá existir.

Ejemplo:

```php
new ModuleName('');
```

deberá lanzar una excepción específica.

Esta estrategia evita propagar valores inválidos dentro del Framework.

---

# Objetos fundamentales

MEF utilizará inicialmente los siguientes Value Objects.

## ModuleId

Representa el identificador único interno de un módulo.

Ejemplo:

```text
crm
organizacion
inventarios
```

Características:

- único;
- normalizado;
- estable;
- apto para búsquedas en Registry.

---

## ModuleName

Representa el nombre legible del módulo.

Ejemplo:

```text
CRM
Organización
Recursos Humanos
```

Debe preservar la representación destinada a desarrolladores y usuarios.

---

## ModuleVersion

Representa la versión semántica de un módulo.

Ejemplo:

```text
1.0.0
0.3.0-alpha
2.1.4
```

Deberá permitir:

- validación;
- comparación;
- serialización;
- consulta de componentes de versión.

---

## ModulePath

Representa la ruta física de un módulo.

Ejemplo:

```text
C:\proyecto\app\Modules\CRM
```

Deberá garantizar:

- ruta no vacía;
- normalización consistente;
- ausencia de separadores finales innecesarios.

La existencia física podrá validarse por un servicio especializado cuando corresponda.

---

## ProviderClass

Representa el nombre completamente calificado del Service Provider de un módulo.

Ejemplo:

```text
App\Modules\CRM\Providers\CRMServiceProvider
```

Deberá validar el formato esperado de una clase PHP.

La verificación de existencia de la clase podrá delegarse a Discovery o Manifest Validator.

---

## ModuleNamespace

Representa el namespace raíz de un módulo.

Ejemplo:

```text
App\Modules\CRM
```

Se utilizará en Builders, plantillas y generación de código.

---

## ModuleMetadata

Agrupa la información validada de un módulo.

Ejemplo conceptual:

```php
final readonly class ModuleMetadata
{
    public function __construct(
        public ModuleId $id,
        public ModuleName $name,
        public ModuleVersion $version,
        public ModulePath $path,
        public ProviderClass $provider,
        public ModuleNamespace $namespace,
        public array $dependencies = [],
        public string $description = '',
        public bool $enabled = true,
    ) {
    }
}
```

`ModuleMetadata` será el objeto común entre:

- Discovery;
- Registry;
- Kernel;
- CLI;
- Dependency Resolver;
- Installer;
- Marketplace.

---

# Dependencias de módulos

Las dependencias no deberán representarse indefinidamente como cadenas sin validar.

En una versión posterior podrá incorporarse:

```text
ModuleDependency
ModuleDependencyCollection
VersionConstraint
```

En la primera implementación, `ModuleMetadata` podrá utilizar una colección tipada de `ModuleId`.

---

# Comparación

Cada Value Object deberá proporcionar una forma explícita de comparación.

Ejemplo:

```php
$moduleId->equals($otherModuleId);
```

La comparación deberá basarse en el valor normalizado.

---

# Conversión a cadena

Cuando sea apropiado, los Value Objects podrán implementar:

```php
public function value(): string;
```

y opcionalmente:

```php
public function __toString(): string;
```

El método `value()` será la API explícita recomendada.

---

# Serialización

Los Value Objects utilizados en manifests, caché o CLI deberán poder convertirse a valores escalares.

Ejemplo:

```php
$metadata->toArray();
```

La serialización no deberá exponer detalles internos innecesarios.

---

# Excepciones

Cada Value Object deberá utilizar excepciones específicas cuando su valor sea inválido.

Ejemplos:

```text
InvalidModuleIdException

InvalidModuleNameException

InvalidModuleVersionException

InvalidModulePathException

InvalidProviderClassException

InvalidModuleNamespaceException
```

Estas excepciones pertenecerán al Core.

---

# Ubicación en el código

La estructura propuesta es:

```text
app/
└── Core/
    ├── ValueObjects/
    │   ├── ModuleId.php
    │   ├── ModuleName.php
    │   ├── ModuleVersion.php
    │   ├── ModulePath.php
    │   ├── ProviderClass.php
    │   ├── ModuleNamespace.php
    │   └── ModuleMetadata.php
    │
    └── Exceptions/
```

La ubicación definitiva podrá ajustarse mediante ADR si el Core adopta una organización basada en dominios internos.

---

# Regla de uso

MEF adoptará la siguiente regla:

> Ningún componente del Core intercambiará información mediante arreglos asociativos cuando exista un concepto claramente representable mediante un Value Object.

Ejemplo incorrecto:

```php
$module = [
    'name' => 'CRM',
    'version' => '1.0.0',
];
```

Ejemplo recomendado:

```php
$module = new ModuleMetadata(
    id: new ModuleId('crm'),
    name: new ModuleName('CRM'),
    version: ModuleVersion::fromString('1.0.0'),
    path: new ModulePath($path),
    provider: new ProviderClass($provider),
    namespace: new ModuleNamespace($namespace),
);
```

---

# Lo que NO debe convertirse en Value Object

No todo valor necesita un objeto propio.

No se crearán Value Objects cuando:

- el valor no representa un concepto relevante;
- no existe validación propia;
- no mejora la claridad;
- solo añade complejidad;
- no será reutilizado;
- pertenece a una implementación local.

La creación de Value Objects deberá responder a una necesidad real del dominio del Framework.

---

# Relación con Discovery

Discovery leerá valores primitivos desde `module.json`.

Después los transformará en Value Objects validados.

```text
module.json

    │

    ▼

Manifest Validator

    │

    ▼

Value Objects

    │

    ▼

ModuleMetadata
```

Discovery no deberá entregar arreglos sin validar al Registry.

---

# Relación con Registry

Registry almacenará objetos `ModuleMetadata`.

Ejemplo conceptual:

```php
$registry->register($metadata);
```

Las búsquedas podrán utilizar `ModuleId`.

```php
$registry->get(
    new ModuleId('crm')
);
```

En la API pública podrán existir métodos auxiliares que acepten cadenas y realicen la conversión internamente.

---

# Relación con Builders

Los Builders utilizarán Value Objects para reducir parámetros ambiguos.

Ejemplo:

```php
$builder->build(
    new ModuleName('CRM')
);
```

En versiones iniciales podrán mantenerse APIs compatibles con cadenas, pero internamente deberán normalizarse a Value Objects.

---

# Relación con CLI

La CLI recibe cadenas del usuario.

Los comandos deberán transformarlas en Value Objects antes de invocar servicios del Core.

```text
Argumento CLI

    │

    ▼

Validación

    │

    ▼

Value Object

    │

    ▼

Servicio del Core
```

La CLI no deberá transferir valores sin validar.

---

# Beneficios

El uso de Value Objects proporciona:

- validación centralizada;
- mejor tipado;
- APIs más expresivas;
- menos cadenas mágicas;
- menos arreglos ambiguos;
- mejor análisis estático;
- pruebas más claras;
- menor duplicación;
- mayor seguridad al refactorizar.

---

# Costos

La adopción de Value Objects implica:

- mayor cantidad de clases;
- necesidad de diseñar APIs claras;
- conversión entre valores primitivos y objetos;
- disciplina en su uso.

Estos costos se consideran aceptables únicamente para conceptos relevantes y reutilizables del Core.

---

# Pruebas requeridas

Cada Value Object deberá cubrir:

- creación con valor válido;
- rechazo de valores inválidos;
- normalización;
- comparación;
- conversión a cadena;
- serialización cuando aplique;
- inmutabilidad.

`ModuleMetadata` deberá cubrir además:

- construcción completa;
- dependencias;
- estado habilitado;
- serialización;
- integración con Registry y Discovery.

---

# Decisiones arquitectónicas

1. Los conceptos fundamentales del Core se representarán mediante Value Objects.
2. Los Value Objects serán inmutables.
3. La validación ocurrirá durante su creación.
4. `ModuleMetadata` será el objeto común entre Discovery, Registry y Kernel.
5. Las excepciones de validación serán específicas.
6. No se crearán Value Objects sin una necesidad arquitectónica clara.
7. Las APIs externas podrán aceptar valores primitivos, pero deberán convertirlos internamente.

---

# Criterios de aceptación

ARQ-008 se considerará implementado cuando existan:

- `ModuleId`;
- `ModuleName`;
- `ModuleVersion`;
- `ModulePath`;
- `ProviderClass`;
- `ModuleNamespace`;
- `ModuleMetadata`;
- excepciones específicas;
- pruebas unitarias;
- integración con Discovery;
- integración con Registry.

---

# Evolución prevista

En versiones posteriores podrán añadirse:

- `VersionConstraint`;
- `ModuleDependency`;
- `ModuleDependencyCollection`;
- `ModuleStatus`;
- `ModuleType`;
- `PackageName`;
- `Checksum`;
- `LicenseIdentifier`.

Cada incorporación deberá justificarse mediante una necesidad real del Framework.

---

# Conclusión

Los Value Objects constituyen el lenguaje interno tipado de MEF.

Permiten representar conceptos importantes del Framework mediante objetos válidos, inmutables y expresivos.

Discovery los construye.

Registry los almacena.

Kernel los coordina.

Los demás componentes los consumen.