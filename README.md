# 🍹 Cocktails App

## 📌 Introduction
Cocktails App est une application web permettant aux utilisateurs de découvrir, créer et partager des recettes de cocktails. Elle permet de rechercher des cocktails en fonction des ingrédients disponibles, d'ajouter de nouvelles recettes et de voter pour les meilleures créations.

## 🛠 Technologies utilisées
Ce projet utilise les technologies suivantes :

- **Backend** : Laravel (PHP) + MariaDB
- **Frontend** : Vue.js + Tailwind CSS
- **Base de données** : MariaDB
- **Autres outils** : Docker (optionnel), GitHub Actions (CI/CD)

## 📂 Structure du projet
Le projet est organisé en deux dossiers principaux :

```
cocktails-app/
│-- backend/      # API Laravel et base de données
│-- frontend/     # Interface utilisateur Vue.js
│-- .gitignore    # Fichiers à ignorer pour Git
│-- README.md     # Documentation du projet
```

## 🚀 Installation & Configuration

### 1️⃣ Cloner le projet
```bash
git clone https://github.com/ton-utilisateur/cocktails-app.git
cd cocktails-app
```

### 2️⃣ Installer le backend (Laravel)
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

Configurer la base de données dans `.env` :
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cocktails_db
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

Puis, exécuter les migrations :
```bash
php artisan migrate --seed
```

### 3️⃣ Installer le frontend (Vue.js)
```bash
cd ../frontend
npm install
```

## 🖥 Lancement du projet

### 1️⃣ Démarrer le backend (API Laravel)
```bash
cd backend
php artisan serve
```
L'API est maintenant accessible sur `http://127.0.0.1:8000`.

### 2️⃣ Démarrer le frontend (Vue.js)
```bash
cd frontend
npm run dev
```
L'interface utilisateur est disponible sur `http://localhost:5173`.

## 🏗 Contribuer au projet

### 1️⃣ Forker le projet
Cliquez sur **Fork** en haut à droite du dépôt GitHub.

### 2️⃣ Créer une branche
```bash
git checkout -b feature/nom-de-la-fonctionnalite
```

### 3️⃣ Ajouter et commit les changements
```bash
git add .
git commit -m "Ajout d'une nouvelle fonctionnalité"
```

### 4️⃣ Pousser la branche et créer une Pull Request
```bash
git push origin feature/nom-de-la-fonctionnalite
```
Allez sur GitHub et créez une Pull Request pour fusionner votre contribution.

## 📜 Licence
Ce projet est sous licence MIT.

## 📞 Contact
Pour toute question, vous pouvez me contacter via GitHub ou sur discord **https://discord.quantumcraft-studios.com/**.

