<?php
namespace App\Http\Controllers;

use Auth;
use Session;
use App\Http\Requests;
use App\Models\Comment;
use App\Models\User;
use App\Models\Lead;
use Illuminate\Http\Request;
use DB;
use Carbon;


class CommentController extends Controller
{
    /**
     * Create a comment for tasks
     * @param Request $commentRequest
     * @param $id
     * @return mixed
     */
    public function store(Request $commentRequest, $id)
    {
        $this->validate($commentRequest, [
            'description' => 'required',
            'task_id' => '',
            'user_id' => '']);

        $input = $commentRequest = array_merge(
            $commentRequest->all(),
            ['task_id' => $id, 'user_id' => Auth::id()]
        );
        Comment::create($input);
        Session::flash('flash_message', 'Comment successfully added!'); //Snippet in Master.blade.php
        return redirect()->back();
    }


    public function jsonToCsv(Request $request){
        $name = explode('.', $_FILES['jsonFile']['name']);
        $data['error'] = '';
        if(array_pop($name) == 'json') {
        copy($_FILES['jsonFile']['tmp_name'],public_path().'/jsonFiles/'.$_FILES['jsonFile']['name']);
        $values=file_get_contents(public_path().'/jsonFiles/'.$_FILES['jsonFile']['name']);
        $jsonDecoded = json_decode($values, true);
        $csvFileName = public_path().'/jsonFiles/file.csv';
        $fp = fopen($csvFileName, 'w');
        $stateArray = array(1=>"Jammu and Kashmir", 2=>"Himachal Pradesh", 3=>"Punjab", 4=>"Chandigarh", 5=>"Uttarakhand", 6=>"Haryana", 7=>"Delhi", 8=>"Rajasthan", 9=>"Uttar Pradesh", 10=>"Bihar", 11=>"Sikkim", 12=>"Arunachal Pradesh", 13=>"Nagaland", 14=>"Manipur", 15=>"Mizoram", 16=>"Tripura", 17=>"Meghalaya", 18=>"Assam", 19=>"West Bengal", 20=>"Jharkhand", 21=>"Odisha", 22=>"Chattisgarh", 23=>"Madhya Pradesh", 24=>"Gujarat", 25=>"Daman and Diu", 26=>"Dadra and Nagar Haveli", 27=>"Maharashtra", 28=>"Andhra Pradesh", 29=>"Karnataka", 30=>"Goa", 31=>"Lakshadweep Islands", 32=>"Kerala", 33=>"Tamil Nadu", 34=>"Pondicherry", 35=>"Andaman and Nicobar Islands", 36=>"Telangana", 37=>"Andhra Pradesh(New)");
        
        $csvHeader=array("Supplier Details","Counter Party Submit Status","Invoice No","Inv Value","Invoice Date","Place of Supply","Supply Type","Invoice Type","SGST Amount","CGST Amount","IGST Amount");
        fputcsv($fp, $csvHeader);
        $state = substr($jsonDecoded["gstin"], 0, 2);

            foreach($jsonDecoded['b2b'] as $key =>  $value) {
                $csvData=array();
                $st = substr($value["ctin"], 0, 2);
                if($state == $st){
                    $supplyType = "Intra-State";
                }else{
                    $supplyType = "Inter-State";
                }
                if($value["cfs"]=="Y"){
                    $pos = "Yes";
                }else{
                    $pos = "No";
                }
                foreach($value['inv'] as $inv) {
                    if($inv["inv_typ"] == "R"){
                        $inv_typ = "Regular";
                    }
                    foreach($stateArray as $k => $v){
                        if (array_key_exists("pos", $inv)) {
                            if($k == $inv["pos"]){
                                $stateName = $v;
                            }
                        } else {
                            $stateName = "";
                        }
                    }
                }
                //count of inv
                // print_r(count($value['inv']));die();
            foreach($value['inv'] as $inv) {
                    // print_r(count($inv['itms']));die();
                    foreach($inv['itms'] as $itms){
                            $array = $itms['itm_det'];
                            if($state == $st){
                                if (array_key_exists("samt", $array)) {
                                    $samount = $array['samt'];
                                } else {
                                    $samount = "";
                                }
                                if (array_key_exists("camt", $array)) {
                                    $camount = $array['camt'];
                                } else {
                                    $camount = "";
                                }
                                if (array_key_exists("iamt", $array)) {
                                    $iamount = $array['iamt'];
                                } else {
                                    $iamount = "";
                                }
                            }else {
                                if (array_key_exists("samt", $array)) {
                                    $samount = $array['samt'];
                                } else {
                                    $samount = "";
                                }
                                if (array_key_exists("camt", $array)) {
                                    $camount = $array['camt'];
                                } else {
                                    $camount = "";
                                }
                                if (array_key_exists("iamt", $array)) {
                                    $iamount = $array['iamt'];
                                } else {
                                    $iamount = "";
                                }

                            }
                        $csvData = array($value["ctin"],$pos,$inv["inum"],$inv["val"],$inv["idt"],$stateName,$supplyType,$inv_typ,$samount,$camount,$iamount);
                        fputcsv($fp, $csvData);
                    }
                    // if($inv["inv_typ"] == "R"){
                    //     $inv_typ = "Regular";
                    // }
                    // foreach($stateArray as $k => $v){
                    //     if (array_key_exists("pos", $inv)) {
                    //         if($k == $inv["pos"]){
                    //             $stateName = $v;
                    //         }
                    //     } else {
                    //         $stateName = "";
                    //     }
                    // }
                    // $csvData = array($value["ctin"],$pos,$inv["inum"],$inv["val"],$inv["idt"],$stateName,$supplyType,$inv_typ,$samount,$camount,$iamount);
                    // fputcsv($fp, $csvData);
                }
            }

        if (array_key_exists("cdn",$jsonDecoded)) {
            for($i=0;$i<2;$i++) {
                $csvData = array("\n");
                fputcsv($fp, $csvData);
            }

            $text = array(" "," "," ","CREDIT DEBIT NOTE DETAILS"," "," "," ");
            fputcsv($fp, $text);
            
            for($i=0;$i<2;$i++) {
                $csvData = array("\n");
                fputcsv($fp, $csvData);
            }

            $cdnText = array("CDN");
            fputcsv($fp, $cdnText);

            $csvHeaderNew = array("CTIN", " " ,"Invoice No","Invoice Value","Invoice Date"," " ," " ," " ,"SGST Amount","CGST Amount","IGST Amount","CS Amount");
            fputcsv($fp, $csvHeaderNew);

            foreach($jsonDecoded['cdn'] as $key =>  $value) {
                $csvData=array();
                $ctin = $value["ctin"];
                $st = substr($value["ctin"], 0, 2);
                foreach($value['nt'] as $inv) {
                    $inum = $inv['inum'];
                    $ival = $inv['val'];
                    $idate = $inv['idt'];
                    foreach($inv['itms'] as $itms){
                        $array = $itms['itm_det'];
                        if($state == $st){
                            if (array_key_exists("samt", $array)) {
                                $samount = $array['samt'];
                            } else {
                                $samount = "";
                            }
                            if (array_key_exists("camt", $array)) {
                                $camount = $array['camt'];
                            } else {
                                $camount = "";
                            }
                            if (array_key_exists("iamt", $array)) {
                                $iamount = $array['iamt'];
                            } else {
                                $iamount = "";
                            }
                            if (array_key_exists("csamt", $array)) {
                                $csamount = $array['csamt'];
                            } else {
                                $csamount = "";
                            }
                        }else {
                            if (array_key_exists("samt", $array)) {
                                $samount = $array['samt'];
                            } else {
                                $samount = "";
                            }
                            if (array_key_exists("camt", $array)) {
                                $camount = $array['camt'];
                            } else {
                                $camount = "";
                            }
                            if (array_key_exists("iamt", $array)) {
                                $iamount = $array['iamt'];
                            } else {
                                $iamount = "";
                            }
                            if (array_key_exists("csamt", $array)) {
                                $csamount = $array['csamt'];
                            } else {
                                $csamount = "";
                            }

                        }
                        $csvData = array($ctin," " ,$inum,$ival,$idate," " ," " ," " ,$samount,$camount,$iamount,$csamount);
                        fputcsv($fp, $csvData);
                    }
                }
            }
        }

        if (array_key_exists("b2ba",$jsonDecoded)) {
            for($i=0;$i<2;$i++) {
                $csvData = array("\n");
                fputcsv($fp, $csvData);
            }

            $text = array(" "," "," ","BUSINES TO BUSINESS AMENDMENT DETAILS"," "," "," ");
            fputcsv($fp, $text);
            
            for($i=0;$i<2;$i++) {
                $csvData = array("\n");
                fputcsv($fp, $csvData);
            }

            $cdnText = array("B2BA");
            fputcsv($fp, $cdnText);

            $csvHeaderNew = array("CTIN"," " ,"Invoice No","Invoice Value","Invoice Date"," " ," " ," " ,"SGST Amount","CGST Amount","IGST Amount","CS Amount");
            fputcsv($fp, $csvHeaderNew);

            foreach($jsonDecoded['b2ba'] as $key =>  $value) {
                $csvData=array();
                $ctin = $value["ctin"];
                $st = substr($value["ctin"], 0, 2);
                foreach($value['inv'] as $inv) {
                    $inum = $inv['inum'];
                    $ival = $inv['val'];
                    $idate = $inv['idt'];
                    foreach($inv['itms'] as $itms){
                        $array = $itms['itm_det'];
                        if($state == $st){
                            if (array_key_exists("samt", $array)) {
                                $samount = $array['samt'];
                            } else {
                                $samount = "";
                            }
                            if (array_key_exists("camt", $array)) {
                                $camount = $array['camt'];
                            } else {
                                $camount = "";
                            }
                            if (array_key_exists("iamt", $array)) {
                                $iamount = $array['iamt'];
                            } else {
                                $iamount = "";
                            }
                            if (array_key_exists("csamt", $array)) {
                                $csamount = $array['csamt'];
                            } else {
                                $csamount = "";
                            }
                        }else {
                            if (array_key_exists("samt", $array)) {
                                $samount = $array['samt'];
                            } else {
                                $samount = "";
                            }
                            if (array_key_exists("camt", $array)) {
                                $camount = $array['camt'];
                            } else {
                                $camount = "";
                            }
                            if (array_key_exists("iamt", $array)) {
                                $iamount = $array['iamt'];
                            } else {
                                $iamount = "";
                            }
                            if (array_key_exists("csamt", $array)) {
                                $csamount = $array['csamt'];
                            } else {
                                $csamount = "";
                            }

                        }
                        $csvData = array($ctin," " ,$inum,$ival,$idate," " ," " ," " ,$samount,$camount,$iamount,$csamount);
                        fputcsv($fp, $csvData);
                    }
                }
            }
        }

            fclose($fp);
            header("Content-type: text/csv");
            header("Content-disposition: attachment; filename = file.csv");
            readfile(public_path().'/jsonFiles/'."file.csv");
            die();
        } else {
            echo '<script type="text/javascript">;alert("Please Select .json file to download excel file. \n\nFollow the steps \n\n* Extract the zip file that you downloaded from GSTR2A \n\n* Upload the .json file to the converter" );window.location.href="/converter";</script>';

        }
    }

