# Modelo operativo

Aprobado por la dirección el 2026-11-18 (ver `management/DECISIONS_LOG.md`, D-001).

## Organización
Director (sesión principal de Claude Code, definido en `CLAUDE.md`) + 8 subagentes en `.claude/agents/`. Los especialistas no se invocan entre sí. Quality & Security valida y nunca ejecuta.

## Matriz de permisos
Leyenda: Sí = sin autorización adicional · Rama = solo en rama de trabajo · Propone = redacta, no ejecuta · Humano = requiere aprobación humana · No = nunca.

| Acción | Director | SEO | Marketing | Web Dev | Content | Conversion | Market Intel | Analytics | Quality |
|---|---|---|---|---|---|---|---|---|---|
| Leer repo y sitio público | Sí | Sí | Sí | Sí | Sí | Sí | Sí | Sí | Sí |
| Investigar en la web | Sí | Sí | Sí | Sí | Sí | Sí | Sí | Sí | Sí |
| Escribir en `docs/` y `management/` | Sí | Rama | Rama | Rama | Rama | Rama | Rama | Rama | Rama |
| Modificar código del sitio | No | Propone | No | Rama | Propone | Propone | No | Propone | No |
| Pruebas y auditorías locales | Sí | Sí | No | Sí | No | Sí | No | Sí | Sí |
| Crear rama y abrir PR | Sí | No | No | Sí | No | No | No | No | No |
| Aprobar y cerrar tarea | Sí | No | No | No | No | No | No | No | Valida |
| Fusionar a `main` / publicar en producción | Humano | No | No | No | No | No | No | No | No |
| Leer GA4 / Search Console | Sí | Sí | No | No | No | Sí | No | Sí | No |
| Cambiar configuración GA4/GSC | Humano | No | No | No | No | No | No | Propone | No |
| Publicar contenido o redes | Humano | No | No | No | Propone | No | No | No | No |
| Precios o condiciones | Humano | No | Propone | No | No | No | No | No | No |
| DNS, hosting, credenciales, gastos | Humano | No | No | Propone | No | No | No | No | No |
| Borrar archivos o datos | Humano | No | No | No | No | No | No | No | No |
| Comandos destructivos | No | No | No | No | No | No | No | No | No |

La parte técnica se refuerza con `.claude/settings.json` (deny/ask) y con la lista `tools` de cada agente.

## Cadencias
- Por tarea: contrato completo, evidencia, validación independiente.
- Semanal: revisión de backlog, bloqueos y métricas; informe corto en `management/audit-reports/`.
- Mensual: `/auditoria` y comparación con el mes anterior.
- Trimestral: revisión del ecosistema (agentes y skills usados, no usados, sobrantes).

## Informes del Director
Cada auditoría produce:
1. **Informe ejecutivo:** estado general, hallazgos críticos, oportunidades, riesgos, decisiones prioritarias.
2. **Evaluación de agentes:** agente, objetivo, trabajo, evidencia, evaluación, deficiencias, acciones correctivas.
3. **Backlog:** ID, acción, prioridad, responsable, dependencias, estado, criterios de aceptación.
4. **Resultado:** ejecutadas, verificadas, rechazadas, pendientes, cambios realizados, próximas decisiones.

## Claude Projects y Claude Code
No comparten memoria ni conversaciones. Comparten este repositorio. Claude Projects produce decisiones y planes; Claude Code los ejecuta y devuelve evidencia en estos archivos.
