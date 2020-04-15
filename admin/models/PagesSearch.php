<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\Pages;

/**
 * PagesSearch represents the model behind the search form of `admin\models\Pages`.
 */
class PagesSearch extends Pages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'featuredimage', 'metatitle', 'metakeywords', 'metadescription', 'status'], 'safe'],
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
        $query = Pages::find();

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
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'featuredimage', $this->featuredimage])
            ->andFilterWhere(['like', 'metatitle', $this->metatitle])
            ->andFilterWhere(['like', 'metakeywords', $this->metakeywords])
            ->andFilterWhere(['like', 'metadescription', $this->metadescription])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
