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
    @foreach ($studenten as $student)
        <div class="flex flex-row">
            <div class="text-white m-2 p-1 bg-gray-700 rounded-lg">{{ $student['name'] }}</div>
            <div class="text-white m-2 p-1 bg-gray-700 rounded-lg">{{ $student['type'] }}</div>
        </div>
    @endforeach
</x-app-layout>
