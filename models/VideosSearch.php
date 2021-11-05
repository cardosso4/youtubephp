<?php

namespace app\models;

use Yii;
use app\classes\Funcoes;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Videos;

/**
 * VideosSearch represents the model behind the search form of `app\models\Videos`.
 */
class VideosSearch extends Videos
{
    public $pesquisar;
    public $limite;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuario_id', 'titulo'], 'integer'],
            [['video', 'createdAt', 'updatedAt','pesquisar','limite'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Videos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $this->limite = $this->limite!=''?$this->limite:1;

        $funcoes = new Funcoes();
        $retorno = $funcoes->sendGet('/youtube/search/'.urlencode($this->pesquisar).'/'.$this->limite.'/'.Yii::$app->user->identity->idLogado);

//        $diretorio = \Yii::getAlias('@webroot'); // /home/nsshopco/public_html
//        $diretorio = $diretorio.'/json/';
//        $pasta = scandir($diretorio);
//        $file = file($diretorio.$pasta[2]);
//
//
//        if(isset($_SESSION['youtube'])){
//            $retorno = $_SESSION['youtube'];
//        }else{
//            $_SESSION['youtube'] = json_decode($file[0]);
//            $retorno = $_SESSION['youtube'];
//        }

        if(isset($retorno) && $retorno->status == 200){
            return $retorno->dados;
        }


        return null;

    }
}
