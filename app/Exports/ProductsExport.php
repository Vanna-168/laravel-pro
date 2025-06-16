<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * @var array
     */
    protected $columnWidths = [
        'A' => 10,
        'B' => 30,
        'C' => 50,
        'D' => 20,
        'E' => 10,
        'F' => 10,
        'G' => 20,
        'H' => 10,
        'I' => 20,
        'J' => 20,
    ];

    public function columnWidths(): array
    {
        return $this->columnWidths;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Product::with(['category:id,name', 'brand:id,name'])
            ->where('status', 1)
            ->get()
            ->map(function ($product) {
                return [
                    'id'          => $product->id,
                    'name'        => $product->name,
                    'description' => $product->description,
                    'price'       => $product->price,
                    'qty'         => $product->qty,
                    'size'        => $product->size,
                    'image'       => $product->image,
                    'status'      => $product->status,
                    'brand_name'  => $product->brand->name ?? 'N/A',
                    'category_name' => $product->category->name ?? 'N/A',
                ];
            });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Price',
            'Qty',
            'Size',
            'Image',
            'Status',
            'Brand',
            'Category'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '85837f'],
                ],
            ],
        ];
    }
}
