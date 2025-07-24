# Alumni Management System (alumni1)

The **Alumni Management System (alumni1)** is a web-based portal designed to connect alumni, students, and the institution under one platform.  
This project helps in managing alumni data, events, and interactions in a structured way while providing **admin control** over user approvals and content management.

---

## **Overview**

Educational institutions often struggle to maintain an up-to-date record of their alumni and keep them engaged with ongoing activities.  
This project was developed to address this challenge by providing:
- A **centralized alumni database**.
- A **gallery and events section** for showcasing alumni meets.
- An **admin approval system** to verify and manage user registrations.
- A user-friendly and responsive design to make navigation simple.

The project is fully dynamic, driven by **PHP and MySQL**. The admin can add or update content directly through the dashboard without touching the code.

---

## **How This Project Was Built**
The project was built using the following workflow:
1. **Backend (PHP + MySQL):**
   - PHP handles user authentication, database queries, and admin approvals.
   - MySQL database stores alumni details, events, and gallery data.
2. **Frontend (HTML + CSS + JS):**
   - The frontend was built with clean HTML and CSS for layouts.
   - JavaScript was used for interactivity and validation.
3. **XAMPP Environment:**
   - Apache server runs PHP scripts locally.
   - MySQL is managed via **phpMyAdmin**.
4. **Version Control:**
   - Git and GitHub were used for versioning and project backups.

---

## **Features**

### **User Features**
- User registration with verification by admin.
- Login and access to alumni-related pages (gallery, forums, careers).
- View images and updates posted by the admin.

### **Admin Features**
- Admin dashboard to manage alumni records.
- Approve or reject newly registered users.
- Upload images and manage the gallery section.
- Edit content for different sections (About, Events, etc.).

### **Security**
- Passwords are stored using **MD5 hashing** for basic security.
- SQL queries are handled through **MySQLi**.

---

## **Technology Stack**
- **Backend:** PHP 8.x
- **Database:** MySQL (via phpMyAdmin)
- **Frontend:** HTML5, CSS3, JavaScript
- **Server:** Apache (XAMPP)
- **Version Control:** Git & GitHub
- **OS Compatibility:** Windows/Linux/Mac (with XAMPP)

---

## **Project Setup Instructions**

### **1. Clone or Download**
```bash
git clone https://github.com/RishiBansal341/alumni1.git
