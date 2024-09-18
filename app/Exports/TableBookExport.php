<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class TableBookExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Buku',
            'Penulis',
            'Penerbit',
            'Tahun Terbit',
            'Stock Buku'
        ];
    }

    public function map($row): array
    {
        return [
            $row->index + 1,
            $row->judul_buku,
            $row->penulis,
            $row->penerbit,
            $row->tahun_terbit,
            $row->stock
        ];
    }

        public function styles(Worksheet $sheet)
        {
            // Menentukan ukuran kolom
            $sheet->getColumnDimension('A')->setWidth(10); // Ukuran kolom A
            $sheet->getColumnDimension('B')->setWidth(30); // Ukuran kolom B
            $sheet->getColumnDimension('C')->setWidth(30); // Ukuran kolom C
            $sheet->getColumnDimension('D')->setWidth(30); // Ukuran kolom D
            $sheet->getColumnDimension('E')->setWidth(20); // Ukuran kolom E
            $sheet->getColumnDimension('F')->setWidth(10); // Ukuran kolom F

            $headerStyle = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);
        }
}
