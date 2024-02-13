<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="./assets/img/favicon.ico" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />
    <title>Very Gud English</title>
</head>

<body class="text-gray-800 antialiased">
    <nav class="flex flex-row bg-indigo-500">
        <div class="text-3xl font-extrabold text-white mt-6 ml-2">Very Gud English</div>
        <a href="{{ route('studenten.periode') }}" class="w-fit h-fit ml-auto mr-2">
            <button class="p-3 bg-white my-4 rounded-full border flex flex-row ">
                <h1 class="text-lg ">Studenten</h1>
            </button>
            <a href="{{ route('docenten') }}" class="w-fit h-fit mr-2">
                <button class="p-3 bg-white mt-4 rounded-full border flex flex-row">
                    <h1 class="text-lg">
                        Docenten
                    </h1>
                </button></a>
        </a>
    </nav>
    <main class="">
        <div class="relative pt-16 pb-32 flex content-center items-center justify-center h-screen"
            style="min-height: 75vh; height:calc(100vh - 86px)">
            <div class="absolute top-0 w-full h-full bg-center bg-cover"
                style='background-image: url("https://img.freepik.com/free-photo/young-skilled-computer-programmer-eyewear-typing-laptop-testing-code_343059-2030.jpg?w=740&t=st=1707825651~exp=1707826251~hmac=f7e355f5cc6e96769d6bf2e5a2cb88c7ebc60e549fb309408462ec0baf654abe");'>
                <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
            </div>
            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                        <div class="pr-12">
                            <h1 class="text-white font-semibold text-4xl">
                                De plek om Engelse Woordenschat te leren
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
