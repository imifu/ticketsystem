
<html>
  <head>
    <title>CSV出力</title>
  </head>
  <body>
    <h1>CSV出力</h1>
    <form action="{{ route('user.CSV') }}" method="post">
      @csrf
      <table border="1" width="200">
        <tr>
            <th>購入ID</th>
            <th>購入者</th>
            <th>購入チケット</th>
            <th>メールアドレス</th>
            <th>座席</th>
        </tr>
        @foreach($datas as $data)
        <tr>
            <td><span class="text-default font-weight-semibold">{{ $data->user_ticket_id }}</span></td>
            <td><span class="text-default font-weight-semibold">{{ $data->last_name }} {{ $data->first_name }}</span></td>
            <td><span class="text-default font-weight-semibold">{{ $data->title }}</span></td>
            <td><span class="text-default font-weight-semibold">{{ $data->email }}</span></td>
            <td><span class="text-default font-weight-semibold">{{ $data->seat }}</span></td>
        </tr>
        @endforeach
      </table>
      <button type="submit">CSV出力</button>
    </form>
  </body>
</html>