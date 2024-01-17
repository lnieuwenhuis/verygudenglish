<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Toetsen - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row justify-evenly">
        <div class="p-3 text-lg">
            <a href="{{ route('toetsen.index') }}">Toetsen</a>
        </div>
        <div class="p-3 text-lg">
            <a href="{{ route('periodes.index') }}">Periodes</a>
        </div>
        <div class="p-3 text-lg">
            <a href="{{ route('docenten') }}">Home</a>
        </div>
        <div class="p-3 text-lg">
            <a href="{{ route('studenten.index') }}">Studenten</a>
        </div>
        <div class="p-3 text-lg">
            <a href="{{ route('woordenlijsten.index') }}">Woordenlijsten</a>
        </div>
    </div>

    <!-- TODO: Woordenlijsten importeren uit database en neerzetten in een lijst -->

    {{-- @foreach ($tests as $test)
        <div class="text-white">{{ $test['title'] }}</div>
    @endforeach --}}
</x-app-layout>
