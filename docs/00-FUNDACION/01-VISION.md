# Visión de MEF

# Modular ERP Framework

---

# Nuestra razón de existir

MEF (Modular ERP Framework) nace con el propósito de proporcionar una plataforma moderna para el desarrollo de aplicaciones empresariales sobre Laravel.

No buscamos desarrollar un único ERP.

Buscamos desarrollar un Framework que permita construir múltiples soluciones empresariales mediante una arquitectura modular, reutilizable y escalable.

Cada organización tiene necesidades diferentes.

MEF proporciona la infraestructura; los módulos implementan el negocio.

---

# Nuestra misión

Facilitar el desarrollo de software empresarial mediante una arquitectura modular que permita construir aplicaciones robustas, mantenibles y extensibles.

Nuestro objetivo es reducir el tiempo de desarrollo sin sacrificar calidad, escalabilidad ni buenas prácticas de ingeniería de software.

---

# Nuestra visión

Convertir a MEF en un Framework de referencia para el desarrollo de aplicaciones empresariales basadas en Laravel.

Queremos que cualquier organización pueda construir su propio ERP reutilizando el mismo núcleo del Framework y agregando únicamente los módulos que necesita.

---

# Principios Fundamentales

## 1. Modularidad

Todo es un módulo.

La funcionalidad de negocio nunca deberá implementarse dentro del Core.

El Core proporciona infraestructura.

Los módulos proporcionan capacidades de negocio.

---

## 2. Desacoplamiento

Los módulos no deben depender directamente unos de otros.

La comunicación deberá realizarse mediante:

- Interfaces
- Contratos
- Eventos
- Servicios

Esto permite instalar, actualizar o eliminar módulos sin afectar al resto del sistema.

---

## 3. Alta cohesión

Cada módulo deberá tener una única responsabilidad claramente definida.

Un módulo pequeño y bien diseñado es preferible a uno grande y difícil de mantener.

---

## 4. Convención sobre configuración

MEF debe reducir la configuración manual.

Siempre que sea posible, el Framework deberá seguir convenciones conocidas para simplificar el desarrollo.

---

## 5. Calidad

Todo componente deberá cumplir con los siguientes requisitos antes de incorporarse al Core:

- Pruebas automatizadas
- Documentación
- PHPDoc
- Arquitectura limpia
- Revisión técnica

---

## 6. Arquitectura limpia

Las reglas de negocio deberán mantenerse independientes del Framework siempre que sea posible.

Laravel es la plataforma tecnológica.

MEF es la plataforma empresarial.

Las reglas del negocio pertenecen a los módulos.

---

## 7. Compatibilidad

Las versiones estables deberán minimizar cambios incompatibles.

La evolución del Framework deberá privilegiar la estabilidad y la compatibilidad hacia atrás siempre que sea posible.

---

# ¿Qué pertenece al Core?

El Core contiene únicamente infraestructura reutilizable.

Ejemplos:

- Kernel
- Registry
- Auto Discovery
- Builders
- Template Engine
- FileSystem
- CLI
- Dependency Injection
- Event Bus
- Configuración
- Seguridad
- Plataforma

---

# ¿Qué NO pertenece al Core?

La lógica específica de negocio.

Por ejemplo:

- CRM
- Recursos Humanos
- Compras
- Ventas
- Inventarios
- Producción
- Contabilidad
- Sembrando Vida

Estos componentes deberán implementarse como módulos independientes.

---

# Nuestra filosofía

Construir una vez.

Reutilizar siempre.

---

# Nuestro objetivo a largo plazo

MEF deberá permitir crear una plataforma empresarial completamente funcional mediante unos cuantos comandos.

Por ejemplo:

```bash
composer create-project corlumar/modular-erp-framework empresa-demo

php artisan mef:install
```

El resultado deberá ser una plataforma lista para desarrollar aplicaciones empresariales mediante módulos.

---

# Valores técnicos

MEF se desarrollará siguiendo los siguientes valores:

- Simplicidad
- Legibilidad
- Modularidad
- Escalabilidad
- Reutilización
- Calidad
- Automatización
- Documentación

Cada decisión técnica deberá alinearse con estos principios.

---

# Nuestro compromiso

MEF no pretende ser únicamente otro ERP.

Nuestro propósito es construir una plataforma moderna que permita desarrollar aplicaciones empresariales durante muchos años manteniendo una arquitectura limpia, consistente y sostenible.

---

# Nuestro lema

> **Arquitectura Modular.**
>
> **Mentalidad Empresarial.**
>
> **Construido sobre Laravel.**