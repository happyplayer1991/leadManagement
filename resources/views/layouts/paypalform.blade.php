@if(Request::server ("SERVER_NAME") == "dev.opalcrm.com")
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="post_paypal">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="QZFT93X7MX7X4">
	@if($type == "popOver")
	<input type="hidden" name="user_id" value="{{Auth::id()}}">
	<input type="hidden" name="company_id"  value="{{\Auth::user()->company_id}}">
	@else
	<input type="hidden" name="user_id" value="{{$user->id}}">
	<input type="hidden" name="company_id"  value="{{$user->company_id}}">
	@endif

	<table>
	<tr><td><input type="hidden" name="on0" value=""></td></tr><tr><td>
	<select name="os0">
	    <option value="3 Users - 12%">3 Users - 12% : $300.00 USD - yearly</option>
	    <option value="5 Users - 20%">5 Users - 20% : $480.00 USD - yearly</option>
	    <option value="3 Users Monthly">3 Users Monthly : $30.00 USD - monthly</option>
	</select> </td></tr>
	</table>
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" id="paypal_form">
	<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
@endif
@if(Request::server ("SERVER_NAME") == "opalcrm.kloudportal.com")
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" id="post_paypal">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="H6GDNYXD3VGT4">
		@if($type == "popOver")
		<input type="hidden" name="user_id" value="{{Auth::id()}}">
		<input type="hidden" name="company_id"  value="{{\Auth::user()->company_id}}">
		@else
		<input type="hidden" name="user_id" value="{{$user->id}}">
		<input type="hidden" name="company_id"  value="{{$user->company_id}}">
		@endif
	<table>
	<tr><td><input type="hidden" name="on0" value="Payment Options">Payment Options</td></tr><tr><td><select name="os0">
	 <option value="3 Users - 12% Discount">3 Users - 12% Discount : $300.00 USD - yearly</option>
	 <option value="5 Users - 20% Discount">5 Users - 20% Discount : $480.00 USD - yearly</option>
	 <option value="3 Users Monthly">3 Users Monthly : $30.00 USD - monthly</option>
	</select> </td></tr>
	</table>
	<input type="hidden" name="currency_code" value="USD">
	<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!" id="paypal_form">
	<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>
@endif