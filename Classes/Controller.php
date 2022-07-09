<?php

class Controller
{
    protected $task;
    protected $view;

    protected function getModel() {
        return new Model();
    }

    public function execute($task)
    {
        if ($task) {
            if (method_exists($this, $task)) {
                return $this->$task();
            } else {
                return false;
            }
        }
    }

    public function export()
    {
        if (!empty($_FILES['file']['tmp_name'])) {
            $file = $this->uploadFile($_FILES);
        }

        $this->xlsToMysql($file);

        return $this->xlsToMysql($file);
    }

    public function getPhpExcel($file)
    {
        return PHPExcel_IOFactory::load($file);
    }

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function xlsToMysql($file)
    {

        $this->model = $this->getModel();

        $this->xls = $this->getPhpExcel($file);

        $this->xls->setActiveSheetIndex(0);

        $sheet = $this->xls->getActiveSheet();

        $rowIterator = $sheet->getRowIterator();

        $arr = array();

        if ($_POST['row']) {
            $diapazonString = $this->test_input($_POST['row']);
        }

        if ($_POST['countRow']) {
            $countString = $this->test_input($_POST['countRow']);
        }

        if ($_POST['stringArticul']){
            $stringArticul = $this->test_input($_POST['stringArticul']) ;
        }

        if ($_POST['stringProduct']){
            $stringProduct = $this->test_input($_POST['stringProduct']);
        }

        if ($_POST['costStart']){
            $costStart = $this->test_input($_POST['costStart']);
        }

        if ($_POST['costEnd']){
            $costEnd = $this->test_input($_POST['costEnd']);
        }

        $cells = array(
            'A' => 'articul',
            'B' => 'product_name',
            'C' => 'price',
            'D' => 'remains',
        );

        $arrNone = [
            [
                'articul' => 'Совпадений не обнаружено',
                'product_name' => 'Совпадений не обнаружено',
                'price' => 'Совпадений не обнаружено',
                'remains' => 'Совпадений не обнаружено',
            ]
        ];

        if (!empty($_POST['colum'])) {
            $cellsPOST = array();
            foreach ($_POST['colum'] as $item) {
                if ($item == 'A') {
                    $cellsPOST[$item] = 'articul';
                }
                if ($item == 'B') {
                    $cellsPOST[$item] = 'product_name';
                }
                if ($item == 'C') {
                    $cellsPOST[$item] = 'price';
                }
                if ($item == 'D') {
                    $cellsPOST[$item] = 'remains';
                }
            }
        } else {
            $cellsPOST = array(
                'A' => 'articul',
                'B' => 'product_name',
                'C' => 'price',
                'D' => 'remains',
            );
        }

        foreach ($rowIterator as $row) {

            if ($row->getRowIndex() != 1) {
                //Если указано какие строки
                if ($countString && $diapazonString) {
                    $algoritm = 3;
                } elseif ($diapazonString) {
                    $algoritm = 2;
                } elseif ($countString) {
                    $algoritm = 1;
                }

                if ($algoritm) {

                    if ($algoritm == 1) {
                        if ($row->getRowIndex() <= $countString + 1) {
                            $cellIterator = $row->getCellIterator();
                            foreach ($cellIterator as $cell) {
                                $cellPath = $cell->getColumn();
                                if (isset($cells[$cellPath])) {
                                    $arr[$row->getRowIndex()][$cells[$cellPath]] = $cell->getCalculatedValue();
                                }
                            }
                        }
                    }

                    if ($algoritm == 2) {
                        if ($row->getRowIndex() >= $diapazonString) {
                            $cellIterator = $row->getCellIterator();
                            foreach ($cellIterator as $cell) {
                                $cellPath = $cell->getColumn();
                                if (isset($cells[$cellPath])) {
                                    $arr[$row->getRowIndex()][$cells[$cellPath]] = $cell->getCalculatedValue();
                                }
                            }
                        }
                    }

                    if ($algoritm == 3) {
                        if (($row->getRowIndex() >= $diapazonString) && ($row->getRowIndex() < ($countString + $diapazonString))) {
                            $cellIterator = $row->getCellIterator();
                            foreach ($cellIterator as $cell) {
                                $cellPath = $cell->getColumn();
                                if (isset($cells[$cellPath])) {
                                    $arr[$row->getRowIndex()][$cells[$cellPath]] = $cell->getCalculatedValue();
                                }
                            }
                        }
                    }
                } else {
                    $cellIterator = $row->getCellIterator();

                    foreach ($cellIterator as $cell) {

                        $cellPath = $cell->getColumn();
                        if (!empty($cells[$cellPath]) && empty($cellsPOST[$cellPath])){
                            $cellValue = '';
                        }else{
                            $cellValue = $cell->getCalculatedValue();
                        }

                        if (isset($cells[$cellPath])) {
                            $arr[$row->getRowIndex()][$cells[$cellPath]] = $cellValue;
                        }
                    }
                }
            }
        }

        foreach ($arr as $keyNum => $number) {

            if ($number[$cells['A']] == '' && $number[$cells['B']] == '' && $number[$cells['C']] == '' && $number[$cells['D']] == '') {
                unset($arr[$keyNum]);
            }

            if ($number[$cells['A']] == '') {
                unset($arr[$keyNum]);
            }

            if ($stringArticul){
                if ($number[$cells['A']] == $stringArticul){
                    $aas =0;
                }else{
                    unset($arr[$keyNum]);
                }
            }

            if ($stringProduct){
                if (strpos($number[$cells['B']], $stringProduct)){
                    $aas =0;
                }else{
                    unset($arr[$keyNum]);
                }
            }

            if($costStart){
                if ($number[$cells['C']] >= $costStart){
                    $aas =0;
                }else{
                    unset($arr[$keyNum]);
                }
            }

            if($costEnd){
                if ($number[$cells['C']] <= $costEnd){
                    $aas =0;
                }else{
                    unset($arr[$keyNum]);
                }
            }
        }

        if ($this->model->requestPreparation($arr)) {
            return $arr;
        }else{
            return $arrNone;
        }
    }

    public function uploadFile($files)
    {

        $arrayPath = explode('\\', __DIR__);
        unset($arrayPath[count($arrayPath)-1]);
        $path = implode('\\', $arrayPath);
        $uploaddir = $path . '/file';

        $uploadfile = $uploaddir . '/' . (int)microtime(true) . '.xls';
        if (move_uploaded_file($files['file']['tmp_name'], $uploadfile)) {
            return $uploadfile;
        }
        return FALSE;
    }
}

