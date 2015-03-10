<?php

namespace app\components;

class AccessRule extends \yii\filters\AccessRule
{
	 /**
     * @param User $user the user object
     * @return boolean whether the rule applies to the role
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) 
        {
            return true;
        }

        foreach ($this->roles as $role) 
        {
            if ($role === '?') 
            {
                return $user->getIsGuest();
            } 
            elseif ($role === '@') 
            {
                return !$user->getIsGuest();
            } 
            elseif (!$user->getIsGuest() && $role === $user->identity->role) 
            {
                return true;
            }
        }

        return false;
    }
}