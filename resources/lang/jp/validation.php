<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute 許可されています。',
    'active_url'           => ' :attribute URLが有効ではありませんでした',
    'after'                => ' :attribute :date より後の日付でなければなりません。',
    'after_or_equal'       => ' :attribute :date より遅い日時か、同じ日時でなければなりません。',
    'alpha'                => ' :attribute 文字のみを含めることができます。',
    'alpha_dash'           => ' :attribute 文字、数字、およびダッシュだけを含むことができます。',
    'alpha_num'            => ' :attribute 文字と数字のみを含むことができます。',
    'array'                => ' :attribute 配列でなければなりません。',
    'before'               => ' :attribute :date より前の日付でなければなりません',
    'before_or_equal'      => ' :attribute :date より前の日時か、同じ日時でなければなりません。',
    'between'              => [
        'numeric' => ' :attribute :min ～ :max の間でなければなりません。',
        'file'    => ' :attribute :min ～ :max キロバイトの間でなければなりません。.',
        'string'  => ' :attribute :min ～ :max 文字の間でなければなりません。.',
        'array'   => ' :attribute :min ～ :max アイテムの間でなければなりません。.',
    ],
    'boolean'              => ' :attribute フィールドはtrueまたはfalseでなければなりません。',
    'confirmed'            => ' :attribute 確認が一致しません。',
    'date'                 => ' :attribute 有効な日付ではありません。',
    'date_format'          => ' :attribute :format フォーマットと一致しません',
    'different'            => ' :attribute と :other は異なっていなければなりません。',
    'digits'               => ' :attribute :digits でなければなりません。',
    'digits_between'       => ' :attribute :min ～ :max でなければなりません。.',
    'dimensions'           => ' :attribute 無効な画像サイズがあります。',
    'distinct'             => ' :attribute フィールドに重複値があります。',
    'email'                => ' :attribute 有効な電子メールアドレスでなければなりません。',
    'exists'               => ' :attribute 有効ではありません。',
    'file'                 => ' :attribute ファイルでなければなりません。',
    'filled'               => ' :attribute フィールドには値が必要です',
    'image'                => ' :attribute イメージでなければなりません。',
    'in'                   => ' :attribute 有効ではありません。',
    'in_array'             => ' :attribute :other フィールドは存在しません。',
    'integer'              => ' :attribute 整数でなければなりません。',
    'ip'                   => ' :attribute 有効なIPアドレスでなければなりません。',
    'ipv4'                 => ' :attribute 有効なIPv4アドレスでなければなりません。',
    'ipv6'                 => ' :attribute 有効なIPv6アドレスでなければなりません。',
    'json'                 => ' :attribute 有効なJSON文字列でなければなりません。',
    'max'                  => [
        'numeric' => ' :attribute は :max を超えてはいけません。',
        'file'    => ' :attribute は :max を超えてはいけません。',
        'string'  => ' :attribute :max を超えてはいけません。',
        'array'   => ' :attribute :max を超えてはいけません。',
    ],
    'mimes'                => ' :attribute :values 型でなければなりません。',
    'mimetypes'            => ' :attribute :values 型でなければなりません。',
    'min'                  => [
        'numeric' => ' :attribute 最低でも :でなければなりません。',
        'file'    => ' :attribute 最低でも :min でなければなりません。',
        'string'  => ' :attribute 最低でも :min でなければなりません。',
        'array'   => ' :attribute 最低でも :min でなければなりません。',
    ],
    'not_in'               => ' :attribute 有効ではありません。',
    'numeric'              => ' :attribute 数字でなければなりません。',
    'present'              => ' :attribute フィールドが存在する必要があります。',
    'regex'                => ' :attribute フォーマットが無効です。',
    'required'             => ' :attribute フィールドは必須項目です。',
    'required_if'          => ' :attribute フィールドは次の場合に必要です。 :other が :value',
    'required_unless'      => ' :attribute :other が :values の値でない限り、フィールドは必須です。',
    'required_with'        => ' :attribute :values が存在する場合はフィールドが必要です。',
    'required_with_all'    => ' :attribute :values が存在する場合はフィールドが必要です。',
    'required_without'     => ' :attribute :values が存在しない場合はフィールドが必要です。',
    'required_without_all' => ' :attribute :values が存在しない場合はフィールドが必要です。',
    'same'                 => ' :attribute と :other は一致する必要があります。',
    'size'                 => [
        'numeric' => ' :attribute :size でなければなりません。',
        'file'    => ' :attribute :size でなければなりません。',
        'string'  => ' :attribute :size でなければなりません。',
        'array'   => ' :attribute :size でなければなりません。',
    ],
    'string'               => ' :attribute 文字列でなければなりません。',
    'timezone'             => ' :attribute 有効なゾーンでなければなりません。',
    'unique'               => ' :attribute すでに使用されています。',
    'uploaded'             => ' :attribute アップロードに失敗しました。',
    'url'                  => ' :attribute フォーマットが無効です。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
