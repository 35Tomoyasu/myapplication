<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Folder;

class Task extends Model
{
    /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'label' => '完了', 'class' => 'label-info' ],
        2 => [ 'label' => '着手', 'class' => 'label-warning' ],
        3 => [ 'label' => '未着手', 'class' => 'label-light' ],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    /**
     * 状態を表すHTMLクラス
     * @return string
     */
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }
    // ※12/6メンタリング時修正
    public function folder() 
    {
        return $this->belongsTo(Folder::class);
    }

    /**
     * 整形した期限日時
     * @return string
     */
    public function getFormattedFinishDateAttribute()
    {   
        
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['finish_date'])
            ->format('Y/m/d H:i');
    }
}