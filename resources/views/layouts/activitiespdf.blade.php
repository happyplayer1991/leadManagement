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
    <p><b>&nbsp;OPEN ACTIVITIES</b></p>
        <table style="width:100%">
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
        <table style="width:100%">
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
</div>
</body>
</html> 