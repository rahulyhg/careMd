<script>

$(function() {

	var timeOut = 1000000;
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
    

    $( document ).on( "idle.idleTimer", function(event, elem, obj){

        window.location.href = window.loginUrl;

    });
});

</script>
