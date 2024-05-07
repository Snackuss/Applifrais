<?php

namespace app\controllers;

use app\models\Forfait;
use app\models\ForfaitSearch;
use app\models\Reference;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;



class ForfaitController extends Controller
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
        $searchModel = new ForfaitSearch();
        $month = date('m');
        $year = date('Y');

        
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->andWhere(['id_u' => $utilisateurConnecte->id]);
        $dataProvider->query->andFilterWhere(['MONTH(date)' => $month]);
        $dataProvider->query->andFilterWhere(['YEAR(date)' => $year]);
        
        // Calcul de la somme des frais pour le mois en cours
        $totalAmount = 0;
        foreach ($dataProvider->models as $forfait) {
            if ($forfait->frais !== null && $forfait->frais->type === 'Frais Kilométrique') {
                $vehicule = $utilisateurConnecte->vehicule;
                $reference = Reference::findOne(['id_chevaux' => $vehicule]);
                if ($reference !== null) {
                    $totalAmount += $forfait->nombre * $reference->quotient;
                }
            } else {
                if ($forfait->frais !== null && $forfait->frais->montant !== null) {
                    $totalAmount += intval($forfait->nombre) * floatval($forfait->frais->montant);
                }
            }
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalAmount' => $totalAmount,
            'month' => $month,
            'year' => $year,
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
        $model = new Forfait();
    
        // Définition de l'ID de l'utilisateur connecté
        $model->id_u = Yii::$app->user->getId();
    
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Le modèle a été sauvegardé avec succès
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            // Afficher le formulaire de création des frais
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
        if (($model = Forfait::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
