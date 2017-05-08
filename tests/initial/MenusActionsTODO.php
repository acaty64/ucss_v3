<?php

use App\Acceso;
use App\Facultad;
use App\Menu;
use App\Sede;
use App\Type;
use App\MenuType;

class MenusActionsTest extends TestCase
{
	public function test_a_master_create_a_menu()
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
			->select($sede->wsede,'sel_sede')
			->press('Acceder')
			->click('Menus')
			->seePageIs('/master/menu/index')
			->see('Menu Index')
			->see('Crear nuevo menú')
			->click('Crear Nuevo Menú')
			->seePageIs('/master/menu/create')
			->type('Nuevo menú','name')
			->type('/new/route','href')
			->type(0,'level')
			->type(0,'order')
			->check('type1')
			->check('type3')  
			->press('Registrar')
			->seePageIs('/master/menu/index');
			
		//Then
		$this->seeInDatabase('menus',[
				'name' => 'Nuevo menú',
				'href' => '/new/route'
				]);
		$newMenu = Menu::where('name','Nuevo menú')->first();
		$this->seeInDatabase('menu_type',[
				'type_id' => 1,
				'menu_id' => $newMenu->id,
				'level'	=> 0,
				'order' => 0
				]);
		$this->seeInDatabase('menu_type',[
				'type_id' => 3,
				'menu_id' => $newMenu->id,
				'level'	=> 0,
				'order' => 0
				]);
		$this->see('Nuevo Menú');
	}

	public function test_edit_a_menu()
	{
		//Having
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

        $menu = new Menu;
        $menu->name = 'Nuevo menu';
        $menu->href = '/accion/funcion';
        $menu->save();
        $menu_id = Menu::all()->last()->id;

        $menu_type = new MenuType;
        $menu_type->menu_id = $menu_id;
        $menu_type->type_id = 1;
        $menu_type->level = 0;
        $menu_type->order = 0;
        $menu_type->save();

        $menu_type = new MenuType;
        $menu_type->menu_id = $menu_id;
        $menu_type->type_id = 3;
        $menu_type->level = 0;
        $menu_type->order = 0;
        $menu_type->save();

		//Acting
        $this->actingAs($user);
        Session::set('facultad_id',$facultad->id);
        Session::set('cfacultad',$facultad->cfacultad);
        Session::set('sede_id',$sede->id);
        Session::set('csede',$sede->csede);
        Session::set('type_id',$type->id);
        Session::set('ctype',$type->name);

		$this->visit('/master/menu/index')
			->seePageIs('/master/menu/index')
			->click('4')
			->click('Mody'.$menu_id)
			->see('Edición de Menú');
		//Then
		
	}

	public function test_delete_a_menu()
	{
		//Having

		//Acting

		//Then
		
	}
}