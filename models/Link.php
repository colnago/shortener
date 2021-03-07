<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * @property int $id
 * @property string $url
 * @property string $hash
 * @property int|null $counter
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Link extends \yii\db\ActiveRecord
{

    public $short_url = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%link}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'hash'], 'required'],
            [['counter', 'created_at', 'updated_at'], 'default', 'value' => 0],
            [['counter', 'created_at', 'updated_at'], 'integer'],
            [['url', 'hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Link ID',
            'url' => 'Url',
            'hash' => 'Hash',
            'counter' => 'Counter',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public static function URLStatusChecker($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $response  = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return (($code >= 200 || $code >= 310) && $response);
    }


    /**
     * Check URL
     *
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $url = $this->url;
        if( !Link::URLStatusChecker($url) ) {
            $this->addError('Url', 'Link contains virus!!!');
            return false;
        }
        return parent::beforeSave($insert);
    }

    /**
     * Create short_url
     *
     * @inheritdoc
     */
    public function afterFind()
    {
        parent::afterFind();
        if ($this->short_url === false) {
            $this->short_url = Url::base(true) . '/' . $this->hash;
        }
    }

    /**
     * Generate hash for shorten url
     *
     * @return string
     */
    public static function generateHash()
    {
        return substr(md5(uniqid(rand(), true)),0,6);
    }

    /**
     * Update counter
     */
    public function updateCounter()
    {
        $this->counter++;
        $this->save(false);
    }

    /**
     * URL is valid for 1year
     *
     * @return bool
     */
    public function isActive()
    {
        return (strtotime("now") < strtotime("+1year", $this->created_at));
    }

    /**
     * Finds link by hash
     *
     * @param string $hash
     * @return static|null
     */
    public static function findByHash($hash)
    {
        return static::findOne(['hash' => $hash]);
    }


    /**
     * Create shorten link.
     *
     * @return Link|null the saved model or null if saving fails
     */
    public function createLink()
    {
        if(($link = Link::findOne(['url'=>$this->url]) ) !== null) {
            return $link;
        }

        $link = new Link();
        $link->url = $this->url;
        $link->hash = Link::generateHash();
        if (!$link->validate()) {
            return null;
        }
        return $link->save() ? $link : null;
    }
}

