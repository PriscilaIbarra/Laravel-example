<?php

namespace App\Rules;
use App\Http\Catalogs\UsersCatalog;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UniqueIfEmailHasChange implements Rule
{
    private $data = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    
    private function validateIfEmailIsUnique(string $email)
    {
        $attributes = ['email'=>$email];
        $rules = ['email'=>'unique:users'];
        $validator = Validator::make($attributes,$rules);
        return $validator->validate();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = UsersCatalog::searchUser($this->data["id"]);
        if($user->email == $this->data["email"]) return true;
        try
        {
            $this->validateIfEmailIsUnique($this->data["email"]);
            return true;
        }
        catch(ValidationException $e)
        {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
       return  trans('validation.email_has_change_and_not_unique');
    }
}
