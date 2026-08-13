# FASE 9.1A --- AUDITORÍA COMPARATIVA DE FORMATO ENG-090 → ENG-100

## 1. Objetivo

Determinar el patrón documental canónico del bloque Data Engineering
inmediatamente anterior al tramo reducido y establecer qué debe
restaurarse en ENG-094 → ENG-100 sin alterar autoridad conceptual ni
rangos EI.

## 2. Dictamen ejecutivo

``` text
ENG-090 → ENG-093   PATRÓN EXTENSO / GRANULAR       🟢 REFERENCIA CANÓNICA
ENG-094             EXISTE VERSIÓN EXTENSA          🟢 RECUPERABLE
ENG-095 → ENG-099   EXISTEN VERSIONES EXTENSAS      🟢 RECUPERABLES
                    + versiones compactas Fase 8     🟡 FUSIONAR, NO REEMPLAZAR
ENG-100             EXISTE VERSIÓN EXTENSA          🟢 RECUPERABLE
                    + versiones corregidas Fase 8    🟡 CANONIZAR
```

**Hallazgo principal:** el contenido extenso de ENG-094 → ENG-100 no
está perdido. Existen versiones anteriores con estructura granular. Por
tanto, la normalización no debe "inventar" siete documentos extensos:
debe recuperar las versiones extensas y fusionar en ellas únicamente las
correcciones normativas válidas de Fase 8.

## 3. Patrón canónico observado en ENG-090 → ENG-093

El patrón estable incluye:

``` text
FRONT MATTER
id
titulo
tipo
nivel
categoria
subcategoria
estado
version
responsable
ultima_revision
dependencias
relacionados
keywords

CUERPO
# ENG-xxx — Título     (o identidad equivalente normalizada)
## Estado
# 1. Propósito
  + catálogo amplio de conceptos gobernados
# 2. Declaración
  + arquitectura conceptual
# 3...N
  + conceptos individualizados
  + distinciones A ≠ B
  + Identity / Scope / Boundary
  + Contract / Policy
  + Models / States / Operations
  + integración con otras autoridades ENG
  + Security / Privacy / Governance / Compliance
  + Multi-Tenancy
  + Observability / Diagnostics
  + Failure / Recovery
  + Testing
  + Primera Implementación Obligatoria
  + Invariantes EI
  + Criterios de Conformidad
  + Riesgos / Principio Rector / Conclusión cuando corresponda
# Referencias
```

No existe una obligación de que todos tengan exactamente el mismo número
de secciones. La homogeneidad es de **profundidad, granularidad y
contrato documental**, no de longitud artificial.

## 4. Evidencia de la reducción

Las versiones compactas corregidas de ENG-095/096/097/098/099 usan
aproximadamente 28 secciones y agrupan múltiples conceptos en secciones
compuestas.

Las versiones extensas anteriores separan esos conceptos
individualmente: Requirement, Contract, Policy, Identity, Scope,
Boundary, Strategy, topology/roles, routing, failure modes,
observability, etc.

Por tanto:

``` text
VERSIÓN EXTENSA ANTERIOR
        +
CORRECCIONES NORMATIVAS FASE 8
        =
VERSIÓN CANÓNICA FINAL
```

No:

``` text
VERSIÓN COMPACTA FASE 8
        +
texto de relleno
```

## 5. ENG-094

ENG-094 ya posee una versión extensa con Front Matter completo,
dependencias, relacionados, keywords y un Propósito que enumera Data
Portability, Portable Data, Identity, Scope, Boundary, Contract, Policy,
Request, Authorization, Plan, Execution, Result, Export, Import,
Transfer, Package, Manifest, Schema, Semantics, Mapping, Compatibility,
Fidelity, Integrity, Provenance, Security, Privacy, Governance,
Compliance, Residency, Validation, Verification, Evidence,
Observability, Diagnostics y Testing.

