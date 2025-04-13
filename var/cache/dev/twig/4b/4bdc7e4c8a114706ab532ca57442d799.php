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

/* base.html.twig */
class __TwigTemplate_f1ea3fca252e144799feb2f29fe79221 extends Template
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

        $this->parent = false;

        $this->blocks = [
            'stylesheet' => [$this, 'block_stylesheet'],
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    ";
        // line 4
        yield from $this->unwrap()->yieldBlock('stylesheet', $context, $blocks);
        // line 189
        yield "    ";
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 190
        yield "</head>

<body>
    <div class=\"hero_area\">
        <div class=\"hero_bg_box\">
            <div class=\"bg_img_box\">
                <img src=\"";
        // line 196
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/images/hero-bg.png"), "html", null, true);
        yield "\" alt=\"\">
            </div>
        </div>

        <!-- Header Section -->
        <header class=\"header_section\">
            <div class=\"container\">
                <nav class=\"navbar navbar-expand-lg navbar-dark\">
                    <a class=\"navbar-brand\" href=\"";
        // line 204
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\">
                        <i class=\"fas fa-handshake\"></i> CareerBridge
                    </a>
                    
                    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>
                    
                    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                        <ul class=\"navbar-nav me-auto\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link active\" href=\"";
        // line 215
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\">Accueil</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" \">À propos</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" \">Services</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" \">Contact</a>
                            </li>
                        </ul>
                        
                        <ul class=\"navbar-nav ms-auto\">
                            <li class=\"nav-item dropdown mx-1\">
                                <a class=\"nav-link dropdown-toggle d-flex align-items-center\" href=\"#\" id=\"adminDropdown\" role=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-user-shield me-1\"></i> Admin
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    <li><a class=\"dropdown-item\" href=\"";
        // line 234
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_login");
        yield "\"><i class=\"fas fa-sign-in-alt me-2\"></i>Connexion</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown mx-1\">
                                <a class=\"nav-link dropdown-toggle d-flex align-items-center\" href=\"#\" id=\"companyDropdown\" role=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-building me-1\"></i> Entreprise
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    <li><a class=\"dropdown-item\" href=\"";
        // line 242
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_login");
        yield "\"><i class=\"fas fa-sign-in-alt me-2\"></i>Connexion</a></li>
                                    <li><hr class=\"dropdown-divider\"></li>
                                    <li><a class=\"dropdown-item\" href=\"";
        // line 244
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_register");
        yield "\"><i class=\"fas fa-user-plus me-2\"></i>Inscription</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown mx-1\">
                                <a class=\"nav-link dropdown-toggle d-flex align-items-center\" href=\"#\" id=\"candidatDropdown\" role=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-user-graduate me-1\"></i> Candidat
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    <li><a class=\"dropdown-item\" href=\"";
        // line 252
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_login");
        yield "\"><i class=\"fas fa-sign-in-alt me-2\"></i>Connexion</a></li>
                                    <li><hr class=\"dropdown-divider\"></li>
                                    <li><a class=\"dropdown-item\" href=\"";
        // line 254
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_register");
        yield "\"><i class=\"fas fa-user-plus me-2\"></i>Inscription</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class=\"main-container\">
            <div class=\"container\">
                ";
        // line 266
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 266, $this->source); })()), "flashes", ["success"], "method", false, false, false, 266));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 267
            yield "                    <div class=\"alert alert-success alert-dismissible fade show\">
                        ";
            // line 268
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 272
        yield "                ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 272, $this->source); })()), "flashes", ["error"], "method", false, false, false, 272));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 273
            yield "                    <div class=\"alert alert-danger alert-dismissible fade show\">
                        ";
            // line 274
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
            yield "
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 278
        yield "                
                ";
        // line 279
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 280
        yield "            </div>
        </main>
    </div>

    <!-- Info Section (Enhanced Footer) -->
    <section class=\"info_section\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6 col-lg-4\">
                    <h4 class=\"text-white mb-4\">CareerBridge</h4>
                    <p class=\"text-white-50\">Notre plateforme révolutionne le recrutement en connectant directement les talents avec les entreprises qui correspondent à leurs aspirations.</p>
                    <div class=\"info_social mt-4\">
                        <a href=\"#\"><i class=\"fab fa-facebook-f\"></i></a>
                        <a href=\"#\"><i class=\"fab fa-twitter\"></i></a>
                        <a href=\"#\"><i class=\"fab fa-linkedin-in\"></i></a>
                        <a href=\"#\"><i class=\"fab fa-instagram\"></i></a>
                    </div>
                </div>
                
                <div class=\"col-md-6 col-lg-2\">
                    <h5 class=\"text-white mb-4\">Liens rapides</h5>
                    <div class=\"info_links\">
                        <a href=\"";
        // line 302
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\" class=\"active\">Accueil</a>
                        <a >À propos</a>
                        <a>Contact</a>
                    </div>
                </div>
                
                <div class=\"col-md-6 col-lg-3\">
                    <h5 class=\"text-white mb-4\">Entreprises</h5>
                    <ul class=\"list-unstyled footer-links\">
                        <li class=\"mb-2\"><a href=\"";
        // line 311
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_register");
        yield "\">Créer un compte</a></li>
                        <li class=\"mb-2\"><a href=\"";
        // line 312
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_login");
        yield "\">Espace recruteur</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Tarifs</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Solutions RH</a></li>
                    </ul>
                </div>
                
                <div class=\"col-md-6 col-lg-3\">
                    <h5 class=\"text-white mb-4\">Candidats</h5>
                    <ul class=\"list-unstyled footer-links\">
                        <li class=\"mb-2\"><a href=\"";
        // line 321
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_register");
        yield "\">Créer un compte</a></li>
                        <li class=\"mb-2\"><a href=\"";
        // line 322
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_login");
        yield "\">Espace candidat</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Conseils carrière</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Offres d'emploi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class=\"footer_section\">
        <div class=\"container\">
            <div class=\"row align-items-center\">
                <div class=\"col-md-6 text-center text-md-start\">
                    <p class=\"mb-0\">&copy; <span id=\"displayYear\"></span> CareerBridge. Tous droits réservés.</p>
                </div>
                <div class=\"col-md-6 text-center text-md-end\">
                    <a href=\"#\" class=\"text-white-50 me-3\">Mentions légales</a>
                    <a href=\"#\" class=\"text-white-50\">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript Libraries -->
    ";
        // line 347
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 374
        yield "</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 4
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

        // line 5
        yield "    <!-- Meta Tags -->
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Career Bridge - Plateforme de recrutement connectant talents et entreprises\">
    <meta name=\"keywords\" content=\"emploi, recrutement, carrière\">
    <meta name=\"author\" content=\"Career Bridge\">

    <title>";
        // line 13
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        yield "</title>

    <!-- Favicon -->
    <link rel=\"shortcut icon\" href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/images/favicon.png"), "html", null, true);
        yield "\" type=\"image/png\">

    <!-- Bootstrap CSS -->
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"";
        // line 20
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/bootstrap.css"), "html", null, true);
        yield "\">

    <!-- Fonts -->
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\">

    <!-- Owl Carousel -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css\">

    <!-- Custom CSS -->
    <link href=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/style.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">
    <link href=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/responsive.css"), "html", null, true);
        yield "\" rel=\"stylesheet\">

    <style>
        :root {
            --primary-color: #231a6f;
            --secondary-color: #1a1357;
            --accent-color: #e74c3c;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Hero Area from first template */
        .hero_area {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .hero_bg_box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .bg_img_box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Header/Navbar */
        .header_section {
            background-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
            color: var(--accent-color);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link:focus {
            color: white !important;
            transform: translateY(-2px);
        }
        
        /* Dropdown styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: var(--primary-color);
            color: white !important;
        }
        
        /* Main Content */
        .main-container {
            flex: 1;
            padding: 2rem 0;
        }
        
        /* Alert styles */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Footer sections from first template */
        .info_section {
            background-color: var(--primary-color);
            color: white;
            padding: 60px 0;
        }
        
        .footer_section {
            background-color: var(--secondary-color);
            color: white;
            padding: 20px 0;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin-right: 1rem;
            transition: transform 0.3s;
        }
        
        .social-icons a:hover {
            transform: translateY(-3px);
        }
        
        /* Animations */
        .dropdown-menu {
            animation: fadeIn 0.3s ease forwards;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 13
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

        yield "Career Bridge - Votre plateforme d'emploi";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 189
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 279
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 347
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 348
        yield "    <!-- jQuery -->
    <script src=\"";
        // line 349
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/js/jquery-3.4.1.min.js"), "html", null, true);
        yield "\"></script>
    
    <!-- Bootstrap JS -->
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
    <script src=\"";
        // line 353
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/js/bootstrap.js"), "html", null, true);
        yield "\"></script>
    
    <!-- Owl Carousel -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js\"></script>
    
    <!-- Custom JS -->
    <script src=\"";
        // line 359
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/js/custom.js"), "html", null, true);
        yield "\"></script>

    <script>
        // Set current year in footer
        document.getElementById('displayYear').textContent = new Date().getFullYear();
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
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
        return "base.html.twig";
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
        return array (  624 => 359,  615 => 353,  608 => 349,  605 => 348,  592 => 347,  570 => 279,  548 => 189,  525 => 13,  356 => 31,  352 => 30,  339 => 20,  332 => 16,  326 => 13,  316 => 5,  303 => 4,  291 => 374,  289 => 347,  261 => 322,  257 => 321,  245 => 312,  241 => 311,  229 => 302,  205 => 280,  203 => 279,  200 => 278,  190 => 274,  187 => 273,  182 => 272,  172 => 268,  169 => 267,  165 => 266,  150 => 254,  145 => 252,  134 => 244,  129 => 242,  118 => 234,  96 => 215,  82 => 204,  71 => 196,  63 => 190,  60 => 189,  58 => 4,  53 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    {% block stylesheet %}
    <!-- Meta Tags -->
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <meta name=\"description\" content=\"Career Bridge - Plateforme de recrutement connectant talents et entreprises\">
    <meta name=\"keywords\" content=\"emploi, recrutement, carrière\">
    <meta name=\"author\" content=\"Career Bridge\">

    <title>{% block title %}Career Bridge - Votre plateforme d'emploi{% endblock %}</title>

    <!-- Favicon -->
    <link rel=\"shortcut icon\" href=\"{{ asset('Front/images/favicon.png')}}\" type=\"image/png\">

    <!-- Bootstrap CSS -->
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"{{ asset('Front/css/bootstrap.css')}}\">

    <!-- Fonts -->
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap\" rel=\"stylesheet\">
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\">

    <!-- Owl Carousel -->
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css\">

    <!-- Custom CSS -->
    <link href=\"{{ asset('Front/css/style.css')}}\" rel=\"stylesheet\">
    <link href=\"{{ asset('Front/css/responsive.css')}}\" rel=\"stylesheet\">

    <style>
        :root {
            --primary-color: #231a6f;
            --secondary-color: #1a1357;
            --accent-color: #e74c3c;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Roboto', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Hero Area from first template */
        .hero_area {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .hero_bg_box {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .bg_img_box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Header/Navbar */
        .header_section {
            background-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 10px;
            color: var(--accent-color);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover, .nav-link:focus {
            color: white !important;
            transform: translateY(-2px);
        }
        
        /* Dropdown styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 0.5rem 0;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: var(--primary-color);
            color: white !important;
        }
        
        /* Main Content */
        .main-container {
            flex: 1;
            padding: 2rem 0;
        }
        
        /* Alert styles */
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Footer sections from first template */
        .info_section {
            background-color: var(--primary-color);
            color: white;
            padding: 60px 0;
        }
        
        .footer_section {
            background-color: var(--secondary-color);
            color: white;
            padding: 20px 0;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin-right: 1rem;
            transition: transform 0.3s;
        }
        
        .social-icons a:hover {
            transform: translateY(-3px);
        }
        
        /* Animations */
        .dropdown-menu {
            animation: fadeIn 0.3s ease forwards;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    {% endblock %}
    {% block stylesheets %}{% endblock %}
</head>

<body>
    <div class=\"hero_area\">
        <div class=\"hero_bg_box\">
            <div class=\"bg_img_box\">
                <img src=\"{{ asset('Front/images/hero-bg.png')}}\" alt=\"\">
            </div>
        </div>

        <!-- Header Section -->
        <header class=\"header_section\">
            <div class=\"container\">
                <nav class=\"navbar navbar-expand-lg navbar-dark\">
                    <a class=\"navbar-brand\" href=\"{{ path('home') }}\">
                        <i class=\"fas fa-handshake\"></i> CareerBridge
                    </a>
                    
                    <button class=\"navbar-toggler\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#navbarNav\">
                        <span class=\"navbar-toggler-icon\"></span>
                    </button>
                    
                    <div class=\"collapse navbar-collapse\" id=\"navbarNav\">
                        <ul class=\"navbar-nav me-auto\">
                            <li class=\"nav-item\">
                                <a class=\"nav-link active\" href=\"{{ path('home') }}\">Accueil</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" \">À propos</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" \">Services</a>
                            </li>
                            <li class=\"nav-item\">
                                <a class=\"nav-link\" \">Contact</a>
                            </li>
                        </ul>
                        
                        <ul class=\"navbar-nav ms-auto\">
                            <li class=\"nav-item dropdown mx-1\">
                                <a class=\"nav-link dropdown-toggle d-flex align-items-center\" href=\"#\" id=\"adminDropdown\" role=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-user-shield me-1\"></i> Admin
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    <li><a class=\"dropdown-item\" href=\"{{ path('admin_login') }}\"><i class=\"fas fa-sign-in-alt me-2\"></i>Connexion</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown mx-1\">
                                <a class=\"nav-link dropdown-toggle d-flex align-items-center\" href=\"#\" id=\"companyDropdown\" role=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-building me-1\"></i> Entreprise
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    <li><a class=\"dropdown-item\" href=\"{{ path('company_login') }}\"><i class=\"fas fa-sign-in-alt me-2\"></i>Connexion</a></li>
                                    <li><hr class=\"dropdown-divider\"></li>
                                    <li><a class=\"dropdown-item\" href=\"{{ path('company_register') }}\"><i class=\"fas fa-user-plus me-2\"></i>Inscription</a></li>
                                </ul>
                            </li>
                            <li class=\"nav-item dropdown mx-1\">
                                <a class=\"nav-link dropdown-toggle d-flex align-items-center\" href=\"#\" id=\"candidatDropdown\" role=\"button\" data-bs-toggle=\"dropdown\">
                                    <i class=\"fas fa-user-graduate me-1\"></i> Candidat
                                </a>
                                <ul class=\"dropdown-menu dropdown-menu-end\">
                                    <li><a class=\"dropdown-item\" href=\"{{ path('candidat_login') }}\"><i class=\"fas fa-sign-in-alt me-2\"></i>Connexion</a></li>
                                    <li><hr class=\"dropdown-divider\"></li>
                                    <li><a class=\"dropdown-item\" href=\"{{ path('candidat_register') }}\"><i class=\"fas fa-user-plus me-2\"></i>Inscription</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main class=\"main-container\">
            <div class=\"container\">
                {% for message in app.flashes('success') %}
                    <div class=\"alert alert-success alert-dismissible fade show\">
                        {{ message }}
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                {% endfor %}
                {% for message in app.flashes('error') %}
                    <div class=\"alert alert-danger alert-dismissible fade show\">
                        {{ message }}
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                {% endfor %}
                
                {% block body %}{% endblock %}
            </div>
        </main>
    </div>

    <!-- Info Section (Enhanced Footer) -->
    <section class=\"info_section\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6 col-lg-4\">
                    <h4 class=\"text-white mb-4\">CareerBridge</h4>
                    <p class=\"text-white-50\">Notre plateforme révolutionne le recrutement en connectant directement les talents avec les entreprises qui correspondent à leurs aspirations.</p>
                    <div class=\"info_social mt-4\">
                        <a href=\"#\"><i class=\"fab fa-facebook-f\"></i></a>
                        <a href=\"#\"><i class=\"fab fa-twitter\"></i></a>
                        <a href=\"#\"><i class=\"fab fa-linkedin-in\"></i></a>
                        <a href=\"#\"><i class=\"fab fa-instagram\"></i></a>
                    </div>
                </div>
                
                <div class=\"col-md-6 col-lg-2\">
                    <h5 class=\"text-white mb-4\">Liens rapides</h5>
                    <div class=\"info_links\">
                        <a href=\"{{ path('home') }}\" class=\"active\">Accueil</a>
                        <a >À propos</a>
                        <a>Contact</a>
                    </div>
                </div>
                
                <div class=\"col-md-6 col-lg-3\">
                    <h5 class=\"text-white mb-4\">Entreprises</h5>
                    <ul class=\"list-unstyled footer-links\">
                        <li class=\"mb-2\"><a href=\"{{ path('company_register') }}\">Créer un compte</a></li>
                        <li class=\"mb-2\"><a href=\"{{ path('company_login') }}\">Espace recruteur</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Tarifs</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Solutions RH</a></li>
                    </ul>
                </div>
                
                <div class=\"col-md-6 col-lg-3\">
                    <h5 class=\"text-white mb-4\">Candidats</h5>
                    <ul class=\"list-unstyled footer-links\">
                        <li class=\"mb-2\"><a href=\"{{ path('candidat_register') }}\">Créer un compte</a></li>
                        <li class=\"mb-2\"><a href=\"{{ path('candidat_login') }}\">Espace candidat</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Conseils carrière</a></li>
                        <li class=\"mb-2\"><a href=\"#\">Offres d'emploi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class=\"footer_section\">
        <div class=\"container\">
            <div class=\"row align-items-center\">
                <div class=\"col-md-6 text-center text-md-start\">
                    <p class=\"mb-0\">&copy; <span id=\"displayYear\"></span> CareerBridge. Tous droits réservés.</p>
                </div>
                <div class=\"col-md-6 text-center text-md-end\">
                    <a href=\"#\" class=\"text-white-50 me-3\">Mentions légales</a>
                    <a href=\"#\" class=\"text-white-50\">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript Libraries -->
    {% block javascripts %}
    <!-- jQuery -->
    <script src=\"{{ asset('Front/js/jquery-3.4.1.min.js')}}\"></script>
    
    <!-- Bootstrap JS -->
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
    <script src=\"{{ asset('Front/js/bootstrap.js')}}\"></script>
    
    <!-- Owl Carousel -->
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js\"></script>
    
    <!-- Custom JS -->
    <script src=\"{{ asset('Front/js/custom.js')}}\"></script>

    <script>
        // Set current year in footer
        document.getElementById('displayYear').textContent = new Date().getFullYear();
        
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    {% endblock %}
</body>
</html>", "base.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\base.html.twig");
    }
}
