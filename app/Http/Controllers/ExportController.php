<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function productExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    public function reportExcel()
    {
        return Excel::download(new ReportExport, 'report.xlsx');
    }
}
