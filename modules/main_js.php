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

function chooseDiagnosisType(url) {
    window.diagnosisUrl = url;
    $('#diagnosisTypeModal').modal('show');
}

function setSelectedOption(diagnosisType) {
    createCookie('DiagnosisType', diagnosisType, '10');
    window.location.href = window.diagnosisUrl;
}
</script>

<div class="modal" id="diagnosisTypeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Choose Diagnosis Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="custom-control custom-radio" onclick="setSelectedOption('preliminary')">
          <input type="radio" class="custom-control-input" id="preliminarydiag"  name="diagnosis">
          <label class="custom-control-label preliminarydiag" for="preliminarydiag">Preliminary Diagnosis</label>
        </div> <br>
         <div class="custom-control custom-radio" onclick="setSelectedOption('final')">
          <input type="radio" class="custom-control-input" id="finaldiag" name="diagnosis">
          <label class="custom-control-label finaldiag" for="finaldiag">Final Diagnosis</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>