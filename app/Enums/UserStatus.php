<?php

namespace App\Enums;

enum UserStatus: string
{
    case ACTIVE = 'ACTIVE';
    case INVITED = 'INVITED';
    case DISABLED = 'DISABLED';
}
