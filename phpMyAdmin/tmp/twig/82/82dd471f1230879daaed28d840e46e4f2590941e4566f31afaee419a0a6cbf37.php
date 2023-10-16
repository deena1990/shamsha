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

/* list/item.twig */
class __TwigTemplate_48dd3b15f96f536207e23da4576b80713565b721be313b175531ee9bce1df8d7 extends \Twig\Template
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
        echo "<li";
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
        // line 4
        if (((array_key_exists("url", $context) && twig_test_iterable(($context["url"] ?? null))) &&  !twig_test_empty((($__internal_compile_0 = ($context["url"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["href"] ?? null) : null)))) {
            // line 5
            echo "        <a";
            if ( !twig_test_empty((($__internal_compile_1 = ($context["url"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["href"] ?? null) : null))) {
                echo " href=\"";
                echo (($__internal_compile_2 = ($context["url"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["href"] ?? null) : null);
                echo "\"";
            }
            // line 6
            if ( !twig_test_empty((($__internal_compile_3 = ($context["url"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["target"] ?? null) : null))) {
                echo " target=\"";
                echo twig_escape_filter($this->env, (($__internal_compile_4 = ($context["url"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["target"] ?? null) : null), "html", null, true);
                echo "\"";
            }
            // line 7
            if (( !twig_test_empty((($__internal_compile_5 = ($context["url"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["target"] ?? null) : null)) && ((($__internal_compile_6 = ($context["url"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["target"] ?? null) : null) == "_blank"))) {
                echo " rel=\"noopener noreferrer\"";
            }
            // line 8
            if ( !twig_test_empty((($__internal_compile_7 = ($context["url"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["id"] ?? null) : null))) {
                echo " id=\"";
                echo twig_escape_filter($this->env, (($__internal_compile_8 = ($context["url"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["id"] ?? null) : null), "html", null, true);
                echo "\"";
            }
            // line 9
            if ( !twig_test_empty((($__internal_compile_9 = ($context["url"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["class"] ?? null) : null))) {
                echo " class=\"";
                echo twig_escape_filter($this->env, (($__internal_compile_10 = ($context["url"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["class"] ?? null) : null), "html", null, true);
                echo "\"";
            }
            // line 10
            if ( !twig_test_empty((($__internal_compile_11 = ($context["url"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["title"] ?? null) : null))) {
                echo " title=\"";
                echo twig_escape_filter($this->env, (($__internal_compile_12 = ($context["url"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["title"] ?? null) : null), "html", null, true);
                echo "\"";
            }
            echo ">
    ";
        }
        // line 12
        echo "        ";
        echo ($context["content"] ?? null);
        echo "
    ";
        // line 13
        if (((array_key_exists("url", $context) && twig_test_iterable(($context["url"] ?? null))) &&  !twig_test_empty((($__internal_compile_13 = ($context["url"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["href"] ?? null) : null)))) {
            // line 14
            echo "        </a>
    ";
        }
        // line 16
        echo "    ";
        if ( !twig_test_empty(($context["mysql_help_page"] ?? null))) {
            // line 17
            echo "        ";
            echo PhpMyAdmin\Util::showMySQLDocu(($context["mysql_help_page"] ?? null));
            echo "
    ";
        }
        // line 19
        echo "</li>
";
    }

    public function getTemplateName()
    {
        return "list/item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 19,  107 => 17,  104 => 16,  100 => 14,  98 => 13,  93 => 12,  84 => 10,  78 => 9,  72 => 8,  68 => 7,  62 => 6,  55 => 5,  53 => 4,  44 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "list/item.twig", "/var/www/vhosts/shamsaha.com/httpdocs/app/phpMyAdmin/templates/list/item.twig");
    }
}
