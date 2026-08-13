---
id: ENG-084
titulo: Data Ethics Engineering
tipo: Engineering
nivel: L2
categoria: Ingeniería
subcategoria: Data Ethics Engineering
estado: Accepted
version: 1.0.0
responsable: MEF Engineering Team
ultima_revision: 2026-08-11
dependencias:
  - ENG-009
  - ENG-016
  - ENG-020
  - ENG-021
  - ENG-023
  - ENG-024
  - ENG-025
  - ENG-035
  - ENG-045
  - ENG-046
  - ENG-047
  - ENG-048
  - ENG-051
  - ENG-056
  - ENG-057
  - ENG-061
  - ENG-062
  - ENG-063
  - ENG-064
  - ENG-065
  - ENG-079
  - ENG-080
  - ENG-081
  - ENG-082
  - ENG-083
relacionados:
  - ENG-007
  - ENG-012
  - ENG-027
  - ENG-031
  - ENG-032
  - ENG-033
  - ENG-036
  - ENG-038
  - ENG-039
  - ENG-040
  - ENG-041
  - ENG-042
  - ENG-043
  - ENG-044
  - ENG-049
  - ENG-052
  - ENG-053
  - ENG-054
  - ENG-055
  - ENG-058
  - ENG-059
  - ENG-060
  - ENG-066
  - ENG-067
  - ENG-068
  - ENG-069
  - ENG-074
  - ENG-075
  - ENG-085
keywords:
  - data-ethics
  - ethics
  - responsible-data-use
  - fairness
  - non-discrimination
  - proportionality
  - human-impact
  - harm
  - benefit
  - affected-party
  - sensitive-inference
  - profiling
  - automated-decision
  - human-oversight
  - contestability
  - explainability
  - manipulation
  - dark-pattern
  - vulnerable-population
  - bias
  - ethics-assessment
  - ethics-review
  - mef
---

# ENG-084

# Data Ethics Engineering

## Estado

Accepted.

---

# 1. Propósito

Definir el modelo de **Data Ethics Engineering** de **MEF (Modular Enterprise Framework)**.

ENG-084 establece reglas para:

```text
Data Ethics

Ethical Requirement
Ethical Principle
Ethical Policy

Responsible Data Use

Ethical Purpose

Human Impact
Affected Party

Potential Harm
Potential Benefit

Ethical Risk

Fairness
Non-Discrimination

Bias
Bias Source
Bias Detection
Bias Mitigation

Proportionality
Necessity

Sensitive Inference
Profiling

Automated Decision
Decision Impact

Human Oversight
Human Review

Contestability
Appeal
Correction

Explainability
Transparency

Manipulation Risk
Behavioral Influence
Dark Pattern

Vulnerable Population

Secondary Use Ethics

Power Asymmetry

Ethical Review
Ethics Assessment
Ethics Decision

Ethics Exception

Ethics Evidence

Ethics Drift
Ethics Incident

Ethics Security
Ethics Audit
Ethics Observability
Ethics Testing
```

---

# 2. Declaración

> **MEF deberá considerar la dimensión ética de un uso de Data de manera independiente de su Security, Privacy, Governance o Compliance. Un procesamiento legal, autorizado y técnicamente correcto no deberá considerarse automáticamente responsable. Todo uso con impacto material sobre personas, grupos o comunidades deberá poder evaluarse respecto de Purpose, Necessity, Proportionality, Fairness, Human Impact, Potential Harm, Contestability y Oversight.**

Arquitectura conceptual:

```text
DATA USE
   │
   ▼
LEGAL / POLICY PERMITTED?
   │
   ▼
PRIVACY PERMITTED?
   │
   ▼
SECURE?
   │
   ▼
COMPLIANT?
   │
   ▼
ETHICALLY RESPONSIBLE?
   │
   ├── YES
   ├── YES WITH CONTROLS
   ├── REVIEW
   └── NO
```

---

# 3. Data Ethics Engineering

ENG-084 responde:

```text
Should this data use occur?

Who benefits?

Who may be harmed?

Is the purpose legitimate and proportionate?

Is all collected data actually necessary?

Could the same objective be achieved
with less intrusive processing?

Does the system affect people differently?

Could it discriminate?

Could it reinforce historic bias?

Does it infer sensitive characteristics?

Could it manipulate behavior?

Does it exploit power asymmetry?

Are vulnerable groups affected?

Is the decision explainable?

Can an affected party challenge it?

Is meaningful human oversight available?

What evidence supports the ethics decision?
```

---

# 4. Data Ethics

`Data Ethics` representa el conjunto de principios, evaluaciones y controles utilizados para determinar si el uso de Data es responsable respecto de personas, grupos, sociedad y contexto.

---

# 5. Ethics ≠ Compliance

Compliance pregunta:

```text
Are applicable obligations satisfied?
```

Ethics pregunta:

```text
Even if they are satisfied,
should this processing be performed
in this way?
```

---

# 6. Ethics ≠ Privacy

Privacy se concentra en el tratamiento de Personal Data y Privacy Rights.

Ethics puede abarcar además:

```text
non-personal data
group effects
collective harms
decision fairness
power asymmetry
manipulation
societal impact
```

---

# 7. Ethics ≠ Security

Security previene acceso, modificación o destrucción no autorizados.

Un sistema perfectamente seguro puede utilizar Data de forma injusta o desproporcionada.

---

# 8. Ethics ≠ Governance

Governance define autoridad y políticas.

Ethics evalúa si esas decisiones y usos son responsables.

---

# 9. Ethics ≠ Personal Preference

ENG-084 no deberá basarse únicamente en opiniones individuales.

Las decisiones deberán utilizar:

```text
declared principles
scope
impact analysis
evidence
stakeholder context
risk
```

---

# 10. Ethical Requirement

Representa una regla ética verificable dentro de un Scope.

Conceptualmente:

```text
EthicalRequirement
├── id
├── principle
├── scope
├── affectedParties
├── criteria
├── controls
├── evidence
├── criticality
└── owner
```

---

# 11. Ethical Principle

Representa un principio normativo utilizado para evaluar Responsible Data Use.

---

# 12. Core Ethical Principles

La primera taxonomía podrá incluir:

```text
BENEFICENCE
NON_MALEFICENCE
FAIRNESS
NON_DISCRIMINATION
AUTONOMY
TRANSPARENCY
ACCOUNTABILITY
PROPORTIONALITY
CONTESTABILITY
HUMAN_OVERSIGHT
```

---

# 13. Principle Taxonomy

Deberá ser configurable y gobernada.

---

# 14. Universal Interpretation

MEF no deberá asumir que todos los principios tienen una única interpretación universal.

---

# 15. Principle Conflict

Dos principios pueden entrar en tensión.

Ejemplo:

```text
fairness
vs
privacy minimization
```

o:

```text
transparency
vs
security confidentiality
```

---

# 16. Principle Trade-Off

Deberá documentarse.

---

# 17. Ethical Purpose

Representa el objetivo sustantivo del Processing desde la perspectiva ética.

---

# 18. Purpose Validity

Un Purpose técnicamente autorizado puede no ser éticamente aceptable.

