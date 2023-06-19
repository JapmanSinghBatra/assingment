<?php
namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password_hash
 * @property string $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'role'], 'required'],
            [['role'], 'string'],
            [['username', 'password_hash'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'role' => 'Role',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return \yii\web\IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * @return \yii\web\IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Not needed for this example
        return null;
    }

    /**
     * Finds user by username.
     * @param string $username
     * @return \yii\web\IdentityInterface|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Returns the user's ID.
     * @return int|string the user's ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the user's auth key.
     * @return string the user's auth key
     */
    public function getAuthKey()
    {
        // Not needed for this example
        return null;
    }

    /**
     * Validates the given auth key.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid
     */
    public function validateAuthKey($authKey)
    {
        // Not needed for this example
        return false;
    }

    /**
     * Validates the given password.
     * @param string $password the password to be validated
     * @return bool whether the given password is valid for the current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
