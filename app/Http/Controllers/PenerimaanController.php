<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenerimaanRequest;
use App\Models\Collector;
use App\Models\penerimaan;
use App\Models\team;
use App\Services\penerimaan\PenerimaanService;
use App\Services\penerimaan\templateTanamanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenerimaanController extends Controller
{
    public function __construct(private PenerimaanService $service, private templateTanamanService $templateFile) {}

    public function downloadTemplate()
    {
        // Flow download Template read service -> return Excel -> ditampung ke temp dir lalu di download -> jika selesai di hapus
        $spreadsheet = $this->templateFile->generateTemplateTanaman();
        $writer = new Xlsx($spreadsheet);
        $filename = 'template_tanaman_penerimaan.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), 'template_');
        $writer->save($tempFile);

        return response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = $this->service->getIndexData();

        return view('penerimaan.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $collector = Collector::all();
        $team = team::with('team_member.user')->get();
        return view('penerimaan.create', compact('collector','team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenerimaanRequest $request)
    {
        // dd($request);
        $this->service->store($request->toServiceData());

        return redirect()->route('penerimaan.index')
            ->with('success', 'Penerimaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(penerimaan $penerimaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(penerimaan $penerimaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, penerimaan $penerimaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(penerimaan $penerimaan)
    {
        //
    }
}