---

# 19. Purpose Evaluation

Podrá considerar:

```text
legitimacy
necessity
proportionality
expected benefit
expected harm
alternatives
```

---

# 20. Responsible Data Use

Deberá combinar:

```text
valid purpose
minimum necessary data
proportionate processing
fair impact
human safeguards
accountability
```

---

# 21. Human Impact

Representa efecto material sobre personas o grupos.

---

# 22. Human Impact Types

Podrán incluir:

```text
financial
employment
health
education
access
reputation
autonomy
privacy
safety
opportunity
participation
```

---

# 23. Affected Party

Actor o grupo que puede experimentar impacto aunque no sea Data Subject directo.

---

# 24. Data Subject ≠ Affected Party

Ejemplo:

Data sobre un barrio puede afectar a residentes individuales aunque algunos no aparezcan en el dataset.

---

# 25. Group Harm

Deberá considerarse cuando decisiones basadas en Data afecten grupos.

---

# 26. Collective Impact

Puede existir aunque ningún individuo aislado sufra un daño claramente medible.

---

# 27. Potential Harm

Representa efecto adverso razonablemente plausible.

---

# 28. Harm Types

Podrán incluir:

```text
denial of opportunity
discrimination
exclusion
stigmatization
financial loss
privacy intrusion
manipulation
loss of autonomy
reputational harm
unsafe decision
```

---

# 29. Potential Benefit

Representa efecto favorable esperado.

---

# 30. Benefit ≠ Harm Cancellation

Un beneficio agregado no deberá justificar automáticamente daño grave a una minoría.

---

# 31. Benefit Distribution

Deberá analizarse quién recibe beneficios.

---

# 32. Harm Distribution

Deberá analizarse quién asume riesgos.

---

# 33. Unequal Burden

Puede constituir Ethical Risk incluso si el resultado agregado parece positivo.

---

# 34. Ethical Risk

Podrá modelarse como:

```text
EthicalRisk
├── source
├── affectedParties
├── harm
├── likelihood
├── severity
├── reversibility
├── controls
└── residualRisk
```

---

# 35. Risk Dimensions

Podrán incluir:

```text
severity
likelihood
scale
duration
reversibility
detectability
power imbalance
vulnerability
```

---

# 36. Reversibility

Decisiones difíciles de revertir deberán recibir mayor scrutiny.

---

# 37. Scale

Un impacto pequeño por persona puede ser relevante a gran escala.

---

# 38. Ethical Risk ≠ Privacy Risk

Podrán intersectarse, pero no son equivalentes.

---

# 39. Fairness

Representa tratamiento o distribución de efectos conforme a criterios éticos declarados.

---

# 40. Fairness ≠ Equality Automatically

Tratar a todos de forma idéntica puede producir resultados injustos en algunos Domains.

---

# 41. Fairness Definition

Deberá ser explícita por Use Case.

---

# 42. Fairness Metric

No deberá imponerse universalmente.

---

# 43. Conflicting Fairness Metrics

Podrán existir métricas matemáticamente incompatibles en algunos escenarios.

MEF deberá permitir documentar la elección.

---

# 44. Non-Discrimination

Deberá evitar trato injustificado basado en atributos protegidos o proxies relevantes conforme al Policy Model aplicable.

---

# 45. Protected Attribute

No deberá codificarse como lista universal en el Core.

---

# 46. Proxy Variable

Variable aparentemente neutral puede funcionar como proxy de un atributo sensible.

---

# 47. Proxy Detection

Deberá considerarse cuando riesgo lo justifique.

---

# 48. Disparate Impact

Podrá analizarse aunque no exista uso explícito del atributo sensible.

---

# 49. Fairness Scope

Podrá considerar:

```text
individual
group
subgroup
intersectional group
population
```

---

# 50. Intersectionality

Combinaciones de atributos pueden revelar impactos no visibles al analizar categorías por separado.

---

# 51. Bias

Representa desviación sistemática que puede afectar decisiones o resultados.

---

# 52. Bias Sources

Podrán incluir:

```text
historical bias
sampling bias
selection bias
measurement bias
label bias
annotation bias
survivorship bias
aggregation bias
automation bias
deployment bias
```

---

# 53. Data Bias

Puede originarse en Dataset.

---

# 54. Model Bias

Puede surgir del Algorithm/Model.

---

# 55. Process Bias

Puede surgir de cómo se usa una salida.

---

# 56. Human Bias

Puede afectar Labels, Reviews y Overrides.

---

# 57. Bias Detection

Deberá utilizar métricas y Context apropiados.

---

# 58. No Detected Bias ≠ No Bias

Ausencia de Evidence no demuestra neutralidad.

---

# 59. Bias Baseline

Podrá registrar comportamiento conocido.

---

# 60. Bias Drift

Puede aparecer cuando cambia:

```text
population
data source
business process
model
environment
```

---

# 61. Bias Mitigation

Podrá actuar sobre:

```text
data
features
sampling
model
thresholds
workflow
human review
```

---

# 62. Mitigation Trade-Off

Puede afectar:

```text
accuracy
privacy
utility
performance
```

y deberá documentarse.

---

# 63. Proportionality

El nivel de Processing deberá ser proporcional al Purpose y Benefit esperado.

---

# 64. Necessity

Deberá evaluarse si Processing es realmente necesario.

---

# 65. Less Intrusive Alternative

Si existe alternativa razonablemente efectiva con menor impacto, deberá considerarse.

---

# 66. Maximal Data Use

No deberá considerarse automáticamente mejor solución.

---

# 67. Intrusiveness

Podrá considerar:

```text
volume
granularity
frequency
correlation
retention
identifiability
sensitivity
```

---

# 68. Sensitive Inference

Derivación de atributos sensibles o de alto impacto a partir de otros Data.

---

# 69. Inference ≠ Collected Attribute

Aunque un atributo nunca se recolecte directamente, puede inferirse.

---

# 70. Inference Governance

Deberá declarar:

```text
purpose
necessity
risk
accuracy
impact
controls
```

---

# 71. False Sensitive Inference

Puede causar daño aun cuando sea estadísticamente razonable.

---

# 72. Profiling

Uso de Data para analizar o predecir características, comportamiento o preferencias.

---

# 73. Profiling Risk

Podrá incluir:

```text
stereotyping
exclusion
manipulation
discrimination
loss of autonomy
```

---

# 74. Profiling Transparency

Deberá ser proporcional al impacto y Privacy Requirements.

---

# 75. Automated Decision

Decisión producida total o parcialmente por Automation basada en Data.

---

# 76. Decision Scope

Podrá clasificarse:

```text
ADVISORY
ASSISTIVE
MATERIAL
HIGH_IMPACT
```

---

# 77. High-Impact Decision

Deberá recibir Controls reforzados.

---

# 78. Decision Impact Examples

Podrán incluir:

```text
employment
credit
insurance
education
healthcare
public benefits
housing
access control
disciplinary action
```

según Domain.

---

# 79. Automated ≠ Autonomous

Un sistema puede automatizar partes de una decisión sin ser completamente autónomo.

---

# 80. Automation Bias

