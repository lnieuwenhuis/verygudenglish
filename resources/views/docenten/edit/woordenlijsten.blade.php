<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woordenlijsten - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <h1 class="text-2xl font-extrabold p-5">Woordenlijst{{ $wordlist->id }} Bewerken</h1>
    <form action="{{ route('woorden.store') }}" method="POST">
        @csrf
        <div class="flex">
            <div class="grid grid-cols-3">
                <input type="text" name="words" id="word" placeholder="word">
                <input type="text" name="answers" id="answer" placeholder="answer">
                <input type="hidden" name="list_id" placeholder="{{ $wordlist['id'] }}" value="{{ $wordlist['id'] }}" class="hidden">
            </div>
            <button class="pt-2 pb-2 pr-4 pl-4 bg-blue-600 text-xl text-sky-50" type="submit">+</button>
        </div>
        <div>
            <div class="grid grid-cols-2 gap-x-44">
                @foreach ($words as $word)

                    <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $word['words'] }}</div>
                    <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $word['answers'] }}</div>

                @endforeach
            </div>
        </div>






    </form>

</x-app-layout>
