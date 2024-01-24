<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Woorden - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <div class="flex flex-row">
        <h1 class="text-2xl font-extrabold p-5">Woorden</h1>
        <a href="{{ route('woorden.create') }}" class="p-5 px-0 -ml-2"><svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>

    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="">Woord</div>
            <div class="ml-auto">Antwoord</div>
            <div class="ml-auto">Woordenlijst</div>
            <div class="ml-auto">Actions</div>
        </div>

        <div class="grid grid-cols-4 gap-x-44">
            @foreach ($words as $word)
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $word['words'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">{{ $word['answers'] }}
                </div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                    Lijst {{ $word['list_id'] }}
                </div>
                <div class="flex flex-row">
                    <form action="{{ route('woorden.edit', $word->id) }}" method="POST" class=" ml-auto">
                        @csrf
                        <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Edit</button>
                    </form>
                    <form action="{{ route('woorden.destroy', $word->id) }}" method="POST" class="">
                        @csrf
                        @method('delete')
                        <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
