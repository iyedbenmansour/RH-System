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

/* admin/profile.html.twig */
class __TwigTemplate_1d5c9b387334fddb77642a259fed7ea4 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/profile.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/profile.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/profile.html.twig", 1);
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

        yield "Admin Profile | Job Platform";
        
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
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        .profile-header h1 {
            color: rgb(51, 151, 214);
            margin: 0;
        }
        .profile-content {
            display: flex;
            gap: 3rem;
        }
        .profile-image {
            flex: 0 0 200px;
        }
        .profile-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .profile-details {
            flex: 1;
        }
        .detail-item {
            margin-bottom: 1.5rem;
        }
        .detail-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        .detail-value {
            font-size: 1.1rem;
            color: #343a40;
        }
        .btn-edit {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background-color:rgb(51, 151, 214);
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }
        .btn-edit:hover {
            background-color: #b02a6f;
        }
        .no-image {
            width: 200px;
            height: 200px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 81
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

        // line 82
        yield "    <div class=\"profile-container\">
        <div class=\"profile-header\">
            <h1>Admin Profile</h1>
            <a href=\"";
        // line 85
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_dashboard");
        yield "\" class=\"btn btn-outline\">Back to Dashboard</a>
        </div>

        <div class=\"profile-content\">
            <div class=\"profile-image\">
                ";
        // line 90
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 90, $this->source); })()), "image", [], "any", false, false, false, 90)) {
            // line 91
            yield "                    <img src=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/admins/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 91, $this->source); })()), "image", [], "any", false, false, false, 91))), "html", null, true);
            yield "\" alt=\"Profile Image\">
                ";
        } else {
            // line 93
            yield "                    <div class=\"no-image\">
                        <span>No Image</span>
                    </div>
                ";
        }
        // line 97
        yield "            </div>

            <div class=\"profile-details\">
                <div class=\"detail-item\">
                    <div class=\"detail-label\">Full Name</div>
                    <div class=\"detail-value\">";
        // line 102
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 102, $this->source); })()), "name", [], "any", false, false, false, 102), "html", null, true);
        yield "</div>
                </div>

                <div class=\"detail-item\">
                    <div class=\"detail-label\">Email Address</div>
                    <div class=\"detail-value\">";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 107, $this->source); })()), "email", [], "any", false, false, false, 107), "html", null, true);
        yield "</div>
                </div>

                <div class=\"detail-item\">
                    <div class=\"detail-label\">Account Type</div>
                    <div class=\"detail-value\">Administrator</div>
                </div>

                

                <a href=\"";
        // line 117
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile_edit");
        yield "\" class=\"btn-edit\">
                    <i class=\"fas fa-edit\"></i> Edit Profile
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
        return "admin/profile.html.twig";
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
        return array (  255 => 117,  242 => 107,  234 => 102,  227 => 97,  221 => 93,  215 => 91,  213 => 90,  205 => 85,  200 => 82,  187 => 81,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Admin Profile | Job Platform{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        .profile-header h1 {
            color: rgb(51, 151, 214);
            margin: 0;
        }
        .profile-content {
            display: flex;
            gap: 3rem;
        }
        .profile-image {
            flex: 0 0 200px;
        }
        .profile-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .profile-details {
            flex: 1;
        }
        .detail-item {
            margin-bottom: 1.5rem;
        }
        .detail-label {
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }
        .detail-value {
            font-size: 1.1rem;
            color: #343a40;
        }
        .btn-edit {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background-color:rgb(51, 151, 214);
            color: white;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }
        .btn-edit:hover {
            background-color: #b02a6f;
        }
        .no-image {
            width: 200px;
            height: 200px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"profile-container\">
        <div class=\"profile-header\">
            <h1>Admin Profile</h1>
            <a href=\"{{ path('admin_dashboard') }}\" class=\"btn btn-outline\">Back to Dashboard</a>
        </div>

        <div class=\"profile-content\">
            <div class=\"profile-image\">
                {% if admin.image %}
                    <img src=\"{{ asset('uploads/admins/' ~ admin.image) }}\" alt=\"Profile Image\">
                {% else %}
                    <div class=\"no-image\">
                        <span>No Image</span>
                    </div>
                {% endif %}
            </div>

            <div class=\"profile-details\">
                <div class=\"detail-item\">
                    <div class=\"detail-label\">Full Name</div>
                    <div class=\"detail-value\">{{ admin.name }}</div>
                </div>

                <div class=\"detail-item\">
                    <div class=\"detail-label\">Email Address</div>
                    <div class=\"detail-value\">{{ admin.email }}</div>
                </div>

                <div class=\"detail-item\">
                    <div class=\"detail-label\">Account Type</div>
                    <div class=\"detail-value\">Administrator</div>
                </div>

                

                <a href=\"{{ path('admin_profile_edit') }}\" class=\"btn-edit\">
                    <i class=\"fas fa-edit\"></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
{% endblock %}", "admin/profile.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\admin\\profile.html.twig");
    }
}
