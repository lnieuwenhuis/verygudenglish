<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woordenlijsten - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Woordenlijst Aanmaken</h1>
    <form action="{{ route('woordenlijsten.store') }}" method="POST">
        @csrf
        <div class="px-5 flex flex-col">

            <input type="text" name="title" id="title" placeholder="Titel">

            <button type="submit">Submit</button>
        </div>

    </form>

</x-app-layout>
