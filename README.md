# 🏭 Textile Admin Panel

This project is an **Admin Panel for a Textile Warehouse**, built with **Laravel (PHP)** and **MySQL**.  
It helps manage product categories, types, colors, stock (income/expense), and provides statistics with search and filtering.  
The system also includes **authentication (register & login)** for secure access.  

---

## 🚀 Features
- **Authentication** – secure register/login system.  
- **Category Management** – manage product categories.  
- **Type Management** – add types with name, category, and price.  
- **Color Management** – assign colors to product types and categories.  
- **Income/Expense Tracking** – record product stock movements (who, when, how much).  
- **Statistics Page** – filter by category, type, income/expense, daily or monthly reports.  
- **Search System** – available across all pages.  

---

## 🗄️ Database Setup
⚠️ **Important:** Do **not** run `php artisan migrate`.  
Relationships were created **manually in phpMyAdmin**, so you must use the provided SQL files.  

You have two options inside the `database/` folder:  

1. **schema.sql** → creates only tables and relationships (empty database).  
2. **sample_data.sql** → creates tables + inserts example/sample records.  

### Steps:
1. Create a new database (e.g., `laravel_end`).  
2. Import one of the SQL files:  
   - Use `schema.sql` if you want a clean database.  
   - Use `sample_data.sql` if you want example records for testing.  
3. Configure your `.env` file with database credentials:  

```env
DB_DATABASE=laravel_end
DB_USERNAME=root
DB_PASSWORD=
```

---

## ⚙️ How to Run Locally
**Clone the repository:**  
1. composer install  
2. npm install && npm run dev

Configure `.env` (copy from `.env.example`).
Import `schema.sql` or `sample_data.sql` into MySQL.

**Start Laravel Server**
1. php artisan serve

**Open in your browser:**
1. 👉 http://localhost:8000

---

## 📂 Project Structure  
│── app/                → Laravel application core  
│── public/             → Public assets  
│── resources/          → Blade templates (views)  
│── routes/             → Web routes  
│── database/schema.sql → Database schema (only tables & relationships)  
│── database/sample_data.sql → Database with example/sample records  
│── README.md           → Documentation  


## 👨‍💻 Author
- [MuhammadYusuf Akramov](https://github.com/Yusufxon790)  
- 📧 Email: akramovyusufxon590@gmail.com  

---

## 📝 License
This project is for **educational purposes**.  
Feel free to use, modify, or improve it.  

---

## 📝 Notes
• Do not use `php artisan migrate` for this project.  
• Always use either `schema.sql` or `sample_data.sql` for setup.  
• This project is intended for managing a textile warehouse’s admin panel.
