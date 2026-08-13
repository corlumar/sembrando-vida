---
id: ENG-077
titulo: Durability Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Durability Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-10
dependencias:
  - ENG-005
  - ENG-009
  - ENG-012
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-027
  - ENG-030
  - ENG-031
  - ENG-032
  - ENG-034
  - ENG-038
  - ENG-039
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-048
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-062
  - ENG-064
  - ENG-065
  - ENG-068
  - ENG-071
  - ENG-073
  - ENG-074
  - ENG-076
relacionados:
  - ENG-006
  - ENG-007
  - ENG-008
  - ENG-011
  - ENG-013
  - ENG-014
  - ENG-015
  - ENG-017
  - ENG-018
  - ENG-019
  - ENG-022
  - ENG-026
  - ENG-028
  - ENG-033
  - ENG-035
  - ENG-036
  - ENG-037
  - ENG-040
  - ENG-044
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-049
  - ENG-050
  - ENG-051
  - ENG-052
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-063
  - ENG-066
  - ENG-067
  - ENG-069
  - ENG-070
  - ENG-072
  - ENG-075
  - ENG-078
keywords:
  - durability
  - durability-engineering
  - durable-state
  - durable-commit
  - persistence-boundary
  - durability-boundary
  - acknowledgement
  - write-ahead-log
  - wal
  - journal
  - commit-log
  - fsync
  - flush
  - replication
  - quorum-write
  - data-loss
  - data-corruption
  - retention
  - mef
---

# ENG-077

# Durability Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Durability Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-077 establece las reglas para:

```text
Durability

Durability Requirement
Durability Objective
Durability Policy
Durability Level

Committed State
Durable State
Durable Commit

Persistence Boundary
Durability Boundary

Acknowledgement
Acknowledgement Semantics

Write Durability
Transaction Durability
Message Durability
Event Durability

Crash Durability
Process Failure Durability
Node Failure Durability
Zone Failure Durability
Region Failure Durability

Data Loss
Data Corruption
Silent Corruption

Buffer
Cache
Page Cache

Flush
Sync
Fsync

Write-Ahead Log
WAL

Journal
Commit Log

Checkpoint
Snapshot

Replication
Replica

Replica Acknowledgement

Synchronous Replication
Asynchronous Replication

Replication Lag
Replication Gap

Quorum
Write Quorum

Durability Factor
Replica Count

Storage Durability
Object Durability

Retention
Expiration
Deletion
Tombstone

Compaction
Garbage Collection

Backup vs Durability

Durability Verification
Durability Audit
Durability Observability
Durability Testing
```

---

# 2. Declaración

> **MEF no deberá confirmar como durable ninguna operación antes de que el State requerido haya cruzado explícitamente la Durability Boundary correspondiente al Failure Model declarado. `write()`, buffering, cache insertion, process memory, replica count o Backup existence no deberán interpretarse automáticamente como Durable Commit. Todo Acknowledgement contractual deberá declarar qué Failure Domains puede sobrevivir el State confirmado.**

Arquitectura conceptual:

```text
APPLICATION WRITE
       │
       ▼
MEMORY / BUFFER
       │
       ▼
PERSISTENCE LAYER
       │
       ▼
DURABILITY MECHANISM
       │
       ├── WAL / Journal
       ├── Flush / fsync
       ├── Replication
       └── Quorum
       │
       ▼
DURABILITY BOUNDARY
       │
       ▼
ACKNOWLEDGE COMMIT
```

---

# 3. Durability Engineering

Durability Engineering responde:

```text
When is a write truly committed?
What failure can that committed state survive?
Is the write only in memory?
Has it reached durable storage?
Has it reached another failure domain?
How many replicas acknowledged it?
Can acknowledged data still be lost?
Can stored data become silently corrupted?
What happens during crash recovery?
What retention guarantees apply?
What does delete actually mean?
```

---

# 4. Durability

`Durability` representa la garantía de que State confirmado permanece preservado frente a un conjunto declarado de Failures.

---

# 5. Durability ≠ Persistence

Persistence significa que State puede sobrevivir más allá de una operación o proceso.

Durability define qué garantías existen respecto de Failure.

---

# 6. Durability ≠ Recoverability

Recoverability responde:

```text
Can lost or damaged state
be restored?
```

Durability responde:

```text
Should committed state
have been lost at all
under this failure model?
```

---

# 7. Durability ≠ Reliability

Reliability mide Failure Behavior.

Durability protege State confirmado frente a Failure.

---

# 8. Durability ≠ Availability

Un Store puede conservar perfectamente todos los datos y permanecer temporalmente unavailable.

---

# 9. Durability ≠ Backup

Backup proporciona Recovery Source.

Durability gobierna supervivencia del State confirmado antes de necesitar Recovery.

---

# 10. Durability ≠ Replication

Replication es una técnica.

Durability es la garantía resultante.

---

# 11. Durability Requirement

Todo Requirement deberá declarar:

```text
scope
state type
commit semantics
failure model
allowed data loss
acknowledgement semantics
verification method
```

---

# 12. Durability Requirement Example

```text
Scope:
confirmed payment transaction

Commit:
transaction acknowledged as committed

Failure Model:
single process failure
single node loss

Allowed Data Loss:
0 committed transactions

Replication:
synchronous quorum

Verification:
crash + node-loss tests
```

---

# 13. Vague Durability Requirement

No deberá aceptarse como Contract:

```text
persistent
saved
stored safely
replicated
backed up
enterprise storage
```

sin garantía explícita.

---

# 14. Durability Objective

Define qué State deberá sobrevivir y frente a qué Failure Model.

---

# 15. Durability Scope

Podrá incluir:

```text
write
transaction
message
event
record
object
checkpoint
configuration state
```

---

# 16. Failure Model

Deberá ser explícito.

Ejemplos:

```text
process crash
OS crash
power loss
node loss
disk loss
zone loss
region loss
operator deletion
storage corruption
```

---

# 17. Durability Depends on Failure Model

Un State durable frente a:

```text
process crash
```

puede no ser durable frente a:

```text
node loss
```

---

# 18. Committed State

State que el sistema ha declarado exitosamente confirmado conforme a un Contract.

---

# 19. Durable State

State que ha cruzado la Durability Boundary requerida.

---

# 20. Committed ≠ Durable Automatically

Solo serán equivalentes cuando Commit Contract así lo garantice.

---

# 21. Durable Commit

Commit cuyo Acknowledgement implica que las garantías de Durability declaradas ya fueron satisfechas.

---

# 22. Acknowledgement

Señal al Caller de que una operación alcanzó determinado estado.

---

# 23. ACK Semantics

Toda operación sensible deberá poder responder:

```text
what exactly does ACK mean?
```

---

# 24. Premature ACK

Ocurre cuando Success se devuelve antes de alcanzar la Durability requerida.

---

# 25. Premature ACK Risk

Secuencia:

```text
WRITE
 │
 ▼
MEMORY
 │
 ▼
ACK
 │
 ▼
CRASH
 │
 ▼
DATA LOST
```

viola un Durable Commit Contract.

---

# 26. Persistence Boundary

Punto donde State deja de depender exclusivamente de memoria volátil del componente.

---

# 27. Durability Boundary

Punto donde State satisface el Failure Model requerido.

---

# 28. Persistence Boundary ≠ Durability Boundary

Ejemplo:

```text
local disk
```

