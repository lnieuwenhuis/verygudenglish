<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="text-green-500">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Woordenschat Game</title>

</head>

<x-app-layout>
    <div class="bg-gray-800 h-screen">
        <div class="w-3/4 ml-auto mr-auto bg-gray-500 h-full">
            <div class="text-center text-2xl font-semibold pt-5 dark:text-gray-800">Leer hier eenvoudig jouw Engelse
                Woordenschat!
            </div>
        </div>
    </div>

</x-app-layout>

</html>
