<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class chatter extends Model
{
    //
    /**反馈话题总数*/

    public static function getdiscussion_num()
    {
        return DB::table('chatter_discussion')->count();
    }


    /**反馈不同类别的话题的比例 TODO */
    public static function getchategories_bili()
    {
        $re = DB::select('select name , count(*) as num from chatter_categories right join chatter_discussion  on chatter_discussion.chatter_category_id = chatter_categories.id group by chatter_categories.id;');
        $result = [];
        $i = 0;
        foreach ($re as $r) {
            $result[$i] = [$r->name, $r->num];
            $i++;
        }
        return $result;
    }


    /**反馈评论数量最多的话题 TODO */
    public static function getchatter_bili()
    {
        $re = DB::select('select title , count(*) as num from chatter_post left join chatter_discussion on chatter_post.chatter_discussion_id = chatter_discussion.id group by chatter_discussion_id ;');
        $result = [];
        $i = 0;
        $text_other = '其他';
        $count_other = 0;
        foreach ($re as $r) {
            if ($i >= 12) {
                $count_other += $r->num;
                continue;
            }
            $result[$i] = [$r->title, $r->num];
            $i++;
        }
        if ($count_other > 0)
            $result[$i] = [$text_other, $count_other];
        return $result;
    }

}
