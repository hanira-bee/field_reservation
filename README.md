[![GitHub stars](https://img.shields.io/github/stars/hanira-bee/field_reservation.svg?style=social)](https://github.com/hanira-bee/field_reservation/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/hanira-bee/field_reservation.svg)](https://github.com/hanira-bee/field_reservation/network)
[![license](https://img.shields.io/badge/License-MIT-brightgreen.svg)](https://choosealicense.com/licenses/mit/)

# 🏟 Field Reservation System (Laravel 13)

A **sports field reservation system** built with **Laravel 13** and **MySql**, designed for learning and portfolio purposes.

⚠ **Note:** This project is for portfolio/demo only, not intended for production use.

## 📄 Requirements
- PHP >= 8.5
- Node.js & NPM
- MySQL
- Laravel 13.21
- Composer

## 📑 Features 
### 🔖 **User Side**
- 🏠 View the Homepage
- ⚽ Check the list of available fields
- 📆 View the sport field schedule
- 🔐 Login and register
- 💳 Make a reservation and view history
- 👤 Customise Profile

### 🔖 **Admin Dashboard**
- 📊 View booking and user statistics  
- 🔔 View booking updates 
- 🎛️ Manage fields & reservations  
- 👥 Manage account & reports

## 🛠 Installation Guide
### **Step 1: Clone the Repository**
```sh
git clone https://github.com/hanira-bee/field_reservation.git
cd field_reservation
```

### **Step 2: Install Dependencies**
``` sh 
composer install
npm install
```

### **Step 3: Environment Setup**
```sh
cp .env.example .env
php artisan key:generate
```
Update .env with your database credentials

### **Step 4: Run Migrations & Seeders**
``` sh
php artisan migrate --seed
```

### **Step 5: Link Storage**
``` sh
php artisan storage:link
```

### **Step 6: Run the Application**
``` sh
php artisan serve
```
Open http://localhost:8000

## ▶ Demo Video
[![Demo Video](https://img.youtube.com/vi/Yu2yqdc8LNU/0.jpg)](https://youtu.be/Yu2yqdc8LNU)

## 📜 License
This project is licensed under the MIT Licensed © 2026 Hanira-Bee & iampoetry
Feel free to use & modify for learning purposes.

## 🐝 Author
- **Hanira-Bee** https://github.com/hanira-bee
- **Email** rinnieera@gmail.com 
- **Linkedin** https://www.linkedin.com/in/putri-ramadhani-b208b4385/

✨don't forget to star the repo if you find this project helpful!✨