puede cruzar Persistence Boundary pero no una Durability Boundary que exige sobrevivir pérdida del Node.

---

# 29. Durability Levels

Podrán definirse niveles explícitos.

Ejemplo conceptual:

```text
VOLATILE
PROCESS_DURABLE
NODE_DURABLE
ZONE_DURABLE
REGION_DURABLE
```

---

# 30. Level Semantics

Los nombres solo deberán utilizarse si existe una definición contractual precisa.

---

# 31. VOLATILE

State puede existir únicamente en memoria.

---

# 32. PROCESS_DURABLE

State sobrevive al reinicio del proceso bajo condiciones declaradas.

---

# 33. NODE_DURABLE

State sobrevive a pérdida del proceso pero depende del Node/Storage asociado según Contract.

---

# 34. ZONE_DURABLE

State deberá permanecer disponible para Recovery tras pérdida del Failure Domain zonal definido.

---

# 35. REGION_DURABLE

State deberá sobrevivir pérdida regional conforme al modelo declarado.

---

# 36. Durability Ordering

Un nivel superior no deberá asumirse únicamente por Replica Count.

---

# 37. Write Path

Conceptualmente:

```text
Application
    │
    ▼
Runtime Buffer
    │
    ▼
OS/Page Cache
    │
    ▼
Filesystem/Device
    │
    ▼
Storage Controller
    │
    ▼
Physical / Managed Storage
```

---

# 38. Write Completion

Una llamada de escritura completada no significa necesariamente que los bits alcanzaron almacenamiento durable.

---

# 39. Buffering

Puede mejorar Performance pero retrasar Durability.

---

# 40. Application Buffer

Deberá vaciarse cuando Contract lo requiera.

---

# 41. OS Page Cache

Puede mantener State en memoria aunque una Write haya retornado.

---

# 42. Device Cache

Puede alterar semántica real de persistencia.

---

# 43. Flush

Solicita mover buffers hacia siguiente capa.

---

# 44. Flush ≠ Durable Universally

La semántica depende del Runtime, Filesystem y Storage.

---

# 45. Sync

Podrá solicitar sincronización del State conforme plataforma.

---

# 46. Fsync

Podrá formar parte de Durable Commit en sistemas compatibles.

---

# 47. Fsync ≠ Universal Guarantee

La garantía final depende de:

```text
filesystem
storage controller
device
provider
failure model
```

---

# 48. Storage Contract

Deberá conocerse.

---

# 49. Write-Ahead Log

WAL registra intención/cambio durable antes de aplicar State final.

---

# 50. WAL Purpose

Podrá permitir:

```text
atomicity support
crash recovery
redo
transaction recovery
```

---

# 51. WAL Ordering

El Log deberá alcanzar la Durability requerida antes del State cuya reconstrucción depende de él.

---

# 52. WAL Corruption

Deberá detectarse.

---

# 53. WAL Gap

Puede impedir Recovery completo.

---

# 54. Journal

Registra operaciones o metadata para recuperación consistente.

---

# 55. Commit Log

Mantiene secuencia ordenada de operaciones confirmadas.

---

# 56. Log Durability

Un Log solo es útil si su propia Durability satisface el Failure Model.

---

# 57. Log Position

Podrá identificar State confirmado.

---

# 58. Checkpoint

Permite reducir cantidad de Replay necesaria.

---

# 59. Checkpoint Durability

Deberá ser suficiente para su propósito.

---

# 60. Checkpoint + Log

Conceptualmente:

```text
CHECKPOINT
    │
    ▼
LOG ENTRY
    │
    ▼
LOG ENTRY
    │
    ▼
LOG ENTRY
    │
    ▼
CURRENT STATE
```

---

# 61. Crash Recovery

Deberá poder determinar:

```text
committed state
uncommitted state
incomplete writes
log replay
rollback
```

---

# 62. Torn Write

Write parcial deberá detectarse o tolerarse conforme Storage Contract.

---

# 63. Partial Record

No deberá interpretarse como State válido.

---

# 64. Atomic Write Assumption

No deberá realizarse sin conocer tamaño/semántica garantizados.

---

# 65. Transaction Durability

ENG-042 deberá determinar cuándo un Transaction Commit es durable.

---

# 66. Transaction Commit ACK

No deberá emitirse antes de satisfacer el Durability Contract correspondiente.

---

# 67. Atomicity ≠ Durability

Una transacción puede ser atómica y todavía no ser durable frente a determinado Failure.

---

# 68. Isolation ≠ Durability

No deberán confundirse.

---

# 69. Message Durability

Un Message reconocido como aceptado podrá requerir supervivencia frente a Failure.

---

# 70. Producer Acknowledgement

Deberá declarar qué significa:

```text
accepted in memory
written locally
replicated
quorum committed
```

---

# 71. Message Accepted ≠ Message Durable

No deberán confundirse.

---

# 72. Consumer ACK

Podrá implicar eliminación o avance de offset.

---

# 73. Consumer ACK Durability

No deberá causar pérdida de Message si Side Effect requerido aún no ha cruzado su propia Durability Boundary.

---

# 74. Ack-before-Commit Hazard

```text
MESSAGE
   │
   ▼
CONSUMER
   │
   ▼
ACK MESSAGE
   │
   ▼
CRASH
   │
   ▼
SIDE EFFECT LOST
```

---

# 75. Commit-before-Ack

Puede producir redelivery y deberá coordinarse con Idempotency.

---

# 76. Event Durability

Events contractuales deberán declarar Retention y Commit Semantics.

---

# 77. Event Log

Podrá actuar como Source of Truth solo si su Durability Contract lo permite.

---

# 78. Event Loss

Deberá clasificarse como Failure cuando Event era durable por Contract.

---

# 79. Replication

Mantiene copias de State en múltiples Replica Targets.

---

# 80. Replica Count

No deberá utilizarse aislado como garantía de Durability.

---

# 81. Replica Placement

Deberá considerar Failure Domains.

---

# 82. Three Replicas Same Node

No proporcionan Node Durability.

---

# 83. Three Replicas Same Zone

No proporcionan Zone Durability frente a pérdida completa de la Zone.

---

# 84. Replica Independence

Deberá analizar:

```text
host
disk
rack
zone
region
provider
software
configuration
credentials
```

---

# 85. Synchronous Replication

Commit espera confirmación de replicas requeridas.

---

# 86. Sync Replication Trade-Off

Puede incrementar:

```text
latency
dependency on remote health
coordination
```

a cambio de mayor Durability.

---

# 87. Asynchronous Replication

Primary puede confirmar antes de que Replica haya persistido el cambio.

---

# 88. Async Replication Risk

Puede producir pérdida de writes ya confirmadas tras pérdida del Primary.

---

# 89. Replication Lag

Diferencia entre Primary State y Replica.

---

# 90. Durability Exposure Window

En Async Replication podrá aproximar intervalo de writes en riesgo.

---

# 91. Replication Lag ≠ RPO Automatically

RPO pertenece a Recoverability.

Lag puede contribuir a determinar pérdida posible, pero los conceptos deberán permanecer separados.

---

# 92. Replica ACK

Deberá conocer si representa:

```text
received
buffered
written
flushed
durable
```

---

# 93. ACK Chain Semantics

Toda cadena distribuida deberá evitar transformar:

```text
received
```

en:

```text
durable
```

sin evidencia.

---

# 94. Quorum

Subconjunto requerido de replicas.

---

# 95. Write Quorum

