<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Serializer\Serializer;

class BaseRequest extends FormRequest
{
    /**
     * @template T
     * @param class-string<T> $class
     * @return T
     */
    public function mapTo(string $class)
    {
        /** @var Serializer $serializer */
        $serializer = app(Serializer::class);

        return $serializer->denormalize($this->validated(), $class);
    }
}
