<?php

namespace backend\modules\i18n\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\i18n\models\I18nSourceMessage;

/**
 * I18nSourceMessageSearch represents the model behind the search form about `backend\modules\i18n\models\I18nSourceMessage`.
 */
class I18nSourceMessageSearch extends I18nSourceMessage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message'], 'safe'],
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
        $query = I18nSourceMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            '{{%i18n_source_message}}.id' => $this->id,
        ]);

        $query->andFilterWhere(['like', '{{%i18n_source_message}}.category', $this->category])
            ->andFilterWhere(['like', '{{%i18n_source_message}}.message', $this->message]);

        return $dataProvider;
    }
}
