# CRM de Domiwebb

Actualizado: 2026-11-18 (DW-019). Ningún dato de clientes se guarda en este repositorio.

## Dónde vive cada cosa
| Etapa | Herramienta | Quién la usa |
|---|---|---|
| Prospectos y leads (antes de comprar) | **Pipeline comercial** (artefacto de Claude con base de datos propia, colección `leads`): Nuevo → Contactado → Conversación → Seguimiento → Cerrado / Descartado | Dirección; agentes automáticos 09 Director comercial y 10 Prospección; `sales-manager` |
| Clientes (después de "Cerrado") | Notion › DOMIWEBB CONTENT OS › **14 · CLIENTES Y ENTREGAS** | `sales-manager`, `operations-finance`, `analytics-specialist` (lectura) |
| Oferta y precios que leen los agentes | Notion › **13 · OFERTA Y PRECIOS** (espejo de `CATALOGO_OFERTA.md`) | Todos |

Decisión (D-026): no se duplica el pipeline de prospectos en Notion; ya tiene 84 leads y agentes automáticos que lo usan. Notion se usa solo para lo que faltaba: la vida del cliente después de la venta.

## 14 · CLIENTES Y ENTREGAS (creada 2026-11-18)
Negocio, Cliente ID (DW-CLI-n), Estado (Cerrado - esperando insumos → En construcción → En revisión del cliente → Publicado - activo / En mora / Cancelado), Plan, Nicho, Ciudad, Origen, Fecha de cierre, Fecha límite de entrega, Fecha de publicación, Insumos completos, Pago inicial COP, Mensualidad COP, Día de cobro, Último pago, Dominio, Vence dominio, Vence hosting, Autorización datos Ley 1581, Upsell detectado, Próximo paso, Notas.

## Regla de paso
Cuando un lead pasa a "Cerrado" en el Pipeline, se crea su ficha en 14 · CLIENTES Y ENTREGAS con fecha de cierre y fecha límite (cierre + 72 h desde insumos completos).
El 09 Director comercial crea esa ficha automáticamente cada mañana para los leads marcados "cerrado" (D-033; ver `docs/operations/SISTEMA_AGENTES.md`).
