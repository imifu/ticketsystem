(function ($) {
// これはUTF-8です
    'use strict';
    var hash = location.hash,
        openTarget = function (target) {
            // 0.5秒後に開く処理
            if ($(target).siblings()) {
                setTimeout(function () {
                    $(target).trigger("click");
                }, 500);
            }
        };
    hash = "dt" + hash;
    $(function () {
        // 念のため対象が一ヶ所かつアコーディオンであることを確認
        if ($(hash).length === 1 && $(hash).hasClass("toggle-open") === true) {
            openTarget(hash);
        }
        return true;
    });
    // 該当リンクそれぞれについて処理
    $(".linkList,.linkLink").find("a.toggleTit02").each(function () {
        var target = $(this).attr("href");
        if (target.indexOf('#') === 0) {
            // ページ内リンク
            target = "dt" + target;
            //alert(target);
            // 　→念のため対象が一ヶ所かつアコーディオンであることを確認
            if ($(target).length === 1 && $(target).hasClass("toggle-open") === true) {
                $(this).click(function () {
                    // リンク移動後の処理を追加
                    openTarget(target);
                    // return false;
                });
            }
        }
        return true;
    });
}(jQuery));