<?php
namespace App\Models\Transform;

interface Transformable {
    public function transform($object);
}