**Decisión:** recuperar esa versión extensa como base canónica de
ENG-094. No reconstruir ENG-094 desde la versión reducida.

## 6. ENG-095

Existe una versión extensa de Data Synchronization Engineering con
metadata completa y catálogo granular: Requirement, Contract, Policy,
Identity, Source/Target, Participant, Replica/Projection/Materialized
Copy, Source of Truth, Direction,
One-Way/Two-Way/Multi-Party/Multi-Master, Full/Partial/Incremental,
Push/Pull, Polling/Event-Driven, CDC, etc.

La versión compacta Fase 8 contiene correcciones útiles de autoridad y
los EI-1846 → EI-1865.

**Decisión:** base = versión extensa; merge = autoridad F8 + EI-1846 →
EI-1865 + continuidad/cierre corregidos.

## 7. ENG-096

Existe versión extensa con Requirement, Contract, Policy, Identity,
Replica, Replica Set, Replication Factor, Primary/Secondary,
Leader/Follower, Leaderless, Single/Multi-Leader, Sync/Async/Semi-Sync,
Physical/Logical, Full/Partial, Read Replica, Local/Remote/Cross-Zone,
etc.

**Decisión:** base = versión extensa; merge = frontera F8 + EI-1866 →
EI-1885 + cierre corregido.

## 8. ENG-097

Existe versión extensa con Partitioning Requirement/Contract/Policy,
Partition Identity, Key, Function, Scheme, Map, Horizontal/Vertical,
Range/Hash/List/Composite, Temporal/Tenant/Geographic, Shard, Shard Key,
Shard Map, routing, resharding, rebalancing, skew/hot shard y
cross-shard concerns.

**Decisión:** base = versión extensa; merge = frontera F8 + EI-1886 →
EI-1905.

## 9. ENG-098

Existe versión extensa con Distribution Requirement/Contract/Policy,
Scope, Strategy, Topology, Node/Site/Zone/Region, Failure Domain,
Placement, Location/Locality, Regional/Global/Edge Data, Geo/Edge
Distribution, topologías
Centralized/Distributed/Hierarchical/Hub-and-Spoke/Mesh, Propagation,
Mobility/Movement y routing locality/residency/failure-domain aware.

**Decisión:** base = versión extensa; merge = autoridad F8 + EI-1906 →
EI-1925. El Front Matter compacto serializado alfabéticamente no será el
formato final.

## 10. ENG-099

Existe versión extensa con Localization, Residency, Sovereignty,
Jurisdiction/Boundary, Requirement/Contract/Policy/Scope/Classification,
Allowed/Preferred/Required/Prohibited Jurisdiction y
Storage/Processing/Access/Execution/Transfer/Backup/Replica/Archive/Cache/Log
Residency.

**Decisión:** base = versión extensa; merge = autoridad F8 + EI-1926 →
EI-1945.

## 11. ENG-100

Existe una versión extensa con Lifecycle Contract, Identity, Scope,
Stage, State, Policy, Plan, Transition
Contract/Guard/Authority/Preconditions/Postconditions, Event, Command,
Workflow, Orchestration y todas las fases Data Creation →
Disposal/Destruction, además de Evidence, Drift, Security, Privacy,
Governance, Compliance, Observability, Diagnostics y Testing.

También existen copias corregidas posteriores que eliminan la referencia
a ENG-101 y confirman ENG-100 como techo.

**Decisión:** base = versión extensa; merge = corrección de techo
actual, autoridad especializada ENG-094 → ENG-099 y EI-1946 → EI-1965.
No usar una copia que todavía relacione ENG-101.

## 12. Diferencias de Front Matter

El patrón canónico observado usa orden humano estable:

``` yaml
id:
titulo:
tipo:
nivel:
categoria:
subcategoria:
estado:
version:
responsable:
ultima_revision:

dependencias:
  - ...

relacionados:
  - ...

keywords:
  - ...
```

Algunas versiones Fase 8 quedaron reserializadas alfabéticamente:

