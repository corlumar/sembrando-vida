# ARQ-005 — Kernel

## Estado

Aceptado.

---

# Objetivo

El Kernel es el componente responsable de iniciar y coordinar el funcionamiento de MEF.

No implementa lógica de negocio.

No ejecuta procesos específicos.

Su responsabilidad consiste en inicializar el Framework, coordinar los componentes internos y preparar el entorno para la ejecución de la aplicación.

El Kernel constituye el punto central del ciclo de vida de MEF.

---

# Responsabilidades

El Kernel es responsable de:

- iniciar el Framework;
- cargar la configuración;
- inicializar el Registry;
- ejecutar el Discovery;
- registrar módulos;
- inicializar Platform;
- preparar el contenedor de dependencias;
- coordinar el arranque del Framework.

El Kernel coordina.

No implementa funcionalidades específicas.

---

# Principios

El Kernel debe cumplir los siguientes principios:

- Tener una única responsabilidad.
- Permanecer desacoplado.
- No contener lógica de negocio.
- Delegar responsabilidades.
- Mantener el orden del proceso de inicialización.
- Ser completamente comprobable mediante pruebas.

---

# Ciclo de arranque

El proceso de inicialización de MEF sigue el siguiente flujo.

```text
Inicio

    │

    ▼

ERPServiceProvider

    │

    ▼

ERPKernel

    │

    ▼

Cargar configuración

    │

    ▼

Inicializar Registry

    │

    ▼

Ejecutar Discovery

    │

    ▼

Registrar módulos

    │

    ▼

Inicializar Platform

    │

    ▼

Framework listo
```

---

# Responsabilidad de cada paso

## 1. Cargar configuración

El Kernel obtiene la configuración del Framework.

Ejemplos:

- módulos habilitados;
- rutas;
- configuración del Core;
- parámetros generales.

---

## 2. Inicializar Registry

El Registry comienza vacío.

El Kernel prepara el servicio para recibir los módulos descubiertos.

---

## 3. Ejecutar Discovery

El Discovery localiza los módulos disponibles.

Cada módulo válido será registrado.

---

## 4. Registrar módulos

Por cada módulo encontrado:

- validar manifest;
- registrar Service Provider;
- almacenar metadatos;
- registrar en el Registry.

---

## 5. Inicializar Platform

Los servicios compartidos comienzan su ciclo de vida.

Ejemplos:

- autenticación;
- notificaciones;
- workflow;
- cache.

---

## 6. Framework listo

MEF queda preparado para atender solicitudes o ejecutar comandos.

---

# Flujo interno

```text
ERPKernel

│

├── Configuración

├── Registry

├── Discovery

├── Modules

├── Platform

└── Ready
```

Cada componente conserva una responsabilidad específica.

---

# Lo que el Kernel NO debe hacer

El Kernel nunca deberá:

- escribir archivos;
- generar código;
- ejecutar consultas de negocio;
- enviar correos;
- conocer módulos específicos;
- contener reglas empresariales.

Todas estas responsabilidades pertenecen a otros componentes.

---

# Relaciones

El Kernel coordina:

- Registry
- Discovery
- Platform
- Providers

El Kernel no conoce implementaciones concretas de módulos.

---

# Dependencias

El Kernel puede depender de:

- Contracts
- Registry
- Discovery
- Container
- Configuración

No puede depender de:

- Modules
- Applications

---

# Beneficios

Centralizar el ciclo de arranque proporciona:

- orden;
- trazabilidad;
- pruebas más simples;
- separación de responsabilidades;
- facilidad de mantenimiento.

---

# Evolución

En futuras versiones el Kernel incorporará nuevas responsabilidades de coordinación, tales como:

- carga de plugins;
- gestión de extensiones;
- validación de compatibilidad entre módulos;
- inicialización del Marketplace;
- carga dinámica de componentes.

Estas funcionalidades deberán mantener el mismo principio fundamental:

> El Kernel coordina; no implementa.

---

# Diagrama conceptual

```text
                 ERPKernel

                      │

    ┌─────────────────┼─────────────────┐

    ▼                 ▼                 ▼

Registry         Discovery         Platform

    │                 │                 │

    └─────────────────┼─────────────────┘

                      ▼

                 Modules

                      ▼

              Framework Ready
```

---

# Conclusión

El Kernel representa el director de orquesta de MEF.

Su función consiste en coordinar el inicio del Framework garantizando que cada componente se inicialice en el orden correcto.

Toda nueva funcionalidad del Kernel deberá reforzar este principio:

> Coordinar antes que ejecutar.