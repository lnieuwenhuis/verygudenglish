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

<x-app-layout>
    <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row justify-evenly">
    </div>

    <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row justify-evenly">
        <div class="p-3 text-xl">
            <a href="{{ route('toetsen.index') }}">Toetsen</a>
        </div>
        <div class="p-3 text-xl">
            <a href="{{ route('periodes.index') }}">Periodes</a>
        </div>
        <div class="p-3 text-xl">
            <a href="{{ route('docenten') }}">Home</a>
        </div>
        <div class="p-3 text-xl">
            <a href="{{ route('studenten.index') }}">Studenten</a>
        </div>
        <div class="p-3 text-xl">
            <a href="{{ route('woordenlijsten.index') }}">Woordenlijsten</a>
        </div>
    </div>


</x-app-layout>
