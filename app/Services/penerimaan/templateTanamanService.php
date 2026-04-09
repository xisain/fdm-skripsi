<?php

namespace App\Services\penerimaan;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class templateTanamanService
{
    public function __construct() {}

    public function generateTemplateTanaman(): Spreadsheet
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Tanaman');

        $headers = [
            'A' => 'scientific_name',
            'B' => 'nama_lokal',
            'C' => 'marga',
            'D' => 'marga_jenis',
            'E' => 'suku',
            'F' => 'spesies',
            'G' => 'author_name',
            'H' => 'locality',
            'I' => 'jumlah_material',
            'J' => 'vak_no',
        ];

        foreach ($headers as $col => $label) {
            $sheet->setCellValue("{$col}1", $label);
        }

        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0F6E56'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(25);

        $columnWidths = [
            'A' => 30,
            'B' => 20,
            'C' => 18,
            'D' => 18,
            'E' => 18,
            'F' => 18,
            'G' => 15,
            'H' => 25,
            'I' => 18,
            'J' => 15,
        ];

        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimension($col)->setWidth($width);
        }

        $contoh = [
            'A' => 'Mangifera indica',
            'B' => 'Mangga',
            'C' => 'Mangifera',
            'D' => 'indica',
            'E' => 'Anacardiaceae',
            'F' => 'indica',
            'G' => 'L.',
            'H' => 'Jawa Barat, Indonesia',
            'I' => '3',
            'J' => 'VAK-001',
        ];

        foreach ($contoh as $col => $value) {
            $sheet->setCellValue("{$col}2", $value);
        }

        $sheet->getStyle('A2:J2')->applyFromArray([
            'font' => ['italic' => true, 'color' => ['rgb' => '6B7280']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F9FAFB']],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'E5E7EB'],
                ],
            ],
        ]);

        $sheet->freezePane('A2');

        // Sheet panduan
        $guide = $spreadsheet->createSheet();
        $guide->setTitle('Panduan');

        $panduan = [
            ['Kolom', 'Keterangan', 'Wajib'],
            ['scientific_name', 'Nama ilmiah tanaman (latin)', 'Ya'],
            ['nama_lokal', 'Nama umum/lokal tanaman', 'Tidak'],
            ['marga', 'Genus tanaman', 'Tidak'],
            ['marga_jenis', 'Marga jenis tanaman', 'Tidak'],
            ['suku', 'Famili/suku tanaman', 'Tidak'],
            ['spesies', 'Nama spesies', 'Tidak'],
            ['author_name', 'Nama author (cth: L. / Blume)', 'Tidak'],
            ['locality', 'Lokasi pengambilan spesimen', 'Tidak'],
            ['jumlah_material', 'Jumlah material yang diterima', 'Tidak'],
            ['vak_no', 'Nomor VAK', 'Tidak'],
        ];

        foreach ($panduan as $rowIndex => $row) {
            foreach (['A', 'B', 'C'] as $colIndex => $col) {
                $guide->setCellValue("{$col}".($rowIndex + 1), $row[$colIndex]);
            }
        }

        $guide->getStyle('A1:C1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '0F6E56']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        $guide->getColumnDimension('A')->setWidth(20);
        $guide->getColumnDimension('B')->setWidth(40);
        $guide->getColumnDimension('C')->setWidth(10);

        foreach (range(2, count($panduan)) as $row) {
            $val = $guide->getCell("C{$row}")->getValue();
            $color = $val === 'Ya' ? 'FEE2E2' : 'F0FDF4';
            $textColor = $val === 'Ya' ? 'B91C1C' : '15803D';
            $guide->getStyle("C{$row}")->applyFromArray([
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]],
                'font' => ['color' => ['rgb' => $textColor], 'bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ]);
        }

        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet; // ← kembalikan object, bukan response
    }
}
