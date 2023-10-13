<?php

namespace common\models;

use common\models\Guest;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class GuestSearch extends Guest
{
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            ['username', 'string'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Guest::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}