<?php

namespace Core\ShoppingCart\Domain;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case CARD = 'card';
}
