<?php 
require_once('config/db.php');
require_once('config/function.php');
include('Classes/PHPExcel.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


 

function create_name_file_export(){
    $date_now  = new Date();


}


function name_file(){
    $date_now = date("Y_m_d");
    $name_websie = 'batdongsan';
    $type = 'sell';
    $name_file = $date_now . "_" . strtolower($name_websie) . "_" . strtolower($type) . ".xls";
    return $name_file;
}

function export_all() {
    $limit = $_POST['limit'];
    $result         =   display_data_limit($limit);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("BAT_DONG_SAN_EXPORT");
    $sheet 
        ->setCellValue('A1', 'Tiêu đề ')
        ->setCellValue('B1', 'Địa chỉ')
        ->setCellValue('C1', 'Giá')
        ->setCellValue('D1', 'Đơn giá')
        ->setCellValue('E1', 'Số phòng ngủ')
        ->setCellValue('F1', 'Số phòng vệ sinh')
        ->setCellValue('G1', 'Pháp lý')
        ->setCellValue('H1', 'Nội thất')
        ->setCellValue('I1', 'Mặt đường')
        ->setCellValue('J1', 'Mặt tiền')
        ->setCellValue('K1', 'Số tầng')
        ->setCellValue('L1', 'Hướng ban công')
        ->setCellValue('M1', 'Diện tích')
        ->setCellValue('N1', 'Đơn vị diện tích')
        ->setCellValue('O1', 'Ảnh')
        ->setCellValue('P1', 'Hướng nhà')
        ->setCellValue('Q1', 'Ngày đăng')
        ->setCellValue('R1', 'Ngày hết hạn')
        ->setCellValue('S1', 'Người đăng')
        ->setCellValue('T1', 'Số điện thoại');




    $rowCount = 2;

    
    while($row  =   $result->fetch_assoc()) {
        
        $sheet->setCellValue("A".$rowCount, $row['title']);
        $sheet->setCellValue("B".$rowCount, $row['title_address']);
        $sheet->setCellValue("C".$rowCount, $row['price']);
        $sheet->setCellValue("D".$rowCount, $row['unit_price']);
        $sheet->setCellValue("E".$rowCount, $row['bedroom']);
        $sheet->setCellValue("F".$rowCount, $row['toilet']);
        $sheet->setCellValue("G".$rowCount, $row['law']);
        $sheet->setCellValue("H".$rowCount, $row['indoor']);
        $sheet->setCellValue("I".$rowCount, $row['road']);
        $sheet->setCellValue("J".$rowCount, $row['face_first']);
        $sheet->setCellValue("K".$rowCount, $row['floor']);
        $sheet->setCellValue("L".$rowCount, $row['direction_balcony']);
        $sheet->setCellValue("M".$rowCount, $row['area']);
        $sheet->setCellValue("N".$rowCount, $row['unit_area']);
        $sheet->setCellValue("O".$rowCount, $row['images']);
        $sheet->setCellValue("P".$rowCount, $row['direction_of_house']);
        $sheet->setCellValue("Q".$rowCount, $row['created_at']);
        $sheet->setCellValue("R".$rowCount, $row['exp_at']);
        $sheet->setCellValue("S".$rowCount, $row['name_per']);
        $sheet->setCellValue("T".$rowCount, $row['phone']);
        $rowCount++;
    }
    $name_file = name_file();
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=.$name_file.");
    header('Cache-Control: max-age=0');
    $objWriter = new Xlsx($spreadsheet);
    $objWriter->save('php://output');
    
}

#BY FIELDS



function export_filter_fields($fields){

    
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle("BAT_DONG_SAN_EXPORT");
    $colums = array('A', 'B', 'C', 'D', 'E','F','G','H','I','K','L','M','N','O','P','Q','R','S','T');
    
    $var ='1';
    $i=0;
    
    $map_name = [
        'title' => 'Tiêu đề ',
        'detail_address' => 'Địa chỉ',
        'price' => 'Giá',
        'unit_price' => 'Đơn giá',
        'bedroom' => 'Số phòng ngủ',
        'toilet' => 'Số phòng vệ sinh',
        'law' => 'Pháp lý',
        'indoor' => 'Nội thất',
        'road' => 'Mặt đường',
        'face_first' => 'Mặt tiền',
        'floor' => 'Số tầng',
        'direction_balcony' => 'Hướng ban công',
        'area' => 'Diện tích',
        'unit_area' => 'Đơn vị diện tích',
        'images' => 'Ảnh',
        'direction_of_house' => 'Hướng nhà',
        'created_at' => 'Ngày đăng',
        'exp_at' => 'Ngày hết hạn',
        'name_per' => 'Người đăng',
        'phone' => 'Số điện thoại',
    ];
   
    
    
    $fields = $_POST['field'];
    
    foreach ($fields as $field){ 
        $name_colum = $colums[$i].=$var;
        $sheet ->setCellValue($name_colum, $map_name[$field]);
        $i+=1;

    }
    $rowCount = 2;
    $colums_new = array('A', 'B', 'C', 'D', 'E','F','G','H','I','K','L','M','N','O','P','Q','R','S','T');
    $count_fields = count($fields);
    
    $limit = $_POST['limit'];
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    $result         =   display_data_limit($limit);

    if (isset($_POST['date_from'])){
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        $result = display_data_filter_by_date($date_from,$date_to, $limit) ; 
    }




    while($row  =   $result->fetch_assoc()) {

        for ($x = 0; $x < $count_fields;){
            $sheet->setCellValue($colums_new[$x].$rowCount, $row[$fields[$x]]);
            $x++;

        }
        $rowCount++;
    }
    $name_file = name_file();
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=.$name_file.");
    header('Cache-Control: max-age=0');
    $objWriter = new Xlsx($spreadsheet);
    $objWriter->save('php://output');

}






if (isset($_POST['all_fields'])){
    
    $fields = $_POST['field'];
    export_all();
    
} else {
    $fields = $_POST['field'];
    export_filter_fields($fields);
}


?>



