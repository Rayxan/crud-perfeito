<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testListProduct()
    {
        $response = $this->get($this->apiUrl() . "/products");
        $response->assertStatus(200);
    }
}
