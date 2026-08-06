<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportFinanceRequest extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function importRequest()
    {
        return $this->belongsTo(ImportRequest::class);
    }

    public function financePartner()
    {
        return $this->belongsTo(FinancePartner::class);
    }
    
}
