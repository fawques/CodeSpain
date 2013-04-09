<?php

/**
 * This is the model class for table "Eventos_has_Tag".
 *
 * The followings are the available columns in table 'Eventos_has_Tag':
 * @property integer $Eventos_idEventos
 * @property string $Tag_Etiqueta
 */
class EventosHasTag extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventosHasTag the static model class
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
		return 'Eventos_has_Tag';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Eventos_idEventos, Tag_Etiqueta', 'required'),
			array('Eventos_idEventos', 'numerical', 'integerOnly'=>true),
			array('Tag_Etiqueta', 'length', 'max'=>30),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Eventos_idEventos, Tag_Etiqueta', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Eventos_idEventos' => 'Eventos Id Eventos',
			'Tag_Etiqueta' => 'Tag Etiqueta',
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

		$criteria->compare('Eventos_idEventos',$this->Eventos_idEventos);
		$criteria->compare('Tag_Etiqueta',$this->Tag_Etiqueta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}