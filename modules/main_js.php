<script>

$(function() {

	var timeOut = 100000;
    // $( document ).idleTimer("destroy");
    
    window.loginUrl = "<?php echo $root_path ?>"+ "main/login.php";

	$.getJSON("<?php echo $root_path ?>modules/sessionSetting.php").done(function(response){

        timeOut = response.timeout;
        console.log(response.timeout)

        $( document ).idleTimer( {
            timeout: timeOut, 
            idle: true
        });

       

	}).fail(function(data){
	 
      console.log(data);
	})

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

});

</script>
