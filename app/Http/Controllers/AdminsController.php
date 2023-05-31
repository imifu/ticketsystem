<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\User;
use App\Models\News;
use App\Models\Ticket;
use App\Models\TicketDetail;
use App\Models\UserTicket;
use App\Models\PaymentData;
use App\Models\PaymentLog;
use App\Models\Mail;





use App\Http\Requests\AdminRequest;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\TicketRequest;
use App\Http\Requests\SeatRequest;
use App\Http\Requests\MailRequest;




class AdminsController extends Controller
{

    // コンストラクタ
    public function __construct()
    {

    }


    public function index()
    {
        return view('admins.index');
    }

    // 管理者データ一覧のページ
    public function admins() {

        //adminsテーブルから50件ずつデータを取得
        $datas = Admin::paginate(50);

        return view('admins.admins', ['datas' => $datas]);
    }

    // 管理者データの詳細/編集ページ
    public function admin($id = null) {

        $data = null;

        if(!empty($id)) {
            //adminsテーブルからidをキーにデータを取得
            $data = Admin::find($id);
        }

        return view('admins.admin', ['data' => $data]);
    }


    // 管理者データの保存
    public function adminSave(AdminRequest $req) {

        Admin::updateOrCreate(
            ['id' => $req->id],
            [
              'name' => $req->name,
              'email' => $req->email,
              'admin_flg' => $req->admin_flg,
              'email_verified_at' => date("Y-m-d H:i:s"),
              'password' => bcrypt($req->password),
            ]
        );

        return redirect(route("admin.admins"));
    }

