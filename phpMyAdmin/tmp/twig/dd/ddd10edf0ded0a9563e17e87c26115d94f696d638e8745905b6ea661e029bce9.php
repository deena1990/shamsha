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

/* database/structure/structure_table_row.twig */
class __TwigTemplate_5b8ac85a2e1490149a78e57e91792ccb7cfe73bd3079939ede405a08cfd0011a extends \Twig\Template
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
        echo "<tr id=\"row_tbl_";
        echo twig_escape_filter($this->env, ($context["curr"] ?? null), "html", null, true);
        echo "\"";
        echo ((($context["table_is_view"] ?? null)) ? (" class=\"is_view\"") : (""));
        echo " data-filter-row=\"";
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, (($__internal_compile_0 = ($context["current_table"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["TABLE_NAME"] ?? null) : null)), "html", null, true);
        echo "\">
    <td class=\"center print_ignore\">
        <input type=\"checkbox\"
            name=\"selected_tbl[]\"
            class=\"";
        // line 5
        echo twig_escape_filter($this->env, ($context["input_class"] ?? null), "html", null, true);
        echo "\"
            value=\"";
        // line 6
        echo twig_escape_filter($this->env, (($__internal_compile_1 = ($context["current_table"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["TABLE_NAME"] ?? null) : null), "html", null, true);
        echo "\"
            id=\"checkbox_tbl_";
        // line 7
        echo twig_escape_filter($this->env, ($context["curr"] ?? null), "html", null, true);
        echo "\" />
    </td>
    <th>
        ";
        // line 10
        echo ($context["browse_table_label"] ?? null);
        echo "
        ";
        // line 11
        echo ($context["tracking_icon"] ?? null);
        echo "
    </th>
    ";
        // line 13
        if (($context["server_slave_status"] ?? null)) {
            // line 14
            echo "        <td class=\"center\">
            ";
            // line 15
            echo ((($context["ignored"] ?? null)) ? (PhpMyAdmin\Util::getImage("s_cancel", _gettext("Not replicated"))) : (""));
            echo "
            ";
            // line 16
            echo ((($context["do"] ?? null)) ? (PhpMyAdmin\Util::getImage("s_success", _gettext("Replicated"))) : (""));
            echo "
        </td>
    ";
        }
        // line 19
        echo "
    ";
        // line 21
        echo "    ";
        if ((($context["num_favorite_tables"] ?? null) > 0)) {
            // line 22
            echo "        <td class=\"center print_ignore\">
            ";
            // line 24
            echo "            ";
            $context["fav_params"] = ["db" =>             // line 25
($context["db"] ?? null), "ajax_request" => true, "favorite_table" => (($__internal_compile_2 =             // line 27
($context["current_table"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["TABLE_NAME"] ?? null) : null), (((            // line 28
($context["already_favorite"] ?? null)) ? ("remove") : ("add")) . "_favorite") => true];
            // line 30
            echo "            ";
            $this->loadTemplate("database/structure/favorite_anchor.twig", "database/structure/structure_table_row.twig", 30)->display(twig_to_array(["table_name_hash" => md5((($__internal_compile_3 =             // line 31
($context["current_table"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["TABLE_NAME"] ?? null) : null)), "db_table_name_hash" => md5(((            // line 32
($context["db"] ?? null) . ".") . (($__internal_compile_4 = ($context["current_table"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["TABLE_NAME"] ?? null) : null))), "fav_params" =>             // line 33
($context["fav_params"] ?? null), "already_favorite" =>             // line 34
($context["already_favorite"] ?? null), "titles" =>             // line 35
($context["titles"] ?? null)]));
            // line 37
            echo "        </td>
    ";
        }
        // line 39
        echo "
    <td class=\"center print_ignore\">
        ";
        // line 41
        echo ($context["browse_table"] ?? null);
        echo "
    </td>
    <td class=\"center print_ignore\">
        <a href=\"tbl_structure.php";
        // line 44
        echo ($context["tbl_url_query"] ?? null);
        echo "\">
            ";
        // line 45
        echo (($__internal_compile_5 = ($context["titles"] ?? null)) && is_array($__internal_compile_5) || $__internal_compile_5 instanceof ArrayAccess ? ($__internal_compile_5["Structure"] ?? null) : null);
        echo "
        </a>
    </td>
    <td class=\"center print_ignore\">
        ";
        // line 49
        echo ($context["search_table"] ?? null);
        echo "
    </td>

    ";
        // line 52
        if ( !($context["db_is_system_schema"] ?? null)) {
            // line 53
            echo "        <td class=\"insert_table center print_ignore\">
            <a href=\"tbl_change.php";
            // line 54
            echo ($context["tbl_url_query"] ?? null);
            echo "\">";
            echo (($__internal_compile_6 = ($context["titles"] ?? null)) && is_array($__internal_compile_6) || $__internal_compile_6 instanceof ArrayAccess ? ($__internal_compile_6["Insert"] ?? null) : null);
            echo "</a>
        </td>
        <td class=\"center print_ignore\">";
            // line 56
            echo ($context["empty_table"] ?? null);
            echo "</td>
        <td class=\"center print_ignore\">
            <a class=\"ajax drop_table_anchor";
            // line 59
            echo (((($context["table_is_view"] ?? null) || ((($__internal_compile_7 = ($context["current_table"] ?? null)) && is_array($__internal_compile_7) || $__internal_compile_7 instanceof ArrayAccess ? ($__internal_compile_7["ENGINE"] ?? null) : null) == null))) ? (" view") : (""));
            echo "\"
                href=\"sql.php\" data-post=\"";
            // line 60
            echo ($context["tbl_url_query"] ?? null);
            echo "&amp;reload=1&amp;purge=1&amp;sql_query=";
            // line 61
            echo twig_escape_filter($this->env, twig_urlencode_filter(($context["drop_query"] ?? null)), "html", null, true);
            echo "&amp;message_to_show=";
            echo twig_escape_filter($this->env, twig_urlencode_filter(($context["drop_message"] ?? null)), "html", null, true);
            echo "\">
                ";
            // line 62
            echo (($__internal_compile_8 = ($context["titles"] ?? null)) && is_array($__internal_compile_8) || $__internal_compile_8 instanceof ArrayAccess ? ($__internal_compile_8["Drop"] ?? null) : null);
            echo "
            </a>
        </td>
    ";
        }
        // line 66
        echo "
    ";
        // line 67
        if ((twig_get_attribute($this->env, $this->source, ($context["current_table"] ?? null), "TABLE_ROWS", [], "array", true, true, false, 67) && (((($__internal_compile_9 =         // line 68
($context["current_table"] ?? null)) && is_array($__internal_compile_9) || $__internal_compile_9 instanceof ArrayAccess ? ($__internal_compile_9["ENGINE"] ?? null) : null) != null) || ($context["table_is_view"] ?? null)))) {
            // line 69
            echo "        ";
            // line 70
            echo "        ";
            $context["row_count"] = PhpMyAdmin\Util::formatNumber((($__internal_compile_10 = ($context["current_table"] ?? null)) && is_array($__internal_compile_10) || $__internal_compile_10 instanceof ArrayAccess ? ($__internal_compile_10["TABLE_ROWS"] ?? null) : null), 0);
            // line 71
            echo "
        ";
            // line 74
            echo "        <td class=\"value tbl_rows\"
            data-table=\"";
            // line 75
            echo twig_escape_filter($this->env, (($__internal_compile_11 = ($context["current_table"] ?? null)) && is_array($__internal_compile_11) || $__internal_compile_11 instanceof ArrayAccess ? ($__internal_compile_11["TABLE_NAME"] ?? null) : null), "html", null, true);
            echo "\">
            ";
            // line 76
            if (($context["approx_rows"] ?? null)) {
                // line 77
                echo "                <a href=\"db_structure.php";
                echo PhpMyAdmin\Url::getCommon(["ajax_request" => true, "db" =>                 // line 79
($context["db"] ?? null), "table" => (($__internal_compile_12 =                 // line 80
($context["current_table"] ?? null)) && is_array($__internal_compile_12) || $__internal_compile_12 instanceof ArrayAccess ? ($__internal_compile_12["TABLE_NAME"] ?? null) : null), "real_row_count" => "true"]);
                // line 82
                echo "\" class=\"ajax real_row_count\">
                    <bdi>
                        ~";
                // line 84
                echo twig_escape_filter($this->env, ($context["row_count"] ?? null), "html", null, true);
                echo "
                    </bdi>
                </a>
            ";
            } else {
                // line 88
                echo "                ";
                echo twig_escape_filter($this->env, ($context["row_count"] ?? null), "html", null, true);
                echo "
            ";
            }
            // line 90
            echo "            ";
            echo ($context["show_superscript"] ?? null);
            echo "
        </td>

        ";
            // line 93
            if ( !(($context["properties_num_columns"] ?? null) > 1)) {
                // line 94
                echo "            <td class=\"nowrap\">
                ";
                // line 95
                if ( !twig_test_empty((($__internal_compile_13 = ($context["current_table"] ?? null)) && is_array($__internal_compile_13) || $__internal_compile_13 instanceof ArrayAccess ? ($__internal_compile_13["ENGINE"] ?? null) : null))) {
                    // line 96
                    echo "                    ";
                    echo twig_escape_filter($this->env, (($__internal_compile_14 = ($context["current_table"] ?? null)) && is_array($__internal_compile_14) || $__internal_compile_14 instanceof ArrayAccess ? ($__internal_compile_14["ENGINE"] ?? null) : null), "html", null, true);
                    echo "
                ";
                } elseif (                // line 97
($context["table_is_view"] ?? null)) {
                    // line 98
                    echo "                    ";
                    echo _gettext("View");
                    // line 99
                    echo "                ";
                }
                // line 100
                echo "            </td>
            ";
                // line 101
                if ((twig_length_filter($this->env, ($context["collation"] ?? null)) > 0)) {
                    // line 102
                    echo "                <td class=\"nowrap\">
                    ";
                    // line 103
                    echo ($context["collation"] ?? null);
                    echo "
                </td>
            ";
                }
                // line 106
                echo "        ";
            }
            // line 107
            echo "
        ";
            // line 108
            if (($context["is_show_stats"] ?? null)) {
                // line 109
                echo "            <td class=\"value tbl_size\">
                <a href=\"tbl_structure.php";
                // line 110
                echo ($context["tbl_url_query"] ?? null);
                echo "#showusage\">
                    <span>";
                // line 111
                echo twig_escape_filter($this->env, ($context["formatted_size"] ?? null), "html", null, true);
                echo "</span>
                    <span class=\"unit\">";
                // line 112
                echo twig_escape_filter($this->env, ($context["unit"] ?? null), "html", null, true);
                echo "</span>
                </a>
            </td>
            <td class=\"value tbl_overhead\">
                ";
                // line 116
                echo ($context["overhead"] ?? null);
                echo "
            </td>
        ";
            }
            // line 119
            echo "
        ";
            // line 120
            if ( !(($context["show_charset"] ?? null) > 1)) {
                // line 121
                echo "            ";
                if ((twig_length_filter($this->env, ($context["charset"] ?? null)) > 0)) {
                    // line 122
                    echo "                <td class=\"nowrap\">
                    ";
                    // line 123
                    echo ($context["charset"] ?? null);
                    echo "
                </td>
            ";
                }
                // line 126
                echo "        ";
            }
            // line 127
            echo "
        ";
            // line 128
            if (($context["show_comment"] ?? null)) {
                // line 129
                echo "            ";
                $context["comment"] = (($__internal_compile_15 = ($context["current_table"] ?? null)) && is_array($__internal_compile_15) || $__internal_compile_15 instanceof ArrayAccess ? ($__internal_compile_15["Comment"] ?? null) : null);
                // line 130
                echo "            <td>
                ";
                // line 131
                if ((twig_length_filter($this->env, ($context["comment"] ?? null)) > ($context["limit_chars"] ?? null))) {
                    // line 132
                    echo "                    <abbr title=\"";
                    echo twig_escape_filter($this->env, ($context["comment"] ?? null), "html", null, true);
                    echo "\">
                        ";
                    // line 133
                    echo twig_escape_filter($this->env, twig_slice($this->env, ($context["comment"] ?? null), 0, ($context["limit_chars"] ?? null)), "html", null, true);
                    echo "
                        ...
                    </abbr>
                ";
                } else {
                    // line 137
                    echo "                    ";
                    echo twig_escape_filter($this->env, ($context["comment"] ?? null), "html", null, true);
                    echo "
                ";
                }
                // line 139
                echo "            </td>
        ";
            }
            // line 141
            echo "
        ";
            // line 142
            if (($context["show_creation"] ?? null)) {
                // line 143
                echo "            <td class=\"value tbl_creation\">
                ";
                // line 144
                ((($context["create_time"] ?? null)) ? (print (twig_escape_filter($this->env, PhpMyAdmin\Util::localisedDate(strtotime(($context["create_time"] ?? null))), "html", null, true))) : (print ("-")));
                echo "
            </td>
        ";
            }
            // line 147
            echo "
        ";
            // line 148
            if (($context["show_last_update"] ?? null)) {
                // line 149
                echo "            <td class=\"value tbl_last_update\">
                ";
                // line 150
                ((($context["update_time"] ?? null)) ? (print (twig_escape_filter($this->env, PhpMyAdmin\Util::localisedDate(strtotime(($context["update_time"] ?? null))), "html", null, true))) : (print ("-")));
                echo "
            </td>
        ";
            }
            // line 153
            echo "
        ";
            // line 154
            if (($context["show_last_check"] ?? null)) {
                // line 155
                echo "            <td class=\"value tbl_last_check\">
                ";
                // line 156
                ((($context["check_time"] ?? null)) ? (print (twig_escape_filter($this->env, PhpMyAdmin\Util::localisedDate(strtotime(($context["check_time"] ?? null))), "html", null, true))) : (print ("-")));
                echo "
            </td>
        ";
            }
            // line 159
            echo "
    ";
        } elseif (        // line 160
($context["table_is_view"] ?? null)) {
            // line 161
            echo "        <td class=\"value tbl_rows\">-</td>
        <td class=\"nowrap\">
            ";
            // line 163
            echo _gettext("View");
            // line 164
            echo "        </td>
        <td class=\"nowrap\">---</td>
        ";
            // line 166
            if (($context["is_show_stats"] ?? null)) {
                // line 167
                echo "            <td class=\"value tbl_size\">-</td>
            <td class=\"value tbl_overhead\">-</td>
        ";
            }
            // line 170
            echo "        ";
            if (($context["show_charset"] ?? null)) {
                // line 171
                echo "            <td></td>
        ";
            }
            // line 173
            echo "        ";
            if (($context["show_comment"] ?? null)) {
                // line 174
                echo "            <td></td>
        ";
            }
            // line 176
            echo "        ";
            if (($context["show_creation"] ?? null)) {
                // line 177
                echo "            <td class=\"value tbl_creation\">-</td>
        ";
            }
            // line 179
            echo "        ";
            if (($context["show_last_update"] ?? null)) {
                // line 180
                echo "            <td class=\"value tbl_last_update\">-</td>
        ";
            }
            // line 182
            echo "        ";
            if (($context["show_last_check"] ?? null)) {
                // line 183
                echo "            <td class=\"value tbl_last_check\">-</td>
        ";
            }
            // line 185
            echo "
    ";
        } else {
            // line 187
            echo "        ";
            $context["count"] = 0;
            // line 188
            echo "        ";
            if (($context["properties_num_columns"] ?? null)) {
                // line 189
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 2);
                // line 190
                echo "        ";
            }
            // line 191
            echo "        ";
            if (($context["is_show_stats"] ?? null)) {
                // line 192
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 2);
                // line 193
                echo "        ";
            }
            // line 194
            echo "        ";
            if (($context["show_charset"] ?? null)) {
                // line 195
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 1);
                // line 196
                echo "        ";
            }
            // line 197
            echo "        ";
            if (($context["show_comment"] ?? null)) {
                // line 198
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 1);
                // line 199
                echo "        ";
            }
            // line 200
            echo "        ";
            if (($context["show_creation"] ?? null)) {
                // line 201
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 1);
                // line 202
                echo "        ";
            }
            // line 203
            echo "        ";
            if (($context["show_last_update"] ?? null)) {
                // line 204
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 1);
                // line 205
                echo "        ";
            }
            // line 206
            echo "        ";
            if (($context["show_last_check"] ?? null)) {
                // line 207
                echo "            ";
                $context["count"] = (($context["count"] ?? null) + 1);
                // line 208
                echo "        ";
            }
            // line 209
            echo "
        ";
            // line 210
            if (($context["db_is_system_schema"] ?? null)) {
                // line 211
                echo "            ";
                $context["action_colspan"] = 3;
                // line 212
                echo "        ";
            } else {
                // line 213
                echo "            ";
                $context["action_colspan"] = 6;
                // line 214
                echo "        ";
            }
            // line 215
            echo "        ";
            if ((($context["num_favorite_tables"] ?? null) > 0)) {
                // line 216
                echo "            ";
                $context["action_colspan"] = (($context["action_colspan"] ?? null) + 1);
                // line 217
                echo "        ";
            }
            // line 218
            echo "
        ";
            // line 219
            $context["colspan_for_structure"] = (($context["action_colspan"] ?? null) + 3);
            // line 220
            echo "        <td colspan=\"";
            echo (((($context["colspan_for_structure"] ?? null) - ($context["db_is_system_schema"] ?? null))) ? (6) : (9));
            echo "\"
            class=\"center\">
            ";
            // line 222
            echo _gettext("in use");
            // line 223
            echo "        </td>
    ";
        }
        // line 225
        echo "</tr>
";
    }

    public function getTemplateName()
    {
        return "database/structure/structure_table_row.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  563 => 225,  559 => 223,  557 => 222,  551 => 220,  549 => 219,  546 => 218,  543 => 217,  540 => 216,  537 => 215,  534 => 214,  531 => 213,  528 => 212,  525 => 211,  523 => 210,  520 => 209,  517 => 208,  514 => 207,  511 => 206,  508 => 205,  505 => 204,  502 => 203,  499 => 202,  496 => 201,  493 => 200,  490 => 199,  487 => 198,  484 => 197,  481 => 196,  478 => 195,  475 => 194,  472 => 193,  469 => 192,  466 => 191,  463 => 190,  460 => 189,  457 => 188,  454 => 187,  450 => 185,  446 => 183,  443 => 182,  439 => 180,  436 => 179,  432 => 177,  429 => 176,  425 => 174,  422 => 173,  418 => 171,  415 => 170,  410 => 167,  408 => 166,  404 => 164,  402 => 163,  398 => 161,  396 => 160,  393 => 159,  387 => 156,  384 => 155,  382 => 154,  379 => 153,  373 => 150,  370 => 149,  368 => 148,  365 => 147,  359 => 144,  356 => 143,  354 => 142,  351 => 141,  347 => 139,  341 => 137,  334 => 133,  329 => 132,  327 => 131,  324 => 130,  321 => 129,  319 => 128,  316 => 127,  313 => 126,  307 => 123,  304 => 122,  301 => 121,  299 => 120,  296 => 119,  290 => 116,  283 => 112,  279 => 111,  275 => 110,  272 => 109,  270 => 108,  267 => 107,  264 => 106,  258 => 103,  255 => 102,  253 => 101,  250 => 100,  247 => 99,  244 => 98,  242 => 97,  237 => 96,  235 => 95,  232 => 94,  230 => 93,  223 => 90,  217 => 88,  210 => 84,  206 => 82,  204 => 80,  203 => 79,  201 => 77,  199 => 76,  195 => 75,  192 => 74,  189 => 71,  186 => 70,  184 => 69,  182 => 68,  181 => 67,  178 => 66,  171 => 62,  165 => 61,  162 => 60,  158 => 59,  153 => 56,  146 => 54,  143 => 53,  141 => 52,  135 => 49,  128 => 45,  124 => 44,  118 => 41,  114 => 39,  110 => 37,  108 => 35,  107 => 34,  106 => 33,  105 => 32,  104 => 31,  102 => 30,  100 => 28,  99 => 27,  98 => 25,  96 => 24,  93 => 22,  90 => 21,  87 => 19,  81 => 16,  77 => 15,  74 => 14,  72 => 13,  67 => 11,  63 => 10,  57 => 7,  53 => 6,  49 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "database/structure/structure_table_row.twig", "/var/www/vhosts/shamsaha.com/httpdocs/app/phpMyAdmin/templates/database/structure/structure_table_row.twig");
    }
}
