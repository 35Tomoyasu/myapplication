<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'label' => '完了', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手', 'class' => 'label-info' ],
        3 => [ 'label' => '未着手', 'class' => '' ],
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

    /**
     * 整形した期限日時
     * @return string
     */
    public function getFormattedFinishDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['finish_date'])
            ->format('Y/m/d');
    }
}