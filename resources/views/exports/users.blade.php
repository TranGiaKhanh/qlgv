<h4>List User</h4>
<br>
<div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Ngày sinh</th>
                <th>Khoa</th>
                <th>Chức vụ</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ date('Y-m-d', strtotime($user->birth_day)) }}</td>
                    <td>{{ $user->department->name }}</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
