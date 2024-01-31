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
                <a href="{{ route('studenten.periode1') }}">Periode 1</a>
            </div>
            <div class="ml-auto mr-auto p-3 text-lg">
                <a href="{{ route('studenten.periode2') }}">Periode 2</a>
            </div>
            <div class="p-3 text-lg">
                <a href="{{ route('studenten.periode3') }}">Periode 3</a>
            </div>
            <div class="p-3 text-lg">
                <a href="{{ route('studenten.periode4') }}">Periode 4</a>
            </div>
        </div>

        <div class="bg-gray-400 h-2/3 w-3/4 m-auto mt-5 mb-5 rounded">
            <div class="flex flex-col">
                {{-- Later Foreach periode toevoegen --}}
                <div class="flex flex-row m-3">
                    <div class="mr-3">
                        {{-- percentage --}}70%
                    </div>
                    Meteor Slash
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 50%
                    </div>
                    Age of Words
                </div>
                <div class="flex flex-row m-4">
                    <div class="mr-3">
                        {{-- percentage --}} 80%
                    </div>
                    Periode Toets
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
