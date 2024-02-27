<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woordenlijsten - VeryGood</title>

    <script></script>
</head>

<x-app-layout class="w-screen">
    <div class="flex flex-row bg-indigo-500">
        <a href="{{ route('woordenlijsten.index') }}" class="w-fit h-fit">
            <button class="p-3 bg-white rounded-full m-4 border flex flex-row"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <h1 class="text-lg">
                    Terug
                </h1>
            </button></a>

        <h1 class="text-2xl font-extrabold m-7 ml-0 text-white">Woordenlijst '{{ $wordlist->title }}' Bewerken</h1>
    </div>
    <div class="flex flex-col m-5">
        <div class="flex flex-row">
            <form action="{{ route('woorden.store') }}" method="POST">
                @csrf
                <div class="flex flex-row">
                    <input type="text" name="words" id="word" placeholder="Nederlands"
                        class="rounded-lg mr-1">
                    <input type="text" name="answers" id="answer" placeholder="Engels" class="rounded-lg mr-1">
                    <input type="hidden" name="list_id" placeholder="{{ $wordlist['id'] }}"
                        value="{{ $wordlist['id'] }}" class="hidden">
                    <button class="pt-2 pb-2 pr-4 pl-4 bg-blue-600 text-xl text-sky-50 rounded-lg"
                        type="submit">+</button>
                </div>
            </form>
            <form action="{{ route('woordenlijsten.update', $wordlist->id) }}" method="POST" class="ml-auto">
                @csrf
                @method('patch')
                <div class="px-5 flex flex-row">
                    <input type="hidden" name="title" id="title" value="{{ $wordlist->title }}">
                    <select name="period_id" id="period_id" class="rounded-lg">
                        @foreach ($periodes as $period)
                            <option value="{{ $period->id }}" @if ($wordlist->period_id == $period->id) selected @endif>
                                {{ $period->title }}</option>
                        @endforeach
                    </select>
                    <button class="pt-2 pb-2 pr-4 pl-4 bg-blue-600 text-xl text-sky-50 rounded-lg ml-2"
                        type="submit">Save</button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <div class=" grid grid-cols-3 gap-x-10 border-b-gray-400 border-b-2">
            <div>
                Nederlands
            </div>
            <div class="ml-auto mr-auto">
                Engels
            </div>
            <div class="ml-auto">Acties</div>
        </div>
        <div class="grid grid-cols-3 gap-x-10">
            @foreach ($words as $word)
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $word['words'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">{{ $word['answers'] }}
                </div>
                <form action="{{ route('woorden.destroy', $word->id) }}" method="POST" class="ml-auto">
                    @csrf
                    @method('delete')
                    <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                </form>
            @endforeach
        </div>
    </div>
    </div>


</x-app-layout>
