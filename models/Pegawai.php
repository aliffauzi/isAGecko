<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id_pegawai
 * @property int $id_point
 * @property int $id_jabatan
 * @property int $nama_pegawai
 * @property int $nomor_telp
 * @property int $alamat
 * @property int $email
 * @property int $gender
 * @property int $password
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'id_point', 'id_jabatan', 'nama_pegawai', 'nomor_telp', 'alamat', 'email', 'gender', 'password'], 'required'],
            [['id_pegawai', 'id_point', 'id_jabatan', 'nomor_telp'], 'integer'],
            [['nama_pegawai'], 'string', 'max' => 35],
            [['alamat', 'email'], 'string', 'max' => 50],
            [['gender', 'password'], 'string', 'max' => 25],
            [['id_pegawai'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'id_point' => 'Id Point',
            'id_jabatan' => 'Id Jabatan',
            'nama_pegawai' => 'Nama Pegawai',
            'nomor_telp' => 'Nomor Telp',
            'alamat' => 'Alamat',
            'email' => 'Email',
            'gender' => 'Gender',
            'password' => 'Password',
        ];
    }
}
