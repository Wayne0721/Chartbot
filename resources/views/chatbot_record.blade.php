<table class="table table-bordered">
    <thead>
        <tr id="review-select-all">
            <th>對話內容</th>
            <th>建立時間</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($chat_record as $record)
        <tr>
            <td>
                {{ $record['chat_sentence'] }}
            </td>
            <td>
                {{ $record['create_time'] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>