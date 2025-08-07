<?php

namespace backend\controllers;

use common\models\Project;
use backend\models\ProjectSearch;
use common\models\ProjectImage;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'attend' => ['POST'],
                        'delete-project-image' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $imageFile = UploadedFile::getInstance($model, 'imagefile');

                if ($imageFile) {
                    // Caminho temporário onde o arquivo está armazenado
                    $conteudoBinario = file_get_contents($imageFile->tempName);

                    // Ou: salvar como base64
                    $model->imagefile = base64_encode($conteudoBinario);
                }

                $model->save();

                Yii::$app->session->setFlash('success', 'Enviado com sucesso.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $model->imagefile = UploadedFile::getInstance($model, 'imagefile');
            $model->resposta = Yii::$app->request->post('Project')['resposta'];
            if ($model->save()) {
                $model-saveImage();
                Yii::$app->session->setFlash('success', 'Resposta enviada com sucesso.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modoResposta' => true, // opcional, se quiser usar no _form
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteProjectImage(){
        $image = ProjectImage::findOne($this->request->post('id'));
        if (!$image) {
            throw new NotFoundHttpException();
        }
        if($image->file->delete()){
            $path = Yii::$app->params['uploads'] ['projects'] . '/' . $image->file->name;
            unlink($path);
        }
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionAttend($id)
    {
        $model = $this->findModel($id);

        $model->status = 'atendido';
        $model->save(false);
        Yii::$app->session->setFlash('success', 'Atendido com sucesso.');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionAttended()
    {
        $searchModel = new ProjectSearch();

        // Faz a busca com os filtros padrão, mas limita só os chamados atendidos
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Adiciona o filtro para status "atendido"
        $dataProvider->query->andWhere(['status' => 'atendido']);

        return $this->render('attended', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionResponder($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Resposta enviada com sucesso.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('responder', [
            'model' => $model,
        ]);
    }
}
