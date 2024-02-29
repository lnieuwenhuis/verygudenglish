<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Geen Woordenlijst</title>

    <script></script>
</head>

<div>
    <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
        <div class="flex flex-col">
            <div class="flex flex-row">
                <div class="p-2">Geen Woordenlijst Gevonden voor de Periode.</div>
                <div class="p-2">Vraag je docent of ze er een hebben gemaakt</div>
            </div>
            <div class="flex flex-col">
            </div>
        </div>
    </div>
</div>
