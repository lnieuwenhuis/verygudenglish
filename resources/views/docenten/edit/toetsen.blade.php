<?php

?>

<head>
    @vite('resources/css/app.css')

    <title>Toetsen - VeryGood</title>

    <script></script>
</head>

<x-app-layout>

    <h1 class="text-2xl font-extrabold p-5">Toets Bewerken</h1>
    <form action="{{ route('toetsen.update', $toets->id) }}" method="POST">
        @csrf
        <div class="px-5 flex flex-col">

            <input type="text" name="title" id="title" placeholder="{{ $toets->title }}">
            <select name="period_id" id="period_id">
                @foreach ($periodes as $period)
                    <option value="{{ $period->id }}" @if ($toets->period_id == $period->id) selected @endif>
                        {{ $period->title }}</option>
                @endforeach
            </select>
            <select name="wordlist_id" id="wordlist_id">
                @foreach ($wordlists as $wordlist)
                    <option value="{{ $wordlist->id }}" @if ($toets->wordlist_id == $wordlist->id) selected @endif>
                        {{ $wordlist->title }}</option>
                @endforeach
            </select>


            <button type="submit">Submit</button>
        </div>

    </form>
</x-app-layout>
