<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="icon" type="image/x-icon" href="https://imgur.com/dUJsQ8V.png">
    @vite('resources/css/app.css')

    <title>Docenten Panel - VeryGood</title>

    <script>
        // TODO: Functies voor de knoppen maken en functie voor de gebruiker maken
    </script>
</head>


<x-app-layout>
    <div class="flex flex-row bg-indigo-500">
        <h1 class=" text-4xl font-extrabold m-7 ml-auto mr-auto text-white">Welkom Bij Het Docentenpaneel</h1>
    </div>
    <div class="grid grid-cols-2 grid-rows-2 gap-3 mt-8 m-8">
        <div>
            <a href="{{ route('periodes.index') }}">
                <div class=" dark:bg-indigo-500 bg-indigo-500 overflow-hidden shadow-sm sm:rounded-lg h-36">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center mt-9 text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute opacity-10 -ml-6 -mt-12"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                        Periodes
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('studenten.index') }}">
                <div class=" dark:bg-indigo-500 bg-indigo-500 overflow-hidden shadow-sm sm:rounded-lg h-36">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center mt-9 text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute opacity-10 -ml-6 -mt-12"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                            <path fill-rule="evenodd"
                                d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Studenten
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('woordenlijsten.index') }}">
                <div class=" dark:bg-indigo-500 bg-indigo-500 overflow-hidden shadow-sm sm:rounded-lg h-36">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center mt-9 text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute opacity-10 -ml-6 -mt-12"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Woordenlijsten
                    </div>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('resultaten.index') }}">
                <div class=" dark:bg-indigo-500 bg-indigo-500 overflow-hidden shadow-sm sm:rounded-lg h-36">
                    <div class="p-6 text-gray-900 dark:text-gray-100 text-center mt-9 text-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 absolute opacity-10 -ml-6 -mt-12"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z"
                                clip-rule="evenodd" />
                        </svg>
                        Resultaten
                    </div>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
