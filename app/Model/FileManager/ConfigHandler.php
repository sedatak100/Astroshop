<?php

namespace App\Model\FileManager;

class ConfigHandler
{
    public function userField()
    {
        return auth('user')->user()->user_id;
    }
}
