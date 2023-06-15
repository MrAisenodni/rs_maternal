<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDocument extends Model
{
    use HasFactory;

    protected $table = 'trx_article_document';

    public function article()
    {
        return $this->belongsTo(Article::class)->where('disabled', 0);
    }    
}