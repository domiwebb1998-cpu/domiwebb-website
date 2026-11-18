# Modelo operativo

Aprobado por la dirección el 2026-11-18 (ver `management/DECISIONS_LOG.md`, D-001).

## Organización
Director (sesión principal de Claude Code, definido en `CLAUDE.md`) + 11 subagentes en `.claude/agents/`, con alcance sobre todo el negocio (ampliado el 2026-11-18, D-021). Los especialistas no se invocan entre sí. Calidad valida y nunca ejecuta.

Abreviaturas: Mkt = marketing-specialist, Intel = market-researcher, SEO = seo-specialist, Cont = content-strategist, Conv = conversion-specialist, Ventas = sales-manager, Web = web-developer, Cons = business-consultant, OpFin = operations-finance, Anal = analytics-specialist, Cal = quality-reviewer.

## Matriz de permisos
Leyenda: Sí = sin autorización adicional · Rama = solo en rama de trabajo · Borrador = redacta, no envía ni publica · Propone = documenta para decisión · Humano = requiere aprobación humana · No = nunca.

| Acción | Director | Mkt | Intel | SEO | Cont | Conv | Ventas | Web | Cons | OpFin | Anal | Cal |
|---|---|---|---|---|---|---|---|---|---|---|---|---|
| Leer repo, sitio público, investigar en la web | Sí | Sí | Sí | Sí | Sí | Sí | No web | Sí | Sí | No web | No web | Sí |
| Escribir en `docs/` y `management/` | Sí | Rama | Rama | Rama | Rama | Rama | Rama | Rama | Rama | Rama | Rama | No |
| Modificar código (Domiwebb o clientes) | No | No | No | Propone | Propone | Propone | No | Rama | Propone | No | Propone | No |
| Pruebas y auditorías locales | Sí | No | No | Sí | No | Sí | No | Sí | No | No | Sí | Sí |
| Crear rama y abrir PR | Sí | No | No | No | No | No | No | Sí | No | No | No | No |
| CRM en Notion: leer | Sí | No | No | No | No | No | Sí | No | No | Sí | Sí | No |
| CRM en Notion: crear y actualizar fichas | Sí | No | No | No | No | No | Sí | No | No | Sí | No | No |
| Gmail: leer y crear borradores | Sí | No | No | No | No | No | Sí | No | No | Sí | No | No |
| Enviar correos, WhatsApp o mensajes | Humano | No | No | No | No | No | Borrador | No | No | Borrador | No | No |
| Calendar: ver y sugerir horarios / crear eventos con invitados | Sí / Humano | No | No | No | No | No | Sí / No | No | No | Sí / No | No | No |
| Drive: leer y crear documentos / compartir | Sí / Humano | No | No | No | No | No | Sí / No | No | Sí / No | Sí / No | No | No |
| Metricool: leer analítica | Sí | No | No | No | Sí | No | No | No | No | No | Sí | No |
| Metricool: crear publicación para revisión / publicar | Sí / Humano | No | No | No | Sí / No | No | No | No | No | No | No | No |
| Hostinger: consultar / cambiar | Sí / Humano | No | No | No | No | No | No | No / Propone | No | No / Propone | No | No |
| Aprobar y cerrar tarea | Sí | No | No | No | No | No | No | No | No | No | No | Valida |
| Fusionar a `main` / publicar sitios | Humano | No | No | No | No | No | No | No | No | No | No | No |
| Precios, condiciones, descuentos | Humano | Propone | No | No | No | No | Borrador | No | No | No | No | No |
| Cobros, pagos, renovaciones, gastos | Humano | No | No | No | No | No | No | No | No | Propone | No | No |
| Entregables legales o tributarios a clientes | Humano | No | No | No | No | No | No | No | Borrador | No | No | Revisa |
| Borrar archivos o datos | Humano | No | No | No | No | No | No | No | No | No | No | No |
| Comandos destructivos | No | No | No | No | No | No | No | No | No | No | No | No |

La parte técnica se refuerza con `.claude/settings.json` (deny/ask, incluidas las acciones de envío, publicación y borrado de los conectores) y con la lista `tools` de cada agente. Los nombres de las herramientas de los conectores pueden variar según dónde se ejecute Claude Code (ver DW-025).

## Cadencias
- Por tarea: contrato completo, evidencia, validación independiente.
- Semanal: `/revision-semanal` (ventas, entregas, redes, sitio, finanzas, backlog); informe corto en `management/audit-reports/`.
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
