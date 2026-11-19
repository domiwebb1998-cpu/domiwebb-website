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
npx skills add coreyhaines31/marketingskills -a claude-code --skill product-marketing customer-research competitor-profiling marketing-plan offers pricing prospecting site-architecture copywriting cro content-strategy analytics social
```

## Revisión de seguridad
- **claude-seo:** instala un hook `PostToolUse` (Edit/Write) que ejecuta `hooks/validate-schema.py` sobre archivos HTML para validar JSON-LD. Revisado: solo usa `json`, `os`, `re`, `sys`; no hace llamadas de red. Desde v2.6.x el hook se lanza con `hooks/run-python-hook.js` (Node), que solo localiza Python y ejecuta el script, sin red (revisado el 2026-11-18). Requiere Python 3 y Node. Las extensiones que trae la v2.6.x (`seo-shopify`, `seo-posthog`, `seo-bing`) no están aprobadas. Las extensiones (DataForSEO, Firecrawl, Ahrefs, SE Ranking, Profound, etc.) **no** se instalan.
- **marketing-skills:** solo instrucciones Markdown. `tools/REGISTRY.md` incluye "Verified Partners" patrocinadores; no se siguen sin evaluación del Director.
- Al actualizar: revisar `CHANGELOG.md` / `VERSIONS.md` por renombres (en v2.0 `page-cro` pasó a `cro` y `analytics-tracking` a `analytics`).

## Escaneo de seguridad antes de instalar o actualizar (D-029)
Antes de aprobar una skill, plugin o MCP externo, o una versión nueva de los de arriba, `quality-reviewer` corre [NVIDIA SkillSpector](https://github.com/NVIDIA/SkillSpector) (Apache-2.0) en modo estático, sin IA externa y aislado (Docker, GitHub Actions o una sesión efímera en la nube; nunca el computador de la dirección):
```
docker build -t skillspector https://github.com/NVIDIA/SkillSpector.git
docker run --rm -v "$PWD:/scan" skillspector scan ./<carpeta-de-la-skill>/ --recursive --no-llm --format json --output informe.json
```
Luego lee cada hallazgo ALTO o CRÍTICO en el código. No se ejecutan scripts ni hooks de la skill revisada. Resultado por versión:

| Plugin | Versión | Fecha | Veredicto |
|---|---|---|---|
| claude-seo | v2.6.2 (`468ed5b`) | 2026-11-18 | **PRECAUCIÓN** — puntaje 100/CRÍTICO, 631 hallazgos (4 críticos, 256 altos; cobertura 96,7 %). Revisados a mano los 4 críticos y todos los altos de `hooks/`, `skills/`, `scripts/` y `agents/`: los críticos son claves de API enviadas a su propio servicio en `extensions/banana` (Gemini) y `scripts/dataforseo_merchant.py` (DataForSEO), ambos NO aprobados; el resto es comportamiento documentado (lectura de credenciales de solo lectura en `seo-google`, lista de bloqueo anti-SSRF en `url_safety.py`, comentarios HTML de plantilla). Sin conducta oculta en el hook. Condición: no instalar extensiones ni configurar claves de DataForSEO/Gemini/Bing; `seo-google` solo con cuenta de servicio de lectura. Los 336 medios no se revisaron uno a uno |
| marketing-skills | 2.14.13 (`73573e9`) | 2026-11-18 | **APROBAR** para las 13 skills seleccionadas — puntaje 100/CRÍTICO por el repositorio completo, 1.000 hallazgos (6 críticos, 90 altos; cobertura 82,2 %). Los 6 críticos son la palabra "arsenic" en un ejemplo publicitario de `ad-creative` (no instalada): falso positivo. Los 4 altos en skills usadas (`content-strategy`, `marketing-plan`, `prospecting`) son texto de referencia sin instrucciones ocultas. `tools/` y `partners.json` (33 altos) no se instalan |
| Lemo-Opuscar (lemomo-ai/lemo-opuscar) | 2.0.0 (`00a7f9e`) | 2026-11-18 | **PRECAUCIÓN** — escaneado el código que se ejecuta (`plugin/`, `core/`, `tools/`, guías y un estilo): 37 hallazgos, 3 altos, los 3 falsas alarmas (`rm -rf` de su propio entorno roto en `setup.sh` y un texto de `release.py`). Descarga modelos y bibliotecas de GitHub, PyPI y Hugging Face. Condición: solo en una sesión aislada de la nube, nunca en el computador del dueño, sin actualización automática y solo para piezas especiales (no en la rutina de Producción). Licencia: código MIT; guías CC BY-NC con permiso para hacer videos propios, también comerciales; meterlas en un servicio automático requiere licencia comercial |
| Ponytail (DietrichGebert/ponytail) | `96608e0` | 2026-11-18 | **Solo las reglas** — puntaje 100/CRÍTICO, 140 hallazgos (1 crítico, 36 altos), revisados los de lo que se ejecuta: el crítico y casi todos los altos están en `benchmarks/` y `tests/`; el resto son documentación o una expresión regular. No se instala el plugin (sus hooks y la "banda" escriben en `~/.claude`): sus reglas se copiaron adaptadas a `web-developer.md` (MIT) |
| Agent Reach (Panniantong/Agent-Reach) | — | 2026-11-18 | **RECHAZAR** — para Instagram, Facebook, LinkedIn y X copia la sesión del navegador y raspa las redes: viola sus términos y arriesga el bloqueo de cuentas. Lo demás (web, YouTube, GitHub) ya está cubierto |

## Credenciales (fase 5)
`seo-google` necesita una cuenta de servicio de Google con acceso de **solo lectura** a Search Console y GA4. El archivo JSON vive fuera del repositorio y se referencia por variable de entorno. Nunca se versiona.
