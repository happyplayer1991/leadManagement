<?php
namespace App\Repositories\Location;

use App\Models\Location;

/**
 * Class LocationRepository
 * @package App\Repositories\Location
 */
class LocationRepository implements LocationRepositoryContract
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllLocations()
    {
        return Location::all();
    }

    /**
     * @return mixed
     */
    public function listAllLocations()
    {
        return Location::pluck('name', 'id');
    }

    /**
     * @param $requestData
     */
    public function create($requestData)
    {
        Location::create($requestData->all());
    }

     public function update($id, $requestData)
    {
        $location = Location::findOrFail($id);
        $location->fill($requestData->all())->save();
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        Location::findorFail($id)->delete();
    }
}
