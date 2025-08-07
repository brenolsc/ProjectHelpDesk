<?php

namespace frontend\controllers;

use yii\web\Controller;

class HelpController extends Controller
{

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionAccountSettings() {
        return $this->render('accountSettings');
    }

    public function actionLoginSecurity() {
        return $this->render('loginSecurity');
    }

    public function actionPrivacy() {
        return $this->render('privacy');
    }

}