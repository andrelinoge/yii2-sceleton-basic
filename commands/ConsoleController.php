<?php

namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;

class ConsoleController extends Controller
{
	/**
     * @param Model $model
     * @param string $attribute
     */
    protected function readValue($model, $attribute)
    {
        $model->$attribute = $this->prompt(mb_convert_case($attribute, MB_CASE_TITLE, 'utf-8') . ':', [
            'validator' => function ($input, &$error) use ($model, $attribute) {
                $model->$attribute = $input;

                if ($model->validate([$attribute])) 
                {
                    return true;
                } 
                else 
                {
                    $error = implode(',', $model->getErrors($attribute));
                    return false;
                }
            },
        ]);
    }

    /**
     * @param bool $success
     */
    protected function log($success)
    {
        if ($success) 
        {
            $this->stdout('Success!', Console::FG_GREEN, Console::BOLD);
        } 
        else 
        {
            $this->stderr('Error!', Console::FG_RED, Console::BOLD);
        }
        echo PHP_EOL;
    }
}