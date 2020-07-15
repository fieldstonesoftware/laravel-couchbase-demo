<?php

namespace App\Models;

use Fieldstone\Couchbase\Eloquent\Model as CBModel;

class MyModel extends CBModel
{
    protected $connection = 'couchbase';

    // We use dt_ convention, Laravel uses _at convention
    // So, we override these field names to match our convention.
    const CREATED_AT = 'dt_created';
    const UPDATED_AT = 'dt_updated';
    const DELETED_AT = 'dt_deleted';
}
