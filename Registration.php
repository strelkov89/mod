<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\base\Behavior;

/**
 * Registration 
 *
 */
class Registration extends \yii\db\ActiveRecord
{

    /**
     * 
     * public $name;
     * public $last_name;
     * public $patronym;
     * public $phone;
     * public $email;
     * public $agree;
     * public $subscription; //1 -first six months(6 months); 2 -second six months(6 months); 3 -whole year(12 months); 
     * public $receiver;  //1 -me; 2 -not me, other person;
     * public $phone_receiver;
     * public $receiver_fullname;           
     * public $city;
     * public $post_index;
     * public $street;
     * public $house;
     * public $apartment;
     * public $code_intercom;
     * public $comments; 
     */

    public $blank_input;
    public $subscription;

    public static function tableName()
    {
        return '{{%registration}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [            
            [['name', 'last_name', 'patronym', 'phone', 'email', 'blank_input', 'receiver', 'city', 'post_index', 'street', 'house', 'apartment'], 'required'],
            ['email', 'email'],
            ['email', 'emailValidateUnique'],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Необходимо подтвердить согласие'],           
            [['name', 'last_name', 'patronym', 'city', 'post_index', 'street', 'house', 'apartment', 'code_intercom', 'receiver_fullname', 'comments'], 'string', 'max' => 255],
            ['blank_input', 'string', 'max' => 150],            
            [['receiver', 'subscription'], 'integer'],  
            [['phone', 'phone_receiver', ], 'match', 'pattern' => '/^[0-9\(\)\+\- ]+$/i', 'message' => 'Проверьте правильность заполнения поля «Телефонный номер»'],         
        ];
    }

    public function attributeLabels()
    {
        return [           
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronym' => 'Отчество',
            'phone' => 'Телефон',            
            'email' => 'Email',
            'agree' => 'Соглашение',             
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'patronym' => 'Отчество',  
            'blank_input' => 'Период подписки',          
            'start_date' => 'Дата начала подписки',
            'term' => 'Продолжительность подписки', 
            'city' => 'Город',
            'post_index' => 'Почтовый индекс',
            'street' => 'Улица',
            'house' => 'Дом',
            'apartment' => 'Квартира',
            'code_intercom' => 'Код домофона',
            'receiver' => 'Получатель',
            'receiver_fullname' => 'ФИО получателя',
            'phone_receiver' => 'Телефон получателя',            
            'comments' => 'Комментарий',         
        ];
    }

    public function emailValidateUnique()
    {
        if ($this->isNewRecord) {
            $registration = Registration::findOne(['email' => $this->email]);
            if ($registration) {
                $this->addError('email', 'E-mail «'.$this->email.'» уже занят');
            }
        }
    }
    
}
