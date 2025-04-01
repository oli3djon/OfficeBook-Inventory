$(function () {

    var isscrolly = '600';
    var scr_w = screen.width;
    if(scr_w > 801){
        isscrolly = '';
    }

    $('#tabledata').DataTable( {
        scrollY      : isscrolly,
        paging       : true,
        lengthChange : true,
        searching    : true,
        ordering     : true,
        info         : true,
        autoWidth    : isscrolly,
        aLengthMenu: [[100, 50, 25, 10, -1], [100, 50, 25, 10, "Все"]],
        language: {
            processing:     "Обработка...",
            search:         "Поиск&nbsp;:",
            lengthMenu:     "Показывать по _MENU_ записей",
            info:           "Показаны от _START_ до _END_ из _TOTAL_ записей",
            infoEmpty:      "Нет записей для отображения",
            infoFiltered:   "(фильтруется из _MAX_ записей)",
            infoPostFix:    "",
            loadingRecords: "Загрузка...",
            zeroRecords:    "Нет записей для отображения",
            emptyTable:     "В таблице нет данных",
            paginate: {
                first:      "Первый",
                previous:   "Назад",
                next:       "Вперед",
                last:       "Последний"
            },
            aria: {
                sortAscending:  ": активировать сортировку столбца в порядке возрастания",
                sortDescending: ": активировать сортировку столбца в порядке убывания"
            }
        }
    } );
    
    $.get("http://ipinfo.io", function(response) {
        if(response.country == "UA") {
            $("#telwork").inputmask({"mask": "+38 (099) 999-99-99"});
            $("#telpersonal").inputmask({"mask": "+38 (099) 999-99-99"});
        }
        else if(response.country == "RU") {
            $("#telwork").inputmask({"mask": "+7 (999) 999-99-99"});
            $("#telpersonal").inputmask({"mask": "+7 (999) 999-99-99"});
        
        }
        else {
           $("#telwork").inputmask({"mask": ""});
           $("#telpersonal").inputmask({"mask": ""});
        }
    }, "jsonp");
})