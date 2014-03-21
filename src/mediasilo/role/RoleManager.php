<?php

namespace mediasilo\role;

use mediasilo\http\exception\NotFoundException;
use mediasilo\http\WebClient;
use mediasilo\http\MediaSiloResourcePaths;
use mediasilo\role\Role;

class RoleManager
{

    private $roles;
    private $webClient;

    public function __construct($webClient) {
        $this->webClient = $webClient;
    }

    /**
     * Returns an array of user roles for the given projects
     * @param $projectId
     * @return Role;
     */
    public function getUserRoleForProject($projectId,$accountId)
    {
        if (isset($roles[$projectId])) {
            return $roles[$projectId];
        } else {
            $roles = json_decode($this->webClient->get(sprintf(MediaSiloResourcePaths::USER_PROJECT_ROLES, $projectId)));

            if (count($roles) < 1) {
                $role = $this->getUserAccountLevelRole($accountId);
            } else {
                $role = Role::fromJson(json_encode($roles[0]));
            }

            $roles[$projectId] = $role;

            return $role;
        }
    }

    /**
     * Returns an account level role for the given account ID. Users
     * @param $accounttId
     * @return Role;
     */
    public function getUserAccountLevelRole($accountId)
    {
        if (isset($roles[$accountId])) {
            return $roles[$accountId];
        } else {
            $roles = json_decode($this->webClient->get('/me'))->roles;

            for ($i = 0; $i < count($roles); $i++) {
                if ($roles[$i]->context == $accountId) {
                    $role = new Role($roles[$i]->context, $roles[$i]->description, $roles[$i]->displayName, $roles[$i]->id, $roles[$i]->permissionGroups);
                    break;
                }
            }

            $roles[$accountId] = $role;

            return $role;
        }
    }
}
