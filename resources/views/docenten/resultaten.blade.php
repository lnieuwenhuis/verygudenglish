<?php
$student_id = $_GET['student_id'];

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<x-app-layout>
    <div class="flex flex-row bg-indigo-500">
        <a href="{{ route('studenten.index') }}" class="w-fit h-fit">
            <button class="p-3 bg-white rounded-full m-4 border flex flex-row"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <h1 class="text-lg">
                    Terug
                </h1>
            </button></a>
        <h1 class="text-2xl font-extrabold m-7 ml-0 text-white">Resultaten
        </h1>
    </div>

    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="grid grid-cols-5 gap-x-44 border-b-gray-400 border-b-2 pt-2">
            <button class="text-white m-1 mr-1 mb-2 p-1.5 bg-indigo-500 rounded-lg w-fit">Toets</button>
            <button class="text-white m-1 mr-1 mb-2 p-1.5 bg-indigo-500 rounded-lg w-fit ml-auto">Periode</button>
            <button class="text-white m-1 mr-1 mb-2 p-1.5 bg-indigo-500 rounded-lg w-fit ml-auto">Woordenlijst</button>
            <button class="text-white m-1 mr-1 mb-2 p-1.5 bg-indigo-500 rounded-lg w-fit ml-auto">Resultaat</button>
            <button class="text-white m-1 mr-1 mb-2 p-1.5 bg-indigo-500 rounded-lg w-fit ml-auto">Student</button>
        </div>

        <div class="grid grid-cols-5 gap-x-44 bg-indigo-200 rounded-lg mt-2">

            @foreach ($results as $result)
                @if ($student_id == $result->student_id)
                    <div class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit">{{ $result['title'] }}</div>
                    @foreach ($periods as $period)
                        @if ($period->id == $result->period_id)
                            <div class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit ml-auto mr-auto">
                                {{ $period->title }}
                            </div>
                        @endif
                    @endforeach
                    @foreach ($wordlists as $wordlist)
                        @if ($wordlist->id == $result->wordlist_id)
                            <div class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit">{{ $wordlist->title }}</div>
                        @endif
                    @endforeach
                    <div class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit">{{ $result['result'] }}%</div>

                    @foreach ($students as $student)
                        @if ($student->id == $result->student_id)
                            <div class="text-white m-1 p-1 bg-indigo-500 rounded-lg w-fit">{{ $student->name }}</div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
