<?php

use yii\db\Migration;

class m171211_142312_Create_Registration extends Migration
{
    const TABLE = 'registration';

    public function safeUp()
    {
        $this->createTable(self::TABLE, [
            'id' => 'int(11) NOT NULL PRIMARY KEY',
            'created_at' => 'int(11) DEFAULT NULL',
            'updated_at' => 'int(11) DEFAULT NULL',            
            'email' => 'varchar(255) DEFAULT NULL',
            'password' => 'varchar(255) DEFAULT NULL',
            'authkey' => 'varchar(255) DEFAULT NULL',
            'name' => 'varchar(255) DEFAULT NULL',
            'last_name' => 'varchar(255) DEFAULT NULL',
            'patronym' => 'varchar(255) DEFAULT NULL COMMENT "Отчество"',
            'phone' => 'varchar(255) DEFAULT NULL',
            'agree' => 'int(1) DEFAULT NULL',
            'start_date' => 'varchar(255) DEFAULT NULL COMMENT "Дата начала подписки"',
            'term' => 'varchar(255) DEFAULT NULL COMMENT "Продолжительность подписки"', 
            'city' => 'varchar(255) DEFAULT NULL COMMENT "Город доставки"',
            'post_index' => 'int(11) DEFAULT NULL COMMENT "Почтовый индекс"',
            'street' => 'varchar(255) DEFAULT NULL',
            'house' => 'varchar(255) DEFAULT NULL COMMENT "Дом"',
            'apartment' => 'varchar(255)DEFAULT NULL COMMENT "Квартира"',
            'code_intercom' => 'varchar(255) DEFAULT NULL COMMENT "Код домофона"',
            'receiver' => 'int(11) DEFAULT NULL COMMENT "Получатель"',
            'receiver_fullname' => 'varchar(255) DEFAULT NULL COMMENT "ФИО получателя"',
            'phone_receiver' => 'varchar(255) DEFAULT NULL COMMENT "Телефон получателя"',            
            'comments' => 'text DEFAULT NULL',                       
            ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        $this->execute("ALTER TABLE `".self::TABLE."` CHANGE `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT");
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE);
    }
    
}
