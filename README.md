# 👥 RH-System - Système de Gestion des Ressources Humaines

**RH-System** est une plateforme Symfony avancée pour la gestion des ressources humaines, intégrant des fonctionnalités modernes telles que l’analyse de CV, la planification, l’envoi de mails via Brevo et Gmail, la génération de PDF, des statistiques interactives, et bien plus encore.

---

## 📦 Installation

### 🔧 Prérequis

- PHP 8.1+  
- Composer  
- Symfony CLI (recommandé)  
- Node.js & npm  
- Git  
- MySQL ou autre base supportée par Doctrine  

---

### 🚀 Cloner le projet

```bash
git clone https://github.com/iyedbenmansour/RH-System.git
cd RH-System
```

## ⚙️ Backend Symfony Setup Guide

### 1. Installer les dépendances PHP

```bash
composer install
```

---

### 2. Configurer le fichier `.env.local`

Copiez le fichier `.env` vers `.env.local`, puis modifiez la ligne de connexion à la base de données :

```env
DATABASE_URL="mysql://user:password@127.0.0.1:3306/rh_system"
```

---

### 3. Créer la base de données et lancer les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

---

### 4. Lancer le serveur Symfony

```bash
symfony server:start
```

## 📊 Statistiques & Visualisation
Utilise Chart.js (UX-Chart) pour générer des tableaux de bord interactifs :

Répartition des employés par service

Présences et absences

Statistiques sur les candidatures

Accès via /admin/dashboard.

### 📄 Gestion des Documents & CV
Téléversement de fichiers avec VichUploaderBundle

Parsing automatique de CV avec smalot/pdfparser

Génération de fichiers PDF via KnpSnappy (basé sur wkhtmltopdf)

### 📨 Mailing
Compatible avec plusieurs services :

Brevo Mailer (symfony/brevo-mailer)

Gmail via symfony/google-mailer

Notifications RH automatisées (réponses aux candidatures, convocations, etc.)

### 📅 Planning & Calendrier
Gestion des événements et disponibilités RH

Intégration de Tattali CalendarBundle pour afficher les plannings

### 🤖 IA et Analyse
Intégration du client OpenAI PHP pour potentielle analyse de profil ou génération de contenu RH

Préparé pour intégrer des fonctionnalités IA avancées (lettres de motivation, synthèses, etc.)

## 🧪 Tests
Lancez les tests automatisés :

```bash
php bin/phpunit
```

Environnement de test configuré avec :
```bash
Symfony PHPUnit Bridge
```

BrowserKit pour les tests fonctionnels

## 💡 Fonctionnalités principales

- Gestion des employés & candidats
- Traitement et lecture de CV PDF
- Dashboard RH interactif
- Envoi d’emails (Brevo/Gmail)
- Génération de documents PDF
- Statistiques et graphiques avec Chart.js
- Calendrier des événements RH
- Interface responsive et moderne

### 📁 Structure du projet
```bash

├── src/                  # Code source Symfony
├── templates/            # Vues Twig
├── public/               # JS, CSS, images publiques
├── migrations/           # Fichiers de migration Doctrine
├── config/               # Configuration Symfony
├── tests/                # Tests unitaires et fonctionnels
├── .env                  # Configuration environnement
├── composer.json         # Dépendances PHP
└── README.md             # Ce fichier
```

### 👨‍💻 Équipe & Auteurs
RH-System - Projet Symfony avancé
Développé par Iyed Ben Mansour et collaborateurs.





### 👨‍💻 Auteurs
Développé dans le cadre d’un projet Symfony avancé :
Iyed Ben Mansour et collaborateurs 🚀

### 📝 Licence
Ce projet est sous licence propriétaire. Toute utilisation commerciale nécessite une autorisation explicite.
