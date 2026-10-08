# Pearl Trails - Tourism Web Application for Uganda 🌿

Pearl Trails is a modern tourism web application designed for exploring Uganda, the Pearl of Africa. Discover national parks, gorilla trekking, wildlife safaris, cultural trails, and plan custom travel itineraries.

---

## 📋 Table of Contents
- [Prerequisites](#-prerequisites)
- [Quick Start Guide](#-quick-start-guide)
- [Project Directory Structure](#-project-directory-structure)
- [Available Routes](#-available-routes)
- [Testing](#-testing)
- [Git Branching Strategy](#-git-branching-strategy)

---

## ⚙️ Prerequisites

Before running Pearl Trails, ensure you have the following installed on your machine:

- **PHP 8.2+** (`php -v`)
- **Composer 2.x+** (`composer --version`)
- **Git** (`git --version`)
- **SQLite3** extension for PHP (included with standard PHP)

---

## 🚀 Quick Start Guide

Follow these step-by-step commands to get the application up and running locally:

### 1. Clone the Repository
```bash
git clone https://github.com/Raynel-dotcom/pearl-trails.git
cd pearl-trails
```

### 2. Switch to the Integration Branch (`develop`)
```bash
git checkout develop
```

### 3. Install PHP Dependencies
```bash
composer install
```

### 4. Setup Environment File
Copy `.env.example` to `.env`:
```powershell
# Windows (PowerShell)
copy .env.example .env

# macOS / Linux / Git Bash
cp .env.example .env
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Create SQLite Database & Run Migrations
```powershell
# Ensure database file exists (PowerShell)
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File -Path database/database.sqlite }

# Run database migrations
php artisan migrate
```

### 7. Start the Development Server
```bash
php artisan serve
```

🎉 Open your browser and navigate to **[http://127.0.0.1:8000](http://127.0.0.1:8000)** to view the application!

---

## 📂 Project Directory Structure

```
pearl-trails/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── PageController.php      # Main controller for page routes
│   ├── Models/
│   │   └── User.php                    # Eloquent Model definitions
│   ├── Providers/
│   └── Services/                       # Service classes & business logic (.gitkeep)
├── bootstrap/                          # Framework bootstrap & app.php
├── config/
│   ├── app.php                         # Configured for Africa/Kampala timezone
│   └── explore.php                     # Configuration array placeholder
├── database/
│   ├── database.sqlite                 # Local SQLite database (ignored by Git)
│   ├── factories/                      # Model test factories
│   ├── migrations/                     # Database schema migrations
│   └── seeders/                        # Database seeders
├── public/
│   ├── css/
│   │   └── app.css                     # Custom Green & Gold design tokens & layout CSS
│   └── index.php                       # Front controller entry point
├── resources/
│   └── views/
│       ├── components/                 # Reusable Blade components (.gitkeep)
│       ├── layouts/
│       │   └── app.blade.php           # Base HTML layout template (Header, Nav, Footer)
│       └── pages/                      # Page Blade views
│           ├── home.blade.php          # Home page
│           ├── destinations.blade.php  # Destinations page
│           ├── plan.blade.php          # Plan My Trip page
│           ├── interest.blade.php      # Explore by Interest page
│           ├── saved.blade.php         # Saved Trips page
│           └── about.blade.php         # About page
├── routes/
│   ├── console.php                     # Artisan CLI command routes
│   └── web.php                         # Web application route definitions
├── storage/                            # Compiled views, session, cache & app logs
├── tests/
│   ├── Feature/
│   │   └── PageRoutesTest.php          # Route status & layout assertion tests
│   └── Unit/                           # Unit tests
├── .env                                # Environment variables (ignored by Git)
├── .env.example                        # Environment variable template
├── .gitignore                          # Pre-configured Git exclusion rules
├── artisan                             # Laravel CLI executable
├── composer.json                       # PHP dependency manifest
└── README.md                           # Project documentation
```

---

## 🗺️ Available Routes

| Route URL | Controller Action | Description |
| :--- | :--- | :--- |
| `/` | `PageController@home` | Home page & featured overview |
| `/destinations` | `PageController@destinations` | Destination listings & park guides |
| `/plan` | `PageController@plan` | Custom trip builder & itinerary planner |
| `/interest/{interest?}` | `PageController@interest` | Explore activities by interest (e.g. Gorilla Trekking, Wildlife) |
| `/saved` | `PageController@saved` | Bookmarked trips and saved itineraries |
| `/about` | `PageController@about` | Information about Pearl Trails |

---

## 🧪 Running Tests

Pearl Trails includes automated tests to verify route availability and view rendering.

Run the test suite with:
```bash
php artisan test
```

---

## 🌿 Git Branching Strategy

Development follows a strict branching workflow:

- **`main`**: Production-ready, stable releases.
- **`develop`**: Active integration branch for new features.
- **`feature/<feature-name>`**: Dedicated topic branch for individual features created off `develop`.

---

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).