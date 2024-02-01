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
    </div>
    <div class="flex flex-col pl-5 min-w-60" style="width: 80vw">
        <div class="flex flex-row border-b-gray-400 border-b-2">
            <div class="mt-4">Periodes</div>
            <div class="ml-auto flex flex-row justify-between">

            </div>

        </div>

        <div class="grid grid-cols-4 gap-x-10">
            @foreach ($periods as $period)
                    <div class="grid grid-cols-1">
                    <div class="text-white m-1 p-5 bg-gray-600 rounded-lg min-w-fit h-[60px]">{{ $period['title'] }}</div>
{{--                        Deze manier is goor --}}
                        <form action="{{ route('periodes.edit', $period->id) }}" method="GET">
                        @if( $period->is_locked == 1)

                                @csrf
                                <div class="px-5 flex flex-col">
                                    <button type="submit" class="text-white m-1 p-1 bg-red-600 rounded-lg w-fit">Locked</button>
                                </div>

                        @endif
                        @if( $period->is_locked == 0)
                                @csrf
                                <div class="px-5 flex flex-col">
                                    <button type="submit" class="text-white m-1 p-1 bg-green-600 rounded-lg w-fit">Unlocked</button>
                                </div>


                        @endif
                        </form>
                    </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
