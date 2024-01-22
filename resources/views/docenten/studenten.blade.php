<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten - VeryGood</title>

    <script>
        // TODO: Functies voor de knoppen maken en functie voor de gebruiker maken
    </script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Studenten</h1>
    <div class="flex flex-col pl-5">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="">Naam</div>
            <div class="ml-auto">Type</div>
        </div>

        @foreach ($studenten as $student)
            <div class="flex flex-row">
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg">{{ $student['name'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg ml-auto">{{ $student['type'] }}</div>
            </div>
        @endforeach
    </div>
</x-app-layout>
