# Arquitectura de MEF

## Modular ERP Framework

Esta sección describe la arquitectura técnica de MEF.

Su objetivo es explicar cómo se organiza el Framework, cómo se relacionan sus capas y cuáles son las responsabilidades de cada componente principal.

---

## Alcance

La arquitectura de MEF se organiza en cuatro capas principales:

1. Core
2. Platform
3. Modules
4. Applications

Cada capa tiene responsabilidades diferentes y límites claramente definidos.

---

## Modelo general

```text
Applications
      │
      ▼
Modules
      │
      ▼
Platform
      │
      ▼
Core