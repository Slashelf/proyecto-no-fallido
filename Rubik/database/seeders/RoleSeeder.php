<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1=Role::create(['name'=>'Administrador']);
        $role2=Role::create(['name'=>'Director']);
        $role3=Role::create(['name'=>'Secretaria']);
        $role4=Role::create(['name'=>'Certificador']);
        $role5=Role::create(['name'=>'Coordinadordoctorados']);
        $role6=Role::create(['name'=>'Coordinadormaestrias']);
        $role7=Role::create(['name'=>'Coordinadorespecialidades']);
        $role8=Role::create(['name'=>'Coordinadordiplomados']);
        $role9=Role::create(['name'=>'Coordinadorcursos']);
        $role10=Role::create(['name'=>'Daf-Postgrado']);
        $role11=Role::create(['name'=>'Contabilidad-Postgrado']);
        $role12=Role::create(['name'=>'Tesoro-Postgrado']);
        $role13=Role::create(['name'=>'Docente']);
        $role14=Role::create(['name'=>'Estudiante']);

        Permission::create(['name'=>'administrador.permiso'])->assignRole($role1);
        Permission::create(['name'=>'director.permiso'])->assignRole($role2);
        Permission::create(['name'=>'secretaria.permiso'])->assignRole($role3);
        Permission::create(['name'=>'certificador.permiso'])->assignRole($role4);
        Permission::create(['name'=>'coordinadordoctorados.permiso'])->assignRole($role5);
        Permission::create(['name'=>'coordinadormaestrias.permiso'])->assignRole($role6);
        Permission::create(['name'=>'coordinadorespecialidades.permiso'])->assignRole($role7);
        Permission::create(['name'=>'coordinadordiplomados.permiso'])->assignRole($role8);
        Permission::create(['name'=>'coordinadorcursos.permiso'])->assignRole($role9);
        Permission::create(['name'=>'daf.permiso'])->assignRole($role10);
        Permission::create(['name'=>'contabilidad.permiso'])->assignRole($role11);
        Permission::create(['name'=>'tesoro.permiso'])->assignRole($role12);
        Permission::create(['name'=>'docente.permiso'])->assignRole($role13);
        Permission::create(['name'=>'estudiante.permiso'])->assignRole($role14);
    }
}
