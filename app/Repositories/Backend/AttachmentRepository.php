<?php

namespace App\Repositories\Backend;

use App\Models\Attachment;
use InfyOm\Generator\Common\BaseRepository;

class AttachmentRepository extends BaseRepository
{
	/**
     * Configure the Model
     **/
    public function model()
    {
        return Attachment::class;
    }
}
