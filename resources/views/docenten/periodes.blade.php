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
    <div class="flex flex-row bg-indigo-500">
        <a href="{{ route('docenten') }}" class="w-fit h-fit">
            <button class="p-3 bg-white rounded-full m-4 border flex flex-row"><svg xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <h1 class="text-lg">
                    Terug
                </h1>
            </button></a>
        <h1 class="text-2xl font-extrabold m-7 ml-0 text-white">Periodes</h1>

    </div>
    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="grid grid-cols-4 gap-x-10 pt-5">
            @foreach ($periods as $period)
                <div class="grid grid-cols-1">
                    <div class="text-white m-1 p-5 bg-indigo-400 rounded-lg min-w-fit h-[60px] flex flex-row">
                        <h1>{{ $period['title'] }}</h1>
                        {{-- Deze manier is goor --}}
                        <form action="{{ route('periodes.edit', $period->id) }}" method="GET" class=" ml-auto">
                            @if ($period->is_locked == 1)
                                @csrf
                                <div class="flex flex-col ">
                                    <button type="submit"
                                        class="text-white p-1 -mt-1 bg-red-600 rounded-lg w-fit">Locked</button>
                                </div>
                            @endif
                            @if ($period->is_locked == 0)
                                @csrf
                                <div class="flex flex-col">
                                    <button type="submit"
                                        class="text-white p-1 -mt-1 bg-green-600 rounded-lg w-fit">Unlocked</button>
                                </div>
                            @endif
                        </form>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
