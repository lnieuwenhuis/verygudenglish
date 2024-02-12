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
    <div class="flex flex-row bg-indigo-500">
        <a href="{{ route('docenten') }}" class="w-fit h-fit">
            <button class="p-3 bg-white rounded-full m-4 border flex flex-row"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <h1 class="text-lg">
                    Terug
                </h1>
            </button></a>
        <h1 class="text-2xl font-extrabold m-7 ml-0 text-white">Studenten</h1>
    </div>

    <div class="flex flex-col ml-auto mr-auto min-w-60 mt-5" style="width: 80vw">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <button class="text-white m-1 mr-1 mb-2 p-1.5 bg-indigo-500 rounded-lg w-fit">Student</button>
            <button class="text-white m-1 mr-1 mb-2 ml-auto p-1.5 bg-indigo-500 rounded-lg w-fit">Resultaten en
                Acties</button>
        </div>
        <div class="flex flex-col gap-x-44 bg-indigo-200 rounded-lg mt-2">
            @foreach ($studenten as $student)
                <div class="border-b-indigo-300 flex flex-row">
                    <div class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit z-50">
                        {{ $student['name'] }}</div>
                    <div class=" border-b-2 border-b-indigo-300 mb-1 -ml-3 -mr-3 w-full"></div>
                    <div class="flex flex-row ml-auto">
                        <form action="{{ route('resultaten.index', $student->id) }}" method="GET" class="ml-auto">
                            @csrf
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <button class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit">Resultaten</button>
                        </form>
                        <form action="{{ route('studenten.destroy', $student->id) }}" method="POST" class="">
                            @csrf
                            @method('delete')
                            <button class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
