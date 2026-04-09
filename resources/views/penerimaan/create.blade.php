@extends('layout.admin')
@section('content')
    @if ($errors->any())
        <div class="mb-4 flex gap-3 px-4 py-3.5 bg-red-50 border border-red-200 rounded-xl text-sm">
            <div class="flex-shrink-0 pt-0.5">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-base"></i>
            </div>
            <div>
                <p class="font-semibold text-red-700 mb-1">Terdapat {{ $errors->count() }} kesalahan pengisian:</p>
                <ul class="list-disc list-inside space-y-0.5 text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @foreach ($team as $t)
        {{ $t->team_name }}
    @endforeach
    <div class="mx-auto px-4 py-2" x-data="penerimaanForm">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-[var(--flora-moss)] tracking-tight">Penerimaan</h1>
                <p class="text-sm text-[var(--flora-stone)] mt-0.5">Formulir Penerimaan Baru</p>
            </div>
            <a href="{{ route('penerimaan.index') }}"
                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-600 bg-yellow-300 rounded-xl hover:bg-yellow-400 transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back</span>
            </a>
        </div>

        {{-- Step Indicator --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm px-6 pt-6 pb-4 mb-4">
            <div class="flex items-start">

                {{-- Step 1 --}}
                <div class="flex flex-col items-center flex-1 cursor-pointer" @click="step >= 1 && (step = 1)">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-200"
                        :class="step > 1
                                    ? 'bg-[var(--flora-teal)] text-white ring-4 ring-[var(--flora-teal)]/20'
                                    : step === 1
                                        ? 'bg-[var(--flora-teal)] text-white ring-4 ring-[var(--flora-teal)]/20'
                                        : 'bg-gray-100 text-gray-400 border border-gray-200'">
                        <span x-show="step <= 1">1</span>
                        <span x-show="step > 1"><i class="fa-solid fa-check text-xs"></i></span>
                    </div>
                    <span class="text-xs mt-1.5 font-medium text-center transition-colors"
                        :class="step === 1 ? 'text-[var(--flora-moss)]' : step > 1 ? 'text-[var(--flora-teal)]' : 'text-gray-400'">
                        Data Penerimaan
                    </span>
                </div>

                {{-- Connector 1-2 --}}
                <div class="flex-1 flex items-start pt-4">
                    <div class="h-0.5 flex-1 rounded-full transition-all duration-500"
                        :class="step > 1 ? 'bg-[var(--flora-teal)]' : 'bg-gray-200'"></div>
                </div>

                {{-- Step 2 --}}
                <div class="flex flex-col items-center flex-1 cursor-pointer" @click="step > 1 && (step = 2)">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-200"
                        :class="step > 2
                                    ? 'bg-[var(--flora-teal)] text-white ring-4 ring-[var(--flora-teal)]/20'
                                    : step === 2
                                        ? 'bg-[var(--flora-teal)] text-white ring-4 ring-[var(--flora-teal)]/20'
                                        : 'bg-gray-100 text-gray-400 border border-gray-200'">
                        <span x-show="step <= 2">2</span>
                        <span x-show="step > 2"><i class="fa-solid fa-check text-xs"></i></span>
                    </div>
                    <span class="text-xs mt-1.5 font-medium text-center transition-colors"
                        :class="step === 2 ? 'text-[var(--flora-moss)]' : step > 2 ? 'text-[var(--flora-teal)]' : 'text-gray-400'">
                        Tim Penerimaan
                    </span>
                </div>

                {{-- Connector 2-3 --}}
                <div class="flex-1 flex items-start pt-4">
                    <div class="h-0.5 flex-1 rounded-full transition-all duration-500"
                        :class="step > 2 ? 'bg-[var(--flora-teal)]' : 'bg-gray-200'"></div>
                </div>

                {{-- Step 3 --}}
                <div class="flex flex-col items-center flex-1">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-200"
                        :class="step === 3
                                    ? 'bg-[var(--flora-teal)] text-white ring-4 ring-[var(--flora-teal)]/20'
                                    : 'bg-gray-100 text-gray-400 border border-gray-200'">
                        3
                    </div>
                    <span class="text-xs mt-1.5 font-medium text-center transition-colors"
                        :class="step === 3 ? 'text-[var(--flora-moss)]' : 'text-gray-400'">
                        Data Tanaman
                    </span>
                </div>

            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

            <form action="{{ route('penerimaan.store') }}" method="POST" enctype="multipart/form-data" x-ref="form">
                @csrf

                <div class="p-6">

                    {{-- ===================== STEP 1: DATA PENERIMAAN ===================== --}}
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-5">Data Penerimaan</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Tanggal Eksplorasi</label>
                                <input type="date" name="tanggal_explorasi" x-model="form.tanggal_explorasi"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Tanggal Penerimaan</label>
                                <input type="date" name="tanggal_penerimaan" x-model="form.tanggal_penerimaan"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Jenis Form</label>
                                <select name="jenis_form" x-model="form.jenis_form"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors bg-white">
                                    <option value="">Pilih jenis form</option>
                                    <option value="eksplorasi">Eksplorasi</option>
                                    <option value="introduksi">Introduksi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Tempat Asal</label>
                                <input type="text" name="tempat_asal" x-model="form.tempat_asal"
                                    placeholder="Masukkan tempat asal"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Negara</label>
                                <input type="text" name="country" x-model="form.country" placeholder="Negara asal"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Source</label>
                                <input type="text" name="source" x-model="form.source" placeholder="Sumber"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1.5">Nama Native</label>
                                <input type="text" name="native" x-model="form.native" placeholder="Nama native tanaman"
                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                            </div>
                        </div>

                        {{-- ---- Dokumen Legalitas (Dinamis) ---- --}}
                        <div class="border-t border-gray-100 pt-6">
                            <div class="flex items-center justify-between mb-5">
                                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Dokumen Legalitas
                                </p>
                                <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full"
                                    x-text="dokumenList.length + ' dokumen'"></span>
                            </div>

                            <div class="space-y-3 mb-3">
                                <template x-for="(doc, index) in dokumenList" :key="doc._id">
                                    <div class="rounded-xl border transition-all duration-200"
                                        :class="doc.fileSurat ? 'border-[var(--flora-teal)]/30 bg-[var(--flora-teal)]/5' : 'border-gray-200 bg-gray-50/30'">

                                        {{-- Row atas: icon + fields + hapus --}}
                                        <div class="flex items-start gap-3 p-3.5">

                                            {{-- Status icon --}}
                                            <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 transition-colors"
                                                :class="doc.fileSurat ? 'bg-[var(--flora-teal)]/15' : 'bg-white border border-gray-200'">
                                                <i x-show="!doc.fileSurat"
                                                    class="fa-regular fa-file-lines text-gray-400 text-sm"></i>
                                                <i x-show="doc.fileSurat"
                                                    class="fa-solid fa-check text-[var(--flora-teal)] text-sm"></i>
                                            </div>

                                            {{-- Inputs --}}
                                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-2.5">
                                                <div>
                                                    <label
                                                        class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wide mb-1">Nama
                                                        Surat <span class="text-red-400">*</span></label>
                                                    <input type="text" :name="`dokumen[${index}][namaSurat]`"
                                                        x-model="doc.namaSurat" placeholder="Contoh: Surat Jalan"
                                                        class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors bg-white">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wide mb-1">Nomor
                                                        Surat</label>
                                                    <input type="text" :name="`dokumen[${index}][nomorSurat]`"
                                                        x-model="doc.nomorSurat" placeholder="Contoh: 001/SK/IV/2026"
                                                        class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors bg-white">
                                                </div>
                                            </div>

                                            {{-- Hapus --}}
                                            <button type="button" x-show="dokumenList.length > 1"
                                                @click="hapusDokumen(index)"
                                                class="mt-0.5 w-8 h-8 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors flex-shrink-0">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </div>

                                        {{-- Row bawah: upload file --}}
                                        <div class="px-3.5 pb-3.5 pl-[3.25rem]">
                                            <div x-show="!doc.fileSurat" class="flex items-center gap-2">
                                                <button type="button" @click="triggerDokumenUpload(doc._id)"
                                                    class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium border border-[var(--flora-teal)] text-[var(--flora-teal)] rounded-lg hover:bg-[var(--flora-teal)]/5 transition-colors">
                                                    <i class="fa-solid fa-paperclip text-xs"></i>
                                                    Lampirkan File
                                                </button>
                                                <span class="text-xs text-gray-400">PDF / JPG / PNG, maks. 5MB</span>
                                            </div>
                                            <div x-show="doc.fileSurat" class="flex items-center gap-2">
                                                <div
                                                    class="flex items-center gap-1.5 px-2.5 py-1.5 bg-white border border-gray-200 rounded-lg">
                                                    <i class="fa-regular fa-file-pdf text-[var(--flora-teal)] text-xs"></i>
                                                    <span class="text-xs text-gray-600 max-w-[180px] truncate"
                                                        x-text="doc.fileSurat?.name"></span>
                                                    <span class="text-xs text-gray-400"
                                                        x-text="doc.fileSurat ? formatSize(doc.fileSurat.size) : ''"></span>
                                                </div>
                                                <button type="button" @click="triggerDokumenUpload(doc._id)"
                                                    class="text-xs text-gray-400 hover:text-gray-600 transition-colors">Ganti</button>
                                                <button type="button" @click="hapusFileDokumen(index)"
                                                    class="text-xs text-red-400 hover:text-red-600 transition-colors">Hapus
                                                    file</button>
                                            </div>
                                            <input type="file" :id="'dokumen-file-' + doc._id"
                                                :name="`dokumen[${index}][fileSurat]`" accept=".pdf,.jpg,.jpeg,.png"
                                                class="hidden" @change="handleDokumenFile($event, index)">
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Tambah dokumen --}}
                            <button type="button" @click="addDokumen()"
                                class="w-full py-2.5 border border-dashed border-gray-300 rounded-xl text-[var(--flora-teal)] text-sm font-medium hover:border-[var(--flora-teal)]/50 hover:bg-[var(--flora-teal)]/5 transition-colors flex items-center justify-center gap-2 mb-4">
                                <i class="fa-solid fa-plus text-xs"></i>
                                Tambah Dokumen
                            </button>

                            {{-- Progress --}}
                            <div class="flex items-center gap-3">
                                <div class="flex-1 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-[var(--flora-teal)] rounded-full transition-all duration-500"
                                        :style="'width: ' + progressDokumen + '%'"></div>
                                </div>
                                <span class="text-xs text-gray-400 flex-shrink-0"
                                    x-text="dokumenTerlampir + ' / ' + dokumenList.length + ' terlampir'"></span>
                            </div>
                            <p x-show="!semuaDokumenValid" class="text-xs text-amber-600 mt-2 flex items-center gap-1.5">
                                <i class="fa-solid fa-circle-info"></i>
                                Nama surat dan file wajib diisi untuk setiap dokumen
                            </p>
                        </div>
                    </div>

                    {{-- ===================== STEP 2: TIM PENERIMAAN ===================== --}}
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-5">Tim Penerimaan</p>

                        <div class="space-y-3 mb-4">
                            <template x-for="(tim, index) in timList" :key="index">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4 bg-gray-50/70 border border-gray-100 rounded-xl relative">
                                    <div class="absolute top-3 right-3 flex items-center gap-1">
                                        <span
                                            class="text-[10px] font-semibold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full"
                                            x-text="'#' + (index + 1)"></span>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Anggota Tim</label>
                                        <select :name="`tim[${index}][user_id]`" x-model="tim.user_id"
                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors bg-white">
                                            <option value="">Pilih anggota</option>
                                            @foreach ($collector as $c)
                                                <option value="{{ $c->id }}">{{ $c->full_name }} –
                                                    {{ $c->initial_collector_initial }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Role</label>
                                        <div class="flex gap-2">
                                            <select :name="`tim[${index}][role]`" x-model="tim.role"
                                                class="flex-1 border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors bg-white">
                                                <option value="Ketua">Ketua</option>
                                                <option value="Anggota Explorasi">Anggota Explorasi</option>
                                            </select>
                                            <button type="button" @click="removeTim(index)" x-show="timList.length > 1"
                                                class="px-3 py-2 bg-red-50 text-red-400 border border-red-100 rounded-xl hover:bg-red-100 hover:text-red-600 transition-colors text-sm">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <button type="button" @click="addTim()"
                            class="w-full py-3 border border-dashed border-gray-300 rounded-xl text-[var(--flora-teal)] text-sm font-medium hover:border-[var(--flora-teal)]/50 hover:bg-[var(--flora-teal)]/5 transition-colors flex items-center justify-center gap-2">
                            <i class="fa-solid fa-plus text-xs"></i>
                            Tambah Anggota Tim
                        </button>
                    </div>

                    {{-- ===================== STEP 3: DATA TANAMAN ===================== --}}
                    <div x-show="step === 3" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0">

                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-5">Data Tanaman</p>

                        {{-- Mode toggle --}}
                        <div class="flex gap-1.5 mb-5 p-1 bg-gray-100 rounded-xl w-fit">
                            <button type="button" @click="switchMode('manual')"
                                class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all duration-200" :class="inputMode === 'manual'
                                            ? 'bg-white text-[var(--flora-moss)] shadow-sm'
                                            : 'text-gray-500 hover:text-gray-700'">
                                <i class="fa-solid fa-pen-to-square mr-1.5 text-xs"></i>Input Manual
                            </button>
                            <button type="button" @click="switchMode('excel')"
                                class="px-4 py-1.5 text-sm font-medium rounded-lg transition-all duration-200" :class="inputMode === 'excel'
                                            ? 'bg-white text-[var(--flora-moss)] shadow-sm'
                                            : 'text-gray-500 hover:text-gray-700'">
                                <i class="fa-solid fa-table mr-1.5 text-xs"></i>Upload Excel
                            </button>
                        </div>

                        {{-- ---- MODE MANUAL ---- --}}
                        <div x-show="inputMode === 'manual'">
                            <div class="space-y-4 mb-4">
                                <template x-for="(tanaman, index) in tanamanList" :key="index">
                                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                                        <div
                                            class="flex justify-between items-center px-4 py-3 bg-gray-50 border-b border-gray-100">
                                            <span class="text-sm font-semibold text-gray-600 flex items-center gap-2">
                                                <span
                                                    class="w-5 h-5 rounded-full bg-[var(--flora-teal)]/15 text-[var(--flora-teal)] text-xs flex items-center justify-center font-bold"
                                                    x-text="index + 1"></span>
                                                Tanaman
                                            </span>
                                            <button type="button" @click="removeTanaman(index)"
                                                x-show="tanamanList.length > 1"
                                                class="text-xs px-3 py-1 bg-red-50 text-red-400 border border-red-100 rounded-lg hover:bg-red-100 hover:text-red-600 transition-colors">
                                                <i class="fa-solid fa-trash-can mr-1"></i>Hapus
                                            </button>
                                        </div>
                                        <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-3">

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Scientific
                                                    Name</label>
                                                <input type="text" :name="`tanaman[${index}][scientific_name]`"
                                                    x-model="tanaman.scientific_name" placeholder="Contoh: Mangifera indica"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm italic focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Nomor
                                                    Akses</label>
                                                <div class="relative">
                                                    <input type="text" :name="`tanaman[${index}][nomor_akses]`"
                                                        x-model="tanaman.nomor_akses" placeholder="Otomatis di-generate..."
                                                        readonly
                                                        class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                                                    <span class="absolute right-3 top-1/2 -translate-y-1/2">
                                                        <template x-if="tanaman.nomor_akses">
                                                            <i
                                                                class="fa-solid fa-check text-[var(--flora-teal)] text-xs"></i>
                                                        </template>
                                                        <template x-if="!tanaman.nomor_akses">
                                                            <span class="text-gray-300 text-xs animate-pulse">•••</span>
                                                        </template>
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-400 mt-0.5">Dibuat otomatis oleh sistem</p>
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Nama
                                                    Lokal</label>
                                                <input type="text" :name="`tanaman[${index}][nama_lokal]`"
                                                    x-model="tanaman.nama_lokal" placeholder="Nama lokal tanaman"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Marga
                                                    (Genus)</label>
                                                <input type="text" :name="`tanaman[${index}][marga]`"
                                                    x-model="tanaman.marga" placeholder="Contoh: Mangifera"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Marga
                                                    Jenis</label>
                                                <input type="text" :name="`tanaman[${index}][marga_jenis]`"
                                                    x-model="tanaman.marga_jenis" placeholder="Marga jenis"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Suku
                                                    (Famili)</label>
                                                <input type="text" :name="`tanaman[${index}][suku]`" x-model="tanaman.suku"
                                                    placeholder="Contoh: Anacardiaceae"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 mb-1.5">Spesies</label>
                                                <input type="text" :name="`tanaman[${index}][spesies]`"
                                                    x-model="tanaman.spesies" placeholder="Nama spesies"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Author
                                                    Name</label>
                                                <input type="text" :name="`tanaman[${index}][author_name]`"
                                                    x-model="tanaman.author_name" placeholder="Contoh: L."
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-500 mb-1.5">Locality</label>
                                                <input type="text" :name="`tanaman[${index}][locality]`"
                                                    x-model="tanaman.locality" placeholder="Lokasi pengambilan"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">Jumlah
                                                    Material</label>
                                                <input type="number" :name="`tanaman[${index}][jumlah_material]`"
                                                    x-model="tanaman.jumlah_material" placeholder="0" min="0"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1.5">VAK No</label>
                                                <input type="text" :name="`tanaman[${index}][vak_no]`"
                                                    x-model="tanaman.vak_no" placeholder="Nomor VAK"
                                                    class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors">
                                            </div>

                                            {{-- Collector --}}
                                            <div class="md:col-span-2 pt-1 border-t border-gray-100 mt-1">
                                                <p
                                                    class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2.5">
                                                    Collector</p>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                                    <div>
                                                        <label class="block text-xs font-medium text-gray-500 mb-1.5">Nama
                                                            Collector</label>
                                                        <select :name="`tanaman[${index}][collector_id]`"
                                                            x-model="tanaman.collector_id"
                                                            @change="onCollectorChange(index)"
                                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition-colors bg-white">
                                                            <option value="">Pilih collector</option>
                                                            @foreach ($collector as $c)
                                                                <option value="{{ $c->id }}"
                                                                    data-initial="{{ $c->initial_collector_initial }}"
                                                                    data-name="{{ $c->full_name }}">
                                                                    {{ $c->full_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-500 mb-1.5">Initial
                                                            Collector</label>
                                                        <input type="text" :name="`tanaman[${index}][collector_initial]`"
                                                            x-model="tanaman.collector_initial"
                                                            placeholder="Otomatis dari pilihan" readonly
                                                            class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </template>
                            </div>

                            <button type="button" @click="addTanaman()"
                                class="w-full py-3 border border-dashed border-gray-300 rounded-xl text-[var(--flora-teal)] text-sm font-medium hover:border-[var(--flora-teal)]/50 hover:bg-[var(--flora-teal)]/5 transition-colors flex items-center justify-center gap-2">
                                <i class="fa-solid fa-plus text-xs"></i>
                                Tambah Tanaman
                            </button>
                        </div>

                        {{-- ---- MODE UPLOAD EXCEL ---- --}}
                        <div x-show="inputMode === 'excel'">

                            {{-- Download template --}}
                            <div
                                class="flex items-center justify-between bg-[var(--flora-teal)]/5 border border-[var(--flora-teal)]/20 rounded-xl px-4 py-3.5 mb-4">
                                <div>
                                    <p class="text-sm font-semibold text-[var(--flora-moss)]">Template Excel</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Unduh template lalu isi data tanaman</p>
                                </div>
                                <a href="{{ route('penerimaan.downloadTemplate') }}"
                                    class="flex items-center gap-2 px-4 py-2 bg-[var(--flora-teal)] text-white text-sm font-medium rounded-xl hover:bg-[var(--flora-moss)] transition-colors">
                                    <i class="fa-solid fa-download text-xs"></i>
                                    Unduh Template
                                </a>
                            </div>

                            {{-- Drop zone --}}
                            <div class="relative border-2 border-dashed rounded-xl p-8 text-center transition-all duration-200 cursor-pointer"
                                :class="excelDragOver
                                            ? 'border-[var(--flora-teal)] bg-[var(--flora-teal)]/5'
                                            : 'border-gray-200 hover:border-gray-300 hover:bg-gray-50/50'"
                                @dragover.prevent="excelDragOver = true" @dragleave.prevent="excelDragOver = false"
                                @drop.prevent="handleExcelDrop($event)">

                                <input type="file" id="excel-upload" accept=".xlsx,.xls,.csv"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    @change="handleExcelFile($event)">

                                <div x-show="!excelFile">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-3">
                                        <i class="fa-solid fa-table text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600">Drag & drop file Excel ke sini</p>
                                    <p class="text-xs text-gray-400 mt-1">atau klik untuk memilih file (.xlsx, .xls, .csv)
                                    </p>
                                </div>

                                <div x-show="excelFile" class="flex items-center justify-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-[var(--flora-teal)]/10 flex items-center justify-center">
                                        <i class="fa-solid fa-file-excel text-[var(--flora-teal)] text-lg"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-sm font-medium text-gray-700" x-text="excelFile?.name"></p>
                                        <p class="text-xs text-gray-400"
                                            x-text="excelFile ? (excelFile.size / 1024).toFixed(1) + ' KB' : ''"></p>
                                    </div>
                                    <button type="button" @click.stop="clearExcel()"
                                        class="ml-2 w-7 h-7 flex items-center justify-center text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <i class="fa-solid fa-xmark text-sm"></i>
                                    </button>
                                </div>
                            </div>

                            {{-- Preview tabel --}}
                            <div x-show="excelPreview.length > 0" class="mt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                                        Preview — <span x-text="excelPreview.length"></span> baris
                                    </p>
                                    <button type="button" @click="clearExcel()"
                                        class="text-xs text-red-400 hover:text-red-600 hover:underline transition-colors">Hapus</button>
                                </div>
                                <div class="overflow-x-auto border border-gray-200 rounded-xl">
                                    <table class="w-full text-xs">
                                        <thead class="bg-gray-50 border-b border-gray-200">
                                            <tr>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    Scientific Name</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    No. Akses</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    Nama Lokal</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    Marga</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    Spesies</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    Jumlah</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    VAK No</th>
                                                <th
                                                    class="px-3 py-2.5 text-left text-gray-500 font-semibold whitespace-nowrap">
                                                    Collector Name
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, i) in excelPreview.slice(0, 10)" :key="i">
                                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                                    <td class="px-3 py-2 italic text-gray-700"
                                                        x-text="row.scientific_name || '–'"></td>
                                                    <td class="px-3 py-2 text-gray-700 font-mono text-[10px]"
                                                        x-text="row.nomor_akses || '–'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.nama_lokal || '–'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.marga || '–'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.spesies || '–'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.jumlah_material || '–'">
                                                    </td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.vak_no || '–'"></td>
                                                    <td class="px-3 py-2 text-gray-700"
                                                        x-text="row.collector_initial || '–'"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                                <p x-show="excelPreview.length > 10" class="text-xs text-gray-400 mt-1.5 text-right"
                                    x-text="`...dan ${excelPreview.length - 10} baris lainnya`"></p>
                                <input type="hidden" name="tanaman_excel_json" :value="JSON.stringify(excelPreview)">
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Navigation Footer --}}
                <div class="border-t border-gray-100 px-6 py-4 flex justify-between items-center bg-gray-50/50">

                    <button type="button" x-show="step > 1" @click="step--"
                        class="flex items-center gap-2 px-5 py-2.5 text-sm font-medium border border-gray-200 text-gray-600 rounded-xl hover:bg-white hover:shadow-sm transition-all">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Sebelumnya
                    </button>
                    <div x-show="step === 1"></div>

                    <button type="button" x-show="step === 1" @click="semuaDokumenValid ? step++ : null"
                        class="flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-xl transition-all" :class="semuaDokumenValid
                                    ? 'bg-[var(--flora-teal)] text-white hover:bg-[var(--flora-moss)] shadow-sm'
                                    : 'bg-gray-100 text-gray-400 cursor-not-allowed'">
                        Selanjutnya
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>

                    <button type="button" x-show="step === 2" @click="step++"
                        class="flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-[var(--flora-teal)] text-white rounded-xl hover:bg-[var(--flora-moss)] shadow-sm transition-all">
                        Selanjutnya
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>

                    <button type="submit" x-show="step === 3"
                        class="flex items-center gap-2 px-5 py-2.5 text-sm font-semibold bg-[var(--flora-teal)] text-white rounded-xl hover:bg-[var(--flora-moss)] shadow-sm transition-all">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        Simpan Penerimaan
                    </button>

                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('penerimaanForm', () => ({

                    step: 1,
                    inputMode: 'manual',
                    excelFile: null,
                    excelPreview: [],
                    excelDragOver: false,
                    nomorAksesPrefix: '',
                    nomorAksesCounter: 0,
                    _dokumenIdCounter: 0,

                    // Dokumen legalitas — dinamis
                    dokumenList: [],

                    get dokumenTerlampir() { return this.dokumenList.filter(d => d.fileSurat).length },
                    get progressDokumen() { return this.dokumenList.length === 0 ? 0 : Math.round((this.dokumenTerlampir / this.dokumenList.length) * 100) },
                    get semuaDokumenValid() {
                        return this.dokumenList.length > 0 &&
                            this.dokumenList.every(d => d.namaSurat.trim() !== '' && d.fileSurat !== null);
                    },

                    _newDokumen() {
                        return { _id: ++this._dokumenIdCounter, namaSurat: '', nomorSurat: '', fileSurat: null };
                    },

                    addDokumen() {
                        this.dokumenList.push(this._newDokumen());
                    },

                    hapusDokumen(index) {
                        if (this.dokumenList.length <= 1) return;
                        this.dokumenList.splice(index, 1);
                    },

                    triggerDokumenUpload(id) {
                        document.getElementById('dokumen-file-' + id).click();
                    },

                    handleDokumenFile(event, index) {
                        const file = event.target.files[0];
                        if (!file) return;
                        if (file.size > 5 * 1024 * 1024) {
                            alert('Ukuran file maksimal 5MB.');
                            event.target.value = '';
                            return;
                        }
                        this.dokumenList[index].fileSurat = file;
                    },

                    hapusFileDokumen(index) {
                        const id = this.dokumenList[index]._id;
                        this.dokumenList[index].fileSurat = null;
                        const el = document.getElementById('dokumen-file-' + id);
                        if (el) el.value = '';
                    },

                    formatSize(bytes) {
                        if (bytes < 1024) return bytes + ' B';
                        if (bytes < 1024 * 1024) return Math.round(bytes / 1024) + ' KB';
                        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
                    },

                    // Form data
                    form: {
                        tanggal_explorasi: '',
                        tanggal_penerimaan: '',
                        jenis_form: '',
                        tempat_asal: '',
                        country: '',
                        source: '',
                        native: '',
                    },

                    timList: [{ user_id: '', role: 'Anggota Explorasi' }],

                    tanamanList: [{
                        scientific_name: '', nomor_akses: '', nama_lokal: '',
                        marga: '', marga_jenis: '', suku: '', spesies: '',
                        author_name: '', locality: '', jumlah_material: '', vak_no: '',
                        collector_id: '', collector_initial: ''
                    }],

                    // Ganti mode dan reset nomor akses
                    async switchMode(mode) {
                        if (this.inputMode === mode) return;

                        this.inputMode = mode;
                        console.log(this.nomorAksesPrefix + String(this.nomorAksesCounter).padStart(4, '0'))
                        // biar UI langsung update dulu
                        this.$nextTick(async () => {

                            if (mode === 'manual') {
                                this.excelFile = null;
                                this.excelPreview = [];

                                const el = document.getElementById('excel-upload');
                                if (el) el.value = '';

                                await this.resetNomorAkses();

                                this.tanamanList = [{
                                    scientific_name: '',
                                    nomor_akses: this.nomorAksesPrefix + String(this.nomorAksesCounter).padStart(4, '0'),
                                    nama_lokal: '',
                                    marga: '',
                                    marga_jenis: '',
                                    suku: '',
                                    spesies: '',
                                    author_name: '',
                                    locality: '',
                                    jumlah_material: '',
                                    vak_no: '',
                                    collector_id: '',
                                    collector_initial: ''
                                }];
                            }

                            if (mode === 'excel') {
                                // 🔥 INI YANG KAMU MAU
                                this.resetNomorAkses();
                            }
                        });
                    },

                    onCollectorChange(index) {
                        const select = document.querySelector(`select[name="tanaman[${index}][collector_id]"]`);
                        if (!select) return;
                        const selected = select.options[select.selectedIndex];
                        this.tanamanList[index].collector_initial = selected ? (selected.dataset.initial || '') : '';
                    },

                    async init() {
                        // Seed dokumen pertama
                        this.dokumenList.push(this._newDokumen());

                        try {
                            const res = await fetch('{{ route('penerimaan.getNomorAkses') }}', {
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                }
                            });
                            const data = await res.json();
                            const nomor = data.nomor_akses ?? 'BB2026040001';
                            this.nomorAksesPrefix = nomor.slice(0, -4);
                            this.nomorAksesCounter = parseInt(nomor.slice(-4));
                            this.tanamanList[0].nomor_akses = nomor;
                            console.log(data.nomor_akses)
                        } catch (e) {
                            console.error('Gagal fetch nomor akses', e);
                        }
                    },

                    async resetNomorAkses() {
                        try {
                            const res = await fetch('{{ route('penerimaan.getNomorAkses') }}', {
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                }
                            });
                            const data = await res.json();
                            const nomor = data.nomor_akses ?? 'BB2026040001';
                            this.nomorAksesPrefix = nomor.slice(0, -4);
                            this.nomorAksesCounter = parseInt(nomor.slice(-4));
                            console.log(`Nomor Akses Reset ${data.nomor_akses}`)
                        } catch (e) {
                            console.error('Gagal reset nomor akses', e);
                        }
                    },

                    generateNomorAkses() {
                        this.nomorAksesCounter++;
                        return this.nomorAksesPrefix + String(this.nomorAksesCounter).padStart(4, '0');
                    },

                    addTim() {
                        this.timList.push({ user_id: '', role: 'Anggota Explorasi' });
                    },

                    removeTim(index) {
                        if (this.timList.length > 1) this.timList.splice(index, 1);
                    },

                    addTanaman() {
                        const nomor = this.generateNomorAkses();
                        this.tanamanList.push({
                            scientific_name: '', nomor_akses: nomor, nama_lokal: '',
                            marga: '', marga_jenis: '', suku: '', spesies: '',
                            author_name: '', locality: '', jumlah_material: '', vak_no: '',
                            collector_id: '', collector_initial: ''
                        });
                    },

                    removeTanaman(index) {
                        if (this.tanamanList.length > 1) {
                            this.tanamanList.splice(index, 1);
                            const baseCounter = this.nomorAksesCounter - this.tanamanList.length;
                            this.tanamanList.forEach((t, i) => {
                                t.nomor_akses = this.nomorAksesPrefix + String(baseCounter + i + 1).padStart(4, '0');
                            });
                            this.nomorAksesCounter--;
                        }
                    },

                    handleExcelDrop(e) {
                        this.excelDragOver = false;
                        const file = e.dataTransfer.files[0];
                        if (file) this.parseExcel(file);
                    },

                    handleExcelFile(e) {
                        const file = e.target.files[0];
                        if (file) this.parseExcel(file);
                    },

                    parseExcel(file) {
                        this.excelFile = file;
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const data = new Uint8Array(e.target.result);
                            const workbook = XLSX.read(data, { type: 'array' });
                            const sheet = workbook.Sheets[workbook.SheetNames[0]];
                            const rows = XLSX.utils.sheet_to_json(sheet, { defval: '' });

                            this.excelPreview = rows.map(row => {
                                const n = {};
                                Object.keys(row).forEach(k => { n[k.toLowerCase().trim()] = row[k]; });
                                return {
                                    scientific_name: n['scientific name'] || n['scientific_name'] || '',
                                    nomor_akses: this.generateNomorAkses(),
                                    nama_lokal: n['nama lokal'] || n['nama_lokal'] || '',
                                    marga: n['marga'] || '',
                                    marga_jenis: n['marga jenis'] || n['marga_jenis'] || '',
                                    suku: n['suku'] || '',
                                    spesies: n['spesies'] || '',
                                    author_name: n['author name'] || n['author_name'] || '',
                                    locality: n['locality'] || '',
                                    jumlah_material: n['jumlah material'] || n['jumlah_material'] || '',
                                    vak_no: n['vak no'] || n['vak_no'] || '',
                                    collector_initial: n['collector_initial'] || n['collector_initial'] || '',
                                };
                            });
                        };
                        reader.readAsArrayBuffer(file);
                    },

                    clearExcel() {
                        this.excelFile = null;
                        this.excelPreview = [];
                        this.resetNomorAkses();
                        document.getElementById('excel-upload').value = '';
                    },

                }));
            });
        </script>
    @endpush
@endsection
