<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woordenlijsten - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <div class="flex flex-row">
        <h1 class="text-2xl font-extrabold p-5">Woordenlijsten</h1>
        <a href="{{ route('woordenlijsten.create') }}" class="p-5 px-0 -ml-2"><svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
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
