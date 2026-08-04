# Filosofía de Diseño de MEF

# Modular ERP Framework

---

# Introducción

Toda decisión de diseño en MEF deberá responder a una pregunta fundamental:

**¿Esta decisión hará que el Framework sea más simple, más reutilizable y más fácil de mantener?**

Si la respuesta es negativa, la decisión deberá reconsiderarse.

---

# Diseñamos para el futuro

Las aplicaciones cambian.

Las empresas evolucionan.

Los procesos se transforman.

Por ello, MEF se diseña para evolucionar sin necesidad de reescribirse continuamente.

---

# Diseñamos para reutilizar

Cada componente deberá aportar valor más allá del proyecto donde nació.

Antes de crear un nuevo componente debemos preguntarnos:

¿Podrá utilizarse en otro módulo?

¿Podrá utilizarse en otra aplicación?

Si la respuesta es sí, probablemente pertenece al Core.

---

# Diseñamos para desacoplar

Las dependencias representan el mayor riesgo para la evolución de un Framework.

MEF favorece:

- Interfaces
- Eventos
- Contratos
- Composición

Antes que:

- Dependencias directas
- Código duplicado
- Acoplamiento fuerte

---

# Diseñamos para comprender

El código será leído muchas más veces de las que será escrito.

La claridad tiene mayor valor que la creatividad.

Un componente sencillo siempre será preferible a uno complejo.

---

# Diseñamos para automatizar

Si una tarea puede automatizarse, deberá evaluarse la creación de una herramienta.

La automatización incrementa la calidad y reduce errores humanos.

---

# Diseñamos para evolucionar

MEF no busca resolver únicamente los problemas actuales.

Busca proporcionar una base sólida para resolver los problemas del futuro.

---

# Nuestra regla de oro

Cada componente nuevo deberá responder afirmativamente a las siguientes preguntas:

- ¿Es reutilizable?
- ¿Es comprobable?
- ¿Es mantenible?
- ¿Es simple?
- ¿Está documentado?
- ¿Respeta la arquitectura?

Si alguna respuesta es negativa, el diseño deberá revisarse.

---

# Filosofía de MEF

La mejor arquitectura no es la más compleja.

Es aquella que permite evolucionar durante años con el menor esfuerzo posible.