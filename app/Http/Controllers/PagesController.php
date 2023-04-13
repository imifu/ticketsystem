<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Admin;
use App\Models\User;
use App\Models\News;
use App\Models\Ticket;
use App\Models\TicketDetail;



class PagesController extends Controller
{

    // コンストラクタ
    public function __construct()
    {

    }


    public function index(Request $req) {

        // 販売期間中のチケットデータでトップバナー表示データを取得
        $bunner_datas = Ticket::where('tickets.del_flg', '=', '0')
        ->where('tickets.reco_flg', '=', '1')
        ->whereRaw('tickets.show_from <= NOW()')
        ->whereRaw('tickets.show_to >= NOW()')

        ->where('tickets.show_flg', '=', '1')
        ->where('tickets.sold_out_flg', '=', '0')

        ->orderBy('tickets.show_from', 'ASC')
        ->get();


        // 販売期間中のチケットデータを10件ずつ取得
        $datas = Ticket::where('tickets.del_flg', '=', '0')
        ->whereRaw('tickets.show_from <= NOW()')
        ->whereRaw('tickets.show_to >= NOW()')

        ->where('tickets.show_flg', '=', '1')
        ->where('tickets.sold_out_flg', '=', '0')

        ->orderBy('tickets.open_date', 'ASC')
        ->paginate(10);

        // お知らせデータを3件取得
        $news_datas = News::where('news.del_flg', '=', '0')
        ->orderBy('news.updated_at', 'DESC')
        ->limit(2)
        ->get();


        return view("pages.index",
            [
                'bunner_datas' => $bunner_datas,
                'datas' => $datas,
                'news_datas' => $news_datas,
            ]
        );
    }

    // お知らせ一覧ページ
    public function news(Request $req) {

        // お知らせデータを10件ずつ取得
        $datas = News::where('news.del_flg', '=', '0')
        ->orderBy('news.created_at', 'DESC')
        ->paginate(10);

        return view("pages.news", ['datas' => $datas]);
    }

    // お知らせ詳細ページ
    public function newsdetail($id = null) {

        // お知らせデータを取得
        $data = News::where('news.del_flg', '=', '0')
        ->where('news.id', '=', $id)
        ->first();

        return view("pages.news_detail", ['data' => $data]);
    }


    // チケット詳細ページ
    public function ticket($id = null) {

        if(empty($id)) {
            return redirect()->route('page.index');
        }

        // チケットデータを取得
        $data = Ticket::where('tickets.del_flg', '=', '0')
        ->where('tickets.id', '=', $id)
        ->whereRaw('tickets.show_from <= NOW()')
        ->whereRaw('tickets.show_to >= NOW()')

        ->where('tickets.show_flg', '=', '1')
        
        ->first();

        if(empty($data)) {
            return redirect()->route('page.index');
        }

        // チケット詳細データを取得
        $ticket_details = TicketDetail::where('ticket_details.del_flg', '=', '0')
        ->where('ticket_details.ticket_id', '=', $id)
        ->orderBy('ticket_details.amount', 'DESC')
        ->get();

        return view("pages.ticket", 
             [
            'data' => $data, 
            'ticket_details' => $ticket_details,
            'owner_name' => $data->owner_name
            ]
    );
    }

    // 会社情報ページ
    public function company() {
        return view("pages.company");
    }

    // 特商法取引ページ
    public function raw() {
        return view("pages.raw");
    }

    // プライバシーポリシー
    public function privacy() {
        return view("pages.privacy");
    }
    

}