Cantidad de replicas que deben confirmar un Write antes del Commit.

---

# 96. Quorum Size

Deberá derivarse de Consistency, Availability y Failure Model.

---

# 97. Quorum ≠ Durability Automatically

Depende de qué garantiza cada Replica ACK.

---

# 98. Quorum Placement

Replicas del Quorum deberán abarcar Failure Domains adecuados al Objective.

---

# 99. Quorum Loss

Podrá impedir Writes para preservar Contract.

---

# 100. Fail Closed for Durability

Puede ser apropiado rechazar Commit antes que confirmar un State que no cumple Durability requerida.

---

# 101. Durability Degradation

Podrá ocurrir cuando Replication Factor o Failure-Domain diversity disminuyan.

---

# 102. Degraded Durability State

Deberá ser explícito.

---

# 103. Write During Degraded Durability

Policy deberá decidir entre:

```text
reject
allow with weaker explicit durability
queue
wait
operator override
```

---

# 104. Silent Durability Downgrade

Queda prohibido.

---

# 105. Durability State

Podrá incluir:

```text
GUARANTEED
DEGRADED
AT_RISK
VIOLATED
UNKNOWN
```

---

# 106. GUARANTEED

El State observado satisface el Durability Requirement declarado.

---

# 107. DEGRADED

La arquitectura conserva parte de la garantía pero ha perdido redundancia o margen previsto.

---

# 108. AT_RISK

New Writes pueden no satisfacer completamente Objective.

---

# 109. VIOLATED

Existe evidencia de pérdida/corrupción contraria al Contract.

---

# 110. UNKNOWN

No existe evidencia suficiente.

---

# 111. UNKNOWN ≠ GUARANTEED

No deberá asumirse Durability por ausencia de incidentes.

---

# 112. Data Loss

Pérdida irreversible de State que debía preservarse.

---

# 113. Committed Data Loss

Es una violación crítica cuando el Contract prometía su supervivencia al Failure ocurrido.

---

# 114. Uncommitted Data Loss

Puede ser esperado según Transaction Contract.

---

# 115. Data Corruption

State persiste pero su contenido deja de ser correcto.

---

# 116. Durability Includes Integrity

La supervivencia de bytes incorrectos no satisface Durability útil.

---

# 117. Silent Corruption

Especialmente crítica porque puede atravesar replicas y backups.

---

# 118. Corruption Detection

Podrá utilizar:

```text
checksums
digests
ECC
validation
business invariants
scrubbing
```

---

# 119. End-to-End Integrity

Deberá favorecerse para State crítico.

---

# 120. Checksum Scope

Deberá corresponder a la unidad cuya Integrity se desea verificar.

---

# 121. Integrity Metadata

También deberá ser durable.

---

# 122. Replicated Corruption

Replication puede copiar corrupción.

---

# 123. Replica ≠ Independent Truth

No deberá asumirse.

---

# 124. Source of Truth

Deberá estar explícitamente definida.

---

# 125. Storage Durability

Managed Storage podrá ofrecer garantías propias.

---

# 126. Provider Durability Claim

Deberá distinguirse de:

```text
application-level durability
transaction durability
regional durability
recovery objective
```

---

# 127. Storage SLA ≠ Application Durability Contract

No deberán confundirse.

---

# 128. Object Durability

Podrá definir probabilidad/garantía de conservación de Objects bajo proveedor determinado.

---

# 129. Object Store Semantics

Deberán incluir:

```text
write acknowledgement
replication
versioning
deletion
consistency
retention
```

cuando sean relevantes.

---

# 130. Database Durability

Deberá considerar:

```text
transaction log
fsync policy
replication
quorum
storage
failover semantics
```

---

# 131. Database Configuration

Opciones de Performance no deberán debilitar Durability silenciosamente.

---

# 132. Unsafe Durability Optimization

Ejemplos:

```text
disable fsync
ack before log durable
reduce quorum silently
disable journaling
```

no deberán introducirse sin Contract explícito.

---

# 133. Performance vs Durability

Existe Trade-Off.

```text
lower write latency
↔
stronger durability
```

en determinadas arquitecturas.

---

# 134. Performance Optimization

No deberá cambiar Durability Semantics sin Version/Policy explícita.

---

# 135. Retention

Determina cuánto tiempo debe conservarse State.

---

# 136. Retention ≠ Durability

Durability:

```text
should the committed state survive failure?
```

Retention:

```text
for how long should state intentionally remain?
```

---

# 137. Retention Period

Deberá ser explícito.

---

# 138. Expiration

Elimina o invalida State después de Policy.

---

# 139. TTL

No deberá eliminar State antes de Retention Contract.

---

# 140. Deletion

Elimina State intencionalmente.

---

# 141. Delete Acknowledgement

Deberá declarar qué significa:

```text
logically hidden
tombstoned
removed from primary
removed from replicas
physically erased
```

---

# 142. Logical Deletion

No equivale necesariamente a Physical Erasure.

---

# 143. Tombstone

Representa eliminación lógica en sistemas replicados/log-based.

---

# 144. Tombstone Durability

Deberá ser suficiente para evitar resurrección de Data.

---

# 145. Tombstone Expiration

No deberá ocurrir antes de que replicas relevantes conozcan Delete cuando ello pueda provocar resurrección.

---

# 146. Data Resurrection

Estado eliminado reaparece por Replica atrasada o Restore incorrecto.

Deberá prevenirse.

---

# 147. Compaction

Elimina State/log entries redundantes conforme Policy.

---

# 148. Compaction Safety

No deberá eliminar información necesaria para:

```text
recovery
replication
audit
retention
```

---

# 149. Garbage Collection

Puede retirar State no referenciado.

---

# 150. GC Durability Impact

Deberá conocer Sources of Truth y Retention.

---

# 151. Backup vs Durability

Backup y Durability son complementarios.

```text
DURABILITY
→ survive expected failures

BACKUP / RECOVERY
→ recover after loss/corruption/disaster
```

---

# 152. Durable Storage Still Needs Backup

Durability no protege necesariamente contra:

```text
operator deletion
logical corruption
bad migration
ransomware
application bug
```

---

# 153. Backup Still Needs Durable Primary

Backup con RPO de una hora no protege commits de segundos recientes.

---

# 154. Durability and Recoverability

ENG-076 deberá cubrir pérdida que supera Failure Model de Durability.

---

# 155. Crash Durability

State deberá sobrevivir:

```text
process crash
OS restart
```

según Requirement.

---

# 156. Power-Loss Durability

Deberá verificar Storage semantics reales cuando Requirement lo incluya.

---

# 157. Node Failure Durability

Requiere State fuera del Failure Domain del Node cuando pérdida completa sea contemplada.

---

# 158. Zone Failure Durability

Requiere copias/State válidos fuera de Zone afectada.

---

# 159. Region Failure Durability

Requiere diseño cross-region suficiente.

---

# 160. Failure-Domain Durability Matrix

Podrá representarse:

```text
Failure             Required Survival
Process crash       YES
Node loss           YES
Zone loss           YES
Region loss         NO
Operator deletion   via Recovery
```

---

# 161. Durability Matrix

Deberá ser preferible a términos vagos como:

```text
highly durable
```

---

# 162. Multi-Tenancy Durability

ENG-048 deberá preservar aislamiento.

---

# 163. Cross-Tenant Durability Violation

Recovery/Replication/Compaction de un Tenant no deberá dañar State de otro.

