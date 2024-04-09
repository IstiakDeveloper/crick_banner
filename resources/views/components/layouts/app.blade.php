<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Layout</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Header Section -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto py-4 px-6 flex justify-center items-center">
            <!-- Logo -->
            <div class="text-lg font-semibold text-gray-800">Company Name</div>

        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container mx-auto py-8 px-6 min-h-screen">
        <!-- Slot for Main Content -->
        {{ $slot }}
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto text-center">
            <!-- Copyright Information -->
            <p>&copy; 2024 Company Name. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
