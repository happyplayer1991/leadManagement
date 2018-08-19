<?php
namespace App\Repositories\Activities;

interface ActivitiesRepositoryContract
{
    public function find($id);
    
    public function create($requestData);
    
    public function updateFollowup($id, $requestData);

    public function allActivitiesData();
}
