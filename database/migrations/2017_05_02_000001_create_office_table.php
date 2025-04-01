<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Должность
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id')->comment('ID должности');
            $table->string('name')->comment('Название должности');
        });

        //Адрес основного раб. места
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id')->comment('ID адресса');
            $table->string('name')->comment('Название адресса');
        });

        //Статус сотрудника
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id')->comment('ID статуса');
            $table->string('name')->comment('Название статуса');
        });

        //Рабочая почта
        Schema::create('mailwork', function (Blueprint $table) {
            $table->increments('id')->comment('ID статуса');
            $table->string('name')->comment('Название ящика');
            $table->string('pass')->comment('Пароль');
        });
        
        // Таблица людей (сотрудников) товара
        Schema::create('peoples', function (Blueprint $table) {
            $table->increments('id')->comment('ID сотрудника');
            $table->string('name')->comment('Имя сотрудника');
            $table->string('surname')->comment('Фамилия сотрудника');
            $table->integer('status')->unsigned()->comment('Статус сотрудника');
            $table->foreign('status')->references('id')->on('status')->onDelete('cascade'); 
            $table->integer('position')->unsigned()->comment('ID должности');
            $table->foreign('position')->references('id')->on('positions')->onDelete('cascade');
            $table->integer('addresses')->unsigned()->comment('ID адресса');
            $table->foreign('addresses')->references('id')->on('addresses')->onDelete('cascade');
            $table->integer('mailwork')->unsigned()->comment('ID рабочей почты');
            $table->foreign('mailwork')->references('id')->on('mailwork')->onDelete('cascade');
            $table->string('mailpersonal')->nullable()->comment('Личная полчта');
            $table->string('telwork')->nullable()->comment('Рабочий телефон'); 
            $table->string('telpersonal')->nullable()->comment('Личный телефон');
            $table->date('birthday')->nullable()->comment('День рождения');
            $table->text('text')->nullable()->comment('Дополнительная информация'); 
            $table->timestamps(); 
        });
        
        //Группа инвентаря
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id')->comment('ID товра');
            $table->string('name')->comment('Название группы');
        });
        
        
        //Места нахождения инвентаря
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id')->comment('ID места');
            $table->string('name')->comment('Название места');
        });

        // Типы правок
        Schema::create('typeedit', function (Blueprint $table) {
            $table->increments('id')->comment('ID записи');
            $table->string('name')->comment('Название праки');
        });

        // Типы документов
        Schema::create('typedoc', function (Blueprint $table) {
            $table->increments('id')->comment('ID записи');
            $table->string('name')->comment('Название документа');
            $table->string('link')->comment('Линк документа');
        });

        // Состояние инвентарной еденици
        Schema::create('state', function (Blueprint $table) {
            $table->increments('id')->comment('ID состояния');
            $table->string('name')->comment('Название состояния');
        });
        
        // Инветарь
        Schema::create('inventorys', function (Blueprint $table) {
            $table->increments('id')->comment('ID инвентаризационный номер');
            $table->string('name')->comment('Название инвентарной еденици');
            $table->text('text')->nullable()->comment('Описание инвентаря');
            $table->integer('peoples')->unsigned()->comment('ID сотрудника');
            $table->foreign('peoples')->references('id')->on('peoples')->onDelete('cascade');
            $table->integer('groups')->unsigned()->comment('ID группы');
            $table->foreign('groups')->references('id')->on('groups')->onDelete('cascade');
            $table->integer('points')->unsigned()->comment('ID места');
            $table->foreign('points')->references('id')->on('points')->onDelete('cascade');
            $table->integer('state')->unsigned()->default('1')->comment('ID состояния');
            $table->foreign('state')->references('id')->on('state')->onDelete('cascade');
            $table->timestamps();
        });

        // Истрия правок - событие
        Schema::create('historys', function (Blueprint $table) {
            $table->increments('id')->comment('ID записи');
            $table->integer('id_doc')->comment('ID документа');
            $table->integer('typedoc')->unsigned()->comment('Тип документа');
            $table->foreign('typedoc')->references('id')->on('typedoc')->onDelete('cascade');
            $table->integer('typeedit')->unsigned()->comment('Вид правки');
            $table->foreign('typeedit')->references('id')->on('typeedit')->onDelete('cascade');
            $table->integer('user')->comment('ID Пользователя');
            $table->timestamp('time')->comment('Время правки документа');
        });

        // Истрия правок - поля
        Schema::create('hiedits', function (Blueprint $table) {
            $table->integer('historys')->nullable()->unsigned()->comment('ID записи');
            $table->foreign('historys')->references('id')->on('historys')->onDelete('cascade');
            $table->string('name')->nullable()->comment('название поля');
            $table->text('old')->nullable()->comment('Было значение');
            $table->text('new')->nullable()->comment('стало');
        });

        // Настройки
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->comment('ID записи');
            $table->string('name')->comment('Название');
            $table->text('data')->comment('Данные');
        });

        //Создаем таблицу доступов
        Schema::create('accessdoc', function (Blueprint $table) {
            $table->increments('id')->comment('ID записи');
            $table->integer('roles')->comment('Роль');
            $table->integer('doc')->comment('Документ');
            $table->enum('read', ['0', '1'])->comment('чтение');
            $table->enum('edit', ['0', '1'])->comment('Редактирование');
            $table->enum('delete', ['0', '1'])->comment('Удаление');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position');
        Schema::dropIfExists('аddresses');
        Schema::dropIfExists('status');
        Schema::dropIfExists('mailwork');
        Schema::dropIfExists('peoples');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('points');
        Schema::dropIfExists('typeedit');
        Schema::dropIfExists('typedoc');
        Schema::dropIfExists('state');
        Schema::dropIfExists('inventorys');
        Schema::dropIfExists('historys');
        Schema::dropIfExists('hiedits');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('accessdoc');
    }
}
