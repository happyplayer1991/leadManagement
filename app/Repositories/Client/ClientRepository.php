<?php
namespace App\Repositories\Client;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Industry;
use App\Models\Invoices;
use App\Models\User;
use DB;
/**
 * Class ClientRepository
 * @package App\Repositories\Client
 */
class ClientRepository implements ClientRepositoryContract
{
    const CREATED = 'created';
    const UPDATED_ASSIGN = 'updated_assign';

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Lead::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function listAllClients()
    {
        return Lead::pluck('name', 'id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getInvoices($id)
    {
        $invoice = Lead::findOrFail($id)->invoices()->with('tasktime')->get();

        return $invoice;
    }

    /**
     * @return int
     */
    public function getAllClientsCount()
    {
        return Lead::all()->count();
    }

    /**
     * @return mixed
     */
    public function listAllIndustries()
    {
        return Industry::pluck('name', 'id');
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        $client = Lead::create($requestData);
        $insertedId = $client;
       // Session()->flash('flash_message', 'Client successfully added');
        event(new \App\Events\ClientAction($client, self::CREATED));
        
        return $insertedId;
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function update($id, $requestData)
    {
        $client = Lead::findOrFail($id);
       // print_r($client);exit;
       // $client->fill($requestData->all())->save();
       
        if($requestData->lead_status == "Drop"){
        	if($requestData->comment == ""){
        		return "comment";
        	}
        	$client->name = $requestData->name;
        	$client->email = $requestData->email;
        	$client->company_name = $requestData->company_name;
        	$client->primary_number = $requestData->primary_number;
        	$client->secondary_number = $requestData->secondary_number;
        	$client->address = $requestData->address;
        	$client->pin = $requestData->pin;
        	$client->fax = $requestData->fax;
        	$client->country = $requestData->country;
        	$client->source_type = $requestData->source_type;
        	$client->lead_type = $requestData->lead_type;
        	$client->company_website = $requestData->company_website;
        	$client->annual_revenue = $requestData->annual_revenue;
        	$client->number_employee = $requestData->number_employee;
        	$client->industry_type = $requestData->industry_type;
        	$client->drop_status = $requestData->drop_status;
        	//$client->lead_status = $requestData->lead_status;
        	$client->comment = $requestData->comment;
        	$client->user_id = $requestData->user_id;
        	$client->interested_product = $requestData->interested_product;
            $client->save();
        }else{
        	//$client->fill($requestData->all())->save();
        	$client->name = $requestData->name;
        	$client->email = $requestData->email;
        	$client->company_name = $requestData->company_name;
        	$client->primary_number = $requestData->primary_number;
        	$client->secondary_number = $requestData->secondary_number;
        	$client->address = $requestData->address;
        	$client->pin = $requestData->pin;
        	$client->fax = $requestData->fax;
        	$client->country = $requestData->country;
        	$client->source_type = $requestData->source_type;
        	$client->lead_type = $requestData->lead_type;
        	$client->company_website = $requestData->company_website;
        	$client->annual_revenue = $requestData->annual_revenue;
        	$client->number_employee = $requestData->number_employee;
        	$client->industry_type = $requestData->industry_type;
        	//$client->drop_status = $requestData->drop_status;
        	$client->lead_status = $requestData->lead_status;
        	$client->comment = $requestData->comment;
        	$client->user_id = $requestData->user_id;
            $client->interested_product = $requestData->interested_product;
        	$client->save();
        }

        return $client;
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $client = Lead::findorFail($id);
            $client->delete();
            Session()->flash('flash_message', 'Client successfully deleted');
        } catch (\Illuminate\Database\QueryException $e) {
            Session()->flash('flash_message_warning', 'Client can NOT have, leads, or tasks assigned when deleted');
        }
    }

    /**
     * @param $id
     * @param $requestData
     */
    public function updateAssign($id, $requestData)
    {
        $client = Lead::with('user')->findOrFail($id);
        $client->user_id = $requestData->get('user_assigned_id');
        $client->save();

        event(new \App\Events\ClientAction($client, self::UPDATED_ASSIGN));
    }

    /**
     * @param $requestData
     * @return string
     */
    public function vat($requestData)
    {
        $vat = $requestData->input('vat');

        $country = $requestData->input('country');
        $company_name = $requestData->input('company_name');

        // Strip all other characters than numbers
        $vat = preg_replace('/[^0-9]/', '', $vat);

        function cvrApi($vat)
        {
            if (empty($vat)) {
                // Print error message
                return ('Please insert VAT');
            } else {
                // Start cURL
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, 'http://cvrapi.dk/api?search=' . $vat . '&country=dk');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Flashpoint');

                // Parse result
                $result = curl_exec($ch);

                // Close connection when done
                curl_close($ch);

                // Return our decoded result
                return json_decode($result, 1);
            }
        }

        $result = cvrApi($vat, 'dk');

        return $result;
    }
}
