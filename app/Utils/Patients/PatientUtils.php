<?php
namespace App\Utils\Patients;

class PatientUtils{
    public static function savePhoto($photo)
    {
        if ($photo) {
            $fileName = uniqid() . '_.' . $photo->extension();
            $photo->move(public_path('img/profiles/patients'), $fileName);
            $photo = 'img/profiles/patients/' . $fileName;
        }

        return $fileName;
    }

    public static function updatePhoto($photo)
    {
        if ($photo) {
            $fileName = uniqid() . '_.' . $photo->extension();
            $photo->move(public_path('img/profiles/patients'), $fileName);
            $photoOld = $photo;
    
            
    
            if ($photoOld != null) {
                $oldFilePath = public_path($photoOld);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

        return $fileName;
    }

}
