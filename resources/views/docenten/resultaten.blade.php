<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<x-app-layout>
    <div class="flex flex-row">
        <h1 class="text-2xl font-extrabold p-5">Woordenlijsten</h1>
        <a href="{{ route('woordenlijsten.create') }}" class="p-5 px-0 -ml-2"><svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="grid grid-cols-6 gap-x-44">
            <div class="">Toets</div>
            <div class="ml-auto">Periode</div>
            <div class="ml-auto">Woordenlijst</div>
            <div class="ml-auto">Resultaat</div>
            <div class="ml-auto">Fouten</div>
            <div class="ml-auto">Student</div>

            @foreach ($results as $result)
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $result['title'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">{{ $result['period_id'] }}
                </div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $result['wordlist_id'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $result['result'] }}</div>

                <a href="{{ route('resultaten.mistakes', $result->id) }}"class=" ml-auto">
                    @csrf
                    <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Fouten</button>
                </a>

                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $result['student_id'] }}</div>
            @endforeach
        </div>
    </div>
</x-app-layout>
