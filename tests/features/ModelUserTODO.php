<?php

class ModelUserTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_a_consultor_can_viewed_the_users_data()
    {
        // Having an administrator
        $user = User::create([
                'id' => 1,
                'name' => 'Jane',
                'password' => bcrypt('secret'),
            ]);
        $acceso = Acceso::create([
                'user_id' => 1,
                'type_id' => 2,
                'facu_id' => 1, 
                'sede_id' => 1
            ]);
        $this->actingAs($user)
             ->visit('/consulta/user/index')
             ->see('Consulta de Usuarios');
    }
}
