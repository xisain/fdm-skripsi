<?php

namespace App\Services\penerimaan;

use App\Models\penerimaan;
use App\Repositories\PenerimaanRepository;
use App\Models\legal_documents;
use Illuminate\Support\Facades\Storage;
use App\Models\Collector;
use DB;

class PenerimaanService
{
    public function __construct(private nomorAksesService $nomorakses, private PenerimaanRepository $repo)
    {
    }

    public function getIndexData()
    {
        $penerimaans = $this->repo->getPaginatedWithRelations();

        $stats = [
            'total' => $this->repo->countAll(),
            'total_tanaman' => $this->repo->countTanaman(),
            'eksplorasi' => $this->repo->countByJenis('eksplorasi'),
            'introduksi' => $this->repo->countByJenis('introduksi'),
        ];
        // dd($penerimaans);

        return compact('penerimaans', 'stats');
    }

    public function store(array $data): penerimaan
    {

        return DB::transaction(function () use ($data) {
            $penerimaan = penerimaan::create([
                'user_id' => auth()->id() ?? 1,
                'tanggal_explorasi' => $data['tanggal_explorasi'],
                'jenis_form' => $data['jenis_form'],
                'tanggal_penerimaan' => $data['tanggal_penerimaan'],
                'tempat_asal' => $data['tempat_asal'],
                'country' => $data['country'],
                'source' => $data['source'],
                'native' => $data['native'],
            ]);

            // ================= TIM =================
            $penerimaan->timPenerimaans()->createMany($data['tim']);

            // ================= TANAMAN =================
            $nomors = $this->nomorakses->generateBatch('BB', count($data['tanaman']));

            $tanaman = collect($data['tanaman'])->map(function ($item, $index) use ($nomors) {
                $item['nomor_akses'] = $nomors[$index];
                if (!empty($item['collector_initial'])) {
                    $collector = Collector::where('initial_collector_name', $item['collector_initial'])->first();

                    $item['collector_id'] = $collector?->id;
                }
                return $item;
            })->toArray();
            // dd($tanaman);

            $penerimaan->tanamanPenerimaans()->createMany($tanaman);

            // ================= LEGAL DOCUMENT 🔥 =================
            if (!empty($data['dokumen'])) {
                foreach ($data['dokumen'] as $doc) {

                    // skip kalau kosong (safety)
                    if (empty($doc['namaSurat']) || empty($doc['fileSurat'])) {
                        continue;
                    }

                    $path = $doc['fileSurat']->store('legal_documents', 'public');

                    $penerimaan->legal_documents()->create([
                        'document_name' => $doc['namaSurat'],
                        'nomor_surat' => $doc['nomorSurat'] ?? null,
                        'document_path' => $path,
                        'user_id' => auth()->id(),
                    ]);
                }
            }

            return $penerimaan;
        });
    }
}