---

# 164. Tenant Deletion

Deberá respetar Retention y Erasure Policy correspondientes.

---

# 165. Transaction Durability

ENG-042 continúa siendo Owner de Transaction Contract.

ENG-077 define requisitos de supervivencia del Commit.

---

# 166. Messaging Durability

ENG-041 continúa siendo Owner de Messaging Semantics.

ENG-077 formaliza cuándo un Message aceptado puede considerarse durable.

---

# 167. Pipeline Durability

ENG-064 deberá considerar:

```text
checkpoint
offset
intermediate state
sink commit
```

---

# 168. Pipeline Checkpoint ACK

No deberá avanzar más allá del State realmente durable requerido.

---

# 169. State Management

ENG-053 deberá declarar State Authority.

---

# 170. Durable State Store

Deberá conocerse para State crítico.

---

# 171. In-Memory State

No deberá utilizarse como Durable Authority.

---

# 172. Cache

ENG-037 no deberá convertirse silenciosamente en Durable Store.

---

# 173. Cache Persistence

Aunque exista, no deberá asumirse Source of Truth sin Contract.

---

# 174. Configuration Durability

ENG-049 deberá considerar versiones y Recovery Sources cuando Configuration sea crítica.

---

# 175. Secret Durability

Secrets deberán poder persistir/recuperarse conforme Security y Recovery Policy.

---

# 176. Secret Persistence ≠ Secret Exposure

Durability no deberá debilitar protección criptográfica.

---

# 177. Metadata Durability

Metadata contractual relevante podrá requerir persistencia durable.

---

# 178. Registry State

ENG-020 deberá distinguir Registry reconstruible de State que requiere Durability.

---

# 179. Reconstructible State

No necesita necesariamente misma Durability que Source of Truth.

---

# 180. Derived State

Podrá reconstruirse.

---

# 181. Derived State Durability

Podrá ser menor si Reconstruction Cost y Availability Contract lo permiten.

---

# 182. Durable Identity

Identifiers persistentes no deberán reutilizarse accidentalmente tras Recovery.

---

# 183. Sequence Durability

Contadores/Sequences pueden requerir Durability para evitar duplicación.

---

# 184. Idempotency-Key Durability

Puede ser necesaria para evitar repetir Side Effects después de Crash.

---

# 185. Deduplication State Durability

Deberá ser suficiente para el Delivery Contract.

---

# 186. Lease Durability

Normalmente un Lease representa State temporal y no deberá tratarse como Durable Ownership permanente.

---

# 187. Durability During Migration

ENG-065 no deberá reducir garantías de State confirmado sin Plan explícito.

---

# 188. Migration Copy

Data copiada no deberá considerarse Authoritative hasta cumplir Verification/Commit Semantics.

---

# 189. Migration Cutover

Deberá asegurar qué Store posee Durable Authority.

---

# 190. Dual Write Durability

Cuando exista:

```text
Store A
Store B
```

deberá definirse qué ocurre si solo uno confirma.

---

# 191. Dual Write ≠ Atomic Replication

No deberán confundirse.

---

# 192. Durability During Upgrade

Mixed Versions deberán compartir una interpretación compatible de Durable State.

---

# 193. Durability During Deployment

Rolling/Blue-Green no deberán producir pérdida de State por Termination prematura.

---

# 194. Drain

Work in-flight deberá alcanzar Commit o abortarse correctamente antes de retirar Unit.

---

# 195. Shutdown Durability

Buffered State deberá manejarse antes de finalizar cuando Contract lo requiera.

---

# 196. Forced Shutdown

Deberá ser tolerado conforme Crash Durability prometida.

---

# 197. Durability and Concurrency

ENG-038 deberá preservar Ordering/Visibility suficiente para Commit.

---

# 198. Concurrent Commit

No deberá producir Lost Update o State parcialmente confirmado.

---

# 199. Durability and Resilience

Retries no deberán convertir un Commit ambiguo en Duplicate Side Effect.

---

# 200. Ambiguous Commit

Caso donde Caller no sabe si Commit ocurrió.

Ejemplo:

```text
server commits
      │
      ▼
connection fails
      │
      ▼
client sees timeout
```

---

# 201. Ambiguous Commit Handling

Deberá utilizar:

```text
idempotency
status lookup
transaction identity
deduplication
```

cuando sea necesario.

---

# 202. Unknown Outcome

No deberá reinterpretarse automáticamente como Failure/no-commit.

---

# 203. Durability Security

ENG-024 gobernará controles generales.

---

# 204. Integrity Protection

Durable Data deberá protegerse contra manipulación no autorizada.

---

# 205. Encryption at Rest

No constituye Durability por sí sola, pero protege Confidentiality del State durable.

---

# 206. Key Durability

Keys necesarias para acceder a Data deberán formar parte del Recovery Model.

---

# 207. Immutable Storage

Podrá utilizarse para:

```text
audit
backup
critical logs
ransomware resistance
```

---

# 208. Tamper Evident State

Podrá requerirse para ciertos registros.

---

# 209. Unauthorized Deletion

Deberá considerarse Security + Durability risk.

---

# 210. Durability Downgrade Authorization

Cambiar a nivel más débil deberá requerir Authority cuando afecte Contract.

---

# 211. Durability Audit

Operaciones críticas deberán ser auditables.

---

# 212. Audit Events

Podrán incluir:

```text
durability policy changed
replication factor changed
write quorum changed
fsync policy changed
journal disabled
durability degraded
data loss detected
corruption detected
retention changed
durability override granted
```

---

# 213. Durability Observability

ENG-025 gobernará Telemetry.

---

# 214. Metrics

Podrán incluir:

```text
mef.durability.commit.total
mef.durability.commit.duration
mef.durability.degraded
mef.durability.violation.total

mef.durability.replication.lag
mef.durability.replica.available
mef.durability.quorum.available

mef.durability.data_loss.total
mef.durability.corruption.total
mef.durability.integrity.failure.total
```

---

# 215. Commit Latency

Deberá poder relacionarse con Durability Level.

---

# 216. Replica Metrics

Deberán distinguir:

```text
received
persisted
durable
applied
```

cuando tecnología lo permita.

---

# 217. Replication Lag Metric

Deberá declarar unidad:

```text
time
bytes
log positions
transactions
```

---

# 218. Durability Cardinality

Record IDs individuales no deberán utilizarse indiscriminadamente como Metric Labels.

---

# 219. Durability Logs

Podrán registrar:

```text
durability degradation
quorum loss
replica loss
corruption detection
recovery of redundancy
```

---

# 220. Diagnostics

Deberá poder responder:

```text
what durability level is required?
what durability level is effective?
when is commit acknowledged?
where is the state persisted?
how many replicas acknowledged?
which failure domains contain copies?
is quorum available?
is replication lagging?
has durability been downgraded?
was committed data lost?
```

---

# 221. Durability Snapshot

Conceptualmente:

```text
DurabilitySnapshot
├── state
├── requiredLevel
├── effectiveLevel
├── replication
├── quorum
├── lag
├── integrity
└── observedAt
```

---

# 222. Durability Verification

Deberá comprobar que implementación cumple Contract.

---

# 223. Verification ≠ Configuration Inspection

Ver una opción:

```text
fsync=true
```

no basta si la cadena completa no ha sido validada.

---

# 224. End-to-End Durability Verification

Podrá requerir Failure Injection.

---

# 225. Testing

