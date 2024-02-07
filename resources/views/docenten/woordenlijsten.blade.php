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
        <h1 class="text-2xl font-extrabold m-7 ml-0 text-white">Woordenlijsten</h1>
        <a href="{{ route('woordenlijsten.create') }}" class="p-7 px-0 -ml-4 text-white"><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col px-5 min-w-60 mt-4"">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="">Titel</div>
            <div class="ml-auto">Preview</div>
            <div class="ml-auto">Actions</div>
        </div>

        <div class="grid grid-cols-3 gap-x-44">
            @foreach ($wordlists as $wordlist)
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $wordlist['title'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">*Preview van woorden*
                </div>
                <div class="flex flex-row">
                    <a href="{{ route('woordenlijsten.edit', $wordlist->id) }}"class=" ml-auto">
                        @csrf
                        <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Edit</button>
                    </a>
                    <form action="{{ route('woordenlijsten.destroy', $wordlist->id) }}" method="POST" class="">
                        @csrf
                        @method('delete')
                        <button type="submit" class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
