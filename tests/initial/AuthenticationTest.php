<?php 

use App\Acceso;
use App\Facultad;
use App\Sede;
use App\User;

class AuthenticationTest extends TestCase
{
	function test_user_access()
	{
		// Having
		$user = $this->defaultUser();
		$facultad = Facultad::find(1);
		$sede = Sede::find(1);

		$acceso = factory(Acceso::class)->create([
            'user_id'   	=> $user->id,
            'facultad_id'	=> $facultad->id,
            'sede_id'		=> $sede->id,
            'type_id'		=> 1,
        ]);

		// When
		$this->actingAs($user)
			->visit('/home')
			->select($facultad->wfacultad,'sel_facu')
			->select('Lima','sel_sede')
			->press('Acceder');

		// Then
		$this->seePageIs('/home/acceso');

	}

	function test_user_dont_access($value='')
	{
		// Having
		$user = $this->defaultUser();
		$facultad = Facultad::find(1);
		$sede = Sede::find(1);

		$acceso = factory(Acceso::class)->create([
            'user_id'   	=> $user->id,
            'facultad_id'	=> $facultad->id,
            'sede_id'		=> $sede->id,
            'type_id'		=> 1,
        ]);

		$other_fac = Facultad::find(2);
		// When
		$this->actingAs($user)
			->visit('/home')
			->select($other_fac->wfacultad,'sel_facu')
			->select('Lima','sel_sede')
			->press('Acceder');

		// Then
		$this->seePageIs('/home');

	}
}