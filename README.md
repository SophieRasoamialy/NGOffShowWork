# NGOffShowWork

NGOffShowWork est une plateforme web qui met en relation les clients, les partenaires CDO, les administrateurs et les développeurs autour de travaux de projet. L’application permet aux administrateurs de publier et de gérer des projets, aux développeurs de découvrir des projets et de soumettre leur travail, et aux utilisateurs CDO de suivre la validation, la participation et l’activité des projets grâce à des tableaux de bord dédiés.

## Ce que fait la plateforme

- **Gestion de projets** : créer, lister, valider, archiver et examiner des projets.
- **Espace développeur** : demandes d’inscription des développeurs, gestion de profil, découverte de projets, participation et soumission de livrables.
- **Espace CDO** : demandes de comptes CDO, flux de validation, accès au tableau de bord, suivi des projets et archives.
- **Administration** : gérer les catégories, compétences, développeurs, partenaires CDO, participants, soumissions de projets, commissions et paramètres de l’application.
- **Soumissions et résultats** : les développeurs peuvent soumettre des liens Git, et les administrateurs/utilisateurs CDO peuvent examiner, noter, accepter et proclamer les résultats.
- **Notifications** : les notifications de l’application prennent en charge les événements liés aux projets, aux utilisateurs, aux participations, aux suppressions, aux validations et aux réponses.
- **Paiements et abonnements** : flux de paiement basé sur Stripe et enregistrements d’abonnements pour les fonctionnalités premium destinées aux développeurs, aux CDO et aux projets.

## Principaux rôles utilisateurs

| Rôle | Objectif |
| --- | --- |
| Administrateur | Supervise la plateforme, valide les utilisateurs/projets, gère les données de référence, examine les soumissions et configure les paramètres. |
| Développeur | Crée un profil, découvre des projets, participe, soumet des livrables et suit les résultats. |
| CDO | Utilise un tableau de bord partenaire pour gérer ou suivre les projets, développeurs, participations, archives et validations. |
| Invité/client | Peut accéder à la page d’accueil publique et s’inscrire/se connecter pour commencer à utiliser la plateforme. |

## Stack technique

- **Backend** : PHP 7.3+/8.x avec Laravel 8
- **Frontend** : templates Blade, Laravel Livewire 2, Bootstrap, Tailwind CSS, Flowbite et Laravel Mix
- **Base de données** : base de données compatible MySQL
- **Authentification** : authentification Laravel UI avec vérification de l’e-mail
- **Paiements** : SDK Stripe PHP
- **Support temps réel/websocket** : BeyondCode Laravel WebSockets
- **Déploiement** : image Docker basée sur Nginx + PHP-FPM

## Structure du projet

```text
app/Http/Livewire/      Composants Livewire pour les tableaux de bord, projets, utilisateurs, paiements, soumissions et paramètres
app/Models/             Modèles Eloquent pour les utilisateurs, développeurs, CDO, projets, participations, soumissions, abonnements et données de référence
app/Notifications/      Classes de notification utilisées par les flux de travail de la plateforme
database/migrations/    Schéma de base de données du domaine applicatif
resources/views/        Vues Blade et Livewire pour les pages publiques et les tableaux de bord propres à chaque rôle
routes/web.php          Routes web regroupées par middleware de rôle
public/                 Ressources publiques et fichiers frontend compilés
Dockerfile              Définition du conteneur de production
start.sh                Script de démarrage du conteneur pour PHP-FPM, le lien de stockage, les permissions et Nginx
```

## Prérequis

- PHP compatible avec la version de Laravel utilisée par ce projet (`^7.3` ou `^8.0`)
- Composer
- Node.js et npm
- MySQL ou une base de données compatible
- Identifiants Stripe si les fonctionnalités de paiement sont activées

## Installation locale

1. **Installer les dépendances PHP**

   ```bash
   composer install
   ```

2. **Installer les dépendances frontend**

   ```bash
   npm install
   ```

3. **Créer le fichier d’environnement**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer l’environnement**

   Mettez à jour `.env` avec vos paramètres locaux de base de données, mail, file d’attente, websocket et paiement. Au minimum, vérifiez ces valeurs :

   ```env
   APP_NAME=NGOffShowWork
   APP_URL=http://localhost:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ngoffshowwork
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Exécuter les migrations de base de données et créer l’administrateur par défaut**

   ```bash
   php artisan migrate --seed
   ```

6. **Créer le lien de stockage pour les fichiers téléversés/publics**

   ```bash
   php artisan storage:link
   ```

7. **Compiler les ressources frontend**

   ```bash
   npm run dev
   ```

8. **Démarrer le serveur de développement**

   ```bash
   php artisan serve
   ```

   L’application sera disponible à l’adresse `http://localhost:8000`, sauf si vous utilisez un autre hôte ou port.

## Commandes courantes

```bash
# Exécuter la suite de tests PHP
php artisan test

# Surveiller les ressources frontend pendant le développement
npm run watch

# Compiler les ressources frontend de production
npm run prod

# Vider le cache de configuration/vues/routes de Laravel
php artisan optimize:clear

# Lister les routes enregistrées
php artisan route:list
```

## Déploiement Docker

Le dépôt inclut un `Dockerfile` et `start.sh` pour un déploiement Nginx/PHP-FPM. Le script de démarrage du conteneur lance PHP-FPM, crée le lien symbolique de stockage public si nécessaire, corrige les permissions de stockage/cache et exécute Nginx au premier plan.

Lors d’un déploiement avec Docker, fournissez des variables d’environnement prêtes pour la production pour la clé de l’application, la base de données, le mail, la file d’attente, les websockets et les intégrations de paiement. L’image Docker expose les ports `80` et `9000`.

## Notes pour les mainteneurs

- Ne stockez pas les secrets, clés de paiement, mots de passe de base de données et jetons d’API dans le contrôle de source ; utilisez plutôt des variables d’environnement.
- Vérifiez les identifiants créés par les seeders avant d’utiliser ce projet dans un environnement partagé ou de production.
- Le code de paiement doit utiliser des clés Stripe basées sur l’environnement avant une utilisation en production.
- Plusieurs flux de travail sont protégés par rôle ; testez donc les changements avec des comptes administrateur, développeur et CDO lorsque c’est possible.

## Licence

Aucun fichier de licence propre au projet n’est actuellement inclus dans ce dépôt. Ajoutez une licence avant de distribuer ou de publier l’application en open source.
