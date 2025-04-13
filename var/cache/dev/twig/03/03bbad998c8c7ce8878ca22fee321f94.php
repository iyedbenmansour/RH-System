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

/* candidat/dashboard.html.twig */
class __TwigTemplate_c0c5a9e5c0445ffeac4e490861f21172 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/dashboard.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/dashboard.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "candidat/dashboard.html.twig", 1);
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

        yield "Tableau de Bord Candidat | JobConnect";
        
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
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .dashboard-title h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
            font-size: 2rem;
        }
        
        .welcome-message {
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
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
            background-color: #f1f8fe;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .dashboard-content {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .action-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #3498db;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .action-card h3 {
            color: #2c3e50;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }
        
        .action-card p {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
        }
        
        .mt-2 {
            margin-top: 0.5rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 128
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

        // line 129
        yield "    <div class=\"dashboard-container\">
        <div class=\"dashboard-header\">
            <div class=\"dashboard-title\">
                <h1>Tableau de Bord Candidat</h1>
                <p class=\"welcome-message\">Bienvenue, ";
        // line 133
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 133, $this->source); })()), "name", [], "any", false, false, false, 133), "html", null, true);
        yield " !</p>
            </div>
            <div class=\"dashboard-actions\">
                <a href=\"";
        // line 136
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_profile");
        yield "\" class=\"btn btn-outline\">
                    <i class=\"fas fa-user\"></i> Mon Profil
                </a>
                <a href=\"";
        // line 139
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_logout");
        yield "\" class=\"btn btn-primary\">
                    <i class=\"fas fa-sign-out-alt\"></i> Déconnexion
                </a>
            </div>
        </div>

        <div class=\"dashboard-content\">
            <h2><i class=\"fas fa-tachometer-alt\"></i> Aperçu</h2>
            <p>Gérez vos candidatures et votre profil depuis ce tableau de bord.</p>
            
            <div class=\"quick-actions\">
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-briefcase\"></i> Mes Candidatures</h3>
                    <p>Consultez et gérez toutes vos candidatures en cours</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir mes candidatures</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-search\"></i> Offres d'emploi</h3>
                    <p>Parcourez les nouvelles offres correspondant à votre profil</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les offres</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-chart-line\"></i> Statistiques</h3>
                    <p>Suivez l'évolution de vos candidatures</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir mes stats</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-cog\"></i> Paramètres</h3>
                    <p>Configurez les préférences de votre compte</p>
                    <a href=\"";
        // line 171
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_profile_edit");
        yield "\" class=\"btn btn-outline mt-2\">Modifier mon profil</a>
                </div>
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
        return "candidat/dashboard.html.twig";
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
        return array (  300 => 171,  265 => 139,  259 => 136,  253 => 133,  247 => 129,  234 => 128,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tableau de Bord Candidat | JobConnect{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .dashboard-title h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
            font-size: 2rem;
        }
        
        .welcome-message {
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-top: 0.5rem;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.6rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
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
            background-color: #f1f8fe;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .dashboard-content {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .action-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid #3498db;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        
        .action-card h3 {
            color: #2c3e50;
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.2rem;
        }
        
        .action-card p {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
        }
        
        .mt-2 {
            margin-top: 0.5rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"dashboard-container\">
        <div class=\"dashboard-header\">
            <div class=\"dashboard-title\">
                <h1>Tableau de Bord Candidat</h1>
                <p class=\"welcome-message\">Bienvenue, {{ candidat.name }} !</p>
            </div>
            <div class=\"dashboard-actions\">
                <a href=\"{{ path('candidat_profile') }}\" class=\"btn btn-outline\">
                    <i class=\"fas fa-user\"></i> Mon Profil
                </a>
                <a href=\"{{ path('candidat_logout') }}\" class=\"btn btn-primary\">
                    <i class=\"fas fa-sign-out-alt\"></i> Déconnexion
                </a>
            </div>
        </div>

        <div class=\"dashboard-content\">
            <h2><i class=\"fas fa-tachometer-alt\"></i> Aperçu</h2>
            <p>Gérez vos candidatures et votre profil depuis ce tableau de bord.</p>
            
            <div class=\"quick-actions\">
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-briefcase\"></i> Mes Candidatures</h3>
                    <p>Consultez et gérez toutes vos candidatures en cours</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir mes candidatures</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-search\"></i> Offres d'emploi</h3>
                    <p>Parcourez les nouvelles offres correspondant à votre profil</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les offres</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-chart-line\"></i> Statistiques</h3>
                    <p>Suivez l'évolution de vos candidatures</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir mes stats</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-cog\"></i> Paramètres</h3>
                    <p>Configurez les préférences de votre compte</p>
                    <a href=\"{{ path('candidat_profile_edit') }}\" class=\"btn btn-outline mt-2\">Modifier mon profil</a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}", "candidat/dashboard.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\candidat\\dashboard.html.twig");
    }
}
