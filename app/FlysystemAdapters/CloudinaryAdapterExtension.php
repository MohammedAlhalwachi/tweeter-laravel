<?php

namespace App\FlysystemAdapters;

use CarlosOCarvalho\Flysystem\Cloudinary\CloudinaryAdapter;
use Cloudinary as ClDriver;

class CloudinaryAdapterExtension extends CloudinaryAdapter {
    /**
     * @param $path
     * @return string
     */
    public function getUrl($path){
        $config = ClDriver::config();

        return 'https://res.cloudinary.com/' . $config['cloud_name'] . '/image/upload/' . $path . '.' . pathinfo($path)['extension'];
    }
}
