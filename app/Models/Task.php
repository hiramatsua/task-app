<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    //進捗定義
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
    ];

    //アクセサの追加
    //進捗のラベル StatusLabel
    // @return string
    public function getStatusLabelAttribute()
    {
        // 進捗値
        $status = $this->attributes['status'];

        // 定義なし＝空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    //進捗のラベル色付け StatusClass
    // @return string
    public function getStatusClassAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義なし＝空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['class'];
    }

    //期限日 日付フォーマットを変える FormattedDueDate
    // @return string
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}
