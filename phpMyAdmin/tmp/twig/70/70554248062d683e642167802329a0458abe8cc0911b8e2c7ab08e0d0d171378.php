<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* dropdown.twig */
class __TwigTemplate_fedb038c913b53d8d63e69aa0a0839a8053ead6183c41c90056c1b74dff86b98 extends \Twig\Template
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
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<select name=\"";
        echo twig_escape_filter($this->env, ($context["select_name"] ?? null), "html", null, true);
        echo "\"";
        if ( !twig_test_empty(($context["id"] ?? null))) {
            echo " id=\"";
            echo twig_escape_filter($this->env, ($context["id"] ?? null), "html", null, true);
            echo "\"";
        }
        // line 2
        if ( !twig_test_empty(($context["class"] ?? null))) {
            echo " class=\"";
            echo twig_escape_filter($this->env, ($context["class"] ?? null), "html", null, true);
            echo "\"";
        }
        echo ">
";
        // line 3
        if ( !twig_test_empty(($context["placeholder"] ?? null))) {
            // line 4
            echo "    <option value=\"\" disabled=\"disabled\"";
            // line 5
            if ( !($context["selected"] ?? null)) {
                echo " selected=\"selected\"";
            }
            echo ">";
            echo twig_escape_filter($this->env, ($context["placeholder"] ?? null), "html", null, true);
            echo "</option>
";
        }
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["result_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 8
            echo "<option value=\"";
            echo twig_escape_filter($this->env, (($__internal_compile_0 = $context["option"]) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["value"] ?? null) : null), "html", null, true);
            echo "\"";
            // line 9
            echo (((($__internal_compile_1 = $context["option"]) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["selected"] ?? null) : null)) ? (" selected=\"selected\"") : (""));
            echo ">";
            echo twig_escape_filter($this->env, (($__internal_compile_2 = $context["option"]) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["label"] ?? null) : null), "html", null, true);
            echo "</option>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</select>
";
    }

    public function getTemplateName()
    {
        return "dropdown.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 11,  75 => 9,  71 => 8,  67 => 7,  58 => 5,  56 => 4,  54 => 3,  46 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "dropdown.twig", "/var/www/vhosts/shamsaha.com/httpdocs/app/phpMyAdmin/templates/dropdown.twig");
    }
}
