<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //todo: seo ayarları yapılacak - meta title keyword description..
    //todo_ok: sepete atılan ürünler kişiye özel çıkmıyor. düzeltilecek
    //todo: ürün eklerken özelliklere auto complate yapılacak..
    //todo_ok: ürün listelemelerinde data biriş tarihi aktif edilecek
    //todo_ok: resim boyutlandırmaları yapılacak
    //todo: email ayarları yapılacak
    //todo_ok: 2 adet üzeri indirimlerde ona göre fiyat seçilip sepete eklenecek.
    //todo_ok: iletişim sayfası yapılacak
    //todo_ok: ticket sistemi yapılacak
    //todo: formlar için türkçe dil dosyası
}
