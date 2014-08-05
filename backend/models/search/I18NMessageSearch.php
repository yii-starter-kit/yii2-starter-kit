<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\I18NMessage;

/**
 * I18MessageSearch represents the model behind the search form about `backend\models\I18NMessage`.
 */
class I18NMessageSearch extends I18NMessage
{
    public $sourceMessage;
    public $sourceCategory;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'translation', 'sourceMessage', 'sourceCategory'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = I18NMessage::find()->joinWith('source');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'translation', $this->translation])
            ->andFilterWhere(['like', '{{%i18n_source_message}}.message', $this->sourceMessage])
            ->andFilterWhere(['like', '{{%i18n_source_message}}.category', $this->sourceCategory]);

        return $dataProvider;
    }
}