ENG-009 gobernará Testing.

---

# 226. Process Crash Test

Deberá verificar State confirmado.

---

# 227. Abrupt Termination Test

Deberá evitar Graceful Flush para probar Crash Contract.

---

# 228. OS/Node Failure Test

Cuando sea parte del Requirement deberá comprobar supervivencia.

---

# 229. Power-Loss Simulation

Podrá requerir herramientas específicas y Environment controlado.

---

# 230. Buffered Write Test

Deberá comprobar que ACK no se emita prematuramente.

---

# 231. WAL Recovery Test

Deberá comprobar Replay y Commit Boundaries.

---

# 232. Torn Write Test

Deberá comprobar Detection/Recovery cuando aplique.

---

# 233. Corruption Test

Deberá introducir corrupción controlada y verificar Detection.

---

# 234. Replica Loss Test

Deberá comprobar Durability State.

---

# 235. Quorum Loss Test

Deberá comprobar comportamiento de Writes.

---

# 236. Synchronous Replication Test

Deberá comprobar que Commit espere las ACK requeridas.

---

# 237. Asynchronous Replication Test

Deberá medir Data Loss Window bajo Primary Failure.

---

# 238. Replica Placement Test

Deberá comprobar Failure-Domain distribution.

---

# 239. Node Loss Test

Deberá verificar committed State conforme Requirement.

---

# 240. Zone Loss Test

Cuando aplique deberá comprobar State fuera de Zone.

---

# 241. Region Loss Test

Cuando aplique deberá comprobar State durable cross-region.

---

# 242. Message Durability Test

Deberá probar:

```text
producer crash
broker crash
consumer crash
ack timing
redelivery
```

---

# 243. Transaction Durability Test

Deberá probar Crash inmediatamente después del Commit ACK.

---

# 244. Ambiguous Commit Test

Deberá simular pérdida de conexión en límite de Commit.

---

# 245. Idempotency State Test

Deberá comprobar que Deduplication sobreviva al Failure requerido.

---

# 246. Shutdown Test

Deberá probar Graceful y Forced Shutdown.

---

# 247. Retention Test

Deberá verificar que State permanezca durante plazo requerido.

---

# 248. Expiration Test

Deberá verificar eliminación según Policy.

---

# 249. Tombstone Test

Deberá evitar Data Resurrection.

---

# 250. Compaction Test

Deberá comprobar que no elimine State necesario.

---

# 251. Multi-Tenant Durability Test

Deberá comprobar aislamiento.

---

# 252. Security Test

Deberá intentar:

```text
unauthorized durability downgrade
replica tampering
log tampering
unauthorized delete
integrity bypass
cross-tenant data corruption
```

---

# 253. Architecture Test

Podrá impedir:

```text
write returned therefore durable
replicated therefore durable
backup exists therefore durable
replica count without failure domains
ACK before required durability boundary
async replication advertised as zero-loss
quorum without ACK semantics
cache used as source of truth
```

---

# 254. Build Integration

ENG-012 podrá validar:

```text
durability requirement declarations
durability levels
replication configuration
minimum replica count
write quorum
retention policy
unsafe durability overrides
```

---

# 255. Durability Tests in CI

Tests ligeros podrán ejecutarse regularmente.

Failure-domain tests amplios podrán ejecutarse en:

```text
integration pipeline
reliability pipeline
preproduction
storage validation environment
```

---

# 256. CLI

ENG-007 podrá proporcionar:

```text
mef durability
mef durability:requirements
mef durability:state
mef durability:replication
mef durability:quorum
mef durability:lag
mef durability:retention
mef durability:verify
mef durability:test
mef durability:diagnose
```

---

# 257. `mef durability`

Podrá mostrar:

```text
required level
effective level
state
integrity
```

---

# 258. `durability:requirements`

Podrá mostrar:

```text
scope
commit semantics
failure model
allowed data loss
ack semantics
```

---

# 259. `durability:state`

Podrá mostrar:

```text
GUARANTEED
DEGRADED
AT_RISK
VIOLATED
UNKNOWN
```

---

# 260. `durability:replication`

Podrá mostrar:

```text
replicas
failure domains
ack state
lag
```

---

# 261. `durability:quorum`

Podrá mostrar:

```text
required
available
durable acknowledgements
```

---

# 262. `durability:lag`

Podrá mostrar Replication Lag.

---

# 263. `durability:retention`

Podrá mostrar:

```text
retention
expiration
tombstone policy
compaction
```

---

# 264. `durability:verify`

Deberá verificar Contract de Durability.

---

# 265. `durability:test`

Podrá ejecutar Failure Test autorizado.

---

# 266. `durability:diagnose`

Podrá mostrar:

```text
requirement
effective durability
ack boundary
persistence boundary
replicas
quorum
failure domains
lag
integrity
retention
recent violations
```

---

# 267. Registry Integration

ENG-020 podrá registrar:

```text
DurabilityRequirement
DurabilityPolicy
DurabilityLevel
DurabilityVerifier
DurabilityGate
```

---

# 268. Durability Requirement Contract

Conceptualmente:

```text
DurabilityRequirement
├── id
├── scope
├── stateType
├── commitSemantics
├── failureModel
├── allowedDataLoss
├── acknowledgement
└── metadata
```

---

# 269. Durability Level Contract

Conceptualmente:

```text
DurabilityLevel
├── id
├── failureDomains
├── acknowledgementRequirements
├── replicationRequirements
└── integrityRequirements
```

---

# 270. Durability Policy

Conceptualmente:

```text
DurabilityPolicy
├── requirement
├── persistence
├── replication
├── quorum
├── acknowledgement
├── retention
└── degradationBehavior
```

---

# 271. Replica State

Conceptualmente:

```text
ReplicaState
├── id
├── failureDomain
├── receivedPosition
├── durablePosition
├── appliedPosition
├── healthy
└── observedAt
```

---

# 272. Durability Commit Result

Conceptualmente:

```text
DurabilityCommitResult
├── committed
├── durable
├── level
├── replicas
├── quorum
├── commitPosition
└── acknowledgedAt
```

---

# 273. Durability Verification Result

Conceptualmente:

```text
DurabilityVerificationResult
├── valid
├── requiredLevel
├── effectiveLevel
├── failureDomains
├── integrity
├── violations
└── diagnostics
```

---

# 274. Durability Runtime

Conceptualmente:

```text
DurabilityRuntime
├── requirement
├── commit
├── state
├── replication
├── quorum
├── verify
└── diagnose
```

---

# 275. Durability Gate

Podrá utilizarse para:

```text
deployment
migration
storage change
replication change
database configuration change
critical release
```

---

# 276. Gate Inputs

Podrán incluir:

```text
required durability
effective durability
replica count
failure-domain diversity
quorum
integrity
lag
```

---

# 277. Gate Failure

Deberá impedir operación cuando el cambio pudiera violar Commit Contract.

---

# 278. Gate Override

Deberá requerir Authority y Audit.

---

# 279. Durability Degradation Policy

Podrá establecer:

```text
BLOCK_WRITES
READ_ONLY
EXPLICIT_WEAKER_ACK
QUEUE
MANUAL_INTERVENTION
```

---

# 280. Explicit Weaker ACK

Solo deberá utilizarse cuando Caller Contract soporte conocer la degradación.

---

# 281. Hidden Downgrade

Queda prohibido.

---

# 282. Durability Baseline

Podrá registrar:

