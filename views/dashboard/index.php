<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->params['breadcrumbs'][] = ['label' => 'Pegawais', 'url' => ['index']];
$this->title = 'Dashboard Admin';
?>
<p>
        <?= Html::a('Update', ['update', 'id' => $model->id_pegawai], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_pegawai], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_pegawai',
            'id_point',
            'id_jabatan',
            'nama_pegawai',
            'nomor_telp',
            'alamat',
            'email:email',
            'gender',
            'password',
        ],
    ]) ?>