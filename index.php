<?php
include 'template/local/view/header.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Парсинг от Анатолича</h1>
                    <p>Создать константы с данными базы И ФАЙЛ КОНФИГУРАЦИИ</p>
                    <p>Придумать функцию которая будет запускать приложение</p>
                    <p>Создать файл READER.ME</p>
                    <p>Закинуть приложение на гит хаб</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                <!-- form start     -->
                <div class="col-6">
                    <form id="first_form" method="POST" enctype="multipart/form-data">
                        <div class="card-body col-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Укажите файл для парсинга <span class="text-danger">*</span></label>
                                <div class="input-group file-after">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" id="exampleInputFile" name="file" required>
                                        <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Загрузить</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group column_a">
                                <label>Выберите <span class="text-success">столбцы</span> которые Вы хотите занести в базу</label>
                                <select id="columXml" multiple class="form-control" name="colum[]">
                                    <option value="A">Артикль</option>
                                    <option value="B">Наименование товара</option>
                                    <option value="C">Цена</option>
                                    <option value="D">Остаток</option>
                                </select>
                            </div>
                            <div class="form-group count_row-after">
                                <label>Укажите количество <span class="text-success">строк</span> которые Вы хотите занести в базу</label>
                                <input id="exampleInputCountRow" type="number" class="form-control"
                                       placeholder="Целое число (По умолчанию 0)" name="countRow">
                            </div>
                            <div class="form-group row-after">
                                <label>Укажите от какой <span class="text-success">строки</span> Вы хотите занести в базу</label>
                                <input  id="exampleInputRow" type="number" class="form-control"
                                       placeholder="Целое число (По умолчанию 0)" name="row">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group cost_start-after">
                                        <label>Укажите <span class="text-success">цену</span> от которой Вы хотите искать</label>
                                        <input id="exampleInputCostStart" type="number" class="form-control"
                                               placeholder="Целое число (По умолчанию 0)" name="costStart">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group cost_end-after">
                                        <label>Укажите <span class="text-success">цену</span> до которой Вы хотите искать</label>
                                        <input id="exampleInputCostEnd" type="number" class="form-control"
                                               placeholder="Целое число (По умолчанию 0)" name="costEnd">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group str_articul-after">
                                <label>Укажите <span class="text-success">Артикул</span> который Вы хотите занести в базу</label>
                                <input id="exampleInputStringArticul" type="text" class="form-control"
                                       placeholder="Введите полное значение Артикля" name="stringArticul">
                            </div>
                            <div class="form-group str_product-after">
                                <label>Укажите <span class="text-success">название товара</span> которое Вы хотите занести в базу</label>
                                <input id="exampleInputStringProduct" type="text" class="form-control"
                                       placeholder="Введите подстроку или целое имя значения Наименование товара" name="stringProduct">
                            </div>
                        </div>
                        <div class="col-4">
                            <button id="submitForm" type="submit" class="btn btn-primary m-auto">Парсить</button>
                        </div>
                    </form>
                    <!-- /.form-end -->
                </div>
            </div>

        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<?php
include 'template/local/view/footer.php';
?>