Human Reviewer puede confiar excesivamente en salida automatizada.

---

# 81. Human Oversight

Deberá ser meaningful cuando sea requerido.

---

# 82. Meaningful Human Oversight

No deberá reducirse a:

```text
human clicks approve
```

sin capacidad real de:

```text
understand
question
override
escalate
```

---

# 83. Human Review Capacity

Debe existir tiempo, contexto y autoridad suficientes.

---

# 84. Rubber-Stamp Review

No deberá clasificarse como oversight efectivo.

---

# 85. Override

Human Reviewer podrá requerir Authority explícita para modificar decisión.

---

# 86. Override Audit

Deberá registrarse cuando sea material.

---

# 87. Override Bias

También deberá monitorearse.

---

# 88. Contestability

Affected Party deberá poder cuestionar una decisión cuando Requirement lo exija.

---

# 89. Contestability ≠ Explanation Only

Explicar una decisión sin mecanismo de revisión puede ser insuficiente.

---

# 90. Appeal

Podrá constituir mecanismo de Contestability.

---

# 91. Appeal State

Podrá incluir:

```text
RECEIVED
VALIDATING
IN_REVIEW
UPHELD
OVERTURNED
PARTIALLY_OVERTURNED
CLOSED
```

---

# 92. Correction

Deberá permitir corregir Data o assumptions incorrectos que afectaron una decisión.

---

# 93. Decision Re-execution

Podrá requerirse después de Correction.

---

# 94. Explainability

Capacidad de proporcionar razones suficientemente comprensibles para una decisión o proceso.

---

# 95. Explainability Audience

Podrá variar:

```text
affected person
operator
auditor
engineer
regulator
domain expert
```

---

# 96. One Explanation ≠ Every Audience

No deberán reutilizarse indiscriminadamente.

---

# 97. Explanation Fidelity

La explicación deberá corresponder suficientemente al mecanismo real.

---

# 98. False Explanation

Queda prohibida.

---

# 99. Explainability ≠ Full Source Disclosure

Puede equilibrarse con:

```text
security
privacy
trade secrets
abuse prevention
```

según Policy.

---

# 100. Transparency

Deberá permitir comprender:

```text
purpose
data use
decision role
limitations
oversight
contestability
```

cuando sea relevante.

---

# 101. Manipulation Risk

Uso de Data para influir comportamiento de forma que reduzca autonomía o explote vulnerabilidades.

---

# 102. Behavioral Influence

No todo influence es manipulación.

El Context deberá evaluarse.

---

# 103. Dark Pattern

Diseño que empuja o engaña al usuario hacia decisiones que quizá no tomaría con información y opciones neutrales.

---

# 104. Dark Pattern Types

Podrán incluir:

```text
obstruction
misdirection
forced action
hidden choice
asymmetric choice
confirmshaming
default manipulation
```

---

# 105. Consent Dark Pattern

Podrá ser Privacy + Ethics Violation.

---

# 106. Choice Architecture

Deberá evitar sesgos intencionales injustificados cuando afecte decisiones significativas.

---

# 107. Vulnerable Population

Grupo que puede enfrentar mayor riesgo por:

```text
age
health
economic position
dependency
limited literacy
limited digital access
power imbalance
```

según Context.

---

# 108. Vulnerability Classification

No deberá utilizarse para estigmatizar o discriminar.

---

# 109. Enhanced Safeguards

Podrán requerirse para Vulnerable Populations.

---

# 110. Power Asymmetry

Debe considerarse cuando una parte tiene capacidad significativamente mayor para imponer consecuencias.

---

# 111. Employment Context

Puede existir Power Asymmetry aunque exista formalmente Consent.

---

# 112. Consent ≠ Ethical Justification

Especialmente donde existe dependencia o coercion risk.

---

# 113. Secondary Use Ethics

Secondary Purpose podrá ser legal y privacy-compatible, pero requerir Ethics Review.

---

# 114. Function Creep

Uso de Data se expande progresivamente más allá de intención original.

---

# 115. Function Creep Detection

Deberá comparar:

```text
declared purpose
current purpose
new capabilities
new consumers
```

---

# 116. Ethics Assessment

Proceso estructurado de evaluación ética.

Conceptualmente:

```text
EthicsAssessment
├── useCase
├── purpose
├── affectedParties
├── benefits
├── harms
├── fairness
├── proportionality
├── alternatives
├── oversight
├── contestability
├── controls
├── residualRisk
└── decision
```

---

# 117. Assessment Trigger

Podrá incluir:

```text
high-impact decision
sensitive inference
profiling
new vulnerable population
secondary use
new behavioral targeting
new automated decision
new fairness risk
new large-scale correlation
```

---

# 118. Assessment Depth

Deberá ser proporcional al Risk.

---

# 119. Lightweight Review

Podrá ser suficiente para bajo impacto.

---

# 120. Full Ethics Review

Podrá requerirse para uso de alto impacto.

---

# 121. Ethics Review Board

Podrá existir como Governance Mechanism.

---

# 122. Review Board ≠ Ethics Truth

No deberá sustituir Evidence y análisis.

---

# 123. Diverse Review

Podrá mejorar detección de impactos omitidos.

---

# 124. Domain Expertise

Deberá incluirse cuando el impacto dependa de contexto especializado.

---

# 125. Affected-Party Perspective

Deberá considerarse cuando sea viable y proporcional.

---

# 126. Ethics Decision

Podrá ser:

```text
APPROVE
APPROVE_WITH_CONTROLS
REVIEW_REQUIRED
REJECT
PAUSE
```

---

# 127. APPROVE_WITH_CONTROLS

Deberá declarar Controls obligatorios.

---

# 128. PAUSE

Podrá utilizarse cuando Evidence sea insuficiente para continuar responsablemente.

---

# 129. UNKNOWN

No deberá convertirse automáticamente en APPROVE.

---

# 130. Ethics Exception

Desviación respecto de Ethical Requirement.

---

# 131. Exception Requirement

Deberá declarar:

```text
requirement
scope
reason
authority
risk
controls
expiration
```

---

# 132. Ethical Exception ≠ Ethical Approval

Deberá permanecer visible como Exception.

---

# 133. Permanent Ethics Exception

Deberá provocar revisión de Architecture o Principle.

---

# 134. Ethics Evidence

Podrá incluir:

```text
impact analysis
fairness test
bias test
stakeholder review
decision record
human oversight evidence
contestability metrics
incident history
```

---

# 135. Evidence Quality

Deberá evaluarse.

---

# 136. Ethics Evidence ≠ Survey Alone

Una única fuente cualitativa o cuantitativa no deberá considerarse universalmente suficiente.

---

# 137. Ethics Baseline

Podrá registrar:

```text
fairness metrics
harm indicators
override rates
appeal rates
decision distribution
known risks
```

---

# 138. Ethics Drift

Ocurre cuando impacto real se aleja del comportamiento aprobado.

---

# 139. Drift Examples

```text
new subgroup disparity
override rate spikes
appeals increase
new sensitive inference appears
decision population changes
```

---

# 140. Ethics Regression

Nueva Version reduce Responsible Use Posture.