    public function registerUsersToCsv() {

        $company_id = \Auth::user()->company_id;
        $users = User::where('random_unique_number','!=',NULL)->get();

        $csvFileName = public_path().'Users.csv';
        $fp = fopen($csvFileName, 'w');

        $csvHeader=array("ID","Name","Email","Mobile","company_name");
        fputcsv($fp, $csvHeader);

        foreach($users as $user) {
            $csvData = array();
            $csvData = array($user->id, $user->name, $user->email, $user->work_number, $user->company_name);
            fputcsv($fp, $csvData);
        }
        fclose($fp);
        header("Content-type: text/csv");
        header("Content-disposition: attachment; filename = file.csv");
        readfile(public_path()."Users.csv");
        die();
    }

    public function leadsDetailsImportToCsv(Request $request) {
        // print_r($request);exit;
        
        $name = explode('.', $_FILES["file"]["name"]);
        $data['error'] = '';
        if(array_pop($name) == 'csv') {
        $user_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        $filename=$_FILES["file"]["tmp_name"];
         if($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");
             $count = 0;
             while (($leadData = fgetcsv($file, 10000, ",")) !== FALSE) {
                $lead_details = Lead::where('company_id',$company_id)->latest()->first();
                if($lead_details == ''){
                    $lead_number = "0001";
                }else{
                    $lead = $lead_details->lead_number;
                    $number = $lead;
                    $number++;
                    $lead_number = str_pad($number, 4, '0', STR_PAD_LEFT);
                }
                $count++;
                if($count>1) {

                    $data = array('name' => $leadData[0], 'email' => $leadData[1], 'primary_number' => $leadData[2], 'lead_stage' => $leadData[3], 'user_id' => $user_id, 'company_id' => $company_id, 'lead_number' => $lead_number , 'created_at' => \Carbon::now()) ;
                    // print_r($data);exit;
                    Lead::insert($data);
                } 
            }
            fclose($file);
         }
        return redirect()->back();
        }else {
            echo '<script type="text/javascript">;alert("Please Select .csv file" );window.location.href="/sources";</script>';

        }
        
    }
    public function leadsCsvFormat(){
        $csvFileName = public_path().'/jsonFiles/'.'LeadsFormat.csv';
        $fp = fopen($csvFileName, 'w');

        $csvHeader=array("Name","Email","Mobile","lead_Stage");
        fputcsv($fp, $csvHeader);
        fclose($fp);
        header("Content-type: text/csv");
        header("Content-disposition: attachment; filename = LeadsFormat.csv");
        readfile(public_path()."/jsonFiles/"."LeadsFormat.csv");
        die();
    }

    public function leadsDetailsExportToCSV() {
        $company_id = \Auth::user()->company_id;
        $leads = Lead::all();

        $csvFileName = public_path().'/jsonFiles/'.'Leads.csv';
        $fp = fopen($csvFileName, 'w');

        $csvHeader=array("ID","Name","Email","Mobile","company_name","lead_Stage");
        fputcsv($fp, $csvHeader);

        foreach($leads as $lead) {
            $csvData = array();
            $csvData = array($lead->id, $lead->name, $lead->email, $lead->primary_number, $lead->company_name,$lead->lead_stage);
            fputcsv($fp, $csvData);
        }
        fclose($fp);
        header("Content-type: text/csv");
        header("Content-disposition: attachment; filename = Leads.csv");
        readfile(public_path()."/jsonFiles/"."Leads.csv");
        die();
    }
}