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
        format: 'dd/MM/yyyy',
    });


    $('#datepicker1').dateTimePicker({
        mode: 'date',
        format: 'dd/MM/yyyy'
    });


    $('#datepicker2').dateTimePicker({
        mode: 'date',
        format: 'dd/MM/yyyy'
    });
<?php if($_COOKIE['PageName'] == "NHIF Claims" || $_COOKIE['PageName'] == "Discharge" || $_COOKIE['PageName'] == "Pharmacy" ||  $_COOKIE['PageName'] == "System Admin" || $_COOKIE['PageName'] == "Inpatient"  || $_COOKIE['PageName'] == "Ambulatory" || $_COOKIE['PageName'] == "Reporting" ): ?>
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

    $('.datatable2').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('.datatable3').DataTable( {
      "pageLength": 15
    } );

});
<?php endif ?>


});


$('.referalInputs').hide();
$('.allergydetails').hide();


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

$('.uVisitType').change(function(){

    var uVisitType = $('input[name=uVisitType]:checked').val();

    if (uVisitType == 3) 
    {
        $('.referalInputs').show();

    }else
    {
        $('.referalInputs').hide();
    }
})


$('.allergic').change(function(){

    var isAllergic = $('input[name=allergic]:checked').val();
    if (isAllergic ==1) 
    {
      $('.allergydetails').show();

    }else{
      $('#allergicd').val('');
      $('.allergydetails').hide();
    }
})

var isAllergic = $('input[name=allergic]:checked').val();
if (isAllergic ==1) 
{
  $('.allergydetails').show();

}else{
  $('.allergydetails').hide();
}

$(".acceptBtn").click(function(e){
    e.preventDefault();

    $(".acceptBtn").hide();
    $(".rejectBtn").hide();
    $(".sendBtn").show();

})

$(".rejectBtn").click(function(e){
    e.preventDefault();
    var url = $(".rejectBtn").attr("href");
    url += "&rejected=1";
    window.location.href = url;
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

function showDatepicker(){
    $('#datepicker10').dateTimePicker({
        mode: 'date',
        format: 'dd/MM/yyyy',
        constrainInput: false
    });
}

function setSelectedBloodGroup() {
  var selectedBgroup = $('#blood_group_id').find(":selected").text();

   $.get(
        'bloodGroupOrder.php',
        {group_id: selectedBgroup},
        function(result) {
          $("#order_test_group").empty();
          $("#order_test_group").append('<option value="0">-- Select --</option>');
          if(result.relatedGroups.length)
          {
              for(var i=0, len=result.relatedGroups.length; i<len; i++) 
              {
                  $("#order_test_group").append('<option value="' + result.relatedGroups[i]['nr'] + '">' + result.relatedGroups[i]['name'] +'</option>'); 
              }
          }                       
        },
        "json");

}
var selectedBgroup = $('#blood_group_id').find(":selected").text();
$.get(
  'bloodGroupOrder.php',
  {group_id: selectedBgroup},
  function(result) {
    $("#order_test_group").empty();
    $("#order_test_group").append('<option value="0">-- Select --</option>');
    if(result.relatedGroups.length)
    {
        for(var i=0, len=result.relatedGroups.length; i<len; i++) 
        {
            $("#order_test_group").append('<option value="' + result.relatedGroups[i]['nr'] + '">' + result.relatedGroups[i]['name'] +'</option>'); 
        }
    }                       
  },
  "json");

<?php if($hospitalCode): ?>
function updateNHIFPrices() {
    
    $(".updateNHIFBtn").prop("disabled",true);
    $(".updateNHIFBtn").html('Updating Prices Please Wait')
    var accessToken = null;



    var logindata = {
      grant_type: "password",
      username: "<?php echo $nhif_user; ?>",
      password: "<?php echo $nhif_pwd; ?>"
    };
    
    var url = "<?php echo $nhif_claim_server; ?>/Token";
    $.ajax(url, {
      type: "POST",
      data: logindata,
      timeout: 10000
    })
    .done(function(data) {
        accessToken = data.access_token;
        GetAndUpdatedNHIFPrices(accessToken);
      })
    .fail(function(data) {
        ProgressDestroy();
        if (data.status === 400) {
          alert(
            "Error Login in to NHIF Server!\n" +
              JSON.stringify(data.responseJSON.error_description)
          );
        } else {
          alert(
            "Error Login in to NHIF Server!\n\nPlease check your network connection\nor contact your administrator!"
          );
        }
    });

}

function GetAndUpdatedNHIFPrices(accessToken) {

    $.ajax(
        "<?php echo $nhif_claim_url; ?>?FacilityCode=" + <?php echo $hospitalCode ?>,
        {
          headers: { Authorization: "Bearer " + accessToken },
          xhrFields: {
            withCredentials: true
          }
        }
    )
    .done(function(nhifData) {

        $.post("<?php echo $root_path ?>modules/nhifPriceList.php",
        {formdata: JSON.stringify(nhifData)},
        function(data, status){
            if (data.success == 1) {
                 if (confirm('Prices were Successfully updated')) {
                   window.location.reload();
                }
            }
           
        });

    })
    .fail(function(data) {
      ProgressDestroy();
      if (data.status === 0) {
        alert(
          "Error Connecting to NHIF Server!\n\nPlease check your network connection!"
        );
      } else {
        if (data.status === 404) {
          $(".card_status").append("Card Not Found!");
          $(".authorization").append("REJECTED");
        } else {
          alert(JSON.stringify(data.responseText));
        }
      }
    });
}

<?php endif ?>


function deletePrescription(url) {
  $('#deletePrescriptionModal').modal('show');
  window.deletePrescriptionUrl = url;
}

$("document").ready(function(){
  $( ".deletePrescriptionForm" ).submit(function( event ) {

    var deleteReason = $("#deleteReasons").val();
    url = window.deletePrescriptionUrl + "&delete_reason="+deleteReason;
    window.location.href = url;

    event.preventDefault();
  });

})

$(function () {
  $('[data-toggle="popover"]').popover({'trigger': 'hover'})
})

 $(".resultfileform").submit(function(evt){   
  alert('bumtititng')
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: 'fileUpload',
       type: 'POST',
       data: formData,
       async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function (response) {
         alert(response);
       }
   });
   return false;
 });

</script>

<div class="modal" id="diagnosisTypeModal" style="display: none" tabindex="-1" role="dialog">
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

<div class="modal" id="dischargePatientsModal" style="display: none" tabindex="-1" role="dialog">
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


<div class="modal" id="deletePrescriptionModal" style="display: none" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form name="deletePrescriptionForm" class="deletePrescriptionForm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Prescription</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <label for="deleteReasons">Delete Reasons</label><br><br>
        <textarea name="deleteReasons" minlength="10" required="" class="" autofocus="" id="deleteReasons" cols="60" rows="8"></textarea>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary" >Delete</button>
      </div>

    </div>
      </form>

  </div>
</div>