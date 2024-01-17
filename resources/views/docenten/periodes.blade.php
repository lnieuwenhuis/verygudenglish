<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten</title>

    <script>
        // TODO: Functies voor de knoppen maken en functie voor de gebruiker maken
    </script>
</head>

<x-app-layout>
    <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row justify-evenly">
        @foreach ($periods as $period)
            <div class="p-3 text-lg">{{ $period['title'] }}</div>
        @endforeach
    </div>
</x-app-layout>
