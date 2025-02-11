namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Usuario;

class UpdateUserPasswordsController extends Controller
{
    public function actionIndex()
    {
        $users = Usuario::find()->all();
        foreach ($users as $user) {
            // Check if the password is already hashed
            if (!$this->isPasswordHashed($user->senha)) {
                // Hash the password
                $user->senha = Yii::$app->getSecurity()->generatePasswordHash($user->senha);
                if ($user->save(false)) {
                    echo "Updated password for user ID: {$user->id}\n";
                } else {
                    echo "Failed to update password for user ID: {$user->id}\n";
                }
            }
        }
        echo "All user passwords have been updated.\n";
    }

    private function isPasswordHashed($password)
    {
        return preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $password);
    }
}
