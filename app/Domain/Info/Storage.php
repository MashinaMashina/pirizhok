<?php

namespace App\Domain\Info;

class Storage
{
    protected $info = false;

    public function getInfo()
    {
        if ($this->info === false) {
            $this->load();
        }

        return $this->info;
    }

    public function saveInfo($info)
    {
        if (! $info) {
            return false;
        }

        $content = "<?php\n\n\$info = " . var_export($info->getAll(), true) . ';';
        return file_put_contents(ROOT_DIR . '/config/info.php', $content) > 0;
    }

    protected function load()
    {
        include ROOT_DIR . '/config/info.php';

        $obj = new Info();
        $obj->load($info);

        $this->info = $obj;
    }
}