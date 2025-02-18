<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* olivero:teaser */
class __TwigTemplate_a55e9422d79fa634781a59dd9ba7abcf extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'prefix' => [$this, 'block_prefix'],
            'meta' => [$this, 'block_meta'],
            'image' => [$this, 'block_image'],
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension(SandboxExtension::class);
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        yield "<!-- 🥛 Component start: olivero:teaser -->";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("core/components.olivero--teaser"));
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\ComponentsTwigExtension']->addAdditionalContext($context, "olivero:teaser"));
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\Core\Template\ComponentsTwigExtension']->validateProps($context, "olivero:teaser"));
        yield "<article";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["teaser"], "method", false, false, true, 1), 1, $this->source), "html", null, true);
        yield ">
  <header>
    ";
        // line 3
        yield from $this->unwrap()->yieldBlock('prefix', $context, $blocks);
        // line 4
        yield "    <div class=\"teaser__meta\">
      ";
        // line 5
        yield from $this->unwrap()->yieldBlock('meta', $context, $blocks);
        // line 6
        yield "    </div>
    <div class=\"teaser__top\">
      <div class=\"teaser__image\">";
        // line 8
        yield from $this->unwrap()->yieldBlock('image', $context, $blocks);
        yield "</div>
      ";
        // line 9
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 10
        yield "    </div>
  </header>
  <div class=\"teaser__content\">
    ";
        // line 13
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 14
        yield "  </div>
</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes"]);        // line 1
        yield "<!-- 🥛 Component end: olivero:teaser -->";
        return; yield '';
    }

    // line 3
    public function block_prefix($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 5
    public function block_meta($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 8
    public function block_image($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 9
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    // line 13
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "olivero:teaser";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  117 => 13,  110 => 9,  103 => 8,  96 => 5,  89 => 3,  84 => 1,  79 => 14,  77 => 13,  72 => 10,  70 => 9,  66 => 8,  62 => 6,  60 => 5,  57 => 4,  55 => 3,  45 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<article{{ attributes.addClass('teaser') }}>
  <header>
    {% block prefix %}{% endblock %}
    <div class=\"teaser__meta\">
      {% block meta %}{% endblock %}
    </div>
    <div class=\"teaser__top\">
      <div class=\"teaser__image\">{% block image %}{% endblock %}</div>
      {% block title %}{% endblock %}
    </div>
  </header>
  <div class=\"teaser__content\">
    {% block content %}{% endblock %}
  </div>
</article>
", "olivero:teaser", "core/themes/olivero/components/teaser/teaser.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("block" => 3);
        static $filters = array("escape" => 1);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['block'],
                ['escape'],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
