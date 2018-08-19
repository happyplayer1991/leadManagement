<?php
namespace App\Repositories\SampleCode;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\SampleCode;
use Input;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;

/**
* 
*/
class SampleCodeRepository implements SampleCodeRepositoryContract
{
    public function find($id)
    {
        return SampleCode::findOrFail($id);
    }
	
	public function create($requestData)
	{	
		
        $sample = New SampleCode();

        if($requestData->hasFile('image_path')){

            $avatar = $requestData->file('image_path');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // if (!is_dir(public_path(). '/images/'. $filename)) {
            //     mkdir(public_path(). '/images/'. $filename, 0777, true);
            // }
             $destinationPath = public_path(). '/images/Media/';
            
              $avatar->move($destinationPath, $filename);

            
            $sample->image_path = $filename;
     
        }

            
            $sample->samplecode = $requestData->samplecode;
      
           
            $item = $requestData->item;
            
            $make = $requestData->make;
            
            $qty = $requestData->qty;
            
            $uom = $requestData->uom;
            // var_dump($uom);
            

            foreach ($item as $index => $value)
            {                  
                $item_code[] = array($item[$index],$make[$index],$qty[$index],$uom[$index]);
 
            }
            // var_dump($item_code);
            // exit();
            $sample->itemcode = serialize($item_code);
            
           

            // item color
            
             $color1 = $requestData->color1;
            
            $make1 = $requestData->make1;
            
            $qty1 = $requestData->qty1;
            
            $uom1 = $requestData->uom1;

            foreach ($color1 as $index => $value)
            {
                
                $item_color[] = array($color1[$index],$make1[$index],$qty1[$index],$uom1[$index]);
               
            }
            $sample->itemcodecolor = serialize($item_color); 
        
        // wash code

            $make2= $requestData->make2;
            $qty2= $requestData->qty2; 
            $water= $requestData->water;
             
            foreach ($make2 as $index => $value)
            {
                
            $wash_code[] = array($make2[$index],$qty2[$index],$water[$index]);
            }
        
        $sample->colorcode = serialize($wash_code);
       
       // wash color
            $color3= $requestData->color3;
            $make3 = $requestData->make3;
             // var_dump($make); 
            $qty3= $requestData->qty3;
             // var_dump($qty);  
            $uom3= $requestData->uom3;
            foreach ($color3 as $index => $value)
            {
                $wash_color[] = array($color3[$index],$make3[$index],$qty3[$index],$uom3[$index]);
                
            }


        $sample->colorcodecolor = serialize($wash_color); 
      
        $sample->briefdescription = $requestData->briefdescription; 
        //$sample->image_path = $filename;

        $sample->save();
        

        Session::flash('flash_message', 'sample code successfully added!'); 
	}

    public function update($id, $requestData)
    {
        
        $sample = SampleCode::findorFail($id);

        // $sample->samplecode = $requestData->samplecode;
        
            //itemcode
            $item = $requestData->item;
            
            $make = $requestData->make;
            
            $qty = $requestData->qty;
            
            $uom = $requestData->uom;
            

            foreach ($item as $index => $value)
            {
                $item_code[] = array($item[$index],$make[$index],$qty[$index],$uom[$index]);
               
            }
            $sample->itemcode = serialize($item_code); 

            // item color
             $color1 = $requestData->color1;
            
            $make1 = $requestData->make1;
            
            $qty1 = $requestData->qty1;
            
            $uom1 = $requestData->uom1;

            foreach ($color1 as $index => $value)
            {
               
                $item_color[] = array($color1[$index],$make1[$index],$qty1[$index],$uom1[$index]);
              
            }
            $sample->itemcodecolor = serialize($item_color); 
        
        // wash code

            $make2= $requestData->make2;
             $qty2= $requestData->qty2;
            $water= $requestData->water;
             

            foreach ($make2 as $index => $value)
            {
                
            $wash_code[] = array($make2[$index],$qty2[$index],$water[$index]);
            }
        
        $sample->colorcode = serialize($wash_code);
       
       // wash color
             $color3= $requestData->color3;
            $make3 = $requestData->make3;
             // var_dump($make); 
            $qty3= $requestData->qty3;
             // var_dump($qty);  
            $uom3= $requestData->uom3;
            foreach ($color3 as $index => $value)
            {
                $wash_color[] = array($color3[$index],$make3[$index],$qty3[$index],$uom3[$index]);
              
            }


        $sample->colorcodecolor = serialize($wash_color); 
      
        $sample->briefdescription = $requestData->briefdescription; 
       
        
        if($requestData->hasFile('image_path')){

            $avatar = $requestData->file('image_path');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // if (!is_dir(public_path(). '/images/'. $filename)) {
            //     mkdir(public_path(). '/images/'. $filename, 0777, true);
            // }
             $destinationPath = public_path(). '/images/Media/';
            
              $avatar->move($destinationPath, $filename);

            
            $sample->image_path = $filename;
     
        }
      
     $sample->save();
      Session::flash('flash_message', 'sample code successfully added!');
	
}

    public function destroy($id)
    {
        SampleCode::findorFail($id)->delete();

        Session::flash('flash_message', 'Deleted successfully!'); 
    }



}
