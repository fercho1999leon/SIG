<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $table = 'request_user_tbl';

	protected $fillable = ['title_transact','title_addressee','name_addressee',
                            'department_addressee','date_creation','ci_student',
                            'name_student','career_student','detail_transact',
                            'valor','id_student','status','cxc','id_destinatario'];

}
