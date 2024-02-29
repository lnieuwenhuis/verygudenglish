<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten Panel</title>

    <script></script>
</head>

<x-guest-layout>
    <div class="flex justify-center">
        <div class="flex flex-row w-1/3">
            <div class="bg-gray-400 h-auto w-60 m-auto mt-5 rounded-xl">
                <div>
                    <div class="flex justify-center">
                        <p class="p-2 font-bold">Nederlands</p>
                    </div>
                    @foreach ($words as $word)
                        <div class="flex justify-center">
                            <div class="p-1">{{ $word->words }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-gray-400 h-auto w-60 m-auto mt-5 rounded-xl">
                <div>
                    <div class="flex justify-center">
                        <p class="p-2 font-bold">Engels</p>
                    </div>
                    @foreach ($words as $word)
                        <div class="flex justify-center">
                            <div class="p-1">{{ $word->answers }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
