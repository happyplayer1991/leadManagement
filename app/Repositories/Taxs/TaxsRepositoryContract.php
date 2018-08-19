<?php
namespace App\Repositories\Taxs;

interface TaxsRepositoryContract
{
    public function find($id);
    
    public function create($requestData);
}
