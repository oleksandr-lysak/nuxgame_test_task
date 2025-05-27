<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Link created</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md text-center">
        <h1 class="text-2xl font-bold mb-4 text-green-700">Link created!</h1>
        <p class="mb-2 text-gray-700">Your unique link (valid for 7 days):</p>
        <a href="{{ $link }}" class="break-all text-blue-600 underline hover:text-blue-800">{{ $link }}</a>
    </div>
</body>
</html> 