---

# 141. Ethics Incident

Evento donde Data Use produce o amenaza producir impacto ético significativo.

---

# 142. Ethics Incident Examples

```text
discriminatory outcome
unfair exclusion
mass false positive
manipulative targeting
harmful sensitive inference
failed contestability
rubber-stamp oversight
```

---

# 143. Ethics Incident ≠ Security Incident Automatically

Puede no existir compromiso técnico.

---

# 144. Ethics Incident ≠ Compliance Violation Automatically

Un impacto puede ser éticamente grave incluso sin incumplimiento normativo conocido.

---

# 145. Ethics Remediation

Podrá incluir:

```text
pause processing
change data
change model
change threshold
change workflow
add human review
improve explanation
add appeal
limit population
retire use case
```

---

# 146. Harm Mitigation

Deberá priorizar affected parties, no solo reputational risk para la organización.

---

# 147. Remediation Verification

Deberá volver a evaluar impacto.

---

# 148. Ethics Gate

Podrá bloquear:

```text
new data use
model release
automated decision
profiling deployment
sensitive inference
secondary purpose
high-impact workflow
```

---

# 149. Gate Inputs

Podrán incluir:

```text
assessment
risk
fairness tests
bias tests
human oversight
contestability
evidence
open incidents
```

---

# 150. Gate Result

Podrá ser:

```text
PASS
PASS_WITH_CONTROLS
BLOCK
REVIEW_REQUIRED
```

---

# 151. Ethics Gate Override

Deberá requerir Authority reforzada y Audit.

---

# 152. Data Quality Relationship

Poor Data Quality puede causar unfair decisions.

---

# 153. Accurate Data Can Still Be Unethical

Un Dataset perfectamente accurate puede utilizarse con un Purpose irresponsable.

---

# 154. Integrity Relationship

Integrity es necesaria para decisiones correctas, pero no suficiente para Ethics.

---

# 155. Governance Relationship

Ownership y Policy permiten Accountability, pero Owner Approval no constituye Ethics Approval automáticamente.

---

# 156. Privacy Relationship

Privacy Controls reducen riesgos sobre Personal Data, pero una decisión puede seguir siendo injusta.

---

# 157. Compliance Relationship

Compliance proporciona minimum obligations, no necesariamente maximum responsibility.

---

# 158. Security Relationship

Security Failure puede producir Ethical Harm, pero Ethics no se limita a Security.

---

# 159. Multi-Tenancy Ethics

El mismo Algorithm puede producir impactos distintos por Tenant o población.

---

# 160. Tenant-Level Evaluation

Deberá existir cuando Population y Context difieran materialmente.

---

# 161. Global Metric

No deberá ocultar subgroup harm.

---

# 162. Cross-Tenant Learning

Deberá evaluar Privacy, Fairness y Governance antes de reutilizar Data entre Tenants.

---

# 163. Ethics Metadata

ENG-057 podrá representar:

```text
ethicalPurpose
impactLevel
affectedParties
fairnessRequirement
oversightRequirement
contestabilityRequirement
```

---

# 164. Ethics Context

ENG-056 podrá transportar:

```text
useCase
decisionType
affectedParty
impactLevel
purpose
tenant
```

---

# 165. Schema Ethics

Schema puede revelar Sensitive Inference Risk.

---

# 166. Transformation Ethics

ENG-063 deberá considerar si nueva Feature/Attribute aumenta capacidad de Profiling o Discrimination.

---

# 167. Pipeline Ethics

ENG-064 podrá introducir Gates para:

```text
bias
fairness
sensitive inference
```

---

# 168. Migration Ethics

Migration no deberá cambiar significado o población de forma que altere impacto sin Review.

---

# 169. API Ethics

ENG-044 deberá evitar interfaces que permitan usos altamente riesgosos sin Governance Controls.

---

# 170. API Capability Risk

Un Endpoint técnicamente genérico puede habilitar usos éticamente problemáticos.

---

# 171. Messaging Ethics

Events no deberán difundir Sensitive Inferences indiscriminadamente.

---

# 172. Observability Ethics

Monitoring de usuarios o empleados puede requerir evaluación ética aun cuando sea técnicamente seguro.

---

# 173. Employee Monitoring

Power Asymmetry deberá considerarse explícitamente.

---

# 174. Behavioral Analytics

Deberá evaluar:

```text
necessity
intrusiveness
manipulation
secondary use
```

---

# 175. Automated Enforcement

Sistemas de enforcement automático deberán soportar human review cuando impacto lo requiera.

---

# 176. Recommendation Systems

Podrán requerir análisis de:

```text
manipulation
filtering
harm amplification
vulnerable users
feedback loops
```

---

# 177. Feedback Loop

Output puede cambiar Data futuro y amplificar Bias.

---

# 178. Self-Reinforcing Bias

Deberá considerarse.

---

# 179. Historical Data

Puede reflejar decisiones injustas previas.

---

# 180. Historical Data ≠ Neutral Ground Truth

Principio obligatorio.

---

# 181. Label Quality

Labels creados por decisiones humanas históricas pueden incorporar Bias.

---

# 182. Proxy Labels

No deberán asumirse como Objective Truth.

---

# 183. Fairness and Accuracy

Maximizar Accuracy global puede perjudicar subgrupos.

---

# 184. Fairness Trade-Off

Deberá documentarse.

---

# 185. Threshold Ethics

Thresholds pueden afectar grupos de manera diferente.

---

# 186. Threshold Review

Deberá considerar Impact Distribution.

---

# 187. Human Override Metrics

Podrán indicar:

```text
automation bias
model weakness
policy mismatch
```

---

# 188. Appeal Metrics

Podrán indicar fallas de Decision Quality o Explainability.

---

# 189. False Positive Cost

Deberá analizarse por affected party.

---

# 190. False Negative Cost

También deberá analizarse.

---

# 191. Symmetric Error Cost

No deberá asumirse universalmente.

---

# 192. Ethical Accuracy

No deberá definirse únicamente como promedio estadístico.

---

# 193. Explainability Testing

Deberá comprobar que explanations sean:

```text
faithful
relevant
understandable
scope-appropriate
```

---

# 194. Contestability Testing

Deberá comprobar que una persona pueda:

```text
challenge
provide correction
receive review
obtain outcome
```

---

# 195. Human Oversight Testing

Deberá comprobar que Reviewer pueda realmente modificar decisión.

---

# 196. Bias Testing

Deberá comparar grupos relevantes cuando sea apropiado.

---

# 197. Fairness Testing

Deberá utilizar métricas compatibles con Ethical Requirement.

---

# 198. Vulnerable Population Test

Deberá comprobar impactos específicos cuando aplique.

---

# 199. Manipulation Test

Deberá evaluar interfaces y targeting.

---

# 200. Secondary Use Test

Deberá intentar reutilizar Data fuera del Ethical Purpose aprobado.

---

# 201. Sensitive Inference Test

Deberá detectar inferencias no aprobadas.

---

# 202. Feedback Loop Test

Deberá evaluar amplificación potencial.

---

# 203. Drift Test

Deberá detectar cambios de población o impacto.

