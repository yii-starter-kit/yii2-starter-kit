<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\KeyStorageItem;

/**
 * KeyStorageItemSearch represents the model behind the search form about `common\models\KeyStorageItem`.
 */
class KeyStorageItemSearch extends KeyStorageItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'string'],
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
        $query = KeyStorageItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'like', 'key', $this->key
        ]);
        $query->andFilterWhere([
            'like', 'value', $this->value
        ]);

        return $dataProvider;
    }
}
