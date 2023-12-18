<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

</head>

<body>
    <nav class="bg-blue-700 h-fit flex flex-row pb-1">
        <div class="h-full p-3">Logo</div>
        <div class="h-full p-3">Woordenschat-Game</div>
        <div class="ml-auto p-3">[student naam]</div>
        <div class="p-3">Logout</div>
    </nav>
</body>
