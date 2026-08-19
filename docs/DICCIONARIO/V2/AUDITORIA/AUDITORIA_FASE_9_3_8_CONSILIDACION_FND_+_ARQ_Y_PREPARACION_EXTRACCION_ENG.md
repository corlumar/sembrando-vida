# 9.3.8 --- Consolidación FND + ARQ y preparación de extracción ENG

**Estado:** CERRADO\
**Resultado:** `CLOSED / BASELINE FND+ARQ FROZEN / READY FOR ENG`

## 1. Objetivo

Consolidar los resultados obtenidos en las capas **FND (Fundación)** y
**ARQ (Arquitectura)** como baseline conceptual previo a la extracción
de **ENG (Ingeniería)**, preservando la trazabilidad, la jerarquía de
autoridad y las reglas de canonización establecidas.

La consolidación realizada en esta etapa no constituye, por sí misma,
una decisión de canonización.

## 2. Cadena de autoridad

Se mantiene como regla de trabajo:

**FND → ARQ → ENG**

La evidencia procedente de capas posteriores puede respaldar,
especializar, relacionar o aportar evidencia transversal sobre conceptos
existentes, pero no sustituye automáticamente la autoridad de las capas
anteriores.

DIC se mantiene como representación transversal del conocimiento
identificado durante el proceso.

## 3. Consolidación FND + ARQ

FND y ARQ quedan consolidados como una capa conceptual de referencia
previa a ENG.

La consolidación permite:

-   identificar correspondencias conceptuales entre FND y ARQ;
-   detectar especializaciones y dependencias;
-   registrar solapamientos;
-   identificar posibles conflictos;
-   distinguir candidatos sin relación previa;
-   preservar la procedencia de cada evidencia;
-   mantener separada la evidencia de autoridad de la evidencia
    transversal.

Los resultados originales de FND y ARQ permanecen congelados y no deben
ser modificados durante las etapas posteriores.

## 4. Regla de no canonización automática

Se establece explícitamente que ninguna de las siguientes condiciones
implica canonización automática:

-   coincidencia textual;
-   repetición de un término;
-   frecuencia documental;
-   presencia en múltiples fuentes;
-   coincidencia FND--ARQ;
-   evidencia transversal;
-   especialización arquitectónica;
-   aparición posterior en ENG.

La canonización requiere una decisión explícita conforme a las reglas
del proceso MEF-DIC.

Por tanto, la consolidación FND + ARQ no genera por sí sola nuevos
identificadores **MEF-DIC**.

## 5. Baseline conceptual pre-ENG

Al cierre de 9.3.8 queda establecido un **baseline FND+ARQ congelado**.

Este baseline será utilizado durante ENG para determinar si cada
candidato de Ingeniería:

1.  deriva de un concepto FND;
2.  deriva de un concepto ARQ;
3.  especializa un concepto existente;
4.  implementa o materializa una decisión arquitectónica;
5.  aporta evidencia transversal;
6.  presenta un posible conflicto;
7.  constituye un candidato nuevo sin antecedente FND/ARQ.

El baseline no deberá modificarse como consecuencia directa de la
extracción ENG.

Cualquier cambio posterior deberá quedar registrado como una decisión
explícita y auditable.

## 6. Preparación de extracción ENG

La siguiente etapa deberá realizar la extracción de Ingeniería
conservando, como mínimo, la siguiente trazabilidad:

-   fuente ENG;
-   ubicación de la evidencia;
-   término o concepto candidato;
-   contexto;
-   relación con FND;
-   relación con ARQ;
-   tipo de relación;
-   evidencia de autoridad;
-   evidencia transversal;
-   estado del candidato;
-   observaciones de auditoría.

La extracción ENG deberá contrastarse contra el baseline FND+ARQ sin
alterar los resultados congelados de las etapas anteriores.

## 7. Clasificación de relaciones para ENG

Durante el contraste con ENG podrán utilizarse, entre otras, las
siguientes relaciones:

  -----------------------------------------------------------------------
  Relación                            Descripción
  ----------------------------------- -----------------------------------
  RESPALDO                            ENG aporta evidencia compatible con
                                      un concepto previo.

  ESPECIALIZACIÓN                     ENG concreta o restringe un
                                      concepto FND/ARQ.

  DEPENDENCIA                         El elemento ENG depende
                                      conceptualmente de una autoridad
                                      previa.

  IMPLEMENTACIÓN                      ENG materializa una decisión o
                                      estructura definida previamente.

  SOLAPAMIENTO                        Existe coincidencia parcial entre
                                      conceptos.

  EVIDENCIA_TRANSVERSAL               Existe evidencia adicional sin
                                      transferencia automática de
                                      autoridad.

  POSIBLE_CONFLICTO                   La evidencia ENG parece contradecir
                                      o tensionar una autoridad previa.

  SIN_RELACIÓN                        No se identifica antecedente
                                      suficiente en FND/ARQ.
  -----------------------------------------------------------------------

Estas clasificaciones son instrumentos de análisis y no equivalen a
decisiones de canonización.

## 8. Condiciones de integridad

Durante las etapas posteriores deberán mantenerse las siguientes
condiciones:

-   FND permanece congelado.
-   ARQ permanece congelado.
-   La evidencia original no se sobrescribe.
-   La procedencia documental debe conservarse.
-   Autoridad y evidencia transversal permanecen diferenciadas.
-   ENG no puede elevar automáticamente un candidato a autoridad FND o
    ARQ.
-   No se crean IDs MEF-DIC sin decisión explícita.
-   Todo conflicto deberá quedar visible y auditable.

## 9. Resultado del cierre

La etapa 9.3.8 deja:

**FND + ARQ consolidados y congelados como baseline conceptual
pre-ENG.**

La extracción de Ingeniería puede comenzar utilizando este baseline como
referencia de contraste.

No se interpreta la consolidación como canonización ni como autorización
para modificar retrospectivamente los resultados FND o ARQ.

## 10. Estado de salida

``` text
9.3.8 = CLOSED
FND = FROZEN
ARQ = FROZEN
BASELINE_FND_ARQ = ESTABLISHED
AUTORITY_CHAIN = FND -> ARQ -> ENG
AUTO_CANONIZATION = FORBIDDEN
AUTO_MEF_DIC_ID = FORBIDDEN
ENG_EXTRACTION = READY
```

------------------------------------------------------------------------

**Cierre:** 9.3.8 finalizada.\
**Siguiente estado:** habilitada la continuación del proceso con la
extracción y análisis de la capa **ENG (Ingeniería)**.
