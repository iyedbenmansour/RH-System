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

/* admin/edit_profile.html.twig */
class __TwigTemplate_616edf204008a0d4924dfaa70950eea6 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/edit_profile.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/edit_profile.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/edit_profile.html.twig", 1);
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

        yield "Edit Admin Profile";
        
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
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .profile-img {
            display: block;
            margin: 1rem auto;
            max-width: 150px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 68
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

        // line 69
        yield "    <div class=\"profile-container\">
        <h1>Edit Admin Profile</h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <label for=\"name\">Name:</label>
                <input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" value=\"";
        // line 74
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 74, $this->source); })()), "name", [], "any", false, false, false, 74), "html", null, true);
        yield "\" required>
            </div>

            <div class=\"form-group\">
                <label for=\"email\">Email:</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" value=\"";
        // line 79
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 79, $this->source); })()), "email", [], "any", false, false, false, 79), "html", null, true);
        yield "\" required>
            </div>

            <div class=\"form-group\">
                <label for=\"image\">Profile Image:</label>
                <input type=\"file\" id=\"image\" name=\"image\" class=\"form-control-file\">
                ";
        // line 85
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 85, $this->source); })()), "image", [], "any", false, false, false, 85)) {
            // line 86
            yield "                    <div class=\"text-center\">
                        <img src=\"";
            // line 87
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/admins/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["admin"]) || array_key_exists("admin", $context) ? $context["admin"] : (function () { throw new RuntimeError('Variable "admin" does not exist.', 87, $this->source); })()), "image", [], "any", false, false, false, 87))), "html", null, true);
            yield "\" alt=\"Profile Image\" class=\"profile-img\">
                        <br>
                        <a href=\"";
            // line 89
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile_delete_image");
            yield "\" class=\"btn btn-danger btn-sm mt-2\" onclick=\"return confirm('Are you sure you want to delete your profile image?')\">
                            Delete Image
                        </a>
                    </div>
                ";
        }
        // line 94
        yield "            </div>

            <button type=\"submit\" class=\"btn btn-primary\">Update Profile</button>
        </form>

        <div class=\"text-center mt-3\">
            <a href=\"";
        // line 100
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile");
        yield "\" class=\"btn btn-secondary\">Back to Profile</a>
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
        return "admin/edit_profile.html.twig";
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
        return array (  237 => 100,  229 => 94,  221 => 89,  216 => 87,  213 => 86,  211 => 85,  202 => 79,  194 => 74,  187 => 69,  174 => 68,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Edit Admin Profile{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .profile-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .profile-img {
            display: block;
            margin: 1rem auto;
            max-width: 150px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            border-radius: 4px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"profile-container\">
        <h1>Edit Admin Profile</h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <label for=\"name\">Name:</label>
                <input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" value=\"{{ admin.name }}\" required>
            </div>

            <div class=\"form-group\">
                <label for=\"email\">Email:</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" value=\"{{ admin.email }}\" required>
            </div>

            <div class=\"form-group\">
                <label for=\"image\">Profile Image:</label>
                <input type=\"file\" id=\"image\" name=\"image\" class=\"form-control-file\">
                {% if admin.image %}
                    <div class=\"text-center\">
                        <img src=\"{{ asset('uploads/admins/' ~ admin.image) }}\" alt=\"Profile Image\" class=\"profile-img\">
                        <br>
                        <a href=\"{{ path('admin_profile_delete_image') }}\" class=\"btn btn-danger btn-sm mt-2\" onclick=\"return confirm('Are you sure you want to delete your profile image?')\">
                            Delete Image
                        </a>
                    </div>
                {% endif %}
            </div>

            <button type=\"submit\" class=\"btn btn-primary\">Update Profile</button>
        </form>

        <div class=\"text-center mt-3\">
            <a href=\"{{ path('admin_profile') }}\" class=\"btn btn-secondary\">Back to Profile</a>
        </div>
    </div>
{% endblock %}
", "admin/edit_profile.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\admin\\edit_profile.html.twig");
    }
}
