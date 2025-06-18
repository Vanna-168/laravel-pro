<?php

namespace App\Exports;

use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportOrderExport implements FromCollection, WithColumnWidths, WithHeadings, WithStyles
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
        return OrderDetail::with([
            'order',
            'product',
            'order.user',
            'order.customer',
            'order.invoice',
        ])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($detail, $key) use (&$id) {
                return [
                    'ID'              => $id++,
                    'Invoice Number'  => $detail->order->invoice->invoice_number ?? 'N/A',
                    'Product Name'    => $detail->product->name ?? 'N/A',
                    'Quantity'        => $detail->quantity,
                    'Unit Price'      => number_format($detail->unit_price, 2),
                    'Discount'        => number_format($detail->discount_amount, 2),
                    'Total'           => number_format(($detail->unit_price * $detail->quantity) - $detail->discount_amount, 2),
                    'Order Date'       => $detail->order->order_date ?? 'N/A',
                    'Payment Status'  => $detail->order->payment_status ?? 'N/A',
                    'Payment Method'  => $detail->order->payment_method ?? 'N/A',
                    'Customer Name'   => isset($detail->order->customer)
                        ? $detail->order->customer->firstname . ' ' . $detail->order->customer->lastname
                        : 'N/A',
                    'Order By'         => $detail->order->user->name ?? 'N/A',
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
            'Order Date',
            'Payment Status',
            'Payment Method',
            'Customer Name',
            'Order By',
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
