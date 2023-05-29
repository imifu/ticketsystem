チケット購入完了のお知らせ

※このメールはシステムからの自動返信です


{{ $params["name"] }} 様

チケットのご購入が完了いたしました。

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
■ご購入いただチケットの詳細
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

チケット
{{ $params["title"] }}
{{ $params["ticket_title"] }}

金額
{{ number_format($params["amount"]) }}円

枚数
{{ $params["ticket_buy_num"] }}枚

開催日時
{{ date('Y/m/d', strtotime($params["open_date"])) }}({{ config('week_name.'.date('w', strtotime($params["open_date"]))) }})

開催場所
{{ $params["place_name"] }}

出演
{{ $params["owner_name"] }}

ご購入日時
{{ date('Y/m/d H:i:s') }}

購入履歴はこちらからご確認いただけます。
{{ route('users.history') }}


———————————————————————
{{ config('const.SITE_NAME')}}
URL：{{ config('const.SITE_URL') }}
電話：{{ config('const.COMPANY_TEL') }}
メールアドレス：{{ config('const.COMPANY_EMAIL') }}
———————————————————————