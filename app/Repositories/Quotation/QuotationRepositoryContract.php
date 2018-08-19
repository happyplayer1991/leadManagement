<?php
namespace App\Repositories\Quotation;

interface QuotationRepositoryContract
{
    public function find($id);
    
    public function create($requestData);
}
