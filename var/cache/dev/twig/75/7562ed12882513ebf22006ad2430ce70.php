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

/* company/dashboard.html.twig */
class __TwigTemplate_4dca9362a31553bf8312095738dadf99 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/dashboard.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/dashboard.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "company/dashboard.html.twig", 1);
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

        yield "Tableau de bord Entreprise | JobConnect";
        
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
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .dashboard-title h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
        }
        
        .welcome-message {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1.5rem;
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
        
        .dashboard-content {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-top: 2rem;
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
            transition: transform 0.3s;
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
        }
        
        .action-card p {
            color: #7f8c8d;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 117
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

        // line 118
        yield "    <div class=\"dashboard-container\">
        <div class=\"dashboard-header\">
            <div class=\"dashboard-title\">
                <h1>Tableau de bord Entreprise</h1>
                <p class=\"welcome-message\">Bienvenue, ";
        // line 122
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 122, $this->source); })()), "companyName", [], "any", false, false, false, 122), "html", null, true);
        yield "!</p>
            </div>
            <div class=\"dashboard-actions\">
                <a href=\"";
        // line 125
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_profile");
        yield "\" class=\"btn btn-outline\">
                    <i class=\"fas fa-user\"></i> Mon Profil
                </a>
                <a href=\"";
        // line 128
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_logout");
        yield "\" class=\"btn btn-primary\">
                    <i class=\"fas fa-sign-out-alt\"></i> Déconnexion
                </a>
            </div>
        </div>

        <div class=\"dashboard-content\">
            <h2><i class=\"fas fa-tachometer-alt\"></i> Aperçu</h2>
            <p>Gérez votre entreprise et vos offres d'emploi depuis ce tableau de bord.</p>
            
            <div class=\"quick-actions\">
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-briefcase\"></i> Offres d'emploi</h3>
                    <p>Créez et gérez vos offres d'emploi publiées</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les offres</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-users\"></i> Candidats</h3>
                    <p>Consultez les candidatures reçues</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les candidats</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-chart-line\"></i> Statistiques</h3>
                    <p>Analysez les performances de vos offres</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les stats</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-cog\"></i> Paramètres</h3>
                    <p>Configurez les préférences de votre compte</p>
                    <a href=\"";
        // line 160
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_profile_edit");
        yield "\" class=\"btn btn-outline mt-2\">Modifier le profil</a>
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
        return "company/dashboard.html.twig";
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
        return array (  289 => 160,  254 => 128,  248 => 125,  242 => 122,  236 => 118,  223 => 117,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tableau de bord Entreprise | JobConnect{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .dashboard-title h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
        }
        
        .welcome-message {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        .dashboard-actions {
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1.5rem;
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
        
        .dashboard-content {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-top: 2rem;
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
            transition: transform 0.3s;
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
        }
        
        .action-card p {
            color: #7f8c8d;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"dashboard-container\">
        <div class=\"dashboard-header\">
            <div class=\"dashboard-title\">
                <h1>Tableau de bord Entreprise</h1>
                <p class=\"welcome-message\">Bienvenue, {{ company.companyName }}!</p>
            </div>
            <div class=\"dashboard-actions\">
                <a href=\"{{ path('company_profile') }}\" class=\"btn btn-outline\">
                    <i class=\"fas fa-user\"></i> Mon Profil
                </a>
                <a href=\"{{ path('company_logout') }}\" class=\"btn btn-primary\">
                    <i class=\"fas fa-sign-out-alt\"></i> Déconnexion
                </a>
            </div>
        </div>

        <div class=\"dashboard-content\">
            <h2><i class=\"fas fa-tachometer-alt\"></i> Aperçu</h2>
            <p>Gérez votre entreprise et vos offres d'emploi depuis ce tableau de bord.</p>
            
            <div class=\"quick-actions\">
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-briefcase\"></i> Offres d'emploi</h3>
                    <p>Créez et gérez vos offres d'emploi publiées</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les offres</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-users\"></i> Candidats</h3>
                    <p>Consultez les candidatures reçues</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les candidats</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-chart-line\"></i> Statistiques</h3>
                    <p>Analysez les performances de vos offres</p>
                    <a href=\"#\" class=\"btn btn-outline mt-2\">Voir les stats</a>
                </div>
                
                <div class=\"action-card\">
                    <h3><i class=\"fas fa-cog\"></i> Paramètres</h3>
                    <p>Configurez les préférences de votre compte</p>
                    <a href=\"{{ path('company_profile_edit') }}\" class=\"btn btn-outline mt-2\">Modifier le profil</a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}", "company/dashboard.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\company\\dashboard.html.twig");
    }
}
