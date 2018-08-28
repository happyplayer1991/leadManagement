<?php
namespace App\Helper;

use App\Models\Voucher;
use App\Models\LeadDetails;
use App\Models\Lead;
use App\Models\Quotation;
use App\Models\Invoice;





class Helper
{
    public static function leadNumber(){
		$company_id = \Auth::user()->company_id;
		$lead_details = Lead::where('company_id',$company_id)->latest()->first();

		if($lead_details == ''){
			$lead_number = "L0001";
		}else{
			$lead = $lead_details->lead_number;
        	$number = $lead;
        	$number++;
        	$lead_number = str_pad($number, 4, '0', STR_PAD_LEFT);
		}

		return $lead_number;
	}

	public static function leadNumberWithCompany($company_id){
		//$company_id = \Auth::user()->company_id;
		$lead_details = Lead::where('company_id',$company_id)->latest()->first();

		if($lead_details == ''){
			$lead_number = "L0001";
		}else{
			$lead = $lead_details->lead_number;
        	$number = $lead;
        	$number++;
        	$lead_number = str_pad($number, 4, '0', STR_PAD_LEFT);
		}

		return $lead_number;
	}

	public static function quotation_code($url){
		$company_id = \Auth::user()->company_id;
		$company_name = \Auth::user()->company_name;

		if($url == "quote"){
			$quote_details = Quotation::where('company_id',$company_id)->latest()->first();


	        if($quote_details == ''){
	        	$quotation_code = "0001";
	        }else{
	        	$quote = $quote_details->quotation_number;
	        	$number = $quote;
	        	$number++;
	        	$quotation_code = str_pad($number, 4, '0', STR_PAD_LEFT);
	        }

	        return $quotation_code;
		}else{
			$invoices = Invoice::where('company_id',$company_id)->latest()->first();
			if($invoices == ''){
	        	$invoice_code = "0001";
	        }else{
	        	$quote = $invoices->invoice_number;
	        	$number = $quote;
	        	$number++;
	        	$invoice_code = str_pad($number, 4, '0', STR_PAD_LEFT);
	        }

	        return $invoice_code;

		}


	}


	public static function leadStatus(){
		$lead_status = array('Lead' => 'Lead','Opportunity' => 'Opportunity', 'Quote' => 'Quote','Won' =>'Won','Drop' => 'Drop');

		return $lead_status;
	}

	public static function leadSource(){
		$lead_source = array('Web' => 'Web','Chat' => 'Chat', 'Phone' => 'Phone' ,'Referal' => 'Referal', 'Blogs' =>'Blogs', 'Social Media' => 'Social Media', 'Events' => 'Events' ,'Advertisements' => 'Advertisements' ,'Manually By Web' => 'Manually By Web');

		return $lead_source;
	}


}

?>