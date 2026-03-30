<?php

namespace App\Services;

use App\Contracts\Dao\DescriptionDaoInterface;
use App\Contracts\Services\DescriptionServiceInterface;
use App\Models\DescriptionGroup;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class DescriptionService implements DescriptionServiceInterface
{
    private $descriptionDao;

    /**
     * Constructor
     * @method __construct
     * @param DescriptionDaoInterface $descriptionDao
     */
    public function __construct(
        DescriptionDaoInterface $descriptionDao,
    ) {
        $this->descriptionDao = $descriptionDao;
    }

    /**
     * Get Description List
     *
     * @param integer $gpId
     * @return \App\Models\Description[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getDescriptionList(int $gpId)
    {
        return $this->descriptionDao->getDescriptionList($gpId);
    }

    /**
     * Create description
     *
     * @param array $request
     * @return void
     */
    public function createDescription(array $request)
    {
        return $this->descriptionDao->createDescription($request);
    }

    /**
    * Get all description gps with pagination
    *
    * @return Collection
    */
    public function getAllDescriptionGps(): Collection
    {
        return $this->descriptionDao->getAllDescriptionGps();
    }

    /**
      * Create DescriptionGroup
      *
      * @param array $descriptionGp
      * @return DescriptionGroup
      */
    public function createDescriptionGp(array $descriptionGp): DescriptionGroup
    {
        $descriptionGp = $this->descriptionDao->createDescriptionGp($descriptionGp);
        $descriptionGp->append('description_type_text');
        return $descriptionGp;
    }

    /**
     * Delete Description Group
     *
     * @param integer $gpId
     * @return boolean
     */
    public function deleteDescriptionGp(int $gpId)
    {
        return $this->descriptionDao->deleteDescriptionGp($gpId);
    }

    /**
     * Delete Description
     *
     * @param integer $descriptionId
     * @return boolean
     */
    public function deleteDescription(int $descriptionId)
    {
        return $this->descriptionDao->deleteDescription($descriptionId);
    }

    /**
     * Update description group
     *
     * @param integer $gpId
     * @param array $newGpData
     * @return void
     */
    public function descGpUpdate(int $gpId ,array $newGpData)
    {
        $newGpData['updated_by'] = Auth::id();
        $this->descriptionDao->descGpUpdate($gpId, $newGpData);
    }

    /**
     * Update description
     *
     * @param integer $descId
     * @param array $newData
     * @return void
     */
    public function desUpdate(int $descId ,array $newData)
    {
        $newData['updated_by'] = Auth::id();
        $this->descriptionDao->desUpdate($descId, $newData);
    }
}
