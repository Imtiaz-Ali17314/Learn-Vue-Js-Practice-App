# 🎓 Learn Vue.js Practice App

<p align="center">
  <img src="https://img.shields.io/badge/Vue.js-3.x-4fc08d?style=for-the-badge&logo=vue.js&logoColor=white" alt="Vue 3">
  <img src="https://img.shields.io/badge/Laravel-12.x-ff2d20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-563d7c?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/SQLite%20/%20MySQL-Supported-00758f?style=for-the-badge&logo=sqlite&logoColor=white" alt="Database">
  <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="License">
</p>

Welcome to the **Vue.js Learning Hub & Practice Workspace**! This repository is designed as a learning project that showcases core Vue 3 concepts, client-side form validations, dynamic routing, REST API integrations, and a full-stack asynchronous file uploader backed by a robust Laravel 12 API.

Whether you are here to learn the fundamentals of reactive state management, explore **FormKit** form systems, or understand cross-origin session/cookie authentication via **Laravel Sanctum**, this repository provides a practical, clean, and interactive sandbox environment.

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

---

### 1. Backend Server Setup (`file-upload-backend`)

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

### 2. Frontend Client Setup (`first-project`)

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

## 📝 Study Material

If you are following along to learn Vue.js, do check out the file **[Vue Js Notes.docx](file:///d:/for%20CV/My%20Projects/Learn-Vue-Js-Practice-App/Vue%20Js%20Notes.docx)** at the root of the project. It provides an excellent companion guide summarizing the theoretical underpinnings of Vue.js, directives (`v-bind`, `v-model`, `v-if`, `v-for`), methods, reactive hooks, and state cycles.

---

## 📄 License
This project is open-source software licensed under the [MIT License](https://opensource.org/licenses/MIT).
