<?php

namespace mediasilo\model\role;

class Role {

    private $id;
    private $displayName;
    private $description;
    private $context;
    private $permissionGroups;

    function __construct($context, $description, $displayName, $id, array $permissionGroups)
    {
        $this->context = $context;
        $this->description = $description;
        $this->displayName = $displayName;
        $this->id = $id;
        $this->permissionGroups = $permissionGroups;
    }

    public function setContext($context)
    {
        $this->context = $context;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPermissionGroups($permissionGroups)
    {
        $this->permissionGroups = $permissionGroups;
    }

    public function getPermissionGroups()
    {
        return $this->permissionGroups;
    }
}