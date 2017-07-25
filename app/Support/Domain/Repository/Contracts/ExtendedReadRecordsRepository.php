<?php

namespace Saf\Support\Domain\Repository\Contracts;

interface ExtendedReadRecordsRepository
{
    public function findBySlug($slug, $columns = [ '*' ]);

    public function findByCode($code, $columns = [ '*' ]);

    public function findByField($field, $value, $columns = [ '*' ]);
}