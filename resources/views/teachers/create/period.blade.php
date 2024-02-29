<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Periodes - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Periode Aanmaken</h1>
    <form action="{{ route('periodes.store') }}" method="POST">
        @csrf
        <div class="px-5 flex flex-col">

            <input type="text" name="periode" id="periode">
            <select name="is_locked" id="is_locked">
                <option value="1">Open</option>
                <option value="0">Gesloten</option>
            </select>

            <button type="submit">Submit</button>
        </div>

    </form>

</x-app-layout>
