<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Toetsen - VeryGood</title>

    <script></script>
</head>

<x-app-layout>
    <div class="flex flex-row">
        <h1 class="text-2xl font-extrabold p-5">Toetsen</h1>
        <a href="{{ route('toetsen.create') }}" class="p-5 px-0 -ml-2"><svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>
    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="">Naam</div>
            <div class="ml-auto">Periode</div>
            <div class="ml-auto">Actions</div>
        </div>

        <div class="grid grid-cols-3 gap-x-44">
            @foreach ($toetsen as $toets)
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $toets['title'] }}</div>
                <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">{{ $toets['period_id'] }}
                </div>
                <form action="{{ route('toetsen.destroy', $toets->id) }}" method="POST" class=" ml-auto">
                    @csrf
                    @method('delete')
                    <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                </form>
            @endforeach
        </div>
    </div>
</x-app-layout>
