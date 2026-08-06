---
id: KCS-001
titulo: Sistema de Clasificación del Conocimiento
tipo: Conocimiento
categoria: Gobernanza del Conocimiento
nivel: K0
estado: Aceptado
version: 1.0.0
autor: Equipo MEF
fecha_creacion: 2026-08-06
ultima_actualizacion: 2026-08-06
relacionados:
  - 00-FUNDACION
  - 01-ARQUITECTURA
  - 02-DICCIONARIO
---

# KCS-001
# Sistema de Clasificación del Conocimiento

## Estado

Aceptado.

---

# 1. Propósito

El Sistema de Clasificación del Conocimiento (KCS) define el modelo oficial mediante el cual se organiza, clasifica y relaciona todo el conocimiento generado dentro de MEF.

Su objetivo es garantizar que cada elemento del proyecto tenga una ubicación única, una responsabilidad claramente definida y una relación explícita con el resto del ecosistema documental y técnico.

KCS no clasifica únicamente documentos.

Clasifica cualquier activo de conocimiento del Framework.

---

# 2. Objetivos

El KCS tiene los siguientes objetivos:

- proporcionar una estructura uniforme para todo el conocimiento;
- facilitar la localización de información;
- evitar duplicidades;
- establecer relaciones entre documentos y componentes;
- mejorar la trazabilidad de las decisiones;
- facilitar el mantenimiento a largo plazo.

---

# 3. Alcance

El KCS aplica a todos los activos del proyecto.

Entre ellos:

- Documentación
- Código fuente
- ADR
- RFC
- SDK
- API
- Ejemplos
- Guías
- Casos de uso
- Pruebas
- Scripts
- Plantillas
- Builders
- Módulos

---

# 4. Principios

Todo conocimiento deberá cumplir los siguientes principios.

## 4.1 Ubicación única

Cada elemento pertenece a una única categoría principal.

No existen elementos con múltiples ubicaciones oficiales.

---

## 4.2 Responsabilidad única

Cada elemento deberá representar un único concepto.

---

## 4.3 Trazabilidad

Todo elemento deberá poder relacionarse con:

- su origen;
- sus dependencias;
- los elementos relacionados;
- los documentos que lo utilizan.

---

## 4.4 Consistencia

La terminología deberá coincidir con el Diccionario Oficial de MEF.

---

## 4.5 Evolución controlada

Todo cambio significativo deberá quedar documentado mediante ADR o RFC.

---

# 5. Modelo de clasificación

El conocimiento de MEF se organiza en seis niveles.

| Nivel | Nombre | Pregunta que responde |
|--------|---------|----------------------|
| L0 | Fundación | ¿Por qué existe MEF? |
| L1 | Arquitectura | ¿Cómo está construido? |
| L2 | Ingeniería | ¿Cómo se implementa? |
| L3 | Infraestructura | ¿Cómo funciona técnicamente? |
| L4 | Dominio | ¿Qué problema resuelve? |
| L5 | Aplicaciones | ¿Qué sistemas construimos? |

---

# 6. Descripción de niveles

## L0 — Fundación

Contiene la filosofía del proyecto.

Ejemplos:

- Visión
- Misión
- Valores
- Principios
- Doctrina
- Gobernanza

---

## L1 — Arquitectura

Define la estructura del Framework.

Ejemplos:

- Core
- Platform
- Modules
- Kernel
- Registry
- Discovery

---

## L2 — Ingeniería

Describe cómo se implementa el Framework.

Ejemplos:

- Contracts
- Builders
- Template Engine
- Events
- Value Objects
- Dependency Injection

---

## L3 — Infraestructura

Agrupa servicios técnicos reutilizables.

Ejemplos:

- CLI
- SDK
- Filesystem
- Cache
- Logging
- Storage

---

## L4 — Dominio

Representa capacidades de negocio.

Ejemplos:

- CRM
- Inventarios
- Finanzas
- Recursos Humanos
- Organización

---

## L5 — Aplicaciones

Representa sistemas completos construidos sobre MEF.

Ejemplos:

- Sembrando Vida
- ERP
- Hospital
- Universidad
- Ayuntamiento

---

# 7. Reglas de clasificación

Todo elemento deberá responder las siguientes preguntas.

1. ¿Qué es?

2. ¿A qué nivel pertenece?

3. ¿De qué depende?

4. ¿Quién depende de él?

5. ¿Cuál es su propósito?

Si una de estas preguntas no puede responderse, el elemento deberá revisarse antes de incorporarse al proyecto.

---

# 8. Dependencias permitidas

Las dependencias deberán respetar el modelo arquitectónico.

```text
L5
│
▼
L4
│
▼
L3
│
▼
L2
│
▼
L1
│
▼
L0
```

No se permitirán dependencias que violen esta estructura sin una decisión arquitectónica documentada mediante ADR.

---

# 9. Metadatos obligatorios

Todo documento oficial de MEF deberá comenzar con un bloque de metadatos.

Ejemplo:

```yaml
---
id:
titulo:
tipo:
categoria:
nivel:
estado:
version:
autor:
fecha_creacion:
ultima_actualizacion:
dependencias:
relacionados:
tags:
---
```

---

# 10. Beneficios

La adopción del KCS permitirá:

- generar índices automáticamente;
- construir mapas de conocimiento;
- detectar referencias rotas;
- validar dependencias;
- navegar entre documentos relacionados;
- mantener una documentación consistente.

---

# 11. Cumplimiento

Todo documento nuevo deberá cumplir este estándar antes de incorporarse al repositorio oficial de MEF.

---

# 12. Evolución

El KCS podrá evolucionar mediante:

- RFC;
- ADR;
- nuevas versiones del modelo.

Las modificaciones deberán preservar la compatibilidad con la estructura existente siempre que sea posible.

---

# Conclusión

El Sistema de Clasificación del Conocimiento constituye el modelo oficial para organizar todo el conocimiento de MEF.

Su adopción garantiza consistencia, trazabilidad y mantenibilidad, permitiendo que el Framework evolucione de forma ordenada durante todo su ciclo de vida.