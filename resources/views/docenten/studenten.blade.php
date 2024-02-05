<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten - VeryGood</title>

    <script>
        // TODO: Functies voor de knoppen maken en functie voor de gebruiker maken
    </script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Studenten</h1>
    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="">Naam</div>
            <div class="ml-auto">Resultaten</div>
            <div class="ml-auto">Actions</div>
        </div>
        <div class="grid grid-cols-3 gap-x-44">
            @foreach ($studenten as $student)
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $student['name'] }}</div>
                <form action="{{ route('resultaten.index', $student->id) }}" method="GET" class="ml-auto mr-auto">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Resultaten</button>
                </form>
                <form action="{{ route('studenten.destroy', $student->id) }}" method="POST" class="ml-auto">
                    @csrf
                    @method('delete')
                    <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                </form>
            @endforeach
        </div>
    </div>
</x-app-layout>
