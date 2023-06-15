<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'trx_article';

    public function article_document()
    {
        return $this->hasMany(ArticleDocument::class)->where('disabled', 0);
    }
}
