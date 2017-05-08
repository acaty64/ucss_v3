<?php

class InitTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('UNIVERSIDAD CATÓLICA SEDES SAPIENTIAE')
             ->see('Login');
    }
}
