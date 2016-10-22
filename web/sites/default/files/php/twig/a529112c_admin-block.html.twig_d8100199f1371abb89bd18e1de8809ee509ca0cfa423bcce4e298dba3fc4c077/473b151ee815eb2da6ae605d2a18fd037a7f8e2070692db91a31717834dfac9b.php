<?php

/* core/themes/stable/templates/admin/admin-block.html.twig */
class __TwigTemplate_12192b8eb34b2c220b9e39905ae2698a976b6c59c229cb12cfc048d6192c4f37 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 16);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if'),
                array(),
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

        // line 15
        echo "<div class=\"panel\">
  ";
        // line 16
        if ($this->getAttribute((isset($context["block"]) ? $context["block"] : null), "title", array())) {
            // line 17
            echo "    <h3 class=\"panel__title\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "title", array()), "html", null, true));
            echo "</h3>
  ";
        }
        // line 19
        echo "  ";
        if ($this->getAttribute((isset($context["block"]) ? $context["block"] : null), "content", array())) {
            // line 20
            echo "    <div class=\"panel__content\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "content", array()), "html", null, true));
            echo "</div>
  ";
        } elseif ($this->getAttribute(        // line 21
(isset($context["block"]) ? $context["block"] : null), "description", array())) {
            // line 22
            echo "    <div class=\"panel__description\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "description", array()), "html", null, true));
            echo "</div>
  ";
        }
        // line 24
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/admin-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 24,  64 => 22,  62 => 21,  57 => 20,  54 => 19,  48 => 17,  46 => 16,  43 => 15,);
    }

    public function getSource()
    {
        return "";
    }
}
