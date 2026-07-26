<?php

namespace App\Http\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Http\Request;

class XlsController extends Controller
{
   
   public function xls($id){
       
// 2. Create a new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 3. Set document properties (optional)
$spreadsheet->getProperties()
    ->setCreator('Your Name')
    ->setTitle('Export Report')
    ->setDescription('Generated from PHP');

// 4. Set column headers
$headers = ['ID', 'Name', 'Email', 'Created Date'];
$column = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($column . '1', $header);
    $column++;
}

// 5. Style the header row
$headerStyle = $sheet->getStyle('A1:' . $column . '1');
$headerStyle->getFont()->setBold(true)->setSize(12);
$headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFCCCCCC');
$headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// 9. Set output headers for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="export_' . date('Y-m-d') . '.xlsx"');
header('Cache-Control: max-age=0');

// 10. Create writer and output the file
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
   }
}