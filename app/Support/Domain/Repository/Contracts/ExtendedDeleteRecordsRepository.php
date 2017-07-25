<?php

namespace Saf\Support\Domain\Repository\Contracts;

interface ExtendedDeleteRecordsRepository
{
    /**
     * Delete entry by id
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}