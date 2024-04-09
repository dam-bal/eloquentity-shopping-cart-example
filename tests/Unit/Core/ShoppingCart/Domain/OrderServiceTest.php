<?php

namespace Tests\Unit\Core\ShoppingCart\Domain;

use Core\ShoppingCart\Domain\Cart;
use Core\ShoppingCart\Domain\Order;
use Core\ShoppingCart\Domain\OrderLine;
use Core\ShoppingCart\Domain\OrderRepository;
use Core\ShoppingCart\Domain\OrderService;
use Core\ShoppingCart\Domain\PaymentMethod;
use Core\ShoppingCart\Domain\Product;
use Core\ShoppingCart\Domain\Shipment;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class OrderServiceTest extends TestCase
{
    /** @var OrderRepository|MockObject */
    private $orderRepositoryMock;

    private OrderService $sut;

    protected function setUp(): void
    {
        $this->orderRepositoryMock = $this->createMock(OrderRepository::class);

        $this->sut = new OrderService($this->orderRepositoryMock);
    }

    public function testCreateOrderFromCartThrowsExceptionWhenCartIsCompleted(): void
    {
        $this->expectException(RuntimeException::class);

        $cartMock = $this->createMock(Cart::class);

        $cartMock
            ->method('isCompleted')
            ->willReturn(true);

        $this->sut->createOrderFromCart(
            'orderId',
            $cartMock,
            $this->createMock(Shipment::class),
            PaymentMethod::CARD
        );
    }

    public function testCreateOrderFromCartThrowsExceptionWhenCartIsEmpty(): void
    {
        $this->expectException(RuntimeException::class);

        $cartMock = $this->createMock(Cart::class);

        $cartMock
            ->method('isCompleted')
            ->willReturn(false);

        $cartMock
            ->method('isEmpty')
            ->willReturn(true);

        $this->sut->createOrderFromCart(
            'orderId',
            $cartMock,
            $this->createMock(Shipment::class),
            PaymentMethod::CARD
        );
    }

    public function testCreateOrderFromCartCreatesOrder(): void
    {
        $cart = new Cart('cartId', 'customerId');

        $cart->addProduct(new Product('productId', 'Product', 'PRODUCT-1', 100));

        $expectedOrder = new Order(
            'orderId',
            'customerId',
            new Shipment(
                'city',
                'streetName',
                'streetNumber',
                'Full Name'
            ),
            PaymentMethod::CARD,
            [
                new OrderLine(
                    'Product',
                    'PRODUCT-1',
                    100,
                    1
                )
            ]
        );

        $this->orderRepositoryMock
            ->expects($this->once())
            ->method('store')
            ->with(
                $this->callback(function (Order $order): bool {
                    $placedDate = $order->getPlacedDate();

                    $expectedOrder = new Order(
                        'orderId',
                        'customerId',
                        new Shipment(
                            'city',
                            'streetName',
                            'streetNumber',
                            'Full Name'
                        ),
                        PaymentMethod::CARD,
                        [
                            new OrderLine(
                                'Product',
                                'PRODUCT-1',
                                100,
                                1
                            )
                        ],
                        $placedDate
                    );

                    return $expectedOrder == $order;
                })
            );

        $this->sut->createOrderFromCart(
            'orderId',
            $cart,
            new Shipment(
                'city',
                'streetName',
                'streetNumber',
                'Full Name'
            ),
            PaymentMethod::CARD
        );
    }
}