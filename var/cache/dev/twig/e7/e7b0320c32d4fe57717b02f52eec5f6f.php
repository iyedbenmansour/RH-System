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

/* company/register.html.twig */
class __TwigTemplate_1b4f93ff87ad88a6f19e3623d632c2eb extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/register.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/register.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "company/register.html.twig", 1);
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

        yield "Company Registration | Job Platform";
        
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
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
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
        }
        .btn-primary:hover {
            background-color: #3a5bc7;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-header h1 {
            color: #4e73df;
            margin-bottom: 0.5rem;
        }
        .error-message {
            color: #e74a3b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 64
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

        // line 65
        yield "    <div class=\"registration-container\">
        <div class=\"form-header\">
            <h1>Company Registration</h1>
            <p>Create your company account to start posting jobs</p>
        </div>

        <form method=\"post\" novalidate>
            <div class=\"form-group\">
                <label for=\"companyName\">Company Name *</label>
                <input type=\"text\" id=\"companyName\" name=\"companyName\" class=\"form-control\" required
                       value=\"";
        // line 75
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_company_name", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_company_name"]) || array_key_exists("last_company_name", $context) ? $context["last_company_name"] : (function () { throw new RuntimeError('Variable "last_company_name" does not exist.', 75, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                ";
        // line 76
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "companyName", [], "any", true, true, false, 76)) {
            // line 77
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 77, $this->source); })()), "companyName", [], "any", false, false, false, 77), "html", null, true);
            yield "</span>
                ";
        }
        // line 79
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"location\">Location *</label>
                <input type=\"text\" id=\"location\" name=\"location\" class=\"form-control\" required
                       value=\"";
        // line 84
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_location", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_location"]) || array_key_exists("last_location", $context) ? $context["last_location"] : (function () { throw new RuntimeError('Variable "last_location" does not exist.', 84, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                ";
        // line 85
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "location", [], "any", true, true, false, 85)) {
            // line 86
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 86, $this->source); })()), "location", [], "any", false, false, false, 86), "html", null, true);
            yield "</span>
                ";
        }
        // line 88
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"secteur\">Industry Sector *</label>
                <select id=\"secteur\" name=\"secteur\" class=\"form-control\" required>
                    <option value=\"\">Select your sector</option>
                    <option value=\"IT\" ";
        // line 94
        if ((((array_key_exists("last_secteur", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_secteur"]) || array_key_exists("last_secteur", $context) ? $context["last_secteur"] : (function () { throw new RuntimeError('Variable "last_secteur" does not exist.', 94, $this->source); })()), "")) : ("")) == "IT")) {
            yield "selected";
        }
        yield ">Information Technology</option>
                    <option value=\"Finance\" ";
        // line 95
        if ((((array_key_exists("last_secteur", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_secteur"]) || array_key_exists("last_secteur", $context) ? $context["last_secteur"] : (function () { throw new RuntimeError('Variable "last_secteur" does not exist.', 95, $this->source); })()), "")) : ("")) == "Finance")) {
            yield "selected";
        }
        yield ">Finance</option>
                    <option value=\"Healthcare\" ";
        // line 96
        if ((((array_key_exists("last_secteur", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_secteur"]) || array_key_exists("last_secteur", $context) ? $context["last_secteur"] : (function () { throw new RuntimeError('Variable "last_secteur" does not exist.', 96, $this->source); })()), "")) : ("")) == "Healthcare")) {
            yield "selected";
        }
        yield ">Healthcare</option>
                    <option value=\"Education\" ";
        // line 97
        if ((((array_key_exists("last_secteur", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_secteur"]) || array_key_exists("last_secteur", $context) ? $context["last_secteur"] : (function () { throw new RuntimeError('Variable "last_secteur" does not exist.', 97, $this->source); })()), "")) : ("")) == "Education")) {
            yield "selected";
        }
        yield ">Education</option>
                    <option value=\"Manufacturing\" ";
        // line 98
        if ((((array_key_exists("last_secteur", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_secteur"]) || array_key_exists("last_secteur", $context) ? $context["last_secteur"] : (function () { throw new RuntimeError('Variable "last_secteur" does not exist.', 98, $this->source); })()), "")) : ("")) == "Manufacturing")) {
            yield "selected";
        }
        yield ">Manufacturing</option>
                    <option value=\"Other\" ";
        // line 99
        if ((((array_key_exists("last_secteur", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_secteur"]) || array_key_exists("last_secteur", $context) ? $context["last_secteur"] : (function () { throw new RuntimeError('Variable "last_secteur" does not exist.', 99, $this->source); })()), "")) : ("")) == "Other")) {
            yield "selected";
        }
        yield ">Other</option>
                </select>
                ";
        // line 101
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "secteur", [], "any", true, true, false, 101)) {
            // line 102
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 102, $this->source); })()), "secteur", [], "any", false, false, false, 102), "html", null, true);
            yield "</span>
                ";
        }
        // line 104
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"email\">Email Address *</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" required
                       value=\"";
        // line 109
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("last_email", $context)) ? (Twig\Extension\CoreExtension::default((isset($context["last_email"]) || array_key_exists("last_email", $context) ? $context["last_email"] : (function () { throw new RuntimeError('Variable "last_email" does not exist.', 109, $this->source); })()), "")) : ("")), "html", null, true);
        yield "\">
                ";
        // line 110
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "email", [], "any", true, true, false, 110)) {
            // line 111
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 111, $this->source); })()), "email", [], "any", false, false, false, 111), "html", null, true);
            yield "</span>
                ";
        }
        // line 113
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"password\">Password *</label>
                <input type=\"password\" id=\"password\" name=\"password\" class=\"form-control\" required>
                <small class=\"text-muted\">Minimum 8 characters</small>
                ";
        // line 119
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "password", [], "any", true, true, false, 119)) {
            // line 120
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 120, $this->source); })()), "password", [], "any", false, false, false, 120), "html", null, true);
            yield "</span>
                ";
        }
        // line 122
        yield "            </div>

            <div class=\"form-group\">
                <label for=\"confirm_password\">Confirm Password *</label>
                <input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" class=\"form-control\" required>
                ";
        // line 127
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "confirm_password", [], "any", true, true, false, 127)) {
            // line 128
            yield "                    <span class=\"error-message\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 128, $this->source); })()), "confirm_password", [], "any", false, false, false, 128), "html", null, true);
            yield "</span>
                ";
        }
        // line 130
        yield "            </div>

            <div class=\"form-group\">
                <button type=\"submit\" class=\"btn-primary\">Register Company</button>
            </div>

            <div class=\"login-link\">
                Already have an account? <a href=\"";
        // line 137
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_login");
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
        return "company/register.html.twig";
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
        return array (  338 => 137,  329 => 130,  323 => 128,  321 => 127,  314 => 122,  308 => 120,  306 => 119,  298 => 113,  292 => 111,  290 => 110,  286 => 109,  279 => 104,  273 => 102,  271 => 101,  264 => 99,  258 => 98,  252 => 97,  246 => 96,  240 => 95,  234 => 94,  226 => 88,  220 => 86,  218 => 85,  214 => 84,  207 => 79,  201 => 77,  199 => 76,  195 => 75,  183 => 65,  170 => 64,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Company Registration | Job Platform{% endblock %}

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
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
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
        }
        .btn-primary:hover {
            background-color: #3a5bc7;
        }
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-header h1 {
            color: #4e73df;
            margin-bottom: 0.5rem;
        }
        .error-message {
            color: #e74a3b;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"registration-container\">
        <div class=\"form-header\">
            <h1>Company Registration</h1>
            <p>Create your company account to start posting jobs</p>
        </div>

        <form method=\"post\" novalidate>
            <div class=\"form-group\">
                <label for=\"companyName\">Company Name *</label>
                <input type=\"text\" id=\"companyName\" name=\"companyName\" class=\"form-control\" required
                       value=\"{{ last_company_name|default('') }}\">
                {% if errors.companyName is defined %}
                    <span class=\"error-message\">{{ errors.companyName }}</span>
                {% endif %}
            </div>

            <div class=\"form-group\">
                <label for=\"location\">Location *</label>
                <input type=\"text\" id=\"location\" name=\"location\" class=\"form-control\" required
                       value=\"{{ last_location|default('') }}\">
                {% if errors.location is defined %}
                    <span class=\"error-message\">{{ errors.location }}</span>
                {% endif %}
            </div>

            <div class=\"form-group\">
                <label for=\"secteur\">Industry Sector *</label>
                <select id=\"secteur\" name=\"secteur\" class=\"form-control\" required>
                    <option value=\"\">Select your sector</option>
                    <option value=\"IT\" {% if last_secteur|default('') == 'IT' %}selected{% endif %}>Information Technology</option>
                    <option value=\"Finance\" {% if last_secteur|default('') == 'Finance' %}selected{% endif %}>Finance</option>
                    <option value=\"Healthcare\" {% if last_secteur|default('') == 'Healthcare' %}selected{% endif %}>Healthcare</option>
                    <option value=\"Education\" {% if last_secteur|default('') == 'Education' %}selected{% endif %}>Education</option>
                    <option value=\"Manufacturing\" {% if last_secteur|default('') == 'Manufacturing' %}selected{% endif %}>Manufacturing</option>
                    <option value=\"Other\" {% if last_secteur|default('') == 'Other' %}selected{% endif %}>Other</option>
                </select>
                {% if errors.secteur is defined %}
                    <span class=\"error-message\">{{ errors.secteur }}</span>
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
                <small class=\"text-muted\">Minimum 8 characters</small>
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
                <button type=\"submit\" class=\"btn-primary\">Register Company</button>
            </div>

            <div class=\"login-link\">
                Already have an account? <a href=\"{{ path('company_login') }}\">Login here</a>
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
{% endblock %}", "company/register.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\company\\register.html.twig");
    }
}
