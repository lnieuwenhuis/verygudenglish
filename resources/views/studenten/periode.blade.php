<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<x-guest-layout>
    @if ($wordlist == null)
        @include('studenten.geenlijst')
    @else
        <div>
            <div class="text-white h-2/3 w-3/4 m-auto mt-5 mb-5 rounded flex flex-row">
                <div class="ml-auto mr-auto p-3 text-2xl">
                    {{$period->title}}
                </div>
            </div>

            <div class="h-2/3 w-2/4 m-auto mt-5 mb-5 rounded flex flex-row">

                @foreach ($periodes as $periode)
                    <div class="flex items-center justify-center ml-auto mr-auto px-3 text-lg mb-3 mt-3">
                        <a class="gap-2 flex items-center justify-center hover:bg-gray-200 border-2 border-gray-200 bg-gray-200 py-2 px-8 rounded-2xl"
                            @if ($periode->is_locked == 0) href="{{ route('studenten.period', $periode->id) }}">{{ $periode->title }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        @else
                            }}">{{ $periode->title, $periode->id }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg> @endif
                            </a>
                    </div>
                @endforeach
            </div>


            <div class="h-2/3 w-80 m-auto mt-5 mb-5 rounded">
                <div class="flex justify-center">
                        <form action="{{ route('ageofwords', $wordlist->id) }}" method="GET" class="">
                            @csrf
                            <button class="text-white w-32 h-16 m-1 p-1 bg-gray-600 rounded-lg">Age of Words</button>
                        </form>

                    <form action="{{ route('meteoriet',  $wordlist->id) }}" method="GET" class="">
                        @csrf
                        <button class="text-white w-32 h-16 m-1 p-1 bg-gray-600 rounded-lg">Meteor Slash</button>
                    </form>
                </div>
                <div class="flex justify-center">
                    <form action="{{ route('studenten.woordenlijst', $wordlist->id) }}" method="GET" class="">
                        @csrf
                        <button class="text-white w-32 h-16 m-1 p-1 bg-gray-600 rounded-lg">Woordenlijst</button>
                    </form>
                </div>

            </div>
        </div>
    @endif

</x-guest-layout>
