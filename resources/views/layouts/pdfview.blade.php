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
				{ y: {{ count($pendingLeads) }}, indexLabel:"PendingLeads" }, 
				{ y: {{ count($lostLeads) }}, indexLabel:"LostLeads" },
				{ y: {{ count($wonLeads) }}, indexLabel:"WonLeads" }
			]
		}
		]
});
chart.render();
}
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
<script scr="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
</head>
<body>
<a href="javascript:genPDF()">Download</a>
<br>
<div id="pdf">
<div align="center">
	<p style="margin-top: -3px;font-size: 24px; "><b>{{\Auth::user()->company_name}}</b></p>
</div>
    <br>
<div id="chartContainer" style="height: 360px; width: 500px; text-align:left;"></div>
 <!--    <br>
    <br>
<div>
    <p><b>&nbsp;PENDING LEADS</b></p>
        <table>
            <tr><th>Lead Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
            </tr>
            @foreach($leads as $lead)
            @if($lead->drop_status == "")
                @if($lead->lead_stage != "Won")
            <tr>
                <td>{{$lead->name}}</td>
                <td>{{$lead->primary_number}}</td>
                <td>{{$lead->email}}</td>
                <td>{{$lead->company_name}}</td>
            </tr>
            @endif
            @endif
            @endforeach
        </table>
</div>
    <br>
<div>
    <p><b>&nbsp;OWN LEADS</b></p>
        <table>
            <tr><th>Lead Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
            </tr>
            @foreach($leads as $lead)
            @if($lead->lead_stage == "Won")
            <tr>
                <td>{{$lead->name}}</td>
                <td>{{$lead->primary_number}}</td>
                <td>{{$lead->email}}</td>
                <td>{{$lead->company_name}}</td>
            </tr>
            @endif
            @endforeach
        </table>
</div>
    <br>
<div>
    <p><b>&nbsp;LOST LEADS</b></p>
        <table>
            <tr><th>Lead Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Company</th>
            </tr>
            @foreach($leads as $lead)
            @if($lead->drop_status != "")
            <tr>
                <td>{{$lead->name}}</td>
                <td>{{$lead->primary_number}}</td>
                <td>{{$lead->email}}</td>
                <td>{{$lead->company_name}}</td>
            </tr>
            @endif
            @endforeach
        </table>
</div> -->
</div>
</body>
</html>