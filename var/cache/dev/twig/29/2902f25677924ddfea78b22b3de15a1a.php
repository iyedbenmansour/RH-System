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

/* company/edit_profile.html.twig */
class __TwigTemplate_e6eefeed1f81edcce79787ffecd7016d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/edit_profile.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "company/edit_profile.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "company/edit_profile.html.twig", 1);
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

        yield "Modifier le profil entreprise | JobConnect";
        
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
        .edit-company-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .edit-company-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .edit-company-header h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .form-group {
            margin-bottom: 1.8rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: #495057;
            font-size: 1.05rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }
        
        .current-logo {
            margin-top: 1.5rem;
        }
        
        .current-logo img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .file-upload-wrapper {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.2rem;
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            flex-direction: column;
            gap: 0.8rem;
        }
        
        .file-upload-label:hover {
            border-color: #3498db;
            background-color: #f0f7ff;
        }
        
        .file-upload-label i {
            font-size: 1.8rem;
            color: #3498db;
        }
        
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.8rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
            gap: 0.6rem;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
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
            background-color: #f0f7ff;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        @media (max-width: 576px) {
            .edit-company-container {
                padding: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 183
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

        // line 184
        yield "    <div class=\"edit-company-container\">
        <div class=\"edit-company-header\">
            <h1><i class=\"fas fa-building\"></i> Modifier le profil entreprise</h1>
        </div>
        
        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <label for=\"companyName\" class=\"form-label\">Nom de l'entreprise</label>
                <input type=\"text\" id=\"companyName\" name=\"companyName\" class=\"form-control\" value=\"";
        // line 192
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 192, $this->source); })()), "companyName", [], "any", false, false, false, 192), "html", null, true);
        yield "\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"location\" class=\"form-label\">Localisation</label>
                <input type=\"text\" id=\"location\" name=\"location\" class=\"form-control\" value=\"";
        // line 197
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 197, $this->source); })()), "location", [], "any", false, false, false, 197), "html", null, true);
        yield "\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"secteur\" class=\"form-label\">Secteur d'activité</label>
                <input type=\"text\" id=\"secteur\" name=\"secteur\" class=\"form-control\" value=\"";
        // line 202
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 202, $this->source); })()), "secteur", [], "any", false, false, false, 202), "html", null, true);
        yield "\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"email\" class=\"form-label\">Email</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" value=\"";
        // line 207
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 207, $this->source); })()), "email", [], "any", false, false, false, 207), "html", null, true);
        yield "\" required>
            </div>
            
            <div class=\"form-group\">
                <label class=\"form-label\">Logo de l'entreprise</label>
                
                <div class=\"file-upload-wrapper\">
                    <label class=\"file-upload-label\">
                        <i class=\"fas fa-cloud-upload-alt\"></i>
                        <span>Cliquez pour télécharger ou glissez-déposez votre logo</span>
                        <span class=\"text-muted\">(Format JPG, PNG - Max 2MB)</span>
                        <input type=\"file\" id=\"image\" name=\"image\" class=\"file-upload-input\" accept=\"image/jpeg,image/png\">
                    </label>
                </div>
                
                ";
        // line 222
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 222, $this->source); })()), "image", [], "any", false, false, false, 222)) {
            // line 223
            yield "                    <div class=\"current-logo\">
                        <p class=\"form-label\">Logo actuel :</p>
                        <img src=\"";
            // line 225
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/companies/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["company"]) || array_key_exists("company", $context) ? $context["company"] : (function () { throw new RuntimeError('Variable "company" does not exist.', 225, $this->source); })()), "image", [], "any", false, false, false, 225))), "html", null, true);
            yield "\" alt=\"Logo actuel\">
                        <div style=\"margin-top: 1rem;\">
                            <a href=\"";
            // line 227
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_profile_delete_image");
            yield "\" class=\"btn btn-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce logo ?')\">
                                <i class=\"fas fa-trash\"></i> Supprimer le logo
                            </a>
                        </div>
                    </div>
                ";
        }
        // line 233
        yield "            </div>
            
            <div class=\"action-buttons\">
                <button type=\"submit\" class=\"btn btn-primary\">
                    <i class=\"fas fa-save\"></i> Enregistrer les modifications
                </button>
                <a href=\"";
        // line 239
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("company_profile");
        yield "\" class=\"btn btn-outline\">
                    <i class=\"fas fa-arrow-left\"></i> Retour au profil
                </a>
            </div>
        </form>
    </div>

    <script>
        // Affiche le nom du fichier sélectionné
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
            const label = document.querySelector('.file-upload-label span:first-of-type');
            label.textContent = fileName;
        });
        
        // Gestion du drag and drop
        const fileUploadLabel = document.querySelector('.file-upload-label');
        
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            e.preventDefault();
            e.stopPropagation();
            fileUploadLabel.style.borderColor = '#3498db';
            fileUploadLabel.style.backgroundColor = '#e6f2ff';
        }
        
        function unhighlight(e) {
            e.preventDefault();
            e.stopPropagation();
            fileUploadLabel.style.borderColor = '#ced4da';
            fileUploadLabel.style.backgroundColor = '#f8f9fa';
        }
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
        return "company/edit_profile.html.twig";
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
        return array (  382 => 239,  374 => 233,  365 => 227,  360 => 225,  356 => 223,  354 => 222,  336 => 207,  328 => 202,  320 => 197,  312 => 192,  302 => 184,  289 => 183,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier le profil entreprise | JobConnect{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .edit-company-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .edit-company-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .edit-company-header h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        
        .form-group {
            margin-bottom: 1.8rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.6rem;
            font-weight: 600;
            color: #495057;
            font-size: 1.05rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem 1.2rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }
        
        .current-logo {
            margin-top: 1.5rem;
        }
        
        .current-logo img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .file-upload-wrapper {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.2rem;
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            flex-direction: column;
            gap: 0.8rem;
        }
        
        .file-upload-label:hover {
            border-color: #3498db;
            background-color: #f0f7ff;
        }
        
        .file-upload-label i {
            font-size: 1.8rem;
            color: #3498db;
        }
        
        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.8rem 1.8rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
            gap: 0.6rem;
        }
        
        .btn-primary {
            background-color: #3498db;
            color: white;
            border: none;
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
            background-color: #f0f7ff;
        }
        
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
        }
        
        @media (max-width: 576px) {
            .edit-company-container {
                padding: 1.5rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"edit-company-container\">
        <div class=\"edit-company-header\">
            <h1><i class=\"fas fa-building\"></i> Modifier le profil entreprise</h1>
        </div>
        
        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <label for=\"companyName\" class=\"form-label\">Nom de l'entreprise</label>
                <input type=\"text\" id=\"companyName\" name=\"companyName\" class=\"form-control\" value=\"{{ company.companyName }}\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"location\" class=\"form-label\">Localisation</label>
                <input type=\"text\" id=\"location\" name=\"location\" class=\"form-control\" value=\"{{ company.location }}\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"secteur\" class=\"form-label\">Secteur d'activité</label>
                <input type=\"text\" id=\"secteur\" name=\"secteur\" class=\"form-control\" value=\"{{ company.secteur }}\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"email\" class=\"form-label\">Email</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" value=\"{{ company.email }}\" required>
            </div>
            
            <div class=\"form-group\">
                <label class=\"form-label\">Logo de l'entreprise</label>
                
                <div class=\"file-upload-wrapper\">
                    <label class=\"file-upload-label\">
                        <i class=\"fas fa-cloud-upload-alt\"></i>
                        <span>Cliquez pour télécharger ou glissez-déposez votre logo</span>
                        <span class=\"text-muted\">(Format JPG, PNG - Max 2MB)</span>
                        <input type=\"file\" id=\"image\" name=\"image\" class=\"file-upload-input\" accept=\"image/jpeg,image/png\">
                    </label>
                </div>
                
                {% if company.image %}
                    <div class=\"current-logo\">
                        <p class=\"form-label\">Logo actuel :</p>
                        <img src=\"{{ asset('uploads/companies/' ~ company.image) }}\" alt=\"Logo actuel\">
                        <div style=\"margin-top: 1rem;\">
                            <a href=\"{{ path('company_profile_delete_image') }}\" class=\"btn btn-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce logo ?')\">
                                <i class=\"fas fa-trash\"></i> Supprimer le logo
                            </a>
                        </div>
                    </div>
                {% endif %}
            </div>
            
            <div class=\"action-buttons\">
                <button type=\"submit\" class=\"btn btn-primary\">
                    <i class=\"fas fa-save\"></i> Enregistrer les modifications
                </button>
                <a href=\"{{ path('company_profile') }}\" class=\"btn btn-outline\">
                    <i class=\"fas fa-arrow-left\"></i> Retour au profil
                </a>
            </div>
        </form>
    </div>

    <script>
        // Affiche le nom du fichier sélectionné
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
            const label = document.querySelector('.file-upload-label span:first-of-type');
            label.textContent = fileName;
        });
        
        // Gestion du drag and drop
        const fileUploadLabel = document.querySelector('.file-upload-label');
        
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadLabel.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            e.preventDefault();
            e.stopPropagation();
            fileUploadLabel.style.borderColor = '#3498db';
            fileUploadLabel.style.backgroundColor = '#e6f2ff';
        }
        
        function unhighlight(e) {
            e.preventDefault();
            e.stopPropagation();
            fileUploadLabel.style.borderColor = '#ced4da';
            fileUploadLabel.style.backgroundColor = '#f8f9fa';
        }
    </script>
{% endblock %}", "company/edit_profile.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\company\\edit_profile.html.twig");
    }
}
