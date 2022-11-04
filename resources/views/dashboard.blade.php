<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Paytour - Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        @if (!$userApplication)
        <div>
            <div class="border-b border-gray-200 px-10 py-5 sm:flex sm:items-center sm:justify-between">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Aplicação</h3>
                <div class="mt-3 flex sm:mt-0 sm:ml-4">
                    <button
                        type="button"
                        class="
                            inline-flex
                            items-center
                            rounded-md
                            border
                            border-gray-300
                            bg-white
                            px-4
                            py-2
                            text-sm
                            font-medium
                            text-gray-700
                            shadow-sm
                            hover:bg-gray-50
                            focus:outline-none
                            focus:ring-2
                            focus:ring-indigo-500
                            focus:ring-offset-2"
                    >
                        Nova aplicação
                    </button>
                </div>
            </div>

            <div class="flex justify-center items-center mt-3">
                <p class="mt-2 max-w-4xl text-md text-gray-500">Faça uma nova aplicação e ela irá aparecer aqui...</p>

            </div>
        </div>
        @else
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 py-4">
            <div class="overflow-hidden bg-white shadow rounded-lg">
                <div class="px-4 py-5 px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Informações da aplicação</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Sumário das informações enviadas.</p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 p-0">
                    <dl class="divide-y divide-gray-200">
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Nome completo</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">Margot Foster</dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">margotfoster@example.com</dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">(84) 987-418-355</dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Vaga desejada</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">Desenvolvedor backend</dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Escolaridade</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">Ensino superior completo</dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Observações</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</dd>
                        </div>
                        <div class="py-4 grid grid-cols-3 gap-4 py-5 px-6">
                            <dt class="text-sm font-medium text-gray-500">Anexos</dt>
                            <dd class="mt-1 text-sm text-gray-900 col-span-2 mt-0">
                                <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                    <li class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <!-- Heroicon name: mini/paper-clip -->
                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 w-0 flex-1 truncate">resume_back_end_developer.pdf</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Download</a>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
                <div class="flex justify-center">
                    <button
                        type="button"
                        class="
                            inline-flex
                            items-center
                            rounded-md
                            border
                            border-gray-300
                            bg-white
                            px-4
                            py-2
                            text-sm
                            font-medium
                            text-gray-700
                            shadow-sm hover:bg-gray-50
                            focus:outline-none
                            focus:ring-2
                            focus:ring-indigo-500
                            focus:ring-offset-2"
                    >
                        Editar aplicação
                    </button>
                </div>
            </div>
        </div>
        @endif
    </body>
</html>
