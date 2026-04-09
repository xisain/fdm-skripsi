@extends('layout.admin')
@section('header', 'List | User & Collector')

@section('content')
<div class="mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-[var(--flora-moss)] tracking-tight">
                User & Collector
            </h1>
            <p class="text-sm text-[var(--flora-stone)] mt-1">
                Kelola data user dan collector
            </p>
        </div>

        <a href="#"
           class="px-4 py-2 text-sm font-medium text-white bg-[var(--flora-teal)] rounded-lg hover:bg-[var(--flora-moss)] transition">
            + Tambah User
        </a>
    </div>

    {{-- 🔥 CARD (LESS ROUNDED) --}}
    <div class="bg-white border border-[var(--flora-sage-mid)] rounded-lg shadow-sm overflow-hidden">

        {{-- Top Bar --}}
        <div class="px-5 py-3 flex justify-between items-center border-b border-[var(--flora-sage-pale)]">
            <input type="text" placeholder="Cari user..."
                   class="text-sm border border-gray-300 rounded-md px-3 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-flora-teal-light">

            <span class="text-sm text-[var(--flora-stone)]">
                Total: {{ count($user) }}
            </span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                {{-- Head --}}
                <thead class="bg-[var(--flora-sage-pale)] text-[var(--flora-moss)]">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold">User</th>
                        <th class="px-5 py-3 text-left font-semibold">Collector</th>
                        <th class="px-5 py-3 text-left font-semibold">Initial</th>
                        <th class="px-5 py-3 text-left font-semibold">Angka Koleksi</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-right font-semibold">Action</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-[var(--flora-sage-pale)]">

                    @forelse ($user as $usr)
                        <tr class="hover:bg-[var(--flora-mist)] transition">

                            {{-- User --}}
                            <td class="px-5 py-4">
                                <div class="flex flex-col">
                                    <span class="font-medium text-[var(--flora-bark)]">
                                        {{ $usr->name }}
                                    </span>
                                    <span class="text-xs text-[var(--flora-stone)]">
                                        {{ $usr->email }}
                                    </span>
                                </div>
                            </td>

                            {{-- Collector --}}
                            <td class="px-5 py-4 text-[var(--flora-bark)]">
                                {{ $usr->collector?->full_name ?? '-' }}
                            </td>

                            {{-- Initial --}}
                            <td class="px-5 py-4">
                                <span class="px-2 py-1 text-xs font-semibold bg-[var(--flora-teal-pale)] text-[var(--flora-moss)] rounded-md">
                                    {{ $usr->collector?->initial_collector_name ?? '-' }}
                                </span>
                            </td>

                            {{-- Sequence --}}
                            <td class="px-5 py-4 text-[var(--flora-stone)] text-center ">
                            </span class="">
                            {{ $usr->collector?->last_sequence ?? 0 }}
                            <span>
                            </td>

                            <td class="px-5 py-4 text-[var(--flora-stone)]">
                                {{ $usr->status  }}
                            </td>


                            {{-- Action --}}
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">

                                    <a href="#"
                                       class="px-3 py-1.5 text-xs bg-[var(--flora-sage-pale)] text-[var(--flora-moss)] rounded-md hover:bg-[var(--flora-sage-mid)] transition">
                                        Edit
                                    </a>

                                    <button
                                        class="px-3 py-1.5 text-xs bg-red-50 text-red-600 rounded-md hover:bg-red-100">
                                        Delete
                                    </button>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-6 text-center text-[var(--flora-stone)]">
                                Tidak ada data user
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection
