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
 * @property double $CoordX
 * @property double $CoordY
 *
 * The followings are the available model relations:
 * @property Usuarios[] $usuarioses
 * @property Tag[] $tags
 * @property Oficiales $oficiales
 */
class Eventos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Eventos the static model class
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
			array('CoordX, CoordY', 'numerical'),
			array('Nombre', 'length', 'max'=>50),
			array('Descripcion', 'length', 'max'=>150),
			array('Lugar', 'length', 'max'=>45),
			array('Fecha', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEventos, Nombre, Descripcion, Lugar, Fecha, CoordX, CoordY', 'safe', 'on'=>'search'),
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
			'tags' => array(self::MANY_MANY, 'Tag', 'Eventos_has_Tag(Eventos_idEventos, Tag_Etiqueta)'),
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
			'CoordX' => 'Coord X',
			'CoordY' => 'Coord Y',
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
		$criteria->compare('CoordX',$this->CoordX);
		$criteria->compare('CoordY',$this->CoordY);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}