<?php

/* themes/bootstrap/templates/input/input.html.twig */
class __TwigTemplate_25c62e95303e1b73e03c6c8a23611a4c777ba1ba1b58b9f64cf9c32ab6899785 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'input' => array($this, 'block_input'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("spaceless" => 22, "if" => 23, "block" => 31);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('spaceless', 'if', 'block'),
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

        // line 22
        ob_start();
        // line 23
        echo "  ";
        if ((isset($context["input_group"]) ? $context["input_group"] : null)) {
            // line 24
            echo "    <div class=\"input-group\">
  ";
        }
        // line 26
        echo "
  ";
        // line 27
        if ((isset($context["prefix"]) ? $context["prefix"] : null)) {
            // line 28
            echo "    ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["prefix"]) ? $context["prefix"] : null), "html", null, true));
            echo "
  ";
        }
        // line 30
        echo "
  ";
        // line 31
        $this->displayBlock('input', $context, $blocks);
        // line 34
        echo "
  ";
        // line 35
        if ((isset($context["suffix"]) ? $context["suffix"] : null)) {
            // line 36
            echo "    ";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["suffix"]) ? $context["suffix"] : null), "html", null, true));
            echo "
  ";
        }
        // line 38
        echo "
  ";
        // line 39
        if ((isset($context["input_group"]) ? $context["input_group"] : null)) {
            // line 40
            echo "    </div>
  ";
        }
        // line 42
        echo "
  ";
        // line 43
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true));
        echo "
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 31
    public function block_input($context, array $blocks = array())
    {
        // line 32
        echo "    <input";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, (isset($context["attributes"]) ? $context["attributes"] : null), "html", null, true));
        echo " />
  ";
    }

    public function getTemplateName()
    {
        return "themes/bootstrap/templates/input/input.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 32,  99 => 31,  92 => 43,  89 => 42,  85 => 40,  83 => 39,  80 => 38,  74 => 36,  72 => 35,  69 => 34,  67 => 31,  64 => 30,  58 => 28,  56 => 27,  53 => 26,  49 => 24,  46 => 23,  44 => 22,);
    }

    public function getSource()
    {
        return "";
    }
}
