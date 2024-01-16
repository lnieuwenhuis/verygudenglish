<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/x-icon" href="https://imgur.com/dUJsQ8V.png">
    @vite('resources/css/app.css')

    <title>Docenten Panel</title>

    <script>
        // TODO: Functies voor de knoppen maken en functie voor de gebruiker maken
    </script>
</head>

<x-app-layout>

    <div class="p-4 sm:ml-64">
        <div id="studenten" class="text-black">
            Studenten
        </div>
        <div id="woordenlijsten" class=" hidden text-black">
            woordenlijsten
        </div>
    </div>

</x-app-layout>
