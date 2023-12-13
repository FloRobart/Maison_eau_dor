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

/* contact.html.twig */
class __TwigTemplate_a06913140fae4765752542c6b9cee456 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "contact.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <title>Contactez-moi</title>
        <meta rel=\"stylesheet\" href=\"../css/styles_contact.css\">
    </head>
    <body>
        <section id=\"contact\" class=\"contact sec-pad dynamicBg\">
            <div class=\"main-container\">
                <h2 class=\"heading heading-sec heading-sec__mb-med\">
                    <span class=\"heading-sec__main heading-sec__main--lt\">Contactez-moi</span>
                    <span class=\"heading-sec__sub heading-sec__sub--lt\">
                        N'hésitez pas à me contacter en soumettant le formulaire ci-dessous et je vous répondrai dans les plus brefs délais.
                    </span>
                </h2>
                <div class=\"contact__form-container\">
                    <form action=\"contact/sendmail\" class='contact__form' method='post'>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"name\">Nom</label>
                            <input class=\"contact__form-input\" placeholder=\"Entrer votre nom\" type=\"text\" name=\"name\" required>
                        </div>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"email\">E-mail</label>
                            <input class=\"contact__form-input\" placeholder=\"Entrer votre mail\" type=\"email\" name=\"email\" required>
                        </div>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"subject\">Sujet</label>
                            <input class=\"contact__form-input\" placeholder=\"Entrer le sujet de votre mail\" type=\"text\" name=\"subject\" required>
                        </div>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"message\">Message</label>
                            <textarea class=\"contact__form-input\" placeholder=\"Entrer votre message\" name=\"message\" required></textarea>
                        </div>
                        <button class=\"btn btn--theme contact__btn\" type=\"submit\">Envoyer</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "contact.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
    <head>
        <title>Contactez-moi</title>
        <meta rel=\"stylesheet\" href=\"../css/styles_contact.css\">
    </head>
    <body>
        <section id=\"contact\" class=\"contact sec-pad dynamicBg\">
            <div class=\"main-container\">
                <h2 class=\"heading heading-sec heading-sec__mb-med\">
                    <span class=\"heading-sec__main heading-sec__main--lt\">Contactez-moi</span>
                    <span class=\"heading-sec__sub heading-sec__sub--lt\">
                        N'hésitez pas à me contacter en soumettant le formulaire ci-dessous et je vous répondrai dans les plus brefs délais.
                    </span>
                </h2>
                <div class=\"contact__form-container\">
                    <form action=\"contact/sendmail\" class='contact__form' method='post'>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"name\">Nom</label>
                            <input class=\"contact__form-input\" placeholder=\"Entrer votre nom\" type=\"text\" name=\"name\" required>
                        </div>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"email\">E-mail</label>
                            <input class=\"contact__form-input\" placeholder=\"Entrer votre mail\" type=\"email\" name=\"email\" required>
                        </div>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"subject\">Sujet</label>
                            <input class=\"contact__form-input\" placeholder=\"Entrer le sujet de votre mail\" type=\"text\" name=\"subject\" required>
                        </div>
                        <div class=\"contact__form-field\">
                            <label class=\"contact__form-label\" for=\"message\">Message</label>
                            <textarea class=\"contact__form-input\" placeholder=\"Entrer votre message\" name=\"message\" required></textarea>
                        </div>
                        <button class=\"btn btn--theme contact__btn\" type=\"submit\">Envoyer</button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>", "contact.html.twig", "/home/floris/Documents/IUT/TP/s5/s5.01_developpement_avance/Maison_eau_dor/templates/contact.html.twig");
    }
}
