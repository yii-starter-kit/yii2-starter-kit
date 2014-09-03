<?php

namespace backend\models\search;

use trntv\filekit\storage\models\FileStorageItem;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

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
            [['id', 'size', 'status'], 'integer'],
            [['url', 'path', 'mimeType', 'upload_ip', 'repository'], 'safe'],
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
            'upload_time' => $this->upload_time,
        ]);

        $query->andFilterWhere(['like', 'storage', $this->storage])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'mime', $this->mime]);

        return $dataProvider;
    }
}
