<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lucky History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-center">History for {{ $user->user_name }}</h1>
        @if(count($history) > 0)
            <ul class="mb-4">
                @foreach($history as $item)
                    <li class="mb-2 border-b pb-2">
                        <div><span class="font-semibold">Time:</span> {{ $item->created_at->format('d.m.Y H:i:s') }}</div>
                        <div><span class="font-semibold">Number:</span> {{ $item->number }}</div>
                        <div><span class="font-semibold">Result:</span> {{ $item->result }}</div>
                        <div><span class="font-semibold">Prize:</span> {{ $item->prize }}</div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center text-gray-600 mb-4">No history yet.</p>
        @endif
        <a href="{{ route('user.show', $user->token) }}" class="block w-full bg-gray-500 text-white py-2 rounded text-center hover:bg-gray-600 transition">Back</a>
    </div>
</body>
</html> 