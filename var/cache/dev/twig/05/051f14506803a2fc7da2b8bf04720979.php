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
use Twig\TemplateWrapper;

/* company/profile.html.twig */
class __TwigTemplate_e902f92e7ad1de62c52345ba20e17b75 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/profile.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/profile.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "company/profile.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 3, $this->source); })()), "companyName", [], "any", false, false, false, 3), "html", null, true);
        yield " - Profil Entreprise | JobConnect";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
        }
        
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .profile-title {
            color: #2c3e50;
            margin: 0;
        }
        
        .profile-content {
            display: flex;
            gap: 3rem;
            background: white;
            border-radius: 10px;
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .profile-image-container {
            flex: 0 0 250px;
            text-align: center;
        }
        
        .profile-image {
            width: 100%;
            max-width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        
        .no-image {
            width: 250px;
            height: 250px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .profile-details {
            flex: 1;
        }
        
        .detail-group {
            margin-bottom: 1.5rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .detail-value {
            font-size: 1.1rem;
            color: #343a40;
            padding-left: 1.75rem;
        }
        
        .actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: 1px solid #3498db;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-outline {
            background-color: transparent;
            color: #3498db;
            border: 1px solid #3498db;
        }
        
        .btn-outline:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .sector-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            background-color: #e3f2fd;
            color: #1976d2;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 141
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 142
        yield "    <div class=\"profile-container\">
        <div class=\"profile-header\">
            <h1 class=\"profile-title\">Profil Entreprise</h1>
            <a href=\"";
        // line 145
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_dashboard");
        yield "\" class=\"btn btn-outline\">
                <i class=\"fas fa-arrow-left\"></i> Retour au tableau de bord
            </a>
        </div>

        <div class=\"profile-content\">
            <div class=\"profile-image-container\">
                ";
        // line 152
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 152, $this->source); })()), "image", [], "any", false, false, false, 152)) {
            // line 153
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/companies/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 153, $this->source); })()), "image", [], "any", false, false, false, 153))), "html", null, true);
            yield "\" alt=\"Logo ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 153, $this->source); })()), "companyName", [], "any", false, false, false, 153), "html", null, true);
            yield "\" class=\"profile-image\">
                ";
        } else {
            // line 155
            yield "                    <div class=\"no-image\">
                        <span>Aucun logo</span>
                    </div>
                ";
        }
        // line 159
        yield "            </div>

            <div class=\"profile-details\">
                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-building\"></i> Nom de l'entreprise
                    </div>
                    <div class=\"detail-value\">";
        // line 166
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 166, $this->source); })()), "companyName", [], "any", false, false, false, 166), "html", null, true);
        yield "</div>
                </div>

                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-map-marker-alt\"></i> Localisation
                    </div>
                    <div class=\"detail-value\">";
        // line 173
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 173, $this->source); })()), "location", [], "any", false, false, false, 173), "html", null, true);
        yield "</div>
                </div>

                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-industry\"></i> Secteur d'activité
                    </div>
                    <div class=\"detail-value\">
                        <span class=\"sector-badge\">";
        // line 181
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 181, $this->source); })()), "secteur", [], "any", false, false, false, 181), "html", null, true);
        yield "</span>
                    </div>
                </div>

                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-envelope\"></i> Email
                    </div>
                    <div class=\"detail-value\">";
        // line 189
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 189, $this->source); })()), "email", [], "any", false, false, false, 189), "html", null, true);
        yield "</div>
                </div>

                <div class=\"actions\">
                    <a href=\"";
        // line 193
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_profile_edit");
        yield "\" class=\"btn btn-primary\">
                        <i class=\"fas fa-edit\"></i> Modifier le profil
                    </a>
                    ";
        // line 196
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 196, $this->source); })()), "image", [], "any", false, false, false, 196)) {
            // line 197
            yield "                        <a href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_profile_delete_image");
            yield "\" class=\"btn btn-outline\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer votre logo ?')\">
                            <i class=\"fas fa-trash-alt\"></i> Supprimer le logo
                        </a>
                    ";
        }
        // line 201
        yield "                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "company/profile.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  356 => 201,  348 => 197,  346 => 196,  340 => 193,  333 => 189,  322 => 181,  311 => 173,  301 => 166,  292 => 159,  286 => 155,  278 => 153,  276 => 152,  266 => 145,  261 => 142,  248 => 141,  102 => 6,  89 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ company.companyName }} - Profil Entreprise | JobConnect{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
        }
        
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .profile-title {
            color: #2c3e50;
            margin: 0;
        }
        
        .profile-content {
            display: flex;
            gap: 3rem;
            background: white;
            border-radius: 10px;
            padding: 2.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .profile-image-container {
            flex: 0 0 250px;
            text-align: center;
        }
        
        .profile-image {
            width: 100%;
            max-width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 1rem;
        }
        
        .no-image {
            width: 250px;
            height: 250px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .profile-details {
            flex: 1;
        }
        
        .detail-group {
            margin-bottom: 1.5rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .detail-value {
            font-size: 1.1rem;
            color: #343a40;
            padding-left: 1.75rem;
        }
        
        .actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: 1px solid #3498db;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-outline {
            background-color: transparent;
            color: #3498db;
            border: 1px solid #3498db;
        }
        
        .btn-outline:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .sector-badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            background-color: #e3f2fd;
            color: #1976d2;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"profile-container\">
        <div class=\"profile-header\">
            <h1 class=\"profile-title\">Profil Entreprise</h1>
            <a href=\"{{ path('company_dashboard') }}\" class=\"btn btn-outline\">
                <i class=\"fas fa-arrow-left\"></i> Retour au tableau de bord
            </a>
        </div>

        <div class=\"profile-content\">
            <div class=\"profile-image-container\">
                {% if company.image %}
                    <img src=\"{{ asset('uploads/companies/' ~ company.image) }}\" alt=\"Logo {{ company.companyName }}\" class=\"profile-image\">
                {% else %}
                    <div class=\"no-image\">
                        <span>Aucun logo</span>
                    </div>
                {% endif %}
            </div>

            <div class=\"profile-details\">
                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-building\"></i> Nom de l'entreprise
                    </div>
                    <div class=\"detail-value\">{{ company.companyName }}</div>
                </div>

                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-map-marker-alt\"></i> Localisation
                    </div>
                    <div class=\"detail-value\">{{ company.location }}</div>
                </div>

                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-industry\"></i> Secteur d'activité
                    </div>
                    <div class=\"detail-value\">
                        <span class=\"sector-badge\">{{ company.secteur }}</span>
                    </div>
                </div>

                <div class=\"detail-group\">
                    <div class=\"detail-label\">
                        <i class=\"fas fa-envelope\"></i> Email
                    </div>
                    <div class=\"detail-value\">{{ company.email }}</div>
                </div>

                <div class=\"actions\">
                    <a href=\"{{ path('company_profile_edit') }}\" class=\"btn btn-primary\">
                        <i class=\"fas fa-edit\"></i> Modifier le profil
                    </a>
                    {% if company.image %}
                        <a href=\"{{ path('company_profile_delete_image') }}\" class=\"btn btn-outline\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer votre logo ?')\">
                            <i class=\"fas fa-trash-alt\"></i> Supprimer le logo
                        </a>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
{% endblock %}", "company/profile.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\company\\profile.html.twig");
    }
}
