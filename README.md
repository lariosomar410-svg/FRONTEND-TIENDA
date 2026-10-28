# 🚀 Sistema de Gestión de Tareas (Fullstack)

Aplicación web completa desarrollada con un backend en **Laravel** y un frontend moderno en **React + Vite**.

---

## 🛠️ Tecnologías Utilizadas

* **Backend:** Laravel (PHP)
* **Frontend:** React + Vite (JavaScript / Oxlint)
* **Estilos / Componentes:** CSS / Tailwind

---

## 📁 Estructura del Proyecto

* `api-laravel/` - API RESTful encargada de la lógica de negocio y base de datos.
* `frontend-tareas/` - Interfaz de usuario interactiva consumiendo la API.

---

## ⚡ Instalación y Configuración Local

### 1. Backend (Laravel)
```bash
cd api-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
