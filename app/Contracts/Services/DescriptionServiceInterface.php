<?php

namespace App\Contracts\Services;

interface DescriptionServiceInterface
{
    public function getAllDescriptionGps();
    public function createDescriptionGp(array $descriptionGp);
    public function deleteDescriptionGp(int $gpId);
    public function descGpUpdate(int $gpId, array $newGpData);
    public function getDescriptionList(int $gpId);
    public function createDescription(array $request);
    public function desUpdate(int $descId, array $newData);
    public function deleteDescription(int $descriptionId);
}
