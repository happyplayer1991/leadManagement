<?php
namespace App\Repositories\Source;

use App\Models\Source;

/**
 * Class SourceRepository
 * @package App\Repositories\Source
 */
class SourceRepository implements SourceRepositoryContract
{
   

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        // Source::create($requestData->all());
        $source = New Source();
        $source->name = $requestData->name;
        $source->email = $requestData->email;
        $source->phone_number = $requestData->phone_number;
        
        // $source->types = $requestData->types;
        // $source->others = $requestData->others;

        $type = $requestData->types;

        

        if($type == '12')

        {   
            $source->types = $type;
            $source->others = $requestData->others;

        }else{
            
            $source->types = $requestData->types;

        }
        

        $source->remarks = $requestData->remarks;

        $source->save();
    }

     public function update($id, $requestData)
    {
        $source = Source::findOrFail($id);
        $source->name = $requestData->name;
        $source->email = $requestData->email;
        $source->phone_number = $requestData->phone_number;
        

        // $source->types = $requestData->types;
        // $source->others = $requestData->others;

        $type = $requestData->types;
        

        if($type == '12')
        {   
            $source->types = $type;
            $source->others = $requestData->others;
            // print_r($requestData->types);
            // print_r($requestData->others);

        }else{
            
            $source->types = $requestData->types;
             $source->others =  $requestData->others;
        }

        

        $source->remarks = $requestData->remarks;
        $source->save();
        // $source->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Source::findorFail($id)->delete();
    }

    public function find($id)
    {
        return Source::findOrFail($id);
    }
    
}
