<h1>New blog posts</h1>

<table>
    <tr>
        <th>Name</th>
    </tr>

    @foreach ($posts as $post)   
        <tr>
            <td>{{ $post['title'] }}</td>
        </tr>
    @endforeach
</table>