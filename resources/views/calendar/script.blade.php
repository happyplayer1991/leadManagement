<script>
	var optionsObject = {!! $options !!};
	optionsObject.eventClick = function(eventObj) {
		alert(eventObj.status+'\n'+eventObj.details+'\n'+eventObj.name+'\n'+eventObj.start_date);
	}
	$(document).ready(function(){
        $('#calendar-{{ $id }}').fullCalendar(optionsObject);
    });
</script>
