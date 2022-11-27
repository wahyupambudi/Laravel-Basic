<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class EncryptionTest extends TestCase
{
    public function testEncryption()
    {
        $enkripsi = Crypt::encrypt('Wahyu Pambudi');
        var_dump($enkripsi);

        $dekripsi = Crypt::decrypt($enkripsi);
        var_dump($dekripsi);

        self::assertEquals('Wahyu Pambudi', $dekripsi);
    }
}
