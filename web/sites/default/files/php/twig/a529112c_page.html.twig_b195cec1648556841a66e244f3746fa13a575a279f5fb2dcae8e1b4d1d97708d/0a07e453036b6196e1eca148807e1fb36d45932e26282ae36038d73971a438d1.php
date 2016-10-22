<?php

/* themes/bootstrap/templates/system/page.html.twig */
class __TwigTemplate_d12001cb6169d5ad965616c927b20a1652a84c9b91a6bfd495996b41f0e57990 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'navbar' => array($this, 'block_navbar'),
            'main' => array($this, 'block_main'),
            'header' => array($this, 'block_header'),
            'sidebar_first' => array($this, 'block_sidebar_first'),
            'highlighted' => array($this, 'block_highlighted'),
            'breadcrumb' => array($this, 'block_breadcrumb'),
            'action_links' => array($this, 'block_action_links'),
            'help' => array($this, 'block_help'),
            'content' => array($this, 'block_content'),
            'sidebar_second' => array($this, 'block_sidebar_second'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("set" => 59, "if" => 61, "block" => 62);
        $filters = array("clean_class" => 67, "t" => 76);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('set', 'if', 'block'),
                array('clean_class', 't'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 59
        $context["container"] = (($this->getAttribute($this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "settings", array()), "fluid_container", array())) ? ("container-fluid") : ("container"));
        // line 61
        if (($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "navigation", array()) || $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "navigation_collapsible", array()))) {
            // line 62
            echo "  ";
            $this->displayBlock('navbar', $context, $blocks);
        }
        // line 93
        echo "
";
        // line 95
        $this->displayBlock('main', $context, $blocks);
        // line 174
        echo "
";
        // line 175
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer", array())) {
            // line 176
            echo "  ";
            $this->displayBlock('footer', $context, $blocks);
        }
    }

    // line 62
    public function block_navbar($context, array $blocks = array())
    {
        // line 63
        echo "    ";
        // line 64
        $context["navbar_classes"] = array(0 => "navbar", 1 => (($this->getAttribute($this->getAttribute(        // line 66
(isset($context["theme"]) ? $context["theme"] : null), "settings", array()), "navbar_inverse", array())) ? ("navbar-inverse") : ("navbar-default")), 2 => (($this->getAttribute($this->getAttribute(        // line 67
(isset($context["theme"]) ? $context["theme"] : null), "settings", array()), "navbar_position", array())) ? (("navbar-" . \Drupal\Component\Utility\Html::getClass($this->getAttribute($this->getAttribute((isset($context["theme"]) ? $context["theme"] : null), "settings", array()), "navbar_position", array())))) : ((isset($context["container"]) ? $context["container"] : null))));
        // line 70
        echo "    <header";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["navbar_attributes"]) ? $context["navbar_attributes"] : null), "addClass", array(0 => (isset($context["navbar_classes"]) ? $context["navbar_classes"] : null)), "method"), "html", null, true));
        echo " id=\"navbar\" role=\"banner\">
      <div class=\"navbar-header\">
        ";
        // line 72
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "navigation", array()), "html", null, true));
        echo "
        ";
        // line 74
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "navigation_collapsible", array())) {
            // line 75
            echo "          <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
            <span class=\"sr-only\">";
            // line 76
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Toggle navigation")));
            echo "</span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </button>
        ";
        }
        // line 82
        echo "      </div>

      ";
        // line 85
        echo "      ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "navigation_collapsible", array())) {
            // line 86
            echo "        <div class=\"navbar-collapse collapse\">
          ";
            // line 87
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "navigation_collapsible", array()), "html", null, true));
            echo "
        </div>
      ";
        }
        // line 90
        echo "    </header>
  ";
    }

    // line 95
    public function block_main($context, array $blocks = array())
    {
        // line 96
        echo "  <div role=\"main\" class=\"main-container ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["container"]) ? $context["container"] : null), "html", null, true));
        echo " js-quickedit-main-content\">
    <div class=\"row\">

      ";
        // line 100
        echo "      ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array())) {
            // line 101
            echo "        ";
            $this->displayBlock('header', $context, $blocks);
            // line 106
            echo "      ";
        }
        // line 107
        echo "
      ";
        // line 109
        echo "      ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array())) {
            // line 110
            echo "        ";
            $this->displayBlock('sidebar_first', $context, $blocks);
            // line 115
            echo "      ";
        }
        // line 116
        echo "
      ";
        // line 118
        echo "      ";
        // line 119
        $context["content_classes"] = array(0 => ((($this->getAttribute(        // line 120
(isset($context["page"]) ? $context["page"] : null), "sidebar_first", array()) && $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array()))) ? ("col-sm-6") : ("")), 1 => ((($this->getAttribute(        // line 121
(isset($context["page"]) ? $context["page"] : null), "sidebar_first", array()) && twig_test_empty($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array())))) ? ("col-sm-9") : ("")), 2 => ((($this->getAttribute(        // line 122
(isset($context["page"]) ? $context["page"] : null), "sidebar_second", array()) && twig_test_empty($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array())))) ? ("col-sm-9") : ("")), 3 => (((twig_test_empty($this->getAttribute(        // line 123
(isset($context["page"]) ? $context["page"] : null), "sidebar_first", array())) && twig_test_empty($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array())))) ? ("col-sm-12") : ("")));
        // line 126
        echo "      <section";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["content_attributes"]) ? $context["content_attributes"] : null), "addClass", array(0 => (isset($context["content_classes"]) ? $context["content_classes"] : null)), "method"), "html", null, true));
        echo ">

        ";
        // line 129
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "highlighted", array())) {
            // line 130
            echo "          ";
            $this->displayBlock('highlighted', $context, $blocks);
            // line 133
            echo "        ";
        }
        // line 134
        echo "
        ";
        // line 136
        echo "        ";
        if ((isset($context["breadcrumb"]) ? $context["breadcrumb"] : null)) {
            // line 137
            echo "          ";
            $this->displayBlock('breadcrumb', $context, $blocks);
            // line 140
            echo "        ";
        }
        // line 141
        echo "
        ";
        // line 143
        echo "        ";
        if ((isset($context["action_links"]) ? $context["action_links"] : null)) {
            // line 144
            echo "          ";
            $this->displayBlock('action_links', $context, $blocks);
            // line 147
            echo "        ";
        }
        // line 148
        echo "
        ";
        // line 150
        echo "        ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "help", array())) {
            // line 151
            echo "          ";
            $this->displayBlock('help', $context, $blocks);
            // line 154
            echo "        ";
        }
        // line 155
        echo "
        ";
        // line 157
        echo "        ";
        $this->displayBlock('content', $context, $blocks);
        // line 161
        echo "      </section>

      ";
        // line 164
        echo "      ";
        if ($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array())) {
            // line 165
            echo "        ";
            $this->displayBlock('sidebar_second', $context, $blocks);
            // line 170
            echo "      ";
        }
        // line 171
        echo "    </div>
  </div>
