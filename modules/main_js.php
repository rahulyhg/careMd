<script>

$(function() {
    $( document ).idleTimer("destroy");

	var timeOut = 200000;
    
    window.loginUrl = "<?php echo $root_path ?>"+ "main/login.php";


    $.getJSON("<?php echo $root_path ?>modules/sessionSetting.php", function(data) {
        
        timeOut = data.timeout;

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
<?php if($_COOKIE['PageName'] == "NHIF Claims" || $_COOKIE['PageName'] == "Discharge"): ?>
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

    $('.datatable2').DataTable();

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

// Diagnosis types
function chooseDiagnosisType(url) {
    window.diagnosisUrl = url;
    $('#diagnosisTypeModal').modal('show');
}

function setSelectedOption(diagnosisType) {
    createCookie('DiagnosisType', diagnosisType, '10');
    window.location.href = window.diagnosisUrl;
}

// un discharge patients

function showDischargedPatients(url) {
    $('#dischargePatientsModal').modal('show');
}

function unDischargePatient(encounterNr, name) {

    var r = confirm("Are you sure you want to un discharge " + name);
    if (r == true) {

         $.getJSON("./unDischargePatient.php?encounterNr="+encounterNr).done(function(data){

        if (data.updated) {
                $("#patient_"+encounterNr).fadeOut();
                alert('Successfully Un discharged '+ name);
            }
            console.log(data)
        }).fail(function(data){
          console.log(data);
        })

    }

   

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

<div class="modal" id="dischargePatientsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Discharged Patients (<?php echo date('d/m/Y') ?>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <?php

        require_once('./roots.php');
        require_once $root_path.'vendor/autoload.php';
        require_once $root_path.'generated-conf/config.php';
        $today = date('Y-m-d');
        use  CareMd\CareMd\CareEncounterQuery;
        use  CareMd\CareMd\CarePersonQuery;
        $patients = CareEncounterQuery::create()->filterByIsDischarged(1)->filterByDischargeDate($today)->find()->toArray();
        foreach ($patients as $key => $patient) {
            $patientRow = CarePersonQuery::create()->filterByPid($patient['Pid'])->findOne()->toArray();
            $patients[$key]['p_name'] = $patientRow['NameLast'] . " " . $patientRow['NameFirst'] . " " . $patientRow['Name2'] . " " . $patientRow['Name3'];
            $patients[$key]['birth_date'] = date('d/m/Y', strtotime($patientRow['DateBirth']));
        }
        ?>

       <div class="table-responsive">
            <table class="table datatable2 table-striped table-bordered" style="width:100%">
                <thead>
                    <tr >
                        <td>Surname/Ukoo, Name</td>
                        <td>Date of Birth</td>
                        <td>Hospital File nr</td>
                        <td>Admission Date</td>
                        <td>Discharge Time</td>
                        <td>Un Discharge</td>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($patients as $patient): ?>
                        <tr id="patient_<?php echo $patient['EncounterNr'] ?>">
                            <td><?php echo $patient['p_name'] ?></td>
                            <td><?php echo $patient['birth_date'] ?></td>
                            <td><?php echo $patient['Pid'] ?></td>
                            <td><?php echo date('d/m/Y', strtotime($patient['EncounterDate'])) ?></td>
                            <td><?php echo date('H:i:s', strtotime($patient['DischargeTime'])) ?></td>
                            <td>
                                <button class='btn btn-sm btn-info' onclick="unDischargePatient(<?php echo $patient['EncounterNr'] ?>, '<?php echo $patient['p_name'] ?>')">
                                   <i class="fa fa-close"></i>ud
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>

                </tbody>
            </table>
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>