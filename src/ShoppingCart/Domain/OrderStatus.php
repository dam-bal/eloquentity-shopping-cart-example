<?php

namespace Core\ShoppingCart\Domain;

enum OrderStatus: string
{
    case PLACED = 'placed';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
