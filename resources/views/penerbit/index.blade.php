@extends('app')

@section('title', 'Penerbit')
@section('page-title', 'Daftar Penerbit')

@section('main')


<!-- component -->
<div class="w-1/2 md:w-1/6">
    <button onclick="showAddPenerbitForm()"
        class="bg-green-500 flex justify-center items-center w-full text-white px-2 py-3 rounded-md focus:outline-none text-base sm:text-sm">Tambah
        Penerbit</button>
</div>

<div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 dark:bg-gray-800 flex items-center justify-center bg-gray-100 font-sans">
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto rounded">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">Penerbit</th>
                            <th class="py-3 px-6 text-left">Kota</th>
                            <th class="py-3 px-6 text-left">Telp</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse ($data as $item)
                        <tr class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$loop->iteration}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->nama_penerbit}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->kota}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->telp}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    {{-- <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div> --}}
                                    <button onclick="showUpdatePenerbitForm({{$item}})">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </div>
                                    </button>

                                    <button onclick="showDeleteModal({{$item}})"
                                        class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="border-b border-gray-200 bg-transparent">
                            <td class=" py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">No records found.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="w-auto">
    {{ $data->links() }}
</div>

{{-- Modal --}}
<div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden hidden justify-center items-center animated fadeIn faster"
    style="background: rgba(0,0,0,.7);">
    <div class="min-h-auto w-full md:w-1/3 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 w-full sm:max-w-xl sm:mx-auto">
            <div class="w-auto sm:w-full relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                <div class="max-w-xl mx-auto">
                    <div class="flex items-center space-x-5">
                        <div class="block pb-2 font-semibold text-xl self-start text-gray-700">
                            <h2 id="judul" class="leading-relaxed"></h2>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form id="penerbitForm" name="penerbitForm" enctype="multipart/form-data" method="POST">
                            <div class="text-base pb-4 leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="flex flex-col">
                                    {{-- CSRF TOKEN --}}
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

                                    <input name="id_penerbit" id="id_penerbit" type="hidden"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                                    <label class="leading-loose">Nama Penerbit</label>
                                    <input name="nama_penerbit" id="nama_penerbit" type="text"
                                        class="px-4 mb-2 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="Nama Penerbit">

                                    <label class="leading-loose">Kota Penerbit</label>
                                    <input name="kota" id="kota" type="text"
                                        class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="Kota">

                                    <label class="leading-loose">Telepon</label>
                                    <input name="telp" id="telp" type="text"
                                        class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="Telepon">
                                </div>
                                {{-- <div class="flex items-center space-x-4">
                                <div class="flex flex-col">
                                    <label class="leading-loose">Start</label>
                                    <div class="relative focus-within:text-gray-600 text-gray-400">
                                        <input type="text"
                                            class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                            placeholder="25/02/2020">
                                        <div class="absolute left-3 top-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label class="leading-loose">End</label>
                                    <div class="relative focus-within:text-gray-600 text-gray-400">
                                        <input type="text"
                                            class="pr-4 pl-10 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                            placeholder="26/02/2020">
                                        <div class="absolute left-3 top-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                            <div class="flex flex-col-reverse md:flex-row pt-4">
                                <button onclick="modalClose()" type="button"
                                    class=" cursor-pointer flex md:justify-end md:content-end justify-center items-center md:mr-4 w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg> Cancel
                                </button>

                                <div id="custom_button" class="w-full md:w-auto items-center">

                                    <button type="submit" id="tambah_btn" onclick="storePenerbit()"
                                        class='bg-green-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none'>Tambah</button>

                                    <button type="submit" id="simpan_btn" onclick="updatePenerbit()"
                                        class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Simpan</button>

                                    <button type="submit" id="hapus_btn" onclick="deleteCategory()"
                                        class="bg-red-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src={{asset("js/ajax/penerbit.js")}}></script>
@endsection
