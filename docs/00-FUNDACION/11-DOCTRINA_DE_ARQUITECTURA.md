# Doctrina de Arquitectura de MEF

# Modular ERP Framework

---

# Introducción

La arquitectura de MEF no se basa únicamente en patrones de diseño.

Se basa en una forma de pensar.

Esta doctrina describe cómo deben tomarse las decisiones de arquitectura dentro del Framework.

No pretende imponer soluciones únicas.

Pretende proporcionar criterios consistentes para diseñar sistemas sostenibles.

---

# Primer principio

Antes de escribir código, comprender el problema.

El código nunca debe ser el punto de partida.

El análisis siempre precede a la implementación.

---

# Segundo principio

Toda decisión deberá justificarse.

No aceptamos decisiones basadas únicamente en preferencias personales.

Cada cambio importante deberá responder claramente:

¿Por qué?

¿Qué problema resuelve?

¿Qué alternativas se analizaron?

---

# Tercer principio

La arquitectura prevalece sobre la implementación.

Una implementación rápida nunca deberá comprometer la arquitectura del Framework.

---

# Cuarto principio

El Core pertenece al futuro.

Todo componente incorporado al Core deberá diseñarse pensando en múltiples proyectos y no únicamente en el proyecto actual.

---

# Quinto principio

El negocio pertenece a los módulos.

El Core jamás conocerá reglas de negocio específicas.

Toda lógica empresarial deberá implementarse mediante módulos.

---

# Sexto principio

Cada dependencia representa un compromiso.

Antes de agregar una nueva dependencia debemos preguntarnos:

- ¿Es realmente necesaria?
- ¿Existe una alternativa más simple?
- ¿Podemos implementar una abstracción propia?

---

# Séptimo principio

La simplicidad es un objetivo arquitectónico.

Una arquitectura sencilla siempre será preferible a una arquitectura sofisticada.

---

# Octavo principio

Toda automatización representa conocimiento reutilizable.

Si una tarea se repite constantemente, deberá evaluarse su automatización.

---

# Noveno principio

El Framework deberá enseñar buenas prácticas.

Cada componente debe servir también como ejemplo para futuros desarrolladores.

---

# Décimo principio

MEF deberá poder mantenerse durante muchos años.

Las decisiones de hoy deberán facilitar el trabajo de quienes mantengan el Framework en el futuro.

---

# Nuestra responsabilidad

No construimos únicamente software.

Construimos una plataforma sobre la cual otros desarrollarán sus propios sistemas.

Esa responsabilidad exige disciplina, consistencia y una visión de largo plazo.

---

# Conclusión

La arquitectura de MEF no se mide por la cantidad de componentes que posee.

Se mide por la facilidad con la que puede evolucionar sin perder coherencia.