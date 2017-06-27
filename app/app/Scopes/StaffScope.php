<?php

namespace App\Scopes;

use Adldap\Query\Builder;
use Adldap\Laravel\Scopes\ScopeInterface;

class StaffScope implements ScopeInterface
{
    /**
     * Apply the scope to a given LDAP query builder.
     *
     * @param Builder $query
     *
     * @return void
     */
    public function apply(Builder $query)
    {
        // The distinguished name of our LDAP group.
        $staff = env('ADLDAP_GROUP_SCOPE');
        
        if (!empty($staff)) {
        	$query->whereMemberOf($staff);
        }
    }
}