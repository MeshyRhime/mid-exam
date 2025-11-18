## **Project Title**

**Laravel Sales Inventory Management System (Midterm Project)**

---

## **Description / Overview**

This project is a **web-based Sales Inventory Management System** built using the **Laravel Framework**.
It helps businesses efficiently manage product inventories, track sales, and organize products into categories.
The system also includes a dashboard that provides real-time sales data and inventory insights.

---

## **Objectives**

1. Develop a full-stack CRUD application using **Laravel MVC architecture**.
2. Implement database modeling and migrations for inventory and transactions.
3. Build a **data-driven dashboard** to display sales metrics and low-stock alerts.
4. Demonstrate proficiency in Laravel’s **controllers, routes, and Blade views**.
5. Apply **Git and GitHub** for project version control and collaboration.

---

## **Features / Functionality**

### **Sales Dashboard**

* Filter sales data by **start** and **end** dates.
* Display key metrics such as **total income**, **sales**, and **transactions**.
* Show **top 5 selling products** and **low stock alerts**.
* Record new sales transactions.

### **Product Management**

* View, add, edit, and delete products.
* Filter products by category and search by name.
* View stock levels and get low-stock warnings.

### **Category Management**

* Add, view, edit, and delete product categories.
* Display category details such as ID, name, and description.

---

## **Installation Instructions**

1. **Clone the Repository**

   ```bash
   git clone https://github.com/MeshyRhime/mid-exam.git
   cd mid-exam
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**

   ```bash
   npm install
   ```

4. **Setup Environment**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   Edit the `.env` file to configure your database connection.

5. **Run Migrations**

   ```bash
   php artisan migrate --seed
   ```

6. **Compile Assets**

   ```bash
   npm run build
   ```

7. **Run the Server**

   ```bash
   php artisan serve
   ```

   The application will be accessible at [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard).

---

## **Usage**

1. Access the **Dashboard** to view sales and inventory metrics.
2. Use the **Categories** section to organize products.
3. Manage **Products** by adding, editing, or deleting entries.
4. Monitor stock levels and check for low inventory warnings.

---


## **Code Snippets**

**Description:**
Dashboard Index File

```bash
@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-chart-line mr-3 text-darker-blue bounce-icon"></i> Sales Dashboard
    </h1>
    <a href="{{ route('sales.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-cash-register mr-2"></i> Record New Sale
    </a>
</div>

{{-- Date Filters for Analytics --}}
<div class="card p-6 mb-6 animate-fade-in">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-calendar-alt mr-2 text-darker-blue"></i> Filter Sales Data
    </h2>
    <form action="{{ route('dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Start Date:</label>
            {{-- Use toDateString() for the input value --}}
            <input type="date" name="start_date" id="start_date" class="form-input" value="{{ $startDate->toDateString() }}">
        </div>
        <div>
            <label for="end_date" class="block text-gray-700 text-sm font-bold mb-2">End Date:</label>
            {{-- Use toDateString() for the input value --}}
            <input type="date" name="end_date" id="end_date" class="form-input" value="{{ $endDate->toDateString() }}">
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary flex items-center mr-2">
                <i class="fas fa-sync-alt mr-2"></i> Update Data
            </button>
        </div>
    </form>
</div>

