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
            <div class="flex flex-col">
                <div class="flex flex-row">
                    <div class="p-2">Nederlands</div>
                    <div class="p-2">Engels</div>
                </div>
                <div class="flex flex-col">
                    @foreach ($words as $word)
                        <div class="flex flex-row">
                            <div class="p-2">{{ $word->words }}</div>
                            <div class="p-2 ml-auto">{{ $word->answers }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
