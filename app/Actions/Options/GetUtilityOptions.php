<?php

namespace App\Actions\Options;

use App\Models\Utility;


class GetUtilityOptions
{
    public function handle()
    {
        $utility = Utility::pluck('name', 'id');

        return $utility;
    }
}