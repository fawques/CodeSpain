<?php

/**
 * This is the model class for table "Usuarios".
 *
 * The followings are the available columns in table 'Usuarios':
 * @property integer $idUsuarios
 * @property string $Nombre
 * @property string $Token
 * @property integer $Preferencias_idPreferencias
 *
 * The followings are the available model relations:
 * @property Eventos[] $eventoses
 * @property Eventos[] $eventoses1
 * @property Preferencias[] $preferenciases
 */
class Usuarios extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Nombre', 'required'),
			array('Preferencias_idPreferencias', 'numerical', 'integerOnly'=>true),
			array('Nombre', 'length', 'max'=>50),
			array('Token', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idUsuarios, Nombre, Token, Preferencias_idPreferencias', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'eventoses' => array(self::MANY_MANY, 'Eventos', 'Reportar(Usuarios_idUsuarios, Eventos_idEventos)'),
			'eventoses1' => array(self::HAS_MANY, 'Eventos', 'idUsuarioCrear'),
			'preferenciases' => array(self::HAS_MANY, 'Preferencias', 'Usuarios_idUsuarios'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idUsuarios' => 'Id Usuarios',
			'Nombre' => 'Nombre',
			'Token' => 'Token',
			'Preferencias_idPreferencias' => 'Preferencias Id Preferencias',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idUsuarios',$this->idUsuarios);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Token',$this->Token,true);
		$criteria->compare('Preferencias_idPreferencias',$this->Preferencias_idPreferencias);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}