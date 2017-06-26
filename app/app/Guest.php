<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Adldap\Laravel\Facades\Adldap;
use Adldap\Objects\AccountControl;

class Guest extends Model
{
    use Notifiable;

    public function sponsor()
    {
        return $this->belongsTo('App\User', 'sponsorDn', 'dn');   
    }
    
    public function routeNotificationForSlack()
    {
        return env('SLACK_INCOMING_WEBHOOK');
    }
    
    public function createAccount()
    {
        $user = Adldap::make()->user();
    
        // Set the user profile details.
        $user->setDisplayName($this->cn);
        $user->setCommonName($this->cn);
        $user->setAccountName($this->username);
        $user->setFirstName($this->firstName);
        $user->setLastName($this->lastName);
        $user->setInfo('GUEST ACCOUNT - ' . $this->location . ', ' . $this->purpose);

        // Set the DN
        $user->setDn($this->dn);
        
        // Set manager to sponsoring user
        $user->setManager($this->sponsorDn);
        
        // Set the expiry time
        $user->setAccountExpiry($this->expiration);
        
        // Save the new user.
        if ($user->save()) {
            // Enable the new user (using user account control).
            $user->setUserAccountControl(AccountControl::NORMAL_ACCOUNT);
            

            $user->setPassword($this->password);
        
            // Save the user.
            if($user->save()) {
                return true;
            }
        }
        return false;
    }

    // Builds DN for user
    public function createDn()
    {
        $user = Adldap::make()->user();
        $dn = $user->getDnBuilder();
        $dn->addCn($this->lastName . ', ' . $this->firstName);
        $dn->addOu('Guests');
        return $dn->get();
    }
    
    // Checks if user exists by DN
    public function exists()
    {
        $user = Adldap::search()->users()->findBy('samaccountname', $this->username);
        return isset($user);
    }
}
