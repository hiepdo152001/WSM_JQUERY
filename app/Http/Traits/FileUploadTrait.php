<?php

namespace App\Http\Traits;

use App\Models\MerchandiseImages;
use App\Models\MessageImages;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{

    public function getFilePath(object $req, string $type)
    {
        $isImage = $this->checkValidate($req);

        if ($isImage) {

            $path = $req->store('public/' . $type);
            return substr($path, strlen('public/'));
        } else {

            return false;
        }
    }


    public function checkValidate(object $req)
    {
        $rules = ['jpeg', 'jpg', 'png', 'gif'];

        $typeOfFile = $req->extension();
        $sizeOfFile = number_format($req->getSize() / 1048576, 2);

        if (in_array($typeOfFile, $rules) && $sizeOfFile < 10) {
            return true;
        } else {
            return false;
        }
    }
}
