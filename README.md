# Pearl Trails ??????

Pearl Trails is a modern tourism web application for discovering the breathtaking destinations, wildlife safaris, and rich cultural heritage of Uganda - the Pearl of Africa.

---

## ??? Tech Stack & Setup Instructions

### Prerequisites
- PHP 8.2 or higher
- Composer
- SQLite (included out-of-the-box)

### Setup Steps
```powershell
# 1. Clone the repository
git clone https://github.com/Raynel-dotcom/pearl-trails.git
cd pearl-trails

# 2. Install PHP dependencies
composer install

# 3. Environment configuration
copy .env.example .env

# 4. Generate Application Encryption Key
php artisan key:generate

# 5. Run Database Migrations (SQLite)
php artisan migrate

# 6. Start Development Server
php artisan serve
```

Visit the app live in your browser at `http://127.0.0.1:8000`.

---

## ?? Testing

To run the automated feature and unit test suite:
```powershell
php artisan test
```

---

## ?? Git Branching Plan & Workflow

All development follows a disciplined Git branching model:

- **`main`**: Production-ready, stable baseline code.
- **`develop`**: Primary integration branch for active development.
- **`feature/*`**: Feature-specific branches created off `develop` (one branch per feature).

> **Rule**: All new work is created on a `feature/*` branch and merged back into `develop` via pull requests.
