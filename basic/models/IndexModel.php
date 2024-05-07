<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class IndexModel extends Model
{
    public $CarteGrise;

    public function rules()
    {
        return [
            [['CarteGrise'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->CarteGrise !== null) {
                // Définir le chemin de destination
                $destinationPath = \Yii::getAlias('@webroot') . '/uploads/';
                $fileName = \Yii::$app->user->identity->id . '_' . $this->CarteGrise->baseName . '.' . $this->CarteGrise->extension;
                $filePath = $destinationPath . $fileName;

                if ($this->CarteGrise->saveAs($filePath)) {
                    // Fichier déplacé avec succès
                    // Associer le nom du fichier à l'utilisateur connecté
                    \Yii::$app->user->identity->cg = $fileName;
                    \Yii::$app->user->identity->save(false);
                    return true;
                } else {
                    // Erreur lors du déplacement du fichier
                    // Gérer l'erreur en conséquence
                }
            }
        }
        return false;
    }
}