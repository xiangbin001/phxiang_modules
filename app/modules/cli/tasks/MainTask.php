<?php
namespace Phxiang_modules\Modules\Cli\Tasks;

class MainTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        echo "Congratulations! You are now flying with Phalcon CLI!";
    }

    /**
     * @param array $params
     * php app/cli.php main test world universe
     */
    public function testAction(array $params)
    {
        echo sprintf('hello %s', $params[0]) . PHP_EOL;
        echo sprintf('best regards, %s', $params[1]) . PHP_EOL;
    }
}
