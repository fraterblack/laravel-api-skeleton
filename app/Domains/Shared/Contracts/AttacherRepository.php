<?php

namespace Saf\Domains\Shared\Contracts;

use Illuminate\Database\Eloquent\Model;
use Saf\Support\Domain\Repository\Contracts\Repository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface AttacherRepository extends Repository
{
    public function addImage(Model $model, UploadedFile $image, $styleGuide = null, $type = null);
}