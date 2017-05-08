<?php 

use App\Acceso;
use App\Facultad;
use App\Sede;
use App\Type;

class MasterMenuTest extends TestCase
{
	function test_user_master()
	{
		// Having
		$user = $this->defaultUser();
		$facultad = Facultad::find(1);
		$sede = Sede::find(1);
		$type = Type::find(1);

		$acceso = factory(Acceso::class)->create([
            'user_id'   	=> $user->id,
            'facultad_id'	=> $facultad->id,
            'sede_id'		=> $sede->id,
            'type_id'		=> $type->id,
        ]);

		// When
		$this->actingAs($user)
			->visit('/home')
			->select($facultad->wfacultad,'sel_facu')
			->select('Lima','sel_sede')
			->press('Acceder');

		// Then
		$this->see('Menus')
			->click('Menus')
			->seePageIs('/master/menu/index')
			->see('Menu Index');
	}

	function test_a_user_consulta_dont_see_masters_menu()
	{
		// Having
		$user = $this->defaultUser();
		$facultad = Facultad::find(1);
		$sede = Sede::find(1);
		$type = Type::find(2);

		$acceso = factory(Acceso::class)->create([
            'user_id'   	=> $user->id,
            'facultad_id'	=> $facultad->id,
            'sede_id'		=> $sede->id,
            'type_id'		=> $type->id,
        ]);

		// When
		$this->actingAs($user)
			->visit('/home')
			->select($facultad->wfacultad,'sel_facu')
			->select('Lima','sel_sede')
			->press('Acceder');

		// Then
		$response = $this->call('GET',"/master/menu/index");
		$this->assertEquals(403,$response->status());		
	}

}