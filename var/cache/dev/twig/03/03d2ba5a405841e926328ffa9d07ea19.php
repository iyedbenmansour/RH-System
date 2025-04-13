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

/* admin/dashboard.html.twig */
class __TwigTemplate_23ac4c19e8de70ebb5387703d45c3546 extends Template
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
            'stylesheet' => [$this, 'block_stylesheet'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "admin/dashboard.html.twig", 1);
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

        yield "Admin Dashboard | Career Bridge";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheet(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheet"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheet"));

        // line 6
        yield "    ";
        yield from $this->yieldParentBlock("stylesheet", $context, $blocks);
        yield "
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
    <style>
        .dashboard-content {
            padding: 1.5rem;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #dee2e6;
        }

        .dashboard-title h1 {
            color: var(--primary-color);
            margin: 0;
        }

        .dashboard-actions a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            opacity: 0.9;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            margin-right: 0.5rem;
        }

        .btn-outline:hover {
            background-color: rgba(78, 115, 223, 0.1);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: var(--secondary-color);
            margin-top: 0;
            font-size: 1rem;
        }

        .stat-card p {
            font-size: 2rem;
            margin: 0.5rem 0 0;
            color: var(--dark-color);
            font-weight: 600;
        }

        .stat-card p i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .recent-activity {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .activity-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item p {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .activity-item small {
            color: var(--secondary-color);
            font-size: 0.8rem;
            margin-left: 1.5rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 126
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

        // line 127
        yield "    <div class=\"main-content\">
        <header class=\"header\">
            <div class=\"d-flex justify-content-between align-items-center\">
                <button type=\"button\" class=\"btn btn-link text-dark p-0\" id=\"vertical-menu-btn\">
                    <i class=\"bx bx-menu font-size-24\"></i>
                </button>

                <div class=\"user-profile\">
                    <img src=\"";
        // line 135
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/images/users/avatar-1.jpg"), "html", null, true);
        yield "\" alt=\"Header Avatar\">
                    <div class=\"dropdown\">
                        <button class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                            <span class=\"d-none d-xl-inline-block ms-1\">Admin</span>
                            <i class=\"bx bx-chevron-down\"></i>
                        </button>
                        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                            <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-user\"></i> Profile</a></li>
                            <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-cog\"></i> Settings</a></li>
                            <li><hr class=\"dropdown-divider\"></li>
                            <li><a class=\"dropdown-item text-danger\" href=\"#\"><i class=\"bx bx-power-off\"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class=\"dashboard-content\">
            <div class=\"dashboard-header\">
                <div class=\"dashboard-title\">
                    <h1>Admin Dashboard</h1>
                    <p>Welcome back, ";
        // line 156
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 156, $this->source); })()), "session", [], "any", false, false, false, 156), "get", ["user_name"], "method", false, false, false, 156), "html", null, true);
        yield "</p>
                </div>
                <div class=\"dashboard-actions\">
                    <a href=\"";
        // line 159
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_profile");
        yield "\" class=\"btn btn-outline\">
                        <i class=\"fas fa-user\"></i> My Profile
                    </a>
                    <a href=\"";
        // line 162
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_logout");
        yield "\" class=\"btn btn-primary\">
                        <i class=\"fas fa-sign-out-alt\"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Stats Section -->
            <div class=\"stats-container\">
                <div class=\"stat-card\">
                    <h3>Total Users</h3>
                    <p><i class=\"fas fa-users\"></i> ";
        // line 172
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["user_count"]) || array_key_exists("user_count", $context) ? $context["user_count"] : (function () { throw new RuntimeError('Variable "user_count" does not exist.', 172, $this->source); })()), "html", null, true);
        yield "</p>
                </div>
                <div class=\"stat-card\">
                    <h3>Active Companies</h3>
                    <p><i class=\"fas fa-building\"></i> ";
        // line 176
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["company_count"]) || array_key_exists("company_count", $context) ? $context["company_count"] : (function () { throw new RuntimeError('Variable "company_count" does not exist.', 176, $this->source); })()), "html", null, true);
        yield "</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class=\"recent-activity\">
                <h2>Recent Activity</h2>
                ";
        // line 183
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["recent_activities"]) || array_key_exists("recent_activities", $context) ? $context["recent_activities"] : (function () { throw new RuntimeError('Variable "recent_activities" does not exist.', 183, $this->source); })())) > 0)) {
            // line 184
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recent_activities"]) || array_key_exists("recent_activities", $context) ? $context["recent_activities"] : (function () { throw new RuntimeError('Variable "recent_activities" does not exist.', 184, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["activity"]) {
                // line 185
                yield "                        <div class=\"activity-item\">
                            <p><i class=\"fas fa-clock\"></i> ";
                // line 186
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["activity"], "description", [], "any", false, false, false, 186), "html", null, true);
                yield "</p>
                            <small>";
                // line 187
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["activity"], "date", [], "any", false, false, false, 187), "Y-m-d H:i"), "html", null, true);
                yield "</small>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['activity'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 190
            yield "                ";
        } else {
            // line 191
            yield "                    <p>No recent activity</p>
                ";
        }
        // line 193
        yield "            </div>
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
        return "admin/dashboard.html.twig";
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
        return array (  351 => 193,  347 => 191,  344 => 190,  335 => 187,  331 => 186,  328 => 185,  323 => 184,  321 => 183,  311 => 176,  304 => 172,  291 => 162,  285 => 159,  279 => 156,  255 => 135,  245 => 127,  232 => 126,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Admin Dashboard | Career Bridge{% endblock %}

{% block stylesheet %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
    <style>
        .dashboard-content {
            padding: 1.5rem;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #dee2e6;
        }

        .dashboard-title h1 {
            color: var(--primary-color);
            margin: 0;
        }

        .dashboard-actions a {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-color);
            opacity: 0.9;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            margin-right: 0.5rem;
        }

        .btn-outline:hover {
            background-color: rgba(78, 115, 223, 0.1);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: var(--secondary-color);
            margin-top: 0;
            font-size: 1rem;
        }

        .stat-card p {
            font-size: 2rem;
            margin: 0.5rem 0 0;
            color: var(--dark-color);
            font-weight: 600;
        }

        .stat-card p i {
            color: var(--primary-color);
            margin-right: 0.5rem;
        }

        .recent-activity {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
        }

        .activity-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item p {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .activity-item small {
            color: var(--secondary-color);
            font-size: 0.8rem;
            margin-left: 1.5rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"main-content\">
        <header class=\"header\">
            <div class=\"d-flex justify-content-between align-items-center\">
                <button type=\"button\" class=\"btn btn-link text-dark p-0\" id=\"vertical-menu-btn\">
                    <i class=\"bx bx-menu font-size-24\"></i>
                </button>

                <div class=\"user-profile\">
                    <img src=\"{{ asset('Back/images/users/avatar-1.jpg') }}\" alt=\"Header Avatar\">
                    <div class=\"dropdown\">
                        <button class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                            <span class=\"d-none d-xl-inline-block ms-1\">Admin</span>
                            <i class=\"bx bx-chevron-down\"></i>
                        </button>
                        <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                            <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-user\"></i> Profile</a></li>
                            <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-cog\"></i> Settings</a></li>
                            <li><hr class=\"dropdown-divider\"></li>
                            <li><a class=\"dropdown-item text-danger\" href=\"#\"><i class=\"bx bx-power-off\"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class=\"dashboard-content\">
            <div class=\"dashboard-header\">
                <div class=\"dashboard-title\">
                    <h1>Admin Dashboard</h1>
                    <p>Welcome back, {{ app.session.get('user_name') }}</p>
                </div>
                <div class=\"dashboard-actions\">
                    <a href=\"{{ path('admin_profile') }}\" class=\"btn btn-outline\">
                        <i class=\"fas fa-user\"></i> My Profile
                    </a>
                    <a href=\"{{ path('admin_logout') }}\" class=\"btn btn-primary\">
                        <i class=\"fas fa-sign-out-alt\"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Stats Section -->
            <div class=\"stats-container\">
                <div class=\"stat-card\">
                    <h3>Total Users</h3>
                    <p><i class=\"fas fa-users\"></i> {{ user_count }}</p>
                </div>
                <div class=\"stat-card\">
                    <h3>Active Companies</h3>
                    <p><i class=\"fas fa-building\"></i> {{ company_count }}</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class=\"recent-activity\">
                <h2>Recent Activity</h2>
                {% if recent_activities|length > 0 %}
                    {% for activity in recent_activities %}
                        <div class=\"activity-item\">
                            <p><i class=\"fas fa-clock\"></i> {{ activity.description }}</p>
                            <small>{{ activity.date|date('Y-m-d H:i') }}</small>
                        </div>
                    {% endfor %}
                {% else %}
                    <p>No recent activity</p>
                {% endif %}
            </div>
        </div>
    </div>
{% endblock %}", "admin/dashboard.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\admin\\dashboard.html.twig");
    }
}
