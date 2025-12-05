# CruciWeb – Plateforme de mots croisés

CruciWeb est une application web permettant de créer, publier et résoudre des grilles de mots croisés en ligne. Elle met en pratique une architecture MVC côté serveur, la manipulation du DOM, les requêtes AJAX et la gestion d’une base de données pour stocker grilles, parties et utilisateurs. [file:31][file:32]

## Objectifs de l’application

- Permettre la création, la sauvegarde et la publication de grilles de mots croisés par des utilisateurs inscrits. [file:31][file:32]  
- Offrir une interface de résolution de grilles pour tout utilisateur (anonyme ou connecté). [file:31][file:32]  
- Fournir des fonctionnalités d’administration pour gérer les utilisateurs et les grilles. [file:31][file:32]  

## Rôles utilisateurs

- **Utilisateur anonyme** :  
  - Consulte la liste des grilles publiées.  
  - Peut résoudre une grille, sans sauvegarde de progression. [file:31][file:32]  

- **Utilisateur inscrit** :  
  - Crée, édite et publie des grilles de mots croisés.  
  - Résout des grilles et peut sauvegarder/reprendre ses parties en cours. [file:31][file:32]  

- **Administrateur** :  
  - Gère les comptes utilisateurs (création, suppression).  
  - Peut supprimer des grilles. [file:31][file:32]  

## Architecture de l’application

L’application suit une architecture en couches inspirée du modèle **Modèle–Vue–Contrôleur (MVC)**. [file:31]  

- **Contrôleurs** :  
  - `GrilleManager` : gestion des grilles et des parties (création, mise à jour, suppression, vérification de cohérence, récupération des données pour les vues). [file:31]  
  - `DefinitionManager` : gestion des définitions associées à une grille (ajout, modification, suppression, chargement pour affichage/édition). [file:31]  
  - `UserManager` : gestion des utilisateurs (inscription, authentification, suppression, liste des comptes). [file:31]  
  - `Ajax` : points d’entrée pour les requêtes AJAX (chargement dynamique des grilles, tableaux, dashboard, etc.). [file:31]  

- **Modèle** :  
  - `Grilles` : opérations CRUD sur les grilles (publiques/privées). [file:31]  
  - `Parties` : sauvegarde, chargement et suppression des parties des utilisateurs. [file:31]  
  - `Cases` : gestion des cases (lettres, cases noires) d’une grille. [file:31]  
  - `Definitions` : gestion des définitions liées aux grilles. [file:31]  
  - `Users` : gestion des comptes utilisateurs et de l’authentification. [file:31]  

- **Vues** :  
  - Pages de consultation des grilles, création/édition de grilles, résolution de grilles, gestion de compte et interface administrateur. [file:31][file:32]  

## Technologies

- **Frontend** : HTML, CSS, JavaScript (manipulation du DOM, formulaires interactifs). [file:31]  
- **AJAX** : chargement dynamique des grilles, tableaux et formulaires sans rechargement complet de la page. [file:31][file:32]  
- **Backend** : PHP (gestion des sessions, logique métier, accès base de données, MVC). [file:31][file:32]  
- **Base de données** : stockage des utilisateurs, grilles, définitions, parties et cases. [file:31]  

## Sécurité

- Hashage des mots de passe (par exemple via `password_hash` en PHP). [file:31]  
- Validation/filtrage systématique des entrées utilisateurs pour limiter les injections SQL et les attaques XSS (requêtes préparées, échappement des sorties). [file:31]  
- Gestion des sessions pour l’authentification et les rôles (anonyme, inscrit, administrateur). [file:31]  

## Ergonomie

- Navigation structurée : accueil, liste des grilles, création/édition, jeu, espace utilisateur, administration. [file:31][file:32]  
- Feedback utilisateur : messages de confirmation et d’erreur (sauvegarde, création de grille, connexion, etc.). [file:31]  
- Formulaires interactifs avec validations et retours dynamiques via AJAX. [file:31]  
  
