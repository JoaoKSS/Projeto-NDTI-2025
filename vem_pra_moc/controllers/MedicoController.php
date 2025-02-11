<?php

namespace app\controllers;

use Yii;
use app\models\Medico;
use app\models\MedicoSearch;
use app\models\Especialidade;
use app\models\DisponibilidadeHorario;
use app\models\Usuario;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MedicoController implements the CRUD actions for Medico model.
 */
class MedicoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Medico models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Medico model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Medico model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Medico();

        if ($model->load(Yii::$app->request->post())) {
            // Definir horario_atendimento
            $model->horario_atendimento = 'Horários cadastrados no sistema';
            
            if ($model->save()) {
                // Salvar especialidades
                if (is_array($model->especialidades_ids)) {
                    foreach ($model->especialidades_ids as $especialidadeId) {
                        $especialidade = Especialidade::findOne($especialidadeId);
                        if ($especialidade) {
                            $model->link('especialidades', $especialidade);
                        }
                    }
                }

                // Salvar disponibilidades
                $this->saveDisponibilidadeHorarios($model, Yii::$app->request->post('DisponibilidadeHorario'));
                
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao salvar médico: ' . json_encode($model->errors));
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Medico model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Carregar especialidades associadas ao médico
        $model->especialidades_ids = $model->getEspecialidades()->select('id')->column();

        if ($model->load(Yii::$app->request->post())) {
            // Definir horario_atendimento
            $model->horario_atendimento = 'Horários cadastrados no sistema';
            
            if ($model->save()) {
                // Atualizar especialidades
                $model->unlinkAll('especialidades', true);
                if (is_array($model->especialidades_ids)) {
                    foreach ($model->especialidades_ids as $especialidadeId) {
                        $especialidade = Especialidade::findOne($especialidadeId);
                        if ($especialidade) {
                            $model->link('especialidades', $especialidade);
                        }
                    }
                }

                // Atualizar disponibilidades
                $this->saveDisponibilidadeHorarios($model, Yii::$app->request->post('DisponibilidadeHorario'));

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Erro ao atualizar médico: ' . json_encode($model->errors));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Medico model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Retorna os nomes completos dos usuários já cadastrados para o campo de autocomplete.
     * @param string $term
     * @return \yii\web\Response
     */
    public function actionAutocomplete($term)
    {
        $results = Usuario::find()
            ->select(['nome_completo as value'])
            ->where(['ilike', 'nome_completo', $term])
            ->asArray()
            ->all();

        return $this->asJson($results);
    }

    /**
     * Retorna os CRMs dos médicos já cadastrados para o campo de autocomplete.
     * @param string $term
     * @return \yii\web\Response
     */
    public function actionAutocompleteCrm($term)
    {
        $results = Medico::find()
            ->select(['crm as value'])
            ->where(['ilike', 'crm', $term])
            ->asArray()
            ->all();

        return $this->asJson($results);
    }

    /**
     * Finds the Medico model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Medico the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medico::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Saves the disponibilidade horarios for a Medico model.
     * @param Medico $model
     * @param array $disponibilidadeData
     */
    protected function saveDisponibilidadeHorarios($model, $disponibilidadeData)
    {
        DisponibilidadeHorario::deleteAll(['medico_id' => $model->id]);

        if (isset($disponibilidadeData['dia_da_semana'])) {
            foreach ($disponibilidadeData['dia_da_semana'] as $index => $dia) {
                $disponibilidade = new DisponibilidadeHorario();
                $disponibilidade->medico_id = $model->id;
                $disponibilidade->dia_da_semana = $dia;
                $disponibilidade->horario_inicio = $disponibilidadeData['horario_inicio'][$index] ?? null;
                $disponibilidade->horario_fim = $disponibilidadeData['horario_fim'][$index] ?? null;
                if (!$disponibilidade->save()) {
                    Yii::error("Erro ao salvar disponibilidade: " . json_encode($disponibilidade->errors));
                } else {
                    Yii::info("Disponibilidade salva com sucesso: " . json_encode($disponibilidade->attributes));
                }
            }
        }
    }
}
