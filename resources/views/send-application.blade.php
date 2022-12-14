@extends('layouts.app')

@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 py-4">
    <form
        class="space-y-8"
        method="post"
        action="{{ url('send-application') }}"
        enctype="multipart/form-data"
    >
        @csrf
        <div class="flex flex-col items-center">
            <h2 class="text-lg font-medium leading-6 text-gray-900">Seja bem vindo, candidato.</h2>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Preencha todos os campos necessários. Você pode enviar também o seu currículo para nós.</p>
        </div>

        <div class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-6 space-y-5 pt-10">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Informações Pessoais</h3>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                        <label
                            for="desired_job_title"
                            class="block text-sm font-medium text-gray-700 mt-px pt-2"
                        >
                            Nome completo
                        </label>
                        <div class="mt-1 col-span-2 mt-0">
                            <input
                                required
                                value="{{ Auth::user()->name }}"
                                valu=''
                                type="text"
                                name="name"
                                autocomplete="name"
                                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            >
                            @error('name')
                                <div class="mx-10 ">
                                    <ul role="list">
                                        <li class="flex items-center justify-between">
                                            <span class="mt-1 max-w-2xl text-sm text-red-500">
                                                {{ $message }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                        <label
                            for="desired_job_title"
                            class="block text-sm font-medium text-gray-700 mt-px pt-2"
                        >
                            Email
                        </label>
                        <div class="mt-1 col-span-2 mt-0">
                            <input
                                required
                                value="{{ Auth::user()->email }}"
                                type="email"
                                name="email"
                                autocomplete="email"
                                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            >
                            @error('email')
                                <div class="mx-10 ">
                                    <ul role="list">
                                        <li class="flex items-center justify-between">
                                            <span class="mt-1 max-w-2xl text-sm text-red-500">
                                                {{ $message }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                        <label
                            for="desired_job_title"
                            class="block text-sm font-medium text-gray-700 mt-px pt-2"
                        >
                            Telefone
                        </label>
                        <div class="mt-1 col-span-2 mt-0">
                            <input
                                required
                                type="text"
                                name="telephone"
                                autocomplete="telephone"
                                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            >
                            @error('telephone')
                                <div class="mx-10 ">
                                    <ul role="list">
                                        <li class="flex items-center justify-between">
                                            <span class="mt-1 max-w-2xl text-sm text-red-500">
                                                {{ $message }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                        <label
                            for="desired_job_title"
                            class="block text-sm font-medium text-gray-700 mt-px pt-2"
                        >
                            Observações
                        </label>
                        <div class="mt-1 col-span-2 mt-0">
                            <textarea
                                name="observations"
                                rows="3"
                                class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            ></textarea>
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
                                        <input name="file" type="file" accept=".doc,.docx,application/pdf" />
                                    </div>
                                    @error('file')
                                        <div class="mx-10 ">
                                            <ul role="list">
                                                <li class="flex items-center justify-between">
                                                    <span class="mt-1 max-w-2xl text-sm text-red-500">
                                                        {{ $message }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    @enderror

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
                            class="block text-sm font-medium text-gray-700 mt-px pt-2"
                        >
                            Cargo desejado
                        </label>
                        <div class="mt-1 col-span-2 mt-0">
                            <input
                                type="text"
                                name="desired_job_title"
                                class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 max-w-xs text-sm"
                            >
                            @error('desired_job_title')
                                <div class="mx-10 ">
                                    <ul role="list">
                                        <li class="flex items-center justify-between">
                                            <span class="mt-1 max-w-2xl text-sm text-red-500">
                                                {{ $message }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 items-start gap-4 border-t border-gray-200 pt-5">
                        <label
                            for="scholarity"
                            class="block text-sm font-medium text-gray-700 mt-px pt-2"
                        >
                            Escolaridade
                        </label>
                        <div class="mt-1 col-span-2 mt-0">
                            <select
                                name="scholarity"
                                class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 max-w-xs text-sm"
                            >
                                <option value="">-- Escolha um --</option>
                                @foreach ($scholarities as $scholarity)
                                    <option value="{{ $scholarity->value}}">{{ $scholarity->title }}</option>
                                @endforeach
                            </select>
                            @error('scholarity')
                                <div class="mx-10 ">
                                    <ul role="list">
                                        <li class="flex items-center justify-between">
                                            <span class="mt-1 max-w-2xl text-sm text-red-500">
                                                {{ $message }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            @enderror
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
                Enviar
            </button>
            </div>
        </div>
    </form>
</div>
@endsection
