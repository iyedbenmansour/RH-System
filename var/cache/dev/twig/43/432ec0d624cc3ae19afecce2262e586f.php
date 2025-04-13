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

/* candidat/edit_profile.html.twig */
class __TwigTemplate_937f18391c6489e8d180bb122406a571 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/edit_profile.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "candidat/edit_profile.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "candidat/edit_profile.html.twig", 1);
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

        yield "Modifier mon profil | JobConnect";
        
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
        .edit-profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .edit-profile-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .edit-profile-header h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #495057;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
        
        .current-image {
            margin-top: 1rem;
        }
        
        .current-image img {
            max-width: 200px;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
            border: 1px solid #dee2e6;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            border: 1px solid transparent;
            border-radius: 0.375rem;
            transition: all 0.15s ease-in-out;
        }
        
        .btn-primary {
            color: #fff;
            background-color: #3498db;
            border-color: #3498db;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-1px);
        }
        
        .btn-outline-secondary {
            color: #6c757d;
            background-color: transparent;
            border-color: #6c757d;
        }
        
        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-danger {
            color: #fff;
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .file-upload {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 0.375rem;
            cursor: pointer;
        }
        
        .file-upload-label:hover {
            border-color: #3498db;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 153
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

        // line 154
        yield "    <div class=\"edit-profile-container\">
        <div class=\"edit-profile-header\">
            <h1><i class=\"fas fa-user-edit\"></i> Modifier mon profil</h1>
        </div>
        
        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <label for=\"name\" class=\"form-label\">Nom complet</label>
                <input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" value=\"";
        // line 162
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 162, $this->source); })()), "name", [], "any", false, false, false, 162), "html", null, true);
        yield "\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"email\" class=\"form-label\">Adresse email</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" value=\"";
        // line 167
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 167, $this->source); })()), "email", [], "any", false, false, false, 167), "html", null, true);
        yield "\" required>
            </div>
            
            <div class=\"form-group\">
                <label class=\"form-label\">Photo de profil</label>
                <div class=\"file-upload\">
                    <label for=\"image\" class=\"file-upload-label\">
                        <i class=\"fas fa-cloud-upload-alt\"></i>
                        <span>Choisir un fichier...</span>
                    </label>
                    <input type=\"file\" id=\"image\" name=\"image\" style=\"display: none;\">
                </div>
                
                ";
        // line 180
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 180, $this->source); })()), "image", [], "any", false, false, false, 180)) {
            // line 181
            yield "                    <div class=\"current-image\">
                        <img src=\"";
            // line 182
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/candidats/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["candidat"]) || array_key_exists("candidat", $context) ? $context["candidat"] : (function () { throw new RuntimeError('Variable "candidat" does not exist.', 182, $this->source); })()), "image", [], "any", false, false, false, 182))), "html", null, true);
            yield "\" alt=\"Photo actuelle\" class=\"img-thumbnail\">
                        <div style=\"margin-top: 0.5rem;\">
                            <a href=\"";
            // line 184
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_profile_delete_image");
            yield "\" class=\"btn btn-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?')\">
                                <i class=\"fas fa-trash\"></i> Supprimer la photo
                            </a>
                        </div>
                    </div>
                ";
        }
        // line 190
        yield "            </div>
            
            <div class=\"action-buttons\">
                <button type=\"submit\" class=\"btn btn-primary\">
                    <i class=\"fas fa-save\"></i> Enregistrer les modifications
                </button>
                <a href=\"";
        // line 196
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("candidat_profile");
        yield "\" class=\"btn btn-outline-secondary\">
                    <i class=\"fas fa-arrow-left\"></i> Retour au profil
                </a>
            </div>
        </form>
    </div>

    <script>
        // Affiche le nom du fichier sélectionné
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
            const label = document.querySelector('.file-upload-label span');
            label.textContent = fileName;
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
        return "candidat/edit_profile.html.twig";
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
        return array (  333 => 196,  325 => 190,  316 => 184,  311 => 182,  308 => 181,  306 => 180,  290 => 167,  282 => 162,  272 => 154,  259 => 153,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Modifier mon profil | JobConnect{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .edit-profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .edit-profile-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .edit-profile-header h1 {
            color: #2c3e50;
            margin: 0;
            font-weight: 700;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #495057;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }
        
        .current-image {
            margin-top: 1rem;
        }
        
        .current-image img {
            max-width: 200px;
            border-radius: 0.375rem;
            margin-bottom: 0.5rem;
            border: 1px solid #dee2e6;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5;
            text-align: center;
            text-decoration: none;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            border: 1px solid transparent;
            border-radius: 0.375rem;
            transition: all 0.15s ease-in-out;
        }
        
        .btn-primary {
            color: #fff;
            background-color: #3498db;
            border-color: #3498db;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
            transform: translateY(-1px);
        }
        
        .btn-outline-secondary {
            color: #6c757d;
            background-color: transparent;
            border-color: #6c757d;
        }
        
        .btn-outline-secondary:hover {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-danger {
            color: #fff;
            background-color: #e74c3c;
            border-color: #e74c3c;
        }
        
        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .file-upload {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #f8f9fa;
            border: 1px dashed #ced4da;
            border-radius: 0.375rem;
            cursor: pointer;
        }
        
        .file-upload-label:hover {
            border-color: #3498db;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"edit-profile-container\">
        <div class=\"edit-profile-header\">
            <h1><i class=\"fas fa-user-edit\"></i> Modifier mon profil</h1>
        </div>
        
        <form method=\"post\" enctype=\"multipart/form-data\">
            <div class=\"form-group\">
                <label for=\"name\" class=\"form-label\">Nom complet</label>
                <input type=\"text\" id=\"name\" name=\"name\" class=\"form-control\" value=\"{{ candidat.name }}\" required>
            </div>
            
            <div class=\"form-group\">
                <label for=\"email\" class=\"form-label\">Adresse email</label>
                <input type=\"email\" id=\"email\" name=\"email\" class=\"form-control\" value=\"{{ candidat.email }}\" required>
            </div>
            
            <div class=\"form-group\">
                <label class=\"form-label\">Photo de profil</label>
                <div class=\"file-upload\">
                    <label for=\"image\" class=\"file-upload-label\">
                        <i class=\"fas fa-cloud-upload-alt\"></i>
                        <span>Choisir un fichier...</span>
                    </label>
                    <input type=\"file\" id=\"image\" name=\"image\" style=\"display: none;\">
                </div>
                
                {% if candidat.image %}
                    <div class=\"current-image\">
                        <img src=\"{{ asset('uploads/candidats/' ~ candidat.image) }}\" alt=\"Photo actuelle\" class=\"img-thumbnail\">
                        <div style=\"margin-top: 0.5rem;\">
                            <a href=\"{{ path('candidat_profile_delete_image') }}\" class=\"btn btn-danger\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?')\">
                                <i class=\"fas fa-trash\"></i> Supprimer la photo
                            </a>
                        </div>
                    </div>
                {% endif %}
            </div>
            
            <div class=\"action-buttons\">
                <button type=\"submit\" class=\"btn btn-primary\">
                    <i class=\"fas fa-save\"></i> Enregistrer les modifications
                </button>
                <a href=\"{{ path('candidat_profile') }}\" class=\"btn btn-outline-secondary\">
                    <i class=\"fas fa-arrow-left\"></i> Retour au profil
                </a>
            </div>
        </form>
    </div>

    <script>
        // Affiche le nom du fichier sélectionné
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Aucun fichier sélectionné';
            const label = document.querySelector('.file-upload-label span');
            label.textContent = fileName;
        });
    </script>
{% endblock %}", "candidat/edit_profile.html.twig", "C:\\Users\\ahmed\\Desktop\\symf_auth\\job_portal\\templates\\candidat\\edit_profile.html.twig");
    }
}
