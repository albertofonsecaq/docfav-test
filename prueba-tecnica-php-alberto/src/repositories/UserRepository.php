<?php

namespace repositories;

use entities\User;
use exceptions\UserDoesNotExistException;
use exceptions\UserExistException;

class UserRepository extends Repository
{
    public function table()
    {
        return 'users';
    }

    public function iuser(array $arr)
    {
        $user = new User(
            isset($arr['name']) ? $arr['name'] : '',
            isset($arr['email']) ? $arr['email'] : '',
            isset($arr['password']) ? $arr['password'] : '',
        );
        if(isset($arr['id']))
            $user->setId($arr['id']);
        return $user;
    }

    public function store(User $user)
    {
        try {
            $arr = array_intersect_key($user->toArray(), array_flip(['name','email','password']));
            $columns = implode(',',array_keys($arr)) ;
            $sql = "INSERT INTO {$this->table()} ({$columns}) VALUES (";
            foreach (array_values($arr) as $val)
                $sql .= "'{$val}',";
            $sql[strlen($sql) - 1] = ')';
            $this->exec($sql);
            return 'User created';
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function getUserByField($field, $value)
    {
        try {
            $sql = "SELECT * FROM {$this->table()} WHERE {$field} = '{$value}'";
            $result = $this->querySingle($sql);
            if(count($result) > 0)
                return $this->iuser($result);
            return null;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function getByIdOrFail($user_id)
    {
        try {
            $user = $this->getUserByField('id',$user_id);
            if(empty($user))
                throw new UserDoesNotExistException('User no found',);
            return $user;
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function update($user_id, array $input)
    {
        try {
            /** @var User $user */
            $user = $this->getByIdOrFail($user_id);

            $sql = "UPDATE {$this->table()} SET ";
            foreach ($input as $key => $value)
                $sql .= "'{$key}' = '{$value}',";

            $sql[strlen($sql) - 1] = " ";
            $sql .= "WHERE id = {$user->getId()}";

            $this->exec($sql);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function delete($user_id)
    {
        try {
            $user = $this->getByIdOrFail($user_id);
            $sql = "DELETE FROM {$this->table()} WHERE id = {$user->getId()}";
            $this->exec($sql);
        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }

    public function registerUser(User $user)
    {
        try {
            $userDB = $this->getUserByField('email',$user->getEmail());
            if(empty($userDB))
            {
                $this->store($user);
                return 'User registered';
            }
            else
                throw new UserExistException('User exist');

        }
        catch (\Exception $e)
        {
            throw $e;
        }
    }
}