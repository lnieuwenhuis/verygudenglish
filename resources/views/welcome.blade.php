<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head class="text-green-500">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>Woordenschat Game</title>

</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-400">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="localhost:8000" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/Flag_of_the_United_Kingdom.png"
                    class="h-8 w-14" alt="Engelse Vlag" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-gray-700">
                    Engels Woordenschat
                </span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-500 md:dark:bg-gray-500 dark:border-gray-700">
                    <li class="p-1">
                        <a href="#" {{-- TODO: Link naar Landstede Azure toevoegen --}}
                            class="block py-2 px-3 text-gray-700 bg-blue-700 rounded md:bg-transparent md:text-gray-700 md:p-0 dark:text-gray-700 md:dark:text-gray-700"
                            aria-current="page">Inloggen</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="bg-gray-800 h-screen">
        <div class="w-3/4 ml-auto mr-auto bg-gray-500 h-full">
            <div class="text-center text-2xl font-semibold pt-5 dark:text-gray-800">Leer hier eenvoudig jouw Engelse
                Woordenschat!
            </div>
        </div>
    </div>

</body>

</html>
