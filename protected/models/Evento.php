<?php

/**
 * This is the model class for table "Eventos".
 *
 * The followings are the available columns in table 'Eventos':
 * @property integer $idEventos
 * @property string $Nombre
 * @property string $Descripcion
 * @property string $Lugar
 * @property string $Fecha
 *
 * The followings are the available model relations:
 * @property Usuarios[] $usuarioses
 * @property Oficiales $oficiales
 */
class Evento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evento the static model class
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
		return 'Eventos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idEventos', 'required'),
			array('idEventos', 'numerical', 'integerOnly'=>true),
			array('Nombre', 'length', 'max'=>50),
			array('Descripcion', 'length', 'max'=>150),
			array('Lugar', 'length', 'max'=>45),
			array('Fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEventos, Nombre, Descripcion, Lugar, Fecha', 'safe', 'on'=>'search'),
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
			'usuarioses' => array(self::MANY_MANY, 'Usuarios', 'Reportar(Eventos_idEventos, Usuarios_idUsuarios)'),
			'oficiales' => array(self::HAS_ONE, 'Oficiales', 'Eventos_idEventos'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idEventos' => 'Id Eventos',
			'Nombre' => 'Nombre',
			'Descripcion' => 'Descripcion',
			'Lugar' => 'Lugar',
			'Fecha' => 'Fecha',
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

		$criteria->compare('idEventos',$this->idEventos);
		$criteria->compare('Nombre',$this->Nombre,true);
		$criteria->compare('Descripcion',$this->Descripcion,true);
		$criteria->compare('Lugar',$this->Lugar,true);
		$criteria->compare('Fecha',$this->Fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function search_prueba($keyword)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('idEventos',$keyword);
		$criteria->compare('Nombre',$keyword,true, 'OR');
		$criteria->compare('Descripcion',$keyword,true, 'OR');
		$criteria->compare('Lugar',$keyword,true, 'OR');
		$criteria->compare('Fecha',$keyword,true, 'OR');

		return Evento::model()->findAll($criteria);
/*
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));*/
	}
}