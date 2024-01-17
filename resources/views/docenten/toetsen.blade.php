<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woordenlijsten</title>

    <script></script>
</head>

<x-app-layout>

    <!-- TODO: Woordenlijsten importeren uit database en neerzetten in een lijst -->

    {{-- @foreach ($wordlists as $wordlist)
        <div class="text-white">{{ $wordlist['title'] }}</div>
    @endforeach --}}
</x-app-layout>
