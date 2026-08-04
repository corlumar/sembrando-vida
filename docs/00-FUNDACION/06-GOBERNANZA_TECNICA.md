# Gobernanza Técnica de MEF

# Modular ERP Framework

---

# Introducción

La gobernanza técnica define la forma en que evoluciona MEF.

Su objetivo es garantizar que el crecimiento del Framework sea ordenado, consistente y sostenible.

Las decisiones técnicas deberán priorizar la estabilidad, la calidad y la reutilización por encima de la velocidad de desarrollo.

---

# Objetivos

La gobernanza técnica busca:

- Mantener la coherencia arquitectónica.
- Reducir la deuda técnica.
- Facilitar la evolución del Framework.
- Garantizar la calidad del Core.
- Documentar las decisiones relevantes.
- Favorecer la colaboración entre desarrolladores.

---

# Principios

Toda decisión técnica deberá respetar:

- La Visión de MEF.
- La Misión del Framework.
- Los Valores de Ingeniería.
- Los Principios de Arquitectura.
- Las ADR (Architecture Decision Records).

Si una propuesta contradice alguno de estos documentos, deberá justificarse y documentarse antes de ser aceptada.

---

# Toma de decisiones

Las decisiones técnicas se clasifican en tres niveles.

## Nivel 1 - Operativo

Cambios menores que no modifican la arquitectura.

Ejemplos:

- Corrección de errores.
- Refactorizaciones internas.
- Mejoras de rendimiento.
- Ajustes de documentación.

No requieren un ADR.

---

## Nivel 2 - Arquitectónico

Cambios que afectan el diseño del Framework.

Ejemplos:

- Nuevos componentes del Core.
- Cambios en el Kernel.
- Nuevos Builders.
- Nuevos mecanismos de descubrimiento.
- Cambios en la CLI.

Requieren un ADR antes de su implementación.

---

## Nivel 3 - Estratégico

Cambios que modifican la dirección del proyecto.

Ejemplos:

- Cambio de arquitectura.
- Cambio de licencia.
- Cambio del modelo de módulos.
- Cambios incompatibles (Breaking Changes).
- Nueva estrategia de distribución.

Requieren:

- ADR.
- Actualización de la documentación.
- Actualización del Roadmap.
- Nueva versión del Framework.

---

# Requisitos para incorporar componentes al Core

Un componente podrá formar parte del Core únicamente si cumple con los siguientes criterios:

✓ Resuelve un problema reutilizable.

✓ No contiene lógica de negocio.

✓ Tiene una única responsabilidad.

✓ Cuenta con pruebas automatizadas.

✓ Está documentado.

✓ Sigue las convenciones de MEF.

✓ Respeta la arquitectura del Framework.

---

# Gestión de deuda técnica

La deuda técnica deberá:

- Identificarse.
- Documentarse.
- Priorizarse.
- Corregirse.

Nunca deberá ocultarse.

---

# Política de versionado

MEF utiliza Versionado Semántico.

Formato:

MAJOR.MINOR.PATCH

Ejemplo:

1.4.2

Donde:

MAJOR

Cambios incompatibles.

MINOR

Nuevas funcionalidades compatibles.

PATCH

Corrección de errores.

Durante el desarrollo inicial utilizaremos versiones Alpha y Beta.

Ejemplo:

0.2.0-alpha

0.4.0-beta

1.0.0

---

# Calidad obligatoria

Antes de integrar cambios al Core deberán ejecutarse:

composer validate

composer dump-autoload

php artisan optimize:clear

php artisan test

php artisan mef:status
(Temporalmente compatible con php artisan erp:status.)

---

# Integración continua

Toda contribución deberá validarse mediante procesos automáticos.

En futuras versiones se incorporarán:

- GitHub Actions
- PHPStan
- Laravel Pint
- Cobertura de pruebas
- Análisis estático
- Revisión automática de estilo

---

# Documentación obligatoria

Toda funcionalidad deberá actualizar:

- Documentación técnica.
- ADR (cuando aplique).
- CHANGELOG.
- Roadmap (si corresponde).

Una funcionalidad sin documentación se considera incompleta.

---

# Responsabilidad técnica

Cada desarrollador es responsable de dejar el Framework en un mejor estado del que lo encontró.

La calidad colectiva es responsabilidad de todos.

---

# Resumen

La gobernanza técnica garantiza que MEF pueda evolucionar durante muchos años sin perder coherencia, calidad ni mantenibilidad.

Las decisiones importantes deberán ser transparentes, documentadas y alineadas con la identidad del Framework.