---

# 204. Ethics Testing

ENG-009 gobernará Testing.

---

# 205. Architecture Test

Podrá impedir:

```text
high-impact automated decision without ethics assessment

unknown ethics state treated as approved

fairness undefined for fairness-critical use

global metric hides subgroup harm

historical data treated as neutral truth

sensitive inference without review

rubber-stamp human oversight

automated decision without contestability
when required

secondary use without ethics review

vulnerable population ignored

dark-pattern interaction

ethics exception without expiration
```

---

# 206. Build Integration

ENG-012 podrá validar:

```text
ethics metadata
assessment declarations
impact levels
fairness requirements
oversight requirements
contestability requirements
ethics gate configuration
```

---

# 207. Runtime Ethics Monitoring

Podrá observar:

```text
decision distributions
subgroup outcomes
override rates
appeal rates
harm indicators
bias drift
```

---

# 208. Ethics Observability

Podrá incluir:

```text
mef.ethics.assessment.total
mef.ethics.assessment.rejected.total

mef.ethics.fairness.violation.total
mef.ethics.bias.detected.total

mef.ethics.decision.high_impact.total

mef.ethics.override.total
mef.ethics.appeal.total
mef.ethics.appeal.overturned.total

mef.ethics.incident.total
mef.ethics.drift.total
```

---

# 209. Ethics Metric Labels

Podrán incluir:

```text
useCase
impactLevel
decisionType
result
severity
```

con Cardinality controlada.

---

# 210. Protected Attribute Labels

No deberán exponerse indiscriminadamente en Metrics.

---

# 211. Ethics Diagnostics

Deberá poder responder:

```text
what is the use case?

what is the purpose?

who is affected?

what benefits are expected?

what harms are possible?

what fairness definition applies?

what bias tests exist?

is sensitive inference involved?

is the decision automated?

what human oversight exists?

can affected parties contest it?

what ethics assessment approved it?

what risks remain?

is impact drifting?
```

---

# 212. Ethics Security

Deberán protegerse:

```text
assessment records
sensitive subgroup analyses
bias findings
appeals
ethics incidents
decision explanations
```

---

# 213. Ethics Tampering

Podrá incluir:

```text
changing fairness thresholds
suppressing subgroup results
forging human review
deleting appeals
altering assessment outcome
```

---

# 214. Separation of Duties

Podrá requerirse entre:

```text
system owner
ethics reviewer
control operator
model owner
business approver
```

---

# 215. Ethics Audit

Toda decisión material deberá ser auditada.

---

# 216. Audit Events

Podrán incluir:

```text
ethics assessment created
ethics assessment approved
ethics assessment rejected
high-impact use approved
fairness threshold changed
bias detected
human override executed
appeal resolved
ethics exception granted
ethics incident opened
ethics remediation closed
```

---

# 217. Ethics Evidence

Deberá preservar:

```text
source
scope
period
method
limitations
result
reviewer
```

---

# 218. Ethics State

Podrá incluir:

```text
APPROVED
APPROVED_WITH_CONTROLS
REVIEW_REQUIRED
PAUSED
REJECTED
EXEMPTED
UNKNOWN
```

---

# 219. APPROVED

Requirements aplicables satisfechos.

---

# 220. APPROVED_WITH_CONTROLS

Solo deberá permanecer válido mientras Controls requeridos operen.

---

# 221. REVIEW_REQUIRED

Evidence o Context requiere evaluación adicional.

---

# 222. PAUSED

Processing no deberá continuar salvo Scope permitido explícitamente.

---

# 223. REJECTED

Processing no deberá ejecutarse.

---

# 224. EXEMPTED

Existe Ethics Exception válida.

---

# 225. UNKNOWN

No existe Evidence suficiente.

---

# 226. UNKNOWN ≠ APPROVED

Principio obligatorio.

---

# 227. Ethics Snapshot

Conceptualmente:

```text
EthicsSnapshot
├── useCase
├── purpose
├── affectedParties
├── impactLevel
├── benefits
├── harms
├── fairness
├── bias
├── oversight
├── contestability
├── residualRisk
├── state
└── observedAt
```

---

# 228. Ethics Assessment Contract

Conceptualmente:

```text
EthicsAssessment
├── id
├── useCase
├── purpose
├── affectedParties
├── benefits
├── harms
├── fairness
├── proportionality
├── alternatives
├── oversight
├── contestability
├── controls
├── residualRisk
└── decision
```

---

# 229. Ethical Requirement Contract

Conceptualmente:

```text
EthicalRequirement
├── id
├── principle
├── scope
├── criteria
├── affectedParties
├── controls
├── evidence
├── criticality
└── owner
```

---

# 230. Ethical Principle Contract

Conceptualmente:

```text
EthicalPrinciple
├── id
├── definition
├── interpretation
├── scope
└── metadata
```

---

# 231. Ethical Risk Contract

Conceptualmente:

```text
EthicalRisk
├── id
├── source
├── affectedParties
├── harm
├── likelihood
├── severity
├── reversibility
├── controls
└── residualRisk
```

---

# 232. Fairness Requirement

Conceptualmente:

```text
FairnessRequirement
├── scope
├── groups
├── metric
├── threshold
├── rationale
└── owner
```

---

# 233. Bias Finding

Conceptualmente:

```text
BiasFinding
├── id
├── source
├── scope
├── affectedGroups
├── metric
├── severity
├── evidence
└── status
```

---

# 234. Human Oversight Requirement

Conceptualmente:

```text
HumanOversightRequirement
├── decisionType
├── reviewerRole
├── authority
├── requiredContext
├── overrideCapability
└── escalation
```

---

# 235. Contestability Requirement

Conceptualmente:

```text
ContestabilityRequirement
├── decisionType
├── eligibleParty
├── requestWindow
├── reviewProcess
├── correction
├── outcome
└── evidence
```

---

# 236. Ethics Decision

Conceptualmente:

```text
EthicsDecision
├── useCase
├── assessment
├── state
├── requiredControls
├── restrictions
├── reason
├── authority
└── expiresAt
```

---

# 237. Ethics Exception

Conceptualmente:

```text
EthicsException
├── requirement
├── scope
├── reason
├── authority
├── risk
├── controls
├── approvedAt
└── expiresAt
```

---

# 238. Ethics Runtime

Conceptualmente:

```text
EthicsRuntime
├── resolveRequirements
├── assessImpact
├── evaluateFairness
├── evaluateBias
├── evaluateProportionality
├── evaluateOversight
├── evaluateContestability
├── decide
├── monitor
└── diagnose
```

---

# 239. Ethics Registry

Podrá mantener:

```text
principles
requirements
use cases
assessments
risks
fairness definitions
bias findings
decisions
exceptions
incidents
```

---

# 240. CLI

ENG-007 podrá proporcionar:

```text
mef ethics
mef ethics:principles
mef ethics:requirements
mef ethics:assess
mef ethics:risks
mef ethics:fairness
mef ethics:bias
mef ethics:oversight
mef ethics:appeals
mef ethics:decisions
mef ethics:incidents
mef ethics:diagnose
```

---

# 241. `mef ethics`

