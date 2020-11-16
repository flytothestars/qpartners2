<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SocialNetwork extends Model
{
    protected $table = 'social_network';
    protected $primaryKey = 'id';

    const INSTAGRAM = 1;
    const WHATSAPP = 2;
    const TWITTER = 3;
    const YOU_TUBE = 4;
    const FACEBOOK = 5;
    const GOOGLE_MAIL = 6;
    const MAIL_RU = 7;


    const ADMINISTRATION_PERSON = 1; // LINK OF ADMINISTRATION PERSON
    const ADMINISTRATION = 3;


    const LEADERS_PERSON = 2; // LINK OF LEADER PERSON
    const LEADERSHIP_ADVICE = 4;


    public static function getSocialNetworks($item_id, $type_id)
    {
        $social_networks = DB::table('ref_social_network_items')
            ->join('social_networks', 'social_networks.id', '=', 'ref_social_network_items.social_network_id')
            ->where(['item_id' => $item_id, 'type_id' => $type_id])
            ->get();

        return $social_networks;
    }

}
