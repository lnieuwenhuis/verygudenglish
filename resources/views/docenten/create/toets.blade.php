<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Toetsen - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Toets Aanmaken</h1>
    <form action="{{ route('toetsen.store') }}" method="POST">
        @csrf
        <div class="px-5 flex flex-col">

            <input type="text" name="title" id="title">
            <select name="periode" id="periode">
                @foreach ($periodes as $periode)
                    <option value=`{{ $periode['id'] }}`>{{ $periode['title'] }}</option>
                @endforeach
            </select>
            <select name="woordenlijst" id="woordenlijst">
                @foreach ($woordenlijsten as $woordenlijst)
                    <option value=`{{ $woordenlijst['id'] }}`>{{ $woordenlijst['title'] }}</option>
                @endforeach
            </select>
            <button type="submit">Submit</button>
        </div>

    </form>

</x-app-layout>