Podrá mostrar Ethics Posture.

---

# 242. `ethics:principles`

Podrá mostrar Principles activos.

---

# 243. `ethics:requirements`

Podrá mostrar Requirements por Use Case.

---

# 244. `ethics:assess`

Podrá iniciar Ethics Assessment.

---

# 245. `ethics:risks`

Podrá mostrar:

```text
harm
severity
likelihood
affected parties
controls
residual risk
```

---

# 246. `ethics:fairness`

Podrá mostrar Fairness Tests.

---

# 247. `ethics:bias`

Podrá mostrar Bias Findings.

---

# 248. `ethics:oversight`

Podrá mostrar Oversight Requirements y estado.

---

# 249. `ethics:appeals`

Podrá mostrar Contestability/Appeal State.

---

# 250. `ethics:decisions`

Podrá mostrar:

```text
state
controls
restrictions
authority
expiration
```

---

# 251. `ethics:incidents`

Podrá mostrar Ethics Incidents.

---

# 252. `ethics:diagnose`

Podrá mostrar:

```text
use case
purpose
affected parties
impact
benefits
harms
fairness
bias
oversight
contestability
risk
decision
incidents
drift
```

---

# 253. First Implementation Components

La primera implementación deberá incluir:

```text
EthicsState

EthicalPrinciple
EthicalRequirement

EthicalRisk

EthicsAssessment
EthicsDecision

FairnessRequirement
BiasFinding

HumanOversightRequirement
ContestabilityRequirement

EthicsException

EthicsRuntime
EthicsRegistry

EthicsError
```

---

# 254. Optional Initial Components

Podrán incorporarse:

```text
EthicsSnapshot

EthicsGate

Appeal
EthicsIncident

EthicsBaseline
EthicsDriftDetector

EthicsDiagnostics
```

---

# 255. Later Components

Solo cuando exista necesidad demostrada:

```text
Automated Bias Discovery
Advanced Fairness Optimization
Automated Harm Prediction
Semantic Ethics Knowledge Graph
Continuous Ethics Monitoring Platform
Adaptive Ethical Controls
AI-Assisted Ethics Assessment
```

---

# 256. Estructura Conceptual

```text
src/
└── Ethics/
    ├── State/
    │   └── EthicsState
    │
    ├── Principle/
    │   └── EthicalPrinciple
    │
    ├── Requirement/
    │   └── EthicalRequirement
    │
    ├── Risk/
    │   └── EthicalRisk
    │
    ├── Assessment/
    │   └── EthicsAssessment
    │
    ├── Decision/
    │   └── EthicsDecision
    │
    ├── Fairness/
    │   └── FairnessRequirement
    │
    ├── Bias/
    │   └── BiasFinding
    │
    ├── Oversight/
    │   └── HumanOversightRequirement
    │
    ├── Contestability/
    │   ├── ContestabilityRequirement
    │   └── Appeal
    │
    ├── Exception/
    │   └── EthicsException
    │
    ├── Incident/
    │   └── EthicsIncident
    │
    ├── Baseline/
    │   └── EthicsBaseline
    │
    ├── Drift/
    │   └── EthicsDriftDetector
    │
    ├── Gate/
    │   └── EthicsGate
    │
    ├── Snapshot/
    │   └── EthicsSnapshot
    │
    ├── Runtime/
    │   └── EthicsRuntime
    │
    ├── Registry/
    │   └── EthicsRegistry
    │
    ├── Diagnostics/
    │   └── EthicsDiagnostics
    │
    └── Error/
        └── EthicsError
```

La estructura física definitiva deberá obedecer ENG-006.

---

# 257. Error Namespace

ENG-084 utilizará:

```text
MEF-ETHICS-xxx
```

---

# 258. Taxonomía de Errores

```text
MEF-ETHICS-001 Ethics requirement invalid
MEF-ETHICS-002 Ethical principle invalid
MEF-ETHICS-003 Ethics assessment missing
MEF-ETHICS-004 Ethics assessment invalid
MEF-ETHICS-005 Ethical purpose invalid
MEF-ETHICS-006 Affected party undefined
MEF-ETHICS-007 Ethical risk excessive
MEF-ETHICS-008 Proportionality violation
MEF-ETHICS-009 Necessity requirement failed

MEF-ETHICS-010 Fairness requirement missing
MEF-ETHICS-011 Fairness violation detected
MEF-ETHICS-012 Bias detected
MEF-ETHICS-013 Bias mitigation insufficient

MEF-ETHICS-014 Sensitive inference not approved
MEF-ETHICS-015 Profiling ethics violation
MEF-ETHICS-016 Automated decision ethics violation

MEF-ETHICS-017 Human oversight missing
MEF-ETHICS-018 Human oversight ineffective
MEF-ETHICS-019 Contestability missing
MEF-ETHICS-020 Appeal process failed

MEF-ETHICS-021 Explainability insufficient
MEF-ETHICS-022 Manipulation risk excessive
MEF-ETHICS-023 Dark pattern detected
MEF-ETHICS-024 Vulnerable population safeguard missing

MEF-ETHICS-025 Ethics exception invalid
MEF-ETHICS-026 Ethics exception expired
MEF-ETHICS-027 Ethics gate failed
MEF-ETHICS-028 Ethics authorization denied
MEF-ETHICS-029 Ethics state unknown
MEF-ETHICS-030 Ethics invariant violation
```

---

# 259. First Implementation Constraints

La primera implementación deberá favorecer:

```text
Explicit Ethical Principles
Explicit Ethical Requirements

Purpose
Affected Parties

Benefit / Harm Analysis

Ethical Risk

Necessity
Proportionality

Fairness
Non-Discrimination

Bias Awareness
Bias Detection

Sensitive Inference Awareness

Automated Decision Classification

Meaningful Human Oversight

Contestability

Explainability

Vulnerable Population Awareness

Ethics Assessments
Ethics Decisions
Ethics Exceptions

Security
Audit
Observability
Testing
```

---

# 260. First Version Non-Goals

No deberá requerir:

```text
Automatic Bias Removal
Automatic Fairness Optimization
Automated Ethical Decision Making
Semantic Ethics Knowledge Graph
Automatic Harm Prediction
Predictive Ethics Risk
AI-Assisted Ethics Decisions
```

---

# 261. Second Phase

Podrá incorporar:

```text
Ethics Gates
Ethics Snapshots

Bias Baselines
Ethics Drift Detection

Appeal Workflows
Ethics Incidents

Advanced Fairness Testing
Human Oversight Monitoring
```

---

# 262. Third Phase

Solo cuando exista necesidad demostrada:

```text
Automated Bias Discovery
Fairness Optimization
Automated Harm Analysis
Continuous Ethics Monitoring
Ethics Knowledge Graph
Adaptive Ethical Controls
AI-Assisted Ethics Assessment
```

---

# 263. Invariantes de Ingeniería

ENG-084 continúa la serie global `EI`.

