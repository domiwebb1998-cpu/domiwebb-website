---
name: continuous-improvement
description: Método del DOMIWEBB AI DIRECTOR para el ciclo de mejora continua, contratos de tarea, priorización, aceptación y registro. Úsala al crear, priorizar, delegar, aceptar o cerrar tareas del backlog de Domiwebb.
---

# Mejora continua de Domiwebb

## Ciclo
OBSERVAR → EVALUAR → DIAGNOSTICAR → DECIDIR → DELEGAR → EJECUTAR → VALIDAR → APRENDER.

## Plantilla de tarea
Copia en `management/IMPROVEMENT_BACKLOG.md`:

```
### DW-### — <título>
- Objetivo:
- Problema u oportunidad:
- Responsable:
- Prioridad: P0 | P1 | P2 | P3
- Fecha de creación: AAAA-MM-DD
- Alcance:
- Evidencia inicial:
- Resultado esperado:
- Criterios de aceptación:
  - [ ] ...
- Dependencias / aprobación humana:
- Estado: Propuesta
- Evidencia final:
- Responsable de validación: quality-reviewer
- Decisión del Director:
```

## Priorización
Puntúa 1–3 en impacto comercial, visibilidad, técnico, urgencia y riesgo; resta esfuerzo (1–3); anota dependencias. P0 solo para seguridad, caída o daño importante.

## Aceptación
1. ¿Hay evidencia para cada criterio? Si no, rechazar.
2. ¿La validó alguien distinto del ejecutor? Si no, enviar a `quality-reviewer`.
3. ¿Introduce regresiones o afirmaciones sin fuente? Si sí, rechazar.
4. Máximo 2 rondas; a la tercera, escalar a la dirección humana.

## Registro
- `DECISIONS_LOG.md`: fecha, decisión, motivo, alternativas descartadas, quién aprobó.
- `TASK_HISTORY.md`: una línea por tarea cerrada o rechazada.
- `METRICS.md`: actualizar indicadores y desempeño del Director.

## Aprendizaje
Si un error ocurrió dos veces, crea una regla concreta en `CLAUDE.md` o en el agente afectado y regístrala en `DECISIONS_LOG.md`.
