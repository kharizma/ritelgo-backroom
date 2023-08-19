<?php

namespace App\Services;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserService
{
    public static function generateId($role)
    {
        $num = User::where('role',$role)->count();

        $len = strlen(++$num);

        for($i=$len; $i<7; ++$i) {
            $num = '0'.$num;
        }

        if($role == User::ROLE_SUPERADMIN){
            return 'RGOSA'.$num;
        }elseif($role == User::ROLE_OWNER){
            return 'RGOOW'.$num;
        }elseif($role == User::ROLE_MANAGER){
            return 'RGOMG'.$num;
        }elseif($role == User::ROLE_CASHIER){
            return 'RGOCA'.$num;
        }
    }

    public function getInitialName($name)
    {
        $words      = explode(" ",$name);
        $acronym    = "";

        if(count($words) >= 2){
            $acronym .= mb_substr($words[0], 0, 1).mb_substr($words[1], 0, 1);
        }else{
            $acronym .= mb_substr($words[0], 0, 1).mb_substr($words[0], 0, 1);
        }

        return $acronym;
    }

    public function store(array $items): User
    {
        $items['id']            = $this->generateId(User::ROLE_SUPERADMIN);
        $items['role']          = 'superadmin';
        $items['initial_name']  = $this->getInitialName($items['name']);
        $items['mobile_phone']  = '62'.$items['mobile_phone'];
        $items['created_by']    = Auth::user()->id;
        $items['updated_by']    = Auth::user()->id;
        
        $user = User::create($items);

        event(new Registered($user));

        return $user;
    }

    public function update(array $items, $id): int
    {
        $items['mobile_phone']  = '62'.$items['mobile_phone'];
        
        $user = User::where('id',$id)->update(
            $items
        );

        return $user;
    }
}