<?php

use yii\db\Schema;
use yii\db\Migration;

class m160411_112938_add_indexTextButton extends Migration
{
    public function up()
    {
        $this->addColumn('content','indexTextButton','string not null');
        $this->addColumn('content','indexAltName','string not null');
    }

    public function down()
    {

       $this->dropColumn('content','indexTextButton');
       $this->dropColumn('content','indexAltName');

        return false;
    }
}