``` yaml
categoria:
dependencias:
estado:
id:
keywords:
nivel:
relacionados:
responsable:
subcategoria:
tipo:
titulo:
ultima_revision:
version:
```

Ambas formas pueden ser YAML válido, pero la segunda rompe la
consistencia editorial del corpus.

**Regla canónica:** restaurar el orden humano del bloque ENG-090 →
ENG-093 y conservar `keywords`.

## 13. Títulos y separadores

También se observa una diferencia:

``` text
CANÓNICO MADURO:
# ENG-090 — Data Catalog Engineering

REDUCIDO:
# ENG-098
# Data Distribution Engineering
```

La canonización deberá adoptar una identidad H1 única y consistente:

``` text
# ENG-xxx — <Título>
```

Los separadores `---` deberán usarse de forma consistente y no depender
de artefactos producidos por conversión.

## 14. Matriz de decisión

  --------------------------------------------------------------------------
  ENG               Versión extensa   Versión              Acción
                    localizada        compacta/corregida   
  ----------------- ----------------- -------------------- -----------------
  ENG-090           Sí                No relevante         Referencia

  ENG-091           Sí                No relevante         Referencia

  ENG-092           Sí                No relevante         Referencia

  ENG-093           Sí                No relevante         Referencia

  ENG-094           Sí                Sí/reducida          Recuperar extensa

  ENG-095           Sí                Sí F8                Fusionar

  ENG-096           Sí                Sí F8                Fusionar

  ENG-097           Sí                Sí F8                Fusionar

  ENG-098           Sí                Sí F8                Fusionar

  ENG-099           Sí                Sí F8                Fusionar

  ENG-100           Sí                Sí/corregidas        Fusionar y
                                                           canonizar
  --------------------------------------------------------------------------

## 15. Regla de fusión para Fase 9.1B

La precedencia será:

``` text
1. Identidad / estructura / conceptos:
   VERSIÓN EXTENSA

2. Correcciones de autoridad:
   FASE 8 / auditorías F4-F9

3. Invariantes:
   rangos finales aprobados
   ENG-094 EI-1826 → EI-1845
   ENG-095 EI-1846 → EI-1865
   ENG-096 EI-1866 → EI-1885
   ENG-097 EI-1886 → EI-1905
   ENG-098 EI-1906 → EI-1925
   ENG-099 EI-1926 → EI-1945
   ENG-100 EI-1946 → EI-1965

4. Techo:
   ENG-100; sin ENG-101+

5. Front Matter:
   orden canónico humano + dependencias/relacionados/keywords validados
```

En caso de contradicción semántica, no se hará merge automático: se
resolverá según la autoridad establecida en Fases 4 y 7.

## 16. Resultado formal

``` text
PATRÓN CANÓNICO IDENTIFICADO          🟢
PÉRDIDA TOTAL DE CONTENIDO            🟢 NO
VERSIONES EXTENSAS 094→100            🟢 LOCALIZADAS
CORRECCIONES F8 REUTILIZABLES         🟢
FRONT MATTER REDUCIDO/REORDENADO      🟡 NORMALIZAR
ESTRUCTURA H1 REDUCIDA                🟡 NORMALIZAR
ENG-100 CON REFERENCIA ENG-101        🔴 DESCARTAR ESA VARIANTE
LISTO PARA FASE 9.1B                  🟢 SÍ
```

## 17. Conclusión

La auditoría comparativa demuestra que ENG-094 → ENG-100 no deben
ampliarse artificialmente. El corpus conserva versiones extensas previas
que representan mejor el patrón documental maduro.

La estrategia correcta es **restauración + fusión controlada**: tomar
cada versión extensa como base y aplicar únicamente las correcciones
normativas, rangos EI y decisiones de techo validadas durante las
auditorías.

El siguiente paso es:

# FASE 9.1B --- RESTAURACIÓN Y FUSIÓN CANÓNICA ENG-094 → ENG-100
