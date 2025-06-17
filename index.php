<?php
$API_KEY = '7537566063:AAGzNVw4Stj6oyFkGpzrW5NyrZNIk9N-Oxc';
$chat_id = '-1002509155667'; // ID القروب

// جميع الإعلانات في مصفوفة
$ads = [
    [
        'photo' => 'https://t.me/fx2data/39',
        'caption' => "الي حاب ارجعله حساب مسروق ضايع ناسي كلمة المرور يتفضل خاص ماراح اقصر مع احد",
        'button_text' => 'pr_dp',
        'button_url' => 'https://t.me/PR_DP'
    ],
    [
        'photo' => 'https://t.me/fx2data/40',
        'caption' => "الدعم الفني في حال تواجد مشكله , اقتراح توجه للدعم ومابنقصر معك <3",
        'button_text' => 'الدعم',
        'button_url' => 'https://t.me/itddbot'
    ],
    [
        'photo' => 'https://t.me/fx2data/41',
        'caption' => "بوت الوصوف الخاص بنا يرسل لك وصف اي صوره تبيها !\nالبوت تحت",
        'button_text' => 'البوت',
        'button_url' => 'https://t.me/dfkzbot'
    ],
    [
        'photo' => 'https://t.me/fx2ch/128202',
        'caption' => "قناه الوصوف الخاصه بنا ننشر جميع رسبوناتنا ",
        'button_text' => 'الرسبونات',
        'button_url' => 'https://t.me/fx2gta5'
    ],
    [
        'photo' => 'https://t.me/fx2ch/128202',
        'caption' => "اهلاً وسهلاً بـكم
هذي قوانين القروب كاملة لابد تشيك عليها قبل إرسال أي شي داخل القروب واي مشكلة توجه للدعم!

> • علماً في حال أرسلت شي بالقروب فأنت توافق على القوانين وجميع الشروط!",
        'button_text' => 'القوانين',
        'button_url' => 'https://t.me/fx2link/3'
    ],
    
    // تقدر تضيف إعلان ثالث ورابع وهكذا
];

function sendAd($chat_id, $ad, $API_KEY) {
    $keyboard = [
        'inline_keyboard' => [
            [
                ['text' => $ad['button_text'], 'url' => $ad['button_url']]
            ]
        ]
    ];
    $reply_markup = json_encode($keyboard);

    $url = "https://api.telegram.org/bot$API_KEY/sendPhoto";

    $post_fields = [
        'chat_id' => $chat_id,
        'photo' => $ad['photo'],
        'caption' => $ad['caption'],
        'reply_markup' => $reply_markup,
    ];

    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    $output = curl_exec($ch);
    curl_close($ch);

    echo "✅ تم إرسال الإعلان للقروب: $chat_id\n";
}

// عداد لتدوير الإعلانات
$index = 0;
$total_ads = count($ads);

// حلقة ترسل إعلان مختلف كل 5 ثواني
while (true) {
    sendAd($chat_id, $ads[$index], $API_KEY);

    $index++;
    if ($index >= $total_ads) {
        $index = 0; // نرجع لأول إعلان بعد ما نخلص الكل
    }

    sleep(420);
}
