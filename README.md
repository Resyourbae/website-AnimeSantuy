<div align="center">

![Anime AI App Banner](public/assets/images/mybini.jpg)

# 🎌 Anime AI - Laravel Application

**Discover, Explore, and Get AI-Powered Anime Recommendations**

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

<img src="https://readme-typing-svg.demolab.com?font=Fira+Code&size=22&duration=3000&pause=1000&color=FF2D20&center=true&vCenter=true&width=600&lines=Welcome+to+Anime+AI+Platform!;Discover+Your+Next+Favorite+Anime;AI-Powered+Recommendations;Built+with+Laravel+%26+Love+%E2%9D%A4%EF%B8%8F" alt="Typing SVG" />

</div>

---

## 📋 Table of Contents

- [✨ Features](#-features)
- [🛠️ Tech Stack](#️-tech-stack)
- [📦 Prerequisites](#-prerequisites)
- [🚀 Installation & Setup](#-installation--setup)
- [⚙️ Configuration](#️-configuration)
- [🎨 Tailwind CSS Setup](#-tailwind-css-setup)
- [🧪 Testing](#-testing)
- [📸 Screenshots](#-screenshots)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

---

## ✨ Features

🎯 **Core Features:**

- 📺 Browse top anime from Jikan API (MyAnimeList)
- 🔍 Search anime by title, genre, or rating
- 💬 AI-powered chatbot for personalized recommendations
- 🎨 Modern, responsive UI with Tailwind CSS
- ⚡ Fast and optimized Laravel backend

🤖 **AI Integration:**

- Smart anime recommendations based on preferences
- Natural language chat interface
- Context-aware responses using anime database

---

## 🛠️ Tech Stack

| Category       | Technology                     |
| -------------- | ------------------------------ |
| **Framework**  | Laravel 11.x                   |
| **Frontend**   | Blade Templates + Tailwind CSS |
| **Database**   | MySQL / PostgreSQL             |
| **API**        | Jikan API (MyAnimeList)        |
| **AI Service** | OpenAI / Gemini API            |
| **Build Tool** | Vite                           |

---

## 📦 Prerequisites

Pastikan sistem Anda sudah terinstall:

- ✅ PHP >= 8.2
- ✅ Composer
- ✅ Node.js & npm (v18 atau lebih baru)
- ✅ MySQL / PostgreSQL
- ✅ Git

---

## 🚀 Installation & Setup

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/anime-ai.git
cd anime-ai
```

### 2️⃣ Install PHP Dependencies

```bash
composer install
```

### 3️⃣ Install Node.js Dependencies

```bash
npm install
```

### 4️⃣ Setup Environment File

Salin file `.env.example` menjadi `.env`:

```bash
# Windows (PowerShell)
copy .env.example .env

# Linux / macOS
cp .env.example .env
```

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

> **💡 Penting:** Perintah ini akan menghasilkan `APP_KEY` yang unik untuk aplikasi Anda. Key ini digunakan untuk enkripsi data.

### 6️⃣ Configure Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=anime_ai
DB_USERNAME=root
DB_PASSWORD=
```

### 7️⃣ Run Database Migrations

```bash
php artisan migrate
```

Optional - Seed database dengan data anime:

```bash
php artisan db:seed
```

---

## ⚙️ Configuration

### 🔑 API Keys Setup

Edit file `.env` dan tambahkan API keys yang diperlukan:

```env
# Jikan API (MyAnimeList)
ANIME_API_URL=https://api.jikan.moe/v4

# OpenAI API (untuk AI Chat)
OPENAI_API_KEY=your-openai-api-key-here

# Atau gunakan Gemini API
GEMINI_API_KEY=your-gemini-api-key-here
```

> **📝 Catatan:**
>
> - **Jikan API** tidak memerlukan API key, gratis untuk digunakan
> - **OpenAI API** bisa didapat di: https://platform.openai.com/api-keys
> - **Gemini API** bisa didapat di: https://ai.google.dev/

---

## 🎨 Tailwind CSS Setup

### 1️⃣ Install Tailwind CSS

Tailwind CSS sudah termasuk dalam `package.json`. Jalankan:

```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p
```

### 2️⃣ Configure Tailwind

File `tailwind.config.js` sudah dikonfigurasi. Pastikan isinya seperti ini:

```javascript
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
```

### 3️⃣ Add Tailwind Directives

File `resources/css/app.css` harus berisi:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### 4️⃣ Build Assets

Untuk development (dengan hot reload):

```bash
npm run dev
```

Untuk production build:

```bash
npm run build
```

---

## 🏃 Running the Application

### Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://localhost:8000**

### With Vite Dev Server (untuk hot reload CSS/JS)

Di terminal pertama:

```bash
php artisan serve
```

Di terminal kedua:

```bash
npm run dev
```

---

## 🧪 Testing

### Run Tests

```bash
php artisan test
```

### Test API Endpoints

Test Jikan API connection:

```bash
# Buka di browser atau curl
http://localhost:8000/test-jikan
```

Test service configuration:

```bash
# Buka di browser
http://localhost:8000/dump-anime-url
```

---

## 📸 Screenshots

<div align="center">

### 🏠 Homepage - Top Anime

![Homepage](docs/screenshots/homepage.png)

### 💬 AI Chat Interface

![AI Chat](docs/screenshots/chat.png)

### 📱 Responsive Design

![Responsive](docs/screenshots/responsive.png)

</div>

---

## 📁 Project Structure

```
anime-ai/
├── app/
│   ├── Http/Controllers/      # Controllers
│   ├── Models/                 # Eloquent Models
│   ├── Services/               # Business Logic
│   └── Helpers/                # Helper Classes
├── config/                     # Configuration Files
├── database/                   # Migrations & Seeders
├── public/                     # Public Assets
├── resources/
│   ├── css/                    # Stylesheets
│   ├── js/                     # JavaScript
│   └── views/                  # Blade Templates
├── routes/                     # Route Definitions
└── tests/                      # Test Files
```

---

## 🐛 Troubleshooting

### Port 8000 sudah digunakan?

```bash
php artisan serve --port=8080
```

### CSS tidak muncul?

Pastikan Vite dev server berjalan:

```bash
npm run dev
```

### Database connection error?

Periksa konfigurasi database di `.env` dan pastikan MySQL/PostgreSQL sudah berjalan.

---

## 🤝 Contributing

Kontribusi sangat diterima! Berikut caranya:

1. Fork repository ini
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📝 To-Do List

- [ ] Add user authentication
- [ ] Implement favorites/watchlist
- [ ] Add anime rating system
- [ ] Create mobile app (Flutter/React Native)
- [ ] Add anime streaming integration
- [ ] Implement advanced search filters
- [ ] Add social sharing features

---

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Author

**Your Name**

- GitHub: [@username](https://github.com/username)
- Email: your.email@example.com

---

<div align="center">

### ⭐ Star this repo if you like it!

**Made with ❤️ and Laravel**

<img src="https://raw.githubusercontent.com/andreasbm/readme/master/assets/lines/rainbow.png" alt="separator">

_Happy Coding! 🚀_

</div>
