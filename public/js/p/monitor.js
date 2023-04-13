// jQuery(document).ready(function($){
//     $("#loader").css("display", "none");
//     $.autopager({
//         content: ".monitor_list .monitor_item",// 読み込むコンテンツ
//         link: "#more a", // 次ページへのリンク
//         autoLoad: false,// スクロールの自動読込み解除

//         start: function(current, next){
//           $("#loader").css("display", "block");
//           $("#more a").css("display", "none");
//         },

//         load: function(current, next){
//             $("#loader").css("display", "none");
//             $("#more a").css("display", "block");
//         }
//     });

//     $("#more a").click(function(){ // 次ページへのリンクボタン
//         $.autopager("load"); // 次ページを読み込む
//         return false;
//     });
// });