    // 管理者データの削除
    public function adminDelete($id) {

        //adminsテーブルからidをキーにデータを取得
        $data = Admin::find($id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        return redirect(route("admin.admins"));
    }


    // ニュース一覧
    public function news() {

        //newsテーブルから50件ずつデータを取得
        $datas = News::orderBy("created_at" , "DESC")->paginate(50);

        return view('admins.news', ['datas' => $datas]);
    }

    // ニュースの詳細/編集ページ
    public function newsDetail($id = null) {

        $data = null;

        if(!empty($id)) {
            //newsテーブルからidをキーにデータを取得
            $data = News::find($id);
        }

        return view('admins.newsDetail', ['data' => $data]);
    }

    // ニュースデータの保存
    public function newsSave(NewsRequest $req) {

        News::updateOrCreate(
            ['id' => $req->id],
            [
              'title' => $req->title,
              'reco_flg' => $req->reco_flg,
              'header_text' => $req->header_text,
              'detail' => $req->detail,
            ]
        );

        return redirect(route("admin.news"));
    }

    // ニュースデータの削除
    public function newsDelete($id) {

        //newsテーブルからidをキーにデータを取得
        $data = News::find($id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        return redirect(route("admin.news"));
    }


    // ユーザーデータ一覧のページ
    public function users(Request $req) {

        //usersテーブルから50件ずつデータを取得

        if(!empty($req)) {

            $datas = User::where('del_flg', "0")

            // 名前検索
            ->where(function ($query) use ($req) {
                $query->where('first_name', 'LIKE', "%".$req->name."%")
                    ->orWhere('last_name', 'LIKE', "%".$req->name."%");
            })

            // メールアドレス検索
            ->where(function ($query) use ($req) {
                $query->where('email', 'LIKE', "%".$req->email."%");
            })

            ->orderBy("created_at", "DESC")
            ->paginate(50);

        } else {

            $datas = User::orderBy("created_at", "DESC")
            ->where('del_flg', "0")
            ->paginate(50);
        }


        return view('admins.users', ['datas' => $datas, 'param' => $req->all()]);
    }

    // ユーザーデータの詳細/編集ページ
    public function user($id = null) {

        $data = null;

        if(!empty($id)) {
            //usersテーブルからidをキーにデータを取得
            $data = User::find($id);
        }

        return view('admins.user', ['data' => $data]);
    }

    // ユーザーデータの保存
    public function userSave(UserRequest $req) {

        User::updateOrCreate(
            ['id' => $req->id],
            [
              'first_name' => $req->first_name,
              'last_name' => $req->last_name,
              'sex' => $req->sex,
              'email' => $req->email,
              'email_verified_at' => date("Y-m-d H:i:s"),
              'password' => bcrypt($req->password),
              'tel' => $req->tel,
              'post_code' => $req->post_code,
              'pref' => $req->pref,
              'address' => $req->address,
              'memo' => $req->memo,
            ]
        );

        return redirect(route("admin.users"));
    }

    public function userDelete($id) {

        //adminsテーブルからidをキーにデータを取得
        $data = User::find($id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        return redirect(route("admin.users"));
    }

    //チケットデータの一覧
    public function tickets() {

        //ticketsテーブルから50件ずつデータを取得
        $datas = Ticket::orderBy("created_at", "DESC")->paginate(50);

        return view('admins.tickets', ['datas' => $datas]);
    }

    //チケットデータの詳細/編集ページ
    public function ticket($id = null) {

        $data = null;

        if(!empty($id)) {
            //ticketsテーブルからidをキーにデータを取得
            $data = Ticket::find($id);
        }

        return view('admins.ticket', ['data' => $data]);
    }

    //チケットデータの保存
    public function ticketSave(TicketRequest $req) {

        $image1 = self::uploadImage($req, "image", "image_old");
        $image2 = self::uploadImage($req, "image2", "image_old2");
        $image3 = self::uploadImage($req, "image3", "image_old3");

        //ticketsテーブルにデータを保存
        Ticket::updateOrCreate(
            ['id' => $req->id],
            [
              'title' => $req->title,
              'ticket_explain' => $req->ticket_explain,
              'image' => $image1,
              'image2' => $image2,
              'image3' => $image3,
              'show_flg' => $req->show_flg,
              'reco_flg' => $req->reco_flg,
              'sold_out_flg' => $req->sold_out_flg,
              'show_from' => $req->show_from,
              'show_to' => $req->show_to,
              'receive_from' => $req->receive_from,
              'receive_to' => $req->receive_to,
              'open_date' => $req->open_date,
              'close_date' => $req->close_date,
              'open_date_text' => $req->open_date_text,
              'receive_date_text' => $req->receive_date_text,
              'owner_name' => $req->owner_name,
              'live_name' => $req->live_name,
              'place_name' => $req->place_name,
              'place' => $req->place,
              'access' => $req->access,
              'order_num' => $req->order_num,
            ]
        );
        return redirect(route("admin.tickets"));
    }


    // チケットデータの削除
    public function ticketDelete($id) {

        //ticketsテーブルからidをキーにデータを取得
        $data = Ticket::find($id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        return redirect(route("admin.tickets"));
    }


    // 座席データ作成の為のチケットデータ一覧
    public function seats() {

        //ticketsテーブルから50件ずつデータを取得
        $datas = Ticket::orderBy("created_at", "DESC")->paginate(50);

        return view('admins.seats', ['datas' => $datas]);
    }


    // 座席データ作成
    public function seat($ticket_id = null, $id = null) {

        if(empty($ticket_id)) {
            return redirect(route("admin.top"));
        }

        $data = null;
        $ticket_data = null;

        if(!empty($ticket_id)) {
            //ticketsテーブルからidをキーにデータを取得
            $ticket_data = Ticket::find($ticket_id);
        }

        $sold_tickets = 0;

        if(!empty($id)) {
            //ticketsテーブルからidをキーにデータを取得
            $data = TicketDetail::find($id);

            // 販売枚数も確認
            $sold_tickets = UserTicket::where('ticket_detail_id', $id)
            ->where('valid_flg', "=", 1)
            ->where('del_flg', "=", 0)
            ->get()->count();
        }

        return view('admins.seat',
        [
            'ticket_data' => $ticket_data,
            'data' => $data,
            'sold_tickets' => $sold_tickets,
        ]
     );
    }

    // 座席データの保存
    public function seatSave(SeatRequest $req) {


        TicketDetail::updateOrCreate(
            ['id' => $req->id],
            [
              'ticket_id' => $req->ticket_id,
              'ticket_name' => $req->ticket_name,
              'amount' => $req->amount,
              'commission' => $req->commission,
              'deray_payment_date' => $req->deray_payment_date,
              'ticket_amount' => $req->ticket_amount,
              'sold_out_flg' => $req->sold_out_flg,
              'limit_sale' => $req->limit_sale,
            ]
        );

        return redirect(route("admin.seatsAll"));
    }

    // 座席データ一覧
    public function seatsAll($ticket_id = null) {

        $data = null;

        //ticketsテーブルから50件ずつデータを取得
        if(!empty($ticket_id)) {

            $datas = TicketDetail::where('ticket_id', $ticket_id)

            ->select('tickets.*', 'ticket_details.*', 'ticket_details.id as ticket_detail_id')

            ->where('ticket_details.del_flg', "=", '0')
            ->where('tickets.del_flg', "=", '0')

            ->join('tickets', 'tickets.id', '=', 'ticket_details.ticket_id')
            ->orderBy('ticket_details.created_at', 'DESC')
            ->paginate(50);

        } else {

            $datas = TicketDetail::join('tickets', 'tickets.id', '=', 'ticket_details.ticket_id')

            ->select('tickets.*', 'ticket_details.*', 'ticket_details.id as ticket_detail_id')

            ->where('ticket_details.del_flg', "=", '0')
            ->where('tickets.del_flg', "=", '0')

            ->orderBy('ticket_details.created_at', 'DESC')
            ->paginate(50);
        }


        return view('admins.seats_all',
        ['datas' => $datas]
     );
    }



    // 画像アップロード処理共通化
    private function uploadImage($req, $column_name = "image", $backup_name = "old_image", $dir_name = "images") {


        $image = $req->$column_name;

        if(empty($image)) {

          $image = $req->$backup_name;

        } else {

          $dir = $dir_name;

          // アップロードされたファイル名を取得
          $file_name = $req->file($column_name)->getClientOriginalName();

          $info = pathinfo($file_name);

          $file_name = "ticket-".date("YmdHis").".".$info["extension"];

          $req->file($column_name)->storeAs('public/'.$dir_name, $file_name);

          $image = "storage/" . $dir . "/" . $file_name;

        }

        return $image;

    }



    // 売上データ検索
    public function payments(Request $req) {

        $datas = null;

        $from_date = !empty($req->from_date) ? $req->from_date : date("Y-m-01 00:00:00");
        $to_date = !empty($req->to_date) ? $req->to_date : date("Y-m-t 23:59:59");

        $datas = UserTicket::join('payment_logs', 'payment_logs.user_ticket_id', '=', 'user_tickets.id')
        ->join('tickets', 'tickets.id', '=', 'user_tickets.ticket_id')
        ->join('ticket_details', 'ticket_details.id', '=', 'user_tickets.ticket_detail_id')
        ->join('users', 'users.id', '=', 'user_tickets.user_id')

        ->where('user_tickets.del_flg', "=", '0')
        ->where('payment_logs.del_flg', "=", '0')

        ->whereRaw("payment_logs.payment_date >= '{$from_date}'")
        ->whereRaw("payment_logs.payment_date <= '{$to_date}'")

        ->select('payment_logs.*', 'user_tickets.*', 'tickets.*', 'users.*','ticket_details.*', 'payment_logs.id as payment_log_id', 'user_tickets.id as user_ticket_id')

        ->orderBy('payment_logs.updated_at', 'DESC')
        ->get();

        return view('admins.payments', ['datas' => $datas]);
    }


    public function enterSeat() {

        $selects = Ticket::orderBy("created_at", "DESC")->get();

        $datas = null;


        return view('admins.enter_seat',
        [
            'selects' => $selects,
            'datas' => $datas
        ]
     );
    }


    public function paymentsDelete($id, $user_ticket_id) {


        $data = PaymentLog::find($id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        $data = UserTicket::find($user_ticket_id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        return redirect(route("admin.payments"));

    }

    public function enterSeatSearch(Request $req) {

        $selects = Ticket::orderBy("created_at", "DESC")->get();

        $datas = UserTicket::where('user_tickets.del_flg', "=", '0')

        ->where('user_tickets.ticket_id', "=", $req->ticket_id)

        ->select('*', 'user_tickets.id as user_ticket_id', 'user_tickets.created_at as buy_created_at')

        ->join('users', 'users.id', '=', 'user_tickets.user_id')
        ->join('tickets', 'tickets.id', '=', 'user_tickets.ticket_id')
        ->join('ticket_details', 'ticket_details.id', '=', 'user_tickets.ticket_detail_id')

        ->orderBy("user_tickets.updated_at", "DESC")->get();

        $returns = [];

        if(!empty($datas)) {
            foreach($datas as $key => $data) {

                $arr = array(
                    "buy_id" => $data->user_ticket_id,
                    "seat_name" => $data->seat,
                    "user_name" => $data->last_name." ".$data->first_name,
                    "ticket_name" => $data->ticket_name,
                    "amount" => $data->amount,
                    "buy_date" => $data->buy_created_at,
                    "memo" => $data->memo,

                );

                array_push($returns, $arr);

            }
        }

        // カラムの作成
        $head = ['購入ID', '席名', '購入者', 'チケット名', '購入金額', '購入日時' , 'ファンクラブNo'];

        // 書き込み用ファイルを開く

        $csvFileName = "ticket_seat".date("YmdHis").".csv";
        $write_name = "../public/assets/csvfiletticketparkticketpark/".$csvFileName;
        $f = fopen($write_name, 'w');

        if ($f) {
            // カラムの書き込み
            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($f, $head);
            // データの書き込み
            foreach ($returns as $return) {

                mb_convert_variables('SJIS', 'UTF-8', $return);
                fputcsv($f, $return);
            }
        }
        // ファイルを閉じる
        fclose($f);

        $headers = [
            'Content-Type' => 'application/pdf'
         ];


        return response()->download($write_name, $csvFileName, $headers);

    }


    public function enterSeatUpload(Request $req) {

        $data = $req->all();

        $tmp = mt_rand() . "." . $req->file('csv')->guessExtension();
        $req->file('csv')->move(public_path() . "/tmp", $tmp);
        $filepath = public_path() . "/tmp/" . $tmp;

        // CSV取得
        $file = new \SplFileObject($filepath);
        $file->setFlags(
            \SplFileObject::READ_CSV |
                \SplFileObject::READ_AHEAD |
                \SplFileObject::SKIP_EMPTY |
                \SplFileObject::DROP_NEW_LINE
        );
        //各行を処理する
        foreach ($file as $key => $line) {

            if($key == 0) {
                continue;
            }

            $enc_line = mb_convert_encoding($line, 'UTF-8', 'SJIS');

            $data = UserTicket::find($enc_line[0]);

            if(!empty($data)) {
                $data->seat = $enc_line[1];
                $data->update();
            }


        }


        return redirect()->route('admin.sumally')->with('msg', "座席管理データをインポートしました");


    }


    public function sumally() {

        $selects = Ticket::orderBy("created_at", "DESC")->get();

        $datas = UserTicket::where('user_tickets.del_flg', "=", '0')

        ->select('*', 'user_tickets.id as user_ticket_id', "user_tickets.created_at as user_ticket_created_at")

        ->join('users', 'users.id', '=', 'user_tickets.user_id')
        ->join('tickets', 'tickets.id', '=', 'user_tickets.ticket_id')
        ->join('ticket_details', 'ticket_details.id', '=', 'user_tickets.ticket_detail_id')

        ->orderBy("user_tickets.updated_at", "DESC")->paginate(100);


        return view('admins.sumally',
        [
            'selects' => $selects,
            'datas' => $datas
        ]);
    }

    public function sumallySearch(Request $req) {

        $selects = Ticket::orderBy("created_at", "DESC")->get();

        $data = $req->all();

        $datas = UserTicket::where('user_tickets.del_flg', "=", '0')

        ->select('*', 'user_tickets.id as user_ticket_id')

        ->where('user_tickets.ticket_id', "=", $data['ticket_id'])

        ->join('users', 'users.id', '=', 'user_tickets.user_id')
        ->join('tickets', 'tickets.id', '=', 'user_tickets.ticket_id')
        ->join('ticket_details', 'ticket_details.id', '=', 'user_tickets.ticket_detail_id')

        ->orderBy("user_tickets.updated_at", "DESC")->paginate(100);

        return view('admins.sumally',
        [
            'selects' => $selects,
            'datas' => $datas,
        ]);
    }


    //メルマガ送信先検索ページ
    public function mail_magazine_search() {

        $datas = User::where('del_flg', "=", '0')->orderBy("created_at", "DESC")->paginate(100);

        return view('admins.mail_magazine_search',
        [
            'datas' => $datas
        ]);
    }

    // メール作成画面
    public function mail_magazine() {

        return view('admins.mail_magazine');
    }

    //メールデータの保存
    public function mailSave(MailRequest $req) {

        Mail::updateOrCreate(
            ['id' => $req->id],
            [
                'title' => $req->title,
                'message' => $req->message,
                'send_fig' => '0',
                'send_time' => $req->send_time,
            ]
        );
        return redirect(route("admin.mails"));
    }

    //メールの一覧
    public function mails()
    {
        //Mailテーブルから50件ずつデータを取得
        $datas = Mail::orderBy("created_at", "DESC")->paginate(50);

        return view('admins.mails', ['datas' => $datas]);
    }

    // メールの詳細/編集ページ
    public function mailDetail($id = null)
    {

        $data = null;

        if (!empty($id)) {
            //Mailテーブルからidをキーにデータを取得
            $data = Mail::find($id);
        }

        return view('admins.mailDetail', ['data' => $data]);
    }

    //メールの削除
    public function mailDelete($id)
    {
        //Mailテーブルからidをキーにデータを取得
        $data = Mail::find($id);

        $data["del_flg"] = config("const.SAKUJYO_ZUMI");
        $data->save();

        return redirect(route("admin.mails"));
    }



    //QRコードリーダー
    public function qr_reader() {

        return view('admins.qr_code');
    }

    // 来場判定
    public function come_live($str = null) {

        if(empty($str)) {
            return redirect(route("admin.top"));
        }

        $data = UserTicket::where('qr_code', $str)
        ->where('user_tickets.valid_flg', "=", '1')
        ->where('user_tickets.del_flg', "=", '0')
        ->first();


        if(empty($data)) {
            echo "<h1 style='font-size:100px;'>qr code none</h1>";
            exit;
        }

        $MSG = "<h1 style='font-size:100px;'>";


        if($data->come_flg == 1) {

            $MSG .= "※ 再入場です ※<br />";

        } else if($data->come_flg == 0) {

            $data->come_flg = 1;
            $data->save();
        }


        echo $MSG."座席：".$data->seat."</h1>";
        exit;
    }


}
