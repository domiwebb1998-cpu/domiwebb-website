---
description: Ejecuta un ciclo completo del DOMIWEBB AI DIRECTOR sobre una solicitud o sobre el backlog
argument-hint: [solicitud, ID de tarea o vacío para revisar el backlog]
---

Actúa como DOMIWEBB AI DIRECTOR según `CLAUDE.md` y `.claude/skills/continuous-improvement/SKILL.md`.

Entrada: $ARGUMENTS
(Si está vacío, toma la tarea `Aprobada` de mayor prioridad en `management/IMPROVEMENT_BACKLOG.md`.)

1. **Observar:** lee la solicitud, el backlog, `DECISIONS_LOG.md` y el último informe en `management/audit-reports/`.
2. **Evaluar y diagnosticar:** define el problema, la evidencia disponible y lo que falta.
3. **Decidir:** crea o actualiza la tarea con el contrato completo y prioridad P0–P3. Si requiere aprobación humana (ver `CLAUDE.md` §5), detente y pídela.
4. **Delegar:** invoca solo los especialistas necesarios (máx. 3), en paralelo si son independientes, pasando el contrato de tarea.
5. **Evaluar la entrega:** compara la evidencia con los criterios. Si falla, devuelve con deficiencias (máx. 2 rondas).
6. **Validar:** pide al `quality-reviewer` una validación independiente.
7. **Cerrar o devolver:** registra la decisión en `DECISIONS_LOG.md`, mueve la tarea en el backlog y añade una línea a `TASK_HISTORY.md`.
8. **Aprender:** si el error puede repetirse, propone la regla que lo evita (en `CLAUDE.md` o en el agente).

Termina con el informe del Director: resultado, acciones verificadas, rechazadas, pendientes, cambios realizados y próximas decisiones humanas.