| ID | Invariante |
|---|---|
| EI-1626 | Todo Data Use de impacto material deberá poder relacionarse con Ethical Purpose, Affected Parties, Expected Benefits, Potential Harms, Ethical Requirements, Controls y Evidence suficientes para evaluar Responsible Data Use. |
| EI-1627 | Data Ethics deberá permanecer diferenciada de Security, Privacy, Governance y Compliance y un Processing seguro, privacy-permitted, governed o compliant no deberá considerarse automáticamente éticamente responsable. |
| EI-1628 | Ethical Principles deberán poseer definición, Scope e interpretación gobernada y los conflictos entre Fairness, Privacy, Transparency, Utility u otros principios deberán documentarse en lugar de resolverse silenciosamente. |
| EI-1629 | Human Impact deberá considerar Data Subjects, Affected Parties, Groups y Collective Effects y Benefit agregado no deberá utilizarse automáticamente para justificar daño grave o desproporcionado concentrado en subgrupos. |
| EI-1630 | Necessity y Proportionality deberán evaluar si el Processing y volumen/granularidad de Data son realmente necesarios y si existe una alternativa razonablemente efectiva con menor intrusiveness o impacto. |
| EI-1631 | Fairness y Non-Discrimination deberán declararse mediante criterios apropiados al Use Case y ninguna métrica de Fairness deberá imponerse universalmente ni utilizarse sin analizar su relación con Domain Context y otras métricas potencialmente incompatibles. |
| EI-1632 | Bias deberá analizarse en Data, Sampling, Measurement, Labels, Models, Deployment, Processes y Human Review y ausencia de Bias detectado no deberá presentarse como prueba universal de neutralidad. |
| EI-1633 | Historical Data, Human Labels y Existing Decisions no deberán tratarse automáticamente como objective ground truth cuando puedan reflejar desigualdad, error o Bias histórico. |
| EI-1634 | Sensitive Inference y Profiling deberán evaluarse aunque el atributo no haya sido recolectado directamente y la precisión estadística de una inferencia no deberá considerarse por sí sola justificación ética para utilizarla. |
| EI-1635 | Automated Decisions deberán clasificarse por Impact y decisiones High-Impact deberán poseer Controls reforzados de Fairness, Explainability, Oversight, Contestability y Monitoring antes de entrar en Production. |
| EI-1636 | Human Oversight deberá ser meaningful: Reviewer deberá poseer información, tiempo, Authority, capacidad de Override y Escalation suficientes y un paso humano meramente ceremonial no deberá considerarse Control efectivo. |
| EI-1637 | Contestability deberá permitir que una Affected Party cuestione, corrija o solicite revisión de una decisión cuando el Ethical Requirement lo exija y Explanation sin mecanismo de revisión no deberá considerarse Contestability suficiente. |
| EI-1638 | Explainability deberá ser suficientemente faithful al proceso real y adaptada a su Audience; explicaciones fabricadas, simplificaciones engañosas o narrativas no relacionadas con la decisión efectiva quedan prohibidas. |
| EI-1639 | Manipulation Risk, Dark Patterns, Behavioral Influence, Power Asymmetry y Vulnerable Populations deberán evaluarse cuando el Use Case pueda afectar autonomía o capacidad de decisión y Consent no deberá utilizarse como justificación ética automática en contextos de coerción o dependencia. |
| EI-1640 | Secondary Uses y Function Creep deberán provocar Ethics Review cuando alteren Purpose, Population, Impact, Sensitive Inference, Profiling o Decision Power respecto de la evaluación previamente aprobada. |
| EI-1641 | Ethics Assessments deberán documentar Use Case, Purpose, Affected Parties, Benefits, Harms, Fairness, Proportionality, Alternatives, Oversight, Contestability, Controls y Residual Risk y `UNKNOWN` no deberá convertirse automáticamente en aprobación. |
| EI-1642 | Ethics Exceptions deberán declarar Requirement, Scope, Reason, Authority, Risk, Controls y Expiration y ninguna Exception válida deberá ocultarse como aprobación ética ordinaria ni convertirse silenciosamente en práctica permanente. |
| EI-1643 | Ethics Drift y Incidents deberán detectar cambios de Population, Decision Distribution, Subgroup Impact, Override Rates, Appeals, Sensitive Inferences, Harm Indicators y Feedback Loops que puedan alterar Responsible Use Posture después de Deployment. |
| EI-1644 | Ethics Security, Audit y Observability deberán proteger Assessments, Fairness Thresholds, Bias Findings, Appeals, Oversight Evidence y Incident Records y deberán impedir manipulación destinada a ocultar Harm, Disparity o fallas de Control. |
| EI-1645 | La primera implementación deberá priorizar Ethical Principles, Requirements, Purpose, Affected Parties, Benefit/Harm Analysis, Ethical Risk, Necessity, Proportionality, Fairness, Bias, Sensitive Inference, Human Oversight, Contestability, Explainability y Ethics Assessments antes de introducir Automated Ethical Decisions, Fairness Optimization o AI-Assisted Ethics Engineering. |

---

# 264. Continuidad de Invariantes

```text
ENG-080 → EI-1546 a EI-1565
ENG-081 → EI-1566 a EI-1585
ENG-082 → EI-1586 a EI-1605
ENG-083 → EI-1606 a EI-1625
ENG-084 → EI-1626 a EI-1645
```

---

# 265. Criterios de Conformidad

Una implementación será conforme con ENG-084 cuando:

- defina Ethical Principles;
- defina Ethical Requirements;
- identifique Ethical Purpose;
- identifique Affected Parties;
- analice Potential Benefits;
- analice Potential Harms;
- modele Ethical Risk;
- evalúe Necessity;
- evalúe Proportionality;
- defina Fairness Requirement cuando aplique;
- no imponga una Fairness Metric universal;
- analice Bias Sources;
- detecte Bias cuando corresponda;
- considere Historical Bias;
- evalúe Sensitive Inference;
- evalúe Profiling;
- clasifique Automated Decisions;
- identifique High-Impact Decisions;
- implemente Meaningful Human Oversight;
- soporte Override;
- soporte Contestability;
- soporte Appeals cuando corresponda;
- implemente Explainability apropiada;
- evalúe Manipulation Risk;
- detecte Dark Patterns;
- considere Vulnerable Populations;
- evalúe Power Asymmetry;
- controle Secondary Uses;
- detecte Function Creep;
- ejecute Ethics Assessments;
- implemente Ethics Decisions;
- controle Exceptions;
- detecte Ethics Drift;
- gestione Ethics Incidents;
- aplique Security;
- implemente Audit;
- implemente Observability;
- implemente Ethics Testing.

---

# 266. Riesgos

Deberán evitarse especialmente:

```text
Legal Equals Ethical
Compliant Equals Ethical
Secure Equals Ethical

Consent Equals Ethical Justification

Accuracy Equals Fairness
Global Accuracy Hides Group Harm

Historical Data Equals Ground Truth

One Fairness Metric for Everything

No Detected Bias Equals No Bias

Sensitive Inference Without Review

High-Impact Automation Without Oversight

Human Click Equals Human Oversight

Explanation Without Contestability

Synthetic Explanation
False Explanation

Dark Patterns

Power Asymmetry Ignored

Vulnerable Population Ignored

Secondary Use Without Ethics Review
Function Creep

Aggregate Benefit Hides Concentrated Harm

Ethics Review Without Evidence

Unknown Equals Approved

Permanent Ethics Exception

Global Metrics Hide Subgroup Harm
```

