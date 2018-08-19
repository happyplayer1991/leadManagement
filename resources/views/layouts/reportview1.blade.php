<html>
@extends('layouts.master')
@section('content')
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
    <div class="text-center" >
        <a href="javascript:genPDF()" class="btn btn-primary">Download</a>
    </div>
    <div id="pdf">
    <div class="card">
        <div class="card-content">
            <h4 class="card-title text-center"><b>{{\Auth::user()->company_name}}</b></h4>
            </div>
            <div>
                <div class="card">
                    <div id="chartContainer" style="height: 360px; width: 500px;"></div>
                     <div style="margin-left: 8%;margin-top: 2%;margin-bottom: 4%;">
                        <tr><b>Open Activities = </b></tr>
                        <td>{{count($pending_activities)}}</td>&nbsp;&nbsp;&nbsp;&nbsp;
                        <tr><b>Closed Activities = </b></tr>
                        <td>{{count($closed_activities)}}</td>
                    </div>
                    <!-- <div class="card-content">
                        <h4 class="card-title text-center"><b>OPEN ACTIVITIES</b></h4>
                        <div class="material-datatables table-responsive">
                            <table id="invoices-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="80%" style="width: 80%">
                                <thead>
                                <tr>
                                    <th>Activity Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h4 class="card-title text-center"><b>CLOSED ACTIVITIES</b></h4>
                        <div class="material-datatables table-responsive">
                            <table id="invoices-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="80%" style="width: 80%">
                                <thead>
                                <tr>
                                    <th>Activity Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</body>
@endsection
</html>