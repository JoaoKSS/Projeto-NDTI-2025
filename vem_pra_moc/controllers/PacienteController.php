<?php

namespace app\controllers;

use Yii;
use app\models\Paciente;
use app\models\PacienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PacienteController implements the CRUD actions for Paciente model.
 */
class PacienteController extends Controller
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
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Paciente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PacienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Paciente model.
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
     * Creates a new Paciente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Paciente();

        if ($model->load(Yii::$app->request->post())) {
            if (!extension_loaded('fileinfo')) {
                throw new \yii\base\InvalidConfigException('The fileinfo PHP extension is not installed.');
            }

            $model->documento_cpf = UploadedFile::getInstance($model, 'documento_cpf');
            $model->documento_rg = UploadedFile::getInstance($model, 'documento_rg');
            $model->documento_convenio = UploadedFile::getInstance($model, 'documento_convenio');

            if ($model->save()) {
                // Verifica se o diretório 'uploads' existe, se não, cria o diretório
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // Salva os arquivos enviados, substituindo os existentes se necessário
                if ($model->documento_cpf) {
                    $model->documento_cpf->saveAs('uploads/' . $model->id . '_cpf.' . $model->documento_cpf->extension);
                }
                if ($model->documento_rg) {
                    $model->documento_rg->saveAs('uploads/' . $model->id . '_rg.' . $model->documento_rg->extension);
                }
                if ($model->documento_convenio) {
                    $model->documento_convenio->saveAs('uploads/' . $model->id . '_convenio.' . $model->documento_convenio->extension);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Paciente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!extension_loaded('fileinfo')) {
                throw new \yii\base\InvalidConfigException('The fileinfo PHP extension is not installed.');
            }

            $model->documento_cpf = UploadedFile::getInstance($model, 'documento_cpf');
            $model->documento_rg = UploadedFile::getInstance($model, 'documento_rg');
            $model->documento_convenio = UploadedFile::getInstance($model, 'documento_convenio');

            if ($model->save()) {
                // Verifica se o diretório 'uploads' existe, se não, cria o diretório
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }

                // Salva os arquivos enviados, substituindo os existentes se necessário
                if ($model->documento_cpf) {
                    $model->documento_cpf->saveAs('uploads/' . $model->id . '_cpf.' . $model->documento_cpf->extension);
                }
                if ($model->documento_rg) {
                    $model->documento_rg->saveAs('uploads/' . $model->id . '_rg.' . $model->documento_rg->extension);
                }
                if ($model->documento_convenio) {
                    $model->documento_convenio->saveAs('uploads/' . $model->id . '_convenio.' . $model->documento_convenio->extension);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Paciente model.
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

    /**
     * Retorna os nomes das pessoas já cadastradas para o campo de autocomplete.
     * @param string $term
     * @return \yii\web\Response
     */
    public function actionAutocomplete($term)
    {
        $results = \app\models\Paciente::find()
            ->select(['nome_completo as value'])
            ->where(['ilike', 'nome_completo', $term])
            ->asArray()
            ->all();

        return $this->asJson($results);
    }

    /**
     * Finds the Paciente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Paciente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Paciente::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