---

# 267. Relación con ENG-080

```text
DATA QUALITY
ENG-080
│
└── Is the data fit for purpose?

DATA ETHICS
ENG-084
│
└── Is using that data for
    that purpose responsible?
```

Data puede ser:

```text
high quality
```

y aun utilizarse irresponsablemente.

---

# 268. Relación con ENG-081

Governance proporciona:

```text
ownership
purpose
policy
classification
accountability
```

Ethics utiliza ese marco para revisar Responsible Use.

---

# 269. Relación con ENG-082

Privacy protege Personal Data y Rights.

Ethics amplía análisis hacia:

```text
fairness
human impact
group harm
manipulation
power
contestability
```

---

# 270. Relación con ENG-083

La frontera fundamental queda:

```text
COMPLIANCE
ENG-083
│
└── Are the obligations satisfied?

ETHICS
ENG-084
│
└── Should the processing occur
    in this manner even when
    obligations are satisfied?
```

---

# 271. Relación con ENG-085

El siguiente documento deberá formalizar **Data Trust Engineering**.

La frontera propuesta será:

```text
DATA QUALITY
ENG-080
→ Is data fit for purpose?

DATA GOVERNANCE
ENG-081
→ Is authority and lifecycle governed?

DATA PRIVACY
ENG-082
→ Is personal-data processing permitted?

DATA COMPLIANCE
ENG-083
→ Are obligations demonstrably satisfied?

DATA ETHICS
ENG-084
→ Is the use responsible?

DATA TRUST
ENG-085
→ What evidence allows a Consumer,
  System or Operator to decide
  whether a Data Asset, Source,
  Producer or Data Product is
  sufficiently trustworthy for use?
```

ENG-085 deberá cubrir:

```text
Data Trust

Trust Requirement
Trust Policy

Trust Subject
Trust Object

Trustworthiness

Trust Evidence

Trust Source

Trust Score
Trust Level

Confidence

Data Source Trust
Producer Trust
Data Product Trust

Provenance Trust
Lineage Trust

Quality Trust
Integrity Trust

Freshness Trust

Authority Trust

Verification Trust

Attestation Trust

Reputation

Trust Boundary

Trust Establishment
Trust Evaluation

Trust Decay

Trust Revocation

Trust Propagation

Transitive Trust

Trust Decision

Trust Gate

Trust Drift

Trust Security
Trust Audit
Trust Observability
Trust Testing
```

---

# 272. Principio Rector

> **MEF deberá tratar Responsible Data Use como una decisión independiente de la mera posibilidad técnica o jurídica de procesar Data. Cuando un uso pueda afectar materialmente a personas o grupos, deberá poder explicarse quién se beneficia, quién asume el riesgo, qué alternativas existen, cómo se evita discriminación o manipulación, quién puede cuestionar la decisión y qué Controls protegen a los afectados.**

---

# 273. Conclusión

**ENG-084 — Data Ethics Engineering** añade a MEF una capa distinta de:

```text
LEGALITY
SECURITY
PRIVACY
COMPLIANCE
```

La pregunta deja de ser únicamente:

```text
Can we do it?
```

o:

```text
Are we allowed to do it?
```

y pasa a incluir:

```text
Should we do it this way?
```

La cadena queda:

```text
DATA USE
   │
   ▼
GOVERNED?
   │
   ▼
PRIVACY-PERMITTED?
   │
   ▼
COMPLIANT?
   │
   ▼
ETHICS ASSESSMENT
   │
   ├── Benefit
   ├── Harm
   ├── Necessity
   ├── Proportionality
   ├── Fairness
   ├── Bias
   ├── Oversight
   └── Contestability
   │
   ▼
ETHICS DECISION
```

La distinción queda:

```text
COMPLIANCE
    ✓

PRIVACY
    ✓

SECURITY
    ✓

ETHICS
    ✗
```

como un resultado arquitectónicamente válido.

Ejemplo:

```text
Accurate customer behavior data
            │
            ▼
fully authorized collection
            │
            ▼
secure storage
            │
            ▼
compliant processing
            │
            ▼
used to exploit a vulnerable
population's behavioral weakness
            │
            ▼
ETHICS REVIEW
            │
            ▼
REJECT
```

La cadena reciente queda:

```text
ENG-079  Data Integrity
    │
ENG-080  Data Quality
    │
ENG-081  Data Governance
    │
ENG-082  Data Privacy
    │
ENG-083  Data Compliance
    │
ENG-084  Data Ethics
    │
ENG-085  Data Trust
```

La primera implementación deberá concentrarse en:

```text
EthicsState

EthicalPrinciple
EthicalRequirement
EthicalRisk

EthicsAssessment
EthicsDecision

FairnessRequirement
BiasFinding

HumanOversightRequirement
ContestabilityRequirement

EthicsException

EthicsRuntime
EthicsRegistry
EthicsError
```

con:

```text
Purpose
Affected Parties
Benefit / Harm

Necessity
Proportionality

Fairness
Non-Discrimination

Bias Awareness
Historical Bias

Sensitive Inference
Profiling

Automated Decision Impact

Meaningful Human Oversight

Contestability
Appeal

Explainability

Manipulation Risk
Dark Patterns

Vulnerable Populations
Power Asymmetry

Secondary Use
Function Creep

Ethics Assessment
Ethics Decision

Drift
Incidents

Security
Audit
Observability
Testing
```

antes de introducir:

```text
Automatic Bias Removal
Automatic Fairness Optimization
Automated Harm Prediction
Semantic Ethics Knowledge Graph
Continuous Automated Ethics Decisions
Predictive Ethics Risk
AI-Assisted Ethics Assessment
```

Con **ENG-084**, la serie global alcanza:

```text
EI-1645
```

---

# Referencias

## Ingeniería

- ENG-009 — Testing
- ENG-012 — Build System
- ENG-016 — Compatibility
- ENG-020 — Registry Engineering
- ENG-021 — Contracts Engineering
- ENG-023 — Error Handling
- ENG-024 — Security Engineering
- ENG-025 — Observability Engineering
- ENG-035 — Domain Engineering
- ENG-045 — Authentication Engineering
- ENG-046 — Authorization Engineering
- ENG-047 — Identity & Access Management Engineering
- ENG-048 — Multi-Tenancy Engineering
- ENG-051 — Policy Engineering
- ENG-056 — Context Management Engineering
- ENG-057 — Metadata Engineering
- ENG-061 — Interoperability Engineering
- ENG-062 — Schema Engineering
- ENG-063 — Data Transformation Engineering
- ENG-064 — Data Pipeline Engineering
- ENG-065 — Migration Engineering
- ENG-079 — Data Integrity Engineering
- ENG-080 — Data Quality Engineering
- ENG-081 — Data Governance Engineering
- ENG-082 — Data Privacy Engineering
- ENG-083 — Data Compliance Engineering
- ENG-085 — Data Trust Engineering
```