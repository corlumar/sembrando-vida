# ARQ-004 — Modules

## Estado

Aceptado.

---

# Objetivo

Los módulos representan las unidades funcionales de MEF.

Cada módulo encapsula una capacidad específica del negocio o de la plataforma y puede evolucionar de forma independiente.

La modularidad constituye uno de los principios fundamentales del Framework.

---

# Definición

Un módulo es un componente autónomo que implementa una responsabilidad claramente definida.

Ejemplos:

- Organización
- CRM
- Inventarios
- Compras
- Ventas
- Recursos Humanos
- Contabilidad

Cada módulo debe poder instalarse, actualizarse o eliminarse sin afectar al resto del sistema.

---

# Responsabilidades

Un módulo es responsable de:

- implementar lógica de negocio;
- registrar sus servicios;
- administrar sus rutas;
- definir sus migraciones;
- contener sus modelos;
- exponer sus eventos;
- publicar sus configuraciones;
- incluir sus pruebas;
- mantener su documentación.

---

# Lo que un módulo NO debe hacer

Un módulo nunca debe:

- modificar el Core;
- depender directamente de otro módulo;
- acceder a implementaciones concretas del Core;
- contener infraestructura reutilizable;
- duplicar servicios existentes de Platform.

---

# Arquitectura interna

Cada módulo mantiene su propia estructura.

Ejemplo:

Modules/
└── CRM/
    ├── Application/
    ├── Domain/
    ├── Infrastructure/
    ├── Providers/
    ├── Console/
    ├── Config/
    ├── Database/
    ├── Resources/
    ├── Routes/
    ├── Tests/
    ├── module.json
    └── README.md

Cada módulo debe ser autocontenido.

---

# Comunicación

Los módulos no deben conocerse directamente.

La comunicación deberá realizarse mediante:

- contratos;
- eventos;
- servicios registrados;
- Platform.

Ejemplo:

CRM

↓

Evento

↓

Inventarios

En lugar de:

CRM

↓

Clase concreta de Inventarios

---

# Registro

Cada módulo deberá registrar:

- nombre;
- versión;
- proveedor de servicios;
- dependencias;
- descripción;
- autor;
- licencia.

Esta información será almacenada en:

module.json

---

# Descubrimiento

MEF descubrirá automáticamente los módulos disponibles.

El proceso consistirá en:

1. localizar module.json;
2. validar el manifest;
3. registrar el Service Provider;
4. incorporar el módulo al Registry.

No será necesario registrar manualmente nuevos módulos.

---

# Dependencias

Las dependencias entre módulos deberán minimizarse.

Cuando sean necesarias deberán declararse explícitamente.

Ejemplo:

CRM

depende de

Organización

Nunca deberán existir dependencias circulares.

---

# Versionado

Cada módulo mantiene su propio número de versión.

Ejemplo:

CRM

2.1.0

Inventarios

1.4.0

Compras

0.9.0-beta

El Framework podrá validar compatibilidades entre versiones.

---

# Pruebas

Cada módulo deberá incluir:

- pruebas unitarias;
- pruebas de integración;
- datos de prueba cuando sean necesarios.

La cobertura de pruebas forma parte del módulo.

---

# Documentación

Cada módulo deberá incluir:

README.md

descripción funcional

instalación

configuración

dependencias

eventos publicados

eventos consumidos

comandos disponibles

---

# Ciclo de vida

El ciclo de vida de un módulo comprende:

Creación

↓

Registro

↓

Descubrimiento

↓

Inicialización

↓

Ejecución

↓

Actualización

↓

Desinstalación

Cada fase deberá ser gestionada por MEF.

---

# Beneficios

La arquitectura modular permite:

- reutilización;
- bajo acoplamiento;
- mantenimiento independiente;
- evolución gradual;
- pruebas aisladas;
- distribución mediante Marketplace.

---

# Futuro

En versiones posteriores los módulos podrán distribuirse mediante un Marketplace oficial.

Cada módulo podrá instalarse utilizando la CLI de MEF.

Ejemplo:

php artisan mef:install crm

o

composer require mef/crm

---

# Conclusión

Los módulos constituyen la unidad fundamental de funcionalidad de MEF.

Toda capacidad de negocio deberá implementarse mediante módulos independientes.

El éxito del Framework dependerá de mantener módulos pequeños, cohesivos y desacoplados.