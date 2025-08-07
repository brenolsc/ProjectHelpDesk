<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $tech_stack
 * @property string $description
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $imagefile
 *
 * @property ProjectImage[] $Images
 * @property Testimonial[] $testimonials
 */
class Project extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $imagefile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date'], 'default', 'value' => null],
            [['name', 'tech_stack', 'description'], 'required'],
            [['tech_stack', 'description'], 'string'],
            [['start_date', 'end_date','imagefile'], 'safe'],
            [['name'], 'string', 'max' => 255],
//            [['imagefile'],'file','skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Título'),
            'tech_stack' => Yii::t('app', 'Qual sistema utilizado?'),
            'description' => Yii::t('app', 'Descreva o seu problema'),
            'start_date' => Yii::t('app', 'Qual a data do problema?'),
            'imageFile' => Yii::t('app', 'Anexo'),
            'imagefile' => Yii::t('app', 'Anexo'),
            //'end_date' => Yii::t('app', 'End Date'),
        ];
    }

    /**
     * Gets query for [[ProjectImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProjectImage::class, ['project_id' => 'id']);
    }

    /**
     * Gets query for [[Testimonials]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestimonials()
    {
        return $this->hasMany(Testimonial::class, ['project_id' => 'id']);
    }

    public function saveImage(){
        Yii::$app->db->transaction(function () {
            /**
             * @var $db yii\db\Connection
             */
        $file = new File();
        $file->name = uniqid(true) . '.' . $this->imageFile->extension;
        $file->base_url = Yii::$app->urlManager->createAbsoluteUrl(Yii::$app->params['uploads'] ['projects']);
        $file->mime_type = mime_content_type($this->imageFile->tempName);
        $file->save();

        $projectImage = new ProjectImage();
        $projectImage->project_id = $this->id;
        $projectImage->file_id = $file->id;
        $projectImage->save();

        if($this->imageFile->saveAs(Yii::$app->params['uploads'] ['projects']. '/' .$file->name)){
            $db->transaction->rollBack();
        }
        });
    }

    public function hasImage(){
        return count($this->Images) > 0;
    }
}
