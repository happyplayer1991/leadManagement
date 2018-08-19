<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
</style>
</head>
<body>
<div>
    <p><b>&nbsp;PENDING LEADS</b></p>
        <table style="width:100%">
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
        <table style="width:100%">
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
        <table style="width:100%">
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
</div>
</body>
</html>