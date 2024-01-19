<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<x-guest-layout>

    <div>

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
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

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded">
            <div class="flex flex-col">
                {{-- Later Foreach periode toevoegen --}}
                <div class="flex flex-row m-3">
                    <div class="mr-3">
                        {{-- percentage --}} 83%
                    </div>
                    Periode 1
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 12%
                    </div>
                    Periode 2
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 64%
                    </div>
                    Periode 3
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 74%
                    </div>
                    Periode 4
                </div>

            </div>
        </div>

    </div>
</x-guest-layout>
