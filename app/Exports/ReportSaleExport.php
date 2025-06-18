<?php

namespace App\Exports;

use App\Models\SaleDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportSaleExport implements FromCollection, WithColumnWidths, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $columnWidths = [
        'A' => 5,
        'B' => 20,
        'C' => 20,
        'D' => 10,
        'E' => 10,
        'F' => 10,
        'G' => 10,
        'H' => 20,
        'I' => 20,
        'J' => 20,
        'K' => 20,
        'L' => 20,
    ];
    public function columnWidths(): array
    {
        return $this->columnWidths;
    }
    public function collection()
    {
        $id = 1;
        return SaleDetail::with([
            'sale',
            'product',
            'sale.user',
            'sale.customer',
            'sale.invoice',
        ])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($detail, $key) use (&$id) {
                return [
                    'ID'              => $id++,
                    'Invoice Number'  => $detail->sale->invoice->invoice_number ?? 'N/A',
                    'Product Name'    => $detail->product->name ?? 'N/A',
                    'Quantity'        => $detail->quantity,
                    'Unit Price'      => number_format($detail->unit_price, 2),
                    'Discount'        => number_format($detail->discount_amount, 2),
                    'Total'           => number_format(($detail->unit_price * $detail->quantity) - $detail->discount_amount, 2),
                    'Sale Date'       => $detail->sale->sale_date ?? 'N/A',
                    'Payment Status'  => $detail->sale->payment_status ?? 'N/A',
                    'Payment Method'  => $detail->sale->payment_method ?? 'N/A',
                    'Customer Name'   => isset($detail->sale->customer)
                        ? $detail->sale->customer->firstname . ' ' . $detail->sale->customer->lastname
                        : 'N/A',
                    'Sold By'         => $detail->sale->user->name ?? 'N/A',
                ];
            });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Invoice Number',
            'Product Name',
            'Quantity',
            'Price',
            'Discount',
            'Total',
            'Sale Date',
            'Payment Status',
            'Payment Method',
            'Customer Name',
            'Sold By',
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
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }
}
