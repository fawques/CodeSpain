<?php

/**
 * This is the model class for table "Preferencias".
 *
 * The followings are the available columns in table 'Preferencias':
 * @property integer $idPreferencias
 * @property string $Zona
 *
 * The followings are the available model relations:
 * @property Usuarios[] $usuarioses
 */
class Preferencias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Preferencias the static model class
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
		return 'Preferencias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idPreferencias', 'required'),
			array('idPreferencias', 'numerical', 'integerOnly'=>true),
			array('Zona', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idPreferencias, Zona', 'safe', 'on'=>'search'),
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
			'usuarioses' => array(self::HAS_MANY, 'Usuarios', 'Preferencias_idPreferencias'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idPreferencias' => 'Id Preferencias',
			'Zona' => 'Zona',
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

		$criteria->compare('idPreferencias',$this->idPreferencias);
		$criteria->compare('Zona',$this->Zona,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}