```text
commit latency
replica configuration
failure domains
quorum
integrity checks
failure test results
```

---

# 283. Durability Regression

Ocurre cuando una nueva Version/Configuration reduce garantía o evidencia.

Ejemplos:

```text
ACK now occurs before fsync
replication changed sync → async
replicas moved to same zone
write quorum reduced
corruption detection removed
```

---

# 284. Durability Regression ≠ Performance Improvement

Una menor Write Latency causada por garantía más débil no deberá clasificarse únicamente como Optimization.

---

# 285. Durability Review

Deberá realizarse ante:

```text
database change
storage change
replication change
region topology change
transaction change
messaging change
migration
backup/recovery architecture change
```

---

# 286. Durability Ownership

Todo Requirement crítico deberá poseer Owner.

---

# 287. Owner Responsibility

Incluye:

```text
failure model
commit semantics
ack semantics
replication requirements
retention
verification
```

---

# 288. First Implementation Components

La primera implementación deberá incluir:

```text
DurabilityState
DurabilityLevel

DurabilityRequirement
DurabilityPolicy

PersistenceBoundary
DurabilityBoundary

AcknowledgementSemantics

ReplicaState
DurabilityCommitResult

DurabilityVerifier
DurabilityVerificationResult

DurabilityRuntime
DurabilityRegistry

DurabilityError
```

---

# 289. Optional Initial Components

Podrán incorporarse:

```text
DurabilitySnapshot
DurabilityGate

ReplicationInspector
QuorumInspector
IntegrityVerifier

DurabilityDiagnostics
```

---

# 290. Later Components

Solo cuando exista necesidad demostrada:

```text
Automatic Durability Optimization
Adaptive Quorum
Cross-Region Durability Controller
Continuous Failure-Domain Verification
Predictive Durability Risk
AI-Assisted Durability Engineering
```

---

# 291. Estructura Conceptual de Directorios

```text
src/
└── Durability/
    ├── State/
    │   └── DurabilityState
    │
    ├── Level/
    │   └── DurabilityLevel
    │
    ├── Requirement/
    │   └── DurabilityRequirement
    │
    ├── Policy/
    │   └── DurabilityPolicy
    │
    ├── Boundary/
    │   ├── PersistenceBoundary
    │   └── DurabilityBoundary
    │
    ├── Acknowledgement/
    │   └── AcknowledgementSemantics
    │
    ├── Replication/
    │   ├── ReplicaState
    │   └── ReplicationInspector
    │
    ├── Quorum/
    │   └── QuorumInspector
    │
    ├── Commit/
    │   └── DurabilityCommitResult
    │
    ├── Integrity/
    │   └── IntegrityVerifier
    │
    ├── Verification/
    │   ├── DurabilityVerifier
    │   └── DurabilityVerificationResult
    │
    ├── Gate/
    │   └── DurabilityGate
    │
    ├── Runtime/
    │   └── DurabilityRuntime
    │
    ├── Snapshot/
    │   └── DurabilitySnapshot
    │
    ├── Registry/
    │   └── DurabilityRegistry
    │
    ├── Diagnostics/
    │   └── DurabilityDiagnostics
    │
    └── Error/
        └── DurabilityError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 292. Error Namespace

ENG-077 utilizará:

```text
MEF-DURABILITY-xxx
```

---

# 293. Taxonomía ENG-077

```text
MEF-DURABILITY-001 Durability requirement invalid
MEF-DURABILITY-002 Durability level invalid
MEF-DURABILITY-003 Durability failure model invalid
MEF-DURABILITY-004 Durability acknowledgement invalid
MEF-DURABILITY-005 Persistence boundary invalid
MEF-DURABILITY-006 Durability boundary not reached
MEF-DURABILITY-007 Premature durability acknowledgement
MEF-DURABILITY-008 Durable commit failed
MEF-DURABILITY-009 WAL unavailable
MEF-DURABILITY-010 WAL integrity violation
MEF-DURABILITY-011 Journal unavailable
MEF-DURABILITY-012 Replica unavailable
MEF-DURABILITY-013 Replica durability insufficient
MEF-DURABILITY-014 Replication lag excessive
MEF-DURABILITY-015 Write quorum unavailable
MEF-DURABILITY-016 Failure-domain diversity insufficient
MEF-DURABILITY-017 Durability degraded
MEF-DURABILITY-018 Durability at risk
MEF-DURABILITY-019 Durable data loss detected
MEF-DURABILITY-020 Data corruption detected
MEF-DURABILITY-021 Silent corruption detected
MEF-DURABILITY-022 Retention violation
MEF-DURABILITY-023 Data resurrection detected
MEF-DURABILITY-024 Compaction durability violation
MEF-DURABILITY-025 Durability verification failed
MEF-DURABILITY-026 Durability gate failed
MEF-DURABILITY-027 Durability override denied
MEF-DURABILITY-028 Durability security violation
MEF-DURABILITY-029 Durability state unknown
MEF-DURABILITY-030 Durability invariant violation
```

---

# 294. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Durability Requirements
Explicit Failure Models

Committed vs Durable distinction

Persistence Boundary
Durability Boundary

Explicit ACK Semantics

Write Durability
Transaction Durability
Message Durability

WAL / Journal Awareness
Flush / fsync Awareness

Replication Semantics
Replica ACK Semantics

Failure-Domain Placement
Quorum

Durability Degradation State

Data Loss Detection
Corruption Detection

Retention
Deletion Semantics

Backup vs Durability separation

Security
Audit
Observability
Testing
```

---

# 295. First Version Non-Goals

No deberá requerir:

```text
Adaptive Quorum
Automatic Durability Optimization
Cross-Region Durability Controller
Continuous Failure-Domain Optimization
Predictive Durability Risk
AI-Assisted Durability Engineering
```

---

# 296. Second Phase

Podrá incorporar:

```text
Durability Gates
Durability Snapshots

Replication Inspector
Quorum Inspector

Advanced Integrity Verification

Failure-Domain Matrix
Durability Baselines
Regression Detection
```

---

# 297. Third Phase

Solo cuando exista necesidad demostrada:

```text
Adaptive Quorum
Automatic Durability Optimization
Cross-Region Durability Control
Continuous Failure-Domain Verification
Predictive Durability Risk
AI-Assisted Durability Engineering
```

---

# 298. Invariantes de Ingeniería

