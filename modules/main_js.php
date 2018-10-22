<script>

$(function() {

	var timeOut = 100;
    // $( document ).idleTimer("destroy");
    

	$.getJSON("<?php echo $root_path ?>modules/sessionSetting.php").done(function(response){

        timeOut = response.timeout;
        window.loginUrl = response.loginUrl;

        $( document ).idleTimer( {
            timeout: timeOut, 
            idle: true
        });

	}).fail(function(data){
	 
      console.log(data);
	})
    console.log(timeOut)

    $( document ).on( "idle.idleTimer", function(event, elem, obj){
        console.log(timeOut)
        // window.location.href = window.loginUrl;

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

});

</script>
