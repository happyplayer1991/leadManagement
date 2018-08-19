<html>
<head>
<style type="text/css">
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 60%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 6px;
}
</style>
<script src="html2canvas.js"></script>
<script type="text/javascript">
    function genPDF() {
       html2canvas(document.getElementById("pdf"), {
           onrendered: function(canvas) {
               var img = canvas.toDataURL("image/png");
               var doc = new jsPDF();
               doc.addImage(img,'JPEG',0,0);
               doc.save("download.pdf");
           } 
           
       });     
    } 
    window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer",
{
		data: [
		{
			type: "pie",
            showInLegend: true,
			legendText: "{indexLabel}",
			dataPoints: [  
				{ y: {{ count($closed_activities) }}, indexLabel:"ClosedActivities" },
                { y: {{ count($pending_activities) }}, indexLabel:"PendingActivities" }
			]
		}
		]
});
chart.render();
}
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
</head>
<body>
<a href="javascript:genPDF()">Download</a>
<br>
<div id="pdf">
<div align="center">
	<p style="margin-top: -3px;font-size: 24px; "><b>{{\Auth::user()->company_name}}</b></p>
</div>
   <br> 
<div id="chartContainer" style="height: 360px; width: 560px;text-align:left;"></div>
<!--     <br>
    <br>
<div>
    <p><b>&nbsp;OPEN ACTIVITIES</b></p>
        <table>
            <tr>
                <th>Activity Type</th>
                <th>Date</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
            @foreach($activities as $activity)
            @if($activity->status == "Scheduled")
            <tr>
                <td>{{($activity->name)}}</td>
                <td>{{ date('d/m/Y', strtotime($activity->date))}}</td>
                <td>{{($activity->status)}}</td>
                <td>{{($activity->details)}}</td>
            </tr>
            @endif
            @endforeach
        </table>
</div>
    <br>
<div>
    <p><b>&nbsp;CLOSED ACTIVITIES</b></p>
        <table>
            <tr>
                <th>Activity Type</th>
                <th>Date</th>
                <th>Status</th>
                <th>Details</th>
            </tr>
            @foreach($activities as $activity)
            @if($activity->status == "Completed")
            <tr>
                <td>{{($activity->name)}}</td>
                <td>{{ date('d/m/Y', strtotime($activity->date))}}</td>
                <td>{{($activity->status)}}</td>
                <td>{{($activity->details)}}</td>
            </tr>
            @endif
            @endforeach
        </table>
</div> -->
    </div>
    </body>
</html>