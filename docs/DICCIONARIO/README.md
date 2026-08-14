# Diccionario Oficial de MEF

## 1. Objetivo

El Diccionario Oficial de MEF constituye la referencia canónica para el vocabulario utilizado en Modular Enterprise Framework (MEF).

Su propósito es garantizar que los mismos términos mantengan el mismo significado en:

- Fundación;
- Arquitectura;
- Ingeniería;
- ADR;
- RFC;
- código fuente;
- comentarios;
- documentación;
- guías;
- SDK.

El Diccionario establece el lenguaje terminológico oficial del proyecto.

---

## 2. Alcance

El Diccionario normaliza conceptos y vocabulario.

No sustituye:

- la doctrina definida por Fundación;
- las decisiones estructurales de Arquitectura;
- las especificaciones de Ingeniería;
- los ADR;
- los RFC;
- la documentación de implementación.

Cada término resume un concepto y mantiene trazabilidad hacia su autoridad primaria cuando ésta exista.

---

## 3. Jerarquía normativa

La jerarquía documental de MEF es:

```text
FND — Fundación
   ↓
ARQ — Arquitectura
   ↓
DIC — Diccionario
   ↓
ENG — Ingeniería
```

El Diccionario es autoridad terminológica.

No deberá redefinir una decisión establecida por Fundación o Arquitectura.

Cuando exista contradicción, deberá resolverse primero en la autoridad superior correspondiente antes de modificar la definición terminológica.

---

## 4. Corpus canónico

El corpus terminológico canónico está constituido por:

- `DIC-001A-ARQUITECTURA.md`
- `DIC-001B-CORE-Y-CICLO-DE-VIDA.md`
- `DIC-001C-INYECCION-DE-DEPENDENCIAS-Y-CONTRATOS.md`
- `DIC-001D-SISTEMA-DE-EVENTOS.md`
- `DIC-001E-CONSTRUCCION-Y-GENERACION.md`
- `DIC-001F-PLATFORM-Y-SERVICIOS-COMPARTIDOS.md`
- `DIC-001G-DESARROLLO-CALIDAD-Y-EXTENSIBILIDAD.md`

El rango canónico vigente es:

```text
MEF-DIC-0001 → MEF-DIC-0070
```

`INDICE.md` es un artefacto derivado de este corpus y no constituye una fuente terminológica independiente.

Los documentos contenidos en `LEGACY/` son exclusivamente históricos y no poseen autoridad canónica.

---

## 5. Identidad de los términos

Cada término deberá poseer un identificador único:

```text
MEF-DIC-XXXX
```

Reglas:

1. un identificador representa un único concepto;
2. un identificador no deberá reutilizarse;
3. los identificadores existentes no deberán renumerarse;
4. dos conceptos distintos no deberán compartir identificador;
5. un término retirado conserva históricamente su identificador;
6. la similitud nominal no constituye motivo suficiente para fusionar términos.

---

## 6. Estructura normativa

Los campos se clasifican mediante los niveles normativos `MUST`, `SHOULD` y `MAY`.

### 6.1 MUST — Obligatorios

Toda entrada canónica deberá contener:

- Identificador;
- Nombre Canónico;
- Definición;
- Propósito;
- Categoría;
- Documento de origen;
- Estado.

Una entrada que carezca de alguno de estos elementos no cumple completamente el contrato terminológico.

### 6.2 SHOULD — Recomendados

Cuando existan relaciones semánticas relevantes deberá utilizarse:

- Relacionados.

La ausencia de relaciones reales no obliga a crear contenido artificial.

### 6.3 MAY — Condicionales

Podrán utilizarse cuando aporten información pertinente:

- No confundir con;
- Responsabilidades;
- Ejemplos;
- Historial;
- otras secciones especializadas justificadas por el concepto.

Los campos `MAY` no deberán añadirse únicamente para uniformar visualmente las entradas.

---

## 7. Categorías

Todo término deberá declarar exactamente una categoría primaria.

El catálogo canónico es:

```text
Arquitectura
Core
Platform
Ingeniería
```

La categoría representa el dominio conceptual principal del término y no simplemente el archivo donde se encuentra.

No deberán crearse nuevas categorías sin una decisión normativa documentada.

---

## 8. Estados

`Estado` representa exclusivamente el ciclo de vida terminológico.

Los estados canónicos son:

```text
Propuesto
Aceptado
Estable
Deprecado
Retirado
```

### Propuesto

El término está en evaluación y su definición todavía puede cambiar materialmente.

### Aceptado

El término ha sido aprobado como parte del lenguaje oficial de MEF.

### Estable

El término está consolidado y su significado no deberá cambiar materialmente sin un proceso formal.

### Deprecado

El término permanece reconocido por compatibilidad o trazabilidad, pero su utilización nueva está desaconsejada.

### Retirado

El término dejó de formar parte del vocabulario activo. Su identificador permanece reservado y no deberá reutilizarse.

---

## 9. Dimensiones distintas de Estado

