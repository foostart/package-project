<?php namespace Foostart\Project\Repositories;
/*
|-----------------------------------------------------------------------
| SearchUserRepository
|-----------------------------------------------------------------------
| @author: PhuongDH
| @website: http://foostart.com
| @date: 2/5/2018
|
*/
use LaravelAcl\Authentication\Repository\UserRepositorySearchFilter;
use DB;
class SearchUserRepository extends UserRepositorySearchFilter{

    private $profile_tbl = "user_profile";

    // cac field se where
    private $ajax_filter_fields = ["first_name", "last_name"];

    // cac field se lay va show ra kq
    private $ajax_result_fields = ["first_name", "last_name", "user_id"];

    /**
     * Search for ajax request
     * @param $keyword string
     * @return array
     */
    public function ajaxSearch($keyword = '')
    {
        $data = DB::table($this->profile_tbl)
                    ->select($this->ajax_result_fields);

        // loop all the key we have
        foreach ($this->ajax_filter_fields as $key)
        {
            $data = $data->orWhere($key, 'like', '%'.$keyword.'%');
        }

        // back the result
        return [
            'data' => $data->get(),
            'total_data' => $data->count()
        ];
    }    
}