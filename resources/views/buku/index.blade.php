@extends('app')

@section('title', 'Buku')
@section('page-title', 'Daftar Buku')

@section('main')


{{-- IF ANY ERROR WHILE VALIDATE --}}
@if ($errors->any())
<div id="alert" class="flex justify-end">
    <div class="bg-red-50 p-4 rounded flex items-start text-red-600 my-4 shadow-lg max-w-2xl fade-in">
        <div class="text-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-5 pt-1" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.597 17.954l-4.591-4.55-4.555 4.596-1.405-1.405 4.547-4.592-4.593-4.552 1.405-1.405 4.588 4.543 4.545-4.589 1.416 1.403-4.546 4.587 4.592 4.548-1.403 1.416z" />
            </svg>
        </div>
        <div class=" px-3">
            <h3 class="text-red-800 font-semibold tracking-wider">
                Danger
            </h3>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="document.getElementById('alert').classList.add('hidden');"
            class="inline-flex items-center hover:bg-red-100 border border-red-50 hover:border-red-300 hover:text-red-900 focus:outline-none rounded-full p-2 hover:cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 h-4 pt-1" viewBox="0 0 24 24">
                <path
                    d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
            </svg>
        </button>
    </div>
</div>
@endif

<div class="w-1/2 md:w-1/6">
    <button onclick="showAddBukuForm()"
        class="bg-green-500 flex justify-center items-center w-full text-white px-2 py-3 rounded-md focus:outline-none text-base sm:text-sm">Tambah
        Buku</button>
</div>

<div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 dark:bg-gray-800 flex items-center justify-center bg-gray-100 font-sans">
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto rounded">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">No</th>
                            <th class="py-3 px-6 text-left">ISBN</th>
                            <th class="py-3 px-6 text-left">Judul</th>
                            <th class="py-3 px-6 text-left">Tahun</th>
                            <th class="py-3 px-6 text-left">Kategori</th>
                            <th class="py-3 px-6 text-left">Jumlah</th>
                            <th class="py-3 px-6 text-center">Cover</th>
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
                                    <span class="font-medium">{{$item->isbn}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->judul}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->tahun_terbit}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->kategori->jenis_kategori}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$item->jumlah}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    @if ($item->gambar != '')
                                    <img class="w-24 h-auto  border transform object-cover"
                                        src="{{asset('storage/gambar/'. $item->gambar)}}" />
                                    @else
                                    <img class="w-24 h-w24 rounded-full border-gray-200 border transform object-cover"
                                        src="{{asset('storage/gambar/default.png')}}" />
                                    @endif

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
                                    <button onclick="showUpdateBukuForm({{$item}})">
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
                            <h2 id="judulModal" class="leading-relaxed"></h2>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <form id="bukuForm" name="bukuForm" enctype="multipart/form-data" method="POST">
                            <div class="text-base pb-4 leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="flex flex-col">
                                    {{-- CSRF TOKEN --}}
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />

                                    <input name="id_buku" id="id_buku" type="hidden"
                                        class="px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                                    <label class="leading-loose">ISBN</label>
                                    <input name="isbn" id="isbn" type="text"
                                        class="px-4 mb-2 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="ISBN">

                                    <label class="leading-loose">Judul</label>
                                    <input name="judul" id="judul" type="text"
                                        class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                        placeholder="Judul">

                                    <div class="w-full flex md:inline-flex">
                                        <div class="w-full md:w-2/3 md:mr-1">
                                            <label class="leading-loose">Kategori</label>
                                            <select
                                                class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                name="id_kategori" id="id_kategori">
                                                {{$kategori = \App\Models\Kategori::all()}}
                                                @foreach ($kategori as $item)
                                                <option value="{{$item->id_kategori}}">{{$item->jenis_kategori}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-full md:w-1/3 md:ml-1">
                                            <label class="leading-loose">Tahun</label>
                                            <input name="tahun_terbit" id="tahun_terbit" type="text" maxlength="4"
                                                minlength="4"
                                                class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                placeholder="Tahun">
                                        </div>
                                    </div>

                                    <div class="w-full flex md:inline-flex">
                                        <div class="w-full md:w-2/3 md:mr-1">
                                            <label class="leading-loose">Penerbit</label>
                                            <select
                                                class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                name="id_penerbit" id="id_penerbit">
                                                {{$penerbit = \App\Models\Penerbit::all()}}
                                                @foreach ($penerbit as $item)
                                                <option value="{{$item->id_penerbit}}">{{$item->nama_penerbit}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-full md:w-1/3 md: ml-1">
                                            <label class="leading-loose">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" value="1" min="1"
                                                class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                placeholder="Eksemplar">
                                        </div>
                                    </div>

                                    <label id="gambarPathLabel" class="leading-loose">Gambar</label>
                                    <input name="gambarPath" id="gambarPath" type="file"
                                        class="px-4 py-2 mb-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

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

                                    <button type="submit" id="tambah_btn" onclick="storeBuku()"
                                        class='bg-green-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none'>Tambah</button>

                                    <button type="submit" id="simpan_btn" onclick="updateBuku()"
                                        class="bg-blue-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Simpan</button>

                                    <button type="submit" id="hapus_btn" onclick="deleteBuku()"
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
<script src={{asset("js/ajax/buku.js")}}></script>
<script>
    // FILEPOND INPUT
    const inputElement = document.querySelector('input[id="gambarPath"]');
    const pond = FilePond.create( inputElement );
    // FILEPOND TEMPORARY SAVE FILE TO SERVER
    FilePond.setOptions({
        server: {
            url:'/upload',
            headers:{
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        }
    });
</script>
@endsection