ENG-077 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1486 | Todo Durability Requirement contractual deberá declarar Scope, State Type, Commit Semantics, Failure Model, Allowed Data Loss, Acknowledgement Semantics y Verification Method suficientes para ser comprobable. |
| EI-1487 | Durability deberá permanecer diferenciada de Persistence, Reliability, Availability, Recoverability, Backup y Replication y ninguna de estas propiedades deberá utilizarse como prueba automática de Durable Commit. |
| EI-1488 | Committed State y Durable State deberán mantenerse diferenciados salvo que el Commit Contract garantice explícitamente que el Acknowledgement solo ocurre después de cruzar la Durability Boundary requerida. |
| EI-1489 | Persistence Boundary y Durability Boundary deberán modelarse independientemente y persistir State fuera de memoria del proceso no deberá considerarse suficiente cuando el Failure Model incluya pérdida del Node, Zone, Region u otro Domain superior. |
| EI-1490 | Toda Acknowledgement Semantics deberá definir si State fue recibido, buffered, written, flushed, replicated o durably committed y un estado más débil no deberá presentarse como uno más fuerte. |
| EI-1491 | Buffer, Page Cache, Flush, Sync y fsync deberán interpretarse conforme a Contracts reales del Runtime, Filesystem y Storage y ninguna llamada individual deberá asumirse como garantía universal de Durability. |
| EI-1492 | WAL, Journal, Commit Log y Checkpoint deberán poseer Ordering, Integrity y Durability suficientes para el Recovery Contract que dependa de ellos y Log Gaps/Corruption deberán ser detectables. |
| EI-1493 | Transaction y Message ACKs no deberán adelantarse a la Durability Boundary requerida de sus efectos contractuales y los Ambiguous Commits deberán manejarse mediante Identity, Idempotency, Deduplication o Status Resolution según Architecture. |
| EI-1494 | Replication Factor por sí solo no deberá determinar Durability; Replica ACK Semantics, Failure-Domain Placement, Correlation y Replica Durability deberán formar parte de la garantía efectiva. |
| EI-1495 | Synchronous y Asynchronous Replication deberán mantenerse diferenciadas y Writes confirmadas antes de Replica Durability deberán tratarse explícitamente como expuestas a Data Loss bajo Failure del Primary. |
| EI-1496 | Quorum deberá declarar tamaño, Failure-Domain distribution y significado de cada ACK y la pérdida del Quorum podrá bloquear Writes antes que reducir silenciosamente la garantía contractual. |
| EI-1497 | Durability Degradation deberá representarse explícitamente y todo downgrade de garantía para nuevos Writes deberá bloquearse, comunicarse mediante Contract explícito o requerir Authority; el downgrade silencioso queda prohibido. |
| EI-1498 | Durability deberá incluir Integrity: Data Corruption, Torn Writes, Silent Corruption y Replicated Corruption deberán tratarse como violaciones aunque los bytes continúen físicamente almacenados. |
| EI-1499 | Retention, Expiration, Deletion, Tombstones, Compaction y Garbage Collection deberán permanecer diferenciados de Durability y no deberán eliminar o resucitar State contrario al Retention/Delete Contract. |
| EI-1500 | Backup y Durability deberán ser complementarios: Backup no deberá justificar una Durability primaria débil y almacenamiento durable no deberá eliminar la necesidad de Recovery frente a Logical Corruption, Operator Error, Ransomware o Disaster fuera del Failure Model. |
| EI-1501 | Stateful Migration, Upgrade, Deployment, Dual-Write y Scale Transitions deberán preservar una Durable Authority conocida y ningún Cutover deberá dejar ambiguo qué Store posee el State contractual confirmado. |
| EI-1502 | Durability Security deberá proteger Logs, Replicas, Integrity Metadata, Retention/Deletion Policies y Durability Configuration y ningún ajuste de Performance deberá debilitar fsync, Journal, Quorum o Replication Contract sin Authorization explícita. |
| EI-1503 | Durability Audit y Observability deberán permitir determinar Required/Effective Durability, ACK Boundary, Replica State, Failure-Domain Placement, Quorum, Replication Lag, Integrity y Violations mediante Telemetry de Cardinality controlada. |
| EI-1504 | Durability Testing deberá cubrir Process/Forced Crash, Buffered Writes, WAL Recovery, Torn Writes, Corruption, Replica/Quorum Loss, Sync/Async Replication, Node/Zone/Region Failure, Transaction/Message ACK Timing, Ambiguous Commit, Idempotency State, Retention, Tombstones, Compaction, Multi-Tenant Isolation y Security según Architecture. |
| EI-1505 | La primera implementación deberá priorizar Durability Requirements, Failure Models, Commit/Durable distinction, Persistence/Durability Boundaries, ACK Semantics, WAL/Journal Awareness, Replication/Quorum Semantics, Failure-Domain Placement, Degradation, Integrity y Retention antes de introducir Adaptive Quorum, Automatic Durability Optimization o Predictive Durability Management. |

---

# 299. Continuidad de Invariantes

```text
ENG-073 → EI-1406 a EI-1425
ENG-074 → EI-1426 a EI-1445
ENG-075 → EI-1446 a EI-1465
ENG-076 → EI-1466 a EI-1485
ENG-077 → EI-1486 a EI-1505
```

---

# 300. Criterios de Conformidad

Una implementación será conforme con ENG-077 cuando:

- defina Durability Requirements;
- declare Failure Models;
- diferencie Committed y Durable State;
- defina Persistence Boundary;
- defina Durability Boundary;
- declare ACK Semantics;
- evite Premature Acknowledgement;
- modele Write Durability;
- modele Transaction Durability;
- modele Message Durability;
- conozca Buffering;
- conozca Flush/fsync Semantics;
- modele WAL/Journal;
- controle Log Integrity;
- modele Replication;
- declare Replica ACK Semantics;
- declare Replica Failure Domains;
- diferencie Sync y Async Replication;
- mida Replication Lag;
- modele Quorum;
- detecte Quorum Loss;
- modele Durability Degradation;
- evite Silent Downgrade;
- detecte Data Loss;
- detecte Corruption;
- controle Retention;
- modele Delete Semantics;
- evite Data Resurrection;
- controle Compaction;
- diferencie Backup y Durability;
- preserve Multi-Tenant Isolation;
- aplique Security;
- implemente Audit;
- implemente Observability;
- ejecute Failure Tests.

---

# 301. Riesgos

Deberán evitarse especialmente:

```text
Write Returned Therefore Durable
Committed Equals Durable Automatically

Persistence Equals Durability
Local Disk Equals Node Durability

Flush Equals Durable Universally
fsync Assumed Without Storage Contract

WAL Without Integrity
WAL Gap

Producer ACK Before Durable State
Consumer ACK Before Side Effect Commit

Replica Count Equals Durability
Replicas in Same Failure Domain
Replica Received Equals Replica Durable

Async Replication Advertised as Zero-Loss
Quorum Without ACK Semantics

Silent Durability Downgrade
Writes Continue After Required Quorum Lost

Stored Bytes Equals Correct Data
Silent Corruption Ignored
Replicated Corruption

Backup Equals Durability
Durable Storage Means No Backup Needed

TTL Violates Retention
Tombstone Removed Too Early
Data Resurrection

Cache Used as Durable Authority

Dual Write Without Authority
Migration Cutover With Ambiguous Source of Truth

Performance Optimization Weakens Durability
```

---

# 302. Relación con ENG-030

Persistence Engineering define mecanismos de almacenamiento.

Durability define qué Failure Guarantees deberá proporcionar el State almacenado.

---

# 303. Relación con ENG-041

Messaging define Delivery y Processing Semantics.

Durability determina qué significa que un Message esté durablemente aceptado.

---

# 304. Relación con ENG-042

Transaction Engineering define:

```text
begin
commit
rollback
atomicity
isolation
```

ENG-077 define cuándo el Commit confirmado sobrevivirá al Failure Model declarado.

---

# 305. Relación con ENG-043

Data Access no deberá ocultar Durability Semantics críticas del Store.

---

# 306. Relación con ENG-053

State Management deberá identificar:

```text
source of truth
derived state
volatile state
durable state
```

---

# 307. Relación con ENG-064

Pipeline checkpoints y offsets deberán cruzar Durability Boundary suficiente antes de declarar progreso irrevocable.

---

# 308. Relación con ENG-073

Availability y Durability pueden entrar en tensión.

Ejemplo:

```text
quorum unavailable
```

