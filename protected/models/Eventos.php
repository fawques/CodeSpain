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
 * @property Usuarios[] $usuarioses1
 */
class Eventos extends CActiveRecord
{
	public $validacion;
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
			array('idEventos', 'numerical', 'integerOnly'=>true),
			array('Nombre', 'length', 'max'=>50),
			array('Descripcion', 'length', 'max'=>150),
			array('Lugar', 'length', 'max'=>45),
			array('Fecha', 'safe'),

			// name, email, subject and body are required
			array('Nombre, Descripcion, Lugar, Fecha', 'required',
				'message'=>'{attribute} no puede ser vacio.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEventos, Nombre, Descripcion, Lugar, Fecha', 'safe', 'on'=>'search'),
			 array(
                     'validacion',
                     'application.extensions.recaptcha.EReCaptchaValidator',
                     'privateKey'=> '6LemVd0SAAAAAEDQIawNw4SKuq_6S6PK7nLe6NB4', 
                     'on' => 'registerwcaptcha'
                 ),
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
			'usuarioses1' => array(self::HAS_MANY, 'Usuarios', 'Eventos_idEventos'),
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
			'validacion'=>Yii::t('demo', 'Introduce las dos palabras separadas por un espacio:'),
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
}
