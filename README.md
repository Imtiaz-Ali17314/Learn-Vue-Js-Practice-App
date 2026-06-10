# 🎓 Learn Vue.js Practice App

<p align="center">
  <img src="https://img.shields.io/badge/Vue.js-3.x-4fc08d?style=for-the-badge&logo=vue.js&logoColor=white" alt="Vue 3">
  <img src="https://img.shields.io/badge/Laravel-12.x-ff2d20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-563d7c?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/SQLite%20/%20MySQL-Supported-00758f?style=for-the-badge&logo=sqlite&logoColor=white" alt="Database">
  <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="License">
</p>

Welcome to the **Vue.js Learning Hub & Practice Workspace**! This is not just a repository of code—it is a living, breathing log of my learning journey. It represents my hands-on approach to mastering Vue 3 from the ground up, moving past passive tutorial consumption to active, real-world execution.

Here, I have consolidated my experiments, core concepts, and sandbox projects in one cohesive environment, connected to a robust Laravel 12 backend to simulate real-world full-stack scenarios.

🔗 **Repository Link:** [https://github.com/Imtiaz-Ali17314/Learn-Vue-Js-Practice-App.git](https://github.com/Imtiaz-Ali17314/Learn-Vue-Js-Practice-App.git)

---

## 🗺️ The Learning Journey & Roadmap Milestone

> **"Theory is good, but building is where true mastery happens."**

According to my personal project ranking roadmap, this repository is a pivotal milestone. Having completed all my basic and intermediate learning projects, this workspace serves as the **bridge to advanced front-end and full-stack development**. It represents the transition point where I stepped up from static JavaScript/CSS layouts to reactive modern component frameworks.

### How I Approached Mastering Vue.js:
- **Academic Discipline & Notes:** I documented my learning process step-by-step in the structured **`Vue Js Notes.docx`** document, ensuring I understood the core principles (directives, hooks, state lifecycle) before writing a single line of code.
- **Hands-On Sandboxing:** Instead of building simple throwaway snippets, I built dedicated, fully-styled interactive components inside a multi-page app with dynamic routing, transition animations, and a centralized dashboard.
- **Full-Stack Integration:** I challenged myself to bridge the client-side with a backend server by building a Laravel 12 API that handles Sanctum CSRF cookies and saves uploads to database storage, getting hands-on experience with real CORS-configured API endpoints.
- **Curiosity & Tooling Exploration:** I explored two separate paradigms for form handling: building a manual, customized validator engine in JavaScript (complete with input binding validations) and working with FormKit rules and schemas using the Genesis theme.

This project stands as a testament to my dedication, consistency, and curiosity in learning new technologies. It represents the hours spent debugging CORS issues, styling custom components, and integrating frontend views with databases—ultimately paving the way for my advanced SaaS applications.

---

## 📂 Repository Architecture

The repository is logically divided into three parts: the frontend application, the API backend server, and interactive learning notes:

```directory
Learn-Vue-Js-Practice-App/
├── first-project/              # ⚡ Vue 3 Frontend Client (Bootstrap 5, FormKit, Router, Axios)
├── file-upload-backend/        # 🐘 Laravel 12 API Backend (Sanctum CSRF, Storage Disk, SQLite/MySQL)
└── Vue Js Notes.docx           # 📝 MS Word document containing structured Vue.js learning material
```

---

## 🚀 Key Features Walkthrough

### 1. 🏠 Vue.js Learning Hub (Dashboard)
- **Concept:** Asynchronous API data fetching using Axios.
- **Action:** A dedicated control panel that pulls placeholder mock posts from `JSONPlaceholder`.
- **UI Details:** Uses animated spinners, customized disabled states during fetching, and displays posts inside beautiful hover-reactive cards styled with Bootstrap 5.

### 2. 📞 Custom Contact Form Validation
- **Concept:** Client-side reactive input validation with real-time blur and typing checks.
- **Rules Validated:**
  - **Full Name:** Required.
  - **Email Address:** Format and pattern validation (RegEx).
  - **Mobile Number:** Digit length constraints (minimum 4, maximum 11 digits).
  - **Gender & Degree:** Custom radio and select option requirements.
  - **Terms Acceptance:** Required checkbox check.
- **UI Details:** Dynamic validation classes (`is-invalid`/`is-valid`), clean custom error state rendering, and alert banners for success/failure feedback.

### 3. 🛡️ FormKit Form Validation Sandbox
- **Concept:** Form simplification and standard validation rules using the library **FormKit**.
- **Features Showcase:** Integrates registration fields (Name, Email, Password, Confirm Password, Mobile, Gender, Subjects, Agreement Checkbox) with native validation rules (`validation="required|email|confirm"`).
- **UI Details:** Genesis FormKit theme styling, automatic error prompt generation, and a live rendering block displaying the JSON output of the form payload upon successful registration.

### 4. 🎨 Composition API Color Palette Generator
- **Concept:** Reactive properties (`ref`) and runtime hook setup using the **Vue 3 Composition API**.
- **Interactive Experience:** Generates randomized RGB and HEX colors instantly, transition-animates the background color, and includes a one-click clipboard copying mechanism (`navigator.clipboard.writeText`) with toast-like success indicators.

### 5. 📝 REST API Mock CRUD Sandbox (Posts)
- **Concept:** Full REST operations (GET, POST, PUT, DELETE) linked to mock APIs.
- **Interactive Experience:** 
  - Create, read, update, and delete posts interactively.
  - A sticky side-panel switches context seamlessly between "Create Post" and "Edit Post".
  - Scroll-to-view helper actions on mobile viewports.
  - Integrates `animate.css` for smooth slide-in listings.

### 6. 📁 Full-Stack Multi-File Asynchronous Uploader
- **Concept:** Cross-Origin file upload system (`multipart/form-data`) with instant validation and a persistent gallery.
- **Frontend Capabilities:** 
  - Drag & Drop zone with active drop animations.
  - Extension validator (allows image types only).
  - File size validator (guards against uploads larger than 5MB).
  - Asynchronous reader preview (`FileReader` data URIs) with removal handles.
- **Backend Capabilities:** 
  - Laravel 12 API with Sanctum CSRF cookie initialization.
  - Multi-file storage validation and local symbol links.
  - Database persistence mapping the files to user records.
  - Endpoint for soft/hard media deletions (`unlink` local file storage).

---

## 🛠️ Technology Stack

| Component | Technology | Version / Description |
| :--- | :--- | :--- |
| **Frontend Core** | Vue 3 | Reactivity, Composition API (`ref`, `setup`), Options API |
| **Frontend Routing** | Vue Router | Route definition, Route meta-data page title overrides |
| **Frontend Style** | Bootstrap 5 | Modern fluid grid layout, responsive form elements |
| **Form Engine** | FormKit | Standardized form fields with Genesis styles |
| **Animations** | Animate.css | Fluid entry animations for the posts list |
| **Icons** | Font Awesome 7 | Sleek vector icons throughout the dashboard |
| **Backend Core** | Laravel 12 | Route resources, API controllers, Request Validation |
| **CORS / Session** | Laravel Sanctum | CORS configuration mapping with stateful session hooks |
| **Database ORM** | Eloquent ORM | Model mapping, migration structures |

---

## ⚙️ Project Setup & Installation

### Prerequisites
Before setting up the project, make sure you have the following installed on your machine:
- **Node.js** (v16+)
- **PHP** (v8.2+)
- **Composer**
- **Git**

---

### 1. Clone the Repository

First, clone the repository from GitHub and navigate to the project root:
```bash
git clone https://github.com/Imtiaz-Ali17314/Learn-Vue-Js-Practice-App.git
cd Learn-Vue-Js-Practice-App
```

---

### 2. Backend Server Setup (`file-upload-backend`)

1. Open your terminal and navigate to the backend folder:
   ```bash
   cd file-upload-backend
   ```

2. Install Composer dependencies:
   ```bash
   composer install
   ```

3. Configure your Environment variables:
   - Copy the environment template:
     ```bash
     copy .env.example .env
     ```
   - Generate your Application cryptographic key:
     ```bash
     php artisan key:generate
     ```

4. Configure your Database:
   - By default, you can configure a MySQL database by adjusting the database credentials inside the `.env` file:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=file_upload
     DB_USERNAME=root
     DB_PASSWORD=
     ```
   - Alternatively, you can run it on SQLite by creating a database file `database/database.sqlite` and changing the `DB_CONNECTION` inside `.env` to `sqlite`.

5. Run database migrations to create the `users` table:
   ```bash
   php artisan migrate
   ```

6. Create the symbolic link so files stored privately can be accessed publicly:
   ```bash
   php artisan storage:link
   ```

7. Start the local Laravel development server:
   ```bash
   php artisan serve
   ```
   *The server will boot up by default on `http://127.0.0.1:8000` (or `localhost:8000`).*

---

### 3. Frontend Client Setup (`first-project`)

1. Open a new terminal and navigate to the frontend folder:
   ```bash
   cd first-project
   ```

2. Install Node modules and dependencies:
   ```bash
   npm install
   ```

3. Run the hot-reloading development server:
   ```bash
   npm run serve
   ```
   *By default, the client will start on `http://localhost:8080`.*

---

## 🔒 CORS & Sanctum Authentication Configuration

For the **File Uploader** to work seamlessly across different origins, the backend has been configured to trust client requests:

1. **CORS Configuration** (`file-upload-backend/config/cors.php`):
   ```php
   'allowed_origins' => ['http://localhost:8080'],
   'supports_credentials' => true,
   ```
2. **Sanctum Environment Variables** (`file-upload-backend/.env`):
   Ensure that the domain matches your local ports:
   ```env
   SANCTUM_STATEFUL_DOMAINS=localhost:8080,127.0.0.1:8080
   SESSION_DOMAIN=localhost
   ```

These settings ensure that axios cookies are accepted and files are safely uploaded/deleted under Sanctum CSRF protection.

---

## 📄 License
This project is open-source software licensed under the [MIT License](https://opensource.org/licenses/MIT).
