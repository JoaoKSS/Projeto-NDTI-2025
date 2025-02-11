<?php

namespace app\controllers;

use app\models\Medicoespecialidade;
use app\models\MedicoespecialidadeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MedicoespecialidadeController implements the CRUD actions for Medicoespecialidade model.
 */
class MedicoespecialidadeController extends Controller
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
     * Lists all Medicoespecialidade models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MedicoespecialidadeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medicoespecialidade model.
     * @param int $medico_id Medico ID
     * @param int $especialidade_id Especialidade ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($medico_id, $especialidade_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($medico_id, $especialidade_id),
        ]);
    }

    /**
     * Creates a new Medicoespecialidade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Medicoespecialidade();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'medico_id' => $model->medico_id, 'especialidade_id' => $model->especialidade_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Medicoespecialidade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $medico_id Medico ID
     * @param int $especialidade_id Especialidade ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($medico_id, $especialidade_id)
    {
        $model = $this->findModel($medico_id, $especialidade_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'medico_id' => $model->medico_id, 'especialidade_id' => $model->especialidade_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Medicoespecialidade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $medico_id Medico ID
     * @param int $especialidade_id Especialidade ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($medico_id, $especialidade_id)
    {
        $this->findModel($medico_id, $especialidade_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Medicoespecialidade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $medico_id Medico ID
     * @param int $especialidade_id Especialidade ID
     * @return Medicoespecialidade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($medico_id, $especialidade_id)
    {
        if (($model = Medicoespecialidade::findOne(['medico_id' => $medico_id, 'especialidade_id' => $especialidade_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
