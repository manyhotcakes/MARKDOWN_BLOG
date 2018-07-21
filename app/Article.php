<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing;
use Storage;
use URL;

class Article extends Model
{
  /**
   * モデルと関連しているテーブル
   */
  protected $table = 'articles';
  protected $primaryKey = 'id';
  protected $appends = ['article_url']; //リスト表示時記事リンク先URL用に生成

  public function getImagePathAttribute($value) {
    return Storage::url($value);
  }

  public function setImagePathAttribute($value) {
    $this->attributes['image_path'] = preg_replace('/^public/', '', $value);
  }

  public function getArticleUrlAttribute() {
    return URL::route('article', ['id'=>$this->attributes['id']]);
  }
}
