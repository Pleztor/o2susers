<?php namespace O2s\Users;

class UserFormRequest extends \Illuminate\Foundation\Http\FormRequest {
   
    protected $rules = [
        'name'     => 'required',
        'email'    => 'required|email',
        'password' => 'min:6'
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // make sure we have a user
        if ( ! \Auth::user() ) {
            return false;
        }
        
        //The password and the confirm password must be the same
        if ((\Input::get('password')) && (\Input::get('password')!=\Input::get('confirm')))  return false;

        // Admin user can always do it
        if (\Auth::user()->id == 1 || \Auth::user()->isAdmin == 1) { return true; }

        // A user can edit their own data
        if (\Auth::user()->id == \Input::get('id')) {
            return true;
        }

        // otherwise Nope, not allowed.
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->rules;

        if ( ! \Input::get('id')) {
            $rules['password'] = $rules['password'] .'|required';
        }

        return $rules;
    }

}
