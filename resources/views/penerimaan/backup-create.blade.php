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
    <div class="mx-auto px-4 py-8" x-data="penerimaanForm">

        <div class="bg-white rounded-lg shadow-md overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-flora-teal to-flora-moss px-6 py-4 flex justify-between items-center">
                <h4 class="text-xl font-semibold text-white">Penerimaan</h4>
                <span class="text-flora-teal-light text-sm" x-text="`Langkah ${step} dari 3`"></span>
            </div>

            {{-- Step Indicator --}}
            <div class="px-6 pt-6 pb-2">
                <div class="flex items-start">
                    {{-- Step 1 --}}
                    <div class="flex flex-col items-center flex-1 cursor-pointer" @click="step >= 1 && (step = 1)">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-all duration-200"
                            :class="step > 1 ? 'bg-flora-teal text-white' : step === 1 ? 'bg-flora-teal text-white' : 'bg-gray-100 text-gray-400 border border-gray-300'">
                            <span x-show="step <= 1">1</span>
                            <span x-show="step > 1">✓</span>
                        </div>
                        <span class="text-xs mt-1 text-center"
                            :class="step === 1 ? 'text-flora-moss font-medium' : step > 1 ? 'text-flora-teal' : 'text-gray-400'">
                            Data Penerimaan
                        </span>
                    </div>

                    {{-- Connector 1-2 --}}
                    <div class="flex-1 flex items-start pt-4">
                        <div class="h-0.5 flex-1 transition-all duration-300"
                            :class="step > 1 ? 'bg-flora-teal' : 'bg-gray-200'"></div>
                    </div>

                    {{-- Step 2 --}}
                    <div class="flex flex-col items-center flex-1 cursor-pointer" @click="step > 1 && (step = 2)">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-all duration-200"
                            :class="step > 2 ? 'bg-flora-teal text-white' : step === 2 ? 'bg-flora-teal text-white' : 'bg-gray-100 text-gray-400 border border-gray-300'">
                            <span x-show="step <= 2">2</span>
                            <span x-show="step > 2">✓</span>
                        </div>
                        <span class="text-xs mt-1 text-center"
                            :class="step === 2 ? 'text-flora-moss font-medium' : step > 2 ? 'text-flora-teal' : 'text-gray-400'">
                            Tim Penerimaan
                        </span>
                    </div>

                    {{-- Connector 2-3 --}}
                    <div class="flex-1 flex items-start pt-4">
                        <div class="h-0.5 flex-1 transition-all duration-300"
                            :class="step > 2 ? 'bg-flora-teal' : 'bg-gray-200'"></div>
                    </div>

                    {{-- Step 3 --}}
                    <div class="flex flex-col items-center flex-1">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium transition-all duration-200"
                            :class="step === 3 ? 'bg-flora-teal text-white' : 'bg-gray-100 text-gray-400 border border-gray-300'">
                            3
                        </div>
                        <span class="text-xs mt-1 text-center"
                            :class="step === 3 ? 'text-flora-moss font-medium' : 'text-gray-400'">
                            Data Tanaman
                        </span>
                    </div>
                </div>
            </div>

            <form action="{{ route('penerimaan.store') }}" method="POST" x-ref="form">
                @csrf
                <div class="p-6">

                    {{-- ===================== STEP 1: DATA PENERIMAAN ===================== --}}
                    <div x-show="step === 1" x-transition>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Data Penerimaan</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Tanggal Eksplorasi</label>
                                <input type="date" name="tanggal_explorasi" x-model="form.tanggal_explorasi"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Tanggal Penerimaan</label>
                                <input type="date" name="tanggal_penerimaan" x-model="form.tanggal_penerimaan"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Jenis Form</label>
                                <select name="jenis_form" x-model="form.jenis_form"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                    <option value="">Pilih jenis form</option>
                                    <option value="eksplorasi">Eksplorasi</option>
                                    <option value="introduksi">Introduksi</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Tempat Asal</label>
                                <input type="text" name="tempat_asal" x-model="form.tempat_asal"
                                    placeholder="Masukkan tempat asal"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Negara</label>
                                <input type="text" name="country" x-model="form.country" placeholder="Negara asal"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Source</label>
                                <input type="text" name="source" x-model="form.source" placeholder="Sumber"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm text-gray-600 mb-1">Nama Native</label>
                                <input type="text" name="native" x-model="form.native" placeholder="Nama native tanaman"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                            </div>
                        </div>
                    </div>

                    {{-- ===================== STEP 2: TIM PENERIMAAN ===================== --}}
                    <div x-show="step === 2" x-transition>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Tim Penerimaan</p>

                        <template x-for="(tim, index) in timList" :key="index">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4 bg-gray-50 rounded-lg mb-3 relative">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Anggota Tim</label>
                                    <select :name="`tim[${index}][user_id]`" x-model="tim.user_id"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        <option value="">Pilih user</option>
                                        @foreach($collector as $c)
                                            <option value="{{ $c->id }}">{{ $c->full_name }} - {{ $c->initial_collector_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Role</label>
                                    <div class="flex gap-2">
                                        <select :name="`tim[${index}][role]`" x-model="tim.role"
                                            class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                            <option value="Ketua">Ketua</option>
                                            <option value="Anggota Explorasi">Anggota Explorasi</option>
                                        </select>
                                        <button type="button" @click="removeTim(index)"
                                            class="px-3 py-2 bg-red-50 text-red-500 border border-red-200 rounded-lg hover:bg-red-100 text-sm">
                                            ✕
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <button type="button" @click="addTim()"
                            class="w-full py-2.5 border border-dashed border-gray-300 rounded-lg text-flora-teal text-sm hover:border-flora-teal-light hover:bg-flora-teal-pale transition-colors">
                            + Tambah Anggota Tim
                        </button>
                    </div>

                    {{-- ===================== STEP 3: DATA TANAMAN ===================== --}}
                    <div x-show="step === 3" x-transition>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-4">Data Tanaman</p>

                        {{-- Tab: Manual / Upload Excel --}}
                        <div class="flex gap-2 mb-5">
                            <button type="button" @click="inputMode = 'manual'" :class="inputMode === 'manual'
                                            ? 'bg-flora-teal text-white border-flora-teal'
                                            : 'bg-white text-gray-500 border-gray-300 hover:bg-gray-50'"
                                class="px-4 py-1.5 text-sm border rounded-lg transition-colors">
                                Input Manual
                            </button>
                            <button type="button" @click="inputMode = 'excel'" :class="inputMode === 'excel'
                                            ? 'bg-flora-teal text-white border-flora-teal'
                                            : 'bg-white text-gray-500 border-gray-300 hover:bg-gray-50'"
                                class="px-4 py-1.5 text-sm border rounded-lg transition-colors">
                                Upload Excel
                            </button>
                        </div>

                        {{-- ---- MODE MANUAL ---- --}}
                        <div x-show="inputMode === 'manual'">
                            <template x-for="(tanaman, index) in tanamanList" :key="index">
                                <div class="border border-gray-200 rounded-lg mb-4 overflow-hidden">
                                    {{-- Card header --}}
                                    <div
                                        class="flex justify-between items-center px-4 py-2.5 bg-gray-50 border-b border-gray-200">
                                        <span class="text-sm font-medium text-gray-600"
                                            x-text="`Tanaman #${index + 1}`"></span>
                                        <button type="button" @click="removeTanaman(index)" x-show="tanamanList.length > 1"
                                            class="text-xs px-3 py-1 bg-red-50 text-red-500 border border-red-200 rounded-lg hover:bg-red-100">
                                            Hapus
                                        </button>
                                    </div>

                                    {{-- Card body --}}
                                    <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-3">

                                        {{-- Scientific Name --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Scientific Name</label>
                                            <input type="text" :name="`tanaman[${index}][scientific_name]`"
                                                x-model="tanaman.scientific_name" placeholder="Contoh: Mangifera indica"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light italic">
                                        </div>

                                        {{-- Nomor Akses --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Nomor Akses</label>
                                            <div class="relative">
                                                <input type="text" :name="`tanaman[${index}][nomor_akses]`"
                                                    x-model="tanaman.nomor_akses" placeholder="Otomatis di-generate..."
                                                    readonly
                                                    class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm bg-gray-50 text-gray-500 cursor-not-allowed focus:outline-none">
                                                <span class="absolute right-2 top-2 text-xs">
                                                    <template x-if="tanaman.nomor_akses">
                                                        <span class="text-green-500">✓</span>
                                                    </template>
                                                    <template x-if="!tanaman.nomor_akses">
                                                        <span class="text-gray-400 animate-pulse">...</span>
                                                    </template>
                                                </span>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-0.5">Dibuat otomatis oleh sistem</p>
                                        </div>

                                        {{-- Nama Lokal --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Nama Lokal</label>
                                            <input type="text" :name="`tanaman[${index}][nama_lokal]`"
                                                x-model="tanaman.nama_lokal" placeholder="Nama lokal tanaman"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Marga --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Marga (Genus)</label>
                                            <input type="text" :name="`tanaman[${index}][marga]`" x-model="tanaman.marga"
                                                placeholder="Contoh: Mangifera"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Marga Jenis --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Marga Jenis</label>
                                            <input type="text" :name="`tanaman[${index}][marga_jenis]`"
                                                x-model="tanaman.marga_jenis" placeholder="Marga jenis"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Suku --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Suku (Famili)</label>
                                            <input type="text" :name="`tanaman[${index}][suku]`" x-model="tanaman.suku"
                                                placeholder="Contoh: Anacardiaceae"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Spesies --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Spesies</label>
                                            <input type="text" :name="`tanaman[${index}][spesies]`"
                                                x-model="tanaman.spesies" placeholder="Nama spesies"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Author Name --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Author Name</label>
                                            <input type="text" :name="`tanaman[${index}][author_name]`"
                                                x-model="tanaman.author_name" placeholder="Contoh: L."
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Locality --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Locality</label>
                                            <input type="text" :name="`tanaman[${index}][locality]`"
                                                x-model="tanaman.locality" placeholder="Lokasi pengambilan"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- Jumlah Material --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">Jumlah Material</label>
                                            <input type="number" :name="`tanaman[${index}][jumlah_material]`"
                                                x-model="tanaman.jumlah_material" placeholder="0" min="0"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                        {{-- VAK No --}}
                                        <div>
                                            <label class="block text-xs text-gray-500 mb-1">VAK No</label>
                                            <input type="text" :name="`tanaman[${index}][vak_no]`" x-model="tanaman.vak_no"
                                                placeholder="Nomor VAK"
                                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-flora-teal-light">
                                        </div>

                                    </div>
                                </div>
                            </template>

                            <button type="button" @click="addTanaman()"
                                class="w-full py-2.5 border border-dashed border-gray-300 rounded-lg text-flora-teal text-sm hover:border-flora-teal-light hover:bg-flora-teal-pale transition-colors">
                                + Tambah Tanaman
                            </button>
                        </div>

                        {{-- ---- MODE UPLOAD EXCEL ---- --}}
                        <div x-show="inputMode === 'excel'">

                            {{-- Download template --}}
                            <div
                                class="flex items-center justify-between bg-flora-teal-pale border border-flora-teal-light/40 rounded-lg px-4 py-3 mb-4">
                                <div>
                                    <p class="text-sm font-medium text-flora-moss">Template Excel</p>
                                    <p class="text-xs text-flora-teal">Unduh template lalu isi data tanaman</p>
                                </div>
                                <a href="{{ route('penerimaan.downloadTemplate') }}"
                                    class="px-4 py-2 bg-flora-teal text-white text-sm rounded-lg hover:bg-flora-moss transition-colors">
                                    ↓ Unduh Template
                                </a>
                            </div>

                            {{-- Upload area --}}
                            <div class="relative border-2 border-dashed rounded-lg p-8 text-center transition-colors"
                                :class="excelDragOver ? 'border-flora-teal-light bg-flora-teal-pale' : 'border-gray-300 hover:border-gray-400'"
                                @dragover.prevent="excelDragOver = true" @dragleave.prevent="excelDragOver = false"
                                @drop.prevent="handleExcelDrop($event)">

                                <input type="file" id="excel-upload" accept=".xlsx,.xls,.csv"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                    @change="handleExcelFile($event)">

                                <div x-show="!excelFile">
                                    <div class="text-4xl mb-2">📊</div>
                                    <p class="text-sm font-medium text-gray-600">Drag & drop file Excel ke sini</p>
                                    <p class="text-xs text-gray-400 mt-1">atau klik untuk memilih file (.xlsx, .xls, .csv)
                                    </p>
                                </div>

                                <div x-show="excelFile" class="flex items-center justify-center gap-3">
                                    <span class="text-2xl">📄</span>
                                    <div class="text-left">
                                        <p class="text-sm font-medium text-gray-700" x-text="excelFile?.name"></p>
                                        <p class="text-xs text-gray-400"
                                            x-text="excelFile ? `${(excelFile.size / 1024).toFixed(1)} KB` : ''"></p>
                                    </div>
                                    <button type="button" @click.stop="clearExcel()"
                                        class="ml-2 text-red-400 hover:text-red-600 text-lg">✕</button>
                                </div>
                            </div>

                            {{-- Preview tabel hasil parse --}}
                            <div x-show="excelPreview.length > 0" class="mt-4">
                                <div class="flex justify-between items-center mb-2">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                        Preview — <span x-text="excelPreview.length"></span> baris ditemukan
                                    </p>
                                    <button type="button" @click="clearExcel()"
                                        class="text-xs text-red-500 hover:underline">Hapus</button>
                                </div>
                                <div class="overflow-x-auto border border-gray-200 rounded-lg">
                                    <table class="w-full text-xs">
                                        <thead class="bg-gray-50 border-b border-gray-200">
                                            <tr>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    Scientific Name</th>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    No. Akses</th>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    Nama Lokal</th>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    Marga</th>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    Spesies</th>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    Jumlah</th>
                                                <th class="px-3 py-2 text-left text-gray-500 font-medium whitespace-nowrap">
                                                    VAK No</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(row, i) in excelPreview.slice(0, 10)" :key="i">
                                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                    <td class="px-3 py-2 italic text-gray-700"
                                                        x-text="row.scientific_name || '-'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.nomor_akses || '-'">
                                                    </td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.nama_lokal || '-'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.marga || '-'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.spesies || '-'"></td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.jumlah_material || '-'">
                                                    </td>
                                                    <td class="px-3 py-2 text-gray-700" x-text="row.vak_no || '-'"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                                <p x-show="excelPreview.length > 10" class="text-xs text-gray-400 mt-1 text-right"
                                    x-text="`...dan ${excelPreview.length - 10} baris lainnya`"></p>

                                {{-- Hidden input kirim data ke server --}}
                                <input type="hidden" name="tanaman_excel_json" :value="JSON.stringify(excelPreview)">
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Navigation Footer --}}
                <div class="border-t border-gray-100 px-6 py-4 flex justify-between items-center">
                    <button type="button" x-show="step > 1" @click="step--"
                        class="px-5 py-2 text-sm border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        ← Sebelumnya
                    </button>
                    <div x-show="step === 1"></div>

                    <button type="button" x-show="step < 3" @click="step++"
                        class="px-5 py-2 text-sm bg-flora-teal text-white rounded-lg hover:bg-flora-moss transition-colors">
                        Selanjutnya →
                    </button>

                    <button type="submit" x-show="step === 3"
                        class="px-5 py-2 text-sm bg-flora-teal text-white rounded-lg hover:bg-flora-moss transition-colors">
                        Simpan Penerimaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('penerimaanForm', () => ({

                    step: 1,
                    inputMode: 'manual',
                    excelFile: null,
                    excelPreview: [],
                    excelDragOver: false,

                    // ← Tambahan untuk counter lokal
                    nomorAksesPrefix: '',
                    nomorAksesCounter: 0,

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
                        author_name: '', locality: '', jumlah_material: '', vak_no: ''
                    }],

                    // Fetch SEKALI saat init, lalu simpan prefix & counter
                    async init() {
                        try {
                            const res = await fetch('{{ route('penerimaan.getNomorAkses') }}', {
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                }
                            });
                            const data = await res.json();
                            const nomor = data.nomor_akses ?? 'BB2026040001';

                            // Pisah prefix (semua kecuali 4 digit terakhir) dan angkanya
                            this.nomorAksesPrefix = nomor.slice(0, -4);
                            this.nomorAksesCounter = parseInt(nomor.slice(-4));

                            // Set tanaman pertama langsung
                            this.tanamanList[0].nomor_akses = nomor;

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

                        } catch (e) {
                            console.error('Gagal reset nomor akses', e);
                        }
                    },

                    // Generate nomor berikutnya secara lokal — tidak perlu fetch lagi
                    generateNomorAkses() {
                        this.nomorAksesCounter++;
                        const padded = String(this.nomorAksesCounter).padStart(4, '0');
                        return this.nomorAksesPrefix + padded;
                    },

                    addTim() {
                        this.timList.push({ user_id: '', role: 'Anggota Explorasi' });
                    },

                    removeTim(index) {
                        if (this.timList.length > 1) this.timList.splice(index, 1);
                    },

                    // Tidak perlu async lagi karena tidak fetch ke server
                    addTanaman() {
                        const nomor = this.generateNomorAkses();
                        this.tanamanList.push({
                            scientific_name: '', nomor_akses: nomor, nama_lokal: '',
                            marga: '', marga_jenis: '', suku: '', spesies: '',
                            author_name: '', locality: '', jumlah_material: '', vak_no: ''
                        });
                    },

                    removeTanaman(index) {
                        if (this.tanamanList.length > 1) {
                            this.tanamanList.splice(index, 1);

                            // Reset counter ke posisi awal, lalu re-assign semua
                            const baseCounter = this.nomorAksesCounter - this.tanamanList.length;
                            this.tanamanList.forEach((tanaman, i) => {
                                const padded = String(baseCounter + i + 1).padStart(4, '0');
                                tanaman.nomor_akses = this.nomorAksesPrefix + padded;
                            });

                            // Mundurkan counter sesuai jumlah tanaman sekarang
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
                                // normalize key (lowercase + trim)

                                const normalized = {};
                                Object.keys(row).forEach(key => {
                                    normalized[key.toLowerCase().trim()] = row[key];
                                });
                                const nomor = this.generateNomorAkses();

                                return {
                                    scientific_name: normalized['scientific name'] || normalized['scientific_name'] || '',
                                    nomor_akses: nomor, // ← INI YANG PENTING
                                    nama_lokal: normalized['nama lokal'] || normalized['nama_lokal'] || '',
                                    marga: normalized['marga'] || '',
                                    marga_jenis: normalized['marga jenis'] || normalized['marga_jenis'] || '',
                                    suku: normalized['suku'] || '',
                                    spesies: normalized['spesies'] || '',
                                    author_name: normalized['author name'] || normalized['author_name'] || '',
                                    locality: normalized['locality'] || '',
                                    jumlah_material: normalized['jumlah material'] || normalized['jumlah_material'] || '',
                                    vak_no: normalized['vak no'] || normalized['vak_no'] || '',
                                };
                            });
                        };

                        reader.readAsArrayBuffer(file);
                    },

                    clearExcel() {
                        this.excelFile = null;
                        this.excelPreview = [];
                        this.resetNomorAkses(); // 🔥 reset lagi
                        document.getElementById('excel-upload').value = '';
                    },

                }));
            });
        </script>
    @endpush
@endsection
