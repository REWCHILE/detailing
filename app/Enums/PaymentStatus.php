<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'PENDING';
    case REQUIRES_ACTION = 'REQUIRES_ACTION';
    case PAID = 'PAID';
    case FAILED = 'FAILED';
    case REFUNDED = 'REFUNDED';
    case EXPIRED = 'EXPIRED';
}
