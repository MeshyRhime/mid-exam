# mid-exam
This session covers the complete lifecycle of a local and remote Git repository, focusing on essential version control commands, user configuration, remote connectivity, and collaborative branch management, including creating, merging, and cleaning up feature branches.


# 🛒 Laravel Sales Inventory Management System

---

## Project Title

**Laravel Sales Inventory Management System (Midterm Project)**

---

## Description / Overview

This project is a **web-based Sales Inventory Management System** built using the **Laravel Framework**. It provides a robust solution for businesses to efficiently track sales, manage product inventory levels, and organize items into logical categories. The system features a dynamic dashboard for **real-time sales reporting** and dedicated interfaces for managing products and categories, ensuring effective stock control and streamlined data organization.

---

## Objectives

The main goals and learning outcomes achieved through this midterm project were to:

1.  **Develop a full-stack CRUD application** using the **Laravel MVC architecture** to manage core business entities (Products, Categories, Sales).
2.  **Implement effective database modeling** and migrations for inventory and transaction data.
3.  **Create a data-driven dashboard** to visually present key sales metrics and inventory alerts over flexible time ranges.
4.  **Demonstrate proficiency** in web development skills, including routing, controllers, views, and database interaction within a professional framework.
5.  **Utilize Git and GitHub** for version control and project management.

---

## Features / Functionality

The Sales Inventory Management System offers the following core functionalities:

### **Sales Dashboard**
* **Sales Filtering:** Users can filter sales data based on a **Start Date** and **End Date**.
* **Key Metrics:** Displays crucial financial data: **Total Cash Income (All Time)**, **Sales (for the selected period)**, and the total **Transactions (for the selected period)**.
* **Inventory Insights:** Includes dedicated sections for **Top 5 Selling Products (by quantity)** and **Low Stock Alerts**.
* **Transaction Entry:** A button to **Record New Sale**.

### **Product Management**
* **Product Listing:** A comprehensive table view showing **ID**, **Name**, **Category**, **Price**, and **Stock** level.
* **Stock Monitoring:** Products with low stock (e.g., Tomatoes) are visually flagged with a **Low Stock (1)** warning.
* **CRUD Operations:** Functionality to **Add New Product**, and perform **View**, **Edit**, and **Delete** actions.
* **Search & Filter:** Advanced filtering options by **Category** and a search bar for **Name/Description**.

### **Category Management**
* **Category Listing:** Displays all product categories with their **ID**, **Name**, and **Description**.
* **Management:** Ability to **Add New Category**, along with individual **View**, **Edit**, and **Delete** actions.

---

## Installation Instructions 🛠️

This project requires **PHP**, **Composer**, and **Node.js/npm** to run locally.

1.  **Clone the Repository:**
    ```bash
    git clone [https://github.com/MeshyRhime/mid-exam.git](https://github.com/MeshyRhime/mid-exam.git)
    cd mid-exam
    ```
    !(dashboard.png)

2.  **Install PHP Dependencies (via Composer):**
    This installs the Laravel framework and all necessary backend libraries.
    ```bash
    composer install
    ```

3.  **Install JavaScript Dependencies (via npm):**
    This installs front-end dependencies required for asset compilation (CSS/JS).
    ```bash
    npm install
    ```

4.  **Setup Environment and Key Generation:**
    * Create the environment configuration file by copying the example:
        ```bash
        cp .env.example .env
        ```
    * Generate the unique application encryption key:
        ```bash
        php artisan key:generate
        ```
    * **Edit the newly created `.env` file** to configure your database connection (e.g., `DB_DATABASE`, `DB_USERNAME`, etc.).

5.  **Database Migration and Seeding (Laravel Commands):**
    Run the migrations to create all database tables and seed initial data (if applicable):
    ```bash
    php artisan migrate --seed
    ```

6.  **Compile Assets (Node Command):**
    Compile and bundle the CSS and JavaScript assets for use in the browser:
    ```bash
    npm run build
    ```
    *(Use `npm run dev` for live recompilation during development.)*

7.  **Run the Server (Laravel Command):**
    Start the local development server:
    ```bash
    php artisan serve
    ```
    The application will be accessible at `http://127.0.0.1:8000/dashboard`.

---

## Usage

Here are simple steps on how to interact with the Sales Inventory System:

1.  **Dashboard Review:** Access the Dashboard. Use the date filters and click **Update Data** to analyze sales trends.
2.  **Category Setup:** Navigate to the **Categories** link and use **+ Add New Category** to define product groups.
3.  **Product Entry:** Go to the **Products** link. Click **+ Add New Product** and enter details. Monitor the **Stock** column for low stock warnings.

---

## Screenshots or Code Snippets

### Sales Dashboard Overview
The main screen summarizing financial metrics, filtered sales data, and high-level transaction volume.

!(dashboard.png)

### Products List View
The interface for viewing and managing product inventory, highlighting stock levels and available actions.

!(products.png)

### Categories Management
The dedicated page for listing, describing, and administering all product categories.

!(category.png)

---

## Author

* **Mezrhime Kyle B. Tangalin**

---

## License

This project is open-sourced under the **MIT License**.

The full license text can be found in the `LICENSE.txt` file in the root of the repository.

**Copyright (c) 2025 Mezrhime Kyle B. Tangalin**