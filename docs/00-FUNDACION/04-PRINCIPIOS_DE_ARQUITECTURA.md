# Principios de Arquitectura de MEF

# Modular ERP Framework

---

# Introducción

Los principios de arquitectura definen las reglas fundamentales que gobiernan el diseño, evolución y mantenimiento de MEF.

Todo componente del Framework deberá respetar estos principios.

Cuando exista un conflicto entre una implementación rápida y estos principios, prevalecerán los principios arquitectónicos.

---

# Principio 1. El Core no contiene lógica de negocio

El Core existe únicamente para proporcionar infraestructura reutilizable.

No implementa procesos empresariales.

No conoce clientes, ventas, compras, inventarios ni ningún otro dominio específico.

Su responsabilidad es proporcionar capacidades técnicas para que los módulos implementen dichas funcionalidades.

---

# Principio 2. Todo es modular

La unidad fundamental de MEF es el módulo.

Cada módulo representa una capacidad funcional independiente.

Debe poder instalarse, actualizarse o eliminarse sin afectar al resto del Framework.

---

# Principio 3. Bajo acoplamiento

Los módulos no deberán depender directamente entre sí.

La comunicación se realizará mediante:

- Interfaces
- Contratos
- Eventos
- Servicios registrados en el contenedor

Nunca mediante referencias directas a implementaciones concretas.

---

# Principio 4. Alta cohesión

Cada componente deberá tener una única responsabilidad claramente definida.

Si una clase comienza a asumir múltiples responsabilidades, deberá dividirse.

---

# Principio 5. Dependencias invertidas

Las capas superiores no dependerán de implementaciones concretas.

Toda dependencia deberá resolverse mediante contratos e inyección de dependencias.

---

# Principio 6. Convención sobre configuración

MEF favorecerá convenciones consistentes antes que configuraciones complejas.

Las convenciones deberán ser claras, documentadas y predecibles.

---

# Principio 7. Arquitectura orientada a pruebas

Todo componente del Core deberá poder validarse mediante pruebas automatizadas.

Las pruebas forman parte del diseño.

No son una actividad posterior.

---

# Principio 8. Inmutabilidad cuando sea posible

Los objetos que representan configuración, metadatos o estructuras deberán diseñarse como inmutables cuando aporte claridad y seguridad.

---

# Principio 9. Separación de responsabilidades

Cada capa del Framework tiene una función específica.

## Core

Infraestructura reutilizable.

## Platform

Servicios comunes compartidos.

## Modules

Capacidades de negocio.

## Applications

Implementaciones específicas construidas sobre MEF.

---

# Principio 10. Compatibilidad

Las versiones estables deberán minimizar cambios incompatibles.

Cuando sea necesario romper compatibilidad, el cambio deberá:

- Documentarse.
- Justificarse.
- Comunicarse.
- Planificarse.

---

# Principio 11. Documentación obligatoria

Toda funcionalidad incorporada al Core deberá estar documentada.

La documentación forma parte del Framework.

---

# Principio 12. Automatización

Toda tarea repetitiva deberá automatizarse cuando sea técnica y económicamente viable.

MEF prioriza la creación de herramientas que reduzcan trabajo manual.

---

# Reglas del Core

Todo componente del Core deberá cumplir las siguientes reglas:

✓ Tener una única responsabilidad.

✓ Contar con pruebas automatizadas.

✓ Incluir PHPDoc cuando aporte valor.

✓ Seguir las convenciones del proyecto.

✓ Mantener compatibilidad con la arquitectura.

✓ Evitar dependencias innecesarias.

✓ Ser reutilizable.

---

# Lo que nunca haremos

El Core de MEF nunca deberá:

- Contener lógica de negocio.
- Depender de módulos específicos.
- Acoplar implementaciones concretas.
- Duplicar responsabilidades.
- Introducir deuda técnica deliberadamente.
- Romper la arquitectura por conveniencia.

---

# Nuestro criterio de decisión

Ante varias alternativas técnicamente válidas, elegiremos aquella que:

- Sea más simple.
- Sea más mantenible.
- Favorezca la reutilización.
- Respete la modularidad.
- Reduzca el acoplamiento.
- Facilite las pruebas.
- Mantenga la coherencia del Framework.

---

# Resumen

La arquitectura de MEF se fundamenta en doce principios:

1. Core sin lógica de negocio.
2. Modularidad.
3. Bajo acoplamiento.
4. Alta cohesión.
5. Inversión de dependencias.
6. Convención sobre configuración.
7. Arquitectura orientada a pruebas.
8. Inmutabilidad cuando aporte valor.
9. Separación de responsabilidades.
10. Compatibilidad.
11. Documentación.
12. Automatización.

Estos principios constituyen la base técnica del Framework y deberán guiar todas las decisiones de diseño.