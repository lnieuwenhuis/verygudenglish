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
            <div class="grid grid-cols-4 gap-x-44 w-full">
                <div class="p-2">Titel</div>
                <div class="p-2 mx-auto">Periode</div>
                <div class="p-2 mx-auto">Woordenlijst</div>
                <div class="ml-auto p-2">Fouten</div>

                @foreach ($results as $result)
                    @if ($result->student_id == $student)
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $result['title'] }}</div>
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                            Periode {{ $result['period_id'] }}
                        </div>
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                            Woordenlijst {{ $result['wordlist_id'] }}
                        </div>
                        <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto">
                            {{ $result['result'] }} @if ($result['result'] == 1)
                                fout
                            @else
                                fouten
                            @endif
                        </div>
                    @else
                    @endif
                @endforeach
            </div>
        </div>


    </div>
</x-guest-layout>
