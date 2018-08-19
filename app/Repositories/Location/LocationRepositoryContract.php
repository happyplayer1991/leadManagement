<?php
namespace App\Repositories\Location;

interface LocationRepositoryContract
{
    public function getAllLocations();
    
    public function listAllLocations();

    public function create($requestData);

    public function destroy($id);
}
