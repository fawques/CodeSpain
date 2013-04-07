<?php

/**
 * This is the model class for table "Eventos".
 *
 * The followings are the available columns in table 'Eventos':
 * @property integer $idEventos
 * @property string $Nombre
 * @property string $Descripcion
 * @property string $Lugar
 * @property string $FechaIni
 * @property string $FechaFin
 * @property double $CoordX
 * @property double $CoordY
 * @property string $Imagen
 * @property string $Web
 * @property integer $idUsuarioCrear
 *
 * The followings are the available model relations:
 * @property Usuarios[] $usuarioses
 * @property Usuarios $idUsuarioCrear0
 * @property Tag[] $tags
 * @property Oficiales $oficiales
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
			array('Nombre, Descripcion, Lugar, FechaIni, FechaFin, CoordX, CoordY, Imagen, idUsuarioCrear', 'required','message'=>'¡El campo no puede ser vacio!'),
			array('idUsuarioCrear', 'numerical', 'integerOnly'=>true),
			array('CoordX, CoordY', 'numerical'),
			array('Nombre, Lugar', 'length', 'max'=>50),
			array('Descripcion', 'length', 'max'=>250),
			array('Imagen', 'length', 'max'=>100),
			array('Web', 'length', 'max'=>150),
			array('validacion',
                 'application.extensions.recaptcha.EReCaptchaValidator',
                 'privateKey'=> '6LemVd0SAAAAAEDQIawNw4SKuq_6S6PK7nLe6NB4', 
                 'on' => 'registerwcaptcha'
             ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('idEventos, Nombre, Descripcion, Lugar, FechaIni, FechaFin, CoordX, CoordY, Imagen, Web, idUsuarioCrear', 'safe', 'on'=>'search'),
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
			'idUsuarioCrear0' => array(self::BELONGS_TO, 'Usuarios', 'idUsuarioCrear'),
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
			'FechaIni' => 'Fecha Ini',
			'FechaFin' => 'Fecha Fin',
			'CoordX' => 'Coord X',
			'CoordY' => 'Coord Y',
			'Imagen' => 'Imagen',
			'Web' => 'Web',
			'idUsuarioCrear' => 'Id Usuario Crear',
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
		$criteria->compare('FechaIni',$this->FechaIni,true);
		$criteria->compare('FechaFin',$this->FechaFin,true);
		$criteria->compare('CoordX',$this->CoordX);
		$criteria->compare('CoordY',$this->CoordY);
		$criteria->compare('Imagen',$this->Imagen,true);
		$criteria->compare('Web',$this->Web,true);
		$criteria->compare('idUsuarioCrear',$this->idUsuarioCrear);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors(){
        return array('CSaveRelationsBehavior' => array('class' => 'application.components.CSaveRelationsBehavior'));
	}
}