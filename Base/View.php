<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 14.03.2020
 * Time: 18:47
 */

namespace Base;


class View
{
    private $templatePath;



    private $data = [];

    public function __construct($path = '')
    {
        $this->templatePath = $path;
    }

    /**
     * @param string $templatePath
     */
    public function setTemplatePath($path)
    {
        $this->templatePath = $path;
    }

    public function __set($name, $value)
    {
        $this->data['name'] = $value;
        $this->$name = $value;
    }

    public function __get($name)
    {
        if (isset($this->$data['name'])) {
            return $this->data['name'];
        }

        return '';
    }

    public function render($tplName = '') {
        $path = trim($this->templatePath, DIRECTORY_SEPARATOR);
        $tplFileName = $path . DIRECTORY_SEPARATOR . $tplName;
        ob_start(null, null,  PHP_OUTPUT_HANDLER_STDFLAGS );
        require $tplFileName;
        return ob_get_clean();
    }

}