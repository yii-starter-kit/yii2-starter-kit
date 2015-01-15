<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WidgetCarouselItem;

/**
 * WidgetCarouselItemSearch represents the model behind the search form about `common\models\WidgetCarouselItem`.
 */
class WidgetCarouselItemSearch extends WidgetCarouselItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'carousel_id', 'status', 'order'], 'integer'],
            [['path', 'url', 'caption'], 'safe'],
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
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search($params = null)
    {
        $query = WidgetCarouselItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'carousel_id' => $this->carousel_id,
            'status' => $this->status,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'caption', $this->caption]);

        return $dataProvider;
    }
}
