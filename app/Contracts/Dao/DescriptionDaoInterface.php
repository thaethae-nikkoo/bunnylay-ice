<?php

namespace App\Contracts\Dao;

interface DescriptionDaoInterface
{
    public function getAllDescriptionGps();
    public function createDescriptionGp(array $descriptionGp);
    public function deleteDescriptionGp(int $gpId);
    public function descGpUpdate(int $gpId, array $newGpData);
    public function getDescriptionList(int $gpId);
    public function createDescription(array $description);
    public function deleteDescription(int $descriptionId);
    public function desUpdate(int $descId, array $newData);
}
