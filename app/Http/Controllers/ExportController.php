<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\ReportOrderExport;
use App\Exports\ReportSaleExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function productExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    public function reportSaleExcel()
    {
        return Excel::download(new ReportSaleExport, 'saleDetailReport.xlsx');
    }
    public function reportOrderExcel()
    {
        return Excel::download(new ReportOrderExport, 'orderDetailReport.xlsx');
    }
}
