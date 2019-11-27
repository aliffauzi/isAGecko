<?php

namespace app\controllers;

use app\models\Absensi;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // data yang valid diperoleh pada $model

            // lakukan sesuatu terhadap $model di sini ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // menampilkan form pada halaman, ada atau tidaknya kegagalan validasi tidak masalah
            return $this->render('entry', ['model' => $model]);
        }
    }
    public function actionFormAbsensi()
    {
        $model=new Absensi();
        if($model->load(Yii::$app->request->post(), '')){
            $nama_pegawai = Yii::$app->request->post('nama_pegawai');
            $detail = Yii::$app->request->post('detail');
            $keterangan=$_POST['Absensi']['keterangan'];
            $jam = Yii::$app->request->post('jam');
            $tanggal = Yii::$app->request->post('tanggal');
            $latitude = Yii::$app->request->post('lat');
            $longitude = Yii::$app->request->post('long');
            $point=100;
            $terlambat='00:00:00';
            $foto='jaya.jpg';
            $model->id_pegawai=$nama_pegawai;
            $model->tanggal=$tanggal;
            $model->jam=$jam;
            $model->terlambat=$terlambat;
            $model->keterangan=$keterangan;
            $model->detail=$detail;
            $model->foto=$foto;
            $model->point=$point;
            var_dump($model->save());

            die();
        }
        return $this->render('form-absensi', ['model' => $model]);
    }
}
