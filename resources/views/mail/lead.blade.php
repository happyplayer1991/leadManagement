
@if($type == 'create')
<p>New Lead is created by {{$creator}}.</p>
@endif
<p>Lead information</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Lead Name: {{$lead->name}}</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Lead Email: {{$lead->email}}</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Phone Number: {{$lead->primary_number}}</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;- Lead Type: {{$lead->lead_type}}</p>

<p>Incase of any doubts, do revert to us at the earliest and oblige</p>

<p>With regards,</p>

<p>John Smith</p>
<p>CEO of XXXXXX</p>
<p>johnsmith@mail.com</p>

<a href="http://financierdirect.nl">Opal CRM</a>