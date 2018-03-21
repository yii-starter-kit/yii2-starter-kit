<?php

namespace backend\modules\system\models\search;

use backend\modules\system\models\SystemLog;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SystemLogSearch represents the model behind the search form about `backend\models\SystemLog`.
 */
class SystemLogSearch extends SystemLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'message'], 'integer'],
            [['log_time'], 'filter', 'filter' => 'strtotime', 'skipOnEmpty' => true],
            [['log_time'], 'default', 'value' => null],
            [['category', 'prefix', 'level'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SystemLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'level' => $this->level,
            'message' => $this->message,
        ]);

        if ($this->log_time !== null) {
            $query->andFilterWhere(['between', 'log_time', $this->log_time, $this->log_time + 3600 * 24]);
        }

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'prefix', $this->prefix]);

        return $dataProvider;
    }
}
