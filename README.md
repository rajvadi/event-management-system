# Event Management System (Laravel + Tailwind CSS)

A modern, responsive Event Management System built with **Laravel** and **Tailwind CSS**.
This project allows users to **create, manage, and view events** with a clean UI and optimized UX.

---

## Features

### Event Listing

* Responsive **table + card layout**
* Displays:

  * Event Name
  * Date & Time
  * Price
  * Capacity
  * Status (Upcoming / Completed)
  * Event Image
* Search by event name
* Filter by status
* Pagination (custom styled)
* Edit event
* Delete event with confirmation modal

---

### Create / Edit Event

* Reusable form for Create & Edit
* Fields:

  * Event Name
  * Description
  * Date & Time
  * Price
  * Capacity
  * Status
  * Image Upload
* Form validation using **Form Request**
* Submit button loading state
* Live image preview with remove option

---

## Tech Stack

* **Backend:** Laravel
* **Frontend:** Blade + Tailwind CSS
* **Database:** MySQL
* **Build Tool:** Vite

---

## Installation

```bash
# Clone repository
git clone <your-repo-url>

# Go to project
cd event-management-system

# Install dependencies
composer install
npm install
npm run build

# Copy env
cp .env.example .env

# Generate key
php artisan key:generate
```

---

## Database Setup

Update `.env`:

```env
DB_DATABASE=event_management
DB_USERNAME=root
DB_PASSWORD=
```

Run:

```bash
php artisan migrate --seed
```

---

## Storage Setup

```bash
php artisan storage:link
```

---

## Run Project

```bash
php artisan serve
npm run dev
```

Open:

```
http://127.0.0.1:8000
```

---

## 👨‍💻 Author

**Raj Vadi**