podrá reducir Availability de Writes para preservar Durability.

---

# 309. Relación con ENG-074

Pérdida de State confirmado constituye Reliability Failure además de Durability Violation.

---

# 310. Relación con ENG-076

Recoverability actúa cuando State se pierde, corrompe o queda fuera del Failure Model de Durability.

```text
DURABILITY
→ prevent committed-state loss

RECOVERABILITY
→ restore after loss
```

---

# 311. Relación con ENG-070

Performance optimizations deberán demostrar que no debilitan Durability Contract.

---

# 312. Relación con ENG-078

**ENG-078 deberá formalizar Consistency Engineering.**

La frontera será:

```text
DURABILITY
ENG-077
→ Once state is committed,
  will it survive the declared failures?

CONSISTENCY
ENG-078
→ When multiple operations, replicas
  or observers interact, what guarantees
  define which state they may observe
  and in what order?
```

ENG-078 deberá cubrir:

```text
Consistency
Consistency Requirement
Consistency Model

Strong Consistency
Eventual Consistency

Linearizability
Sequential Consistency
Causal Consistency

Read-Your-Writes
Monotonic Reads
Monotonic Writes

Session Consistency

Replica Consistency
Replication Consistency

Read Consistency
Write Consistency

Stale Read
Fresh Read

Consistency Window
Convergence

Conflict
Conflict Detection
Conflict Resolution

Last-Write-Wins
LWW

Version Vector
Logical Clock

Optimistic Concurrency
Pessimistic Concurrency

Compare-And-Swap
CAS

Lost Update
Write Skew

Split Brain
Divergence

Quorum Read
Quorum Write

Consistency vs Availability

Consistency Security
Consistency Audit
Consistency Observability
Consistency Testing
```

---

# 313. Principio Rector

> **MEF deberá considerar durable únicamente el State que haya alcanzado la frontera necesaria para sobrevivir al Failure Model prometido. El sistema deberá poder explicar con precisión qué significa cada Commit y cada ACK; si no puede determinar dónde se encuentran los datos, qué replicas los han confirmado y qué Failures pueden destruirlos, no podrá afirmar que dichos datos son durablemente seguros.**

---

# 314. Conclusión

**ENG-077 — Durability Engineering** formaliza qué significa conservar correctamente State confirmado.

La frontera fundamental queda:

```text
WRITE
  │
  ▼
BUFFER
  │
  ▼
PERSIST
  │
  ▼
REPLICATE
  │
  ▼
QUORUM / REQUIRED ACK
  │
  ▼
DURABILITY BOUNDARY
  │
  ▼
COMMIT ACK
```

No:

```text
write()
  │
  ▼
success
  │
  ▼
therefore durable
```

La relación entre Persistence y Durability queda:

```text
MEMORY
   │
   ▼
PERSISTENCE BOUNDARY
   │
   ▼
LOCAL STORAGE
   │
   ▼
DURABILITY BOUNDARY
   │
   ▼
FAILURE-DOMAIN SAFE STATE
```

La semántica de ACK queda:

```text
RECEIVED
   │
   ▼
BUFFERED
   │
   ▼
WRITTEN
   │
   ▼
FLUSHED
   │
   ▼
REPLICATED
   │
   ▼
DURABLE
```

Estos estados **no son equivalentes**.

La diferencia Sync/Async queda:

```text
SYNCHRONOUS

PRIMARY
   │
   ├──► REPLICA A ── durable
   └──► REPLICA B ── durable
            │
            ▼
          QUORUM
            │
            ▼
           ACK
```

frente a:

```text
ASYNCHRONOUS

PRIMARY
   │
   ▼
  ACK
   │
   ▼
replication later
   │
   X primary failure
   │
   ▼
possible acknowledged-write loss
```

La relación Failure Domain queda:

```text
3 COPIES
same node
   │
   ▼
NODE FAILURE
   │
   ▼
ALL LOST
```

por lo que:

```text
Replica Count
≠
Durability Level
```

La integridad queda:

```text
DATA STORED
    │
    ▼
INTEGRITY CHECK
    │
 ┌──┴──────┐
 ▼         ▼
VALID    CORRUPT
 │         │
 ▼         ▼
durable   durability
state     violation
```

Conservar bytes corruptos **no es Durability correcta**.

La relación con Recovery queda:

```text
DURABILITY
ENG-077
│
└── prevent loss of committed state
        │
        X failure outside guarantee
        │
        ▼
RECOVERABILITY
ENG-076
│
└── restore state/service
```

La relación Retention/Durability queda:

```text
DURABILITY
│
└── survive failures

RETENTION
│
└── remain intentionally stored
    for required duration

DELETION
│
└── intentionally stop retaining
    according to policy
```

La cadena reciente queda:

```text
AVAILABILITY
ENG-073
   │
   ▼
RELIABILITY
ENG-074
   │
   ▼
MAINTAINABILITY
ENG-075
   │
   ▼
RECOVERABILITY
ENG-076
   │
   ▼
DURABILITY
ENG-077
   │
   ▼
CONSISTENCY
ENG-078
```

La primera implementación deberá concentrarse en:

```text
DurabilityState
DurabilityLevel

DurabilityRequirement
DurabilityPolicy

PersistenceBoundary
DurabilityBoundary

AcknowledgementSemantics

ReplicaState
DurabilityCommitResult

DurabilityVerifier
DurabilityVerificationResult

DurabilityRuntime
DurabilityRegistry
DurabilityError
```

con:

```text
Explicit Failure Models
Committed / Durable Separation
Persistence / Durability Boundaries

Explicit ACK Semantics

Write Durability
Transaction Durability
Message Durability

WAL / Journal
Flush / fsync Awareness

Replication
Replica ACK Semantics
Failure-Domain Placement

Quorum
Sync / Async Replication

Durability Degradation
No Silent Downgrade

Data Loss Detection
Corruption Detection
Integrity Verification

Retention
Deletion
Tombstones
Compaction

Backup / Durability Separation

Security
Audit
Observability
Testing
```

antes de introducir:

```text
Adaptive Quorum
Automatic Durability Optimization
Cross-Region Durability Controller
Continuous Failure-Domain Verification
Predictive Durability Risk
AI-Assisted Durability Engineering
```

Con **ENG-077**, la serie global alcanza:

```text
EI-1505
```

---

# Referencias

## Arquitectura

- ARQ-011 — Contracts
- ARQ-014 — Framework Lifecycle
- ARQ-016 — Security

## Ingeniería

- ENG-005 — Nomenclatura
- ENG-007 — CLI
- ENG-009 — Testing
- ENG-012 — Build System
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-027 — Runtime Engineering
- ENG-030 — Persistence Engineering
- ENG-031 — Serialization Engineering
- ENG-032 — Transport Engineering
- ENG-034 — Application Engineering
- ENG-038 — Concurrency Engineering
- ENG-039 — Resilience Engineering
- ENG-041 — Messaging Engineering
- ENG-042 — Transaction Engineering
- ENG-043 — Data Access Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-053 — State Management Engineering
- ENG-054 — Resource Management Engineering
- ENG-055 — Lifecycle Management Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-068 — Environment Engineering
- ENG-070 — Performance Engineering
- ENG-071 — Capacity Engineering
- ENG-073 — Availability Engineering
- ENG-074 — Reliability Engineering
- ENG-076 — Recoverability Engineering
- ENG-078 — Consistency Engineering
```