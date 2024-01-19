<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/x-icon" href="https://imgur.com/dUJsQ8V.png">
    @vite('resources/css/app.css')

    <title>Docenten Panel - VeryGood</title>

    <script>
        // TODO: Functies voor de knoppen maken en functie voor de gebruiker maken
    </script>
</head>

<div class="flex flex-row min-h-screen bg-gray-100 text-gray-800 w-full">

    <x-app-layout class="w-full">
    </x-app-layout>
    {{-- NIET IN DE X-APP-LAYOUT MAAR HIER ONDER, ANDERS BREEKT DE NAVIGATIE --}}
    <div class="text-2xl p-4">Welkom bij het docenten paneel
    </div>
</div>
