<html>
@extends('layouts.master')
@section('content')
<head>
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
 <div class="text-center" >
        <a href="javascript:genPDF()" class="btn btn-primary">Download</a>
 </div>   
    <div class="card" id="pdf">   
        <div class="card-content">
            <h3 class="card-title text-center">{{\Auth::user()->company_name}}</h3>
        </div>
        <div id="chartContainer" style="height: 360px; width: 500px;"></div>
        <div style="margin-left: 8%;margin-top: 2%;margin-bottom: 4%;">
            <tr><b>Pendding Leads = </b></tr>
            <td>{{count($pendingLeads)}}</td>&nbsp;&nbsp;&nbsp;&nbsp;
            <tr><b>Lost Leads = </b></tr>
            <td>{{count($lostLeads)}}</td>&nbsp;&nbsp;&nbsp;&nbsp;
            <tr><b>Won Leads = </b></tr>
            <td>{{count($wonLeads)}}</td>
        </div>
        <!-- <div class="card-content">
            <h4 class="card-title text-center"><b>PENDING LEADS</b></h4>
            <div class="material-datatables table-responsive">
                <table id="invoices-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="80%" style="width: 80%">
                    <thead>
                    <tr>
                        <th>Lead Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Company</th>
                    </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>

            </div>
            <br>
            <h4 class="card-title text-center"><b>OWN LEADS</b></h4>
            <div class="material-datatables table-responsive">
                <table id="invoices-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="80%" style="width: 80%">
                    <thead>
                    <tr>
                        <th>Lead Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Company</th>
                    </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>

            </div>
            <br>
            <h4 class="card-title text-center"><b>LOST LEADS</b></h4>
            <div class="material-datatables table-responsive">
                <table id="invoices-table" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="80%" style="width: 80%">
                    <thead>
                    <tr>
                        <th>Lead Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Company</th>
                    </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>

            </div>
            </div> -->

        </div>
</body>

@endsection
</html>