<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  /**
   * モデルと関連しているテーブル
   */
  protected $table = 'articles';
  protected $primaryKey = 'id';
}
