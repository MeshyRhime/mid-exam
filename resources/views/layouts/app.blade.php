<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Inventory</title>
    <!-- Tailwind CSS (for quick styling) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --baby-blue: #89CFF0; /* Light Sky Blue */
            --light-pink: #FFB6C1; /* Light Pink */
            --darker-blue: #5B9BD5;
            --darker-pink: #E0607E;
            --text-color: #333;
            --white-color: #ffffff;
            --shadow-light: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: var(--text-color);
        }

        .navbar {
            background-color: var(--darker-blue);
            box-shadow: var(--shadow-light);
        }
        .navbar a {
            color: var(--white-color);
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease-in-out;
        }
        .navbar a:hover {
            background-color: var(--baby-blue);
        }
        .btn-primary {
            background-color: var(--darker-blue);
            color: var(--white-color);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: var(--baby-blue);
        }
        .btn-secondary {
            background-color: var(--light-pink);
            color: var(--white-color);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-secondary:hover {
            background-color: var(--darker-pink);
        }
        .btn-danger {
            background-color: #ef4444; /* Tailwind red-500 */
            color: var(--white-color);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-danger:hover {
            background-color: #dc2626; /* Tailwind red-600 */
        }

        .card {
            background-color: var(--white-color);
            border-radius: 0.5rem;
            box-shadow: var(--shadow-light);
            padding: 1.5rem;
        }

        .table-auto {
            width: 100%;
            border-collapse: collapse;
        }
        .table-auto th, .table-auto td {
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0; /* Tailwind gray-200 */
            text-align: left;
        }
        .table-auto th {
            background-color: var(--baby-blue);
            color: var(--white-color);
            font-weight: 600;
        }
        .table-auto tbody tr:hover {
            background-color: #e0f2fe; /* Light blue on hover */
        }

        input[type="text"], input[type="number"], select, textarea {
            border: 1px solid #d1d5db; /* Tailwind gray-300 */
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--baby-blue);
            box-shadow: 0 0 0 2px rgba(137, 207, 240, 0.5); /* Baby blue shadow */
            outline: none;
        }

        .alert {
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }
        .alert-success {
            background-color: #d1fae5; /* Tailwind green-100 */
            color: #065f46; /* Tailwind green-800 */
        }
        .alert-danger {
            background-color: #fee2e2; /* Tailwind red-100 */
            color: #991b1b; /* Tailwind red-800 */
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .bounce-icon {
            transition: transform 0.2s ease-in-out;
        }
        .bounce-icon:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="navbar p-4 shadow-md flex justify-between items-center animate-fade-in">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold flex items-center hover:bg-transparent">
                <i class="fas fa-cubes mr-2 bounce-icon"></i> Sales Inventory
            </a>
            <div class="flex space-x-4">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <i class="fas fa-chart-line mr-1 bounce-icon"></i> Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center">
                    <i class="fas fa-boxes mr-1 bounce-icon"></i> Products
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center">
                    <i class="fas fa-tags mr-1 bounce-icon"></i> Categories
                </a>
                <!-- Add more navigation links here if needed -->
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-4">
        @if (session('success'))
            <div class="alert alert-success animate-fade-in">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger animate-fade-in">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script>
        // Simple animation for icons on hover
        document.querySelectorAll('.bounce-icon').forEach(icon => {
            icon.addEventListener('mouseover', () => {
                icon.classList.add('fa-bounce');
            });
            icon.addEventListener('mouseout', () => {
                icon.classList.remove('fa-bounce');
            });
        });
    </script>
</body>
</html>