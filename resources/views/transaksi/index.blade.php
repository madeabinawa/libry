@extends('app')

@section('title', 'Transaksi')
@section('page-title', 'Transaksi Under Development')

@section('main')


<!-- component -->
<div class="overflow-x-auto">
    <div class="min-w-screen bg-gray-100 dark:bg-gray-800 flex items-center justify-center bg-gray-100 font-sans">
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto rounded">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Project</th>
                            <th class="py-3 px-6 text-left">Client</th>
                            <th class="py-3 px-6 text-center">Users</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
