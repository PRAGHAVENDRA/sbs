<?php 

require_once '../../../Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);
$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);

$objPHPExcel->getDefaultStyle()
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getDefaultStyle()
            ->getAlignment()
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
$bhashyaCode = array("1"=>"BS","2"=>"Gita","3"=>"Isha","4"=>"Aitareya","5"=>"Kathaka","6"=>"Kena_pada","7"=>"Kena_vakya","8"=>"kst","9"=>"Chandogya","10"=>"jbl","11"=>"Taitiriya","12"=>"Prashna","13"=>"Brha","14"=>"Mandukya","15"=>"Mundaka","16"=>"svt","17"=>"zothers");
/*
$bhashyaSan = array("Isha"=>"ईशावास्योपनिषत्","Kena_pada"=>"केनोपनिषत् पदभाष्यम्","Kena_vakya"=>"केनोपनिषत् वाक्यभाष्यम्","Kathaka"=>"काठकोपनिषत्","Prashna"=>"प्रश्नोपनिषत्","Mundaka"=>"मुण्डकोपनिषत्","Mandukya"=>"माण्डूक्योपनिषत्","Taitiriya"=>"तैत्तिरीयोपनिषत्","Aitareya"=>"ऐतरेयोपनिषत्","Chandogya"=>"छान्दोग्योपनिषत्","Brha"=>"बृहदारण्यकोपनिषत्","BS"=>"ब्रह्मसूत्रभाष्यम्","Gita"=>"श्रीमद्भगवद्गीता","jbl"=>"जाबालोपनिषत्","kst"=>"कौषीतकिब्राह्मणोपनिषत्","svt"=>"श्वेताश्वतरोपनिषत्","zothers"=>"अन्यत्र");
*/
$bhashyaSan = array("Isha"=>"ईश","Kena_pada"=>"केन-पद","Kena_vakya"=>"केन-वाक्य","Kathaka"=>"काठक","Prashna"=>"प्रश्न","Mundaka"=>"मुण्डक","Mandukya"=>"माण्डूक्य","Taitiriya"=>"तैत्तिरीय","Aitareya"=>"ऐतरेय","Chandogya"=>"छान्दोग्य","Brha"=>"बृहदारण्यक","BS"=>"ब्रह्मसूत्र","Gita"=>"गीता","jbl"=>"जाबाल","kst"=>"कौषीतकि","svt"=>"श्वेताश्वतर","zothers"=>"अन्यत्र");

$cmax = 1500;
$inTotal = array_fill(0, sizeof($bhashyaCode), 0);
foreach ($bhashyaCode as $x => $bcode)
{
    $hpos = chr(65 + $x) . 1;
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($hpos, $bhashyaSan{$bcode});
    cellColor($hpos, 'EEEEEE');
    $objPHPExcel->setActiveSheetIndex(0)
                ->getRowDimension($x)
                ->setRowHeight(24);
    $objPHPExcel->setActiveSheetIndex(0)->getStyle($hpos)->getFont()->setBold(true);
    
    $vpos = 'A' . ($x + 1);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($vpos, $bhashyaSan{$bcode});
    cellColor($vpos, 'EEEEEE');
    $objPHPExcel->setActiveSheetIndex(0)
                ->getRowDimension($x+1)
                ->setRowHeight(24);
    $objPHPExcel->setActiveSheetIndex(0)->getStyle($vpos)->getFont()->setBold(true);
                
    if(file_exists('./'.$bcode.'_ullekha.php'))
    {
        $fileContents = file_get_contents('./'.$bcode.'_ullekha.php', FILE_USE_INCLUDE_PATH);
    }
    else
    {
        $fileContents = '';
    }
    $tval = 0;
    foreach ($bhashyaCode as $bid => $y)
    {
        $needle = 'type="' . $y . '"';
        $val = substr_count($fileContents, $needle) . "\n";
        $inTotal[$bid - 1] += $val;
        $xypos = chr(65 + $bid) . ($x + 1);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($xypos, $val);
        $color = dechex(255- floor(pow(($val / $cmax) * 255, 0.85)));
        cellColor($xypos, $color.$color.$color);
        $tval += $val;
    }
    $xypos = chr(65 + $bid + 1) . ($x + 1);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($xypos, $tval);
    $color = dechex(255- floor(pow(($tval / $cmax) * 255, 0.85)));
    cellColor($xypos, $color.$color.$color);    
}
$hpos = chr(65 + $x + 1) . 1;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($hpos, 'Total Out');
cellColor($hpos, 'EEEEEE');
$objPHPExcel->setActiveSheetIndex(0)->getStyle($hpos)->getFont()->setBold(true);

$vpos = 'A' . ($x + 1);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($vpos, 'Total In');
cellColor($vpos, 'EEEEEE');
$objPHPExcel->setActiveSheetIndex(0)->getStyle($vpos)->getFont()->setBold(true);

$inTotal[$x] = array_sum($inTotal);
for($i=0;$i<sizeof($inTotal);$i++)
{
    $xypos = chr(65 + $i + 1) . ($x + 1);
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($xypos, $inTotal[$i]);
    $color = dechex(255- floor(pow(($inTotal[$i] / $cmax) * 255, 0.85)));
    cellColor($xypos, $color.$color.$color);
}
cellColor($xypos, 'FFFFFF');
$objPHPExcel->setActiveSheetIndex(0)->getStyle($xypos)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->setTitle('Report');
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('Report.xls');

function cellColor($cells,$color){
        global $objPHPExcel;
        $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()
        ->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => $color)
        ));
    }
?>
