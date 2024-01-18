<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Toetsen - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <div class="bg-gray-500 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row justify-evenly">
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
    <div class="grid grid-cols-4 gap-3 w-3/4 ml-auto mr-auto">
        @foreach ($tests as $test)
            <div class="flex flex-col bg-gray-600 rounded-md w-52 ml-auto mr-auto h-20">
                <div class="text-white text-center py-3">{{ $test['title'] }}
                </div>
                <div class="flex flex-row">
                    <button class="text-white text-center bg-gray-500 rounded-md w-1/2 mx-2">Edit</button>
                    <button class="text-white text-center bg-gray-500 rounded-md w-1/2 mx-2">Delete</button>
                </div>

            </div>
        @endforeach
    </div>
</x-app-layout>
