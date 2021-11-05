<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\User;
use app\models\Logins;
use app\models\Usuarios;
use app\models\LoginForm;

use app\classes\Funcoes;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout','index','cadastro'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

        $model = new LoginForm();
        $modelUser = new User();
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/videos/index');
        }

        $post = Yii::$app->request->post();
        if($post){

            $funcoes = new Funcoes();
            $retorno = $funcoes->sendGet('/login/'.$post['LoginForm']['username']);

            if(isset($retorno->status) && $retorno->status == 200){
                $post['LoginForm']['hash'] = $retorno->login->senha;

                $modelUser->id              = 100;
                $modelUser->idLogado        = $retorno->login->id;
                $modelUser->username        = $retorno->usuario->nome.' '.$retorno->usuario->sobrenome;
                $modelUser->nivel           = $retorno->usuario->tipo;

                $_SESSION['login'] = $modelUser;
                $_SESSION['name']  = $modelUser->username;
                if($model->load($post) && $model->login()){
                    return $this->redirect('/videos/index');
                }

                $model->addError('password','Senha incorrreta');
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionCadastro()
    {
        $modelLogin = new Logins();
        $modelUsers = new Usuarios();
        $modelLogin->validators[0]->attributes[] = 'confirma_senha';
        $post = Yii::$app->request->post();

        if($post){

            $post['Usuarios']['tipo'] = 1;
            if($modelLogin->load($post) && $modelUsers->load($post)){
                unset($post['Logins']['confirma_senha']);
                $post['Logins']['senha'] = Yii::$app->getSecurity()->generatePasswordHash($modelLogin->senha);


                $funcoes = new Funcoes();
                $retorno = $funcoes->sendPost('/usuario',$post);
                if(isset($retorno->status) && $retorno->status == 200){
                    return $this->redirect('/');
                }else{
                    return $this->render('cadastro', [
                        'modelLogin' => $modelLogin,
                        'modelUsers' => $modelUsers
                    ]);
                }
            }else{
                return $this->render('cadastro', [
                    'modelLogin' => $modelLogin,
                    'modelUsers' => $modelUsers
                ]);
            }

        }else{
            return $this->render('cadastro', [
                'modelLogin' => $modelLogin,
                'modelUsers' => $modelUsers
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
