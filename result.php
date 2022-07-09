<?php
if (strip_tags($_GET['task']) == 'export'){
    $task = strip_tags($_GET['task']);
}else{
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'].'/index.php';
    header( 'location:'.$url);
}

//Data for the database
define('DSN', 'mysql:host=localhost;dbname=catalog;charset=utf8');
define('USER_NAME_DB', 'root');
define('PASSWORD_DB', '');
define('NAME_TABLE_MYQSL', 'products');

require_once 'library/PHPExcel.php';
require_once 'Classes/Model.php';
require_once 'Classes/Controller.php';
require 'vendor/autoload.php';

$controller = new Controller;
$arr = $controller->execute($task);

//Array for html
$cells = array(
    'A' => 'articul',
    'B' => 'product_name',
    'C' => 'price',
    'D' => 'remains',
);

include 'template/local/view/header.php';
?>


    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-success">Ознакомьтесь с данными внесенными в БАЗУ ДАННЫХ</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Таблица</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr class="text-success">
                                        <? foreach ($cells as $column): ?>
                                            <th><?= $column == 'articul' ? 'Артикул' : ($column == 'product_name' ? 'Наименование товара' : ($column == 'price' ? 'Цена' : ($column == 'remains' ? 'Остатки' : ''))); ?></th>
                                        <? endforeach; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?
                                    $arr2 = array_reverse($arr);
                                    foreach ($arr2 as $key => $number):
                                        ?>
                                        <tr>
                                            <? foreach ($number as $item): ?>
                                                <td><?= $item ?></td>
                                            <? endforeach; ?>
                                        </tr>
                                    <? endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-success">
                                        <? foreach ($cells as $column): ?>
                                            <th><?= $column == 'articul' ? 'Артикул' : ($column == 'product_name' ? 'Наименование товара' : ($column == 'price' ? 'Цена' : ($column == 'remains' ? 'Остатки' : ''))); ?></th>
                                        <? endforeach; ?>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

<?php
include 'template/local/view/footer.php';
?>