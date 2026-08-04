# Glosario Oficial de MEF

# Modular ERP Framework

---

# Introducción

Este documento define la terminología oficial utilizada dentro de MEF.

Su objetivo es garantizar que todos los desarrolladores utilicen el mismo lenguaje al diseñar, documentar e implementar el Framework.

Cuando exista una diferencia entre el uso cotidiano de un término y su definición dentro de MEF, prevalecerá la definición establecida en este documento.

---

# A

## Aplicación (Application)

Sistema empresarial construido sobre MEF utilizando uno o más módulos.

Ejemplos:

- Sembrando Vida
- ERP Comercial
- ERP Hospitalario

Una aplicación consume el Framework.

Nunca forma parte del Core.

---

# B

## Builder

Componente responsable de generar estructuras, archivos o artefactos de manera automatizada.

Ejemplos:

- ModuleBuilder
- StubBuilder
- ManifestBuilder

---

# C

## Core

Conjunto de componentes reutilizables que constituyen el núcleo del Framework.

El Core proporciona infraestructura.

Nunca implementa lógica de negocio.

---

## Contrato (Contract)

Interfaz que define el comportamiento esperado de un componente sin imponer una implementación específica.

Permite desacoplar módulos y facilitar las pruebas.

---

# D

## Descubrimiento Automático (Auto Discovery)

Mecanismo mediante el cual MEF detecta automáticamente módulos, proveedores de servicios y componentes disponibles.

---

# E

## Evento (Event)

Mensaje utilizado para comunicar cambios relevantes entre componentes sin crear dependencias directas.

Los eventos favorecen el bajo acoplamiento entre módulos.

---

# F

## Framework

Conjunto de componentes reutilizables que proporcionan infraestructura para desarrollar aplicaciones.

MEF es un Framework.

No una aplicación empresarial.

---

# G

## Generador (Generator)

Componente encargado de producir archivos o estructuras mediante plantillas.

Puede utilizar internamente uno o varios Builders.

---

# I

## Infraestructura

Conjunto de componentes técnicos que soportan el funcionamiento del Framework.

Ejemplos:

- Sistema de archivos
- Registro
- CLI
- Descubrimiento automático

---

# K

## Kernel

Punto central de inicialización del Framework.

Su responsabilidad es coordinar el arranque de MEF y registrar los componentes necesarios.

---

# M

## Manifest

Archivo de metadatos que describe un módulo.

Actualmente se representa mediante:

module.json

---

## Módulo (Module)

Unidad funcional independiente.

Cada módulo implementa una capacidad específica del negocio o de la plataforma.

Ejemplos:

- CRM
- Inventarios
- Compras
- Organización

Los módulos pueden evolucionar independientemente.

---

# P

## Plataforma (Platform)

Conjunto de servicios compartidos utilizados por múltiples módulos.

Ejemplos:

- Autenticación
- Notificaciones
- Workflow
- Cache

---

## Proveedor de Servicios (Service Provider)

Clase responsable de registrar servicios dentro del contenedor de dependencias.

En Laravel normalmente extiende:

ServiceProvider

---

# R

## Registry

Servicio encargado de mantener el registro de módulos, componentes y metadatos disponibles dentro del Framework.

---

# S

## Scaffolding

Proceso automático de generación de código base.

Ejemplo:

php artisan mef:make-module CRM

---

## Servicio

Clase responsable de ejecutar una funcionalidad específica.

Debe representar una única responsabilidad.

---

## Stub

Plantilla utilizada para generar archivos mediante sustitución de variables.

---

# T

## Template

Archivo base utilizado por los Builders para generar artefactos.

Generalmente utiliza variables delimitadas mediante marcadores.

---

# W

## Workspace

Directorio de trabajo utilizado por MEF durante procesos de generación o instalación.

---

# Resumen

En MEF utilizamos un lenguaje común.

Cuando un término aparezca en el código, la documentación o los ADR, deberá interpretarse conforme a las definiciones establecidas en este documento.

Mantener un vocabulario consistente facilita la comunicación, reduce ambigüedades y mejora la mantenibilidad del Framework.