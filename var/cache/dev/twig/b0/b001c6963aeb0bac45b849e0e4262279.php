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

/* candidat/register.html.twig */
class __TwigTemplate_c253eb55fdb53349d3b330842428cb30 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/register.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "candidat/register.html.twig", 1);
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

        yield "Candidate Registration | Job Platform";
        
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
        .registration-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c3e50;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
        }
        .btn-primary {
            background-color: #4e73df;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #3a5bc7;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #7f8c8d;
        }
        .login-link a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s;
        }
        .login-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-header h1 {
            color: #4e73df;
            margin-bottom: 0.5rem;
        }
        .form-header p {
            color: #7f8c8d;
        }
        .error-message {
            color: #e74a3b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .password-hint {
            font-size: 0.875rem;
            color: #7f8c8d;
            margin-top: 0.25rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 90
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

        // line 91
        yield "    <div class=\"registration-container\">
        <div class=\"form-header\">
            <h1>Candidate Registration</h1>
            <p>Create your candidate account to start applying for jobs</p>
        </div>

        <form method=\"post\" novalidate>
            <div class=\"form-group\">
                <label for=\"name\">Full Name *</label>
                <input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" required
                       value=\"";
        // line 101
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_name", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_name"]) || array_key_exists("last_name", $context) ? $context["last_name"] : (function () { throw new RuntimeError('Variable "last_name" does not exist.', 101, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                ";
        // line 102
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "name", [], "any", true, true, false, 102)) {
            // line 103
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 103, $this->source); })()), "name", [], "any", false, false, false, 103), "html", null, true);
            yield "</span>
                ";
        }
        // line 105
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"email\">Email Address *</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" required
                       value=\"";
        // line 110
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_email", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_email"]) || array_key_exists("last_email", $context) ? $context["last_email"] : (function () { throw new RuntimeError('Variable "last_email" does not exist.', 110, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                ";
        // line 111
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", true, true, false, 111)) {
            // line 112
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 112, $this->source); })()), "email", [], "any", false, false, false, 112), "html", null, true);
            yield "</span>
                ";
        }
        // line 114
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"password\">Password *</label>
                <input type=\"password\" id=\"password\" name=\"password\" class=\"form-control\" required>
                <span class=\"password-hint\">Minimum 8 characters</span>
                ";
        // line 120
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 120)) {
            // line 121
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 121, $this->source); })()), "password", [], "any", false, false, false, 121), "html", null, true);
            yield "</span>
                ";
        }
        // line 123
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"confirm_password\">Confirm Password *</label>
                <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" class=\"form-control\" required>
                ";
        // line 128
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "confirm_password", [], "any", true, true, false, 128)) {
            // line 129
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 129, $this->source); })()), "confirm_password", [], "any", false, false, false, 129), "html", null, true);
            yield "</span>
                ";
        }
        // line 131
        yield "            </div>

            <div class=\"form-group\">
                <button type=\"submit\" class=\"btn-primary\">Register as Candidate</button>
            </div>

            <div class=\"login-link\">
                Already have an account? <a href=\"";
        // line 138
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_login");
        yield "\">Login here</a>
            </div>
        </form>
    </div>

    <script>
        // Client-side password validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long!');
                return false;
            }
            
            return true;
        });
    </script>
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
        return "candidat/register.html.twig";
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
        return array (  292 => 138,  283 => 131,  277 => 129,  275 => 128,  268 => 123,  262 => 121,  260 => 120,  252 => 114,  246 => 112,  244 => 111,  240 => 110,  233 => 105,  227 => 103,  225 => 102,  221 => 101,  209 => 91,  196 => 90,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Candidate Registration | Job Platform{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .registration-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c3e50;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
        }
        .btn-primary {
            background-color: #4e73df;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #3a5bc7;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: #7f8c8d;
        }
        .login-link a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s;
        }
        .login-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-header h1 {
            color: #4e73df;
            margin-bottom: 0.5rem;
        }
        .form-header p {
            color: #7f8c8d;
        }
        .error-message {
            color: #e74a3b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .password-hint {
            font-size: 0.875rem;
            color: #7f8c8d;
            margin-top: 0.25rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"registration-container\">
        <div class=\"form-header\">
            <h1>Candidate Registration</h1>
            <p>Create your candidate account to start applying for jobs</p>
        </div>

        <form method=\"post\" novalidate>
            <div class=\"form-group\">
                <label for=\"name\">Full Name *</label>
                <input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" required
                       value=\"{{ last_name|default('') }}\">
                {% if errors.name is defined %}
                    <span class=\"error-message\">{{ errors.name }}</span>
                {% endif %}
            </div>

            <div class=\"form-group\">
                <label for=\"email\">Email Address *</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" required
                       value=\"{{ last_email|default('') }}\">
                {% if errors.email is defined %}
                    <span class=\"error-message\">{{ errors.email }}</span>
                {% endif %}
            </div>

            <div class=\"form-group\">
                <label for=\"password\">Password *</label>
                <input type=\"password\" id=\"password\" name=\"password\" class=\"form-control\" required>
                <span class=\"password-hint\">Minimum 8 characters</span>
                {% if errors.password is defined %}
                    <span class=\"error-message\">{{ errors.password }}</span>
                {% endif %}
            </div>

            <div class=\"form-group\">
                <label for=\"confirm_password\">Confirm Password *</label>
                <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" class=\"form-control\" required>
                {% if errors.confirm_password is defined %}
                    <span class=\"error-message\">{{ errors.confirm_password }}</span>
                {% endif %}
            </div>

            <div class=\"form-group\">
                <button type=\"submit\" class=\"btn-primary\">Register as Candidate</button>
            </div>

            <div class=\"login-link\">
                Already have an account? <a href=\"{{ path('candidat_login') }}\">Login here</a>
            </div>
        </form>
    </div>

    <script>
        // Client-side password validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
            
            if (password.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long!');
                return false;
            }
            
            return true;
        });
    </script>
{% endblock %}", "candidat/register.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\candidat\\register.html.twig");
    }
}
