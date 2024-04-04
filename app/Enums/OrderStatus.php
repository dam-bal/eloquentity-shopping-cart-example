<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PLACED = 'placed';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
