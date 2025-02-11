<?php

namespace app\controllers;

use app\models\Historicomedico;
use app\models\HistoricomedicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Alergia;
use app\models\Doenca;
use app\models\Medicamento;

/**
 * HistoricomedicoController implements the CRUD actions for Historicomedico model.
 */
class HistoricomedicoController extends Controller
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
     * Lists all Historicomedico models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HistoricomedicoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Historicomedico model.
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
     * Creates a new Historicomedico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int|null $paciente_id
     * @return string|\yii\web\Response
     */
    public function actionCreate($paciente_id = null)
    {
        $model = new Historicomedico();
        $model->paciente_id = $paciente_id;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $this->saveRelatedData($model, $this->request->post());
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
            $model->setAlergiasString($model->getAlergiasString());
            $model->setDoencasString($model->getDoencasString());
            $model->setMedicamentosString($model->getMedicamentosString());
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Historicomedico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $this->saveRelatedData($model, $this->request->post());
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->setAlergiasString($model->getAlergiasString());
            $model->setDoencasString($model->getDoencasString());
            $model->setMedicamentosString($model->getMedicamentosString());
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Historicomedico model.
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
     * Finds the Historicomedico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Historicomedico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Historicomedico::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Saves related data for Historicomedico model.
     * @param Historicomedico $model
     * @param array $postData
     */
    protected function saveRelatedData($model, $postData)
    {
        $model->unlinkAll('alergias', true);
        $model->unlinkAll('doencas', true);
        $model->unlinkAll('medicamentos', true);

        $alergias = explode(',', $postData['Historicomedico']['alergiasString']);
        foreach ($alergias as $descricao) {
            $alergia = new Alergia();
            $alergia->descricao = trim($descricao);
            $alergia->historico_medico_id = $model->id;
            $alergia->save();
        }

        $doencas = explode(',', $postData['Historicomedico']['doencasString']);
        foreach ($doencas as $descricao) {
            $doenca = new Doenca();
            $doenca->descricao = trim($descricao);
            $doenca->historico_medico_id = $model->id;
            $doenca->save();
        }

        $medicamentos = explode(',', $postData['Historicomedico']['medicamentosString']);
        foreach ($medicamentos as $nome) {
            $medicamento = new Medicamento();
            $medicamento->nome_medicamento = trim($nome);
            $medicamento->historico_medico_id = $model->id;
            $medicamento->save();
        }
    }
}
