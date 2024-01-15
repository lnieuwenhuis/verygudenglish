<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

</head>

<body>

    <div>
        <nav class="bg-blue-700 h-fit flex flex-row pb-1">
            <div class="h-full p-3">Logo</div>
            <div class="h-full p-3">Landstede Engels</div>
            <div class="ml-auto p-3">[student naam]</div>
            <button class="p-3">Login</button>
            <button class="p-3">Logout</button>
        </nav>

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
            <div class="ml-auto mr-auto p-3 text-2xl">
                Welkom [student naam]
            </div>

        </div>

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
            <div class="p-3 text-lg">
                <a href="{{ route('studenten_toetsen') }}">Toetsen</a>
            </div>
            <div class="ml-auto mr-auto p-3 text-lg">
                <a href="{{ route('studenten_resultaten') }}">Resultaten</a>
            </div>
            <div class="p-3 text-lg">
                <a href="{{ route('studenten_periodes') }}">Periodes</a>
            </div>
        </div>

    </div>
</body>
