<?php

use Illuminate\Database\Seeder;

class OBITableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indata = date("Y-m-d H:i:s");

        DB::table('status')->insert([
            [
                'id' => '1',
                'name' => 'Сотрудники',
            ],
            [
                'id' => '2',
                'name' => 'Уволены',
            ],
            [
                'id' => '3',
                'name' => 'Подрядчики',
            ]
        ]);


        DB::table('positions')->insert([
            [
                'id' => '1',
                'name' => '!Не задано!',
            ]
        ]);

        DB::table('mailwork')->insert([
            [
                'id' => '1',
                'name' => 'Нет!',
                'pass' => ''
            ],
            [
                'id' => '2',
                'name' => 'admin@mydomen.com',
                'pass' => 'pass'
            ],
            [
                'id' => '3',
                'name' => 'info@mydomen.com',
                'pass' => 'pass'
            ],
        ]);

        DB::table('addresses')->insert([
            [
                'id' => '1',
                'name' => 'Не указан!',
            ]
        ]);

        DB::table('state')->insert([
            [
                'id' => '1',
                'name' => '!Не используется!',
            ],
            [
                'id' => '2',
                'name' => 'Используется',
            ],
            [
                'id' => '3',
                'name' => 'Списан',
            ]
        ]);

        DB::table('groups')->insert([
            [
                'id' => '1',
                'name' => '!Группа не заданна!',
            ],
        ]);

        DB::table('points')->insert([
            [
                'id' => '1',
                'name' => '!Место не определенно!',
            ]
        ]);

        DB::table('typeedit')->insert([
            [
                'id' => '1',
                'name' => 'создан',
            ],
            [
                'id' => '2',
                'name' => 'внесены правки',
            ],
            [
                'id' => '3',
                'name' => 'удален',
            ],
            [
                'id' => '4',
                'name' => 'востановлен',
            ],
        ]);

        DB::table('typedoc')->insert([
            [
                'id' => '1',
                'name' => 'Пользователи',
                'link' => 'user',
            ],
            [
                'id' => '2',
                'name' => 'Люди',
                'link' => 'people',
            ],
            [
                'id' => '3',
                'name' => 'Имущество',
                'link' => 'inventory',
            ],
            [
                'id' => '4',
                'name' => 'Группы имущества',
                'link' => 'group',
            ],
            [
                'id' => '5',
                'name' => 'Места хранения',
                'link' => 'point',
            ],
            [
                'id' => '6',
                'name' => 'Адресса',
                'link' => 'point',
            ],
            [
                'id' => '7',
                'name' => 'Должности',
                'link' => 'point',
            ],
            [
                'id' => '8',
                'name' => 'Почта рабочая',
                'link' => 'point',
            ],
        ]);

        DB::table('settings')->insert([
            [
                'id' => '1',
                'name' => 'Включить доступ по выбрвным IP, 0 - открыто всем!',
                'data' => '0',
            ],
            [
                'id' => '2',
                'name' => 'Название организации',
                'data' => 'ООО OfficeBook',
            ],
            [
                'id' => '3',
                'name' => 'Описание организации',
                'data' => 'Офисная книга',
            ],
            [
                'id' => '4',
                'name' => 'E-mail администратора',
                'data' => 'admin@mycompany.com',
            ],
            [
                'id' => '5',
                'name' => 'Отображать в разделе Office Имущество',
                'data' => '1',
            ],
            [
                'id' => '6',
                'name' => 'Отображать в разделе Office Контакты',
                'data' => '1',
            ],
            [
                'id' => '7',
                'name' => 'Отображать в разделе Office Должность',
                'data' => '0',
            ],
            [
                'id' => '8',
                'name' => 'Отображать в разделе Office Телифон и E-mail рабочий',
                'data' => '0',
            ],
            [
                'id' => '9',
                'name' => 'Отображать в разделе Office Адресс',
                'data' => '0',
            ],
        ]);

        DB::table('accessdoc')->insert([
            [
                'roles' => '1',
                'doc' => '1',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '2',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '3',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '4',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '5',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '6',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '7',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '1',
                'doc' => '8',
                'read' => '1',
                'edit' => '1',
                'delete' => '1',
            ],
            [
                'roles' => '2',
                'doc' => '1',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '2',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '3',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '4',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '5',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '6',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '7',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '2',
                'doc' => '8',
                'read' => '1',
                'edit' => '1',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '1',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '2',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '3',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '4',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '5',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '6',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '7',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '3',
                'doc' => '8',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '1',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '2',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '3',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '4',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '5',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '6',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '7',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '4',
                'doc' => '8',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '1',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '2',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '3',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '4',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '5',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '6',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '7',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
            [
                'roles' => '5',
                'doc' => '8',
                'read' => '1',
                'edit' => '0',
                'delete' => '0',
            ],
        ]);

        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'Администратор',
                'email' => 'admin@mydomen.com',
                'password' => bcrypt('password'),
                'apanel' => 'checked',
                'history' => 'checked',
                'created_at' => $indata,
                'updated_at' => $indata,
            ],
        ]);

        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'Root',
            ],
            [
                'id' => '2',
                'name' => 'Системный администратор',
            ],
            [
                'id' => '3',
                'name' => 'Кадровик',
            ],
            [
                'id' => '4',
                'name' => 'Бухгалтер',
            ],
            [
                'id' => '5',
                'name' => 'Кладовщик',
            ],

        ]);

        DB::table('users_roles')->insert([
            [
                'user_id' => '1',
                'role_id' => '1',
            ],
        ]);
    }
}

