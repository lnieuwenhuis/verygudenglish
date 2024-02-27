<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woordenlijsten - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
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

        <h1 class="text-2xl font-extrabold m-7 ml-0 text-white">Woordenlijst Aanmaken</h1>
    </div>

    <div class="py-4">
        <form action="{{ route('woordenlijsten.store') }}" method="POST">
            @csrf
            <div class="px-5 flex flex-col">

                <input type="text" name="title" id="title" placeholder="Titel" class=" rounded-lg">
                <select name="period_id" id="period_id" class=" rounded-lg">
                    @foreach ($periods as $period)
                        <option class=" rounded-lg" value="{{ $period->id }}">{{ $period->title }}</option>
                    @endforeach
                </select>

                <button class=" rounded-lg" type="submit">Submit</button>
            </div>

        </form>
    </div>


</x-app-layout>
