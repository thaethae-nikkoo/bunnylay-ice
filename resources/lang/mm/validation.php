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

    'accepted' => ':attribute သည်လက်ခံနိုင်ခြင်းမရှိပါ။',
    'active_url' => ':attribute သည်မှန်ကန်သော URL မဟုတ်ပါ။',
    'after' => ':attribute သည် :date ထက် နောက်နေ့ဖြစ်ရမည်။',
    'after_or_equal' => ':attribute သည် :date နောက်နေ့ သို့မဟုတ် တူညီသောရက်ဖြစ်ရမည်။',
    'alpha' => ':attribute တွင် စာလုံးများသာ ပါဝင်ရမည်။',
    'alpha_dash' => ':attribute တွင် a-z1-0-_ များသာ ပါဝင်ရမည်။',
    'alpha_num' => ':attribute တွင် စာလုံးများနှင့် နံပါတ်များသာ ပါဝင်ရမည်။',
    'array' => 'The :attribute must be an array.',
    'before' => ':attribute သည် :date မတိုင်မီနေ့ရက်ဖြစ်ရမည်။',
    'before_or_equal' => ':attribute သည် :date သို့မဟုတ် အရင်နေ့ရက်ဖြစ်ရမည်။',
    'between' => [
        'numeric' => ':attribute သည် :min နှင့် :max ကြားရှိရမည်။',
        'file' => ':attribute သည် :min KB မှ :max KB ကြားရှိရမည်။',
        'string' => ':attribute သည် :min မှ :max အထိအက္ခရာများပါဝင်ရမည်။',
        'array' => ':attribute သည် :min မှ :max အထိအချက်များပါဝင်ရမည်။',
    ],
    'boolean' => ':attribute သည် true သို့မဟုတ် false ဖြစ်ရမည်။',
    'confirmed' => ':attribute အတည်ပြုချက်သည် တူညီမှုမရှိပါ။',
    'current_password' => 'စကားဝှက် မမှန်ကန်ပါ။',
    'date' => ':attribute သည် မှန်ကန်သော ရက်စွဲ မဟုတ်ပါ။',
    'date_equals' => ':attribute သည် :date နှင့် တူညီသော ရက်စွဲ ဖြစ်ရမည်။',
    'date_format' => ':attribute သည် :format ပုံစံနှင့် ကိုက်ညီမှု မရှိပါ။',
    'different' => ':attribute နှင့် :other မတူညီရမည်။',
    'digits' => ':attribute သည် တိကျသော :digits လုံး ဖြစ်ရမည်။',
    'digits_between' => ':attribute သည် :min နှင့် :max လုံးကြား ဖြစ်ရမည်။',
    'dimensions' => ':attribute သည် မှားယွင်းသော ဓာတ်ပုံ အရွယ်အစား တစ်ခုဖြစ်သည်။',
    'distinct' => ':attribute တွင် ထပ်နေသော တန်ဖိုးရှိပါသည်။',
    'email' => ':attribute သည် မှန်ကန်သော အီးမေးလ် လိပ်စာ ဖြစ်ရမည်။',
    'ends_with' => ':attribute သည် အောက်ပါ :values တစ်ခုဖြင့် အဆုံးသတ်ရမည်။',
    'exists' => 'ရွေးချယ်ထားသော :attribute သည် မမှန်ကန်ပါ။',
    'file' => ':attribute သည် ဖိုင် ဖြစ်ရမည်။',
    'filled' => ':attribute တွင် တန်ဖိုးတစ်ခု ရှိရမည်။',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
        'image' => ':attribute သည် ပုံ (image) ဖြစ်ရမည်။',
    'in' => 'ရွေးချယ်ထားသော :attribute မမှန်ပါ။',
    'in_array' => ':attribute သည် :other တွင်မရှိပါ။',
    'integer' => ':attribute သည် ဂဏန်း(ကိန်းပြည့်)ဖြင့်သာ ဖြစ်ရမည်။',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute သည် :max ထက်မပိုရပါ။',
        'file' => ':attribute သည် :max ကီလိုဘိုက်ထက်မပိုရပါ။',
        'string' => ':attribute သည် စာလုံး :max ထက်မပိုရပါ။',
        'array' => ':attribute သည် :max အချက်ထက်မပိုရပါ။',
    ],
    'mimes' => ':attribute သည် :values အမျိုးအစားဖြစ်ရမည်။',
    'mimetypes' => ':attribute သည် :values အမျိုးအစားဖြစ်ရမည်။',
    'min' => [
        'numeric' => ':attribute သည် အနည်းဆုံး :min ဖြစ်ရမည်။',
        'file' => ':attribute သည် အနည်းဆုံး :min KBဖြစ်ရမည်။',
        'string' => ':attribute သည် အနည်းဆုံး :min လုံးရှိရမည်။',
        'array' => ':attribute သည် အနည်းဆုံး :min အချက်ရှိရမည်။',
    ],
    'multiple_of' => ':attribute သည် :value ၏ မြောက်ကြိမ်မြောက်ပေါင်းဖြစ်ရမည်။',
    'not_in' => 'ရွေးချယ်ထားသော :attribute သည် မမှန်ပါ။',
    'not_regex' => ':attribute format သည် မမှန်ကန်ပါ။',
    'numeric' => ':attribute သည် ဂဏန်းဖြစ်ရမည်။',
    'password' => 'စကားဝှက် မမှန်ပါ။',
    'present' => ':attribute ဖြည့်သွင်းထားရမည်။',
    'regex' => ':attribute format သည် မမှန်ကန်ပါ။',
    'required' => ':attribute ဖြည့်သွင်းရန် လိုအပ်ပါသည်။',
    'required_if' => ':other သည် :value ဖြစ်လျှင် :attribute ဖြည့်သွင်းရန် လိုအပ်ပါသည်။',
    'required_unless' => ':other သည် :values တွင်မပါလျှင် :attribute ဖြည့်ရန် လိုအပ်ပါသည်။',
    'required_with' => ':values ဖြစ်လျှင် :attribute ဖြည့်ရန် လိုအပ်ပါသည်။',
    'required_with_all' => ':values အားလုံးဖြစ်လျှင် :attribute ဖြည့်ရန် လိုအပ်ပါသည်။',
    'required_without' => ':values မရှိလျှင် :attribute ဖြည့်ရန် လိုအပ်ပါသည်။',
    'required_without_all' => ':values မည်သည့်တစ်ခုမျှ မရှိလျှင် :attribute ဖြည့်ရန် လိုအပ်ပါသည်။',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'same' => ':attribute နှင့် :other တူညီရမည်။',
    'size' => [
        'numeric' => ':attribute ကို :size ဖြစ်ရမည်။',
        'file' => ':attribute သည် :size KB ဖြစ်ရမည်။',
        'string' => ':attribute သည် အက္ခရာ :size လုံးရှိရမည်။',
        'array' => ':attribute တွင် :size item များ ပါဝင်ရမည်။',
    ],
    'starts_with' => ':attribute သည် :values တစ်ခုဖြင့် စရမည်။',
    'string' => ':attribute သည် စာသား ဖြစ်ရမည်။',
    'timezone' => ':attribute သည် တရားဝင် timezone ဖြစ်ရမည်။',
    'unique' => ':attribute သည်ရှိပြီးသားဖြစ်နေသည်။',
    'uploaded' => ':attribute ကို တင်ခြင်းမအောင်မြင်ပါ။',
    'url' => ':attribute သည် တရားဝင် URL ဖြစ်ရမည်။',

    'uuid' => 'The :attribute must be a valid UUID.',

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
        'username' => ":attribute သည် အင်္ဂလိပ်စာလုံးနှင့်နံပါတ်သာဖြစ်ရမည်။",
        'something_went_wrong' => 'တစ်ခုခုမှားယွင်းနေသည်။',
        'myanmar_phone' => ":attribute သည်မှန်ကန်သောဖုန်းဖြစ်ရမည်။",
        'cannot_delete_own_account' => "မိမိအကောင့်အားဖျက်မရပါ။",
        "branch_not_exist" => "ရွေးချယ်ထားသောဆိုင်ခွဲမှားယွင်းနေပါသည်။",
        "invalid_profit" => "မှားယွင်းနေပါသည်။",
        "required_branch_ids" => 'ဆိုင်ခွဲရွေးချယ်ရန်လိုအပ်ပါသည်။',
        "invalid_phone_number" =>  'ဖုန်းနံပါတ်တွင် တွင် ဂဏန်းနှင့် +()- . space တို့သာ ပါနိုင်သည်။',
        "invalid_password" => 'စကားဝှက် ထဲတွင် အင်္ဂလိပ်စာလုံး၊ ဂဏန်း၊ သင်္ကေတများသာ အသုံးပြုနိုင်သည်။',
        "invalid_viss" => ':attribute မှာ ဒသမ ၂ လုံးထက် မပိုရပါ။',
        "restrict_for_point" => ':attribute သည် ကိန်းပြည့်သာ ဖြစ်ရမည်။',
        'down_payment_less_than_fee' => ':attribute သည် :type ငွေပမာဏထက် မကျော်ရပါ။'
    ],

    'attributes' => [
       'role' => 'လုပ်ပိုင်ခွင့်',
       'password' => 'စကားဝှက်',
       'confirm_password' => 'စကားဝှက်အတည်ပြု',
       'phone' =>'ဖုန်းနံပါတ်',
       'username' => 'Login ID',
       'name' => 'နာမည်',
       'remark' => 'မှတ်ချက်',
       'amount_in_kyat' => 'အမောင့် (ကျပ်)',
       'description' => 'အကြောင်းအရာ',
    ]
];
