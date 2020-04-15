<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\Post;

/**
 * PostSearch represents the model behind the search form of `admin\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'userId'], 'integer'],
            [['message', 'imagename', 'videoname', 'addedon', 'status'], 'safe'],
            [['totalvotetodelete'], 'number'],
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
        $query = Post::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'userId' => $this->userId,
            'addedon' => $this->addedon,
            'totalvotetodelete' => $this->totalvotetodelete,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'imagename', $this->imagename])
            ->andFilterWhere(['like', 'videoname', $this->videoname])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
