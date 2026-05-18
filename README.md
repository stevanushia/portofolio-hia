# Stevanus Hia - Professional Tech Portfolio

A professional, minimalist, and high-performance tech portfolio built for Full Stack Developers. This project showcases technical expertise, projects, and skills through a sleek, modern interface.

## 🚀 Tech Stack

- **Backend:** [Laravel 11](https://laravel.com/)
- **Frontend Framework:** [Vue.js 3](https://vuejs.org/)
- **Frontend Integration:** [Inertia.js](https://inertiajs.com/) (The modern monolith)
- **Styling:** [Tailwind CSS](https://tailwindcss.com/)
- **Database:** [PostgreSQL](https://www.postgresql.org/)
- **Build Tool:** [Vite](https://vitejs.dev/)

## ✨ Key Features

- **Minimalist & Sleek Design:** Focuses on clean typography and whitespace.
- **Single Page Application (SPA) Experience:** Powered by Inertia.js for seamless transitions.
- **Dynamic Projects Gallery:** Manage and showcase projects through a robust backend.
- **Expertise Matrix:** Visual representation of technical skills and proficiency.
- **Responsive Design:** Optimized for all screen sizes from mobile to desktop.
- **Dark Mode Support:** Built with dark mode aesthetics in mind.

## 🛠️ Installation & Setup

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & NPM
- PostgreSQL (running locally or via a service)

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/stevanushia/portofolio-hia.git
   cd portofolio-hia
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install JS dependencies:**
   ```bash
   npm install
   ```

4. **Configure your environment:**
   - Copy `.env.example` to `.env`
   - Update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` to match your PostgreSQL setup.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run migrations and seed data:**
   ```bash
   php artisan migrate --seed
   ```

6. **Compile frontend assets:**
   ```bash
   npm run dev
   ```

7. **Start the Laravel server:**
   ```bash
   php artisan serve
   ```

Open `http://localhost:8000` in your browser to see the portfolio.

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
