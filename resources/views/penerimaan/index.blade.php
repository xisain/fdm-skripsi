@extends('layout.admin')
@section('header', 'List | Penerimaan')
@section('description','')
@section('content')
    <div class="mx-auto px-2 py-2">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-[var(--flora-moss)] tracking-tight">Penerimaan</h1>
                <p class="text-sm text-[var(--flora-stone)] mt-0.5">Daftar seluruh data penerimaan tanaman</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="#"
                   class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-[var(--flora-sage)] border border-[var(--flora-sage-mid)] bg-[var(--flora-sage-pale)] rounded-xl hover:bg-[var(--flora-sage-mid)] transition-colors">
                    <i class="fa-solid fa-file-excel"></i>
                    <span>Export</span>
                </a>
                <a href="{{ route('penerimaan.create') }}"
                   class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-[var(--flora-teal)] rounded-xl hover:bg-[var(--flora-moss)] transition-colors shadow-sm">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Penerimaan</span>
                </a>
            </div>
        </div>

        {{-- Flash Success --}}
        @if (session('success'))
            <div class="flex items-center gap-3 px-4 py-3 mb-5 bg-[var(--flora-teal-pale)] border border-[var(--flora-teal-light)] rounded-xl text-[var(--flora-moss)] text-sm font-medium">
                <i class="fa-solid fa-circle-check text-[var(--flora-teal)]"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stat Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

            {{-- Total Penerimaan --}}
            <div class="bg-white rounded-2xl border border-[var(--flora-sage-mid)] px-5 py-4 flex items-center gap-4 shadow-sm">
                <div class="w-11 h-11 rounded-xl bg-[var(--flora-teal-pale)] flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-clipboard-list text-[var(--flora-teal)] text-lg"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[var(--flora-moss)] leading-none">{{ $stats['total'] }}</p>
                    <p class="text-xs text-[var(--flora-stone)] mt-1">Total Penerimaan</p>
                </div>
            </div>

            {{-- Total Tanaman --}}
            <div class="bg-white rounded-2xl border border-[var(--flora-sage-mid)] px-5 py-4 flex items-center gap-4 shadow-sm">
                <div class="w-11 h-11 rounded-xl bg-[var(--flora-sage-pale)] flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-seedling text-[var(--flora-sage)] text-lg"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[var(--flora-moss)] leading-none">{{ $stats['total_tanaman'] }}</p>
                    <p class="text-xs text-[var(--flora-stone)] mt-1">Total Tanaman</p>
                </div>
            </div>

            {{-- Eksplorasi --}}
            <div class="bg-white rounded-2xl border border-[var(--flora-sage-mid)] px-5 py-4 flex items-center gap-4 shadow-sm">
                <div class="w-11 h-11 rounded-xl bg-[var(--flora-teal-pale)] flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-map-location-dot text-[var(--flora-teal)] text-lg"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[var(--flora-moss)] leading-none">{{ $stats['eksplorasi'] }}</p>
                    <p class="text-xs text-[var(--flora-stone)] mt-1">Eksplorasi</p>
                </div>
            </div>

            {{-- Introduksi --}}
            <div class="bg-white rounded-2xl border border-[var(--flora-sage-mid)] px-5 py-4 flex items-center gap-4 shadow-sm">
                <div class="w-11 h-11 rounded-xl bg-[var(--flora-amber-pale)] flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-arrow-right-to-bracket text-[var(--flora-amber)] text-lg"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-[var(--flora-moss)] leading-none">{{ $stats['introduksi'] }}</p>
                    <p class="text-xs text-[var(--flora-stone)] mt-1">Introduksi</p>
                </div>
            </div>

        </div>

        {{-- Empty State --}}
        @if ($penerimaans->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-2xl border border-[var(--flora-sage-mid)]">
                <div class="w-16 h-16 rounded-2xl bg-[var(--flora-sage-pale)] flex items-center justify-center mb-4 text-[var(--flora-sage)] text-2xl">
                    <i class="fa-solid fa-clipboard"></i>
                </div>
                <p class="text-[var(--flora-bark)] font-medium mb-1">Belum ada data penerimaan</p>
                <p class="text-sm text-[var(--flora-stone)] mb-4">Mulai dengan menambahkan penerimaan pertama</p>
                <a href="{{ route('penerimaan.create') }}"
                   class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-[var(--flora-teal)] rounded-xl hover:bg-[var(--flora-moss)] transition-colors">
                    <i class="fa-solid fa-plus"></i> Tambah Penerimaan
                </a>
            </div>

        @else

        {{-- Accordion List --}}
        <div class="space-y-3">
            @foreach ($penerimaans as $penerimaan)
                <div class="bg-white border border-[var(--flora-sage-mid)] rounded-2xl overflow-hidden shadow-sm"
                     x-data="{
                        open: false,
                        sortCol: '',
                        sortDir: 'asc',
                        rows: {{ $penerimaan->tanamanPenerimaans->map(fn($t) => [
                            'no'             => $loop->iteration,
                            'scientific_name'=> $t->scientific_name ?: '',
                            'nomor_akses'    => $t->nomor_akses ?: '',
                            'nama_lokal'     => $t->nama_lokal ?: '',
                            'marga'          => $t->marga ?: '',
                            'suku'           => $t->suku ?: '',
                            'spesies'        => $t->spesies ?: '',
                            'jumlah_material'=> $t->jumlah_material ?: '',
                            'vak_no'         => $t->vak_no ?: '',
                            'locality'       => $t->locality ?: '',
                        ])->values()->toJson() }},
                        get sorted() {
                            if (!this.sortCol) return this.rows;
                            return [...this.rows].sort((a, b) => {
                                let av = a[this.sortCol] ?? '';
                                let bv = b[this.sortCol] ?? '';
                                // numeric sort for jumlah_material
                                if (this.sortCol === 'jumlah_material') {
                                    av = parseFloat(av) || 0;
                                    bv = parseFloat(bv) || 0;
                                    return this.sortDir === 'asc' ? av - bv : bv - av;
                                }
                                return this.sortDir === 'asc'
                                    ? String(av).localeCompare(String(bv))
                                    : String(bv).localeCompare(String(av));
                            });
                        },
                        setSort(col) {
                            if (this.sortCol === col) {
                                this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc';
                            } else {
                                this.sortCol = col;
                                this.sortDir = 'asc';
                            }
                        }
                     }">

                    {{-- Accordion Header --}}
                    <button type="button"
                            @click="open = !open"
                            class="w-full flex items-center justify-between px-5 py-4 text-left hover:bg-[var(--flora-mist)] transition-colors focus:outline-none">

                        <div class="flex items-center gap-4 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-[var(--flora-teal-pale)] flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-leaf text-[var(--flora-teal)] text-sm"></i>
                            </div>

                            <div class="min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-sm font-semibold text-[var(--flora-moss)]">
                                        {{ $penerimaan->tempat_asal }}
                                        @if($penerimaan->country)
                                            <span class="font-normal text-[var(--flora-stone)]">({{ $penerimaan->country }})</span>
                                        @endif
                                    </span>
                                    <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full
                                        {{ $penerimaan->jenis_form === 'eksplorasi' ? 'bg-[var(--flora-teal-pale)] text-[var(--flora-moss)]' : 'bg-[var(--flora-amber-pale)] text-[var(--flora-earth)]' }}">
                                        {{ ucfirst($penerimaan->jenis_form) }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 mt-1 text-xs text-[var(--flora-stone)]">
                                    <span><i class="fa-regular fa-calendar mr-1"></i>Eksplorasi:
                                        {{ \Carbon\Carbon::parse($penerimaan->tanggal_explorasi)->isoFormat('D MMM YYYY') }}
                                    </span>
                                    <span class="text-[var(--flora-sage-mid)]">•</span>
                                    <span><i class="fa-regular fa-calendar-check mr-1"></i>Penerimaan:
                                        {{ \Carbon\Carbon::parse($penerimaan->tanggal_penerimaan)->isoFormat('D MMM YYYY') }}
                                    </span>
                                    <span class="text-[var(--flora-sage-mid)]">•</span>
                                    <span><i class="fa-solid fa-seedling mr-1"></i>{{ $penerimaan->tanamanPenerimaans->count() }} tanaman</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 flex-shrink-0 ml-4">
                            <div class="hidden sm:flex items-center -space-x-2">
                                @foreach ($penerimaan->timPenerimaans->take(3) as $tim)
                                    <div class="w-7 h-7 rounded-full bg-[var(--flora-sage-pale)] border-2 border-white flex items-center justify-center text-[var(--flora-sage)] text-xs font-semibold"
                                         title="{{ $tim->user?->name }} ({{ $tim->role }})">
                                        {{ strtoupper(substr($tim->user?->name ?? '?', 0, 1)) }}
                                    </div>
                                @endforeach
                                @if ($penerimaan->timPenerimaans->count() > 3)
                                    <div class="w-7 h-7 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center text-gray-500 text-xs font-medium">
                                        +{{ $penerimaan->timPenerimaans->count() - 3 }}
                                    </div>
                                @endif
                            </div>
                            <i class="fa-solid fa-chevron-down text-[var(--flora-stone)] text-sm transition-transform duration-200"
                               :class="{ 'rotate-180': open }"></i>
                        </div>
                    </button>

                    {{-- Accordion Body --}}
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         class="border-t border-[var(--flora-sage-pale)]">

                        {{-- Meta info strip --}}
                        <div class="px-5 py-3 bg-[var(--flora-mist)] flex flex-wrap gap-x-6 gap-y-1 text-xs text-[var(--flora-bark)]">
                            <span><span class="font-semibold text-[var(--flora-stone)] uppercase tracking-wide mr-1">Native:</span>{{ $penerimaan->native ?? '-' }}</span>
                            <span><span class="font-semibold text-[var(--flora-stone)] uppercase tracking-wide mr-1">Source:</span>{{ $penerimaan->source ?? '-' }}</span>
                            <span><span class="font-semibold text-[var(--flora-stone)] uppercase tracking-wide mr-1">Dibuat oleh:</span>{{ $penerimaan->user?->name ?? '-' }}</span>
                            @if($penerimaan->timPenerimaans->isNotEmpty())
                                <span>
                                    <span class="font-semibold text-[var(--flora-stone)] uppercase tracking-wide mr-1">Tim:</span>
                                    {{ $penerimaan->timPenerimaans->map(fn($t) => ($t->user?->name ?? '?') . ' (' . $t->role . ')')->implode(', ') }}
                                </span>
                            @endif
                        </div>

                        {{-- Table sub-header: count + sort hint --}}
                        <div class="px-5 py-2.5 flex items-center justify-between border-b border-[var(--flora-sage-pale)]">
                            <p class="text-xs font-semibold text-[var(--flora-moss)]">
                                <i class="fa-solid fa-table-list mr-1 opacity-60"></i>
                                Data Tanaman
                                <span class="ml-1 font-normal text-[var(--flora-stone)]">({{ $penerimaan->tanamanPenerimaans->count() }} baris)</span>
                            </p>
                            <p class="text-xs text-[var(--flora-stone)] italic hidden sm:block">Klik header kolom untuk mengurutkan</p>
                        </div>

                        {{-- Data Tanaman --}}
                        @if ($penerimaan->tanamanPenerimaans->isEmpty())
                            <div class="px-5 py-8 text-center text-sm text-[var(--flora-stone)]">
                                <i class="fa-solid fa-leaf text-2xl mb-2 opacity-30 block"></i>
                                Belum ada data tanaman untuk penerimaan ini.
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="w-full text-xs">
                                    <thead>
                                        <tr class="bg-[var(--flora-sage-pale)] text-[var(--flora-moss)]">
                                            {{-- Non-sortable # --}}
                                            <th class="px-4 py-3 text-left font-semibold whitespace-nowrap w-10">#</th>

                                            {{-- Sortable columns --}}
                                            @php
                                                $cols = [
                                                    'scientific_name' => 'Scientific Name',
                                                    'nomor_akses'     => 'No. Akses',
                                                    'nama_lokal'      => 'Nama Lokal',
                                                    'marga'           => 'Marga',
                                                    'suku'            => 'Suku',
                                                    'spesies'         => 'Spesies',
                                                    'jumlah_material' => 'Jumlah',
                                                    'vak_no'          => 'VAK No',
                                                    'locality'        => 'Locality',
                                                ];
                                            @endphp
                                            @foreach ($cols as $key => $label)
                                                <th class="px-4 py-3 text-left font-semibold whitespace-nowrap cursor-pointer select-none group"
                                                    @click="setSort('{{ $key }}')">
                                                    <div class="flex items-center gap-1">
                                                        <span>{{ $label }}</span>
                                                        <span class="flex flex-col leading-none opacity-40 group-hover:opacity-80 transition-opacity"
                                                              :class="sortCol === '{{ $key }}' ? 'opacity-100 text-[var(--flora-teal)]' : ''">
                                                            <i class="fa-solid fa-caret-up text-[8px]"
                                                               :class="sortCol === '{{ $key }}' && sortDir === 'asc' ? 'opacity-100' : 'opacity-30'"></i>
                                                            <i class="fa-solid fa-caret-down text-[8px]"
                                                               :class="sortCol === '{{ $key }}' && sortDir === 'desc' ? 'opacity-100' : 'opacity-30'"></i>
                                                        </span>
                                                    </div>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(row, i) in sorted" :key="i">
                                            <tr class="border-t border-[var(--flora-sage-pale)] hover:bg-[var(--flora-amber-pale)] transition-colors">
                                                <td class="px-4 py-2.5 text-[var(--flora-amber)] font-bold text-center" x-text="i + 1"></td>
                                                <td class="px-4 py-2.5 italic text-[var(--flora-bark)] whitespace-nowrap" x-text="row.scientific_name || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.nomor_akses || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.nama_lokal || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.marga || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.suku || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.spesies || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] text-center" x-text="row.jumlah_material || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.vak_no || '-'"></td>
                                                <td class="px-4 py-2.5 text-[var(--flora-bark)] whitespace-nowrap" x-text="row.locality || '-'"></td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if ($penerimaans->hasPages())
            <div class="mt-6">
                {{ $penerimaans->links() }}
            </div>
        @endif

        @endif
    </div>
@endsection
