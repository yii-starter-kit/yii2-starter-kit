<?php

namespace backend\models\search;

use common\models\TimelineEvent;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * TimelineEventSearch represents the model behind the search form about `common\models\TimelineEvent`.
 */
class TimelineEventSearch extends TimelineEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application', 'category', 'event', 'created_at'], 'safe'],
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
        $query = TimelineEvent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'application', $this->application]);
        $query->andFilterWhere(['like', 'category', $this->category]);
        $query->andFilterWhere(['like', 'event', $this->event]);

        return $dataProvider;
    }
}