{{-- Main Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    {{-- Total Cash Income Card (Overall) --}}
    <div class="card p-6 flex items-center justify-between animate-fade-in" style="background-color: var(--light-pink); color: white;">
        <div>
            <h3 class="text-lg font-semibold">Total Cash Income (All Time)</h3>
            <p class="text-4xl font-bold mt-2">${{ number_format($totalCashIncome, 2) }}</p>
        </div>
        <i class="fas fa-dollar-sign fa-3x text-white opacity-70"></i>
    </div>

    {{-- Period Sales Card --}}
    <div class="card p-6 flex items-center justify-between animate-slide-in-right" style="background-color: var(--darker-blue); color: white;">
        <div>
            <h3 class="text-lg font-semibold">Sales ({{ $startDate->format('M d') }} - {{ $endDate->format('M d') }})</h3>
            <p class="text-4xl font-bold mt-2">${{ number_format($totalSalesPeriod, 2) }}</p>
        </div>
        <i class="fas fa-money-bill-wave fa-3x text-white opacity-70"></i>
    </div>

    {{-- Transactions Card --}}
    <div class="card p-6 flex items-center justify-between animate-slide-in-right" style="background-color: var(--baby-blue); color: white;">
        <div>
            <h3 class="text-lg font-semibold">Transactions ({{ $startDate->format('M d') }} - {{ $endDate->format('M d') }})</h3>
            <p class="text-4xl font-bold mt-2">{{ $numberOfTransactionsPeriod }}</p>
        </div>
        <i class="fas fa-handshake fa-3x text-white opacity-70"></i>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    {{-- Top Selling Products --}}
    <div class="card p-6 animate-fade-in">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
            <i class="fas fa-trophy mr-2 text-light-pink"></i> Top 5 Selling Products (by quantity)
        </h2>
        @if($topSellingProducts->isEmpty())
            <p class="text-gray-600">No sales recorded in this period.</p>
        @else
            <ul class="list-disc list-inside space-y-2">
                @foreach($topSellingProducts as $sale)
                    <li class="flex items-center justify-between py-1 border-b border-gray-100 last:border-b-0">
                        <span>
                            <i class="fas fa-box mr-2 text-baby-blue"></i>
                            <a href="{{ route('products.show', $sale->product->id) }}" class="text-gray-800 hover:text-darker-blue hover:underline">
                                {{ $sale->product->name }}
                            </a>
                        </span>
                        <span class="font-semibold text-gray-700">{{ $sale->total_quantity_sold }} items sold</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    {{-- Low Stock Products --}}
    <div class="card p-6 animate-slide-in-right">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
            <i class="fas fa-warehouse mr-2 text-darker-blue"></i> Low Stock Alerts
        </h2>
        @if($lowStockProducts->isEmpty())
            <p class="text-green-600 font-semibold">All products are well-stocked!</p>
        @else
            <ul class="list-disc list-inside space-y-2">
                @foreach($lowStockProducts as $product)
                    <li class="flex items-center justify-between py-1 border-b border-gray-100 last:border-b-0 text-red-600">
                        <span>
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <a href="{{ route('products.show', $product->id) }}" class="text-red-600 hover:underline">
                                {{ $product->name }}
                            </a>
                        </span>
                        <span class="font-semibold">{{ $product->stock }} in stock</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
```

**Description:**
Products Index File

```bash
@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-boxes mr-3 text-darker-blue bounce-icon"></i> Products List
    </h1>
    <a href="{{ route('products.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-plus-circle mr-2"></i> Add New Product
    </a>
</div>

{{-- Filters Section --}}
<div class="card p-6 mb-6 animate-fade-in">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-filter mr-2 text-darker-blue"></i> Filters
    </h2>
    <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Filter by Category:</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="search" class="block text-gray-700 text-sm font-bold mb-2">Search by Name/Description:</label>
            <input type="text" name="search" id="search" class="form-input" value="{{ request('search') }}" placeholder="Search products...">
        </div>
        <div class="flex items-end">
            <button type="submit" class="btn-primary flex items-center mr-2">
                <i class="fas fa-search mr-2"></i> Apply Filters
            </button>
            <a href="{{ route('products.index') }}" class="btn-secondary flex items-center">
                <i class="fas fa-undo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>


<div class="card p-6 animate-slide-in-right">
    @if($products->isEmpty())
        <p class="text-center text-gray-600">No products found matching your criteria.</p>
    @else
        <table class="table-auto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->stock <= 5)
                                <span class="text-red-600 font-semibold flex items-center">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock ({{ $product->stock }})
                                </span>
                            @else
                                {{ $product->stock }}
                            @endif
                        </td>
                        <td class="flex justify-center space-x-2">
                            <a href="{{ route('products.show', $product->id) }}" class="text-darker-blue hover:text-baby-blue transition-colors duration-200">
                                <i class="fas fa-eye bounce-icon"></i>
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-green-500 hover:text-green-700 transition-colors duration-200">
                                <i class="fas fa-edit bounce-icon"></i>
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                    <i class="fas fa-trash-alt bounce-icon"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
```

**Description:**
Categories Index File

```bash
@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 animate-fade-in">
    <h1 class="text-3xl font-bold text-gray-800 flex items-center">
        <i class="fas fa-tags mr-3 text-darker-blue bounce-icon"></i> Categories List
    </h1>
    <a href="{{ route('categories.create') }}" class="btn-primary flex items-center">
        <i class="fas fa-plus-circle mr-2"></i> Add New Category
    </a>
</div>

<div class="card p-6 animate-slide-in-right">
    @if($categories->isEmpty())
        <p class="text-center text-gray-600">No categories found. Start by adding one!</p>
    @else
        <table class="table-auto">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?? 'N/A' }}</td>
                        <td class="flex justify-center space-x-2">
                            <a href="{{ route('categories.show', $category->id) }}" class="text-darker-blue hover:text-baby-blue transition-colors duration-200">
                                <i class="fas fa-eye bounce-icon"></i>
                            </a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500 hover:text-green-700 transition-colors duration-200">
                                <i class="fas fa-edit bounce-icon"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category and all its products?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                    <i class="fas fa-trash-alt bounce-icon"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
