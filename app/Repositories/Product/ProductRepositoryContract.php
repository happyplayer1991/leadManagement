<?php
namespace App\Repositories\Product;

interface ProductRepositoryContract
{
    public function find($id);
    
    public function create($requestData);
}
