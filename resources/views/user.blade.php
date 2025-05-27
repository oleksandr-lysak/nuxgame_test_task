<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page A</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-2 text-center">Welcome, {{ $user->user_name }}!</h1>
        <p class="mb-2 text-gray-700 text-center">Your phone number: <span class="font-semibold">{{ $user->phone_number }}</span></p>
        <p class="mb-4 text-gray-700 text-center">Link valid until: <span class="font-semibold">{{ $user->expires_at->format('d.m.Y H:i') }}</span></p>
        <div class="flex flex-col gap-3 mb-4">
            <form method="POST" action="{{ route('user.regenerate', $user->token) }}">
                @csrf
                <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded hover:bg-yellow-600 transition">Generate new link</button>
            </form>
            <form method="POST" action="{{ route('user.deactivate', $user->token) }}">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">Deactivate link</button>
            </form>
            <form method="POST" action="{{ route('user.lucky', $user->token) }}">
                @csrf
                <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">I'm feeling lucky</button>
            </form>
            <form method="GET" action="{{ route('user.history', $user->token) }}">
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">History</button>
            </form>
        </div>
        @isset($message)
            <p class="text-green-700 text-center font-semibold">{{ $message }}</p>
        @endisset
        @isset($luckyResult)
            <div class="text-center mt-4">
                <p class="text-lg font-semibold">Number: {{ $luckyResult['number'] }}</p>
                <p class="text-lg font-semibold">Result: {{ $luckyResult['result'] }}</p>
                <p class="text-lg font-semibold">Prize: {{ $luckyResult['prize'] }}</p>
            </div>
        @endisset
    </div>
</body>
</html> 