<script>

$(function() {
    $( document ).idleTimer("destroy");

	var timeOut = 200000;
    
    window.loginUrl = "<?php echo $root_path ?>"+ "main/login.php";


    $.getJSON("<?php echo $root_path ?>modules/sessionSetting.php", function(data) {
        
        timeOut = data.timeout;
        console.log(data.timeout)

        $( document ).idleTimer( {
            timeout: timeOut, 
            idle: true
        });


    }).fail( function(data, textStatus, error) {
         console.log(error);
    });


    $( document ).on( "idle.idleTimer", function(event, elem, obj){
        window.location.href = window.loginUrl;
    });
    

    $('#datepicker').dateTimePicker({
        mode: 'date',
        format: 'dd/MM/yyyy'
    });


    $('#datepicker1').dateTimePicker({
        mode: 'date',
        format: 'dd/MM/yyyy'
    });


    $('#datepicker2').dateTimePicker({
        mode: 'date',
        format: 'dd/MM/yyyy'
    });
<?php if($_COOKIE['PageName'] == "NHIF Claims"): ?>
$(document).ready(function () {
    $('.datatable').DataTable(
    {
        scrollX: true,
        scrollCollapse: true,
        fixedHeader: {
            header: false,
            footer: false
        },
        responsive: true,
        columnDefs: [
            {responsivePriority: 1, targets: 0},
            {responsivePriority: 2, targets: -1},
            {responsivePriority: 3, targets: -2}
        ]
    });

     // var date_from = $('input[name="date_from"]'); //our date input has the name "date"
     //    var date_to = $('input[name="date_to"]'); //our date input has the name "date"
     //    var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
     //    var options = {
     //        format: 'yyyy-mm-dd',
     //        container: container,
     //        todayHighlight: true,
     //        autoclose: true,
     //        showDropdowns: true,
     //    };
     //    date_from.datepicker(options);
     //    date_to.datepicker(options);

});
<?php endif ?>


});


$('.referalInputs').hide();


$('.visitType').change(function(){

    var isNHIF = $(".nhifRadio").is(':checked');

    if (isNHIF) 
    {
        $('.referalInputs').show();

    }else
    {
        $('.referalInputs').hide();
    }
})
</script>