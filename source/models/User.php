<?php

/**
 * @property int id
 * @property string name
 * @property string password
 * @property string email
 * @property bool is_admin
 * @property DateTime start_date
 * @property DateTime end_date
 */
class User extends Model
{

  protected static $tableName = 'users';

  protected static $columns = [
    'id',
    'name',
    'password',
    'email',
    'start_date',
    'end_date',
    'is_admin',
  ];

  /**
   * @return mixed
   */
  public static function getActiveUsersCount()
  {
    return static::getCount(['raw' => 'end_date IS NULL']);
  }


  /**
   * @return array
   * @throws Exception
   */
  public static function getAbsentUsers()
  {
    $today = new DateTime();
    $result = Database::getResultFromQuery("
    SELECT name FROM users WHERE end_date is NULL AND id NOT IN (   
    SELECT user_id FROM working_hours 
    WHERE  work_date = '{$today ->format('Y-m-d')}'
    AND time1 IS NOT NULL)");

    $absentUsers = [];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        array_push($absentUsers, $row['name']);
      }
    }

    return $absentUsers;
  }



  public function update()
  {

    $this->validate();

    if ($this->is_admin == 'on' ) {
      $this->is_admin = 1;
    }else{
      $this->is_admin = 0;
    }

    if (!$this->end_date) {
      $this->end_date = null;
    }
    
    $this->password = password_hash($this->password,PASSWORD_DEFAULT);

    parent::update();
  }
  public function insert()
  {

    $this->validate();

    if ($this->is_admin == 'on' ) {
      $this->is_admin = 1;
    }else{
      $this->is_admin = 0;
    }
    
   if (!$this->end_date) {
      $this->end_date = null;
    }
   
    $this->password = password_hash($this->password,PASSWORD_DEFAULT);
   
    parent::insert();
  }


  private
  function validate()
  {
    $errors = [];

    if (!$this->name) {
      $errors['name'] = 'Nome é um campo obrigatório!';
    }

    if (!$this->email) {
      $errors['email'] = 'Email é um campo obrigatório!';
    } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Email inválido!';
    }

    if (!$this->start_date) {
      $errors['start_date'] = 'Data de admissão é um campo obrigatório!';
    } elseif (!DateTime::createFromFormat('Y-m-d', $this->start_date)) {
      $errors['start_date'] = 'Data de admissão deve serguir o padrão dd/mm/yyyy!';
    }

    if ($this->end_date && !DateTime::createFromFormat('Y-m-d', $this->end_date)) {
      $errors['end_date'] = 'Data de admissão deve serguir o padrão dd/mm/yyyy!';
    }

    if (!$this->password) {
      $errors['password'] = 'Senha é um campo obrigatório!';
    }


    if (!$this->confirm_password) {
      $errors['confirm_password'] = 'Senha é um campo obrigatório!';
    }

    if ($this->password && $this->confirm_password && $this->confirm_password !== $this->password) {
      $errors['password'] = 'As senhas não são iguais';
      $errors['confirm_password'] = 'As senhas não são iguais';
    }


    if (count($errors) > 0) {
      throw new ValidationException($errors);
    }

  }
}
