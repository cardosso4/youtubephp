<?php

namespace app\controllers;

use Yii;
use app\classes\Funcoes;
use app\models\Logins;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
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
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param int $id ID
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
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelLogin = new Logins();
        $modelUsers = new Usuarios();
        $modelLogin->validators[0]->attributes[] = 'confirma_senha';
        $post = Yii::$app->request->post();

        if($post){

            if($modelLogin->load($post) && $modelUsers->load($post)){
                unset($post['Logins']['confirma_senha']);
                $post['Logins']['senha'] = Yii::$app->getSecurity()->generatePasswordHash($modelLogin->senha);

                $funcoes = new Funcoes();
                $retorno = $funcoes->sendPost('/usuario',$post);
                if(isset($retorno->status) && $retorno->status == 200){
                    return $this->redirect('index');
                }else{
                    return $this->render('create', [
                        'modelLogin' => $modelLogin,
                        'modelUsers' => $modelUsers
                    ]);
                }
            }else{
                return $this->render('create', [
                    'modelLogin' => $modelLogin,
                    'modelUsers' => $modelUsers
                ]);
            }

        }else{
            return $this->render('create', [
                'modelLogin' => $modelLogin,
                'modelUsers' => $modelUsers
            ]);
        }
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelUsers = new Usuarios();
        $post = Yii::$app->request->post();
        $funcoes = new Funcoes();


        $retornoUpdate = $funcoes->sendGet('/usuario/serachupdate/'.$id);
        $modelUsers->nome           = $retornoUpdate->dados->nome;
        $modelUsers->sobrenome      = $retornoUpdate->dados->sobrenome;
        $modelUsers->telefone       = $retornoUpdate->dados->telefone;
        $modelUsers->tipo           = $retornoUpdate->dados->tipo;

        if($post){
            if($modelUsers->load($post)){
                $post['Usuarios']['id'] = $id;

                $retorno = $funcoes->sendPut('/usuario',$post);
                if(isset($retorno->status) && $retorno->status == 200){
                    return $this->redirect('index');
                }else{
                    return $this->render('update', [
                        'modelUsers' => $modelUsers,
                    ]);
                }
            }else{
                return $this->render('update', [
                    'modelUsers' => $modelUsers,
                ]);
            }

        }else{
            return $this->render('update', [
                'modelUsers' => $modelUsers,
            ]);
        }
    }

    public function actionHistorico($id){

        $funcoes = new Funcoes();
        $retorno = $funcoes->sendGet('/usuario/historico/'.$id);

        return $this->render('historico',[
            'retorno' => $retorno
        ]);

    }

    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $funcoes = new Funcoes();
        $retorno = $funcoes->sendDelete('/usuario/'.$id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
