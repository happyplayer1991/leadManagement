<?php
namespace App\Repositories\SampleCode;

interface SampleCodeRepositoryContract
{
    // public function getAllSamples();
    
    // public function listAllSamples();
    public function find($id);

    public function create($requestData);

    // public function destroy($id);

    public function destroy($id);

    public function update($id, $requestData);
}
