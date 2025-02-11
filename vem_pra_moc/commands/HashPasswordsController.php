<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Usuario;

class HashPasswordsController extends Controller
{
    public function actionIndex()
    {
        $users = Usuario::find()->all();
        foreach ($users as $user) {
            if (!$this->isPasswordHashed($user->senha)) {
                $user->senha = Yii::$app->getSecurity()->generatePasswordHash($user->senha);
                $user->save(false);
                echo "Password for user {$user->email} has been hashed.\n";
            }
        }
        echo "All passwords have been hashed.\n";
    }

    private function isPasswordHashed($password)
    {
        return preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $password);
    }
}
