<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="border-2 border-gray-800 w-[1200px] h-[630px] {{ $styling['background'] ?? 'bg-gray-900' }}">
    <div class="flex flex-col items-center justify-center h-full w-full bg-cover bg-center bg-no-repeat">
        <h1 class="font-bold text-4xl {{ $styling['text'] ?? 'text-white' }}">{{ $title }}</h1>
    </div>
</div>
</body>
</html>
