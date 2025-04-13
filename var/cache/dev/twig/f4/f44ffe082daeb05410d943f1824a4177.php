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

/* candidat/profile.html.twig */
class __TwigTemplate_7d44e650e8a62fe73459006a2adafae9 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/profile.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/profile.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "candidat/profile.html.twig", 1);
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

        yield "Mon Profil Candidat | JobConnect";
        
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
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 2rem;
            border: 5px solid #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .profile-info h1 {
            color: #2c3e50;
            margin: 0 0 0.5rem 0;
            font-weight: 700;
        }
        
        .profile-details {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .detail-item {
            margin-bottom: 1.5rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: #7f8c8d;
            display: block;
            margin-bottom: 0.3rem;
        }
        
        .detail-value {
            font-size: 1.1rem;
            color: #2c3e50;
        }
        
        .btn-edit {
            display: inline-flex;
            align-items: center;
            padding: 0.7rem 1.5rem;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            margin-top: 1rem;
            margin-right: 1rem;
        }
        
        .btn-edit:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 0.7rem 1.5rem;
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-edit i, .btn-back i {
            margin-right: 0.5rem;
        }
        
        .no-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2rem;
            color: #6c757d;
            font-size: 3rem;
        }
        
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 129
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

        // line 130
        yield "    <div class=\"profile-container\">
        <div class=\"profile-header\">
            ";
        // line 132
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 132, $this->source); })()), "image", [], "any", false, false, false, 132)) {
            // line 133
            yield "                <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/candidats/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 133, $this->source); })()), "image", [], "any", false, false, false, 133))), "html", null, true);
            yield "\" alt=\"Photo de profil\" class=\"profile-image\">
            ";
        } else {
            // line 135
            yield "                <div class=\"no-image\">
                    <i class=\"fas fa-user\"></i>
                </div>
            ";
        }
        // line 139
        yield "            <div class=\"profile-info\">
                <h1>";
        // line 140
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 140, $this->source); })()), "name", [], "any", false, false, false, 140), "html", null, true);
        yield "</h1>
                <p>Candidat</p>
            </div>
        </div>
        
        <div class=\"profile-details\">
            <div class=\"detail-item\">
                <span class=\"detail-label\">Email</span>
                <span class=\"detail-value\">";
        // line 148
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 148, $this->source); })()), "email", [], "any", false, false, false, 148), "html", null, true);
        yield "</span>
            </div>
            
            <!-- Vous pouvez ajouter d'autres informations ici -->
            ";
        // line 163
        yield "            
            <div class=\"action-buttons\">
                <a href=\"";
        // line 165
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_profile_edit");
        yield "\" class=\"btn-edit\">
                    <i class=\"fas fa-edit\"></i> Modifier le profil
                </a>
                <a href=\"";
        // line 168
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_dashboard");
        yield "\" class=\"btn-back\">
                    <i class=\"fas fa-tachometer-alt\"></i> Retour au dashboard
                </a>
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
        return "candidat/profile.html.twig";
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
        return array (  297 => 168,  291 => 165,  287 => 163,  280 => 148,  269 => 140,  266 => 139,  260 => 135,  254 => 133,  252 => 132,  248 => 130,  235 => 129,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Mon Profil Candidat | JobConnect{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 2rem;
            border: 5px solid #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        
        .profile-info h1 {
            color: #2c3e50;
            margin: 0 0 0.5rem 0;
            font-weight: 700;
        }
        
        .profile-details {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .detail-item {
            margin-bottom: 1.5rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: #7f8c8d;
            display: block;
            margin-bottom: 0.3rem;
        }
        
        .detail-value {
            font-size: 1.1rem;
            color: #2c3e50;
        }
        
        .btn-edit {
            display: inline-flex;
            align-items: center;
            padding: 0.7rem 1.5rem;
            background-color: #3498db;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            margin-top: 1rem;
            margin-right: 1rem;
        }
        
        .btn-edit:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 0.7rem 1.5rem;
            background-color: #6c757d;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        
        .btn-back:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .btn-edit i, .btn-back i {
            margin-right: 0.5rem;
        }
        
        .no-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 2rem;
            color: #6c757d;
            font-size: 3rem;
        }
        
        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"profile-container\">
        <div class=\"profile-header\">
            {% if candidat.image %}
                <img src=\"{{ asset('uploads/candidats/' ~ candidat.image) }}\" alt=\"Photo de profil\" class=\"profile-image\">
            {% else %}
                <div class=\"no-image\">
                    <i class=\"fas fa-user\"></i>
                </div>
            {% endif %}
            <div class=\"profile-info\">
                <h1>{{ candidat.name }}</h1>
                <p>Candidat</p>
            </div>
        </div>
        
        <div class=\"profile-details\">
            <div class=\"detail-item\">
                <span class=\"detail-label\">Email</span>
                <span class=\"detail-value\">{{ candidat.email }}</span>
            </div>
            
            <!-- Vous pouvez ajouter d'autres informations ici -->
            {#
            <div class=\"detail-item\">
                <span class=\"detail-label\">Téléphone</span>
                <span class=\"detail-value\">{{ candidat.phone ?? 'Non renseigné' }}</span>
            </div>
            
            <div class=\"detail-item\">
                <span class=\"detail-label\">Adresse</span>
                <span class=\"detail-value\">{{ candidat.address ?? 'Non renseignée' }}</span>
            </div>
            #}
            
            <div class=\"action-buttons\">
                <a href=\"{{ path('candidat_profile_edit') }}\" class=\"btn-edit\">
                    <i class=\"fas fa-edit\"></i> Modifier le profil
                </a>
                <a href=\"{{ path('candidat_dashboard') }}\" class=\"btn-back\">
                    <i class=\"fas fa-tachometer-alt\"></i> Retour au dashboard
                </a>
            </div>
        </div>
    </div>
{% endblock %}", "candidat/profile.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\candidat\\profile.html.twig");
    }
}
