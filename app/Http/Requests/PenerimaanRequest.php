<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PenerimaanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'tanggal_explorasi' => 'required|date',
            'jenis_form' => 'required|string|max:255',
            'tanggal_penerimaan' => 'required|date',
            'tempat_asal' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'native' => 'required|string|max:255',
            'dokumen' => 'required|array|min:1',
            'dokumen.*.namaSurat' => 'required|string|max:255',
            'dokumen.*.nomorSurat' => 'nullable|string|max:255',
            'dokumen.*.fileSurat' => 'required|file|mimes:pdf|max:5120',
            'tim' => 'required|array|min:1',
            'tim.*.user_id' => 'required|exists:users,id',
            'tim.*.role' => 'required|in:Ketua,Anggota Explorasi',
            'tanaman' => 'required_without:tanaman_excel_json|array|min:1',
            'tanaman_excel_json' => 'required_without:tanaman|nullable|string',
            'tanaman.*.scientific_name' => 'required|string|max:255',
            'tanaman.*.nomor_akses' => 'nullable|string|max:255',
            'tanaman.*.nama_lokal' => 'nullable|string|max:255',
            'tanaman.*.marga' => 'nullable|string|max:255',
            'tanaman.*.marga_jenis' => 'nullable|string|max:255',
            'tanaman.*.suku' => 'nullable|string|max:255',
            'tanaman.*.spesies' => 'nullable|string|max:255',
            'tanaman.*.author_name' => 'nullable|string|max:255',
            'tanaman.*.locality' => 'nullable|string|max:255',
            'tanaman.*.jumlah_material' => 'nullable|string|max:255',
            'tanaman.*.vak_no' => 'nullable|string|max:255',
            'tanaman.*.collector_initial' =>'required|string|max:3',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->filled('tanaman_excel_json') && $this->tanaman_excel_json !== '[]') {
            $tanaman = json_decode($this->tanaman_excel_json, true);

            // 🔥 normalize semua field jadi string
            $tanaman = collect($tanaman)->map(function ($item) {
                return [
                    'scientific_name' => $item['scientific_name'] ?? null,
                    'nomor_akses' => $item['nomor_akses'] ?? null,
                    'nama_lokal' => $item['nama_lokal'] ?? null,
                    'marga' => $item['marga'] ?? null,
                    'marga_jenis' => $item['marga_jenis'] ?? null,
                    'suku' => $item['suku'] ?? null,
                    'spesies' => $item['spesies'] ?? null,
                    'author_name' => $item['author_name'] ?? null,
                    'locality' => $item['locality'] ?? null,

                    // 👇 FIX UTAMA
                    'jumlah_material' => isset($item['jumlah_material'])
                        ? (string) $item['jumlah_material']
                        : null,

                    'vak_no' => isset($item['vak_no'])
                        ? (string) $item['vak_no']
                        : null,
                    'collector_initial' => isset($item['collector_initial']) ? (string) $item['collector_initial'] : null
                ];
            })->toArray();

            $this->merge([
                'tanaman' => $tanaman,
            ]);
        }
    }

    public function toServiceData(): array
    {
        return $this->validated();
    }
}
