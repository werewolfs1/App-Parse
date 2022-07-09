$(document).ready(function () {
    $('#first_form').submit(function (e) {
        var file = $('#exampleInputFile').val();
        var count_row = $('#exampleInputCountRow').val();
        var start_row = $('#exampleInputRow').val();
        var cost_start = $('#exampleInputCostStart').val();
        var cost_end = $('#exampleInputCostEnd').val();
        var str_articul = $('#exampleInputStringArticul').val();
        var str_product = $('#exampleInputStringProduct').val();
        var selected = $('#columXml').val();

        var array_file_name = file.split('.');
        var type_file = array_file_name[array_file_name.length - 1];
        const true_tupe_file = ['xls', 'xlsx'];

        if (selected[0] == 'A') {
            var columnA = selected[0];
        }
        if (selected[1] == 'B') {
            var columnB = selected[1];
        }
        if (selected[2] == 'C') {
            var columnC = selected[2];
        }
        if (selected[3] == 'D') {
            var columnD = selected[3];
        }

        $(".text-warning").remove();
        // console.log(columnA);
        if ((selected.length != 0) && (!columnA)) {
            $('.column_a').after('<span class="span-die text-warning">Для ввода данных обязан присутствовать <b>Артикль</b>!</span>');
        }
        if (type_file != true_tupe_file[0] && type_file != true_tupe_file[1]) {
            $('.file-after').after('<span class="span-die text-warning"><b>Неверное разширение файла.</b> Допустимы только файлы с <b>разширением .xls и .xlsx</b> </span>');
        }
        if (count_row <= 0 && count_row != '') {
            $('.count_row-after').after('<span class="span-die text-warning">Допустимы только <b>положительные</b> значения</span>');
        }
        if (start_row <= 0 && start_row != '') {
            $('.row-after').after('<span class="span-die text-warning">Допустимы только <b>положительные</b> значения</span>');
        }
        if (cost_start <= 0 && cost_start != '') {
            $('.cost_start-after').after('<span class="span-die text-warning">Допустимы только <b>положительные</b> значения</span>');
        }
        if (cost_end <= 0 && cost_end != '') {
            $('.cost_end-after').after('<span class="span-die text-warning">Допустимы только <b>положительные</b> значения</span>');
        }
        if ((cost_start > 0) && !(columnC) && (selected.length != 0)) {
            $('.cost_start-after').after('<div><span class="span-die text-warning">Вы не указали колонку <b>ЦЕНА</b> в списке</span></div>');
        }
        if ((cost_end > 0) && !(columnC) && (selected.length != 0)) {
            $('.cost_end-after').after('<div><span class="span-die text-warning">Вы не указали колонку <b>ЦЕНА</b> в списке</span></div>');
        }

        if ((str_articul) && (!columnA) && (selected.length != 0)) {
            $('.str_articul-after').after('<span class="span-die text-warning">Вы не указали колонку <b>Артикль</b> в списке</span>');
        }

        if ((str_product) && (!columnB) && (selected.length != 0)) {
            $('.str_product-after').after('<span class="span-die text-warning">Вы не указали колонку <b>Наименование товара</b> в списке</span>');
        }


        if ($(".span-die").hasClass("text-warning")) {
            return false;
        } else {
            $("#first_form").attr("action", "result.php?task=export");
        }
    });
});