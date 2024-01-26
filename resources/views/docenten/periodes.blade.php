<!DOCTYPE html>
<?php
if (isset($_GET['periodList'])) {
    $periodValue = (int) $_GET['periodList'];
} else {
    $periodValue = 0;
}
?>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/css/app.css')

    <title>Studenten - VeryGood</title>

    <script>
        // TODO: Dropdown selector voor periodes maken
    </script>
</head>

<x-app-layout>
    <div class="flex flex-row">
        <h1 class="text-2xl font-extrabold p-5">Periodes</h1>
        <a href="{{ route('periodes.create') }}" class="p-5 px-0 -ml-2"><svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </a>
    </div>
    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="mt-4">Toets</div>
            <div class="ml-auto flex flex-row justify-between">
                <form action="" name="periodes" method="GET">
                    @csrf
                    <select project="periodList" name="periodList" id="periodList"
                        class="rounded-lg bg-gray-300 m-2 mt-0">
                        @foreach ($periods as $period)
                            <option value={{ $period['id'] }}>{{ $period['title'] }}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="submit" id="submit" value="Submit"
                        class="bg-gray-300 rounded-lg p-1 border-gray-500 border-2 -ml-2">
                </form>
                <form action="{{ route('periodes.index') }}" name="periodes" method="GET" class="m-0.5">
                    @csrf
                    <input type="submit" name="reset" id="reset" value="Reset"
                        class="bg-gray-300 rounded-lg p-1 border-gray-500 border-2">
                </form>
            </div>
            <div class="ml-auto mt-4">Actions</div>
        </div>

        <div class="grid grid-cols-3 gap-x-44">
            @foreach ($toetsen as $toets)
                @if ($periodValue === 0)
                    <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $toets['title'] }}</div>
                    <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                        Periode {{ $toets['period_id'] }}
                    </div>
                    <div class="flex flex-row">
                        <form action="{{ route('toetsen.edit', $toets->id) }}" method="POST" class="ml-auto">
                            @csrf
                            <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Edit</button>
                        </form>
                        <form action="{{ route('toetsen.destroy', $toets->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                        </form>
                    </div>
                @endif
                @if ($toets['period_id'] === $periodValue)
                    <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">{{ $toets['title'] }}</div>
                    <div class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit ml-auto mr-auto">
                        Periode {{ $toets['period_id'] }}
                    </div>
                    <div class="flex flex-row">
                        <form action="{{ route('toetsen.edit', $toets->id) }}" method="POST" class="ml-auto">
                            @csrf
                            <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Edit</button>
                        </form>
                        <form action="{{ route('toetsen.destroy', $toets->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="text-white m-1 p-1 bg-gray-600 rounded-lg w-fit">Delete</button>
                        </form>
                    </div>
                @endif
            @endforeach

        </div>
    </div>
</x-app-layout>
