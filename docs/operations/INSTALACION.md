# Instalación de skills externas

Revisado el 2026-11-18. No se instalan automáticamente: cada persona que trabaje en el repo las instala en su Claude Code.

## Versiones revisadas
| Plugin | Repositorio | Versión | Commit revisado |
|---|---|---|---|
| claude-seo | https://github.com/AgriciDaniel/claude-seo | v2.6.2 | 468ed5b0d9e3249394783710e54abb02837e326b |
| marketing-skills | https://github.com/coreyhaines31/marketingskills | 2.14.13 | 73573e94a06a39965978b3fa1f9c1eace8cebc7c |

## Comandos (dentro de Claude Code)
```
/plugin marketplace add AgriciDaniel/claude-seo
/plugin install claude-seo@agricidaniel-claude-seo

/plugin marketplace add coreyhaines31/marketingskills
/plugin install marketing-skills@marketingskills
```

Alternativa para instalar solo las skills de marketing seleccionadas:
```
npx skills add coreyhaines31/marketingskills -a claude-code --skill product-marketing customer-research competitor-profiling marketing-plan offers pricing prospecting site-architecture copywriting cro content-strategy analytics sms social
```

## Revisión de seguridad
- **claude-seo:** instala un hook `PostToolUse` (Edit/Write) que ejecuta `hooks/validate-schema.py` sobre archivos HTML para validar JSON-LD. Revisado: solo usa `json`, `os`, `re`, `sys`; no hace llamadas de red. Requiere Python 3. Las extensiones (DataForSEO, Firecrawl, Ahrefs, SE Ranking, Profound, etc.) **no** se instalan.
- **marketing-skills:** solo instrucciones Markdown. `tools/REGISTRY.md` incluye "Verified Partners" patrocinadores; no se siguen sin evaluación del Director.
- Al actualizar: revisar `CHANGELOG.md` / `VERSIONS.md` por renombres (en v2.0 `page-cro` pasó a `cro` y `analytics-tracking` a `analytics`).

## Credenciales (fase 5)
`seo-google` necesita una cuenta de servicio de Google con acceso de **solo lectura** a Search Console y GA4. El archivo JSON vive fuera del repositorio y se referencia por variable de entorno. Nunca se versiona.
