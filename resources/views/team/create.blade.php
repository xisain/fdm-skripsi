@extends('layout.admin')
@section('content')
    <div class="mx-auto px-4 py-6" x-data="timForm">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-xl bg-[var(--flora-teal)]/10 flex items-center justify-center">
                    <i class="fa-solid fa-people-group text-[var(--flora-teal)] text-base"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-[var(--flora-moss)] tracking-tight">Tim Eksplorasi</h1>
                    <p class="text-xs text-[var(--flora-stone)] mt-0.5">Buat Tim Eksplorasi Baru</p>
                </div>
            </div>
            <a href="{{ route('team.index') }}"
                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-gray-600 bg-yellow-300 rounded-xl hover:bg-yellow-400 transition-colors shadow-sm">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-4">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
                    <div>
                        <p class="text-sm font-semibold text-red-700 mb-1">Terdapat kesalahan pada form:</p>
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li class="text-sm text-red-600">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form Card --}}
        <form action="{{ route('team.store') }}" method="POST" @submit.prevent="submitForm" x-ref="form">
            @csrf

            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden">

                {{-- Section: Informasi Tim --}}
                <div class="px-6 pt-6 pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-2 mb-5">
                        <span class="w-1 h-5 rounded-full bg-[var(--flora-teal)] inline-block"></span>
                        <h2 class="text-sm font-bold text-[var(--flora-moss)] uppercase tracking-widest">Informasi Tim</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Nama Tim --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">
                                Nama Tim <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="team_name" x-model="form.team_name"
                                value="{{ old('team_name') }}"
                                placeholder="Contoh: Tim Eksplorasi Gunung Salak"
                                class="w-full border rounded-xl px-4 py-2.5 text-sm transition
                                    focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)]
                                    @error('team_name') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                            @error('team_name')
                                <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Lokasi --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">
                                Lokasi Eksplorasi <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="explore_location" x-model="form.explore_location"
                                value="{{ old('explore_location') }}"
                                placeholder="Contoh: Bogor, Jawa Barat"
                                class="w-full border rounded-xl px-4 py-2.5 text-sm transition
                                    focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)]
                                    @error('explore_location') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                            @error('explore_location')
                                <p class="text-xs text-red-500 mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">
                                Deskripsi Eksplorasi
                            </label>
                            <textarea name="description" x-model="form.description" rows="3"
                                placeholder="Jelaskan tujuan atau deskripsi eksplorasi..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm resize-none transition
                                    focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)]">{{ old('description') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Section: Anggota Tim --}}
                <div class="px-6 pt-6 pb-6">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-2">
                            <span class="w-1 h-5 rounded-full bg-[var(--flora-teal)] inline-block"></span>
                            <h2 class="text-sm font-bold text-[var(--flora-moss)] uppercase tracking-widest">Anggota Tim</h2>
                            <span class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-[var(--flora-teal)]/10 text-[var(--flora-teal)]"
                                x-text="members.length + '/4'"></span>
                        </div>

                        <button type="button" @click="addMember" x-show="members.length < 4"
                            class="flex items-center gap-2 px-3 py-2 text-xs font-semibold text-white bg-[var(--flora-teal)] rounded-xl hover:opacity-90 active:scale-95 transition-all">
                            <i class="fa-solid fa-user-plus text-[10px]"></i>
                            Tambah Anggota
                        </button>
                    </div>

                    {{-- Validation error for members --}}
                    <div x-show="memberError" x-cloak
                        class="mb-4 flex items-center gap-2 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span x-text="memberError"></span>
                    </div>

                    {{-- Member Cards --}}
                    <div class="space-y-3">
                        <template x-for="(member, index) in members" :key="index">
                            <div class="group relative border border-gray-200 rounded-xl bg-white shadow-sm
                                        hover:border-[var(--flora-teal)]/40 hover:shadow-md transition-all duration-200">

                                {{-- Card Header --}}
                                <div class="flex items-center justify-between px-4 py-2.5 border-b border-gray-100 bg-gray-50/50 rounded-t-xl">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-lg bg-[var(--flora-teal)]/10 flex items-center justify-center text-xs font-bold text-[var(--flora-teal)]"
                                            x-text="index + 1"></div>
                                        <span class="text-xs font-semibold text-gray-500">
                                            Anggota #<span x-text="index + 1"></span>
                                        </span>
                                        <span x-show="member.role === 'Ketua'"
                                            class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-amber-100 text-amber-600 uppercase tracking-wider">
                                            <i class="fa-solid fa-crown text-[9px] mr-0.5"></i>Ketua
                                        </span>
                                    </div>
                                    <button type="button" @click="removeMember(index)"
                                        x-show="members.length > 1"
                                        class="flex items-center gap-1.5 px-2.5 py-1.5 text-[11px] font-semibold text-red-500
                                               bg-red-50 rounded-lg hover:bg-red-100 opacity-0 group-hover:opacity-100 transition-all">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                        Hapus
                                    </button>
                                </div>

                                {{-- Card Body --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">

                                    {{-- User Select --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">
                                            Pengguna <span class="text-red-400">*</span>
                                        </label>
                                        <div class="relative">
                                            <select :name="'members['+index+'][user_id]'"
                                                x-model="member.user_id"
                                                @change="checkDuplicateUsers"
                                                class="w-full appearance-none border border-gray-200 rounded-xl pl-4 pr-9 py-2.5 text-sm
                                                       focus:outline-none focus:ring-2 focus:ring-[var(--flora-teal)]/30 focus:border-[var(--flora-teal)] transition
                                                       bg-white cursor-pointer">
                                                <option value="">-- Pilih Pengguna --</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                                                <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                                            </div>
                                        </div>
                                        {{-- Duplicate warning --}}
                                        <p x-show="isDuplicate(index)"
                                           class="text-[11px] text-amber-600 mt-1 flex items-center gap-1">
                                            <i class="fa-solid fa-triangle-exclamation text-[10px]"></i>
                                            Pengguna ini sudah dipilih di slot lain
                                        </p>
                                    </div>

                                    {{-- Role Select --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1.5 uppercase tracking-wider">
                                            Peran <span class="text-red-400">*</span>
                                        </label>
                                        <div class="flex gap-2">
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" :name="'members['+index+'][role]'"
                                                    value="Ketua" x-model="member.role" class="sr-only peer">
                                                <div class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl border text-sm font-semibold transition-all
                                                            border-gray-200 text-gray-500
                                                            peer-checked:border-amber-400 peer-checked:bg-amber-50 peer-checked:text-amber-600">
                                                    <i class="fa-solid fa-crown text-xs"></i>
                                                    Ketua
                                                </div>
                                            </label>
                                            <label class="flex-1 cursor-pointer">
                                                <input type="radio" :name="'members['+index+'][role]'"
                                                    value="Anggota" x-model="member.role" class="sr-only peer">
                                                <div class="flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl border text-sm font-semibold transition-all
                                                            border-gray-200 text-gray-500
                                                            peer-checked:border-[var(--flora-teal)] peer-checked:bg-[var(--flora-teal)]/5 peer-checked:text-[var(--flora-teal)]">
                                                    <i class="fa-solid fa-user text-xs"></i>
                                                    Anggota
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </template>
                    </div>

                    {{-- Tim Summary --}}
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-amber-50 border border-amber-100">
                            <i class="fa-solid fa-crown text-amber-500 text-sm"></i>
                            <div>
                                <p class="text-[11px] text-amber-600 font-semibold uppercase tracking-wider">Ketua</p>
                                <p class="text-lg font-bold text-amber-700"
                                    x-text="members.filter(m => m.role === 'Ketua').length"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[var(--flora-teal)]/5 border border-[var(--flora-teal)]/20">
                            <i class="fa-solid fa-users text-[var(--flora-teal)] text-sm"></i>
                            <div>
                                <p class="text-[11px] text-[var(--flora-teal)] font-semibold uppercase tracking-wider">Anggota</p>
                                <p class="text-lg font-bold text-[var(--flora-teal)]"
                                    x-text="members.filter(m => m.role === 'Anggota').length"></p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Footer Actions --}}
                <div class="px-6 py-4 bg-gray-50/70 border-t border-gray-100 flex items-center justify-between gap-3 rounded-b-2xl">
                    <p class="text-xs text-gray-400">
                        <span class="text-red-400">*</span> Wajib diisi
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('team.index') }}"
                            class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                            Batal
                        </a>
                        <button type="submit" :disabled="isSubmitting"
                            class="flex items-center gap-2 px-6 py-2.5 text-sm font-semibold text-white bg-[var(--flora-teal)] rounded-xl
                                   hover:opacity-90 active:scale-95 transition-all disabled:opacity-60 disabled:cursor-not-allowed shadow-sm">
                            <span x-show="!isSubmitting">
                                <i class="fa-solid fa-floppy-disk mr-1.5 text-xs"></i>
                                Simpan Tim
                            </span>
                            <span x-show="isSubmitting" x-cloak class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4z"></path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </div>

            </div>
        </form>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('timForm', () => ({
                    form: {
                        team_name: '',
                        explore_location: '',
                        description: '',
                    },

                    members: [
                        { user_id: '', role: 'Ketua' },
                        { user_id: '', role: 'Anggota' }
                    ],

                    memberError: '',
                    isSubmitting: false,

                    addMember() {
                        if (this.members.length >= 4) return
                        this.members.push({ user_id: '', role: 'Anggota' })
                    },

                    removeMember(index) {
                        if (this.members.length <= 1) return
                        this.members.splice(index, 1)
                    },

                    isDuplicate(index) {
                        const uid = this.members[index].user_id
                        if (!uid) return false
                        return this.members.filter((m, i) => m.user_id === uid && i !== index).length > 0
                    },

                    checkDuplicateUsers() {
                        // Just triggers reactivity for isDuplicate
                    },

                    validateForm() {
                        this.memberError = ''

                        if (!this.form.team_name.trim()) {
                            alert('Nama Tim wajib diisi.')
                            return false
                        }

                        if (!this.form.explore_location.trim()) {
                            alert('Lokasi Eksplorasi wajib diisi.')
                            return false
                        }

                        const Ketua = this.members.filter(m => m.role === 'Ketua').length
                        if (Ketua < 1) {
                            this.memberError = 'Minimal harus ada 1 Anggota dengan peran Ketua.'
                            return false
                        }
                        if (Ketua > 1) {
                            this.memberError = 'Hanya boleh ada 1 Ketua dalam tim.'
                            return false
                        }

                        const Anggota = this.members.filter(m => m.role === 'Anggota').length
                        if (Anggota < 1) {
                            this.memberError = 'Minimal harus ada 1 Anggota dalam tim.'
                            return false
                        }

                        const emptyUser = this.members.some(m => !m.user_id)
                        if (emptyUser) {
                            this.memberError = 'Semua slot Anggota harus memilih pengguna.'
                            return false
                        }

                        const userIds = this.members.map(m => m.user_id)
                        const unique = new Set(userIds)
                        if (unique.size !== userIds.length) {
                            this.memberError = 'Terdapat pengguna yang dipilih lebih dari satu kali.'
                            return false
                        }

                        return true
                    },

                    submitForm() {
                        if (!this.validateForm()) return

                        this.isSubmitting = true
                        this.$refs.form.submit()
                    }
                }))
            })
        </script>
    @endpush
@endsection