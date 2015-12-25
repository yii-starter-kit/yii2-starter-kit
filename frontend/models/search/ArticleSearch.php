<?php

namespace frontend\models\search;

use common\models\Article;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['slug', 'title'], 'safe'],
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
        $query = Article::find()->published();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        //q=word
        if(!empty($params['q']))
        {
        	$q=$params['q'];
        	//$q="·¢";
        	//$query2=Article::find();
        	//$query2->andWhere(['LIKE', 'title', $q]);
        	//$t=$query2->all();
        	
        	$query->andWhere(['LIKE', 'title', $q])->orWhere(['LIKE', 'body', $q]);
        	return $dataProvider;
        }

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
