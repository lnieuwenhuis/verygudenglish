    <aside
        class="sidebar w-64 md:shadow transform -translate-x-full md:translate-x-0 transition-transform duration-150 ease-in bg-indigo-500">
        <div class="sidebar-header flex items-center justify-center py-4">
            <div class="inline-flex">
                <a href="#" class="inline-flex flex-row items-center">
                    <link rel="icon" type="image/x-icon" href="https://imgur.com/dUJsQ8V.png">
                    <span class="leading-10 text-gray-100 text-2xl font-bold ml-1 uppercase">Very Gud English</span>
                </a>
            </div>
        </div>
        <div class="sidebar-content px-4 py-6">
            <ul class="flex flex-col w-full">
                <li class="my-px">
                    <span class="flex font-medium text-sm text-gray-300 px-4 my-4 uppercase">Welkom [Docent]</span>
                </li>
                <li class="my-px">
                    <a href="#"
                        class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </span>
                        <span class="ml-3" href="{{ route('studenten.index') }}">Studenten</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="#"
                        class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                                <path
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </span>
                        <span class="ml-3" href="{{ route('toetsen.index') }}">Toetsen</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="#"
                        class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </span>
                        <span class="ml-3" href="{{ route('periodes.index') }}">Periodes</span>
                    </a>
                </li>
                <li class="my-px">
                    <a href="#"
                       class="flex flex-row items-center h-10 px-3 rounded-lg text-gray-300 hover:bg-gray-100 hover:text-gray-700">
                        <span class="flex items-center justify-center text-lg text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                        </span>
                        <span class="ml-3">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
