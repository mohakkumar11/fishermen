<?php

namespace admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use admin\models\settings;

/**
 * SettingsSearch represents the model behind the search form about `admin\models\settings`.
 */
class SettingsSearch extends settings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['settings_id', 'free_allowed_registration', 'yearly_fee', 'default_radius_search'], 'integer'],
            [['paypal_email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = settings::find();

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
            'settings_id' => $this->settings_id,
            'free_allowed_registration' => $this->free_allowed_registration,
            'yearly_fee' => $this->yearly_fee,
            'default_radius_search' => $this->default_radius_search,
        ]);

        $query->andFilterWhere(['like', 'paypal_email', $this->paypal_email]);

        return $dataProvider;
    }
}
