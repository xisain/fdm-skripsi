@extends('layout.admin')
@section('content')
    <div class="mx-auto px-4 py-6" x-data="{ openId: null }">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[var(--flora-teal)]/10 flex items-center justify-center">
                    <i class="fa-solid fa-people-group text-[var(--flora-teal)]"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-[var(--flora-moss)] tracking-tight">Tim Eksplorasi</h1>
                    <p class="text-xs text-[var(--flora-stone)] mt-0.5">Kelola data Tim Eksplorasi</p>
                </div>
            </div>
            <a href="{{ route('team.create') }}"
                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-[var(--flora-teal)] rounded-xl hover:opacity-90 active:scale-95 transition-all shadow-sm">
                <i class="fa-solid fa-plus text-xs"></i>
                Buat Tim Baru
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200 rounded-xl text-sm text-emerald-700 font-medium">
                <i class="fa-solid fa-circle-check text-emerald-500"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Empty State --}}
        @if ($teams->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 bg-white border border-gray-100 rounded-2xl shadow-sm">
                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-people-group text-gray-300 text-2xl"></i>
                </div>
                <p class="text-sm font-semibold text-gray-500">Belum ada tim eksplorasi</p>
                <p class="text-xs text-gray-400 mt-1 mb-5">Mulai dengan membuat tim baru</p>
                <a href="{{ route('team.create') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-[var(--flora-teal)] rounded-xl hover:opacity-90 transition">
                    <i class="fa-solid fa-plus text-xs"></i> Buat Tim
                </a>
            </div>

        {{-- Table --}}
        @else
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                {{-- Table Header --}}
                <div class="grid grid-cols-12 gap-4 px-5 py-3 bg-gray-50 border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                    <div class="col-span-1 text-center">#</div>
                    <div class="col-span-4">Nama Tim</div>
                    <div class="col-span-3">Lokasi</div>
                    <div class="col-span-2 text-center">Anggota</div>
                    <div class="col-span-2 text-right">Aksi</div>
                </div>

                {{-- Rows --}}
                <div class="divide-y divide-gray-100">
                    @foreach ($teams as $i => $t)
                        <div x-data="{ open: false }">

                            {{-- Main Row --}}
                            <div
                                class="grid grid-cols-12 gap-4 px-5 py-3.5 items-center cursor-pointer
                                       hover:bg-[var(--flora-teal)]/5 transition-colors duration-150 group"
                                @click="open = !open">

                                {{-- No --}}
                                <div class="col-span-1 text-center">
                                    <span class="text-xs font-bold text-gray-400">{{ $loop->iteration }}</span>
                                </div>

                                {{-- Nama Tim --}}
                                <div class="col-span-4 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-[var(--flora-teal)]/10 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-compass text-[var(--flora-teal)] text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">{{ $t->team_name }}</p>
                                        @if($t->description)
                                            <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $t->description }}</p>
                                        @endif
                                    </div>
                                </div>

                                {{-- Lokasi --}}
                                <div class="col-span-3">
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-500">
                                        <i class="fa-solid fa-location-dot text-[var(--flora-teal)] text-[10px]"></i>
                                        {{ $t->explore_location }}
                                    </span>
                                </div>

                                {{-- Jumlah Anggota --}}
                                <div class="col-span-2 flex justify-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                                 bg-[var(--flora-teal)]/10 text-[var(--flora-teal)]">
                                        <i class="fa-solid fa-users text-[10px]"></i>
                                        {{ $t->team_member->count() }} orang
                                    </span>
                                </div>

                                {{-- Aksi --}}
                                <div class="col-span-2 flex items-center justify-end gap-2" @click.stop>
                                    <a href="#"
                                        class="p-1.5 rounded-lg text-gray-400 hover:text-[var(--flora-teal)] hover:bg-[var(--flora-teal)]/10 transition-colors"
                                        title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    <form action="#" method="POST"
                                        onsubmit="return confirm('Hapus tim {{ addslashes($t->team_name) }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 rounded-lg text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>

                                    {{-- Chevron toggle --}}
                                    <div class="p-1.5 rounded-lg text-gray-300 group-hover:text-[var(--flora-teal)] transition-colors">
                                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
                                            :class="open ? 'rotate-180' : ''"></i>
                                    </div>
                                </div>

                            </div>

                            {{-- Accordion: Member Detail --}}
                            <div x-show="open" x-collapse
                                class="border-t border-dashed border-gray-100 bg-gray-50/50">

                                <div class="px-5 py-4">
                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">
                                        <i class="fa-solid fa-id-badge mr-1"></i> Daftar Anggota
                                    </p>

                                    @if ($t->team_member->isEmpty())
                                        <p class="text-xs text-gray-400 italic">Belum ada anggota terdaftar.</p>
                                    @else
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($t->team_member as $tm)
                                                <div class="flex items-center gap-2 px-3 py-2 rounded-xl border text-sm
                                                    {{ $tm->role === 'Ketua'
                                                        ? 'bg-amber-50 border-amber-200 text-amber-700'
                                                        : 'bg-white border-gray-200 text-gray-600' }}">

                                                    {{-- Avatar Initials --}}
                                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold flex-shrink-0
                                                        {{ $tm->role === 'Ketua' ? 'bg-amber-200 text-amber-800' : 'bg-gray-200 text-gray-600' }}">
                                                        {{ strtoupper(substr($tm->user->name, 0, 1)) }}
                                                    </div>

                                                    <div>
                                                        <p class="text-xs font-semibold leading-none">{{ $tm->user->name }}</p>
                                                        <p class="text-[10px] mt-0.5 leading-none opacity-70 flex items-center gap-1">
                                                            @if ($tm->role === 'Ketua')
                                                                <i class="fa-solid fa-crown text-[8px]"></i>
                                                            @else
                                                                <i class="fa-solid fa-user text-[8px]"></i>
                                                            @endif
                                                            {{ $tm->role }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Description --}}
                                    @if ($t->description)
                                        <div class="mt-4 pt-3 border-t border-gray-100">
                                            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-1">
                                                <i class="fa-solid fa-align-left mr-1"></i> Deskripsi
                                            </p>
                                            <p class="text-xs text-gray-500">{{ $t->description }}</p>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Footer --}}
                <div class="px-5 py-3 bg-gray-50/50 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-xs text-gray-400">
                        Total <span class="font-semibold text-gray-600">{{ $teams->count() }}</span> tim
                    </p>
                    <p class="text-xs text-gray-400">Klik baris untuk melihat detail anggota</p>
                </div>

            </div>
        @endif

    </div>
@endsection