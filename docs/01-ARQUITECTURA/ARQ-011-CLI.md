# ARQ-011 — CLI (Command Line Interface)

## Estado

Aceptado.

---

# Objetivo

La Command Line Interface (CLI) constituye el punto oficial de interacción entre los desarrolladores y el Core de MEF.

Su propósito consiste en interpretar comandos, validar argumentos y delegar las operaciones correspondientes a los servicios especializados del Framework.

La CLI no contiene lógica de negocio.

La CLI no genera archivos.

La CLI no modifica directamente el estado del Framework.

La CLI únicamente coordina solicitudes.

---

# Motivación

Un Framework moderno debe proporcionar herramientas que automaticen tareas repetitivas.

Ejemplos:

- crear módulos;
- generar servicios;
- generar eventos;
- generar controladores;
- instalar módulos;
- publicar recursos;
- validar manifests;
- inspeccionar módulos.

Sin una CLI, estas tareas quedarían distribuidas en múltiples scripts o implementaciones manuales.

---

# Principios

La CLI deberá cumplir los siguientes principios:

- simplicidad;
- consistencia;
- responsabilidad única;
- desacoplamiento;
- reutilización del Core;
- comportamiento determinista.

---

# Responsabilidades

La CLI es responsable de:

- interpretar comandos;
- validar argumentos;
- convertir valores primitivos en Value Objects;
- invocar servicios del Core;
- presentar resultados;
- devolver códigos de salida.

---

# Lo que la CLI NO debe hacer

La CLI nunca deberá:

- escribir archivos directamente;
- generar contenido;
- registrar módulos;
- acceder al Registry;
- descubrir módulos;
- ejecutar lógica empresarial;
- conocer detalles internos de los Builders.

---

# Arquitectura

```text
Usuario

    │

    ▼

CLI Command

    │

    ▼

Argument Parser

    │

    ▼

Value Objects

    │

    ▼

Core Service

    │

    ▼

Resultado
```

---

# Flujo

```text
php artisan mef:make-module CRM

        │

        ▼

Laravel Command

        │

        ▼

ModuleName

        │

        ▼

ModuleBuilder

        │

        ▼

Resultado

        │

        ▼

Salida en consola
```

---

# Integración con Laravel

La primera implementación utilizará Artisan.

Ejemplo:

```bash
php artisan mef:make-module CRM
```

Cada comando Artisan actuará como adaptador entre Laravel y el Core.

---

# Organización

La estructura propuesta es:

```text
app/

Core/

Console/

Commands/

    MakeModuleCommand.php

    MakeServiceCommand.php

    DiscoverModulesCommand.php

    InstallModuleCommand.php

    ListModulesCommand.php
```

Cada comando representará una única operación.

---

# Relación con Builders

Los comandos nunca construirán módulos directamente.

Ejemplo:

```text
Command

↓

ModuleBuilder

↓

Resultado
```

Toda la lógica permanecerá en el Builder.

---

# Relación con Discovery

Ejemplo:

```bash
php artisan mef:discover
```

Flujo:

```text
Command

↓

Discovery

↓

Collection<ModuleMetadata>

↓

Salida
```

---

# Relación con Registry

Ejemplo:

```bash
php artisan mef:list
```

Flujo:

```text
Command

↓

Registry

↓

Collection

↓

Tabla
```

La CLI únicamente presenta la información.

---

# Conversión a Value Objects

La entrada del usuario siempre será texto.

Antes de invocar un servicio deberá convertirse.

Ejemplo:

```text
CRM

↓

ModuleName

↓

ModuleBuilder
```

El Core nunca deberá recibir valores sin validar.

---

# Códigos de salida

Los comandos devolverán códigos estándar.

| Código | Significado |
|---------|-------------|
| 0 | Éxito |
| 1 | Error |
| 2 | Parámetros inválidos |
| 3 | Recurso inexistente |
| 4 | Operación cancelada |

---

# Salida

La CLI deberá producir mensajes:

- claros;
- consistentes;
- breves;
- orientados a desarrolladores.

Ejemplo:

```text
✔ Module CRM created successfully.
```

---

# Errores

Las excepciones del Core deberán traducirse a mensajes adecuados.

Ejemplo:

```text
ModuleAlreadyExistsException

↓

Module "CRM" already exists.
```

La CLI no expondrá detalles internos del Framework.

---

# Comandos iniciales

La primera versión incluirá:

```text
mef:make-module

mef:make-service

mef:discover

mef:list

mef:validate

mef:install
```

---

# Evolución

Versiones futuras podrán añadir:

```text
mef:update

mef:publish

mef:cache

mef:doctor

mef:marketplace

mef:plugin

mef:upgrade
```

---

# Dependencias

La CLI puede depender de:

- Laravel Console;
- Contracts;
- Value Objects;
- Core Services.

No puede depender de:

- Builders concretos sin contrato;
- Platform;
- Modules;
- Applications.

---

# Pruebas requeridas

Cada comando deberá cubrir:

- argumentos válidos;
- argumentos inválidos;
- ayuda;
- códigos de salida;
- integración con el Core;
- traducción de excepciones;
- salida esperada.

---

# Matriz de responsabilidades

| Componente | Responsabilidad |
|------------|-----------------|
| CLI | Interpretar comandos |
| Value Objects | Validar argumentos |
| Builders | Construcción |
| Discovery | Descubrir módulos |
| Registry | Consultar módulos |
| Template Engine | Generar contenido |
| FileSystem | Escribir archivos |

---

# Decisiones arquitectónicas

1. La CLI nunca implementará lógica del Framework.
2. Toda operación será delegada al Core.
3. Los comandos utilizarán Value Objects.
4. La salida será consistente.
5. Los errores del Core serán traducidos.
6. Los comandos serán pequeños y comprobables.
7. Cada comando tendrá una única responsabilidad.

---

# Criterios de aceptación

ARQ-011 se considerará implementado cuando existan:

- estructura Console;
- Commands;
- integración con Builders;
- integración con Discovery;
- integración con Registry;
- pruebas unitarias;
- pruebas de integración.

---

# Conclusión

La CLI constituye la interfaz oficial entre los desarrolladores y MEF.

Su misión consiste en interpretar solicitudes, transformarlas en objetos válidos y delegar el trabajo al Core.

La CLI coordina.

Los servicios ejecutan.

Los Builders construyen.

El Core permanece independiente de la interfaz.