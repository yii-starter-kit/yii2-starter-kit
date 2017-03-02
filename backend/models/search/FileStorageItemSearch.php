<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FileStorageItem;

/**
 * FileStorageItemSearch represents the model behind the search form about `common\models\FileStorageItem`.
 */
class FileStorageItemSearch extends FileStorageItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'size', 'created_at'], 'integer'],
            [['component', 'base_url', 'path', 'type', 'name', 'upload_ip'], 'safe'],
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
        $query = FileStorageItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'size' => $this->size,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'component', $this->component])
            ->andFilterWhere(['like', 'base_url', $this->base_url])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'upload_ip', $this->upload_ip]);

        return $dataProvider;
    }
}
