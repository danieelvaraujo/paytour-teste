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
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 py-4">
            <form
                class="space-y-8"
                method="put"
                action="{{ url('update-application') }}"
                enctype="multipart/form-data"
            >
                @csrf
                <div class="flex flex-col items-center">
                    <h2 class="text-lg font-medium leading-6 text-gray-900">Olá novamente, candidato.</h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Preencha todos os campos que quiser alterar.</p>
                </div>

                <div class="space-y-8 divide-y divide-gray-200">
                    <div class="space-y-6 space-y-5 pt-10">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Informações Pessoais</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <span class="block text-sm font-medium text-gray-700 mt-px pt-2">Nome completo</span>
                                <div class="mt-1 col-span-2 mt-0">
                                    <div class="flex max-w-lg rounded-md shadow-sm">
                                        <input
                                            value="{{ old('name', $application->name) }}"
                                            required
                                            type="text"
                                            name="name"
                                            autocomplete="name"
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <span class="block text-sm font-medium text-gray-700 mt-px pt-2">Email</span>
                                <div class="mt-1 col-span-2 mt-0">
                                    <div class="flex max-w-lg rounded-md shadow-sm">
                                        <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 text-sm">@</span>
                                        <input
                                            value="{{ old('email', $application->email) }}"
                                            readonly
                                            type="email"
                                            name="email"
                                            autocomplete="email"
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <span class="block text-sm font-medium text-gray-700 mt-px pt-2">Telefone</span>
                                <div class="mt-1 col-span-2 mt-0">
                                    <div class="flex max-w-lg rounded-md shadow-sm">
                                        <input
                                            value="{{ old('telephone', $application->telephone) }}"
                                            required
                                            type="text"
                                            name="telephone"
                                            autocomplete="telephone"
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <span class="block text-sm font-medium text-gray-700 mt-px pt-2">Observações</span>
                                <div class="mt-1 col-span-2 mt-0">
                                    <textarea
                                        name="observations"
                                        rows="3"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    >{{ old('observations', $application->observations) }}</textarea>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <span class="block text-sm font-medium text-gray-700 mt-px pt-2">Currículum</span>
                                <div class="mt-1 col-span-2 mt-0">
                                    <div class="flex max-w-lg justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex flex-col text-sm text-gray-600">
                                                <label for="file" class='text-gray-900 font-bold'>Enviar currículo</label>
                                                <input name="file" type="file" />
                                            </div>

                                            <p class="text-xs text-gray-500 pt-2">doc, docx ou pdf de até 1MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 pt-8 space-y-5 pt-10">
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Informações Profissionais</h3>
                        </div>
                        <div class="space-y-6 space-y-5">
                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <label
                                    for="desired_job_title"
                                    class="block text-sm font-medium text-gray-700 mt-px pt-2">Cargo desejado</label>
                                <div class="mt-1 col-span-2 mt-0">
                                    <input
                                        value="{{ old('desired_job_title', $application->desired_job_title) }}"
                                        type="text"
                                        name="desired_job_title"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 max-w-xs text-sm"
                                    >
                                </div>
                            </div>

                            <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                                <label
                                    for="scholarity"
                                    class="block text-sm font-medium text-gray-700 mt-px pt-2">Escolaridade</label>
                                <div class="mt-1 col-span-2 mt-0">
                                    <select
                                        value="{{ old('scholarity', $application->scholarity) }}"
                                        name="scholarity"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 max-w-xs text-sm"
                                    >
                                        <option value="">-- Escolha um --</option>
                                        <option value="fundamental_incompleto">Ensino fundamental incompleto</option>
                                        <option value="fundamental_completo">Ensino fundamental completo</option>
                                        <option value="medio_incompleto">Ensino médio incompleto</option>
                                        <option value="medio_completo">Ensino médio completo</option>
                                        <option value="superior_incompleto">Ensino superior incompleto</option>
                                        <option value="superior_completo">Ensino superior completo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                  <div class="flex justify-end">
                    <button
                        onclick="window.location.href='{{ url()->previous() }}'"
                        type="button"
                        class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Cancelar
                    </button>
                    <button
                        type="submit"
                        class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Atualizar
                    </button>
                  </div>
                </div>
            </form>
        </div>
    </body>
</html>
