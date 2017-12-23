<?php

use yii\db\Schema;
use common\rbac\Migration;

class m150625_215624_init_permissions extends Migration
{
    public function up()
    {
        $managerRole = $this->auth->getRole(\common\models\User::ROLE_MANAGER);
        $userRole = $this->auth->getRole(\common\models\User::ROLE_USER);

        $loginToBackend = $this->auth->createPermission('loginToBackend');
        $this->auth->add($loginToBackend);
        $this->auth->addChild($managerRole, $loginToBackend);
        $this->auth->addChild($userRole, $loginToBackend);
    }

    public function down()
    {
        $this->auth->remove($this->auth->getPermission('loginToBackend'));
    }
}
