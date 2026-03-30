<?php

namespace App\Dao;

use App\Models\DescriptionGroup;
use App\Contracts\Dao\DescriptionDaoInterface;
use App\Models\Description;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class DescriptionDao implements DescriptionDaoInterface
{
    /**
     * Get Description List
     *
     * @param integer $gpId
     * @return \App\Models\Description[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getDescriptionList(int $gpId)
    {
        return Description::where('description_gp_id', $gpId)->get();
    }

    /**
     * create description
     *
     * @param array $description
     * @return void
     */
    public function createDescription(array $description)
    {
        return DB::transaction(function () use ($description) {
            return Description::create($description);
        });
    }

    /**
     * Get all description gps
     *
     * @return Collection
     */
    public function getAllDescriptionGps(): Collection
    {
        return DescriptionGroup::with([
                                    'descriptions' => function ($q) {
                                        $q->where('is_user_manual', true);
                                    }
                                ])
                                ->where('is_user_manual', true)
                                ->orderBy('description_gp_id', 'desc')
                                ->get();
    }

    /**
     * Create DescriptionGroup
     *
     * @param array $descriptionGp
     * @return DescriptionGroup
     */
    public function createDescriptionGp(array $descriptionGp): DescriptionGroup
    {
        return DB::transaction(function () use ($descriptionGp) {
            return DescriptionGroup::create($descriptionGp);
        });
    }

    /**
     * Delete Description Group
     *
     * @param integer $gpId
     * @return boolean
     */
    public function deleteDescriptionGp(int $gpId)
    {
        return DB::transaction(function () use ($gpId) {
            Description::where('description_gp_id', $gpId)->delete();
            return DescriptionGroup::where('description_gp_id', $gpId)->delete();
        });
    }

    /**
     * Delete Description
     *
     * @param integer $descriptionId
     * @return boolean
     */
    public function deleteDescription(int $descriptionId)
    {
        return DB::transaction(function () use ($descriptionId) {
            return Description::where('description_id', $descriptionId)->delete();
        });
    }

    /**
     * Description Group Update
     *
     * @param integer $gpId
     * @param array $newGpData
     * @return void
     */
    public function descGpUpdate(int $gpId, array $newGpData)
    {
        DB::transaction(function () use ($gpId, $newGpData) {
            DescriptionGroup::where('description_gp_id', $gpId)->update($newGpData);
        });
    }

    /**
     * Description Update
     *
     * @param integer $descId
     * @param array $newData
     * @return void
     */
    public function desUpdate(int $descId, array $newData)
    {
        DB::transaction(function () use ($descId, $newData) {
            Description::where('description_id', $descId)->update($newData);
        });
    }
}
