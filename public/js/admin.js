$(function () {
    
    $(function () {

        var isscrolly = '600';
        var scr_w = screen.width;
        if(scr_w > 801){
            isscrolly = '';
        }

        $('#tabledata').DataTable({
            'scrollY'      : isscrolly,
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'aLengthMenu': [[100, 50, 25, 10, -1], [100, 50, 25, 10, "Все"]],
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
        })

        //Initialize Select2 Elements
        $('.select2').select2()

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm-dd-yyyy', { 'placeholder': 'mm-dd-yyyy' })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        })

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass   : 'iradio_minimal-blue'
        })
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass   : 'iradio_minimal-red'
        })
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        //Timepicker
        $('.timepicker').timepicker({
            showInputs: false
        })
    })
    
    $.get("http://ipinfo.io", function(response) {
        if(response.country == "UA") {
            if(!telwork.value){
                $("#telwork").inputmask({"mask": "+38 (099) 999-99-99"});
            }
            if(!telpersonal.value){
                $("#telpersonal").inputmask({"mask": "+38 (099) 999-99-99"});
            }
        }
        else if(response.country == "RU" || response.country == "KZ") {
            if(!telwork.value){
                $("#telwork").inputmask({"mask": "+7 (999) 999-99-99"});
            }
            if(!telpersonal.value){
                $("#telpersonal").inputmask({"mask": "+7 (999) 999-99-99"});
            }
        }
        else if(response.country == "BY") {
            if(!telwork.value){
                $("#telwork").inputmask({"mask": "+37 (599) 999-99-99"});
            }
            if(!telpersonal.value){
                $("#telpersonal").inputmask({"mask": "+37 (599) 999-99-99"});
            }
        }
        else {
           $("#telwork").inputmask({"mask": ""});
           $("#telpersonal").inputmask({"mask": ""});
           telwork.placeholder = '+...';
           telpersonal.placeholder = '+...';
        }
    }, "jsonp");
})