```

---

## **Author**

**Mezrhime Kyle B. Tangalin**

---

## **License**

This project is licensed under the **MIT License**.
© 2025 Mezrhime Kyle B. Tangalin

# Dashboard Overview
![Sales Dashboard](dashboard.png)

# Products Tab Overview
![Products Dashboard](products.png)

# Categories Tab Overview
![Categories Dashboard](category.png)



## 1. Create Local Repository

**Command:**

```bash
git init
```

**Description:**
Initializes a new Git repository in your current project folder. This creates a hidden `.git` directory that tracks all changes.

---

## 2. Add Files to Staging Area

**Command:**

```bash
git add .
```

**Description:**
Adds all files in your project to the staging area, preparing them for commit.

---

## 3. Commit Changes

**Command:**

```bash
git commit -m "Initial commit"
```

**Description:**
Records the staged changes in your local repository with a descriptive message.

---

## 4. Configure User Identity

**Commands:**

```bash
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
```

**Description:**
Sets your username and email so Git can record who made each commit.

---

## 5. Connect to Remote Repository

**Command:**

```bash
git remote add origin https://github.com/yourusername/midterm-collab.git
```

**Description:**
Connects your local repository to a remote GitHub repository named `midterm-collab`.

---

## 6. Rename and Push Main Branch

**Commands:**

```bash
git branch -M main
git push -u origin main
```

**Description:**
Renames your branch to `main` and pushes your commits to GitHub, linking your local branch to the remote one.

---

## 7. Clone Repository (Partner’s Repo)

**Command:**

```bash
git clone https://github.com/partnerusername/partner-repo.git
```

**Description:**
Creates a copy of your partner’s repository on your local computer, including all files and version history.

---

## 8. Create and Switch Branch

**Command:**

```bash
git checkout -b feature-update
```

**Description:**
Creates a new branch named `feature-update` and switches to it immediately.

---

## 9. Make and Commit Changes in Branch

**Commands:**

```bash
# Edit your files as needed
git add .
git commit -m "Added new feature or updated content"
```

**Description:**
Stages your modified files and saves them with a commit message that describes the changes.

---

## 10. View and Compare Branches

**Commands:**

```bash
git branch
git diff main feature-update
```

**Description:**
Displays all branches in your repository and shows the differences between `main` and `feature-update`.

---

## 11. Merge Branch with Main

**Commands:**

```bash
git checkout main
git merge feature-update
```

**Description:**
Merges the `feature-update` branch into the `main` branch, combining both sets of work.

---

## 12. Delete a Branch After Merge

**Command:**

```bash
git branch -d feature-update
```

**Description:**
Deletes the merged branch from your local repository to keep it clean.

---

## 13. Fetch and Pull Updates from GitHub

**Commands:**

```bash
git fetch
git pull
```

**Description:**
`fetch` checks for changes from the remote repository, while `pull` downloads and applies them to your local branch.

---

## 14. View Remote Repository Information

**Command:**

```bash
git remote show origin
```

**Description:**
Displays details about your connected remote repository, such as fetch and push URLs.

---

## 15. Undo or Restore Changes

**Commands:**

```bash
git restore filename.txt
git reset --soft HEAD~1
git reset --hard HEAD~1
```

**Description:**
Restores files to their last saved state or undoes recent commits, depending on which command is used.

---
