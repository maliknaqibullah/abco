<?php

namespace App\Exports;

use App\Models\BakeryOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection,WithHeadings,
    WithMapping,ShouldAutoSize,WithStyles
{

    private $productIDs;
    public function __construct($productIDs)
    {
        $this->productIDs = $productIDs;
    }

    public function headings():array
    {
        return [
            'Bakery',
            'School',
            'Present Students',
            'Baked Bread+',
            'Distributed Bread+',
            'Ingredients'
        ];
    }

    public function map($product):array{
        return [
            $product->bakery->name,
            $product->school->name,
            $product->male+$product->female,
            $product->loaves_qty,
            $product->distributed_loaves,
            'Flour '.$product->loaves_qty*0.160.
            ' Walnuts'.$product->loaves_qty*0.007.
            ' Raisins '.$product->loaves_qty*0.008.
            ' Sugar'.$product->loaves_qty*0.01
        ];
    }

    public function collection()
    {

        return BakeryOrder::with('school','bakery')->find($this->productIDs);

    }
    public function styles(Worksheet $sheet)
    {

        return [
            // Style the first row as bold text.
            1    => [
                'font' => [
                    'bold' => true,
                    'color'=> array('argb' => 'FFFFFFFF')
                ],
                'borders' => array(
                    'outline' => array(
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => array('argb' => '00000000'),
                    ),
                ),
                'fill' => array(
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => array('argb' => '00000000')
                ),

            ],
        ];
    }


}