";
    }

    // line 101
    public function block_header($context, array $blocks = array())
    {
        // line 102
        echo "          <div class=\"col-sm-12\" role=\"heading\">
            ";
        // line 103
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array()), "html", null, true));
        echo "
          </div>
        ";
    }

    // line 110
    public function block_sidebar_first($context, array $blocks = array())
    {
        // line 111
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 112
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_first", array()), "html", null, true));
        echo "
          </aside>
        ";
    }

    // line 130
    public function block_highlighted($context, array $blocks = array())
    {
        // line 131
        echo "            <div class=\"highlighted\">";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "highlighted", array()), "html", null, true));
        echo "</div>
          ";
    }

    // line 137
    public function block_breadcrumb($context, array $blocks = array())
    {
        // line 138
        echo "            ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["breadcrumb"]) ? $context["breadcrumb"] : null), "html", null, true));
        echo "
          ";
    }

    // line 144
    public function block_action_links($context, array $blocks = array())
    {
        // line 145
        echo "            <ul class=\"action-links\">";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["action_links"]) ? $context["action_links"] : null), "html", null, true));
        echo "</ul>
          ";
    }

    // line 151
    public function block_help($context, array $blocks = array())
    {
        // line 152
        echo "            ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "help", array()), "html", null, true));
        echo "
          ";
    }

    // line 157
    public function block_content($context, array $blocks = array())
    {
        // line 158
        echo "          <a id=\"main-content\"></a>
          ";
        // line 159
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "content", array()), "html", null, true));
        echo "
        ";
    }

    // line 165
    public function block_sidebar_second($context, array $blocks = array())
    {
        // line 166
        echo "          <aside class=\"col-sm-3\" role=\"complementary\">
            ";
        // line 167
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "sidebar_second", array()), "html", null, true));
        echo "
          </aside>
        ";
    }

    // line 176
    public function block_footer($context, array $blocks = array())
    {
        // line 177
        echo "    <footer class=\"footer ";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["container"]) ? $context["container"] : null), "html", null, true));
        echo "\" role=\"contentinfo\">
      ";
        // line 178
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "footer", array()), "html", null, true));
        echo "
    </footer>
  ";
    }

    public function getTemplateName()
    {
        return "themes/bootstrap/templates/system/page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  350 => 178,  345 => 177,  342 => 176,  335 => 167,  332 => 166,  329 => 165,  323 => 159,  320 => 158,  317 => 157,  310 => 152,  307 => 151,  300 => 145,  297 => 144,  290 => 138,  287 => 137,  280 => 131,  277 => 130,  270 => 112,  267 => 111,  264 => 110,  257 => 103,  254 => 102,  251 => 101,  245 => 171,  242 => 170,  239 => 165,  236 => 164,  232 => 161,  229 => 157,  226 => 155,  223 => 154,  220 => 151,  217 => 150,  214 => 148,  211 => 147,  208 => 144,  205 => 143,  202 => 141,  199 => 140,  196 => 137,  193 => 136,  190 => 134,  187 => 133,  184 => 130,  181 => 129,  175 => 126,  173 => 123,  172 => 122,  171 => 121,  170 => 120,  169 => 119,  167 => 118,  164 => 116,  161 => 115,  158 => 110,  155 => 109,  152 => 107,  149 => 106,  146 => 101,  143 => 100,  136 => 96,  133 => 95,  128 => 90,  122 => 87,  119 => 86,  116 => 85,  112 => 82,  103 => 76,  100 => 75,  97 => 74,  93 => 72,  87 => 70,  85 => 67,  84 => 66,  83 => 64,  81 => 63,  78 => 62,  72 => 176,  70 => 175,  67 => 174,  65 => 95,  62 => 93,  58 => 62,  56 => 61,  54 => 59,);
    }

    public function getSource()
    {
        return "";
    }
}
