<?php

$menuItems = [
    ['label' => 'Home', 'url' => ['/site/index']],
    ['label' => 'Books', 'url' => ['/book/index']],
    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
}


return $menuItems;