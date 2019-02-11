<?php
N2Loader::import('libraries.cache.cache');

class N2CacheImage extends N2Cache {

    protected $_storageEngine = 'filesystem';

    protected $lazy = false;

    protected function getScope() {
        return 'image';
    }

    public function setLazy($lazy) {
        $this->lazy = $lazy;
    }

    public function makeCache($fileExtension, $callable, $parameters = array(), $hash = false) {

        if (!$hash) {
            $hash = $this->generateHash($fileExtension, $callable, $parameters);
        }

        if (strpos($parameters[1], '?') !== false) {
            $fileNameParts = explode('?', $parameters[1]);
            $keepFileName  = pathinfo($fileNameParts[0], PATHINFO_FILENAME);
        } else {
            $keepFileName = pathinfo($parameters[1], PATHINFO_FILENAME);
        }

        $fileName = $hash . (!empty($keepFileName) ? '/' . $keepFileName : '') . '.' . $fileExtension;

        if (!$this->exists($fileName)) {
            if (!$this->lazy) {
                array_unshift($parameters, $this->getPath($fileName));
                call_user_func_array($callable, $parameters);
            } else {

                return $parameters[1];
            }
        }

        return $this->getPath($fileName);
    }

    private function generateHash($fileExtension, $callable, $parameters) {
        return md5(json_encode(array(
            $fileExtension,
            $callable,
            $parameters
        )));
    }
}

class N2StoreImage extends N2Cache {

    protected $_storageEngine = 'filesystem';

    protected function getScope() {
        return 'image';
    }

    public function makeCache($fileName, $content) {
        if (!$this->isImage($fileName)) {
            return false;
        }

        if (!$this->exists($fileName)) {
            $this->set($fileName, $content);
        }

        return $this->getPath($fileName);
    }

    private function isImage($fileName) {
        $supported_image = array(
            'gif',
            'jpg',
            'jpeg',
            'png',
            'mp4',
            'mp3',
            'webp',
            'svg'
        );

        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (in_array($ext, $supported_image)) {
            return true;
        }

        return false;
    }
}