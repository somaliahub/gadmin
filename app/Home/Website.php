<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    //

    public static function initWebsite()
    {
        $website = [
            ['name' => 'web_name', 'content' => 'bnb'],
            ['name' => 'web_keywords', 'content' => 'bnb|bnb2|bnb3'],
            ['name' => 'web_description', 'content' => 'bnb'],
            ['name' => 'web_contact1', 'content' => 'bnb'],
            ['name' => 'web_contact2', 'content' => 'bnb'],
            ['name' => 'web_url', 'content' => 'bnb'],
            ['name' => 'web_pay1', 'content' => 'bnb'],
            ['name' => 'web_pay2', 'content' => 'bnb'],
            ['name' => 'is_init', 'content' => '1'],
        ];

        foreach ($website as $item) {
            $web = new self();
            $web->name = $item['name'];
            $web->content = $item['content'];
            $web->save();
        }
    }
}
