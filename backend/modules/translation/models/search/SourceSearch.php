<?php

namespace backend\modules\translation\models\search;

use backend\modules\translation\models\Source;
use backend\modules\translation\traits\ModuleTrait;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\BaseActiveRecord;

class SourceSearch extends Source
{
    use ModuleTrait;

    private $_translationSearch = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['category', 'message'], 'safe'],
            [array_keys($this->getPrefixedLanguages()), 'safe'],
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

    /** @inheritdoc */
    public function __get($name)
    {
        if (in_array($name, array_keys($this->getPrefixedLanguages()))) {
            if (!isset($this->_translationSearch[$name])) {
                return null;
            } else {
                return $this->_translationSearch[$name];
            }
        } else {
            return BaseActiveRecord::__get($name);
        }
    }

    /** @inheritdoc */
    public function __set($name, $value)
    {
        if (in_array($name, array_keys($this->getPrefixedLanguages()))) {
            $this->_translationSearch[$name] = $value;
        } else {
            BaseActiveRecord::__set($name, $value);
        }
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
        $query = Source::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            '{{%i18n_source_message}}.id' => $this->id,
        ]);

        $query->andFilterWhere(['{{%i18n_source_message}}.category' => $this->category])
            ->andFilterWhere(['like', '{{%i18n_source_message}}.message', $this->message]);

        foreach ($this->_translationSearch as $lang => $translationSearch) {
            if (!empty($translationSearch))
                $query->innerJoin("{{%i18n_message}} $lang", "{{%i18n_source_message}}.id = $lang.id")
                    ->andFilterWhere(["$lang.language" => $this->stripLanguagePrefix($lang)])
                    ->andFilterWhere(['like', "$lang.translation", $translationSearch]);
        }

        return $dataProvider;
    }
}
