<?php
/**
 * Lex Nguyen
 */

namespace common\behaviors;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use common\helpers\StringHelper;
/**
 * CodeBehavior automatically fills the specified attributes with the current user ID.
 *
 * To use CodeBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 * use yii\behaviors\CodeBehavior;
 *
 * public function behaviors()
 * {
 *     return [
 *         CodeBehavior::className(),
 *     ];
 * }
 * ```
 *
 * By default, BlameableBehavior will fill the `code` attribute with the unique random.
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         [
 *             'class' => CodeBehavior::className(),
 *             'codeAttribute' => 'code',
 *             'length' => 8,
 *         ],
 *     ];
 * }
 * ```
 *
 * @author
 * @author
 * @author
 * @since 2.0
 */
class CodeBehavior extends AttributeBehavior
{
    /**
     * @var string the attribute that will receive current user ID value
     * Set this property to false if you do not want to record the creator ID.
     */
    public $codeAttribute = 'wallet_coin';
    /**
     * @inheritdoc
     *
     * In case, when the property is `null`, the value of `Yii::$app->user->id` will be used as the value.
     */
    public $length = 35;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (empty($this->attributes)) {
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->codeAttribute],
            ];
        }
    }

    /**
     * @inheritdoc
     *
     * In case, when the [[value]] property is `null`, generate new value
     */
    protected function getValue($event)
    {
        return $this->generateUniqueRandomString($this->codeAttribute, $this->length);
    }

    protected function generateUniqueRandomString($attribute, $length) {
        $bytes = Yii::$app->getSecurity()->generateRandomKey($length);
        $randomString = "T".StringHelper::generateRandomString($bytes,$length);

        $model = clone $this->owner;
        if(!$model->findOne([$attribute => $randomString]))
            return $randomString;
        else
            return $this->generateUniqueRandomString($attribute, $length);

    }
}
