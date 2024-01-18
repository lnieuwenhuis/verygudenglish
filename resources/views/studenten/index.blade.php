<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/x-icon" href="https://imgur.com/dUJsQ8V.png">
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<x-guest-layout>

    <div>
        <div class="bg-gray-500 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
            <div class="ml-auto mr-auto p-3 text-2xl">
                Welkom [student naam]
            </div>

        </div>

        <div class="bg-gray-500 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
            <div class="p-3 text-lg">
                <a href="{{ route('studenten.toetsen') }}">Toetsen</a>
            </div>
            <div class="ml-auto mr-auto p-3 text-lg">
                <a href="{{ route('studenten.resultaten') }}">Resultaten</a>
            </div>
            <div class="p-3 text-lg">
                <a href="{{ route('studenten.periodes') }}">Periodes</a>
            </div>
        </div>

    </div>
</x-guest-layout>
