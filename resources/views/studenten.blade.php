<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

</head>

<body>

    <div>
        <nav class="bg-blue-700 h-fit flex flex-row gap-8 pb-1">
            <div class="h-full p-3">Logo</div>
            <div class="h-full p-3">Woordenschat-Game</div>
            <div class="ml-auto p-3">[student naam]</div>
            <button class="flex justify-end p-3">Login</button>
            <button class="flex justify-end p-3">Logout</button>
        </nav>

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
            <div class="p-3">
                <button href="#" class="pl-0">Toetsen
                </button>
            </div>
            <div class="ml-auto mr-auto p-3">
                <button href="#">Oefeningen</button>
            </div>
            <div class="p-3">
                <button href="#">Woorden</button>
            </div>
        </div>

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded">
            <div class="flex flex-col">
                {{-- Later Foreach periode toevoegen --}}
                <div class="flex flex-row m-3">
                    <div class="mr-3">
                        {{-- percentage --}} 83%
                    </div>
                    Periode 1
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 12%
                    </div>
                    Periode 2
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 64%
                    </div>
                    Periode 3
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 74%
                    </div>
                    Periode 4
                </div>

            </div>
        </div>

    </div>
</body>
