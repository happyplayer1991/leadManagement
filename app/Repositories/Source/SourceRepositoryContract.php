<?php
namespace App\Repositories\Source;

interface SourceRepositoryContract
{
   
    public function create($requestData);
    public function update($id,$requestData);

    public function destroy($id);
}
