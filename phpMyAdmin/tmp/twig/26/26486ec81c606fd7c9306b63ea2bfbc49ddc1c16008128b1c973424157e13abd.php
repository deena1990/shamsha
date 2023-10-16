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

/* database/structure/favorite_anchor.twig */
class __TwigTemplate_bac486b100ed00a3cbe35eecc1791a6bb2f535c117f2d3a654a72d224abdaa77 extends \Twig\Template
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
        echo "<a id=\"";
        echo twig_escape_filter($this->env, ($context["table_name_hash"] ?? null), "html", null, true);
        echo "_favorite_anchor\"
    class=\"ajax favorite_table_anchor\"
    href=\"db_structure.php";
        // line 3
        echo PhpMyAdmin\Url::getCommon(($context["fav_params"] ?? null));
        echo "\"
    title=\"";
        // line 4
        echo twig_escape_filter($this->env, ((($context["already_favorite"] ?? null)) ? (_gettext("Remove from Favorites")) : (_gettext("Add to Favorites"))), "html", null, true);
        echo "\"
    data-favtargets=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["db_table_name_hash"] ?? null), "html", null, true);
        echo "\" >
    ";
        // line 6
        echo ((($context["already_favorite"] ?? null)) ? ((($__internal_compile_0 = ($context["titles"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["Favorite"] ?? null) : null)) : ((($__internal_compile_1 = ($context["titles"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["NoFavorite"] ?? null) : null)));
        echo "
</a>
";
    }

    public function getTemplateName()
    {
        return "database/structure/favorite_anchor.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 6,  51 => 5,  47 => 4,  43 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/structure/favorite_anchor.twig", "/var/www/vhosts/shamsaha.com/httpdocs/app/phpMyAdmin/templates/database/structure/favorite_anchor.twig");
    }
}
