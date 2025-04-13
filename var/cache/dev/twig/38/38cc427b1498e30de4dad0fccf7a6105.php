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

/* admin/login.html.twig */
class __TwigTemplate_ba9e4276032fbdf170caf1e484321ca1 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/login.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/login.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/login.html.twig", 1);
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

        yield "Admin Login | Job Platform";
        
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
        .login-container {
            max-width: 500px;
            margin: 3rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h1 {
            color:rgb(34, 181, 255);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .login-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color:rgb(56, 141, 252);
            box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background-color:rgb(36, 165, 250);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color:rgb(36, 165, 235);
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            text-align: center;
            border: 1px solid #f5c2c7;
        }
        .admin-notice {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 94
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

        // line 95
        yield "    <div class=\"login-container\">
        <div class=\"login-header\">
            <h1>Admin Login</h1>
            <p>Administrator access only</p>
        </div>

        

        <form method=\"post\">
            <div class=\"form-group\">
                <label for=\"email\">Admin Email</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" 
                       value=\"";
        // line 107
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_username", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_username"]) || array_key_exists("last_username", $context) ? $context["last_username"] : (function () { throw new RuntimeError('Variable "last_username" does not exist.', 107, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\" required autofocus>
            </div>

            <div class=\"form-group\">
                <label for=\"password\">Password</label>
                <div class=\"password-container\">
                    <input type=\"password\" id=\"password\" name=\"password\" class=\"form-control\" required>
                    <span class=\"toggle-password\" onclick=\"togglePasswordVisibility()\">👁️</span>
                </div>
            </div>

            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 118
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken("authenticate"), "html", null, true);
        yield "\">

            <button type=\"submit\" class=\"btn-login\">
                <i class=\"fas fa-sign-in-alt\"></i> Login
            </button>
        </form>

        <div class=\"admin-notice\">
            <p>Restricted access. Unauthorized attempts are prohibited.</p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Auto-focus logic
        document.addEventListener('DOMContentLoaded', function() {
            const emailField = document.getElementById('email');
            if (!emailField.value) {
                emailField.focus();
            }
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
        return "admin/login.html.twig";
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
        return array (  241 => 118,  227 => 107,  213 => 95,  200 => 94,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Admin Login | Job Platform{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .login-container {
            max-width: 500px;
            margin: 3rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-header h1 {
            color:rgb(34, 181, 255);
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .login-header p {
            color: #6c757d;
            font-size: 1.1rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color:rgb(56, 141, 252);
            box-shadow: 0 0 0 3px rgba(214, 51, 132, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background-color:rgb(36, 165, 250);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-login:hover {
            background-color:rgb(36, 165, 235);
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }
        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            text-align: center;
            border: 1px solid #f5c2c7;
        }
        .admin-notice {
            text-align: center;
            margin-top: 1.5rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"login-container\">
        <div class=\"login-header\">
            <h1>Admin Login</h1>
            <p>Administrator access only</p>
        </div>

        

        <form method=\"post\">
            <div class=\"form-group\">
                <label for=\"email\">Admin Email</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" 
                       value=\"{{ last_username|default('') }}\" required autofocus>
            </div>

            <div class=\"form-group\">
                <label for=\"password\">Password</label>
                <div class=\"password-container\">
                    <input type=\"password\" id=\"password\" name=\"password\" class=\"form-control\" required>
                    <span class=\"toggle-password\" onclick=\"togglePasswordVisibility()\">👁️</span>
                </div>
            </div>

            <input type=\"hidden\" name=\"_csrf_token\" value=\"{{ csrf_token('authenticate') }}\">

            <button type=\"submit\" class=\"btn-login\">
                <i class=\"fas fa-sign-in-alt\"></i> Login
            </button>
        </form>

        <div class=\"admin-notice\">
            <p>Restricted access. Unauthorized attempts are prohibited.</p>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Auto-focus logic
        document.addEventListener('DOMContentLoaded', function() {
            const emailField = document.getElementById('email');
            if (!emailField.value) {
                emailField.focus();
            }
        });
    </script>
{% endblock %}", "admin/login.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\admin\\login.html.twig");
    }
}
