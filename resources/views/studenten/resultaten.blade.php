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
            <div class="grid grid-cols-5 gap-x-44">
                <div class="p-2">Toets</div>
                <div class="p-2">Periode</div>
                <div class="p-2">Woordenlijst</div>
                <div class="p-2">Resultaat</div>
                <div class="ml-auto p-2">Fouten</div>

                @foreach ($results as $result)
                    @if ($result->student_id == $student->id)
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $result['title'] }}</div>
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                            {{ $result['period_id'] }}
                        </div>
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                            {{ $result['wordlist_id'] }}
                        </div>
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                            {{ $result['result'] }}
                        </div>
                        <form action="{{ route('studenten.results.mistakes', $result->id) }}" method="POST"
                            class=" ml-auto">
                            @csrf
                            <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Fouten</button>
                        </form>
                    @else
                        <div></div>
                    @endif
                @endforeach
            </div>
        </div>


    </div>
</x-guest-layout>
