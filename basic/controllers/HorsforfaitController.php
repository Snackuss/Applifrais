<?php

namespace app\controllers;

use app\models\Horsforfait;
use app\models\HorsforfaitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;


class HorsforfaitController extends Controller
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $utilisateurConnecte = Yii::$app->user->identity;
        $searchModel = new HorsforfaitSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['id_u' => $utilisateurConnecte->id]);

        $totalAmount = $dataProvider->query->sum('amount');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new Horsforfait();
        $model->id_u = Yii::$app->user->getId();
        $message = "";
    
        if ($model->load(Yii::$app->request->post())) {
            $fichier = UploadedFile::getInstance($model, 'attachement');
    
            if ($fichier !== null) {
                $destinationPath = Yii::getAlias('@webroot') . '/uploads/';
                $fileName = $fichier->baseName . '.' . $fichier->extension;
                $filePath = $destinationPath . $fileName;
    
                if ($fichier->saveAs($filePath)) {
                    $model->attachement = $fileName;
                } else {
                    $message ="Une erreur s'est produite";
                }
            }
    
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Horsforfait::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
