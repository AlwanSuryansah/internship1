<?php

namespace app\controllers;

use Yii;
use app\models\Prediksi;
use app\models\PrediksiMo;
use app\models\PrediksiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TbDatatran;
use app\models\TbDatatranSearch;
use kartik\mpdf\Pdf;


/**
 * PrediksiController implements the CRUD actions for Prediksi model.
 */
class PrediksiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Prediksi models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Prediksi();
           if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            echo "sukses";
            die();
        }



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }

    /**
     * Displays a single Prediksi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Prediksi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {


        $model = new Prediksi();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::app()->user->setFlash('success', "Data1 saved!");
                    return $this->redirect(['view', 'id' => $model->id_data]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Prediksi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_data]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Prediksi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Prediksi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prediksi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prediksi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }




        public function actionPrediksiii()
    {

        $model = new Prediksi();
           if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            echo "sukses";
            die();
        }
        return $this->render('prediksiii', [
            'model' => $model,
        ]);
    }

     public function actionpre3()
    {
        $model = new Prediksi();


        if ($model->load(Yii::$app->request->post())) {
           $model=jumlah::model()->findByPk(1);
            if ($model->save()){
            $barang=Barang::findOne($model->id_barang);
            $barang->stok+=$model->jumlah_barang;
            $barang->harga_beli=$model->harga_beli;
            //$barang->total_harga=$model->total_harga;
            $barang->tanggal_masuk=date('y-m-d H:i:s');
            $barang->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


     public function actionHarike3()
    {
        $data1 = Prediksi::findOne(1);
        $data2 = Prediksi::findOne(2);
        $pre3 = $data1->jumlah + $data2->jumlah;
        return $this->render('harike3');
    }

    
     public function actionHarike4()
    {
        return $this->render('harike4');
    }


     public function actionHarike5()
    {
        return $this->render('harike5');
    }


     public function actionHarike6()
    {
        return $this->render('harike6');
    }


     public function actionHarike7()
    {
        return $this->render('harike7');
    }

    

public function pertama()

{
    $total=$this->sum("jumlah");
    return $total;
}



public function prantara()

{
    $prantara=$this->count("jumlah");
    return $prantara;
}



public function kedua()

{

    $presabtu=pertama()/prantara();
    return $presabtu;
}



public function pilihhan()

{
    $presabtu=pertama()/prantara();
    return $presabtu;
    
}

  
    public function actionReport() {

        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


      // get your HTML raw content without any layouts or scripts
      $content = $this->renderPartial('cetak', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);

      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
          // set to use core fonts only
          'mode' => Pdf::MODE_CORE,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'content' => $content,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          // any css to be embedded if required
          'cssInline' => '.kv-heading-1{font-size:18px}',
           // set mPDF properties on the fly
          'options' => ['title' => 'Report Title'],
           // call mPDF methods on the fly
           'methods' => [
               'SetHeader'=>['LAPORAN PREDIKSI ||Dicetak Pada: ' . date("d-M-Y")],
               'SetFooter'=>['|Halaman {PAGENO}|'],
          ]
      ]);



return $pdf->render();
  }

public function actionReport1() {

        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


      // get your HTML raw content without any layouts or scripts
      $content = $this->renderPartial('cetak4', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);

      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
          // set to use core fonts only
          'mode' => Pdf::MODE_CORE,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'content' => $content,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          // any css to be embedded if required
          'cssInline' => '.kv-heading-1{font-size:18px}',
           // set mPDF properties on the fly
          'options' => ['title' => 'Report Title'],
           // call mPDF methods on the fly
           'methods' => [
               'SetHeader'=>['LAPORAN PREDIKSI ||Dicetak Pada: ' . date("d-M-Y")],
               'SetFooter'=>['|Halaman {PAGENO}|'],
          ]
      ]);



return $pdf->render();
  }

  public function actionReport2() {

        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


      // get your HTML raw content without any layouts or scripts
      $content = $this->renderPartial('cetak5', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);

      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
          // set to use core fonts only
          'mode' => Pdf::MODE_CORE,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'content' => $content,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          // any css to be embedded if required
          'cssInline' => '.kv-heading-1{font-size:18px}',
           // set mPDF properties on the fly
          'options' => ['title' => 'Report Title'],
           // call mPDF methods on the fly
           'methods' => [
               'SetHeader'=>['LAPORAN PREDIKSI ||Dicetak Pada: ' . date("d-M-Y")],
               'SetFooter'=>['|Halaman {PAGENO}|'],
          ]
      ]);



return $pdf->render();
  }

public function actionReport3() {

        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


      // get your HTML raw content without any layouts or scripts
      $content = $this->renderPartial('cetak6', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);

      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
          // set to use core fonts only
          'mode' => Pdf::MODE_CORE,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'content' => $content,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          // any css to be embedded if required
          'cssInline' => '.kv-heading-1{font-size:18px}',
           // set mPDF properties on the fly
          'options' => ['title' => 'Report Title'],
           // call mPDF methods on the fly
           'methods' => [
               'SetHeader'=>['LAPORAN PREDIKSI ||Dicetak Pada: ' . date("d-M-Y")],
               'SetFooter'=>['|Halaman {PAGENO}|'],
          ]
      ]);



return $pdf->render();
  }

public function actionReport4() {

        $searchModel = new PrediksiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


      // get your HTML raw content without any layouts or scripts
      $content = $this->renderPartial('cetak7', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);

      // setup kartik\mpdf\Pdf component
      $pdf = new Pdf([
          // set to use core fonts only
          'mode' => Pdf::MODE_CORE,
          // A4 paper format
          'format' => Pdf::FORMAT_A4,
          // portrait orientation
          'orientation' => Pdf::ORIENT_PORTRAIT,
          // stream to browser inline
          'destination' => Pdf::DEST_BROWSER,
          // your html content input
          'content' => $content,
          // format content from your own css file if needed or use the
          // enhanced bootstrap css built by Krajee for mPDF formatting
          // any css to be embedded if required
          'cssInline' => '.kv-heading-1{font-size:18px}',
           // set mPDF properties on the fly
          'options' => ['title' => 'Report Title'],
           // call mPDF methods on the fly
           'methods' => [
               'SetHeader'=>['LAPORAN PREDIKSI ||Dicetak Pada: ' . date("d-M-Y")],
               'SetFooter'=>['|Halaman {PAGENO}|'],
          ]
      ]);



return $pdf->render();
  }
}