Los siguientes conceptos no constituyen estados terminológicos:

```text
Opcional
No implementado
Evolución futura
Visión futura
```

Cuando sea necesario conservar estas dimensiones deberán expresarse separadamente.

Podrán utilizarse:

### Obligatoriedad

```text
Obligatorio
Opcional
```

### Implementación

```text
Implementado
Parcial
No implementado
```

### Horizonte

```text
Actual
Futuro
Visión
```

Estos campos son opcionales y no deberán añadirse a todos los términos de forma automática.

---

## 10. Documento de origen

`Documento de origen` identifica la autoridad primaria de la cual deriva normativamente el término.

No deberá utilizarse como una lista indiscriminada de documentos relacionados.

Las referencias secundarias deberán expresarse mediante relaciones o referencias específicas.

Un Documento de origen no deberá asignarse por inferencia sin comprobar previamente la fuente correspondiente.

---

## 11. Relaciones

El catálogo inicial de relaciones terminológicas es:

```text
Relacionados
Depende de
Compuesto por
Especializa
No confundir con
```

### Relacionados

Representa una asociación conceptual general.

### Depende de

Representa dependencia conceptual o normativa.

No implica necesariamente dependencia de código.

### Compuesto por

Representa composición conceptual o estructural.

### Especializa

Indica que un concepto constituye una especialización demostrable de otro.

### No confundir con

Establece una frontera semántica explícita entre conceptos próximos.

`No confundir con` no deberá fusionarse con `Relacionados`.

---

## 12. Referencias entre términos

Cuando un concepto relacionado posea identificador oficial, deberá preferirse la referencia:

```text
MEF-DIC-XXXX — Nombre Canónico
```

sobre una cadena textual aislada.

No deberán inventarse relaciones para completar la plantilla.

Las relaciones vacías deberán omitirse.

---

## 13. Política lingüística

MEF utiliza español como idioma documental y conserva nombres técnicos canónicos cuando corresponda.

Reglas:

1. cada término posee un único Nombre Canónico;
2. los nombres técnicos establecidos en inglés podrán conservarse en inglés;
3. definiciones, propósitos y explicaciones podrán redactarse en español;
4. una traducción descriptiva no crea automáticamente un nuevo nombre canónico;
5. la representación de un concepto en código puede utilizar el casing requerido por la tecnología;
6. el casing de código no modifica la identidad terminológica.

Ejemplo:

```text
Nombre Canónico: EventId
Representación posible en código: eventId
```

---

## 14. Historial

`Historial` es un campo opcional (`MAY`).

No deberá crearse retrospectivamente información histórica artificial para completar una entrada.

Git, ADR y RFC constituyen mecanismos complementarios de trazabilidad histórica.

---

## 15. Documentos LEGACY

Los documentos ubicados en:

```text
docs/DICCIONARIO/LEGACY/
```

se conservan únicamente como evidencia histórica.

Un documento LEGACY:

- no constituye autoridad terminológica;
- no deberá utilizarse para resolver identificadores;
- no deberá alimentar el índice canónico;
- no deberá utilizarse para validar definiciones actuales;
- no deberá competir con `DIC-001A` → `DIC-001G`.

---

## 16. Índice

`INDICE.md` es un artefacto derivado.

Deberá generarse o actualizarse a partir del corpus canónico.

Ante una discrepancia entre `INDICE.md` y una entrada canónica, prevalece la entrada contenida en `DIC-001A` → `DIC-001G`.

---

## 17. Convenciones generales

Los términos deberán:

- tener una única definición oficial;
- evitar sinónimos ambiguos;
- mantener consistencia terminológica;
- preservar su identificador;
- mantener trazabilidad con su autoridad primaria;
- respetar las fronteras semánticas documentadas;
- actualizarse mediante cambios trazables;
- respetar la jerarquía normativa de MEF.

No deberán realizarse reemplazos semánticos masivos sin validación término por término.

---

## 18. Modificación del Diccionario

Toda modificación normativa deberá:

1. preservar los identificadores existentes;
2. identificar la razón del cambio;
3. respetar FND y ARQ;
4. mantener trazabilidad documental;
5. evitar pérdida de información;
6. ser verificable mediante control de versiones;
7. actualizar los artefactos derivados cuando corresponda.

Los cambios que alteren sustancialmente el significado de un término estable deberán estar respaldados por la autoridad normativa correspondiente.

---

## 19. Invariantes actuales

Durante la normalización del Diccionario:

```text
MEF-DIC-0001 → MEF-DIC-0070
```

deberá permanecer continuo y sin renumeración.

No deberán crearse nuevos identificadores únicamente para resolver problemas editoriales, de formato o de clasificación.

---

## 20. Autoridad

Este README establece el contrato de organización y normalización del Diccionario.

Las definiciones terminológicas oficiales residen en las entradas canónicas `DIC-001A` → `DIC-001G`.

La autoridad conceptual superior permanece en Fundación y Arquitectura conforme a la jerarquía normativa de MEF.
