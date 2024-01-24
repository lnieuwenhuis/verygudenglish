<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woorden - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Woord Bewerken</h1>
    <form action="{{ route('woorden.update') }}" method="POST">
        @csrf
        <div class="px-5 flex flex-col">

            <input type="text" name="word" id="word" placeholder="Placeholder">

            <button type="submit">Submit</button>
        </div>

    </form>

</x-app-layout>
