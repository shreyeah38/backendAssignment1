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

/* @help_topics/system.theme_uninstall.html.twig */
class __TwigTemplate_783ee7945fc7c5b287cce9e5f5429e43 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension(SandboxExtension::class);
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        $context["themes_link_text"] = ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            yield t("Appearance", array());
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["themes_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["themes_link_text"] ?? null), 8, $this->source), "system.themes_page"));
        // line 9
        yield "<h2>";
        yield t("Goal", array());
        yield "</h2>
<p>";
        // line 10
        yield t("Uninstall a theme that was previously installed, but is no longer being used on the site.", array());
        yield "</p>
<h2>";
        // line 11
        yield t("Steps", array());
        yield "</h2>
<ol>
  <li>";
        // line 13
        yield t("In the <em>Manage</em> administrative menu, navigate to <em>@themes_link</em>.", array("@themes_link" => ($context["themes_link"] ?? null), ));
        yield "</li>
  <li>";
        // line 14
        yield t("Locate the theme that you want to uninstall, in the <em>Installed themes</em> section.", array());
        yield "</li>
  <li>";
        // line 15
        yield t("Click the <em>Uninstall</em> link to uninstall the theme. If there is not an <em>Uninstall</em> link, the theme cannot be uninstalled because it is either being used as the site default theme, being used as the <em>Administration theme</em>, or is the base theme for another installed theme.", array());
        yield "</li>
</ol>";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/system.theme_uninstall.html.twig";
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
        return array (  69 => 15,  65 => 14,  61 => 13,  56 => 11,  52 => 10,  47 => 9,  45 => 8,  40 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("{% line 7 %}{% set themes_link_text %}{% trans %}Appearance{% endtrans %}{% endset %}
{% set themes_link = render_var(help_route_link(themes_link_text, 'system.themes_page')) %}
<h2>{% trans %}Goal{% endtrans %}</h2>
<p>{% trans %}Uninstall a theme that was previously installed, but is no longer being used on the site.{% endtrans %}</p>
<h2>{% trans %}Steps{% endtrans %}</h2>
<ol>
  <li>{% trans %}In the <em>Manage</em> administrative menu, navigate to <em>{{ themes_link }}</em>.{% endtrans %}</li>
  <li>{% trans %}Locate the theme that you want to uninstall, in the <em>Installed themes</em> section.{% endtrans %}</li>
  <li>{% trans %}Click the <em>Uninstall</em> link to uninstall the theme. If there is not an <em>Uninstall</em> link, the theme cannot be uninstalled because it is either being used as the site default theme, being used as the <em>Administration theme</em>, or is the base theme for another installed theme.{% endtrans %}</li>
</ol>", "@help_topics/system.theme_uninstall.html.twig", "/home/shreyarai0308/assign1/web/core/modules/system/help_topics/system.theme_uninstall.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 8, "help_route_link" => 8);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link'],
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
