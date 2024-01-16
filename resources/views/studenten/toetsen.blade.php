<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<body>

    <div>
        <nav class="bg-blue-700 h-fit flex flex-row pb-1">
            <div class="h-full p-3">Logo</div>
            <div class="h-full p-3">Woordenschat-Game</div>
            <div class="ml-auto p-3">[student naam]</div>
            <div class="p-3">Logout</div>
        </nav>

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

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded">
            <div class="flex flex-col">
                {{-- Later Foreach toets toevoegen --}}
                <div class="flex flex-row m-3">
                    <div class="mr-3">
                        {{-- percentage --}} 83%
                    </div>
                    Toets 1
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 12%
                    </div>
                    Toets 2
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 64%
                    </div>
                    Toets 3
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 74%
                    </div>
                    Toets 4
                </div>

            </div>
        </div>

    </div>
</body>
